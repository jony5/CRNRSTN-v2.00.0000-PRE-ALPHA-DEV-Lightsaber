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
#  CLASS :: crnrstn_fire_ftp_conn_manager
#  VERSION :: 2.00.0000
#  DATE :: November 10, 2018 @ 1718HRS
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI ::
#  DESCRIPTION :: An SFTP/FTP connection manager.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#  Ezekiel 1:5a - AND FROM THE MIDST OF IT [FIRE] THERE CAME THE LIKENESS OF
#                 FOUR LIVING CREATURES.
#
class crnrstn_fire_ftp_conn_manager {

    protected $oLogger;
    public $oCRNRSTN_USR;

    public $lightning_FTP_conn_ARRAY = array();

    public function __construct($oCRNRSTN_USR){

        $this->oCRNRSTN_USR = $oCRNRSTN_USR;

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN_USR);

        $this->oCRNRSTN_USR->error_log('NEW FOUR LIVING CREATURES INSTANTIATED.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

    }

    private function establishConnection($endpoint_data, $endpoint_id){

        /*
        $oWCR->addAttribute('FTP_SERVER', '172.16.195.132');
        $oWCR->addAttribute('FTP_USERNAME', 'jony5');
        $oWCR->addAttribute('FTP_PASSWORD', 'gY96sb21');
        $oWCR->addAttribute('FTP_PORT', 21);
        $oWCR->addAttribute('FTP_TIMEOUT', 90);
        $oWCR->addAttribute('FTP_IS_SSL', false);
        $oWCR->addAttribute('FTP_USE_PASV', false);
        $oWCR->addAttribute('FTP_USE_PASV_ADDR', false);
        $oWCR->addAttribute('FTP_DISABLE_AUTOSEEK', true);
        $oWCR->addAttribute('FTP_DIR_PATH', '../../var/www/html/_backup_test/');
        */

        $tmp_FTP_SERVER_WCR = $this->oCRNRSTN_USR->get_resource('FTP_SERVER', $endpoint_data);
        $tmp_FTP_USERNAME_WCR = $this->oCRNRSTN_USR->get_resource('FTP_USERNAME', $endpoint_data);
        $tmp_FTP_PASSWORD_WCR = $this->oCRNRSTN_USR->get_resource('FTP_PASSWORD', $endpoint_data);
        $tmp_FTP_PORT_WCR = $this->oCRNRSTN_USR->get_resource('FTP_PORT', $endpoint_data);
        $tmp_FTP_TIMEOUT_WCR = $this->oCRNRSTN_USR->get_resource('FTP_TIMEOUT', $endpoint_data);
        $tmp_FTP_IS_SSL_WCR = $this->oCRNRSTN_USR->get_resource('FTP_IS_SSL', $endpoint_data);
        $tmp_FTP_USE_PASV_WCR = $this->oCRNRSTN_USR->get_resource('FTP_USE_PASV', $endpoint_data);
        $tmp_FTP_USE_PASV_ADDR_WCR = $this->oCRNRSTN_USR->get_resource('FTP_USE_PASV_ADDR', $endpoint_data);
        $tmp_FTP_DISABLE_AUTOSEEK_WCR = $this->oCRNRSTN_USR->get_resource('FTP_DISABLE_AUTOSEEK', $endpoint_data);

        //$tmp_endpoint_id = md5($tmp_FTP_SERVER_WCR.$tmp_FTP_USERNAME_WCR.$tmp_FTP_PASSWORD_WCR.$tmp_FTP_PORT_WCR);

        try{

            // DO WE HAVE EXISTING CONNECTION FOR THIS ENDPOINT
            if(isset($this->lightning_FTP_conn_ARRAY[$endpoint_id])){

                //
                // CONSIDER A PING FOR $oLightning_conn AS IN if($oLightning_conn->conn_ping(ftp_conn)){ Proceed...
                //return $this->lightning_FTP_conn_ARRAY[$tmp_endpoint_serial];
                $this->oCRNRSTN_USR->error_log('FOUR LIVING CREATURES - EXISTING CONN ALREADY.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                //return $tmp_endpoint_serial;

            }else{

                /*
                 *
                // CONFIRM THAT THERE ARE NOT TOO MANY FTP CONNECTIONS ALREADY
                //if($this->too_many_connections($endpoint_id, $oElectrum, $oDATA, $oDB_RESP)){
                //    $this->transaction_status = 'Too many active connections to this endpoint. Connection attempt suppressed.';
                //    return false;
                }*/

                $oLightning_conn = new crnrstn_lightning_ftp_conn($this->oCRNRSTN_USR);
                $oLightning_conn->save_connection_datum($tmp_FTP_SERVER_WCR, $tmp_FTP_USERNAME_WCR, $tmp_FTP_PASSWORD_WCR, $tmp_FTP_PORT_WCR, $tmp_FTP_TIMEOUT_WCR);

                if($tmp_FTP_IS_SSL_WCR){

                    $oLightning_conn->enable_ssl(true);

                }

                $oLightning_conn->establish_connection();

                if($tmp_FTP_USE_PASV_WCR){

                    $oLightning_conn->enable_passive(true);         // CALL AFTER establish_connection()

                    if(!$tmp_FTP_USE_PASV_ADDR_WCR){

                        $oLightning_conn->set_option(FTP_USEPASVADDRESS, false);        # ENABLED BY DEFAULT

                    }
                }

                if($tmp_FTP_DISABLE_AUTOSEEK_WCR){

                    $oLightning_conn->set_option(FTP_AUTOSEEK, false);                  # ENABLED BY DEFAULT

                }

                //$this->lightning_FTP_conn_ARRAY[$tmp_endpoint_serial] = $oLightning_conn->return_ftp_stream();
                $this->lightning_FTP_conn_ARRAY[$endpoint_id] = $oLightning_conn;


            }

        }catch(Exception $e){

            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function return_lightningFTPConn($endpoint_serial){

        return $this->lightning_FTP_conn_ARRAY[$endpoint_serial];

    }

    public function initialize_ftp_endpoint($flow_type, $endpoint_data, $endpoint_id){

        try{

            //
            // FOR THIS END POINT.
            # PERFORM GENERIC CONNECTION OPEN PROTOCOLS
            $this->establishConnection($endpoint_data, $endpoint_id);

            # IF CONNECTION ESTABLISHED, FOR SOURCE...CAN I READ ACCESS?
            if(!isset($this->lightning_FTP_conn_ARRAY[$endpoint_id])){
                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to establish FTP connection.');

            }else{

                // AM I SOURCE OR DESTINATION
                switch($flow_type){
                    case 'SOURCE':

                        $tmp_read_permissions = false;
                        $tmp_FTP_DIR_PATH_WCR = $this->oCRNRSTN_USR->get_resource('FTP_DIR_PATH', $endpoint_data);
                        $tmp_FTP_SERVER_WCR = $this->oCRNRSTN_USR->get_resource('FTP_SERVER', $endpoint_data);

                        //
                        // WE HAVE ESTABLISHED A VALID FTP CONN TO A SOURCE
                        // JUST VERIFY THAT YOU CAN READ.
                        $oLightning_ftp_conn =  $this->lightning_FTP_conn_ARRAY[$endpoint_id];
                        $tmp_ftp_conn = $oLightning_ftp_conn->return_ftp_stream();
                        $tmp_config_serial = $this->oCRNRSTN_USR->get_server_config_serial();

                        $_SESSION['CRNRSTN_' . $this->oCRNRSTN_USR->crcINT($tmp_config_serial)]['CRNRSTN_EXCEPTION_PREFIX'] = 'The CRNRSTN :: Electrum process has experienced permissions related error as the ' . $tmp_FTP_SERVER_WCR.' SOURCE FTP directory, ' . $tmp_FTP_DIR_PATH_WCR.', is NOT readable by ftp_nlist() ';
                        $endpoint_contents = ftp_nlist($tmp_ftp_conn, $tmp_FTP_DIR_PATH_WCR);
                        $_SESSION['CRNRSTN_' . $this->oCRNRSTN_USR->crcINT($tmp_config_serial)]['CRNRSTN_EXCEPTION_PREFIX'] = '';

                        if($endpoint_contents){
                            $tmp_read_permissions = true;

                        }

                        if($tmp_read_permissions){

                            //$this->oCRNRSTN_USR->error_log('Electrum FTP SUCCESS ON READ PERMISSIONS!', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                            $oLightning_ftp_conn->isValid = true;
                            $this->lightning_FTP_conn_ARRAY[$endpoint_id] = $oLightning_ftp_conn;

                            return true;

                        }else{

                            $tmp_FTP_SERVER_WCR = $this->oCRNRSTN_USR->get_resource('FTP_SERVER', $endpoint_data);
                            $tmp_FTP_USERNAME_WCR = $this->oCRNRSTN_USR->get_resource('FTP_USERNAME', $endpoint_data);
                            $tmp_FTP_PORT_WCR = $this->oCRNRSTN_USR->get_resource('FTP_PORT', $endpoint_data);

                            $oLightning_ftp_conn->isValid = false;
                            $this->lightning_FTP_conn_ARRAY[$endpoint_id] = $oLightning_ftp_conn;

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('Unable to read [' . $tmp_FTP_DIR_PATH_WCR.'] from FTP endpoint ' . $tmp_FTP_SERVER_WCR.'::' . $tmp_FTP_USERNAME_WCR.' on port ' . $tmp_FTP_PORT_WCR.'.');

                        }

                    break;
                    default:
                        //
                        // DESTINATION FTP
                        $this->oCRNRSTN_USR->error_log('TODO :: Consider FTP destination preload integrity validation check...', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);
                        $oLightning_ftp_conn =  $this->lightning_FTP_conn_ARRAY[$endpoint_id];
                        $oLightning_ftp_conn->isValid = true;
                        $this->lightning_FTP_conn_ARRAY[$endpoint_id] = $oLightning_ftp_conn;

                        return true;

                    break;

                }

            }

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function __destruct() {

    }

}