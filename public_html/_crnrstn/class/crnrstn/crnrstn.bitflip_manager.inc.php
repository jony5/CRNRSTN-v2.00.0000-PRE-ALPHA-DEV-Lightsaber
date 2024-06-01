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
#  CLASS :: crnrstn_bitflip_manager
#  VERSION :: 1.00.0000
#  DATE :: March 4, 2021 @ 0529 hrs.
#  AUTHOR :: Jonathan '5' Harris, jharris@eVifweb.com, eVifweb@gmail.com.
#  URI :: http://eVifweb.jony5.com
#  DESCRIPTION :: Bit flip management.
#  LICENSE :: MIT | https://crnrstn.jony5.com/licensing/
#
class crnrstn_bitflip_manager {

    public $oCRNRSTN;
    protected $oCRNRSTN_BITWISE;

    protected $oCRNRSTN_BITS_ARRAY = array();

    private static $os_bit_size;
    private static $lscpu_output;
    private static $uname_output;
    private static $getconf_output;

    protected $bit_value_array = array();
    protected $global_constants_string_ARRAY = array();

    private static $system_int_constants_string_ARRAY = array();
    private static $bitflag_constant_serial_ARRAY = array();

    private static $crnrstn_bits_position_by_serial_ARRAY = array();

    public function __construct($oCRNRSTN){

        $this->oCRNRSTN = $oCRNRSTN;

        $this->initialize_cpu_profile();
        $this->initialize_bitwise_constants();

    }

    private function initialize_const_string_array($CRNRSTN_CONSTANTS_ARRAY){

        self::$system_int_constants_string_ARRAY = $CRNRSTN_CONSTANTS_ARRAY;

    }

    public function integer_constants_unit_test(){

        $str_out = '';
        $tmp_flag_ARRAY = array();

        foreach(self::$system_int_constants_string_ARRAY as $index => $const_nom_str){

            $tmp_INT = $this->oCRNRSTN->return_int_const_profile($const_nom_str, 'INTEGER');

            if(!is_int($tmp_INT) || ($tmp_INT == 0 && ($const_nom_str !== 'CRNRSTN_DEBUG_OFF'))){

                $str_out .= '<span style="color: #F90000; font-weight: bold;">ERROR.</span> Configuration incomplete for [' . $tmp_INT . '] ' . $const_nom_str . '.<br>';

            }else{

                if(!isset($tmp_flag_ARRAY[$tmp_INT])){

                    $tmp_flag_ARRAY[$tmp_INT] = 1;
                    $str_out .= '<span style="color: #5fbb35;">SUCCESS.</span> Configuration match detected for ' . $const_nom_str . '.<br>';

                }else{

                    $str_out .= '<span style="color: #F90000; font-weight: bold;">ERROR.</span> Configuration redundancy detected with ' . $tmp_INT . '::' . $const_nom_str . '.<br>';

                }

            }

        }

        return $str_out;

    }

    public function return_serialized_bit_value($bitwise_object_array_index_serial, $integer_constant){

        if(!isset($this->oCRNRSTN_BITS_ARRAY['CRNRSTN_' . $this->oCRNRSTN->hash($bitwise_object_array_index_serial, 'md5')])){

            return false;

        }else{

            $oCRNRSTN_BITMASK = $this->oCRNRSTN_BITS_ARRAY['CRNRSTN_' . $this->oCRNRSTN->hash($bitwise_object_array_index_serial, 'md5')];

            $tmp_val = $this->return_bit_value($integer_constant);

            return $tmp_val;

        }

    }

    public function return_bit_constant($name){

        //return $this->return_bit_value($name);

        return constant($name);

    }

