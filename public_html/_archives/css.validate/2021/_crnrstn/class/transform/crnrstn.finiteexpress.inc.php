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
# # C # R # N # R # S # T # N # : : # # ##
#
#  CLASS :: finite_expression
#  VERSION :: 1.00.0000
#  DATE :: July 4, 2020 @ 1620hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: Talking about time.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
//
// I'M NOT SUPER STOKED ABOUT THE CLASS NAME...BUT WE WILL CONTINUE.
// IF I CAN FIND SOME APPROPRIATE AND SCRIPTURALLY RELATED ELEMENT TO
// REPRESENT OR EMBODY THIS DATE/TIME THING, I'LL DO IT (sans_eternity, finite_expression).
// - "KIVOTOS" AND "STREAM" ARE EXCELLENT AND APPROPRIATE EXAMPLES OF
// THIS IN ACTION. JESUS CHRIST ON THE EARTH WAS GOD INFINITE EXPRESSED
// IN MAN-FINITE. JESUS ON EARTH WAS THE FINITE EXPRESSION OF THE ALMIGHTY
// GOD THE CREATOR OF THE HEAVENS AND THE EARTH IN SPACE AND IN TIME AND
// HE IS REPRODUCING HIMSELF IN US TODAY.
#
class finite_expression {

    private static $lang_content_ARRAY = array();

    public function __construct(){

        $this->initialize_language();

    }

    public function incarnate($mode, $sys_ts, $format_override=NULL){
        /* DATE DISPLAY MODES - MIN REQUIRED
         * ELAPSED_VERBOSE - 15 weeks 3 days 4 hours 2 minutes 5 seconds ago
         * ELAPSED - 15w 3d 4h 2m 5s ago
         * SYSTEM(DEFAULT) MM.DD.YYYY at 24:00:00
         * */

        // WE SHOULD CALC CURRENT TIMESTAMP USED IN MEASUREMENT AS CLOSE TO POINT OF IMPLEMENTATION AS POSSIBLE
        // Timestamp of the start of the request is available in $_SERVER['REQUEST_TIME'] since PHP 5.1. COMPARE THAT
        // WITH CRNRSTN oENV->wall_time() CALC AND CONSIDER PULLING IN $_SERVER[] PARAM INSTEAD OF CALCULATING START TIME WITHIN CONSTRUCTOR OF CRNRSTN ::

        // WE WILL NEED TO CONVERT SYSTEM TIME TO SECONDS. TRY THIS.
        $tmp_sys_ts_seconds = strtotime($sys_ts);

        switch($mode){
            case 'ELAPSED':
                 #$ts = time();
                 $tmp_output = $this->elapsed($tmp_sys_ts_seconds,$format_override);

            break;
            case 'ELAPSED_VERBOSE':
                #$ts = time();
                $tmp_output = $this->elapsed_verbose($tmp_sys_ts_seconds,$format_override);

            break;
            default:
                if(isset($format_override)){
                    $tmp_output = date($format_override, $tmp_sys_ts_seconds);
                }else{

                    $tmp_output = date('m.d.Y @ H:i:s', $tmp_sys_ts_seconds);
                }

            break;

        }

        return $tmp_output;

    }

    //
    // THIS SHOULD NOT REQUIRE OR DEPEND ON EVIFWEB LANGUAGE ENGINE. THIS IS TO SUPPORT CRNRSTN USES OF THIS CLASS SANS LANG SUPPORT.
    private function initialize_language(){

        self::$lang_content_ARRAY['YEAR'] = 'year';
        self::$lang_content_ARRAY['YEARS'] = 'years';
        self::$lang_content_ARRAY['Y'] = 'y';
        self::$lang_content_ARRAY['WEEK'] = 'week';
        self::$lang_content_ARRAY['WEEKS'] = 'weeks';
        self::$lang_content_ARRAY['W'] = 'w';
        self::$lang_content_ARRAY['DAY'] = 'day';
        self::$lang_content_ARRAY['DAYS'] = 'days';
        self::$lang_content_ARRAY['D'] = 'd';
        self::$lang_content_ARRAY['HOUR'] = 'hour';
        self::$lang_content_ARRAY['HOURS'] = 'hours';
        self::$lang_content_ARRAY['H'] = 'h';
        self::$lang_content_ARRAY['MINUTE'] = 'minute';
        self::$lang_content_ARRAY['MINUTES'] = 'minutes';
        self::$lang_content_ARRAY['M'] = 'm';
        self::$lang_content_ARRAY['SECOND'] = 'second';
        self::$lang_content_ARRAY['SECONDS'] = 'seconds';
        self::$lang_content_ARRAY['S'] = 's';
        self::$lang_content_ARRAY['AND'] = 'and';
        self::$lang_content_ARRAY['AGO'] = 'ago';

        #error_log("finite (101)->".print_r(self::$lang_content_ARRAY['WEEKS']));

    }

