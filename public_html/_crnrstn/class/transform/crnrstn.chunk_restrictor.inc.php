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
#  CLASS :: crnrstn_chunk_restrictor
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  VERSION :: 1.00.0000
#  DATE :: October 23, 2020 @ 0747hrs
#  DESCRIPTION :: Break a string into target size
#                 chunks, brutally.
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

        $this->oLogger = new crnrstn_logging(__CLASS__, self::$oCRNRSTN_ENV);

        $this->chunk_hash = self::$oCRNRSTN_ENV->hash($page_content);
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
            $this->chunk_HTML_line_out_ARRAY[$this->chunk_hash][] = '<br>' . $tmp_line;
            $this->chunk_TEXT_line_out_ARRAY[$this->chunk_hash][] = '
' . $tmp_line;

        }else{

            $this->chunk_line_out_ARRAY[$this->chunk_hash][] = $tmp_line;
            $this->chunk_HTML_line_out_ARRAY[$this->chunk_hash][] = '<br>...' . $tmp_line;
            $this->chunk_TEXT_line_out_ARRAY[$this->chunk_hash][] = '
   ' . $tmp_line;

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

    public function __destruct(){


    }

}