    public function toggle_serialized_bit($name, $integer_constant, $is_bit_set = NULL){

        if(!isset($this->oCRNRSTN_BITS_ARRAY['CRNRSTN_' . $this->oCRNRSTN->hash($name, 'md5')])){

            return false;

        }

        $oCRNRSTN_BITMASK = $this->oCRNRSTN_BITS_ARRAY['CRNRSTN_' . $this->oCRNRSTN->hash($name, 'md5')];

        if(is_bool($is_bit_set)){

            if($is_bit_set == true){

                if(!($oCRNRSTN_BITMASK->read($integer_constant) == true)){

                    //
                    // FLIP TO 1
                    $oCRNRSTN_BITMASK->toggle($integer_constant);

                }

            }else{

                if($oCRNRSTN_BITMASK->read($integer_constant) == true){

                    //
                    // FLIP TO 0
                    $oCRNRSTN_BITMASK->toggle($integer_constant);

                }

            }

        }else{

            //
            // FLIP IT ::
            // https://www.youtube.com/watch?v=eBShN8qT4lk
            // TITLE :: Beastie Boys - (You Gotta) Fight For Your Right (To Party) (Official Music Video)
            $oCRNRSTN_BITMASK->toggle($integer_constant);

        }

        $this->oCRNRSTN_BITS_ARRAY['CRNRSTN_' . $this->oCRNRSTN->hash($name, 'md5')] = $oCRNRSTN_BITMASK;

        return $oCRNRSTN_BITMASK->read($integer_constant);

    }

    public function toggle_bit($integer_constant, $is_bit_set = NULL){

        if(!isset($this->oCRNRSTN_BITWISE)){

            return false;

        }else{

            if(is_bool($is_bit_set)){

                $this->oCRNRSTN_BITWISE->toggle($integer_constant);

                if($is_bit_set == true){

                    if(!($this->oCRNRSTN_BITWISE->read($integer_constant) == true)){

                        //
                        // FLIP TO 1
                        $this->oCRNRSTN_BITWISE->toggle($integer_constant);

                    }

                }else{

                    if($this->oCRNRSTN_BITWISE->read($integer_constant) == true){

                        //
                        // FLIP TO 0
                        $this->oCRNRSTN_BITWISE->toggle($integer_constant);

                    }

                }

            }else{

                //
                // FLIP IT ::
                // https://www.youtube.com/watch?v=eBShN8qT4lk
                // TITLE :: Beastie Boys - (You Gotta) Fight For Your Right (To Party) (Official Music Video)
                $this->oCRNRSTN_BITWISE->toggle($integer_constant);

            }

            return $this->oCRNRSTN_BITWISE->read($integer_constant);

        }

    }

    public function initialize_serialized_bit($name, $integer_const, $default_state = true){

        if(!isset($this->oCRNRSTN_BITS_ARRAY['CRNRSTN_' . $this->oCRNRSTN->hash($name, 'md5')])){

            //
            // SOURCE :: https://www.php.net/manual/en/language.operators.bitwise.php
            // AUTHOR :: icy at digitalitcc dot com :: https://www.php.net/manual/en/language.operators.bitwise.php#50299
            $oCRNRSTN_BITMASK = new crnrstn_bitmask();

            //error_log(__LINE__ .' '. __METHOD__ .' NEW bitmask object flipping['.$integer_const.'] to array index, '.strtoupper($this->oCRNRSTN->hash($name, 'md5')));
            $this->oCRNRSTN_BITS_ARRAY['CRNRSTN_' . $this->oCRNRSTN->hash($name, 'md5')] = $oCRNRSTN_BITMASK;

        }

        $oCRNRSTN_BITMASK = $this->oCRNRSTN_BITS_ARRAY['CRNRSTN_' . $this->oCRNRSTN->hash($name, 'md5')];

        //
        // THIS WILL BASICALLY RETURN AN INT++ FOR EACH UNIQUE CONSTANT PROVIDED.
        // USING BITMASK OBJECT FROM icy at digitalitcc dot com TO MANAGE ACTUAL
        // STORAGE, FLIP, AND RETRIEVAL...THEREFORE WE DON'T REALLY CARE ABOUT THE
        // INTEGER BEING STORED...JUST MAKE IT UNIQUE...LIKE, AUTO-INCREMENT UNIQUE.
        $tmp_val = $this->return_bit_value($integer_const);

        if($default_state == true){

            //
            // FLAG - STATE IS ON
            $oCRNRSTN_BITMASK->set($integer_const);

        }else{

            //
            // FLAG - STATE IS OFF
            $oCRNRSTN_BITMASK->set($integer_const);
            $oCRNRSTN_BITMASK->toggle($integer_const);

        }

        //error_log(__LINE__ . ' ' . __METHOD__ . ' we put back into the array[' . strtoupper($this->oCRNRSTN->hash($name, 'md5')) . ']...a oCRNRSTN_BITMASK object.');
        $this->oCRNRSTN_BITS_ARRAY['CRNRSTN_' . $this->oCRNRSTN->hash($name, 'md5')] = $oCRNRSTN_BITMASK;

        return $tmp_val;

    }

