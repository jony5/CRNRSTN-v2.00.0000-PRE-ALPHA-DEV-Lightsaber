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

	private static $relevant_header_fields_ARRAY = array();
	public $is_SSL = false;

    public $client_header_field_data_ARRAY = array();

    public $oMOBI_DETECT;
    public $isMobile;
    public $isTablet;
    public $device_detected = false;
    public $crnrstn_asset_family;
    public $crnrstn_asset_return_method_key;
    public $crnrstn_asset_meta_path;

    public $custom_device_ARRAY = array();

    public $form_integration_isset_ARRAY = array();
    public $response_header_attribute_ARRAY = array();
    
    public $crnrstn_ssdtla_enabled = false;
    public $country_iso_code = 'en';

    public function __construct($oCRNRSTN, $oCRNRSTN_ENV) {

        $this->oCRNRSTN = $oCRNRSTN;
        $this->oCRNRSTN_ENV = $oCRNRSTN_ENV;
        $this->oCRNRSTN_USR = $oCRNRSTN_ENV->return_oCRNRSTN_USR();

        $this->response_header_attribute_ARRAY = $oCRNRSTN_ENV->response_header_attribute_ARRAY;

        self::$relevant_header_fields_ARRAY = array('Accept', 'Accept-Charset', 'Accept-Datetime', 'Accept-Encoding', 'Accept-Language',
        'Authorization', 'Cache-Control', 'Connection', 'Content-Encoding', 'Content-Length', 'Content-MD5', 'Content-Type', 'Cookie',
        'Date', 'Expect', 'Forwarded', 'Host', 'Proxy-Authorization', 'Range', 'Referer', 'User-Agent', 'Warning', 'X-Requested-With',
        'DNT', 'X-Forwarded-For', 'X-Forwarded-Host', 'X-Forwarded-Proto', 'X-Wap-Profile', 'X-UIDH[34][35][36]');

        if($this->oCRNRSTN->is_ssl()){

            $this->is_SSL = true;

        }

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
	    // "Also, my rug was stolen." - the dude
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

        //
        // DETECT APPROPRIATE CHANNEL AND SYNC SESSION
        if($this->is_mobile()){

            return CRNRSTN_CHANNEL_MOBILE;

        }else{

            if($this->is_tablet()){

                return CRNRSTN_CHANNEL_TABLET;

            }else{

                $this->set_desktop();

                return CRNRSTN_CHANNEL_DESKTOP;

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

    public function http_data_services_response($output_format = 'xml'){

        //
        // TOO[sic] SIMPLE...BUT GOOD FOR PROOF OF CONCEPT
        if($this->crnrstn_ssdtla_enabled){

            $tmp_data_ARRAY = array();

            //
            // CRNRSTN :: ASSET MAPPING. PROCESS HTTP REQUEST RESPONSE FOR ASSET.
            if(isset($this->crnrstn_asset_family)){

                $tmp_session_salt = $this->oCRNRSTN->session_salt();

                $tmp_data_ARRAY['crnrstn_asset_method_key'] = $this->crnrstn_asset_return_method_key;
                $tmp_data_ARRAY['crnrstn_asset_family'] = $this->crnrstn_asset_family;   // currently only css, js, system, social, or favicon
                $tmp_data_ARRAY['crnrstn_asset_key'] = $_GET[$tmp_session_salt];         // asset name/key

                if(isset($this->crnrstn_asset_meta_path)){

                    $tmp_data_ARRAY['crnrstn_asset_meta_path'] = $this->crnrstn_asset_meta_path;

                }

                $tmp_data_ARRAY['output_format'] = 'asset';

                //
                // SET RESPONSE OUTPUT MODE. THE KING'S HIGHWAY. GRIPPING THE LIGHTSABER (...BLADE!!).
                //$this->oCRNRSTN->initialize_bit(CRNRSTN_ASSET_MAPPING);

                $this->crnrstn_ssdtla_enabled = false;
//                [crnrstn_asset_method_key] => SOCIAL_ARCHIVES_HQ
//                [crnrstn_asset_family] => social
//                [crnrstn_asset_key] => social_archives_hq
//                [output_format] => asset

                //error_log(__LINE__ . ' http mgr  [' . print_r($tmp_data_ARRAY, true) . ']. die();');

                //die();

                return $this->oCRNRSTN->oCRNRSTN_TRM->return_interact_ui_request_response(CRNRSTN_ASSET_MAPPING, $tmp_data_ARRAY);

            }

            return $this->proper_response_return($this->oCRNRSTN->oCRNRSTN_TRM->return_interact_ui_request_response($output_format));

        }

    }

    public function http_data_services_validate(){


        return NULL;

    }

    public function http_data_services_initialize($user_auth_check = false, $cipher_override = NULL, $secret_key_override = NULL, $hmac_algorithm_override = NULL, $options_bitwise_override = NULL){

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

        foreach($tmp_vo_ARRAY as $key => $var_parse_channel){

            switch($var_parse_channel){
                case 'G':

                    //
                    // DO WE HAVE GET DATA?
                    if($this->issetHTTP($_GET)){

                        //
                        // CRNRSTN :: WILL ALWAYS PROCESS DATA SENT THROUGH CRNRSTN ::
                        // ...THERE WILL STILL BE SUPPORT FOR DIRECT HTTP POST/GET ACCESS.
                        if($this->issetParam($_GET, 'crnrstn_pssdtl_packet')){

                            $this->form_integration_isset_ARRAY['GET'] = true;
                            $this->crnrstn_ssdtla_enabled = true;
                            $this->oCRNRSTN->oCRNRSTN_DATA_TUNNEL_MGR->http_data_services_initialize($var_parse_channel);

                        }

                        if($this->issetParam($_GET, $this->oCRNRSTN->session_salt())){

                            $tmp_salt_ugc_val = $_GET[$this->oCRNRSTN->session_salt()];

                            if(strlen($tmp_salt_ugc_val) > 0){

                                if($this->oCRNRSTN->asset_routing_data_key_lookup('favicon', $tmp_salt_ugc_val)){

                                    $this->crnrstn_ssdtla_enabled = true;
                                    $this->crnrstn_asset_family = 'favicon';

                                    //error_log(__LINE__ . ' http mgr [' . $this->crnrstn_asset_family . '] asset HOOKED[' . $tmp_salt_ugc_val . '].');

                                    return true;

                                }

                                if($this->oCRNRSTN->asset_routing_data_key_lookup('system', $tmp_salt_ugc_val)){

                                    $this->crnrstn_ssdtla_enabled = true;
                                    $this->crnrstn_asset_family = 'system';
                                    $this->crnrstn_asset_return_method_key = $this->oCRNRSTN->asset_return_method_key('system', $tmp_salt_ugc_val);

                                    //error_log(__LINE__ . ' http mgr [' . $this->crnrstn_asset_family . '] asset HOOKED[' . $tmp_salt_ugc_val . '].');

                                    return true;

                                }

                                if($this->oCRNRSTN->asset_routing_data_key_lookup('social', $tmp_salt_ugc_val)){

                                    $this->crnrstn_ssdtla_enabled = true;
                                    $this->crnrstn_asset_family = 'social';
                                    $this->crnrstn_asset_return_method_key = $this->oCRNRSTN->asset_return_method_key('social', $tmp_salt_ugc_val);

                                    //error_log(__LINE__ . ' http mgr [' . $this->crnrstn_asset_family . ']  asset HOOKED[' . $tmp_salt_ugc_val . '].');

                                    return true;

                                }

                                if($this->oCRNRSTN->asset_routing_data_key_lookup('css', $tmp_salt_ugc_val)){

                                    $this->crnrstn_ssdtla_enabled = true;
                                    $this->crnrstn_asset_family = 'css';
                                    $this->crnrstn_asset_return_method_key = 'CRNRSTN_UI_CSS';
                                    $this->crnrstn_asset_meta_path = $this->oCRNRSTN->asset_return_method_key('css', $tmp_salt_ugc_val);

                                    //error_log(__LINE__ . ' http mgr [' . $this->crnrstn_asset_family . ']  asset HOOKED[' . $tmp_salt_ugc_val . '].');

                                    return true;

                                }

//                                error_log(__LINE__ . ' http mgr [' . $this->crnrstn_asset_family . ']. [' . $tmp_salt_ugc_val . '].');

                                if($this->oCRNRSTN->asset_routing_data_key_lookup('js', $tmp_salt_ugc_val)){

                                    $this->crnrstn_ssdtla_enabled = true;
                                    $this->crnrstn_asset_family = 'js';
                                    $this->crnrstn_asset_return_method_key = 'CRNRSTN_UI_JS';
                                    $this->crnrstn_asset_meta_path = $this->oCRNRSTN->asset_return_method_key('js', $tmp_salt_ugc_val);
//
//                                    error_log(__LINE__ . ' http mgr [' . $this->crnrstn_asset_family . '] asset HOOKED[' . $tmp_salt_ugc_val . '].');
//
//                                    die();
                                    return true;

                                }

                                if($this->oCRNRSTN->asset_routing_data_key_lookup('integrations', $tmp_salt_ugc_val)){

                                    $this->crnrstn_ssdtla_enabled = true;
                                    $this->crnrstn_asset_family = 'integrations';
                                    $this->crnrstn_asset_return_method_key = $this->oCRNRSTN->asset_return_method_key('integrations', $tmp_salt_ugc_val);

                                    //error_log(__LINE__ . ' http mgr [' . $this->crnrstn_asset_family . '] asset HOOKED[' . $tmp_salt_ugc_val . '].');

                                    return true;

                                }

                            }

                        }

                    }

                break;
                case 'P':

                    if($this->issetHTTP($_POST)){

                        /*
                        'crnrstn_xhr_root', 'crnrstn_xhr_root');
                        'crnrstn_request_serialization_key', 'crnrstn_request_serialization_key', '',CRNRSTN_INPUT_REQUIRED);
                        'crnrstn_request_serialization_hash', 'crnrstn_request_serialization_hash', '', CRNRSTN_INPUT_REQUIRED);
                        'crnrstn_interact_ui_link_text_click', 'crnrstn_interact_ui_link_text_click');
                        'crnrstn_interact_ui_loadbar_progress', 'crnrstn_interact_ui_loadbar_progress');
                        'crnrstn_interact_ui_active_nav_links', 'crnrstn_interact_ui_active_nav_links');
                        'crnrstn_pssdtl_packet', 'crnrstn_pssdtl_packet', $this->oCRNRSTN->return_crnrstn_data_packet(CRNRSTN_OUTPUT_PSSDTLA), CRNRSTN_INPUT_REQUIRED);
                        'crnrstn_ssdtla_form_serial', 'crnrstn_ssdtla_form_serial', $this->oCRNRSTN_USR->generate_new_key(64), CRNRSTN_INPUT_REQUIRED);
                        'crnrstn_ssdtla_timestamp', 'crnrstn_ssdtla_timestamp', $this->oCRNRSTN_USR->return_micro_time());
                        'crnrstn_ssdtl_packet_ttl', 'crnrstn_ssdtl_packet_ttl', $this->oCRNRSTN_USR->return_ssdtl_packet_ttl(), CRNRSTN_INPUT_REQUIRED);
                        'crnrstn_client_user_agent', 'crnrstn_client_user_agent', $_SERVER['HTTP_USER_AGENT'], CRNRSTN_INPUT_REQUIRED);
                        'crnrstn_soap_service_server_ip', 'crnrstn_soap_service_server_ip', $_SERVER['SERVER_ADDR'], CRNRSTN_INPUT_REQUIRED);
                        'crnrstn_soap_service_client_ip', 'crnrstn_soap_service_client_ip', $this->oCRNRSTN->return_client_ip(), CRNRSTN_INPUT_REQUIRED);
                        'crnrstn_soap_service_stime', 'crnrstn_soap_service_stime', $this->starttime);
                        'crnrstn_soap_service_rtime', 'crnrstn_soap_service_rtime', $this->wall_time());
                        'crnrstn_soap_service_framework_version','crnrstn_soap_service_framework_version',$this->oCRNRSTN_USR->proper_version('SOAP'));
                        'crnrstn_soap_service_encoding', 'crnrstn_soap_service_encoding', $this->oCRNRSTN->soap_defencoding());
                        'crnrstn_session_client_auth_key', 'crnrstn_session_client_auth_key', $this->oCRNRSTN->session_client_auth_key, CRNRSTN_INPUT_REQUIRED);
                        'crnrstn_session_client_id', 'crnrstn_session_client_id', $this->oCRNRSTN->session_client_id, CRNRSTN_INPUT_REQUIRED);
                        'crnrstn_php_sessionid', 'crnrstn_php_sessionid', session_id(), CRNRSTN_INPUT_REQUIRED);

                        */

                        //
                        // CRNRSTN :: WILL ALWAYS PROCESS DATA SENT THROUGH CRNRSTN ::
                        // ...THERE WILL STILL BE SUPPORT FOR DIRECT HTTP POST/GET ACCESS.
                        if($this->issetParam($_POST, 'crnrstn_pssdtl_packet')){

                            $this->form_integration_isset_ARRAY['POST'] = true;
                            $this->crnrstn_ssdtla_enabled = true;
                            $this->oCRNRSTN->oCRNRSTN_DATA_TUNNEL_MGR->http_data_services_initialize($var_parse_channel);

                        }

                    }

                break;

            }

        }

        //
        // BOOLEAN INDICATION OF A REQUEST FROM THE GATE-KEEPER/BEAN-COUNTER FOR THE SPACE BETWEEN
        // https://www.youtube.com/watch?v=YvzWRzTh7jg
        // TITLE :: The Space Between
        if($this->crnrstn_ssdtla_enabled){

            $this->oCRNRSTN->oCRNRSTN_DATA_TUNNEL_MGR->http_data_services_validation();

            if($user_auth_check){

                //$this->oCRNRSTN_VSC = new crnrstn_view_state_controller($this);
                //$this->oCRNRSTN_VSC->return_client_response();

            }

        }

        return $this->crnrstn_ssdtla_enabled;

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

        // TODO :: TURN THIS BACK ON.
        // CRNRSTN :: SOAP-SERVICES DATA TUNNEL LAYER
        //$this->soap_data_tunnel_output = $this->SOAP_client_request_listener();

        //
        // CRNRSTN :: PSEUDO-SOAP-SERVICES DATA TUNNEL LAYER DATA PROCESSING, VALIDATION, AND RESPONSE RETURN
        $this->http_data_services_initialize();

        $tmp_str_out = $this->http_data_services_response();

        //
        // CRNRSTN :: CONSOLE DASHBOARD PORTAL ENTRY POINT
        //$tmp_html = $this->user_request_listener();
        if(is_string($tmp_str_out) && strlen($tmp_str_out) > 0){

            return $tmp_str_out;

        }

        //
        // STICKY LINK
        if($tmp_str_out = $this->sticky_uri_listener()){

            $this->proper_response_return($tmp_str_out, NULL, 'RESPONSE_STICKY');

        }

        //
        // SOAP SERVER INITIALIZATION PING - CRNRSTN :: SOAP SERVICES LAYER
        //if($result = $this->initProxyCommListener()){
        //if($SOAP_response = $this->SOAP_service_listen()){
        //    echo $SOAP_response;
        //    die();
        //
        //}

    }

    public function sticky_uri_listener(){

        /*
        $tmp_param_array[] = 'crnrstn_bst=true';
        $tmp_param_array[] = 'crnrstn_smk=' . $channel_key;
        $tmp_param_array[] = 'crnrstn_sid=' . $social_id;
        $tmp_param_array[] = 'crnrstn_sk=' . $stream_key;

        http://172.16.225.139/lightsaber.crnrstn.evifweb.com/_crnrstn/demo/forms/action_directory/action/
        ?crnrstn_l=aafVctw3qrv8BlqVErqslZz9gud0cHqEjBpzh5lnXhxchWLMRilJ4rF22C5On78WDe47AUb29Q%253D%253D
        &crnrstn_r=FYkKPONbbS3CeB2LS9CcqaR6P7WeeNiwb5rmsAxsPGmeQlRtcZNb%252BRsgFZup06wesRmU%252FC8RXqLP1Gi3edToi46So6IiaH41z5H1GA5b3%252B%252FffUMGvqKLKwC43Z%252Fmu%252Bn89xKa0GnXSpUM%252BPUoDttyfV7zBXSFc%252FyrQ2NzdJ0OjT0MP4Pc1HeXyHWydt9Z1GuQnvLp39p4CuNVD%252FbLONTaJG6sxnGZRxS9vqxf14vsT%252B5X2rQo5JFoNBgf06xb6sHF%252BD7xioTJ2RV%252FU552yLTvXmbsXIKhOJdC
        &crnrstn_encrypt_tunnel=D%252BvHGBUGgLXvw3IM2dkeJMn9z3sG2yffZ2vGmj8kHvSwtXrxV8UC%252BkI2h%252FpSwQ4tPS9BbA%253D%253D
        */

        if($this->issetParam($_GET,'crnrstn_bst')){

            $tmp_tracking_status = $this->oCRNRSTN_ENV->data_decrypt($this->extractData($_GET,'crnrstn_bst', true), CRNRSTN_ENCRYPT_TUNNEL, true);
            $tmp_social_media_key = $this->oCRNRSTN_ENV->data_decrypt($this->extract_data_http('crnrstn_smk'), CRNRSTN_ENCRYPT_TUNNEL, true);
            $tmp_social_id = $this->oCRNRSTN_ENV->data_decrypt($this->extract_data_http('crnrstn_sid'), CRNRSTN_ENCRYPT_TUNNEL, true);
            $tmp_stream_key = $this->oCRNRSTN_ENV->data_decrypt($this->extract_data_http('crnrstn_sk'), CRNRSTN_ENCRYPT_TUNNEL, true);
            $tmp_uri = $this->oCRNRSTN_ENV->data_decrypt($this->extract_data_http('crnrstn_r'), CRNRSTN_ENCRYPT_TUNNEL, true);

            //error_log(__LINE__ . ' user sticky[' . $tmp_tracking_status . '][' . $this->oCRNRSTN_ENV->data_decrypt(urldecode($tmp_uri), CRNRSTN_ENCRYPT_TUNNEL, true) . '][' . $tmp_social_media_key . '][' . $tmp_social_id . '][' . $tmp_stream_key . ']');

            $this->oCRNRSTN_TRM->log_stream_social_clickthrough_reporting($this->oCRNRSTN_ENV->data_decrypt(urldecode($tmp_uri), CRNRSTN_ENCRYPT_TUNNEL, true), $tmp_social_media_key, $tmp_social_id, $tmp_stream_key);

        }

        //
        // CHECK FOR INITIALIZATION OF STICKY LINK VAR
        if($this->issetParam($_GET, 'crnrstn_r')){

            $tmp_uri = $this->extractData($_GET, 'crnrstn_r', true);

            $tmp_uri = $this->oCRNRSTN_ENV->data_decrypt($tmp_uri);

            //<p><a href="' . $tmp_uri . '" target="_self" style="color:#0066CC;">Click here</a>, if you are not redirected immediately.</p>
            $tmp_redirect_html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="refresh" content="0; url=' . $tmp_uri . '" />
    <style>
        p                                       { padding:10px 0 0 20px; font-size: 14px; color:#333; font-family: Arial, Helvetica, sans-serif;}
        .crnrstn_redirectinng_url_copy          { font-family: Courier New, Courier, monospace;}
        .crnrstn_redirectinng_double_colon_copy { color: #F90000; font-weight: bold;}
    </style>
</head>
<body>
<p>' . $this->oCRNRSTN->multi_lang_content_return('TEXT_REDIRECTING_TO') . ' <span class="crnrstn_redirectinng_double_colon_copy">::</span> <span class="crnrstn_redirectinng_url_copy">' . $tmp_uri . '</span></p>
<!-- 

      ___           ___           ___           ___           ___                         ___              
     /\__\         /\  \         /\  \         /\  \         /\__\                       /\  \             
    /:/  /        /::\  \        \:\  \       /::\  \       /:/ _/_         ___          \:\  \            
   /:/  /        /:/\:\__\        \:\  \     /:/\:\__\     /:/ /\  \       /\__\          \:\  \        ___           ___           
  /:/  /  ___   /:/ /:/  /    _____\:\  \   /:/ /:/  /    /:/ /::\  \     /:/  /      _____\:\  \      /\__\         /\  \          
 /:/__/  /\__\ /:/_/:/__/___ /::::::::\__\ /:/_/:/__/___ /:/_/:/\:\__\   /:/__/      /::::::::\__\     :/__/         :/__/
 \:\  \ /:/  / \:\/:::::/  / \:\~~\~~\/__/ \:\/:::::/  / \:\/:/ /:/  /  /::\  \      \:\~~\~~\/__/         
  \:\  /:/  /   \::/~~/~~~~   \:\  \        \::/~~/~~~~   \::/ /:/  /  /:/\:\  \      \:\  \            ___           ___         
   \:\/:/  /     \:\~~\        \:\  \        \:\~~\        \/_/:/  /   \/__\:\  \      \:\  \          /\__\         /\  \    
    \::/  /       \:\__\        \:\__\        \:\__\         /:/  /         \:\__\      \:\__\         :/__/         :/__/
     \/__/         \/__/         \/__/         \/__/         \/__/           \/__/       \/__/      
	 


-->
</body>
</html>';

            return $tmp_redirect_html;

        }else{

            return false;

        }

    }

    public function proper_response_return($response = NULL, $header_options_array = NULL, $crnrstn_response_profile_key = NULL){

        $tmp_curr_headers_ARRAY = headers_list();
        $tmp_crnrstn_signature_headers_ARRAY = $this->header_signature_options_return();

        //
        // ENSURE ALL SIGNATURE HEADERS ARE IN PLACE AND CONTINUE
        $this->header_options_add($tmp_crnrstn_signature_headers_ARRAY);

        //
        // ADD PRE-EXISTING HEADER OPTIONS AFTER DEFAULT FOR OVERWRITE
        $this->header_options_add($tmp_curr_headers_ARRAY);

        //
        // RESPONSE HEADER CONSTRUCTION
        if(isset($header_options_array)){

            /*
            TAKE CURRENT HEADERS...
                - FORCE INJECT SIGNATURE HEADERS
                    - FORCE INJECT ANY PROVISIONAL HEADERS

            */

            //
            // USE PROVISIONAL HEADERS (APPLY THEM AT THE END FOR OVERWRITE PROTECTION)
            $this->header_options_add($header_options_array);

        }

        if(isset($crnrstn_response_profile_key)){

            switch($crnrstn_response_profile_key){
                case 'RESPONSE_STICKY':

                    $tmp_array = array();
                    $tmp_array[] = 'Cache-Control: max-age=0';
                    $tmp_array[] = 'X-Frame-Options: SAMEORIGIN';
                    $this->header_options_add($tmp_array);

                    $this->header_options_apply();
                    echo $response;
                    exit;

                break;
                case 'REDIRECT_SANS_POST':

                    // PERMANENT = 301
                    // TEMPORARY = 307
                    // header("Location: /foo.php", true, 307); // THE BOOL == "ALLOW DUPLICATE HEADER ENTRIES"...WHICH MAY BE FASTER.

                    $this->header_options_apply();
                    header("Location: $response", true, 307);
                    exit;

                break;
                case 'POST_REDIRECT':

                    // PERMANENT = 301
                    // TEMPORARY = 307
                    // header("Location: /foo.php", true, 307); // THE BOOL == "ALLOW DUPLICATE HEADER ENTRIES"...WHICH MAY BE FASTER.

                    $tmp_array = array();
                    $tmp_array[] = 'Cache-Control: max-age=0';
                    $tmp_array[] = 'X-Frame-Options: SAMEORIGIN';
                    $this->header_options_add($tmp_array);

                    $this->header_options_apply();
                    header("Location: $response", true, 303);
                    exit;

                break;
                case 'RESPONSE_SANS_POST':
                default:

                    //
                    // BASIC PAGE RESPONSE RETURN

                    $this->header_options_apply();
                    return $response;

                break;

            }

        }else{

            $this->header_options_apply();
            return $response;

        }

        #####
        // SOURCE :: https://www.php.net/manual/en/function.header.php#78470
        // AUTHOR :: Dylan at WeDefy dot com :: https://www.php.net/manual/en/function.header.php#78470
        // The HTTP status code changes the way browsers and robots handle redirects, so if you are using
        // header(Location:) it's a good idea to set the status code at the same time. Browsers typically
        // re-request a 307 page every time, cache a 302 page for the session, and cache a 301 page for
        // longer, or even indefinitely. Search engines typically transfer "page rank" to the new location
        // for 301 redirects, but not for 302, 303 or 307. If the status code is not specified,
        // header('Location:') defaults to 302.
        //
        //        // 307 Temporary Redirect
        //        header("Location: /foo.php", true, 307); // THE BOOL == "ALLOW DUPLICATE HEADER ENTRIES"...WHICH MAY BE FASTER.
        #####

        #####
        // SOURCE :: https://www.php.net/manual/en/function.header.php
        // AUTHOR :: nospam at nospam dot com :: https://www.php.net/manual/en/function.header.php#119014
        //        // Response codes behaviors when using
        //        header('Location: /target.php', true, $code) to forward user to another page:
        //
        //        $code = 301;
        //        // Use when the old page has been "permanently moved and any future requests should be
        //           sent to the target page instead. PageRank may be transferred."
        //
        //        $code = 302; (default)
        //        // "Temporary redirect so page is only cached if indicated by a Cache-Control or
        //           Expires header field."
        //
        //        $code = 303;
        //        // "This method exists primarily to allow the output of a POST-activated script to
        //           redirect the user agent to a selected resource. The new URI is not a substitute
        //           reference for the originally requested resource and is not cached."
        //
        //        $code = 307;
        //        // Beware that when used after a form is submitted using POST, it would carry over the
        //           posted values to the next page, such if target.php contains a form processing script,
        //           it will process the submitted info again!
        //
        //        // In other words, use 301 if permanent, 302 if temporary, and 303 if a results page
        //           from a submitted form.
        //        // Maybe use 307 if a form processing script has moved.
        #####

        #####
        //        /* Redirect to a different page in the current directory that was requested */
        //        $host  = $_SERVER['HTTP_HOST'];
        //        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        //        $extra = 'mypage.php';
        //        header("Location: http://$host$uri/$extra");
        //        exit;
        #####

        #####
        //        // We'll be outputting a PDF
        //        header('Content-Type: application/pdf');
        //
        //        // It will be called downloaded.pdf
        //        header('Content-Disposition: attachment; filename="downloaded.pdf"');
        //
        //        // The PDF source is in original.pdf
        //        readfile('original.pdf');
        #####

    }

    public function header_options_add($header_array, $overwrite_existing = true){

        foreach($header_array as $key0 => $header_elem){

            $tmp_attribute_value = '';
            $tmp_array = explode(':', $header_elem);

            foreach($tmp_array as $key1 => $str){

                if($key1 == 0){

                    $tmp_attribute_name = $str;

                }else{

                    if($tmp_attribute_value != ''){

                        $tmp_attribute_value .= ':' . $str;

                    }else{

                        $tmp_attribute_value .= $str;

                    }

                }

            }

            //
            // BRING HEADER SITUATION INTO CRNRSTN ::
            if(isset($tmp_array[0])){

                $this->add_header_attribute($tmp_attribute_name, $tmp_attribute_value, $overwrite_existing);

            }

        }

    }

    public function header_options_apply(){

        foreach($this->response_header_attribute_ARRAY['header'] as $key => $headers_attribute){

            if($this->response_header_attribute_ARRAY['overwrite_existing'][$key] == 1){

                header($headers_attribute);

            }else{

                header($headers_attribute, false);

            }

        }

    }

    private function add_header_attribute($name, $value, $overwrite_existing = false){

        $this->response_header_attribute_ARRAY['header'][] = $name . ': ' . $value;

        if($overwrite_existing){

            $this->response_header_attribute_ARRAY['overwrite_existing'][] = 1;

        }else{

            $this->response_header_attribute_ARRAY['overwrite_existing'][] = 0;

        }

        $this->response_header_attribute_ARRAY['log'] .= $name . ', ';

    }

    public function header_signature_options_return(){

        $tmp_date = date('D, M j Y G:i:s T');
        $tmp_date_expire = date('D, M j Y G:i:s T', strtotime('+ 7 days'));
        //$tmp_date_lastmod = date('D, M j Y G:i:s T', strtotime('- 420 seconds'));
        $tmp_date_lastmod = date('D, j M Y G:i:s T');

        $tmp_array = array();
        $tmp_array[] = 'Content-Language: ' . $this->oCRNRSTN->iso_language_profile();
        $tmp_array[] = 'Content-Type: text/html; charset=UTF-8';
        $tmp_array[] = 'Date: ' . $tmp_date;
        $tmp_array[] = 'Expires: ' . $tmp_date_expire;
        $tmp_array[] = 'Last-Modified: ' . $tmp_date_lastmod;
        $tmp_array[] = 'X-Powered-By: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();

        return $tmp_array;

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

            $this->oCRNRSTN->add_system_resource('version_soap', $tmp_version_soap, NULL, 0, CRNRSTN_AUTHORIZE_RUNTIME_ONLY, NULL);
            $this->oCRNRSTN->add_system_resource('soap_defencoding', $this->oNUSOAP_BASE->soap_defencoding, NULL, 0, CRNRSTN_AUTHORIZE_RUNTIME_ONLY, NULL);

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

            error_log(__LINE__  . ' http get_resource() call for WSDL_URI=[' . $tmp_config_wsdl . '].');
            if(!(strlen($tmp_config_wsdl) > 0)){

                //
                // TODO :: TAKE CARE OF THIS.
                // SOMETHING FOR NOW
                //$tmp_config_wsdl = 'http://jony5.com/_crnrstn/soa/?wsdl';
                $tmp_config_wsdl = $this->oCRNRSTN->crnrstn_http_endpoint() . '_crnrstn/soa/?wsdl';

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

                    $tmp_html = '<form action="' . $this->oCRNRSTN->crnrstn_http_endpoint() . '" method="post" id="crnrstn_ssdtl_frm" name="crnrstn_ssdtl_frm" enctype="multipart/form-data">
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

    <input type="hidden" id="crnrstn_interact_ui_canvas_checksum" name="crnrstn_interact_ui_canvas_checksum" value="">
    <input type="hidden" id="crnrstn_interact_ui_mini_canvas_checksum" name="crnrstn_interact_ui_mini_canvas_checksum" value="">
    <input type="hidden" id="crnrstn_interact_ui_signin_canvas_checksum" name="crnrstn_interact_ui_signin_canvas_checksum" value="">
    <input type="hidden" id="crnrstn_interact_ui_main_canvas_checksum" name="crnrstn_interact_ui_main_canvas_checksum" value="">
    <input type="hidden" id="crnrstn_interact_ui_eula_canvas_checksum" name="crnrstn_interact_ui_eula_canvas_checksum" value="">
    <input type="hidden" id="crnrstn_interact_ui_mit_license_canvas_checksum" name="crnrstn_interact_ui_mit_license_canvas_checksum" value="">

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

    public function return_form_submitted_value($getpost_input_name, $transport_protocol = NULL){

        try {

            if(!isset($transport_protocol)){

                //
                // AUTO DETECTION CHECKING POST FIRST.
                if(isset($_POST[$getpost_input_name])){

                    return $_POST[$getpost_input_name];

                }else{

                    if(isset($_GET[$getpost_input_name])){

                        return $_GET[$getpost_input_name];

                    } else {

                        //error_log(__LINE__ . ' user - NO DATA IN ' . $getpost_input_name);
                        return NULL;

                    }

                }

            }else{

                $http_protocol = strtoupper($transport_protocol);
                $http_protocol = $this->oCRNRSTN->str_sanitize($http_protocol, 'http_protocol_simple');

                switch($http_protocol){
                    case 'POST':

                        if(isset($_POST[$getpost_input_name])){

                            return $_POST[$getpost_input_name];

                        } else {

                            return NULL;

                        }

                    break;
                    case 'GET':

                        if(isset($_GET[$getpost_input_name])){

                            return $_GET[$getpost_input_name];

                        } else {

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

            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function receive_form_integration_packet($uri_passthrough = false, $cipher_override = NULL, $secret_key_override = NULL){

        $this->crnrstn_ssdtla_enabled = false;

        //
        // DO WE HAVE POST DATA?
        if($this->issetHTTP($_POST)){

            //
            // CHECK FOR PRESENCE OF FORM INTEGRATION PACKET DATA
            if($this->issetParam($_POST, 'crnrstn_pssdtl_packet')){

                $this->form_integration_isset_ARRAY['POST'] = true;
                $this->crnrstn_ssdtla_enabled = true;

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
                    $this->crnrstn_ssdtla_enabled = true;

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
                    $this->crnrstn_ssdtla_enabled = true;

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

        return $this->crnrstn_ssdtla_enabled;

    }

    public function isvalid_data_validation_check($transport_protocol = 'POST'){

        $http_protocol = strtoupper($transport_protocol);
        $http_protocol = $this->oCRNRSTN->str_sanitize($http_protocol, 'http_protocol_simple');

        if(isset($this->form_integration_isset_ARRAY[$http_protocol])){

            return $this->form_integration_isset_ARRAY[$http_protocol];

        }else{

            return NULL;

        }

    }

    public function isset_crnrstn_services_http(){

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

                    if(isset(self::$formIntegrationErr_ARRAY['GET'])){

                        $tmp_array[] = self::$formIntegrationErr_ARRAY['GET'];
                        $tmp_array[] = self::$formIntegrationIcon_ARRAY['GET'];

                    }

                    break;
                case 'P':

                    if(isset(self::$formIntegrationErr_ARRAY['POST'])){

                        $tmp_array[] = self::$formIntegrationErr_ARRAY['POST'];
                        $tmp_array[] = self::$formIntegrationIcon_ARRAY['POST'];

                    }

                    break;

            }

            return $tmp_array;

        }

    }

    private function init_channel(){

        $channel_selected_ARRAY = $this->oCRNRSTN->return_set_bits($this->oCRNRSTN->system_output_channel_constants);
        $tmp_sel_cnt = count($channel_selected_ARRAY);

        //
        // MAINTAIN INTEGRITY OF DEVICE DETECTION SITUATION
        if($tmp_sel_cnt == 0 || $tmp_sel_cnt > 1){

            //
            // SET (OR RESET) THIS DATA. THERE SHOULD ALWAYS AND ONLY BE ONE.
            $tmp_bit = $this->sync_device_detected();

            $this->oCRNRSTN_USR->device_type_bit = $tmp_bit;

            switch($tmp_bit){
                case CRNRSTN_CHANNEL_DESKTOP:

                    $this->oCRNRSTN_USR->device_type = 'DESKTOP';

                break;
                case CRNRSTN_CHANNEL_TABLET:

                    $this->oCRNRSTN_USR->device_type = 'TABLET';

                break;
                case CRNRSTN_CHANNEL_MOBILE:

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
	
	public function getHeaders($returnType = 'array'){

		switch(strtolower($returnType)){
			case 'array':

				return getallheaders();

			break;		
			default:

			    //
                // string

			    $tmp_str = '';

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

    public function is_mobile($tablet_is_mobile = false, $magic_method = NULL){

        //
        // CUSTOM METHOD
        if(isset($magic_method)){

            $tmp_custom_profile_ARRAY = $this->is_mobile_custom($magic_method);

            $tmp_detection_algorithm = trim(strtolower($magic_method));
            $tmp_detection_algorithm = $this->oCRNRSTN->str_sanitize($tmp_detection_algorithm, 'custom_mobi_detect_alg');
            
            if(isset($tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'])){
                
                if($tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] === 'TRUE'){

                    $this->oCRNRSTN->add_system_resource('custom_mobi_name', $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'], 'CRNRSTN_SYSTEM_CONFIG::DEVICE_TYPE', NULL, 0);
                    $this->oCRNRSTN->add_system_resource('custom_mobi_integer', $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'], 'CRNRSTN_SYSTEM_CONFIG::DEVICE_TYPE', NULL, 0);
                    $this->oCRNRSTN->add_system_resource('custom_mobi_detection_result', $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'], 'CRNRSTN_SYSTEM_CONFIG::DEVICE_TYPE', NULL, 0);

                    return true;
                    
                }else{
                    
                    return false;
                    
                }
                
            }

            return false;

        }

        //
        // CHECK SESSION FOR EXISTING CONFIGURATION
        $tmp_custom_device = $this->oCRNRSTN->get_resource('custom_mobi_name', 0, 'CRNRSTN_SYSTEM_CONFIG::DEVICE_TYPE');
        
        if($this->oCRNRSTN->is_bit_set(CRNRSTN_CHANNEL_MOBILE)){
            
            return true;

        }

        if($this->oCRNRSTN->is_bit_set(CRNRSTN_CHANNEL_TABLET)){
            
            //
            // DO WE CONSIDER TABLETS AS MOBILE?
            if($tablet_is_mobile){

                return true;

            }else{
                
                return false;
                
            }
                
        }

        if($this->oCRNRSTN->is_bit_set(CRNRSTN_CHANNEL_DESKTOP)){

            return false;

        }
        
        //
        // THERE IS NO CONFIRMATION OF MOBILE STATE. LET'S DO THE WORK TO ANSWER THE QUESTION.
        // NEED TO DETERMINE DEVICE TYPE.
        if(!isset($this->oMOBI_DETECT)){
            
            //
            //  INITIALIZE MOBILE DETECT (3RD PARTY OPEN SOURCE).
            $this->oMOBI_DETECT = new crnrstn_Mobile_Detect();


        }

        //
        // IS MOBILE?
        if($this->oMOBI_DETECT->isMobile($this->http_headers_string)){

            $this->set_mobile();
            return true;

        }

        if($tablet_is_mobile){

            //
            // HANDLE TABLETS AS MOBILE
            if($this->oMOBI_DETECT->isTablet($this->http_headers_string)){

                $this->set_tablet();
                return true;

            }

        }

        return false;

    }

    public function is_tablet($mobile_is_tablet = false, $magic_method = NULL){

        //
        // CUSTOM METHOD
        if(isset($magic_method)){

            $tmp_custom_profile_ARRAY = $this->is_mobile_custom($magic_method);

            $tmp_detection_algorithm = trim(strtolower($magic_method));
            $tmp_detection_algorithm = $this->oCRNRSTN->str_sanitize($tmp_detection_algorithm, 'custom_mobi_detect_alg');

            if(isset($tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'])){

                if($tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] === 'TRUE'){

                    $this->oCRNRSTN->add_system_resource('custom_mobi_name', $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'], 'CRNRSTN_SYSTEM_CONFIG::DEVICE_TYPE', NULL, 0);
                    $this->oCRNRSTN->add_system_resource('custom_mobi_integer', $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'], 'CRNRSTN_SYSTEM_CONFIG::DEVICE_TYPE', NULL, 0);
                    $this->oCRNRSTN->add_system_resource('custom_mobi_detection_result', $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'], 'CRNRSTN_SYSTEM_CONFIG::DEVICE_TYPE', NULL, 0);

                    return true;

                }else{

                    return false;

                }

            }

            return false;

        }

        //
        // CHECK SESSION FOR EXISTING CONFIGURATION
        $tmp_custom_device = $this->oCRNRSTN->get_resource('custom_mobi_name', 0, 'CRNRSTN_SYSTEM_CONFIG::DEVICE_TYPE');

        if($this->oCRNRSTN->is_bit_set(CRNRSTN_CHANNEL_TABLET)){

            return true;

        }

        if($this->oCRNRSTN->is_bit_set(CRNRSTN_CHANNEL_MOBILE)){

            //
            // DO WE CONSIDER TABLETS AS MOBILE?
            if($mobile_is_tablet){

                return true;

            }else{

                return false;

            }

        }

        if($this->oCRNRSTN->is_bit_set(CRNRSTN_CHANNEL_DESKTOP)){

            return false;

        }

        //
        // NEED TO DETERMINE DEVICE TYPE.
        if(!isset($this->oMOBI_DETECT)){

            //
            //  INITIALIZE MOBILE DETECT (3RD PARTY OPEN SOURCE).
            $this->oMOBI_DETECT = new crnrstn_Mobile_Detect();

        }

        //
        // IS TABLET?
        if($this->oMOBI_DETECT->isTablet($this->http_headers_string)){

            $this->set_tablet();

            return true;

        }
        
        //
        // HANDLE MOBILE AS TABLETS
        // IS MOBILE?
        if($this->oMOBI_DETECT->isMobile($this->http_headers_string)){

            $this->set_mobile();

            if($mobile_is_tablet){

                return true;

            }

        }

        return false;

    }

    public function set_desktop(){

        $tmp_ARRAY = array(CRNRSTN_CHANNEL_TABLET, CRNRSTN_CHANNEL_MOBILE);
        $this->oCRNRSTN->clear_all_bits_set_one(CRNRSTN_CHANNEL_DESKTOP, true, $tmp_ARRAY);
        $this->oCRNRSTN_USR->device_type = 'DESKTOP';

        return true;

    }

    public function set_tablet($magic_method = NULL){

        if(isset($magic_method)){

            $this->set_mobile_custom($magic_method);

            return true;

        }

        $tmp_ARRAY = array(CRNRSTN_CHANNEL_DESKTOP, CRNRSTN_CHANNEL_MOBILE);
        $this->oCRNRSTN->clear_all_bits_set_one(CRNRSTN_CHANNEL_TABLET, true, $tmp_ARRAY);
        $this->oCRNRSTN_USR->device_type = 'TABLET';

        return true;

    }

    public function set_mobile($magic_method = NULL){

        if(isset($magic_method)){

            $this->set_mobile_custom($magic_method);

            return true;

        }

        $tmp_ARRAY = array(CRNRSTN_CHANNEL_DESKTOP, CRNRSTN_CHANNEL_TABLET);
        $this->oCRNRSTN->clear_all_bits_set_one(CRNRSTN_CHANNEL_MOBILE, true, $tmp_ARRAY);
        $this->oCRNRSTN_USR->device_type = 'MOBILE';

        return true;

    }

    private function set_mobile_custom($magic_method = NULL, $force_override = true){

        try{

            if(isset($magic_method)){

                $tmp_custom_profile_ARRAY = $this->is_mobile_custom($magic_method, $force_override);

                $tmp_detection_algorithm = trim(strtolower($magic_method));
                $tmp_detection_algorithm = $this->oCRNRSTN->str_sanitize($tmp_detection_algorithm, 'custom_mobi_detect_alg');

                switch($tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER']){
                    case 0:
                        // Experimental version() method

                        /*
                        ['NAME'] = 'version(Chrome)';
                        ['INTEGER'] = 0;
                        ['DETECTION_RESULT'] = $this->oMOBI_DETECT->version('Chrome');
                        
                        */
                                                
                    break;
                    case CRNRSTN_CHANNEL_MOBILE:

                        $this->set_mobile();

                    break;
                    case CRNRSTN_CHANNEL_TABLET:

                        $this->set_tablet();

                    break;
                    default:
                        // CRNRSTN_CHANNEL_DESKTOP
                        $this->set_desktop();

                    break;

                }

                //$device_type = trim($device_type);
                //$device_type = $this->oCRNRSTN_USR->str_sanitize($device_type, 'custom_mobi_detect_alg');

                $this->oCRNRSTN->add_system_resource('custom_mobi_name', $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'], 'CRNRSTN_SYSTEM_CONFIG::DEVICE_TYPE', NULL, 0);

                if(isset($tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'])){

                    $this->oCRNRSTN->add_system_resource('custom_mobi_detection_result', $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'], 'CRNRSTN_SYSTEM_CONFIG::DEVICE_TYPE', NULL, 0);

                }

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('set_mobile_custom() requires a detection method string (e.g. $device_type); this value cannot be NULL. See http://demo.mobiledetect.net/ for a current list of custom detection methods.');

            }

        }catch (Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        return true;

    }
    
    private function is_mobile_custom($custom_detection_method = NULL, $force_override = false){

        //
        // NULL $custom_detection_method EVOKES BASIC SESSION CHECK ONLY.
        if(!isset($custom_detection_method)){

            //
            // CHECK SESSION FOR EXISTING CONFIGURATION
            $tmp_custom_device = $this->oCRNRSTN->get_resource('custom_mobi_name', 0, 'CRNRSTN_SYSTEM_CONFIG::DEVICE_TYPE');

            if($tmp_custom_device != ''){

                //
                // WILL RETURN DEVICE STRING IF SESSION IS CONFIGURED WITH CUSTOM DEVICE AND NO
                // TARGET_DEVICE PROVIDED.
                return $tmp_custom_device;

            }else{

                //
                // NO CUSTOM CONFIGURATION AVAILABLE
                return false;

            }

        }else{

            $tmp_custom_profile_ARRAY = array();

            //
            // CHECK THE PROVIDED TARGET DEVICE AGAINST SESSION...AND THEN, DO WORK IF NO MATCH.
            $tmp_detection_algorithm = trim(strtolower($custom_detection_method));
            $tmp_detection_algorithm = $this->oCRNRSTN->str_sanitize($tmp_detection_algorithm, 'custom_mobi_detect_alg');

            //
            // CHECK SESSION FOR EXISTING CONFIGURATION
            $tmp_custom_device = $this->oCRNRSTN->get_resource('custom_mobi_name', 0, 'CRNRSTN_SYSTEM_CONFIG::DEVICE_TYPE');
            $tmp_custom_device = strtolower($tmp_custom_device);

            //
            // IF DEVICE PROVIDED, WILL CHECK FOR SESSION MATCH AND RETURN STRING REPRESENTING
            // THE SUCCESSFULLY DETECTED ALGORITHM IF SO.
            if($tmp_custom_device != '' && $tmp_custom_device == $tmp_detection_algorithm){

                return $tmp_custom_device;

            }else{

                //
                // NO SESSION MATCH. FURTHER DISCOVERY NEEDED.
                if(!isset($this->oMOBI_DETECT)){

                    //
                    //  INITIALIZE MOBILE DETECT (3RD PARTY OPEN SOURCE).
                    $this->oMOBI_DETECT = new crnrstn_Mobile_Detect();

                }

                try{

                    switch($tmp_detection_algorithm){
                        case 'versionchrome':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'version(Chrome)';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = 0;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = $this->oMOBI_DETECT->version('Chrome');

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'versionsafari':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'version(Safari)';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = 0;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = $this->oMOBI_DETECT->version('Safari');

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'versionwebkit':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'version(Webkit)';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = 0;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = $this->oMOBI_DETECT->version('Webkit');

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'versionios':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'version(iOS)';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = 0;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = $this->oMOBI_DETECT->version('iOS');

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'ismobile':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isMobile';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isMobile($this->http_headers_string)){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'istablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isTablet($this->http_headers_string)){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isiphone':
                            
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isiPhone';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isiPhone()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isblackberry':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isBlackBerry';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isBlackBerry()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;
                            
                        break;
                        case 'ispixel':
                            
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isPixel';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isPixel()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;
                            
                        break;
                        case 'ishtc':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isHTC';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isHTC()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;
                            
                        break;
                        case 'isnexus':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isNexus';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isNexus()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isdell':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isDell';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isDell()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'ismotorola':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isMotorola';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isMotorola()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'issamsung':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isSamsung';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isSamsung()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'islg':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isLG';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isLG()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'issony':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isSony';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isSony()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isasus':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isAsus';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isAsus()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isxiaomi':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isXiaomi';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isXiaomi()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isnokialumia':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isNokiaLumia';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isNokiaLumia()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'ismicromax':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isMicromax';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isMicromax()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'ispalm':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isPalm';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isPalm()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isvertu':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isVertu';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isVertu()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'ispantech':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isPantech';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isPantech()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isfly':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isFly';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isFly()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'iswiko':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isWiko';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isWiko()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isimobile':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isiMobile';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isiMobile()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'issimvalley':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isSimValley';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isSimValley()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'iswolfgang':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isWolfgang';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isWolfgang()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isalcatel':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isAlcatel';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isAlcatel()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isnintendo':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isNintendo';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isNintendo()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isamoi':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isAmoi';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isAmoi()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isinq':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isINQ';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isINQ()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isoneplus':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isOnePlus';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isOnePlus()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isgenericphone':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isGenericPhone';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isGenericPhone()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isipad':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isiPad';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isiPad()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isnexustablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isNexusTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isNexusTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isgoogletablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isGoogleTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isGoogleTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'issamsungtablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isSamsungTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isSamsungTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'iskindle':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isKindle';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isKindle()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'issurfacetablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isSurfaceTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isSurfaceTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'ishptablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isHPTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isHPTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isasustablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isAsusTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isAsusTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isblackberrytablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isBlackBerryTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isBlackBerryTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'ishtctablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isHTCtablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isHTCtablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'ismotorolatablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isMotorolaTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isMotorolaTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isnooktablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isNookTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isNookTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isacertablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isAcerTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isAcerTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'istoshibatablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isToshibaTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isToshibaTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'islgtablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isLGTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isLGTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isfujitsutablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isFujitsuTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isFujitsuTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isprestigiotablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isPrestigioTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isPrestigioTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'islenovotablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isLenovoTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isLenovoTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isdelltablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isDellTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isDellTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isxiaomitablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isXiaomiTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isXiaomiTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isyarviktablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isYarvikTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isYarvikTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'ismediontablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isMedionTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isMedionTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isarnovatablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isArnovaTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isArnovaTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isintensotablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isIntensoTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isIntensoTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isirutablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isIRUTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isIRUTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'ismegafontablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isMegafonTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isMegafonTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isebodatablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isEbodaTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isEbodaTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isallviewtablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isAllViewTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isAllViewTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isarchostablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isArchosTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isArchosTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isainoltablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isAinolTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isAinolTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isnokialumiatablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isNokiaLumiaTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isNokiaLumiaTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'issonytablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isSonyTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isSonyTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isphilipstablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isPhilipsTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isPhilipsTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'iscubetablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isCubeTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isCubeTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'iscobytablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isCobyTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isCobyTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'ismidtablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isMIDTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isMIDTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'ismsitablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isMSITablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isMSITablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'issmittablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isSMiTTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isSMiTTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isrockchiptablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isRockChipTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isRockChipTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isflytablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isFlyTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isFlyTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isbqtablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isbqTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isbqTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'ishuaweitablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isHuaweiTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isHuaweiTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isnectablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isNecTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isNecTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'ispantechtablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isPantechTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isPantechTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isbronchotablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isBronchoTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isBronchoTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isversustablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isVersusTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isVersusTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'iszynctablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isZyncTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isZyncTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'ispositivotablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isPositivoTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isPositivoTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isnabitablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isNabiTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isNabiTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'iskobotablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isKoboTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isKoboTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isdanewtablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isDanewTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isDanewTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'istexettablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isTexetTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isTexetTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isplaystationtablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isPlaystationTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isPlaystationTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'istrekstortablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isTrekstorTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isTrekstorTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'ispyleaudiotablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isPyleAudioTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isPyleAudioTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isadvantablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isAdvanTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isAdvanTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isdanytechtablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isDanyTechTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isDanyTechTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isgalapadtablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isGalapadTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isGalapadTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'ismicromaxtablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isMicromaxTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isMicromaxTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'iskarbonntablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isKarbonnTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isKarbonnTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isallfinetablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isAllFineTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isAllFineTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isproscantablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isPROSCANTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isPROSCANTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isyonestablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isYONESTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isYONESTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'ischangjiatablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isChangJiaTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isChangJiaTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isgutablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isGUTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isGUTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'ispointofviewtablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isPointOfViewTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isPointOfViewTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isovermaxtablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isOvermaxTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isOvermaxTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'ishcltablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isHCLTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isHCLTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isdpstablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isDPSTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isDPSTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isvisturetablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isVistureTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isVistureTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'iscrestatablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isCrestaTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isCrestaTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'ismediatektablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isMediatekTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isMediatekTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isconcordetablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isConcordeTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isConcordeTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isgoclevertablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isGoCleverTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isGoCleverTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'ismodecomtablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isModecomTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isModecomTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isvoninotablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isVoninoTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isVoninoTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isecstablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isECSTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isECSTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isstorextablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isStorexTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isStorexTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isvodafonetablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isVodafoneTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isVodafoneTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isessentielbtablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isEssentielBTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isEssentielBTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isrossmoortablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isRossMoorTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isRossMoorTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isimobiletablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isiMobileTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isiMobileTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'istolinotablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isTolinoTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isTolinoTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isaudiosonictablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isAudioSonicTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isAudioSonicTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isampetablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isAMPETablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isAMPETablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isskktablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isSkkTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isSkkTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'istecnotablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isTecnoTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isTecnoTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isjxdtablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isJXDTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isJXDTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isijoytablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isiJoyTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isiJoyTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isfx2tablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isFX2Tablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isFX2Tablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isxorotablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isXoroTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isXoroTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isviewsonictablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isViewsonicTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isViewsonicTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isverizontablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isVerizonTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isVerizonTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isodystablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isOdysTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isOdysTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'iscaptivatablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isCaptivaTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isCaptivaTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isiconbittablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isIconbitTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isIconbitTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isteclasttablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isTeclastTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isTeclastTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isondatablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isOndaTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isOndaTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isjaytechtablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isJaytechTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isJaytechTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isblaupunkttablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isBlaupunktTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isBlaupunktTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isdigmatablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isDigmaTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isDigmaTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isevoliotablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isEvolioTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isEvolioTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'islavatablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isLavaTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isLavaTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isaoctablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isAocTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isAocTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'ismpmantablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isMpmanTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isMpmanTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'iscelkontablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isCelkonTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isCelkonTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'iswoldertablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isWolderTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isWolderTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'ismediacomtablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isMediacomTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isMediacomTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'ismitablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isMiTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isMiTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isnibirutablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isNibiruTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isNibiruTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isnexotablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isNexoTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isNexoTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isleadertablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isLeaderTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isLeaderTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isubislatetablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isUbislateTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isUbislateTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'ispocketbooktablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isPocketBookTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isPocketBookTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'iskocasotablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isKocasoTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isKocasoTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'ishisensetablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isHisenseTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isHisenseTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'ishudl':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isHudl';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isHudl()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'istelstratablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isTelstraTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isTelstraTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isgenerictablet':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isGenericTablet';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isGenericTablet()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isandroidos':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isAndroidOS';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isAndroidOS()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isblackberryos':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isBlackBerryOS';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isBlackBerryOS()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'ispalmos':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isPalmOS';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isPalmOS()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'issymbianos':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isSymbianOS';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isSymbianOS()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'iswindowsmobileos':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isWindowsMobileOS';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isWindowsMobileOS()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'iswindowsphoneos':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isWindowsPhoneOS';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isWindowsPhoneOS()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isios':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isiOS';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isiOS()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isipados':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isiPadOS';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isiPadOS()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'issailfishos':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isSailfishOS';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isSailfishOS()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'ismeegoos':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isMeeGoOS';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isMeeGoOS()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'ismaemoos':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isMaemoOS';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isMaemoOS()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isjavaos':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isJavaOS';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isJavaOS()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'iswebos':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'iswebOS';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->iswebOS()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isbadaos':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isbadaOS';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isbadaOS()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isbrewos':
                            
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isBREWOS';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isBREWOS()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'ischrome':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isChrome';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isChrome()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isdolfin':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isDolfin';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isDolfin()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isopera':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isOpera';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isOpera()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isskyfire':
                            
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isSkyfire';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isSkyfire()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isedge':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isEdge';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isEdge()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isie':
                            
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isIE';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isIE()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isfirefox':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isFirefox';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isFirefox()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isbolt':
                            
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isBolt';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isBolt()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isteashark':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isTeaShark';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isTeaShark()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isblazer':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isBlazer';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isBlazer()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'issafari':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isSafari';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isSafari()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'iswechat':
                            
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isWeChat';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isWeChat()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isucbrowser':
                            
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isUCBrowser';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isUCBrowser()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isbaiduboxapp':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isbaiduboxapp';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isbaiduboxapp()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isbaidubrowser':
                            
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isbaidubrowser';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isbaidubrowser()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isdiigobrowser':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isDiigoBrowser';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isDiigoBrowser()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'ismercury':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isMercury';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isMercury()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isobigobrowser':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isObigoBrowser';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isObigoBrowser()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isnetfront':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isNetFront';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isNetFront()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'isgenericbrowser':
                            
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isGenericBrowser';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isGenericBrowser()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        case 'ispalemoon':

                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['NAME'] = 'isPaleMoon';
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                            $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'FALSE';

                            if($this->oMOBI_DETECT->isPaleMoon()){

                                $tmp_custom_profile_ARRAY[$tmp_detection_algorithm]['DETECTION_RESULT'] = 'TRUE';

                                if(!$force_override){

                                    return $tmp_custom_profile_ARRAY;

                                }

                            }

                            if($force_override){

                                return $tmp_custom_profile_ARRAY;

                            }

                            return $tmp_custom_profile_ARRAY;

                        break;
                        default:

                            //
                            // NO CUSTOM DEVICE CONFIG MATCH.
                            // HOOOSTON...VE HAF PROBLEM!
                            //throw new Exception('CRNRSTN :: found no detection method string matching the provided input of [' . $custom_detection_method . ']. See http://demo.mobiledetect.net/ for a current list of custom detection methods.');
                            $this->oCRNRSTN->error_log('CRNRSTN :: found no magic method string matching the provided input of [' . $custom_detection_method . ']. See http://demo.mobiledetect.net/ for a current list of custom detection methods.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);

                        break;

                    }

                }catch (Exception $e){

                    //
                    // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
                    $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

                    return false;

                }

            }

        }
        
        return false;

    }

    public function is($key, $userAgent = null, $httpHeaders = null){

        if(!isset($this->oMOBI_DETECT)){

            //
            //  INITIALIZE MOBILE DETECT (3RD PARTY OPEN SOURCE).
            $this->oMOBI_DETECT = new crnrstn_Mobile_Detect();

        }

        return $this->oMOBI_DETECT->is($key, $userAgent, $httpHeaders);

    }

	public function __destruct() {

	}
}