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
#         AUTHOR :: Jonathan '5' Harris, CEO, CTO, Lead Full Stack Developer, jharris@eVifweb.com, eVifweb@gmail.com.
#            URI :: https://crnrstn.jony5.com
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
#  CLASS :: crnrstn_bassdrive_stream_relay_manager
#  VERSION :: 1.00.0000
#  DATE :: November 10, 2021 @ 2158 hrs.
#  AUTHOR :: Jonathan '5' Harris, jharris@eVifweb.com, eVifweb@gmail.com.
#  URI :: http://eVifweb.jony5.com
#  DESCRIPTION :: In memory of my best and longest (15+ years)
#                 drinking buddy, J5,...who would have turned
#                 16 today.
#  LICENSE :: MIT | https://crnrstn.jony5.com/licensing/
#
class crnrstn_bassdrive_stream_relay_manager {

    public $oCRNRSTN_USR;
    protected $oSTREAM_OUTPUT_CONTROLLER;

    protected $stream_oRELAY_ARRAY = array();
    protected $stream_oRELAY_ISACTIVE_ARRAY = array();

    private static $stream_relay_ojson_isvalid = false;
    private static $stream_relay_ojson_isvalid_err = '';
    private static $stream_relay_ojson_serial;
    private static $stream_relay_nowplaying_title;

    private static $stream_totals_bandwidth;
    private static $stream_totals_connections;
    private static $stream_totals_capacity;
    private static $stream_totals_bandwidthFormat;

