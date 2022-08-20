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
#  CLASS :: crnrstn_mysql_table_workshop
#  VERSION :: 1.00.0000
#  DATE :: December 1, 2021 @ 2100 hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: A MySQL table maintenance class.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_mysql_table_workshop {

    public $oCRNRSTN_USR;

    private static $primary_key_updated_ARRAY = array();
    private static $social_link_field_ARRAY = array();
    private static $social_media_key_ARRAY = array();

    public function __construct($oCRNRSTN_USR) {

        $this->oCRNRSTN_USR = $oCRNRSTN_USR;

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN_USR);

    }

    private function return_social_media_key_array(){

        $tmp_array = array();

        $tmp_array['LINK_SOUNDCLOUD'] = 'soundcloud';
        $tmp_array['LINK_SOUNDCLOUD2'] = 'soundcloud';
        $tmp_array['LINK_SOUNDCLOUD3'] = 'soundcloud';

        $tmp_array['LINK_FACEBOOK'] = 'facebook';
        $tmp_array['LINK_FACEBOOK2'] = 'facebook';
        $tmp_array['LINK_FACEBOOK3'] = 'facebook';

        $tmp_array['LINK_INSTAGRAM'] = 'instagram';
        $tmp_array['LINK_INSTAGRAM2'] = 'instagram';
        $tmp_array['LINK_INSTAGRAM3'] = 'instagram';

        $tmp_array['LINK_TWITTER'] = 'twitter';
        $tmp_array['LINK_TWITTER2'] = 'twitter';
        $tmp_array['LINK_TWITTER3'] = 'twitter';

        $tmp_array['LINK_MIXCLOUD'] = 'mixcloud';
        $tmp_array['LINK_MIXCLOUD2'] = 'mixcloud';
        $tmp_array['LINK_MIXCLOUD3'] = 'mixcloud';

        $tmp_array['LINK_DISCOGS'] = 'discogs';
        $tmp_array['LINK_DISCOGS2'] = 'discogs';
        $tmp_array['LINK_DISCOGS3'] = 'discogs';

        $tmp_array['LINK_BEATPORT'] = 'beatport';
        $tmp_array['LINK_BEATPORT2'] = 'beatport';
        $tmp_array['LINK_BEATPORT3'] = 'beatport';

        $tmp_array['LINK_BANDCAMP'] = 'bandcamp';
        $tmp_array['LINK_BANDCAMP2'] = 'bandcamp';
        $tmp_array['LINK_BANDCAMP3'] = 'bandcamp';

        $tmp_array['LINK_SPOTIFY'] = 'spotify';
        $tmp_array['LINK_SPOTIFY2'] = 'spotify';
        $tmp_array['LINK_SPOTIFY3'] = 'spotify';

        $tmp_array['LINK_ROLLDABEATS'] = 'rolldabeats';
        $tmp_array['LINK_ROLLDABEATS2'] = 'rolldabeats';
        $tmp_array['LINK_ROLLDABEATS3'] = 'rolldabeats';

        $tmp_array['LINK_YOUTUBE'] = 'youtube';
        $tmp_array['LINK_YOUTUBE2'] = 'youtube';
        $tmp_array['LINK_YOUTUBE3'] = 'youtube';

        $tmp_array['LINK_WWW'] = 'www';
        $tmp_array['LINK_WWW2'] = 'www';
        $tmp_array['LINK_WWW3'] = 'www';

        return $tmp_array;

    }

    public function add_crc_checksum_to_table($table_name, $serial_field_nom, $checksum_field_nom){

        try {

            $oCRNRSTN_MySQLi = $this->oCRNRSTN_USR->return_crnrstn_mysqli();
            $mysqli = $oCRNRSTN_MySQLi->return_conn_object();

            $tmp_query = 'SELECT `' . $table_name . '`.`' . $serial_field_nom . '`
            FROM `' . $table_name . '`;';

            //
            // add_database_query() WILL SERIALIZE THE QUERY TO THE CONNECTION PROVIDED. CRNRSTN :: SUPPORTS n+1 MYSQLI DATABASE CONNECTIONS.
            $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CHECKSUM_MAINT', '!jesus_is_my_dear_lord!', 'CHECK_SUM_DATA', __LINE__, __METHOD__);
            $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

            //
            // PROCESS ALL QUERY TO CONNECTION(S)
            $this->oCRNRSTN_USR->process_query();

            $tmp_CHECK_SUM_DATA_count = $this->oCRNRSTN_USR->return_record_count('CHECK_SUM_DATA');

             for($i = 0; $i < $tmp_CHECK_SUM_DATA_count; $i++) {

                $tmp_SOCIAL_ID = trim($this->oCRNRSTN_USR->return_database_value('CHECK_SUM_DATA', $serial_field_nom, $i));

                //
                // IF STREAM KEY UNDETERMINED, THROW EXCEPTION AND SPOIL THIS RECORD.
                if (strlen($tmp_SOCIAL_ID) > 0) {

                    $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();
                    $tmp_checksum = $this->oCRNRSTN_USR->crcINT($tmp_SOCIAL_ID);

                    $tmp_query = 'UPDATE `' . $table_name . '`
                    SET
                    `' . $checksum_field_nom . '` = ' . $tmp_checksum.',
                    `DATEMODIFIED` = "' . $ts . '"
                    WHERE `' . $table_name . '`.`' . $serial_field_nom . '` = "' . $tmp_SOCIAL_ID . '" LIMIT 1;';

                    $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_MAINT', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                    $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                }

            }

            //
            // PROCESS ALL QUERY TO CONNECTION(S)
            $this->oCRNRSTN_USR->process_query(true);

            return '<div style="padding:20px; color:#6c645c; line-height: 25px; font-size: 16px; font-family: Arial, Helvetica, sans-serif;">' . __METHOD__ . '<br>All done on ' . $tmp_CHECK_SUM_DATA_count . ' records! [lnum '. __LINE__ .'] [rtime ' . $this->oCRNRSTN_USR->wall_time() . ']</div>';
            //throw new Exception('CRNRSTN :: ' . $this->oCRNRSTN_USR->version_crnrstn().' :: Invalid Bassdrive Relay JSON from URL=[' . $this->oCRNRSTN_USR->get_resource('BASSDRIVE_RELAY_STATE').'] ERROR on '. __METHOD__ .' from ' . $_SERVER['SERVER_NAME'].' (' . $_SERVER['SERVER_ADDR'].'). Where err=' . $this->oRELAY_MANAGER->return_relay_ojson_err());

        } catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function restructure_stream_relay_social_table(){

        try {

            $tmp_UPDATE_link_processed_cnt = $tmp_INSERT_link_processed_cnt = 0;

            $oCRNRSTN_MySQLi = $this->oCRNRSTN_USR->return_crnrstn_mysqli();
            $mysqli = $oCRNRSTN_MySQLi->return_conn_object();

            $tmp_query = 'SELECT `crnrstn_stream_relay_social`.`SOCIAL_ID`,
                `crnrstn_stream_relay_social`.`STREAM_KEY`,
                `crnrstn_stream_relay_social`.`LINK_SOUNDCLOUD`,
                `crnrstn_stream_relay_social`.`LINK_SOUNDCLOUD2`,
                `crnrstn_stream_relay_social`.`LINK_SOUNDCLOUD3`,
                `crnrstn_stream_relay_social`.`LINK_FACEBOOK`,
                `crnrstn_stream_relay_social`.`LINK_FACEBOOK2`,
                `crnrstn_stream_relay_social`.`LINK_FACEBOOK3`,
                `crnrstn_stream_relay_social`.`LINK_INSTAGRAM`,
                `crnrstn_stream_relay_social`.`LINK_INSTAGRAM2`,
                `crnrstn_stream_relay_social`.`LINK_INSTAGRAM3`,
                `crnrstn_stream_relay_social`.`LINK_TWITTER`,
                `crnrstn_stream_relay_social`.`LINK_TWITTER2`,
                `crnrstn_stream_relay_social`.`LINK_TWITTER3`,
                `crnrstn_stream_relay_social`.`LINK_MIXCLOUD`,
                `crnrstn_stream_relay_social`.`LINK_MIXCLOUD2`,
                `crnrstn_stream_relay_social`.`LINK_MIXCLOUD3`,
                `crnrstn_stream_relay_social`.`LINK_DISCOGS`,
                `crnrstn_stream_relay_social`.`LINK_DISCOGS2`,
                `crnrstn_stream_relay_social`.`LINK_DISCOGS3`,
                `crnrstn_stream_relay_social`.`LINK_BEATPORT`,
                `crnrstn_stream_relay_social`.`LINK_BEATPORT2`,
                `crnrstn_stream_relay_social`.`LINK_BEATPORT3`,
                `crnrstn_stream_relay_social`.`LINK_BANDCAMP`,
                `crnrstn_stream_relay_social`.`LINK_BANDCAMP2`,
                `crnrstn_stream_relay_social`.`LINK_BANDCAMP3`,
                `crnrstn_stream_relay_social`.`LINK_SPOTIFY`,
                `crnrstn_stream_relay_social`.`LINK_SPOTIFY2`,
                `crnrstn_stream_relay_social`.`LINK_SPOTIFY3`,
                `crnrstn_stream_relay_social`.`LINK_ROLLDABEATS`,
                `crnrstn_stream_relay_social`.`LINK_ROLLDABEATS2`,
                `crnrstn_stream_relay_social`.`LINK_ROLLDABEATS3`,
                `crnrstn_stream_relay_social`.`LINK_YOUTUBE`,
                `crnrstn_stream_relay_social`.`LINK_YOUTUBE2`,
                `crnrstn_stream_relay_social`.`LINK_YOUTUBE3`,
                `crnrstn_stream_relay_social`.`LINK_WWW`,
                `crnrstn_stream_relay_social`.`LINK_WWW2`,
                `crnrstn_stream_relay_social`.`LINK_WWW3`
            FROM `crnrstn_stream_relay_social`
            WHERE `crnrstn_stream_relay_social`.`ISACTIVE` = 1
            ORDER BY `crnrstn_stream_relay_social`.`DATEMODIFIED` DESC LIMIT 1;';

            //
            // add_database_query() WILL SERIALIZE THE QUERY TO THE CONNECTION PROVIDED. CRNRSTN :: SUPPORTS n+1 MYSQLI DATABASE CONNECTIONS.
            $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CHECKSUM_MAINT', '!jesus_is_my_dear_lord!', 'SOCIAL_LINK_DATA', __LINE__, __METHOD__);
            $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

            //
            // PROCESS ALL QUERY TO CONNECTION(S)
            $this->oCRNRSTN_USR->process_query();

            $tmp_SOCIAL_LINK_DATA_count = $this->oCRNRSTN_USR->return_record_count('SOCIAL_LINK_DATA');

            for($i = 0; $i < $tmp_SOCIAL_LINK_DATA_count; $i++) {

                $tmp_SOCIAL_ID_SOLO = trim($this->oCRNRSTN_USR->return_database_value('SOCIAL_LINK_DATA', 'SOCIAL_ID', $i));
                $tmp_STREAM_KEY_SOLO = trim($this->oCRNRSTN_USR->return_database_value('SOCIAL_LINK_DATA', 'STREAM_KEY', $i));

                self::$social_media_key_ARRAY = $this->return_social_media_key_array();

                foreach(self::$social_media_key_ARRAY as $field_name => $social_media_type_key){

                    //return '$social_media_key_ARRAY=[' . $field_name . '][' . $social_media_type_key . '], where cnt=[' . $tmp_SOCIAL_LINK_DATA_count . '] and row 1=[' . $tmp_SOCIAL_ID_SOLO . '][' . $tmp_STREAM_KEY_SOLO . ']';
                    //die();

                    $tmp_MEDIA_KEY = $social_media_type_key;
                    $tmp_SOCIAL_URL = trim($this->oCRNRSTN_USR->return_database_value('SOCIAL_LINK_DATA', $field_name, $i));

                    if(strlen($tmp_SOCIAL_URL) > 0){

                        $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();

                        if(isset(self::$primary_key_updated_ARRAY[$tmp_SOCIAL_ID_SOLO])){

                            $tmp_INSERT_link_processed_cnt++;

                            $tmp_SOCIAL_ID = $this->oCRNRSTN_USR->generate_new_key(64);

                            $tmp_query = 'INSERT INTO `crnrstn_stream_relay_social`
                            (`SOCIAL_ID`,
                            `SOCIAL_ID_CRC32`,
                            `STREAM_KEY`,
                            `STREAM_KEY_CRC32`,
                            `SOCIAL_MEDIA_KEY`,
                            `SOCIAL_MEDIA_KEY_CRC32`,
                            `CLICKTHROUGH_URL`,
                            `DATEMODIFIED`)
                            VALUES
                            ("' . $tmp_SOCIAL_ID . '",
                            ' . $this->oCRNRSTN_USR->crcINT($tmp_SOCIAL_ID) . ',
                            "' . $mysqli->real_escape_string($tmp_STREAM_KEY_SOLO) . '",
                            ' . $this->oCRNRSTN_USR->crcINT($tmp_STREAM_KEY_SOLO) . ',
                            "' . $mysqli->real_escape_string($tmp_MEDIA_KEY) . '",
                            ' . $this->oCRNRSTN_USR->crcINT($tmp_MEDIA_KEY) . ',
                            "' . $mysqli->real_escape_string($tmp_SOCIAL_URL) . '",
                            "' . $ts . '");
                            ';

                        }else{

                            $tmp_UPDATE_link_processed_cnt++;
                            self::$primary_key_updated_ARRAY[$tmp_SOCIAL_ID_SOLO] = 1;

                            $tmp_query = 'UPDATE `crnrstn_stream_relay_social`
                            SET
                            `SOCIAL_MEDIA_KEY` = "' . $mysqli->real_escape_string($tmp_MEDIA_KEY) . '",
                            `SOCIAL_MEDIA_KEY_CRC32` = ' . $this->oCRNRSTN_USR->crcINT($tmp_MEDIA_KEY) . ',
                            `ISACTIVE` = 5,
                            `CLICKTHROUGH_URL` = "' . $mysqli->real_escape_string($tmp_SOCIAL_URL) . '",
                            `DATEMODIFIED` = "' . $ts . '"
                            WHERE `SOCIAL_ID` = "' . $mysqli->real_escape_string($tmp_SOCIAL_ID_SOLO) . '" 
                            AND `SOCIAL_ID_CRC32` = ' . $this->oCRNRSTN_USR->crcINT($tmp_SOCIAL_ID_SOLO) . ' LIMIT 1;';

                        }

                        $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_MAINT', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                        $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                    }

                }

            }

            if($tmp_UPDATE_link_processed_cnt > 0){

                //
                // PROCESS ALL QUERY TO CONNECTION(S)
                $this->oCRNRSTN_USR->process_query(true);

            }else{

                $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();

                $tmp_query = 'UPDATE `crnrstn_stream_relay_social`
                SET
                `ISACTIVE` = 5,
                `DATEMODIFIED` = "' . $ts . '"
                WHERE `SOCIAL_ID` = "' . $mysqli->real_escape_string($tmp_SOCIAL_ID_SOLO) . '" 
                AND `SOCIAL_ID_CRC32` = ' . $this->oCRNRSTN_USR->crcINT($tmp_SOCIAL_ID_SOLO) . ' LIMIT 1;';

                $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_MAINT', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                //
                // PROCESS ALL QUERY TO CONNECTION(S)
                $this->oCRNRSTN_USR->process_query(true);

            }

            return '<div style="padding:20px; color:#6c645c; line-height: 25px; font-size: 16px; font-family: Arial, Helvetica, sans-serif;">' . __METHOD__ . '<br>All done on ' . $tmp_INSERT_link_processed_cnt + $tmp_UPDATE_link_processed_cnt . ' records[' . $tmp_UPDATE_link_processed_cnt . '/' . $tmp_INSERT_link_processed_cnt . ']! [lnum '. __LINE__ .'] [rtime ' . $this->oCRNRSTN_USR->wall_time() . ' secs]</div>';
            //throw new Exception('CRNRSTN :: ' . $this->oCRNRSTN_USR->version_crnrstn().' :: Invalid Bassdrive Relay JSON from URL=[' . $this->oCRNRSTN_USR->get_resource('BASSDRIVE_RELAY_STATE').'] ERROR on '. __METHOD__ .' from ' . $_SERVER['SERVER_NAME'].' (' . $_SERVER['SERVER_ADDR'].'). Where err=' . $this->oRELAY_MANAGER->return_relay_ojson_err());

        } catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function populate_jony5_lifestyle_images_table(){

        try {

            $oCRNRSTN_MySQLi = $this->oCRNRSTN_USR->return_crnrstn_mysqli();
            $mysqli = $oCRNRSTN_MySQLi->return_conn_object();

            //common/imgs/lifestyle_banner/desktop/20190722_154057_HDRa.jpg
            $dir_path = 'common/imgs/lifestyle_banner/desktop/';
            $tmp_IMAGE_count = 0;
            $tmp_sql_batch_size = 30;
            
            $tmp_dir = $this->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT').$this->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT_DIR').'/' . $dir_path;
            $image_filename_array = scandir($tmp_dir, 1);

            $tmp = array_pop($image_filename_array);
            $tmp = array_pop($image_filename_array);

            $tmp_IMAGE_count = count($image_filename_array);
            $tmp_clean_image_array = array();

            foreach($image_filename_array as $index => $filename){

                $tmp_pos_jpg = strpos($image_filename_array[$index], '.jpg');

                if($tmp_pos_jpg !== false){

                    $tmp_clean_image_array[] = $filename;

                }

            }

            $tmp_query='SELECT 
                    `crnrstn_jony5_lifestyle_images`.`IMAGE_FILENAME_DESKTOP`
                FROM `crnrstn_jony5_lifestyle_images`;';
            $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!!jesus_is_my_dear_lord!', 'IMAGE_IS_UNIQUE_CHECK', __LINE__, __METHOD__);
            $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

            //
            // PROCESS ALL QUERY TO CONNECTION(S)
            $this->oCRNRSTN_USR->process_query();

            //IMAGE_IS_UNIQUE_CHECK
            $tmp_IMAGE_IS_UNIQUE_CHECK_count = $this->oCRNRSTN_USR->return_record_count('IMAGE_IS_UNIQUE_CHECK');

            $tmp_flag_ARRAY = array();
            for($ii = 0; $ii < $tmp_IMAGE_IS_UNIQUE_CHECK_count; $ii++){

                $tmp_flag_ARRAY[$this->oCRNRSTN_USR->return_database_value('IMAGE_IS_UNIQUE_CHECK', 'IMAGE_FILENAME_DESKTOP', $ii)] = 1;

            }

            $tmp_query_cnt = 0;
            $tmp_query = '';
            foreach ($tmp_clean_image_array as $index => $filename){

                $tmp_file_path = $tmp_dir.$tmp_clean_image_array[$index];

                $tmp_str_ARRAY = explode('.', $tmp_clean_image_array[$index]);
                $tmp_node_cnt = count($tmp_str_ARRAY);  //2

                $tmp_ext_len = strlen($tmp_str_ARRAY[$tmp_node_cnt-1]);
                $tmp_ext_len = $tmp_ext_len * -1;
                $tmp_file_extenstion = substr($tmp_clean_image_array[$index], $tmp_ext_len);

                //return '$tmp_str_ARRAY='.print_r($tmp_str_ARRAY, true).' $tmp_node_cnt=' . $tmp_node_cnt.' $tmp_ext_len=' . $tmp_ext_len.' $tmp_file_extenstion=' . $tmp_file_extenstion;
                $tmp_IMAGE_count = count($tmp_clean_image_array);
                $tmp_IMAGE_ID = $this->oCRNRSTN_USR->generate_new_key(100);
                $tmp_FILESIZE_BYTES = filesize($tmp_file_path);
                $tmp_FILESIZE = $this->oCRNRSTN_USR->format_bytes($tmp_FILESIZE_BYTES, 4);
                $tmp_FILE_MD5 = md5_file($tmp_file_path);
                $tmp_FILE_SHA1 = sha1_file($tmp_file_path);

                //return 'filename=[' . $tmp_clean_image_array[$index] . '] $tmp_FILESIZE=[' . $tmp_FILESIZE . '/' . $tmp_FILESIZE_BYTES . '] $tmp_FILE_MD5=[' . $tmp_FILE_MD5 . '] $tmp_FILE_SHA1=[' . $tmp_FILE_SHA1 . ']';

                if(!isset($tmp_flag_ARRAY[$tmp_clean_image_array[$index]])){

                    $tmp_flag_ARRAY[$tmp_clean_image_array[$index]] = 1;
                    $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();
                    $tmp_query = 'INSERT INTO `crnrstn_jony5_lifestyle_images`
                    (`IMAGE_ID`,
                    `IMAGE_FILENAME_DESKTOP`,
                    `IMAGE_FILENAME_TABLET`,
                    `IMAGE_FILENAME_MOBILE`,
                    `IMAGE_FILESIZE_DESKTOP`,
                    `IMAGE_FILESIZE_FORMAT`,
                    `FILE_EXTENSION`,
                    `IMAGE_MD5_DESKTOP`,
                    `IMAGE_SHA1_DESKTOP`,
                    `DATEMODIFIED`)
                    VALUES
                    ("' . $tmp_IMAGE_ID . '",
                    "' . $tmp_clean_image_array[$index] . '",
                    "' . $tmp_clean_image_array[$index] . '",
                    "' . $tmp_clean_image_array[$index] . '",
                    ' . $tmp_FILESIZE_BYTES . ',
                    "bytes",
                    "' . $tmp_file_extenstion . '",
                    UNHEX("' . $mysqli->real_escape_string($tmp_FILE_MD5) . '"),
					UNHEX("' . $mysqli->real_escape_string($tmp_FILE_SHA1) . '"),
                    "' . $ts . '");';

                    $tmp_query_cnt++;
                    $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                    $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                    //
                    // PROCESS ALL QUERY TO CONNECTION(S)
                    $this->oCRNRSTN_USR->process_query();

                }

                if($tmp_query_cnt > $tmp_sql_batch_size){

                    //
                    // PROCESS ALL QUERY TO CONNECTION(S)
                    $this->oCRNRSTN_USR->process_query();

                    if($tmp_query_cnt == 1){

                        return '<div style="padding:20px; color:#6c645c; line-height: 25px; font-size: 16px; font-family: Arial, Helvetica, sans-serif;">' . __METHOD__ . '<br>All done on ' . $tmp_query_cnt . ' image! [lnum '. __LINE__ .'] [rtime ' . $this->oCRNRSTN_USR->wall_time() . ']</div>';

                    }else{

                        if($tmp_query_cnt == 311) {

                            return '<div style="padding:20px; color:#6c645c; line-height: 25px; font-size: 16px; font-family: Arial, Helvetica, sans-serif;">' . __METHOD__ . '<br>All done on <a href="https://www.youtube.com/watch?v=KWo-02Hsab4" target="_blank">' . $tmp_query_cnt . '</a> images! [lnum '. __LINE__ .'] [rtime ' . $this->oCRNRSTN_USR->wall_time() . ']</div>';

                        }else{

                            return '<div style="padding:20px; color:#6c645c; line-height: 25px; font-size: 16px; font-family: Arial, Helvetica, sans-serif;">' . __METHOD__ . '<br>All done on ' . $tmp_query_cnt . ' images! [lnum '. __LINE__ .'] [rtime ' . $this->oCRNRSTN_USR->wall_time() . ']</div>';

                        }

                    }

                }


            }

            //
            // PROCESS ALL QUERY TO CONNECTION(S)
            $this->oCRNRSTN_USR->process_query();

            return '<div style="padding:20px; color:#6c645c; line-height: 25px; font-size: 16px; font-family: Arial, Helvetica, sans-serif;">' . __METHOD__ . '<br>All done on ' . $tmp_query_cnt . ' images! [lnum '. __LINE__ .'] [rtime ' . $this->oCRNRSTN_USR->wall_time() . ']</div>';

        } catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function populate_meta_lookup_foreign_key_LOCALE(){

        try {

            $tmp_LOCALE_DATA_count = 0;

            $oCRNRSTN_MySQLi = $this->oCRNRSTN_USR->return_crnrstn_mysqli();
            $mysqli = $oCRNRSTN_MySQLi->return_conn_object();

            $tmp_query = 'SELECT `crnrstn_stream_relay_meta_lookup`.`META_LOOKUP_ID`,
                `crnrstn_stream_relay_meta_lookup`.`STREAM_KEY`,
                `crnrstn_stream_relay_meta_lookup`.`RELAY_REPORTING_SHARD_ID`,
                `crnrstn_stream_relay_meta_lookup`.`LOCALE_ID`,
                `crnrstn_stream_relay_meta_lookup`.`SOCIAL_ID`,
                `crnrstn_stream_relay_meta_lookup`.`ABOUT_ID`,
                `crnrstn_stream_relay_meta_lookup`.`COLORS_ID`,
                `crnrstn_stream_relay_meta_lookup`.`STREAM_COLORS_KEY`
            FROM `crnrstn_stream_relay_meta_lookup` 
            WHERE `crnrstn_stream_relay_meta_lookup`.`ISACTIVE` = 1 ORDER BY `crnrstn_stream_relay_meta_lookup`.`DATEMODIFIED` ASC LIMIT 7;';

            $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_MAINT', '!jesus_is_my_dear_lord!', 'META_LOOKUP_DATA', __LINE__, __METHOD__);
            $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

            //
            // PROCESS ALL QUERY TO CONNECTION(S)
            $this->oCRNRSTN_USR->process_query();

            $tmp_META_LOOKUP_DATA_count = $this->oCRNRSTN_USR->return_record_count('META_LOOKUP_DATA');

            for($i = 0; $i < $tmp_META_LOOKUP_DATA_count; $i++) {

                $tmp_META_LOOKUP_ID = trim($this->oCRNRSTN_USR->return_database_value('META_LOOKUP_DATA', 'META_LOOKUP_ID', $i));
                $tmp_STREAM_KEY = trim($this->oCRNRSTN_USR->return_database_value('META_LOOKUP_DATA', 'STREAM_KEY', $i));

                $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();

                $tmp_query = 'SELECT `crnrstn_stream_relay_locale`.`LOCALE_ID`
                FROM `crnrstn_stream_relay_locale`
                WHERE `crnrstn_stream_relay_locale`.`STREAM_KEY_ID` = "' . $tmp_STREAM_KEY . '"
                AND `crnrstn_stream_relay_locale`.`STREAM_KEY_ID_CRC32` = ' . $this->oCRNRSTN_USR->crcINT($tmp_STREAM_KEY) . ' LIMIT 1;
                ';

                $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_MAINT', '!!jesus_is_my_dear_lord!', 'LOCALE_ID_FK_' . $i, __LINE__, __METHOD__);
                $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                //
                // PROCESS ALL QUERY TO CONNECTION(S)
                $this->oCRNRSTN_USR->process_query();

                $tmp_LOCALE_ID_FK_count = $this->oCRNRSTN_USR->return_record_count('LOCALE_ID_FK_' . $i);

                if($tmp_LOCALE_ID_FK_count > 0){

                    $tmp_LOCALE_ID = trim($this->oCRNRSTN_USR->return_database_value('LOCALE_ID_FK_' . $i, 'LOCALE_ID'));
                    $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();

                    $tmp_query = 'UPDATE `crnrstn_stream_relay_meta_lookup`
                    SET
                    `ISACTIVE` = 5,
                    `LOCALE_ID` = "' . $tmp_LOCALE_ID . '",
                    `DATEMODIFIED` = "' . $ts . '"
                    WHERE `META_LOOKUP_ID` = "' . $tmp_META_LOOKUP_ID . '"
                    AND `STREAM_KEY` = "' . $tmp_STREAM_KEY . '"
                    AND `STREAM_KEY_CRC32` = "' . $this->oCRNRSTN_USR->crcINT($tmp_STREAM_KEY) . '" 
                    AND `ISACTIVE` = 1 LIMIT 1;
                    ';

                    $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_MAINT', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                    $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                    //
                    // PROCESS ALL QUERY TO CONNECTION(S)
                    $this->oCRNRSTN_USR->process_query();

                    $tmp_LOCALE_DATA_count++;

                }

            }

            return '<div style="padding:20px; color:#6c645c; line-height: 25px; font-size: 16px; font-family: Arial, Helvetica, sans-serif;">' . __METHOD__ . '<br>All done on ' . $tmp_LOCALE_DATA_count . ' records! [lnum '. __LINE__ .'] [rtime ' . $this->oCRNRSTN_USR->wall_time() . ']</div>';

        } catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function populate_meta_lookup_foreign_key_SOCIAL(){

        try {

            $tmp_SOCIAL_DATA_count = 0;

            $oCRNRSTN_MySQLi = $this->oCRNRSTN_USR->return_crnrstn_mysqli();
            $mysqli = $oCRNRSTN_MySQLi->return_conn_object();

            $tmp_query = 'SELECT `crnrstn_stream_relay_meta_lookup`.`META_LOOKUP_ID`,
                `crnrstn_stream_relay_meta_lookup`.`STREAM_KEY`,
                `crnrstn_stream_relay_meta_lookup`.`RELAY_REPORTING_SHARD_ID`,
                `crnrstn_stream_relay_meta_lookup`.`LOCALE_ID`,
                `crnrstn_stream_relay_meta_lookup`.`SOCIAL_ID`,
                `crnrstn_stream_relay_meta_lookup`.`ABOUT_ID`,
                `crnrstn_stream_relay_meta_lookup`.`COLORS_ID`,
                `crnrstn_stream_relay_meta_lookup`.`STREAM_COLORS_KEY`
            FROM `crnrstn_stream_relay_meta_lookup` 
            WHERE `crnrstn_stream_relay_meta_lookup`.`ISACTIVE` = 1 ORDER BY `crnrstn_stream_relay_meta_lookup`.`SOCIAL_ID` ASC LIMIT 157;';

            $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_MAINT', '!jesus_is_my_dear_lord!', 'META_LOOKUP_DATA', __LINE__, __METHOD__);
            $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

            //
            // PROCESS ALL QUERY TO CONNECTION(S)
            $this->oCRNRSTN_USR->process_query();

            $tmp_META_LOOKUP_DATA_count = $this->oCRNRSTN_USR->return_record_count('META_LOOKUP_DATA');

            for($i = 0; $i < $tmp_META_LOOKUP_DATA_count; $i++) {

                $tmp_META_LOOKUP_ID = trim($this->oCRNRSTN_USR->return_database_value('META_LOOKUP_DATA', 'META_LOOKUP_ID', $i));
                $tmp_STREAM_KEY = trim($this->oCRNRSTN_USR->return_database_value('META_LOOKUP_DATA', 'STREAM_KEY', $i));

                $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();

                $tmp_query = 'SELECT `crnrstn_stream_relay_social`.`SOCIAL_ID`
                FROM `crnrstn_stream_relay_social`
                WHERE `crnrstn_stream_relay_social`.`STREAM_KEY` = "' . $tmp_STREAM_KEY . '"
                AND `crnrstn_stream_relay_social`.`STREAM_KEY_CRC32` = ' . $this->oCRNRSTN_USR->crcINT($tmp_STREAM_KEY) . ' 
                AND `crnrstn_stream_relay_social`.`ISACTIVE` = 1 LIMIT 1;
                ';

                $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_MAINT', '!!jesus_is_my_dear_lord!', 'SOCIAL_ID_FK_' . $i, __LINE__, __METHOD__);
                $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                //
                // PROCESS ALL QUERY TO CONNECTION(S)
                $this->oCRNRSTN_USR->process_query();

                $tmp_SOCIAL_ID_FK_count = $this->oCRNRSTN_USR->return_record_count('SOCIAL_ID_FK_' . $i);

                if($tmp_SOCIAL_ID_FK_count > 0){

                    $tmp_SOCIAL_ID = trim($this->oCRNRSTN_USR->return_database_value('SOCIAL_ID_FK_' . $i, 'SOCIAL_ID'));
                    $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();

                    $tmp_query = 'UPDATE `crnrstn_stream_relay_meta_lookup`
                    SET
                    `ISACTIVE` = 5,
                    `SOCIAL_ID` = "' . $tmp_SOCIAL_ID . '",
                    `DATEMODIFIED` = "' . $ts . '"
                    WHERE `META_LOOKUP_ID` = "' . $tmp_META_LOOKUP_ID . '"
                    AND `STREAM_KEY` = "' . $tmp_STREAM_KEY . '"
                    AND `STREAM_KEY_CRC32` = "' . $this->oCRNRSTN_USR->crcINT($tmp_STREAM_KEY) . '" 
                    AND `ISACTIVE` = 1 LIMIT 1;
                    ';

                    $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_MAINT', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                    $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                    //
                    // PROCESS ALL QUERY TO CONNECTION(S)
                    $this->oCRNRSTN_USR->process_query();

                    $tmp_SOCIAL_DATA_count++;

                }

            }

            return '<div style="padding:20px; color:#6c645c; line-height: 25px; font-size: 16px; font-family: Arial, Helvetica, sans-serif;">' . __METHOD__ . '<br>All done on ' . $tmp_SOCIAL_DATA_count . ' records! [lnum '. __LINE__ .'] [rtime ' . $this->oCRNRSTN_USR->wall_time() . ']</div>';

        } catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function populate_meta_lookup_foreign_key_COLORS(){

        try {

            $tmp_SOCIAL_DATA_count = 0;

            $oCRNRSTN_MySQLi = $this->oCRNRSTN_USR->return_crnrstn_mysqli();
            $mysqli = $oCRNRSTN_MySQLi->return_conn_object();

            $tmp_query = 'SELECT `crnrstn_stream_relay_meta_lookup`.`META_LOOKUP_ID`,
                `crnrstn_stream_relay_meta_lookup`.`STREAM_KEY`,
                `crnrstn_stream_relay_meta_lookup`.`RELAY_REPORTING_SHARD_ID`,
                `crnrstn_stream_relay_meta_lookup`.`LOCALE_ID`,
                `crnrstn_stream_relay_meta_lookup`.`SOCIAL_ID`,
                `crnrstn_stream_relay_meta_lookup`.`ABOUT_ID`,
                `crnrstn_stream_relay_meta_lookup`.`COLORS_ID`,
                `crnrstn_stream_relay_meta_lookup`.`STREAM_COLORS_KEY`
            FROM `crnrstn_stream_relay_meta_lookup` 
            WHERE `crnrstn_stream_relay_meta_lookup`.`ISACTIVE` = 1 ORDER BY `crnrstn_stream_relay_meta_lookup`.`SOCIAL_ID` DESC LIMIT 5;';

            $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_MAINT', '!jesus_is_my_dear_lord!', 'META_LOOKUP_DATA', __LINE__, __METHOD__);
            $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

            //
            // PROCESS ALL QUERY TO CONNECTION(S)
            $this->oCRNRSTN_USR->process_query();

            $tmp_META_LOOKUP_DATA_count = $this->oCRNRSTN_USR->return_record_count('META_LOOKUP_DATA');

            for($i = 0; $i < $tmp_META_LOOKUP_DATA_count; $i++) {

                $tmp_META_LOOKUP_ID = trim($this->oCRNRSTN_USR->return_database_value('META_LOOKUP_DATA', 'META_LOOKUP_ID', $i));
                $tmp_STREAM_KEY = trim($this->oCRNRSTN_USR->return_database_value('META_LOOKUP_DATA', 'STREAM_KEY', $i));
                $tmp_STREAM_COLORS_KEY = trim($this->oCRNRSTN_USR->return_database_value('META_LOOKUP_DATA', 'STREAM_COLORS_KEY', $i));

                $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();

                $tmp_query = 'SELECT `crnrstn_stream_relay_colors`.`COLORS_ID`
                FROM `crnrstn_stream_relay_colors`
                WHERE `crnrstn_stream_relay_colors`.`STREAM_COLORS_KEY` = "' . $tmp_STREAM_COLORS_KEY . '"
                AND `crnrstn_stream_relay_colors`.`STREAM_COLORS_KEY_CRC32` = ' . $this->oCRNRSTN_USR->crcINT($tmp_STREAM_COLORS_KEY) . ' 
                AND `crnrstn_stream_relay_colors`.`ISACTIVE` = 1 LIMIT 1;
                ';

                $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_MAINT', '!!jesus_is_my_dear_lord!', 'COLORS_ID_FK_' . $i, __LINE__, __METHOD__);
                $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                //
                // PROCESS ALL QUERY TO CONNECTION(S)
                $this->oCRNRSTN_USR->process_query();

                $tmp_COLORS_ID_FK_count = $this->oCRNRSTN_USR->return_record_count('COLORS_ID_FK_' . $i);

                if($tmp_COLORS_ID_FK_count > 0){

                    $tmp_COLORS_ID = trim($this->oCRNRSTN_USR->return_database_value('COLORS_ID_FK_' . $i, 'COLORS_ID'));
                    $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();

                    $tmp_query = 'UPDATE `crnrstn_stream_relay_meta_lookup`
                    SET
                    `ISACTIVE` = 5,
                    `COLORS_ID` = "' . $tmp_COLORS_ID . '",
                    `DATEMODIFIED` = "' . $ts . '"
                    WHERE `META_LOOKUP_ID` = "' . $tmp_META_LOOKUP_ID . '"
                    AND `STREAM_KEY` = "' . $tmp_STREAM_KEY . '"
                    AND `STREAM_KEY_CRC32` = "' . $this->oCRNRSTN_USR->crcINT($tmp_STREAM_KEY) . '" 
                    AND `ISACTIVE` = 1 LIMIT 1;
                    ';

                    $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_MAINT', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                    $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                    //
                    // PROCESS ALL QUERY TO CONNECTION(S)
                    $this->oCRNRSTN_USR->process_query();

                    $tmp_SOCIAL_DATA_count++;

                }

            }

            return '<div style="padding:20px; color:#6c645c; line-height: 25px; font-size: 16px; font-family: Arial, Helvetica, sans-serif;">' . __METHOD__ . '<br>All done on ' . $tmp_SOCIAL_DATA_count . ' records! [lnum '. __LINE__ .'] [rtime ' . $this->oCRNRSTN_USR->wall_time() . ']</div>';

        } catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }





    }


    public function populate_locale_table(){

        try {

            $oCRNRSTN_MySQLi = $this->oCRNRSTN_USR->return_crnrstn_mysqli();
            $mysqli = $oCRNRSTN_MySQLi->return_conn_object();

            $tmp_query = 'SELECT 
            `crnrstn_stream_relay_social_OLD`.`STREAM_KEY`,
            `crnrstn_stream_relay_social_OLD`.`LOCALE_CITY_STATE_PROV_NATION`
            FROM `crnrstn_stream_relay_social_OLD` 
            WHERE `crnrstn_stream_relay_social_OLD`.`LOCALE_CITY_STATE_PROV_NATION` != "";';

            $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_MAINT', '!jesus_is_my_dear_lord!', 'LOCALE_DATA', __LINE__, __METHOD__);
            $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

            //
            // PROCESS ALL QUERY TO CONNECTION(S)
            $this->oCRNRSTN_USR->process_query();

            $tmp_LOCALE_DATA_count = $this->oCRNRSTN_USR->return_record_count('LOCALE_DATA');

            for($i = 0; $i < $tmp_LOCALE_DATA_count; $i++) {

                $tmp_LOCALE_ID = $this->oCRNRSTN_USR->generate_new_key(64);
                $tmp_STREAM_KEY = trim($this->oCRNRSTN_USR->return_database_value('LOCALE_DATA', 'STREAM_KEY', $i));
                $tmp_LOCALE_CITY_STATE_PROV_NATION = trim($this->oCRNRSTN_USR->return_database_value('LOCALE_DATA', 'LOCALE_CITY_STATE_PROV_NATION', $i));

                $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();

                $tmp_query = 'INSERT INTO `crnrstn_stream_relay_locale`
                (`LOCALE_ID`,
                 `LOCALE_ID_CRC32`,
                `STREAM_KEY_ID`,
                `STREAM_KEY_ID_CRC32`,
                `LOCALE_COPY`,
                `DATEMODIFIED`)
                VALUES
                ("' . $tmp_LOCALE_ID . '",
                ' . $this->oCRNRSTN_USR->crcINT($tmp_LOCALE_ID) . ',
                "' . $mysqli->real_escape_string($tmp_STREAM_KEY) . '",
                ' . $this->oCRNRSTN_USR->crcINT($tmp_STREAM_KEY) . ',
                "' . $mysqli->real_escape_string($tmp_LOCALE_CITY_STATE_PROV_NATION) . '",
                "' . $ts . '");';

                $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_MAINT', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

            }

            //
            // PROCESS ALL QUERY TO CONNECTION(S)
            $this->oCRNRSTN_USR->process_query();

            return '<div style="padding:20px; color:#6c645c; line-height: 25px; font-size: 16px; font-family: Arial, Helvetica, sans-serif;">' . __METHOD__ . '<br>All done on ' . $tmp_LOCALE_DATA_count . ' records! [lnum '. __LINE__ .'] [rtime ' . $this->oCRNRSTN_USR->wall_time() . ']</div>';

        } catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function __destruct(){

    }

}