    public function initialize_bit($constant_nom, $default_state = false, $constant_value = NULL){

        if(!isset($this->oCRNRSTN_BITWISE)){

            //
            // SOURCE :: https://www.php.net/manual/en/language.operators.bitwise.php
            // AUTHOR :: icy at digitalitcc dot com :: https://www.php.net/manual/en/language.operators.bitwise.php#50299
            $this->oCRNRSTN_BITWISE = new crnrstn_bitmask();

        }

        if(is_int($constant_nom)){

            //
            // USE PROVIDED CONST NOM AS (INT) VALUE IF INTEGER PASSED IN AS CONSTANT NAME
            $constant_value = $constant_nom;

        }

        //
        // USING BITMASK OBJECT FROM icy at digitalitcc dot com TO MANAGE ACTUAL
        // STORAGE, FLIP, AND RETRIEVAL. THIS HERE WILL HONOR THE CONSTANT VALUES.
        $tmp_val = $this->return_bit_value($constant_nom, $constant_value);

        if($default_state == true){

            //
            // FLAG - STATE IS ON.
            //$this->oCRNRSTN_BITWISE->set($tmp_val);
            $this->oCRNRSTN_BITWISE->set($tmp_val);
            //error_log(__LINE__ . ' crnrstn $os_bit_size[' . self::$os_bit_size . ']. BIT[' . print_r(gettype($this->oCRNRSTN_BITWISE->read($tmp_val)), true) . ']. $tmp_val[' . $tmp_val . ']. $default_state[' .  $default_state . ']. $constant_nom[' .  $constant_nom . ']. ');

        }else{

            //
            // FLAG - STATE IS OFF.
            $this->oCRNRSTN_BITWISE->set($tmp_val);
            $this->oCRNRSTN_BITWISE->toggle($tmp_val);
            //error_log(__LINE__ . ' crnrstn $default_state[' .  $default_state . ']. $constant_nom[' .  $constant_nom . ']. ');

        }

        return $tmp_val;

    }

    public function is_serialized_bit_set($name, $integer_constant){

        if(!isset($this->oCRNRSTN_BITS_ARRAY['CRNRSTN_' . $this->oCRNRSTN->hash($name, 'md5')])){

            return false;

        }else{

            //error_log(__LINE__ .' '. __METHOD__ .' we think the array[' . $name . '] index holds a oCRNRSTN_BITMASK object.');
            $oCRNRSTN_BITMASK = $this->oCRNRSTN_BITS_ARRAY['CRNRSTN_' . $this->oCRNRSTN->hash($name, 'md5')];

            return $oCRNRSTN_BITMASK->read($integer_constant);

        }

    }

    public function is_bit_set($integer_constant){

        return $this->oCRNRSTN_BITWISE->read($integer_constant);

    }

    public function serialized_bit_stringin($name, $bits_stringin){

        if(!isset($this->oCRNRSTN_BITS_ARRAY['CRNRSTN_' . $this->oCRNRSTN->hash($name, 'md5')])){

            //
            // SOURCE :: https://www.php.net/manual/en/language.operators.bitwise.php
            // AUTHOR :: icy at digitalitcc dot com :: https://www.php.net/manual/en/language.operators.bitwise.php#50299
            $oCRNRSTN_BITMASK = new crnrstn_bitmask();

            $this->oCRNRSTN_BITS_ARRAY['CRNRSTN_' . $this->oCRNRSTN->hash($name, 'md5')] = $oCRNRSTN_BITMASK;

        }

        $oCRNRSTN_BITMASK = $this->oCRNRSTN_BITS_ARRAY['CRNRSTN_' . $this->oCRNRSTN->hash($name, 'md5')];

        $oCRNRSTN_BITMASK->stringin($bits_stringin);

        $this->oCRNRSTN_BITS_ARRAY['CRNRSTN_' . $this->oCRNRSTN->hash($name, 'md5')] = $oCRNRSTN_BITMASK;

        return true;

    }

    public function bit_stringin($int_string){

        return $this->oCRNRSTN_BITWISE->stringin($int_string);

    }

