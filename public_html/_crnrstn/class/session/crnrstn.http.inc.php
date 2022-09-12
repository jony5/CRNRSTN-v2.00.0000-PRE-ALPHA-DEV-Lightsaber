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
#  CLASS :: crnrstn_http_manager
#  VERSION :: 1.00.0001
#  DATE :: October 24, 2014 @ 1819hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: Testing for and retrieving data received via HTTP.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_http_manager {

	public $http_headers_ARRAY;
	public $http_headers_string;

    protected $oLogger;
	public $oCRNRSTN;
    public $oCRNRSTN_ENV;
    public $oCRNRSTN_USR;

	private static $postHttpData;
	private static $getHttpData;

	private static $relevant_header_fields_ARRAY = array();

    public $client_header_field_data_ARRAY = array();

    public $oMOBI_DETECT;
    public $isMobile;
    public $isTablet;
    public $device_detected = false;

    public $customClientDevice = array();

    public $form_integration_isset_ARRAY = array();

    public function __construct($oCRNRSTN, $oCRNRSTN_ENV) {

        $this->oCRNRSTN = $oCRNRSTN;
        $this->oCRNRSTN_ENV = $oCRNRSTN_ENV;
        $this->oCRNRSTN_USR = $oCRNRSTN_ENV->return_oCRNRSTN_USR();

        self::$relevant_header_fields_ARRAY = array('Accept', 'Accept-Charset', 'Accept-Datetime', 'Accept-Encoding', 'Accept-Language',
        'Authorization', 'Cache-Control', 'Connection', 'Content-Encoding', 'Content-Length', 'Content-MD5', 'Content-Type', 'Cookie',
        'Date', 'Expect', 'Forwarded', 'Host', 'Proxy-Authorization', 'Range', 'Referer', 'User-Agent', 'Warning', 'X-Requested-With',
        'DNT', 'X-Forwarded-For', 'X-Forwarded-Host', 'X-Forwarded-Proto', 'X-Wap-Profile', 'X-UIDH[34][35][36]');

	    //
        // LOAD CLIENT HEADERS
	    $this->http_headers_ARRAY = $this->getHeaders();
        $this->http_headers_string = $this->getHeaders('string');
        
	    //
        // INITIALIZE CLIENT PROFILE
        $this->load_client_profile();

        //
        // INITIALIZE CRNRSTN :: CHANNEL
        $this->init_channel();

	    /*
	    //
	    // March 31, 2021 1254hrs
	    // Just finished most (if not all) of the bitwise management within
	    // CRNRSTN :: for a CSS validation for Email HTML messaging project.
	    //
	    // http://css.validator.jony5.com
	    //
	    // * THIS IS A RE-ARCHITECTURE OF A 2008 PROJECT. THIS DEMONSTRATION WILL FLEX
	    //   THE DEVELOPMENT OF THE CRNRSTN :: BITWISE MANAGEMENT ENGINE TO STRENGTHEN
	    //   THE USE-CASE SUPPORT CONTAINED THEREIN TO BOTH MAXIMIZE OPPORTUNITIES FOR
	    //   AND SIMPLIFY IMPLEMENTATION OF PLANNED AND UPCOMING RE-ARCHITECTURES OF
	    //   CRNRSTN :: TO REMOVE (1) ALL THROW-A-FLAG-BASED ARCHITECTURES AND (2) ALL
	    //   SINGLE-SERVING BOOLEAN PARAMETER DATA STRUCTURES AND TO REPLACE THEM WITH
	    //   A CRNRSTN :: FRAMEWORK-MERGED AND INTEGER-BASED-BITWISE-DRIVEN PROTOCOL.
	    //
	    // Now I need to finish the other little details around this micro-site and
	    // RTM it to production before I can get back to this HTTP manager class (even
	    // before I can get back to all of CRNRSTN :: ) re-architecture initiative for
	    // low level multi-language integrations into CRNRSTN :: which key off of HTTP
	    // header Accept-language datum.
	    //
	    // "Also, my rug was stolen."  - the dude
	    //
	    // Also, my driver's license was just taken and on a day that I spent over $200
	    // for both me and J5, my boy, at Ruth's Chris Steakhouse. The Lord Spirit gives
	    // me no leading to make any move to replace my missing license...imagine that!
	    //
	    // Yesterday, or even today, I was going to go back to Ruth's Chris Steakhouse
	    // for another $150 (or whatever) steak. Apparently, I gave the first one THAT
	    // I EVER BOUGHT to my dog, and, as it turns out, the steak I ate was like $50
	    // or something.
	    //
	    // I don't know when I'll ever get to go back for that steak. Until then, only
	    // my dog knows this satisfaction; I still have yet to make this my own, and now
	    // the experience is being kept from me by Satan and his devils.
	    //
	    // Well, since I will not jump through any hoops to fix the situation without
	    // my Lord being "on board" with it. It looks like I will be having plenty
	    // of time in these days to make good progress on all of these HTTP_MANAGER things!
	    //
	    // Praise God! Even in the midst of suffering, the Lord is merciful.
	    //
	    // Upon having such a realization...why should I (and, dang-it, why would I)
	    // allow anyone or anything to hinder this project for any reason?
	    //
	    // Are you guys silly...still gonna send it!
	    //
	    // Now,...at this moment...THIS shit is becoming all gravy, baby!
	    //
	    // Jonathan J5 Harris and J5
	    // Wednesday, March 31, 2021 1356hrs
	    // https://www.youtube.com/watch?v=WIrWyr3HgXI
	    // TITLE :: Are you silly? I'm still gonna send it


        //
	    // Notes from March (5th-ish?) of 2021
	    // SOURCE :: https://en.wikipedia.org/wiki/List_of_HTTP_header_fields
        List of HTTP header fields

	    The header fields are transmitted after the request line (in case of a
	    request HTTP message) or the response line (in case of a response HTTP
	    message), which is the first line of a message.

	    Header fields are colon-separated key-value pairs in clear-text string
	    format, terminated by a carriage return (CR) and line feed (LF)
	    character sequence.

	    The end of the header section is indicated by an empty field line,
	    resulting in the transmission of two consecutive CR-LF pairs.

	    A few fields can contain comments (i.e. in User-Agent, Server, Via
	    fields), which can be ignored by software.

        Many field values may contain a quality (q) key-value pair separated
	    by equals sign, specifying a weight to use in content negotiation.[8]
	    For example, a browser may indicate that it accepts information in
	    German or English, with German as preferred by setting the q value
	    for de higher than that of en, as follows:

	    Accept-Language: de; q=1.0, en; q=0.5

	    The standard imposes no limits to the size of each header field name
	    or value, or to the number of fields. However, most servers, clients,
	    and proxy software impose some limits for practical and security
	    reasons. For example, the Apache 2.3 server by default limits the
	    size of each field to 8,190 bytes, and there can be at most 100
	    header fields in a single request.

        Request fields
            Accept
            Accept-Charset
            Accept-Datetime
            Accept-Encoding
            Accept-Language
            Authorization
            Cache-Control
            Connection
            Content-Encoding
            Content-Length
            Content-MD5
            Content-Type
            Cookie
            Date
            Expect
            Forwarded
            Host
            Proxy-Authorization
            Range
            Referer
            User-Agent
            Warning
            X-Requested-With
            DNT
            X-Forwarded-For
            X-Forwarded-Host
            X-Forwarded-Proto
            X-Wap-Profile
            X-UIDH[34][35][36]




        Response fields
            Access-Control-Allow-Origin,
            Access-Control-Allow-Credentials,
            Access-Control-Expose-Headers,
            Access-Control-Max-Age,
            Access-Control-Allow-Methods,
            Access-Control-Allow-Headers[11
            Accept-Ranges
            Allow
            Cache-Control
            Content-Disposition[48]
            Content-Encoding
            Content-Language
            Content-Length
            Content-Range
            Content-Type
            Date
            Expires
            Last-Modified
            Location
            Proxy-Authenticate
            Retry-After
            Server
            Set-Cookie
            Tk
                Tracking Status header, value suggested to be sent in response to a DNT(do-not-track), possible values:
                    "!" — under construction
                    "?" — dynamic
                    "G" — gateway to multiple parties
                    "N" — not tracking
                    "T" — tracking
                    "C" — tracking with consent
                    "P" — tracking only if consented
                    "D" — disregarding DNT
                    "U" — updated

            Warning
            Refresh
            Status
            X-Content-Type-Options[61]
            X-Powered-By[64]

        = = = = = = =
        https://www.php.net/manual/en/function.header.php
        mjt at jpeto dot net ¶
        I strongly recommend, that you use

        header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");

        instead of

        header("HTTP/1.1 404 Not Found");

        I had big troubles with an Apache/2.0.59 (Unix) answering in HTTP/1.0 while I (accidentially) added
        a "HTTP/1.1 200 Ok" - Header.

        Most of the pages were displayed correct, but on some of them apache added weird content to it:

        A 4-digits HexCode on top of the page (before any output of my php script), seems to be some kind of
        checksum, because it changes from page to page and browser to browser. (same code for same page and browser)

        "0" at the bottom of the page (after the complete output of my php script)

        It took me quite a while to find out about the wrong protocol in the HTTP-header.
        = = = = = = =

    */

	}

	public function return_client_header_value($header_attribute, $index = 0){

        $header_attribute_nom_LOWER = strtolower($header_attribute);

        return $this->client_header_field_data_ARRAY[$header_attribute_nom_LOWER][$index];

    }

