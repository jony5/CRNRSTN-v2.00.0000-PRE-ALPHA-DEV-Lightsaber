<?php
/*
// J5
// Code is Poetry */

class user {

    private static $oEnv;
    private static $oLogger;
    private static $oDBIntegrate;
    private static $oHTML;

    private static $sess_env_param_ARRAY = array();
    private static $db_response_serial_handle_ARRAY = array();
    private static $http_param_handle = array();
    private static $oDB_RESP;
    private static $dataAugment_ARRAY = array();

    public $tmp_csv_https_download;
    public $wthrbg_forecast_uri;
    public $wthrbg_xygrid_uri;
    public $wthrbg_xygrid_wikipedia;
    public $wthrbg_curr_zipcode;
    public $wthrbg_curr_city;
    public $wthrbg_curr_state;
    public $langComboHTML;
    public $langElem_ARRAY = array();
    public $sys_activity_description;
    public $section_open_onload = 'default';
    public $errorMessage;
    public $errorMessage_ARRAY = array();
    public $transStatusMessage_ARRAY = array();
    public $databaseResponse_ARRAY = array();
    public $copy_content_field;
    public $copy_profile_type;
    public $copy_component_type;
    public $active_radio_id = array();
    public $default_selected_radio_val;
    public $xhr_response_json;
    private static $queryDescript_ARRAY = array();
    private static $newElementID_ARRAY = array();

    private static $us_geo_zipcode_csv_rows_delta = '';
    private static $us_geo_state_prov_csv_rows_delta = '';

    public $validFrom = true;

    public function __construct($userEnv) {

        self::$oEnv = $userEnv;

        //
        // INSTANTIATE LOGGER
        self::$oLogger = new crnrstn_logging();


        //
        // INSTANTIATE DATABASE INTEGRATION
        self::$oDBIntegrate = new database_integration();

        //
        // INSTANTIATE HTML GENERATOR
        self::$oHTML = new html_generator(self::$oEnv, $this);

    }

    public function wthrbg_locale_search_request(){

        self::$db_response_serial_handle_ARRAY[] = 'LOCALE_UGC_SEARCH';
        self::$http_param_handle["USER_QUERY"] = self::$oEnv->oHTTP_MGR->extractData($_GET, 'q');
        // http://172.16.195.132/wethrbug//locale_search/
        //?callback=jQuery110208403688920318815_1583688370754
        //&q=ITE
        //&_=1583688370756

        //
        // PROCESS
        return self::$oDBIntegrate->processUserRequest('locale_ugc_search', $this, self::$oEnv);

    }

    public function locale_typosearch_mysql_import(){

        self::$db_response_serial_handle_ARRAY[] = 'US_CITY_STATE';

        //
        // GET PREPARED TEXT FILE
        $tmp_dir = self::$oEnv->getEnvParam('DOCUMENT_ROOT').self::$oEnv->getEnvParam('DOCUMENT_ROOT_DIR').self::$oEnv->getEnvParam('US_CITYTYPO_CUSTOM_FILE_DIR');
        $tmp_csv_file_ARRAY= scandir($tmp_dir, 1);

        //
        // BUILD NEW ARRAY WITH CSV
        $tmp_csv_cnt = sizeof($tmp_csv_file_ARRAY);

        for($i=0;$i<$tmp_csv_cnt;$i++){

            $tmp_pos_csv = strpos($tmp_csv_file_ARRAY[$i], '.txt');

            //
            // IF NO CSV
            if(($tmp_pos_csv===false)){

            }else{

                //
                // PROCESS TXT
                $filename = $tmp_dir.$tmp_csv_file_ARRAY[$i];
                $handle = fopen($filename, "r");
                $contents = fread($handle, filesize($filename));
                fclose($handle);

                $tmp_str_len = strlen($contents);

                self::$db_response_serial_handle_ARRAY[] = 'US_STATE_PROV';
                self::$http_param_handle["US_CITY_STATE_PROV_DATA"] = $contents;
                self::$http_param_handle["RAW_RESPONSE_LENGTH"] = $tmp_str_len;
                self::$http_param_handle["RAW_RESPONSE_FILESIZE"] = filesize($filename);

                unset($tmp_endpoint_response_ARRAY);    // FREE SOME MEMORY
                unset($contents);                       // FREE SOME MEMORY

                //
                // PROCESS
                $tmp_response = self::$oDBIntegrate->processUserRequest('locale_typosearch_mysql_import', $this, self::$oEnv);

                $tmp_test_response = $tmp_response;

                return $tmp_test_response;

            }

        }

    }

    public function returnTxtParseData($type, $str){

        /*
         *
         ===
         Abbeville</strong></td>
                        <td>Commonly misspelled as <em>Abbevile</em></td>
                        <td>(Georgia, GA
         )</td>
                    </tr>
                            <tr>
                        <td>

        ===
        Abbeville</strong></td>
                        <td>Commonly misspelled as <em>Abeville</em></td>
                        <td>(Georgia, GA
         )</td>
                    </tr>
                            <tr>
                        <td>

        ===
        Abilene</strong></td>
                        <td>Commonly misspelled as <em>Abiline</em></td>
                        <td>(Texas, TX
         )</td>
                    </tr>
                            <tr>
                        <td>

        ===...
         * */

        switch($type){
            case 'ZG_CITY_LOOKUP':

                $tmp_city_ARRAY = explode( '</strong>', $str);
                $extract_param = trim($tmp_city_ARRAY[0]);

            break;
            case 'SPROV_POSTAL':

                $tmp_postal00_ARRAY = explode( ',', $str);
                $tmp_postal01_ARRAY = explode( ')', $tmp_postal00_ARRAY[1]);
                $extract_param = strtoupper(trim($tmp_postal01_ARRAY[0]));

            break;
            case 'SPROV_NAME':

                $tmp_postal00_ARRAY = explode( ',', $str);
                $tmp_postal01_ARRAY = explode( '(', $tmp_postal00_ARRAY[0]);
                $extract_param = trim($tmp_postal01_ARRAY[1]);

            break;
            case 'SEARCH_CONTENT_CITY':

                $tmp_postal00_ARRAY = explode( '<em>', $str);
                $tmp_postal01_ARRAY = explode( '</em>', $tmp_postal00_ARRAY[1]);
                $extract_param = strtolower(trim($tmp_postal01_ARRAY[0]));

            break;

        }

        return $extract_param;
    }

    public function parseMiscTXTtoARRAY($str){

        $resp_ARRAY = array();

        // SOURCE :: https://stackoverflow.com/questions/1462720/iterate-over-each-line-in-a-string-in-php
        // AUTHOR :: https://stackoverflow.com/users/118898/kyril
        //foreach(preg_split("/((\r?\n)|(\r\n?))/", $str) as $str_line) {

        //    if ($str_line != "") {
        //        $resp_ARRAY[] = $str_line;
        //    }

        //}

        $resp_ARRAY = explode('<strong>', $str);

        return $resp_ARRAY;

    }

    public function locale_typosearch_mysql_buildout(){

        self::$db_response_serial_handle_ARRAY[] = 'US_CITY_STATE';

        //
        // PROCESS
        $tmp_response = self::$oDBIntegrate->processUserRequest('locale_typosearch_mysql_buildout', $this, self::$oEnv);

        return $tmp_response;

    }

    public function locale_search_mysql_buildout(){

        self::$db_response_serial_handle_ARRAY[] = 'US_CITY_STATE';

        //
        // PROCESS
        $tmp_response = self::$oDBIntegrate->processUserRequest('locale_search_mysql_buildout', $this, self::$oEnv);

        return $tmp_response;

    }

