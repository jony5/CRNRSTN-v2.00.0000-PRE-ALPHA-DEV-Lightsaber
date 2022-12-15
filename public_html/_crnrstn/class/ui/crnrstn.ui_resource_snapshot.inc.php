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
#  CLASS :: crnrstn_ui_resource_state_snapshot
#  VERSION :: 1.00.0000
#  DATE :: May 2, 2021 @ 1943hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI ::
#  DESCRIPTION :: Support for tracking user experience for reversion.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_ui_resource_state_snapshot {

	protected $oLogger;
    public $oCRNRSTN_USR;

    protected $serial;
    protected $uri_state_ARRAY = array();
    protected $unix_date_created;
    protected $current_uri;

	public function __construct($oCRNRSTN_USR, $block_sequential_repeats = true){

	    $this->oCRNRSTN_USR = $oCRNRSTN_USR;

	    $this->unix_date_created = time();
	    $this->serial = $this->oCRNRSTN_USR->generate_new_key(32);

        $this->current_uri = $this->oCRNRSTN_USR->current_location();

        $this->add_uri($block_sequential_repeats);

    }

	private function add_uri($block_sequential_repeats = true){

	    if($block_sequential_repeats){

	        if(!isset($this->uri_state_ARRAY[$this->serial])){

                $this->uri_state_ARRAY[$this->serial][] = $this->current_uri;

            }else{

                $tmp_cnt = count($this->uri_state_ARRAY[$this->serial]);

                if($this->uri_state_ARRAY[$this->serial][$tmp_cnt] != $this->current_uri){

                    $this->uri_state_ARRAY[$this->serial][] = $this->current_uri;
                    //error_log(__LINE__ .' snapshot URI [' . $this->current_uri.']. Total URI now ['.count($this->uri_state_ARRAY[$this->serial]).']');

                }

            }

        }else{

            $this->uri_state_ARRAY[$this->serial][] = $this->current_uri;
            //error_log(__LINE__ .' snapshot URI [' . $this->current_uri.']. Total URI now ['.count($this->uri_state_ARRAY[$this->serial]).']');

        }

    }

	public function return_current_state($resource_type){

	    switch($resource_type){
            case 'URI':

                if(isset($this->uri_state_ARRAY[$this->serial])){

                    $tmp_array = $this->uri_state_ARRAY[$this->serial];
                    $tmp_array = array_reverse($tmp_array);

                    foreach($tmp_array as $key => $uri){

                        if(strlen($uri) > 1){

                            return $uri;

                        }

                    }

                }

            break;

        }

        return '#';

    }

	public function __destruct() {

	}

}

# # C # R # N # R # S # T # N # : : # # ##
#
#  CLASS :: crnrstn_view_state_controller
#  VERSION :: 1.00.0000
#  DATE :: Tuesday May 11, 2021 @ 2157hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI ::
#  DESCRIPTION :: Content presentation state controller.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_view_state_controller {

    protected $oLogger;
    public $oCRNRSTN_USR;
    protected $oCRNRSTN_AUTH;
    
    protected $output_str;

    public function __construct($oCRNRSTN_USR){

        $this->oCRNRSTN_USR = $oCRNRSTN_USR;

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN_USR);

    }