//    public function return_client_accept_language_array($oCRNRSTN_LANG_MGR, $header_accept_language){
//
//        $tmp_array = array();
//
//        if(!isset($header_accept_language)){
//
//            $header_accept_language = $this->return_client_header_value('Accept-Language');
//
//        }
//
//        $tmp_len = strlen($header_accept_language);
//
//        if($tmp_len == 0){
//
//            $tmp_array[] = 0;
//
//            return $tmp_array;
//
//        }
//
//        /*
//        HONOR *
//        HONOR BASE TAG ONLY
//        HONOR BASE TAG WITH META
//        HONOR BASE TAG WITH META + FACTOR WEIGHTING
//        */
//
//        $oCRNRSTN_LANG_MGR->consume_accept_language_data($header_accept_language);
//
//        return $tmp_array;
//
//    }

    public function sync_device_detected(){

        if($this->oCRNRSTN->isset_data_key('CRNRSTN_DEVICE_DETECTED')){
        //if($this->oCRNRSTN_USR->isset_session_param('CRNRSTN_DEVICE_DETECTED')){

            //oCRNRSTN->get_resource($data_key, $index = 0, $data_type_family = NULL, $soap_transport = false)

            $tmp_channel_int_constant = (int) $this->oCRNRSTN->get_resource('CRNRSTN_DEVICE_DETECTED');  // , $data_family_str
            //$tmp_channel_int_constant = (int) $this->oCRNRSTN_USR->get_session_param('CRNRSTN_DEVICE_DETECTED');

            //error_log(__LINE__ . ' http CRNRSTN_DEVICE_DETECTED [' . $tmp_channel_int_constant.']');

            //$this->oCRNRSTN_USR->toggle_bit($tmp_channel_int_constant, true);

            return $this->set_client($tmp_channel_int_constant);

        }else{

            //
            // DETECT APPROPRIATE CHANNEL AND SYNC SESSION
            if($this->is_client_mobile()){

                //error_log(__LINE__ . ' http is_client_mobile [' . CRNRSTN_UI_MOBILE . ']');

                return $this->set_client_mobile();

            }else{

                if($this->is_client_tablet()){

                    //error_log(__LINE__ . ' http is_client_tablet [' . CRNRSTN_UI_TABLET . ']');

                    return $this->set_client_tablet();

                }else{

                    //error_log(__LINE__ . ' http set_client_desktop [' . CRNRSTN_UI_DESKTOP . ']');

                    return $this->set_client_desktop();

                }

            }

        }

    }

    public function __sync_device_detected(){

        //$this->oCRNRSTN_USR = $oCRNRSTN_USR;

        if($this->oCRNRSTN_USR->isset_session_param('CRNRSTN_DEVICE_DETECTED')){

            $tmp_channel_int_constant = (int) $this->oCRNRSTN->get_resource('CRNRSTN_DEVICE_DETECTED');

            //error_log(__LINE__ . ' http CRNRSTN_DEVICE_DETECTED [' . $tmp_channel_int_constant.']');

            //$this->oCRNRSTN_USR->toggle_bit($tmp_channel_int_constant, true);

            return $this->set_client($tmp_channel_int_constant);

        }else{

            //
            // DETECT APPROPRIATE CHANNEL AND SYNC SESSION
            if($this->is_client_mobile()){

                error_log(__LINE__ . ' http is_client_mobile ['.CRNRSTN_UI_MOBILE.']');

                return $this->set_client_mobile();

            }else{

                if($this->is_client_tablet()){

                    error_log(__LINE__ . ' http is_client_tablet ['.CRNRSTN_UI_TABLET.']');

                    return $this->set_client_tablet();

                }else{

                    //error_log(__LINE__ . ' http set_client_desktop ['.CRNRSTN_UI_DESKTOP.']');

                    return $this->set_client_desktop();

                }

            }

        }

    }

	private function load_client_profile(){

        foreach ($this->http_headers_ARRAY as $attribute_nom => $attrib_value) {

            $attribute_nom = strtolower($attribute_nom);

            if($this->is_crnrstn_relevant($attribute_nom)){

                $this->initialize_client_profile($attribute_nom, $attrib_value);

            }

	    }

    }

    public function http_data_services_initialize($user_auth_check = false, $uri_passthrough = false, $cipher_override = NULL, $secret_key_override = NULL, $hmac_algorithm_override = NULL, $options_bitwise_override = NULL){

        $tmp_has_getpost_data = false;

        //
        // ESTABLISH SEQUENCE TO CHECK FOR crnrstn_pssdtl_packet
        $tmp_variables_order = $this->oCRNRSTN->ini_get('variables_order');
        $tmp_vo_ARRAY = str_split($tmp_variables_order);

        /*
        Sets the order of the EGPCS (Environment, Get, Post, Cookie, and Server) variable
        parsing. For example, if variables_order is set to "SP" then PHP will create the superglobals
        $_SERVER and $_POST, but not create $_ENV, $_GET, and $_COOKIE. Setting to "" means no
        superglobals will be set.

        */

        foreach($tmp_vo_ARRAY as $key => $value){

            switch($value){
                case 'G':

                    //
                    // DO WE HAVE GET DATA?
                    if($this->issetHTTP($_GET)) {
                        error_log(__LINE__ . ' http CHECKING FOR PRESENCE OF $_GET...crnrstn_pssdtl_packet');

                        //
                        // CHECK FOR PRESENCE OF FORM INTEGRATION PACKET DATA
                        if ($this->issetParam($_GET, 'crnrstn_pssdtl_packet')) {

                            //error_log('4418 user - process crnrstn_pssdtl_packet @ _GET');
                            $tmp_has_getpost_data = true;

                            $tmp_is_encrypted = '';
                            if ($this->issetParam($_GET, 'crnrstn_pssdtl_packet_ENCRYPTED')) {

                                $tmp_is_encrypted = strtolower($this->extractData($_GET, 'crnrstn_pssdtl_packet_ENCRYPTED'));

                            }

                            if ($tmp_is_encrypted == 'true') {

                                //error_log('4429 user - decrypt crnrstn_pssdtl_packet @ _GET');
                                $this->consume_form_integration_packet($this->oCRNRSTN->data_decrypt($this->extractData($_GET, 'crnrstn_pssdtl_packet'), CRNRSTN_ENCRYPT_TUNNEL, false, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override), 'GET');

                            } else {

                                //error_log('4434 user - decrypt crnrstn_pssdtl_packet @ _GET');
                                $this->consume_form_integration_packet($this->extractData($_GET, 'crnrstn_pssdtl_packet'), 'GET');

                            }

                        }

                    }

                break;
                case 'P':

                    if ($this->issetHTTP($_POST)) {
                        error_log(__LINE__ . ' http CHECKING FOR PRESENCE OF $_POST...crnrstn_pssdtl_packet');

                        //
                        // CHECK FOR PRESENCE OF PSSDTL PACKET DATA
                        if($this->issetParam($_POST, 'crnrstn_pssdtl_packet')){


                            return '<strong>hello world!</strong>';

                            $tmp_has_getpost_data = true;

                            $tmp_is_encrypted = 'true';
//                            if ($this->issetParam($_POST, 'CRNRSTN_INTEGRATION_PACKET_ENCRYPTED')) {
//
//                                $tmp_is_encrypted = strtolower($this->extractData($_POST, 'crnrstn_pssdtl_packet_ENCRYPTED'));
//
//                            }

                            if($tmp_is_encrypted == 'true'){

                                //error_log(__LINE__ . ' user auth  $tmp_is_encrypted is true. Decrypting crnrstn_pssdtl_packet=[' . $this->extractData($_POST, 'crnrstn_pssdtl_packet') . ']');
                                $uri_passthrough = true;
                                $tmp_output = $this->oCRNRSTN->data_decrypt($this->extractData($_POST, 'crnrstn_pssdtl_packet'), CRNRSTN_ENCRYPT_TUNNEL, $uri_passthrough, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override);
                                //error_log(__LINE__ . ' http auth  $tmp_is_encrypted is true. DONE Decrypting crnrstn_pssdtl_packet to [' . $tmp_output . '][' . $this->extractData($_POST, 'crnrstn_pssdtl_packet') . '].');
                                error_log(__LINE__ . ' http crnrstn_pssdtl_packet (decrypted) = [' . $tmp_output . '].');

                                error_log(__LINE__ . ' http CONSUME $_POST...crnrstn_pssdtl_packet AFTER DECRYPT.');
                                $this->consume_form_integration_packet($tmp_output, 'POST');

                            } else {

                                error_log(__LINE__ . ' user CONSUME $_POST...crnrstn_pssdtl_packet...AND NO DECRYPT.');
                                $this->consume_form_integration_packet($this->extractData($_POST, 'crnrstn_pssdtl_packet'), 'POST');

                            }

                        }

                    }

                    break;

            }

        }

//
//        if(isset($tmp_form_handle)) {
//
//            switch ($tmp_form_handle) {
//                case 'crnrstn_signin_flagship':
//                case 'crnrstn_signin_wireframe':
//
//
//                break;
//                case 'crnrstn_validate_css':
//
//                    if ($this->isset_crnrstn_svc_http('POST')) {
//                        error_log(__LINE__ . ' user POST CSS isset_crnrstn_svc_http = TRUE');
//
//                        //
//                        // VALIDATE CSS
//                        $raw_html_data = $this->extract_data_HTTP('ugc_html', 'POST');
//
//                        $tmp_validation_results_ARRAY = $this->validate_css($raw_html_data);
//
//                        $tmp_validation_results = $tmp_validation_results_ARRAY['HTML_OUT'];
//
//                        error_log(__LINE__ . ' user POST CSS $tmp_validation_results cnt = ' . strlen($tmp_validation_results));
//
//                        $tmp_key = $this->generate_new_key(50);
//
//                        $this->set_session_param('DISPLAY_AUTH_KEY', $tmp_key);
//                        $this->set_session_param('CRNRSTN_CSS_VALIDATION_RESP', $tmp_validation_results);
//
//                        $tmp_score_numeric_raw = $tmp_validation_results_ARRAY['SCORE_NUMERIC_RAW'];
//                        $tmp_packet_size = $tmp_validation_results_ARRAY['PACKET_BYTES_SIZE'];
//                        $tmp_run_time = $tmp_validation_results_ARRAY['WALLTIME'];
//                        $tmp_run_time = $tmp_run_time . 'secs';
//
//                        error_log(__LINE__ . ' user $tmp_score_numeric_raw=[' . $tmp_score_numeric_raw . '] $tmp_packet_size=[' . $tmp_packet_size . '] $tmp_run_time=[' . $tmp_run_time . '] ');
//
//                        if ($this->isSSL()) {
//
//                            $tmp_post_uri = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//
//                        } else {
//
//                            $tmp_post_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//
//                        }
//
//                        $pos_quest = strpos($tmp_post_uri, '?');
//                        if ($pos_quest !== false) {
//
//                            $tmp_post_uri = $tmp_post_uri . '&crnrstn_l=css_validator&crnrstn_css_rtime=' . urlencode($tmp_run_time) . '&bytes=' . urlencode($tmp_packet_size) . '&score=' . urlencode($tmp_score_numeric_raw);
//
//                        } else {
//
//                            $tmp_post_uri = $tmp_post_uri . '?crnrstn_l=css_validator&crnrstn_css_rtime=' . urlencode($tmp_run_time) . '&bytes=' . urlencode($tmp_packet_size) . '&score=' . urlencode($tmp_score_numeric_raw);
//
//                        }
//
//                        //
//                        // SUPPORT BACK LINK FOR MIT LICENSE PAGE
//                        $this->sync_back_link_state();
//
//                        error_log(__LINE__ . ' user POST CSS $tmp_post_uri = ' . $tmp_post_uri);
//
//                        //
//                        // I WOULD LIKE TO SEE GOOGLE ANALYTICS DATA WITH CSS SCORES AND PERFORMANCE OF THE SYSTEM.
//                        header("Location: " . $tmp_post_uri);
//                        exit();
//
//                    } else {
//                        error_log(__LINE__ . __METHOD__ . ' user $user_auth_check is true');
//
//                        //
//                        // SUPPORT BACK LINK FOR MIT LICENSE PAGE
//                        $this->sync_back_link_state();
//
//                        echo $this->ui_module_out('css_validator');
//                        exit();
//
//                    }
//
//                break;
//
//            }
//        }

        //
        // BOOLEAN INDICATION OF A REQUEST FROM THE GATE KEEPER FOR THE SPACE BETWEEN
        // https://www.youtube.com/watch?v=YvzWRzTh7jg
        // TITLE :: The Space Between
        if($user_auth_check){

            $this->oCRNRSTN_VSC = new crnrstn_view_state_controller($this);

            //
            // IS THERE A FORM POST FROM CRNRSTN :: TO PROCESS?
            if ($this->issetParam($_POST, 'crnrstn_pssdtl_packet')) {

                $tmp_has_getpost_data = true;

                $tmp_form_handle = $this->extractData($_POST, 'crnrstn_pssdtl_packet', true);

                error_log(__LINE__ . ' user $tmp_form_handle=' . $tmp_form_handle);
                $this->oCRNRSTN_VSC->return_client_response($tmp_form_handle);
//
//
//                switch($tmp_form_handle){
//                    case 'crnrstn_signin_flagship':
//                    case 'crnrstn_signin_wireframe':
//
//                        if(!isset($this->oCRNRSTN_AUTH)){
//
//                            $this->oCRNRSTN_AUTH = new crnrstn_user_auth($this);
//
//                        }
//
//                        $this->oCRNRSTN_AUTH->initialize_user_login_attempt();
//
//                        if($tmp_oCRNRSTN_AUTH = $this->oCRNRSTN_AUTH->process_authorization()){
//
//                            echo $this->ui_module_out('dashboard');
//                            exit();
//
//                        }else{
//
//                            echo $this->ui_module_out('signin');
//                            exit();
//
//                        }
//
//                        break;
//                    case 'crnrstn_validate_css':
////                        error_log(__LINE__ . ' user POST CSS PROCESS = TRUE');
////
////                        if ($this->isset_crnrstn_svc_http('POST')) {
////                            error_log(__LINE__ . ' user POST CSS isset_crnrstn_svc_http = TRUE');
////
////                            //
////                            // VALIDATE CSS
////                            $raw_html_data = $this->extract_data_HTTP('ugc_html', 'POST');
////
////                            $tmp_validation_results = $this->validate_css($raw_html_data);
////                            error_log(__LINE__ . ' user POST CSS $tmp_validation_results cnt = ' . strlen($tmp_validation_results));
////
////                            $tmp_key = $this->generate_new_key(50);
////
////                            $this->set_session_param('DISPLAY_AUTH_KEY', $tmp_key);
////                            $this->set_session_param('CRNRSTN_CSS_VALIDATION_RESP', $tmp_validation_results);
////
////                            $tmp_score_numeric_raw = $this->get_session_param('SCORE_NUMERIC_RAW');
////                            $tmp_packet_size = $this->get_session_param('PACKET_BYTES_SIZE');
////                            $tmp_run_time = $this->get_session_param('WALLTIME');
////                            $tmp_run_time = $tmp_run_time . 'secs';
////
////                            if($this->isSSL()){
////
////                                $tmp_post_uri = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
////
////                            }else{
////
////                                $tmp_post_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
////
////                            }
////
////                            $pos_quest = strpos($tmp_post_uri,'?');
////                            if($pos_quest !== false){
////
////                                $tmp_post_uri = $tmp_post_uri . '&crnrstn_l=css_validator&crnrstn_css_rtime=' . urlencode($tmp_run_time) . '&bytes='.urlencode($tmp_packet_size) . '&score='.urlencode($tmp_score_numeric_raw);
////
////                            }else{
////
////                                $tmp_post_uri = $tmp_post_uri . '?crnrstn_l=css_validator&crnrstn_css_rtime=' . urlencode($tmp_run_time) . '&bytes='.urlencode($tmp_packet_size) . '&score='.urlencode($tmp_score_numeric_raw);
////
////                            }
////
////                            //
////                            // SUPPORT BACK LINK FOR MIT LICENSE PAGE
////                            $this->sync_back_link_state();
////
////                            error_log(__LINE__ . ' user POST CSS $tmp_post_uri = ' . $tmp_post_uri);
////
////                            //
////                            // I WOULD LIKE TO SEE GOOGLE ANALYTICS DATA WITH CSS SCORES AND PERFORMANCE OF THE SYSTEM.
////                            header("Location: " . $tmp_post_uri);
////                            exit();
////
////                        }else{
////                            error_log(__LINE__ . __METHOD__ . ' user $user_auth_check is true');
////
////                            //
////                            // SUPPORT BACK LINK FOR MIT LICENSE PAGE
////                            $this->sync_back_link_state();
////
////                            echo $this->ui_module_out('css_validator');
////                            exit();
////
////                        }
//
//                        break;
//                    default:
//
//                        return false;
//
//                        break;
//
//                }

            }else{

                //error_log(__LINE__ . ' user invoking oCRNRSTN_VSC->return_client_response() next....for $_GET...');

                //exit();
//
//                //
//                // WE CHECK GET (FROM THE GATE KEEPER FOR THE SPACE BETWEEN)
//                if($this->issetParam($_GET, 'crnrstn_l')){
//
//                    if($this->issetParam($_GET, 'crnrstn_css_rtime')){
//
//                        $tmp_output_html = $this->get_session_param('CRNRSTN_CSS_VALIDATION_RESP');
//
//                        if(strlen($tmp_output_html) > 1){
//
//                            echo $tmp_output_html;
//                            exit();
//
//                        }else{
//
//                            //
//                            // IF SESSION RETURNS NOTHING, JUST RELOAD THE FORM.
//                            //error_log(__LINE__ . ' user  SESSION RETURNS NOTHING, JUST RELOAD THE FORM.');
//                            echo $this->ui_module_out('css_validator');
//                            exit();
//
//                        }
//
//                    }
//
//                }

            }

        }

        return $tmp_has_getpost_data;

    }

    public function consume_form_integration_packet($data, $transport_protocol = NULL){

        try {

            //
            // CHECK INTEGRITY OF DATA
            if(strlen($data) < 1){

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Received ' . $transport_protocol . ' data is NULL or decryption of data has failed.');

            }

            //
            // PARSE OUT ALL INPUT PARAMETERS.
            //$this->oCRNRSTN->print_r('[' . print_r($data, true) . '].', NULL, NULL, __LINE__, __METHOD__, __FILE__);

            $tmp_decrypted_data = $this->oCRNRSTN->data_decrypt($data);

            //$this->oCRNRSTN->print_r('[' . print_r($tmp_decrypted_data, true) . '].', NULL, NULL, __LINE__, __METHOD__, __FILE__);


        } catch (Exception $e) {

            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;
        }

        return NULL;

    }

    public function client_request_listen(){

        $tmp_html = '';

        // TODO :: TURN THIS BACK ON.
        // CRNRSTN :: SOAP-SERVICES DATA TUNNEL LAYER
        //$this->soap_data_tunnel_output = $this->SOAP_client_request_listener();

        //
        // CRNRSTN :: PSEUDO-SOAP-SERVICES DATA TUNNEL LAYER (SOFT SSDTL)
        $tmp_html = $this->PSEUDO_SOAP_client_request_listener('AJAX_PSSDT_LAYER_POST');

        //error_log(__LINE__ . ' http $tmp_html=[' . $tmp_html . ']');

        //
        // IF SESSION HAS BEEN INITIALIZED WITH oUSER_AUTH OBJECT, SYNC WITH SESSION AT THIS TIME.
        //$this->crnrstn_session_load();

        //
        // CRNRSTN :: CONSOLE DASHBOARD PORTAL ENTRY POINT
        //$tmp_html = $this->user_request_listener();
        if(is_string($tmp_html) && strlen($tmp_html) > 0){

            return $tmp_html;

        }

        //
        // STICKY LINK CHECK
        if($tmp_html = $this->oCRNRSTN->sticky_uri_listener()){

            $this->oCRNRSTN->proper_response_return($tmp_html, NULL, 'RESPONSE_STICKY');

        }

        //
        // SOAP SERVER INITIALIZATION PING - CRNRSTN :: SOAP SERVICES LAYER
        //if($result = $this->initProxyCommListener()){
        //if($SOAP_response = $this->SOAP_service_listen()){
        //    echo $SOAP_response;
        //    die();
        //
        //}

        return NULL;

    }

    private function PSEUDO_SOAP_client_request_listener($output_type){

        //
        // CRNRSTN :: PSSDTL R&D SUPPORTING AJAX FORM POST WHICH WILL ULTIMATELY ROLL INTO CRNRSTN :: SSDTLA TECH
        $tmp_html = '';

        switch($output_type){
            case 'AJAX_PSSDT_LAYER_POST':

                if($this->receive_form_integration_packet()) {

                    error_log(__LINE__ . ' http AJAX_PSSDT_LAYER_POST receive_form_integration_packet');

                    if($this->isvalid_data_validation_check()) {

                        error_log(__LINE__ . ' AJAX_PSSDT_LAYER_POST isvalid_data_validation_check');

                        //
                        // CHECK FOR PSSDTLP. WILL NEED TO MAKE ADJUSTMENTS FOR SSDTLA.
                        //$tmp_crnrstn_session = $this->return_http_form_integration_input_val('crnrstn_session');
                        $tmp_crnrstn_pssdtl_packet = $this->return_http_form_integration_input_val('crnrstn_pssdtl_packet');
                        $tmp_crnrstn_interact_ui_link_text_click = $this->return_http_form_integration_input_val('crnrstn_interact_ui_link_text_click');

                        //error_log('1853 user AJAX_PSSDT_LAYER_POST LENGTH OF $tmp_crnrstn_session=[' . strlen($tmp_crnrstn_session) . ']');
                        //die();

                        $tmp_crnrstn_pssdtl_packet_ojson = json_decode($tmp_crnrstn_pssdtl_packet, TRUE);
                        $raw_json_pssdtl_packet_elements = $tmp_crnrstn_pssdtl_packet_ojson['crnrstn_data_packet'][0]['crnrstn_data_packet_ddo_elements'];

                        //
                        // A QUICK AND DIRTY SHORT CUT TO DOCUMENTATION BUILT ON TOP OF
                        // A STILL-UNDER-CONSTRUCTION SSDTL SITUATION. SORRY. BUT WITH
                        // DOCUMENTATION INCOMING,...SHOULD BE ABLE TO MAKE BETTER AND
                        // MORE CONSISTENT (COPY-PASTE!!) PROGRESS (AND TIDY ALL THIS UP).
                        // Monday, September 12, 2022 @ 0239 hrs
                        if(isset($_POST['crnrstn_interact_ui_link_text_click'])){

                            if($this->oCRNRSTN->page_request_id = $_POST['crnrstn_interact_ui_link_text_click']){

                                //
                                // CLEAR DESTRUCTOR OUTPUT HERE FOR NOW.
                                $this->oCRNRSTN->destruct_output = '';

                                header('Content-Type: text/html; charset=UTF-8');
                                header('Cache-Control: no-store');
                                header('Access-Control-Allow-Origin: *');

                                return $this->oCRNRSTN_USR->ui_module_out('documentation');

                            }

                        }

                        if(count($raw_json_pssdtl_packet_elements[0]) > 0){

                            //
                            // CRNRSTN :: PSSDTL DRIVEN SESSION INITIALIZATION
                            //$this->init_session();

                            header('Content-Type: application/xml; charset=iso-8859-1');
                            header('Cache-Control: no-store');
                            header('Access-Control-Allow-Origin: *');
                            //return $this->oCRNRSTN_TRM->soap_data_tunnel_layer_response();
                            return 'hello page response....';

                        }

                        error_log(__LINE__ . ' http AJAX_PSSDT_LAYER_POST no return. $tmp_crnrstn_session_ojson=[' . print_r($tmp_crnrstn_pssdtl_packet_ojson, true) . '] $raw_json_ui_sync_controller_threads=[' . print_r($raw_json_pssdtl_packet_elements, true) . ']');

                    }else{

                        error_log(__LINE__. ' http AJAX_PSSDT_LAYER_POST NOT isvalid_data_validation_check');

                    }

                }else{

                    //error_log('1878 AJAX_PSSDT_LAYER_POST NOT receive_form_integration_packet');

                }

                break;

        }

        return $tmp_html;

    }

    public function SOAP_client_request_listener($output_type = 'print_r'){

        $output_type = strtolower($output_type);

        //
        // IF SOAP CLIENT IS INITIALIZED
        if($this->SOAP_isset_soap_client()){

            $this->oNUSOAP_BASE = new nusoap_base();

            $tmp_version_soap = $this->oNUSOAP_BASE->title;             //'NuSOAP';
            $tmp_version_soap .= $this->oNUSOAP_BASE->version;          //' v0.9.5';
            $tmp_version_soap .= $this->oNUSOAP_BASE->revision;         //' $Revision: 1.123 $';

            $this->oCRNRSTN->input_data_value($tmp_version_soap, 'version_soap', NULL, 0, CRNRSTN_AUTHORIZE_RUNTIME_ONLY, NULL);
            //$this->consume_ddo_system_param($tmp_version_soap, 'version_soap');
            //self::$oCRNRSTN_CONFIG_MGR->input_data_value($tmp_version_soap, 'version_soap');

            $tmp_revision_soap = $this->proper_replace('Revision:','', $this->oNUSOAP_BASE->revision);
            $tmp_revision_soap .= $this->proper_replace('$','', $tmp_revision_soap);
            $tmp_revision_soap .= trim($tmp_revision_soap);

            $tmp_user_agent = 'User-Agent: ' . $this->oNUSOAP_BASE->title . '/' . $this->oNUSOAP_BASE->version . ' (' . $tmp_revision_soap . ') CRNRSTN :: v' . $this->version_crnrstn();

            //
            // TEXTAREA OUTPUT IN FORM WITH SUBMIT BUTTON
            $tmp_crnrstn_soap_data_tunnel_output = $this->SOAP_return_client_request();
            $tmp_content_length = strlen($tmp_crnrstn_soap_data_tunnel_output);
            $tmp_content_length = 'Content-Length: ' . $tmp_content_length;

            $tmp_config_wsdl = $this->get_resource('WSDL_URI', 'CRNRSTN::INTEGRATIONS');

            if(!(strlen($tmp_config_wsdl) > 0)){

                //
                // TODO :: TAKE CARE OF THIS.
                // SOMETHING FOR NOW
                //$tmp_config_wsdl = 'http://jony5.com/_crnrstn/soa/?wsdl';
                $tmp_config_wsdl = $this->get_resource('ROOT_PATH_CLIENT_HTTP') . $this->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . '_crnrstn/soa/?wsdl';

            }

            switch($output_type){
                case 'alpha_testing':

                    $this->form_input_add('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_srvc_data', true);

                    $this->form_input_add('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_srvc_soap_action', true);
                    $this->form_input_add('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_srvc_layer_wsdl', true);
                    $this->form_input_add('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_srvc_content_length', true);

                    $this->form_input_add('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_srvc_layer_user_agent', true);
                    $this->form_input_add('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_srvc_layer_host', true);

                    $this->form_input_add('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_srvc_stime', true);
                    $this->form_input_add('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_srvc_rtime', true);
                    $this->form_input_add('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_srvc_ttl_wethrbug', true);
                    $this->form_input_add('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_srvc_ttl_bassdrive_stats', true);
                    $this->form_input_add('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_srvc_ttl_bassdrive_show', true);
                    $this->form_input_add('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_srvc_ttl_truth_timer', true);
                    $this->form_input_add('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_srvc_ttl_banner_rotate_desktop', true);
                    $this->form_input_add('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_srvc_ttl_banner_rotate_tablet', true);
                    $this->form_input_add('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_srvc_ttl_banner_rotate_mobile', true);
                    $this->form_input_add('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_srvc_transport_protocol_version', true);
                    $this->form_input_add('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_srvc_encoding', true);

                    $this->form_hidden_input_add('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_data_tunnel_data', true, $tmp_crnrstn_soap_data_tunnel_output, 'crnrstn_soap_data_tunnel_data');
                    $this->form_hidden_input_add('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_data_tunnel_soap_action', true, 'urn:returnCRNRSTN_UI_GLOBAL_SYNCwsdl#returnCRNRSTN_UI_GLOBAL_SYNC', 'crnrstn_soap_data_tunnel_soap_action');
                    $this->form_hidden_input_add('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_data_tunnel_content_type', true, 'text/xml; charset=' . $this->oNUSOAP_BASE->soap_defencoding, 'crnrstn_soap_data_tunnel_content_type');
                    $this->form_hidden_input_add('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_data_tunnel_content_length', true, $tmp_content_length, 'crnrstn_soap_data_tunnel_content_length');
                    $this->form_hidden_input_add('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_data_tunnel_user_agent', true, $tmp_user_agent, 'crnrstn_soap_data_tunnel_user_agent');
                    $this->form_hidden_input_add('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_data_tunnel_host', true, $_SERVER['SERVER_ADDR'], 'crnrstn_soap_data_tunnel_host');
                    $this->form_hidden_input_add('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_data_tunnel_host', true, $this->oNUSOAP_BASE->soap_defencoding, 'crnrstn_soap_data_tunnel_encoding');

                    $tmp_html = '<form action="' . $this->crnrstn_resources_http_path . 'soa/tunnel/" method="post" id="crnrstn_ssdtl_frm" name="crnrstn_ssdtl_frm" enctype="multipart/form-data">
<div style="padding-bottom: 20px;"><textarea id="crnrstn_soap_srvc_data" name="crnrstn_soap_srvc_data" cols="130" rows="5">' . $tmp_crnrstn_soap_data_tunnel_output . '</textarea></div>
<button type="submit" style="width:150px; height:30px; text-align: center; font-weight: bold;">SUBMIT</button>
<input type="hidden" name="crnrstn_soap_srvc_soap_action" value="urn:returnCRNRSTN_UI_GLOBAL_SYNCwsdl#returnCRNRSTN_UI_GLOBAL_SYNC">
<input type="hidden" name="crnrstn_soap_srvc_layer_wsdl" value="' . $tmp_config_wsdl . '">
<input type="hidden" name="crnrstn_soap_srvc_content_length" value="' . $tmp_content_length . '">
<input type="hidden" name="crnrstn_soap_srvc_layer_user_agent" value="' . $tmp_user_agent . '">
<input type="hidden" name="crnrstn_soap_srvc_layer_host" value="' . $_SERVER['SERVER_ADDR'] . '">

<input type="hidden" name="crnrstn_soap_srvc_stime" value="' . $this->starttime . '">
<input type="hidden" name="crnrstn_soap_srvc_rtime" value="' . $this->wall_time() . '">

<input type="hidden" name="crnrstn_soap_srvc_ttl_wethrbug" value="110">
<input type="hidden" name="crnrstn_soap_srvc_ttl_bassdrive_stats" value="20">
<input type="hidden" name="crnrstn_soap_srvc_ttl_bassdrive_show" value="45">
<input type="hidden" name="crnrstn_soap_srvc_ttl_truth_timer" value="30">
<input type="hidden" name="crnrstn_soap_srvc_ttl_banner_rotate_desktop" value="15">
<input type="hidden" name="crnrstn_soap_srvc_ttl_banner_rotate_tablet" value="7">
<input type="hidden" name="crnrstn_soap_srvc_ttl_banner_rotate_mobile" value="7">
<input type="hidden" name="crnrstn_soap_srvc_device_type" value="">
<input type="hidden" name="crnrstn_soap_srvc_transport_protocol_version" value="' . $this->version_soap() . '">
<input type="hidden" name="crnrstn_soap_srvc_encoding" value="' . $this->oNUSOAP_BASE->soap_defencoding . '">
<input type="hidden" name="crnrstn_soap_srvc_response_format" value="soap-SOAP, soap;q=0.9, xml;0.7, json;0.1, csv;0, carrier_pigeon;-0.9">

' . $this->ui_content_module_out(CRNRSTN_UI_FORM_INTEGRATION_PACKET, 'crnrstn_soap_data_tunnel_frm') . '
</form>
<pre class="debug_output">' . $this->return_CRNRSTN_ASCII_ART(0) . '</pre>
';

                    break;

                // case 'json':
                // case 'xml':
                default:

                    //
                    // print_r
                    $tmp_crnrstn_soap_data_tunnel_output = $this->print_r_str($this->SOAP_return_client_request());

                    break;

            }

            return $tmp_html;

        }

        return '';

    }

    /*

    <input type="hidden" id="crnrstn_ui_interact_canvas_checksum" name="crnrstn_ui_interact_canvas_checksum" value="">
    <input type="hidden" id="crnrstn_ui_interact_mini_canvas_checksum" name="crnrstn_ui_interact_mini_canvas_checksum" value="">
    <input type="hidden" id="crnrstn_ui_interact_signin_canvas_checksum" name="crnrstn_ui_interact_signin_canvas_checksum" value="">
    <input type="hidden" id="crnrstn_ui_interact_main_canvas_checksum" name="crnrstn_ui_interact_main_canvas_checksum" value="">
    <input type="hidden" id="crnrstn_ui_interact_eula_canvas_checksum" name="crnrstn_ui_interact_eula_canvas_checksum" value="">
    <input type="hidden" id="crnrstn_ui_interact_mit_license_canvas_checksum" name="crnrstn_ui_interact_mit_license_canvas_checksum" value="">

    $CANVAS_PROFILE_HASH = '"CANVAS_PROFILE_HASH" : "' . $this->oCRNRSTN_USR->return_ui_interact_canvas_profile_checksum() . '",';
    $CANVAS_PROFILE_CONTENT = '"CANVAS_PROFILE_CONTENT" : "' . $this->oCRNRSTN_USR->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILE_CONTENT') . '",';
    $CANVAS_PROFILE_LOCK = '"CANVAS_PROFILE_LOCK" : "' . $this->oCRNRSTN_USR->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILE_LOCK') . '",';
    $CANVAS_PROFILE_LOCK_TTL = '"CANVAS_PROFILE_LOCK_TTL" : "' . $this->oCRNRSTN_USR->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILE_LOCK_TTL') . '",';
    $CANVAS_PROFILE_LOCK_ISACTIVE = '"CANVAS_PROFILE_LOCK_ISACTIVE" : "' . $this->oCRNRSTN_USR->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILE_LOCK_ISACTIVE') . '",';

    $CANVAS_PROFILES_DIMENSION_POSITION_CHECKSUM = '"CANVAS_PROFILES_DIMENSION_POSITION_CHECKSUM" : "' . $this->oCRNRSTN_USR->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILES_DIMENSION_POSITION_CHECKSUM') . '",';
    $CANVAS_PROFILES_DIMENSION_POSITION_CONTENT = '"CANVAS_PROFILES_DIMENSION_POSITION_CONTENT" : "' . $this->oCRNRSTN_USR->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILES_DIMENSION_POSITION_CONTENT') . '",';
    $CANVAS_PROFILES_DIMENSION_POSITION_LOCK = '"CANVAS_PROFILES_DIMENSION_POSITION_LOCK" : "' . $this->oCRNRSTN_USR->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILES_DIMENSION_POSITION_LOCK') . '",';
    $CANVAS_PROFILES_DIMENSION_POSITION_LOCK_TTL = '"CANVAS_PROFILES_DIMENSION_POSITION_LOCK_TTL" : "' . $this->oCRNRSTN_USR->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILES_DIMENSION_POSITION_LOCK_TTL') . '",';
    $CANVAS_PROFILES_DIMENSION_POSITION_LOCK_ISACTIVE = '"CANVAS_PROFILES_DIMENSION_POSITION_LOCK_ISACTIVE" : "' . $this->oCRNRSTN_USR->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILES_DIMENSION_POSITION_LOCK_ISACTIVE') . '",';

    */

    public function return_http_form_integration_input_val($getpost_input_name, $transport_protocol = NULL){

        try {

            if(!isset($transport_protocol)){


                //
                // AUTO DETECTION CHECKING POST FIRST.
                if (isset(self::$http_param_handle_ARRAY['POST'][$getpost_input_name])) {

                    return self::$http_param_handle_ARRAY['POST'][$getpost_input_name];

                } else {

                    if (isset(self::$http_param_handle_ARRAY['GET'][$getpost_input_name])) {

                        return self::$http_param_handle_ARRAY['GET'][$getpost_input_name];

                    } else {

                        //error_log(__LINE__ . ' user - NO DATA IN ' . $getpost_input_name);
                        return NULL;

                    }
                }

            } else {

                $http_protocol = strtoupper($transport_protocol);
                $http_protocol = $this->string_sanitize($http_protocol, 'http_protocol_simple');

                switch ($http_protocol) {
                    case 'POST':
                    case 'GET':

                        if (isset(self::$http_param_handle_ARRAY[$http_protocol][$getpost_input_name])) {

                            return self::$http_param_handle_ARRAY[$http_protocol][$getpost_input_name];

                        } else {

                            //error_log(__LINE__ . ' - NO ' . $http_protocol . ' DATA IN ' . $getpost_input_name);
                            return NULL;

                        }

                        break;
                    default:

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to determine HTTP protocol from provided value of [' . $transport_protocol . '].');

                        break;

                }

            }

        } catch (Exception $e) {

            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function receive_form_integration_packet($uri_passthrough = false, $cipher_override = NULL, $secret_key_override = NULL){

        $tmp_has_getpost_data = false;

        //
        // DO WE HAVE POST DATA?
        if($this->issetHTTP($_POST)){

            //
            // CHECK FOR PRESENCE OF FORM INTEGRATION PACKET DATA
            if($this->issetParam($_POST, 'crnrstn_pssdtl_packet')){

                $this->form_integration_isset_ARRAY['POST'] = true;
                $tmp_has_getpost_data = true;

                $tmp_is_encrypted = '';
                if($this->issetParam($_POST, 'crnrstn_pssdtl_packet_ENCRYPTED')){

                    $tmp_is_encrypted = strtolower($this->extractData($_POST, 'crnrstn_pssdtl_packet_ENCRYPTED'));

                }

                if($tmp_is_encrypted == 'true'){

                    $uri_passthrough = true;
                    $this->consume_form_integration_packet($this->oCRNRSTN->data_decrypt($this->extractData($_POST, 'crnrstn_pssdtl_packet'), CRNRSTN_ENCRYPT_TUNNEL, $uri_passthrough, $cipher_override, $secret_key_override), 'POST');

                }else{

                    $this->consume_form_integration_packet($this->extractData($_POST, 'crnrstn_pssdtl_packet'), 'POST');

                }

            }

            //
            // DO WE HAVE GET DATA?
            if($this->issetHTTP($_GET)){

                //
                // CHECK FOR PRESENCE OF FORM INTEGRATION PACKET DATA
                if($this->issetParam($_GET, 'crnrstn_pssdtl_packet')){

                    $this->form_integration_isset_ARRAY['GET'] = true;
                    $tmp_has_getpost_data = true;

                    $tmp_is_encrypted = '';
                    if($this->issetParam($_GET, 'crnrstn_pssdtl_packet_ENCRYPTED')){

                        $tmp_is_encrypted = strtolower($this->extractData($_GET, 'crnrstn_pssdtl_packet_ENCRYPTED'));

                    }

                    if($tmp_is_encrypted == 'true'){

                        $this->consume_form_integration_packet($this->oCRNRSTN->data_decrypt($this->extractData($_GET, 'crnrstn_pssdtl_packet'), CRNRSTN_ENCRYPT_TUNNEL, false, $cipher_override, $secret_key_override), 'GET');

                    }else{

                        $this->consume_form_integration_packet($this->extractData($_GET, 'crnrstn_pssdtl_packet'), 'GET');

                    }

                }

            }

        }else{

            //
            // DO WE HAVE GET DATA?
            if($this->issetHTTP($_GET)){

                //
                // CHECK FOR PRESENCE OF FORM INTEGRATION PACKET DATA
                if($this->issetParam($_GET, 'crnrstn_pssdtl_packet')){

                    //error_log('4418 user - process crnrstn_pssdtl_packet @ _GET');
                    $tmp_has_getpost_data = true;

                    $tmp_is_encrypted = '';
                    if($this->issetParam($_GET, 'crnrstn_pssdtl_packet_ENCRYPTED')){

                        $tmp_is_encrypted = strtolower($this->extractData($_GET, 'crnrstn_pssdtl_packet_ENCRYPTED'));

                    }

                    if($tmp_is_encrypted == 'true'){

                        //error_log('4429 user - decrypt crnrstn_pssdtl_packet @ _GET');

                        $this->consume_form_integration_packet($this->oCRNRSTN->data_decrypt($this->extractData($_GET, 'crnrstn_pssdtl_packet'), CRNRSTN_ENCRYPT_TUNNEL, false, $cipher_override, $secret_key_override), 'GET');

                    } else {

                        //error_log('4434 user - decrypt crnrstn_pssdtl_packet @ _GET');

                        $this->consume_form_integration_packet($this->extractData($_GET, 'crnrstn_pssdtl_packet'), 'GET');

                    }

                }

            }

        }

        return $tmp_has_getpost_data;

    }

    public function isvalid_data_validation_check($transport_protocol = 'POST'){

        $http_protocol = strtoupper($transport_protocol);
        $http_protocol = $this->oCRNRSTN->string_sanitize($http_protocol, 'http_protocol_simple');

        if(isset($this->form_integration_isset_ARRAY[$http_protocol])){

            return $this->form_integration_isset_ARRAY[$http_protocol];

        }else{

            return NULL;

        }

    }

    public function isset_crnrstn_svc_http(){

        $tmp_is_valid = false;

        $tmp_variables_order = $this->oCRNRSTN->ini_get('variables_order');
        $tmp_vo_ARRAY = str_split($tmp_variables_order);

        foreach($tmp_vo_ARRAY as $key => $value) {

            switch ($value) {
                case 'G':

                    if(isset($this->form_integration_isset_ARRAY['GET'])){

                        $tmp_is_valid = true;

                        if(!$this->form_integration_isset_ARRAY['GET']){

                            return $this->form_integration_isset_ARRAY['GET'];

                        }

                    }

                break;
                case 'P':

                    if(isset($this->form_integration_isset_ARRAY['POST'])){

                        $tmp_is_valid = true;

                        if(!$this->form_integration_isset_ARRAY['POST']){

                            return $this->form_integration_isset_ARRAY['POST'];

                        }

                    }

                break;

            }

            return $tmp_is_valid;

        }

    }

    public function __return_err_data_validation_check($transport_protocol = 'POST'){

        $tmp_array = array();

        $tmp_is_valid = false;

        $tmp_variables_order = $this->ini_get('variables_order');
        $tmp_vo_ARRAY = str_split($tmp_variables_order);

        foreach($tmp_vo_ARRAY as $key => $value) {

            switch ($value) {
                case 'G':

                    if (isset(self::$formIntegrationErr_ARRAY['GET'])) {

                        $tmp_array[] = self::$formIntegrationErr_ARRAY['GET'];
                        $tmp_array[] = self::$formIntegrationIcon_ARRAY['GET'];

                    }

                    break;
                case 'P':

                    if (isset(self::$formIntegrationErr_ARRAY['POST'])) {

                        $tmp_array[] = self::$formIntegrationErr_ARRAY['POST'];
                        $tmp_array[] = self::$formIntegrationIcon_ARRAY['POST'];

                    }

                    break;

            }

            return $tmp_array;

        }

    }

    private function init_channel(){

        $channel_selected_ARRAY = $this->oCRNRSTN_USR->return_set_bits($this->oCRNRSTN->system_output_channel_constants);
        $tmp_sel_cnt = count($channel_selected_ARRAY);

        //
        // MAINTAIN INTEGRITY OF DEVICE DETECTION SITUATION
        if( $tmp_sel_cnt == 0 || $tmp_sel_cnt > 1){

            //
            // SET (OR RESET) THIS DATA. THERE SHOULD ALWAYS AND ONLY BE ONE.
            $tmp_bit = $this->sync_device_detected();
            //error_log(__LINE__ . ' http $tmp_bit=' . print_r($tmp_bit, true));

            $this->oCRNRSTN_USR->device_type_bit = $tmp_bit;

            switch($tmp_bit){
                case CRNRSTN_UI_DESKTOP:

                    $this->oCRNRSTN_USR->device_type = 'DESKTOP';

                break;
                case CRNRSTN_UI_TABLET:

                    $this->oCRNRSTN_USR->device_type = 'TABLET';

                break;
                case CRNRSTN_UI_MOBILE:

                    $this->oCRNRSTN_USR->device_type = 'MOBILE';

                break;

            }

            $this->oCRNRSTN_USR->toggle_bit($tmp_bit, true);

        }

    }

    private function initialize_client_profile($header_attribute_nom, $header_attrib_value){

        //error_log(__LINE__ .' HTTP_MGR TO STORE[' . $header_attribute_nom . ']==>[' . $header_attrib_value . ']');
        $this->client_header_field_data_ARRAY[$header_attribute_nom][] = $header_attrib_value;

    }

    private function is_crnrstn_relevant($header_attribute_nom){

	    foreach (self::$relevant_header_fields_ARRAY as $nom => $val){

	        if(strcasecmp($header_attribute_nom, $nom)){

                return true;

            }

        }

        return false;

    }
	
	public function extractData($requestMethod, $name, $tunnel_encrypted = false){

		if(isset($requestMethod[$name])){

           //
            // CHECK FOR TUNNEL ENCRYPTED GET DATA
            if($requestMethod == $_GET){

                if(isset($requestMethod['crnrstn_encrypt_tunnel'])){

                    //
                    // NEED TO CHECK FOR EXISTENCE OF PARAM NAME IN THIS PIPE STRING FOR DECRYPT AUTHORIZATION
                    $tmp_decrypt_pipe = $this->oCRNRSTN->data_decrypt($requestMethod['crnrstn_encrypt_tunnel']);
                    $tmp_array = explode('|', $tmp_decrypt_pipe);

                    foreach($tmp_array as $key => $param_nom){

                        //error_log(__LINE__ .' http mgr check $name[' . $name . '] ||  $param_nom=' . $param_nom.' val=' . $requestMethod[$name]);
                        if($param_nom == $name){

                            return $this->oCRNRSTN->data_decrypt($requestMethod[$name]);

                        }

                    }

                }else{

                    if($tunnel_encrypted){

                        //error_log(__LINE__ . ' http RUN data_decrypt['.urldecode($requestMethod[$name]).'][' . $this->oCRNRSTN->data_decrypt(urldecode($requestMethod[$name])).']');
                        return $this->oCRNRSTN->data_decrypt($requestMethod[$name]);

                    }else{

                        return trim($requestMethod[$name]);

                    }

                }

            }

            //
            // RETURN POST DATA
            if($tunnel_encrypted){

                return $this->oCRNRSTN->data_decrypt(trim($requestMethod[$name]));

            }else{

                return trim($requestMethod[$name]);

            }

		}else{

			return "";

		}

	}
	
	public function getHeaders ($returnType = 'array'){

		switch(strtolower($returnType)){
			case 'array':

				return getallheaders();

			break;		
			default:

			    //
                // string

			    $tmp_str =  '';

				$tmp_http_headers = getallheaders();

                //$this->oCRNRSTN_USR->print_r(self::$httpHeader_ARRAY, 'HTTP_MGR Config Data Selection :: CLIENT HEADER', CRNRSTN_UI_HTML, __LINE__, __METHOD__, __FILE__);

				foreach ($tmp_http_headers as $attrib_nom => $value){

                    $tmp_str .= $attrib_nom . '=' . $value . ',';

				}
				
				// 
				// STRIP TRAILING COMMA
                $tmp_str = rtrim($tmp_str, ',');
		
				return $tmp_str;

			break;

		}

	}
	
	public function issetHTTP($superGlobal){

		if(sizeof($superGlobal)>0){

			return true;

		}else{

			return false;

		}
	}
	
	public function issetParam($superGlobal, $param){

		if(isset($superGlobal[$param])){

		    // COMMENTED OUT TO ACCEPT NULL/EMPTY VALUES
			//if(strlen($superGlobal[$param])>0){

				return true;

			//}else{

			//	return false;

			//}

		}else{

			return false;

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
     * @access  private
     */
    public function is_client_mobile($tabletIsMobile = false){

        //
        // CHECK SESSION FOR EXISTING CONFIGURATION
        $tmp_custom_device = $this->oCRNRSTN->get_resource('CRNRSTN_DEVICE_CUSTOM'); //$this->oCRNRSTN_USR->get_session_param('CUSTOM_DEVICE');
        $tmp_ismobile = $this->oCRNRSTN->get_resource('isMobile'); //$this->oCRNRSTN_USR->get_session_param('isMobile');  // BOOLEAN
        $tmp_istablet = $this->oCRNRSTN->get_resource('isTablet'); //$this->oCRNRSTN_USR->get_session_param('isTablet');  // BOOLEAN

        //
        // MAY USE FALSE vs NULL TO CLEAR ISMOBILE IN SESSION. CRNRSTN :: ONLY SETS THIS TO TRUE.
        if(isset($tmp_ismobile)){

            if($tmp_ismobile != $this->oCRNRSTN->session_salt()){

                if($tmp_ismobile){

                    return 'isMobile';

                }

            }

        }

        //
        // MAY USE FALSE vs NULL TO CLEAR ISTABLET IN SESSION. CRNRSTN :: ONLY SETS THIS TO TRUE.
        if(isset($tmp_istablet)){

            if($tmp_ismobile != $this->oCRNRSTN->session_salt()){

                if($tmp_istablet && $tabletIsMobile){

                    return 'isTablet';

                }

            }

        }

        if($tmp_custom_device != '' && ($tmp_custom_device != $this->oCRNRSTN->session_salt())){

            # NOTE :: $tmp_custom_device HAS BOTH MOBILE AND TABLET OPPORTUNITIES

            //
            // MOBILE HAS BEEN PERSISTED IN SESSION. STICK WITH IT.
            return $tmp_custom_device;

        }else{

            //
            // SESSION PROVIDES NO CONFIRMATION OF MOBILE STATE. LET'S DO THE WORK TO ANSWER THE QUESTION.
            if(!isset($this->isMobile)){

                //
                // NEED TO DETERMINE DEVICE TYPE.
                if(!isset($this->mobi_detect)){

                    //
                    //  INITIALIZE MOBILE DETECT 3RD PARTY SERVICE.
                    $this->mobi_detect = new crnrstn_Mobile_Detect();

                }

                if($tabletIsMobile){

                    //
                    // HANDLE TABLETS AS MOBILE
                    if($this->mobi_detect->isMobile($this->http_headers_string) || $this->mobi_detect->isTablet($this->http_headers_string)){

                        $this->isMobile = true;

                    }else{

                        $this->isMobile = false;

                    }

                }else{

                    //
                    // EXCLUDE TABLETS FROM POSITIVE MOBILE IDENTIFICATION
                    if($this->mobi_detect->isMobile($this->http_headers_string) && !$this->mobi_detect->isTablet($this->http_headers_string)){

                        $this->isMobile = true;

                    } else {

                        $this->isMobile = false;
                    }

                }

            }

        }

        if($this->isMobile){

            return 'isMobile';

        }else{

            return false;

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
     * @access  private
     */
    public function is_client_tablet($mobileIsTablet = false){

        //
        // CHECK SESSION FOR EXISTING CONFIGURATION
        $tmp_custom_device = $this->oCRNRSTN->get_resource('CRNRSTN_DEVICE_CUSTOM'); //$this->oCRNRSTN_USR->get_session_param('CUSTOM_DEVICE');
        $tmp_ismobile = $this->oCRNRSTN->get_resource('isMobile'); //$this->oCRNRSTN_USR->get_session_param('isMobile');  // BOOLEAN
        $tmp_istablet = $this->oCRNRSTN->get_resource('isTablet'); //$this->oCRNRSTN_USR->get_session_param('isTablet');  // BOOLEAN

        //
        // MAY USE FALSE vs NULL TO CLEAR ISTABLET IN SESSION. CRNRSTN ONLY SETS THIS TO TRUE.
        if(isset($tmp_istablet)){

            if($tmp_istablet != $this->oCRNRSTN->session_salt()){

                if($tmp_istablet){

                    return 'isTablet';

                }

            }

        }

        //
        // MAY USE FALSE vs NULL TO CLEAR ISMOBILE IN SESSION. CRNRSTN ONLY SETS THIS TO TRUE.
        if(isset($tmp_ismobile)){

            if($tmp_ismobile != $this->oCRNRSTN->session_salt()){

                if($tmp_ismobile && $mobileIsTablet){

                    return 'isMobile';

                }

            }

        }

        if($tmp_custom_device != '' && ($tmp_custom_device != $this->oCRNRSTN->session_salt())){

            # NOTE :: $tmp_custom_device HAS BOTH MOBILE AND TABLET OPPORTUNITIES

            //
            // MOBILE/TABLET HAS BEEN PERSISTED IN SESSION. STICK WITH IT. RETURN STRING FOR DEVICE TYPE.
            return $tmp_custom_device;

        }else{

            if(!isset($this->isTablet)){

                //
                // NEED TO DETERMINE DEVICE TYPE.
                if(!isset($this->mobi_detect)){

                    //
                    //  INITIALIZE MOBILE DETECT (3RD PARTY OPEN SOURCE).
                    $this->mobi_detect = new crnrstn_Mobile_Detect();
                }

                if($mobileIsTablet){

                    if($this->mobi_detect->isMobile($this->http_headers_string) || $this->mobi_detect->isTablet($this->http_headers_string)){

                        $this->isTablet = true;

                    }else{

                        $this->isTablet = false;

                    }

                }else{

                    if(!$this->mobi_detect->isMobile($this->http_headers_string) && $this->mobi_detect->isTablet($this->http_headers_string)){

                        $this->isTablet = true;

                    }else{

                        $this->isTablet = false;

                    }

                }

            }

        }

        if($this->isTablet){

            return 'isTablet';

        }else{

            return false;

        }

    }

    public function set_client_desktop(){

//        error_log(__LINE__ . ' http ' . __METHOD__ . ' ['.CRNRSTN_UI_DESKTOP.']');
//
//        error_log(__LINE__ . ' http $this->oCRNRSTN_USR is [' . get_class($this->oCRNRSTN_USR) . '] $this->oCRNRSTN is [' . get_class($this->oCRNRSTN) . '].');
//        die();
        //$this->oCRNRSTN->add_system_resource($env_key, 'host',  $host, 0, 'CRNRSTN_SYSTEM_RESOURCE::CRNRSTN_DATABASE', CRNRSTN_AUTHORIZE_RUNTIME_ONLY);
        $this->oCRNRSTN->input_data_value(CRNRSTN_UI_DESKTOP, 'CRNRSTN_DEVICE_DETECTED', NULL, 0);
        //$this->oCRNRSTN_USR->set_session_param('CRNRSTN_DEVICE_DETECTED', CRNRSTN_UI_DESKTOP);
        $this->oCRNRSTN_USR->toggle_bit(CRNRSTN_UI_DESKTOP, true);

        return CRNRSTN_UI_DESKTOP;

    }

    public function set_client_tablet(){

        $this->oCRNRSTN_USR->input_data_value(CRNRSTN_UI_TABLET, 'CRNRSTN_DEVICE_DETECTED', NULL, 0);
        //$this->oCRNRSTN_USR->set_session_param('CRNRSTN_DEVICE_DETECTED', CRNRSTN_UI_TABLET);
        $this->oCRNRSTN_USR->toggle_bit(CRNRSTN_UI_TABLET, true);

        return CRNRSTN_UI_TABLET;

    }

    public function set_client_mobile(){

        $this->oCRNRSTN_USR->input_data_value(CRNRSTN_UI_MOBILE, 'CRNRSTN_DEVICE_DETECTED', NULL, 0);
        //$this->oCRNRSTN_USR->set_session_param('CRNRSTN_DEVICE_DETECTED', CRNRSTN_UI_MOBILE);
        $this->oCRNRSTN_USR->toggle_bit(CRNRSTN_UI_MOBILE, true);

        return CRNRSTN_UI_MOBILE;

    }

    public function set_client($channel_constant){

        error_log(__LINE__ . ' http set_client [' . $channel_constant.']');
        // public function input_data_value($data_value, $data_key, $data_type_family = 'CRNRSTN::RESOURCE', $index = NULL, $data_auth_profile = CRNRSTN_AUTHORIZE_RUNTIME_ONLY, $env_key = NULL){
        $this->oCRNRSTN_USR->input_data_value($channel_constant, 'CRNRSTN_DEVICE_DETECTED', NULL, 0);
        //$this->oCRNRSTN_USR->set_session_param('CRNRSTN_DEVICE_DETECTED', $channel_constant);
        $this->oCRNRSTN_USR->toggle_bit($channel_constant, true);

        return $channel_constant;

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resource_key The resource key.
     * @return string|null|mixed The value of the header.
     * @access  private
     */
    public function set_client_mobile_custom($target_device = NULL){

        try {

            if (isset($target_device)) {

                $target_device = trim($target_device);
                $target_device = $this->oCRNRSTN_USR->string_sanitize($target_device, 'custom_mobi_detect_alg');

                error_log(__LINE__ . ' http  $this->oCRNRSTN_USR is [' . get_class($this->oCRNRSTN_USR) . '][' . $target_device . ']. die();');
                die();

                $this->oCRNRSTN_USR->input_data_value($target_device, 'CRNRSTN_DEVICE_CUSTOM', NULL, 0, '');
                $this->oCRNRSTN_USR->input_data_value(CRNRSTN_UI_MOBILE, 'CRNRSTN_DEVICE_DETECTED', NULL, 0);

                //$this->oCRNRSTN_USR->set_session_param('CRNRSTN_DEVICE_CUSTOM', $target_device);
                //$this->oCRNRSTN_USR->set_session_param('CRNRSTN_DEVICE_DETECTED', CRNRSTN_UI_MOBILE);
                $this->oCRNRSTN_USR->toggle_bit(CRNRSTN_UI_MOBILE, true);

            } else {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('set_client_mobile_custom() requires a detection method string (e.g. $target_device); this value cannot be NULL. See http://demo.mobiledetect.net/ for a current list of custom detection methods.');

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        return true;

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resource_key The resource key.
     * @return string|null|mixed The value of the header.
     * @access  private
     */
    public function is_client_mobile_custom($target_device = NULL){

        //
        // NULL $target_device EVOKES BASIC SESSION CHECK ONLY.
        if (!isset($target_device)) {

            //
            // CHECK SESSION FOR EXISTING CONFIGURATION
            $tmp_custom_device = $this->oCRNRSTN_USR->get_resource('CRNRSTN_DEVICE_CUSTOM');

            if ($tmp_custom_device != '') {

                //
                // WILL RETURN DEVICE STRING IF SESSION IS CONFIGURED WITH CUSTOM DEVICE AND NO
                // TARGET_DEVICE PROVIDED.
                return $tmp_custom_device;

            } else {

                //
                // NO CUSTOM CONFIGURATION AVAILABLE
                return false;

            }

        } else {

            //
            // CHECK THE PROVIDED TARGET DEVICE AGAINST SESSION...AND THEN, DO WORK IF NO MATCH.
            $tmp_detection_algorithm = trim(strtolower($target_device));
            $tmp_detection_algorithm = $this->oCRNRSTN_USR->string_sanitize($tmp_detection_algorithm, 'custom_mobi_detect_alg');

            //
            // CHECK SESSION FOR EXISTING CONFIGURATION
            $tmp_custom_device = $this->oCRNRSTN_USR->get_resource('CRNRSTN_DEVICE_CUSTOM');
            $tmp_custom_device = strtolower($tmp_custom_device);

            //
            // IF DEVICE PROVIDED, WILL CHECK FOR SESSION MATCH AND RETURN STRING REPRESENTING
            // THE SUCCESSFULLY DETECTED ALGORITHM IF SO.
            if ($tmp_custom_device != '' && $tmp_custom_device == $tmp_detection_algorithm) {

                return $tmp_custom_device;

            } else {

                //
                // NO SESSION MATCH. FURTHER DISCOVERY NEEDED.
                if (!isset($this->oMOBI_DETECT)) {

                    //
                    //  INITIALIZE MOBILE DETECT (3RD PARTY OPEN SOURCE).
                    $this->oMOBI_DETECT = new crnrstn_Mobile_Detect();

                }

                try {

                    switch ($tmp_detection_algorithm) {
                        case 'ismobile':

                            if (!isset($this->customClientDevice['isMobile'])) {

                                if ($this->oMOBI_DETECT->isMobile($this->http_headers_string)) {

                                    $this->customClientDevice['isMobile'] = true;

                                } else {

                                    $this->customClientDevice['isMobile'] = false;
                                }

                            }

                            return $this->customClientDevice['isMobile'];

                        break;
                        case 'istablet':

                            if (!isset($this->customClientDevice['isTablet'])) {

                                if ($this->oMOBI_DETECT->isTablet($this->http_headers_string)) {

                                    $this->customClientDevice['isTablet'] = true;

                                } else {

                                    $this->customClientDevice['isTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isTablet'];

                        break;
                        case 'isiphone':

                            if (!isset($this->customClientDevice['isiPhone'])) {

                                if ($this->oMOBI_DETECT->isiPhone()) {

                                    $this->customClientDevice['isiPhone'] = true;

                                } else {

                                    $this->customClientDevice['isiPhone'] = false;
                                }

                            }

                            return $this->customClientDevice['isiPhone'];

                        break;
                        case 'isblackberry':

                            if (!isset($this->customClientDevice['isBlackBerry'])) {

                                if ($this->oMOBI_DETECT->isBlackBerry()) {

                                    $this->customClientDevice['isBlackBerry'] = true;

                                } else {

                                    $this->customClientDevice['isBlackBerry'] = false;
                                }
                            }

                            return $this->customClientDevice['isBlackBerry'];

                        break;
                        case 'ishtc':

                            if (!isset($this->customClientDevice['isHTC'])) {

                                if ($this->oMOBI_DETECT->isHTC()) {

                                    $this->customClientDevice['isHTC'] = true;

                                } else {

                                    $this->customClientDevice['isHTC'] = false;
                                }

                            }

                            return $this->customClientDevice['isHTC'];

                        break;
                        case 'isnexus':

                            if (!isset($this->customClientDevice['isNexus'])) {

                                if ($this->oMOBI_DETECT->isNexus()) {

                                    $this->customClientDevice['isNexus'] = true;

                                } else {

                                    $this->customClientDevice['isNexus'] = false;
                                }

                            }

                            return $this->customClientDevice['isNexus'];

                        break;
                        case 'isdell':

                            if (!isset($this->customClientDevice['isDell'])) {

                                if ($this->oMOBI_DETECT->isDell()) {

                                    $this->customClientDevice['isDell'] = true;

                                } else {

                                    $this->customClientDevice['isDell'] = false;
                                }

                            }

                            return $this->customClientDevice['isDell'];

                        break;
                        case 'ismotorola':

                            if (!isset($this->customClientDevice['isMotorola'])) {

                                if ($this->oMOBI_DETECT->isMotorola()) {

                                    $this->customClientDevice['isMotorola'] = true;

                                } else {

                                    $this->customClientDevice['isMotorola'] = false;
                                }

                            }

                            return $this->customClientDevice['isMotorola'];

                        break;
                        case 'issamsung':

                            if (!isset($this->customClientDevice['isSamsung'])) {

                                if ($this->oMOBI_DETECT->isSamsung()) {

                                    $this->customClientDevice['isSamsung'] = true;

                                } else {

                                    $this->customClientDevice['isSamsung'] = false;
                                }

                            }

                            return $this->customClientDevice['isSamsung'];

                        break;
                        case 'islg':

                            if (!isset($this->customClientDevice['isLG'])) {

                                if ($this->oMOBI_DETECT->isLG()) {

                                    $this->customClientDevice['isLG'] = true;

                                } else {

                                    $this->customClientDevice['isLG'] = false;
                                }

                            }

                            return $this->customClientDevice['isLG'];

                        break;
                        case 'issony':

                            if (!isset($this->customClientDevice['isSony'])) {

                                if ($this->oMOBI_DETECT->isSony()) {

                                    $this->customClientDevice['isSony'] = true;

                                } else {

                                    $this->customClientDevice['isSony'] = false;
                                }

                            }

                            return $this->customClientDevice['isSony'];

                        break;
                        case 'isasus':

                            if (!isset($this->customClientDevice['isAsus'])) {

                                if ($this->oMOBI_DETECT->isAsus()) {

                                    $this->customClientDevice['isAsus'] = true;

                                } else {

                                    $this->customClientDevice['isAsus'] = false;
                                }

                            }

                            return $this->customClientDevice['isAsus'];

                        break;
                        case 'isnokialumia':

                            if (!isset($this->customClientDevice['isNokiaLumia'])) {

                                if ($this->oMOBI_DETECT->isNokiaLumia()) {

                                    $this->customClientDevice['isNokiaLumia'] = true;

                                } else {

                                    $this->customClientDevice['isNokiaLumia'] = false;
                                }

                            }

                            return $this->customClientDevice['isNokiaLumia'];

                        break;
                        case 'ismicromax':

                            if (!isset($this->customClientDevice['isMicromax'])) {

                                if ($this->oMOBI_DETECT->isMicromax()) {

                                    $this->customClientDevice['isMicromax'] = true;

                                } else {

                                    $this->customClientDevice['isMicromax'] = false;
                                }

                            }

                            return $this->customClientDevice['isMicromax'];

                        break;
                        case 'ispalm':

                            if (!isset($this->customClientDevice['isPalm'])) {

                                if ($this->oMOBI_DETECT->isPalm()) {

                                    $this->customClientDevice['isPalm'] = true;

                                } else {

                                    $this->customClientDevice['isPalm'] = false;
                                }

                            }

                            return $this->customClientDevice['isPalm'];

                        break;
                        case 'isvertu':

                            if (!isset($this->customClientDevice['isVertu'])) {

                                if ($this->oMOBI_DETECT->isVertu()) {

                                    $this->customClientDevice['isVertu'] = true;

                                } else {

                                    $this->customClientDevice['isVertu'] = false;
                                }

                            }

                            return $this->customClientDevice['isVertu'];

                        break;
                        case 'ispantech':

                            if (!isset($this->customClientDevice['isPantech'])) {

                                if ($this->oMOBI_DETECT->isPantech()) {

                                    $this->customClientDevice['isPantech'] = true;

                                } else {

                                    $this->customClientDevice['isPantech'] = false;
                                }

                            }

                            return $this->customClientDevice['isPantech'];

                        break;
                        case 'isfly':

                            if (!isset($this->customClientDevice['isFly'])) {

                                if ($this->oMOBI_DETECT->isFly()) {

                                    $this->customClientDevice['isFly'] = true;

                                } else {

                                    $this->customClientDevice['isFly'] = false;
                                }

                            }

                            return $this->customClientDevice['isFly'];

                        break;
                        case 'iswiko':

                            if (!isset($this->customClientDevice['isWiko'])) {

                                if ($this->oMOBI_DETECT->isWiko()) {

                                    $this->customClientDevice['isWiko'] = true;

                                } else {

                                    $this->customClientDevice['isWiko'] = false;
                                }

                            }

                            return $this->customClientDevice['isWiko'];

                        break;
                        case 'isimobile':

                            if (!isset($this->customClientDevice['isiMobile'])) {

                                if ($this->oMOBI_DETECT->isiMobile()) {

                                    $this->customClientDevice['isiMobile'] = true;

                                } else {

                                    $this->customClientDevice['isiMobile'] = false;
                                }

                            }

                            return $this->customClientDevice['isiMobile'];

                        break;
                        case 'issimvalley':

                            if (!isset($this->customClientDevice['isSimValley'])) {

                                if ($this->oMOBI_DETECT->isSimValley()) {

                                    $this->customClientDevice['isSimValley'] = true;

                                } else {

                                    $this->customClientDevice['isSimValley'] = false;
                                }

                            }

                            return $this->customClientDevice['isSimValley'];

                        break;
                        case 'iswolfgang':

                            if (!isset($this->customClientDevice['isWolfgang'])) {

                                if ($this->oMOBI_DETECT->isWolfgang()) {

                                    $this->customClientDevice['isWolfgang'] = true;

                                } else {

                                    $this->customClientDevice['isWolfgang'] = false;
                                }

                            }

                            return $this->customClientDevice['isWolfgang'];

                        break;
                        case 'isalcatel':

                            if (!isset($this->customClientDevice['isAlcatel'])) {

                                if ($this->oMOBI_DETECT->isAlcatel()) {

                                    $this->customClientDevice['isAlcatel'] = true;

                                } else {

                                    $this->customClientDevice['isAlcatel'] = false;
                                }

                            }

                            return $this->customClientDevice['isAlcatel'];

                        break;
                        case 'isnintendo':

                            if (!isset($this->customClientDevice['isNintendo'])) {

                                if ($this->oMOBI_DETECT->isNintendo()) {

                                    $this->customClientDevice['isNintendo'] = true;

                                } else {

                                    $this->customClientDevice['isNintendo'] = false;
                                }
                            }

                            return $this->customClientDevice['isNintendo'];

                        break;
                        case 'isamoi':

                            if (!isset($this->customClientDevice['isAmoi'])) {

                                if ($this->oMOBI_DETECT->isAmoi()) {

                                    $this->customClientDevice['isAmoi'] = true;

                                } else {

                                    $this->customClientDevice['isAmoi'] = false;
                                }

                            }

                            return $this->customClientDevice['isAmoi'];

                        break;
                        case 'isinq':

                            if (!isset($this->customClientDevice['isINQ'])) {

                                if ($this->oMOBI_DETECT->isINQ()) {

                                    $this->customClientDevice['isINQ'] = true;

                                } else {

                                    $this->customClientDevice['isINQ'] = false;
                                }

                            }

                            return $this->customClientDevice['isINQ'];

                        break;
                        case 'isoneplus':

                            if (!isset($this->customClientDevice['isOnePlus'])) {

                                if ($this->oMOBI_DETECT->isOnePlus()) {

                                    $this->customClientDevice['isOnePlus'] = true;

                                } else {

                                    $this->customClientDevice['isOnePlus'] = false;
                                }

                            }

                            return $this->customClientDevice['isOnePlus'];

                        break;
                        case 'isgenericphone':

                            if (!isset($this->customClientDevice['isGenericPhone'])) {

                                if ($this->oMOBI_DETECT->isGenericPhone()) {

                                    $this->customClientDevice['isGenericPhone'] = true;

                                } else {

                                    $this->customClientDevice['isGenericPhone'] = false;
                                }
                            }

                            return $this->customClientDevice['isGenericPhone'];

                        break;
                        case 'isipad':

                            if (!isset($this->customClientDevice['isiPad'])) {

                                if ($this->oMOBI_DETECT->isiPad()) {

                                    $this->customClientDevice['isiPad'] = true;

                                } else {

                                    $this->customClientDevice['isiPad'] = false;
                                }
                            }

                            return $this->customClientDevice['isiPad'];

                        break;
                        case 'isnexustablet':

                            if (!isset($this->customClientDevice['isNexusTablet'])) {

                                if ($this->oMOBI_DETECT->isNexusTablet()) {

                                    $this->customClientDevice['isNexusTablet'] = true;

                                } else {

                                    $this->customClientDevice['isNexusTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isNexusTablet'];

                        break;
                        case 'isgoogletablet':

                            if (!isset($this->customClientDevice['isGoogleTablet'])) {

                                if ($this->oMOBI_DETECT->isGoogleTablet()) {

                                    $this->customClientDevice['isGoogleTablet'] = true;

                                } else {

                                    $this->customClientDevice['isGoogleTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isGoogleTablet'];

                        break;
                        case 'issamsungtablet':

                            if (!isset($this->customClientDevice['isSamsungTablet'])) {

                                if ($this->oMOBI_DETECT->isSamsungTablet()) {

                                    $this->customClientDevice['isSamsungTablet'] = true;

                                } else {

                                    $this->customClientDevice['isSamsungTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isSamsungTablet'];

                        break;
                        case 'iskindle':

                            if (!isset($this->customClientDevice['isKindle'])) {

                                if ($this->oMOBI_DETECT->isKindle()) {

                                    $this->customClientDevice['isKindle'] = true;

                                } else {

                                    $this->customClientDevice['isKindle'] = false;
                                }

                            }

                            return $this->customClientDevice['isKindle'];

                        break;
                        case 'issurfacetablet':

                            if (!isset($this->customClientDevice['isSurfaceTablet'])) {

                                if ($this->oMOBI_DETECT->isSurfaceTablet()) {

                                    $this->customClientDevice['isSurfaceTablet'] = true;

                                } else {

                                    $this->customClientDevice['isSurfaceTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isSurfaceTablet'];

                        break;
                        case 'ishptablet':

                            if (!isset($this->customClientDevice['isHPTablet'])) {

                                if ($this->oMOBI_DETECT->isHPTablet()) {

                                    $this->customClientDevice['isHPTablet'] = true;

                                } else {

                                    $this->customClientDevice['isHPTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isHPTablet'];

                        break;
                        case 'isasustablet':

                            if (!isset($this->customClientDevice['isAsusTablet'])) {

                                if ($this->oMOBI_DETECT->isAsusTablet()) {

                                    $this->customClientDevice['isAsusTablet'] = true;

                                } else {

                                    $this->customClientDevice['isAsusTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isAsusTablet'];

                        break;
                        case 'isblackberrytablet':

                            if (!isset($this->customClientDevice['isBlackBerryTablet'])) {

                                if ($this->oMOBI_DETECT->isBlackBerryTablet()) {

                                    $this->customClientDevice['isBlackBerryTablet'] = true;

                                } else {

                                    $this->customClientDevice['isBlackBerryTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isBlackBerryTablet'];

                        break;
                        case 'ishtctablet':

                            if (!isset($this->customClientDevice['isHTCtablet'])) {

                                if ($this->oMOBI_DETECT->isHTCtablet()) {

                                    $this->customClientDevice['isHTCtablet'] = true;

                                } else {

                                    $this->customClientDevice['isHTCtablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isHTCtablet'];

                        break;
                        case 'ismotorolatablet':

                            if (!isset($this->customClientDevice['isMotorolaTablet'])) {

                                if ($this->oMOBI_DETECT->isMotorolaTablet()) {

                                    $this->customClientDevice['isMotorolaTablet'] = true;

                                } else {

                                    $this->customClientDevice['isMotorolaTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isMotorolaTablet'];

                        break;
                        case 'isnooktablet':

                            if (!isset($this->customClientDevice['isNookTablet'])) {

                                if ($this->oMOBI_DETECT->isNookTablet()) {

                                    $this->customClientDevice['isNookTablet'] = true;

                                } else {

                                    $this->customClientDevice['isNookTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isNookTablet'];

                        break;
                        case 'isacertablet':

                            if (!isset($this->customClientDevice['isAcerTablet'])) {

                                if ($this->oMOBI_DETECT->isAcerTablet()) {

                                    $this->customClientDevice['isAcerTablet'] = true;

                                } else {

                                    $this->customClientDevice['isAcerTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isAcerTablet'];

                        break;
                        case 'istoshibatablet':

                            if (!isset($this->customClientDevice['isToshibaTablet'])) {

                                if ($this->oMOBI_DETECT->isToshibaTablet()) {

                                    $this->customClientDevice['isToshibaTablet'] = true;

                                } else {

                                    $this->customClientDevice['isToshibaTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isToshibaTablet'];

                        break;
                        case 'islgtablet':

                            if (!isset($this->customClientDevice['isLGTablet'])) {

                                if ($this->oMOBI_DETECT->isLGTablet()) {

                                    $this->customClientDevice['isLGTablet'] = true;

                                } else {

                                    $this->customClientDevice['isLGTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isLGTablet'];

                        break;
                        case 'isfujitsutablet':

                            if (!isset($this->customClientDevice['isFujitsuTablet'])) {

                                if ($this->oMOBI_DETECT->isFujitsuTablet()) {

                                    $this->customClientDevice['isFujitsuTablet'] = true;

                                } else {

                                    $this->customClientDevice['isFujitsuTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isFujitsuTablet'];

                        break;
                        case 'isprestigiotablet':

                            if (!isset($this->customClientDevice['isPrestigioTablet'])) {

                                if ($this->oMOBI_DETECT->isPrestigioTablet()) {

                                    $this->customClientDevice['isPrestigioTablet'] = true;

                                } else {

                                    $this->customClientDevice['isPrestigioTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isPrestigioTablet'];

                        break;
                        case 'islenovotablet':

                            if (!isset($this->customClientDevice['isLenovoTablet'])) {

                                if ($this->oMOBI_DETECT->isLenovoTablet()) {

                                    $this->customClientDevice['isLenovoTablet'] = true;

                                } else {

                                    $this->customClientDevice['isLenovoTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isLenovoTablet'];

                        break;
                        case 'isdelltablet':

                            if (!isset($this->customClientDevice['isDellTablet'])) {

                                if ($this->oMOBI_DETECT->isDellTablet()) {

                                    $this->customClientDevice['isDellTablet'] = true;

                                } else {

                                    $this->customClientDevice['isDellTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isDellTablet'];

                        break;
                        case 'isyarviktablet':

                            if (!isset($this->customClientDevice['isYarvikTablet'])) {

                                if ($this->oMOBI_DETECT->isYarvikTablet()) {

                                    $this->customClientDevice['isYarvikTablet'] = true;

                                } else {

                                    $this->customClientDevice['isYarvikTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isYarvikTablet'];

                        break;
                        case 'ismediontablet':

                            if (!isset($this->customClientDevice['isMedionTablet'])) {

                                if ($this->oMOBI_DETECT->isMedionTablet()) {

                                    $this->customClientDevice['isMedionTablet'] = true;

                                } else {

                                    $this->customClientDevice['isMedionTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isMedionTablet'];

                        break;
                        case 'isarnovatablet':

                            if (!isset($this->customClientDevice['isArnovaTablet'])) {

                                if ($this->oMOBI_DETECT->isArnovaTablet()) {

                                    $this->customClientDevice['isArnovaTablet'] = true;

                                } else {

                                    $this->customClientDevice['isArnovaTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isArnovaTablet'];

                        break;
                        case 'isintensotablet':

                            if (!isset($this->customClientDevice['isIntensoTablet'])) {

                                if ($this->oMOBI_DETECT->isIntensoTablet()) {

                                    $this->customClientDevice['isIntensoTablet'] = true;

                                } else {

                                    $this->customClientDevice['isIntensoTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isIntensoTablet'];

                        break;
                        case 'isirutablet':

                            if (!isset($this->customClientDevice['isIRUTablet'])) {

                                if ($this->oMOBI_DETECT->isIRUTablet()) {

                                    $this->customClientDevice['isIRUTablet'] = true;

                                } else {

                                    $this->customClientDevice['isIRUTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isIRUTablet'];

                        break;
                        case 'ismegafontablet':

                            if (!isset($this->customClientDevice['isMegafonTablet'])) {

                                if ($this->oMOBI_DETECT->isMegafonTablet()) {

                                    $this->customClientDevice['isMegafonTablet'] = true;

                                } else {

                                    $this->customClientDevice['isMegafonTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isMegafonTablet'];

                        break;
                        case 'isebodatablet':

                            if (!isset($this->customClientDevice['isEbodaTablet'])) {

                                if ($this->oMOBI_DETECT->isEbodaTablet()) {

                                    $this->customClientDevice['isEbodaTablet'] = true;

                                } else {

                                    $this->customClientDevice['isEbodaTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isEbodaTablet'];

                        break;
                        case 'isallviewtablet':

                            if (!isset($this->customClientDevice['isAllViewTablet'])) {

                                if ($this->oMOBI_DETECT->isAllViewTablet()) {

                                    $this->customClientDevice['isAllViewTablet'] = true;

                                } else {

                                    $this->customClientDevice['isAllViewTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isAllViewTablet'];

                        break;
                        case 'isarchostablet':

                            if (!isset($this->customClientDevice['isArchosTablet'])) {

                                if ($this->oMOBI_DETECT->isArchosTablet()) {

                                    $this->customClientDevice['isArchosTablet'] = true;

                                } else {

                                    $this->customClientDevice['isArchosTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isArchosTablet'];

                        break;
                        case 'isainoltablet':

                            if (!isset($this->customClientDevice['isAinolTablet'])) {

                                if ($this->oMOBI_DETECT->isAinolTablet()) {

                                    $this->customClientDevice['isAinolTablet'] = true;

                                } else {

                                    $this->customClientDevice['isAinolTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isAinolTablet'];

                        break;
                        case 'isnokialumiatablet':

                            if (!isset($this->customClientDevice['isNokiaLumiaTablet'])) {

                                if ($this->oMOBI_DETECT->isNokiaLumiaTablet()) {

                                    $this->customClientDevice['isNokiaLumiaTablet'] = true;

                                } else {

                                    $this->customClientDevice['isNokiaLumiaTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isNokiaLumiaTablet'];

                        break;
                        case 'issonytablet':

                            if (!isset($this->customClientDevice['isSonyTablet'])) {

                                if ($this->oMOBI_DETECT->isSonyTablet()) {

                                    $this->customClientDevice['isSonyTablet'] = true;

                                } else {

                                    $this->customClientDevice['isSonyTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isSonyTablet'];

                        break;
                        case 'isphilipstablet':

                            if (!isset($this->customClientDevice['isPhilipsTablet'])) {

                                if ($this->oMOBI_DETECT->isPhilipsTablet()) {

                                    $this->customClientDevice['isPhilipsTablet'] = true;

                                } else {

                                    $this->customClientDevice['isPhilipsTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isPhilipsTablet'];

                        break;
                        case 'iscubetablet':

                            if (!isset($this->customClientDevice['isCubeTablet'])) {

                                if ($this->oMOBI_DETECT->isCubeTablet()) {

                                    $this->customClientDevice['isCubeTablet'] = true;

                                } else {

                                    $this->customClientDevice['isCubeTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isCubeTablet'];

                        break;
                        case 'iscobytablet':

                            if (!isset($this->customClientDevice['isCobyTablet'])) {

                                if ($this->oMOBI_DETECT->isCobyTablet()) {

                                    $this->customClientDevice['isCobyTablet'] = true;

                                } else {

                                    $this->customClientDevice['isCobyTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isCobyTablet'];

                        break;
                        case 'ismidtablet':

                            if (!isset($this->customClientDevice['isMIDTablet'])) {

                                if ($this->oMOBI_DETECT->isMIDTablet()) {

                                    $this->customClientDevice['isMIDTablet'] = true;

                                } else {

                                    $this->customClientDevice['isMIDTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isMIDTablet'];

                        break;
                        case 'ismsitablet':

                            if (!isset($this->customClientDevice['isMSITablet'])) {

                                if ($this->oMOBI_DETECT->isMSITablet()) {

                                    $this->customClientDevice['isMSITablet'] = true;

                                } else {

                                    $this->customClientDevice['isMSITablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isMSITablet'];

                        break;
                        case 'issmittablet':

                            if (!isset($this->customClientDevice['isSMiTTablet'])) {

                                if ($this->oMOBI_DETECT->isSMiTTablet()) {

                                    $this->customClientDevice['isSMiTTablet'] = true;

                                } else {

                                    $this->customClientDevice['isSMiTTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isSMiTTablet'];

                        break;
                        case 'isrockchiptablet':

                            if (!isset($this->customClientDevice['isRockChipTablet'])) {

                                if ($this->oMOBI_DETECT->isRockChipTablet()) {

                                    $this->customClientDevice['isRockChipTablet'] = true;

                                } else {

                                    $this->customClientDevice['isRockChipTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isRockChipTablet'];

                        break;
                        case 'isflytablet':

                            if (!isset($this->customClientDevice['isFlyTablet'])) {

                                if ($this->oMOBI_DETECT->isFlyTablet()) {

                                    $this->customClientDevice['isFlyTablet'] = true;

                                } else {

                                    $this->customClientDevice['isFlyTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isFlyTablet'];

                        break;
                        case 'isbqtablet':

                            if (!isset($this->customClientDevice['isbqTablet'])) {

                                if ($this->oMOBI_DETECT->isbqTablet()) {

                                    $this->customClientDevice['isbqTablet'] = true;

                                } else {

                                    $this->customClientDevice['isbqTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isbqTablet'];

                        break;
                        case 'ishuaweitablet':

                            if (!isset($this->customClientDevice['isHuaweiTablet'])) {

                                if ($this->oMOBI_DETECT->isHuaweiTablet()) {

                                    $this->customClientDevice['isHuaweiTablet'] = true;

                                } else {

                                    $this->customClientDevice['isHuaweiTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isHuaweiTablet'];

                        break;
                        case 'isnectablet':

                            if (!isset($this->customClientDevice['isNecTablet'])) {

                                if ($this->oMOBI_DETECT->isNecTablet()) {

                                    $this->customClientDevice['isNecTablet'] = true;

                                } else {

                                    $this->customClientDevice['isNecTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isNecTablet'];

                        break;
                        case 'ispantechtablet':

                            if (!isset($this->customClientDevice['isPantechTablet'])) {

                                if ($this->oMOBI_DETECT->isPantechTablet()) {

                                    $this->customClientDevice['isPantechTablet'] = true;

                                } else {

                                    $this->customClientDevice['isPantechTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isPantechTablet'];

                        break;
                        case 'isbronchotablet':

                            if (!isset($this->customClientDevice['isBronchoTablet'])) {

                                if ($this->oMOBI_DETECT->isBronchoTablet()) {

                                    $this->customClientDevice['isBronchoTablet'] = true;

                                } else {

                                    $this->customClientDevice['isBronchoTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isBronchoTablet'];

                        break;
                        case 'isversustablet':

                            if (!isset($this->customClientDevice['isVersusTablet'])) {

                                if ($this->oMOBI_DETECT->isVersusTablet()) {

                                    $this->customClientDevice['isVersusTablet'] = true;

                                } else {

                                    $this->customClientDevice['isVersusTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isVersusTablet'];

                        break;
                        case 'iszynctablet':

                            if (!isset($this->customClientDevice['isZyncTablet'])) {

                                if ($this->oMOBI_DETECT->isZyncTablet()) {

                                    $this->customClientDevice['isZyncTablet'] = true;

                                } else {

                                    $this->customClientDevice['isZyncTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isZyncTablet'];

                        break;
                        case 'ispositivotablet':

                            if (!isset($this->customClientDevice['isPositivoTablet'])) {

                                if ($this->oMOBI_DETECT->isPositivoTablet()) {

                                    $this->customClientDevice['isPositivoTablet'] = true;

                                } else {

                                    $this->customClientDevice['isPositivoTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isPositivoTablet'];

                        break;
                        case 'isnabitablet':

                            if (!isset($this->customClientDevice['isNabiTablet'])) {

                                if ($this->oMOBI_DETECT->isNabiTablet()) {

                                    $this->customClientDevice['isNabiTablet'] = true;

                                } else {

                                    $this->customClientDevice['isNabiTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isNabiTablet'];

                        break;
                        case 'iskobotablet':

                            if (!isset($this->customClientDevice['isKoboTablet'])) {

                                if ($this->oMOBI_DETECT->isKoboTablet()) {

                                    $this->customClientDevice['isKoboTablet'] = true;

                                } else {

                                    $this->customClientDevice['isKoboTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isKoboTablet'];

                        break;
                        case 'isdanewtablet':

                            if (!isset($this->customClientDevice['isDanewTablet'])) {

                                if ($this->oMOBI_DETECT->isDanewTablet()) {

                                    $this->customClientDevice['isDanewTablet'] = true;

                                } else {

                                    $this->customClientDevice['isDanewTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isDanewTablet'];

                        break;
                        case 'istexettablet':

                            if (!isset($this->customClientDevice['isTexetTablet'])) {

                                if ($this->oMOBI_DETECT->isTexetTablet()) {

                                    $this->customClientDevice['isTexetTablet'] = true;

                                } else {

                                    $this->customClientDevice['isTexetTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isTexetTablet'];

                        break;
                        case 'isplaystationtablet':

                            if (!isset($this->customClientDevice['isPlaystationTablet'])) {

                                if ($this->oMOBI_DETECT->isPlaystationTablet()) {

                                    $this->customClientDevice['isPlaystationTablet'] = true;

                                } else {

                                    $this->customClientDevice['isPlaystationTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isPlaystationTablet'];

                        break;
                        case 'istrekstortablet':

                            if (!isset($this->customClientDevice['isTrekstorTablet'])) {

                                if ($this->oMOBI_DETECT->isTrekstorTablet()) {

                                    $this->customClientDevice['isTrekstorTablet'] = true;

                                } else {

                                    $this->customClientDevice['isTrekstorTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isTrekstorTablet'];

                        break;
                        case 'ispyleaudiotablet':

                            if (!isset($this->customClientDevice['isPyleAudioTablet'])) {

                                if ($this->oMOBI_DETECT->isPyleAudioTablet()) {

                                    $this->customClientDevice['isPyleAudioTablet'] = true;

                                } else {

                                    $this->customClientDevice['isPyleAudioTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isPyleAudioTablet'];

                        break;
                        case 'isadvantablet':

                            if (!isset($this->customClientDevice['isAdvanTablet'])) {

                                if ($this->oMOBI_DETECT->isAdvanTablet()) {

                                    $this->customClientDevice['isAdvanTablet'] = true;

                                } else {

                                    $this->customClientDevice['isAdvanTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isAdvanTablet'];

                        break;
                        case 'isdanytechtablet':

                            if (!isset($this->customClientDevice['isDanyTechTablet'])) {

                                if ($this->oMOBI_DETECT->isDanyTechTablet()) {

                                    $this->customClientDevice['isDanyTechTablet'] = true;

                                } else {

                                    $this->customClientDevice['isDanyTechTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isDanyTechTablet'];

                        break;
                        case 'isgalapadtablet':

                            if (!isset($this->customClientDevice['isGalapadTablet'])) {

                                if ($this->oMOBI_DETECT->isGalapadTablet()) {

                                    $this->customClientDevice['isGalapadTablet'] = true;

                                } else {

                                    $this->customClientDevice['isGalapadTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isGalapadTablet'];

                        break;
                        case 'ismicromaxtablet':

                            if (!isset($this->customClientDevice['isMicromaxTablet'])) {

                                if ($this->oMOBI_DETECT->isMicromaxTablet()) {

                                    $this->customClientDevice['isMicromaxTablet'] = true;

                                } else {

                                    $this->customClientDevice['isMicromaxTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isMicromaxTablet'];

                        break;
                        case 'iskarbonntablet':

                            if (!isset($this->customClientDevice['isKarbonnTablet'])) {

                                if ($this->oMOBI_DETECT->isKarbonnTablet()) {

                                    $this->customClientDevice['isKarbonnTablet'] = true;

                                } else {

                                    $this->customClientDevice['isKarbonnTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isKarbonnTablet'];

                        break;
                        case 'isallfinetablet':

                            if (!isset($this->customClientDevice['isAllFineTablet'])) {

                                if ($this->oMOBI_DETECT->isAllFineTablet()) {

                                    $this->customClientDevice['isAllFineTablet'] = true;

                                } else {

                                    $this->customClientDevice['isAllFineTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isAllFineTablet'];

                        break;
                        case 'isproscantablet':

                            if (!isset($this->customClientDevice['isPROSCANTablet'])) {

                                if ($this->oMOBI_DETECT->isPROSCANTablet()) {

                                    $this->customClientDevice['isPROSCANTablet'] = true;

                                } else {

                                    $this->customClientDevice['isPROSCANTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isPROSCANTablet'];

                        break;
                        case 'isyonestablet':

                            if (!isset($this->customClientDevice['isYONESTablet'])) {

                                if ($this->oMOBI_DETECT->isYONESTablet()) {

                                    $this->customClientDevice['isYONESTablet'] = true;

                                } else {

                                    $this->customClientDevice['isYONESTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isYONESTablet'];

                        break;
                        case 'ischangjiatablet':

                            if (!isset($this->customClientDevice['isChangJiaTablet'])) {

                                if ($this->oMOBI_DETECT->isChangJiaTablet()) {

                                    $this->customClientDevice['isChangJiaTablet'] = true;

                                } else {

                                    $this->customClientDevice['isChangJiaTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isChangJiaTablet'];

                        break;
                        case 'isgutablet':

                            if (!isset($this->customClientDevice['isGUTablet'])) {

                                if ($this->oMOBI_DETECT->isGUTablet()) {

                                    $this->customClientDevice['isGUTablet'] = true;

                                } else {

                                    $this->customClientDevice['isGUTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isGUTablet'];

                        break;
                        case 'ispointofviewtablet':

                            if (!isset($this->customClientDevice['isPointOfViewTablet'])) {

                                if ($this->oMOBI_DETECT->isPointOfViewTablet()) {

                                    $this->customClientDevice['isPointOfViewTablet'] = true;

                                } else {

                                    $this->customClientDevice['isPointOfViewTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isPointOfViewTablet'];

                        break;
                        case 'isovermaxtablet':

                            if (!isset($this->customClientDevice['isOvermaxTablet'])) {

                                if ($this->oMOBI_DETECT->isOvermaxTablet()) {

                                    $this->customClientDevice['isOvermaxTablet'] = true;

                                } else {

                                    $this->customClientDevice['isOvermaxTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isOvermaxTablet'];

                        break;
                        case 'ishcltablet':

                            if (!isset($this->customClientDevice['isHCLTablet'])) {

                                if ($this->oMOBI_DETECT->isHCLTablet()) {

                                    $this->customClientDevice['isHCLTablet'] = true;

                                } else {

                                    $this->customClientDevice['isHCLTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isHCLTablet'];

                        break;
                        case 'isdpstablet':

                            if (!isset($this->customClientDevice['isDPSTablet'])) {

                                if ($this->oMOBI_DETECT->isDPSTablet()) {

                                    $this->customClientDevice['isDPSTablet'] = true;

                                } else {

                                    $this->customClientDevice['isDPSTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isDPSTablet'];

                        break;
                        case 'isvisturetablet':

                            if (!isset($this->customClientDevice['isVistureTablet'])) {

                                if ($this->oMOBI_DETECT->isVistureTablet()) {

                                    $this->customClientDevice['isVistureTablet'] = true;

                                } else {

                                    $this->customClientDevice['isVistureTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isVistureTablet'];

                        break;
                        case 'iscrestatablet':

                            if (!isset($this->customClientDevice['isCrestaTablet'])) {

                                if ($this->oMOBI_DETECT->isCrestaTablet()) {

                                    $this->customClientDevice['isCrestaTablet'] = true;

                                } else {

                                    $this->customClientDevice['isCrestaTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isCrestaTablet'];

                        break;
                        case 'ismediatektablet':

                            if (!isset($this->customClientDevice['isMediatekTablet'])) {

                                if ($this->oMOBI_DETECT->isMediatekTablet()) {

                                    $this->customClientDevice['isMediatekTablet'] = true;

                                } else {

                                    $this->customClientDevice['isMediatekTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isMediatekTablet'];

                        break;
                        case 'isconcordetablet':

                            if (!isset($this->customClientDevice['isConcordeTablet'])) {

                                if ($this->oMOBI_DETECT->isConcordeTablet()) {

                                    $this->customClientDevice['isConcordeTablet'] = true;

                                } else {

                                    $this->customClientDevice['isConcordeTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isConcordeTablet'];

                        break;
                        case 'isgoclevertablet':

                            if (!isset($this->customClientDevice['isGoCleverTablet'])) {

                                if ($this->oMOBI_DETECT->isGoCleverTablet()) {

                                    $this->customClientDevice['isGoCleverTablet'] = true;

                                } else {

                                    $this->customClientDevice['isGoCleverTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isGoCleverTablet'];

                        break;
                        case 'ismodecomtablet':

                            if (!isset($this->customClientDevice['isModecomTablet'])) {

                                if ($this->oMOBI_DETECT->isModecomTablet()) {

                                    $this->customClientDevice['isModecomTablet'] = true;

                                } else {

                                    $this->customClientDevice['isModecomTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isModecomTablet'];

                        break;
                        case 'isvoninotablet':

                            if (!isset($this->customClientDevice['isVoninoTablet'])) {

                                if ($this->oMOBI_DETECT->isVoninoTablet()) {

                                    $this->customClientDevice['isVoninoTablet'] = true;

                                } else {

                                    $this->customClientDevice['isVoninoTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isVoninoTablet'];

                        break;
                        case 'isecstablet':

                            if (!isset($this->customClientDevice['isECSTablet'])) {

                                if ($this->oMOBI_DETECT->isECSTablet()) {

                                    $this->customClientDevice['isECSTablet'] = true;

                                } else {

                                    $this->customClientDevice['isECSTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isECSTablet'];

                        break;
                        case 'isstorextablet':

                            if (!isset($this->customClientDevice['isStorexTablet'])) {

                                if ($this->oMOBI_DETECT->isStorexTablet()) {

                                    $this->customClientDevice['isStorexTablet'] = true;

                                } else {

                                    $this->customClientDevice['isStorexTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isStorexTablet'];

                        break;
                        case 'isvodafonetablet':

                            if (!isset($this->customClientDevice['isVodafoneTablet'])) {

                                if ($this->oMOBI_DETECT->isVodafoneTablet()) {

                                    $this->customClientDevice['isVodafoneTablet'] = true;

                                } else {

                                    $this->customClientDevice['isVodafoneTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isVodafoneTablet'];

                        break;
                        case 'isessentielbtablet':

                            if (!isset($this->customClientDevice['isEssentielBTablet'])) {

                                if ($this->oMOBI_DETECT->isEssentielBTablet()) {

                                    $this->customClientDevice['isEssentielBTablet'] = true;

                                } else {

                                    $this->customClientDevice['isEssentielBTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isEssentielBTablet'];

                        break;
                        case 'isrossmoortablet':

                            if (!isset($this->customClientDevice['isRossMoorTablet'])) {

                                if ($this->oMOBI_DETECT->isRossMoorTablet()) {

                                    $this->customClientDevice['isRossMoorTablet'] = true;

                                } else {

                                    $this->customClientDevice['isRossMoorTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isRossMoorTablet'];

                        break;
                        case 'isimobiletablet':

                            if (!isset($this->customClientDevice['isiMobileTablet'])) {

                                if ($this->oMOBI_DETECT->isiMobileTablet()) {

                                    $this->customClientDevice['isiMobileTablet'] = true;

                                } else {

                                    $this->customClientDevice['isiMobileTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isiMobileTablet'];

                        break;
                        case 'istolinotablet':

                            if (!isset($this->customClientDevice['isTolinoTablet'])) {

                                if ($this->oMOBI_DETECT->isTolinoTablet()) {

                                    $this->customClientDevice['isTolinoTablet'] = true;

                                } else {

                                    $this->customClientDevice['isTolinoTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isTolinoTablet'];

                        break;
                        case 'isaudiosonictablet':

                            if (!isset($this->customClientDevice['isAudioSonicTablet'])) {

                                if ($this->oMOBI_DETECT->isAudioSonicTablet()) {

                                    $this->customClientDevice['isAudioSonicTablet'] = true;

                                } else {

                                    $this->customClientDevice['isAudioSonicTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isAudioSonicTablet'];

                        break;
                        case 'isampetablet':

                            if (!isset($this->customClientDevice['isAMPETablet'])) {

                                if ($this->oMOBI_DETECT->isAMPETablet()) {

                                    $this->customClientDevice['isAMPETablet'] = true;

                                } else {

                                    $this->customClientDevice['isAMPETablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isAMPETablet'];

                        break;
                        case 'isskktablet':

                            if (!isset($this->customClientDevice['isSkkTablet'])) {

                                if ($this->oMOBI_DETECT->isSkkTablet()) {

                                    $this->customClientDevice['isSkkTablet'] = true;

                                } else {

                                    $this->customClientDevice['isSkkTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isSkkTablet'];

                        break;
                        case 'istecnotablet':

                            if (!isset($this->customClientDevice['isTecnoTablet'])) {

                                if ($this->oMOBI_DETECT->isTecnoTablet()) {

                                    $this->customClientDevice['isTecnoTablet'] = true;

                                } else {

                                    $this->customClientDevice['isTecnoTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isTecnoTablet'];

                        break;
                        case 'isjxdtablet':

                            if (!isset($this->customClientDevice['isJXDTablet'])) {

                                if ($this->oMOBI_DETECT->isJXDTablet()) {

                                    $this->customClientDevice['isJXDTablet'] = true;

                                } else {

                                    $this->customClientDevice['isJXDTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isJXDTablet'];

                        break;
                        case 'isijoytablet':

                            if (!isset($this->customClientDevice['isiJoyTablet'])) {

                                if ($this->oMOBI_DETECT->isiJoyTablet()) {

                                    $this->customClientDevice['isiJoyTablet'] = true;

                                } else {

                                    $this->customClientDevice['isiJoyTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isiJoyTablet'];

                        break;
                        case 'isfx2tablet':

                            if (!isset($this->customClientDevice['isFX2Tablet'])) {

                                if ($this->oMOBI_DETECT->isFX2Tablet()) {

                                    $this->customClientDevice['isFX2Tablet'] = true;

                                } else {

                                    $this->customClientDevice['isFX2Tablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isFX2Tablet'];

                        break;
                        case 'isxorotablet':

                            if (!isset($this->customClientDevice['isXoroTablet'])) {

                                if ($this->oMOBI_DETECT->isXoroTablet()) {

                                    $this->customClientDevice['isXoroTablet'] = true;

                                } else {

                                    $this->customClientDevice['isXoroTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isXoroTablet'];

                        break;
                        case 'isviewsonictablet':

                            if (!isset($this->customClientDevice['isViewsonicTablet'])) {

                                if ($this->oMOBI_DETECT->isViewsonicTablet()) {

                                    $this->customClientDevice['isViewsonicTablet'] = true;

                                } else {

                                    $this->customClientDevice['isViewsonicTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isViewsonicTablet'];

                        break;
                        case 'isverizontablet':

                            if (!isset($this->customClientDevice['isVerizonTablet'])) {

                                if ($this->oMOBI_DETECT->isVerizonTablet()) {

                                    $this->customClientDevice['isVerizonTablet'] = true;

                                } else {

                                    $this->customClientDevice['isVerizonTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isVerizonTablet'];

                        break;
                        case 'isodystablet':

                            if (!isset($this->customClientDevice['isOdysTablet'])) {

                                if ($this->oMOBI_DETECT->isOdysTablet()) {

                                    $this->customClientDevice['isOdysTablet'] = true;

                                } else {

                                    $this->customClientDevice['isOdysTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isOdysTablet'];

                        break;
                        case 'iscaptivatablet':

                            if (!isset($this->customClientDevice['isCaptivaTablet'])) {

                                if ($this->oMOBI_DETECT->isCaptivaTablet()) {

                                    $this->customClientDevice['isCaptivaTablet'] = true;

                                } else {

                                    $this->customClientDevice['isCaptivaTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isCaptivaTablet'];

                        break;
                        case 'isiconbittablet':

                            if (!isset($this->customClientDevice['isIconbitTablet'])) {

                                if ($this->oMOBI_DETECT->isIconbitTablet()) {

                                    $this->customClientDevice['isIconbitTablet'] = true;

                                } else {

                                    $this->customClientDevice['isIconbitTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isIconbitTablet'];

                        break;
                        case 'isteclasttablet':

                            if (!isset($this->customClientDevice['isTeclastTablet'])) {

                                if ($this->oMOBI_DETECT->isTeclastTablet()) {

                                    $this->customClientDevice['isTeclastTablet'] = true;

                                } else {

                                    $this->customClientDevice['isTeclastTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isTeclastTablet'];

                        break;
                        case 'isondatablet':

                            if (!isset($this->customClientDevice['isOndaTablet'])) {

                                if ($this->oMOBI_DETECT->isOndaTablet()) {

                                    $this->customClientDevice['isOndaTablet'] = true;

                                } else {

                                    $this->customClientDevice['isOndaTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isOndaTablet'];

                        break;
                        case 'isjaytechtablet':

                            if (!isset($this->customClientDevice['isJaytechTablet'])) {

                                if ($this->oMOBI_DETECT->isJaytechTablet()) {

                                    $this->customClientDevice['isJaytechTablet'] = true;

                                } else {

                                    $this->customClientDevice['isJaytechTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isJaytechTablet'];

                        break;
                        case 'isblaupunkttablet':

                            if (!isset($this->customClientDevice['isBlaupunktTablet'])) {

                                if ($this->oMOBI_DETECT->isBlaupunktTablet()) {

                                    $this->customClientDevice['isBlaupunktTablet'] = true;

                                } else {

                                    $this->customClientDevice['isBlaupunktTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isBlaupunktTablet'];

                        break;
                        case 'isdigmatablet':

                            if (!isset($this->customClientDevice['isDigmaTablet'])) {

                                if ($this->oMOBI_DETECT->isDigmaTablet()) {

                                    $this->customClientDevice['isDigmaTablet'] = true;

                                } else {

                                    $this->customClientDevice['isDigmaTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isDigmaTablet'];

                        break;
                        case 'isevoliotablet':

                            if (!isset($this->customClientDevice['isEvolioTablet'])) {

                                if ($this->oMOBI_DETECT->isEvolioTablet()) {

                                    $this->customClientDevice['isEvolioTablet'] = true;

                                } else {

                                    $this->customClientDevice['isEvolioTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isEvolioTablet'];

                        break;
                        case 'islavatablet':

                            if (!isset($this->customClientDevice['isLavaTablet'])) {

                                if ($this->oMOBI_DETECT->isLavaTablet()) {

                                    $this->customClientDevice['isLavaTablet'] = true;

                                } else {

                                    $this->customClientDevice['isLavaTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isLavaTablet'];

                        break;
                        case 'isaoctablet':

                            if (!isset($this->customClientDevice['isAocTablet'])) {

                                if ($this->oMOBI_DETECT->isAocTablet()) {

                                    $this->customClientDevice['isAocTablet'] = true;

                                } else {

                                    $this->customClientDevice['isAocTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isAocTablet'];

                        break;
                        case 'ismpmantablet':

                            if (!isset($this->customClientDevice['isMpmanTablet'])) {

                                if ($this->oMOBI_DETECT->isMpmanTablet()) {

                                    $this->customClientDevice['isMpmanTablet'] = true;

                                } else {

                                    $this->customClientDevice['isMpmanTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isMpmanTablet'];

                        break;
                        case 'iscelkontablet':

                            if (!isset($this->customClientDevice['isCelkonTablet'])) {

                                if ($this->oMOBI_DETECT->isCelkonTablet()) {

                                    $this->customClientDevice['isCelkonTablet'] = true;

                                } else {

                                    $this->customClientDevice['isCelkonTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isCelkonTablet'];

                        break;
                        case 'iswoldertablet':

                            if (!isset($this->customClientDevice['isWolderTablet'])) {

                                if ($this->oMOBI_DETECT->isWolderTablet()) {

                                    $this->customClientDevice['isWolderTablet'] = true;

                                } else {

                                    $this->customClientDevice['isWolderTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isWolderTablet'];

                        break;
                        case 'ismediacomtablet':

                            if (!isset($this->customClientDevice['isMediacomTablet'])) {

                                if ($this->oMOBI_DETECT->isMediacomTablet()) {

                                    $this->customClientDevice['isMediacomTablet'] = true;

                                } else {

                                    $this->customClientDevice['isMediacomTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isMediacomTablet'];

                        break;
                        case 'ismitablet':

                            if (!isset($this->customClientDevice['isMiTablet'])) {

                                if ($this->oMOBI_DETECT->isMiTablet()) {

                                    $this->customClientDevice['isMiTablet'] = true;

                                } else {

                                    $this->customClientDevice['isMiTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isMiTablet'];

                        break;
                        case 'isnibirutablet':

                            if (!isset($this->customClientDevice['isNibiruTablet'])) {

                                if ($this->oMOBI_DETECT->isNibiruTablet()) {

                                    $this->customClientDevice['isNibiruTablet'] = true;

                                } else {

                                    $this->customClientDevice['isNibiruTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isNibiruTablet'];

                        break;
                        case 'isnexotablet':

                            if (!isset($this->customClientDevice['isNexoTablet'])) {

                                if ($this->oMOBI_DETECT->isNexoTablet()) {

                                    $this->customClientDevice['isNexoTablet'] = true;

                                } else {

                                    $this->customClientDevice['isNexoTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isNexoTablet'];

                        break;
                        case 'isleadertablet':

                            if (!isset($this->customClientDevice['isLeaderTablet'])) {

                                if ($this->oMOBI_DETECT->isLeaderTablet()) {

                                    $this->customClientDevice['isLeaderTablet'] = true;

                                } else {

                                    $this->customClientDevice['isLeaderTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isLeaderTablet'];

                        break;
                        case 'isubislatetablet':

                            if (!isset($this->customClientDevice['isUbislateTablet'])) {

                                if ($this->oMOBI_DETECT->isUbislateTablet()) {

                                    $this->customClientDevice['isUbislateTablet'] = true;

                                } else {

                                    $this->customClientDevice['isUbislateTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isUbislateTablet'];

                        break;
                        case 'ispocketbooktablet':

                            if (!isset($this->customClientDevice['isPocketBookTablet'])) {

                                if ($this->oMOBI_DETECT->isPocketBookTablet()) {

                                    $this->customClientDevice['isPocketBookTablet'] = true;

                                } else {

                                    $this->customClientDevice['isPocketBookTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isPocketBookTablet'];

                        break;
                        case 'iskocasotablet':

                            if (!isset($this->customClientDevice['isKocasoTablet'])) {

                                if ($this->oMOBI_DETECT->isKocasoTablet()) {

                                    $this->customClientDevice['isKocasoTablet'] = true;

                                } else {

                                    $this->customClientDevice['isKocasoTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isKocasoTablet'];

                        break;
                        case 'ishisensetablet':

                            if (!isset($this->customClientDevice['isHisenseTablet'])) {

                                if ($this->oMOBI_DETECT->isHisenseTablet()) {

                                    $this->customClientDevice['isHisenseTablet'] = true;

                                } else {

                                    $this->customClientDevice['isHisenseTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isHisenseTablet'];

                        break;
                        case 'ishudl':

                            if (!isset($this->customClientDevice['isHudl'])) {

                                if ($this->oMOBI_DETECT->isHudl()) {

                                    $this->customClientDevice['isHudl'] = true;

                                } else {

                                    $this->customClientDevice['isHudl'] = false;
                                }

                            }

                            return $this->customClientDevice['isHudl'];

                        break;
                        case 'istelstratablet':

                            if (!isset($this->customClientDevice['isTelstraTablet'])) {

                                if ($this->oMOBI_DETECT->isTelstraTablet()) {

                                    $this->customClientDevice['isTelstraTablet'] = true;

                                } else {

                                    $this->customClientDevice['isTelstraTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isTelstraTablet'];

                        break;
                        case 'isgenerictablet':

                            if (!isset($this->customClientDevice['isGenericTablet'])) {

                                if ($this->oMOBI_DETECT->isGenericTablet()) {

                                    $this->customClientDevice['isGenericTablet'] = true;

                                } else {

                                    $this->customClientDevice['isGenericTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isGenericTablet'];

                        break;
                        case 'isandroidos':

                            if (!isset($this->customClientDevice['isAndroidOS'])) {

                                if ($this->oMOBI_DETECT->isAndroidOS()) {

                                    $this->customClientDevice['isAndroidOS'] = true;

                                } else {

                                    $this->customClientDevice['isAndroidOS'] = false;
                                }
                            }

                            return $this->customClientDevice['isAndroidOS'];

                        break;
                        case 'isblackberryos':

                            if (!isset($this->customClientDevice['isBlackBerryOS'])) {

                                if ($this->oMOBI_DETECT->isBlackBerryOS()) {

                                    $this->customClientDevice['isBlackBerryOS'] = true;

                                } else {

                                    $this->customClientDevice['isBlackBerryOS'] = false;
                                }
                            }

                            return $this->customClientDevice['isBlackBerryOS'];

                        break;
                        case 'ispalmos':

                            if (!isset($this->customClientDevice['isPalmOS'])) {

                                if ($this->oMOBI_DETECT->isPalmOS()) {

                                    $this->customClientDevice['isPalmOS'] = true;

                                } else {

                                    $this->customClientDevice['isPalmOS'] = false;
                                }

                            }

                            return $this->customClientDevice['isPalmOS'];

                        break;
                        case 'issymbianos':

                            if (!isset($this->customClientDevice['isSymbianOS'])) {

                                if ($this->oMOBI_DETECT->isSymbianOS()) {

                                    $this->customClientDevice['isSymbianOS'] = true;

                                } else {

                                    $this->customClientDevice['isSymbianOS'] = false;
                                }

                            }

                            return $this->customClientDevice['isSymbianOS'];

                        break;
                        case 'iswindowsmobileos':

                            if (!isset($this->customClientDevice['isWindowsMobileOS'])) {

                                if ($this->oMOBI_DETECT->isWindowsMobileOS()) {

                                    $this->customClientDevice['isWindowsMobileOS'] = true;

                                } else {

                                    $this->customClientDevice['isWindowsMobileOS'] = false;
                                }

                            }

                            return $this->customClientDevice['isWindowsMobileOS'];

                        break;
                        case 'iswindowsphoneos':

                            if (!isset($this->customClientDevice['isWindowsPhoneOS'])) {

                                if ($this->oMOBI_DETECT->isWindowsPhoneOS()) {

                                    $this->customClientDevice['isWindowsPhoneOS'] = true;

                                } else {

                                    $this->customClientDevice['isWindowsPhoneOS'] = false;
                                }
                            }

                            return $this->customClientDevice['isWindowsPhoneOS'];

                        break;
                        case 'isios':

                            if (!isset($this->customClientDevice['isiOS'])) {

                                if ($this->oMOBI_DETECT->isiOS()) {

                                    $this->customClientDevice['isiOS'] = true;

                                } else {

                                    $this->customClientDevice['isiOS'] = false;
                                }
                            }

                            return $this->customClientDevice['isiOS'];

                        break;
                        case 'isipados':

                            if (!isset($this->customClientDevice['isiPadOS'])) {

                                if ($this->oMOBI_DETECT->isiPadOS()) {

                                    $this->customClientDevice['isiPadOS'] = true;

                                } else {

                                    $this->customClientDevice['isiPadOS'] = false;
                                }
                            }

                            return $this->customClientDevice['isiPadOS'];

                        break;
                        case 'ismeegoos':

                            if (!isset($this->customClientDevice['isMeeGoOS'])) {

                                if ($this->oMOBI_DETECT->isMeeGoOS()) {

                                    $this->customClientDevice['isMeeGoOS'] = true;

                                } else {

                                    $this->customClientDevice['isMeeGoOS'] = false;
                                }

                            }

                            return $this->customClientDevice['isMeeGoOS'];

                        break;
                        case 'ismaemoos':

                            if (!isset($this->customClientDevice['isMaemoOS'])) {

                                if ($this->oMOBI_DETECT->isMaemoOS()) {

                                    $this->customClientDevice['isMaemoOS'] = true;

                                } else {

                                    $this->customClientDevice['isMaemoOS'] = false;
                                }
                            }

                            return $this->customClientDevice['isMaemoOS'];

                        break;
                        case 'isjavaos':

                            if (!isset($this->customClientDevice['isJavaOS'])) {

                                if ($this->oMOBI_DETECT->isJavaOS()) {

                                    $this->customClientDevice['isJavaOS'] = true;

                                } else {

                                    $this->customClientDevice['isJavaOS'] = false;
                                }

                            }

                            return $this->customClientDevice['isJavaOS'];

                        break;
                        case 'iswebos':

                            if (!isset($this->customClientDevice['iswebOS'])) {

                                if ($this->oMOBI_DETECT->iswebOS()) {

                                    $this->customClientDevice['iswebOS'] = true;

                                } else {

                                    $this->customClientDevice['iswebOS'] = false;
                                }

                            }

                            return $this->customClientDevice['iswebOS'];

                        break;
                        case 'isbadaos':

                            if (!isset($this->customClientDevice['isbadaOS'])) {

                                if ($this->oMOBI_DETECT->isbadaOS()) {

                                    $this->customClientDevice['isbadaOS'] = true;

                                } else {

                                    $this->customClientDevice['isbadaOS'] = false;
                                }

                            }

                            return $this->customClientDevice['isbadaOS'];

                        break;
                        case 'isbrewos':

                            if (!isset($this->customClientDevice['isBREWOS'])) {

                                if ($this->oMOBI_DETECT->isBREWOS()) {

                                    $this->customClientDevice['isBREWOS'] = true;

                                } else {

                                    $this->customClientDevice['isBREWOS'] = false;
                                }
                            }

                            return $this->customClientDevice['isBREWOS'];

                        break;
                        case 'ischrome':

                            if (!isset($this->customClientDevice['isChrome'])) {

                                if ($this->oMOBI_DETECT->isChrome()) {

                                    $this->customClientDevice['isChrome'] = true;

                                } else {

                                    $this->customClientDevice['isChrome'] = false;
                                }

                            }

                            return $this->customClientDevice['isChrome'];

                        break;
                        case 'isdolfin':

                            if (!isset($this->customClientDevice['isDolfin'])) {

                                if ($this->oMOBI_DETECT->isDolfin()) {

                                    $this->customClientDevice['isDolfin'] = true;

                                } else {

                                    $this->customClientDevice['isDolfin'] = false;
                                }

                            }

                            return $this->customClientDevice['isDolfin'];

                        break;
                        case 'isopera':

                            if (!isset($this->customClientDevice['isOpera'])) {

                                if ($this->oMOBI_DETECT->isOpera()) {

                                    $this->customClientDevice['isOpera'] = true;

                                } else {

                                    $this->customClientDevice['isOpera'] = false;
                                }

                            }

                            return $this->customClientDevice['isOpera'];

                        break;
                        case 'isskyfire':

                            if (!isset($this->customClientDevice['isSkyfire'])) {

                                if ($this->oMOBI_DETECT->isSkyfire()) {

                                    $this->customClientDevice['isSkyfire'] = true;

                                } else {

                                    $this->customClientDevice['isSkyfire'] = false;
                                }

                            }

                            return $this->customClientDevice['isSkyfire'];

                        break;
                        case 'isedge':

                            if (!isset($this->customClientDevice['isEdge'])) {

                                if ($this->oMOBI_DETECT->isEdge()) {

                                    $this->customClientDevice['isEdge'] = true;

                                } else {

                                    $this->customClientDevice['isEdge'] = false;
                                }
                            }

                            return $this->customClientDevice['isEdge'];

                        break;
                        case 'isie':

                            if (!isset($this->customClientDevice['isIE'])) {

                                if ($this->oMOBI_DETECT->isIE()) {

                                    $this->customClientDevice['isIE'] = true;

                                } else {

                                    $this->customClientDevice['isIE'] = false;
                                }
                            }

                            return $this->customClientDevice['isIE'];

                        break;
                        case 'isfirefox':

                            if (!isset($this->customClientDevice['isFirefox'])) {

                                if ($this->oMOBI_DETECT->isFirefox()) {

                                    $this->customClientDevice['isFirefox'] = true;

                                } else {

                                    $this->customClientDevice['isFirefox'] = false;
                                }

                            }

                            return $this->customClientDevice['isFirefox'];

                        break;
                        case 'isbolt':

                            if (!isset($this->customClientDevice['isBolt'])) {

                                if ($this->oMOBI_DETECT->isBolt()) {

                                    $this->customClientDevice['isBolt'] = true;

                                } else {

                                    $this->customClientDevice['isBolt'] = false;
                                }

                            }

                            return $this->customClientDevice['isBolt'];

                        break;
                        case 'isteashark':

                            if (!isset($this->customClientDevice['isTeaShark'])) {

                                if ($this->oMOBI_DETECT->isTeaShark()) {

                                    $this->customClientDevice['isTeaShark'] = true;

                                } else {

                                    $this->customClientDevice['isTeaShark'] = false;
                                }

                            }

                            return $this->customClientDevice['isTeaShark'];

                        break;
                        case 'isblazer':

                            if (!isset($this->customClientDevice['isBlazer'])) {

                                if ($this->oMOBI_DETECT->isBlazer()) {

                                    $this->customClientDevice['isBlazer'] = true;

                                } else {

                                    $this->customClientDevice['isBlazer'] = false;
                                }
                            }

                            return $this->customClientDevice['isBlazer'];

                        break;
                        case 'issafari':

                            if (!isset($this->customClientDevice['isSafari'])) {

                                if ($this->oMOBI_DETECT->isSafari()) {

                                    $this->customClientDevice['isSafari'] = true;

                                } else {

                                    $this->customClientDevice['isSafari'] = false;
                                }
                            }

                            return $this->customClientDevice['isSafari'];

                        break;
                        case 'iswechat':

                            if (!isset($this->customClientDevice['isWeChat'])) {

                                if ($this->oMOBI_DETECT->isWeChat()) {

                                    $this->customClientDevice['isWeChat'] = true;

                                } else {

                                    $this->customClientDevice['isWeChat'] = false;
                                }
                            }

                            return $this->customClientDevice['isWeChat'];

                        break;
                        case 'isucbrowser':

                            if (!isset($this->customClientDevice['isUCBrowser'])) {

                                if ($this->oMOBI_DETECT->isUCBrowser()) {

                                    $this->customClientDevice['isUCBrowser'] = true;

                                } else {

                                    $this->customClientDevice['isUCBrowser'] = false;
                                }
                            }

                            return $this->customClientDevice['isUCBrowser'];

                        break;
                        case 'isbaiduboxapp':

                            if (!isset($this->customClientDevice['isbaiduboxapp'])) {

                                if ($this->oMOBI_DETECT->isbaiduboxapp()) {

                                    $this->customClientDevice['isbaiduboxapp'] = true;

                                } else {

                                    $this->customClientDevice['isbaiduboxapp'] = false;
                                }
                            }

                            return $this->customClientDevice['isbaiduboxapp'];

                        break;
                        case 'isbaidubrowser':

                            if (!isset($this->customClientDevice['isbaidubrowser'])) {

                                if ($this->oMOBI_DETECT->isbaidubrowser()) {

                                    $this->customClientDevice['isbaidubrowser'] = true;

                                } else {

                                    $this->customClientDevice['isbaidubrowser'] = false;
                                }
                            }

                            return $this->customClientDevice['isbaidubrowser'];

                        break;
                        case 'isdiigobrowser':

                            if (!isset($this->customClientDevice['isDiigoBrowser'])) {

                                if ($this->oMOBI_DETECT->isDiigoBrowser()) {

                                    $this->customClientDevice['isDiigoBrowser'] = true;

                                } else {

                                    $this->customClientDevice['isDiigoBrowser'] = false;
                                }

                            }

                            return $this->customClientDevice['isDiigoBrowser'];

                        break;
                        case 'ismercury':

                            if (!isset($this->customClientDevice['isMercury'])) {

                                if ($this->oMOBI_DETECT->isMercury()) {

                                    $this->customClientDevice['isMercury'] = true;

                                } else {

                                    $this->customClientDevice['isMercury'] = false;
                                }
                            }

                            return $this->customClientDevice['isMercury'];

                        break;
                        case 'isobigobrowser':

                            if (!isset($this->customClientDevice['isObigoBrowser'])) {

                                if ($this->oMOBI_DETECT->isObigoBrowser()) {

                                    $this->customClientDevice['isObigoBrowser'] = true;

                                } else {

                                    $this->customClientDevice['isObigoBrowser'] = false;
                                }
                            }

                            return $this->customClientDevice['isObigoBrowser'];

                        break;
                        case 'isnetfront':

                            if (!isset($this->customClientDevice['isNetFront'])) {

                                if ($this->oMOBI_DETECT->isNetFront()) {

                                    $this->customClientDevice['isNetFront'] = true;

                                } else {

                                    $this->customClientDevice['isNetFront'] = false;
                                }

                            }

                            return $this->customClientDevice['isNetFront'];

                        break;
                        case 'isgenericbrowser':

                            if (!isset($this->customClientDevice['isGenericBrowser'])) {

                                if ($this->oMOBI_DETECT->isGenericBrowser()) {

                                    $this->customClientDevice['isGenericBrowser'] = true;

                                } else {

                                    $this->customClientDevice['isGenericBrowser'] = false;
                                }

                            }

                            return $this->customClientDevice['isGenericBrowser'];

                        break;
                        case 'ispalemoon':

                            if (!isset($this->customClientDevice['isPaleMoon'])) {

                                if ($this->oMOBI_DETECT->isPaleMoon()) {

                                    $this->customClientDevice['isPaleMoon'] = true;

                                } else {

                                    $this->customClientDevice['isPaleMoon'] = false;
                                }
                            }

                            return $this->customClientDevice['isPaleMoon'];

                        break;
                        default:

                            //
                            // NO CUSTOM DEVICE CONFIG MATCH.
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('CRNRSTN :: found no detection method string matching the provided input of [' . $target_device . ']. See http://demo.mobiledetect.net/ for a current list of custom detection methods.');

                        break;

                    }

                } catch (Exception $e) {

                    //
                    // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
                    $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

                    return false;

                }

            }

        }

    }

    public function is($key, $userAgent = null, $httpHeaders = null){

        if (!isset($this->oMOBI_DETECT)) {

            //
            //  INITIALIZE MOBILE DETECT (3RD PARTY OPEN SOURCE).
            $this->oMOBI_DETECT = new crnrstn_Mobile_Detect();

        }

        return $this->oMOBI_DETECT->is($key, $userAgent, $httpHeaders);

    }

	public function __destruct() {

	}
}