    public function __construct($oCRNRSTN_USR, $oJSON = NULL){

        $this->oCRNRSTN_USR = $oCRNRSTN_USR;

        if(isset($oJSON)){

            //
            // INITIALIZE CURRENT JSON STREAM RELAY OBJECTS
            /*
            JSON OBJECT FROM PRODUCTION [11.11.2021 0039 hrs] ::
            {
                "relays" : [
                    {
                        "bitrate" : "128",
                        "status" : "1",
                        "name" : "bassdrive.radioca.st:8702",
                        "listenerCount" : "54",
                        "listenerCountPercentage" : "0.54",
                        "audioFormat" : "mp3",
                        "streamURL" : "http:\/\/bassdrive.radioca.st:8702",
                        "streamURLios" : "http:\/\/bassdrive.radioca.st:8702",
                        "title" : "Kos.Mos Music Presents Phuture - hosted by Freestylers"
                    },
                    {
                        "bitrate" : "128",
                        "status" : "1",
                        "name" : "chi.bassdrive.co:80",
                        "listenerCount" : "109",
                        "listenerCountPercentage" : "1.09",
                        "audioFormat" : "mp3",
                        "streamURL" : "http:\/\/chi.bassdrive.co:80",
                        "streamURLios" : "http:\/\/chi.bassdrive.co:80",
                        "title" : "Kos.Mos Music Presents Phuture - hosted by Freestylers"
                    },
                    {
                        "bitrate" : "128",
                        "status" : 0,
                        "name" : "ice.bassdrive.net:80\/stream",
                        "listenerCount" : "0",
                        "listenerCountPercentage" : 0,
                        "audioFormat" : "mp3",
                        "streamURL" : "http:\/\/ice.bassdrive.net:80\/stream",
                        "streamURLios" : "http:\/\/ice.bassdrive.net:80\/stream",
                        "title" : ""
                    },
                    {
                        "bitrate" : "32",
                        "status" : 0,
                        "name" : "ice.bassdrive.net:80\/stream32",
                        "listenerCount" : "0",
                        "listenerCountPercentage" : 0,
                        "audioFormat" : "aac+",
                        "streamURL" : "http:\/\/ice.bassdrive.net:80\/stream32",
                        "streamURLios" : "http:\/\/ice.bassdrive.net:80\/stream32",
                        "title" : ""
                    },
                    {
                        "bitrate" : "56",
                        "status" : 0,
                        "name" : "ice.bassdrive.net:80\/stream56",
                        "listenerCount" : "0",
                        "listenerCountPercentage" : 0,
                        "audioFormat" : "mp3",
                        "streamURL" : "http:\/\/ice.bassdrive.net:80\/stream56",
                        "streamURLios" : "http:\/\/ice.bassdrive.net:80\/stream56",
                        "title" : ""
                    },
                    {
                        "bitrate" : "128",
                        "status" : "1",
                        "name" : "stream.bassdrive.uk:8200",
                        "listenerCount" : "14",
                        "listenerCountPercentage" : "2.73",
                        "audioFormat" : "mp3",
                        "streamURL" : "http:\/\/stream.bassdrive.uk:8200",
                        "streamURLios" : "http:\/\/stream.bassdrive.uk:8200",
                        "title" : "Kos.Mos Music Presents Phuture - hosted by Freestylers"
                    }
                    ],

                "stats" : [
                    {
                        "bandwidth" : 22.13,
                        "connections" : 177,
                        "name" : "Total",
                        "capacity" : 20510,
                        "bandwidthFormat" : "megabit"
                    },
                    {
                        "bandwidth" : 15.38,
                        "connections" : 123,
                        "name" : "TotalUnique",
                        "capacity" : 20510,
                        "bandwidthFormat" : "megabit"
                    },
                    {
                        "bandwidth" : 22.13,
                        "bitrateFormat" : "kilobit",
                        "bitrate" : 128,
                        "connections" : 177,
                        "name" : "Premium",
                        "capacity" : 20510,
                        "bandwidthFormat" : "megabit"
                    },
                    {
                        "bandwidth" : 0,
                        "bitrateFormat" : "kilobit",
                        "bitrate" : 56,
                        "connections" : 0,
                        "name" : "Midgrade",
                        "capacity" : 0,
                        "bandwidthFormat" : "megabit"
                    },
                    {
                        "bandwidth" : 0,
                        "bitrateFormat" : "kilobit",
                        "bitrate" : 32,
                        "connections" : 0,
                        "name" : "AACplus",
                        "capacity" : 0,
                        "bandwidthFormat" : "megabit"
                    },
                    {
                        "bandwidth" : 0,
                        "bitrateFormat" : "kilobit",
                        "bitrate" : 128,
                        "connections" : null,
                        "name" : "Random",
                        "capacity" : null,
                        "bandwidthFormat" : "megabit"
                    }
                    ],

                "nowplaying" : [
                    {
                        "name" : "Kos.Mos Music Presents Phuture - hosted by Freestylers",
                        "label" : "Artist"
                    },
                    {
                        "name" : "Kos.Mos Music Presents Phuture - hosted by Freestylers",
                        "label" : "Title"
                    }
            ]
            }

            */

            error_log('3313 relay mgr _construct to call load_stream_relays.');
            $this->load_stream_relays($oJSON);

        }

    }