    //
    // THIS WILL INITIALIZE LANGUAGE (ISO) TO BE USED BY THE FINITE_EXPRESS OBJECT. HIT THIS ONCE PER PAGE TO CONFIGURE ALL FINITE EXPRESSIONS FOR SESSION ISOCODE.
    // METHOD CALL IS OPTIONAL. ENGLISH WILL BE ASSUMED DEFAULT.
    public function configure_language($oUser){

        //
        // THIS. WILL. BE. MANUAL.
        self::$lang_content_ARRAY['YEAR'] = $oUser->getLangElem('FINITE_EXP_YEAR');
        self::$lang_content_ARRAY['YEARS'] = $oUser->getLangElem('FINITE_EXP_YEARS');
        self::$lang_content_ARRAY['Y'] = $oUser->getLangElem('FINITE_EXP_Y');
        self::$lang_content_ARRAY['WEEK'] = $oUser->getLangElem('FINITE_EXP_WEEK');
        self::$lang_content_ARRAY['WEEKS'] = $oUser->getLangElem('FINITE_EXP_WEEKS');
        self::$lang_content_ARRAY['W'] = $oUser->getLangElem('FINITE_EXP_W');
        self::$lang_content_ARRAY['DAY'] = $oUser->getLangElem('FINITE_EXP_DAY');
        self::$lang_content_ARRAY['DAYS'] = $oUser->getLangElem('FINITE_EXP_DAYS');
        self::$lang_content_ARRAY['D'] = $oUser->getLangElem('FINITE_EXP_D');
        self::$lang_content_ARRAY['HOUR'] = $oUser->getLangElem('FINITE_EXP_HOUR');
        self::$lang_content_ARRAY['HOURS'] = $oUser->getLangElem('FINITE_EXP_HOURS');
        self::$lang_content_ARRAY['H'] = $oUser->getLangElem('FINITE_EXP_H');
        self::$lang_content_ARRAY['MINUTE'] = $oUser->getLangElem('FINITE_EXP_MINUTE');
        self::$lang_content_ARRAY['MINUTES'] = $oUser->getLangElem('FINITE_EXP_MINUTES');
        self::$lang_content_ARRAY['M'] = $oUser->getLangElem('FINITE_EXP_M');
        self::$lang_content_ARRAY['SECOND'] = $oUser->getLangElem('FINITE_EXP_SECOND');
        self::$lang_content_ARRAY['SECONDS'] = $oUser->getLangElem('FINITE_EXP_SECONDS');
        self::$lang_content_ARRAY['S'] = $oUser->getLangElem('FINITE_EXP_S');
        self::$lang_content_ARRAY['AND'] = $oUser->getLangElem('FINITE_EXP_AND');
        self::$lang_content_ARRAY['AGO'] = $oUser->getLangElem('FINITE_EXP_AGO');

    }

    # SOURCE :: http://php.net/manual/en/function.time.php
    private function elapsed($secs, $format_override){
        $ts = time();
        $delta_secs = $ts-$secs;

        $bit = array(
            self::$lang_content_ARRAY['Y'] => $delta_secs / 31556926 % 12,
            self::$lang_content_ARRAY['W'] => $delta_secs / 604800 % 52,
            self::$lang_content_ARRAY['D'] => $delta_secs / 86400 % 7,
            self::$lang_content_ARRAY['H'] => $delta_secs / 3600 % 24,
            self::$lang_content_ARRAY['M'] => $delta_secs / 60 % 60,
            self::$lang_content_ARRAY['S'] => $delta_secs % 60
        );

        //
        // LET'S CONFIRM LANG OPERATION
        //error_log("(146) Y->".self::$lang_content_ARRAY['Y']);      // shows 1...not y...

        foreach($bit as $k => $v){
            if($v > 0){
                //
                // PUT IN CURFEW FOR TIME GRANULARITY
                if($k==self::$lang_content_ARRAY['Y'] || $k==self::$lang_content_ARRAY['W'] || ($k==self::$lang_content_ARRAY['D'] && $v>1)){

                    //
                    // RETURN DEFAULT DATE FORMAT
                    if(isset($format_override)){

                        return date($format_override, $secs);

                    }else{

                        return date('m.d.Y @ H:i:s', $secs);
                    }

                }else{

                    $ret[] = $v . $k;

                }
            }
        }

        if(!isset($ret)){

            $ret[] = 'just now.';

        }else{

            if(sizeof($ret)==0){

                $ret[] = 'just now.';

            }else{

                $ret[] = self::$lang_content_ARRAY['AGO'];

            }

        }

        return join(' ', $ret);

    }

