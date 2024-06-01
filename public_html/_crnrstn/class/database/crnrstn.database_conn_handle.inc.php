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
#  CLASS :: crnrstn_database_conn_handle
#  VERSION :: 1.00.0000
#  DATE :: July 13, 2020 @ 0705 hrs.
#  AUTHOR :: Jonathan '5' Harris, jharris@eVifweb.com, eVifweb@gmail.com.
#  URI :: http://eVifweb.jony5.com
#  DESCRIPTION :: Get a handle on database connections.
#  LICENSE :: MIT | https://crnrstn.jony5.com/licensing/
#
class crnrstn_database_conn_handle {

    public $oCRNRSTN_USR;

    protected $connection_serial;
    public $oConnection;

    public $version_mysqli;

    public function __construct($oCRNRSTN_USR){

        try{

            if(isset($oCRNRSTN_USR)){

                $this->oCRNRSTN_USR = $oCRNRSTN_USR;

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('oCRNRSTN_USR is a required parameter for crnrstn_mysqli_handle :: __construct().');

            }

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function load_connection_serial($tmp_mysqli_serial){

        $this->connection_serial = $tmp_mysqli_serial;

    }

    public function load_connection_obj($mysqli){

        $this->oConnection = $mysqli;

        if(is_object($this->oConnection)){

            $version = explode('.', $this->oConnection->server_info);
            $patch = '';

            $tmp_array = str_split($version[2]);

            $tmp_size = sizeof($tmp_array);

            for($i = 0; $i < $tmp_size; $i++){

                if(is_numeric($tmp_array[$i])){

                    $patch .= $tmp_array[$i];

                }else{

                    $i = $tmp_size + 1;

                }

            }

            if(strlen($patch) > 0){

                $tmp_version_mysqli = $version[0].'.' . $version[1].'.' . $patch;
                $this->oCRNRSTN_USR->input_data_value_simple($tmp_version_mysqli, 'version_mysqli');

            }else{

                $tmp_version_mysqli = $version[0].'.' . $version[1];
                $this->oCRNRSTN_USR->input_data_value_simple($tmp_version_mysqli, 'version_mysqli');

            }

        }

        return false;

        //
        // SELECT MYSQLI SETTINGS

        /*
        /* Properties
        int $affected_rows;
        static int $connect_errno;
        static string $connect_error;
        int $errno;
        array $error_list;
        string $error;
        int $field_count;
        string $client_info;
        int $client_version;
        string $host_info;
        string $protocol_version;
        string $server_info;
        int $server_version;
        string $info;
        mixed $insert_id;
        string $sqlstate;
        int $thread_id;
        int $warning_count;


        mysqli_stat() returns a string containing information similar to that provided by the 'mysqladmin status' command. This includes uptime in seconds and the number of running threads, questions, reloads, and open tables.
        Here is an explanation of the values that appear in connection->stat() returned string. It was taken from Ai Hua's April 29, 2006 answer on http://forums.mysql.com/read.php?12,86570,86570.

        Uptime--The number of seconds the MySQL server has been running.

        Threads--The number of active threads (clients).

        Questions--The number of questions (queries) from clients since the server was started.

        Slow queries--The number of queries that have taken more than long_query_time seconds.

        Opens--The number of tables the server has opened.

        Flush tables--The number of flush-*, refresh, and reload commands the server has executed.

        Open tables--The number of tables that currently are open.

        Queries per second avg--Questions divided by Uptime


        mysqli_get_connection_stats($link)
        Don't forget that "mysqlnd.collect_statistics" must be set to "1" in your ini config to use this method.
        print_r(mysqli_get_connection_stats($link));
        ...or...
        $result = $mysqli->query('SHOW SESSION STATUS;', MYSQLI_USE_RESULT);
        while ($row = $result->fetch_assoc()){
            $array[$row['Variable_name']] = $row['Value'];
        }
        $result->close();
        print_r($array);

        printf("Client library version: %s\n", mysqli_get_client_info());

        */

    }

    public function return_conn_object($type = 'mysqli'){

        try{

            if(isset($this->oConnection)){

                return $this->oConnection;

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('MYSQLI database connection object not set. Unable to return on server ' . $_SERVER['SERVER_NAME'].' (' . $_SERVER['SERVER_ADDR'].').');

            }


        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function returnConnSerial(){

        try{

            if(isset($this->connection_serial)){

                return $this->connection_serial;

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('MYSQLI database connection object serialization is not set. Unable to return serial for connection on server ' . $_SERVER['SERVER_NAME'].' (' . $_SERVER['SERVER_ADDR'].').');

            }


        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function __destruct(){

    }

}