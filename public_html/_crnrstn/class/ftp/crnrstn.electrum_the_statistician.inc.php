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
#  CLASS :: crnrstn_electrum_the_statistician
#  VERSION :: 1.00.0000
#  DATE :: October 12, 2020 @ 1520hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI ::
#  DESCRIPTION :: Brought in at the end...to keep things nice and tidy for the
#                 purpose of email reporting notifications.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#  Ezekiel 1:12 - AND EACH WENT STRAIGHT FORWARD; WHEREVER THE SPIRIT WAS TO GO,
#                 THEY WENT; THEY DID NOT TURN AS THEY WENT.
#
class crnrstn_electrum_the_statistician {

    protected $oLogger;
    public $oCRNRSTN_USR;

    protected $electrum_process_id;
    protected $execution_batch_serial;
    protected $startTime;
    protected $timestamp_versioning_pattern;
    protected $timestamp_nom_ARRAY = array();
    protected $content_only_path_to_destination = false;

    protected $source_endpoint_isValid_ARRAY = array();
    protected $source_endpoint_protocol_ARRAY = array();
    protected $source_endpoint_stats_serial_ARRAY = array();
    protected $source_endpoint_stats_pathindex_ARRAY = array();
    protected $source_endpoint_stats_path_serialindex_ARRAY = array();
    protected $source_endpoint_serial_ARRAY = array();
    protected $source_endpoint_id_ARRAY = array();
    protected $source_endpoint_perms_ARRAY = array();
    protected $source_endpoint_err_reason_ARRAY = array();
    protected $source_endpoint_ftp_server_ARRAY = array();
    protected $source_endpoint_ftp_port_ARRAY = array();

    protected $destination_endpoint_stats_serial_ARRAY = array();
    protected $destination_endpoint_stats_pathindex_ARRAY = array();
    protected $destination_endpoint_stats_path_serialindex_ARRAY = array();
    protected $destination_endpoint_isValid_ARRAY = array();
    protected $destination_endpoint_protocol_ARRAY = array();
    protected $destination_endpoint_serial_ARRAY = array();
    protected $destination_endpoint_id_ARRAY = array();
    protected $destination_endpoint_ftp_server_ARRAY = array();
    protected $destination_endpoint_ftp_port_ARRAY = array();
    protected $destination_endpoint_perms_ARRAY = array();
    protected $destination_endpoint_mkdir_mode_ARRAY = array();
    protected $destination_endpoint_err_reason_ARRAY = array();
    protected $destination_endpoint_isFlatFile_ARRAY = array();

    protected $transfer_success_count_ARRAY = array();
    protected $filesize_success_count_ARRAY = array();

    protected $custom_folder_name;