    # SOURCE :: http://php.net/manual/en/function.time.php
    private function elapsed_verbose($secs){

        //
        // THIS SHOULD BE EXPOSED TO THE LANGUAGE ENGINE OF THE EVIFWEB CLIENT EXTRANET. NOT HARD CODED ENGLISH....OH MY. WHAT A REQUIREMENT THIS IS.
        // RE-CRNRSTN, IT MAY NOT BE APPROPRIATE TO PUSH LANG CONSIDERATIONS. WELL, MAYBE....THIS WOULD BE A FIRST FOR CRNRSTN...
        // I DON'T WANT TO PROCEED UNTIL I AM CLEAR ABOUT LANG SUPPORT DIRECTION FOR THIS. THERE ARE IMPLICATIONS.
        // TO REALLY TAKE CARE OF THE PEOPLE, DON'T FORGET SINGULAR AND PLURAL SUPPORT FOR MULTIPLE LANG...SO 2x THE NUMBER OF FORMATS...

        //
        // WE NEED TO APPROACH THIS DIFFERENTLY TO ALLOW FOR PLURAL
        $bit = array(
            '0'        => $secs / 31556926 % 12,
            '1'        => $secs / 604800 % 52,
            '2'        => $secs / 86400 % 7,
            '3'        => $secs / 3600 % 24,
            '4'        => $secs / 60 % 60,
            '5'        => $secs % 60
        );

        $bit_singular = array(
            '0'     => ' '.self::$lang_content_ARRAY['YEAR'],
            '1'     => ' '.self::$lang_content_ARRAY['WEEK'],
            '2'     => ' '.self::$lang_content_ARRAY['DAY'],
            '3'     => ' '.self::$lang_content_ARRAY['HOUR'],
            '4'     => ' '.self::$lang_content_ARRAY['MINUTE'],
            '5'     => ' '.self::$lang_content_ARRAY['SECOND']
        );

        $bit_plural = array(
            '0'     => ' '.self::$lang_content_ARRAY['YEARS'],
            '1'     => ' '.self::$lang_content_ARRAY['WEEKS'],
            '2'     => ' '.self::$lang_content_ARRAY['DAYS'],
            '3'     => ' '.self::$lang_content_ARRAY['HOURS'],
            '4'     => ' '.self::$lang_content_ARRAY['MINUTES'],
            '5'     => ' '.self::$lang_content_ARRAY['SECONDS']
        );

        foreach($bit as $k => $v){
            if($v > 1){
                $ret[] = $v . $bit_plural[$k];
                //error_log("finite (194) test ->".$bit_plural[$k]);

            }else{

                if($v == 1){
                    $ret[] = $v . $bit_singular[$k];
                    //error_log("finite (200) test ->".$bit_singular[$k]);
                }
            }
        }

//        foreach($bit_singular as $k => $v){
//            if($v > 1)$ret[] = $v . $k . 's';           // APPENDING AN S FOR PLURAL IS PRIMARILY ENGLISH. WE CAN'T RELY ON THIS APPEND OUR PURPOSES.
//            if($v == 1)$ret[] = $v . $k;
//        }

        array_splice($ret, count($ret)-1, 0, self::$lang_content_ARRAY['AND']);
        $ret[] = self::$lang_content_ARRAY['AGO'];

        return join(' ', $ret);

    }

    public function addTimerBuffer($timer_copy, $lastcontact){

        $tsec = time();

        //
        // GET DELTA SECONDS
        $tmp_lastcontact_tsec = strtotime($lastcontact);

        # $timer_copy = 0:00:09
        $delta_secs = $tsec - $tmp_lastcontact_tsec;

        list($tmp_hour, $tmp_min, $tmp_sec) = explode(':', $timer_copy);

        $tmp_secs_cumm = $this->convertToSecs($tmp_hour, $tmp_min, $tmp_sec);

        $final_secs_cumm = $tmp_secs_cumm + $delta_secs;

        $timer_copy_new = $this->secsTimerExplode($final_secs_cumm, ':');

        return $timer_copy_new;

    }