    public function return_relay_history_html($title, $oQueryProfileMgr, $BASSDRIVE_LOG_ID = NULL){

        /*
        LOG_BASSDRIVE_PROCESSED
        LOG_BASSDRIVE
        BASSDRIVE_STREAM
        BASSDRIVE_STREAM_COLORS
        BASSDRIVE_STREAM_KEY_PATTERN_LOOKUP
        BASSDRIVE_STREAM_SOCIAL_CONFIG

        `bassdrive_stream_lookup`.`STREAM_LOOKUP_ID`,
        `bassdrive_stream_lookup`.`STREAM_KEY`,
        `bassdrive_stream_lookup`.`PATTERN_TYPE`,
        `bassdrive_stream_lookup`.`PATTERN_LENGTH`,
        `bassdrive_stream_lookup`.`STREAM_STRING_PATTERN`,
        `bassdrive_stream_lookup`.`DATEMODIFIED`,
        `bassdrive_stream_lookup`.`DATECREATED`

        */

        $this->oSTREAM_OUTPUT_CONTROLLER = new crnrstn_bassdrive_stream_output_controller($this->oCRNRSTN_USR);

        if(!$this->oCRNRSTN_USR->ping_value_existence( 'LOG_BASSDRIVE_PROCESSED', 'BASSDRIVE_LOG_ID', $BASSDRIVE_LOG_ID)){

            $tmp_STREAM_KEY = '';
            $tmp_BASSDRIVE_STREAM_KEY_PATTERN_LOOKUP_count = $this->oCRNRSTN_USR->return_record_count('BASSDRIVE_STREAM_KEY_PATTERN_LOOKUP');
            $tmp_BASSDRIVE_STREAM_SOCIAL_CONFIG_count = $this->oCRNRSTN_USR->return_record_count('BASSDRIVE_STREAM_SOCIAL_CONFIG');

            //
            // STREAM_LOOKUP PARSE TO FIND STREAM_KEY
            for($i = 0; $i < $tmp_BASSDRIVE_STREAM_KEY_PATTERN_LOOKUP_count; $i++){

                $tmp_STREAM_STRING_PATTERN = $this->oCRNRSTN_USR->return_database_value('BASSDRIVE_STREAM_KEY_PATTERN_LOOKUP', 'STRING_PATTERN', $i);

                error_log(__LINE__ . ' user pattern ' . $i . ' ' . $title . '[' . $tmp_STREAM_STRING_PATTERN . ']');

                $pos = stripos($title, $tmp_STREAM_STRING_PATTERN);
                if($pos !== false){
                    error_log(__LINE__ . ' user pattern ' . $i . ' [' . $tmp_STREAM_STRING_PATTERN . '][' . $title . ']');

                    $tmp_STREAM_KEY = $this->oCRNRSTN_USR->return_database_value('BASSDRIVE_STREAM_KEY_PATTERN_LOOKUP', 'STREAM_KEY', $i);

                    //
                    // CAN AUGMENT STRENGTH IN LAYERS OF CHECKS HERE USING
                    // HOST_NAME=[91080847] && SHOW_TITLE=[632554686] FOR TYPE OF STRING_PATTERN

                    $i = $tmp_BASSDRIVE_STREAM_KEY_PATTERN_LOOKUP_count + 1;

                }

            }

            error_log(__LINE__ . ' user die() ' . $i . ' $tmp_STREAM_KEY=['.$tmp_STREAM_KEY.'] $tmp_STREAM_STRING_PATTERN=[' . $tmp_STREAM_STRING_PATTERN . ']  $title=[' . $title . ']');

            die();

            if($this->oSTREAM_OUTPUT_CONTROLLER->authorize_stream_output($tmp_STREAM_KEY, $title)){

                //
                // WHAT WE NEED FOR HISTORY BUILD
                // COLORS META ::
                $this->oSTREAM_OUTPUT_CONTROLLER->generate_stream_meta_colors();

                // SOCIAL META (LOCALIZED JSON) ::
                $this->oSTREAM_OUTPUT_CONTROLLER->generate_stream_meta_social();

                // TITLE FORMATTING
                $this->oSTREAM_OUTPUT_CONTROLLER->generate_stream_meta_title();

                // STATS META
                $this->oSTREAM_OUTPUT_CONTROLLER->generate_stream_meta_stats();

            }

        }

        return $this->oSTREAM_OUTPUT_CONTROLLER->return_history_html();
        //return  '<br>---<br>$title['.$title.'] BASSDRIVE_STREAM_COLOR['.$tmp_BASSDRIVE_STREAM_COLORS_count.'] BASSDRIVE_STREAM_SOCIAL_CONFIG['.$tmp_BASSDRIVE_STREAM_SOCIAL_CONFIG_count.']<br>---<br>';

    }

    public function return_relay_for_logging(){

        foreach($this->stream_oRELAY_ARRAY as $index => $tmp_orelay){

            if($this->stream_oRELAY_ISACTIVE_ARRAY[$tmp_orelay->return_serial()] == 1 || $this->stream_oRELAY_ISACTIVE_ARRAY[$tmp_orelay->return_serial()] == '1') {

                return $tmp_orelay;

            }

        }

    }

    public function is_valid_bassdrive_json($oJSON = NULL){

        if(!isset($oJSON)){

            return self::$stream_relay_ojson_isvalid;

        }else{

            return $this->load_stream_relays($oJSON);

        }

    }

    public function return_relay_ojson_err(){

        return self::$stream_relay_ojson_isvalid_err;

    }

