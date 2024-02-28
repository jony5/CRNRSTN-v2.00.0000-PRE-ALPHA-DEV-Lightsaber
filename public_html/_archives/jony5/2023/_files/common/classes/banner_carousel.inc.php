<?php
/*
// J5
// Code is Poetry */

class banner_carousel {

    private static $oLogger;
    private static $oEnv;

    private static $banner_filename_array = array();
    private static $banner_array_size;
    private static $default_banner_file;
    private static $ttl;
    private static $ttl_delta = 0;
    private static $ttl_refresh_cnt;
    private static $ts;

    public function __construct($oEnv, $ttl=60)
    {
        try{

            //
            // INSTANTIATE LOGGER
            self::$oLogger = new crnrstn_logging();
            self::$oEnv = $oEnv;

            self::$ttl = $ttl;
            self::$default_banner_file = 'banner_new_j5_21.jpg';

            //
            // HOOOSTON...VE HAF PROBLEM!
            #throw new Exception('Hello world');

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('banner_carousel->__construct()', LOG_EMERG, $e->getMessage());

        }

    }
    
    private function getUrlContent($url, $host){

        $header=array(
            'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36',
            'X-Requested-With: XMLHttpRequest',
            'Host: '.$host,
            'Accept: text/html, */*; q=0.01',
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'Accept-Language: en-US,en;q=0.9,zh-CN;q=0.8,zh;q=0.7',
            'Accept-Encoding: gzip,deflate',
            'Referer: '.self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'),
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
        curl_setopt($ch,CURLOPT_HTTPHEADER,$header);

        //$data = curl_exec($ch);

        if( ! $data = curl_exec($ch))
        {
            self::$oLogger->captureNotice('[ERROR] CRON Fired CURL for XML ERR', LOG_NOTICE, curl_error($ch));
            //$result = '';
            //trigger_error(curl_error($ch));
        }


        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return ($httpcode>=200 && $httpcode<300) ? $data : false;
    }

    private function return_highest_display($cnt, $filename){

        $tmp_ttl_highest_cnt = self::$oEnv->oSESSION_MGR->getSessionParam("BANNER_TTL_HIGHEST_CNT");
        $tmp_sess_highest_cnt = self::$oEnv->oSESSION_MGR->getSessionParam("BANNER_SESSION_HIGHEST_CNT");

        if(!($tmp_ttl_highest_cnt>=$cnt) || $tmp_ttl_highest_cnt==""){
            self::$oEnv->oSESSION_MGR->setSessionParam("BANNER_TTL_HIGHEST_CNT", $cnt);
            self::$oEnv->oSESSION_MGR->setSessionParam("BANNER_TTL_HIGHEST_FILENAME", $filename);

            if(!($tmp_sess_highest_cnt>=$cnt) || $tmp_sess_highest_cnt==""){

                self::$oEnv->oSESSION_MGR->setSessionParam("BANNER_SESSION_HIGHEST_CNT", $cnt);
                self::$oEnv->oSESSION_MGR->setSessionParam("BANNER_SESSION_HIGHEST_FILENAME", $filename);

                $tmp_sess_highest_filename = $filename;

            }else{

                $tmp_sess_highest_filename = self::$oEnv->oSESSION_MGR->getSessionParam("BANNER_SESSION_HIGHEST_FILENAME");

            }

            #  5(banner_new_j5_21.jpg|6(banner_new_j5_22.jpg)

            $tmp_ttl_highest_cnt = $cnt;
            $tmp_ttl_highest_filename = $filename;

        }else{

            $tmp_ttl_highest_filename = self::$oEnv->oSESSION_MGR->getSessionParam("BANNER_TTL_HIGHEST_FILENAME");
            $tmp_sess_highest_filename = self::$oEnv->oSESSION_MGR->getSessionParam("BANNER_SESSION_HIGHEST_FILENAME");

        }

        return $tmp_ttl_highest_cnt."(".$tmp_ttl_highest_filename.")|".$tmp_sess_highest_cnt."(".$tmp_sess_highest_filename.")";

    }

    public function return_proxy_nodes($dir_path){

        $tmp_mtime = $this->microtime_float();
        $tmp_mtime_overhead = $this->microtime_float() - self::$oEnv->starttime;
        $tmp_mtime_overhead = substr($tmp_mtime_overhead,0,-8);

        $xml_construct_ARRAY = array();
        $tmp_dir = self::$oEnv->getEnvParam('DOCUMENT_ROOT').self::$oEnv->getEnvParam('DOCUMENT_ROOT_DIR').'/'.$dir_path;
        self::$banner_filename_array = scandir($tmp_dir, 1);

        $tmp = array_pop(self::$banner_filename_array);
        $tmp = array_pop(self::$banner_filename_array);

        //
        // BUILD NEW ARRAY WITH NO PNG
        $tmp_new_banner_array = array();
        $tmp_invalid_img_cnt = 0;
        $tmp_file_filtered = 0;
        $tmp_banner_size = sizeof(self::$banner_filename_array);
        for($i=0;$i<$tmp_banner_size;$i++){

            $tmp_pos_jpg = strpos(self::$banner_filename_array[$i], '.jpg');

            //
            // IF NO PNG, PHP, DS_Store
            if(($tmp_pos_jpg!==false)){
                $tmp_new_banner_array[] = self::$banner_filename_array[$i];
            }else{

                $tmp_file_filtered++;
            }

        }

        self::$banner_filename_array = $tmp_new_banner_array;
        self::$banner_array_size = sizeof(self::$banner_filename_array);

        shuffle(self::$banner_filename_array);

        $tmp_mtime_scan = $this->microtime_float();

        $tmp_mtime_scan_delta = $tmp_mtime_scan - $tmp_mtime;

        //
        // SANITY CHECK
        if(self::$banner_array_size<3){

            self::$oLogger->captureNotice('Directory scan ERROR on session initialization attempt :: size=['.self::$banner_array_size.']', LOG_CRIT, 'The directory of interest for our image search is '.$tmp_dir);
            //return '<img ttl_delta_ERROR="'.self::$ttl_delta.'" ttl="'.self::$ttl.'" scan_cnt="'.self::$banner_array_size.'" src="'.self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').$dir_path.self::$default_banner_file.'" width="1180" height="250" alt="J5">';

        }

        /*
            <total_evifweb_proxy_image_count></total_evifweb_proxy_image_count>
            <SCAN_TIME></SCAN_TIME>
            {DATA_DELIM}
            <banner_img>
                <queue_position></queue_position>
                <content_type></content_type>
                <uri></uri>
                <title></title>
                <description><![CDATA[]]></description>
                <date></date>
            </banner_img>

            <banner_img>...</banner_img>
            <banner_img>...</banner_img>
            <banner_img>...</banner_img>
         */

        $tmp_xmltime = $this->microtime_float();
        $xml_construct_ARRAY['NODE']['DATA_DELIM'] = '{DATA_DELIM}';
        $xml_construct_ARRAY['NODE']['TOTAL_SCANNED'] = '
   <evifweb_total_images_count>'.self::$banner_array_size.'</evifweb_total_images_count>';
        $xml_construct_ARRAY['NODE']['BANNER_IMAGES_INDEX'] = '';

        $tmp_flag_used_img = array();
        $ii = 0;

        for($i=0;$i<self::$banner_array_size;$i++){

            //$tmp_file_name = self::$banner_filename_array[mt_rand(0, (self::$banner_array_size))];
            $tmp_file_name = self::$banner_filename_array[$i];

            if(!isset($tmp_flag_used_img[$tmp_file_name])){
                $tmp_flag_used_img[$tmp_file_name] = 1;

                /*
                 = filesize($_FILES["assetfile"]["tmp_name"]);
                $this->assetParams['FILE_MIME_TYPE'] = mime_content_type($_FILES["assetfile"]["tmp_name"]);
                $this->assetParams['FILE_MD5'] = md5_file($_FILES["assetfile"]["tmp_name"]);  // 32
        $this->assetParams['FILE_SHA1'] = sha1_file($_FILES["assetfile"]["tmp_name"]);  // 40

                $this->formatBytes(,3);

                 * */
                $tmp_file = self::$oEnv->getEnvParam('DOCUMENT_ROOT').self::$oEnv->getEnvParam('DOCUMENT_ROOT_DIR').'/'.$dir_path.$tmp_file_name;

                $tmp_md5_file = md5_file($tmp_file);  // 32
                $tmp_sha1_file = sha1_file($tmp_file);  // 40
                $tmp_filesize = filesize($tmp_file);
                $tmp_filesize = $this->formatBytes($tmp_filesize,3);
                list($img_width, $img_height) = getimagesize($tmp_file);

                $tmp_valid_img = 'true';
                if($img_width<1180 || $img_height<250){
                    $tmp_valid_img = 'false';
                    $tmp_invalid_img_cnt++;
                }

                $xml_construct_ARRAY['NODE']['BANNER_IMAGES_INDEX'] .= '
      <banner_img>
        <queue_position>'.$ii.'</queue_position>
        <uri>'.self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').$dir_path.$tmp_file_name.'</uri>
        <filesize>'.$tmp_filesize.'</filesize>
        <md5>'.$tmp_md5_file.'</md5>
        <sha1>'.$tmp_sha1_file.'</sha1>
        <valid_dimensions>'.$tmp_valid_img.'</valid_dimensions>
      </banner_img>';

                $ii++;

                //
                // DO WE BAIL?
                if($i>self::$banner_array_size){
                    $bail_count = $i;

                    $i = self::$banner_array_size + 1;

                }

            }

        }

        $tmp_xmltime_scan = $this->microtime_float();
        $tmp_mtime_xml_build_delta = $tmp_xmltime_scan - $tmp_xmltime;

        if(!isset($bail_count)){

            $bail_count = $i;

        }

        $xml_construct_ARRAY['NODE']['TOTAL_MATCHED'] = '
   <evifweb_total_matched>'.$ii.'</evifweb_total_matched>';
        $xml_construct_ARRAY['NODE']['MATCH_ATTEMPTS'] = '
   <evifweb_total_match_attempts>'.$bail_count.'</evifweb_total_match_attempts>';

        $tmp_oht = (double) $tmp_mtime_overhead;
        $xml_construct_ARRAY['NODE']['XML_GENERATION_JPG_INVALID_DIMENSIONS'] = '
   <evifweb_total_file_scan_invalid_dimensions>'.$tmp_invalid_img_cnt.'</evifweb_total_file_scan_invalid_dimensions>';
        $xml_construct_ARRAY['NODE']['XML_GENERATION_PNG_FILTERED'] = '
   <evifweb_file_scan_filtered_out>'.$tmp_file_filtered.'</evifweb_file_scan_filtered_out>';
        $xml_construct_ARRAY['NODE']['XML_GENERATION_SCRIPT_OVERHEAD_SECS'] = '
   <evifweb_xml_generation_script_overhead_secs>'.$tmp_oht.'</evifweb_xml_generation_script_overhead_secs>';
        $xml_construct_ARRAY['NODE']['XML_GENERATION_IMG_SCAN_SECS'] = '
   <evifweb_xml_generation_image_file_dir_scan_secs>'.substr($tmp_mtime_scan_delta,0,-8).'</evifweb_xml_generation_image_file_dir_scan_secs>';
        $xml_construct_ARRAY['NODE']['XML_GENERATION_XML_BUILD_SECS'] = '
   <evifweb_xml_generation_xml_build_secs>'.substr($tmp_mtime_xml_build_delta,0,-8).'</evifweb_xml_generation_xml_build_secs>';
        $xml_construct_ARRAY['NODE']['XML_GENERATION_TIME'] = '
   <evifweb_xml_generation_walltime_secs>'.self::$oEnv->wallTime().'</evifweb_xml_generation_walltime_secs>';

        $tmp_output_XML = $xml_construct_ARRAY['NODE']['TOTAL_SCANNED'].$xml_construct_ARRAY['NODE']['TOTAL_MATCHED'].$xml_construct_ARRAY['NODE']['XML_GENERATION_PNG_FILTERED'].$xml_construct_ARRAY['NODE']['XML_GENERATION_JPG_INVALID_DIMENSIONS'].$xml_construct_ARRAY['NODE']['MATCH_ATTEMPTS'].$xml_construct_ARRAY['NODE']['XML_GENERATION_SCRIPT_OVERHEAD_SECS'].$xml_construct_ARRAY['NODE']['XML_GENERATION_IMG_SCAN_SECS'].$xml_construct_ARRAY['NODE']['XML_GENERATION_XML_BUILD_SECS'].$xml_construct_ARRAY['NODE']['XML_GENERATION_TIME'].$xml_construct_ARRAY['NODE']['DATA_DELIM'].$xml_construct_ARRAY['NODE']['BANNER_IMAGES_INDEX'];

        return $tmp_output_XML;

    }

