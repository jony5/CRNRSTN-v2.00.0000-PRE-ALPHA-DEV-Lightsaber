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
#  CLASS :: crnrstn_lightning_bolt
#  VERSION :: 1.00.0000
#  DATE :: September 13, 2020 @ 0806hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: A meta-data wrangler object for an Electrum :: configured
#                 endpoint that CRNRSTN :: knows a thing or two about.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#  Ezekiel 1:14 - AND THE LIVING CREATURES RAN TO AND FRO LIKE THE
#                 APPEARANCE OF A LIGHTNING BOLT.
#
class crnrstn_lightning_bolt {

    public $oCRNRSTN_USR;

    protected $timestamp_nom_pattern;
    protected $timestamp_nom = '';
    protected $flow_type;
    protected $connection_type;
    protected $data_type;
    protected $flatten_all_files = false;

    protected $ftp_dir_path;
    protected $local_dir_path;
    protected $ftp_oWCR_key;
    protected $local_oWCR_key;
    protected $ftp_mkdir_mode;
    protected $local_mkdir_mode;

    protected $start_time_micro;
    protected $start_time_timestamp;
    protected $elapsed_time_at_start;
    protected $byte_capacity_destination;
    protected $byte_hardDiskSize_destination;

    protected $serial;
    public $connection_status = 'new';
    public $connection_status_log = array();
    public $asset_transfer_suppression_ARRAY = array();

    public function __construct($serial, $oCRNRSTN_USR){

        $this->start_time_micro = $oCRNRSTN_USR->return_micro_time();
        $this->start_time_timestamp = $oCRNRSTN_USR->return_query_date_time_stamp();
        $this->elapsed_time_at_start = $oCRNRSTN_USR->wall_time();

        $this->oCRNRSTN_USR = $oCRNRSTN_USR;

        $this->serial = $serial;

    }

    public function return_flow_type(){

        return $this->flow_type;

    }

    public function return_flatten_all_files(){

        return $this->flatten_all_files;

    }

    public function return_hardDriveSize(){

        $tmp_connection_type = $this->return_connection_type();

        switch($tmp_connection_type){
            case 'FTP':
                //
                // NO FTP SUPPORT FOR THIS FUNCTIONALITY
                $this->byte_hardDiskSize_destination = NULL;

            break;
            default:

                $tmp_dirPath = $this->return_LOCAL_DIR_PATH();
                $this->byte_hardDiskSize_destination = disk_total_space($tmp_dirPath);

            break;

        }

        return $this->byte_hardDiskSize_destination;

    }

    public function return_availableByteCapacity(){

        $tmp_connection_type = $this->return_connection_type();

        switch($tmp_connection_type){
            case 'FTP':
                //
                // NO FTP SUPPORT FOR THIS FUNCTIONALITY
                $this->byte_capacity_destination = NULL;

            break;
            default:
                $tmp_dirPath = $this->return_LOCAL_DIR_PATH();
                $this->byte_capacity_destination = disk_free_space($tmp_dirPath);

            break;

        }

        return $this->byte_capacity_destination;

    }

    public function return_timestamp_nom(){

        return $this->timestamp_nom;

    }

    public function add_directory_nom_pattern($pattern){

        #$this->save_data_param('TIMESTAMP_NOM', date("Ymd_H-i-s", time()))
        $this->timestamp_nom_pattern = $pattern;

        if(!($this->timestamp_nom = date($this->timestamp_nom_pattern, time()))){

            $this->timestamp_nom = date('Ymd_H_i_s', time());

        }

    }

    public function return_FTP_SERVER(){

        return $this->oCRNRSTN_USR->get_resource('FTP_SERVER', $this->ftp_oWCR_key);

    }

    public function return_FTP_USERNAME(){

        return $this->oCRNRSTN_USR->get_resource('FTP_USERNAME', $this->ftp_oWCR_key);

    }

    public function return_FTP_PASSWORD(){

        return $this->oCRNRSTN_USR->get_resource('FTP_PASSWORD', $this->ftp_oWCR_key);

    }

    public function return_FTP_PORT(){

        return $this->oCRNRSTN_USR->get_resource('FTP_PORT', $this->ftp_oWCR_key);

    }

    public function return_FTP_TIMEOUT(){

        return $this->oCRNRSTN_USR->get_resource('FTP_TIMEOUT', $this->ftp_oWCR_key);

    }

