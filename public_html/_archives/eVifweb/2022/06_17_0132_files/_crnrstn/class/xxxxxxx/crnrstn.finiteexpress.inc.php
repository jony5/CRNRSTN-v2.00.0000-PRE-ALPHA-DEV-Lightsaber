<?php
/*
// J5
// Code is Poetry */


//
// I'M NOT SUPER STOKED ABOUT THE CLASS NAME...BUT WE WILL CONTINUE.
// IF I CAN FIND SOME APPROPRIATE AND SCRIPTURALLY RELATED ELEMENT TO REPRESENT OR EMBODY THIS DATE/TIME THING, I'LL DO IT (sans_eternity, finite_expression).
// - "KIVOTOS" AND "STREAM" ARE EXCELLENT AND APPROPRIATE EXAMPLES OF THIS IN ACTION.
//  JESUS CHRIST ON THE EARTH WAS GOD INFINITE EXPRESSED IN MAN-FINITE. JESUS IS THE FINITE EXPRESSION OF THE ALMIGHTY GOD THE CREATOR OF THE HEAVENS AND THE EARTH.
class finite_expression {

    private static $oLogger;
    private static $lang_content_ARRAY = array();

    public function __construct()
    {
        try{
            //
            // INSTANTIATE LOGGER
            self::$oLogger = new crnrstn_logging();

            $this->initialize_language();


        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('finite_express->__construct()', LOG_EMERG, $e->getMessage());

        }


    }

    public function incarnate($mode, $sys_ts, $format_override=NULL){
        /* DATE DISPLAY MODES - MIN REQUIRED
         * ELAPSED_VERBOSE - 15 weeks 3 days 4 hours 2 minutes 5 seconds ago
         * ELAPSED - 15w 3d 4h 2m 5s ago
         * SYSTEM(DEFAULT) MM.DD.YYYY at 24:00:00
         * */

        // WE SHOULD CALC CURRENT TIMESTAMP USED IN MEASUREMENT AS CLOSE TO POINT OF IMPLEMENTATION AS POSSIBLE
        // Timestamp of the start of the request is available in $_SERVER['REQUEST_TIME'] since PHP 5.1. COMPARE THAT
        // WITH CRNRSTN oENV->wallTime() CALC AND CONSIDER PULLING IN $_SERVER[] PARAM INSTEAD OF CALCULATING START TIME WITHIN CONSTRUCTOR OF CRNRSTN ::

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

                    $tmp_output = date("m.d.Y @ H:i:s", $tmp_sys_ts_seconds);
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
    private function elapsed($secs){
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

                        return date("m.d.Y @ H:i:s", $secs);
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

    public function __destruct() {

    }

}