    public function sync_us_state_province_data(){

        $tmp_test_response = '';

        try{

            //
            // CSV IMPORT/ARCHIVE DIRECTORIES
            $tmp_import_URI = self::$oEnv->getEnvParam('US_STATE_PROV_CSV_SOURCE_URI');

            // 1) ACQUIRE FILE FROM public.opendatasoft.com, AND PARSE IT INTO PHP MEMORY IN PREPARATION FOR
            // MERGE WITH MYSQL DATABASE TABLE
            $this->tmp_csv_https_download = $this->curl_get_file_contents($tmp_import_URI);
            //self::$oLogger->captureNotice('user->sync_us_geo_zipcode_data()', LOG_NOTICE, 'Line 86 - Completed receiving of CSV file from URI ['.$tmp_import_URI.']');

            $tmp_len = strlen($this->tmp_csv_https_download);

            $tmp_test_response = 'hello world!['.$tmp_len.']';
            if($tmp_len<75000){

                $tmp_test_response = 'Error getting contents.';
                throw new Exception('Wethrbug database_integration :: oUser->sync_us_state_province_data() ERROR :: curl_get_file_contents from '.$tmp_import_URI.' resulted in response of length='.$tmp_len.'
                Begin Response Output :: '.$this->tmp_csv_https_download);

            }else{

                $tmp_new_dir = self::$oEnv->getEnvParam('DOCUMENT_ROOT').self::$oEnv->getEnvParam('DOCUMENT_ROOT_DIR').self::$oEnv->getEnvParam('US_GOV_STATE-PROVINCE_CSV_NEW_DIR');
                $tmp_new_filename = $tmp_new_dir.date('Y').date('m').date('d').date('H').date('i').date('s').'_natural-earth-us-states-provinces-1110m.csv';

                if (file_exists($tmp_new_filename)) {
                    //
                    // DELETE THE FILE
                    unlink($tmp_new_filename);

                    //
                    // UPDATE CSV FILE WITH NEW DATA
                    $file_handle = fopen($tmp_new_filename, 'a');
                    $tmp_prof_xml_status = fwrite($file_handle, $this->tmp_csv_https_download);
                    fclose($file_handle);

                } else {

                    //
                    // UPDATE CSV FILE WITH NEW DATA
                    $file_handle = fopen($tmp_new_filename, 'a');
                    $tmp_prof_xml_status = fwrite($file_handle, $this->tmp_csv_https_download);
                    fclose($file_handle);

                }

            }


        }catch (Exception $e) {
            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('user->sync_us_state_province_data()', LOG_EMERG, $e->getMessage());

            return $tmp_test_response;
        }

        return $tmp_test_response;

    }

    public function sync_us_geo_zipcode_data(){

        $tmp_test_response = '';

        try{

            //
            // CSV IMPORT/ARCHIVE DIRECTORIES
            $tmp_import_URI = self::$oEnv->getEnvParam('US_GOV_ZIPCODE_CSV_SOURCE_URI');

            // 1) ACQUIRE FILE FROM public.opendatasoft.com, AND PARSE IT INTO PHP MEMORY IN PREPARATION FOR
            // MERGE WITH MYSQL DATABASE TABLE
            $this->tmp_csv_https_download = $this->curl_get_file_contents($tmp_import_URI);
            //self::$oLogger->captureNotice('user->sync_us_geo_zipcode_data()', LOG_NOTICE, 'Line 86 - Completed receiving of CSV file from URI ['.$tmp_import_URI.']');

            $tmp_len = strlen($this->tmp_csv_https_download);
            if($tmp_len<75000){

                $tmp_test_response = 'Error getting contents.';
                throw new Exception('Wethrbug database_integration :: oUser->sync_us_geo_zipcode_data() ERROR :: curl_get_file_contents from '.$tmp_import_URI.' resulted in response of length='.$tmp_len.'
                Begin Response Output :: '.$this->tmp_csv_https_download);

            }else{

                $tmp_new_dir = self::$oEnv->getEnvParam('DOCUMENT_ROOT').self::$oEnv->getEnvParam('DOCUMENT_ROOT_DIR').self::$oEnv->getEnvParam('US_GOV_ZIPCODE_CSV_NEW_DIR');
                $tmp_new_filename = $tmp_new_dir.date('Y').date('m').date('d').date('H').date('i').date('s').'_us-zip-code-latitude-and-longitude.csv';

                $tmp_test_response = '<br>Writing ['.strlen($this->tmp_csv_https_download).'] content to file...['.$tmp_new_filename.']';

                if (file_exists($tmp_new_filename)) {
                    //
                    // DELETE THE FILE
                    unlink($tmp_new_filename);

                    //
                    // UPDATE CSV FILE WITH NEW DATA
                    $file_handle = fopen($tmp_new_filename, 'a');
                    $tmp_prof_xml_status = fwrite($file_handle, $this->tmp_csv_https_download);
                    fclose($file_handle);

                } else {

                    //
                    // UPDATE CSV FILE WITH NEW DATA
                    $file_handle = fopen($tmp_new_filename, 'a');
                    $tmp_prof_xml_status = fwrite($file_handle, $this->tmp_csv_https_download);
                    fclose($file_handle);

                }

            }

        }catch (Exception $e) {
            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('user->sync_us_geo_zipcode_data()', LOG_EMERG, $e->getMessage());

        }

        return $tmp_test_response;

    }

    public function mysql_import_us_state_province_data(){

        $tmp_dir = self::$oEnv->getEnvParam('DOCUMENT_ROOT').self::$oEnv->getEnvParam('DOCUMENT_ROOT_DIR').'/'.self::$oEnv->getEnvParam('US_GOV_STATE-PROVINCE_CSV_NEW_DIR');
        $tmp_csv_file_ARRAY= scandir($tmp_dir, 1);

        //
        // BUILD NEW ARRAY WITH CSV
        $tmp_csv_cnt = sizeof($tmp_csv_file_ARRAY);

        for($i=0;$i<$tmp_csv_cnt;$i++){

            $tmp_pos_csv = strpos($tmp_csv_file_ARRAY[$i], '.csv');

            //
            // IF NO CSV
            if(($tmp_pos_csv===false)){

            }else{

                //
                // PROCESS CSV
                $filename = $tmp_dir.$tmp_csv_file_ARRAY[$i];
                $handle = fopen($filename, "r");
                $contents = fread($handle, filesize($filename));
                fclose($handle);

                $tmp_str_len = strlen($contents);
                if($tmp_str_len<75000){

                    $tmp_test_response = 'Error :: string length='.$tmp_str_len;

                }else{

                    $tmp_endpoint_response_ARRAY = explode(self::$oEnv->getEnvParam('US_STATE_PROV_CSV_RESP_HEADER_DELIM'), $contents);

                    self::$db_response_serial_handle_ARRAY[] = 'US_STATE_PROV';
                    self::$http_param_handle["US_STATE_PROV_DATA"] = $tmp_endpoint_response_ARRAY[1];
                    self::$http_param_handle["RAW_RESPONSE_LENGTH"] = $tmp_str_len;

                    unset($tmp_endpoint_response_ARRAY);    // FREE SOME MEMORY
                    unset($contents);                       // FREE SOME MEMORY

                    //
                    // PROCESS
                    $tmp_response = self::$oDBIntegrate->processUserRequest('us_state_province_data_sync', $this, self::$oEnv);

                    $tmp_test_response = $tmp_response;


                }

                return $tmp_test_response;

            }

        }

    }

    public function mysql_import_us_geo_zipcode_data(){

        $tmp_dir = self::$oEnv->getEnvParam('DOCUMENT_ROOT').self::$oEnv->getEnvParam('DOCUMENT_ROOT_DIR').'/'.self::$oEnv->getEnvParam('US_GOV_ZIPCODE_CSV_NEW_DIR');
        $tmp_csv_file_ARRAY= scandir($tmp_dir, 1);

        //
        // BUILD NEW ARRAY WITH CSV
        $tmp_csv_cnt = sizeof($tmp_csv_file_ARRAY);

        for($i=0;$i<$tmp_csv_cnt;$i++){

            $tmp_pos_csv = strpos($tmp_csv_file_ARRAY[$i], '.csv');

            //
            // IF NO CSV
            if(($tmp_pos_csv===false)){

            }else{

                //
                // PROCESS CSV
                $filename = $tmp_dir.$tmp_csv_file_ARRAY[$i];
                $handle = fopen($filename, "r");
                $contents = fread($handle, filesize($filename));
                fclose($handle);

                $tmp_str_len = strlen($contents);

                if($tmp_str_len<75000){
                    $tmp_test_response = 'Error :: string length='.$tmp_str_len.' acquired at '.$tmp_dir;
                    self::$oLogger->captureNotice('user->mysql_import_us_geo_zipcode_data()', LOG_EMERG, $tmp_test_response);

                }else{

                    $tmp_endpoint_response_ARRAY = explode(self::$oEnv->getEnvParam('US_GOV_ZIPCODE_CSV_RESP_HEADER_DELIM'), $contents);

                    self::$db_response_serial_handle_ARRAY[] = 'US_GEO_ZIP';
                    self::$http_param_handle["US_GEO_ZIP_DATA"] = $tmp_endpoint_response_ARRAY[1];
                    self::$http_param_handle["RAW_RESPONSE_LENGTH"] = $tmp_str_len;

                    unset($tmp_endpoint_response_ARRAY);    // FREE SOME MEMORY
                    unset($contents);                       // FREE SOME MEMORY

                    //
                    // PROCESS
                    $tmp_response = self::$oDBIntegrate->processUserRequest('us_geo_zip_data_sync', $this, self::$oEnv);

                    $tmp_test_response = $tmp_response;


                }

                return $tmp_test_response;

            }

        }

    }

    public function remove_new_us_state_prov_csv(){

        $tmp_dir = self::$oEnv->getEnvParam('DOCUMENT_ROOT').self::$oEnv->getEnvParam('DOCUMENT_ROOT_DIR').'/'.self::$oEnv->getEnvParam('US_GOV_STATE-PROVINCE_CSV_NEW_DIR');
        $tmp_csv_file_ARRAY= scandir($tmp_dir, 1);

        $tmp_csv_cnt = sizeof($tmp_csv_file_ARRAY);

        for($i=0;$i<$tmp_csv_cnt;$i++){

            $tmp_pos_csv = strpos($tmp_csv_file_ARRAY[$i], '.csv');

            //
            // IF NO CSV
            if(($tmp_pos_csv===false)){

            }else{

                //
                // REMOVE CSV
                $filename = $tmp_dir.$tmp_csv_file_ARRAY[$i];
                unlink($filename);

            }

        }

    }

    public function remove_new_us_geo_zip_csv(){

        $tmp_dir = self::$oEnv->getEnvParam('DOCUMENT_ROOT').self::$oEnv->getEnvParam('DOCUMENT_ROOT_DIR').'/'.self::$oEnv->getEnvParam('US_GOV_ZIPCODE_CSV_NEW_DIR');
        $tmp_csv_file_ARRAY= scandir($tmp_dir, 1);

        $tmp_csv_cnt = sizeof($tmp_csv_file_ARRAY);

        for($i=0;$i<$tmp_csv_cnt;$i++){

            $tmp_pos_csv = strpos($tmp_csv_file_ARRAY[$i], '.csv');

            //
            // IF NO CSV
            if(($tmp_pos_csv===false)){

            }else{

                //
                // REMOVE CSV
                $filename = $tmp_dir.$tmp_csv_file_ARRAY[$i];
                unlink($filename);

            }

        }

    }

    // SOURCE :: https://stackoverflow.com/questions/22949295/how-do-you-get-server-cpu-usage-and-ram-usage-with-php
    // AUTHOR :: https://stackoverflow.com/users/3500833/snoobih
    public function get_server_memory_usage(){

        $free = shell_exec('free');
        $free = (string)trim($free);
        $free_arr = explode("\n", $free);
        $mem = explode(" ", $free_arr[1]);
        $mem = array_filter($mem);
        $mem = array_merge($mem);
        $memory_usage = $mem[2]/$mem[1]*100;

        return $memory_usage;
    }

    private function curl_get_file_contents($URL)
    {
        $c = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_URL, $URL);

        //$contents = curl_exec($c);
        if( ! $contents = curl_exec($c)){
            self::$oLogger->captureNotice('[ERROR] user->curl_get_file_contents() Fired Request Resulting in CURL ERR ::', LOG_CRIT, curl_error($c));
        }

        curl_close($c);

        if ($contents) return $contents;
        else return FALSE;
    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.stream-get-line.php
    // AUTHOR :: https://www.php.net/manual/en/function.stream-get-line.php#79944
    private function getURLContents($url, $ip, $port, $ssl = false, $closeConnection = false){

        $wethrbug_maxtime = 500;

        if ($ssl)
            $ssl = 'ssl://';
        else
            $ssl = '';
        $fp = pfsockopen($ssl. $ip, $port, $errno, $errstr, $wethrbug_maxtime);
        if ($fp)
        {
            $out =  'GET '.$url." HTTP/1.1\r\n";
            $out .= 'Host: '.$ip.':'.$port."\r\n";
            if ($closeConnection)
                $out .= "Connection: close\r\n";
            else
                $out .= "Connection: keep-alive\r\n";
            $out .= "\r\n";
            if (!fwrite($fp, $out))
            {
                echo 'Problem writing to socket, opening a new connection.';
                fclose($fp);
                $fp = pfsockopen($ssl.$ip, $port, $errno, $errstr, $wethrbug_maxtime);
                fwrite($fp, $out);
            }

            //$theData = '';
            $theData = 0;
            $idone = false;
            stream_set_blocking($fp, 0);
            $startTime = time();
            $lastTime = $startTime;

            $tmp_new_dir = self::$oEnv->getEnvParam('DOCUMENT_ROOT').self::$oEnv->getEnvParam('DOCUMENT_ROOT_DIR').self::$oEnv->getEnvParam('US_GOV_ZIPCODE_CSV_NEW_DIR');
            $tmp_delta_filename = $tmp_new_dir.date('Y').date('m').date('d').date('H').date('i').date('s').'_us-zip-code-latitude-and-longitude.csv';

            if (file_exists($tmp_delta_filename)) {
                //
                // DELETE THE FILE
                unlink($tmp_delta_filename);

            }

            $file_handle = fopen($tmp_delta_filename, 'wb');
            $tmp_newLine_assemble = '';
            $tmp_garbage_data = '';
            $tmp_append_next_good = 0;

            /*
              \r
            Linux/Unix: \n
            Windows: \r\n
             * */

            while (!feof($fp) && !$idone && (($startTime + $wethrbug_maxtime) > time()))
            {

                usleep(100);
                $theNewData = stream_get_line($fp, 1024, "\n");
                //$theData .= $theNewData;
                $theNewData = $this->carriage_return_clean($theNewData);

                $tmp_ARRAY = explode(";", $theNewData);

                // 83424;Felt;ID;43.882935;-111.21512;-7;1;43.882935,-111.21512
                // TRY TO WRITE DATA TO FILE
                if(strlen($theNewData)>10 && sizeof($tmp_ARRAY)>7){
                    $theData++;
                    fwrite($file_handle, $theNewData . "\n");
                    $tmp_newLine_assemble = '';
                    $tmp_append_next_good = 0;

                }else{

                    if(strlen($theNewData)>10){

                        $tmp_newLine_assemble = $tmp_newLine_assemble.$theNewData;
                        $tmp_lineARRAY = explode(";", $tmp_newLine_assemble);
                        $tmp_columnCnt = sizeof($tmp_lineARRAY);

                        if($tmp_columnCnt>7){
                            $theData++;
                            fwrite($file_handle, $tmp_newLine_assemble . "\n");
                            $tmp_newLine_assemble = '';

                        }else{

                            //
                            // WE NEED TO APPEND THE NEXT QUALIFIED ROW
                            $tmp_append_next_good = 1;

                        }

                    }else{
                        //if($theNewData!=''){
                            //$tmp_garbage_data .= $theNewData.'<br>';
                        //}

                    }

                }

                $idone = (trim($theNewData) === '0');

            }

            fclose($file_handle);
        }
        else
        {
            echo 'ERROR CONNECTING TO '.$ip.':'.$port;
            return false;
        }
        if ($closeConnection)
            fclose($fp);

        echo $tmp_garbage_data;
        return $theData;
    }

    private function carriage_return_clean($str){

        $patterns = array();
        $patterns[0] = "\r\n";
        $patterns[1] = "\r";

        $replacements = array();
        $replacements[0] = '';
        $replacements[1] = '';

        $str = str_replace($patterns, $replacements, $str);
        return $str;
    }

    public function process_new_line_us_state_province($str_line, $hash_algo, $delim){

        $state_province_raw_ARRAY = array();
        $tmp_raw_line_hash = hash($hash_algo, $str_line);
        $tmp_line_ARRAY = explode($delim, $str_line);

        /*
                     ## Geo Point;0
                     * Geo Shape;1
                     * scalerank;2
                     * featurecla;3
                     * Adm1 Code;4
                     * Diss Me;5
                     * Adm1 Cod 1;6
                     * Iso 3166 2;7
                     ## wikipedia;8
                     * Sr Sov A3;9
                     * Sr Adm0 A3;10
                     * Iso A2;11
                     * Adm0 Sr;12
                     * Admin0 Lab;13
                     ## name;14
                     ## Name Alt;15
                     * Name Local;16
                     ## type;17
                     * Type En;18
                     * Code Local;19
                     * Code Hasc;20
                     * note;21
                     * Hasc Maybe;22
                     ## region;23
                     * Region Cod;24
                     ## Region Big;25
                     * Big Code;26
                     * Provnum Ne;27
                     * Gadm Level;28
                     * Check Me;29
                     * Scaleran 1;30
                     * datarank;31
                     ## abbrev;32
                     ## postal;33
                     * Area Sqkm;34
                     * sameascity;35
                     * labelrank;36
                     * Featurec 1;37
                     * admin;38
                     * Name Len;39
                     * mapcolor9;40
                     * mapcolor13;41

                     * */

        $state_province_raw_ARRAY['RAW_GEOPOINT'] = $tmp_line_ARRAY[0];
        $state_province_raw_ARRAY['RAW_WIKIPEDIA'] = $tmp_line_ARRAY[8];
        $state_province_raw_ARRAY['RAW_NAME'] = $tmp_line_ARRAY[14];
        $state_province_raw_ARRAY['RAW_NAME_ALT'] = $tmp_line_ARRAY[15];
        $state_province_raw_ARRAY['RAW_TYPE'] = $tmp_line_ARRAY[17];
        $state_province_raw_ARRAY['RAW_REGION'] = $tmp_line_ARRAY[23];
        $state_province_raw_ARRAY['RAW_REGION_BIG'] = $tmp_line_ARRAY[25];
        $state_province_raw_ARRAY['RAW_ABBREV'] = $tmp_line_ARRAY[32];
        $state_province_raw_ARRAY['RAW_POSTAL'] = $tmp_line_ARRAY[33];
        $state_province_raw_ARRAY['RAW_STATE_PROV_RAW_LINE'] = $str_line;
        $state_province_raw_ARRAY['STATE_PROV_CHECKSUM'] = $tmp_raw_line_hash;

        return $state_province_raw_ARRAY;

    }

    public function process_new_line_us_geo_zip($str_line, $hash_algo, $delim){

        $geo_zip_raw_ARRAY = array();
        $tmp_raw_line_hash = hash($hash_algo, $str_line);
        $tmp_line_ARRAY = explode($delim, $str_line);

        //Zip;City;State;Latitude;Longitude;Timezone;Daylight savings time flag;geopoint
        $geo_zip_raw_ARRAY['RAW_ZIPCODE'] = $tmp_line_ARRAY[0];
        $geo_zip_raw_ARRAY['RAW_CITY'] = $tmp_line_ARRAY[1];
        $geo_zip_raw_ARRAY['RAW_STATE'] = $tmp_line_ARRAY[2];
        $geo_zip_raw_ARRAY['RAW_LATITUDE'] = $tmp_line_ARRAY[3];
        $geo_zip_raw_ARRAY['RAW_LONGITUDE'] = $tmp_line_ARRAY[4];
        $geo_zip_raw_ARRAY['RAW_TIMEZONE'] = $tmp_line_ARRAY[5];
        $geo_zip_raw_ARRAY['RAW_DST_FLAG'] = $tmp_line_ARRAY[6];
        $geo_zip_raw_ARRAY['RAW_GEOPOINT'] = $tmp_line_ARRAY[7];
        $geo_zip_raw_ARRAY['RAW_GEOZIP_RAW_LINE'] = $str_line;
        $geo_zip_raw_ARRAY['GEOZIP_CHECKSUM'] = $tmp_raw_line_hash;

        return $geo_zip_raw_ARRAY;
    }

    public function record_change_csv_line_us_state_prov($csv_line){

            self::$us_geo_state_prov_csv_rows_delta .= $csv_line.'
';

    }

    public function record_change_csv_line_us_geo_zip($csv_line){

        self::$us_geo_zipcode_csv_rows_delta .= $csv_line.'
';

    }

    public function log_csv_deltas_to_us_state_prov(){

        $tmp_archive_dir = self::$oEnv->getEnvParam('DOCUMENT_ROOT').self::$oEnv->getEnvParam('DOCUMENT_ROOT_DIR').self::$oEnv->getEnvParam('US_GOV_STATE_PROV_CSV_ARCHIVE_DIR');

        $tmp_delta_filename = $tmp_archive_dir.date('Y').date('m').date('d').date('H').date('i').date('s').'_natural-earth-us-states-provinces-1110m.csv';

        if (file_exists($tmp_delta_filename)) {
            //
            // DELETE THE FILE
            unlink($tmp_delta_filename);

            //
            // UPDATE CSV FILE WITH NEW DATA
            $file_handle = fopen($tmp_delta_filename, 'a');
            $tmp_prof_xml_status = fwrite($file_handle, self::$us_geo_state_prov_csv_rows_delta);
            fclose($file_handle);

        } else {

            //
            // UPDATE CSV FILE WITH NEW DATA
            $file_handle = fopen($tmp_delta_filename, 'a');
            $tmp_prof_xml_status = fwrite($file_handle, self::$us_geo_state_prov_csv_rows_delta);
            fclose($file_handle);

        }

    }

    public function log_csv_deltas_to_us_geo_zip(){

        $tmp_archive_dir = self::$oEnv->getEnvParam('DOCUMENT_ROOT').self::$oEnv->getEnvParam('DOCUMENT_ROOT_DIR').self::$oEnv->getEnvParam('US_GOV_ZIPCODE_CSV_ARCHIVE_DIR');

        /*
          $tmp_year_DIR = date('Y');
        $tmp_month_DIR = date('m');

        $tmp_target_dir_path = $this->getEnvParam('DOCUMENT_ROOT').$this->getEnvParam('DOCUMENT_ROOT_DIR');
        $tmp_target_dir_path_FULL = $tmp_target_dir_path . '/common/xml/'.$tmp_year_DIR.'/'.$tmp_month_DIR.'/';
        $tmp_target_dir_path_BASIC = '/common/xml/'.$tmp_year_DIR.'/'.$tmp_month_DIR.'/';
         * */


        $tmp_delta_filename = $tmp_archive_dir.date('Y').date('m').date('d').date('H').date('i').date('s').'_us-zip-code-latitude-and-longitude.csv';

        if (file_exists($tmp_delta_filename)) {
            //
            // DELETE THE FILE
            unlink($tmp_delta_filename);

            //
            // UPDATE CSV FILE WITH NEW DATA
            $file_handle = fopen($tmp_delta_filename, 'a');
            $tmp_prof_xml_status = fwrite($file_handle, self::$us_geo_zipcode_csv_rows_delta);
            fclose($file_handle);

        } else {

            //
            // UPDATE CSV FILE WITH NEW DATA
            $file_handle = fopen($tmp_delta_filename, 'a');
            $tmp_prof_xml_status = fwrite($file_handle, self::$us_geo_zipcode_csv_rows_delta);
            fclose($file_handle);

        }

    }

    public function validateUSAZip($zip_code){
      if(preg_match("/^([0-9]{5})(-[0-9]{4})?$/i",$zip_code))
        return true;
      else
        return false;
    }

    public function processWethrbug_zip_submit($handle){

        self::$http_param_handle["ZIPCODE"] = trim(self::$oEnv->oHTTP_MGR->extractData($_POST, 'zipcode'));

        $pos = strpos(self::$http_param_handle["ZIPCODE"], "-");
        if ($pos === false) {

            //
            // ZIPCODE HAS NO DASH

        }else{

            //
            // CUT ZIP AT THE DASH
            $tmp_zip_ARRAY = explode("-", self::$http_param_handle["ZIPCODE"]);
            self::$http_param_handle["ZIPCODE"] = $tmp_zip_ARRAY[0];

        }

        $this->wthrbg_xygrid_uri = self::$http_param_handle["ZIPCODE"];

        self::$http_param_handle["MOBILENUMBER"] = trim(self::$oEnv->oHTTP_MGR->extractData($_POST, 'mobilenumber'));
        self::$http_param_handle["POSTID"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'postid');
        self::$http_param_handle["CITY_PROVINCE"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'cityState');
        self::$http_param_handle["ACTION_TYPE"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'action_type');
        self::$http_param_handle["LANG_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'LANG_ID'));

        if(isset($handle)){
            self::$db_response_serial_handle_ARRAY[] = $handle;

            //
            // PROCESS
            //self::$oLogger->captureNotice('user->processWethrbug_zip_submit()', LOG_NOTICE, 'Processing zipcode.');

            $oDB_RESP = self::$oDBIntegrate->processUserRequest('processWethrbug_zip_submit', $this, self::$oEnv);

            $tmp_ZIPCODE = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($handle), 'GEO_ZIP_DATA', self::$http_param_handle["ZIPCODE"], 'ZIPCODE');
            $tmp_CITY = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($handle), 'GEO_ZIP_DATA', self::$http_param_handle["ZIPCODE"], 'CITY');
            $tmp_STATE = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($handle), 'GEO_ZIP_DATA', self::$http_param_handle["ZIPCODE"], 'STATE');
            $tmp_LATITUDE_STR = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($handle), 'GEO_ZIP_DATA', self::$http_param_handle["ZIPCODE"], 'LATITUDE_STR');
            $tmp_LONGITUDE_STR = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($handle), 'GEO_ZIP_DATA', self::$http_param_handle["ZIPCODE"], 'LONGITUDE_STR');