    private function return_display_count($filename){

        if(!(self::$oEnv->oSESSION_MGR->issetSessionParam("BANNER_IMAGE_ACTIVITY_INIT"))){
            self::$oEnv->oSESSION_MGR->setSessionParam("BANNER_IMAGE_ACTIVITY_INIT", 1);

            $tmp_image_activity_array = array();  # where $tmp_image_activity_array...0=TTL-TOTAL, 1=TOTAL-TOTAL, ?? 2=HIGHEST-EXISTING-TOTAL ??
            self::$oEnv->oSESSION_MGR->setSessionParam("BANNER_IMAGE_ACTIVITY_ARRAY", $tmp_image_activity_array);
        }

        $tmp_image_activity_array = self::$oEnv->oSESSION_MGR->getSessionParam("BANNER_IMAGE_ACTIVITY_ARRAY");

        if(isset($tmp_image_activity_array[1][$filename])){
            $tmp_cnt = (int)$tmp_image_activity_array[0][$filename];
            $tmp_cnt ++;
            $tmp_image_activity_array[0][$filename] = $tmp_cnt;

            $tmp_cnt = (int)$tmp_image_activity_array[1][$filename];
            $tmp_cnt ++;
            $tmp_image_activity_array[1][$filename] = $tmp_cnt;

        }else{

            $tmp_image_activity_array[0][$filename] = 1;
            $tmp_image_activity_array[1][$filename] = 1;

            $tmp_cnt = 1;
        }

        $tmp_highest_cnt_str = $this->return_highest_display($tmp_cnt, $filename);


        self::$oEnv->oSESSION_MGR->setSessionParam("BANNER_IMAGE_ACTIVITY_ARRAY", $tmp_image_activity_array);

        return $tmp_image_activity_array[0][$filename]."|".$tmp_image_activity_array[1][$filename]."|".$tmp_highest_cnt_str;

    }

