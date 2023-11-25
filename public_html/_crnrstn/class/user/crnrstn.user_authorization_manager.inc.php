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
#  CLASS :: crnrstn_user_authorization_manager
#  VERSION :: 1.00.0000
#  DATE :: Saturday, May 8, 2021 1518hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI ::
#  DESCRIPTION :: User permissions management object.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_user_authorization_manager {

    protected $oLogger;
    public $oCRNRSTN_USR;
    protected $oUSER_ACCOUNT;

    protected $serial;
    protected $login_attempt_cnt = 0;
    //protected $max_seconds_inactive = 900;
    protected $last_modified_date;
    protected $is_authorized = false;
    protected $is_expired = false;
    protected $log_sys_notice_ARRAY = array();

    public function __construct($oCRNRSTN_USR){

        $this->oCRNRSTN_USR = $oCRNRSTN_USR;
        $this->serial = $this->oCRNRSTN_USR->generate_new_key(10);

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN_USR);

        //$this->max_seconds_inactive = $this->oCRNRSTN_USR->account_max_secs_inactive();

    }

    public function refresh_modified_date(){

        $this->last_modified_date = $this->oCRNRSTN_USR->return_micro_time();

    }

    public function last_modified_date(){

        return $this->last_modified_date;

    }

    public function receive_authorized_account($oUSER_ACCOUNT){

        error_log(__LINE__ . ' user receive_authorized_account class=[' . get_class($oUSER_ACCOUNT) . ']');
        $this->oUSER_ACCOUNT = $oUSER_ACCOUNT;

    }

    public function return_account(){

        return $this->oUSER_ACCOUNT;

    }

    public function account_get_resource($resource){

        if(isset($this->oUSER_ACCOUNT)){

            return $this->oUSER_ACCOUNT->account_get_resource($resource);

        }else{

            //error_log(__LINE__ . ' user ERROR? $resource=[' . $resource . '] = 10. class=['.get_class($this->oUSER_ACCOUNT).']');

            return 10;

        }

    }

    public function is_set(){

        if(isset($this->oUSER_ACCOUNT)){

            return true;

        }else{

            return false;

        }

    }

//    public function return_login_attempts($meta_type = 'count'){
//
//        switch($meta_type){
//            case 'max':
//
//                return $this->oCRNRSTN_USR->return_login_attempts('max');
//
//            break;
//            case 'remaining':
//
//                return $this->return_login_attempts_remaining();
//
//            break;
//            default:
//
//                return $this->login_attempt_cnt;
//
//            break;
//
//        }
//
//    }

    private function is_logged_in($state_override = NULL){

        if(isset($this->oUSER_ACCOUNT)){

            if(isset($state_override)){

                $this->oUSER_ACCOUNT->is_logged_in($state_override);

            }

            error_log(__LINE__ . ' user is_logged_in [' . print_r($this->oUSER_ACCOUNT->is_logged_in(), true) . ']');
            return $this->oUSER_ACCOUNT->is_logged_in();

        }else{

            return false;

        }

    }

    private function is_expired(){

        if(isset($this->oUSER_ACCOUNT)){

            if(isset($state_override)){

                $this->oUSER_ACCOUNT->is_logged_in($state_override);

            }

            error_log(__LINE__ . ' user is_logged_in [' . print_r($this->oUSER_ACCOUNT->is_logged_in(), true) . ']');

            return $this->oUSER_ACCOUNT->is_logged_in();

        }else{

            return false;

        }

    }

    public function increment_login_attempt(){

        $this->login_attempt_cnt++;

    }

//    public function return_max_secs_inactive(){
//
//        return $this->max_seconds_inactive;
//
//    }

    public function initialize_user_login_attempt(){

        /*

        // Sunday May 9, 2021 2326hrs
        // TRACK SESSION LOGIN ATTEMPTS.
        // STATS TO INCLUDE ::
            ~ TOTAL LOGIN ATTEMPT COUNT
            ~ DELTA TIME
                * FIRST ATTEMPT TIME
                * LAST ATTEMPT TIME

       */

    }

    public function sync_session_signin($oCRNRSN_ADMIN){

        $this->oCRNRSTN_USR->set_session_param('CRNRSTN_AUTHORIZED_ACCOUNT_STATUS', 'AUTH_ACTIVE');
        $this->oCRNRSTN_USR->set_session_param('CRNRSTN_AUTHORIZED_ACCOUNT', $oCRNRSN_ADMIN);

        return true;

    }

    public function sync_session_signout($oCRNRSN_ADMIN){

        $this->oCRNRSTN_USR->set_session_param('CRNRSTN_AUTHORIZED_ACCOUNT_STATUS', 'LOGGED_OUT');
        return $this->oCRNRSTN_USR->set_session_param('CRNRSTN_AUTHORIZED_ACCOUNT', 0);

    }

