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
#  CLASS :: crnrstn_bassdrive_integration_data
#  VERSION :: 1.00.0000
#  DATE :: October 2, 2021 @ 1234hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI ::
#  DESCRIPTION ::
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_bassdrive_integration_data {

    public $oUser;
    public $oUserEnvironment;
    public $dataBaseIntegration;

    public $bassdrive_stream_ojson;
    public $broadcast_nation;
    public $broadcast_locale;
    public $stream_info;
    public $bassdrive_stats;
    public $bassdrive_stats_conn;
    public $bassdrive_stats_throughput;
    public $bassdrive_stats_throughput_unit;
    public $bassdrive_stats_max_conn;

    public $stream_meta_ARRAY = array();
    public $stream_pattern_ARRAY = array();
    public $stream_key;
    public $stream_title;
    public $stream_has_social;
    public $stream_has_social_config_ARRAY = array();
    public $stream_social;
    public $sprite_serial;

    private static $social_lnk_cnt = 0;


    public function __construct($oUser, $oUserEnvironment, $dataBaseIntegration){

        $this->oUser = $oUser;
        $this->oUserEnvironment = $oUserEnvironment;
        $this->dataBaseIntegration = $dataBaseIntegration;

        $this->sprite_serial = filesize($this->oUser->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT').$this->oUser->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT_DIR').'/common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png').'.'.filemtime($this->oUser->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT').$this->oUser->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT_DIR').'/common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png').'.0';

    }

    public function reset_cache_ttl(){

        return $this->dataBaseIntegration->expire_ttl_bassdriveData($this, $this->oUserEnvironment, 'expire_ttl_bassdriveData');

    }

    public function load_data($broadcast_nation, $stream_info, $stream_social, $bassdrive_stats, $bassdrive_stats_conn, $bassdrive_stats_throughput, $bassdrive_stats_throughput_unit, $bassdrive_stats_max_conn){

        if($this->oUser->oCRNRSTN_USR->get_resource('BASSDRIVE_INTEGRATE')){

            $this->broadcast_nation = $broadcast_nation;
            $this->stream_info = $stream_info;
            $this->stream_social = $stream_social;
            $this->bassdrive_stats = $bassdrive_stats;
            $this->bassdrive_stats_conn = $bassdrive_stats_conn;
            $this->bassdrive_stats_throughput = $bassdrive_stats_throughput;
            $this->bassdrive_stats_throughput_unit = $bassdrive_stats_throughput_unit;
            $this->bassdrive_stats_max_conn = $bassdrive_stats_max_conn;

        }

    }

    private function return_json_extracted_stream_data($json_obj){

        $tmp_stream_ARRAY = array();
        $this->bassdrive_stream_ojson = $json_obj;

        if($this->oUser->oCRNRSTN_USR->get_resource('BASSDRIVE_INTEGRATE') || strlen($this->bassdrive_stream_ojson)>10){

            $tmp_nowplaying_name = '';
            $tmp_title = '';
            $tmp_host = '';
            $json = json_decode($this->bassdrive_stream_ojson, TRUE);
            $raw_nowplaying = $json['nowplaying'];

            $raw_stats = $json['stats'];

            $tmp_stat_loop_cnt = sizeof($raw_stats);
            $tmp_nowplaying_loop_cnt = sizeof($raw_nowplaying);

            for($i = 0; $i < $tmp_stat_loop_cnt; $i++){

                $tmp_name = $json['stats'][$i]['name'];

                switch($tmp_name){
                    case 'Total':

                        /*
                         "bandwidth" : 0,
                         "bitrateFormat" : "kilobit",
                         "bitrate" : 128,
                         "connections" : null,
                         "name" : "Random",
                         "capacity" : null,
                         "bandwidthFormat" : "megabit"

                         */

                        $tmp_bandwidth = $json['stats'][$i]['bandwidth'];
                        //$tmp_bitrateFormat = $json['stats'][$i]['bitrateFormat'];
                        //$tmp_bitrate = $json['stats'][$i]['bitrate'];
                        $tmp_connections = $json['stats'][$i]['connections'];
                        $tmp_capacity = $json['stats'][$i]['capacity'];
                        $tmp_bandwidthFormat = $json['stats'][$i]['bandwidthFormat'];

                    break;

                }

            }

            for($i = 0; $i < $tmp_nowplaying_loop_cnt; $i++){

                $tmp_name = $json['nowplaying'][$i]['name'];

                /*
                "name" : "Ben XO - XPOSURE Records Show w\/ guest host Schematic",
                "label" : "Artist"

                */

                $tmp_raw_nowplaying_name = $json['nowplaying'][$i]['name'];
                $tmp_label = $json['nowplaying'][$i]['label'];

                if(strlen($tmp_raw_nowplaying_name) > 5){

                    $tmp_nowplaying_name = $tmp_raw_nowplaying_name;

                    //The River City Rinse-Out *LIVE* w\/ iLL Omen
                    //Promo ZO - LIVE - FBTweet @promozo - IG @zopromo
                    //$bassdrive_nowplaying_title_ARRAY = explode('-', $tmp_raw_nowplaying_name);
                    $bassdrive_nowplaying_title_ARRAY = explode(' - ', $tmp_raw_nowplaying_name);
                    $tmp_dash_cnt = sizeof($bassdrive_nowplaying_title_ARRAY);

                    if($tmp_dash_cnt < 2){

                        $bassdrive_nowplaying_title_ARRAY = explode('hosted', $tmp_raw_nowplaying_name);

                        if($this->json_decoded_node_is_empty($bassdrive_nowplaying_title_ARRAY, 1)){

                            $tmp_title = $bassdrive_nowplaying_title_ARRAY[0];
                            $tmp_host = '';

                            $tmp_title = trim($tmp_title);

                        }else{

                            $tmp_title = $bassdrive_nowplaying_title_ARRAY[0];
                            $tmp_host = 'hosted'.$bassdrive_nowplaying_title_ARRAY[1];

                            $tmp_title = trim($tmp_title);
                            $tmp_host = trim($tmp_host);

                        }

                    }else{

                        if($tmp_dash_cnt > 2){

                            $tmp_title = trim($bassdrive_nowplaying_title_ARRAY[0]);
                            $tmp_title .= ' '.trim($bassdrive_nowplaying_title_ARRAY[1]);

                            $tmp_host = $bassdrive_nowplaying_title_ARRAY[2];

                            if(isset($bassdrive_nowplaying_title_ARRAY[3])){
                                $tmp_host = $tmp_host . ' ' . $bassdrive_nowplaying_title_ARRAY[3];
                            }

                            if(isset($bassdrive_nowplaying_title_ARRAY[4])){
                                $tmp_host = $tmp_host . ' ' . $bassdrive_nowplaying_title_ARRAY[4];
                            }

                            $tmp_title = trim($tmp_title);
                            $tmp_host = trim($tmp_host);

                        }else{

                            $tmp_title = $bassdrive_nowplaying_title_ARRAY[0];
                            $tmp_host = $bassdrive_nowplaying_title_ARRAY[1];

                            $tmp_title = trim($tmp_title);
                            $tmp_host = trim($tmp_host);

                        }

                    }

                }else{

                    //
                    // I GUESS DO NOTHING...NO DATA HERE. PERHAPS THERE IS ANOTHER NODE IN THE JSON.

                }

            }

            if($tmp_host!=""){

                $tmp_stream_info_out = $tmp_title.'<br><span class="player-host">'.$tmp_host.'</span>';

            }else{

                $tmp_stream_info_out = $tmp_title;

            }

            $tmp_stream_info_out = $this->cleanBassdriveOut($tmp_stream_info_out);
            $tmp_stream_info_out_ARRAY = $this->applyProgramTitleFormatting($tmp_stream_info_out);
            $tmp_stream_info_out = $tmp_stream_info_out_ARRAY['stream_info'];

            $tmp_stream_ARRAY['is_live'] = $tmp_stream_info_out_ARRAY['is_live'];

            if($tmp_stream_info_out_ARRAY['is_live'] == 'FALSE'){

                $pos_title = strpos($tmp_stream_info_out,'<br><span class="player-host">');
                if($pos_title !== false){

                    $tmp_stream_info_out = $this->ptrn_replace('<br><span class="player-host">', '<div class="cb_2"></div><span class="player-host">', $tmp_stream_info_out);

                }

            }

            $tmp_stream_ARRAY['title_formatted'] = html_entity_decode($tmp_stream_info_out);

            return $tmp_stream_ARRAY;

        }else{

            return '';

        }

    }

    public function refresh_expired_data($relay_endpoint, $broadcast_nation, $stream_info, $stream_social, $bassdrive_stats_conn, $bassdrive_stats_throughput, $bassdrive_stats_throughput_unit, $bassdrive_stats_max_conn){

        $tmp_relay_ojson = $this->getUrlContent($relay_endpoint);

        $this->bassdrive_stream_ojson = $tmp_relay_ojson;

        if($this->oUser->oCRNRSTN_USR->get_resource('BASSDRIVE_INTEGRATE') || strlen($this->bassdrive_stream_ojson)>10){

            $tmp_nowplaying_name = '';
            $tmp_title = '';
            $tmp_host = '';
            $json = json_decode($tmp_relay_ojson, TRUE);
            $raw_nowplaying = $json['nowplaying'];

            $raw_stats = $json['stats'];

            $tmp_stat_loop_cnt = sizeof($raw_stats);
            $tmp_nowplaying_loop_cnt = sizeof($raw_nowplaying);

            for($i = 0; $i < $tmp_stat_loop_cnt; $i++){

                $tmp_name = $json['stats'][$i]['name'];

                switch($tmp_name){
                    case 'Total':

                        /*
                         "bandwidth" : 0,
                         "bitrateFormat" : "kilobit",
                         "bitrate" : 128,
                         "connections" : null,
                         "name" : "Random",
                         "capacity" : null,
                         "bandwidthFormat" : "megabit"
                         * */

                        $tmp_bandwidth = $json['stats'][$i]['bandwidth'];
                        //$tmp_bitrateFormat = $json['stats'][$i]['bitrateFormat'];
                        //$tmp_bitrate = $json['stats'][$i]['bitrate'];
                        $tmp_connections = $json['stats'][$i]['connections'];
                        $tmp_capacity = $json['stats'][$i]['capacity'];
                        $tmp_bandwidthFormat = $json['stats'][$i]['bandwidthFormat'];

                    break;

                }

            }

            for($i = 0; $i < $tmp_nowplaying_loop_cnt; $i++){

                $tmp_name = $json['nowplaying'][$i]['name'];

                /*
                "name" : "Ben XO - XPOSURE Records Show w\/ guest host Schematic",
                "label" : "Artist"

                */

                $tmp_raw_nowplaying_name = $json['nowplaying'][$i]['name'];
                $tmp_label = $json['nowplaying'][$i]['label'];

                if(strlen($tmp_raw_nowplaying_name) > 5){

                    $tmp_nowplaying_name = $tmp_raw_nowplaying_name;

                    //The River City Rinse-Out *LIVE* w\/ iLL Omen
                    //Promo ZO - LIVE - FBTweet @promozo - IG @zopromo
                    //$bassdrive_nowplaying_title_ARRAY = explode('-', $tmp_raw_nowplaying_name);
                    $bassdrive_nowplaying_title_ARRAY = explode(' - ', $tmp_raw_nowplaying_name);
                    $tmp_dash_cnt = sizeof($bassdrive_nowplaying_title_ARRAY);

                    if($tmp_dash_cnt < 2){

                        $bassdrive_nowplaying_title_ARRAY = explode('hosted', $tmp_raw_nowplaying_name);

                        if($this->json_decoded_node_is_empty($bassdrive_nowplaying_title_ARRAY, 1)){

                            $tmp_title = $bassdrive_nowplaying_title_ARRAY[0];
                            $tmp_host = '';

                            $tmp_title = trim($tmp_title);

                        }else{

                            $tmp_title = $bassdrive_nowplaying_title_ARRAY[0];
                            $tmp_host = 'hosted'.$bassdrive_nowplaying_title_ARRAY[1];

                            $tmp_title = trim($tmp_title);
                            $tmp_host = trim($tmp_host);

                        }

                    }else{

                        if($tmp_dash_cnt > 2){

                            $tmp_title = trim($bassdrive_nowplaying_title_ARRAY[0]);
                            $tmp_title .= ' '.trim($bassdrive_nowplaying_title_ARRAY[1]);

                            $tmp_host = $bassdrive_nowplaying_title_ARRAY[2];

                            if(isset($bassdrive_nowplaying_title_ARRAY[3])){
                                $tmp_host = $tmp_host . ' ' . $bassdrive_nowplaying_title_ARRAY[3];
                            }

                            if(isset($bassdrive_nowplaying_title_ARRAY[4])){
                                $tmp_host = $tmp_host . ' ' . $bassdrive_nowplaying_title_ARRAY[4];
                            }

                            $tmp_title = trim($tmp_title);
                            $tmp_host = trim($tmp_host);

                        }else{

                            $tmp_title = $bassdrive_nowplaying_title_ARRAY[0];
                            $tmp_host = $bassdrive_nowplaying_title_ARRAY[1];

                            $tmp_title = trim($tmp_title);
                            $tmp_host = trim($tmp_host);

                        }

                    }

                }else{

                    //
                    // I GUESS DO NOTHING...NO DATA HERE. PERHAPS THERE IS ANOTHER NODE IN THE JSON.

                }

            }

            if($tmp_host!=""){

                $tmp_stream_info_out = $tmp_title.'<br><span class="player-host">'.$tmp_host.'</span>';

            }else{

                $tmp_stream_info_out = $tmp_title;

            }

            $tmp_stream_info_out = $this->cleanBassdriveOut($tmp_stream_info_out);
            $tmp_stream_info_out_ARRAY = $this->applyProgramTitleFormatting($tmp_stream_info_out);
            $tmp_stream_info_out = $tmp_stream_info_out_ARRAY['stream_info'];

            $tmp_db_resp_array = $this->return_stream_social_association_ARRAY($tmp_stream_info_out);

            $tmp_stream_broadcast_nation = $tmp_stream_info_out_ARRAY['broadcast_nation'];

            if(isset($tmp_db_resp_array['stream_colors_html'])){

                $tmp_stream_broadcast_nation = str_replace('<div id="nation_colors_wrapper" class="nation_colors_wrapper"></div>', $tmp_db_resp_array['stream_colors_html'], $tmp_stream_broadcast_nation);

            }

            if(!isset($tmp_db_resp_array['stream_locale'])){

                $tmp_db_resp_array['stream_locale'] = '';

            }

            $tmp_stream_locale = $tmp_db_resp_array['stream_locale'];
            //error_log(__LINE__ . ' user $tmp_stream_locale='.$tmp_stream_locale);

            if($tmp_stream_info_out_ARRAY['is_live'] == 'FALSE'){

                $pos_title = strpos($tmp_stream_info_out,'<br><span class="player-host">');
                if($pos_title !== false){

                    $tmp_stream_info_out = $this->ptrn_replace('<br><span class="player-host">', '<div class="cb_2"></div><span class="player-host">', $tmp_stream_info_out);

                }

            }

            $tmp_stream_info_out = html_entity_decode($tmp_stream_info_out);

            $this->bassdrive_stats_conn = $tmp_connections;
            $this->bassdrive_stats_max_conn = $tmp_capacity;
            $this->bassdrive_stats_throughput = $tmp_bandwidth;
            $this->bassdrive_stats_throughput_unit = $tmp_bandwidthFormat;

            //error_log(__LINE__ . ' $tmp_stream_info_out='.$tmp_stream_info_out);

            $tmp_bassdrive_stats_out = '<div style="height:15px; overflow:hidden;">
                <div class="bassdrive_stats_copy_elem" style="padding-left: 0px;">*</div>
                <div class="bassdrive_stats_copy_elem" id="crnrstn_curr_total_connections" style="padding-left:2px;">'.number_format($tmp_connections).'</div>
                <div class="bassdrive_stats_copy_elem">connections (</div>
                <div id="crnrstn_curr_total_capacity" class="bassdrive_stats_copy_elem" style="padding-left:0px;">'.number_format($tmp_capacity).'</div>
                <div id="curr_total_capacity" class="bassdrive_stats_copy_elem">max conn.) are</div>
            </div>
            <div style="height:15px; overflow:hidden; clear:both;">
                <div class="bassdrive_stats_copy_elem" style="padding-left: 7px;">pulling</div>
                <div class="bassdrive_stats_copy_elem" id="crnrstn_curr_total_bandwidth">'.$tmp_bandwidth.'</div>
                <div class="bassdrive_stats_copy_elem" id="crnrstn_curr_total_bandwidth_format" style="padding-left:2px;">'.$this->shortFormat($tmp_bandwidthFormat).'</div>
                <div class="bassdrive_stats_copy_elem" style="padding-left:0px;">/s of </div>
                <div id="crnrstn_bassdrive_situation" class="bassdrive_stats_copy_elem">'.$this->oUser->returnBassdriveSituation().'</div>
                <div class="bassdrive_stats_copy_elem">from Bassdrive.</div>
            </div>';

            $this->stream_info = $tmp_stream_info_out;
            $this->bassdrive_stats = $tmp_bassdrive_stats_out;
            $this->broadcast_nation = $tmp_stream_broadcast_nation;
            $this->broadcast_locale = $tmp_stream_locale;

            $this->stream_social = '
                <div class="cb"></div>
                <div id="bassdrive_social_wrapper" class="bassdrive_social_wrapper">
                    ' . $this->return_social_HTML('stream_soundcloud', $tmp_db_resp_array) . $this->return_social_HTML('stream_soundcloud2', $tmp_db_resp_array) .$this->return_social_HTML('stream_soundcloud3', $tmp_db_resp_array) .'
                    ' . $this->return_social_HTML('stream_facebook', $tmp_db_resp_array) . $this->return_social_HTML('stream_facebook2', $tmp_db_resp_array) . $this->return_social_HTML('stream_facebook3', $tmp_db_resp_array) . '
                    ' . $this->return_social_HTML('stream_instagram', $tmp_db_resp_array) . $this->return_social_HTML('stream_instagram2', $tmp_db_resp_array) . $this->return_social_HTML('stream_instagram3', $tmp_db_resp_array) . '
                    ' . $this->return_social_HTML('stream_twitter', $tmp_db_resp_array) . $this->return_social_HTML('stream_twitter2', $tmp_db_resp_array) . $this->return_social_HTML('stream_twitter3', $tmp_db_resp_array) . '
                    ' . $this->return_social_HTML('stream_mixcloud', $tmp_db_resp_array) . $this->return_social_HTML('stream_mixcloud2', $tmp_db_resp_array) . $this->return_social_HTML('stream_mixcloud3', $tmp_db_resp_array) . '
                    ' . $this->return_social_HTML('stream_discogs', $tmp_db_resp_array) . $this->return_social_HTML('stream_discogs2', $tmp_db_resp_array) . $this->return_social_HTML('stream_discogs3', $tmp_db_resp_array) . '
                    ' . $this->return_social_HTML('stream_beatport', $tmp_db_resp_array) . $this->return_social_HTML('stream_beatport2', $tmp_db_resp_array) . $this->return_social_HTML('stream_beatport3', $tmp_db_resp_array) . '
                    ' . $this->return_social_HTML('stream_bandcamp', $tmp_db_resp_array) . $this->return_social_HTML('stream_bandcamp2', $tmp_db_resp_array) . $this->return_social_HTML('stream_bandcamp3', $tmp_db_resp_array) . '
                    ' . $this->return_social_HTML('stream_spotify', $tmp_db_resp_array) . $this->return_social_HTML('stream_spotify2', $tmp_db_resp_array) . $this->return_social_HTML('stream_spotify3', $tmp_db_resp_array) . '
                    ' . $this->return_social_HTML('stream_rolldabeats', $tmp_db_resp_array) . $this->return_social_HTML('stream_rolldabeats2', $tmp_db_resp_array) . $this->return_social_HTML('stream_rolldabeats3', $tmp_db_resp_array) . '
                    ' . $this->return_social_HTML('stream_youtube', $tmp_db_resp_array) . $this->return_social_HTML('stream_youtube2', $tmp_db_resp_array) . $this->return_social_HTML('stream_youtube3', $tmp_db_resp_array) . '
                    ' . $this->return_social_HTML('stream_www', $tmp_db_resp_array) . $this->return_social_HTML('stream_www2', $tmp_db_resp_array) . $this->return_social_HTML('stream_www3', $tmp_db_resp_array) . '
                    ' . $this->return_social_HTML('stream_profile', $tmp_db_resp_array) . '
                    ' . $this->return_social_HTML('stream_archives', $tmp_db_resp_array) . '
                    ' . $this->return_social_HTML('stream_paypal', $tmp_db_resp_array) . '
                    ' . $this->return_social_HTML('stream_json', $tmp_db_resp_array) . '
                    ' . $this->return_social_HTML('stream_history', $tmp_db_resp_array) . '
                    <div class="cb"></div>
                    <div id="bassdrive_history_popup_wrapper"><div id="bassdrive_history_close_wrapper"><div id="bassdrive_history_close" onclick="bassdrive_close_history();">X</div></div><div id="bassdrive_history_popup"></div></div>
                </div>
            ';

        }

    }

    private function json_decoded_node_is_empty($json_decoded_ARRAY, $index){

        if(isset($json_decoded_ARRAY[$index])){

            if($json_decoded_ARRAY[$index] == ''){

                return true;

            }else{

                return false;

            }

        }else{

            return true;

        }

    }

    //
    // CURL BASSDRIVE NOW PLAYING INFO
    private function getUrlContent($url){

        // https://www.php.net/manual/en/function.curl-init.php
        $opts = array(
            'http' => array (
                'method'=>"POST",
                'header'=>
                    "Accept-language: en\r\n".
                    "Content-type: application/x-www-form-urlencoded\r\n",
                'content'=>http_build_query(array('foo'=>'bar'))
            )
        );

        $context = stream_context_create($opts);

        $fp = fopen($url, 'r', false, $context);

        $contents = '';

        //
        // SOURCE :: https://stackoverflow.com/questions/3308388/fopen-returns-resource-id-4
        // COMMENT :: https://stackoverflow.com/a/3308463
        // AUTHOR :: PHPology :: https://stackoverflow.com/users/383633/phpology
        // https://www.php.net/manual/en/function.fread.php
        while(!feof($fp)){

            $contents .= fread($fp, 8192);

        }

        fclose($fp);

        return $contents;

//
//        $header=array(
//            'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36',
//            'X-Requested-With: XMLHttpRequest',
//            'Host: www.bassdrive.com',
//            'Accept: text/html, */*; q=0.01',
//            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
//            'Accept-Language: en-US,en;q=0.9,zh-CN;q=0.8,zh;q=0.7',
//            'Accept-Encoding: gzip,deflate',
//            'Referer: '.$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR'),
//            'Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7',
//            'Keep-Alive: 115',
//            'Connection: keep-alive',
//        );
//
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $url);
//        //curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
//        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
//        //curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 100);
//        curl_setopt($ch, CURLOPT_TIMEOUT, 100);
//        curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
//
//        if( ! $data = curl_exec($ch)){
//            //$oLogger->captureNotice('[ERROR] CRON Fired CURL :: /_cron/bassdrive_sync/', LOG_CRIT, curl_error($ch));
//        }
//
//        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//        curl_close($ch);
//
//        return ($httpcode>=200 && $httpcode<300) ? $data : false;

    }

    private function shortFormat($data_format){
        $format = '';

        switch($data_format){
            case 'kilabit':

                $format = 'KB';

            break;
            case 'megabit':

                $format = 'MB';

            break;
            case 'gigabit':

                $format = 'GB';

            break;
            default:

                $format = '?B';

            break;

        }

        return $format;

    }

    private function cleanBassdriveOut($str){

        $patterns = array();
        $patterns[0] = "<br><span class=\"player-host\">0</span>";

        $replacements = array();
        $replacements[0] = '';

        #$str = preg_replace($patterns, $replacements, $str);
        $str = str_replace($patterns, $replacements, $str);

        return $str;

    }

    public function return_stream_social_association_ARRAY($str){

        $this->stream_title = $str;
        return $this->dataBaseIntegration->return_stream_social_association_ARRAY($this, $this->oUserEnvironment, 'return_stream_social_association_ARRAY');

    }

    private function return_social_HTML($channel, $stream_meta_ARRAY, $url = NULL){

        $channel = strtolower($channel);
        $social_channel = '';

        switch($channel) {
            case 'stream_soundcloud':
            case 'stream_soundcloud2':
            case 'stream_soundcloud3':

                $social_channel = ' for the ' . $this->stream_title . ' SoundCloud playlist';

            break;
            case 'stream_facebook':
            case 'stream_facebook2':
            case 'stream_facebook3':

                $social_channel = ' for the ' . $this->stream_title . ' Facebook page';

            break;
            case 'stream_instagram':
            case 'stream_instagram2':
            case 'stream_instagram3':

                $social_channel = ' for the ' . $this->stream_title . ' Instagram feed';

            break;
            case 'stream_twitter':
            case 'stream_twitter2':
            case 'stream_twitter3':

                $social_channel = ' for the ' . $this->stream_title . ' Twitter feed';

            break;
            case 'stream_mixcloud':
            case 'stream_mixcloud2':
            case 'stream_mixcloud3':

                $social_channel = ' for the ' . $this->stream_title . ' Mixcloud community';

            break;
            case 'stream_discogs':
            case 'stream_discogs2':
            case 'stream_discogs3':

                $social_channel = ' for the ' . $this->stream_title . ' Discogs music selection';

            break;
            case 'stream_beatport':
            case 'stream_beatport2':
            case 'stream_beatport3':

                $social_channel = ' for the ' . $this->stream_title . ' Beatport featured tracks';

            break;
            case 'stream_bandcamp':
            case 'stream_bandcamp2':
            case 'stream_bandcamp3':

                $social_channel = ' for the ' . $this->stream_title . ' Bandcamp music page';

            break;
            case 'stream_spotify':
            case 'stream_spotify2':
            case 'stream_spotify3':

                $social_channel = ' for the ' . $this->stream_title . ' Spotify community';

            break;
            case 'stream_rolldabeats':
            case 'stream_rolldabeats2':
            case 'stream_rolldabeats3':

                $social_channel = ' for the ' . $this->stream_title . ' RollDaBeats catalog';

            break;
            case 'stream_youtube':
            case 'stream_youtube2':
            case 'stream_youtube3':

                $social_channel = ' for the ' . $this->stream_title . ' YouTube channel';

            break;
            case 'stream_www':
            case 'stream_www2':
            case 'stream_www3':

                $social_channel = ' for the website of ' . $this->stream_title;

            break;
            case 'stream_profile':

                $social_channel = ' for the ' . $this->stream_title.  ' Bassdrive show profile';

            break;
            case 'stream_archives':

                $social_channel = ' for the archives of ' . $this->stream_title;

            break;
            case 'stream_paypal':

                $social_channel = ' to make a donation to Bassdrive';

            break;

        }

        switch($channel){
            case 'stream_soundcloud':
            case 'stream_facebook':
            case 'stream_instagram':
            case 'stream_twitter':
            case 'stream_mixcloud':
            case 'stream_discogs':
            case 'stream_beatport':
            case 'stream_bandcamp':
            case 'stream_spotify':
            case 'stream_rolldabeats':
            case 'stream_youtube':
            case 'stream_www':
            case 'stream_paypal':
            case 'stream_profile':
            case 'stream_archives':

                //error_log(__LINE__ . ' user ['.$channel . ']['.self::$social_lnk_cnt.']');

                if(isset($stream_meta_ARRAY[$channel])){

                    if(strlen($stream_meta_ARRAY[$channel]) > 5){

                        self::$social_lnk_cnt++;
                        $this->stream_has_social = true;

                        return '<div class="bassdrive_social_link_anchor ' . $channel . '" onclick="launch_newwindow(\'' . $stream_meta_ARRAY[$channel] . '\'); return false;"><div class="bassdrive_social_link_float ' . $channel . '"><img src="' . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP') . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/bassdrive_component_creative/social_integration_sprite_high_qual.png?v=420' . $this->sprite_serial .'" width="165" height="80" /></div></div><div class="hidden">Click <a href="' . $stream_meta_ARRAY[$channel] . '" target="_blank">here</a>' . $social_channel . '.</div>';

                        //return '<div class="bassdrive_social_link ' . $channel . '" onclick="launch_newwindow(\'' . $stream_meta_ARRAY[$channel] . '\'); return false;" style="background-image:url(' . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=420' . $this->sprite_serial .')"></div><div class="hidden">Click <a href="' . $stream_meta_ARRAY[$channel] . '" target="_blank">here</a>' . $social_channel . '.</div>';

                    }else{

                        return '';

                    }

                }

            break;
            case 'stream_soundcloud2':
            case 'stream_facebook2':
            case 'stream_instagram2':
            case 'stream_twitter2':
            case 'stream_mixcloud2':
            case 'stream_discogs2':
            case 'stream_beatport2':
            case 'stream_bandcamp2':
            case 'stream_spotify2':
            case 'stream_rolldabeats2':
            case 'stream_youtube2':
            case 'stream_www2':

                if(isset($stream_meta_ARRAY[$channel])){

                    if(strlen($stream_meta_ARRAY[$channel]) > 5){
                        self::$social_lnk_cnt++;
                        $this->stream_has_social = true;

                        return '<div class="bassdrive_social_link_anchor ' . rtrim($channel,'2') . '" onclick="launch_newwindow(\'' . $stream_meta_ARRAY[$channel] . '\'); return false;"><div class="bassdrive_social_link_float ' . $channel . '"><img src="' . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP') . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/bassdrive_component_creative/social_integration_sprite_high_qual.png?v=420' . $this->sprite_serial .'" width="165" height="80" /></div></div><div class="hidden">Click <a href="' . $stream_meta_ARRAY[$channel] . '" target="_blank">here</a>' . $social_channel . '.</div>';

                        //return '<div class="bassdrive_social_link ' . rtrim($channel,'2') . '" onclick="launch_newwindow(\'' . $stream_meta_ARRAY[$channel] . '\'); return false;" style="background-image:url(' . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=420' . $this->sprite_serial .')"></div><div class="hidden">Click <a href="' . $stream_meta_ARRAY[$channel] . '" target="_blank">here</a>' . $social_channel . '.</div>';

                    }else{

                        return '';

                    }

                }

            break;
            case 'stream_soundcloud3':
            case 'stream_facebook3':
            case 'stream_instagram3':
            case 'stream_twitter3':
            case 'stream_mixcloud3':
            case 'stream_discogs3':
            case 'stream_beatport3':
            case 'stream_bandcamp3':
            case 'stream_spotify3':
            case 'stream_rolldabeats3':
            case 'stream_youtube3':
            case 'stream_www3':

                if(isset($stream_meta_ARRAY[$channel])){

                    if(strlen($stream_meta_ARRAY[$channel]) > 5){
                        self::$social_lnk_cnt++;
                        $this->stream_has_social = true;

                        return '<div class="bassdrive_social_link_anchor ' . rtrim($channel,'3') . '" onclick="launch_newwindow(\'' . $stream_meta_ARRAY[$channel] . '\'); return false;"><div class="bassdrive_social_link_float ' . $channel . '"><img src="' . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP') . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/bassdrive_component_creative/social_integration_sprite_high_qual.png?v=420' . $this->sprite_serial .'" width="165" height="80" /></div></div><div class="hidden">Click <a href="' . $stream_meta_ARRAY[$channel] . '" target="_blank">here</a>' . $social_channel . '.</div>';

                        //return '<div class="bassdrive_social_link ' . rtrim($channel,'3') . '" onclick="launch_newwindow(\'' . $stream_meta_ARRAY[$channel] . '\'); return false;" style="background-image:url(' . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=420' . $this->sprite_serial .')"></div><div class="hidden">Click <a href="' . $stream_meta_ARRAY[$channel] . '" target="_blank">here</a>' . $social_channel . '.</div>';

                    }else{

                        return '';

                    }

                }

            break;
            case 'stream_json':

                if($channel == 'stream_json' && self::$social_lnk_cnt == 8){

                    $tmp_line_wrap = '<div class="cb"></div>';

                }else{

                    $tmp_line_wrap = '';

                }

                //
                // JSON
                if($this->stream_has_social){

                    if(isset($stream_meta_ARRAY[$channel])){

                        if(isset($url)){

                            if(strlen($stream_meta_ARRAY[$channel]) > 5){

                                return $tmp_line_wrap . '<div class="bassdrive_social_link_anchor ' . $channel . '" onclick="launch_newwindow(\'' . $url . '\'); return false;"><div class="bassdrive_social_link_float ' . $channel . '"><img src="' . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP') . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/bassdrive_component_creative/social_integration_sprite_high_qual.png?v=420' . $this->sprite_serial .'" width="165" height="80" /></div></div>';

                                //return $tmp_line_wrap . '<div class="bassdrive_social_link ' . $channel . '" onclick="launch_newwindow(\'' . $url . '\'); return false;" style="background-image:url(' . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=420' . $this->sprite_serial .')"></div>';

                            }else{

                                return '';

                            }

                        }else{

                            if(strlen($stream_meta_ARRAY[$channel]) > 5){

                                return $tmp_line_wrap . '<div class="bassdrive_social_link_anchor ' . $channel . '" onclick="launch_newwindow(\''.$stream_meta_ARRAY[$channel].'\'); return false;"><div class="bassdrive_social_link_float ' . $channel . '"><img src="' . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP') . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/bassdrive_component_creative/social_integration_sprite_high_qual.png?v=420' . $this->sprite_serial .'" width="165" height="80" /></div></div>';

                                //return $tmp_line_wrap . '<div class="bassdrive_social_link ' . $channel . '" onclick="launch_newwindow(\''.$stream_meta_ARRAY[$channel].'\'); return false;" style="background-image:url(' . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=420' . $this->sprite_serial .')"></div>';

                            }else{

                                return '';

                            }

                        }

                    }

                }

            break;
            case 'stream_history':

                //
                // JSON
                if($this->stream_has_social){

                    if(isset($stream_meta_ARRAY[$channel])){

                        if(strlen($stream_meta_ARRAY[$channel]) > 5){

                            return '<div class="bassdrive_social_link_anchor ' . $channel . '" onclick="bassdrive_load_history(\''.$stream_meta_ARRAY[$channel].'\'); return false;"><div class="bassdrive_social_link_float ' . $channel . '"><img src="' . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP') . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/bassdrive_component_creative/social_integration_sprite_high_qual.png?v=420' . $this->sprite_serial .'" width="165" height="80" /></div></div>';

                            //return '<div class="bassdrive_social_link ' . $channel . '" onclick="bassdrive_load_history(\''.$stream_meta_ARRAY[$channel].'\'); return false;" style="background-image:url(' . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=420' . $this->sprite_serial .')"></div>';

                        }else{

                            return '';

                        }

                    }

                }

            break;
            default:

                return '';

            break;

        }

        return '';

    }

    public function bassdrive_history_output(){

        return $this->dataBaseIntegration->bassdrive_history_output($this, $this->oUserEnvironment, 'bassdrive_history_output');

    }

    public function bassdrive_rebuild_stream_history_output(){

        error_log(__LINE__ . ' user die(); RE-ARCH THIS.');
        die();
        $tmp_html = '';
        $tmp_serial_tracker =  '';
        $tmp_has_json_ARRAY = array();
        $tmp_track_match_ARRAY = array();
        $tmp_query_ARRAY = array();

        $tmp_resp = $this->dataBaseIntegration->bassdrive_colors_algorithm_output($this, $this->oUserEnvironment, 'bassdrive_colors_algorithm_output');

        foreach ($tmp_resp as $rowcnt => $chunkARRAY0){

            $tmp_display_show = false;
            $this->stream_has_social = false;

            if(isset($chunkARRAY0[3])){

                if(strlen($chunkARRAY0[3]) > 10){

                    //
                    // WE HAVE JSON DATA
                    $tmp_stream_json_ARRAY = $this->return_json_extracted_stream_data($chunkARRAY0[3]);

                    if(strlen($chunkARRAY0[1])<5){

                        //
                        // WE NEED A SERIAL IN THE DB
                        $tmp_serial = $tmp_serial_tracker = $this->oUser->generateNewKey(64);

                        $tmp_query_ARRAY[] = 'UPDATE `crnrstn_global_bassdrive_log`
                            SET
                            `SERIAL` = "' . $tmp_serial . '"
                            WHERE `ID` = ' . $chunkARRAY0[0] . ' LIMIT 1;
                        ';

                        $tmp_has_json_ARRAY[$tmp_serial] = true;

                    }else{

                        $tmp_serial_tracker = $chunkARRAY0[1];
                        $tmp_has_json_ARRAY[$chunkARRAY0[1]] = true;

                    }

                }else{

                    //
                    // WE DON'T HAVE JSON DATA
                    if(strlen($chunkARRAY0[1])<5){

                        //
                        // WE NEED A SERIAL IN THE DB
                        $tmp_serial = $tmp_serial_tracker = $this->oUser->generateNewKey(64);

                        $tmp_query_ARRAY[] = 'UPDATE `crnrstn_global_bassdrive_log`
                            SET
                            `SERIAL` = "' . $tmp_serial . '"
                            WHERE `ID` = ' . $chunkARRAY0[0] . ' LIMIT 1;
                        ';

                        $tmp_has_json_ARRAY[$tmp_serial] = false;

                    }else{

                        $tmp_serial_tracker = $chunkARRAY0[1];
                        $tmp_has_json_ARRAY[$chunkARRAY0[1]] = false;

                    }

                }

                $tmp_stream_ARRAY = $this->return_stream_data_ARRAY($chunkARRAY0[2]);

                if(!isset($tmp_stream_ARRAY['stream_key'])){

                    if(!isset($tmp_track_match_ARRAY[md5($chunkARRAY0[2])])){

                        //
                        // AN UNMONITORED FOR BROADCAST ORIGIN STREAM
                        $tmp_track_match_ARRAY[md5($chunkARRAY0[2])] = 1;
                        $tmp_display_show = true;

                    }

                }else{

                    if(!isset($tmp_track_match_ARRAY[$tmp_stream_json_ARRAY['is_live'].$tmp_stream_ARRAY['stream_key']])){

                        $tmp_track_match_ARRAY[$tmp_stream_json_ARRAY['is_live'].$tmp_stream_ARRAY['stream_key']] = 1;
                        $tmp_display_show = true;

                    }

                }

                if($tmp_display_show){

                    $tmp_db_resp_array = $tmp_stream_ARRAY['DATABASE_TRANSFER'];

                    if($tmp_stream_ARRAY['stream_flag_file_img'] == 'flag_unknown.gif'){

                        $tmp_colors_html = '<div class="colors_img_wrapper"></div>
                                <div class="cb"></div>
                                <div class="colors_city_state"></div>
                                <div class="cb"></div>
                                <div class="colors_show_date_generated"><span style="font-weight: bold;">Generated on:&nbsp;&nbsp;</span>'.date('l, M. j \a\t G:i:s T', strtotime($chunkARRAY0[4])).'</div>';

                    }else{

                        //error_log(__LINE__ . ' user '.$tmp_stream_ARRAY['stream_flag_file_img']);
                        $tmp_colors_html = '<div class="colors_img_wrapper">' . $tmp_stream_ARRAY['stream_flag_file_img'] . '</div>
                                <div class="cb"></div>
                                <div class="colors_city_state">' . $tmp_stream_ARRAY['stream_city_state_prov_nation'] . '</div>
                                <div class="cb"></div>
                                <div class="colors_show_date_generated"><span style="font-weight: bold;">Generated on:&nbsp;&nbsp;</span>'.date('l, M. j \a\t G:i:s T', strtotime($chunkARRAY0[4])).'</div>';

                    }

                    self::$social_lnk_cnt = 0;

                    if($tmp_has_json_ARRAY[$tmp_serial_tracker]){

                        $tmp_html .= '
                        <div>
                            <div class="colors_show_title_wrapper">' . $tmp_stream_json_ARRAY['title_formatted'] . '
                                <div class="cb"></div>
                                <div id="bassdrive_social_wrapper" class="bassdrive_social_wrapper">
                                    ' . $this->return_social_HTML('stream_soundcloud', $tmp_db_resp_array) . $this->return_social_HTML('stream_soundcloud2', $tmp_db_resp_array) .$this->return_social_HTML('stream_soundcloud3', $tmp_db_resp_array) .'
                                    ' . $this->return_social_HTML('stream_facebook', $tmp_db_resp_array) . $this->return_social_HTML('stream_facebook2', $tmp_db_resp_array) . $this->return_social_HTML('stream_facebook3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_instagram', $tmp_db_resp_array) . $this->return_social_HTML('stream_instagram2', $tmp_db_resp_array) . $this->return_social_HTML('stream_instagram3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_twitter', $tmp_db_resp_array) . $this->return_social_HTML('stream_twitter2', $tmp_db_resp_array) . $this->return_social_HTML('stream_twitter3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_mixcloud', $tmp_db_resp_array) . $this->return_social_HTML('stream_mixcloud2', $tmp_db_resp_array) . $this->return_social_HTML('stream_mixcloud3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_discogs', $tmp_db_resp_array) . $this->return_social_HTML('stream_discogs2', $tmp_db_resp_array) . $this->return_social_HTML('stream_discogs3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_beatport', $tmp_db_resp_array) . $this->return_social_HTML('stream_beatport2', $tmp_db_resp_array) . $this->return_social_HTML('stream_beatport3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_bandcamp', $tmp_db_resp_array) . $this->return_social_HTML('stream_bandcamp2', $tmp_db_resp_array) . $this->return_social_HTML('stream_bandcamp3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_spotify', $tmp_db_resp_array) . $this->return_social_HTML('stream_spotify2', $tmp_db_resp_array) . $this->return_social_HTML('stream_spotify3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_rolldabeats', $tmp_db_resp_array) . $this->return_social_HTML('stream_rolldabeats2', $tmp_db_resp_array) . $this->return_social_HTML('stream_rolldabeats3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_youtube', $tmp_db_resp_array) . $this->return_social_HTML('stream_youtube2', $tmp_db_resp_array) . $this->return_social_HTML('stream_youtube3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_www', $tmp_db_resp_array) . $this->return_social_HTML('stream_www2', $tmp_db_resp_array) . $this->return_social_HTML('stream_www3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_profile', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_archives', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_paypal', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_json', $tmp_db_resp_array, $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . '_proxy/bassdrive_colors/?stream=' . $tmp_serial_tracker) . '
                                    <div class="cb"></div>
                                </div>
                            </div>
                            <div class="colors_wrapper">
                                ' . $tmp_colors_html . '
                            </div>
                        </div>
                        <div class="colors_hr_wrapper"><div class="colors_hr"></div></div>
                        ';

                    }else{

                        $tmp_html .= '
                        <div>
                            <div class="colors_show_title_wrapper">' . $chunkARRAY0[2] . '
                                <div class="cb"></div>
                                <div id="bassdrive_social_wrapper" class="bassdrive_social_wrapper">
                                ' . $this->return_social_HTML('stream_soundcloud', $tmp_db_resp_array) . $this->return_social_HTML('stream_soundcloud2', $tmp_db_resp_array) .$this->return_social_HTML('stream_soundcloud3', $tmp_db_resp_array) .'
                                ' . $this->return_social_HTML('stream_facebook', $tmp_db_resp_array) . $this->return_social_HTML('stream_facebook2', $tmp_db_resp_array) . $this->return_social_HTML('stream_facebook3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_instagram', $tmp_db_resp_array) . $this->return_social_HTML('stream_instagram2', $tmp_db_resp_array) . $this->return_social_HTML('stream_instagram3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_twitter', $tmp_db_resp_array) . $this->return_social_HTML('stream_twitter2', $tmp_db_resp_array) . $this->return_social_HTML('stream_twitter3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_mixcloud', $tmp_db_resp_array) . $this->return_social_HTML('stream_mixcloud2', $tmp_db_resp_array) . $this->return_social_HTML('stream_mixcloud3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_discogs', $tmp_db_resp_array) . $this->return_social_HTML('stream_discogs2', $tmp_db_resp_array) . $this->return_social_HTML('stream_discogs3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_beatport', $tmp_db_resp_array) . $this->return_social_HTML('stream_beatport2', $tmp_db_resp_array) . $this->return_social_HTML('stream_beatport3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_bandcamp', $tmp_db_resp_array) . $this->return_social_HTML('stream_bandcamp2', $tmp_db_resp_array) . $this->return_social_HTML('stream_bandcamp3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_spotify', $tmp_db_resp_array) . $this->return_social_HTML('stream_spotify2', $tmp_db_resp_array) . $this->return_social_HTML('stream_spotify3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_rolldabeats', $tmp_db_resp_array) . $this->return_social_HTML('stream_rolldabeats2', $tmp_db_resp_array) . $this->return_social_HTML('stream_rolldabeats3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_youtube', $tmp_db_resp_array) . $this->return_social_HTML('stream_youtube2', $tmp_db_resp_array) . $this->return_social_HTML('stream_youtube3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_www', $tmp_db_resp_array) . $this->return_social_HTML('stream_www2', $tmp_db_resp_array) . $this->return_social_HTML('stream_www3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_profile', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_archives', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_paypal', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_json', $tmp_db_resp_array) . '
                                    <div class="cb"></div>
                                </div>
                            </div>
                            <div class="colors_wrapper">
                                ' . $tmp_colors_html . '
                            </div>

                        </div>
                        <div class="colors_hr_wrapper"><div class="colors_hr"></div></div>
                        ';

                    }

                }

            }

        }

        if(count($tmp_query_ARRAY)>0){

            $this->dataBaseIntegration->bassdrive_serialize_streams($this, $this->oUserEnvironment, $tmp_query_ARRAY);

        }

        return $tmp_html;

    }

    public function bassdrive_colors_algorithm_output(){

        /*
        self::$query = 'SELECT `crnrstn_global_bassdrive_log`.`BASSDRIVE_LOG_ID`,
            `crnrstn_global_bassdrive_log`.`SERIAL`,
            `crnrstn_global_bassdrive_log`.`PROGRAM_TITLE`,
            `crnrstn_global_bassdrive_log`.`STREAM_RELAY_JSON`,
            `crnrstn_global_bassdrive_log`.`DATEMODIFIED`
        FROM `crnrstn_global_bassdrive_log` ORDER BY `crnrstn_global_bassdrive_log`.`ID` DESC;
        ';
        */

        $tmp_html = '';
        $tmp_serial_tracker =  '';
        $tmp_has_json_ARRAY = array();
        $tmp_track_match_ARRAY = array();
        $tmp_query_ARRAY = array();

        $tmp_resp = $this->dataBaseIntegration->bassdrive_colors_algorithm_output($this, $this->oUserEnvironment, 'bassdrive_colors_algorithm_output');

        foreach ($tmp_resp as $rowcnt => $chunkARRAY0){

            $tmp_display_show = false;
            $this->stream_has_social = false;

            if(isset($chunkARRAY0[3])){

                if(strlen($chunkARRAY0[3]) > 10){

                    //
                    // WE HAVE JSON DATA
                    $tmp_stream_json_ARRAY = $this->return_json_extracted_stream_data($chunkARRAY0[3]);

                    if(strlen($chunkARRAY0[1])<5){

                        //
                        // WE NEED A SERIAL IN THE DB
                        $tmp_serial = $tmp_serial_tracker = $this->oUser->generateNewKey(64);

                        $tmp_query_ARRAY[] = 'UPDATE `crnrstn_global_bassdrive_log`
                            SET
                            `SERIAL` = "' . $tmp_serial . '"
                            WHERE `ID` = ' . $chunkARRAY0[0] . ' LIMIT 1;
                        ';

                        $tmp_has_json_ARRAY[$tmp_serial] = true;

                    }else{

                        $tmp_serial_tracker = $chunkARRAY0[1];
                        $tmp_has_json_ARRAY[$chunkARRAY0[1]] = true;

                    }

                }else{

                    //
                    // WE DON'T HAVE JSON DATA
                    if(strlen($chunkARRAY0[1])<5){

                        //
                        // WE NEED A SERIAL IN THE DB
                        $tmp_serial = $tmp_serial_tracker = $this->oUser->generateNewKey(64);

                        $tmp_query_ARRAY[] = 'UPDATE `crnrstn_global_bassdrive_log`
                            SET
                            `SERIAL` = "' . $tmp_serial . '"
                            WHERE `ID` = ' . $chunkARRAY0[0] . ' LIMIT 1;
                        ';

                        $tmp_has_json_ARRAY[$tmp_serial] = false;

                    }else{

                        $tmp_serial_tracker = $chunkARRAY0[1];
                        $tmp_has_json_ARRAY[$chunkARRAY0[1]] = false;

                    }

                }

                $tmp_stream_ARRAY = $this->return_stream_data_ARRAY($chunkARRAY0[2]);

                if(!isset($tmp_stream_ARRAY['stream_key'])){

                    if(!isset($tmp_track_match_ARRAY[md5($chunkARRAY0[2])])){

                        //
                        // AN UNMONITORED FOR BROADCAST ORIGIN STREAM
                        $tmp_track_match_ARRAY[md5($chunkARRAY0[2])] = 1;
                        $tmp_display_show = true;

                    }

                }else{

                    if(!isset($tmp_track_match_ARRAY[$tmp_stream_json_ARRAY['is_live'].$tmp_stream_ARRAY['stream_key']])){

                        $tmp_track_match_ARRAY[$tmp_stream_json_ARRAY['is_live'].$tmp_stream_ARRAY['stream_key']] = 1;
                        $tmp_display_show = true;

                    }

                }

                if($tmp_display_show){

                    $tmp_db_resp_array = $tmp_stream_ARRAY['DATABASE_TRANSFER'];

                    if($tmp_stream_ARRAY['stream_flag_file_img'] == 'flag_unknown.gif'){

                        $tmp_colors_html = '<div class="colors_img_wrapper"></div>
                                <div class="cb"></div>
                                <div class="colors_city_state"></div>';

                    }else{

                        //error_log(__LINE__ . ' user '.$tmp_stream_ARRAY['stream_flag_file_img']);
                        $tmp_colors_html = '<div class="colors_img_wrapper">' . $tmp_stream_ARRAY['stream_flag_file_img'] . '</div>
                                <div class="cb"></div>
                                <div class="colors_city_state">' . $tmp_stream_ARRAY['stream_city_state_prov_nation'] . '</div>';

                    }

                    self::$social_lnk_cnt = 0;

                    if($tmp_has_json_ARRAY[$tmp_serial_tracker]){

                        $tmp_html .= '
                        <div>
                            <div class="colors_show_title_wrapper">' . $tmp_stream_json_ARRAY['title_formatted'] . '
                                <div class="cb"></div>
                                <div id="bassdrive_social_wrapper" class="bassdrive_social_wrapper">
                                    ' . $this->return_social_HTML('stream_soundcloud', $tmp_db_resp_array) . $this->return_social_HTML('stream_soundcloud2', $tmp_db_resp_array) .$this->return_social_HTML('stream_soundcloud3', $tmp_db_resp_array) .'
                                    ' . $this->return_social_HTML('stream_facebook', $tmp_db_resp_array) . $this->return_social_HTML('stream_facebook2', $tmp_db_resp_array) . $this->return_social_HTML('stream_facebook3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_instagram', $tmp_db_resp_array) . $this->return_social_HTML('stream_instagram2', $tmp_db_resp_array) . $this->return_social_HTML('stream_instagram3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_twitter', $tmp_db_resp_array) . $this->return_social_HTML('stream_twitter2', $tmp_db_resp_array) . $this->return_social_HTML('stream_twitter3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_mixcloud', $tmp_db_resp_array) . $this->return_social_HTML('stream_mixcloud2', $tmp_db_resp_array) . $this->return_social_HTML('stream_mixcloud3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_discogs', $tmp_db_resp_array) . $this->return_social_HTML('stream_discogs2', $tmp_db_resp_array) . $this->return_social_HTML('stream_discogs3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_beatport', $tmp_db_resp_array) . $this->return_social_HTML('stream_beatport2', $tmp_db_resp_array) . $this->return_social_HTML('stream_beatport3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_bandcamp', $tmp_db_resp_array) . $this->return_social_HTML('stream_bandcamp2', $tmp_db_resp_array) . $this->return_social_HTML('stream_bandcamp3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_spotify', $tmp_db_resp_array) . $this->return_social_HTML('stream_spotify2', $tmp_db_resp_array) . $this->return_social_HTML('stream_spotify3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_rolldabeats', $tmp_db_resp_array) . $this->return_social_HTML('stream_rolldabeats2', $tmp_db_resp_array) . $this->return_social_HTML('stream_rolldabeats3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_youtube', $tmp_db_resp_array) . $this->return_social_HTML('stream_youtube2', $tmp_db_resp_array) . $this->return_social_HTML('stream_youtube3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_www', $tmp_db_resp_array) . $this->return_social_HTML('stream_www2', $tmp_db_resp_array) . $this->return_social_HTML('stream_www3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_profile', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_archives', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_paypal', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_json', $tmp_db_resp_array) . '
                                    <div class="cb"></div>
                                </div>
                            </div>
                            <div class="colors_wrapper">
                                ' . $tmp_colors_html . '
                            </div>
                            <div class="colors_stream_json"><a href="' . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . '_proxy/bassdrive_colors/?stream=' . $tmp_serial_tracker . '" target="_blank"><img src="' . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/icon_json.gif" width="51" height="50" alt="JSON" border="0"></a></div>
                        </div>
                        <div class="colors_hr_wrapper"><div class="colors_hr"></div></div>
                        ';

                    }else{

                        $tmp_html .= '
                        <div>
                            <div class="colors_show_title_wrapper">' . $chunkARRAY0[2] . '
                                <div class="cb"></div>
                                <div id="bassdrive_social_wrapper" class="bassdrive_social_wrapper">
                                ' . $this->return_social_HTML('stream_soundcloud', $tmp_db_resp_array) . $this->return_social_HTML('stream_soundcloud2', $tmp_db_resp_array) .$this->return_social_HTML('stream_soundcloud3', $tmp_db_resp_array) .'
                                ' . $this->return_social_HTML('stream_facebook', $tmp_db_resp_array) . $this->return_social_HTML('stream_facebook2', $tmp_db_resp_array) . $this->return_social_HTML('stream_facebook3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_instagram', $tmp_db_resp_array) . $this->return_social_HTML('stream_instagram2', $tmp_db_resp_array) . $this->return_social_HTML('stream_instagram3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_twitter', $tmp_db_resp_array) . $this->return_social_HTML('stream_twitter2', $tmp_db_resp_array) . $this->return_social_HTML('stream_twitter3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_mixcloud', $tmp_db_resp_array) . $this->return_social_HTML('stream_mixcloud2', $tmp_db_resp_array) . $this->return_social_HTML('stream_mixcloud3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_discogs', $tmp_db_resp_array) . $this->return_social_HTML('stream_discogs2', $tmp_db_resp_array) . $this->return_social_HTML('stream_discogs3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_beatport', $tmp_db_resp_array) . $this->return_social_HTML('stream_beatport2', $tmp_db_resp_array) . $this->return_social_HTML('stream_beatport3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_bandcamp', $tmp_db_resp_array) . $this->return_social_HTML('stream_bandcamp2', $tmp_db_resp_array) . $this->return_social_HTML('stream_bandcamp3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_spotify', $tmp_db_resp_array) . $this->return_social_HTML('stream_spotify2', $tmp_db_resp_array) . $this->return_social_HTML('stream_spotify3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_rolldabeats', $tmp_db_resp_array) . $this->return_social_HTML('stream_rolldabeats2', $tmp_db_resp_array) . $this->return_social_HTML('stream_rolldabeats3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_youtube', $tmp_db_resp_array) . $this->return_social_HTML('stream_youtube2', $tmp_db_resp_array) . $this->return_social_HTML('stream_youtube3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_www', $tmp_db_resp_array) . $this->return_social_HTML('stream_www2', $tmp_db_resp_array) . $this->return_social_HTML('stream_www3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_profile', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_archives', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_paypal', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_json', $tmp_db_resp_array) . '
                                    <div class="cb"></div>
                                </div>
                            </div>
                            <div class="colors_wrapper">
                                ' . $tmp_colors_html . '
                            </div>

                        </div>
                        <div class="colors_hr_wrapper"><div class="colors_hr"></div></div>
                        ';

                    }

                }

            }

        }

        if(count($tmp_query_ARRAY)>0){

            $this->dataBaseIntegration->bassdrive_serialize_streams($this, $this->oUserEnvironment, $tmp_query_ARRAY);

        }

        return $tmp_html;

    }

    private function return_stream_data_ARRAY($str){
        /*
        $tmp_stream_ARRAY['stream_flag_file_img'] = <img src="' . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/bassdrive_component_creative/' . $tmp_stream_ARRAY['stream_flag_file_img'] . '" width="' . $tmp_stream_ARRAY['flag_width'] . '" height="' . $tmp_stream_ARRAY['flag_height'] . '" alt="' . $tmp_stream_ARRAY['stream_city_state_prov_nation'] . '" title="National flag for ' . $tmp_stream_ARRAY['stream_city_state_prov_nation'] . '">
        $tmp_stream_ARRAY['stream_city_state_prov_nation'] = ATL, GA, USA
        $tmp_stream_ARRAY['live_or_replay'] = LIVE
        $tmp_stream_ARRAY['stream_key']
        */

        $tmp_stream_ARRAY = array();
        $tmp_stream_ARRAY['live_or_replay'] = 'LIVE';
        $tmp_stream_ARRAY['stream_flag_file_img'] = '&nbsp;';
        $tmp_stream_ARRAY['stream_city_state_prov_nation'] = '';

        $tmp_wrk_str = $str;
        $bassdrive_for_BOLD_RED = $this->return_LIVE_ARRAY();
        $bassdrive_find_HYPER_LNK = $this->return_HYPER_ARRAY();
        $bassdrive_replace_HYPER_LNK = $this->return_LINK_ARRAY();

        $bassdrive_month = $this->return_MONTH_ARRAY();
        $bassdrive_day = $this->return_DAY_ARRAY();
        $bassdrive_specialty = $this->return_specialty_ARRAY();
        $bassdrive_specialty_out = $this->return_specialty_output_ARRAY();
        $bassdrive_broadcast_nation = $this->return_broadcast_nation_association_ARRAY();

        $bassdrive_broadcast_social_ARRAY = $this->return_stream_social_association_ARRAY($str);

        $bassdrive_broadcast_flag = $this->return_nation_flag_ARRAY();
        //$bassdrive_broadcast_scroller_content = $this->return_broadcast_scroller_content_ARRAY();

        $tmp_LIVE_cnt = sizeof($bassdrive_for_BOLD_RED);
        $tmp_HYPER_cnt = sizeof($bassdrive_find_HYPER_LNK);
        $tmp_MONTH_cnt = sizeof($bassdrive_month);
        $tmp_DAY_cnt = sizeof($bassdrive_day);
        $tmp_SPECIAL_cnt = sizeof($bassdrive_specialty);
        $tmp_SPECIALOUT_cnt = sizeof($bassdrive_specialty_out);
        $tmp_bassdrive_broadcast_nation_cnt = sizeof($bassdrive_broadcast_nation);
        $has_flag = false;
        $tmp_broadcast_nation_flag = NULL;

        if(!isset($bassdrive_broadcast_social_ARRAY['stream_colors_filename'])){

            foreach($bassdrive_broadcast_nation as $show_str => $flag_img_filename){

                $pos = stripos($tmp_wrk_str, $show_str);
                if($pos !== false && $has_flag == false){

                    if(!isset($bassdrive_broadcast_social_ARRAY['stream_locale'])){

                        $bassdrive_broadcast_social_ARRAY = array();
                        //error_log(__LINE__ . ' user ['.print_r($bassdrive_broadcast_social_ARRAY['stream_locale'], true).']');
                        $bassdrive_broadcast_social_ARRAY['stream_locale'] = '';

                    }

                    $has_flag = true;
                    $tmp_broadcast_nation_flag = $flag_img_filename;
                    //$tmp_broadcast_scroller_content = $bassdrive_broadcast_scroller_content[$show_str];
                    $tmp_broadcast_scroller_content = $bassdrive_broadcast_social_ARRAY['stream_locale'];
                    $tmp_stream_ARRAY['stream_city_state_prov_nation'] = $tmp_broadcast_scroller_content;
                    $tmp_stream_ARRAY['stream_key'] = $show_str;

                }

            }

        }else{

            if(!isset($bassdrive_broadcast_social_ARRAY['stream_locale'])){

                $bassdrive_broadcast_social_ARRAY['stream_locale'] = '';

            }

            $has_flag = true;
            $tmp_broadcast_nation_flag = $bassdrive_broadcast_social_ARRAY['stream_colors_filename'];
            $tmp_broadcast_scroller_content = $bassdrive_broadcast_social_ARRAY['stream_locale'];
            $tmp_stream_ARRAY['stream_city_state_prov_nation'] = $tmp_broadcast_scroller_content;
            $tmp_stream_ARRAY['stream_key'] = $this->stream_key;

        }

        for($i=0;$i<$tmp_LIVE_cnt;$i++) {

            $tmp_LIVE_pattern = $bassdrive_for_BOLD_RED[$i];

            $pos = stripos($tmp_wrk_str, $tmp_LIVE_pattern);
            if($pos!==false){

                $tmp_LIVE_replace = '<span style="color:#F00; font-weight: bold;">' . $tmp_LIVE_pattern .'</span>';

                $tmp_wrk_str = $this->ptrn_replace($tmp_LIVE_pattern, $tmp_LIVE_replace, $tmp_wrk_str);

                $i = $tmp_LIVE_cnt+1;

            }

        }

        for($i=0;$i<$tmp_HYPER_cnt;$i++){

            $tmp_HYPER_pattern = $bassdrive_find_HYPER_LNK[$i];

            $pos = strpos($tmp_wrk_str, $tmp_HYPER_pattern);
            if($pos!==false){

                $tmp_wrk_str = $this->ptrn_replace($tmp_HYPER_pattern, $bassdrive_replace_HYPER_LNK[$i], $tmp_wrk_str);

                $i = 1000;
            }

        }

        $isLIVE = true;

        for($i=0; $i<$tmp_MONTH_cnt; $i++){

            for($ii=0; $ii<$tmp_DAY_cnt; $ii++){

                $tmp_date_pos = strpos($tmp_wrk_str, $bassdrive_month[$i].' '.$bassdrive_day[$ii]);
                if($tmp_date_pos !== false){

                    $tmp_wrk_str = $this->ptrn_replace($bassdrive_month[$i].' '.$bassdrive_day[$ii], '<span style="background-color: #CF0202; color:#FFF; font-size:11px; font-weight:normal; padding:1px 3px 1px 3px; border-radius: 15px;"><span style="color:#CF0202;">_</span> '.$bassdrive_month[$i].' '.$bassdrive_day[$ii].' :: REPLAY <span style="color:#CF0202;">_</span></span>', $tmp_wrk_str);
                    $i = $tmp_MONTH_cnt + 1;
                    $ii = $tmp_DAY_cnt + 1;
                    $isLIVE = false;
                    $tmp_stream_ARRAY['live_or_replay'] = 'REPLAY';

                }

            }

        }

        for($i=0; $i<$tmp_SPECIAL_cnt; $i++){

            $tmp_special_pos = strpos($tmp_wrk_str, $bassdrive_specialty[$i]);

            if($tmp_special_pos !== false){

                $tmp_wrk_str = $this->ptrn_replace($bassdrive_specialty[$i], $bassdrive_specialty_out[$i], $tmp_wrk_str);

                $i = $tmp_SPECIAL_cnt + 1;

            }

        }

        //error_log(__LINE__ . ' user '.$tmp_broadcast_nation_flag);
        if(isset($tmp_broadcast_nation_flag) && strlen($tmp_broadcast_nation_flag)>7){

            list($width, $height) = getimagesize($this->oUser->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT').$this->oUser->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT_DIR').'/common/imgs/bassdrive_component_creative/'.$tmp_broadcast_nation_flag);

            $tmp_stream_ARRAY['stream_flag_file_img'] = '<img src="' . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/bassdrive_component_creative/' . $tmp_broadcast_nation_flag . '" width="' . $width . '" height="' . $height . '" alt="' . $tmp_stream_ARRAY['stream_city_state_prov_nation'] . '" title="National flag for ' . $tmp_stream_ARRAY['stream_city_state_prov_nation'] . '">';

        }

        $tmp_stream_ARRAY['DATABASE_TRANSFER'] = $bassdrive_broadcast_social_ARRAY;

        return $tmp_stream_ARRAY;

    }

    private function applyProgramTitleFormatting($str){

        $tmp_wrk_str = $str;
        $bassdrive_for_BOLD_RED = $this->return_LIVE_ARRAY();
        $bassdrive_find_HYPER_LNK = $this->return_HYPER_ARRAY();
        $bassdrive_replace_HYPER_LNK = $this->return_LINK_ARRAY();

        $bassdrive_month = $this->return_MONTH_ARRAY();
        $bassdrive_day = $this->return_DAY_ARRAY();
        $bassdrive_specialty = $this->return_specialty_ARRAY();
        $bassdrive_specialty_out = $this->return_specialty_output_ARRAY();
        $bassdrive_broadcast_nation = $this->return_broadcast_nation_association_ARRAY();
        $bassdrive_broadcast_flag = $this->return_nation_flag_ARRAY();
        //$bassdrive_broadcast_scroller_content = $this->return_broadcast_scroller_content_ARRAY();

        $tmp_db_resp_array = $this->return_stream_social_association_ARRAY($str);

        $tmp_LIVE_cnt = sizeof($bassdrive_for_BOLD_RED);
        $tmp_HYPER_cnt = sizeof($bassdrive_find_HYPER_LNK);
        $tmp_MONTH_cnt = sizeof($bassdrive_month);
        $tmp_DAY_cnt = sizeof($bassdrive_day);
        $tmp_SPECIAL_cnt = sizeof($bassdrive_specialty);
        $tmp_SPECIALOUT_cnt = sizeof($bassdrive_specialty_out);
        $tmp_bassdrive_broadcast_nation_cnt = sizeof($bassdrive_broadcast_nation);
        $has_flag = false;
        $tmp_broadcast_nation_flag = NULL;

        foreach($bassdrive_broadcast_nation as $show_str => $flag_img_filename){

            $pos = stripos($tmp_wrk_str, $show_str);
            if($pos !== false && $has_flag == false){

                if(!isset($tmp_db_resp_array['stream_locale'])){

                    $tmp_db_resp_array['stream_locale'] = '';

                }

                $has_flag = true;
                $tmp_broadcast_nation_flag = $flag_img_filename;
                //$tmp_broadcast_scroller_content = $bassdrive_broadcast_scroller_content[$show_str];
                $tmp_broadcast_nation_title = $bassdrive_broadcast_flag[$flag_img_filename];

            }

        }

        for($i=0;$i<$tmp_LIVE_cnt;$i++) {

            $tmp_LIVE_pattern = $bassdrive_for_BOLD_RED[$i];

            $pos = stripos($tmp_wrk_str, $tmp_LIVE_pattern);
            if($pos!==false){

                $tmp_LIVE_replace = '<span style="color:#F00; font-weight: bold;">' . $tmp_LIVE_pattern .'</span>';

                $tmp_wrk_str = $this->ptrn_replace($tmp_LIVE_pattern, $tmp_LIVE_replace, $tmp_wrk_str);

                $i = $tmp_LIVE_cnt+1;

            }

        }

        for($i=0;$i<$tmp_HYPER_cnt;$i++){

            $tmp_HYPER_pattern = $bassdrive_find_HYPER_LNK[$i];

            $pos = strpos($tmp_wrk_str, $tmp_HYPER_pattern);
            if($pos!==false){

                $tmp_wrk_str = $this->ptrn_replace($tmp_HYPER_pattern, $bassdrive_replace_HYPER_LNK[$i], $tmp_wrk_str);

                //$i = 1000;
            }

        }

        $isLIVE = true;

        for($i=0; $i<$tmp_MONTH_cnt; $i++){

            for($ii=0; $ii<$tmp_DAY_cnt; $ii++){

                //error_log(__LINE__ .' bass - ['.$bassdrive_month[$i].' '.$bassdrive_day[$ii].']['..']');

                $tmp_date_pos = strpos($tmp_wrk_str, $bassdrive_month[$i].' '.$bassdrive_day[$ii]);
                if($tmp_date_pos !== false){

                    $tmp_wrk_str = $this->ptrn_replace($bassdrive_month[$i].' '.$bassdrive_day[$ii], '<span style="background-color: #CF0202; color:#FFF; font-size:11px; font-weight:normal; padding:1px 3px 1px 3px; border-radius: 15px;"><span style="color:#CF0202;">_</span> '.$bassdrive_month[$i].' '.$bassdrive_day[$ii].' :: REPLAY <span style="color:#CF0202;">_</span></span>', $tmp_wrk_str);
                    $i = $tmp_MONTH_cnt + 1;
                    $ii = $tmp_DAY_cnt + 1;
                    $isLIVE = false;

                }

            }

        }

        for($i=0; $i<$tmp_SPECIAL_cnt; $i++){

            $tmp_special_pos = strpos($tmp_wrk_str, $bassdrive_specialty[$i]);

            if($tmp_special_pos !== false){

                $tmp_wrk_str = $this->ptrn_replace($bassdrive_specialty[$i], $bassdrive_specialty_out[$i], $tmp_wrk_str);

                $i = $tmp_SPECIAL_cnt + 1;

            }

        }

        $tmp_array = array();

        if(isset($tmp_broadcast_nation_flag) && ($tmp_broadcast_nation_flag != 'flag_unknown.gif')){

            if($isLIVE == true){

                $tmp_broadcast_scroller = ':: BROADCASTING WORLDWIDE ';
                $tmp_broadcast_is_live = 'TRUE';

            }else{

                $tmp_broadcast_scroller = ':: BROADCASTED WORLDWIDE ';
                $tmp_broadcast_is_live = 'FALSE';

            }

            list($width, $height) = getimagesize($this->oUser->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT').$this->oUser->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT_DIR').'/common/imgs/bassdrive_component_creative/'.$tmp_broadcast_nation_flag);

            //error_log(__LINE__ . ' user ['.$tmp_db_resp_array['stream_locale'].']');
            $tmp_array['broadcast_nation'] = '<div id="broadcast_nation_wrapper">
                                            <div id="nation_colors_wrapper" class="nation_colors_wrapper"></div>
                                            <div id="bassdrive_broadcast_scroller_wrapper">
                                                <div id="bassdrive_broadcast_scroller_dyn_wrapper"></div>
                                                <div class="cb"></div>
                                            </div>
                                            <div class="hidden">
                                                <div id="bassdrive_broadcast_nation_thumb_width">'.$width.'</div>
                                                <div id="broadcast_show_original_title">'.html_entity_decode($str).'</div>
                                                <div id="broadcast_locale">'.$tmp_db_resp_array['stream_locale'].'</div>
                                                <div id="broadcast_nation_img">' . $tmp_broadcast_nation_flag . '</div>
                                                <div id="broadcast_nation_title">' . $tmp_broadcast_nation_title . '</div>
                                                <div id="broadcast_is_LIVE">'.$tmp_broadcast_is_live.'</div>
                                                <div id="component_tech_integration_driver">SERVER</div>
                                            </div>
                                            </div>';

        }else{

            $tmp_array['broadcast_nation'] = '';

        }

        $tmp_array['stream_info'] = $tmp_wrk_str;
        if(isset($tmp_broadcast_is_live)){

            $tmp_array['is_live'] = $tmp_broadcast_is_live;

        }else{

            $tmp_array['is_live'] = '';

        }

        return $tmp_array;

    }

    private function return_nation_flag_ARRAY(){

        $tmp_array = array();

        $tmp_array['flag_spain.gif'] = 'Spain';
        $tmp_array['flag_australia.gif'] = 'Australia';
        $tmp_array['flag_austria.gif'] = 'Austria';
        $tmp_array['flag_canada.gif'] = 'Canada';
        $tmp_array['flag_czech_republic.gif'] = 'Czech Republic';
        $tmp_array['flag_germany.gif'] = 'Germany';
        $tmp_array['flag_brazil.gif'] = 'Brazil';
        $tmp_array['flag_hungary.gif'] = 'Hungary';
        $tmp_array['flag_netherlands.gif'] = 'Netherlands';
        $tmp_array['flag_poland.gif'] = 'Poland';
        $tmp_array['flag_romania.gif'] = 'Romania';
        $tmp_array['flag_russia.gif'] = 'Russia';
        $tmp_array['flag_thailand.gif'] = 'Thailand';
        $tmp_array['flag_united_kingdom.gif'] = 'United Kingdom';
        $tmp_array['flag_united_states_of_america.gif'] = 'United States of America';
        $tmp_array['flag_unknown.gif'] = 'unknown';

        return $tmp_array;

    }

    private function return_stream_string_pattern_key_ARRAY(){

        $tmp_array = array();

        $tmp_array['Fuzed Funk'] = 'Fuzed Funk';
        $tmp_array['Jason Magin'] = 'Fuzed Funk';
        $tmp_array['BRYAN GEE'] = 'BRYAN GEE';
        $tmp_array['BRYANGEE'] = 'BRYAN GEE';
        $tmp_array['Audiofields'] = 'Audiofields';
        $tmp_array['Simplification'] = 'Simplification';
        $tmp_array['Melinki'] = 'Melinki';
        $tmp_array['Disturbo'] = 'Disturbo';
        $tmp_array['Redex'] = 'Redex';
        $tmp_array['Blind Judge'] = 'Blind Judge';
        $tmp_array['Rodney Rolls'] = 'Rodney Rolls';
        $tmp_array['Mod Con'] = 'Mod Con';
        $tmp_array['DJ ANDY'] = 'DJ ANDY';
        $tmp_array['BASS GO BOOM'] = 'DJ ANDY';
        $tmp_array['Bumblebee'] = 'Bumblebee';
        $tmp_array['Insideman'] = 'Insideman';
        $tmp_array['On:Ward'] = 'On:Ward';
        $tmp_array['Onward Show'] = 'On:Ward';
        $tmp_array['Fokuz Recordings'] = 'Fokuz Recordings';
        $tmp_array['STAMINA Radio'] = 'STAMINA Radio';
        $tmp_array['Launch in Session'] = 'Launch in Session';
        $tmp_array['Balearic'] = 'Balearic';
        $tmp_array['Bankbeats'] = 'Bankbeats';
        $tmp_array['Sweetpea'] = 'Sweetpea';
        $tmp_array['AudioDevice'] = 'AudioDevice';
        $tmp_array['Prague Connection'] = 'Prague Connection';
        $tmp_array['Subfactory'] = 'Subfactory';
        $tmp_array['Vital Habits'] = 'Vital Habits';
        $tmp_array['TRANSLATION SOUND'] = 'TRANSLATION SOUND';
        $tmp_array['Wadjit'] = 'Wadjit';
        $tmp_array['PROMO ZO'] = 'PROMO ZO';
        $tmp_array['DrumObsession'] = 'DrumObsession';
        $tmp_array['Skeptics'] = 'Skeptics';
        $tmp_array['BERLIN BASS'] = 'BERLIN BASS';
        $tmp_array['SCIENTIFIC RADIO'] = 'SCIENTIFIC RADIO';
        $tmp_array['NIGHT GROOVES'] = 'NIGHT GROOVES';
        $tmp_array['XPOSURE'] = 'XPOSURE';
        $tmp_array['Ben XO'] = 'XPOSURE';
        $tmp_array['Sohl'] = 'Sohl';
        $tmp_array['River City'] = 'River City';
        $tmp_array['Ill Omen'] = 'Ill Omen';
        $tmp_array['Atmospheric Alignments'] = 'Atmospheric Alignments';
        $tmp_array['Skanka'] = 'Skanka';
        $tmp_array['Northern Groove'] = 'Northern Groove';
        $tmp_array['Soulsmith'] = 'Northern Groove';
        $tmp_array['GREENROOM'] = 'GREENROOM';
        $tmp_array['Random Movement'] = 'Random Movement';
        $tmp_array['Mike Random'] = 'Random Movement';
        $tmp_array['Strictly Science'] = 'Strictly Science';
        $tmp_array['Circuitry'] = 'Circuitry';
        $tmp_array['Method One'] = 'Method One';
        $tmp_array['Power Rinse'] = 'Power Rinse';
        $tmp_array['EvanTheScientist'] = 'Power Rinse';
        $tmp_array['Trainspotting'] = 'Trainspotting';
        $tmp_array['Amnesty'] = 'Trainspotting';
        $tmp_array['A Sides'] = 'A Sides';
        $tmp_array['Eastside Sessions'] = 'A Sides';
        $tmp_array['Invaderz'] = 'Invaderz';
        $tmp_array['Saphir'] = 'Saphir';
        $tmp_array['Jay Rome'] = 'Saphir';
        $tmp_array['Funked Up'] = 'Funked Up';
        $tmp_array['DFunk'] = 'DFunk';
        $tmp_array['Ashatack'] = 'Ashatack';
        $tmp_array['Ebb & Flow'] = 'Ebb & Flow';
        $tmp_array['Optx'] = 'Ebb & Flow';
        $tmp_array['Impressions'] = 'Impressions';
        $tmp_array['Indentation'] = 'Impressions';
        $tmp_array['Australian Atmospherics'] = 'Australian Atmospherics';
        $tmp_array['Operon'] = 'Australian Atmospherics';
        $tmp_array['Vibration Sessions'] = 'Vibration Sessions';
        $tmp_array['Deep Soul'] = 'Deep Soul';
        $tmp_array['Donovan'] = 'Deep Soul';
        $tmp_array['ECLIPS3'] = 'ECLIPS3';
        $tmp_array['LQD'] = 'ECLIPS3';
        $tmp_array['Represent Radio'] = 'Represent Radio';
        $tmp_array['Squake'] = 'Squake';
        $tmp_array['SixOneOh'] = 'SixOneOh';
        $tmp_array['Resistance Radio'] = 'Resistance Radio';
        $tmp_array['John Ohms'] = 'Resistance Radio';
        $tmp_array['Phuture'] = 'Phuture';
        $tmp_array['Overfiend'] = 'Overfiend';
        $tmp_array['Hangover'] = 'Hangover';
        $tmp_array['Lamebrane'] = 'Hangover';
        $tmp_array['Schematic'] = 'Schematic';
        $tmp_array['Crucial X'] = 'Crucial X';
        $tmp_array['Spacefunk'] = 'Crucial X';
        $tmp_array['Deceit FM'] = 'Deceit FM';
        $tmp_array['Buzzy'] = 'Deceit FM';
        $tmp_array['LJHigh'] = 'LJHigh';
        $tmp_array['High Definition'] = 'LJHigh';
        $tmp_array['Warm Ears'] = 'Warm Ears';
        $tmp_array['Lab Sessions'] = 'Lab Sessions';
        $tmp_array['Incisive Rhythm'] = 'Incisive Rhythm';
        $tmp_array['Awake247'] = 'Awake247';
        $tmp_array['Awake FM'] = 'Awake247';
        $tmp_array['AwakeFM'] = 'Awake247';

        $tmp_array['Subtext'] = 'Subtext';
        $tmp_array['Phlage'] = 'Phlage';
        $tmp_array['Lost Content'] = 'Lost Content';
        $tmp_array['Tehace'] = 'Tehace';
        $tmp_array['Pyxis'] = 'Pyxis';
        $tmp_array['Aras'] = 'Aras';
        $tmp_array['Slider'] = 'Slider';

        //$tmp_array = $this->dataBaseIntegration->return_stream_string_pattern($this, $this->oUserEnvironment, 'return_stream_string_pattern');

        return $tmp_array;

    }

    private function return_stream_social_meta_ARRAY($str){

        $tmp_stream_ARRAY = array();
        //$tmp_stream_ARRAY['stream_flag_file_img'] = '';
        //$tmp_stream_ARRAY['stream_city_state_prov_nation'] = '';

        // xxxxx[0] = 'flag_united_kingdom.gif'
        $bassdrive_broadcast_nation_img_file_ARRAY = $this->return_broadcast_nation_association_ARRAY();

        $bassdrive_broadcast_flag_nomination_ARRAY = $this->return_nation_flag_ARRAY();

        $tmp_db_resp_array = $this->return_stream_social_association_ARRAY($str);
        //$bassdrive_broadcast_city_state_prov_nation_ARRAY = $this->return_broadcast_scroller_content_ARRAY();

        //$tmp_bassdrive_broadcast_nation_cnt = sizeof($bassdrive_broadcast_nation_img_file_ARRAY);
        $has_flag = false;

        foreach($bassdrive_broadcast_nation_img_file_ARRAY as $show_str => $flag_img_filename){

            $pos = stripos($str, $show_str);
            if($pos !== false && $has_flag == false){

                if(!isset($tmp_db_resp_array['stream_locale'])){

                    $tmp_db_resp_array['stream_locale'] = '';

                }

                $has_flag = true;
                $tmp_stream_ARRAY['stream_flag_file_img'] = $flag_img_filename;
                $tmp_stream_ARRAY['stream_flag_nomination'] = $bassdrive_broadcast_flag_nomination_ARRAY[$flag_img_filename];
                $tmp_stream_ARRAY['stream_city_state_prov_nation'] = $tmp_db_resp_array['stream_locale'];
                $tmp_stream_ARRAY['stream_pattern_string'] = $show_str;

            }

        }

        if(isset($tmp_stream_ARRAY['stream_flag_file_img'])){

            list($width, $height) = getimagesize($this->oUser->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT').$this->oUser->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT_DIR').'/common/imgs/bassdrive_component_creative/'.$tmp_stream_ARRAY['stream_flag_file_img']);

            $tmp_stream_ARRAY['stream_flag_img_width'] = $width;
            $tmp_stream_ARRAY['stream_flag_img_height'] = $height;

        }

        return $tmp_stream_ARRAY;

    }

    public function refresh_pattern_string_length(){

        return $this->dataBaseIntegration->refresh_pattern_string_length($this, $this->oUserEnvironment, 'refresh_pattern_string_length');

    }

    public function process_stream_title($pattern, $json_serial){

        $tmp_resp = array();

        // WHERE $tmp_ptrn_ARRAY[STRING_PATTERN] = STRING_KEY
        // WHERE $tmp_len_ARRAY[STRING_PATTERN] = STRING_LENGTH
        // AND WHERE $tmp_stream_key_ARRAY['PATTERN'] = $tmp_ptrn_ARRAY;
        // AND WHERE $tmp_stream_key_ARRAY['LENGTH'] = $tmp_len_ARRAY;

        $tmp_stream_key_ARRAY = $this->return_stream_string_pattern_key_ARRAY();
        $tmp_meta_array = $this->return_stream_social_meta_ARRAY($pattern);

        $tmp_pattern_ARRAY = $tmp_stream_key_ARRAY['PATTERN'];
        $tmp_len_ARRAY = $tmp_stream_key_ARRAY['LENGTH'];



        $tmp_stream_key = $tmp_pattern_ARRAY[$tmp_meta_array['stream_pattern_string']];
        error_log(__LINE__ . ' user [$pattern='.$pattern.'][$tmp_stream_key='.$tmp_stream_key.']['. print_r($tmp_meta_array, true).']');

        $this->stream_key = $tmp_stream_key;

        if(isset($tmp_meta_array['stream_flag_file_img'])){

            $tmp_resp['COLORS_NAME_KEY'][$tmp_stream_key]['COLORS_IMG_FILENAME'] = $tmp_meta_array['stream_flag_file_img'];
            $tmp_resp['COLORS_NAME_KEY'][$tmp_stream_key]['COLORS_NOMINATION'] = $tmp_meta_array['stream_flag_nomination'];
            $tmp_resp['COLORS_NAME_KEY'][$tmp_stream_key]['COLORS_IMG_WIDTH'] = $tmp_meta_array['stream_flag_img_width'];
            $tmp_resp['COLORS_NAME_KEY'][$tmp_stream_key]['COLORS_IMG_HEIGHT'] = $tmp_meta_array['stream_flag_img_height'];
            $tmp_resp['STREAM_KEY'][$tmp_stream_key]['LOCALE_CITY_STATE_PROV_NATION'] = $tmp_meta_array['stream_city_state_prov_nation'];

        }

        $tmp_resp['STREAM_KEY'][$tmp_stream_key]['LOG_JSON_SERIAL'] = $json_serial;

        /*
        ########
        bassdrive_stream
        STREAM_ID                       char(64)
        ISACTIVE                        tinyint(2)
        *STREAM_KEY                      varchar(255)
        *COLORS_NAME_KEY                 varchar(100)
        */

        $this->stream_meta_ARRAY = $tmp_resp;
        $this->stream_pattern_ARRAY = $tmp_stream_key_ARRAY;

        $tmp_resp_BOOL = $this->dataBaseIntegration->bassdrive_stream_initialization($this, $this->oUserEnvironment, 'bassdrive_stream_initialization');

//        if($tmp_resp_BOOL){
//
//            error_log(__LINE__ .' user SUCCESS bassdrive_stream ADD.');
//
//        }else{
//
//            error_log(__LINE__ .' user NO bassdrive_stream ADD.');
//
//        }

        /*
         bassdrive_stream_lookup
         STREAM_LOOKUP_ID                char(64)
         ISACTIVE                        tinyint(2)
        *STREAM_KEY                      varchar(255)
        *STREAM_KEY_CRC32

        *STREAM_STRING_PATTERN           varchar(300)
        */
        $tmp_resp_BOOL = $this->dataBaseIntegration->bassdrive_stream_lookup_sync($this, $this->oUserEnvironment, 'bassdrive_stream_lookup_sync');

//        if($tmp_resp_BOOL){
//
//            error_log(__LINE__ .' user SUCCESS bassdrive_stream_lookup ADD.');
//
//        }else{
//
//            error_log(__LINE__ .' user NO bassdrive_stream_lookup ADD.');
//
//        }

        /*
        bassdrive_stream_colors
        COLORS_ID                       char(64)
        *COLORS_NAME_KEY                 varchar(100)
        COLORS_NAME_KEY_CRC32           int(11)
        ISACTIVE                        tinyint(2)
        *COLORS_IMG_FILENAME             varchar(100)
        *COLORS_IMG_WIDTH                int(11)
        *COLORS_IMG_HEIGHT               int(11)
         * */
        $tmp_resp_BOOL = $this->dataBaseIntegration->bassdrive_stream_colors_sync($this, $this->oUserEnvironment, 'bassdrive_stream_colors_sync');

//        if($tmp_resp_BOOL){
//
//            error_log(__LINE__ .' user SUCCESS bassdrive_stream_colors_sync ADD.');
//
//        }else{
//
//            error_log(__LINE__ .' user NO bassdrive_stream_colors_sync ADD.');
//
//        }

        /*
        ########
        bassdrive_stream_social_config
        SOCIAL_ID                       char(64)
        *LOG_JSON_SERIAL                 char(64)
        *STREAM_KEY                      varchar(255)
        STREAM_KEY_CRC32                varchar(255)
        ISACTIVE                        tinyint(2)
        *LOCALE_CITY_STATE_PROV_NATION   varchar(255)

        */

        $tmp_resp_BOOL = $this->dataBaseIntegration->bassdrive_stream_social_sync($this, $this->oUserEnvironment, 'bassdrive_stream_social_sync');

//        if($tmp_resp_BOOL){
//
//            error_log(__LINE__ .' user SUCCESS bassdrive_stream_social_sync ADD.');
//
//        }else{
//
//            error_log(__LINE__ .' user NO bassdrive_stream_social_sync ADD.');
//
//        }

        return true;

    }

    public function return_stream_pattern_ARRAY(){

        /*
            INPUT ::  $this->stream_pattern_ARRAY;
            $tmp_ptrn_array['Lab Sessions'] = 'Lab Sessions';
            $tmp_ptrn_array['Incisive Rhythm'] = 'Incisive Rhythm';
            $tmp_ptrn_array['Awake247'] = 'Awake247';
            $tmp_ptrn_array['Awake FM'] = 'Awake247';
            $tmp_ptrn_array['AwakeFM'] = 'Awake247';

            $tmp_len_array['Lab Sessions'] = 9;
            $tmp_len_array['Incisive Rhythm'] = 6;
            $tmp_len_array['Awake247'] = 6;
            $tmp_len_array['Awake FM'] = 6;
            $tmp_len_array['AwakeFM'] = 6;

            OUTPUT ::
            $tmp_output_array['PATTERN']=$tmp_ptrn_array
            $tmp_output_array['LENGTH']=$tmp_len_array


            WHERE ::
            $tmp_array[SEARCH_STRING_PATTERN] = STREAM_KEY;

         * */

        $stream_pattern_ARRAY = $this->stream_pattern_ARRAY['PATTERN'];
        $tmp_array = array();
        foreach($stream_pattern_ARRAY as $pattern => $key_value){

            $tmp_array[$pattern] = $key_value;

        }

        return $tmp_array;

    }


