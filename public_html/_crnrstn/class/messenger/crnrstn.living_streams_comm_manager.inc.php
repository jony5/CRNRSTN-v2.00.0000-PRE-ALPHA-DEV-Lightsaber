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
# # C # R # N # R # S # T # N # : : # # # #
#
#  CLASS :: crnrstn_living_streams_comm_manager
#  VERSION :: 1.00.0000
#  DATE :: April 14, 2020 2202hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI ::
#  DESCRIPTION ::
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_living_streams_comm_manager {

    public $tmp_buildOutput;
    public $tmp_buildOutput_N;
    public $tmp_output_flag_ARRAY;
    public $tmp_buildOutput_ARRAY = array();
    public $stream_vert_flow_DOM_handles;
    public $replicate_flag_ARRAY = array();
    public $queued_for_display = array();

    private static $oLogger;
    private static $oData;
    private static $oUserEnvironment;
    private static $oUser;
    private static $stream_mention_ARRAY = array();
    private static $stream_eid_coor_ARRAY = array();
    private static $stream_lookup_id_ARRAY = array();
    private static $stream_lookup_id_profile_ARRAY = array();
    private static $stream_dbresp_serial_ARRAY = array();
    private static $stream_key_count = 0;
    private static $max_stream_depth;
    private static $max_reply_display_count;
    private static $db_response_serial_handle_ARRAY = array();
    private static $stream_mention_Case_ARRAY = array();
    private static $replyFormHTML_ID;
    private static $current_stream_order = 0;
    private static $stream_depth_monitor_ARRAY = array();

    public function __construct($oENV,$oUSER){

        //
        // INSTANTIATE LOGGER
        self::$oLogger = new crnrstn_logging();

        self::$oUserEnvironment = $oENV;
        self::$oUser = $oUSER;

        self::$replyFormHTML_ID = "STREAMREPLY_".self::$oUser->generateNewKey(10);
    }

    public function init_order_depth($stream_id){

        $tmp_order0_key = $this->hash($stream_id);

        self::$stream_depth_monitor_ARRAY[$tmp_order0_key] = 0;

        return $tmp_order0_key;
    }

    public function increment_order_depth($order_key){

        self::$stream_depth_monitor_ARRAY[$order_key]++;
    }

    public function decrement_order_depth($order_key){

        self::$stream_depth_monitor_ARRAY[$order_key]--;
    }

    public function return_order_depth($order_key){

        return self::$stream_depth_monitor_ARRAY[$order_key];
    }

    public function returnReplyformID(){

        return self::$replyFormHTML_ID;
    }

    public function return_oUser(){

        return self::$oUser;
    }

    public function return_stream_lookup_array($type){

        switch($type){
            case 'PROFILE':

                return self::$stream_lookup_id_profile_ARRAY;

            break;
            case 'ID':

                return self::$stream_lookup_id_ARRAY;

            break;
            case 'SERIAL':

                return self::$stream_dbresp_serial_ARRAY;

            break;

        }

    }

    public function return_serial_handle(){

        //
        // RETURN REFERENCE TO DATABASE RESPONSE SERIALIZATION. LAST ELEMENT OF ARRAY.
        $tmp_last_handle = end(self::$db_response_serial_handle_ARRAY);

        return $tmp_last_handle;

    }

    public function load_stream_data($channel,$devicetype,$streamtype,$response_profile,$profile_field, $serial, $oDB_RESP){

        if($streamtype=='DEEP'){
            self::$oData = $oDB_RESP->return_oDB();

            $oDB_RESP = self::$oData->processStreamRequest('get_stream_deep_data', $this, self::$oUserEnvironment, $oDB_RESP);
            error_log("stream (302) finished processStreamRequest()...");
            return $oDB_RESP;

        }else{

            $tmp_response_profile_ARRAY = explode("|", $response_profile);
            $tmp_response_profile_field_ARRAY = explode("|", $profile_field);
            $tmp_count_profiles = sizeof($tmp_response_profile_ARRAY);
            $tmp_oResp_profile_array = $oDB_RESP->return_profiles($serial);

            //
            // CONFIRM THAT DESIRED PROFILE IS AVAILABLE IN RESPONSE OBJECT
            for($i=0;$i<$tmp_count_profiles;$i++){

                if(!in_array($tmp_response_profile_ARRAY[$i], $tmp_oResp_profile_array)){

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('The provided profile type (' . $tmp_response_profile_ARRAY[$i].') cannot be found in the database response object.');

                }
            }

            //
            // FOR EACH RESPONSE PROFILE, GET ALL ID FOR SQL LOOKUP ON STREAM DATA
            for($i=0;$i<$tmp_count_profiles;$i++){

                $tmp_loop_size = $oDB_RESP->return_sizeof($serial, $tmp_response_profile_ARRAY[$i]);

                for($ii=0;$ii<$tmp_loop_size;$ii++){
                    //
                    // STORE KEYS FROM DATABASE RESPONSE
                    #error_log("stream (278) serial[".$serial."] tmp_response_profile_ARRAY[".$tmp_response_profile_ARRAY[$i]."] tmp_response_profile_field_ARRAY[".$tmp_response_profile_field_ARRAY[$i]."] ii[".$ii."]");
                    self::$stream_lookup_id_ARRAY[self::$stream_key_count] = $oDB_RESP->return_data_element($serial, $tmp_response_profile_ARRAY[$i], $tmp_response_profile_field_ARRAY[$i], $ii);
                    self::$stream_lookup_id_profile_ARRAY[self::$stream_key_count] = $tmp_response_profile_ARRAY[$i];
                    self::$stream_dbresp_serial_ARRAY[self::$stream_key_count] = $serial;
                    self::$stream_key_count++;

                }

            }

            //
            // WE HAVE ALL ID AND PROFILE TYPE. READY TO PERFORM DB OPERATIONS FOR READ TO COMPLETE "GET" OF DATA
            self::$oData = $oDB_RESP->return_oDB();

            #$tmp_serial_handle = 'STREAM_MAIN';
            $oDB_RESP = self::$oData->processStreamRequest('get_stream_data', $this, self::$oUserEnvironment, $oDB_RESP);

            return $oDB_RESP;
        }
    }

    //
    // DOES NOT PROCESS SEARCH RESULTS. RETURNS STREAM DATA BASED UPON DATA STRUCTURE
    public function return_streams($channel,$devicetype,$streamtype,$response_profile,$profile_field,$serial,$oDB_RESP=NULL){
        try{

            /* $channel[WEB,EMAIL,SMS],
             * $devicetype[m,d],
             * $streamtype[KIVOTOS,ASSET,USER,CLIENT,LANG],
             * $oDB_RESP[OBJ]
             * */
            # self::$oUserEnvironment->getEnvParam('MOBILE_WEB_STREAM_DEPTH');
            # self::$oUserEnvironment->getEnvParam('DESKTOP_WEB_STREAM_DEPTH');
            switch($devicetype){
                case "m":

                    self::$max_stream_depth = self::$oUserEnvironment->getEnvParam('MOBILE_WEB_STREAM_DEPTH');

                    if($streamtype=='DEEP'){

                        self::$max_reply_display_count = 1000;

                    }else{

                        self::$max_reply_display_count = self::$oUserEnvironment->getEnvParam('MOBILE_WEB_MAX_REPLY_COUNT');

                    }

                break;
                default:

                    self::$max_stream_depth = self::$oUserEnvironment->getEnvParam('DESKTOP_WEB_STREAM_DEPTH');

                    if($streamtype=='DEEP'){

                        self::$max_reply_display_count = 1000;

                    }else{

                        self::$max_reply_display_count = self::$oUserEnvironment->getEnvParam('DESKTOP_WEB_MAX_REPLY_COUNT');

                    }

                break;

            }

            //
            // GET AND PROCESS DATA FOR OUTPUT
            $oDB_RESP = $this->load_stream_data($channel,$devicetype,$streamtype,$response_profile,$profile_field,$serial,$oDB_RESP);

            //
            // OUTPUT DATA PREPARATION AND RETURN
            return $this->assemble_output($channel,$devicetype,$streamtype,$response_profile,$profile_field,$oDB_RESP);


        }catch(Exception $e){
            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('stream_manager->return_streams()', LOG_EMERG, $e->getMessage());

        }

    }

    public function process_mention_input($stream_content,$stream_eid){

        //
        // PARSE STREAM_CONTENT
        $this->prep_stream_content_for_mention_extract($stream_content);

        $tmp_mention_loop_size = sizeof(self::$stream_mention_ARRAY);

        //
        // IF WE HAVE @MENTIONS...THEN GO THROUGH THE WORK TO PREPARE AND PROCESS EID's
        if($tmp_mention_loop_size>0){
            self::$stream_eid_coor_ARRAY = explode("|", $stream_eid);

            $tmp_eid_loop_size = sizeof(self::$stream_eid_coor_ARRAY);
            for($i=0;$i<$tmp_eid_loop_size;$i++){
                $tmp_decrypt_result = self::$oUserEnvironment->data_decrypt(self::$stream_eid_coor_ARRAY[$i]);
                #error_log("stream (170) decrypt of mention pipe delim array value[".self::$stream_eid_coor_ARRAY[$i]."] to [".$tmp_decrypt_result."]");
                self::$stream_eid_coor_ARRAY[$i] = $tmp_decrypt_result;
            }

            //
            // NOW WE HAVE [@REWREW=12344,@WFEWFWF=12444,@REWREREW=13444] & [@REWRWREW,@RWREWRWR,@EFEFWWF] ASSUMING USER USED LINK TO INPUT @MENTION
            // WHAT IF SOMEONE TYPOS AN EXISTING @MENTION...OR TYPOS A MANUAL ENTRY...
            // WE NEED TO GO THROUGH IDS AND RETRIEVE..
            // DO WE WANT TO SUPPORT SOMEONE MANUALLY TYPING IN AN @MENTION? LIKE...IF WE HAVE AN @XXXX THEN TAKE THE TIME TO TRY TO MATCH IT TO USER_ID?

            //
            // WELL. FOR STARTERS...IF @MENTION COUNT AND EID COUNT IS SAME...JUST PROCESS EIDs...right? LETS TIE IT DOWN. EVERYTHING PROCESSED THE SAME WAY.
            // MENTIONS SHOULD BE HYPERLINKED TO USER PROFILE PAGES. IF THIS DOESN'T HAPPEN, YOU FAIL.

            #self::$stream_mention_ARRAY[$tmp_mentionCnt]
            #self::$stream_mention_USER_ID_ARRAY[$tmp_mentionCnt]

        }

    }

    public function mention_accounted($eid){

        //
        // DO WE HAVE RECORD OF THIS EID?
        $tmp_loop_size = sizeof(self::$stream_eid_coor_ARRAY);
        for($i=0;$i<$tmp_loop_size;$i++){
            $tmp_eid_coor = self::$stream_eid_coor_ARRAY[$i];
            $pos = strpos($tmp_eid_coor, $eid);

            if($pos !== false){
                return true;
            }

        }

        return false;

    }

    public function return_mention_count(){

        return sizeof(self::$stream_mention_ARRAY);
    }

    public function return_mention_data($pos=NULL){
        if(isset($pos)){
            return self::$stream_mention_ARRAY[$pos];

        }else{

            return self::$stream_mention_ARRAY;
        }
    }

    public function return_mention_case($mention){

        return self::$stream_mention_Case_ARRAY[$mention];
    }

    private function prep_stream_content_for_mention_extract($str){

        //
        # CONVERT ALL PUNCTUATION TO SPACES AND LOWERCASE. DISREGARD CASE IN DATABASE...JUST STORE ALL LOWERCASE
        # (BUT DISPLAY WITH PROPER CASE TO END USERS)
        # LOOKING FOR FORMAT  @USERNAME EWREW REWR ERWRW @USERNAME REWREW REWFSDFDS TRTRE @USERNAME. THERE MUST BE SPACE AT END OF @MENTION FOR DETECTION.
        # IT WOULD MORE SENSE TO PERFORM THE @MENTION LINKING HERE...RIGHT? IN THIS CLASS. LET'S SEE IF WE CAN FIND A GOOD PLACE TO TRANSFORM @MENTION DATA

        $str = $this->mention_parseSanitize($str);
        $tmp_mentionCnt = 0;

        //
        // MY NEXT BEST MOVE WOULD BE TO EXPLODE ON SPACES, I THINK.
        $tmp_stream_content_space_explode_ARRAY = explode(" ", $str);

        $tmp_loop_size = sizeof($tmp_stream_content_space_explode_ARRAY);
        for($i=0;$i<$tmp_loop_size;$i++){

            //
            // DO I HAVE AN @...AND FILTER OUT ANY NON-LEADING @
            $pos = strpos($tmp_stream_content_space_explode_ARRAY[$i], "@");

            if(($pos !== false) && ($pos < 1)){

                //
                // WE HAVE @. STORE TRIMMED VALUE INTO ARRAY. WE WILL INVESTIGATE RESULTS LATER.
                // WHY ARE WE CHANGING FORMAT TO LOWER...PERHAPS IN PREP FOR DB LOOKUP? WE CANNOT ASSUME @MENTION CASE. USER CAN
                // ENTER MANUALLY...CASE SHOULD NOT MATTER..WE LOWER THIS BEFORE TOUCHING DB
                self::$stream_mention_ARRAY[$tmp_mentionCnt] = trim($tmp_stream_content_space_explode_ARRAY[$i]);
                self::$stream_mention_Case_ARRAY[strtolower(self::$stream_mention_ARRAY[$tmp_mentionCnt])] = trim($tmp_stream_content_space_explode_ARRAY[$i]);
                #self::$stream_mention_ARRAY[$tmp_mentionCnt] = trim(strtolower($tmp_stream_content_space_explode_ARRAY[$i]));
                #error_log("stream (81) mention->".self::$stream_mention_ARRAY[$tmp_mentionCnt]);
                $tmp_mentionCnt++;

            }

        }

    }

    # TUNE!!!   BOH! BOH! BOH!  PULL UP!! PULL UP! YEAH! FROM THE T..O...P...La Rou..going in for the kill...methodus 041209 43min.

    private function injest_stream_relation($stream_id, $i_feed_id, $living_stream_oARRAY){

        //
        // TELL $i_feed_id IT IS BEING FEAD BY $stream_id
        if(isset($living_stream_oARRAY[$i_feed_id])){
            $tmp_liv_stream = $living_stream_oARRAY[$i_feed_id];

            $tmp_liv_stream->merge_feeder($stream_id);

            $living_stream_oARRAY[$i_feed_id] = $tmp_liv_stream;

        }

        return $living_stream_oARRAY;

    }

    private function buildOutputZERO($oLIVING_STREAM, $stream_oARRAY, $stream_manager, $oDB_RESP){

        error_log("stream (567) buildOutputZERO() for ".$oLIVING_STREAM->stream_html_dom_key);

        //
        // WE NEED TO SUPPORT N+1 DYNAMIC TRAVERSAL OF STREAM RELATIONS...OR SOMETHING LIKE THAT
        // WE HAVE THE LIVING_STREAM, THE ARRAY OF STREAMS AND THE STREAM MANAGER.

        //
        // FIRST...ORDER = 0 STREAM BUILDOUT
        // WE CAN COMPILE THE HTML GUTS HERE. IS THAT OK? WE MAY NOT HAVE A CHOICE.

        //
        // HOW DO WE KNOW HOW DEEP WE ARE IN THE ORDER?

        #$tmp_feeder_count = $oLIVING_STREAM->return_attribute_data('FEEDER_STREAM_COUNT');  // USE THIS FOR N DISPLAY NEXT TO REPLY LINK...NOT ARRAY SIZE DETERMINATION

        #$tmp_feeder_id_array = // SEE IF YOU CAN WORK DIRECTLY WITH THE OBJECT'S PUBLIC ARRAY
        $tmp_feeder_count = sizeof($oLIVING_STREAM->feeder_stream_ARRAY);

        //
        // THIS IS FOR N+1 PROCESSING.
        // SO I PROCESS 0-100 FIRST. THEN FLIP THE OUTPUT ARRAY.
        if($tmp_feeder_count>0){

            $tmp_depth_key = $stream_manager->init_order_depth($oLIVING_STREAM->stream_html_dom_key);

            //
            // CYCLE THROUGH $stream_oARRAY LOOKING FOR FEEDERS...WE HAVE THIS ALREADY...ACTUALLY..
            // FOOD IS HERE SO....BEING SLOW....
            // WE ARE ORDER n HERE
            //error_log("stream (474) stream ".$oLIVING_STREAM->stream_html_dom_key." has ".$tmp_feeder_count." feeders.");
            #for($i = 0; $i < $tmp_feeder_count; $i++){
            #error_log("stream (456) oSTR::feeder_stream_ARRAY[".$i."] ->" . $oLIVING_STREAM->feeder_stream_ARRAY[$i]);

            //
            // THIS ORDER 0 STREAM HAS FEEDER STREAMS...THEY ALSO MAY HAVE FEEDER STREAMS....AND THOSE STREAMS COULD HAVE FEEDERS TOO...ETC..
            // STORE RAW HTML IN THIS ARRAY. THIS SHOULD RETURN ALL HTML FOR STREAM + N+1 HERE
            #$stream_manager->tmp_buildOutput_ARRAY[] = $this->replicate_N($oLIVING_STREAM, $stream_oARRAY, $stream_manager, $oDB_RESP);
            //error_log("stream (482) buildOutputZERO (n+1) for ".$oLIVING_STREAM->stream_html_dom_key);
            error_log("stream (605) replicate_N being called by buildOutputZERO...".$oLIVING_STREAM->stream_content);
            if(!isset($this->replicate_flag_ARRAY[$oLIVING_STREAM->stream_html_dom_key])){
                $this->replicate_flag_ARRAY[$oLIVING_STREAM->stream_html_dom_key] = 1;
                $this->tmp_buildOutput_ARRAY[] = $this->replicate_N($oLIVING_STREAM, $stream_oARRAY, $stream_manager, $oDB_RESP, $tmp_depth_key);
                #$this->queued_for_display[$oLIVING_STREAM->stream_html_dom_key] = true;
            }

        }else{

            //
            // PROCESS ORDER 0 WITH NO FEEDER STREAMS. LET'S TRY TO GET THIS WORKING AS PROOF OF CONCEPT FOR THIS ARCHITECTURE
            #$stream_manager->tmp_buildOutput_ARRAY[] = $this->replicate_0($oLIVING_STREAM,$stream_oARRAY, $stream_manager, $oDB_RESP);
            //error_log("stream (494) buildOutputZERO for ".$oLIVING_STREAM->stream_html_dom_key);
            error_log("stream (619) replicate_0 being called by buildOutputZERO...".$oLIVING_STREAM->stream_content);
            if(!isset($this->queued_for_display[$oLIVING_STREAM->stream_html_dom_key])){
                $this->tmp_buildOutput_ARRAY[] = $this->replicate_0($oLIVING_STREAM, $stream_oARRAY, $stream_manager, $oDB_RESP);

            }
        }

    }

    private function replicate_0($oLIVING_STREAM, $stream_oARRAY, $stream_manager, $oDB_RESP){

        //error_log("stream (548) replicate_0 ".$oLIVING_STREAM->stream_html_dom_key."|".$oLIVING_STREAM->stream_content);

        //
        // ORDER = 0 STREAM DISPLAY. [LIVING_STREAM OBJECT OUTPUT - ORDER = 0]

        // GET [LIVING_STREAM OBJECT OUTPUT - ORDER = 0]
        if(!isset($this->queued_for_display[$oLIVING_STREAM->stream_html_dom_key])){
            #error_log("stream (556) return **HTML OUTPUT** for ".$oLIVING_STREAM->stream_html_dom_key."|".$oLIVING_STREAM->stream_content);
            $tmp_stream_HTML = $this->living_stream_HTML_translation($oLIVING_STREAM, $oDB_RESP, $stream_manager->return_oUser());
            $this->queued_for_display[$oLIVING_STREAM->stream_html_dom_key] = true;
            #error_log("stream (557) output DUPLICATE CHECK count->".substr_count($tmp_stream_HTML, 'Reply here no file attach'));
            return $tmp_stream_HTML;

        }else{
            error_log("stream (641) display skipped ".$oLIVING_STREAM->stream_html_dom_key);
            return NULL;
        }


//        # HTML STRUCT WITH JUST ORDER 0 STREAM (NO REPLIES)
//        <div id="stream_00_wrapper">
//            [VERT FLOW DIV - stream_vert_flow_00]
//            <div id="stream_order_00_wrapper" class="stream_order_wrapper">
//                [LIVING_STREAM OBJECT OUTPUT - ORDER = 0]
//                [LIVING_STREAM OBJECT OUTPUT - ORDER = 0]
//                [LIVING_STREAM OBJECT OUTPUT - ORDER = 0]
//                [LIVING_STREAM OBJECT OUTPUT - ORDER = 0]
//            </div><!-- // END stream_order_00_wrapper
//        </div><!-- // END stream_00_wrapper


//      [LIVING_STREAM OBJECT]
//		<div class="single_stream_wrapper">  <!-- NO ID FOR STREAM?? WE NOT NEED IT YET OR SOMETHING?....I GUESS NOT  -->
//            <div class="stream_content" onclick="evifweb_set_stream_content_style_height();"><a
//                        href="#">@JonathanHarris</a> can we update the color of the
//                background to make it align more to the logo
//                border and logo font color?
//            </div>
//            <div class="stream_owner">by <a href="#">Sally Johnson</a></div>
//            <div class="stream_stamp_reply_wrapper">
//                <div class="stream_timestamp">9.30.2018 @ 1340</div>
//                <div class="stream_reply"><a href="#">(5)</a> <a href="#">Reply</a></div>
//            </div>
//            <div class="cb_5"></div>
//            <div class="stream_hr"></div>
//        </div>


    }

    private function replicate_N($oLIVING_STREAM, $stream_oARRAY, $stream_manager, $oDB_RESP, $tmp_depth_key){

        //
        // WE NEED TO SUPPORT N+1 DYNAMIC TRAVERSAL OF STREAM RELATIONS...OR SOMETHING LIKE THAT
        // WE HAVE THE LIVING_STREAM, THE ARRAY OF STREAMS AND THE STREAM MANAGER.

        // ONCE I GET THIS WORKING. IT WILL WORK FOR ALL N+1 STREAMS. WE WILL BE DONE WITH THIS ARCHITECTURE AND CAN FOCUS ON DETAILS.

        //
        // GET [LIVING_STREAM OBJECT OUTPUT - ORDER = N]
        // OK. SO THIS IS GOING TO HAVE TO HAPPEN. THE HTML-ING OF THE LIVING_STREAM. MIGHT AS WELL HAPPEN HERE.
        #if(!isset($this->queued_for_display[$oLIVING_STREAM->stream_html_dom_key])){
        $this->tmp_buildOutput_N[$oLIVING_STREAM->stream_html_dom_key] = $this->living_stream_HTML_translation($oLIVING_STREAM, $oDB_RESP, $stream_manager->return_oUser());
        $this->queued_for_display[$oLIVING_STREAM->stream_html_dom_key] = true;

        //
        // IF OUR DEPTH IS AT THE LIMIT...DO NOT RENDER REPLIES HERE.
        $tmp_depth = (int)$stream_manager->return_order_depth($tmp_depth_key);
        error_log("stream (650) order compare[tmp/max] [" . $tmp_depth . "]/[" . self::$max_stream_depth . "]");
        if($tmp_depth <= self::$max_stream_depth){

            //
            // I THINK WE DO OPEN AND CLOSE HTML HERE...NOT SURE ABOUT THIS IMPLEMENTATION...WHICH ONE?
            $this->tmp_buildOutput_N[$oLIVING_STREAM->stream_html_dom_key . 'openHTML'] = $this->stream_order_HTML_opening($oLIVING_STREAM->stream_html_dom_key);

            //
            // GET MY FEEDER STREAMS READY FOR CYCLING
            // WE ONLY WANT TO DISPLAY THE LAST $max_reply_count NUMBER OF REPLIES. $oLIVING_STREAM->return_attribute('max_reply_count'); OR self::$max_reply_display_count
            $tmp_loop_size = sizeof($oLIVING_STREAM->feeder_stream_ARRAY);   # 10, 5, 2, 1, 0
            $tmp_delta = $tmp_loop_size - (int)self::$max_reply_display_count; # 8, 3, 0, -, -

            if($tmp_delta > (-1)){
                $loop_init = $tmp_delta;
            }else{

                $loop_init = 0;
            }

            for($ii = $loop_init; $ii < $tmp_loop_size; $ii++){
                #$oLIVING_STREAM->feeder_stream_ARRAY[$i]

                //
                // FOR EACH FEEDER STREAM
                $tmp_feeder_oLvStream = $stream_oARRAY[$oLIVING_STREAM->feeder_stream_ARRAY[$ii]];
                $tmp_feeder_count = sizeof($tmp_feeder_oLvStream->feeder_stream_ARRAY);

                //
                // THIS IS FOR N+1 PROCESSING. WE CAN HIT THIS LATER? OR NOW....
                //error_log("STREAM (572) FEEDER COUNT FOR FEEDER STREAM ".$tmp_feeder_oLvStream->stream_html_dom_key." = ".$tmp_feeder_count);
                if($tmp_feeder_count > 0){

                    //
                    // I NEED A WAY TO TIE ALL STREAM REPLIES AND NESTED REPLIES TOGETHER...LIKE AN ID OR SOMETHING.
                    $stream_manager->increment_order_depth($tmp_depth_key);

                    //
                    // WE ARE ORDER n HERE
                    for($i = 0; $i < $tmp_feeder_count; $i++){
                        //error_log("stream (456) oSTR::feeder_stream_ARRAY[".$i."] ->" . $oLIVING_STREAM->feeder_stream_ARRAY[$i]);
                        //
                        // THIS ORDER 0 STREAM HAS FEEDER STREAMS...THEY ALSO MAY HAVE FEEDER STREAMS....AND THOSE STREAMS COULD HAVE FEEDERS TOO...ETC..
                        // A MIRROR POINTING AT ANOTHER MIRROR TO GET WORK DONE...
                        // I THINK THIS MAY WORK...I NEED TO SORT OUT THE OPENING AND CLOSING HTML STUFF.
                        error_log("stream (643) nested replicate_N being called by replicate_N for " . $tmp_feeder_oLvStream->stream_html_dom_key);
                        #$this->tmp_buildOutput_N .= $this->replicate_N($tmp_feeder_oLvStream, $stream_oARRAY, $stream_manager, $oDB_RESP);
                        if(!isset($this->replicate_flag_ARRAY[$tmp_feeder_oLvStream->stream_html_dom_key])){
                            $this->replicate_flag_ARRAY[$oLIVING_STREAM->stream_html_dom_key] = 1;
                            $this->tmp_buildOutput_N[$tmp_feeder_oLvStream->stream_html_dom_key] = $this->replicate_N($tmp_feeder_oLvStream, $stream_oARRAY, $stream_manager, $oDB_RESP, $tmp_depth_key);
                            //$this->queued_for_display[$tmp_feeder_oLvStream->stream_html_dom_key] = true;
                        }

                        #error_log("stream (645) output DUPLICATE CHECK count->".substr_count($this->tmp_buildOutput_N, 'Reply here no file attach'));
                    }

                    $stream_manager->decrement_order_depth($tmp_depth_key);

                }else{

                    //
                    // PROCESS ORDER 0 WITH NO FEEDER STREAMS. LET'S TRY TO GET THIS WORKING AS PROOF OF CONCEPT FOR THIS ARCHITECTURE
                    // STILL UNSURE OF METHOD NAME
                    //error_log("stream (607) replicate_N() ABOUT TO CALL replicate_0 FOR ".$tmp_feeder_oLvStream->stream_html_dom_key);
                    #if($tmp_feeder_oLvStream->stream_html_dom_key!=$oLIVING_STREAM->stream_html_dom_key){
                    error_log("stream (764) replicate_0 being called by replicate_N...");
                    #$this->tmp_buildOutput_N .= $this->replicate_0($tmp_feeder_oLvStream,$stream_oARRAY, $stream_manager, $oDB_RESP);
                    if(!isset($this->queued_for_display[$tmp_feeder_oLvStream->stream_html_dom_key])){
                        $this->tmp_buildOutput_N[$tmp_feeder_oLvStream->stream_html_dom_key] = $this->replicate_0($tmp_feeder_oLvStream, $stream_oARRAY, $stream_manager, $oDB_RESP);
                        $this->queued_for_display[$tmp_feeder_oLvStream->stream_html_dom_key] = true;
                    }

                    #error_log("stream (657) output DUPLICATE CHECK count->".substr_count($this->tmp_buildOutput_N, 'Reply here no file attach'));
                }

                #error_log("stream (661) output DUPLICATE CHECK count->".substr_count($this->tmp_buildOutput_N, 'Reply here no file attach'));

            }

            #$this->tmp_buildOutput_N .= $this->stream_order_HTML_closing();
            $this->tmp_buildOutput_N[$oLIVING_STREAM->stream_html_dom_key . 'closeHTML'] = $this->stream_order_HTML_closing();

        }
        #}else{
        #    error_log("stream (782) display skipped ".$oLIVING_STREAM->stream_html_dom_key);

        #}

        //
        // THIS HTML WILL NEED TO CONTAIN ALL NESTED STREAM DATA. WE MAY NEED TO SERIALIZE A COMPONENT OF THIS EXPERIENCE TO SUPPORT THIS.
        return $this->tmp_buildOutput_N;

    }

    //
    // THIS METHOD SHOULD BUILD OUT STREAM FOR ALL CHANNEL/DEVICE TYPE. THIS WILL RETURN STRING OF HTML DATA FOR A STREAM
    private function living_stream_HTML_translation($oLIVING_STREAM, $oDB_RESP, $oUser){

        /* $channel[WEB,EMAIL,SMS],
         * $devicetype[m,d],
         * $streamtype[KIVOTOS,ASSET,USER,CLIENT,LANG],
         * $oDB_RESP[OBJ]
         * */
        $tmp_HTML = "";

        //
        // ARE WE UNDER ORDER DISPLAY LIMITS
        //error_log("stream (677) compare [".self::$current_stream_order."]-[".$oLIVING_STREAM->return_attribute('max_stream_depth')."]");
        if(self::$current_stream_order <= (int)$oLIVING_STREAM->return_attribute('max_stream_depth')){

            switch($oLIVING_STREAM->channel){
                case 'WEB':
                    $tmp_HTML = $this->stream_WEB_HTML_translation($oLIVING_STREAM, $oDB_RESP, $oUser);

                break;
                case 'EMAIL':

                    //
                    // WE WILL HAVE TO CODE THIS OUTPUT FOR EMAIL CLIENT COMPATIBILITY. I'M NOT SETUP TO TEST THIS OUTPUT YET...BUT WE WILL BE.
                    $tmp_HTML = $this->stream_EMAIL_HTML_translation($oLIVING_STREAM, $oDB_RESP, $oUser);

                break;
                case 'SMS':
                    //
                    // MORE RESEARCH NECESSARY. NOT SURE IF MY SYSTEM WILL SUPPORT THE DEGREE OF PERFECTION REQUIRED TO PULL THIS OFF
                break;
                default:

                break;

            }

        }

        return $tmp_HTML;

    }


    //
    // I NEED TO EXPOSE MY MULTI-LANGUAGE SUPPORT LAYER TO THIS OBJECT/METHOD. IF I PUSH LANG SUPPORT
    // THROUGH oDB_RESP, I WILL HAVE IT IMMEDIATELY.
    private function stream_WEB_HTML_translation($oLIVING_STREAM, $oDB_RESP, $oUser){

        switch($oLIVING_STREAM->devicetype){
            case 'm':

                //
                // MOBILE
                // PROOF OF CONCEPT. GETTING USERNAME SHOULD BE FUN. THAT SHOULD BE IN THE oDB_RESP OBJECT.
                #$tmp_HTML = '<div class="single_stream_wrapper"><div class="stream_content">' . $oLIVING_STREAM->return_attribute_data('STREAM_FORMATTED').'</div><div class="cb_5"></div><div class="stream_hr"></div></div>';

                #$tmp_feeder_cnt = sizeof($oLIVING_STREAM->feeder_stream_ARRAY);
                $tmp_feeder_cnt = (int)$oLIVING_STREAM->return_attribute_data('FEEDER_STREAM_COUNT');

                if($tmp_feeder_cnt<1){
                    $tmp_feeder_cnt = NULL;
                }else{
                    if(!$oUser->is_ssl()){
                        $tmp_curr_uri = urlencode(self::$oUserEnvironment->data_encrypt("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"));
                    }else{
                        $tmp_curr_uri = urlencode(self::$oUserEnvironment->data_encrypt("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"));

                    }

                    $tmp_feeder_cnt = '<a href="#" onclick="evifweb_followLink(\'' . self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'stream/?sid=' . $oLIVING_STREAM->return_attribute_data('STREAM_ID').'&ruri=' . $tmp_curr_uri.'\');">(' . $tmp_feeder_cnt.')</a>';
                }

                if($oLIVING_STREAM->return_attribute_data('ATTACHED_ASSET_ID')!=""){
                    $tmp_lnk = self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/kivotos/asset/preview/?tunnelEncrypt=".urlencode(self::$oUserEnvironment->data_encrypt('&kid=' . $oLIVING_STREAM->return_attribute_data('KIVOTOS_ID').'&aid=' . $oLIVING_STREAM->return_attribute_data('ATTACHED_ASSET_ID').'&cid=' . $oLIVING_STREAM->return_attribute_data('CLIENT_ID').'&uid=' . $oLIVING_STREAM->return_attribute_data('USER_ID')));

                    $tmp_attach_lnk = '<div class="stream_attach_lnk"><a href="' . $tmp_lnk.'" data-ajax="false">[attachment]</a></div>';
                }else{
                    $tmp_attach_lnk = NULL;

                }

                if($oLIVING_STREAM->is_selected){

                    $tmp_select_handle='id="target_stream_comm" ';
                }else{

                    $tmp_select_handle = NULL;
                }

                $tmp_response_serial = $oDB_RESP->return_serial_from_SQL('USERS');

                //
                // STRAIGHT FROM DATABASE INTO METHOD...NO TWEAKING
                $tmp_elem_ts = $oLIVING_STREAM->return_attribute_data('DATECREATED');
                $tmp_format_override = 'm.d.Y @ H:i:s';

                // WE WILL TRY DEFAULT. OTHERWISE, WE WILL PLUG IN 'K_STREAM' $oDB_RESP->return_serial(xxxxx)
                $tmp_HTML = '<div ' . $tmp_select_handle.'class="single_stream_wrapper">
                    <div class="stream_content">' . $oLIVING_STREAM->return_attribute_data('STREAM_FORMATTED').'</div>
                    ' . $tmp_attach_lnk.'
                    <div class="stream_owner">by <a href="'.self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'account/dashboard/?uid=' . $oLIVING_STREAM->return_attribute_data('USER_ID').'">' . $oDB_RESP->retrieve_data_by_id($tmp_response_serial, 'USERS', $oLIVING_STREAM->return_attribute_data('USER_ID'), 'FIRSTNAME_BLOB').' ' . $oDB_RESP->retrieve_data_by_id($tmp_response_serial, 'USERS', $oLIVING_STREAM->return_attribute_data('USER_ID'), 'LASTNAME_BLOB').'</a></div>
                    <div class="stream_stamp_reply_wrapper">
                        <div class="stream_timestamp">' .self::$oUserEnvironment->oFINITE_EXPRESS->incarnate('ELAPSED', $tmp_elem_ts, $tmp_format_override). '</div>
                        <div class="stream_reply">' . $tmp_feeder_cnt.' <a href="#'.self::$replyFormHTML_ID.'" data-rel="popup" data-position-to="window" onclick="evifweb_stream_reply_iframe_populate(\''.self::$oUserEnvironment->data_encrypt($oLIVING_STREAM->return_attribute_data('STREAM_ID')).'\',\'IFRAME_'.self::$replyFormHTML_ID.'\');">Reply</a></div>

                    </div>
                    <div class="cb_5"></div>
                </div>
                    <div class="stream_hr"></div>';

            break;
            default:

                //
                // DESKTOP
                $tmp_HTML = NULL;
            break;

        }

        return $tmp_HTML;

    }

    private function stream_EMAIL_HTML_translation($oLIVING_STREAM, $oDB_RESP){

        $tmp_HTML = NULL;

        return $tmp_HTML;
    }

    private function stream_order_HTML_opening($index){
        error_log("stream (806) calling stream_order_HTML_opening(".$index.")");
        self::$current_stream_order++;

        //
        // TRACK USE OF INDEX FOR JAVASCRIPT DOM HANDLE INJECTION
        if($this->stream_vert_flow_DOM_handles==""){
            $this->stream_vert_flow_DOM_handles = $index;

        }else{

            $this->stream_vert_flow_DOM_handles .= '|' . $index;
        }

        //error_log("stream (707) QUEUE HTML FOR NEW ORDER N STREAM ".$index);
        $tmp_HTML = '<div id="stream_' . $index.'_wrapper">
                    <div id="stream_vert_flow_' . $index.'" class="vert_flow_wrapper">
                        <div id="stream_vert_flow_' . $index.'_repeat" style="background-image: url(\''.self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP') . self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/stream_raw_repeat_block_2px_01.png\'); background-repeat: repeat-y; width:17px; overflow: hidden;"></div>
                        <div class="stream_vert_flow_cap" style="background-image: url(\''.self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP') . self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/stream_raw_cap_block_2px_01.png\'); background-repeat: none; width:17px; height: 68px; overflow: hidden;"></div>
                    </div>
                    <div id="stream_order_' . $index.'_wrapper" class="stream_order_wrapper">';

        return $tmp_HTML;
    }

    private function stream_order_HTML_closing(){
        error_log("stream (803) calling stream_order_HTML_closing() current_stream_order_depth[".self::$current_stream_order."]");
        self::$current_stream_order--;
        $tmp_HTML = '</div></div><div class="cb_20"></div><div class="stream_hr_dsh"></div><div class="cb_15"></div>';

        return $tmp_HTML;
    }

    private function processStreamArray_recursive($stream_array){

        $tmp_HTML = "";

        // LET'S SEE WHAT THIS DOES.
        // NOT SURE IF I WANT TO OOP THIS TEST STRUCTURE. I JUST NEED TO SEE WHAT IS IN MY OUTPUT ARRAY.
        #error_log("stream (831) array contents ->".$html_elem_ARRAY[$i]);
        foreach($stream_array as $key=>$val){

            if(is_array($val)){

                $tmp_HTML .= $this->processStreamArray_recursive($val);
                //error_log("stream (975) process Recursive...");

            }else{
                #error_log("stream (839) html_elem_ARRAY data[".$key."] [".$val."]");
                if(!isset($this->tmp_output_flag_ARRAY[$key])){
                    //error_log("stream (853) output key[".$key."] crc[".$this->hash($val)."] len[".strlen($val)."]");
                    $this->tmp_output_flag_ARRAY[$key] = 1;
                    $tmp_HTML .= $val;
                    //error_log("stream (983) process non-recursive...".$val);
                }
            }

        }

        return $tmp_HTML;
    }

    private function stream_order_reverse_HTML_output($html_elem_ARRAY){

        $tmp_HTML = "";
        $tmp_output_ARRAY = array();

        //
        // FLATTEN EVERYTHING INTO A ONE DIM ARRAY SO THAT IT CAN BE FLIPPED
        foreach($html_elem_ARRAY as $key=>$val){

            if(is_array($val)){

                $tmp_output_ARRAY[] = $this->processStreamArray_recursive($val);
                //error_log("stream (885) order=0 HTML output _recursive() [".$tmp_output."]");
                #$tmp_HTML .= $tmp_output;

            }else{
                //error_log("stream (889) order=0 HTML output [".$val."]");
                $tmp_output_ARRAY[] = $val;
                #$tmp_HTML .= $val;
            }

        }

        //
        // REVERSE ARRAY
        $tmp_output_ARRAY = array_reverse($tmp_output_ARRAY);

        //
        // NOW PULL HTML OUT OF REVERSED ARRAY
        $tmp_loop_size = sizeof($tmp_output_ARRAY);
        for($i=0;$i<$tmp_loop_size;$i++){

            $tmp_HTML .= $tmp_output_ARRAY[$i];

        }

        //
        // RETURN
        return $tmp_HTML;
    }

    private function OLD_stream_order_reverse_HTML_output($html_elem_ARRAY){

        //
        // FLIP ARRAY SEQUENCE
        $tmp_HTML = "";
        $html_elem_ARRAY = array_reverse($html_elem_ARRAY);
        $tmp_loop_size = sizeof($html_elem_ARRAY);

        $tmp_output_flag_ARRAY = array();


        //
        // CONVERT TO STRING.
        for($i=0;$i<$tmp_loop_size;$i++){

            //
            // FOR TESTING PURPOSES, LET'S CRAWL THROUGH THESE ARRAY RETURNS TO INVESTIGATE THE STRING CONTENTS. I'M TRYING TO FIGURE OUT WHERE THE
            // DUPLICATION OF HTML OUTPUT IS OCCURRING WITHIN MY "REFRACTED" OR RECURSIVE PROCESSING
            if(is_array($html_elem_ARRAY[$i])){

                // LET'S SEE WHAT THIS DOES.
                // NOT SURE IF I WANT TO OOP THIS TEST STRUCTURE. I JUST NEED TO SEE WHAT IS IN MY OUTPUT ARRAY.
                #error_log("stream (831) array contents ->".$html_elem_ARRAY[$i]);
                foreach($html_elem_ARRAY[$i] as $key=>$val){

                    if(is_array($val)){

                        foreach($val as $key1=>$val1){

                            if(is_array($val1)){
                                error_log("stream (859) go deeper..."); // I CAN'T KEEP MAKING THIS NESTED STRUCTURE "DEEPER". ARCHITECTURE SHOULD BE N+1.
                                // WE NEED TO REPLACE THIS WITH SOME KIND OF RECURSIVE PROCESSING...JUST LIKE HTML OUTPUT.
                                die();
                            }else{
                                #error_log("stream (839) html_elem_ARRAY data[".$key1."] [".$val1."]");
                                if(!isset($tmp_output_flag_ARRAY[$key1])){
                                    error_log("stream (863) output key[" . $key1 . "] crc[" . $this->hash($val1) . "] len[" . strlen($val1) . "] count->" . substr_count($val1, 'Reply here no file attach'));
                                    $tmp_output_flag_ARRAY[$key1] = 1;
                                    $tmp_HTML .= $val1;
                                }
                            }

                        }

                    }else{
                        #error_log("stream (839) html_elem_ARRAY data[".$key."] [".$val."]");
                        if(!isset($tmp_output_flag_ARRAY[$key])){
                            error_log("stream (936) output key[".$key."] crc[".$this->hash($val)."] len[".strlen($val)."] count->".substr_count($val, 'Reply here no file attach'));
                            $tmp_output_flag_ARRAY[$key] = 1;
                            $tmp_HTML .= $val;
                        }
                    }

                }


            }else{
                #error_log("stream (879) output key[x] crc[".$this->hash($val)."] len[".strlen($val)."] count->".substr_count($val, 'Reply here no file attach'));
                $tmp_HTML .= $html_elem_ARRAY[$i];
            }
        }

        //
        // RETURN
        return $tmp_HTML;
    }

    public function returnReplyIFRAME_HTML(){

        $tmp_HTML = '<div data-role="popup" id="'.self::$replyFormHTML_ID.'" data-overlay-theme="a" data-theme="a" data-corners="false" data-tolerance="15,15">
            <a href="#" data-rel="back" class="ui-btn ui-btn-b ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
            <iframe id="IFRAME_'.self::$replyFormHTML_ID.'" src="'.self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'/dashboard/kivotos/streams/reply_mobi.php?kid='.self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'kid').'" width="480" height="320" seamless=""></iframe>
        </div>';

        return $tmp_HTML;

    }

    //
    // THIS METHOD WILL BE CALLED BY STREAMS WITHIN OTHER STREAMS WITHIN OTHER STREAMS.
    // NOT SURE OF NAME FOR METHOD YET...WILL DEPEND ON WHAT HAPPENS INSIDE
    public function stream_output_processing($stream_oARRAY, $oDB_RESP){

        //
        // NOW FOR THE FUN PART.
        foreach($stream_oARRAY as $key=>$oLIVING_STREAM){

            //
            // WE NEED TO BEGIN SUPPORT FOR HTML STRUCTURE.
            // EACH LIVING_STREAM HAS ALL DATA ELEMENTS + REPLY RELATIONS
            // STREAM ORDER = 0 DISPLAYED FROM NEWEST TO OLDEST. LET'S SECURE THIS OUTPUT THROUGH CURRENT OOP SETUP

            //
            // GET STREAM ORDER = 0. FEEDER STREAMS SHOULD BE PROCESSED DEEP WITHIN THIS SITUATION. EVERYTHING HAPPENS HERE, I THINK.
            // THIS SCENARIO OVERLOOKS FACT THAT DEEP LINKING TO 3RD ORDER WILL NEVER PRODUCE ZERO ORDER STREAM...WHICH WE USE HERE TO BEGIN OUTPUT.
            if(!($oLIVING_STREAM->is_feeder_stream)){

                error_log("stream (1114) not a feeder stream->".$oLIVING_STREAM->stream_html_dom_key."|".$oLIVING_STREAM->stream_content);

                //
                // WE ARE ORDER = 0
                // I AM NOT SURE WHAT DATA TYPE tmp_buildOutput NEEDS TO BE FOR THIS (NOT SURE IF I WANT STRING HTML DATA HERE). WE WILL FEEL IT OUT.
                // tmp_buildOutput IS STRING TYPE. THIS PARTICULAR METHOD SHOULD RETURN ALL(N+1) STREAM HTML OUTPUT DATA RELATED TO AN ORDER 0 STREAM
                $this->buildOutputZERO($oLIVING_STREAM,$stream_oARRAY, $this, $oDB_RESP);
                #error_log("stream (854) output ".$oLIVING_STREAM->stream_html_dom_key." count->".substr_count($tmp_output1, 'Reply here no file attach'));
                #$this->tmp_buildOutput_ARRAY[] = $tmp_output1; // LIKE POINTING A MIRROR INTO A MIRROR...LET'S SEE IF WE CAN SLING THE stream_oARRAY AROUND BETWEEN STREAMS GOING DEEPER AND DEEPER TO FILL THIS OUT.
                #error_log("stream (794) ".$oLIVING_STREAM->stream_html_dom_key." tmp_buildOutput_ARRAY size ".sizeof($this->tmp_buildOutput_ARRAY));
            }else{

                error_log("stream (1126) stream_output_processing() we did nothing for ".$oLIVING_STREAM->stream_html_dom_key);
            }

//            <div id="stream_00_wrapper">
//                [VERT FLOW DIV - stream_vert_flow_00]
//                <div id="stream_order_00_wrapper" class="stream_order_wrapper">
//                    [LIVING_STREAM OBJECT OUTPUT - ORDER = 0]
//                    [LIVING_STREAM OBJECT OUTPUT - ORDER = 0]
//
//                    <!-- AN ORDER N (FEEDER) STREAM -->
//                    <div id="stream_n_wrapper">
//                        [VERT FLOW DIV - stream_vert_flow_n]
//                        <div id="stream_order_n_wrapper" class="stream_order_wrapper">
//                            [LIVING_STREAM OBJECT OUTPUT - ORDER = 1]
//
//
//
//                        </div><!-- // END stream_order_n_wrapper
//                    </div><!-- // END stream_n_wrapper
//
//
//                </div><!-- // END stream_order_00_wrapper
//            </div><!-- // END stream_00_wrapper

            //
            // LETS SEE THE ORDER OF STREAMS.
            // DO WE HAVE VALID FEEDER COUNT. IT APPEARS!! TO BE WORKING.
            #error_log("stream (404) stream_output_processing DOM KEY[".$oLIVING_STREAM->stream_html_dom_key."] | FEEDER COUNT->".$oLIVING_STREAM->return_feeder_count()."|STREAM_CONTENT->".$oLIVING_STREAM->return_attribute_data('STREAM_CONTENT'));

        }

        //
        // REVERSE ORDER = 0 STREAM HTML OUTPUT. WE WILL DO THAT LATER. LET'S GET BASIC OUTPUT WORKING AS EXPECTED
        $this->tmp_buildOutput = $this->stream_order_HTML_opening('00');
        $this->tmp_buildOutput .= $this->returnReplyIFRAME_HTML();
        $this->tmp_buildOutput .= $this->stream_order_reverse_HTML_output($this->tmp_buildOutput_ARRAY);
        $this->tmp_buildOutput .= $this->stream_order_HTML_closing();

        //error_log("stream (896) output stream_00_wrapper count->".substr_count($this->tmp_buildOutput, 'Reply here no file attach'));

    }

    public function stream_deep_output_processing($stream_oARRAY, $oDB_RESP){

        //
        // NOW FOR THE FUN PART.
        error_log("(Reversing stream oArray...)");
        $stream_oARRAY = array_reverse($stream_oARRAY);
        foreach($stream_oARRAY as $key=>$oLIVING_STREAM){

            //
            // GET STREAM ORDER = 0. FEEDER STREAMS SHOULD BE PROCESSED DEEP WITHIN THIS SITUATION. EVERYTHING HAPPENS HERE, I THINK.
            // THIS SCENARIO OVERLOOKS FACT THAT DEEP LINKING TO 3RD ORDER WILL NEVER PRODUCE ZERO ORDER STREAM...WHICH WE USE HERE TO BEGIN OUTPUT.
            //if(!($oLIVING_STREAM->is_feeder_stream)){

            //    error_log("stream (1114) not a feeder stream->".$oLIVING_STREAM->stream_html_dom_key."|".$oLIVING_STREAM->stream_content);

            //
            // WE ARE ORDER = 0
            // I AM NOT SURE WHAT DATA TYPE tmp_buildOutput NEEDS TO BE FOR THIS (NOT SURE IF I WANT STRING HTML DATA HERE). WE WILL FEEL IT OUT.
            // tmp_buildOutput IS STRING TYPE. THIS PARTICULAR METHOD SHOULD RETURN ALL(N+1) STREAM HTML OUTPUT DATA RELATED TO AN ORDER 0 STREAM
            #if(!$tmp_parent_has_run){
            #    $this->buildOutputZERO($oLIVING_STREAM,$stream_oARRAY, $this, $oDB_RESP);
            //$tmp_parent_has_run = true;
            #}
            #error_log("stream (854) output ".$oLIVING_STREAM->stream_html_dom_key." count->".substr_count($tmp_output1, 'Reply here no file attach'));
            #$this->tmp_buildOutput_ARRAY[] = $tmp_output1; // LIKE POINTING A MIRROR INTO A MIRROR...LET'S SEE IF WE CAN SLING THE stream_oARRAY AROUND BETWEEN STREAMS GOING DEEPER AND DEEPER TO FILL THIS OUT.
            #error_log("stream (794) ".$oLIVING_STREAM->stream_html_dom_key." tmp_buildOutput_ARRAY size ".sizeof($this->tmp_buildOutput_ARRAY));
            //}else{

            //    error_log("stream (1126) stream_output_processing() we did nothing for ".$oLIVING_STREAM->stream_html_dom_key);
            //}

            $tmp_feeder_count = sizeof($oLIVING_STREAM->feeder_stream_ARRAY);

            //
            // THIS IS FOR N+1 PROCESSING.
            // SO I PROCESS 0-n+1 FIRST. THEN FLIP THE OUTPUT ARRAY.
            if($tmp_feeder_count>0){

                $tmp_depth_key = $this->init_order_depth($oLIVING_STREAM->stream_html_dom_key);

                //
                // CYCLE THROUGH $stream_oARRAY LOOKING FOR FEEDERS...WE HAVE THIS ALREADY...ACTUALLY..
                // FOOD IS HERE SO....BEING SLOW....
                // WE ARE ORDER n HERE
                //error_log("stream (474) stream ".$oLIVING_STREAM->stream_html_dom_key." has ".$tmp_feeder_count." feeders.");
                #for($i = 0; $i < $tmp_feeder_count; $i++){
                #error_log("stream (456) oSTR::feeder_stream_ARRAY[".$i."] ->" . $oLIVING_STREAM->feeder_stream_ARRAY[$i]);

                //
                // THIS ORDER 0 STREAM HAS FEEDER STREAMS...THEY ALSO MAY HAVE FEEDER STREAMS....AND THOSE STREAMS COULD HAVE FEEDERS TOO...ETC..
                // STORE RAW HTML IN THIS ARRAY. THIS SHOULD RETURN ALL HTML FOR STREAM + N+1 HERE
                #$stream_manager->tmp_buildOutput_ARRAY[] = $this->replicate_N($oLIVING_STREAM, $stream_oARRAY, $stream_manager, $oDB_RESP);
                //error_log("stream (482) buildOutputZERO (n+1) for ".$oLIVING_STREAM->stream_html_dom_key);
                error_log("stream (1237) replicate_N being called by buildOutputZERO...");
                if(!isset($this->replicate_flag_ARRAY[$oLIVING_STREAM->stream_html_dom_key])){
                    $this->replicate_flag_ARRAY[$oLIVING_STREAM->stream_html_dom_key] = 1;
                    $this->tmp_buildOutput_ARRAY[] = $this->replicate_N($oLIVING_STREAM, $stream_oARRAY, $this, $oDB_RESP, $tmp_depth_key);
                }

            }else{

                //
                // PROCESS ORDER 0 WITH NO FEEDER STREAMS. LET'S TRY TO GET THIS WORKING AS PROOF OF CONCEPT FOR THIS ARCHITECTURE
                #$stream_manager->tmp_buildOutput_ARRAY[] = $this->replicate_0($oLIVING_STREAM,$stream_oARRAY, $stream_manager, $oDB_RESP);
                //error_log("stream (494) buildOutputZERO for ".$oLIVING_STREAM->stream_html_dom_key);
                error_log("stream (1250) replicate_0 being called by buildOutputZERO...");
                $this->tmp_buildOutput_ARRAY[] = $this->replicate_0($oLIVING_STREAM, $stream_oARRAY, $this, $oDB_RESP);

            }

        }

        //
        // REVERSE ORDER = 0 STREAM HTML OUTPUT. WE WILL DO THAT LATER. LET'S GET BASIC OUTPUT WORKING AS EXPECTED
        $this->tmp_buildOutput = $this->stream_order_HTML_opening('00');
        $this->tmp_buildOutput .= $this->returnReplyIFRAME_HTML();
        $this->tmp_buildOutput .= $this->stream_order_reverse_HTML_output($this->tmp_buildOutput_ARRAY);
        $this->tmp_buildOutput .= $this->stream_order_HTML_closing();

    }

    private function assemble_output($channel,$devicetype,$streamtype,$response_profile,$profile_field,$oDB_RESP){
        /* $channel[WEB,EMAIL,SMS],
                     * $devicetype[m,d],
                     * $streamtype[KIVOTOS,ASSET,USER,CLIENT,LANG],
                     * $oDB_RESP[OBJ]
                     *

                //
                // CHECK FOR CONDITIONS INDICATING N=0 ORDER STREAM DATA
                // I FORGOT...ALL MY STREAM DATA INCLUDING RELATIONSHIPS ARE HERE IN THIS OBJECT. THE QUERY IS A JOIN OF 2 TABLES.
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
                        `comm_stream_flow`.`FEEDER_STREAM_ID`';*/



        if($streamtype=='DEEP'){
            //
            // NEED TO PERFORM OUTPUT PROCESSING USING CUMULATIVE DATA ARCHITECTURE
            $tmp_living_stream_oARRAY = array();
            $tmp_loop_size = $oDB_RESP->return_sizeof_aggregate('DEEP_STREAM_DATA');

            if(!$tmp_loop_size){
                //
                // IF FALSE....PROCESS STREAM FROM RESPONSE OBJECT NON-AGGREGATION PATHWAY
                error_log("stream (1182) deep but not aggregate...");

                #$tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial('STREAM_DATA'), 'COMM_STREAM');
                $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial('STREAM_PARENT_DATA'), 'COMM_PARENT_STREAM');

                for($ii = 0; $ii < $tmp_loop_size; $ii++){

                    //
                    // OK...SHOULD MAYBE BE SOMETHING LIKE THIS
                    // UPON CONSTRUCTION, EACH STREAM DATABASE DATA RESULT SHOULD BE TRANSLATED INTO A LIVING_STREAM OBJECT TO REPRESENT THAT ELEMENT
                    // LET'S BUILD THE CONSTRUCTOR
                    $tmp_stream = new living_stream($channel, $devicetype, $oDB_RESP->return_serial('STREAM_DATA'), 'COMM_STREAM', $oDB_RESP, $ii);

                    error_log("stream (1311) id = ".$tmp_stream->stream_html_dom_key);

                    //
                    // WE NEED TO CALL OUT VISUALLY THE TARGET STREAM
                    #error_log("stream (1216) marking selected stream[".self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'sid')."]");
                    $tmp_stream->mark_selected(self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'sid'));

                    //
                    // WE CAN LOOP THROUGH THIS ARRAY NOW WHEN WE NEED TO PUT OUR HANDS ON STREAMS.
                    // SHOULD WE USE STREAM_ID AS KEY HERE?
                    $tmp_living_stream_oARRAY[$tmp_stream->return_attribute_data('STREAM_ID')] = $tmp_stream;

                    //
                    // STREAM A -> I_FEED_STREAM_ID STREAM B
                    // UPDATE STREAM B WITH REF TO STREAM A. WE ARE PROCESSING NEWEST TO OLDEST. SO WE WILL NEVER HAVE THE
                    // PARENT STREAM WHEN PROCESSING CHILD. CONSIDER REVERSING ORDER SO THAT YOU CAN REFERENCE THE PARENT STREAM OBJECT
                    // BY ID...OTHERWISE, YOU WILL HAVE TO TRAVERSE THE OBJECTS MORE TO SORT THIS OUT. DONE.
                    // EITHER MAKE tmp_living_stream_oARRAY PRIVATE, OR PASS THROUGH THIS METHOD
                    $tmp_i_feed_id = $tmp_stream->return_attribute_data( 'I_FEED_STREAM_ID');

                    //
                    // SO I THINK THAT FIRST REPLY FORM SUBMISSION TEST MAY HAVE ENTERED NULL PARAM FOR SOMETHING IN MY DATABASE...BREAKING THIS FUNCTIONALITY WITH NULL. LET'S LOOK..
                    if(isset($tmp_i_feed_id) && $tmp_i_feed_id != ""){
                        #error_log("stream (953) tmp_i_feed_id[".$tmp_i_feed_id."]");
                        $tmp_stream_id = $tmp_stream->return_attribute_data('STREAM_ID');
                        $tmp_living_stream_oARRAY = $this->injest_stream_relation($tmp_stream_id, $tmp_i_feed_id, $tmp_living_stream_oARRAY);
                    }

                }

                //
                // WE HAVE ALL STREAM DATA IN $tmp_living_stream_ARRAY INCLUDING RELATIONS.
                // NOW TO PROCESS THE ARRAY FOR HTML OUTPUT.
                $this->stream_output_processing($tmp_living_stream_oARRAY, $oDB_RESP);


            }else{

                //error_log("stream (1256) tmp_loop_size=".$tmp_loop_size);

                for($ii = 0; $ii < $tmp_loop_size; $ii++){

                    //
                    // OK...SHOULD MAYBE BE SOMETHING LIKE THIS
                    // UPON CONSTRUCTION, EACH STREAM DATABASE DATA RESULT SHOULD BE TRANSLATED INTO A LIVING_STREAM OBJECT TO REPRESENT THAT ELEMENT
                    // LET'S BUILD THE CONSTRUCTOR
                    $tmp_stream = new living_stream($channel, $devicetype, $oDB_RESP->return_aggregate_serial('DEEP_STREAM_DATA', $ii), 'DEEP_STREAM_DATA', $oDB_RESP, $ii, true);

                    $tmp_stream->mark_selected(self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'sid'));

                    //
                    // WE CAN LOOP THROUGH THIS ARRAY NOW WHEN WE NEED TO PUT OUR HANDS ON STREAMS.
                    // SHOULD WE USE STREAM_ID AS KEY HERE?
                    $tmp_living_stream_oARRAY[$tmp_stream->return_attribute_data('STREAM_ID')] = $tmp_stream;

                    //
                    // STREAM A -> I_FEED_STREAM_ID STREAM B
                    // UPDATE STREAM B WITH REF TO STREAM A. WE ARE PROCESSING NEWEST TO OLDEST. SO WE WILL NEVER HAVE THE
                    // PARENT STREAM WHEN PROCESSING CHILD. CONSIDER REVERSING ORDER SO THAT YOU CAN REFERENCE THE PARENT STREAM OBJECT
                    // BY ID...OTHERWISE, YOU WILL HAVE TO TRAVERSE THE OBJECTS MORE TO SORT THIS OUT. DONE.
                    // EITHER MAKE tmp_living_stream_oARRAY PRIVATE, OR PASS THROUGH THIS METHOD
                    $tmp_i_feed_id = $tmp_stream->return_attribute_data( 'I_FEED_STREAM_ID');

                    //
                    // SO I THINK THAT FIRST REPLY FORM SUBMISSION TEST MAY HAVE ENTERED NULL PARAM FOR SOMETHING IN MY DATABASE...BREAKING THIS FUNCTIONALITY WITH NULL. LET'S LOOK..
                    if(isset($tmp_i_feed_id) && $tmp_i_feed_id != ""){
                        #error_log("stream (953) tmp_i_feed_id[".$tmp_i_feed_id."]");
                        $tmp_stream_id = $tmp_stream->return_attribute_data('STREAM_ID');
                        $tmp_living_stream_oARRAY = $this->injest_stream_relation($tmp_stream_id, $tmp_i_feed_id, $tmp_living_stream_oARRAY);
                    }

                }

                //
                // WE HAVE ALL STREAM DATA IN $tmp_living_stream_ARRAY INCLUDING RELATIONS.
                // NOW TO PROCESS THE ARRAY FOR HTML OUTPUT.
                $this->stream_deep_output_processing($tmp_living_stream_oARRAY, $oDB_RESP);

            }

            return $this->tmp_buildOutput;

        }else{

            //
            // THE WAY I AM DOING THIS IS THE HARD WAY I THINK. I NEED TO HAVE AN OOP REPRESENTATION OF THIS DATA FOR USE.
            // THIS WILL BE CHALLENGING BUT SOO REWARDING ONCE COMPLETED.
            $serial = $oDB_RESP->return_serial('STREAM_DATA');
            $i_have_replies = false;
            $tmp_living_stream_oARRAY = array();

            //
            // GET COUNT OF NUMBER OF n=0 STREAM DATA. WE DON'T NEED TO CALCULATE COUNT FOR HIGHER ORDER...USE comm_stream.FEEDER_STREAM_COUNT
            // OK. SO I GUESS WE START FROM THE TOP HERE AND BEGIN IMPLEMENTING EACH COMPONENT. THERE MAY BE MULTIPLE ITERATIONS OF DEVELOPMENT
            // TO GET THIS IN THE RIGHT SPOT.

            //
            // YES, IT IS DROPPING HERE. PULLING STREAM COUNT FROM THE DB_RESP OBJECT.
            #$tmp_stream_count = $this->return_stream_count($serial, $oDB_RESP);

            $tmp_dbresp_profile_ARRAY = $oDB_RESP->return_profiles($serial);
            $tmp_loop_size = sizeof($tmp_dbresp_profile_ARRAY);

            //
            // IT IS POSSIBLE...MULTIPLE STREAM TYPES (MULT QUERY PROFILES) RETURNED. LOOP THROUGH ALL.
            for($i = 0; $i < $tmp_loop_size; $i++){

                //
                // I THINK WITHIN THIS LOOP, WE NEED TO DO OUR OOP DATA STRUCTURE BUILD OUT TO SUPPORT HTML OUTPUT. YES!

                //
                // GET DB RESPONSE COUNT
                //error_log("stream (208) assemble_output() serial[".$serial."] profile[".$tmp_dbresp_profile_ARRAY[$i]."]");
                $tmp_stream_loop_size = $oDB_RESP->return_sizeof($serial, $tmp_dbresp_profile_ARRAY[$i]);

                //
                // IT IS POSSIBLE THAT WITHIN THIS LOOP, I WILL BUILD MY STREAM OBJECTS. CAN IT HAPPEN BEFORE (NOT REALLY)?
                // LOOP THROUGH RAW STREAM DATA - ALL DATABASE OUTPUT.
                for($ii = 0; $ii < $tmp_stream_loop_size; $ii++){

                    //
                    // OK...SHOULD MAYBE BE SOMETHING LIKE THIS
                    // UPON CONSTRUCTION, EACH STREAM DATABASE DATA RESULT SHOULD BE TRANSLATED INTO A LIVING_STREAM OBJECT TO REPRESENT THAT ELEMENT
                    // LET'S BUILD THE CONSTRUCTOR
                    $tmp_stream = new living_stream($channel, $devicetype, $serial, $tmp_dbresp_profile_ARRAY[$i], $oDB_RESP, $ii);

                    error_log("stream (1437) id = ".$tmp_stream->stream_html_dom_key);

                    //
                    // WE CAN LOOP THROUGH THIS ARRAY NOW WHEN WE NEED TO PUT OUR HANDS ON STREAMS.
                    // SHOULD WE USE STREAM_ID AS KEY HERE?
                    $tmp_living_stream_oARRAY[$tmp_stream->return_attribute_data('STREAM_ID')] = $tmp_stream;

                    //
                    // STREAM A -> I_FEED_STREAM_ID STREAM B
                    // UPDATE STREAM B WITH REF TO STREAM A. WE ARE PROCESSING NEWEST TO OLDEST. SO WE WILL NEVER HAVE THE
                    // PARENT STREAM WHEN PROCESSING CHILD. CONSIDER REVERSING ORDER SO THAT YOU CAN REFERENCE THE PARENT STREAM OBJECT
                    // BY ID...OTHERWISE, YOU WILL HAVE TO TRAVERSE THE OBJECTS MORE TO SORT THIS OUT. DONE.
                    // EITHER MAKE tmp_living_stream_oARRAY PRIVATE, OR PASS THROUGH THIS METHOD
                    $tmp_i_feed_id = $tmp_stream->return_attribute_data( 'I_FEED_STREAM_ID');

                    //
                    // SO I THINK THAT FIRST REPLY FORM SUBMISSION TEST MAY HAVE ENTERED NULL PARAM FOR SOMETHING IN MY DATABASE...BREAKING THIS FUNCTIONALITY WITH NULL. LET'S LOOK..
                    if(isset($tmp_i_feed_id) && $tmp_i_feed_id != ""){
                        #error_log("stream (953) tmp_i_feed_id[".$tmp_i_feed_id."]");
                        $tmp_stream_id = $tmp_stream->return_attribute_data('STREAM_ID');
                        $tmp_living_stream_oARRAY = $this->injest_stream_relation($tmp_stream_id, $tmp_i_feed_id, $tmp_living_stream_oARRAY);
                    }

                }

            }

            //
            // WE HAVE ALL STREAM DATA IN $tmp_living_stream_ARRAY INCLUDING RELATIONS.
            // NOW TO PROCESS THE ARRAY FOR HTML OUTPUT.
            $this->stream_output_processing($tmp_living_stream_oARRAY, $oDB_RESP);

            return $this->tmp_buildOutput;

            // I DON'T NEED TO RUN THE REST OF THIS CODE. BELOW IS A GUIDE..BUT WE ARE GOING IN ANOTHER DIRECTION. WORKING ON TESTING OUTPUT. WILL HAPPEN ABOVE PERHAPS?
            // ANYWAYS...map_stream_relationships WILL BE INTERESTING...I MEAN FUN....

            //
            // WE NEED TO DO THIS DIFFERENTLY.
            # $this->init_stream_output([ORDER],[MAX_STREAM_DISPLAY_CNT],[oDB_RESP]);
        }
    }

    private function showStreamModified($i,$profile,$serial,$oDB_RESP){
        if($oDB_RESP->return_data_element($serial, $profile, 'DATEMODIFIED', $i) > $oDB_RESP->return_data_element($serial, $profile, 'DATECREATED', $i)){

            return '<div class="cb"></div><div class="stream_modified">
                            Modified '.date("m.d.Y @ H:i:s", strtotime($oDB_RESP->return_data_element($serial, $profile, 'DATEMODIFIED', $i))).'
                            </div>';

        }else{

            return NULL;

        }

    }

    //
    // I WILL NEED MORE INFO TO BUILD THE LINK. WE CAN HANDLE THAT L8TR. THIS IS A TEST. WILL BE USING DIFFERENT TECHNOLOGY FOR THIS FUNCTIONALITY.
    private function showStreamEditLnk($stream_userid, $oDB_RESP){
        if($stream_userid==self::$oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')){

            return '<div class="cb"></div>

                            <a href="#popupMenu" data-rel="popup" data-transition="slideup" class="stream_edit_lnk">edit</a>
                            <div data-role="popup" id="popupMenu" data-theme="a" class="ui-content">
                                <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
                                <form action="#" method="post" name="edit_stream" id="edit_stream"  enctype="multipart/form-data">
                                    <label for="stream">Reply to stream</label>
                                    <textarea cols="40" rows="3" name="stream" id="stream"></textarea>
                                    <p style="padding-top: 0; margin-top: 0;"><a href="#" id="open-popup_mention" class="clickable-area" style="text-decoration:none; text-underline:none;">@mention</a></p>

                                    <div data-role="popup" id="popup_mention" data-arrow="true">
                                        <p><strong>Insert user mention</strong></p>
                                        <input data-type="search" id="divOfMentions-input">
                                        <!-- form_component_insert_append([popupID],[id],[type],[value to append]) -->
                                        <!-- WE COULD PUT A JQUERY MOBILE FILTER COMPONENT HERE IF THE # OF NAMES GETS TOO BIG FOR USABILITY. WE SHOULD TEST TO
                                        SEE WHERE IT STARTS TO SUCK...HOW MANY USER REFERENCES -->

                                        <!-- STREAM MANAGER CLASS SHOULD ALSO HANDLE THE @MENTIONS -->
                                        <div class="stream_mentions" data-filter="true" data-input="#divOfMentions-input">
                                            <p><a href="#" onclick="evifweb_form_component_content_append(\'popup_mention\',\'textarea\',\'stream\',\'@JonathanHarris\');">Jonathan Harris</a>, e<span class="the_V">V</span>ifweb</p>
                                            <p><a href="#" onclick="evifweb_form_component_content_append(\'popup_mention\',\'textarea\',\'stream\,\'@JonHarris\');">Jon Harris</a>, client name 15 char...</p>
                                            <p><a href="#" onclick="evifweb_form_component_content_append(\'popup_mention\',\'textarea\',\'stream\',\'@User00Name00\');">User00 Name00</a>, client name 15 char...</p>
                                        </div>
                                    </div>

                                    <div class="cb_5"></div>
                                    <button class="ui-shadow ui-btn ui-corner-all" type="submit" id="submit">SUBMIT REPLY</button>
                                    <input type="hidden" name="st" value="'.self::$oUserEnvironment->data_encrypt('KIVOTOS').'">
                                    <input type="hidden" name="cid" value="'.self::$oUserEnvironment->data_encrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial('K_STREAM'), 'KIVOTOS', 'CLIENT_ID')).'">
                                    <input type="hidden" name="kid" value="'.self::$oUserEnvironment->data_encrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'kid')).'">
                                    <input type="hidden" name="postid" value="edit_stream">
                                </form>
                            </div>

                            ';

        }else{

            return NULL;
        }


    }

    private function return_stream_count($serial, $oDB_RESP){

        //
        // GET COUNT OF NUMBER OF STREAM ELEMENTS THAT NEED TO BE EVALUATED FOR N=0 COUNT
        $tmp_stream_count = 0;
        $tmp_dbresp_profile_ARRAY = $oDB_RESP->return_profiles($serial);
        $tmp_loop_size = sizeof($tmp_dbresp_profile_ARRAY);
        for($i=0;$i<$tmp_loop_size;$i++){

            //
            // GET DB RESPONSE COUNT
            //error_log("stream (370) return_stream_count() serial[".$serial."] profile[".$tmp_dbresp_profile_ARRAY[$i]."]");
            //
            // LET'S JUST PASS IN ARRAY. IT SHOULD WORK. SO WE ARE PASSING IN 'COMM_STREAM_X'...NOT CHECKSUMMED...JUST LIKE THE REST OF THE SITE.
            $tmp_profile = $tmp_dbresp_profile_ARRAY[$i];
            $tmp_stream_count += $oDB_RESP->return_sizeof($serial, $tmp_profile);

        }

        return $tmp_stream_count;
    }

    private function mention_parseSanitize($str){

        $patterns = array();
        $patterns[0] = ",";
        $patterns[1] = '"';
        $patterns[2] = '=';
        $patterns[3] = '{';
        $patterns[4] = '}';
        $patterns[5] = '(';
        $patterns[6] = ')';
        $patterns[7] = '.';
        $patterns[8] = '[';
        $patterns[9] = ']';
        $patterns[10] = '\n';
        $patterns[11] = '\r';
        $patterns[12] = '\'';
        $patterns[13] = '/';
        $patterns[14] = '#';
        $patterns[15] = ';';
        $patterns[16] = ':';
        $patterns[17] = '>';
        $patterns[18] = '<';
        $patterns[19] = '$';
        $patterns[20] = '*';
        $patterns[21] = '+';
        $patterns[22] = '-';
        $patterns[23] = '~';
        $patterns[24] = '\`';

        $replacements = array();
        $replacements[0] = ' ';
        $replacements[1] = ' ';
        $replacements[2] = ' ';
        $replacements[3] = ' ';
        $replacements[4] = ' ';
        $replacements[5] = ' ';
        $replacements[6] = ' ';
        $replacements[7] = ' ';
        $replacements[8] = ' ';
        $replacements[9] = ' ';
        $replacements[10] = ' ';
        $replacements[11] = ' ';
        $replacements[12] = ' ';
        $replacements[13] = ' ';
        $replacements[14] = ' ';
        $replacements[15] = ' ';
        $replacements[16] = ' ';
        $replacements[17] = ' ';
        $replacements[18] = ' ';
        $replacements[19] = ' ';
        $replacements[20] = ' ';
        $replacements[21] = ' ';
        $replacements[22] = ' ';
        $replacements[23] = ' ';
        $replacements[24] = ' ';

        $str = str_replace($patterns, $replacements, $str);
        return $str;
    }


    public function __destruct(){

    }

}