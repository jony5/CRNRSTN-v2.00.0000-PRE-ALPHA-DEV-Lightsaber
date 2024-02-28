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
#  CLASS :: crnrstn_chunk_restrictor
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  VERSION :: 1.00.0000
#  DATE :: October 23, 2020 @ 0747hrs
#  DESCRIPTION :: Break a string into target size
#                 chunks, brutally.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_chunk_restrictor {

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