    public function return_image_xml($dir_path){

        $tmp_mtime = $this->microtime_float();
        $tmp_mtime_overhead = $this->microtime_float() - self::$oEnv->starttime;
        $tmp_mtime_overhead = substr($tmp_mtime_overhead,0,-8);

        $xml_construct_ARRAY = array();
        $tmp_dir = self::$oEnv->getEnvParam('DOCUMENT_ROOT').self::$oEnv->getEnvParam('DOCUMENT_ROOT_DIR').'/'.$dir_path;
        self::$banner_filename_array = scandir($tmp_dir, 1);

        $tmp = array_pop(self::$banner_filename_array);
        $tmp = array_pop(self::$banner_filename_array);

        //
        // BUILD NEW ARRAY WITH NO PNG
        $tmp_new_banner_array = array();
        $tmp_invalid_img_cnt = 0;
        $tmp_png_filtered = 0;
        $tmp_banner_size = sizeof(self::$banner_filename_array);
        for($i=0;$i<$tmp_banner_size;$i++){

            $tmp_pos_png = strpos(self::$banner_filename_array[$i], '.png');

            //
            // IF NO PNG
            if(($tmp_pos_png===false)){
                $tmp_new_banner_array[] = self::$banner_filename_array[$i];
            }else{

                $tmp_png_filtered++;
            }

        }

        self::$banner_filename_array = $tmp_new_banner_array;
        self::$banner_array_size = sizeof(self::$banner_filename_array);

        shuffle(self::$banner_filename_array);

        $tmp_mtime_scan = $this->microtime_float();

        $tmp_mtime_scan_delta = $tmp_mtime_scan - $tmp_mtime;

        //
        // SANITY CHECK
        if(self::$banner_array_size<3){

            self::$oLogger->captureNotice('Directory scan ERROR on session initialization attempt :: size=['.self::$banner_array_size.']', LOG_CRIT, 'The directory of interest for our image search is '.$tmp_dir);
            //return '<img ttl_delta_ERROR="'.self::$ttl_delta.'" ttl="'.self::$ttl.'" scan_cnt="'.self::$banner_array_size.'" src="'.self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').$dir_path.self::$default_banner_file.'" width="1180" height="250" alt="J5">';

        }

        /*
        <?xml version="1.0" encoding="iso-8859-1"?>
        <jony5_dot_com_banner_xml>
            <date_images_scanned></date_images_scanned>
            <total_images_count></total_images_count>
            <banner_images_index>

                <banner_img>
                    <queue_position></queue_position>
                    <content_type></content_type>
                    <uri></uri>
                    <title></title>
                    <description><![CDATA[]]></description>
                    <date></date>
                </banner_img>

                <banner_img>...</banner_img>
                <banner_img>...</banner_img>
                <banner_img>...</banner_img>

            </banner_images_index>
        </jony5_dot_com_banner_xml>
         * */


        $tmp_evifweb_proxy_data_ARRAY = $this->return_evifweb_proxy_xml(self::$oEnv->getEnvParam('PROXY_BANNER_IMAGES_ENDPOINT'));

        if(sizeof($tmp_evifweb_proxy_data_ARRAY)!=2){

            self::$oLogger->captureNotice('CRON Fired Banner Carousel :: XML Request for Image Hosting Resource Endpoints', LOG_CRIT, 'Expecting string split into array(2), but this did not happen.');
            return '';

        }

        $tmp_xmltime = $this->microtime_float();

        $xml_construct_ARRAY['XML']['OPEN'] = '<?xml version="1.0" encoding="iso-8859-1"?>
<jony5_dot_com_banner_xml>';
        $xml_construct_ARRAY['XML']['CLOSE'] = '
</jony5_dot_com_banner_xml>';

        $xml_construct_ARRAY['NODE']['TOTAL_SCANNED'] = '
   <jony5_total_images_count>'.self::$banner_array_size.'</jony5_total_images_count>';
        $xml_construct_ARRAY['NODE']['BANNER_OPEN'] = '
   <banner_images_index>';
        $xml_construct_ARRAY['NODE']['BANNER_CLOSE'] = '
   </banner_images_index>';
        $xml_construct_ARRAY['NODE']['BANNER_IMAGES_INDEX'] = '';

        $tmp_flag_used_img = array();
        $ii = 0;

        for($i=0;$i<self::$banner_array_size;$i++){

            //$tmp_file_name = self::$banner_filename_array[mt_rand(0, (self::$banner_array_size))];
            $tmp_file_name = self::$banner_filename_array[$i];

            if(strlen($tmp_file_name)<5){

                //
                // TRY AGAIN
                $tmp_file_name = self::$banner_filename_array[mt_rand(0, (self::$banner_array_size))];

            }

            if(strlen($tmp_file_name)<5){

                //
                // IF STILL LESS THAN...USE DEFAULT IMAGE
                $tmp_file_name = self::$default_banner_file;

            }

            if(!isset($tmp_flag_used_img[$tmp_file_name])){
                $tmp_flag_used_img[$tmp_file_name] = 1;

                /*
                 = filesize($_FILES["assetfile"]["tmp_name"]);
                $this->assetParams['FILE_MIME_TYPE'] = mime_content_type($_FILES["assetfile"]["tmp_name"]);
                $this->assetParams['FILE_MD5'] = md5_file($_FILES["assetfile"]["tmp_name"]);  // 32
        $this->assetParams['FILE_SHA1'] = sha1_file($_FILES["assetfile"]["tmp_name"]);  // 40

                $this->formatBytes(,3);

                 * */
                $tmp_file = self::$oEnv->getEnvParam('DOCUMENT_ROOT').self::$oEnv->getEnvParam('DOCUMENT_ROOT_DIR').'/'.$dir_path.$tmp_file_name;

                $tmp_md5_file = md5_file($tmp_file);  // 32
                $tmp_sha1_file = sha1_file($tmp_file);  // 40
                $tmp_filesize = filesize($tmp_file);
                $tmp_filesize = $this->formatBytes($tmp_filesize,3);
                list($img_width, $img_height) = getimagesize($tmp_file);

                $tmp_valid_img = 'true';
                if($img_width<1180 || $img_height<250){
                    $tmp_valid_img = 'false';
                    $tmp_invalid_img_cnt++;
                }

                $xml_construct_ARRAY['NODE']['BANNER_IMAGES_INDEX'] .= '
      <banner_img>
        <queue_position>'.$ii.'</queue_position>
        <uri>'.self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').$dir_path.$tmp_file_name.'</uri>
        <filesize>'.$tmp_filesize.'</filesize>
        <md5>'.$tmp_md5_file.'</md5>
        <sha1>'.$tmp_sha1_file.'</sha1>
        <valid_dimensions>'.$tmp_valid_img.'</valid_dimensions>
      </banner_img>';

                $ii++;

                //
                // DO WE BAIL?
                if($i>self::$banner_array_size){
                    $bail_count = $i;

                    $i = self::$banner_array_size + 1;

                }

            }

        }

