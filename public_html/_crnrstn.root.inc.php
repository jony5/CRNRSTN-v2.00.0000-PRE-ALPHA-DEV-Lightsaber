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
if ( ! session_id() ) @ session_start();
$CRNRSTN_ROOT_OFFSET = '';
@define('CRNRSTN_ROOT', crnrstn_root_dir_shift($CRNRSTN_ROOT_OFFSET));


function crnrstn_root_dir_shift($dir_offset){

    $tmp_root_dir_output_ARRAY = array();
    $tmp_shift_ARRAY = explode('..', $dir_offset);
    $tmp_shift_cnt = count($tmp_shift_ARRAY);
    $tmp_current_dir_path = dirname( __FILE__ );
    $tmp_dir_ARRAY = explode(DIRECTORY_SEPARATOR, $tmp_current_dir_path);
    $tmp_dir_ARRAY = array_reverse($tmp_dir_ARRAY);

    //error_log(__LINE__ . ' CURR dir = [' . print_r($tmp_dir_ARRAY, true) . ']');
    $tmp_curr_shift_cnt = 1;
    foreach($tmp_dir_ARRAY as $dir_index => $dir_val){

        if($tmp_curr_shift_cnt >= $tmp_shift_cnt){

            $tmp_root_dir_output_ARRAY[] = $dir_val;

        }

        $tmp_curr_shift_cnt++;

    }

    $tmp_root_dir_output_ARRAY = array_reverse($tmp_root_dir_output_ARRAY);
    //error_log(__LINE__ . ' ROOT dir = [' . print_r($tmp_root_dir_output_ARRAY, true) . ']');

    return implode(DIRECTORY_SEPARATOR, $tmp_root_dir_output_ARRAY);

}