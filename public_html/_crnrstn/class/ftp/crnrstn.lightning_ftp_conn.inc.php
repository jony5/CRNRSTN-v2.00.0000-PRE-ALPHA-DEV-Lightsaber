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
#  CLASS :: crnrstn_lightning_ftp_conn
#  VERSION :: 2.00.0000
#  DATE :: November 10, 2018 @ 1730 hrs.
#  AUTHOR :: Jonathan '5' Harris, jharris@eVifweb.com, eVifweb@gmail.com.
#  URI :: http://eVifweb.jony5.com
#  DESCRIPTION :: An SFTP/FTP connection.
#  LICENSE :: MIT | https://crnrstn.jony5.com/licensing/
#  Ezekiel 1:13b - AND THE FIRE WAS BRIGHT; AND OUT OF THE FIRE WENT
#                  FORTH LIGHTENING.
#
class crnrstn_lightning_ftp_conn {

    public $oCRNRSTN_USR;

    protected $ftp_server;
    protected $ftp_username;
    protected $ftp_password;
    protected $ftp_port;
    protected $ftp_timeout;

    protected $ftp_is_ssl=false;

    protected $ftp_conn_id;
    protected $ftp_login_result;
    public $isValid = false;
    public $connection_status = 'new';
    public $connection_status_log = array();
    protected $start_time_micro;
    protected $start_time_timestamp;
    protected $elapsed_time_at_start;

    public function __construct($oCRNRSTN_USR){

        $this->oCRNRSTN_USR = $oCRNRSTN_USR;

        $this->start_time_micro = $this->oCRNRSTN_USR->return_micro_time();
        $this->start_time_timestamp = $this->oCRNRSTN_USR->return_query_date_time_stamp();
        $this->elapsed_time_at_start = $this->oCRNRSTN_USR->wall_time();

    }

    public function return_start_time_timestamp(){

        return $this->start_time_timestamp;

    }

    public function return_elapsed_time_at_start(){

        return $this->elapsed_time_at_start;

    }

    public function return_start_time_micro(){

        return $this->start_time_micro;

    }

    public function return_ftp_stream(){

        return $this->ftp_conn_id;

    }

    public function set_option($option, $value){
        /*
         * FTP_TIMEOUT_SEC
         * FTP_AUTOSEEK
         * FTP_USEPASVADDRESS
         * */

        try{
            if(!ftp_set_option($this->ftp_conn_id, $option, $value)){

                $this->log_connection_status('error :: setting option [' . $option.'] to value [' . $value.']');

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('An error was experienced while setting option [' . $option.'] to value [' . $value.'] for ftp connection with ' . $this->ftp_server.' at ' . $this->ftp_port.'.');

            }

        }catch(Exception $e){

            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        return NULL;

    }

    public function save_connection_datum($FTP_SERVER_WCR, $FTP_USERNAME_WCR, $FTP_PASSWORD_WCR, $FTP_PORT_WCR, $FTP_TIMEOUT_WCR){

        $this->ftp_server = $FTP_SERVER_WCR;
        $this->ftp_username = $FTP_USERNAME_WCR;
        $this->ftp_password = $FTP_PASSWORD_WCR;
        $this->ftp_port = $FTP_PORT_WCR;
        $this->ftp_timeout = $FTP_TIMEOUT_WCR;

    }

    public function enable_ssl($FTP_IS_SSL_WCR){

        $this->ftp_is_ssl = $FTP_IS_SSL_WCR;

    }

    public function establish_connection(){
        $this->oCRNRSTN_USR->error_log('Electrum ESTABLISHING FTP CONNECTION.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        //
        // ESTABLISH AND RETURN FTP CONNECTION
        try{

            $tmp_option = ' ';

            if($this->ftp_is_ssl){
                $this->oCRNRSTN_USR->error_log('SSL CONNECT.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                $this->ftp_conn_id = ftp_ssl_connect($this->ftp_server, $this->ftp_port, $this->ftp_timeout);

            }else{
                $this->oCRNRSTN_USR->error_log('NON-SSL CONNECT.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                $this->ftp_conn_id = ftp_connect ($this->ftp_server, $this->ftp_port, $this->ftp_timeout);

            }

            if(!$this->ftp_conn_id){

                if($this->ftp_is_ssl){

                    $tmp_option = ' secure ';
                }

                $this->log_connection_status('error :: connection initialization');

                $this->oCRNRSTN_USR->error_log('CONNECTION ERROR.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('An error was experienced while attempting to open a' . $tmp_option.'FTP connection with ' . $this->ftp_server.' at ' . $this->ftp_port.'.');

            }else{

                $this->ftp_login_result = ftp_login($this->ftp_conn_id, $this->ftp_username, $this->ftp_password);

                if(!$this->ftp_login_result){
                    $this->oCRNRSTN_USR->error_log('LOGIN ERROR.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                    $this->log_connection_status('error :: connection login authorization');

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('An error was experienced while attempting to log into an open' . $tmp_option.'FTP connection with ' . $this->ftp_server.'::' . $this->ftp_username.' at ' . $this->ftp_port.'.');

                }else{

                    $this->start_time_micro = $this->oCRNRSTN_USR->return_micro_time();
                    $this->start_time_timestamp = $this->oCRNRSTN_USR->return_query_date_time_stamp();
                    $this->elapsed_time_at_start = $this->oCRNRSTN_USR->wall_time();

                    $this->log_connection_status('ready');

                    $this->oCRNRSTN_USR->error_log('Electrum FTP CONNECTION SUCCESS for ' . $this->ftp_username.'!', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                }

            }

        }catch(Exception $e){

            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE.
            return false;
        }

        return NULL;

    }

    public function enable_passive($is_passive=false){

        try{

            //
            // TURN ON PASSIVE MODE
            if(!ftp_pasv($this->ftp_conn_id, $is_passive)){

                $this->log_connection_status('error :: enabling passive mode');

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('An error was experienced while enabling passive mode for ftp connection with ' . $this->ftp_server.' at ' . $this->ftp_port.'.');

            }

        }catch(Exception $e){

            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

        return NULL;

    }

    public function log_connection_status($str){

        $this->connection_status = $str;
        $this->connection_status_log[] = $str;

    }

    public function __destruct() {

    }

}