            $tmp_WIKIPEDIA = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($handle), 'STATE_PROVINCE', $tmp_STATE, 'WIKIPEDIA');
            //self::$oLogger->captureNotice('user->processWethrbug_zip_submit()', LOG_NOTICE, $tmp_LATITUDE_STR.'||'.$tmp_LONGITUDE_STR);

            /*`wthrbg_zipcode_geo`.`ZIPCODE`,
            `wthrbg_zipcode_geo`.`CITY`,
            `wthrbg_zipcode_geo`.`STATE`,
            `wthrbg_zipcode_geo`.`ISACTIVE`,
            `wthrbg_zipcode_geo`.`LATITUDE_STR`,
            `wthrbg_zipcode_geo`.`LONGITUDE_STR`,
            `wthrbg_zipcode_geo`.`LATITUDE_FLOAT`,
            `wthrbg_zipcode_geo`.`LONGITUDE_FLOAT`,
            `wthrbg_zipcode_geo`.`TIMEZONE`,
            `wthrbg_zipcode_geo`.`DAYLIGHT_SAVINGS`,
            `wthrbg_zipcode_geo`.`GEOPOINT`,
            `wthrbg_zipcode_geo`.`GEOZIP_CHECKSUM`,
            `wthrbg_zipcode_geo`.`GEOZIP_RAW_LINE`,
            `wthrbg_zipcode_geo`.`RAW_RESPONSE_LENGTH`,
            `wthrbg_zipcode_geo`.`UPDATE_COUNT`,
            */

            $tmp_xygrid_URI = $this->fiveDayForcast_xygrid_uri_retrieval($tmp_LATITUDE_STR, $tmp_LONGITUDE_STR);
            //self::$oLogger->captureNotice('user->processWethrbug_zip_submit()', LOG_NOTICE, $tmp_forcast_URI);

            $tmp_wethrbug_xygrid_ARRAY[0] = $tmp_xygrid_URI;
            $tmp_wethrbug_xygrid_ARRAY[1] = $tmp_CITY;
            $tmp_wethrbug_xygrid_ARRAY[2] = $tmp_STATE;
            $tmp_wethrbug_xygrid_ARRAY[3] = $tmp_ZIPCODE;
            $tmp_wethrbug_xygrid_ARRAY[4] = $tmp_WIKIPEDIA;

            return $tmp_wethrbug_xygrid_ARRAY;

        }else {
            //
            // HOOOSTON...VE HAF PROBLEM!
            self::$oLogger->captureNotice('user->processDraftAction() FAILURE', LOG_EMERG, 'No database response handle has been provided.');

        }

    }

    public function fiveDayForcast_xygrid_uri_retrieval($latitude, $longitude){

        //
        // TARGET URI FORMAT :: https://api.weather.gov/points/-->$latitude,$longitude<--
        // LIMIT ACCURACY TO 4 DECIMAL PLACES OR GET 301
        $latitude = $this->tweak_geoloc_accuracy($latitude);
        $longitude = $this->tweak_geoloc_accuracy($longitude);

        $tmp_uri = 'https://api.weather.gov/points/'.$latitude.','.$longitude;

        return $tmp_uri;

    }

    private function fiveDayForcast_uri_retrieval($zipcode, $latitude, $longitude){

        //
        // TARGET URI FORMAT :: https://api.weather.gov/points/-->$latitude,$longitude<--
        // LIMIT ACCURACY TO 4 DECIMAL PLACES OR GET 301
        $tmp_json_serial = 'zipcode_geo_lookup';
        $latitude = $this->tweak_geoloc_accuracy($latitude);
        $longitude = $this->tweak_geoloc_accuracy($longitude);

        $tmp_uri = 'https://api.weather.gov/points/'.$latitude.','.$longitude;

        //self::$oLogger->captureNotice('user->fiveDayForcast_uri_retrieval()', LOG_NOTICE, $tmp_uri);

        $json_XY_geo_response = $this->getUrlContent($tmp_uri);
        $json_object = json_decode($json_XY_geo_response);

        //self::$oLogger->captureNotice('user->fiveDayForcast_uri_retrieval()->json_XY_geo_response', LOG_NOTICE, $json_object->{'@context'});

        return $json_XY_geo_response;

    }

    private function tweak_geoloc_accuracy($float_str){

        $tmp_val = (float) $float_str;
        $tmp_val = round($tmp_val, 4);

        return $tmp_val;

    }

    //
    // CURL HTTP INFO
    private function getUrlContent($url){

        $header=array(
            'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36',
            'X-Requested-With: XMLHttpRequest',
            'Host: api.weather.gov',
            'Accept: text/html, */*; q=0.01',
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'Accept-Language: en-US,en;q=0.9,zh-CN;q=0.8,zh;q=0.7',
            'Accept-Encoding: gzip,deflate',
            'Referer: https://api.weather.gov/',
            'Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7',
            'Keep-Alive: 115',
            'Connection: keep-alive',
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        //curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        //curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$header);

        $data = curl_exec($ch);
        //$obj = json_encode($data);
        $data = utf8_encode($data);
        //$obj = json_decode($data);

        //self::$oLogger->captureNotice('user->getUrlContent()->object data', LOG_NOTICE, $url."||".$obj->{'@context'});

        //$data = json_decode($data, true);
        //self::$oLogger->captureNotice('user->getUrlContent()->json_decode data', LOG_NOTICE, $url."||".$data);

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        //self::$oLogger->captureNotice('user->getUrlContent()', LOG_NOTICE, $httpcode."||".$url."||".$data);

        curl_close($ch);
        return ($httpcode>=200 && $httpcode<300) ? $data : false;
    }

    public function buildHTMLOutput($oDB_RESP, $serial_handle, $display_type, $display_location, $lang_id){

        switch($display_type){
            case 'ADMIN_PREVIEW':
                //
                // ADMIN OUTPUT
                $tmp_html = self::$oHTML->returnAdminHTML($oDB_RESP, $serial_handle, $display_location, $lang_id);

                break;
            default:
                //
                // OVERLAY OUTPUT
                $tmp_html = self::$oHTML->returnOverlayHTML($oDB_RESP, $serial_handle, $display_location, $lang_id);

                break;

        }

        return $tmp_html;
    }

    public function buildXMLOutput($oDB_RESP, $serial_handle, $type, $xml_output_ARRAY){

        $tmp_xml_array = array();

        switch($type){
            case 'full':
                //
                // FULL SCREEN XML PROFILE OUT
                $tmp_xml_array = self::$oHTML->returnFullScrnXML($oDB_RESP, $serial_handle, $xml_output_ARRAY);

                break;
            default:
                //
                // MINI XML PROFILE OUT
                $tmp_xml_array = self::$oHTML->returnMiniXML($oDB_RESP, $serial_handle);

                break;

        }

        return $tmp_xml_array;
    }

    public function returnCurrentStatus($handle){

        // http://172.16.225.128/avoverlay/?logs=true&obs_id=harrismac_Terminal&rt=currentstatus
        // $tmp_serial_handle = 'OBS_CLIENT_PROFILE_DATA';
        // $oDB_RESP = $oUSER->getOBSClientProfileData($tmp_serial_handle);
        self::$db_response_serial_handle_ARRAY[] = $handle;
        self::$http_param_handle["OBS_ID"] = strtolower(self::$oEnv->oHTTP_MGR->extractData($_GET, 'obs_id'));

        //
        // PROCESS
        $oDB_RESP = self::$oDBIntegrate->processUserRequest('obs_client_return_current_status', $this, self::$oEnv);

        $tmp_HTML = $this->returnOBSClientCurrentStatus_HTML($oDB_RESP);

        return $tmp_HTML;

    }

    public function bufferOverlayTime($tmp_timer_copy, $tmp_obs_lastcontact){

        return self::$oEnv->oFINITE_EXPRESS->addTimerBuffer($tmp_timer_copy, $tmp_obs_lastcontact);

    }

    public function collectNewElementID($handle, $elem_ID){

        self::$newElementID_ARRAY[$handle] = $elem_ID;

    }

    public function returnNewElementID($handle){

        return self::$newElementID_ARRAY[$handle];

    }

    public function returnSectionOpenStatus($section){

        if($this->section_open_onload==$section){

            return 'data-collapsed="false"';

        }else{

            return NULL;

        }

    }

    public function returnConfirmOnclick($element_val, $data_val, $confirmSwitchCase, $OBS_clientID){
        // returnConfirmOnclick('SLEEP_ALT',tmp_mini_display_mode,'radio_select_mini_display_mode', $tmp_obsclientid)

        if($element_val==$data_val){

            return NULL;

        }else{

            return 'onclick="apply_OBSClientUpdate_Confirm(\''.$confirmSwitchCase.'\', \''.$OBS_clientID.'\', this.value);"';

        }


    }

    public function returnFormattedTimeCopy($time_format, $sys_date){

        $tmp_time = '';
        $pos = strpos($time_format, '..');

        // Note our use of ===.  Simply == would not work as expected
        // because the position of 'a' was the 0th (first) character.
        if ($pos === false) {
            //echo "The string '$findme' was not found in the string '$mystring'";
            $tmp_time = date($time_format, strtotime($sys_date));

        } else {

            $tmp_time = date($time_format, strtotime($sys_date));
            $tmp_time = $this->dotTheTime($tmp_time);
        }

        return $tmp_time;

    }

    private function dotTheTime($dotted_time){

        $patterns = array();
        $patterns[0] = '..';
        $patterns[1] = 'am';
        $patterns[2] = 'AM';
        $patterns[3] = 'PM';
        $patterns[4] = 'pm';

        $replacements = array();
        $replacements[0] = '';
        $replacements[1] = 'a.m.';
        $replacements[2] = 'A.M.';
        $replacements[3] = 'P.M.';
        $replacements[4] = 'p.m.';

        $dotted_time = str_replace($patterns, $replacements, $dotted_time);

        return $dotted_time;
    }

    public function returnProfileLangRadioChecked($lang_id, $oDB_RESP, $serial_handle){

        $tmp_profile_matched_lang_id = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($serial_handle), 'LANG_REQUESTS', $lang_id, 'LANG_ID');

        if($lang_id==$tmp_profile_matched_lang_id){

            return 'checked="checked"';

        }else{

            return NULL;
        }

    }

    public function returnRadioChecked($default_val, $data_val, $elem_id=null){

        if(isset($elem_id)){
            $this->active_radio_id[$default_val] = $elem_id;
        }

        if($default_val==$data_val){

            $this->default_selected_radio_val = $default_val;

            return 'checked="checked"';

        }else{

            return NULL;
        }


    }

    public function returnDropDownSelected($default_val,$data_val){

        if($default_val==$data_val){

            return 'selected="selected"';

        }else{

            return NULL;
        }


    }

    public function storeDataAugment($key, $dataObj){

        self::$dataAugment_ARRAY[$key] = $dataObj;

    }

    public function returnDataAugment($key){

        return self::$dataAugment_ARRAY[$key];

    }

    public function getOverlayStateDatum($handle){

        // CALLED BY database.inc.php private function syncXML()

        if(isset($handle)){

            //
            // OOP
            self::$db_response_serial_handle_ARRAY[] = $handle;
            return self::$oDBIntegrate->processUserRequest('get_overlay_mgmt_state_for_XML', $this, self::$oEnv);

        }
    }

    public function getSystemComponents($handle){

        if(isset($handle)){
            self::$db_response_serial_handle_ARRAY[] = $handle;

            //
            // PROCESS
            return self::$oDBIntegrate->processUserRequest('sys_get_components', $this, self::$oEnv);

        }else {
            //
            // HOOOSTON...VE HAF PROBLEM!
            self::$oLogger->captureNotice('user->getSystemComponents() FAILURE', LOG_EMERG, 'No database response handle has been provided.');

        }


    }

    public function getSystemColors($handle){

        if(isset($handle)){
            self::$db_response_serial_handle_ARRAY[] = $handle;

            //
            // PROCESS
            return self::$oDBIntegrate->processUserRequest('sys_get_colors', $this, self::$oEnv);

        }else {
            //
            // HOOOSTON...VE HAF PROBLEM!
            self::$oLogger->captureNotice('user->getSystemColors() FAILURE', LOG_EMERG, 'No database response handle has been provided.');

        }


    }

    public function processDraftAction($handle){

        self::$http_param_handle["LANG_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'lang_id'));
        self::$http_param_handle["LANG_ID_TRANSLATOR"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'lit'));
        self::$http_param_handle["POSTID"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'postid');
        self::$http_param_handle["ACTION_TYPE"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'action_type');
        self::$http_param_handle["ELEMENT_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'element_id'));
        self::$http_param_handle["COPY_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'copy_id'));
        self::$http_param_handle["COMPONENT_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'component_id'));
        self::$http_param_handle["PAGE_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'page_id'));
        self::$http_param_handle["PROFILE_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'profile_id'));
        self::$http_param_handle["ELEMENT_SKIP_PIPE_STR"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'element_sps'));

        if(isset($handle)){
            self::$db_response_serial_handle_ARRAY[] = $handle;

            //
            // PROCESS
            error_log('295 user.inc.php sending to database ...handle->'.$handle.'...action_type->'.self::$http_param_handle["ACTION_TYPE"]);
            return self::$oDBIntegrate->processUserRequest($handle, $this, self::$oEnv);

        }else {
            //
            // HOOOSTON...VE HAF PROBLEM!
            self::$oLogger->captureNotice('user->processDraftAction() FAILURE', LOG_EMERG, 'No database response handle has been provided.');

        }

    }

    public function processXHRSubmit($handle){
        self::$http_param_handle["JSON_SERIAL_JS_HANDLE"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_json_serial_js_handle');
        self::$http_param_handle["JSON_OBJECT_TYPE"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_json_object_type');
        self::$http_param_handle["INPUT_DOM_ELEMENT_TYPE"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_input_dom_element_type');
        self::$http_param_handle["INPUT_DOM_ELEMENT_ID"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_input_dom_element_id');
        self::$http_param_handle["POSTID"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'postid');
        self::$http_param_handle["ELEMENT_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_element_id'));
        self::$http_param_handle["ELEMENT_ID_TRANSLATION"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_element_id_translation'));
        self::$http_param_handle["COPY_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_copy_id'));
        self::$http_param_handle["COMPONENT_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_component_id'));
        self::$http_param_handle["PAGE_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_page_id'));
        self::$http_param_handle["PROFILE_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_profile_id'));
        self::$http_param_handle["COPY_HASH"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_copy_hash');
        self::$http_param_handle["LANG_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_lang_id'));
        self::$http_param_handle["LANG_ID_TRANSLATOR"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_lang_id_translator'));
        self::$http_param_handle["PROFILE_TYPE"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_profile_type'));
        self::$http_param_handle["DATEPUBLISHED"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_date_translation_published'));
        self::$http_param_handle["DATEDRAFTED"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_date_translation_drafted');

        self::$http_param_handle["COMPONENT_TYPE"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_component_type'));
        self::$http_param_handle["ELEMENT_COPY"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_element_copy');
        self::$http_param_handle["XCP_LOCK"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_lock');

        self::$http_param_handle["ISACTIVE"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_isactive'));
        self::$http_param_handle["COMPLETION_STATE"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_completion_state'));
        self::$http_param_handle["DRAFT_OWNER"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_draft_owner');

        /*
         * oJson_construct('ADD_ELEM_ATTRIBUTE', json_serial, 'JSON_SERIAL_JS_HANDLE', json_serial);
			oJson_construct('ADD_ELEM_ATTRIBUTE', json_serial, 'JSON_OBJECT_TYPE', 'LANG_ELEM_DRAFT_SYNC');
        $tmp_INPUT_DOM_ELEMENT_TYPE = $oUser->retrieve_Form_Data('INPUT_DOM_ELEMENT_TYPE');
                                    $tmp_INPUT_DOM_ELEMENT_ID = $oUser->retrieve_Form_Data('INPUT_DOM_ELEMENT_ID');
         *
         * oJson_construct('ADD_ELEM_ATTRIBUTE', json_serial, 'ELEMENT_ID', tmp_element_id);
			oJson_construct('ADD_ELEM_ATTRIBUTE', json_serial, 'ELEMENT_ID_TRANSLATION', tmp_element_id_translation);
			oJson_construct('ADD_ELEM_ATTRIBUTE', json_serial, 'COPY_ID', tmp_copy_id);
			oJson_construct('ADD_ELEM_ATTRIBUTE', json_serial, 'COMPONENT_ID', tmp_component_id);
			oJson_construct('ADD_ELEM_ATTRIBUTE', json_serial, 'PAGE_ID', tmp_page_id);
			oJson_construct('ADD_ELEM_ATTRIBUTE', json_serial, 'PROFILE_ID', tmp_profile_id);
			oJson_construct('ADD_ELEM_ATTRIBUTE', json_serial, 'LANG_ID', tmp_lang_id);
			oJson_construct('ADD_ELEM_ATTRIBUTE', json_serial, 'LANG_ID_TRANSLATOR', tmp_lang_id_translator);
			oJson_construct('ADD_ELEM_ATTRIBUTE', json_serial, 'DRAFT_STATE', tmp_draft_state);
			oJson_construct('ADD_ELEM_ATTRIBUTE', json_serial, 'ISACTIVE', tmp_isactive);
			oJson_construct('ADD_ELEM_ATTRIBUTE', json_serial, 'PROFILE_TYPE', tmp_profile_type);
			oJson_construct('ADD_ELEM_ATTRIBUTE', json_serial, 'COMPONENT_TYPE', tmp_component_type);
			oJson_construct('ADD_ELEM_ATTRIBUTE', json_serial, 'ELEMENT_COPY', tmp_element_copy);
			oJson_construct('ADD_ELEM_ATTRIBUTE', json_serial, 'COMPLETION_STATE', 'AUTO_DRAFT');
			oJson_construct('ADD_ELEM_ATTRIBUTE', json_serial, 'DRAFT_OWNER', 'AUTO');

        <input type="hidden" name="postid" value="xhr_sync_proxy">
            <input type="hidden" id="xcp_element_id" name="xcp_element_id" value="">
            <input type="hidden" id="xcp_element_id_translation" name="xcp_element_id_translation" value="">
            <input type="hidden" id="xcp_copy_id" name="xcp_copy_id" value="">
            <input type="hidden" id="xcp_component_id" name="xcp_component_id" value="">
            <input type="hidden" id="xcp_page_id" name="xcp_page_id" value="">
            <input type="hidden" id="xcp_profile_id" name="xcp_profile_id" value="">
            <input type="hidden" id="xcp_copy_hash" name="xcp_copy_hash" value="">
            <input type="hidden" id="xcp_lang_id" name="xcp_lang_id" value="">
            <input type="hidden" id="xcp_lang_id_translator" name="xcp_lang_id_translator" value="">
            <input type="hidden" id="xcp_draft_state" name="xcp_draft_state" value="">
            <input type="hidden" id="xcp_profile_type" name="xcp_profile_type" value="">
            <input type="hidden" id="xcp_component_type" name="xcp_component_type" value="">
            <input type="hidden" id="xcp_element_copy" name="xcp_element_copy" value="">
            <input type="hidden" id="xcp_lock" name="xcp_lock" value="">
            <input type="hidden" id="xcp_isactive" name="xcp_isactive" value="">
         * */

        //
        // PROCESS
        error_log('288 user.inc.php sending to database ...handle->'.$handle);
        return self::$oDBIntegrate->processUserRequest($handle, $this, self::$oEnv);
    }


    public function encoding($string){

        $string = iconv("UTF-8", "GB2312//IGNORE", $string);

        return $string;
    }

    public function to_json($data, $pretty=null, $include_security=false, $try_to_recover=true) {
        // @Note: json_encode() *REQUIRES* data to be in valid UTF8 format BEFORE
        //                    trying to json_encode   and since we are working with Chinese
        //                    characters, we need to make sure that we explicitly allow:
        //                    JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES
        //                    *Unless a mode is explicitly passed into the function

        $json_encoded = '{}';
        if ($pretty === null) { // @NOTE: Substitute with your own Production env check
            $json_encoded = json_encode( $data, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES );
        } else if ($pretty === null && is_env_dev()){ // @NOTE: Substitute with your own Development env check
            $json_encoded = json_encode( $data, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES );
        } else {
            // PRODUCTION
            $json_encoded = json_encode( $data, $pretty );
        }



        // (1) Do not return an error if the inital data was empty
        // (2) Return an error if json_encode() failed
        if (json_last_error() > 0) {
            if (!!$data || !empty($data)) {
                if (!$json_encoded == false || empty($json_encoded) || $json_encoded == '{}') {
                    $json_encoded = json_encode([
                        'status' => false,
                        'error' => [
                            'json_last_error' => json_last_error(),
                            'json_last_error_msg' => json_last_error_msg()
                        ]
                    ]);
                } else if (!!$try_to_recover) {
                    // there was data in $data so lets try to forensically recover a little? by removing $k => $v pairs that fail to be JSON encoded
                    foreach (((array) $data) as $k => $v) {
                        if (!json_encode([$k => $v])) {
                            if (is_array($data)) {
                                unset($data[$k]);
                            } else if (is_object($data)) {
                                unset($data->{$k});
                            }
                        }
                    }

                    // if the data still is not empty, and there is a status set in the data
                    //      then set it to false and add a error message/data
                    //      ONLY for Array & Objects
                    if (!empty($json_encoded) && count($json_encoded) < 1) {
                        if (!json_encode($data)) {
                            if (is_array($json_encoded)) {
                                $json_encoded['status'] = false;
                                $json_encoded['message'] = "json_encoding_error";
                                $json_encoded['error'] = [
                                    'json_last_error' => json_last_error(),
                                    'json_last_error_msg' => json_last_error_msg()
                                ];
                            } else if (is_object($json_encoded)) {
                                $json_encoded->status = false;
                                $json_encoded->message = "json_encoding_error";
                                $json_encoded->error = [
                                    'json_last_error' => json_last_error(),
                                    'json_last_error_msg' => json_last_error_msg()
                                ];
                            }
                        } else {
                            // We have removed the offending data
                            return to_json($data, $pretty, $include_security, $try_to_recover);
                        }
                    }

                    // we've cleaned out any data that was causing the problem, and included
                    //      false to indicate this is a one-time recursion recovery.
                    return $this->to_json($pretty, $include_security, false);
                }
            } else { } // don't do anything as the value is already false
        }

        return ( ($include_security) ? ")]}',\n" : '' ) . $json_encoded;
    }


    public function processTranslationUserSubmit(){

        self::$http_param_handle["ELEMENT_REF_KEY"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'element_reference_key'));
        self::$http_param_handle["ELEMENT_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'element_id'));
        self::$http_param_handle["ELEMENT_ID_TRANSLATION"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'element_id_translation'));
        self::$http_param_handle["COPY_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'copy_id'));
        self::$http_param_handle["LANG_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'lang_id'));
        self::$http_param_handle["LANG_ID_TRANSLATOR"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'lang_id_translator'));

        self::$http_param_handle["TRANSLATION_NEW_COPY"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'translation_copy');

        self::$http_param_handle["COMPONENT_TYPE"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'component_type'));
        self::$http_param_handle["COMPONENT_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'component_id'));
        self::$http_param_handle["PAGE_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'page_id'));
        self::$http_param_handle["PROFILE_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'profile_id'));
        self::$http_param_handle["PROFILE_TYPE"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'profile_type'));
        self::$http_param_handle["DRAFT_OWNER"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'draft_owner'));
        self::$http_param_handle["COMPLETION_STATE"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'completion_state'));
        /*
         * // UNHANDLED (BUT PRESENT) FORM PARAMS...FOR INTENTIONAL UGC SUBMISSION
        <input type="hidden" name="isactive" id="isactive" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_FOR_PUBLISH', 'ISACTIVE')); ?>">
        <input type="hidden" name="copy_hash" id="copy_hash" value="<?php echo $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_FOR_PUBLISH', 'COPY_HASH'); ?>">
        <input type="hidden" name="date_translation_published" id="date_translation_published" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt(date("Y-m-d H:i:s", $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_FOR_PUBLISH', 'DATEPUBLISHED'))); ?>">
        <input type="hidden" name="date_translation_drafted" id="date_translation_drafted" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt(date("Y-m-d H:i:s", $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_FOR_PUBLISH', 'DATEDRAFTED'))); ?>">
        <input type="hidden" name="postid" id="postid" value="language_translation_user_submit_capture">
         * */

        //
        // PROCESS
        return self::$oDBIntegrate->processUserRequest('language_translation_user_submit_capture', $this, self::$oEnv);

    }

    public function processDesiredLangRequest($handle){

        self::$http_param_handle["PIPED_ENCRYPT_LANG_ID"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'lang_translation_profile');
        self::$http_param_handle["PROFILE_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'fullscrn_profile_id'));
        self::$http_param_handle["MINI_PROFILE_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'mini_profile_id'));

        $this->collectNewElementID('PROFILE_ID', self::$http_param_handle["PROFILE_ID"]);

        return self::$oDBIntegrate->processUserRequest($handle, $this, self::$oEnv);

    }

    public function processComponentMod($handle){

        switch($handle){
            case 'insert_subtitle_element':

                self::$http_param_handle["PAGE_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'overlay_fullscrn_page_id'));
                $this->collectNewElementID('PAGE_ID', self::$http_param_handle["PAGE_ID"]);

                self::$http_param_handle["PROFILE_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'overlay_fullscrn_profile_id'));
                $this->collectNewElementID('PROFILE_ID', self::$http_param_handle["PROFILE_ID"]);

                self::$http_param_handle["COMPONENT_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'overlay_fullscrn_component_id'));
                $this->collectNewElementID('COMPONENT_ID', self::$http_param_handle["COMPONENT_ID"]);

                self::$http_param_handle["ELEMENT_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'subtitle_element_id'));
                $this->collectNewElementID('ELEMENT_ID', self::$http_param_handle["ELEMENT_ID"]);

                self::$http_param_handle["ACTION_TYPE"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'action_type');
                self::$http_param_handle["COMPONENT_TYPE_KEY"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'component_type_key');
                self::$http_param_handle["COMPONENT_COUNT"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'page_current_component_count');

                self::$http_param_handle["SUBTITLE_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'overlay_fullscrn_paragraph_id'));
                self::$http_param_handle["SUBTITLE_COPY"] = htmlentities(self::$oEnv->oHTTP_MGR->extractData($_POST, 'subtitle_content'));
                self::$http_param_handle["SUBTITLE_DELETE"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'subtitle_delete');
                self::$http_param_handle["SUBTITLE_ALIGNMENT"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'subtitle_alignment');

                self::$http_param_handle["LANG_ID"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'new_elem_lang_id');


                break;
            case 'insert_paragraph_element':

                self::$http_param_handle["PAGE_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'overlay_fullscrn_page_id'));
                $this->collectNewElementID('PAGE_ID', self::$http_param_handle["PAGE_ID"]);

                self::$http_param_handle["PROFILE_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'overlay_fullscrn_profile_id'));
                $this->collectNewElementID('PROFILE_ID', self::$http_param_handle["PROFILE_ID"]);

                self::$http_param_handle["COMPONENT_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'overlay_fullscrn_component_id'));
                $this->collectNewElementID('COMPONENT_ID', self::$http_param_handle["COMPONENT_ID"]);

                self::$http_param_handle["ELEMENT_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'paragraph_element_id'));
                $this->collectNewElementID('ELEMENT_ID', self::$http_param_handle["ELEMENT_ID"]);

                self::$http_param_handle["ACTION_TYPE"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'action_type');
                self::$http_param_handle["COMPONENT_TYPE_KEY"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'component_type_key');
                self::$http_param_handle["COMPONENT_COUNT"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'page_current_component_count');

                self::$http_param_handle["PARAGRAPH_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'overlay_fullscrn_paragraph_id'));
                self::$http_param_handle["PARAGRAPH_COPY"] = htmlentities(self::$oEnv->oHTTP_MGR->extractData($_POST, 'paragraph_content'));
                self::$http_param_handle["PARAGRAPH_COPY_IS_BOLD"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'paragraph_content_is_bold');
                self::$http_param_handle["PARAGRAPH_COPY_IS_BLOCKQUOTE"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'paragraph_content_is_blockquote');
                self::$http_param_handle["PARAGRAPH_DELETE"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'paragraph_delete');

                self::$http_param_handle["LANG_ID"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'new_elem_lang_id');


                break;
            case 'insert_bullet_element':

                self::$http_param_handle["PAGE_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'overlay_fullscrn_page_id'));
                $this->collectNewElementID('PAGE_ID', self::$http_param_handle["PAGE_ID"]);

                self::$http_param_handle["PROFILE_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'overlay_fullscrn_profile_id'));
                $this->collectNewElementID('PROFILE_ID', self::$http_param_handle["PROFILE_ID"]);

                self::$http_param_handle["BULLETLIST_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'overlay_fullscrn_bulletlist_id'));
                $this->collectNewElementID('BULLETLIST_ID', self::$http_param_handle["BULLETLIST_ID"]);

                self::$http_param_handle["COMPONENT_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'overlay_fullscrn_component_id'));
                $this->collectNewElementID('COMPONENT_ID', self::$http_param_handle["COMPONENT_ID"]);

                self::$http_param_handle["ELEMENT_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'bulletlist_bullet_element_id'));
                $this->collectNewElementID('ELEMENT_ID', self::$http_param_handle["ELEMENT_ID"]);

                self::$http_param_handle["BULLET_SEQUENCE"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'bulletlist_bullet_sequence');
                self::$http_param_handle["ACTION_TYPE"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'action_type');
                self::$http_param_handle["COMPONENT_TYPE_KEY"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'component_type_key');
                self::$http_param_handle["COMPONENT_COUNT"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'page_current_component_count');

                self::$http_param_handle["BULLET_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'overlay_fullscrn_bulletlist_bullet_id'));
                self::$http_param_handle["BULLET_COPY"] = htmlentities(self::$oEnv->oHTTP_MGR->extractData($_POST, 'bulletlist_bullet_copy'));
                self::$http_param_handle["BULLETLIST_IS_ORDERED"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'bulletlist_isordered');
                self::$http_param_handle["BULLET_BULLET_STYLE"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'bulletlist_bullet_style');
                self::$http_param_handle["BULLET_COPY_IS_BOLD"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'bulletlist_bullet_text_bold');
                self::$http_param_handle["BULLET_POINT_DELETE"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'bulletlist_bullet_point_delete');
                self::$http_param_handle["BULLETLIST_DELETE"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'bulletlist_delete');

                self::$http_param_handle["LANG_ID"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'new_elem_lang_id');

                break;
            case 'update_schedule_time_format':
            case 'update_schedule_date_format':
            case 'insert_schedule_element':

                self::$http_param_handle["PAGE_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'overlay_fullscrn_page_id'));
                $this->collectNewElementID('PAGE_ID', self::$http_param_handle["PAGE_ID"]);

                self::$http_param_handle["PROFILE_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'overlay_fullscrn_profile_id'));
                $this->collectNewElementID('PROFILE_ID', self::$http_param_handle["PROFILE_ID"]);

                self::$http_param_handle["SCHEDULE_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'overlay_fullscrn_schedule_id'));
                $this->collectNewElementID('SCHEDULE_ID', self::$http_param_handle["SCHEDULE_ID"]);

                self::$http_param_handle["COMPONENT_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'overlay_fullscrn_component_id'));
                $this->collectNewElementID('COMPONENT_ID', self::$http_param_handle["COMPONENT_ID"]);

                self::$http_param_handle["ELEMENT_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'schedule_event_element_id'));
                $this->collectNewElementID('ELEMENT_ID', self::$http_param_handle["ELEMENT_ID"]);

                self::$http_param_handle["EVENT_ID"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'overlay_fullscrn_schedule_event_id');
                $this->collectNewElementID('EVENT_ID', self::$http_param_handle["EVENT_ID"]);

                self::$http_param_handle["DAY_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'overlay_fullscrn_schedule_day_id'));
                $this->collectNewElementID('DAY_ID', self::$http_param_handle["DAY_ID"]);

                self::$http_param_handle["ACTION_TYPE"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'action_type');
                self::$http_param_handle["COMPONENT_TYPE_KEY"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'component_type_key');
                self::$http_param_handle["DATE_FORMAT"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'schedule_date_format');
                self::$http_param_handle["DATE_FORMAT_EN"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'schedule_date_format_en');
                self::$http_param_handle["TIME_FORMAT"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'schedule_time_format');
                self::$http_param_handle["TIME_FORMAT_EN"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'schedule_time_format_en');
                self::$http_param_handle["DATE_DAY"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'schedule_date_day');
                self::$http_param_handle["DATE_MONTH"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'schedule_date_month');
                self::$http_param_handle["DATE_YEAR"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'schedule_date_year');

                self::$http_param_handle["COMPONENT_COUNT"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'page_current_component_count');

                //
                // MAY SPLIT TIME INTO HOUR...MIN...PARAMS DUE TO POTENTIAL MULTI-LANG PACK SUPPORT NEEDS
                self::$http_param_handle["EVENT_HOUR"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'schedule_event_hour');
                self::$http_param_handle["EVENT_MINUTE"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'schedule_event_minute');
                self::$http_param_handle["EVENT_AMPM"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'schedule_event_ampm');
                self::$http_param_handle["EVENT_DESCRIPTION"] = htmlentities(self::$oEnv->oHTTP_MGR->extractData($_POST, 'schedule_event_description'));
                self::$http_param_handle["EVENT_DESCRIPTION_BOLD"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'schedule_event_description_bold');

                self::$http_param_handle["EVENT_DELETE_AUTHORIZED"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'schedule_event_delete');
                self::$http_param_handle["DAY_DELETE_AUTHORIZED"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'schedule_day_delete');
                self::$http_param_handle["EVENT_DELETE_AUTHORIZED"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'schedule_event_delete');

                self::$http_param_handle["LANG_ID"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'new_elem_lang_id');

                break;

        }

        return self::$oDBIntegrate->processUserRequest($handle, $this, self::$oEnv);

    }

    public function addNewUserType(){

        self::$http_param_handle["USER_PERMISSIONS_ID"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'user_permissions_id');
        self::$http_param_handle["NAME"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'type_name');
        self::$http_param_handle["DESCRIPTION"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'description');
        self::$http_param_handle["POSTID"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'postid');

        //
        // PROCESS sys_add_new_user_type
        return self::$oDBIntegrate->processUserRequest(self::$http_param_handle["POSTID"], $this, self::$oEnv);

    }

    public function addNewSystemComponent(){

        //self::$http_param_handle["COLOR_APPLICATION_KEY"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'color_type'));
        self::$http_param_handle["NAME"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'component_name');
        self::$http_param_handle["DESCRIPTION"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'component_description');
        self::$http_param_handle["TYPE_KEY"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'component_key');
        self::$http_param_handle["URI_NEW"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'component_uri_new');

        //
        // PROCESS
        return self::$oDBIntegrate->processUserRequest('sys_add_new_component', $this, self::$oEnv);

    }

    public function addNewSystemColor(){

        self::$http_param_handle["COLOR_APPLICATION_KEY"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'color_type'));
        self::$http_param_handle["COLOR_HEX"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'color_hex');
        self::$http_param_handle["COLOR_NAME"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'color_name');

        //
        // PROCESS
        return self::$oDBIntegrate->processUserRequest('sys_add_new_color', $this, self::$oEnv);

    }

    public function updatePageBGOpacity(){

        self::$http_param_handle["PAGE_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'overlay_fullscrn_page_id'));
        self::$http_param_handle["OPACITY"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'overlay_fullscrn_page_opacity');
        self::$http_param_handle["PROFILE_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'overlay_fullscrn_profile_id'));

        $this->collectNewElementID('PAGE_ID', self::$http_param_handle["PAGE_ID"]);
        $this->collectNewElementID('PROFILE_ID', self::$http_param_handle["PROFILE_ID"]);

        //
        // PROCESS
        return self::$oDBIntegrate->processUserRequest('update_page_bg_opacity', $this, self::$oEnv);

    }

    public function updatePageBGColor(){

        self::$http_param_handle["BG_COLOR_HEX"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'overlay_elem_bg_color');
        self::$http_param_handle["PAGE_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'overlay_fullscrn_page_id'));
        self::$http_param_handle["PROFILE_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'overlay_fullscrn_profile_id'));

        $this->collectNewElementID('PAGE_ID', self::$http_param_handle["PAGE_ID"]);
        $this->collectNewElementID('PROFILE_ID', self::$http_param_handle["PROFILE_ID"]);

        //
        // PROCESS
        return self::$oDBIntegrate->processUserRequest('update_page_bg_color', $this, self::$oEnv);

    }

    public function pageElementExists_BOOL($oDB_RESP, $component_type, $lang_id){

        $tmp_serial_handle = 'OBS_FULLSCRN_PAGE_DATA';

        $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_ELEM');

        for ($iii = 0; $iii < $tmp_loop_size; $iii++) {
            $tmp_elem_component_type = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_ELEM', 'COMPONENT_TYPE', $iii);
            $tmp_elem_lang_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_ELEM', 'LANG_ID', $iii);

            if (($tmp_elem_lang_id == $lang_id) && ($tmp_elem_component_type==$component_type)) {
                return true;
            }

        }

        return false;
    }

    public function addNewPageTitle(){
        self::$http_param_handle["LANG_ID"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'new_elem_lang_id');
        self::$http_param_handle["PAGE_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'overlay_fullscrn_page_id'));
        self::$http_param_handle["PROFILE_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'overlay_fullscrn_profile_id'));
        self::$http_param_handle["TITLE_COPY"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'title_copy');

        $this->collectNewElementID('PAGE_ID', self::$http_param_handle["PAGE_ID"]);
        $this->collectNewElementID('PROFILE_ID', self::$http_param_handle["PROFILE_ID"]);

        //
        // PROCESS SIGN UP REQUEST
        return self::$oDBIntegrate->processUserRequest('obs_fullscrn_page_new_title', $this, self::$oEnv);

    }

    public function editPageTitle(){
        self::$http_param_handle["LANG_ID"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'new_elem_lang_id');
        self::$http_param_handle["PAGE_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'overlay_fullscrn_page_id'));
        self::$http_param_handle["PROFILE_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'overlay_fullscrn_profile_id'));
        self::$http_param_handle["TITLE_COPY"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'title_copy');
        self::$http_param_handle["COMPONENT_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'component_id'));
        self::$http_param_handle["COPY_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'copy_id'));

        $this->collectNewElementID('PAGE_ID', self::$http_param_handle["PAGE_ID"]);
        $this->collectNewElementID('PROFILE_ID', self::$http_param_handle["PROFILE_ID"]);

        //
        // PROCESS SIGN UP REQUEST
        return self::$oDBIntegrate->processUserRequest('obs_fullscrn_page_edit_title', $this, self::$oEnv);

    }

    public function addNewPageHeader(){
        self::$http_param_handle["LANG_ID"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'new_elem_lang_id');
        self::$http_param_handle["PAGE_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'overlay_fullscrn_page_id'));
        self::$http_param_handle["HEADER_COPY"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'header_copy');
        self::$http_param_handle["PROFILE_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'overlay_fullscrn_profile_id'));

        $this->collectNewElementID('PAGE_ID', self::$http_param_handle["PAGE_ID"]);
        $this->collectNewElementID('PROFILE_ID', self::$http_param_handle["PROFILE_ID"]);

        //
        // PROCESS SIGN UP REQUEST
        return self::$oDBIntegrate->processUserRequest('obs_fullscrn_page_new_header', $this, self::$oEnv);

    }

    public function editPageHeader(){
        self::$http_param_handle["LANG_ID"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'new_elem_lang_id');
        self::$http_param_handle["PAGE_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'overlay_fullscrn_page_id'));
        self::$http_param_handle["HEADER_COPY"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'header_copy');
        self::$http_param_handle["PROFILE_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'overlay_fullscrn_profile_id'));
        self::$http_param_handle["COMPONENT_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'component_id'));
        self::$http_param_handle["COPY_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'copy_id'));

        $this->collectNewElementID('PAGE_ID', self::$http_param_handle["PAGE_ID"]);
        $this->collectNewElementID('PROFILE_ID', self::$http_param_handle["PROFILE_ID"]);

        //
        // PROCESS SIGN UP REQUEST
        return self::$oDBIntegrate->processUserRequest('obs_fullscrn_page_edit_header', $this, self::$oEnv);

    }

    public function obs_client_mini_display_mode(){
        self::$http_param_handle["OBS_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'obs_id'));
        self::$http_param_handle["OBSCLIENT_ID"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'obsclient_id');
        self::$http_param_handle["MINI_DISPLAY_MODE"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'mini_display_mode');
        self::$http_param_handle["POSTID"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'postid');

        //
        // PROCESS SIGN UP REQUEST
        return self::$oDBIntegrate->processUserRequest('obs_client_mini_display_mode', $this, self::$oEnv);

    }

    public function obs_client_fullscrn_overlay_visibility(){
        self::$http_param_handle["OBS_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'obs_id'));
        self::$http_param_handle["OBSCLIENT_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'obsclient_id'));
        self::$http_param_handle["FULLSCRN_ISVISIBLE"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'fullscrn_isvisible');
        self::$http_param_handle["POSTID"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'postid');

        //
        // PROCESS SIGN UP REQUEST
        return self::$oDBIntegrate->processUserRequest('obs_client_fullscrn_overlay_visibility', $this, self::$oEnv);

    }

    public function obs_client_mini_overlay_visibility(){
        self::$http_param_handle["OBS_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'obs_id'));
        self::$http_param_handle["OBSCLIENT_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'obsclient_id'));
        self::$http_param_handle["MINI_ISVISIBLE"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'mini_isvisible');
        self::$http_param_handle["POSTID"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'postid');

        //
        // PROCESS SIGN UP REQUEST
        return self::$oDBIntegrate->processUserRequest('obs_client_mini_overlay_visibility', $this, self::$oEnv);

    }

    public function obs_client_profile_update_fullscrn(){
        self::$http_param_handle["OBSCLIENT_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'obs_id'));
        self::$http_param_handle["PROFILE_ID"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'fullscrn_profile_id');

        error_log('905 - OBSCLIENT_ID['.self::$http_param_handle["OBSCLIENT_ID"].'] PROFILE_ID['.self::$http_param_handle["PROFILE_ID"].']');

        //
        // PROCESS SIGN UP REQUEST
        return self::$oDBIntegrate->processUserRequest('obs_client_profile_update_fullscrn', $this, self::$oEnv);

    }

    public function obs_client_profile_update_mini(){
        self::$http_param_handle["OBSCLIENT_ID"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'obs_id');
        self::$http_param_handle["PROFILE_ID"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'mini_profile_id');

        //
        // PROCESS SIGN UP REQUEST
        return self::$oDBIntegrate->processUserRequest('obs_client_profile_update_mini', $this, self::$oEnv);

    }

    public function createFullScrnOverlayPage(){

        self::$http_param_handle["PAGE_NAME"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'page_name');
        self::$http_param_handle["BGCOLOR_HEX"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'bg_color');
        self::$http_param_handle["OPACITY"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'bg_opacity');
        self::$http_param_handle["PROFILE_ID"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'profile_id');

        //
        // PROCESS SIGN UP REQUEST
        //return self::$oDBIntegrate->processNewSignup($this, self::$oEnv);
        return self::$oDBIntegrate->processUserRequest('create_fullscrn_overlay_page', $this, self::$oEnv);

    }

    public function createFullScrnOverlay(){

        self::$http_param_handle["PROFILE_NAME"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'fullscrn_name');
        self::$http_param_handle["BGCOLOR_HEX"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'bg_color');
        self::$http_param_handle["OPACITY"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'bg_opacity');

        //
        // PROCESS SIGN UP REQUEST
        //return self::$oDBIntegrate->processNewSignup($this, self::$oEnv);
        return self::$oDBIntegrate->processUserRequest('create_fullscrn_overlay', $this, self::$oEnv);

    }

    public function syncServerToClient(){

        //
        // THERE ARE _GET PARAMS. RETRIEVE AND RESPOND ACCORDINGLY.
        // LOOKING FOR :: [obs_id, t, xml, mini_vs, fullscrn_vs]
        self::$http_param_handle["OBS_ID"] = self::$oEnv->oHTTP_MGR->extractData($_GET, 'obs_id');
        self::$http_param_handle["CURRENT_WALL_TIME"] = self::$oEnv->oHTTP_MGR->extractData($_GET, 't');
        self::$http_param_handle["XML_REQUESTED"] = self::$oEnv->oHTTP_MGR->extractData($_GET, 'xml');
        self::$http_param_handle["MINI_VIEW_STATE"] = self::$oEnv->oHTTP_MGR->extractData($_GET, 'mini_vs');
        self::$http_param_handle["FULLSCRN_VIEW_STATE"] = self::$oEnv->oHTTP_MGR->extractData($_GET, 'fullscrn_vs');
        self::$http_param_handle["LANG_PACK_FULLSCRN"] = self::$oEnv->oHTTP_MGR->extractData($_GET, 'iso_fs');
        self::$http_param_handle["LANG_PACK_MINI"] = self::$oEnv->oHTTP_MGR->extractData($_GET, 'iso_m');

        return self::$oDBIntegrate->processUserRequest('sync_server_return_index_dir_path', $this, self::$oEnv);

    }

    public function getOBSMiniProfileData($handle){

        if(isset($handle)){
            self::$db_response_serial_handle_ARRAY[] = $handle;
            self::$http_param_handle["PROFILE_ID"] = self::$oEnv->oHTTP_MGR->extractData($_GET, 'pid');

            return self::$oDBIntegrate->processUserRequest('get_obs_mini_profile_data', $this, self::$oEnv);

        }else {
            //
            // HOOOSTON...VE HAF PROBLEM!
            self::$oLogger->captureNotice('user->getOBSMiniProfileData() FAILURE', LOG_EMERG, 'No database response handle has been provided.');

        }

    }

    public function getOBSFullScrnPageData($handle){

        if(isset($handle)){
            self::$db_response_serial_handle_ARRAY[] = $handle;
            self::$http_param_handle["PAGE_ID"] = self::$oEnv->oHTTP_MGR->extractData($_GET, 'pid');
            self::$http_param_handle["PROFILE_ID"] = self::$oEnv->oHTTP_MGR->extractData($_GET, 'oid');
            self::$http_param_handle["COMPONENT_ID"] = self::$oEnv->oHTTP_MGR->extractData($_GET, 'cid');

            return self::$oDBIntegrate->processUserRequest('get_obs_fullscrn_page_data', $this, self::$oEnv);

        }else {
            //
            // HOOOSTON...VE HAF PROBLEM!
            self::$oLogger->captureNotice('user->getOBSFullScrnPageData() FAILURE', LOG_EMERG, 'No database response handle has been provided.');

        }

    }

    public function getOBSFullScrnProfileData($handle){

        if(isset($handle)){
            self::$db_response_serial_handle_ARRAY[] = $handle;
            self::$http_param_handle["PROFILE_ID"] = self::$oEnv->oHTTP_MGR->extractData($_GET, 'pid');

            return self::$oDBIntegrate->processUserRequest('get_obs_fullscrn_profile_data', $this, self::$oEnv);

        }else {
            //
            // HOOOSTON...VE HAF PROBLEM!
            self::$oLogger->captureNotice('user->getOBSFullScrnProfileData() FAILURE', LOG_EMERG, 'No database response handle has been provided.');

        }

    }

    public function getOBSClientProfileData($handle){

        if(isset($handle)){
            self::$db_response_serial_handle_ARRAY[] = $handle;
            self::$http_param_handle["OBSCLIENT_ID"] = self::$oEnv->oHTTP_MGR->extractData($_GET, 'obs_cid');

            return self::$oDBIntegrate->processUserRequest('get_obs_client_profile_data', $this, self::$oEnv);
        }else {
            //
            // HOOOSTON...VE HAF PROBLEM!
            self::$oLogger->captureNotice('user->getOBSClientProfileData() FAILURE', LOG_EMERG, 'No database response handle has been provided.');

        }

    }

    public function getTranslationToPublishData($handle){


        if(self::$oEnv->oHTTP_MGR->issetParam($_GET, 'eid')){

            self::$http_param_handle["REFERENCE_KEY"] = '';
            //error_log('791 Encrypt URI Output-->'.self::$oEnv->oHTTP_MGR->extractData($_GET, 'eid'));
            //error_log('792 _GET[eid] Output-->'.$_GET['eid']);
            self::$http_param_handle["ELEMENT_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_GET, 'eid'), true);
            //error_log('793 Decrypt URI Output-->'.self::$http_param_handle["TRANSLATION_ELEMENT_ID"]);
            self::$http_param_handle["COPY_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_GET, 'cpyid'), true);

        }

        self::$http_param_handle["LANG_ID_TRANSLATION"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_GET, 'lang_id'), true);
        self::$http_param_handle["LANG_ID_TRANSLATOR"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_GET, 'lit'), true);

        if(isset($handle)){
            self::$db_response_serial_handle_ARRAY[] = $handle;

            return self::$oDBIntegrate->processUserRequest('get_translation_select_data', $this, self::$oEnv);

        }else {
            //
            // HOOOSTON...VE HAF PROBLEM!
            self::$oLogger->captureNotice('user->getTranslationToPublishData() FAILURE', LOG_EMERG, 'No database response handle has been provided.');

        }

    }


    public function getTranslationSelectData($handle){

        if(self::$oEnv->oHTTP_MGR->issetParam($_GET, 'rk')){
            self::$http_param_handle["REFERENCE_KEY"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_GET, 'rk'), true);
            self::$http_param_handle["ELEMENT_ID"] = '';
            self::$http_param_handle["COPY_ID"] = '';

        }else{

            if(self::$oEnv->oHTTP_MGR->issetParam($_GET, 'eid')){

                self::$http_param_handle["REFERENCE_KEY"] = '';
                //error_log('791 Encrypt URI Output-->'.self::$oEnv->oHTTP_MGR->extractData($_GET, 'eid'));
                //error_log('792 _GET[eid] Output-->'.$_GET['eid']);
                self::$http_param_handle["ELEMENT_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_GET, 'eid'), true);
                //error_log('793 Decrypt URI Output-->'.self::$http_param_handle["TRANSLATION_ELEMENT_ID"]);
                self::$http_param_handle["COPY_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_GET, 'cpyid'), true);

            }
        }

        self::$http_param_handle["LANG_ID_TRANSLATION"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_GET, 'lang_id'), true);

        //error_log('_GET LANG_ID_TRANSLATOR->'.self::$oEnv->oHTTP_MGR->extractData($_GET, 'lit'));
        self::$http_param_handle["LANG_ID_TRANSLATOR"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_GET, 'lit'), true);
        //error_log('LANG_ID_TRANSLATOR _GET Done->'.self::$http_param_handle["LANG_ID_TRANSLATOR"]);
        //error_log('LANG_ID_TRANSLATION _GET Done->'.self::$http_param_handle["LANG_ID_TRANSLATION"]);

        if(isset($handle)){
            self::$db_response_serial_handle_ARRAY[] = $handle;

            return self::$oDBIntegrate->processUserRequest('get_translation_select_data', $this, self::$oEnv);

        }else {
            //
            // HOOOSTON...VE HAF PROBLEM!
            self::$oLogger->captureNotice('user->getTranslationSelectData() FAILURE', LOG_EMERG, 'No database response handle has been provided.');

        }

    }

    public function getSiteActivityLogs($handle){

        if(isset($handle)){
            self::$db_response_serial_handle_ARRAY[] = $handle;

            return self::$oDBIntegrate->processUserRequest('get_site_activity_logs', $this, self::$oEnv);

        }else {
            //
            // HOOOSTON...VE HAF PROBLEM!
            self::$oLogger->captureNotice('user->getTranslationData() FAILURE', LOG_EMERG, 'No database response handle has been provided.');

        }

    }

    public function getTranslationData($handle){

        if(isset($handle)){
            self::$db_response_serial_handle_ARRAY[] = $handle;

            return self::$oDBIntegrate->processUserRequest('get_translation_data', $this, self::$oEnv);

        }else {
            //
            // HOOOSTON...VE HAF PROBLEM!
            self::$oLogger->captureNotice('user->getTranslationData() FAILURE', LOG_EMERG, 'No database response handle has been provided.');

        }

    }

    public function getOBSClientData($handle){

        if(isset($handle)){
            self::$db_response_serial_handle_ARRAY[] = $handle;

            return self::$oDBIntegrate->processUserRequest('get_obs_client_data', $this, self::$oEnv);
        }else {
            //
            // HOOOSTON...VE HAF PROBLEM!
            self::$oLogger->captureNotice('user->getOBSClientData() FAILURE', LOG_EMERG, 'No database response handle has been provided.');

        }

    }

    public function getUserStreamData($handle){
        if(isset($handle)){
            self::$db_response_serial_handle_ARRAY[] = $handle;

            return self::$oDBIntegrate->processUserRequest('get_user_stream_data', $this, self::$oEnv);
        }else {
            //
            // HOOOSTON...VE HAF PROBLEM!
            self::$oLogger->captureNotice('user->getUserStreamData() FAILURE', LOG_EMERG, 'No database response handle has been provided.');

        }

    }

    public function prepStreamDeepData($handle){
        if(isset($handle)){
            self::$db_response_serial_handle_ARRAY[] = $handle;

            return self::$oDBIntegrate->processUserRequest('get_deep_stream_support_data', $this, self::$oEnv);
        }else {
            //
            // HOOOSTON...VE HAF PROBLEM!
            self::$oLogger->captureNotice('user->prepStreamDeepData() FAILURE', LOG_EMERG, 'No database response handle has been provided.');

        }
    }

    public function getUserFullRecent($handle){
        if(isset($handle)){
            self::$db_response_serial_handle_ARRAY[] = $handle;
            self::$http_param_handle["USER_ID"] = self::$oEnv->oHTTP_MGR->extractData($_GET, 'uid');

            return self::$oDBIntegrate->processUserRequest('get_user_recent_data', $this, self::$oEnv);
        }else {
            //
            // HOOOSTON...VE HAF PROBLEM!
            self::$oLogger->captureNotice('user->getUserHomeData() FAILURE', LOG_EMERG, 'No database response handle has been provided.');

        }

    }

    public function getUserHomeData($handle){
        if(isset($handle)){
            self::$db_response_serial_handle_ARRAY[] = $handle;
            self::$http_param_handle["USER_ID"] = self::$oEnv->oHTTP_MGR->extractData($_GET, 'uid');

            return self::$oDBIntegrate->processUserRequest('get_user_home_page_data', $this, self::$oEnv);
        }else {
            //
            // HOOOSTON...VE HAF PROBLEM!
            self::$oLogger->captureNotice('user->getUserHomeData() FAILURE', LOG_EMERG, 'No database response handle has been provided.');

        }
    }

    public function processNewSignup(){

        self::$http_param_handle["FIRSTNAME"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'fname_signup_mobile');
        self::$http_param_handle["LASTNAME"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'lname_signup_mobile');
        self::$http_param_handle["EMAIL"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'email_signup_mobile');
        self::$http_param_handle["PWDHASH"] = md5(self::$oEnv->oHTTP_MGR->extractData($_POST, 'pwd'));
        self::$http_param_handle["PWDCONFIRM"] = md5(self::$oEnv->oHTTP_MGR->extractData($_POST, 'pwd_cnfrm'));
        self::$http_param_handle["SERVICE"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'select_service_type'));
        self::$http_param_handle["LOCALITY"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'locality');

        self::$http_param_handle["LANG_ID_PIPED"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'translation_lang_select');

        self::$http_param_handle["LANGCODE"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'LANGCODE');

        //
        // PROCESS SIGN UP REQUEST
        return self::$oDBIntegrate->processUserRequest('signup_main', $this, self::$oEnv);

    }

    public function activate(){
        $tmp_response = explode('&persist=',$this->activateAccount());
        //accountactivate=true
        switch($tmp_response[0]){
            case 'accountactivate=false':
                $this->transactionStatusUpdate('error','account_activate');
                break;
            case 'accountactivate=falseall':
                $this->transactionStatusUpdate('error','activate_falseall');
                break;
            case 'accountactivate=true':
                $this->transactionStatusUpdate('success','account_activate');
                break;
            case 'accountactivate=donealready':
                $this->transactionStatusUpdate('success','activate_donealready');
                break;
            case 'accountactivate=dataerror_null':
                $this->transactionStatusUpdate('error','activate_datanull');
                break;
            case 'accountactivate=dataerror_redun':
                $this->transactionStatusUpdate('error','activate_dataredun');
                break;
        }
    }

    private function activateAccount(){

        self::$http_param_handle["ACTIVATEKEY"] = self::$oEnv->oHTTP_MGR->extractData($_GET, 'ak');
        self::$http_param_handle["USERID"] = self::$oEnv->oHTTP_MGR->extractData($_GET, 'uid');

        //
        // PROCESS ACCOUNT ACTIVATION
        return self::$oDBIntegrate->processUserRequest('activate_account', $this, self::$oEnv);

    }

    private function convert_jquery_chkbx_data_to_int($chkbx_value){

        switch($chkbx_value){
            case 'on':
                return 1;
                break;
            default:
                return 0;
                break;

        }

    }

    public function processHomeContact(){
        //
        // BUILD CONTACT DATA PROFILE
        self::$http_param_handle["FIRSTNAME"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'fname');
        self::$http_param_handle["LASTNAME"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'lname');
        self::$http_param_handle["EMAIL"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'email');
        self::$http_param_handle["MOBILENUMBER"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'mobilenumber');
        self::$http_param_handle["MESSAGE"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'feedback');
        self::$http_param_handle["CHK_ASSIST_ACCNT_CREATION"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'ASSIST_ACCNT_CREATION');
        self::$http_param_handle["CHK_ASSIST_OBS_INTEGRATE"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'ASSIST_OBS_INTEGRATE');
        self::$http_param_handle["LANGCODE"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'LANGCODE');

        self::$http_param_handle["CHK_ASSIST_ACCNT_CREATION"] = $this->convert_jquery_chkbx_data_to_int(self::$http_param_handle["CHK_ASSIST_ACCNT_CREATION"]);
        self::$http_param_handle["CHK_ASSIST_OBS_INTEGRATE"] = $this->convert_jquery_chkbx_data_to_int(self::$http_param_handle["CHK_ASSIST_OBS_INTEGRATE"]);

        if(self::$http_param_handle["FIRSTNAME"]==""){
            $this->errorMessage_ARRAY['fname'] = "Firstname is required.";
            $this->validFrom = false;
        }

        if(self::$http_param_handle["LASTNAME"]==""){
            $this->errorMessage_ARRAY['lname'] = "Lastname is required.";
            $this->validFrom = false;
        }

        if(self::$http_param_handle["EMAIL"]==""){
            $this->errorMessage_ARRAY['email'] = "Email is required.";
            $this->validFrom = false;
        }

        if(!$this->validFrom){
            return "contact_home=false";
        }

        //
        // PROCESS CONTACT REQUEST
        return self::$oDBIntegrate->processUserRequest('contact_home', $this, self::$oEnv);

    }

    public function syncISOcode(){
        if(self::$oEnv->oHTTP_MGR->extractData($_GET, 'isocode')!=""){

            //
            // EXTRACT DATA FROM ISO PARAM

            if(self::$oEnv->oHTTP_MGR->extractData($_GET, 'isocode')!=strtolower(self::$oEnv->oSESSION_MGR->getSessionParam("LANGCODE"))){
                self::$oEnv->oSESSION_MGR->setSessionParam("LANGCODE", strtoupper(self::$oEnv->oHTTP_MGR->extractData($_GET, 'isocode')));

                //
                // IF USER LOGGED IN...UPDATE LANGCODE IN DATABASE FOR PROFILE.
                if(self::$oEnv->oSESSION_MGR->getSessionParam('USER_PERMISSIONS_ID')>10){

                    self::$http_param_handle["LANGCODE"] = strtoupper(self::$oEnv->oHTTP_MGR->extractData($_GET, 'isocode'));

                    //
                    // UPDATE USER PROFILE
                    self::$oDBIntegrate->processUserRequest('sync_LANGCODE', $this, self::$oEnv);

                }

                //
                // CLEAR THIS TO FORCE REBUILD OF COMBO HTML
                self::$oEnv->oSESSION_MGR->setSessionParam("LANG_SUPPORT_PACKS", NULL);
            }
        }else{
            if(self::$oEnv->oSESSION_MGR->getSessionParam("LANGCODE")==""){

                self::$oEnv->oSESSION_MGR->setSessionParam("LANGCODE","EN");
            }

        }
    }

    public function loadLangComboHTML(){

        //
        // LOAD LANGUAGE SUPPORT DATA FROM SESSION FIRST.
        if(self::$oEnv->oSESSION_MGR->issetSessionParam("LANG_SUPPORT_PACKS")){

            //
            // WE HAVE LANG DATA TO SIMPLY RETURN
            $this->langComboHTML = self::$oEnv->oSESSION_MGR->getSessionParam("LANG_SUPPORT_PACKS");

        }else{

            /*
        self::$query = 'SELECT `sys_lang_type`.`LANG_ID`, `sys_lang_type`.`COUNTRY_ISO_CODE`, `sys_lang_type`.`COUNTRY_ISO_NAME`,
        `sys_lang_type`.`NATIVE_NAME`, `sys_lang_type`.`RTL_FLAG`, `sys_lang_type`.`DATEMODIFIED`, `sys_lang_type`.`DATECREATED` FROM `sys_lang_type`;';

        self::$query .= 'SELECT `sys_lang_elements`.`COUNTRY_ISO_CODE`, COUNT(*) AS `ELEMENTS` FROM `sys_lang_elements` GROUP BY `COUNTRY_ISO_CODE`;';


        <option value="COUNTRY_ISO_CODE">NATIVE_NAME</option>

            */

            $tmp_sysLangData = $this->getSystemLanguages();

            $tmp_COMBO_LangData = array();
            $tmp_COMBOSel_LangData = array();
            $tmp_COMBO_LangISO = array();
            $tmp_ElemCnt_ARRAY = array();
            $tmp_cnt_lang = 0;
            $tmp_golden_count = NULL;

            $tmp_loop_size = sizeof($tmp_sysLangData);
            for($i=0;$i<$tmp_loop_size;$i++){
                if(is_array($tmp_sysLangData[$i])){
                    if(sizeof($tmp_sysLangData[$i])==7){
                        $tmp_COMBO_LangData[$tmp_cnt_lang] = '<option value="'.$tmp_sysLangData[$i][1].'">'.$tmp_sysLangData[$i][3].'</option>';
                        $tmp_COMBOSel_LangData[$tmp_cnt_lang] = '<option value="'.$tmp_sysLangData[$i][1].'" selected>'.$tmp_sysLangData[$i][3].'</option>';
                        $tmp_COMBO_LangISO[$tmp_cnt_lang] = $tmp_sysLangData[$i][1];

                        $tmp_cnt_lang++;
                    }else{

                        //
                        // STORE ENGLISH STANDARD
                        if($tmp_sysLangData[$i][0]=="en"){
                            $tmp_golden_count = (int) $tmp_sysLangData[$i][1];
                            $tmp_ElemCnt_ARRAY[$tmp_sysLangData[$i][0]] = (int) $tmp_sysLangData[$i][1];
                        }else{

                            $tmp_ElemCnt_ARRAY[$tmp_sysLangData[$i][0]] = (int) $tmp_sysLangData[$i][1];

                        }
                    }
                }
            }

            //
            // BUILD COMBO HTML
            $tmp_queue_size = sizeof($tmp_COMBO_LangData);
            for($i=0;$i<$tmp_queue_size;$i++){
                if(isset($tmp_ElemCnt_ARRAY[$tmp_COMBO_LangISO[$i]])){
                    if($tmp_ElemCnt_ARRAY[$tmp_COMBO_LangISO[$i]]==$tmp_golden_count){

                        if($tmp_COMBO_LangISO[$i]==strtolower(self::$oEnv->oSESSION_MGR->getSessionParam("LANGCODE"))){
                            $this->langComboHTML .= $tmp_COMBOSel_LangData[$i];
                        }else{
                            $this->langComboHTML .= $tmp_COMBO_LangData[$i];
                        }
                    }
                }
            }

            self::$oEnv->oSESSION_MGR->setSessionParam("LANG_SUPPORT_PACKS", $this->langComboHTML);

        }

    }

    public function prepLangElem($pipe_array, $isocode=NULL){

        self::$db_response_serial_handle_ARRAY[] = 'SYS_LANG';

        //
        // THIS CODE IS SO SIMPLE AND EFFICIENT. TO TAKE IT OOP WOULD SAVE WHAT??
        // EMAIL CHANNEL WILL HAVE ISO SET
        if(isset($isocode)){
            self::$http_param_handle["COUNTRY_ISO_CODE"] = strtolower($isocode);
        }else{
            self::$http_param_handle["COUNTRY_ISO_CODE"] = strtolower(self::$oEnv->oSESSION_MGR->getSessionParam("LANGCODE"));
        }

        self::$http_param_handle["ELEMENT_PIPE_ARRAY"] = $pipe_array;

        //
        // ALL LANG ELEMENTS STORED WITHIN DATABASE RESPONSE OBJECT
        self::$oDB_RESP = self::$oDBIntegrate->processRequest('pull_page_lang_elements', $this, self::$oEnv);

    }

    public function getLangElem($key, $isocode=NULL){

        if(isset(self::$oDB_RESP)){
            if(isset($isocode)){

                //
                // SHOULD BE AS SIMPLE AS THIS
                return self::$oDB_RESP->retrieveDataByID(self::$oDB_RESP->return_serial('SYS_LANG'), $isocode."_".$key, $isocode."|".$key , 'ELEMENT_CONTENT');

            }else {
                return self::$oDB_RESP->retrieveDataByID(self::$oDB_RESP->return_serial('SYS_LANG'), strtolower(self::$oEnv->oSESSION_MGR->getSessionParam("LANGCODE"))."_".$key, strtolower(self::$oEnv->oSESSION_MGR->getSessionParam("LANGCODE"))."|".$key , 'ELEMENT_CONTENT');

            }

        }else{

            //
            // EMAIL CHANNEL WILL HAVE ISO SET
            if(isset($isocode)){

                //
                // SHOULD BE AS SIMPLE AS THIS
                return $this->langElem_ARRAY[strtolower($isocode)][$key];

            }else{
                if(isset($this->langElem_ARRAY[strtolower(self::$oEnv->oSESSION_MGR->getSessionParam("LANGCODE"))][$key])){

                    return $this->langElem_ARRAY[strtolower(self::$oEnv->oSESSION_MGR->getSessionParam("LANGCODE"))][$key];

                }else{

                    return '';

                }

            }

        }

    }

    public function syncDevice(){
        if(self::$oEnv->oHTTP_MGR->extractData($_GET, 'dtype')!=""){

            //
            // EXTRACT DATA FROM ISO PARAM
            if(self::$oEnv->oHTTP_MGR->extractData($_GET, 'dtype')!=strtolower(self::$oEnv->oSESSION_MGR->getSessionParam("DEVICETYPE"))){
                self::$oEnv->oSESSION_MGR->setSessionParam("DEVICETYPE", strtolower(self::$oEnv->oHTTP_MGR->extractData($_GET, 'dtype')));

            }

        }else{
            if(self::$oEnv->oSESSION_MGR->getSessionParam("DEVICETYPE")==""){

                //
                // NEED TO DETERMINE DEVICE TYPE
                require(self::$oEnv->getEnvParam('DOCUMENT_ROOT').self::$oEnv->getEnvParam('DOCUMENT_ROOT_DIR').'/common/classes/devicedetect/Mobile_Detect.php');
                $detect = new Mobile_Detect;
                if( $detect->isMobile() && !$detect->isTablet() ){
                    self::$oEnv->oSESSION_MGR->setSessionParam("DEVICETYPE","m");

                }else{
                    self::$oEnv->oSESSION_MGR->setSessionParam("DEVICETYPE","d");

                }

            }

        }
    }

    public function loadDeviceComboHTML(){
        if(self::$oEnv->oSESSION_MGR->getSessionParam("DEVICETYPE")=="m"){
            $this->deviceComboHTML = '<option value="d">'.$this->getLangElem('COMBO_SEL_DEVICE_DESKTOP').'</option><option value="m" selected>'.$this->getLangElem('COMBO_SEL_DEVICE_MOBILE').'</option>';

        }else{
            $this->deviceComboHTML = '<option value="d" selected>'.$this->getLangElem('COMBO_SEL_DEVICE_DESKTOP').'</option><option value="m">'.$this->getLangElem('COMBO_SEL_DEVICE_MOBILE').'</option>';

        }

    }

    public function displayLangComboHTML(){

        return $this->langComboHTML;
    }

    public function displayDeviceComboHTML(){
        return $this->deviceComboHTML;
    }

    public function getSystemUserTypes($handle){

        if(isset($handle)){
            self::$db_response_serial_handle_ARRAY[] = $handle;
            return self::$oDBIntegrate->processUserRequest('sys_user_type_get', $this, self::$oEnv);

        }else {
            //
            // HOOOSTON...VE HAF PROBLEM!
            self::$oLogger->captureNotice('user->getOBSMiniProfileData() FAILURE', LOG_EMERG, 'No database response handle has been provided.');

        }

    }

    public function getSystemLanguages(){

        return self::$oDBIntegrate->processUserRequest('sys_lang_get', $this, self::$oEnv);

    }

    public function push_response_serial_handle($handle){
        if(isset($handle)){
            self::$db_response_serial_handle_ARRAY[] = $handle;
        }else{
            //
            // HOOOSTON...VE HAF PROBLEM!
            self::$oLogger->captureNotice('user->push_response_handle() FAILURE', LOG_EMERG, 'No database response handle has been provided.');

        }

    }

    public function returnOverlayDeepDir(){

        # common/xml/YYYY/MM/index.xml
        $tmp_year_DIR = date('Y');
        $tmp_month_DIR = date('m');

        $tmp_target_dir_path = $this->getEnvParam('DOCUMENT_ROOT').$this->getEnvParam('DOCUMENT_ROOT_DIR');
        $tmp_target_dir_path_FULL = $tmp_target_dir_path . '/common/xml/'.$tmp_year_DIR.'/'.$tmp_month_DIR.'/';
        $tmp_target_dir_path_BASIC = '/common/xml/'.$tmp_year_DIR.'/'.$tmp_month_DIR.'/';

        //
        // CHECK FOR DIR
        if(!file_exists($tmp_target_dir_path_FULL)){

            if (!mkdir($tmp_target_dir_path_FULL, 0777, true)) {
                self::$oLogger->captureNotice('user->returnOverlayDeepDir() MKDIR() FAILURE', LOG_EMERG, 'No directory ['.$tmp_target_dir_path_FULL.'] was able to be made.');
            }else{

                return $tmp_target_dir_path_BASIC;

            }
            // $this->recurse_copy(self::$oEnv->getEnvParam('DOCUMENT_ROOT').self::$oEnv->getEnvParam('DOCUMENT_ROOT_DIR').'/assets/_file_storage/0_TEMPLATE_DIR/', self::$UPLOAD_DIR.$tmp_client_dir.$tmp_client_subdir);
            #chmod(self::$UPLOAD_DIR.$tmp_client_dir.$tmp_client_subdir, 0755);
        }else{

            return $tmp_target_dir_path_BASIC;

        }

    }

    public function return_serial_handle($pos=NULL){

        if(isset($pos)){

            $tmp_last_handle = self::$db_response_serial_handle_ARRAY[$pos];

        }else {
            //
            // RETURN REFERENCE TO DATABASE RESPONSE SERIALIZATION. LAST ELEMENT OF ARRAY.
            $tmp_last_handle = end(self::$db_response_serial_handle_ARRAY);

        }

        return $tmp_last_handle;

    }

    public function processResendActivation(){

        self::$http_param_handle["EMAIL"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'email_activate_mobile');
        self::$http_param_handle["LANGCODE"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'LANGCODE');

        if(self::$http_param_handle["EMAIL"]==""){
            $this->errorMessage_ARRAY['email_activate_mobile'] = "Email is required.";
            $this->validFrom = false;
        }

        if(!$this->validFrom){
            return "accnt_activate_resend=err";
        }

        //
        // PROCESS CONTACT REQUEST
        return self::$oDBIntegrate->processUserRequest('accnt_activate_resend', $this, self::$oEnv);

    }

    public function processUserSignin(){
        $this->errorMessage = "";

        /*
        `users_USERID`,`users_CLIENTID`,`users_ISACTIVE`,`users_USER_PERMISSIONS_ID`,`users_FIRSTNAME`,`users_LASTNAME`,`users_COMPANYNAME`,
        `users_JOBTITLE`,`users_EMAIL`,`users_PWDHASH`,`users_LANGCODE`,`users_LASTLOGIN`,`users_LASTLOGIN_IP`,`users_LOGIN_CNT`,
        `users_IMAGE_NAME`,`users_IMAGE_WIDTH`,`users_IMAGE_HEIGHT`,`users_ABOUT`

        ISACTIVE = 5 = NEW ACCOUNT PREACTIVATION
        ISACTIVE = 4 = NEW ACCOUNT POSTACTIVATION PRE-ADMIN APPROVALS
        ISACTIVE = 1 = ADMIN APPROVED ACCOUNT

        */

        self::$db_response_serial_handle_ARRAY[] = 'USER_SIGNIN_DATA';

        self::$http_param_handle["EMAIL"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'email');
        self::$http_param_handle["PWDHASH"] = md5(self::$oEnv->oHTTP_MGR->extractData($_POST, 'pwd'));
        self::$http_param_handle["EMAIL_MOBILE"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'email_signin_mobile');

        //
        // TO DODGE EMAIL FIELD ID CONFLICT BETWEEN CONTACT FORM AND SIGNIN FORM FOR MOBILE
        if(self::$http_param_handle["EMAIL_MOBILE"]!=""){
            self::$http_param_handle["EMAIL"] = self::$http_param_handle["EMAIL_MOBILE"];
        }

        //
        // PROCESS USER SIGN IN
        $tmp_serial_handle = 'USER_SIGNIN_DATA';
        self::$oDB_RESP = self::$oDBIntegrate->processUserRequest('user_signin', $this, self::$oEnv);

        #error_log("evifweb user (140) returned db array users_ISACTIVE->".$this->databaseResponse_ARRAY[0][self::$queryDescript_ARRAY['users_ISACTIVE']]);

        if(strlen(self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial(), 'USER_ACCOUNT', 'USERID'))>0 && (self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial(), 'USER_ACCOUNT', 'ISACTIVE')=="1" || self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial($tmp_serial_handle), 'USER_ACCOUNT', 'ISACTIVE')=="4")){

            //
            // WE HAVE MATCHING USER. STORE IN SESSION.
            self::$oEnv->oSESSION_MGR->setSessionParam('USERID', self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial($tmp_serial_handle), 'USER_ACCOUNT', 'USERID'));

            # DUE TO ONE TO MANY RELATION BETWEEN USER AND CLIENT...NOT STORING CLIENT_ID IN SESSION.
            #self::$oEnv->oSESSION_MGR->setSessionParam('CLIENTID', $this->databaseResponse_ARRAY[0][self::$queryDescript_ARRAY['users_CLIENTID']]);
            self::$oEnv->oSESSION_MGR->setSessionParam('ISACTIVE', self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial($tmp_serial_handle), 'USER_ACCOUNT', 'ISACTIVE'));
            self::$oEnv->oSESSION_MGR->setSessionParam('USER_PERMISSIONS_ID', self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial($tmp_serial_handle), 'USER_ACCOUNT', 'USER_PERMISSIONS_ID'));
            self::$oEnv->oSESSION_MGR->setSessionParam('FIRSTNAME', self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial($tmp_serial_handle), 'USER_ACCOUNT', 'FIRSTNAME'));
            self::$oEnv->oSESSION_MGR->setSessionParam('LASTNAME', self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial($tmp_serial_handle), 'USER_ACCOUNT', 'LASTNAME'));
            self::$oEnv->oSESSION_MGR->setSessionParam('LOCALITY', self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial($tmp_serial_handle), 'USER_ACCOUNT', 'LOCALITY'));
            self::$oEnv->oSESSION_MGR->setSessionParam('EMAIL', self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial($tmp_serial_handle), 'USER_ACCOUNT', 'EMAIL'));
            self::$oEnv->oSESSION_MGR->setSessionParam('PWDHASH', self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial($tmp_serial_handle), 'USER_ACCOUNT', 'PWDHASH'));
            self::$oEnv->oSESSION_MGR->setSessionParam('LANGCODE', self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial($tmp_serial_handle), 'USER_ACCOUNT', 'LANGCODE'));
            self::$oEnv->oSESSION_MGR->setSessionParam('LASTLOGIN', self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial($tmp_serial_handle), 'USER_ACCOUNT', 'LASTLOGIN'));
            self::$oEnv->oSESSION_MGR->setSessionParam('LASTLOGIN_IP', self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial($tmp_serial_handle), 'USER_ACCOUNT', 'LASTLOGIN_IP'));
            self::$oEnv->oSESSION_MGR->setSessionParam('LOGIN_CNT', self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial($tmp_serial_handle), 'USER_ACCOUNT', 'LOGIN_CNT'));
            self::$oEnv->oSESSION_MGR->setSessionParam('IMAGE_NAME', self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial($tmp_serial_handle), 'USER_ACCOUNT', 'IMAGE_NAME'));
            self::$oEnv->oSESSION_MGR->setSessionParam('IMAGE_WIDTH',  self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial($tmp_serial_handle), 'USER_ACCOUNT', 'IMAGE_WIDTH'));
            self::$oEnv->oSESSION_MGR->setSessionParam('IMAGE_HEIGHT', self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial($tmp_serial_handle), 'USER_ACCOUNT', 'IMAGE_HEIGHT'));
            self::$oEnv->oSESSION_MGR->setSessionParam('ABOUT', self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial($tmp_serial_handle), 'USER_ACCOUNT', 'ABOUT'));

            //
            // FORCE REBUILD OF LANG COMBO PACK ON LOGIN
            self::$oEnv->oSESSION_MGR->setSessionParam("LANG_SUPPORT_PACKS", NULL);

            //
            // SEND TO LP OR RESOURCE
            if(self::$oEnv->oSESSION_MGR->issetSessionParam('RESOURCE_REQUEST')){
                $tmp_lp = self::$oEnv->oSESSION_MGR->getSessionParam('RESOURCE_REQUEST');
                if(strpos($tmp_lp,'account/signin/')>5 || strpos($tmp_lp,'account/activate/')>5){
                    $tmp_lp = self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/';
                }

                header("Location: ".$tmp_lp);
                exit();
            }

            return "signin=success";
        }else{
            //
            // ANY FINAL THINGS TO DO FOR BAD LOGIN ATTEMPT? THROTTLING...DOS PROTECTION....ETC...
            switch(self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial($tmp_serial_handle), 'USER_ACCOUNT', 'ISACTIVE')){
                case '6':
                    //
                    // LOCKED BY ADMIN
                    $this->errorMessage = 'This account has been locked by the website administration.';
                    $this->errDisplay('ERR_ACCNT_LOCKED', true);
                    break;
                case '9':
                    //
                    // DELETED BY ADMIN
                    $this->errorMessage = 'This account has been deleted by the website administration.';
                    $this->errDisplay('ERR_ACCNT_ADMIN_DELETED', true);
                    break;
                case '0':
                    //
                    // DELETED BY USER
                    $this->errorMessage = 'This account has been deleted by the owner of this account.';
                    break;
                case '5':
                    $this->errorMessage = 'This account has not yet been activated.<br>Click <a href="'.self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'account/activate/resend/" target="_self">here</a> to resend the activation email.';
                    $this->errDisplay('ERR_ACCNT_ACTIVATED_A', true);
                    break;
                default:

                    #$this->errorMessage = 'Invalid email or password provided.';
                    $this->errDisplay('ERR_INVALID_LOGIN', true);
                    break;

            }

            //error_log('499 sign in error ->'.self::$queryDescript_ARRAY['users_ISACTIVE']);
            //error_log('500 sign in error ->'.$this->databaseResponse_ARRAY[0][self::$queryDescript_ARRAY['users_ISACTIVE']]);
            return "signin=error-".$this->databaseResponse_ARRAY[0][self::$queryDescript_ARRAY['users_ISACTIVE']];
        }

        return "signin=success";
    }

    public function resourceAccess($perm_id){
        $tmp_curr_id = self::$oEnv->oSESSION_MGR->getSessionParam('USER_PERMISSIONS_ID');
        $tmp_perm_id_ARRAY = explode("|", $perm_id);

        $tmp_loop_size = sizeof($tmp_perm_id_ARRAY);
        for($i=0;$i<$tmp_loop_size;$i++){
            if($tmp_curr_id==$tmp_perm_id_ARRAY[$i]){
                return true;
            }
        }

        return false;
    }

    public function validUser($utype=NULL){

        if(strlen(self::$oEnv->oSESSION_MGR->getSessionParam('USERID'))==50){
            #error_log("evifweb user (232)->".$utype);
            if($utype=="auth=admin"){
                if(self::$oEnv->oSESSION_MGR->issetSessionParam('USER_PERMISSIONS_ID')){
                    if(self::$oEnv->oSESSION_MGR->getSessionParam('USER_PERMISSIONS_ID')<400){

                        header("Location: ".self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/');
                        exit();

                    }
                }else{

                    header("Location: ".self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'));
                    exit();
                }

            }

            return true;
        }else{
            return false;
        }
    }

    public function validSession(){

        switch(self::$oDBIntegrate->processUserRequest('validate_session', $this, self::$oEnv)){
            case 'authorized':
                #error_log("evifweb user (243) YES validSession");
                return true;
                break;
            default:
                #error_log("evifweb user (247) NOT validSession");
                if(self::$oEnv->oSESSION_MGR->getSessionParam("FRESH_SESSION_ALERT")){
                    self::$oEnv->oSESSION_MGR->setSessionParam("FRESH_SESSION_ALERT", false);
                    return true;
                }
                return false;
                break;

        }

    }

    public function processEmailUnsub(){
        self::$http_param_handle["EMAIL"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'email');
        self::$http_param_handle["EMAIL_UNSUB"] = self::$oEnv->oHTTP_MGR->extractData($_POST, "email_unsub_mobi");
        self::$http_param_handle["MSG_SOURCEID"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'MSG_SOURCEID');

        //
        // AVOID CONFLICT BETWEEN CONTACT FORM AND UNSUB FORM
        if(self::$http_param_handle["EMAIL_UNSUB"]!=""){
            self::$http_param_handle["EMAIL"] = self::$http_param_handle["EMAIL_UNSUB"];
        }

        //
        // PROCESS NEW SYS MESSAGE
        return self::$oDBIntegrate->processUserRequest('email_unsub', $this, self::$oEnv);

    }

    public function processPasswordReset(){
        self::$http_param_handle["EMAIL"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'email');

        //
        // PROCESS NEW SYS MESSAGE
        return self::$oDBIntegrate->processUserRequest('pwd_reset', $this, self::$oEnv);

    }

    public function isValidPwdRstReq(){
        if(self::$oEnv->oHTTP_MGR->issetParam($_GET, 'rid')){
            self::$http_param_handle["REQUESTID"] = self::$oEnv->oHTTP_MGR->extractData($_GET, 'rid');
        }else{
            self::$http_param_handle["REQUESTID"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'rid');
        }

        //
        // CHECK WITH DATABASE FOR VALID REQUESTID
        return self::$oDBIntegrate->processUserRequest('pwd_reset_req_validate', $this, self::$oEnv);

    }

    public function processPasswordUpdate(){
        self::$http_param_handle["PWD_HASH"] = md5(self::$oEnv->oHTTP_MGR->extractData($_POST, 'pwd'));
        self::$http_param_handle["PWD_HASH_CONFIRM"] = md5(self::$oEnv->oHTTP_MGR->extractData($_POST, 'pwdconfirm'));
        self::$http_param_handle["REQUESTID"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'rid');

        //
        // CHECK FOR EQUALITY
        if((self::$http_param_handle["PWD_HASH"]==self::$http_param_handle["PWD_HASH_CONFIRM"]) && ((strlen(self::$http_param_handle["REQUESTID"])==50) && $this->isValidPwdRstReq())){

            //
            // PROCESS NEW SYS MESSAGE
            return self::$oDBIntegrate->processUserRequest('pwd_update', $this, self::$oEnv);

        }else{

            return "pwd_update=error";
        }

    }

    public function retrieve_Form_Data($key){
        if(isset(self::$http_param_handle[$key])) {
            return self::$http_param_handle[$key];
        }else{

            return NULL;
        }
    }

    public function save_Form_Data($key, $value){

        self::$http_param_handle[$key] = $value;

    }

    public function getEnvParam($paramName){

        if(!isset(self::$sess_env_param_ARRAY[$paramName])){
            self::$sess_env_param_ARRAY[$paramName] = self::$oEnv->getEnvParam($paramName);
        }

        return self::$sess_env_param_ARRAY[$paramName];
    }

    public function returnAvailErrMsg($elem_id){
        if(isset($this->errorMessage_ARRAY[$elem_id])){
            return $this->errorMessage_ARRAY[$elem_id];

        }else{
            return NULL;
        }

    }

    public function errDisplay($key, $showErr=NULL){

        if($showErr){

            //
            // MARK THIS KEY FOR ERROR DISPLAY
            $this->errorMessage_ARRAY[$key] = true;

        }else{
            if(isset($this->errorMessage_ARRAY[$key])){
                if($this->errorMessage_ARRAY[$key]){
                    return "display:inline;";
                }else{
                    return "display:none;";
                }
            }else{
                return "display:none;";

            }
        }

    }

    public function setLandingPage($url){
        self::$oEnv->oSESSION_MGR->setSessionParam('RESOURCE_REQUEST', $url);
    }

    //
    // THIS WHOLE METHOD NEEDS AN OVERHAUL TO PULL COPY FROM LANGUAGE ELEMENT DATABASE.
    public function transactionStatusUpdate($statusCode,$statusSource){

        //
        // PREPARE MESSAGING
        switch($statusSource){
            case 'content_publish_proxy':
                $tmp_msg_ARRAY[$statusSource] = array('success'=> '', 'error'=> 'Error :: Oops...there was an error while handling this content modification request. Please try again later.');

                break;
            case 'sys_component_action':
                $tmp_msg_ARRAY[$statusSource] = array('success'=> '', 'error'=> 'Error :: Oops...there was an error while handling this system modification request. Please try again later.');

                break;
            case 'insert_subtitle_element':
                $tmp_msg_ARRAY[$statusSource] = array('success'=> '', 'error'=> 'Error :: Oops...there was an error creating or updating this subtitle. Please try again later.');

                break;
            case 'insert_paragraph_element':
                $tmp_msg_ARRAY[$statusSource] = array('success'=> '', 'error'=> 'Error :: Oops...there was an error creating or updating this paragraph. Please try again later.');

                break;
            case 'insert_bullet_element':
                $tmp_msg_ARRAY[$statusSource] = array('success'=> '', 'error'=> 'Error :: Oops...there was an error creating or updating this bullet list. Please try again later.');

                break;
            case 'insert_schedule_element':
                $tmp_msg_ARRAY[$statusSource] = array('success'=> '', 'error'=> 'Error :: Oops...there was an error creating or updating this schedule. Please try again later.');

                break;
            case 'obs_edit_fullscrn_page_meta_simple':
                $tmp_msg_ARRAY[$statusSource] = array('success'=> '', 'error'=> 'Error :: Oops...there was an error updating this page. Please try again later.');

                break;
            case 'edit_page_header':
                $tmp_msg_ARRAY[$statusSource] = array('success'=> '', 'error'=> 'Error :: Oops...there was an error updating the header for this page. Please try again later.');

                break;
            case 'edit_page_title':
                $tmp_msg_ARRAY[$statusSource] = array('success'=> '', 'error'=> 'Error :: Oops...there was an error updating the title to this page. Please try again later.');

                break;
            case 'new_page_header':
                $tmp_msg_ARRAY[$statusSource] = array('success'=> '', 'error'=> 'Error :: Oops...there was an error adding a header to this page. Please try again later.');

                break;
            case 'new_page_title':
                $tmp_msg_ARRAY[$statusSource] = array('success'=> '', 'error'=> 'Error :: Oops...there was an error adding a title to this page. Please try again later.');

                break;
            case 'create_fullscrn_overlay_page':
                $tmp_msg_ARRAY[$statusSource] = array('success'=> '', 'error'=> 'Error :: Oops...there was an error adding a new page to this OBS full screen profile. Please try again later.');

                break;
            case 'obs_client_profile_update_mini':
                $tmp_msg_ARRAY[$statusSource] = array('success'=> '', 'error'=> 'Error :: Oops...there was an error changing the mini overlay for this OBS client. Please try again later.');

                break;
            case 'obs_client_profile_update_fullscrn':
                $tmp_msg_ARRAY[$statusSource] = array('success'=> '', 'error'=> 'Error :: Oops...there was an error when changing the full screen overlay for this OBS client. Please try again later.');

                break;
            case 'create_fullscrn_overlay':
                $tmp_msg_ARRAY[$statusSource] = array('success'=> 'Success :: A new full screen overlay has been created.', 'error'=> 'Error :: Oops...there was an error creating a new full screen overlay. Please try again later.');

                break;
            case 'accnt_activate_resend_unknown':
                $tmp_msg_ARRAY[$statusSource] = array('success'=> '', 'error'=> 'Error :: Oops...we could not find that email on file. Please enter a different email.');

                break;
            case 'accnt_activate_resend':
                $tmp_msg_ARRAY[$statusSource] = array('success'=> 'Success :: An account activation email has been queued for resending.', 'error'=> 'Error :: Oops...there was an error resending your account activation email. Please try again later.');

                break;
            case 'add_userAccess':
                $tmp_msg_ARRAY[$statusSource] = array('success'=> 'Success :: Access to the kivot&oacute;s will be restricted to the selected users.', 'error'=> 'Error :: Oops...there was an error granting exclusive access for this kivot&oacute;s. Please try again later.');

                break;
            case 'select_duedate':
                $tmp_msg_ARRAY[$statusSource] = array('success'=> 'Success :: The kivot&oacute;s has been updated with a new due date.', 'error'=> 'Error :: Oops...there was an error updating the due date for this kivot&oacute;s. Please try again later.');
                break;
            case 'admin_deleteClient':
                $tmp_msg_ARRAY[$statusSource] = array('success'=> 'Success :: The client has been deleted from the extranet.', 'error'=> 'Error :: Oops...there was an error deleting this client. Please try again later.');

                break;
            case 'admin_pwd_reset':
                $tmp_msg_ARRAY[$statusSource] = array('success'=> 'Success :: The user has been flagged for password reset.', 'error'=> 'Error :: Oops...there was an error flagging this user for password reset. Please try again later.');

                break;
            case 'admin_deleteAccnt':
                $tmp_msg_ARRAY[$statusSource] = array('success'=> 'Success :: The user has been deleted from the extranet.', 'error'=> 'Error :: Oops...there was an error deleting this user. Please try again later.');
                break;
            case 'admin_lockAccnt':
                $tmp_msg_ARRAY[$statusSource] = array('success'=> 'Success :: The user has been locked out of the extranet.', 'error'=> 'Error :: Oops...there was an error removing web site access for this user. Please try again later.');

                break;
            case 'add_clientAccess':
                $tmp_msg_ARRAY[$statusSource] = array('success'=> 'Success :: The update to the user client access roster was successful.', 'error'=> 'Error :: Oops...there was an error updating client access for that user account. Please try again later.');

                break;
            case 'edit_user_profile_data':
                $tmp_msg_ARRAY[$statusSource] = array('success'=> 'Success :: The update to the user profile was successful.', 'error'=> 'Error :: Oops...there was an error updating that user account. Please try again later.');
                break;
            case 'edit_permissionType':

                $tmp_msg_ARRAY[$statusSource] = array('success'=> 'Success :: The update to the user was successful.', 'error'=> 'Error :: Oops...there was an error updating that user account. Please try again later.');
                break;
            case 'edit_syslang':
                $this->prepLangElem('SYS_TRANS_EDIT_SYSLANG_SUCC|SYS_TRANS_EDIT_SYSLANG_ERR');

                $tmp_msg_ARRAY[$statusSource] = array('success'=> $this->getLangElem('SYS_TRANS_EDIT_SYSLANG_SUCC'), 'error'=>$this->getLangElem('SYS_TRANS_EDIT_SYSLANG_ERR'));
                break;
            case 'edit_langelement':
                $this->prepLangElem('SYS_TRANS_EDIT_LANGELEMENT_SUCC|SYS_TRANS_EDIT_LANGELEMENT_ERR');

                $tmp_msg_ARRAY[$statusSource] = array('success'=> $this->getLangElem('SYS_TRANS_EDIT_LANGELEMENT_SUCC'),'error'=> $this->getLangElem('SYS_TRANS_EDIT_LANGELEMENT_ERR'));
                break;
            case 'new_langelement':
                $this->prepLangElem('SYS_TRANS_NEW_LANGELEMENT_SUCC|SYS_TRANS_NEW_LANGELEMENT_ERR');


                $tmp_msg_ARRAY[$statusSource] = array('success'=> $this->getLangElem('SYS_TRANS_NEW_LANGELEMENT_SUCC'),'error'=> $this->getLangElem('SYS_TRANS_NEW_LANGELEMENT_ERR'));
                break;
            case 'new_syslang':
                $this->prepLangElem('SYS_TRANS_NEW_SYSLANG_SUCC|SYS_TRANS_NEW_LANGELEMENT_ERR');

                $tmp_msg_ARRAY[$statusSource] = array('success'=> $this->getLangElem('SYS_TRANS_NEW_SYSLANG_SUCC'),'error'=> $this->getLangElem('SYS_TRANS_NEW_LANGELEMENT_ERR'));
                break;
            case 'signup_main':
                $this->prepLangElem('SYS_TRANS_SIGNUP_MAIN_SUCC|SYS_TRANS_SIGNUP_MAIN_ERR');

                $tmp_msg_ARRAY[$statusSource] = array('success'=> $this->getLangElem('SYS_TRANS_SIGNUP_MAIN_SUCC'),'error'=> $this->getLangElem('SYS_TRANS_SIGNUP_MAIN_ERR'));
                break;
            case 'signup_main_dup':
                $this->prepLangElem('SYS_TRANS_SIGNUP_MAIN_DUP_ERR');

                $tmp_msg_ARRAY[$statusSource] = array('success'=>'','error'=> $this->getLangElem('SYS_TRANS_SIGNUP_MAIN_DUP_ERR'));
                break;
            case 'contact_home':
                $this->prepLangElem('SYS_TRANS_CONTACT_HOME_SUCC|SYS_TRANS_CONTACT_HOME_ERR');

                $tmp_msg_ARRAY[$statusSource] = array('success'=> $this->getLangElem('SYS_TRANS_CONTACT_HOME_SUCC'),'error'=> $this->getLangElem('SYS_TRANS_CONTACT_HOME_ERR'));
                break;
            case 'email_unsub':
                $this->prepLangElem('SYS_TRANS_EMAIL_UNSUB_SUCC|SYS_TRANS_EMAIL_UNSUB_ERR');

                $tmp_msg_ARRAY[$statusSource] = array('success'=> $this->getLangElem('SYS_TRANS_EMAIL_UNSUB_SUCC'),'error'=> $this->getLangElem('SYS_TRANS_EMAIL_UNSUB_ERR'));
                break;
            case 'pwd_reset':
                $this->prepLangElem('SYS_TRANS_PWD_RESET_SUCC|SYS_TRANS_PWD_RESET_ERR');

                $tmp_msg_ARRAY[$statusSource] = array('success'=> $this->getLangElem('SYS_TRANS_PWD_RESET_SUCC'),'error'=> $this->getLangElem('SYS_TRANS_PWD_RESET_ERR'));
                break;
            case 'pwd_reset_lnk_expire':
                $this->prepLangElem('SYS_TRANS_PWD_RESET_LNK_EXPIRE_ERR');

                $tmp_msg_ARRAY[$statusSource] = array('success'=>'','error'=> $this->getLangElem('SYS_TRANS_PWD_RESET_LNK_EXPIRE_ERR'));
                break;
            case 'pwd_update':
                $this->prepLangElem('SYS_TRANS_PWD_UPDATE_SUCC|SYS_TRANS_PWD_UPDATE_ERR');

                $tmp_msg_ARRAY[$statusSource] = array('success'=> $this->getLangElem('SYS_TRANS_PWD_UPDATE_SUCC'),'error'=> $this->getLangElem('SYS_TRANS_PWD_UPDATE_ERR'));
                break;

            # NOT IMPLEMENTED ON EVIFWEB SITE YET. THE FOLLOWING IS LEFTOVER CODE FROM CRNRSTN.
            case 'edit_settings':
                $tmp_msg_ARRAY[$statusSource] = array('success'=>'Success :: Your account settings have been updated.','error'=>'Error :: Oops...an error was experienced and we were unable to<br>process your request. Please try again later.');
                break;
            case 'account_deactivate':

                $tmp_msg_ARRAY[$statusSource] = array('success'=>'Success :: Your account has been deactivated.<br>Thanks for being a part of the <span class="user_transaction_bg_xmas_clear">C<span class="the_R">R</span>NRSTN</span> community!','error'=>'');
                break;
            case 'edit_profile':
                $tmp_msg_ARRAY[$statusSource] = array('success'=>'Success :: Your profile information has been updated. Thanks!','error'=>'Error :: Oops...an error was experienced while processing your request.<br>Please try again later.');
                break;
            case 'edit_profile_err_all':
                $tmp_msg_ARRAY[$statusSource] = array('success'=>'','error'=>'Error :: Oops...an error was experienced while processing your request.<br>Please try again later.<br>No changes were able to be made.');
                break;
            case 'account_activate':
                $tmp_msg_ARRAY[$statusSource] = array('success'=>'Success :: This account has now been activated.<br>You\'re all set and ready to go!','error'=>'Error :: Oops...an error was experienced while activating your account.<br>If this problem persist, you may want to try creating a new account,<br>or report this bug to the administrator via the feedback form.');
                break;
            case 'activate_falseall':
                $tmp_msg_ARRAY[$statusSource] = array('success'=>'','error'=>'Error :: Oops...an error was experienced while activating your account.<br>Please try again later.');
                break;
            case 'activate_donealready':
                $tmp_msg_ARRAY[$statusSource] = array('success'=>'Success :: This account has already been activated.','error'=>'');
                break;
            case 'activate_datanull':
                $tmp_msg_ARRAY[$statusSource] = array('success'=>'','error'=>'Error :: It looks like there is a problem with your activation link.<br>You can click the link below to resend an activation link<br>to the email on record.');
                break;
            case 'activate_dataredun':
                $tmp_msg_ARRAY[$statusSource] = array('success'=>'','error'=>'Error :: Oops...it looks like this account is in conflict with another one.<br>You may want to try creating a new account,<br>or report this bug to the administrator via the feedback form.');
                break;
            case 'activate_link_err':
                $tmp_msg_ARRAY[$statusSource] = array('success'=>'','error'=>'Error :: It looks like there is a problem with your activation link.<br>You can click the link below to resend an activation link<br>to the email on record.');
                break;
            case 'resend_activation':
                $tmp_msg_ARRAY[$statusSource] = array('success'=>'Success :: Your account activation email will be sent in a moment.','error'=>'Error :: It looks like there is a problem resending your activation link.');
                break;
            case 'pswd_reset':
                $tmp_msg_ARRAY[$statusSource] = array('success'=>'Success :: An email will be sent to the account on file. Please follow the instructions to successfully reset your account password!','error'=>'Error :: Oops...I was unable to locate an account with that information.<br>No "password reset" email was able to be sent.');
                break;
            case 'password_reset':
                $tmp_msg_ARRAY[$statusSource] = array('success'=>'Success :: Your account password has been updated!','error'=>'Error :: Oops...I was unable to update your password as the link was most<br>likely too old. If you still need to reset your password, please start the process again.');
                break;
            case 'xxxxxx':
                $tmp_msg_ARRAY[$statusSource] = array('success'=>'Success :: Your feedback has been received. Thanks!','error'=>'Error :: Oops...there was an error processing your request.<br>Please try again later.');
                break;
            default:
                $tmp_msg_ARRAY[$statusSource] = array('success'=>'Success ::');
                break;
        }

        $tmp_style_ARRAY = array('success'=>'user_transaction_success','error'=>'user_transaction_error');

        //
        // INITIALIZE TRANSACTION STATUS MESSAGING ARRAY
        $this->transStatusMessage_ARRAY[0] = $tmp_style_ARRAY[$statusCode];
        $this->transStatusMessage_ARRAY[1] = $tmp_msg_ARRAY[$statusSource][$statusCode];

    }

    private function returnOBSClientCurrentStatus_HTML($oDB_RESP){

        $tmp_serial_handle = 'OBS_CLIENT_PROFILE_DATA';

        $tmp_obsclientid = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENT', 'OBSCLIENT_ID');
        $tmp_obs_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENT', 'OBS_ID');
        $tmp_obs_id_display = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENT', 'OBS_ID_DISPLAY');
        $tmp_obs_lastcontact = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENT', 'LAST_CONTACT');

        $tmp_format_override = 'm.d.Y @ H:i:s';
        $tmp_obsclient_lastcontact = self::$oEnv->oFINITE_EXPRESS->incarnate('ELAPSED', $tmp_obs_lastcontact, $tmp_format_override);

        $tmp_curr_mini_display_mode = 'SLEEP Alternate';
        $tmp_lang_pack_fs = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENT', 'CURRENT_LANG_PACK_FULLSCRN');
        $tmp_lang_pack_m = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENT', 'CURRENT_LANG_PACK_MINI');

        // $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'LANG_PACKS', 'LANG_ID');

        $tmp_lang_pack_fs = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', $tmp_lang_pack_fs, 'NATIVE_NAME_BLOB');
        $tmp_lang_pack_m = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', $tmp_lang_pack_m, 'NATIVE_NAME_BLOB');

        $tmp_fullscrn_profile_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENT', 'FULLSCRN_PROFILE_ID');
        $tmp_mini_profile_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENT', 'MINI_PROFILE_ID');

        $tmp_fullscrn_profile_name = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'FULL_SCRN_PROFILE', $tmp_fullscrn_profile_id, 'PROFILE_NAME');
        $tmp_mini_profile_name = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE', $tmp_mini_profile_id, 'PROFILE_NAME');

        $tmp_fullscrn_viewstate = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENT', 'FULLSCRN_VIEW_STATE');
        $tmp_mini_viewstate = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENT', 'MINI_VIEW_STATE');

        $tmp_timer_copy = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENT', 'CURRENT_WALL_TIME');

        $tmp_timer_copy = $this->bufferOverlayTime($tmp_timer_copy, $tmp_obs_lastcontact);


        $tmp_fullscrn_visible = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENT', 'ISVISIBLE_FULLSCRN');
        $tmp_mini_visible =  $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENT', 'ISVISIBLE_MINI');

        $tmp_mini_display_mode =  $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENT', 'MINI_DISPLAY_MODE');

        // $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENT', $tmp_fullscrn_profile_id, '');
        // $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENT', $tmp_mini_profile_id, '');

        if($tmp_fullscrn_viewstate=='false' || $tmp_fullscrn_viewstate==false){

            $tmp_copy_fullscrn_viewstate = 'hidden';

        }else{

            $tmp_copy_fullscrn_viewstate = 'visible';

        }

        // temp_profile_param_array['master_overlay_visible_BOOL']+'|'+temp_profile_param_array['timer_overlay_visible_BOOL']+'|'+
        // temp_profile_param_array['overlay_mode']+'|'+temp_profile_param_array['timer_mode'];
        // true|true|FULL|RESET
        list($tmp_mini_visible_viewstate, $tmp_mini_timer_visible_viewstate, $tmp_mini_overlaymode_viewstate, $tmp_mini_timermode_viewstate) = explode("|", $tmp_mini_viewstate);

        if($tmp_mini_visible_viewstate=='false' || $tmp_mini_visible_viewstate==false){

            $tmp_copy_mini_visible_viewstate = 'hidden';

        }else{

            $tmp_copy_mini_visible_viewstate = 'visible';

        }

        if($tmp_mini_timer_visible_viewstate=='false' || $tmp_mini_timer_visible_viewstate==false){

            $tmp_copy_mini_timer_visible_viewstate = 'hidden';

        }else{

            $tmp_copy_mini_timer_visible_viewstate = 'visible';

        }

        $tmp_cache_b = $this->generateNewKey(10);


        return '<div class="hidden"><a href="'.self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'?obs_id='.$tmp_obs_id_display.'&rt=currentstatus&cache_b='.$tmp_cache_b.'" target="_self">(Refresh)</a></div><p>Last contact received '.$tmp_obsclient_lastcontact.'</p>
                        <p>The full screen overlay is '.$tmp_copy_fullscrn_viewstate.', and its
                            selected overlay profile is: <strong><i>'.$tmp_fullscrn_profile_name.'</i></strong>.
                            It is showing '.$tmp_lang_pack_fs.' content.</p>
                        <p>The mini overlay is '.$tmp_copy_mini_visible_viewstate.'. <strong><span id="timer_copy_admin">'.$tmp_timer_copy.'</span></strong> is the
                            current time, and this is '.$tmp_copy_mini_timer_visible_viewstate.'. The selected mini overlay
                            profile is: <strong><i>'.$tmp_mini_profile_name.'</i></strong>. It is loaded with '.$tmp_lang_pack_m.' content,
                             is in <strong>'.$tmp_mini_overlaymode_viewstate.' mode</strong>, and is set to <strong>'.$tmp_curr_mini_display_mode.'</strong>.</p>';
    }

    public function searchTruncStr($str, $len){

        return substr($str,0, $len);

    }

    public function searchCleanStr($str){

        //
        // TRIM TO 1020 CHARS
        return substr(strtolower($this->search_FillerSanitize($str)),0,1015);
    }

    private function search_FillerSanitize($str){

        $patterns = array();
        $patterns[0] = "
";
        $patterns[1] = '"';
        $patterns[2] = '=';
        $patterns[3] = '{';
        $patterns[4] = '}';
        $patterns[5] = '(';
        $patterns[6] = ')';
        $patterns[7] = ' ';
        $patterns[8] = '	';
        $patterns[9] = ',';
        $patterns[10] = '\n';
        $patterns[11] = '\r';
        $patterns[12] = '\'';
        $patterns[13] = '/';
        $patterns[14] = '#';
        $patterns[15] = ';';
        $patterns[16] = ':';
        $patterns[17] = '>';

        $replacements = array();
        $replacements[0] = '';
        $replacements[1] = '';
        $replacements[2] = '';
        $replacements[3] = '';
        $replacements[4] = '';
        $replacements[5] = '';
        $replacements[6] = '';
        $replacements[7] = '';
        $replacements[8] = '';
        $replacements[9] = '';
        $replacements[10] = '';
        $replacements[11] = '';
        $replacements[12] = '';
        $replacements[13] = '';
        $replacements[14] = '';
        $replacements[15] = '';
        $replacements[16] = '';
        $replacements[17] = '';

        #$str = preg_replace($patterns, $replacements, $str);
        $str = str_replace($patterns, $replacements, $str);
        return $str;
    }

    //
    // METHOD SOURCE :: Stack Overflow ::  https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string
    // Contributor :: https://stackoverflow.com/users/1698153/scott
    public function generateNewKey($len=32){
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet); // edited


        if(function_exists('random_int')){
            for ($i=0; $i < $len; $i++){
                $token .= $codeAlphabet[random_int(0, $max-1)];
            }
        }else{
            for ($i=0; $i < $len; $i++) {
                $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max-1)];
            }
        }

        return $token;

    }

    public function readfile_chunked($filename, $retbytes=true) {
        $chunksize = 1*(1024*1024); // how many bytes per chunk
        $buffer = '';
        $cnt =0;
        // $handle = fopen($filename, 'rb');
        $handle = fopen($filename, 'rb');
        if ($handle === false) {
            return false;
        }
        while (!feof($handle)) {
            $buffer = fread($handle, $chunksize);
            echo $buffer;
            if ($retbytes) {
                $cnt += strlen($buffer);
            }
        }
        $status = fclose($handle);
        if ($retbytes && $status) {
            return $cnt; // return num. bytes delivered like readfile() does.
        }
        return $status;

    }

    //
    // METHOD SOURCE :: Stack Overflow :: https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string
    // Contributor :: https://stackoverflow.com/users/4895359/yumoji
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

    // SOURCE :: https://stackoverflow.com/questions/7304182/detecting-ssl-with-php
    // FROM WordPress tho
    public function is_ssl() {
        if ( isset($_SERVER['HTTPS']) ) {
            if ( 'on' == strtolower($_SERVER['HTTPS']) )
                return true;
            if ( '1' == $_SERVER['HTTPS'] )
                return true;
        } elseif ( isset($_SERVER['SERVER_PORT']) && ( '443' == $_SERVER['SERVER_PORT'] ) ) {
            return true;
        }
        return false;
    }

    //
    // SOURCE :: https://stackoverflow.com/questions/5100189/use-php-to-check-if-page-was-accessed-with-ssl
    // AUTHOR :: https://stackoverflow.com/users/887067/saeven
    public function isSSL()
    {
        if( !empty( $_SERVER['https'] ) && ($_SERVER['HTTPS'] != 'off') )
            return true;

        if( !empty( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' )
            return true;

        return false;
    }

    public function getmicrotime() {
        if (function_exists('gettimeofday')) {
            $tod = gettimeofday();
            $sec = $tod['sec'];
            $usec = $tod['usec'];
        } else {
            $sec = time();
            $usec = 0;
        }
        return strftime('%Y-%m-%d %H:%M:%S', $sec) . '.' . sprintf('%06d', $usec);
    }

    public function __destruct() {

    }
}

?>