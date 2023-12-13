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
#  CLASS :: crnrstn_ascii_art
#  VERSION :: 1.00.0000
#  DATE :: November 21, 2023 @ 1944 hrs.
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: SYSTEM ASCII ART. With the creation of the
#                 (int) CRNRSTN_IS_HTML data type for crnrstn_ascii_art
#                 a CRNRSTN :: UX and ambiance enrichment
#                 class, HTML and TEXT content type switching,
#                 versioning, and memory access by pointer
#                 will more readily and effortlessly work
#                 themsleves out in the architecture.
#
#                 Meat off the bone, boys.
#
#                 Meat off the bone.
#
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_ascii_art {

    public $oCRNRSTN;
    private static $config_serial;

    private static $CRNRSTN_ascii_name = 'CRNRSTN%20%3A%3A';
    private static $ascii_family_key;
    private static $multi_channel_int;
    private static $is_HTML;
    private static $ascii_selection;
    private static $art_id;
    private static $max_count_return;

    private static $art_id_ARRAY = array();
    private static $ascii_count_ARRAY = array();
    private static $ascii_ARRAY = array();

    private static $data_channel_init_sequence;

    public function __construct($oCRNRSTN){

        //
        // CRNRSTN ::
        $this->oCRNRSTN = $oCRNRSTN;

        self::$config_serial = $this->oCRNRSTN->get_crnrstn('config_serial');

        //
        // LOCAL ASCII ID'S.
        self::$art_id_ARRAY = array(
                                'Isometric2'    => 'http://patorjk.com/software/taag/#p=display&f=Isometric2&t=',
                                'Isometric3'    => 'http://patorjk.com/software/taag/#p=display&f=Isometric3&t=',
                                'Doh'           => 'http://patorjk.com/software/taag/#p=display&f=Doh&t=',
                                'Banner3'       => 'http://patorjk.com/software/taag/#p=display&f=Banner3&t=',
                                'Block'         => 'http://patorjk.com/software/taag/#p=display&f=Block&t=',
                                'Impossible'    => 'http://patorjk.com/software/taag/#p=display&f=Impossible&t=',
                                'Modular'       => 'http://patorjk.com/software/taag/#p=display&f=Modular&t=',
                                'Fire Font'     => 'http://patorjk.com/software/taag/#p=display&f=Fire%20Font-k&t=',
                                'Flower Power'  => 'http://patorjk.com/software/taag/#p=display&f=Flower%20Power&t=',
                                'Big'           => 'http://patorjk.com/software/taag/#p=display&f=Big&t=CRNRSTN%20%3A%3A'

                            );

        self::$max_count_return = 5;

        self::$data_channel_init_sequence = $this->oCRNRSTN->get_resource('data_channel_init_sequence', 0, 'CRNRSTN::RESOURCE::MULTI_CHANNEL');

    }

    public function return_full_ascii_art_set($ascii_key = NULL, $channel_char = NULL, $is_HTML){

        //
        // THIS IS INCOMPLETE, BUT IT
        // IS NOT NEEDED YET.
        // Wednesday, November 22, 2023 @ 0421 hrs.
        return self::$art_id_ARRAY;

    }

    public function return_incomplete_ascii_art($ascii_key = NULL, $channel_char = NULL, $is_HTML){
        // Wednesday, November 22, 2023 @ 0321 hrs.     // STARTED.

        $tmp_str = '';
        $tmp_display_missing_cnt = 0;

        //
        // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA
        // OBJECT (MC-DDO) SERVICES LAYER.
        // # # C # R # N # R # S # T # N # : : # # # #
        // CRNRSTN :: UGC DATA INPUT [BOOLEAN]
        // APPLY CHANNEL SETTINGS TO RRS MAP OBJECT.
        //$this->oCRNRSTN->set_channel_config($channel_constant, $attribute_name, $data);
        //$this->oCRNRSTN->get_channel_config($channel_constant, $attribute_name);
        //$this->oCRNRSTN->isset_channel_config($channel_constant, $attribute_name);

        //
        // GET ALL CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO)
        // SYSTEM CHANNELS.
        $tmp_master_channels_ARRAY = $this->oCRNRSTN->return_master_channels_ARRAY();

        foreach($tmp_master_channels_ARRAY as $index_const => $channel_constant){

            $tmp_channel_int = self::$channel_reporting_meta_ARRAY[$channel_char]['CHANNEL_DATA']['channel_int'];

            error_log(__LINE__ . ' ascii $tmp_channel_int[' . $tmp_channel_int . ']. seq[' . self::$data_channel_init_sequence . '] LOAD ASCII ART FOR CHANNEL [' . $this->oCRNRSTN->get_channel_config($channel_constant, 'DESCRIPTION') . '].');

            die();
            //public function return_art($ascii_key = NULL, $channel_char = NULL, $is_HTML = true, $selection_override = NULL){

            //$tmp_complete_ascii_art_ARRAY = $this->return_full_ascii_art_set($channel_constant);

            //$tmp_display_missing_cnt
            foreach(self::$art_id_ARRAY as $artwork_name => $url_base){

                $tmp_art_str = '...&nbsp;Please stand by. The system is loading ascii, ' . $artwork_name . '...';

                //
                // IF CHANNEL VERSION DOES NOT EXISTS, BUILD THE PHP
                // SOURCE MEDIA TAG AND LINK.
                $tmp_system_current_ascii = $this->art($channel_constant, $artwork_name);

                //
                // DO WE HAVE ANY ART?
                if(strlen($tmp_system_current_ascii) < 1){

                    //
                    // INITIALIZE SYSTEM ASCII ART HASH.
                    $tmp_art_hash = -1;
                    self::$ascii_ARRAY[self::$config_serial][self::$ascii_family_key]['ART'][$tmp_channel_int]['HASH'] = $tmp_art_hash;

                    //
                    // INCREMENT MISSING ASCII ART COUNT.
                    $tmp_display_missing_cnt++;

                    $tmp_str .= '#
# [' . $this->oCRNRSTN->return_micro_time() . '] [rtime ' . $this->oCRNRSTN->wall_time() . ']
#
# CRNRSTN :: v' . $this->version_crnrstn() . '
#
# (c) 2012-' . date('Y') . ' Jonathan \'J5\' Harris :: eVifweb development.
# All rights reserved.
#
# LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
# # C # R # N # R # S # T # N # : : # # # #
#
# REPORTING SERVER ::
# '.$_SERVER['SERVER_ADDR'].' (' . $_SERVER['SERVER_NAME']  . ')
# CRNRSTN :: SERVER ENVIRONMENT KEY: ' . self::$env_key . '
# CRNRSTN :: SERVER HASH: ' . self::$env_key_hash . '
# # C # R # N # R # S # T # N # : : # # # #

' . $tmp_art_str . '

# ASCII ARTWORK GENERATED BY CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . '
# ARTWORK TITLE                      :: ' . $artwork_name . '
# ARTWORK SYSTEM HASH                :: ' . $tmp_art_hash . '
# CHANNEL LOAD SEQUENCE CONTROL CHAR :: ' . $channel_char . '
# CHANNEL LOAD SEQUENCE              :: ' . $tmp_channel_load_sequence_str . '
# DATE GENERATED                     :: ' . $this->oCRNRSTN->return_micro_time() . '
# LAST MODIFIED                      ::
# CREATIVE SOURCE                    :: <a href="' . $url_base . strtoupper($this->oCRNRSTN->get_channel_config($channel_constant, 'NAME')) . '" target="_blank" style="color:#0066CC;">' . $url_base . strtoupper($this->oCRNRSTN->get_channel_config($channel_constant, 'NAME')) . '</a>
#
# CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO)
# SERVICES LAYER PERFORMANCE REPORT
#
#
#
# REPORT DETAILS ::
#   CHANNEL NAME: ' . strtoupper($this->oCRNRSTN->get_channel_config($channel_char, 'NAME')) . '
#   CHANNEL INTEGER: ' .  strval($tmp_channel_int)  . '
#   DESCRIPTION: ' . $this->oCRNRSTN->get_channel_config($channel_char, 'DESCRIPTION') . '
#   SYSTEM INTEGER: ' . $tmp_channel_str . ' [' . self::$channel_reporting_meta_ARRAY[$channel_char]['CHANNEL_DATA']['channel_int'] . ']
#   MEMORY LIMIT: ' . $this->oCRNRSTN->get_channel_config($tmp_channel_int, 'max_map_cache_bytes') . '
#   MEMORY USAGE: ' . $this->oCRNRSTN->channel_bytes_stored($tmp_channel) . '
#
# REPORT STATISTICS ::
#   TOTAL REPORT BYTES: ';

                        //
                        // CALCULATE REPORT CONTENT TOTAL BYTES.
                        $tmp_time_str_bytes = strlen('#   RUNTIME: ' . $this->oCRNRSTN->wall_time() . ' seconds.');
                        $tmp_header_char_len = strlen($tmp_str);
                        $tmp_total_report_size = (int) $tmp_header_char_len + (int) $current_bytes + (int) $tmp_time_str_bytes;
                        $tmp_total_report_bytes = $this->format_bytes($tmp_total_report_size, 4);

                        $tmp_str .= $tmp_total_report_bytes . '.
#   REPORT RUNTIME: ';

                }else{

                    //
                    // INITIALIZE SYSTEM ASCII ART HASH.
                    $tmp_art_hash = $this->oCRNRSTN->hash($artwork_name . $tmp_str);
                    self::$ascii_ARRAY[self::$config_serial][self::$ascii_family_key]['ART'][$tmp_channel_int]['HASH'] = $tmp_art_hash;

                    //
                    // BUILD #WINNING ASCII ART OUTPUT.
                    $tmp_str .= '#
# [' . $this->oCRNRSTN->return_micro_time() . '] [rtime ' . $this->oCRNRSTN->wall_time() . ']
#
# CRNRSTN :: v' . $this->version_crnrstn() . '
#
# (c) 2012-' . date('Y') . ' Jonathan \'J5\' Harris :: eVifweb development.
# All rights reserved.
#
# LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
# # C # R # N # R # S # T # N # : : # # # #
#
# REPORTING SERVER ::
# '.$_SERVER['SERVER_ADDR'].' (' . $_SERVER['SERVER_NAME']  . ')
# CRNRSTN :: SERVER ENVIRONMENT KEY: ' . self::$env_key . '
# CRNRSTN :: SERVER HASH: ' . self::$env_key_hash . '
# # C # R # N # R # S # T # N # : : # # # #

' . $tmp_art_str . '

# ASCII ARTWORK GENERATED BY CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . '
# ARTWORK TITLE                      :: ' . $artwork_name . '
# ARTWORK SYSTEM HASH                :: ' . $this->oCRNRSTN->hash($artwork_name) . '
# CHANNEL LOAD SEQUENCE CONTROL CHAR :: ' . $channel_char . '
# CHANNEL LOAD SEQUENCE              :: ' . $tmp_channel_load_sequence_str . '
# DATE GENERATED                     :: ' . $this->oCRNRSTN->return_micro_time() . '
# LAST MODIFIED                      ::
# CREATIVE SOURCE                    :: <a href="' . $url_base . strtoupper($this->oCRNRSTN->get_channel_config($channel_constant, 'NAME')) . '" target="_blank" style="color:#0066CC;">' . $url_base . strtoupper($this->oCRNRSTN->get_channel_config($channel_constant, 'NAME')) . '</a>
#
# CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO)
# SERVICES LAYER PERFORMANCE REPORT
#
#
#
# REPORT DETAILS ::
#   CHANNEL NAME: ' . strtoupper($this->oCRNRSTN->get_channel_config($channel_char, 'NAME')) . '
#   CHANNEL INTEGER:  '  . $this->oCRNRSTN->get_channel_config($channel_char, 'SOURCEID', CRNRSTN_STRING) . '  ' .  strval($tmp_channel_int)  . '
#   DESCRIPTION: ' . $this->oCRNRSTN->get_channel_config($channel_char, 'DESCRIPTION') . '
#   SYSTEM INTEGER: ' . $tmp_channel_str . ' [' . self::$channel_reporting_meta_ARRAY[$channel_char]['CHANNEL_DATA']['channel_int'] . ']
#   MEMORY LIMIT: ' . $this->oCRNRSTN->get_channel_config($tmp_channel_int, 'max_map_cache_bytes') . '
#   MEMORY USAGE: ' . $this->oCRNRSTN->channel_bytes_stored($tmp_channel) . '
#
# REPORT STATISTICS ::
#   TOTAL REPORT BYTES: ';

                        //
                        // CALCULATE REPORT CONTENT TOTAL BYTES.
                        $tmp_time_str_bytes = strlen('#   RUNTIME: ' . $this->oCRNRSTN->wall_time() . ' seconds.');
                        $tmp_header_char_len = strlen($tmp_str);
                        $tmp_total_report_size = (int) $tmp_header_char_len + (int) $current_bytes + (int) $tmp_time_str_bytes;
                        $tmp_total_report_bytes = $this->format_bytes($tmp_total_report_size, 4);

                        $tmp_str .= $tmp_total_report_bytes . '.
#   REPORT RUNTIME: ';

                }

            }

        }

        //
        // RUN THROUGH ALL ASCII NAMES AGAIN TO SUPPORT
        // CRNRSTN :: v1.0.0 ARTWORK ROLLOVER INTEGRATIONS.
        foreach(self::$art_id_ARRAY as $artwork_name => $url_base){

            $tmp_art_str = '...&nbsp;Please stand by. The system is loading ascii, ' . $artwork_name . '...';

            //
            // IF CHANNEL VERSION DOES NOT EXISTS, BUILD THE PHP
            // SOURCE MEDIA TAG AND LINK.
            $tmp_system_current_ascii = $this->art(CRNRSTN_ROOT, $artwork_name);

            //
            // DO WE HAVE ANY ART?
            if(strlen($tmp_system_current_ascii) < 1){

                //
                // INITIALIZE SYSTEM ASCII ART HASH.
                $tmp_art_hash = -1;
                self::$ascii_ARRAY[self::$config_serial][self::$ascii_family_key]['ART'][self::$channel_reporting_meta_ARRAY[$channel_char]['CHANNEL_DATA']['channel_int']]['HASH'] = $tmp_art_hash;

                //
                // INCREMENT MISSING ASCII ART COUNT.
                $tmp_display_missing_cnt++;

                $tmp_str .= '#
# [' . $this->oCRNRSTN->return_micro_time() . '] [rtime ' . $this->oCRNRSTN->wall_time() . ']
#
# CRNRSTN :: v' . $this->version_crnrstn() . '
#
# (c) 2012-' . date('Y') . ' Jonathan \'J5\' Harris :: eVifweb development.
# All rights reserved.
#
# LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
# # C # R # N # R # S # T # N # : : # # # #
#
# REPORTING SERVER ::
# '.$_SERVER['SERVER_ADDR'].' (' . $_SERVER['SERVER_NAME']  . ')
# CRNRSTN :: SERVER ENVIRONMENT KEY: ' . self::$env_key . '
# CRNRSTN :: SERVER HASH: ' . self::$env_key_hash . '
# # C # R # N # R # S # T # N # : : # # # #

' . $tmp_art_str . '

# ASCII ARTWORK GENERATED BY CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . '
# ARTWORK TITLE                      :: ' . $artwork_name . '
# ARTWORK SYSTEM HASH                :: ' . $this->oCRNRSTN->hash($artwork_name) . '
# CHANNEL LOAD SEQUENCE CONTROL CHAR :: ' . $channel_char . '
# CHANNEL LOAD SEQUENCE              :: ' . $tmp_channel_load_sequence_str . '
# DATE GENERATED                     :: ' . $this->oCRNRSTN->return_micro_time() . '
# LAST MODIFIED                      ::
# CREATIVE SOURCE                    :: <a href="' . $url_base . self::$CRNRSTN_ascii_name . '" target="_blank" style="color:#0066CC;">' . $url_base . self::$CRNRSTN_ascii_name . '</a>
#
# CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO)
# SERVICES LAYER PERFORMANCE REPORT
#
#
#
# REPORT DETAILS ::
#   CHANNEL NAME: ' . strtoupper($this->oCRNRSTN->get_channel_config($channel_char, 'NAME')) . '
#   CHANNEL INTEGER: ' .  strval($tmp_channel_int)  . '
#   DESCRIPTION: ' . $this->oCRNRSTN->get_channel_config($channel_char, 'DESCRIPTION') . '
#   SYSTEM INTEGER: ' . $tmp_channel_str . ' [' . self::$channel_reporting_meta_ARRAY[$channel_char]['CHANNEL_DATA']['channel_int'] . ']
#   MEMORY LIMIT: ' . $this->oCRNRSTN->get_channel_config($tmp_channel_authorization_int, 'max_map_cache_bytes') . '
#   MEMORY USAGE: ' . $this->oCRNRSTN->channel_bytes_stored($tmp_channel) . '
#
# REPORT STATISTICS ::
#   TOTAL REPORT BYTES: ';

                //
                // CALCULATE REPORT CONTENT TOTAL BYTES.
                $tmp_time_str_bytes = strlen('#   RUNTIME: ' . $this->oCRNRSTN->wall_time() . ' seconds.');
                $tmp_header_char_len = strlen($tmp_str);
                $tmp_total_report_size = (int) $tmp_header_char_len + (int) $current_bytes + (int) $tmp_time_str_bytes;
                $tmp_total_report_bytes = $this->format_bytes($tmp_total_report_size, 4);

                $tmp_str .= $tmp_total_report_bytes . '.
#   REPORT RUNTIME: ';

            }else{

                //
                // INITIALIZE SYSTEM ASCII ART HASH.
                $tmp_art_hash = $this->oCRNRSTN->hash($artwork_name . $tmp_str);
                self::$ascii_ARRAY[self::$config_serial][self::$ascii_family_key]['ART'][self::$channel_reporting_meta_ARRAY[$channel_char]['CHANNEL_DATA']['channel_int']]['HASH'] = $tmp_art_hash;

                //
                // BUILD #WINNING ASCII ART OUTPUT.
                $tmp_str .= '#
# [' . $this->oCRNRSTN->return_micro_time() . '] [rtime ' . $this->oCRNRSTN->wall_time() . ']
#
# CRNRSTN :: v' . $this->version_crnrstn() . '
#
# (c) 2012-' . date('Y') . ' Jonathan \'J5\' Harris :: eVifweb development.
# All rights reserved.
#
# LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
# # C # R # N # R # S # T # N # : : # # # #
#
# REPORTING SERVER ::
# '.$_SERVER['SERVER_ADDR'].' (' . $_SERVER['SERVER_NAME']  . ')
# CRNRSTN :: SERVER ENVIRONMENT KEY: ' . self::$env_key . '
# CRNRSTN :: SERVER HASH: ' . self::$env_key_hash . '
# # C # R # N # R # S # T # N # : : # # # #

' . $tmp_art_str . '

# ASCII ARTWORK GENERATED BY CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . '
# ARTWORK TITLE                      :: ' . $artwork_name . '
# ARTWORK SYSTEM HASH                :: ' . $this->oCRNRSTN->hash($artwork_name) . '
# CHANNEL LOAD SEQUENCE CONTROL CHAR :: ' . $channel_char . '
# CHANNEL LOAD SEQUENCE              :: ' . $tmp_channel_load_sequence_str . '
# DATE GENERATED                     :: ' . $this->oCRNRSTN->return_micro_time() . '
# LAST MODIFIED                      ::
# CREATIVE SOURCE                    :: <a href="' . $url_base . self::$CRNRSTN_ascii_name . '" target="_blank" style="color:#0066CC;">' . $url_base . self::$CRNRSTN_ascii_name . '</a>
#
# CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO)
# SERVICES LAYER PERFORMANCE REPORT
#
#
#
# REPORT DETAILS ::
#   CHANNEL NAME: ' . strtoupper($this->oCRNRSTN->get_channel_config($channel_char, 'NAME')) . '
#   CHANNEL INTEGER: ' .  strval($tmp_channel_int)  . '
#   DESCRIPTION: ' . $this->oCRNRSTN->get_channel_config($channel_char, 'DESCRIPTION') . '
#   SYSTEM INTEGER: ' . $tmp_channel_str . ' [' . self::$channel_reporting_meta_ARRAY[$channel_char]['CHANNEL_DATA']['channel_int'] . ']
#   MEMORY LIMIT: ' . $this->oCRNRSTN->get_channel_config($tmp_channel_int, 'max_map_cache_bytes') . '
#   MEMORY USAGE: ' . $this->oCRNRSTN->channel_bytes_stored($tmp_channel) . '
#
# REPORT STATISTICS ::
#   TOTAL REPORT BYTES: ';

                //
                // CALCULATE REPORT CONTENT TOTAL BYTES.
                $tmp_time_str_bytes = strlen('#   RUNTIME: ' . $this->oCRNRSTN->wall_time() . ' seconds.');
                $tmp_header_char_len = strlen($tmp_str);
                $tmp_total_report_size = (int) $tmp_header_char_len + (int) $current_bytes + (int) $tmp_time_str_bytes;
                $tmp_total_report_bytes = $this->format_bytes($tmp_total_report_size, 4);

                $tmp_str .= $tmp_total_report_bytes . '.
#   REPORT RUNTIME: ';

            }

        }

        if($tmp_display_missing_cnt > self::$max_count_return){

            return  '<pre><code>' . $tmp_str . '</code></pre>';

        }

    }

    private function art($channel_constant, $artwork_name){

        $tmp_str = '';
        $tmp_art_ARRAY = array();

        //$tmp_system_current_ascii = $this->art($channel_constant, $artwork_name);

        switch($this->oCRNRSTN->tidy_boolean(self::$is_HTML, CRNRSTN_STRING, CRNRSTN_IS_HTML)){
            case 'TEXT':

                switch(self::$art_id){
                    case CRNRSTN_CHANNEL_GET:


                        /*
                        #
                        # SOURCE
                        # http://patorjk.com/software/taag/#p=display&f=Doh&t=CRNRSTN%20%3A%3A

                        ASCII ARTWORK GENERATED BY CRNRSTN :: v' . self::$version_crnrstn . '
                        ARTWORK TITLE :: Isometric2
                        TIMESTAMP ::
                        CREATIVE SOURCE :: http://patorjk.com/software/taag/#p=display&f=Isometric2&t=CRNRSTN%20%3A%3A

                        ASCII ARTWORK GENERATED BY CRNRSTN :: v' . self::$version_crnrstn . '
                        ARTWORK TITLE :: Isometric3
                        TIMESTAMP ::
                        CREATIVE SOURCE :: http://patorjk.com/software/taag/#p=display&f=Isometric3&t=CRNRSTN%20%3A%3A

                        ASCII ARTWORK GENERATED BY CRNRSTN :: v' . self::$version_crnrstn . '
                        ARTWORK TITLE :: Doh
                        TIMESTAMP ::
                        CREATIVE SOURCE :: http://patorjk.com/software/taag/#p=display&f=Doh&t=CRNRSTN%20%3A%3A

                        ASCII ARTWORK GENERATED BY CRNRSTN :: v' . self::$version_crnrstn . '
                        ARTWORK TITLE :: Banner3
                        TIMESTAMP ::
                        CREATIVE SOURCE :: http://patorjk.com/software/taag/#p=display&f=Banner3&t=CRNRSTN%20%3A%3A

                        ASCII ARTWORK GENERATED BY CRNRSTN :: v' . self::$version_crnrstn . '
                        ARTWORK TITLE :: Block
                        TIMESTAMP ::
                        CREATIVE SOURCE :: http://patorjk.com/software/taag/#p=display&f=Block&t=CRNRSTN%20%3A%3A

                        ASCII ARTWORK GENERATED BY CRNRSTN :: v' . self::$version_crnrstn . '
                        ARTWORK TITLE :: Impossible
                        TIMESTAMP ::
                        CREATIVE SOURCE :: http://patorjk.com/software/taag/#p=display&f=Impossible&t=CRNRSTN%20%3A%3A

                        ASCII ARTWORK GENERATED BY CRNRSTN :: v' . self::$version_crnrstn . '
                        ARTWORK TITLE :: Modular
                        TIMESTAMP ::
                        CREATIVE SOURCE :: http://patorjk.com/software/taag/#p=display&f=Modular&t=CRNRSTN%20%3A%3A

                        ASCII ARTWORK GENERATED BY CRNRSTN :: v' . self::$version_crnrstn . '
                        ARTWORK TITLE :: Fire Font
                        TIMESTAMP ::
                        CREATIVE SOURCE :: http://patorjk.com/software/taag/#p=display&f=Fire%20Font-k&t=CRNRSTN%20%3A%3A

                        ASCII ARTWORK GENERATED BY CRNRSTN :: v' . self::$version_crnrstn . '
                        ARTWORK TITLE :: Flower Power
                        TIMESTAMP ::
                        CREATIVE SOURCE :: http://patorjk.com/software/taag/#p=display&f=Flower%20Power&t=CRNRSTN%20%3A%3A

                        ASCII ARTWORK GENERATED BY CRNRSTN :: v' . self::$version_crnrstn . '
                        ARTWORK TITLE :: Big
                        TIMESTAMP ::
                        CREATIVE SOURCE :: http://patorjk.com/software/taag/#p=display&f=Big&t=CRNRSTN%20%3A%3A
                        DATE :: Thursday, August 25, 2022 @ 0948 hrs ::

                        */

                        $tmp_art_ARRAY[] = '';

                        // $tmp_art_ARRAY[] = '';

                        // $tmp_art_ARRAY[] = '';

                        // $tmp_art_ARRAY[] = '';

                        // $tmp_art_ARRAY[] = '';

                    break;
                    case CRNRSTN_CHANNEL_POST:

                    break;
                    case CRNRSTN_CHANNEL_COOKIE:

                    break;
                    case CRNRSTN_CHANNEL_SESSION:

                    break;
                    case CRNRSTN_CHANNEL_DATABASE:

                    break;
                    case CRNRSTN_CHANNEL_SSDTLA:

                    break;
                    case CRNRSTN_CHANNEL_PSSDTLA:

                    break;
                    case CRNRSTN_CHANNEL_RUNTIME:

                    break;
                    case CRNRSTN_CHANNEL_SOAP:

                    break;
                    case CRNRSTN_CHANNEL_FILE:

                    break;
                    default:
                        //CRNRSTN_ROOT

                        $tmp_art_ARRAY[] = '';

                        // $tmp_art_ARRAY[] = '';

                        // $tmp_art_ARRAY[] = '';

                        // $tmp_art_ARRAY[] = '';

                        // $tmp_art_ARRAY[] = '';

                    break;

                }


            break;
            default:
                //case 'HTML':

                switch(self::$art_id){
                    case CRNRSTN_CHANNEL_GET:

                        $tmp_art_ARRAY[] = '';

                        // $tmp_art_ARRAY[] = '';

                        // $tmp_art_ARRAY[] = '';

                        // $tmp_art_ARRAY[] = '';

                        // $tmp_art_ARRAY[] = '';

                    break;
                    case CRNRSTN_CHANNEL_POST:

                    break;
                    case CRNRSTN_CHANNEL_COOKIE:

                    break;
                    case CRNRSTN_CHANNEL_SESSION:

                    break;
                    case CRNRSTN_CHANNEL_DATABASE:

                    break;
                    case CRNRSTN_CHANNEL_SSDTLA:

                    break;
                    case CRNRSTN_CHANNEL_PSSDTLA:

                    break;
                    case CRNRSTN_CHANNEL_RUNTIME:

                    break;
                    case CRNRSTN_CHANNEL_SOAP:

                    break;
                    case CRNRSTN_CHANNEL_FILE:

                    break;
                    default:
                        //CRNRSTN_ROOT

                        $tmp_art_ARRAY[] = '';

                        // $tmp_art_ARRAY[] = '';

                        // $tmp_art_ARRAY[] = '';

                        // $tmp_art_ARRAY[] = '';

                        // $tmp_art_ARRAY[] = '';

                    break;

                }

            break;

        }

        //
        // CONCATENATE OUTPUT (CRNRSTN_STRING) STRING.
        //
        // Wednesday, November 22, 2023 @ 0451 hrs.
        foreach($tmp_art_ARRAY as $index => $data){

            $tmp_str .= $data;

        }

        //
        // RETURN CRNRSTN_STRING DATA
        // TYPE OUTPUT.
        return $tmp_str;

    }

    private function load_ascii(){

        switch(self::$ascii_family_key){
            case 'DDO_MULTI_CHANNEL':

                self::$art_id = self::$multi_channel_int;
                $content_type = $this->oCRNRSTN->tidy_boolean(self::$is_HTML, CRNRSTN_STRING, CRNRSTN_IS_HTML);

                switch(self::$multi_channel_int){
                    case CRNRSTN_CHANNEL_GET:

                        //
                        // $_GET[] CHANNEL ASCII.
                        self::$ascii_ARRAY[self::$config_serial][self::$ascii_family_key]['ART'][self::$multi_channel_int][$content_type] = $this->art($content_type);
                        // Wednesday, November 22, 2023 0135 hrs.

                    break;
                    case CRNRSTN_CHANNEL_POST:

                    break;
                    case CRNRSTN_CHANNEL_COOKIE:

                    break;
                    case CRNRSTN_CHANNEL_SESSION:

                    break;
                    case CRNRSTN_CHANNEL_DATABASE:

                    break;
                    case CRNRSTN_CHANNEL_SSDTLA:

                    break;
                    case CRNRSTN_CHANNEL_PSSDTLA:

                    break;
                    case CRNRSTN_CHANNEL_RUNTIME:

                    break;
                    case CRNRSTN_CHANNEL_SOAP:

                    break;
                    case CRNRSTN_CHANNEL_FILE:

                    break;

                }

            break;
            default:
                //CRNRSTN ::

                self::$art_id = CRNRSTN_ROOT;

            break;

        }

        //
        // RETURN ASCII ART HTML OR TEXT ARRAY.
        return self::$ascii_ARRAY[self::$config_serial][self::$ascii_family_key]['ART'][self::$multi_channel_int][$content_type];

    }

    private function return_ascii_count(){

        $tmp_ascii_art_content_ARRAY = array();

        $tmp_ascii_art_content_ARRAY = $this->load_ascii();

        return count($tmp_ascii_art_content_ARRAY);

    }

    public function return_art($ascii_key = NULL, $channel_char = NULL, $is_HTML = true, $selection_override = NULL){

        //
        // INTIIALIZE.
        self::$ascii_family_key = $ascii_key;
        self::$multi_channel_int = $this->oCRNRSTN->get_channel_config($channel_char, 'SOURCEID', CRNRSTN_INTEGER);
        self::$is_HTML = $is_HTML;
        self::$ascii_selection = $selection_override;
        self::$ascii_count_ARRAY[self::$config_serial][self::$ascii_family_key][self::$multi_channel_int] = 0;

        switch(self::$ascii_family_key){
            case DDO_MULTI_CHANNEL:
                /*
                $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_INTEGER] = CRNRSTN_CHANNEL_FILE;
                $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_STRING] = 'CRNRSTN_CHANNEL_FILE';
                $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_INTEGER] = CRNRSTN_ENCRYPT_FILE;
                $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_STRING] = 'CRNRSTN_ENCRYPT_FILE';
                $tmp_channel_ARRAY['NAME'] = 'file';
                $tmp_channel_ARRAY['DESCRIPTION'] = 'F :: SERVER LOCAL FILE SYSTEM.';
                $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_INTEGER] = CRNRSTN_AUTHORIZE_FILE;
                $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_STRING] = 'CRNRSTN_AUTHORIZE_FILE';
                $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER]
                $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_STRING]

                */

                switch(self::$multi_channel_int){
                    case CRNRSTN_CHANNEL_GET:

                        self::$ascii_count_ARRAY[self::$config_serial][self::$ascii_family_key][self::$multi_channel_int] = $this->return_ascii_count();

                    break;
                    case CRNRSTN_CHANNEL_POST:

                    break;
                    case CRNRSTN_CHANNEL_COOKIE:

                    break;
                    case CRNRSTN_CHANNEL_SESSION:

                    break;
                    case CRNRSTN_CHANNEL_DATABASE:

                    break;
                    case CRNRSTN_CHANNEL_SSDTLA:

                    break;
                    case CRNRSTN_CHANNEL_PSSDTLA:

                    break;
                    case CRNRSTN_CHANNEL_RUNTIME:

                    break;
                    case CRNRSTN_CHANNEL_SOAP:

                    break;
                    case CRNRSTN_CHANNEL_FILE:

                    break;

                }

                return $this->ascii_art();

            break;
            default:
                //case 'CRRNSTN':



            break;

        }


    }

    public function load_ascii_profile(){





    }

    # #
    # SOURCE
    # http://patorjk.com/software/taag/#p=display&f=Doh&t=CRNRSTN%20%3A%3A
    private function _____return_CRNRSTN_ASCII_ART($index = NULL){

        /*
        //G :: HTTP $_GET REQUEST.

        //
        // INITIALIZATION RETURN FOR ACCELERATION
        // OF MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) RESOURCE MANAGEMENT.
        $tmp_channel_ARRAY['CHAR'] = 'G';
        if($index_0 == 'CHAR'){

            return $tmp_channel_ARRAY['CHAR'];

        }

        $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_INTEGER] = CRNRSTN_CHANNEL_GET;
        $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_STRING] = 'CRNRSTN_CHANNEL_GET';
        $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_INTEGER] = CRNRSTN_ENCRYPT_GET;
        $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_STRING] = 'CRNRSTN_ENCRYPT_GET';
        $tmp_channel_ARRAY['NAME'] = 'get';
        $tmp_channel_ARRAY['DESCRIPTION'] = 'G :: HTTP $_GET REQUEST';
        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_INTEGER] = CRNRSTN_AUTHORIZE_GET;
        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_STRING] = 'CRNRSTN_AUTHORIZE_GET';
        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER] ;
        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_STRING] ;

        $this->oCRNRSTN->get_channel_config($channel, 'NAME');
        $this->oCRNRSTN->get_channel_config($channel, 'DESCRIPTION');
        $this->oCRNRSTN->get_channel_config($channel, 'AUTHORIZATION', 'PROFILE', 'PRIMARY', CRNRSTN_INTEGER);

        */


        $tmp_crnrstnART[0] = '      ___           <span style="color:#F90000;">___</span>           ___           ___           ___                         ___
     /\__\         <span style="color:#F90000;">/\  \</span>         /\  \         /\  \         /\__\                       /\  \
    /:/  /        <span style="color:#F90000;">/::\  \</span>        \:\  \       /::\  \       /:/ _/_         ___          \:\  \          ___         ___
   /:/  /        <span style="color:#F90000;">/:/\:\__\</span>        \:\  \     /:/\:\__\     /:/ /\  \       /\__\          \:\  \        /\__\       /\__\
  /:/  /  ___   <span style="color:#F90000;">/:/ /:/  /</span>    _____\:\  \   /:/ /:/  /    /:/ /::\  \     /:/  /      _____\:\  \       \/__/       \/__/
 /:/__/  /\__\ <span style="color:#F90000;">/:/_/:/__/</span>___ /::::::::\__\ /:/_/:/__/___ /:/_/:/\:\__\   /:/__/      /::::::::\__\
 \:\  \ /:/  / <span style="color:#F90000;">\:\/:::::/  / </span>\:\~~\~~\/__/ \:\/:::::/  / \:\/:/ /:/  /  /::\  \      \:\~~\~~\/__/       ___         ___
  \:\  /:/  /   <span style="color:#F90000;">\::/~~/~~~~</span>   \:\  \        \::/~~/~~~~   \::/ /:/  /  /:/\:\  \      \:\  \            /\__\       /\__\
   \:\/:/  /     <span style="color:#F90000;">\:\~~\</span>        \:\  \        \:\~~\        \/_/:/  /   \/__\:\  \      \:\  \           \/__/       \/__/
    \::/  /       <span style="color:#F90000;">\:\__\</span>        \:\__\        \:\__\         /:/  /         \:\__\      \:\__\
     \/__/         <span style="color:#F90000;">\/__/</span>         \/__/         \/__/         \/__/           \/__/       \/__/




<!--
ASCII ARTWORK GENERATED BY CRNRSTN :: v' . self::$version_crnrstn . '
ARTWORK TITLE :: Isometric2
TIMESTAMP :: ' . $this->return_micro_time() . '

CREATIVE SOURCE :: http://patorjk.com/software/taag/#p=display&f=Isometric2&t=CRNRSTN%20%3A%3A
DATE :: Sunday, Jul 31, 2022 @ 0949 hrs ::
-->
';

        $tmp_crnrstnART[1] = '      ___           <span style="color:#F90000;">___</span>           ___           ___           ___                       __
     /  /\         <span style="color:#F90000;">/  /\</span>         /__/\         /  /\         /  /\          ___        /__/\
    /  /:/        <span style="color:#F90000;">/  /::\</span>        \  \:\       /  /::\       /  /:/_        /  /\       \  \:\          ___        ___
   /  /:/        <span style="color:#F90000;">/  /:/\:\</span>        \  \:\     /  /:/\:\     /  /:/ /\      /  /:/        \  \:\        /__/\      /__/\
  /  /:/  ___   <span style="color:#F90000;">/  /:/~/:/</span>    _____\__\:\   /  /:/~/:/    /  /:/ /::\    /  /:/     _____\__\:\       \__\/      \__\/
 /__/:/  /  /\ <span style="color:#F90000;">/__/:/ /:/___ /</span>__/::::::::\ /__/:/ /:/___ /__/:/ /:/\:\  /  /::\    /__/::::::::\
 \  \:\ /  /:/ <span style="color:#F90000;">\  \:\/:::::/</span> \  \:\~~\~~\/ \  \:\/:::::/ \  \:\/:/~/:/ /__/:/\:\   \  \:\~~\~~\/       ___        ___
  \  \:\  /:/   <span style="color:#F90000;">\  \::/~~~~</span>   \  \:\  ~~~   \  \::/~~~~   \  \::/ /:/  \__\/  \:\   \  \:\  ~~~       /__/\      /__/\
   \  \:\/:/     <span style="color:#F90000;">\  \:\</span>        \  \:\        \  \:\        \__\/ /:/        \  \:\   \  \:\           \__\/      \__\/
    \  \::/       <span style="color:#F90000;">\  \:\</span>        \  \:\        \  \:\         /__/:/          \__\/    \  \:\
     \__\/         <span style="color:#F90000;">\__\/</span>         \__\/         \__\/         \__\/                     \__\/




<!--
ASCII ARTWORK GENERATED BY CRNRSTN :: v' . self::$version_crnrstn . '
ARTWORK TITLE :: Isometric3
TIMESTAMP :: ' . $this->return_micro_time() . '

CREATIVE SOURCE :: http://patorjk.com/software/taag/#p=display&f=Isometric3&t=CRNRSTN%20%3A%3A
DATE :: Sunday, Jul 31, 2022 @ 0949 hrs ::
-->
';

        $tmp_crnrstnART[4] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;___&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F90000;">___</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;___&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;___&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;___&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;___&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/\__\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F90000;">/\&nbsp;&nbsp;\</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/\__\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;&nbsp;/:/&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F90000;">/::\&nbsp;&nbsp;\</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/::\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/:/&nbsp;_/_&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;___&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;/:/&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F90000;">/:/\:\__\</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/:/\:\__\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/:/&nbsp;/\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/\__\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;/:/&nbsp;&nbsp;/&nbsp;&nbsp;___&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F90000;">/:/&nbsp;/:/&nbsp;&nbsp;/</span>&nbsp;&nbsp;&nbsp;&nbsp;_____\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;/:/&nbsp;/:/&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;/:/&nbsp;/::\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/:/&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_____\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;/:/__/&nbsp;&nbsp;/\__\&nbsp;<span&nbsp;style="color:#F90000;">/:/_/:/__/</span>___&nbsp;/::::::::\__\&nbsp;/:/_/:/__/___&nbsp;/:/_/:/\:\__\&nbsp;&nbsp;&nbsp;/:/__/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/::::::::\__\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;\:\&nbsp;&nbsp;\&nbsp;/:/&nbsp;&nbsp;/&nbsp;<span&nbsp;style="color:#F90000;">\:\/:::::/&nbsp;&nbsp;/&nbsp;</span>\:\~~\~~\/__/&nbsp;\:\/:::::/&nbsp;&nbsp;/&nbsp;\:\/:/&nbsp;/:/&nbsp;&nbsp;/&nbsp;&nbsp;/::\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\~~\~~\/__/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;\:\&nbsp;&nbsp;/:/&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F90000;">\::/~~/~~~~</span>&nbsp;&nbsp;&nbsp;\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\::/~~/~~~~&nbsp;&nbsp;&nbsp;\::/&nbsp;/:/&nbsp;&nbsp;/&nbsp;&nbsp;/:/\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;\:\/:/&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F90000;">\:\~~\</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\~~\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\/_/:/&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;\/__\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;&nbsp;\::/&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F90000;">\:\__\</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\__\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\__\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/:/&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\__\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\__\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\/__/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F90000;">\/__/</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\/__/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\/__/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\/__/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\/__/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\/__/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>




<!--
ASCII ARTWORK GENERATED BY CRNRSTN :: v' . self::$version_crnrstn . '
ARTWORK TITLE :: Isometric2
TIMESTAMP :: ' . $this->return_micro_time() . '

CREATIVE SOURCE :: http://patorjk.com/software/taag/#p=display&f=Isometric2&t=CRNRSTN%20%3A%3A
DATE :: Sunday, Jul 31, 2022 @ 0949 hrs ::
-->
';

        $tmp_crnrstnART[2] = '        CCCCCCCCCCCCC<span style="color:#F90000;">RRRRRRRRRRRRRRRRR</span>   NNNNNNNN        NNNNNNNNRRRRRRRRRRRRRRRRR      SSSSSSSSSSSSSSS TTTTTTTTTTTTTTTTTTTTTTTNNNNNNNN        NNNNNNNN
     CCC::::::::::::C<span style="color:#F90000;">R::::::::::::::::R</span>  N:::::::N       N::::::NR::::::::::::::::R   SS:::::::::::::::ST:::::::::::::::::::::TN:::::::N       N::::::N
   CC:::::::::::::::C<span style="color:#F90000;">R::::::RRRRRR:::::R</span> N::::::::N      N::::::NR::::::RRRRRR:::::R S:::::SSSSSS::::::ST:::::::::::::::::::::TN::::::::N      N::::::N
  C:::::CCCCCCCC::::C<span style="color:#F90000;">RR:::::R     R:::::R</span>N:::::::::N     N::::::NRR:::::R     R:::::RS:::::S     SSSSSSST:::::TT:::::::TT:::::TN:::::::::N     N::::::N
 C:::::C       CCCCCC  <span style="color:#F90000;">R::::R     R:::::R</span>N::::::::::N    N::::::N  R::::R     R:::::RS:::::S            TTTTTT  T:::::T  TTTTTTN::::::::::N    N::::::N
C:::::C                <span style="color:#F90000;">R::::R     R:::::R</span>N:::::::::::N   N::::::N  R::::R     R:::::RS:::::S                    T:::::T        N:::::::::::N   N::::::N      ::::::  ::::::
C:::::C                <span style="color:#F90000;">R::::RRRRRR:::::R</span> N:::::::N::::N  N::::::N  R::::RRRRRR:::::R  S::::SSSS                 T:::::T        N:::::::N::::N  N::::::N      ::::::  ::::::
C:::::C                <span style="color:#F90000;">R:::::::::::::RR</span>  N::::::N N::::N N::::::N  R:::::::::::::RR    SS::::::SSSSS            T:::::T        N::::::N N::::N N::::::N      ::::::  ::::::
C:::::C                <span style="color:#F90000;">R::::RRRRRR:::::R</span> N::::::N  N::::N:::::::N  R::::RRRRRR:::::R     SSS::::::::SS          T:::::T        N::::::N  N::::N:::::::N
C:::::C                <span style="color:#F90000;">R::::R</span>     <span style="color:#F90000;">R:::::R</span>N::::::N   N:::::::::::N  R::::R     R:::::R       SSSSSS::::S         T:::::T        N::::::N   N:::::::::::N
C:::::C                <span style="color:#F90000;">R::::R</span>     <span style="color:#F90000;">R:::::R</span>N::::::N    N::::::::::N  R::::R     R:::::R            S:::::S        T:::::T        N::::::N    N::::::::::N
 C:::::C       CCCCCC  <span style="color:#F90000;">R::::R</span>     <span style="color:#F90000;">R:::::R</span>N::::::N     N:::::::::N  R::::R     R:::::R            S:::::S        T:::::T        N::::::N     N:::::::::N      ::::::  ::::::
  C:::::CCCCCCCC::::C<span style="color:#F90000;">RR:::::R</span>     <span style="color:#F90000;">R:::::R</span>N::::::N      N::::::::NRR:::::R     R:::::RSSSSSSS     S:::::S      TT:::::::TT      N::::::N      N::::::::N      ::::::  ::::::
   CC:::::::::::::::C<span style="color:#F90000;">R::::::R</span>     <span style="color:#F90000;">R:::::R</span>N::::::N       N:::::::NR::::::R     R:::::RS::::::SSSSSS:::::S      T:::::::::T      N::::::N       N:::::::N      ::::::  ::::::
     CCC::::::::::::C<span style="color:#F90000;">R::::::R</span>     <span style="color:#F90000;">R:::::R</span>N::::::N        N::::::NR::::::R     R:::::RS:::::::::::::::SS       T:::::::::T      N::::::N        N::::::N
        CCCCCCCCCCCCC<span style="color:#F90000;">RRRRRRRR</span>     <span style="color:#F90000;">RRRRRRR</span>NNNNNNNN         NNNNNNNRRRRRRRR     RRRRRRR SSSSSSSSSSSSSSS         TTTTTTTTTTT      NNNNNNNN         NNNNNNN




<!--
ASCII ARTWORK GENERATED BY CRNRSTN :: v' . self::$version_crnrstn . '
ARTWORK TITLE :: Doh
TIMESTAMP :: ' . $this->return_micro_time() . '

CREATIVE SOURCE :: http://patorjk.com/software/taag/#p=display&f=Doh&t=CRNRSTN%20%3A%3A
DATE :: Sunday, Jul 31, 2022 @ 0949 hrs ::
-->
';

        $tmp_crnrstnART[5] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CCCCCCCCCCCCC<span&nbsp;style="color:#F90000;">RRRRRRRRRRRRRRRRR</span>&nbsp;&nbsp;&nbsp;NNNNNNNN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NNNNNNNNRRRRRRRRRRRRRRRRR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SSSSSSSSSSSSSSS&nbsp;TTTTTTTTTTTTTTTTTTTTTTTNNNNNNNN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NNNNNNNN<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CCC::::::::::::C<span&nbsp;style="color:#F90000;">R::::::::::::::::R</span>&nbsp;&nbsp;N:::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::NR::::::::::::::::R&nbsp;&nbsp;&nbsp;SS:::::::::::::::ST:::::::::::::::::::::TN:::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N<br>
&nbsp;&nbsp;&nbsp;CC:::::::::::::::C<span&nbsp;style="color:#F90000;">R::::::RRRRRR:::::R</span>&nbsp;N::::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::NR::::::RRRRRR:::::R&nbsp;S:::::SSSSSS::::::ST:::::::::::::::::::::TN::::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N<br>
&nbsp;&nbsp;C:::::CCCCCCCC::::C<span&nbsp;style="color:#F90000;">RR:::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::R</span>N:::::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::NRR:::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::RS:::::S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SSSSSSST:::::TT:::::::TT:::::TN:::::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N<br>
&nbsp;C:::::C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CCCCCC&nbsp;&nbsp;<span&nbsp;style="color:#F90000;">R::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::R</span>N::::::::::N&nbsp;&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;R::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::RS:::::S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TTTTTT&nbsp;&nbsp;T:::::T&nbsp;&nbsp;TTTTTTN::::::::::N&nbsp;&nbsp;&nbsp;&nbsp;N::::::N<br>
C:::::C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F90000;">R::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::R</span>N:::::::::::N&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;R::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::RS:::::S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T:::::T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N:::::::::::N&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::<br>
C:::::C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F90000;">R::::RRRRRR:::::R</span>&nbsp;N:::::::N::::N&nbsp;&nbsp;N::::::N&nbsp;&nbsp;R::::RRRRRR:::::R&nbsp;&nbsp;S::::SSSS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T:::::T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N:::::::N::::N&nbsp;&nbsp;N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::<br>
C:::::C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F90000;">R:::::::::::::RR</span>&nbsp;&nbsp;N::::::N&nbsp;N::::N&nbsp;N::::::N&nbsp;&nbsp;R:::::::::::::RR&nbsp;&nbsp;&nbsp;&nbsp;SS::::::SSSSS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T:::::T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N&nbsp;N::::N&nbsp;N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::<br>
C:::::C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F90000;">R::::RRRRRR:::::R</span>&nbsp;N::::::N&nbsp;&nbsp;N::::N:::::::N&nbsp;&nbsp;R::::RRRRRR:::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SSS::::::::SS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T:::::T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;N::::N:::::::N<br>
C:::::C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F90000;">R::::R</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F90000;">R:::::R</span>N::::::N&nbsp;&nbsp;&nbsp;N:::::::::::N&nbsp;&nbsp;R::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SSSSSS::::S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T:::::T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;&nbsp;N:::::::::::N<br>
C:::::C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F90000;">R::::R</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F90000;">R:::::R</span>N::::::N&nbsp;&nbsp;&nbsp;&nbsp;N::::::::::N&nbsp;&nbsp;R::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;S:::::S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T:::::T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;&nbsp;&nbsp;N::::::::::N<br>
&nbsp;C:::::C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CCCCCC&nbsp;&nbsp;<span&nbsp;style="color:#F90000;">R::::R</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F90000;">R:::::R</span>N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N:::::::::N&nbsp;&nbsp;R::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;S:::::S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T:::::T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N:::::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::<br>
&nbsp;&nbsp;C:::::CCCCCCCC::::C<span&nbsp;style="color:#F90000;">RR:::::R</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F90000;">R:::::R</span>N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::::NRR:::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::RSSSSSSS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;S:::::S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TT:::::::TT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::<br>
&nbsp;&nbsp;&nbsp;CC:::::::::::::::C<span&nbsp;style="color:#F90000;">R::::::R</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F90000;">R:::::R</span>N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N:::::::NR::::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::RS::::::SSSSSS:::::S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T:::::::::T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N:::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CCC::::::::::::C<span&nbsp;style="color:#F90000;">R::::::R</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F90000;">R:::::R</span>N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::NR::::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::RS:::::::::::::::SS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T:::::::::T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CCCCCCCCCCCCC<span&nbsp;style="color:#F90000;">RRRRRRRR</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F90000;">RRRRRRR</span>NNNNNNNN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NNNNNNNRRRRRRRR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RRRRRRR&nbsp;SSSSSSSSSSSSSSS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TTTTTTTTTTT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NNNNNNNN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NNNNNNN<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
<br>



<!--
ASCII ARTWORK GENERATED BY CRNRSTN :: v' . self::$version_crnrstn . '
ARTWORK TITLE :: Doh
TIMESTAMP :: ' . $this->return_micro_time() . '

CREATIVE SOURCE :: http://patorjk.com/software/taag/#p=display&f=Doh&t=CRNRSTN%20%3A%3A
DATE :: Sunday, Jul 31, 2022 @ 0949 hrs ::
-->
';

        $tmp_crnrstnART[3] = ' ######  <span style="color:#F90000;">########</span>  ##    ## ########   ######  ######## ##    ##     ##   ##
##    ## <span style="color:#F90000;">##     ##</span> ###   ## ##     ## ##    ##    ##    ###   ##    #### ####
##       <span style="color:#F90000;">##     ##</span> ####  ## ##     ## ##          ##    ####  ##     ##   ##
##       <span style="color:#F90000;">########</span>  ## ## ## ########   ######     ##    ## ## ##
##       <span style="color:#F90000;">##   ##</span>   ##  #### ##   ##         ##    ##    ##  ####     ##   ##
##    ## <span style="color:#F90000;">##    ##</span>  ##   ### ##    ##  ##    ##    ##    ##   ###    #### ####
 ######  <span style="color:#F90000;">##     ##</span> ##    ## ##     ##  ######     ##    ##    ##     ##   ##




<!--
ASCII ARTWORK GENERATED BY CRNRSTN :: v' . self::$version_crnrstn . '
ARTWORK TITLE :: Banner3
TIMESTAMP :: ' . $this->return_micro_time() . '

CREATIVE SOURCE :: http://patorjk.com/software/taag/#p=display&f=Banner3&t=CRNRSTN%20%3A%3A
DATE :: Sunday, Jul 31, 2022 @ 0949 hrs ::
-->
';

        $tmp_crnrstnART[6] = '<br>
<br>
&nbsp;######&nbsp;&nbsp;<span&nbsp;style="color:#F90000;">########</span>&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;########&nbsp;&nbsp;&nbsp;######&nbsp;&nbsp;########&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;<br>
##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;<span&nbsp;style="color:#F90000;">##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##</span>&nbsp;###&nbsp;&nbsp;&nbsp;##&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;###&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;####&nbsp;####&nbsp;<br>
##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F90000;">##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##</span>&nbsp;####&nbsp;&nbsp;##&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;####&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;<br>
##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F90000;">########</span>&nbsp;&nbsp;##&nbsp;##&nbsp;##&nbsp;########&nbsp;&nbsp;&nbsp;######&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;##&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F90000;">##&nbsp;&nbsp;&nbsp;##</span>&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;####&nbsp;##&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;####&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;<br>
##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;<span&nbsp;style="color:#F90000;">##&nbsp;&nbsp;&nbsp;&nbsp;##</span>&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;###&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;###&nbsp;&nbsp;&nbsp;&nbsp;####&nbsp;####&nbsp;<br>
&nbsp;######&nbsp;&nbsp;<span&nbsp;style="color:#F90000;">##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##</span>&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;######&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;<br>
<br>



<!--
ASCII ARTWORK GENERATED BY CRNRSTN :: v' . self::$version_crnrstn . '
ARTWORK TITLE :: Banner3
TIMESTAMP :: ' . $this->return_micro_time() . '

CREATIVE SOURCE :: http://patorjk.com/software/taag/#p=display&f=Banner3&t=CRNRSTN%20%3A%3A
DATE :: Sunday, Jul 31, 2022 @ 0949 hrs ::
-->
';

        $tmp_crnrstnART[4] = '   _|_|_|  <span style="color:#F90000;">_|_|_|</span>    _|      _|  _|_|_|      _|_|_|  _|_|_|_|_|  _|      _|
 _|        <span style="color:#F90000;">_|    _|</span>  _|_|    _|  _|    _|  _|            _|      _|_|    _|      _|  _|
 _|        <span style="color:#F90000;">_|_|_|</span>    _|  _|  _|  _|_|_|      _|_|        _|      _|  _|  _|
 _|        <span style="color:#F90000;">_|    _|</span>  _|    _|_|  _|    _|        _|      _|      _|    _|_|
   _|_|_|  <span style="color:#F90000;">_|    _|</span>  _|      _|  _|    _|  _|_|_|        _|      _|      _|      _|  _|




<!--
ASCII ARTWORK GENERATED BY CRNRSTN :: v' . self::$version_crnrstn . '
ARTWORK TITLE :: Block
TIMESTAMP :: ' . $this->return_micro_time() . '

CREATIVE SOURCE :: http://patorjk.com/software/taag/#p=display&f=Block&t=CRNRSTN%20%3A%3A
DATE :: Sunday, Jul 31, 2022 @ 0949 hrs ::
-->
';

        $tmp_crnrstnART[7] = '<br>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;_|_|_|&nbsp;&nbsp;<span&nbsp;style="color:#F90000;">_|_|_|</span>&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;_|_|_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|_|_|&nbsp;&nbsp;_|_|_|_|_|&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F90000;">_|&nbsp;&nbsp;&nbsp;&nbsp;_|</span>&nbsp;&nbsp;_|_|&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|_|&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;_|&nbsp;&nbsp;<br>
&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F90000;">_|_|_|</span>&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;_|&nbsp;&nbsp;_|&nbsp;&nbsp;_|_|_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;_|&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F90000;">_|&nbsp;&nbsp;&nbsp;&nbsp;_|</span>&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;_|_|&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;_|_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;_|_|_|&nbsp;&nbsp;<span&nbsp;style="color:#F90000;">_|&nbsp;&nbsp;&nbsp;&nbsp;_|</span>&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;_|_|_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;_|&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
<br>



<!--
ASCII ARTWORK GENERATED BY CRNRSTN :: v' . self::$version_crnrstn . '
ARTWORK TITLE :: Block
TIMESTAMP :: ' . $this->return_micro_time() . '

CREATIVE SOURCE :: http://patorjk.com/software/taag/#p=display&f=Block&t=CRNRSTN%20%3A%3A
DATE :: Sunday, Jul 31, 2022 @ 0949 hrs ::
-->
';

        $tmp_crnrstnART[-1] = '          _             <span style="color:#F90000;">_</span>           _             _          _          _            _
        /\ \           <span style="color:#F90000;">/\ \</span>        /\ \     _    /\ \       / /\       /\ \         /\ \     _    _   _
       /  \ \         <span style="color:#F90000;">/  \ \</span>      /  \ \   /\_\ /  \ \     / /  \      \_\ \       /  \ \   /\_\ /\_\/\_\
      / /\ \ \       <span style="color:#F90000;">/ /\ \ \</span>    / /\ \ \_/ / // /\ \ \   / / /\ \__   /\__ \     / /\ \ \_/ / / \/_/\/_/
     / / /\ \ \     <span style="color:#F90000;">/ / /\ \_\</span>  / / /\ \___/ // / /\ \_\ / / /\ \___\ / /_ \ \   / / /\ \___/ /
    / / /  \ \_\   <span style="color:#F90000;">/ / /_/ / /</span> / / /  \/____// / /_/ / / \ \ \ \/___// / /\ \ \ / / /  \/____/
   / / /    \/_/  <span style="color:#F90000;">/ / /__\/ /</span> / / /    / / // / /__\/ /   \ \ \     / / /  \/_// / /    / / /
  / / /          <span style="color:#F90000;">/ / /_____/</span> / / /    / / // / /_____/_    \ \ \   / / /      / / /    / / /    _   _
 / / /________  <span style="color:#F90000;">/ / /\ \ \</span>  / / /    / / // / /\ \ \ /_/\__/ / /  / / /      / / /    / / /   /_/\/_/\
/ / /_________\<span style="color:#F90000;">/ / /  \ \ \</span>/ / /    / / // / /  \ \ \\\ \/___/ /  /_/ /      / / /    / / /    \_\/\_\/
\/____________/<span style="color:#F90000;">\/_/    \_\/</span>\/_/     \/_/ \/_/    \_\/ \_____\/   \_\/       \/_/     \/_/




<!--
ASCII ARTWORK GENERATED BY CRNRSTN :: v' . self::$version_crnrstn . '
ARTWORK TITLE :: Impossible
TIMESTAMP :: ' . $this->return_micro_time() . '

CREATIVE SOURCE :: http://patorjk.com/software/taag/#p=display&f=Impossible&t=CRNRSTN%20%3A%3A
DATE :: Sunday, Jul 31, 2022 @ 0949 hrs ::
-->
';


        $tmp_crnrstnART[-2] = ' _______  <span style="color:#F90000;">______</span>    __    _  ______    _______  _______  __    _    ___   ___
|       |<span style="color:#F90000;">|    _ |</span>  |  |  | ||    _ |  |       ||       ||  |  | |  |   | |   |
|       |<span style="color:#F90000;">|   | ||</span>  |   |_| ||   | ||  |  _____||_     _||   |_| |  |___| |___|
|       |<span style="color:#F90000;">|   |_||_</span> |       ||   |_||_ | |_____   |   |  |       |   ___   ___
|      _|<span style="color:#F90000;">|    __  |</span>|  _    ||    __  ||_____  |  |   |  |  _    |  |   | |   |
|     |_ <span style="color:#F90000;">|   |  | |</span>| | |   ||   |  | | _____| |  |   |  | | |   |  |___| |___|
|_______|<span style="color:#F90000;">|___|  |_|</span>|_|  |__||___|  |_||_______|  |___|  |_|  |__|




<!--
ASCII ARTWORK GENERATED BY CRNRSTN :: v' . self::$version_crnrstn . '
ARTWORK TITLE :: Modular
TIMESTAMP :: ' . $this->return_micro_time() . '

CREATIVE SOURCE :: http://patorjk.com/software/taag/#p=display&f=Modular&t=CRNRSTN%20%3A%3A
DATE :: Sunday, Jul 31, 2022 @ 0949 hrs ::
-->
';


        $tmp_crnrstnART[-3] = '
<span style="color:#F90000;">        (        )  (    (               )</span>
<span style="color:#F90000;">   (    )\ )  ( /(  )\ ) )\ )  *   )  ( /(</span>
<span style="color:#F90000;">   )\  (()/(  )\())(()/((()/(` )  /(  )\())</span>
<span style="color:#F90000;"> (((_)  /(_))((_)\  /(_))/(_))( )(_))((_)\</span>
 <span style="color:#F90000;">)\</span>___ <span style="color:#F90000;">(_))</span>   _<span style="color:#F90000;">((</span>_<span style="color:#F90000;">)(</span>_<span style="color:#F90000;">)) (</span>_<span style="color:#F90000;">)) (</span>_<span style="color:#F90000;">(</span>_<span style="color:#F90000;">())</span>  _<span style="color:#F90000;">((</span>_<span style="color:#F90000;">)</span>  _  _
<span style="color:#F90000;">((</span>/ __|<span style="color:#F90000;">| _ \</span> | \| || _ \/ __||_   _| | \| | (_)(_)
 | (__ <span style="color:#F90000;">|   /</span> | .` ||   /\__ \  | |   | .` |  _  _
  \___|<span style="color:#F90000;">|_|_\</span> |_|\_||_|_\|___/  |_|   |_|\_| (_)(_)




<!--
ASCII ARTWORK GENERATED BY CRNRSTN :: v' . self::$version_crnrstn . '
ARTWORK TITLE :: Fire Font
TIMESTAMP :: ' . $this->return_micro_time() . '

CREATIVE SOURCE :: http://patorjk.com/software/taag/#p=display&f=Fire%20Font-k&t=CRNRSTN%20%3A%3A
DATE :: Sunday, Jul 31, 2022 @ 0949 hrs ::
-->
';

        $tmp_crnrstnART[-4] = '
    _______   <span style="color:#F90000;">.-------.</span>    ,---.   .--..-------.       .-\'\'\'-. ,---------. ,---.   .--.          _ _    _ _
   /   __  \  <span style="color:#F90000;">|  _ _   \</span>   |    \  |  ||  _ _   \     / _     \\           \|    \  |  |         ( ` )  ( ` )
  | ,_/  \__) <span style="color:#F90000;">| ( \' )  |</span>   |  ,  \ |  || ( \' )  |    (`\' )/`--\' `--.  ,---\'|  ,  \ |  |        (_{;}_)(_{;}_)
,-./  )       <span style="color:#F90000;">|(_ o _) /</span>   |  |\_ \|  ||(_ o _) /   (_ o _).       |   \   |  |\_ \|  |         (_,_)  (_,_)
\  \'_ \'`)   <span style="color:#F90000;">  | (_,_).\' __</span> |  _( )_\  || (_,_).\' __  (_,_). \'.     :_ _:   |  _( )_\  |
 > (_)  )  __ <span style="color:#F90000;">|  |\ \  |  |</span>| (_ o _)  ||  |\ \  |  |.---.  \  :    (_I_)   | (_ o _)  |           _      _
(  .  .-\'_/  )<span style="color:#F90000;">|  | \ `\'   /</span>|  (_,_)\  ||  | \ `\'   /\    `-\'  |   (_(=)_)  |  (_,_)\  |         _( )_  _( )_
 `-\'`-\'     /<span style="color:#F90000;"> |  |  \    / </span>|  |    |  ||  |  \    /  \       /     (_I_)   |  |    |  |        (_ o _)(_ o _)
   `._____.\'  <span style="color:#F90000;">\'\'-\'   `\'-\'</span>  \'--\'    \'--\'\'\'-\'   `\'-\'    `-...-\'      \'---\'   \'--\'    \'--\'         (_,_)  (_,_)




<!--
ASCII ARTWORK GENERATED BY CRNRSTN :: v' . self::$version_crnrstn . '
ARTWORK TITLE :: Flower Power
TIMESTAMP :: ' . $this->return_micro_time() . '

CREATIVE SOURCE :: http://patorjk.com/software/taag/#p=display&f=Flower%20Power&t=CRNRSTN%20%3A%3A
DATE :: Sunday, Jul 31, 2022 @ 0949 hrs ::
-->
';


        $tmp_crnrstnART[-5] = '
   _____ <span style="color:#F90000;">_____</span>  _   _ _____   _____ _______ _   _
  / ____<span style="color:#F90000;">|   __ \</span>| \ | |  __ \ / ____|__   __| \ | |  _ _
 | |    <span style="color:#F90000;">|  |__) |</span>  \| | |__) | (___    | |  |  \| | (_|_)
 | |    <span style="color:#F90000;">|  __  /</span>| . ` |  _  / \___ \   | |  | . ` |
 | |____<span style="color:#F90000;">|  | \ \</span>| |\  | | \ \ ____) |  | |  | |\  |  _ _
  \_____<span style="color:#F90000;">|__|  \_\</span>_| \_|_|  \_\_____/   |_|  |_| \_| (_|_)




<!--
ASCII ARTWORK GENERATED BY CRNRSTN :: v' . self::$version_crnrstn . '
ARTWORK TITLE :: Big
TIMESTAMP :: ' . $this->return_micro_time() . '

CREATIVE SOURCE :: http://patorjk.com/software/taag/#p=display&f=Big&t=CRNRSTN%20%3A%3A
DATE :: Thursday, August 25, 2022 @ 0948 hrs ::
-->
';

        if(!isset($index)){

            return $tmp_crnrstnART[rand(-5, 4)];

        }else{

            return $tmp_crnrstnART[$index];

        }

    }

    public function __destruct(){

    }

}