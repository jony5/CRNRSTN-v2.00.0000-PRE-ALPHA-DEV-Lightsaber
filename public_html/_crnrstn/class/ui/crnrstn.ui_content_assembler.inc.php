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
#       Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated
#       documentation files (the "Software"), to deal in the Software without restriction, including without limitation
#       the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software,
#       and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
#
#       The above copyright notice and this permission notice shall be included in all copies or substantial portions
#       of the Software.
#
#		THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED
#       TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
#       THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF
#       CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
#       DEALINGS IN THE SOFTWARE.
#
# # C # R # N # R # S # T # N # : : # # ##
#
#  CLASS :: crnrstn_ui_content_assembler
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  VERSION :: 2.00.0000
#  DATE :: June 10, 2020 @ 2130 hrs
#  DESCRIPTION ::
#
class crnrstn_ui_content_assembler {

	protected $oLogger;
	public $oCRNRSTN;
	private static $oContentGen;

	private static $page_path;

	public function __construct($oCRNRSTN) {

        $this->oCRNRSTN = $oCRNRSTN;

		// 
		// INSTANTIATE LOGGER
		$this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN);

        $tmp_page_path = $_SERVER['SCRIPT_NAME'];
        $tmp_page_path = str_replace("index.php", "", $tmp_page_path);

        //
        // THE CRNRSTN :: CONSTRUCTOR HAS THIS CLASS AS A DEPENDENCY. WE DON'T HAVE
        // CONFIG YET...TO SUPPORT THE NEXT LINE.
        //$tmp_page_path = str_replace($this->oCRNRSTN->crnrstn_http_endpoint(), "", $tmp_page_path);