//    public function return_login_attempts_remaining(){
//
//        $tmp_max_login = $this->oCRNRSTN_USR->return_login_attempts('max');
//
//        return $tmp_max_login - $this->login_attempt_cnt;
//
//    }

    public function init_auth_session(){

        $this->oCRNRSTN_USR->set_session_param('CRNRSTN_AUTHORIZED_ACCOUNT', $this);

    }

    private function maintain_valid_session(){

        //
        /*
        Monday May 10, 2021 1740hrs
        CRITERIA FOR MAINTENANCE OF SESSION VALIDITY ::

        ~ INACTIVITY TIMEOUT
        ~ IP ADDRESS CHANGE
        ~ FIRE LOG OUT METHOD

        // READY TO TEST CODE ON Monday May 10, 2021 1841hrs
        */
        error_log(__LINE__ . ' user checking user_auth->monitor_ip_address');

        if($this->monitor_ip_address()){

            error_log(__LINE__ . ' user checking oUSER_ACCOUNT->is_logged_in');

            if($this->oUSER_ACCOUNT->is_logged_in()){

                error_log(__LINE__ . ' user checking user_auth->monitor_inactivity');

                if($this->monitor_inactivity()){

                    error_log(__LINE__ . ' user maintain_valid_session return true');

                    $this->refresh_modified_date();

                    return true;

                }

            }

        }

        error_log(__LINE__ . ' user maintain_valid_session return false');

        return false;

    }

    private function monitor_inactivity(){

        if($this->oCRNRSTN_USR->account_get_resource('max_seconds_inactive') < $this->oCRNRSTN_USR->elapsed_from_current(strtotime($this->last_modified_date))){

            return false;

        }else{

            return true;

        }

    }

    private function monitor_ip_address(){

        $tmp_sess_ip = $this->oCRNRSTN_USR->account_get_resource('session_ip_address');
        $tmp_curr_ip = $this->oCRNRSTN_USR->client_ip();

        error_log(__LINE__ . ' user class[' . get_class() . '] monitor_ip_address [' . $tmp_sess_ip . '] == [' . $tmp_curr_ip . ']');

        if($tmp_sess_ip != $tmp_curr_ip){

            return false;

        }else{

            return true;

        }

    }

    public function process_authorization(){

        //
        // PROVIDE USER INPUT PARAMS
        // crnrstn_auth_e
        // crnrstn_auth_pwd
        /**

        $raw_html_data = $this->extract_data_http('ugc_html', 'POST');
        $tmp_crnrstn_css_rtime = $this->extract_data_http('css_rtime');
        if($this->isset_http_param('crnrstn_r', 'GET')){

         * return_admin_ARRAY

         */

        $tmp_email = $this->oCRNRSTN_USR->get_http_resource('crnrstn_auth_e');

        $tmp_pwd_hash = $this->hash($this->oCRNRSTN_USR->get_http_resource('crnrstn_auth_pwd'));

        $tmp_crnrstn_country_iso_code = $this->oCRNRSTN_USR->get_http_resource('crnrstn_country_iso_code');
        $tmp_crnrstn_php_sessionid = $this->oCRNRSTN_USR->get_http_resource('crnrstn_php_sessionid');

        //
        // PROVIDE STORED ADMIN AUTH PARAMS
        $tmp_oAdmin_ARRAY = $this->oCRNRSTN_USR->return_admin_ARRAY();
        $tmp_array = array();
        $tmp_return_oADMIN = false;

        foreach($tmp_oAdmin_ARRAY as $serial => $oCRNRSTN_ADMIN){

            if($oCRNRSTN_ADMIN->is_valid($tmp_email, $tmp_pwd_hash)){

                $this->oCRNRSTN_USR->account_serial = $oCRNRSTN_ADMIN->account_get_resource('serial');

                $oCRNRSTN_ADMIN->is_logged_in(true);

                $this->receive_authorized_account($oCRNRSTN_ADMIN);

                $this->init_auth_session();

                return true;

            }

        }

        $this->init_auth_session();

        return false;

    }

    public function is_account_valid(){

        error_log(__LINE__ . ' user crnrstn_user_authorization is_account_valid run maintain_valid_session');

        if(!$this->maintain_valid_session()){

            error_log(__LINE__ . ' user crnrstn_user_authorization maintain_valid_session return false');

            //
            // ENSURE LOG OUT USER
            $this->log_account_notification($this->oCRNRSTN->multi_lang_content_return('CRNRSTN_SESSION_INACTIVE_EXPIRE'));
            error_log(__LINE__ . ' user crnrstn_user_authorization log_account_notification [' . $this->log_sys_notice_ARRAY[0] . ']');

            $this->is_logged_in(false);

            return false;

        }else{

            error_log(__LINE__ . ' user crnrstn_user_authorization maintain_valid_session return true');

            return true;

        }

    }

    public function log_account_notification($str){

        $this->log_sys_notice_ARRAY[] = $str;

    }

    public function account_max_inactive($secs_override = NULL){

        return $this->oUSER_ACCOUNT->account_get_resource('max_seconds_inactive');

    }

    public function account_max_login_attempts($count_override = NULL){

        return $this->oUSER_ACCOUNT->account_get_resource('max_login_attempts');

    }

    public function account_remaining_login_attempts($count_override = NULL){

        if(isset($this->oUSER_ACCOUNT)){

            $tmp_max_cnt = (int) $this->oUSER_ACCOUNT->account_get_resource('max_login_attempts');
            $tmp_cnt_remain = $tmp_max_cnt - $this->login_attempt_cnt;

            return $tmp_cnt_remain;

        }else{

            return $this->account_remaining_login_attempts();

        }

    }

//    public function account_remaining_login_attempts($count_override = NULL){
//
//        return $this->oCRNRSTN_AUTH->account_max_login_attempts($count_override);
//
//    }

    public function __destruct(){

    }

}