    public function serialized_bit_stringout($name){

        $tmp_str = '';

        if(!isset($this->oCRNRSTN_BITS_ARRAY['CRNRSTN_' . $this->oCRNRSTN->hash($name, 'md5')])){

            return false;

        }else{

            //error_log(__LINE__ .' '. __METHOD__ .' we think the array['.$name.'] index holds a oCRNRSTN_BITMASK object.');
            $oCRNRSTN_BITMASK = $this->oCRNRSTN_BITS_ARRAY['CRNRSTN_' . $this->oCRNRSTN->hash($name, 'md5')];

            $tmp_str = $oCRNRSTN_BITMASK->stringout();

            return $tmp_str;

        }

    }

    public function bit_stringout(){

        return $this->oCRNRSTN_BITWISE->stringout();

    }

    private function return_bit_value($bit_nom, $constant_value_override = null){

        if(isset($constant_value_override)){

            //
            // BIT_NOM IS THE STRING USED TO TRACK THE EXISTENCE OF UNIQUE
            // GLOBAL CONSTANTS AND THE INTEGER VALUE ASSIGNED TO THE SAME
            if(!isset($this->bit_value_array[$bit_nom])){

                $this->bit_value_array[$bit_nom] = $constant_value_override;

            }

            return $this->bit_value_array[$bit_nom];

        }else{

            if(!isset($this->bit_value_array[$bit_nom])){

                $this->bit_value_array[$bit_nom] = 1;

                $tmp_cnt = count($this->bit_value_array[$bit_nom]);

                $this->bit_value_array[$bit_nom] = $tmp_cnt;

            }

            return $this->bit_value_array[$bit_nom];

        }

    }

    public function return_global_constants_string_ARRAY(){

        return $this->global_constants_string_ARRAY;

    }

    private function initialize_bitwise_constants(){

        $const_file_path = dirname(__FILE__) . '/crnrstn.constants_load.inc.php';

        if(is_file($const_file_path)){

            //
            // WE USE THIS INTEGER TO THROW A LOGICAL SWITCH IN THE REQUIRE() FILE.
            $crnrstn_initialize_bits = 1;

            //
            // INCLUDE CRNRSTN :: CONSTANTS DEFINITION FILE
            //$this->error_log('addDatabase() for environment [' . $env_key . ']. including and evaluating file [' . $db_host_or_file_path . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
            require($const_file_path);

            $this->global_constants_string_ARRAY = $CRNRSTN_CONSTANTS_ARRAY;

        }else{

            //
            // WE COULD NOT FIND THE DATABASE CONFIGURATION FILE
            error_log('CRNRSTN :: ERROR :: Constants definition include file (' . $const_file_path . ') not recognized as a file on server [' . $_SERVER['SERVER_NAME'] . '].');

        }

    }

    private function initialize_cpu_profile(){

        if(substr(PHP_OS, 0, 3) == 'WIN'){

            // SRY, I DO NOT HAVE WINDOWS COMMANDS YET.
            //exec('for %I in ("' . $file . '") do @echo %~zI', $output);
            //$return = $output[0];
            self::$os_bit_size = (int) 64;
            //self::$os_bit_size = (int) 32;    //<--OH, THIS ONE? WELL, I DO NOT HAVE WINDOWS COMMANDS YET.

        }else{

            self::$lscpu_output = shell_exec('lscpu');
            self::$uname_output = shell_exec('uname -m');
            self::$getconf_output = (int) shell_exec('getconf LONG_BIT');
            //$this->getconf_output = 128;

            if(is_numeric(self::$getconf_output)){

                self::$os_bit_size = (int) self::$getconf_output;
                //error_log(__LINE__ . ' ' . __METHOD__ . ' os_bit_size=' . self::$os_bit_size);

            }else{

                //$pos_64 = strpos(self::$uname_output, '64');
                //if($pos_64 !== false){
                //
                //    self::$os_bit_size = (int) 64;
                //    //error_log(__LINE__ . ' ' . __METHOD__ . ' os_bit_size=' . self::$os_bit_size);
                //
                //}else{
                //
                //    //
                //    // IF WE CANNOT DETECT 64, SET TO 32. <<-- ISN'T THIS KINDA BACKWARDS, THO?
                //    // THINKING OF BUYING THAT NEW 32 BIT OS APPLE...UMMMM, I MEAN...IBM...UMMM,
                //    // I MEAN...MICROSOFT THINGY?
                //    self::$os_bit_size = (int) 32;
                //    //error_log(__LINE__ . ' ' . __METHOD__ . ' os_bit_size=' . self::$os_bit_size);
                //
                //}

                $pos_32 = strpos(self::$uname_output, '32');

                if($pos_32 !== false){

                    self::$os_bit_size = (int) 32;
                    //error_log(__LINE__ . ' ' . __METHOD__ . ' os_bit_size=' . self::$os_bit_size);

                }else{

                    //
                    // IF WE CANNOT DETECT 32, SET TO 64.
                    self::$os_bit_size = (int) 64;
                    //error_log(__LINE__ . ' ' . __METHOD__ . ' os_bit_size=' . self::$os_bit_size);

                }

            }

        }

    }