    public function __construct($oCRNRSTN_USR){

        $this->oCRNRSTN_USR = $oCRNRSTN_USR;

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN_USR);

    }

    public function init_directory_datestamp_nom($oEndpoint_serial, $ts_nom){

        $this->timestamp_nom_ARRAY[$oEndpoint_serial] = $ts_nom;

    }

    public function copyFilesToFolder($custom_folder_name){

        $this->custom_folder_name = $custom_folder_name;

    }

    public function return_FD_destination_stats_array($oEndpoint_serial_SOURCE, $oEndpoint_serial_DESTINATION, $SOURCE_filePath=NULL){

        # $ftp_root_dir_path
        # $tmp_mksubdir_destination_path
        # $target_destination_file_path

        $tmp_ARRAY = array();

        //
        // GET DESTINATION ENDPOINT STATS DATA
        foreach($this->destination_endpoint_stats_serial_ARRAY as $key_dest => $destination_stats_serial){

            if($oEndpoint_serial_DESTINATION == $this->destination_endpoint_serial_ARRAY[$destination_stats_serial]){

                //
                // LOCAL_DIR
                $destination_is_flat_file = $this->destination_endpoint_isFlatFile_ARRAY[$destination_stats_serial];
                $destination_isValid = $this->destination_endpoint_isValid_ARRAY[$destination_stats_serial];
                $destination_protocol = $this->destination_endpoint_protocol_ARRAY[$destination_stats_serial];
                $destination_oEndpoint_serial = $this->destination_endpoint_serial_ARRAY[$destination_stats_serial];
                $destination_oEndpoint_id = $this->destination_endpoint_id_ARRAY[$destination_stats_serial];
                $destination_current_perms = $this->destination_endpoint_perms_ARRAY[$destination_stats_serial];
                $destination_MKDIR_MODE = $this->destination_endpoint_mkdir_mode_ARRAY[$destination_stats_serial];
                $destination_DIR_PATH = $this->destination_endpoint_stats_path_serialindex_ARRAY[$destination_stats_serial];

            }

        }

        $tmp_ARRAY['DESTINATION_FILEPATH'] = $this->return_destination_stats_path($oEndpoint_serial_SOURCE, $oEndpoint_serial_DESTINATION);

        if($tmp_slashChar = $this->return_slashChar($tmp_ARRAY['DESTINATION_FILEPATH'])){

            $tmp_ARRAY['DESTINATION_FILEPATH'] = rtrim($tmp_ARRAY['DESTINATION_FILEPATH'], $tmp_slashChar). $tmp_slashChar;

            $tmp_chop_ARRAY = explode($tmp_slashChar, $tmp_ARRAY['DESTINATION_FILEPATH']);
            $tmp_node_cnt = sizeof($tmp_chop_ARRAY);

            //$this->oCRNRSTN_USR->error_log('oWheel :: We want to get target path['.$target_destination_file_path.'] starting from => '.$tmp_ARRAY[$tmp_node_cnt-2], __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

            $tmp_destination_node_ARRAY = explode($tmp_chop_ARRAY[$tmp_node_cnt-2], $SOURCE_filePath);

            $tmp_mksubdir_destination_path = dirname($tmp_destination_node_ARRAY[1]);

        }else{

            $tmp_mksubdir_destination_path = dirname($tmp_ARRAY['DESTINATION_FILEPATH']);

        }

        $tmp_ARRAY['DIR_PATH'] = $destination_DIR_PATH;
        $tmp_ARRAY['MKSUB_DIR'] = $tmp_mksubdir_destination_path;

        return $tmp_ARRAY;

    }

    public function return_DF_destination_stats_array($oEndpoint_serial_SOURCE, $oEndpoint_serial_DESTINATION, $SOURCE_filepath){

        # $ftp_root_dir_path
        # $tmp_mksubdir_destination_path
        # $target_destination_file_path
        # $target_destination_dir_path

        $tmp_ARRAY = array();

        //
        // GET DESTINATION ENDPOINT STATS DATA
        foreach($this->destination_endpoint_stats_serial_ARRAY as $key_dest => $destination_stats_serial){

            if($oEndpoint_serial_DESTINATION == $this->destination_endpoint_serial_ARRAY[$destination_stats_serial]){

                //
                // FTP
                $destination_is_flat_file = $this->destination_endpoint_isFlatFile_ARRAY[$destination_stats_serial];
                $destination_isValid = $this->destination_endpoint_isValid_ARRAY[$destination_stats_serial];
                $destination_protocol = $this->destination_endpoint_protocol_ARRAY[$destination_stats_serial];
                $destination_oEndpoint_serial = $this->destination_endpoint_serial_ARRAY[$destination_stats_serial];
                $destination_oEndpoint_id = $this->destination_endpoint_id_ARRAY[$destination_stats_serial];
                $destination_FTP_SERVER = $this->destination_endpoint_ftp_server_ARRAY[$destination_stats_serial];
                $destination_FTP_PORT = $this->destination_endpoint_ftp_port_ARRAY[$destination_stats_serial];
                $destination_FTP_DIR_PATH = $this->destination_endpoint_stats_path_serialindex_ARRAY[$destination_stats_serial];

            }

        }

        $tmp_ARRAY['DESTINATION_FILEPATH'] = $this->return_destination_stats_path($oEndpoint_serial_SOURCE, $oEndpoint_serial_DESTINATION);

        $tmp_slashChar = $this->return_slashChar($tmp_ARRAY['DESTINATION_FILEPATH']);
        $tmp_split_ARRAY = explode($tmp_slashChar, $tmp_ARRAY['DESTINATION_FILEPATH']);

        $tmp_sect_cnt = sizeof($tmp_split_ARRAY);
        $tmp_ARRAY['SPLIT_DIR'] = $tmp_split_ARRAY[$tmp_sect_cnt-2];

        $tmp_splice_ARRAY = explode($tmp_ARRAY['SPLIT_DIR'], $SOURCE_filepath);

        if($tmp_slashChar = $this->return_slashChar($destination_FTP_DIR_PATH)){

            $destination_FTP_DIR_PATH = rtrim($destination_FTP_DIR_PATH, $tmp_slashChar). $tmp_slashChar;

            $tmp_chop_ARRAY = explode($tmp_slashChar, $destination_FTP_DIR_PATH);
            $tmp_node_cnt = sizeof($tmp_chop_ARRAY);

            $tmp_destination_node_ARRAY = explode($tmp_chop_ARRAY[$tmp_node_cnt-2], $tmp_ARRAY['DESTINATION_FILEPATH']);

            $tmp_mksubdir_destination_path = dirname($tmp_destination_node_ARRAY[1]);

        }else{

            $tmp_mksubdir_destination_path = dirname($tmp_ARRAY['DESTINATION_FILEPATH']);

        }

        $tmp_ARRAY['FTP_DIR_PATH'] = $destination_FTP_DIR_PATH;
        $tmp_ARRAY['MKSUB_DIR'] = $tmp_mksubdir_destination_path;

        return $tmp_ARRAY;

    }

    public function return_destination_stats_path($serial_oEndpoint_SOURCE, $serial_oEndpoint_DESTINATION){

        $destination_path = '';

        #$this->destination_endpoint_stats_serial_ARRAY[] = $tmp_stats_endpoint_serial;
        #source_endpoint_stats_serial_ARRAY

        //
        // GET DESTINATION ENDPOINT STATS DATA
        foreach($this->destination_endpoint_stats_serial_ARRAY as $key_dest => $destination_stats_serial){

            if($serial_oEndpoint_DESTINATION == $this->destination_endpoint_serial_ARRAY[$destination_stats_serial]){

                switch($this->destination_endpoint_protocol_ARRAY[$destination_stats_serial]){
                    case 'FTP':

                        //
                        // FTP
                        $destination_is_flat_file = $this->destination_endpoint_isFlatFile_ARRAY[$destination_stats_serial];
                        $destination_isValid = $this->destination_endpoint_isValid_ARRAY[$destination_stats_serial];
                        $destination_protocol = $this->destination_endpoint_protocol_ARRAY[$destination_stats_serial];
                        $destination_oEndpoint_serial = $this->destination_endpoint_serial_ARRAY[$destination_stats_serial];
                        $destination_oEndpoint_id = $this->destination_endpoint_id_ARRAY[$destination_stats_serial];
                        $destination_FTP_SERVER = $this->destination_endpoint_ftp_server_ARRAY[$destination_stats_serial];
                        $destination_FTP_PORT = $this->destination_endpoint_ftp_port_ARRAY[$destination_stats_serial];
                        $destination_FTP_DIR_PATH = $this->destination_endpoint_stats_path_serialindex_ARRAY[$destination_stats_serial];

                    break;
                    default:

                        //
                        // LOCAL_DIR
                        $destination_is_flat_file = $this->destination_endpoint_isFlatFile_ARRAY[$destination_stats_serial];
                        $destination_isValid = $this->destination_endpoint_isValid_ARRAY[$destination_stats_serial];
                        $destination_protocol = $this->destination_endpoint_protocol_ARRAY[$destination_stats_serial];
                        $destination_oEndpoint_serial = $this->destination_endpoint_serial_ARRAY[$destination_stats_serial];
                        $destination_oEndpoint_id = $this->destination_endpoint_id_ARRAY[$destination_stats_serial];
                        $destination_current_perms = $this->destination_endpoint_perms_ARRAY[$destination_stats_serial];
                        $destination_MKDIR_MODE = $this->destination_endpoint_mkdir_mode_ARRAY[$destination_stats_serial];
                        $destination_DIR_PATH = $this->destination_endpoint_stats_path_serialindex_ARRAY[$destination_stats_serial];

                    break;

                }

            }

        }

        //
        // GET SOURCE ENDPOINT STATS SERIAL
        foreach($this->source_endpoint_stats_serial_ARRAY as $key_src => $source_stats_serial){

            if($serial_oEndpoint_SOURCE == $this->source_endpoint_serial_ARRAY[$source_stats_serial]){

                switch($this->source_endpoint_protocol_ARRAY[$source_stats_serial]){
                    case 'FTP':

                        //
                        // FTP
                        $source_isValid = $this->source_endpoint_isValid_ARRAY[$source_stats_serial];
                        $source_protocol = $this->source_endpoint_protocol_ARRAY[$source_stats_serial];
                        $source_oEndpoint_serial = $this->source_endpoint_serial_ARRAY[$source_stats_serial];
                        $source_oEndpoint_id = $this->source_endpoint_id_ARRAY[$source_stats_serial];
                        $source_FTP_SERVER = $this->source_endpoint_ftp_server_ARRAY[$source_stats_serial];
                        $source_FTP_PORT = $this->source_endpoint_ftp_port_ARRAY[$source_stats_serial];
                        $source_FTP_DIR_PATH = $this->source_endpoint_stats_path_serialindex_ARRAY[$source_stats_serial];

                    break;
                    default:

                        //
                        // LOCAL_DIR
                        $source_isValid = $this->source_endpoint_isValid_ARRAY[$source_stats_serial];
                        $source_protocol = $this->source_endpoint_protocol_ARRAY[$source_stats_serial];
                        $source_oEndpoint_serial = $this->source_endpoint_serial_ARRAY[$source_stats_serial];
                        $source_oEndpoint_id = $this->source_endpoint_id_ARRAY[$source_stats_serial];
                        $source_current_perms = $this->source_endpoint_perms_ARRAY[$source_stats_serial];
                        $source_DIR_PATH = $this->source_endpoint_stats_path_serialindex_ARRAY[$source_stats_serial];

                    break;

                }

            }

        }

        switch($destination_protocol){
            case 'FTP':

                if($dest_slashChar = $this->return_slashChar($destination_FTP_DIR_PATH)){

                }else{

                    $dest_slashChar = DIRECTORY_SEPARATOR;

                }

                $destination_path .= rtrim($destination_FTP_DIR_PATH,$dest_slashChar).$dest_slashChar;

                if(isset($this->custom_folder_name)){

                    //
                    // APPEND CUSTOM DIR TO PATH AT DESTINATION
                    $destination_path .= rtrim($this->custom_folder_name, $dest_slashChar).$dest_slashChar;

                }

                //
                // APPEND DATE STAMPED DIR NAME TO PATH
                if(isset($this->timestamp_nom_ARRAY[$source_oEndpoint_serial])){

                    $timestamp_nom = $this->timestamp_nom_ARRAY[$source_oEndpoint_serial];

                    $destination_path .= $timestamp_nom.$dest_slashChar;

                }else{

                    if($this->timestamp_versioning_pattern!='') {

                        if(!($timestamp_nom = date($this->timestamp_versioning_pattern, time()))){

                            $timestamp_nom = date('Ymd_H_i_s', time());

                        }

                        $destination_path .= $timestamp_nom.$dest_slashChar;

                    }


                }

                if($this->content_only_path_to_destination){

                    //
                    // NO REPLICATION (AT DESTINATION) OF CONTAINING DIR AT SOURCE

                }else{

                    //
                    // REPLICATE TO DESTINATION...CONTAINING DIR AT SOURCE
                    switch($source_protocol) {
                        case 'FTP':

                            if($src_slashChar = $this->return_slashChar($source_FTP_DIR_PATH)){


                            }else{

                                $src_slashChar = DIRECTORY_SEPARATOR;

                            }

                            $source_FTP_DIR_PATH = rtrim($source_FTP_DIR_PATH, $src_slashChar).$src_slashChar;

                            $tmp_src_dir_ARRAY = explode($src_slashChar, $source_FTP_DIR_PATH);

                        break;
                        default:

                            if($src_slashChar = $this->return_slashChar($source_DIR_PATH)){


                            }else{

                                $src_slashChar = DIRECTORY_SEPARATOR;

                            }

                            $source_DIR_PATH = rtrim($source_DIR_PATH, $src_slashChar).$src_slashChar;

                            $tmp_src_dir_ARRAY = explode($src_slashChar, $source_DIR_PATH);

                        break;

                    }

                    $tmp_dir_sect_cnt = sizeof($tmp_src_dir_ARRAY);

                    $destination_path .= $tmp_src_dir_ARRAY[$tmp_dir_sect_cnt-2].$dest_slashChar;

                }

            break;
            default:

                if($dest_slashChar = $this->return_slashChar($destination_DIR_PATH)){

                }else{

                    $dest_slashChar = DIRECTORY_SEPARATOR;

                }

                $destination_path .= rtrim($destination_DIR_PATH, $dest_slashChar).$dest_slashChar;

                if(isset($this->custom_folder_name)){

                    //
                    // APPEND CUSTOM DIR TO PATH AT DESTINATION
                    $destination_path .= rtrim($this->custom_folder_name, $dest_slashChar).$dest_slashChar;

                }

                //
                // APPEND DATE STAMPED DIR NAME TO PATH
                if(isset($this->timestamp_nom_ARRAY[$source_oEndpoint_serial])){

                    $timestamp_nom = $this->timestamp_nom_ARRAY[$source_oEndpoint_serial];

                    $destination_path .= $timestamp_nom . $dest_slashChar;

                }else{

                    if($this->timestamp_versioning_pattern != ''){

                        if(!($timestamp_nom = date($this->timestamp_versioning_pattern, time()))){

                            $timestamp_nom = date('Ymd_H_i_s', time());

                        }

                        $destination_path .= $timestamp_nom . $dest_slashChar;

                    }

                }

                if($this->content_only_path_to_destination){

                    //
                    // NO REPLICATION (AT DESTINATION) OF CONTAINING DIR AT SOURCE

                }else{

                    //
                    // REPLICATE TO DESTINATION...CONTAINING DIR AT SOURCE
                    switch($source_protocol) {
                        case 'FTP':

                            if($src_slashChar = $this->return_slashChar($source_FTP_DIR_PATH)){


                            }else{

                                $src_slashChar = DIRECTORY_SEPARATOR;

                            }

                            $source_FTP_DIR_PATH = rtrim($source_FTP_DIR_PATH, $src_slashChar).$src_slashChar;

                            $tmp_src_dir_ARRAY = explode($src_slashChar, $source_FTP_DIR_PATH);

                        break;
                        default:

                            if($src_slashChar = $this->return_slashChar($source_DIR_PATH)){


                            }else{

                                $src_slashChar = DIRECTORY_SEPARATOR;

                            }

                            $source_DIR_PATH = rtrim($source_DIR_PATH, $src_slashChar).$src_slashChar;

                            $tmp_src_dir_ARRAY = explode($src_slashChar, $source_DIR_PATH);

                        break;

                    }

                    $tmp_dir_sect_cnt = sizeof($tmp_src_dir_ARRAY);

                    $destination_path .= $tmp_src_dir_ARRAY[$tmp_dir_sect_cnt-2].$dest_slashChar;

                }

            break;

        }

        //$this->oCRNRSTN_USR->error_log('destination_path='.$destination_path, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_PROFILE');

        return $destination_path;

    }

    public function return_source_to_destination_stats_array($execution_serial, $batch_serial, $oEndpoint_DESTINATION){

        $tmp_ARRAY = array();
        $src_to_dest_cnt = 0;

        $tmp_serial_oEndpoint_DESTINATION = $oEndpoint_DESTINATION->return_serial();

        foreach($this->transfer_success_count_ARRAY[$execution_serial][$batch_serial] as $serial_oEndpoint_SOURCE => $chunkARRAY0){

            foreach($chunkARRAY0 as $serial_oEndpoint_DESTINATION => $asset_transfer_count){

                if($tmp_serial_oEndpoint_DESTINATION == $serial_oEndpoint_DESTINATION){

                    $tmp_ARRAY['activity_stats'][$src_to_dest_cnt]['asset_transfer_count'] = $asset_transfer_count;
                    $tmp_ARRAY['activity_stats'][$src_to_dest_cnt]['destination_path'] = $this->return_destination_stats_path($serial_oEndpoint_SOURCE, $serial_oEndpoint_DESTINATION);

                    $src_to_dest_cnt++;

                }

            }

        }

        $tmp_ARRAY['src_to_dest_cnt'] = $src_to_dest_cnt;

        return $tmp_ARRAY;

    }

    public function plus_one_asset_transfer($oEndpoint_serial_SOURCE, $oEndpoint_serial_DESTINATION, $execution_serial, $execution_batch_serial, $file_size){

        if(!isset($this->transfer_success_count_ARRAY[$execution_serial][$execution_batch_serial][$oEndpoint_serial_SOURCE][$oEndpoint_serial_DESTINATION])){

            $this->transfer_success_count_ARRAY[$execution_serial][$execution_batch_serial][$oEndpoint_serial_SOURCE][$oEndpoint_serial_DESTINATION] = 0;
            $this->filesize_success_count_ARRAY[$execution_serial][$execution_batch_serial][$oEndpoint_serial_SOURCE][$oEndpoint_serial_DESTINATION] = 0;

        }

        $this->transfer_success_count_ARRAY[$execution_serial][$execution_batch_serial][$oEndpoint_serial_SOURCE][$oEndpoint_serial_DESTINATION] += 1;
        $this->filesize_success_count_ARRAY[$execution_serial][$execution_batch_serial][$oEndpoint_serial_SOURCE][$oEndpoint_serial_DESTINATION] += $file_size;

    }

    public function init_electrum($electrum_process_id, $execution_batch_serial, $startTime, $timestamp_versioning_pattern=NULL){

        $this->electrum_process_id = $electrum_process_id;
        $this->execution_batch_serial = $execution_batch_serial;
        $this->startTime = $startTime;
        $this->timestamp_versioning_pattern = $timestamp_versioning_pattern;

    }

    public function moveContentOnly($excludeContainingDir){

        $this->content_only_path_to_destination = $excludeContainingDir;

    }


    public function add_valid_source_DIR($dirPath, $endpoint_serial, $endpoint_id, $current_perms){

        $tmp_stats_endpoint_serial = $this->oCRNRSTN_USR->generate_new_key(50);

        $this->source_endpoint_stats_serial_ARRAY[] = $tmp_stats_endpoint_serial;
        $this->source_endpoint_stats_pathindex_ARRAY[$dirPath] = $tmp_stats_endpoint_serial;
        $this->source_endpoint_stats_path_serialindex_ARRAY[$tmp_stats_endpoint_serial] = $dirPath;

        $this->source_endpoint_isValid_ARRAY[$tmp_stats_endpoint_serial] = true;
        $this->source_endpoint_protocol_ARRAY[$tmp_stats_endpoint_serial] = 'LOCAL_DIR';
        $this->source_endpoint_serial_ARRAY[$tmp_stats_endpoint_serial] = $endpoint_serial;
        $this->source_endpoint_id_ARRAY[$tmp_stats_endpoint_serial] = $endpoint_id;
        $this->source_endpoint_perms_ARRAY[$tmp_stats_endpoint_serial] = $current_perms;

    }

    public function add_invalid_source_DIR($dirPath, $endpoint_serial, $endpoint_id, $current_perms, $err_reason){

        $tmp_stats_endpoint_serial = $this->oCRNRSTN_USR->generate_new_key(50);

        $this->source_endpoint_stats_serial_ARRAY[] = $tmp_stats_endpoint_serial;

        $this->source_endpoint_stats_pathindex_ARRAY[$dirPath] = $tmp_stats_endpoint_serial;
        $this->source_endpoint_stats_path_serialindex_ARRAY[$tmp_stats_endpoint_serial] = $dirPath;

        $this->source_endpoint_isValid_ARRAY[$tmp_stats_endpoint_serial] = false;
        $this->source_endpoint_protocol_ARRAY[$tmp_stats_endpoint_serial] = 'LOCAL_DIR';
        $this->source_endpoint_serial_ARRAY[$tmp_stats_endpoint_serial] = $endpoint_serial;
        $this->source_endpoint_id_ARRAY[$tmp_stats_endpoint_serial] = $endpoint_id;
        $this->source_endpoint_perms_ARRAY[$tmp_stats_endpoint_serial] = $current_perms;
        $this->source_endpoint_err_reason_ARRAY[$tmp_stats_endpoint_serial] = $err_reason;

    }

    public function add_valid_source_FTP($FTP_DIR_PATH, $FTP_SERVER, $FTP_PORT, $endpoint_serial, $endpoint_id){

        $tmp_stats_endpoint_serial = $this->oCRNRSTN_USR->generate_new_key(50);

        $this->source_endpoint_stats_serial_ARRAY[] = $tmp_stats_endpoint_serial;

        $this->source_endpoint_stats_pathindex_ARRAY[$FTP_DIR_PATH] = $tmp_stats_endpoint_serial;
        $this->source_endpoint_stats_path_serialindex_ARRAY[$tmp_stats_endpoint_serial] = $FTP_DIR_PATH;

        $this->source_endpoint_isValid_ARRAY[$tmp_stats_endpoint_serial] = true;
        $this->source_endpoint_protocol_ARRAY[$tmp_stats_endpoint_serial] = 'FTP';
        $this->source_endpoint_serial_ARRAY[$tmp_stats_endpoint_serial] = $endpoint_serial;
        $this->source_endpoint_id_ARRAY[$tmp_stats_endpoint_serial] = $endpoint_id;
        $this->source_endpoint_ftp_server_ARRAY[$tmp_stats_endpoint_serial] = $FTP_SERVER;
        $this->source_endpoint_ftp_port_ARRAY[$tmp_stats_endpoint_serial] = $FTP_PORT;

    }

    public function add_invalid_source_FTP($FTP_DIR_PATH, $FTP_SERVER, $FTP_PORT, $endpoint_serial, $endpoint_id){

        $tmp_stats_endpoint_serial = $this->oCRNRSTN_USR->generate_new_key(50);

        $this->source_endpoint_stats_serial_ARRAY[] = $tmp_stats_endpoint_serial;

        $this->source_endpoint_stats_pathindex_ARRAY[$FTP_DIR_PATH] = $tmp_stats_endpoint_serial;
        $this->source_endpoint_stats_path_serialindex_ARRAY[$tmp_stats_endpoint_serial] = $FTP_DIR_PATH;

        $this->source_endpoint_isValid_ARRAY[$tmp_stats_endpoint_serial] = false;
        $this->source_endpoint_protocol_ARRAY[$tmp_stats_endpoint_serial] = 'FTP';
        $this->source_endpoint_serial_ARRAY[$tmp_stats_endpoint_serial] = $endpoint_serial;
        $this->source_endpoint_id_ARRAY[$tmp_stats_endpoint_serial] = $endpoint_id;
        $this->source_endpoint_ftp_server_ARRAY[$tmp_stats_endpoint_serial] = $FTP_SERVER;
        $this->source_endpoint_ftp_port_ARRAY[$tmp_stats_endpoint_serial] = $FTP_PORT;

    }

    public function add_valid_destination_FTP($FTP_DIR_PATH, $FTP_SERVER, $FTP_PORT, $endpoint_serial, $endpoint_id, $is_flat_file=false){

        $tmp_stats_endpoint_serial = $this->oCRNRSTN_USR->generate_new_key(50);

        $this->destination_endpoint_stats_serial_ARRAY[] = $tmp_stats_endpoint_serial;

        $this->destination_endpoint_stats_pathindex_ARRAY[$FTP_DIR_PATH] = $tmp_stats_endpoint_serial;
        $this->destination_endpoint_stats_path_serialindex_ARRAY[$tmp_stats_endpoint_serial] = $FTP_DIR_PATH;

        $this->destination_endpoint_isFlatFile_ARRAY[$tmp_stats_endpoint_serial] = $is_flat_file;
        $this->destination_endpoint_isValid_ARRAY[$tmp_stats_endpoint_serial] = true;
        $this->destination_endpoint_protocol_ARRAY[$tmp_stats_endpoint_serial] = 'FTP';
        $this->destination_endpoint_serial_ARRAY[$tmp_stats_endpoint_serial] = $endpoint_serial;
        $this->destination_endpoint_id_ARRAY[$tmp_stats_endpoint_serial] = $endpoint_id;
        $this->destination_endpoint_ftp_server_ARRAY[$tmp_stats_endpoint_serial] = $FTP_SERVER;
        $this->destination_endpoint_ftp_port_ARRAY[$tmp_stats_endpoint_serial] = $FTP_PORT;

    }

    public function add_invalid_destination_FTP($FTP_DIR_PATH, $FTP_SERVER, $FTP_PORT, $endpoint_serial, $endpoint_id){

        $tmp_stats_endpoint_serial = $this->oCRNRSTN_USR->generate_new_key(50);

        $this->destination_endpoint_stats_serial_ARRAY[] = $tmp_stats_endpoint_serial;

        $this->destination_endpoint_stats_pathindex_ARRAY[$FTP_DIR_PATH] = $tmp_stats_endpoint_serial;
        $this->destination_endpoint_stats_path_serialindex_ARRAY[$tmp_stats_endpoint_serial] = $FTP_DIR_PATH;

        $this->destination_endpoint_isFlatFile_ARRAY[$tmp_stats_endpoint_serial] = false;
        $this->destination_endpoint_isValid_ARRAY[$tmp_stats_endpoint_serial] = false;
        $this->destination_endpoint_protocol_ARRAY[$tmp_stats_endpoint_serial] = 'FTP';
        $this->destination_endpoint_serial_ARRAY[$tmp_stats_endpoint_serial] = $endpoint_serial;
        $this->destination_endpoint_id_ARRAY[$tmp_stats_endpoint_serial] = $endpoint_id;
        $this->destination_endpoint_ftp_server_ARRAY[$tmp_stats_endpoint_serial] = $FTP_SERVER;
        $this->destination_endpoint_ftp_port_ARRAY[$tmp_stats_endpoint_serial] = $FTP_PORT;

    }

    public function add_valid_destination_DIR($DIR_PATH, $endpoint_serial, $endpoint_id, $current_perms, $MKDIR_MODE, $is_flat_file=false){

        $tmp_stats_endpoint_serial = $this->oCRNRSTN_USR->generate_new_key(50);

        $this->destination_endpoint_stats_serial_ARRAY[] = $tmp_stats_endpoint_serial;

        $this->destination_endpoint_stats_pathindex_ARRAY[$DIR_PATH] = $tmp_stats_endpoint_serial;
        $this->destination_endpoint_stats_path_serialindex_ARRAY[$tmp_stats_endpoint_serial] = $DIR_PATH;

        $this->destination_endpoint_isFlatFile_ARRAY[$tmp_stats_endpoint_serial] = $is_flat_file;
        $this->destination_endpoint_isValid_ARRAY[$tmp_stats_endpoint_serial] = true;
        $this->destination_endpoint_protocol_ARRAY[$tmp_stats_endpoint_serial] = 'LOCAL_DIR';
        $this->destination_endpoint_serial_ARRAY[$tmp_stats_endpoint_serial] = $endpoint_serial;
        $this->destination_endpoint_id_ARRAY[$tmp_stats_endpoint_serial] = $endpoint_id;
        $this->destination_endpoint_perms_ARRAY[$tmp_stats_endpoint_serial] = $current_perms;
        $this->destination_endpoint_mkdir_mode_ARRAY[$tmp_stats_endpoint_serial] = $MKDIR_MODE;

    }

    public function add_invalid_destination_DIR($DIR_PATH, $endpoint_serial, $endpoint_id, $current_perms, $MKDIR_MODE, $err_reason){

        $tmp_stats_endpoint_serial = $this->oCRNRSTN_USR->generate_new_key(50);

        $this->destination_endpoint_stats_serial_ARRAY[] = $tmp_stats_endpoint_serial;

        $this->destination_endpoint_stats_pathindex_ARRAY[$DIR_PATH] = $tmp_stats_endpoint_serial;
        $this->destination_endpoint_stats_path_serialindex_ARRAY[$tmp_stats_endpoint_serial] = $DIR_PATH;

        $this->destination_endpoint_isFlatFile_ARRAY[$tmp_stats_endpoint_serial] = false;
        $this->destination_endpoint_isValid_ARRAY[$tmp_stats_endpoint_serial] = false;
        $this->destination_endpoint_protocol_ARRAY[$tmp_stats_endpoint_serial] = 'LOCAL_DIR';
        $this->destination_endpoint_serial_ARRAY[$tmp_stats_endpoint_serial] = $endpoint_serial;
        $this->destination_endpoint_id_ARRAY[$tmp_stats_endpoint_serial] = $endpoint_id;
        $this->destination_endpoint_perms_ARRAY[$tmp_stats_endpoint_serial] = $current_perms;
        $this->destination_endpoint_mkdir_mode_ARRAY[$tmp_stats_endpoint_serial] = $MKDIR_MODE;
        $this->destination_endpoint_err_reason_ARRAY[$tmp_stats_endpoint_serial] = $err_reason;

    }

    private function return_slashChar($path){

        $pos_fslash = strpos($path,'/');

        if($pos_fslash !== false) {

            return '/';

        }else{

            $pos_bslash = strpos($path,'\\');
            if($pos_bslash !== false) {

                return '\\';
            }else{

                return false;

            }

        }

    }

    public function __destruct() {

    }

}