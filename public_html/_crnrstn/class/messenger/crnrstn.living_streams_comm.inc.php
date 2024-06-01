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
#  CLASS :: crnrstn_living_streams_comm
#  VERSION :: 1.00.0000
#  DATE :: October 9, 2018 @ 1446 hrs.
#  AUTHOR :: Jonathan '5' Harris, jharris@eVifweb.com, eVifweb@gmail.com.
#  URI :: http://eVifweb.jony5.com
#  DESCRIPTION ::
#  LICENSE :: MIT | https://crnrstn.jony5.com/licensing/
#
class crnrstn_living_streams_comm {

    private static $max_stream_depth;
    private static $max_reply_count;

    public $data_attribute_ARRAY = array();
    public $feeder_stream_ARRAY = array();
    public $is_feeder_stream = true;
    public $queued_for_display = false;
    public $stream_id;
    public $stream_content;
    public $stream_html_dom_key;
    public $channel;
    public $devicetype;
    public $is_selected=false;

    public function __construct($channel, $devicetype, $serial, $resp_profile, $oDB_RESP, $pos, $is_aggregate=false){
        try{

            $this->channel = $channel;
            $this->devicetype = $devicetype;

            $tmp_oENV = $oDB_RESP->return_oENV();

            $tmp_field_ARRAY = $oDB_RESP->return_field_names_ARRAY($serial);

            //
            // EXTRACT DATA FROM oDB_RESP OBJECT FOR THIS STREAM COMMUNICATION
            if($is_aggregate){

                //
                // THIS AGG RETURN METHOD PROVIDES GREAT RECORD LEVEL INSIGHT
                $tmp_row_data = $oDB_RESP->return_aggregate_element($resp_profile, $pos);  // 0- PROFILE, 1- DATA, 2- FIELDS

                foreach($tmp_field_ARRAY as $key => $SQL_fieldname){
                    $this->injest_data_element($SQL_fieldname, $tmp_row_data[1][$key]);

                    if($SQL_fieldname=="STREAM_ID"){
                        $this->stream_id = $tmp_row_data[1][$key];

                    }else{
                        if($SQL_fieldname=="STREAM_CONTENT"){

                            $this->stream_content = $tmp_row_data[1][$key];
                        }

                    }
                }

            }else{

                foreach($tmp_field_ARRAY as $key => $SQL_fieldname){
                    # $this->consume_data_element([FIELDNAME],[VALUE])
                    $this->injest_data_element($SQL_fieldname, $oDB_RESP->return_data_element($serial, $resp_profile, $SQL_fieldname, $pos));

                }

                //
                // FOR DEBUGGING
                $this->stream_id = $oDB_RESP->return_data_element($serial, $resp_profile, "STREAM_ID", $pos);
                $this->stream_content = $oDB_RESP->return_data_element($serial, $resp_profile, "STREAM_CONTENT", $pos);
            }

            //
            // CREATE HTML DOM KEY. CAN ALSO SERVE AS STREAM DOM ID
            $this->stream_html_dom_key = "LVNGSTRM".$pos."_".$this->hash($this->return_attribute_data('STREAM_ID'));

            //
            // NOW THAT WE HAVE ALL THE DATA. SOME META PROCESSING
            #error_log("stream (31) IDs STREAM_ID_FLOW->" . crc32($this->return_attribute_data('STREAM_ID_FLOW')) . "|FEEDER_STREAM_ID->" . crc32($this->return_attribute_data('FEEDER_STREAM_ID')));
            if($this->return_attribute_data('STREAM_ID_FLOW') == $this->return_attribute_data('FEEDER_STREAM_ID')){
                $this->is_feeder_stream = false;

            }

            switch($this->channel){
                case 'WEB':
                    if($this->devicetype=='m'){
                        self::$max_stream_depth = (int)$tmp_oENV->getEnvParam('MOBILE_WEB_STREAM_DEPTH');
                        self::$max_reply_count = (int)$tmp_oENV->getEnvParam('MOBILE_WEB_MAX_REPLY_COUNT');
                    }else{
                        self::$max_stream_depth = (int)$tmp_oENV->getEnvParam('DESKTOP_WEB_STREAM_DEPTH');
                        self::$max_reply_count = (int)$tmp_oENV->getEnvParam('DESKTOP_WEB_MAX_REPLY_COUNT');
                    }

                break;
                case 'EMAIL':
                break;
                case 'SMS':
                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('The channel [' . $channel.'] does not exist for stream data output processing.');

                break;

            }


        }catch(Exception $e){
            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('living_stream->__construct()', LOG_EMERG, $e->getMessage());
        }

        /*`comm_stream`.`STREAM_ID`,
        `comm_stream`.`STREAM_TYPE`,
        `comm_stream`.`CLIENT_ID`,
        `comm_stream`.`USER_ID`,
        `comm_stream`.`ISACTIVE`,
        `comm_stream`.`KIVOTOS_ID`,
        `comm_stream`.`ASSET_ID`,
        `comm_stream`.`STREAM_CONTENT`,
        `comm_stream`.`STREAM_FORMATTED`,
        `comm_stream`.`FEEDER_STREAM_COUNT`,
        `comm_stream`.`I_FEED_STREAM_ID`,
        `comm_stream`.`DATEMODIFIED`,
        `comm_stream`.`DATECREATED`,
        `comm_stream_flow`.`FLOW_ID`,
        `comm_stream_flow`.`CLIENT_ID` AS `CLIENT_ID_FLOW`,
        `comm_stream_flow`.`STREAM_ID` AS `STREAM_ID_FLOW`,
        `comm_stream_flow`.`FEEDER_STREAM_ID`'

              $channel[WEB,EMAIL,SMS],
             * $devicetype[m,d],
             * $streamtype[KIVOTOS,ASSET,USER,CLIENT,LANG],
             * $oDB_RESP[OBJ]
             *

                                                   MOBILE_WEB_STREAM_DEPTH', 3);
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'MOBILE_WEB_MAX_REPLY_COUNT', 2);
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'DESKTOP_WEB_STREAM_DEPTH', 7);
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'DESKTOP_WEB_MAX_REPLY_COUNT', 5);

        */

    }