    public function secsTimerExplode($secs, $delim){

        //
        // EXTRACT HOURS MIN SECS FROM TOTAL SECS
        // SOURCE :: https://stackoverflow.com/questions/3172332/convert-seconds-to-hourminutesecond/3172358
        // AUTHOR :: https://stackoverflow.com/users/51760/aif
        $hours = floor($secs / 3600);
        $minutes = floor(($secs / 60) % 60);
        $seconds = $secs % 60;
        //error_log('287 finiteexpress hour['.$hours.'] min['.$minutes.'] sec['.$seconds.']');

        if($seconds<10){
            $seconds = '0'.$seconds;
        }

        if($minutes<10){
            $minutes = '0'.$minutes;
        }

        return $hours.$delim.$minutes.$delim.$seconds;
    }

    private function convertToSecs($hour, $min, $sec){

        /*

        $hour = '01',
        $min = '05,
        $sec = '09'

        */

        $hour = intval($hour);
        $min = intval($min);
        $sec = intval($sec);

        //error_log('311 finiteexpress hour['.$hour.'] min['.$min.'] sec['.$sec.']');

        $tmp_hour_secs = $hour * 60 * 60;
        $tmp_min_secs = $min * 60;

        $tmp_cumm_secs = (int) $sec + (int) $tmp_hour_secs + (int) $tmp_min_secs;

        return $tmp_cumm_secs;
    }

    public function __destruct() {

    }

}

