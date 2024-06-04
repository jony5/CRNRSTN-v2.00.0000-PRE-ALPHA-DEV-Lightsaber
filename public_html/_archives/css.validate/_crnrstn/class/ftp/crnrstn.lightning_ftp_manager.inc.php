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
#  CLASS :: crnrstn_wheel_high_awesome_eyes
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  VERSION :: 1.00.0000
#  DATE :: September 17, 2020 @ 0606hrs
#  DESCRIPTION :: An asset available to Electrum :: for file transfer.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#  Ezekiel 1:15-16 - AND AS I WATCHED THE LIVING CREATURES, I SAW A WHEEL UPON
#  THE EARTH BESIDE THE LIVING CREATURES, FOR EACH OF THEIR FOUR FACES. THE APPEARANCE
#  OF THE WHEELS AND THEIR WORKMANSHIP WERE LIKE THE SIGHT OF BERYL. AND THE FOUR OF
#  THEM HAD ONE LIKENESS; THAT IS, THEIR APPEARANCE AND THEIR WORKMANSHIP WERE AS IT
#  WERE A WHEEL WITHIN A WHEEL.
#  Ezekiel 1:18-20 - AS FOR THEIR RIMS, THEY WERE HIGH AND THEY WERE AWESOME; AND THE
#  RIMS OF THE FOUR OF THEM WERE FULL OF EYES ALL AROUND. AND WHENEVER THE LIVING
#  CREATURES WENT, THE WHEELS WENT BESIDE THEM; AND WHENEVER THE LIVING CREATURES WERE
#  LIFTED UP ABOVE THE EARTH, THE WHEELS WERE LIFTED UP ALSO. WHEREEVER THE SPIRIT WAS
#  TO GO, THEY WENT--WHEREVER THE SPIRIT WAS TO GO. AND THE WHEELS WERE LIFTED UP
#  ALONGSIDE THEM, FOR THE SPIRIT OF THE LIVING CREATURE WAS IN THE WHEELS.
class crnrstn_wheel_high_awesome_eyes{

    protected $oLogger;
    private static $oCRNRSTN_USR;

    protected $timestamp_nom;
    protected $start_time_micro;
    protected $start_time_timestamp;
    protected $elapsed_time_at_start;
    protected $execution_serial;
    protected $serial;
    protected $queue_position;
    protected $queue_length;
    protected $filesize_bytes = 0;

    protected $oEndpoint_SOURCE;
    protected $oEndpoint_DESTINATION;

    protected $connection_type_SOURCE;
    protected $connection_type_DESTINATION;

    protected $SOURCE_FILE_PATH;
    protected $SOURCE_FILE_NAME;
    protected $SOURCE_LOCAL_DIR_PATH;

    protected $DESTINATION_DIR_PATH;
    protected $DESTINATION_MKDIR_PERMISSIONS_MODE;
    protected $DESTINATION_FILE_PATH;
    protected $DESTINATION_FILE_PATH_ROOT;

    protected $state_status = 'new';
    protected $state_status_ARRAY = array();
    protected $exclusion_check_result = array();
    protected $isExcluded = false;

    protected $is_transferred = false;
    protected $is_error_on_transfer = false;
    protected $error_on_transfer_message = '';

    protected $exclude_source_dir_from_copy = false;

    public $unique_asset_count_at_SOURCE = 0;
    public $unique_asset_filesize_at_SOURCE = 0;

    public function __construct($execution_serial, $FIREHOT_oEndpoint_SOURCE, $FIREHOT_oEndpoint_DEST, $oCRNRSTN_USR, $total_wheels_count, $wheels_high_awesome_cnt, $exclusion_check_result){

        $this->start_time_micro = $oCRNRSTN_USR->get_micro_time();
        $this->start_time_timestamp = $oCRNRSTN_USR->return_queryDateTimeStamp();
        $this->elapsed_time_at_start = $oCRNRSTN_USR->wall_time();
        $this->timestamp_nom = $FIREHOT_oEndpoint_SOURCE->return_timestamp_nom();

        self::$oCRNRSTN_USR = $oCRNRSTN_USR;
        $this->oEndpoint_SOURCE = $FIREHOT_oEndpoint_SOURCE;
        $this->oEndpoint_DESTINATION = $FIREHOT_oEndpoint_DEST;
        $this->queue_position = $wheels_high_awesome_cnt;
        $this->queue_length = $total_wheels_count;
        $this->exclusion_check_result = $exclusion_check_result;

        if(!$this->exclusion_check_result['not_excluded'] && $exclusion_check_result['pattern']!=''){

            //
            // ASSET EXCLUDED
            $this->isExcluded = true;
            if($this->exclusion_check_result['wcr_path_specified']!=''){

                //self::$oCRNRSTN_USR->error_log('oWheel RELATED TO ENDPOINT '.$this->exclusion_check_result['wcr_path_specified'].' TO BE SUPPRESSED FOR '.$exclusion_check_result['exclusion_meta'].' against '.$this->exclusion_check_result['pattern_type'].' PATTERN ('.$this->exclusion_check_result['pattern'].') MATCH CONCERNING =>'.$this->exclusion_check_result['asset_meta'], __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

            }else{

                //self::$oCRNRSTN_USR->error_log('oWheel TO BE SUPPRESSED FOR '.$this->exclusion_check_result['pattern_type'].' PATTERN ('.$exclusion_check_result['exclusion_meta'].' against '.$this->exclusion_check_result['pattern'].') MATCH CONCERNING =>'.$this->exclusion_check_result['asset_meta'], __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

            }

        }

        /*
        $exclusion_check_result['wcr_path_specified'] = $WCRkey_or_DIRPATH;
        $exclusion_check_result['not_excluded'] = false;
        $exclusion_check_result['pattern'] = $nomination_pattern;
        $exclusion_check_result['asset_meta'] = $filePath;
        */

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(self::$oCRNRSTN_USR->CRNRSTN_debugMode, __CLASS__, self::$oCRNRSTN_USR->log_silo_profile, self::$oCRNRSTN_USR);

        $this->execution_serial = $execution_serial;
        $this->serial = self::$oCRNRSTN_USR->generate_new_key(100);

    }

    public function return_timestamp_nom(){

        return $this->timestamp_nom;

    }

    public function return_filepath_SOURCE(){

        return $this->SOURCE_FILE_PATH;

    }

    public function return_filesize_bytes(){

        return $this->filesize_bytes;

    }

    public function return_endpoint_SOURCE(){

        if($this->oEndpoint_SOURCE->return_connection_type() == 'FTP'){

            return  'FTP ['.$this->oEndpoint_SOURCE->return_FTP_SERVER().'] '.$this->oEndpoint_SOURCE->return_FTP_DIR_PATH();

        }else{

            return  $this->oEndpoint_SOURCE->return_LOCAL_DIR_PATH();

        }

    }

    public function return_endpoint_DESTINATION(){

        if($this->oEndpoint_DESTINATION->return_connection_type() == 'FTP'){

            return  $this->oEndpoint_DESTINATION->return_FTP_SERVER().' at port '.$this->oEndpoint_DESTINATION->return_FTP_PORT();

        }else{

            return  $this->oEndpoint_DESTINATION->return_LOCAL_DIR_PATH();

        }

    }

    public function transfer_error_message(){

        return $this->error_on_transfer_message;

    }

    public function is_transfer_error(){

        return $this->is_error_on_transfer;

    }

    public function is_skipped(){

        return $this->isExcluded;

    }

    public function is_transferred(){

        return $this->is_transferred;

    }

    public function log_state_status($str){

        $this->state_status = $str;
        $this->state_status_ARRAY[] = $str;

    }