    private function load_stream_relays($oJSON){

        $oJSON = json_decode($oJSON, TRUE);
        self::$stream_relay_ojson_serial = $this->oCRNRSTN_USR->hash(print_r($oJSON, true), 'md5');

        $raw_json_nowplaying = $oJSON['nowplaying'];
        $tmp_cnt_nowplaying = count($raw_json_nowplaying);
        $raw_json_relays = $oJSON['relays'];
        $tmp_cnt_relays = count($raw_json_relays);
        $raw_json_stats = $oJSON['stats'];
        $tmp_cnt_stats = count($raw_json_stats);

        if(is_array($raw_json_relays)){

            if($tmp_cnt_relays < 1){
                self::$stream_relay_ojson_isvalid = false;
                self::$stream_relay_ojson_isvalid_err = 'Count of Bassdrive relays in PHP json_decoded Bassdrive JSON is less than 1.';
                return false;

            }

        }else{

            self::$stream_relay_ojson_isvalid = false;
            self::$stream_relay_ojson_isvalid_err = 'Unable to find {"relays":} in PHP json_decoded Bassdrive JSON.';
            return false;

        }

        //error_log(__LINE__ . ' user $raw_nowplaying['.$raw_nowplaying.'] has $raw_relays count =' . count($raw_relays));

        //
        // IF WE HAVE NOW PLAYING META, STORE IT NOW AND PASS IT INTO RELAY OBJECT CONSTRUCTOR CALLS.
        if($tmp_cnt_nowplaying > 0){

            for($i = 0; $i < $tmp_cnt_nowplaying; $i++) {

                /*
                "name" : "Ben XO - XPOSURE Records Show w\/ guest host Schematic",
                "label" : "Artist"
                 * */

                $tmp_nowplaying_name = $raw_json_nowplaying[$i]['name'];
                //$tmp_label = $oJSON['nowplaying'][$i]['label'];

                if (strlen($tmp_nowplaying_name) > 5) {

                    self::$stream_relay_nowplaying_title = $tmp_nowplaying_name;
                    $i = $tmp_cnt_nowplaying + 1;
                }

            }

        }else{

            self::$stream_relay_nowplaying_title = '';

        }

        //
        // IF WE HAVE RELAY META, FIRE RELAY OBJECT CONSTRUCTOR CALLS.
        if($tmp_cnt_relays > 0){

            for($i = 0; $i < $tmp_cnt_relays; $i++) {

                $tmp_relay_serial = $this->oCRNRSTN_USR->generate_new_key(100);

                $tmp_orelay = new crnrstn_bassdrive_stream_relay($tmp_relay_serial, self::$stream_relay_ojson_serial, self::$stream_relay_nowplaying_title);

                $tmp_orelay->load_meta($raw_json_relays[$i]);

                $this->stream_oRELAY_ISACTIVE_ARRAY[$tmp_orelay->return_serial()] = $tmp_orelay->return_isactive();
                $this->stream_oRELAY_ARRAY[] = $tmp_orelay;

            }

        }

        //
        // TOTALS STATS
        for($i = 0; $i < $tmp_cnt_stats; $i++){

            $tmp_name = $raw_json_stats[$i]['name'];

            switch($tmp_name){
                case 'Total':

                    /*
                    {
                        "bandwidth" : 22.13,
                        "connections" : 177,
                        "name" : "Total",
                        "capacity" : 20510,
                        "bandwidthFormat" : "megabit"
                    }

                    */

                    self::$stream_totals_bandwidth = $oJSON['stats'][$i]['bandwidth'];
                    self::$stream_totals_connections = $oJSON['stats'][$i]['connections'];
                    self::$stream_totals_capacity = $oJSON['stats'][$i]['capacity'];
                    self::$stream_totals_bandwidthFormat = $oJSON['stats'][$i]['bandwidthFormat'];

                    $i = $tmp_cnt_stats + 1;

                break;

            }

        }

        if(count($this->stream_oRELAY_ARRAY)>0){

            self::$stream_relay_ojson_isvalid = true;
            return true;

        }else{

            self::$stream_relay_ojson_isvalid = false;
            return false;

        }

    }

    public function __destruct(){


    }

}