    public function mark_selected($stream_id){
        $tmp_id = $this->data_attribute_ARRAY[$this->hash('STREAM_ID')];
        if($stream_id==$tmp_id){
            error_log("stream (149) i am selected [".$stream_id."]");
            $this->is_selected=true;

        }
    }

    public function return_attribute($var){
        switch($var){
            case 'max_stream_depth':
                return self::$max_stream_depth;
            break;
            case 'max_reply_count':
                return self::$max_reply_count;
            break;

        }

    }

    public function return_attribute_data($field){
        try{

            if(isset($this->data_attribute_ARRAY[$this->hash($field)])){

                return $this->data_attribute_ARRAY[$this->hash($field)];
            }else{

                //
                // HOOOSTON...VE HAF PROBLEM! NO PROBLEM. BASIC NULL FIELD WILL THROW ERR...NOT NECESSARILY STRUCTURE ERROR.
                #throw new Exception('Field [' . $field . '] does not exist for this stream data element STREAM_ID=' . $this->stream_id);
            }


        }catch(Exception $e){
            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('living_stream->return_data_element()', LOG_EMERG, $e->getMessage());
        }
    }

    public function merge_feeder($feeder_stream_id){
        error_log("living_stream (186) merge_feeder() feeder_stream_id->".$feeder_stream_id);
        $this->feeder_stream_ARRAY[] = $feeder_stream_id;

    }

    public function return_feeders(){

        return $this->feeder_stream_ARRAY;
    }

    public function return_feeder_count(){

        return sizeof($this->feeder_stream_ARRAY);
    }

    private function injest_data_element($field,$value){
        #error_log("stream (132) injest_data_element() field->".$field."|val->".$value);
        $this->data_attribute_ARRAY[$this->hash($field)] = $value;
    }


    public function __destruct(){

    }

}