    public function return_slashChar($path){

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

    private function fileMove_DF($ftp_stream, $SOURCE_filePath, $oEndpoint_serial_SOURCE, $oEndpoint_serial_DESTINATION, $oElectrum_STATS, $SOURCE_filePath_ORIGINAL=NULL){

        $continue_process = false;

        #$tmp_stats_DESTINATION_ARRAY['FTP_DIR_PATH']
        #$tmp_stats_DESTINATION_ARRAY['MKSUB_DIR']
        #$tmp_stats_DESTINATION_ARRAY['DESTINATION_FILEPATH']
        #$tmp_stats_DESTINATION_ARRAY['SPLIT_DIR']
        $tmp_stats_DESTINATION_ARRAY = $oElectrum_STATS->return_DF_destination_stats_array($oEndpoint_serial_SOURCE, $oEndpoint_serial_DESTINATION, $SOURCE_filePath);
        $tmp_stats_dest_path = $oElectrum_STATS->return_destination_stats_path($oEndpoint_serial_SOURCE, $oEndpoint_serial_DESTINATION);
        //self::$oCRNRSTN_USR->error_log('oWheel :: Run ftp_mksubdirs=>[ftp_root_dir_path='.$ftp_root_dir_path.'][tmp_mksubdir_destination_path='.$tmp_mksubdir_destination_path.']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

        if(is_dir($SOURCE_filePath)){

            //self::$oCRNRSTN_USR->error_log('oWheel :: Run ftp_mksubdirs=>[source_filepath='.$SOURCE_filePath.']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

            $this->ftp_mksubdirs($ftp_stream, $tmp_stats_DESTINATION_ARRAY['FTP_DIR_PATH'], $tmp_stats_DESTINATION_ARRAY['MKSUB_DIR']);

            $continue_process = true;

        }else{

            if(isset($SOURCE_filePath_ORIGINAL)){

                $SOURCE_filepath_for_DESTINATION = $SOURCE_filePath_ORIGINAL;

            }else{

                $SOURCE_filepath_for_DESTINATION = $SOURCE_filePath;

            }

            $tmp_slashChar = $this->return_slashChar($tmp_stats_DESTINATION_ARRAY['FTP_DIR_PATH']);

            $tmp_split_ARRAY = explode($tmp_slashChar, $tmp_stats_DESTINATION_ARRAY['FTP_DIR_PATH']);
            $tmp_split_cnt = sizeof($tmp_split_ARRAY);

            $tmp_dir_split_ARRAY = explode($tmp_split_ARRAY[$tmp_split_cnt-2], $tmp_stats_DESTINATION_ARRAY['DESTINATION_FILEPATH']);

            $tmp_dir_sect_ARRAY = explode($tmp_slashChar, $tmp_dir_split_ARRAY[1]);
            $tmp_sect_cnt = sizeof($tmp_dir_sect_ARRAY);

            #$tmp_dir_sect_ARRAY[$tmp_sect_cnt-2] = wethrbug
            $tmp_dest_file_section_ARRAY = explode($tmp_dir_sect_ARRAY[$tmp_sect_cnt-2], $SOURCE_filepath_for_DESTINATION);

            # [tmp_dir_split_ARRAY[1]=/a_custom_folder_name/20201013_16-52-26/wethrbug/
            $tmp_sect_array = explode($tmp_slashChar, $tmp_dir_split_ARRAY[1]);
            $tmp_cnt = sizeof($tmp_sect_array);

            $tmp_cut_dir = $tmp_sect_array[$tmp_cnt-2];

            $tmp_source_sect_ARRAY = explode($tmp_cut_dir, $SOURCE_filePath);
            //$tmp_dir = dirname($tmp_source_sect_ARRAY[1]);

            $tmp_file_dest = rtrim($tmp_dir_split_ARRAY[1], $tmp_slashChar).$tmp_dest_file_section_ARRAY[1];
            $tmp_file_cap = basename($tmp_file_dest);

            $tmp_file_dirpath_final = rtrim($tmp_file_dest,$tmp_file_cap);
            $tmp_stats_DESTINATION_ARRAY['FTP_DIR_PATH'] = rtrim($tmp_stats_DESTINATION_ARRAY['FTP_DIR_PATH'], $tmp_slashChar);
            //$tmp_dfile = $tmp_stats_DESTINATION_ARRAY['FTP_DIR_PATH'].$SOURCE_filepath_for_DESTINATION;
            $tmp_dfile = $tmp_stats_dest_path;
            $tmp_dfile = rtrim($tmp_dfile, $tmp_slashChar);
            //self::$oCRNRSTN_USR->error_log('oWheel :: SLASH CHAR = '.$tmp_slashChar, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

            $tmp_dfile_array = explode($tmp_slashChar, $tmp_stats_DESTINATION_ARRAY['DESTINATION_FILEPATH']);
            $tmp_dfile_sect_cnt = sizeof($tmp_dfile_array);

            //self::$oCRNRSTN_USR->error_log('oWheel :: EXPLODE ['.$tmp_stats_DESTINATION_ARRAY['DESTINATION_FILEPATH'].'] ON '.$tmp_dfile_sect_cnt, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

            $tmp_dfile_bi_path_ARRAY = explode($tmp_dfile_array[$tmp_dfile_sect_cnt-2], $SOURCE_filepath_for_DESTINATION);

            $tmp_dfile .= $tmp_dfile_bi_path_ARRAY[1];
            //self::$oCRNRSTN_USR->error_log('oWheel :: Run ftp_mksubdirs=> [DESTINATION_FILEPATH]='.$tmp_stats_DESTINATION_ARRAY['DESTINATION_FILEPATH'].' | [FTP_DIR_PATH]='.$tmp_stats_DESTINATION_ARRAY['FTP_DIR_PATH']. ' on tmp_split_ARRAY[tmp_split_cnt-2]='.$tmp_split_ARRAY[$tmp_split_cnt-2], __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');
            //self::$oCRNRSTN_USR->error_log('oWheel :: Run ftp_mksubdirs @ '. $tmp_stats_DESTINATION_ARRAY['FTP_DIR_PATH'].' for =>['.$tmp_stats_DESTINATION_ARRAY['FTP_DIR_PATH'].$tmp_file_dirpath_final, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

            if($this->ftp_mksubdirs($ftp_stream, $tmp_slashChar, $tmp_stats_DESTINATION_ARRAY['FTP_DIR_PATH'].$tmp_file_dirpath_final)){

                //self::$oCRNRSTN_USR->error_log('oWheel :: ftp_mksubdirs SUCCESS', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

            }else{

                $error = error_get_last();

                //
                // WE USE FTP_CHDIR TO SEE IF WE NEED TO CALL FTP_MKDIR. IT IS OK (OR EXPECTED) TO GET FTP_CHDIR ERRORS HERE.
                $pos_ignore_err = strpos($error['message'],'ftp_chdir()');
                if($pos_ignore_err===false){

                    self::$oCRNRSTN_USR->error_log('oWheel :: ftp_mksubdirs ERROR :: '.$error['message'], __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

                }
            }

            if(substr($tmp_dfile, -1) == $tmp_slashChar){

                $tmp_dfile = rtrim($tmp_dfile, $tmp_slashChar).$tmp_slashChar;
                $tmp_dfile_fname = basename($SOURCE_filepath_for_DESTINATION);
                $tmp_dfile = $tmp_dfile.$tmp_dfile_fname;

            }

            //self::$oCRNRSTN_USR->error_log('oWheel :: SEE ['.$SOURCE_filepath_for_DESTINATION.']. Now run ftp_put LOCAL FILE=>['.$SOURCE_filepath_for_DESTINATION.'] to DEST FILE=>['.$tmp_dfile.']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

            if(ftp_put($ftp_stream, $tmp_dfile, $SOURCE_filepath_for_DESTINATION, FTP_BINARY)) {

                $continue_process = true;
                //self::$oCRNRSTN_USR->error_log('oWheel FF - 2/2 (or DF 1 of 1) :: Successfully uploaded LOCAL FILE=>['.$SOURCE_filepath_for_DESTINATION.'] to DEST FILE=>['.$tmp_dfile.']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

            }else{

                $error = error_get_last();
                self::$oCRNRSTN_USR->error_log('oWheel FF - 2/2 (or DF 1 of 1) :: ERROR uploading LOCAL FILE=>['.$SOURCE_filepath_for_DESTINATION.'] to DEST FILE=>['.$tmp_dfile.'] :: '.$error['message'], __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

                $this->is_error_on_transfer = true;
                $this->error_on_transfer_message = $error['message'].' <= Error experienced while pushing local file ['.$SOURCE_filepath_for_DESTINATION.'] to FTP destination[{FTP_OR_LOCAL_DETAIL}] as file=>['.$tmp_dfile.'].';

            }

        }

        return $continue_process;

    }

    private function fileMove_DIR_DF($ftp_stream, $SOURCE_filePath, $oEndpoint_serial_SOURCE, $oEndpoint_serial_DESTINATION, $oElectrum_STATS){

        $continue_process = false;

        //
        // PREPARE CONTAINING DIRECTORY OF FTP FILE LOCATION
        $tmp_stats_DESTINATION_ARRAY = $oElectrum_STATS->return_DF_destination_stats_array($oEndpoint_serial_SOURCE, $oEndpoint_serial_DESTINATION, $SOURCE_filePath);
        $tmp_stats_dest_path = $oElectrum_STATS->return_destination_stats_path($oEndpoint_serial_SOURCE, $oEndpoint_serial_DESTINATION);

        #$tmp_stats_DESTINATION_ARRAY['FTP_DIR_PATH']
        #$tmp_stats_DESTINATION_ARRAY['MKSUB_DIR']
        #$tmp_stats_DESTINATION_ARRAY['DESTINATION_FILEPATH']

        //if($this->ftp_mksubdirs($ftp_stream, $tmp_stats_DESTINATION_ARRAY['FTP_DIR_PATH'], $tmp_stats_DESTINATION_ARRAY['DESTINATION_FILEPATH'])){
        if($this->ftp_mksubdirs($ftp_stream, $tmp_stats_DESTINATION_ARRAY['FTP_DIR_PATH'], $tmp_stats_dest_path)){

            $continue_process = true;

        }else{

            //self::$oCRNRSTN_USR->error_log('oWheel DID NOT ftp_mksubdirs =>'.$tmp_stats_dest_path, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

        }

        return $continue_process;

    }

    private function fileMove_DIR_FD($ftp_stream, $ftp_file_path, $oEndpoint_serial_SOURCE, $oEndpoint_serial_DESTINATION, $oElectrum_STATS){

        $continue_process = false;

        #$tmp_stats_DESTINATION_ARRAY['FTP_DIR_PATH']
        #$tmp_stats_DESTINATION_ARRAY['MKSUB_DIR']
        #$tmp_stats_DESTINATION_ARRAY['DESTINATION_FILEPATH']

        $tmp_stats_DESTINATION_ARRAY = $oElectrum_STATS->return_FD_destination_stats_array($oEndpoint_serial_SOURCE, $oEndpoint_serial_DESTINATION, $ftp_file_path);
        $tmp_stats_dest_path = $oElectrum_STATS->return_destination_stats_path($oEndpoint_serial_SOURCE, $oEndpoint_serial_DESTINATION);

        //
        // PULL FROM SOURCE FTP
        $tmp_slashChar = $this->return_slashChar($tmp_stats_dest_path);
        $tmp_stats_dest_path = rtrim($tmp_stats_dest_path, $tmp_slashChar).$tmp_slashChar;

        if(!is_dir($tmp_stats_dest_path)){

            //self::$oCRNRSTN_USR->error_log('oWheel :: fileMove_DIR_FD() mkdir_r =>'.$tmp_stats_dest_path, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

            if($this->mkdir_r($tmp_stats_dest_path)){

            }else{

                self::$oCRNRSTN_USR->error_log('oWheel ERROR mkdir_r =>'.$tmp_stats_dest_path, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

            }

            $continue_process = true;

        }else{

            //self::$oCRNRSTN_USR->error_log('oWheel DO NOT fileMove_DIR_FD() mkdir_r =>'.$tmp_stats_DESTINATION_ARRAY['DESTINATION_FILEPATH'], __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

        }

        return $continue_process;

    }

    private function fileMove_FD($ftp_stream, $target_destination_file_path, $ftp_file_path){

        $continue_process = false;

        $tmp_slashChar = $this->return_slashChar($target_destination_file_path);

        //
        // PULL FROM SOURCE FTP
        $tmp_base_dest_path = dirname($target_destination_file_path);
        $tmp_base_dest_path = rtrim($tmp_base_dest_path, $tmp_slashChar).$tmp_slashChar;

        if(!is_dir($tmp_base_dest_path)){

            //self::$oCRNRSTN_USR->error_log('oWheel mkdir_r =>'.$tmp_base_dest_path, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

            if($this->mkdir_r($tmp_base_dest_path)){

                //self::$oCRNRSTN_USR->error_log('oWheel SUCCESS :: mkdir_r =>'.$tmp_base_dest_path.' working from PATH['.$target_destination_file_path.']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

            }else{

                self::$oCRNRSTN_USR->error_log('oWheel ERROR :: mkdir_r =>'.$tmp_base_dest_path.' working from PATH['.$target_destination_file_path.']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

            }

            $continue_process = true;

        }else{

           //self::$oCRNRSTN_USR->error_log('oWheel :: FD :: DO NOT mkdir_r =>'.$tmp_base_dest_path, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

        }

        //self::$oCRNRSTN_USR->error_log('oWheel Send to ['.$target_destination_file_path.'] the [FTP] LOCAL FILE=>'.$ftp_file_path, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

        if (ftp_get($ftp_stream, $target_destination_file_path, $ftp_file_path, FTP_BINARY)) {

            //self::$oCRNRSTN_USR->error_log('oWheel FF - 1 of 2  (or FD 1 of 1) :: Successfully written ['.$ftp_file_path.'] to '.$target_destination_file_path, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

            $continue_process = true;

        } else {

            $error = error_get_last();
            self::$oCRNRSTN_USR->error_log('oWheel Error :: FF - 1 of 2 (or FD 1 of 1) :: There was a PULL FROM SOURCE FTP problem sending the [FTP] LOCAL FILE=>'.$ftp_file_path.' to ['.$target_destination_file_path.'] :: '.$error['message'], __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

            $this->is_error_on_transfer = true;
            $this->error_on_transfer_message = $error['message'].' <= Error experienced while pulling from a file['.$ftp_file_path.'] from FTP source[{FTP_OR_LOCAL_DETAIL}] to save to a local directory as file['.$target_destination_file_path.'].';

        }

        return $continue_process;

    }

    private function fileMove_DD($src_LOCAL_FILE_PATH, $dest_LOCAL_DIR_PATH){

        $continue_process = false;

        $tmp_dir_path = dirname($dest_LOCAL_DIR_PATH);

        $this->mkdir_r($tmp_dir_path);

        //shell_exec("cp -r $src_LOCAL_DIR_PATH $dest_LOCAL_DIR_PATH");
        //self::$oCRNRSTN_USR->error_log('oWheel :: copy( '.$src_LOCAL_FILE_PATH.' to '.$dest_LOCAL_DIR_PATH, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

        if(!is_dir($src_LOCAL_FILE_PATH)){

            if (!copy($src_LOCAL_FILE_PATH, $dest_LOCAL_DIR_PATH)) {

                $error = error_get_last();
                $this->is_error_on_transfer = true;
                $this->error_on_transfer_message = $error['message'].' <= Error experienced copying a file['.$src_LOCAL_FILE_PATH.'] to file['.$dest_LOCAL_DIR_PATH.'].';

            }

            $tmp_res = filesize($dest_LOCAL_DIR_PATH);

            if ($tmp_res != -1) {

                //self::$oCRNRSTN_USR->error_log('oWheel SUCCESS :: Size of '.$dest_LOCAL_DIR_PATH.' is '.$tmp_res.' bytes', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

                $continue_process = true;

            }else{

                self::$oCRNRSTN_USR->error_log('oWheel Error :: Couldn\'t get the size of '.$dest_LOCAL_DIR_PATH.' (Not all servers support this feature).', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

                if (!file_exists($dest_LOCAL_DIR_PATH)) {

                    //
                    // LOG ERROR IN FILE MOVE. POSSIBLY FOR RE-PROCESS.
                    self::$oCRNRSTN_USR->error_log('oWheel Error :: Also couldn\'t get '.$dest_LOCAL_DIR_PATH.' via file_exists.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

                }
            }

        }else{

            //self::$oCRNRSTN_USR->error_log('oWheel SUCCESS :: WE HAVE DIRECTORY *****'.$src_LOCAL_FILE_PATH, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

            $continue_process = true;

        }

        return $continue_process;

    }

    public function init_fileSize_bytes($bytes){

        if($bytes==-1){

            $this->filesize_bytes = 0;

        }else{

            $this->filesize_bytes = (int) $bytes;

        }


    }

    public function process_dir_asset($SOURCE_filePath, $pathWay, $execution_serial, $execution_batch_serial, $hot_src_connection_ARRAY, $hot_dest_connection_ARRAY, $oElectrum, $oElectrum_STATS){

        switch($pathWay){
            case 'FF':

                if(!$this->isExcluded){

                    $oLightning_ftp_conn_DESTINATION = $hot_dest_connection_ARRAY['oLightning_ftp_conn'];
                    $dest_ftp_stream = $oLightning_ftp_conn_DESTINATION->return_ftp_stream();

                    $FIREHOT_oEndpoint_SOURCE = $hot_src_connection_ARRAY['FIREHOT_oEndpoint'];
                    $FIREHOT_oEndpoint_DESTINATION = $hot_dest_connection_ARRAY['FIREHOT_oEndpoint'];

                    $oEndpoint_serial_SOURCE = $FIREHOT_oEndpoint_SOURCE->return_serial();
                    $oEndpoint_serial_DESTINATION = $FIREHOT_oEndpoint_DESTINATION->return_serial();

                    if($this->fileMove_DIR_DF($dest_ftp_stream, $SOURCE_filePath, $oEndpoint_serial_SOURCE, $oEndpoint_serial_DESTINATION, $oElectrum_STATS)){
                        //if($this->fileMove_DIR_DF($dest_ftp_stream, $dest_FTP_ROOT_DIR_PATH, $this->DESTINATION_FILE_PATH, $SOURCE_filePath)){

                        $this->is_transferred = true;

                        //self::$oCRNRSTN_USR->error_log('oWheel TMP file write TO FTP SUCCESS. REMOVE TMP FILE.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

                    }else{

                        $error = error_get_last();
                        self::$oCRNRSTN_USR->error_log('oWheel fileMove_DF() ERROR :: '.$error['message'], __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

                    }

                }

                break;
            case 'FD':

                if(!$this->isExcluded) {

                    $oLightning_ftp_conn_SOURCE = $hot_src_connection_ARRAY['oLightning_ftp_conn'];
                    $src_ftp_stream = $oLightning_ftp_conn_SOURCE->return_ftp_stream();

                    $FIREHOT_oEndpoint_SOURCE = $hot_src_connection_ARRAY['FIREHOT_oEndpoint'];
                    $FIREHOT_oEndpoint_DESTINATION = $hot_dest_connection_ARRAY['FIREHOT_oEndpoint'];

                    $oEndpoint_serial_SOURCE = $FIREHOT_oEndpoint_SOURCE->return_serial();
                    $oEndpoint_serial_DESTINATION = $FIREHOT_oEndpoint_DESTINATION->return_serial();

                    //self::$oCRNRSTN_USR->error_log('[SOURCE_filePath='.$SOURCE_filePath.'][filename='.$tmp_filename.']', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                    //
                    // FTP TO DIR
                    if($this->fileMove_DIR_FD($src_ftp_stream, $SOURCE_filePath, $oEndpoint_serial_SOURCE, $oEndpoint_serial_DESTINATION, $oElectrum_STATS)){

                        $this->is_transferred = true;

                    }

                }

                break;


        }

        return $this->is_transferred;

    }

    public function process_asset($SOURCE_filePath, $pathWay, $execution_serial, $execution_batch_serial, $hot_src_connection_ARRAY, $hot_dest_connection_ARRAY, $oElectrum, $oElectrum_STATS){

        $FIREHOT_oEndpoint_SOURCE = $hot_src_connection_ARRAY['FIREHOT_oEndpoint'];
        $FIREHOT_oEndpoint_DESTINATION = $hot_dest_connection_ARRAY['FIREHOT_oEndpoint'];

        $oEndpoint_serial_SOURCE = $FIREHOT_oEndpoint_SOURCE->return_serial();
        $oEndpoint_serial_DESTINATION = $FIREHOT_oEndpoint_DESTINATION->return_serial();

        if(!$this->isExcluded){

            # public $unique_asset_count_at_SOURCE_ARRAY = array();
            # public $unique_asset_filesize_at_SOURCE_ARRAY = array();

            $this->unique_asset_count_at_SOURCE = 1;
            $this->unique_asset_filesize_at_SOURCE = $this->filesize_bytes;

        }

        switch($pathWay){
            case 'FF':

                if(!$this->isExcluded){

                    $oLightning_ftp_conn_SOURCE = $hot_src_connection_ARRAY['oLightning_ftp_conn'];
                    $src_ftp_stream = $oLightning_ftp_conn_SOURCE->return_ftp_stream();


                    //
                    // PROCESS ASSET TRANSFER
                    $FF_tmp_dirPath = $oElectrum->return_FF_tmp_dirPath();

                    $tmp_hash = self::$oCRNRSTN_USR->generate_new_key(10);
                    $tmp_filename = basename($SOURCE_filePath);
                    $tmp_dest_tmp_filePath = $FF_tmp_dirPath.$tmp_hash.'_'.$tmp_filename;

                    if(file_exists($tmp_dest_tmp_filePath)){

                        //
                        // REMOVE FILE
                        unlink($tmp_dest_tmp_filePath);

                    }

                    //
                    // FTP TO DIR
                    if($this->fileMove_FD($src_ftp_stream, $tmp_dest_tmp_filePath, $SOURCE_filePath)){

                        $oLightning_ftp_conn_DESTINATION = $hot_dest_connection_ARRAY['oLightning_ftp_conn'];
                        $dest_ftp_stream = $oLightning_ftp_conn_DESTINATION->return_ftp_stream();

                        if($this->fileMove_DF($dest_ftp_stream, $tmp_dest_tmp_filePath, $oEndpoint_serial_SOURCE, $oEndpoint_serial_DESTINATION, $oElectrum_STATS, $SOURCE_filePath)){

                            $this->is_transferred = true;

                            //
                            // REMOVE TMP FILE
                            if(file_exists($tmp_dest_tmp_filePath)){

                                //
                                // REMOVE FILE
                                unlink($tmp_dest_tmp_filePath);
                            }

                        }else{

                            $error = error_get_last();
                            self::$oCRNRSTN_USR->error_log('oWheel fileMove_DF() ERROR :: AFTER SUCCESS @ fileMove_FD() :: '.$error['message'], __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

                            //
                            // REMOVE TMP FILE
                            if(file_exists($tmp_dest_tmp_filePath)){

                                //
                                // REMOVE FILE
                                unlink($tmp_dest_tmp_filePath);
                            }

                        }

                    }else{

                        self::$oCRNRSTN_USR->error_log('oWheel TMP file write TO FTP ERROR', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

                        //
                        // REMOVE TMP FILE
                        if(file_exists($tmp_dest_tmp_filePath)){

                            //
                            // REMOVE FILE
                            unlink($tmp_dest_tmp_filePath);

                        }

                    }

                }

                break;
            case 'DF':

                if(!$this->isExcluded){

                    $oLightning_ftp_conn_DESTINATION = $hot_dest_connection_ARRAY['oLightning_ftp_conn'];
                    $dest_ftp_stream = $oLightning_ftp_conn_DESTINATION->return_ftp_stream();

                    if($this->fileMove_DF($dest_ftp_stream, $SOURCE_filePath, $oEndpoint_serial_SOURCE, $oEndpoint_serial_DESTINATION, $oElectrum_STATS)){

                        $this->is_transferred = true;

                    }

                }

                break;
            case 'FD':

                if(!$this->isExcluded) {

                    $oLightning_ftp_conn_SOURCE = $hot_src_connection_ARRAY['oLightning_ftp_conn'];
                    $src_ftp_stream = $oLightning_ftp_conn_SOURCE->return_ftp_stream();

                    #$tmp_stats_DESTINATION_ARRAY['FTP_DIR_PATH']
                    #$tmp_stats_DESTINATION_ARRAY['MKSUB_DIR']
                    #$tmp_stats_DESTINATION_ARRAY['DESTINATION_FILEPATH']

                    //$tmp_stats_DESTINATION_ARRAY = $oElectrum_STATS->return_FD_destination_stats_array($oEndpoint_serial_SOURCE, $oEndpoint_serial_DESTINATION, $SOURCE_filePath);
                    $tmp_stats_dest_path = $oElectrum_STATS->return_destination_stats_path($oEndpoint_serial_SOURCE, $oEndpoint_serial_DESTINATION);

                    # $SOURCE_filePath
                    //error_log('829 ['.$tmp_stats_dest_path.']['.$SOURCE_filePath.']');

                    $tmp_slashChar = $this->return_slashChar($tmp_stats_dest_path);
                    $tmp_path_explode_ARRAY = explode($tmp_slashChar, $tmp_stats_dest_path);
                    $tmp_sect_cnt = sizeof($tmp_path_explode_ARRAY);
                    $tmp_explode_DIR = $tmp_path_explode_ARRAY[$tmp_sect_cnt-2];

                    $tmp_filepath_cut_ARRAY = explode($tmp_explode_DIR, $SOURCE_filePath);
                    $tmp_stats_dest_path = rtrim($tmp_stats_dest_path, $tmp_slashChar);
                    $tmp_final_filepath = $tmp_stats_dest_path.$tmp_filepath_cut_ARRAY[1];
                    //error_log('839 - final move :: '.$tmp_final_filepath);
                    //die();
                    //
                    // FTP TO DIR
                    if($this->fileMove_FD($src_ftp_stream, $tmp_stats_dest_path, $SOURCE_filePath)){

                        //self::$oCRNRSTN_USR->error_log('oWheel :: 834*2=1668 count? [SOURCE_filePath='.$SOURCE_filePath.'][dest_LOCAL_DIR_PATH='.$dest_LOCAL_DIR_PATH.']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

                        $this->is_transferred = true;

                    }

                }

            break;
            case 'DD':

                if(!$this->isExcluded) {

                    if ($this->fileMove_DD($SOURCE_filePath, $this->DESTINATION_FILE_PATH)) {

                        $this->is_transferred = true;

                    }

                }

                break;

        }

        return $this->is_transferred;

    }

    private function removeLastDir($path){


        $pos_fslash = strpos($path,'/');

        if($pos_fslash !== false) {

            $slashChar = '/';

        }else{

            $pos_bslash = strpos($path,'\\');
            if($pos_bslash !== false) {

                $slashChar = '\\';

            }else{

                $slashChar = DIRECTORY_SEPARATOR;

            }

        }

        $tmp_strip_root_dir_ARRAY = explode($slashChar, $path);

        $tmp_new_path = '';
        $tmp_sect_cnt = sizeof($tmp_strip_root_dir_ARRAY);
        for($i=0;$i<$tmp_sect_cnt-2;$i++){

            $tmp_new_path .= $tmp_strip_root_dir_ARRAY[$i].$slashChar;

        }

        return $tmp_new_path;

    }

    public function receive_asset_meta($filePath, $oElectrum){

        $this->exclude_source_dir_from_copy = $oElectrum->return_moveSourceContentsOnly();

        $this->SOURCE_FILE_PATH = $filePath;

        if($this->queue_position<2){

            //self::$oCRNRSTN_USR->error_log('oWheel receive file path=>'.$this->SOURCE_FILE_PATH, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

        }

        //
        // FTP or LOCAL_DIR
        $connection_type_SOURCE = $this->oEndpoint_SOURCE->return_connection_type();

        if($this->queue_position<2) {

            //self::$oCRNRSTN_USR->error_log('oWheel connection_type[SOURCE]=>' . $connection_type_SOURCE, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

        }

        switch($connection_type_SOURCE){
            case 'FTP':

                if($this->queue_position<2) {

                    //self::$oCRNRSTN_USR->error_log('oWheel PROCESSING FTP ****', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

                }

                $this->SOURCE_FILE_NAME = basename($this->SOURCE_FILE_PATH);

                $this->SOURCE_LOCAL_DIR_PATH = $this->oEndpoint_SOURCE->return_FTP_DIR_PATH();

                if($this->queue_position<2) {

                    //self::$oCRNRSTN_USR->error_log('oWheel file_name=>' . $this->SOURCE_FILE_NAME, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');
                    //self::$oCRNRSTN_USR->error_log('oWheel FTP_dir_path=' . $this->SOURCE_LOCAL_DIR_PATH, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

                }

                //
                // FTP OR LOCAL_DIR
                $connection_type_DESTINATION = $this->oEndpoint_DESTINATION->return_connection_type();

                if($this->queue_position<2) {

                    //self::$oCRNRSTN_USR->error_log('oWheel connection_type[DESTINATION]=>' . $connection_type_DESTINATION, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

                }

                switch($connection_type_DESTINATION) {
                    case 'FTP':

                        $this->DESTINATION_DIR_PATH = $this->oEndpoint_DESTINATION->return_FTP_DIR_PATH();
                        $this->DESTINATION_MKDIR_PERMISSIONS_MODE = $this->oEndpoint_DESTINATION->return_FTP_MKDIR_MODE();

                        if($this->queue_position<2) {

                           // self::$oCRNRSTN_USR->error_log('oWheel destination('.$this->DESTINATION_MKDIR_PERMISSIONS_MODE.')_dir_path=>' . $this->DESTINATION_DIR_PATH, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');
                            //self::$oCRNRSTN_USR->error_log('oWheel destination timestamp_nom=>' . $this->timestamp_nom, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

                        }

                        break;
                    default:

                        $this->DESTINATION_DIR_PATH = $this->oEndpoint_DESTINATION->return_LOCAL_DIR_PATH();
                        $this->DESTINATION_MKDIR_PERMISSIONS_MODE = $this->oEndpoint_DESTINATION->return_LOCAL_MKDIR_MODE();

                        if($this->queue_position<2) {

                            //self::$oCRNRSTN_USR->error_log('oWheel destination('.$this->DESTINATION_MKDIR_PERMISSIONS_MODE.')_dir_path=>' . $this->DESTINATION_DIR_PATH, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');
                            //self::$oCRNRSTN_USR->error_log('oWheel destination timestamp_nom=>' . $this->timestamp_nom, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

                        }

                        break;
                }

                $tmp_source_root_ARRAY = explode( '/', $this->SOURCE_LOCAL_DIR_PATH);

                $tmp_loop_size = sizeof($tmp_source_root_ARRAY);
                $tmp_proj_name_dir = $tmp_source_root_ARRAY[($tmp_loop_size-2)];

                if($this->queue_position<2) {

                    //self::$oCRNRSTN_USR->error_log('oWheel [oEndpoint_DESTINATION] tmp_proj_name_dir=>' . $tmp_proj_name_dir, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

                }

                $tmp_trimmed_file_path = str_replace($this->SOURCE_LOCAL_DIR_PATH, "", $this->SOURCE_FILE_PATH);
                //self::$oCRNRSTN_USR->error_log('oWheel tmp_trimmed_file_path PATH=>'.$tmp_trimmed_file_path, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_RUN_IT');
                //self::$oCRNRSTN_USR->error_log('oWheel [oEndpoint_DESTINATION] tmp_proj_name_dir=>' . $tmp_proj_name_dir, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_RUN_IT');

                $tmp_trimmed_file_path = str_replace($this->SOURCE_FILE_NAME, "", $tmp_trimmed_file_path);
                //self::$oCRNRSTN_USR->error_log('oWheel tmp_trimmed_file_path PATH=>'.$tmp_trimmed_file_path, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_RUN_IT');
                //self::$oCRNRSTN_USR->error_log('oWheel [oEndpoint_DESTINATION] tmp_proj_name_dir=>' . $tmp_proj_name_dir, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_RUN_IT');

                $tmp_trimmed_file_path = ltrim($tmp_trimmed_file_path, '/');

                if($tmp_trimmed_file_path!=''){

                    $tmp_trimmed_file_path = rtrim($tmp_trimmed_file_path, '/') . '/';

                }

                //self::$oCRNRSTN_USR->error_log('oWheel tmp_trimmed_file_path PATH=>'.$tmp_trimmed_file_path, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_RUN_IT');

                $dest_dir_path = rtrim($this->DESTINATION_DIR_PATH, '/') . '/';

                if($this->queue_position<2){

                    //self::$oCRNRSTN_USR->error_log('oWheel tmp_trimmed_file_path PATH=>'.$tmp_trimmed_file_path, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

                }

                if($this->oEndpoint_DESTINATION->return_flatten_all_files()){

                    $this->DESTINATION_FILE_PATH = $dest_dir_path.$tmp_proj_name_dir."/".$this->SOURCE_FILE_NAME;
                    $this->DESTINATION_FILE_PATH_ROOT = $dest_dir_path.$tmp_proj_name_dir;

                    if($this->queue_position<2){

                        //self::$oCRNRSTN_USR->error_log('oWheel FLATTEN ALL FILES :: PATH=>'.$this->DESTINATION_FILE_PATH, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

                    }

                }else{

                    if($this->timestamp_nom!=''){

                        if($this->exclude_source_dir_from_copy){

                            $this->DESTINATION_FILE_PATH = $dest_dir_path.$this->timestamp_nom."/".$tmp_trimmed_file_path.$this->SOURCE_FILE_NAME;
                            $this->DESTINATION_FILE_PATH_ROOT = $dest_dir_path.$this->timestamp_nom."/".$tmp_trimmed_file_path;

                        }else{

                            $this->DESTINATION_FILE_PATH = $dest_dir_path.$this->timestamp_nom."/".$tmp_proj_name_dir."/".$tmp_trimmed_file_path.$this->SOURCE_FILE_NAME;
                            $this->DESTINATION_FILE_PATH_ROOT = $dest_dir_path.$this->timestamp_nom."/".$tmp_proj_name_dir."/".$tmp_trimmed_file_path;

                        }

                    }else{

                        if($this->exclude_source_dir_from_copy){

                            $this->DESTINATION_FILE_PATH = $dest_dir_path.$tmp_trimmed_file_path.$this->SOURCE_FILE_NAME;
                            $this->DESTINATION_FILE_PATH_ROOT = $dest_dir_path;

                        }else{

                            $this->DESTINATION_FILE_PATH = $dest_dir_path.$tmp_proj_name_dir."/".$tmp_trimmed_file_path.$this->SOURCE_FILE_NAME;
                            $this->DESTINATION_FILE_PATH_ROOT = $dest_dir_path.$tmp_proj_name_dir."/".$tmp_trimmed_file_path;

                        }

                        if($this->queue_position<20){

                            //self::$oCRNRSTN_USR->error_log('oWheel [NO DATESTAMP VERSIONING] :: destination_file=>'.$this->DESTINATION_FILE_PATH, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

                        }

                    }

                }

                if($this->queue_position<2) {

                    //self::$oCRNRSTN_USR->error_log('oWheel Destination(' . $this->DESTINATION_MKDIR_PERMISSIONS_MODE . ') File=>' . $this->DESTINATION_FILE_PATH, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

                }

                break;
            default:

                //
                // SOURCE && DIRECTORY
                $this->SOURCE_FILE_NAME = basename($this->SOURCE_FILE_PATH);
                $this->SOURCE_LOCAL_DIR_PATH = $this->oEndpoint_SOURCE->return_LOCAL_DIR_PATH();

                /*

                protected $source_file_size_at_path_ARRAY = array();
                protected $source_file_lastaccess_at_path_ARRAY = array();
                protected $source_file_lastmodify_at_path_ARRAY = array();
                protected $source_file_blocksize_at_path_ARRAY = array();
                protected $source_file_blockallocate_at_path_ARRAY = array();
                protected $source_file_fullpermissions_at_path_ARRAY = array();
                protected $source_file_octalpermissions_at_path_ARRAY = array();
                protected $source_file_uid_STRING_at_path_ARRAY = array();
                protected $source_file_gid_STRING_at_path_ARRAY = array();

                */

                if($this->queue_position<2) {

                    //self::$oCRNRSTN_USR->error_log('oWheel file_name=>' . $this->SOURCE_FILE_NAME, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');
                    //self::$oCRNRSTN_USR->error_log('oWheel local_dir_path=' . $this->SOURCE_LOCAL_DIR_PATH, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

                }

                $connection_type_DESTINATION = $this->oEndpoint_DESTINATION->return_connection_type();

                if($this->queue_position<2) {

                    //self::$oCRNRSTN_USR->error_log('oWheel connection_type[DESTINATION]=>' . $connection_type_DESTINATION, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

                }

                switch($connection_type_DESTINATION) {
                    case 'FTP':

                        $this->DESTINATION_DIR_PATH = $this->oEndpoint_DESTINATION->return_FTP_DIR_PATH();
                        $this->DESTINATION_MKDIR_PERMISSIONS_MODE = $this->oEndpoint_DESTINATION->return_FTP_MKDIR_MODE();

                        if($this->queue_position<2) {

                            //self::$oCRNRSTN_USR->error_log('oWheel destination('.$this->DESTINATION_MKDIR_PERMISSIONS_MODE.')_dir_path=>' . $this->DESTINATION_DIR_PATH, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');
                            //self::$oCRNRSTN_USR->error_log('oWheel timestamp_nom=>' . $this->timestamp_nom, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

                        }

                        break;
                    default:

                        $this->DESTINATION_DIR_PATH = $this->oEndpoint_DESTINATION->return_LOCAL_DIR_PATH();
                        $this->DESTINATION_MKDIR_PERMISSIONS_MODE = $this->oEndpoint_DESTINATION->return_LOCAL_MKDIR_MODE();

                        if($this->queue_position<2) {

                            //self::$oCRNRSTN_USR->error_log('oWheel destination('.$this->DESTINATION_MKDIR_PERMISSIONS_MODE.')_dir_path=>' . $this->DESTINATION_DIR_PATH, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');
                            //self::$oCRNRSTN_USR->error_log('oWheel timestamp_nom=>' . $this->timestamp_nom, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

                        }

                        break;
                }

                $tmp_source_root_ARRAY = explode( '/', $this->SOURCE_LOCAL_DIR_PATH);

                $tmp_loop_size = sizeof($tmp_source_root_ARRAY);
                $tmp_proj_name_dir = $tmp_source_root_ARRAY[($tmp_loop_size-2)];

                if($this->queue_position<2) {

                   //self::$oCRNRSTN_USR->error_log('oWheel [oEndpoint_DESTINATION] tmp_proj_name_dir=>' . $tmp_proj_name_dir, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

                }

                $tmp_trimmed_file_path = str_replace($this->SOURCE_LOCAL_DIR_PATH, "", $this->SOURCE_FILE_PATH);
                $tmp_trimmed_file_path = str_replace($this->SOURCE_FILE_NAME, "", $tmp_trimmed_file_path);

                $tmp_trimmed_file_path = ltrim($tmp_trimmed_file_path, '/');

                if($tmp_trimmed_file_path!=''){

                    $tmp_trimmed_file_path = rtrim($tmp_trimmed_file_path, '/') . '/';

                }

                $dest_dir_path = rtrim($this->DESTINATION_DIR_PATH, '/') . '/';

                if($this->oEndpoint_DESTINATION->return_flatten_all_files()){

                    if($this->exclude_source_dir_from_copy){

                        $this->DESTINATION_FILE_PATH = $dest_dir_path.$this->SOURCE_FILE_NAME;
                        $this->DESTINATION_FILE_PATH_ROOT = $dest_dir_path;


                    }else{

                        $this->DESTINATION_FILE_PATH = $dest_dir_path.$this->SOURCE_FILE_NAME;
                        $this->DESTINATION_FILE_PATH_ROOT = $dest_dir_path;

                    }

                    if($this->queue_position<2){

                        //self::$oCRNRSTN_USR->error_log('oWheel FLATTEN ALL FILES :: PATH=>'.$this->DESTINATION_FILE_PATH, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

                    }

                }else{

                    if($this->timestamp_nom!=''){

                        if($this->exclude_source_dir_from_copy) {

                            $this->DESTINATION_FILE_PATH = $dest_dir_path.$this->timestamp_nom."/".$tmp_trimmed_file_path.$this->SOURCE_FILE_NAME;
                            $this->DESTINATION_FILE_PATH_ROOT = $dest_dir_path.$this->timestamp_nom."/".$tmp_trimmed_file_path;

                        }else{

                            $this->DESTINATION_FILE_PATH = $dest_dir_path.$this->timestamp_nom."/".$tmp_proj_name_dir."/".$tmp_trimmed_file_path.$this->SOURCE_FILE_NAME;
                            $this->DESTINATION_FILE_PATH_ROOT = $dest_dir_path.$this->timestamp_nom."/".$tmp_proj_name_dir."/".$tmp_trimmed_file_path;

                        }

                    }else{

                        if($this->exclude_source_dir_from_copy) {

                            $this->DESTINATION_FILE_PATH = $dest_dir_path.$tmp_trimmed_file_path.$this->SOURCE_FILE_NAME;
                            $this->DESTINATION_FILE_PATH_ROOT = $dest_dir_path.$tmp_trimmed_file_path;

                        }else{

                            $this->DESTINATION_FILE_PATH = $dest_dir_path.$tmp_proj_name_dir."/".$tmp_trimmed_file_path.$this->SOURCE_FILE_NAME;
                            $this->DESTINATION_FILE_PATH_ROOT = $dest_dir_path.$tmp_proj_name_dir."/".$tmp_trimmed_file_path;

                        }

                    }

                }

                break;

        }

        //self::$oCRNRSTN_USR->error_log('oWheel :: DESTINATION_FILE_PATH...ROOT=>'.$this->DESTINATION_FILE_PATH.'...'.$this->DESTINATION_FILE_PATH_ROOT, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

        $this->connection_type_SOURCE = $connection_type_SOURCE;
        $this->connection_type_DESTINATION = $connection_type_DESTINATION;

    }

    #private function mkdir_r($dirName, $rights=0777){
    // SOURCE :: http://php.net/manual/en/function.mkdir.php
    // AUTHOR :: http://php.net/manual/en/function.mkdir.php#68207
    private function mkdir_r($dirName){
        try{
            $mode = $this->DESTINATION_MKDIR_PERMISSIONS_MODE;
            $mode = octdec( str_pad($mode,4,'0',STR_PAD_LEFT) );
            $mode = (int)$mode;

            if(!file_exists($dirName)){

                $dirs = explode('/', $dirName);
                $dir='';
                foreach ($dirs as $part) {
                    $dir.=$part.'/';
                    if (!is_dir($dir) && strlen($dir)>0) {
                        if (!@mkdir($dir, $mode)) {

                            $error = error_get_last();
                            $pos_err_to_suppress = strpos(strtolower($error['message']), 'file exists');

                            if($pos_err_to_suppress === false) {
                                throw new Exception('CRNRSTN :: mkdir_r() failed to mkdir :: ' . $dir . ' :: ' . $error['message']);
                            }
                        }
                    }
                }
            }

            return true;

        }catch( Exception $e ) {

            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;
        }
    }

    // SOURCE :: http://ee1.php.net/manual/en/function.ftp-mkdir.php
    // AUTHOR :: http://ee1.php.net/manual/en/function.ftp-mkdir.php#112399
    private function ftp_mksubdirs($ftpcon, $ftpbasedir, $ftpath){

        $mk_subdir_complete = false;

        @ftp_chdir($ftpcon, $ftpbasedir); // /var/www/uploads
        $parts = explode('/',$ftpath); // 2013/06/11/username
        //$mode = "777";
        //$mode = octdec( str_pad($mode,4,'0',STR_PAD_LEFT) );
        //$mode = (int)$mode;

        foreach($parts as $part){
            if(!@ftp_chdir($ftpcon, $part)) {

                if ($part != "") {

                    if (!isset($destination_directory_flag[$ftpath . $part])) {
                        if (!ftp_mkdir($ftpcon, $part)) {

                            $error = error_get_last();
                            self::$oCRNRSTN_USR->error_log('oWheel :: ftp_mkdir ERROR=>'.$error['message'].' on ['.$ftpbasedir.']['.$ftpath.']['.$part.']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

                        } else {

                            $destination_directory_flag[$ftpath . $part] = 1;
                            //self::$oCRNRSTN_USR->error_log('oWheel :: ftp_mkdir SUCCESS on ['.$ftpbasedir.']['.$ftpath.']['.$part.']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');
                            $mk_subdir_complete = true;
                        }

                    } else {

                        //self::$oCRNRSTN_USR->error_log('oWheel :: ftp_mkdir SUPPRESSED', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');
                        $mk_subdir_complete = true;

                    }

                    if (!ftp_chdir($ftpcon, $part)) {

                        $error = error_get_last();
                        self::$oCRNRSTN_USR->error_log('oWheel :: ftp_chdir ERROR ['.$error['message'].'] on ['.$ftpbasedir.']['.$ftpath.']['.$part.']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

                    } else {

                        //self::$oCRNRSTN_USR->error_log('oWheel :: ftp_chdir SUCCESS on ['.$ftpbasedir.']['.$ftpath.']['.$part.']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');
                        $mk_subdir_complete = true;
                    }

                    /*
                    if (!ftp_chmod($ftpcon, $mode, $part)) {
                        $error = error_get_last();
                        echo "<br><br>" . $error['message'] . " on [" . $ftpbasedir . "][" . $ftpath . "][".$part."]<br><br>";

                    } else {
                        echo "<br>ftp_chmod GOOD.  on [" . $ftpbasedir . "][" . $ftpath . "][".$part."]<br>";
                    }
                    */
                }
            }
        }

        return $mk_subdir_complete;

    }

    public function __destruct() {

    }

}

# # C # R # N # R # S # T # N # : : # # ##
#
#  CLASS :: crnrstn_lightning_bolt
#  VERSION :: 1.00.0000
#  DATE :: September 13, 2020 @ 0806hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: A meta-data wrangler object for an Electrum :: configured endpoint that CRNRSTN :: knows a thing or two about.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#  Ezekiel 1:14 - AND THE LIVING CREATURES RAN TO AND FRO LIKE THE APPEARANCE OF A LIGHTNING BOLT.
#
class crnrstn_lightning_bolt{

    protected $oLogger;
    private static $oCRNRSTN_USR;

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

        $this->start_time_micro = $oCRNRSTN_USR->get_micro_time();
        $this->start_time_timestamp = $oCRNRSTN_USR->return_queryDateTimeStamp();
        $this->elapsed_time_at_start = $oCRNRSTN_USR->wall_time();

        self::$oCRNRSTN_USR = $oCRNRSTN_USR;

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(self::$oCRNRSTN_USR->CRNRSTN_debugMode, __CLASS__, self::$oCRNRSTN_USR->log_silo_profile, self::$oCRNRSTN_USR);

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

        return self::$oCRNRSTN_USR->get_resource('FTP_SERVER', $this->ftp_oWCR_key);

    }

    public function return_FTP_USERNAME(){

        return self::$oCRNRSTN_USR->get_resource('FTP_USERNAME', $this->ftp_oWCR_key);

    }

    public function return_FTP_PASSWORD(){

        return self::$oCRNRSTN_USR->get_resource('FTP_PASSWORD', $this->ftp_oWCR_key);

    }

    public function return_FTP_PORT(){

        return self::$oCRNRSTN_USR->get_resource('FTP_PORT', $this->ftp_oWCR_key);

    }

    public function return_FTP_TIMEOUT(){

        return self::$oCRNRSTN_USR->get_resource('FTP_TIMEOUT', $this->ftp_oWCR_key);

    }

    public function return_FTP_IS_SSL(){

        return self::$oCRNRSTN_USR->get_resource('FTP_IS_SSL', $this->ftp_oWCR_key);

    }

    public function return_FTP_USE_PASV(){

        return self::$oCRNRSTN_USR->get_resource('FTP_USE_PASV', $this->ftp_oWCR_key);

    }

    public function return_FTP_USE_PASV_ADDR(){

        return self::$oCRNRSTN_USR->get_resource('FTP_USE_PASV_ADDR', $this->ftp_oWCR_key);

    }

    public function return_FTP_DISABLE_AUTOSEEK(){

        return self::$oCRNRSTN_USR->get_resource('FTP_DISABLE_AUTOSEEK', $this->ftp_oWCR_key);

    }

    public function return_FTP_DIR_PATH(){

        return self::$oCRNRSTN_USR->get_resource('FTP_DIR_PATH', $this->ftp_oWCR_key);

    }

    public function return_FTP_MKDIR_MODE(){

        if($this->ftp_mkdir_mode!=''){

            return $this->ftp_mkdir_mode;

        }else{

            if($this->flow_type!='SOURCE') {

                $this->ftp_mkdir_mode = self::$oCRNRSTN_USR->get_resource('FTP_MKDIR_MODE', $this->ftp_oWCR_key);

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

        }catch( Exception $e ) {

            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
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

        $this->SOURCE_LOCAL_DIR_PATH = self::$oCRNRSTN_USR->get_resource('LOCAL_DIR_PATH', $this->local_oWCR_key);

        $this->log_connection_status('ready');

    }

    public function initialize_source_FTP_WCR_meta($WildCardResource_key){

        $this->flow_type = 'SOURCE';                    # SOURCE, DESTINATION
        $this->connection_type = 'FTP';
        $this->data_type = 'CRNRSTN_WCR';

        $this->ftp_oWCR_key = $WildCardResource_key;

        $this->ftp_dir_path = self::$oCRNRSTN_USR->get_resource('FTP_DIR_PATH', $this->ftp_oWCR_key);

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

        $this->local_mkdir_mode = self::$oCRNRSTN_USR->get_resource('LOCAL_MKDIR_MODE', $this->local_oWCR_key);

        $this->SOURCE_LOCAL_DIR_PATH = self::$oCRNRSTN_USR->get_resource('LOCAL_DIR_PATH', $this->local_oWCR_key);

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

        $this->local_mkdir_mode = self::$oCRNRSTN_USR->get_resource('LOCAL_MKDIR_MODE', $this->local_oWCR_key);

        $this->SOURCE_LOCAL_DIR_PATH = self::$oCRNRSTN_USR->get_resource('LOCAL_DIR_PATH', $this->local_oWCR_key);

        $this->log_connection_status('ready');

    }

    public function initialize_destination_FTP_WCR_meta($WildCardResource_key){

        $this->flow_type = 'DESTINATION';
        $this->connection_type = 'FTP';
        $this->data_type = 'CRNRSTN_WCR';

        $this->ftp_oWCR_key = $WildCardResource_key;

        $this->ftp_mkdir_mode = self::$oCRNRSTN_USR->get_resource('FTP_MKDIR_MODE', $this->ftp_oWCR_key);
        self::$oCRNRSTN_USR->error_log('CRNRSTN :: FTP DESTINATION MODE ['.$this->ftp_mkdir_mode.']', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $this->ftp_dir_path = self::$oCRNRSTN_USR->get_resource('FTP_DIR_PATH', $this->ftp_oWCR_key);

        $this->log_connection_status('ready');

    }

    public function initialize_flattenedDestinationFTP_WCR_meta($WildCardResource_key){

        $this->flatten_all_files = true;
        $this->flow_type = 'DESTINATION';
        $this->connection_type = 'FTP';
        $this->data_type = 'CRNRSTN_WCR';

        $this->ftp_oWCR_key = $WildCardResource_key;

        $this->ftp_mkdir_mode = self::$oCRNRSTN_USR->get_resource('FTP_MKDIR_MODE', $this->ftp_oWCR_key);
        self::$oCRNRSTN_USR->error_log('CRNRSTN :: FTP DESTINATION MODE ['.$this->ftp_mkdir_mode.']', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $this->ftp_dir_path = self::$oCRNRSTN_USR->get_resource('FTP_DIR_PATH', $this->ftp_oWCR_key);

        $this->log_connection_status('ready');

    }

    public function log_connection_status($str){

        $this->connection_status = $str;
        $this->connection_status_log[] = $str;
    }

    public function __destruct() {

    }

}

# # C # R # N # R # S # T # N # : : # # ##
#
#  CLASS :: crnrstn_lightning_ftp_conn
#  VERSION :: 2.00.0000
#  DATE :: November 10, 2018 @ 1730hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: An SFTP/FTP connection.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#  Ezekiel 1:13b - AND THE FIRE WAS BRIGHT; AND OUT OF THE FIRE WENT FORTH LIGHTENING.
#
class crnrstn_lightning_ftp_conn{

    protected $oLogger;
    private static $oCRNRSTN_USR;

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

        self::$oCRNRSTN_USR = $oCRNRSTN_USR;

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(self::$oCRNRSTN_USR->CRNRSTN_debugMode, __CLASS__, self::$oCRNRSTN_USR->log_silo_profile, self::$oCRNRSTN_USR);

        $this->start_time_micro = self::$oCRNRSTN_USR->get_micro_time();
        $this->start_time_timestamp = self::$oCRNRSTN_USR->return_queryDateTimeStamp();
        $this->elapsed_time_at_start = self::$oCRNRSTN_USR->wall_time();

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

                $this->log_connection_status('error :: setting option ['.$option.'] to value ['.$value.']');

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('An error was experienced while setting option ['.$option.'] to value ['.$value.'] for ftp connection with '.$this->ftp_server.' at '.$this->ftp_port.'.');

            }

        }catch( Exception $e ) {

            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

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
        self::$oCRNRSTN_USR->error_log('Electrum ESTABLISHING FTP CONNECTION.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        //
        // ESTABLISH AND RETURN FTP CONNECTION
        try{

            $tmp_option = ' ';

            if($this->ftp_is_ssl){
                self::$oCRNRSTN_USR->error_log('SSL CONNECT.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                $this->ftp_conn_id = ftp_ssl_connect($this->ftp_server, $this->ftp_port, $this->ftp_timeout);

            }else{
                self::$oCRNRSTN_USR->error_log('NON-SSL CONNECT.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                $this->ftp_conn_id = ftp_connect ($this->ftp_server, $this->ftp_port, $this->ftp_timeout);

            }

            if(!$this->ftp_conn_id){

                if($this->ftp_is_ssl){

                    $tmp_option = ' secure ';
                }

                $this->log_connection_status('error :: connection initialization');

                self::$oCRNRSTN_USR->error_log('CONNECTION ERROR.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('An error was experienced while attempting to open a'.$tmp_option.'FTP connection with '.$this->ftp_server.' at '.$this->ftp_port.'.');

            }else{

                $this->ftp_login_result = ftp_login($this->ftp_conn_id, $this->ftp_username, $this->ftp_password);

                if(!$this->ftp_login_result){
                    self::$oCRNRSTN_USR->error_log('LOGIN ERROR.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                    $this->log_connection_status('error :: connection login authorization');

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('An error was experienced while attempting to log into an open'.$tmp_option.'FTP connection with '.$this->ftp_server.'::'.$this->ftp_username.' at '.$this->ftp_port.'.');

                }else{

                    $this->start_time_micro = self::$oCRNRSTN_USR->get_micro_time();
                    $this->start_time_timestamp = self::$oCRNRSTN_USR->return_queryDateTimeStamp();
                    $this->elapsed_time_at_start = self::$oCRNRSTN_USR->wall_time();

                    $this->log_connection_status('ready');

                    self::$oCRNRSTN_USR->error_log('Electrum FTP CONNECTION SUCCESS for '.$this->ftp_username.'!', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                }

            }

        } catch( Exception $e ) {

            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
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
                throw new Exception('An error was experienced while enabling passive mode for ftp connection with '.$this->ftp_server.' at '.$this->ftp_port.'.');

            }

        }catch( Exception $e ) {

            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

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

# # C # R # N # R # S # T # N # : : # # ##
#
#  CLASS :: crnrstn_fire_ftp_manager
#  VERSION :: 2.00.0000
#  DATE :: November 10, 2018 @ 1718HRS
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: An SFTP/FTP connection manager.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#  Ezekiel 1:5a - AND FROM THE MIDST OF IT [FIRE] THERE CAME THE LIKENESS OF FOUR LIVING CREATURES.
#
class crnrstn_fire_ftp_manager {

    protected $oLogger;
    private static $oCRNRSTN_USR;

    public $lightning_FTP_conn_ARRAY = array();

    public function __construct($oCRNRSTN_USR){

        self::$oCRNRSTN_USR = $oCRNRSTN_USR;

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(self::$oCRNRSTN_USR->CRNRSTN_debugMode, __CLASS__, self::$oCRNRSTN_USR->log_silo_profile, self::$oCRNRSTN_USR);

        self::$oCRNRSTN_USR->error_log('NEW FOUR LIVING CREATURES INSTANTIATED.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

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

        $tmp_FTP_SERVER_WCR = self::$oCRNRSTN_USR->get_resource('FTP_SERVER', $endpoint_data);
        $tmp_FTP_USERNAME_WCR = self::$oCRNRSTN_USR->get_resource('FTP_USERNAME', $endpoint_data);
        $tmp_FTP_PASSWORD_WCR = self::$oCRNRSTN_USR->get_resource('FTP_PASSWORD', $endpoint_data);
        $tmp_FTP_PORT_WCR = self::$oCRNRSTN_USR->get_resource('FTP_PORT', $endpoint_data);
        $tmp_FTP_TIMEOUT_WCR = self::$oCRNRSTN_USR->get_resource('FTP_TIMEOUT', $endpoint_data);
        $tmp_FTP_IS_SSL_WCR = self::$oCRNRSTN_USR->get_resource('FTP_IS_SSL', $endpoint_data);
        $tmp_FTP_USE_PASV_WCR = self::$oCRNRSTN_USR->get_resource('FTP_USE_PASV', $endpoint_data);
        $tmp_FTP_USE_PASV_ADDR_WCR = self::$oCRNRSTN_USR->get_resource('FTP_USE_PASV_ADDR', $endpoint_data);
        $tmp_FTP_DISABLE_AUTOSEEK_WCR = self::$oCRNRSTN_USR->get_resource('FTP_DISABLE_AUTOSEEK', $endpoint_data);

        //$tmp_endpoint_id = md5($tmp_FTP_SERVER_WCR.$tmp_FTP_USERNAME_WCR.$tmp_FTP_PASSWORD_WCR.$tmp_FTP_PORT_WCR);

        try{

            // DO WE HAVE EXISTING CONNECTION FOR THIS ENDPOINT
            if(isset($this->lightning_FTP_conn_ARRAY[$endpoint_id])){

                //
                // CONSIDER A PING FOR $oLightning_conn AS IN if($oLightning_conn->conn_ping(ftp_conn)){ Proceed...
                //return $this->lightning_FTP_conn_ARRAY[$tmp_endpoint_serial];
                self::$oCRNRSTN_USR->error_log('FOUR LIVING CREATURES - EXISTING CONN ALREADY.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                //return $tmp_endpoint_serial;

            }else{

                /*
                 *
                // CONFIRM THAT THERE ARE NOT TOO MANY FTP CONNECTIONS ALREADY
                //if($this->too_many_connections($endpoint_id, $oElectrum, $oDATA, $oDB_RESP)){
                //    $this->transaction_status = 'Too many active connections to this endpoint. Connection attempt suppressed.';
                //    return false;
                }*/

                $oLightning_conn = new crnrstn_lightning_ftp_conn(self::$oCRNRSTN_USR);
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

        } catch( Exception $e ) {

            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

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
                        $tmp_FTP_DIR_PATH_WCR = self::$oCRNRSTN_USR->get_resource('FTP_DIR_PATH', $endpoint_data);
                        $tmp_FTP_SERVER_WCR = self::$oCRNRSTN_USR->get_resource('FTP_SERVER', $endpoint_data);

                        //
                        // WE HAVE ESTABLISHED A VALID FTP CONN TO A SOURCE
                        // JUST VERIFY THAT YOU CAN READ.
                        $oLightning_ftp_conn =  $this->lightning_FTP_conn_ARRAY[$endpoint_id];
                        $tmp_ftp_conn = $oLightning_ftp_conn->return_ftp_stream();
                        $tmp_config_serial = self::$oCRNRSTN_USR->return_config_serial();

                        $_SESSION['CRNRSTN_' . self::$oCRNRSTN_USR->crcINT($tmp_config_serial)]['CRNRSTN_EXCEPTION_PREFIX'] = 'The CRNRSTN :: Electrum process has experienced permissions related error as the '.$tmp_FTP_SERVER_WCR.' SOURCE FTP directory, '.$tmp_FTP_DIR_PATH_WCR.', is NOT readable by ftp_nlist() ';
                        $endpoint_contents = ftp_nlist($tmp_ftp_conn, $tmp_FTP_DIR_PATH_WCR);
                        $_SESSION['CRNRSTN_' . self::$oCRNRSTN_USR->crcINT($tmp_config_serial)]['CRNRSTN_EXCEPTION_PREFIX'] = '';

                        if($endpoint_contents){
                            $tmp_read_permissions = true;

                        }

                        if($tmp_read_permissions){

                            //self::$oCRNRSTN_USR->error_log('Electrum FTP SUCCESS ON READ PERMISSIONS!', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                            $oLightning_ftp_conn->isValid = true;
                            $this->lightning_FTP_conn_ARRAY[$endpoint_id] = $oLightning_ftp_conn;

                            return true;

                        }else{

                            $tmp_FTP_SERVER_WCR = self::$oCRNRSTN_USR->get_resource('FTP_SERVER', $endpoint_data);
                            $tmp_FTP_USERNAME_WCR = self::$oCRNRSTN_USR->get_resource('FTP_USERNAME', $endpoint_data);
                            $tmp_FTP_PORT_WCR = self::$oCRNRSTN_USR->get_resource('FTP_PORT', $endpoint_data);

                            $oLightning_ftp_conn->isValid = false;
                            $this->lightning_FTP_conn_ARRAY[$endpoint_id] = $oLightning_ftp_conn;

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('Unable to read ['.$tmp_FTP_DIR_PATH_WCR.'] from FTP endpoint '.$tmp_FTP_SERVER_WCR.'::'.$tmp_FTP_USERNAME_WCR.' on port '.$tmp_FTP_PORT_WCR.'.');

                        }

                        break;
                    default:
                        //
                        // DESTINATION FTP
                        self::$oCRNRSTN_USR->error_log('TODO :: Consider FTP destination preload integrity validation check...', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);
                        $oLightning_ftp_conn =  $this->lightning_FTP_conn_ARRAY[$endpoint_id];
                        $oLightning_ftp_conn->isValid = true;
                        $this->lightning_FTP_conn_ARRAY[$endpoint_id] = $oLightning_ftp_conn;

                        return true;

                        break;

                }

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function __destruct() {

    }

}