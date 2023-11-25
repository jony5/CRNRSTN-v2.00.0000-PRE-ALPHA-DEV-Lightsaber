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
# # C # U # S # T # O # M # # # : : # # ##
#
#  CLASS :: crnrstn_bassdrive_stream_relay
#  VERSION :: 1.00.0000
#  DATE :: November 10, 2021 @ 2202 hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI ::
#  DESCRIPTION :: In memory of my boy, J5,...who would
#                 have turned 16 today if he had not
#                 kicked the bucket back in August.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
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