    public function return_FTP_IS_SSL(){

        return $this->oCRNRSTN_USR->get_resource('FTP_IS_SSL', $this->ftp_oWCR_key);

    }

    public function return_FTP_USE_PASV(){

        return $this->oCRNRSTN_USR->get_resource('FTP_USE_PASV', $this->ftp_oWCR_key);

    }

    public function return_FTP_USE_PASV_ADDR(){

        return $this->oCRNRSTN_USR->get_resource('FTP_USE_PASV_ADDR', $this->ftp_oWCR_key);

    }

    public function return_FTP_DISABLE_AUTOSEEK(){

        return $this->oCRNRSTN_USR->get_resource('FTP_DISABLE_AUTOSEEK', $this->ftp_oWCR_key);

    }

    public function return_FTP_DIR_PATH(){

        return $this->oCRNRSTN_USR->get_resource('FTP_DIR_PATH', $this->ftp_oWCR_key);

    }

    public function return_FTP_MKDIR_MODE(){

        if($this->ftp_mkdir_mode!=''){

            return $this->ftp_mkdir_mode;

        }else{

            if($this->flow_type!='SOURCE'){

                $this->ftp_mkdir_mode = $this->oCRNRSTN_USR->get_resource('FTP_MKDIR_MODE', $this->ftp_oWCR_key);

            }else{

                $this->ftp_mkdir_mode = NULL;

            }

        }

        return $this->ftp_mkdir_mode;

    }

    public function return_LOCAL_DIR_PATH(){

        return $this->SOURCE_LOCAL_DIR_PATH;

    }

    public function return_LOCAL_MKDIR_MODE(){

        if($this->flow_type!='SOURCE'){

            if(isset($this->local_mkdir_mode)){

                return $this->local_mkdir_mode;

            }else{

                $this->local_mkdir_mode = NULL;

            }

        }else{

            $this->local_mkdir_mode = NULL;
        }

        return $this->local_mkdir_mode;

    }

    public function return_connection_type(){

        return $this->connection_type;

    }

    public function return_serial(){

        return $this->serial;

    }

    public function return_local_oWCR_key(){

        return $this->local_oWCR_key;

    }

    public function return_start_time_micro(){

        return $this->start_time_micro;

    }

    public function return_WCRkey_or_PATH(){

        try{

            if(isset($this->ftp_oWCR_key)){

                return $this->ftp_oWCR_key;

            }else{

                if(isset($this->local_oWCR_key)){

                    return $this->local_oWCR_key;

                }else{

                    if(isset($this->SOURCE_LOCAL_DIR_PATH)){

                        return $this->SOURCE_LOCAL_DIR_PATH;

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('The CRNRSTN :: Electrum endpoint has not been configured correctly.');

                    }
                }

            }

        }catch(Exception $e){

            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE.
            return false;

        }

    }

    public function initialize_sourceLOCAL_meta($dirPath){

        $this->flow_type = 'SOURCE';
        $this->connection_type = 'LOCAL_DIR';
        $this->data_type = 'INPUT_PARAM';

        //
        // INPUT_PARAM
        $this->SOURCE_LOCAL_DIR_PATH = $dirPath;

        $this->log_connection_status('ready');

    }

    public function initialize_source_LOCAL_WCR_meta($WildCardResource_key){

        $this->flow_type = 'SOURCE';
        $this->connection_type = 'LOCAL_DIR';
        $this->data_type = 'CRNRSTN_WCR';

        $this->local_oWCR_key = $WildCardResource_key;

        $this->SOURCE_LOCAL_DIR_PATH = $this->oCRNRSTN_USR->get_resource('LOCAL_DIR_PATH', $this->local_oWCR_key);

        $this->log_connection_status('ready');

    }

    public function initialize_source_FTP_WCR_meta($WildCardResource_key){

        $this->flow_type = 'SOURCE';                    # SOURCE, DESTINATION
        $this->connection_type = 'FTP';
        $this->data_type = 'CRNRSTN_WCR';

        $this->ftp_oWCR_key = $WildCardResource_key;

        $this->ftp_dir_path = $this->oCRNRSTN_USR->get_resource('FTP_DIR_PATH', $this->ftp_oWCR_key);

        $this->log_connection_status('ready');

    }

