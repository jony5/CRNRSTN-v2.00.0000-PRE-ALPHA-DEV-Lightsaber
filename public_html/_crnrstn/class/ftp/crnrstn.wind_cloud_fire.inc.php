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
# # C # R # N # R # S # T # N # : : # # ##
#
#  CLASS :: crnrstn_wind_cloud_fire
#  VERSION :: 2.00.0000
#  DATE :: November 9, 2018 @ 1117hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: A robust SFTP/FTP/LOCAL_DIR file mover. This is Electrum ::.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#  EZEKIEL 1:4 - AND I LOOKED, AND THERE CAME A STORM WIND FROM THE NORTH, A GREAT CLOUD AND A FIRE
#  FLASHING INCESSANTLY; AND THERE WAS A BRIGHTNESS AROUND IT, AND FROM THE MIDST OF IT
#  THERE WAS SOMETHING LIKE THE SIGHT OF ELECTRUM, FROM THE MIDST OF THE FIRE.
#
class crnrstn_wind_cloud_fire {

    protected $oLogger;
    public $oCRNRSTN_USR;
    protected $oElectrum_STATS;
    private static $oFourLivingCreatures_FTP;
    protected $oLighting_bolt_ARRAY = array();
    protected $oWheel_high_awesome_ARRAY = array();

    public $electrum_process_id;
    protected $preload_spoiled_ARRAY = array();
    protected $preload_endpoint_validation_fail = array();
    protected $asset_transfer_suppression_ARRAY = array();
    protected $endpoint_isValid_ARRAY = array();
    protected $destination_transfer_cnt_ARRAY = array();
    protected $asset_suppressed_ARRAY = array();
    protected $processed_source_ARRAY = array();
    protected $processed_destination_ARRAY = array();
    protected $flag_source_ARRAY = array();
    protected $endpoint_ts_serial_sequence_ARRAY = array();

    protected $execute_to_destination_authorization;
    protected $execute_from_source_authorization;

    protected $queued_endpoint_ARRAY = array();
    protected $source_total_filesize_ARRAY = array();

    protected $FtpToFtp_tmp_dirPath;
    protected $timestamp_nom_pattern;
    protected $global_execute_authorization = true;
    protected $global_execute_authorization_reason = '';

    protected $directory_content_ARRAY = array();
    protected $directory_dir_content_ARRAY = array();

    protected $source_file_size_at_path_ARRAY = array();
    protected $source_file_lastaccess_at_path_ARRAY = array();
    protected $source_file_lastmodify_at_path_ARRAY = array();
    protected $source_file_blocksize_at_path_ARRAY = array();
    protected $source_file_blockallocate_at_path_ARRAY = array();
    protected $source_file_fullpermissions_at_path_ARRAY = array();
    protected $source_file_octalpermissions_at_path_ARRAY = array();
    protected $source_file_uid_STRING_at_path_ARRAY = array();
    protected $source_file_gid_STRING_at_path_ARRAY = array();
    protected $source_file_uid_INT_at_path_ARRAY = array();
    protected $source_file_gid_INT_at_path_ARRAY = array();

    protected $max_storage_utilization = 90;

    protected $ftp_recursive_sniffed_directory_ARRAY = array();

    protected $execution_batch_serial;

    protected $notifications_email_pipe_delim;
    protected $notifications_sender;
    protected $notifications_replyto_pipe_delim;
    protected $notifications_cc_pipe_delim;
    protected $notifications_bcc_pipe_delim;

    protected $notifications_profile;
    protected $notifications_SOAP_endpoint;
    protected $notifications_email_protocol;

    protected $secret_key_override;
    protected $cipher_override;
    protected $hmac_algorithm_override;
    protected $options_bitwise_override;

    protected $startTime;
    protected $endTime;
    protected $elapsedTime;

    protected $exclude_source_dir_from_copy = false;

