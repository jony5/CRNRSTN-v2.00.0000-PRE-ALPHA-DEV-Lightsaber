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
#  CLASS :: crnrstn_bassdrive_stream_relay
#  VERSION :: 1.00.0000
#  DATE :: November 10, 2021 @ 2202 hrs.
#  AUTHOR :: Jonathan '5' Harris, jharris@eVifweb.com, eVifweb@gmail.com.
#  URI :: http://eVifweb.jony5.com
#  DESCRIPTION :: In memory of my boy, J5,...who would
#                 have turned 16 today if he had not
#                 kicked the bucket back in August.
#  LICENSE :: MIT | https://crnrstn.jony5.com/licensing/
#
class crnrstn_bassdrive_stream_relay {

    protected $relay_serial;
    protected $stream_relay_ojson_serial;
    protected $stream_relay_nowplaying_title;

    protected $relay_meta_ARRAY = array();
    protected $stream_relay_isactive = 0;

    public function __construct($relay_serial, $ojson_serial, $nowplaying_title){

        $this->stream_relay_ojson_serial = $ojson_serial;
        $this->stream_relay_nowplaying_title = $nowplaying_title;

        $this->relay_serial = $relay_serial;

    }

    public function return_stream_title(){

        $tmp_nowplaying_len = strlen($this->stream_relay_nowplaying_title);
        $tmp_title_len = strlen($this->relay_meta_ARRAY['title']);
        if($tmp_nowplaying_len > 5 && $tmp_nowplaying_len >= $tmp_title_len){

            return $this->stream_relay_nowplaying_title;

        }else{

            return $this->relay_meta_ARRAY['title'];

        }

    }

    public function return_serial(){

        return $this->relay_serial;

    }

    public function return_isactive(){

        return $this->stream_relay_isactive;

    }

    public function load_meta($json_relay_node){

        /*
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
         * */

        //
        // RELAY IS ACTIVE
        if(isset($json_relay_node['status'])){

            if($json_relay_node['status'] == 1 || $json_relay_node['status'] == '1'){

                $this->stream_relay_isactive = 1;

            }

        }

        $this->store_local_meta('bitrate', $json_relay_node);
        $this->store_local_meta('status', $json_relay_node);
        $this->store_local_meta('name', $json_relay_node);
        $this->store_local_meta('listenerCount', $json_relay_node);
        $this->store_local_meta('listenerCountPercentage', $json_relay_node);
        $this->store_local_meta('audioFormat', $json_relay_node);
        $this->store_local_meta('streamURL', $json_relay_node);
        $this->store_local_meta('streamURLios', $json_relay_node);
        $this->store_local_meta('title', $json_relay_node);


    }

    private function store_local_meta($meta_type, $json_node){

        if(isset($json_node[$meta_type])){

            $this->relay_meta_ARRAY[$meta_type] = $json_node[$meta_type];

        }

    }

    public function __destruct() {

    }

}