//    public function process_authorization($resource = NULL){
//
//        $this->oCRNRSTN_AUTH->increment_login_attempt();
//
//        //
//        // PROCESS USER SIGN IN REQUEST
//        $this->oCRNRSTN_AUTH->process_authorization();
//
//    }

    public function return_client_response($form_handle = NULL){

//        if($this->oCRNRSTN_USR->isset_session_param('CRNRSTN_AUTHORIZED_ACCOUNT_STATUS')) {
//
//            $tmp_session_status = $this->oCRNRSTN_USR->get_session_param('CRNRSTN_AUTHORIZED_ACCOUNT_STATUS');
//
//        }


        if($this->oCRNRSTN_USR->isset_session_param('CRNRSTN_AUTHORIZED_ACCOUNT')) {

            $this->oCRNRSTN_AUTH = $this->oCRNRSTN_USR->get_session_param('CRNRSTN_AUTHORIZED_ACCOUNT');

        }else{

            if(!isset($this->oCRNRSTN_AUTH)) {

                $this->oCRNRSTN_AUTH = new crnrstn_user_auth($this->oCRNRSTN_USR);

            }

        }

        if(!isset($form_handle)){

            //
            // $_GET REQUEST
            $form_handle = CRNRSTN_RESOURCE_ALL;

        }

        //
        // FORM POST HANDLE
        switch($form_handle){
            case 'crnrstn_signin_flagship':
            case 'crnrstn_signin_wireframe':

                $this->oCRNRSTN_USR->reset_auth_account();
                $this->oCRNRSTN_AUTH->increment_login_attempt();

                //
                // SIGN IN FORM POST RECEIVED
                if($this->oCRNRSTN_AUTH->process_authorization()){

                    $this->oCRNRSTN_USR->ui_module_alerts_sync();

                    return $this->oCRNRSTN_USR->proper_response_return($this->oCRNRSTN_USR->ui_module_out('dashboard'), NULL, 'RESPONSE_STICKY');

                }else{

                    $this->oCRNRSTN_USR->ui_module_alerts_sync();

                    return $this->oCRNRSTN_USR->proper_response_return($this->oCRNRSTN_USR->ui_module_out('signin'), NULL, 'RESPONSE_STICKY');

                }

            break;
            case 'crnrstn_validate_css':

                //if ($this->oCRNRSTN_USR->isset_crnrstn_services_http('POST')) {

                    $tmp_array = array();

                    //
                    // VALIDATE CSS
                    $raw_html_data = $this->oCRNRSTN_USR->extract_data_http('ugc_html', 'POST');

                    $tmp_validation_results = $this->oCRNRSTN_USR->validate_css($raw_html_data);

                    $tmp_key = $this->oCRNRSTN_USR->generate_new_key(50);

                    $this->oCRNRSTN_USR->set_session_param('DISPLAY_AUTH_KEY', $tmp_key);
                    $this->oCRNRSTN_USR->set_session_param('CRNRSTN_CSS_VALIDATION_RESP', $tmp_validation_results['HTML_OUT']);

                    $tmp_score_numeric_raw = $tmp_validation_results['SCORE_NUMERIC_RAW'];  //$this->oCRNRSTN_USR->get_session_param('SCORE_NUMERIC_RAW');
                    $tmp_packet_size = $tmp_validation_results['PACKET_BYTES_SIZE'];  //$this->oCRNRSTN_USR->get_session_param('PACKET_BYTES_SIZE');
                    $tmp_run_time = $tmp_validation_results['WALLTIME'];    //$this->oCRNRSTN_USR->get_session_param('WALLTIME');

                    $tmp_array[] = 'crnrstn_l=' . $this->oCRNRSTN_USR->data_encrypt('css_validator');
                    $tmp_array[] = 'crnrstn_css_rtime=' . urlencode($tmp_run_time . ' secs');
                    $tmp_array[] = 'bytes=' . urlencode($tmp_packet_size);
                    $tmp_array[] = 'score='.urlencode($tmp_score_numeric_raw);

                    error_log(__LINE__ . ' ui snap CSS SCORE ARRAY'.print_r($tmp_array, true));

                    //
                    // SUPPORT BACK LINK FOR MIT LICENSE PAGE
                    $this->oCRNRSTN_USR->sync_back_link_state();

                    $tmp_post_url = $this->oCRNRSTN_USR->append_url_param($tmp_array, false);

                    error_log(__LINE__ . ' ui snap CSS SCORE ARRAY'.print_r($tmp_post_url, true));

                    //$this->oCRNRSTN_USR->apply_headers();
                    //header("Location: $tmp_post_url", true);

                    //
                    // I WOULD LIKE TO SEE GOOGLE ANALYTICS DATA WITH CSS SCORES AND PERFORMANCE OF THE SYSTEM.
                    $this->oCRNRSTN_USR->proper_response_return($tmp_post_url, NULL, 'POST_REDIRECT');
//
//                }else{
//
//                    //
//                    // SUPPORT BACK LINK FOR MIT LICENSE PAGE
//                    $this->oCRNRSTN_USR->sync_back_link_state();
//
//                    $this->oCRNRSTN_USR->proper_response_return($this->oCRNRSTN_USR->ui_module_out('css_validator'), NULL, 'RESPONSE_STICKY');
//
//                }

            break;
            case CRNRSTN_RESOURCE_ALL:

                $this->oCRNRSTN_USR->reset_auth_account();
                //error_log(__LINE__ . ' vsc process ORGANIC _GET...');

                //
                // ORGANIC REQUEST HANDLING (as in...like...e.g...idk...um...maybe..$_GET) - NO FORM POST
                if(isset($this->oCRNRSTN_AUTH)){

                    //if($this->oCRNRSTN_AUTH->is_logged_in()){
                        if($this->oCRNRSTN_USR->isset_http_param('crnrstn_l', 'GET')){
                            //error_log(__LINE__ . ' vsc isset_http_param time...');

                            $tmp_req = $this->oCRNRSTN_USR->extract_data_http('crnrstn_l', 'GET', true);             // GETS YOU IN THE DOOR
                            $tmp_mit = $this->oCRNRSTN_USR->extract_data_http('crnrstn_mit', 'GET', true);           // GETS YOU LICENSE...ALWAYS
                            $tmp_crnrstn_r = $this->oCRNRSTN_USR->extract_data_http('crnrstn_r', 'GET', true);       // INDICATION OF REDIRECT
                            $tmp_crnrstn_kivotos = $this->oCRNRSTN_USR->extract_data_http('crnrstn_kivotos');        // YOU ARE SECURELY IN THE BOX..? OR USE SESSION...
                            $tmp_crnrstn_css_rtime = $this->oCRNRSTN_USR->extract_data_http('crnrstn_css_rtime');    // INDICATION OF CSS VALIDATOR RESULTS OUT
                            $tmp_crnrstn_css_valptrn = $this->oCRNRSTN_USR->extract_data_http('crnrstn_css_valptrn');// INDICATION OF CSS VALIDATOR ALGORITHM OUT

                            //error_log(__LINE__ . ' ui snap DIE() $tmp_req=' . $tmp_req);
                            //die();
                            //
                            // HANDLE "ONE OFF" REDIRECTS,  MIT LICENSE, AND CSS VALIDATION OUTPUT PAGES
                            if((strlen($tmp_mit) > 0) || (strlen($tmp_crnrstn_css_rtime) > 0) || (strlen($tmp_crnrstn_css_valptrn) > 0) || (strlen($tmp_crnrstn_r) > 0)){

                                if($tmp_crnrstn_r != ''){

                                    return $this->oCRNRSTN_USR->proper_response_return($this->oCRNRSTN_USR->sticky_uri_listener(), NULL, 'RESPONSE_STICKY');

                                }else{

                                    if($tmp_mit != ''){

                                        return $this->oCRNRSTN_USR->proper_response_return($this->oCRNRSTN_USR->ui_module_out('MIT_license'), NULL, 'RESPONSE_STICKY');

                                    }else{

                                        if($tmp_crnrstn_css_valptrn != ''){

                                            return $this->oCRNRSTN_USR->proper_response_return($this->oCRNRSTN_USR->ui_module_out('css_validator_profile'), NULL, 'RESPONSE_STICKY');

                                        }else{

                                            //
                                            // OUTPUT CSS VALIDATOR RESULTS PAGE FROM SESSION
                                            $tmp_validation_results = $this->oCRNRSTN_USR->get_session_param('CRNRSTN_CSS_VALIDATION_RESP');

                                            if(strlen($tmp_validation_results) > 1){

                                                $this->oCRNRSTN_USR->set_session_param('CRNRSTN_CSS_VALIDATION_RESP','0');

                                                //
                                                // RETURN CSS VALIDATION SCORE RESULTS PAGE
                                                return $this->oCRNRSTN_USR->proper_response_return($tmp_validation_results, NULL, 'POST_REDIRECT');

                                            }else{

                                                //
                                                // DATA ENTRY FORM PAGE. OR MAYBE THIS WILL BECOME SIGN IN FORM PAGE.
                                                return $this->oCRNRSTN_USR->proper_response_return($this->oCRNRSTN_USR->ui_module_out('css_validator'), NULL, 'REDIRECT_SANS_POST');

                                            }

                                        }

                                    }

                                }

                            }else{

                                switch($tmp_req){
                                    case 'config_wordpress':

                                        $this->output_str = $this->oCRNRSTN_USR->ui_module_out($tmp_req);

                                    break;
                                    case 'dashboard':

                                        $this->output_str = $this->oCRNRSTN_USR->ui_module_out($tmp_req);

                                    break;
                                    case 'signin':

                                        $this->oCRNRSTN_USR->reset_auth_account();
                                        return $this->oCRNRSTN_USR->ui_module_out($tmp_req);

                                    break;
                                    case 'signin_m':

                                        $this->oCRNRSTN_USR->reset_auth_account();
                                        return $this->oCRNRSTN_USR->ui_module_out($tmp_req);

                                    break;
                                    case 'css_validator':

                                        if($this->oCRNRSTN_USR->isset_http_param('crnrstn_r', 'GET')){

                                            return $this->oCRNRSTN_USR->proper_response_return($this->oCRNRSTN_USR->sticky_uri_listener(), NULL, 'RESPONSE_STICKY');

                                        }else{

                                            if(strlen($tmp_crnrstn_css_rtime) > 0){

                                                $tmp_validation_results = $this->oCRNRSTN_USR->get_session_param('CRNRSTN_CSS_VALIDATION_RESP');
                                                error_log(__LINE__ . ' css_rtime is set. get_session_param results[' . strlen($tmp_validation_results).']');

                                                if(strlen($tmp_validation_results) > 1){

                                                    $this->oCRNRSTN_USR->set_session_param('CRNRSTN_CSS_VALIDATION_RESP','0');

                                                    //
                                                    // VALIDATION SCORE RESULTS PAGE
                                                    return $this->oCRNRSTN_USR->proper_response_return($tmp_validation_results, NULL, 'RESPONSE_SANS_POST');

                                                }else{

                                                    //
                                                    // DATA ENTRY FORM PAGE
                                                    return $this->oCRNRSTN_USR->proper_response_return($this->oCRNRSTN_USR->ui_module_out('css_validator'), NULL, 'RESPONSE_SANS_POST');

                                                }

                                            }else{

                                                error_log(__LINE__ . ' css_rtime is NOT set.');

                                                if($this->oCRNRSTN_USR->isset_http_param('crnrstn_css_valptrn', 'GET')){

                                                    //
                                                    // VALIDATOR ALGORITHM LOGICAL PROFILE PRESENTATION PAGE
                                                    $this->oCRNRSTN_USR->proper_response_return($this->oCRNRSTN_USR->ui_module_out('css_validator_profile'), NULL, 'RESPONSE_STICKY');

                                                }else{

                                                    error_log(__LINE__ . ' crnrstn_css_valptrn is NOT set.');

                                                    //
                                                    // DATA ENTRY FORM PAGE
                                                    $this->oCRNRSTN_USR->proper_response_return($this->oCRNRSTN_USR->ui_module_out('css_validator'), NULL, 'RESPONSE_SANS_POST');

                                                }

                                            }

                                        }

                                        break;
                                    default:

                                        return false;

                                    break;

                                }

                            }

                        }else{

                            //error_log(__LINE__ . ' vsc process ORGANIC _GET...');

                            $this->oCRNRSTN_USR->proper_response_return();
                            return '';

                        }

                    //}

                }else{

                    error_log(__LINE__ . ' vsc isset_http_param time...');

                    if($this->oCRNRSTN_USR->isset_http_param('crnrstn_l', 'GET')){

                        $tmp_req = $this->oCRNRSTN_USR->extract_data_http('crnrstn_l', 'GET', true);             // GETS YOU IN THE DOOR
                        $tmp_mit = $this->oCRNRSTN_USR->extract_data_http('crnrstn_mit', 'GET');                 // GETS YOU LICENSE...ALWAYS

                        if($this->oCRNRSTN_USR->isset_http_param('crnrstn_r', 'GET')) {

                            $tmp_crnrstn_r = $this->oCRNRSTN_USR->extract_data_http('crnrstn_r', 'GET', true);       // INDICATION OF REDIRECT

                        }else{

                            $tmp_crnrstn_r = '';

                        }

                        $tmp_crnrstn_kivotos = $this->oCRNRSTN_USR->extract_data_http('crnrstn_kivotos');        // YOU ARE SECURELY IN THE BOX..? OR USE SESSION...
                        $tmp_crnrstn_css_rtime = $this->oCRNRSTN_USR->extract_data_http('crnrstn_css_rtime');    // INDICATION OF CSS VALIDATOR RESULTS OUT
                        $tmp_crnrstn_css_valptrn = $this->oCRNRSTN_USR->extract_data_http('crnrstn_css_valptrn');// INDICATION OF CSS VALIDATOR ALGORITHM OUT

                        //error_log(__LINE__ . ' ui snap DIE() $tmp_req=' . $tmp_req);
                        //die();
                        //
                        // HANDLE "ONE OFF" REDIRECTS,  MIT LICENSE, AND CSS VALIDATION OUTPUT PAGES
                        if((strlen($tmp_mit) > 0) || (strlen($tmp_crnrstn_css_rtime) > 0) || (strlen($tmp_crnrstn_css_valptrn) > 0) || (strlen($tmp_crnrstn_r) > 0)){

                            if($tmp_crnrstn_r != ''){

                                return $this->oCRNRSTN_USR->proper_response_return($this->oCRNRSTN_USR->sticky_uri_listener(), NULL, 'RESPONSE_STICKY');

                            }else{

                                if($tmp_mit != ''){

                                    return $this->oCRNRSTN_USR->proper_response_return($this->oCRNRSTN_USR->ui_module_out('MIT_license'), NULL, 'RESPONSE_STICKY');

                                }else{

                                    if($tmp_crnrstn_css_valptrn != ''){

                                        return $this->oCRNRSTN_USR->proper_response_return($this->oCRNRSTN_USR->ui_module_out('css_validator_profile'), NULL, 'RESPONSE_STICKY');

                                    }else{

                                        //
                                        // OUTPUT CSS VALIDATOR RESULTS PAGE FROM SESSION
                                        $tmp_validation_results = $this->oCRNRSTN_USR->get_session_param('CRNRSTN_CSS_VALIDATION_RESP');

                                        if(strlen($tmp_validation_results) > 1){

                                            $this->oCRNRSTN_USR->set_session_param('CRNRSTN_CSS_VALIDATION_RESP','0');

                                            //
                                            // RETURN CSS VALIDATION SCORE RESULTS PAGE
                                            return $this->oCRNRSTN_USR->proper_response_return($tmp_validation_results, NULL, 'RESPONSE_STICKY');

                                        }else{

                                            //
                                            // DATA ENTRY FORM PAGE. OR MAYBE THIS WILL BECOME SIGN IN FORM PAGE.
                                            return $this->oCRNRSTN_USR->proper_response_return($this->oCRNRSTN_USR->ui_module_out('css_validator'), NULL, 'REDIRECT_SANS_POST');

                                        }

                                    }

                                }

                            }

                        }else{

                            error_log(__LINE__ . 'vsc _GET to load USE CASE[' . $tmp_req.']');

                            switch($tmp_req){
                                case 'config_wordpress':

                                    return $this->oCRNRSTN_USR->ui_module_out($tmp_req);

                                break;
                                case 'dashboard':

                                    return $this->oCRNRSTN_USR->ui_module_out($tmp_req);

                                break;
                                case 'signin':

                                    return $this->oCRNRSTN_USR->ui_module_out($tmp_req);

                                break;
                                case 'signin_m':

                                    return $this->oCRNRSTN_USR->ui_module_out($tmp_req);

                                break;
                                case 'css_validator':

                                    if($this->oCRNRSTN_USR->isset_http_param('crnrstn_r', 'GET')){

                                        return $this->oCRNRSTN_USR->proper_response_return($this->oCRNRSTN_USR->sticky_uri_listener(), NULL, 'RESPONSE_STICKY');

                                    }else{

                                        if(strlen($tmp_crnrstn_css_rtime) > 0){

                                            $tmp_validation_results = $this->oCRNRSTN_USR->get_session_param('CRNRSTN_CSS_VALIDATION_RESP');
                                            error_log(__LINE__ . ' css_rtime is set. get_session_param results[' . strlen($tmp_validation_results).']');

                                            if(strlen($tmp_validation_results) > 1){

                                                $this->oCRNRSTN_USR->set_session_param('CRNRSTN_CSS_VALIDATION_RESP','0');

                                                //
                                                // VALIDATION SCORE RESULTS PAGE
                                                return $this->oCRNRSTN_USR->proper_response_return($tmp_validation_results, NULL, 'RESPONSE_SANS_POST');

                                            }else{

                                                //
                                                // DATA ENTRY FORM PAGE
                                                return $this->oCRNRSTN_USR->proper_response_return($this->oCRNRSTN_USR->ui_module_out('css_validator'), NULL, 'RESPONSE_SANS_POST');

                                            }

                                        }else{

                                            error_log(__LINE__ . ' css_rtime is NOT set.');

                                            if($this->oCRNRSTN_USR->isset_http_param('crnrstn_css_valptrn', 'GET')){

                                                //
                                                // VALIDATOR ALGORITHM LOGICAL PROFILE PRESENTATION PAGE
                                                $this->oCRNRSTN_USR->proper_response_return($this->oCRNRSTN_USR->ui_module_out('css_validator_profile'), NULL, 'RESPONSE_STICKY');

                                            }else{

                                                error_log(__LINE__ . ' crnrstn_css_valptrn is NOT set.');

                                                //
                                                // DATA ENTRY FORM PAGE
                                                $this->oCRNRSTN_USR->proper_response_return($this->oCRNRSTN_USR->ui_module_out('css_validator'), NULL, 'RESPONSE_SANS_POST');

                                            }

                                        }

                                    }

                                break;
                                default:

                                    return false;

                                break;

                            }

                        }

                    }else{

                        //error_log(__LINE__ . ' vsc process ORGANIC _GET...');

                        $this->oCRNRSTN_USR->proper_response_return('', NULL, 'RESPONSE_SANS_POST');

                        return '';

                    }
                    //error_log(__LINE__ . ' vsc isset_http_param time...');

                    return '';

                }

            break;
            default:
                //
                // PROCESS $_GET ABOVE ^^

            break;

        }

        return NULL;

    }