    public function return_system_info($property){

        switch($property){
            case 'os_bit_size':
                //self::$os_bit_size = 64;

                return self::$os_bit_size;

            break;
            case 'lscpu':
                //self::$lscpu_output = shell_exec('lscpu');

                return self::$lscpu_output;

            break;
            case 'uname':
                //self::$uname_output = shell_exec('uname -m');

                return self::$uname_output;

            break;
            case 'getconf':
                //self::$getconf_output = (int) shell_exec('getconf LONG_BIT');

                return self::$getconf_output;

            break;
            default:

                $this->oCRNRSTN->error_log('Unknown system property requested. ' . $this->oCRNRSTN->data_report($property), __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

            break;

        }

        return NULL;

    }

    //
    // SOURCE :: https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string
    // COMMENT :: https://stackoverflow.com/a/13733588
    // AUTHOR :: Scott :: https://stackoverflow.com/users/1698153/scott
    public function generate_new_key($len = 32, $char_selection = NULL){

        //
        // SEND -1 AS $char_selection FOR USE OF *ALL* CHARACTERS IN RANDOM KEY
        // GENERATION...ALL EXCEPT THE SEQUENCE \e ESCAPE KEY (ESC or 0x1B (27) in
        // ASCII) AND NOT SPLITTING HAIRS CHOOSING BETWEEN SEQUENCE \n LINEFEED (LF or
        // 0x0A (10) in ASCII) AND THE SEQUENCE \r CARRIAGE RETURN (CR or 0x0D
        // (13) in ASCII)...AND ALSO SCREW BOTH \f FORM FEED (FF or 0x0C (12)
        // in ASCII) AND \v VERTICAL TAB (VT or 0x0B (11) in ASCII) SEQUENCES.
        // https://www.php.net/manual/en/language.types.string.php#language.types.string.syntax.double
        $token = "";

        if(isset($char_selection) && ($char_selection != -1) && ($char_selection != -2) && ($char_selection != -3)){

            $codeAlphabet = $char_selection;

            $max = strlen($codeAlphabet); // edited

            if(function_exists('random_int')){

                for($i = 0; $i < $len; $i++){

                    $token .= $codeAlphabet[random_int(0, $max - 1)];

                }

            }else{

                for($i = 0; $i < $len; $i++){

                    $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max - 1)];

                }

            }

        }else{

            $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
            $codeAlphabet .= "0123456789";

            if($char_selection == -1){

                $codeAlphabet .= "{}[]:;\"\'|\\+=_- )(*&^%$#@!~
                `?/>.<,   '";

            }

            if($char_selection == -2){

                $codeAlphabet .= "{}[]:|\\+=_- )(*&%$#@!~?/.,";

            }

            //
            // ADD EXCLUSION TO -3 ABOVE WHEN CHECKING FOR $char_selection
            if($char_selection == -3){

                $codeAlphabet .= ":+=_- )(*$#@!~.";

            }

            $max = strlen($codeAlphabet); // edited

            if(function_exists('random_int')){

                for($i = 0; $i < $len; $i++){

                    $token .= $codeAlphabet[random_int(0, $max - 1)];

                }

            }else{

                for($i = 0; $i < $len; $i++){

                    $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max - 1)];

                }

            }

        }

        return $token;

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resource_key The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    //
    // SOURCE :: https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string
    // COMMENT :: https://stackoverflow.com/a/13733588
    // AUTHOR :: Scott :: https://stackoverflow.com/users/1698153/scott
    // AUTHOR :: christophe dot weis at statec dot etat dot lu :: https://www.php.net/manual/en/function.openssl-random-pseudo-bytes.php#104322
    private function crypto_rand_secure($min, $max){

        $range = $max - $min;
        if($range < 1) return $min; // not so random...

        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1

        do{

            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits

        }while($rnd > $range);

        return $min + $rnd;

    }

    public function __destruct(){


    }

}