    public function initialize_destinationLOCAL_meta($tmp_DIR_PATH, $tmp_MKDIR_MODE){

        $this->flow_type = 'DESTINATION';
        $this->connection_type = 'LOCAL_DIR';
        $this->data_type = 'INPUT_PARAM';

        //
        // INPUT_PARAM
        $this->SOURCE_LOCAL_DIR_PATH = $tmp_DIR_PATH;

        if(isset($tmp_MKDIR_MODE)){

            $this->local_mkdir_mode = $tmp_MKDIR_MODE;

        }

        $this->log_connection_status('ready');

    }

    public function initialize_destinationLOCAL_WCR_meta($WildCardResource_key){

        $this->flow_type = 'DESTINATION';
        $this->connection_type = 'LOCAL_DIR';
        $this->data_type = 'CRNRSTN_WCR';

        $this->local_oWCR_key = $WildCardResource_key;

        $this->local_mkdir_mode = $this->oCRNRSTN_USR->get_resource('LOCAL_MKDIR_MODE', $this->local_oWCR_key);

        $this->SOURCE_LOCAL_DIR_PATH = $this->oCRNRSTN_USR->get_resource('LOCAL_DIR_PATH', $this->local_oWCR_key);

        $this->log_connection_status('ready');

    }

    public function initialize_flattenedDestinationLOCAL_meta($tmp_DIR_PATH, $tmp_MKDIR_MODE){

        $this->flatten_all_files = true;
        $this->flow_type = 'DESTINATION';
        $this->connection_type = 'LOCAL_DIR';
        $this->data_type = 'INPUT_PARAM';

        //
        // INPUT_PARAM
        $this->SOURCE_LOCAL_DIR_PATH = $tmp_DIR_PATH;

        if(isset($tmp_MKDIR_MODE)){

            $this->local_mkdir_mode = $tmp_MKDIR_MODE;

        }

        $this->log_connection_status('ready');


    }

    public function initialize_flattenedDestinationLOCAL_WCR_meta($WildCardResource_key){

        $this->flatten_all_files = true;
        $this->flow_type = 'DESTINATION';
        $this->connection_type = 'LOCAL_DIR';
        $this->data_type = 'CRNRSTN_WCR';

        $this->local_oWCR_key = $WildCardResource_key;

        $this->local_mkdir_mode = $this->oCRNRSTN_USR->get_resource('LOCAL_MKDIR_MODE', $this->local_oWCR_key);

        $this->SOURCE_LOCAL_DIR_PATH = $this->oCRNRSTN_USR->get_resource('LOCAL_DIR_PATH', $this->local_oWCR_key);

        $this->log_connection_status('ready');

    }

    public function initialize_destination_FTP_WCR_meta($WildCardResource_key){

        $this->flow_type = 'DESTINATION';
        $this->connection_type = 'FTP';
        $this->data_type = 'CRNRSTN_WCR';

        $this->ftp_oWCR_key = $WildCardResource_key;

        $this->ftp_mkdir_mode = $this->oCRNRSTN_USR->get_resource('FTP_MKDIR_MODE', $this->ftp_oWCR_key);
        $this->oCRNRSTN_USR->error_log('CRNRSTN :: FTP DESTINATION MODE [' . $this->ftp_mkdir_mode.']', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $this->ftp_dir_path = $this->oCRNRSTN_USR->get_resource('FTP_DIR_PATH', $this->ftp_oWCR_key);

        $this->log_connection_status('ready');

    }

    public function initialize_flattenedDestinationFTP_WCR_meta($WildCardResource_key){

        $this->flatten_all_files = true;
        $this->flow_type = 'DESTINATION';
        $this->connection_type = 'FTP';
        $this->data_type = 'CRNRSTN_WCR';

        $this->ftp_oWCR_key = $WildCardResource_key;

        $this->ftp_mkdir_mode = $this->oCRNRSTN_USR->get_resource('FTP_MKDIR_MODE', $this->ftp_oWCR_key);
        $this->oCRNRSTN_USR->error_log('CRNRSTN :: FTP DESTINATION MODE [' . $this->ftp_mkdir_mode.']', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $this->ftp_dir_path = $this->oCRNRSTN_USR->get_resource('FTP_DIR_PATH', $this->ftp_oWCR_key);

        $this->log_connection_status('ready');

    }

    public function log_connection_status($str){

        $this->connection_status = $str;
        $this->connection_status_log[] = $str;
    }

    public function __destruct(){

    }

}