//    public function initialize_authorization($resource = NULL){
//
//        if ($this->isset_session_param('CRNRSTN_AUTHORIZED_ACCOUNT')) {
//
//            $this->oCRNRSTN_AUTH = unserialize($this->get_session_param('CRNRSTN_AUTHORIZED_ACCOUNT'));
//
//            if (!$this->oCRNRSTN_AUTH->maintain_valid_session()) {
//
//                //
//                // REDIRECT TO SIGNIN PAGE
//                $tmp_uri = $this->return_login_link();
//
//                header("Location: $tmp_uri");
//                exit();
//
//            }
//
//        }

        /*

                    switch($tmp_form_handle){
                        case 'crnrstn_signin_flagship':
                        case 'crnrstn_signin_wireframe':

                            if(!isset($this->oCRNRSTN_AUTH)){

                                $this->oCRNRSTN_AUTH = new crnrstn_user_auth($this);

                            }

                            $this->oCRNRSTN_AUTH->initialize_user_login_attempt();

                            if($tmp_oCRNRSTN_AUTH = $this->oCRNRSTN_AUTH->process_authorization()){



                                echo $this->ui_module_out('dashboard');
                                exit();

                            }else{

                                echo $this->ui_module_out('signin');
                                exit();

                            }

                        break;
                        case 'crnrstn_validate_css':
    //                        error_log(__LINE__ . ' user POST CSS PROCESS = TRUE');
    //
    //                        if ($this->isset_crnrstn_services_http('POST')) {
    //                            error_log(__LINE__ . ' user POST CSS isset_crnrstn_services_http = TRUE');
    //
    //                            //
    //                            // VALIDATE CSS
    //                            $raw_html_data = $this->extract_data_http('ugc_html', 'POST');
    //
    //                            $tmp_validation_results = $this->validate_css($raw_html_data);
    //                            error_log(__LINE__ . ' user POST CSS $tmp_validation_results cnt = '.strlen($tmp_validation_results));
    //
    //                            $tmp_key = $this->generate_new_key(50);
    //
    //                            $this->set_session_param('DISPLAY_AUTH_KEY', $tmp_key);
    //                            $this->set_session_param('CRNRSTN_CSS_VALIDATION_RESP', $tmp_validation_results);
    //
    //                            $tmp_score_numeric_raw = $this->get_session_param('SCORE_NUMERIC_RAW');
    //                            $tmp_packet_size = $this->get_session_param('PACKET_BYTES_SIZE');
    //                            $tmp_run_time = $this->get_session_param('WALLTIME');
    //                            $tmp_run_time = $tmp_run_time.'secs';
    //
    //                            if($this->is_ssl()){
    //
    //                                $tmp_post_uri = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    //
    //                            }else{
    //
    //                                $tmp_post_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    //
    //                            }
    //
    //                            $pos_quest = strpos($tmp_post_uri,'?');
    //                            if($pos_quest !== false){
    //
    //                                $tmp_post_uri = $tmp_post_uri . '&crnrstn_l=css_validator&css_rtime=' . urlencode($tmp_run_time) . '&bytes='.urlencode($tmp_packet_size) . '&score='.urlencode($tmp_score_numeric_raw);
    //
    //                            }else{
    //
    //                                $tmp_post_uri = $tmp_post_uri . '?crnrstn_l=css_validator&css_rtime=' . urlencode($tmp_run_time) . '&bytes='.urlencode($tmp_packet_size) . '&score='.urlencode($tmp_score_numeric_raw);
    //
    //                            }
    //
    //                            //
    //                            // SUPPORT BACK LINK FOR MIT LICENSE PAGE
    //                            $this->sync_back_link_state();
    //
    //                            error_log(__LINE__ . ' user POST CSS $tmp_post_uri = ' . $tmp_post_uri);
    //
    //                            //
    //                            // I WOULD LIKE TO SEE GOOGLE ANALYTICS DATA WITH CSS SCORES AND PERFORMANCE OF THE SYSTEM.
    //                            header("Location: ".$tmp_post_uri);
    //                            exit();
    //
    //                        }else{
    //                            error_log(__LINE__ . __METHOD__ . ' user $user_auth_check is true');
    //
    //                            //
    //                            // SUPPORT BACK LINK FOR MIT LICENSE PAGE
    //                            $this->sync_back_link_state();
    //
    //                            echo $this->ui_module_out('css_validator');
    //                            exit();
    //
    //                        }

                        break;
                        default:

                            return false;

                        break;

                    }
        */

//    }

    public function __destruct() {

    }

}