        $tmp_xmltime_scan = $this->microtime_float();
        $tmp_mtime_xml_build_delta = $tmp_xmltime_scan - $tmp_xmltime;

        if(!isset($bail_count)){

            $bail_count = $i;

        }

        $xml_construct_ARRAY['NODE']['TOTAL_MATCHED'] = '
   <total_matched>'.$ii.'</total_matched>';
        $xml_construct_ARRAY['NODE']['MATCH_ATTEMPTS'] = '
   <total_match_attempts>'.$bail_count.'</total_match_attempts>';

        //
        // FIRE AT 0419
        $tmp_secs = date("s", time());
        //error_log('Current min seconds = '.$tmp_secs);

        $tmp_time_buffer = 60 - $tmp_secs;
        //$overhead = 58.0000000000000000;
        //error_log('Current buffer = '.$tmp_time_buffer);
        sleep($tmp_time_buffer);
        //$tmp_oht = (double) $tmp_mtime_overhead + (double) $overhead;
        $tmp_oht = (double) $tmp_mtime_overhead;
        self::$ts = date("Y-m-d H:i:s T", time());
        $xml_construct_ARRAY['NODE']['XML_GENERATION_JPG_INVALID_DIMENSIONS'] = '
   <total_file_scan_invalid_dimensions>'.$tmp_invalid_img_cnt.'</total_file_scan_invalid_dimensions>';
        $xml_construct_ARRAY['NODE']['XML_GENERATION_PNG_FILTERED'] = '
   <png_file_scan_filtered_out>'.$tmp_png_filtered.'</png_file_scan_filtered_out>';
        $xml_construct_ARRAY['NODE']['DATE_SCANNED'] = '
   <date_images_scanned>'.self::$ts.'</date_images_scanned>';  //
        $xml_construct_ARRAY['NODE']['XML_GENERATION_SCRIPT_SLEEP_SECS'] = '
   <xml_generation_script_sleep_secs>'.(double) $tmp_time_buffer.'</xml_generation_script_sleep_secs>';
        $xml_construct_ARRAY['NODE']['XML_GENERATION_SCRIPT_OVERHEAD_SECS'] = '
   <xml_generation_script_overhead_secs>'.$tmp_oht.'</xml_generation_script_overhead_secs>';
        $xml_construct_ARRAY['NODE']['XML_GENERATION_IMG_SCAN_SECS'] = '
   <xml_generation_image_file_dir_scan_secs>'.substr($tmp_mtime_scan_delta,0,-8).'</xml_generation_image_file_dir_scan_secs>';
        $xml_construct_ARRAY['NODE']['XML_GENERATION_XML_BUILD_SECS'] = '
   <xml_generation_xml_build_secs>'.substr($tmp_mtime_xml_build_delta,0,-8).'</xml_generation_xml_build_secs>';
        $xml_construct_ARRAY['NODE']['XML_GENERATION_TIME'] = '
   <xml_generation_walltime_secs>'.self::$oEnv->wallTime().'</xml_generation_walltime_secs>'.$tmp_evifweb_proxy_data_ARRAY[0];
        $tmp_output_XML = $xml_construct_ARRAY['XML']['OPEN'].$xml_construct_ARRAY['NODE']['DATE_SCANNED'].$xml_construct_ARRAY['NODE']['TOTAL_SCANNED'].$xml_construct_ARRAY['NODE']['TOTAL_MATCHED'].$xml_construct_ARRAY['NODE']['XML_GENERATION_PNG_FILTERED'].$xml_construct_ARRAY['NODE']['XML_GENERATION_JPG_INVALID_DIMENSIONS'].$xml_construct_ARRAY['NODE']['MATCH_ATTEMPTS'].$xml_construct_ARRAY['NODE']['XML_GENERATION_SCRIPT_SLEEP_SECS'].$xml_construct_ARRAY['NODE']['XML_GENERATION_SCRIPT_OVERHEAD_SECS'].$xml_construct_ARRAY['NODE']['XML_GENERATION_IMG_SCAN_SECS'].$xml_construct_ARRAY['NODE']['XML_GENERATION_XML_BUILD_SECS'].$xml_construct_ARRAY['NODE']['XML_GENERATION_TIME'].$xml_construct_ARRAY['NODE']['BANNER_OPEN'].$xml_construct_ARRAY['NODE']['BANNER_IMAGES_INDEX'].$tmp_evifweb_proxy_data_ARRAY[1].$xml_construct_ARRAY['NODE']['BANNER_CLOSE'].$xml_construct_ARRAY['XML']['CLOSE'];

