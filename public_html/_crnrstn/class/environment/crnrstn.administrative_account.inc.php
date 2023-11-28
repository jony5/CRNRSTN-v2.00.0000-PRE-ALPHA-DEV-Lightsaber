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
#  CLASS :: crnrstn_administrative_account
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  VERSION :: 1.00.0000
#  DATE :: Tuesday Feb 16, 2021 @ 2242hrs
#  DESCRIPTION :: Holds administrative account access credentials for CRNRSTN ::
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_administrative_account {

    protected $oLogger;
    protected $oCRNRSTN_n;

    protected $email;
    protected $pwdhash;
    protected $ttl;
    protected $max_login_attempts = 10;
    protected $max_seconds_inactive = 10;
    protected $session_start_time;
    protected $last_modified_date;
    protected $session_ip_address;

    protected $is_logged_in = false;
    protected $serial;

    public function __construct($oCRNRSTN_ENV, $email, $pwdhash, $ttl, $max_login_attempts, $max_seconds_inactive){

        $this->oCRNRSTN_n = $oCRNRSTN_ENV;
        $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN_n);

        $this->email = $email;
        $this->pwdhash = $pwdhash;
        $this->ttl = $ttl;
        $this->max_login_attempts = $max_login_attempts;
        $this->max_seconds_inactive = $max_seconds_inactive;
        $this->session_ip_address = $this->oCRNRSTN_n->oCRNRSTN_IPSECURITY_MGR->clientIpAddress();

        $this->serial = $this->oCRNRSTN_n->hash(trim(strtolower($email)), 'md5');

        $this->oCRNRSTN_n->oLog_output_ARRAY[] = $this->oCRNRSTN_n->error_log('Instantiating an administrative account with email=' . $this->oCRNRSTN_n->str_sanitize($this->email, 'email_private') . ' for the ' . $this->oCRNRSTN_n->env_key . ' environment.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

        $this->refresh_modified_date();

    }

    private function refresh_modified_date(){

        $this->last_modified_date = $this->oCRNRSTN_n->return_micro_time();

    }

//    public function return_session_ip_address(){
//
//        return $this->session_ip_address;
//
//    }

//    public function maintain_valid_session(){
//
//
//        if($this->monitor_inactivity() && $this->monitor_ip_address() && $this->is_logged_in){
//
//            $this->refresh_modified_date();
//
//            return true;
//
//        }else{
//
//            return false;
//
//        }
//
//    }

//    private function monitor_inactivity(){
//
//        if($this->max_seconds_inactive < $this->oCRNRSTN_n->elapsed_from_current(strtotime($this->last_modified_date))){
//
//            return false;
//
//        }else{
//
//            return true;
//
//        }
//
//    }

//    private function monitor_ip_address(){
//
//        if($this->session_ip_address != $this->oCRNRSTN_n->oCRNRSTN_IPSECURITY_MGR->clientIpAddress()){
//
//            return false;
//
//        }else{
//
//            return true;
//
//        }
//
//    }

    public function account_get_resource($data_type){

        $data_type = strtolower(trim($data_type));

        switch($data_type){
            case 'serial':

                return $this->serial;

            break;
            case 'email':

                return $this->email;

            break;
            case 'ttl':

                return $this->ttl;

            break;
            case 'max_login_attempts':

                return $this->max_login_attempts;

            break;
            case 'max_seconds_inactive':

                return $this->max_seconds_inactive;

            break;
            case 'session_start_time':

                return $this->session_start_time;

            break;
            case 'session_ip_address':

                return $this->session_ip_address;

            break;
            default:

                return -1;

            break;

        }

    }

    public function is_valid($email, $pwd_hash){

        $tmp_email_lower = trim(strtolower($email));
        $tmp_sys_email_lower = $this->email;

        if(strcmp($tmp_email_lower, $tmp_sys_email_lower) !== 0){

            return false;

        }else{

            $tmp_config_pwd_hash_cmp = $this->oCRNRSTN_n->create_pwd_hash_for_storage($this->pwdhash);

            if($this->oCRNRSTN_n->validate_pwd_hash_login($pwd_hash, $tmp_config_pwd_hash_cmp) == true){

                $this->session_start_time = $this->oCRNRSTN_n->return_micro_time();

                return true;

            }

        }

        return false;

    }

    public function is_logged_in($status_override = NULL){

        if(!isset($status_override)){

            return $this->is_logged_in;

        }else{

            if(is_bool($status_override)){

                $this->is_logged_in = $status_override;

            }else{

                return false;

            }

            return true;

        }

    }

    public function return_serial(){

        return $this->serial;

    }

    public function return_max_login_attempts(){

        return $this->max_login_attempts;

    }

    public function return_seconds_inactive(){

        return $this->max_seconds_inactive;

    }

    public function __destruct(){

    }

}