//
//    private function return_broadcast_scroller_content_ARRAY(){
//
//        $broadcast_scroller_content_ARRAY = array();
//
//        $broadcast_scroller_content_ARRAY['Fuzed Funk'] = 'WILMINGTON, DE, USA';
//        $broadcast_scroller_content_ARRAY['Jason Magin'] = 'WILMINGTON, DE, USA';
//        $broadcast_scroller_content_ARRAY['Jay Dubz'] = 'SHREWSBURY, UK';
//        $broadcast_scroller_content_ARRAY['BRYAN GEE'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['BRYANGEE'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['Audiofields'] = 'PROVIDENCE, RHODE ISLAND, USA';
//        $broadcast_scroller_content_ARRAY['Simplification'] = 'S&Atilde;O PAULO, BRAZIL';
//        $broadcast_scroller_content_ARRAY['Melinki'] = 'HASTINGS, UK';
//        $broadcast_scroller_content_ARRAY['Disturbo'] = 'VIENNA, AUSTRIA';
//        $broadcast_scroller_content_ARRAY['Redex'] = 'VIENNA, AUSTRIA';
//        $broadcast_scroller_content_ARRAY['Blind Judge'] = 'VIENNA, AUSTRIA';
//        $broadcast_scroller_content_ARRAY['Mod Con'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['Rodney Rolls'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['DJ ANDY'] = 'S&Atilde;O PAULO, BRAZIL';
//        $broadcast_scroller_content_ARRAY['BASS GO BOOM'] = 'S&Atilde;O PAULO, BRAZIL';
//        $broadcast_scroller_content_ARRAY['Bumblebee'] = 'BERLIN, GERMANY';
//        $broadcast_scroller_content_ARRAY['Insideman'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['On:Ward'] = 'SHREWSBURY, UK';
//        $broadcast_scroller_content_ARRAY['Onward Show'] = 'SHREWSBURY, UK';
//        $broadcast_scroller_content_ARRAY['Fokuz Recordings'] = 'ROTTERDAM, NETHERLANDS';
//        $broadcast_scroller_content_ARRAY['STAMINA Radio'] = 'SAN FRANCISCO, CA, USA';
//        $broadcast_scroller_content_ARRAY['Launch in Session'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['Balearic'] = 'IBIZA, SPAIN';
//        $broadcast_scroller_content_ARRAY['Bankbeats'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['Sweetpea'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['AudioDevice'] = 'VIENNA, AUSTRIA';
//        $broadcast_scroller_content_ARRAY['Prague Connection'] = 'RICANY, CZECH REPUBLIC';
//        $broadcast_scroller_content_ARRAY['Subfactory'] = 'JERSEY, UK';
//        $broadcast_scroller_content_ARRAY['Vital Habits'] = 'TIMISOARA, ROMANIA';
//        $broadcast_scroller_content_ARRAY['TRANSLATION SOUND'] = 'WASHINGTON, DC, USA';
//        $broadcast_scroller_content_ARRAY['Wadjit'] = 'EDMONTON, AB, CANADA';
//        $broadcast_scroller_content_ARRAY['PROMO ZO'] = 'KENT, UK';
//        $broadcast_scroller_content_ARRAY['DrumObsession'] = 'POZNAN, POLAND';
//        $broadcast_scroller_content_ARRAY['Skeptics'] = 'BIRMINGHAM, UK';
//        $broadcast_scroller_content_ARRAY['BERLIN BASS'] = 'BERLIN, GERMANY';
//        $broadcast_scroller_content_ARRAY['SCIENTIFIC RADIO'] = 'UTRECHT, NETHERLANDS';
//        $broadcast_scroller_content_ARRAY['NIGHT GROOVES'] = 'ST. PETERSBURG, RUSSIA';
//        $broadcast_scroller_content_ARRAY['XPOSURE'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['Ben XO'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['Sohl'] = 'WHITE PLAINS, NY, USA';
//        $broadcast_scroller_content_ARRAY['River City'] = 'RICHMOND, VA, USA';
//        $broadcast_scroller_content_ARRAY['Ill Omen'] = 'RICHMOND, VA, USA';
//        $broadcast_scroller_content_ARRAY['Atmospheric Alignments'] = 'TULSA, OK, USA';
//        $broadcast_scroller_content_ARRAY['Skanka'] = 'TULSA, OK, USA';
//        $broadcast_scroller_content_ARRAY['Northern Groove'] = 'OLD TRAFFORD, MANCHESTER, UK';
//        $broadcast_scroller_content_ARRAY['Soulsmith'] = 'OLD TRAFFORD, MANCHESTER, UK';
//        $broadcast_scroller_content_ARRAY['GREENROOM'] = 'CHICAGO, IL, USA';
//        $broadcast_scroller_content_ARRAY['Random Movement'] = 'ORLANDO, FL, USA';
//        $broadcast_scroller_content_ARRAY['Mike Random'] = 'ORLANDO, FL, USA';
//        $broadcast_scroller_content_ARRAY['Strictly Science'] = 'AUSTIN, TX, USA';
//        $broadcast_scroller_content_ARRAY['Circuitry'] = 'SAN FRANCISCO, CA, USA';
//        $broadcast_scroller_content_ARRAY['Method One'] = 'SAN FRANCISCO, CA, USA';
//        $broadcast_scroller_content_ARRAY['Power Rinse'] = 'TORONTO, CANADA';
//        $broadcast_scroller_content_ARRAY['EvanTheScientist'] = 'TORONTO, CANADA';
//        $broadcast_scroller_content_ARRAY['Trainspotting'] = 'BANGKOK, THAILAND';
//        $broadcast_scroller_content_ARRAY['Amnesty'] = 'BANGKOK, THAILAND';
//        $broadcast_scroller_content_ARRAY['A Sides'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['Eastside Sessions'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['Invaderz'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['Saphir'] = 'VIENNA, AUSTRIA';
//        $broadcast_scroller_content_ARRAY['Jay Rome'] = 'VIENNA, AUSTRIA';
//        $broadcast_scroller_content_ARRAY['Funked Up'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['DFunk'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['Ashatack'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['Ebb & Flow'] = 'AUSTIN, TX, USA';
//        $broadcast_scroller_content_ARRAY['Optx'] = 'AUSTIN, TX, USA';
//        $broadcast_scroller_content_ARRAY['Impressions'] = 'SAN DIEGO, CA, USA';
//        $broadcast_scroller_content_ARRAY['Indentation'] = 'SAN DIEGO, CA, USA';
//        $broadcast_scroller_content_ARRAY['Australian Atmospherics'] = 'BRISBANE, AUSTRALIA';
//        $broadcast_scroller_content_ARRAY['Operon'] = 'BRISBANE, AUSTRALIA';
//        $broadcast_scroller_content_ARRAY['Vibration Sessions'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['Deep Soul'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['Donovan'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['ECLIPS3'] = 'BUDAPEST, HUNGARY';
//        $broadcast_scroller_content_ARRAY['LQD'] = 'BUDAPEST, HUNGARY';
//        $broadcast_scroller_content_ARRAY['Represent Radio'] = 'NASHVILLE, TN, USA';
//        $broadcast_scroller_content_ARRAY['Squake'] = 'NASHVILLE, TN, USA';
//        $broadcast_scroller_content_ARRAY['SixOneOh'] = 'LEHIGH VALLEY, PA, USA';
//        $broadcast_scroller_content_ARRAY['Resistance Radio'] = 'EDMONTON, AB, CANADA';
//        $broadcast_scroller_content_ARRAY['John Ohms'] = 'EDMONTON, AB, CANADA';
//        $broadcast_scroller_content_ARRAY['Phuture'] = 'MOSCOW, RUSSIA';
//        $broadcast_scroller_content_ARRAY['Overfiend'] = 'NEW YORK, NY, USA';
//        $broadcast_scroller_content_ARRAY['Hangover'] = 'CHICAGO, IL, USA';
//        $broadcast_scroller_content_ARRAY['Lamebrane'] = 'CHICAGO, IL, USA';
//        $broadcast_scroller_content_ARRAY['Schematic'] = 'ALMONTE, ONTARIO, CANADA';
//        $broadcast_scroller_content_ARRAY['Crucial X'] = 'SACRAMENTO, CA, USA';
//        $broadcast_scroller_content_ARRAY['Spacefunk'] = 'SACRAMENTO, CA, USA';
//        $broadcast_scroller_content_ARRAY['Deceit FM'] = 'PERTH, AUSTRALIA';
//        $broadcast_scroller_content_ARRAY['Buzzy'] = 'PERTH, AUSTRALIA';
//        $broadcast_scroller_content_ARRAY['LJHigh'] = 'COVENTRY, UK';
//        $broadcast_scroller_content_ARRAY['High Definition'] = 'COVENTRY, UK';
//        $broadcast_scroller_content_ARRAY['Warm Ears'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['Lab Sessions'] = 'ORLANDO, FL, USA';
//        $broadcast_scroller_content_ARRAY['Incisive Rhythm'] = 'DETROIT, MI, USA';
//        $broadcast_scroller_content_ARRAY['Awake247'] = 'ALBANY, NY, USA';
//        $broadcast_scroller_content_ARRAY['Awake FM'] = 'ALBANY, NY, USA';
//        $broadcast_scroller_content_ARRAY['AwakeFM'] = 'ALBANY, NY, USA';
//
//        $broadcast_scroller_content_ARRAY['Subtext'] = '';
//        $broadcast_scroller_content_ARRAY['Phlage'] = '';
//        $broadcast_scroller_content_ARRAY['Lost Content'] = '';
//        $broadcast_scroller_content_ARRAY['Tehace'] = '';
//        $broadcast_scroller_content_ARRAY['Pyxis'] = '';
//        $broadcast_scroller_content_ARRAY['Aras'] = '';
//        $broadcast_scroller_content_ARRAY['Slider'] = '';
//
//        return $broadcast_scroller_content_ARRAY;
//
//    }

    private function return_broadcast_nation_association_ARRAY(){

        $tmp_array = array();

        $tmp_array['Fuzed Funk'] = 'flag_united_states_of_america.gif';
        $tmp_array['Jason Magin'] = 'flag_united_states_of_america.gif';
        $tmp_array['Jay Dubz'] = 'flag_united_kingdom.gif';
        $tmp_array['BRYAN GEE'] = 'flag_united_kingdom.gif';
        $tmp_array['BRYANGEE'] = 'flag_united_kingdom.gif';
        $tmp_array['Audiofields'] = 'flag_united_states_of_america.gif';
        $tmp_array['Simplification'] = 'flag_brazil.gif';
        $tmp_array['Melinki'] = 'flag_united_kingdom.gif';
        $tmp_array['Disturbo'] = 'flag_austria.gif';
        $tmp_array['Redex'] = 'flag_austria.gif';
        $tmp_array['Blind Judge'] = 'flag_austria.gif';
        $tmp_array['Rodney Rolls'] = 'flag_united_kingdom.gif';
        $tmp_array['Mod Con'] = 'flag_united_kingdom.gif';
        $tmp_array['DJ ANDY'] = 'flag_brazil.gif';
        $tmp_array['BASS GO BOOM'] = 'flag_brazil.gif';
        $tmp_array['Bumblebee'] = 'flag_germany.gif';
        $tmp_array['Insideman'] = 'flag_united_kingdom.gif';
        $tmp_array['On:Ward'] = 'flag_united_kingdom.gif';
        $tmp_array['Onward Show'] = 'flag_united_kingdom.gif';
        $tmp_array['Fokuz Recordings'] = 'flag_netherlands.gif';
        $tmp_array['STAMINA Radio'] = 'flag_united_states_of_america.gif';
        $tmp_array['Launch in Session'] = 'flag_united_kingdom.gif';
        $tmp_array['Balearic'] = 'flag_spain.gif';
        $tmp_array['Bankbeats'] = 'flag_united_kingdom.gif';
        $tmp_array['Sweetpea'] = 'flag_united_kingdom.gif';
        $tmp_array['AudioDevice'] = 'flag_austria.gif';
        $tmp_array['Prague Connection'] = 'flag_czech_republic.gif';
        $tmp_array['Subfactory'] = 'flag_united_kingdom.gif';
        $tmp_array['Vital Habits'] = 'flag_romania.gif';
        $tmp_array['TRANSLATION SOUND'] = 'flag_united_states_of_america.gif';
        $tmp_array['Wadjit'] = 'flag_canada.gif';
        $tmp_array['PROMO ZO'] = 'flag_united_kingdom.gif';
        $tmp_array['DrumObsession'] = 'flag_poland.gif';
        $tmp_array['Skeptics'] = 'flag_united_kingdom.gif';
        $tmp_array['BERLIN BASS'] = 'flag_germany.gif';
        $tmp_array['SCIENTIFIC RADIO'] = 'flag_netherlands.gif';
        $tmp_array['NIGHT GROOVES'] = 'flag_russia.gif';
        $tmp_array['XPOSURE'] = 'flag_united_kingdom.gif';
        $tmp_array['Ben XO'] = 'flag_united_kingdom.gif';
        $tmp_array['Sohl'] = 'flag_united_states_of_america.gif';
        $tmp_array['River City'] = 'flag_united_states_of_america.gif';
        $tmp_array['Ill Omen'] = 'flag_united_states_of_america.gif';
        $tmp_array['Atmospheric Alignments'] = 'flag_united_states_of_america.gif';
        $tmp_array['Skanka'] = 'flag_united_states_of_america.gif';
        $tmp_array['Northern Groove'] = 'flag_united_kingdom.gif';
        $tmp_array['Soulsmith'] = 'flag_united_kingdom.gif';
        $tmp_array['GREENROOM'] = 'flag_united_states_of_america.gif';
        $tmp_array['Random Movement'] = 'flag_united_states_of_america.gif';
        $tmp_array['Mike Random'] = 'flag_united_states_of_america.gif';
        $tmp_array['Strictly Science'] = 'flag_united_states_of_america.gif';
        $tmp_array['Circuitry'] = 'flag_united_states_of_america.gif';
        $tmp_array['Method One'] = 'flag_united_states_of_america.gif';
        $tmp_array['Power Rinse'] = 'flag_canada.gif';
        $tmp_array['EvanTheScientist'] = 'flag_canada.gif';
        $tmp_array['Trainspotting'] = 'flag_thailand.gif';
        $tmp_array['Amnesty'] = 'flag_thailand.gif';
        $tmp_array['A Sides'] = 'flag_united_kingdom.gif';
        $tmp_array['Eastside Sessions'] = 'flag_united_kingdom.gif';
        $tmp_array['Invaderz'] = 'flag_united_kingdom.gif';
        $tmp_array['Saphir'] = 'flag_austria.gif';
        $tmp_array['Jay Rome'] = 'flag_austria.gif';
        $tmp_array['IAmDoomed'] = 'flag_austria.gif';
        $tmp_array['Funked Up'] = 'flag_united_kingdom.gif';
        $tmp_array['DFunk'] = 'flag_united_kingdom.gif';
        $tmp_array['Ashatack'] = 'flag_united_kingdom.gif';
        $tmp_array['Ebb & Flow'] = 'flag_united_states_of_america.gif';
        $tmp_array['Optx'] = 'flag_united_states_of_america.gif';
        $tmp_array['Impressions'] = 'flag_united_states_of_america.gif';
        $tmp_array['Indentation'] = 'flag_united_states_of_america.gif';
        $tmp_array['Australian Atmospherics'] = 'flag_australia.gif';
        $tmp_array['Operon'] = 'flag_australia.gif';
        $tmp_array['Vibration Sessions'] = 'flag_united_kingdom.gif';
        $tmp_array['Deep Soul'] = 'flag_united_kingdom.gif';
        $tmp_array['Donovan'] = 'flag_united_kingdom.gif';
        $tmp_array['ECLIPS3'] = 'flag_hungary.gif';
        $tmp_array['LQD'] = 'flag_hungary.gif';
        $tmp_array['Represent Radio'] = 'flag_united_states_of_america.gif';
        $tmp_array['Squake'] = 'flag_united_states_of_america.gif';
        $tmp_array['SixOneOh'] = 'flag_united_states_of_america.gif';
        $tmp_array['Resistance Radio'] = 'flag_canada.gif';
        $tmp_array['John Ohms'] = 'flag_canada.gif';
        $tmp_array['Phuture'] = 'flag_russia.gif';
        $tmp_array['Overfiend'] = 'flag_united_states_of_america.gif';
        $tmp_array['Hangover'] = 'flag_united_states_of_america.gif';
        $tmp_array['Lamebrane'] = 'flag_united_states_of_america.gif';
        $tmp_array['Schematic'] = 'flag_canada.gif';
        $tmp_array['Crucial X'] = 'flag_united_states_of_america.gif';
        $tmp_array['Spacefunk'] = 'flag_united_states_of_america.gif';
        $tmp_array['Deceit FM'] = 'flag_australia.gif';
        $tmp_array['Buzzy'] = 'flag_australia.gif';
        $tmp_array['LJHigh'] = 'flag_united_kingdom.gif';
        $tmp_array['High Definition'] = 'flag_united_kingdom.gif';
        $tmp_array['Warm Ears'] = 'flag_united_kingdom.gif';
        $tmp_array['Lab Sessions'] = 'flag_united_states_of_america.gif';
        $tmp_array['Incisive Rhythm'] = 'flag_united_states_of_america.gif';
        $tmp_array['Awake247'] = 'flag_united_states_of_america.gif';
        $tmp_array['Awake FM'] = 'flag_united_states_of_america.gif';
        $tmp_array['AwakeFM'] = 'flag_united_states_of_america.gif';

        $tmp_array['Subtext'] = 'flag_unknown.gif';
        $tmp_array['Phlage'] = 'flag_unknown.gif';
        $tmp_array['Lost Content'] = 'flag_unknown.gif';
        $tmp_array['Tehace'] = 'flag_unknown.gif';
        $tmp_array['Pyxis'] = 'flag_unknown.gif';
        $tmp_array['Aras'] = 'flag_unknown.gif';
        $tmp_array['Slider'] = 'flag_unknown.gif';

        return $tmp_array;

    }

    private function return_LIVE_ARRAY(){

        $tmp_array = array();

        $tmp_array[] = ' LIVE';
        $tmp_array[] = ' Live ';
        $tmp_array[] = ' live ';
        $tmp_array[] = 'LIVE!!!';
        $tmp_array[] = ' LIVE!';
        $tmp_array[] = 'LIVE!';
        $tmp_array[] = 'Live!!';
        $tmp_array[] = 'Live!';
        $tmp_array[] = '*LIVE*';
        $tmp_array[] = 'Live';

        return $tmp_array;

    }

    private function return_MONTH_ARRAY(){

        $tmp_array = array();

        $tmp_array[] = 'Jan';
        $tmp_array[] = 'Feb';
        $tmp_array[] = 'Mar';
        $tmp_array[] = 'Apr';
        $tmp_array[] = 'May';
        $tmp_array[] = 'Jun';
        $tmp_array[] = 'Jul';
        $tmp_array[] = 'Aug';
        $tmp_array[] = 'Sept';
        $tmp_array[] = 'Oct';
        $tmp_array[] = 'Nov';
        $tmp_array[] = 'Dec';

        return $tmp_array;

    }

    private function return_DAY_ARRAY(){

        $tmp_array = array();

        for($i=31; $i>0; $i--){

            $tmp_array[] = $i;

        }

        return $tmp_array;

    }

    private function return_specialty_ARRAY(){

        $tmp_array = array();

        $tmp_array[] = 'Wadjit (Canada)';
        $tmp_array[] = 'Wadjit (CAN)';
        $tmp_array[] = 'Wadjit (CANADA)';
        $tmp_array[] = 'Wadjit (canada)';
        $tmp_array[] = 'Wadjit (can)';
        $tmp_array[] = 'THE GREENROOM';
        $tmp_array[] = 'Blu Saphir';

        return $tmp_array;

    }


    private function return_specialty_output_ARRAY(){

        $tmp_array = array();

        $tmp_array[] = 'Wadjit '.'<img src="'.$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/canada_thumb.gif" width="33" height="16" alt="Canada" title="Canada">';
        $tmp_array[] = 'Wadjit '.'<img src="'.$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/canada_thumb.gif" width="33" height="16" alt="Canada" title="Canada">';
        $tmp_array[] = 'Wadjit '.'<img src="'.$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/canada_thumb.gif" width="33" height="16" alt="Canada" title="Canada">';
        $tmp_array[] = 'Wadjit '.'<img src="'.$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/canada_thumb.gif" width="33" height="16" alt="Canada" title="Canada">';
        $tmp_array[] = 'Wadjit '.'<img src="'.$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/canada_thumb.gif" width="33" height="16" alt="Canada" title="Canada">';
        $tmp_array[] = '<span style="color:#06730A; font-weight: bold; font-size: 110%;">THE GREENROOM</span>';
        $tmp_array[] = '<span style="color:#3133D5; font-weight: bold;">Blu Saphir</span>';

        return $tmp_array;

    }

    private function return_HYPER_ARRAY(){

        $tmp_array = array();

        $tmp_array[] = 'www.Facebook.com/NateReflect';
        $tmp_array[] = 'soundcloud.com/LQDAudio';
        $tmp_array[] = 'Facebook.com/JasonMagin';
        $tmp_array[] = 'facebook.com/impression23';
        $tmp_array[] = 'fb.com/schematicdnb';
        $tmp_array[] = 'www.djspim.com';
        $tmp_array[] = 'www.northerngroove.co.uk/';
        $tmp_array[] = 'https://xo.am/';
        $tmp_array[] = '@bdxposure';
        $tmp_array[] = 'fb.com/DrumObsession';
        $tmp_array[] = 'tweet@DrumObsessionPL';
        $tmp_array[] = 'insta/impression_ucr';
        $tmp_array[] = 'Insta@fuzedfunk';
        $tmp_array[] = '@warmearsmusic';
        $tmp_array[] = 'fb.com/thebryangee';
        $tmp_array[] = '@schematicdnb';
        $tmp_array[] = 'FB/impression2377';
        $tmp_array[] = 'facebook.com/louis.overfiend';
        $tmp_array[] = 'www.facebook.com/NateReflect';
        $tmp_array[] = 'www.soundcloud.com/amnesty';
        $tmp_array[] = 'Random_Movement';
        $tmp_array[] = 'RandomMovementMusic';
        $tmp_array[] = 'Facebook.com/DLO.DNB';
        $tmp_array[] = 'www.northerngroove.co.uk';
        $tmp_array[] = 'www.facebook.com/operondnb';
        $tmp_array[] = 'fb.com/louis.overfiend';
        $tmp_array[] = 'The Launch Pad with Dj Handy';
        $tmp_array[] = 'INDENTATION Episode';

        return $tmp_array;

    }

    public function return_LINK_ARRAY(){

        $tmp_array = array();

        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.facebook.com/NateReflect" target="_blank">www.Facebook.com/NateReflect</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://soundcloud.com/LQDAudio" target="_blank">soundcloud.com/LQDAudio</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.facebook.com/JasonMagin" target="_blank">Facebook.com/JasonMagin</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.Facebook.com/impression23" target="_blank">facebook.com/impression23</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.facebook.com/schematicdnb" target="_blank">fb.com/schematicdnb</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="http://www.djspim.com" target="_blank">www.djspim.com</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="http://www.northerngroove.co.uk/" target="_blank">www.northerngroove.co.uk/</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://xo.am/" target="_blank">https://xo.am/</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://twitter.com/bdxposure" target="_blank">@bdxposure</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.facebook.com/drumobsession" target="_blank">fb.com/DrumObsession</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://twitter.com/DrumObsessionPL" target="_blank">tweet@DrumObsessionPL</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.instagram.com/impression_ucr/" target="_blank">insta/impression_ucr</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.instagram.com/fuzedfunk/" target="_blank">Insta/fuzedfunk</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.instagram.com/warmearsmusic/" target="_blank">@warmearsmusic</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.facebook.com/thebryangee/" target="_blank">fb.com/thebryangee</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.facebook.com/schematicdnb/" target="_blank">@schematicdnb</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.facebook.com/Impression2377/" target="_blank">FB/impression2377</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.facebook.com/louis.overfiend/" target="_blank">facebook.com/louis.overfiend</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.facebook.com/NateReflect/" target="_blank">www.facebook.com/NateReflect</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://soundcloud.com/amnesty" target="_blank">www.soundcloud.com/amnesty</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://twitter.com/random_movement" target="_blank">Random_Movement</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.instagram.com/Randommovementmusic/" target="_blank">RandomMovementMusic</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.facebook.com/DLO.DNB" target="_blank">Facebook.com/DLO.DNB</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="http://www.northerngroove.co.uk/" target="_blank">www.northerngroove.co.uk</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.facebook.com/operondnb" target="_blank">www.facebook.com/operondnb</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.facebook.com/louis.overfiend" target="_blank">fb.com/louis.overfiend</a>';
        $tmp_array[] = 'The Launch Pad<br>with Dj Handy';
        $tmp_array[] = 'INDENTATION<br>Episode';

        return $tmp_array;

    }

    public function ptrn_replace($pattern_str, $replace_str, $str){

        $patterns = array();
        $replacements = array();

        $patterns[0] = $pattern_str;
        $replacements[0] = $replace_str;

        $str = str_replace($patterns, $replacements, $str);

        return $str;
    }

    public function get_resource($resource_key, $wildCardResourceKey = NULL){

        return $this->oUser->get_resource($resource_key, $wildCardResourceKey);

    }

    public function generateNewKey($len){

        return $this->oUser->generateNewKey($len);

    }

    public function __destruct(){

    }

}