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
#         AUTHOR :: Jonathan 'J5' Harris, CEO, CTO, Lead Full Stack Developer, jharris@eVifweb.com, J00000101@gmail.com.
#            URI :: http://crnrstn.evifweb.com/
#       OVERVIEW :: CRNRSTN :: An Open Source PHP Class Library that stands on top of a robust web services oriented
#                   architecture to both facilitate, augment, and enhance (with stability) the operations of a code base
#                   for a web application across multiple hosting environments.
#
#                   Copyright (c) 2012-2024 :: eVifweb development :: All Rights Reserved.
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
#                   Stand on top of the CRNRSTN :: SOAP Services Layer to, for example, organize and strengthen the
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
#  CLASS :: crnrstn_data_tunnel_services_manager
#  VERSION :: 1.00.0000
#  DATE :: September 16, 2022 @ 0503 hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: High level management of transmitted data for
#                 CRNRSTN :: LIGHTSABER.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_data_tunnel_services_manager {

    public $oCRNRSTN;

    protected $pssdtl_packet_hash;
    protected $crnrstn_pssdtl_http_tunneled_data_ARRAY = array();
    protected $pssdtl_packet_profile_ARRAY = array();
    protected $received_data_ARRAY = array();

    public function __construct($oCRNRSTN){

        $this->oCRNRSTN = $oCRNRSTN;

    }

    public function return_received_data($data_key){

        if(isset($this->received_data_ARRAY[$data_key])){

            return $this->received_data_ARRAY[$data_key];

        }

        return NULL;

    }

    public function http_data_services_validation(){

        /*
        form_input_add()
        CRNRSTN_FIELD_INPUT_NAME
        CRNRSTN_FIELD_INPUT_ID
        DEFAULT_VALUE
        TABLE_FIELD_NAME
        VALIDATION_CONSTANTS_PROFILE

        form_hidden_input_add()
        CRNRSTN_FIELD_HIDDEN_INPUT_NAME
        CRNRSTN_FIELD_HIDDEN_INPUT_ID
        DEFAULT_VALUE
        TABLE_FIELD_NAME
        VALIDATION_CONSTANT_PROFILE
        IS_ENCRYPTED

        form_input_feedback_copy_add()
        VALIDATION_PROFILE
        CRNRSTN_FIELD_INPUT_NAME
        CRNRSTN_FIELD_INPUT_ID
        ERR_MESSAGE
        SUCCESS_MESSAGE
        INFO_MESSAGE

        form_response_add()
        ###CRNRSTN::RESOURCE::FORM_INPUT_RESPONSE::
        SUCCESS_RESPONSE
        SUCCESS_RESPONSE_TYPE
        ERROR_RESPONSE
        ERROR_RESPONSE_TYPE

        ###CRNRSTN::RESOURCE::FORM_RESPONSE::
        SUCCESS_RESPONSE
        SUCCESS_RESPONSE_TYPE
        ERROR_RESPONSE
        ERROR_RESPONSE_TYPE

        */

        foreach($this->crnrstn_pssdtl_http_tunneled_data_ARRAY as $index => $data){

            error_log(__LINE__ . ' dtsm [' . __METHOD__ . '][' . sizeof($this->crnrstn_pssdtl_http_tunneled_data_ARRAY) . '].');
            die();

        }

    }

    public function http_data_services_initialize($var_parse_channel){

        switch($var_parse_channel){
            case 'G':

                error_log(__LINE__ . ' dtsm GET CHANNEL DATA STORING INITIALIZED NOW FROM [' . __METHOD__ . '].');
                $this->received_data_ARRAY['crnrstn_pssdtl_packet'] = $this->oCRNRSTN->data_decrypt($this->oCRNRSTN->return_form_submitted_value('crnrstn_pssdtl_packet'));

            break;
            default:

                //
                // POST.
                error_log(__LINE__ . ' dtsm POST CHANNEL DATA STORING NOW FROM [' . __METHOD__ . '].');
                $this->received_data_ARRAY['crnrstn_pssdtl_packet'] = $this->oCRNRSTN->data_decrypt($this->oCRNRSTN->return_form_submitted_value('crnrstn_pssdtl_packet'));

            break;

        }

        //
        // RETRIEVE ALL OTHER SSDTLA DATUM FROM REQUEST
        $this->received_data_ARRAY['crnrstn_request_serialization_key'] = $this->oCRNRSTN->return_form_submitted_value('crnrstn_request_serialization_key');
        $this->received_data_ARRAY['crnrstn_request_serialization_hash'] = $this->oCRNRSTN->return_form_submitted_value('crnrstn_request_serialization_hash');
        $this->received_data_ARRAY['crnrstn_interact_ui_module_programme'] = $this->oCRNRSTN->return_form_submitted_value('crnrstn_interact_ui_module_programme');
        $this->received_data_ARRAY['crnrstn_interact_ui_link_text_click'] = $this->oCRNRSTN->return_form_submitted_value('crnrstn_interact_ui_link_text_click');
        $this->received_data_ARRAY['crnrstn_request_source'] = $this->oCRNRSTN->return_form_submitted_value('crnrstn_request_source');
        $this->received_data_ARRAY['crnrstn_resource_initialize'] = $this->oCRNRSTN->return_form_submitted_value('crnrstn_resource_initialize');
        $this->received_data_ARRAY['crnrstn_interact_ui_loadbar_progress'] = $this->oCRNRSTN->return_form_submitted_value('crnrstn_interact_ui_loadbar_progress');
        $this->received_data_ARRAY['crnrstn_interact_ui_active_nav_links'] = $this->oCRNRSTN->return_form_submitted_value('crnrstn_interact_ui_active_nav_links');
        $this->received_data_ARRAY['crnrstn_ssdtla_form_serial'] = $this->oCRNRSTN->return_form_submitted_value('crnrstn_ssdtla_form_serial');
        $this->received_data_ARRAY['crnrstn_ssdtla_timestamp'] = $this->oCRNRSTN->return_form_submitted_value('crnrstn_ssdtla_timestamp');
        $this->received_data_ARRAY['crnrstn_ssdtl_packet_ttl'] = $this->oCRNRSTN->return_form_submitted_value('crnrstn_ssdtl_packet_ttl');
        $this->received_data_ARRAY['crnrstn_client_user_agent'] = $this->oCRNRSTN->return_form_submitted_value('crnrstn_client_user_agent');
        $this->received_data_ARRAY['crnrstn_soap_service_server_ip'] = $this->oCRNRSTN->return_form_submitted_value('crnrstn_soap_service_server_ip');
        $this->received_data_ARRAY['crnrstn_soap_service_client_ip'] = $this->oCRNRSTN->return_form_submitted_value('crnrstn_soap_service_client_ip');
        $this->received_data_ARRAY['crnrstn_soap_service_stime'] = $this->oCRNRSTN->return_form_submitted_value('crnrstn_soap_service_stime');
        $this->received_data_ARRAY['crnrstn_soap_service_rtime'] = $this->oCRNRSTN->return_form_submitted_value('crnrstn_soap_service_rtime');
        $this->received_data_ARRAY['crnrstn_soap_service_framework_version'] = $this->oCRNRSTN->return_form_submitted_value('crnrstn_soap_service_framework_version');
        $this->received_data_ARRAY['crnrstn_soap_service_encoding'] = $this->oCRNRSTN->return_form_submitted_value('crnrstn_soap_service_encoding');
        $this->received_data_ARRAY['crnrstn_session_client_auth_key'] = $this->oCRNRSTN->return_form_submitted_value('crnrstn_session_client_auth_key');
        $this->received_data_ARRAY['crnrstn_session_client_id'] = $this->oCRNRSTN->return_form_submitted_value('crnrstn_session_client_id');
        $this->received_data_ARRAY['crnrstn_php_sessionid'] = $this->oCRNRSTN->return_form_submitted_value('crnrstn_php_sessionid');

//        $this->oCRNRSTN->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_soap_srvc_form_serial', true, $this->oCRNRSTN->generate_new_key(64), 'crnrstn_soap_srvc_form_serial');
//        $this->oCRNRSTN->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_soap_srvc_timestamp', true, $this->oCRNRSTN->return_micro_time(), 'crnrstn_soap_srvc_timestamp');
//        $this->oCRNRSTN->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_soap_srvc_ttl', true, $this->oCRNRSTN->return_ssdtl_packet_ttl(), 'crnrstn_soap_srvc_ttl');
//        $this->oCRNRSTN->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_soap_srvc_user_agent', true, $_SERVER['HTTP_USER_AGENT'], 'crnrstn_soap_srvc_user_agent');
//        $this->oCRNRSTN->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_soap_srvc_server_ip', true, $_SERVER['SERVER_ADDR'], 'crnrstn_soap_srvc_server_ip');
//        $this->oCRNRSTN->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_soap_service_client_ip', true, $this->oCRNRSTN->client_ip(), 'crnrstn_soap_service_client_ip');
//        $this->oCRNRSTN->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_soap_srvc_stime', true, $this->oCRNRSTN->starttime, 'crnrstn_soap_srvc_stime');
//        $this->oCRNRSTN->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_soap_srvc_rtime', true, $this->oCRNRSTN->wall_time(), 'crnrstn_soap_srvc_rtime');
//        //$this->oCRNRSTN->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_soap_srvc_protocol_version', true, $this->oCRNRSTN->proper_version('SOAP'), 'crnrstn_soap_srvc_protocol_version');
//        $this->oCRNRSTN->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_php_sessionid', true, session_id());
//        //$this->oCRNRSTN->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_soap_srvc_encoding', true, $tmp_oNUSOAP_BASE->soap_defencoding, 'crnrstn_soap_srvc_protocol_version');
//        $this->oCRNRSTN->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_session_client_id', true, $tmp_client_id, 'crnrstn_session_client_id');
//        $this->oCRNRSTN->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_session_client_auth_key', true, $tmp_client_auth_key, 'crnrstn_session_client_auth_key');
//
        //
        // RETRIEVE MODULE HASH DATA
        $tmp_module_ARRAY = $this->oCRNRSTN->oCRNRSTN_TRM->return_interact_ui_module_programme('array');

        foreach($tmp_module_ARRAY as $index => $module_nom){

            $tmp_val = $this->oCRNRSTN->return_form_submitted_value($module_nom .  '_HASH');
            if(strlen($tmp_val) > 0){

                $this->received_data_ARRAY[$module_nom .  '_HASH'] = $tmp_val;
                //error_log(__LINE__ . ' dts mgr ' . __METHOD__ . ' ' . $module_nom . '_HASH=[' . print_r($tmp_val,true) . '].');

            }

        }

        //
        // PACKET HASH FOR VERIFICATION OF PACKET INTEGRITY. SAME VALUE SHOULD BE INSIDE THE ENCRYPTED PACKET.
        $this->pssdtl_packet_hash = $this->oCRNRSTN->hash($this->received_data_ARRAY['crnrstn_pssdtl_packet']);

        //
        // EXTRACT DATA FROM HTTP
        $tmp_crnrstn_pssdtl_packet_ojson = json_decode($this->received_data_ARRAY['crnrstn_pssdtl_packet']);

//        error_log(__LINE__ . ' dts mgr ' . __METHOD__ . ' $tmp_crnrstn_pssdtl_packet_ojson=[' . print_r($tmp_crnrstn_pssdtl_packet_ojson,true) . ']. die();');
//        error_log(__LINE__ . ' dts mgr ' . __METHOD__ . ' received_data_ARRAY=[' . print_r($this->received_data_ARRAY,true) . ']. die();');
//        error_log(__LINE__ . ' dts mgr ' . __METHOD__ . ' received_data_ARRAY=[' . print_r($this->received_data_ARRAY['crnrstn_interact_ui_module_programme'],true) . ']. die();');
//
//        die();
        if(isset($this->received_data_ARRAY['crnrstn_pssdtl_packet'][0]['crnrstn_data_packet_ddo_elements'])){

            foreach($this->received_data_ARRAY['crnrstn_pssdtl_packet'][0]['crnrstn_data_packet_ddo_elements'] as $index => $node){
                /*
                Array
                (
                    [HASH] => 0a389b1122a6ac551a685ec72e3f9815
                    [BYTES] => 17
                    [KEY] => 6bf11b80ff9a878569005fa567cff252b2907bee73c0edd670a53147d07189a2::CRNRSTN_FIELD_INPUT_NAME
                    [TYPE] => string
                    [VALUE] => crnrstn_demo_city
                    [TTL] => 60
                    [AUTH_PROFILE] => 8083
                )

                */

                //$this->oCRNRSTN->print_r($node, 'CRNRSTN :: DECOUPLED DATA OBJECT ELEMENT :: CLIENT FORM SUBMISSION.', NULL, __LINE__, __METHOD__, __FILE__);
                //error_log(__LINE__ . ' dts mgr [' . __METHOD__ . ']. $node=['. print_r($node, true) .  '].');

                if(!$this->receive_packet_data($node)){

                    //error_log(__LINE__ . ' dtsm::' . __METHOD__ . '() ERROR on PSSDTLP NODE[' . print_r($node, true) . '].');

                    /*
                    pssdtl_packet_profile_ARRAY['STATUS_REPORT'][][]

                    "STATUS_REPORT" : [{
                                "STATUS_TARGET_ELEMENT" : ' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS_TARGET_ELEMENT) . ',
                                "STATUS" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS) . '",
                                "STATUS_CODE" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS_CODE) . '",
                                "STATUS_MESSAGE" : ' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS_MESSAGE) . ',
                                "ERROR_CODE" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_ERROR_CODE) . '",
                                "ERROR_MESSAGE" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_ERROR_MESSAGE) . '"
                                },{
                                "STATUS_TARGET_ELEMENT" : ' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS_TARGET_ELEMENT) . ',
                                "STATUS" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS) . '",
                                "STATUS_CODE" : "1234567890",
                                "STATUS_MESSAGE" : ' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS_MESSAGE) . ',
                                "ERROR_CODE" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_ERROR_CODE) . '",
                                "ERROR_MESSAGE" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_ERROR_MESSAGE) . '"
                                },{
                                "STATUS_TARGET_ELEMENT" : ' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS_TARGET_ELEMENT) . ',
                                "STATUS" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS) . '",
                                "STATUS_CODE" : "0987654321",
                                "STATUS_MESSAGE" : ' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS_MESSAGE) . ',
                                "ERROR_CODE" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_ERROR_CODE) . '",
                                "ERROR_MESSAGE" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_ERROR_MESSAGE) . '"
                                }],

                    */

                }

                //$this->oCRNRSTN->add_resource($tmp_data_key, 'data_value_here', $tmp_data_type_family, CRNRSTN_AUTHORIZE_RUNTIME);

            }

        }

        return true;

    }

    public function retrieve_interact_ui_module_hash($module_nom){

//        $tmp_hash = $this->oCRNRSTN->hash(NULL, NULL, false, $module_nom);
//
//        if(strlen($tmp_hash) > 0){
//
//            error_log(__LINE__ . ' dtsm accelerating hash [' . $module_nom . '].');
//            return $tmp_hash;
//
//        }

        switch($module_nom){
            case 'crnrstn_interact_ui_theme_profile':

                $tmp_module_data = $this->oCRNRSTN->output_ssdtla_data_object('theme_profile_data');

            break;
            case 'crnrstn_interact_ui_documentation_content_src':

                if(!isset($this->received_data_ARRAY['crnrstn_interact_ui_link_text_click'])){

                    //
                    // DEEP LINK REQUEST NEEDS NO HASH CONSIDERATION TO BLOCK DATA RETURN. ALWAYS RETURN THE PAGE.
                    //
                    // LETTING THIS ERR, HERE. WE ARE ABOUT TO REDO $_GET[] INTO A CHANNEL.
                    //
                    // Thursday, November 23, 2023 @ 0058 hrs.
                    $tmp_module_data = $this->oCRNRSTN->oCRNRSTN_RRS_MAP->get_salt_ugc();

                }else{

                    $tmp_module_page_key = $this->received_data_ARRAY['crnrstn_interact_ui_link_text_click'];

                    $tmp_page_sauce = $this->oCRNRSTN->sauce($tmp_module_page_key);

                    $tmp_module_data = $tmp_page_sauce;

                }

            break;
            case 'crnrstn_interact_ui_mit_license_src':

                if(!isset($this->received_data_ARRAY['crnrstn_interact_ui_link_text_click'])){

                    //
                    // DEEP LINK REQUEST NEEDS NO HASH CONSIDERATION TO BLOCK DATA RETURN. ALWAYS RETURN THE PAGE.
                    //
                    // LETTING THIS ERR, HERE. WE ARE ABOUT TO REDO $_GET[] INTO A CHANNEL.
                    //
                    // Thursday, November 23, 2023 @ 0100 hrs.
                    $tmp_module_data = $this->oCRNRSTN->oCRNRSTN_RRS_MAP->get_salt_ugc();

                }else{

                    //
                    // TIMESTAMP IN OUTPUT PRODUCES UNIQUE HASH EVERYTIME
                    $tmp_module_page_key = $this->received_data_ARRAY['crnrstn_interact_ui_link_text_click'];
                    $tmp_module_data = $module_nom . $tmp_module_page_key;

                }

            break;
            case 'crnrstn_interact_ui_search_src':
            case 'crnrstn_interact_ui_messenger_src':
            case 'crnrstn_interact_ui_system_footer_src':
            case 'crnrstn_interact_ui_documentation_view_source_src':

                //
                // TIMESTAMP IN OUTPUT PRODUCES UNIQUE HASH EVERYTIME, BUT $module_nom WILL
                // ALWAYS BE STABLE. WILL HAVE MAYBE TTL THESE FOR UPDATES?...WILL TTL-ING
                // THE FOOTER RESET DISPLAYED WALL TIME TO ZERO? I THINK THE SSDTLA HOLDS
                // THE WALL TIME SOURCE...SO SHOULD BE STABLE.
                $tmp_module_data = $module_nom;

            break;
            case 'crnrstn_interact_ui_documentation_side_nav_src':

                $tmp_nav_str = '';
                $directory = CRNRSTN_ROOT . '/_crnrstn/ui/docs/documentation/php/';
                $tmp_data_type_family = 'CRNRSTN::RESOURCE::INTERACT_UI::DOCUMENTATION_NAV';

                $scanned_directory_ARRAY = $this->oCRNRSTN->better_scandir($directory);

                //
                // SOURCE :: https://www.php.net/manual/en/function.scandir.php
                // AUTHOR :: dwieeb at gmail dot com :: https://www.php.net/manual/en/function.scandir.php#107215
                $scanned_directory_ARRAY = array_diff($scanned_directory_ARRAY, array('..', '.', 'index.php'));

                foreach($scanned_directory_ARRAY as $index => $dir_resource){

                    $tmp_data_key = 'CRNRSTN_NAV_LINK';
                    $this->oCRNRSTN->add_resource($tmp_data_key, $dir_resource, $tmp_data_type_family);

                    if(!$this->oCRNRSTN->tmp_restrict_this_lorem_ipsum_method($dir_resource)){

                        $tmp_nav_str .= $dir_resource;

                    }

                }

                $tmp_module_data = $tmp_nav_str;

            break;
            default:

                $tmp_module_data = '';
                $this->oCRNRSTN->error_log('Unknown INTERACT UI module [' . $module_nom . '] provided; unable to retrieve module hash.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

            break;

        }

        return $this->oCRNRSTN->hash($tmp_module_data, NULL, false, true, $module_nom);

    }

    public function return_hidden_input_html($crnrstn_form_handle, $data_authorization_profile){
        /*
        case CRNRSTN_UI_FORM_INTEGRATION_PACKET: USER FACING
        case CRNRSTN_CHANNEL_PSSDTLA:
        case CRNRSTN_CHANNEL_FORM:

        */

        $tmp_str = '';

        switch($data_authorization_profile){
            case CRNRSTN_UI_FORM_INTEGRATION_PACKET:

                //
                // HIDDEN INPUT HTML INJECTION :: CUSTOM FORM
                $tmp_str = '
        <input type="hidden" name="crnrstn_request_serialization_key_XXXXXXXXXX" id="crnrstn_request_serialization_key_XXXXXXXXXX" value="">';

            break;
            case CRNRSTN_CHANNEL_SSDTLA:

                //
                // HIDDEN INPUT HTML INJECTION :: CRNRSTN :: SSDTL
                $tmp_str = '
        <input type="hidden" name="crnrstn_request_serialization_key" id="crnrstn_request_serialization_key" value="">
        <input type="hidden" name="crnrstn_request_serialization_hash" id="crnrstn_request_serialization_hash" value="">
        <input type="hidden" name="crnrstn_interact_ui_link_text_click" id="crnrstn_interact_ui_link_text_click" value="">
        <input type="hidden" name="crnrstn_interact_ui_loadbar_progress" id="crnrstn_interact_ui_loadbar_progress" value="">';

            break;
            case CRNRSTN_CHANNEL_PSSDTLA:

                // JSON
                error_log('why am i running for JSON{} out? [lnum ' . __LINE__ . '][class ' . __CLASS__ . '][method ' . __METHOD__ . '] die();');
                die();

            break;
            default:

                error_log('why am i running for UNKNOWN data_authorization_profile CONSTANT[' . $data_authorization_profile . ']? [lnum ' . __LINE__ . '][class ' . __CLASS__ . '][method ' . __METHOD__ . '] die();');
                die();

            break;

        }

        return $tmp_str;

    }

    public function receive_packet_data($data_ARRAY, $data_attribute = 'crnrstn_pssdtl_packet', $data_auth_request = CRNRSTN_AUTHORIZE_RUNTIME){

        // WHERE $data_ARRAY=
        //$data_ARRAY['HASH'];
        //$data_ARRAY['BYTES'];
        //$data_ARRAY['KEY'];
        //$data_ARRAY['TYPE'];
        //$data_ARRAY['VALUE'];
        //$data_ARRAY['TTL'];
        //$data_ARRAY['AUTH_PROFILE'];

        switch($data_attribute){
            case 'crnrstn_data_packet_hidden_input_html':
            case 'crnrstn_pssdtl_packet':

                //$this->oCRNRSTN->print_r($data_ARRAY, $data_attribute . ' pssdtl_packet_hash=[' . $this->pssdtl_packet_hash . ']', NULL, __LINE__, __METHOD__, __FILE__);
                $this->crnrstn_pssdtl_http_tunneled_data_ARRAY[$this->pssdtl_packet_hash][] = $data_ARRAY;

                //
                // HUH? ARRAY STORAGE?? COULD NOT THE DATA BE PROCESSED HERE?

                return true;

            break;
            default:

                error_log(__LINE__  . ' dtsm UNKNOWN $data_attribute VALUE [' . $data_attribute . ']. die();');
                die();

            break;

        }

    }

    public function form_get_resource($crnrstn_form_handle, $input_name){


        return '';

    }

    public function __destruct(){

    }

}