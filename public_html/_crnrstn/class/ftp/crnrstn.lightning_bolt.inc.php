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
#       Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated
#       documentation files (the "Software"), to deal in the Software without restriction, including without limitation
#       the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software,
#       and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
#
#       The above copyright notice and this permission notice shall be included in all copies or substantial portions
#       of the Software.
#
#       THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED
#       TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
#       THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF
#       CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
#       DEALINGS IN THE SOFTWARE.
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

    protected $oLogger;
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

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN_USR);

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