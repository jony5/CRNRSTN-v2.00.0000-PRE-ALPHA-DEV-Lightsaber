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
#       THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED
#       TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
#       THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF
#       CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
#       DEALINGS IN THE SOFTWARE.
#
# # C # R # N # R # S # T # N # : : # # ##
#
#  CLASS :: crnrstn_content_generator
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  VERSION :: 1.00.0000
#  DATE :: July 4, 2020 @ 1620hrs
#  DESCRIPTION ::
class crnrstn_content_generator {

    protected $oLogger;
    public $oCRNRSTN;

    public $page_content_ARRAY = array();
    public $page_uri;
    public $page_category_name_ARRAY;
    public $page_subcategory_name_ARRAY;
    public $page_subsubcateg_name_ARRAY;
    public $page_serial;
    public $content_load_sequence_ARRAY = array();
    public $page_subcategory_name;
    public $page_subsubcateg_name;

	public function __construct($oCRNRSTN, $oCRNRSTN_UI_ASSEMBLER, $module_page_key = NULL){

        //
        // INSTANTIATE LOGGER
        $this->oCRNRSTN = $oCRNRSTN;

        $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN);

	}

    public function return_resource_profile($resource_constant){

        return $this->oCRNRSTN->oCRNRSTN_CS_CONTROLLER->return_resource_profile($resource_constant);

    }

	public function initialize_page(){

	    $tmp_serial = $this->oCRNRSTN->hash($this->oCRNRSTN->oCRNRSTN_CS_CONTROLLER->module_key);

	    $this->page_content_ARRAY[] = $tmp_serial;
	    $this->page_serial = $tmp_serial;

	    return $this->page_serial;

    }

    public function return_page_serial(){

	    return $this->oCRNRSTN->oCRNRSTN_CS_CONTROLLER->return_page_serial();
	    
    }

    public function load_page($module_page_key){

        $this->oCRNRSTN->oCRNRSTN_CS_CONTROLLER->load_page($module_page_key);

    }

    public function add_page_element($serial, $key, $attribute_00, $attribute_01 = NULL, $attribute_02 = NULL, $attribute_03 = NULL){

	    try{

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

                    if($attribute_00 == ''){

                        $attribute_00 = ' ';

                    }

                    $tmp_seq_key = $this->oCRNRSTN->generate_new_key(26);
                    $this->content_load_sequence_ARRAY[] = $tmp_seq_key;
                    $this->page_content_ARRAY[$serial][$tmp_seq_key][$key] = $attribute_00;

                break;
                case 'EXAMPLE_CONTENT':

                    $tmp_seq_key = $this->oCRNRSTN->generate_new_key(10);
                    $this->content_load_sequence_ARRAY[] = $tmp_seq_key;

                    if($attribute_00 == ''){

                        $attribute_00 = ' ';

                    }

                    if($attribute_01 == ''){

                        $attribute_01 = NULL;

                    }

                    $this->page_content_ARRAY[$serial][$tmp_seq_key][$key]['title_string'] = $attribute_00;

                    if(isset($attribute_01)){

                        $this->page_content_ARRAY[$serial][$tmp_seq_key][$key]['integrated_title_string'] = $attribute_01;

                    }

                    $this->page_content_ARRAY[$serial][$tmp_seq_key][$key]['pres_file'] = $attribute_02;
                    $this->page_content_ARRAY[$serial][$tmp_seq_key][$key]['exec_file'] = $attribute_03;

                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Unhandled key [' . $key . '].');

                break;

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        return true;

    }

    public function return_page_search_results_html($oSideBitch_Usr, $serial, $channel){

        $oQueryProfileMgr = new crnrstn_query_profile_manager($this->oCRNRSTN);
        $html_out = '';

        $tmp_path_directory = $this->oCRNRSTN->get_resource('crnrstn_path_directory', 0, 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES');
        $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES');

        switch($channel){
            case 'mobile':

                //
                // MOBILE EXPERIENCE
                // PROCESS FOR SEARCH RESULTS
                // ENABLE THIS PAGE TO RECEIVE HTTP POST/GET DATA
                if($this->oCRNRSTN->http_data_services_initialize()) {

                    if($this->oCRNRSTN->isset_crnrstn_services_http() || $this->oCRNRSTN->isset_crnrstn_services_http('GET')) {

                        //
                        // PREPARE RECEIVED INPUT PARAMETERS FOR DATABASE QUERY
                        $tmp_ugc_search_str = $this->oCRNRSTN->get_http_resource('q');

                        if($this->oCRNRSTN->isset_http_superglobal('GET')){

                            $tmp_encrypt = $this->oCRNRSTN->extract_data_HTTP('crnrstn_pssdtl_packet_ENCRYPTED', 'POST');
                            $tmp_ipacket = urlencode($this->oCRNRSTN->extract_data_HTTP('crnrstn_pssdtl_packet', 'POST'));
                            //error_log('154 gen - encode=>packet=' . $tmp_ipacket);

                        }else{

                            $tmp_encrypt = $this->oCRNRSTN->extract_data_HTTP('crnrstn_pssdtl_packet_ENCRYPTED');
                            $tmp_ipacket = urlencode($this->oCRNRSTN->extract_data_HTTP('crnrstn_pssdtl_packet'));
                            //error_log('160 gen - packet=' . $tmp_ipacket);
                        }

                        $html_out .= '<div class="section_title">' . $this->page_subsubcateg_name_ARRAY[$serial].' :: <a href="#" onClick="ugc_search_sync(); return false;">' . $tmp_ugc_search_str.'</a></div>
                <div class="content_results_subtitle_divider"></div>';

                        //
                        // TOUCH DATABASE WITH UGC CONTENT
                        // ACQUIRE NECESSARY DATABASE CONNECTION(S) AND SERIALIZE THEIR QUERIES...TO THEM, RESPECTIVELY.
                        $oCRNRSTN_MySQLi = $this->oCRNRSTN->return_crnrstn_mysqli();
                        $mysqli = $oCRNRSTN_MySQLi->return_conn_object();

                        //
                        // RETRIEVE DOCUMENTATION PAGE DATA
                        $query = 'SELECT `search_content`.`CONTENT_ID`,
                                    `search_content`.`PAGE_SERIAL`,
                                    `search_content`.`LANGCODE`,
                                    `search_content`.`CONTENT_PATH`,
                                    `search_content`.`BOOLEAN_TEST`,
                                    `search_content`.`CONTENT_LENGTH_RAW`,
                                    `search_content`.`MODIFIED_BY_IP`,
                                    `search_content`.`CREATED_BY_IP`,
                                    `search_content`.`MODIFIED_BY_USERAGENT`,
                                    `search_content`.`CREATED_BY_USERAGENT`,
                                    `search_content`.`DATEMODIFIED`,
                                    `search_content`.`DATECREATED`
                                FROM `search_content`
                                WHERE `search_content`.`ISACTIVE`="1";
                                ';

                        $oQueryProfileMgr->loadQueryProfile($oCRNRSTN_MySQLi, 'UGC_SEARCH_PREP', '!jesus_is_truly_lord!!', 'PAGE_DATA');
                        $this->oCRNRSTN->add_database_query($oQueryProfileMgr, 'PAGE_DATA', $query);

                        //
                        // PROCESS ALL QUERY TO CONNECTION(S)
                        $this->oCRNRSTN->process_query(true);

                        $tmp_page_cnt = $this->oCRNRSTN->return_record_count($oQueryProfileMgr, 'PAGE_DATA');

                        //
                        // IF WE HAVE PAGE DATA...
                        if ($tmp_page_cnt > 0) {

                            //
                            // PREPARE RECEIVED INPUT PARAMETERS FOR DATABASE QUERY
                            $tmp_ugc_search_str = $this->oCRNRSTN->get_http_resource('q');

                            $pos = strpos($tmp_ugc_search_str, '"');
                            if ($pos !== false) {
                                error_log('200 search - process for quotes...will break up words.');
                                //
                                // SEARCH ON QUOTED WORDS
                                $tmp_ugc_array = $oSideBitch_Usr->process_quoted_search($tmp_ugc_search_str);

                                //
                                // ACQUIRE NECESSARY DATABASE CONNECTION(S) AND SERIALIZE THEIR QUERIES...TO THEM, RESPECTIVELY.
                                $oCRNRSTN_MySQLi = $this->oCRNRSTN->return_crnrstn_mysqli();
                                $mysqli = $oCRNRSTN_MySQLi->return_conn_object();

                                //
                                // BUILD AND ADD QUERY
                                $tmp_cnt = sizeof($tmp_ugc_array);
                                $tmp_ugc_search_clean_str_ARRAY = array();
                                for ($i = 0; $i < $tmp_cnt; $i++) {

                                    $tmp_ugc_search_clean_str_ARRAY[$i] = strtolower($oSideBitch_Usr->str_sanitize($tmp_ugc_array[$i], 'search'));

                                    $query = 'SELECT `search_content_chunked`.`CHUNK_ID`,
                                                `search_content_chunked`.`CONTENT_ID`,
                                                `search_content_chunked`.`PAGE_SERIAL`,
                                                `search_content_chunked`.`LANGCODE`,
                                                `search_content_chunked`.`SEARCH_RESULT_DISPLAY`,
                                                `search_content_chunked`.`PAGE_CONTENT_SEARCH`,
                                                `search_content_chunked`.`PAGE_CONTENT_RAW`,
                                                `search_content_chunked`.`PAGE_CONTENT_TITLE`,
                                                `search_content_chunked`.`CONTENT_LENGTH_SEARCH`,
                                                `search_content_chunked`.`CONTENT_LENGTH_RAW`,
                                                `search_content_chunked`.`MODIFIED_BY_IP`,
                                                `search_content_chunked`.`CREATED_BY_IP`,
                                                `search_content_chunked`.`MODIFIED_BY_USERAGENT`,
                                                `search_content_chunked`.`CREATED_BY_USERAGENT`,
                                                `search_content_chunked`.`DATEMODIFIED`,
                                                `search_content_chunked`.`DATECREATED`
                                            FROM `search_content_chunked`
                                            WHERE `search_content_chunked`.`ISACTIVE`="1"
                                            AND `search_content_chunked`.`PAGE_CONTENT_SEARCH` LIKE "%' . $mysqli->real_escape_string($tmp_ugc_search_clean_str_ARRAY[$i]) . '%";
                                            ';

                                    $oQueryProfileMgr->loadQueryProfile($oCRNRSTN_MySQLi, 'UGC_SEARCH', '!jesus_is_truly_lord!', 'QUOTED_SEARCH_' . $i);
                                    $this->oCRNRSTN->add_database_query($oQueryProfileMgr, 'QUOTED_SEARCH_' . $i, $query);

                                }

                                //
                                // ALL QUERY READY
                                // PROCESS ALL QUERY TO CONNECTION(S)
                                $this->oCRNRSTN->process_query(true);

                                //
                                // COMBINE ALL DESIRED RESULT SETS INTO ONE TO SEQUENCE AND/OR PURGE DUPLICATES
                                // FOR EACH WORD OR QUOTED STRING RESULT SET
                                for ($i = 0; $i < $tmp_cnt; $i++) {

                                    #$this->oCRNRSTN->resultSetMerge(($oQueryProfileMgr, {ORIGINAL RESULT SET KEY}, {TARGET RESULT SET KEY}, {MERGE KEY FIELD...PIPE OK}, {SEQUENCE KEY FIELD(S)...PIPE OK} {MERGE FIELD DATATYPE...PIPE OK})
                                    $this->oCRNRSTN->resultSetMerge($oQueryProfileMgr, 'QUOTED_SEARCH_' . $i, 'MERGED_SEARCH_RESULTS', 'CONTENT_ID', true,'CONTENT_LENGTH_RAW|DATECREATED', 'INTEGER|DATETIME');

                                }

                                $tmp_result_set_cnt = $tmp_ugc_s_results_record_cnt = $this->oCRNRSTN->return_record_count($oQueryProfileMgr, 'MERGED_SEARCH_RESULTS');
                                $this->oCRNRSTN->increment_results_count_total($tmp_result_set_cnt);

                                $tmp_max_desktop_results = $this->oCRNRSTN->get_resource('RESULT_MAX_DESKTOP');
                                $this->oCRNRSTN->set_maximum_display_result_count($tmp_max_desktop_results);

                                $pagination_serial = $this->oCRNRSTN->returnPaginationSerial();
                                $this->oCRNRSTN->specifyPaginationVariableName('p', $pagination_serial);
                                $this->oCRNRSTN->addPaginationPassthroughInputVal('t', $tmp_ugc_search_str, $pagination_serial);

                                error_log('265 gen - call returnCurrentPaginationPos(' . $pagination_serial . ')');
                                $tmp_current_pagination_pos = $this->oCRNRSTN->returnCurrentPaginationPos($pagination_serial);
                                error_log('267 gen - returnCurrentPaginationPos(' . $pagination_serial . ')=' . $tmp_current_pagination_pos);

                                //$tmp_ugc_s_results_record_cnt = $tmp_merged_result_set_cnt;

                                //
                                // FOR EACH ROW IN MERGED RESULT SET
                                $cur_pos = ($tmp_max_desktop_results*$tmp_current_pagination_pos) - $tmp_max_desktop_results;

                                for ($i = $cur_pos; $i < $tmp_max_desktop_results+$cur_pos; $i++) {

                                    $tmp_content_id = $this->oCRNRSTN->return_db_value($oQueryProfileMgr, 'MERGED_SEARCH_RESULTS', 'CONTENT_ID', $i);

                                    $tmp_return_content = $this->oCRNRSTN->return_db_value($oQueryProfileMgr, 'MERGED_SEARCH_RESULTS', 'SEARCH_RESULT_DISPLAY', $i);
                                    $tmp_return_content_title = $this->oCRNRSTN->return_db_value($oQueryProfileMgr, 'MERGED_SEARCH_RESULTS', 'PAGE_CONTENT_TITLE', $i);
                                    // $tmp_page_serial = $oCRNRSTN_USR->return_db_value($oQueryProfileMgr, 'QUOTED_SEARCH_' . $i, 'PAGE_SERIAL', $ii);
                                    // error_log('117 search - CONTENT_ID=' . $tmp_content_id);

                                    $this->oCRNRSTN->add_lookup_field_data($oQueryProfileMgr, 'PAGE_DATA', 'CONTENT_ID', $tmp_content_id);

                                    // $tmp_page_path = $oCRNRSTN_USR->retrieve_data_by_id($oQueryProfileMgr, 'PAGE_DATA','CONTENT_PATH','CONTENT_ID', $tmp_content_id);
                                    // $tmp_page_path = $oCRNRSTN_USR->retrieve_data_by_id($oQueryProfileMgr, 'PAGE_DATA','CONTENT_PATH','CONTENT_ID|PAGE_SERIAL', $tmp_content_id.'|' . $tmp_page_serial);
                                    $tmp_page_path = $this->oCRNRSTN->retrieve_data_by_id($oQueryProfileMgr, 'PAGE_DATA', 'CONTENT_PATH');

                                    // $tmp_page_path = $oCRNRSTN_USR->retrieve_data_by_id($oQueryProfileMgr, 'PAGE_DATA', 'CONTENT_ID', $tmp_content_id, 'CONTENT_PATH');
                                    //error_log('302 gen - [' . $tmp_return_content_title . '] = path = ' . $tmp_page_path);

                                    //
                                    // BUILD HTML OUTPUT
                                    $html_out .= $oSideBitch_Usr->return_search_result_mobile($tmp_page_path, $tmp_return_content, $tmp_return_content_title, $tmp_ugc_search_str);

                                }

                            } else {

                                //
                                // NO QUOTES...PROCESS ENTIRE UGC
                                $tmp_ugc_search_str_clean = strtolower($oSideBitch_Usr->str_sanitize($tmp_ugc_search_str, 'search'));

                                $query = 'SELECT `search_content_chunked`.`CHUNK_ID`,
                                            `search_content_chunked`.`CONTENT_ID`,
                                            `search_content_chunked`.`PAGE_SERIAL`,
                                            `search_content_chunked`.`LANGCODE`,
                                            `search_content_chunked`.`SEARCH_RESULT_DISPLAY`,
                                            `search_content_chunked`.`PAGE_CONTENT_SEARCH`,
                                            `search_content_chunked`.`PAGE_CONTENT_RAW`,
                                            `search_content_chunked`.`PAGE_CONTENT_TITLE`,
                                            `search_content_chunked`.`CONTENT_LENGTH_SEARCH`,
                                            `search_content_chunked`.`CONTENT_LENGTH_RAW`,
                                            `search_content_chunked`.`MODIFIED_BY_IP`,
                                            `search_content_chunked`.`CREATED_BY_IP`,
                                            `search_content_chunked`.`MODIFIED_BY_USERAGENT`,
                                            `search_content_chunked`.`CREATED_BY_USERAGENT`,
                                            `search_content_chunked`.`DATEMODIFIED`,
                                            `search_content_chunked`.`DATECREATED`
                                        FROM `search_content_chunked`
                                        WHERE `search_content_chunked`.`ISACTIVE`="1"
                                        AND `search_content_chunked`.`PAGE_CONTENT_SEARCH` LIKE "%' . $mysqli->real_escape_string($tmp_ugc_search_str_clean) . '%";
                                        ';

                                //error_log('333 search - search query = [' . $query.']');

                                $oQueryProfileMgr->loadQueryProfile($oCRNRSTN_MySQLi, 'UGC_SEARCH', '!jesus_is_truly_lord!', 'PLAIN_SEARCH');
                                $this->oCRNRSTN->add_database_query($oQueryProfileMgr, 'PLAIN_SEARCH', $query);

                                //
                                // ALL QUERY READY
                                // PROCESS ALL QUERY TO CONNECTION(S)
                                $this->oCRNRSTN->process_query(true);

                                $tmp_cnt = $this->oCRNRSTN->return_record_count($oQueryProfileMgr, 'PLAIN_SEARCH');

                                //
                                // COMBINE ALL DESIRED RESULT SETS INTO ONE TO SEQUENCE AND/OR PURGE DUPLICATES
                                // FOR EACH WORD OR QUOTED STRING RESULT SET
                                for ($i = 0; $i < $tmp_cnt; $i++) {

                                    $this->oCRNRSTN->resultSetMerge($oQueryProfileMgr, 'PLAIN_SEARCH', 'MERGED_SEARCH_RESULTS', 'CONTENT_ID', true,'CONTENT_LENGTH_RAW|DATECREATED', 'INTEGER|DATETIME');

                                }

                                $tmp_result_set_cnt = $tmp_ugc_s_results_record_cnt = $this->oCRNRSTN->return_record_count($oQueryProfileMgr, 'MERGED_SEARCH_RESULTS');
                                $this->oCRNRSTN->increment_results_count_total($tmp_result_set_cnt);

                                if ($tmp_ugc_s_results_record_cnt > 0) {

                                    $tmp_max_desktop_results = $this->oCRNRSTN->get_resource('RESULT_MAX_DESKTOP');
                                    $this->oCRNRSTN->set_maximum_display_result_count($tmp_max_desktop_results);

                                    $pagination_serial = $this->oCRNRSTN->returnPaginationSerial();
                                    //$this->oCRNRSTN->setCurrentPaginationSensation();
                                    //error_log('341 gen - [' . $pagination_serial . '][' . $tmp_ugc_search_str.']');
                                    $this->oCRNRSTN->addPaginationPassthroughInputVal('t', $tmp_ugc_search_str, $pagination_serial);
                                    $this->oCRNRSTN->specifyPaginationVariableName('p', $pagination_serial);

                                    //
                                    // BUILD HTML OUTPUT AND RETURN
                                    //for ($ii = {PAGINATION_START_POS}; $ii < $tmp_max_desktop_results; $ii++) {
                                    $tmp_current_pagination_pos = $this->oCRNRSTN->returnCurrentPaginationPos($pagination_serial);
                                    //error_log('348 - [' . $tmp_max_desktop_results.'] current_pagination_pos=' . $tmp_current_pagination_pos);

                                    if($tmp_max_desktop_results>$tmp_ugc_s_results_record_cnt){

                                        $cur_pos = ($tmp_ugc_s_results_record_cnt*$tmp_current_pagination_pos) - $tmp_ugc_s_results_record_cnt;
                                        $tmp_max_desktop_results = $tmp_ugc_s_results_record_cnt;

                                    }else{

                                        $cur_pos = ($tmp_max_desktop_results*$tmp_current_pagination_pos) - $tmp_max_desktop_results;

                                    }

                                    for ($ii = $cur_pos; $ii < $tmp_max_desktop_results+$cur_pos; $ii++) {

                                        $tmp_content_id = $this->oCRNRSTN->return_db_value($oQueryProfileMgr, 'MERGED_SEARCH_RESULTS', 'CONTENT_ID', $ii);

                                        $tmp_return_content = $this->oCRNRSTN->return_db_value($oQueryProfileMgr, 'MERGED_SEARCH_RESULTS', 'SEARCH_RESULT_DISPLAY', $ii);
                                        $tmp_page_serial = $this->oCRNRSTN->return_db_value($oQueryProfileMgr, 'MERGED_SEARCH_RESULTS', 'PAGE_SERIAL', $ii);
                                        $tmp_return_content_title = $this->oCRNRSTN->return_db_value($oQueryProfileMgr, 'MERGED_SEARCH_RESULTS', 'PAGE_CONTENT_TITLE', $ii);

                                        $this->oCRNRSTN->init_lookup_by_id($oQueryProfileMgr, 'PAGE_DATA');
                                        $tmp_record_lookup_serial_ARRAY = $this->oCRNRSTN->add_lookup_field_data($oQueryProfileMgr,'PAGE_DATA', 'CONTENT_ID', $tmp_content_id);
                                        //error_log('218 search - lookup serial array size='.sizeof($tmp_record_lookup_serial_ARRAY));
                                        $tmp_record_lookup_serial_ARRAY = $this->oCRNRSTN->add_lookup_field_data($oQueryProfileMgr, 'PAGE_DATA', 'PAGE_SERIAL', $tmp_page_serial);
                                        //error_log('220 search - lookup serial array size='.sizeof($tmp_record_lookup_serial_ARRAY));

                                        //$tmp_page_path = $oCRNRSTN_USR->retrieve_data_by_id($oQueryProfileMgr, 'PAGE_DATA','CONTENT_PATH','CONTENT_ID', $tmp_content_id);
                                        //$tmp_page_path = $oCRNRSTN_USR->retrieve_data_by_id($oQueryProfileMgr, 'PAGE_DATA','CONTENT_PATH','CONTENT_ID|PAGE_SERIAL', $tmp_content_id.'|' . $tmp_page_serial);
                                        $tmp_page_path = $this->oCRNRSTN->retrieve_data_by_id($oQueryProfileMgr, 'PAGE_DATA', 'CONTENT_PATH');
                                        $tmp_CONTENT_LENGTH_RAW = $this->oCRNRSTN->retrieve_data_by_id($oQueryProfileMgr, 'PAGE_DATA', 'CONTENT_LENGTH_RAW');

                                        //error_log('365 gen - [' . $tmp_return_content_title . '](LEN=' . $tmp_CONTENT_LENGTH_RAW.') = path = ' . $tmp_page_path);
                                        $html_out .= $oSideBitch_Usr->return_search_result_mobile($tmp_page_path, $tmp_return_content, $tmp_return_content_title, $tmp_ugc_search_str);

                                    }

                                }
                            }

                            $tmp_walltime = $this->oCRNRSTN->wall_time();
                            $tmp_stats = '<div class="s_result_stats">' . $tmp_ugc_s_results_record_cnt.' results returned in ' . $tmp_walltime . ' seconds.</div>';

                            $html_out = $tmp_stats.$html_out;

                            $html_out .= $this->oCRNRSTN->returnPaginationStateHTML();
                        }

                    }else{

                        $html_out .= '<div class="section_title">&nbsp;</div><div class="content_results_subtitle_divider"></div>';
                        require($tmp_path_directory . $tmp_system_directory . '/common/inc/search/search.inc.php');

                    }

                }else{

                    $html_out .= '<div class="section_title">&nbsp;</div><div class="content_results_subtitle_divider"></div>';
                    require($tmp_path_directory . $tmp_system_directory . '/common/inc/search/search.inc.php');

                }

            break;
            default:

                //
                // DESKTOP EXPERIENCE
                // PROCESS FOR SEARCH RESULTS
                // ENABLE THIS PAGE TO RECEIVE HTTP POST/GET DATA
                if($this->oCRNRSTN->http_data_services_initialize()) {

                    if($this->oCRNRSTN->isset_crnrstn_services_http() || $this->oCRNRSTN->isset_crnrstn_services_http('GET')) {

                        //
                        // PREPARE RECEIVED INPUT PARAMETERS FOR DATABASE QUERY
                        $tmp_ugc_search_str = $this->oCRNRSTN->get_http_resource('t');

                        if($this->oCRNRSTN->isset_http_superglobal('POST')){

                            $tmp_encrypt = $this->oCRNRSTN->extract_data_HTTP('crnrstn_pssdtl_packet_ENCRYPTED', 'POST');
                            $tmp_ipacket = urlencode($this->oCRNRSTN->extract_data_HTTP('crnrstn_pssdtl_packet', 'POST'));
                            //error_log('154 gen - encode=>packet=' . $tmp_ipacket);

                        }else{

                            $tmp_encrypt = $this->oCRNRSTN->extract_data_HTTP('crnrstn_pssdtl_packet_ENCRYPTED');
                            $tmp_ipacket = urlencode($this->oCRNRSTN->extract_data_HTTP('crnrstn_pssdtl_packet'));
                            //error_log('160 gen - packet=' . $tmp_ipacket);
                        }

                        $html_out .= '<div class="section_title">' . $this->page_subsubcateg_name_ARRAY[$serial].' :: <a href="#" onClick="ugc_search_sync(); return false;">' . $tmp_ugc_search_str.'</a></div>
                <div class="content_results_subtitle_divider"></div>';

                        //
                        // TOUCH DATABASE WITH UGC CONTENT
                        // ACQUIRE NECESSARY DATABASE CONNECTION(S) AND SERIALIZE THEIR QUERIES...TO THEM, RESPECTIVELY.
                        $oCRNRSTN_MySQLi = $this->oCRNRSTN->return_crnrstn_mysqli();
                        $mysqli = $oCRNRSTN_MySQLi->return_conn_object();

                        //
                        // RETRIEVE DOCUMENTATION PAGE DATA
                        $query = 'SELECT `search_content`.`CONTENT_ID`,
                                    `search_content`.`PAGE_SERIAL`,
                                    `search_content`.`LANGCODE`,
                                    `search_content`.`CONTENT_PATH`,
                                    `search_content`.`BOOLEAN_TEST`,
                                    `search_content`.`CONTENT_LENGTH_RAW`,
                                    `search_content`.`MODIFIED_BY_IP`,
                                    `search_content`.`CREATED_BY_IP`,
                                    `search_content`.`MODIFIED_BY_USERAGENT`,
                                    `search_content`.`CREATED_BY_USERAGENT`,
                                    `search_content`.`DATEMODIFIED`,
                                    `search_content`.`DATECREATED`
                                FROM `search_content`
                                WHERE `search_content`.`ISACTIVE`="1";
                                ';

                        $oQueryProfileMgr->loadQueryProfile($oCRNRSTN_MySQLi, 'UGC_SEARCH_PREP', '!jesus_is_truly_lord!!', 'PAGE_DATA');
                        $this->oCRNRSTN->add_database_query($oQueryProfileMgr, 'PAGE_DATA', $query);

                        //
                        // PROCESS ALL QUERY TO CONNECTION(S)
                        $this->oCRNRSTN->process_query(true);

                        $tmp_page_cnt = $this->oCRNRSTN->return_record_count($oQueryProfileMgr, 'PAGE_DATA');

                        //
                        // IF WE HAVE PAGE DATA...
                        if ($tmp_page_cnt > 0) {

                            //
                            // PREPARE RECEIVED INPUT PARAMETERS FOR DATABASE QUERY
                            $tmp_ugc_search_str = $this->oCRNRSTN->get_http_resource('t');

                            $pos = strpos($tmp_ugc_search_str, '"');
                            if ($pos !== false) {
                                error_log('200 search - process for quotes...will break up words.');
                                //
                                // SEARCH ON QUOTED WORDS
                                $tmp_ugc_array = $oSideBitch_Usr->process_quoted_search($tmp_ugc_search_str);

                                //
                                // ACQUIRE NECESSARY DATABASE CONNECTION(S) AND SERIALIZE THEIR QUERIES...TO THEM, RESPECTIVELY.
                                $oCRNRSTN_MySQLi = $this->oCRNRSTN->return_crnrstn_mysqli();
                                $mysqli = $oCRNRSTN_MySQLi->return_conn_object();

                                //
                                // BUILD AND ADD QUERY
                                $tmp_cnt = sizeof($tmp_ugc_array);
                                $tmp_ugc_search_clean_str_ARRAY = array();
                                for ($i = 0; $i < $tmp_cnt; $i++) {

                                    $tmp_ugc_search_clean_str_ARRAY[$i] = strtolower($oSideBitch_Usr->str_sanitize($tmp_ugc_array[$i], 'search'));

                                    $query = 'SELECT `search_content_chunked`.`CHUNK_ID`,
                                                `search_content_chunked`.`CONTENT_ID`,
                                                `search_content_chunked`.`PAGE_SERIAL`,
                                                `search_content_chunked`.`LANGCODE`,
                                                `search_content_chunked`.`SEARCH_RESULT_DISPLAY`,
                                                `search_content_chunked`.`PAGE_CONTENT_SEARCH`,
                                                `search_content_chunked`.`PAGE_CONTENT_RAW`,
                                                `search_content_chunked`.`PAGE_CONTENT_TITLE`,
                                                `search_content_chunked`.`CONTENT_LENGTH_SEARCH`,
                                                `search_content_chunked`.`CONTENT_LENGTH_RAW`,
                                                `search_content_chunked`.`MODIFIED_BY_IP`,
                                                `search_content_chunked`.`CREATED_BY_IP`,
                                                `search_content_chunked`.`MODIFIED_BY_USERAGENT`,
                                                `search_content_chunked`.`CREATED_BY_USERAGENT`,
                                                `search_content_chunked`.`DATEMODIFIED`,
                                                `search_content_chunked`.`DATECREATED`
                                            FROM `search_content_chunked`
                                            WHERE `search_content_chunked`.`ISACTIVE`="1"
                                            AND `search_content_chunked`.`PAGE_CONTENT_SEARCH` LIKE "%' . $mysqli->real_escape_string($tmp_ugc_search_clean_str_ARRAY[$i]) . '%";
                                            ';

                                    $oQueryProfileMgr->loadQueryProfile($oCRNRSTN_MySQLi, 'UGC_SEARCH', '!jesus_is_truly_lord!', 'QUOTED_SEARCH_' . $i);
                                    $this->oCRNRSTN->add_database_query($oQueryProfileMgr, 'QUOTED_SEARCH_' . $i, $query);

                                }

                                //
                                // ALL QUERY READY
                                // PROCESS ALL QUERY TO CONNECTION(S)
                                $this->oCRNRSTN->process_query(true);

                                //
                                // COMBINE ALL DESIRED RESULT SETS INTO ONE TO SEQUENCE AND/OR PURGE DUPLICATES
                                // FOR EACH WORD OR QUOTED STRING RESULT SET
                                for ($i = 0; $i < $tmp_cnt; $i++) {

                                    #$this->oCRNRSTN->resultSetMerge(($oQueryProfileMgr, {ORIGINAL RESULT SET KEY}, {TARGET RESULT SET KEY}, {MERGE KEY FIELD...PIPE OK}, {SEQUENCE KEY FIELD(S)...PIPE OK} {MERGE FIELD DATATYPE...PIPE OK})
                                    $this->oCRNRSTN->resultSetMerge($oQueryProfileMgr, 'QUOTED_SEARCH_' . $i, 'MERGED_SEARCH_RESULTS', 'CONTENT_ID', true,'CONTENT_LENGTH_RAW|DATECREATED', 'INTEGER|DATETIME');

                                }

                                $tmp_result_set_cnt = $tmp_ugc_s_results_record_cnt = $this->oCRNRSTN->return_record_count($oQueryProfileMgr, 'MERGED_SEARCH_RESULTS');
                                $this->oCRNRSTN->increment_results_count_total($tmp_result_set_cnt);

                                $tmp_max_desktop_results = $this->oCRNRSTN->get_resource('RESULT_MAX_DESKTOP');
                                $this->oCRNRSTN->set_maximum_display_result_count($tmp_max_desktop_results);

                                $pagination_serial = $this->oCRNRSTN->returnPaginationSerial();
                                $this->oCRNRSTN->specifyPaginationVariableName('p', $pagination_serial);
                                $this->oCRNRSTN->addPaginationPassthroughInputVal('t', $tmp_ugc_search_str, $pagination_serial);

                                error_log('265 gen - call returnCurrentPaginationPos(' . $pagination_serial . ')');
                                $tmp_current_pagination_pos = $this->oCRNRSTN->returnCurrentPaginationPos($pagination_serial);
                                error_log('267 gen - returnCurrentPaginationPos(' . $pagination_serial . ')=' . $tmp_current_pagination_pos);

                                //$tmp_ugc_s_results_record_cnt = $tmp_merged_result_set_cnt;

                                //
                                // FOR EACH ROW IN MERGED RESULT SET
                                $cur_pos = ($tmp_max_desktop_results*$tmp_current_pagination_pos) - $tmp_max_desktop_results;

                                for ($i = $cur_pos; $i < $tmp_max_desktop_results+$cur_pos; $i++) {

                                    $tmp_content_id = $this->oCRNRSTN->return_db_value($oQueryProfileMgr, 'MERGED_SEARCH_RESULTS', 'CONTENT_ID', $i);

                                    $tmp_return_content = $this->oCRNRSTN->return_db_value($oQueryProfileMgr, 'MERGED_SEARCH_RESULTS', 'SEARCH_RESULT_DISPLAY', $i);
                                    $tmp_return_content_title = $this->oCRNRSTN->return_db_value($oQueryProfileMgr, 'MERGED_SEARCH_RESULTS', 'PAGE_CONTENT_TITLE', $i);
                                    // $tmp_page_serial = $oCRNRSTN_USR->return_db_value($oQueryProfileMgr, 'QUOTED_SEARCH_' . $i, 'PAGE_SERIAL', $ii);
                                    // error_log('117 search - CONTENT_ID=' . $tmp_content_id);

                                    $this->oCRNRSTN->add_lookup_field_data($oQueryProfileMgr, 'PAGE_DATA', 'CONTENT_ID', $tmp_content_id);

                                    // $tmp_page_path = $oCRNRSTN_USR->retrieve_data_by_id($oQueryProfileMgr, 'PAGE_DATA','CONTENT_PATH','CONTENT_ID', $tmp_content_id);
                                    // $tmp_page_path = $oCRNRSTN_USR->retrieve_data_by_id($oQueryProfileMgr, 'PAGE_DATA','CONTENT_PATH','CONTENT_ID|PAGE_SERIAL', $tmp_content_id.'|' . $tmp_page_serial);
                                    $tmp_page_path = $this->oCRNRSTN->retrieve_data_by_id($oQueryProfileMgr, 'PAGE_DATA', 'CONTENT_PATH');

                                    // $tmp_page_path = $oCRNRSTN_USR->retrieve_data_by_id($oQueryProfileMgr, 'PAGE_DATA', 'CONTENT_ID', $tmp_content_id, 'CONTENT_PATH');
                                    //error_log('302 gen - [' . $tmp_return_content_title . '] = path = ' . $tmp_page_path);

                                    //
                                    // BUILD HTML OUTPUT
                                    $html_out .= $oSideBitch_Usr->return_search_result_html($tmp_page_path, $tmp_return_content, $tmp_return_content_title, $tmp_ugc_search_str);

                                }

                            } else {

                                //
                                // NO QUOTES...PROCESS ENTIRE UGC
                                $tmp_ugc_search_str_clean = strtolower($oSideBitch_Usr->str_sanitize($tmp_ugc_search_str, 'search'));

                                $query = 'SELECT `search_content_chunked`.`CHUNK_ID`,
                                            `search_content_chunked`.`CONTENT_ID`,
                                            `search_content_chunked`.`PAGE_SERIAL`,
                                            `search_content_chunked`.`LANGCODE`,
                                            `search_content_chunked`.`SEARCH_RESULT_DISPLAY`,
                                            `search_content_chunked`.`PAGE_CONTENT_SEARCH`,
                                            `search_content_chunked`.`PAGE_CONTENT_RAW`,
                                            `search_content_chunked`.`PAGE_CONTENT_TITLE`,
                                            `search_content_chunked`.`CONTENT_LENGTH_SEARCH`,
                                            `search_content_chunked`.`CONTENT_LENGTH_RAW`,
                                            `search_content_chunked`.`MODIFIED_BY_IP`,
                                            `search_content_chunked`.`CREATED_BY_IP`,
                                            `search_content_chunked`.`MODIFIED_BY_USERAGENT`,
                                            `search_content_chunked`.`CREATED_BY_USERAGENT`,
                                            `search_content_chunked`.`DATEMODIFIED`,
                                            `search_content_chunked`.`DATECREATED`
                                        FROM `search_content_chunked`
                                        WHERE `search_content_chunked`.`ISACTIVE`="1"
                                        AND `search_content_chunked`.`PAGE_CONTENT_SEARCH` LIKE "%' . $mysqli->real_escape_string($tmp_ugc_search_str_clean) . '%";
                                        ';

                                $oQueryProfileMgr->loadQueryProfile($oCRNRSTN_MySQLi, 'UGC_SEARCH', '!jesus_is_truly_lord!', 'PLAIN_SEARCH');
                                $this->oCRNRSTN->add_database_query($oQueryProfileMgr, 'PLAIN_SEARCH', $query);

                                //
                                // ALL QUERY READY
                                // PROCESS ALL QUERY TO CONNECTION(S)
                                $this->oCRNRSTN->process_query(true);

                                $tmp_cnt = $this->oCRNRSTN->return_record_count($oQueryProfileMgr, 'PLAIN_SEARCH');

                                //
                                // COMBINE ALL DESIRED RESULT SETS INTO ONE TO SEQUENCE AND/OR PURGE DUPLICATES
                                // FOR EACH WORD OR QUOTED STRING RESULT SET
                                for ($i = 0; $i < $tmp_cnt; $i++) {

                                    $this->oCRNRSTN->resultSetMerge($oQueryProfileMgr, 'PLAIN_SEARCH', 'MERGED_SEARCH_RESULTS', 'CONTENT_ID', true,'CONTENT_LENGTH_RAW|DATECREATED', 'INTEGER|DATETIME');

                                }

                                $tmp_result_set_cnt = $tmp_ugc_s_results_record_cnt = $this->oCRNRSTN->return_record_count($oQueryProfileMgr, 'MERGED_SEARCH_RESULTS');
                                $this->oCRNRSTN->increment_results_count_total($tmp_result_set_cnt);

                                if ($tmp_ugc_s_results_record_cnt > 0) {

                                    $tmp_max_desktop_results = $this->oCRNRSTN->get_resource('RESULT_MAX_DESKTOP');
                                    $this->oCRNRSTN->set_maximum_display_result_count($tmp_max_desktop_results);

                                    $pagination_serial = $this->oCRNRSTN->returnPaginationSerial();
                                    //$this->oCRNRSTN->setCurrentPaginationSensation();
                                    //error_log('341 gen - [' . $pagination_serial . '][' . $tmp_ugc_search_str.']');
                                    $this->oCRNRSTN->addPaginationPassthroughInputVal('t', $tmp_ugc_search_str, $pagination_serial);
                                    $this->oCRNRSTN->specifyPaginationVariableName('p', $pagination_serial);

                                    //
                                    // BUILD HTML OUTPUT AND RETURN
                                    //for ($ii = {PAGINATION_START_POS}; $ii < $tmp_max_desktop_results; $ii++) {
                                    $tmp_current_pagination_pos = $this->oCRNRSTN->returnCurrentPaginationPos($pagination_serial);
                                    //error_log('348 - [' . $tmp_max_desktop_results.'] current_pagination_pos=' . $tmp_current_pagination_pos);

                                    if($tmp_max_desktop_results>$tmp_ugc_s_results_record_cnt){

                                        $cur_pos = ($tmp_ugc_s_results_record_cnt*$tmp_current_pagination_pos) - $tmp_ugc_s_results_record_cnt;
                                        $tmp_max_desktop_results = $tmp_ugc_s_results_record_cnt;

                                    }else{

                                        $cur_pos = ($tmp_max_desktop_results*$tmp_current_pagination_pos) - $tmp_max_desktop_results;

                                    }

                                    for ($ii = $cur_pos; $ii < $tmp_max_desktop_results+$cur_pos; $ii++) {

                                        $tmp_content_id = $this->oCRNRSTN->return_db_value($oQueryProfileMgr, 'MERGED_SEARCH_RESULTS', 'CONTENT_ID', $ii);

                                        $tmp_return_content = $this->oCRNRSTN->return_db_value($oQueryProfileMgr, 'MERGED_SEARCH_RESULTS', 'SEARCH_RESULT_DISPLAY', $ii);
                                        $tmp_page_serial = $this->oCRNRSTN->return_db_value($oQueryProfileMgr, 'MERGED_SEARCH_RESULTS', 'PAGE_SERIAL', $ii);
                                        $tmp_return_content_title = $this->oCRNRSTN->return_db_value($oQueryProfileMgr, 'MERGED_SEARCH_RESULTS', 'PAGE_CONTENT_TITLE', $ii);

                                        $this->oCRNRSTN->init_lookup_by_id($oQueryProfileMgr, 'PAGE_DATA');
                                        $tmp_record_lookup_serial_ARRAY = $this->oCRNRSTN->add_lookup_field_data($oQueryProfileMgr,'PAGE_DATA', 'CONTENT_ID', $tmp_content_id);
                                        //error_log('218 search - lookup serial array size='.sizeof($tmp_record_lookup_serial_ARRAY));
                                        $tmp_record_lookup_serial_ARRAY = $this->oCRNRSTN->add_lookup_field_data($oQueryProfileMgr, 'PAGE_DATA', 'PAGE_SERIAL', $tmp_page_serial);
                                        //error_log('220 search - lookup serial array size='.sizeof($tmp_record_lookup_serial_ARRAY));

                                        //$tmp_page_path = $oCRNRSTN_USR->retrieve_data_by_id($oQueryProfileMgr, 'PAGE_DATA','CONTENT_PATH','CONTENT_ID', $tmp_content_id);
                                        //$tmp_page_path = $oCRNRSTN_USR->retrieve_data_by_id($oQueryProfileMgr, 'PAGE_DATA','CONTENT_PATH','CONTENT_ID|PAGE_SERIAL', $tmp_content_id.'|' . $tmp_page_serial);
                                        $tmp_page_path = $this->oCRNRSTN->retrieve_data_by_id($oQueryProfileMgr, 'PAGE_DATA', 'CONTENT_PATH');
                                        $tmp_CONTENT_LENGTH_RAW = $this->oCRNRSTN->retrieve_data_by_id($oQueryProfileMgr, 'PAGE_DATA', 'CONTENT_LENGTH_RAW');

                                        //error_log('365 gen - [' . $tmp_return_content_title . '](LEN=' . $tmp_CONTENT_LENGTH_RAW.') = path = ' . $tmp_page_path);
                                        $html_out .= $oSideBitch_Usr->return_search_result_html($tmp_page_path, $tmp_return_content, $tmp_return_content_title, $tmp_ugc_search_str);

                                    }

                                }
                            }

                            $tmp_walltime = $this->oCRNRSTN->wall_time();
                            $tmp_stats = '<div class="s_result_stats">' . $tmp_ugc_s_results_record_cnt.' results returned in ' . $tmp_walltime . ' seconds.</div>';

                            $html_out = $tmp_stats.$html_out;
                            require($tmp_path_directory . $tmp_system_directory . '/common/inc/search/search.inc.php');

                            $html_out .= $this->oCRNRSTN->returnPaginationStateHTML();
                        }

                    }else{

                        $html_out .= '<div class="section_title">&nbsp;</div><div class="content_results_subtitle_divider"></div>';
                        require($tmp_path_directory . $tmp_system_directory . '/common/inc/search/search.inc.php');

                    }

                }else{

                    $html_out .= '<div class="section_title">&nbsp;</div><div class="content_results_subtitle_divider"></div>';
                    require($tmp_path_directory . $tmp_system_directory . '/common/inc/search/search.inc.php');

                }

            break;

        }

        return $html_out;

    }

    public function return_page_html($channel){

        $html_out = '';

	    switch($channel){
            case 'index':
                //$html_out .= $this->prep_page_index_content($this->page_subsubcateg_name_ARRAY[$serial]);
                $search_result = '';
                if(strlen($this->page_subsubcateg_name_ARRAY[$this->page_serial])>2){

                    $tmp_page_title = $this->page_subsubcateg_name_ARRAY[$this->page_serial];

                }else{

                    $tmp_page_title = $this->page_subcategory_name_ARRAY[$this->page_serial];

                }

                //$tmp_page_title = $this->page_subsubcateg_name_ARRAY[$this->page_serial];

                $tmp_page_element_cnt = sizeof($this->content_load_sequence_ARRAY);
                //error_log('415 gen - count=' . $tmp_page_element_cnt);
                for($i = 0; $i < $tmp_page_element_cnt; $i++){

                    //
                    // FOR EACH PAGE ELEMENT IN SEQUENCE.
                    foreach($this->page_content_ARRAY[$this->page_serial][$this->content_load_sequence_ARRAY[$i]] as $key=>$val){
                        //error_log('422 gen - index me key[' . $key.'] val[' . $val . ']');
                        switch($key){
                            case 'SUB_TITLE':
                            case 'BASIC_COPY':
                                if($search_result==''){
                                    if($val!=''){

                                        $search_result = $this->prep_page_index_content($val);

                                    }

                                }
                            case 'NOTE_COPY':
                            case 'METHOD_DEFINITION':
                            case 'RETURN_VALUE':
                                //error_log('430 gen - val=' . $val);
                                $html_out .= $this->prep_page_index_content($val);
                                //error_log('432 gen - out=' . $html_out);
                            break;
                            case 'EXAMPLE_CONTENT':

                                if($val['title_string']!=''){

                                    $html_out .= $this->prep_page_index_content($val['title_string']);

                                }

                                if($val['integrated_title_string']!=''){

                                    $html_out .= $this->prep_page_index_content($val['integrated_title_string']);

                                }

                                //
                                // CODE EXAMPLE
                                // $html_out .= $this->prep_page_index_content($this->retrieve_code_example_html($val['pres_file']));
                                if($val['pres_file']!=''){

                                    $html_out .= $this->prep_page_index_content($val['pres_file'], 'file');

                                }

                                //
                                // EXAMPLE OUTPUT
                                //$html_out .= $this->prep_page_index_content($val['title_string']);

                            break;
                            case 'TECH_SPEC':

                                $tmp_spec_size = sizeof($val);
                                for($ii=0;$ii<$tmp_spec_size;$ii++){

                                    if($val[$ii]!=''){

                                        $html_out .= $this->prep_page_index_content($val[$ii]);

                                    }

                                }

                            break;
                            case 'PARAMETER_DEFINITION':

                                foreach($val as $tmp_key=>$tmp_val){

                                    if(isset($tmp_val['param_datatype'])){

                                        if($tmp_val['param_datatype']!=''){

                                            $html_out .= $this->prep_page_index_content($tmp_val['param_datatype']);

                                        }

                                    }

                                    if($tmp_val['param_name']!=''){

                                        $html_out .= $this->prep_page_index_content($tmp_val['param_name']);

                                    }

                                    if($tmp_val['param_definition']!=''){

                                        $html_out .= $this->prep_page_index_content($tmp_val['param_definition']);

                                    }


                                }

                            break;

                        }

                        //error_log('470 - ' . $html_out);

                    }

                }

            break;
            case 'MOBILE':
            case 'TABLET':

                if(strlen($this->page_subsubcateg_name_ARRAY[$this->page_serial])>2){

                    $html_out = '<h3 class="content_results_subtitle">' . $this->page_subsubcateg_name_ARRAY[$this->page_serial].' ::</h3>
                <div class="content_results_subtitle_divider"></div>';

                }else{

                    $html_out = '<h3 class="content_results_subtitle">'.strtolower($this->page_subcategory_name_ARRAY[$this->page_serial]).' ::</h3>
                <div class="content_results_subtitle_divider"></div>';

                }

                //
                // LOOP THROUGH CONTENT ARRAY
                $tmp_page_element_cnt = sizeof($this->content_load_sequence_ARRAY);

                for($i = 0; $i < $tmp_page_element_cnt; $i++){

                    //
                    // FOR EACH PAGE ELEMENT IN SEQUENCE.
                    foreach($this->page_content_ARRAY[$this->page_serial][$this->content_load_sequence_ARRAY[$i]] as $key => $val){

                        switch($key){
                            case 'SUB_TITLE':

                                $html_out .= '<h3 class="content_results_subtitle">' . $val . ' ::</h3>
                <div class="content_results_subtitle_divider"></div>';

                            break;
                            case 'BASIC_COPY':

                                # <div class="crnrstn_page_description">....</div>
                                $html_out .= '<div class="crnrstn_page_description">' . $val . '</div>';

                            break;
                            case 'NOTE_COPY':

                                /*
                                <div class="crnrstn_note_wrapper">
                                    <div class="crnrstn_note_crnrstn_icon" style="background-image: url('<?php echo $oCRNRSTN_USR->crnrstn_http_endpoint;  ?>common/imgs/logo_sm.png'); background-repeat: no-repeat; width:50px; height:30px; float:right;"></div>
                                    <div class="crnrstn_note_notetitle">Note ::</div>
                                    <div class="crnrstn_note_notecopy">This functionality stands on top of the <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a> project which has been incorporated into C<span class="the_R">R</span>NRSTN Suite v2.0.0. <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a> is a lightweight PHP class for detecting mobile devices (including tablets). It uses the User-Agent string combined with specific HTTP headers to detect the mobile environment. <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a> is sponsored by it's developers and community, and they send thanks to the JetBrains team for providing <a href="https://www.jetbrains.com/phpstorm/" target="_blank">PHPStorm</a> and <a href="https://www.jetbrains.com/datagrip/" target="_blank">DataGrip</a> licenses for said project.</div>
                                    <div class="cb"></div>
                                </div>

                                */

                                $html_out .= '<div class="crnrstn_note_wrapper">
                                    <div class="crnrstn_note_crnrstn_icon" style="background-image: url(\'' . $this->oCRNRSTN->crnrstn_http_endpoint.'common/imgs/logo_sm.png\'); background-repeat: no-repeat; width:50px; height:30px; float:right;"></div>
                                    <div class="crnrstn_note_notetitle">Note ::</div>
                                    <div class="crnrstn_note_notecopy">' . $val . '</div>
                                    <div class="cb"></div>
                                </div>';

                            break;
                            case 'EXAMPLE':

                                /*
                                $this->page_content_ARRAY[$serial][$tmp_seq_key][$key]['title_string'] = $attribute_00;
                                $this->page_content_ARRAY[$serial][$tmp_seq_key][$key]['integrated_title_string'] = $attribute_01;
                                $this->page_content_ARRAY[$serial][$tmp_seq_key][$key]['pres_file'] = $attribute_02;
                                $this->page_content_ARRAY[$serial][$tmp_seq_key][$key]['exec_file'] = $attribute_03;

                                */

                                $html_out .= '<div class="crnrstn_example_title_wrapper">
                                    <div class="crnrstn_example_title">' . $val['title_string'].' ::</div>
                                    <div class="crnrstn_example_description">' . $val['integrated_title_string'].'</div>
                                </div>';

                                //
                                // CODE EXAMPLE
                                $html_out .= $this->retrieve_code_example_html($val['pres_file']);

                                //
                                // EXAMPLE OUTPUT

                                $html_out .= '<div class="crnrstn_example_title_wrapper"><div class="crnrstn_example_title">' . $val['title_string'] . ' Output ::</div></div>';
                                $html_out .= $this->retrieve_code_example_output_html($val['exec_file']);

                            break;
                            case 'TECH_SPEC':

                                $html_out .= '<div class="section_title">Technical specifications ::</div>
                                <div class="content_results_subtitle_divider"></div>
                                <div class="tech_specs_wrapper">
                                    <ul>';

                                $tmp_spec_size = sizeof($val);
                                for($ii = 0; $ii < $tmp_spec_size; $ii++){

                                    $html_out .= '<li>' . $val[$ii] . '</li>';

                                }

                                $html_out .= '</ul>
                                </div>';

                            break;
                            case 'INVOKING_CLASS':

                                $html_out .= '<div class="section_title">Invoking class ::</div>
                                <div class="content_results_subtitle_divider"></div>
                                <div class="basic_section_content">' . $val . '</div>';

                            break;
                            case 'METHOD_DEFINITION':

                                $html_out .= '<div class="section_title">Method definition ::</div>
                                <div class="content_results_subtitle_divider"></div>
                                <div class="basic_section_content">' . $val . '</div>';

                            break;
                            case 'PARAMETER_DEFINITION':

                                $html_out .= '<div class="section_title">Method parameter definitions ::</div>
                                <div class="content_results_subtitle_divider"></div>
                                <div class="basic_section_content">';

                                foreach($val as $tmp_key => $tmp_val){

                                    if(!isset($tmp_val['param_datatype'])){

                                        $tmp_val['param_datatype'] = '';

                                    }else{

                                        $tmp_val['param_datatype'] .= '&nbsp;&nbsp;';

                                    }

                                    if($tmp_val['param_required']){

                                        $html_out .=  '<div class="method_parameter"><span class="method_parameter_datatype">' . $tmp_val['param_datatype'].'</span>' . $tmp_val['param_name'].'&nbsp;<span class="parameter_require_required">(Required)</span></div>
                                    <blockquote class="method_parameter_definition">' . $tmp_val['param_definition'].'</blockquote>';

                                    }else{

                                        $html_out .=  '<div class="method_parameter"><span class="method_parameter_datatype">' . $tmp_val['param_datatype'].'</span>' . $tmp_val['param_name'].'&nbsp;<span class="parameter_require_optional">(Optional)</span></div>
                                    <blockquote class="method_parameter_definition">' . $tmp_val['param_definition'].'</blockquote>';

                                    }

                                }

                                $html_out .= '</div>';

                            break;
                            case 'RETURNED_VALUE':

                                $html_out .= '<div class="section_title">Returned value ::</div>
                                <div class="content_results_subtitle_divider"></div>
                                <div class="basic_section_content">' . $val . '</div>';

                            break;

                        }

                    }

                }

            break;
            default:
//
//                $tmp_example_test = '//
//// CALCULATE MINIMUM BYTES REQUIRED FOR NEW FILE
//$tmp_minimum_bytes_required = strlen($tmp_data_str_out);
//
////
//// ASK CRNRSTN :: TO GRANT PERMISSIONS FOR fwrite()
//// WARNINGS WILL BE THROWN @ $oCRNRSTN->max_storage_utilization_warning PERCENTAGE.
//// WRITE REQUESTS WILL BE DENIED @ $oCRNRSTN->max_storage_utilization PERCENTAGE.
//if(!$this->oCRNRSTN->grant_permissions_fwrite($tmp_filepath, $tmp_minimum_bytes_required)){
//
//    //
//    // HOOOSTON...VE HAF PROBLEM!
//    $this->oCRNRSTN->error_log(\'DISK WRITE ERROR. Disk space exceeds \' . $this->oCRNRSTN->get_performance_metric(\'maximum_disk_use\') . \'% minimum allocation of free space. File write [\' . $tmp_filepath . \'] stopped. CRNRSTN :: is configured to stop file writes when allocation of free space on disk exceeds specified limits.\', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY_DISK);
//
//    $this->oCRNRSTN->print_r(\'DISK WRITE ERROR. Disk space exceeds \' . $this->oCRNRSTN->get_performance_metric(\'maximum_disk_use\') . \'% minimum allocation of free space. File write stopped. CRNRSTN :: is configured to stop file writes when allocation of free space on disk exceeds specified limits.\', \'Image Processing.\', NULL, __LINE__, __METHOD__, __FILE__);
//
//    throw new Exception(\'DISK WRITE ERROR. Disk space exceeds \' . $this->oCRNRSTN->get_performance_metric(\'maximum_disk_use\') . \'% minimum allocation of free space. File write [\' . $tmp_filepath . \'] stopped. CRNRSTN :: is configured to stop file writes when allocation of free space on disk exceeds specified limits.\');
//
//}';
//                $tmp_example_test = $this->oCRNRSTN->print_r_str($tmp_example_test, 'CRNRSTN :: SNIPPET FROM crnrstn_system_image_asset_manager::system_base64_write()', CRNRSTN_UI_DARKNIGHT, __LINE__, __METHOD__, __FILE__);
//
//                $html_out = '<a name="crnrstn_top_' . $this->oCRNRSTN->session_salt() . '"></a>
//            <div class="crnrstn_documentation_dyn_content_shell">
//
//                <div class="crnrstn_documentation_dyn_content_module_wrap_s3">
//
//                    <div class="crnrstn_documentation_dyn_content_module_border_rel">
//                        <div class="crnrstn_documentation_dyn_content_module_border">
//                            <div class="crnrstn_hidden_void">
//                                <div class="crnrstn_documentation_dyn_content_title"><h1>' . $this->oCRNRSTN->oCRNRSTN_DATA_TUNNEL_MGR->return_received_data('crnrstn_interact_ui_link_text_click') . '</h1></div>
//                                <div class="crnrstn_documentation_dyn_content_description"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Neque sodales ut etiam sit. Tincidunt nunc pulvinar sapien et ligula ullamcorper malesuada proin libero. Ultricies tristique nulla aliquet enim tortor at. Posuere urna nec tincidunt praesent semper feugiat nibh sed.</p></div>
//
//                            </div>
//                        </div>
//                    </div>
//
//                    <div class="crnrstn_documentation_dyn_content_module_wrap_s2_outter">
//                        <div class="crnrstn_documentation_dyn_content_module_wrap_s2_inner">
//
//                            <div class="crnrstn_documentation_dyn_content_module_bg_rel">
//
//                                <div class="crnrstn_documentation_dyn_content_module_wrap_s1_rel">
//
//                                    <div class="crnrstn_documentation_dyn_content_module_wrap_s1">
//
//                                        <div class="crnrstn_documentation_dyn_content_title"><h1>' . $this->oCRNRSTN->oCRNRSTN_DATA_TUNNEL_MGR->return_received_data('crnrstn_interact_ui_link_text_click') . '</h1></div>
//                                        <div class="crnrstn_documentation_dyn_content_description"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Neque sodales ut etiam sit. Tincidunt nunc pulvinar sapien et ligula ullamcorper malesuada proin libero. Ultricies tristique nulla aliquet enim tortor at. Posuere urna nec tincidunt praesent semper feugiat nibh sed.</p></div>
//
//                                    </div>
//
//                                    <div class="crnrstn_documentation_dyn_content_module_bg"></div>
//
//                                    <div class="crnrstn_hidden_void">
//                                        <div class="crnrstn_documentation_dyn_content_title"><h1>' . $this->oCRNRSTN->oCRNRSTN_DATA_TUNNEL_MGR->return_received_data('crnrstn_interact_ui_link_text_click') . '</h1></div>
//                                        <div class="crnrstn_documentation_dyn_content_description"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Neque sodales ut etiam sit. Tincidunt nunc pulvinar sapien et ligula ullamcorper malesuada proin libero. Ultricies tristique nulla aliquet enim tortor at. Posuere urna nec tincidunt praesent semper feugiat nibh sed.</p></div>
//
//                                    </div>
//
//                                </div>
//
//                            </div>
//
//                        </div>
//                    </div>
//                </div>
//
//                <div class="crnrstn_documentation_dyn_content_module_wrap_s3">
//
//                    <div class="crnrstn_documentation_dyn_content_module_border_rel">
//                        <div class="crnrstn_documentation_dyn_content_module_border">
//                            <div class="crnrstn_hidden_void">
//
//                                <div class="crnrstn_documentation_dyn_content_title"><h2>' . $this->oCRNRSTN->multi_lang_content_return('DOCUMENTATION_EXAMPLE_TITLE_TXT') . ' 1 ::</h2></div>
//                                <div class="crnrstn_documentation_dyn_content_example">' . $tmp_example_test . '</div>
//
//                            </div>
//                        </div>
//                    </div>
//
//                    <div class="crnrstn_documentation_dyn_content_module_wrap_s2_outter">
//                        <div class="crnrstn_documentation_dyn_content_module_wrap_s2_inner">
//
//                            <div class="crnrstn_documentation_dyn_content_module_bg_rel">
//
//                                <div class="crnrstn_documentation_dyn_content_module_wrap_s1_rel">
//
//                                    <div class="crnrstn_documentation_dyn_content_module_wrap_s1">
//
//                                        <div class="crnrstn_documentation_dyn_content_title"><h2>' . $this->oCRNRSTN->multi_lang_content_return('DOCUMENTATION_EXAMPLE_TITLE_TXT') . ' 1 ::</h2></div>
//                                        <div class="crnrstn_documentation_dyn_content_example">' . $tmp_example_test . '</div>
//
//                                    </div>
//
//                                    <div class="crnrstn_documentation_dyn_content_module_bg"></div>
//
//                                    <div class="crnrstn_hidden_void">
//                                        <div class="crnrstn_documentation_dyn_content_title"><h2>' . $this->oCRNRSTN->multi_lang_content_return('DOCUMENTATION_EXAMPLE_TITLE_TXT') . ' 1 ::</h2></div>
//                                        <div class="crnrstn_documentation_dyn_content_example">' . $tmp_example_test . '</div>
//                                    </div>
//
//                                </div>
//
//                            </div>
//
//                        </div>
//                    </div>
//                </div>
//
//                <div class="crnrstn_documentation_dyn_content_module_wrap_s3">
//
//                    <div class="crnrstn_documentation_dyn_content_module_border_rel">
//                        <div class="crnrstn_documentation_dyn_content_module_border">
//                            <div class="crnrstn_hidden_void">
//
//                                <div class="crnrstn_documentation_dyn_content_note_copy"><p>Velit euismod in pellentesque massa placerat duis ultricies lacus sed. Hac habitasse platea dictumst quisque sagittis purus sit. Ipsum nunc aliquet bibendum enim facilisis. Nunc congue nisi vitae suscipit tellus mauris a. Eros in cursus turpis massa tincidunt dui ut ornare lectus. A lacus vestibulum sed arcu non. Pellentesque nec nam aliquam sem et tortor consequat.</p></div>
//
//                            </div>
//                        </div>
//                    </div>
//
//                    <div class="crnrstn_documentation_dyn_content_module_wrap_s2_outter">
//                        <div class="crnrstn_documentation_dyn_content_module_wrap_s2_inner">
//
//                            <div class="crnrstn_documentation_dyn_content_module_bg_rel">
//
//                                <div class="crnrstn_documentation_dyn_content_module_wrap_s1_rel">
//
//                                    <div class="crnrstn_documentation_dyn_content_module_wrap_s1">
//                                        <div class="crnrstn_documentation_dyn_content_note_copy"><p>Velit euismod in pellentesque massa placerat duis ultricies lacus sed. Hac habitasse platea dictumst quisque sagittis purus sit. Ipsum nunc aliquet bibendum enim facilisis. Nunc congue nisi vitae suscipit tellus mauris a. Eros in cursus turpis massa tincidunt dui ut ornare lectus. A lacus vestibulum sed arcu non. Pellentesque nec nam aliquam sem et tortor consequat.</p></div>
//
//                                    </div>
//
//                                    <div class="crnrstn_documentation_dyn_content_module_bg">
//                                        <div class="crnrstn_interact_ui_bg_title_note">' . $this->oCRNRSTN->multi_lang_content_return('DOCUMENTATION_BACKGROUND_COPY_NOTE') . '</div>
//                                        <div class="crnrstn_interact_ui_r_stone_pillar">' . $this->oCRNRSTN->return_system_image('R_STONE_PILLAR', '', 160, NULL, NULL, NULL, NULL, CRNRSTN_UI_IMG_HTML_WRAPPED) . '</div>
//
//                                    </div>
//
//                                    <div class="crnrstn_hidden_void">
//                                        <div class="crnrstn_documentation_dyn_content_note_copy"><p>Velit euismod in pellentesque massa placerat duis ultricies lacus sed. Hac habitasse platea dictumst quisque sagittis purus sit. Ipsum nunc aliquet bibendum enim facilisis. Nunc congue nisi vitae suscipit tellus mauris a. Eros in cursus turpis massa tincidunt dui ut ornare lectus. A lacus vestibulum sed arcu non. Pellentesque nec nam aliquam sem et tortor consequat.</p></div>
//                                    </div>
//
//                                </div>
//
//                            </div>
//
//                        </div>
//                    </div>
//                </div>
//
//                <div class="crnrstn_documentation_dyn_content_module_wrap_s3">
//
//                    <div class="crnrstn_documentation_dyn_content_module_border_rel">
//                        <div class="crnrstn_documentation_dyn_content_module_border">
//                            <div class="crnrstn_hidden_void">
//
//                                <div class="crnrstn_documentation_dyn_content_tech_specs_wrapper">
//                                    <ul class="crnrstn_documentation_dyn_content_tech_specs">
//                                        <li>Risus at ultrices mi tempus imperdiet nulla malesuada pellentesque. At augue eget arcu dictum. Lorem ipsum dolor sit amet consectetur adipiscing elit duis tristique.</li>
//                                        <li>Eget est lorem ipsum dolor.</li>
//                                        <li style="padding-bottom: 0;">It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.</li>
//
//                                    </ul>
//                                </div>
//
//                            </div>
//                        </div>
//                    </div>
//
//                    <div class="crnrstn_documentation_dyn_content_module_wrap_s2_outter">
//                        <div class="crnrstn_documentation_dyn_content_module_wrap_s2_inner">
//
//                            <div class="crnrstn_documentation_dyn_content_module_bg_rel">
//
//                                <div class="crnrstn_documentation_dyn_content_module_wrap_s1_rel">
//
//                                    <div class="crnrstn_documentation_dyn_content_module_wrap_s1">
//
//                                        <div class="crnrstn_documentation_dyn_content_tech_specs_wrapper">
//                                            <ul class="crnrstn_documentation_dyn_content_tech_specs">
//                                                <li>Risus at ultrices mi tempus imperdiet nulla malesuada pellentesque. At augue eget arcu dictum. Lorem ipsum dolor sit amet consectetur adipiscing elit duis tristique.</li>
//                                                <li>Eget est lorem ipsum dolor.</li>
//                                                <li style="padding-bottom: 0;">It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.</li>
//
//                                            </ul>
//                                        </div>
//
//                                    </div>
//
//                                    <div class="crnrstn_documentation_dyn_content_module_bg">
//                                        <div class="crnrstn_interact_ui_bg_title_tech_spec">' . $this->oCRNRSTN->multi_lang_content_return('DOCUMENTATION_BACKGROUND_COPY_TECH_SPECS') . '</div>
//
//                                    </div>
//
//                                    <div>
//                                        <div class="crnrstn_hidden_void">
//
//                                            <div class="crnrstn_documentation_dyn_content_tech_specs_wrapper">
//                                                <ul class="crnrstn_documentation_dyn_content_tech_specs">
//                                                    <li>Risus at ultrices mi tempus imperdiet nulla malesuada pellentesque. At augue eget arcu dictum. Lorem ipsum dolor sit amet consectetur adipiscing elit duis tristique.</li>
//                                                    <li>Eget est lorem ipsum dolor.</li>
//                                                    <li style="padding-bottom: 0;">It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.</li>
//
//                                                </ul>
//                                            </div>
//
//                                        </div>
//                                    </div>
//
//                                </div>
//
//                            </div>
//
//                        </div>
//                    </div>
//                </div>
//
//                <div class="crnrstn_documentation_dyn_content_module_wrap_s3">
//
//                    <div class="crnrstn_documentation_dyn_content_module_border_rel">
//                        <div class="crnrstn_documentation_dyn_content_module_border">
//                            <div class="crnrstn_hidden_void">
//
//                                <div class="crnrstn_documentation_dyn_content_description"><p>Risus nullam eget felis eget nunc lobortis mattis aliquam faucibus. Nibh tortor id aliquet lectus proin nibh. In hac habitasse platea dictumst quisque sagittis purus sit amet. Sit amet volutpat consequat mauris nunc congue. Dui nunc mattis enim ut tellus elementum sagittis vitae et. Tristique et egestas quis ipsum suspendisse ultrices gravida. Rhoncus urna neque viverra justo nec. Eget nullam non nisi est sit amet facilisis magna etiam. Luctus accumsan tortor posuere ac ut. Purus viverra accumsan in nisl. Nunc congue nisi vitae suscipit tellus mauris a. Eros in cursus turpis massa tincidunt dui ut ornare lectus. Tellus at urna condimentum mattis pellentesque id nibh tortor id. Amet nisl purus in mollis nunc.</p></div>
//
//                            </div>
//                        </div>
//                    </div>
//
//                    <div class="crnrstn_documentation_dyn_content_module_wrap_s2_outter">
//                        <div class="crnrstn_documentation_dyn_content_module_wrap_s2_inner">
//
//                            <div class="crnrstn_documentation_dyn_content_module_bg_rel">
//
//                                <div class="crnrstn_documentation_dyn_content_module_wrap_s1_rel">
//
//                                    <div class="crnrstn_documentation_dyn_content_module_wrap_s1">
//
//                                        <div class="crnrstn_documentation_dyn_content_description"><p>Risus nullam eget felis eget nunc lobortis mattis aliquam faucibus. Nibh tortor id aliquet lectus proin nibh. In hac habitasse platea dictumst quisque sagittis purus sit amet. Sit amet volutpat consequat mauris nunc congue. Dui nunc mattis enim ut tellus elementum sagittis vitae et. Tristique et egestas quis ipsum suspendisse ultrices gravida. Rhoncus urna neque viverra justo nec. Eget nullam non nisi est sit amet facilisis magna etiam. Luctus accumsan tortor posuere ac ut. Purus viverra accumsan in nisl. Nunc congue nisi vitae suscipit tellus mauris a. Eros in cursus turpis massa tincidunt dui ut ornare lectus. Tellus at urna condimentum mattis pellentesque id nibh tortor id. Amet nisl purus in mollis nunc.</p></div>
//
//                                    </div>
//
//                                    <div class="crnrstn_documentation_dyn_content_module_bg">
//                                        <div class="crnrstn_interact_ui_r_stone_pillar">' . $this->oCRNRSTN->return_system_image('R_STONE_GIANT_PILLAR', '', 1640, NULL, NULL, NULL, NULL, CRNRSTN_UI_IMG_HTML_WRAPPED) . '</div>
//                                    </div>
//
//                                    <div class="crnrstn_hidden_void">
//                                        <div class="crnrstn_documentation_dyn_content_description"><p>Risus nullam eget felis eget nunc lobortis mattis aliquam faucibus. Nibh tortor id aliquet lectus proin nibh. In hac habitasse platea dictumst quisque sagittis purus sit amet. Sit amet volutpat consequat mauris nunc congue. Dui nunc mattis enim ut tellus elementum sagittis vitae et. Tristique et egestas quis ipsum suspendisse ultrices gravida. Rhoncus urna neque viverra justo nec. Eget nullam non nisi est sit amet facilisis magna etiam. Luctus accumsan tortor posuere ac ut. Purus viverra accumsan in nisl. Nunc congue nisi vitae suscipit tellus mauris a. Eros in cursus turpis massa tincidunt dui ut ornare lectus. Tellus at urna condimentum mattis pellentesque id nibh tortor id. Amet nisl purus in mollis nunc.</p></div>
//                                    </div>
//
//                                </div>
//
//                            </div>
//
//                        </div>
//                    </div>
//                </div>
//
//                <div class="crnrstn_documentation_dyn_content_module_wrap_s3">
//
//                    <div class="crnrstn_documentation_dyn_content_module_border_rel">
//                        <div class="crnrstn_documentation_dyn_content_module_border">
//                            <div class="crnrstn_hidden_void">
//
//                                <div class="crnrstn_documentation_dyn_content_description"><p>Scelerisque eleifend donec pretium vulputate sapien nec sagittis aliquam malesuada. At augue eget arcu dictum. Lorem ipsum dolor sit amet consectetur adipiscing elit duis tristique. Donec enim diam vulputate ut pharetra sit amet. Pulvinar neque laoreet suspendisse interdum. Dolor sed viverra ipsum nunc. Nisl rhoncus mattis rhoncus urna neque viverra justo nec ultrices. Lectus mauris ultrices eros in cursus turpis massa. Nec tincidunt praesent semper feugiat nibh sed pulvinar proin gravida. Faucibus scelerisque eleifend donec pretium vulputate sapien nec. Viverra suspendisse potenti nullam ac tortor vitae purus faucibus ornare. Consectetur adipiscing elit ut aliquam purus sit.</p></div>
//
//                            </div>
//                        </div>
//                    </div>
//
//                    <div class="crnrstn_documentation_dyn_content_module_wrap_s2_outter">
//                        <div class="crnrstn_documentation_dyn_content_module_wrap_s2_inner">
//
//                            <div class="crnrstn_documentation_dyn_content_module_bg_rel">
//
//                                <div class="crnrstn_documentation_dyn_content_module_wrap_s1_rel">
//
//                                    <div class="crnrstn_documentation_dyn_content_module_wrap_s1">
//
//                                        <div class="crnrstn_documentation_dyn_content_description"><p>Scelerisque eleifend donec pretium vulputate sapien nec sagittis aliquam malesuada. At augue eget arcu dictum. Lorem ipsum dolor sit amet consectetur adipiscing elit duis tristique. Donec enim diam vulputate ut pharetra sit amet. Pulvinar neque laoreet suspendisse interdum. Dolor sed viverra ipsum nunc. Nisl rhoncus mattis rhoncus urna neque viverra justo nec ultrices. Lectus mauris ultrices eros in cursus turpis massa. Nec tincidunt praesent semper feugiat nibh sed pulvinar proin gravida. Faucibus scelerisque eleifend donec pretium vulputate sapien nec. Viverra suspendisse potenti nullam ac tortor vitae purus faucibus ornare. Consectetur adipiscing elit ut aliquam purus sit.</p></div>
//
//                                    </div>
//
//                                    <div class="crnrstn_documentation_dyn_content_module_bg"></div>
//
//                                    <div class="crnrstn_hidden_void">
//
//                                        <div class="crnrstn_documentation_dyn_content_description"><p>Scelerisque eleifend donec pretium vulputate sapien nec sagittis aliquam malesuada. At augue eget arcu dictum. Lorem ipsum dolor sit amet consectetur adipiscing elit duis tristique. Donec enim diam vulputate ut pharetra sit amet. Pulvinar neque laoreet suspendisse interdum. Dolor sed viverra ipsum nunc. Nisl rhoncus mattis rhoncus urna neque viverra justo nec ultrices. Lectus mauris ultrices eros in cursus turpis massa. Nec tincidunt praesent semper feugiat nibh sed pulvinar proin gravida. Faucibus scelerisque eleifend donec pretium vulputate sapien nec. Viverra suspendisse potenti nullam ac tortor vitae purus faucibus ornare. Consectetur adipiscing elit ut aliquam purus sit.</p></div>
//
//                                    </div>
//
//                                </div>
//
//                            </div>
//
//                        </div>
//                    </div>
//                </div>
//
//                <div class="crnrstn_cb"></div>
//                <div id="crnrstn_interact_ui_documentation_j5_wolf_pup" class="crnrstn_interact_ui_documentation_j5_wolf_pup">
//                    <div class="crnrstn_j5_wolf_pup_inner_wrap">
//                        ' . $this->oCRNRSTN->return_creative('J5_WOLF_PUP_RAND', CRNRSTN_UI_IMG_HTML_WRAPPED) . '
//                    </div>
//                </div>
//                <div class="crnrstn_cb"></div>
//            </div>';
//
//
//                //return $html_out;
//
//                //require($tmp_path_directory . $tmp_system_directory . '/common/inc/search/search.inc.php');
//
//                //$html_out .= '<div class="cb"></div>';

                //
                // DESKTOP EXPERIENCE

                //
                // THE R
                $tmp_html_the_r = '<div class="crnrstn_documentation_r_icon_shell">
                                        <div class="crnrstn_documentation_r_icon_rel">
                                            <div class="crnrstn_documentation_r_icon">' . $this->oCRNRSTN->return_system_image('CRNRSTN_R_MD', 30, 40, NULL, NULL, NULL, NULL, CRNRSTN_UI_IMG_HTML_WRAPPED) . '</div>
                                        </div>
                                    </div>';

                //
                // TOP LINK
                $tmp_html_top_link = '<div class="crnrstn_documentation_lnk_top_rel">
                                        <div class="crnrstn_documentation_lnk_top">
                                            <a href="#" onclick="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'scrolltop\', this);" rel="crnrstn_top_' . $this->oCRNRSTN->session_salt() . '">' . $this->oCRNRSTN->multi_lang_content_return('DOCUMENTATION_MODULE_TOP_TEXT') . '</a>
                                        </div>
                                    </div>';

                $html_out = '<a name="crnrstn_top_' . $this->oCRNRSTN->session_salt() . '"></a>
            <div id="crnrstn_documentation_dyn_content_shell" class="crnrstn_documentation_dyn_content_shell">';

                //
                // LOOP THROUGH CONTENT ARRAY
                $tmp_page_element_cnt = sizeof($this->content_load_sequence_ARRAY);

                for($i = 0; $i < $tmp_page_element_cnt; $i++){

                    //
                    // FOR EACH PAGE ELEMENT IN SEQUENCE OF CONSTRUCTION.
                    foreach($this->page_content_ARRAY[$this->page_serial][$this->content_load_sequence_ARRAY[$i]] as $key => $val){

                        switch($key){
                            case 'PAGE_TITLE':

                                $html_out .= '<div class="crnrstn_documentation_dyn_content_module_wrap_s3">
                
                    <div class="crnrstn_documentation_dyn_content_module_border_rel">
                        <div class="crnrstn_documentation_dyn_content_module_border">
                            <div class="crnrstn_hidden_void">
                                <div class="crnrstn_documentation_dyn_content_title"><h1>' . $val['PAGE_TITLE'] . '</h1></div>
                                <div class="crnrstn_documentation_dyn_content_description"><p>' . $val['PAGE_DESCRIPTION'] . '</p></div>
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="crnrstn_documentation_dyn_content_module_wrap_s2_outter">
                        <div class="crnrstn_documentation_dyn_content_module_wrap_s2_inner">
                        
                            <div class="crnrstn_documentation_dyn_content_module_bg_rel">
                                    
                                <div class="crnrstn_documentation_dyn_content_module_wrap_s1_rel">
                               
                                    <div class="crnrstn_documentation_dyn_content_module_wrap_s1">
                            
                                        <div class="crnrstn_documentation_dyn_content_title"><h1>' . $val['PAGE_TITLE'] . '</h1></div>
                                        <div class="crnrstn_documentation_dyn_content_description"><p>' . $val['PAGE_DESCRIPTION'] . '</p></div>
                                        
                                    </div>
                                    
                                    <div class="crnrstn_documentation_dyn_content_module_bg"></div>
                                
                                    <div class="crnrstn_hidden_void">
                                        <div class="crnrstn_documentation_dyn_content_title"><h1>' . $val['PAGE_TITLE'] . '</h1></div>
                                        <div class="crnrstn_documentation_dyn_content_description"><p>' . $val['PAGE_DESCRIPTION'] . '</p></div>
                                    
                                    </div>
                                    
                                </div>
                            
                            </div>
                            
                        </div>
                    </div>
                </div>';

                            break;
                            case 'NOTE':

                                $html_out .= '<div class="crnrstn_documentation_dyn_content_module_wrap_s3">
                
                    <div class="crnrstn_documentation_dyn_content_module_border_rel">
                        <div class="crnrstn_documentation_dyn_content_module_border">
                            <div class="crnrstn_hidden_void">
                                ' . $tmp_html_top_link . '
                                <div class="crnrstn_documentation_dyn_content_note_copy"><p>' . $val['NOTE_COPY'] . '</p></div>
    
                            </div>
                        </div>
                    </div>
                    
                    <div class="crnrstn_documentation_dyn_content_module_wrap_s2_outter">
                        <div class="crnrstn_documentation_dyn_content_module_wrap_s2_inner">
                        
                            <div class="crnrstn_documentation_dyn_content_module_bg_rel">
                                    
                                <div class="crnrstn_documentation_dyn_content_module_wrap_s1_rel">
                               
                                    <div class="crnrstn_documentation_dyn_content_module_wrap_s1">
                                        ' . $tmp_html_top_link . '
                                        <div class="crnrstn_documentation_dyn_content_note_copy"><p>' . $val['NOTE_COPY'] . '</p></div>
                            
                                    </div>
                                    
                                    <div class="crnrstn_documentation_dyn_content_module_bg">
                                        <div class="crnrstn_interact_ui_bg_title_note">' . $this->oCRNRSTN->multi_lang_content_return('DOCUMENTATION_BACKGROUND_COPY_NOTE') . '</div>
                                        <div class="crnrstn_interact_ui_r_stone_pillar">' . $this->oCRNRSTN->return_system_image('R_STONE_PILLAR', '', 160, NULL, NULL, NULL, NULL, CRNRSTN_UI_IMG_HTML_WRAPPED) . '</div>
                                        
                                    </div>
                                    
                                    <div class="crnrstn_hidden_void">
                                        ' . $tmp_html_top_link . '
                                        <div class="crnrstn_documentation_dyn_content_note_copy"><p>' . $val['NOTE_COPY'] . '</p></div>
                                    </div>
                                
                                </div>
                            
                            </div>
                            
                        </div>
                    </div>
                </div>';

                            break;
                            case 'TECH_SPECS':

                                $tmp_spec_li = '';
                                $tmp_spec_size = sizeof($val);
                                for($ii = 0; $ii < $tmp_spec_size; $ii++){

                                    if($ii == $tmp_spec_size - 1){

                                        $tmp_spec_li .= '<li style="padding-bottom: 0;">' . $val[$ii] . '</li>';

                                    }else{

                                        $tmp_spec_li .= '<li>' . $val[$ii] . '</li>';

                                    }

                                }

                                $html_out .= '<div class="crnrstn_documentation_dyn_content_module_wrap_s3">
                
                    <div class="crnrstn_documentation_dyn_content_module_border_rel">
                        <div class="crnrstn_documentation_dyn_content_module_border">
                            <div class="crnrstn_hidden_void">
                                ' . $tmp_html_top_link . '
                                <div class="crnrstn_documentation_dyn_content_tech_specs_wrapper">
                                    <ul class="crnrstn_documentation_dyn_content_tech_specs">
                                        ' . $tmp_spec_li . '
                                    </ul>
                                </div>
    
                            </div>
                        </div>
                    </div>
                    
                    <div class="crnrstn_documentation_dyn_content_module_wrap_s2_outter">
                        <div class="crnrstn_documentation_dyn_content_module_wrap_s2_inner">
                        
                            <div class="crnrstn_documentation_dyn_content_module_bg_rel">

                                <div class="crnrstn_documentation_dyn_content_module_wrap_s1_rel">

                                    <div class="crnrstn_documentation_dyn_content_module_wrap_s1">
                                        ' . $tmp_html_top_link . '
                                        <div class="crnrstn_documentation_dyn_content_tech_specs_wrapper">
                                            <ul class="crnrstn_documentation_dyn_content_tech_specs">
                                                ' . $tmp_spec_li . '
                                            </ul>
                                        </div>

                                    </div>
                                    
                                    <div class="crnrstn_documentation_dyn_content_module_bg">
                                        <div class="crnrstn_interact_ui_bg_title_tech_spec">' . $this->oCRNRSTN->multi_lang_content_return('DOCUMENTATION_BACKGROUND_COPY_TECH_SPECS') . '</div>

                                    </div>
                                    
                                    <div class="crnrstn_hidden_void">
                                        ' . $tmp_html_top_link . '
                                        <div class="crnrstn_documentation_dyn_content_tech_specs_wrapper">
                                            <ul class="crnrstn_documentation_dyn_content_tech_specs">
                                                 ' . $tmp_spec_li . '
                                            </ul>
                                        </div>

                                    </div>
                                    
                                </div>
                            
                            </div>
                            
                        </div>
                    </div>
                </div>';

                            break;
                            case 'GENERAL_COPY_NAKED':

                                $html_out .= '<div class="crnrstn_documentation_dyn_content_module_wrap_s3">
                
                    <div class="crnrstn_documentation_dyn_content_module_border_rel">
                        <div class="crnrstn_documentation_dyn_content_module_border">
                            <div class="crnrstn_hidden_void">
                                ' . $tmp_html_top_link . '
                                <div class="crnrstn_documentation_dyn_content_description"><p>' . $val . '</p></div>
    
                            </div>
                        </div>
                    </div>
                    
                    <div class="crnrstn_documentation_dyn_content_module_wrap_s2_outter">
                        <div class="crnrstn_documentation_dyn_content_module_wrap_s2_inner">
                        
                            <div class="crnrstn_documentation_dyn_content_module_bg_rel">
                                    
                                <div class="crnrstn_documentation_dyn_content_module_wrap_s1_rel">
                               
                                    <div class="crnrstn_documentation_dyn_content_module_wrap_s1">
                                        ' . $tmp_html_top_link . '
                                        <div class="crnrstn_documentation_dyn_content_description"><p>' . $val . '</p></div>
                            
                                    </div>
                                    
                                    <div class="crnrstn_documentation_dyn_content_module_bg"></div>
                                    
                                    <div class="crnrstn_hidden_void">
                                        ' . $tmp_html_top_link . '
                                        <div class="crnrstn_documentation_dyn_content_description"><p>' . $val . '</p></div>
                                    
                                    </div>
                                
                                </div>
                            
                            </div>
                            
                        </div>
                    </div>
                </div>';

                            break;
                            case 'GENERAL_COPY_R_STONE':

                                $html_out .= '<div class="crnrstn_documentation_dyn_content_module_wrap_s3">
                
                    <div class="crnrstn_documentation_dyn_content_module_border_rel">
                        <div class="crnrstn_documentation_dyn_content_module_border">
                            <div class="crnrstn_hidden_void">
                                ' . $tmp_html_top_link . '
                                <div class="crnrstn_documentation_dyn_content_description">' . $val . '</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="crnrstn_documentation_dyn_content_module_wrap_s2_outter">
                        <div class="crnrstn_documentation_dyn_content_module_wrap_s2_inner">
                        
                            <div class="crnrstn_documentation_dyn_content_module_bg_rel">
                                    
                                <div class="crnrstn_documentation_dyn_content_module_wrap_s1_rel">
                               
                                    <div class="crnrstn_documentation_dyn_content_module_wrap_s1">
                                        ' . $tmp_html_top_link . '
                                        <div class="crnrstn_documentation_dyn_content_description">' . $val . '</div>
                            
                                    </div>
                                    
                                    <div class="crnrstn_documentation_dyn_content_module_bg">
                                        <div class="crnrstn_interact_ui_r_stone_pillar">' . $this->oCRNRSTN->return_system_image('R_STONE_GIANT_PILLAR', '', 1640, NULL, NULL, NULL, NULL, CRNRSTN_UI_IMG_HTML_WRAPPED) . '</div>
                                    </div>
                                    
                                    <div class="crnrstn_hidden_void">
                                        ' . $tmp_html_top_link . '
                                        <div class="crnrstn_documentation_dyn_content_description">' . $val . '</div>
                                        
                                    </div>
                                
                                </div>
                            
                            </div>
                            
                        </div>
                    </div>
                </div>';

                            break;
                            case 'METHOD_DEFINITION':

                                $html_out .= '<div class="crnrstn_documentation_dyn_content_module_wrap_s3">
                
                    <div class="crnrstn_documentation_dyn_content_module_border_rel">
                        <div class="crnrstn_documentation_dyn_content_module_border">
                            <div class="crnrstn_hidden_void">
                                ' . $tmp_html_top_link . '
                                <div class="crnrstn_documentation_dyn_content_title"><h3>' . $this->oCRNRSTN->multi_lang_content_return('DOCUMENTATION_TITLE_METHOD_DEFINITION') . '</h3></div>
                                <div class="crnrstn_documentation_dyn_content_method_definition"><p>' . $val . '</p></div>
                                ' .  $tmp_html_the_r . '
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="crnrstn_documentation_dyn_content_module_wrap_s2_outter">
                        <div class="crnrstn_documentation_dyn_content_module_wrap_s2_inner">
                        
                            <div class="crnrstn_documentation_dyn_content_module_bg_rel">
                                    
                                <div class="crnrstn_documentation_dyn_content_module_wrap_s1_rel">
                               
                                    <div class="crnrstn_documentation_dyn_content_module_wrap_s1">
                                        ' . $tmp_html_top_link . '
                                        <div class="crnrstn_documentation_dyn_content_title"><h3>' . $this->oCRNRSTN->multi_lang_content_return('DOCUMENTATION_TITLE_METHOD_DEFINITION') . '</h3></div>
                                        <div class="crnrstn_documentation_dyn_content_method_definition"><p>' . $val . '</p></div>
                                        ' . $tmp_html_the_r . '
                                        
                                    </div>
                                    
                                    <div class="crnrstn_documentation_dyn_content_module_bg"></div>
                                
                                    <div class="crnrstn_hidden_void">
                                        ' . $tmp_html_top_link . '
                                        <div class="crnrstn_documentation_dyn_content_title"><h3>' . $this->oCRNRSTN->multi_lang_content_return('DOCUMENTATION_TITLE_METHOD_DEFINITION') . '</h3></div>
                                        <div class="crnrstn_documentation_dyn_content_method_definition"><p>' . $val . '</p></div>
                                        ' . $tmp_html_the_r . '
                                        
                                    </div>
                                    
                                </div>
                            
                            </div>
                            
                        </div>
                    </div>
                </div>';

                            break;
                            case 'PARAMETER_DEFINITION':

                                $tmp_definition_str = '';
                                foreach($val as $tmp_key => $tmp_val){

                                    if(!isset($tmp_val['param_datatype'])){

                                        $tmp_val['param_datatype'] = '';

                                    }else{

                                        $tmp_val['param_datatype'] .= '&nbsp;&nbsp;';

                                    }

                                    if($tmp_val['param_required']){

                                        $tmp_definition_str .= '
                                        <div class="crnrstn_documentation_param_shell">
                                            <div class="crnrstn_documentation_param_name_shell">
                                                <span class="crnrstn_documentation_param_name">' . $tmp_val['param_name'] . '</span>&nbsp;<span class="crnrstn_documentation_param_require_required">(Required)</span>
                                            </div>
                                            <div class="crnrstn_documentation_param_definition_shell">
                                                <p>' . $tmp_val['param_definition'] . '</p>
                                            </div>
                                        </div>';

                                    }else{

                                        $tmp_definition_str .= '
                                        <div class="crnrstn_documentation_param_shell">
                                            <div class="crnrstn_documentation_param_name_shell">
                                                <span class="crnrstn_documentation_param_name">' . $tmp_val['param_name'] . '</span>&nbsp;<span class="crnrstn_documentation_param_require_optional">(Optional)</span>
                                            </div>
                                            <div class="crnrstn_documentation_param_definition_shell">
                                                <p>' . $tmp_val['param_definition'] . '</p>
                                            </div>
                                        </div>';

                                    }

                                }

                                $html_out .= '<div class="crnrstn_documentation_dyn_content_module_wrap_s3">
                
                    <div class="crnrstn_documentation_dyn_content_module_border_rel">
                        <div class="crnrstn_documentation_dyn_content_module_border">
                            <div class="crnrstn_hidden_void">
                                ' . $tmp_html_top_link . '
                                <div class="crnrstn_documentation_dyn_content_title"><h3>' . $this->oCRNRSTN->multi_lang_content_return('DOCUMENTATION_TITLE_PARAMETER_DEFINITION') . '</h3></div>
                                <div class="crnrstn_documentation_dyn_content_description">' . $tmp_definition_str . '</div>
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="crnrstn_documentation_dyn_content_module_wrap_s2_outter">
                        <div class="crnrstn_documentation_dyn_content_module_wrap_s2_inner">
                        
                            <div class="crnrstn_documentation_dyn_content_module_bg_rel">
                                    
                                <div class="crnrstn_documentation_dyn_content_module_wrap_s1_rel">
                               
                                    <div class="crnrstn_documentation_dyn_content_module_wrap_s1">
                                        ' . $tmp_html_top_link . '
                                        <div class="crnrstn_documentation_dyn_content_title"><h3>' . $this->oCRNRSTN->multi_lang_content_return('DOCUMENTATION_TITLE_PARAMETER_DEFINITION') . '</h3></div>
                                        <div class="crnrstn_documentation_dyn_content_description">' . $tmp_definition_str . '</div>

                                    </div>
                                    
                                    <div class="crnrstn_documentation_dyn_content_module_bg"></div>
                                
                                    <div class="crnrstn_hidden_void">
                                        ' . $tmp_html_top_link . '
                                        <div class="crnrstn_documentation_dyn_content_title"><h3>' . $this->oCRNRSTN->multi_lang_content_return('DOCUMENTATION_TITLE_PARAMETER_DEFINITION') . '</h3></div>
                                        <div class="crnrstn_documentation_dyn_content_description">' . $tmp_definition_str . '</div>
                                    
                                    </div>
                                    
                                </div>
                            
                            </div>
                            
                        </div>
                    </div>
                </div>';

                            break;
                            case 'RETURN_VALUE':

                                $html_out .= '<div class="crnrstn_documentation_dyn_content_module_wrap_s3">
                
                    <div class="crnrstn_documentation_dyn_content_module_border_rel">
                        <div class="crnrstn_documentation_dyn_content_module_border">
                            <div class="crnrstn_hidden_void">
                                ' . $tmp_html_top_link . '
                                <div class="crnrstn_documentation_dyn_content_title"><h3>' . $this->oCRNRSTN->multi_lang_content_return('DOCUMENTATION_TITLE_RETURN_VALUE') . '</h3></div>
                                <div class="crnrstn_documentation_dyn_content_description"><p>' . $val . '</p></div>
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="crnrstn_documentation_dyn_content_module_wrap_s2_outter">
                        <div class="crnrstn_documentation_dyn_content_module_wrap_s2_inner">
                        
                            <div class="crnrstn_documentation_dyn_content_module_bg_rel">
                                    
                                <div class="crnrstn_documentation_dyn_content_module_wrap_s1_rel">
                               
                                    <div class="crnrstn_documentation_dyn_content_module_wrap_s1">
                                        ' . $tmp_html_top_link . '
                                        <div class="crnrstn_documentation_dyn_content_title"><h3>' . $this->oCRNRSTN->multi_lang_content_return('DOCUMENTATION_TITLE_RETURN_VALUE') . '</h3></div>
                                        <div class="crnrstn_documentation_dyn_content_description"><p>' . $val . '</p></div>

                                    </div>
                                    
                                    <div class="crnrstn_documentation_dyn_content_module_bg"></div>
                                
                                    <div class="crnrstn_hidden_void">
                                        ' . $tmp_html_top_link . '
                                        <div class="crnrstn_documentation_dyn_content_title"><h3>' . $this->oCRNRSTN->multi_lang_content_return('DOCUMENTATION_TITLE_RETURN_VALUE') . '</h3></div>
                                        <div class="crnrstn_documentation_dyn_content_description"><p>' . $val . '</p></div>
                                    
                                    </div>
                                    
                                </div>
                            
                            </div>
                            
                        </div>
                    </div>
                </div>';

                            break;
                            case 'RELATED_METHODS':

                                $tmp_related_methods = '';
                                $tmp_related_methods_size = sizeof($val);
                                for($ii = 0; $ii < $tmp_related_methods_size; $ii++){

                                    if($ii == $tmp_related_methods_size - 1){

                                        $tmp_related_methods .= '<div class="crnrstn_documentation_related_method" style="padding-bottom: 0;"><a href="#" onclick="oCRNRSTN_JS.related_link_text_click(\'' . $val[$ii] . '\');">' . $val[$ii] . '</a></div>
                    ';

                                    }else{

                                        $tmp_related_methods .= '<div class="crnrstn_documentation_related_method"><a href="#" onclick="oCRNRSTN_JS.related_link_text_click(\'' . $val[$ii] . '\');">' . $val[$ii] . '</a></div>
                    ';

                                    }

                                }

                                $html_out .= '<div class="crnrstn_documentation_dyn_content_module_wrap_s3">
                
                    <div class="crnrstn_documentation_dyn_content_module_border_rel">
                        <div class="crnrstn_documentation_dyn_content_module_border">
                            <div class="crnrstn_hidden_void">
                                ' . $tmp_html_top_link . '
                                <div class="crnrstn_documentation_dyn_content_title"><h3>' . $this->oCRNRSTN->multi_lang_content_return('DOCUMENTATION_TITLE_RELATED_METHODS') . '</h3></div>
                                <div class="crnrstn_documentation_dyn_content_related_methods">' . $tmp_related_methods . '</div>
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="crnrstn_documentation_dyn_content_module_wrap_s2_outter">
                        <div class="crnrstn_documentation_dyn_content_module_wrap_s2_inner">
                        
                            <div class="crnrstn_documentation_dyn_content_module_bg_rel">
                                    
                                <div class="crnrstn_documentation_dyn_content_module_wrap_s1_rel">
                               
                                    <div class="crnrstn_documentation_dyn_content_module_wrap_s1">
                                        ' . $tmp_html_top_link . '
                                        <div class="crnrstn_documentation_dyn_content_title"><h3>' . $this->oCRNRSTN->multi_lang_content_return('DOCUMENTATION_TITLE_RELATED_METHODS') . '</h3></div>
                                        <div class="crnrstn_documentation_dyn_content_related_methods">' . $tmp_related_methods . '</div>

                                    </div>
                                    
                                    <div class="crnrstn_documentation_dyn_content_module_bg"></div>
                                
                                    <div class="crnrstn_hidden_void">
                                        ' . $tmp_html_top_link . '
                                        <div class="crnrstn_documentation_dyn_content_title"><h3>' . $this->oCRNRSTN->multi_lang_content_return('DOCUMENTATION_TITLE_RELATED_METHODS') . '</h3></div>
                                        <div class="crnrstn_documentation_dyn_content_related_methods">' . $tmp_related_methods . '</div>
                                    
                                    </div>
                                    
                                </div>
                            
                            </div>
                            
                        </div>
                    </div>
                </div>';

                            break;
                            case 'EXAMPLE_CONTENT':

                                //
                                // EXAMPLE OUTPUT
                                $tmp_example_test_out = '';
                                if($val['exec_file'] != ''){

                                    $tmp_example_test_out .= '<div class="crnrstn_documentation_dyn_content_title"><h2>' . $val['title_string'] . ' Output</h2></div>';
                                    $tmp_example_test_out .= '<div class="crnrstn_documentation_example_output">' . $this->retrieve_code_example_output_html($val['exec_file']) . '</div>';

                                }

                                if(isset($val['integrated_title_string'])){

                                    if(strlen($val['integrated_title_string']) > 0){

                                        $tmp_example_test = $this->oCRNRSTN->print_r_str($this->retrieve_code_example_html($val['pres_file']), $val['integrated_title_string']);

                                    }else{

                                        $tmp_example_test = $this->oCRNRSTN->print_r_str($this->retrieve_code_example_html($val['pres_file']));

                                    }

                                }else{

                                    $tmp_example_test = $this->oCRNRSTN->print_r_str($this->retrieve_code_example_html($val['pres_file']));

                                }

                                $html_out .= '<div class="crnrstn_documentation_dyn_content_module_wrap_s3">
                
                    <div class="crnrstn_documentation_dyn_content_module_border_rel">
                        <div class="crnrstn_documentation_dyn_content_module_border">
                            <div class="crnrstn_hidden_void">
                                <div class="crnrstn_documentation_dyn_content_title"><h2>' . $val['title_string'] . '</h2></div>
                                <div class="crnrstn_documentation_dyn_content_example">' . $tmp_example_test . '</div>
                                <div class="crnrstn_documentation_dyn_content_example">' . $tmp_example_test_out . '</div>
                            </div>
                        </div>
                    </div>
                
                    <div class="crnrstn_documentation_dyn_content_module_wrap_s2_outter">
                        <div class="crnrstn_documentation_dyn_content_module_wrap_s2_inner">
                        
                            <div class="crnrstn_documentation_dyn_content_module_bg_rel">
                                    
                                <div class="crnrstn_documentation_dyn_content_module_wrap_s1_rel">
                               
                                    <div class="crnrstn_documentation_dyn_content_module_wrap_s1">
                                        <div class="crnrstn_documentation_dyn_content_title"><h2>' . $val['title_string'] . '</h2></div>
                                        <div class="crnrstn_documentation_dyn_content_example">' . $tmp_example_test . '</div>
                                        ' . $tmp_example_test_out . '
                            
                                    </div>
                                    
                                    <div class="crnrstn_documentation_dyn_content_module_bg"></div>
                                    
                                    <div class="crnrstn_hidden_void">
                                        <div class="crnrstn_documentation_dyn_content_title"><h2>' . $val['title_string'] . '</h2></div>
                                        <div class="crnrstn_documentation_dyn_content_example">' . $tmp_example_test . '</div>
                                        ' . $tmp_example_test_out . '
                                        
                                    </div>
                                
                                </div>
                            
                            </div>
                            
                        </div>
                    </div>
                </div>';

                            break;
                            case 'PAGE_STATISTICS':

                                //
                                // FOR NOW, HERE IS A BASIC DEMO OF WHAT A PAGE REPORT COULD CONTAIN. WOULD BE NICE TO
                                // DRIVE THIS WITH THE SSDTLA FOR DATA SUCH AS RUNTIME.
                                /*
                                Response returned in 0.0345 seconds.
                                [2022-11-11 09:13:51.693264] [rtime 0.143339 secs]

                                CLIENT ::
                                Page size: 400 KiB
                                Referer: http://172.16.225.139/lightsaber.crnrstn.evifweb.com/
                                Device type: DESKTOP
                                Accept-Language:

                                SERVER ::
                                Bytes stored: 4.11816 KiB
                                Bytes hashed: 91.18848 KiB
                                Bytes encrypted: 91.18848 KiB
                                Name: 172.16.225.139
                                Address: 172.16.225.139
                                SSL enabled: false

                                */

//                                switch($val) {
//                                    case 'STANDARD_REPORT':
//
//                                        $tmp_hashed_html = '';
//                                        $tmp_hashed_html_out = '';
//                                        $tmp_SSL_ENABLED = 'FALSE';
//                                        if($this->oCRNRSTN->is_SSL){
//
//                                            $tmp_SSL_ENABLED = 'TRUE';
//
//                                        }
//
//                                        /*
//                                        $tmp_ARRAY[$i]['locale_identifier>'] = $oCRNRSTN_LANG_MGR->return_lang_pref_data('locale_identifier', $i);
//                                        $tmp_ARRAY[$i]['region_variant>'] = $oCRNRSTN_LANG_MGR->return_lang_pref_data('region_variant', $i);
//                                        $tmp_ARRAY[$i]['factor_weighting>'] = $oCRNRSTN_LANG_MGR->return_lang_pref_data('factor_weighting', $i);
//                                        $tmp_ARRAY[$i]['iso_language_nomination>'] = $oCRNRSTN_LANG_MGR->return_lang_pref_data('iso_language_nomination', $i);
//                                        $tmp_ARRAY[$i]['native_nomination>'] = $oCRNRSTN_LANG_MGR->return_lang_pref_data('native_nomination', $i);
//                                        $tmp_ARRAY[$i]['iso_639-1_2002>'] = $oCRNRSTN_LANG_MGR->return_lang_pref_data('iso_639-1_2002', $i);
//                                        $tmp_ARRAY[$i]['iso_639-2_1998>'] = $oCRNRSTN_LANG_MGR->return_lang_pref_data('iso_639-2_1998', $i);
//                                        $tmp_ARRAY[$i]['iso_639-3_2007>'] = $oCRNRSTN_LANG_MGR->return_lang_pref_data('iso_639-3_2007', $i);
//                                        $tmp_ARRAY[$i]['locale_identifier>'] = $oCRNRSTN_LANG_MGR->return_lang_pref_data('locale_identifier', $i);
//
//                                        <language>
//                                            <language_preference>
//                                                <request_id timestamp="2022-11-11 14:21:01.974633">xzPlvuvDL2</request_id>
//                                                <request_referer>http://172.16.225.139/lightsaber.crnrstn.evifweb.com/</request_referer>
//                                                <locale_identifier>en</locale_identifier>
//                                                <region_variant>US</region_variant>
//                                                <factor_weighting>0.9</factor_weighting>
//                                                <iso_language_nomination>English</iso_language_nomination>
//                                                <native_nomination><![CDATA[English]]></native_nomination>
//                                                <iso_639-1_2002>en</iso_639-1_2002>
//                                                <iso_639-2_1998>eng</iso_639-2_1998>
//                                                <iso_639-3_2007>eng</iso_639-3_2007>
//                                            </language_preference>
//                                            <language_preference>
//                                                <request_id timestamp="2022-11-11 14:21:01.974841">0McMrF9QOg</request_id>
//                                                <request_referer>http://172.16.225.139/lightsaber.crnrstn.evifweb.com/</request_referer>
//                                                <locale_identifier>zh</locale_identifier>
//                                                <region_variant>CN</region_variant>
//                                                <factor_weighting>0.8</factor_weighting>
//                                                <iso_language_nomination>Chinese</iso_language_nomination>
//                                                <native_nomination><![CDATA[中文 (Zhōngwén), 汉语, 漢語]]></native_nomination>
//                                                <iso_639-1_2002>zh</iso_639-1_2002>
//                                                <iso_639-2_1998>zho</iso_639-2_1998>
//                                                <iso_639-3_2007>zho</iso_639-3_2007>
//                                            </language_preference>
//                                            <language_preference>
//                                                <request_id timestamp="2022-11-11 14:21:01.974927">3oU3N6Eyiy</request_id>
//                                                <request_referer>http://172.16.225.139/lightsaber.crnrstn.evifweb.com/</request_referer>
//                                                <locale_identifier>zh</locale_identifier>
//                                                <region_variant></region_variant>
//                                                <factor_weighting>0.7</factor_weighting>
//                                                <iso_language_nomination>Chinese</iso_language_nomination>
//                                                <native_nomination><![CDATA[中文 (Zhōngwén), 汉语, 漢語]]></native_nomination>
//                                                <iso_639-1_2002>zh</iso_639-1_2002>
//                                                <iso_639-2_1998>zho</iso_639-2_1998>
//                                                <iso_639-3_2007>zho</iso_639-3_2007>
//                                            </language_preference>
//                                        </language>
//
//                                        */
//
//                                        $tmp_lang_ARRAY = $this->oCRNRSTN->return_client_language_preference_profile();
//                                        $tmp_lang_cnt = count($tmp_lang_ARRAY);
//
//                                        $tmp_lang_report = 'Accept-Language: ';
////                                        if($tmp_lang_cnt > 0){
////
////                                            $tmp_lang_report = 'Accept-Language: ';
////
////                                        }
//
//                                        //
//                                        // BUILD LANGUAGE REPORT
//                                        for($ii = 0; $ii < $tmp_lang_cnt; $ii++){
//
//                                            $tmp_lang_report .= $tmp_lang_ARRAY[$ii]['native_nomination'] . '[' . $tmp_lang_ARRAY[$ii]['locale_identifier'] . '], ';
//
//                                        }
//
//                                        $tmp_lang_report = $this->oCRNRSTN->strrtrim($tmp_lang_report, ', ');
//                                        $tmp_lang_report .= '.';
//
//                                        //
//                                        // BYTES HASH REPORT
//                                        $tmp_total_bytes = 0;
//                                        foreach($this->oCRNRSTN->total_bytes_hashed_ARRAY as $algo => $bytes){
//
//                                            $tmp_star_char = '&nbsp;';
//                                            $tmp_total_bytes += $bytes;
//
//                                            if($algo == $this->oCRNRSTN->system_hash_algo()){
//
//                                                $tmp_star_char = '*';
//
//                                            }
//
//                                            $tmp_hashed_html .= '<div class="crnrstn_documentation_page_stats_hash_shell">';
//                                            $tmp_hashed_html .= '   <div class="crnrstn_documentation_page_stats_hash_algo">' . $tmp_star_char . $algo . ':</div>
//                                                                    <div class="crnrstn_documentation_page_stats_hash_algo_bytes">'. $this->oCRNRSTN->format_bytes($bytes) . '</div>';
//                                            $tmp_hashed_html .= '</div><div class="crnrstn_cb"></div>';
//
//                                        }
//
//                                        $tmp_hashed_html_out .= '<div class="crnrstn_documentation_page_stats_hash_shell">';
//                                        $tmp_hashed_html_out .= '<div class="crnrstn_documentation_page_stats_hash_total">Bytes <sup class="crnrstn_documentation_page_stats_sup">&dagger;</sup>hashed: ' . $this->oCRNRSTN->format_bytes($tmp_total_bytes, 5) . '</div>';
//                                        $tmp_hashed_html_out .= '</div>';
//
//                                        $tmp_hashed_html_out  .= $tmp_hashed_html;
//
//                                        $tmp_report = '<p style="margin-bottom:0;">Response returned in {CRNRSTN_DYNAMIC_CONTENT_MODULE::DOCUMENT_RESPONSE_TIME}.<br><br>
//
//CLIENT ::<br>
//Returned page size (in text data): {CRNRSTN_DYNAMIC_CONTENT_MODULE::DOCUMENT_PAGE_SIZE}.<br>
//Referer: ' . $_SERVER['HTTP_REFERER'] . '<br>
//Device type: ' . $this->oCRNRSTN->device_type() . '<br>
//Accept-Language: ' . $this->oCRNRSTN->return_client_header_value('Accept-Language') . '<br>
//' . $tmp_lang_report . '<br><br>
//
//SERVER ::<br>
//Bytes <sup class="crnrstn_documentation_page_stats_sup">&dagger;</sup>stored: ' . $this->oCRNRSTN->format_bytes($this->oCRNRSTN->return_total_bytes_stored(), 5) . '
//</p>
//' . $tmp_hashed_html_out . '
//<p style="margin-top:0;">
//Bytes <sup class="crnrstn_documentation_page_stats_sup">&dagger;</sup>encrypted: ' . $this->oCRNRSTN->format_bytes($this->oCRNRSTN->total_bytes_encrypted, 5) . '<br>
//Bytes <sup class="crnrstn_documentation_page_stats_sup">&dagger;</sup>decrypted: ' . $this->oCRNRSTN->format_bytes($this->oCRNRSTN->total_bytes_decrypted, 5) . '<br>
//Server name: ' . $_SERVER['SERVER_NAME'] . '<br>
//Server address: ' . $_SERVER['SERVER_ADDR'] . '<br>
//SSL enabled: ' . $tmp_SSL_ENABLED . '<br>
//Request time: ' . $this->oCRNRSTN->start_time() . '</p>
//
//<div class="crnrstn_cb_20"></div>
//<div class="crnrstn_documentation_page_stats_dagger_key_shell">
//    <div class="crnrstn_documentation_page_stats_dagger_key_dag">&dagger;</div>
//    <div class="crnrstn_documentation_page_stats_dagger_key_description"><p>A statistic reflecting server resource consumption and performance requirements related to returning the content for this request.</p></div>
//    <div class="crnrstn_cb"></div>
//
//</div>
//<div class="crnrstn_cb_10"></div>
//<div class="crnrstn_documentation_page_stats_dagger_key_shell">
//    <div class="crnrstn_documentation_page_stats_dagger_key_dag">*</div>
//    <div class="crnrstn_documentation_page_stats_dagger_key_description"><p>System default hashing algorithm.</p></div>
//    <div class="crnrstn_cb"></div>
//
//</div>
//<div class="crnrstn_cb_40"></div>
//<p>[' . $this->oCRNRSTN->return_micro_time() . '] [rtime ' . $this->oCRNRSTN->wall_time() . ' secs]</p>';
//
//                                    break;
//
//                                }

                                $tmp_report = $this->oCRNRSTN->return_report_module_out(CRNRSTN_REPORT_RESPONSE_RETURN);

                                $html_out .= '<div class="crnrstn_documentation_dyn_content_module_wrap_s3">
                
                    <div class="crnrstn_documentation_dyn_content_module_border_rel">
                        <div class="crnrstn_documentation_dyn_content_module_border">
                            <div class="crnrstn_hidden_void">
                                ' . $tmp_html_top_link . '
                                <div class="crnrstn_documentation_page_stats_content">' . $tmp_report . '</div>
                                ' . $tmp_html_the_r . '
                            </div>
                        </div>
                    </div>
                    
                    <div class="crnrstn_documentation_dyn_content_module_wrap_s2_outter">
                        <div class="crnrstn_documentation_dyn_content_module_wrap_s2_inner">
                        
                            <div class="crnrstn_documentation_dyn_content_module_bg_rel">
                                    
                                <div class="crnrstn_documentation_dyn_content_module_wrap_s1_rel">
                               
                                    <div class="crnrstn_documentation_dyn_content_module_wrap_s1">
                                        ' . $tmp_html_top_link . '
                                        <div class="crnrstn_documentation_page_stats_content">' . $tmp_report . '</div>
                                        ' . $tmp_html_the_r . '
                                    </div>
                                    
                                    <div class="crnrstn_documentation_dyn_content_module_bg"></div>
                                
                                    <div class="crnrstn_hidden_void">
                                        ' . $tmp_html_top_link . '
                                        <div class="crnrstn_documentation_page_stats_content">' . $tmp_report . '</div>
                                        ' . $tmp_html_the_r . '
                                    </div>
                                    
                                </div>
                            
                            </div>
                            
                        </div>
                    </div>
                </div>';

                            break;

                        }

                    }

                }

                $html_out .= '
                <div class="crnrstn_cb"></div>
                <div id="crnrstn_interact_ui_documentation_j5_wolf_pup" class="crnrstn_interact_ui_documentation_j5_wolf_pup">
                    <div id="crnrstn_interact_ui_documentation_j5_wolf_pup_inner_wrap" class="crnrstn_interact_ui_documentation_j5_wolf_pup_inner_wrap">
                        ' . $this->oCRNRSTN->return_creative('J5_WOLF_PUP_RAND', CRNRSTN_UI_IMG_HTML_WRAPPED) . '
                    </div>
                </div>
                <div class="crnrstn_cb"></div>
            </div>';

            break;

        }

        switch($channel){
            case 'index':

                $tmp_array_out = array();
                $tmp_array_out['page_title'] = $tmp_page_title;
                $tmp_array_out['page_content'] = $html_out;
                $tmp_array_out['page_result_display'] = $search_result;

                return $tmp_array_out;

            break;
            default:

                return $html_out;

            break;

        }

    }

    private function prep_page_index_content($str, $file = NULL){

	    if(isset($file)){

	        $filepath = $this->oCRNRSTN->get_resource("DOCUMENT_ROOT") . $this->oCRNRSTN->get_resource("DOCUMENT_ROOT_DIR") . $str;

            $str = file_get_contents($filepath, true);

        }else{

            $str = $this->oCRNRSTN->str_sanitize($str, 'index');
            $str = $str . ' ';

        }

	    return $str;

    }

    public function retrieve_code_example_html($filepath){

        $tmp_path_dir = $this->oCRNRSTN->get_resource('crnrstn_path_directory', 0, 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES');
        $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES');

        $filepath = $tmp_path_dir . DIRECTORY_SEPARATOR . $tmp_system_directory . $filepath;

        return file_get_contents($filepath);

    }

    public function retrieve_code_example_output_html($filepath){

        if($filepath != ''){

            $tmp_path_dir = $this->oCRNRSTN->get_resource('crnrstn_path_directory', 0, 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES');
            $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES');

            $filepath = $tmp_path_dir . DIRECTORY_SEPARATOR . $tmp_system_directory . $filepath;

            $tmp_html_out = '';

            $tmp_html_out .= '<div class="crnrstn_documentation_dyn_content_example">';

            if(is_file($filepath)){

                include($filepath);

            }

            $tmp_html_out .= '
    </div>';

            return $tmp_html_out;

        }else{

            return '';
        }

    }

    public function retrieve_code_example_line_num_html($filepath){

	    $tmp_html_out = '';

        //$lineHTML = implode(range(1, count(file($filepath))+0), '<br />');
        $lineHTML = implode('<br />', range(1, count(file($filepath)) + 0));
        $tmp_html_out .= '<div class="crnrstn_l_num">' . $lineHTML.'</div>';

        return $tmp_html_out;

    }

	public function __destruct() {
		
	}
}