        $tmp_len = strlen($tmp_output_XML);

        if($tmp_len < 500000){

            self::$oLogger->captureNotice('CRON Fired Banner Carousel :: XML Request - Image Hosting Resource Endpoints', LOG_CRIT, 'XML character count seems a bit low at strlen = '.$tmp_len.'. Hosting endpoint :: http://evifweb.com/common/imgs/jony5_banner_1180x250/_proxy_xml_request.php');
            return '';
        }

        return $tmp_output_XML;

    }

    private function return_evifweb_proxy_xml($proxy_endpoint){

        //
        // CURL DATA FROM EVIFWEB, PARSE TO ARRAY AND RETURN
        $tmp_null_array = array();
        //$tmp_evif_data = $this->getUrlContent($proxy_endpoint, 'evifweb.com');
        $tmp_evif_data = $this->curl_get($proxy_endpoint,$tmp_null_array);
        //error_log('559 - '.$tmp_evif_data);
        $tmp_evif_data_array = explode('{DATA_DELIM}', $tmp_evif_data);

        $tmp_len = strlen($tmp_evif_data_array[0]);

        //self::$oLogger->captureNotice('CRON fired request for XML at '.$proxy_endpoint, LOG_NOTICE, 'Pulled '.$tmp_len.' chars of meta data. Confirm source endpoint to be http://evifweb.com/common/imgs/jony5_banner_1180x250/_proxy_xml_request.php');

        return $tmp_evif_data_array;
    }

    //
    // CURL EVIFWEB PROXY IMAGE XML
    /**
     * SOURCE :: https://www.php.net/manual/en/function.curl-exec.php
     * AUTHOR :: https://www.php.net/manual/en/function.curl-exec.php#98628
     * Send a GET requst using cURL
     * @param string $url to request
     * @param array $get values to send
     * @param array $options for cURL
     * @return string
     */
    private function curl_get($url, array $get = NULL, array $options = array())
    {
        $defaults = array(
            CURLOPT_URL => $url. (strpos($url, '?') === FALSE ? '?' : ''). http_build_query($get),
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_TIMEOUT => 40
        );

        $ch = curl_init();
        curl_setopt_array($ch, ($options + $defaults));
        if( ! $result = curl_exec($ch))
        {
            self::$oLogger->captureNotice('[ERROR] CRON Fired CURL for XML', LOG_NOTICE, curl_error($ch));
            $result = '';
            //trigger_error(curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }

    private function better_scandir($dir, $sorting_order = SCANDIR_SORT_ASCENDING) {

        /****************************************************************************/
        // Roll through the scandir values.
        $files = array();
        foreach (scandir($dir, $sorting_order) as $file) {
            if ($file[0] === '.') {
                continue;
            }
            $files[$file] = filemtime($dir . '/' . $file);
        } // foreach

        /****************************************************************************/
        // Sort the files array.
        if ($sorting_order == SCANDIR_SORT_ASCENDING) {
            asort($files, SORT_NUMERIC);
        }
        else {
            arsort($files, SORT_NUMERIC);
        }

        /****************************************************************************/
        // Set the final return value.
        $ret = array_keys($files);

        /****************************************************************************/
        // Return the final value.
        return ($ret) ? $ret : false;

    } // better_scandir

    public function return_image_check($dir_path){

        $tmp_min_start = self::$oEnv->oHTTP_MGR->extractData($_GET, 'start');
        $tmp_max_end = self::$oEnv->oHTTP_MGR->extractData($_GET, 'end');
        $tmp_lastcount = self::$oEnv->oHTTP_MGR->extractData($_GET, 'lastcount');

        $tmp_mtime = $this->microtime_float();
        $tmp_mtime_overhead = $this->microtime_float() - self::$oEnv->starttime;
        $tmp_mtime_overhead = substr($tmp_mtime_overhead,0,-8);

        $xml_construct_ARRAY = array();
        $tmp_dir = self::$oEnv->getEnvParam('DOCUMENT_ROOT').self::$oEnv->getEnvParam('DOCUMENT_ROOT_DIR').'/'.$dir_path;

        //self::$banner_filename_array = scandir($tmp_dir, 1);
        self::$banner_filename_array = $this->better_scandir($tmp_dir);

        $tmp = array_pop(self::$banner_filename_array);
        $tmp = array_pop(self::$banner_filename_array);

        //self::$banner_array_size = sizeof(self::$banner_filename_array)-2;

        //
        // BUILD NEW ARRAY WITH NO PNG
        $tmp_new_banner_array = array();
        $tmp_invalid_img_cnt = 0;
        $tmp_png_filtered = 0;
        $tmp_banner_size = sizeof(self::$banner_filename_array);
        //self::$banner_filename_array = $this->queueFileByTimestamp(self::$banner_filename_array, $dir_path);

        for($i=0;$i<$tmp_banner_size;$i++){

            $tmp_pos_png = strpos(self::$banner_filename_array[$i], '.png');
            $tmp_pos_ds_store = strpos(self::$banner_filename_array[$i], 'DS_Store');

            //
            // IF NO PNG
            if(($tmp_pos_png===false) && ($tmp_pos_ds_store===false)){
                $tmp_new_banner_array[] = self::$banner_filename_array[$i];
            }else{

                $tmp_png_filtered++;
            }

        }

        self::$banner_filename_array = $tmp_new_banner_array;
        self::$banner_array_size = sizeof(self::$banner_filename_array);
        $tmp_html_output = '<!doctype html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="shortcut icon" type="image/x-icon" href="http://www.jony5.com/favicon.ico" />
<link rel="icon" type="image/x-icon" href="http://www.jony5.com/favicon.ico" />
<meta http-equiv="Content-Language" content="en-us" />
<meta name="distribution" content="Global" />
<meta name="ROBOTS" content="ALL" />
<meta name="ROBOTS" CONTENT="noodp" />
<meta name="Slurp" CONTENT="NOYDIR" />
<meta name="description" content="They will mount up with wings like eagles (Isaiah 40:31b). The eagles\' wings signify the resurrection power of Christ. God\'s power in life, becoming our grace (cf. 1 Cor. 25:10; 2 Cor. 4:7; 12:9a)." />
<meta name="keywords" content="j5, jonathan harris, jonathan, email, email marketing, web, christian, jesus, web services, business processes, web development, marketing, CSS, XHTML, php, javascript, atlanta" />

<title>They will mount up with wings like eagles.</title>
<link rel="stylesheet" href="./common/css/theme/dark/main.css" type="text/css" />
</head>

<body>';

        for($i=0;$i<self::$banner_array_size;$i++){

            //$tmp_file_name = self::$banner_filename_array[mt_rand(0, (self::$banner_array_size))];
            $tmp_file_name = self::$banner_filename_array[$i];

            if(strlen($tmp_file_name)>5){


                if(!isset($tmp_flag_used_img[$tmp_file_name])){
                    $tmp_flag_used_img[$tmp_file_name] = 1;

                    $tmp_file = self::$oEnv->getEnvParam('DOCUMENT_ROOT').self::$oEnv->getEnvParam('DOCUMENT_ROOT_DIR').'/'.$dir_path.$tmp_file_name;

                    //$tmp_md5_file = md5_file($tmp_file);  // 32
                    //$tmp_sha1_file = sha1_file($tmp_file);  // 40
                    //$tmp_filesize = filesize($tmp_file);
                    //$tmp_filesize = $this->formatBytes($tmp_filesize,3);
                    list($img_width, $img_height) = getimagesize($tmp_file);

                    $tmp_valid_img = 'true';

                    if($img_width<1180 || $img_height<250){
                        $tmp_valid_img = 'false';
                        $tmp_invalid_img_cnt++;
                    }

                    /*

        $tmp_min_start = self::$oEnv->oHTTP_MGR->extractData($_GET, 'start');
        $tmp_max_end = self::$oEnv->oHTTP_MGR->extractData($_GET, 'end');
        $tmp_lastcount = self::$oEnv->oHTTP_MGR->extractData($_GET, 'lastcount');
                     * */

                    if($tmp_lastcount>2){

                        if((self::$banner_array_size - $tmp_lastcount) < $i){
                            $tmp_html_output .= '
                      <div style="margin:5px; width:1180px; height:250px; background-color:#FF0000; border:2px solid #13FF00;">
                        <img src="'.self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').$dir_path.$tmp_file_name.'" alt="J5">
                      </div>';

                        }

                    }else{

                        $tmp_html_output .= '
                      <div style="margin:5px; width:1180px; height:250px; background-color:#FF0000; border:2px solid #13FF00;">
                        <img src="'.self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').$dir_path.$tmp_file_name.'" alt="J5">
                      </div>';

                    }


                }
            }

        }


        $tmp_html_output .= '</body>
</html>';

        return $tmp_html_output;

    }

    public function return_xml_timestamp(){

        if(!isset(self::$ts)){

            $tmp_ts = date("Y-m-d H:i:s", time());
            return '~'.$tmp_ts;

        }else{

            return self::$ts;

        }

    }

    //
    // SOURCE :: https://stackoverflow.com/questions/2510434/format-bytes-to-kilobytes-megabytes-gigabytes
    // AUTHOR :: https://stackoverflow.com/users/227532/leo
    private function formatBytes($bytes, $precision = 2) {
        $units = array('bytes', 'KiB', 'MiB', 'GiB', 'TiB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    public function return_random_image_HTML($dir_path){

        /*
         * CONSIDER EXPOSING THE FOLLOWING META ::
         * - TOTAL NUMBER OF SCANNED IMAGES RETURNED TO SESSION PER TTL *
         * - TOTAL NUMBER OF TIMES AN IMAGE HAS BEEN SHOWN PER TTL
         * - TOTAL NUMBER OF TIMES AN IMAGE HAS BEEN SHOWN
         * - TTL REFRESH COUNT *
         * */

        $tmp_mtime = $this->microtime_float();
        $tmp_new_banner_array = array();

        //
        // DO WE HAVE FILENAMES
        if(!isset(self::$banner_filename_array[1])){

            //error_log("banner carousel return_random_image_HTML() (60) I am getting *FRESH* session data...");

            $tmp_dir = self::$oEnv->getEnvParam('DOCUMENT_ROOT').self::$oEnv->getEnvParam('DOCUMENT_ROOT_DIR').'/'.$dir_path;
            self::$banner_filename_array = scandir($tmp_dir, 1);

            $tmp = array_pop(self::$banner_filename_array);
            $tmp = array_pop(self::$banner_filename_array);

            //self::$banner_array_size = sizeof(self::$banner_filename_array)-2;
            self::$banner_array_size = sizeof(self::$banner_filename_array);

            for($i=0;$i<self::$banner_array_size;$i++){

                $tmp_pos_png = strpos(self::$banner_filename_array[$i], '.png');

                //
                // IF NO PNG
                if(($tmp_pos_png===false)){
                    $tmp_new_banner_array[] = self::$banner_filename_array[$i];
                }

            }

            self::$banner_filename_array = $tmp_new_banner_array;

            shuffle(self::$banner_filename_array);

            //$tmp_mtime_scan = $this->microtime_float();
            //$tmp_mtime_scan_delta = $tmp_mtime_scan - $tmp_mtime;

            //
            // SANITY CHECK
            if(self::$banner_array_size<3){

                self::$oLogger->captureNotice('Directory scan ERROR on session initialization attempt :: size=['.self::$banner_array_size.']', LOG_CRIT, 'The directory of interest for our image search is '.$tmp_dir);
                //return '<img ttl_delta_ERROR="'.self::$ttl_delta.'" ttl="'.self::$ttl.'" scan_cnt="'.self::$banner_array_size.'" src="'.self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').$dir_path.self::$default_banner_file.'" width="1180" height="250" alt="J5">';

            }

            $tmp_file_name = array_rand(array_flip(self::$banner_filename_array), 1);
            //$tmp_file_name = self::$banner_filename_array[mt_rand(0, (self::$banner_array_size))];

            if(strlen($tmp_file_name)<5){

                //
                // TRY AGAIN
                $tmp_file_name = array_rand(array_flip(self::$banner_filename_array), 1);
                //$tmp_file_name = self::$banner_filename_array[mt_rand(0, (self::$banner_array_size))];

            }

            if(strlen($tmp_file_name)<5){

                //
                // IF STILL LESS THAN...USE DEFAULT IMAGE
                $tmp_file_name = self::$default_banner_file;

            }

            return '<img src="'.self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').$dir_path.$tmp_file_name.'" width="1180" height="250" alt="Jonathan \'J5\' Harris">';

        }else{

            //
            // PULL REMAINING META FROM SESSION AND ENFORCE TTL
            $tmp_banner_array_size = sizeof(self::$banner_filename_array);

            $tmp_file_name = array_rand(array_flip(self::$banner_filename_array), 1);
            //$tmp_file_name = self::$banner_filename_array[mt_rand(0, ($tmp_banner_array_size))];

            if(strlen($tmp_file_name)<5){

                //
                // TRY AGAIN
                $tmp_file_name = self::$banner_filename_array[mt_rand(0, ($tmp_banner_array_size))];

            }

            if(strlen($tmp_file_name)<5){

                //
                // IF STILL LESS THAN...USE DEFAULT IMAGE
                $tmp_file_name = self::$default_banner_file;


            }

            return '<img src="'.self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').$dir_path.$tmp_file_name.'" width="1180" height="250" alt="Jonathan \'J5\' Harris">';

        }

    }

    private function ttl_expired($start_mtime){

        $tmp_mtime = $this->microtime_float();
        self::$ttl_delta = $tmp_mtime - $start_mtime;

        //error_log("banner_carousel (126) delta [".$tmp_delta."] | ttl[".self::$ttl."] | start mtime[".$start_mtime."] | curr mtime[".$tmp_mtime."]");

        if(self::$ttl_delta>self::$ttl){

            if(self::$oEnv->oSESSION_MGR->issetSessionParam("BANNER_SESSION_TTL_REFRESH_CNT")){

                self::$ttl_refresh_cnt = self::$oEnv->oSESSION_MGR->getSessionParam("BANNER_SESSION_TTL_REFRESH_CNT");
                self::$ttl_refresh_cnt++;

            }else{

                self::$ttl_refresh_cnt=1;
            }

            self::$oEnv->oSESSION_MGR->setSessionParam("BANNER_SESSION_TTL_REFRESH_CNT", self::$ttl_refresh_cnt);


            if(self::$oEnv->oSESSION_MGR->issetSessionParam("BANNER_IMAGE_ACTIVITY_INIT")){
                //$tmp_image_activity_array = array();  # where $tmp_image_activity_array...0=TTL-TOTAL, 1=TOTAL-TOTAL, ?? 2=HIGHEST-EXISTING-TOTAL ??
                $tmp_image_activity_array = self::$oEnv->oSESSION_MGR->getSessionParam("BANNER_IMAGE_ACTIVITY_ARRAY");

                $tmp_image_activity_array[0] = array();

                self::$oEnv->oSESSION_MGR->setSessionParam("BANNER_IMAGE_ACTIVITY_ARRAY", $tmp_image_activity_array);

            }

            self::$oEnv->oSESSION_MGR->setSessionParam("BANNER_TTL_HIGHEST_CNT", 0);

            return true;

        }else{

            if(self::$oEnv->oSESSION_MGR->issetSessionParam("BANNER_SESSION_TTL_REFRESH_CNT")){

                self::$ttl_refresh_cnt = self::$oEnv->oSESSION_MGR->getSessionParam("BANNER_SESSION_TTL_REFRESH_CNT");

            }else{

                self::$ttl_refresh_cnt=0;
            }

            return false;
        }

    }

    //
    // SOURCE :: http://www.php.net/manual/en/function.microtime.php
    private function microtime_float(){
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
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

    public function __destruct() {

    }

}