    public function __construct($oCRNRSTN_USR, $FtpToFtp_tmp_dirPath, $timestamp_versioning_pattern){

        try{

            //
            // INSTANTIATE CRNRSTN_USR CLASS OBJECT
            $this->oCRNRSTN_USR = $oCRNRSTN_USR;

            //
            // INSTANTIATE LOGGER CLASS OBJECT
            $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN_USR);

            //
            // INSTANTIATE ELECTRUM STATISTICIAN
            $this->oElectrum_STATS = new crnrstn_electrum_the_statistician($oCRNRSTN_USR);

            $this->electrum_process_id = $this->oCRNRSTN_USR->generate_new_key(100);  // START_ELECTRUM_PROCESS_ID

            $this->startTime = $this->oCRNRSTN_USR->return_micro_time();

            $this->elapsedTime = $this->oCRNRSTN_USR->elapsed_delta_time_for('ELECTRUM_PERFORMANCE_CLIENT');

            //
            // BATCH EXECUTION SERIALIZATION
            $this->execution_batch_serial = $this->oCRNRSTN_USR->generate_new_key(100);

            $this->oElectrum_STATS->init_electrum($this->electrum_process_id, $this->execution_batch_serial, $this->startTime, $timestamp_versioning_pattern);

            $this->FtpToFtp_tmp_dirPath = $FtpToFtp_tmp_dirPath;
            $this->timestamp_nom_pattern = $timestamp_versioning_pattern;

            if($this->validate_DIR_endpoint('DESTINATION', $this->FtpToFtp_tmp_dirPath)){

                if($this->validate_DIR_endpoint('SOURCE', $this->FtpToFtp_tmp_dirPath)){


                }else{

                    $this->global_execute_authorization = false;
                    $this->global_execute_authorization_reason = 'ERR420.5 - Invalid read permissions at _tmp directory path passed to oCRNRSTN_USR->initElectrum_FileCopy().';

                    if(is_dir($this->FtpToFtp_tmp_dirPath)){

                        $tmp_current_perms = substr(decoct( fileperms($this->FtpToFtp_tmp_dirPath) ), 2);

                    }else{

                        $tmp_current_perms = 'invalid path';

                    }

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('The CRNRSTN :: Electrum constructor failed due to the provided temporary directory endpoint (' . $this->FtpToFtp_tmp_dirPath.') being an invalid source (' . $tmp_current_perms.') for temporary asset retrieval.');

                }

            }else{

                $this->global_execute_authorization = false;
                $this->global_execute_authorization_reason = 'ERR420.0 - Invalid write permissions at _tmp directory path passed to oCRNRSTN_USR->initElectrum_FileCopy().';

                if(is_dir($this->FtpToFtp_tmp_dirPath)){

                    $tmp_current_perms = substr(decoct( fileperms($this->FtpToFtp_tmp_dirPath) ), 2);

                }else{

                    $tmp_current_perms = 'invalid path';

                }

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('The CRNRSTN :: Electrum constructor failed due to the provided temporary directory endpoint (' . $this->FtpToFtp_tmp_dirPath.') being an invalid destination (' . $tmp_current_perms.') for temporary asset storage.');

            }

        }catch( Exception $e ) {

            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
            return false;

        }

    }

    public function copyFilesToFolder($custom_folder_name){

        $this->oElectrum_STATS->copyFilesToFolder($custom_folder_name);

    }

    public function return_moveSourceContentsOnly(){

        return $this->exclude_source_dir_from_copy;

    }

    public function moveContentInSourceDirOnly($excludeContainingDir){

        $this->exclude_source_dir_from_copy = $excludeContainingDir;
        $this->oElectrum_STATS->moveContentOnly($excludeContainingDir);

    }

    private function return_oElectrumPerfReportSOAP($execution_serial, $batch_serial){

        $this->secret_key_override = $this->oCRNRSTN_USR->return_secret_key_override($this->notifications_SOAP_endpoint);
        $this->cipher_override = $this->oCRNRSTN_USR->return_cipher_override($this->notifications_SOAP_endpoint);
        $this->hmac_algorithm_override = $this->oCRNRSTN_USR->return_hmac_algorithm_override($this->notifications_SOAP_endpoint);
        $this->options_bitwise_override = $this->oCRNRSTN_USR->return_options_bitwise_override($this->notifications_SOAP_endpoint);

        //error_log('155 - electrum notifications_email_pipe_delim=' . $this->notifications_email_pipe_delim);
        $tmp_RECIPIENT_ARRAY = $this->oCRNRSTN_USR->return_oEmailArraySOAP_struct($this->notifications_email_pipe_delim, NULL, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override);
        //error_log('157 electrum email array size = '.sizeof($tmp_RECIPIENT_ARRAY));
        if(isset($this->notifications_sender)){

            $tmp_SENDER_ARRAY = $this->oCRNRSTN_USR->return_oEmailArraySOAP_struct($this->notifications_sender, NULL, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override);

        }else{
            $tmp_SENDER_ARRAY = array();
        }

        if(isset($this->notifications_replyto_pipe_delim)){

            $tmp_REPLYTO_ARRAY = $this->oCRNRSTN_USR->return_oEmailArraySOAP_struct($this->notifications_replyto_pipe_delim, NULL, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override);

        }else{

            $tmp_REPLYTO_ARRAY = array();

        }

        if(isset($this->notifications_cc_pipe_delim)){

            $tmp_CC_ARRAY = $this->oCRNRSTN_USR->return_oEmailArraySOAP_struct($this->notifications_cc_pipe_delim, NULL, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override);

        }else{

            $tmp_CC_ARRAY = array();

        }

        if(isset($this->notifications_bcc_pipe_delim)){

            $tmp_BCC_ARRAY = $this->oCRNRSTN_USR->return_oEmailArraySOAP_struct($this->notifications_bcc_pipe_delim, NULL, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override);

        }else{

            $tmp_BCC_ARRAY = array();

        }

        $tmp_runtime = $this->oCRNRSTN_USR->wall_time();
        $tmp_microsecs_explode = explode(".", $tmp_runtime);

        $HTML_process_state_message = 'The <span style="font-weight: normal;">C<span style="color: #F90000;">R</span>NRSTN :: Electrum process has completed successfully.</span>';
        $TEXT_process_state_message = 'The CRNRSTN :: Electrum process has completed successfully.';

        $transfer_count = 0;
        $transfer_err_count = 0;
        $skipped_count = 0;
        $file_size = 0;
        $endpoint_validation_fail_count = 0;
        $transfer_error_trace_HTML = '';
        $transfer_error_trace_TEXT = '';
        $unique_auth_asset_filesize_at_source = 0;
        $unique_auth_asset_count_at_source = 0;

        foreach($this->preload_endpoint_validation_fail as $id => $is_fail_state){

            if($is_fail_state){

                $endpoint_validation_fail_count++;

            }

        }

        $total_asset_count = sizeof($this->oWheel_high_awesome_ARRAY[$execution_serial]);

        foreach($this->oWheel_high_awesome_ARRAY[$execution_serial] as $key => $wheel_high_awesome_eyes){

            $unique_auth_asset_count_at_source += $wheel_high_awesome_eyes->unique_asset_count_at_SOURCE;
            $unique_auth_asset_filesize_at_source += $wheel_high_awesome_eyes->unique_asset_filesize_at_SOURCE;

            if($wheel_high_awesome_eyes->is_transferred()){

                $transfer_count++;
                $file_size = $file_size + $wheel_high_awesome_eyes->return_filesize_bytes();

            }
            
            if($wheel_high_awesome_eyes->is_skipped()){

                $skipped_count++;
                
            }

            if($wheel_high_awesome_eyes->is_transfer_error()){

                $transfer_err_count++;

                $err_message = $wheel_high_awesome_eyes->transfer_error_message();

                $err_file = $wheel_high_awesome_eyes->return_filepath_SOURCE();
                $source_endpoint = $wheel_high_awesome_eyes->return_endpoint_SOURCE();
                $destination_endpoint = $wheel_high_awesome_eyes->return_endpoint_DESTINATION();

                $tmp_HTML = $err_message;
                $tmp_TEXT = $err_message.'
';

                $tmp_HTML = $this->oCRNRSTN_USR->proper_replace('{FTP_OR_LOCAL_DETAIL}', $destination_endpoint, $tmp_HTML);
                $tmp_TEXT = $this->oCRNRSTN_USR->proper_replace('{FTP_OR_LOCAL_DETAIL}', $destination_endpoint, $tmp_TEXT);

                $tmp_HTML_str = '';
                $tmp_TEXT_str = '';

                $tmp_HTML_ARRAY = $this->return_universalPathProperBreak($tmp_HTML,96,true, true);
                $tmp_TEXT_ARRAY = $this->return_universalPathProperBreak($tmp_TEXT,52);

                $transfer_error_trace_HTML .= '<div style="border-bottom: 15px solid #FFF;">' . $tmp_HTML_ARRAY['str'].'</div>';
                $transfer_error_trace_TEXT .= $tmp_TEXT_ARRAY['str'].'

';

            }

        }

        $tmp_HTML_ERR_TRACE = $this->return_CRNRSTN_SysMsgContent($execution_serial, $batch_serial, 'ELECTRUM_ERRORS_TRACE_HTML', 'HTML');
        $tmp_TEXT_ERR_TRACE = $this->return_CRNRSTN_SysMsgContent($execution_serial, $batch_serial, 'ELECTRUM_ERRORS_TRACE_TEXT');

        if($transfer_error_trace_HTML!=''){

            $tmp_HTML_ERR_TRACE = $this->oCRNRSTN_USR->proper_replace('{ERR_TRACE}', $transfer_error_trace_HTML, $tmp_HTML_ERR_TRACE);
            $tmp_TEXT_ERR_TRACE = $this->oCRNRSTN_USR->proper_replace('{ERR_TRACE}', $transfer_error_trace_TEXT, $tmp_TEXT_ERR_TRACE);

        }else{

            $tmp_HTML_ERR_TRACE = $this->oCRNRSTN_USR->proper_replace('{ERR_TRACE}', 'There are no errors to report.', $tmp_HTML_ERR_TRACE);
            $tmp_TEXT_ERR_TRACE = $this->oCRNRSTN_USR->proper_replace('{ERR_TRACE}', 'There are no errors to report.', $tmp_TEXT_ERR_TRACE);

        }

        if($endpoint_validation_fail_count>0 && $transfer_err_count>0){

            if($endpoint_validation_fail_count==1){

                $tmp_evfc = 'error';

            }else{

                $tmp_evfc = 'errors';

            }

            if($transfer_err_count==1){

                $tmp_tec = 'error was';

            }else{

                $tmp_tec = 'errors were';

            }

            $HTML_process_state_message = 'The <span style="font-weight: normal;">C<span style="color: #F90000;">R</span>NRSTN :: Electrum process has completed, however, ' . $this->oCRNRSTN_USR->number_format_keep_precision($endpoint_validation_fail_count).' endpoint connection ' . $tmp_evfc.' and ' . $transfer_err_count.' file transfer ' . $tmp_tec.' experienced.</span>';
            $TEXT_process_state_message = 'The CRNRSTN :: Electrum process has completed, however, ' . $this->oCRNRSTN_USR->number_format_keep_precision($endpoint_validation_fail_count).' endpoint connection ' . $tmp_evfc.' and ' . $transfer_err_count.' file transfer ' . $tmp_tec.' experienced.';

        }else{

            if($transfer_err_count>0){

                if($transfer_err_count==1){

                    $HTML_process_state_message = 'The <span style="font-weight: normal;">C<span style="color: #F90000;">R</span>NRSTN :: Electrum process has completed successfully, however, ' . $this->oCRNRSTN_USR->number_format_keep_precision($transfer_err_count).' file transfer error was experienced.</span>';
                    $TEXT_process_state_message = 'The CRNRSTN :: Electrum process has completed successfully, however, ' . $this->oCRNRSTN_USR->number_format_keep_precision($transfer_err_count).' file transfer error was experienced.';


                }else{

                    $HTML_process_state_message = 'The <span style="font-weight: normal;">C<span style="color: #F90000;">R</span>NRSTN :: Electrum process has completed successfully, however, ' . $this->oCRNRSTN_USR->number_format_keep_precision($transfer_err_count).' file transfer errors were experienced.</span>';
                    $TEXT_process_state_message = 'The CRNRSTN :: Electrum process has completed successfully, however, ' . $this->oCRNRSTN_USR->number_format_keep_precision($transfer_err_count).' file transfer errors were experienced.';

                }

            }else{

                if($endpoint_validation_fail_count>0){

                    if($endpoint_validation_fail_count==1){

                        $HTML_process_state_message = 'The <span style="font-weight: normal;">C<span style="color: #F90000;">R</span>NRSTN :: Electrum process has completed, however, ' . $this->oCRNRSTN_USR->number_format_keep_precision($endpoint_validation_fail_count).' endpoint connection error was experienced.</span>';
                        $TEXT_process_state_message = 'The CRNRSTN :: Electrum process has completed, however, ' . $this->oCRNRSTN_USR->number_format_keep_precision($endpoint_validation_fail_count).' endpoint connection error was experienced.';

                    }else{

                        $HTML_process_state_message = 'The <span style="font-weight: normal;">C<span style="color: #F90000;">R</span>NRSTN :: Electrum process has completed, however, ' . $this->oCRNRSTN_USR->number_format_keep_precision($endpoint_validation_fail_count).' endpoint connection errors were experienced.</span>';
                        $TEXT_process_state_message = 'The CRNRSTN :: Electrum process has completed, however, ' . $this->oCRNRSTN_USR->number_format_keep_precision($endpoint_validation_fail_count).' endpoint connection errors were experienced.';

                    }

                }

            }

        }

        $percent_files_successful = 100-(($transfer_err_count/($total_asset_count-$skipped_count)) * 100);

        $percent_files_successful = $this->oCRNRSTN_USR->number_format_keep_precision($percent_files_successful, 2, '.');

        $tmp_destination_count = 0;
        foreach($this->queued_endpoint_ARRAY[$batch_serial]['DESTINATION'] as $key_src => $hot_src_connection_ARRAY){

            $tmp_destination_count++;

        }

        $skipped_count = $skipped_count/$tmp_destination_count;

        $this->soapRequest_ARRAY = array('oElectrumPerformanceReport' =>
            array(
                'CRNRSTN_PACKET_IS_ENCRYPTED' => 'TRUE',
                'CRNRSTN_SOAP_SVC_AUTH_KEY' => $this->oCRNRSTN_USR->data_encrypt($this->oCRNRSTN_USR->get_resource('CRNRSTN_SOAP_SVC_AUTH_KEY'), CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'CRNRSTN_PROXY_EMAIL_PROTOCOL' => $this->oCRNRSTN_USR->data_encrypt($this->notifications_email_protocol, CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'oRECIPIENT' => $tmp_RECIPIENT_ARRAY,
                'oSENDER' => $tmp_SENDER_ARRAY,
                'oREPLYTO' => $tmp_REPLYTO_ARRAY,
                'oCC' => $tmp_CC_ARRAY,
                'oBCC' => $tmp_BCC_ARRAY,
                'SUPPRESS_DUPLICATE_RECIPIENT' => $this->oCRNRSTN_USR->data_encrypt('true', CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'MESSAGE_SUBJECT' => $this->oCRNRSTN_USR->data_encrypt('CRNRSTN :: Electrum performance report from ' . $_SERVER['REMOTE_ADDR'].' (' . $_SERVER['SERVER_NAME'].')', CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'WORDWRAP' => $this->oCRNRSTN_USR->data_encrypt('72', CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'PRIORITY' => $this->oCRNRSTN_USR->data_encrypt('3', CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'IS_HTML' => $this->oCRNRSTN_USR->data_encrypt('true', CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'SYS_MESSAGE_TITLE_HTML' => $this->oCRNRSTN_USR->data_encrypt('C<span style="color: #F90000;">R</span>NRSTN :: Electrum Performance Notification', CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'SYS_MESSAGE_TITLE_TEXT' => $this->oCRNRSTN_USR->data_encrypt('CRNRSTN :: Electrum Performance Notification', CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'SYS_LOG_INTEGER_CONSTANT' => $this->oCRNRSTN_USR->data_encrypt('LOG_INFO', CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'SYS_MESSAGE_HTML' => $this->oCRNRSTN_USR->data_encrypt($HTML_process_state_message, CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'SYS_MESSAGE_TEXT' => $this->oCRNRSTN_USR->data_encrypt($TEXT_process_state_message, CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'SYS_REMOTE_ADDR' => $this->oCRNRSTN_USR->data_encrypt($_SERVER['REMOTE_ADDR'], CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'SYS_SERVER_NAME' => $this->oCRNRSTN_USR->data_encrypt($_SERVER['SERVER_NAME'], CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'SYS_SYSTEM_TIME' => $this->oCRNRSTN_USR->data_encrypt($this->oCRNRSTN_USR->return_query_date_time_stamp(), CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'SYS_PROCESS_RUN_TIME' => $this->oCRNRSTN_USR->data_encrypt($tmp_runtime, CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_START_TIME' => $this->oCRNRSTN_USR->data_encrypt($this->startTime, CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_END_TIME' => $this->oCRNRSTN_USR->data_encrypt($this->endTime, CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_PRETTY_RUN_TIME' => $this->oCRNRSTN_USR->data_encrypt($this->oCRNRSTN_USR->return_pretty_delta_time($this->elapsedTime, $tmp_microsecs_explode[1]), CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_TOTAL_COUNT_DESTINATION_ENDPOINTS' => $this->oCRNRSTN_USR->data_encrypt($this->oCRNRSTN_USR->number_format_keep_precision($tmp_destination_count), CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_TOTAL_COUNT_FILES_TRANSFERRED' => $this->oCRNRSTN_USR->data_encrypt($this->oCRNRSTN_USR->number_format_keep_precision($transfer_count), CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_TOTAL_COUNT_VALID_FOR_TRANSFER' => $this->oCRNRSTN_USR->data_encrypt($this->oCRNRSTN_USR->number_format_keep_precision($unique_auth_asset_count_at_source), CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_TOTAL_COUNT_FILES_SKIPPED' => $this->oCRNRSTN_USR->data_encrypt($this->oCRNRSTN_USR->number_format_keep_precision($skipped_count), CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_TOTAL_FILESIZE_FILES_TRANSFERRED' => $this->oCRNRSTN_USR->data_encrypt($this->oCRNRSTN_USR->format_bytes($file_size, 5), CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_ENDPOINT_FILESIZE_FILES_TRANSFERRED' => $this->oCRNRSTN_USR->data_encrypt($this->oCRNRSTN_USR->format_bytes(($unique_auth_asset_filesize_at_source/$tmp_destination_count), 5), CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_TOTAL_ERRORS_FILES_TRANSFERRED' => $this->oCRNRSTN_USR->data_encrypt($this->oCRNRSTN_USR->number_format_keep_precision($transfer_err_count), CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_TOTAL_COUNT_ENDPOINT_CONNECTION_ERROR' => $this->oCRNRSTN_USR->data_encrypt($this->oCRNRSTN_USR->number_format_keep_precision($endpoint_validation_fail_count), CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_PERCENTAGE_FILES_SUCCESSFUL_TRANSFERRED' => $this->oCRNRSTN_USR->data_encrypt($percent_files_successful . '%', CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_DATA_SOURCE_HTML' => $this->oCRNRSTN_USR->data_encrypt($this->return_CRNRSTN_SysMsgContent($execution_serial, $batch_serial, 'ELECTRUM_DATA_SOURCE_HTML','HTML'), CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_DATA_DESTINATION_HTML' => $this->oCRNRSTN_USR->data_encrypt($this->return_CRNRSTN_SysMsgContent($execution_serial, $batch_serial, 'ELECTRUM_DATA_DESTINATION_HTML','HTML'), CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_DATA_HANDLING_PROFILE_HTML' => $this->oCRNRSTN_USR->data_encrypt($this->return_CRNRSTN_SysMsgContent($execution_serial, $batch_serial, 'ELECTRUM_DATA_HANDLING_PROFILE_HTML', 'HTML'), CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_DATA_SOURCE_TEXT' => $this->oCRNRSTN_USR->data_encrypt($this->return_CRNRSTN_SysMsgContent($execution_serial, $batch_serial, 'ELECTRUM_DATA_SOURCE_TEXT'), CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_DATA_DESTINATION_TEXT' => $this->oCRNRSTN_USR->data_encrypt($this->return_CRNRSTN_SysMsgContent($execution_serial, $batch_serial, 'ELECTRUM_DATA_DESTINATION_TEXT'), CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_DATA_HANDLING_PROFILE_TEXT' => $this->oCRNRSTN_USR->data_encrypt($this->return_CRNRSTN_SysMsgContent($execution_serial, $batch_serial, 'ELECTRUM_DATA_HANDLING_PROFILE_TEXT'), CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_ERRORS_TRACE_HTML' => $this->oCRNRSTN_USR->data_encrypt($tmp_HTML_ERR_TRACE, CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_ERRORS_TRACE_TEXT' => $this->oCRNRSTN_USR->data_encrypt($tmp_TEXT_ERR_TRACE, CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override)

            ));

        return $this->soapRequest_ARRAY;

    }

    public function fire_reportingNotification($execution_serial, $batch_serial){

        try{

            if(isset($this->notifications_profile)){

                if($this->notifications_email_pipe_delim!=''){

                    switch($this->notifications_profile){
                        case 'EMAIL_PROXY':

                            $this->oCRNRSTN_USR->error_log('The CRNRSTN :: Electrum process notification report profile is ' . $this->notifications_profile, __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                            //
                            // BUILD SOAP REQUEST OBJECT
                            $SOAP_request = $this->return_oElectrumPerfReportSOAP($execution_serial, $batch_serial);

                            $this->oCRNRSTN_USR->error_log('The CRNRSTN :: Electrum process notification SOAP endpoint=' . $this->notifications_SOAP_endpoint, __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                            if(isset($this->notifications_SOAP_endpoint)){

                                $response = $this->oCRNRSTN_USR->client_send_CRNRSTN_SOAP_REQUEST('sendElectrumPerformanceReport', $SOAP_request, $this->notifications_SOAP_endpoint);

                            }else{

                                $response = $this->oCRNRSTN_USR->client_send_CRNRSTN_SOAP_REQUEST('sendElectrumPerformanceReport', $SOAP_request);

                            }

                            //$this->oCRNRSTN_USR->error_log('The CRNRSTN :: Electrum process SOAP response [RAW DATA] CRNRSTN_SOAP_SVC_AUTH_KEY=[' . $response['CRNRSTN_SOAP_SVC_AUTH_KEY'].'] SOAP_OPERATION_RUNTIME_SECONDS=[' . $response['SOAP_OPERATION_RUNTIME_SECONDS'].'] TOTAL_EMAILS_RECEIVED=[' . $response['TOTAL_EMAILS_RECEIVED'].'] TOTAL_EMAILS_SENT=[' . $response['TOTAL_EMAILS_SENT'].'] TOTAL_EMAILS_ERROR=[' . $response['TOTAL_EMAILS_ERROR'].'] TOTAL_EMAILS_SUPPRESSED=[' . $response['TOTAL_EMAILS_SUPPRESSED'].']', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);
                            //$this->oCRNRSTN_USR->error_log('The CRNRSTN :: Electrum process SOAP response [RAW DATA] REQUEST_RECEIVED_TIMESTAMP=[' . $response['REQUEST_RECEIVED_TIMESTAMP'].'] REQUEST_COMPLETED_TIMESTAMP=[' . $response['REQUEST_COMPLETED_TIMESTAMP'].']', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                            //error_log('297 electrum - PROD DECRYPT SETTINGS=' . $this->cipher_override.', ' . $this->secret_key_override.', ' . $this->hmac_algorithm_override.', ' . $this->options_bitwise_override);
                            $this->oCRNRSTN_USR->error_log('The CRNRSTN :: Electrum process ran for ' . $this->oCRNRSTN_USR->data_decrypt($response['SOAP_OPERATION_RUNTIME_SECONDS'], true, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override).' seconds to produce the following SOAP response with ' . $this->oCRNRSTN_USR->data_decrypt($response['TOTAL_EMAILS_ERROR'], CRNRSTN_ENCRYPT_SOAP, true, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override).' send errors and ' . $this->oCRNRSTN_USR->data_decrypt($response['TOTAL_EMAILS_SUPPRESSED'], CRNRSTN_ENCRYPT_SOAP, true, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override).' suppressions [RAW DATA] REQUEST_RECEIVED_TIMESTAMP=[' . $this->oCRNRSTN_USR->data_decrypt($response['REQUEST_RECEIVED_TIMESTAMP'], CRNRSTN_ENCRYPT_SOAP, true, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override).'] REQUEST_COMPLETED_TIMESTAMP=[' . $this->oCRNRSTN_USR->data_decrypt($response['REQUEST_COMPLETED_TIMESTAMP'], CRNRSTN_ENCRYPT_SOAP, true, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override).']', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                            foreach($response['oACTIVITY_STATUS_REPORT'] as $key=>$statusArray){

                                $this->oCRNRSTN_USR->error_log('[' . $this->oCRNRSTN_USR->data_decrypt($statusArray['EMAIL_PROXY_SERIAL'], CRNRSTN_ENCRYPT_SOAP, true, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override).']', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);
                                $this->oCRNRSTN_USR->error_log('[' . $this->oCRNRSTN_USR->data_decrypt($statusArray['IS_SENT'], CRNRSTN_ENCRYPT_SOAP, true, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override).']', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);
                                $this->oCRNRSTN_USR->error_log('[' . $this->oCRNRSTN_USR->data_decrypt($statusArray['SEND_TIMESTAMP'], CRNRSTN_ENCRYPT_SOAP, true, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override).']', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);
                                $this->oCRNRSTN_USR->error_log('[' . $this->oCRNRSTN_USR->data_decrypt($statusArray['SEND_STATUS'], CRNRSTN_ENCRYPT_SOAP, true, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override).']', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);
                                $this->oCRNRSTN_USR->error_log('[' . $this->oCRNRSTN_USR->data_decrypt($statusArray['STATUS_DETAIL'], CRNRSTN_ENCRYPT_SOAP, true, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override).']', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                            }

                            //$this->oCRNRSTN_USR->error_log('The CRNRSTN :: Electrum process SOAP response CRNRSTN_SOAP_SVC_AUTH_KEY=[' . $this->oCRNRSTN_USR->data_decrypt($response['CRNRSTN_SOAP_SVC_AUTH_KEY'], CRNRSTN_ENCRYPT_SOAP, true, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override).'] TOTAL_EMAILS_RECEIVED=[' . $this->oCRNRSTN_USR->data_decrypt($response['TOTAL_EMAILS_RECEIVED'], CRNRSTN_ENCRYPT_SOAP, true, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override).'] TOTAL_EMAILS_SENT=[' . $this->oCRNRSTN_USR->data_decrypt($response['TOTAL_EMAILS_SENT'], CRNRSTN_ENCRYPT_SOAP, true, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override).'] TOTAL_EMAILS_ERROR=[' . $this->oCRNRSTN_USR->data_decrypt($response['TOTAL_EMAILS_ERROR'], CRNRSTN_ENCRYPT_SOAP, true, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override).']', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);
                            //$this->oCRNRSTN_USR->error_log('The CRNRSTN :: Electrum process SOAP response EMAIL_PROXY_SERIAL[0]=[' . $this->oCRNRSTN_USR->data_decrypt($response['oACTIVITY_STATUS_REPORT'][0]['EMAIL_PROXY_SERIAL'], CRNRSTN_ENCRYPT_SOAP, true, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override).'] SEND_STATUS[0]=[' . $this->oCRNRSTN_USR->data_decrypt($response['oACTIVITY_STATUS_REPORT'][0]['SEND_STATUS'], CRNRSTN_ENCRYPT_SOAP, true, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override).'] EMAIL_PROXY_SERIAL[1]=[' . $this->oCRNRSTN_USR->data_decrypt($response['oACTIVITY_STATUS_REPORT'][1]['EMAIL_PROXY_SERIAL'], CRNRSTN_ENCRYPT_SOAP, true, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override).'] SEND_STATUS[1]=[' . $this->oCRNRSTN_USR->data_decrypt($response['oACTIVITY_STATUS_REPORT'][1]['SEND_STATUS'], CRNRSTN_ENCRYPT_SOAP, true, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override).']', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                        break;
                        case 'EMAIL':



                        break;
                        default:

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('The CRNRSTN :: Electrum communications notifications profile which has been provided is not supported.');

                        break;

                    }


                }else{

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('The CRNRSTN :: Electrum performance report request has not received any email address to which to send a report.');

                }

            }

        }catch( Exception $e ) {

            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
            return false;

        }

    }

    public function initNotifications($email_pipe_delim, $notificationProfile, $SOAP_endpoint, $email_protocol){

        try{

            $notificationProfile = trim(strtoupper($notificationProfile));

            switch($notificationProfile){
                case 'EMAIL_PROXY':

                    $this->notifications_email_pipe_delim = $email_pipe_delim;
                    $this->notifications_profile = trim(strtoupper($notificationProfile));
                    $this->notifications_SOAP_endpoint = $SOAP_endpoint;
                    $this->notifications_email_protocol = trim(strtoupper($email_protocol));

                break;
                case 'EMAIL':

                    $this->notifications_email_pipe_delim = $email_pipe_delim;
                    $this->notifications_profile = trim(strtoupper($notificationProfile));
                    $this->notifications_SOAP_endpoint = NULL;
                    $this->notifications_email_protocol = NULL;

                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('The CRNRSTN :: Electrum initialization of its\' notification profile has failed due to unknown profile type, "' . $notificationProfile.'". Only "EMAIL" and "EMAIL_PROXY" are available options within CRNRSTN :: v2.0.0.');

                break;

            }

            return NULL;

        }catch( Exception $e ) {

            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
            return false;

        }

    }

    public function isNotExcluded_asset($filePath, $execution_batch_serial, $FIREHOT_oEndpoint_SOURCE){

        try{
            /*

            $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_exclude_DIR($CRNRSTN_oELECTRUM, '*ment', 'ELECTRUM_SOURCE_FTP00');
            $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_exclude_DIR($CRNRSTN_oELECTRUM, 'Projects', $local_dir_path_SOURCE00);
            $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_exclude_FILE($CRNRSTN_oELECTRUM, '*.pdf');
            $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_exclude_FILE($CRNRSTN_oELECTRUM, '*crnrstn*.*');
            $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_exclude_modifiedOlderThan($CRNRSTN_oELECTRUM, '30 days');
            $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_exclude_modifiedNewerThan($CRNRSTN_oELECTRUM, '2 months');
            $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_exclude_accessedOlderThan($CRNRSTN_oELECTRUM, '30 days');
            $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_exclude_accessedNewerThan($CRNRSTN_oELECTRUM, '2 months');
            $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_exclude_assetUserID($CRNRSTN_oELECTRUM, 'jony5');
            $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_exclude_assetGroupID($CRNRSTN_oELECTRUM, 'root');
            $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_exclude_fileSizeGreaterThan($CRNRSTN_oELECTRUM, 1024);
            $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_exclude_fileSizeLessThan($CRNRSTN_oELECTRUM, 150);

            */

            $asset_transfer_suppression_ARRAY = $FIREHOT_oEndpoint_SOURCE->asset_transfer_suppression_ARRAY;

            //
            // ENDPOINT WCR KEY OR PATH (IF LOCAL DIRECTORY VIA INPUT PARAMETER)
            $oEndpoint_WCRkey_or_path = $FIREHOT_oEndpoint_SOURCE->return_WCRkey_or_PATH();
            $oEndpoint_connection_type = $FIREHOT_oEndpoint_SOURCE->return_connection_type();
            $oEndpoint_serial = $FIREHOT_oEndpoint_SOURCE->return_serial();

            $exclusion_check_result = array();
            $exclusion_check_result['not_excluded'] = true;
            $exclusion_check_result['pattern'] = '';
            $exclusion_check_result['asset_meta'] = '';
            $exclusion_check_result['wcr_path_specified'] = '';
            $exclusion_check_result['pattern_type'] = '';

            $exclusion_profile_exclude_ARRAY = array();
            $all_excludes_open = true;

            if(isset($asset_transfer_suppression_ARRAY[$this->electrum_process_id])){

                foreach($asset_transfer_suppression_ARRAY[$this->electrum_process_id][$execution_batch_serial] as $key => $exclusion_profile_ARRAY) {

                    $exclusion_serial = $exclusion_profile_ARRAY['exclusion_serial'];
                    $exclusion_type = $exclusion_profile_ARRAY['exclusion_type'];
                    $WCRkey_or_DIRPATH = $exclusion_profile_ARRAY['WCR_or_path'];
                    $qualification_pattern = $exclusion_profile_ARRAY['pattern'];

                    $exclusion_check_result['wcr_path_specified'] = '';
                    $exclusion_profile_exclude_ARRAY[$exclusion_serial][$exclusion_type][$qualification_pattern] = true;

                    if (isset($WCRkey_or_DIRPATH)) {
                        $all_excludes_open = false;

                        if ($oEndpoint_WCRkey_or_path != $WCRkey_or_DIRPATH && $WCRkey_or_DIRPATH != '' && $WCRkey_or_DIRPATH != NULL) {

                            $exclusion_profile_exclude_ARRAY[$exclusion_serial][$exclusion_type][$qualification_pattern] = false;

                        }else{

                            $exclusion_profile_exclude_ARRAY[$exclusion_serial][$exclusion_type][$qualification_pattern] = true;
                            $exclusion_check_result['wcr_path_specified'] = $WCRkey_or_DIRPATH;
                        }

                    }

                    //
                    // APPLY THIS EXCLUSION TO THIS ENDPOINT (SOURCE) ASSET
                    $exclusion_check_result['not_excluded'] = true;
                    $exclusion_check_result['pattern'] = '';
                    $exclusion_check_result['asset_meta'] = '';
                    $exclusion_check_result['exclusion_meta'] = '';
                    //$this->oCRNRSTN_USR->error_log('PROCESS EXCLUSION [' . $exclusion_type . '][' . $key . '][' . $filePath . ']', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                    switch ($exclusion_type) {
                        case 'DIRECTORY':
                            //#['DIRECTORY']['NOMINATION'][] = $WCRkey_or_DIRPATH;
                            //#['DIRECTORY']['NOMINATION'][] = $qualification_pattern;

                            //
                            // USED FOR DIRECTORY CHECK IN ELECTRUM v1.0.0
                            //$tmp_exclude_pos = strpos($filePath, $condition_pattern);
                            //if(fnmatch($condition_pattern, $filePath) || ($tmp_exclude_pos !== false)){
                            if($all_excludes_open || $exclusion_profile_exclude_ARRAY[$exclusion_serial][$exclusion_type][$qualification_pattern]){

                                if($this->oCRNRSTN_USR->isMatchedStrPattern($filePath, $qualification_pattern, false)){

                                    $exclusion_check_result['not_excluded'] = false;
                                    $exclusion_check_result['pattern'] = $qualification_pattern;
                                    $exclusion_check_result['asset_meta'] = $filePath;
                                    $exclusion_check_result['asset_path'] = $filePath;
                                    $exclusion_check_result['pattern_type'] = $exclusion_type;

                                    $this->asset_suppressed_ARRAY[$this->electrum_process_id][$execution_batch_serial][$oEndpoint_serial][] = $exclusion_check_result;

                                    return $exclusion_check_result;

                                }

                            }

                        break;
                        case 'FILE':
                            //#['FILE']['NOMINATION'][] = $qualification_pattern;

                            if($all_excludes_open || $exclusion_profile_exclude_ARRAY[$exclusion_serial][$exclusion_type][$qualification_pattern]){

                                $tmp_filename = basename($filePath);
                                // basename() operates naively on the input string
                                if($this->oCRNRSTN_USR->isMatchedStrPattern($tmp_filename, $qualification_pattern, false)){

                                    $exclusion_check_result['not_excluded'] = false;
                                    $exclusion_check_result['pattern'] = $qualification_pattern;
                                    $exclusion_check_result['asset_meta'] = $tmp_filename;
                                    $exclusion_check_result['asset_path'] = $filePath;
                                    $exclusion_check_result['pattern_type'] = $exclusion_type;

                                    $this->asset_suppressed_ARRAY[$this->electrum_process_id][$execution_batch_serial][$oEndpoint_serial][] = $exclusion_check_result;

                                    return $exclusion_check_result;

                                }

                            }

                        break;
                        case 'OWNER_GROUP':
                            //#['OWNER_GROUP']['GROUP_ID'][] = $pattern;

                            if($all_excludes_open || $exclusion_profile_exclude_ARRAY[$exclusion_serial][$exclusion_type][$qualification_pattern]){

                                if(isset($this->source_file_gid_STRING_at_path_ARRAY[$oEndpoint_serial][$filePath])){

                                    if($this->source_file_gid_STRING_at_path_ARRAY[$oEndpoint_serial][$filePath]!=-1){
                                        //$this->oCRNRSTN_USR->error_log('CRNRSTN :: Electrum [' . $oEndpoint_connection_type.'] OWNER_GROUP=' . $this->source_file_gid_STRING_at_path_ARRAY[$oEndpoint_serial][$filePath].' *****', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                                        //$this->oCRNRSTN_USR->error_log('CRNRSTN :: Electrum [' . $oEndpoint_connection_type.'] MODIFIED_NT [' . $this->source_file_lastmodify_at_path_ARRAY[$oEndpoint_serial][$filePath].'] *****', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);
                                        //$this->oCRNRSTN_USR->error_log('CRNRSTN :: Electrum [' . $oEndpoint_connection_type.'] MODIFIED TIMESTAMP=['.date('D M j G:i:s T Y', $this->source_file_lastmodify_at_path_ARRAY[$oEndpoint_serial][$filePath]).'] *****', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                                        if($this->source_file_gid_STRING_at_path_ARRAY[$oEndpoint_serial][$filePath] == $qualification_pattern || $this->source_file_gid_INT_at_path_ARRAY[$oEndpoint_serial][$filePath] == $qualification_pattern){

                                            $exclusion_check_result['not_excluded'] = false;
                                            $exclusion_check_result['pattern'] = $qualification_pattern;
                                            $exclusion_check_result['asset_meta'] = $filePath;
                                            $exclusion_check_result['asset_path'] = $filePath;
                                            $exclusion_check_result['pattern_type'] = $exclusion_type;
                                            $exclusion_check_result['exclusion_meta'] = $this->source_file_gid_STRING_at_path_ARRAY[$oEndpoint_serial][$filePath].'<->' . $this->source_file_gid_INT_at_path_ARRAY[$oEndpoint_serial][$filePath];

                                            $this->asset_suppressed_ARRAY[$this->electrum_process_id][$execution_batch_serial][$oEndpoint_serial][] = $exclusion_check_result;

                                            return $exclusion_check_result;
                                        }
                                    }
                                }
                            }

                        break;
                        case 'OWNER_USER':
                            //#['OWNER_USER']['USER_ID'][] = $pattern;

                            if($all_excludes_open || $exclusion_profile_exclude_ARRAY[$exclusion_serial][$exclusion_type][$qualification_pattern]){

                                if(isset($this->source_file_uid_STRING_at_path_ARRAY[$oEndpoint_serial][$filePath])){

                                    if($this->source_file_uid_STRING_at_path_ARRAY[$oEndpoint_serial][$filePath]!=-1){

                                        //$this->oCRNRSTN_USR->error_log('CRNRSTN :: Electrum [' . $oEndpoint_connection_type.'] OWNER_USER [' . $this->source_file_uid_STRING_at_path_ARRAY[$oEndpoint_serial][$filePath].'] *****', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);
                                        //$this->oCRNRSTN_USR->error_log('CRNRSTN :: Electrum [' . $oEndpoint_connection_type.'] MODIFIED TIMESTAMP=['.date('D M j G:i:s T Y', $this->source_file_lastmodify_at_path_ARRAY[$oEndpoint_serial][$filePath]).'] *****', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                                        if($this->source_file_uid_STRING_at_path_ARRAY[$oEndpoint_serial][$filePath] == $qualification_pattern || $this->source_file_uid_INT_at_path_ARRAY[$oEndpoint_serial][$filePath] == $qualification_pattern){

                                            $exclusion_check_result['not_excluded'] = false;
                                            $exclusion_check_result['pattern'] = $qualification_pattern;
                                            $exclusion_check_result['asset_meta'] = $filePath;
                                            $exclusion_check_result['asset_path'] = $filePath;
                                            $exclusion_check_result['pattern_type'] = $exclusion_type;
                                            $exclusion_check_result['exclusion_meta'] = $this->source_file_uid_STRING_at_path_ARRAY[$oEndpoint_serial][$filePath].'<->' . $this->source_file_uid_INT_at_path_ARRAY[$oEndpoint_serial][$filePath];

                                            $this->asset_suppressed_ARRAY[$this->electrum_process_id][$execution_batch_serial][$oEndpoint_serial][] = $exclusion_check_result;

                                            return $exclusion_check_result;
                                        }
                                    }
                                }
                            }

                        break;
                        case 'MODIFIED_NT':
                            //#['MODIFIED_NT']['NEWER_THAN'][] = $pattern;

                            if($all_excludes_open || $exclusion_profile_exclude_ARRAY[$exclusion_serial][$exclusion_type][$qualification_pattern]){

                                if(isset($this->source_file_lastmodify_at_path_ARRAY[$oEndpoint_serial][$filePath])){

                                    if($this->source_file_lastmodify_at_path_ARRAY[$oEndpoint_serial][$filePath]!=-1){

                                        //$this->oCRNRSTN_USR->error_log('CRNRSTN :: Electrum [' . $oEndpoint_connection_type.'] MODIFIED_NT [' . $this->source_file_lastmodify_at_path_ARRAY[$oEndpoint_serial][$filePath].'] *****', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);
                                        //$this->oCRNRSTN_USR->error_log('CRNRSTN :: Electrum [' . $oEndpoint_connection_type.'] MODIFIED TIMESTAMP=['.date('D M j G:i:s T Y', $this->source_file_lastmodify_at_path_ARRAY[$oEndpoint_serial][$filePath]).'] *****', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                                        if($this->oCRNRSTN_USR->isDateNewerThan($this->source_file_lastmodify_at_path_ARRAY[$oEndpoint_serial][$filePath], $qualification_pattern)){

                                            $exclusion_check_result['not_excluded'] = false;
                                            $exclusion_check_result['pattern'] = $qualification_pattern;
                                            $exclusion_check_result['asset_meta'] = $filePath;
                                            $exclusion_check_result['asset_path'] = $filePath;
                                            $exclusion_check_result['pattern_type'] = $exclusion_type;
                                            $exclusion_check_result['exclusion_meta'] = $this->source_file_lastmodify_at_path_ARRAY[$oEndpoint_serial][$filePath];

                                            $this->asset_suppressed_ARRAY[$this->electrum_process_id][$execution_batch_serial][$oEndpoint_serial][] = $exclusion_check_result;

                                            return $exclusion_check_result;
                                        }
                                    }
                                }
                            }

                        break;
                        case 'MODIFIED_OT':
                            //#['MODIFIED_OT']['OLDER_THAN'][] = $pattern;

                            if($all_excludes_open || $exclusion_profile_exclude_ARRAY[$exclusion_serial][$exclusion_type][$qualification_pattern]){

                                if(isset($this->source_file_lastmodify_at_path_ARRAY[$oEndpoint_serial][$filePath])){

                                    if($this->source_file_lastmodify_at_path_ARRAY[$oEndpoint_serial][$filePath]!=-1){

                                        //$this->oCRNRSTN_USR->error_log('CRNRSTN :: Electrum [' . $oEndpoint_connection_type.'] MODIFIED_OT [' . $this->source_file_lastmodify_at_path_ARRAY[$oEndpoint_serial][$filePath].'] *****', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);
                                        //$this->oCRNRSTN_USR->error_log('CRNRSTN :: Electrum [' . $oEndpoint_connection_type.'] MODIFIED TIMESTAMP=['.date('D M j G:i:s T Y', $this->source_file_lastmodify_at_path_ARRAY[$oEndpoint_serial][$filePath]).'] *****', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                                        if($this->oCRNRSTN_USR->isDateOlderThan($this->source_file_lastmodify_at_path_ARRAY[$oEndpoint_serial][$filePath], $qualification_pattern)){

                                            $exclusion_check_result['not_excluded'] = false;
                                            $exclusion_check_result['pattern'] = $qualification_pattern;
                                            $exclusion_check_result['asset_meta'] = $filePath;
                                            $exclusion_check_result['asset_path'] = $filePath;
                                            $exclusion_check_result['pattern_type'] = $exclusion_type;
                                            $exclusion_check_result['exclusion_meta'] = $this->source_file_lastmodify_at_path_ARRAY[$oEndpoint_serial][$filePath];

                                            $this->asset_suppressed_ARRAY[$this->electrum_process_id][$execution_batch_serial][$oEndpoint_serial][] = $exclusion_check_result;

                                            return $exclusion_check_result;
                                        }
                                    }
                                }
                            }

                        break;
                        case 'ACCESSED_NT':
                            //#['ACCESSED_NT']['NEWER_THAN'][] = $pattern;

                            if($all_excludes_open || $exclusion_profile_exclude_ARRAY[$exclusion_serial][$exclusion_type][$qualification_pattern]){

                                if(isset($this->source_file_lastaccess_at_path_ARRAY[$oEndpoint_serial][$filePath])){

                                    if($this->source_file_lastaccess_at_path_ARRAY[$oEndpoint_serial][$filePath]!=-1){

                                        //$this->oCRNRSTN_USR->error_log('CRNRSTN :: Electrum [' . $oEndpoint_connection_type.'] ACCESSED_NT [' . $this->source_file_lastaccess_at_path_ARRAY[$oEndpoint_serial][$filePath].'] *****', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                                        if($this->oCRNRSTN_USR->isDateNewerThan($this->source_file_lastaccess_at_path_ARRAY[$oEndpoint_serial][$filePath], $qualification_pattern)){

                                            $exclusion_check_result['not_excluded'] = false;
                                            $exclusion_check_result['pattern'] = $qualification_pattern;
                                            $exclusion_check_result['asset_meta'] = $filePath;
                                            $exclusion_check_result['asset_path'] = $filePath;
                                            $exclusion_check_result['pattern_type'] = $exclusion_type;
                                            $exclusion_check_result['exclusion_meta'] = $this->source_file_lastaccess_at_path_ARRAY[$oEndpoint_serial][$filePath];

                                            $this->asset_suppressed_ARRAY[$this->electrum_process_id][$execution_batch_serial][$oEndpoint_serial][] = $exclusion_check_result;

                                            return $exclusion_check_result;
                                        }
                                    }
                                }
                            }

                        break;
                        case 'ACCESSED_OT':
                            //#['ACCESSED_OT']['OLDER_THAN'][] = $pattern;

                            if($all_excludes_open || $exclusion_profile_exclude_ARRAY[$exclusion_serial][$exclusion_type][$qualification_pattern]){

                                if(isset($this->source_file_lastaccess_at_path_ARRAY[$oEndpoint_serial][$filePath])){

                                    if($this->source_file_lastaccess_at_path_ARRAY[$oEndpoint_serial][$filePath]!=-1){

                                        //$this->oCRNRSTN_USR->error_log('CRNRSTN :: Electrum [' . $oEndpoint_connection_type.'] ACCESSED_OT [' . $this->source_file_lastaccess_at_path_ARRAY[$oEndpoint_serial][$filePath].'] *****', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                                        if($this->oCRNRSTN_USR->isDateOlderThan($this->source_file_lastaccess_at_path_ARRAY[$oEndpoint_serial][$filePath], $qualification_pattern)){

                                            $exclusion_check_result['not_excluded'] = false;
                                            $exclusion_check_result['pattern'] = $qualification_pattern;
                                            $exclusion_check_result['asset_meta'] = $filePath;
                                            $exclusion_check_result['asset_path'] = $filePath;
                                            $exclusion_check_result['pattern_type'] = $exclusion_type;
                                            $exclusion_check_result['exclusion_meta'] = $this->source_file_lastaccess_at_path_ARRAY[$oEndpoint_serial][$filePath];

                                            $this->asset_suppressed_ARRAY[$this->electrum_process_id][$execution_batch_serial][$oEndpoint_serial][] = $exclusion_check_result;

                                            return $exclusion_check_result;
                                        }
                                    }
                                }
                            }

                        break;
                        case 'FILE_SIZE_GT':
                            //#['FILE_SIZE_GT']['GREATER_THAN'][] = $bytes;

                            if($all_excludes_open || $exclusion_profile_exclude_ARRAY[$exclusion_serial][$exclusion_type][$qualification_pattern]){

                                //$this->oCRNRSTN_USR->error_log('CRNRSTN :: Electrum FILE_SIZE_GT EXCLUSION *****', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                                if(isset($this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filePath])){

                                    if($this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filePath]!=-1){

                                        if($this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filePath]>$qualification_pattern){

                                            $exclusion_check_result['not_excluded'] = false;
                                            $exclusion_check_result['pattern'] = $qualification_pattern;
                                            $exclusion_check_result['asset_meta'] = $filePath;
                                            $exclusion_check_result['asset_path'] = $filePath;
                                            $exclusion_check_result['pattern_type'] = $exclusion_type;
                                            $exclusion_check_result['exclusion_meta'] = $this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filePath];

                                            $this->asset_suppressed_ARRAY[$this->electrum_process_id][$execution_batch_serial][$oEndpoint_serial][] = $exclusion_check_result;

                                            return $exclusion_check_result;

                                        }

                                    }

                                }

                            }

                        break;
                        case 'FILE_SIZE_LT':
                            //#['FILE_SIZE_LT']['LESS_THAN'][] = $bytes;

                            if($all_excludes_open || $exclusion_profile_exclude_ARRAY[$exclusion_serial][$exclusion_type][$qualification_pattern]){

                                //$this->oCRNRSTN_USR->error_log('CRNRSTN :: Electrum FILE_SIZE_GT EXCLUSION *****', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                                if(isset($this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filePath])){

                                    if($this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filePath]!=-1){

                                        if($this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filePath]<$qualification_pattern){

                                            $exclusion_check_result['not_excluded'] = false;
                                            $exclusion_check_result['pattern'] = $qualification_pattern;
                                            $exclusion_check_result['asset_meta'] = $filePath;
                                            $exclusion_check_result['asset_path'] = $filePath;
                                            $exclusion_check_result['pattern_type'] = $exclusion_type;
                                            $exclusion_check_result['exclusion_meta'] = $this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filePath];

                                            $this->asset_suppressed_ARRAY[$this->electrum_process_id][$execution_batch_serial][$oEndpoint_serial][] = $exclusion_check_result;

                                            return $exclusion_check_result;

                                        }

                                    }

                                }

                            }

                        break;
                        default:

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('The CRNRSTN :: Electrum exclusion type,"' . $exclusion_type . '", has not yet been configured to be applied to any asset.');

                        break;

                    }

                }

                return $exclusion_check_result;

            }else{

                //
                // NO EXCLUSIONS - THEREFORE, ALL GOOD IN THA HOOD
                return true;

            }

        }catch( Exception $e ) {

            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
            return false;

        }

    }

    public function return_source_file_userid_at_path($oEndpoint_serial, $filePath){

        return $this->source_file_uid_STRING_at_path_ARRAY[$oEndpoint_serial][$filePath];

    }

    public function return_source_file_groupid_at_path($oEndpoint_serial, $filePath){

        return $this->source_file_gid_STRING_at_path_ARRAY[$oEndpoint_serial][$filePath];

    }

    public function return_file_size_at_path($oEndpoint_serial, $filePath){

        return $this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filePath];

    }

    public function return_file_lastaccess_at_path($oEndpoint_serial, $filePath){

        return $this->source_file_lastaccess_at_path_ARRAY[$oEndpoint_serial][$filePath];

    }

    public function return_file_lastmodify_at_path($oEndpoint_serial, $filePath){

        return $this->source_file_lastmodify_at_path_ARRAY[$oEndpoint_serial][$filePath];

    }

    public function return_file_blocksize_at_path($oEndpoint_serial, $filePath){

        return $this->source_file_blocksize_at_path_ARRAY[$oEndpoint_serial][$filePath];

    }

    public function return_file_blockallocate_at_path($oEndpoint_serial, $filePath){

        return $this->source_file_blockallocate_at_path_ARRAY[$oEndpoint_serial][$filePath];

    }

    public function return_file_fullpermissions_at_path($oEndpoint_serial, $filePath){

        return $this->source_file_fullpermissions_at_path_ARRAY[$oEndpoint_serial][$filePath];

    }

    public function return_file_octalpermissions_at_path($oEndpoint_serial, $filePath){

        return $this->source_file_octalpermissions_at_path_ARRAY[$oEndpoint_serial][$filePath];

    }

    public function localStorageUse_doNotPassUsagePercent($maxStorageUse){

        $tmp_maxStorage = $this->oCRNRSTN_USR->string_sanitize($maxStorageUse, 'max_storage_utilization');

        $tmp_maxStorage = (int) $tmp_maxStorage * 1;

        try{

            if(is_integer($tmp_maxStorage) || is_int($tmp_maxStorage) || is_float($tmp_maxStorage) || is_double($tmp_maxStorage)){

                $this->max_storage_utilization = $tmp_maxStorage;

            }else{

                if(strtolower($tmp_maxStorage) == 'fullretard'){

                    $this->max_storage_utilization = 100;

                }else{

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('The CRNRSTN :: Electrum max local DIR destination storage utilization has been conveyed with incorrect data type. It should be an integer or double/float, but the value provided is "' . $maxStorageUse.'".');

                }

            }

        }catch( Exception $e ) {

            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
            return false;

        }

    }

    public function deleteSourceData_OnSuccess($local_dir_path_SOURCE00, $require_ALL_destination_success){

        if($require_ALL_destination_success){

            $this->oCRNRSTN_USR->error_log('The CRNRSTN :: Electrum process is being configured to (upon 100% SUCCESS file copy to ALL destination endpoints) delete all data at the SOURCE endpoint (' . $local_dir_path_SOURCE00.') that was moved by the CRNRSTN :: Electrum profile to destination.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        }else{

            $this->oCRNRSTN_USR->error_log('The CRNRSTN :: Electrum process is being configured to (upon 100% SUCCESS file copy to at least ONE (1) destination endpoint) delete all data at the SOURCE endpoint (' . $local_dir_path_SOURCE00.') that was moved by the CRNRSTN :: Electrum profile to destination.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        }

    }

    private function electrum_datamover_FF($execution_serial, $execution_batch_serial, $hot_src_connection_ARRAY, $hot_dest_connection_ARRAY){

        $FIREHOT_oEndpoint_SOURCE = $hot_src_connection_ARRAY['FIREHOT_oEndpoint'];
        $FIREHOT_oEndpoint_DESTINATION = $hot_dest_connection_ARRAY['FIREHOT_oEndpoint'];

        if(isset($this->timestamp_nom_pattern)){

            $FIREHOT_oEndpoint_SOURCE->add_directory_nom_pattern($this->timestamp_nom_pattern);
            $this->oElectrum_STATS->init_directory_datestamp_nom($FIREHOT_oEndpoint_SOURCE->return_serial(), $FIREHOT_oEndpoint_SOURCE->return_timestamp_nom());

        }

        //
        // ENDPOINT SERIAL
        $oEndpoint_serial = $FIREHOT_oEndpoint_SOURCE->return_serial();
        $oEndpoint_serial_dest = $FIREHOT_oEndpoint_DESTINATION->return_serial();

        $total_wheels_count = sizeof($this->directory_content_ARRAY[$oEndpoint_serial]);
        if(isset($this->directory_dir_content_ARRAY[$oEndpoint_serial])) {

            $total_wheels_dir_count = sizeof($this->directory_dir_content_ARRAY[$oEndpoint_serial]);

        }else{

            $total_wheels_dir_count = 0;

        }

        $total_wheels_count += $total_wheels_dir_count;

        $this->oCRNRSTN_USR->error_log('The CRNRSTN :: Electrum process is handling FF asset transfer of ' . $total_wheels_count.'+' . $total_wheels_dir_count.' assets from ' . $FIREHOT_oEndpoint_SOURCE->return_FTP_SERVER().'::' . $FIREHOT_oEndpoint_SOURCE->return_FTP_PORT().' @ [DIR::' . $FIREHOT_oEndpoint_SOURCE->return_FTP_DIR_PATH().'] to ' . $FIREHOT_oEndpoint_DESTINATION->return_FTP_SERVER().'::' . $FIREHOT_oEndpoint_DESTINATION->return_FTP_PORT().' @ [DIR::' . $FIREHOT_oEndpoint_DESTINATION->return_FTP_DIR_PATH().'].', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $wheels_high_awesome_cnt = 0;
        foreach($this->directory_content_ARRAY[$oEndpoint_serial] as $key => $filePath){

            //
            // CHECK FOR CONFIGURED EXCLUSIONS
            $exclusion_check_result = $this->isNotExcluded_asset($filePath, $execution_batch_serial, $FIREHOT_oEndpoint_SOURCE);

            $wheels_high_awesome_cnt++;
            $oWheel_high_awesome = new crnrstn_wheel_high_awesome_eyes($execution_serial, $FIREHOT_oEndpoint_SOURCE, $FIREHOT_oEndpoint_DESTINATION, $this->oCRNRSTN_USR, $total_wheels_count, $wheels_high_awesome_cnt, $exclusion_check_result);

            $oWheel_high_awesome->receive_asset_meta($filePath, $this);

            if(isset($this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filePath])){

                if($this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filePath]!=-1) {

                    $oWheel_high_awesome->init_fileSize_bytes($this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filePath]);

                }
            }

            //
            // QUESTION :: WHO RUN IT...WHO RUN IT!?! ANSWER :: THE LORD RUNS IT.
            if($oWheel_high_awesome->process_asset($filePath, 'FF', $execution_serial, $execution_batch_serial, $hot_src_connection_ARRAY, $hot_dest_connection_ARRAY, $this, $this->oElectrum_STATS)){

                //
                // INCREMENT TRANSFER COUNT TO DESTINATION
                $this->oElectrum_STATS->plus_one_asset_transfer($oEndpoint_serial, $oEndpoint_serial_dest, $execution_serial, $execution_batch_serial, $this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filePath]);

            }

            if($wheels_high_awesome_cnt<5){

                $this->oCRNRSTN_USR->error_log('FF TRANSFER[' . $wheels_high_awesome_cnt.']=>' . $filePath, __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

            }else{

                if($wheels_high_awesome_cnt>($total_wheels_count-5)){

                    $this->oCRNRSTN_USR->error_log('FF TRANSFER[' . $wheels_high_awesome_cnt.']=>' . $filePath, __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                }

            }

            $this->oWheel_high_awesome_ARRAY[$execution_serial][] = $oWheel_high_awesome;

        }

        if($total_wheels_dir_count>0){

            //
            // PROCESS EMPTY DIRECTORY MOVES
            foreach($this->directory_dir_content_ARRAY[$oEndpoint_serial] as $filePath => $key){

                //
                // CHECK FOR CONFIGURED EXCLUSIONS
                $exclusion_check_result = $this->isNotExcluded_asset($filePath, $execution_batch_serial, $FIREHOT_oEndpoint_SOURCE);

                $wheels_high_awesome_cnt++;
                $oWheel_high_awesome = new crnrstn_wheel_high_awesome_eyes($execution_serial, $FIREHOT_oEndpoint_SOURCE, $FIREHOT_oEndpoint_DESTINATION, $this->oCRNRSTN_USR, $total_wheels_count, $wheels_high_awesome_cnt, $exclusion_check_result);

                $oWheel_high_awesome->receive_asset_meta($filePath, $this);

                $oWheel_high_awesome->init_fileSize_bytes(0);

                //
                // QUESTION :: WHO RUN IT...WHO RUN IT!?! ANSWER :: THE LORD RUNS IT.
                if($oWheel_high_awesome->process_dir_asset($filePath, 'FF', $execution_serial, $execution_batch_serial, $hot_src_connection_ARRAY, $hot_dest_connection_ARRAY, $this, $this->oElectrum_STATS)){
                    //if($oWheel_high_awesome->process_dir_asset($filePath, 'FF', $execution_serial, $execution_batch_serial, $hot_src_connection_ARRAY, $hot_dest_connection_ARRAY, $this)){

                    //
                    // INCREMENT TRANSFER COUNT TO DESTINATION
                    $this->oElectrum_STATS->plus_one_asset_transfer($oEndpoint_serial, $oEndpoint_serial_dest, $execution_serial, $execution_batch_serial, 0);

                }

                if($wheels_high_awesome_cnt<5){

                    $this->oCRNRSTN_USR->error_log('FF TRANSFER[' . $wheels_high_awesome_cnt.']=>' . $filePath, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

                }else{

                    if($wheels_high_awesome_cnt>($total_wheels_count-5)){

                        $this->oCRNRSTN_USR->error_log('FF TRANSFER[' . $wheels_high_awesome_cnt.']=>' . $filePath, __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                    }

                }

                $this->oWheel_high_awesome_ARRAY[$execution_serial][] = $oWheel_high_awesome;

            }

        }

    }

    public function return_FF_tmp_dirPath(){

        return $this->FtpToFtp_tmp_dirPath;

    }

    private function electrum_datamover_FD($execution_serial, $execution_batch_serial, $hot_src_connection_ARRAY, $hot_dest_connection_ARRAY){

        $FIREHOT_oEndpoint_SOURCE = $hot_src_connection_ARRAY['FIREHOT_oEndpoint'];
        $FIREHOT_oEndpoint_DESTINATION = $hot_dest_connection_ARRAY['FIREHOT_oEndpoint'];

        if(isset($this->timestamp_nom_pattern)){

            $FIREHOT_oEndpoint_SOURCE->add_directory_nom_pattern($this->timestamp_nom_pattern);
            $this->oElectrum_STATS->init_directory_datestamp_nom($FIREHOT_oEndpoint_SOURCE->return_serial(), $FIREHOT_oEndpoint_SOURCE->return_timestamp_nom());

        }

        //
        // ENDPOINT SERIAL
        $oEndpoint_serial = $FIREHOT_oEndpoint_SOURCE->return_serial();
        $oEndpoint_serial_dest = $FIREHOT_oEndpoint_DESTINATION->return_serial();

        //
        // ENDPOINT WCR KEY OR PATH (IF LOCAL DIRECTORY VIA INPUT PARAMETER)
        //$oEndpoint_WCRkey_or_path = $FIREHOT_oEndpoint_SOURCE->return_WCRkey_or_PATH();

        $total_wheels_count = sizeof($this->directory_content_ARRAY[$oEndpoint_serial]);

        if(isset($this->directory_dir_content_ARRAY[$oEndpoint_serial])){

            $total_wheels_dir_count = sizeof($this->directory_dir_content_ARRAY[$oEndpoint_serial]);

        }else{

            $total_wheels_dir_count = 0;

        }

        $total_wheels_count += $total_wheels_dir_count;

        //
        // CRNRSTN :: ELECTRUM SUB-REQUEST TOTAL FILE SIZE (bytes)
        $tmp_file_size_total_bytes = $this->source_total_filesize_ARRAY[$oEndpoint_serial][0];
        $tmp_file_size_total = $this->oCRNRSTN_USR->format_bytes($tmp_file_size_total_bytes, 5);

        //
        // TOTAL AVAILABLE STORAGE SIZE AT DESTINATION (bytes)
        $tmp_destination_capacity_bytes = $FIREHOT_oEndpoint_DESTINATION->return_availableByteCapacity();
        $tmp_destination_diskSize_bytes = $FIREHOT_oEndpoint_DESTINATION->return_hardDriveSize();
        $tmp_destination_capacity = $this->oCRNRSTN_USR->format_bytes($tmp_destination_capacity_bytes, 5);

        //
        // CALCULATE PERCENTAGE UTILIZATION OF REQUEST
        $percentage_utilization_ask = 100-((($tmp_file_size_total + ($tmp_destination_diskSize_bytes-$tmp_destination_capacity))/$tmp_destination_diskSize_bytes)*100);

        if($percentage_utilization_ask > $this->max_storage_utilization){

            $percentage_utilization_ask = 100-((($tmp_file_size_total + ($tmp_destination_diskSize_bytes-$tmp_destination_capacity))/$tmp_destination_diskSize_bytes)*100);

            //
            // HOOOSTON...VE HAF PROBLEM!
            throw new Exception('The CRNRSTN :: Electrum max local DIR destination storage utilization has been exceeded with an ask which would result in ' . $percentage_utilization_ask.'% usage. This being when ' . $this->max_storage_utilization.'% is the currently configured maximum [See electrum_doNotPassDiskUsagePercent()]. For the record, only ' . $tmp_destination_capacity.' is available at ' . $FIREHOT_oEndpoint_DESTINATION->return_LOCAL_DIR_PATH().'.');

        }else{
            
            $this->oCRNRSTN_USR->error_log('The CRNRSTN :: Electrum process is handling FD asset transfer of ' . $total_wheels_count.' assets from ' . $FIREHOT_oEndpoint_SOURCE->return_FTP_SERVER().'::' . $FIREHOT_oEndpoint_SOURCE->return_FTP_PORT().' @ [DIR::' . $FIREHOT_oEndpoint_SOURCE->return_FTP_DIR_PATH().'] to DIR[' . $FIREHOT_oEndpoint_DESTINATION->return_LOCAL_DIR_PATH().'].', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

            $wheels_high_awesome_cnt = 0;
            foreach($this->directory_content_ARRAY[$oEndpoint_serial] as $key => $filePath){

                //
                // CHECK FOR CONFIGURED EXCLUSIONS
                $exclusion_check_result = $this->isNotExcluded_asset($filePath, $execution_batch_serial, $FIREHOT_oEndpoint_SOURCE);

                $wheels_high_awesome_cnt++;
                $oWheel_high_awesome = new crnrstn_wheel_high_awesome_eyes($execution_serial, $FIREHOT_oEndpoint_SOURCE, $FIREHOT_oEndpoint_DESTINATION, $this->oCRNRSTN_USR, $total_wheels_count, $wheels_high_awesome_cnt, $exclusion_check_result);

                $oWheel_high_awesome->receive_asset_meta($filePath, $this);

                if(isset($this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filePath])){

                    if($this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filePath]!=-1) {

                        $oWheel_high_awesome->init_fileSize_bytes($this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filePath]);

                    }
                }

                //
                // QUESTION :: WHO RUN IT...WHO RUN IT!?! ANSWER :: THE LORD RUNS IT.
                if($oWheel_high_awesome->process_asset($filePath, 'FD', $execution_serial, $execution_batch_serial, $hot_src_connection_ARRAY, $hot_dest_connection_ARRAY, $this, $this->oElectrum_STATS)){

                    //
                    // INCREMENT TRANSFER COUNT TO DESTINATION
                    $this->oElectrum_STATS->plus_one_asset_transfer($oEndpoint_serial, $oEndpoint_serial_dest, $execution_serial, $execution_batch_serial, $this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filePath]);

                }

                if ($wheels_high_awesome_cnt < 5) {

                    $this->oCRNRSTN_USR->error_log('FD TRANSFER[' . $wheels_high_awesome_cnt . ']=>' . $filePath, __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                } else {

                    if ($wheels_high_awesome_cnt > ($total_wheels_count - 5)) {

                        $this->oCRNRSTN_USR->error_log('FD TRANSFER[' . $wheels_high_awesome_cnt . ']=>' . $filePath, __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                    }

                }

                $this->oWheel_high_awesome_ARRAY[$execution_serial][] = $oWheel_high_awesome;

            }

            if($total_wheels_dir_count>0){

                //
                // EMPTY DIRECTORIES FROM FTP TO PUSH TO LOCAL DIRECTORY
                foreach($this->directory_dir_content_ARRAY[$oEndpoint_serial] as $filePath => $key){

                    //
                    // CHECK FOR CONFIGURED EXCLUSIONS
                    $exclusion_check_result = $this->isNotExcluded_asset($filePath, $execution_batch_serial, $FIREHOT_oEndpoint_SOURCE);

                    $wheels_high_awesome_cnt++;
                    $oWheel_high_awesome = new crnrstn_wheel_high_awesome_eyes($execution_serial, $FIREHOT_oEndpoint_SOURCE, $FIREHOT_oEndpoint_DESTINATION, $this->oCRNRSTN_USR, $total_wheels_count, $wheels_high_awesome_cnt, $exclusion_check_result);

                    $oWheel_high_awesome->receive_asset_meta($filePath, $this);

                    $oWheel_high_awesome->init_fileSize_bytes(0);

                    //
                    // QUESTION :: WHO RUN IT...WHO RUN IT!?! ANSWER :: THE LORD RUNS IT.
                    //if($oWheel_high_awesome->process_dir_asset($filePath, 'FD', $execution_serial, $execution_batch_serial, $hot_src_connection_ARRAY, $hot_dest_connection_ARRAY, $this)){
                    if($oWheel_high_awesome->process_dir_asset($filePath, 'FD', $execution_serial, $execution_batch_serial, $hot_src_connection_ARRAY, $hot_dest_connection_ARRAY, $this, $this->oElectrum_STATS)){

                        //
                        // INCREMENT TRANSFER COUNT TO DESTINATION
                        $this->oElectrum_STATS->plus_one_asset_transfer($oEndpoint_serial, $oEndpoint_serial_dest, $execution_serial, $execution_batch_serial, 0);

                    }

                    if ($wheels_high_awesome_cnt < 5) {

                        $this->oCRNRSTN_USR->error_log('FD TRANSFER[' . $wheels_high_awesome_cnt . ']=>' . $filePath, __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                    } else {

                        if ($wheels_high_awesome_cnt > ($total_wheels_count - 5)) {

                            $this->oCRNRSTN_USR->error_log('FD TRANSFER[' . $wheels_high_awesome_cnt . ']=>' . $filePath, __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                        }

                    }

                    $this->oWheel_high_awesome_ARRAY[$execution_serial][] = $oWheel_high_awesome;

                }

            }

        }

    }

    private function electrum_datamover_DF($execution_serial, $execution_batch_serial, $hot_src_connection_ARRAY, $hot_dest_connection_ARRAY){

        $tmp_timestamp_nom = array();
        $FIREHOT_oEndpoint_SOURCE = $hot_src_connection_ARRAY['FIREHOT_oEndpoint'];
        $FIREHOT_oEndpoint_DESTINATION = $hot_dest_connection_ARRAY['FIREHOT_oEndpoint'];

        if(isset($this->timestamp_nom_pattern)){

            $FIREHOT_oEndpoint_SOURCE->add_directory_nom_pattern($this->timestamp_nom_pattern);
            $this->oElectrum_STATS->init_directory_datestamp_nom($FIREHOT_oEndpoint_SOURCE->return_serial(), $FIREHOT_oEndpoint_SOURCE->return_timestamp_nom());

        }

        //
        // ENDPOINT SERIAL
        $oEndpoint_serial = $FIREHOT_oEndpoint_SOURCE->return_serial();
        $oEndpoint_serial_dest = $FIREHOT_oEndpoint_DESTINATION->return_serial();

        //
        // ENDPOINT WCR KEY OR PATH (IF LOCAL DIRECTORY VIA INPUT PARAMETER)
        //$oEndpoint_WCRkey_or_path = $FIREHOT_oEndpoint_SOURCE->return_WCRkey_or_PATH();

        $total_wheels_count = sizeof($this->directory_content_ARRAY[$oEndpoint_serial]);
        $this->oCRNRSTN_USR->error_log('The CRNRSTN :: Electrum process is handling DF asset transfer of ' . $total_wheels_count.' assets[' . $this->oCRNRSTN_USR->format_bytes($this->source_total_filesize_ARRAY[$oEndpoint_serial][0], 4).'] ' . $FIREHOT_oEndpoint_DESTINATION->return_FTP_SERVER().'::' . $FIREHOT_oEndpoint_DESTINATION->return_FTP_PORT().' to ' . $FIREHOT_oEndpoint_DESTINATION->return_FTP_DIR_PATH(), __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $wheels_high_awesome_cnt = 0;
        foreach($this->directory_content_ARRAY[$oEndpoint_serial] as $filePath => $key){

            //
            // CHECK FOR CONFIGURED EXCLUSIONS
            $exclusion_check_result = $this->isNotExcluded_asset($filePath, $execution_batch_serial, $FIREHOT_oEndpoint_SOURCE);

            $wheels_high_awesome_cnt++;
            $oWheel_high_awesome = new crnrstn_wheel_high_awesome_eyes($execution_serial, $FIREHOT_oEndpoint_SOURCE, $FIREHOT_oEndpoint_DESTINATION, $this->oCRNRSTN_USR, $total_wheels_count, $wheels_high_awesome_cnt, $exclusion_check_result);

            $oWheel_high_awesome->receive_asset_meta($filePath, $this);

            if(isset($this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filePath])){

                if($this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filePath]!=-1) {

                    $oWheel_high_awesome->init_fileSize_bytes($this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filePath]);

                }
            }

            //
            // QUESTION :: WHO RUN IT...WHO RUN IT!?! ANSWER :: THE LORD RUNS IT.
            if($oWheel_high_awesome->process_asset($filePath, 'DF', $execution_serial, $execution_batch_serial, $hot_src_connection_ARRAY, $hot_dest_connection_ARRAY, $this, $this->oElectrum_STATS)){

                //
                // INCREMENT TRANSFER COUNT TO DESTINATION
                $this->oElectrum_STATS->plus_one_asset_transfer($oEndpoint_serial, $oEndpoint_serial_dest, $execution_serial, $execution_batch_serial, $this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filePath]);

            }

            if ($wheels_high_awesome_cnt < 5) {

                $this->oCRNRSTN_USR->error_log('DF TRANSFER[' . $wheels_high_awesome_cnt . ']=>' . $filePath, __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

            } else {

                if ($wheels_high_awesome_cnt > ($total_wheels_count - 5)) {

                    $this->oCRNRSTN_USR->error_log('DF TRANSFER[' . $wheels_high_awesome_cnt . ']=>' . $filePath, __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                }

            }

            $this->oWheel_high_awesome_ARRAY[$execution_serial][] = $oWheel_high_awesome;

        }

    }

    private function electrum_datamover_DD($execution_serial, $execution_batch_serial, $hot_src_connection_ARRAY, $hot_dest_connection_ARRAY){

        try{

            $tmp_timestamp_nom = array();
            $FIREHOT_oEndpoint_SOURCE = $hot_src_connection_ARRAY['FIREHOT_oEndpoint'];
            $FIREHOT_oEndpoint_DESTINATION = $hot_dest_connection_ARRAY['FIREHOT_oEndpoint'];

            if(isset($this->timestamp_nom_pattern)){

                $FIREHOT_oEndpoint_SOURCE->add_directory_nom_pattern($this->timestamp_nom_pattern);
                $this->oElectrum_STATS->init_directory_datestamp_nom($FIREHOT_oEndpoint_SOURCE->return_serial(), $FIREHOT_oEndpoint_SOURCE->return_timestamp_nom());

            }

            //
            // ENDPOINT SERIAL
            $oEndpoint_serial = $FIREHOT_oEndpoint_SOURCE->return_serial();
            $oEndpoint_serial_dest = $FIREHOT_oEndpoint_DESTINATION->return_serial();

            //
            // ENDPOINT WCR KEY OR PATH (IF LOCAL DIRECTORY VIA INPUT PARAMETER)
            //$oEndpoint_WCRkey_or_path = $FIREHOT_oEndpoint_SOURCE->return_WCRkey_or_PATH();

            //
            // CRNRSTN :: ELECTRUM SUB-REQUEST TOTAL FILE SIZE (bytes)
            $tmp_file_size_total_bytes = $this->source_total_filesize_ARRAY[$oEndpoint_serial][0];
            $tmp_file_size_total = $this->oCRNRSTN_USR->format_bytes($tmp_file_size_total_bytes, 5);

            //
            // TOTAL AVAILABLE STORAGE SIZE AT DESTINATION (bytes)
            $tmp_destination_capacity_bytes = $FIREHOT_oEndpoint_DESTINATION->return_availableByteCapacity();
            $tmp_destination_diskSize_bytes = $FIREHOT_oEndpoint_DESTINATION->return_hardDriveSize();
            $tmp_destination_capacity = $this->oCRNRSTN_USR->format_bytes($tmp_destination_capacity_bytes, 5);

            //
            // CALCULATE PERCENTAGE UTILIZATION OF REQUEST
            $percentage_utilization_ask = 100-((($tmp_file_size_total + ($tmp_destination_diskSize_bytes-$tmp_destination_capacity))/$tmp_destination_diskSize_bytes)*100);

            if($percentage_utilization_ask > $this->max_storage_utilization){

                $percentage_utilization_ask = 100-((($tmp_file_size_total + ($tmp_destination_diskSize_bytes-$tmp_destination_capacity))/$tmp_destination_diskSize_bytes)*100);

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('The CRNRSTN :: Electrum max local DIR destination storage utilization has been exceeded with an ask which would result in ' . $percentage_utilization_ask.'% usage. This being when ' . $this->max_storage_utilization.'% is the currently configured maximum [See electrum_doNotPassDiskUsagePercent()]. For the record, only ' . $tmp_destination_capacity.' is available at ' . $FIREHOT_oEndpoint_DESTINATION->return_LOCAL_DIR_PATH().'.');

            }else{

                //$this->oCRNRSTN_USR->error_log('The CRNRSTN :: Electrum process is handling DD[' . $tmp_file_size_total . ' required/' . $tmp_destination_capacity.' avail] asset transfer of ' . $total_wheels_count.' assets[' . $this->oCRNRSTN_USR->format_bytes($this->source_total_filesize_ARRAY[$oEndpoint_serial][0], 4).'] to ' . $FIREHOT_oEndpoint_DESTINATION->return_LOCAL_DIR_PATH().'.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                $wheels_high_awesome_cnt = 0;
                $total_wheels_count = sizeof($this->directory_content_ARRAY[$oEndpoint_serial]);
                foreach($this->directory_content_ARRAY[$oEndpoint_serial] as $filePath => $key){

                    //
                    // CHECK FOR CONFIGURED EXCLUSIONS
                    $exclusion_check_result = $this->isNotExcluded_asset($filePath, $execution_batch_serial, $FIREHOT_oEndpoint_SOURCE);

                    $wheels_high_awesome_cnt++;
                    $oWheel_high_awesome = new crnrstn_wheel_high_awesome_eyes($execution_serial, $FIREHOT_oEndpoint_SOURCE, $FIREHOT_oEndpoint_DESTINATION, $this->oCRNRSTN_USR, $total_wheels_count, $wheels_high_awesome_cnt, $exclusion_check_result);

                    $oWheel_high_awesome->receive_asset_meta($filePath, $this);

                    if(isset($this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filePath])){

                        if($this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filePath]!=-1) {

                            $oWheel_high_awesome->init_fileSize_bytes($this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filePath]);

                        }
                    }

                    //
                    // QUESTION :: WHO RUN IT...WHO RUN IT!?! ANSWER :: THE LORD RUNS IT.
                    if($oWheel_high_awesome->process_asset($filePath, 'DD', $execution_serial, $execution_batch_serial, $hot_src_connection_ARRAY, $hot_dest_connection_ARRAY, $this, $this->oElectrum_STATS)){

                        //
                        // INCREMENT TRANSFER COUNT TO DESTINATION
                        $this->oElectrum_STATS->plus_one_asset_transfer($oEndpoint_serial, $oEndpoint_serial_dest, $execution_serial, $execution_batch_serial, $this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filePath]);

                    }

                    if ($wheels_high_awesome_cnt < 5) {

                        $this->oCRNRSTN_USR->error_log('DD TRANSFER[' . $wheels_high_awesome_cnt . ']=>' . $filePath, __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                    } else {

                        if ($wheels_high_awesome_cnt > ($total_wheels_count - 5)) {

                            $this->oCRNRSTN_USR->error_log('DD TRANSFER[' . $wheels_high_awesome_cnt . ']=>' . $filePath, __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                        }

                    }

                    $this->oWheel_high_awesome_ARRAY[$execution_serial][] = $oWheel_high_awesome;

                }

            }

        }catch( Exception $e ) {

            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
            return false;

        }

    }

    private function process_sub_batch_asset_transfer($execution_serial, $execution_batch_serial, $hot_src_connection_ARRAY, $hot_dest_connection_ARRAY){

        # $hot_src_connection_ARRAY['oLightning_ftp_conn']
        # $hot_src_connection_ARRAY['FIREHOT_oEndpoint']
        # $hot_dest_connection_ARRAY['oLightning_ftp_conn']
        # $hot_dest_connection_ARRAY['FIREHOT_oEndpoint']
        $this->oCRNRSTN_USR->error_log('****** START CRNRSTN :: ELECTRUM SUB-BATCH DATA COPY REQUEST ******', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        try{

            $tmp_transfer_profile = '';

            $FIREHOT_oEndpoint_SOURCE = $hot_src_connection_ARRAY['FIREHOT_oEndpoint'];
            $FIREHOT_oEndpoint_SOURCE->log_connection_status('batch transfer :: source endpoint initialization start');

            $FIREHOT_oEndpoint_DESTINATION = $hot_dest_connection_ARRAY['FIREHOT_oEndpoint'];
            $FIREHOT_oEndpoint_DESTINATION->log_connection_status('batch transfer :: destination endpoint initialization start');

            $this->oCRNRSTN_USR->error_log('****** SOURCE ENDPOINT HANDLING START PROCESS - DATA COPY REQUEST ******', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

            //
            // SOURCE ENDPOINT HANDLING - DO WE HAVE FTP CONN?
            if(!is_object($hot_src_connection_ARRAY['oLightning_ftp_conn'])){

                //
                // DIRECTORY SOURCE
                $tmp_transfer_profile .= 'D';

                $tmp_src_DIR_PATH = $FIREHOT_oEndpoint_SOURCE->return_LOCAL_DIR_PATH();

                if(!is_dir($tmp_src_DIR_PATH)){

                    $local_oWCR_key = $FIREHOT_oEndpoint_SOURCE->return_local_oWCR_key();
                    $tmp_src_DIR_PATH = $this->oCRNRSTN_USR->get_resource('LOCAL_DIR_PATH', $local_oWCR_key);

                }

                $this->oCRNRSTN_USR->error_log('****** SOURCE ENDPOINT = DIRECTORY[' . $tmp_src_DIR_PATH.'] ******', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                if($this->validate_DIR_endpoint('SOURCE', $tmp_src_DIR_PATH)) {

                    $FIREHOT_oEndpoint_SOURCE->log_connection_status('batch transfer :: source validation complete');

                    $tmp_serial = $FIREHOT_oEndpoint_SOURCE->return_serial();

                    if(!isset($this->directory_content_ARRAY[$tmp_serial])){

                        $local_dir_contents_SOURCE = $this->localdir_list_files_recursive($tmp_src_DIR_PATH, $tmp_serial);

                        $this->directory_content_ARRAY[$tmp_serial] = $local_dir_contents_SOURCE;

                        if($local_dir_contents_SOURCE){

                            //
                            // WE HAVE LIST OF ASSETS AT SOURCE DIR ENDPOINT
                            $FIREHOT_oEndpoint_SOURCE->log_connection_status('batch transfer :: local directory file listing['.sizeof($local_dir_contents_SOURCE).' total] complete');

                        }

                    }

                }else{

                    $this->global_execute_authorization = false;
                    $this->global_execute_authorization_reason = 'ERR420.5 - Invalid directory location (or read permissions) at SOURCE endpoint directory, ' . $tmp_src_DIR_PATH.'.';

                    if(is_dir($tmp_src_DIR_PATH)){

                        $tmp_current_perms = substr(decoct( fileperms($tmp_src_DIR_PATH) ), 2);

                    }else{

                        $tmp_current_perms = 'invalid path';

                    }

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('The CRNRSTN :: Electrum batch process has failed due to a provided source directory endpoint (' . $tmp_src_DIR_PATH.') being an invalid source (' . $tmp_current_perms.') for asset retrieval.');

                }

            }else{

                //
                // FTP SOURCE
                $tmp_transfer_profile .= 'F';
                $oLightning_ftp_conn_SOURCE = $hot_src_connection_ARRAY['oLightning_ftp_conn'];
                $tmp_src_ftp_stream = $oLightning_ftp_conn_SOURCE->return_ftp_stream();
                $tmp_src_FTP_SERVER = $FIREHOT_oEndpoint_SOURCE->return_FTP_SERVER();
                $tmp_src_FTP_USERNAME = $FIREHOT_oEndpoint_SOURCE->return_FTP_USERNAME();
                $tmp_src_FTP_PASSWORD = $FIREHOT_oEndpoint_SOURCE->return_FTP_PASSWORD();
                $tmp_src_FTP_PORT = $FIREHOT_oEndpoint_SOURCE->return_FTP_PORT();
                $tmp_src_FTP_DIR_PATH = $FIREHOT_oEndpoint_SOURCE->return_FTP_DIR_PATH();

                $tmp_endpoint_id = md5($tmp_src_FTP_SERVER.$tmp_src_FTP_USERNAME.$tmp_src_FTP_PASSWORD.$tmp_src_FTP_PORT);
                $this->oCRNRSTN_USR->error_log('****** SOURCE ENDPOINT = FTP[' . $tmp_src_FTP_SERVER.'][' . $tmp_src_FTP_DIR_PATH.'] ******', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                //
                // EXTRACT ALL FILE PATH
                $tmp_config_serial = $this->oCRNRSTN_USR->return_config_serial();
                $_SESSION['CRNRSTN_' . $this->oCRNRSTN_USR->crcINT($tmp_config_serial)]['CRNRSTN_EXCEPTION_PREFIX'] = 'The CRNRSTN :: Electrum process has experienced FTP directory access related error on ' . $tmp_src_FTP_SERVER.'::' . $tmp_src_FTP_PORT.' when accessing the destination directory, ' . $tmp_src_FTP_DIR_PATH.' as ';

                $tmp_serial = $FIREHOT_oEndpoint_SOURCE->return_serial();
                if(!isset($this->directory_content_ARRAY[$tmp_serial])) {

                    $ftp_contents_SOURCE = $this->ftp_list_files_recursive($tmp_src_ftp_stream, $tmp_src_FTP_DIR_PATH, $tmp_serial);

                    $ftp_contents_DIR_SOURCE = $this->merge_ftp_dir_array_to_file($ftp_contents_SOURCE, $tmp_serial);

                    if($ftp_contents_SOURCE){

                        $this->directory_content_ARRAY[$tmp_serial] = $ftp_contents_SOURCE;
                        $this->directory_dir_content_ARRAY[$tmp_serial] = $ftp_contents_DIR_SOURCE;

                        //
                        // WE HAVE LIST OF ASSETS AT SOURCE FTP ENDPOINT
                        $FIREHOT_oEndpoint_SOURCE->connection_status = 'batch transfer :: FTP directory file listing['.sizeof($ftp_contents_SOURCE).' total] complete';
                        $FIREHOT_oEndpoint_SOURCE->connection_status_log[] = 'batch transfer :: FTP directory file listing['.sizeof($ftp_contents_SOURCE).' total] complete';

                    }else{

                        $this->global_execute_authorization = false;
                        $this->global_execute_authorization_reason = 'ERR420.5 - Invalid FTP path location (or read permissions) at SOURCE FTP endpoint ' . $tmp_src_FTP_SERVER.'::' . $tmp_src_FTP_PORT.', with path of ' . $tmp_src_FTP_DIR_PATH.'.';

                    }
                }

                $_SESSION['CRNRSTN_' . $this->oCRNRSTN_USR->crcINT($tmp_config_serial)]['CRNRSTN_EXCEPTION_PREFIX'] = '';

            }

            $this->oCRNRSTN_USR->error_log('****** DESTINATION ENDPOINT HANDLING START PROCESS - DATA COPY REQUEST ******', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

            //
            // DESTINATION ENDPOINT HANDLING
            if(!is_object($hot_dest_connection_ARRAY['oLightning_ftp_conn'])){

                //
                // DIRECTORY DESTINATION
                $tmp_transfer_profile .= 'D';

                $tmp_dest_DIR = $FIREHOT_oEndpoint_DESTINATION->return_LOCAL_DIR_PATH();
                $mkdir_permissons_mode = $FIREHOT_oEndpoint_DESTINATION->return_LOCAL_MKDIR_MODE();

                if(!is_dir($tmp_dest_DIR)){

                    $tmp_local_oWCR_key = $FIREHOT_oEndpoint_DESTINATION->return_local_oWCR_key();

                    //error_log('560 - (' . $mkdir_permissons_mode.')tmp_local_oWCR_key=' . $tmp_local_oWCR_key.' & tmp_dest_DIR=' . $tmp_dest_DIR);
                    $tmp_dest_DIR = $this->oCRNRSTN_USR->get_resource('LOCAL_DIR_PATH', $tmp_local_oWCR_key);
                    $mkdir_permissons_mode = $this->oCRNRSTN_USR->get_resource('LOCAL_MKDIR_MODE', $tmp_local_oWCR_key);

                }

                $this->oCRNRSTN_USR->error_log('****** DESTINATION ENDPOINT = DIRECTORY[' . $tmp_dest_DIR.'] ******', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                if ($this->validate_DIR_endpoint('DESTINATION', $tmp_dest_DIR, $mkdir_permissons_mode)) {

                    $FIREHOT_oEndpoint_DESTINATION->log_connection_status('batch transfer :: destination validation complete');

                }else{

                    if(is_dir($tmp_dest_DIR)){

                        $tmp_current_perms = substr(decoct( fileperms($tmp_dest_DIR) ), 2);

                    }else{

                        $tmp_current_perms = 'invalid path';

                    }

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('The CRNRSTN :: Electrum batch process has failed due to a provided destination directory endpoint (' . $tmp_dest_DIR.') being an invalid source (' . $tmp_current_perms.') for temporary asset storage.');

                }

            }else{

                //
                // FTP DESTINATION
                $tmp_transfer_profile .= 'F';
                $oLightning_ftp_conn_DESTINATION = $hot_dest_connection_ARRAY['oLightning_ftp_conn'];
                //$tmp_dest_ftp_stream = $oLightning_ftp_conn_DESTINATION->return_ftp_stream();
                $tmp_dest_FTP_SERVER = $FIREHOT_oEndpoint_DESTINATION->return_FTP_SERVER();
                //$tmp_dest_FTP_PORT = $FIREHOT_oEndpoint_DESTINATION->return_FTP_PORT();
                $tmp_dest_FTP_DIR_PATH = $FIREHOT_oEndpoint_DESTINATION->return_FTP_DIR_PATH();

                $this->oCRNRSTN_USR->error_log('****** DESTINATION ENDPOINT ERROR = FTP[' . $tmp_dest_FTP_SERVER.'][' . $tmp_dest_FTP_DIR_PATH.'] ******', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

            }

            $this->oCRNRSTN_USR->error_log('****** PROCESS ->' . $tmp_transfer_profile.'<- DATA COPY REQUEST ******', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

            switch($tmp_transfer_profile){
                case 'FF':

                    //
                    // FTP TO FTP
                    $this->electrum_datamover_FF($execution_serial, $execution_batch_serial, $hot_src_connection_ARRAY, $hot_dest_connection_ARRAY);

                break;
                case 'DD':

                    //
                    // DIR TO DIR
                    $this->electrum_datamover_DD($execution_serial, $execution_batch_serial, $hot_src_connection_ARRAY, $hot_dest_connection_ARRAY);

                break;
                case 'FD':

                    //
                    // FTP TO DIR
                    $this->electrum_datamover_FD($execution_serial, $execution_batch_serial, $hot_src_connection_ARRAY, $hot_dest_connection_ARRAY);

                break;
                case 'DF':

                    //
                    // DIR TO FTP
                    $this->electrum_datamover_DF($execution_serial, $execution_batch_serial, $hot_src_connection_ARRAY, $hot_dest_connection_ARRAY);

                break;

            }

        }catch( Exception $e ) {

            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
            return false;

        }

    }

    private function seeennd_it($execution_serial, $batch_serial){

        if($this->global_execute_authorization){

            //
            // FOR EACH SOURCE ENDPOINT
            foreach($this->queued_endpoint_ARRAY[$batch_serial]['SOURCE'] as $key_src => $hot_src_connection_ARRAY){

                //
                // SEND TO EACH DESTINATION ENDPOINT
                foreach($this->queued_endpoint_ARRAY[$batch_serial]['DESTINATION'] as $key_dest => $hot_dest_connection_ARRAY){

                    $this->process_sub_batch_asset_transfer($execution_serial, $batch_serial, $hot_src_connection_ARRAY, $hot_dest_connection_ARRAY);

                }
            }

        }else{

            $this->oCRNRSTN_USR->error_log('The CRNRSTN :: Electrum process is not configured to run properly, and it has locked down all asset transfer requests. Reason Code :: ' . $this->global_execute_authorization_reason, __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        }

    }

    private function add_batch_SOURCE($FIREHOT_oEndpoint, $batch_serial, $oLightning_ftp_conn=NULL){

        $tmp_array = array();
        $FIREHOT_oEndpoint->log_connection_status('source queued');

        $tmp_array['FIREHOT_oEndpoint'] = $FIREHOT_oEndpoint;

        if(isset($oLightning_ftp_conn)){

            //
            // QUEUE FTP ENDPOINT
            $oLightning_ftp_conn->log_connection_status('source queued');

            $tmp_array['oLightning_ftp_conn'] = $oLightning_ftp_conn;

            $this->queued_endpoint_ARRAY[$batch_serial]['SOURCE'][] = $tmp_array;

        }else{

            //
            // QUEUE DIRECTORY ENDPOINT
            $tmp_array['oLightning_ftp_conn'] = 0;
            $this->queued_endpoint_ARRAY[$batch_serial]['SOURCE'][] = $tmp_array;

        }

    }

    private function add_batch_DESTINATION($FIREHOT_oEndpoint, $batch_serial, $oLightning_ftp_conn=NULL){

        $tmp_array = array();
        $FIREHOT_oEndpoint->log_connection_status('destination queued');

        $tmp_array['FIREHOT_oEndpoint'] = $FIREHOT_oEndpoint;

        if(isset($oLightning_ftp_conn)){

            //
            // QUEUE FTP ENDPOINT
            $oLightning_ftp_conn->log_connection_status('destination queued');

            $tmp_array['oLightning_ftp_conn'] = $oLightning_ftp_conn;

            $this->queued_endpoint_ARRAY[$batch_serial]['DESTINATION'][] = $tmp_array;

        }else{

            //
            // QUEUE DIRECTORY ENDPOINT
            $tmp_array['oLightning_ftp_conn'] = 0;
            $this->queued_endpoint_ARRAY[$batch_serial]['DESTINATION'][] = $tmp_array;

        }

    }

    private function load_exclusion_profile($FIREHOT_oEndpoint){

        $FIREHOT_oEndpoint->asset_transfer_suppression_ARRAY = $this->asset_transfer_suppression_ARRAY;

        return $FIREHOT_oEndpoint;

    }

    public function execute($execution_serial){

        try{

            if(!isset($this->execute_from_source_authorization)){

                if(!isset($this->execute_to_destination_authorization)){

                    $this->oCRNRSTN_USR->error_log('The CRNRSTN :: Electrum process has not been configured with any source or destination endpoints.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);


                }else{

                    $this->oCRNRSTN_USR->error_log('The CRNRSTN :: Electrum process has not been configured with any source endpoints.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                }

            }else{

                if(!isset($this->execute_to_destination_authorization)){

                    $this->oCRNRSTN_USR->error_log('The CRNRSTN :: Electrum process has not been configured with any destination endpoints.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                }else{

                    //
                    // BOTH AUTH FLAGS ARE SET
                    if($this->execute_to_destination_authorization == true && $this->execute_from_source_authorization == true){

                        //
                        // BATCH EXECUTION SERIALIZATION
                        $batch_serial = $this->execution_batch_serial;

                        //
                        // RESET BATCH SERIAL IN PREPARATION FOR ANOTHER ELECTRUM EXECUTION (FORCE PROFILE RESET)
                        $this->execution_batch_serial = $this->oCRNRSTN_USR->generate_new_key(100);

                        //
                        // LOAD ALL ENDPOINT SOURCE
                        // $this->oLighting_bolt_ARRAY['SOURCE'][$endpoint_serial][$endpoint_id][$key] = $FIREHOT_oEndpoint;
                        foreach($this->oLighting_bolt_ARRAY['SOURCE'] as $endpoint_serial => $serial_ARRAY){

                            foreach($serial_ARRAY as $endpoint_id => $oEndpoint_ARRAY) {

                                foreach ($oEndpoint_ARRAY as $key => $FIREHOT_oEndpoint) {

                                    if (!isset($this->processed_source_ARRAY[$execution_serial][$endpoint_serial])) {
                                        $this->processed_source_ARRAY[$execution_serial][$endpoint_serial] = 1;

                                        $tmp_connection_type = $FIREHOT_oEndpoint->return_connection_type();

                                        switch($tmp_connection_type){
                                            case 'FTP':

                                                //
                                                // RETRIEVE FTP CONNECTION STREAM OBJECT
                                                $oLightning_ftp_conn = self::$oFourLivingCreatures_FTP->lightning_FTP_conn_ARRAY[$endpoint_id];

                                                $tmp_start_time_micro = $oLightning_ftp_conn->return_start_time_micro();
                                                $tmp_server = $FIREHOT_oEndpoint->return_FTP_SERVER();
                                                $tmp_FTP_DIR_PATH = $FIREHOT_oEndpoint->return_FTP_DIR_PATH();

                                                $this->oCRNRSTN_USR->error_log('FTP Connection status[' . $tmp_FTP_DIR_PATH.'] ready==' . $oLightning_ftp_conn->connection_status.'.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                                                if($oLightning_ftp_conn->connection_status == 'ready' || $oLightning_ftp_conn->connection_status == 'source FTP queued for execution by electrum'){

                                                    $this->oCRNRSTN_USR->error_log('QUEUE SOURCE Endpoint[' . $tmp_server . '][' . $tmp_FTP_DIR_PATH.'] start time=[' . $tmp_start_time_micro . ']', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM_THREAD);

                                                    //
                                                    // SOURCE FTP RECEIVES EXCLUSION PROFILE
                                                    $FIREHOT_oEndpoint = $this->load_exclusion_profile($FIREHOT_oEndpoint);
                                                    $this->oLighting_bolt_ARRAY['SOURCE'][$endpoint_serial][$endpoint_id][$key] = $FIREHOT_oEndpoint;

                                                    $this->add_batch_SOURCE($FIREHOT_oEndpoint, $batch_serial, $oLightning_ftp_conn);
                                                    $oLightning_ftp_conn->connection_status = 'source FTP queued for execution by electrum';
                                                    $oLightning_ftp_conn->connection_status_log[] = 'source FTP queued for execution by electrum';

                                                }

                                                self::$oFourLivingCreatures_FTP->lightning_FTP_conn_ARRAY[$endpoint_id] = $oLightning_ftp_conn;

                                            break;
                                            default:

                                                $tmp_path = $FIREHOT_oEndpoint->return_LOCAL_DIR_PATH();
                                                if(!is_dir($tmp_path)){

                                                    $tmp_local_oWCR_key = $FIREHOT_oEndpoint->return_local_oWCR_key();
                                                    $tmp_path = $this->oCRNRSTN_USR->get_resource('LOCAL_DIR_PATH', $tmp_local_oWCR_key);

                                                }

                                                $tmp_start_time_micro = $FIREHOT_oEndpoint->return_start_time_micro();
                                                $this->oCRNRSTN_USR->error_log('LOCAL_DIR Connection status[' . $tmp_path.'] ready==' . $FIREHOT_oEndpoint->connection_status.'.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                                                if($FIREHOT_oEndpoint->connection_status == 'ready' || $FIREHOT_oEndpoint->connection_status == 'source LOCAL DIR queued for execution by electrum'){

                                                    $this->oCRNRSTN_USR->error_log('QUEUE SOURCE Endpoint[' . $tmp_path . '] start time=[' . $tmp_start_time_micro . ']', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM_THREAD);

                                                    //
                                                    // SOURCE DIR RECEIVES EXCLUSION PROFILE
                                                    $FIREHOT_oEndpoint = $this->load_exclusion_profile($FIREHOT_oEndpoint);

                                                    $this->add_batch_SOURCE($FIREHOT_oEndpoint, $batch_serial);
                                                    $FIREHOT_oEndpoint->connection_status = 'source LOCAL DIR queued for execution by electrum';
                                                    $FIREHOT_oEndpoint->connection_status_log[] = 'source LOCAL DIR queued for execution by electrum';

                                                }

                                                $this->oLighting_bolt_ARRAY['SOURCE'][$endpoint_serial][$endpoint_id][] = $FIREHOT_oEndpoint;

                                            break;
                                        }

                                    }
                                }
                            }
                        }

                        foreach($this->oLighting_bolt_ARRAY['DESTINATION'] as $endpoint_serial => $serial_ARRAY){
                            foreach($serial_ARRAY as $endpoint_id => $oEndpoint_ARRAY){
                                foreach($oEndpoint_ARRAY as $key => $FIREHOT_oEndpoint){

                                    if(!isset($this->processed_source_ARRAY[$execution_serial][$endpoint_serial])){
                                        $this->processed_destination_ARRAY[$execution_serial][$endpoint_serial] = 1;

                                        $tmp_connection_type = $FIREHOT_oEndpoint->return_connection_type();

                                        switch($tmp_connection_type){
                                            case 'FTP':

                                                //
                                                // RETRIEVE FTP CONNECTION STREAM OBJECT
                                                $oLightning_ftp_conn = self::$oFourLivingCreatures_FTP->lightning_FTP_conn_ARRAY[$endpoint_id];
                                                $tmp_start_time_micro = $oLightning_ftp_conn->return_start_time_micro();
                                                $tmp_server = $FIREHOT_oEndpoint->return_FTP_SERVER();
                                                $tmp_FTP_DIR_PATH = $FIREHOT_oEndpoint->return_FTP_DIR_PATH();

                                                if($oLightning_ftp_conn->connection_status == 'ready' || $oLightning_ftp_conn->connection_status == 'source FTP queued for execution by electrum') {

                                                    $this->oCRNRSTN_USR->error_log('QUEUE DESTINATION Endpoint[' . $tmp_server . '/' . $tmp_FTP_DIR_PATH . '] start time=[' . $tmp_start_time_micro . ']', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM_THREAD);

                                                    $this->add_batch_DESTINATION($FIREHOT_oEndpoint, $batch_serial, $oLightning_ftp_conn);
                                                    $oLightning_ftp_conn->log_connection_status('destination FTP queued for execution by electrum');

                                                }

                                                self::$oFourLivingCreatures_FTP->lightning_FTP_conn_ARRAY[$endpoint_id] = $oLightning_ftp_conn;

                                            break;
                                            default:

                                                $tmp_local_dir_path = $FIREHOT_oEndpoint->return_LOCAL_DIR_PATH();

                                                if(!is_dir($tmp_local_dir_path)){

                                                    $tmp_local_oWCR_key = $FIREHOT_oEndpoint->return_local_oWCR_key();
                                                    //error_log('928 - tmp_local_dir_path=' . $tmp_local_dir_path.' || tmp_local_oWCR_key=' . $tmp_local_oWCR_key);
                                                    $tmp_local_dir_path = $this->oCRNRSTN_USR->get_resource('LOCAL_DIR_PATH', $tmp_local_oWCR_key);
                                                    $mkdir_permissons_mode = $this->oCRNRSTN_USR->get_resource('LOCAL_MKDIR_MODE', $tmp_local_oWCR_key);

                                                }

                                                $tmp_start_time_micro = $FIREHOT_oEndpoint->return_start_time_micro();

                                                $this->oCRNRSTN_USR->error_log('status==ready==' . $FIREHOT_oEndpoint->connection_status, __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM_THREAD);

                                                if($FIREHOT_oEndpoint->connection_status == 'ready') {

                                                    $this->oCRNRSTN_USR->error_log('QUEUE DESTINATION Endpoint[' . $tmp_local_dir_path . '] start time=[' . $tmp_start_time_micro . ']', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM_THREAD);

                                                    $this->add_batch_DESTINATION($FIREHOT_oEndpoint, $batch_serial);
                                                    $FIREHOT_oEndpoint->log_connection_status('destination DIR queued for execution by electrum');

                                                }

                                                $this->oLighting_bolt_ARRAY['SOURCE'][$endpoint_serial][$endpoint_id][] = $FIREHOT_oEndpoint;

                                            break;
                                        }
                                    }
                                }
                            }
                        }

                        //
                        // ALL ENDPOINTS AGGREGATED. SEEENND IT!
                        $this->seeennd_it($execution_serial, $batch_serial);

                        $this->endTime = $this->oCRNRSTN_USR->return_micro_time();
                        $this->elapsedTime = $this->oCRNRSTN_USR->elapsed_delta_time_for('ELECTRUM_PERFORMANCE_CLIENT');

                        //$this->elapsedTime = $this->elapsedTime + 12600000;

                        //
                        // PERFORMANCE REPORT COMMUNICATIONS
                        $this->fire_reportingNotification($execution_serial, $batch_serial);

                    }
                }
            }

            $this->execute_from_source_authorization = NULL;
            $this->execute_to_destination_authorization = NULL;

            flush();
            ob_flush();

        } catch (Exception $e) {

            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function addDestinationLOCAL($dirPath, $mkdir_permissons_mode){

        try{

            //
            // DIRECTORY
            $this->oCRNRSTN_USR->error_log('CRNRSTN :: Electrum Directory DESTINATION - integrity check beginning.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

            $tmp_MKDIR_MODE = $mkdir_permissons_mode;
            $tmp_DIR_PATH = $dirPath;

            $tmp_endpoint_id = md5($tmp_DIR_PATH);
            $tmp_endpoint_serial = $this->oCRNRSTN_USR->generate_new_key(100);

            if($this->ready_for_preload($tmp_endpoint_id) || $this->preload_endpoint_validation_fail[$tmp_endpoint_id]){

                //
                // DESTINATION DIRECTORY
                if($this->validate_DIR_endpoint('DESTINATION', $tmp_DIR_PATH, $tmp_MKDIR_MODE)){

                    //
                    // COMPLETE THE INTEGRATION OF ENDPOINT INTO THIS ELECTRUM
                    $FIREHOT_oEndpoint = new crnrstn_lightning_bolt($tmp_endpoint_serial, $this->oCRNRSTN_USR);

                    $FIREHOT_oEndpoint->initialize_destinationLOCAL_meta($tmp_DIR_PATH, $tmp_MKDIR_MODE);
                    $this->oLighting_bolt_ARRAY['DESTINATION'][$tmp_endpoint_serial][$tmp_endpoint_id][] = $FIREHOT_oEndpoint;

                    $this->preload_spoiled_ARRAY[$tmp_endpoint_id] = 1;

                    $this->execute_to_destination_authorization = true;

                    $this->endpoint_isValid_ARRAY[$tmp_endpoint_serial] = true;

                    $this->preload_endpoint_validation_fail[$tmp_endpoint_id] = false;

                    $tmp_current_perms = substr(decoct( fileperms($tmp_DIR_PATH) ), 2);

                    $this->oElectrum_STATS->add_valid_destination_DIR($tmp_DIR_PATH, $tmp_endpoint_serial, $tmp_endpoint_id, $tmp_current_perms, $tmp_MKDIR_MODE);

                }else{

                    $this->preload_endpoint_validation_fail[$tmp_endpoint_id] = true;

                    $this->endpoint_isValid_ARRAY[$tmp_endpoint_serial] = false;

                    if(!isset($this->execute_to_destination_authorization)){

                        $this->execute_to_destination_authorization = false;

                    }

                    $tmp_current_perms = substr(decoct( fileperms($tmp_DIR_PATH) ), 2);

                    $err_reason = '';
                    if(!is_dir($tmp_DIR_PATH)){

                        $err_reason = 'The path, ' . $tmp_DIR_PATH.', is not recognized by is_dir() as a directory.';

                    }else{

                        if(!is_writable($tmp_DIR_PATH)){

                            $err_reason = 'The path, ' . $tmp_DIR_PATH.', (' . $tmp_current_perms.') is not recognized by is_writable() as being a writable endpoint.';

                        }

                    }

                    $this->oElectrum_STATS->add_invalid_destination_DIR($tmp_DIR_PATH, $tmp_endpoint_serial, $tmp_endpoint_id, $tmp_current_perms, $tmp_MKDIR_MODE, $err_reason);

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    if(is_dir($tmp_DIR_PATH)){

                        throw new Exception('The CRNRSTN :: Electrum process is unable to access (or chmod to ' . $tmp_MKDIR_MODE.') the destination directory path ("' . $tmp_DIR_PATH.'" with ' . $tmp_current_perms.' mode) for writing which is preventing successful validation and preload of this endpoint.');

                    }else{

                        throw new Exception('The CRNRSTN :: Electrum process is unable to access the destination directory path (' . $tmp_DIR_PATH.') for writing which is preventing successful validation and preload of this endpoint.');

                    }

                }

            }else{

                //
                // COMPLETE THE INTEGRATION OF ENDPOINT INTO THIS ELECTRUM
                $FIREHOT_oEndpoint = new crnrstn_lightning_bolt($tmp_endpoint_serial, $this->oCRNRSTN_USR);

                $FIREHOT_oEndpoint->initialize_destinationLOCAL_meta($tmp_DIR_PATH, $tmp_MKDIR_MODE);
                $this->oLighting_bolt_ARRAY['DESTINATION'][$tmp_endpoint_serial][$tmp_endpoint_id][] = $FIREHOT_oEndpoint;

                $this->preload_spoiled_ARRAY[$tmp_endpoint_id] = 1;

                $this->execute_to_destination_authorization = true;

                $this->endpoint_isValid_ARRAY[$tmp_endpoint_serial] = true;

                $tmp_current_perms = substr(decoct( fileperms($tmp_DIR_PATH) ), 2);

                $this->oElectrum_STATS->add_valid_destination_DIR($tmp_DIR_PATH, $tmp_endpoint_serial, $tmp_endpoint_id, $tmp_current_perms, $tmp_MKDIR_MODE);


                $this->oCRNRSTN_USR->error_log('This CRNRSTN :: Electrum process has already validated this DESTINATION directory (' . $tmp_DIR_PATH.'), and so will accelerate via skipping the preload check.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

            }

        } catch (Exception $e) {

            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function addFlattenedDestinationLOCAL($dirPath, $mkdir_permissons_mode){

        try{

            //
            // DIRECTORY
            $this->oCRNRSTN_USR->error_log('CRNRSTN :: Electrum [FLATTEN ALL FILES] Directory DESTINATION - integrity check beginning.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

            $tmp_MKDIR_MODE = $mkdir_permissons_mode;
            $tmp_DIR_PATH = $dirPath;

            $tmp_endpoint_id = md5($tmp_DIR_PATH);
            $tmp_endpoint_serial = $this->oCRNRSTN_USR->generate_new_key(100);

            if($this->ready_for_preload($tmp_endpoint_id) || $this->preload_endpoint_validation_fail[$tmp_endpoint_id]){

                //
                // DESTINATION DIRECTORY
                if($this->validate_DIR_endpoint('DESTINATION', $tmp_DIR_PATH, $tmp_MKDIR_MODE)){

                    //
                    // COMPLETE THE INTEGRATION OF ENDPOINT INTO THIS ELECTRUM
                    $FIREHOT_oEndpoint = new crnrstn_lightning_bolt($tmp_endpoint_serial, $this->oCRNRSTN_USR);

                    $FIREHOT_oEndpoint->initialize_flattenedDestinationLOCAL_meta($tmp_DIR_PATH, $tmp_MKDIR_MODE);
                    $this->oLighting_bolt_ARRAY['DESTINATION'][$tmp_endpoint_serial][$tmp_endpoint_id][] = $FIREHOT_oEndpoint;

                    $this->preload_spoiled_ARRAY[$tmp_endpoint_id] = 1;

                    $this->execute_to_destination_authorization = true;

                    $this->endpoint_isValid_ARRAY[$tmp_endpoint_serial] = true;

                    $this->preload_endpoint_validation_fail[$tmp_endpoint_id] = false;

                    $tmp_current_perms = substr(decoct( fileperms($tmp_DIR_PATH) ), 2);

                    $this->oElectrum_STATS->add_valid_destination_DIR($tmp_DIR_PATH, $tmp_endpoint_serial, $tmp_endpoint_id, $tmp_current_perms, $tmp_MKDIR_MODE, true);

                }else{

                    $this->preload_endpoint_validation_fail[$tmp_endpoint_id] = true;

                    $this->endpoint_isValid_ARRAY[$tmp_endpoint_serial] = false;

                    if(!isset($this->execute_to_destination_authorization)){

                        $this->execute_to_destination_authorization = false;

                    }

                    $tmp_current_perms = substr(decoct( fileperms($tmp_DIR_PATH) ), 2);

                    $err_reason = '';
                    if(!is_dir($tmp_DIR_PATH)){

                        $err_reason = 'The path, ' . $tmp_DIR_PATH.', is not recognized by is_dir() as a directory.';

                    }else{

                        if(!is_writable($tmp_DIR_PATH)){

                            $err_reason = 'The path, ' . $tmp_DIR_PATH.', (' . $tmp_current_perms.') is not recognized by is_writable() as being a writable endpoint.';

                        }

                    }

                    $this->oElectrum_STATS->add_invalid_destination_DIR($tmp_DIR_PATH, $tmp_endpoint_serial, $tmp_endpoint_id, $tmp_current_perms, $tmp_MKDIR_MODE, $err_reason);

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    if(is_dir($tmp_DIR_PATH)){

                        $tmp_current_perms = substr(decoct( fileperms($tmp_DIR_PATH) ), 2);
                        throw new Exception('The CRNRSTN :: Electrum process is unable to access (or chmod to ' . $tmp_MKDIR_MODE.') the destination directory path ("' . $tmp_DIR_PATH.'" with ' . $tmp_current_perms.' mode) for writing which is preventing successful validation and preload of this endpoint.');

                    }else{

                        throw new Exception('The CRNRSTN :: Electrum process is unable to access the destination directory path (' . $tmp_DIR_PATH.') for writing which is preventing successful validation and preload of this endpoint.');

                    }

                }

            }else{

                //
                // COMPLETE THE INTEGRATION OF ENDPOINT INTO THIS ELECTRUM
                $FIREHOT_oEndpoint = new crnrstn_lightning_bolt($tmp_endpoint_serial, $this->oCRNRSTN_USR);

                $FIREHOT_oEndpoint->initialize_flattenedDestinationLOCAL_meta($tmp_DIR_PATH, $tmp_MKDIR_MODE);
                $this->oLighting_bolt_ARRAY['DESTINATION'][$tmp_endpoint_serial][$tmp_endpoint_id][] = $FIREHOT_oEndpoint;

                $this->preload_spoiled_ARRAY[$tmp_endpoint_id] = 1;

                $this->execute_to_destination_authorization = true;

                $this->endpoint_isValid_ARRAY[$tmp_endpoint_serial] = true;

                $tmp_current_perms = substr(decoct( fileperms($tmp_DIR_PATH) ), 2);

                $this->oElectrum_STATS->add_valid_destination_DIR($tmp_DIR_PATH, $tmp_endpoint_serial, $tmp_endpoint_id, $tmp_current_perms, $tmp_MKDIR_MODE, true);

                $this->oCRNRSTN_USR->error_log('This CRNRSTN :: Electrum process has already validated this DESTINATION directory (' . $tmp_DIR_PATH.'), and so will accelerate via skipping the preload check.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

            }

        } catch (Exception $e) {

            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }


    }

    public function addSourceLOCAL($dirPath){

        try{

            //
            // DIRECTORY
            $this->oCRNRSTN_USR->error_log('CRNRSTN :: Electrum Directory SOURCE - integrity check beginning.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

            $tmp_MKDIR_MODE = NULL;
            $tmp_DIR_PATH = $dirPath;

            $tmp_endpoint_id = md5($tmp_DIR_PATH);
            $tmp_endpoint_serial = $this->oCRNRSTN_USR->generate_new_key(100);

            if($this->ready_for_preload($tmp_endpoint_id) || $this->preload_endpoint_validation_fail[$tmp_endpoint_id]){

                if($this->validate_DIR_endpoint('SOURCE', $tmp_DIR_PATH)){

                    //
                    // COMPLETE THE INTEGRATION OF ENDPOINT INTO THIS ELECTRUM
                    $FIREHOT_oEndpoint = new crnrstn_lightning_bolt($tmp_endpoint_serial, $this->oCRNRSTN_USR);
                    $FIREHOT_oEndpoint->initialize_sourceLOCAL_meta($dirPath);

                    $this->oLighting_bolt_ARRAY['SOURCE'][$tmp_endpoint_serial][$tmp_endpoint_id][] = $FIREHOT_oEndpoint;

                    $this->preload_spoiled_ARRAY[$tmp_endpoint_id] = 1;

                    $this->endpoint_isValid_ARRAY[$tmp_endpoint_serial] = true;

                    if(!isset($this->execute_from_source_authorization)){

                        $this->execute_from_source_authorization = true;

                    }

                    $this->preload_endpoint_validation_fail[$tmp_endpoint_id] = false;

                    $tmp_current_perms = substr(decoct( fileperms($dirPath) ), 2);

                    $this->oElectrum_STATS->add_valid_source_DIR($dirPath, $tmp_endpoint_serial, $tmp_endpoint_id, $tmp_current_perms);


                }else{

                    $this->preload_endpoint_validation_fail[$tmp_endpoint_id] = true;

                    $this->execute_from_source_authorization = false;

                    $this->endpoint_isValid_ARRAY[$tmp_endpoint_serial] = false;

                    $tmp_current_perms = substr(decoct( fileperms($dirPath) ), 2);

                    $err_reason = '';
                    if(!is_dir($dirPath)){

                        $err_reason = 'The source path, ' . $dirPath.', is not recognized by is_dir() as a directory.';

                    }else{

                        if(!is_readable($dirPath)){

                            $err_reason = 'The source path, ' . $dirPath.', (' . $tmp_current_perms.') is not recognized by is_readable() as being a readable endpoint.';

                        }

                    }

                    $this->oElectrum_STATS->add_invalid_source_DIR($dirPath, $tmp_endpoint_serial, $tmp_endpoint_id, $tmp_current_perms, $err_reason);

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('CRNRSTN :: Electrum process experienced SOURCE directory validation error at ' . $tmp_DIR_PATH.'.');

                }

            }else{

                //
                // COMPLETE THE INTEGRATION OF ENDPOINT INTO THIS ELECTRUM
                $FIREHOT_oEndpoint = new crnrstn_lightning_bolt($tmp_endpoint_serial, $this->oCRNRSTN_USR);
                $FIREHOT_oEndpoint->initialize_sourceLOCAL_meta($dirPath);

                $this->oLighting_bolt_ARRAY['SOURCE'][$tmp_endpoint_serial][$tmp_endpoint_id][] = $FIREHOT_oEndpoint;

                $this->preload_spoiled_ARRAY[$tmp_endpoint_id] = 1;

                if(!isset($this->execute_from_source_authorization)){

                    $this->execute_from_source_authorization = true;

                }

                $this->endpoint_isValid_ARRAY[$tmp_endpoint_serial] = true;

                $tmp_current_perms = substr(decoct( fileperms($dirPath) ), 2);

                $this->oElectrum_STATS->add_valid_source_DIR($dirPath, $tmp_endpoint_serial, $tmp_endpoint_id, $tmp_current_perms);

                $this->oCRNRSTN_USR->error_log('This CRNRSTN :: Electrum process has already validated this SOURCE directory (' . $tmp_DIR_PATH.'), and so will accelerate via skipping the preload check.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

            }

        } catch (Exception $e) {

            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function addDestinationLOCAL_WCR($WildCardResource_key){

        try{

            //
            // DIRECTORY
            $this->oCRNRSTN_USR->error_log('CRNRSTN :: Electrum Directory DESTINATION - integrity check beginning.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

            $tmp_DIR_PATH = $this->oCRNRSTN_USR->get_resource('LOCAL_DIR_PATH', $WildCardResource_key);
            $tmp_MKDIR_MODE = $this->oCRNRSTN_USR->get_resource('LOCAL_MKDIR_MODE', $WildCardResource_key);

            $tmp_endpoint_id = md5($tmp_DIR_PATH);
            $tmp_endpoint_serial = $this->oCRNRSTN_USR->generate_new_key(100);

            if($this->ready_for_preload($tmp_endpoint_id) || $this->preload_endpoint_validation_fail[$tmp_endpoint_id]){

                //
                // DESTINATION DIRECTORY
                if($this->validate_DIR_endpoint('DESTINATION', $tmp_DIR_PATH, $tmp_MKDIR_MODE)){

                    //
                    // COMPLETE THE INTEGRATION OF ENDPOINT INTO THIS ELECTRUM
                    $FIREHOT_oEndpoint = new crnrstn_lightning_bolt($tmp_endpoint_serial, $this->oCRNRSTN_USR);

                    $FIREHOT_oEndpoint->initialize_destinationLOCAL_WCR_meta($WildCardResource_key);
                    $this->oLighting_bolt_ARRAY['DESTINATION'][$tmp_endpoint_serial][$tmp_endpoint_id][] = $FIREHOT_oEndpoint;

                    $this->preload_spoiled_ARRAY[$tmp_endpoint_id] = 1;

                    $this->execute_to_destination_authorization = true;

                    $this->endpoint_isValid_ARRAY[$tmp_endpoint_serial] = true;

                    $this->preload_endpoint_validation_fail[$tmp_endpoint_id] = false;

                    $tmp_current_perms = substr(decoct( fileperms($tmp_DIR_PATH) ), 2);

                    $this->oElectrum_STATS->add_valid_destination_DIR($tmp_DIR_PATH, $tmp_endpoint_serial, $tmp_endpoint_id, $tmp_current_perms, $tmp_MKDIR_MODE);

                }else{

                    $this->preload_endpoint_validation_fail[$tmp_endpoint_id] = true;

                    $this->endpoint_isValid_ARRAY[$tmp_endpoint_serial] = false;

                    if(!isset($this->execute_to_destination_authorization)){

                        $this->execute_to_destination_authorization = false;

                    }

                    $tmp_current_perms = substr(decoct( fileperms($tmp_DIR_PATH) ), 2);

                    $err_reason = '';
                    if(!is_dir($tmp_DIR_PATH)){

                        $err_reason = 'The path, ' . $tmp_DIR_PATH.', is not recognized by is_dir() as a directory.';

                    }else{

                        if(!is_writable($tmp_DIR_PATH)){

                            $err_reason = 'The path, ' . $tmp_DIR_PATH.', (' . $tmp_current_perms.') is not recognized by is_writable() as being a writable endpoint.';

                        }

                    }

                    $this->oElectrum_STATS->add_invalid_destination_DIR($tmp_DIR_PATH, $tmp_endpoint_serial, $tmp_endpoint_id, $tmp_current_perms, $tmp_MKDIR_MODE, $err_reason);

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    if(is_dir($tmp_DIR_PATH)){

                        throw new Exception('The CRNRSTN :: Electrum process is unable to access (or chmod to ' . $tmp_MKDIR_MODE.') the destination directory path ("' . $tmp_DIR_PATH.'" in ' . $tmp_current_perms.' mode) for writing which is preventing successful validation and preload of this endpoint.');

                    }else{

                        throw new Exception('The CRNRSTN :: Electrum process is unable to access the destination directory path (' . $tmp_DIR_PATH.') for writing which is preventing successful validation and preload of this endpoint.');

                    }

                }

            }else{

                //
                // COMPLETE THE INTEGRATION OF ENDPOINT INTO THIS ELECTRUM
                $FIREHOT_oEndpoint = new crnrstn_lightning_bolt($tmp_endpoint_serial, $this->oCRNRSTN_USR);

                $FIREHOT_oEndpoint->initialize_destinationLOCAL_WCR_meta($WildCardResource_key);
                $this->oLighting_bolt_ARRAY['DESTINATION'][$tmp_endpoint_serial][$tmp_endpoint_id][] = $FIREHOT_oEndpoint;

                $this->preload_spoiled_ARRAY[$tmp_endpoint_id] = 1;

                $this->execute_to_destination_authorization = true;

                $this->endpoint_isValid_ARRAY[$tmp_endpoint_serial] = true;

                $tmp_current_perms = substr(decoct( fileperms($tmp_DIR_PATH) ), 2);

                $this->oElectrum_STATS->add_valid_destination_DIR($tmp_DIR_PATH, $tmp_endpoint_serial, $tmp_endpoint_id, $tmp_current_perms, $tmp_MKDIR_MODE);

                $this->oCRNRSTN_USR->error_log('This CRNRSTN :: Electrum process has already validated this DESTINATION directory (' . $tmp_DIR_PATH . '), and so will accelerate via skipping the preload check.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

            }

        } catch (Exception $e) {

            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function addFlattenedDestinationLOCAL_WCR($WildCardResource_key){

        try{

            //
            // DIRECTORY
            $this->oCRNRSTN_USR->error_log('CRNRSTN :: Electrum [ALL FLATTENED] Directory DESTINATION - integrity check beginning.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

            $tmp_DIR_PATH = $this->oCRNRSTN_USR->get_resource('LOCAL_DIR_PATH', $WildCardResource_key);
            $tmp_MKDIR_MODE = $this->oCRNRSTN_USR->get_resource('LOCAL_MKDIR_MODE', $WildCardResource_key);

            $tmp_endpoint_id = md5($tmp_DIR_PATH);
            $tmp_endpoint_serial = $this->oCRNRSTN_USR->generate_new_key(100);

            if($this->ready_for_preload($tmp_endpoint_id) || $this->preload_endpoint_validation_fail[$tmp_endpoint_id]){

                //
                // DESTINATION DIRECTORY
                if($this->validate_DIR_endpoint('DESTINATION', $tmp_DIR_PATH, $tmp_MKDIR_MODE)){

                    //
                    // COMPLETE THE INTEGRATION OF ENDPOINT INTO THIS ELECTRUM
                    $FIREHOT_oEndpoint = new crnrstn_lightning_bolt($tmp_endpoint_serial, $this->oCRNRSTN_USR);

                    $FIREHOT_oEndpoint->initialize_flattenedDestinationLOCAL_WCR_meta($WildCardResource_key);
                    $this->oLighting_bolt_ARRAY['DESTINATION'][$tmp_endpoint_serial][$tmp_endpoint_id][] = $FIREHOT_oEndpoint;

                    $this->preload_spoiled_ARRAY[$tmp_endpoint_id] = 1;

                    $this->execute_to_destination_authorization = true;

                    $this->endpoint_isValid_ARRAY[$tmp_endpoint_serial] = true;

                    $this->preload_endpoint_validation_fail[$tmp_endpoint_id] = false;

                    $tmp_current_perms = substr(decoct( fileperms($tmp_DIR_PATH) ), 2);

                    $this->oElectrum_STATS->add_valid_destination_DIR($tmp_DIR_PATH, $tmp_endpoint_serial, $tmp_endpoint_id, $tmp_current_perms, $tmp_MKDIR_MODE, true);

                }else{

                    $this->preload_endpoint_validation_fail[$tmp_endpoint_id] = true;

                    $this->endpoint_isValid_ARRAY[$tmp_endpoint_serial] = false;

                    if(!isset($this->execute_to_destination_authorization)){

                        $this->execute_to_destination_authorization = false;

                    }

                    $tmp_current_perms = substr(decoct( fileperms($tmp_DIR_PATH) ), 2);

                    $err_reason = '';
                    if(!is_dir($tmp_DIR_PATH)){

                        $err_reason = 'The path, ' . $tmp_DIR_PATH . ', is not recognized by is_dir() as a directory.';

                    }else{

                        if(!is_writable($tmp_DIR_PATH)){

                            $err_reason = 'The path, ' . $tmp_DIR_PATH . ', (' . $tmp_current_perms . ') is not recognized by is_writable() as being a writable endpoint.';

                        }

                    }

                    $this->oElectrum_STATS->add_invalid_destination_DIR($tmp_DIR_PATH, $tmp_endpoint_serial, $tmp_endpoint_id, $tmp_current_perms, $tmp_MKDIR_MODE, $err_reason);

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    if(is_dir($tmp_DIR_PATH)){

                        throw new Exception('The CRNRSTN :: Electrum process is unable to access (or chmod to ' . $tmp_MKDIR_MODE . ') the destination directory path ("' . $tmp_DIR_PATH . '" in ' . $tmp_current_perms . ' mode) for writing which is preventing successful validation and preload of this endpoint.');

                    }else{

                        throw new Exception('The CRNRSTN :: Electrum process is unable to access the destination directory path (' . $tmp_DIR_PATH . ') for writing which is preventing successful validation and preload of this endpoint.');

                    }

                }

            }else{

                //
                // COMPLETE THE INTEGRATION OF ENDPOINT INTO THIS ELECTRUM
                $FIREHOT_oEndpoint = new crnrstn_lightning_bolt($tmp_endpoint_serial, $this->oCRNRSTN_USR);

                $FIREHOT_oEndpoint->initialize_flattenedDestinationLOCAL_WCR_meta($WildCardResource_key);
                $this->oLighting_bolt_ARRAY['DESTINATION'][$tmp_endpoint_serial][$tmp_endpoint_id][] = $FIREHOT_oEndpoint;

                $this->preload_spoiled_ARRAY[$tmp_endpoint_id] = 1;

                $this->execute_to_destination_authorization = true;

                $this->endpoint_isValid_ARRAY[$tmp_endpoint_serial] = true;

                $tmp_current_perms = substr(decoct( fileperms($tmp_DIR_PATH) ), 2);

                $this->oElectrum_STATS->add_valid_destination_DIR($tmp_DIR_PATH, $tmp_endpoint_serial, $tmp_endpoint_id, $tmp_current_perms, $tmp_MKDIR_MODE, true);

                $this->oCRNRSTN_USR->error_log('This CRNRSTN :: Electrum process has already validated this DESTINATION directory (' . $tmp_DIR_PATH . '), and so will accelerate via skipping the preload check.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

            }

        } catch (Exception $e) {

            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function addSourceLOCAL_WCR($WildCardResource_key){

        try{

            //
            // DIRECTORY
            $this->oCRNRSTN_USR->error_log('CRNRSTN :: Electrum Directory SOURCE - integrity check beginning.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

            $tmp_MKDIR_MODE = NULL;
            $tmp_DIR_PATH = $this->oCRNRSTN_USR->get_resource('LOCAL_DIR_PATH', $WildCardResource_key);

            $tmp_endpoint_id = md5($tmp_DIR_PATH);
            $tmp_endpoint_serial = $this->oCRNRSTN_USR->generate_new_key(100);

            if($this->ready_for_preload($tmp_endpoint_id) || $this->preload_endpoint_validation_fail[$tmp_endpoint_id]){

                if($this->validate_DIR_endpoint('SOURCE', $tmp_DIR_PATH)){

                    //
                    // COMPLETE THE INTEGRATION OF ENDPOINT INTO THIS ELECTRUM
                    $FIREHOT_oEndpoint = new crnrstn_lightning_bolt($tmp_endpoint_serial, $this->oCRNRSTN_USR);

                    $FIREHOT_oEndpoint->initialize_source_LOCAL_WCR_meta($WildCardResource_key);
                    $this->oLighting_bolt_ARRAY['SOURCE'][$tmp_endpoint_serial][$tmp_endpoint_id][] = $FIREHOT_oEndpoint;

                    $this->preload_spoiled_ARRAY[$tmp_endpoint_id] = 1;

                    if(!isset($this->execute_from_source_authorization)){

                        $this->execute_from_source_authorization = true;

                    }

                    $this->endpoint_isValid_ARRAY[$tmp_endpoint_serial] = true;

                    $this->preload_endpoint_validation_fail[$tmp_endpoint_id] = false;

                    $tmp_current_perms = substr(decoct( fileperms($tmp_DIR_PATH) ), 2);

                    $this->oElectrum_STATS->add_valid_source_DIR($tmp_DIR_PATH, $tmp_endpoint_serial, $tmp_endpoint_id, $tmp_current_perms);

                }else{

                    $this->preload_endpoint_validation_fail[$tmp_endpoint_id] = true;

                    $this->execute_from_source_authorization = false;

                    $this->endpoint_isValid_ARRAY[$tmp_endpoint_serial] = false;

                    $tmp_current_perms = substr(decoct( fileperms($tmp_DIR_PATH) ), 2);

                    $err_reason = '';
                    if(!is_dir($tmp_DIR_PATH)){

                        $err_reason = 'The path, ' . $tmp_DIR_PATH . ', is not recognized by is_dir() as a directory.';

                    }else{

                        if(!is_readable($tmp_DIR_PATH)){

                            $err_reason = 'The path, ' . $tmp_DIR_PATH . ', (' . $tmp_current_perms . ') is not recognized by is_readable() as being a readable endpoint.';

                        }

                    }

                    $this->oElectrum_STATS->add_invalid_source_DIR($tmp_DIR_PATH, $tmp_endpoint_serial, $tmp_endpoint_id, $tmp_current_perms, $err_reason);

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('CRNRSTN :: Electrum process experienced a source directory validation error at ' . $tmp_DIR_PATH . '.');

                }

            }else{

                //
                // COMPLETE THE INTEGRATION OF ENDPOINT INTO THIS ELECTRUM
                $FIREHOT_oEndpoint = new crnrstn_lightning_bolt($tmp_endpoint_serial, $this->oCRNRSTN_USR);

                $FIREHOT_oEndpoint->initialize_source_LOCAL_WCR_meta($WildCardResource_key);
                $this->oLighting_bolt_ARRAY['SOURCE'][$tmp_endpoint_serial][$tmp_endpoint_id][] = $FIREHOT_oEndpoint;

                $this->preload_spoiled_ARRAY[$tmp_endpoint_id] = 1;

                if(!isset($this->execute_from_source_authorization)){

                    $this->execute_from_source_authorization = true;

                }

                $this->endpoint_isValid_ARRAY[$tmp_endpoint_serial] = true;

                $tmp_current_perms = substr(decoct( fileperms($tmp_DIR_PATH) ), 2);

                $this->oElectrum_STATS->add_valid_source_DIR($tmp_DIR_PATH, $tmp_endpoint_serial, $tmp_endpoint_id, $tmp_current_perms);

                $this->oCRNRSTN_USR->error_log('This CRNRSTN :: Electrum process has already validated this SOURCE directory (' . $tmp_DIR_PATH . '), and so will accelerate via skipping the preload check.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

            }

        } catch (Exception $e) {

            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function addDestination_FTP_WCR($WildCardResource_key){

        try{

            $this->oCRNRSTN_USR->error_log('CRNRSTN :: Electrum FTP DESTINATION - integrity check beginning.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

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

            $tmp_FTP_SERVER = $this->oCRNRSTN_USR->get_resource('FTP_SERVER', $WildCardResource_key);
            $tmp_FTP_USERNAME = $this->oCRNRSTN_USR->get_resource('FTP_USERNAME', $WildCardResource_key);
            $tmp_FTP_PASSWORD = $this->oCRNRSTN_USR->get_resource('FTP_PASSWORD', $WildCardResource_key);
            $tmp_FTP_PORT = $this->oCRNRSTN_USR->get_resource('FTP_PORT', $WildCardResource_key);
            $tmp_FTP_DIR_PATH = $this->oCRNRSTN_USR->get_resource('FTP_DIR_PATH', $WildCardResource_key);

            $tmp_endpoint_id = md5($tmp_FTP_SERVER.$tmp_FTP_USERNAME.$tmp_FTP_PASSWORD.$tmp_FTP_PORT);
            $tmp_endpoint_serial = $this->oCRNRSTN_USR->generate_new_key(100);

            $this->oCRNRSTN_USR->error_log('CRNRSTN :: Electrum process checking FTP [' . $tmp_FTP_SERVER . '][' . $tmp_FTP_USERNAME . '][' . $tmp_FTP_PORT . ']', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

            if($this->ready_for_preload($tmp_endpoint_id) || $this->preload_endpoint_validation_fail[$tmp_endpoint_id]){

                $this->validate_FTP_Endpoint('DESTINATION', $WildCardResource_key, $tmp_endpoint_id);
                $oLightning_ftp_conn = self::$oFourLivingCreatures_FTP->return_lightningFTPConn($tmp_endpoint_id);
                if($oLightning_ftp_conn->isValid){

                    //
                    // COMPLETE THE INTEGRATION OF ENDPOINT INTO THIS ELECTRUM
                    $FIREHOT_oEndpoint = new crnrstn_lightning_bolt($tmp_endpoint_serial, $this->oCRNRSTN_USR);
                    $FIREHOT_oEndpoint->initialize_destination_FTP_WCR_meta($WildCardResource_key);

                    $this->oLighting_bolt_ARRAY['DESTINATION'][$tmp_endpoint_serial][$tmp_endpoint_id][] = $FIREHOT_oEndpoint;

                    $this->preload_spoiled_ARRAY[$tmp_endpoint_id] = 1;

                    $this->execute_to_destination_authorization = true;

                    $this->endpoint_isValid_ARRAY[$tmp_endpoint_serial] = true;

                    $this->preload_endpoint_validation_fail[$tmp_endpoint_id] = false;

                    $this->oElectrum_STATS->add_valid_destination_FTP($tmp_FTP_DIR_PATH, $tmp_FTP_SERVER, $tmp_FTP_PORT, $tmp_endpoint_serial, $tmp_endpoint_id);

                }else{

                    $this->preload_endpoint_validation_fail[$tmp_endpoint_id] = true;

                    $this->endpoint_isValid_ARRAY[$tmp_endpoint_serial] = false;

                    if(!isset($this->execute_to_destination_authorization)) {

                        $this->execute_to_destination_authorization = false;
                    }

                    $this->oElectrum_STATS->add_invalid_destination_FTP($tmp_FTP_DIR_PATH, $tmp_FTP_SERVER, $tmp_FTP_PORT, $tmp_endpoint_serial, $tmp_endpoint_id);

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('This CRNRSTN :: Electrum process experienced error checking this FTP [' . $tmp_FTP_SERVER . '::' . $tmp_FTP_PORT . '] endpoint.');

                }

            }else{

                //
                // COMPLETE THE INTEGRATION OF ENDPOINT INTO THIS ELECTRUM
                $FIREHOT_oEndpoint = new crnrstn_lightning_bolt($tmp_endpoint_serial, $this->oCRNRSTN_USR);
                $FIREHOT_oEndpoint->initialize_destination_FTP_WCR_meta($WildCardResource_key);

                $this->oLighting_bolt_ARRAY['DESTINATION'][$tmp_endpoint_serial][$tmp_endpoint_id][] = $FIREHOT_oEndpoint;

                $this->preload_spoiled_ARRAY[$tmp_endpoint_id] = 1;

                $this->execute_to_destination_authorization = true;

                $this->endpoint_isValid_ARRAY[$tmp_endpoint_serial] = true;

                $this->oElectrum_STATS->add_valid_destination_FTP($tmp_FTP_DIR_PATH, $tmp_FTP_SERVER, $tmp_FTP_PORT, $tmp_endpoint_serial, $tmp_endpoint_id);

                $this->oCRNRSTN_USR->error_log('This CRNRSTN :: Electrum process has already validated this DESTINATION FTP endpoint at (' . $tmp_FTP_SERVER . '::' . $tmp_FTP_PORT . '), and so will accelerate via skipping the preload check.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

            }

        } catch (Exception $e) {

            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function addFlattenedDestinationFTP_WCR($WildCardResource_key){

        try{

            $this->oCRNRSTN_USR->error_log('CRNRSTN :: Electrum FTP DESTINATION - integrity check beginning.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

            $tmp_FTP_SERVER = $this->oCRNRSTN_USR->get_resource('FTP_SERVER', $WildCardResource_key);
            $tmp_FTP_USERNAME = $this->oCRNRSTN_USR->get_resource('FTP_USERNAME', $WildCardResource_key);
            $tmp_FTP_PASSWORD = $this->oCRNRSTN_USR->get_resource('FTP_PASSWORD', $WildCardResource_key);
            $tmp_FTP_PORT = $this->oCRNRSTN_USR->get_resource('FTP_PORT', $WildCardResource_key);
            $tmp_FTP_DIR_PATH = $this->oCRNRSTN_USR->get_resource('FTP_DIR_PATH', $WildCardResource_key);

            $tmp_endpoint_id = md5($tmp_FTP_SERVER.$tmp_FTP_USERNAME.$tmp_FTP_PASSWORD.$tmp_FTP_PORT);
            $tmp_endpoint_serial = $this->oCRNRSTN_USR->generate_new_key(100);

            $this->oCRNRSTN_USR->error_log('CRNRSTN :: Electrum process checking FTP [' . $tmp_FTP_SERVER . '][' . $tmp_FTP_USERNAME . '][' . $tmp_FTP_PORT . ']', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

            if($this->ready_for_preload($tmp_endpoint_id) || $this->preload_endpoint_validation_fail[$tmp_endpoint_id]){

                $this->validate_FTP_Endpoint('DESTINATION', $WildCardResource_key, $tmp_endpoint_id);
                $oLightning_ftp_conn = self::$oFourLivingCreatures_FTP->return_lightningFTPConn($tmp_endpoint_id);
                if($oLightning_ftp_conn->isValid){

                    //
                    // COMPLETE THE INTEGRATION OF ENDPOINT INTO THIS ELECTRUM
                    $FIREHOT_oEndpoint = new crnrstn_lightning_bolt($tmp_endpoint_serial, $this->oCRNRSTN_USR);
                    $FIREHOT_oEndpoint->initialize_flattenedDestinationFTP_WCR_meta($WildCardResource_key);

                    $this->oLighting_bolt_ARRAY['DESTINATION'][$tmp_endpoint_serial][$tmp_endpoint_id][] = $FIREHOT_oEndpoint;

                    $this->preload_spoiled_ARRAY[$tmp_endpoint_id] = 1;

                    $this->execute_to_destination_authorization = true;

                    $this->endpoint_isValid_ARRAY[$tmp_endpoint_serial] = true;

                    $this->preload_endpoint_validation_fail[$tmp_endpoint_id] = false;

                    $this->oElectrum_STATS->add_valid_destination_FTP($tmp_FTP_DIR_PATH, $tmp_FTP_SERVER, $tmp_FTP_PORT, $tmp_endpoint_serial, $tmp_endpoint_id, true);

                }else{

                    $this->preload_endpoint_validation_fail[$tmp_endpoint_id] = true;

                    $this->endpoint_isValid_ARRAY[$tmp_endpoint_serial] = false;

                    if(!isset($this->execute_to_destination_authorization)) {

                        $this->execute_to_destination_authorization = false;
                    }

                    $this->oElectrum_STATS->add_invalid_destination_FTP($tmp_FTP_DIR_PATH, $tmp_FTP_SERVER, $tmp_FTP_PORT, $tmp_endpoint_serial, $tmp_endpoint_id);

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('This CRNRSTN :: Electrum process experienced error checking this FTP [' . $tmp_FTP_SERVER . '::' . $tmp_FTP_PORT . '] endpoint.');

                }

            }else{

                //
                // COMPLETE THE INTEGRATION OF ENDPOINT INTO THIS ELECTRUM
                $FIREHOT_oEndpoint = new crnrstn_lightning_bolt($tmp_endpoint_serial, $this->oCRNRSTN_USR);
                $FIREHOT_oEndpoint->initialize_flattenedDestinationFTP_WCR_meta($WildCardResource_key);

                $this->oLighting_bolt_ARRAY['DESTINATION'][$tmp_endpoint_serial][$tmp_endpoint_id][] = $FIREHOT_oEndpoint;

                $this->preload_spoiled_ARRAY[$tmp_endpoint_id] = 1;

                $this->execute_to_destination_authorization = true;

                $this->endpoint_isValid_ARRAY[$tmp_endpoint_serial] = true;

                $this->oElectrum_STATS->add_valid_destination_FTP($tmp_FTP_DIR_PATH, $tmp_FTP_SERVER, $tmp_FTP_PORT, $tmp_endpoint_serial, $tmp_endpoint_id, true);

                $this->oCRNRSTN_USR->error_log('This CRNRSTN :: Electrum process has already validated this DESTINATION FTP endpoint at (' . $tmp_FTP_SERVER . '::' . $tmp_FTP_PORT . '), and so will accelerate via skipping the preload check.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

            }

        } catch (Exception $e) {

            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function addSource_FTP_WCR($WildCardResource_key){

        try{

            $this->oCRNRSTN_USR->error_log('CRNRSTN :: Electrum FTP SOURCE - integrity check beginning.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

            $tmp_FTP_SERVER = $this->oCRNRSTN_USR->get_resource('FTP_SERVER', $WildCardResource_key);
            $tmp_FTP_USERNAME = $this->oCRNRSTN_USR->get_resource('FTP_USERNAME', $WildCardResource_key);
            $tmp_FTP_PASSWORD = $this->oCRNRSTN_USR->get_resource('FTP_PASSWORD', $WildCardResource_key);
            $tmp_FTP_PORT = $this->oCRNRSTN_USR->get_resource('FTP_PORT', $WildCardResource_key);
            $tmp_FTP_DIR_PATH = $this->oCRNRSTN_USR->get_resource('FTP_DIR_PATH', $WildCardResource_key);

            $tmp_endpoint_id = md5($tmp_FTP_SERVER . $tmp_FTP_USERNAME . $tmp_FTP_PASSWORD . $tmp_FTP_PORT);
            $tmp_endpoint_serial = $this->oCRNRSTN_USR->generate_new_key(100);

            $this->oCRNRSTN_USR->error_log('CRNRSTN :: Electrum process checking FTP [' . $tmp_FTP_SERVER . '][' . $tmp_FTP_USERNAME . '][' . $tmp_FTP_PORT . ']', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

            if($this->ready_for_preload($tmp_endpoint_id) || $this->preload_endpoint_validation_fail[$tmp_endpoint_id]){

                $this->validate_FTP_Endpoint('SOURCE', $WildCardResource_key, $tmp_endpoint_id);
                $oLightning_ftp_conn = self::$oFourLivingCreatures_FTP->return_lightningFTPConn($tmp_endpoint_id);
                if($oLightning_ftp_conn->isValid){

                    //
                    // COMPLETE THE INTEGRATION OF ENDPOINT INTO THIS ELECTRUM
                    $FIREHOT_oEndpoint = new crnrstn_lightning_bolt($tmp_endpoint_serial, $this->oCRNRSTN_USR);
                    $FIREHOT_oEndpoint->initialize_source_FTP_WCR_meta($WildCardResource_key);

                    $this->oLighting_bolt_ARRAY['SOURCE'][$tmp_endpoint_serial][$tmp_endpoint_id][] = $FIREHOT_oEndpoint;

                    $this->preload_spoiled_ARRAY[$tmp_endpoint_id] = 1;

                    if(!isset($this->execute_from_source_authorization)){

                        $this->execute_from_source_authorization = true;

                    }

                    $this->endpoint_isValid_ARRAY[$tmp_endpoint_serial] = true;

                    $this->preload_endpoint_validation_fail[$tmp_endpoint_id] = false;

                    $this->oElectrum_STATS->add_valid_source_FTP($tmp_FTP_DIR_PATH, $tmp_FTP_SERVER, $tmp_FTP_PORT, $tmp_endpoint_serial, $tmp_endpoint_id);

                }else{

                    $this->preload_endpoint_validation_fail[$tmp_endpoint_id] = true;
                    $this->execute_from_source_authorization = false;
                    $this->endpoint_isValid_ARRAY[$tmp_endpoint_serial] = false;

                    $this->oElectrum_STATS->add_invalid_source_FTP($tmp_FTP_DIR_PATH, $tmp_FTP_SERVER, $tmp_FTP_PORT, $tmp_endpoint_serial, $tmp_endpoint_id);


                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('This CRNRSTN :: Electrum process experienced error checking this FTP SOURCE [' . $tmp_FTP_SERVER . '::' . $tmp_FTP_PORT . '] endpoint.');

                }

            }else{

                //
                // COMPLETE THE INTEGRATION OF ENDPOINT INTO THIS ELECTRUM
                $FIREHOT_oEndpoint = new crnrstn_lightning_bolt($tmp_endpoint_serial, $this->oCRNRSTN_USR);
                $FIREHOT_oEndpoint->initialize_source_FTP_WCR_meta($WildCardResource_key);

                $this->oLighting_bolt_ARRAY['SOURCE'][$tmp_endpoint_serial][$tmp_endpoint_id][] = $FIREHOT_oEndpoint;

                $this->preload_spoiled_ARRAY[$tmp_endpoint_id] = 1;

                if(!isset($this->execute_from_source_authorization)){

                    $this->execute_from_source_authorization = true;

                }

                $this->endpoint_isValid_ARRAY[$tmp_endpoint_serial] = true;

                $this->oElectrum_STATS->add_valid_source_FTP($tmp_FTP_DIR_PATH, $tmp_FTP_SERVER, $tmp_FTP_PORT, $tmp_endpoint_serial, $tmp_endpoint_id);

                $this->oCRNRSTN_USR->error_log('This CRNRSTN :: Electrum process has already validated this FTP SOURCE at (' . $tmp_FTP_SERVER . '::' . $tmp_FTP_PORT . '), and so will accelerate via skipping the preload check.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

            }

        } catch (Exception $e) {

            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function ready_for_preload($endpoint_id){

        if(isset($this->preload_spoiled_ARRAY[$endpoint_id])){

            return false;

        }else{

            return true;

        }

    }

    public function exclude_DIR($nomination_pattern, $WCRkey_or_DIRPATH){

        $this->oCRNRSTN_USR->error_log('CRNRSTN :: Electrum suppression includes [' . $this->oCRNRSTN_USR->crcINT($this->electrum_process_id) . '][' . $this->oCRNRSTN_USR->crcINT($this->execution_batch_serial) .'] DIRECTORY with pattern of (or to which is an exact match of) "' . $nomination_pattern . '".', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $tmp_array = array();
        $tmp_array['exclusion_serial'] = $this->oCRNRSTN_USR->generate_new_key(50);
        $tmp_array['exclusion_type'] = 'DIRECTORY';
        $tmp_array['WCR_or_path'] = $WCRkey_or_DIRPATH;
        $tmp_array['pattern'] = $nomination_pattern;

        $this->asset_transfer_suppression_ARRAY[$this->electrum_process_id][$this->execution_batch_serial][] = $tmp_array;

    }

    public function exclude_FILE($nomination_pattern, $WCRkey_or_DIRPATH){

        $this->oCRNRSTN_USR->error_log('CRNRSTN :: Electrum suppression includes [' . $this->oCRNRSTN_USR->crcINT($this->electrum_process_id) . '][' . $this->oCRNRSTN_USR->crcINT($this->execution_batch_serial) . '] FILE with pattern of (or to which is an exact match of) "' . $nomination_pattern . '".', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $tmp_array = array();
        $tmp_array['exclusion_serial'] = $this->oCRNRSTN_USR->generate_new_key(50);
        $tmp_array['exclusion_type'] = 'FILE';
        $tmp_array['WCR_or_path'] = $WCRkey_or_DIRPATH;
        $tmp_array['pattern'] = $nomination_pattern;

        $this->asset_transfer_suppression_ARRAY[$this->electrum_process_id][$this->execution_batch_serial][] = $tmp_array;

    }

    public function exclude_assetGroupID($pattern, $WCRkey_or_DIRPATH){

        $this->oCRNRSTN_USR->error_log('CRNRSTN :: Electrum suppression includes OWNER GROUP ID with pattern of (or to which is an exact match of) "' . $pattern . '".', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $tmp_array = array();
        $tmp_array['exclusion_serial'] = $this->oCRNRSTN_USR->generate_new_key(50);
        $tmp_array['exclusion_type'] = 'OWNER_GROUP';
        $tmp_array['WCR_or_path'] = $WCRkey_or_DIRPATH;
        $tmp_array['pattern'] = $pattern;

        $this->asset_transfer_suppression_ARRAY[$this->electrum_process_id][$this->execution_batch_serial][] = $tmp_array;

    }

    public function exclude_assetUserID($pattern, $WCRkey_or_DIRPATH){

        $this->oCRNRSTN_USR->error_log('CRNRSTN :: Electrum suppression includes OWNER USER ID with pattern of (or to which is an exact match of) "'.$pattern.'".', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $tmp_array = array();
        $tmp_array['exclusion_serial'] = $this->oCRNRSTN_USR->generate_new_key(50);
        $tmp_array['exclusion_type'] = 'OWNER_USER';
        $tmp_array['WCR_or_path'] = $WCRkey_or_DIRPATH;
        $tmp_array['pattern'] = $pattern;

        $this->asset_transfer_suppression_ARRAY[$this->electrum_process_id][$this->execution_batch_serial][] = $tmp_array;

    }

    public function exclude_modifiedNewerThan($pattern, $WCRkey_or_DIRPATH){

        $this->oCRNRSTN_USR->error_log('CRNRSTN :: Electrum suppression includes MODIFIED NEWER THAN "'.$pattern.'".', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $tmp_array = array();
        $tmp_array['exclusion_serial'] = $this->oCRNRSTN_USR->generate_new_key(50);
        $tmp_array['exclusion_type'] = 'MODIFIED_NT';
        $tmp_array['WCR_or_path'] = $WCRkey_or_DIRPATH;
        $tmp_array['pattern'] = $pattern;

        $this->asset_transfer_suppression_ARRAY[$this->electrum_process_id][$this->execution_batch_serial][] = $tmp_array;

    }

    public function exclude_modifiedOlderThan($pattern, $WCRkey_or_DIRPATH){

        $this->oCRNRSTN_USR->error_log('CRNRSTN :: Electrum suppression includes MODIFIED OLDER THAN "'.$pattern.'".', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $tmp_array = array();
        $tmp_array['exclusion_serial'] = $this->oCRNRSTN_USR->generate_new_key(50);
        $tmp_array['exclusion_type'] = 'MODIFIED_OT';
        $tmp_array['WCR_or_path'] = $WCRkey_or_DIRPATH;
        $tmp_array['pattern'] = $pattern;

        $this->asset_transfer_suppression_ARRAY[$this->electrum_process_id][$this->execution_batch_serial][] = $tmp_array;

    }

    public function exclude_accessedNewerThan($pattern, $WCRkey_or_DIRPATH){

        $this->oCRNRSTN_USR->error_log('CRNRSTN :: Electrum suppression includes ACCESSED NEWER THAN "'.$pattern.'".', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $tmp_array = array();
        $tmp_array['exclusion_serial'] = $this->oCRNRSTN_USR->generate_new_key(50);
        $tmp_array['exclusion_type'] = 'ACCESSED_NT';
        $tmp_array['WCR_or_path'] = $WCRkey_or_DIRPATH;
        $tmp_array['pattern'] = $pattern;

        $this->asset_transfer_suppression_ARRAY[$this->electrum_process_id][$this->execution_batch_serial][] = $tmp_array;

    }

    public function exclude_accessedOlderThan($pattern, $WCRkey_or_DIRPATH){

        $this->oCRNRSTN_USR->error_log('CRNRSTN :: Electrum suppression includes ACCESSED OLDER THAN "'.$pattern.'".', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $tmp_array = array();
        $tmp_array['exclusion_serial'] = $this->oCRNRSTN_USR->generate_new_key(50);
        $tmp_array['exclusion_type'] = 'ACCESSED_OT';
        $tmp_array['WCR_or_path'] = $WCRkey_or_DIRPATH;
        $tmp_array['pattern'] = $pattern;

        $this->asset_transfer_suppression_ARRAY[$this->electrum_process_id][$this->execution_batch_serial][] = $tmp_array;

    }

    public function exclude_fileSizeGreaterThan($bytes, $WCRkey_or_DIRPATH){

        $this->oCRNRSTN_USR->error_log('CRNRSTN :: Electrum suppression includes FILESIZE LESS THAN "'.$bytes.'" bytes.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $tmp_array = array();
        $tmp_array['exclusion_serial'] = $this->oCRNRSTN_USR->generate_new_key(50);
        $tmp_array['exclusion_type'] = 'FILE_SIZE_GT';
        $tmp_array['WCR_or_path'] = $WCRkey_or_DIRPATH;
        $tmp_array['pattern'] = $bytes;

        $this->asset_transfer_suppression_ARRAY[$this->electrum_process_id][$this->execution_batch_serial][] = $tmp_array;

    }

    public function exclude_fileSizeLessThan($bytes, $WCRkey_or_DIRPATH){

        $this->oCRNRSTN_USR->error_log('CRNRSTN :: Electrum suppression includes FILESIZE LESS THAN "'.$bytes.'" bytes.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $tmp_array = array();
        $tmp_array['exclusion_serial'] = $this->oCRNRSTN_USR->generate_new_key(50);
        $tmp_array['exclusion_type'] = 'FILE_SIZE_LT';
        $tmp_array['WCR_or_path'] = $WCRkey_or_DIRPATH;
        $tmp_array['pattern'] = $bytes;

        $this->asset_transfer_suppression_ARRAY[$this->electrum_process_id][$this->execution_batch_serial][] = $tmp_array;

    }

    private function validate_FTP_Endpoint($flow_type, $endpoint_data, $endpoint_id){
        /*
         - n+1 DATA SOURCE VALIDATION
        * CAN I READ FROM SPECIFIED SOURCE?
        * IF THIS IS FTP ::
        HOW MANY ACTIVE PROCESSES ARE HITTING THIS SERVER? SCAN automation_runtime_config.FTP_SERVER_IP_SOURCE WHERE ISACTIVE=1
        NEED TO ALSO COMPARE FTP_SERVER_IP_DESTINATION AND FTP_SERVER_IP_SOURCE FOR FTP TO FTP ELECTRUM
        IF UNDER SPECIFIED LIMIT,
        1 - INSERT INTO automation_runtime_config WITH AUTOMATION_STATE=ELECTRUM IS INITIALIZING FTP SOURCE 123.123.122.123
        2 - INSERT INTO log_runtime_config AUTOMATION_STATE=ELECTRUM IS INITIALIZING FTP 123.123.122.123

        IF OVER SPECIFIED LIMIT,
        1 - INSERT INTO log_runtime_config AUTOMATION_STATE=FTP SOURCE CONNECTION SUPPRESSED :: 123.123.122.123
        2 - DIE()

            - n+1 DATA DESTINATION VALIDATION
        * CAN I WRITE TO LOCAL DIR PATH is_writable()
        * IF THIS IS FTP ::
        HOW MANY ACTIVE PROCESSES ARE HITTING THIS SERVER? SCAN automation_runtime_config.FTP_SERVER_IP_DESTINATION WHERE ISACTIVE=1
        IF UNDER SPECIFIED LIMIT,
        1 - UPDATE automation_runtime_config WITH AUTOMATION_STATE=ELECTRUM IS INITIALIZING FTP 123.123.122.123
        2 - INSERT INTO log_runtime_config AUTOMATION_STATE=ELECTRUM IS INITIALIZING FTP DESTINATION 123.123.122.123

        IF OVER SPECIFIED LIMIT,
        1 - INSERT INTO log_runtime_config AUTOMATION_STATE=FTP DESTINATION CONNECTION SUPPRESSED :: 123.123.122.123
        2 - DIE()

         * */

        if(!isset(self::$oFourLivingCreatures_FTP)){

            self::$oFourLivingCreatures_FTP = new crnrstn_fire_ftp_manager($this->oCRNRSTN_USR);

        }

        return self::$oFourLivingCreatures_FTP->initialize_ftp_endpoint($flow_type, $endpoint_data, $endpoint_id);

    }

    private function validate_DIR_endpoint($flow_type, $dirPath, $mkdir_mode=777){

        try{

            switch($flow_type) {
                case 'SOURCE':

                    if(is_dir($dirPath)){

                        //
                        // SOURCE - LOCAL_DIR
                        if(is_readable($dirPath)){

                            return true;

                        }else{

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('The CRNRSTN :: Electrum process has experienced permissions related errors attempting to read from the source directory, '.$dirPath.'.');

                        }

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('The CRNRSTN :: Electrum process has experienced errors attempting to find the source directory, '.$dirPath.', within the local file system.');

                    }

                break;
                default:

                    //
                    // DESTINATION - LOCAL_DIR
                    if(is_dir($dirPath)){

                        if(is_writable($dirPath)){

                            return true;

                        }else{

                            //
                            // ATTEMPT TO CHANGE PERMISSIONS AND CHECK AGAIN
                            // BEFORE COMPLETELY GIVING UP
                            $tmp_current_perms = substr(decoct( fileperms($dirPath) ), 2);
                            $tmp_config_serial = $this->oCRNRSTN_USR->return_config_serial();

                            $_SESSION['CRNRSTN_'.$this->oCRNRSTN_USR->crcINT($tmp_config_serial)]['CRNRSTN_EXCEPTION_PREFIX'] = 'The CRNRSTN :: Electrum process has experienced permissions related error as the destination directory, '.$dirPath.' ('.$tmp_current_perms.'), is NOT writable to '.$mkdir_mode.', and furthermore ';
                            if(chmod($dirPath, $mkdir_mode)){

                                $_SESSION['CRNRSTN_'.$this->oCRNRSTN_USR->crcINT($tmp_config_serial)]['CRNRSTN_EXCEPTION_PREFIX'] = '';
                                return true;

                            }else{

                                $tmp_current_perms = substr(decoct( fileperms($dirPath) ), 2);

                                //
                                // HOOOSTON...VE HAF PROBLEM!
                                throw new Exception('The CRNRSTN :: Electrum process has experienced permissions related error as the destination directory, '.$dirPath.', is NOT writable as '.$tmp_current_perms.'.');

                            }

                        }

                    }else{

                        if (!$this->mkdir_r($dirPath, $mkdir_mode)) {

                            $mkdir_mode = octdec( str_pad($mkdir_mode,4,'0',STR_PAD_LEFT) );

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('The CRNRSTN :: Electrum process has experienced error as the destination directory does NOT exist, and it could NOT be created as '.$mkdir_mode.'.');

                        }else{

                            return true;

                        }

                    }

                break;
            }

        } catch (Exception $e) {

            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    //
    // SOURCE :: http://php.net/manual/en/function.mkdir.php
    // AUTHOR :: kungla at gmail dot com :: http://php.net/manual/en/function.mkdir.php#68207
    private function mkdir_r($dirName, $mode=777){

        try{

            $mode = octdec( str_pad($mode,4,'0',STR_PAD_LEFT) );
            $mode = (int)$mode;

            $dirs = explode('/', $dirName);
            $dir='';
            foreach ($dirs as $part) {
                $dir.=$part.'/';
                if (!is_dir($dir) && strlen($dir)>0) {
                    if(!mkdir($dir, $mode)){
                        $error = error_get_last();

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception($error['message']. ' mkdir_r() failed to mkdir :: ' . $dir);

                    }
                }
            }

            return true;

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }
    }

    //
    // SOURCE :: https://stackoverflow.com/questions/36310247/php-ftp-recursive-directory-listing
    // AUTHOR :: https://stackoverflow.com/users/850848/martin-prikryl
    private function ftp_list_files_recursive($ftp_stream, $path, $oEndpoint_serial){

        try{

            $path = rtrim($path, '/');

            $tmp_config_serial = $this->oCRNRSTN_USR->return_config_serial();

            //
            // STORE BASE(ROOT) ENDPOINT DIRECTORY
            $this->ftp_recursive_sniffed_directory_ARRAY[$oEndpoint_serial][] = $path;
            
            # HIDDEN FILES HIDDEN - CONFIG UPDATES FOR VSFTPD :: UBUNTU 18.04
            #https://devanswers.co/installing-ftp-server-vsftpd-ubuntu-18-04/

            //ftp_chdir($ftp_stream, $path);
            //$lines = ftp_rawlist($ftp_stream, "-A");
            //$lines = ftp_rawlist($ftp_stream, '-AL '.$path, false);
            $lines = ftp_rawlist($ftp_stream, '-AL '.$path);
            $_SESSION['CRNRSTN_'.$this->oCRNRSTN_USR->crcINT($tmp_config_serial)]['CRNRSTN_EXCEPTION_PREFIX'] = '';
            //$this->tmp_sum = $this->tmp_sum + sizeof($lines);
            //$this->oCRNRSTN_USR->error_log('CRNRSTN :: FTP DEBUG lines cnt='.sizeof($lines).' out of '.$this->tmp_sum.' total.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM_FTP);

            $result = array();

            foreach ($lines as $line){

                $tokens = explode(" ", $line);
                $name = $tokens[count($tokens) - 1];
                $type = $tokens[0][0];
                $filepath = $path . "/" . $name;

                if ($type == 'd'){

                    $this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filepath] = 0;
                    $this->ftp_recursive_sniffed_directory_ARRAY[$oEndpoint_serial][] = $filepath;
                    $result = array_merge($result, $this->ftp_list_files_recursive($ftp_stream, $filepath, $oEndpoint_serial));

                }else{

                    //$this->tmp_sum = $this->tmp_sum + 1;
                    //$this->oCRNRSTN_USR->error_log('CRNRSTN :: FTP DEBUG[sum='.$this->tmp_sum.'] type='.$type.' filepath='.$filepath, __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM_FTP);

                    $result[] = $filepath;

                    //
                    // SOURCE :: https://www.php.net/manual/en/function.ftp-size.php
                    // AUTHOR :: gerben at gerbs dot net :: https://www.php.net/manual/en/function.ftp-size.php#109141
                    $response =  ftp_raw($ftp_stream, "SIZE $filepath");
                    $filesize = floatval(str_replace('213 ', '', $response[0]));

                    //$this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filepath] = ftp_size($ftp_stream, $name);
                    $this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filepath] = $filesize;
                    if(!isset($this->source_total_filesize_ARRAY[$oEndpoint_serial][0])){

                        $this->source_total_filesize_ARRAY[$oEndpoint_serial][0] = 0;
                        $this->source_total_filesize_ARRAY[$oEndpoint_serial][0] += $filesize;

                    }else{

                        $this->source_total_filesize_ARRAY[$oEndpoint_serial][0] += $filesize;

                    }
                    $this->source_file_lastmodify_at_path_ARRAY[$oEndpoint_serial][$filepath] = ftp_mdtm($ftp_stream, $name);

                }
            }

            //$this->oCRNRSTN_USR->error_log('CRNRSTN :: FTP DEBUG[current files sum='.$this->tmp_sum.']', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM_FTP);

            return $result;

        }catch(Exception $e){

            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    //
    // SOURCE :: https://stackoverflow.com/questions/36310247/php-ftp-recursive-directory-listing
    // AUTHOR :: https://stackoverflow.com/users/850848/martin-prikryl
    private function _original_ftp_list_files_recursive($ftp_stream, $path){

        try{
            $tmp_config_serial = $this->oCRNRSTN_USR->return_config_serial();
            $lines = ftp_rawlist($ftp_stream, $path);
            $_SESSION['CRNRSTN_'.$this->oCRNRSTN_USR->crcINT($tmp_config_serial)]['CRNRSTN_EXCEPTION_PREFIX'] = '';

            $result = array();

            foreach ($lines as $line){
                $tokens = explode(" ", $line);
                $name = $tokens[count($tokens) - 1];
                $type = $tokens[0][0];
                $filepath = $path . "/" . $name;

                if ($type == 'd')
                {
                    $result = array_merge($result, $this->ftp_list_files_recursive($ftp_stream, $filepath));
                }
                else
                {
                    $result[] = $filepath;
                }
            }
            return $result;

        } catch (Exception $e) {

            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    private function merge_ftp_dir_array_to_file($ftp_contents_SOURCE, $oEndpoint_serial){

        $tmp_dirPath_flag_ARRAY = array();
        $tmp_dirPath_ARRAY = array();
        $tmp_FTP_dirPath_flagOut_ARRAY = array();

        $tmp_file_cnt = sizeof($ftp_contents_SOURCE);

        foreach($ftp_contents_SOURCE as $fileKey => $filePath){
            $tmp_dirPath_ARRAY[$filePath] = 1;

            foreach($this->ftp_recursive_sniffed_directory_ARRAY[$oEndpoint_serial] as $dirKey => $dirPath){

                $pos = strpos($filePath, $dirPath);
                if ($pos !== false && !isset($tmp_FTP_dirPath_flagOut_ARRAY[$dirPath])) {

                    //
                    // DISQUALIFY THIS DIRECTORY FOR FILE PATH MATCH
                    $tmp_FTP_dirPath_flagOut_ARRAY[$dirPath] = 5;

                }

            }

        }

        foreach($this->ftp_recursive_sniffed_directory_ARRAY[$oEndpoint_serial] as $dirKey => $dirPath){
            foreach($this->ftp_recursive_sniffed_directory_ARRAY[$oEndpoint_serial] as $dirKey2 => $dirPath2) {

                $pos = strpos($dirPath, $dirPath2);
                if ($pos !== false && !isset($tmp_FTP_dirPath_flagOut_ARRAY[$dirPath])) {

                    if( strlen($dirPath2) != strlen($dirPath)){

                        //
                        // DISQUALIFY THIS DIRECTORY FOR FILE PATH MATCH
                        $tmp_FTP_dirPath_flagOut_ARRAY[$dirPath2] = 5;

                    }
                }
            }
        }

        $tmp_tot_dir_cnt = sizeof($this->ftp_recursive_sniffed_directory_ARRAY[$oEndpoint_serial]);
        foreach($this->ftp_recursive_sniffed_directory_ARRAY[$oEndpoint_serial] as $dirKey => $dirPath) {

            if(!isset($tmp_FTP_dirPath_flagOut_ARRAY[$dirPath])){

                $pos_fslash = strpos($dirPath,'/');

                if($pos_fslash !== false) {

                    $slashChar = '/';

                }else{

                    $pos_bslash = strpos($dirPath,'\\');
                    if($pos_bslash !== false) {

                        $slashChar = '\\';

                    }else{

                        $slashChar = DIRECTORY_SEPARATOR;

                    }

                }

                $dirPath = rtrim($dirPath , $slashChar);

                $tmp_dirPath_flag_ARRAY[$dirPath.$slashChar] = 1;
                //$tmp_dirPath_ARRAY[$dirPath] = 1;
                //$this->oCRNRSTN_USR->error_log('CRNRSTN :: FTP['.$tmp_tot_dir_cnt.'] DEBUG BETTER DIR ='.$dirPath, __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM_FTP);

            }

        }

        return $tmp_dirPath_flag_ARRAY;

        //$this->oCRNRSTN_USR->error_log('CRNRSTN :: FTP DEBUG DIR ='.$dirPath, __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM_FTP);

    }

    private function path_no_slash_dot($path){

        $tmp_path_array = $this->oCRNRSTN_USR->str_split_unicode($path);
        $tmp_path_array_rev = array_reverse($tmp_path_array);

        if($tmp_path_array_rev[0]=='.' && $tmp_path_array_rev[1]=='/'){

            return false;

        }else{

            return true;

        }
    }

    private function find_deepest_empty_dir($results, $is_dir_status_array, $results_pos, $tmp_dirPath_flag_ARRAY=NULL, $prev_result_pos=NULL, $prev_result_path=NULL){

        $tmp_results_cnt = sizeof($results);
        for($search_pos=$results_pos; $search_pos<$tmp_results_cnt; $search_pos++){

            if($is_dir_status_array[$search_pos]==1){

                //
                // WE HAVE A DIRECTORY RESULT
                if ($this->path_no_slash_dot($results[$search_pos])) {

                    //
                    // DIRECTORY WITH GOOD FORMAT
                    if(!isset($prev_result_path)){
                        $prev_result_pos = $search_pos;
                        $prev_result_path = $results[$search_pos];
                        $current_result_path = $results[$search_pos];

                    }else{

                        $current_result_path = $results[$search_pos];
                        $pos = strpos($current_result_path, $prev_result_path);
                        if ($pos !== false) {

                            //
                            // TRANSITION CURRENT TO PREVIOUS
                            $prev_result_pos = $search_pos;
                            $prev_result_path = $current_result_path;


                        }else{

                            //
                            // BURN CURRENT PATH
                            if(!isset($tmp_dirPath_flag_ARRAY[$prev_result_path])){

                                //$this->oCRNRSTN_USR->error_log('['.$search_pos.']BURN DIR ->'.$prev_result_path, __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);
                                $tmp_deepest_empty_dir_ARRAY['burn_result_path'] = $prev_result_path;
                                $tmp_deepest_empty_dir_ARRAY['results_pos'] = $search_pos;

                                //$tmp_dirPath_flag_ARRAY[0] = $prev_result_path;
                                $tmp_deepest_empty_dir_ARRAY['flag_array'][0] = $prev_result_path;

                                return $tmp_deepest_empty_dir_ARRAY;

                            }else{

                                return NULL;

                            }

                        }

                    }

                }

            }else{

                //
                // WE HAVE FILE. SKIP DIRECTORY.

            }

        }

    }

    //
    // SOURCE :: http://php.net/manual/en/class.recursivedirectoryiterator.php
    // AUTHOR :: http://php.net/manual/en/class.recursivedirectoryiterator.php#85805
    public function localdir_list_files_recursive($dir, $oEndpoint_serial, $files_only=false){
        $results = array();
        $results_final_output = array();
        $results_filePath_output = array();
        $is_dir_status_array = array();
        $path = realpath($dir);
        $results_totalSize = 0;

        $objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST);
        foreach ($objects as $name => $object) {
            //if ((strpos($name, '/.') !== false) || (strpos($name, '/..') !== false)) {
            if ((strpos($name, '/..') !== false)) {

            } else {

                $this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$name] = 0;

                if (!$files_only) {

                    $results[] = $name;
                    //$this->oCRNRSTN_USR->error_log('RAW ->' . $name, __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                    if (!(is_dir($name))) {
                        //$this->oCRNRSTN_USR->error_log('FILE ->'.$name, __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                        //
                        // WE HAVE A FILE
                        if ($this->path_no_slash_dot($name)) {

                            $results_filePath_output[$name] = 1;
                            $results_final_output[$name] = 1;

                            $tmp_filestat_ARRAY = stat($name);
                            $this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$name] = $this->find_filesize($name);

                            $tmp_array = posix_getpwuid($tmp_filestat_ARRAY['uid']);
                            $this->source_file_uid_INT_at_path_ARRAY[$oEndpoint_serial][$name] = $tmp_filestat_ARRAY['uid'];
                            $this->source_file_uid_STRING_at_path_ARRAY[$oEndpoint_serial][$name] = $tmp_array['name'];

                            $tmp_array = posix_getgrgid($tmp_filestat_ARRAY['gid']);
                            $this->source_file_gid_INT_at_path_ARRAY[$oEndpoint_serial][$name] = $tmp_filestat_ARRAY['gid'];
                            $this->source_file_gid_STRING_at_path_ARRAY[$oEndpoint_serial][$name] = $tmp_array['name'];

                            $this->source_file_lastaccess_at_path_ARRAY[$oEndpoint_serial][$name] = $tmp_filestat_ARRAY['atime'];
                            $this->source_file_lastmodify_at_path_ARRAY[$oEndpoint_serial][$name] = $tmp_filestat_ARRAY['mtime'];

                            $this->source_file_blocksize_at_path_ARRAY[$oEndpoint_serial][$name] = $tmp_filestat_ARRAY['blksize'];
                            $this->source_file_blockallocate_at_path_ARRAY[$oEndpoint_serial][$name] = $tmp_filestat_ARRAY['blocks'];

                            $perms = fileperms($name);
                            $this->source_file_fullpermissions_at_path_ARRAY[$oEndpoint_serial][$name] = $this->return_full_permissions($perms);

                            // SOURCE :: https://www.php.net/manual/en/function.fileperms.php
                            // AUTHOR :: coolmic at example dot com :: https://www.php.net/manual/en/function.fileperms.php#113060
                            $this->source_file_octalpermissions_at_path_ARRAY[$oEndpoint_serial][$name] = decoct($perms & 0777);

                            $results_totalSize += $this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$name];

                        }

                        $is_dir_status_array[] = 0;

                    } else {
                        //$this->oCRNRSTN_USR->error_log('DIR ->'.$name, __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                        //
                        // WE HAVE A DIRECTORY
                        $is_dir_status_array[] = 1;

                    }

                } else {

                    if (!(is_dir($name))) {

                        $results[] = $name;

                    }

                }

            }

        }

        //
        // SEARCH FOR EMPTY DIRECTORIES
        if (!$files_only) {
            $tmp_dirPath_flag_ARRAY = array();
            $tmp_dirPath_ARRAY = array();
            $tmp_dirPath_flagOut_ARRAY = array();

            //
            // LOOP THROUGH RESULT SET AND ADD ANY EMPTY DIR
            $tmp_result_cnt = sizeof($results);
            for ($results_pos = 0; $results_pos < $tmp_result_cnt; $results_pos++) {

                $tmp_dir_selection = $this->find_deepest_empty_dir($results, $is_dir_status_array, $results_pos, $tmp_dirPath_flag_ARRAY);

                if(isset($tmp_dir_selection)){
                    //$this->oCRNRSTN_USR->error_log('WE LIKE DIR ->'.$tmp_dir_selection['flag_array'][0], __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                    $tmp_dirPath_flag_ARRAY[$tmp_dir_selection['flag_array'][0]] = 1;

                }

            }

            //
            // FOR EACH DIRECTORY PATH, IS THERE A FILE CONTAINING IT THEREIN?
            foreach($results_filePath_output as $filePth => $fileKey){

                foreach($tmp_dirPath_flag_ARRAY as $dirPath => $dirKey){
                    $pos = strpos($filePth, $dirPath);
                    if ($pos !== false && !isset($tmp_dirPath_flagOut_ARRAY[$dirPath])) {

                        //
                        // DISQUALIFY THIS DIRECTORY FOR FILE PATH MATCH
                        //$this->oCRNRSTN_USR->error_log('DISQUALIFY THIS DIRECTORY->'.$dirPath, __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                        $tmp_dirPath_flagOut_ARRAY[$dirPath] = 5;

                    }
                }
            }

            //
            // APPEND EMPTY DIRECTORIES TO ARRAY OF FILEPATH
            foreach($tmp_dirPath_flag_ARRAY as $dirPath => $dirKey){

                if(!isset($tmp_dirPath_flagOut_ARRAY[$dirPath])){
                    //$this->oCRNRSTN_USR->error_log('WE BURN DIR ->'.$dirPath, __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                    $results_final_output[$dirPath] = 1;

                }

            }

        }

        $this->source_total_filesize_ARRAY[$oEndpoint_serial][] = $results_totalSize;

        return $results_final_output;

    }

    private function return_exclusion_title_copy($result_ARRAY, $content_type){

        /*
        $result_ARRAY['not_excluded'] = false;
        $result_ARRAY['pattern'] = $qualification_pattern;
        $result_ARRAY['asset_meta'] = $filePath;
        $result_ARRAY['pattern_type'] = $exclusion_type;
        $result_ARRAY['exclusion_meta'] = $this->source_file_gid_STRING_at_path_ARRAY[$oEndpoint_serial][$filePath].'<->'.$this->source_file_gid_INT_at_path_ARRAY[$oEndpoint_serial][$filePath];

        DIRECTORY
        FILE
        OWNER_GROUP
        OWNER_USER
        MODIFIED_NT
        MODIFIED_OT
        ACCESSED_NT
        ACCESSED_OT
        FILE_SIZE_GT
        FILE_SIZE_LT
        */

        $tmp_str = '';

        switch($result_ARRAY['pattern_type']){
            case 'DIRECTORY':
                if($content_type == 'ELECTRUM_DATA_HANDLING_PROFILE_HTML'){

                    $tmp_str .= 'Files with a directory in their file path which matches <em>"'.$result_ARRAY['pattern'].'".</em>';

                }else{

                    $tmp_str .= 'Files with a directory in their file path which matches "'.$result_ARRAY['pattern'].'".';

                }

            break;
            case 'FILE':

                if($content_type == 'ELECTRUM_DATA_HANDLING_PROFILE_HTML'){

                    $tmp_str .= 'Files with a name that matches the pattern, <em>"'.$result_ARRAY['pattern'].'".</em>';

                }else{

                    $tmp_str .= 'Files with a name that matches the pattern, "'.$result_ARRAY['pattern'].'".';

                }

            break;
            case 'OWNER_GROUP':

                if($content_type == 'ELECTRUM_DATA_HANDLING_PROFILE_HTML'){

                    $tmp_str .= 'Files with group owner meta that matches the group id, <em>"'.$result_ARRAY['exclusion_meta'].'".</em>';

                }else{

                    $tmp_str .= 'Files with group owner meta that matches the group id, "'.$result_ARRAY['exclusion_meta'].'".';

                }

            break;
            case 'OWNER_USER':

                if($content_type == 'ELECTRUM_DATA_HANDLING_PROFILE_HTML'){

                    $tmp_str .= 'Files owned by a user having the user id, <em>"'.$result_ARRAY['exclusion_meta'].'".</em>';

                }else{

                    $tmp_str .= 'Files owned by a user having the user id, "'.$result_ARRAY['exclusion_meta'].'".';

                }

            break;
            case 'MODIFIED_NT':

                if($content_type == 'ELECTRUM_DATA_HANDLING_PROFILE_HTML'){

                    $tmp_str .= 'Files last modified at a time newer than, <em>"'.$result_ARRAY['pattern'].'".</em>';

                }else{

                    $tmp_str .= 'Files last modified at a time newer than, "'.$result_ARRAY['pattern'].'".';

                }

            break;
            case 'MODIFIED_OT':

                if($content_type == 'ELECTRUM_DATA_HANDLING_PROFILE_HTML'){

                    $tmp_str .= 'Files last modified at a time older than, <em>"'.$result_ARRAY['pattern'].'".</em>';

                }else{

                    $tmp_str .= 'Files last modified at a time older than, "'.$result_ARRAY['pattern'].'".';

                }

            break;
            case 'ACCESSED_NT':

                if($content_type == 'ELECTRUM_DATA_HANDLING_PROFILE_HTML'){

                    $tmp_str .= 'Files last accessed at a time newer than, <em>"'.$result_ARRAY['pattern'].'".</em>';

                }else{

                    $tmp_str .= 'Files last accessed at a time newer than, "'.$result_ARRAY['pattern'].'".';

                }

            break;
            case 'ACCESSED_OT':

                if($content_type == 'ELECTRUM_DATA_HANDLING_PROFILE_HTML'){

                    $tmp_str .= 'Files last accessed at a time older than, <em>"'.$result_ARRAY['pattern'].'".</em>';

                }else{

                    $tmp_str .= 'Files last accessed at a time older than, "'.$result_ARRAY['pattern'].'".';

                }

            break;
            case 'FILE_SIZE_GT':

                if($content_type == 'ELECTRUM_DATA_HANDLING_PROFILE_HTML'){

                    $tmp_str .= 'Files having a file size that is larger than, <em>"'.$this->oCRNRSTN_USR->format_bytes($result_ARRAY['pattern'], 5).'".</em>';

                }else{

                    $tmp_str .= 'Files having a file size that is larger than, "'.$this->oCRNRSTN_USR->format_bytes($result_ARRAY['pattern'], 5).'".';

                }

            break;
            case 'FILE_SIZE_LT':

                if($content_type == 'ELECTRUM_DATA_HANDLING_PROFILE_HTML'){

                    $tmp_str .= 'Files having a file size that is smaller than, <em>"'.$this->oCRNRSTN_USR->format_bytes($result_ARRAY['pattern'], 5).'".</em>';

                }else{

                    $tmp_str .= 'Files having a file size that is smaller than, "'.$this->oCRNRSTN_USR->format_bytes($result_ARRAY['pattern'], 5).'".';

                }

            break;

        }

        return $tmp_str;

    }

    private function loadElectrumData($execution_serial, $batch_serial, $content_type, $section_content_shell, $hot_dest_connection_ARRAY=NULL){

        $tmp_final_out = '';

        switch($content_type){
            case 'ELECTRUM_DATA_HANDLING_FILE_EXCLUSION_SOURCE_TEXT':
            case 'ELECTRUM_DATA_HANDLING_FILE_EXCLUSION_SOURCE_HTML':

                #$hot_dest_connection_ARRAY = $tmp_suppression_profile[$pattern_type]

                /*
                $tmp_suppression_profile[$oEndpoint_serial][$result_ARRAY['pattern_type']]['asset_count'] = 0;
                $tmp_suppression_profile[$oEndpoint_serial][$result_ARRAY['pattern_type']]['total_filesize'] = 0;
                $tmp_suppression_profile[$oEndpoint_serial][$result_ARRAY['pattern_type']]['title_copy'] = $this->return_exclusion_title_copy($result_ARRAY, $content_type);
                $tmp_suppression_profile[$oEndpoint_serial][$result_ARRAY['pattern_type']]['connection_type'] = $oEndpoint_connection_type;
                $tmp_suppression_profile[$oEndpoint_serial][$result_ARRAY['pattern_type']]['oEndpoint_serial']
                */

                //$tmp_exclusion_source_shell_HTML = $this->return_electrumDataHandlingSourceDIROutputShell('HTML');
                //$tmp_exclusion_source_shell_TEXT = $this->return_electrumDataHandlingSourceDIROutputShell();
                $tmp_destination_count = 0;
                foreach($this->queued_endpoint_ARRAY[$batch_serial]['DESTINATION'] as $key_src => $hot_src_connection_ARRAY){

                    $tmp_destination_count++;

                }

                $tmp_exclusion_source_shell = $section_content_shell;
                $tmp_sect_final_out = '';

                foreach($this->queued_endpoint_ARRAY[$batch_serial]['SOURCE'] as $key_src => $hot_src_connection_ARRAY){

                    $oEndpoint = $hot_src_connection_ARRAY['FIREHOT_oEndpoint'];
                    $oEndpoint_serial = $oEndpoint->return_serial();
                    $oEndpoint_conn_type = $oEndpoint->return_connection_type();

                    if(isset($hot_dest_connection_ARRAY[$oEndpoint_serial]['asset_count'])) {

                        $tmp_sect_final_out .= $tmp_exclusion_source_shell;

                        if ($hot_dest_connection_ARRAY[$oEndpoint_serial]['connection_type'] == 'FTP') {

                            $tmp_server = $oEndpoint->return_FTP_SERVER();
                            $tmp_FTP_DIR_PATH = $oEndpoint->return_FTP_DIR_PATH();

                            $tmp_source_path = 'FTP ['.$tmp_server . '] ' . $tmp_FTP_DIR_PATH;

                        } else {

                            $tmp_source_path = $oEndpoint->return_LOCAL_DIR_PATH();

                            if (!is_dir($tmp_source_path)) {

                                $local_oWCR_key = $oEndpoint->return_local_oWCR_key();
                                $tmp_source_path = $this->oCRNRSTN_USR->get_resource('LOCAL_DIR_PATH', $local_oWCR_key);

                            }

                        }

                        //$tmp_total_filesize = $this->oCRNRSTN_USR->format_bytes($hot_dest_connection_ARRAY[$oEndpoint_serial]['total_filesize']);
                        // **  where $hot_dest_connection_ARRAY = $tmp_suppression_profile[$result_ARRAY['pattern_type']][$oEndpoint_serial]['total_filesize']
                        $tmp_total_excluded_filesize = $hot_dest_connection_ARRAY[$oEndpoint_serial]['total_filesize'];

                        if ($content_type == 'ELECTRUM_DATA_HANDLING_FILE_EXCLUSION_SOURCE_HTML') {

                            if(strlen($tmp_source_path)>71){

                                //
                                // BREAK AT GOOD CHAR CHUNK TO THE END
                                $oChunkRestrictData = $this->oCRNRSTN_USR->chunkPageData($tmp_source_path, 71);
                                $tmp_path_array['chunked_content'] = $oChunkRestrictData->return_linesArray();

                                $tmp_source_path = '';
                                foreach($tmp_path_array['chunked_content'] as $key => $str_line){

                                    $tmp_source_path .=  $str_line . '<br>...';

                                }

                                $tmp_source_path = rtrim($tmp_source_path, '.');
                                $tmp_source_path = rtrim($tmp_source_path, '<br>');

                            }

                            $tmp_asset_multplier_cnt = $hot_dest_connection_ARRAY[$oEndpoint_serial]['asset_count'];
                            $tmp_asset_unique_cnt = $tmp_asset_multplier_cnt/$tmp_destination_count;
                            $tmp_filesize_unique_cnt = $tmp_total_excluded_filesize/$tmp_destination_count;
                            $tmp_filesize_unique_cnt = $this->oCRNRSTN_USR->format_bytes($tmp_filesize_unique_cnt, 4);

                            $tmp_exclusion_source_stats_HTML = $tmp_asset_unique_cnt . ' files<br>totaling '.$tmp_filesize_unique_cnt;

                            $tmp_sect_final_out = $this->oCRNRSTN_USR->proper_replace('{FILE_EXCLUSION_SOURCE_DIR_HTML}', $tmp_source_path, $tmp_sect_final_out);
                            $tmp_sect_final_out = $this->oCRNRSTN_USR->proper_replace('{FILE_EXCLUSION_SOURCE_STATS_HTML}', $tmp_exclusion_source_stats_HTML, $tmp_sect_final_out);

                            //$this->oCRNRSTN_USR->error_log($tmp_sect_final_out, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_PROFILE');

                        } else {

                            if(strlen($tmp_source_path)>52) {

                                //
                                // BREAK AT GOOD CHAR CHUNK TO THE END
                                $oChunkRestrictData = $this->oCRNRSTN_USR->chunkPageData($tmp_source_path, 52);
                                $tmp_path_array['chunked_content'] = $oChunkRestrictData->return_linesArray();

                                $tmp_source_path = '';
                                foreach ($tmp_path_array['chunked_content'] as $key => $str_line) {

                                    $tmp_source_path .= $str_line . '
...';

                                }

                                $tmp_source_path = rtrim($tmp_source_path, '.');
                                $tmp_source_path = rtrim($tmp_source_path, '
');
                            }

                            $tmp_asset_multplier_cnt = $hot_dest_connection_ARRAY[$oEndpoint_serial]['asset_count'];
                            $tmp_asset_unique_cnt = $tmp_asset_multplier_cnt/$tmp_destination_count;
                            $tmp_filesize_unique_cnt = $tmp_total_excluded_filesize/$tmp_destination_count;
                            $tmp_filesize_unique_cnt = $this->oCRNRSTN_USR->format_bytes($tmp_filesize_unique_cnt);

                            $tmp_exclusion_source_stats_TEXT = $tmp_asset_unique_cnt . ' files totaling '.$tmp_filesize_unique_cnt;

                            $tmp_sect_final_out = $this->oCRNRSTN_USR->proper_replace('{FILE_EXCLUSION_SOURCE_DIR_TEXT}', $tmp_source_path, $tmp_sect_final_out);
                            $tmp_sect_final_out = $this->oCRNRSTN_USR->proper_replace('{FILE_EXCLUSION_SOURCE_STATS_TEXT}', $tmp_exclusion_source_stats_TEXT, $tmp_sect_final_out);

                            //$this->oCRNRSTN_USR->error_log($tmp_sect_final_out, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_PROFILE');

                        }

                    }

                }

                //$this->oCRNRSTN_USR->error_log($tmp_sect_final_out, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_PROFILE');

                return $tmp_sect_final_out;

            break;
            case 'ELECTRUM_DATA_HANDLING_PROFILE_TEXT':
            case 'ELECTRUM_DATA_HANDLING_PROFILE_HTML':

                $tmp_flag_exclusions = false;
                $tmp_suppression_profile = array();

                //
                // FOR EACH SOURCE ENDPOINT
                foreach($this->queued_endpoint_ARRAY[$batch_serial]['SOURCE'] as $key_src => $hot_src_connection_ARRAY) {

                    $oEndpoint = $hot_src_connection_ARRAY['FIREHOT_oEndpoint'];
                    $oEndpoint_serial = $oEndpoint->return_serial();
                    $oEndpoint_connection_type = $oEndpoint->return_connection_type();

                    if(isset($this->asset_suppressed_ARRAY[$this->electrum_process_id][$batch_serial][$oEndpoint_serial])){

                        $tmp_flag_exclusions = true;
                        foreach($this->asset_suppressed_ARRAY[$this->electrum_process_id][$batch_serial][$oEndpoint_serial] as $key_asup => $result_ARRAY){

                            if(!$result_ARRAY['not_excluded']){

                                if(!isset($tmp_suppression_profile[$result_ARRAY['pattern_type']][$oEndpoint_serial]['title_copy'])){

                                    $tmp_suppression_profile[$result_ARRAY['pattern_type']][$oEndpoint_serial]['asset_count'] = 0;
                                    $tmp_suppression_profile[$result_ARRAY['pattern_type']][$oEndpoint_serial]['total_filesize'] = 0;
                                    $tmp_suppression_profile[$result_ARRAY['pattern_type']][$oEndpoint_serial]['title_copy'] = $this->return_exclusion_title_copy($result_ARRAY, $content_type);
                                    $this->oCRNRSTN_USR->error_log('We have an exclusion...['.$tmp_suppression_profile[$result_ARRAY['pattern_type']][$oEndpoint_serial]['title_copy'].']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_PROFILE');

                                    $tmp_suppression_profile[$result_ARRAY['pattern_type']][$oEndpoint_serial]['connection_type'] = $oEndpoint_connection_type;
                                    $tmp_suppression_profile[$result_ARRAY['pattern_type']][$oEndpoint_serial]['oEndpoint_serial'] = $oEndpoint_serial;

                                }

                                $tmp_suppression_profile[$result_ARRAY['pattern_type']][$oEndpoint_serial]['asset_count'] = $tmp_suppression_profile[$result_ARRAY['pattern_type']][$oEndpoint_serial]['asset_count'] + 1;
                                $tmp_suppression_profile[$result_ARRAY['pattern_type']][$oEndpoint_serial]['total_filesize'] = $tmp_suppression_profile[$result_ARRAY['pattern_type']][$oEndpoint_serial]['total_filesize'] + $this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$result_ARRAY['asset_path']];

                            }

                        }

                    }

                }

                //
                // RETURN AGGREGATION OF SECTION CONTENT
                $tmp_title_output_ARRAY = array();

                $tmp_final_out = '';
                $tmp_pattern_title_flag_ARRAY = array();
                $tmp_exclusion_section_shell = $section_content_shell;
                $tmp_exclusion_source_shell_HTML = $this->return_electrumDataHandlingSourceDIROutputShell('HTML');
                $tmp_exclusion_source_shell_TEXT = $this->return_electrumDataHandlingSourceDIROutputShell();

                foreach($tmp_suppression_profile as $pattern_type => $chunkArray){
                    foreach($chunkArray as $oEndpoint_serial => $indexKey) {

                        //
                        // SET EXCLUSION RULE TITLE
                        if (!isset($tmp_pattern_title_flag_ARRAY[$pattern_type]['title_copy'])) {

                            $tmp_final_out .= $tmp_exclusion_section_shell;

                            $tmp_pattern_title_flag_ARRAY[$pattern_type]['title_copy'] = $tmp_suppression_profile[$pattern_type][$oEndpoint_serial]['title_copy'];
                            //$this->oCRNRSTN_USR->error_log($tmp_suppression_profile[$pattern_type][$oEndpoint_serial]['title_copy'], __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_PROFILE');

                            $tmp_final_out = $this->oCRNRSTN_USR->proper_replace('{FILE_EXCLUSION_RULE_COPY}', $tmp_pattern_title_flag_ARRAY[$pattern_type]['title_copy'], $tmp_final_out);

                            //
                            // SET EXCLUSION RULE - AFFECTED SOURCE DATA
                            if ($content_type == 'ELECTRUM_DATA_HANDLING_PROFILE_HTML') {

                                $tmp_exclusion_source_heavy = $this->loadElectrumData($execution_serial, $batch_serial, 'ELECTRUM_DATA_HANDLING_FILE_EXCLUSION_SOURCE_HTML', $tmp_exclusion_source_shell_HTML, $tmp_suppression_profile[$pattern_type]);
                                $tmp_final_out = $this->oCRNRSTN_USR->proper_replace('{FILE_EXCLUSION_SOURCE_DIR_SECTION_HTML}', $tmp_exclusion_source_heavy, $tmp_final_out);

                            } else {

                                $tmp_exclusion_source_heavy = $this->loadElectrumData($execution_serial, $batch_serial, 'ELECTRUM_DATA_HANDLING_FILE_EXCLUSION_SOURCE_TEXT', $tmp_exclusion_source_shell_TEXT, $tmp_suppression_profile[$pattern_type]);
                                $tmp_final_out = $this->oCRNRSTN_USR->proper_replace('{FILE_EXCLUSION_SOURCE_DIR_SECTION_TEXT}', $tmp_exclusion_source_heavy, $tmp_final_out);

                            }

                        }

                    }

                }

                if(!$tmp_flag_exclusions){

                    $tmp_final_out .= $tmp_exclusion_section_shell;

                    if($content_type == 'ELECTRUM_DATA_HANDLING_PROFILE_HTML'){

                        $tmp_content = '<tr>
                                        <td>
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                <tr>
                                                    <td colspan="3" style="border-top: 2px solid #666;"><div style="font-family:Arial, Helvetica, sans-serif; font-size:10px; line-height: 3px; border-top: 0px solid #FFF; width:100%;"></div></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                        <div style="border-left:15px solid #F0F0F0; border-right: 15px solid #F0F0F0; border-top:10px solid #F0F0F0; border-bottom:10px solid #F0F0F0; background-color: #F0F0F0; font-family: Arial, Helvetica, sans-serif; font-size:16px; text-align:left; font-weight: normal;">{FILE_EXCLUSION_RULE_COPY}</div>
                                                    </td>
                                                </tr>
                                                {FILE_EXCLUSION_SOURCE_DIR_SECTION_HTML}
                                            </table>
                                        </td>
                                    </tr>';

                        $tmp_exclusion_source_heavy = 'No asset exclusions have been applied.';

                        $tmp_final_out = $this->oCRNRSTN_USR->proper_replace('{FILE_EXCLUSION_RULE_COPY}', $tmp_exclusion_source_heavy, $tmp_content);
                        $tmp_final_out = $this->oCRNRSTN_USR->proper_replace('{FILE_EXCLUSION_SOURCE_DIR_SECTION_HTML}', '', $tmp_final_out);

                    }else{

                        $tmp_content = '= = = = = = = = = = = = = = = = = = = = = = = = =
{FILE_EXCLUSION_RULE_COPY}
{FILE_EXCLUSION_SOURCE_DIR_SECTION_TEXT}';
                        $tmp_exclusion_source_heavy = 'No asset exclusions have been applied.';

                        $tmp_final_out = $this->oCRNRSTN_USR->proper_replace('{FILE_EXCLUSION_RULE_COPY}', $tmp_exclusion_source_heavy, $tmp_content);
                        $tmp_final_out = $this->oCRNRSTN_USR->proper_replace('{FILE_EXCLUSION_SOURCE_DIR_SECTION_TEXT}', '', $tmp_final_out);

                    }

                }

                //$this->oCRNRSTN_USR->error_log($tmp_final_out, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_PROFILE');

                return $tmp_final_out;

            break;
            case 'ELECTRUM_DESTINATION_PATHS_DETAIL_TEXT':
            case 'ELECTRUM_DESTINATION_PATHS_DETAIL_HTML':

                $tmp_sect_final_out = '';

                $tmp_oEndpoint_DESTINATION = $hot_dest_connection_ARRAY['FIREHOT_oEndpoint'];
                $tmp_source_to_destination_transfer_ARRAY = $this->oElectrum_STATS->return_source_to_destination_stats_array($execution_serial, $batch_serial, $tmp_oEndpoint_DESTINATION);

                $src_to_dest_cnt = $tmp_source_to_destination_transfer_ARRAY['src_to_dest_cnt'];
                for($i=0; $i<$src_to_dest_cnt; $i++){

                    $tmp_total_file_movements = $tmp_source_to_destination_transfer_ARRAY['activity_stats'][$i]['asset_transfer_count'];
                    $tmp_dyn_dest_path = $tmp_source_to_destination_transfer_ARRAY['activity_stats'][$i]['destination_path'];

                    $tmp_str_ARRAY = $this->return_universalPathProperBreak($tmp_dyn_dest_path);
                    $tmp_dyn_dest_path_TEXT = $tmp_str_ARRAY['str'];

                    $tmp_str_ARRAY = $this->return_universalPathProperBreak($tmp_dyn_dest_path, 69, true);
                    $tmp_dyn_dest_path_HTML = $tmp_str_ARRAY['str'];


                    $tmp_sect_final_out .= $section_content_shell;

                    if ($content_type == 'ELECTRUM_DESTINATION_PATHS_DETAIL_HTML') {

                        if ($tmp_total_file_movements == 1) {

                            $tmp_sect_final_out = $this->oCRNRSTN_USR->proper_replace('{ENDPOINT_FILES_MOVED_COUNT}', $tmp_total_file_movements . ' asset', $tmp_sect_final_out);

                        } else {

                            $tmp_sect_final_out = $this->oCRNRSTN_USR->proper_replace('{ENDPOINT_FILES_MOVED_COUNT}', $tmp_total_file_movements . ' assets', $tmp_sect_final_out);

                        }

                        $tmp_sect_final_out = $this->oCRNRSTN_USR->proper_replace('{ENDPOINT_FILES_MOVED_PATH}', $tmp_dyn_dest_path_HTML, $tmp_sect_final_out);


                    } else {

                        if ($tmp_total_file_movements == 1) {

                            $tmp_sect_final_out = $this->oCRNRSTN_USR->proper_replace('{ENDPOINT_FILES_MOVED_COUNT}', $tmp_total_file_movements . ' asset', $tmp_sect_final_out);

                        } else {

                            $tmp_sect_final_out = $this->oCRNRSTN_USR->proper_replace('{ENDPOINT_FILES_MOVED_COUNT}', $tmp_total_file_movements . ' assets', $tmp_sect_final_out);

                        }

                        $tmp_sect_final_out = $this->oCRNRSTN_USR->proper_replace('{ENDPOINT_FILES_MOVED_PATH}', $tmp_dyn_dest_path_TEXT, $tmp_sect_final_out);


                    }

                }

                return $tmp_sect_final_out;

            break;
            case 'ELECTRUM_DATA_DESTINATION_TEXT':
            case 'ELECTRUM_DATA_DESTINATION_HTML':

                foreach($this->queued_endpoint_ARRAY[$batch_serial]['DESTINATION'] as $key_src => $hot_dest_connection_ARRAY) {
                    $tmp_thumb_border_top_FLAG = true;
                    $tmp_thumb_border_top = 15;
                    $tmp_final_out .= $section_content_shell;

                    $tmp_oEndpoint = $hot_dest_connection_ARRAY['FIREHOT_oEndpoint'];
                    $tmp_timestamp_nom = $tmp_oEndpoint->return_timestamp_nom();
                    //$this->oCRNRSTN_USR->error_log('ELECTRUM_DATA_DESTINATION_HTML tmp_timestamp_nom=>'.$tmp_timestamp_nom, __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                    if(!is_object($hot_dest_connection_ARRAY['oLightning_ftp_conn'])) {

                        //
                        // DIRECTORY DESTINATION
                        $tmp_endpoint_type = 'Local Directory';
                        $tmp_dest_DIR_PATH = $tmp_oEndpoint->return_LOCAL_DIR_PATH();

                        if (!is_dir($tmp_dest_DIR_PATH)) {

                            $local_oWCR_key = $tmp_oEndpoint->return_local_oWCR_key();
                            $tmp_dest_DIR_PATH = $this->oCRNRSTN_USR->get_resource('LOCAL_DIR_PATH', $local_oWCR_key);

                        }

                        $tmp_dest_path_or_ip = $tmp_dest_DIR_PATH;

                    }else{

                        //
                        // FTP DESTINATION
                        $tmp_endpoint_type = 'FTP';
                        $tmp_dest_FTP_SERVER = $tmp_oEndpoint->return_FTP_SERVER();
                        $tmp_dest_FTP_PORT = $tmp_oEndpoint->return_FTP_PORT();
                        $tmp_dest_DIR_PATH = $tmp_oEndpoint->return_FTP_DIR_PATH();
                        $tmp_dest_path_or_ip = $tmp_dest_FTP_SERVER.' at port '.$tmp_dest_FTP_PORT;

                    }

                    $oEndpoint_serial = $tmp_oEndpoint->return_serial();
                    if(!$this->endpoint_isValid_ARRAY[$oEndpoint_serial]) {

                        //
                        // CONNECTION ERROR
                        $tmp_thumb = $this->return_quickGlanceThumb('error');
                        $tmp_copy = $this->return_quickGlanceCopy('error');
                        $tmp_thumb_TEXT = '** CONNECTION ERROR **';

                    }else{

                        $tmp_thumb = $this->return_quickGlanceThumb('success');
                        $tmp_copy = $this->return_quickGlanceCopy('success');
                        $tmp_thumb_TEXT = '** CONNECTION SUCCESS **';

                    }

                    if ($content_type == 'ELECTRUM_DATA_DESTINATION_HTML') {

                        if($tmp_timestamp_nom != '' && is_dir($tmp_dest_path_or_ip)){

                            $tmp_dest_path_or_ip_HTML = $tmp_dest_path_or_ip.$tmp_timestamp_nom;

                        }else{

                            $tmp_dest_path_or_ip_HTML = $tmp_dest_path_or_ip;

                        }

                        $tmp_str_ARRAY = $this->return_universalPathProperBreak($tmp_dest_path_or_ip, 52, true);

                        $tmp_dest_path_or_ip_TITLE = $tmp_str_ARRAY['str'];

                        if(strlen($tmp_dest_path_or_ip)>52){

                            for($i=0; $i<$tmp_str_ARRAY['border_increment']; $i++){

                                if($tmp_thumb_border_top_FLAG){

                                    $tmp_thumb_border_top_FLAG = false;

                                }else{

                                    $tmp_thumb_border_top += 25;

                                }

                            }

                        }

                        //
                        // ADD TRAILING SLASH
                        if($tmp_timestamp_nom!='' && is_dir($tmp_dest_path_or_ip)){

                            $tmp_dest_path_or_ip_HTML .= $tmp_str_ARRAY['slashChar'];

                        }

                        $this->oCRNRSTN_USR->error_log('oWheel tmp_dest_path_or_ip_HTML='.$tmp_dest_path_or_ip_HTML, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');


                        $tmp_cummulative_dest_path = $this->return_electrumDataDestinationPathDetailsOutputShell('HTML');

                        $tmp_cummulative_dest_path = $this->loadElectrumData($execution_serial, $batch_serial, 'ELECTRUM_DESTINATION_PATHS_DETAIL_HTML', $tmp_cummulative_dest_path, $hot_dest_connection_ARRAY);

                        $tmp_final_out = $this->oCRNRSTN_USR->proper_replace('{THUMB_BORDER_TOP}', $tmp_thumb_border_top, $tmp_final_out);
                        $tmp_final_out = $this->oCRNRSTN_USR->proper_replace('{STATUS_THUMBNAIL_QUICKGLANCE}', $tmp_thumb, $tmp_final_out);
                        $tmp_final_out = $this->oCRNRSTN_USR->proper_replace('{STATUS_COPY_QUICKGLANCE}', $tmp_copy, $tmp_final_out);
                        $tmp_final_out = $this->oCRNRSTN_USR->proper_replace('{ENDPOINT_PATH_OR_IP+PORT}', $tmp_dest_path_or_ip_TITLE, $tmp_final_out);
                        //$tmp_final_out = $this->oCRNRSTN_USR->proper_replace('{ENDPOINT_FILES_MOVED_COUNT}', $total_endpoint_file_count . ' files', $tmp_final_out);
                        $tmp_final_out = $this->oCRNRSTN_USR->proper_replace('{ELECTRUM_DESTINATION_PATHS_DETAIL_HTML}', $tmp_cummulative_dest_path, $tmp_final_out);
                        $tmp_final_out = $this->oCRNRSTN_USR->proper_replace('{ENDPOINT_TYPE}', $tmp_endpoint_type, $tmp_final_out);

                    } else {

                        if($tmp_timestamp_nom!='' && is_dir($tmp_dest_path_or_ip)){

                            $tmp_dest_path_or_ip_TEXT = $tmp_dest_path_or_ip.$tmp_timestamp_nom;

                        }else{

                            $tmp_dest_path_or_ip_TEXT = $tmp_dest_path_or_ip;

                        }

                        if (strlen($tmp_dest_path_or_ip) > 52) {

                            //
                            // BREAK AT GOOD 52 CHAR CHUNK TO THE END
                            $oChunkRestrictData = $this->oCRNRSTN_USR->chunkPageData($tmp_dest_path_or_ip_TEXT, 52);
                            $tmp_path_array['chunked_content'] = $oChunkRestrictData->return_linesArray();

                            $tmp_dest_path_or_ip_TEXT = '';
                            $tmp_break_size = sizeof($tmp_path_array['chunked_content']);
                            for ($i = 0; $i < $tmp_break_size; $i++) {

                                $tmp_dest_path_or_ip_TEXT .= $tmp_path_array['chunked_content'][$i] . '
...';

                            }

                            $tmp_dest_path_or_ip_TEXT = rtrim($tmp_dest_path_or_ip_TEXT, '.');
                            $tmp_dest_path_or_ip_TEXT = rtrim($tmp_dest_path_or_ip_TEXT, '
');

                        }

                        //
                        // TEXT VERSION
                        $tmp_cummulative_dest_path = $this->return_electrumDataDestinationPathDetailsOutputShell();
                        $tmp_cummulative_dest_path = $this->loadElectrumData($execution_serial, $batch_serial, 'ELECTRUM_DESTINATION_PATHS_DETAIL_TEXT', $tmp_cummulative_dest_path, $hot_dest_connection_ARRAY);

                        $tmp_final_out = $this->oCRNRSTN_USR->proper_replace('{STATUS_THUMBNAIL_QUICKGLANCE}', $tmp_thumb_TEXT, $tmp_final_out);
                        $tmp_final_out = $this->oCRNRSTN_USR->proper_replace('{ENDPOINT_PATH_OR_IP+PORT}', $tmp_dest_path_or_ip_TEXT, $tmp_final_out);
                        //$tmp_final_out = $this->oCRNRSTN_USR->proper_replace('{ENDPOINT_FILES_MOVED_COUNT}', $total_endpoint_file_count . ' files', $tmp_final_out);
                        $tmp_final_out = $this->oCRNRSTN_USR->proper_replace('{ELECTRUM_DESTINATION_PATHS_DETAIL_TEXT}', $tmp_cummulative_dest_path, $tmp_final_out);
                        $tmp_final_out = $this->oCRNRSTN_USR->proper_replace('{ENDPOINT_TYPE}', $tmp_endpoint_type, $tmp_final_out);

                    }

                }

                return $tmp_final_out;

            break;
            case 'ELECTRUM_DATA_SOURCE_TEXT':
            case 'ELECTRUM_DATA_SOURCE_HTML':

                foreach($this->queued_endpoint_ARRAY[$batch_serial]['SOURCE'] as $key_src => $hot_src_connection_ARRAY) {
                    $tmp_thumb_border_top_FLAG = false;
                    $tmp_thumb_border_top = 25;
                    $tmp_final_out .= $section_content_shell;
                    //error_log('3518 - '.$tmp_final_out);
                    $tmp_oEndpoint = $hot_src_connection_ARRAY['FIREHOT_oEndpoint'];

                    if(!is_object($hot_src_connection_ARRAY['oLightning_ftp_conn'])) {

                        //
                        // DIRECTORY SOURCE
                        $tmp_endpoint_type = 'Local Directory';
                        $tmp_src_DIR_PATH = $tmp_oEndpoint->return_LOCAL_DIR_PATH();

                        if (!is_dir($tmp_src_DIR_PATH)) {

                            $local_oWCR_key = $tmp_oEndpoint->return_local_oWCR_key();
                            $tmp_src_DIR_PATH = $this->oCRNRSTN_USR->get_resource('LOCAL_DIR_PATH', $local_oWCR_key);

                        }

                        $tmp_src_path_or_ip = $tmp_src_DIR_PATH;

                    }else{

                        //
                        // FTP SOURCE
                        $tmp_endpoint_type = 'FTP';
                        $tmp_src_FTP_SERVER = $tmp_oEndpoint->return_FTP_SERVER();
                        $tmp_src_FTP_PORT = $tmp_oEndpoint->return_FTP_PORT();
                        $tmp_src_DIR_PATH = $tmp_oEndpoint->return_FTP_DIR_PATH();
                        $tmp_src_path_or_ip = $tmp_src_FTP_SERVER.' at port '.$tmp_src_FTP_PORT;


                    }

                    $oEndpoint_serial = $tmp_oEndpoint->return_serial();

                    $tmp_output_fileSize_total = '';

                    if(!$this->endpoint_isValid_ARRAY[$oEndpoint_serial]) {

                        //
                        // CONNECTION ERROR - NO LISTING OF FILES ACQUIRED
                        $tmp_thumb = $this->return_quickGlanceThumb('error');
                        $tmp_thumb_TEXT = '** CONNECTION ERROR **';

                    }else{

                        $tmp_thumb = $this->return_quickGlanceThumb('success');
                        $tmp_thumb_TEXT = '** CONNECTION SUCCESS **';
                        $total_endpoint_file_count = sizeof($this->directory_content_ARRAY[$oEndpoint_serial]);

                        if(isset($this->directory_dir_content_ARRAY[$oEndpoint_serial])) {

                            $total_endpoint_DIR_count = sizeof($this->directory_dir_content_ARRAY[$oEndpoint_serial]);

                        }else{

                            $total_endpoint_DIR_count = 0;

                        }

                        $total_endpoint_file_count += $total_endpoint_DIR_count;

                        $total_endpoint_file_count = $this->oCRNRSTN_USR->number_format_keep_precision($total_endpoint_file_count);

                        $tmp_total_filesize = 0;
                        $tmp_null_filesize_cnt = 0;
                        foreach($this->source_file_size_at_path_ARRAY[$oEndpoint_serial] as $path => $filesize){

                            //$this->oCRNRSTN_USR->error_log('['.$path.']->'.$filesize, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_PROFILE');

                            if($filesize>0){

                                $tmp_total_filesize += (int) $filesize;

                            }else{

                                $tmp_null_filesize_cnt++;

                            }

                        }

                        $tmp_output_fileSize_total = $this->oCRNRSTN_USR->format_bytes($tmp_total_filesize, 5);

                    }

                    $tmp_output_fileSize_total_TEXT = $tmp_output_fileSize_total_HTML = $tmp_output_fileSize_total;

                    if($tmp_null_filesize_cnt>0){
                        $tmp_thumb_border_top_FLAG = true;
                        $tmp_thumb_border_top += 25;
                        if($tmp_null_filesize_cnt>1){

                            $tmp_output_fileSize_total_HTML = $tmp_output_fileSize_total . '<br><strong>(with ftp_size() err<br>on '.$tmp_null_filesize_cnt.' files)</strong>';
                            $tmp_output_fileSize_total_TEXT = $tmp_output_fileSize_total . '
(with ftp_size() err on '.$tmp_null_filesize_cnt.' files)';

                        }else{

                            $tmp_output_fileSize_total_HTML = $tmp_output_fileSize_total . '<br><strong>(with ftp_size() err<br>on '.$tmp_null_filesize_cnt.' file)</strong>';
                            $tmp_output_fileSize_total_TEXT = $tmp_output_fileSize_total . '
(with ftp_size() err on '.$tmp_null_filesize_cnt.' files)';

                        }
                    }

                    if($content_type=='ELECTRUM_DATA_SOURCE_HTML'){

                        $tmp_src_path_or_ip_HTML = $tmp_src_path_or_ip;

                        $tmp_str_ARRAY = $this->return_universalPathProperBreak($tmp_src_path_or_ip_HTML, 52, true);

                        $tmp_src_path_or_ip_HTML = $tmp_str_ARRAY['str'];

                        if(strlen($tmp_src_path_or_ip)>52){
                            $pos_fslash = strpos($tmp_src_path_or_ip, '/');

                            for($i=0; $i<$tmp_str_ARRAY['border_increment']; $i++){

                                if($tmp_thumb_border_top_FLAG){

                                    $tmp_thumb_border_top_FLAG = false;

                                }else{

                                    $tmp_thumb_border_top += 25;

                                }

                            }

                        }

                        $tmp_path_str_ARRAY = $this->return_universalPathProperBreak($tmp_src_DIR_PATH, 96, true);

                        /*
                        $tmp_path_str_ARRAY['str'] = $str;
                        $tmp_str_ARRAY['border_increment']
                        */

                        $tmp_final_out = $this->oCRNRSTN_USR->proper_replace('{THUMB_BORDER_TOP}', $tmp_thumb_border_top, $tmp_final_out);
                        $tmp_final_out = $this->oCRNRSTN_USR->proper_replace('{STATUS_THUMBNAIL_QUICKGLANCE}', $tmp_thumb, $tmp_final_out);
                        $tmp_final_out = $this->oCRNRSTN_USR->proper_replace('{ENDPOINT_PATH_OR_IP+PORT}', $tmp_src_path_or_ip_HTML, $tmp_final_out);
                        $tmp_final_out = $this->oCRNRSTN_USR->proper_replace('{FILES_TOTALING_SIZE}', $total_endpoint_file_count.' assets<br>totaling '.$tmp_output_fileSize_total_HTML, $tmp_final_out);
                        $tmp_final_out = $this->oCRNRSTN_USR->proper_replace('{ENDPOINT_PATH}', $tmp_path_str_ARRAY['str'], $tmp_final_out);
                        $tmp_final_out = $this->oCRNRSTN_USR->proper_replace('{ENDPOINT_TYPE}', $tmp_endpoint_type, $tmp_final_out);

                    }else{

                        $tmp_src_path_or_ip_TEXT = $tmp_src_path_or_ip;

                        $tmp_str_ARRAY = $this->return_universalPathProperBreak($tmp_src_path_or_ip_TEXT, 52);

                        $tmp_src_path_or_ip_TEXT = $tmp_str_ARRAY['str'];

                        $tmp_path_str_ARRAY = $this->return_universalPathProperBreak($tmp_src_DIR_PATH, 52);

                        //
                        // TEXT VERSION
                        $tmp_final_out = $this->oCRNRSTN_USR->proper_replace('{STATUS_THUMBNAIL_QUICKGLANCE}', $tmp_thumb_TEXT, $tmp_final_out);
                        $tmp_final_out = $this->oCRNRSTN_USR->proper_replace('{ENDPOINT_PATH_OR_IP+PORT}', $tmp_src_path_or_ip_TEXT, $tmp_final_out);
                        $tmp_final_out = $this->oCRNRSTN_USR->proper_replace('{FILES_TOTALING_SIZE}', $total_endpoint_file_count.' assets totaling '.$tmp_output_fileSize_total_TEXT, $tmp_final_out);
                        $tmp_final_out = $this->oCRNRSTN_USR->proper_replace('{ENDPOINT_PATH}', $tmp_path_str_ARRAY['str'], $tmp_final_out);
                        $tmp_final_out = $this->oCRNRSTN_USR->proper_replace('{ENDPOINT_TYPE}', $tmp_endpoint_type, $tmp_final_out);

                    }

                }

                return $tmp_final_out;

            break;
            default:

                return $section_content_shell;

            break;

        }

    }

    private function return_universalPathProperBreak($str, $maxlen=52, $isHTML=false, $isEmail=false, $messageType='ELECTRUM_PERFORMANCE'){

        $tmp_thumb_border_top_increment = 0;
        $tmp_out_ARRAY['str'] = $str;
        $tmp_out_ARRAY['border_increment'] = $tmp_thumb_border_top_increment;

        //
        // BREAK AT SPACE n CHAR CHUNK TO THE END
        $oChunkRestrictData = $this->oCRNRSTN_USR->chunkPageData($str, $maxlen);
        $tmp_array['chunked_content'] = $oChunkRestrictData->return_linesArray();

        if($isHTML){

            $tmp_out_str = '';
            $tmp_break_size = sizeof($tmp_array['chunked_content']);

            for($i=0;$i<$tmp_break_size;$i++){

                $tmp_thumb_border_top_increment++;

                $tmp_out_str .= $tmp_array['chunked_content'][$i].'<br>...';

            }

            $tmp_out_str = rtrim($tmp_out_str, '.');
            $tmp_out_str = rtrim($tmp_out_str, '<br>');

            if($isEmail){

                switch($messageType){
                    case 'ELECTRUM_PERFORMANCE':
                        $tmp_array = explode('<=', $tmp_out_str);

                        $tmp_out_str = '<span style="font-weight:bold; font-style:italic;">'.$tmp_array[0].'</span> <=';
                        $tmp_out_str .= $tmp_array[1];

                    break;

                }

            }

        }else{

            $tmp_out_str = '';
            $tmp_break_size = sizeof($tmp_array);

            for($i=0;$i<$tmp_break_size;$i++){

                $tmp_thumb_border_top_increment++;

                $tmp_out_str .= $tmp_array['chunked_content'][$i].'
...';

            }

            $tmp_out_str = rtrim($tmp_out_str, '.');
            $tmp_out_str = rtrim($tmp_out_str, '
');

        }

        $tmp_out_ARRAY['str'] = $tmp_out_str;
        $tmp_out_ARRAY['border_increment'] = $tmp_thumb_border_top_increment;

        $pos_fslash = strpos($str, '/');
        $pos_bslash = strpos($str, '\\');
        if($pos_fslash !== false){

            $breakChar = '/';

        }else{

            if($pos_bslash !== false){

                $breakChar = '\\';

            }else{

                $breakChar = DIRECTORY_SEPARATOR;

            }

        }

        $tmp_out_ARRAY['slashChar'] = $breakChar;

        return $tmp_out_ARRAY;

    }

    private function return_CRNRSTN_SysMsgContent($execution_serial, $batch_serial, $content_type = NULL, $msg_format = 'TEXT'){

        try{

            $msg_format = trim(strtoupper($msg_format));
            $content_type = trim(strtoupper($content_type));

            switch($content_type){
                case 'ELECTRUM_DATA_SOURCE_TEXT':
                case 'ELECTRUM_DATA_SOURCE_HTML':
                    $tmp_section_content_shell = '';

                    $tmp_section_content_shell .= $this->return_electrumDataSourceOutputShell($msg_format);

                    $tmp_section_content_shell = $this->loadElectrumData($execution_serial, $batch_serial, $content_type, $tmp_section_content_shell);

                    return $tmp_section_content_shell;

                break;
                case 'ELECTRUM_DATA_DESTINATION_TEXT':
                case 'ELECTRUM_DATA_DESTINATION_HTML':
                    $tmp_section_content_shell = '';

                    $tmp_section_content_shell .= $this->return_electrumDataDestinationOutputShell($msg_format);

                    $tmp_section_content_shell = $this->loadElectrumData($execution_serial, $batch_serial, $content_type, $tmp_section_content_shell);

                    return $tmp_section_content_shell;

                break;
                case 'ELECTRUM_DATA_HANDLING_PROFILE_TEXT':
                case 'ELECTRUM_DATA_HANDLING_PROFILE_HTML':

                    $tmp_section_content_shell = '';

                    $tmp_section_content_shell .= $this->return_electrumDataHandlingOutputShell($msg_format);

                    $tmp_section_content_shell = $this->loadElectrumData($execution_serial, $batch_serial, $content_type, $tmp_section_content_shell);

                    return $tmp_section_content_shell;

                break;
                case 'ELECTRUM_ERRORS_TRACE_TEXT':
                case 'ELECTRUM_ERRORS_TRACE_HTML':

                    return $this->return_electrumErrorsTrace($msg_format);

                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('An unknown system message content type "'.$content_type.'" ('.$msg_format.') has been requested.');

                break;

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.fileperms.php
    private function return_full_permissions($perms){

        //$perms = fileperms('/etc/passwd');

        switch ($perms & 0xF000) {
            case 0xC000: // socket
                $info = 's';
                break;
            case 0xA000: // symbolic link
                $info = 'l';
                break;
            case 0x8000: // regular
                $info = 'r';
                break;
            case 0x6000: // block special
                $info = 'b';
                break;
            case 0x4000: // directory
                $info = 'd';
                break;
            case 0x2000: // character special
                $info = 'c';
                break;
            case 0x1000: // FIFO pipe
                $info = 'p';
                break;
            default: // unknown
                $info = 'u';
        }

        // Owner
        $info .= (($perms & 0x0100) ? 'r' : '-');
        $info .= (($perms & 0x0080) ? 'w' : '-');
        $info .= (($perms & 0x0040) ?
            (($perms & 0x0800) ? 's' : 'x' ) :
            (($perms & 0x0800) ? 'S' : '-'));

        // Group
        $info .= (($perms & 0x0020) ? 'r' : '-');
        $info .= (($perms & 0x0010) ? 'w' : '-');
        $info .= (($perms & 0x0008) ?
            (($perms & 0x0400) ? 's' : 'x' ) :
            (($perms & 0x0400) ? 'S' : '-'));

        // World
        $info .= (($perms & 0x0004) ? 'r' : '-');
        $info .= (($perms & 0x0002) ? 'w' : '-');
        $info .= (($perms & 0x0001) ?
            (($perms & 0x0200) ? 't' : 'x' ) :
            (($perms & 0x0200) ? 'T' : '-'));

        return $info;

    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.filesize.php
    // AUTHOR :: C0nw0nk :: https://www.php.net/manual/en/function.filesize.php#119435
    private function find_filesize($file){

        if(substr(PHP_OS, 0, 3) == "WIN"){

            exec('for %I in ("'.$file.'") do @echo %~zI', $output);
            $return = $output[0];

        }else{

            $return = filesize($file);

            // SOURCE :: https://www.php.net/manual/en/function.filesize.php
            // AUTHOR :: synnus at gmail dot com :: https://www.php.net/manual/en/function.filesize.php#121437
            //$fsobj = new COM("Scripting.FileSystemObject");
            //$f = $fsobj->GetFile($file);
            //$return = $f->Size;

        }

        return $return;

    }

    public function terminate_all_ftp(){

        try{

            //
            // FTP - CLOSE
            if(isset(self::$oFourLivingCreatures_FTP->lightning_FTP_conn_ARRAY)){

                foreach(self::$oFourLivingCreatures_FTP->lightning_FTP_conn_ARRAY as $endpoint_id=>$oLightning_ftp_conn){

                    $this->oCRNRSTN_USR->error_log('Electrum FTP connection_status='.$oLightning_ftp_conn->connection_status, __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

                    if($oLightning_ftp_conn->connection_status != 'FTP connection successfully closed'){

                        $oFTP_stream_resource = $oLightning_ftp_conn->return_ftp_stream();
                        if(isset($oFTP_stream_resource)) {

                            if(ftp_close($oFTP_stream_resource)){

                                $oLightning_ftp_conn->log_connection_status('FTP connection successfully closed');

                            }else{

                                $oLightning_ftp_conn->log_connection_status('Error experienced closing FTP connection.');

                            }

                            self::$oFourLivingCreatures_FTP->lightning_FTP_conn_ARRAY[$endpoint_id] = $oLightning_ftp_conn;

                        }else{

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('oFTP_stream_resource is not set.');

                        }
                    }

                }

            }

            return NULL;

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    private function return_electrumDataHandlingSourceDIROutputShell($msg_format='TEXT'){

        switch($msg_format) {
            case 'HTML':

                $tmp_content = '<tr>
                                                    <td colspan="2" style="width:420px;">
                                                        <div style="border-left:15px solid #FFF; border-top:10px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; text-align:left;">{FILE_EXCLUSION_SOURCE_DIR_HTML}</div>
                                                    </td>
                                                    <td style="text-align:right; border-right:15px solid #FFF;">
                                                        <div style="border-left:15px solid #FFF; border-top:10px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; text-align:right; line-height: 23px;">{FILE_EXCLUSION_SOURCE_STATS_HTML}</div>
                                                    </td>
                                                </tr>';

                break;
            default:

                $tmp_content = '{FILE_EXCLUSION_SOURCE_DIR_TEXT}
{FILE_EXCLUSION_SOURCE_STATS_TEXT}';

                break;
        }

        return $tmp_content;

    }

    private function return_electrumDataHandlingOutputShell($msgFormat='TEXT'){

        switch($msgFormat){
            case 'HTML':

                $tmp_content = '<tr>
                                        <td>
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                <tr>
                                                    <td colspan="3" style="border-top: 2px solid #666;"><div style="font-family:Arial, Helvetica, sans-serif; font-size:10px; line-height: 3px; border-top: 0px solid #FFF; width:100%;"></div></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                        <div style="border-left:15px solid #F0F0F0; border-right: 15px solid #F0F0F0; border-top:10px solid #F0F0F0; border-bottom:10px solid #F0F0F0; background-color: #F0F0F0; font-family: Arial, Helvetica, sans-serif; font-size:16px; text-align:left; font-weight: bold;">{FILE_EXCLUSION_RULE_COPY}</div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" style="border-top: 1px dashed #F90000;"><div style="font-family:Arial, Helvetica, sans-serif; font-size:10px; line-height: 3px; border-top: 0px solid #FFF; width:100%;">&nbsp;</div></td>
                                                </tr>
                                                {FILE_EXCLUSION_SOURCE_DIR_SECTION_HTML}
                                            </table>
                                        </td>
                                    </tr>';

            break;
            default:

                $tmp_content = '= = = = = = = = = = = = = = = = = = = = = = = = =
{FILE_EXCLUSION_RULE_COPY}
{FILE_EXCLUSION_SOURCE_DIR_SECTION_TEXT}';

            break;

        }

        return $tmp_content;

    }

    private function return_electrumErrorsTrace($msgFormat='TEXT'){

        switch($msgFormat){
            case 'HTML':

                $tmp_content = '<tr>
                                        <td style="background-color: #3A3A3A;">
                                            <div style="border-left:15px solid #3A3A3A; border-top:15px solid #3A3A3A; border-bottom:15px solid #3A3A3A; color:#FFF; font-weight: bold; font-family: Arial, Helvetica, sans-serif; font-size:23px; text-align:left;">Electrum &ndash; Errors Experienced During Operation</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="border-left:15px solid #FFF; border-right: 15px solid #FFF; border-top:10px solid #FFF; border-bottom:10px solid #FFF; background-color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; text-align:left; font-weight: normal;">{ERR_TRACE}</div>
                                        </td>
                                    </tr>';

            break;
            default:

                $tmp_content = '= = = = = = = = = = = = = = = = = = = = = = = = =
Electrum - Errors Experienced During Operation

{ERR_TRACE}';

            break;

        }

        return $tmp_content;

    }

    private function return_electrumDataDestinationOutputShell($msg_format){

        switch($msg_format){
            case 'HTML':

                $tmp_content = '<tr>
                                        <td style="border-top:10px solid #FFF;">
                                            <table cellpadding="0" cellspacing="0" border="0" width="800" style="width:100%;">
                                                <tr>
                                                    <td valign="top" style="width:44px; vertical-align:center;">
                                                        <div style="vertical-align:center; border-left:15px solid #FFF; border-top:{THUMB_BORDER_TOP}px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; text-align:left;">{STATUS_THUMBNAIL_QUICKGLANCE}</div>
                                                    </td>
                                                    <td valign="top" style="border-left:10px solid #FFF; vertical-align:top;">

                                                        <table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
                                                            <tr>
                                                                <td style="width:140px;"><div style="border-top:12px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; line-height: 18px; text-align:left;">{ENDPOINT_TYPE} ::</div></td>
                                                                <td style="text-align: left;"><div style="border-top:14px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; line-height:22px; font-weight: bold; text-align:left;">{ENDPOINT_PATH_OR_IP+PORT}</div></td>
                                                                <td style="width:181px; text-align: right; border-right:15px solid #FFF;">{STATUS_COPY_QUICKGLANCE}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3" style="border-right: 15px solid #FFF;"><div style="font-family:Arial, Helvetica, sans-serif; font-size:10px; border-top: 3px solid #A7C2E6; width:100%;"></div></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3">
                                                                    <table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
                                                                    
                                                                        {ELECTRUM_DESTINATION_PATHS_DETAIL_HTML}
                                                                        
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>

                                                    </td>

                                                </tr>
                                            </table>
                                        </td>
                                    </tr>';


                break;
            default:

                $tmp_content = '= = = = = = = = = = = = = = = = = = = = = = = = =
{ENDPOINT_TYPE} :: {STATUS_THUMBNAIL_QUICKGLANCE}
{ENDPOINT_PATH_OR_IP+PORT}
{ELECTRUM_DESTINATION_PATHS_DETAIL_TEXT}
';

                break;

        }

        return $tmp_content;


    }

    private function return_electrumDataDestinationPathDetailsOutputShell($msg_format='TEXT'){

        switch($msg_format) {
            case 'HTML':

                $tmp_content = '<tr>
                                                                            <td><div style="border-top:12px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; line-height: 22px; text-align:left; font-weight: bold;">{ENDPOINT_FILES_MOVED_COUNT}</div></td>
                                                                            <td style="border-left:10px solid #FFF;"><div style="border-top:12px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; line-height: 22px; text-align:left;">{ENDPOINT_FILES_MOVED_PATH}</div></td>
                                                                        </tr>';

            break;
            default:

                $tmp_content = '{ENDPOINT_FILES_MOVED_COUNT}
{ENDPOINT_FILES_MOVED_PATH}';

            break;
        }

        return $tmp_content;
    }

    private function return_electrumDataSourceOutputShell($msg_format='TEXT'){

        switch($msg_format){
            case 'HTML':

                $tmp_content = '<tr>
                                    <td style="border-top:10px solid #FFF;">
                                        <table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
                                            <tr>
                                                <td valign="top" style="width:44px; vertical-align:center;">
                                                    <div style="vertical-align:center; border-left:15px solid #FFF; border-top:{THUMB_BORDER_TOP}px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; text-align:left;">{STATUS_THUMBNAIL_QUICKGLANCE}</div>
                                                </td>
                                                <td valign="top" style="border-left:10px solid #FFF; vertical-align:top;">
    
                                                    <table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
                                                        <tr>
                                                            <td style="width:140px;"><div style="border-top:12px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; line-height: 18px; text-align:left;">{ENDPOINT_TYPE} ::</div></td>
                                                            <td style="text-align: left;"><div style="border-top:14px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; line-height:22px; font-weight: bold; text-align:left;">{ENDPOINT_PATH_OR_IP+PORT}</div></td>
                                                            <td style="width:171px; text-align: right; border-right:15px solid #FFF;"><div style="border-top:12px solid #FFF; border-bottom:10px solid #FFF;font-family: Arial, Helvetica, sans-serif; font-size:16px; line-height: 23px; text-align:right;"><em>{FILES_TOTALING_SIZE}</em></div></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3" style="border-right: 15px solid #FFF;"><div style="font-family:Arial, Helvetica, sans-serif; font-size:10px; border-top: 3px solid #A7C2E6; width:100%;"></div></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3"><div style="border-top:12px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; line-height: 22px; text-align:left;">{ENDPOINT_PATH}</div></td>
                                                        </tr>
                                                    </table>
    
                                                </td>
    
                                            </tr>
                                        </table>
                                    </td>
                                </tr>';


            break;
            default:

                $tmp_content = '= = = = = = = = = = = = = = = = = = = = = = = = =
{STATUS_THUMBNAIL_QUICKGLANCE}
{ENDPOINT_PATH_OR_IP+PORT}
{ENDPOINT_PATH}
{FILES_TOTALING_SIZE}
';

            break;

        }

        return $tmp_content;

    }

    public function return_quickGlanceCopy($thumb_type){

        $thumb_type = trim(strtolower($thumb_type));

        switch($thumb_type){
            case 'success':

                $tmp_copy = '<div style="border-top:12px solid #FFF; border-bottom:10px solid #FFF; font-weight: bold; font-family: Arial, Helvetica, sans-serif; font-size:16px; line-height: 23px; text-align:right; color:#169514;">Connection Successful</div>';

            break;
            default:

                $tmp_copy = '<div style="border-top:12px solid #FFF; border-bottom:10px solid #FFF; font-weight: bold; font-family: Arial, Helvetica, sans-serif; font-size:16px; line-height: 23px; text-align:right; color:#D22E37;">Connection Error</div>';

            break;

        }

        return $tmp_copy;

    }

    public function return_quickGlanceThumb($thumb_type){

        $thumb_type = trim(strtolower($thumb_type));

        switch($thumb_type){
            case 'success':

                $tmp_thumb = $this->oCRNRSTN_USR->return_creative('SUCCESS_CHECK'); //<img src="http://v2.crnrstn.evifweb.com/common/imgs/email/success_chk.gif" width="19" height="19" alt="success" title="success">';

            break;
            default:

                $tmp_thumb = $this->oCRNRSTN_USR->return_creative('ERR_X'); //'<img src="http://v2.crnrstn.evifweb.com/common/imgs/email/err_x.gif" width="19" height="19" alt="error" title="error">';

            break;

        }

        return $tmp_thumb;

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

    public function __destruct() {

        $this->terminate_all_ftp();

    }

}

# # C # R # N # R # S # T # N # : : # # ##
#
#  CLASS :: crnrstn_electrum_the_statistician
#  VERSION :: 1.00.0000
#  DATE :: October 12, 2020 @ 1520hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: Brought in at the end...to keep things nice and tidy for the purpose of email reporting notifications.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#  Ezekiel 1:12 - AND EACH WENT STRAIGHT FORWARD; WHEREVER THE SPIRIT WAS TO GO, THEY WENT; THEY DID NOT TURN AS THEY WENT.
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

                    if ($this->timestamp_versioning_pattern != '') {

                        if (!($timestamp_nom = date($this->timestamp_versioning_pattern, time()))) {

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
