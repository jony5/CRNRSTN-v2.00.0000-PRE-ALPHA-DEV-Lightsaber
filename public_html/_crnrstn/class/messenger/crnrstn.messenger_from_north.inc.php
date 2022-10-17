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
#  CLASS :: crnrstn_messenger_from_north
#  VERSION :: 1.00.0000
#  DATE :: September 4, 2020 @ 2056hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI ::
#  DESCRIPTION :: A faithful messenger. What more could one desire?
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_messenger_from_north {

    protected $oLogger;
    private static $oCRNRSTN_n;

    private static $oCRNRSTN_PHPMailer_ARRAY = array();
    private static $oCRNRSTN_PROXYMailer_ARRAY = array();

    protected $PHPMailer_experience_tracker_ARRAY = array();
    protected $PHPMailer_single_or_bulk_ARRAY = array();
    protected $PROXYMailer_experience_tracker_ARRAY = array();
    protected $PROXYMailer_single_or_bulk_ARRAY = array();

    public $messenger_serial;
    protected $messenger_serial_raw;
    protected $mail_protocol;
    protected $username;
    protected $password;
    protected $port;

    protected $proxy_endpoint_uri;
    protected $proxy_endpoint_auth_key;
    protected $proxy_cipher_override;
    protected $proxy_secret_key_override;
    protected $proxy_hmac_algorithm_override;

    protected $mail_host_servers;

    protected $sender_email;
    protected $sender_name;
    protected $sender_Bulk = array();

    protected $priority = NULL;
    protected $priorityBulk = array();
    protected $word_wrap = 72;
    protected $word_wrapBulk = array();
    protected $is_HTML = false;
    protected $is_HTMLBulk = array();

    protected $subject_line = '';
    protected $subject_lineBulk = array();
    protected $html_message = NULL;
    protected $html_messageBulk = array();
    protected $text_message = NULL;
    protected $text_messageBulk = array();

    protected $dynamic_content_SUBJECT_ARRAY = array();
    protected $dynamic_content_HTML_ARRAY = array();
    protected $dynamic_content_TEXT_ARRAY = array();

    protected $suppress_duplicates = true;
    protected $replyto_email_ARRAY = array();
    protected $to_email_ARRAY = array();
    protected $cc_email_ARRAY = array();
    protected $bcc_email_ARRAY = array();
    protected $optout_suppression_ARRAY = array();
    protected $duplicate_suppression_ARRAY = array();

    protected $reporting_optout_suppression = array();
    protected $reporting_duplicate_suppression = array();
    protected $reporting_send_success = array();
    protected $reporting_send_error = array();

    protected $flag_PHPMailer_send_serial = array();

    public function __construct($messenger_serial, $mail_protocol, $username, $password, $port, $oCRNRSTN_n) {

        /*
        CONSIDERATIONS ::
        - SUPPORT FOR DATABASE DRIVEN MULTI-BATCH AND BLAST
            * SINGLE MESSAGE TO MANY EMAIL
            * MANY MESSAGES (I.E. DYNAMIC CONTENT) TO MANY EMAIL
            * MESSAGE PERSONALIZATION HOOKS
            * EMAIL DEDUPLICATION (FORCE UNIQUE) WITHIN SINGLE SENDING PROCESS RUN
            * STRAIGHT SEND TO ALL (NO DEDUPLICATION)
            * SERIALIZED PER RECIPIENT EMAIL FOR SEND SUCCESS/ERR FEEDBACK
        - SUPPORT FOR ONE-OFF-EMAIL MULTI-PART MESSAGE WITH ON-ERR-BACKUP TEXT ONLY
        - END GAME SUPPORT = UNIVERSAL PROXY ENDPOINT WITHIN CRNRSTN FOR MESSAGE TRIGGER VIA HTTP POST (OR SOAP REQUEST)
        */

        try{

            self::$oCRNRSTN_n = $oCRNRSTN_n;

            //
            // INSTANTIATE LOGGER
            $this->oLogger = new crnrstn_logging(__CLASS__, self::$oCRNRSTN_n);

            $this->messenger_serial_raw = $messenger_serial;
            $this->messenger_serial = self::$oCRNRSTN_n->crcINT($messenger_serial);

            $tmp_mail_protocol = trim(strtoupper($mail_protocol));

            switch($tmp_mail_protocol){
                case 'SMTP':
                case 'MAIL':
                case 'SENDMAIL':
                case 'QMAIL':

                    $this->mail_protocol = $tmp_mail_protocol;
                    $this->username = $username;
                    $this->password = $password;
                    $this->port = $port;

                    break;
                case 'CRNRSTN_PROXY':
                    //
                    //

                    break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Unknown mail protocol of "' . $mail_protocol . '" has been provided. The options which are available include "SMTP", "MAIL", "SENDMAIL" and "QMAIL".');

                    break;

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }
    }

    public function return_CRNRSTN_SysMsgBody($msgFormat='TEXT', $msgType='EXCEPTION_NOTIFICATION'){

        $tmp_format = trim(strtoupper($msgFormat));

        switch($tmp_format){
            case 'HTML':

                return $this->return_CRNRSTN_SysMsgHTMLBody($msgType);

            break;
            default:

                return $this->return_CRNRSTN_SysMsgTEXTBody($msgType);

            break;

        }

    }

    public function addHostServers($mail_host_servers){

        $this->mail_host_servers = $mail_host_servers;

    }

    public function addReplyTo($reply_to_email, $reply_to_recipient_name){

        try {

            //
            // CHECK FOR COMMA DELIMITED
            $pos_comma_email = stripos($reply_to_email, ",");
            $pos_comma_name = stripos($reply_to_recipient_name, ",");

            if($pos_comma_email !== false){
                //
                // WE HAVE COMMA DELIM EMAIL
                $tmp_email_ARRAY = explode(',', $reply_to_email);

                if($pos_comma_name !== false) {

                    //
                    // WE HAVE COMMA DELIM NAME
                    $tmp_name_ARRAY = explode(',', $reply_to_recipient_name);

                    $tmp_name_cnt = sizeof($tmp_name_ARRAY);
                    $tmp_email_cnt = sizeof($tmp_email_ARRAY);

                    if($tmp_name_cnt != $tmp_email_cnt){

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('There is a mismatch between the number of comma delimited recipient email addresses [' . $tmp_email_cnt.' provided CC emails] and the number of associated recipient names [' . $tmp_name_cnt.' provided CC names].');

                    }else{

                        for($i=0; $i<$tmp_email_cnt; $i++){

                            $this->replyto_email_ARRAY['name'][] = trim($tmp_name_ARRAY[$i]);

                            //
                            // FOR REPORTING
                            $this->replyto_email_ARRAY['email'][] = trim($tmp_email_ARRAY[$i]);

                            //
                            // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                            $this->replyto_email_ARRAY['sys_email'][] = $this->clean_system_email($tmp_email_ARRAY[$i]);

                        }

                    }

                }else{

                    $tmp_email_cnt = sizeof($tmp_email_ARRAY);

                    for($i=0; $i<$tmp_email_cnt; $i++){

                        $this->replyto_email_ARRAY['name'][] = trim($reply_to_recipient_name);

                        //
                        // FOR REPORTING
                        $this->replyto_email_ARRAY['email'][] = trim($tmp_email_ARRAY[$i]);

                        //
                        // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                        $this->replyto_email_ARRAY['sys_email'][] = $this->clean_system_email($tmp_email_ARRAY[$i]);

                    }

                }

            }else{

                $this->replyto_email_ARRAY['name'][] = trim($reply_to_recipient_name);

                //
                // FOR REPORTING
                $this->replyto_email_ARRAY['email'][] = trim($reply_to_email);

                //
                // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                $this->replyto_email_ARRAY['sys_email'][] = $this->clean_system_email($reply_to_email);

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function addFrom($sender_email, $sender_name){

        $sender_email = $this->clean_system_email($sender_email);

        $this->sender_email = $sender_email;
        $this->sender_name = $sender_name;

    }

    public function wordWrap($max_char_column_cnt){

        $this->word_wrap = $max_char_column_cnt;

    }

    public function isHTML($bool_isHTML){

        $this->is_HTML = $bool_isHTML;

    }

    public function setPriority($priority){

        try{

            $tmp_priority = trim(strtoupper($priority));

            switch($tmp_priority){
                case '1':
                case 1:
                case 'HIGH':
                    $this->priority = 1;
                    break;
                case '3':
                case 3:
                case 'NORMAL':
                    $this->priority = 3;
                    break;
                case '5':
                case 5:
                case 'LOW':
                    $this->priority = 5;
                    break;
                default:

                    $this->priority = 3;

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('The provided priority level of "' . $priority.'" is invalid; NORMAL priority has been applied. Options include, "HIGH" or (int) 1, "NORMAL" or (int) 3 and "LOW" or (int) 5.');

                    break;

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function addSubject($subject_line){

        $this->subject_line = $subject_line;

    }

    public function addMsgBody_HTMLversion($html_message){

        $this->html_message = $html_message;

    }

    public function addMsgBody_TEXTversion($text_message){

        $this->text_message = $text_message;

    }

    public function suppressEmailDuplicates($bool_suppress_dups){

        $this->suppress_duplicates = $bool_suppress_dups;

    }

    public function optOutDoNotSendEmail($optout_emails){

        $this->optout_suppression_ARRAY = $this->clean_system_email_comma_delimited($optout_emails, true, false);

    }

    public function addAddress($recipient_email, $recipient_name){

        $email_experience_tracker = self::$oCRNRSTN_n->generate_new_key(70);

        try {

            //
            // CHECK FOR COMMA DELIMITED
            $pos_comma_email = stripos($recipient_email, ",");
            $pos_comma_name = stripos($recipient_name, ",");

            if($pos_comma_email !== false){

                //
                // WE HAVE COMMA DELIM EMAIL
                $tmp_email_ARRAY = explode(',', $recipient_email);

                if($pos_comma_name !== false) {

                    //
                    // WE HAVE COMMA DELIM NAME
                    $tmp_name_ARRAY = explode(',', $recipient_name);

                    $tmp_name_cnt = sizeof($tmp_name_ARRAY);
                    $tmp_email_cnt = sizeof($tmp_email_ARRAY);

                    if($tmp_name_cnt != $tmp_email_cnt){

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('There is a mismatch between the number of comma delimited recipient email addresses [' . $tmp_email_cnt.' provided emails] and the number of associated recipient names [' . $tmp_name_cnt.' provided names].');

                    }else{

                        for($i=0; $i<$tmp_email_cnt; $i++){

                            $this->to_email_ARRAY['experience_tracker'][] = $email_experience_tracker;
                            $this->to_email_ARRAY['experience_tracker_flag'][$email_experience_tracker] = 1;

                            $this->to_email_ARRAY['name'][] = trim($tmp_name_ARRAY[$i]);

                            //
                            // FOR REPORTING
                            $this->to_email_ARRAY['email'][] = trim($tmp_email_ARRAY[$i]);

                            //
                            // FOR CRNRSTN SUPPRESSION FILTER
                            $this->to_email_ARRAY['sys_email'][] = $this->clean_system_email($tmp_email_ARRAY[$i]);

                        }

                    }

                }else{

                    $tmp_email_cnt = sizeof($tmp_email_ARRAY);

                    for($i=0; $i<$tmp_email_cnt; $i++){

                        $this->to_email_ARRAY['experience_tracker'][] = $email_experience_tracker;
                        $this->to_email_ARRAY['experience_tracker_flag'][$email_experience_tracker] = 1;

                        $this->to_email_ARRAY['name'][] = trim($recipient_name);

                        //
                        // FOR REPORTING
                        $this->to_email_ARRAY['email'][] = trim($tmp_email_ARRAY[$i]);

                        //
                        // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                        $this->to_email_ARRAY['sys_email'][] = $this->clean_system_email($tmp_email_ARRAY[$i]);

                    }

                }

            }else{

                $this->to_email_ARRAY['experience_tracker'][] = $email_experience_tracker;
                $this->to_email_ARRAY['experience_tracker_flag'][$email_experience_tracker] = 1;

                $this->to_email_ARRAY['name'][] = trim($recipient_name);

                //
                // FOR REPORTING
                $this->to_email_ARRAY['email'][] = trim($recipient_email);

                //
                // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                $this->to_email_ARRAY['sys_email'][] = $this->clean_system_email($recipient_email);

            }

            return $email_experience_tracker;

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function addCC($recipient_email, $recipient_name){

        try {

            //
            // CHECK FOR COMMA DELIMITED
            $pos_comma_email = stripos($recipient_email, ",");
            $pos_comma_name = stripos($recipient_name, ",");

            if($pos_comma_email !== false){
                //
                // WE HAVE COMMA DELIM EMAIL
                $tmp_email_ARRAY = explode(',', $recipient_email);

                if($pos_comma_name !== false) {

                    //
                    // WE HAVE COMMA DELIM NAME
                    $tmp_name_ARRAY = explode(',', $recipient_name);

                    $tmp_name_cnt = sizeof($tmp_name_ARRAY);
                    $tmp_email_cnt = sizeof($tmp_email_ARRAY);

                    if($tmp_name_cnt != $tmp_email_cnt){

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('There is a mismatch between the number of comma delimited recipient email addresses [' . $tmp_email_cnt.' provided CC emails] and the number of associated recipient names [' . $tmp_name_cnt.' provided CC names].');

                    }else{

                        for($i=0; $i<$tmp_email_cnt; $i++){

                            $this->cc_email_ARRAY['name'][] = trim($tmp_name_ARRAY[$i]);

                            //
                            // FOR REPORTING
                            $this->cc_email_ARRAY['email'][] = trim($tmp_email_ARRAY[$i]);

                            //
                            // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                            $this->cc_email_ARRAY['sys_email'][] = $this->clean_system_email($tmp_email_ARRAY[$i]);

                        }

                    }

                }else{

                    $tmp_email_cnt = sizeof($tmp_email_ARRAY);

                    for($i=0; $i<$tmp_email_cnt; $i++){

                        $this->cc_email_ARRAY['name'][] = trim($recipient_name);

                        //
                        // FOR REPORTING
                        $this->cc_email_ARRAY['email'][] = trim($tmp_email_ARRAY[$i]);

                        //
                        // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                        $this->cc_email_ARRAY['sys_email'][] = $this->clean_system_email($tmp_email_ARRAY[$i]);

                    }

                }

            }else{

                $this->cc_email_ARRAY['name'][] = trim($recipient_name);

                //
                // FOR REPORTING
                $this->cc_email_ARRAY['email'][] = trim($recipient_email);

                //
                // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                $this->cc_email_ARRAY['sys_email'][] = $this->clean_system_email($recipient_email);

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function addBCC($recipient_email, $recipient_name){

        try {

            //
            // CHECK FOR COMMA DELIMITED
            $pos_comma_email = stripos($recipient_email, ",");
            $pos_comma_name = stripos($recipient_name, ",");

            if($pos_comma_email !== false){

                //
                // WE HAVE COMMA DELIM EMAIL
                $tmp_email_ARRAY = explode(',', $recipient_email);

                if($pos_comma_name !== false) {

                    //
                    // WE HAVE COMMA DELIM NAME
                    $tmp_name_ARRAY = explode(',', $recipient_name);

                    $tmp_name_cnt = sizeof($tmp_name_ARRAY);
                    $tmp_email_cnt = sizeof($tmp_email_ARRAY);

                    if($tmp_name_cnt != $tmp_email_cnt){

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('There is a mismatch between the number of comma delimited recipient email addresses [' . $tmp_email_cnt.' provided BCC emails] and the number of associated recipient names [' . $tmp_name_cnt.' provided BCC names].');

                    }else{

                        for($i=0; $i<$tmp_email_cnt; $i++){

                            $this->bcc_email_ARRAY['name'][] = trim($tmp_name_ARRAY[$i]);

                            //
                            // FOR REPORTING
                            $this->bcc_email_ARRAY['email'][] = trim($tmp_email_ARRAY[$i]);

                            //
                            // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                            $this->bcc_email_ARRAY['sys_email'][] = $this->clean_system_email($tmp_email_ARRAY[$i]);

                        }

                    }

                }else{

                    $tmp_email_cnt = sizeof($tmp_email_ARRAY);

                    for($i=0; $i<$tmp_email_cnt; $i++){

                        $this->bcc_email_ARRAY['name'][] = trim($recipient_name);

                        //
                        // FOR REPORTING
                        $this->bcc_email_ARRAY['email'][] = trim($tmp_email_ARRAY[$i]);

                        //
                        // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                        $this->bcc_email_ARRAY['sys_email'][] = $this->clean_system_email($tmp_email_ARRAY[$i]);

                    }

                }

            }else{

                $this->bcc_email_ARRAY['name'][] = trim($recipient_name);

                //
                // FOR REPORTING
                $this->bcc_email_ARRAY['email'][] = trim($recipient_email);

                //
                // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                $this->bcc_email_ARRAY['sys_email'][] = $this->clean_system_email($recipient_email);

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function addDynamicContent_SUBJECT($email_experience_tracker, $content_place_holder, $dynamic_content){

        try{

            if(isset($this->to_email_ARRAY['experience_tracker_flag'][$email_experience_tracker])){

                $this->dynamic_content_SUBJECT_ARRAY[$email_experience_tracker]['placeholder'][] = $content_place_holder;
                $this->dynamic_content_SUBJECT_ARRAY[$email_experience_tracker]['content'][] = $dynamic_content;

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to locate any email assigned to Gabriel (out of the '.sizeof($this->to_email_ARRAY['sys_email']).' email addresses in his possession) for the application of this dynamic HTML experience. ');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function addDynamicContent_HTML($email_experience_tracker, $content_place_holder, $dynamic_content){

        try{

            if(isset($this->to_email_ARRAY['experience_tracker_flag'][$email_experience_tracker])){

                $this->dynamic_content_HTML_ARRAY[$email_experience_tracker]['placeholder'][] = $content_place_holder;
                $this->dynamic_content_HTML_ARRAY[$email_experience_tracker]['content'][] = $dynamic_content;

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to locate any email assigned to Gabriel (out of the '.sizeof($this->to_email_ARRAY['sys_email']).' email addresses in his possession) for the application of this dynamic HTML experience.');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function addDynamicContent_TEXT($email_experience_tracker, $content_place_holder, $dynamic_content){

        try{

            if(isset($this->to_email_ARRAY['experience_tracker_flag'][$email_experience_tracker])){

                $this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['placeholder'][] = $content_place_holder;
                $this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['content'][] = $dynamic_content;

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to locate any email assigned to Gabriel (out of the '.sizeof($this->to_email_ARRAY['sys_email']).' email addresses in his possession) for the application of this dynamic TEXT experience.');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function addDynamicContent_MULTIPART($email_experience_tracker, $content_place_holder, $dynamic_content){

        try{

            if(isset($this->to_email_ARRAY['experience_tracker_flag'][$email_experience_tracker])){

                $this->dynamic_content_HTML_ARRAY[$email_experience_tracker]['placeholder'][] = $content_place_holder;
                $this->dynamic_content_HTML_ARRAY[$email_experience_tracker]['content'][] = $dynamic_content;
                $this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['placeholder'][] = $content_place_holder;
                $this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['content'][] = $dynamic_content;

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to locate any email assigned to Gabriel (out of the '.sizeof($this->to_email_ARRAY['sys_email']).' email addresses in his possession) for the application of this dynamic MULTIPART experience.');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function isHTMLBulk($email_experience_tracker, $bool_isHTML){

        try{

            if(isset($this->to_email_ARRAY['experience_tracker_flag'][$email_experience_tracker])){

                $this->is_HTMLBulk[$email_experience_tracker] = $bool_isHTML;

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to locate any email assigned to Gabriel (out of the '.sizeof($this->to_email_ARRAY['sys_email']).' email addresses in his possession) for the application of this boolean flag for isHTML experience.');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;
        }

        return true;

    }

    public function setPriorityBulk($email_experience_tracker, $priority){

        try{

            if(isset($this->to_email_ARRAY['experience_tracker_flag'][$email_experience_tracker])){

                $tmp_priority = trim(strtoupper($priority));

                switch($tmp_priority){
                    case 1:
                    case 'HIGH':
                        $this->priorityBulk[$email_experience_tracker] = 1;
                        break;
                    case 3:
                    case 'NORMAL':
                        $this->priorityBulk[$email_experience_tracker] = 3;
                        break;
                    case 5:
                    case 'LOW':
                        $this->priorityBulk[$email_experience_tracker] = 5;
                        break;
                    default:

                        $this->priorityBulk[$email_experience_tracker] = 3;

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('The provided priority level of "' . $priority.'" is invalid; NORMAL priority has been applied for this recipient experience. Options include, "HIGH" or 1, "NORMAL" or 3 and "LOW" or 5.');

                        break;

                }

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to locate any email assigned to Gabriel (out of the '.sizeof($this->to_email_ARRAY['sys_email']).' email addresses in his possession) for the application of the "' . $priority.'" priority flag for this email experience.');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function addFromBulk($email_experience_tracker, $sender_email, $sender_name){

        try{

            if(isset($this->to_email_ARRAY['experience_tracker_flag'][$email_experience_tracker])){

                $this->sender_Bulk[$email_experience_tracker]['email'] = $sender_email;
                $this->sender_Bulk[$email_experience_tracker]['name'] = $sender_name;

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to locate any email assigned to Gabriel (out of the '.sizeof($this->to_email_ARRAY['sys_email']).' email addresses in his possession) for the application of this sender email/"from" email experience.');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        return true;

    }

    public function addAddressBulk($email_experience_tracker, $recipient_email, $recipient_name){

        try {

            //
            // CHECK FOR COMMA DELIMITED
            $pos_comma_email = stripos($recipient_email, ",");
            $pos_comma_name = stripos($recipient_name, ",");

            if($pos_comma_email !== false){

                //
                // WE HAVE COMMA DELIM EMAIL
                $tmp_email_ARRAY = explode(',', $recipient_email);

                if($pos_comma_name !== false) {

                    //
                    // WE HAVE COMMA DELIM NAME
                    $tmp_name_ARRAY = explode(',', $recipient_name);

                    $tmp_name_cnt = sizeof($tmp_name_ARRAY);
                    $tmp_email_cnt = sizeof($tmp_email_ARRAY);

                    if($tmp_name_cnt != $tmp_email_cnt){

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('There is a mismatch between the number of comma delimited recipient email addresses [' . $tmp_email_cnt.' provided emails] and the number of associated recipient names [' . $tmp_name_cnt.' provided names].');

                    }else{

                        for($i=0; $i<$tmp_email_cnt; $i++){

                            $this->to_email_ARRAY['experience_tracker'][] = $email_experience_tracker;
                            $this->to_email_ARRAY['experience_tracker_flag'][$email_experience_tracker] = 1;

                            $this->to_email_ARRAY[$email_experience_tracker]['name'][] = trim($tmp_name_ARRAY[$i]);

                            //
                            // FOR REPORTING
                            $this->to_email_ARRAY[$email_experience_tracker]['email'][] = trim($tmp_email_ARRAY[$i]);

                            //
                            // FOR CRNRSTN SUPPRESSION FILTER
                            $this->to_email_ARRAY[$email_experience_tracker]['sys_email'][] = $this->clean_system_email($tmp_email_ARRAY[$i]);

                        }

                    }

                }else{

                    $tmp_email_cnt = sizeof($tmp_email_ARRAY);

                    for($i=0; $i<$tmp_email_cnt; $i++){

                        $this->to_email_ARRAY['experience_tracker'][] = $email_experience_tracker;
                        $this->to_email_ARRAY['experience_tracker_flag'][$email_experience_tracker] = 1;

                        $this->to_email_ARRAY[$email_experience_tracker]['name'][] = trim($recipient_name);

                        //
                        // FOR REPORTING
                        $this->to_email_ARRAY[$email_experience_tracker]['email'][] = trim($tmp_email_ARRAY[$i]);

                        //
                        // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                        $this->to_email_ARRAY[$email_experience_tracker]['sys_email'][] = $this->clean_system_email($tmp_email_ARRAY[$i]);

                    }

                }

            }else{

                $this->to_email_ARRAY['experience_tracker'][] = $email_experience_tracker;
                $this->to_email_ARRAY['experience_tracker_flag'][$email_experience_tracker] = 1;

                $this->to_email_ARRAY[$email_experience_tracker]['name'][] = trim($recipient_name);

                //
                // FOR REPORTING
                $this->to_email_ARRAY[$email_experience_tracker]['email'][] = trim($recipient_email);

                //
                // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                $this->to_email_ARRAY[$email_experience_tracker]['sys_email'][] = $this->clean_system_email($recipient_email);
                self::$oCRNRSTN_n->error_log('Adding BULK email '.self::$oCRNRSTN_n->string_sanitize($recipient_email, 'email_private').' to to_email_ARRAY['.substr($email_experience_tracker, 0, 5).'...][ ].', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }
    }

    public function addCCBulk($email_experience_tracker,$recipient_email, $recipient_name){

        try {

            //
            // CHECK FOR COMMA DELIMITED
            $pos_comma_email = stripos($recipient_email, ",");
            $pos_comma_name = stripos($recipient_name, ",");

            if($pos_comma_email !== false){
                //
                // WE HAVE COMMA DELIM EMAIL
                $tmp_email_ARRAY = explode(',', $recipient_email);

                if($pos_comma_name !== false) {

                    //
                    // WE HAVE COMMA DELIM NAME
                    $tmp_name_ARRAY = explode(',', $recipient_name);

                    $tmp_name_cnt = sizeof($tmp_name_ARRAY);
                    $tmp_email_cnt = sizeof($tmp_email_ARRAY);

                    if($tmp_name_cnt != $tmp_email_cnt){

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('There is a mismatch between the number of comma delimited recipient email addresses [' . $tmp_email_cnt.' provided CC emails] and the number of associated recipient names [' . $tmp_name_cnt.' provided CC names].');

                    }else{

                        for($i=0; $i<$tmp_email_cnt; $i++){

                            $this->cc_email_ARRAY[$email_experience_tracker]['name'][] = trim($tmp_name_ARRAY[$i]);

                            //
                            // FOR REPORTING
                            $this->cc_email_ARRAY[$email_experience_tracker]['email'][] = trim($tmp_email_ARRAY[$i]);

                            //
                            // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                            $this->cc_email_ARRAY[$email_experience_tracker]['sys_email'][] = $this->clean_system_email($tmp_email_ARRAY[$i]);

                        }

                    }

                }else{

                    $tmp_email_cnt = sizeof($tmp_email_ARRAY);

                    for($i=0; $i<$tmp_email_cnt; $i++){

                        $this->cc_email_ARRAY[$email_experience_tracker]['name'][] = trim($recipient_name);

                        //
                        // FOR REPORTING
                        $this->cc_email_ARRAY[$email_experience_tracker]['email'][] = trim($tmp_email_ARRAY[$i]);

                        //
                        // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                        $this->cc_email_ARRAY[$email_experience_tracker]['sys_email'][] = $this->clean_system_email($tmp_email_ARRAY[$i]);

                    }

                }

            }else{

                $this->cc_email_ARRAY[$email_experience_tracker]['name'][] = trim($recipient_name);

                //
                // FOR REPORTING
                $this->cc_email_ARRAY[$email_experience_tracker]['email'][] = trim($recipient_email);

                //
                // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                $this->cc_email_ARRAY[$email_experience_tracker]['sys_email'][] = $this->clean_system_email($recipient_email);

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function addBCCBulk($email_experience_tracker, $recipient_email, $recipient_name){

        try {

            //
            // CHECK FOR COMMA DELIMITED
            $pos_comma_email = stripos($recipient_email, ",");
            $pos_comma_name = stripos($recipient_name, ",");

            if($pos_comma_email !== false){

                //
                // WE HAVE COMMA DELIM EMAIL
                $tmp_email_ARRAY = explode(',', $recipient_email);

                if($pos_comma_name !== false) {

                    //
                    // WE HAVE COMMA DELIM NAME
                    $tmp_name_ARRAY = explode(',', $recipient_name);

                    $tmp_name_cnt = sizeof($tmp_name_ARRAY);
                    $tmp_email_cnt = sizeof($tmp_email_ARRAY);

                    if($tmp_name_cnt != $tmp_email_cnt){

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('There is a mismatch between the number of comma delimited recipient email addresses [' . $tmp_email_cnt.' provided BCC emails] and the number of associated recipient names [' . $tmp_name_cnt.' provided BCC names].');

                    }else{

                        for($i=0; $i<$tmp_email_cnt; $i++){

                            $this->bcc_email_ARRAY[$email_experience_tracker]['name'][] = trim($tmp_name_ARRAY[$i]);

                            //
                            // FOR REPORTING
                            $this->bcc_email_ARRAY[$email_experience_tracker]['email'][] = trim($tmp_email_ARRAY[$i]);

                            //
                            // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                            $this->bcc_email_ARRAY[$email_experience_tracker]['sys_email'][] = $this->clean_system_email($tmp_email_ARRAY[$i]);

                        }

                    }

                }else{

                    $tmp_email_cnt = sizeof($tmp_email_ARRAY);

                    for($i=0; $i<$tmp_email_cnt; $i++){

                        $this->bcc_email_ARRAY[$email_experience_tracker]['name'][] = trim($recipient_name);

                        //
                        // FOR REPORTING
                        $this->bcc_email_ARRAY[$email_experience_tracker]['email'][] = trim($tmp_email_ARRAY[$i]);

                        //
                        // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                        $this->bcc_email_ARRAY[$email_experience_tracker]['sys_email'][] = $this->clean_system_email($tmp_email_ARRAY[$i]);

                    }

                }

            }else{

                $this->bcc_email_ARRAY[$email_experience_tracker]['name'][] = trim($recipient_name);

                //
                // FOR REPORTING
                $this->bcc_email_ARRAY[$email_experience_tracker]['email'][] = trim($recipient_email);

                //
                // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                $this->bcc_email_ARRAY[$email_experience_tracker]['sys_email'][] = $this->clean_system_email($recipient_email);

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function wordWrapBulk($email_experience_tracker, $max_char_column_cnt){

        $this->word_wrapBulk[$email_experience_tracker] = $max_char_column_cnt;

    }

    public function addReplyToBulk($email_experience_tracker, $reply_to_email, $reply_to_recipient_name){

        try {

            if(isset($this->to_email_ARRAY['experience_tracker_flag'][$email_experience_tracker])){

                //
                // CHECK FOR COMMA DELIMITED
                $pos_comma_email = stripos($reply_to_email, ",");
                $pos_comma_name = stripos($reply_to_recipient_name, ",");

                if($pos_comma_email !== false){
                    //
                    // WE HAVE COMMA DELIM EMAIL
                    $tmp_email_ARRAY = explode(',', $reply_to_email);

                    if($pos_comma_name !== false) {

                        //
                        // WE HAVE COMMA DELIM NAME
                        $tmp_name_ARRAY = explode(',', $reply_to_recipient_name);

                        $tmp_name_cnt = sizeof($tmp_name_ARRAY);
                        $tmp_email_cnt = sizeof($tmp_email_ARRAY);

                        if($tmp_name_cnt != $tmp_email_cnt){

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('There is a mismatch between the number of comma delimited recipient email addresses [' . $tmp_email_cnt.' provided CC emails] and the number of associated recipient names [' . $tmp_name_cnt.' provided CC names].');

                        }else{

                            for($i=0; $i<$tmp_email_cnt; $i++){

                                $this->replyto_email_ARRAY[$email_experience_tracker]['name'][] = trim($tmp_name_ARRAY[$i]);

                                //
                                // FOR REPORTING
                                $this->replyto_email_ARRAY[$email_experience_tracker]['email'][] = trim($tmp_email_ARRAY[$i]);

                                //
                                // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                                $this->replyto_email_ARRAY[$email_experience_tracker]['sys_email'][] = $this->clean_system_email($tmp_email_ARRAY[$i]);

                            }

                        }

                    }else{

                        $tmp_email_cnt = sizeof($tmp_email_ARRAY);

                        for($i=0; $i<$tmp_email_cnt; $i++){

                            $this->replyto_email_ARRAY[$email_experience_tracker]['name'][] = trim($reply_to_recipient_name);

                            //
                            // FOR REPORTING
                            $this->replyto_email_ARRAY[$email_experience_tracker]['email'][] = trim($tmp_email_ARRAY[$i]);

                            //
                            // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                            $this->replyto_email_ARRAY[$email_experience_tracker]['sys_email'][] = $this->clean_system_email($tmp_email_ARRAY[$i]);

                        }

                    }

                }else{

                    $this->replyto_email_ARRAY[$email_experience_tracker]['name'][] = trim($reply_to_recipient_name);

                    //
                    // FOR REPORTING
                    $this->replyto_email_ARRAY[$email_experience_tracker]['email'][] = trim($reply_to_email);

                    //
                    // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                    $this->replyto_email_ARRAY[$email_experience_tracker]['sys_email'][] = $this->clean_system_email($reply_to_email);

                }

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to locate any email assigned to Gabriel (out of the '.sizeof($this->to_email_ARRAY['sys_email']).' email addresses in his possession) for the application of this replyTo email experience.');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function addSubjectBulk($email_experience_tracker, $subject_line){

        try{

            if(isset($this->to_email_ARRAY['experience_tracker_flag'][$email_experience_tracker])){

                $this->subject_lineBulk[$email_experience_tracker] = $subject_line;

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to locate any email assigned to Gabriel (out of the '.sizeof($this->to_email_ARRAY['sys_email']).' email addresses in his possession) for the application of a subject line for this email experience.');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;
        }

        return true;

    }

    public function addHTMLver_Bulk($email_experience_tracker, $html_message){

        try{

            if(isset($this->to_email_ARRAY['experience_tracker_flag'][$email_experience_tracker])){

                $this->html_messageBulk[$email_experience_tracker] = $html_message;

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to locate any email assigned to Gabriel (out of the '.sizeof($this->to_email_ARRAY['sys_email']).' email addresses in his possession) for the application of the HTML body for this email experience.');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        return true;

    }

    public function addTEXTver_Bulk($email_experience_tracker, $text_message){

        try{

            if(isset($this->to_email_ARRAY['experience_tracker_flag'][$email_experience_tracker])){

                $this->text_messageBulk[$email_experience_tracker] = $text_message;

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to locate any email assigned to Gabriel (out of the '.sizeof($this->to_email_ARRAY['sys_email']).' email addresses in his possession) for the application of the TEXT body for this email experience.');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;
        }

        return true;

    }

    public function batchReadyToSend($max_batch_count){

        if(sizeof($this->to_email_ARRAY) > $max_batch_count){

            return true;

        }else{

            return false;

        }

    }

    public function initProxySend($proxy_endpoint_uri, $proxy_auth_key){

        /*
            protected $proxy_endpoint_uri;
            protected $proxy_endpoint_auth_key;
            protected $proxy_cipher_override;
            protected $proxy_secret_key_override;
            protected $proxy_hmac_algorithm_override;
        */

        $this->proxy_endpoint_uri = $proxy_endpoint_uri;
        $this->proxy_endpoint_auth_key = $proxy_auth_key;


    }

    public function proxyEncrypt_setAlgorithmOverride($proxy_encrypt_hmac_algorithm){

        $this->proxy_hmac_algorithm_override = $proxy_encrypt_hmac_algorithm;

        return NULL;

    }

    public function proxyEncrypt_setSecretKeyOverride($proxy_secret_key){

        $this->proxy_secret_key_override = $proxy_secret_key;

        return NULL;

    }

    public function proxyEncrypt_setCipherOverride($proxy_cipher){

        $this->proxy_cipher_override = $proxy_cipher;

        return NULL;

    }

    public function proxySend(){

        try{

            $tmp_email_experience_cnt = sizeof($this->to_email_ARRAY['experience_tracker']);
            if($tmp_email_experience_cnt>0){

                //
                // MESSAGE ASSEMBLY
                $this->spool_proxy_message();

                //
                // MESSAGE DELIVERY
                $tmp_mailer_cnt = sizeof(self::$oCRNRSTN_PROXYMailer_ARRAY);
                for($i=0; $i<$tmp_mailer_cnt; $i++){
                    //error_log('1229 - proxySend[' . $tmp_mailer_cnt.'][' . $tmp_email_experience_cnt.']');

                    $oCRNRSTN_PROXYMailer = self::$oCRNRSTN_PROXYMailer_ARRAY[$i];
                    //self::$oCRNRSTN_n->error_log($i.' <--sending mailer in this position AltBody=->' . $oCRNRSTN_PHPMailer->AltBody, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                    //
                    // CONSIDER ADDING SOME KIND OF THROTTLING??
                    $tmp_send_auth = self::$oCRNRSTN_n->get_resource('EMAIL_SEND_ACTIVE');
                    $tmp_ip_auth = self::$oCRNRSTN_n->exclusiveAccess('73.54.221.217');
                    if($tmp_send_auth){

                        self::$oCRNRSTN_n->error_log('seeennd it! [PROXY] [EMAIL QUEUE POS #' . $i.']['.sizeof(self::$oCRNRSTN_PROXYMailer_ARRAY).']', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                        $proxy_response = $oCRNRSTN_PROXYMailer->send($this->proxy_endpoint_uri, $this->proxy_endpoint_auth_key, $this->proxy_cipher_override, $this->proxy_secret_key_override, $this->proxy_hmac_algorithm_override);
                        error_log('1235 - PROXY RESPONSE=' . $proxy_response);
                    }
                }
            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        return true;

    }

    public function send(){

        try{

            $tmp_email_experience_cnt = sizeof($this->to_email_ARRAY['experience_tracker']);
            if($tmp_email_experience_cnt>0){

                //
                // MESSAGE ASSEMBLY
                $this->spool_message();

                //
                // MESSAGE DELIVERY
                $tmp_mailer_cnt = sizeof(self::$oCRNRSTN_PHPMailer_ARRAY);

                self::$oCRNRSTN_n->error_log($tmp_mailer_cnt.' <--How many mailer to send after spooling??', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                $tmp_send_result_ARRAY = array();

                for($i=0; $i<$tmp_mailer_cnt; $i++){
                    //error_log('1158 - send(' . $i.') = oCRNRSTN_PHPMailer_ARRAY[' . $i.']');
                    $oCRNRSTN_PHPMailer = self::$oCRNRSTN_PHPMailer_ARRAY[$i];
                    //self::$oCRNRSTN_n->error_log($i.' <--sending mailer in this position AltBody=->' . $oCRNRSTN_PHPMailer->AltBody, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                    //
                    // CONSIDER ADDING SOME KIND OF THROTTLING??
                    $tmp_send_auth = self::$oCRNRSTN_n->get_resource('EMAIL_SEND_ACTIVE');
                    $tmp_ip_auth = self::$oCRNRSTN_n->exclusiveAccess('73.54.221.217');
                    if($tmp_send_auth){

                        self::$oCRNRSTN_n->error_log('seeennd it! [EMAIL QUEUE POS #' . $i.']['.sizeof(self::$oCRNRSTN_PHPMailer_ARRAY).']', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                        $tmp_send_result_ARRAY['is_success'][] = $oCRNRSTN_PHPMailer->send();
                        $tmp_send_result_ARRAY['status_msg'][] = $oCRNRSTN_PHPMailer->ErrorInfo;

                    }
                }

                //
                // CLEAR oCRNRSTN_PHPMailer_ARRAY ARRAY
                array_splice(self::$oCRNRSTN_PHPMailer_ARRAY, 0);

                return $tmp_send_result_ARRAY;

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        return true;

    }

    private function spool_proxy_message(){

        try{

            //
            // SENDER AND RECIPIENT DATA (TO, CC, BCC, REPLYTO, FROM)
            $this->initialize_proxy_sender_recipient();

            //
            // MESSAGE DETAIL (HTML, TEXT, WRAP, ISHTML, SUBJECT)
            $this->initialize_proxy_message_content();


        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

        return false;


    }

    private function spool_message(){

        try{

            //
            // SENDER AND RECIPIENT DATA (TO, CC, BCC, REPLYTO, FROM)
            $this->initialize_sender_recipient();

            //
            // CONNECTIVITY (SMTP, SENDMAIL, QMAIL, PHPMAIL, SERVER, PORT, USERNAME, PASSWORD)
            $this->initialize_connectivity();

            //
            // MESSAGE DETAIL (HTML, TEXT, WRAP, ISHTML, SUBJECT)
            $this->initialize_message_content();


        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

        return false;

    }

    private function initialize_proxy_sender_recipient(){

        $tmp_to_email_cnt = 0;
        $tmp_experience_tracker_cnt = 0;
        $tmp_replyto_email_cnt = 0;
        $tmp_cc_email_cnt = 0;
        $tmp_bcc_email_cnt = 0;
        $tmp_to_email_bulk_cnt = 0;
        $tmp_replyto_email_bulk_cnt = 0;
        $tmp_cc_email_bulk_cnt = 0;
        $tmp_bcc_email_bulk_cnt = 0;
        $tmp_from_email_bulk_cnt = 0;

        //
        // PROCESS ANY SINGLE SERVING EMAIL
        if(isset($this->to_email_ARRAY['sys_email'])){

            $tmp_to_email_cnt = sizeof($this->to_email_ARRAY['sys_email']);

        }

        if(isset($this->cc_email_ARRAY['sys_email'])){

            $tmp_cc_email_cnt = sizeof($this->cc_email_ARRAY['sys_email']);

        }

        if(isset($this->replyto_email_ARRAY['sys_email'])){

            $tmp_replyto_email_cnt = sizeof($this->replyto_email_ARRAY['sys_email']);

        }

        if(isset($this->bcc_email_ARRAY['sys_email'])){

            $tmp_bcc_email_cnt = sizeof($this->bcc_email_ARRAY['sys_email']);

        }

        if($tmp_to_email_cnt>0){

            //$oCRNRSTN_PHPMailer = new \PHPMailer\crnrstn_PHPMailer\crnrstn_PHPMailer(self::$oCRNRSTN_n);
            $oCRNRSTN_PROXYMailer = new crnrstn_highway_of_the_king(self::$oCRNRSTN_n);

            //
            // INITIALIZE SENDER/FROM
            $oCRNRSTN_PROXYMailer->setFrom($this->sender_email, $this->sender_name);
            self::$oCRNRSTN_n->error_log('oGabriel [PROXY] INITIALIZE SENDER/FROM setFrom['.self::$oCRNRSTN_n->string_sanitize($this->sender_email, 'email_private').' - ' . $this->sender_name.']', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

            //
            // INITIALIZE TO
            for($i=0; $i<$tmp_to_email_cnt; $i++){

                if(isset($this->optout_suppression_ARRAY[$this->to_email_ARRAY['sys_email'][$i]])){

                    //
                    // OPT OUT SUPPRESSION
                    $this->reporting_optout_suppression[] = $this->to_email_ARRAY['email'][$i];

                }else{

                    if(isset($this->duplicate_suppression_ARRAY[$this->to_email_ARRAY['sys_email'][$i]]) && $this->suppress_duplicates){

                        //
                        // DUPLICATE SUPPRESSION
                        $this->reporting_duplicate_suppression[] = $this->to_email_ARRAY['email'][$i];

                    }else{

                        if(isset($this->duplicate_suppression_ARRAY[$this->to_email_ARRAY['sys_email'][$i]])){

                            //
                            // TRACK INSTANCES OF DUPLICATE SEND FOR REPORTING META
                            $this->duplicate_suppression_ARRAY[$this->to_email_ARRAY['sys_email'][$i]]++;

                        }else{

                            $this->duplicate_suppression_ARRAY[$this->to_email_ARRAY['sys_email'][$i]] = 1;

                        }

                        self::$oCRNRSTN_n->error_log('oGabriel [PROXY] addAddress['.self::$oCRNRSTN_n->string_sanitize($this->to_email_ARRAY['sys_email'][$i], 'email_private').' - ' . $this->to_email_ARRAY['name'][$i].']', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                        //$oCRNRSTN_PHPMailer->addAddress($this->to_email_ARRAY['sys_email'][$i], $this->to_email_ARRAY['name'][$i]);
                        $oCRNRSTN_PROXYMailer->addAddress($this->to_email_ARRAY['sys_email'][$i], $this->to_email_ARRAY['name'][$i]);

                    }
                }
            }

            //
            // INITIALIZE REPLYTO
            if($tmp_replyto_email_cnt>0){

                for($i=0; $i<$tmp_replyto_email_cnt; $i++){
                    self::$oCRNRSTN_n->error_log('oGabriel [PROXY] addReplyTo['.self::$oCRNRSTN_n->string_sanitize($this->replyto_email_ARRAY['sys_email'][$i], 'email_private').' - ' . $this->replyto_email_ARRAY['name'][$i].']', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                    //$oCRNRSTN_PHPMailer->addReplyTo($this->replyto_email_ARRAY['sys_email'][$i], $this->replyto_email_ARRAY['name'][$i]);
                    $oCRNRSTN_PROXYMailer->addReplyTo($this->replyto_email_ARRAY['sys_email'][$i], $this->replyto_email_ARRAY['name'][$i]);
                }
            }

            //
            // INITIALIZE CC
            if($tmp_cc_email_cnt>0){

                for($i=0; $i<$tmp_cc_email_cnt; $i++){
                    self::$oCRNRSTN_n->error_log('oGabriel [PROXY] addCC['.self::$oCRNRSTN_n->string_sanitize($this->cc_email_ARRAY['sys_email'][$i], 'email_private').' - ' . $this->cc_email_ARRAY['name'][$i].']', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                    //$oCRNRSTN_PHPMailer->addCC($this->cc_email_ARRAY['sys_email'][$i], $this->cc_email_ARRAY['name'][$i]);
                    $oCRNRSTN_PROXYMailer->addCC($this->cc_email_ARRAY['sys_email'][$i], $this->cc_email_ARRAY['name'][$i]);
                }
            }

            //
            // INITIALIZE BCC
            if($tmp_bcc_email_cnt>0){

                for($i=0; $i<$tmp_bcc_email_cnt; $i++){
                    self::$oCRNRSTN_n->error_log('oGabriel [PROXY] addBCC['.self::$oCRNRSTN_n->string_sanitize($this->bcc_email_ARRAY['sys_email'][$i], 'email_private').' - ' . $this->bcc_email_ARRAY['name'][$i].']', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                    //$oCRNRSTN_PHPMailer->addBCC($this->bcc_email_ARRAY['sys_email'][$i], $this->bcc_email_ARRAY['name'][$i]);
                    $oCRNRSTN_PROXYMailer->addBCC($this->bcc_email_ARRAY['sys_email'][$i], $this->bcc_email_ARRAY['name'][$i]);
                }
            }
        }

        if(isset($oCRNRSTN_PROXYMailer)){

            self::$oCRNRSTN_PROXYMailer_ARRAY[] = $oCRNRSTN_PROXYMailer;
            $this->PROXYMailer_experience_tracker_ARRAY[] = $this->to_email_ARRAY['experience_tracker'][0];
            $this->PROXYMailer_single_or_bulk_ARRAY[] = 'single';

            self::$oCRNRSTN_n->error_log('oGabriel [PROXY] SINGLE ADD of address pushed to oCRNRSTN_PHPMailer_ARRAY', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

        }

        //
        // PROCESS ANY BULK EMAIL
        if(isset($this->to_email_ARRAY['experience_tracker'])){

            $tmp_experience_tracker_cnt = sizeof($this->to_email_ARRAY['experience_tracker']);

        }

        if($tmp_experience_tracker_cnt > 0){

            for($i=0; $i<$tmp_experience_tracker_cnt; $i++){

                $tmp_exp_tracker = $this->to_email_ARRAY['experience_tracker'][$i];

                if(isset($this->to_email_ARRAY[$tmp_exp_tracker])){

                    //$oCRNRSTN_PHPMailer = new \PHPMailer\crnrstn_PHPMailer\crnrstn_PHPMailer(self::$oCRNRSTN_n);
                    $oCRNRSTN_PROXYMailer = new crnrstn_highway_of_the_king(self::$oCRNRSTN_n);

                    //
                    // WE HAVE FOUND BULK EMAIL
                    $tmp_to_email_bulk_cnt = sizeof($this->to_email_ARRAY[$tmp_exp_tracker]['sys_email']);
                    self::$oCRNRSTN_n->error_log('oGabriel [PROXY] WE HAVE COUNT OF ' . $tmp_to_email_bulk_cnt.' TO PERFORM BULK OPERATION.', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                    if(isset($this->replyto_email_ARRAY[$tmp_exp_tracker]['sys_email'])){

                        $tmp_replyto_email_bulk_cnt = sizeof($this->replyto_email_ARRAY[$tmp_exp_tracker]['sys_email']);

                    }

                    if(isset($this->cc_email_ARRAY[$tmp_exp_tracker]['sys_email'])){

                        $tmp_cc_email_bulk_cnt = sizeof($this->cc_email_ARRAY[$tmp_exp_tracker]['sys_email']);

                    }

                    if(isset($this->bcc_email_ARRAY[$tmp_exp_tracker]['sys_email'])){

                        $tmp_bcc_email_bulk_cnt = sizeof($this->bcc_email_ARRAY[$tmp_exp_tracker]['sys_email']);

                    }

                    if(isset($this->sender_Bulk[$tmp_exp_tracker]['email'])){
                        self::$oCRNRSTN_n->error_log('oGabriel [PROXY] WE HAVE BULK SENDER/FROM sender_Bulk('.self::$oCRNRSTN_n->string_sanitize($this->sender_Bulk[$tmp_exp_tracker]['email'], 'email_private').' ' . $this->sender_Bulk[$tmp_exp_tracker]['name'].')...', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                    }

                    //
                    // INITIALIZE TO
                    for($ii=0; $ii<$tmp_to_email_bulk_cnt; $ii++){

                        $tmp_to_email = $this->to_email_ARRAY[$tmp_exp_tracker]['email'][$ii];
                        $tmp_to_sys_email = $this->to_email_ARRAY[$tmp_exp_tracker]['sys_email'][$ii];
                        $tmp_to_name = $this->to_email_ARRAY[$tmp_exp_tracker]['name'][$ii];

                        if(isset($this->optout_suppression_ARRAY[$tmp_to_sys_email])){

                            //
                            // OPT OUT SUPPRESSION
                            $this->reporting_optout_suppression[] = $tmp_to_sys_email;

                        }else{

                            if(isset($this->duplicate_suppression_ARRAY[$tmp_to_sys_email]) && $this->suppress_duplicates){

                                //
                                // DUPLICATE SUPPRESSION
                                $this->reporting_duplicate_suppression[] = $tmp_to_email;

                            }else{

                                if(isset($this->duplicate_suppression_ARRAY[$tmp_to_sys_email])){

                                    //
                                    // TRACK INSTANCES OF DUPLICATE SEND FOR REPORTING META
                                    $this->duplicate_suppression_ARRAY[$tmp_to_sys_email]++;

                                }else{

                                    $this->duplicate_suppression_ARRAY[$tmp_to_sys_email] = 1;

                                }

                                $oCRNRSTN_PROXYMailer->addAddress($tmp_to_sys_email, $tmp_to_name);
                                self::$oCRNRSTN_n->error_log('oGabriel [PROXY] WE HAVE BULK RECIPIENT addAddress('.self::$oCRNRSTN_n->string_sanitize($tmp_to_sys_email, 'email_private').', ' . $tmp_to_name.')...', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                            }
                        }
                    }

                    //
                    // INITIALIZE SENDER/FROM
                    $tmp_from_email_bulk_cnt = 1;

                    $oCRNRSTN_PROXYMailer->setFrom($this->sender_Bulk[$tmp_exp_tracker]['email'], $this->sender_Bulk[$tmp_exp_tracker]['name']);
                    self::$oCRNRSTN_n->error_log('oGabriel [PROXY] setFrom('.self::$oCRNRSTN_n->string_sanitize($this->sender_Bulk[$tmp_exp_tracker]['email'], 'email_private').', ' . $this->sender_Bulk[$tmp_exp_tracker]['name'].')...', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                    //
                    // INITIALIZE REPLYTO
                    if($tmp_replyto_email_bulk_cnt>0){

                        for($ii=0; $ii<$tmp_replyto_email_bulk_cnt; $ii++){

                            $oCRNRSTN_PROXYMailer->addReplyTo($this->replyto_email_ARRAY[$tmp_exp_tracker]['sys_email'][$ii], $this->replyto_email_ARRAY[$tmp_exp_tracker]['name'][$ii]);

                        }
                    }

                    //
                    // INITIALIZE CC
                    if($tmp_cc_email_bulk_cnt>0){

                        for($ii=0; $ii<$tmp_cc_email_bulk_cnt; $ii++){

                            $oCRNRSTN_PROXYMailer->addCC($this->cc_email_ARRAY[$tmp_exp_tracker]['sys_email'][$ii], $this->cc_email_ARRAY[$tmp_exp_tracker]['name'][$ii]);

                        }
                    }

                    //
                    // INITIALIZE BCC
                    if($tmp_bcc_email_bulk_cnt>0){

                        for($ii=0; $ii<$tmp_bcc_email_bulk_cnt; $ii++){

                            $oCRNRSTN_PROXYMailer->addBCC($this->bcc_email_ARRAY[$tmp_exp_tracker]['sys_email'][$ii], $this->bcc_email_ARRAY[$tmp_exp_tracker]['name'][$ii]);

                        }
                    }

                    if(isset($oCRNRSTN_PROXYMailer)){

                        self::$oCRNRSTN_PROXYMailer_ARRAY[] = $oCRNRSTN_PROXYMailer;
                        $this->PROXYMailer_experience_tracker_ARRAY[] = $tmp_exp_tracker;
                        $this->PROXYMailer_single_or_bulk_ARRAY[] = 'bulk';

                    }

                    $oCRNRSTN_PROXYMailer = NULL;
                    unset($oCRNRSTN_PROXYMailer);

                }

            }

        }else{

            self::$oCRNRSTN_n->error_log('oGabriel [PROXY] WE HAVE NO BULK EMAIL TO PROCESS...', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

        }

    }

    private function initialize_sender_recipient(){

        $tmp_to_email_cnt = 0;
        $tmp_experience_tracker_cnt = 0;
        $tmp_replyto_email_cnt = 0;
        $tmp_cc_email_cnt = 0;
        $tmp_bcc_email_cnt = 0;
        $tmp_to_email_bulk_cnt = 0;
        $tmp_replyto_email_bulk_cnt = 0;
        $tmp_cc_email_bulk_cnt = 0;
        $tmp_bcc_email_bulk_cnt = 0;
        $tmp_from_email_bulk_cnt = 0;

        //
        // PROCESS ANY SINGLE SERVING EMAIL
        if(isset($this->to_email_ARRAY['sys_email'])){

            $tmp_to_email_cnt = sizeof($this->to_email_ARRAY['sys_email']);

        }

        if(isset($this->cc_email_ARRAY['sys_email'])){

            $tmp_cc_email_cnt = sizeof($this->cc_email_ARRAY['sys_email']);

        }

        if(isset($this->replyto_email_ARRAY['sys_email'])){

            $tmp_replyto_email_cnt = sizeof($this->replyto_email_ARRAY['sys_email']);

        }

        if(isset($this->bcc_email_ARRAY['sys_email'])){

            $tmp_bcc_email_cnt = sizeof($this->bcc_email_ARRAY['sys_email']);

        }

        if($tmp_to_email_cnt>0){

            $oCRNRSTN_PHPMailer = new \PHPMailer\crnrstn_PHPMailer\crnrstn_PHPMailer(self::$oCRNRSTN_n);

            //
            // INITIALIZE SENDER/FROM
            $oCRNRSTN_PHPMailer->setFrom($this->sender_email, $this->sender_name);
            self::$oCRNRSTN_n->error_log('oGabriel INITIALIZE SENDER/FROM setFrom['.self::$oCRNRSTN_n->string_sanitize($this->sender_email, 'email_private').' - ' . $this->sender_name.']', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

            //
            // INITIALIZE TO
            for($i=0; $i<$tmp_to_email_cnt; $i++){

                if(isset($this->optout_suppression_ARRAY[$this->to_email_ARRAY['sys_email'][$i]])){

                    //
                    // OPT OUT SUPPRESSION
                    $this->reporting_optout_suppression[] = $this->to_email_ARRAY['email'][$i];

                }else{

                    if(isset($this->duplicate_suppression_ARRAY[$this->to_email_ARRAY['sys_email'][$i]]) && $this->suppress_duplicates){

                        //
                        // DUPLICATE SUPPRESSION
                        $this->reporting_duplicate_suppression[] = $this->to_email_ARRAY['email'][$i];

                    }else{

                        if(isset($this->duplicate_suppression_ARRAY[$this->to_email_ARRAY['sys_email'][$i]])){

                            //
                            // TRACK INSTANCES OF DUPLICATE SEND FOR REPORTING META
                            $this->duplicate_suppression_ARRAY[$this->to_email_ARRAY['sys_email'][$i]]++;

                        }else{

                            $this->duplicate_suppression_ARRAY[$this->to_email_ARRAY['sys_email'][$i]] = 1;

                        }

                        self::$oCRNRSTN_n->error_log('oGabriel addAddress['.self::$oCRNRSTN_n->string_sanitize($this->to_email_ARRAY['sys_email'][$i], 'email_private').' - ' . $this->to_email_ARRAY['name'][$i].']', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                        $oCRNRSTN_PHPMailer->addAddress($this->to_email_ARRAY['sys_email'][$i], $this->to_email_ARRAY['name'][$i]);

                    }
                }
            }

            //
            // INITIALIZE REPLYTO
            if($tmp_replyto_email_cnt>0){

                for($i=0; $i<$tmp_replyto_email_cnt; $i++){
                    self::$oCRNRSTN_n->error_log('oGabriel addReplyTo['.self::$oCRNRSTN_n->string_sanitize($this->replyto_email_ARRAY['sys_email'][$i], 'email_private').' - ' . $this->replyto_email_ARRAY['name'][$i].']', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                    $oCRNRSTN_PHPMailer->addReplyTo($this->replyto_email_ARRAY['sys_email'][$i], $this->replyto_email_ARRAY['name'][$i]);

                }
            }

            //
            // INITIALIZE CC
            if($tmp_cc_email_cnt>0){

                for($i=0; $i<$tmp_cc_email_cnt; $i++){
                    self::$oCRNRSTN_n->error_log('oGabriel addCC['.self::$oCRNRSTN_n->string_sanitize($this->cc_email_ARRAY['sys_email'][$i], 'email_private').' - ' . $this->cc_email_ARRAY['name'][$i].']', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                    $oCRNRSTN_PHPMailer->addCC($this->cc_email_ARRAY['sys_email'][$i], $this->cc_email_ARRAY['name'][$i]);

                }
            }

            //
            // INITIALIZE BCC
            if($tmp_bcc_email_cnt>0){

                for($i=0; $i<$tmp_bcc_email_cnt; $i++){
                    self::$oCRNRSTN_n->error_log('oGabriel addBCC['.self::$oCRNRSTN_n->string_sanitize($this->bcc_email_ARRAY['sys_email'][$i], 'email_private').' - ' . $this->bcc_email_ARRAY['name'][$i].']', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                    $oCRNRSTN_PHPMailer->addBCC($this->bcc_email_ARRAY['sys_email'][$i], $this->bcc_email_ARRAY['name'][$i]);

                }
            }
        }

        if(isset($oCRNRSTN_PHPMailer)){

            self::$oCRNRSTN_PHPMailer_ARRAY[] = $oCRNRSTN_PHPMailer;
            $this->PHPMailer_experience_tracker_ARRAY[] = $this->to_email_ARRAY['experience_tracker'][0];
            $this->PHPMailer_single_or_bulk_ARRAY[] = 'single';

            self::$oCRNRSTN_n->error_log('oGabriel SINGLE ADD of address pushed to oCRNRSTN_PHPMailer_ARRAY', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);


        }

        //
        // PROCESS ANY BULK EMAIL
        if(isset($this->to_email_ARRAY['experience_tracker'])){

            $tmp_experience_tracker_cnt = sizeof($this->to_email_ARRAY['experience_tracker']);

        }

        if($tmp_experience_tracker_cnt > 0){

            for($i=0; $i<$tmp_experience_tracker_cnt; $i++){

                $tmp_exp_tracker = $this->to_email_ARRAY['experience_tracker'][$i];

                if(isset($this->to_email_ARRAY[$tmp_exp_tracker])){

                    $oCRNRSTN_PHPMailer = new \PHPMailer\crnrstn_PHPMailer\crnrstn_PHPMailer(self::$oCRNRSTN_n);

                    //
                    // WE HAVE FOUND BULK EMAIL
                    $tmp_to_email_bulk_cnt = sizeof($this->to_email_ARRAY[$tmp_exp_tracker]['sys_email']);
                    self::$oCRNRSTN_n->error_log('oGabriel WE HAVE COUNT OF ' . $tmp_to_email_bulk_cnt.' TO PERFORM BULK OPERATION.', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                    if(isset($this->replyto_email_ARRAY[$tmp_exp_tracker]['sys_email'])){

                        $tmp_replyto_email_bulk_cnt = sizeof($this->replyto_email_ARRAY[$tmp_exp_tracker]['sys_email']);

                    }

                    if(isset($this->cc_email_ARRAY[$tmp_exp_tracker]['sys_email'])){

                        $tmp_cc_email_bulk_cnt = sizeof($this->cc_email_ARRAY[$tmp_exp_tracker]['sys_email']);

                    }

                    if(isset($this->bcc_email_ARRAY[$tmp_exp_tracker]['sys_email'])){

                        $tmp_bcc_email_bulk_cnt = sizeof($this->bcc_email_ARRAY[$tmp_exp_tracker]['sys_email']);

                    }

                    if(isset($this->sender_Bulk[$tmp_exp_tracker]['email'])){
                        self::$oCRNRSTN_n->error_log('oGabriel WE HAVE BULK SENDER/FROM sender_Bulk('.self::$oCRNRSTN_n->string_sanitize($this->sender_Bulk[$tmp_exp_tracker]['email'], 'email_private').' ' . $this->sender_Bulk[$tmp_exp_tracker]['name'].')...', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                    }

                    //
                    // INITIALIZE TO
                    for($ii=0; $ii<$tmp_to_email_bulk_cnt; $ii++){

                        $tmp_to_email = $this->to_email_ARRAY[$tmp_exp_tracker]['email'][$ii];
                        $tmp_to_sys_email = $this->to_email_ARRAY[$tmp_exp_tracker]['sys_email'][$ii];
                        $tmp_to_name = $this->to_email_ARRAY[$tmp_exp_tracker]['name'][$ii];

                        if(isset($this->optout_suppression_ARRAY[$tmp_to_sys_email])){

                            //
                            // OPT OUT SUPPRESSION
                            $this->reporting_optout_suppression[] = $tmp_to_sys_email;

                        }else{

                            if(isset($this->duplicate_suppression_ARRAY[$tmp_to_sys_email]) && $this->suppress_duplicates){

                                //
                                // DUPLICATE SUPPRESSION
                                $this->reporting_duplicate_suppression[] = $tmp_to_email;

                            }else{

                                if(isset($this->duplicate_suppression_ARRAY[$tmp_to_sys_email])){

                                    //
                                    // TRACK INSTANCES OF DUPLICATE SEND FOR REPORTING META
                                    $this->duplicate_suppression_ARRAY[$tmp_to_sys_email]++;

                                }else{

                                    $this->duplicate_suppression_ARRAY[$tmp_to_sys_email] = 1;

                                }

                                $oCRNRSTN_PHPMailer->addAddress($tmp_to_sys_email, $tmp_to_name);
                                self::$oCRNRSTN_n->error_log('oGabriel WE HAVE BULK RECIPIENT addAddress('.self::$oCRNRSTN_n->string_sanitize($tmp_to_sys_email, 'email_private').', ' . $tmp_to_name.')...', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                            }
                        }
                    }

                    //
                    // INITIALIZE SENDER/FROM
                    $tmp_from_email_bulk_cnt = 1;

                    $oCRNRSTN_PHPMailer->setFrom($this->sender_Bulk[$tmp_exp_tracker]['email'], $this->sender_Bulk[$tmp_exp_tracker]['name']);
                    self::$oCRNRSTN_n->error_log('oGabriel setFrom('.self::$oCRNRSTN_n->string_sanitize($this->sender_Bulk[$tmp_exp_tracker]['email'], 'email_private').', ' . $this->sender_Bulk[$tmp_exp_tracker]['name'].')...', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                    //
                    // INITIALIZE REPLYTO
                    if($tmp_replyto_email_bulk_cnt>0){

                        for($ii=0; $ii<$tmp_replyto_email_bulk_cnt; $ii++){

                            $oCRNRSTN_PHPMailer->addReplyTo($this->replyto_email_ARRAY[$tmp_exp_tracker]['sys_email'][$ii], $this->replyto_email_ARRAY[$tmp_exp_tracker]['name'][$ii]);

                        }
                    }

                    //
                    // INITIALIZE CC
                    if($tmp_cc_email_bulk_cnt>0){

                        for($ii=0; $ii<$tmp_cc_email_bulk_cnt; $ii++){

                            $oCRNRSTN_PHPMailer->addCC($this->cc_email_ARRAY[$tmp_exp_tracker]['sys_email'][$ii], $this->cc_email_ARRAY[$tmp_exp_tracker]['name'][$ii]);

                        }
                    }

                    //
                    // INITIALIZE BCC
                    if($tmp_bcc_email_bulk_cnt>0){

                        for($ii=0; $ii<$tmp_bcc_email_bulk_cnt; $ii++){

                            $oCRNRSTN_PHPMailer->addBCC($this->bcc_email_ARRAY[$tmp_exp_tracker]['sys_email'][$ii], $this->bcc_email_ARRAY[$tmp_exp_tracker]['name'][$ii]);

                        }
                    }

                    if(isset($oCRNRSTN_PHPMailer)){

                        self::$oCRNRSTN_PHPMailer_ARRAY[] = $oCRNRSTN_PHPMailer;
                        $this->PHPMailer_experience_tracker_ARRAY[] = $tmp_exp_tracker;
                        $this->PHPMailer_single_or_bulk_ARRAY[] = 'bulk';

                    }

                    $oCRNRSTN_PHPMailer = NULL;
                    unset($oCRNRSTN_PHPMailer);

                }

            }

        }else{
            self::$oCRNRSTN_n->error_log('oGabriel WE HAVE NO BULK EMAIL TO PROCESS...', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
        }

    }

    private function initialize_connectivity(){

        try{

            if(isset(self::$oCRNRSTN_PHPMailer_ARRAY)){

                $tmp_mailer_cnt = sizeof(self::$oCRNRSTN_PHPMailer_ARRAY);

                for($i=0; $i<$tmp_mailer_cnt; $i++){

                    $oCRNRSTN_PHPMailer = self::$oCRNRSTN_PHPMailer_ARRAY[$i];

                    if(isset($this->mail_host_servers)){

                        //
                        // SPECIFY MAIN AND BACKUP SERVER
                        $oCRNRSTN_PHPMailer->Host = $this->mail_host_servers;
                        self::$oCRNRSTN_n->error_log('oGabriel Host=[' . $this->mail_host_servers.']', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                    }

                    if(isset($this->port)){

                        //
                        // SPECIFY PORT
                        $oCRNRSTN_PHPMailer->Port = $this->port;
                        self::$oCRNRSTN_n->error_log('oGabriel Port=[' . $this->port.']', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                    }

                    switch($this->mail_protocol){
                        case 'SMTP':
                            self::$oCRNRSTN_n->error_log('oGabriel isSMTP()', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                            $oCRNRSTN_PHPMailer->isSMTP();

                            if(isset($this->username)){

                                //
                                // ACTIVATE SMTP AUTHENTICATION
                                $oCRNRSTN_PHPMailer->SMTPAuth = true;
                                $oCRNRSTN_PHPMailer->Username = $this->username;    // SMTP USERNAME
                                $oCRNRSTN_PHPMailer->Password = $this->password;    // SMTP PASSWORD
                                self::$oCRNRSTN_n->error_log('oGabriel ' . $this->mail_protocol . ' - ACTIVATE SMTP SMTPAuth=TRUE [UN='.self::$oCRNRSTN_n->string_sanitize($oCRNRSTN_PHPMailer->Username, 'email_private').'][' . $oCRNRSTN_PHPMailer->Host.']', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                            }else{

                                $oCRNRSTN_PHPMailer->SMTPAuth = false;
                                $oCRNRSTN_PHPMailer->Username = '';
                                $oCRNRSTN_PHPMailer->Password = '';
                                self::$oCRNRSTN_n->error_log('oGabriel ' . $this->mail_protocol . ' - NO SMTP SMTPAuth=FALSE [UN='.self::$oCRNRSTN_n->string_sanitize($oCRNRSTN_PHPMailer->Username, 'email_private').'][' . $oCRNRSTN_PHPMailer->Host.']', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                            }

                            //
                            // WORK AROUND FOR PHPMAILER SSL CERT VERIFICATION *ERRORS INTRODUCED
                            // THROUGH THE STRICTER SSL BEHAVIOR THAT CAME WITH THE RELEASE OF PHP 5.6
                            // SOURCE :: https://pepipost.com/tutorials/phpmailer-smtp-error-could-not-connect-to-smtp-host/
                            // AUTHOR :: https://pepipost.com/tutorials/author/dibya-sahoo/
                            // DETAIL :: https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting#certificate-verification-failure
                            // * You may not see this error; In implicit encryption mode (SMTPS) it may be
                            // hidden because there isn't a way for the channel to show messages - SMTP+STARTTLS
                            // is generally easier to debug because of this.
                            $oCRNRSTN_PHPMailer->SMTPOptions = array(
                                'ssl' => array(
                                    'verify_peer' => false,
                                    'verify_peer_name' => false,
                                    'allow_self_signed' => true
                                )
                            );

                            break;
                        case 'MAIL':
                            self::$oCRNRSTN_n->error_log('oGabriel isMail()', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                            $oCRNRSTN_PHPMailer->isMail();

                            break;
                        case 'SENDMAIL':
                            self::$oCRNRSTN_n->error_log('oGabriel isSendmail()', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                            $oCRNRSTN_PHPMailer->isSendmail();

                            break;
                        case 'QMAIL':
                            self::$oCRNRSTN_n->error_log('oGabriel isQmail()', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                            $oCRNRSTN_PHPMailer->isQmail();

                            break;
                        default:

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('Unknown mail protocol of "' . $this->mail_protocol . '" has been provided. The options which are available include "SMTP", "MAIL", "SENDMAIL" and "QMAIL".');

                            break;

                    }

                    self::$oCRNRSTN_PHPMailer_ARRAY[$i] = $oCRNRSTN_PHPMailer;

                }

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No instances of the oCRNRSTN_PHPMailer class object could be found for their connectivity initialization.');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        return true;

    }

    private function initialize_proxy_message_content(){

        try{

            if(isset(self::$oCRNRSTN_PROXYMailer_ARRAY)){

                $tmp_mailer_cnt = sizeof(self::$oCRNRSTN_PROXYMailer_ARRAY);
                self::$oCRNRSTN_n->error_log('oGabriel [PROXY] initialize_message_content for [' . $tmp_mailer_cnt.'] EMAIL', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                for($i=0; $i<$tmp_mailer_cnt; $i++){
                    self::$oCRNRSTN_n->error_log('oGabriel [PROXY] initialize_message_content() RUNNING for [' . $i.']', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                    $oCRNRSTN_PROXYMailer = self::$oCRNRSTN_PROXYMailer_ARRAY[$i];
                    $email_experience_tracker = $this->PROXYMailer_experience_tracker_ARRAY[$i];
                    $bulk_single_indicator = $this->PROXYMailer_single_or_bulk_ARRAY[$i];

                    switch($bulk_single_indicator){
                        case 'single':

                            if(isset($this->priority)){

                                $oCRNRSTN_PROXYMailer->Priority = $this->priority;
                                self::$oCRNRSTN_n->error_log('oGabriel [PROXY] Priority = ' . $oCRNRSTN_PROXYMailer->Priority, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                            }

                            if(isset($this->word_wrap)){

                                $oCRNRSTN_PROXYMailer->WordWrap = $this->word_wrap;
                                self::$oCRNRSTN_n->error_log('oGabriel [PROXY] WordWrap = ' . $oCRNRSTN_PROXYMailer->WordWrap, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                            }

                            $oCRNRSTN_PROXYMailer->is_HTML = $this->is_HTML;

                            if($this->is_HTML){

                                self::$oCRNRSTN_n->error_log('oGabriel [PROXY] IsHTML = TRUE', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                                if(isset($this->html_message) && strlen($this->html_message)>0){

                                    //
                                    // PROCESS DYNAMIC CONTENT
                                    if(isset($this->dynamic_content_HTML_ARRAY[$email_experience_tracker])){

                                        $this->html_message = str_replace($this->dynamic_content_HTML_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_HTML_ARRAY[$email_experience_tracker]['content'], $this->html_message);

                                    }

                                    $oCRNRSTN_PROXYMailer->Body = $this->html_message;

                                    if(isset($this->text_message)){

                                        //
                                        // PROCESS DYNAMIC CONTENT
                                        if(isset($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker])){

                                            $this->text_message = str_replace($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['content'], $this->text_message);

                                        }

                                        $oCRNRSTN_PROXYMailer->AltBody = $this->text_message;

                                        self::$oCRNRSTN_n->error_log('oGabriel [PROXY] [MULTIPART] Body LENGTH = '.strlen($oCRNRSTN_PROXYMailer->Body).'| AltBody(text version) LENGTH = '.strlen($oCRNRSTN_PROXYMailer->AltBody), __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                                    }else{

                                        self::$oCRNRSTN_n->error_log('oGabriel [PROXY] [HTML ONLY] Body LENGTH = '.strlen($oCRNRSTN_PROXYMailer->Body), __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                                    }

                                }else{

                                    //
                                    // NO HTML BODY. ATTEMPT GRACEFUL DEGRADATION TO TEXT VERSION (AltBody).
                                    if(isset($this->text_message)){

                                        //
                                        // PROCESS DYNAMIC CONTENT
                                        if(isset($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker])){

                                            $this->text_message = str_replace($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['content'], $this->text_message);

                                        }

                                        $oCRNRSTN_PROXYMailer->Body = $this->text_message;

                                        self::$oCRNRSTN_n->error_log('oGabriel [PROXY] Body LENGTH = '.strlen($oCRNRSTN_PROXYMailer->Body), __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                                    }else{

                                        //
                                        // HOOOSTON...VE HAF PROBLEM!
                                        throw new Exception('No message body has been provided via either oCRNRSTN_USR->addBody() or oCRNRSTN_USR->addAltBody().');

                                    }

                                }

                            }else{

                                //
                                // isHTML = FALSE
                                self::$oCRNRSTN_n->error_log('oGabriel [PROXY] IsHTML = FALSE', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                                if(isset($this->text_message)){

                                    //
                                    // PROCESS DYNAMIC CONTENT
                                    if(isset($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker])){

                                        $this->text_message = str_replace($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['content'], $this->text_message);

                                    }

                                    $oCRNRSTN_PROXYMailer->Body = $this->text_message;

                                    self::$oCRNRSTN_n->error_log('oGabriel [PROXY] [TEXT VERSION] Body LENGTH = '.strlen($oCRNRSTN_PROXYMailer->Body), __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                                }else{

                                    //
                                    // HOOOSTON...VE HAF PROBLEM!
                                    throw new Exception('No message body has been provided via either oCRNRSTN_USR->addBody() or oCRNRSTN_USR->addAltBody().');

                                }
                            }

                            if(isset($this->subject_line)){

                                //
                                // PROCESS DYNAMIC CONTENT
                                if(isset($this->dynamic_content_SUBJECT_ARRAY[$email_experience_tracker])){

                                    $this->subject_line = str_replace($this->dynamic_content_SUBJECT_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_SUBJECT_ARRAY[$email_experience_tracker]['content'], $this->subject_line);

                                }

                                $oCRNRSTN_PROXYMailer->Subject = trim($this->subject_line);

                                self::$oCRNRSTN_n->error_log('oGabriel [PROXY] Subject = ' . $oCRNRSTN_PROXYMailer->Subject, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                            }

                            break;
                        case 'bulk':

                            //self::$oCRNRSTN_n->error_log('oGabriel SWITCH() ENTRY CASE="bulk"', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                            if(isset($this->priorityBulk[$email_experience_tracker])){

                                $oCRNRSTN_PROXYMailer->Priority = $this->priorityBulk[$email_experience_tracker];
                                self::$oCRNRSTN_n->error_log('oGabriel [PROXY] BULK Priority = ' . $oCRNRSTN_PROXYMailer->Priority, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                            }

                            if(isset($this->word_wrapBulk[$email_experience_tracker])){

                                $oCRNRSTN_PROXYMailer->WordWrap = $this->word_wrapBulk[$email_experience_tracker];
                                self::$oCRNRSTN_n->error_log('oGabriel [PROXY] BULK WordWrap = ' . $oCRNRSTN_PROXYMailer->WordWrap, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                            }

                            $oCRNRSTN_PROXYMailer->is_HTML = $this->is_HTMLBulk[$email_experience_tracker];

                            if($this->is_HTMLBulk[$email_experience_tracker]){

                                self::$oCRNRSTN_n->error_log('oGabriel [PROXY] BULK IsHTML = TRUE', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                                if(isset($this->html_messageBulk[$email_experience_tracker]) && strlen($this->html_messageBulk[$email_experience_tracker])>0){

                                    //
                                    // PROCESS DYNAMIC CONTENT
                                    if(isset($this->dynamic_content_HTML_ARRAY[$email_experience_tracker])){

                                        $this->html_messageBulk[$email_experience_tracker] = str_replace($this->dynamic_content_HTML_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_HTML_ARRAY[$email_experience_tracker]['content'], $this->html_messageBulk[$email_experience_tracker]);

                                    }

                                    $oCRNRSTN_PROXYMailer->Body = $this->html_messageBulk[$email_experience_tracker];

                                    if(isset($this->text_messageBulk[$email_experience_tracker])){

                                        //
                                        // PROCESS DYNAMIC CONTENT
                                        if(isset($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker])){

                                            $this->text_messageBulk[$email_experience_tracker] = str_replace($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['content'], $this->text_messageBulk[$email_experience_tracker]);

                                        }

                                        $oCRNRSTN_PROXYMailer->AltBody = $this->text_messageBulk[$email_experience_tracker];

                                        self::$oCRNRSTN_n->error_log('oGabriel [PROXY] BULK [MULTIPART] Body LENGTH = '.strlen($oCRNRSTN_PROXYMailer->Body).'| AltBody(text version) LENGTH = '.strlen($oCRNRSTN_PROXYMailer->AltBody), __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                                    }else{

                                        self::$oCRNRSTN_n->error_log('oGabriel [PROXY] BULK [HTML ONLY] Body LENGTH = '.strlen($oCRNRSTN_PROXYMailer->Body), __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                                    }

                                }else{

                                    //
                                    // NO HTML BODY. ATTEMPT GRACEFUL DEGRADATION TO TEXT VERSION (AltBody).
                                    if(isset($this->text_messageBulk[$email_experience_tracker])){

                                        //
                                        // PROCESS DYNAMIC CONTENT
                                        if(isset($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker])){

                                            $this->text_messageBulk[$email_experience_tracker] = str_replace($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['content'], $this->text_messageBulk[$email_experience_tracker]);

                                        }

                                        $oCRNRSTN_PROXYMailer->Body = $this->text_messageBulk[$email_experience_tracker];

                                        self::$oCRNRSTN_n->error_log('oGabriel [PROXY] BULK Body (text version) LENGTH = '.strlen($oCRNRSTN_PROXYMailer->Body), __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                                    }else{

                                        //
                                        // HOOOSTON...VE HAF PROBLEM!
                                        throw new Exception('No message body has been provided via either oCRNRSTN_USR->addBody() or oCRNRSTN_USR->addAltBody().');

                                    }

                                }

                            }else{

                                //
                                // isHTML = FALSE
                                self::$oCRNRSTN_n->error_log('oGabriel [PROXY] BULK IsHTML = FALSE', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                                if(isset($this->text_messageBulk[$email_experience_tracker])){

                                    //
                                    // PROCESS DYNAMIC CONTENT
                                    if(isset($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker])){

                                        $this->text_messageBulk[$email_experience_tracker] = str_replace($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['content'], $this->text_messageBulk[$email_experience_tracker]);

                                    }

                                    $oCRNRSTN_PROXYMailer->Body = $this->text_messageBulk[$email_experience_tracker];

                                    self::$oCRNRSTN_n->error_log('oGabriel [PROXY] BULK [TEXT VERSION] Body = '.strlen($oCRNRSTN_PROXYMailer->Body), __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                                }else{

                                    //
                                    // HOOOSTON...VE HAF PROBLEM!
                                    throw new Exception('No message body has been provided via either oCRNRSTN_USR->addBody() or oCRNRSTN_USR->addAltBody().');

                                }
                            }

                            if(isset($this->subject_lineBulk[$email_experience_tracker])){

                                //
                                // PROCESS DYNAMIC CONTENT
                                if(isset($this->dynamic_content_SUBJECT_ARRAY[$email_experience_tracker])){

                                    $this->subject_lineBulk[$email_experience_tracker] = str_replace($this->dynamic_content_SUBJECT_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_SUBJECT_ARRAY[$email_experience_tracker]['content'], $this->subject_lineBulk[$email_experience_tracker]);

                                }

                                $oCRNRSTN_PROXYMailer->Subject = trim($this->subject_lineBulk[$email_experience_tracker]);

                                self::$oCRNRSTN_n->error_log('oGabriel [PROXY] BULK Subject [' . $i.'] = ' . $oCRNRSTN_PROXYMailer->Subject, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                            }

                            break;
                        default:

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('Unknown bulk or single indicator,"' . $bulk_single_indicator.'" received.');

                            break;
                    }

                    self::$oCRNRSTN_n->error_log('[' . $i.'] oGabriel [PROXY] BULK - Returning FULLY EMAIL, CONNECTION and CONTENT CHARGED oCRNRSTN_PHPMailer to the oArray().', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                    self::$oCRNRSTN_PROXYMailer_ARRAY[$i] = $oCRNRSTN_PROXYMailer;

                }

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No instances of the oCRNRSTN_PHPMailer class object could be found for their connectivity initialization.');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;
        }

        return true;

    }

    private function initialize_message_content(){

        try{

            if(isset(self::$oCRNRSTN_PHPMailer_ARRAY)){

                $tmp_mailer_cnt = sizeof(self::$oCRNRSTN_PHPMailer_ARRAY);
                self::$oCRNRSTN_n->error_log('oGabriel initialize_message_content for [' . $tmp_mailer_cnt.'] EMAIL', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                for($i=0; $i<$tmp_mailer_cnt; $i++){
                    self::$oCRNRSTN_n->error_log('oGabriel initialize_message_content() RUNNING for [' . $i.']', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                    $oCRNRSTN_PHPMailer = self::$oCRNRSTN_PHPMailer_ARRAY[$i];
                    $email_experience_tracker = $this->PHPMailer_experience_tracker_ARRAY[$i];
                    $bulk_single_indicator = $this->PHPMailer_single_or_bulk_ARRAY[$i];

                    switch($bulk_single_indicator){
                        case 'single':

                            if(isset($this->priority)){

                                $oCRNRSTN_PHPMailer->Priority = $this->priority;
                                self::$oCRNRSTN_n->error_log('oGabriel Priority = ' . $oCRNRSTN_PHPMailer->Priority, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                            }

                            if(isset($this->word_wrap)){

                                $oCRNRSTN_PHPMailer->WordWrap = $this->word_wrap;
                                self::$oCRNRSTN_n->error_log('oGabriel WordWrap = ' . $oCRNRSTN_PHPMailer->WordWrap, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                            }

                            $oCRNRSTN_PHPMailer->IsHTML($this->is_HTML);

                            if($this->is_HTML){

                                self::$oCRNRSTN_n->error_log('oGabriel IsHTML = TRUE', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                                if(isset($this->html_message) && strlen($this->html_message)>0){

                                    //
                                    // PROCESS DYNAMIC CONTENT
                                    if(isset($this->dynamic_content_HTML_ARRAY[$email_experience_tracker])){

                                        $this->html_message = str_replace($this->dynamic_content_HTML_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_HTML_ARRAY[$email_experience_tracker]['content'], $this->html_message);

                                    }

                                    $oCRNRSTN_PHPMailer->Body = $this->html_message;

                                    if(isset($this->text_message)){

                                        //
                                        // PROCESS DYNAMIC CONTENT
                                        if(isset($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker])){

                                            $this->text_message = str_replace($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['content'], $this->text_message);

                                        }

                                        $oCRNRSTN_PHPMailer->AltBody = $this->text_message;

                                        self::$oCRNRSTN_n->error_log('oGabriel [MULTIPART] Body LENGTH = '.strlen($oCRNRSTN_PHPMailer->Body).'| AltBody(text version) LENGTH = '.strlen($oCRNRSTN_PHPMailer->AltBody), __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                                    }else{

                                        self::$oCRNRSTN_n->error_log('oGabriel [HTML ONLY] Body LENGTH = '.strlen($oCRNRSTN_PHPMailer->Body), __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                                    }

                                }else{

                                    //
                                    // NO HTML BODY. ATTEMPT GRACEFUL DEGRADATION TO TEXT VERSION (AltBody).
                                    if(isset($this->text_message)){

                                        //
                                        // PROCESS DYNAMIC CONTENT
                                        if(isset($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker])){

                                            $this->text_message = str_replace($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['content'], $this->text_message);

                                        }

                                        $oCRNRSTN_PHPMailer->Body = $this->text_message;

                                        self::$oCRNRSTN_n->error_log('oGabriel Body LENGTH = '.strlen($oCRNRSTN_PHPMailer->Body), __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                                    }else{

                                        //
                                        // HOOOSTON...VE HAF PROBLEM!
                                        throw new Exception('No message body has been provided via either oCRNRSTN_USR->addBody() or oCRNRSTN_USR->addAltBody().');

                                    }

                                }

                            }else{

                                //
                                // isHTML = FALSE
                                self::$oCRNRSTN_n->error_log('oGabriel IsHTML = FALSE', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                                if(isset($this->text_message)){

                                    //
                                    // PROCESS DYNAMIC CONTENT
                                    if(isset($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker])){

                                        $this->text_message = str_replace($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['content'], $this->text_message);

                                    }

                                    $oCRNRSTN_PHPMailer->Body = $this->text_message;

                                    self::$oCRNRSTN_n->error_log('oGabriel [TEXT VERSION] Body LENGTH = '.strlen($oCRNRSTN_PHPMailer->Body), __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                                }else{

                                    //
                                    // HOOOSTON...VE HAF PROBLEM!
                                    throw new Exception('No message body has been provided via either oCRNRSTN_USR->addBody() or oCRNRSTN_USR->addAltBody().');

                                }
                            }

                            if(isset($this->subject_line)){

                                //
                                // PROCESS DYNAMIC CONTENT
                                if(isset($this->dynamic_content_SUBJECT_ARRAY[$email_experience_tracker])){

                                    $this->subject_line = str_replace($this->dynamic_content_SUBJECT_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_SUBJECT_ARRAY[$email_experience_tracker]['content'], $this->subject_line);

                                }

                                $oCRNRSTN_PHPMailer->Subject = trim($this->subject_line);

                                self::$oCRNRSTN_n->error_log('oGabriel Subject = ' . $oCRNRSTN_PHPMailer->Subject, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                            }

                            break;
                        case 'bulk':

                            //self::$oCRNRSTN_n->error_log('oGabriel SWITCH() ENTRY CASE="bulk"', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                            if(isset($this->priorityBulk[$email_experience_tracker])){

                                $oCRNRSTN_PHPMailer->Priority = $this->priorityBulk[$email_experience_tracker];
                                self::$oCRNRSTN_n->error_log('oGabriel BULK Priority = ' . $oCRNRSTN_PHPMailer->Priority, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                            }

                            if(isset($this->word_wrapBulk[$email_experience_tracker])){

                                $oCRNRSTN_PHPMailer->WordWrap = $this->word_wrapBulk[$email_experience_tracker];
                                self::$oCRNRSTN_n->error_log('oGabriel BULK WordWrap = ' . $oCRNRSTN_PHPMailer->WordWrap, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                            }

                            $oCRNRSTN_PHPMailer->isHTML($this->is_HTMLBulk[$email_experience_tracker]);

                            if($this->is_HTMLBulk[$email_experience_tracker]){

                                self::$oCRNRSTN_n->error_log('oGabriel BULK IsHTML = TRUE', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                                if(isset($this->html_messageBulk[$email_experience_tracker]) && strlen($this->html_messageBulk[$email_experience_tracker])>0){

                                    //
                                    // PROCESS DYNAMIC CONTENT
                                    if(isset($this->dynamic_content_HTML_ARRAY[$email_experience_tracker])){

                                        $this->html_messageBulk[$email_experience_tracker] = str_replace($this->dynamic_content_HTML_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_HTML_ARRAY[$email_experience_tracker]['content'], $this->html_messageBulk[$email_experience_tracker]);

                                    }

                                    $oCRNRSTN_PHPMailer->Body = $this->html_messageBulk[$email_experience_tracker];

                                    if(isset($this->text_messageBulk[$email_experience_tracker])){

                                        //
                                        // PROCESS DYNAMIC CONTENT
                                        if(isset($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker])){

                                            $this->text_messageBulk[$email_experience_tracker] = str_replace($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['content'], $this->text_messageBulk[$email_experience_tracker]);

                                        }

                                        $oCRNRSTN_PHPMailer->AltBody = $this->text_messageBulk[$email_experience_tracker];

                                        self::$oCRNRSTN_n->error_log('oGabriel BULK [MULTIPART] Body LENGTH = '.strlen($oCRNRSTN_PHPMailer->Body).'| AltBody(text version) LENGTH = '.strlen($oCRNRSTN_PHPMailer->AltBody), __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                                    }else{

                                        self::$oCRNRSTN_n->error_log('oGabriel BULK [HTML ONLY] Body LENGTH = '.strlen($oCRNRSTN_PHPMailer->Body), __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                                    }

                                }else{

                                    //
                                    // NO HTML BODY. ATTEMPT GRACEFUL DEGRADATION TO TEXT VERSION (AltBody).
                                    if(isset($this->text_messageBulk[$email_experience_tracker])){

                                        //
                                        // PROCESS DYNAMIC CONTENT
                                        if(isset($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker])){

                                            $this->text_messageBulk[$email_experience_tracker] = str_replace($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['content'], $this->text_messageBulk[$email_experience_tracker]);

                                        }

                                        $oCRNRSTN_PHPMailer->Body = $this->text_messageBulk[$email_experience_tracker];

                                        self::$oCRNRSTN_n->error_log('oGabriel BULK Body (text version) LENGTH = '.strlen($oCRNRSTN_PHPMailer->Body), __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                                    }else{

                                        //
                                        // HOOOSTON...VE HAF PROBLEM!
                                        throw new Exception('No message body has been provided via either oCRNRSTN_USR->addBody() or oCRNRSTN_USR->addAltBody().');

                                    }

                                }

                            }else{

                                //
                                // isHTML = FALSE
                                self::$oCRNRSTN_n->error_log('oGabriel BULK IsHTML = FALSE', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                                if(isset($this->text_messageBulk[$email_experience_tracker])){

                                    //
                                    // PROCESS DYNAMIC CONTENT
                                    if(isset($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker])){

                                        $this->text_messageBulk[$email_experience_tracker] = str_replace($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['content'], $this->text_messageBulk[$email_experience_tracker]);

                                    }

                                    $oCRNRSTN_PHPMailer->Body = $this->text_messageBulk[$email_experience_tracker];

                                    self::$oCRNRSTN_n->error_log('oGabriel BULK [TEXT VERSION] Body = '.strlen($oCRNRSTN_PHPMailer->Body), __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                                }else{

                                    //
                                    // HOOOSTON...VE HAF PROBLEM!
                                    throw new Exception('No message body has been provided via either oCRNRSTN_USR->addBody() or oCRNRSTN_USR->addAltBody().');

                                }
                            }

                            if(isset($this->subject_lineBulk[$email_experience_tracker])){

                                //
                                // PROCESS DYNAMIC CONTENT
                                if(isset($this->dynamic_content_SUBJECT_ARRAY[$email_experience_tracker])){

                                    $this->subject_lineBulk[$email_experience_tracker] = str_replace($this->dynamic_content_SUBJECT_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_SUBJECT_ARRAY[$email_experience_tracker]['content'], $this->subject_lineBulk[$email_experience_tracker]);

                                }

                                $oCRNRSTN_PHPMailer->Subject = trim($this->subject_lineBulk[$email_experience_tracker]);

                                self::$oCRNRSTN_n->error_log('oGabriel BULK Subject [' . $i.'] = ' . $oCRNRSTN_PHPMailer->Subject, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                            }

                            break;
                        default:

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('Unknown bulk or single indicator,"' . $bulk_single_indicator.'" received.');

                            break;
                    }

                    self::$oCRNRSTN_n->error_log('[' . $i.'] oGabriel BULK - Returning FULLY EMAIL, CONNECTION and CONTENT CHARGED oCRNRSTN_PHPMailer to the oArray().', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                    self::$oCRNRSTN_PHPMailer_ARRAY[$i] = $oCRNRSTN_PHPMailer;

                }

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No instances of the oCRNRSTN_PHPMailer class object could be found for their connectivity initialization.');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;
        }

        return true;

    }

    public function sendStatusReportEmail($recipient_email, $recipient_name){

        self::$oCRNRSTN_n->error_log('Trigger status report email to ' . $recipient_name.' at '.self::$oCRNRSTN_n->string_sanitize($recipient_email, 'email_private').'.', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

    }

    private function clean_system_email($email_str){

        $email_str = trim(strtolower($email_str));

        return $email_str;

    }

    private function clean_system_email_comma_delimited($email_str, $key_by_index = false, $keep_raw = true){

        $output_email_array = array();

        $tmp_array = explode(',', $email_str);
        $tmp_email_cnt = sizeof($tmp_array);

        if($keep_raw){

            if($key_by_index){

                for($i=0; $i<$tmp_email_cnt; $i++) {

                    //
                    // THIS WILL REMOVE ALL DUPLICATES
                    $output_email_array['RAW'][trim($tmp_array[$i])] = 1;
                    $output_email_array['SYS_FORMATTED'][trim(strtolower($tmp_array[$i]))] = 1;

                }

            }else{

                for($i=0; $i<$tmp_email_cnt; $i++) {

                    $output_email_array['RAW'][] = trim($tmp_array[$i]);
                    $output_email_array['SYS_FORMATTED'][] = trim(strtolower($tmp_array[$i]));

                }

            }

        }else{

            if($key_by_index){

                for($i=0; $i<$tmp_email_cnt; $i++) {

                    //
                    // THIS WILL REMOVE ALL DUPLICATES
                    $output_email_array['SYS_FORMATTED'][trim(strtolower($tmp_array[$i]))] = 1;

                }

            }else{

                for($i=0; $i<$tmp_email_cnt; $i++) {

                    $output_email_array['SYS_FORMATTED'][] = trim(strtolower($tmp_array[$i]));

                }

            }

        }

        return $output_email_array;

    }

    public function return_CRNRSTN_SysMsgHTMLBody($msgType){

        try{

            switch($msgType){
                case 'ELECTRUM_PERFORMANCE_REPORT':

                    $tmp_body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    '.self::$oCRNRSTN_n->return_creative('CRNRSTN_FAVICON').'
    <title>CRNRSTN ::</title>
</head>

<body style="background-color: #FFF; width:100%; text-align: center; margin:0px auto;">
<table cellpadding="0" cellspacing="0" border="0" width="810" style="width:810px; text-align: center; margin:0px auto;">
    <tr>
        <td><div style="line-height:13px; font-size:12px;">&nbsp;<br>&nbsp;</div></td>
    </tr>
    <tr>
        <td>

            <table cellpadding="0" cellspacing="0" border="0" width="800" style="width:800px; background-color: #FFF; text-align: center; margin:0px auto;">
                <tr><td style="text-align: left;"><div style="border-top: 10px solid #FFF;border-left: 15px solid #FFF;border-bottom: 10px solid #FFF;">{SYS_LOG_INTEGER_CONSTANT}</div></td></tr>
                <tr><td>

                    <table cellpadding="0" cellspacing="0" border="0" width="800" style="width:800px; border:2px solid #D2D2D2;">
                        <tr>
                            <td>
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tr>
                                        <td colspan="2">
                                            <table>
                                                <tr>
                                                    <td style="width:180px;"><div style="border-top: 10px solid #FFF;border-left: 10px solid #FFF;">'.self::$oCRNRSTN_n->return_creative('CRNRSTN_LOGO', CRNRSTN_UI_IMG_PNG_HTML_WRAPPED).'</div></td>
                                                    <td valign="top" align="right" style="text-align:right;">
                                                        <table cellpadding="0" cellspacing="0" border="0" width="610" style="border-bottom:10px solid #FFF; border-right: 10px solid #FFF; text-align: right;">
                                                            <tr>
                                                                <td align="right" style="text-align: right;">
                                                                    <div style="border-top:15px solid #FFF; font-family:Arial, Helvetica, sans-serif; font-size:25px; text-align:right;font-weight: bold;">{SYS_MESSAGE_TITLE_HTML}</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="right" style="text-align: right;">
                                                                    <div style="border-top:10px solid #FFF; font-family:Arial, Helvetica, sans-serif; font-size:14px;text-align:right; font-weight: bold;">Sending IP Address<br><div style="font-weight: normal; border-top: 4px solid #FFF;">{SYS_REMOTE_ADDR} (<a href="http://{SYS_SERVER_NAME}" target="_blank" style="text-decoration: none; color:#06C; text-decoration: underline;">{SYS_SERVER_NAME}</a>)</div></div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="right" style="text-align: right;">
                                                                    <div style="border-top:10px solid #FFF; font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:right; font-weight: bold;">System Timestamp / Process Runtime<br><div style="font-weight: normal; border-top: 4px solid #FFF;">{SYS_SYSTEM_TIME} / {PROCESS_RUN_TIME} seconds</div></div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td colspan="2" style="border:2px solid #F90000;" valign="top">
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                <tr>
                                                    <td align="left" style="text-align: left;">
                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:19px; border-top:10px solid #FFF; border-bottom:10px solid #FFF; border-left:15px solid #FFF; border-right:15px solid #FFF; line-height:30px;">
                                                            {SYS_MESSAGE_HTML}
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="background-color: #3A3A3A;">
                                            <div style="border-left:15px solid #3A3A3A; border-top:15px solid #3A3A3A; border-bottom:15px solid #3A3A3A; color:#FFF; font-weight: bold; font-family: Arial, Helvetica, sans-serif; font-size:23px; text-align:left;">Electrum &ndash; Performance Overview</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="border-left:15px solid #FFF; border-top:10px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; text-align:left;">Start Time :: {START_TIME}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="border-left:15px solid #FFF; border-top:10px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; text-align:left;">End Time :: {END_TIME}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="border-left:15px solid #FFF; border-top:10px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; text-align:left;">Total Run Time :: {PRETTY_RUN_TIME}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="border-left:15px solid #FFF; border-top:10px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; text-align:left;">Count of assets valid for transfer :: {TOTAL_COUNT_VALID_FOR_TRANSFER}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="border-left:15px solid #FFF; border-top:10px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; text-align:left;">Count of assets excluded :: {TOTAL_COUNT_FILES_SKIPPED}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="border-left:15px solid #FFF; border-top:10px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; text-align:left;">Number of endpoints for asset reception :: {TOTAL_COUNT_DESTINATION_ENDPOINTS}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="border-left:15px solid #FFF; border-top:10px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; text-align:left;">Total count of asset transfer movements :: {TOTAL_COUNT_FILES_TRANSFERRED}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="border-left:15px solid #FFF; border-top:10px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; text-align:left;">Total volume of data transferred :: {TOTAL_FILESIZE_FILES_TRANSFERRED}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="border-left:15px solid #FFF; border-top:10px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; text-align:left;">Avg vol sent to each destination :: {ENDPOINT_FILESIZE_FILES_TRANSFERRED}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="border-left:15px solid #FFF; border-top:10px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; text-align:left;">Number of asset transfer errors experienced :: {TOTAL_ERRORS_FILES_TRANSFERRED}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="border-left:15px solid #FFF; border-top:10px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; text-align:left;">Number of endpoint connection errors experienced :: {TOTAL_COUNT_ENDPOINT_CONNECTION_ERROR}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="border-left:15px solid #FFF; border-top:10px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; text-align:left;">Percentage of assets successfully transferred :: {PERCENTAGE_FILES_SUCCESSFUL_TRANSFERRED}</div>
                                        </td>
                                    </tr>
                                    <tr><td><div style="font-size: 12px; line-height: 14px;">&nbsp;</div></td></tr>
                                    <tr>
                                        <td style="background-color: #3A3A3A;">
                                            <div style="border-left:15px solid #3A3A3A; border-top:15px solid #3A3A3A; border-bottom:15px solid #3A3A3A; color:#FFF; font-weight: bold; font-family: Arial, Helvetica, sans-serif; font-size:23px; text-align:left;">Data Sources</div>
                                        </td>
                                    </tr>
                                    {ELECTRUM_DATA_SOURCE_HTML}
                                    <tr><td><div style="font-size: 12px; line-height: 14px;">&nbsp;</div></td></tr>
                                    <tr>
                                        <td style="background-color: #3A3A3A;">
                                            <div style="border-left:15px solid #3A3A3A; border-top:15px solid #3A3A3A; border-bottom:15px solid #3A3A3A; color:#FFF; font-weight: bold; font-family: Arial, Helvetica, sans-serif; font-size:23px; text-align:left;">Electrum &ndash; Data Source Exclusions</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {ELECTRUM_DATA_HANDLING_PROFILE_HTML}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="background-color: #3A3A3A">
                                            <div style="border-left:15px solid #3A3A3A; border-top:15px solid #3A3A3A; border-bottom:15px solid #3A3A3A; color:#FFF; font-weight: bold; font-family: Arial, Helvetica, sans-serif; font-size:23px; text-align:left;">Data Destinations</div>
                                        </td>
                                    </tr>
                                    {ELECTRUM_DATA_DESTINATION_HTML}
                                    {ELECTRUM_ERRORS_TRACE_HTML}
                                    <tr>
                                        <td><span style="font-size: 5px; line-height: 8px;">&nbsp;</span></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:center; border-top:2px solid #D2D2D2; border-bottom:2px solid #D2D2D2;">
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tr>
                                        <td align="center"><div style="font-family:Arial, Helvetica, sans-serif; color:#333; font-size:12px; text-align:center; margin:0px auto; line-height: 18px; border-top:10px solid #FFF; border-bottom:10px solid #FFF;">&copy; '.date('Y').' Jonathan J5 Harris,<br><em>All Rights Reserved in accordance with the most recent version of the MIT License.</em></div></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>

                            <td>
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tr>
                                        <td valign="top" align="left" style="text-align: left; width: 633px;">

                                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                <tr>
                                                    <td style="text-align: left; border-left:20px solid #FFF; border-right:8px solid #FFF; border-top:30px solid #FFF;">
                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight: normal; line-height: 20px;">Please note that this information may 
                                                            not have been saved anywhere. For this reason, it 
                                                            may be good to maintain a copy of this email.</div>

                                                        <div style="font-size:14px; line-height: 16px;">&nbsp;<br>&nbsp;<br></div>

                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight: normal; line-height: 20px;">This email was sent to {EMAIL}.<br>
                                                            If you wish to unsubscribe from future 
                                                            system notifications, please contact the 
                                                            website administrator.</div>

                                                    </td>
                                                </tr>
                                            </table>

                                        </td>
                                        <td align="right" style="text-align:right; border-top:10px solid #FFF; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight: normal;">
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                <tr><td style="text-align: right;">'.self::$oCRNRSTN_n->return_creative('J5_WOLF_PUP_RAND', CRNRSTN_UI_IMG_PNG_HTML_WRAPPED).'</td></tr></table>
                                        </td>
                                    </tr>
                                </table>

                            </td>
                        </tr>
                    </table>

                </td></tr>
            </table>

        </td>
    </tr>
    <tr>

        <td><div style="font-size:14px; line-height: 16px;">&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br></div></td>
    </tr>
</table>
</body>
</html>';

                    break;
                case 'EXCEPTION_NOTIFICATION':

                    $tmp_body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    '.self::$oCRNRSTN_n->return_creative('CRNRSTN_FAVICON', CRNRSTN_UI_IMG_PNG_HTML_WRAPPED).'
    <title>CRNRSTN ::</title>
</head>

<body style="background-color: #FFF; width:100%; text-align: center; margin:0px auto;">
<table cellpadding="0" cellspacing="0" border="0" width="810" style="width:810px; text-align: center; margin:0px auto;">
    <tr>
        <td><div style="line-height:13px; font-size:12px;">&nbsp;<br>&nbsp;</div></td>
    </tr>
    <tr>
        <td>

            <table cellpadding="0" cellspacing="0" border="0" width="800" style="width:800px; background-color: #FFF; text-align: center; margin:0px auto;">
                <tr><td style="text-align: left;"><div style="border-top: 10px solid #FFF;border-left: 15px solid #FFF;border-bottom: 10px solid #FFF;">{SYSTEM_LOG_INTEGER_CONSTANT}</div></td></tr>
                <tr><td>

                    <table cellpadding="0" cellspacing="0" border="0" width="800" style="width:800px; border:2px solid #D2D2D2;">
                        <tr>
                            <td>
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tr>
                                        <td colspan="2">
                                            <table>
                                                <tr>
                                                    <td style="width:180px;"><div style="border-top: 10px solid #FFF;border-left: 10px solid #FFF;">'.self::$oCRNRSTN_n->return_creative('CRNRSTN_LOGO', CRNRSTN_UI_IMG_PNG_HTML_WRAPPED).'</div></td>
                                                    <td valign="top" align="right" style="text-align:right;">
                                                        <table cellpadding="0" cellspacing="0" border="0" width="610" style="border-bottom:10px solid #FFF; border-right: 10px solid #FFF; text-align: right;">
                                                            <tr>
                                                                <td align="right" style="text-align: right;">
                                                                <div style="border-top:15px solid #FFF; font-family:Arial, Helvetica, sans-serif; font-size:25px; text-align:right;font-weight: bold;">C<span style="font-family:Arial, Helvetica, sans-serif; font-size:25px; color:#F90000;">R</span>NRSTN :: Exception Notification</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="right" style="text-align: right;">
                                                                    <div style="border-top:10px solid #FFF; font-family:Arial, Helvetica, sans-serif; font-size:14px;text-align:right; font-weight: bold;">Sending IP Address<br><div style="font-weight: normal; border-top: 4px solid #FFF;">' . $_SERVER['REMOTE_ADDR'].' (<a href="http://' . $_SERVER['SERVER_NAME'].'" target="_blank" style="text-decoration: none; color:#06C; text-decoration: underline;">' . $_SERVER['SERVER_NAME'].'</a>)</div></div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="right" style="text-align: right;">
                                                                    <div style="border-top:10px solid #FFF; font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:right; font-weight: bold;">System Timestamp / Process Runtime<br><div style="font-weight: normal; border-top: 4px solid #FFF;">{SYSTEM_TIME} / {PROCESS_RUN_TIME} seconds</div></div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td colspan="2" style="border:2px solid #F90000;" valign="top">
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                <tr>
                                                    <td align="left" style="text-align: left;">
                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:19px; border-top:10px solid #FFF; border-bottom:10px solid #FFF; border-left:15px solid #FFF; border-right:15px solid #FFF; line-height:30px;">
                                                        {MESSAGE}
                                                        
                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:10px; border-bottom: 3px solid #A7C2E6; width:100%;"><br></div>
                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:16px; border-top:10px solid #FFF;"><strong>Class::Method (or file):</strong></div>
                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:16px;">{METHOD}</div>
                                                        
                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:16px; border-top:10px solid #FFF;"><strong>Line Number:</strong></div>
                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:16px;">{LINE_NUM}</div>
                                                        
                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:16px; border-top:10px solid #FFF;"><strong>PHP Native Trace:</strong></div>
                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:16px;">{PHP_TRACE}</div>
                                                      
                                                    </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="border-left:5px solid #FFF; border-right:5px solid #FFF;">

                                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                <tr>
                                                    <td align="left" style="text-align: left;">
                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:15px; border-top:10px solid #FFF; border-bottom:10px solid #FFF; border-left:12px solid #FFF; border-right:10px solid #FFF; line-height:18px;">
                                                            &nbsp;<br>
                                                            <span style="color: #F90000; font-weight: bold;">LOG TRACE</span><br><br>
                                                            <div style="font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:22px;">
                                                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                            {LOG_TRACE}
                                                            </table>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><span style="font-size: 5px; line-height: 8px;">&nbsp;</span></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:center; border-top:2px solid #D2D2D2; border-bottom:2px solid #D2D2D2;">
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tr>
                                        <td align="center"><div style="font-family:Arial, Helvetica, sans-serif; color:#333; font-size:12px; text-align:center; margin:0px auto; line-height: 18px; border-top:10px solid #FFF; border-bottom:10px solid #FFF;">&copy; '.date('Y').' Jonathan J5 Harris,<br><em>All Rights Reserved in accordance with the most recent version of the MIT License.</em></div></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>

                            <td>
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tr>
                                        <td valign="top" align="left" style="text-align: left; width: 633px;">

                                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                <tr>
                                                    <td style="text-align: left; border-left:20px solid #FFF; border-right:8px solid #FFF;  border-top:30px solid #FFF;">
                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight: normal; line-height: 20px;">Please note that this information may 
                                                            not have been saved anywhere. For this reason, it 
                                                            may be good to maintain a copy of this email.</div>

                                                        <div style="font-size:14px; line-height: 16px;">&nbsp;<br>&nbsp;<br></div>

                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight: normal; line-height: 20px;">This email was sent to {EMAIL}.<br>
                                                            If you wish to unsubscribe from future 
                                                            system notifications, please contact the 
                                                            website administrator.</div>

                                                    </td>
                                                </tr>
                                            </table>

                                        </td>
                                        <td align="right" style="text-align:right; border-top:10px solid #FFF; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight: normal;">
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                <tr><td style="text-align: right;">'.self::$oCRNRSTN_n->return_creative('J5_WOLF_PUP_RAND', CRNRSTN_UI_IMG_PNG_HTML_WRAPPED).'</td></tr></table>
                                        </td>
                                    </tr>
                                </table>

                            </td>
                        </tr>
                    </table>

                </td></tr>
            </table>

        </td>
    </tr>
    <tr>

        <td><div style="font-size:14px; line-height: 16px;">&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br></div></td>
    </tr>
</table>
</body>
</html>';

                    break;
                case 'EXCEPTION_NOTIFICATION::SOAP_TUNNEL':

                    $tmp_body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    '.self::$oCRNRSTN_n->return_creative('CRNRSTN_FAVICON', CRNRSTN_UI_IMG_SOAP_DATA_TUNNEL).'
    <title>CRNRSTN ::</title>
</head>

<body style="background-color: #FFF; width:100%; text-align: center; margin:0px auto;">
<table cellpadding="0" cellspacing="0" border="0" width="810" style="width:810px; text-align: center; margin:0px auto;">
    <tr>
        <td><div style="line-height:13px; font-size:12px;">&nbsp;<br>&nbsp;</div></td>
    </tr>
    <tr>
        <td>

            <table cellpadding="0" cellspacing="0" border="0" width="800" style="width:800px; background-color: #FFF; text-align: center; margin:0px auto;">
                <tr><td style="text-align: left;"><div style="border-top: 10px solid #FFF;border-left: 15px solid #FFF;border-bottom: 10px solid #FFF;">{SYSTEM_LOG_INTEGER_CONSTANT}</div></td></tr>
                <tr><td>

                    <table cellpadding="0" cellspacing="0" border="0" width="800" style="width:800px; border:2px solid #D2D2D2;">
                        <tr>
                            <td>
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tr>
                                        <td colspan="2">
                                            <table>
                                                <tr>
                                                    <td style="width:180px;"><div style="border-top: 10px solid #FFF;border-left: 10px solid #FFF;">'.self::$oCRNRSTN_n->return_creative('CRNRSTN_LOGO', CRNRSTN_UI_IMG_SOAP_DATA_TUNNEL).'</div></td>
                                                    <td valign="top" align="right" style="text-align:right;">
                                                        <table cellpadding="0" cellspacing="0" border="0" width="610" style="border-bottom:10px solid #FFF; border-right: 10px solid #FFF; text-align: right;">
                                                            <tr>
                                                                <td align="right" style="text-align: right;">
                                                                <div style="border-top:15px solid #FFF; font-family:Arial, Helvetica, sans-serif; font-size:25px; text-align:right;font-weight: bold;">C<span style="font-family:Arial, Helvetica, sans-serif; font-size:25px; color:#F90000;">R</span>NRSTN :: Exception Notification</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="right" style="text-align: right;">
                                                                    <div style="border-top:10px solid #FFF; font-family:Arial, Helvetica, sans-serif; font-size:14px;text-align:right; font-weight: bold;">Sending IP Address<br><div style="font-weight: normal; border-top: 4px solid #FFF;">' . $_SERVER['REMOTE_ADDR'].' (<a href="http://' . $_SERVER['SERVER_NAME'].'" target="_blank" style="text-decoration: none; color:#06C; text-decoration: underline;">' . $_SERVER['SERVER_NAME'].'</a>)</div></div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="right" style="text-align: right;">
                                                                    <div style="border-top:10px solid #FFF; font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:right; font-weight: bold;">System Timestamp / Process Runtime<br><div style="font-weight: normal; border-top: 4px solid #FFF;">{SYSTEM_TIME} / {PROCESS_RUN_TIME} seconds</div></div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td colspan="2" style="border:2px solid #F90000;" valign="top">
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                <tr>
                                                    <td align="left" style="text-align: left;">
                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:19px; border-top:10px solid #FFF; border-bottom:10px solid #FFF; border-left:15px solid #FFF; border-right:15px solid #FFF; line-height:30px;">
                                                        {MESSAGE}
                                                        
                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:10px; border-bottom: 3px solid #A7C2E6; width:100%;"><br></div>
                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:16px; border-top:10px solid #FFF;"><strong>Class::Method (or file):</strong></div>
                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:16px;">{METHOD}</div>
                                                        
                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:16px; border-top:10px solid #FFF;"><strong>Line Number:</strong></div>
                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:16px;">{LINE_NUM}</div>
                                                        
                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:16px; border-top:10px solid #FFF;"><strong>PHP Native Trace:</strong></div>
                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:16px;">{PHP_TRACE}</div>
                                                      
                                                    </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="border-left:5px solid #FFF; border-right:5px solid #FFF;">

                                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                <tr>
                                                    <td align="left" style="text-align: left;">
                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:15px; border-top:10px solid #FFF; border-bottom:10px solid #FFF; border-left:12px solid #FFF; border-right:10px solid #FFF; line-height:18px;">
                                                            &nbsp;<br>
                                                            <span style="color: #F90000; font-weight: bold;">LOG TRACE</span><br><br>
                                                            <div style="font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:22px;">
                                                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                            {LOG_TRACE}
                                                            </table>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><span style="font-size: 5px; line-height: 8px;">&nbsp;</span></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:center; border-top:2px solid #D2D2D2; border-bottom:2px solid #D2D2D2;">
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tr>
                                        <td align="center"><div style="font-family:Arial, Helvetica, sans-serif; color:#333; font-size:12px; text-align:center; margin:0px auto; line-height: 18px; border-top:10px solid #FFF; border-bottom:10px solid #FFF;">&copy; '.date('Y').' Jonathan J5 Harris,<br><em>All Rights Reserved in accordance with the most recent version of the MIT License.</em></div></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>

                            <td>
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tr>
                                        <td valign="top" align="left" style="text-align: left; width: 633px;">

                                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                <tr>
                                                    <td style="text-align: left; border-left:20px solid #FFF; border-right:8px solid #FFF; border-top:30px solid #FFF;">
                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight: normal; line-height: 20px;">Please note that this information may 
                                                            not have been saved anywhere. For this reason, it 
                                                            may be good to maintain a copy of this email.</div>

                                                        <div style="font-size:14px; line-height: 16px;">&nbsp;<br>&nbsp;<br></div>

                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight: normal; line-height: 20px;">This email was sent to {EMAIL}.<br>
                                                            If you wish to unsubscribe from future 
                                                            system notifications, please contact the 
                                                            website administrator.</div>

                                                    </td>
                                                </tr>
                                            </table>

                                        </td>
                                        <td align="right" style="text-align:right; border-top:10px solid #FFF; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight: normal;">
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                <tr><td style="text-align: right;">'.self::$oCRNRSTN_n->return_creative('J5_WOLF_PUP_RAND', CRNRSTN_UI_IMG_SOAP_DATA_TUNNEL).'</td></tr></table>
                                        </td>
                                    </tr>
                                </table>

                            </td>
                        </tr>
                    </table>

                </td></tr>
            </table>

        </td>
    </tr>
    <tr>

        <td><div style="font-size:14px; line-height: 16px;">&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br></div></td>
    </tr>
</table>
</body>
</html>';
                    break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Unknown HTML message body, "' . $msgType.'", requested.');

                    break;
            }

            return $tmp_body;

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }


    }

    public function return_CRNRSTN_SysMsgTEXTBody($msgType){

        try{

            switch($msgType){
                case 'ELECTRUM_PERFORMANCE_REPORT':

                    $tmp_body = '{SYS_MESSAGE_TITLE_TEXT}
= = = = = = = = = = = = = = = = = = = = = = = = =
{SYS_LOG_INTEGER_CONSTANT}

SYSTEM MESSAGE ::
{SYS_MESSAGE_TEXT}

= = = = = = = = = = = = = = = = = = = = = = = = =
Sending IP Address ::
{SYS_REMOTE_ADDR} ({SYS_SERVER_NAME})

System Timestamp ::
{SYS_SYSTEM_TIME}

Process Runtime ::
{PROCESS_RUN_TIME} seconds

= = = = = = = = = = = = = = = = = = = = = = = = =
Electrum - Performance Overview
Start Time :: {START_TIME}
End Time :: {END_TIME}
Total Run Time :: {PRETTY_RUN_TIME}
Count of assets valid for transfer :: {TOTAL_COUNT_VALID_FOR_TRANSFER}
Count of assets excluded :: {TOTAL_COUNT_FILES_SKIPPED}
Number of endpoints for asset reception :: {TOTAL_COUNT_DESTINATION_ENDPOINTS}
Total count of asset transfer movements :: {TOTAL_COUNT_FILES_TRANSFERRED}
Total volume of data transferred :: {TOTAL_FILESIZE_FILES_TRANSFERRED}
Avg vol sent to each destination :: {ENDPOINT_FILESIZE_FILES_TRANSFERRED}
Number of asset transfer errors experienced :: {TOTAL_ERRORS_FILES_TRANSFERRED}
Number of endpoint connection errors experienced :: {TOTAL_COUNT_ENDPOINT_CONNECTION_ERROR}
Percentage of assets successfully transferred :: {PERCENTAGE_FILES_SUCCESSFUL_TRANSFERRED}

= = = = = = = = = = = = = = = = = = = = = = = = =
Data Sources
{ELECTRUM_DATA_SOURCE_TEXT}

= = = = = = = = = = = = = = = = = = = = = = = = =
Electrum - Data Source Exclusions
{ELECTRUM_DATA_HANDLING_PROFILE_TEXT}

= = = = = = = = = = = = = = = = = = = = = = = = =
Data Destinations
{ELECTRUM_DATA_DESTINATION_TEXT}

{ELECTRUM_ERRORS_TRACE_TEXT}
= = = = = = = = = = = = = = = = = = = = = = = = =
(c) '.date('Y').' Jonathan J5 Harris,
All Rights Reserved in accordance with the most
recent version of the MIT License.

= = = = = = = = = = = = = = = = = = = = = = = = =
Please note that this information may
not have been saved anywhere. For this reason, it
may be good to maintain a copy of this email.


This email was sent to {EMAIL}.
If you wish to unsubscribe from future
system notifications, please contact the
website administrator.
';

                    break;
                case 'EXCEPTION_NOTIFICATION':

                    $tmp_body = 'CRNRSTN :: Exception Notification
= = = = = = = = = = = = = = = = = = = = = = = = =
{SYSTEM_LOG_INTEGER_CONSTANT}

SYSTEM MESSAGE  ::
{MESSAGE}

LINE NUMBER ::
{LINE_NUM}

CLASS::METHOD (or file) ::
{METHOD}

PHP NATIVE TRACE ::
{PHP_TRACE}
= = = = = = = = = = = = = = = = = = = = = = = = =
Sending IP Address ::
' . $_SERVER['REMOTE_ADDR'].' (' . $_SERVER['SERVER_NAME'].')

System Timestamp ::
{SYSTEM_TIME}

Process Runtime ::
{PROCESS_RUN_TIME} seconds

= = = = = = = = = = = = = = = = = = = = = = = = =
(c) '.date('Y').' Jonathan J5 Harris,
All Rights Reserved in accordance with the most
recent version of the MIT License.

= = = = = = = = = = = = = = = = = = = = = = = = =
Please note that this information may
not have been saved anywhere. For this reason, it
may be good to maintain a copy of this email.


This email was sent to {EMAIL}.
If you wish to unsubscribe from future
system notifications, please contact the
website administrator.

= = = = = = = = = = = = = = = = = = = = = = = = =
LOG TRACE

{LOG_TRACE}

';


                    break;
                case 'EXCEPTION_NOTIFICATION::SOAP_TUNNEL':

                    $tmp_body = 'CRNRSTN :: Exception Notification
= = = = = = = = = = = = = = = = = = = = = = = = =
{SYSTEM_LOG_INTEGER_CONSTANT}

SYSTEM MESSAGE  ::
{MESSAGE}

LINE NUMBER ::
{LINE_NUM}

CLASS::METHOD (or file) ::
{METHOD}

PHP NATIVE TRACE ::
{PHP_TRACE}
= = = = = = = = = = = = = = = = = = = = = = = = =
Sending IP Address ::
' . $_SERVER['REMOTE_ADDR'].' (' . $_SERVER['SERVER_NAME'].')

System Timestamp ::
{SYSTEM_TIME}

Process Runtime ::
{PROCESS_RUN_TIME} seconds

= = = = = = = = = = = = = = = = = = = = = = = = =
(c) '.date('Y').' Jonathan J5 Harris,
All Rights Reserved in accordance with the most
recent version of the MIT License.

= = = = = = = = = = = = = = = = = = = = = = = = =
Please note that this information may
not have been saved anywhere. For this reason, it
may be good to maintain a copy of this email.


This email was sent to {EMAIL}.
If you wish to unsubscribe from future
system notifications, please contact the
website administrator.

= = = = = = = = = = = = = = = = = = = = = = = = =
LOG TRACE

{LOG_TRACE}

';
                    break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Unknown TEXT message body, "' . $msgType.'", requested.');

                    break;

            }

            return $tmp_body;

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }


    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resource_key The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     * [EMAIL, FILE, SCREEN_TEXT, SCREEN|SCREEN_HTML, SCREEN_HTML_HIDDEN, DEFAULT]
     * LIVE WIRE
     */
    private function error_log($str, $line_num = NULL, $method = NULL, $file = NULL, $log_silo_key=NULL){

//        $tmp_oLog = $this->oLogger->error_log($str, $line_num, $method, $file, $log_silo_key, $this);
//
//        if(is_object($tmp_oLog)){
//
//            $this->oLog_output_ARRAY[] = $tmp_oLog;
//
//        }
//
//        return true;
        //
        // Thursday, August 18, 2022 @ 0224 hrs
        return $this->oCRNRSTN->error_log($str, $line_num, $method, $file, $log_silo_key);

    }

    private function catch_exception($exception_obj, $syslog_constant=LOG_DEBUG, $method=NULL, $namespace=NULL, $profile_override_pipe=NULL, $endpoint_override_pipe=NULL, $wcr_override_pipe=NULL){

        $tmp_err_trace_str = $this->return_PHP_exception_trace_pretty($exception_obj->getTraceAsString());

        if(strlen($tmp_err_trace_str)>0){

            self::$oCRNRSTN_n->error_log('PHP native exception output log trace received ::' . $tmp_err_trace_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

        }

        //
        // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
        $this->oLogger->catch_exception($exception_obj, $syslog_constant, $method, $namespace, $profile_override_pipe, $endpoint_override_pipe, $wcr_override_pipe, self::$oCRNRSTN_n);

    }

    private function return_PHP_exception_trace_pretty($exception_obj_trace_str, $format = 'ERROR_LOG'){

        switch($format){
            case 'HTML':

                $exception_obj_trace_str = $this->proper_replace('\n', '<br>', $exception_obj_trace_str);
                $exception_obj_trace_str = $this->proper_replace('
', '<br>', $exception_obj_trace_str);

                break;
            case 'TEXT':

                $exception_obj_trace_str = $this->proper_replace('\n', '
', $exception_obj_trace_str);

                break;
            default:

                //
                // DO NOTHING :: STRAIGHT UNPROCESSED PHP NATIVE OUT


                break;

        }

        return $exception_obj_trace_str;

    }

    private function proper_replace($pattern, $replacement, $original_str){

        $pattern_array[0] = $pattern;
        $replacement_array[0] = $replacement;

        $original_str = str_replace($pattern_array, $replacement_array, $original_str);

        return $original_str;

    }

    public function __destruct() {

    }
}

# # C # R # N # R # S # T # N # : : # # ##
#
#  CLASS :: crnrstn_highway_of_the_king
#  VERSION :: 1.00.0000
#  DATE :: September 21, 2020 @ 2230hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI ::
#  DESCRIPTION :: The straightest path to email delivery (make someone else send it)!
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_highway_of_the_king{

    protected $oLogger;
    private static $oCRNRSTN_USR;

    protected $proxy_cipher_override;
    protected $proxy_secret_key_override;
    protected $proxy_hmac_algorithm_override;
    protected $proxy_options_bitwise_override;

    protected $sender_email;
    protected $sender_name;
    protected $recipient_email;
    protected $recipient_name;

    protected $replyto_email_ARRAY = array();
    protected $replyto_name_ARRAY = array();
    protected $cc_email_ARRAY = array();
    protected $cc_name_ARRAY = array();
    protected $bcc_email_ARRAY = array();
    protected $bcc_name_ARRAY = array();

    public $Priority = 3;
    public $WordWrap = 72;
    public $is_HTML = false;
    public $Body;
    public $AltBody;
    public $Subject;

    public function __construct($oCRNRSTN_USR){

        self::$oCRNRSTN_n = $oCRNRSTN_USR;

    }

    public function setFrom($sender_email, $sender_name){

        $this->sender_email = $sender_email;
        $this->sender_name = $sender_name;

    }

    #1428
    public function addAddress($email, $name){

        $this->recipient_email = $email;
        $this->recipient_name = $name;

    }

    public function addReplyTo($replyto_email, $replyto_name){

        $this->replyto_email_ARRAY[] = $replyto_email;
        $this->replyto_name_ARRAY[] = $replyto_name;

    }

    #1450
    public function addCC($cc_email, $cc_name){

        $this->cc_email_ARRAY[] = $cc_email;
        $this->cc_name_ARRAY[] = $cc_name;

    }

    public function addBCC($bcc_email, $bcc_name){

        $this->bcc_email_ARRAY[] = $bcc_email;
        $this->bcc_name_ARRAY[] = $bcc_name;

    }

    public function return_cipher(){

        return $this->proxy_cipher_override;

    }

    public function return_secret_key(){

        return $this->proxy_secret_key_override;

    }

    public function return_hmac_algorithm(){

        return $this->proxy_hmac_algorithm_override;

    }

    public function return_options_bitwise(){

        return $this->proxy_options_bitwise_override;

    }

    /*
    public function send($proxy_endpoint_uri, $proxy_endpoint_auth_key, $proxy_cipher_override=NULL, $proxy_secret_key_override=NULL, $proxy_hmac_algorithm_override=NULL, $proxy_options_bitwise_override=NULL){

        $this->proxy_cipher_override = $proxy_cipher_override;
        $this->proxy_secret_key_override = $proxy_secret_key_override;
        $this->proxy_hmac_algorithm_override = $proxy_hmac_algorithm_override;
        $this->proxy_options_bitwise_override = $proxy_options_bitwise_override;

        //
        // ASSEMBLE REQUEST AND SEND
        $cc_email_str = '';
        $cc_name_str = '';
        $bcc_email_str = '';
        $bcc_name_str = '';
        $replyto_email_str = '';
        $replyto_name_str = '';

        if(isset($this->cc_email_ARRAY)){
            $tmp_cnt = sizeof($this->cc_email_ARRAY);
            for($i=0; $i<$tmp_cnt; $i++){

                $cc_email_str .= $this->cc_email_ARRAY[$i].',';
                $cc_name_str .= $this->cc_name_ARRAY[$i].',';

            }

            $cc_email_str = rtrim($cc_email_str, ',');
            $cc_name_str = rtrim($cc_name_str, ',');

        }

        if(isset($this->bcc_email_ARRAY)){
            $tmp_cnt = sizeof($this->bcc_email_ARRAY);
            for($i=0; $i<$tmp_cnt; $i++){

                $bcc_email_str .= $this->bcc_email_ARRAY[$i].',';
                $bcc_name_str .= $this->bcc_name_ARRAY[$i].',';

            }

            $bcc_email_str = rtrim($bcc_email_str, ',');
            $bcc_name_str = rtrim($bcc_name_str, ',');

        }

        if(isset($this->replyto_email_ARRAY)){
            $tmp_cnt = sizeof($this->replyto_email_ARRAY);
            for($i=0; $i<$tmp_cnt; $i++){

                $replyto_email_str .= $this->replyto_email_ARRAY[$i].',';
                $replyto_name_str .= $this->replyto_name_ARRAY[$i].',';

            }

            $replyto_email_str = rtrim($replyto_email_str, ',');
            $replyto_name_str = rtrim($replyto_name_str, ',');

        }

        //
        // NEW WILD CARD RESOURCE - FTP
        $oWCR = self::$oCRNRSTN_n->define_wildcard_resource('THE_KINGS_HIGHWAY_oGABRIEL_NOTIFICATION');
        $oWCR->addAttribute('CRNRSTN_SOAP_SVC_AUTH_KEY', $proxy_endpoint_auth_key);
        $oWCR->addAttribute('CRNRSTN_PROXY_WSDL_ENDPOINT', 'http://v2.crnrstn.evifweb.com/');
        $oWCR->addAttribute('RECIPIENT_EMAIL_COMMA_DELIM', $this->recipient_email);
        $oWCR->addAttribute('RECIPIENT_NAME_COMMA_DELIM', $this->recipient_name);
        $oWCR->addAttribute('FROM_EMAIL', $this->sender_email);
        $oWCR->addAttribute('FROM_NAME', $this->sender_name);
        $oWCR->addAttribute('REPLY_TO_EMAIL_COMMA_DELIM', $replyto_email_str);
        $oWCR->addAttribute('REPLY_TO_NAME_COMMA_DELIM', $replyto_name_str);
        $oWCR->addAttribute('CC_EMAIL_COMMA_DELIM', $cc_email_str);
        $oWCR->addAttribute('CC_NAME_COMMA_DELIM', $cc_name_str);
        $oWCR->addAttribute('BCC_EMAIL_COMMA_DELIM', $bcc_email_str);
        $oWCR->addAttribute('BCC_NAME_COMMA_DELIM', $bcc_name_str);
        $oWCR->addAttribute('MESSAGE_SUBJECT', $this->Subject);
        $oWCR->addAttribute('MESSAGE_BODY_HTML', $this->Body);
        $oWCR->addAttribute('MESSAGE_BODY_TEXT', $this->AltBody);
        $oWCR->addAttribute('WORDWRAP', $this->WordWrap);
        $oWCR->addAttribute('PRIORITY', $this->Priority);
        if($this->is_HTML){

            $oWCR->addAttribute('IS_HTML', 'true');

        }else{

            $oWCR->addAttribute('IS_HTML', 'false');

        }

        self::$oCRNRSTN_n->save_wildcard_resource($oWCR);

        $endpoint_URI = self::$oCRNRSTN_n->get_resource('CRNRSTN_PROXY_WSDL_ENDPOINT');
        return self::$oCRNRSTN_n->proxyEmailFire('THE_KINGS_HIGHWAY_oGABRIEL_NOTIFICATION', $endpoint_URI, $this);

    }
    */

    public function __destruct(){

    }

}

# # C # R # N # R # S # T # N # : : # # ##
#
#  CLASS :: crnrstn_communications_css_standard
#  VERSION :: 1.00.0000
#  DATE :: March 23, 2021 @ 0541hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI ::
#  DESCRIPTION :: HTML CSS element definitions, validation logics, and output reporting.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/

class crnrstn_communications_css_standard{

    protected $oLogger;
    protected $oCRNRSTN_USR;

    private static $email_rendering_client_ARRAY = array();

    public $desktop_mail_client_ARRAY = array();
    public $web_mail_client_ARRAY = array();
    public $mobile_mail_client_ARRAY = array();

    public $email_client_score_ARRAY = array();

    public $css_pattern_meta_nomination_ARRAY = array();
    public $css_pattern_meta_description_ARRAY = array();
    public $css_pattern_meta_note_ARRAY = array();
    public $css_pattern_meta_docs_uri_ARRAY = array();
    protected $css_pattern_meta_nomination_FLAG_ARRAY = array();

    protected $output_mode;
    protected $raw_data;
    protected $raw_data_LOWER;
    protected $raw_data_PACKED;

    protected $desktop_mail_CONST_ARRAY = array();
    protected $web_mail_CONST_ARRAY = array();
    protected $mobile_mail_CONST_ARRAY = array();

    protected $redundant_css_nom_ARRAY = array();
    protected $validation_results_ARRAY = array();
    protected $results_count_aggregation_ARRAY = array();
    protected $results_summary_aggregate_ARRAY = array();

    protected $grading_curve = 51.00000;
    public $output_string_ARRAY = array();

    public function __construct($oCRNRSTN_USR, $raw_html_data = NULL, $output_mode = 'HTML_PAGE'){

        $this->oCRNRSTN_USR = $oCRNRSTN_USR;

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN_USR);

        $this->output_string_ARRAY['str'] = '';

        //
        // ITEMS WITH MORE THAN ONE OCCURRENCE
        $this->redundant_css_nom_ARRAY[] = 'max-height';
        $this->redundant_css_nom_ARRAY[] = 'max-width';
        $this->redundant_css_nom_ARRAY[] = 'min-height';
        $this->redundant_css_nom_ARRAY[] = 'min-width';
        $this->redundant_css_nom_ARRAY[] = 'display';
        $this->redundant_css_nom_ARRAY[] = 'align-items';
        $this->redundant_css_nom_ARRAY[] = 'align-self';
        $this->redundant_css_nom_ARRAY[] = 'align-content';
        $this->redundant_css_nom_ARRAY[] = 'justify-content';

        $this->output_mode = $output_mode;
        $this->raw_data = $raw_html_data;
        $this->raw_data_LOWER = strtolower($raw_html_data);
        $this->raw_data_PACKED = $this->oCRNRSTN_USR->proper_replace(' ', '', $this->raw_data_LOWER);

        //
        // LET'S DEFINE SOME CONSTANTS FOR THIS CLASS OBJECT.
        @define('CRNRSTN_MAIL_CLIENT_DESKTOP', (int) $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_MAIL_CLIENT_DESKTOP'));
        @define('CRNRSTN_MAIL_CLIENT_MOBILE', (int) $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_MAIL_CLIENT_MOBILE'));
        @define('CRNRSTN_MAIL_CLIENT_WEB', (int) $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_MAIL_CLIENT_WEB'));
        @define('CRNRSTN_CSS_VALIDATE_NONE', (int) $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_VALIDATE_NONE'));
        @define('CRNRSTN_CSS_VALIDATE_IS_DEPRECATED', (int) $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_VALIDATE_IS_DEPRECATED'));
        @define('CRNRSTN_CSS_VALIDATE_IS_NONSTANDARD', (int) $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_VALIDATE_IS_NONSTANDARD'));
        @define('CRNRSTN_CSS_VALIDATE_CSS_GRADIENTS', (int) $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_VALIDATE_CSS_GRADIENTS'));
        @define('CRNRSTN_CSS_VALIDATE_STANDARD_USE', (int) $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_VALIDATE_STANDARD_USE'));
        @define('CRNRSTN_CSS_VALIDATE_STYLE_IN_HEAD', (int) $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_VALIDATE_STYLE_IN_HEAD'));
        @define('CRNRSTN_CSS_VALIDATE_LINK_IN_HEAD', (int) $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_VALIDATE_LINK_IN_HEAD'));
        @define('CRNRSTN_CSS_VALIDATE_STYLE_IN_BODY', (int) $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_VALIDATE_STYLE_IN_BODY'));
        @define('CRNRSTN_CSS_VALIDATE_LINK_IN_BODY', (int) $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_VALIDATE_LINK_IN_BODY'));
        @define('CRNRSTN_CSS_VALIDATE_HSLA', (int) $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_VALIDATE_HSLA'));
        @define('CRNRSTN_CSS_VALIDATE_RGB', (int) $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_VALIDATE_RGB'));
        @define('CRNRSTN_CSS_VALIDATE_RGBA', (int) $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_VALIDATE_RGBA'));
        @define('CRNRSTN_CSS_VALIDATE_CURRENTCOLOR', (int) $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_VALIDATE_CURRENTCOLOR'));
        @define('CRNRSTN_CSS_ICON_ALERT_BANG', (int) $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_ICON_ALERT_BANG'));            // INDICATION OF ICON TYPE TO BIND
        @define('CRNRSTN_CSS_ICON_SUCCESS_CHECK', (int) $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_ICON_SUCCESS_CHECK'));           // INDICATION OF ICON TYPE TO BIND
        @define('CRNRSTN_CSS_ICON_ERR_X', (int) $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_ICON_ERR_X'));                 // INDICATION OF ICON TYPE TO BIND
        @define('CRNRSTN_CSS_CLIENT_ASSOC_HAS_META', (int) $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_CLIENT_ASSOC_HAS_META'));      // INDICATION OF NEED TO SHOW A NOTE
        @define('CRNRSTN_CSS_CLIENT_ASSOC_HAS_DOCS_LNK', (int) $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_CLIENT_ASSOC_HAS_DOCS_LNK'));  // INDICATION OF NEED TO HTTP LINK THE ELEMENT

        $this->load_mail_clients();

        $this->serialize_css_to_email_clients();

        $this->css_to_client_normalization();

    }

    private function validate_ugc_datum(){

        foreach($this->css_pattern_meta_nomination_ARRAY as $key_css_species => $chunkArray0) {

            foreach ($chunkArray0 as $key_css => $css_string_nomination) {

                /*
                define('CRNRSTN_CSS_VALIDATE_NONE', (int) $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_VALIDATE_NONE'));
                define('CRNRSTN_CSS_VALIDATE_IS_DEPRECATED', (int) $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_VALIDATE_IS_DEPRECATED'));
                define('CRNRSTN_CSS_VALIDATE_IS_NONSTANDARD', (int) $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_VALIDATE_IS_NONSTANDARD'));
                define('CRNRSTN_CSS_VALIDATE_CSS_GRADIENTS', (int) $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_VALIDATE_CSS_GRADIENTS'));
                define('CRNRSTN_CSS_VALIDATE_STANDARD_USE', (int) $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_VALIDATE_STANDARD_USE'));
                define('CRNRSTN_CSS_VALIDATE_STYLE_IN_HEAD', (int) $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_VALIDATE_STYLE_IN_HEAD'));
                define('CRNRSTN_CSS_VALIDATE_LINK_IN_HEAD', (int) $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_VALIDATE_LINK_IN_HEAD'));
                define('CRNRSTN_CSS_VALIDATE_STYLE_IN_BODY', (int) $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_VALIDATE_STYLE_IN_BODY'));
                define('CRNRSTN_CSS_VALIDATE_LINK_IN_BODY', (int) $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_VALIDATE_LINK_IN_BODY'));
                define('CRNRSTN_CSS_VALIDATE_HSLA', (int) $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_VALIDATE_HSLA'));
                define('CRNRSTN_CSS_VALIDATE_RGB', (int) $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_VALIDATE_RGB'));
                define('CRNRSTN_CSS_VALIDATE_RGBA', (int) $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_VALIDATE_RGBA'));
                define('CRNRSTN_CSS_VALIDATE_CURRENTCOLOR', (int) $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_VALIDATE_CURRENTCOLOR'));
                 * */

                //
                // FOR EACH REGULATED CSS STRING PATTERN
                // WHERE array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species)
                $tmp_css_array = $this->return_css_str_pattern_meta($css_string_nomination);

                switch($tmp_css_array[3]){
                    case CRNRSTN_CSS_VALIDATE_STYLE_IN_HEAD:

                        $this->css_validate_STYLE_IN_HEAD($css_string_nomination, $key_css_species);

                    break;
                    case CRNRSTN_CSS_VALIDATE_LINK_IN_HEAD:

                        $this->css_validate_LINK_IN_HEAD($css_string_nomination, $key_css_species);

                    break;
                    case CRNRSTN_CSS_VALIDATE_STYLE_IN_BODY:

                        $this->css_validate_STYLE_IN_BODY($css_string_nomination, $key_css_species);

                    break;
                    case CRNRSTN_CSS_VALIDATE_LINK_IN_BODY;

                        $this->css_validate_LINK_IN_BODY($css_string_nomination, $key_css_species);

                    break;
                    case CRNRSTN_CSS_VALIDATE_STANDARD_USE:

                        $this->css_validate_STANDARD($css_string_nomination, $key_css_species);

                    break;
                    case CRNRSTN_CSS_VALIDATE_RGB:

                    break;
                    case CRNRSTN_CSS_VALIDATE_RGBA:

                    break;
                    case CRNRSTN_CSS_VALIDATE_HSLA:

                    break;
                    case CRNRSTN_CSS_VALIDATE_CURRENTCOLOR:

                    break;
                    default:
                        //
                        // CRNRSTN_CSS_VALIDATE_NONE
                    break;

                }

                # GET VALIDATION TYPE
                # EXECUTE AGAINST VALIDATION TYPE
                # STORE ALL RESULT DATA

            }
        }

    }

    private function is_css_nom_pattern_match($http_data_str, $css_pattern){

        $http_data_str = $this->return_clean_css_pattern(urldecode($http_data_str));
        $css_pattern = $this->return_clean_css_pattern(urldecode($css_pattern));

        return strcmp(strtolower($http_data_str), strtolower($css_pattern));

    }

    public function return_css_validator_input_form_HTML(){

        $tmp_form_serial = $this->oCRNRSTN_USR->generate_new_key(8, '01');

        $tmp_array_encry = array();
        $tmp_array_clear = array();
        $tmp_array_encry[] = 'crnrstn_l=' . $this->oCRNRSTN_USR->data_encrypt('css_validator');
        $tmp_array_mit_clear[] = 'crnrstn_mit=true';
        $tmp_array_alg_cear[] = 'crnrstn_css_valptrn=' . $this->oCRNRSTN_USR->generate_new_key(8, '01');

        $tmp_http_root = $this->oCRNRSTN_USR->append_url_param($tmp_array_encry, true, $tmp_array_mit_clear);
        $tmp_alg_lnk = $this->oCRNRSTN_USR->append_url_param($tmp_array_encry, true, $tmp_array_alg_cear);

        //
        // INITIALIZE CRNRSTN :: TO CATCH THE FORM(S) ON THIS PAGE. THEREFORE, NEED TO THROW  SOME THINGS.
        // ID THE FORM FOR ALL PARAMS TO BE ASSOCIATED.
        # SHOULD BE A UNIQUE HANDLE TO THE FORM PROFILE. IT DETERMINES WHAT POTENTIAL POST/GET
        # PARAMETERS FOR WHICH CRNRSTN :: SHOULD BE LISTENING.
        # $oCRNRSTN_USR->form_serialize_new({crnrstn_pssdtl_packet}, {TUNNEL_PROTOCOL});

        //
        // THESE ARE THE INPUT FIELDS TO WHICH WE WILL LOOK
        # THESE FIELDS ARE NOT HIDDEN. THEY WILL NOT/CANNOT BE ENCRYPTED INITIALLY.
        # $oCRNRSTN_USR->form_input_add({crnrstn_pssdtl_packet}, {HTML_DOM_FORM_INPUT_NAME}}, {IS_REQUIRED});
        $this->oCRNRSTN_USR->form_input_add('crnrstn_validate_css', 'ugc_html', true);

        $this->oCRNRSTN_USR->init_validation_message('crnrstn_validate_css','ugc_html', 'Content is required.');

        //
        // THESE FIELDS ARE HIDDEN INPUT FIELDS. WE CAN TUNNEL ENCRYPT THE DATA GOING HERE.
        # $oCRNRSTN_USR->form_hidden_input_add({crnrstn_pssdtl_packet}, {HTML_DOM_FORM_INPUT_NAME}, {IS_REQUIRED}, {DEFAULT_VALUE <-notrequired}, {HTML_DOM_FORM_INPUT_ID <-notrequired});
        //$oCRNRSTN_USR->form_hidden_input_add('crnrstn_validate_css', 'crnrstn_country_iso_code', true, 'EN', 'crnrstn_country_iso_code');
        //$oCRNRSTN_USR->form_hidden_input_add('crnrstn_validate_css', 'crnrstn_php_sessionid', true, session_id(), 'crnrstn_php_sessionid');
        $crnrstn_css_validator_output = '
                        <form id="crnrstn_validate_css_' . $tmp_form_serial . '" name="crnrstn_validate_css" action="#" method="post" enctype="multipart/form-data">

                            <div style="float:left; text-align: left; border: 1px solid #A5B9D8; width: 370px; background-color: #FFF;">
                                <textarea name="ugc_html" placeholder="Paste HTML." id="ugc_html_' . $tmp_form_serial . '" style="width: 95%; border:2px solid #FFF; height: 340px; margin: 0 0 0 0; font-size: 14px; color: #6885C3;"></textarea>
                            </div>

                            <div style="height:0; width:100%; clear:both; display: block; overflow: hidden;"></div>

                            <div style="width:450px;">

                                <div style="float:right; padding:20px 77px 0 0;">
                                    <div id="crnrstn_validate_submit" style=\'padding: 8px 20px 8px 20px; text-align: center; cursor: pointer; color: #6885C3; font-weight: bold; border: 2px solid #A5B9D8; background-color: #FFF; font-family:"Courier New", Courier, monospace;\' onclick="crnrstn_validate(); return false;">validate</div>
                                </div>

                                <div style=\'float: left; text-align: left; padding:0 10px 0 0; line-height: 15px;\'>
                                    <span style=\'font-family:"Courier New", Courier, monospace; font-size: 11px; text-decoration:none; color: #6885C3;  \'>\'</span><a href="./archive/2008/1.0.0/email_validator/" target="_self" style=\'font-family:"Courier New", Courier, monospace; text-decoration:none; font-size: 11px; color: #6885C3; text-decoration:underline;\'>08 archive</a>
                                </div>
                                <div style="float: left; text-align: left; padding:0 10px 0 0; line-height: 15px;">
                                    <a href="' . $tmp_alg_lnk . '" target="_self" style=\'font-family:"Courier New", Courier, monospace; text-decoration:none; font-size: 11px; color: #6885C3; text-decoration:underline;\'>algorithm</a>
                                </div>
                                <div style="float: left; text-align: left; padding:0 10px 0 0; line-height: 15px;">
                                    <a href="' . $this->oCRNRSTN_USR->return_sticky_link('https://github.com/jony5/CSS-Validator-for-HTML-Email-v2.00.0000').'" target="_blank" style=\'font-family:"Courier New", Courier, monospace; text-decoration:none; font-size: 11px; color: #6885C3; text-decoration:underline;\'>download</a>
                                </div>
                                <div style="float: left; text-align: left; padding:0 0 0 0; line-height: 15px;">
                                    <a rel="crnrstn_signin" href="#" target="_blank" style=\'font-family:"Courier New", Courier, monospace; text-decoration:none; font-size: 11px; color: #6885C3; text-decoration:underline;\'>login</a>
                                </div>
                                
                                <div style="height:0; width:100%; clear:both; display: block; overflow: hidden;"></div>

                                <div style="float:right; text-align:left; padding:5px 70px 0 0;">
                                    <div id="ugc_html_content_err" style=\'float:right; text-align:right; padding: 8px 5px 0px 0; line-height: 19px; color:#F90000; font-weight:bold; font-size: 14px; display: none; font-family: "Courier New", Courier, monospace;\'>Please paste HTML&nbsp;<br>code into the form.</div>
                                </div>

                                <div style="height:40px; width:100%; clear:both; display: block; overflow: hidden;"></div>

                                <div style="text-align:left; font-size: 12px; color: #6885C3;">&copy; 2012-'.date('Y').' Jonathan \'J5\' Harris :: <a href="' . $tmp_http_root.'" target="_self" style=\'text-decoration:none; color:#6885C3; font-family: "Courier New", Courier, monospace; text-decoration: underline;\'>' . $this->oCRNRSTN->multi_lang_content_return('COPY_ALL_RIGHTS_PART_MIT').'</a></div>
                                <div style="height:5px; width:100%; clear:both; display: block; overflow: hidden;"></div>

                                <div style="text-align:left; font-size: 12px; color: #6885C3;">All Rights Reserved.</div>
                                <div style="height:5px; width:100%; clear:both; display: block; overflow: hidden;"></div>

                                <div style="width:150px; font-size: 12px; text-align: left;">

                                    <div style="text-align: center; margin:0 auto;">

                                        <div style="float:left; background-image:url(' . $this->oCRNRSTN_USR->return_creative('SUCCESS_CHECK', CRNRSTN_UI_IMG_PNG).');background-repeat:no-repeat; margin-right:10px; padding:0 10px 0 17px; width:35px; height:19px;">&nbsp;<a href="' . $this->oCRNRSTN_USR->return_sticky_link('http://validator.w3.org/check?uri=referer', 'validator_w3_org').'" target="_blank">XHTML</a></div>
                                        <div style="float:left; background-image:url(' . $this->oCRNRSTN_USR->return_creative('SUCCESS_CHECK', CRNRSTN_UI_IMG_PNG).');background-repeat:no-repeat; margin-right:10px; padding:0 10px 0 17px; width:25px; height:19px;">&nbsp;<a href="' . $this->oCRNRSTN_USR->return_sticky_link('http://jigsaw.w3.org/css-validator/check/referer', 'jigsaw_w3_org').'" target="_blank">CSS</a></div>

                                        <div style="height:0; width:100%; clear:both; display: block; overflow: hidden;"></div>

                                    </div>

                                </div>

                                <div style="height:10px; width:100%; clear:both; display: block; overflow: hidden;"></div>

                            </div>
                            <button type="submit" id="submit_' . $tmp_form_serial . '" style="display: none;">validate</button>
                            ' . $this->oCRNRSTN_USR->ui_content_module_out(CRNRSTN_UI_FORM_INTEGRATION_PACKET, 'crnrstn_validate_css') . '

                            <script>

                                function crnrstn_validate(){

                                    if(valid_form()){

                                        document.getElementById(\'crnrstn_validate_css_' . $tmp_form_serial . '\').submit();

                                    }

                                }

                                function valid_form(){

                                    if(document.getElementById("ugc_html_' . $tmp_form_serial . '").value != ""){

                                        return true;

                                    }else{

                                        document.getElementById("ugc_html_content_err").style.display = \'inline\';
                                        document.getElementById("crnrstn_validate_submit").style.borderColor = "#F90000";

                                        return false;

                                    }

                                }

                            </script>
                        </form>
    
    ';


        return $this->return_css_validator_content_HTML($crnrstn_css_validator_output, 0);

    }

    public function return_css_algorithm_profile(){

        //
        // RETRIEVE URI PARAMETER
        $tmp_css_validation_pattern = $this->oCRNRSTN_USR->extract_data_HTTP('crnrstn_css_valptrn');
        $tmp_css_validation_pattern_LOWER = trim(strtolower($tmp_css_validation_pattern));

        if($tmp_css_validation_pattern_LOWER == 'return_all'){

            //
            // RETURN LIST OF ALL CSS STRING PATTERN NOMINATIONS
            $tmp_output_ARRAY = array();
            $tmp_output_ARRAY['HTML'] = '';
            $tmp_output_ARRAY['TEXT'] = '';

            //
            // PAGE HEADER AND DESCRIPTION
            $tmp_output_ARRAY['HTML'] = $tmp_output_ARRAY['HTML'] . $this->return_validator_notes_kpi_header();

            foreach($this->css_pattern_meta_nomination_ARRAY as $key_css_species => $chunkArray0){

                foreach($chunkArray0 as $key_css => $css_string_nomination) {

                    //
                    // CSS HEADER AND DESCRIPTION
                    $tmp_output_ARRAY['HTML'] = $tmp_output_ARRAY['HTML'] . $this->dynamic_content_return($css_string_nomination, 'VALIDATOR_LOGIC_CSS_HEADER', 'HTML');

                    //
                    // DESKTOP CLIENT SUPPORT DETAIL
                    $tmp_output_ARRAY['HTML'] = $tmp_output_ARRAY['HTML'] . $this->dynamic_content_return($css_string_nomination, 'VALIDATOR_LOGIC_DESKTOP_CLIENT_SUPPORT', 'HTML');

                    //
                    // MOBILE CLIENT SUPPORT DETAIL
                    $tmp_output_ARRAY['HTML'] = $tmp_output_ARRAY['HTML'] . $this->dynamic_content_return($css_string_nomination, 'VALIDATOR_LOGIC_MOBILE_CLIENT_SUPPORT', 'HTML');

                    //
                    // WEB CLIENT SUPPORT DETAIL
                    $tmp_output_ARRAY['HTML'] = $tmp_output_ARRAY['HTML'] . $this->dynamic_content_return($css_string_nomination, 'VALIDATOR_LOGIC_WEB_CLIENT_SUPPORT', 'HTML');

                }

            }

            return $this->return_css_validator_content_HTML($tmp_output_ARRAY['HTML']);

        }else{

            //
            // RETURN LIST OF ALL CSS STRING PATTERN NOMINATIONS
            $tmp_output_ARRAY = array();
            $tmp_output_ARRAY['HTML'] = '';
            $tmp_output_ARRAY['TEXT'] = '';

            //
            // PAGE HEADER AND DESCRIPTION
            $tmp_output_ARRAY['HTML'] = $tmp_output_ARRAY['HTML'] . $this->return_validator_notes_kpi_header();

            foreach($this->css_pattern_meta_nomination_ARRAY as $key_css_species => $chunkArray0){

                foreach($chunkArray0 as $key_css => $css_string_nomination) {

                    if($this->is_css_nom_pattern_match($tmp_css_validation_pattern, $css_string_nomination) === 0){

                        //
                        // CSS HEADER AND DESCRIPTION
                        $tmp_output_ARRAY['HTML'] = $tmp_output_ARRAY['HTML'] . $this->dynamic_content_return($css_string_nomination, 'VALIDATOR_LOGIC_CSS_HEADER', 'HTML');

                        //
                        // DESKTOP CLIENT SUPPORT DETAIL
                        $tmp_output_ARRAY['HTML'] = $tmp_output_ARRAY['HTML'] . $this->dynamic_content_return($css_string_nomination, 'VALIDATOR_LOGIC_DESKTOP_CLIENT_SUPPORT', 'HTML');

                        //
                        // MOBILE CLIENT SUPPORT DETAIL
                        $tmp_output_ARRAY['HTML'] = $tmp_output_ARRAY['HTML'] . $this->dynamic_content_return($css_string_nomination, 'VALIDATOR_LOGIC_MOBILE_CLIENT_SUPPORT', 'HTML');

                        //
                        // WEB CLIENT SUPPORT DETAIL
                        $tmp_output_ARRAY['HTML'] = $tmp_output_ARRAY['HTML'] . $this->dynamic_content_return($css_string_nomination, 'VALIDATOR_LOGIC_WEB_CLIENT_SUPPORT', 'HTML');

                    }

                }

            }

            return $this->return_css_validator_content_HTML($tmp_output_ARRAY['HTML']);

        }

    }

    private function return_css_combo(){

        $tmp_str = '';
        $tmp_array = array();
        $tmp_sort_array = array();

        foreach($this->css_pattern_meta_nomination_ARRAY as $key_css_species => $chunkArray0) {

            foreach ($chunkArray0 as $key_css => $css_string_nomination) {

                $tmp_css = $this->return_clean_css_pattern($css_string_nomination);

                if(!isset($tmp_array[$tmp_css])){

                    $tmp_array[$tmp_css] = 1;
                    $tmp_sort_array[] = $tmp_css;

                }

            }

        }

        sort ($tmp_sort_array, SORT_STRING);

        foreach($tmp_sort_array as $key => $tmp_css){

            $tmp_str .= '<option value="'.htmlentities(strtolower($tmp_css)).'">'.htmlentities($tmp_css).'</option>
';

        }

        return $tmp_str;

    }

    private function return_validator_notes_kpi_header(){

        $tmp_array_encry = array();
        $tmp_array_clear = array();
        $tmp_array_delete = array();
        $tmp_array_encry[] = 'crnrstn_l=' . $this->oCRNRSTN_USR->data_encrypt('css_validator');
        $tmp_array_clear[] = 'crnrstn_css_valptrn=return_all';
        $tmp_array_delete[] = 'crnrstn_css_valptrn';

        $tmp_lnk_all = $this->oCRNRSTN_USR->append_url_param($tmp_array_encry, true, $tmp_array_clear);
        $tmp_lnk_css = $this->oCRNRSTN_USR->append_url_param($tmp_array_encry, true, $tmp_array_delete, false);

        $tmp_str = '<div style="text-align: left; width: 390px; background-color: #FFF;">
                                                <div style="width:385px; border:2px solid #FFF; margin:0; color: #6885C3;">
                                                    
                                                    <div style=\'font-family:"Courier New", Courier, monospace; font-size: 19px; line-height:25px; font-weight: bold; border-right: 0px solid #FFF; border-bottom: 5px solid #FFF; \'>
                                                    Special Notes and Key Performance Indicators for CSS Processed by Email Clients
                                                    </div>
                                                    
                                                </div>
                                                
                                            </div>   
                                            
                                            <div style=\'font-family:"Courier New", Courier, monospace; font-size: 17px; font-weight: bold; border-left: 0px solid #FFF;  border-top: 10px solid #FFF; border-bottom: 6px solid #FFF; color: #6885C3;\'>Transparency ::</div>
                                            <div style=\'font-family:"Courier New", Courier, monospace; font-size: 13px; font-weight: normal; border-left: 0px solid #FFF; border-right: 10px solid #FFF; border-right: 10px solid #FFF; border-bottom: 10px solid #FFF; color: #6885C3; line-height:16px;\'>
                                            Using the inputs below, one can expose the performance based
                                            assumptions which regulate the scoring algorithm behind 
                                            this validator.<br><br>
                                            
                                            Matching (and source of record) information can be found within Campaign Monitor\'s
                                            Ultimate Guide to CSS, <a href="' . $this->oCRNRSTN_USR->return_sticky_link('http://www.campaignmonitor.com/css/', 'css_validator_kpi_header').'" target="_blank" style="text-decoration: none; color:#0066CC; text-decoration: underline;">here</a>.</div>
                                        
                                            <div style=\'font-family:"Courier New", Courier, monospace; font-size: 13px; font-weight: normal; border-left: 0px solid #FFF;  border-top: 0px solid #FFF; border-bottom: 6px solid #FFF; color: #6885C3; line-height:19px;\'>
                                            <a href="' . $tmp_lnk_all . '" target="_self" style=\'text-decoration:none; font-family:"Courier New", Courier, monospace; font-size: 13px; font-weight: normal; color: #6885C3; text-decoration:underline; \'>Click here</a> to get all of this data in a single &amp; <span style="color:#D24A45">proper massive large</span> server response.</div>
                                            
                                            <div style=\'font-family:"Courier New", Courier, monospace; font-size: 13px; font-weight: normal; border-left: 0px solid #FFF;  border-top: 0px solid #FFF; border-bottom: 6px solid #FFF; color: #6885C3; line-height:19px;\'>
                                            The drop down combo box that is below can be used as well.</div>
                                            
                                            <form>
                                                <select name="crnrstn_css_patterns" onchange="crnrstn_goto_pattern(this.value)" style="height: 15px; font-size: 11px; display:inline;">
                                                    <option value="00000101">- select a css rule</option>
                                                   ' . $this->return_css_combo() . '
                                                </select>                              
                                            </form>
                                            <script>
                                            function crnrstn_goto_pattern(str_ptrn){
                                                
                                                window.location.href="' . $tmp_lnk_css . '&crnrstn_css_valptrn=" + str_ptrn;
                                              
                                            }                                       
                                            </script>
                                            
                                            
                            ';

        return $tmp_str;

    }

    private function initialize_pattern_regulated_bit($string_pattern, $integer_constant){

        //$const_nom = 'CRNRSTN_'.strtoupper(md5($string_pattern));
        $tmp_val = $this->oCRNRSTN_USR->initialize_serialized_bit($string_pattern, $integer_constant);

        //
        // DEFINE CONSTANT ONE WITH BIT INTEGER STORAGE
        @define($string_pattern, $tmp_val);

    }

    private function serialize_css_to_email_clients(){

        // $mail_client_constant = CRNRSTN_OUTLOOK_IOS_APP

        //$this->regulated_string_patterns_ARRAY = array("<style", "<style", "color:", "font-size:", "font-style:", "font-weight:", "text-align:", "text-decoration:", "background-color:", "border:", "display:", "font-family:", "font-variant:", "letter-spacing:", "line-height:", "padding:", "table-layout:", "text-indent:", "text-transform:", "border-collapse:", "clear:", "direction:", "float:", "vertical-align:", "width:", "word-spacing:", "height:",  "list-style-type:","overflow:","visibility:",  "white-space:",  "background-image:","background-repeat:",  "clip:", "cursor:", "list-style-image:", "list-style-position:", "margin:", "z-index:", "left:", "right:", "top:", "background-position:", "border-spacing:", "bottom:", "empty-cells:", "position:", "caption-side:", "opacity:","<ul", "<li", "<p", "<big", "<center", "<dd", "<dl", "<dt", "<em>", "<embed>",  "<form", "<h1", "<h2", "<h3",  "<h4", "<h5", "<h6", "<input>", "<ol>", "<option", "<select", "<button", "<label", "<fieldset",  "<script",  "<noscript", "<small>", "<th", "<tt", "<textarea","<object","<param","<tbody","<link","<link");

        //$this->regulated_string_patterns_ARRAY = array("grid-auto-flow:");
        $tmp_CLIENT_CONST_ARRAY = array();

        //
        // WEB, MOBILE, DESKTOP
        $tmp_CLIENT_CONST_ARRAY[] = $this->desktop_mail_CONST_ARRAY;
        $tmp_CLIENT_CONST_ARRAY[] = $this->mobile_mail_CONST_ARRAY;
        $tmp_CLIENT_CONST_ARRAY[] = $this->web_mail_CONST_ARRAY;

        foreach ($tmp_CLIENT_CONST_ARRAY as $key0 => $chunkARRAY0){

            foreach($chunkARRAY0 as $key1 => $mail_const_int){

                //error_log(__LINE__ .' '. __METHOD__ .' $mail_const_int=' . $mail_const_int); '<style> in <head>',

                switch($mail_const_int){
                    /*
                    'CRNRSTN_AOL_DESKTOP',
                    'CRNRSTN_APPLE_MAIL_10',
                    'CRNRSTN_IBM_NOTES_9',
                    'CRNRSTN_OUTLOOK_2000_03',
                    'CRNRSTN_OUTLOOK_2007_16',
                    'CRNRSTN_OUTLOOK_EXPRESS',
                    'CRNRSTN_OUTLOOK_FOR_MAC',
                    'CRNRSTN_POSTBOX',
                    'CRNRSTN_THUNDERBIRD',
                    'CRNRSTN_WINDOWS_10_MAIL',
                    'CRNRSTN_WINDOWS_LIVE_MAIL'

                    BOX_MODEL_ MEDIA_QUERIES_ caption-side
                    */
                    case 'CRNRSTN_AOL_DESKTOP':

                        //
                        // FOR EACH MAIL CLIENT, FLAG CSS ELEMENTS WHICH HAVE NO SUPPORT OR META-DATA DUE TO POOR, CONDITIONAL, OR BUGGY SUPPORT
                        $tmp_regulated_string_patterns_ARRAY = array('caption-side', 'and', 'or (comma)', 'not','only screen', 'any-hover', 'any-pointer', 'hover', 'max-aspect-ratio', 'max-device-aspect-ratio', 'max-device-height', 'max-device-pixel-ratio', 'max-device-width', 'MEDIA_QUERIES_max-height', 'max-resolution', 'MEDIA_QUERIES_max-width', 'min-aspect-ratio', 'min-device-aspect-ratio', 'min-device-height', 'min-device-pixel-ratio', 'min-device-width', 'MEDIA_QUERIES_min-height', 'min-resolution', 'MEDIA_QUERIES_min-width', 'orientation', 'pointer', 'SVG', 'TTF', 'WOFF', 'WOFF2', 'WOFF base64 encoded', 'WOFF2 base64 encoded', 'font-family', 'font-feature-settings', 'font-kerning', 'font-size-adjust', 'font-stretch', 'font-synthesis', 'font-variant', 'hyphens', 'overflow-wrap', 'text-fill-color', 'text-shadow', 'text-size-adjust', 'text-stroke', 'text-stroke-color', 'text-stroke-width', 'word-wrap', 'background', 'background-clip', 'background-origin', 'background-size', 'isolation', 'mix-blend-mode', 'CSS gradients', 'Multiple background images', 'HSL Colors', 'HSLA Colors', 'RGBA Colors', 'currentColor', 'border-bottom-left-radius', 'border-bottom-right-radius', 'border-image', 'border-radius', 'border-top-left-radius', 'border-top-right-radius', 'box-shadow', 'box-sizing', 'MEDIA_QUERIES_max-height', 'BOX_MODEL_max-height', 'BOX_MODEL_max-width', 'BOX_MODEL_min-height', 'BOX_MODEL_min-width', 'cursor', 'POSITIONING_AND_DISPLAY_display','FLEXBOX_display', 'object-fit', 'object-position', 'opacity', 'outline', 'outline-color', 'outline-style', 'outline-width', 'position', 'resize', 'list-style-type', 'border-collapse', 'border-spacing', 'animation', 'animation-delay', 'animation-direction', 'animation-duration', 'animation-fill-mode', 'animation-iteration-count', 'animation-name', 'animation-play-state', 'animation-timing-function', 'backface-visibility', 'perspective', 'perspective-origin', 'transform', 'transform-origin', 'transform-style', 'transition', 'transition-delay', 'transition-duration', 'transition-property', 'transition-timing-function', 'backdrop-filter', 'filter', 'break-after', 'break-before', 'break-inside', 'column-count', 'column-fill', 'column-gap', 'column-rule', 'column-rule-color', 'column-rule-style', 'column-rule-width', 'column-span', 'column-width', 'columns', 'GRID_align-content', 'GRID_align-items', 'GRID_align-self', 'flex', 'flex-basis', 'flex-direction', 'flex-flow', 'flex-grow', 'flex-shrink', 'flex-wrap', 'GRID_justify-content', 'order', 'FLEXBOX_align-content', 'FLEXBOX_align-items', 'FLEXBOX_align-self', 'GRID_display', 'grid', 'grid-area', 'grid-auto-columns', 'grid-auto-flow', 'grid-auto-rows', 'grid-column', 'grid-column-end', 'grid-column-gap', 'grid-column-start', 'grid-gap', 'grid-row', 'grid-row-end', 'grid-row-gap', 'grid-row-start', 'grid-template-areas', 'grid-template-columns', 'grid-template-rows', 'FLEXBOX_justify-content', 'justify-items', 'justify-self');

                        //
                        // REPORT OUTPUT ICONOGRAPHY MANAGEMENT AND META BEHAVIOR DETAIL

                        //CSS_REGULATED_PATTERN,
                        //MAIL_CLIENT_CONSTANT
                        //DETAIL_STR
                        //ICON_CONSTANT (IF SUCCESS, INFO, OR ERROR)

                        $tmp_css_pattern = 'filter';
                        $tmp_note = 'Supports Microsoft\'s proprietary <code>filter</code> syntax, which has some overlaps with the standard property.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ERR_X);

                        $tmp_css_pattern = 'border-collapse';
                        $tmp_note = 'Supported, but the HTML attribute <code>cellspacing</code> takes precedence over it.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'list-style-type';
                        $tmp_note = 'Partial. Supports <code>none</code>, <code>disc</code>, <code>circle</code>, <code>square</code>, <code>decimal</code>, <code>lower-alpha</code>, <code>upper-alpha</code>, <code>lower-roman</code>, and <code>upper-roman</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'position';
                        $tmp_note = 'Partial. Supports <code>relative</code> and <code>absolute</code>, but not <code>fixed</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'POSITIONING_AND_DISPLAY_display';
                        $tmp_note = 'Partial. Supports <code>block</code>, <code>inline</code>, <code>list-item</code>, and <code>none</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'cursor';
                        $tmp_note = 'Partial. Doesn\'t support <code>url()</code> or <code>none</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'background';
                        $tmp_note = 'Partial. Fixed attachment is not supported.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'word-wrap';
                        $tmp_note = 'Buggy. Text styled with <code>word-wrap: normal</code> is clipped, instead of breaking out of container.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'font-variant';
                        $tmp_note = 'Partial. Supports CSS2 values, but not CSS3.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'font-family';
                        $tmp_note = 'Mostly supported, but unquoted font names containing line breaks don\'t work.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        break;
                    case 'CRNRSTN_APPLE_MAIL_10':

                        $tmp_regulated_string_patterns_ARRAY = array('max-device-pixel-ratio', 'max-resolution', 'min-device-pixel-ratio', 'min-resolution', 'EOT', 'font-size-adjust', 'font-stretch', 'hyphens', 'text-fill-color', 'text-size-adjust', 'text-stroke-color', 'text-stroke-width', 'background-attachment', 'position', 'backface-visibility', 'transform');

                        $tmp_css_pattern = 'backdrop-filter';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'transform';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'backface-visibility';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'position';
                        $tmp_note = 'Partial. Elements with <code>fixed</code> scroll with the page instead of remaining fixed.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'text-stroke-width';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-stroke-color';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-stroke';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-fill-color';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'hyphens';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        break;
                    case 'CRNRSTN_IBM_NOTES_9':

                        $tmp_regulated_string_patterns_ARRAY = array('caption-side', '<link> in <head>', '<link> in <body>', '@media', 'and', 'or (comma)', 'not','screen', 'only screen', 'all', 'any-hover', 'any-pointer', 'hover', 'max-aspect-ratio', 'max-device-aspect-ratio', 'max-device-height', 'max-device-pixel-ratio', 'max-device-width', 'MEDIA_QUERIES_max-height', 'max-resolution', 'MEDIA_QUERIES_max-width', 'min-aspect-ratio', 'min-device-aspect-ratio', 'min-device-height', 'min-device-pixel-ratio', 'min-device-width', 'MEDIA_QUERIES_min-height', 'min-resolution', 'MEDIA_QUERIES_min-width', 'orientation', 'pointer', '@font-face', 'EOT', 'SVG', 'TTF', 'WOFF', 'WOFF2', 'WOFF base64 encoded', 'WOFF2 base64 encoded', 'direction', 'font', 'font-family', 'font-feature-settings', 'font-kerning', 'font-size', 'font-size-adjust', 'font-stretch', 'font-synthesis', 'font-variant', 'hyphens', 'letter-spacing', 'line-height', 'overflow-wrap', 'text-align', 'text-decoration', 'text-fill-color', 'text-indent', 'text-overflow', 'text-shadow', 'text-size-adjust', 'text-stroke', 'text-stroke-color', 'text-stroke-width', 'text-transform', 'vertical-align', 'white-space', 'word-spacing', 'word-wrap', 'background', 'background-attachment', 'background-blend-mode', 'background-clip', 'background-color', 'background-image', 'background-origin', 'background-position', 'background-repeat', 'background-size', 'isolation', 'mix-blend-mode', 'CSS gradients', 'Data URI background image', 'Multiple background images', 'HSL Colors', 'HSLA Colors', 'RGBA Colors', 'currentColor', 'border', 'border-bottom', 'border-bottom-color', 'border-bottom-left-radius', 'border-bottom-right-radius', 'border-bottom-style', 'border-bottom-width','border-color', 'border-image', 'border-left', 'border-left-color', 'border-left-style', 'border-left-width', 'border-radius', 'border-right', 'border-right-color', 'border-right-style', 'border-right-width', 'border-style', 'border-top', 'border-top-color', 'border-top-left-radius', 'border-top-right-radius', 'border-top-style', 'border-top-width', 'border-width', 'box-shadow', 'box-sizing', 'height', 'margin', 'margin-bottom', 'margin-left', 'margin-right', 'margin-top', 'MEDIA_QUERIES_max-height', 'BOX_MODEL_max-height', 'BOX_MODEL_max-width', 'BOX_MODEL_min-height', 'BOX_MODEL_min-width', 'padding', 'padding-bottom', 'padding-left', 'padding-right', 'padding-top', 'bottom', 'clear', 'cursor', 'GRID_display', 'FLEXBOX_display', 'float', 'left', 'object-fit', 'object-position', 'opacity', 'outline', 'outline-color', 'outline-style', 'outline-width', 'overflow', 'position', 'resize', 'right', 'top', 'visibility', 'z-index', 'list-style', 'list-style-image', 'list-style-position', 'list-style-type', 'border-collapse', 'border-spacing', 'empty-cells', 'table-layout', 'animation', 'animation-delay', 'animation-direction', 'animation-duration', 'animation-fill-mode', 'animation-iteration-count', 'animation-name', 'animation-play-state', 'animation-timing-function', 'backface-visibility', 'perspective', 'perspective-origin', 'transform', 'transform-origin', 'transform-style', 'transition', 'transition-delay', 'transition-duration', 'transition-property', 'transition-timing-function', 'backdrop-filter', 'filter', 'break-after', 'break-before', 'break-inside', 'column-count', 'column-fill', 'column-gap', 'column-rule', 'column-rule-color', 'column-rule-style', 'column-rule-width', 'column-span', 'column-width', 'columns', 'GRID_align-content', 'GRID_align-items', 'GRID_align-self', 'flex', 'flex-basis', 'flex-direction', 'flex-flow', 'flex-grow', 'flex-shrink', 'flex-wrap', 'GRID_justify-content', 'order', 'FLEXBOX_align-content', 'FLEXBOX_align-items', 'FLEXBOX_align-self', 'POSITIONING_AND_DISPLAY_display', 'grid', 'grid-area', 'grid-auto-columns', 'grid-auto-flow', 'grid-auto-rows', 'grid-column', 'grid-column-end', 'grid-column-gap', 'grid-column-start', 'grid-gap', 'grid-row', 'grid-row-end', 'grid-row-gap', 'grid-row-start', 'grid-template-areas', 'grid-template-columns', 'grid-template-rows', 'FLEXBOX_justify-content', 'justify-items', 'justify-self');

                        $tmp_css_pattern = 'list-style-type';
                        $tmp_note = 'Partial. Supports <code>none</code>, <code>disc</code>, <code>decimal</code>, <code>lower-alpha</code>, <code>upper-alpha</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'height';
                        $tmp_note = 'Partial support on table elements.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-width';
                        $tmp_note = 'Partial support on table elements.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-top-width';
                        $tmp_note = 'Partial support on table elements.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-top-style';
                        $tmp_note = 'Partial support on table elements.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-top-color';
                        $tmp_note = 'Partial support on table elements.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-top';
                        $tmp_note = 'Partial support on table elements.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-style';
                        $tmp_note = 'Partial support on table elements.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-right-width';
                        $tmp_note = 'Partial support on table elements.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-right-style';
                        $tmp_note = 'Partial support on table elements.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-right-color';
                        $tmp_note = 'Partial support on table elements.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-right';
                        $tmp_note = 'Partial support on table elements.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-left-width';
                        $tmp_note = 'Partial support on table elements.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-left-style';
                        $tmp_note = 'Partial support on table elements.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-left-color';
                        $tmp_note = 'Partial support on table elements.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-left';
                        $tmp_note = 'Partial support on table elements.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-color';
                        $tmp_note = 'Partial support on table elements.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-bottom-width';
                        $tmp_note = 'Partial support on table elements.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-bottom-style';
                        $tmp_note = 'Partial support on table elements.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-bottom-color';
                        $tmp_note = 'Partial support on table elements.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-bottom';
                        $tmp_note = 'Partial support on table elements.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border';
                        $tmp_note = 'Partial support on table elements.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'background-color';
                        $tmp_note = 'Partial. Only supported on tables.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'text-decoration';
                        $tmp_note = 'Partial. Only supports <code>line-through</code> and <code>underline</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'text-align';
                        $tmp_note = 'Partial. Doesn\'t support <code>justified</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'font-size';
                        $tmp_note = 'Partial. Supports <code>px</code>, <code>pt</code>, <code>pc</code>, and keywords, but not other units.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'font-family';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'font';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        break;
                    case 'CRNRSTN_OUTLOOK_2000_03':

                        $tmp_regulated_string_patterns_ARRAY = array('caption-side', 'and', 'or (comma)', 'not','only screen', 'any-hover', 'any-pointer', 'hover', 'max-aspect-ratio', 'max-device-aspect-ratio', 'max-device-height', 'max-device-pixel-ratio', 'max-device-width', 'MEDIA_QUERIES_max-height', 'max-resolution', 'MEDIA_QUERIES_max-width', 'min-aspect-ratio', 'min-device-aspect-ratio', 'min-device-height', 'min-device-pixel-ratio', 'min-device-width', 'MEDIA_QUERIES_min-height', 'min-resolution', 'MEDIA_QUERIES_min-width', 'orientation', 'pointer', 'SVG', 'TTF', 'WOFF', 'WOFF2', 'WOFF base64 encoded', 'WOFF2 base64 encoded', 'font-family', 'font-feature-settings', 'font-kerning', 'font-size-adjust', 'font-stretch', 'font-synthesis', 'font-variant', 'hyphens', 'overflow-wrap', 'text-fill-color', 'text-shadow', 'text-size-adjust', 'text-stroke', 'text-stroke-color', 'text-stroke-width', 'word-wrap', 'background', 'background-blend-mode', 'background-clip', 'background-origin', 'background-size', 'isolation', 'mix-blend-mode', 'CSS gradients', 'Multiple background images', 'HSL Colors', 'HSLA Colors', 'RGBA Colors', 'currentColor', 'border-bottom-left-radius', 'border-bottom-right-radius', 'border-image', 'border-radius', 'border-top-left-radius', 'border-top-right-radius', 'box-shadow', 'box-sizing', 'MEDIA_QUERIES_max-height', 'BOX_MODEL_max-height', 'BOX_MODEL_max-width', 'BOX_MODEL_min-height','BOX_MODEL_min-width', 'cursor', 'GRID_display', 'object-fit', 'object-position', 'opacity', 'outline', 'outline-color', 'outline-style', 'outline-width', 'resize', 'list-style-type', 'border-collapse', 'border-spacing', 'animation', 'animation-delay', 'animation-direction', 'animation-duration', 'animation-fill-mode', 'animation-iteration-count', 'animation-name', 'animation-play-state', 'animation-timing-function', 'backface-visibility', 'perspective', 'perspective-origin', 'transform', 'transform-origin', 'transform-style', 'transition', 'transition-delay', 'transition-duration', 'transition-property', 'transition-timing-function', 'backdrop-filter', 'filter', 'break-after', 'break-before', 'break-inside', 'column-count', 'column-fill', 'column-gap', 'column-rule', 'column-rule-color', 'column-rule-style', 'column-rule-width', 'column-span', 'column-width', 'columns', 'GRID_align-content', 'GRID_align-items', 'GRID_align-self', 'flex', 'flex-basis', 'flex-direction', 'flex-flow', 'flex-grow', 'flex-shrink', 'flex-wrap', 'GRID_justify-content', 'order', 'FLEXBOX_align-content', 'FLEXBOX_align-items', 'FLEXBOX_align-self', 'FLEXBOX_display', 'POSITIONING_AND_DISPLAY_display', 'grid', 'grid-area', 'grid-auto-columns', 'grid-auto-flow', 'grid-auto-rows', 'grid-column', 'grid-column-end', 'grid-column-gap', 'grid-column-start', 'grid-gap', 'grid-row', 'grid-row-end', 'grid-row-gap', 'grid-row-start', 'grid-template-areas', 'grid-template-columns', 'grid-template-rows', 'FLEXBOX_justify-content', 'justify-items', 'justify-self');

                        $tmp_css_pattern = 'filter';
                        $tmp_note = 'Supports Microsoft\'s proprietary <code>filter</code> syntax, which has some overlaps with the standard property.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ERR_X);

                        $tmp_css_pattern = 'border-collapse';
                        $tmp_note = 'Supported, but the HTML attribute <code>cellspacing</code> takes precedence over it.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'list-style-type';
                        $tmp_note = 'Partial. Supports <code>none</code>, <code>disc</code>, <code>circle</code>, <code>square</code>, <code>decimal</code>, <code>lower-alpha</code>, <code>upper-alpha</code>, <code>lower-roman</code>, and <code>upper-roman</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'POSITIONING_AND_DISPLAY_display';
                        $tmp_note = 'Partial. Supports <code>block</code>, <code>inline</code>, <code>list-item</code>, and <code>none</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'cursor';
                        $tmp_note = 'Partial. Doesn\'t support <code>url()</code> or <code>none</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'background';
                        $tmp_note = 'Partial. Slash syntax values are not supported.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'word-wrap';
                        $tmp_note = 'Buggy. Text styled with <code>word-wrap: normal</code> is clipped, instead of breaking out of container.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'font-variant';
                        $tmp_note = 'Partial. Supports CSS2 values, but not CSS3.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'font-family';
                        $tmp_note = 'Mostly supported, but unquoted font names containing line breaks don\'t work.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        break;
                    case 'CRNRSTN_OUTLOOK_2007_16':

                        $tmp_regulated_string_patterns_ARRAY = array('caption-side', '<link> in <head>', '<link> in <body>', '@media', 'and', 'or (comma)', 'not','screen', 'only screen', 'all', 'any-hover', 'any-pointer', 'hover', 'max-aspect-ratio', 'max-device-aspect-ratio', 'max-device-height', 'max-device-pixel-ratio', 'max-device-width', 'MEDIA_QUERIES_max-height', 'max-resolution', 'MEDIA_QUERIES_max-width', 'min-aspect-ratio', 'min-device-aspect-ratio', 'min-device-height', 'min-device-pixel-ratio', 'min-device-width', 'MEDIA_QUERIES_min-height', 'min-resolution', 'MEDIA_QUERIES_min-width', 'orientation', 'pointer', '@font-face', 'EOT', 'SVG', 'TTF', 'WOFF', 'WOFF2', 'WOFF base64 encoded', 'WOFF2 base64 encoded', 'font', 'font-feature-settings', 'font-kerning', 'font-size-adjust', 'font-stretch', 'font-synthesis', 'font-variant', 'hyphens', 'line-height', 'overflow-wrap', 'text-fill-color', 'text-overflow', 'text-shadow', 'text-size-adjust', 'text-stroke', 'text-stroke-color', 'text-stroke-width', 'text-transform', 'vertical-align', 'white-space', 'word-spacing', 'word-wrap', 'background', 'background-attachment', 'background-blend-mode', 'background-clip', 'background-color', 'background-image', 'background-origin', 'background-position', 'background-repeat', 'background-size', 'isolation', 'mix-blend-mode', 'CSS gradients', 'Data URI background image', 'Multiple background images', 'HSL Colors', 'HSLA Colors', 'RGBA Colors', 'currentColor', 'border', 'border-bottom', 'border-bottom-left-radius', 'border-bottom-right-radius', 'border-bottom-width','border-color', 'border-image', 'border-left', 'border-left-width', 'border-radius', 'border-right', 'border-right-width', 'border-top', 'border-top-left-radius', 'border-top-right-radius', 'border-top-width', 'border-width', 'box-shadow', 'box-sizing', 'height', 'margin', 'margin-bottom', 'margin-left', 'margin-right', 'margin-top', 'MEDIA_QUERIES_max-height', 'BOX_MODEL_max-height', 'BOX_MODEL_max-width', 'BOX_MODEL_min-height', 'BOX_MODEL_min-width', 'padding', 'padding-bottom', 'padding-left', 'padding-right', 'padding-top', 'width', 'bottom', 'clear', 'cursor', 'GRID_display', 'float', 'left', 'object-fit', 'object-position', 'opacity', 'outline', 'outline-color', 'outline-style', 'outline-width', 'overflow', 'position', 'resize', 'right', 'top', 'visibility', 'z-index', 'list-style', 'list-style-image', 'list-style-position', 'list-style-type', 'border-spacing', 'empty-cells', 'table-layout', 'animation', 'animation-delay', 'animation-direction', 'animation-duration', 'animation-fill-mode', 'animation-iteration-count', 'animation-name', 'animation-play-state', 'animation-timing-function', 'backface-visibility', 'perspective', 'perspective-origin', 'transform', 'transform-origin', 'transform-style', 'transition', 'transition-delay', 'transition-duration', 'transition-property', 'transition-timing-function', 'backdrop-filter', 'filter', 'break-after', 'break-before', 'break-inside', 'column-count', 'column-fill', 'column-gap', 'column-rule', 'column-rule-color', 'column-rule-style', 'column-rule-width', 'column-span', 'column-width', 'columns', 'GRID_align-content', 'GRID_align-items', 'GRID_align-self', 'flex', 'flex-basis', 'flex-direction', 'flex-flow', 'flex-grow', 'flex-shrink', 'flex-wrap', 'GRID_justify-content', 'order', 'FLEXBOX_align-content', 'FLEXBOX_align-items', 'FLEXBOX_align-self', 'FLEXBOX_display', 'grid', 'grid-area', 'grid-auto-columns', 'grid-auto-flow', 'grid-auto-rows', 'grid-column', 'grid-column-end', 'grid-column-gap', 'grid-column-start', 'grid-gap', 'grid-row', 'grid-row-end', 'grid-row-gap', 'grid-row-start', 'grid-template-areas', 'grid-template-columns', 'grid-template-rows', 'FLEXBOX_justify-content', 'justify-items', 'justify-self');

                        $tmp_css_pattern = 'list-style-type';
                        $tmp_note = 'Partial. Supports <code>disc</code>, <code>circle</code>, <code>square</code>, <code>decimal</code>, <code>lower-alpha</code>, <code>upper-alpha</code>, <code>lower-roman</code>, and <code>upper-roman</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'list-style';
                        $tmp_note = 'Partial. Supports only the <code>list-style-type</code> part of the shorthand. Non-list elements with <code>display: list-item</code> are unsupported.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'POSITIONING_AND_DISPLAY_display';
                        $tmp_note = 'Partial. Sometimes supports <code>none</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'width';
                        $tmp_note = 'Partial support on table elements.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'padding-top';
                        $tmp_note = 'Partial but buggy support, mainly on table elements.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'padding-right';
                        $tmp_note = 'Partial but buggy support, mainly on table elements.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'padding-left';
                        $tmp_note = 'Partial but buggy support, mainly on table elements.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'padding-bottom';
                        $tmp_note = 'Partial but buggy support, mainly on table elements.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'padding';
                        $tmp_note = 'Partial but buggy support, mainly on table elements.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'margin-top';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'margin-right';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'margin-left';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'margin-bottom';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'margin';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'height';
                        $tmp_note = 'Partial support on table elements.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-width';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-top-width';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-top';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-right-width';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-right';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-left-width';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-left';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-color';
                        $tmp_note = 'Buggy. Fails to override the shorthand <code>border</code> property.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-bottom-width';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-bottom';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'background-color';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'white-space';
                        $tmp_note = 'Partial. Supports <code>normal</code> and <code>pre</code>, but not <code>nowrap</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'vertical-align';
                        $tmp_note = 'Partial. Supports keywords and <code>px</code> values, but not <code>%</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'text-transform';
                        $tmp_note = 'Partial. Only <code>uppercase</code> is supported.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'line-height';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'font-variant';
                        $tmp_note = 'Partial. Supports CSS2 values, but not CSS3.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'font';
                        $tmp_note = 'Mostly supported, but the shorthand property fails to override <code>font-weight</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        break;
                    case 'CRNRSTN_OUTLOOK_EXPRESS':

                        $tmp_regulated_string_patterns_ARRAY = array('caption-side', '<link> in <head>', '<link> in <body>', 'and', 'or (comma)', 'not', 'only screen', 'any-hover', 'any-pointer', 'hover', 'max-aspect-ratio', 'max-device-aspect-ratio', 'max-device-height', 'max-device-pixel-ratio', 'max-device-width', 'MEDIA_QUERIES_max-height', 'max-resolution', 'MEDIA_QUERIES_max-width', 'min-aspect-ratio', 'min-device-aspect-ratio', 'min-device-height', 'min-device-pixel-ratio', 'min-device-width', 'MEDIA_QUERIES_min-height', 'min-resolution', 'MEDIA_QUERIES_min-width', 'orientation', 'pointer', '@font-face', 'EOT', 'SVG', 'TTF', 'WOFF', 'WOFF2', 'WOFF base64 encoded', 'WOFF2 base64 encoded', 'font-family', 'font-feature-settings', 'font-kerning', 'font-size-adjust', 'font-stretch', 'font-synthesis', 'font-variant', 'hyphens', 'overflow-wrap', 'text-fill-color', 'text-size-adjust', 'text-stroke', 'text-stroke-color', 'text-stroke-width', 'word-wrap', 'background', 'background-attachment', 'background-blend-mode', 'background-clip', 'background-image', 'background-origin', 'background-position', 'background-repeat', 'background-size', 'isolation', 'mix-blend-mode', 'CSS gradients', 'Data URI background image', 'Multiple background images', 'HSL Colors', 'HSLA Colors', 'RGBA Colors', 'currentColor', 'border-bottom-left-radius', 'border-bottom-right-radius', 'border-image', 'border-radius', 'border-top-left-radius', 'border-top-right-radius', 'box-shadow', 'box-sizing', 'MEDIA_QUERIES_max-height', 'BOX_MODEL_max-height', 'BOX_MODEL_max-width', 'BOX_MODEL_min-height', 'BOX_MODEL_min-width', 'cursor', 'GRID_display', 'object-fit', 'object-position', 'opacity', 'outline', 'outline-color', 'outline-style', 'outline-width', 'resize', 'list-style-image', 'list-style-type', 'border-collapse', 'border-spacing', 'animation', 'animation-delay', 'animation-direction', 'animation-duration', 'animation-fill-mode', 'animation-iteration-count', 'animation-name', 'animation-play-state', 'animation-timing-function', 'backface-visibility', 'perspective', 'perspective-origin', 'transform', 'transform-origin', 'transform-style', 'transition', 'transition-delay', 'transition-duration', 'transition-property', 'transition-timing-function', 'backdrop-filter', 'filter', 'break-after', 'break-before', 'break-inside', 'column-count', 'column-fill', 'column-gap', 'column-rule', 'column-rule-color', 'column-rule-style', 'column-rule-width', 'column-span', 'column-width', 'columns', 'GRID_align-content', 'GRID_align-items', 'GRID_align-self', 'flex', 'flex-basis', 'flex-direction', 'flex-flow', 'flex-grow', 'flex-shrink', 'flex-wrap', 'GRID_justify-content', 'order', 'FLEXBOX_align-content', 'FLEXBOX_align-items', 'FLEXBOX_align-self', 'FLEXBOX_display', 'grid', 'grid-area', 'grid-auto-columns', 'grid-auto-flow', 'grid-auto-rows', 'grid-column', 'grid-column-end', 'grid-column-gap', 'grid-column-start', 'grid-gap', 'grid-row', 'grid-row-end', 'grid-row-gap', 'grid-row-start', 'grid-template-areas', 'grid-template-columns', 'grid-template-rows', 'FLEXBOX_justify-content', 'justify-items', 'justify-self');

                        $tmp_css_pattern = 'border-collapse';
                        $tmp_note = 'Supported, but the HTML attribute <code>cellspacing</code> takes precedence over it.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'list-style-type';
                        $tmp_note = 'Partial. Supports <code>none</code>, <code>disc</code>, <code>circle</code>, <code>square</code>, <code>decimal</code>, <code>lower-alpha</code>, <code>upper-alpha</code>, <code>lower-roman</code>, and <code>upper-roman</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'POSITIONING_AND_DISPLAY_display';
                        $tmp_note = 'Partial. Supports <code>block</code>, <code>inline</code>, <code>list-item</code>, and <code>none</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'cursor';
                        $tmp_note = 'Partial. Doesn\'t support <code>url()</code>, some support for CSS3 properties.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'background';
                        $tmp_note = 'Partial. Values containing background images are not supported.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'word-wrap';
                        $tmp_note = 'Buggy. Text styled with <code>word-wrap: normal</code> is clipped, instead of breaking out of container.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'font-variant';
                        $tmp_note = 'Partial. Supports CSS2 values, but not CSS3.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'font-family';
                        $tmp_note = 'Mostly supported, but unquoted font names containing line breaks don\'t work.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = '@font-face';
                        $tmp_note = 'User is prompted to download webfont, but it doesn\'t display.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ERR_X);

                        break;
                    case 'CRNRSTN_OUTLOOK_FOR_MAC':

                        $tmp_regulated_string_patterns_ARRAY = array('<link> in <body>','<link> in <head>', 'max-device-pixel-ratio', 'max-resolution', 'min-device-pixel-ratio', 'min-resolution', 'EOT', 'font-stretch', 'font-style', 'hyphens', 'text-fill-color', 'text-size-adjust', 'text-stroke', 'text-stroke-color', 'text-stroke-width', 'backface-visibility', 'transform');

                        $tmp_css_pattern = 'backdrop-filter';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'transform';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'backface-visibility';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-stroke-width';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-stroke-color';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-stroke';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-fill-color';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'hyphens';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = '@font-face';
                        $tmp_note = 'When images are downloaded.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = '<link> in <body>';
                        $tmp_note = 'When images are downloaded.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = '<link> in <head>';
                        $tmp_note = 'When images are downloaded.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        break;
                    case 'CRNRSTN_POSTBOX':

                        $tmp_regulated_string_patterns_ARRAY = array('<link> in <body>', 'any-hover', 'any-pointer', 'hover', 'max-device-pixel-ratio', 'max-resolution', 'min-device-pixel-ratio', 'min-resolution', 'pointer', '@font-face', 'EOT', 'SVG', 'TTF', 'WOFF', 'WOFF2', 'WOFF2 base64 encoded', 'font-feature-settings', 'font-kerning', 'font-stretch', 'font-synthesis', 'font-variant', 'hyphens', 'overflow-wrap', 'text-fill-color', 'text-overflow', 'text-size-adjust', 'text-stroke', 'text-stroke-color', 'text-stroke-width', 'background', 'background-attachment', 'background-blend-mode', 'isolation', 'mix-blend-mode', 'CSS gradients', 'border-image', 'box-sizing', 'object-fit', 'object-position', 'overflow', 'position', 'resize', 'animation', 'animation-delay', 'animation-direction', 'animation-duration', 'animation-fill-mode', 'animation-iteration-count', 'animation-name', 'animation-play-state', 'animation-timing-function', 'backface-visibility', 'perspective', 'perspective-origin', 'transform', 'transform-origin', 'transform-style', 'transition', 'transition-delay', 'transition-duration', 'transition-property', 'transition-timing-function', 'backdrop-filter', 'filter', 'break-after', 'break-before', 'break-inside', 'column-count', 'column-fill', 'column-gap', 'column-rule', 'column-rule-color', 'column-rule-style', 'column-rule-width', 'column-span', 'column-width', 'columns', 'GRID_align-content', 'GRID_align-items', 'GRID_align-self', 'flex', 'flex-basis', 'flex-direction', 'flex-flow', 'flex-grow', 'flex-shrink', 'flex-wrap', 'GRID_justify-content', 'order', 'FLEXBOX_align-content', 'FLEXBOX_align-items', 'FLEXBOX_align-self', 'GRID_display', 'FLEXBOX_display', 'grid', 'grid-area', 'grid-auto-columns', 'grid-auto-flow', 'grid-auto-rows', 'grid-column', 'grid-column-end', 'grid-column-gap', 'grid-column-start', 'grid-gap', 'grid-row', 'grid-row-end', 'grid-row-gap', 'grid-row-start', 'grid-template-areas', 'grid-template-columns', 'grid-template-rows', 'FLEXBOX_justify-content', 'justify-items', 'justify-self');

                        $tmp_css_pattern = 'position';
                        $tmp_note = 'Partial. Supports <code>relative</code>. Elements with <code>fixed</code> scroll with the page instead of remaining fixed. Buggy behavior for <code>absolute</code> positioning.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'CSS gradients';
                        $tmp_note = 'Supported with <code>-moz</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'background';
                        $tmp_note = 'Partial. Slash syntax values are not supported.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'font-variant';
                        $tmp_note = 'Partial. Supports CSS2 values, but not CSS3.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'font-stretch';
                        $tmp_note = 'Partial. Supports exact font-stretch matches, but doesn\'t map non-matches to the nearest face.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = '@font-face';
                        $tmp_note = 'Partial. User is prompted to download webfont, but only embedded (base64 encoded) fonts display.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'min-resolution';
                        $tmp_note = 'Partial. Supports <code>dpi</code> and <code>dpcm</code> values, but not <code>dppx</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'max-resolution';
                        $tmp_note = 'Partial. Supports <code>dpi</code> and <code>dpcm</code> values, but not <code>dppx</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = '<link> in <body>';
                        $tmp_note = 'When images are downloaded.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = '<link> in <head>';
                        $tmp_note = 'When images are downloaded.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        break;
                    case 'CRNRSTN_THUNDERBIRD':

                        $tmp_regulated_string_patterns_ARRAY = array('<link> in <body>', 'any-hover', 'any-pointer', 'hover', 'max-device-pixel-ratio', 'min-device-pixel-ratio', 'pointer', '@font-face', 'EOT', 'SVG', 'TTF', 'WOFF', 'WOFF2', 'font-synthesis', 'text-fill-color', 'text-size-adjust', 'text-stroke', 'text-stroke-color', 'text-stroke-width', 'backdrop-filter', 'break-after', 'break-before', 'break-inside', 'column-fill', 'column-span');

                        $tmp_css_pattern = 'text-stroke-width';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-stroke-color';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-stroke';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-fill-color';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = '@font-face';
                        $tmp_note = 'Partial. User is prompted to download webfont, but only embedded (base64 encoded) fonts display.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = '<link> in <body>';
                        $tmp_note = 'When images are downloaded.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = '<link> in <head>';
                        $tmp_note = 'When images are downloaded.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        break;
                    case 'CRNRSTN_WINDOWS_10_MAIL':

                        $tmp_regulated_string_patterns_ARRAY = array('caption-side', '@media', 'and', 'or (comma)', 'not', 'screen', 'only screen', 'all', 'any-hover', 'any-pointer', 'hover', 'max-aspect-ratio', 'max-device-aspect-ratio', 'max-device-height', 'max-device-pixel-ratio', 'max-device-width', 'MEDIA_QUERIES_max-height', 'max-resolution', 'MEDIA_QUERIES_max-width', 'min-aspect-ratio', 'min-device-aspect-ratio', 'min-device-height', 'min-device-pixel-ratio', 'min-device-width', 'MEDIA_QUERIES_min-height', 'min-resolution', 'MEDIA_QUERIES_min-width', 'orientation', 'pointer', '@font-face', 'EOT', 'SVG', 'TTF', 'WOFF', 'WOFF2', 'WOFF base64 encoded', 'WOFF2 base64 encoded', 'font', 'font-feature-settings', 'font-kerning', 'font-size-adjust', 'font-stretch', 'font-synthesis', 'font-variant', 'hyphens', 'line-height', 'overflow-wrap', 'text-fill-color', 'text-overflow', 'text-shadow', 'text-size-adjust', 'text-stroke', 'text-stroke-color', 'text-stroke-width', 'text-transform', 'vertical-align', 'white-space', 'word-spacing', 'word-wrap', 'background', 'background-attachment', 'background-blend-mode', 'background-clip', 'background-color', 'background-image', 'background-origin', 'background-position', 'background-repeat', 'background-size', 'isolation', 'mix-blend-mode', 'CSS gradients', 'Data URI background image', 'Multiple background images', 'HSL Colors', 'HSLA Colors', 'RGBA Colors', 'currentColor', 'border', 'border-bottom', 'border-bottom-left-radius', 'border-bottom-right-radius', 'border-bottom-width', 'border-color', 'border-image', 'border-left-width', 'border-radius', 'border-right', 'border-right-width', 'border-top', 'border-top-left-radius', 'border-top-right-radius', 'border-top-width', 'border-width', 'box-shadow', 'box-sizing', 'height', 'margin', 'margin-bottom', 'margin-left', 'margin-right', 'margin-top', 'BOX_MODEL_max-height', 'BOX_MODEL_max-width', 'BOX_MODEL_min-height', 'BOX_MODEL_min-width', 'padding', 'padding-bottom', 'padding-left', 'padding-right', 'padding-top', 'width', 'bottom', 'clear', 'cursor', 'GRID_display', 'float', 'left', 'object-fit', 'object-position', 'opacity', 'outline', 'outline-color', 'outline-style', 'outline-width', 'overflow', 'position', 'resize', 'right', 'top', 'visibility', 'z-index', 'list-style', 'list-style-image', 'list-style-position', 'list-style-type', 'border-spacing', 'empty-cells', 'table-layout', 'animation', 'animation-delay', 'animation-direction', 'animation-duration', 'animation-fill-mode', 'animation-iteration-count', 'animation-name', 'animation-play-state', 'animation-timing-function', 'backface-visibility', 'perspective', 'perspective-origin', 'transform', 'transform-origin', 'transform-style', 'transition', 'transition-delay', 'transition-duration', 'transition-property', 'transition-timing-function', 'backdrop-filter', 'filter', 'break-after', 'break-before', 'break-inside', 'column-count', 'column-fill', 'column-gap', 'column-rule', 'column-rule-color', 'column-rule-style', 'column-rule-width', 'column-span', 'column-width', 'columns', 'GRID_align-content', 'GRID_align-items', 'GRID_align-self', 'flex', 'flex-basis', 'flex-direction', 'flex-flow', 'flex-grow', 'flex-shrink', 'flex-wrap', 'GRID_justify-content', 'order', 'FLEXBOX_align-content', 'FLEXBOX_align-items', 'FLEXBOX_align-self', 'FLEXBOX_display', 'grid', 'grid-area', 'grid-auto-columns', 'grid-auto-flow', 'grid-auto-rows', 'grid-column', 'grid-column-end', 'grid-column-gap', 'grid-column-start', 'grid-gap', 'grid-row', 'grid-row-end', 'grid-row-gap', 'grid-row-start', 'grid-template-areas', 'grid-template-columns', 'grid-template-rows', 'FLEXBOX_justify-content', 'justify-items', 'justify-self');

                        $tmp_css_pattern = 'list-style-type';
                        $tmp_note = 'Partial. Supports <code>disc</code>, <code>circle</code>, <code>square</code>, <code>decimal</code>, <code>lower-alpha</code>, <code>upper-alpha</code>, <code>lower-roman</code>, and <code>upper-roman</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'list-style';
                        $tmp_note = 'Partial. Supports only the <code>list-style-type</code> part of the shorthand. Non-list elements with <code>display: list-item</code> are unsupported.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'POSITIONING_AND_DISPLAY_display';
                        $tmp_note = 'Partial. Sometimes supports <code>none</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'width';
                        $tmp_note = 'Partial support on table elements.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'padding-top';
                        $tmp_note = 'Partial but buggy support, mainly on table elements.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'padding-right';
                        $tmp_note = 'Partial but buggy support, mainly on table elements.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'padding-left';
                        $tmp_note = 'Partial but buggy support, mainly on table elements.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'padding-bottom';
                        $tmp_note = 'Partial but buggy support, mainly on table elements.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'padding';
                        $tmp_note = 'Partial but buggy support, mainly on table elements.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'margin-top';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'margin-right';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'margin-left';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'margin-bottom';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'margin';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'height';
                        $tmp_note = 'Partial support on table elements.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-width';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-top-width';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-top';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-right-width';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-right';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-left-width';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-left';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-color';
                        $tmp_note = 'Buggy. Fails to override the shorthand <code>border</code> property.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-bottom-width';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border-bottom';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'border';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'background-color';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'white-space';
                        $tmp_note = 'Partial. Supports <code>normal</code> and <code>pre</code>, but not <code>nowrap</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'vertical-align';
                        $tmp_note = 'Partial. Supports <code>px</code> values, but not <code>%</code>. Keywords are not supported on images.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'text-transform';
                        $tmp_note = 'Partial. Only <code>uppercase</code> is supported.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'line-height';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'font-variant';
                        $tmp_note = 'Partial. Supports CSS2 values, but not CSS3.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'font';
                        $tmp_note = 'Mostly supported, but the shorthand property fails to override <code>font-weight</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        break;
                    case 'CRNRSTN_WINDOWS_LIVE_MAIL':

                        $tmp_regulated_string_patterns_ARRAY = array('caption-side', '<link> in <head>', '<link> in <body>', 'and', 'or (comma)', 'not', 'only screen', 'any-hover', 'any-pointer', 'hover', 'max-aspect-ratio', 'max-device-aspect-ratio', 'max-device-height', 'max-device-pixel-ratio', 'max-device-width', 'MEDIA_QUERIES_max-height', 'max-resolution', 'MEDIA_QUERIES_max-width', 'min-aspect-ratio', 'min-device-aspect-ratio', 'min-device-height', 'min-device-pixel-ratio', 'min-device-width', 'MEDIA_QUERIES_min-height', 'min-resolution', 'MEDIA_QUERIES_min-width', 'orientation', 'pointer', '@font-face', 'EOT', 'SVG', 'TTF', 'WOFF', 'WOFF2', 'WOFF base64 encoded', 'WOFF2 base64 encoded', 'font-family', 'font-feature-settings', 'font-kerning', 'font-size-adjust', 'font-stretch', 'font-synthesis', 'font-variant', 'hyphens', 'overflow-wrap', 'text-fill-color', 'text-shadow', 'text-size-adjust', 'text-stroke', 'text-stroke-color', 'text-stroke-width', 'word-wrap', 'background', 'background-attachment', 'background-blend-mode', 'background-clip', 'background-image', 'background-origin', 'background-position', 'background-repeat', 'background-size', 'isolation', 'mix-blend-mode', 'CSS gradients', 'Data URI background image', 'Multiple background images', 'HSL Colors', 'HSLA Colors', 'RGBA Colors', 'currentColor', 'border-bottom-left-radius', 'border-bottom-right-radius', 'border-image', 'border-radius', 'border-top-left-radius', 'border-top-right-radius', 'box-shadow', 'box-sizing', 'BOX_MODEL_max-height', 'BOX_MODEL_max-width', 'BOX_MODEL_min-height', 'BOX_MODEL_min-width', 'cursor', 'GRID_display', 'object-fit', 'object-position', 'opacity', 'outline', 'outline-color', 'outline-style', 'outline-width', 'overflow', 'resize', 'list-style-image', 'list-style-type', 'border-collapse', 'border-spacing', 'animation', 'animation-delay', 'animation-direction', 'animation-duration', 'animation-fill-mode', 'animation-iteration-count', 'animation-name', 'animation-play-state', 'animation-timing-function', 'backface-visibility', 'perspective', 'transform', 'transform-origin', 'transform-style', 'transition', 'transition-delay', 'transition-duration', 'transition-property', 'transition-timing-function', 'backdrop-filter', 'filter', 'break-after', 'break-before', 'break-inside', 'column-count', 'column-fill', 'column-gap', 'column-rule', 'column-rule-color', 'column-rule-style', 'column-rule-width', 'column-span', 'column-width', 'columns', 'GRID_align-content', 'GRID_align-items', 'GRID_align-self', 'flex', 'flex-basis', 'flex-direction', 'flex-flow', 'flex-grow', 'flex-shrink', 'flex-wrap', 'GRID_justify-content', 'order', 'FLEXBOX_align-content', 'FLEXBOX_align-items', 'FLEXBOX_align-self', 'FLEXBOX_display', 'grid', 'grid-area', 'grid-auto-columns', 'grid-auto-flow', 'grid-auto-rows', 'grid-column', 'grid-column-end', 'grid-column-gap', 'grid-column-start', 'grid-gap', 'grid-row', 'grid-row-end', 'grid-row-gap', 'grid-row-start', 'grid-template-areas', 'grid-template-columns', 'grid-template-rows', 'FLEXBOX_justify-content', 'justify-items', 'justify-self');

                        $tmp_css_pattern = 'border-collapse';
                        $tmp_note = 'Supported, but the HTML attribute <code>cellspacing</code> takes precedence over it.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'list-style-type';
                        $tmp_note = 'Partial. Supports <code>none</code>, <code>disc</code>, <code>circle</code>, <code>square</code>, <code>decimal</code>, <code>lower-alpha</code>, <code>upper-alpha</code>, <code>lower-roman</code>, and <code>upper-roman</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'overflow';
                        $tmp_note = 'Buggy. Elements with <code>visible</code> are covered by the next element.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'POSITIONING_AND_DISPLAY_display';
                        $tmp_note = 'Partial. Supports <code>block</code>, <code>inline</code>, <code>list-item</code>, and <code>none</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'cursor';
                        $tmp_note = 'Partial. Doesn\'t support <code>url()</code> or <code>none</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'background';
                        $tmp_note = 'Partial. Values containing background images are not supported.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'word-wrap';
                        $tmp_note = 'Buggy. Text styled with <code>word-wrap: normal</code> is clipped, instead of breaking out of container.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'font-variant';
                        $tmp_note = 'Partial. Supports CSS2 values, but not CSS3.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'font-family';
                        $tmp_note = 'Mostly supported, but unquoted font names containing line breaks don\'t work.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);



                        break;


                    case 'CRNRSTN_ANDROID_4_2_2_MAIL':

                        $tmp_regulated_string_patterns_ARRAY = array('FLEXBOX_display', '<link> in <head>', '<link> in <body>', 'any-hover', 'any-pointer', 'hover', 'max-device-pixel-ratio', 'max-resolution', 'min-device-pixel-ratio', 'min-resolution', 'pointer', '@font-face', 'EOT', 'SVG', 'TTF', 'WOFF', 'WOFF2', 'WOFF base64 encoded', 'WOFF2 base64 encoded', 'font-feature-settings', 'font-kerning', 'font-size-adjust', 'font-stretch', 'font-synthesis', 'font-variant', 'hyphens', 'letter-spacing', 'overflow-wrap', 'text-fill-color', 'text-size-adjust', 'text-stroke', 'text-stroke-color', 'text-stroke-width', 'background', 'background-blend-mode', 'background-image', 'isolation', 'mix-blend-mode', 'CSS gradients', 'border-image', 'BOX_MODEL_max-height', 'BOX_MODEL_max-width', 'BOX_MODEL_min-height', 'BOX_MODEL_min-width', 'cursor', 'object-fit', 'object-position', 'resize', 'list-style-image', 'animation', 'animation-delay', 'animation-direction', 'animation-duration', 'animation-fill-mode', 'animation-iteration-count', 'animation-name', 'animation-play-state', 'animation-timing-function', 'backface-visibility', 'perspective', 'transform', 'backdrop-filter', 'filter', 'break-after', 'break-before', 'break-inside', 'column-count', 'column-fill', 'column-gap', 'column-rule', 'column-rule-color', 'column-rule-style', 'column-rule-width', 'column-span', 'column-width', 'columns', 'GRID_align-content', 'GRID_align-items', 'GRID_align-self', 'flex', 'flex-basis', 'flex-direction', 'flex-flow', 'flex-grow', 'flex-shrink', 'flex-wrap', 'GRID_justify-content', 'order', 'FLEXBOX_align-content', 'FLEXBOX_align-items', 'FLEXBOX_align-self', 'GRID_display', 'grid', 'grid-area', 'grid-auto-columns', 'grid-auto-flow', 'grid-auto-rows', 'grid-column', 'grid-column-end', 'grid-column-gap', 'grid-column-start', 'grid-gap', 'grid-row', 'grid-row-end', 'grid-row-gap', 'grid-row-start', 'grid-template-areas', 'grid-template-columns', 'grid-template-rows', 'FLEXBOX_justify-content', 'justify-items', 'justify-self');

                        $tmp_css_pattern = 'transition-timing-function';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'transition-property';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'transition-duration';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'transition-delay';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'transition';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'transform-style';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'transform-origin';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'transform';
                        $tmp_note = 'Partial support with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'perspective-origin';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'perspective';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'animation-timing-function';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'animation-name';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'animation-play-state';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'animation-iteration-count';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'animation-fill-mode';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'animation-duration';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'animation-direction';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'animation-delay';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'animation';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'CSS gradients';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'background';
                        $tmp_note = 'Partial. Slash syntax values are not supported.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'text-stroke-width';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-stroke-color';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-stroke';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-fill-color';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'hyphens';
                        $tmp_note = 'Partial. Supports <code>none</code> with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'font-variant';
                        $tmp_note = 'Partial. Supports CSS2 values, but not CSS3.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        break;
                    case 'CRNRSTN_ANDROID_4_4_4_MAIL':

                        $tmp_regulated_string_patterns_ARRAY = array('any-hover', 'any-pointer', 'hover', 'max-aspect-ratio', 'max-device-pixel-ratio', 'MEDIA_QUERIES_max-height', 'min-aspect-ratio', 'min-device-pixel-ratio', 'EOT', 'WOFF2', 'WOFF2 base64 encoded', 'font-feature-settings', 'font-size-adjust', 'font-stretch', 'font-synthesis', 'font-variant', 'hyphens', 'text-fill-color', 'text-size-adjust', 'text-stroke', 'text-stroke-color', 'text-stroke-width', 'background', 'background-attachment', 'background-blend-mode', 'isolation', 'mix-blend-mode', 'border-image', 'BOX_MODEL_max-width', 'cursor', 'resize', 'animation', 'animation-delay', 'animation-direction', 'animation-duration', 'animation-fill-mode', 'animation-iteration-count', 'animation-name', 'animation-play-state', 'animation-timing-function', 'backface-visibility', 'perspective', 'backdrop-filter', 'break-after', 'break-before', 'break-inside', 'column-count', 'column-fill', 'column-gap', 'column-rule', 'column-rule-color', 'column-rule-style', 'column-rule-width', 'column-span', 'column-width', 'columns', 'GRID_align-content', 'GRID_align-items', 'GRID_align-self', 'GRID_display', 'grid', 'grid-area', 'grid-auto-columns', 'grid-auto-flow', 'grid-auto-rows', 'grid-column', 'grid-column-end', 'grid-column-gap', 'grid-column-start', 'grid-gap', 'grid-row', 'grid-row-end', 'grid-row-gap', 'grid-row-start', 'grid-template-areas', 'grid-template-columns', 'grid-template-rows', 'GRID_justify-content', 'justify-items', 'justify-self');

                        $tmp_css_pattern = 'filter';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'transform-style';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'transform-origin';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'transform';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'perspective-origin';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'perspective';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'backface-visibility';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'animation-timing-function';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'animation-play-state';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'animation-name';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'animation-iteration-count';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'animation-fill-mode';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'animation-duration';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'animation-direction';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'animation-delay';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'animation';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'resize';
                        $tmp_note = 'Buggy. Drag handles are visible, but not functional.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'BOX_MODEL_max-width';
                        $tmp_note = 'Partial. Not supported on tables.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'background';
                        $tmp_note = 'Partial. Fixed attachment is not supported.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'text-stroke-width';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-stroke-color';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-stroke';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-fill-color';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'font-variant';
                        $tmp_note = 'Partial. Supports CSS2 values, but not CSS3.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'font-feature-settings';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        break;
                    case 'CRNRSTN_AOL_ALTO_ANDROID_APP':

                        $tmp_regulated_string_patterns_ARRAY = array('<style> in <head>', '<style> in <body>', '<link> in <head>', '<link> in <body>', '@media', 'and', 'or (comma)', 'not', 'screen', 'only screen', 'all', 'any-hover', 'any-pointer', 'hover', 'max-aspect-ratio', 'max-device-aspect-ratio', 'max-device-height', 'max-device-pixel-ratio', 'max-device-width', 'MEDIA_QUERIES_max-height', 'max-resolution', 'MEDIA_QUERIES_max-width', 'min-aspect-ratio', 'min-device-aspect-ratio', 'min-device-height', 'min-device-pixel-ratio', 'min-device-width', 'MEDIA_QUERIES_min-height', 'min-resolution', 'MEDIA_QUERIES_min-width', 'orientation', 'pointer', 'EOT', 'SVG', 'TTF', 'WOFF', 'WOFF2', 'font-size-adjust', 'font-synthesis', 'hyphens', 'text-fill-color', 'text-indent', 'text-size-adjust', 'text-stroke', 'text-stroke-color', 'text-stroke-width', 'background', 'background-attachment', 'cursor', 'position', 'resize', 'backdrop-filter', 'FLEXBOX_align-self', 'flex', 'flex-basis', 'flex-direction', 'flex-flow', 'flex-grow', 'flex-shrink', 'flex-wrap', 'FLEXBOX_justify-content', 'order');

                        $tmp_css_pattern = 'resize';
                        $tmp_note = 'Buggy. Drag handles are visible, but not functional.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'position';
                        $tmp_note = 'Partial. Elements with <code>fixed</code> scroll with the page instead of remaining fixed.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'background';
                        $tmp_note = 'Partial. Fixed attachment is not supported.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'text-stroke-width';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-stroke-color';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-stroke';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-fill-color';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'hyphens';
                        $tmp_note = 'Partial. Breaks words, but doesn\'t add hyphens.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        break;
                    case 'CRNRSTN_AOL_ALTO_IOS_APP':

                        $tmp_regulated_string_patterns_ARRAY = array('<style> in <head>', '<style> in <body>', '<link> in <head>', '<link> in <body>', '@media', 'and', 'or (comma)', 'not', 'screen', 'only screen', 'all', 'any-hover', 'any-pointer', 'hover', 'max-aspect-ratio', 'max-device-aspect-ratio', 'max-device-height', 'max-device-pixel-ratio', 'max-device-width', 'MEDIA_QUERIES_max-height', 'max-resolution', 'MEDIA_QUERIES_max-width', 'min-aspect-ratio', 'min-device-aspect-ratio', 'min-device-height', 'min-device-pixel-ratio', 'min-device-width', 'MEDIA_QUERIES_min-height', 'min-resolution', 'MEDIA_QUERIES_min-width', 'orientation', 'pointer', 'EOT', 'SVG', 'TTF', 'WOFF', 'WOFF2', 'font-size-adjust', 'font-stretch', 'hyphens', 'text-fill-color', 'text-size-adjust', 'text-stroke', 'text-stroke-color', 'text-stroke-width', 'background-attachment', 'cursor', 'POSITIONING_AND_DISPLAY_display', 'position', 'resize', 'transform', 'transition', 'transition-delay', 'transition-duration', 'transition-property', 'transition-timing-function');

                        $tmp_css_pattern = 'backdrop-filter';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'transform';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'position';
                        $tmp_note = 'Partial. Elements with <code>fixed</code> scroll with the page instead of remaining fixed.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'POSITIONING_AND_DISPLAY_display';
                        $tmp_note = 'Partial. Sometimes supports <code>none</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'text-stroke-width';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-stroke-color';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-stroke';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-size-adjust';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-fill-color';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'hyphens';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        break;
                    case 'CRNRSTN_BLACKBERRY':

                        $tmp_regulated_string_patterns_ARRAY = array('<link> in <head>', '<link> in <body>', 'any-hover', 'any-pointer', 'hover', 'max-device-pixel-ratio', 'max-resolution', 'min-device-pixel-ratio', 'min-resolution', 'pointer', '@font-face', 'EOT', 'TTF', 'WOFF', 'WOFF2', 'WOFF base64 encoded', 'WOFF2 base64 encoded', 'font-feature-settings', 'font-kerning', 'font-size-adjust', 'font-stretch', 'font-synthesis', 'font-variant', 'hyphens', 'text-fill-color', 'text-size-adjust', 'text-stroke', 'text-stroke-color', 'text-stroke-width', 'word-spacing', 'background', 'background-attachment', 'background-blend-mode', 'isolation', 'mix-blend-mode', 'CSS gradients', 'BOX_MODEL_max-height', 'BOX_MODEL_max-width', 'BOX_MODEL_min-height', 'BOX_MODEL_min-width', 'cursor', 'object-fit', 'object-position', 'resize', 'list-style-type', 'animation', 'animation-delay', 'animation-direction', 'animation-duration', 'animation-fill-mode', 'animation-iteration-count', 'animation-name', 'animation-play-state', 'animation-timing-function', 'backface-visibility', 'perspective', 'backdrop-filter', 'break-after', 'break-before', 'break-inside', 'column-count', 'column-fill', 'column-gap', 'column-rule', 'column-rule-color', 'column-rule-style', 'column-rule-width', 'column-span', 'column-width', 'columns', 'GRID_align-content', 'GRID_align-items', 'GRID_align-self', 'FLEXBOX_align-content', 'flex', 'flex-basis', 'flex-direction', 'flex-flow', 'flex-grow', 'flex-shrink', 'flex-wrap', 'GRID_justify-content', 'order', 'FLEXBOX_align-items', 'FLEXBOX_align-self', 'GRID_display', 'FLEXBOX_display', 'grid', 'grid-area', 'grid-auto-columns', 'grid-auto-flow', 'grid-auto-rows', 'grid-column', 'grid-column-end', 'grid-column-gap', 'grid-column-start', 'grid-gap', 'grid-row', 'grid-row-end', 'grid-row-gap', 'grid-row-start', 'grid-template-areas', 'grid-template-columns', 'grid-template-rows', 'FLEXBOX_justify-content', 'justify-items', 'justify-self');

                        $tmp_css_pattern = 'filter';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'transition-timing-function';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'transition-property';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'transition-duration';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'transition-delay';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'transition';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'transform-style';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'transform-origin';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'transform';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'perspective-origin';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'perspective';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'backface-visibility';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'animation-timing-function';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'animation-name';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'animation-iteration-count';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'animation-fill-mode';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'animation-duration';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'animation-direction';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'animation-delay';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'animation-play-state';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'animation';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'list-style-type';
                        $tmp_note = 'Partial. Doesn\'t support <code>circle</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'BOX_MODEL_min-width';
                        $tmp_note = 'Partial. Not supported on tables.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'BOX_MODEL_min-height';
                        $tmp_note = 'Partial. Not supported on tables.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'BOX_MODEL_max-width';
                        $tmp_note = 'Partial. Not supported on tables.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'BOX_MODEL_max-height';
                        $tmp_note = 'Partial. Not supported on tables.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'CSS gradients';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'background';
                        $tmp_note = 'Partial. Fixed attachment is not supported.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'word-spacing';
                        $tmp_note = 'Partial. Supports spacing between words, but not spacing between elements.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'text-stroke-width';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-stroke-color';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-stroke';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-fill-color';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'hyphens';
                        $tmp_note = 'Partial support with <code>-webkit</code> prefix. Breaks words, but doesn\'t add hyphens.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'font-variant';
                        $tmp_note = 'Partial. Supports CSS2 values, but not CSS3.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'font-kerning';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        break;
                    case 'CRNRSTN_GMAIL_ANDROID_APP':

                        $tmp_regulated_string_patterns_ARRAY = array('<style> in <body>', '<link> in <head>', '<link> in <body>', 'not', 'any-hover', 'any-pointer', 'hover', 'max-aspect-ratio', 'max-device-aspect-ratio', 'max-device-height', 'max-device-pixel-ratio', 'MEDIA_QUERIES_max-height', 'min-aspect-ratio', 'min-device-aspect-ratio', 'min-device-height', 'min-device-pixel-ratio', 'MEDIA_QUERIES_min-height', 'pointer', '@font-face', 'EOT', 'SVG', 'TTF', 'WOFF', 'WOFF2', 'WOFF base64 encoded', 'WOFF2 base64 encoded', 'font-feature-settings', 'font-size', 'font-size-adjust', 'font-stretch', 'font-synthesis', 'hyphens', 'overflow-wrap', 'text-fill-color', 'text-overflow', 'text-shadow', 'text-stroke', 'text-stroke-color', 'text-stroke-width', 'background', 'background-attachment', 'Data URI background image', 'border-image', 'box-shadow', 'bottom', 'cursor', 'left', 'position', 'resize', 'right', 'top', 'visibility', 'z-index', 'list-style-image', 'table-layout', 'animation', 'animation-delay', 'animation-direction', 'animation-duration', 'animation-fill-mode', 'animation-iteration-count', 'animation-name', 'animation-play-state', 'animation-timing-function', 'backface-visibility', 'perspective', 'perspective-origin', 'transform', 'transform-origin', 'transform-style', 'transition', 'transition-delay', 'transition-duration', 'transition-property', 'transition-timing-function', 'backdrop-filter', 'filter', 'break-after', 'break-before', 'break-inside', 'column-count', 'column-fill', 'column-gap', 'column-rule', 'column-rule-color', 'column-rule-style', 'column-rule-width', 'column-span', 'column-width', 'columns', 'GRID_align-content', 'GRID_align-items', 'GRID_align-self', 'FLEXBOX_align-content', 'flex', 'flex-basis', 'flex-direction', 'flex-flow', 'flex-grow', 'flex-shrink', 'flex-wrap', 'GRID_justify-content', 'order', 'FLEXBOX_align-items', 'FLEXBOX_align-self', 'grid', 'grid-area', 'grid-auto-columns', 'grid-auto-flow', 'grid-auto-rows', 'grid-column', 'grid-column-end', 'grid-column-gap', 'grid-column-start', 'grid-gap', 'grid-row', 'grid-row-end', 'grid-row-gap', 'grid-row-start', 'grid-template-areas', 'grid-template-columns', 'grid-template-rows', 'FLEXBOX_justify-content', 'justify-items', 'justify-self');

                        $tmp_css_pattern = 'background';
                        $tmp_note = 'Partial. Fixed attachment is not supported.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'text-overflow';
                        $tmp_note = 'Property is supported, but the client breaks long words with <code>&lt;wbr&gt;</code> elements. And the <code>word-wrap</code> property defaults to <code>break-word</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'font-size';
                        $tmp_note = 'Partial. Doesn\'t support all keywords.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        break;
                    case 'CRNRSTN_GMAIL_ANDROID_IMAP':

                        $tmp_regulated_string_patterns_ARRAY = array('<style> in <head>', '<style> in <body>', '<link> in <head>', '<link> in <body>', '@media', 'and', 'or (comma)', 'not', 'screen', 'only screen', 'all', 'any-hover', 'any-pointer', 'hover', 'max-aspect-ratio', 'max-device-aspect-ratio', 'max-device-height', 'max-device-pixel-ratio', 'max-device-width', 'MEDIA_QUERIES_max-height', 'max-resolution', 'MEDIA_QUERIES_max-width', 'min-aspect-ratio', 'min-device-aspect-ratio', 'min-device-height', 'min-device-pixel-ratio', 'min-device-width', 'MEDIA_QUERIES_min-height', 'min-resolution', 'MEDIA_QUERIES_min-width', 'orientation', 'pointer', '@font-face', 'EOT', 'SVG', 'TTF', 'WOFF', 'WOFF2', 'WOFF base64 encoded', 'WOFF2 base64 encoded', 'font-feature-settings', 'font-kerning', 'font-size', 'font-size-adjust', 'font-stretch', 'font-synthesis', 'font-variant', 'hyphens', 'overflow-wrap', 'text-fill-color', 'text-overflow', 'text-size-adjust', 'text-stroke', 'text-stroke-color', 'text-stroke-width', 'background', 'background-attachment', 'background-blend-mode', 'background-clip', 'background-image', 'background-origin', 'background-position', 'background-repeat', 'background-size', 'isolation', 'mix-blend-mode', 'Data URI background image', 'Multiple background images', 'HSL Colors', 'HSLA Colors', 'currentColor', 'border-image', 'box-sizing', 'bottom', 'clear', 'cursor', 'left', 'object-fit', 'object-position', 'opacity', 'overflow', 'position', 'resize', 'right', 'top', 'visibility', 'z-index', 'list-style-image', 'animation', 'animation-delay', 'animation-direction', 'animation-duration', 'animation-fill-mode', 'animation-iteration-count', 'animation-name', 'animation-play-state', 'animation-timing-function', 'backface-visibility', 'perspective', 'perspective-origin', 'transform', 'transform-origin', 'transform-style', 'transition', 'transition-delay', 'transition-duration', 'transition-property', 'transition-timing-function', 'backdrop-filter', 'filter', 'break-after', 'break-before', 'break-inside', 'column-count', 'column-fill', 'column-gap', 'column-rule', 'column-rule-color', 'column-rule-style', 'column-rule-width', 'column-span', 'column-width', 'columns', 'GRID_align-content', 'GRID_align-self', 'GRID_align-items', 'FLEXBOX_align-content', 'flex', 'flex-basis', 'flex-direction', 'flex-flow', 'flex-grow', 'flex-shrink', 'flex-wrap', 'GRID_justify-content', 'order', 'FLEXBOX_align-items', 'GRID_display', 'FLEXBOX_display', 'grid', 'grid-area', 'grid-auto-columns', 'grid-auto-flow', 'grid-auto-rows', 'grid-column', 'grid-column-end', 'grid-column-gap', 'grid-column-start', 'grid-gap', 'grid-row', 'grid-row-end', 'grid-row-gap', 'grid-row-start', 'grid-template-areas', 'grid-template-columns', 'grid-template-rows', 'FLEXBOX_justify-content', 'justify-items', 'justify-self');

                        $tmp_css_pattern = 'background';
                        $tmp_note = 'Partial. Background images are not supported.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'font-variant';
                        $tmp_note = 'Partial. Supports CSS2 values, but not CSS3.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'font-size';
                        $tmp_note = 'Partial. Doesn\'t support all keywords.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        break;
                    case 'CRNRSTN_GMAIL_IOS_APP':

                        $tmp_regulated_string_patterns_ARRAY = array('<style> in <body>', '<link> in <head>', '<link> in <body>', 'and', 'not', 'any-hover', 'any-pointer', 'hover', 'max-aspect-ratio', 'max-device-aspect-ratio', 'max-device-height', 'max-device-pixel-ratio', 'MEDIA_QUERIES_max-height', 'max-resolution', 'min-aspect-ratio', 'min-device-aspect-ratio', 'min-device-height', 'min-device-pixel-ratio', 'MEDIA_QUERIES_min-height', 'min-resolution', 'pointer', '@font-face', 'EOT', 'SVG', 'TTF', 'WOFF', 'WOFF2', 'WOFF base64 encoded', 'WOFF2 base64 encoded', 'font-feature-settings', 'font-size-adjust', 'font-stretch', 'font-synthesis', 'hyphens', 'overflow-wrap', 'text-fill-color', 'text-overflow', 'text-shadow', 'text-size-adjust', 'text-stroke', 'text-stroke-color', 'text-stroke-width', 'word-wrap', 'background-attachment', 'Data URI background image', 'border-image', 'box-shadow', 'bottom', 'cursor', 'left', 'position', 'resize', 'right', 'top', 'visibility', 'z-index', 'list-style-image', 'animation', 'animation-delay', 'animation-direction', 'animation-duration', 'animation-fill-mode', 'animation-iteration-count', 'animation-name', 'animation-play-state', 'animation-timing-function', 'backface-visibility', 'perspective', 'perspective-origin', 'transform', 'transform-origin', 'transform-style', 'transition', 'transition-delay', 'transition-duration', 'transition-property', 'transition-timing-function', 'backdrop-filter', 'filter', 'break-after', 'break-before', 'break-inside', 'column-count', 'column-fill', 'column-gap', 'column-rule', 'column-rule-color', 'column-rule-style', 'column-rule-width', 'column-span', 'column-width', 'columns', 'GRID_align-content', 'GRID_align-items', 'GRID_align-self', 'FLEXBOX_align-content', 'flex', 'flex-basis', 'flex-direction', 'flex-flow', 'flex-grow', 'flex-shrink', 'flex-wrap', 'GRID_justify-content', 'order', 'FLEXBOX_align-items', 'FLEXBOX_align-self', 'grid', 'grid-area', 'grid-auto-columns', 'grid-auto-flow', 'grid-auto-rows', 'grid-column', 'grid-column-end', 'grid-column-gap', 'grid-column-start', 'grid-gap', 'grid-row', 'grid-row-end', 'grid-row-gap', 'grid-row-start', 'grid-template-areas', 'grid-template-columns', 'grid-template-rows', 'FLEXBOX_justify-content', 'justify-items', 'justify-self');

                        $tmp_css_pattern = 'word-wrap';
                        $tmp_note = 'Partial. Only supports <code>break-word</code> on the first line of text.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'text-overflow';
                        $tmp_note = 'Property is supported, but the client breaks long words with <code>&lt;wbr&gt;</code> elements. And the <code>word-wrap</code> property defaults to <code>break-word</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        break;
                    case 'CRNRSTN_GMAIL_MOBILE_WEBMAIL':

                        $tmp_regulated_string_patterns_ARRAY = array('<style> in <head>', '<style> in <body>', '<link> in <head>', '<link> in <body>', '@media', 'and', 'or (comma)', 'not', 'screen', 'only screen', 'all', 'any-hover', 'any-pointer', 'hover', 'max-aspect-ratio', 'max-device-aspect-ratio', 'max-device-height', 'max-device-pixel-ratio', 'max-device-width', 'MEDIA_QUERIES_max-height', 'max-resolution', 'MEDIA_QUERIES_max-width', 'min-aspect-ratio', 'min-device-aspect-ratio', 'min-device-height', 'min-device-pixel-ratio', 'min-device-width', 'MEDIA_QUERIES_min-height', 'min-resolution', 'MEDIA_QUERIES_min-width', 'orientation', 'pointer', '@font-face', 'EOT', 'SVG', 'TTF', 'WOFF', 'WOFF2', 'WOFF base64 encoded', 'WOFF2 base64 encoded', 'font-feature-settings', 'font-kerning', 'font-size-adjust', 'font-stretch', 'font-synthesis', 'hyphens', 'overflow-wrap', 'text-fill-color', 'text-overflow', 'text-shadow', 'text-size-adjust', 'text-stroke', 'text-stroke-color', 'text-stroke-width', 'word-wrap', 'background-attachment', 'background-blend-mode', 'background-clip', 'background-origin', 'background-size', 'isolation', 'mix-blend-mode', 'Data URI background image', 'border-image', 'box-shadow', 'box-sizing', 'bottom', 'cursor', 'left', 'object-fit', 'object-position', 'opacity', 'overflow', 'position', 'resize', 'right', 'top', 'visibility', 'z-index', 'list-style-image', 'animation', 'animation-delay', 'animation-direction', 'animation-duration', 'animation-fill-mode', 'animation-iteration-count', 'animation-name', 'animation-play-state', 'animation-timing-function', 'backface-visibility', 'perspective', 'perspective-origin', 'transform', 'transform-origin', 'transform-style', 'transition', 'transition-delay', 'transition-duration', 'transition-property', 'transition-timing-function', 'backdrop-filter', 'filter', 'break-after', 'break-before', 'break-inside', 'column-count', 'column-fill', 'column-gap', 'column-rule', 'column-rule-color', 'column-rule-style', 'column-rule-width', 'column-span', 'column-width', 'columns', 'GRID_align-content', 'GRID_align-items', 'GRID_align-self', 'FLEXBOX_align-content', 'flex', 'flex-basis', 'flex-direction', 'flex-flow', 'flex-grow', 'flex-shrink', 'flex-wrap', 'GRID_justify-content', 'order', 'FLEXBOX_align-items', 'FLEXBOX_align-self', 'grid', 'grid-area', 'grid-auto-columns', 'grid-auto-flow', 'grid-auto-rows', 'grid-column', 'grid-column-end', 'grid-column-gap', 'grid-column-start', 'grid-gap', 'grid-row', 'grid-row-end', 'grid-row-gap', 'grid-row-start', 'grid-template-areas', 'grid-template-columns', 'grid-template-rows', 'FLEXBOX_justify-content', 'justify-items', 'justify-self');

                        $tmp_css_pattern = 'overflow';
                        $tmp_note = 'Partial. Clipping works, but scrolling doesn\'t.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'word-wrap';
                        $tmp_note = 'Partial. Only supports <code>break-word</code> on the first line of text.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'text-overflow';
                        $tmp_note = 'Property is supported, but the client breaks long words with <code>&lt;wbr&gt;</code> elements. And the <code>word-wrap</code> property defaults to <code>break-word</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        break;
                    case 'CRNRSTN_GOOGLE_INBOX_ANDROID_APP':

                        $tmp_regulated_string_patterns_ARRAY = array('<style> in <body>', '<link> in <head>', '<link> in <body>', 'not', 'any-hover', 'any-pointer', 'hover', 'max-aspect-ratio', 'max-device-aspect-ratio', 'max-device-height', 'max-device-pixel-ratio', 'MEDIA_QUERIES_max-height', 'min-aspect-ratio', 'min-device-aspect-ratio', 'min-device-height', 'min-device-pixel-ratio', 'MEDIA_QUERIES_min-height', 'pointer', '@font-face', 'EOT', 'SVG', 'TTF', 'WOFF', 'WOFF2', 'WOFF base64 encoded', 'WOFF2 base64 encoded', 'font-feature-settings', 'font-size-adjust', 'font-stretch', 'font-synthesis', 'hyphens', 'overflow-wrap', 'text-fill-color', 'text-overflow', 'text-shadow', 'text-size-adjust', 'text-stroke', 'text-stroke-color', 'text-stroke-width', 'background', 'background-attachment', 'Data URI background image', 'border-image', 'box-shadow', 'bottom', 'cursor', 'left', 'position', 'resize', 'right', 'top', 'visibility', 'z-index', 'list-style-image', 'animation', 'animation-delay', 'animation-direction', 'animation-duration', 'animation-fill-mode', 'animation-iteration-count', 'animation-name', 'animation-play-state', 'animation-timing-function', 'backface-visibility', 'perspective', 'perspective-origin', 'transform', 'transform-origin', 'transform-style', 'transition', 'transition-delay', 'transition-duration', 'transition-property', 'transition-timing-function', 'backdrop-filter', 'filter', 'break-after', 'break-before', 'break-inside', 'column-count', 'column-fill', 'column-gap', 'column-rule', 'column-rule-color', 'column-rule-style', 'column-rule-width', 'column-span', 'column-width', 'columns', 'GRID_align-content', 'GRID_align-items', 'GRID_align-self', 'FLEXBOX_align-content', 'flex', 'flex-basis', 'flex-direction', 'flex-flow', 'flex-grow', 'flex-shrink', 'flex-wrap', 'GRID_justify-content', 'order', 'FLEXBOX_align-items', 'FLEXBOX_align-self', 'GRID_display', 'grid', 'grid-area', 'grid-auto-columns', 'grid-auto-flow', 'grid-auto-rows', 'grid-column', 'grid-column-end', 'grid-column-gap', 'grid-column-start', 'grid-gap', 'grid-row', 'grid-row-end', 'grid-row-gap', 'grid-row-start', 'grid-template-areas', 'grid-template-columns', 'grid-template-rows', 'FLEXBOX_justify-content', 'justify-items', 'justify-self');

                        $tmp_css_pattern = 'background';
                        $tmp_note = 'Partial. Fixed attachment is not supported.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'text-overflow';
                        $tmp_note = 'Property is supported, but the client breaks long words with <code>&lt;wbr&gt;</code> elements. And the <code>word-wrap</code> property defaults to <code>break-word</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        break;
                    case 'CRNRSTN_GOOGLE_INBOX_IOS_APP':

                        $tmp_regulated_string_patterns_ARRAY = array('Data URI background image', '<style> in <body>', '<link> in <body>','<link> in <head>', 'and', 'not', 'any-hover', 'any-pointer', 'hover', 'max-aspect-ratio', 'max-device-aspect-ratio', 'max-device-height', 'max-device-pixel-ratio', 'MEDIA_QUERIES_max-height', 'max-resolution', 'min-aspect-ratio', 'min-device-aspect-ratio', 'min-device-height', 'min-device-pixel-ratio', 'MEDIA_QUERIES_min-height', 'min-resolution', 'pointer', '@font-face', 'EOT', 'SVG', 'TTF', 'WOFF', 'WOFF2', 'WOFF base64 encoded', 'WOFF2 base64 encoded', 'font-feature-settings', 'font-size-adjust', 'font-stretch', 'font-synthesis', 'hyphens', 'overflow-wrap', 'text-fill-color', 'text-overflow', 'text-shadow', 'text-size-adjust', 'text-stroke', 'text-stroke-color', 'text-stroke-width', 'word-wrap', 'background-attachment', 'border-image', 'box-shadow', 'bottom', 'cursor', 'left', 'position', 'resize', 'right', 'top', 'visibility', 'z-index', 'list-style-image', 'animation', 'animation-delay', 'animation-direction', 'animation-duration', 'animation-fill-mode', 'animation-iteration-count', 'animation-name', 'animation-play-state', 'animation-timing-function', 'backface-visibility', 'perspective', 'perspective-origin', 'transform', 'transform-origin', 'transform-style', 'transition', 'transition-delay', 'transition-duration', 'transition-property', 'transition-timing-function', 'backdrop-filter', 'filter', 'break-after', 'break-before', 'break-inside', 'column-count', 'column-fill', 'column-gap', 'column-rule', 'column-rule-color', 'column-rule-style', 'column-rule-width', 'column-span', 'column-width', 'columns', 'GRID_align-content', 'GRID_align-items', 'GRID_align-self', 'FLEXBOX_align-content', 'flex', 'flex-basis', 'flex-direction', 'flex-flow', 'flex-grow', 'flex-shrink', 'flex-wrap', 'GRID_justify-content', 'order', 'FLEXBOX_align-items', 'FLEXBOX_align-self', 'grid', 'grid-area', 'grid-auto-columns', 'grid-auto-flow', 'grid-auto-rows', 'grid-column-end', 'grid-column-gap', 'grid-column-start', 'grid-gap', 'grid-row', 'grid-row-end', 'grid-row-gap', 'grid-row-start', 'grid-template-areas', 'grid-template-columns', 'grid-template-rows', 'FLEXBOX_justify-content', 'justify-items', 'justify-self');

                        $tmp_css_pattern = 'word-wrap';
                        $tmp_note = 'Buggy. Only supports <code>break-word</code> on the first line of text.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'text-overflow';
                        $tmp_note = 'Property is supported, but the client breaks long words with <code>&lt;wbr&gt;</code> elements. And the <code>word-wrap</code> property defaults to <code>break-word</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        break;
                    case 'CRNRSTN_IOS_10_MAIL':

                        $tmp_regulated_string_patterns_ARRAY = array('max-device-pixel-ratio', 'max-resolution', 'min-device-pixel-ratio', 'min-resolution', 'EOT', 'font-size', 'font-size-adjust', 'hyphens', 'text-fill-color', 'text-size-adjust', 'text-stroke', 'text-stroke-color', 'text-stroke-width', 'background-attachment', 'cursor', 'position', 'resize', 'backface-visibility', 'transform');

                        $tmp_css_pattern = 'backdrop-filter';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'transform';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'backface-visibility';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'position';
                        $tmp_note = 'Partial. Elements with <code>fixed</code> scroll with the page instead of remaining fixed.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'text-stroke-width';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-stroke-color';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-stroke';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-size-adjust';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-fill-color';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'hyphens';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'font-size';
                        $tmp_note = 'By default, minimum font size is 13px. Use <code>-webkit-text-size-adjust: 100%;</code> to override.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        break;
                    case 'CRNRSTN_IOS_11_MAIL':

                        $tmp_regulated_string_patterns_ARRAY = array('max-device-pixel-ratio', 'max-resolution', 'min-device-pixel-ratio', 'min-resolution', 'EOT', 'font-size', 'font-size-adjust', 'hyphens', 'text-fill-color', 'text-stroke', 'text-stroke-color', 'text-stroke-width', 'background-attachment', 'cursor', 'position', 'resize', 'backface-visibility', 'transform');

                        $tmp_css_pattern = 'backdrop-filter';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'transform';
                        $tmp_note = 'Buggy.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'backface-visibility';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'position';
                        $tmp_note = 'Partial. Elements with <code>fixed</code> scroll with the page instead of remaining fixed.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'text-stroke-width';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-stroke-color';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-stroke';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-fill-color';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'hyphens';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'font-size';
                        $tmp_note = 'By default, minimum font size is 13px. Use <code>-webkit-text-size-adjust: 100%;</code> to override.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        break;
                    case 'CRNRSTN_OUTLOOK_ANDROID_APP':

                        $tmp_regulated_string_patterns_ARRAY = array('max-aspect-ratio', 'max-device-pixel-ratio', 'MEDIA_QUERIES_max-height', 'min-aspect-ratio', 'min-device-pixel-ratio', 'EOT', 'SVG', 'TTF', 'WOFF', 'WOFF2', 'font-feature-settings', 'font-size-adjust', 'font-synthesis', 'hyphens', 'text-fill-color', 'text-stroke', 'text-stroke-color', 'text-stroke-width', 'background', 'background-attachment', 'cursor', 'overflow', 'resize', 'table-layout', 'transition', 'transition-delay', 'transition-duration', 'transition-property', 'transition-timing-function', 'backdrop-filter');

                        $tmp_css_pattern = 'resize';
                        $tmp_note = 'Buggy. Drag handles are visible, but not functional.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'overflow';
                        $tmp_note = 'Partial. Clipping works, but scrolling doesn\'t.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'background';
                        $tmp_note = 'Partial. Fixed attachment is not supported.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'text-stroke-width';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-stroke-color';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-stroke';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-fill-color';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);


                        break;
                    case 'CRNRSTN_OUTLOOK_IOS_APP':

                        $tmp_regulated_string_patterns_ARRAY = array('grid-column', 'GRID_align-self', 'max-device-pixel-ratio', 'max-resolution', 'min-device-pixel-ratio', 'min-resolution', '@font-face', 'EOT', 'SVG', 'TTF', 'WOFF', 'WOFF2', 'WOFF base64 encoded', 'WOFF2 base64 encoded', 'font-feature-settings', 'font-kerning', 'font-size-adjust', 'font-stretch', 'font-synthesis', 'hyphens', 'overflow-wrap', 'text-fill-color', 'text-shadow', 'text-size-adjust', 'text-stroke', 'text-stroke-color', 'text-stroke-width', 'white-space', 'background-attachment', 'isolation', 'mix-blend-mode', 'CSS gradients', 'HSL Colors', 'HSLA Colors', 'border-image', 'box-shadow', 'box-sizing', 'bottom', 'cursor', 'left', 'object-fit', 'object-position', 'opacity', 'position', 'resize', 'right', 'top', 'z-index', 'list-style-image', 'table-layout', 'animation', 'animation-delay', 'animation-direction', 'animation-duration', 'animation-fill-mode', 'animation-iteration-count', 'animation-name', 'animation-play-state', 'animation-timing-function', 'backface-visibility', 'perspective', 'perspective-origin', 'transform', 'transform-origin', 'transform-style', 'transition', 'transition-delay', 'transition-duration', 'transition-property', 'transition-timing-function', 'backdrop-filter', 'filter', 'break-after', 'break-before', 'break-inside', 'column-count', 'column-fill', 'column-gap', 'column-rule', 'column-rule-color', 'column-rule-style', 'column-rule-width', 'column-span', 'column-width', 'columns', 'FLEXBOX_align-content', 'FLEXBOX_align-self', 'flex', 'flex-basis', 'flex-direction', 'flex-flow', 'flex-grow', 'flex-shrink', 'flex-wrap', 'GRID_justify-content', 'GRID_align-self', 'grid', 'grid-area', 'grid-auto-columns', 'grid-auto-flow', 'grid-auto-rows', 'grid-column-end', 'grid-column-gap', 'grid-column-start', 'grid-gap', 'grid-row', 'grid-row-end', 'grid-row-gap', 'grid-row-start', 'grid-template-areas', 'grid-template-columns', 'grid-template-rows', 'FLEXBOX_justify-content', 'justify-items', 'justify-self');

                        break;
                    case 'CRNRSTN_SPARROW':

                        $tmp_regulated_string_patterns_ARRAY = array('max-device-aspect-ratio', 'max-device-pixel-ratio', 'max-resolution', 'min-device-pixel-ratio', 'min-resolution', 'EOT', 'font-feature-settings', 'font-size-adjust', 'font-stretch', 'hyphens', 'text-fill-color', 'text-size-adjust', 'text-stroke', 'text-stroke-color', 'text-stroke-width', 'background-attachment', 'cursor', 'position', 'resize', 'table-layout', 'transform-style', 'FLEXBOX_align-items', 'FLEXBOX_align-self', 'flex', 'flex-basis', 'flex-grow', 'flex-shrink', 'flex-wrap');

                        $tmp_css_pattern = 'position';
                        $tmp_note = 'Partial. Elements with <code>fixed</code> scroll with the page instead of remaining fixed.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'text-stroke-width';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-stroke-color';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-stroke';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-size-adjust';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-fill-color';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'hyphens';
                        $tmp_note = 'Supported with <code>-webkit</code> prefix.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        break;
                    case 'CRNRSTN_WINDOWS_PHONE_8_MAIL':

                        $tmp_regulated_string_patterns_ARRAY = array('caption-side', '<link> in <head>', '<link> in <body>', 'and', 'or (comma)', 'not', 'only screen', 'any-hover', 'any-pointer', 'hover', 'max-aspect-ratio', 'max-device-aspect-ratio', 'max-device-height', 'max-device-pixel-ratio', 'max-device-width', 'MEDIA_QUERIES_max-height', 'max-resolution', 'MEDIA_QUERIES_max-width', 'min-aspect-ratio', 'min-device-aspect-ratio', 'min-device-height', 'min-device-pixel-ratio', 'min-device-width', 'MEDIA_QUERIES_min-height', 'min-resolution', 'MEDIA_QUERIES_min-width', 'orientation', 'pointer', '@font-face', 'EOT', 'SVG', 'TTF', 'WOFF', 'WOFF2', 'WOFF base64 encoded', 'WOFF2 base64 encoded', 'font-family', 'font-feature-settings', 'font-kerning', 'font-size-adjust', 'font-stretch', 'font-synthesis', 'font-variant', 'hyphens', 'overflow-wrap', 'text-fill-color', 'text-overflow', 'text-shadow', 'text-size-adjust', 'text-stroke', 'text-stroke-color', 'text-stroke-width', 'white-space', 'word-wrap', 'background', 'background-attachment', 'background-blend-mode', 'background-clip', 'background-image', 'background-origin', 'background-position', 'background-repeat', 'background-size', 'isolation', 'mix-blend-mode', 'CSS gradients', 'Data URI background image', 'HSL Colors', 'HSLA Colors', 'RGBA Colors', 'currentColor', 'border-bottom-left-radius', 'border-bottom-right-radius', 'border-image', 'border-radius', 'border-top-left-radius', 'border-top-right-radius', 'box-shadow', 'box-sizing', 'BOX_MODEL_max-height', 'BOX_MODEL_min-height', 'BOX_MODEL_max-width', 'BOX_MODEL_min-width', 'bottom', 'cursor', 'GRID_display', 'object-fit', 'object-position', 'opacity', 'outline', 'outline-color', 'outline-style', 'outline-width', 'overflow', 'resize', 'top', 'list-style-image', 'list-style-type', 'border-collapse', 'border-spacing', 'animation', 'animation-delay', 'animation-direction', 'animation-duration', 'animation-fill-mode', 'animation-iteration-count', 'animation-name', 'animation-play-state', 'animation-timing-function', 'backface-visibility', 'perspective', 'perspective-origin', 'transform', 'transform-origin', 'transform-style', 'transition', 'transition-delay', 'transition-duration', 'transition-property', 'transition-timing-function', 'backdrop-filter', 'filter', 'break-after', 'break-before', 'break-inside', 'column-count', 'column-fill', 'column-gap', 'column-rule', 'column-rule-color', 'column-rule-style', 'column-rule-width', 'column-span', 'column-width', 'columns', 'GRID_align-content', 'GRID_align-items', 'GRID_align-self', 'FLEXBOX_align-content', 'flex', 'flex-basis', 'flex-direction', 'flex-flow', 'flex-grow', 'flex-shrink', 'flex-wrap', 'GRID_justify-content', 'order', 'FLEXBOX_align-items', 'FLEXBOX_align-self', 'FLEXBOX_display', 'grid', 'grid-area', 'grid-auto-columns', 'grid-auto-flow', 'grid-auto-rows', 'grid-column', 'grid-column-end', 'grid-column-gap', 'grid-column-start', 'grid-gap', 'grid-row', 'grid-row-end', 'grid-row-gap', 'grid-row-start', 'grid-template-areas', 'grid-template-columns', 'grid-template-rows', 'FLEXBOX_justify-content', 'justify-items', 'justify-self');

                        $tmp_css_pattern = 'border-collapse';
                        $tmp_note = 'Supported, but the HTML attribute <code>cellspacing</code> takes precedence over it.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'list-style-type';
                        $tmp_note = 'Partial. Supports <code>none</code>, <code>disc</code>, <code>circle</code>, <code>square</code>, <code>decimal</code>, <code>lower-alpha</code>, <code>upper-alpha</code>, <code>lower-roman</code>, and <code>upper-roman</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'overflow';
                        $tmp_note = 'Buggy. Elements with <code>visible</code> are covered by the next element.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'POSITIONING_AND_DISPLAY_display';
                        $tmp_note = 'Partial. Supports <code>block</code>, <code>inline</code>, <code>list-item</code>, and <code>none</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'background';
                        $tmp_note = 'Partial. Seems to only support background colors.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'font-variant';
                        $tmp_note = 'Partial. Supports CSS2 values, but not CSS3.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'font-family';
                        $tmp_note = 'Mostly supported, but unquoted font names containing line breaks don\'t work.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        break;
                    case 'CRNRSTN_YAHOO_MAIL_ANDROID_APP':

                        $tmp_regulated_string_patterns_ARRAY = array('<style> in <head>', '<link> in <head>', '<link> in <body>', 'and', 'or (comma)', 'not', 'any-hover', 'any-pointer', 'hover', 'max-aspect-ratio', 'max-device-aspect-ratio', 'max-device-height', 'max-device-pixel-ratio', 'max-device-width', 'max-resolution', 'min-aspect-ratio', 'min-device-aspect-ratio', 'min-device-height', 'min-device-pixel-ratio', 'min-device-width', 'min-resolution', 'orientation', 'pointer', '@font-face', 'EOT', 'SVG', 'TTF', 'WOFF', 'WOFF2', 'WOFF base64 encoded', 'WOFF2 base64 encoded', 'font-feature-settings', 'font-kerning', 'font-size-adjust', 'font-synthesis', 'font-variant', 'hyphens', 'overflow-wrap', 'text-fill-color', 'text-overflow', 'text-shadow', 'text-stroke', 'text-stroke-color', 'text-stroke-width', 'background', 'background-attachment', 'background-blend-mode', 'background-clip', 'background-image', 'background-origin', 'background-position', 'background-repeat', 'background-size', 'isolation', 'mix-blend-mode', 'CSS gradients', 'Data URI background image', 'Multiple background images', 'HSL Colors', 'HSLA Colors', 'RGBA Colors', 'border-image', 'box-shadow', 'box-sizing', 'height', 'BOX_MODEL_max-height', 'BOX_MODEL_max-width', 'BOX_MODEL_min-height', 'BOX_MODEL_min-width', 'bottom', 'cursor', 'left', 'object-fit', 'object-position', 'opacity', 'overflow', 'position', 'resize', 'right', 'top', 'z-index', 'list-style-image', 'animation', 'animation-delay', 'animation-direction', 'animation-duration', 'animation-fill-mode', 'animation-iteration-count', 'animation-name', 'animation-play-state', 'animation-timing-function', 'backface-visibility', 'perspective', 'perspective-origin', 'transform', 'transform-origin', 'transform-style', 'transition', 'transition-delay', 'transition-duration', 'transition-property', 'transition-timing-function', 'backdrop-filter', 'filter', 'break-after', 'break-before', 'break-inside', 'column-count', 'column-fill', 'column-gap', 'column-rule', 'column-rule-color', 'column-rule-style', 'column-rule-width', 'column-span', 'column-width', 'columns', 'GRID_align-content', 'GRID_align-items', 'GRID_align-self', 'FLEXBOX_align-content', 'flex', 'flex-basis', 'flex-direction', 'flex-flow', 'flex-grow', 'flex-shrink', 'flex-wrap', 'GRID_justify-content', 'order', 'FLEXBOX_align-items', 'FLEXBOX_align-self', 'GRID_display', 'FLEXBOX_display', 'grid', 'grid-area', 'grid-auto-columns', 'grid-auto-flow', 'grid-auto-rows', 'grid-column', 'grid-column-end', 'grid-column-gap', 'grid-column-start', 'grid-gap', 'grid-row', 'grid-row-end', 'grid-row-gap', 'grid-row-start', 'grid-template-areas', 'grid-template-columns', 'grid-template-rows', 'FLEXBOX_justify-content', 'justify-items', 'justify-self');

                        $tmp_css_pattern = 'overflow';
                        $tmp_note = 'Partial. Clipping works, but scrolling doesn\'t.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'height';
                        $tmp_note = 'Buggy. Client changes the <code>height</code> property to <code>min-height</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'background';
                        $tmp_note = 'Partial. Seems to only support background colors.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'text-shadow';
                        $tmp_note = 'Partial. Supports a single shadow per element, but not multiple.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'font-variant';
                        $tmp_note = 'Partial. Supports CSS2 values, but not CSS3.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        break;
                    case 'CRNRSTN_YAHOO_MAIL_IOS_APP':

                        $tmp_regulated_string_patterns_ARRAY = array('<link> in <head>', '<link> in <body>', 'and', 'or (comma)', 'not', 'any-hover', 'any-pointer', 'hover', 'max-aspect-ratio', 'max-device-aspect-ratio', 'max-device-height', 'max-device-pixel-ratio', 'max-device-width', 'max-resolution', 'min-aspect-ratio', 'min-device-aspect-ratio', 'min-device-height', 'min-device-pixel-ratio', 'min-device-width', 'min-resolution', 'orientation', 'pointer', '@font-face', 'EOT', 'SVG', 'TTF', 'WOFF', 'WOFF2', 'WOFF base64 encoded', 'WOFF2 base64 encoded', 'font-feature-settings', 'font-kerning', 'font-size-adjust', 'font-stretch', 'font-synthesis', 'font-variant', 'hyphens', 'overflow-wrap', 'text-fill-color', 'text-overflow', 'text-shadow', 'text-size-adjust', 'text-stroke', 'text-stroke-color', 'text-stroke-width', 'word-wrap', 'background', 'background-attachment', 'background-blend-mode', 'background-clip', 'background-origin', 'isolation', 'mix-blend-mode', 'CSS gradients', 'Data URI background image', 'Multiple background images', 'HSL Colors', 'HSLA Colors', 'RGBA Colors', 'border-image', 'box-shadow', 'box-sizing', 'height', 'BOX_MODEL_min-height', 'bottom', 'left', 'object-fit', 'object-position', 'opacity', 'position', 'resize', 'right', 'top', 'z-index', 'table-layout', 'animation', 'animation-delay', 'animation-direction', 'animation-duration', 'animation-fill-mode', 'animation-iteration-count', 'animation-name', 'animation-play-state', 'animation-timing-function', 'backface-visibility', 'perspective', 'perspective-origin', 'transform', 'transform-origin', 'transform-style', 'transition', 'transition-delay', 'transition-duration', 'transition-property', 'transition-timing-function', 'backdrop-filter', 'filter', 'break-after', 'break-before', 'break-inside', 'column-count', 'column-fill', 'column-gap', 'column-rule', 'column-rule-color', 'column-rule-style', 'column-rule-width', 'column-span', 'column-width', 'columns', 'GRID_align-content', 'GRID_align-items', 'GRID_align-self', 'FLEXBOX_align-content', 'flex', 'flex-basis', 'flex-direction', 'flex-flow', 'flex-grow', 'flex-shrink', 'flex-wrap', 'GRID_justify-content', 'order', 'FLEXBOX_align-items', 'FLEXBOX_align-self', 'GRID_display', 'FLEXBOX_display', 'grid', 'grid-area', 'grid-auto-columns', 'grid-auto-flow', 'grid-auto-rows', 'grid-column', 'grid-column-end', 'grid-column-gap', 'grid-column-gap', 'grid-column-start', 'grid-gap', 'grid-row', 'grid-row-end', 'grid-row-gap', 'grid-row-start', 'grid-template-areas', 'grid-template-columns', 'grid-template-rows', 'FLEXBOX_justify-content', 'justify-items', 'justify-self');

                        $tmp_css_pattern = 'BOX_MODEL_min-height';
                        $tmp_note = 'Supported, but because the client changes <code>height</code> to <code>min-height</code>, that value will override this one if it comes after.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'height';
                        $tmp_note = 'Buggy. Client changes the <code>height</code> property to <code>min-height</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'background';
                        $tmp_note = 'Partial. Slash syntax values are not supported.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'text-shadow';
                        $tmp_note = 'Partial. Supports a single shadow per element, but not multiple.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'font-variant';
                        $tmp_note = 'Partial. Supports CSS2 values, but not CSS3.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        break;


                    case 'CRNRSTN_AOL_MAIL':

                        $tmp_regulated_string_patterns_ARRAY = array('<style> in <head>', '<style> in <body>', '<link> in <head>', '<link> in <body>', '@media', 'and', 'or (comma)', 'not', 'screen', 'only screen', 'all', 'any-hover', 'any-pointer', 'hover', 'max-aspect-ratio', 'max-device-aspect-ratio', 'max-device-height', 'max-device-pixel-ratio', 'max-device-width', 'MEDIA_QUERIES_max-height', 'max-resolution', 'MEDIA_QUERIES_max-width', 'min-aspect-ratio', 'min-device-aspect-ratio', 'min-device-height', 'min-device-pixel-ratio', 'min-device-width', 'MEDIA_QUERIES_min-height', 'min-resolution', 'MEDIA_QUERIES_min-width', 'orientation', 'pointer', '@font-face', 'EOT', 'SVG', 'TTF', 'WOFF', 'WOFF2', 'font-synthesis');

                        $tmp_css_pattern = '@font-face';
                        $tmp_note = 'When images are downloaded.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        break;
                    case 'CRNRSTN_G_SUITE':

                        $tmp_regulated_string_patterns_ARRAY = array('<style> in <body>', '<link> in <head>', '<link> in <body>', 'not', 'any-hover', 'any-pointer', 'hover', 'max-aspect-ratio', 'max-device-aspect-ratio', 'max-device-height', 'max-device-pixel-ratio', 'MEDIA_QUERIES_max-height', 'min-aspect-ratio', 'min-device-aspect-ratio', 'min-device-height', 'min-device-pixel-ratio', 'MEDIA_QUERIES_min-height', 'pointer', '@font-face', 'EOT', 'SVG', 'TTF', 'WOFF', 'WOFF2', 'WOFF base64 encoded', 'WOFF2 base64 encoded', 'font-stretch', 'hyphens', 'overflow-wrap', 'text-fill-color', 'text-overflow', 'text-shadow', 'text-size-adjust', 'text-stroke', 'text-stroke-color', 'text-stroke-width', 'background-attachment', 'Data URI background image', 'border-image', 'box-shadow', 'bottom', 'cursor', 'left', 'position', 'resize', 'right', 'top', 'visibility', 'z-index', 'list-style-image', 'animation', 'animation-delay', 'animation-direction', 'animation-duration', 'animation-fill-mode', 'animation-iteration-count', 'animation-name', 'animation-play-state', 'animation-timing-function', 'backface-visibility', 'perspective', 'perspective-origin', 'transform', 'transform-origin', 'transform-style', 'transition', 'transition-delay', 'transition-duration', 'transition-property', 'transition-timing-function', 'backdrop-filter', 'filter', 'break-after', 'break-before', 'break-inside', 'column-count', 'column-fill', 'column-gap', 'column-rule', 'column-rule-color', 'column-rule-style', 'column-rule-width', 'column-span', 'column-width', 'columns', 'GRID_align-content', 'GRID_align-items', 'GRID_align-self', 'FLEXBOX_align-content', 'flex', 'flex-basis', 'flex-direction', 'flex-flow', 'flex-grow', 'flex-shrink', 'flex-wrap', 'GRID_justify-content', 'order', 'FLEXBOX_align-items', 'FLEXBOX_align-self', 'grid', 'grid-area', 'grid-auto-columns', 'grid-auto-flow', 'grid-auto-rows', 'grid-column', 'grid-column-end', 'grid-column-gap', 'grid-column-start', 'grid-gap', 'grid-gap', 'grid-row', 'grid-row-end', 'grid-row-gap', 'grid-row-start', 'grid-template-areas', 'grid-template-columns', 'grid-template-rows', 'FLEXBOX_justify-content', 'justify-items', 'justify-self');

                        $tmp_css_pattern = 'text-overflow';
                        $tmp_note = 'Property is supported, but the client breaks long words with <code>&lt;wbr&gt;</code> elements. And the <code>word-wrap</code> property defaults to <code>break-word</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'font-stretch';
                        $tmp_note = 'The property itself is intact, but the necessary media query is removed.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ERR_X);

                        break;
                    case 'CRNRSTN_GMAIL':

                        $tmp_regulated_string_patterns_ARRAY = array('<style> in <body>', '<link> in <head>', '<link> in <body>', 'not', 'any-hover', 'any-pointer', 'hover', 'max-aspect-ratio', 'max-device-aspect-ratio', 'max-device-height', 'max-device-pixel-ratio', 'MEDIA_QUERIES_max-height', 'min-aspect-ratio', 'min-device-aspect-ratio', 'min-device-height', 'min-device-pixel-ratio', 'MEDIA_QUERIES_min-height', 'pointer', '@font-face', 'EOT', 'SVG', 'TTF', 'WOFF', 'WOFF2', 'WOFF base64 encoded', 'WOFF2 base64 encoded', 'font-stretch', 'hyphens', 'overflow-wrap', 'text-fill-color', 'text-overflow', 'text-shadow', 'text-size-adjust', 'text-stroke', 'text-stroke-color', 'text-stroke-width', 'background-attachment', 'Data URI background image', 'border-image', 'box-shadow', 'bottom', 'cursor', 'left', 'position', 'resize', 'right', 'top', 'visibility', 'z-index', 'list-style-image', 'animation', 'animation-delay', 'animation-direction', 'animation-duration', 'animation-fill-mode', 'animation-iteration-count', 'animation-name', 'animation-play-state', 'animation-timing-function', 'backface-visibility', 'perspective', 'perspective-origin', 'transform', 'transform-origin', 'transform-style', 'transition', 'transition-delay', 'transition-duration', 'transition-property', 'transition-timing-function', 'backdrop-filter', 'filter', 'break-after', 'break-before', 'break-inside', 'column-count', 'column-fill', 'column-gap', 'column-rule', 'column-rule-color', 'column-rule-style', 'column-rule-width', 'column-span', 'column-width', 'columns', 'GRID_align-content', 'GRID_align-items', 'GRID_align-self', 'FLEXBOX_align-content', 'flex', 'flex-basis', 'flex-direction', 'flex-flow', 'flex-grow', 'flex-shrink', 'flex-wrap', 'GRID_justify-content', 'order', 'FLEXBOX_align-items', 'FLEXBOX_align-self', 'grid', 'grid-area', 'grid-auto-columns', 'grid-auto-flow', 'grid-auto-rows', 'grid-column', 'grid-column-end', 'grid-column-gap', 'grid-column-start', 'grid-gap', 'grid-row', 'grid-row-end', 'grid-row-gap', 'grid-row-start', 'grid-template-areas', 'grid-template-columns', 'grid-template-rows', 'FLEXBOX_justify-content', 'justify-items', 'justify-self');

                        $tmp_css_pattern = 'text-overflow';
                        $tmp_note = 'Property is supported, but the client breaks long words with <code>&lt;wbr&gt;</code> elements. And the <code>word-wrap</code> property defaults to <code>break-word</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'font-stretch';
                        $tmp_note = 'The property itself is intact, but the necessary media query is removed.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ERR_X);

                        break;
                    case 'CRNRSTN_GOOGLE_INBOX':

                        $tmp_regulated_string_patterns_ARRAY = array('<style> in <body>', '<link> in <head>', '<link> in <body>', 'not', 'any-hover', 'any-pointer', 'hover', 'max-aspect-ratio', 'max-device-aspect-ratio', 'max-device-height', 'max-device-pixel-ratio', 'MEDIA_QUERIES_max-height', 'min-aspect-ratio', 'min-device-aspect-ratio', 'min-device-height', 'min-device-pixel-ratio', 'MEDIA_QUERIES_min-height', 'pointer', '@font-face', 'EOT', 'SVG', 'TTF', 'WOFF', 'WOFF2', 'WOFF base64 encoded', 'WOFF2 base64 encoded', 'font-stretch', 'hyphens', 'overflow-wrap', 'text-fill-color', 'text-overflow', 'text-shadow', 'text-size-adjust', 'text-stroke', 'text-stroke-color', 'text-stroke-width', 'background-attachment', 'Data URI background image', 'border-image', 'box-shadow', 'bottom', 'cursor', 'left', 'position', 'resize', 'right', 'top', 'visibility', 'z-index', 'list-style-image', 'animation', 'animation-delay', 'animation-direction', 'animation-duration', 'animation-fill-mode', 'animation-iteration-count', 'animation-name', 'animation-play-state', 'animation-timing-function', 'backface-visibility', 'perspective', 'perspective-origin', 'transform', 'transform-origin', 'transform-style', 'transition', 'transition-delay', 'transition-duration', 'transition-property', 'transition-timing-function', 'backdrop-filter', 'filter', 'break-after', 'break-before', 'break-inside', 'column-count', 'column-fill', 'column-gap', 'column-rule', 'column-rule-color', 'column-rule-style', 'column-rule-width', 'column-span', 'column-width', 'columns', 'GRID_align-content', 'GRID_align-items', 'GRID_align-self', 'FLEXBOX_align-content', 'flex', 'flex-basis', 'flex-direction', 'flex-flow', 'flex-grow', 'flex-shrink', 'flex-wrap', 'GRID_justify-content', 'order', 'FLEXBOX_align-items', 'FLEXBOX_align-self', 'grid', 'grid-area', 'grid-auto-columns', 'grid-auto-flow', 'grid-auto-rows', 'grid-column', 'grid-column-end', 'grid-column-gap', 'grid-column-start', 'grid-gap', 'grid-row', 'grid-row-end', 'grid-row-gap', 'grid-row-start', 'grid-template-areas', 'grid-template-columns', 'grid-template-rows', 'FLEXBOX_justify-content', 'justify-items', 'justify-self');

                        $tmp_css_pattern = 'text-overflow';
                        $tmp_note = 'Property is supported, but the client breaks long words with <code>&lt;wbr&gt;</code> elements. And the <code>word-wrap</code> property defaults to <code>break-word</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'font-stretch';
                        $tmp_note = 'The property itself is intact, but the necessary media query is removed.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ERR_X);

                        break;
                    case 'CRNRSTN_OUTLOOK_COM':

                        $tmp_regulated_string_patterns_ARRAY = array('GRID_align-self', '<link> in <head>', '<link> in <body>', '@media', 'and', 'or (comma)', 'not', 'screen', 'only screen', 'all', 'any-hover', 'any-pointer', 'hover', 'max-aspect-ratio', 'max-device-aspect-ratio', 'max-device-height', 'max-device-pixel-ratio', 'max-device-width', 'MEDIA_QUERIES_max-height', 'max-resolution', 'MEDIA_QUERIES_max-width', 'min-aspect-ratio', 'min-device-aspect-ratio', 'min-device-height', 'min-device-pixel-ratio', 'min-device-width', 'MEDIA_QUERIES_min-height', 'min-resolution', 'MEDIA_QUERIES_min-width', 'orientation', 'pointer', '@font-face', 'EOT', 'SVG', 'TTF', 'WOFF', 'WOFF2', 'WOFF base64 encoded', 'WOFF2 base64 encoded', 'font-feature-settings', 'font-kerning', 'font-size-adjust', 'font-stretch', 'font-style', 'font-synthesis', 'hyphens', 'overflow-wrap', 'text-fill-color', 'text-shadow', 'text-size-adjust', 'text-stroke', 'mix-blend-mode', 'text-stroke-color', 'text-stroke-width', 'white-space', 'background-attachment', 'background-origin', 'isolation', 'CSS gradients', 'HSL Colors', 'HSLA Colors', 'border-image', 'box-shadow', 'box-sizing', 'bottom', 'cursor', 'left', 'object-fit', 'object-position', 'position', 'resize', 'right', 'top', 'z-index', 'list-style-image', 'animation', 'animation-delay', 'animation-direction', 'animation-duration', 'animation-fill-mode', 'animation-iteration-count', 'animation-name', 'animation-play-state', 'animation-timing-function', 'backface-visibility', 'perspective', 'perspective-origin', 'transform', 'transform-origin', 'transform-style', 'transition', 'transition-delay', 'transition-duration', 'transition-property', 'transition-timing-function', 'backdrop-filter', 'filter', 'break-after', 'break-before', 'break-inside', 'column-count', 'column-fill', 'column-gap', 'column-rule', 'column-rule-color', 'column-rule-style', 'column-rule-width', 'column-span', 'column-width', 'columns', 'FLEXBOX_align-self', 'flex', 'flex-basis', 'flex-direction', 'flex-flow', 'flex-grow', 'flex-shrink', 'flex-wrap', 'GRID_justify-content', 'GRID_align-self', 'grid', 'grid-area', 'grid-auto-columns', 'grid-auto-flow', 'grid-auto-rows', 'grid-column', 'grid-column-end', 'grid-column-gap', 'grid-column-start', 'grid-gap', 'grid-row', 'grid-row-end', 'grid-row-gap', 'grid-row-start', 'grid-template-areas', 'grid-template-columns', 'grid-template-rows', 'FLEXBOX_justify-content', 'justify-items', 'justify-self');

                        $tmp_css_pattern = 'font-style';
                        $tmp_note = 'Partial. Supports <code>italic</code>, but not <code>oblique</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        break;
                    case 'CRNRSTN_YAHOO_MAIL':

                        $tmp_regulated_string_patterns_ARRAY = array('<link> in <head>', '<link> in <body>', 'and', 'or (comma)', 'not', 'any-hover', 'any-pointer', 'hover', 'max-aspect-ratio', 'max-device-aspect-ratio', 'max-device-height', 'max-device-pixel-ratio', 'max-device-width', 'max-resolution', 'min-aspect-ratio', 'min-device-aspect-ratio', 'min-device-height', 'min-device-pixel-ratio', 'min-device-width', 'min-resolution', 'orientation', 'pointer', '@font-face', 'EOT', 'SVG', 'TTF', 'WOFF', 'WOFF2', 'WOFF base64 encoded', 'WOFF2 base64 encoded', 'font-feature-settings', 'font-kerning', 'font-stretch', 'font-synthesis', 'font-variant', 'hyphens', 'overflow-wrap', 'text-fill-color', 'text-overflow', 'text-shadow', 'text-size-adjust', 'text-stroke', 'text-stroke-color', 'text-stroke-width', 'word-wrap', 'background', 'background-blend-mode', 'background-clip', 'background-origin', 'isolation', 'CSS gradients', 'Data URI background image', 'Multiple background images', 'HSL Colors', 'HSLA Colors', 'RGBA Colors', 'border-image', 'box-shadow', 'box-sizing', 'height', 'BOX_MODEL_min-height', 'bottom', 'cursor', 'left', 'object-fit', 'object-position', 'opacity', 'position', 'resize', 'right', 'top', 'animation', 'animation-delay', 'animation-direction', 'animation-duration', 'animation-fill-mode', 'animation-iteration-count', 'animation-name', 'animation-play-state', 'animation-timing-function', 'backface-visibility', 'perspective', 'perspective-origin', 'transform', 'transform-origin', 'transform-style', 'transition', 'transition-delay', 'transition-duration', 'transition-property', 'transition-timing-function', 'backdrop-filter', 'filter', 'break-after', 'break-before', 'break-inside', 'column-count', 'column-fill', 'column-gap', 'column-rule', 'column-rule-color', 'column-rule-style', 'column-rule-width', 'column-span', 'column-width', 'columns', 'GRID_align-content', 'GRID_align-items', 'GRID_align-self', 'FLEXBOX_align-content', 'flex', 'flex-basis', 'flex-direction', 'flex-flow', 'flex-grow', 'flex-shrink', 'flex-wrap', 'GRID_justify-content', 'order', 'FLEXBOX_align-items', 'FLEXBOX_align-self', 'GRID_display', 'FLEXBOX_display', 'grid', 'grid-area', 'grid-auto-columns', 'grid-auto-flow', 'grid-auto-rows', 'mix-blend-mode', 'grid-column', 'grid-column-end', 'grid-column-gap', 'grid-column-start', 'grid-gap', 'grid-row', 'grid-row-end', 'grid-row-gap', 'grid-row-start', 'grid-template-areas', 'grid-template-columns', 'grid-template-rows', 'FLEXBOX_justify-content', 'justify-items', 'justify-self');

                        $tmp_css_pattern = 'position';
                        $tmp_note = 'Supports the value <code>relative</code>, but not the properties <code>top</code>, <code>right</code>, <code>bottom</code>, or <code>left</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ERR_X);

                        $tmp_css_pattern = 'cursor';
                        $tmp_note = 'Partial. Supports most CSS2 values.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'BOX_MODEL_min-height';
                        $tmp_note = 'Supported, but because the client changes <code>height</code> to <code>min-height</code>, that value will override this one if it comes after.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'height';
                        $tmp_note = 'Buggy. Client changes the <code>height</code> property to <code>min-height</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'background';
                        $tmp_note = 'Buggy. For slash syntax values, it removes the slash character, making the value invalid.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'word-wrap';
                        $tmp_note = 'Property is supported, but the <code>word-break</code> property defaults to <code>break-word</code>.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_SUCCESS_CHECK);

                        $tmp_css_pattern = 'text-shadow';
                        $tmp_note = 'Partial. Supports a single shadow per element, but not multiple.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        $tmp_css_pattern = 'font-variant';
                        $tmp_note = 'Partial. Supports CSS2 values, but not CSS3.';
                        $this->css_meta_load($mail_const_int, $tmp_css_pattern, $tmp_note, CRNRSTN_CSS_ICON_ALERT_BANG);

                        break;

                }

                //
                // INITIALIZE PROFILE FOR EACH THROWN CSS PATTERN WITH THIS CLIENT
                $this->initialize_client_css_profile($tmp_regulated_string_patterns_ARRAY, $mail_const_int);

                //$this->initialize_pattern_regulated_bit($tmp_regulated_string_patterns_ARRAY, $mail_const_int);

            }

        }

    }

    private function initialize_client_css_profile($regulated_string_patterns_ARRAY, $mail_const_int){

        foreach($regulated_string_patterns_ARRAY as $key => $string_pattern){

            //
            // HAS META BEEN SET? IF YES...MAYBE SKIP? ELSE, SET TO ERR_X ICON
            $tmp_serialized_bit_nomination_seed = 'META_' . $string_pattern . $mail_const_int;

            //
            // LOAD ALL CSS PATTERN META DATA [DESCRIPTION, URI]
            // ,where array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);
            $tmp_array = $this->return_css_str_pattern_meta($string_pattern);

            //
            // PROCESS CSS PROFILE
            //$uri, $description,
            $tmp_uri = $tmp_array[0];
            $tmp_description = $tmp_array[1];

            //
            // URI
            if(strlen($tmp_uri)>0){

                //$this->oCRNRSTN_USR->initialize_serialized_bit($tmp_serialized_bit_nomination_seed, CRNRSTN_CSS_CLIENT_ASSOC_HAS_DOCS_LNK);

                $this->css_pattern_meta_docs_uri_ARRAY[$string_pattern] = $tmp_uri;

            }

            if(strlen($tmp_description)>0){

                $this->css_pattern_meta_description_ARRAY[$string_pattern] = $tmp_description;

            }

            //
            // IF BIT IS NOT FLIPPED (E.G. CSS STRING PATTERN IS NOT INITIALIZED VIA $this->css_meta_load), FLIP ICON BIT.
            //error_log(__LINE__ .' '. __METHOD__ .' seed=>'.$tmp_serialized_meta_index_seed);
            if(!$this->oCRNRSTN_USR->serialized_is_bit_set($tmp_serialized_bit_nomination_seed, CRNRSTN_CSS_CLIENT_ASSOC_HAS_META)){

                //
                // ERROR ICON
                $this->oCRNRSTN_USR->initialize_serialized_bit($tmp_serialized_bit_nomination_seed, CRNRSTN_CSS_ICON_ERR_X);

            }

        }

    }

    private function touch_css_validation_nomination($string_pattern, $meta_array){

        $tmp_pattern_species = $meta_array[4];

        if(!isset($this->css_pattern_meta_nomination_FLAG_ARRAY[$tmp_pattern_species][$string_pattern])){

            $this->css_pattern_meta_nomination_FLAG_ARRAY[$tmp_pattern_species][$string_pattern] = 1;
            $this->css_pattern_meta_nomination_ARRAY[$tmp_pattern_species][] = $string_pattern;

        }

    }

    private function css_meta_load($mail_client_constant, $css_regulated_pattern, $string_comment, $icon_class_constant){

        $tmp_serialized_meta_index = 'META_' . $css_regulated_pattern . $mail_client_constant;

        //
        // ICONOGRAPHY :: ICON TYPE TO BIND
        $this->oCRNRSTN_USR->initialize_serialized_bit($tmp_serialized_meta_index, $icon_class_constant);

        //
        // NOTE
        if(strlen($string_comment) > 0){

            //error_log(__LINE__ .' '. __METHOD__ .' we initialize_serialized_bit() the HAS_META flag for this =>'.$tmp_serialized_meta_index);
            $tmp_val = $this->oCRNRSTN_USR->initialize_serialized_bit($tmp_serialized_meta_index, CRNRSTN_CSS_CLIENT_ASSOC_HAS_META);

            //
            // DEFINE CONSTANT ONE WITH BIT INTEGER STORAGE
            //define($tmp_serialized_meta_index, $tmp_val);

            $this->css_pattern_meta_note_ARRAY[$tmp_serialized_meta_index] = $string_comment;

        }


        /*

        $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/justify-self';
        $tmp_description = 'The <a href="https://developer.mozilla.org/en-US/docs/Web/CSS" target="_self">CSS</a> justify-self property sets the way a box is justified inside its alignment container along the appropriate axis.';
        $tmp_pattern_nom = $css_pattern_nom;

        $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;


        CSS reg pattern                    ? => array() => {font-size:, display:}

        oBitwise = object_array['CRNRSTN_'.strtoupper(md5(font-style))];
        oBitwise->set($mail_client_constant);   //  SET BIT WITH MAIL CLIENT CONST FOR ANY CSS WHERE WE HAVE CLIENT ERR OR INFO.

        // PROPOSE NEW ARRAY SERIALIZATION FOR BITWISE FLAG INT STORAGE WITHIN
        // SAME OBJECT.
        //
        // BASE CONFIG BITWISE INDEX SERIAL     = 'CRNRSTN_'.strtoupper(md5($css_regulated_pattern))
        // META SERIAL CSS/CLIENT $COMBINED_SEED = 'CRNRSTN_META_'.strtoupper(md5($css_regulated_pattern.$mail_client_constant))

        $this->oCRNRSTN_USR->initialize_serialized_bit($COMBINED_SEED, CRNRSTN_CSS_ICON_ALERT_BANG);

        $meta_str_raw_storage_ARRAY['CRNRSTN_META_'.strtoupper(md5($css_regulated_pattern.$mail_client_constant))] = $meta_str

        oBitwise = object_array[$COMBINED_SEED];
        oBitwise->set($icon_class_constant);

        //
        // CHANNEL BUBBLE UP
        // CHANNEL CONSTANTS
            ~ define('CRNRSTN_MAIL_CLIENT_MOBILE', (int) $this->initialize_bit('CRNRSTN_MAIL_CLIENT_MOBILE'));
            ~ define('CRNRSTN_MAIL_CLIENT_DESKTOP', (int) $this->initialize_bit('CRNRSTN_MAIL_CLIENT_DESKTOP'));
            ~ define('CRNRSTN_MAIL_CLIENT_WEB', (int) $this->initialize_bit('CRNRSTN_MAIL_CLIENT_WEB'));


        //  * NEW META CONSTANTS
                ~ CRNRSTN_CSS_ICON_ALERT_BANG                   // INDICATION OF ICON TYPE TO BIND
                ~ CRNRSTN_CSS_ICON_SUCCESS_CHECK
                ~ CRNRSTN_CSS_ICON_ERR_X

                ~ CRNRSTN_CSS_CLIENT_ASSOC_HAS_META             // INDICATION OF NEED TO SHOW A NOTE
                ~ CRNRSTN_CSS_CLIENT_ASSOC_HAS_DOCS_LNK         // INDICATION OF NEED TO HTTP LINK THE ELEMENT

        CSS_REGULATED_PATTERN,
        MAIL_CLIENT_CONSTANT
        DETAIL_STR
        ICON_CONSTANT (IF SUCCESS, INFO, OR ERROR)

         * */

        // filter
        // $filterstr = '<div style='color: #6885C3; font-family:"Courier New", Courier, monospace; font-size: 11px; font-weight: normal; border-top: 6px solid #FFF; '>Supported with <code style='border:2px solid #D9DEEB; border-radius: 5px; border-bottom-right-radius: 0; border-top-left-radius: 0; padding:1px 0 1px 0; color:#FFF;'><code style='background-color: #6886C3; border:1px solid #FFF; border-radius: 5px; border-bottom-right-radius: 0; border-top-left-radius: 0; padding:1px 3px 1px 3px; color:#FFF; font-family:"Courier New", Courier, monospace; font-size: 11px; font-weight: normal; '>‑webkit</code></code>&nbsp;prefix.</div>';


    }

    private function add_client($client_name, $index, $client_type = CRNRSTN_MAIL_CLIENT_MOBILE){

        /*

        constant <=> mail client

        FOR EACH CSS STRING
        ...flag_this_email_client_as regulated/TRUE for the bitwise_object_ARRAY['CRNRSTN_MD5('CSS_STR')']

        css_pattern_ARRAY[CRNRSTN_MD5('CSS_STR')] <=> create a bitwise integer array with all failing constants flagged

        $this->oCRNRSTN_USR->serialize_constant($raw_css_string, )

        CRNRSTN_MD5('CSS_STR')

        */

        try{

            switch($client_type){
                case CRNRSTN_MAIL_CLIENT_DESKTOP:
                    //error_log(__LINE__ .' '. __METHOD__ .' $index='.$index.' |desktop CONST='.$this->desktop_mail_CONST_ARRAY[$index]);

                    @define($this->desktop_mail_CONST_ARRAY[$index], (int) $this->oCRNRSTN_USR->initialize_bit($this->desktop_mail_CONST_ARRAY[$index]));

                    self::$email_rendering_client_ARRAY[$client_type]['name'][] = $client_name;

                    break;
                case CRNRSTN_MAIL_CLIENT_MOBILE:
                    //error_log(__LINE__ .' '. __METHOD__ .' $index='.$index.' |mobi CONST='.$this->mobile_mail_CONST_ARRAY[$index]);

                    @define($this->mobile_mail_CONST_ARRAY[$index], (int) $this->oCRNRSTN_USR->initialize_bit($this->mobile_mail_CONST_ARRAY[$index]));

                    self::$email_rendering_client_ARRAY[$client_type]['name'][] = $client_name;

                    break;
                case CRNRSTN_MAIL_CLIENT_WEB:
                    //error_log(__LINE__ .' '. __METHOD__ .' $index='.$index.' |web CONST='.$this->web_mail_CONST_ARRAY[$index]);

                    @define($this->web_mail_CONST_ARRAY[$index], (int) $this->oCRNRSTN_USR->initialize_bit($this->web_mail_CONST_ARRAY[$index]));

                    self::$email_rendering_client_ARRAY[$client_type]['name'][] = $client_name;

                    break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Unknown CSS validation channel integer CONSTANT ['.$client_type.'].');

                    break;

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    private function css_to_client_normalization(){

        //
        // ALL OF THE PATTERNS
        $regulated_string_patterns_ARRAY = array('<style> in <head>', '<style> in <body>', '<link> in <head>', '<link> in <body>', '@media', 'and', 'or (comma)', 'not', 'screen', 'only screen', 'all', 'any-hover', 'any-pointer', 'hover', 'max-aspect-ratio', 'max-device-aspect-ratio', 'max-device-height', 'max-device-pixel-ratio', 'max-device-width', 'MEDIA_QUERIES_max-height', 'max-resolution', 'MEDIA_QUERIES_max-width', 'min-aspect-ratio', 'min-device-aspect-ratio', 'min-device-height', 'min-device-pixel-ratio', 'min-device-width', 'MEDIA_QUERIES_min-height', 'min-resolution', 'MEDIA_QUERIES_min-width', 'orientation', 'pointer', '@font-face', 'EOT', 'SVG', 'TTF', 'WOFF', 'WOFF2', 'WOFF base64 encoded', 'WOFF2 base64 encoded', 'direction', 'font', 'font-family', 'font-feature-settings', 'font-kerning', 'font-size', 'font-size-adjust', 'font-stretch', 'font-style', 'font-synthesis', 'font-variant', 'font-weight', 'hyphens', 'letter-spacing', 'line-height', 'overflow-wrap', 'text-align', 'text-decoration', 'text-fill-color', 'text-indent', 'text-overflow', 'text-shadow', 'text-size-adjust', 'text-stroke', 'text-stroke-color', 'text-stroke-width', 'text-transform', 'vertical-align', 'white-space',  'word-spacing', 'word-wrap', 'background', 'background-attachment',  'background-blend-mode', 'background-clip', 'background-color', 'background-image', 'background-origin', 'background-position', 'background-repeat', 'background-size', 'color', 'isolation', 'mix-blend-mode',  'CSS gradients', 'Data URI background image', 'Multiple background images', 'HTML 4.01 Named Colors', 'X11 Named Colors', 'HEX Colors', 'HEX Shorthand Colors', 'HSL Colors', 'HSLA Colors', 'RGB Colors',  'RGBA Colors', 'currentColor', 'border', 'border-bottom', 'border-bottom-color', 'border-bottom-left-radius', 'border-bottom-right-radius', 'border-bottom-style', 'border-bottom-width', 'border-color', 'border-image', 'border-left', 'border-left-color', 'border-left-style', 'border-left-width',  'border-radius', 'border-right', 'border-right-color',  'border-right-style', 'border-right-width', 'border-style',  'border-top',  'border-top-color', 'border-top-left-radius', 'border-top-right-radius', 'border-top-style', 'border-top-width', 'border-width', 'box-shadow', 'box-sizing', 'height', 'margin', 'margin-bottom', 'margin-left', 'margin-right', 'margin-top', 'BOX_MODEL_max-height', 'BOX_MODEL_max-width', 'BOX_MODEL_min-height', 'BOX_MODEL_min-width', 'padding', 'padding-bottom', 'padding-left', 'padding-right', 'padding-top', 'width', 'bottom', 'clear', 'cursor', 'POSITIONING_AND_DISPLAY_display', 'float', 'left', 'object-fit', 'object-position', 'opacity', 'outline', 'outline-color', 'outline-style', 'outline-width', 'overflow', 'position', 'resize', 'right', 'top', 'visibility', 'z-index', 'list-style', 'list-style-image', 'list-style-position', 'list-style-type', 'border-collapse', 'border-spacing', 'caption-side', 'empty-cells', 'table-layout', 'animation', 'animation-delay', 'animation-direction', 'animation-duration', 'animation-fill-mode', 'animation-iteration-count', 'animation-name', 'animation-play-state', 'animation-timing-function', 'backface-visibility', 'perspective', 'perspective-origin', 'transform', 'transform-origin', 'transform-style', 'transition', 'transition-delay', 'transition-duration', 'transition-property', 'transition-timing-function', 'backdrop-filter', 'filter', 'break-after', 'break-before', 'break-inside', 'column-count', 'column-fill', 'column-gap', 'column-rule', 'column-rule-color', 'column-rule-style', 'column-rule-width', 'column-span', 'column-width', 'columns', 'FLEXBOX_align-content', 'FLEXBOX_align-items', 'FLEXBOX_align-self', 'FLEXBOX_display', 'flex', 'flex-basis', 'flex-direction', 'flex-flow', 'flex-grow', 'flex-shrink', 'flex-wrap', 'FLEXBOX_justify-content', 'order', 'GRID_align-content', 'GRID_align-items', 'GRID_align-self', 'GRID_display', 'grid', 'grid-area', 'grid-auto-columns', 'grid-auto-flow', 'grid-auto-rows', 'grid-column', 'grid-column-end', 'grid-column-gap', 'grid-column-start', 'grid-gap', 'grid-row', 'grid-row-end', 'grid-row-gap', 'grid-row-start', 'grid-template-areas', 'grid-template-columns', 'grid-template-rows', 'GRID_justify-content', 'justify-items', 'justify-self');

        /*
           $tmp_array = array(
            'G Suite',
            'Gmail',
            'Google Inbox',
            'Outlook.com',
            'Yahoo! Mail');


        //
        // CURRENT META ::
        case 'PATTERN_NOM':
        case 'VALIDATION_TYPE':
        case 'DOCS_URI':
        case 'DESCRIPTION':

         $tmp_pattern_nom = 'font-size';

         $tmp_uri = $this->return_css_str_pattern_meta($css_pattern, 'DOCS_URI');
         $tmp_description =  $this->return_css_str_pattern_meta($css_pattern);
         $tmp_validation_type  =  $this->return_css_str_pattern_meta($css_pattern, 'VALIDATION_TYPE');

            ~ CRNRSTN_CSS_VALIDATE_STANDARD_USE
            ~ CRNRSTN_CSS_VALIDATE_STYLE_IN_HEAD
            ~ CRNRSTN_CSS_VALIDATE_LINK_IN_HEAD
            ~ CRNRSTN_CSS_VALIDATE_STYLE_IN_BODY
            ~ CRNRSTN_CSS_VALIDATE_LINK_IN_BODY
            ~ ...

         $this->add_css_meta($tmp_pattern_nom, $tmp_validation_type, $tmp_uri, $tmp_description);




         // URI (or Pretty Name...?)
         foreach( as $key => $val){

            $this->css_string_pattern_meta_ARRAY['URI_'.{SERIAL}] = $val;

        }


         * */

        foreach($regulated_string_patterns_ARRAY as $key => $string_pattern){

            //
            // LOAD ALL CSS PATTERN META DATA [DESCRIPTION, URI]
            // ,where array($uri, $description, $css_pattern_nom, $validation_type_constant, $css_pattern_species)
            $tmp_array = $this->return_css_str_pattern_meta($string_pattern);

            //
            // MANAGE GLOBAL USE OF THIS VALIDATION (STRING) CONTROLLER
            $this->touch_css_validation_nomination($string_pattern, $tmp_array);

            $tmp_serialized_bit_nomination = 'META_' . $string_pattern;

            //
            // PROCESS CSS PROFILE
            //$uri, $description,
            $tmp_uri = $tmp_array[0];
            $tmp_description = $tmp_array[1];

            //
            // URI
            if(strlen($tmp_uri)>0){

                $tmp_val = $this->oCRNRSTN_USR->initialize_serialized_bit($tmp_serialized_bit_nomination, CRNRSTN_CSS_CLIENT_ASSOC_HAS_DOCS_LNK);

                //
                // DEFINE CONSTANT ONE WITH BIT INTEGER STORAGE
                @define($tmp_serialized_bit_nomination, $tmp_val);

                $this->css_pattern_meta_docs_uri_ARRAY[$string_pattern] = $tmp_uri;

            }

            if(strlen($tmp_description)>0){

                $this->css_pattern_meta_description_ARRAY[$string_pattern] = $tmp_description;

            }

        }

    }

    private function load_mail_clients(){

        $this->desktop_mail_client_ARRAY = array('AOL Desktop',
            'Apple Mail 10',
            'IBM Notes 9',
            'Outlook 2000-03',
            'Outlook 2007-16',
            'Outlook Express',
            'Outlook for Mac',
            'Postbox',
            'Thunderbird',
            'Windows 10 Mail',
            'Windows Live Mail');

        $this->desktop_mail_CONST_ARRAY = array('CRNRSTN_AOL_DESKTOP',
            'CRNRSTN_APPLE_MAIL_10',
            'CRNRSTN_IBM_NOTES_9',
            'CRNRSTN_OUTLOOK_2000_03',
            'CRNRSTN_OUTLOOK_2007_16',
            'CRNRSTN_OUTLOOK_EXPRESS',
            'CRNRSTN_OUTLOOK_FOR_MAC',
            'CRNRSTN_POSTBOX',
            'CRNRSTN_THUNDERBIRD',
            'CRNRSTN_WINDOWS_10_MAIL',
            'CRNRSTN_WINDOWS_LIVE_MAIL');

        $this->mobile_mail_client_ARRAY = array('Android 4.2.2 Mail',
            'Android 4.4.4 Mail',
            'AOL Alto Android app',
            'AOL Alto iOS app',
            'BlackBerry',
            'Gmail Android app',
            'Gmail Android IMAP',
            'Gmail iOS app',
            'Gmail mobile webmail',
            'Google Inbox Android app',
            'Google Inbox iOS app',
            'iOS 10 Mail',
            'iOS 11 Mail',
            'Outlook Android app',
            'Outlook iOS app',
            'Sparrow',
            'Windows Phone 8 Mail',
            'Yahoo! Mail Android app',
            'Yahoo! Mail iOS app');

        $this->mobile_mail_CONST_ARRAY = array('CRNRSTN_ANDROID_4_2_2_MAIL',
            'CRNRSTN_ANDROID_4_4_4_MAIL',
            'CRNRSTN_AOL_ALTO_ANDROID_APP',
            'CRNRSTN_AOL_ALTO_IOS_APP',
            'CRNRSTN_BLACKBERRY',
            'CRNRSTN_GMAIL_ANDROID_APP',
            'CRNRSTN_GMAIL_ANDROID_IMAP',
            'CRNRSTN_GMAIL_IOS_APP',
            'CRNRSTN_GMAIL_MOBILE_WEBMAIL',
            'CRNRSTN_GOOGLE_INBOX_ANDROID_APP',
            'CRNRSTN_GOOGLE_INBOX_IOS_APP',
            'CRNRSTN_IOS_10_MAIL',
            'CRNRSTN_IOS_11_MAIL',
            'CRNRSTN_OUTLOOK_ANDROID_APP',
            'CRNRSTN_OUTLOOK_IOS_APP',
            'CRNRSTN_SPARROW',
            'CRNRSTN_WINDOWS_PHONE_8_MAIL',
            'CRNRSTN_YAHOO_MAIL_ANDROID_APP',
            'CRNRSTN_YAHOO_MAIL_IOS_APP');

        $this->web_mail_client_ARRAY = array('AOL Mail',
            'G Suite',
            'Gmail',
            'Google Inbox',
            'Outlook.com',
            'Yahoo! Mail');

        $this->web_mail_CONST_ARRAY = array('CRNRSTN_AOL_MAIL',
            'CRNRSTN_G_SUITE',
            'CRNRSTN_GMAIL',
            'CRNRSTN_GOOGLE_INBOX',
            'CRNRSTN_OUTLOOK_COM',
            'CRNRSTN_YAHOO_MAIL');


        foreach($this->desktop_mail_client_ARRAY as $key => $value){

            $this->results_count_aggregation_ARRAY[$this->desktop_mail_CONST_ARRAY[$key]]['BANG'][] = 1;
            $this->results_count_aggregation_ARRAY[$this->desktop_mail_CONST_ARRAY[$key]]['X'][] = 1;
            $this->results_count_aggregation_ARRAY[$this->desktop_mail_CONST_ARRAY[$key]]['SUCCESS'][] = 1;

            $this->results_summary_aggregate_ARRAY[$this->desktop_mail_CONST_ARRAY[$key]]['BANG'] = 0;
            $this->results_summary_aggregate_ARRAY[$this->desktop_mail_CONST_ARRAY[$key]]['X'] = 0;
            $this->results_summary_aggregate_ARRAY[$this->desktop_mail_CONST_ARRAY[$key]]['SUCCESS'] = 0;

            $this->add_client($value, $key, CRNRSTN_MAIL_CLIENT_DESKTOP);

        }

        foreach($this->mobile_mail_client_ARRAY as $key => $value){

            $this->results_count_aggregation_ARRAY[$this->mobile_mail_CONST_ARRAY[$key]]['BANG'][] = 1;
            $this->results_count_aggregation_ARRAY[$this->mobile_mail_CONST_ARRAY[$key]]['X'][] = 1;
            $this->results_count_aggregation_ARRAY[$this->mobile_mail_CONST_ARRAY[$key]]['SUCCESS'][] = 1;

            $this->results_summary_aggregate_ARRAY[$this->mobile_mail_CONST_ARRAY[$key]]['BANG'] = 0;
            $this->results_summary_aggregate_ARRAY[$this->mobile_mail_CONST_ARRAY[$key]]['X'] = 0;
            $this->results_summary_aggregate_ARRAY[$this->mobile_mail_CONST_ARRAY[$key]]['SUCCESS'] = 0;

            $this->add_client($value, $key, CRNRSTN_MAIL_CLIENT_MOBILE);

        }

        foreach($this->web_mail_client_ARRAY as $key => $value){

            $this->results_count_aggregation_ARRAY[$this->web_mail_CONST_ARRAY[$key]]['BANG'][] = 1;
            $this->results_count_aggregation_ARRAY[$this->web_mail_CONST_ARRAY[$key]]['X'][] = 1;
            $this->results_count_aggregation_ARRAY[$this->web_mail_CONST_ARRAY[$key]]['SUCCESS'][] = 1;

            $this->results_summary_aggregate_ARRAY[$this->web_mail_CONST_ARRAY[$key]]['BANG'] = 0;
            $this->results_summary_aggregate_ARRAY[$this->web_mail_CONST_ARRAY[$key]]['X'] = 0;
            $this->results_summary_aggregate_ARRAY[$this->web_mail_CONST_ARRAY[$key]]['SUCCESS'] = 0;

            $this->add_client($value, $key, CRNRSTN_MAIL_CLIENT_WEB);

        }

        /*
        display name
        client type [DESKTOP, MOBILE, WEB]


        $desktop_array = array(AOL Desktop
            Apple Mail 10
            IBM Notes 9
            Outlook 2000-03
            Outlook 2007-16
            Outlook Express
            Outlook for Mac
            Postbox
            Thunderbird
            Windows 10 Mail
            Windows Live Mail);

        DESKTOP ::
            AOL Desktop
            Apple Mail 10
            IBM Notes 9
            Outlook 2000-03
            Outlook 2007-16
            Outlook Express
            Outlook for Mac
            Postbox
            Thunderbird
            Windows 10 Mail
            Windows Live Mail


        MOBILE ::
            Android 4.2.2 Mail
            Android 4.4.4 Mail
            AOL Alto Android app
            AOL Alto iOS app
            BlackBerry
            Gmail Android app
            Gmail Android IMAP
            Gmail iOS app
            Gmail mobile webmail
            Google Inbox Android app
            Google Inbox iOS app
            iOS 10 Mail
            iOS 11 Mail
            Outlook Android app
            Outlook iOS app
            Sparrow
            Windows Phone 8 Mail
            Yahoo! Mail Android app
            Yahoo! Mail iOS app


        WEBMAIL ::
            AOL Mail
            G Suite
            Gmail
            Google Inbox
            Outlook.com
            Yahoo! Mail

         * */

    }

    private function return_css_performance_results($output_mode){

        switch($output_mode){
            case CRNRSTN_CSS_RESULTS_INTEGER:

                return 'integer return will be CSS checked!';

                break;
            case CRNRSTN_CSS_RESULTS_BOOLEAN:

                return 'boolean return will be CSS checked!';

                break;
            case CRNRSTN_CSS_RESULTS_HTML:
            default:

                return 'html return will be CSS checked!';

                break;

        }

        return false;

    }

    //
    // PERHAPS USE THIS METHOD SIMPLY TO AGGREGATE ALL META LINKS AND DESCRIPTIONS TO ONE PLACE?
    private function return_css_str_pattern_meta($css_pattern_nom){

        try{

            switch($css_pattern_nom){

                // STYLE_ELEMENT
                case '<style> in <head>':

                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link('https://developer.mozilla.org/en-US/docs/Web/HTML/Element/style', 'developer_mozilla_web_docs');
                    $tmp_description = 'The HTML &lt;style&gt; element contains style information for a document, or part of a document. It contains CSS, which is applied to the contents of the document containing the &lt;style&gt; element.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STYLE_IN_HEAD;
                    $tmp_pattern_species = 'STYLE_ELEMENT';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case '<style> in <body>':

                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link('https://developer.mozilla.org/en-US/docs/Web/HTML/Element/style', 'developer_mozilla_web_docs');
                    $tmp_description = 'The HTML &lt;style&gt; element contains style information for a document, or part of a document. It contains CSS, which is applied to the contents of the document containing the &lt;style&gt; element.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STYLE_IN_BODY;
                    $tmp_pattern_species = 'STYLE_ELEMENT';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;

                // LINK_ELEMENT
                case '<link> in <body>':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/HTML/Element/link';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The HTML External Resource Link element (&lt;link&gt;) specifies relationships between the current document and an external resource. This element is most commonly used to link to stylesheets, but is also used to establish site icons (both "favicon" style icons and icons for the home screen and apps on mobile devices) among other things.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_LINK_IN_BODY;
                    $tmp_pattern_species = 'LINK_ELEMENT';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case '<link> in <head>':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/HTML/Element/link';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The HTML External Resource Link element (&lt;link&gt;) specifies relationships between the current document and an external resource. This element is most commonly used to link to stylesheets, but is also used to establish site icons (both "favicon" style icons and icons for the home screen and apps on mobile devices) among other things.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_LINK_IN_HEAD;
                    $tmp_pattern_species = 'LINK_ELEMENT';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;

                // MEDIA_QUERIES
                case '@media':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/@media';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The @media CSS at-rule can be used to apply part of a style sheet based on the result of one or more media queries. With it, you specify a media query and a block of CSS to apply to the document if and only if the media query matches the device on which the content is being used.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'MEDIA_QUERIES';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'and':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/Media_Queries/Using_media_queries#logical_operators';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The @media CSS at-rule can be used to apply part of a style sheet based on the result of one or more media queries. With it, you specify a media query and a block of CSS to apply to the document if and only if the media query matches the device on which the content is being used.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'MEDIA_QUERIES';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'or (comma)':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/Media_Queries/Using_media_queries#logical_operators';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The @media CSS at-rule can be used to apply part of a style sheet based on the result of one or more media queries. With it, you specify a media query and a block of CSS to apply to the document if and only if the media query matches the device on which the content is being used.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'MEDIA_QUERIES';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'not':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/Media_Queries/Using_media_queries#logical_operators';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The @media CSS at-rule can be used to apply part of a style sheet based on the result of one or more media queries. With it, you specify a media query and a block of CSS to apply to the document if and only if the media query matches the device on which the content is being used.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'MEDIA_QUERIES';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'screen':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/@media#media_types';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The @media CSS at-rule can be used to apply part of a style sheet based on the result of one or more media queries. With it, you specify a media query and a block of CSS to apply to the document if and only if the media query matches the device on which the content is being used.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'MEDIA_QUERIES';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'only screen':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/@media#testing_for_print_and_screen_media_types';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The @media CSS at-rule can be used to apply part of a style sheet based on the result of one or more media queries. With it, you specify a media query and a block of CSS to apply to the document if and only if the media query matches the device on which the content is being used.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'MEDIA_QUERIES';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'all':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/all';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The all shorthand CSS property resets all of an element\'s properties except unicode-bidi, direction, and CSS Custom Properties. It can set properties to their initial or inherited values, or to the values specified in another stylesheet origin.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'MEDIA_QUERIES';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'any-hover':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/@media/any-hover';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The any-hover CSS media feature can be used to test whether any available input mechanism can hover over elements.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'MEDIA_QUERIES';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'any-pointer':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/@media/any-pointer';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The any-pointer CSS media feature tests whether the user has any pointing device (such as a mouse), and if so, how accurate it is.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'MEDIA_QUERIES';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'hover':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/:hover';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The :hover CSS pseudo-class matches when the user interacts with an element with a pointing device, but does not necessarily activate it. It is generally triggered when the user hovers over an element with the cursor (mouse pointer).';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'MEDIA_QUERIES';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'max-aspect-ratio':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/@media/aspect-ratio';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The aspect-ratio CSS media feature can be used to test the aspect ratio of the viewport.<br><br>

The aspect-ratio feature is specified as a <ratio> value representing the width-to-height aspect ratio of the viewport. It is a range feature, meaning you can also use the prefixed min-aspect-ratio and max-aspect-ratio variants to query minimum and maximum values, respectively.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'MEDIA_QUERIES';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'max-device-aspect-ratio':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/@media/device-aspect-ratio';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The device-aspect-ratio CSS media feature can be used to test the width-to-height aspect ratio of an output device.<br><br>

The device-aspect-ratio feature is specified as a <ratio>. It is a range feature, meaning that you can also use the prefixed min-device-aspect-ratio and max-device-aspect-ratio variants to query minimum and maximum values, respectively.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_IS_DEPRECATED;
                    $tmp_pattern_species = 'MEDIA_QUERIES';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'max-device-height':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/@media/device-height';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The device-height CSS media feature can be used to test the height of an output device\'s rendering surface.<br><br>

The device-height feature is specified as a <length> value. It is a range feature, meaning that you can also use the prefixed min-device-height and max-device-height variants to query minimum and maximum values, respectively.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_IS_DEPRECATED;
                    $tmp_pattern_species = 'MEDIA_QUERIES';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'max-device-pixel-ratio':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/@media/-webkit-device-pixel-ratio';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The -webkit-device-pixel-ratio is a non-standard Boolean CSS media feature which is an alternative to the standard resolution media feature.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_IS_NONSTANDARD;
                    $tmp_pattern_species = 'MEDIA_QUERIES';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'max-device-width':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/@media/device-width';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The device-width CSS media feature can be used to test the width of an output device\'s rendering surface.<br><br>
The device-width feature is specified as a <length> value. It is a range feature, meaning that you can also use the prefixed min-device-width and max-device-width variants to query minimum and maximum values, respectively.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_IS_DEPRECATED;
                    $tmp_pattern_species = 'MEDIA_QUERIES';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'MEDIA_QUERIES_max-height':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/@media';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The max-height CSS property sets the maximum height of an element. It prevents the used value of the height property from becoming larger than the value specified for max-height.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'MEDIA_QUERIES';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'max-resolution':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/@media/resolution';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The resolution CSS media feature can be used to test the pixel density of the output device.<br><br>

The resolution feature is specified as a <resolution> value representing the pixel density of the output device. It is a range feature, meaning that you can also use the prefixed min-resolution and max-resolution variants to query minimum and maximum values, respectively.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'MEDIA_QUERIES';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'MEDIA_QUERIES_max-width':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/@media';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The max-width CSS property sets the maximum width of an element. It prevents the used value of the width property from becoming larger than the value specified by max-width.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'MEDIA_QUERIES';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'min-aspect-ratio':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/@media/aspect-ratio';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The aspect-ratio CSS media feature can be used to test the aspect ratio of the viewport.<br><br>

The aspect-ratio feature is specified as a <ratio> value representing the width-to-height aspect ratio of the viewport. It is a range feature, meaning you can also use the prefixed min-aspect-ratio and max-aspect-ratio variants to query minimum and maximum values, respectively.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'MEDIA_QUERIES';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'min-device-aspect-ratio':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/@media/device-aspect-ratio';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The device-aspect-ratio CSS media feature can be used to test the width-to-height aspect ratio of an output device.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_IS_DEPRECATED;
                    $tmp_pattern_species = 'MEDIA_QUERIES';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'min-device-height':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/@media/device-height';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The device-height CSS media feature can be used to test the height of an output device\'s rendering surface.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_IS_DEPRECATED;
                    $tmp_pattern_species = 'MEDIA_QUERIES';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'min-device-pixel-ratio':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/@media/-moz-device-pixel-ratio';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The -moz-device-pixel-ratio Gecko-only CSS media feature can be used to apply styles based on the number of device pixels per CSS pixel.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_IS_DEPRECATED;
                    $tmp_pattern_species = 'MEDIA_QUERIES';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'min-device-width':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/@media/device-width';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The device-width CSS media feature can be used to test the width of an output device\'s rendering surface.<br><br>
The device-width feature is specified as a <length> value. It is a range feature, meaning that you can also use the prefixed min-device-width and max-device-width variants to query minimum and maximum values, respectively.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_IS_DEPRECATED;
                    $tmp_pattern_species = 'MEDIA_QUERIES';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'MEDIA_QUERIES_min-height':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/@media';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The min-height CSS property sets the minimum height of an element. It prevents the used value of the height property from becoming smaller than the value specified for min-height.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'MEDIA_QUERIES';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'min-resolution':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/@media/resolution';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The resolution CSS media feature can be used to test the pixel density of the output device.<br><br>

The resolution feature is specified as a <resolution> value representing the pixel density of the output device. It is a range feature, meaning that you can also use the prefixed min-resolution and max-resolution variants to query minimum and maximum values, respectively.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'MEDIA_QUERIES';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'MEDIA_QUERIES_min-width':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/@media';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The min-width CSS property sets the minimum width of an element. It prevents the used value of the width property from becoming smaller than the value specified for min-width.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'MEDIA_QUERIES';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'orientation':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/@media/orientation';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The orientation CSS media feature can be used to test the orientation of the viewport (or the page box, for paged media).';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'MEDIA_QUERIES';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'pointer':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/@media/pointer';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The pointer CSS media feature tests whether the user has a pointing device (such as a mouse), and if so, how accurate the primary pointing device is.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'MEDIA_QUERIES';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;

                // TEXT_FONTS
                case '@font-face':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/@font-face';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The @font-face CSS at-rule specifies a custom font with which to display text; the font can be loaded from either a remote server or a locally-installed font on the user\'s own computer.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'EOT':

                    $tmp_uri = '';
                    $tmp_description = '';

                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_NONE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'SVG':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/SVG/Element/svg';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The svg element is a container that defines a new coordinate system and viewport. It is used as the outermost element of SVG documents, but it can also be used to embed an SVG fragment inside an SVG or HTML document.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'TTF':

                    $tmp_uri = '';
                    $tmp_description = '';

                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_NONE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'WOFF':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/Guide/WOFF';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'WOFF (the Web Open Font Format) is a web font format developed by Mozilla in concert with Type Supply, LettError, and other organizations. It uses a compressed version of the same table-based sfnt structure used by TrueType, OpenType, and Open Font Format, but adds metadata and private-use data structures, including predefined fields allowing foundries and vendors to provide license information if desired.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_NONE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'WOFF2':

                    $tmp_uri = '';
                    $tmp_description = '';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_NONE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'WOFF base64 encoded':

                    $tmp_uri = '';
                    $tmp_description = '';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_NONE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'WOFF2 base64 encoded':

                    $tmp_uri = '';
                    $tmp_description = '';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_NONE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'direction':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/direction';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The direction CSS property sets the direction of text, table columns, and horizontal overflow. Use rtl for languages written from right to left (like Hebrew or Arabic), and ltr for those written from left to right (like English and most other languages).';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'font':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/font';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The font CSS shorthand property sets all the different properties of an element\'s font. Alternatively, it sets an element\'s font to a system font.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'font-family':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/font-family';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The font-family CSS property specifies a prioritized list of one or more font family names and/or generic family names for the selected element.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'font-feature-settings':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/font-feature-settings';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The font-feature-settings CSS property controls advanced typographic features in OpenType fonts.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'font-kerning':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/font-kerning';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The font-kerning CSS property sets the use of the kerning information stored in a font.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'font-size':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/font-size';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The font-size CSS property sets the size of the font. Changing the font size also updates the sizes of the font size-relative <length> units, such as em, ex, and so forth.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'font-size-adjust':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/font-size-adjust';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The font-size-adjust CSS property sets the size of lower-case letters relative to the current font size (which defines the size of upper-case letters).';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'font-stretch':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/font-stretch';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The font-stretch CSS property selects a normal, condensed, or expanded face from a font.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'font-style':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/font-style';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The font-style CSS property sets whether a font should be styled with a normal, italic, or oblique face from its font-family.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'font-synthesis':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/font-synthesis';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The font-synthesis CSS property controls which missing typefaces, bold or italic, may be synthesized by the browser.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'font-variant':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/font-variant';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The font-variant CSS shorthand property allows you to set all the font variants for a font.<br><br>

You can also set the CSS Level 2 (Revision 1) values of font-variant, (that is, normal or small-caps), by using the font shorthand.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'font-weight':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/font-weight';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The font-weight CSS property sets the weight (or boldness) of the font. The weights available depend on the font-family that is currently set.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'hyphens':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/hyphens';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The hyphens CSS property specifies how words should be hyphenated when text wraps across multiple lines. It can prevent hyphenation entirely, hyphenate at manually-specified points within the text, or let the browser automatically insert hyphens where appropriate.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'letter-spacing':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/letter-spacing';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The letter-spacing CSS property sets the horizontal spacing behavior between text characters. This value is added to the natural spacing between characters while rendering the text. Positive values of letter-spacing causes characters to spread farther apart, while negative values of letter-spacing bring characters closer together.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'line-height':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/line-height';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The line-height CSS property sets the height of a line box. It\'s commonly used to set the distance between lines of text. On block-level elements, it specifies the minimum height of line boxes within the element. On non-replaced inline elements, it specifies the height that is used to calculate line box height.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'overflow-wrap':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/overflow-wrap';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The overflow-wrap CSS property applies to inline elements, setting whether the browser should insert line breaks within an otherwise unbreakable string to prevent text from overflowing its line box.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'text-align':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/text-align';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The text-align CSS property sets the horizontal alignment of a block element or table-cell box. This means it works like vertical-align but in the horizontal direction.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'text-decoration':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/text-decoration';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The text-decoration shorthand CSS property sets the appearance of decorative lines on text. It is a shorthand for text-decoration-line, text-decoration-color, text-decoration-style, and the newer text-decoration-thickness property.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'text-fill-color':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/-webkit-text-fill-color';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The -webkit-text-fill-color CSS property specifies the fill color of characters of text. If this property is not set, the value of the color property is used.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'text-indent':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/text-indent';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The text-indent CSS property sets the length of empty space (indentation) that is put before lines of text in a block';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'text-overflow':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/text-overflow';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The text-overflow CSS property sets how hidden overflow content is signaled to users. It can be clipped, display an ellipsis (\'…\'), or display a custom string.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'text-shadow':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/text-shadow';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The text-shadow CSS property adds shadows to text. It accepts a comma-separated list of shadows to be applied to the text and any of its decorations. Each shadow is described by some combination of X and Y offsets from the element, blur radius, and color.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'text-size-adjust':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/text-size-adjust';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The text-size-adjust CSS property controls the text inflation algorithm used on some smartphones and tablets. Other browsers will ignore this property.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'text-stroke':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/-webkit-text-stroke';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The -webkit-text-stroke CSS property specifies the width and color of strokes for text characters. This is a shorthand property for the longhand properties -webkit-text-stroke-width and -webkit-text-stroke-color.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'text-stroke-color':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/-webkit-text-stroke-color';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The -webkit-text-stroke-color CSS property specifies the stroke color of characters of text. If this property is not set, the value of the color property is used.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'text-stroke-width':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/-webkit-text-stroke-width';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The -webkit-text-stroke-width CSS property specifies the width of the stroke for text.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'text-transform':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/text-transform';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The text-transform CSS property specifies how to capitalize an element\'s text. It can be used to make text appear in all-uppercase or all-lowercase, or with each word capitalized. It also can help improve legibility for ruby.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'vertical-align':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/vertical-align';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The vertical-align CSS property sets vertical alignment of an inline, inline-block or table-cell box.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'white-space':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/white-space';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The white-space CSS property sets how white space inside an element is handled.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'word-spacing':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/word-spacing';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The word-spacing CSS property sets the length of space between words and between tags.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'word-wrap':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/overflow-wrap';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The overflow-wrap CSS property applies to inline elements, setting whether the browser should insert line breaks within an otherwise unbreakable string to prevent text from overflowing its line box.<br><br>
The property was originally a nonstandard and unprefixed Microsoft extension called word-wrap, and was implemented by most browsers with the same name. It has since been renamed to overflow-wrap, with word-wrap being an alias.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TEXT_FONTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;

                // COLOR_BACKGROUND
                case 'background':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/background';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The background shorthand CSS property sets all background style properties at once, such as color, image, origin and size, or repeat method.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'COLOR_BACKGROUND';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'background-attachment':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/background-attachment';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The background-attachment CSS property sets whether a background image\'s position is fixed within the viewport, or scrolls with its containing block.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'COLOR_BACKGROUND';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'background-blend-mode':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/background-blend-mode';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The background-blend-mode CSS property sets how an element\'s background images should blend with each other and with the element\'s background color.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'COLOR_BACKGROUND';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'background-clip':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/background-clip';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The background-clip CSS property sets whether an element\'s background extends underneath its border box, padding box, or content box.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'COLOR_BACKGROUND';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'background-color':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/background-color';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The background-color CSS property sets the background color of an element.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'COLOR_BACKGROUND';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'background-image':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/background-image';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The background-image CSS property sets one or more background images on an element.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'COLOR_BACKGROUND';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'background-origin':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/background-origin';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The background-origin CSS property sets the background\'s origin: from the border start, inside the border, or inside the padding.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'COLOR_BACKGROUND';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'background-position':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/background-position';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The background-position CSS property sets the initial position for each background image. The position is relative to the position layer set by background-origin.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'COLOR_BACKGROUND';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'background-repeat':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/background-repeat';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The background-repeat CSS property sets how background images are repeated. A background image can be repeated along the horizontal and vertical axes, or not repeated at all.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'COLOR_BACKGROUND';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'background-size':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/background-size';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The background-size CSS property sets the size of the element\'s background image. The image can be left to its natural size, stretched, or constrained to fit the available space.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'COLOR_BACKGROUND';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'color':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/color';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The color CSS property sets the foreground color value of an element\'s text and text decorations, and sets the <currentcolor> value. currentcolor may be used as an indirect value on other properties and is the default for other color properties, such as border-color.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'COLOR_BACKGROUND';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'isolation':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/isolation';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The isolation CSS property determines whether an element must create a new stacking context.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'COLOR_BACKGROUND';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'mix-blend-mode':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/mix-blend-mode';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The mix-blend-mode CSS property sets how an element\'s content should blend with the content of the element\'s parent and the element\'s background.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'COLOR_BACKGROUND';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'CSS gradients':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Images/Using_CSS_gradients';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'CSS gradients are represented by the <gradient> data type, a special type of <image> made of a progressive transition between two or more colors. You can choose between three types of gradients: linear (created with the linear-gradient() function), radial (created with radial-gradient()), and conic (created with the conic-gradient() function). You can also create repeating gradients with the repeating-linear-gradient(), repeating-radial-gradient(), and repeating-conic-gradient() functions.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_CSS_GRADIENTS;
                    $tmp_pattern_species = 'COLOR_BACKGROUND';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'Data URI background image':

                    $tmp_uri = '';
                    $tmp_description = '';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_NONE;
                    $tmp_pattern_species = 'COLOR_BACKGROUND';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'Multiple background images':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Backgrounds_and_Borders/Using_multiple_backgrounds';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'You can apply multiple backgrounds to elements. These are layered atop one another with the first background you provide on top and the last background listed in the back. Only the last background can include a background color.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'COLOR_BACKGROUND';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'HTML 4.01 Named Colors':

                    $tmp_uri = 'https://www.w3schools.com/colors/colors_names.asp';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'Color names.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'COLOR_BACKGROUND';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'X11 Named Colors':

                    $tmp_uri = 'https://en.wikipedia.org/wiki/X11_color_names';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'In computing, on the X Window System, X11 color names are represented in a simple text file, which maps certain strings to RGB color values.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'COLOR_BACKGROUND';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'HEX Colors':

                    $tmp_uri = 'https://www.w3schools.com/colors/colors_hexadecimal.asp';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'Hexadecimal color values are also supported in all browsers.<br><br>

A hexadecimal color is specified with: #RRGGBB.<br><br>

RR (red), GG (green) and BB (blue) are hexadecimal integers between 00 and FF specifying the intensity of the color.<br><br>

For example, #0000FF is displayed as blue, because the blue component is set to its highest value (FF) and the others are set to 00.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'COLOR_BACKGROUND';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'HEX Shorthand Colors':

                    $tmp_uri = 'https://www.w3.org/TR/CSS1/#color-units';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The format of an RGB value in hexadecimal notation is a \'#\' immediately followed by either three or six hexadecimal characters. The three-digit RGB notation (#rgb) is converted into six-digit form (#rrggbb) by replicating digits, not by adding zeros.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'COLOR_BACKGROUND';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'HSL Colors':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/color_value/hsl()';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The hsl() functional notation expresses a given color according to its hue, saturation, and lightness components. An optional alpha component represents the color\'s transparency.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'COLOR_BACKGROUND';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'HSLA Colors':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/color_value/hsla()';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The hsla() functional notation expresses a given color according to its hue, saturation, and lightness components. An optional alpha component represents the color\'s transparency.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_HSLA;
                    $tmp_pattern_species = 'COLOR_BACKGROUND';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'RGB Colors':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/color_value/rgb()';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The rgb() functional notation expresses a color according to its red, green, and blue components. An optional alpha component represents the color\'s transparency.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_RGB;
                    $tmp_pattern_species = 'COLOR_BACKGROUND';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'RGBA Colors':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/color_value/rgba()';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The rgba() functional notation expresses a color according to its red, green, and blue components. An optional alpha component represents the color\'s transparency.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_RGBA;
                    $tmp_pattern_species = 'COLOR_BACKGROUND';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'currentColor':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/color_value#currentcolor_keyword';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The currentcolor keyword represents the value of an element\'s color property. This lets you use the color value on properties that do not receive it by default.<br><br>

If currentcolor is used as the value of the color property, it instead takes its value from the inherited value of the color property.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_CURRENTCOLOR;
                    $tmp_pattern_species = 'COLOR_BACKGROUND';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;

                // BOX_MODEL
                case 'border':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/border';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The border shorthand CSS property sets an element\'s border. It sets the values of border-width, border-style, and border-color.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'border-bottom':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/border-bottom';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The border-bottom shorthand CSS property sets an element\'s bottom border. It sets the values of border-bottom-width, border-bottom-style and border-bottom-color.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'border-bottom-color':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/border-bottom-color';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The border-bottom-color CSS property sets the color of an element\'s bottom border. It can also be set with the shorthand CSS properties border-color or border-bottom.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'border-bottom-left-radius':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/border-bottom-left-radius';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The border-bottom-left-radius CSS property rounds the bottom-left corner of an element by specifying the radius (or the radius of the semi-major and semi-minor axes) of the ellipse defining the curvature of the corner.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'border-bottom-right-radius':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/border-bottom-right-radius';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The border-bottom-right-radius CSS property rounds the bottom-right corner of an element by specifying the radius (or the radius of the semi-major and semi-minor axes) of the ellipse defining the curvature of the corner.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'border-bottom-style':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/border-bottom-style';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The border-bottom-style CSS property sets the line style of an element\'s bottom border.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'border-bottom-width':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/border-bottom-width';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The border-bottom-width CSS property sets the width of the bottom border of an element.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'border-color':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/border-color';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The border-color shorthand CSS property sets the color of an element\'s border.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'border-image':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/border-image';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The border-image CSS property draws an image around a given element. It replaces the element\'s regular border.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'border-left':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/border-left';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The border-left shorthand CSS property sets all the properties of an element\'s left border.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'border-left-color':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/border-left-color';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The border-left-color CSS property sets the color of an element\'s left border. It can also be set with the shorthand CSS properties border-color or border-left.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'border-left-style':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/border-left-style';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The border-left-style CSS property sets the line style of an element\'s left border.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'border-left-width':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/border-left-width';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The border-left-width CSS property sets the width of the left border of an element.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'border-radius':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/border-radius';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The border-radius CSS property rounds the corners of an element\'s outer border edge. You can set a single radius to make circular corners, or two radii to make elliptical corners.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'border-right':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/border-right';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The border-right shorthand CSS property sets all the properties of an element\'s right border.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'border-right-color':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/border-right-color';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The border-right-color CSS property sets the color of an element\'s right border. It can also be set with the shorthand CSS properties border-color or border-right.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'border-right-style':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/border-right-style';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The border-right-style CSS property sets the line style of an element\'s right border.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'border-right-width':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/border-right-width';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The border-right-width CSS property sets the width of the right border of an element.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'border-style':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/border-style';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The border-style shorthand CSS property sets the line style for all four sides of an element\'s border.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'border-top':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/border-top';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The border-top shorthand CSS property sets all the properties of an element\'s top border.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'border-top-color':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/border-top-color';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The border-top-color CSS property sets the color of an element\'s top border. It can also be set with the shorthand CSS properties border-color or border-top.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'border-top-left-radius':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/border-top-left-radius';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The border-top-left-radius CSS property rounds the top-left corner of an element by specifying the radius (or the radius of the semi-major and semi-minor axes) of the ellipse defining the curvature of the corner.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'border-top-right-radius':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/border-top-right-radius';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The border-top-right-radius CSS property rounds the top-right corner of an element by specifying the radius (or the radius of the semi-major and semi-minor axes) of the ellipse defining the curvature of the corner.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'border-top-style':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/border-top-style';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The border-top-style CSS property sets the line style of an element\'s top border.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'border-top-width':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/border-top-width';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The border-top-width CSS property sets the width of the top border of an element.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'border-width':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/border-width';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The border-width shorthand CSS property sets the width of an element\'s border.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'box-shadow':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/box-shadow';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The box-shadow CSS property adds shadow effects around an element\'s frame. You can set multiple effects separated by commas. A box shadow is described by X and Y offsets relative to the element, blur and spread radius, and color.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'box-sizing':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/box-sizing';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The box-sizing CSS property sets how the total width and height of an element is calculated.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'height':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/height';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The height CSS property specifies the height of an element. By default, the property defines the height of the content area. If box-sizing is set to border-box, however, it instead determines the height of the border area.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'margin':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/margin';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The margin CSS property sets the margin area on all four sides of an element. It is a shorthand for margin-top, margin-right, margin-bottom, and margin-left.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'margin-bottom':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/margin-bottom';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The margin-bottom CSS property sets the margin area on the bottom of an element. A positive value places it farther from its neighbors, while a negative value places it closer.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'margin-left':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/margin-left';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The margin-left CSS property sets the margin area on the left side of an element. A positive value places it farther from its neighbors, while a negative value places it closer.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'margin-right':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/margin-right';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The margin-right CSS property sets the margin area on the right side of an element. A positive value places it farther from its neighbors, while a negative value places it closer.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'margin-top':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/margin-top';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The margin-top CSS property sets the margin area on the top of an element. A positive value places it farther from its neighbors, while a negative value places it closer.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'BOX_MODEL_max-height':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/max-height';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The max-height CSS property sets the maximum height of an element. It prevents the used value of the height property from becoming larger than the value specified for max-height.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'BOX_MODEL_max-width':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/max-width';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The max-width CSS property sets the maximum width of an element. It prevents the used value of the width property from becoming larger than the value specified by max-width.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'BOX_MODEL_min-height':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/min-height';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The min-height CSS property sets the minimum height of an element. It prevents the used value of the height property from becoming smaller than the value specified for min-height.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'BOX_MODEL_min-width':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/min-width';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The min-width CSS property sets the minimum width of an element. It prevents the used value of the width property from becoming smaller than the value specified for min-width.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'padding':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/padding';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The padding CSS shorthand property sets the padding area on all four sides of an element at once.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'padding-bottom':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/padding-bottom';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The padding-bottom CSS property sets the height of the padding area on the bottom of an element.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'padding-left':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/padding-left';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The padding-left CSS property sets the width of the padding area to the left of an element.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'padding-right':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/padding-right';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The padding-right CSS property sets the width of the padding area on the right of an element.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                break;
                case 'padding-top':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/padding-top';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The padding-top CSS property sets the height of the padding area on the top of an element.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                break;
                case 'width':  // 2

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/width';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The width CSS property sets an element\'s width. By default, it sets the width of the content area, but if box-sizing is set to border-box, it sets the width of the border area.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'BOX_MODEL';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;

                // POSITIONING_AND_DISPLAY
                case 'bottom':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/bottom';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The bottom CSS property participates in setting the vertical position of a positioned element. It has no effect on non-positioned elements.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'POSITIONING_AND_DISPLAY';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'clear':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/clear';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The clear CSS property sets whether an element must be moved below (cleared) floating elements that precede it. The clear property applies to floating and non-floating elements.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'POSITIONING_AND_DISPLAY';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'cursor':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/cursor';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The cursor CSS property sets the type of mouse cursor, if any, to show when the mouse pointer is over an element.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'POSITIONING_AND_DISPLAY';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'POSITIONING_AND_DISPLAY_display':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/display';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The display CSS property sets whether an element is treated as a block or inline element and the layout used for its children, such as flow layout, grid or flex.<br><br>

Formally, the display property sets an element\'s inner and outer display types. The outer type sets an element\'s participation in flow layout; the inner type sets the layout of children. Some values of display are fully defined in their own individual specifications; for example the detail of what happens when display: flex is declared is defined in the CSS Flexible Box Model specification.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'POSITIONING_AND_DISPLAY';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'float':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/float';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The float CSS property places an element on the left or right side of its container, allowing text and inline elements to wrap around it. The element is removed from the normal flow of the page, though still remaining a part of the flow (in contrast to absolute positioning).';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'POSITIONING_AND_DISPLAY';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'left':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/left';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The left CSS property participates in specifying the horizontal position of a positioned element. It has no effect on non-positioned elements.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'POSITIONING_AND_DISPLAY';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'object-fit':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/object-fit';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The object-fit CSS property sets how the content of a replaced element, such as an <img> or <video>, should be resized to fit its container.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'POSITIONING_AND_DISPLAY';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'object-position':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/object-position';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The object-position CSS property specifies the alignment of the selected replaced element\'s contents within the element\'s box. Areas of the box which aren\'t covered by the replaced element\'s object will show the element\'s background.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'POSITIONING_AND_DISPLAY';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'opacity':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/opacity';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The opacity CSS property sets the opacity of an element. Opacity is the degree to which content behind an element is hidden, and is the opposite of transparency.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'POSITIONING_AND_DISPLAY';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'outline':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/outline';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The outline CSS shorthand property set all the outline properties in a single declaration.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'POSITIONING_AND_DISPLAY';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'outline-color':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/outline-color';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The outline-color CSS property sets the color of an element\'s outline.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'POSITIONING_AND_DISPLAY';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'outline-style':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/outline-style';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The outline-style CSS property sets the style of an element\'s outline. An outline is a line that is drawn around an element, outside the border.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'POSITIONING_AND_DISPLAY';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'outline-width':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/outline-width';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The CSS outline-width property sets the thickness of an element\'s outline. An outline is a line that is drawn around an element, outside the border.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'POSITIONING_AND_DISPLAY';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'overflow':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/overflow';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The overflow CSS shorthand property sets the desired behavior for an element\'s overflow &ndash; i.e. when an element\'s content is too big to fit in its block formatting context &ndash; in both directions.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'POSITIONING_AND_DISPLAY';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'position':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/position';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The position CSS property sets how an element is positioned in a document. The top, right, bottom, and left properties determine the final location of positioned elements.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'POSITIONING_AND_DISPLAY';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'resize':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/resize';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The resize CSS property sets whether an element is resizable, and if so, in which direction';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'POSITIONING_AND_DISPLAY';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'right':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/right';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The right CSS property participates in specifying the horizontal position of a positioned element. It has no effect on non-positioned elements.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'POSITIONING_AND_DISPLAY';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'top':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/top';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The top CSS property participates in specifying the vertical position of a positioned element. It has no effect on non-positioned elements.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'POSITIONING_AND_DISPLAY';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'visibility':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/visibility';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The visibility CSS property shows or hides an element without changing the layout of a document. The property can also hide rows or columns in a <table>.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'POSITIONING_AND_DISPLAY';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'z-index':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/z-index';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The z-index CSS property sets the z-order of a positioned element and its descendants or flex items. Overlapping elements with a larger z-index cover those with a smaller one.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'POSITIONING_AND_DISPLAY';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;

                // LISTS
                case 'list-style':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/list-style';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The list-style CSS shorthand property allows you to set all the list style properties at once.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'LISTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'list-style-image':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/list-style-image';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The list-style-image CSS property sets an image to be used as the list item marker.<br><br>

It is often more convenient to use the shorthand list-style.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'LISTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'list-style-position':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/list-style-position';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The list-style-position CSS property sets the position of the ::marker relative to a list item.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'LISTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'list-style-type':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/list-style-type';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The list-style-type CSS property sets the marker (such as a disc, character, or custom counter style) of a list item element.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'LISTS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;

                // TABLES
                case 'border-collapse':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/border-collapse';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The border-collapse CSS property sets whether cells inside a <table> have shared or separate borders.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TABLES';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'border-spacing':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/border-spacing';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The border-spacing CSS property sets the distance between the borders of adjacent <table> cells. This property applies only when border-collapse is separate.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TABLES';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'caption-side':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/caption-side';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The caption-side CSS property puts the content of a table\'s <caption> on the specified side. The values are relative to the writing-mode of the table.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TABLES';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'empty-cells':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/empty-cells';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The empty-cells CSS property sets whether borders and backgrounds appear around <table> cells that have no visible content.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TABLES';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'table-layout':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/table-layout';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The table-layout CSS property sets the algorithm used to lay out <table> cells, rows, and columns.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TABLES';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;

                // ANIMATIONS
                case 'animation':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/animation';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The animation shorthand CSS property applies an animation between styles. It is a shorthand for animation-name, animation-duration, animation-timing-function, animation-delay, animation-iteration-count, animation-direction, animation-fill-mode, and animation-play-state.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'ANIMATIONS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'animation-delay':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/animation-delay';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The animation-delay CSS property specifies the amount of time to wait from applying the animation to an element before beginning to perform the animation. The animation can start later, immediately from its beginning, or immediately and partway through the animation.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'ANIMATIONS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'animation-direction':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/animation-direction';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The animation-direction CSS property sets whether an animation should play forward, backward, or alternate back and forth between playing the sequence forward and backward.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'ANIMATIONS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'animation-duration':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/animation-duration';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The animation-duration CSS property sets the length of time that an animation takes to complete one cycle.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'ANIMATIONS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'animation-fill-mode':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/animation-fill-mode';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The animation-fill-mode CSS property sets how a CSS animation applies styles to its target before and after its execution.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'ANIMATIONS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'animation-iteration-count':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/animation-iteration-count';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The animation-iteration-count CSS property sets the number of times an animation sequence should be played before stopping.<br><br>

If multiple values are specified, each time the animation is played the next value in the list is used, cycling back to the first value after the last one is used.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'ANIMATIONS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'animation-name':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/animation-name';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The animation-name CSS property specifies the names of one or more @keyframes at-rules describing the animation or animations to apply to the element.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'ANIMATIONS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'animation-play-state':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/animation-play-state';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The animation-play-state CSS property sets whether an animation is running or paused.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'ANIMATIONS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'animation-timing-function':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/animation-timing-function';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The animation-timing-function CSS property sets how an animation progresses through the duration of each cycle.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'ANIMATIONS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;

                // TRANSFORMS
                case 'backface-visibility':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/backface-visibility';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The backface-visibility CSS property sets whether the back face of an element is visible when turned towards the user.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TRANSFORMS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'perspective':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/perspective';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The perspective CSS property determines the distance between the z=0 plane and the user in order to give a 3D-positioned element some perspective.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TRANSFORMS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'perspective-origin':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/perspective-origin';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The perspective-origin CSS property determines the position at which the viewer is looking. It is used as the vanishing point by the perspective property.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TRANSFORMS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'transform':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/transform';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The transform CSS property lets you rotate, scale, skew, or translate an element. It modifies the coordinate space of the CSS visual formatting model.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TRANSFORMS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'transform-origin':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/transform-origin';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The transform-origin CSS property sets the origin for an element\'s transformations.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TRANSFORMS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'transform-style':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/transform-style';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The transform-style CSS property sets whether children of an element are positioned in the 3D space or are flattened in the plane of the element.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TRANSFORMS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;

                // TRANSITIONS
                case 'transition':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/transition';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The transition CSS property is a shorthand property for transition-property, transition-duration, transition-timing-function, and transition-delay.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TRANSITIONS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'transition-delay':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/transition-delay';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The transition-delay CSS property specifies the duration to wait before starting a property\'s transition effect when its value changes.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TRANSITIONS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'transition-duration':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/transition-duration';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The transition-duration CSS property sets the length of time a transition animation should take to complete. By default, the value is 0s, meaning that no animation will occur.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TRANSITIONS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'transition-property':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/transition-property';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The transition-property CSS property sets the CSS properties to which a transition effect should be applied.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TRANSITIONS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'transition-timing-function':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/transition-timing-function';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The transition-timing-function CSS property sets how intermediate values are calculated for CSS properties being affected by a transition effect.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'TRANSITIONS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;

                // FILTERS
                case 'backdrop-filter':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/backdrop-filter';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The backdrop-filter CSS property lets you apply graphical effects such as blurring or color shifting to the area behind an element. Because it applies to everything behind the element, to see the effect you must make the element or its background at least partially transparent.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'FILTERS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'filter':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/filter';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The filter CSS property applies graphical effects like blur or color shift to an element. Filters are commonly used to adjust the rendering of images, backgrounds, and borders.<br><br>

Included in the CSS standard are several functions that achieve predefined effects. You can also reference an SVG filter with a URL to an SVG filter element.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'FILTERS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;

                // COLUMNS
                case 'break-after':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/break-after';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The break-after CSS property sets how page, column, or region breaks should behave after a generated box. If there is no generated box, the property is ignored.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'COLUMNS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'break-before':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/break-before';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The break-before CSS property sets how page, column, or region breaks should behave before a generated box. If there is no generated box, the property is ignored.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'COLUMNS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'break-inside':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/break-inside';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The break-inside CSS property sets how page, column, or region breaks should behave inside a generated box. If there is no generated box, the property is ignored.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'COLUMNS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'column-count':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/column-count';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The column-count CSS property breaks an element\'s content into the specified number of columns.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'COLUMNS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'column-fill':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/column-fill';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The column-fill CSS property controls how an element\'s contents are balanced when broken into columns.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'COLUMNS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'column-gap':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/column-gap';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The column-gap CSS property sets the size of the gap (gutter) between an element\'s columns.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'COLUMNS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'column-rule':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/column-rule';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The column-rule shorthand CSS property sets the width, style, and color of the line drawn between columns in a multi-column layout.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'COLUMNS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'column-rule-color':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/column-rule-color';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The column-rule-color CSS property sets the color of the line drawn between columns in a multi-column layout.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'COLUMNS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'column-rule-style':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/column-rule-style';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The column-rule-style CSS property sets the style of the line drawn between columns in a multi-column layout.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'COLUMNS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'column-rule-width':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/column-rule-width';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The column-rule-width CSS property sets the width of the line drawn between columns in a multi-column layout.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'COLUMNS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'column-span':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/column-span';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The column-span CSS property makes it possible for an element to span across all columns when its value is set to all.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'COLUMNS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'column-width':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/column-width';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The column-width CSS property sets the ideal column width in a multi-column layout. The container will have as many columns as can fit without any of them having a width less than the column-width value. If the width of the container is narrower than the specified value, the single column\'s width will be smaller than the declared column width.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'COLUMNS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'columns':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/columns';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The columns CSS shorthand property sets the number of columns to use when drawing an element\'s contents, as well as those columns\' widths.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'COLUMNS';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;

                // FLEXBOX
                case 'FLEXBOX_align-content':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/align-content';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The CSS align-content property sets the distribution of space between and around content items along a flexbox\'s cross-axis or a grid\'s block axis.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'FLEXBOX';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'FLEXBOX_align-items':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/align-items';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The CSS align-items property sets the align-self value on all direct children as a group. In Flexbox, it controls the alignment of items on the Cross Axis. In Grid Layout, it controls the alignment of items on the Block Axis within their grid area.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'FLEXBOX';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'FLEXBOX_align-self':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/align-self';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The align-self CSS property overrides a grid or flex item\'s align-items value. In Grid, it aligns the item inside the grid area. In Flexbox, it aligns the item on the cross axis.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'FLEXBOX';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'FLEXBOX_display':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/display';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The display CSS property sets whether an element is treated as a block or inline element and the layout used for its children, such as flow layout, grid or flex.<br><br>

Formally, the display property sets an element\'s inner and outer display types. The outer type sets an element\'s participation in flow layout; the inner type sets the layout of children. Some values of display are fully defined in their own individual specifications; for example the detail of what happens when display: flex is declared is defined in the CSS Flexible Box Model specification.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'FLEXBOX';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'flex':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/flex';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The flex CSS shorthand property sets how a flex item will grow or shrink to fit the space available in its flex container.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'FLEXBOX';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'flex-basis':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/flex-basis';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The flex-basis CSS property sets the initial main size of a flex item. It sets the size of the content box unless otherwise set with box-sizing.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'FLEXBOX';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'flex-direction':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/flex-direction';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The flex-direction CSS property sets how flex items are placed in the flex container defining the main axis and the direction (normal or reversed).';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'FLEXBOX';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'flex-flow':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/flex-flow';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The flex-flow CSS shorthand property specifies the direction of a flex container, as well as its wrapping behavior.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'FLEXBOX';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'flex-grow':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/flex-grow';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The flex-grow CSS property sets the flex grow factor of a flex item\'s main size.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'FLEXBOX';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'flex-shrink':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/flex-shrink';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The flex-shrink CSS property sets the flex shrink factor of a flex item. If the size of all flex items is larger than the flex container, items shrink to fit according to flex-shrink.<br><br>

In use, flex-shrink is used alongside the other flex properties flex-grow and flex-basis, and normally defined using the flex shorthand.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'FLEXBOX';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'flex-wrap':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/flex-wrap';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The flex-wrap CSS property sets whether flex items are forced onto one line or can wrap onto multiple lines. If wrapping is allowed, it sets the direction that lines are stacked.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'FLEXBOX';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'FLEXBOX_justify-content':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/justify-content';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The CSS justify-content property defines how the browser distributes space between and around content items along the main-axis of a flex container, and the inline axis of a grid container.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'FLEXBOX';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'order':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/order';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The order CSS property sets the order to lay out an item in a flex or grid container. Items in a container are sorted by ascending order value and then by their source code order.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'FLEXBOX';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;

                // GRID
                case 'GRID_align-content':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/align-content';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The CSS align-content property sets the distribution of space between and around content items along a flexbox\'s cross-axis or a grid\'s block axis.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'GRID';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'GRID_align-items':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/align-items';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The CSS align-items property sets the align-self value on all direct children as a group. In Flexbox, it controls the alignment of items on the Cross Axis. In Grid Layout, it controls the alignment of items on the Block Axis within their grid area.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'GRID';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'GRID_align-self':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/align-self';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The align-self CSS property overrides a grid or flex item\'s align-items value. In Grid, it aligns the item inside the grid area. In Flexbox, it aligns the item on the cross axis.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'GRID';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'GRID_display':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/display';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The display CSS property sets whether an element is treated as a block or inline element and the layout used for its children, such as flow layout, grid or flex.<br><br>

Formally, the display property sets an element\'s inner and outer display types. The outer type sets an element\'s participation in flow layout; the inner type sets the layout of children. Some values of display are fully defined in their own individual specifications; for example the detail of what happens when display: flex is declared is defined in the CSS Flexible Box Model specification.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'GRID';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'grid':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/grid';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The grid CSS property is a shorthand property that sets all of the explicit and implicit grid properties in a single declaration.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'GRID';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'grid-area':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/grid-area';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The grid-area CSS shorthand property specifies a grid item’s size and location within a grid by contributing a line, a span, or nothing (automatic) to its grid placement, thereby specifying the edges of its grid area.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'GRID';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'grid-auto-columns':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/grid-auto-columns';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The grid-auto-columns CSS property specifies the size of an implicitly-created grid column track or pattern of tracks.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'GRID';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'grid-auto-flow':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/grid-auto-flow';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The grid-auto-flow CSS property controls how the auto-placement algorithm works, specifying exactly how auto-placed items get flowed into the grid.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'GRID';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'grid-auto-rows':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/grid-auto-rows';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The grid-auto-rows CSS property specifies the size of an implicitly-created grid row track or pattern of tracks.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'GRID';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'grid-column':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/grid-column';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The grid-column CSS shorthand property specifies a grid item\'s size and location within a grid column by contributing a line, a span, or nothing (automatic) to its grid placement, thereby specifying the inline-start and inline-end edge of its grid area.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'GRID';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'grid-column-end':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/grid-column-end';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The grid-column-end CSS property specifies a grid item’s end position within the grid column by contributing a line, a span, or nothing (automatic) to its grid placement, thereby specifying the block-end edge of its grid area.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'GRID';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'grid-column-gap':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/column-gap';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The column-gap CSS property sets the size of the gap (gutter) between an element\'s columns.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'GRID';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'grid-column-start':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/grid-column-start';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The grid-column-start CSS property specifies a grid item’s start position within the grid column by contributing a line, a span, or nothing (automatic) to its grid placement. This start position defines the block-start edge of the grid area.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'GRID';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'grid-gap':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/gap';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The gap CSS property sets the gaps (gutters) between rows and columns. It is a shorthand for row-gap and column-gap.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'GRID';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'grid-row':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/grid-row';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The grid-row CSS shorthand property specifies a grid item’s size and location within the grid row by contributing a line, a span, or nothing (automatic) to its grid placement, thereby specifying the inline-start and inline-end edge of its grid area.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'GRID';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'grid-row-end':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/grid-row-end';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The grid-row-end CSS property specifies a grid item’s end position within the grid row by contributing a line, a span, or nothing (automatic) to its grid placement, thereby specifying the inline-end edge of its grid area.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'GRID';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'grid-row-gap':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/row-gap';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The row-gap CSS property sets the size of the gap (gutter) between an element\'s grid rows.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'GRID';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'grid-row-start':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/grid-row-start';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The grid-row-start CSS property specifies a grid item’s start position within the grid row by contributing a line, a span, or nothing (automatic) to its grid placement, thereby specifying the inline-start edge of its grid area.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'GRID';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'grid-template-areas':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/grid-template-areas';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The grid-template-areas CSS property specifies named grid areas, establishing the cells in the grid and assigning them names.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'GRID';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'grid-template-columns':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/grid-template-columns';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The grid-template-columns CSS property defines the line names and track sizing functions of the grid columns.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'GRID';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'grid-template-rows':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/grid-template-rows';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The grid-template-rows CSS property defines the line names and track sizing functions of the grid rows.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'GRID';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'GRID_justify-content': // 2

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/justify-content';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The CSS justify-content property defines how the browser distributes space between and around content items along the main-axis of a flex container, and the inline axis of a grid container.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'GRID';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'justify-items':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/justify-items';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The CSS justify-items property defines the default justify-self for all items of the box, giving them all a default way of justifying each box along the appropriate axis.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'GRID';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case 'justify-self':

                    $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/justify-self';
                    $tmp_uri = $this->oCRNRSTN_USR->return_sticky_link($tmp_uri, 'developer_mozilla_web_docs');
                    $tmp_description = 'The <a href="https://developer.mozilla.org/en-US/docs/Web/CSS" target="_self">CSS</a> justify-self property sets the way a box is justified inside its alignment container along the appropriate axis.';
                    $tmp_validation_type = CRNRSTN_CSS_VALIDATE_STANDARD_USE;
                    $tmp_pattern_species = 'GRID';

                    $tmp_pattern_meta_array = array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);

                    break;
                case '____font-size':

                    /*
                     $tmp_uri = 'https://developer.mozilla.org/en-US/docs/Web/CSS/font-size';
                     $tmp_description = 'The font-size CSS property sets the size of the font. Changing the font size also updates the sizes of the font size-relative <length> units, such as em, ex, and so forth.';
                     $tmp_pattern_nom = 'font-size';
                     $tmp_validation_type =
                        ~ CRNRSTN_CSS_VALIDATE_STANDARD_USE
                        ~ CRNRSTN_CSS_VALIDATE_STYLE_IN_HEAD
                        ~ CRNRSTN_CSS_VALIDATE_LINK_IN_HEAD
                        ~ CRNRSTN_CSS_VALIDATE_STYLE_IN_BODY
                        ~ CRNRSTN_CSS_VALIDATE_LINK_IN_BODY

                    //
                    // GLOBAL CONST.INC.PHP
                    define('CRNRSTN_CSS_RESULTS_HTML', (int) $this->initialize_bit('CRNRSTN_CSS_RESULTS_HTML'));
                    define('CRNRSTN_CSS_RESULTS_INTEGER', (int) $this->initialize_bit('CRNRSTN_CSS_RESULTS_INTEGER'));
                    define('CRNRSTN_CSS_RESULTS_BOOLEAN', (int) $this->initialize_bit('CRNRSTN_CSS_RESULTS_BOOLEAN'));
                    define('CRNRSTN_CSS_PATTERN_LIB_ARRAY', (int) $this->initialize_bit('CRNRSTN_CSS_PATTERN_LIB_ARRAY'));

                    //
                    //
                    // CONSTANTS DEFINED FROM CONSTRUCTOR OF THIS CLASS
                    $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_VALIDATE_STANDARD_USE');
                    $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_VALIDATE_STYLE_IN_HEAD');
                    $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_VALIDATE_LINK_IN_HEAD');
                    $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_VALIDATE_STYLE_IN_BODY');
                    $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_VALIDATE_LINK_IN_BODY');

                    $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_ICON_ALERT_BANG');            // INDICATION OF ICON TYPE TO BIND
                    $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_ICON_SUCCESS_CHECK');           // INDICATION OF ICON TYPE TO BIND
                    $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_ICON_ERR_X');                 // INDICATION OF ICON TYPE TO BIND

                    $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_CLIENT_ASSOC_HAS_META');      // INDICATION OF NEED TO SHOW A NOTE
                    $this->oCRNRSTN_USR->initialize_bit('CRNRSTN_CSS_CLIENT_ASSOC_HAS_DOCS_LNK');  // INDICATION OF NEED TO HTTP LINK THE ELEMENT

                     * */

                    break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Unknown HTML CSS string nomination pattern provided, '.$css_pattern_nom.'.');

                    break;

            }

            return $tmp_pattern_meta_array;

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    private function return_validation_results_HTML($html_content_injection, $r_tblcol_top_padding = 117){

        /*
        'CRNRSTN_UI_JS_JQUERY',
        'CRNRSTN_UI_JS_JQUERY_UI',
        'CRNRSTN_UI_JS_JQUERY_MOBILE',
        'CRNRSTN_UI_JS_LIGHTBOX_DOT_JS',
        'CRNRSTN_UI_TAG_ANALYTICS',
        'CRNRSTN_UI_TAG_ENGAGEMENT',
        'CRNRSTN_UI_FORM_INTEGRATION_PACKET',
        'CRNRSTN_UI_COOKIE_PREFERENCE',
        'CRNRSTN_UI_COOKIE_YESNO',
        'CRNRSTN_UI_COOKIE_NOTICE',
        'CRNRSTN_UI_COOKIE_THEME_DARKNIGHT',
        'CRNRSTN_UI_COOKIE_THEME_FEATHER',
        'CRNRSTN_UI_COOKIE_THEME_DAYLIGHT',
        'CRNRSTN_UI_COOKIE_THEME_GREYSKYS'
         * */

        $tmp_form_serial = $this->oCRNRSTN_USR->generate_new_key(7);

        $tmp_str = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        '.$this->oCRNRSTN_USR->return_creative('CRNRSTN_FAVICON', CRNRSTN_UI_IMG_PNG_HTML_WRAPPED).'
        <meta name="distribution" content="Global" />
        <meta name="ROBOTS" content="index" />
        <meta name="ROBOTS" content="follow" />
        <meta name="msvalidate.01" content="FE0FE9054422153BDD7BBF130A022370" />
        <meta property="og:url" content="http://css.validate.jony5.com/"/>
        <meta property="og:site_name" content="CRNRSTN :: CSS Validator for HTML Email v2.00.0000"/>
        <meta property="og:title" content="Only email pros can score over 92.5%. The CRNRSTN :: CSS Validator will assess the use of CSS within HTML email code and score the situation from a high level and then down to each email client."/>
        <meta property="og:image" content="http://css.validate.jony5.com/_crnrstn/ui/imgs/jpg/crnrstn_css_validator_logo_smedia.jpg?v=420.00"/>
        <meta property="og:description" content="Only email pros can score over 92.5%.  Special thanks to the folks  at WaSP and Campaign Monitor for  their Ultimate Guide to CSS breaking  down a host of the nitty-gritty with  respect to CSS support for many popular mobile, web, and desktop email clients and for their creation of  the Email Standards Project." />
        <meta property="og:type" content="website"/>
        <meta name="twitter:card" content="summary"/>
        <meta name="twitter:title" content="CRNRSTN :: CSS Validator for HTML Email v2.00.0000"/>
        <meta name="twitter:image" content="http://css.validate.jony5.com/_crnrstn/ui/imgs/jpg/crnrstn_css_validator_logo_smedia.jpg?v=420.00"/>
        <meta name="twitter:description" content="Only email pros can score over 92.5%. Special thanks to the folks  at WaSP and Campaign Monitor for  their Ultimate Guide to CSS breaking  down a host of the nitty-gritty with  respect to CSS support!" />
        <meta name="description" content="Only email pros can score over 92.5%. Special thanks to the folks  at WaSP and Campaign Monitor for  their Ultimate Guide to CSS breaking  down a host of the nitty-gritty with  respect to CSS support for many popular mobile, web, and desktop email clients and for their creation of  the Email Standards Project." />
        <meta name="keywords" content="jesus, christ, jesus christ, gospel, j5, jonathan, harris, jonathan harris, johnny 5, jony5, atlanta, moxie, agency, web, christian, web services, email, web programming, marketing, CSS, XHTML, php, ajax" />

        <title>CRNRSTN :: CSS Validator for HTML Email v2.00.0000</title>
' . $this->oCRNRSTN_USR->ui_content_module_out(CRNRSTN_UI_JS_JQUERY) .
            $this->oCRNRSTN_USR->ui_content_module_out(CRNRSTN_UI_CSS_MAIN_DESKTOP & CRNRSTN_UI_JS_MAIN_DESKTOP) . '
    </head>
    <body>
    <div style="width:100%; text-align:center; margin:0 auto; font-family:Arial, Helvetica, sans-serif; background-color: #FFF;">

        <div id="crnrstn_pg_top" style="height:23px; width:100%; clear:both; display: block; overflow: hidden;"></div>

        <div style="width:700px; text-align: center; margin:0 auto;">

            <div style="width: 370px;">
                <div style="float:left;">
                    <div onclick=\'window.location.href="./";\' style=\'width:94px; overflow: hidden; padding: 0; text-align: center; cursor: pointer; color: #6885C3; font-weight: normal; border: 2px solid #A5B9D8; background-color: #D9DEEA; font-family:"Courier New", Courier, monospace;\'>
                        <div style=\'float:left; width:38px; overflow: hidden; height: 18px; background-color: #D9DEEA; margin: 5px 0 0 2px;\'>

                            <div style=\'width:60px; font-family: "Courier New", Courier, monospace; font-size: 15px; color: #6986C3;\'>

                                <div style="position: relative; height:14px; overflow: visible;">
                                    <div style="position: absolute; z-index:1; font-size: 35px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; left:24px; color: #FFF; top:-5px; ">@</div>
                                    <div style="position: absolute; z-index:2; left:0; top:-2px; width:40px; height: 23px; overflow:hidden;font-family: Arial, Helvetica, sans-serif; font-weight: bold; color: #FFF; font-size: 18px;">
                                        <div style="float:left; color:#F90000; font-size: 21px; line-height: 14px; font-weight:bold; padding-top: 1px;">&lt;</div>
                                        <div style=\'float:left; width:15px; font-family: "Courier New", Courier, monospace;  color: #6986C3;\'>HTML</div>
                                    </div>
                                </div>

                                <div style="height:0; width:100%; clear:both; display: block; overflow: hidden;"></div>

                            </div>

                        </div>

                        <div style="float:right; background-color: #6885C3; width:51px; height:23px; overflow: hidden;">
                            <div style="position: relative; height:14px; overflow: visible;">
                                <div style="position: absolute; z-index:1; font-size: 35px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; left:-17px; top:0px; color: #94AAD5;">@</div>
                                <div style="position: absolute; z-index:2; left:7px; top:2px; width:38px; overflow:hidden;font-family: Arial, Helvetica, sans-serif; font-weight: bold; color: #FFF; font-size: 18px;">CSS</div>
                            </div>
                        </div>

                        <div style="float: right; width:3px; line-height: 10px; background-color: #FFF; height: 23px; overflow: hidden;">
                            &nbsp;
                        </div>

                        <div style="height:0; width:100%; clear:both; display: block; overflow: hidden;"></div>

                        <div style="width:100%; background-color: #FBFBFB; text-align:center; padding: 5px 3px 5px 3px; overflow: hidden;">
                            <div style="position: relative; height:14px; overflow: visible;">
                                <div style="position: absolute; z-index:1; font-size: 35px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; left:23px; top:-28px; color: #E2E2E2;">@</div>
                                <div style=\'position: absolute; z-index:2; left:4px; font-size: 15px; font-family: "Courier New", Courier, monospace; font-weight: bold; color: #6986C3;\'>validator</div>
                            </div>

                        </div>

                    </div>

                    <div style="height:0; width:100%; clear:both; display: block; overflow: hidden;"></div>

                </div>

                <div style="float:right; height: 40px;">
                    <div style="height:18px; width:100%; clear:both; display: block; overflow: hidden;"></div>
                    <div id="crnrstn_dyn_branding_elem_shell">'.$this->oCRNRSTN_USR->return_branding_creative(true).'</div>
                </div>
            </div>
            <div style="height:1px; width:100%; clear:both; display: block; overflow: hidden;"></div>

        </div>

        <div style="height:10px; width:100%; clear:both; display: block; overflow: hidden;"></div>


        <div style=" width:700px; text-align: center; margin:0 auto;">
            <div id="crnrstn_css_validation_bdr01_'.$tmp_form_serial.'">

                <div style="width: 100%;">
                    <table cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <td style="vertical-align: top; text-align: left;">
                            <div style="text-align: left; width: 390px; background-color: #FFF;">
                           '.$html_content_injection.'   
                            </div>
                            
                        </td>                                            
                        <td style="vertical-align: top; text-align: left; border-left:10px solid #FFF;">
                            <div style="border-top:'.$r_tblcol_top_padding.'px solid #FFF; vertical-align:top;">                               
                                <table style="border:0; padding: 0; margin:0; width:305px;">
                                <tr>
                                    <td style=\'text-align:left; line-height: 18px; color:#6885C3;border-right:15px solid #FFF; font-size: 14px; margin: 0; font-family:"Courier New", Courier, monospace;\'>
                                        <strong>Note:</strong> Special thanks to the folks  at <a href="'.$this->oCRNRSTN_USR->return_sticky_link('http://webstandards.org/', 'web_standards_thanks_results').'" target="_blank" style="text-decoration: none; color:#0066CC; text-decoration: underline;">WaSP</a> and <a href="'.$this->oCRNRSTN_USR->return_sticky_link('http://www.campaignmonitor.com/', 'campaign_monitor_thanks_results').'" target="_blank" style="text-decoration: none; color:#0066CC; text-decoration: underline;">Campaign Monitor</a>
                                        for  their <a href="'.$this->oCRNRSTN_USR->return_sticky_link('http://www.campaignmonitor.com/css/', 'ultimate_guide_to_css_results').'" target="_blank" style="text-decoration: none; color:#0066CC; text-decoration: underline;">Ultimate Guide to CSS</a> breaking  down a host of the nitty-gritty with
                                         respect to CSS support for many popular mobile, web, and desktop email  clients and for their creation of  the <a href="'.$this->oCRNRSTN_USR->return_sticky_link('http://www.email-standards.org/', 'email_standards_project_results').'" target="_blank" style="text-decoration: none; color:#0066CC; text-decoration: underline;">Email Standards Project</a>.
    
                                        <br><br>  The strength, accuracy, and thorough  consideration baked into the
                                        algorithm  behind this validator are each and  equally directly proportional
                                        to the  diligence and care these organizations  have exercised in the pursuit
                                        of  their craft.
                                                                                                              
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;">
                                        <div style="border-right:20px solid #FFF; border-top:20px solid #FFF;">'.$this->oCRNRSTN_USR->return_creative('ICON_EMAIL_INBOX_REFLECT', CRNRSTN_UI_IMG_PNG_HTML_WRAPPED).'</div>
                                    </td>
                                </tr>
                                </table>
                            </div>       
                        </td>  
                    </tr>
                    </table>
                            
                </div>

            </div>

        </div>

        <div style="height:40px; width:100%; clear:both; display: block; overflow: hidden;"></div>
    
        <div style="float:right; padding:420px 0 0 0; margin:0; width:100%;">
            <div style="position: absolute; width:100%; text-align: right; background-color: #FFF; padding-top: 20px;">
                '.$this->oCRNRSTN_USR->return_creative('J5_WOLF_PUP_RAND', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED).'
            </div>
        </div>

        <div style="height:0; width:100%; clear:both; display: block; overflow: hidden;"></div>

    </div>
   
    '.$this->oCRNRSTN_USR->ui_content_module_out(CRNRSTN_UI_TAG_ANALYTICS).'
    '.$this->oCRNRSTN_USR->ui_content_module_out(CRNRSTN_UI_TAG_ENGAGEMENT).'
    '.$this->oCRNRSTN_USR->ui_content_module_out(CRNRSTN_UI_COOKIE_PREFERENCE).'
    '.$this->oCRNRSTN_USR->ui_content_module_out(CRNRSTN_UI_INTERACT).'
    
    </body>
    </html>';

        return $tmp_str;

    }

    private function return_css_validator_content_HTML($html_content_injection, $r_tblcol_top_padding = 117){

        $tmp_form_serial = $this->oCRNRSTN_USR->generate_new_key(7);

        $tmp_str = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        '.$this->oCRNRSTN_USR->return_creative('CRNRSTN_FAVICON').'
        <meta name="distribution" content="Global" />
        <meta name="ROBOTS" content="index" />
        <meta name="ROBOTS" content="follow" />
        <meta name="msvalidate.01" content="FE0FE9054422153BDD7BBF130A022370" />
        <meta property="og:url" content="http://css.validate.jony5.com/"/>
        <meta property="og:site_name" content="CRNRSTN :: CSS Validator for HTML Email v2.00.0000"/>
        <meta property="og:title" content="Only email pros can score over 92.5%. The CRNRSTN :: CSS Validator will assess the use of CSS within HTML email code and score the situation from a high level and then down to each email client."/>
        <meta property="og:image" content="http://css.validate.jony5.com/_crnrstn/ui/imgs/jpg/crnrstn_css_validator_logo_smedia.jpg?v=420.00"/>
        <meta property="og:description" content="Only email pros can score over 92.5%.  Special thanks to the folks  at WaSP and Campaign Monitor for  their Ultimate Guide to CSS breaking  down a host of the nitty-gritty with  respect to CSS support for many popular mobile, web, and desktop email clients and for their creation of  the Email Standards Project." />
        <meta property="og:type" content="website"/>
        <meta name="twitter:card" content="summary"/>
        <meta name="twitter:title" content="CRNRSTN :: CSS Validator for HTML Email v2.00.0000"/>
        <meta name="twitter:image" content="http://css.validate.jony5.com/_crnrstn/ui/imgs/jpg/crnrstn_css_validator_logo_smedia.jpg?v=420.00"/>
        <meta name="twitter:description" content="Only email pros can score over 92.5%. Special thanks to the folks  at WaSP and Campaign Monitor for  their Ultimate Guide to CSS breaking  down a host of the nitty-gritty with  respect to CSS support!" />
        <meta name="description" content="Only email pros can score over 92.5%. Special thanks to the folks  at WaSP and Campaign Monitor for  their Ultimate Guide to CSS breaking  down a host of the nitty-gritty with  respect to CSS support for many popular mobile, web, and desktop email clients and for their creation of  the Email Standards Project." />
        <meta name="keywords" content="jesus, christ, jesus christ, gospel, j5, jonathan, harris, jonathan harris, johnny 5, jony5, atlanta, moxie, agency, web, christian, web services, email, web programming, marketing, CSS, XHTML, php, ajax" />

        <title>CRNRSTN :: CSS Validator for HTML Email v2.00.0000</title>
' . $this->oCRNRSTN_USR->ui_content_module_out(CRNRSTN_UI_JS_JQUERY_UI) .
            $this->oCRNRSTN_USR->ui_content_module_out(CRNRSTN_UI_CSS_MAIN_DESKTOP & CRNRSTN_UI_JS_MAIN_DESKTOP) . '
    </head>
    <body>
    <div style="width:100%; text-align:center; margin:0 auto; font-family:Arial, Helvetica, sans-serif; background-color: #FFF;">

        <div id="crnrstn_pg_top" style="height:23px; width:100%; clear:both; display: block; overflow: hidden;"></div>

        <div style="width:700px; text-align: center; margin:0 auto;">

            <div style="width: 370px;">
                <div style="float:left;">
                    <div onclick=\'window.location.href="./";\' style=\'width:94px; overflow: hidden; padding: 0; text-align: center; cursor: pointer; color: #6885C3; font-weight: normal; border: 2px solid #A5B9D8; background-color: #D9DEEA; font-family:"Courier New", Courier, monospace;\'>
                        <div style=\'float:left; width:38px; overflow: hidden; height: 18px; background-color: #D9DEEA; margin: 5px 0 0 2px;\'>

                            <div style=\'width:60px; font-family: "Courier New", Courier, monospace; font-size: 15px; color: #6986C3;\'>

                                <div style="position: relative; height:14px; overflow: visible;">
                                    <div style="position: absolute; z-index:1; font-size: 35px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; left:24px; color: #FFF; top:-5px; ">@</div>
                                    <div style="position: absolute; z-index:2; left:0; top:-2px; width:40px; height: 23px; overflow:hidden;font-family: Arial, Helvetica, sans-serif; font-weight: bold; color: #FFF; font-size: 18px;">
                                        <div style="float:left; color:#F90000; font-size: 21px; line-height: 14px; font-weight:bold; padding-top: 1px;">&lt;</div>
                                        <div style=\'float:left; width:15px; font-family: "Courier New", Courier, monospace;  color: #6986C3;\'>HTML</div>
                                    </div>
                                </div>

                                <div style="height:0; width:100%; clear:both; display: block; overflow: hidden;"></div>

                            </div>

                        </div>

                        <div style="float:right; background-color: #6885C3; width:51px; height:23px; overflow: hidden;">
                            <div style="position: relative; height:14px; overflow: visible;">
                                <div style="position: absolute; z-index:1; font-size: 35px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; left:-17px; top:0px; color: #94AAD5;">@</div>
                                <div style="position: absolute; z-index:2; left:7px; top:2px; width:38px; overflow:hidden;font-family: Arial, Helvetica, sans-serif; font-weight: bold; color: #FFF; font-size: 18px;">CSS</div>
                            </div>
                        </div>

                        <div style="float: right; width:3px; line-height: 10px; background-color: #FFF; height: 23px; overflow: hidden;">
                            &nbsp;
                        </div>

                        <div style="height:0; width:100%; clear:both; display: block; overflow: hidden;"></div>

                        <div style="width:100%; background-color: #FBFBFB; text-align:center; padding: 5px 3px 5px 3px; overflow: hidden;">
                            <div style="position: relative; height:14px; overflow: visible;">
                                <div style="position: absolute; z-index:1; font-size: 35px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; left:23px; top:-28px; color: #E2E2E2;">@</div>
                                <div style=\'position: absolute; z-index:2; left:4px; font-size: 15px; font-family: "Courier New", Courier, monospace; font-weight: bold; color: #6986C3;\'>validator</div>
                            </div>

                        </div>

                    </div>

                    <div style="height:0; width:100%; clear:both; display: block; overflow: hidden;"></div>

                </div>

                <div style="float:right; height: 40px;">
                    <div style="height:18px; width:100%; clear:both; display: block; overflow: hidden;"></div>
                    <div id="crnrstn_dyn_branding_elem_shell">'.$this->oCRNRSTN_USR->return_branding_creative(true).'</div>
                </div>
            </div>
            <div style="height:1px; width:100%; clear:both; display: block; overflow: hidden;"></div>

        </div>

        <div style="height:10px; width:100%; clear:both; display: block; overflow: hidden;"></div>

        <div style=" width:700px; text-align: center; margin:0 auto;">
            <div id="crnrstn_css_validation_bdr01_'.$tmp_form_serial.'">

                <div style="width: 100%;">
                        <table style="border:0; padding: 0; margin:0;">
                        <tr>
                            <td style="vertical-align: top; text-align: left;">
                                <div style="text-align: left; width: 370px; background-color: #FFF;">
                               '.$html_content_injection.'   
                                </div>
                                
                            </td>                                            
                            <td style="vertical-align: top; text-align: left; border-left:10px solid #FFF;">
                                <div style="border-top:'.$r_tblcol_top_padding.'px solid #FFF; vertical-align:top;">                               
                                    <table style="border:0; padding: 0; margin:0; width:305px;">
                                    <tr>
                                        <td style=\'text-align:left; line-height: 18px; color:#6885C3;border-right:15px solid #FFF; font-size: 14px; margin: 0; font-family:"Courier New", Courier, monospace;\'>
                                            <strong>Note:</strong> Special thanks to the folks  at <a href="'.$this->oCRNRSTN_USR->return_sticky_link('http://webstandards.org/', 'web_standards_thanks').'" target="_blank" style="text-decoration: none; color:#0066CC; text-decoration: underline;">WaSP</a> and <a href="'.$this->oCRNRSTN_USR->return_sticky_link('http://www.campaignmonitor.com/', 'campaign_monitor_thanks').'" target="_blank" style="text-decoration: none; color:#0066CC; text-decoration: underline;">Campaign Monitor</a>
                                            for  their <a href="'.$this->oCRNRSTN_USR->return_sticky_link('http://www.campaignmonitor.com/css/', 'ultimate_guide_to_css').'" target="_blank" style="text-decoration: none; color:#0066CC; text-decoration: underline;">Ultimate Guide to CSS</a> breaking  down a host of the nitty-gritty with
                                             respect to CSS support for many popular mobile, web, and desktop email  clients and for their creation of  the <a href="'.$this->oCRNRSTN_USR->return_sticky_link('http://www.email-standards.org/', 'email_standards_project').'" target="_blank" style="text-decoration: none; color:#0066CC; text-decoration: underline;">Email Standards Project</a>.
        
                                            <br><br>  The strength, accuracy, and thorough  consideration baked into the
                                            algorithm  behind this validator are each and  equally directly proportional
                                            to the  diligence and care these organizations  have exercised in the pursuit
                                            of  their craft.
                                                                                                                  
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">
                                            <div style="border-right:20px solid #FFF; border-top:20px solid #FFF;">'.$this->oCRNRSTN_USR->return_creative('ICON_EMAIL_INBOX_REFLECT').'</div>
                                        </td>
                                    </tr>
                                    </table>
                                </div>       
                            </td>  
                        </tr>
                        </table>
                            
                </div>

            </div>

        </div>

        <div style="height:40px; width:100%; clear:both; display: block; overflow: hidden;"></div>

        <div style="float:right; padding:420px 0 0 0; margin:0; width:100%;">
            <div style="position: absolute; width:100%; text-align: right; background-color: #FFF; padding-top: 20px;">
                '.$this->oCRNRSTN_USR->return_creative('J5_WOLF_PUP_RAND', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED).'
            </div>
        </div>

        <div style="height:0; width:100%; clear:both; display: block; overflow: hidden;"></div>

    </div>
    
    '.$this->oCRNRSTN_USR->ui_content_module_out(CRNRSTN_UI_TAG_ANALYTICS).'
    '.$this->oCRNRSTN_USR->ui_content_module_out(CRNRSTN_UI_TAG_ENGAGEMENT).'
    '.$this->oCRNRSTN_USR->ui_content_module_out(CRNRSTN_UI_INTERACT).'
    
    </body>
    </html>';

        return $tmp_str;

    }

    private function return_clean_css_pattern($str){

        $tmp_array = explode('_',$str);

        if(sizeof($tmp_array) > 4) {

            error_log(__LINE__ .' css need to check for '.sizeof($tmp_array).' underscores for ['.$str.']');
            die();

        }

        if(sizeof($tmp_array) > 3) {

            $str = $tmp_array[3];

        }else{

            if(sizeof($tmp_array)>2){

                $str = $tmp_array[2];

            }else{

                if(isset($tmp_array[1])){

                    $str = $tmp_array[1];

                }

            }

        }

        return $str;

    }

    private function dynamic_content_return($css_str_pattern, $content_type_key, $output_format='TEXT', $mail_client_constant = null){

        $tmp_str = '';

        switch($content_type_key){
            case 'VALIDATOR_RESULTS_PAGE_NOTES_ERROR_DETAILS_CSS':

                //  array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);
                $tmp_array = $this->return_css_str_pattern_meta($css_str_pattern);

                $css_str_pattern_CLEAN = $this->return_clean_css_pattern($css_str_pattern);

                //
                // ICONOGRAPHY CHECK - ALERT BANG - CRNRSTN_CSS_ICON_ALERT_BANG
                if(in_array($css_str_pattern_CLEAN, $this->redundant_css_nom_ARRAY)){

                    $tmp_serialized_bit_nom = 'META_'.$tmp_array[4].'_'.$css_str_pattern.$mail_client_constant;

                    if($this->oCRNRSTN_USR->serialized_is_bit_set($tmp_serialized_bit_nom, CRNRSTN_CSS_CLIENT_ASSOC_HAS_META)) {

                        //
                        // INFORMATION BANG ICONOGRAPHY
                        $tmp_icon_img = $this->oCRNRSTN_USR->return_creative('NOTICE_TRI_ALERT', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED);

                        $this->results_count_aggregation_ARRAY[$mail_client_constant]['BANG'][] = 1;
                        //error_log(__LINE__ .' '.$mail_client_constant.' BANG cnt = '.count($this->results_count_aggregation_ARRAY[$mail_client_constant]['BANG']));

                    }else{

                        //
                        // CHECK FOR ERR_X
                        if($this->oCRNRSTN_USR->serialized_is_bit_set($tmp_serialized_bit_nom, CRNRSTN_CSS_ICON_ERR_X)){

                            //
                            // ERROR X ICONOGRAPHY
                            $tmp_icon_img = $this->oCRNRSTN_USR->return_creative('ERR_X', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED);

                            $this->results_count_aggregation_ARRAY[$mail_client_constant]['X'][] = 1;
                            //error_log(__LINE__ .' '.$mail_client_constant.' X cnt = '.count($this->results_count_aggregation_ARRAY[$mail_client_constant]['BANG']));


                        }else{

                            //
                            // SUCCESS CHECK ICONOGRAPHY
                            $tmp_icon_img = $this->oCRNRSTN_USR->return_creative('SUCCESS_CHECK', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED);

                            $this->results_count_aggregation_ARRAY[$mail_client_constant]['SUCCESS'][] = 1;
                            //error_log(__LINE__ .' '.$mail_client_constant.' SUCCESS cnt = '.count($this->results_count_aggregation_ARRAY[$mail_client_constant]['BANG']));

                        }

                    }

                    //
                    // META NOTE INCLUDE CHECK
                    if($this->oCRNRSTN_USR->serialized_is_bit_set($tmp_serialized_bit_nom, CRNRSTN_CSS_CLIENT_ASSOC_HAS_META)){

                        $tmp_meta_note = $this->css_pattern_meta_note_ARRAY[$tmp_serialized_bit_nom];

                    }else{

                        $tmp_meta_note = '';

                    }

                }else{

                    $tmp_serialized_bit_nom = 'META_'.$css_str_pattern.$mail_client_constant;

                    if($this->oCRNRSTN_USR->serialized_is_bit_set($tmp_serialized_bit_nom, CRNRSTN_CSS_CLIENT_ASSOC_HAS_META)) {

                        //
                        // INFORMATION BANG ICONOGRAPHY
                        $tmp_icon_img = $this->oCRNRSTN_USR->return_creative('NOTICE_TRI_ALERT', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED);
                        $this->results_count_aggregation_ARRAY[$mail_client_constant]['BANG'][] = 1;

                    }else{

                        //
                        // CHECK FOR ERR_X
                        if($this->oCRNRSTN_USR->serialized_is_bit_set($tmp_serialized_bit_nom, CRNRSTN_CSS_ICON_ERR_X)){

                            //
                            // ERROR X ICONOGRAPHY
                            $tmp_icon_img = $this->oCRNRSTN_USR->return_creative('ERR_X', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED);
                            $this->results_count_aggregation_ARRAY[$mail_client_constant]['X'][] = 1;

                        }else{

                            //
                            // SUCCESS CHECK ICONOGRAPHY
                            $tmp_icon_img = $this->oCRNRSTN_USR->return_creative('SUCCESS_CHECK', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED);
                            $this->results_count_aggregation_ARRAY[$mail_client_constant]['SUCCESS'][] = 1;

                        }

                    }

                    //
                    // META NOTE INCLUDE CHECK
                    if($this->oCRNRSTN_USR->serialized_is_bit_set($tmp_serialized_bit_nom, CRNRSTN_CSS_CLIENT_ASSOC_HAS_META)){

                        $tmp_meta_note = $this->css_pattern_meta_note_ARRAY[$tmp_serialized_bit_nom];

                    }else{

                        $tmp_meta_note = '';

                    }

                }

                $tmp_hit_count = $this->validation_results_ARRAY[$tmp_array[4]][$css_str_pattern];

                if($tmp_hit_count>1){

                    $tmp_hit_count = $tmp_hit_count.' matches.';

                }else{

                    $tmp_hit_count = $tmp_hit_count.' match.';

                }

                $tmp_str = $tmp_str . '<div style="border-top: 11px solid #FFF; ">
                                <table cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    
                                    <td style="width:19px; height:19px;"><div style="width:19px; height:19px; overflow:hidden; border-left: 24px solid #FFF; border-right: 15px solid #FFF; line-height:10px;">'.$tmp_icon_img.'</div></td>

                                    <td style="width:320px;">
                                        <div style=\'color: #6885C3;font-family:"Courier New", Courier, monospace; font-size: 13px; font-weight: normal; border-top: 1px solid #FFF;  \'><a href="'.$tmp_array[0].'" target="_blank" style=\'font-family:"Courier New", Courier, monospace; font-size: 17px; text-decoration:none; font-weight: normal; color: #6885C3; text-decoration:underline; \'>'.htmlentities($css_str_pattern).'</a></div>
                                    </td>
                                    </tr>
                                    <tr>
                                    <td></td>
                                    <td>
                                        <div style=\'color: #6885C3;font-family:"Courier New", Courier, monospace; font-size: 11px; font-weight: normal; border-top: 3px solid #FFF; \'>'.$this->format_output($tmp_meta_note).' '.$tmp_hit_count.'</div>
                                    </td>
                                    
                                </tr>                                        
                                </table>
                                                                                                                        
                                </div>';

                return $tmp_str;

                break;
            case 'VALIDATOR_LOGIC_CSS_HEADER':

                //
                // ACQUIRE CSS META
                // array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);
                $tmp_meta_array = $this->return_css_str_pattern_meta($css_str_pattern);
                $tmp_css_uri = $tmp_meta_array[0];
                $tmp_css_description = $tmp_meta_array[1];
                $tmp_deprecated_indicator = '';

                if( $tmp_meta_array[3] == CRNRSTN_CSS_VALIDATE_IS_DEPRECATED){

                    $tmp_deprecated_indicator = "<span style='color:#D24A45;'><strong>DEPRECATED.</strong></span>";

                }

                //
                // CLEAN DUPLICATE PREFIX WORK AROUND OUT OF NOMINATION STRING FOR OUTPUT
                $css_str_pattern_TITLE = $this->return_clean_css_pattern($css_str_pattern);

                if(strlen($tmp_css_uri)<2){

                    $tmp_css_uri = '#';

                }

                switch($output_format){
                    case 'HTML':

                        $tmp_str = '<div style=\'font-family:"Courier New", Courier, monospace; font-size: 17px; line-height:25px; font-weight: bold; text-align: left; border-top: 20px solid #FFF; border-bottom: 6px solid #FFF; color: #6885C3;\'><a href="'.$tmp_css_uri.'" target="_blank" style=\'font-family:"Courier New", Courier, monospace; font-size: 17px;text-decoration:none; color: #6885C3; text-decoration: underline; \'>'.htmlentities($css_str_pattern_TITLE).'</a></div>  
<div style=\'font-family:"Courier New", Courier, monospace; font-size: 13px; font-weight: normal; border-left: 0px solid #FFF;  border-right: 10px solid #FFF; border-bottom: 20px solid #FFF; color: #6885C3; line-height:16px; text-align:left;\'>' . $tmp_css_description . ' '.$tmp_deprecated_indicator.'</div>';

                        break;
                    default:
                        //
                        // TEXT VERSION EMAIL, GETS NOT THIS CONTENT.

                        break;
                }

                return $tmp_str;

                break;
            case 'VALIDATOR_LOGIC_DESKTOP_CLIENT_SUPPORT':

                //
                // ACQUIRE CSS META
                // array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);
                $tmp_meta_array = $this->return_css_str_pattern_meta($css_str_pattern);
                $tmp_css_species = $tmp_meta_array[4];

                $tmp_str = $tmp_str . '
                                            <div style=\'font-family:"Courier New", Courier, monospace; font-size: 15px; font-weight: bold;  border-bottom: 0px solid #FFF; \'>
                                                <table cellpadding="0" cellspacing="0" border="0" style="width:365px; background-color: #6886C3;">
                                                <tr>
                                                    <td style="width:320px;"><div style=\'width:300px; font-family:"Courier New", Courier, monospace; color:#FFF; font-weight: bold; font-size: 15px; background-color: #6886C3; border-left: 14px solid #6886C3; border-top: 8px solid #6886C3; border-bottom: 6px solid #6886C3;\'>DESKTOP :: Email Client Support</div></td>
                                                    <td style="width:20px; text-align:right;"><div style=\'font-family:"Courier New", Courier, monospace; color:#FFF; font-weight: normal; font-size: 12px; line-height: 17px; background-color: #6886C3; border-right: 14px solid #6886C3; border-top: 8px solid #6886C3; border-bottom: 6px solid #6886C3;\'><a href="#crnrstn_pg_top" target="_self" style=\'font-family:"Courier New", Courier, monospace; text-decoration:none; color: #FFF; text-decoration: underline; line-height: 17px;\'>top</a></div></td>
                                                </tr>                
                                                </table>
                                            </div>';

                $tmp_email_client_ARRAY = $this->desktop_mail_client_ARRAY;
                $tmp_email_client_CONST_ARRAY = $this->desktop_mail_CONST_ARRAY;

                break;
            case 'VALIDATOR_LOGIC_MOBILE_CLIENT_SUPPORT':

                //
                // ACQUIRE CSS META
                // array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);
                $tmp_meta_array = $this->return_css_str_pattern_meta($css_str_pattern);
                $tmp_css_species = $tmp_meta_array[4];

                $tmp_str = $tmp_str . '
                                            <div style=\'font-family:"Courier New", Courier, monospace; font-size: 15px; font-weight: bold;  border-top: 20px solid #FFF; \'>
                                                <table cellpadding="0" cellspacing="0" border="0" style="width:365px; background-color: #6886C3;">
                                                <tr>
                                                    <td style="width:320px;"><div style=\'width:300px; font-family:"Courier New", Courier, monospace; color:#FFF; font-weight: bold; font-size: 15px; background-color: #6886C3; border-left: 14px solid #6886C3; border-top: 8px solid #6886C3; border-bottom: 6px solid #6886C3;\'>MOBILE :: Email Client Support</div></td>
                                                    <td style="width:20px; text-align:right;"><div style=\'font-family:"Courier New", Courier, monospace; color:#FFF; font-weight: normal; font-size: 12px; line-height: 17px; background-color: #6886C3; border-right: 14px solid #6886C3; border-top: 8px solid #6886C3; border-bottom: 6px solid #6886C3;\'><a href="#crnrstn_pg_top" target="_self" style=\'font-family:"Courier New", Courier, monospace; text-decoration:none; color: #FFF; text-decoration: underline; line-height: 17px;\'>top</a></div></td>
                                                </tr>                
                                                </table>
                                            </div>';

                $tmp_email_client_ARRAY = $this->mobile_mail_client_ARRAY;
                $tmp_email_client_CONST_ARRAY = $this->mobile_mail_CONST_ARRAY;

                break;
            case 'VALIDATOR_LOGIC_WEB_CLIENT_SUPPORT':

                //
                // ACQUIRE CSS META
                // array($tmp_uri, $tmp_description, $css_pattern_nom, $tmp_validation_type, $tmp_pattern_species);
                $tmp_meta_array = $this->return_css_str_pattern_meta($css_str_pattern);
                $tmp_css_species = $tmp_meta_array[4];

                $tmp_str = $tmp_str . '
                                            <div style=\'font-family:"Courier New", Courier, monospace; font-size: 15px; font-weight: bold;  border-top: 20px solid #FFF; \'>
                                                <table cellpadding="0" cellspacing="0" border="0" style="width:365px; background-color: #6886C3;">
                                                <tr>
                                                    <td style="width:320px;"><div style=\'width:300px; font-family:"Courier New", Courier, monospace; color:#FFF; font-weight: bold; font-size: 15px; background-color: #6886C3; border-left: 14px solid #6886C3; border-top: 8px solid #6886C3; border-bottom: 6px solid #6886C3;\'>WEB :: Email Client Support</div></td>
                                                    <td style="width:20px; text-align:right;"><div style=\'font-family:"Courier New", Courier, monospace; color:#FFF; font-weight: normal; font-size: 12px; line-height: 17px; background-color: #6886C3; border-right: 14px solid #6886C3; border-top: 8px solid #6886C3; border-bottom: 6px solid #6886C3;\'><a href="#crnrstn_pg_top" target="_self" style=\'font-family:"Courier New", Courier, monospace; text-decoration:none; color: #FFF; text-decoration: underline; line-height: 17px;\'>top</a></div></td>
                                                </tr>                
                                                </table>
                                            </div>';


                $tmp_email_client_ARRAY = $this->web_mail_client_ARRAY;
                $tmp_email_client_CONST_ARRAY = $this->web_mail_CONST_ARRAY;

                break;
            default:

                //
                // SILENCE IS GOLDEN.

                break;

        }

        //
        // CONTENT BODY FOR VALIDATOR EMAIL CLIENT SUPPORT - SAME LOGIC FOR ALL CLIENT CHANNELS
        switch($content_type_key){
            case 'VALIDATOR_LOGIC_DESKTOP_CLIENT_SUPPORT':
            case 'VALIDATOR_LOGIC_MOBILE_CLIENT_SUPPORT':
            case 'VALIDATOR_LOGIC_WEB_CLIENT_SUPPORT':

                foreach($tmp_email_client_ARRAY as $key_client_d => $client_nomination) {

                    //
                    // ICONOGRAPHY CHECK - ALERT BANG - CRNRSTN_CSS_ICON_ALERT_BANG
                    if(in_array($css_str_pattern, $this->redundant_css_nom_ARRAY)){

                        $tmp_serialized_bit_nom = 'META_'.$tmp_css_species.'_'.$css_str_pattern.$tmp_email_client_CONST_ARRAY[$key_client_d];

                        if($this->oCRNRSTN_USR->serialized_is_bit_set($tmp_serialized_bit_nom, CRNRSTN_CSS_CLIENT_ASSOC_HAS_META)) {


                            if($this->oCRNRSTN_USR->serialized_is_bit_set($tmp_serialized_bit_nom, CRNRSTN_CSS_ICON_SUCCESS_CHECK)){  // HAS SUCCESS

                                //
                                // SUCCESS CHECK ICONOGRAPHY
                                $tmp_icon_img = $this->oCRNRSTN_USR->return_creative('SUCCESS_CHECK', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED);

                            }else{

                                //
                                // HAS ERR X
                                if($this->oCRNRSTN_USR->serialized_is_bit_set($tmp_serialized_bit_nom, CRNRSTN_CSS_ICON_ERR_X)){

                                    //
                                    // ERROR X ICONOGRAPHY
                                    $tmp_icon_img = $this->oCRNRSTN_USR->return_creative('ERR_X', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED);

                                }else{

                                    //
                                    // INFORMATION BANG ICONOGRAPHY
                                    $tmp_icon_img = $this->oCRNRSTN_USR->return_creative('NOTICE_TRI_ALERT', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED);

                                }

                            }

                        }else{

                            //
                            // CHECK FOR ERR_X
                            if($this->oCRNRSTN_USR->serialized_is_bit_set($tmp_serialized_bit_nom, CRNRSTN_CSS_ICON_ERR_X)){

                                //
                                // ERROR X ICONOGRAPHY
                                $tmp_icon_img = $this->oCRNRSTN_USR->return_creative('ERR_X', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED);

                            }else{

                                //
                                // SUCCESS CHECK ICONOGRAPHY
                                $tmp_icon_img = $this->oCRNRSTN_USR->return_creative('SUCCESS_CHECK', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED);

                            }

                        }

                        //
                        // META NOTE INCLUDE CHECK
                        if($this->oCRNRSTN_USR->serialized_is_bit_set($tmp_serialized_bit_nom, CRNRSTN_CSS_CLIENT_ASSOC_HAS_META)){

                            $tmp_meta_note = $this->css_pattern_meta_note_ARRAY[$tmp_serialized_bit_nom];

                        }else{

                            $tmp_meta_note = '';

                        }

                    }else{

                        $tmp_serialized_bit_nom = 'META_'.$css_str_pattern.$tmp_email_client_CONST_ARRAY[$key_client_d];

                        if($this->oCRNRSTN_USR->serialized_is_bit_set($tmp_serialized_bit_nom, CRNRSTN_CSS_CLIENT_ASSOC_HAS_META)) {

                            if($this->oCRNRSTN_USR->serialized_is_bit_set($tmp_serialized_bit_nom, CRNRSTN_CSS_ICON_SUCCESS_CHECK)){

                                //
                                // SUCCESS CHECK ICONOGRAPHY
                                $tmp_icon_img = $this->oCRNRSTN_USR->return_creative('SUCCESS_CHECK', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED);

                            }else{

                                if($this->oCRNRSTN_USR->serialized_is_bit_set($tmp_serialized_bit_nom, CRNRSTN_CSS_ICON_ERR_X)){

                                    //
                                    // ERROR X ICONOGRAPHY
                                    $tmp_icon_img = $this->oCRNRSTN_USR->return_creative('ERR_X', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED);

                                }else{

                                    //
                                    // INFORMATION BANG ICONOGRAPHY
                                    $tmp_icon_img = $this->oCRNRSTN_USR->return_creative('NOTICE_TRI_ALERT', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED);

                                }

                            }

                        }else{

                            //
                            // CHECK FOR ERR_X
                            if($this->oCRNRSTN_USR->serialized_is_bit_set($tmp_serialized_bit_nom, CRNRSTN_CSS_ICON_ERR_X)){

                                //
                                // ERROR X ICONOGRAPHY
                                $tmp_icon_img = $this->oCRNRSTN_USR->return_creative('ERR_X', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED);

                            }else{

                                //
                                // SUCCESS CHECK ICONOGRAPHY
                                $tmp_icon_img = $this->oCRNRSTN_USR->return_creative('SUCCESS_CHECK', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED);

                            }

                        }

                        //
                        // META NOTE INCLUDE CHECK
                        if($this->oCRNRSTN_USR->serialized_is_bit_set($tmp_serialized_bit_nom, CRNRSTN_CSS_CLIENT_ASSOC_HAS_META)){

                            $tmp_meta_note = $this->css_pattern_meta_note_ARRAY[$tmp_serialized_bit_nom];

                        }else{

                            $tmp_meta_note = '';

                        }

                    }

                    $tmp_str = $tmp_str . '<div style="border-top: 8px solid #FFF; ">
                                            <table cellspacing="0" cellpadding="0" border="0">
                                            <tr>
                                                <td style="width:19px; height:19px;"><div style="width:19px; height:19px; overflow:hidden; border-left: 24px solid #FFF; border-right: 15px solid #FFF; line-height:10px;">'.$tmp_icon_img.'</div></td>
            
                                                <td style="width:320px;">
                                                    <div style=\'color: #6885C3;font-family:"Courier New", Courier, monospace; font-size: 14px; font-weight: normal; border-top: 1px solid #FFF;  \'>'.htmlentities($client_nomination).'</div>
                                                </td>
                                                </tr>
                                                <tr>
                                                <td></td>
                                                <td>
                                                    <div style=\'color: #6885C3; font-family:"Courier New", Courier, monospace; font-size: 11px; font-weight: normal; border-top: 1px solid #FFF; \'>'.$this->format_output($tmp_meta_note).'</div>
                                                </td>                                                
                                            </tr>                                                                                           
                                            </table>                                                                                                                                        
                                        </div>';

                }

                break;
            default:
                //
                // DO NOTHING

                break;

        }

        return $tmp_str;

    }

    public function return_validation_results(){

        $tmp_output_ARRAY = array();
        $tmp_output_ARRAY['HTML'] = '';
        $tmp_output_ARRAY['TEXT'] = '';

        //
        // VALIDATE SUBMITTED DATA
        $this->validate_ugc_datum();

        switch($this->output_mode){
            case 'ARRAY':
                //
                // FOR STORAGE OF DATA IN DATABASE

            break;
            case 'PAGE_URI':
                //
                // A LINK TO THE VALIDATOR RESULTS PAGE. USE AS 'VIEW ONLINE' LINK IN SHARE/FTAF EMAIL.


            break;
            case 'HTML_EMAIL':

            break;
            default:

                //
                // CALL BEFORE HIGHER LEVEL ACTIONS TO GET LOW LEVEL AGGREGATE DATA
                $tmp_str_C = $this->return_validation_results_error_notes();

                $tmp_str_B = $this->return_validation_results_client_performance();

                //
                // CSS HEADER AND DESCRIPTION
                $tmp_str_A = $this->return_validation_results_header();

                $tmp_output_ARRAY['HTML'] = $tmp_str_A.$tmp_str_B.$tmp_str_C;

                unset($tmp_str_A);
                unset($tmp_str_B);
                unset($tmp_str_C);

                $tmp_output_ARRAY['HTML'] = $tmp_output_ARRAY['HTML'] . '<div style=\'font-family:"Courier New", Courier, monospace; font-size: 15px; font-weight: bold;  border-bottom: 0px solid #FFF; \'>
                                                <table cellpadding="0" cellspacing="0" border="0" style="width:365px;">
                                                <tr>
                                                    <td style="width:320px;"></td>
                                                    <td style="width:20px; text-align:right;"><div style=\'font-family:"Courier New", Courier, monospace; color:#FFF; font-weight: normal; font-size: 12px; line-height: 17px; border-right: 14px solid #FFF; border-top: 8px solid #FFF; border-bottom: 6px solid #FFF; color:#6886C3;\'><a href="#crnrstn_pg_top" target="_self" style=\'font-family:"Courier New", Courier, monospace; text-decoration:none; color:#6886C3; text-decoration: underline; line-height: 17px;\'>top</a></div></td>
                                                </tr>                
                                                </table>
                                            </div>';


                //
                // HTML_PAGE
                $tmp_html_out = $this->return_validation_results_HTML($tmp_output_ARRAY['HTML'], 50);

                array_splice($tmp_output_ARRAY, 0);

                $this->output_string_ARRAY['HTML_OUT'] = $tmp_html_out;

                return $this->output_string_ARRAY;

            break;

        }

    }

    private function return_validation_results_header($output_format = 'HTML'){

        $tmp_str = '';
        $tmp_array = array();
        $tmp_array[] = 'crnrstn_l=' . $this->oCRNRSTN_USR->data_encrypt('css_validator');
        $tmp_array[] = 'crnrstn_mit=true';

        $tmp_http_root = $this->oCRNRSTN_USR->append_url_param($tmp_array);

        $tmp_ = explode('.',$this->oCRNRSTN_USR->starttime);
        $try_harder = $tmp_[1];

        switch($output_format){
            case 'HTML':

                $tmp_walltime = $this->oCRNRSTN_USR->wall_time();
                $packet_size = $this->oCRNRSTN_USR->format_bytes(strlen($this->raw_data));
                $this->output_string_ARRAY['WALLTIME'] = $tmp_walltime;
                $this->output_string_ARRAY['PACKET_BYTES_SIZE'] = $packet_size;

                $tmp_str .= '
                                    <table cellspacing="0" cellpadding="0" border="0">
                                    <tr>
                                        <td style="vertical-align: top; text-align: left;">
                                            <div style="text-align: left; width: 390px; background-color: #FFF;">
                                                <div style="width:385px; border:2px solid #FFF; margin:0; color: #6885C3;">
                                                    
                                                    <div style=\'font-family:"Courier New", Courier, monospace; font-size: 19px; line-height:25px; font-weight: bold; border-right: 0px solid #FFF; border-bottom: 5px solid #FFF; color: #6885C3; \'>Email Client CSS<br> Compatibility Report</div>

                                                    <div style="text-align: left; border: 1px solid #A5B9D8; width: 382px; background-color: #FFF;">
                                                        <table cellspacing="0" cellpadding="0" border="0">
                                                        <tr>
                                                            <td style="vertical-align: top; width:240px;">
                                                                <div style=\'font-family:"Courier New", Courier, monospace; font-size: 11px; font-weight: normal; border-left: 10px solid #FFF; border-top: 10px solid #FFF; border-bottom: 5px solid #FFF; color: #6885C3;\'>Operation Runtime: '.$tmp_walltime.' secs</div>
                                                                <div style=\'font-family:"Courier New", Courier, monospace; font-size: 11px; font-weight: normal; border-left: 10px solid #FFF; border-bottom: 5px solid #FFF; color: #6885C3;\'>Total Packet Size: '.$packet_size.'</div>
                                                                <div style=\'font-family:"Courier New", Courier, monospace; font-size: 11px; font-weight: normal; border-left: 10px solid #FFF; border-bottom: 5px solid #FFF; color: #6885C3;\'>IP: '.$this->oCRNRSTN_USR->return_client_ip().'</div>
                                                                <div style=\'font-family:"Courier New", Courier, monospace; font-size: 11px; font-weight: normal; border-left: 10px solid #FFF; border-bottom: 5px solid #FFF; \'>Timestamp: '.date('G:i:s').'.'.$try_harder.' '.date('T').'</div>
                                                                <div style=\'font-family:"Courier New", Courier, monospace; font-size: 11px; font-weight: normal; border-left: 10px solid #FFF; border-bottom: 5px solid #FFF; color: #6885C3;\'>Date: '.date('D, F j, Y').'</div>
                                                                <div style=\'font-family:"Courier New", Courier, monospace; font-size: 11px; font-weight: normal; border-left: 10px solid #FFF; border-bottom: 0px solid #FFF; color: #6885C3;\'>Raw Score: '.$this->return_validation_score('NUMERIC_RAW').'</div>
            
                                                            </td>
                                                            <td style="vertical-align: top;">
                                                            
                                                                <div style=" border-top: 10px solid #FFF;">
                                                                    <table cellspacing="0" cellpadding="0" border="0" style="border-left:35px solid #FFF; border-top:0px solid #FFF; ">
                                                                    <tr>
                                                                        <td>
                                                                            <div style=\'background-color:#A5B9D8; border-top:0px solid #A5B9D8; border-right:10px solid #A5B9D8; border-bottom:0px solid #A5B9D8; border-left:10px solid #A5B9D8; font-family:Arial, Helvetica, sans-serif;\'>'.$this->return_validation_score('ALPHA').'</div>
                                                                        </td>
                                                                    </tr>
                                                                    </table>
                                                                </div>
                                                                
                                                                <table cellspacing="0" cellpadding="0" border="0" style="border-top:5px solid #FFF;  border-left:10px solid #FFF; text-align: right; width:135px;">
                                                                <tr>
                                                                    <td>
                                                                        <div style=\'font-family:"Courier New", Courier, monospace; font-size: 30px; color: #6885C3; \'>'.$this->return_validation_score('NUMERIC').'/100</div>                                        
                                                                    </td>
                                                                </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <div style=\'width:380px; border-right: 0px solid #FFF; border-top: 10px solid #FFF; border-bottom: 10px solid #FFF; \'>
                                                                
                                                                <table cellpadding="0" cellspacing="0" border="0" style="width:380px;">
                                                                <tr>
                                                                    <td>
                                                                        <table cellspacing="0" cellpadding="0" border="0" style="width:76px;">
                                                                        <tr>
                                                                            <td style="width:76px; text-align: left; border-left:10px solid #FFF;"><div style=\'width:76px; font-family:"Courier New", Courier, monospace; font-size: 15px; font-weight: normal; border-bottom: 4px solid #FFF; color: #6885C3;\'>Desktop</div></td>
                                                                            <td style="width:239px; border-right: 20px solid #FFF;">
                                                                                <table cellspacing="0" cellpadding="0" border="0" style="width:239px;">
                                                                                <tr>
                                                                                    <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_DESKTOP', 1).'</div></td>
                                                                                    <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_DESKTOP', 2).'</div></td>
                                                                                    <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_DESKTOP', 3).'</div></td>
                                                                                    <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_DESKTOP', 4).'</div></td>
                                                                                    <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_DESKTOP', 5).'</div></td>
                                                                                    <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_DESKTOP', 6).'</div></td>
                                                                                    <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_DESKTOP', 7).'</div></td>
                                                                                    <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_DESKTOP', 8).'</div></td>
                                                                                    <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_DESKTOP', 9).'</div></td>
                                                                                    <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 0px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_DESKTOP', 10).'</div></td>
                            
                                                                                </tr>
                                                                                                                                    
                                                                                </table>
                                                                            </td>
                                                                            <td style="width:50px; text-align:right;"><div style="border-top: 4px solid #FFF;"><a href="#desktop_channel_details" target="_self">'.$this->oCRNRSTN_USR->return_creative('SEARCH_MAGNIFY_GLASS', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED).'</a></div></td>
                                                                        </tr>
                                                                                                                        
                                                                        </table>
                                                                                                                    
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <table cellspacing="0" cellpadding="0" border="0" style="border-top:3px solid #FFF; width:76px;">
                                                                        <tr>
                                                                            <td style="width:76px; text-align: left; border-left:10px solid #FFF;"><div style=\'width:76px; font-family:"Courier New", Courier, monospace; font-size: 15px; font-weight: normal; border-bottom: 4px solid #FFF; color: #6885C3; \'>Mobile</div></td>
                                                                            <td style="width:239px; border-right: 20px solid #FFF;">
                                                                                <table cellspacing="0" cellpadding="0" border="0" style="width:239px; ">
                                                                                <tr>
                                                                                    <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_MOBILE', 1).'</div></td>
                                                                                    <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_MOBILE', 2).'</div></td>
                                                                                    <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_MOBILE', 3).'</div></td>
                                                                                    <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_MOBILE', 4).'</div></td>
                                                                                    <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_MOBILE', 5).'</div></td>
                                                                                    <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_MOBILE', 6).'</div></td>
                                                                                    <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_MOBILE', 7).'</div></td>
                                                                                    <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_MOBILE', 8).'</div></td>
                                                                                    <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_MOBILE', 9).'</div></td>
                                                                                    <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 0px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_MOBILE', 10).'</div></td>
                            
                                                                                </tr>
                                                                                                                                    
                                                                                </table>
                                                                            </td>
                                                                            <td style="width:50px; text-align:right;"><div style="border-top: 4px solid #FFF;"><a href="#mobile_channel_details" target="_self">'.$this->oCRNRSTN_USR->return_creative('SEARCH_MAGNIFY_GLASS', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED).'</a></div></td>
                            
                                                                        </tr>
                                                                                                                        
                                                                        </table>
                                                                    
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <table cellspacing="0" cellpadding="0" border="0" style="border-top:3px solid #FFF; width:76px;">
                                                                        <tr>
                                                                        <td style="width:76px; text-align: left; border-left:10px solid #FFF;"><div style=\'width:76px; font-family:"Courier New", Courier, monospace; font-size: 15px; font-weight: normal; color: #6885C3; \'>Web</div></td>
                                                                        <td style="width:239px; border-right: 20px solid #FFF;">
                                                                                <table cellspacing="0" cellpadding="0" border="0" style="width:239px;">
                                                                                <tr>
                                                                                    <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_WEB', 1).'</div></td>
                                                                                    <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_WEB', 2).'</div></td>
                                                                                    <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_WEB', 3).'</div></td>
                                                                                    <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_WEB', 4).'</div></td>
                                                                                    <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_WEB', 5).'</div></td>
                                                                                    <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_WEB', 6).'</div></td>
                                                                                    <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_WEB', 7).'</div></td>
                                                                                    <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_WEB', 8).'</div></td>
                                                                                    <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_WEB', 9).'</div></td>
                                                                                    <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 0px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_WEB', 10).'</div></td>
                                                                                </tr>
                                                                                                                                    
                                                                                </table>
                                                                            </td>
                                                                            <td style="width:50px; text-align:right;"><div style="border-top: 4px solid #FFF;"><a href="#web_channel_details" target="_self">'.$this->oCRNRSTN_USR->return_creative('SEARCH_MAGNIFY_GLASS', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED).'</a></div></td>
                                                                            
                                                                        </tr>
                                                                                                                        
                                                                        </table>
                                                                    
                                                                    </td>
                                                                </tr>
                                                                
                                                                </table>
                                                               
                                                                </div>                                                                          
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <div style=\'font-family:"Courier New", Courier, monospace; font-size: 17px; font-weight: bold; border-left: 10px solid #FFF;  border-top: 10px solid #FFF; border-bottom: 6px solid #FFF; color: #6885C3;\'>Validator Status ::</div>
                                                                <div style=\'font-family:"Courier New", Courier, monospace; font-size: 13px; font-weight: normal; border-left: 10px solid #FFF; border-right: 10px solid #FFF; border-right: 10px solid #FFF; border-bottom: 10px solid #FFF; color: #6885C3; line-height:17px; \'><span style=\'font-family:"Courier New", Courier, monospace; font-size: 14px; font-weight: bold;\'>April 20, 2021 2055hrs.</span> Please scroll down for the CSS validation report details. This tool is currently under active development. 
                                                                We just finished clearing many bugs in the <a href="./?crnrstn_l=' . urlencode($this->oCRNRSTN_USR->data_encrypt('css_validator')) . '&crnrstn_css_valptrn='.$this->oCRNRSTN_USR->generate_new_key(8, '01').'" style="color:#0066CC;">underlying rules</a> supporting the validation algorithm and also within exception handling. For now, there are still other 
                                                                bugs and incomplete core elements, so this tool remains in PRE-ALPHA. Once testing is complete, this brief status report will be updated to an 
                                                                overview of the tool. <br><br>It would be nice to have share via 
                                                                email/FTAF for this report. This project is <a href="' . $tmp_http_root . '" target="_blank">MIT Licensed</a>, and it has been pushed to <a href="'.$this->oCRNRSTN_USR->return_sticky_link('https://github.com/jony5/CSS-Validator-for-HTML-Email-v2.00.0000').'" target="_blank">GitHub</a>.</div>
                                                                
                                                            </td>
                                                        </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>          
                                            
                                        </td>
                                            
                            </tr>
                            
                            </table>';

            break;
            default:

                //
                // TEXT VERSION EMAIL, GETS NOT THIS CONTENT.
                $tmp_str = 'Email Client CSS  Compatibility Report';

            break;

        }

        return $tmp_str;

    }

    private function return_validation_results_client_performance($output_format = 'HTML'){

        $tmp_str = '';

        $this->total_css_performance_summaries();

        switch($output_format){
            case 'HTML':

                $tmp_str = '<div id="desktop_channel_details" style="width:0px; height:0px; overflow:hidden;"></div><div style=\'font-family:"Courier New", Courier, monospace; font-size: 17px; line-height:25px; font-weight: bold; border-top: 30px solid #FFF; border-bottom: 6px solid #FFF; color: #6885C3;\'>
                                Email Client Support for CSS
                                </div>';

            break;
            default:
                //
                // TEXT VERSION EMAIL, GETS NOT THIS CONTENT.
                $tmp_str = 'Message Validation Reporting for 
                        Email Client Support of CSS';

            break;

        }

        //
        // DESKTOP
        $tmp_str = $tmp_str . '<div style=\'font-family:"Courier New", Courier, monospace; font-size: 15px; font-weight: bold;  border-bottom: 6px solid #FFF; \'>
                                    <table cellpadding="0" cellspacing="0" border="0" style="width:365px; background-color: #6886C3;">
                                    <tr>
                                        <td style="width:320px;"><div style=\'width:300px; font-family:"Courier New", Courier, monospace; color:#FFF; font-weight: bold; font-size: 15px; background-color: #6886C3; border-left: 14px solid #6886C3; border-top: 8px solid #6886C3; border-bottom: 6px solid #6886C3;\'>DESKTOP :: Email Client Support</div></td>
                                        <td style="width:20px; text-align:right;"><div style=\'font-family:"Courier New", Courier, monospace; color:#FFF; font-weight: normal; font-size: 12px; line-height: 17px; background-color: #6886C3; border-right: 14px solid #6886C3; border-top: 8px solid #6886C3; border-bottom: 6px solid #6886C3;\'><a href="#crnrstn_pg_top" target="_self" style=\'font-family:"Courier New", Courier, monospace; text-decoration:none; color: #FFF; text-decoration: underline; line-height: 17px;\'>top</a></div></td>
                                    </tr>                
                                    </table>
                                </div>';

        foreach($this->desktop_mail_client_ARRAY as $key => $client_nom){

            $tmp_bang_cnt = count($this->results_count_aggregation_ARRAY[$this->desktop_mail_CONST_ARRAY[$key]]['BANG']) - 1;
            $tmp_x_cnt = count($this->results_count_aggregation_ARRAY[$this->desktop_mail_CONST_ARRAY[$key]]['X']) - 1;
            $tmp_success_cnt = count($this->results_count_aggregation_ARRAY[$this->desktop_mail_CONST_ARRAY[$key]]['SUCCESS']) - 1;

            $tmp_str = $tmp_str . '<div style=\'border-bottom: 5px solid #FFF; border-left: 14px solid #FFF; border-top: 15px solid #FFF; \'>
                                            <a href="#'.$this->format_output($client_nom,'CLIENT_NOM').'" style=\'color: #6885C3;font-family:"Courier New", Courier, monospace; font-size: 17px; font-weight: normal; \'>'.$client_nom.'</a>                                 
                                            </div>
                                            <div>
                                            <table cellspacing="0" cellpadding="0" border="0" style="width:239px; height:20px; overflow:hidden; padding:0; margin:0;">
                                            <tr style="padding:0; margin:0; height: 20px;">
                                                <td><div style="width: 20px; height: 20px; overflow:hidden; border-left: 9px solid #FFF; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_CLIENT', 1, $this->desktop_mail_CONST_ARRAY[$key]).'</div></td>
                                                <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_CLIENT', 2, $this->desktop_mail_CONST_ARRAY[$key]).'</div></td>
                                                <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_CLIENT', 3, $this->desktop_mail_CONST_ARRAY[$key]).'</div></td>
                                                <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_CLIENT', 4, $this->desktop_mail_CONST_ARRAY[$key]).'</div></td>
                                                <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_CLIENT', 5, $this->desktop_mail_CONST_ARRAY[$key]).'</div></td>
                                                <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_CLIENT', 6, $this->desktop_mail_CONST_ARRAY[$key]).'</div></td>
                                                <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_CLIENT', 7, $this->desktop_mail_CONST_ARRAY[$key]).'</div></td>
                                                <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_CLIENT', 8, $this->desktop_mail_CONST_ARRAY[$key]).'</div></td>
                                                <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_CLIENT', 9, $this->desktop_mail_CONST_ARRAY[$key]).'</div></td>
                                                <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_CLIENT', 10, $this->desktop_mail_CONST_ARRAY[$key]).'</div></td>
                                            </tr>               
                                            <tr style="padding:0; margin:0; height: 23px;">
                                                <td colspan="10">
                                                    <table cellpadding="0" cellspacing="0" border="0" style="padding:0; margin:0;">
                                                    <tr>
                                                        <td><div style="width: 19px; height:19px; overflow:hidden; border-left: 14px solid #FFF; border-right: 4px solid #FFF; border-top: 3px solid #FFF; line-height:10px;">'.$this->oCRNRSTN_USR->return_creative('NOTICE_TRI_ALERT', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED).'</div></td>
                                                        <td style="width:35px; height: 19px;"><a href="#'.$this->format_output($client_nom,'CLIENT_NOM').'" style=\'height: 23px; color: #6885C3; font-family:"Courier New", Courier, monospace; font-size: 15px; font-weight: normal; line-height:10px; margin:0; padding:0; \'>'.$tmp_bang_cnt.'</a></td>
                                                    
                                                        <td><div style="width: 19px; height: 19px; overflow:hidden; border-left:8px solid #FFF; border-right: 4px solid #FFF; border-top: 3px solid #FFF; line-height:10px;">'.$this->oCRNRSTN_USR->return_creative('ERR_X', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED).'</div></td>
                                                        <td style="width:35px;height: 19px; "><a href="#'.$this->format_output($client_nom,'CLIENT_NOM').'" style=\'height: 23px; color: #6885C3; font-family:"Courier New", Courier, monospace; font-size: 15px; font-weight: normal; line-height:10px; margin:0; padding:0; \'>'.$tmp_x_cnt.'</a></td>
                                                    
                                                        <td><div style="width: 19px; height: 19px; overflow:hidden; border-left: 8px solid #FFF; border-right: 4px solid #FFF; border-top: 3px solid #FFF; line-height:10px;">'.$this->oCRNRSTN_USR->return_creative('SUCCESS_CHECK', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED).'</div></td>
                                                        <td style="height: 19px;"><a href="#'.$this->format_output($client_nom,'CLIENT_NOM').'" style=\'height: 23px; color: #6885C3; font-family:"Courier New", Courier, monospace; font-size: 15px; font-weight: normal; line-height:10px; margin:0; padding:0; \'>'.$tmp_success_cnt.'</a></td>
                                                   
                                                    </tr>                       
                                                    </table>                         
                                                </td>                              
                                            </tr>                              
                                            </table>
                                            </div>';


        }

        //
        // MOBILE
        $tmp_str = $tmp_str . '<div id="mobile_channel_details" style="width:0px; height:0px; overflow:hidden;"></div><div style=\'font-family:"Courier New", Courier, monospace; font-size: 15px; font-weight: bold;  border-bottom: 6px solid #FFF; border-top: 20px solid #FFF; \'>
                                    <table cellpadding="0" cellspacing="0" border="0" style="width:365px; background-color: #6886C3;">
                                    <tr>
                                        <td style="width:320px;"><div style=\'width:300px; font-family:"Courier New", Courier, monospace; color:#FFF; font-weight: bold; font-size: 15px; background-color: #6886C3; border-left: 14px solid #6886C3; border-top: 8px solid #6886C3; border-bottom: 6px solid #6886C3;\'>MOBILE :: Email Client Support</div></td>
                                        <td style="width:20px; text-align:right;"><div style=\'font-family:"Courier New", Courier, monospace; color:#FFF; font-weight: normal; font-size: 12px; line-height: 17px; background-color: #6886C3; border-right: 14px solid #6886C3; border-top: 8px solid #6886C3; border-bottom: 6px solid #6886C3;\'><a href="#crnrstn_pg_top" target="_self" style=\'font-family:"Courier New", Courier, monospace; text-decoration:none; color: #FFF; text-decoration: underline; line-height: 17px;\'>top</a></div></td>
                                    </tr>                
                                    </table>
                                </div>';

        foreach($this->mobile_mail_client_ARRAY as $key => $client_nom){

            $tmp_bang_cnt = count($this->results_count_aggregation_ARRAY[$this->mobile_mail_CONST_ARRAY[$key]]['BANG']) - 1;
            $tmp_x_cnt = count($this->results_count_aggregation_ARRAY[$this->mobile_mail_CONST_ARRAY[$key]]['X']) - 1;
            $tmp_success_cnt = count($this->results_count_aggregation_ARRAY[$this->mobile_mail_CONST_ARRAY[$key]]['SUCCESS']) - 1;

            $tmp_str = $tmp_str . '<div style=\'border-bottom: 5px solid #FFF; border-left: 14px solid #FFF; border-top: 15px solid #FFF; \'>
                                            <a href="#'.$this->format_output($client_nom,'CLIENT_NOM').'" style=\'color: #6885C3;font-family:"Courier New", Courier, monospace; font-size: 17px; font-weight: normal; \'>'.$client_nom.'</a>                                 
                                            </div>
                                            <div>
                                            <table cellspacing="0" cellpadding="0" border="0" style="width:239px; height:20px; overflow:hidden; padding:0; margin:0;">
                                            <tr style="padding:0; margin:0; height: 20px;">
                                                <td><div style="width: 20px; height: 20px; overflow:hidden; border-left: 9px solid #FFF; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_CLIENT', 1, $this->mobile_mail_CONST_ARRAY[$key]).'</div></td>
                                                <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_CLIENT', 2, $this->mobile_mail_CONST_ARRAY[$key]).'</div></td>
                                                <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_CLIENT', 3, $this->mobile_mail_CONST_ARRAY[$key]).'</div></td>
                                                <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_CLIENT', 4, $this->mobile_mail_CONST_ARRAY[$key]).'</div></td>
                                                <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_CLIENT', 5, $this->mobile_mail_CONST_ARRAY[$key]).'</div></td>
                                                <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_CLIENT', 6, $this->mobile_mail_CONST_ARRAY[$key]).'</div></td>
                                                <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_CLIENT', 7, $this->mobile_mail_CONST_ARRAY[$key]).'</div></td>
                                                <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_CLIENT', 8, $this->mobile_mail_CONST_ARRAY[$key]).'</div></td>
                                                <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_CLIENT', 9, $this->mobile_mail_CONST_ARRAY[$key]).'</div></td>
                                                <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_CLIENT', 10, $this->mobile_mail_CONST_ARRAY[$key]).'</div></td>
                                            </tr>               
                                            <tr style="padding:0; margin:0; height: 23px;">
                                                <td colspan="10">
                                                    <table cellpadding="0" cellspacing="0" border="0" style="padding:0; margin:0;">
                                                    <tr>
                                                        <td><div style="width: 19px; height:19px; overflow:hidden; border-left: 14px solid #FFF; border-right: 4px solid #FFF; border-top: 3px solid #FFF; line-height:10px;">'.$this->oCRNRSTN_USR->return_creative('NOTICE_TRI_ALERT', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED).'</div></td>
                                                        <td style="width:35px; height: 19px;"><a href="#'.$this->format_output($client_nom,'CLIENT_NOM').'" style=\'height: 23px; color: #6885C3; font-family:"Courier New", Courier, monospace; font-size: 15px; font-weight: normal; line-height:10px; margin:0; padding:0; \'>'.$tmp_bang_cnt.'</a></td>
                                                    
                                                        <td><div style="width: 19px; height: 19px; overflow:hidden; border-left:8px solid #FFF; border-right: 4px solid #FFF; border-top: 3px solid #FFF; line-height:10px;">'.$this->oCRNRSTN_USR->return_creative('ERR_X', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED).'</div></td>
                                                        <td style="width:35px;height: 19px; "><a href="#'.$this->format_output($client_nom,'CLIENT_NOM').'" style=\'height: 23px; color: #6885C3; font-family:"Courier New", Courier, monospace; font-size: 15px; font-weight: normal; line-height:10px; margin:0; padding:0; \'>'.$tmp_x_cnt.'</a></td>
                                                    
                                                        <td><div style="width: 19px; height: 19px; overflow:hidden; border-left: 8px solid #FFF; border-right: 4px solid #FFF; border-top: 3px solid #FFF; line-height:10px;">'.$this->oCRNRSTN_USR->return_creative('SUCCESS_CHECK', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED).'</div></td>
                                                        <td style="height: 19px;"><a href="#'.$this->format_output($client_nom,'CLIENT_NOM').'" style=\'height: 23px; color: #6885C3; font-family:"Courier New", Courier, monospace; font-size: 15px; font-weight: normal; line-height:10px; margin:0; padding:0; \'>'.$tmp_success_cnt.'</a></td>
                                                   
                                                    </tr>                       
                                                    </table>                         
                                                </td>                              
                                            </tr>                              
                                            </table>
                                            </div>';
        }

        //
        // WEB
        $tmp_str = $tmp_str . '<div id="web_channel_details" style="width:0px; height:0px; overflow:hidden;"></div><div style=\'font-family:"Courier New", Courier, monospace; font-size: 15px; font-weight: bold;  border-bottom: 6px solid #FFF; border-top: 20px solid #FFF; \'>
                                    <table cellpadding="0" cellspacing="0" border="0" style="width:365px; background-color: #6886C3;">
                                    <tr>
                                        <td style="width:320px;"><div style=\'width:300px; font-family:"Courier New", Courier, monospace; color:#FFF; font-weight: bold; font-size: 15px; background-color: #6886C3; border-left: 14px solid #6886C3; border-top: 8px solid #6886C3; border-bottom: 6px solid #6886C3;\'>WEB :: Email Client Support</div></td>
                                        <td style="width:20px; text-align:right;"><div style=\'font-family:"Courier New", Courier, monospace; color:#FFF; font-weight: normal; font-size: 12px; line-height: 17px; background-color: #6886C3; border-right: 14px solid #6886C3; border-top: 8px solid #6886C3; border-bottom: 6px solid #6886C3;\'><a href="#crnrstn_pg_top" target="_self" style=\'font-family:"Courier New", Courier, monospace; text-decoration:none; color: #FFF; text-decoration: underline; line-height: 17px;\'>top</a></div></td>
                                    </tr>                
                                    </table>
                                </div>';

        foreach($this->web_mail_client_ARRAY as $key => $client_nom){

            $tmp_bang_cnt = count($this->results_count_aggregation_ARRAY[$this->web_mail_CONST_ARRAY[$key]]['BANG']) - 1;
            $tmp_x_cnt = count($this->results_count_aggregation_ARRAY[$this->web_mail_CONST_ARRAY[$key]]['X']) - 1;
            $tmp_success_cnt = count($this->results_count_aggregation_ARRAY[$this->web_mail_CONST_ARRAY[$key]]['SUCCESS']) - 1;

            $tmp_str = $tmp_str . '<div style=\'border-bottom: 5px solid #FFF; border-left: 14px solid #FFF; border-top: 15px solid #FFF; \'>
                                            <a href="#'.$this->format_output($client_nom,'CLIENT_NOM').'" style=\'color: #6885C3;font-family:"Courier New", Courier, monospace; font-size: 17px; font-weight: normal; \'>'.$client_nom.'</a>                                 
                                            </div>
                                            <div>
                                            <table cellspacing="0" cellpadding="0" border="0" style="width:239px; height:20px; overflow:hidden; padding:0; margin:0;">
                                            <tr style="padding:0; margin:0; height: 20px;">
                                                <td><div style="width: 20px; height: 20px; overflow:hidden; border-left: 9px solid #FFF; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_CLIENT', 1, $this->web_mail_CONST_ARRAY[$key]).'</div></td>
                                                <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_CLIENT', 2, $this->web_mail_CONST_ARRAY[$key]).'</div></td>
                                                <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_CLIENT', 3, $this->web_mail_CONST_ARRAY[$key]).'</div></td>
                                                <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_CLIENT', 4, $this->web_mail_CONST_ARRAY[$key]).'</div></td>
                                                <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_CLIENT', 5, $this->web_mail_CONST_ARRAY[$key]).'</div></td>
                                                <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_CLIENT', 6, $this->web_mail_CONST_ARRAY[$key]).'</div></td>
                                                <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_CLIENT', 7, $this->web_mail_CONST_ARRAY[$key]).'</div></td>
                                                <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_CLIENT', 8, $this->web_mail_CONST_ARRAY[$key]).'</div></td>
                                                <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_CLIENT', 9, $this->web_mail_CONST_ARRAY[$key]).'</div></td>
                                                <td><div style="width: 20px; height: 20px; overflow:hidden; border-right: 1px solid #FFF;">'.$this->return_validation_score('GRAPHIC_DOT_CHANNEL_CLIENT', 10, $this->web_mail_CONST_ARRAY[$key]).'</div></td>
                                            </tr>               
                                            <tr style="padding:0; margin:0; height: 23px;">
                                                <td colspan="10">
                                                    <table cellpadding="0" cellspacing="0" border="0" style="padding:0; margin:0;">
                                                    <tr>
                                                        <td><div style="width: 19px; height:19px; overflow:hidden; border-left: 14px solid #FFF; border-right: 4px solid #FFF; border-top: 3px solid #FFF; line-height:10px;">'.$this->oCRNRSTN_USR->return_creative('NOTICE_TRI_ALERT', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED).'</div></td>
                                                        <td style="width:35px; height: 19px;"><a href="#'.$this->format_output($client_nom,'CLIENT_NOM').'" style=\'height: 23px; color: #6885C3; font-family:"Courier New", Courier, monospace; font-size: 15px; font-weight: normal; line-height:10px; margin:0; padding:0; \'>'.$tmp_bang_cnt.'</a></td>
                                                    
                                                        <td><div style="width: 19px; height: 19px; overflow:hidden; border-left:8px solid #FFF; border-right: 4px solid #FFF; border-top: 3px solid #FFF; line-height:10px;">'.$this->oCRNRSTN_USR->return_creative('ERR_X', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED).'</div></td>
                                                        <td style="width:35px;height: 19px; "><a href="#'.$this->format_output($client_nom,'CLIENT_NOM').'" style=\'height: 23px; color: #6885C3; font-family:"Courier New", Courier, monospace; font-size: 15px; font-weight: normal; line-height:10px; margin:0; padding:0; \'>'.$tmp_x_cnt.'</a></td>
                                                    
                                                        <td><div style="width: 19px; height: 19px; overflow:hidden; border-left: 8px solid #FFF; border-right: 4px solid #FFF; border-top: 3px solid #FFF; line-height:10px;">'.$this->oCRNRSTN_USR->return_creative('SUCCESS_CHECK', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED).'</div></td>
                                                        <td style="height: 19px;"><a href="#'.$this->format_output($client_nom,'CLIENT_NOM').'" style=\'height: 23px; color: #6885C3; font-family:"Courier New", Courier, monospace; font-size: 15px; font-weight: normal; line-height:10px; margin:0; padding:0; \'>'.$tmp_success_cnt.'</a></td>
                                                   
                                                    </tr>                       
                                                    </table>                         
                                                </td>                              
                                            </tr>                              
                                            </table>
                                            </div>';

        }

        return $tmp_str;

    }

    private function return_validation_results_error_notes($output_format = 'HTML'){

        switch($output_format){
            case 'HTML':

                $tmp_str = '<div style=\'font-family:"Courier New", Courier, monospace; font-size: 17px; line-height:25px; font-weight: bold; border-top: 30px solid #FFF; border-bottom: 6px solid #FFF; color: #6885C3;\'>
                                Notices, Errors, and Success<br> Details About Email Client<br> CSS Support for the Submitted Data 
                                </div>';

            break;
            default:
                //
                // TEXT VERSION EMAIL, GETS NOT THIS CONTENT.
                $tmp_str = 'Notices, Errors, and Success 
Details for Email Client 
CSS Support Within Message';

            break;

        }

        //
        // DESKTOP
        $tmp_str = $tmp_str . '<div style=\'font-family:"Courier New", Courier, monospace; font-size: 15px; font-weight: bold;  border-bottom: 6px solid #FFF; \'>
                                    <table cellpadding="0" cellspacing="0" border="0" style="width:365px; background-color: #6886C3;">
                                    <tr>
                                        <td style="width:320px;"><div style=\'width:300px; font-family:"Courier New", Courier, monospace; color:#FFF; font-weight: bold; font-size: 15px; background-color: #6886C3; border-left: 14px solid #6886C3; border-top: 8px solid #6886C3; border-bottom: 6px solid #6886C3;\'>DESKTOP :: CSS Performance</div></td>
                                        <td style="width:20px; text-align:right;"><div style=\'font-family:"Courier New", Courier, monospace; color:#FFF; font-weight: normal; font-size: 12px; line-height: 17px; background-color: #6886C3; border-right: 14px solid #6886C3; border-top: 8px solid #6886C3; border-bottom: 6px solid #6886C3;\'><a href="#crnrstn_pg_top" target="_self" style=\'font-family:"Courier New", Courier, monospace; text-decoration:none; color: #FFF; text-decoration: underline; line-height: 17px;\'>top</a></div></td>
                                    </tr>                
                                    </table>
                                </div>';

        foreach($this->desktop_mail_client_ARRAY as $key => $client_nom){

            //
            // MAIL CLIENT SECTION SUB-HEADER
            if($key==0){

                $top_lnk = '';

            }else{

                $top_lnk = '<div style=\'font-family:"Courier New", Courier, monospace; font-weight: normal; font-size: 12px; line-height: 17px; border-right: 14px solid #FFF; border-top: 8px solid #FFF; border-bottom: 6px solid #FFF; color: #6885C3;\'><a href="#crnrstn_pg_top" target="_self" style=\'font-family:"Courier New", Courier, monospace; text-decoration:none; color: #6885C3; text-decoration: underline; line-height: 17px;\'>top</a></div>';

            }

            $tmp_str = $tmp_str . '<div id="'.$this->format_output($client_nom, 'CLIENT_NOM').'"></div><div id="'.$this->format_output($client_nom, 'CLIENT_NOM').'"></div><div style=\'border-bottom: 5px solid #FFF; border-left: 14px solid #FFF; border-top: 10px solid #FFF; text-align: left;color: #6885C3;font-family:"Courier New", Courier, monospace; font-size: 17px; font-weight: bold; \'>
                               
                                <table cellpadding="0" cellspacing="0" border="0" style="width:320px;">
                                        <tr>
                                            <td style="width:320px;"><div style=\'color: #6885C3;font-family:"Courier New", Courier, monospace; font-size: 17px; font-weight: normal; border-top: 1px solid #FFF; color: #6885C3; \'><strong>'.$client_nom.'</strong></div></td>
                                            <td style="width:20px; text-align:right;">'.$top_lnk.'</td>
                                        </tr>                
                                        </table>      
                                </div>  ';


            foreach($this->validation_results_ARRAY as $key_css_species => $chunkArray0) {

                foreach ($chunkArray0 as $css_str_pattern => $hit_count) {

                    if($hit_count > 0){

                        $tmp_str = $tmp_str . $this->dynamic_content_return($css_str_pattern, 'VALIDATOR_RESULTS_PAGE_NOTES_ERROR_DETAILS_CSS', $output_format , $this->desktop_mail_CONST_ARRAY[$key]);

                    }

                }

            }

        }

        //
        // MOBILE
        $tmp_str = $tmp_str . '<div style=\'font-family:"Courier New", Courier, monospace; font-size: 15px; font-weight: bold;  border-bottom: 6px solid #FFF; \'>
                                    <table cellpadding="0" cellspacing="0" border="0" style="width:365px; background-color: #6886C3;">
                                    <tr>
                                        <td style="width:320px;"><div style=\'width:300px; font-family:"Courier New", Courier, monospace; color:#FFF; font-weight: bold; font-size: 15px; background-color: #6886C3; border-left: 14px solid #6886C3; border-top: 8px solid #6886C3; border-bottom: 6px solid #6886C3;\'>MOBILE :: CSS Performance</div></td>
                                        <td style="width:20px; text-align:right;"><div style=\'font-family:"Courier New", Courier, monospace; color:#FFF; font-weight: normal; font-size: 12px; line-height: 17px; background-color: #6886C3; border-right: 14px solid #6886C3; border-top: 8px solid #6886C3; border-bottom: 6px solid #6886C3;\'><a href="#crnrstn_pg_top" target="_self" style=\'font-family:"Courier New", Courier, monospace; text-decoration:none; color: #FFF; text-decoration: underline; line-height: 17px;\'>top</a></div></td>
                                    </tr>                
                                    </table>
                                </div>';

        foreach($this->mobile_mail_client_ARRAY as $key => $client_nom){

            //
            // MAIL CLIENT SECTION SUB-HEADER
            if($key==0){

                $top_lnk = '';

            }else{

                $top_lnk = '<div style=\'font-family:"Courier New", Courier, monospace; font-weight: normal; font-size: 12px; line-height: 17px; border-right: 14px solid #FFF; border-top: 8px solid #FFF; border-bottom: 6px solid #FFF; color: #6885C3;\'><a href="#crnrstn_pg_top" target="_self" style=\'font-family:"Courier New", Courier, monospace; text-decoration:none; color: #6885C3; text-decoration: underline; line-height: 17px;\'>top</a></div>';

            }

            $tmp_str = $tmp_str . '<div id="'.$this->format_output($client_nom, 'CLIENT_NOM').'"></div><div style=\'border-bottom: 5px solid #FFF; border-left: 14px solid #FFF; border-top: 10px solid #FFF; text-align: left;color: #6885C3;font-family:"Courier New", Courier, monospace; font-size: 17px; font-weight: bold; \'>
                               
                                <table cellpadding="0" cellspacing="0" border="0" style="width:320px;">
                                        <tr>
                                            <td style="width:320px;"><div style=\'color: #6885C3;font-family:"Courier New", Courier, monospace; font-size: 17px; font-weight: normal; border-top: 1px solid #FFF; color: #6885C3; \'><strong>'.$client_nom.'</strong></div></td>
                                            <td style="width:20px; text-align:right;">'.$top_lnk.'</td>
                                        </tr>                
                                        </table>      
                                </div>  ';

            foreach($this->validation_results_ARRAY as $key_css_species => $chunkArray0) {

                foreach ($chunkArray0 as $css_str_pattern => $hit_count) {

                    if($hit_count>0){

                        $tmp_str = $tmp_str . $this->dynamic_content_return($css_str_pattern, 'VALIDATOR_RESULTS_PAGE_NOTES_ERROR_DETAILS_CSS', $output_format, $this->mobile_mail_CONST_ARRAY[$key]);

                    }

                }

            }

        }

        //
        // WEB
        $tmp_str = $tmp_str . '<div style=\'font-family:"Courier New", Courier, monospace; font-size: 15px; font-weight: bold;  border-bottom: 6px solid #FFF; \'>
                                    <table cellpadding="0" cellspacing="0" border="0" style="width:365px; background-color: #6886C3;">
                                    <tr>
                                        <td style="width:320px;"><div style=\'width:300px; font-family:"Courier New", Courier, monospace; color:#FFF; font-weight: bold; font-size: 15px; background-color: #6886C3; border-left: 14px solid #6886C3; border-top: 8px solid #6886C3; border-bottom: 6px solid #6886C3;\'>WEB :: CSS Performance</div></td>
                                        <td style="width:20px; text-align:right;"><div style=\'font-family:"Courier New", Courier, monospace; color:#FFF; font-weight: normal; font-size: 12px; line-height: 17px; background-color: #6886C3; border-right: 14px solid #6886C3; border-top: 8px solid #6886C3; border-bottom: 6px solid #6886C3;\'><a href="#crnrstn_pg_top" target="_self" style=\'font-family:"Courier New", Courier, monospace; text-decoration:none; color: #FFF; text-decoration: underline; line-height: 17px;\'>top</a></div></td>
                                    </tr>                
                                    </table>
                                </div>';

        foreach($this->web_mail_client_ARRAY as $key => $client_nom){

            //
            // MAIL CLIENT SECTION SUB-HEADER
            if($key==0){

                $top_lnk = '';

            }else{

                $top_lnk = '<div style=\'font-family:"Courier New", Courier, monospace; font-weight: normal; font-size: 12px; line-height: 17px; border-right: 14px solid #FFF; border-top: 8px solid #FFF; border-bottom: 6px solid #FFF; color: #6885C3;\'><a href="#crnrstn_pg_top" target="_self" style=\'font-family:"Courier New", Courier, monospace; text-decoration:none; color: #6885C3; text-decoration: underline; line-height: 17px;\'>top</a></div>';

            }

            $tmp_str = $tmp_str . '<div id="'.$this->format_output($client_nom, 'CLIENT_NOM').'"></div><div style=\'border-bottom: 5px solid #FFF; border-left: 14px solid #FFF; border-top: 10px solid #FFF; text-align: left;color: #6885C3;font-family:"Courier New", Courier, monospace; font-size: 17px; font-weight: bold; \'>
                               
                                <table cellpadding="0" cellspacing="0" border="0" style="width:320px;">
                                        <tr>
                                            <td style="width:320px;"><div style=\'color: #6885C3;font-family:"Courier New", Courier, monospace; font-size: 17px; font-weight: normal; border-top: 1px solid #FFF; color: #6885C3; \'><strong>'.$client_nom.'</strong></div></td>
                                            <td style="width:20px; text-align:right;">'.$top_lnk.'</td>
                                        </tr>                
                                        </table>      
                                </div>  ';

            foreach($this->validation_results_ARRAY as $key_css_species => $chunkArray0) {

                foreach ($chunkArray0 as $css_str_pattern => $hit_count) {

                    if($hit_count>0){

                        $tmp_str = $tmp_str . $this->dynamic_content_return($css_str_pattern, 'VALIDATOR_RESULTS_PAGE_NOTES_ERROR_DETAILS_CSS', $output_format, $this->web_mail_CONST_ARRAY[$key]);

                    }

                }

            }

        }

        return $tmp_str;

    }

    private function css_validate_STANDARD($css_string_nomination, $key_css_species){

        //
        // {PATTERN}:
        $tmp_css_string = strtolower($this->return_clean_css_pattern($css_string_nomination)).':';

        $this->validation_results_ARRAY[$key_css_species][$css_string_nomination] = substr_count($this->raw_data_LOWER, $tmp_css_string);

    }

    private function css_validate_STYLE_IN_HEAD($css_string_nomination, $key_css_species){

        $tmp_ARRAY = explode('<head', $this->raw_data_PACKED);

        if(isset($tmp_ARRAY[1])){

            $tmp_ARRAY = explode('</head', $tmp_ARRAY[1]);

            $tmp_cnt = substr_count($tmp_ARRAY[0], '<style');

            if($tmp_cnt > 0){

                $this->validation_results_ARRAY[$key_css_species][$css_string_nomination] = 1;

            }else{

                $this->validation_results_ARRAY[$key_css_species][$css_string_nomination] = 0;

            }

        }else{

            $this->validation_results_ARRAY[$key_css_species][$css_string_nomination] = 0;

        }

    }

    private function css_validate_STYLE_IN_BODY($css_string_nomination, $key_css_species){

        $tmp_ARRAY = explode('<body', $this->raw_data_PACKED);

        if(isset($tmp_ARRAY[1])){

            $tmp_ARRAY = explode('</body', $tmp_ARRAY[1]);

            $tmp_cnt = substr_count($tmp_ARRAY[0], '<style');

            if($tmp_cnt > 0){

                $this->validation_results_ARRAY[$key_css_species][$css_string_nomination] = 1;

            }else{

                $this->validation_results_ARRAY[$key_css_species][$css_string_nomination] = 0;

            }

        }else{

            $this->validation_results_ARRAY[$key_css_species][$css_string_nomination] = 0;

        }

    }

    private function css_validate_LINK_IN_HEAD($css_string_nomination, $key_css_species){

        $tmp_ARRAY = explode('<head', $this->raw_data_PACKED);

        if(isset($tmp_ARRAY[1])){

            $tmp_ARRAY = explode('</head', $tmp_ARRAY[1]);

            $tmp_cnt = substr_count($tmp_ARRAY[0], '<link');

            if($tmp_cnt > 0){

                $this->validation_results_ARRAY[$key_css_species][$css_string_nomination] = 1;

            }else{

                $this->validation_results_ARRAY[$key_css_species][$css_string_nomination] = 0;

            }

        }else{

            $this->validation_results_ARRAY[$key_css_species][$css_string_nomination] = 0;

        }

    }

    private function css_validate_LINK_IN_BODY($css_string_nomination, $key_css_species){

        $tmp_ARRAY = explode('<body', $this->raw_data_PACKED);

        if(isset($tmp_ARRAY[1])){

            $tmp_ARRAY = explode('</body', $tmp_ARRAY[1]);

            $tmp_cnt = substr_count($tmp_ARRAY[0], '<linkrel');

            if($tmp_cnt > 0){

                $this->validation_results_ARRAY[$key_css_species][$css_string_nomination] = 1;

            }else{

                $this->validation_results_ARRAY[$key_css_species][$css_string_nomination] = 0;

            }

        }else{

            $this->validation_results_ARRAY[$key_css_species][$css_string_nomination] = 0;

        }
    }

    private function format_output($str, $format_type = 'NOTE', $output_type = 'HTML'){

        $formatted_str = '';

        switch($format_type){
            case 'CLIENT_NOM':

                $formatted_str = strtolower($this->oCRNRSTN_USR->proper_replace(' ', '_', $str));

                break;
            default:

                //
                // NOTE
                $formatted_str = $this->oCRNRSTN_USR->proper_replace('<code>', '<code style=\'border:2px solid #D9DEEB; border-radius: 5px; border-bottom-right-radius: 0; border-top-left-radius: 0; padding:1px 0 1px 0; line-height:17px; color:#FFF;\'><code style=\'background-color: #6886C3; border:1px solid #FFF; border-radius: 5px; border-bottom-right-radius: 0; border-top-left-radius: 0; padding:1px 3px 1px 3px; color:#FFF; font-family:"Courier New", Courier, monospace; font-size: 11px; font-weight: normal; line-height:17px; \'>', $str);
                $formatted_str = $this->oCRNRSTN_USR->proper_replace('</code>', '</code></code>', $formatted_str);

                break;

        }

        return $formatted_str;

    }

    private function numeric_to_alpha($tmp_score){

        $tmp_array = array('<div style=\'font-family:"Courier New", Courier, monospace; border-right: 6px solid #A5B9D8; border-bottom: 3px solid #A5B9D8; font-size: 57px; font-weight:bold; line-height: 68px; color: #FFF;\'>A+</div>','<div style=\'border-left: 20px solid #A5B9D8; border-right: 20px solid #A5B9D8; border-bottom: 3px solid #A5B9D8; font-family:"Courier New", Courier, monospace;  font-size: 57px; font-weight:bold; color: #FFF; line-height: 68px;\'>A</div>','<div style=\'font-family:"Courier New", Courier, monospace; border-right: 6px solid #A5B9D8; border-bottom: 3px solid #A5B9D8; font-size: 57px; font-weight:bold; line-height: 68px; color: #FFF;\'>A-</div>', '<div style=\'font-family:"Courier New", Courier, monospace; border-right: 6px solid #A5B9D8; border-bottom: 3px solid #A5B9D8; font-size: 57px; font-weight:bold; line-height: 68px; color: #FFF;\'>B+</div>','<div style=\'border-left: 20px solid #A5B9D8; border-right: 20px solid #A5B9D8; border-bottom: 3px solid #A5B9D8; font-family:"Courier New", Courier, monospace;  font-size: 57px; font-weight:bold; color: #FFF; line-height: 68px;\'>B</div>','<div style=\'font-family:"Courier New", Courier, monospace; border-right: 6px solid #A5B9D8; border-bottom: 3px solid #A5B9D8; font-size: 57px; font-weight:bold; line-height: 68px; color: #FFF;\'>B-</div>','<div style=\'font-family:"Courier New", Courier, monospace; border-right: 6px solid #A5B9D8; border-bottom: 3px solid #A5B9D8; font-size: 57px; font-weight:bold; line-height: 68px; color: #FFF;\'>C+</div>','<div style=\'border-left: 20px solid #A5B9D8; border-right: 20px solid #A5B9D8; border-bottom: 3px solid #A5B9D8; font-family:"Courier New", Courier, monospace;  font-size: 57px; font-weight:bold; color: #FFF; line-height: 68px;\'>C</div>','<div style=\'font-family:"Courier New", Courier, monospace; border-right: 6px solid #A5B9D8; border-bottom: 3px solid #A5B9D8; font-size: 57px; font-weight:bold; line-height: 68px; color: #FFF;\'>C-</div>','<div style=\'font-family:"Courier New", Courier, monospace; border-right: 6px solid #A5B9D8; border-bottom: 3px solid #A5B9D8; font-size: 57px; font-weight:bold; line-height: 68px; color: #FFF;\'>D+</div>','<div style=\'border-left: 20px solid #A5B9D8; border-right: 20px solid #A5B9D8; border-bottom: 3px solid #A5B9D8; font-family:"Courier New", Courier, monospace;  font-size: 57px; font-weight:bold; color: #FFF; line-height: 68px;\'>D</div>','<div style=\'font-family:"Courier New", Courier, monospace; border-right: 6px solid #A5B9D8; border-bottom: 3px solid #A5B9D8; font-size: 57px; font-weight:bold; line-height: 68px; color: #FFF;\'>D-</div>','<div style=\'font-family:"Courier New", Courier, monospace; border-right: 6px solid #A5B9D8; border-bottom: 3px solid #A5B9D8; font-size: 57px; font-weight:bold; line-height: 68px; color: #FFF;\'>F+</div>','<div style=\'border-left: 20px solid #A5B9D8; border-right: 20px solid #A5B9D8; border-bottom: 3px solid #A5B9D8; font-family:"Courier New", Courier, monospace;  font-size: 57px; font-weight:bold; color: #FFF; line-height: 68px;\'>F</div>','<div style=\'font-family:"Courier New", Courier, monospace; border-right: 6px solid #A5B9D8; border-bottom: 3px solid #A5B9D8; font-size: 57px; font-weight:bold; line-height: 68px; color: #FFF;\'>F-</div>');
        $tmp_current_score = 0;

        if($tmp_score > 97){
            // A+

            return $tmp_array[$tmp_current_score];

        }else{

            $tmp_current_score++;
            if($tmp_score > 94){
                // A

                return $tmp_array[$tmp_current_score];


            }else{

                $tmp_current_score++;
                if($tmp_score > 91.99){
                    // A-

                    return $tmp_array[$tmp_current_score];

                }else{

                    $tmp_current_score++;
                    if($tmp_score > 87){
                        // B+
                        return $tmp_array[$tmp_current_score];

                    }else{

                        $tmp_current_score++;
                        if($tmp_score > 84){
                            // B
                            return $tmp_array[$tmp_current_score];

                        }else{

                            $tmp_current_score++;
                            if($tmp_score > 81.999){
                                // B-
                                return $tmp_array[$tmp_current_score];

                            }else{

                                $tmp_current_score++;
                                if($tmp_score > 77){
                                    // C+


                                    return $tmp_array[$tmp_current_score];


                                }else{

                                    $tmp_current_score++;
                                    if($tmp_score > 74.99){
                                        // C


                                        return $tmp_array[$tmp_current_score];


                                    }else{

                                        $tmp_current_score++;
                                        if($tmp_score > 71.99){
                                            // C-


                                            return $tmp_array[$tmp_current_score];


                                        }else{

                                            $tmp_current_score++;
                                            if($tmp_score > 67){
                                                // D+


                                                return $tmp_array[$tmp_current_score];


                                            }else{

                                                $tmp_current_score++;
                                                if($tmp_score > 64.99){
                                                    // D


                                                    return $tmp_array[$tmp_current_score];


                                                }else{

                                                    $tmp_current_score++;
                                                    if($tmp_score > 61.99){
                                                        // D-


                                                        return $tmp_array[$tmp_current_score];


                                                    }else{

                                                        $tmp_current_score++;
                                                        if($tmp_score > 57){
                                                            // F+


                                                            return $tmp_array[$tmp_current_score];


                                                        }else{

                                                            $tmp_current_score++;
                                                            if($tmp_score > 54){
                                                                // F-


                                                                return $tmp_array[$tmp_current_score];


                                                            }else{

                                                                $tmp_current_score++;
                                                                return $tmp_array[$tmp_current_score];

                                                                //
                                                                // I'M SO SORRY FOR ALL THIS.

                                                            }

                                                        }

                                                    }

                                                }

                                            }

                                        }

                                    }

                                }

                            }

                        }

                    }

                }

            }

        }

    }

    private function numeric_to_dot_graphic($tmp_score, $index = 100){

        //
        // ALL DOTS RED UNLESS TOTAL SCORE IS OVER 69.
        if($tmp_score > 69){

            //
            // USE GREEN DOTS
            $tmp_dot_HTML = $this->oCRNRSTN_USR->return_creative('DOT_GREEN', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED);

        }else{

            //
            // USE RED DOTS
            $tmp_dot_HTML = $this->oCRNRSTN_USR->return_creative('DOT_RED', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED);

        }

        $tmp_current_score = 0.000;

        for($i=0; $i<9; $i++){

            $tmp_current_score = $index * 10;

            if($tmp_current_score >= $tmp_score){

                //
                // USE CLEAR DOTS FOR ANY REMAINING DOTS.
                $tmp_dot_HTML = $this->oCRNRSTN_USR->return_creative('DOT_OFF', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED);

                return $tmp_dot_HTML;

            }else{

                return $tmp_dot_HTML;

            }

        }

    }

    public function return_validation_score($output_type, $index = 0, $client_const = NULL){

        //
        // ADJUST FOR THE SPOT
        $index_z = $index - 1;

        switch($output_type){
            case 'ALPHA':

                if(!isset($this->email_client_score_ARRAY['NUMERIC'])){

                    $tmp_bang_DESKTOP = $this->results_summary_aggregate_ARRAY['DESKTOP']['BANG'];
                    $tmp_x_DESKTOP = $this->results_summary_aggregate_ARRAY['DESKTOP']['X'];
                    $tmp_success_DESKTOP = $this->results_summary_aggregate_ARRAY['DESKTOP']['SUCCESS'];

                    $tmp_bang_MOBILE = $this->results_summary_aggregate_ARRAY['MOBILE']['BANG'];
                    $tmp_x_MOBILE = $this->results_summary_aggregate_ARRAY['MOBILE']['X'];
                    $tmp_success_MOBILE = $this->results_summary_aggregate_ARRAY['MOBILE']['SUCCESS'];

                    $tmp_bang_WEB = $this->results_summary_aggregate_ARRAY['WEB']['BANG'];
                    $tmp_x_WEB = $this->results_summary_aggregate_ARRAY['WEB']['X'];
                    $tmp_success_WEB = $this->results_summary_aggregate_ARRAY['WEB']['SUCCESS'];

                    $tmp_agg_bang = $tmp_bang_DESKTOP + $tmp_bang_MOBILE + $tmp_bang_WEB;
                    $tmp_agg_x = $tmp_x_DESKTOP + $tmp_x_MOBILE + $tmp_x_WEB;
                    $tmp_agg_success = $tmp_success_DESKTOP + $tmp_success_MOBILE + $tmp_success_WEB;

                    $tmp_score = $this->calculate_numerical_score($tmp_agg_x, $tmp_agg_success, $tmp_agg_bang);

                    $this->email_client_score_ARRAY['NUMERIC'] = $tmp_score;

                }

                return $this->numeric_to_alpha($this->email_client_score_ARRAY['NUMERIC']);

                break;
            case 'NUMERIC_RAW':

                if(!isset($this->email_client_score_ARRAY['NUMERIC'])){

                    $tmp_bang_DESKTOP = $this->results_summary_aggregate_ARRAY['DESKTOP']['BANG'];
                    $tmp_x_DESKTOP = $this->results_summary_aggregate_ARRAY['DESKTOP']['X'];
                    $tmp_success_DESKTOP = $this->results_summary_aggregate_ARRAY['DESKTOP']['SUCCESS'];

                    $tmp_bang_MOBILE = $this->results_summary_aggregate_ARRAY['MOBILE']['BANG'];
                    $tmp_x_MOBILE = $this->results_summary_aggregate_ARRAY['MOBILE']['X'];
                    $tmp_success_MOBILE = $this->results_summary_aggregate_ARRAY['MOBILE']['SUCCESS'];

                    $tmp_bang_WEB = $this->results_summary_aggregate_ARRAY['WEB']['BANG'];
                    $tmp_x_WEB = $this->results_summary_aggregate_ARRAY['WEB']['X'];
                    $tmp_success_WEB = $this->results_summary_aggregate_ARRAY['WEB']['SUCCESS'];

                    $tmp_agg_bang = $tmp_bang_DESKTOP + $tmp_bang_MOBILE + $tmp_bang_WEB;
                    $tmp_agg_x = $tmp_x_DESKTOP + $tmp_x_MOBILE + $tmp_x_WEB;
                    $tmp_agg_success = $tmp_success_DESKTOP + $tmp_success_MOBILE + $tmp_success_WEB;

                    $tmp_score = $this->calculate_numerical_score($tmp_agg_x, $tmp_agg_success, $tmp_agg_bang);

                    $this->email_client_score_ARRAY['NUMERIC'] = $tmp_score;
                    $this->output_string_ARRAY['SCORE_NUMERIC_RAW'] = $tmp_score;

                }

                return $this->email_client_score_ARRAY['NUMERIC'];

            break;
            case 'NUMERIC':

                if(!isset($this->email_client_score_ARRAY['NUMERIC'])){

                    $tmp_bang_DESKTOP = $this->results_summary_aggregate_ARRAY['DESKTOP']['BANG'];
                    $tmp_x_DESKTOP = $this->results_summary_aggregate_ARRAY['DESKTOP']['X'];
                    $tmp_success_DESKTOP = $this->results_summary_aggregate_ARRAY['DESKTOP']['SUCCESS'];

                    $tmp_bang_MOBILE = $this->results_summary_aggregate_ARRAY['MOBILE']['BANG'];
                    $tmp_x_MOBILE = $this->results_summary_aggregate_ARRAY['MOBILE']['X'];
                    $tmp_success_MOBILE = $this->results_summary_aggregate_ARRAY['MOBILE']['SUCCESS'];

                    $tmp_bang_WEB = $this->results_summary_aggregate_ARRAY['WEB']['BANG'];
                    $tmp_x_WEB = $this->results_summary_aggregate_ARRAY['WEB']['X'];
                    $tmp_success_WEB = $this->results_summary_aggregate_ARRAY['WEB']['SUCCESS'];

                    $tmp_agg_bang = $tmp_bang_DESKTOP + $tmp_bang_MOBILE + $tmp_bang_WEB;
                    $tmp_agg_x = $tmp_x_DESKTOP + $tmp_x_MOBILE + $tmp_x_WEB;
                    $tmp_agg_success = $tmp_success_DESKTOP + $tmp_success_MOBILE + $tmp_success_WEB;

                    $tmp_score = $this->calculate_numerical_score($tmp_agg_x, $tmp_agg_success, $tmp_agg_bang);

                    $this->email_client_score_ARRAY['NUMERIC'] = $tmp_score;

                }

                return (int) $this->email_client_score_ARRAY['NUMERIC'];

            break;
            case 'GRAPHIC_DOT_CHANNEL_CLIENT':

                return $this->numeric_to_dot_graphic($this->email_client_score_ARRAY[$client_const], $index_z);

            break;
            case 'GRAPHIC_DOT_CHANNEL_DESKTOP':

                if(!isset($this->email_client_score_ARRAY['GRAPHIC_DOT_CHANNEL_DESKTOP'])){

                    //
                    // TOTAL AGGREGATE FROM CHANNEL - DESKTOP
                    $tmp_bang_DESKTOP = $this->results_summary_aggregate_ARRAY['DESKTOP']['BANG'];
                    $tmp_x_DESKTOP = $this->results_summary_aggregate_ARRAY['DESKTOP']['X'];
                    $tmp_success_DESKTOP = $this->results_summary_aggregate_ARRAY['DESKTOP']['SUCCESS'];

                    $tmp_score_DESKTOP = $this->calculate_numerical_score($tmp_x_DESKTOP, $tmp_success_DESKTOP, $tmp_bang_DESKTOP);
                    //error_log(__LINE__ .' css mobile score='.$tmp_score_DESKTOP.' X['.$tmp_x_DESKTOP.'] S['.$tmp_success_DESKTOP.']');

                    $this->email_client_score_ARRAY['GRAPHIC_DOT_CHANNEL_DESKTOP'] = $tmp_score_DESKTOP;

                }

                return $this->numeric_to_dot_graphic($this->email_client_score_ARRAY['GRAPHIC_DOT_CHANNEL_DESKTOP'], $index_z);

            break;
            case 'GRAPHIC_DOT_CHANNEL_MOBILE':

                if(!isset($this->email_client_score_ARRAY['GRAPHIC_DOT_CHANNEL_MOBILE'])) {

                    //
                    // TOTAL AGGREGATE FROM CHANNEL - MOBILE
                    $tmp_bang_MOBILE = $this->results_summary_aggregate_ARRAY['MOBILE']['BANG'];
                    $tmp_x_MOBILE = $this->results_summary_aggregate_ARRAY['MOBILE']['X'];
                    $tmp_success_MOBILE = $this->results_summary_aggregate_ARRAY['MOBILE']['SUCCESS'];

                    $tmp_score = $this->calculate_numerical_score($tmp_x_MOBILE, $tmp_success_MOBILE, $tmp_bang_MOBILE);
                    //error_log(__LINE__ .' css mobile score='.$tmp_score.' X['.$tmp_x_MOBILE.'] S['.$tmp_success_MOBILE.']');

                    $this->email_client_score_ARRAY['GRAPHIC_DOT_CHANNEL_MOBILE'] = $tmp_score;

                }

                return $this->numeric_to_dot_graphic($this->email_client_score_ARRAY['GRAPHIC_DOT_CHANNEL_MOBILE'], $index_z);

            break;
            case 'GRAPHIC_DOT_CHANNEL_WEB':

                if(!isset($this->email_client_score_ARRAY['GRAPHIC_DOT_CHANNEL_WEB'])) {

                    //
                    // TOTAL AGGREGATE FROM CHANNEL - WEB
                    $tmp_bang_WEB = $this->results_summary_aggregate_ARRAY['WEB']['BANG'];
                    $tmp_x_WEB = $this->results_summary_aggregate_ARRAY['WEB']['X'];
                    $tmp_success_WEB = $this->results_summary_aggregate_ARRAY['WEB']['SUCCESS'];

                    $tmp_score = $this->calculate_numerical_score($tmp_x_WEB, $tmp_success_WEB, $tmp_bang_WEB);
                    //error_log(__LINE__ .' css web score='.$tmp_score.' X['.$tmp_x_WEB.'] S['.$tmp_success_WEB.']');

                    $this->email_client_score_ARRAY['GRAPHIC_DOT_CHANNEL_WEB'] = $tmp_score;

                }

                return $this->numeric_to_dot_graphic($this->email_client_score_ARRAY['GRAPHIC_DOT_CHANNEL_WEB'], $index_z);

                break;
            default:
                //
                // NOTHING
                return '';

            break;

        }

        return '';

    }

    private function calculate_numerical_score($err_cnt, $success_cnt, $bang_cnt){

        //
        // MY FIRST TRY. Monday 4.5.2021 at 0922hrs AFTER 1 COFFEE PRESS AND TWO (2) SWEETWATER 420's.
        // DIRECT TRANSLATION FROM SOME Numbers.app BU11SH1TT3RY.
        //$tmp_val = (double) (($err_cnt + $success_cnt) / $err_cnt);
        //error_log(__LINE__ .' $tmp_val = '.$tmp_val);

        //$tmp_val = (double) 1 - ($tmp_val / 100.00);
        //error_log(__LINE__ .' $tmp_val = '.$tmp_val);

        //$tmp_val = (double) $tmp_val - 0.50;
        //error_log(__LINE__ .' $tmp_val = '.$tmp_val);

        //$tmp_val = (double) (1 - $tmp_val) * 100;
        //error_log(__LINE__ .' $tmp_val = '.$tmp_val);

        //
        // ABJECT FAILURE FROM NUMBERS.APP...Monday, 4.5.2021 at 1019hrs
        // BUT THIS LINE RIGHT HERE WAS 'GOOD LOOKING OUT' FROM THE ERROR_LOG OUTPUT.
        //$score = (double) (((1 - ($err_cnt/242)) * 100)) + $success_cnt;

        /*
        4.9.2021 at 2253hrs

        50				total possible (total number of hits/css pattern matches)
        11				total error

        11/50 = A
        A * 100 = B
        100 - B

         * */
//
//        if($err_cnt == 0){
//
//            return 97;
//
//        }
//

        $tmp = $err_cnt + $success_cnt;

        if($tmp > 0){

            $tmp = (double) ($err_cnt / $tmp);

            if($tmp<0){

                return 92;

            }

            $tmp = (double) 100 * $tmp;

            $score = (double) 100 - $tmp;

            $score = (double) $this->grading_curve + (double) $score;

            if($score > 100){

                $score = 100;

            }

            return $score;

        }else{

            return 97;

        }

    }

    private function total_css_performance_summaries(){

        $tmp_client_AGG = array();
        $tmp_desktop_AGG = 0;
        $tmp_mobile_AGG = 0;
        $tmp_web_AGG = 0;

        $tmp_bang_AGG_cnt = 0;
        $tmp_x_AGG_cnt = 0;
        $tmp_success_AGG_cnt = 0;

        //
        // DESKTOP
        foreach($this->desktop_mail_CONST_ARRAY as $key => $client_const){

            $tmp_bang_cnt = (int) count($this->results_count_aggregation_ARRAY[$client_const]['BANG']) - 1;
            $tmp_x_cnt = (int) count($this->results_count_aggregation_ARRAY[$client_const]['X']) - 1;
            $tmp_success_cnt = (int) count($this->results_count_aggregation_ARRAY[$client_const]['SUCCESS']) - 1;

            //
            // STORE CLIENT AGGREGATE
            $this->results_summary_aggregate_ARRAY[$client_const]['BANG'] += $tmp_bang_cnt;
            $this->results_summary_aggregate_ARRAY[$client_const]['X'] += $tmp_x_cnt;
            $this->results_summary_aggregate_ARRAY[$client_const]['SUCCESS'] += $tmp_success_cnt;

            $tmp = $this->results_summary_aggregate_ARRAY[$client_const]['X'] + $this->results_summary_aggregate_ARRAY[$client_const]['SUCCESS'];

            if($tmp > 0){

                $tmp = $this->results_summary_aggregate_ARRAY[$client_const]['X'] / $tmp;

                $tmp = 100 * $tmp;

                $tmp_score = 100 - $tmp;

            }else{

                $this->results_summary_aggregate_ARRAY[$client_const]['X'] = 0;
                $this->results_summary_aggregate_ARRAY[$client_const]['SUCCESS'] = 0;

                $tmp_score = 95;

            }

            //$tmp_score = 100.00000 - (100.00000 * ($this->results_summary_aggregate_ARRAY[$client_const]['X'] / ($this->results_summary_aggregate_ARRAY[$client_const]['X'] + $this->results_summary_aggregate_ARRAY[$client_const]['SUCCESS'])));

            $this->email_client_score_ARRAY[$client_const] = (double) $tmp_score;


            //
            // CHANNEL AGGREGATE
            $tmp_bang_AGG_cnt += $this->results_summary_aggregate_ARRAY[$client_const]['BANG'];
            $tmp_x_AGG_cnt += $this->results_summary_aggregate_ARRAY[$client_const]['X'];
            $tmp_success_AGG_cnt += $this->results_summary_aggregate_ARRAY[$client_const]['SUCCESS'];

        }

        //
        // STORE CHANNEL AGGREGATE
        $this->results_summary_aggregate_ARRAY['DESKTOP']['BANG'] = $tmp_bang_AGG_cnt;
        $this->results_summary_aggregate_ARRAY['DESKTOP']['X'] = $tmp_x_AGG_cnt;
        $this->results_summary_aggregate_ARRAY['DESKTOP']['SUCCESS'] = $tmp_success_cnt;

        $tmp_bang_AGG_cnt = 0;
        $tmp_x_AGG_cnt = 0;
        $tmp_success_AGG_cnt = 0;

        //
        // MOBILE
        foreach($this->mobile_mail_CONST_ARRAY as $key => $client_const){

            $tmp_bang_cnt = (int) count($this->results_count_aggregation_ARRAY[$client_const]['BANG']) - 1;
            $tmp_x_cnt = (int) count($this->results_count_aggregation_ARRAY[$client_const]['X']) - 1;
            $tmp_success_cnt = (int) count($this->results_count_aggregation_ARRAY[$client_const]['SUCCESS']) -1;

            //
            // STORE CLIENT AGGREGATE
            $this->results_summary_aggregate_ARRAY[$client_const]['BANG'] += $tmp_bang_cnt;
            $this->results_summary_aggregate_ARRAY[$client_const]['X'] += $tmp_x_cnt;
            $this->results_summary_aggregate_ARRAY[$client_const]['SUCCESS'] += $tmp_success_cnt;

            $tmp = $this->results_summary_aggregate_ARRAY[$client_const]['X'] + $this->results_summary_aggregate_ARRAY[$client_const]['SUCCESS'];

            if($tmp > 0){

                $tmp = $this->results_summary_aggregate_ARRAY[$client_const]['X'] / $tmp;

                $tmp = 100 * $tmp;

                $tmp_score = 100 - $tmp;

            }else{

                $this->results_summary_aggregate_ARRAY[$client_const]['X'] = 0;
                $this->results_summary_aggregate_ARRAY[$client_const]['SUCCESS'] = 0;

                $tmp_score = 95;

            }

            $this->email_client_score_ARRAY[$client_const] = (double) $tmp_score;

            //
            // CHANNEL AGGREGATE
            $tmp_bang_AGG_cnt += $this->results_summary_aggregate_ARRAY[$client_const]['BANG'];
            $tmp_x_AGG_cnt += $this->results_summary_aggregate_ARRAY[$client_const]['X'];
            $tmp_success_AGG_cnt += $this->results_summary_aggregate_ARRAY[$client_const]['SUCCESS'];

        }

        //
        // STORE CHANNEL AGGREGATE
        $this->results_summary_aggregate_ARRAY['MOBILE']['BANG'] = $tmp_bang_AGG_cnt;
        $this->results_summary_aggregate_ARRAY['MOBILE']['X'] = $tmp_x_AGG_cnt;
        $this->results_summary_aggregate_ARRAY['MOBILE']['SUCCESS'] = $tmp_success_cnt;

        $tmp_bang_AGG_cnt = 0;
        $tmp_x_AGG_cnt = 0;
        $tmp_success_AGG_cnt = 0;

        //
        // WEB
        foreach($this->web_mail_CONST_ARRAY as $key => $client_const){

            $tmp_bang_cnt = (int) count($this->results_count_aggregation_ARRAY[$client_const]['BANG']) - 1;
            $tmp_x_cnt = (int) count($this->results_count_aggregation_ARRAY[$client_const]['X']) - 1;
            $tmp_success_cnt = (int) count($this->results_count_aggregation_ARRAY[$client_const]['SUCCESS']) - 1;

            //error_log(__LINE__ .' css X['.$tmp_x_cnt.'] S['.$tmp_success_cnt.'] !['.$tmp_bang_cnt.']');

            $this->results_summary_aggregate_ARRAY[$client_const]['BANG'] += $tmp_bang_cnt;
            $this->results_summary_aggregate_ARRAY[$client_const]['X'] += $tmp_x_cnt;
            $this->results_summary_aggregate_ARRAY[$client_const]['SUCCESS'] += $tmp_success_cnt;

            $tmp = $this->results_summary_aggregate_ARRAY[$client_const]['X'] + $this->results_summary_aggregate_ARRAY[$client_const]['SUCCESS'];

            if($tmp > 0){

                $tmp = $this->results_summary_aggregate_ARRAY[$client_const]['X'] / $tmp;

                $tmp = 100 * $tmp;

                $tmp_score = 100 - $tmp;

            }else{

                $this->results_summary_aggregate_ARRAY[$client_const]['X'] = 0;
                $this->results_summary_aggregate_ARRAY[$client_const]['SUCCESS'] = 0;

                $tmp_score = 95;

            }

            //$tmp_score = 100.00000 - (100.00000 * ($this->results_summary_aggregate_ARRAY[$client_const]['X'] / ($this->results_summary_aggregate_ARRAY[$client_const]['X'] + $this->results_summary_aggregate_ARRAY[$client_const]['SUCCESS'])));
            $this->email_client_score_ARRAY[$client_const] = (double) $tmp_score;

            //
            // CHANNEL AGGREGATE
            $tmp_bang_AGG_cnt += $this->results_summary_aggregate_ARRAY[$client_const]['BANG'];
            $tmp_x_AGG_cnt += $this->results_summary_aggregate_ARRAY[$client_const]['X'];
            $tmp_success_AGG_cnt += $this->results_summary_aggregate_ARRAY[$client_const]['SUCCESS'];

        }

        //
        // STORE CHANNEL AGGREGATE
        $this->results_summary_aggregate_ARRAY['WEB']['BANG'] = $tmp_bang_AGG_cnt;
        $this->results_summary_aggregate_ARRAY['WEB']['X'] = $tmp_x_AGG_cnt;
        $this->results_summary_aggregate_ARRAY['WEB']['SUCCESS'] = $tmp_success_cnt;

    }

    public function __destruct(){

    }

}