        self::$page_path = $tmp_page_path;

	}

	public function sauce($resource){

        if(!isset(self::$oContentGen)){

            //
            // INSTANTIATE CONTENT GENERATOR
            self::$oContentGen = new crnrstn_content_generator($this->oCRNRSTN, $this, $resource);

        }

	    //
        // INITIALIZE
        return self::$oContentGen->sauce($resource);

    }

	public function initialize_page_content($module_key_override = NULL){

	    $tmp_override = false;
        if(isset($module_key_override)){

            if(strlen($module_key_override) > 0){

                $tmp_override = true;

            }

        }

        if($tmp_override){

            //
            // DEEP LINK OVERRIDE.
            $tmp_module_page_key = $module_key_override;

        }else{

            //
            // SSDTLA PARAMETER EXTRACTION.
            $tmp_module_page_key = $this->oCRNRSTN->oDATA_TUNNEL_SERVICES_MGR->return_received_data('crnrstn_interact_ui_link_text_click');

        }

        if(!isset(self::$oContentGen)){

            //
            // INSTANTIATE CONTENT GENERATOR
            self::$oContentGen = new crnrstn_content_generator($this->oCRNRSTN, $this, $tmp_module_page_key);

        }

        $this->oCRNRSTN->oCRNRSTN_CS_CONTROLLER->load_page($tmp_module_page_key);

        return self::$oContentGen->return_page_serial();

    }

    public function return_int_const_profile($resource_constant){

        $this->oCRNRSTN->oCRNRSTN_CS_CONTROLLER->return_int_const_profile($resource_constant);

    }

    public function return_page_path(){

	    return self::$page_path;

    }

    public function index_page(){

	    if($this->oCRNRSTN->get_resource('INDEX_PAGE_4SEARCH')){

            $tmp_page_serial = self::$oContentGen->return_page_serial();
            ////$tmp_page_content = self::$oContentGen->return_page_html($tmp_page_serial, 'index');

            //$this->index_page_content();

        }
    }

    private function index_page_content(){

	    //error_log('67 side bitch usr - ' . $page_content);
        $oQueryProfileMgr = new crnrstn_query_profile_manager($this->oCRNRSTN);
        $tmp_page_serial = self::$oContentGen->returnPageSerial();
        $tmp_page_content_ARRAY = $this->return_page_html($tmp_page_serial, 'index');

        $tmp_page_content = $tmp_page_content_ARRAY['page_content'];
        $tmp_search_result_display = $tmp_page_content_ARRAY['page_result_display'];
        //error_log('73 side bitch usr - ' . $tmp_page_content);
        $tmp_chunk_title = $tmp_page_content_ARRAY['page_title'];
        $tmp_page_content_len = strlen($tmp_page_content);

        $ts = $this->oCRNRSTN->return_query_date_time_stamp();

        /*
        search_content
        CONTENT_ID              char(70)
        PAGE_SERIAL             int(11) unsigned
        ISACTIVE                tinyint(1) default 1
        LANGCODE                char(2)
        CONTENT_PATH            varchar(200)
        PAGE_CONTENT_RAW        blob
        CONTENT_LENGTH_RAW      int(11) unsigned
        MODIFIED_BY_IP          varbinary(16)
        CREATED_BY_IP           varbinary(16)
        MODIFIED_BY_USERAGENT   varchar(500)
        CREATED_BY_USERAGENT    varchar(500)
        DATEMODIFIED            datetime
        DATECREATED             timestamp

        search_content_chunked
        CHUNK_ID                char(70)
        CONTENT_ID              FK :: char(70)
        PAGE_SERIAL             FK :: int(11) unsigned
        ISACTIVE                tinyint(1) default 1
        LANGCODE                char(2)
        ...

        INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '")

        */

        $oCRNRSTN_MySQLi = $this->oCRNRSTN->return_crnrstn_mysqli();
        $mysqli = $oCRNRSTN_MySQLi->return_conn_object();

        //
        // CLEAR CHUNKED DATA
        $query = 'DELETE FROM `search_content_chunked`
                    WHERE `search_content_chunked`.`PAGE_SERIAL`="' . $mysqli->real_escape_string($tmp_page_serial).'" 
                    AND `search_content_chunked`.`PAGE_SERIAL_CRC`="' . $this->oCRNRSTN->crcINT($tmp_page_serial).'";';

        $oQueryProfileMgr->loadQueryProfile($oCRNRSTN_MySQLi, 'INIT_PAGE_SEARCH', '!jesus_is_my_dear_lord!', 'DELETE_CHUNKED');
        $this->oCRNRSTN->add_database_query($oQueryProfileMgr, 'DELETE_CHUNKED', $query);

        $query_select = 'SELECT `search_content`.`CONTENT_ID`,
                    `search_content`.`PAGE_SERIAL`,
                    `search_content`.`PAGE_SERIAL_CRC`,
                    `search_content`.`ISACTIVE`,
                    `search_content`.`LANGCODE`,
                    `search_content`.`CONTENT_PATH`,
                    `search_content`.`BOOLEAN_TEST`,
                    `search_content`.`PAGE_CONTENT_RAW`,
                    `search_content`.`CONTENT_LENGTH_RAW`,
                    `search_content`.`MODIFIED_BY_IP`,
                    `search_content`.`CREATED_BY_IP`,
                    `search_content`.`MODIFIED_BY_USERAGENT`,
                    `search_content`.`CREATED_BY_USERAGENT`,
                    `search_content`.`DATEMODIFIED`,
                    `search_content`.`DATECREATED`
                FROM `search_content`
                WHERE `search_content`.`PAGE_SERIAL`="' . $mysqli->real_escape_string($tmp_page_serial).'" 
                AND `search_content`.`PAGE_SERIAL_CRC`="' . $this->oCRNRSTN->crcINT($tmp_page_serial).'" LIMIT 1;
                ';

        $oQueryProfileMgr->loadQueryProfile($oCRNRSTN_MySQLi, 'INIT_PAGE_SEARCH', '!jesus_is_my_dear_lord!', 'CHECK_PAGE_INDEX_EXISTS');
        $this->oCRNRSTN->add_database_query($oQueryProfileMgr, 'CHECK_PAGE_INDEX_EXISTS', $query_select);

        //
        // PROCESS ALL QUERY TO CONNECTION(S)
        $this->oCRNRSTN->process_query(true);

        $tmp_record_cnt = $this->oCRNRSTN->return_record_count($oQueryProfileMgr, 'CHECK_PAGE_INDEX_EXISTS');

        //$this->oCRNRSTN->closeConnection_MySQLi($mysqli);

        if($tmp_record_cnt > 0){

            $oCRNRSTN_MySQLi = $this->oCRNRSTN->return_crnrstn_mysqli();
            $mysqli = $oCRNRSTN_MySQLi->return_conn_object();

            $tmp_content_id = $this->oCRNRSTN->return_db_value($oQueryProfileMgr, 'CHECK_PAGE_INDEX_EXISTS', 'CONTENT_ID');

            $oQueryProfileMgr->loadQueryProfile($oCRNRSTN_MySQLi, 'UPDATE_SEARCH', '!jesus_is_my_dear_lord!!', 'SEARCH_CONTENT');

            //
            // UPDATE
            $query = 'UPDATE `search_content`
            SET
            `PAGE_CONTENT_RAW` = "' . $mysqli->real_escape_string($tmp_page_content).'",
            `BOOLEAN_TEST` = true,
            `CONTENT_LENGTH_RAW` = "' . $tmp_page_content_len.'",
            `MODIFIED_BY_IP` = "' . $this->oCRNRSTN->return_client_ip().'",
            `MODIFIED_BY_USERAGENT` = "' . $_SERVER['HTTP_USER_AGENT'].'",
            `DATEMODIFIED` = "' . $ts.'"
            WHERE `CONTENT_ID`= "' . $tmp_content_id . '"
            AND `CONTENT_ID_CRC`= "' . $this->oCRNRSTN->crcINT($tmp_content_id).'"
            AND `PAGE_SERIAL` = "' . $tmp_page_serial . '" AND `PAGE_SERIAL_CRC` = "' . $this->oCRNRSTN->crcINT($tmp_page_serial).'";';

            $this->oCRNRSTN->add_database_query($oQueryProfileMgr, 'SEARCH_CONTENT', $query);

            //
            // REMOVE LINKS...ETC...
            $tmp_page_content = strip_tags($tmp_page_content);
            $tmp_search_result_display = strip_tags($tmp_search_result_display);

            //
            // BREAK CONTENT INTO CHUNKS
            $tmp_page_content = $this->str_sanitize($tmp_page_content,'index');
            $tmp_search_result_display = $this->str_sanitize($tmp_search_result_display,'index');

            $oChunkRestrictData = $this->oCRNRSTN->chunkPageData($tmp_search_result_display, 200);
            $tmp_sresult_array['chunked_content'] = $oChunkRestrictData->return_linesArray();
            $tmp_search_result_display = $tmp_sresult_array['chunked_content'][0];

            //error_log('186 side bitch usr - content=>' . $tmp_page_content);
            $oChunkRestrictData = $this->oCRNRSTN->chunkPageData($tmp_page_content, 1000);
            $tmp_chunked_array['chunked_content'] = $oChunkRestrictData->return_linesArray();

            $chunk_cnt = sizeof($tmp_chunked_array['chunked_content']);

            for($i=0;$i<$chunk_cnt;$i++){
                $tmp_chunk_id = $this->oCRNRSTN->generate_new_key(70);
                $tmp_chunk_search = strtolower($this->str_sanitize($tmp_chunked_array['chunked_content'][$i],'search'));

                $tmp_chunk_len_search = strlen($tmp_chunk_search);
                $tmp_chunk_len_raw = strlen($tmp_chunked_array['chunked_content'][$i]);
                //error_log('203 side bitch usr - chunk=' . $tmp_chunked_array[$i]);

                $query_chunked = 'INSERT INTO `search_content_chunked`
                                    (`CHUNK_ID`,
                                    `CONTENT_ID`,
                                    `PAGE_SERIAL`,
                                    `PAGE_SERIAL_CRC`,
                                    `SEARCH_RESULT_DISPLAY`,
                                    `PAGE_CONTENT_SEARCH`,
                                    `PAGE_CONTENT_RAW`,
                                    `PAGE_CONTENT_TITLE`,
                                    `CONTENT_LENGTH_SEARCH`,
                                    `CONTENT_LENGTH_RAW`,
                                    `MODIFIED_BY_IP`,
                                    `CREATED_BY_IP`,
                                    `MODIFIED_BY_USERAGENT`,
                                    `CREATED_BY_USERAGENT`,
                                    `DATEMODIFIED`)
                                    VALUES
                                    ("' . $tmp_chunk_id . '",
                                    "' . $tmp_content_id . '",
                                    "' . $mysqli->real_escape_string($tmp_page_serial).'",
                                    "' . $this->oCRNRSTN->crcINT($tmp_page_serial).'",
                                    "' . $mysqli->real_escape_string($tmp_search_result_display).'",
                                    "' . $mysqli->real_escape_string($tmp_chunk_search).'",
                                    "' . $mysqli->real_escape_string($tmp_chunked_array['chunked_content'][$i]).'",
                                    "' . $mysqli->real_escape_string($tmp_chunk_title).'",
                                    "' . $tmp_chunk_len_search.'",
                                    "' . $tmp_chunk_len_raw.'",
                                    "' . $this->oCRNRSTN->return_client_ip().'",
                                    "' . $this->oCRNRSTN->return_client_ip().'",
                                    "' . $_SERVER['HTTP_USER_AGENT'].'",
                                    "' . $_SERVER['HTTP_USER_AGENT'].'",
                                    "' . $ts.'");
                                    ';

                $oQueryProfileMgr->loadQueryProfile($oCRNRSTN_MySQLi, 'UPDATE_SEARCH', '!jesus_is_my_dear_lord!!', 'NEW_SEARCH_CHUNK_PUSH_' . $i);
                $this->oCRNRSTN->add_database_query($oQueryProfileMgr, 'NEW_SEARCH_CHUNK_PUSH_' . $i, $query_chunked);

            }

        }else{

            //$oCRNRSTN_MySQLi = $this->oCRNRSTN->return_crnrstn_mysqli();
            //$mysqli = $oCRNRSTN_MySQLi->return_conn_object();

            //
            // INSERT
            $tmp_content_id = $this->oCRNRSTN->generate_new_key(70);

            $query = 'INSERT INTO `search_content`
                        (`CONTENT_ID`,
                        `CONTENT_ID_CRC`,
                        `PAGE_SERIAL`,
                        `PAGE_SERIAL_CRC`,
                        `BOOLEAN_TEST`,
                        `CONTENT_PATH`,
                        `PAGE_CONTENT_RAW`,
                        `CONTENT_LENGTH_RAW`,
                        `MODIFIED_BY_IP`,
                        `CREATED_BY_IP`,
                        `MODIFIED_BY_USERAGENT`,
                        `CREATED_BY_USERAGENT`,
                        `DATEMODIFIED`)
                        VALUES
                        ("' . $tmp_content_id . '",
                        "' . $this->oCRNRSTN->crcINT($tmp_content_id).'",
                        "' . $mysqli->real_escape_string($tmp_page_serial).'",
                        "' . $this->oCRNRSTN->crcINT($tmp_page_serial).'",
                        true,
                        "' . $mysqli->real_escape_string(self::$page_path).'",
                        "' . $mysqli->real_escape_string($tmp_page_content).'",
                        "' . $tmp_page_content_len.'",
                        "' . $this->oCRNRSTN->return_client_ip().'",
                        "' . $this->oCRNRSTN->return_client_ip().'",
                        "' . $_SERVER['HTTP_USER_AGENT'].'",
                        "' . $_SERVER['HTTP_USER_AGENT'].'",
                        "' . $ts.'");
                        ';

            $oQueryProfileMgr->loadQueryProfile($oCRNRSTN_MySQLi, 'NEW_SEARCH', '!jesus_is_my_dear_lord!!', 'NEW_SEARCH_PUSH');
            $this->oCRNRSTN->add_database_query($oQueryProfileMgr, 'NEW_SEARCH_PUSH', $query);

            //
            // REMOVE LINKS...ETC...
            $tmp_page_content = strip_tags($tmp_page_content);
            $tmp_search_result_display = strip_tags($tmp_search_result_display);

            //
            // BREAK CONTENT INTO CHUNKS
            $tmp_page_content = $this->str_sanitize($tmp_page_content,'index');
            $tmp_search_result_display = $this->str_sanitize($tmp_search_result_display,'index');

            $oChunkRestrictData = $this->oCRNRSTN->chunkPageData($tmp_search_result_display, 200);
            $tmp_sresult_array['chunked_content'] = $oChunkRestrictData->return_linesArray();
            $tmp_search_result_display = $tmp_sresult_array['chunked_content'][0];

            //
            // BREAK CONTENT INTO CHUNKS
            //error_log('252 side bitch usr - content=' . $tmp_page_content);
            $oChunkRestrictData = $this->oCRNRSTN->chunkPageData($tmp_page_content, 1000);
            $tmp_chunked_array['chunked_content'] = $oChunkRestrictData->return_linesArray();
            $chunk_cnt = sizeof($tmp_chunked_array['chunked_content']);

            for($i=0;$i<$chunk_cnt;$i++){
                $tmp_chunk_id = $this->oCRNRSTN->generate_new_key(70);
                $tmp_chunk_search = strtolower($this->str_sanitize($tmp_chunked_array['chunked_content'][$i],'search'));

                $tmp_chunk_len_search = strlen($tmp_chunk_search);
                $tmp_chunk_len_raw = strlen($tmp_chunked_array['chunked_content'][$i]);

                $query_chunked = 'INSERT INTO `search_content_chunked`
                                    (`CHUNK_ID`,
                                    `CONTENT_ID`,
                                    `PAGE_SERIAL`,
                                    `PAGE_SERIAL_CRC`,
                                    `SEARCH_RESULT_DISPLAY`,
                                    `PAGE_CONTENT_SEARCH`,
                                    `PAGE_CONTENT_RAW`,
                                    `PAGE_CONTENT_TITLE`,
                                    `CONTENT_LENGTH_SEARCH`,
                                    `CONTENT_LENGTH_RAW`,
                                    `MODIFIED_BY_IP`,
                                    `CREATED_BY_IP`,
                                    `MODIFIED_BY_USERAGENT`,
                                    `CREATED_BY_USERAGENT`,
                                    `DATEMODIFIED`)
                                    VALUES
                                    ("' . $tmp_chunk_id . '",
                                    "' . $tmp_content_id . '",
                                    "' . $mysqli->real_escape_string($tmp_page_serial).'",
                                    "' . $this->oCRNRSTN->crcINT($tmp_page_serial).'",
                                    "' . $mysqli->real_escape_string($tmp_search_result_display).'",
                                    "' . $mysqli->real_escape_string($tmp_chunk_search).'",
                                    "' . $mysqli->real_escape_string($tmp_chunked_array['chunked_content'][$i]).'",
                                    "' . $mysqli->real_escape_string($tmp_chunk_title).'",
                                    "' . $tmp_chunk_len_search.'",
                                    "' . $tmp_chunk_len_raw.'",
                                    "' . $this->oCRNRSTN->return_client_ip().'",
                                    "' . $this->oCRNRSTN->return_client_ip().'",
                                    "' . $_SERVER['HTTP_USER_AGENT'].'",
                                    "' . $_SERVER['HTTP_USER_AGENT'].'",
                                    "' . $ts.'");
                                    ';

                $oQueryProfileMgr->loadQueryProfile($oCRNRSTN_MySQLi, 'NEW_SEARCH', '!jesus_is_my_dear_lord!!', 'NEW_SEARCH_CHUNK_PUSH_' . $i);
                $this->oCRNRSTN->add_database_query($oQueryProfileMgr, 'NEW_SEARCH_CHUNK_PUSH_' . $i, $query_chunked);

            }

        }

        //
        // PROCESS ALL QUERY TO CONNECTION(S)
        $this->oCRNRSTN->process_query(true);

    }

    public function return_page_search_results_html($serial, $channel='desktop'){

        return self::$oContentGen->return_page_search_results_html($this, $serial, $channel);

    }

    public function return_search_result_html($page_path, $return_content, $content_title, $ugc_search_str){

        $tmp_result_id = $this->oCRNRSTN->generate_new_key(10);
        $page_path = ltrim($page_path, "/");
        $tmp_page_uri = $this->oCRNRSTN->crnrstn_http_endpoint() . $page_path;

        if($content_title!=''){
            $content_title = '<span class="s_result_title">' . $content_title . ' ::</span> ';

            $result_HTML = '<div id="sresult_' . $tmp_result_id . '" class="s_resultfull_wrapper" onmouseover="ajax_search_result(\'#sresult_' . $tmp_result_id . '\', \'mouseover\'); return false;" onmouseout="ajax_search_result(\'#sresult_' . $tmp_result_id . '\', \'mouseout\'); return false;" onclick="loadPage(\'' . $tmp_page_uri.'\'); return false;">' . $content_title.$return_content.'...</div>';
        }else{

            $result_HTML = '';

        }

        return $result_HTML;
    }

    public function return_search_result_mobile($page_path, $return_content, $content_title, $ugc_search_str){

        $tmp_result_id = $this->oCRNRSTN->generate_new_key(10);
        $page_path = ltrim($page_path, "/");
        $tmp_page_uri = $this->oCRNRSTN->crnrstn_http_endpoint().$page_path;

        if($content_title!=''){
            
            $content_title = '<span class="s_result_title">' . $content_title . ' ::</span> ';

            //$result_HTML = '<div id="sresult_' . $tmp_result_id . '" class="s_resultfull_wrapper" onmouseover="ajax_search_result(\'#sresult_' . $tmp_result_id . '\', \'mouseover\'); return false;" onmouseout="ajax_search_result(\'#sresult_' . $tmp_result_id . '\', \'mouseout\'); return false;" onclick="loadPage(\'' . $tmp_page_uri.'\'); return false;">' . $content_title.$return_content.'...</div>';

            /*
            $result_HTML = '<div class="ui-corner-all custom-corners" onclick="loadPage(\'' . $tmp_page_uri.'\'); return false;">
              <div class="ui-bar ui-bar-a">
                <h3>' . $content_title . '</h3>
              </div>
              <div class="ui-body ui-body-a">
                <p>' . $return_content.'...</p>
              </div>
            </div>';
            */

            $result_HTML = '<div class="ui-body ui-body-a ui-corner-all" style="background-color:#FFF; border-bottom:0;" onclick="loadPage(\'' . $tmp_page_uri.'\'); return false;">
                <h3>' . $content_title . '</h3>
                      <p>' . $return_content.'...</p>
                      <div id="custom-border-radius_' . $tmp_result_id . '" class="ui-shadow-icon">
                            <a href="' . $tmp_page_uri.'" class="ui-btn ui-btn-icon-right ui-icon-carat-r ui-btn-icon-notext ui-shadow-icon" style="float: right;" data-ajax="false">Go</a>
                        </div>
                  </div>';
        }else{

            $result_HTML = '<div class="ui-body ui-body-a ui-corner-all" style="background-color:#FFF; border-bottom:0;" onclick="loadPage(\'' . $tmp_page_uri.'\'); return false;">
                  <p>' . $return_content.'...</p>
                  <div id="custom-border-radius_' . $tmp_result_id . '" class="ui-shadow-icon">
                        <a href="' . $tmp_page_uri.'" class="ui-btn ui-btn-icon-right ui-icon-carat-r ui-btn-icon-notext ui-shadow-icon" style="float: right;" data-ajax="false">Go</a>
                    </div>
              </div>';

        }

        return $result_HTML;
        
    }

    public function return_ajax_search_result_mobile($ugc_search_str, $page_path, $return_content, $content_title){

        //$tmp_result_id = $this->oCRNRSTN->generate_new_key(10);
        $page_path = ltrim($page_path, "/");
        $tmp_page_uri = $this->oCRNRSTN->crnrstn_http_endpoint().$page_path;

        //if($content_title!=''){
        //     $content_title = '<span class="s_result_title">' . $content_title . ' ::</span> ';
        //}

        //$result_HTML = '<li id="sresult_' . $tmp_result_id . '" onmouseover="ajax_search_result(\'#sresult_' . $tmp_result_id . '\', \'mouseover\'); return false;" onmouseout="ajax_search_result(\'#sresult_' . $tmp_result_id . '\', \'mouseout\'); return false;" onclick="loadPage(\'' . $tmp_page_uri.'\'); return false;">' . $content_title.$return_content.'...</li>';

        $result_JSON = '{"kivotosname":"' . $content_title . '","kivotosuri":"' . $tmp_page_uri.'","kivotossearch":"' . $ugc_search_str.'"},';

        return $result_JSON;

    }

    public function return_ajax_search_result_html($page_path, $return_content, $content_title){

	    $tmp_result_id = $this->oCRNRSTN->generate_new_key(10);
        $page_path = ltrim($page_path, "/");
	    $tmp_page_uri = $this->oCRNRSTN->crnrstn_http_endpoint().$page_path;

	    if($content_title!=''){

            $content_title = '<span class="s_result_title">' . $content_title . ' ::</span> ';

	    }

        $result_HTML = '<li id="sresult_' . $tmp_result_id . '" onmouseover="ajax_search_result(\'#sresult_' . $tmp_result_id . '\', \'mouseover\'); return false;" onmouseout="ajax_search_result(\'#sresult_' . $tmp_result_id . '\', \'mouseout\'); return false;" onclick="loadPage(\'' . $tmp_page_uri.'\'); return false;">' . $content_title.$return_content.'...</li>';

	    return $result_HTML;

    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.preg-split.php
    // AUTHOR :: (buzoganylaszlo at yahoo dot com) https://www.php.net/manual/en/function.preg-split.php#92632
    public function process_quoted_search($ugc_str){

        $words = preg_split("/[\s,]*\\\"([^\\\"]+)\\\"[\s,]*|" . "[\s,]*'([^']+)'[\s,]*|" . "[\s,]+/", $ugc_str, 0, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

        //error_log('399 side bitch usr - '.sizeof($words));

        return $words;

        /*
        $search_expression = "apple bear \"Tom Cruise\" or 'Mickey Mouse' another word";

        ?>

        The result will be:
        Array
        (
            [0] => apple
            [1] => bear
            [2] => Tom Cruise
            [3] => or
            [4] => Mickey Mouse
            [5] => another
            [6] => word
        )
	     * */
    }

    public function initialize_page($key){

        try {

            switch($key){
                case 'PAGE':

                    //
                    // AFTER TESTING...MAY NEED TO MAKE MORE ROBUST IF APPENDING $_GET PARAMS TO LINKS
                    $tmp_uri = $_SERVER['SCRIPT_NAME'];
                    $tmp_uri = str_replace('index.php', '', $tmp_uri);

                    self::$oContentGen->page_uri = $tmp_uri;
//                    self::$oContentGen->page_category_name = $category_name;
//                    self::$oContentGen->page_subcategory_name = $subcategory_name;
//                    self::$oContentGen->page_subsubcateg_name = $subsubcat_name;

                    //
                    // GENERATE UNIQUE HANDLE FOR THIS DATA
                    return self::$oContentGen->initialize_page();

//                    self::$oContentGen->page_category_name_ARRAY[self::$oContentGen->page_serial] = $category_name;
//                    self::$oContentGen->page_subcategory_name_ARRAY[self::$oContentGen->page_serial] = $subcategory_name;
//                    self::$oContentGen->page_subsubcateg_name_ARRAY[self::$oContentGen->page_serial] = $subsubcat_name;

                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Error building page from provided key [' . $key . '].');

                break;

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

	public function add_page_element($serial, $key, $data_ARRAY, $output_type = 'SSDTLA'){

	    if($output_type === 'sauce'){

	        return NULL;

        }

	    //error_log(__LINE__ . ' ui cnt mgr $serial[' . $serial . ']. $key[' . $key . '].');
        try {

            if(strlen($key)<1){

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Error adding [' . $key . '] element with data [' . print_r($data_ARRAY, true) . '].');

            }

            switch($key){
                case 'PAGE_TITLE':
                case 'NOTE':
                case 'TECH_SPECS':
                case 'GENERAL_COPY_NAKED':
                case 'GENERAL_COPY_R_STONE':
                case 'METHOD_DEFINITION':
                case 'PARAMETER_DEFINITION':
                case 'RETURN_VALUE':
                case 'RELATED_METHODS':
                case 'PAGE_STATISTICS':
                case 'EXAMPLE_CONTENT':

                    self::$oContentGen->add_page_element($serial, $key, $data_ARRAY);

                break;
                default:

                    //$oSideBitch_Usr->add_page_element($tmp_page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);
                    //self::$oContentGen->add_page_element($serial, $key, $data_ARRAY, $attribute_01, $attribute_02, $attribute_03);

                break;

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function get_category($serial){

	    return self::$oContentGen->page_category_name_ARRAY[$serial];

    }

    public function get_sub_category($serial){

        return self::$oContentGen->page_subcategory_name_ARRAY[$serial];

    }

    public function return_page_html($serial, $channel = 'DESKTOP'){

        return self::$oContentGen->return_page_html($serial, $channel);

    }

    public function return_page_serial(){

        return self::$oContentGen->return_page_serial();

    }

    public function nav_visible_state($nav_copy){

        if(strtolower($nav_copy) == strtolower(self::$oContentGen->page_subcategory_name_ARRAY[self::$oContentGen->page_serial])){

            echo ' style="display: inline;"';

        }else{

            echo '';
            
        }

        return NULL;

    }

    public function nav_active_state($nav_copy){
        //error_log('317 side bitch usr - serial='.self::$oContentGen->page_serial);
	    if(strtolower($nav_copy) == strtolower(self::$oContentGen->page_subcategory_name_ARRAY[self::$oContentGen->page_serial])){

            echo ' subnav_active';

        }else{

	        echo '';
	        
        }

	    return NULL;

    }

    //
    // SOURCE :: https://gist.github.com/breakermind forked from https://gist.github.com/jasny/2000705
    private function linkify($showimg = 1, $value, $protocols = array('http', 'mail', 'https'), array $attributes = array('target' => '_blank')){
        // Link attributes
        $attr = '';
        foreach ($attributes as $key => $val) {
            $attr = ' ' . $key . '="' . htmlentities($val) . '"';
        }

        $links = array();

        // Extract existing links and tags
        $value = preg_replace_callback('~(<a .*?>.*?</a>|<.*?>)~i', function ($match) use (&$links) { return '<' . array_push($links, $match[1]) . '>'; }, $value);

        // Extract text links for each protocol
        foreach ((array)$protocols as $protocol) {
            switch ($protocol) {
                case 'http':
                case 'https':   $value = preg_replace_callback('~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i',
                    function ($match) use ($protocol, &$links, $attr, $showimg) {
                        if ($match[1]){
                            $protocol = $match[1]; $link = $match[2] ?: $match[3];
                            // Youtube
                            if($showimg == 1){
                                if(strpos($link, 'youtube.com')>0 || strpos($link, 'youtu.be')>0){
                                    $link = '<iframe width="100%" height="315" src="https://www.youtube.com/embed/'.end(explode('=', $link)).'?rel=0&showinfo=0&color=orange&iv_load_policy=3" frameborder="0" allowfullscreen></iframe>';
                                    return '<' . array_push($links, $link) . '></a>';
                                }
                                if(strpos($link, '.png')>0 || strpos($link, '.jpg')>0 || strpos($link, '.jpeg')>0 || strpos($link, '.gif')>0 || strpos($link, '.bmp')>0){
                                    return '<' . array_push($links, "<a $attr href=\"$protocol://$link\" class=\"htmllink\"><img src=\"$protocol://$link\" class=\"htmlimg\">") . '></a>';
                                }
                            }

                            //
                            // PROXY CHECK HERE. DO WE HAVE EXTERNAL LINK? IF SO, PROXY IT. self::$transform_output_ARRAY['QUERY'/'STYLED_CONTENT']
                            if(strpos($link, 'evifweb.com')>0){

                                if($this->oCRNRSTN->getSessionParam("DEVICETYPE")=="m"){

                                    return '<' . array_push($links, "<a $attr href=\"$protocol://$link\" class=\"htmllink\" data-ajax=\"false\">$link</a>") . '>';

                                }else {

                                    return '<' . array_push($links, "<a $attr href=\"$protocol://$link\" class=\"htmllink\">$link</a>") . '>';

                                }

                            }else{

                                //
                                // LINK NEEDS TO BE PROXIED
                                # $tmp_output_ARRAY[0]=PROTOCOL $tmp_output_ARRAY[1]=LINK
                                $tmp_output_ARRAY = $this->buildProxy($protocol,$link);


                                if($this->oCRNRSTN->getSessionParam("DEVICETYPE")=="m"){

                                    return '<' . array_push($links, "<a $attr href=\"$tmp_output_ARRAY[0]://$tmp_output_ARRAY[1]\" class=\"htmllink\" data-ajax=\"false\">$link</a>") . '>';

                                }else {

                                    return '<' . array_push($links, "<a $attr href=\"$tmp_output_ARRAY[0]://$tmp_output_ARRAY[1]\" class=\"htmllink\">$link</a>") . '>';

                                }


                            }

                        }
                    }, $value); break;
                case 'mail':    $value = preg_replace_callback('~([^\s<]+?@[^\s<]+?\.[^\s<]+)(?<![\.,:])~', function ($match) use (&$links, $attr) { return '<' . array_push($links, "<a $attr href=\"mailto:{$match[1]}\" class=\"htmllink\">{$match[1]}</a>") . '>'; }, $value); break;
                case 'twitter': $value = preg_replace_callback('~(?<!\w)[@#](\w++)~', function ($match) use (&$links, $attr) { return '<' . array_push($links, "<a $attr href=\"https://twitter.com/" . ($match[0][0] == '@' ? '' : 'search/%23') . $match[1]  . "\" class=\"htmllink\">{$match[0]}</a>") . '>'; }, $value); break;
                default:        $value = preg_replace_callback('~' . preg_quote($protocol, '~') . '://([^\s<]+?)(?<![\.,:])~i', function ($match) use ($protocol, &$links, $attr) { return '<' . array_push($links, "<a $attr href=\"$protocol://{$match[1]}\" class=\"htmllink\">{$match[1]}</a>") . '>'; }, $value); break;
            }
        }

        // Insert all link
        return preg_replace_callback('/<(\d+)>/', function ($match) use (&$links) { return $links[$match[1] - 1]; }, $value);
    }

    public function str_sanitize($str, $type){

        $patterns = array();
        $replacements = array();

        $type = strtolower($type);

        try{

            switch($type){
                case 'index':

                    $patterns[0] = '&nbsp;';
                    $patterns[1] = ')';
                    $replacements[0] = ' ';
                    $replacements[1] = ') ';

                break;
                case 'search':

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
                    //$patterns[17] = '>';

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
                    //$replacements[17] = '';

                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Unable to determine string sanitization algorithm [' . $type . '] for the content[' . $str.'].');

                break;

            }

        } catch( Exception $e ) {

            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        $str = str_replace($patterns, $replacements, $str);

        return $str;

    }

	public function __destruct() {
		
	}

}