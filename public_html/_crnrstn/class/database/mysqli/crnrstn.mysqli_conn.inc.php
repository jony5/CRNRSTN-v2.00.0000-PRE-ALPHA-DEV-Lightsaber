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
#         AUTHOR :: Jonathan 'J5' Harris, CEO, CTO, Lead Full Stack Developer.
#            URI :: http://crnrstn.evifweb.com/
#       OVERVIEW :: CRNRSTN :: An Open Source PHP Class Library that stands on top of a robust web services oriented
#                   architecture to both facilitate, augment, and enhance (with stability) the operations of a code base
#                   for a web application across multiple hosting environments.
#
#                   Copyright (C) 2012-2023 eVifweb development.
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
#                   For example, stand on top of the CRNRSTN :: SOAP services layer to organize and strengthen the
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
#  CLASS :: crnrstn_mysqli_conn
#  VERSION :: 2.00.0000
#  DATE :: September 11, 2012 @ 1720hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: A MySQLi database connection.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_mysqli_conn {

    private static $db_host;                // = $host;
    private static $db_db;                  // = $dbname;
    private static $db_un;                  // = $un;
    private static $db_pwd;                 // = $pwd;
    private static $db_port;                // = $port;
    private static $mysqli;

    //public $oSESSION_MGR;
    public $result;

    protected $oLogger;
    public $oCRNRSTN_USR;

    public function __construct($host, $un, $pwd, $db, $port = NULL, $oCRNRSTN_USR = NULL){

        $this->oCRNRSTN_USR = $oCRNRSTN_USR;

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN_USR);

        self::$db_host 		= $host;
        self::$db_db	 	= $db;
        self::$db_un 		= $un;
        self::$db_pwd 		= $pwd;
        self::$db_port 		= (int) $port;

    }

    public function connReturn(){

        //
        // ESTABLISH AND RETURN MYSQLI CONNECTION.
        //
        // http://172.16.225.139/phpmyadmin/doc/html/config.html#server-connection-settings
        // Note If you use localhost as the hostname, MySQL ignores this port number
        // and connects with the socket, so if you want to connect to a port
        // different from the default port, use 127.0.0.1 or the real hostname
        // in $cfg['Servers'][$i]['host'].
        //
        // Thursday, July 20, 2023 @ 1210 hrs
        //
        try{

            if(self::$db_port != ''){

                self::$mysqli = new mysqli(self::$db_host, self::$db_un, self::$db_pwd, self::$db_db, self::$db_port);

            }else{

                self::$mysqli = new mysqli(self::$db_host, self::$db_un, self::$db_pwd, self::$db_db);

            }

            if(self::$mysqli->connect_error){

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('CRNRSTN :: mysqli connection error :: failed to connect to MySQL: (' . self::$mysqli->connect_errno . ') ' . self::$mysqli->connect_error.' on server ' . $_SERVER['SERVER_NAME'].' (' . $_SERVER['SERVER_ADDR'].').');

            }

            return self::$mysqli;

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE.
            return false;

        }

    }

    public function __destruct(){

    }

}