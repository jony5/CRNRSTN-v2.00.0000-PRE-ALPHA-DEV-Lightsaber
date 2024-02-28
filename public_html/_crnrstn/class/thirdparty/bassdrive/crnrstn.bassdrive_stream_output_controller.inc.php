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
#  CLASS :: crnrstn_bassdrive_stream_output_controller
#  VERSION :: 1.00.0000
#  DATE :: November 11, 2021 @ 1653 hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI ::
#  DESCRIPTION :: You're still the best, J5! - From J5
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_bassdrive_stream_output_controller {

    public $oCRNRSTN_USR;

    protected $stream_key;

    protected $flagged_as_live_ARRAY = array();
    protected $flagged_as_replay_ARRAY = array();

    protected $flagged_built_social_ARRAY = array();
    protected $flagged_built_colors_ARRAY = array();
    protected $flagged_built_stats_ARRAY = array();
    protected $flagged_built_title_ARRAY = array();

    private static $is_live_pattern = 'LIVE';
    private static $is_replay_pattern = 'REPLAY';

    private static $bassdrive_month_ARRAY = array();
    private static $bassdrive_day_ARRAY = array();

    public function __construct($oCRNRSTN_USR){

        $this->oCRNRSTN_USR = $oCRNRSTN_USR;

    }

    private function return_MONTH_ARRAY(){

        if(count(self::$bassdrive_month_ARRAY) > 5){

            return self::$bassdrive_month_ARRAY;

        }else{

            self::$bassdrive_month_ARRAY[] = 'Jan';
            self::$bassdrive_month_ARRAY[] = 'Feb';
            self::$bassdrive_month_ARRAY[] = 'Mar';
            self::$bassdrive_month_ARRAY[] = 'Apr';
            self::$bassdrive_month_ARRAY[] = 'May';
            self::$bassdrive_month_ARRAY[] = 'Jun';
            self::$bassdrive_month_ARRAY[] = 'Jul';
            self::$bassdrive_month_ARRAY[] = 'Aug';
            self::$bassdrive_month_ARRAY[] = 'Sept';
            self::$bassdrive_month_ARRAY[] = 'Oct';
            self::$bassdrive_month_ARRAY[] = 'Nov';
            self::$bassdrive_month_ARRAY[] = 'Dec';

        }

        return self::$bassdrive_month_ARRAY;

    }

    private function return_DAY_ARRAY(){

        if(count(self::$bassdrive_day_ARRAY) > 5){

            return self::$bassdrive_day_ARRAY;

        }else{

            for($i = 31; $i > 0; $i--){

                self::$bassdrive_day_ARRAY[] = $i;

            }

        }

        return self::$bassdrive_day_ARRAY;

    }

    public function stream_title_has_date_pattern($title){

        $bassdrive_month = $this->return_MONTH_ARRAY();
        $bassdrive_day = $this->return_DAY_ARRAY();

        $tmp_MONTH_cnt = count($bassdrive_month);
        $tmp_DAY_cnt = count($bassdrive_day);

        for($i=0; $i<$tmp_MONTH_cnt; $i++){

            for($ii=0; $ii<$tmp_DAY_cnt; $ii++){

                $tmp_date_pos = strpos($title, $bassdrive_month[$i].' '.$bassdrive_day[$ii]);
                if($tmp_date_pos !== false){

                    return true;

                }

            }

        }

    }

    public function throw_flag_as_replay($STREAM_KEY = null){

        if(!isset($STREAM_KEY)){

            $this->flagged_as_replay_ARRAY[self::$is_replay_pattern.$this->stream_key] = 1;

        }else{

            $this->flagged_as_replay_ARRAY[self::$is_replay_pattern.$STREAM_KEY] = 1;

        }

    }

    public function throw_flag_as_live($STREAM_KEY = null){

        if(!isset($STREAM_KEY)){

            $this->flagged_as_live_ARRAY[self::$is_live_pattern.$this->stream_key] = 1;

        }else{

            $this->flagged_as_live_ARRAY[self::$is_live_pattern.$STREAM_KEY] = 1;

        }

    }

    public function flagged_as_replay($STREAM_KEY = null){

        if(!isset($STREAM_KEY)){

            if(isset($this->flagged_as_replay_ARRAY[self::$is_replay_pattern.$this->stream_key])){

                return true;

            }else{

                return false;

            }

        }else{

            if(isset($this->flagged_as_replay_ARRAY[self::$is_replay_pattern.$STREAM_KEY])){

                return true;

            }else{

                return false;

            }

        }

    }

    public function flagged_as_live($STREAM_KEY = null){

        if(!isset($STREAM_KEY)){

            if(isset($this->flagged_as_live_ARRAY[self::$is_live_pattern.$this->stream_key])){

                return true;

            }else{

                return false;

            }

        }else{

            if(isset($this->flagged_as_live_ARRAY[self::$is_live_pattern.$STREAM_KEY])){

                return true;

            }else{

                return false;


            }
        }

    }

    public function authorize_stream_output($STREAM_KEY, $title){

        $this->stream_key = $STREAM_KEY;

        if($this->flagged_as_live() && $this->flagged_as_replay()){

            error_log(__LINE__ . ' '. __METHOD__ .' user AUTH PATH TRACE');
            return false;

        }else{

            $has_date = 0;
            if($this->stream_title_has_date_pattern($title)){

                $has_date = 1;

            }

            if($this->flagged_as_live()){

                //
                // DO WE HAVE DATE (REPLAY) INDICATOR
                if($has_date == 0){
                    error_log(__LINE__ . ' '. __METHOD__ .' user AUTH PATH TRACE');

                    return false;

                }

            }

            if($this->flagged_as_replay()){

                if($has_date == 1){
                    error_log(__LINE__ . ' '. __METHOD__ .' user AUTH PATH TRACE');

                    return false;

                }

            }

        }

        return true;

    }

    public function generate_stream_meta_colors($oQueryProfileMgr){

        //
        // WHAT WE NEED FOR HISTORY BUILD
        // COLORS META ::
        //    public function                     retrieve_data_by_id($oQueryProfileMgr, $result_set_key, $lookup_fieldname, $piped_primary_id_fields = NULL, $piped_lookup_id_data = NULL){

        $this->oCRNRSTN_USR->init_lookup_by_id($oQueryProfileMgr, 'BASSDRIVE_STREAM');
        $tmp_record_lookup_serial_ARRAY = $this->oCRNRSTN_USR->add_lookup_field_data($oQueryProfileMgr,'BASSDRIVE_STREAM', 'STREAM_KEY', $this->stream_key);
        //error_log('218 search - lookup serial array size='.sizeof($tmp_record_lookup_serial_ARRAY));
        //$tmp_record_lookup_serial_ARRAY = self::$oCRNRSTN_USR->add_lookup_field_data($oQueryProfileMgr, 'PAGE_DATA', 'PAGE_SERIAL', $tmp_page_serial);
        //error_log('220 search - lookup serial array size='.sizeof($tmp_record_lookup_serial_ARRAY));

        //$tmp_page_path = $oCRNRSTN_USR->retrieve_data_by_id($oQueryProfileMgr, 'PAGE_DATA','CONTENT_PATH','CONTENT_ID', $tmp_content_id);
        //$tmp_page_path = $oCRNRSTN_USR->retrieve_data_by_id($oQueryProfileMgr, 'PAGE_DATA','CONTENT_PATH','CONTENT_ID|PAGE_SERIAL', $tmp_content_id.'|'.$tmp_page_serial);
        //$tmp_page_path = self::$oCRNRSTN_USR->retrieve_data_by_id($oQueryProfileMgr, 'PAGE_DATA', 'CONTENT_PATH');


        $colors_name_key = $this->oCRNRSTN_USR->retrieve_data_by_id($oQueryProfileMgr,'BASSDRIVE_STREAM', 'STREAM_KEY', 'COLORS_NAME_KEY');
        error_log(__LINE__ . ' '. __METHOD__ .' user AUTH PATH TRACE');


        echo '<br><br><br>' . $this->stream_key. '<---->' . $colors_name_key;
        die();

        $this->flagged_built_colors_ARRAY[$this->stream_key] = '<div class="colors_img_wrapper"><img src="' . $this->oCRNRSTN->crnrstn_http_endpoint() . 'common/imgs/bassdrive_component_creative/' . $national_colors_img_file . '" width="64" height="32" alt="LONDON, UK" title="National flag for LONDON, UK"></div>
        <div class="cb"></div>
        <div class="colors_city_state">LONDON, UK</div>';

    }

    public function generate_stream_meta_social($oQueryProfileMgr){

        // SOCIAL META (LOCALIZED JSON) ::

        /*

        <div>
            <div class="colors_show_title_wrapper">The just on  track show with Ashatack<br><span class="player-host"><span style="color:#F00; font-weight: bold;">Live</span></span>
                <div class="cb"></div>
                <div id="bassdrive_social_wrapper" class="bassdrive_social_wrapper">
                    <div class="bassdrive_social_link stream_soundcloud" onclick="launch_newwindow('https://soundcloud.com/ashatack'); return false;" style="background-image:url(http://jony5.com/common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=42020173.1635649010.0)"></div><div class="hidden">Click <a href="https://soundcloud.com/ashatack" target="_blank">here</a> for the The just on  track show with Ashatack<br><span class="player-host">Live</span> SoundCloud playlist.</div>


                    <div class="bassdrive_social_link stream_twitter" onclick="launch_newwindow('https://twitter.com/Ashatack68'); return false;" style="background-image:url(http://jony5.com/common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=42020173.1635649010.0)"></div><div class="hidden">Click <a href="https://twitter.com/Ashatack68" target="_blank">here</a> for the The just on  track show with Ashatack<br><span class="player-host">Live</span> Twitter feed.</div>

                    <div class="bassdrive_social_link stream_www" onclick="launch_newwindow('https://www.twitch.tv/ashatack68'); return false;" style="background-image:url(http://jony5.com/common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=42020173.1635649010.0)"></div><div class="hidden">Click <a href="https://www.twitch.tv/ashatack68" target="_blank">here</a> for the website of The just on  track show with Ashatack<br><span class="player-host">Live</span>.</div>
                    <div class="bassdrive_social_link stream_paypal" onclick="launch_newwindow('https://www.paypal.com/donate?hosted_button_id=GWNVTUTPEAA8C'); return false;" style="background-image:url(http://jony5.com/common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=42020173.1635649010.0)"></div><div class="hidden">Click <a href="https://www.paypal.com/donate?hosted_button_id=GWNVTUTPEAA8C" target="_blank">here</a> to make a donation to Bassdrive.</div>
                    <div class="bassdrive_social_link stream_json" onclick="launch_newwindow('http://jony5.com/_proxy/bassdrive_colors/?stream=y0NXmHUd7pz5pqgZahU2KAvFXWCXxPOsUKlD6rI5t3dP0WiuJzakPQXZBn2OkuTf'); return false;" style="background-image:url(http://jony5.com/common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=42020173.1635649010.0)"></div>
                    <div class="cb"></div>
                </div>
            </div>
            <div class="colors_wrapper">
                <div class="colors_img_wrapper"><img src="http://jony5.com/common/imgs/bassdrive_component_creative/flag_united_kingdom.gif" width="64" height="32" alt="LONDON, UK" title="National flag for LONDON, UK"></div>
                <div class="cb"></div>
                <div class="colors_city_state">LONDON, UK</div>
                <div class="cb"></div>
                <div class="colors_show_date_generated"><span style="font-weight: bold;">Generated on:&nbsp;&nbsp;</span>Thursday, Nov. 11 at 17:42:05 EST</div>
            </div>
        </div>
        <div class="colors_hr_wrapper"><div class="colors_hr"></div></div>
         * */
    }

    public function generate_stream_meta_title($oQueryProfileMgr){

        // TITLE FORMATTING

        /*

        <div>
            <div class="colors_show_title_wrapper">The just on  track show with Ashatack<br><span class="player-host"><span style="color:#F00; font-weight: bold;">Live</span></span>
                <div class="cb"></div>
                <div id="bassdrive_social_wrapper" class="bassdrive_social_wrapper">
                    <div class="bassdrive_social_link stream_soundcloud" onclick="launch_newwindow('https://soundcloud.com/ashatack'); return false;" style="background-image:url(http://jony5.com/common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=42020173.1635649010.0)"></div><div class="hidden">Click <a href="https://soundcloud.com/ashatack" target="_blank">here</a> for the The just on  track show with Ashatack<br><span class="player-host">Live</span> SoundCloud playlist.</div>


                    <div class="bassdrive_social_link stream_twitter" onclick="launch_newwindow('https://twitter.com/Ashatack68'); return false;" style="background-image:url(http://jony5.com/common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=42020173.1635649010.0)"></div><div class="hidden">Click <a href="https://twitter.com/Ashatack68" target="_blank">here</a> for the The just on  track show with Ashatack<br><span class="player-host">Live</span> Twitter feed.</div>

                    <div class="bassdrive_social_link stream_www" onclick="launch_newwindow('https://www.twitch.tv/ashatack68'); return false;" style="background-image:url(http://jony5.com/common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=42020173.1635649010.0)"></div><div class="hidden">Click <a href="https://www.twitch.tv/ashatack68" target="_blank">here</a> for the website of The just on  track show with Ashatack<br><span class="player-host">Live</span>.</div>
                    <div class="bassdrive_social_link stream_paypal" onclick="launch_newwindow('https://www.paypal.com/donate?hosted_button_id=GWNVTUTPEAA8C'); return false;" style="background-image:url(http://jony5.com/common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=42020173.1635649010.0)"></div><div class="hidden">Click <a href="https://www.paypal.com/donate?hosted_button_id=GWNVTUTPEAA8C" target="_blank">here</a> to make a donation to Bassdrive.</div>
                    <div class="bassdrive_social_link stream_json" onclick="launch_newwindow('http://jony5.com/_proxy/bassdrive_colors/?stream=y0NXmHUd7pz5pqgZahU2KAvFXWCXxPOsUKlD6rI5t3dP0WiuJzakPQXZBn2OkuTf'); return false;" style="background-image:url(http://jony5.com/common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=42020173.1635649010.0)"></div>
                    <div class="cb"></div>
                </div>
            </div>
            <div class="colors_wrapper">
                <div class="colors_img_wrapper"><img src="http://jony5.com/common/imgs/bassdrive_component_creative/flag_united_kingdom.gif" width="64" height="32" alt="LONDON, UK" title="National flag for LONDON, UK"></div>
                <div class="cb"></div>
                <div class="colors_city_state">LONDON, UK</div>
                <div class="cb"></div>
                <div class="colors_show_date_generated"><span style="font-weight: bold;">Generated on:&nbsp;&nbsp;</span>Thursday, Nov. 11 at 17:42:05 EST</div>
            </div>
        </div>
        <div class="colors_hr_wrapper"><div class="colors_hr"></div></div>
         * */

    }

    public function generate_stream_meta_stats($oQueryProfileMgr){

        // STATS META

    }

    public function return_history_html(){

        //
        // HTML FOR HISTORY HTML INJECTION.
        $tmp_html_out = '<div>
            <div class="colors_show_title_wrapper">The just on  track show with Ashatack<br><span class="player-host"><span style="color:#F00; font-weight: bold;">Live</span></span>
                <div class="cb"></div>
                <div id="bassdrive_social_wrapper" class="bassdrive_social_wrapper">
                    <div class="bassdrive_social_link stream_soundcloud" onclick="launch_newwindow(\'https://soundcloud.com/ashatack\'); return false;" style="background-image:url(http://jony5.com/common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=42020173.1635649010.0)"></div><div class="hidden">Click <a href="https://soundcloud.com/ashatack" target="_blank">here</a> for the The just on  track show with Ashatack<br><span class="player-host">Live</span> SoundCloud playlist.</div>

                    <div class="bassdrive_social_link stream_twitter" onclick="launch_newwindow(\'https://twitter.com/Ashatack68\'); return false;" style="background-image:url(http://jony5.com/common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=42020173.1635649010.0)"></div><div class="hidden">Click <a href="https://twitter.com/Ashatack68" target="_blank">here</a> for the The just on  track show with Ashatack<br><span class="player-host">Live</span> Twitter feed.</div>

                    <div class="bassdrive_social_link stream_www" onclick="launch_newwindow(\'https://www.twitch.tv/ashatack68\'); return false;" style="background-image:url(http://jony5.com/common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=42020173.1635649010.0)"></div><div class="hidden">Click <a href="https://www.twitch.tv/ashatack68" target="_blank">here</a> for the website of The just on  track show with Ashatack<br><span class="player-host">Live</span>.</div>
                    <div class="bassdrive_social_link stream_paypal" onclick="launch_newwindow(\'https://www.paypal.com/donate?hosted_button_id=GWNVTUTPEAA8C\'); return false;" style="background-image:url(http://jony5.com/common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=42020173.1635649010.0)"></div><div class="hidden">Click <a href="https://www.paypal.com/donate?hosted_button_id=GWNVTUTPEAA8C" target="_blank">here</a> to make a donation to Bassdrive.</div>
                    <div class="bassdrive_social_link stream_json" onclick="launch_newwindow(\'http://jony5.com/_proxy/bassdrive_colors/?stream=y0NXmHUd7pz5pqgZahU2KAvFXWCXxPOsUKlD6rI5t3dP0WiuJzakPQXZBn2OkuTf\'); return false;" style="background-image:url(http://jony5.com/common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=42020173.1635649010.0)"></div>
                    <div class="cb"></div>
                </div>
            </div>
            <div class="colors_wrapper">
                <div class="colors_img_wrapper"><img src="http://jony5.com/common/imgs/bassdrive_component_creative/flag_united_kingdom.gif" width="64" height="32" alt="LONDON, UK" title="National flag for LONDON, UK"></div>
                <div class="cb"></div>
                <div class="colors_city_state">LONDON, UK</div>
                <div class="cb"></div>
                <div class="colors_show_date_generated"><span style="font-weight: bold;">Generated on:&nbsp;&nbsp;</span>Thursday, Nov. 11 at 17:42:05 EST</div>
            </div>
        </div>
        <div class="colors_hr_wrapper"><div class="colors_hr"></div></div>
        ';

        return $tmp_html_out;

    }

    /*
    if($this->oSTREAM_OUTPUT_CONTROLLER->){

        }

//        if(!isset($this->stream_history_log['IS_LIVE' . $tmp_STREAM_KEY]) || !isset($this->stream_history_log['REPLAY'.$tmp_STREAM_KEY])){
//
//            //
//            // IS THIS LIVE?
//            if($this->stream_is_LIVE($title)){
//
//                $tmp_stream_live_type = 'IS_LIVE';
//
//            }else{
//
//                $tmp_stream_live_type = 'REPLAY';
//
//            }
//
//            $this->stream_history_log[$tmp_stream_live_type.$tmp_STREAM_KEY] = 1;
//
//        }

        return $this->oSTREAM_OUTPUT_CONTROLLER->;

    */

    public function __destruct() {

    }
}