# # C # R # N # R # S # T # N # : : # # ##
#
#  CLASS :: crnrstn_chunk_restrictor
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  VERSION :: 1.00.0000
#  DATE :: October 23, 2020 @ 0747hrs
#  DESCRIPTION :: Break a string into target size chunks, brutally.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_chunk_restrictor {

    protected $oLogger;
    private static $oCRNRSTN_ENV;

    protected $chunk_hash;
    protected $raw_content;
    protected $encoding;
    protected $max_len = 52;
    protected $content_mbstring_length;
    protected $chunk_line_out_ARRAY = array();
    protected $chunk_HTML_line_out_ARRAY = array();
    protected $chunk_TEXT_line_out_ARRAY = array();
    private static $output_HTML_str_ARRAY = array();
    protected $output_TEXT_str_ARRAY = array();
    protected $output_LOG_str_ARRAY = array();

    private static $chunkResults_ARRAY = array();

    public function __construct($page_content, $max_len, $oCRNRSTN_ENV, $encoding = 'UTF-8') {

        self::$oCRNRSTN_ENV = $oCRNRSTN_ENV;

        $this->oLogger = new crnrstn_logging(self::$oCRNRSTN_ENV->CRNRSTN_debugMode, __CLASS__, self::$oCRNRSTN_ENV->log_silo_profile, self::$oCRNRSTN_ENV);

        $this->chunk_hash = md5($page_content);
        $this->raw_content = $page_content;
        $this->encoding = $encoding;
        $this->content_mbstring_length = mb_strlen($this->raw_content, $encoding);

        self::$output_HTML_str_ARRAY[$this->chunk_hash] = '';
        $this->output_TEXT_str_ARRAY[$this->chunk_hash] = '';
        $this->output_LOG_str_ARRAY[$this->chunk_hash] = '';

        if(isset($max_len)){

            $this->max_len = (int) $max_len;

        }

        self::$chunkResults_ARRAY[$this->chunk_hash]['max_len'] = $this->max_len;

        $this->basic_content_chunking();

    }

    public function return_linesArray(){

        return $this->chunk_line_out_ARRAY[$this->chunk_hash];

    }

    public function return_originalContent(){

        return $this->raw_content;

    }

    public function return_linesString($output_format = 'TEXT', $new_line_prefix = ''){

        $fline_new = true;

        switch($output_format){
            case 'HTML':

                if(self::$output_HTML_str_ARRAY[$this->chunk_hash] != ''){

                    return self::$output_HTML_str_ARRAY[$this->chunk_hash];

                }else{

                    foreach($this->chunk_HTML_line_out_ARRAY[$this->chunk_hash] as $key => $line){

                        self::$output_HTML_str_ARRAY[$this->chunk_hash] .= $line;

                    }

                    return self::$output_HTML_str_ARRAY[$this->chunk_hash];

                }

            break;
            case 'TEXT':

                if($this->output_TEXT_str_ARRAY[$this->chunk_hash] != ''){

                    return $this->output_TEXT_str_ARRAY[$this->chunk_hash];

                }else{

                    $newline = '';
                    $fline_new = true;
                    foreach($this->chunk_TEXT_line_out_ARRAY[$this->chunk_hash] as $key => $line){

                        if($fline_new){

                            $fline_new = false;

                            $this->output_TEXT_str_ARRAY[$this->chunk_hash] .= $line;

                        }else{

                            $this->output_TEXT_str_ARRAY[$this->chunk_hash] .= $newline.$new_line_prefix.$line;

                        }

                    }

                    return $this->output_TEXT_str_ARRAY[$this->chunk_hash];

                }

            break;
            case 'SCREEN_TEXT':

                if($this->output_TEXT_str_ARRAY[$this->chunk_hash] != ''){

                    return $this->output_TEXT_str_ARRAY[$this->chunk_hash];

                }else{

                    $newline = '';
                    $fline_new = true;
                    foreach($this->chunk_TEXT_line_out_ARRAY[$this->chunk_hash] as $key => $line){

                        if($fline_new){

                            $fline_new = false;

                            $this->output_TEXT_str_ARRAY[$this->chunk_hash] .= $line;

                        }else{

                            $this->output_TEXT_str_ARRAY[$this->chunk_hash] .= $newline.$new_line_prefix.$line;

                        }

                    }

                    return $this->output_TEXT_str_ARRAY[$this->chunk_hash];

                }

            break;
            default:

                if($this->output_LOG_str_ARRAY[$this->chunk_hash] != ''){

                    return $this->output_LOG_str_ARRAY[$this->chunk_hash];

                }else{

                    //case 'ERROR_LOG':
                    $fline_new = true;
                    foreach($this->chunk_line_out_ARRAY[$this->chunk_hash] as $key => $line){

                        if($fline_new){

                            $fline_new = false;

                            $this->output_LOG_str_ARRAY[$this->chunk_hash] .= $line;

                        }else{

                            $this->output_LOG_str_ARRAY[$this->chunk_hash] .= $new_line_prefix.$line;

                        }

                    }

                    return $this->output_LOG_str_ARRAY[$this->chunk_hash];

                }

            break;

        }

    }

    private function add_restricted_content_chunk($tmp_line, $is_first_line = true){

        //$tmp_line = trim($tmp_line);

        if($is_first_line){

            $this->chunk_line_out_ARRAY[$this->chunk_hash][] = $tmp_line;
            $this->chunk_HTML_line_out_ARRAY[$this->chunk_hash][] = '<br>'.$tmp_line;
            $this->chunk_TEXT_line_out_ARRAY[$this->chunk_hash][] = '
'.$tmp_line;

        }else{

            $this->chunk_line_out_ARRAY[$this->chunk_hash][] = $tmp_line;
            $this->chunk_HTML_line_out_ARRAY[$this->chunk_hash][] = '<br>...'.$tmp_line;
            $this->chunk_TEXT_line_out_ARRAY[$this->chunk_hash][] = '
   '.$tmp_line;

        }

    }

    private function basic_content_chunking(){

        $isFirstline = true;

        if($this->content_mbstring_length < $this->max_len){

            $this->add_restricted_content_chunk($this->raw_content, $isFirstline);

        }else{

            $tmp_line_ARRAY = $this->str_split_unicode($this->raw_content, $this->max_len);

            $tmp_cnt = count($tmp_line_ARRAY);
            for($i=0; $i < $tmp_cnt; $i++){

                $this->add_restricted_content_chunk($tmp_line_ARRAY[$i], $isFirstline);

                $isFirstline = false;

            }

        }

    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.str-split.php
    // AUTHOR :: qeremy [atta] gmail [dotta] com :: https://www.php.net/manual/en/function.str-split.php#107658
    public function str_split_unicode($str, $l = 0) {

        if ($l > 0) {

            $ret = array();
            $len = mb_strlen($str, $this->encoding);

            for ($i = 0; $i < $len; $i += $l) {

                $ret[] = mb_substr($str, $i, $l, $this->encoding);

            }

            return $ret;
        }

        return preg_split('//u', $str, -1, PREG_SPLIT_NO_EMPTY);

    }

    public function __destruct() {

    }

}