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
#  CLASS :: crnrstn_ui_tunnel_response_manager
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  VERSION :: 1.00.0000
#  DATE :: Friday May 14, 2020 @ 0457hrs
#  DESCRIPTION :: UI PSSDTL/SSDTL output to client.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_ui_tunnel_response_manager {

    protected $oLogger;
    public $oCRNRSTN;

    private static $social_lnk_cnt = 0;
    private static $lifestyle_image_return_cnt = 8;

    public $mysqli;
    public $oCRNRSTN_MySQLi;

    public $interact_ui_module_keys_ARRAY = array();
    public $interact_ui_module_hash_ARRAY = array();
    public $interact_ui_module_ttl_ARRAY = array();

    public function __construct($oCRNRSTN){

        $this->oCRNRSTN = $oCRNRSTN;

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN);

        //
        // INITIALIZE INTERACT UI MODULE KEYS
        $this->init_interact_ui_module_keys();

        //
        // DOES NOT HOOK INTO LIGHTSABER CORRECTLY.
        //$this->oCRNRSTN_MySQLi = $this->oCRNRSTN_USR->return_crnrstn_mysqli();
        //$this->mysqli = $this->oCRNRSTN_MySQLi->return_conn_object();

        // HOLD OFF ON THIS FOR A SEC. NEED TO DECOUPLE THIRD PARTY DEPENDENCY FROM
        // PRIMARY PAGE LOAD SEQUENCE.
        // INITIALIZE DATA
        //$this->initialize_data();

    }

    public function return_interact_ui_module_programme($output_type = 'piped'){

        $tmp_str_out = '';
        $tmp_array_out = array();

        if($output_type == 'array'){

            foreach($this->interact_ui_module_keys_ARRAY as $module_key => $val){

                $tmp_array_out[] = $module_key;

            }

            return $tmp_array_out;

        }

        if($output_type == 'hidden_hash_input_array'){

            foreach($this->interact_ui_module_keys_ARRAY as $module_key => $val){

                $tmp_str_out .= '        <input type="hidden" id="' . $module_key . '_HASH" name="' . $module_key . '_HASH" value="">
';

            }

            //error_log(__LINE__ . ' ui tunnel resp [' . $tmp_str_out . '].');

            return $tmp_str_out;

        }

        foreach($this->interact_ui_module_keys_ARRAY as $module_key => $val){

            $tmp_str_out .= $module_key . '|';

        }

        $tmp_str_out = $this->oCRNRSTN->strrtrim($tmp_str_out, '|');

        return $tmp_str_out;

    }

    private function init_interact_ui_module_keys(){

        //
        // CRNRSTN :: LIGHTSABER MIT LICENSE
        $this->interact_ui_module_keys_ARRAY['crnrstn_interact_ui_mit_license_src'] = 1;
        $this->interact_ui_module_hash_ARRAY['crnrstn_interact_ui_mit_license_src'] = 1;
        $this->interact_ui_module_ttl_ARRAY['crnrstn_interact_ui_mit_license_src'] = -1;

        //
        // CRNRSTN :: LIGHTSABER DOCUMENTATION NAV
        $this->interact_ui_module_keys_ARRAY['crnrstn_interact_ui_documentation_side_nav_src'] = 'GLOBAL';
        $this->interact_ui_module_hash_ARRAY['crnrstn_interact_ui_documentation_side_nav_src'] = 1;
        $this->interact_ui_module_ttl_ARRAY['crnrstn_interact_ui_documentation_side_nav_src'] = -1;

        //
        // CRNRSTN :: LIGHTSABER DOCUMENTATION CONTENT
        $this->interact_ui_module_keys_ARRAY['crnrstn_interact_ui_documentation_content_src'] = 'GLOBAL';
        $this->interact_ui_module_hash_ARRAY['crnrstn_interact_ui_documentation_content_src'] = 1;
        $this->interact_ui_module_ttl_ARRAY['crnrstn_interact_ui_documentation_content_src'] = 300;

        //
        // CRNRSTN :: LIGHTSABER SYSTEM FOOTER
        $this->interact_ui_module_keys_ARRAY['crnrstn_interact_ui_system_footer_src'] = 'GLOBAL';
        $this->interact_ui_module_hash_ARRAY['crnrstn_interact_ui_system_footer_src'] = 1;
        $this->interact_ui_module_ttl_ARRAY['crnrstn_interact_ui_system_footer_src'] = -1;

        //
        // CRNRSTN :: LIGHTSABER SEARCH
        $this->interact_ui_module_keys_ARRAY['crnrstn_interact_ui_search_src'] = 1;
        $this->interact_ui_module_hash_ARRAY['crnrstn_interact_ui_search_src'] = 1;
        $this->interact_ui_module_ttl_ARRAY['crnrstn_interact_ui_search_src'] = -1;

        //
        // CRNRSTN :: LIGHTSABER MESSENGER
        $this->interact_ui_module_keys_ARRAY['crnrstn_interact_ui_messenger_src'] = 1;  //GLOBAL DEACTIVATED FOR NOW
        $this->interact_ui_module_hash_ARRAY['crnrstn_interact_ui_messenger_src'] = 1;
        $this->interact_ui_module_ttl_ARRAY['crnrstn_interact_ui_messenger_src'] = 90;

        //
        // CRNRSTN :: LIGHTSABER DOCUMENTATION VIEW SOURCE FOOTER INTEGRATION
        $this->interact_ui_module_keys_ARRAY['crnrstn_interact_ui_documentation_view_source_src'] = 'GLOBAL';
        $this->interact_ui_module_hash_ARRAY['crnrstn_interact_ui_documentation_view_source_src'] = 1;
        $this->interact_ui_module_ttl_ARRAY['crnrstn_interact_ui_documentation_view_source_src'] = -1;

        //
        // CRNRSTN :: THEME PROFILES (UI/UX STYLING)
        $this->interact_ui_module_keys_ARRAY['crnrstn_interact_ui_theme_profile'] = 'GLOBAL';
        $this->interact_ui_module_hash_ARRAY['crnrstn_interact_ui_theme_profile'] = 1;
        $this->interact_ui_module_ttl_ARRAY['crnrstn_interact_ui_theme_profile'] = -1;

    }

    private function return_interact_ui_ux_profile($output_format = 'xml'){

        $tmp_out_str = '';

        $tmp_module_ARRAY = $this->return_interact_ui_module_programme('array');
        $tmp_module_page_key = $this->oCRNRSTN->oDATA_TUNNEL_SERVICES_MGR->return_received_data('crnrstn_interact_ui_link_text_click');

        //error_log(__LINE__ . ' ui tunnel $tmp_module_page_key=[' . $tmp_module_page_key . '].');

        $tmp_crnrstn_request_source = $this->oCRNRSTN->oDATA_TUNNEL_SERVICES_MGR->return_received_data('crnrstn_request_source');

        //
        // THE WAY THIS SHOULD WORK:
        // 1) EACH DOM MODULE SHOULD HAVE A KEY AND A HASH.
        // 2) THEREFORE, RETURN THE THE MODULE KEY CONTENT IF THE HASH IS DIFFERENT.
        foreach($tmp_module_ARRAY as $index => $module_nom){

            $tmp_xml_concat = false;
            $tmp_post_hash = $this->oCRNRSTN->oDATA_TUNNEL_SERVICES_MGR->return_received_data($module_nom . '_HASH');
            $tmp_module_hash = $this->oCRNRSTN->oDATA_TUNNEL_SERVICES_MGR->retrieve_interact_ui_module_hash($module_nom);

            switch($module_nom){
                case 'crnrstn_interact_ui_documentation_side_nav_src':

                    //
                    // IF THE CONTENT HAS CHANGED ON THE SERVER, RETURN THE XML.
                    if($tmp_post_hash != $tmp_module_hash){

                        //error_log(__LINE__ . ' ui tunnel SSDTLA XML RETURN $module_nom=[' . $module_nom . '] $tmp_module_page_key=[' . $tmp_module_page_key . '][' . $tmp_post_hash . '].');
                        $tmp_xml_concat = true;

                    }

                break;
                case 'crnrstn_interact_ui_documentation_content_src':

                    //
                    // IF THE CONTENT HAS CHANGED ON THE SERVER, OR THIS IS RUNNING BECAUSE A LINK
                    // WAS CLICKED...RETURN THE XML.
                    if(($tmp_post_hash != $tmp_module_hash || $tmp_crnrstn_request_source == 'link_text_click')){

                        //
                        // MUTE DOCUMENTATION PAGE RESPONSE IF LINK CLICKED IS (1) MIT LICENSE OR (2) VIEW
                        // FRAMEWORK SOURCE,...A FOOTER COMPONENT INTEGRATION...AT LEAST FOR STARTERS.
                        $pos_docs_view_source = strpos($tmp_module_page_key,'framework_view_source');
                        if($tmp_module_page_key != 'mit_license' && $pos_docs_view_source == false && strlen($tmp_module_page_key) > 0){

                            error_log(__LINE__ . ' ui tunnel SSDTLA XML RETURN $module_nom=[' . $module_nom . '] $tmp_module_page_key=[' . $tmp_module_page_key . '][' . $tmp_post_hash . '].[' . $tmp_post_hash . '].');
                            $tmp_xml_concat = true;

                        }

                        //error_log(__LINE__ . ' ui tunnel SSDTLA XML RETURN $module_nom=[' . $module_nom . '] $tmp_module_hash=[' . $tmp_module_hash . '][' . $tmp_post_hash . '].');

                    }

                break;
                case 'crnrstn_interact_ui_system_footer_src':
                case 'crnrstn_interact_ui_search_src':

                    //
                    // RETURN THE MODULE XML IF THE CONTENT HAS CHANGED ON THE SERVER, WHICH SAID CONTENT
                    // WILL NOT FOR THESE GUYS atm. THESE MODULE ARE PERMANENT BECAUSE THE HASH IS MADE
                    // FROM THE MODULE KEY...WHICH IS PERMANENT...AND NOT HTML <P> CONTENT.
                    // THESE MODULE (WHICH INCLUDES ALL SYSTEM THEME DEFAULTS) WILL BE SENT TO
                    // THE CLIENT AND STORED ONLY ONE (1) TIME.
                    if($tmp_post_hash != $tmp_module_hash){

                        //error_log(__LINE__ . ' ui tunnel SSDTLA XML RETURN $module_nom=[' . $module_nom . '] $tmp_module_page_key=[' . $tmp_module_page_key . '][' . $tmp_post_hash . '].');
                        $tmp_xml_concat = true;

                    }


                break;
                case 'crnrstn_interact_ui_messenger_src':

                    // HOLD ON A SEC.

                break;
                case 'crnrstn_interact_ui_documentation_view_source_src':

                    //
                    // IF THIS IS RUNNING BECAUSE A LINK WAS CLICKED...RETURN THE XML.
                    $pos_docs_view_source = strpos($tmp_module_page_key,'framework_view_source');
                    if($pos_docs_view_source !== false){

                        //error_log(__LINE__ . ' ui tunnel SSDTLA XML RETURN $module_nom=[' . $module_nom . '] $tmp_module_page_key=[' . $tmp_module_page_key . '][' . $tmp_post_hash . '].');
                        $tmp_xml_concat = true;

                    }

                break;
                case 'crnrstn_interact_ui_theme_profile':

                    //
                    // TODO :: TTL CONSIDERATIONS
                    // IF THE CONTENT HAS CHANGED ON THE SERVER, RETURN THE XML.
                    if($tmp_post_hash != $tmp_module_hash){

                        //error_log(__LINE__ . ' ui tunnel SSDTLA XML RETURN $module_nom=[' . $module_nom . '] $tmp_module_page_key=[' . $tmp_module_page_key . '][' . $tmp_post_hash . '].');
                        $tmp_xml_concat = true;

                    }

                break;
                case 'crnrstn_interact_ui_mit_license_src':

                    //
                    // IF THE SSDTLA HOLDS THIS MODULE AS THE CLICKED LINK (crnrstn_interact_ui_link_text_click),
                    // RETURN THE XML.
                    if($tmp_module_page_key == 'mit_license'){

                        //error_log(__LINE__ . ' ui tunnel SSDTLA XML RETURN $module_nom=[' . $module_nom . '] $tmp_module_page_key=[' . $tmp_module_page_key . '][' . $tmp_post_hash . '].');
                        $tmp_xml_concat = true;

                    }

                break;
                default:

                    $this->oCRNRSTN->error_log('Unknown module name [' . $module_nom . '] Cannot produce or validate content HASH for SSDTLA XML return.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                break;

            }

            if($tmp_xml_concat){

                if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

                    $tmp_node_open = '<' . $module_nom . '_HASH>' . $tmp_module_hash . '</' . $module_nom . '_HASH><' . $module_nom . '><![CDATA[';
                    $tmp_node_close = ']]></' . $module_nom . '>';

                    if($module_nom == 'crnrstn_interact_ui_theme_profile'){

                        $tmp_node_open = '<' . $module_nom . '_HASH>' . $tmp_module_hash . '</' . $module_nom . '_HASH><' . $module_nom . '>';
                        $tmp_node_close = '</' . $module_nom . '>';

                    }

                }else{

                    $tmp_node_open = '
                <' . $module_nom . '_HASH>' . $tmp_module_hash . '</' . $module_nom . '_HASH>
                <' . $module_nom . '><![CDATA[';

                    $tmp_node_close = ']]></' . $module_nom . '>
';

                    if($module_nom == 'crnrstn_interact_ui_theme_profile'){

                        $tmp_node_open = '
                <' . $module_nom . '_HASH>' . $tmp_module_hash . '</' . $module_nom . '_HASH>
                <' . $module_nom . '>';

                        $tmp_node_close = '</' . $module_nom . '>
';

                    }

                }

                $tmp_out_str .= $tmp_node_open;

                error_log(__LINE__ . ' ui tunnel $module_nom=[' . $module_nom . '] $tmp_module_page_key=[' . $tmp_module_page_key . '][' . print_r($tmp_module_ARRAY,true) . '].');
                switch($module_nom){
                    case 'crnrstn_interact_ui_theme_profile':

                        $tmp_out_str .= $this->oCRNRSTN->output_ssdtla_data_object('theme_profile_data');  //php

                    break;
                    case 'crnrstn_interact_ui_documentation_content_src':

                        $tmp_key_override = NULL;
                        //$tmp_key_override = $this->oCRNRSTN->return_response_map_asset_meta_key();
                        //error_log(__LINE__ . ' $tmp_key_override[' . $tmp_key_override . '].');

                        $tmp_out_str .= $this->oCRNRSTN->oINTERACT_UI_HTML_MGR->out_ui_module_html_system_documentation_page($tmp_key_override);  //php
                        //$tmp_out_str .= $this->oCRNRSTN->oINTERACT_UI_HTML_MGR->out_ui_module_html_system_documentation_page('js');
                        //$tmp_out_str .= $this->oCRNRSTN->oINTERACT_UI_HTML_MGR->out_ui_module_html_system_documentation_page('technique');

                    break;
                    case 'crnrstn_interact_ui_documentation_side_nav_src':

                        $tmp_out_str .= $this->oCRNRSTN->oINTERACT_UI_HTML_MGR->out_ui_module_html_system_documentation_nav();
                        //$tmp_out_str .= $this->oCRNRSTN->oINTERACT_UI_HTML_MGR->out_ui_module_html_system_documentation_page('js');
                        //$tmp_out_str .= $this->oCRNRSTN->oINTERACT_UI_HTML_MGR->out_ui_module_html_system_documentation_page('technique');
                        //error_log(__LINE__ . ' ui tunnel XML RETURN $tmp_out_str=[' . $tmp_out_str . '] $tmp_module_page_key=[' . $tmp_module_page_key . '][' . $tmp_post_hash . '].');

                    break;
                    case 'crnrstn_interact_ui_system_footer_src':

                        $tmp_out_str .= $this->oCRNRSTN->oINTERACT_UI_HTML_MGR->out_ui_module_html_system_footer_generic();

                    break;
                    case 'crnrstn_interact_ui_documentation_view_source_src':

                        $tmp_out_str .= $this->oCRNRSTN->oINTERACT_UI_HTML_MGR->out_ui_module_html_system_footer_content_container();

                    break;
                    case 'crnrstn_interact_ui_search_src':

                        $tmp_out_str .= $this->oCRNRSTN->oINTERACT_UI_HTML_MGR->out_ui_module_html_system_search();

                    break;
                    case 'crnrstn_interact_ui_messenger_src':

                        $tmp_out_str .= $this->oCRNRSTN->oINTERACT_UI_HTML_MGR->out_ui_module_html_system_messenger();

                    break;
                    case 'crnrstn_interact_ui_mit_license_src':

                        $tmp_out_str .= $this->oCRNRSTN->oINTERACT_UI_HTML_MGR->out_ui_module_html_system_mit_license();

                    break;

                }

                $tmp_out_str .= $tmp_node_close;

            }

        }

        return $tmp_out_str;

    }

    public function return_interact_ui_request_response($output_mode = NULL){

        if(!isset($output_mode)){

            $output_mode = 'xml';

            if($this->oCRNRSTN->is_bit_set(CRNRSTN_CHANNEL_GET) == true){

                return $this->oCRNRSTN->client_asset_response();

            }

            //
            // [BLIND PARALLEL]
            if($this->oCRNRSTN->is_bit_set(CRNRSTN_CHANNEL_POST) == true){

                return $this->oCRNRSTN->client_asset_response();

            }

        }

        //
        // LOAD INTERACT UI THEMES
        //$this->oCRNRSTN->load_theme_style_profiles();

        //
        // NOT SURE IF THIS WILL STILL BE NECESSARY (E.G. DO WE NEED HTTP RESPONSE
        // HEADER MANIPULATION OPPORTUNITY HERE?), BUT LEAVING FOR NOW.
        switch($output_mode){
            case CRNRSTN_ASSET_MAPPING:

                return $this->oCRNRSTN->client_asset_response();

            break;
            case 'xml':
            default:

                return $this->soap_data_tunnel_layer_response();

            break;

        }

    }

    public function return_crnrstn_data_packet_json($output_channel_constant = CRNRSTN_CHANNEL_RUNTIME){

        //if(no session data to honor...)
        $tmp_client_ip = $this->oCRNRSTN->client_ip();                   // TAKE THIS FROM SESSION IF PRESENT
        $tmp_session_id = session_id();                                         // TAKE THIS FROM SESSION IF PRESENT

        //
        // GENERATE PSSDTL JSON PACKET FOR OUTPUT.
        $tmp_timestamp_json = $this->oCRNRSTN->return_clean_json_string($this->oCRNRSTN->return_query_date_time_stamp());
        $tmp_CLIENT_AUTH_KEY = $this->oCRNRSTN->session_client_auth_key;
        $tmp_SESSION_ID = session_id();
        $tmp_SERVER_IP = $this->oCRNRSTN->return_clean_json_string($_SERVER['SERVER_ADDR']);
        $tmp_CLIENT_ID = $this->oCRNRSTN->return_clean_json_string($this->oCRNRSTN->session_client_id);
        $tmp_CLIENT_IP = $this->oCRNRSTN->data_decrypt($this->oCRNRSTN->oDATA_TUNNEL_SERVICES_MGR->return_received_data('crnrstn_soap_service_client_ip'));

        $tmp_CRNRSTN_SESSION_DATA_DATEMODIFIED = $tmp_timestamp_json;
        $tmp_CRNRSTN_SESSION_DATA_DATECREATED = $tmp_timestamp_json;

        if($tmp_client_ip != $tmp_CLIENT_IP && strlen($tmp_CLIENT_IP) > 0){

            //
            // SOFT ALERT SINCE NO USER AUTHENTICATED EXPERIENCE
            $tmp_STATUS_TARGET_ELEMENT = 'null';
            $tmp_STATUS = '200';
            $tmp_STATUS_CODE = '418';
            $tmp_STATUS_MESSAGE = 'I\'m a teapot';
            $tmp_ERROR_CODE = '2227';
            $tmp_ERROR_MESSAGE = 'The client IP address has straight deviated from the CRNRSTN :: PSEUDO-SOAP
                    -SERVICES Data Tunnel Layer session initialization profile. No immediate action needs
                    to be taken at this time . ';

        }else{

            if($tmp_session_id != $tmp_SESSION_ID && strlen($tmp_SESSION_ID) > 0){

                //
                // SOFT ALERT SINCE NO USER AUTHENTICATED EXPERIENCE
                $tmp_STATUS_TARGET_ELEMENT = 'null';
                $tmp_STATUS = '200';
                $tmp_STATUS_CODE = '418';
                $tmp_STATUS_MESSAGE = 'I\'m a teapot';
                $tmp_ERROR_CODE = '2228';
                $tmp_ERROR_MESSAGE = 'The SESSION profile of the CRNRSTN :: PSEUDO-SOAP-SERVICES
                    Data Tunnel Layer Packet has straight deviated from the server process currently running the
                    PSSDTL profile[' . $tmp_session_id . '][' . $tmp_SESSION_ID.']. No immediate action needs to be taken at this time.';

            }else{

                $tmp_STATUS_TARGET_ELEMENT = 'null';
                $tmp_STATUS = '200';
                $tmp_STATUS_CODE = '420';
                $tmp_STATUS_MESSAGE = 'Enhance Your Calm';
                $tmp_ERROR_CODE = '0';
                $tmp_ERROR_MESSAGE = '0';

            }

        }

        /*
        ' . $CANVAS_PROFILE_CONTENT . '
        ' . $CANVAS_PROFILE_LOCK . '
        ' . $CANVAS_PROFILE_LOCK_TTL . '
        ' . $CANVAS_PROFILE_LOCK_ISACTIVE . '

        ' . $CANVAS_PROFILES_DIMENSION_POSITION_CHECKSUM . '
        ' . $CANVAS_PROFILES_DIMENSION_POSITION_CONTENT . '

        ' . $CANVAS_PROFILES_DIMENSION_POSITION_LOCK . '
        ' . $CANVAS_PROFILES_DIMENSION_POSITION_LOCK_TTL . '
        ' . $CANVAS_PROFILES_DIMENSION_POSITION_LOCK_ISACTIVE . '

        */

        // crnrstn_jony5_content_version_checksums TABLE DATA
        $CHECKSUM_PROFILE_ID = '"CHECKSUM_PROFILE_ID" : ' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'CHECKSUM_PROFILE_ID', 0, true) . ',';
        $PROGRAM_KEY = '"PROGRAM_KEY" : ' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'PROGRAM_KEY', 0, true) . ',';
        $DEVICE_TYPE_CHANNEL = '"DEVICE_TYPE_CHANNEL" : ' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'DEVICE_TYPE_CHANNEL', 0, true) . ',';

        $CANVAS_PROFILE_HASH = '"CANVAS_PROFILE_HASH" : "' . $this->return_ui_interact_canvas_profile_checksum() . '",';
        $CANVAS_PROFILE_CONTENT = '"CANVAS_PROFILE_CONTENT" : "' . $this->oCRNRSTN->return_clean_json_string($this->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILE_CONTENT')) . '",';
        $CANVAS_PROFILE_LOCK = '"CANVAS_PROFILE_LOCK" : "' . $this->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILE_LOCK') . '",';
        $CANVAS_PROFILE_LOCK_TTL = '"CANVAS_PROFILE_LOCK_TTL" : "' . $this->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILE_LOCK_TTL') . '",';
        $CANVAS_PROFILE_LOCK_ISACTIVE = '"CANVAS_PROFILE_LOCK_ISACTIVE" : "' . $this->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILE_LOCK_ISACTIVE') . '",';

        $CANVAS_PROFILES_DIMENSION_POSITION_CHECKSUM = '"CANVAS_PROFILES_DIMENSION_POSITION_CHECKSUM" : "' . $this->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILES_DIMENSION_POSITION_CHECKSUM') . '",';
        $CANVAS_PROFILES_DIMENSION_POSITION_CONTENT = '"CANVAS_PROFILES_DIMENSION_POSITION_CONTENT" : "' . $this->oCRNRSTN->return_clean_json_string($this->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILES_DIMENSION_POSITION_CONTENT')) . '",';
        $CANVAS_PROFILES_DIMENSION_POSITION_LOCK = '"CANVAS_PROFILES_DIMENSION_POSITION_LOCK" : "' . $this->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILES_DIMENSION_POSITION_LOCK') . '",';
        $CANVAS_PROFILES_DIMENSION_POSITION_LOCK_TTL = '"CANVAS_PROFILES_DIMENSION_POSITION_LOCK_TTL" : "' . $this->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILES_DIMENSION_POSITION_LOCK_TTL') . '",';
        $CANVAS_PROFILES_DIMENSION_POSITION_LOCK_ISACTIVE = '"CANVAS_PROFILES_DIMENSION_POSITION_LOCK_ISACTIVE" : "' . $this->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILES_DIMENSION_POSITION_LOCK_ISACTIVE') . '",';

        $CONTENT_CHECKSUM_TTL = '"CONTENT_CHECKSUM_TTL" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'CONTENT_CHECKSUM_TTL', 0, true) . '",';
        $TITLE_CHECKSUM = '"TITLE_CHECKSUM" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'TITLE_CHECKSUM', 0, true) . '",';
        $TITLE_CONTENT = '"TITLE_CONTENT" : ' . $this->oCRNRSTN->return_clean_json_string($this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'TITLE_CONTENT', 0, true)) . ',';
        $TITLE_CONTENT_LOCK = '"TITLE_CONTENT_LOCK" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'TITLE_CONTENT_LOCK', 0, true) . '",';
        $TITLE_CONTENT_LOCK_TTL = '"TITLE_CONTENT_LOCK_TTL" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'TITLE_CONTENT_LOCK_TTL', 0, true) . '",';
        $TITLE_CONTENT_LOCK_ISACTIVE = '"TITLE_CONTENT_LOCK_ISACTIVE" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'TITLE_CONTENT_LOCK_ISACTIVE', 0, true) . '",';
        $SOCIAL_CHECKSUM = '"SOCIAL_CHECKSUM" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'SOCIAL_CHECKSUM', 0, true) . '",';
        $SOCIAL_CONTENT = '"SOCIAL_CONTENT" : ' . $this->oCRNRSTN->return_clean_json_string($this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'SOCIAL_CONTENT', 0, true)) . ',';
        $SOCIAL_CONTENT_LOCK = '"SOCIAL_CONTENT_LOCK" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'SOCIAL_CONTENT_LOCK', 0, true) . '",';
        $SOCIAL_CONTENT_LOCK_TTL = '"SOCIAL_CONTENT_LOCK_TTL" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'SOCIAL_CONTENT_LOCK_TTL', 0, true) . '",';
        $SOCIAL_CONTENT_LOCK_ISACTIVE = '"SOCIAL_CONTENT_LOCK_ISACTIVE" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'SOCIAL_CONTENT_LOCK_ISACTIVE', 0, true) . '",';
        $COLORS_CHECKSUM = '"COLORS_CHECKSUM" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'COLORS_CHECKSUM', 0, true) . '",';
        $COLORS_CONTENT = '"COLORS_CONTENT" : ' . $this->oCRNRSTN->return_clean_json_string($this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'COLORS_CONTENT', 0, true)) . ',';
        $COLORS_CONTENT_LOCK = '"COLORS_CONTENT_LOCK" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'COLORS_CONTENT_LOCK', 0, true) . '",';
        $COLORS_CONTENT_LOCK_TTL = '"COLORS_CONTENT_LOCK_TTL" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'COLORS_CONTENT_LOCK_TTL', 0, true) . '",';
        $COLORS_CONTENT_LOCK_ISACTIVE = '"COLORS_CONTENT_LOCK_ISACTIVE" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'COLORS_CONTENT_LOCK_ISACTIVE', 0, true) . '",';
        $STATS_CHECKSUM = '"STATS_CHECKSUM" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'STATS_CHECKSUM', 0, true) . '",';
        $STATS_CONTENT = '"STATS_CONTENT" : ' . $this->oCRNRSTN->return_clean_json_string($this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'STATS_CONTENT', 0, true)) . ',';
        $STATS_CONTENT_LOCK = '"STATS_CONTENT_LOCK" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'STATS_CONTENT_LOCK', 0, true) . '",';
        $STATS_CONTENT_LOCK_TTL = '"STATS_CONTENT_LOCK_TTL" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'STATS_CONTENT_LOCK_TTL', 0, true) . '",';
        $STATS_CONTENT_LOCK_ISACTIVE = '"STATS_CONTENT_LOCK_ISACTIVE" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'STATS_CONTENT_LOCK_ISACTIVE', 0, true) . '",';
        $RELAY_CHECKSUM = '"RELAY_CHECKSUM" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'RELAY_CHECKSUM', 0, true) . '",';
        $RELAY_CONTENT = '"RELAY_CONTENT" : ' . $this->oCRNRSTN->return_clean_json_string($this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'RELAY_CONTENT', 0, true)) . ',';
        $RELAY_CONTENT_LOCK = '"RELAY_CONTENT_LOCK" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'RELAY_CONTENT_LOCK', 0, true) . '",';
        $RELAY_CONTENT_LOCK_TTL = '"RELAY_CONTENT_LOCK_TTL" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'RELAY_CONTENT_LOCK_TTL', 0, true) . '",';
        $RELAY_CONTENT_LOCK_ISACTIVE = '"RELAY_CONTENT_LOCK_ISACTIVE" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'RELAY_CONTENT_LOCK_ISACTIVE', 0, true) . '",';
        $REPORTING_CHECKSUM = '"REPORTING_CHECKSUM" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'REPORTING_CHECKSUM', 0, true) . '",';
        $REPORTING_CONTENT = '"REPORTING_CONTENT" : ' . $this->oCRNRSTN->return_clean_json_string($this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'REPORTING_CONTENT', 0, true)) . ',';
        $REPORTING_CONTENT_LOCK = '"REPORTING_CONTENT_LOCK" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'REPORTING_CONTENT_LOCK', 0, true) . '",';
        $REPORTING_CONTENT_LOCK_TTL = '"REPORTING_CONTENT_LOCK_TTL" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'REPORTING_CONTENT_LOCK_TTL', 0, true) . '",';
        $REPORTING_CONTENT_LOCK_ISACTIVE = '"REPORTING_CONTENT_LOCK_ISACTIVE" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'REPORTING_CONTENT_LOCK_ISACTIVE', 0, true) . '",';
        $WILDCARD_CHECKSUM = '"WILDCARD_CHECKSUM" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'WILDCARD_CHECKSUM', 0, true) . '",';
        $WILDCARD_CONTENT = '"WILDCARD_CONTENT" : ' . $this->oCRNRSTN->return_clean_json_string($this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'WILDCARD_CONTENT', 0, true)) . ',';
        $WILDCARD_CONTENT_LOCK = '"WILDCARD_CONTENT_LOCK" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'WILDCARD_CONTENT_LOCK', 0, true) . '",';
        $WILDCARD_CONTENT_LOCK_TTL = '"WILDCARD_CONTENT_LOCK_TTL" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'WILDCARD_CONTENT_LOCK_TTL', 0, true) . '",';
        $WILDCARD_CONTENT_LOCK_ISACTIVE = '"WILDCARD_CONTENT_LOCK_ISACTIVE" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'WILDCARD_CONTENT_LOCK_ISACTIVE', 0, true) . '",';
        $tmp_CRNRSTN_CACHE_CHECKSUM_TTL_DATA_DATEMODIFIED = '"DATEMODIFIED" : ' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'DATEMODIFIED', 0, true) . ',';
        $tmp_CRNRSTN_CACHE_CHECKSUM_TTL_DATA_DATECREATED = '"DATECREATED" : ' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'DATECREATED', 0, true) . ',';

        //
        // THEORETICALLY, ALL THE DATA STORED WITHIN THE CRNRSTN :: CONFIG MANAGER
        // AUTH'D FOR CRNRSTN_CHANNEL_PSSDTLA WOULD NEED TO BE OUTPUTTED HERE.
        $tmp_CRNRSTN_SYSTEM_CONFIGURATION = $this->oCRNRSTN->crnrstn_data_packet_return($output_channel_constant);

        $tmp_json_data = '';

        switch($output_channel_constant){
            case CRNRSTN_CHANNEL_RUNTIME:
            case CRNRSTN_CHANNEL_SOAP:
            case CRNRSTN_CHANNEL_COOKIE:
            case CRNRSTN_CHANNEL_DATABASE:
            case CRNRSTN_CHANNEL_GET:
            case CRNRSTN_CHANNEL_POST:
            case CRNRSTN_CHANNEL_SSDTLA:
            case CRNRSTN_CHANNEL_ALL:
            case CRNRSTN_CHANNEL_SESSION:
            case CRNRSTN_CHANNEL_FORM_INTEGRATIONS:
            case CRNRSTN_CHANNEL_PSSDTLA:

                //$tmp_crnrstn_session = $this->oCRNRSTN->return_form_submitted_value('crnrstn_session');
                /*

                12/18/2021 1311 hrs
                THANK YOU FOR YOUR SERVICES.

                $tmp_json_data = '{
                                   "ui_sync_controller_threads" : [
                                        {
                                        ' . $TITLE_CHECKSUM . '
                                        ' . $SOCIAL_CHECKSUM . '
                                        ' . $COLORS_CHECKSUM . '
                                        ' . $STATS_CHECKSUM . '
                                        "jony5_lifestyle_banner_checksum" : "8/16/2021 0345 :: Miss you, J5...my boy!"
                                        }
                                   ]
                                }';

                */

                // DO WE EVEN NEED THE xxxxx_CONTENT DATA HERE SINCE THIS ENCRYPTED
                // PACKET WILL NOT BE USED BY THE BROWSER?
                $tmp_json_data = '{
                    "oCRNRSTN_SESSION" : [{
                        "SESSION_ID" : "' . $tmp_SESSION_ID . '",
                        "CLIENT_AUTH_KEY" : "' . $tmp_CLIENT_AUTH_KEY . '",
                        "CLIENT_ID" : "' . $tmp_CLIENT_ID . '",
                        "CLIENT_IP" : "' . $tmp_CLIENT_IP . '",
                        "SERVER_IP" : ' . $tmp_SERVER_IP . ',
                        "EDGE_SERVER_IP" : ' . $this->oCRNRSTN->return_clean_json_string($_SERVER['SERVER_ADDR']) . ',
                        "SESSION_ID_DATEMODIFIED" : ' . $tmp_CRNRSTN_SESSION_DATA_DATEMODIFIED . ',
                        "SESSION_ID_DATECREATED" : ' . $tmp_CRNRSTN_SESSION_DATA_DATECREATED . ',
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
                        "UI_SYNC_CONTROLLER_THREADS" : [{
                            ' . $CHECKSUM_PROFILE_ID . '
                            ' . $PROGRAM_KEY . '
                            ' . $DEVICE_TYPE_CHANNEL . '
                            ' . $CANVAS_PROFILE_CONTENT . '
                            ' . $CANVAS_PROFILE_HASH . '
                            ' . $CANVAS_PROFILE_LOCK . '
                            ' . $CANVAS_PROFILE_LOCK_TTL . '
                            ' . $CANVAS_PROFILE_LOCK_ISACTIVE . '
                            ' . $CANVAS_PROFILES_DIMENSION_POSITION_CONTENT . '
                            ' . $CANVAS_PROFILES_DIMENSION_POSITION_CHECKSUM . '
                            ' . $CANVAS_PROFILES_DIMENSION_POSITION_LOCK . '
                            ' . $CANVAS_PROFILES_DIMENSION_POSITION_LOCK_TTL . '
                            ' . $CANVAS_PROFILES_DIMENSION_POSITION_LOCK_ISACTIVE . '
                            ' . $CONTENT_CHECKSUM_TTL . '
                            ' . $TITLE_CONTENT . '
                            ' . $TITLE_CHECKSUM . '
                            ' . $TITLE_CONTENT_LOCK . '
                            ' . $TITLE_CONTENT_LOCK_TTL . '
                            ' . $TITLE_CONTENT_LOCK_ISACTIVE . '
                            ' . $SOCIAL_CONTENT . '
                            ' . $SOCIAL_CHECKSUM . '
                            ' . $SOCIAL_CONTENT_LOCK . '
                            ' . $SOCIAL_CONTENT_LOCK_TTL . '
                            ' . $SOCIAL_CONTENT_LOCK_ISACTIVE . '
                            ' . $COLORS_CONTENT . '
                            ' . $COLORS_CHECKSUM . '
                            ' . $COLORS_CONTENT_LOCK . '
                            ' . $COLORS_CONTENT_LOCK_TTL . '
                            ' . $COLORS_CONTENT_LOCK_ISACTIVE . '
                            ' . $STATS_CONTENT . '
                            ' . $STATS_CHECKSUM . '
                            ' . $STATS_CONTENT_LOCK . '
                            ' . $STATS_CONTENT_LOCK_TTL . '
                            ' . $STATS_CONTENT_LOCK_ISACTIVE . '
                            ' . $RELAY_CONTENT . '
                            ' . $RELAY_CHECKSUM . '
                            ' . $RELAY_CONTENT_LOCK . '
                            ' . $RELAY_CONTENT_LOCK_TTL . '
                            ' . $RELAY_CONTENT_LOCK_ISACTIVE . '
                            ' . $REPORTING_CONTENT . '
                            ' . $REPORTING_CHECKSUM . '
                            ' . $REPORTING_CONTENT_LOCK . '
                            ' . $REPORTING_CONTENT_LOCK_TTL . '
                            ' . $REPORTING_CONTENT_LOCK_ISACTIVE . '
                            ' . $WILDCARD_CONTENT . '
                            ' . $WILDCARD_CHECKSUM . '
                            ' . $WILDCARD_CONTENT_LOCK . '
                            ' . $WILDCARD_CONTENT_LOCK_TTL . '
                            ' . $WILDCARD_CONTENT_LOCK_ISACTIVE . '
                            ' . $tmp_CRNRSTN_CACHE_CHECKSUM_TTL_DATA_DATEMODIFIED . '
                            ' . $tmp_CRNRSTN_CACHE_CHECKSUM_TTL_DATA_DATECREATED . '
                             "jony5_lifestyle_banner_checksum" : "8/16/2021 0345 :: Miss you, J5...my boy!"

                        }],
                        "ENVIRONMENTAL_CONFIGURATION" : [{
                            ' . $tmp_CRNRSTN_SYSTEM_CONFIGURATION . '
                             "jony5_lifestyle_banner_checksum" : "8/16/2021 0345 :: Miss you, J5...my boy!"

                        }]

                    }]

                }';

                break;

        }

        return $tmp_json_data;

        return $tmp_pssdtl_packet_out;

    }

    public function ____return_crnrstn_data_packet($packet_type){

        /*
        crnrstn_session
        SESSION_ID              char(26)
        SESSION_ID_CRC32        int(11) unsigned
        SERIAL_ID               char(128)
        SERIAL_ID_CRC32         int(11) unsigned
        SERIAL                  char(128)
        SERIAL_CRC32            int(11) unsigned
        ISACTIVE                tinyint(2) default 1
        CLIENT_ID               char(100)
        SERVER_IP               int(11) unsigned
        CLIENT_IP               int(11) unsigned
        DEVICE_TYPE_CONSTANT    int(11)
        DEVICE_TYPE             varchar(25) null allowed
        HTTP_USER_AGENT         varchar(500) null allowed
        ACCEPT_LANGUAGE         varchar(150) null allowed
        HTTP_REFERER	        varchar(500) null allowed
        DATEMODIFIED            datetime
        DATECREATED             timestamp default _CURRENT_TIMESTAMP
        */

        if($this->oCRNRSTN->isset_query_result_set_key('CRNRSTN_SESSION_DATA')){

            //error_log(__LINE__ . ' ui tunnel CRNRSTN_SESSION_DATA isset_query_result_set IS SET!');
            $tmp_session_count = $this->oCRNRSTN->return_record_count('CRNRSTN_SESSION_DATA');

            if($tmp_session_count > 0){

                // crnrstn_sessions TABLE DATA
                $tmp_client_ip = $this->oCRNRSTN->client_ip();
                $tmp_session_id = session_id();
                $tmp_SESSION_ID = $this->oCRNRSTN->return_database_value('CRNRSTN_SESSION_DATA', 'SESSION_ID', 0, true);
                $tmp_SERVER_IP = $this->oCRNRSTN->return_database_value('CRNRSTN_SESSION_DATA', 'SERVER_IP', 0, true);
                $tmp_CLIENT_ID = $this->oCRNRSTN->return_database_value('CRNRSTN_SESSION_DATA', 'CLIENT_ID', 0, true);
                $tmp_CLIENT_IP = $this->oCRNRSTN->return_database_value('CRNRSTN_SESSION_DATA', 'CLIENT_IP', 0, true);
                $tmp_CRNRSTN_SESSION_DATA_DATEMODIFIED = $this->oCRNRSTN->return_database_value('CRNRSTN_SESSION_DATA', 'DATEMODIFIED', 0, true);
                $tmp_CRNRSTN_SESSION_DATA_DATECREATED = $this->oCRNRSTN->return_database_value('CRNRSTN_SESSION_DATA', 'DATECREATED', 0, true);

            }else{

                //error_log(__LINE__ . ' ui tunnel CRNRSTN_SESSION_DATA HAS NO SESSION DATA.');

                $tmp_client_id = $this->oCRNRSTN->return_form_submitted_value('crnrstn_session_client_id');
                $ts_json = $this->oCRNRSTN->return_clean_json_string($this->oCRNRSTN->return_query_date_time_stamp());

                // crnrstn_sessions TABLE DATA
                $tmp_client_ip = $this->oCRNRSTN->client_ip();
                $tmp_session_id = session_id();
                $tmp_SESSION_ID = $tmp_session_id;
                $tmp_SERVER_IP = $this->oCRNRSTN->return_clean_json_string($_SERVER['SERVER_ADDR']);
                $tmp_CLIENT_ID = $this->oCRNRSTN->return_clean_json_string($tmp_client_id);
                $tmp_CLIENT_IP = $this->oCRNRSTN->client_ip();
                $tmp_CRNRSTN_SESSION_DATA_DATEMODIFIED = $ts_json;
                $tmp_CRNRSTN_SESSION_DATA_DATECREATED = $ts_json;

            }

        }else{

            //error_log(__LINE__ . ' ui tunnel CRNRSTN_SESSION_DATA isset_query_result_set IS NOT SET!');

            $tmp_client_id = $this->oCRNRSTN->return_form_submitted_value('crnrstn_session_client_id');
            $ts_json = $this->oCRNRSTN->return_clean_json_string($this->oCRNRSTN->return_query_date_time_stamp());

            // crnrstn_sessions TABLE DATA
            $tmp_client_ip = $this->oCRNRSTN->client_ip();
            $tmp_session_id = session_id();
            $tmp_SESSION_ID = $tmp_session_id;
            $tmp_SERVER_IP = $this->oCRNRSTN->return_clean_json_string($_SERVER['SERVER_ADDR']);
            $tmp_CLIENT_ID = $this->oCRNRSTN->return_clean_json_string($tmp_client_id);
            $tmp_CLIENT_IP = $this->oCRNRSTN->client_ip();
            $tmp_CRNRSTN_SESSION_DATA_DATEMODIFIED = $ts_json;
            $tmp_CRNRSTN_SESSION_DATA_DATECREATED = $ts_json;

        }

        //error_log(__LINE__ . ' ui tunnel $tmp_SESSION_ID=' . $tmp_SESSION_ID);

        if($tmp_client_ip != $tmp_CLIENT_IP && strlen($tmp_CLIENT_IP) > 0){

            //
            // SOFT ALERT SINCE NO USER AUTHENTICATED EXPERIENCE
            $tmp_STATUS_TARGET_ELEMENT = 'null';
            $tmp_STATUS = '200';
            $tmp_STATUS_CODE = '418';
            $tmp_STATUS_MESSAGE = 'I\'m a teapot';
            $tmp_ERROR_CODE = '2227';
            $tmp_ERROR_MESSAGE = 'The client IP address has straight deviated from the CRNRSTN :: PSEUDO-SOAP
                    -SERVICES Data Tunnel Layer session initialization profile. No immediate action needs
                    to be taken at this time . ';

        }else{

            if($tmp_session_id != $tmp_SESSION_ID && strlen($tmp_SESSION_ID) > 0){

                //
                // SOFT ALERT SINCE NO USER AUTHENTICATED EXPERIENCE
                $tmp_STATUS_TARGET_ELEMENT = 'null';
                $tmp_STATUS = '200';
                $tmp_STATUS_CODE = '418';
                $tmp_STATUS_MESSAGE = 'I\'m a teapot';
                $tmp_ERROR_CODE = '2228';
                $tmp_ERROR_MESSAGE = 'The SESSION profile of the CRNRSTN :: PSEUDO-SOAP-SERVICES
                    Data Tunnel Layer Packet has straight deviated from the server process currently running the
                    PSSDTL profile[' . $tmp_session_id . '][' . $tmp_SESSION_ID.']. No immediate action needs to be taken at this time.';

            }else{

                $tmp_STATUS_TARGET_ELEMENT = 'null';
                $tmp_STATUS = '200';
                $tmp_STATUS_CODE = '420';
                $tmp_STATUS_MESSAGE = 'Enhance Your Calm';
                $tmp_ERROR_CODE = '0';
                $tmp_ERROR_MESSAGE = '0';

            }

        }

        /*
        ' . $CANVAS_PROFILE_CONTENT . '
        ' . $CANVAS_PROFILE_LOCK . '
        ' . $CANVAS_PROFILE_LOCK_TTL . '
        ' . $CANVAS_PROFILE_LOCK_ISACTIVE . '

        ' . $CANVAS_PROFILES_DIMENSION_POSITION_CHECKSUM . '
        ' . $CANVAS_PROFILES_DIMENSION_POSITION_CONTENT . '

        ' . $CANVAS_PROFILES_DIMENSION_POSITION_LOCK . '
        ' . $CANVAS_PROFILES_DIMENSION_POSITION_LOCK_TTL . '
        ' . $CANVAS_PROFILES_DIMENSION_POSITION_LOCK_ISACTIVE . '

        */

        // crnrstn_jony5_content_version_checksums TABLE DATA
        $CHECKSUM_PROFILE_ID = '"CHECKSUM_PROFILE_ID" : ' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'CHECKSUM_PROFILE_ID', 0, true) . ',';
        $PROGRAM_KEY = '"PROGRAM_KEY" : ' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'PROGRAM_KEY', 0, true) . ',';
        $DEVICE_TYPE_CHANNEL = '"DEVICE_TYPE_CHANNEL" : ' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'DEVICE_TYPE_CHANNEL', 0, true) . ',';

        $CANVAS_PROFILE_HASH = '"CANVAS_PROFILE_HASH" : "' . $this->return_ui_interact_canvas_profile_checksum() . '",';
        $CANVAS_PROFILE_CONTENT = '"CANVAS_PROFILE_CONTENT" : "' . $this->oCRNRSTN->return_clean_json_string($this->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILE_CONTENT')) . '",';
        $CANVAS_PROFILE_LOCK = '"CANVAS_PROFILE_LOCK" : "' . $this->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILE_LOCK') . '",';
        $CANVAS_PROFILE_LOCK_TTL = '"CANVAS_PROFILE_LOCK_TTL" : "' . $this->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILE_LOCK_TTL') . '",';
        $CANVAS_PROFILE_LOCK_ISACTIVE = '"CANVAS_PROFILE_LOCK_ISACTIVE" : "' . $this->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILE_LOCK_ISACTIVE') . '",';

        $CANVAS_PROFILES_DIMENSION_POSITION_CHECKSUM = '"CANVAS_PROFILES_DIMENSION_POSITION_CHECKSUM" : "' . $this->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILES_DIMENSION_POSITION_CHECKSUM') . '",';
        $CANVAS_PROFILES_DIMENSION_POSITION_CONTENT = '"CANVAS_PROFILES_DIMENSION_POSITION_CONTENT" : "' . $this->oCRNRSTN->return_clean_json_string($this->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILES_DIMENSION_POSITION_CONTENT')) . '",';
        $CANVAS_PROFILES_DIMENSION_POSITION_LOCK = '"CANVAS_PROFILES_DIMENSION_POSITION_LOCK" : "' . $this->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILES_DIMENSION_POSITION_LOCK') . '",';
        $CANVAS_PROFILES_DIMENSION_POSITION_LOCK_TTL = '"CANVAS_PROFILES_DIMENSION_POSITION_LOCK_TTL" : "' . $this->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILES_DIMENSION_POSITION_LOCK_TTL') . '",';
        $CANVAS_PROFILES_DIMENSION_POSITION_LOCK_ISACTIVE = '"CANVAS_PROFILES_DIMENSION_POSITION_LOCK_ISACTIVE" : "' . $this->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILES_DIMENSION_POSITION_LOCK_ISACTIVE') . '",';

        $CONTENT_CHECKSUM_TTL = '"CONTENT_CHECKSUM_TTL" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'CONTENT_CHECKSUM_TTL', 0, true) . '",';
        $TITLE_CHECKSUM = '"TITLE_CHECKSUM" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'TITLE_CHECKSUM', 0, true) . '",';
        $TITLE_CONTENT = '"TITLE_CONTENT" : ' . $this->oCRNRSTN->return_clean_json_string($this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'TITLE_CONTENT', 0, true)) . ',';
        $TITLE_CONTENT_LOCK = '"TITLE_CONTENT_LOCK" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'TITLE_CONTENT_LOCK', 0, true) . '",';
        $TITLE_CONTENT_LOCK_TTL = '"TITLE_CONTENT_LOCK_TTL" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'TITLE_CONTENT_LOCK_TTL', 0, true) . '",';
        $TITLE_CONTENT_LOCK_ISACTIVE = '"TITLE_CONTENT_LOCK_ISACTIVE" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'TITLE_CONTENT_LOCK_ISACTIVE', 0, true) . '",';
        $SOCIAL_CHECKSUM = '"SOCIAL_CHECKSUM" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'SOCIAL_CHECKSUM', 0, true) . '",';
        $SOCIAL_CONTENT = '"SOCIAL_CONTENT" : ' . $this->oCRNRSTN->return_clean_json_string($this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'SOCIAL_CONTENT', 0, true)) . ',';
        $SOCIAL_CONTENT_LOCK = '"SOCIAL_CONTENT_LOCK" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'SOCIAL_CONTENT_LOCK', 0, true) . '",';
        $SOCIAL_CONTENT_LOCK_TTL = '"SOCIAL_CONTENT_LOCK_TTL" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'SOCIAL_CONTENT_LOCK_TTL', 0, true) . '",';
        $SOCIAL_CONTENT_LOCK_ISACTIVE = '"SOCIAL_CONTENT_LOCK_ISACTIVE" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'SOCIAL_CONTENT_LOCK_ISACTIVE', 0, true) . '",';
        $COLORS_CHECKSUM = '"COLORS_CHECKSUM" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'COLORS_CHECKSUM', 0, true) . '",';
        $COLORS_CONTENT = '"COLORS_CONTENT" : ' . $this->oCRNRSTN->return_clean_json_string($this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'COLORS_CONTENT', 0, true)) . ',';
        $COLORS_CONTENT_LOCK = '"COLORS_CONTENT_LOCK" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'COLORS_CONTENT_LOCK', 0, true) . '",';
        $COLORS_CONTENT_LOCK_TTL = '"COLORS_CONTENT_LOCK_TTL" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'COLORS_CONTENT_LOCK_TTL', 0, true) . '",';
        $COLORS_CONTENT_LOCK_ISACTIVE = '"COLORS_CONTENT_LOCK_ISACTIVE" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'COLORS_CONTENT_LOCK_ISACTIVE', 0, true) . '",';
        $STATS_CHECKSUM = '"STATS_CHECKSUM" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'STATS_CHECKSUM', 0, true) . '",';
        $STATS_CONTENT = '"STATS_CONTENT" : ' . $this->oCRNRSTN->return_clean_json_string($this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'STATS_CONTENT', 0, true)) . ',';
        $STATS_CONTENT_LOCK = '"STATS_CONTENT_LOCK" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'STATS_CONTENT_LOCK', 0, true) . '",';
        $STATS_CONTENT_LOCK_TTL = '"STATS_CONTENT_LOCK_TTL" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'STATS_CONTENT_LOCK_TTL', 0, true) . '",';
        $STATS_CONTENT_LOCK_ISACTIVE = '"STATS_CONTENT_LOCK_ISACTIVE" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'STATS_CONTENT_LOCK_ISACTIVE', 0, true) . '",';
        $RELAY_CHECKSUM = '"RELAY_CHECKSUM" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'RELAY_CHECKSUM', 0, true) . '",';
        $RELAY_CONTENT = '"RELAY_CONTENT" : ' . $this->oCRNRSTN->return_clean_json_string($this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'RELAY_CONTENT', 0, true)) . ',';
        $RELAY_CONTENT_LOCK = '"RELAY_CONTENT_LOCK" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'RELAY_CONTENT_LOCK', 0, true) . '",';
        $RELAY_CONTENT_LOCK_TTL = '"RELAY_CONTENT_LOCK_TTL" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'RELAY_CONTENT_LOCK_TTL', 0, true) . '",';
        $RELAY_CONTENT_LOCK_ISACTIVE = '"RELAY_CONTENT_LOCK_ISACTIVE" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'RELAY_CONTENT_LOCK_ISACTIVE', 0, true) . '",';
        $REPORTING_CHECKSUM = '"REPORTING_CHECKSUM" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'REPORTING_CHECKSUM', 0, true) . '",';
        $REPORTING_CONTENT = '"REPORTING_CONTENT" : ' . $this->oCRNRSTN->return_clean_json_string($this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'REPORTING_CONTENT', 0, true)) . ',';
        $REPORTING_CONTENT_LOCK = '"REPORTING_CONTENT_LOCK" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'REPORTING_CONTENT_LOCK', 0, true) . '",';
        $REPORTING_CONTENT_LOCK_TTL = '"REPORTING_CONTENT_LOCK_TTL" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'REPORTING_CONTENT_LOCK_TTL', 0, true) . '",';
        $REPORTING_CONTENT_LOCK_ISACTIVE = '"REPORTING_CONTENT_LOCK_ISACTIVE" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'REPORTING_CONTENT_LOCK_ISACTIVE', 0, true) . '",';
        $WILDCARD_CHECKSUM = '"WILDCARD_CHECKSUM" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'WILDCARD_CHECKSUM', 0, true) . '",';
        $WILDCARD_CONTENT = '"WILDCARD_CONTENT" : ' . $this->oCRNRSTN->return_clean_json_string($this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'WILDCARD_CONTENT', 0, true)) . ',';
        $WILDCARD_CONTENT_LOCK = '"WILDCARD_CONTENT_LOCK" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'WILDCARD_CONTENT_LOCK', 0, true) . '",';
        $WILDCARD_CONTENT_LOCK_TTL = '"WILDCARD_CONTENT_LOCK_TTL" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'WILDCARD_CONTENT_LOCK_TTL', 0, true) . '",';
        $WILDCARD_CONTENT_LOCK_ISACTIVE = '"WILDCARD_CONTENT_LOCK_ISACTIVE" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'WILDCARD_CONTENT_LOCK_ISACTIVE', 0, true) . '",';
        $tmp_CRNRSTN_CACHE_CHECKSUM_TTL_DATA_DATEMODIFIED = '"DATEMODIFIED" : ' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'DATEMODIFIED', 0, true) . ',';
        $tmp_CRNRSTN_CACHE_CHECKSUM_TTL_DATA_DATECREATED = '"DATECREATED" : ' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'DATECREATED', 0, true) . ',';

        $tmp_CRNRSTN_SYSTEM_CONFIGURATION = $this->oCRNRSTN->oCRNRSTN_ENV->oSESSION_MGR->return_session_oDDO_profile('pssdtl');

        $tmp_json_data = '';

        switch($packet_type){
            case 'jony5.com':

                //$tmp_crnrstn_session = $this->oCRNRSTN->return_form_submitted_value('crnrstn_session');
                /*

                12/18/2021 1311 hrs
                THANK YOU FOR YOUR SERVICES.

                $tmp_json_data = '{
                                   "ui_sync_controller_threads" : [
                                        {
                                        ' . $TITLE_CHECKSUM . '
                                        ' . $SOCIAL_CHECKSUM . '
                                        ' . $COLORS_CHECKSUM . '
                                        ' . $STATS_CHECKSUM . '
                                        "jony5_lifestyle_banner_checksum" : "8/16/2021 0345 :: Miss you, J5...my boy!"
                                        }
                                   ]
                                }';

                */

                // DO WE EVEN NEED THE xxxxx_CONTENT DATA HERE SINCE THIS ENCRYPTED
                // PACKET WILL NOT BE USED BY THE BROWSER?
                $tmp_json_data = '{
                    "oCRNRSTN_SESSION" : [{
                        "SESSION_ID" : "' . $tmp_SESSION_ID . '",
                        "CLIENT_ID" : "' . $tmp_CLIENT_ID . '",
                        "CLIENT_IP" : "' . $tmp_CLIENT_IP . '",
                        "SERVER_IP" : ' . $tmp_SERVER_IP . ',
                        "EDGE_SERVER_IP" : ' . $this->oCRNRSTN->return_clean_json_string($_SERVER['SERVER_ADDR']) . ',
                        "SESSION_ID_DATEMODIFIED" : ' . $tmp_CRNRSTN_SESSION_DATA_DATEMODIFIED . ',
                        "SESSION_ID_DATECREATED" : ' . $tmp_CRNRSTN_SESSION_DATA_DATECREATED . ',
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
                        "UI_SYNC_CONTROLLER_THREADS" : [{
                            ' . $CHECKSUM_PROFILE_ID . '
                            ' . $PROGRAM_KEY . '
                            ' . $DEVICE_TYPE_CHANNEL . '
                            ' . $CANVAS_PROFILE_CONTENT . '
                            ' . $CANVAS_PROFILE_HASH . '
                            ' . $CANVAS_PROFILE_LOCK . '
                            ' . $CANVAS_PROFILE_LOCK_TTL . '
                            ' . $CANVAS_PROFILE_LOCK_ISACTIVE . '
                            ' . $CANVAS_PROFILES_DIMENSION_POSITION_CONTENT . '
                            ' . $CANVAS_PROFILES_DIMENSION_POSITION_CHECKSUM . '
                            ' . $CANVAS_PROFILES_DIMENSION_POSITION_LOCK . '
                            ' . $CANVAS_PROFILES_DIMENSION_POSITION_LOCK_TTL . '
                            ' . $CANVAS_PROFILES_DIMENSION_POSITION_LOCK_ISACTIVE . '
                            ' . $CONTENT_CHECKSUM_TTL . '
                            ' . $TITLE_CONTENT . '
                            ' . $TITLE_CHECKSUM . '
                            ' . $TITLE_CONTENT_LOCK . '
                            ' . $TITLE_CONTENT_LOCK_TTL . '
                            ' . $TITLE_CONTENT_LOCK_ISACTIVE . '
                            ' . $SOCIAL_CONTENT . '
                            ' . $SOCIAL_CHECKSUM . '
                            ' . $SOCIAL_CONTENT_LOCK . '
                            ' . $SOCIAL_CONTENT_LOCK_TTL . '
                            ' . $SOCIAL_CONTENT_LOCK_ISACTIVE . '
                            ' . $COLORS_CONTENT . '
                            ' . $COLORS_CHECKSUM . '
                            ' . $COLORS_CONTENT_LOCK . '
                            ' . $COLORS_CONTENT_LOCK_TTL . '
                            ' . $COLORS_CONTENT_LOCK_ISACTIVE . '
                            ' . $STATS_CONTENT . '
                            ' . $STATS_CHECKSUM . '
                            ' . $STATS_CONTENT_LOCK . '
                            ' . $STATS_CONTENT_LOCK_TTL . '
                            ' . $STATS_CONTENT_LOCK_ISACTIVE . '
                            ' . $RELAY_CONTENT . '
                            ' . $RELAY_CHECKSUM . '
                            ' . $RELAY_CONTENT_LOCK . '
                            ' . $RELAY_CONTENT_LOCK_TTL . '
                            ' . $RELAY_CONTENT_LOCK_ISACTIVE . '
                            ' . $REPORTING_CONTENT . '
                            ' . $REPORTING_CHECKSUM . '
                            ' . $REPORTING_CONTENT_LOCK . '
                            ' . $REPORTING_CONTENT_LOCK_TTL . '
                            ' . $REPORTING_CONTENT_LOCK_ISACTIVE . '
                            ' . $WILDCARD_CONTENT . '
                            ' . $WILDCARD_CHECKSUM . '
                            ' . $WILDCARD_CONTENT_LOCK . '
                            ' . $WILDCARD_CONTENT_LOCK_TTL . '
                            ' . $WILDCARD_CONTENT_LOCK_ISACTIVE . '
                            ' . $tmp_CRNRSTN_CACHE_CHECKSUM_TTL_DATA_DATEMODIFIED . '
                            ' . $tmp_CRNRSTN_CACHE_CHECKSUM_TTL_DATA_DATECREATED . '
                             "jony5_lifestyle_banner_checksum" : "8/16/2021 0345 :: Miss you, J5...my boy!"

                        }],
                        "ENVIRONMENTAL_CONFIGURATION" : [{
                            ' . $tmp_CRNRSTN_SYSTEM_CONFIGURATION . '
                             "jony5_lifestyle_banner_checksum" : "8/16/2021 0345 :: Miss you, J5...my boy!"

                        }]

                    }]

                }';

                break;

        }

        return $tmp_json_data;

    }

//
//    public function return_crnrstn_data_packet($packet_type){
//
//        /*
//        crnrstn_session
//        SESSION_ID              char(26)
//        SESSION_ID_CRC32        int(11) unsigned
//        SERIAL_ID               char(128)
//        SERIAL_ID_CRC32         int(11) unsigned
//        SERIAL                  char(128)
//        SERIAL_CRC32            int(11) unsigned
//        ISACTIVE                tinyint(2) default 1
//        CLIENT_ID               char(100)
//        SERVER_IP               int(11) unsigned
//        CLIENT_IP               int(11) unsigned
//        DEVICE_TYPE_CONSTANT    int(11)
//        DEVICE_TYPE             varchar(25) null allowed
//        HTTP_USER_AGENT         varchar(500) null allowed
//        ACCEPT_LANGUAGE         varchar(150) null allowed
//        HTTP_REFERER	        varchar(500) null allowed
//        DATEMODIFIED            datetime
//        DATECREATED             timestamp default _CURRENT_TIMESTAMP
//        */
//
//        if($this->oCRNRSTN->isset_query_result_set_key('CRNRSTN_SESSION_DATA')){
//
//            error_log(__LINE__ . ' ui tunnel CRNRSTN_SESSION_DATA isset_query_result_set IS SET!');
//            $tmp_session_count = $this->oCRNRSTN->return_record_count('CRNRSTN_SESSION_DATA');
//
//            if($tmp_session_count > 0){
//
//                // crnrstn_sessions TABLE DATA
//                $tmp_client_ip = $this->oCRNRSTN->client_ip();
//                $tmp_session_id = session_id();
//                $tmp_SESSION_ID = $this->oCRNRSTN->return_database_value('CRNRSTN_SESSION_DATA', 'SESSION_ID', 0, true);
//                $tmp_SERVER_IP = $this->oCRNRSTN->return_database_value('CRNRSTN_SESSION_DATA', 'SERVER_IP', 0, true);
//                $tmp_CLIENT_ID = $this->oCRNRSTN->return_database_value('CRNRSTN_SESSION_DATA', 'CLIENT_ID', 0, true);
//                $tmp_CLIENT_IP = $this->oCRNRSTN->return_database_value('CRNRSTN_SESSION_DATA', 'CLIENT_IP', 0, true);
//                $tmp_CRNRSTN_SESSION_DATA_DATEMODIFIED = $this->oCRNRSTN->return_database_value('CRNRSTN_SESSION_DATA', 'DATEMODIFIED', 0, true);
//                $tmp_CRNRSTN_SESSION_DATA_DATECREATED = $this->oCRNRSTN->return_database_value('CRNRSTN_SESSION_DATA', 'DATECREATED', 0, true);
//
//            }else{
//
//                error_log(__LINE__ . ' ui tunnel CRNRSTN_SESSION_DATA HAS NO SESSION DATA.');
//
//                $tmp_client_id = $this->oCRNRSTN->return_form_submitted_value('crnrstn_session_client_id');
//                $ts_json = $this->oCRNRSTN->return_clean_json_string($this->oCRNRSTN->return_query_date_time_stamp());
//
//                // crnrstn_sessions TABLE DATA
//                $tmp_client_ip = $this->oCRNRSTN->client_ip();
//                $tmp_session_id = session_id();
//                $tmp_SESSION_ID = $tmp_session_id;
//                $tmp_SERVER_IP = $this->oCRNRSTN->return_clean_json_string($_SERVER['SERVER_ADDR']);
//                $tmp_CLIENT_ID = $this->oCRNRSTN->return_clean_json_string($tmp_client_id);
//                $tmp_CLIENT_IP = $this->oCRNRSTN->client_ip();
//                $tmp_CRNRSTN_SESSION_DATA_DATEMODIFIED = $ts_json;
//                $tmp_CRNRSTN_SESSION_DATA_DATECREATED = $ts_json;
//
//            }
//
//        }else{
//
//            error_log(__LINE__ . ' ui tunnel CRNRSTN_SESSION_DATA isset_query_result_set IS NOT SET!');
//
//            $tmp_client_id = $this->oCRNRSTN->return_form_submitted_value('crnrstn_session_client_id');
//            $ts_json = $this->oCRNRSTN->return_clean_json_string($this->oCRNRSTN->return_query_date_time_stamp());
//
//            // crnrstn_sessions TABLE DATA
//            $tmp_client_ip = $this->oCRNRSTN->client_ip();
//            $tmp_session_id = session_id();
//            $tmp_SESSION_ID = $tmp_session_id;
//            $tmp_SERVER_IP = $this->oCRNRSTN->return_clean_json_string($_SERVER['SERVER_ADDR']);
//            $tmp_CLIENT_ID = $this->oCRNRSTN->return_clean_json_string($tmp_client_id);
//            $tmp_CLIENT_IP = $this->oCRNRSTN->client_ip();
//            $tmp_CRNRSTN_SESSION_DATA_DATEMODIFIED = $ts_json;
//            $tmp_CRNRSTN_SESSION_DATA_DATECREATED = $ts_json;
//
//        }
//
//        error_log(__LINE__ . ' ui tunnel $tmp_SESSION_ID=' . $tmp_SESSION_ID);
//
//        if($tmp_client_ip != $tmp_CLIENT_IP && strlen($tmp_CLIENT_IP) > 0){
//
//            //
//            // SOFT ALERT SINCE NO USER AUTHENTICATED EXPERIENCE
//            $tmp_STATUS_TARGET_ELEMENT = 'null';
//            $tmp_STATUS = '200';
//            $tmp_STATUS_CODE = '418';
//            $tmp_STATUS_MESSAGE = 'I\'m a teapot';
//            $tmp_ERROR_CODE = '2227';
//            $tmp_ERROR_MESSAGE = 'The client IP address has straight deviated from the CRNRSTN :: PSEUDO-SOAP
//                    -SERVICES Data Tunnel Layer session initialization profile. No immediate action needs
//                    to be taken at this time.';
//
//        }else{
//
//            if($tmp_session_id != $tmp_SESSION_ID && strlen($tmp_SESSION_ID) > 0){
//
//                //
//                // SOFT ALERT SINCE NO USER AUTHENTICATED EXPERIENCE
//                $tmp_STATUS_TARGET_ELEMENT = 'null';
//                $tmp_STATUS = '200';
//                $tmp_STATUS_CODE = '418';
//                $tmp_STATUS_MESSAGE = 'I\'m a teapot';
//                $tmp_ERROR_CODE = '2228';
//                $tmp_ERROR_MESSAGE = 'The SESSION profile of the CRNRSTN :: PSEUDO-SOAP-SERVICES
//                    Data Tunnel Layer Packet has straight deviated from the server process currently running the
//                    PSSDTL profile[' . $tmp_session_id . '][' . $tmp_SESSION_ID.']. No immediate action needs to be taken at this time.';
//
//            }else{
//
//                $tmp_STATUS_TARGET_ELEMENT = 'null';
//                $tmp_STATUS = '200';
//                $tmp_STATUS_CODE = '420';
//                $tmp_STATUS_MESSAGE = 'Enhance Your Calm';
//                $tmp_ERROR_CODE = '0';
//                $tmp_ERROR_MESSAGE = '0';
//
//            }
//
//        }
//
//        /*
//
//        ' . $CANVAS_PROFILE_CONTENT . '
//        ' . $CANVAS_PROFILE_LOCK . '
//        ' . $CANVAS_PROFILE_LOCK_TTL . '
//        ' . $CANVAS_PROFILE_LOCK_ISACTIVE . '
//
//        ' . $CANVAS_PROFILES_DIMENSION_POSITION_CHECKSUM . '
//        ' . $CANVAS_PROFILES_DIMENSION_POSITION_CONTENT . '
//
//        ' . $CANVAS_PROFILES_DIMENSION_POSITION_LOCK . '
//        ' . $CANVAS_PROFILES_DIMENSION_POSITION_LOCK_TTL . '
//        ' . $CANVAS_PROFILES_DIMENSION_POSITION_LOCK_ISACTIVE . '
//
//         * */
//
//        // crnrstn_jony5_content_version_checksums TABLE DATA
//        $CHECKSUM_PROFILE_ID = '"CHECKSUM_PROFILE_ID" : ' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'CHECKSUM_PROFILE_ID', 0, true) . ',';
//        $PROGRAM_KEY = '"PROGRAM_KEY" : ' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'PROGRAM_KEY', 0, true) . ',';
//        $DEVICE_TYPE_CHANNEL = '"DEVICE_TYPE_CHANNEL" : ' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'DEVICE_TYPE_CHANNEL', 0, true) . ',';
//
//        $CANVAS_PROFILE_HASH = '"CANVAS_PROFILE_HASH" : "' . $this->return_ui_interact_canvas_profile_checksum() . '",';
//        $CANVAS_PROFILE_CONTENT = '"CANVAS_PROFILE_CONTENT" : "' . $this->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILE_CONTENT') . '",';
//        $CANVAS_PROFILE_LOCK = '"CANVAS_PROFILE_LOCK" : "' . $this->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILE_LOCK') . '",';
//        $CANVAS_PROFILE_LOCK_TTL = '"CANVAS_PROFILE_LOCK_TTL" : "' . $this->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILE_LOCK_TTL') . '",';
//        $CANVAS_PROFILE_LOCK_ISACTIVE = '"CANVAS_PROFILE_LOCK_ISACTIVE" : "' . $this->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILE_LOCK_ISACTIVE') . '",';
//
//        $CANVAS_PROFILES_DIMENSION_POSITION_CHECKSUM = '"CANVAS_PROFILES_DIMENSION_POSITION_CHECKSUM" : "' . $this->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILES_DIMENSION_POSITION_CHECKSUM') . '",';
//        $CANVAS_PROFILES_DIMENSION_POSITION_CONTENT = '"CANVAS_PROFILES_DIMENSION_POSITION_CONTENT" : "' . $this->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILES_DIMENSION_POSITION_CONTENT') . '",';
//        $CANVAS_PROFILES_DIMENSION_POSITION_LOCK = '"CANVAS_PROFILES_DIMENSION_POSITION_LOCK" : "' . $this->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILES_DIMENSION_POSITION_LOCK') . '",';
//        $CANVAS_PROFILES_DIMENSION_POSITION_LOCK_TTL = '"CANVAS_PROFILES_DIMENSION_POSITION_LOCK_TTL" : "' . $this->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILES_DIMENSION_POSITION_LOCK_TTL') . '",';
//        $CANVAS_PROFILES_DIMENSION_POSITION_LOCK_ISACTIVE = '"CANVAS_PROFILES_DIMENSION_POSITION_LOCK_ISACTIVE" : "' . $this->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILES_DIMENSION_POSITION_LOCK_ISACTIVE') . '",';
//
//        $CONTENT_CHECKSUM_TTL = '"CONTENT_CHECKSUM_TTL" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'CONTENT_CHECKSUM_TTL', 0, true) . '",';
//        $TITLE_CHECKSUM = '"TITLE_CHECKSUM" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'TITLE_CHECKSUM', 0, true) . '",';
//        $TITLE_CONTENT = '"TITLE_CONTENT" : ' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'TITLE_CONTENT', 0, true) . ',';
//        $TITLE_CONTENT_LOCK = '"TITLE_CONTENT_LOCK" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'TITLE_CONTENT_LOCK', 0, true) . '",';
//        $TITLE_CONTENT_LOCK_TTL = '"TITLE_CONTENT_LOCK_TTL" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'TITLE_CONTENT_LOCK_TTL', 0, true) . '",';
//        $TITLE_CONTENT_LOCK_ISACTIVE = '"TITLE_CONTENT_LOCK_ISACTIVE" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'TITLE_CONTENT_LOCK_ISACTIVE', 0, true) . '",';
//        $SOCIAL_CHECKSUM = '"SOCIAL_CHECKSUM" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'SOCIAL_CHECKSUM', 0, true) . '",';
//        $SOCIAL_CONTENT = '"SOCIAL_CONTENT" : ' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'SOCIAL_CONTENT', 0, true) . ',';
//        $SOCIAL_CONTENT_LOCK = '"SOCIAL_CONTENT_LOCK" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'SOCIAL_CONTENT_LOCK', 0, true) . '",';
//        $SOCIAL_CONTENT_LOCK_TTL = '"SOCIAL_CONTENT_LOCK_TTL" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'SOCIAL_CONTENT_LOCK_TTL', 0, true) . '",';
//        $SOCIAL_CONTENT_LOCK_ISACTIVE = '"SOCIAL_CONTENT_LOCK_ISACTIVE" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'SOCIAL_CONTENT_LOCK_ISACTIVE', 0, true) . '",';
//        $COLORS_CHECKSUM = '"COLORS_CHECKSUM" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'COLORS_CHECKSUM', 0, true) . '",';
//        $COLORS_CONTENT = '"COLORS_CONTENT" : ' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'COLORS_CONTENT', 0, true) . ',';
//        $COLORS_CONTENT_LOCK = '"COLORS_CONTENT_LOCK" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'COLORS_CONTENT_LOCK', 0, true) . '",';
//        $COLORS_CONTENT_LOCK_TTL = '"COLORS_CONTENT_LOCK_TTL" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'COLORS_CONTENT_LOCK_TTL', 0, true) . '",';
//        $COLORS_CONTENT_LOCK_ISACTIVE = '"COLORS_CONTENT_LOCK_ISACTIVE" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'COLORS_CONTENT_LOCK_ISACTIVE', 0, true) . '",';
//        $STATS_CHECKSUM = '"STATS_CHECKSUM" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'STATS_CHECKSUM', 0, true) . '",';
//        $STATS_CONTENT = '"STATS_CONTENT" : ' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'STATS_CONTENT', 0, true) . ',';
//        $STATS_CONTENT_LOCK = '"STATS_CONTENT_LOCK" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'STATS_CONTENT_LOCK', 0, true) . '",';
//        $STATS_CONTENT_LOCK_TTL = '"STATS_CONTENT_LOCK_TTL" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'STATS_CONTENT_LOCK_TTL', 0, true) . '",';
//        $STATS_CONTENT_LOCK_ISACTIVE = '"STATS_CONTENT_LOCK_ISACTIVE" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'STATS_CONTENT_LOCK_ISACTIVE', 0, true) . '",';
//        $RELAY_CHECKSUM = '"RELAY_CHECKSUM" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'RELAY_CHECKSUM', 0, true) . '",';
//        $RELAY_CONTENT = '"RELAY_CONTENT" : ' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'RELAY_CONTENT', 0, true) . ',';
//        $RELAY_CONTENT_LOCK = '"RELAY_CONTENT_LOCK" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'RELAY_CONTENT_LOCK', 0, true) . '",';
//        $RELAY_CONTENT_LOCK_TTL = '"RELAY_CONTENT_LOCK_TTL" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'RELAY_CONTENT_LOCK_TTL', 0, true) . '",';
//        $RELAY_CONTENT_LOCK_ISACTIVE = '"RELAY_CONTENT_LOCK_ISACTIVE" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'RELAY_CONTENT_LOCK_ISACTIVE', 0, true) . '",';
//        $REPORTING_CHECKSUM = '"REPORTING_CHECKSUM" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'REPORTING_CHECKSUM', 0, true) . '",';
//        $REPORTING_CONTENT = '"REPORTING_CONTENT" : ' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'REPORTING_CONTENT', 0, true) . ',';
//        $REPORTING_CONTENT_LOCK = '"REPORTING_CONTENT_LOCK" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'REPORTING_CONTENT_LOCK', 0, true) . '",';
//        $REPORTING_CONTENT_LOCK_TTL = '"REPORTING_CONTENT_LOCK_TTL" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'REPORTING_CONTENT_LOCK_TTL', 0, true) . '",';
//        $REPORTING_CONTENT_LOCK_ISACTIVE = '"REPORTING_CONTENT_LOCK_ISACTIVE" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'REPORTING_CONTENT_LOCK_ISACTIVE', 0, true) . '",';
//        $WILDCARD_CHECKSUM = '"WILDCARD_CHECKSUM" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'WILDCARD_CHECKSUM', 0, true) . '",';
//        $WILDCARD_CONTENT = '"WILDCARD_CONTENT" : ' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'WILDCARD_CONTENT', 0, true) . ',';
//        $WILDCARD_CONTENT_LOCK = '"WILDCARD_CONTENT_LOCK" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'WILDCARD_CONTENT_LOCK', 0, true) . '",';
//        $WILDCARD_CONTENT_LOCK_TTL = '"WILDCARD_CONTENT_LOCK_TTL" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'WILDCARD_CONTENT_LOCK_TTL', 0, true) . '",';
//        $WILDCARD_CONTENT_LOCK_ISACTIVE = '"WILDCARD_CONTENT_LOCK_ISACTIVE" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'WILDCARD_CONTENT_LOCK_ISACTIVE', 0, true) . '",';
//        $tmp_CRNRSTN_CACHE_CHECKSUM_TTL_DATA_DATEMODIFIED = '"DATEMODIFIED" : ' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'DATEMODIFIED', 0, true) . ',';
//        $tmp_CRNRSTN_CACHE_CHECKSUM_TTL_DATA_DATECREATED = '"DATECREATED" : ' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'DATECREATED', 0, true) . ',';
//
//        $tmp_json_data = '';
//
//        switch($packet_type){
//            case 'jony5.com':
//
//                //$tmp_crnrstn_session = $this->oCRNRSTN->return_form_submitted_value('crnrstn_session');
//                /*
//
//                12/18/2021 1311 hrs
//                THANK YOU FOR YOUR SERVICES.
//
//                $tmp_json_data = '{
//                                   "ui_sync_controller_threads" : [
//                                        {
//                                        ' . $TITLE_CHECKSUM . '
//                                        ' . $SOCIAL_CHECKSUM . '
//                                        ' . $COLORS_CHECKSUM . '
//                                        ' . $STATS_CHECKSUM . '
//                                        "jony5_lifestyle_banner_checksum" : "8/16/2021 0345 :: Miss you, J5...my boy!"
//                                        }
//                                   ]
//                                }';
//
//                */
//
//                // DO WE EVEN NEED THE xxxxx_CONTENT DATA HERE SINCE THIS ENCRYPTED
//                // PACKET WILL NOT BE USED BY THE BROWSER?
//                $tmp_json_data = '{
//                    "oCRNRSTN_SESSION" : [{
//                        "SESSION_ID" : "' . $tmp_SESSION_ID . '",
//                        "CLIENT_ID" : "' . $tmp_CLIENT_ID . '",
//                        "CLIENT_IP" : "' . $tmp_CLIENT_IP . '",
//                        "SERVER_IP" : ' . $tmp_SERVER_IP . ',
//                        "EDGE_SERVER_IP" : ' . $this->oCRNRSTN->return_clean_json_string($_SERVER['SERVER_ADDR']) . ',
//                        "SESSION_ID_DATEMODIFIED" : ' . $tmp_CRNRSTN_SESSION_DATA_DATEMODIFIED . ',
//                        "SESSION_ID_DATECREATED" : ' . $tmp_CRNRSTN_SESSION_DATA_DATECREATED . ',
//                        "STATUS_REPORT" : [{
//                            "STATUS_TARGET_ELEMENT" : ' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS_TARGET_ELEMENT) . ',
//                            "STATUS" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS) . '",
//                            "STATUS_CODE" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS_CODE) . '",
//                            "STATUS_MESSAGE" : ' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS_MESSAGE) . ',
//                            "ERROR_CODE" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_ERROR_CODE) . '",
//                            "ERROR_MESSAGE" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_ERROR_MESSAGE) . '"
//                            },{
//                            "STATUS_TARGET_ELEMENT" : ' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS_TARGET_ELEMENT) . ',
//                            "STATUS" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS) . '",
//                            "STATUS_CODE" : "1234567890",
//                            "STATUS_MESSAGE" : ' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS_MESSAGE) . ',
//                            "ERROR_CODE" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_ERROR_CODE) . '",
//                            "ERROR_MESSAGE" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_ERROR_MESSAGE) . '"
//                            },{
//                            "STATUS_TARGET_ELEMENT" : ' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS_TARGET_ELEMENT) . ',
//                            "STATUS" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS) . '",
//                            "STATUS_CODE" : "0987654321",
//                            "STATUS_MESSAGE" : ' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS_MESSAGE) . ',
//                            "ERROR_CODE" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_ERROR_CODE) . '",
//                            "ERROR_MESSAGE" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_ERROR_MESSAGE) . '"
//                            }],
//                        "UI_SYNC_CONTROLLER_THREADS" : [{
//                            ' . $CHECKSUM_PROFILE_ID . '
//                            ' . $PROGRAM_KEY . '
//                            ' . $DEVICE_TYPE_CHANNEL . '
//                            ' . $CANVAS_PROFILE_HASH . '
//                            ' . $CANVAS_PROFILE_CONTENT . '
//                            ' . $CANVAS_PROFILE_LOCK . '
//                            ' . $CANVAS_PROFILE_LOCK_TTL . '
//                            ' . $CANVAS_PROFILE_LOCK_ISACTIVE . '
//                            ' . $CANVAS_PROFILES_DIMENSION_POSITION_CHECKSUM . '
//                            ' . $CANVAS_PROFILES_DIMENSION_POSITION_CONTENT . '
//                            ' . $CANVAS_PROFILES_DIMENSION_POSITION_LOCK . '
//                            ' . $CANVAS_PROFILES_DIMENSION_POSITION_LOCK_TTL . '
//                            ' . $CANVAS_PROFILES_DIMENSION_POSITION_LOCK_ISACTIVE . '
//                            ' . $CONTENT_CHECKSUM_TTL . '
//                            ' . $TITLE_CHECKSUM . '
//                            ' . $TITLE_CONTENT . '
//                            ' . $TITLE_CONTENT_LOCK . '
//                            ' . $TITLE_CONTENT_LOCK_TTL . '
//                            ' . $TITLE_CONTENT_LOCK_ISACTIVE . '
//                            ' . $SOCIAL_CHECKSUM . '
//                            ' . $SOCIAL_CONTENT . '
//                            ' . $SOCIAL_CONTENT_LOCK . '
//                            ' . $SOCIAL_CONTENT_LOCK_TTL . '
//                            ' . $SOCIAL_CONTENT_LOCK_ISACTIVE . '
//                            ' . $COLORS_CHECKSUM . '
//                            ' . $COLORS_CONTENT . '
//                            ' . $COLORS_CONTENT_LOCK . '
//                            ' . $COLORS_CONTENT_LOCK_TTL . '
//                            ' . $COLORS_CONTENT_LOCK_ISACTIVE . '
//                            ' . $STATS_CHECKSUM . '
//                            ' . $STATS_CONTENT . '
//                            ' . $STATS_CONTENT_LOCK . '
//                            ' . $STATS_CONTENT_LOCK_TTL . '
//                            ' . $STATS_CONTENT_LOCK_ISACTIVE . '
//                            ' . $RELAY_CHECKSUM . '
//                            ' . $RELAY_CONTENT . '
//                            ' . $RELAY_CONTENT_LOCK . '
//                            ' . $RELAY_CONTENT_LOCK_TTL . '
//                            ' . $RELAY_CONTENT_LOCK_ISACTIVE . '
//                            ' . $REPORTING_CHECKSUM . '
//                            ' . $REPORTING_CONTENT . '
//                            ' . $REPORTING_CONTENT_LOCK . '
//                            ' . $REPORTING_CONTENT_LOCK_TTL . '
//                            ' . $REPORTING_CONTENT_LOCK_ISACTIVE . '
//                            ' . $WILDCARD_CHECKSUM . '
//                            ' . $WILDCARD_CONTENT . '
//                            ' . $WILDCARD_CONTENT_LOCK . '
//                            ' . $WILDCARD_CONTENT_LOCK_TTL . '
//                            ' . $WILDCARD_CONTENT_LOCK_ISACTIVE . '
//                            ' . $tmp_CRNRSTN_CACHE_CHECKSUM_TTL_DATA_DATEMODIFIED . '
//                            ' . $tmp_CRNRSTN_CACHE_CHECKSUM_TTL_DATA_DATECREATED . '
//                             "jony5_lifestyle_banner_checksum" : "8/16/2021 0345 :: Miss you, J5...my boy!"
//
//                        }]
//
//                    }]
//
//                }';
//
//            break;
//
//        }
//
//        return $tmp_json_data;
//
//    }

    public function ssdtl_response_http_language_preference($output_type = 'xml'){

        $output_string = '';
        $output_type = strtolower($output_type);

        $tmp_lang_pref_cnt = $this->oCRNRSTN->oCRNRSTN_LANG_MGR->return_lang_pref_count();

        if($tmp_lang_pref_cnt < 1){

            $this->oCRNRSTN->oCRNRSTN_LANG_MGR->initialize_client_language_profile();
            $tmp_lang_pref_cnt = $this->oCRNRSTN->oCRNRSTN_LANG_MGR->return_lang_pref_count();

        }

        //en-US,en;q=0.9,zh-CN;q=0.8,zh;q=0.7
        //$tmp_header_language_attribute = $this->oCRNRSTN->return_client_header_value('Accept-Language');

        //$oCRNRSTN_LANG_MGR = $this->oCRNRSTN->return_crnrstn_language_manager($tmp_header_language_attribute);

        //$oCRNRSTN_LANG_MGR = $this->oCRNRSTN->return_crnrstn_language_manager();

        //$tmp_accept_language_preference_ARRAY = $this->oCRNRSTN->return_client_accept_language_array($tmp_header_language_attribute);

        switch($output_type){
            case 'array':

                $tmp_ARRAY = array();

                for($i = 0; $i < $tmp_lang_pref_cnt; $i++){

                    $tmp_ARRAY[$i]['locale_identifier'] = $this->oCRNRSTN->oCRNRSTN_LANG_MGR->return_lang_pref_data('locale_identifier', $i);
                    $tmp_ARRAY[$i]['region_variant'] = $this->oCRNRSTN->oCRNRSTN_LANG_MGR->return_lang_pref_data('region_variant', $i);
                    $tmp_ARRAY[$i]['factor_weighting'] = $this->oCRNRSTN->oCRNRSTN_LANG_MGR->return_lang_pref_data('factor_weighting', $i);
                    $tmp_ARRAY[$i]['iso_language_nomination'] = $this->oCRNRSTN->oCRNRSTN_LANG_MGR->return_lang_pref_data('iso_language_nomination', $i);
                    $tmp_ARRAY[$i]['native_nomination'] = $this->oCRNRSTN->oCRNRSTN_LANG_MGR->return_lang_pref_data('native_nomination', $i);
                    $tmp_ARRAY[$i]['iso_639-1_2002'] = $this->oCRNRSTN->oCRNRSTN_LANG_MGR->return_lang_pref_data('iso_639-1_2002', $i);
                    $tmp_ARRAY[$i]['iso_639-2_1998'] = $this->oCRNRSTN->oCRNRSTN_LANG_MGR->return_lang_pref_data('iso_639-2_1998', $i);
                    $tmp_ARRAY[$i]['iso_639-3_2007'] = $this->oCRNRSTN->oCRNRSTN_LANG_MGR->return_lang_pref_data('iso_639-3_2007', $i);
                    $tmp_ARRAY[$i]['locale_identifier'] = $this->oCRNRSTN->oCRNRSTN_LANG_MGR->return_lang_pref_data('locale_identifier', $i);

                }

                return $tmp_ARRAY;

            break;
            case 'xml':
            default:

                if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

                    for($i = 0; $i < $tmp_lang_pref_cnt; $i++){

                        $output_string .= '<language_preference><request_id timestamp="' . $this->oCRNRSTN->return_micro_time() . '">' . $this->oCRNRSTN->oCRNRSTN_LANG_MGR->return_lang_pref_serial($i) . '</request_id><request_referer><![CDATA[' . $_SERVER['HTTP_REFERER'] . ']]></request_referer>';
                        $output_string .= '<locale_identifier>' . $this->oCRNRSTN->oCRNRSTN_LANG_MGR->return_lang_pref_data('locale_identifier', $i) . '</locale_identifier><region_variant>' . $this->oCRNRSTN->oCRNRSTN_LANG_MGR->return_lang_pref_data('region_variant', $i) . '</region_variant><factor_weighting>' . $this->oCRNRSTN->oCRNRSTN_LANG_MGR->return_lang_pref_data('factor_weighting', $i) . '</factor_weighting><iso_language_nomination>' . $this->oCRNRSTN->oCRNRSTN_LANG_MGR->return_lang_pref_data('iso_language_nomination', $i) . '</iso_language_nomination><native_nomination><![CDATA[' . $this->oCRNRSTN->oCRNRSTN_LANG_MGR->return_lang_pref_data('native_nomination', $i) . ']]></native_nomination><iso_639-1_2002>' . $this->oCRNRSTN->oCRNRSTN_LANG_MGR->return_lang_pref_data('iso_639-1_2002', $i) . '</iso_639-1_2002><iso_639-2_1998>' . $this->oCRNRSTN->oCRNRSTN_LANG_MGR->return_lang_pref_data('iso_639-2_1998', $i) . '</iso_639-2_1998><iso_639-3_2007>' . $this->oCRNRSTN->oCRNRSTN_LANG_MGR->return_lang_pref_data('iso_639-3_2007', $i) . '</iso_639-3_2007>';
                        $output_string .= '</language_preference>';

                    }

                }else{

                    for($i = 0; $i < $tmp_lang_pref_cnt; $i++){

                        $output_string .= '<language_preference>
                        <request_id timestamp="' . $this->oCRNRSTN->return_micro_time() . '">' . $this->oCRNRSTN->oCRNRSTN_LANG_MGR->return_lang_pref_serial($i) . '</request_id>
                        <request_referer><![CDATA[' . $_SERVER['HTTP_REFERER'] . ']]></request_referer>';

                        $output_string .= '
                        <locale_identifier>' . $this->oCRNRSTN->oCRNRSTN_LANG_MGR->return_lang_pref_data('locale_identifier', $i) . '</locale_identifier>
                        <region_variant>' . $this->oCRNRSTN->oCRNRSTN_LANG_MGR->return_lang_pref_data('region_variant', $i) . '</region_variant>
                        <factor_weighting>' . $this->oCRNRSTN->oCRNRSTN_LANG_MGR->return_lang_pref_data('factor_weighting', $i) . '</factor_weighting>
                        <iso_language_nomination>' . $this->oCRNRSTN->oCRNRSTN_LANG_MGR->return_lang_pref_data('iso_language_nomination', $i) . '</iso_language_nomination>
                        <native_nomination><![CDATA[' . $this->oCRNRSTN->oCRNRSTN_LANG_MGR->return_lang_pref_data('native_nomination', $i) . ']]></native_nomination>
                        <iso_639-1_2002>' . $this->oCRNRSTN->oCRNRSTN_LANG_MGR->return_lang_pref_data('iso_639-1_2002', $i) . '</iso_639-1_2002>
                        <iso_639-2_1998>' . $this->oCRNRSTN->oCRNRSTN_LANG_MGR->return_lang_pref_data('iso_639-2_1998', $i) . '</iso_639-2_1998>
                        <iso_639-3_2007>' . $this->oCRNRSTN->oCRNRSTN_LANG_MGR->return_lang_pref_data('iso_639-3_2007', $i) . '</iso_639-3_2007>';

                        if($i < $tmp_lang_pref_cnt - 1){

                            $output_string .= '
                    </language_preference>
                    ';

                        }else{

                            $output_string .= '
                    </language_preference>';

                        }

                    }

                }

            break;

        }

        return $output_string;

    }

    private function initialize_data(){

        //
        // THIS SHOULD REALLY ONLY BE RUN VIA XHR...NOT OBJECT INSTANTIATION ON EVERY PAGE LOAD.

        //
        // LOAD DATA PROFILE
        if(!$this->load_bassdrive_cache_data()){

            //
            // SYNC WITH BASSDRIVE PRODUCTION DATA
            $this->oCRNRSTN->log_bassdrive_nowplaying();
            $this->oCRNRSTN->relay_sync_bassdrive_log();

        }

        //
        // LOAD BASSDRIVE META
        $this->load_bassdrive_meta_data();

        $tmp_UPDATED_CACHE_ARRAY = $this->refresh_content_version_checksum_data();

        //
        // LOAD LIFESTYLE IMAGE CONTENT
        $this->load_jony5_lifestyle_images();

        //
        // PROCESS ANY REMAINING QUERY
        $this->oCRNRSTN->process_query();

    }

    private function short_format($data_format){

        $format = '';

        switch($data_format){
            case 'kilabit':

                $format = 'KB';

                break;
            case 'megabit':

                $format = 'MB';

                break;
            case 'gigabit':

                $format = 'GB';

                break;
            default:

                $format = '?B';

                break;

        }

        return $format;

    }

    private function content_version_checksum_ttl_expired(){

        if(!$this->oCRNRSTN->isset_query_result_set_key('RELAY_CURRENT_DATA')){

            $tmp_query = 'SELECT `crnrstn_stream_relay`.`RELAY_ID`,
                `crnrstn_stream_relay`.`RELAY_TYPE`,
                `crnrstn_stream_relay`.`STREAM_URL`,
                `crnrstn_stream_relay`.`STREAM_URL_CRC32`,
                `crnrstn_stream_relay`.`STREAM_URL_IOS`,
                `crnrstn_stream_relay`.`ISACTIVE`,
                `crnrstn_stream_relay`.`BASSDRIVE_LOG_ID`,
                `crnrstn_stream_relay`.`BITRATE`,
                `crnrstn_stream_relay`.`STATUS`,
                `crnrstn_stream_relay`.`NAME`,
                `crnrstn_stream_relay`.`LISTENER_COUNT`,
                `crnrstn_stream_relay`.`LISTENER_COUNT_PERCENTAGE`,
                `crnrstn_stream_relay`.`AUDIO_FORMAT`,
                `crnrstn_stream_relay`.`TITLE`,
                `crnrstn_stream_relay`.`TITLE_CHECKSUM_MD5`,
                `crnrstn_stream_relay`.`STREAM_KEY`,
                `crnrstn_stream_relay`.`STREAM_KEY_MD5`,
                `crnrstn_stream_relay`.`IS_REPLAY`,
                `crnrstn_stream_relay`.`STATS_TOTAL_CONNECTIONS`,
                `crnrstn_stream_relay`.`STATS_TOTAL_CAPACITY`,
                `crnrstn_stream_relay`.`STATS_TOTAL_BANDWIDTH`,
                `crnrstn_stream_relay`.`STATS_TOTAL_BANDWIDTH_FORMAT`,
                `crnrstn_stream_relay`.`STATS_TOTAL_UNIQUE_CONNECTIONS`,
                `crnrstn_stream_relay`.`STATS_TOTAL_UNIQUE_CAPACITY`,
                `crnrstn_stream_relay`.`STATS_TOTAL_UNIQUE_BANDWIDTH`,
                `crnrstn_stream_relay`.`STATS_TOTAL_UNIQUE_BANDWIDTH_FORMAT`,
                `crnrstn_stream_relay`.`STATS_PREMIUM_BITRATE`,
                `crnrstn_stream_relay`.`STATS_PREMIUM_BITRATE_FORMAT`,
                `crnrstn_stream_relay`.`STATS_PREMIUM_CONNECTIONS`,
                `crnrstn_stream_relay`.`STATS_PREMIUM_CAPACITY`,
                `crnrstn_stream_relay`.`STATS_PREMIUM_BANDWIDTH`,
                `crnrstn_stream_relay`.`STATS_PREMIUM_BANDWIDTH_FORMAT`,
                `crnrstn_stream_relay`.`STATS_MIDGRADE_BITRATE`,
                `crnrstn_stream_relay`.`STATS_MIDGRADE_BITRATE_FORMAT`,
                `crnrstn_stream_relay`.`STATS_MIDGRADE_CONNECTIONS`,
                `crnrstn_stream_relay`.`STATS_MIDGRADE_CAPACITY`,
                `crnrstn_stream_relay`.`STATS_MIDGRADE_BANDWIDTH`,
                `crnrstn_stream_relay`.`STATS_MIDGRADE_BANDWIDTH_FORMAT`,
                `crnrstn_stream_relay`.`STATS_AAC_PLUS_BITRATE`,
                `crnrstn_stream_relay`.`STATS_AAC_PLUS_BITRATE_FORMAT`,
                `crnrstn_stream_relay`.`STATS_AAC_PLUS_CONNECTIONS`,
                `crnrstn_stream_relay`.`STATS_AAC_PLUS_CAPACITY`,
                `crnrstn_stream_relay`.`STATS_AAC_PLUS_BANDWIDTH`,
                `crnrstn_stream_relay`.`STATS_AAC_PLUS_BANDWIDTH_FORMAT`,
                `crnrstn_stream_relay`.`STATS_RANDOM_BITRATE`,
                `crnrstn_stream_relay`.`STATS_RANDOM_BITRATE_FORMAT`,
                `crnrstn_stream_relay`.`STATS_RANDOM_CONNECTIONS`,
                `crnrstn_stream_relay`.`STATS_RANDOM_CAPACITY`,
                `crnrstn_stream_relay`.`STATS_RANDOM_BANDWIDTH`,
                `crnrstn_stream_relay`.`STATS_RANDOM_BANDWIDTH_FORMAT`,
                `crnrstn_stream_relay`.`DATEMODIFIED`,
                `crnrstn_stream_relay`.`DATECREATED`
            FROM `crnrstn_stream_relay`
            WHERE `crnrstn_stream_relay`.`ISACTIVE` = 1 LIMIT 1;';
            $tmp_result_set_key = $this->oCRNRSTN->load_query_profile('BASSDRIVE_UI_SUPPORT', '!jesus_is_my_dear_lord!', 'RELAY_CURRENT_DATA', __LINE__, __METHOD__);
            $this->oCRNRSTN->add_database_query($tmp_result_set_key, $tmp_query);

        }

        if(!$this->oCRNRSTN->isset_query_result_set_key('CRNRSTN_CACHE_CHECKSUM_TTL_DATA')){

            $tmp_query = 'SELECT `crnrstn_jony5_content_version_checksums`.`CHECKSUM_PROFILE_ID`,
                `crnrstn_jony5_content_version_checksums`.`PROGRAM_KEY`,
                `crnrstn_jony5_content_version_checksums`.`DEVICE_TYPE_CHANNEL`,
                `crnrstn_jony5_content_version_checksums`.`CONTENT_CHECKSUM_TTL`,
                `crnrstn_jony5_content_version_checksums`.`TITLE_CHECKSUM`,
                `crnrstn_jony5_content_version_checksums`.`TITLE_CONTENT`,
                `crnrstn_jony5_content_version_checksums`.`TITLE_CONTENT_LOCK`,
                `crnrstn_jony5_content_version_checksums`.`TITLE_CONTENT_LOCK_TTL`,
                `crnrstn_jony5_content_version_checksums`.`TITLE_CONTENT_LOCK_ISACTIVE`,
                `crnrstn_jony5_content_version_checksums`.`SOCIAL_CHECKSUM`,
                `crnrstn_jony5_content_version_checksums`.`SOCIAL_CONTENT`,
                `crnrstn_jony5_content_version_checksums`.`SOCIAL_CONTENT_LOCK`,
                `crnrstn_jony5_content_version_checksums`.`SOCIAL_CONTENT_LOCK_TTL`,
                `crnrstn_jony5_content_version_checksums`.`SOCIAL_CONTENT_LOCK_ISACTIVE`,
                `crnrstn_jony5_content_version_checksums`.`COLORS_CHECKSUM`,
                `crnrstn_jony5_content_version_checksums`.`COLORS_CONTENT`,
                `crnrstn_jony5_content_version_checksums`.`COLORS_CONTENT_LOCK`,
                `crnrstn_jony5_content_version_checksums`.`COLORS_CONTENT_LOCK_TTL`,
                `crnrstn_jony5_content_version_checksums`.`COLORS_CONTENT_LOCK_ISACTIVE`,
                `crnrstn_jony5_content_version_checksums`.`STATS_CHECKSUM`,
                `crnrstn_jony5_content_version_checksums`.`STATS_CONTENT`,
                `crnrstn_jony5_content_version_checksums`.`STATS_CONTENT_LOCK`,
                `crnrstn_jony5_content_version_checksums`.`STATS_CONTENT_LOCK_TTL`,
                `crnrstn_jony5_content_version_checksums`.`STATS_CONTENT_LOCK_ISACTIVE`,
                `crnrstn_jony5_content_version_checksums`.`RELAY_CHECKSUM`,
                `crnrstn_jony5_content_version_checksums`.`RELAY_CONTENT`,
                `crnrstn_jony5_content_version_checksums`.`RELAY_CONTENT_LOCK`,
                `crnrstn_jony5_content_version_checksums`.`RELAY_CONTENT_LOCK_TTL`,
                `crnrstn_jony5_content_version_checksums`.`RELAY_CONTENT_LOCK_ISACTIVE`,
                `crnrstn_jony5_content_version_checksums`.`REPORTING_CHECKSUM`,
                `crnrstn_jony5_content_version_checksums`.`REPORTING_CONTENT`,
                `crnrstn_jony5_content_version_checksums`.`REPORTING_CONTENT_LOCK`,
                `crnrstn_jony5_content_version_checksums`.`REPORTING_CONTENT_LOCK_TTL`,
                `crnrstn_jony5_content_version_checksums`.`REPORTING_CONTENT_LOCK_ISACTIVE`,
                `crnrstn_jony5_content_version_checksums`.`WILDCARD_CHECKSUM`,
                `crnrstn_jony5_content_version_checksums`.`WILDCARD_CONTENT`,
                `crnrstn_jony5_content_version_checksums`.`WILDCARD_CONTENT_LOCK`,
                `crnrstn_jony5_content_version_checksums`.`WILDCARD_CONTENT_LOCK_TTL`,
                `crnrstn_jony5_content_version_checksums`.`WILDCARD_CONTENT_LOCK_ISACTIVE`,
                `crnrstn_jony5_content_version_checksums`.`DATEMODIFIED`,
                `crnrstn_jony5_content_version_checksums`,`DATECREATED`
            FROM `crnrstn_jony5_content_version_checksums`
            WHERE `crnrstn_jony5_content_version_checksums`.`PROGRAM_KEY` = "BASSDRIVE"
            AND (`crnrstn_jony5_content_version_checksums`.`DEVICE_TYPE_CHANNEL` = "DESKTOP"
            OR `crnrstn_jony5_content_version_checksums`.`DEVICE_TYPE_CHANNEL` = "' . $this->oCRNRSTN->device_type . '") LIMIT 1;';
            $tmp_result_set_key = $this->oCRNRSTN->load_query_profile('BASSDRIVE_UI_SUPPORT', '!jesus_is_my_dear_lord!', 'CRNRSTN_CACHE_CHECKSUM_TTL_DATA', __LINE__, __METHOD__);
            $this->oCRNRSTN->add_database_query($tmp_result_set_key, $tmp_query);

        }

        //
        // PROCESS ALL QUERY TO CONNECTION(S)
        $this->oCRNRSTN->process_query();

        $tmp_DATEMODIFIED = $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'DATEMODIFIED');
        $tmp_CONTENT_CHECKSUM_TTL = $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'CONTENT_CHECKSUM_TTL');

        $tmp_ttl_standard = strtotime('-' . $tmp_CONTENT_CHECKSUM_TTL .' seconds');
        $tmp_content_freshness = strtotime($tmp_DATEMODIFIED);

        if($tmp_ttl_standard > $tmp_content_freshness){

            //
            // TTL EXPIRED
            return true;

        }else{

            //
            // STILL FRESH
            return false;

        }

    }

    private function refresh_content_version_checksum_data(){

        //
        // BUILD FRESH CONTENT AND GET FRESH CHECKSUMS FROM LATEST PRODUCTION DATA
        $tmp_STREAM_KEY = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STREAM_KEY');
        $tmp_TITLE = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'TITLE');

        $tmp_show_title_ARRAY = $this->return_show_title_html($tmp_TITLE);
        $tmp_TITLE_CONTENT = $tmp_show_title_ARRAY['title'];
        $tmp_SOCIAL_CONTENT = $this->return_show_social_html($tmp_STREAM_KEY, $tmp_TITLE, false);
        $tmp_COLORS_CONTENT = $this->return_show_locale_html($tmp_show_title_ARRAY);
        $tmp_STATS_CONTENT = $this->return_stats_html();
        $tmp_STATS_CONTENT_FOR_CHECKSUM = $this->return_stats_html(true);

        $tmp_TITLE_CHECKSUM = $this->oCRNRSTN->crcINT($tmp_TITLE_CONTENT);
        $tmp_SOCIAL_CHECKSUM = $this->oCRNRSTN->crcINT($this->return_show_social_html($tmp_STREAM_KEY, $tmp_TITLE));
        $tmp_COLORS_CHECKSUM = $this->oCRNRSTN->crcINT($tmp_COLORS_CONTENT);
        $tmp_STATS_CHECKSUM = $this->oCRNRSTN->crcINT($tmp_STATS_CONTENT_FOR_CHECKSUM);

        //
        // GET CACHED CHECKSUMS AND COMPARE FOR DELTA DISCOVERY
        $tmp_TITLE_CHECKSUM_CACHED = $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'TITLE_CHECKSUM');
        $tmp_SOCIAL_CHECKSUM_CACHED = $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'SOCIAL_CHECKSUM');
        $tmp_COLORS_CHECKSUM_CACHED = $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'COLORS_CHECKSUM');
        $tmp_STATS_CHECKSUM_CACHED = $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'STATS_CHECKSUM');

        $tmp_query_TITLE_CHECKSUM = '';
        $tmp_query_SOCIAL_CHECKSUM = '';
        $tmp_query_COLORS_CHECKSUM = '';
        $tmp_query_STATS_CHECKSUM = '';

        //
        // UPDATE CHECKSUM TABLE WITH NEW CHECKSUMS AND CONTENT
        if($tmp_TITLE_CHECKSUM != $tmp_TITLE_CHECKSUM_CACHED){

            $tmp_query_TITLE_CHECKSUM = '`TITLE_CHECKSUM` = ' . $tmp_TITLE_CHECKSUM . ',
            `TITLE_CONTENT` = "' . $this->mysqli->real_escape_string($tmp_TITLE_CONTENT) . '",';

        }

        if($tmp_SOCIAL_CHECKSUM != $tmp_SOCIAL_CHECKSUM_CACHED){

            $tmp_query_SOCIAL_CHECKSUM = '`SOCIAL_CHECKSUM` = ' . $tmp_SOCIAL_CHECKSUM . ',
            `SOCIAL_CONTENT` = "' . $this->mysqli->real_escape_string($tmp_SOCIAL_CONTENT) . '",';

        }

        if($tmp_COLORS_CHECKSUM != $tmp_COLORS_CHECKSUM_CACHED){

            $tmp_query_COLORS_CHECKSUM = '`COLORS_CHECKSUM` = ' . $tmp_COLORS_CHECKSUM . ',
            `COLORS_CONTENT` = "' . $this->mysqli->real_escape_string($tmp_COLORS_CONTENT) . '",';

        }

        if($tmp_STATS_CHECKSUM != $tmp_STATS_CHECKSUM_CACHED){

            $tmp_query_STATS_CHECKSUM = '`STATS_CHECKSUM` = ' . $tmp_STATS_CHECKSUM . ',
            `STATS_CONTENT` = "' . $this->mysqli->real_escape_string($tmp_STATS_CONTENT) . '",';

        }

        /*
        case 'bassdrive_title_checksum':
        case 'bassdrive_social_checksum':
        case 'bassdrive_locale_checksum':
        case 'bassdrive_stats_checksum': // STATS ARE PULLED FROM CURRENT PERFORMANCE RELAY DATA...HANDLE DIFFERENTLY FOR NOW
        case 'bassdrive_stream_relays_checksum': // TABLE THIS FOR LATER
        */

        $ts = $this->oCRNRSTN->return_query_date_time_stamp();
        $tmp_query = 'UPDATE `crnrstn_jony5_content_version_checksums`
        SET
        ' . $tmp_query_TITLE_CHECKSUM . '
        ' . $tmp_query_SOCIAL_CHECKSUM . '
        ' . $tmp_query_COLORS_CHECKSUM . '
        ' . $tmp_query_STATS_CHECKSUM . '
        `DATEMODIFIED` = "' . $ts . '"
        WHERE `PROGRAM_KEY` = "BASSDRIVE"
        AND (`DEVICE_TYPE_CHANNEL` = "DESKTOP" OR `DEVICE_TYPE_CHANNEL` = "' . $this->oCRNRSTN->device_type . '") LIMIT 1;';
        $tmp_result_set_key = $this->oCRNRSTN->load_query_profile('BASSDRIVE_UI_SUPPORT', '!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
        $this->oCRNRSTN->add_database_query($tmp_result_set_key, $tmp_query);

        //
        // PROCESS ALL QUERY TO CONNECTION(S)
        $this->oCRNRSTN->process_query();

    }

    public function return_ui_interact_canvas_profile_checksum($type = 'CANVAS_PROFILE_HASH'){

        switch($type){
            case 'CANVAS_PROFILE_CONTENT':

                $tmp_config_str = '';

                $tmp_config_str .= $this->return_interact_ui_profile('CANVAS_PROFILE_CONTENT');

                return $tmp_config_str;

            break;
            case 'CANVAS_PROFILE_LOCK':

                $tmp_config_str = 0;

                return $tmp_config_str;

            break;
            case 'CANVAS_PROFILE_LOCK_TTL':

                $tmp_config_str = 60;

                return $tmp_config_str;

            break;
            case 'CANVAS_PROFILE_LOCK_ISACTIVE':

                $tmp_config_str = 0;

                return $tmp_config_str;

            break;
            case 'CANVAS_PROFILES_DIMENSION_POSITION_CHECKSUM':

                $tmp_config_str = '';
                $tmp_config_str .= $this->return_interact_ui_profile('CANVAS_DIMENSIONS_AND_POSITIONS');

                return $this->oCRNRSTN->hash($tmp_config_str);

                /*

                <theme_configuration>

                    $CANVAS_PROFILES_DIMENSION_POSITION_CHECKSUM

                        <mini_canvas left="84%" width="100" height="70" checksum="' . $this->oCRNRSTN->hash('10070') . '"></mini_canvas>
                        <signin_canvas width="260" height="305" checksum="' . $this->oCRNRSTN->hash('260305') . '"></signin_canvas>
                        <main_canvas width="1080" height="760" checksum="' . $this->oCRNRSTN->hash('1080760') . '"></main_canvas>
                        <eula_canvas width="700" height="400" checksum="' . $this->oCRNRSTN->hash('700400') . '"></eula_canvas>
                        <mit_license_canvas width="500" height="400" checksum="' . $this->oCRNRSTN->hash('500400') . '"></mit_license_canvas>

                </theme_configuration>

                */

            break;
            case 'CANVAS_PROFILES_DIMENSION_POSITION_CONTENT':

                $tmp_config_str = '';

                $tmp_config_str .= $this->return_interact_ui_profile('CANVAS_DIMENSIONS_AND_POSITIONS');

                return $tmp_config_str;

            break;
            case 'CANVAS_PROFILES_DIMENSION_POSITION_LOCK':

                $tmp_config_str = 0;

                return $tmp_config_str;

            break;
            case 'CANVAS_PROFILES_DIMENSION_POSITION_LOCK_TTL':

                $tmp_config_str = 60;

                return $tmp_config_str;

            break;
            case 'CANVAS_PROFILES_DIMENSION_POSITION_LOCK_ISACTIVE':

                $tmp_config_str = 0;

                return $tmp_config_str;

            break;
            default:
                // CANVAS_PROFILE_HASH

                $tmp_config_str = '';

                //UI_INTERACT_CANVAS_Z_INDEX
                $tmp_config_str .= $this->return_interact_ui_profile('Z_INDEX');
                $tmp_config_str .= $this->return_interact_ui_profile('WINDOW_EDGE_PADDING');
                $tmp_config_str .= $this->return_interact_ui_profile('OUTLINE_BORDER_EDGE_LINE_WIDTH');
                $tmp_config_str .= $this->return_interact_ui_profile('OUTLINE_BORDER_EDGE_LINE_STYLE');
                $tmp_config_str .= $this->return_interact_ui_profile('OUTLINE_BORDER_EDGE_LINE_COLOR');
                $tmp_config_str .= $this->return_interact_ui_profile('BORDER_WIDTH');
                $tmp_config_str .= $this->return_interact_ui_profile('BORDER_COLOR');
                $tmp_config_str .= $this->return_interact_ui_profile('BORDER_OPACITY');
                $tmp_config_str .= $this->return_interact_ui_profile('BACKGROUND_COLOR');
                $tmp_config_str .= $this->return_interact_ui_profile('BACKGROUND_OPACITY');
                $tmp_config_str .= $this->return_interact_ui_profile('INNER_CONTENT_EDGE_PADDING');

                return $this->oCRNRSTN->hash($tmp_config_str);

                /*

                06/25/2022 @ 1914 hrs
                $CANVAS_PROFILE_HASH
                    <canvas
                        z_index="60"
                        window_edge_padding="20"
                        outline_border_edge_line_width="2"
                        outline_border_edge_line_style="solid"
                        outline_border_edge_line_color="#767676"
                        border_width="10"
                        border_color="#FFF"
                        border_opacity="0.3"
                        background_color="#FFF"
                        background_opacity="1"
                        inner_content_edge_padding="25"
                        hash="' . $this->oCRNRSTN->hash('60202solid#76767610#FFF0.3#FFF125') . '"></canvas>

                */

            break;

        }

    }

    public function return_interact_ui_profile($config_profile_key = 'FULL'){

        /*
        <state_synchronization_data>
            <crnrstn_interact_ui_profile>
                ' . $tmp_CRNRSTN_UI_INTERACT . '
            </crnrstn_interact_ui_profile>
        </state_synchronization_data>

        .crnrstn_interact_ui_wrapper                    { position:-webkit-sticky; position: sticky; bottom:5px; z-index: 60; width: 100px; left: 84%; height: 70px; padding: 0 0 20px 0; left:-3000px; width:0; height: 0; overflow: hidden;}
        .crnrstn_interact_ui                            { }
        .crnrstn_interact_ui_bg_border                  { position: absolute; width:100px; height: 70px; border: 2px solid #767676; background-color: #FFF; opacity: 0.3; }
        .crnrstn_interact_ui_bg_solid                   { position: absolute; width: 85px; height:46px; background-color: #FFF; opacity: 1; margin: 8px; padding: 11px 0 0 2px; cursor:pointer; }

        .crnrstn_interact_ui_content_wrapper            { position: absolute; display: none; z-index: 61; padding: 25px 0 0 25px; }
        .crnrstn_interact_ui_content_wrapper input      { text-align: left; font-size: 20px; width: 208px; height: 34px; border:2px solid #676767; background-color: #FFF;}
        .crnrstn_interact_ui_signin_frm_lbl             { text-align: left; font-size: 20px;}
        .crnrstn_interact_ui_signin_frm_chkbx_eula      { float: left; width: 16px;}
        .crnrstn_interact_ui_signin_frm_lbl_eula        { float: left; width: 80px; font-size: 18px; padding:7px 0 0 0; cursor: pointer;}
        .crnrstn_interact_ui_signin_frm_lbl_eula a      { text-decoration: none; color: #0066CC; text-decoration: underline;}
        .crnrstn_interact_ui_frm_submit                 { width: 115px; height: 37px; background-color: #FFF; border: 2px solid #5C98EB; cursor:pointer; }
        .crnrstn_interact_ui_signin_frm_btn_submit      { text-align: left; font-size: 20px; color: #5C98EB; font-weight: bold; padding: 7px 0 0 17px; cursor:pointer;}

        <![CDATA[           ]]>
        */

        switch($config_profile_key){
            case 'CANVAS_DIMENSIONS_AND_POSITIONS':

                if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

                    $tmp_content_str = '<mini_canvas left="84%" width="118" height="179" checksum="' . $this->oCRNRSTN->hash('84%118179') . '"></mini_canvas><signin_canvas width="260" height="305" checksum="' . $this->oCRNRSTN->hash('260305') . '"></signin_canvas><main_canvas width="1080" height="760" checksum="' . $this->oCRNRSTN->hash('1080760') . '"></main_canvas><eula_canvas width="700" height="400" checksum="' . $this->oCRNRSTN->hash('700400') . '"></eula_canvas><mit_license_canvas width="500" height="400" checksum="' . $this->oCRNRSTN->hash('500400') . '"></mit_license_canvas>';

                }else{

                    $tmp_content_str = '<mini_canvas left="84%" width="118" height="179" checksum="' . $this->oCRNRSTN->hash('84%118179') . '"></mini_canvas>
                <signin_canvas width="260" height="305" checksum="' . $this->oCRNRSTN->hash('260305') . '"></signin_canvas>
                <main_canvas width="1080" height="760" checksum="' . $this->oCRNRSTN->hash('1080760') . '"></main_canvas>
                <eula_canvas width="700" height="400" checksum="' . $this->oCRNRSTN->hash('700400') . '"></eula_canvas>
                <mit_license_canvas width="500" height="400" checksum="' . $this->oCRNRSTN->hash('500400') . '"></mit_license_canvas>';

                }

                return $tmp_content_str;

            break;
            case 'Z_INDEX':

                return '60';

            break;
            case 'WINDOW_EDGE_PADDING':

                return '20';

            break;
            case 'OUTLINE_BORDER_EDGE_LINE_WIDTH':

                return '1';

            break;
            case 'OUTLINE_BORDER_EDGE_LINE_STYLE':

                return 'solid';

            break;
            case 'OUTLINE_BORDER_EDGE_LINE_COLOR':

                return '#FFF';

            break;
            case 'BORDER_WIDTH':

                return '10';

            break;
            case 'BORDER_COLOR':

                return '#FFF';

            break;
            case 'BORDER_OPACITY':

                return '0.3';

            break;
            case 'BACKGROUND_COLOR':

                return '#FFF';

            break;
            case 'BACKGROUND_OPACITY':

                return '1';

            break;
            case 'INNER_CONTENT_EDGE_PADDING':

                return '25';

            break;
            default:
                // FULL

                /*
                this.ui_interact_input_id_ARRAY = ['crnrstn_interact_ui_primary_nav_img_shell_menu_glass_case',
                    'crnrstn_interact_ui_primary_nav_img_shell_close_x_glass_case',
                    'crnrstn_interact_ui_primary_nav_img_shell_fs_expand_glass_case',
                    'crnrstn_interact_ui_primary_nav_img_shell_minimize_glass_case'];

                this.ui_interact_input_type_ARRAY = ['menu',
                    'close_x',
                    'fs_expand',
                    'minimize'];

                See oENV->return_output_CRNRSTN_UI_MESSENGER() for HTML generation of content.
                The following will be XML output to client.

                */

                if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

                    return '<is_enabled>' . $this->oCRNRSTN->tidy_boolean($this->oCRNRSTN->get_resource('CRNRSTN_UI_INTERACT_ENABLED'), 'string') . '</is_enabled><is_visible>' . $this->oCRNRSTN->tidy_boolean($this->oCRNRSTN->get_resource('CRNRSTN_UI_INTERACT_ISVISIBLE'), 'string') . '</is_visible><theme_configuration><canvas z_index="60" window_edge_padding="20" outline_border_edge_line_width="2" outline_border_edge_line_style="solid" outline_border_edge_line_color="#767676" border_width="10" border_color="#FFF" border_opacity="0.3" background_color="#FFF" background_opacity="1" inner_content_edge_padding="25" hash="' . $this->oCRNRSTN->hash('60202solid#76767610#FFF0.3#FFF125') . '"></canvas><mini_canvas left="84%" width="118" height="179" hash="' . $this->oCRNRSTN->hash('118179') . '"></mini_canvas><signin_canvas width="260" height="305" hash="' . $this->oCRNRSTN->hash('260305') . '"></signin_canvas><main_canvas width="1080" height="760" hash="' . $this->oCRNRSTN->hash('1080760') . '"></main_canvas><eula_canvas width="700" height="400" hash="' . $this->oCRNRSTN->hash('700400') . '"></eula_canvas><mit_license_canvas width="500" height="400" hash="' . $this->oCRNRSTN->hash('500400') . '"></mit_license_canvas></theme_configuration><navigation><primary><nav_link dom_elem_id="crnrstn_interact_ui_primary_nav_img_shell_menu_glass_case" dom_elem_class="crnrstn_interact_ui_primary_nav_img_shell">menu</nav_link><nav_link dom_elem_id="crnrstn_interact_ui_primary_nav_img_shell_close_x_glass_case" dom_elem_class="crnrstn_interact_ui_primary_nav_img_shell">close_x</nav_link><nav_link dom_elem_id="crnrstn_interact_ui_primary_nav_img_shell_fs_expand_glass_case" dom_elem_class="crnrstn_interact_ui_primary_nav_img_shell">fs_expand</nav_link><nav_link dom_elem_id="crnrstn_interact_ui_primary_nav_img_shell_minimize_glass_case" dom_elem_class="crnrstn_interact_ui_primary_nav_img_shell">minimize</nav_link></primary></navigation>';

                }else{

                    return '<is_enabled>' . $this->oCRNRSTN->tidy_boolean($this->oCRNRSTN->get_resource('CRNRSTN_UI_INTERACT_ENABLED'), 'string') . '</is_enabled>
                <is_visible>' . $this->oCRNRSTN->tidy_boolean($this->oCRNRSTN->get_resource('CRNRSTN_UI_INTERACT_ISVISIBLE'), 'string') . '</is_visible>
                <theme_configuration>
                    <canvas z_index="60" window_edge_padding="20" outline_border_edge_line_width="2" outline_border_edge_line_style="solid" outline_border_edge_line_color="#767676" border_width="10" border_color="#FFF" border_opacity="0.3" background_color="#FFF" background_opacity="1" inner_content_edge_padding="25" hash="' . $this->oCRNRSTN->hash('60202solid#76767610#FFF0.3#FFF125') . '"></canvas>
                    <mini_canvas left="84%" width="118" height="179" hash="' . $this->oCRNRSTN->hash('118179') . '"></mini_canvas>
                    <signin_canvas width="260" height="305" hash="' . $this->oCRNRSTN->hash('260305') . '"></signin_canvas>
                    <main_canvas width="1080" height="760" hash="' . $this->oCRNRSTN->hash('1080760') . '"></main_canvas>
                    <eula_canvas width="700" height="400" hash="' . $this->oCRNRSTN->hash('700400') . '"></eula_canvas>
                    <mit_license_canvas width="500" height="400" hash="' . $this->oCRNRSTN->hash('500400') . '"></mit_license_canvas>
                </theme_configuration>
                <navigation>
                    <primary>
                        <nav_link dom_elem_id="crnrstn_interact_ui_primary_nav_img_shell_menu_glass_case" dom_elem_class="crnrstn_interact_ui_primary_nav_img_shell">menu</nav_link>
                        <nav_link dom_elem_id="crnrstn_interact_ui_primary_nav_img_shell_close_x_glass_case" dom_elem_class="crnrstn_interact_ui_primary_nav_img_shell">close_x</nav_link>
                        <nav_link dom_elem_id="crnrstn_interact_ui_primary_nav_img_shell_fs_expand_glass_case" dom_elem_class="crnrstn_interact_ui_primary_nav_img_shell">fs_expand</nav_link>
                        <nav_link dom_elem_id="crnrstn_interact_ui_primary_nav_img_shell_minimize_glass_case" dom_elem_class="crnrstn_interact_ui_primary_nav_img_shell">minimize</nav_link>
                    </primary>
                </navigation>';

                }

            break;

        }

    }

    //
    // SOAP DATA TUNNEL LAYER FORM INTEGRATION PACKET GENERATION WITH FRESH CONTENT CHECKSUMS
    public function return_crnrstn_data_packet($data_authorization_profile){

        return $this->oCRNRSTN->return_crnrstn_data_packet($data_authorization_profile);

//        $tmp_oNUSOAP_BASE = $this->oCRNRSTN->return_oNUSOAP_BASE();
//
//        $tmp_request_serialization_key = $this->oCRNRSTN->return_form_submitted_value('crnrstn_request_serialization_key');
//        $tmp_request_serialization_hash = $this->oCRNRSTN->return_form_submitted_value('crnrstn_request_serialization_hash');
//        $tmp_client_id = $this->oCRNRSTN->return_form_submitted_value('crnrstn_session_client_id');
//        $tmp_client_auth_key = $this->oCRNRSTN->return_form_submitted_value('crnrstn_session_client_auth_key');
//
//        $this->oCRNRSTN->form_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_request_serialization_key', true);
//        $this->oCRNRSTN->form_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_request_serialization_hash', true);
//        $this->oCRNRSTN->form_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_session', false);
//
//        $this->oCRNRSTN->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_session', true, $this->return_crnrstn_data_packet(CRNRSTN_CHANNEL_PSSDTLA));
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
//        $tmp_str_out = '<form action="' . $this->oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP') . $this->oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'soa/tunnel/" method="post" id="crnrstn_soap_data_tunnel_frm" name="crnrstn_soap_data_tunnel_frm" enctype="multipart/form-data">
//            <textarea id="crnrstn_soap_srvc_data" name="crnrstn_soap_srvc_data" cols="130" rows="5">SOAP_DATA_TUNNEL_LAYER_PACKET</textarea>
//            <button type="submit">SUBMIT</button>
//            <input type="hidden" id="crnrstn_request_serialization_key" name="crnrstn_request_serialization_key" value="' . $tmp_request_serialization_key . '">
//            <input type="hidden" id="crnrstn_request_serialization_hash" name="crnrstn_request_serialization_hash" value="' . $tmp_request_serialization_hash . '">'.
//            $this->oCRNRSTN->ui_content_module_out(CRNRSTN_UI_FORM_INTEGRATION_PACKET, 'crnrstn_soap_data_tunnel_form').'
//        </form>';
//
//        return $tmp_str_out;

    }

    private function return_ssdtl_form_integrations_packet($output_format = 'ssdtl_fip'){

        //
        // PSEUDO SOAP DATA TUNNEL LAYER CLIENT CHECKSUM DATA
        $tmp_send_it = false;
        $tmp_ARRAY = array();
        $tmp_ARRAY['SSDTL_FIP'] = '0';
        $tmp_ARRAY['TITLE_HTML'] = '0';
        $tmp_ARRAY['SOCIAL_HTML'] = '0';
        $tmp_ARRAY['COLORS_HTML'] = '0';
        //$tmp_crnrstn_php_sessionid = $this->oCRNRSTN->return_form_submitted_value('crnrstn_php_sessionid');
        $tmp_crnrstn_pssdtl_packet = $this->oCRNRSTN->data_decrypt($this->oCRNRSTN->return_form_submitted_value('crnrstn_pssdtl_packet'));

        //echo 'Last error: ', json_last_error_msg(), PHP_EOL, PHP_EOL;
        //error_log(__LINE__ . ' ui tunnel $tmp_crnrstn_session_ojson=[' . print_r($tmp_crnrstn_pssdtl_packet, true) . ']');

        if(isset($tmp_crnrstn_pssdtl_packet['oCRNRSTN_SESSION'])){

            $raw_json_ui_sync_controller_threads = $tmp_crnrstn_pssdtl_packet['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'];
            //$raw_json_ui_sync_controller_threads = $tmp_content_serialization['UI_SYNC_CONTROLLER_THREADS'];

            //error_log(__LINE__ . ' ui tunnel $raw_json_ui_sync_controller_threads=[' . print_r($raw_json_ui_sync_controller_threads, true).'].');

            /*
             "oCRNRSTN_SESSION" : [{
                        "SESSION_ID" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_SESSION_ID) . '",
                        "CLIENT_ID" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_CLIENT_ID) . '",
                        "CLIENT_IP" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_CLIENT_IP) .'",
                        "SERVER_IP" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_SERVER_IP) .'",
                        "EDGE_SERVER_IP" : "' . $this->oCRNRSTN->return_clean_json_string($_SERVER['SERVER_ADDR']) .'",
                        "SESSION_ID_DATEMODIFIED" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_CRNRSTN_SESSION_DATA_DATEMODIFIED) . '",
                        "SESSION_ID_DATECREATED" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_CRNRSTN_SESSION_DATA_DATECREATED) . '",
                        "STATUS" : "' . $this->oCRNRSTN->return_json_value($tmp_STATUS) . '",
                        "STATUS_CODE" : "' . $this->oCRNRSTN->return_json_value($tmp_STATUS_CODE) . '",
                        "STATUS_MESSAGE" : "' . $this->oCRNRSTN->return_json_value($tmp_STATUS_MESSAGE) . '",
                        "ERROR_CODE" : "' . $this->oCRNRSTN->return_json_value($tmp_ERROR_CODE) . '",
                        "ERROR_MESSAGE" : "' . $this->oCRNRSTN->return_json_value($tmp_ERROR_MESSAGE) . '",
                        "UI_SYNC_CONTROLLER_THREADS" : [{
                                    $CHECKSUM_PROFILE_ID = '"CHECKSUM_PROFILE_ID" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'CHECKSUM_PROFILE_ID', 0, true) . '",';
                                    $PROGRAM_KEY = '"PROGRAM_KEY" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'PROGRAM_KEY', 0, true) . '",';
                                    $DEVICE_TYPE_CHANNEL = '"DEVICE_TYPE_CHANNEL" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'DEVICE_TYPE_CHANNEL', 0, true) . '",';
                                    $CONTENT_CHECKSUM_TTL = '"CONTENT_CHECKSUM_TTL" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'CONTENT_CHECKSUM_TTL', 0, true) . '",';
                                    $TITLE_CHECKSUM = '"TITLE_CHECKSUM" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'TITLE_CHECKSUM', 0, true) . '",';
                                    $TITLE_CONTENT = '"TITLE_CONTENT" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'TITLE_CONTENT', 0, true) . '",';
                                    $TITLE_CONTENT_LOCK = '"TITLE_CONTENT_LOCK" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'TITLE_CONTENT_LOCK', 0, true) . '",';
                                    $TITLE_CONTENT_LOCK_TTL = '"TITLE_CONTENT_LOCK_TTL" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'TITLE_CONTENT_LOCK_TTL', 0, true) . '",';
                                    $TITLE_CONTENT_LOCK_ISACTIVE = '"TITLE_CONTENT_LOCK_ISACTIVE" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'TITLE_CONTENT_LOCK_ISACTIVE', 0, true) . '",';
                                    $SOCIAL_CHECKSUM = '"SOCIAL_CHECKSUM" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'SOCIAL_CHECKSUM', 0, true) . '",';
                                    $SOCIAL_CONTENT = '"SOCIAL_CONTENT" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'SOCIAL_CONTENT', 0, true) . '",';
                                    $SOCIAL_CONTENT_LOCK = '"SOCIAL_CONTENT_LOCK" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'SOCIAL_CONTENT_LOCK', 0, true) . '",';
                                    $SOCIAL_CONTENT_LOCK_TTL = '"SOCIAL_CONTENT_LOCK_TTL" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'SOCIAL_CONTENT_LOCK_TTL', 0, true) . '",';
                                    $SOCIAL_CONTENT_LOCK_ISACTIVE = '"SOCIAL_CONTENT_LOCK_ISACTIVE" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'SOCIAL_CONTENT_LOCK_ISACTIVE', 0, true) . '",';
                                    $COLORS_CHECKSUM = '"COLORS_CHECKSUM" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'COLORS_CHECKSUM', 0, true) . '",';
                                    $COLORS_CONTENT = '"COLORS_CONTENT" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'COLORS_CONTENT', 0, true) . '",';
                                    $COLORS_CONTENT_LOCK = '"COLORS_CONTENT_LOCK" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'COLORS_CONTENT_LOCK', 0, true) . '",';
                                    $COLORS_CONTENT_LOCK_TTL = '"COLORS_CONTENT_LOCK_TTL" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'COLORS_CONTENT_LOCK_TTL', 0, true) . '",';
                                    $COLORS_CONTENT_LOCK_ISACTIVE = '"COLORS_CONTENT_LOCK_ISACTIVE" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'COLORS_CONTENT_LOCK_ISACTIVE', 0, true) . '",';
                                    $STATS_CHECKSUM = '"STATS_CHECKSUM" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'STATS_CHECKSUM', 0, true) . '",';
                                    $STATS_CONTENT = '"STATS_CONTENT" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'STATS_CONTENT', 0, true) . '",';
                                    $STATS_CONTENT_LOCK = '"STATS_CONTENT_LOCK" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'STATS_CONTENT_LOCK', 0, true) . '",';
                                    $STATS_CONTENT_LOCK_TTL = '"STATS_CONTENT_LOCK_TTL" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'STATS_CONTENT_LOCK_TTL', 0, true) . '",';
                                    $STATS_CONTENT_LOCK_ISACTIVE = '"STATS_CONTENT_LOCK_ISACTIVE" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'STATS_CONTENT_LOCK_ISACTIVE', 0, true) . '",';
                                    $RELAY_CHECKSUM = '"RELAY_CHECKSUM" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'RELAY_CHECKSUM', 0, true) . '",';
                                    $RELAY_CONTENT = '"RELAY_CONTENT" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'RELAY_CONTENT', 0, true) . '",';
                                    $RELAY_CONTENT_LOCK = '"RELAY_CONTENT_LOCK" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'RELAY_CONTENT_LOCK', 0, true) . '",';
                                    $RELAY_CONTENT_LOCK_TTL = '"RELAY_CONTENT_LOCK_TTL" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'RELAY_CONTENT_LOCK_TTL', 0, true) . '",';
                                    $RELAY_CONTENT_LOCK_ISACTIVE = '"RELAY_CONTENT_LOCK_ISACTIVE" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'RELAY_CONTENT_LOCK_ISACTIVE', 0, true) . '",';
                                    $REPORTING_CHECKSUM = '"REPORTING_CHECKSUM" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'REPORTING_CHECKSUM', 0, true) . '",';
                                    $REPORTING_CONTENT = '"REPORTING_CONTENT" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'REPORTING_CONTENT', 0, true) . '",';
                                    $REPORTING_CONTENT_LOCK = '"REPORTING_CONTENT_LOCK" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'REPORTING_CONTENT_LOCK', 0, true) . '",';
                                    $REPORTING_CONTENT_LOCK_TTL = '"REPORTING_CONTENT_LOCK_TTL" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'REPORTING_CONTENT_LOCK_TTL', 0, true) . '",';
                                    $REPORTING_CONTENT_LOCK_ISACTIVE = '"REPORTING_CONTENT_LOCK_ISACTIVE" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'REPORTING_CONTENT_LOCK_ISACTIVE', 0, true) . '",';
                                    $WILDCARD_CHECKSUM = '"WILDCARD_CHECKSUM" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'WILDCARD_CHECKSUM', 0, true) . '",';
                                    $WILDCARD_CONTENT = '"WILDCARD_CONTENT" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'WILDCARD_CONTENT', 0, true) . '",';
                                    $WILDCARD_CONTENT_LOCK = '"WILDCARD_CONTENT_LOCK" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'WILDCARD_CONTENT_LOCK', 0, true) . '",';
                                    $WILDCARD_CONTENT_LOCK_TTL = '"WILDCARD_CONTENT_LOCK_TTL" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'WILDCARD_CONTENT_LOCK_TTL', 0, true) . '",';
                                    $WILDCARD_CONTENT_LOCK_ISACTIVE = '"WILDCARD_CONTENT_LOCK_ISACTIVE" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'WILDCARD_CONTENT_LOCK_ISACTIVE', 0, true) . '",';
                                    $tmp_CACHE_CHECKSUM_TTL_DATA_DATEMODIFIED = '"DATEMODIFIED" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'DATEMODIFIED', 0, true) . '",';
                                    $tmp_CACHE_CHECKSUM_TTL_DATA_DATECREATED = '"DATECREATED" : "' . $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'DATECREATED', 0, true) . '",';

            */

            //die();
            //
            // CHECK BROWSER CONTENT CACHE CHECKSUMS AGAINST CURRENT CONTENT CHECKSUMS
            foreach($raw_json_ui_sync_controller_threads[0] as $content_id => $checksum){

                switch($content_id){
                    case 'bassdrive_title_checksum':

                        $tmp_TITLE_CHECKSUM = $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'TITLE_CHECKSUM');

                        if($tmp_TITLE_CHECKSUM != $checksum){

                            //error_log(__LINE__ . ' ui tunnel *** ON ACCOUNT OF [' . $content_id . '] SEND IT!!');
                            $tmp_send_it = true;
                            $tmp_TITLE_CONTENT = $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'TITLE_CONTENT');

                        }else{

                            $tmp_TITLE_CONTENT = '';

                        }

                    break;
                    case 'bassdrive_social_checksum':

                        $tmp_SOCIAL_CHECKSUM = $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'SOCIAL_CHECKSUM');

                        if($tmp_SOCIAL_CHECKSUM != $checksum){

                            //error_log(__LINE__ . ' ui tunnel *** ON ACCOUNT OF [' . $content_id . '] SEND IT!!');
                            $tmp_send_it = true;
                            $tmp_SOCIAL_CONTENT = $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'SOCIAL_CONTENT');

                        }else{

                            $tmp_SOCIAL_CONTENT = '';

                        }

                    break;
                    case 'bassdrive_locale_checksum':

                        $tmp_COLORS_CHECKSUM = $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'COLORS_CHECKSUM');

                        if($tmp_COLORS_CHECKSUM != $checksum){

                            //error_log(__LINE__ . ' ui tunnel *** ON ACCOUNT OF [' . $content_id . '] SEND IT!!');
                            $tmp_send_it = true;
                            $tmp_COLORS_CONTENT = $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'COLORS_CONTENT');

                        }else{

                            $tmp_COLORS_CONTENT = '';

                        }

                    break;
                    case 'bassdrive_stats_checksum':

                        $tmp_STATS_CHECKSUM = $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'STATS_CHECKSUM');

                        if($tmp_STATS_CHECKSUM != $checksum){

                            //error_log(__LINE__ . ' ui tunnel *** ON ACCOUNT OF [' . $content_id . '] SEND IT!!');
                            $tmp_send_it = true;

                        }

                    break;

                }

            }

            if($tmp_send_it){

                if($output_format == 'array'){

                    $tmp_ARRAY['SSDTL_FIP'] = $this->return_crnrstn_data_packet(CRNRSTN_CHANNEL_PSSDTLA);
                    $tmp_ARRAY['TITLE_HTML'] = $tmp_TITLE_CONTENT;
                    $tmp_ARRAY['SOCIAL_HTML'] = $tmp_SOCIAL_CONTENT;
                    $tmp_ARRAY['COLORS_HTML'] = $tmp_COLORS_CONTENT;

                    return $tmp_ARRAY;

                }else{

                    return $this->return_crnrstn_data_packet(CRNRSTN_CHANNEL_PSSDTLA);

                }

            }else{

                if($output_format == 'array'){

                    return $tmp_ARRAY;

                }else{

                    return '';

                }

            }

        }

    }

    private function return_rrs_map_resource_acceleration_report(){

        /*
        [Fri Mar 31 20:18:11.967665 2023] [:error] [pid 2574] [client 172.16.225.1:56881] 2319 ui tunnel
        [session][
            Array\n(\n
                [session] =>
                    Array\n        (\n
                        [0] => Array\n                (\n
                            [resource_method] =>
                                Array\n                        (\n
                                    [0] => return_asset_data\n
                                )\n\n
                            [resource_datecreated] =>
                                Array\n                        (\n
                                    [0] => 1680308285\n
                                )\n\n
                            [resource_runtime] =>
                                Array\n                        (\n
                                    [0] => 0.059581\n
                                )\n\n
                        )\n\n
                    )\n\n
            )\n]., referer: http://172.16.225.139/lightsaber.crnrstn.evifweb.com/

        */

        //$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'][0]['rrs_map_report'][$tmp_fulfillment_driver][$tmp_resource_id]['resource_runtime'][] = $this->oCRNRSTN->wall_time();

        $tmp_channel_report_str = '';

        $tmp_channel_ARRAY = $this->oCRNRSTN->return_cache_channels();
        foreach($tmp_channel_ARRAY as $index => $channel){

            if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'][0]['rrs_map_report'][$channel])){

                error_log(__LINE__ . ' ui tunnel [' . $channel . '][' . print_r($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'][0]['rrs_map_report'][$channel], true).'].');

                $tmp_channel_report_str .= $channel . ' has data ' . count($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'][0]['rrs_map_report'][$channel]) . ' elements.
        ';

            }

        }

        return '<rrs_map_resource_acceleration_report>' . $tmp_channel_report_str . '</rrs_map_resource_acceleration_report>
        ';

    }

    private function return_ssdtl_status_report(){

        /*
        $http_status_codes = array(100 => 'Continue', 101 => 'Switching Protocols', 102 => 'Processing',
        200 => 'OK', 201 => 'Created', 202 => 'Accepted', 203 => 'Non-Authoritative Information',
        204 => 'No Content', 205 => 'Reset Content', 206 => 'Partial Content', 207 => 'Multi-Status',
        300 => 'Multiple Choices', 301 => 'Moved Permanently', 302 => 'Found', 303 => 'See Other',
        304 => 'Not Modified', 305 => 'Use Proxy', 306 => '(Unused)', 307 => 'Temporary Redirect',
        308 => 'Permanent Redirect', 400 => 'Bad Request', 401 => 'Unauthorized', 402 => 'Payment Required',
        403 => 'Forbidden', 404 => 'Not Found', 405 => 'Method Not Allowed', 406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required', 408 => 'Request Timeout', 409 => 'Conflict', 410 => 'Gone',
        411 => 'Length Required', 412 => 'Precondition Failed', 413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long', 415 => 'Unsupported Media Type', 416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed', 418 => 'I\'m a teapot', 419 => 'Authentication Timeout',
        420 => 'Enhance Your Calm', 422 => 'Unprocessable Entity', 423 => 'Locked', 424 => 'Failed Dependency',
        424 => 'Method Failure', 425 => 'Unordered Collection', 426 => 'Upgrade Required',
        428 => 'Precondition Required', 429 => 'Too Many Requests', 431 => 'Request Header Fields Too Large',
        444 => 'No Response', 449 => 'Retry With', 450 => 'Blocked by Windows Parental Controls',
        451 => 'Unavailable For Legal Reasons', 494 => 'Request Header Too Large', 495 => 'Cert Error',
        496 => 'No Cert', 497 => 'HTTP to HTTPS', 499 => 'Client Closed Request', 500 => 'Internal Server Error',
        501 => 'Not Implemented', 502 => 'Bad Gateway', 503 => 'Service Unavailable', 504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported', 506 => 'Variant Also Negotiates', 507 => 'Insufficient Storage',
        508 => 'Loop Detected', 509 => 'Bandwidth Limit Exceeded', 510 => 'Not Extended',
        511 => 'Network Authentication Required', 598 => 'Network read timeout error',
        599 => 'Network connect timeout error');
        */

        $tmp_target_element = 'null';
        $tmp_status_code = '420';
        $tmp_status_message = 'Enhance Your Calm';
        $tmp_is_error_code = '0';
        $tmp_is_error_message = '0';

        //$tmp_crnrstn_soap_service_client_ip = $this->oCRNRSTN->return_form_submitted_value('crnrstn_soap_service_client_ip');
        $tmp_crnrstn_soap_service_client_ip = $this->oCRNRSTN->data_decrypt($this->oCRNRSTN->oDATA_TUNNEL_SERVICES_MGR->return_received_data('crnrstn_soap_service_client_ip'));

        if($tmp_crnrstn_soap_service_client_ip != $this->oCRNRSTN->client_ip()){

            //
            // SOFT ALERT SINCE NO USER AUTHENTICATED EXPERIENCE
            $tmp_status_code = '418';
            $tmp_status_message = 'I\'m a teapot';
            $tmp_is_error_code = '2227';
            $tmp_is_error_message = 'The client IP address has straight deviated from the CRNRSTN :: PSEUDO-SOAP
                    -SERVICES Data Tunnel Layer session initialization profile. No immediate action needs
                    to be taken at this time.';

        }

        if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

            $tmp_output = '<status_report><target_element>' . $tmp_target_element . '</target_element><status_code>' . $tmp_status_code . '</status_code><status_message>' . $tmp_status_message . '</status_message><is_error_code>' . $tmp_is_error_code . '</is_error_code><is_error_message>' . $tmp_is_error_message . '</is_error_message></status_report>';

        }else{

            $tmp_output = '<status_report>
                    <target_element>' . $tmp_target_element . '</target_element>
                    <status_code>' . $tmp_status_code . '</status_code>
                    <status_message>' . $tmp_status_message . '</status_message>
                    <is_error_code>' . $tmp_is_error_code . '</is_error_code>
                    <is_error_message>' . $tmp_is_error_message . '</is_error_message>
                </status_report>';

        }

        return $tmp_output;

    }

    public function soap_data_tunnel_layer_response(){

        $tmp_xml_response = '';

        //
        // PREPARE RECEIVED INPUT PARAMETERS FOR DATABASE QUERY
        $tmp_request_id = $this->oCRNRSTN->generate_new_key(128);
        $tmp_serial_id = $this->oCRNRSTN->generate_new_key(128, -3);
        $tmp_serial = $this->oCRNRSTN->generate_new_key(128, '01');

        $tmp_request_serialization_key = $this->oCRNRSTN->return_form_submitted_value('crnrstn_request_serialization_key');
        $tmp_request_serialization_hash = $this->oCRNRSTN->return_form_submitted_value('crnrstn_request_serialization_hash');

        error_log(__LINE__  . ' ui tunnel [XHR RESPONSE OUTPUT] $tmp_request_serialization_key[' . $tmp_request_serialization_key . ']. $tmp_request_serialization_hash[' . $tmp_request_serialization_hash . '].');

        $tmp_client_id = $this->oCRNRSTN->return_form_submitted_value('crnrstn_session_client_id');
        $tmp_client_auth_key = $this->oCRNRSTN->return_form_submitted_value('crnrstn_session_client_auth_key');

        $tmp_CRNRSTN_UI_INTERACT = $this->return_interact_ui_ux_profile('xml');
        //error_log(__LINE__ . ' ui tunnel XML RETURN $tmp_CRNRSTN_UI_INTERACT=[' . $tmp_CRNRSTN_UI_INTERACT . '] [' . $this->oCRNRSTN->request_id . '].');

        //
        // GENERATE NEW PSEUDO SOAP DATA TUNNEL LAYER PACKET IF ANY PACKET DATA (I.E. CHECKSUMS) CHANGED AND
        // SEND ANY DATA HAVING DELTA TO CLIENT
        $tmp_ssdtl_ARRAY = $this->return_ssdtl_form_integrations_packet('array');
        //error_log(__LINE__ . ' ui tunnel SSDTL_FIP?->[' . print_r($tmp_ssdtl_ARRAY,  true) . '].');

        $tmp_SOAP_DATA_TUNNEL_PACKET = $tmp_ssdtl_ARRAY['SSDTL_FIP'];
        $tmp_SSDTL_TITLE_CONTENT = $tmp_ssdtl_ARRAY['TITLE_HTML'];
        $tmp_SSDTL_SOCIAL_CONTENT = $tmp_ssdtl_ARRAY['SOCIAL_HTML'];
        $tmp_SSDTL_COLORS_CONTENT = $tmp_ssdtl_ARRAY['COLORS_HTML'];

        if($tmp_CRNRSTN_UI_INTERACT == '0'){

            $tmp_CRNRSTN_UI_INTERACT = '';

        }

        if($tmp_SOAP_DATA_TUNNEL_PACKET == '0'){

            $tmp_SOAP_DATA_TUNNEL_PACKET = '';

        }

        if($tmp_SSDTL_TITLE_CONTENT == '0'){

            $tmp_SSDTL_TITLE_CONTENT = '';

        }

        if($tmp_SSDTL_SOCIAL_CONTENT == '0'){

            $tmp_SSDTL_SOCIAL_CONTENT = '';

        }

        if($tmp_SSDTL_COLORS_CONTENT == '0'){

            $tmp_SSDTL_COLORS_CONTENT = '';

        }

        $tmp_BASSDRIVE_LOG_ID = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'BASSDRIVE_LOG_ID');
        $tmp_STREAM_KEY = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STREAM_KEY');

        //
        // CAUTION :: $tmp_TITLE_DATA IS NEEDED FOR BUILDING SOME META CONTENT (SEE $tmp_show_title_ARRAY[IS_LIVE]),
        // BUT IT (AND A FEW OTHERS) DOES/DO NOT UPDATE WITH CACHE CHANGE, SO IT MAY BE INCORRECT FOR FIRST REQUEST
        // AFTER CHANGE IN THAT CONTENT...I.E. BASSDRIVE SHOW TRANSITIONS.
        $tmp_TITLE_DATA = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'TITLE');
        $tmp_title = '<title ttl="45"><![CDATA[' . $tmp_TITLE_DATA . ']]></title>';

        //$tmp_DATEMODIFIED = $this->oCRNRSTN->return_database_value('BASSDRIVE_LOG_DATA', 'DATEMODIFIED');
        $tmp_DATEMODIFIED = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'DATEMODIFIED');

        $tmp_show_title_ARRAY = $this->return_show_title_html($tmp_TITLE_DATA);
        $tmp_bassdrive_situation_ARRAY = $this->return_bassdrive_situation_ARRAY(3);

        //$this->data_aggregation_bassdrive_historical();

        $tmp_social_endpoint = $this->return_show_social_html($tmp_STREAM_KEY, $tmp_TITLE_DATA, 'true');

        $tmp_locale_city_state = '<locale_city_province ttl="45"><![CDATA[' . $this->oCRNRSTN->return_database_value('RELAY_LOCALE_DATA', 'LOCALE_COPY') . ']]></locale_city_province>';
        $tmp_locale_nation = '<locale_nation ttl="45" url="' . $this->oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP') . $this->oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/bassdrive_component_creative/' . $this->oCRNRSTN->return_database_value('RELAY_COLORS_DATA', 'COLORS_IMG_FILENAME') . '">' . $this->oCRNRSTN->return_database_value('RELAY_COLORS_DATA', 'STREAM_COLORS_KEY') . '</locale_nation>';

        $tmp_STREAM_RELAY_ARRAY = $this->return_stream_relay();
        $tmp_STREAM_RELAY_RECENT_ARRAY = $this->return_stream_relay_recent();
        $tmp_STREAM_RELAY_HISTORY_ARRAY = $this->return_stream_relay_historical();

        $tmp_jony5_lifestyle_images = $this->return_jony5_lifestyle_images();

        $tmp_status_report = $this->return_ssdtl_status_report();

        $tmp_rrs_map_report = $this->return_rrs_map_resource_acceleration_report();

        $tmp_xml_response_ARRAY = array();

        if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

            $tmp_xml_response_ARRAY[] = '<?xml version="1.0" encoding="iso-8859-1"?><crnrstn_client_response><client_response timestamp="' . $this->oCRNRSTN->return_micro_time() . '"><data_signature><request_serial><![CDATA[' . $tmp_request_serialization_key . ']]></request_serial><request_hash><![CDATA[' . $tmp_request_serialization_hash . ']]></request_hash><jesus_christ_is_lord source="Philippians 2:9-11">TRUE</jesus_christ_is_lord><satan_is_a_liar source="Genesis 3:4">TRUE</satan_is_a_liar></data_signature>';

        }else{

            $tmp_xml_response_ARRAY[] = '<?xml version="1.0" encoding="iso-8859-1"?>
<crnrstn_client_response>
    <client_response timestamp="' . $this->oCRNRSTN->return_micro_time() . '">
        <data_signature>
            <request_serial><![CDATA[' . $tmp_request_serialization_key . ']]></request_serial>
            <request_hash><![CDATA[' . $tmp_request_serialization_hash . ']]></request_hash>
            <jesus_christ_is_lord source="Philippians 2:9-11">TRUE</jesus_christ_is_lord>
            <satan_is_a_liar source="Genesis 3:4">TRUE</satan_is_a_liar>
        </data_signature>';

        }

        if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

            $tmp_xml_response_ARRAY[] = '<state_synchronization_data><serial_id><![CDATA[' . $tmp_serial_id . ']]></serial_id><serial>' . $tmp_serial . '</serial><request_id timestamp="' . $this->oCRNRSTN->return_micro_time() . '">' . $tmp_request_id . '</request_id><server_runtime>' . $this->oCRNRSTN->pretty_elapsed_time() . '</server_runtime><request_authorization_key>' . $this->oCRNRSTN->generate_new_key(64) . '</request_authorization_key><request_locale_identifier><![CDATA[' . $this->oCRNRSTN->return_client_header_value('Accept-Language') . ']]></request_locale_identifier><request_referer><![CDATA[' . $_SERVER['HTTP_REFERER'] . ']]></request_referer><client_id>' . $tmp_client_id . '</client_id><client_auth_key>' . $tmp_client_auth_key. '</client_auth_key><server_name>' . $_SERVER['SERVER_NAME'] . '</server_name><server_ip_address>' . $_SERVER['SERVER_ADDR'] . '</server_ip_address><client_ip_address>' . $this->oCRNRSTN->client_ip() . '</client_ip_address><response_status>' . $tmp_status_report . '</response_status><client_profile><global_privacy_control><sec_gpc>null</sec_gpc></global_privacy_control><device_type>' . $this->oCRNRSTN->device_type_bit() . '|' . $this->oCRNRSTN->device_type() . '</device_type><language>' . $this->ssdtl_response_http_language_preference('xml') . '</language></client_profile>';

        }else{

            $tmp_xml_response_ARRAY[] = '
        <state_synchronization_data>
            <serial_id><![CDATA[' . $tmp_serial_id . ']]></serial_id>
            <serial>' . $tmp_serial . '</serial>
            <request_id timestamp="' . $this->oCRNRSTN->return_micro_time() . '">' . $tmp_request_id . '</request_id>
            <server_runtime>' . $this->oCRNRSTN->pretty_elapsed_time() . '</server_runtime>
            <request_authorization_key>' . $this->oCRNRSTN->generate_new_key(64) . '</request_authorization_key>
            <request_locale_identifier><![CDATA[' . $this->oCRNRSTN->return_client_header_value('Accept-Language') . ']]></request_locale_identifier>
            <request_referer><![CDATA[' . $_SERVER['HTTP_REFERER'] . ']]></request_referer>
            <client_id>' . $tmp_client_id . '</client_id>
            <client_auth_key>' . $tmp_client_auth_key. '</client_auth_key>
            <server_name>' . $_SERVER['SERVER_NAME'] . '</server_name>
            <server_ip_address>' . $_SERVER['SERVER_ADDR'] . '</server_ip_address>
            <client_ip_address>' . $this->oCRNRSTN->client_ip() . '</client_ip_address>
            <response_status>
                ' . $tmp_status_report . '
            </response_status>
            <client_profile>
                <global_privacy_control>
                    <sec_gpc>null</sec_gpc>
                </global_privacy_control>
                <device_type>' . $this->oCRNRSTN->device_type_bit() . '|' . $this->oCRNRSTN->device_type() . '</device_type>
                <language>
                    ' . $this->ssdtl_response_http_language_preference('xml') . '
                </language>
            </client_profile>';

        }

        if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

            $tmp_xml_response_ARRAY[] = '<crnrstn_interact_ui_profile>' . $tmp_CRNRSTN_UI_INTERACT . '</crnrstn_interact_ui_profile>';

        }else{

            $tmp_xml_response_ARRAY[] = '
            <crnrstn_interact_ui_profile>' . $tmp_CRNRSTN_UI_INTERACT . '
            </crnrstn_interact_ui_profile>';

        }

        if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

            $tmp_xml_response_ARRAY[] = '<bassdrive><json_log_id url="' . $this->oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP') . $this->oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . '_proxy/bassdrive/?log_id=' . $tmp_BASSDRIVE_LOG_ID . '" timestamp="' . $tmp_DATEMODIFIED . '">' . $tmp_BASSDRIVE_LOG_ID . '</json_log_id><web_player_url>http://www.bassdrive.com/pop-up/</web_player_url><is_live ttl="45">' . $tmp_show_title_ARRAY['is_live'] . '</is_live><the_situation_with_bassdrive ttl="30"><likely_status><![CDATA[' . $tmp_bassdrive_situation_ARRAY[0] . ']]></likely_status><likely_status><![CDATA[' . $tmp_bassdrive_situation_ARRAY[1] . ']]></likely_status><likely_status><![CDATA[' . $tmp_bassdrive_situation_ARRAY[2] . ']]></likely_status></the_situation_with_bassdrive><stream_key>' . $tmp_STREAM_KEY . '</stream_key>' . $tmp_title . $tmp_locale_city_state . $tmp_locale_nation . '<title_html><![CDATA[' . $tmp_SSDTL_TITLE_CONTENT . ']]></title_html><locale_html><![CDATA[' . $tmp_SSDTL_COLORS_CONTENT . ']]></locale_html><social_html><![CDATA[' . $tmp_SSDTL_SOCIAL_CONTENT . ']]></social_html><stream_relays ttl="45">' . $tmp_STREAM_RELAY_ARRAY['RELAY'] . '</stream_relays><social_media_connects ttl="45">' . $tmp_social_endpoint . '</social_media_connects><performance ttl="45">' . $tmp_STREAM_RELAY_ARRAY['RELAY_CURRENT_STATS'] . $tmp_STREAM_RELAY_RECENT_ARRAY['RELAY_RECENT_STATS'] . $tmp_STREAM_RELAY_HISTORY_ARRAY['RELAY_HISTORICAL_STATS'] . '</performance></bassdrive>';

        }else{

            $tmp_xml_response_ARRAY[] = '
            <bassdrive>
                <json_log_id url="' . $this->oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP') . $this->oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . '_proxy/bassdrive/?log_id=' . $tmp_BASSDRIVE_LOG_ID . '" timestamp="' . $tmp_DATEMODIFIED . '">' . $tmp_BASSDRIVE_LOG_ID . '</json_log_id>
                <web_player_url>http://www.bassdrive.com/pop-up/</web_player_url>
                <is_live ttl="45">' . $tmp_show_title_ARRAY['is_live'] . '</is_live>
                <the_situation_with_bassdrive ttl="30">
                    <likely_status><![CDATA[' . $tmp_bassdrive_situation_ARRAY[0] . ']]></likely_status>
                    <likely_status><![CDATA[' . $tmp_bassdrive_situation_ARRAY[1] . ']]></likely_status>
                    <likely_status><![CDATA[' . $tmp_bassdrive_situation_ARRAY[2] . ']]></likely_status>
                </the_situation_with_bassdrive>
                <stream_key>' . $tmp_STREAM_KEY . '</stream_key>
                ' . $tmp_title . '
                ' . $tmp_locale_city_state . '
                ' . $tmp_locale_nation . '
                <title_html>
                    <![CDATA[' . $tmp_SSDTL_TITLE_CONTENT . ']]>
                </title_html>
                <locale_html>
                    <![CDATA[' . $tmp_SSDTL_COLORS_CONTENT . ']]>
                </locale_html>
                <social_html>
                    <![CDATA[' . $tmp_SSDTL_SOCIAL_CONTENT . ']]>
                </social_html>
                <stream_relays ttl="45">
                    ' . $tmp_STREAM_RELAY_ARRAY['RELAY'] . '
                </stream_relays>
                <social_media_connects ttl="45">
                    ' . $tmp_social_endpoint . '
                </social_media_connects>
                <performance ttl="45">
                    ' . $tmp_STREAM_RELAY_ARRAY['RELAY_CURRENT_STATS'] . '
                    ' . $tmp_STREAM_RELAY_RECENT_ARRAY['RELAY_RECENT_STATS'] . '
                    ' . $tmp_STREAM_RELAY_HISTORY_ARRAY['RELAY_HISTORICAL_STATS'] . '
                </performance>
            </bassdrive>';

        }

        if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

            $tmp_xml_response_ARRAY[] = $tmp_jony5_lifestyle_images . '</state_synchronization_data><soap_services_data_tunnel_layer_packet><![CDATA[' . $tmp_SOAP_DATA_TUNNEL_PACKET . ']]></soap_services_data_tunnel_layer_packet><runtime>' . $this->oCRNRSTN->wall_time() . ' seconds</runtime></client_response></crnrstn_client_response>';

        }else{

            $tmp_xml_response_ARRAY[] = '
            ' . $tmp_jony5_lifestyle_images . '
        </state_synchronization_data>
        ' . $tmp_rrs_map_report . '<soap_services_data_tunnel_layer_packet><![CDATA[
        ' . $tmp_SOAP_DATA_TUNNEL_PACKET . '
        ]]></soap_services_data_tunnel_layer_packet>
        <runtime>' . $this->oCRNRSTN->wall_time() . ' seconds</runtime>
    </client_response>
</crnrstn_client_response>';

        }

        $tmp_xml_response = '';
        foreach($tmp_xml_response_ARRAY as $index => $str_data){

            $tmp_xml_response .= $str_data;

        }

        $tmp_date_expire = date('D, M j Y G:i:s T');
        //$tmp_date_lastmod = date('D, M j Y G:i:s T', strtotime('- 420 seconds'));
        $tmp_date_lastmod = date('D, M j Y G:i:s T');

        $tmp_array = array();
        $tmp_array[] = 'Content-Type: application/xml; charset=UTF-8';
        $tmp_array[] = 'Expires: ' . $tmp_date_expire;
        $tmp_array[] = 'Last-Modified: ' . $tmp_date_lastmod;

        $this->oCRNRSTN->header_options_add($tmp_array);
        $this->oCRNRSTN->header_options_apply();

        return $tmp_xml_response;

    }

    public function log_stream_social_clickthrough_reporting($url, $social_media_key, $social_id, $stream_key){

        //
        // GET CLICKTHROUGH REPORTING SHARD ID
        $tmp_query = 'SELECT `crnrstn_stream_relay_meta_lookup`.`META_LOOKUP_ID`,
            `crnrstn_stream_relay_meta_lookup`.`STREAM_KEY`,
            `crnrstn_stream_relay_meta_lookup`.`RELAY_REPORTING_SHARD_ID`,
            `crnrstn_stream_relay_meta_lookup`.`LOCALE_ID`,
            `crnrstn_stream_relay_meta_lookup`.`ABOUT_ID`,
            `crnrstn_stream_relay_meta_lookup`.`COLORS_ID`,
            `crnrstn_stream_relay_meta_lookup`.`STREAM_COLORS_KEY`,
            `crnrstn_stream_relay_meta_lookup`.`DATEMODIFIED`
        FROM `crnrstn_stream_relay_meta_lookup`
        WHERE `crnrstn_stream_relay_meta_lookup`.`STREAM_KEY` = "' . $this->mysqli->real_escape_string($stream_key) . '"
        AND `crnrstn_stream_relay_meta_lookup`.`STREAM_KEY_CRC32` = ' . $this->oCRNRSTN->crcINT($stream_key) . ' LIMIT 1;';
        $tmp_result_set_key = $this->oCRNRSTN->load_query_profile('BASSDRIVE_REPORTING', '!jesus_is_my_dear_lord!', 'RELAY_META_LOOKUP_DATA', __LINE__, __METHOD__);
        $this->oCRNRSTN->add_database_query($tmp_result_set_key, $tmp_query);

        $tmp_query = 'SELECT `crnrstn_stream_relay_social`.`SOCIAL_ID`,
            `crnrstn_stream_relay_social`.`STREAM_KEY`,
            `crnrstn_stream_relay_social`.`SOCIAL_MEDIA_KEY`,
            `crnrstn_stream_relay_social`.`CLICKTHROUGH_URL`,
            `crnrstn_stream_relay_social`.`CLICKTHROUGH_COUNT`,
            `crnrstn_stream_relay_social`.`DATEMODIFIED`
        FROM `crnrstn_stream_relay_social`
        WHERE `crnrstn_stream_relay_social`.`SOCIAL_ID` = "' . $this->mysqli->real_escape_string($social_id) . '"
        AND `crnrstn_stream_relay_social`.`SOCIAL_ID_CRC32` = ' . $this->oCRNRSTN->crcINT($social_id) . '
        AND `crnrstn_stream_relay_social`.`STREAM_KEY` = "' . $this->mysqli->real_escape_string($stream_key) . '"
        AND `crnrstn_stream_relay_social`.`STREAM_KEY_CRC32` = ' . $this->oCRNRSTN->crcINT($stream_key) . '
        AND `crnrstn_stream_relay_social`.`ISACTIVE` = 1 LIMIT 1;';
        $tmp_result_set_key = $this->oCRNRSTN->load_query_profile('BASSDRIVE_REPORTING', '!jesus_is_my_dear_lord!', 'REPORTING_RELAY_SOCIAL_DATA', __LINE__, __METHOD__);
        $this->oCRNRSTN->add_database_query($tmp_result_set_key, $tmp_query);

        $tmp_query = 'SELECT
            `crnrstn_stream_relay`.`IS_REPLAY`
        FROM `crnrstn_stream_relay` LIMIT 1;';
        $tmp_result_set_key = $this->oCRNRSTN->load_query_profile('BASSDRIVE_REPORTING', '!jesus_is_my_dear_lord!', 'RELAY_ACTIVE_META', __LINE__, __METHOD__);
        $this->oCRNRSTN->add_database_query($tmp_result_set_key, $tmp_query);

        //
        // PROCESS ALL QUERY TO CONNECTION(S)
        $this->oCRNRSTN->process_query();

        $tmp_IS_REPLAY = $this->oCRNRSTN->return_database_value('RELAY_ACTIVE_META', 'IS_REPLAY');

        $tmp_RELAY_SOCIAL_DATA_count = $this->oCRNRSTN->return_record_count('REPORTING_RELAY_SOCIAL_DATA');

        if($tmp_RELAY_SOCIAL_DATA_count > 0){

            $tmp_click_count = $this->oCRNRSTN->return_database_value('REPORTING_RELAY_SOCIAL_DATA', 'CLICKTHROUGH_COUNT');
            $tmp_click_count = ($tmp_click_count * 1) + 1;

            $ts = $this->oCRNRSTN->return_query_date_time_stamp();
            $tmp_query = 'UPDATE `crnrstn_stream_relay_social`
            SET
            `CLICKTHROUGH_COUNT` = ' . $tmp_click_count . ',
            `DATEMODIFIED` = "' . $ts . '"
            WHERE `crnrstn_stream_relay_social`.`SOCIAL_ID` = "' . $this->mysqli->real_escape_string($social_id) . '"
            AND `crnrstn_stream_relay_social`.`SOCIAL_ID_CRC32` = ' . $this->oCRNRSTN->crcINT($social_id) . '
            AND `crnrstn_stream_relay_social`.`STREAM_KEY` = "' . $this->mysqli->real_escape_string($stream_key) . '"
            AND `crnrstn_stream_relay_social`.`STREAM_KEY_CRC32` = ' . $this->oCRNRSTN->crcINT($stream_key) . '
            AND `crnrstn_stream_relay_social`.`ISACTIVE` = 1 LIMIT 1;';
            $tmp_result_set_key = $this->oCRNRSTN->load_query_profile('BASSDRIVE_REPORTING', '!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
            $this->oCRNRSTN->add_database_query($tmp_result_set_key, $tmp_query);

        }

        $tmp_RELAY_REPORTING_SHARD_ID = $this->oCRNRSTN->return_database_value('RELAY_META_LOOKUP_DATA', 'RELAY_REPORTING_SHARD_ID');

        $tmp_query = 'SELECT `crnrstn_stream_relay_reporting_shards`.`RELAY_REPORTING_SHARD_ID`,
            `crnrstn_stream_relay_reporting_shards`.`TABLE_STRING_PATTERN`,
            `crnrstn_stream_relay_reporting_shards`.`ISACTIVE`,
            `crnrstn_stream_relay_reporting_shards`.`MAXIMUM_STREAM_COUNT`,
            `crnrstn_stream_relay_reporting_shards`.`DATEMODIFIED`,
            `crnrstn_stream_relay_reporting_shards`.`DATECREATED`
        FROM `crnrstn_stream_relay_reporting_shards`
        WHERE `crnrstn_stream_relay_reporting_shards`.`RELAY_REPORTING_SHARD_ID` = "' . $tmp_RELAY_REPORTING_SHARD_ID . '"
        AND `crnrstn_stream_relay_reporting_shards`.`RELAY_REPORTING_SHARD_ID_CRC32`= ' . $this->oCRNRSTN->crcINT($tmp_RELAY_REPORTING_SHARD_ID) . ' LIMIT 1;';
        $tmp_result_set_key = $this->oCRNRSTN->load_query_profile('BASSDRIVE_REPORTING', '!jesus_is_my_dear_lord!', 'SHARD_PATTERN_DATA', __LINE__, __METHOD__);
        $this->oCRNRSTN->add_database_query($tmp_result_set_key, $tmp_query);

        //
        // PROCESS ALL QUERY TO CONNECTION(S)
        $this->oCRNRSTN->process_query();

        $tmp_REPORTING_LOG_ID = $this->oCRNRSTN->generate_new_key(100);
        $tmp_TABLE_STRING_PATTERN = $this->oCRNRSTN->return_database_value('SHARD_PATTERN_DATA', 'TABLE_STRING_PATTERN');

        $ts = $this->oCRNRSTN->return_query_date_time_stamp();
        $tmp_query = 'INSERT INTO `crnrstn_stream_social_click_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`
        (`REPORTING_LOG_ID`,
        `STREAM_KEY`,
        `STREAM_KEY_CRC32`,
        `IS_REPLAY`,
        `SOCIAL_MEDIA_KEY`,
        `SOCIAL_MEDIA_KEY_CRC32`,
        `CLICKTHROUGH_URL`,
        `CLICKTHROUGH_IP`,
        `CLICKTHROUGH_SERVER_ADDR`,
        `CLICKTHROUGH_PHPSESSION_ID`,
        `CLICKTHROUGH_HTTP_REFERER`,
        `CLICKTHROUGH_HTTP_USER_AGENT`,
        `CLICKTHROUGH_DEVICE_TYPE`,
        `CLICKTHROUGH_LANG_PREFS`,
        `DATEMODIFIED`)
        VALUES
        ("' . $tmp_REPORTING_LOG_ID . '",
        "' . $this->mysqli->real_escape_string($stream_key) . '",
        ' . $this->oCRNRSTN->crcINT($stream_key) . ',
        ' . $tmp_IS_REPLAY . ',
        "' . $this->mysqli->real_escape_string($social_media_key) . '",
        ' . $this->oCRNRSTN->crcINT($social_media_key) . ',
        "' . $this->mysqli->real_escape_string($url) . '",
        INET_ATON("' . $this->oCRNRSTN->client_ip() . '"),
        INET_ATON("' . $_SERVER['SERVER_ADDR'] . '"),
        "' . session_id() . '",
        "' . $_SERVER['HTTP_REFERER'] . '",
        "' . $_SERVER['HTTP_USER_AGENT'] . '",
        "' . $this->oCRNRSTN->device_type . '",
        "' . $this->oCRNRSTN->return_client_header_value('Accept-Language') . '",
        "' . $ts . '");';
        $tmp_result_set_key = $this->oCRNRSTN->load_query_profile('BASSDRIVE_REPORTING', '!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
        $this->oCRNRSTN->add_database_query($tmp_result_set_key, $tmp_query);

        $ts = $this->oCRNRSTN->return_query_date_time_stamp();
        $tmp_query = 'INSERT INTO `crnrstn_global_click_reporting_log`
        (`REPORTING_LOG_ID`,
        `STREAM_KEY`,
        `STREAM_KEY_CRC32`,
        `IS_REPLAY`,
        `SOCIAL_MEDIA_KEY`,
        `SOCIAL_MEDIA_KEY_CRC32`,
        `CLICKTHROUGH_URL`,
        `CLICKTHROUGH_IP`,
        `CLICKTHROUGH_SERVER_ADDR`,
        `CLICKTHROUGH_PHPSESSION_ID`,
        `CLICKTHROUGH_HTTP_REFERER`,
        `CLICKTHROUGH_HTTP_USER_AGENT`,
        `CLICKTHROUGH_DEVICE_TYPE`,
        `CLICKTHROUGH_LANG_PREFS`,
        `DATEMODIFIED`)
        VALUES
        ("' . $tmp_REPORTING_LOG_ID . '",
        "' . $this->mysqli->real_escape_string($stream_key) . '",
        ' . $this->oCRNRSTN->crcINT($stream_key) . ',
        ' . $tmp_IS_REPLAY . ',
        "' . $this->mysqli->real_escape_string($social_media_key) . '",
        ' . $this->oCRNRSTN->crcINT($social_media_key) . ',
        "' . $this->mysqli->real_escape_string($url) . '",
        INET_ATON("' . $this->oCRNRSTN->client_ip() . '"),
        INET_ATON("' . $_SERVER['SERVER_ADDR'] . '"),
        "' . session_id() . '",
        "' . $_SERVER['HTTP_REFERER'] . '",
        "' . $_SERVER['HTTP_USER_AGENT'] . '",
        "' . $this->oCRNRSTN->device_type . '",
        "' . $this->oCRNRSTN->return_client_header_value('Accept-Language') . '",
        "' . $ts . '");';
        $tmp_result_set_key = $this->oCRNRSTN->load_query_profile('BASSDRIVE_REPORTING', '!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
        $this->oCRNRSTN->add_database_query($tmp_result_set_key, $tmp_query);

        //
        // PROCESS ALL QUERY TO CONNECTION(S)
        $this->oCRNRSTN->process_query();

        //error_log(__LINE__ . ' ui tunnel click reporting log to [`crnrstn_stream_social_click_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`]');

    }

    private function return_jony5_lifestyle_images(){

        if($this->oCRNRSTN->isset_query_result_set_key('LIFESTYLE_IMAGES_DATA')){

            $tmp_output_images_data = '';
            $tmp_LIFESTYLE_IMAGES_DATA_cnt = $this->oCRNRSTN->return_record_count('LIFESTYLE_IMAGES_DATA');

            $tmp_LIFESTYLE_IMAGES_DATA_cnt--;
            for ($i = 0; $i < self::$lifestyle_image_return_cnt; $i++){

                $image_index = rand(0, $tmp_LIFESTYLE_IMAGES_DATA_cnt);

                $tmp_IMAGE_FILENAME = $this->oCRNRSTN->return_database_value('LIFESTYLE_IMAGES_DATA', 'IMAGE_FILENAME_DESKTOP', $image_index);
                $tmp_IMAGE_MD5_DESKTOP = $this->oCRNRSTN->return_database_value('LIFESTYLE_IMAGES_DATA', 'IMAGE_MD5_DESKTOP', $image_index);
                $tmp_IMAGE_SHA1_DESKTOP = $this->oCRNRSTN->return_database_value('LIFESTYLE_IMAGES_DATA', 'IMAGE_SHA1_DESKTOP', $image_index);
                $tmp_IMAGE_FILESIZE_DESKTOP_BYTES = $this->oCRNRSTN->return_database_value('LIFESTYLE_IMAGES_DATA', 'IMAGE_FILESIZE_DESKTOP', $image_index);

                $tmp_IMAGE_FILESIZE_DESKTOP = $this->oCRNRSTN->format_bytes($tmp_IMAGE_FILESIZE_DESKTOP_BYTES, 4);

                $tmp_output_images_data .= '
                <banner_img uri="' . $this->oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP') . $this->oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/lifestyle_banner/desktop/' . $tmp_IMAGE_FILENAME . '?v=420.0.' . $tmp_IMAGE_FILESIZE_DESKTOP_BYTES . '" full_scrn_uri="">
                    <filesize md5="' . $tmp_IMAGE_MD5_DESKTOP . '" sha1="' . $tmp_IMAGE_SHA1_DESKTOP . '">' . $tmp_IMAGE_FILESIZE_DESKTOP . '</filesize>
                </banner_img>';

            }

            return '<lifestyle_banner ttl="7" count="' . self::$lifestyle_image_return_cnt . '">' . $tmp_output_images_data . '
            </lifestyle_banner>';

        }

    }

    private function return_stream_relay_recent(){

        //
        // SNAPSHOT OF REPORTING STATS FROM PREVIOUS SHOW AIRING AT
        // ABOUT THE SAME POINT IN TIME, RELATIVELY SPEAKING, AS THE CURRENT.
        $tmp_output_relay_recent_stats = '';
        $tmp_RELAY_RECENT_DATA = $this->oCRNRSTN->return_record_count('RELAY_RECENT_DATA');

        if($tmp_RELAY_RECENT_DATA > 0){

            for($i = 0; $i < $tmp_RELAY_RECENT_DATA; $i++){

                $tmp_RELAY_TIMESTAMP = $this->oCRNRSTN->return_database_value('RELAY_RECENT_DATA', 'RELAY_TIMESTAMP', $i);
                $tmp_BASSDRIVE_LOG_ID = $this->oCRNRSTN->return_database_value('RELAY_RECENT_DATA', 'BASSDRIVE_LOG_ID', $i);

                $tmp_STATS_TOTAL = array();
                $tmp_STATS_TOTAL_UNIQUE = array();
                $tmp_STATS_PREMIUM = array();
                $tmp_STATS_MIDGRADE = array();
                $tmp_STATS_AACPLUS = array();
                $tmp_STATS_RANDOM = array();

                $tmp_STATS_TOTAL['STATS_TOTAL_CONNECTIONS'] = $this->oCRNRSTN->return_database_value('RELAY_RECENT_DATA', 'STATS_TOTAL_CONNECTIONS', $i);
                $tmp_STATS_TOTAL['STATS_TOTAL_CAPACITY'] = $this->oCRNRSTN->return_database_value('RELAY_RECENT_DATA', 'STATS_TOTAL_CAPACITY', $i);
                $tmp_STATS_TOTAL['STATS_TOTAL_BANDWIDTH'] = $this->oCRNRSTN->return_database_value('RELAY_RECENT_DATA', 'STATS_TOTAL_BANDWIDTH', $i);
                $tmp_STATS_TOTAL['STATS_TOTAL_BANDWIDTH_FORMAT'] = $this->oCRNRSTN->return_database_value('RELAY_RECENT_DATA', 'STATS_TOTAL_BANDWIDTH_FORMAT', $i);

                $tmp_STATS_TOTAL_UNIQUE['STATS_TOTAL_UNIQUE_CONNECTIONS'] = $this->oCRNRSTN->return_database_value('RELAY_RECENT_DATA', 'STATS_TOTAL_UNIQUE_CONNECTIONS', $i);
                $tmp_STATS_TOTAL_UNIQUE['STATS_TOTAL_UNIQUE_CAPACITY'] = $this->oCRNRSTN->return_database_value('RELAY_RECENT_DATA', 'STATS_TOTAL_UNIQUE_CAPACITY', $i);
                $tmp_STATS_TOTAL_UNIQUE['STATS_TOTAL_UNIQUE_BANDWIDTH'] = $this->oCRNRSTN->return_database_value('RELAY_RECENT_DATA', 'STATS_TOTAL_UNIQUE_BANDWIDTH', $i);
                $tmp_STATS_TOTAL_UNIQUE['STATS_TOTAL_UNIQUE_BANDWIDTH_FORMAT'] = $this->oCRNRSTN->return_database_value('RELAY_RECENT_DATA', 'STATS_TOTAL_UNIQUE_BANDWIDTH_FORMAT', $i);

                $tmp_STATS_PREMIUM['STATS_PREMIUM_BITRATE'] = $this->oCRNRSTN->return_database_value('RELAY_RECENT_DATA', 'STATS_PREMIUM_BITRATE', $i);
                $tmp_STATS_PREMIUM['STATS_PREMIUM_BITRATE_FORMAT'] = $this->oCRNRSTN->return_database_value('RELAY_RECENT_DATA', 'STATS_PREMIUM_BITRATE_FORMAT', $i);
                $tmp_STATS_PREMIUM['STATS_PREMIUM_CONNECTIONS'] = $this->oCRNRSTN->return_database_value('RELAY_RECENT_DATA', 'STATS_PREMIUM_CONNECTIONS', $i);
                $tmp_STATS_PREMIUM['STATS_PREMIUM_CAPACITY'] = $this->oCRNRSTN->return_database_value('RELAY_RECENT_DATA', 'STATS_PREMIUM_CAPACITY', $i);
                $tmp_STATS_PREMIUM['STATS_PREMIUM_BANDWIDTH'] = $this->oCRNRSTN->return_database_value('RELAY_RECENT_DATA', 'STATS_PREMIUM_BANDWIDTH', $i);
                $tmp_STATS_PREMIUM['STATS_PREMIUM_BANDWIDTH_FORMAT'] = $this->oCRNRSTN->return_database_value('RELAY_RECENT_DATA', 'STATS_PREMIUM_BANDWIDTH_FORMAT', $i);

                $tmp_STATS_MIDGRADE['STATS_MIDGRADE_BITRATE'] = $this->oCRNRSTN->return_database_value('RELAY_RECENT_DATA', 'STATS_MIDGRADE_BITRATE', $i);
                $tmp_STATS_MIDGRADE['STATS_MIDGRADE_BITRATE_FORMAT'] = $this->oCRNRSTN->return_database_value('RELAY_RECENT_DATA', 'STATS_MIDGRADE_BITRATE_FORMAT', $i);
                $tmp_STATS_MIDGRADE['STATS_MIDGRADE_CONNECTIONS'] = $this->oCRNRSTN->return_database_value('RELAY_RECENT_DATA', 'STATS_MIDGRADE_CONNECTIONS', $i);
                $tmp_STATS_MIDGRADE['STATS_MIDGRADE_CAPACITY'] = $this->oCRNRSTN->return_database_value('RELAY_RECENT_DATA', 'STATS_MIDGRADE_CAPACITY', $i);
                $tmp_STATS_MIDGRADE['STATS_MIDGRADE_BANDWIDTH'] = $this->oCRNRSTN->return_database_value('RELAY_RECENT_DATA', 'STATS_MIDGRADE_BANDWIDTH', $i);
                $tmp_STATS_MIDGRADE['STATS_MIDGRADE_BANDWIDTH_FORMAT'] = $this->oCRNRSTN->return_database_value('RELAY_RECENT_DATA', 'STATS_MIDGRADE_BANDWIDTH_FORMAT', $i);

                $tmp_STATS_AACPLUS['STATS_AAC_PLUS_BITRATE'] = $this->oCRNRSTN->return_database_value('RELAY_RECENT_DATA', 'STATS_AAC_PLUS_BITRATE', $i);
                $tmp_STATS_AACPLUS['STATS_AAC_PLUS_BITRATE_FORMAT'] = $this->oCRNRSTN->return_database_value('RELAY_RECENT_DATA', 'STATS_AAC_PLUS_BITRATE_FORMAT', $i);
                $tmp_STATS_AACPLUS['STATS_AAC_PLUS_CONNECTIONS'] = $this->oCRNRSTN->return_database_value('RELAY_RECENT_DATA', 'STATS_AAC_PLUS_CONNECTIONS', $i);
                $tmp_STATS_AACPLUS['STATS_AAC_PLUS_CAPACITY'] = $this->oCRNRSTN->return_database_value('RELAY_RECENT_DATA', 'STATS_AAC_PLUS_CAPACITY', $i);
                $tmp_STATS_AACPLUS['STATS_AAC_PLUS_BANDWIDTH'] = $this->oCRNRSTN->return_database_value('RELAY_RECENT_DATA', 'STATS_AAC_PLUS_BANDWIDTH', $i);
                $tmp_STATS_AACPLUS['STATS_AAC_PLUS_BANDWIDTH_FORMAT'] = $this->oCRNRSTN->return_database_value('RELAY_RECENT_DATA', 'STATS_AAC_PLUS_BANDWIDTH_FORMAT', $i);

                $tmp_STATS_RANDOM['STATS_RANDOM_BITRATE'] = $this->oCRNRSTN->return_database_value('RELAY_RECENT_DATA', 'STATS_RANDOM_BITRATE', $i);
                $tmp_STATS_RANDOM['STATS_RANDOM_BITRATE_FORMAT'] = $this->oCRNRSTN->return_database_value('RELAY_RECENT_DATA', 'STATS_RANDOM_BITRATE_FORMAT', $i);
                $tmp_STATS_RANDOM['STATS_RANDOM_CONNECTIONS'] = $this->oCRNRSTN->return_database_value('RELAY_RECENT_DATA', 'STATS_RANDOM_CONNECTIONS', $i);
                $tmp_STATS_RANDOM['STATS_RANDOM_CAPACITY'] = $this->oCRNRSTN->return_database_value('RELAY_RECENT_DATA', 'STATS_RANDOM_CAPACITY', $i);
                $tmp_STATS_RANDOM['STATS_RANDOM_BANDWIDTH'] = $this->oCRNRSTN->return_database_value('RELAY_RECENT_DATA', 'STATS_RANDOM_BANDWIDTH', $i);
                $tmp_STATS_RANDOM['STATS_RANDOM_BANDWIDTH_FORMAT'] = $this->oCRNRSTN->return_database_value('RELAY_RECENT_DATA', 'STATS_RANDOM_BANDWIDTH_FORMAT', $i);

                if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

                    $tmp_output_relay_recent_stats .= '<connection_stat timestamp="' . $tmp_RELAY_TIMESTAMP . '" json_log_id="' . $tmp_BASSDRIVE_LOG_ID . '"><stream_stat type="total"><connections capacity="' . $tmp_STATS_TOTAL['STATS_TOTAL_CAPACITY'] . '">' . $tmp_STATS_TOTAL['STATS_TOTAL_CONNECTIONS'] . '</connections><bandwidth format="' . $tmp_STATS_TOTAL['STATS_TOTAL_BANDWIDTH_FORMAT'] . '">' . $tmp_STATS_TOTAL['STATS_TOTAL_BANDWIDTH'] . '</bandwidth></stream_stat><stream_stat type="totalunique"><connections capacity="' . $tmp_STATS_TOTAL_UNIQUE['STATS_TOTAL_UNIQUE_CAPACITY'] . '">' . $tmp_STATS_TOTAL_UNIQUE['STATS_TOTAL_UNIQUE_CONNECTIONS'] . '</connections><bandwidth format="' . $tmp_STATS_TOTAL_UNIQUE['STATS_TOTAL_UNIQUE_BANDWIDTH_FORMAT'] . '">' . $tmp_STATS_TOTAL_UNIQUE['STATS_TOTAL_UNIQUE_BANDWIDTH'] . '</bandwidth></stream_stat><stream_stat type="premium"><connections capacity="' . $tmp_STATS_PREMIUM['STATS_PREMIUM_CAPACITY'] . '">' . $tmp_STATS_PREMIUM['STATS_PREMIUM_CONNECTIONS'] . '</connections><bandwidth format="' . $tmp_STATS_PREMIUM['STATS_PREMIUM_BANDWIDTH_FORMAT'] . '">' . $tmp_STATS_PREMIUM['STATS_PREMIUM_BANDWIDTH'] . '</bandwidth><bitrate format="' . $tmp_STATS_PREMIUM['STATS_PREMIUM_BITRATE_FORMAT'] . '">' . $tmp_STATS_PREMIUM['STATS_PREMIUM_BITRATE'] . '</bitrate></stream_stat><stream_stat type="midgrade"><connections capacity="' . $tmp_STATS_MIDGRADE['STATS_MIDGRADE_CAPACITY'] . '">' . $tmp_STATS_MIDGRADE['STATS_MIDGRADE_CONNECTIONS'] . '</connections><bandwidth format="' . $tmp_STATS_MIDGRADE['STATS_MIDGRADE_BANDWIDTH_FORMAT'] . '">' . $tmp_STATS_MIDGRADE['STATS_MIDGRADE_BANDWIDTH'] . '</bandwidth><bitrate format="' . $tmp_STATS_MIDGRADE['STATS_MIDGRADE_BITRATE_FORMAT'] . '">' . $tmp_STATS_MIDGRADE['STATS_MIDGRADE_BITRATE'] . '</bitrate></stream_stat><stream_stat type="aacplus"><connections capacity="' . $tmp_STATS_AACPLUS['STATS_AAC_PLUS_CAPACITY'] . '">' . $tmp_STATS_AACPLUS['STATS_AAC_PLUS_CONNECTIONS'] . '</connections><bandwidth format="' . $tmp_STATS_AACPLUS['STATS_AAC_PLUS_BANDWIDTH_FORMAT'] . '">' . $tmp_STATS_AACPLUS['STATS_AAC_PLUS_BANDWIDTH'] . '</bandwidth><bitrate format="' . $tmp_STATS_AACPLUS['STATS_AAC_PLUS_BITRATE_FORMAT'] . '">' . $tmp_STATS_AACPLUS['STATS_AAC_PLUS_BITRATE'] . '</bitrate></stream_stat><stream_stat type="random"><connections capacity="' . $tmp_STATS_RANDOM['STATS_RANDOM_CAPACITY'] . '">' . $tmp_STATS_RANDOM['STATS_RANDOM_CONNECTIONS'] . '</connections><bandwidth format="' . $tmp_STATS_RANDOM['STATS_RANDOM_BANDWIDTH_FORMAT'] . '">' . $tmp_STATS_RANDOM['STATS_RANDOM_BANDWIDTH'] . '</bandwidth><bitrate format="' . $tmp_STATS_RANDOM['STATS_RANDOM_BITRATE_FORMAT'] . '">' . $tmp_STATS_RANDOM['STATS_RANDOM_BITRATE'] . '</bitrate></stream_stat></connection_stat>';

                }else{

                    $tmp_output_relay_recent_stats .= '
                <connection_stat timestamp="' . $tmp_RELAY_TIMESTAMP . '" json_log_id="' . $tmp_BASSDRIVE_LOG_ID . '">
                    <stream_stat type="total">
                        <connections capacity="' . $tmp_STATS_TOTAL['STATS_TOTAL_CAPACITY'] . '">' . $tmp_STATS_TOTAL['STATS_TOTAL_CONNECTIONS'] . '</connections>
                        <bandwidth format="' . $tmp_STATS_TOTAL['STATS_TOTAL_BANDWIDTH_FORMAT'] . '">' . $tmp_STATS_TOTAL['STATS_TOTAL_BANDWIDTH'] . '</bandwidth>
                    </stream_stat>
                    <stream_stat type="totalunique">
                        <connections capacity="' . $tmp_STATS_TOTAL_UNIQUE['STATS_TOTAL_UNIQUE_CAPACITY'] . '">' . $tmp_STATS_TOTAL_UNIQUE['STATS_TOTAL_UNIQUE_CONNECTIONS'] . '</connections>
                        <bandwidth format="' . $tmp_STATS_TOTAL_UNIQUE['STATS_TOTAL_UNIQUE_BANDWIDTH_FORMAT'] . '">' . $tmp_STATS_TOTAL_UNIQUE['STATS_TOTAL_UNIQUE_BANDWIDTH'] . '</bandwidth>
                    </stream_stat>
                    <stream_stat type="premium">
                        <connections capacity="' . $tmp_STATS_PREMIUM['STATS_PREMIUM_CAPACITY'] . '">' . $tmp_STATS_PREMIUM['STATS_PREMIUM_CONNECTIONS'] . '</connections>
                        <bandwidth format="' . $tmp_STATS_PREMIUM['STATS_PREMIUM_BANDWIDTH_FORMAT'] . '">' . $tmp_STATS_PREMIUM['STATS_PREMIUM_BANDWIDTH'] . '</bandwidth>
                        <bitrate format="' . $tmp_STATS_PREMIUM['STATS_PREMIUM_BITRATE_FORMAT'] . '">' . $tmp_STATS_PREMIUM['STATS_PREMIUM_BITRATE'] . '</bitrate>
                    </stream_stat>
                    <stream_stat type="midgrade">
                        <connections capacity="' . $tmp_STATS_MIDGRADE['STATS_MIDGRADE_CAPACITY'] . '">' . $tmp_STATS_MIDGRADE['STATS_MIDGRADE_CONNECTIONS'] . '</connections>
                        <bandwidth format="' . $tmp_STATS_MIDGRADE['STATS_MIDGRADE_BANDWIDTH_FORMAT'] . '">' . $tmp_STATS_MIDGRADE['STATS_MIDGRADE_BANDWIDTH'] . '</bandwidth>
                        <bitrate format="' . $tmp_STATS_MIDGRADE['STATS_MIDGRADE_BITRATE_FORMAT'] . '">' . $tmp_STATS_MIDGRADE['STATS_MIDGRADE_BITRATE'] . '</bitrate>
                    </stream_stat>
                    <stream_stat type="aacplus">
                        <connections capacity="' . $tmp_STATS_AACPLUS['STATS_AAC_PLUS_CAPACITY'] . '">' . $tmp_STATS_AACPLUS['STATS_AAC_PLUS_CONNECTIONS'] . '</connections>
                        <bandwidth format="' . $tmp_STATS_AACPLUS['STATS_AAC_PLUS_BANDWIDTH_FORMAT'] . '">' . $tmp_STATS_AACPLUS['STATS_AAC_PLUS_BANDWIDTH'] . '</bandwidth>
                        <bitrate format="' . $tmp_STATS_AACPLUS['STATS_AAC_PLUS_BITRATE_FORMAT'] . '">' . $tmp_STATS_AACPLUS['STATS_AAC_PLUS_BITRATE'] . '</bitrate>
                    </stream_stat>
                    <stream_stat type="random">
                        <connections capacity="' . $tmp_STATS_RANDOM['STATS_RANDOM_CAPACITY'] . '">' . $tmp_STATS_RANDOM['STATS_RANDOM_CONNECTIONS'] . '</connections>
                        <bandwidth format="' . $tmp_STATS_RANDOM['STATS_RANDOM_BANDWIDTH_FORMAT'] . '">' . $tmp_STATS_RANDOM['STATS_RANDOM_BANDWIDTH'] . '</bandwidth>
                        <bitrate format="' . $tmp_STATS_RANDOM['STATS_RANDOM_BITRATE_FORMAT'] . '">' . $tmp_STATS_RANDOM['STATS_RANDOM_BITRATE'] . '</bitrate>
                    </stream_stat>
                </connection_stat>';

                }

            }

        }

        $tmp_output_ARRAY = array();

        $tmp_output_ARRAY['RELAY_RECENT_STATS'] = '<recent_statistics>' . $tmp_output_relay_recent_stats . '</recent_statistics>';

        return $tmp_output_ARRAY;

    }

    private function return_stream_relay_historical(){

        //
        // SPREAD OF REPORTING STATS FROM PREVIOUS SHOW
        $tmp_output_relay_historical_stats = '';
        $tmp_RELAY_HISTORICAL_DATA = $this->oCRNRSTN->return_record_count('RELAY_HISTORICAL_DATA');

        if($tmp_RELAY_HISTORICAL_DATA > 0){

            for($i = 0; $i < $tmp_RELAY_HISTORICAL_DATA; $i++){

                $tmp_RELAY_TIMESTAMP = $this->oCRNRSTN->return_database_value('RELAY_HISTORICAL_DATA', 'RELAY_TIMESTAMP', $i);
                $tmp_BASSDRIVE_LOG_ID = $this->oCRNRSTN->return_database_value('RELAY_HISTORICAL_DATA', 'BASSDRIVE_LOG_ID', $i);

                $tmp_STATS_TOTAL = array();
                $tmp_STATS_TOTAL_UNIQUE = array();
                $tmp_STATS_PREMIUM = array();
                $tmp_STATS_MIDGRADE = array();
                $tmp_STATS_AACPLUS = array();
                $tmp_STATS_RANDOM = array();

                $tmp_STATS_TOTAL['STATS_TOTAL_CONNECTIONS'] = $this->oCRNRSTN->return_database_value('RELAY_HISTORICAL_DATA', 'STATS_TOTAL_CONNECTIONS', $i);
                $tmp_STATS_TOTAL['STATS_TOTAL_CAPACITY'] = $this->oCRNRSTN->return_database_value('RELAY_HISTORICAL_DATA', 'STATS_TOTAL_CAPACITY', $i);
                $tmp_STATS_TOTAL['STATS_TOTAL_BANDWIDTH'] = $this->oCRNRSTN->return_database_value('RELAY_HISTORICAL_DATA', 'STATS_TOTAL_BANDWIDTH', $i);
                $tmp_STATS_TOTAL['STATS_TOTAL_BANDWIDTH_FORMAT'] = $this->oCRNRSTN->return_database_value('RELAY_HISTORICAL_DATA', 'STATS_TOTAL_BANDWIDTH_FORMAT', $i);

                $tmp_STATS_TOTAL_UNIQUE['STATS_TOTAL_UNIQUE_CONNECTIONS'] = $this->oCRNRSTN->return_database_value('RELAY_HISTORICAL_DATA', 'STATS_TOTAL_UNIQUE_CONNECTIONS', $i);
                $tmp_STATS_TOTAL_UNIQUE['STATS_TOTAL_UNIQUE_CAPACITY'] = $this->oCRNRSTN->return_database_value('RELAY_HISTORICAL_DATA', 'STATS_TOTAL_UNIQUE_CAPACITY', $i);
                $tmp_STATS_TOTAL_UNIQUE['STATS_TOTAL_UNIQUE_BANDWIDTH'] = $this->oCRNRSTN->return_database_value('RELAY_HISTORICAL_DATA', 'STATS_TOTAL_UNIQUE_BANDWIDTH', $i);
                $tmp_STATS_TOTAL_UNIQUE['STATS_TOTAL_UNIQUE_BANDWIDTH_FORMAT'] = $this->oCRNRSTN->return_database_value('RELAY_HISTORICAL_DATA', 'STATS_TOTAL_UNIQUE_BANDWIDTH_FORMAT', $i);

                $tmp_STATS_PREMIUM['STATS_PREMIUM_BITRATE'] = $this->oCRNRSTN->return_database_value('RELAY_HISTORICAL_DATA', 'STATS_PREMIUM_BITRATE', $i);
                $tmp_STATS_PREMIUM['STATS_PREMIUM_BITRATE_FORMAT'] = $this->oCRNRSTN->return_database_value('RELAY_HISTORICAL_DATA', 'STATS_PREMIUM_BITRATE_FORMAT', $i);
                $tmp_STATS_PREMIUM['STATS_PREMIUM_CONNECTIONS'] = $this->oCRNRSTN->return_database_value('RELAY_HISTORICAL_DATA', 'STATS_PREMIUM_CONNECTIONS', $i);
                $tmp_STATS_PREMIUM['STATS_PREMIUM_CAPACITY'] = $this->oCRNRSTN->return_database_value('RELAY_HISTORICAL_DATA', 'STATS_PREMIUM_CAPACITY', $i);
                $tmp_STATS_PREMIUM['STATS_PREMIUM_BANDWIDTH'] = $this->oCRNRSTN->return_database_value('RELAY_HISTORICAL_DATA', 'STATS_PREMIUM_BANDWIDTH', $i);
                $tmp_STATS_PREMIUM['STATS_PREMIUM_BANDWIDTH_FORMAT'] = $this->oCRNRSTN->return_database_value('RELAY_HISTORICAL_DATA', 'STATS_PREMIUM_BANDWIDTH_FORMAT', $i);

                $tmp_STATS_MIDGRADE['STATS_MIDGRADE_BITRATE'] = $this->oCRNRSTN->return_database_value('RELAY_HISTORICAL_DATA', 'STATS_MIDGRADE_BITRATE', $i);
                $tmp_STATS_MIDGRADE['STATS_MIDGRADE_BITRATE_FORMAT'] = $this->oCRNRSTN->return_database_value('RELAY_HISTORICAL_DATA', 'STATS_MIDGRADE_BITRATE_FORMAT', $i);
                $tmp_STATS_MIDGRADE['STATS_MIDGRADE_CONNECTIONS'] = $this->oCRNRSTN->return_database_value('RELAY_HISTORICAL_DATA', 'STATS_MIDGRADE_CONNECTIONS', $i);
                $tmp_STATS_MIDGRADE['STATS_MIDGRADE_CAPACITY'] = $this->oCRNRSTN->return_database_value('RELAY_HISTORICAL_DATA', 'STATS_MIDGRADE_CAPACITY', $i);
                $tmp_STATS_MIDGRADE['STATS_MIDGRADE_BANDWIDTH'] = $this->oCRNRSTN->return_database_value('RELAY_HISTORICAL_DATA', 'STATS_MIDGRADE_BANDWIDTH', $i);
                $tmp_STATS_MIDGRADE['STATS_MIDGRADE_BANDWIDTH_FORMAT'] = $this->oCRNRSTN->return_database_value('RELAY_HISTORICAL_DATA', 'STATS_MIDGRADE_BANDWIDTH_FORMAT', $i);

                $tmp_STATS_AACPLUS['STATS_AAC_PLUS_BITRATE'] = $this->oCRNRSTN->return_database_value('RELAY_HISTORICAL_DATA', 'STATS_AAC_PLUS_BITRATE', $i);
                $tmp_STATS_AACPLUS['STATS_AAC_PLUS_BITRATE_FORMAT'] = $this->oCRNRSTN->return_database_value('RELAY_HISTORICAL_DATA', 'STATS_AAC_PLUS_BITRATE_FORMAT', $i);
                $tmp_STATS_AACPLUS['STATS_AAC_PLUS_CONNECTIONS'] = $this->oCRNRSTN->return_database_value('RELAY_HISTORICAL_DATA', 'STATS_AAC_PLUS_CONNECTIONS', $i);
                $tmp_STATS_AACPLUS['STATS_AAC_PLUS_CAPACITY'] = $this->oCRNRSTN->return_database_value('RELAY_HISTORICAL_DATA', 'STATS_AAC_PLUS_CAPACITY', $i);
                $tmp_STATS_AACPLUS['STATS_AAC_PLUS_BANDWIDTH'] = $this->oCRNRSTN->return_database_value('RELAY_HISTORICAL_DATA', 'STATS_AAC_PLUS_BANDWIDTH', $i);
                $tmp_STATS_AACPLUS['STATS_AAC_PLUS_BANDWIDTH_FORMAT'] = $this->oCRNRSTN->return_database_value('RELAY_HISTORICAL_DATA', 'STATS_AAC_PLUS_BANDWIDTH_FORMAT', $i);

                $tmp_STATS_RANDOM['STATS_RANDOM_BITRATE'] = $this->oCRNRSTN->return_database_value('RELAY_HISTORICAL_DATA', 'STATS_RANDOM_BITRATE', $i);
                $tmp_STATS_RANDOM['STATS_RANDOM_BITRATE_FORMAT'] = $this->oCRNRSTN->return_database_value('RELAY_HISTORICAL_DATA', 'STATS_RANDOM_BITRATE_FORMAT', $i);
                $tmp_STATS_RANDOM['STATS_RANDOM_CONNECTIONS'] = $this->oCRNRSTN->return_database_value('RELAY_HISTORICAL_DATA', 'STATS_RANDOM_CONNECTIONS', $i);
                $tmp_STATS_RANDOM['STATS_RANDOM_CAPACITY'] = $this->oCRNRSTN->return_database_value('RELAY_HISTORICAL_DATA', 'STATS_RANDOM_CAPACITY', $i);
                $tmp_STATS_RANDOM['STATS_RANDOM_BANDWIDTH'] = $this->oCRNRSTN->return_database_value('RELAY_HISTORICAL_DATA', 'STATS_RANDOM_BANDWIDTH', $i);
                $tmp_STATS_RANDOM['STATS_RANDOM_BANDWIDTH_FORMAT'] = $this->oCRNRSTN->return_database_value('RELAY_HISTORICAL_DATA', 'STATS_RANDOM_BANDWIDTH_FORMAT', $i);

                if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

                    $tmp_output_relay_historical_stats .= '<connection_stat timestamp="' . $tmp_RELAY_TIMESTAMP . '" json_log_id="' . $tmp_BASSDRIVE_LOG_ID . '"><stream_stat type="total"><connections capacity="' . $tmp_STATS_TOTAL['STATS_TOTAL_CAPACITY'] . '">' . $tmp_STATS_TOTAL['STATS_TOTAL_CONNECTIONS'] . '</connections><bandwidth format="' . $tmp_STATS_TOTAL['STATS_TOTAL_BANDWIDTH_FORMAT'] . '">' . $tmp_STATS_TOTAL['STATS_TOTAL_BANDWIDTH'] . '</bandwidth></stream_stat><stream_stat type="totalunique"><connections capacity="' . $tmp_STATS_TOTAL_UNIQUE['STATS_TOTAL_UNIQUE_CAPACITY'] . '">' . $tmp_STATS_TOTAL_UNIQUE['STATS_TOTAL_UNIQUE_CONNECTIONS'] . '</connections><bandwidth format="' . $tmp_STATS_TOTAL_UNIQUE['STATS_TOTAL_UNIQUE_BANDWIDTH_FORMAT'] . '">' . $tmp_STATS_TOTAL_UNIQUE['STATS_TOTAL_UNIQUE_BANDWIDTH'] . '</bandwidth></stream_stat><stream_stat type="premium"><connections capacity="' . $tmp_STATS_PREMIUM['STATS_PREMIUM_CAPACITY'] . '">' . $tmp_STATS_PREMIUM['STATS_PREMIUM_CONNECTIONS'] . '</connections><bandwidth format="' . $tmp_STATS_PREMIUM['STATS_PREMIUM_BANDWIDTH_FORMAT'] . '">' . $tmp_STATS_PREMIUM['STATS_PREMIUM_BANDWIDTH'] . '</bandwidth><bitrate format="' . $tmp_STATS_PREMIUM['STATS_PREMIUM_BITRATE_FORMAT'] . '">' . $tmp_STATS_PREMIUM['STATS_PREMIUM_BITRATE'] . '</bitrate></stream_stat><stream_stat type="midgrade"><connections capacity="' . $tmp_STATS_MIDGRADE['STATS_MIDGRADE_CAPACITY'] . '">' . $tmp_STATS_MIDGRADE['STATS_MIDGRADE_CONNECTIONS'] . '</connections><bandwidth format="' . $tmp_STATS_MIDGRADE['STATS_MIDGRADE_BANDWIDTH_FORMAT'] . '">' . $tmp_STATS_MIDGRADE['STATS_MIDGRADE_BANDWIDTH'] . '</bandwidth><bitrate format="' . $tmp_STATS_MIDGRADE['STATS_MIDGRADE_BITRATE_FORMAT'] . '">' . $tmp_STATS_MIDGRADE['STATS_MIDGRADE_BITRATE'] . '</bitrate></stream_stat><stream_stat type="aacplus"><connections capacity="' . $tmp_STATS_AACPLUS['STATS_AAC_PLUS_CAPACITY'] . '">' . $tmp_STATS_AACPLUS['STATS_AAC_PLUS_CONNECTIONS'] . '</connections><bandwidth format="' . $tmp_STATS_AACPLUS['STATS_AAC_PLUS_BANDWIDTH_FORMAT'] . '">' . $tmp_STATS_AACPLUS['STATS_AAC_PLUS_BANDWIDTH'] . '</bandwidth><bitrate format="' . $tmp_STATS_AACPLUS['STATS_AAC_PLUS_BITRATE_FORMAT'] . '">' . $tmp_STATS_AACPLUS['STATS_AAC_PLUS_BITRATE'] . '</bitrate></stream_stat><stream_stat type="random"><connections capacity="' . $tmp_STATS_RANDOM['STATS_RANDOM_CAPACITY'] . '">' . $tmp_STATS_RANDOM['STATS_RANDOM_CONNECTIONS'] . '</connections><bandwidth format="' . $tmp_STATS_RANDOM['STATS_RANDOM_BANDWIDTH_FORMAT'] . '">' . $tmp_STATS_RANDOM['STATS_RANDOM_BANDWIDTH'] . '</bandwidth><bitrate format="' . $tmp_STATS_RANDOM['STATS_RANDOM_BITRATE_FORMAT'] . '">' . $tmp_STATS_RANDOM['STATS_RANDOM_BITRATE'] . '</bitrate></stream_stat></connection_stat>';

                }else{

                    $tmp_output_relay_historical_stats .= '<connection_stat timestamp="' . $tmp_RELAY_TIMESTAMP . '" json_log_id="' . $tmp_BASSDRIVE_LOG_ID . '">
                    <stream_stat type="total">
                        <connections capacity="' . $tmp_STATS_TOTAL['STATS_TOTAL_CAPACITY'] . '">' . $tmp_STATS_TOTAL['STATS_TOTAL_CONNECTIONS'] . '</connections>
                        <bandwidth format="' . $tmp_STATS_TOTAL['STATS_TOTAL_BANDWIDTH_FORMAT'] . '">' . $tmp_STATS_TOTAL['STATS_TOTAL_BANDWIDTH'] . '</bandwidth>
                    </stream_stat>
                    <stream_stat type="totalunique">
                        <connections capacity="' . $tmp_STATS_TOTAL_UNIQUE['STATS_TOTAL_UNIQUE_CAPACITY'] . '">' . $tmp_STATS_TOTAL_UNIQUE['STATS_TOTAL_UNIQUE_CONNECTIONS'] . '</connections>
                        <bandwidth format="' . $tmp_STATS_TOTAL_UNIQUE['STATS_TOTAL_UNIQUE_BANDWIDTH_FORMAT'] . '">' . $tmp_STATS_TOTAL_UNIQUE['STATS_TOTAL_UNIQUE_BANDWIDTH'] . '</bandwidth>
                    </stream_stat>
                    <stream_stat type="premium">
                        <connections capacity="' . $tmp_STATS_PREMIUM['STATS_PREMIUM_CAPACITY'] . '">' . $tmp_STATS_PREMIUM['STATS_PREMIUM_CONNECTIONS'] . '</connections>
                        <bandwidth format="' . $tmp_STATS_PREMIUM['STATS_PREMIUM_BANDWIDTH_FORMAT'] . '">' . $tmp_STATS_PREMIUM['STATS_PREMIUM_BANDWIDTH'] . '</bandwidth>
                        <bitrate format="' . $tmp_STATS_PREMIUM['STATS_PREMIUM_BITRATE_FORMAT'] . '">' . $tmp_STATS_PREMIUM['STATS_PREMIUM_BITRATE'] . '</bitrate>
                    </stream_stat>
                    <stream_stat type="midgrade">
                        <connections capacity="' . $tmp_STATS_MIDGRADE['STATS_MIDGRADE_CAPACITY'] . '">' . $tmp_STATS_MIDGRADE['STATS_MIDGRADE_CONNECTIONS'] . '</connections>
                        <bandwidth format="' . $tmp_STATS_MIDGRADE['STATS_MIDGRADE_BANDWIDTH_FORMAT'] . '">' . $tmp_STATS_MIDGRADE['STATS_MIDGRADE_BANDWIDTH'] . '</bandwidth>
                        <bitrate format="' . $tmp_STATS_MIDGRADE['STATS_MIDGRADE_BITRATE_FORMAT'] . '">' . $tmp_STATS_MIDGRADE['STATS_MIDGRADE_BITRATE'] . '</bitrate>
                    </stream_stat>
                    <stream_stat type="aacplus">
                        <connections capacity="' . $tmp_STATS_AACPLUS['STATS_AAC_PLUS_CAPACITY'] . '">' . $tmp_STATS_AACPLUS['STATS_AAC_PLUS_CONNECTIONS'] . '</connections>
                        <bandwidth format="' . $tmp_STATS_AACPLUS['STATS_AAC_PLUS_BANDWIDTH_FORMAT'] . '">' . $tmp_STATS_AACPLUS['STATS_AAC_PLUS_BANDWIDTH'] . '</bandwidth>
                        <bitrate format="' . $tmp_STATS_AACPLUS['STATS_AAC_PLUS_BITRATE_FORMAT'] . '">' . $tmp_STATS_AACPLUS['STATS_AAC_PLUS_BITRATE'] . '</bitrate>
                    </stream_stat>
                    <stream_stat type="random">
                        <connections capacity="' . $tmp_STATS_RANDOM['STATS_RANDOM_CAPACITY'] . '">' . $tmp_STATS_RANDOM['STATS_RANDOM_CONNECTIONS'] . '</connections>
                        <bandwidth format="' . $tmp_STATS_RANDOM['STATS_RANDOM_BANDWIDTH_FORMAT'] . '">' . $tmp_STATS_RANDOM['STATS_RANDOM_BANDWIDTH'] . '</bandwidth>
                        <bitrate format="' . $tmp_STATS_RANDOM['STATS_RANDOM_BITRATE_FORMAT'] . '">' . $tmp_STATS_RANDOM['STATS_RANDOM_BITRATE'] . '</bitrate>
                    </stream_stat>
                </connection_stat>';

                }

            }

        }

        $tmp_output_ARRAY = array();

        $tmp_output_ARRAY['RELAY_HISTORICAL_STATS'] = '<historical_statistics>' . $tmp_output_relay_historical_stats . '</historical_statistics>';

        return $tmp_output_ARRAY;

    }

    private function return_stream_relay(){

        $tmp_output_relay = '';
        $tmp_output_relay_current_stats = '';
        $tmp_RELAY_CURRENT_DATA = $this->oCRNRSTN->return_record_count('RELAY_CURRENT_DATA');

        for($i = 0; $i < $tmp_RELAY_CURRENT_DATA; $i++){

            $tmp_STREAM_URL = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STREAM_URL', $i);
            $tmp_streamURLios = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STREAM_URL_IOS', $i);
            $tmp_BITRATE = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'BITRATE', $i);
            $tmp_AUDIO_FORMAT = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'AUDIO_FORMAT', $i);
            $tmp_LISTENER_COUNT = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'LISTENER_COUNT', $i);
            $tmp_LISTENER_COUNT_PERCENTAGE = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'LISTENER_COUNT_PERCENTAGE', $i);
            //$tmp_IS_REPLAY = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'IS_REPLAY', $i);

            if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

                $tmp_output_relay .= '<stream url="' . $tmp_STREAM_URL . '" url_ios="' . $tmp_streamURLios . '"><bitrate>' . $tmp_BITRATE . '</bitrate><audio_format>' . $tmp_AUDIO_FORMAT . '</audio_format><listener_count>' . $tmp_LISTENER_COUNT . '</listener_count><listener_count_percentage>' . $tmp_LISTENER_COUNT_PERCENTAGE . '</listener_count_percentage>';

            }else{

                $tmp_output_relay .= '<stream url="' . $tmp_STREAM_URL . '" url_ios="' . $tmp_streamURLios . '">
                        <bitrate>' . $tmp_BITRATE . '</bitrate>
                        <audio_format>' . $tmp_AUDIO_FORMAT . '</audio_format>
                        <listener_count>' . $tmp_LISTENER_COUNT . '</listener_count>
                        <listener_count_percentage>' . $tmp_LISTENER_COUNT_PERCENTAGE . '</listener_count_percentage>';

            }

            if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

                $tmp_output_relay .= '</stream>';

            }else{

                if($i < $tmp_RELAY_CURRENT_DATA-1){

                    $tmp_output_relay .= '
                    </stream>
                    ';

                }else{

                    $tmp_output_relay .= '
                    </stream>';

                }

            }

        }

        $tmp_DATEMODIFIED = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'DATEMODIFIED');
        $tmp_BASSDRIVE_LOG_ID = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'BASSDRIVE_LOG_ID');

        $tmp_STATS_TOTAL = array();
        $tmp_STATS_TOTAL_UNIQUE = array();
        $tmp_STATS_PREMIUM = array();
        $tmp_STATS_MIDGRADE = array();
        $tmp_STATS_AACPLUS = array();
        $tmp_STATS_RANDOM = array();

        $tmp_STATS_TOTAL['STATS_TOTAL_CONNECTIONS'] = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STATS_TOTAL_CONNECTIONS');
        $tmp_STATS_TOTAL['STATS_TOTAL_CAPACITY'] = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STATS_TOTAL_CAPACITY');
        $tmp_STATS_TOTAL['STATS_TOTAL_BANDWIDTH'] = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STATS_TOTAL_BANDWIDTH');
        $tmp_STATS_TOTAL['STATS_TOTAL_BANDWIDTH_FORMAT'] = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STATS_TOTAL_BANDWIDTH_FORMAT');

        $tmp_STATS_TOTAL_UNIQUE['STATS_TOTAL_UNIQUE_CONNECTIONS'] = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STATS_TOTAL_UNIQUE_CONNECTIONS');
        $tmp_STATS_TOTAL_UNIQUE['STATS_TOTAL_UNIQUE_CAPACITY'] = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STATS_TOTAL_UNIQUE_CAPACITY');
        $tmp_STATS_TOTAL_UNIQUE['STATS_TOTAL_UNIQUE_BANDWIDTH'] = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STATS_TOTAL_UNIQUE_BANDWIDTH');
        $tmp_STATS_TOTAL_UNIQUE['STATS_TOTAL_UNIQUE_BANDWIDTH_FORMAT'] = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STATS_TOTAL_UNIQUE_BANDWIDTH_FORMAT');

        $tmp_STATS_PREMIUM['STATS_PREMIUM_BITRATE'] = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STATS_PREMIUM_BITRATE');
        $tmp_STATS_PREMIUM['STATS_PREMIUM_BITRATE_FORMAT'] = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STATS_PREMIUM_BITRATE_FORMAT');
        $tmp_STATS_PREMIUM['STATS_PREMIUM_CONNECTIONS'] = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STATS_PREMIUM_CONNECTIONS');
        $tmp_STATS_PREMIUM['STATS_PREMIUM_CAPACITY'] = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STATS_PREMIUM_CAPACITY');
        $tmp_STATS_PREMIUM['STATS_PREMIUM_BANDWIDTH'] = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STATS_PREMIUM_BANDWIDTH');
        $tmp_STATS_PREMIUM['STATS_PREMIUM_BANDWIDTH_FORMAT'] = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STATS_PREMIUM_BANDWIDTH_FORMAT');

        $tmp_STATS_MIDGRADE['STATS_MIDGRADE_BITRATE'] = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STATS_MIDGRADE_BITRATE');
        $tmp_STATS_MIDGRADE['STATS_MIDGRADE_BITRATE_FORMAT'] = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STATS_MIDGRADE_BITRATE_FORMAT');
        $tmp_STATS_MIDGRADE['STATS_MIDGRADE_CONNECTIONS'] = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STATS_MIDGRADE_CONNECTIONS');
        $tmp_STATS_MIDGRADE['STATS_MIDGRADE_CAPACITY'] = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STATS_MIDGRADE_CAPACITY');
        $tmp_STATS_MIDGRADE['STATS_MIDGRADE_BANDWIDTH'] = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STATS_MIDGRADE_BANDWIDTH');
        $tmp_STATS_MIDGRADE['STATS_MIDGRADE_BANDWIDTH_FORMAT'] = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STATS_MIDGRADE_BANDWIDTH_FORMAT');

        $tmp_STATS_AACPLUS['STATS_AAC_PLUS_BITRATE'] = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STATS_AAC_PLUS_BITRATE');
        $tmp_STATS_AACPLUS['STATS_AAC_PLUS_BITRATE_FORMAT'] = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STATS_AAC_PLUS_BITRATE_FORMAT');
        $tmp_STATS_AACPLUS['STATS_AAC_PLUS_CONNECTIONS'] = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STATS_AAC_PLUS_CONNECTIONS');
        $tmp_STATS_AACPLUS['STATS_AAC_PLUS_CAPACITY'] = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STATS_AAC_PLUS_CAPACITY');
        $tmp_STATS_AACPLUS['STATS_AAC_PLUS_BANDWIDTH'] = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STATS_AAC_PLUS_BANDWIDTH');
        $tmp_STATS_AACPLUS['STATS_AAC_PLUS_BANDWIDTH_FORMAT'] = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STATS_AAC_PLUS_BANDWIDTH_FORMAT');

        $tmp_STATS_RANDOM['STATS_RANDOM_BITRATE'] = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STATS_RANDOM_BITRATE');
        $tmp_STATS_RANDOM['STATS_RANDOM_BITRATE_FORMAT'] = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STATS_RANDOM_BITRATE_FORMAT');
        $tmp_STATS_RANDOM['STATS_RANDOM_CONNECTIONS'] = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STATS_RANDOM_CONNECTIONS');
        $tmp_STATS_RANDOM['STATS_RANDOM_CAPACITY'] = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STATS_RANDOM_CAPACITY');
        $tmp_STATS_RANDOM['STATS_RANDOM_BANDWIDTH'] = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STATS_RANDOM_BANDWIDTH');
        $tmp_STATS_RANDOM['STATS_RANDOM_BANDWIDTH_FORMAT'] = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STATS_RANDOM_BANDWIDTH_FORMAT');

        if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

            $tmp_output_relay_current_stats = '             <connection_stat timestamp="' . $tmp_DATEMODIFIED . '" json_log_id="' . $tmp_BASSDRIVE_LOG_ID . '"><stream_stat type="total"><connections capacity="' . $tmp_STATS_TOTAL['STATS_TOTAL_CAPACITY'] . '">' . $tmp_STATS_TOTAL['STATS_TOTAL_CONNECTIONS'] . '</connections><bandwidth format="' . $tmp_STATS_TOTAL['STATS_TOTAL_BANDWIDTH_FORMAT'] . '">' . $tmp_STATS_TOTAL['STATS_TOTAL_BANDWIDTH'] . '</bandwidth></stream_stat><stream_stat type="totalunique"><connections capacity="' . $tmp_STATS_TOTAL_UNIQUE['STATS_TOTAL_UNIQUE_CAPACITY'] . '">' . $tmp_STATS_TOTAL_UNIQUE['STATS_TOTAL_UNIQUE_CONNECTIONS'] . '</connections><bandwidth format="' . $tmp_STATS_TOTAL_UNIQUE['STATS_TOTAL_UNIQUE_BANDWIDTH_FORMAT'] . '">' . $tmp_STATS_TOTAL_UNIQUE['STATS_TOTAL_UNIQUE_BANDWIDTH'] . '</bandwidth></stream_stat><stream_stat type="premium"><connections capacity="' . $tmp_STATS_PREMIUM['STATS_PREMIUM_CAPACITY'] . '">' . $tmp_STATS_PREMIUM['STATS_PREMIUM_CONNECTIONS'] . '</connections><bandwidth format="' . $tmp_STATS_PREMIUM['STATS_PREMIUM_BANDWIDTH_FORMAT'] . '">' . $tmp_STATS_PREMIUM['STATS_PREMIUM_BANDWIDTH'] . '</bandwidth><bitrate format="' . $tmp_STATS_PREMIUM['STATS_PREMIUM_BITRATE_FORMAT'] . '">' . $tmp_STATS_PREMIUM['STATS_PREMIUM_BITRATE'] . '</bitrate></stream_stat><stream_stat type="midgrade"><connections capacity="' . $tmp_STATS_MIDGRADE['STATS_MIDGRADE_CAPACITY'] . '">' . $tmp_STATS_MIDGRADE['STATS_MIDGRADE_CONNECTIONS'] . '</connections><bandwidth format="' . $tmp_STATS_MIDGRADE['STATS_MIDGRADE_BANDWIDTH_FORMAT'] . '">' . $tmp_STATS_MIDGRADE['STATS_MIDGRADE_BANDWIDTH'] . '</bandwidth><bitrate format="' . $tmp_STATS_MIDGRADE['STATS_MIDGRADE_BITRATE_FORMAT'] . '">' . $tmp_STATS_MIDGRADE['STATS_MIDGRADE_BITRATE'] . '</bitrate></stream_stat><stream_stat type="aacplus"><connections capacity="' . $tmp_STATS_AACPLUS['STATS_AAC_PLUS_CAPACITY'] . '">' . $tmp_STATS_AACPLUS['STATS_AAC_PLUS_CONNECTIONS'] . '</connections><bandwidth format="' . $tmp_STATS_AACPLUS['STATS_AAC_PLUS_BANDWIDTH_FORMAT'] . '">' . $tmp_STATS_AACPLUS['STATS_AAC_PLUS_BANDWIDTH'] . '</bandwidth><bitrate format="' . $tmp_STATS_AACPLUS['STATS_AAC_PLUS_BITRATE_FORMAT'] . '">' . $tmp_STATS_AACPLUS['STATS_AAC_PLUS_BITRATE'] . '</bitrate></stream_stat><stream_stat type="random"><connections capacity="' . $tmp_STATS_RANDOM['STATS_RANDOM_CAPACITY'] . '">' . $tmp_STATS_RANDOM['STATS_RANDOM_CONNECTIONS'] . '</connections><bandwidth format="' . $tmp_STATS_RANDOM['STATS_RANDOM_BANDWIDTH_FORMAT'] . '">' . $tmp_STATS_RANDOM['STATS_RANDOM_BANDWIDTH'] . '</bandwidth><bitrate format="' . $tmp_STATS_RANDOM['STATS_RANDOM_BITRATE_FORMAT'] . '">' . $tmp_STATS_RANDOM['STATS_RANDOM_BITRATE'] . '</bitrate></stream_stat></connection_stat>';

            $tmp_output_ARRAY = array();
            $tmp_output_ARRAY['RELAY'] = $tmp_output_relay;
            $tmp_output_ARRAY['RELAY_CURRENT_STATS'] = '<current_statistics>' . $tmp_output_relay_current_stats . '</current_statistics>';

        }else{

            $tmp_output_relay_current_stats = '             <connection_stat timestamp="' . $tmp_DATEMODIFIED . '" json_log_id="' . $tmp_BASSDRIVE_LOG_ID . '">
                            <stream_stat type="total">
                                <connections capacity="' . $tmp_STATS_TOTAL['STATS_TOTAL_CAPACITY'] . '">' . $tmp_STATS_TOTAL['STATS_TOTAL_CONNECTIONS'] . '</connections>
                                <bandwidth format="' . $tmp_STATS_TOTAL['STATS_TOTAL_BANDWIDTH_FORMAT'] . '">' . $tmp_STATS_TOTAL['STATS_TOTAL_BANDWIDTH'] . '</bandwidth>
                            </stream_stat>
                            <stream_stat type="totalunique">
                                <connections capacity="' . $tmp_STATS_TOTAL_UNIQUE['STATS_TOTAL_UNIQUE_CAPACITY'] . '">' . $tmp_STATS_TOTAL_UNIQUE['STATS_TOTAL_UNIQUE_CONNECTIONS'] . '</connections>
                                <bandwidth format="' . $tmp_STATS_TOTAL_UNIQUE['STATS_TOTAL_UNIQUE_BANDWIDTH_FORMAT'] . '">' . $tmp_STATS_TOTAL_UNIQUE['STATS_TOTAL_UNIQUE_BANDWIDTH'] . '</bandwidth>
                            </stream_stat>
                            <stream_stat type="premium">
                                <connections capacity="' . $tmp_STATS_PREMIUM['STATS_PREMIUM_CAPACITY'] . '">' . $tmp_STATS_PREMIUM['STATS_PREMIUM_CONNECTIONS'] . '</connections>
                                <bandwidth format="' . $tmp_STATS_PREMIUM['STATS_PREMIUM_BANDWIDTH_FORMAT'] . '">' . $tmp_STATS_PREMIUM['STATS_PREMIUM_BANDWIDTH'] . '</bandwidth>
                                <bitrate format="' . $tmp_STATS_PREMIUM['STATS_PREMIUM_BITRATE_FORMAT'] . '">' . $tmp_STATS_PREMIUM['STATS_PREMIUM_BITRATE'] . '</bitrate>
                            </stream_stat>
                            <stream_stat type="midgrade">
                                <connections capacity="' . $tmp_STATS_MIDGRADE['STATS_MIDGRADE_CAPACITY'] . '">' . $tmp_STATS_MIDGRADE['STATS_MIDGRADE_CONNECTIONS'] . '</connections>
                                <bandwidth format="' . $tmp_STATS_MIDGRADE['STATS_MIDGRADE_BANDWIDTH_FORMAT'] . '">' . $tmp_STATS_MIDGRADE['STATS_MIDGRADE_BANDWIDTH'] . '</bandwidth>
                                <bitrate format="' . $tmp_STATS_MIDGRADE['STATS_MIDGRADE_BITRATE_FORMAT'] . '">' . $tmp_STATS_MIDGRADE['STATS_MIDGRADE_BITRATE'] . '</bitrate>
                            </stream_stat>
                            <stream_stat type="aacplus">
                                <connections capacity="' . $tmp_STATS_AACPLUS['STATS_AAC_PLUS_CAPACITY'] . '">' . $tmp_STATS_AACPLUS['STATS_AAC_PLUS_CONNECTIONS'] . '</connections>
                                <bandwidth format="' . $tmp_STATS_AACPLUS['STATS_AAC_PLUS_BANDWIDTH_FORMAT'] . '">' . $tmp_STATS_AACPLUS['STATS_AAC_PLUS_BANDWIDTH'] . '</bandwidth>
                                <bitrate format="' . $tmp_STATS_AACPLUS['STATS_AAC_PLUS_BITRATE_FORMAT'] . '">' . $tmp_STATS_AACPLUS['STATS_AAC_PLUS_BITRATE'] . '</bitrate>
                            </stream_stat>
                            <stream_stat type="random">
                                <connections capacity="' . $tmp_STATS_RANDOM['STATS_RANDOM_CAPACITY'] . '">' . $tmp_STATS_RANDOM['STATS_RANDOM_CONNECTIONS'] . '</connections>
                                <bandwidth format="' . $tmp_STATS_RANDOM['STATS_RANDOM_BANDWIDTH_FORMAT'] . '">' . $tmp_STATS_RANDOM['STATS_RANDOM_BANDWIDTH'] . '</bandwidth>
                                <bitrate format="' . $tmp_STATS_RANDOM['STATS_RANDOM_BITRATE_FORMAT'] . '">' . $tmp_STATS_RANDOM['STATS_RANDOM_BITRATE'] . '</bitrate>
                            </stream_stat>
                        </connection_stat>';

            $tmp_output_ARRAY = array();

            $tmp_output_ARRAY['RELAY'] = $tmp_output_relay;
            $tmp_output_ARRAY['RELAY_CURRENT_STATS'] = '<current_statistics>
            ' . $tmp_output_relay_current_stats . '
                    </current_statistics>';

        }

        return $tmp_output_ARRAY;

    }

    private function return_social_link_HTML($social_id, $channel_key, $stream_key, $show_title, $url, $sprite_serial){

        $tmp_param_array = array();
        $tmp_param_array[] = 'crnrstn_bst=true';
        $tmp_param_array[] = 'crnrstn_smk=' . $channel_key;
        $tmp_param_array[] = 'crnrstn_sid=' . $social_id;
        $tmp_param_array[] = 'crnrstn_sk=' . $stream_key;

        $url_sticky = $this->oCRNRSTN->return_sticky_link($url, $tmp_param_array);
        $channel = 'stream_' . strtolower($channel_key);
        $social_channel = '';

        switch($channel){
            case 'stream_soundcloud':

                $social_channel = ' for the ' . $show_title . ' SoundCloud playlist';

            break;
            case 'stream_facebook':

                $social_channel = ' for the ' . $show_title . ' Facebook page';

            break;
            case 'stream_instagram':

                $social_channel = ' for the ' . $show_title . ' Instagram feed';

            break;
            case 'stream_twitter':

                $social_channel = ' for the ' . $show_title . ' Twitter feed';

            break;
            case 'stream_mixcloud':

                $social_channel = ' for the ' . $show_title . ' Mixcloud community';

            break;
            case 'stream_discogs':

                $social_channel = ' for the ' . $show_title . ' Discogs music selection';

            break;
            case 'stream_beatport':

                $social_channel = ' for the ' . $show_title . ' Beatport featured tracks';

            break;
            case 'stream_bandcamp':

                $social_channel = ' for the ' . $show_title . ' Bandcamp music page';

            break;
            case 'stream_spotify':

                $social_channel = ' for the ' . $show_title . ' Spotify community';

            break;
            case 'stream_rolldabeats':

                $social_channel = ' for the ' . $show_title . ' RollDaBeats catalog';

            break;
            case 'stream_youtube':

                $social_channel = ' for the ' . $show_title . ' YouTube channel';

            break;
            case 'stream_www':

                $social_channel = ' for the website of ' . $show_title;

            break;
            case 'stream_profile':

                $social_channel = ' for the ' . $show_title . ' Bassdrive show profile';

            break;
            case 'stream_archives':

                $social_channel = ' for the archives of ' . $show_title;

            break;
            case 'stream_paypal':

                $social_channel = ' to make a donation to Bassdrive';

            break;

        }

        switch($channel){
            case 'stream_soundcloud':
            case 'stream_facebook':
            case 'stream_instagram':
            case 'stream_twitter':
            case 'stream_mixcloud':
            case 'stream_discogs':
            case 'stream_beatport':
            case 'stream_bandcamp':
            case 'stream_spotify':
            case 'stream_rolldabeats':
            case 'stream_youtube':
            case 'stream_www':
            case 'stream_profile':
            case 'stream_archives':
            case 'stream_paypal':

                if(strlen($url) > 5){

                    self::$social_lnk_cnt++;

                    //error_log(__LINE__ . ' ui tunnel resp get address path from config.');
                    return '<div class="bassdrive_social_link_anchor ' . $channel . '" onclick="launch_newwindow(\'' . $url_sticky. '\'); return false;"><div class="bassdrive_social_link_float_rel"><div class="bassdrive_social_link_float ' . $channel . '"><img src="' . $this->oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP') . $this->oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . '_crnrstn/ui/imgs/png/sprite_hq.png?v=420' . $sprite_serial .'" width="165" height="80" /></div></div></div><div class="hidden">Click <a href="' . $url_sticky . '" target="_blank">here</a>' . $social_channel . '.</div>';

                    //return '<div class="bassdrive_social_link ' . $channel . '" onclick="launch_newwindow(\'' . $url_sticky. '\'); return false;" style="background-image:url(' . $this->oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=420' . $sprite_serial .')"></div><div class="hidden">Click <a href="' . $url_sticky . '" target="_blank">here</a>' . $social_channel . '.</div>';

                }else{

                    return '';

                }

            break;
            case 'stream_json':

                if($channel == 'stream_json' && self::$social_lnk_cnt == 8){

                    $tmp_line_wrap = '<div class="cb"></div>';

                }else{

                    $tmp_line_wrap = '';

                }

                //
                // JSON
                if(strlen($url) > 5){

                    //error_log(__LINE__ . ' ui tunnel resp get address path from config.');

                    return $tmp_line_wrap . '<div class="bassdrive_social_link_anchor ' . $channel . '" onclick="launch_newwindow(\'' . $url_sticky . '\'); return false;"><div class="bassdrive_social_link_float_rel"><div class="bassdrive_social_link_float ' . $channel . '"><img src="' . $this->oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP') . $this->oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . '_crnrstn/ui/imgs/png/sprite_hq.png?v=420' . $sprite_serial .'" width="165" height="80" /></div></div></div>';

                    //return $tmp_line_wrap . '<div class="bassdrive_social_link ' . $channel . '" onclick="launch_newwindow(\'' . $url_sticky . '\'); return false;" style="background-image:url(' . $this->oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=420' . $sprite_serial .')"></div>';

                }else{

                    return '';

                }

            break;
            case 'stream_history':

                //
                // HISTORY
                if(isset($url)){

                    if(strlen($url) > 5){

                        //error_log(__LINE__ . ' ui tunnel resp get address path from config.');

                        return '<div class="bassdrive_social_link_anchor ' . $channel . '" onclick="bassdrive_load_history(\'' . $url . '\'); return false;"><div class="bassdrive_social_link_float_rel"><div class="bassdrive_social_link_float ' . $channel . '"><img src="' . $this->oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP') . $this->oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . '_crnrstn/ui/imgs/png/sprite_hq.png?v=420' . $sprite_serial .'" width="165" height="80" /></div></div></div>';

                        //return '<div class="bassdrive_social_link ' . $channel . '" onclick="bassdrive_load_history(\'' . $url . '\'); return false;" style="background-image:url(' . $this->oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=420' . $sprite_serial .')"></div>';

                    }else{

                        return '';

                    }

                }

            break;
            default:

                return '';

            break;

        }

        return '';

    }

    private function return_show_social_html($stream_key, $show_title, $xml_endpoint_output = true){

        $tmp_social_html = '';
        $tmp_endpoint_xml = '';

        $tmp_uri_paypal = 'https://www.paypal.com/donate?hosted_button_id=GWNVTUTPEAA8C';
        $tmp_uri_json = $this->oCRNRSTN->crnrstn_http_endpoint() . '_proxy/bassdrive/';
        $tmp_uri_history = $this->oCRNRSTN->crnrstn_http_endpoint() . '_proxy/bassdrive/?action=load_history';

        //error_log(__LINE__ . ' ui tunnel $tmp_uri_json=[' . $tmp_uri_json . '] DOCUMENT_ROOT=[' . $this->oCRNRSTN->get_resource('DOCUMENT_ROOT') . ']. GET sprite_hq.png from ASSET MGR. -Sunday, October 30, 2022 @ 1709 hrs.');
        //die(); $this->oCRNRSTN->crnrstn_path_directory()
        /*
         'crnrstn_path_directory', 'CRNRSTN::RESOURCE::HTTP_IMAGES', 0, NULL, $env_key);
                self::$oCRNRSTN_CONFIG_MGR->input_data_value($crnrstn_system_directory, 'crnrstn_system_directory',

        self::$oCRNRSTN_CONFIG_MGR->input_data_value($crnrstn_http_endpoint, 'crnrstn_http_endpoint', 'CRNRSTN::RESOURCE::HTTP_IMAGES', 0, NULL, $env_key);
        self::$oCRNRSTN_CONFIG_MGR->input_data_value($crnrstn_path_dir, 'crnrstn_path_directory', 'CRNRSTN::RESOURCE::HTTP_IMAGES', 0, NULL, $env_key);
        self::$oCRNRSTN_CONFIG_MGR->input_data_value($crnrstn_system_directory, 'crnrstn_system_directory', 'CRNRSTN::RESOURCE::HTTP_IMAGES', 0, NULL, $env_key);
        self::$oCRNRSTN_CONFIG_MGR->input_data_value($crnrstn_path_integrations, 'crnrstn_integrations_asset_map_dir_path', 'CRNRSTN::RESOURCE::ASSET_INTEGRATIONS', 0, NULL, $env_key);

        [Sat Nov 26 08:48:57.054967 2022] [:error] [pid 119076] [client 172.16.225.1:53792] 3122
        $tmp_asset_map_dir_path[/var/www/html/lightsaber.crnrstn.evifweb.com/lightsaber.crnrstn.evifweb.com/_crnrstn/ui].
        $tmp_crnrstn_http_endpoint[].
        $tmp_crnrstn_path_directory[/var/www/html/lightsaber.crnrstn.evifweb.com/lightsaber.crnrstn.evifweb.com].
        $tmp_crnrstn_integrations_asset_map_dir_path[/var/www/html/lightsaber.crnrstn.evifweb.com/lightsaber.crnrstn.evifweb.com/_crnrstn/ui]., referer: http://172.16.225.139/lightsaber.crnrstn.evifweb.com/

        [Sat Nov 26 08:50:15.948627 2022] [:error] [pid 118269] [client 172.16.225.1:54116] 3122
        $tmp_asset_map_dir_path[/var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/ui].
        $tmp_crnrstn_http_endpoint[]. $tmp_crnrstn_path_directory[/var/www/html/lightsaber.crnrstn.evifweb.com].
        $tmp_crnrstn_integrations_asset_map_dir_path[/var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/ui]., referer: http://172.16.225.139/lightsaber.crnrstn.evifweb.com/

        */
        //$tmp_path = $this->oCRNRSTN->crnrstn_path_directory();
        $tmp_asset_map_dir_path = $this->oCRNRSTN->get_resource('crnrstn_integrations_asset_map_dir_path', 0, 'CRNRSTN::RESOURCE::ASSET_INTEGRATIONS');

        //error_log(__LINE__ . ' ui tunnel sprite_hq path=[' . $tmp_asset_map_dir_path . '/imgs/png/social/sprite_hq.png].');
        $sprite_serial = filesize($tmp_asset_map_dir_path . '/imgs/png/social/sprite_hq.png') . '.' . filemtime($tmp_asset_map_dir_path. '/imgs/png/social/sprite_hq.png') . '.0';

        $tmp_RELAY_META_LOOKUP_DATA_count = $this->oCRNRSTN->return_record_count('RELAY_SOCIAL_DATA');

        for($i = 0; $i < $tmp_RELAY_META_LOOKUP_DATA_count; $i++){

            $tmp_SOCIAL_ID = $this->oCRNRSTN->return_database_value('RELAY_SOCIAL_DATA', 'SOCIAL_ID', $i);
            $tmp_SOCIAL_MEDIA_KEY = $this->oCRNRSTN->return_database_value('RELAY_SOCIAL_DATA', 'SOCIAL_MEDIA_KEY', $i);
            $tmp_CLICKTHROUGH_URL = $this->oCRNRSTN->return_database_value('RELAY_SOCIAL_DATA', 'CLICKTHROUGH_URL', $i);

            //error_log(__LINE__ . ' ui trm [' . $tmp_SOCIAL_MEDIA_KEY . '][' . $tmp_CLICKTHROUGH_URL . ']');

            if($xml_endpoint_output){

                $tmp_endpoint_xml .= '<endpoint type="' . $tmp_SOCIAL_MEDIA_KEY . '" url="' . urlencode($tmp_CLICKTHROUGH_URL) . '" />
                    ';

            }else{

                $tmp_social_html .= $this->return_social_link_HTML($tmp_SOCIAL_ID, $tmp_SOCIAL_MEDIA_KEY, $stream_key, $show_title, $tmp_CLICKTHROUGH_URL, $sprite_serial);

            }

        }

        if($xml_endpoint_output){

            $tmp_endpoint_xml .= '<endpoint type="paypal" url="' . urlencode($tmp_uri_paypal) . '" />';
            $tmp_endpoint_xml .= '<endpoint type="json" url="' . urlencode($tmp_uri_json) . '" />';
            $tmp_endpoint_xml .= '<endpoint type="history" url="' . urlencode($tmp_uri_history) . '" />';

        }else{

            $tmp_social_html .= $this->return_social_link_HTML('paypal', 'paypal', $stream_key, $show_title, $tmp_uri_paypal, $sprite_serial);
            $tmp_social_html .= $this->return_social_link_HTML('json', 'json', $stream_key, $show_title, $tmp_uri_json, $sprite_serial);
            $tmp_social_html .= $this->return_social_link_HTML('history', 'history', $stream_key, $show_title, $tmp_uri_history, $sprite_serial);

            $tmp_social_html = '<div class="cb"></div>
                    <div id="bassdrive_social_wrapper" class="bassdrive_social_wrapper">
                    ' . $tmp_social_html . '
                    <div class="cb"></div>
                    <div id="bassdrive_history_popup_wrapper"><div id="bassdrive_history_close_wrapper"><div id="bassdrive_history_close" onclick="bassdrive_close_history();">X</div></div><div id="bassdrive_history_popup"></div></div>
                    </div>';

        }

        if($xml_endpoint_output){

            return $tmp_endpoint_xml;

        }else{

            return $tmp_social_html;

        }

    }

    private function return_stats_html($checksum_stable_output = false){

        $tmp_connections = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STATS_TOTAL_CONNECTIONS');
        $tmp_capacity = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STATS_TOTAL_CAPACITY');
        $tmp_bandwidth = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STATS_TOTAL_BANDWIDTH');
        $tmp_bandwidthFormat = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'STATS_TOTAL_BANDWIDTH_FORMAT');

        if($checksum_stable_output){

            $tmp_situation_ARRAY = array();
            $tmp_situation_ARRAY[] = '8/16/2021 0345 :: Miss you, J5...my boy!';

        }else{

            $tmp_situation_ARRAY = $this->return_bassdrive_situation_ARRAY();

        }

        $tmp_html = '<div style="height:15px; overflow:hidden;">
                <div class="bassdrive_stats_copy_elem" style="padding-left: 0px;">*</div>
                <div class="bassdrive_stats_copy_elem" id="crnrstn_curr_total_connections" style="padding-left:2px;">' . number_format($tmp_connections) . '</div>
                <div class="bassdrive_stats_copy_elem">connections (</div>
                <div id="crnrstn_curr_total_capacity" class="bassdrive_stats_copy_elem" style="padding-left:0px;">' . number_format($tmp_capacity) . '</div>
                <div id="curr_total_capacity" class="bassdrive_stats_copy_elem">max conn.) are</div>
            </div>
            <div style="height:15px; overflow:hidden; clear:both;">
                <div class="bassdrive_stats_copy_elem" style="padding-left: 7px;">pulling</div>
                <div class="bassdrive_stats_copy_elem" id="crnrstn_curr_total_bandwidth">' . $tmp_bandwidth.'</div>
                <div class="bassdrive_stats_copy_elem" id="crnrstn_curr_total_bandwidth_format" style="padding-left:2px;">' . $this->short_format($tmp_bandwidthFormat) . '</div>
                <div class="bassdrive_stats_copy_elem" style="padding-left:0px;">/s of </div>
                <div id="crnrstn_bassdrive_situation" class="bassdrive_stats_copy_elem">' . $tmp_situation_ARRAY[0] . '</div>
                <div class="bassdrive_stats_copy_elem">from Bassdrive.</div>
            </div>';

        return $tmp_html;

    }

    private function return_show_locale_html($show_title_ARRAY){

        $tmp_html = '<div id="broadcast_nation_wrapper">
                        <div id="nation_colors_wrapper" class="nation_colors_wrapper"><div style="padding-right:8px;"><img src="' . $this->oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP') . $this->oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/bassdrive_component_creative/' . $this->oCRNRSTN->return_database_value('RELAY_COLORS_DATA', 'COLORS_IMG_FILENAME') . '" width="' . $this->oCRNRSTN->return_database_value('RELAY_COLORS_DATA', 'COLORS_IMG_WIDTH') . '" height="' . $this->oCRNRSTN->return_database_value('RELAY_COLORS_DATA', 'COLORS_IMG_HEIGHT') . '" title="' . $this->oCRNRSTN->return_database_value('RELAY_COLORS_DATA', 'STREAM_COLORS_KEY') . '" alt="' . $this->oCRNRSTN->return_database_value('RELAY_COLORS_DATA', 'STREAM_COLORS_KEY') . '"></div></div>
                        <div id="bassdrive_broadcast_scroller_wrapper">
                            <div id="bassdrive_broadcast_scroller_dyn_wrapper"></div>
                            <div class="cb"></div>
                        </div>
                        <div class="hidden">
                            <div id="bassdrive_broadcast_nation_thumb_width">' . $this->oCRNRSTN->return_database_value('RELAY_COLORS_DATA', 'COLORS_IMG_WIDTH') . '</div>
                            <div id="broadcast_show_original_title">' . $show_title_ARRAY['title'] . '</div>
                            <div id="broadcast_locale">' . $this->oCRNRSTN->return_database_value('RELAY_LOCALE_DATA', 'LOCALE_COPY') . '</div>
                            <div id="broadcast_nation_img">' . $this->oCRNRSTN->return_database_value('RELAY_COLORS_DATA', 'COLORS_IMG_FILENAME') . '</div>
                            <div id="broadcast_nation_title">' . $this->oCRNRSTN->return_database_value('RELAY_COLORS_DATA', 'STREAM_COLORS_KEY') . '</div>
                            <div id="broadcast_is_LIVE">' . $show_title_ARRAY['is_live'] . '</div>
                            <div id="component_tech_integration_driver">SERVER</div>
                        </div>
                    </div>';

        return $tmp_html;

    }

    private function return_show_title_html($show_title, $return_meta_array = true){

        $tmp_array = array();

        $tmp_pos_dash = strpos($show_title, ' - ');
        $tmp_pos_hosted = strpos($show_title, 'hosted');

        if($tmp_pos_dash !== false){

            $show_title_ARRAY = explode(' - ', $show_title);

            if(count($show_title_ARRAY) > 2){

                $tmp_title = trim($show_title_ARRAY[0]);
                $tmp_title .= ' '.trim($show_title_ARRAY[1]);

                $tmp_host = $show_title_ARRAY[2];

                if(isset($show_title_ARRAY[3])){
                    $tmp_host = $tmp_host . ' ' . $show_title_ARRAY[3];
                }

                if(isset($show_title_ARRAY[4])){
                    $tmp_host = $tmp_host . ' ' . $show_title_ARRAY[4];
                }

                $tmp_title = trim($tmp_title);
                $tmp_host = trim($tmp_host);

            }else{

                $tmp_title = $show_title_ARRAY[0];
                $tmp_host = $show_title_ARRAY[1];

                $tmp_title = trim($tmp_title);
                $tmp_host = trim($tmp_host);

            }

        }else{

            if($tmp_pos_hosted !== false){

                $show_title_ARRAY = explode('hosted', $show_title);

                $tmp_title = $show_title_ARRAY[0];
                $tmp_host = 'hosted' . $show_title_ARRAY[1];

                $tmp_title = trim($tmp_title);
                $tmp_host = trim($tmp_host);

            }else{

                $tmp_title = $show_title;
                $tmp_host = '';

                $tmp_title = trim($tmp_title);

            }

        }

        if($tmp_host!=""){

            $tmp_stream_title = $tmp_title . '<br><span class="player-host">' . $tmp_host.'</span>';

        }else{

            $tmp_stream_title = $tmp_title;

        }

        $tmp_stream_title = $this->clean_zero_out($tmp_stream_title);
        $tmp_stream_title = $this->apply_title_formatting($tmp_stream_title);

        $tmp_ARRAY = array();
        $tmp_ARRAY['is_live'] = 'TRUE';

        //
        // IS LIVE CHECK
        $pos_replay_txt = strpos($tmp_stream_title,':: REPLAY');
        if($pos_replay_txt !== false){

            $tmp_ARRAY['is_live'] = 'FALSE';
            $pos_title = strpos($tmp_stream_title,'<br><span class="player-host">');
            if($pos_title !== false){

                $tmp_stream_title = $this->oCRNRSTN->proper_replace('<br><span class="player-host">', '<div class="cb_2"></div><span class="player-host">', $tmp_stream_title);

            }

        }

        $tmp_ARRAY['title'] = html_entity_decode($tmp_stream_title);

        if($return_meta_array){

            return $tmp_ARRAY;

        }else{

            return $tmp_ARRAY['title'];

        }

    }

    private function return_LIVE_ARRAY(){

        $tmp_array = array();

        $tmp_array[] = ' LIVE';
        $tmp_array[] = ' Live ';
        $tmp_array[] = ' live ';
        $tmp_array[] = 'LIVE!!!';
        $tmp_array[] = ' LIVE!';
        $tmp_array[] = 'LIVE!';
        $tmp_array[] = 'Live!!';
        $tmp_array[] = 'Live!';
        $tmp_array[] = '*LIVE*';
        $tmp_array[] = 'Live';

        return $tmp_array;

    }

    private function return_HYPER_ARRAY(){

        $tmp_array = array();

        $tmp_array[] = 'www.Facebook.com/NateReflect';
        $tmp_array[] = 'soundcloud.com/LQDAudio';
        $tmp_array[] = 'Facebook.com/JasonMagin';
        $tmp_array[] = 'facebook.com/impression23';
        $tmp_array[] = 'fb.com/schematicdnb';
        $tmp_array[] = 'www.djspim.com';
        $tmp_array[] = 'www.northerngroove.co.uk/';
        $tmp_array[] = 'https://xo.am/';
        $tmp_array[] = '@bdxposure';
        $tmp_array[] = 'fb.com/DrumObsession';
        $tmp_array[] = 'tweet@DrumObsessionPL';
        $tmp_array[] = 'insta/impression_ucr';
        $tmp_array[] = 'Insta@fuzedfunk';
        $tmp_array[] = '@warmearsmusic';
        $tmp_array[] = 'fb.com/thebryangee';
        $tmp_array[] = '@schematicdnb';
        $tmp_array[] = 'FB/impression2377';
        $tmp_array[] = 'facebook.com/louis.overfiend';
        $tmp_array[] = 'www.facebook.com/NateReflect';
        $tmp_array[] = 'www.soundcloud.com/amnesty';
        $tmp_array[] = 'Random_Movement';
        $tmp_array[] = 'RandomMovementMusic';
        $tmp_array[] = 'Facebook.com/DLO.DNB';
        $tmp_array[] = 'www.northerngroove.co.uk';
        $tmp_array[] = 'www.facebook.com/operondnb';
        $tmp_array[] = 'fb.com/louis.overfiend';

        return $tmp_array;

    }

    public function return_LINK_ARRAY(){

        $tmp_array = array();

        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.facebook.com/NateReflect" target="_blank">www.Facebook.com/NateReflect</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://soundcloud.com/LQDAudio" target="_blank">soundcloud.com/LQDAudio</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.facebook.com/JasonMagin" target="_blank">Facebook.com/JasonMagin</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.Facebook.com/impression23" target="_blank">facebook.com/impression23</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.facebook.com/schematicdnb" target="_blank">fb.com/schematicdnb</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="http://www.djspim.com" target="_blank">www.djspim.com</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="http://www.northerngroove.co.uk/" target="_blank">www.northerngroove.co.uk/</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://xo.am/" target="_blank">https://xo.am/</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://twitter.com/bdxposure" target="_blank">@bdxposure</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.facebook.com/drumobsession" target="_blank">fb.com/DrumObsession</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://twitter.com/DrumObsessionPL" target="_blank">tweet@DrumObsessionPL</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.instagram.com/impression_ucr/" target="_blank">insta/impression_ucr</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.instagram.com/fuzedfunk/" target="_blank">Insta/fuzedfunk</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.instagram.com/warmearsmusic/" target="_blank">@warmearsmusic</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.facebook.com/thebryangee/" target="_blank">fb.com/thebryangee</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.facebook.com/schematicdnb/" target="_blank">@schematicdnb</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.facebook.com/Impression2377/" target="_blank">FB/impression2377</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.facebook.com/louis.overfiend/" target="_blank">facebook.com/louis.overfiend</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.facebook.com/NateReflect/" target="_blank">www.facebook.com/NateReflect</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://soundcloud.com/amnesty" target="_blank">www.soundcloud.com/amnesty</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://twitter.com/random_movement" target="_blank">Random_Movement</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.instagram.com/Randommovementmusic/" target="_blank">RandomMovementMusic</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.facebook.com/DLO.DNB" target="_blank">Facebook.com/DLO.DNB</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="http://www.northerngroove.co.uk/" target="_blank">www.northerngroove.co.uk</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.facebook.com/operondnb" target="_blank">www.facebook.com/operondnb</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.facebook.com/louis.overfiend" target="_blank">fb.com/louis.overfiend</a>';

        return $tmp_array;

    }

    private function return_MONTH_ARRAY(){

        $tmp_array = array();

        $tmp_array[] = 'Jan';
        $tmp_array[] = 'Feb';
        $tmp_array[] = 'Mar';
        $tmp_array[] = 'Apr';
        $tmp_array[] = 'May';
        $tmp_array[] = 'Jun';
        $tmp_array[] = 'Jul';
        $tmp_array[] = 'Aug';
        $tmp_array[] = 'Sept';
        $tmp_array[] = 'Oct';
        $tmp_array[] = 'Nov';
        $tmp_array[] = 'Dec';

        return $tmp_array;

    }

    private function return_DAY_ARRAY(){

        $tmp_array = array();

        for($i=31; $i>0; $i--){

            $tmp_array[] = $i;

        }

        return $tmp_array;

    }

    private function return_specialty_ARRAY(){

        $tmp_array = array();

        $tmp_array[] = 'Wadjit (Canada)';
        $tmp_array[] = 'Wadjit (CAN)';
        $tmp_array[] = 'Wadjit (CANADA)';
        $tmp_array[] = 'Wadjit (canada)';
        $tmp_array[] = 'Wadjit (can)';
        $tmp_array[] = 'THE GREENROOM';
        $tmp_array[] = 'Blu Saphir';
        $tmp_array[] = 'The Launch Pad with Dj Handy';

        return $tmp_array;

    }

    private function return_specialty_output_ARRAY(){

        $tmp_array = array();

        $tmp_array[] = 'Wadjit '.'<img src="' . $this->oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/canada_thumb.gif" width="33" height="16" alt="Canada" title="Canada">';
        $tmp_array[] = 'Wadjit '.'<img src="' . $this->oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/canada_thumb.gif" width="33" height="16" alt="Canada" title="Canada">';
        $tmp_array[] = 'Wadjit '.'<img src="' . $this->oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/canada_thumb.gif" width="33" height="16" alt="Canada" title="Canada">';
        $tmp_array[] = 'Wadjit '.'<img src="' . $this->oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/canada_thumb.gif" width="33" height="16" alt="Canada" title="Canada">';
        $tmp_array[] = 'Wadjit '.'<img src="' . $this->oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/canada_thumb.gif" width="33" height="16" alt="Canada" title="Canada">';
        $tmp_array[] = '<span style="color:#06730A; font-weight: bold; font-size: 110%;">THE GREENROOM</span>';
        $tmp_array[] = '<span style="color:#3133D5; font-weight: bold;">Blu Saphir</span>';
        $tmp_array[] = 'The Launch Pad<br>with Dj Handy';

        return $tmp_array;

    }

    private function return_bassdrive_situation_ARRAY($return_count = 1){

        $tmp_bass_situation_ARRAY = array();

        $tmp_bass_situation_ARRAY[] = 'rolling beats';
        $tmp_bass_situation_ARRAY[] = 'straight fire';
        $tmp_bass_situation_ARRAY[] = 'good vibes';
        $tmp_bass_situation_ARRAY[] = 'hella tunes';
        $tmp_bass_situation_ARRAY[] = 'the sweep attacks';
        $tmp_bass_situation_ARRAY[] = 'sweep attacks';
        $tmp_bass_situation_ARRAY[] = 'the flying technique';
        $tmp_bass_situation_ARRAY[] = 'the ding-dong bass';
        $tmp_bass_situation_ARRAY[] = 'liquid fire';
        $tmp_bass_situation_ARRAY[] = 'soundboy burial';
        $tmp_bass_situation_ARRAY[] = 'the u&ntilde;ta selecta';
        $tmp_bass_situation_ARRAY[] = 'straight liquid fire';
        $tmp_bass_situation_ARRAY[] = 'the BOH BOH BOH\'s';
        $tmp_bass_situation_ARRAY[] = 'the BOH! BOH! BOH\'s!';
        $tmp_bass_situation_ARRAY[] = 'the BOH\'s';
        $tmp_bass_situation_ARRAY[] = 'the jungle bounce';
        $tmp_bass_situation_ARRAY[] = 'lighters held up';
        $tmp_bass_situation_ARRAY[] = 'lighters up';
        $tmp_bass_situation_ARRAY[] = 'lighters in the air';
        $tmp_bass_situation_ARRAY[] = 'hella vibes';
        $tmp_bass_situation_ARRAY[] = 'the smile\'n and the vibe\'n';
        $tmp_bass_situation_ARRAY[] = 'much love';
        $tmp_bass_situation_ARRAY[] = 'raised hand hearts';
        $tmp_bass_situation_ARRAY[] = 'hand hearts';
        $tmp_bass_situation_ARRAY[] = 'palm trees';
        $tmp_bass_situation_ARRAY[] = 'the funky funk';
        $tmp_bass_situation_ARRAY[] = 'the funk';
        $tmp_bass_situation_ARRAY[] = 'the funky business';

        $tmp_ARRAY = array();
        for($i = 0; $i < $return_count; $i++){

            $tmp_status = array_rand(array_flip($tmp_bass_situation_ARRAY), 1);

            if(!in_array($tmp_status, $tmp_ARRAY)){

                $tmp_ARRAY[] = $tmp_status;

            }else{

                $i--;

            }

        }

        return $tmp_ARRAY;

    }

    public function proper_replace($pattern, $replacement, $original_str){

        $pattern_array[0] = $pattern;
        $replacement_array[0] = $replacement;

        $original_str = str_replace($pattern_array, $replacement_array, $original_str);

        return $original_str;

    }

    private function apply_title_formatting($str){

        $tmp_wrk_str = $str;

        //
        // BUILD STATIC ARRAY DATA SETS
        $bassdrive_for_BOLD_RED = $this->return_LIVE_ARRAY();
        $bassdrive_find_HYPER_LNK = $this->return_HYPER_ARRAY();
        $bassdrive_replace_HYPER_LNK = $this->return_LINK_ARRAY();
        $bassdrive_month = $this->return_MONTH_ARRAY();
        $bassdrive_day = $this->return_DAY_ARRAY();
        $bassdrive_specialty = $this->return_specialty_ARRAY();
        $bassdrive_specialty_out = $this->return_specialty_output_ARRAY();

        $tmp_LIVE_cnt = sizeof($bassdrive_for_BOLD_RED);
        $tmp_HYPER_cnt = sizeof($bassdrive_find_HYPER_LNK);
        $tmp_MONTH_cnt = sizeof($bassdrive_month);
        $tmp_DAY_cnt = sizeof($bassdrive_day);
        $tmp_SPECIAL_cnt = sizeof($bassdrive_specialty);
        $tmp_SPECIALOUT_cnt = sizeof($bassdrive_specialty_out);

        //
        // FORMAT LIVE TO BE RED AND BOLD
        for($i = 0; $i < $tmp_LIVE_cnt; $i++){

            $tmp_LIVE_pattern = $bassdrive_for_BOLD_RED[$i];

            $pos = stripos($tmp_wrk_str, $tmp_LIVE_pattern);
            if($pos !== false){

                $tmp_LIVE_replace = '<span style="color:#F00; font-weight: bold;">' . $tmp_LIVE_pattern .'</span>';

                $tmp_wrk_str = $this->oCRNRSTN->proper_replace($tmp_LIVE_pattern, $tmp_LIVE_replace, $tmp_wrk_str);

                $i = $tmp_LIVE_cnt+1;

            }

        }

        //
        // FORMAT TEXT LINK STRINGS TO BE ANCHOR TAGGED
        for($i=0;$i<$tmp_HYPER_cnt;$i++){

            $tmp_HYPER_pattern = $bassdrive_find_HYPER_LNK[$i];

            $pos = strpos($tmp_wrk_str, $tmp_HYPER_pattern);
            if($pos!==false){

                $tmp_wrk_str = $this->oCRNRSTN->proper_replace($tmp_HYPER_pattern, $bassdrive_replace_HYPER_LNK[$i], $tmp_wrk_str);

            }

        }

        $isLIVE = true;

        //
        // IS REPLAY HTML INDICATOR
        for($i = 0; $i < $tmp_MONTH_cnt; $i++){

            for($ii=0; $ii<$tmp_DAY_cnt; $ii++){

                $tmp_date_pos = strpos($tmp_wrk_str, $bassdrive_month[$i].' ' . $bassdrive_day[$ii]);
                if($tmp_date_pos !== false){

                    $tmp_wrk_str = $this->oCRNRSTN->proper_replace($bassdrive_month[$i].' ' . $bassdrive_day[$ii], '<span style="background-color: #CF0202; color:#FFF; font-size:11px; font-weight:normal; padding:1px 3px 1px 3px; border-radius: 15px;"><span style="color:#CF0202;">_</span> ' . $bassdrive_month[$i].' ' . $bassdrive_day[$ii].' :: REPLAY <span style="color:#CF0202;">_</span></span>', $tmp_wrk_str);
                    $i = $tmp_MONTH_cnt + 1;
                    $ii = $tmp_DAY_cnt + 1;
                    $isLIVE = false;

                }

            }

        }

        //
        // SPECIALTY STRING PATTERN REPLACE
        for($i=0; $i<$tmp_SPECIAL_cnt; $i++){

            $tmp_special_pos = strpos($tmp_wrk_str, $bassdrive_specialty[$i]);

            if($tmp_special_pos !== false){

                $tmp_wrk_str = $this->oCRNRSTN->proper_replace($bassdrive_specialty[$i], $bassdrive_specialty_out[$i], $tmp_wrk_str);

                $i = $tmp_SPECIAL_cnt + 1;

            }

        }

        return $tmp_wrk_str;

    }

    private function clean_zero_out($str){

        $patterns = array();
        $patterns[0] = "<br><span class=\"player-host\">0</span>";

        $replacements = array();
        $replacements[0] = '';

        $str = str_replace($patterns, $replacements, $str);

        return $str;

    }

    public function return_bassdrive_element($element_type){

        switch($element_type){
            case 'stream_title':

                //error_log(__LINE__ . ' ui tunnel $element_type=[' . $element_type . ']');
                return $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'TITLE_CONTENT');

            break;
            case 'stream_social':

                //error_log(__LINE__ . ' ui tunnel $element_type=[' . $element_type . ']');
                return $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'SOCIAL_CONTENT');

            break;
            case 'stream_colors':

                //error_log(__LINE__ . ' ui tunnel $element_type=[' . $element_type . ']');
                return $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'COLORS_CONTENT');

            break;
            case 'stream_stats':

                //error_log(__LINE__ . ' ui tunnel $element_type=[' . $element_type . ']');
                return $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'STATS_CONTENT');

            break;

        }

        return '';

    }

    private function load_jony5_lifestyle_images(){

        $tmp_query = 'SELECT `crnrstn_jony5_lifestyle_images`.`IMAGE_ID`,
            `crnrstn_jony5_lifestyle_images`.`ISACTIVE`,
            `crnrstn_jony5_lifestyle_images`.`DESCRIPTION_SEARCH`,
            `crnrstn_jony5_lifestyle_images`.`IMAGE_FILENAME_DESKTOP`,
            `crnrstn_jony5_lifestyle_images`.`IMAGE_FILENAME_TABLET`,
            `crnrstn_jony5_lifestyle_images`.`IMAGE_FILENAME_MOBILE`,
            `crnrstn_jony5_lifestyle_images`.`IMAGE_URI_DESKTOP_FULLSCREEN`,
            `crnrstn_jony5_lifestyle_images`.`IMAGE_URI_TABLET_FULLSCREEN`,
            `crnrstn_jony5_lifestyle_images`.`IMAGE_URI_MOBILE_FULLSCREEN`,
            `crnrstn_jony5_lifestyle_images`.`IMAGE_FILESIZE_DESKTOP`,
            `crnrstn_jony5_lifestyle_images`.`IMAGE_FILESIZE_TABLET`,
            `crnrstn_jony5_lifestyle_images`.`IMAGE_FILESIZE_MOBILE`,
            `crnrstn_jony5_lifestyle_images`.`IMAGE_FILESIZE_FULLSCREEN_DESKTOP`,
            `crnrstn_jony5_lifestyle_images`.`IMAGE_FILESIZE_FULLSCREEN_TABLET`,
            `crnrstn_jony5_lifestyle_images`.`IMAGE_FILESIZE_FULLSCREEN_MOBILE`,
            `crnrstn_jony5_lifestyle_images`.`IMAGE_FILESIZE_FORMAT`,
            `crnrstn_jony5_lifestyle_images`.`FILE_EXTENSION`,
            HEX(`crnrstn_jony5_lifestyle_images`.`IMAGE_MD5_DESKTOP`) AS `IMAGE_MD5_DESKTOP`,
            HEX(`crnrstn_jony5_lifestyle_images`.`IMAGE_MD5_TABLET`) AS `IMAGE_MD5_TABLET`,
            HEX(`crnrstn_jony5_lifestyle_images`.`IMAGE_MD5_MOBILE`) AS `IMAGE_MD5_MOBILE`,
            HEX(`crnrstn_jony5_lifestyle_images`.`IMAGE_MD5_FULLSCREEN_DESKTOP`) AS `IMAGE_MD5_FULLSCREEN_DESKTOP`,
            HEX(`crnrstn_jony5_lifestyle_images`.`IMAGE_MD5_FULLSCREEN_TABLET`) AS `IMAGE_MD5_FULLSCREEN_TABLET`,
            HEX(`crnrstn_jony5_lifestyle_images`.`IMAGE_MD5_FULLSCREEN_MOBILE`) AS `IMAGE_MD5_FULLSCREEN_MOBILE`,
            HEX(`crnrstn_jony5_lifestyle_images`.`IMAGE_SHA1_DESKTOP`) AS `IMAGE_SHA1_DESKTOP`,
            HEX(`crnrstn_jony5_lifestyle_images`.`IMAGE_SHA1_TABLET`) AS `IMAGE_SHA1_TABLET`,
            HEX(`crnrstn_jony5_lifestyle_images`.`IMAGE_SHA1_MOBILE`) AS `IMAGE_SHA1_MOBILE`,
            HEX(`crnrstn_jony5_lifestyle_images`.`IMAGE_SHA1_FULLSCREEN_DESKTOP`) AS `IMAGE_SHA1_FULLSCREEN_DESKTOP`,
            HEX(`crnrstn_jony5_lifestyle_images`.`IMAGE_SHA1_FULLSCREEN_TABLET`) AS `IMAGE_SHA1_FULLSCREEN_TABLET`,
            HEX(`crnrstn_jony5_lifestyle_images`.`IMAGE_SHA1_FULLSCREEN_MOBILE`) AS `IMAGE_SHA1_FULLSCREEN_MOBILE`,
            `crnrstn_jony5_lifestyle_images`.`TITLE`,
            `crnrstn_jony5_lifestyle_images`.`DESCRIPTION`,
            `crnrstn_jony5_lifestyle_images`.`DATEMODIFIED`,
            `crnrstn_jony5_lifestyle_images`.`DATECREATED`
        FROM `crnrstn_jony5_lifestyle_images`
        WHERE `crnrstn_jony5_lifestyle_images`.`ISACTIVE` = 1;';
        $tmp_result_set_key = $this->oCRNRSTN->load_query_profile('BASSDRIVE_UI_SUPPORT', '!jesus_is_my_dear_lord!', 'LIFESTYLE_IMAGES_DATA', __LINE__, __METHOD__);
        $this->oCRNRSTN->add_database_query($tmp_result_set_key, $tmp_query);

    }

    private function load_bassdrive_meta_data(){

        $tmp_query = 'SELECT `crnrstn_stream_relay`.`RELAY_ID`,
            `crnrstn_stream_relay`.`RELAY_TYPE`,
            `crnrstn_stream_relay`.`STREAM_URL`,
            `crnrstn_stream_relay`.`STREAM_URL_CRC32`,
            `crnrstn_stream_relay`.`STREAM_URL_IOS`,
            `crnrstn_stream_relay`.`ISACTIVE`,
            `crnrstn_stream_relay`.`BASSDRIVE_LOG_ID`,
            `crnrstn_stream_relay`.`BITRATE`,
            `crnrstn_stream_relay`.`STATUS`,
            `crnrstn_stream_relay`.`NAME`,
            `crnrstn_stream_relay`.`LISTENER_COUNT`,
            `crnrstn_stream_relay`.`LISTENER_COUNT_PERCENTAGE`,
            `crnrstn_stream_relay`.`AUDIO_FORMAT`,
            `crnrstn_stream_relay`.`TITLE`,
            `crnrstn_stream_relay`.`TITLE_CHECKSUM_MD5`,
            `crnrstn_stream_relay`.`STREAM_KEY`,
            `crnrstn_stream_relay`.`STREAM_KEY_MD5`,
            `crnrstn_stream_relay`.`IS_REPLAY`,
            `crnrstn_stream_relay`.`STATS_TOTAL_CONNECTIONS`,
            `crnrstn_stream_relay`.`STATS_TOTAL_CAPACITY`,
            `crnrstn_stream_relay`.`STATS_TOTAL_BANDWIDTH`,
            `crnrstn_stream_relay`.`STATS_TOTAL_BANDWIDTH_FORMAT`,
            `crnrstn_stream_relay`.`STATS_TOTAL_UNIQUE_CONNECTIONS`,
            `crnrstn_stream_relay`.`STATS_TOTAL_UNIQUE_CAPACITY`,
            `crnrstn_stream_relay`.`STATS_TOTAL_UNIQUE_BANDWIDTH`,
            `crnrstn_stream_relay`.`STATS_TOTAL_UNIQUE_BANDWIDTH_FORMAT`,
            `crnrstn_stream_relay`.`STATS_PREMIUM_BITRATE`,
            `crnrstn_stream_relay`.`STATS_PREMIUM_BITRATE_FORMAT`,
            `crnrstn_stream_relay`.`STATS_PREMIUM_CONNECTIONS`,
            `crnrstn_stream_relay`.`STATS_PREMIUM_CAPACITY`,
            `crnrstn_stream_relay`.`STATS_PREMIUM_BANDWIDTH`,
            `crnrstn_stream_relay`.`STATS_PREMIUM_BANDWIDTH_FORMAT`,
            `crnrstn_stream_relay`.`STATS_MIDGRADE_BITRATE`,
            `crnrstn_stream_relay`.`STATS_MIDGRADE_BITRATE_FORMAT`,
            `crnrstn_stream_relay`.`STATS_MIDGRADE_CONNECTIONS`,
            `crnrstn_stream_relay`.`STATS_MIDGRADE_CAPACITY`,
            `crnrstn_stream_relay`.`STATS_MIDGRADE_BANDWIDTH`,
            `crnrstn_stream_relay`.`STATS_MIDGRADE_BANDWIDTH_FORMAT`,
            `crnrstn_stream_relay`.`STATS_AAC_PLUS_BITRATE`,
            `crnrstn_stream_relay`.`STATS_AAC_PLUS_BITRATE_FORMAT`,
            `crnrstn_stream_relay`.`STATS_AAC_PLUS_CONNECTIONS`,
            `crnrstn_stream_relay`.`STATS_AAC_PLUS_CAPACITY`,
            `crnrstn_stream_relay`.`STATS_AAC_PLUS_BANDWIDTH`,
            `crnrstn_stream_relay`.`STATS_AAC_PLUS_BANDWIDTH_FORMAT`,
            `crnrstn_stream_relay`.`STATS_RANDOM_BITRATE`,
            `crnrstn_stream_relay`.`STATS_RANDOM_BITRATE_FORMAT`,
            `crnrstn_stream_relay`.`STATS_RANDOM_CONNECTIONS`,
            `crnrstn_stream_relay`.`STATS_RANDOM_CAPACITY`,
            `crnrstn_stream_relay`.`STATS_RANDOM_BANDWIDTH`,
            `crnrstn_stream_relay`.`STATS_RANDOM_BANDWIDTH_FORMAT`,
            `crnrstn_stream_relay`.`DATEMODIFIED`,
            `crnrstn_stream_relay`.`DATECREATED`
        FROM `crnrstn_stream_relay`
        WHERE `crnrstn_stream_relay`.`ISACTIVE` = 1;';
        $tmp_result_set_key = $this->oCRNRSTN->load_query_profile('BASSDRIVE_UI_SUPPORT', '!jesus_is_my_dear_lord!', 'RELAY_CURRENT_DATA', __LINE__, __METHOD__);
        $this->oCRNRSTN->add_database_query($tmp_result_set_key, $tmp_query);

        $tmp_query = 'SELECT `crnrstn_stream_relay_meta_lookup`.`META_LOOKUP_ID`,
            `crnrstn_stream_relay_meta_lookup`.`STREAM_KEY`,
            `crnrstn_stream_relay_meta_lookup`.`RELAY_REPORTING_SHARD_ID`,
            `crnrstn_stream_relay_meta_lookup`.`LOCALE_ID`,
            `crnrstn_stream_relay_meta_lookup`.`ABOUT_ID`,
            `crnrstn_stream_relay_meta_lookup`.`COLORS_ID`,
            `crnrstn_stream_relay_meta_lookup`.`STREAM_COLORS_KEY`,
            `crnrstn_stream_relay_meta_lookup`.`DATEMODIFIED`
        FROM `crnrstn_stream_relay_meta_lookup`
        WHERE `crnrstn_stream_relay_meta_lookup`.`ISACTIVE` = 8 LIMIT 1;';
        $tmp_result_set_key = $this->oCRNRSTN->load_query_profile('BASSDRIVE_UI_SUPPORT', '!jesus_is_my_dear_lord!', 'RELAY_META_LOOKUP_DATA', __LINE__, __METHOD__);
        $this->oCRNRSTN->add_database_query($tmp_result_set_key, $tmp_query);

        //
        // PROCESS ALL QUERY TO CONNECTION(S)
        $this->oCRNRSTN->process_query();

        $tmp_STREAM_KEY = $this->oCRNRSTN->return_database_value('RELAY_META_LOOKUP_DATA', 'STREAM_KEY');
        $tmp_RELAY_REPORTING_SHARD_ID = $this->oCRNRSTN->return_database_value('RELAY_META_LOOKUP_DATA', 'RELAY_REPORTING_SHARD_ID');
        $tmp_LOCALE_ID = $this->oCRNRSTN->return_database_value('RELAY_META_LOOKUP_DATA', 'LOCALE_ID');
        $tmp_COLORS_ID = $this->oCRNRSTN->return_database_value('RELAY_META_LOOKUP_DATA', 'COLORS_ID');
        $tmp_STREAM_COLORS_KEY = $this->oCRNRSTN->return_database_value('RELAY_META_LOOKUP_DATA', 'STREAM_COLORS_KEY');

        $tmp_query = 'SELECT `crnrstn_stream_relay_social`.`SOCIAL_ID`,
            `crnrstn_stream_relay_social`.`STREAM_KEY`,
            `crnrstn_stream_relay_social`.`SOCIAL_MEDIA_KEY`,
            `crnrstn_stream_relay_social`.`CLICKTHROUGH_URL`,
            `crnrstn_stream_relay_social`.`CLICKTHROUGH_COUNT`,
            `crnrstn_stream_relay_social`.`DATEMODIFIED`
        FROM `crnrstn_stream_relay_social`
        WHERE `crnrstn_stream_relay_social`.`STREAM_KEY` = "' . $this->mysqli->real_escape_string($tmp_STREAM_KEY) . '"
        AND `crnrstn_stream_relay_social`.`STREAM_KEY_CRC32` = ' . $this->oCRNRSTN->hash($tmp_STREAM_KEY, 'crc32') . '
        AND `crnrstn_stream_relay_social`.`ISACTIVE` = 1 ORDER BY `DISPLAY_SEQUENCE` ASC;';
        $tmp_result_set_key = $this->oCRNRSTN->load_query_profile('BASSDRIVE_UI_SUPPORT', '!jesus_is_my_dear_lord!', 'RELAY_SOCIAL_DATA', __LINE__, __METHOD__);
        $this->oCRNRSTN->add_database_query($tmp_result_set_key, $tmp_query);

        $tmp_query = 'SELECT `crnrstn_stream_relay_locale`.`LOCALE_ID`,
            `crnrstn_stream_relay_locale`.`STREAM_KEY`,
            `crnrstn_stream_relay_locale`.`LOCALE_COPY`,
            `crnrstn_stream_relay_locale`.`LOCALE_URL`,
            `crnrstn_stream_relay_locale`.`LOCALE_DESCRIPTION`,
            `crnrstn_stream_relay_locale`.`DATEMODIFIED`
        FROM `crnrstn_stream_relay_locale`
        WHERE `crnrstn_stream_relay_locale`.`LOCALE_ID` = "' . $this->mysqli->real_escape_string($tmp_LOCALE_ID) . '"
        AND `crnrstn_stream_relay_locale`.`LOCALE_ID_CRC32` = ' . $this->oCRNRSTN->crcINT($tmp_LOCALE_ID) . '
        AND `crnrstn_stream_relay_locale`.`STREAM_KEY` = "' . $this->mysqli->real_escape_string($tmp_STREAM_KEY) . '"
        AND `crnrstn_stream_relay_locale`.`STREAM_KEY_CRC32` = ' . $this->oCRNRSTN->crcINT($tmp_STREAM_KEY) . '
        AND `crnrstn_stream_relay_locale`.`ISACTIVE` = 1 LIMIT 1;';
        $tmp_result_set_key = $this->oCRNRSTN->load_query_profile('BASSDRIVE_UI_SUPPORT', '!jesus_is_my_dear_lord!', 'RELAY_LOCALE_DATA', __LINE__, __METHOD__);
        $this->oCRNRSTN->add_database_query($tmp_result_set_key, $tmp_query);

        $tmp_query = 'SELECT `crnrstn_stream_relay_colors`.`COLORS_ID`,
            `crnrstn_stream_relay_colors`.`STREAM_COLORS_KEY`,
            `crnrstn_stream_relay_colors`.`ISACTIVE`,
            `crnrstn_stream_relay_colors`.`COLORS_IMG_FILENAME`,
            `crnrstn_stream_relay_colors`.`COLORS_IMG_WIDTH`,
            `crnrstn_stream_relay_colors`.`COLORS_IMG_HEIGHT`,
            `crnrstn_stream_relay_colors`.`DATEMODIFIED`
        FROM `crnrstn_stream_relay_colors`
        WHERE `crnrstn_stream_relay_colors`.`COLORS_ID` = "' . $this->mysqli->real_escape_string($tmp_COLORS_ID) . '"
        AND `crnrstn_stream_relay_colors`.`COLORS_ID_CRC32` = ' . $this->oCRNRSTN->crcINT($tmp_COLORS_ID) . '
        AND `crnrstn_stream_relay_colors`.`STREAM_COLORS_KEY` = "' . $this->mysqli->real_escape_string($tmp_STREAM_COLORS_KEY) . '"
        AND `crnrstn_stream_relay_colors`.`STREAM_COLORS_KEY_CRC32` = ' . $this->oCRNRSTN->crcINT($tmp_STREAM_COLORS_KEY) . '
        AND `crnrstn_stream_relay_colors`.`ISACTIVE` = 1 LIMIT 1;';
        $tmp_result_set_key = $this->oCRNRSTN->load_query_profile('BASSDRIVE_UI_SUPPORT', '!jesus_is_my_dear_lord!', 'RELAY_COLORS_DATA', __LINE__, __METHOD__);
        $this->oCRNRSTN->add_database_query($tmp_result_set_key, $tmp_query);

        $tmp_query = 'SELECT `crnrstn_stream_relay_reporting_shards`.`RELAY_REPORTING_SHARD_ID`,
            `crnrstn_stream_relay_reporting_shards`.`TABLE_STRING_PATTERN`,
            `crnrstn_stream_relay_reporting_shards`.`ISACTIVE`,
            `crnrstn_stream_relay_reporting_shards`.`MAXIMUM_STREAM_COUNT`,
            `crnrstn_stream_relay_reporting_shards`.`DATEMODIFIED`,
            `crnrstn_stream_relay_reporting_shards`.`DATECREATED`
        FROM `crnrstn_stream_relay_reporting_shards`
        WHERE `crnrstn_stream_relay_reporting_shards`.`RELAY_REPORTING_SHARD_ID` = "' . $tmp_RELAY_REPORTING_SHARD_ID . '"
        AND `crnrstn_stream_relay_reporting_shards`.`RELAY_REPORTING_SHARD_ID_CRC32`= ' . $this->oCRNRSTN->crcINT($tmp_RELAY_REPORTING_SHARD_ID) . ' LIMIT 1;';
        $tmp_result_set_key = $this->oCRNRSTN->load_query_profile('BASSDRIVE_UI_SUPPORT', '!jesus_is_my_dear_lord!', 'SHARD_PATTERN_DATA', __LINE__, __METHOD__);
        $this->oCRNRSTN->add_database_query($tmp_result_set_key, $tmp_query);

        //
        // PROCESS ALL QUERY TO CONNECTION(S)
        $this->oCRNRSTN->process_query();

    }

    public function load_bassdrive_cache_data(){

        if(!$this->oCRNRSTN->isset_query_result_set_key('CRNRSTN_CACHE_CHECKSUM_TTL_DATA')){

            $tmp_query = 'SELECT `crnrstn_jony5_content_version_checksums`.`CHECKSUM_PROFILE_ID`,
                `crnrstn_jony5_content_version_checksums`.`PROGRAM_KEY`,
                `crnrstn_jony5_content_version_checksums`.`DEVICE_TYPE_CHANNEL`,
                `crnrstn_jony5_content_version_checksums`.`CONTENT_CHECKSUM_TTL`,
                `crnrstn_jony5_content_version_checksums`.`TITLE_CHECKSUM`,
                `crnrstn_jony5_content_version_checksums`.`TITLE_CONTENT`,
                `crnrstn_jony5_content_version_checksums`.`TITLE_CONTENT_LOCK`,
                `crnrstn_jony5_content_version_checksums`.`TITLE_CONTENT_LOCK_TTL`,
                `crnrstn_jony5_content_version_checksums`.`TITLE_CONTENT_LOCK_ISACTIVE`,
                `crnrstn_jony5_content_version_checksums`.`SOCIAL_CHECKSUM`,
                `crnrstn_jony5_content_version_checksums`.`SOCIAL_CONTENT`,
                `crnrstn_jony5_content_version_checksums`.`SOCIAL_CONTENT_LOCK`,
                `crnrstn_jony5_content_version_checksums`.`SOCIAL_CONTENT_LOCK_TTL`,
                `crnrstn_jony5_content_version_checksums`.`SOCIAL_CONTENT_LOCK_ISACTIVE`,
                `crnrstn_jony5_content_version_checksums`.`COLORS_CHECKSUM`,
                `crnrstn_jony5_content_version_checksums`.`COLORS_CONTENT`,
                `crnrstn_jony5_content_version_checksums`.`COLORS_CONTENT_LOCK`,
                `crnrstn_jony5_content_version_checksums`.`COLORS_CONTENT_LOCK_TTL`,
                `crnrstn_jony5_content_version_checksums`.`COLORS_CONTENT_LOCK_ISACTIVE`,
                `crnrstn_jony5_content_version_checksums`.`STATS_CHECKSUM`,
                `crnrstn_jony5_content_version_checksums`.`STATS_CONTENT`,
                `crnrstn_jony5_content_version_checksums`.`STATS_CONTENT_LOCK`,
                `crnrstn_jony5_content_version_checksums`.`STATS_CONTENT_LOCK_TTL`,
                `crnrstn_jony5_content_version_checksums`.`STATS_CONTENT_LOCK_ISACTIVE`,
                `crnrstn_jony5_content_version_checksums`.`RELAY_CHECKSUM`,
                `crnrstn_jony5_content_version_checksums`.`RELAY_CONTENT`,
                `crnrstn_jony5_content_version_checksums`.`RELAY_CONTENT_LOCK`,
                `crnrstn_jony5_content_version_checksums`.`RELAY_CONTENT_LOCK_TTL`,
                `crnrstn_jony5_content_version_checksums`.`RELAY_CONTENT_LOCK_ISACTIVE`,
                `crnrstn_jony5_content_version_checksums`.`REPORTING_CHECKSUM`,
                `crnrstn_jony5_content_version_checksums`.`REPORTING_CONTENT`,
                `crnrstn_jony5_content_version_checksums`.`REPORTING_CONTENT_LOCK`,
                `crnrstn_jony5_content_version_checksums`.`REPORTING_CONTENT_LOCK_TTL`,
                `crnrstn_jony5_content_version_checksums`.`REPORTING_CONTENT_LOCK_ISACTIVE`,
                `crnrstn_jony5_content_version_checksums`.`WILDCARD_CHECKSUM`,
                `crnrstn_jony5_content_version_checksums`.`WILDCARD_CONTENT`,
                `crnrstn_jony5_content_version_checksums`.`WILDCARD_CONTENT_LOCK`,
                `crnrstn_jony5_content_version_checksums`.`WILDCARD_CONTENT_LOCK_TTL`,
                `crnrstn_jony5_content_version_checksums`.`WILDCARD_CONTENT_LOCK_ISACTIVE`,
                `crnrstn_jony5_content_version_checksums`.`DATEMODIFIED`,
                `crnrstn_jony5_content_version_checksums`.`DATECREATED`
            FROM `crnrstn_jony5_content_version_checksums`
            WHERE `crnrstn_jony5_content_version_checksums`.`PROGRAM_KEY` = "BASSDRIVE"
            AND (`crnrstn_jony5_content_version_checksums`.`DEVICE_TYPE_CHANNEL` = "DESKTOP"
            OR `crnrstn_jony5_content_version_checksums`.`DEVICE_TYPE_CHANNEL` = "' . $this->oCRNRSTN->device_type . '") LIMIT 1;';
            $tmp_result_set_key = $this->oCRNRSTN->load_query_profile('BASSDRIVE_UI_SUPPORT', '!jesus_is_my_dear_lord!', 'CRNRSTN_CACHE_CHECKSUM_TTL_DATA', __LINE__, __METHOD__);
            $this->oCRNRSTN->add_database_query($tmp_result_set_key, $tmp_query);

            //
            // PROCESS ALL QUERY TO CONNECTION(S)
            $this->oCRNRSTN->process_query();

        }


        $tmp_DATEMODIFIED = $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'DATEMODIFIED');
        $tmp_CONTENT_CHECKSUM_TTL = $this->oCRNRSTN->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'CONTENT_CHECKSUM_TTL');

        $tmp_ttl_standard = strtotime('-' . $tmp_CONTENT_CHECKSUM_TTL .' seconds');
        $tmp_content_freshness = strtotime($tmp_DATEMODIFIED);

        if($tmp_ttl_standard > $tmp_content_freshness){

            return false;

        }else{

            return true;

        }

    }

    private function data_aggregation_bassdrive_historical(){

        //
        // RELAY_HISTORICAL_DATA
        $tmp_IS_REPLAY = $this->oCRNRSTN->return_database_value('RELAY_CURRENT_DATA', 'IS_REPLAY');
        $tmp_STREAM_KEY = $this->oCRNRSTN->return_database_value('RELAY_META_LOOKUP_DATA', 'STREAM_KEY');
        $tmp_TABLE_STRING_PATTERN = $this->oCRNRSTN->return_database_value('SHARD_PATTERN_DATA', 'TABLE_STRING_PATTERN');

        $tmp_query = 'SELECT DISTINCT `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`BASSDRIVE_LOG_ID`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`RELAY_TIMESTAMP`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_TOTAL_CONNECTIONS`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_TOTAL_CAPACITY`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_TOTAL_BANDWIDTH`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_TOTAL_BANDWIDTH_FORMAT`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_TOTAL_UNIQUE_CONNECTIONS`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_TOTAL_UNIQUE_CAPACITY`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_TOTAL_UNIQUE_BANDWIDTH`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_TOTAL_UNIQUE_BANDWIDTH_FORMAT`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_PREMIUM_BITRATE`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_PREMIUM_BITRATE_FORMAT`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_PREMIUM_CONNECTIONS`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_PREMIUM_CAPACITY`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_PREMIUM_BANDWIDTH`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_PREMIUM_BANDWIDTH_FORMAT`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_MIDGRADE_BITRATE`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_MIDGRADE_BITRATE_FORMAT`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_MIDGRADE_CONNECTIONS`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_MIDGRADE_CAPACITY`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_MIDGRADE_BANDWIDTH`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_MIDGRADE_BANDWIDTH_FORMAT`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_AAC_PLUS_BITRATE`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_AAC_PLUS_BITRATE_FORMAT`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_AAC_PLUS_CONNECTIONS`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_AAC_PLUS_CAPACITY`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_AAC_PLUS_BANDWIDTH`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_AAC_PLUS_BANDWIDTH_FORMAT`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_RANDOM_BITRATE`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_RANDOM_BITRATE_FORMAT`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_RANDOM_CONNECTIONS`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_RANDOM_CAPACITY`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_RANDOM_BANDWIDTH`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_RANDOM_BANDWIDTH_FORMAT`
        FROM `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`
        WHERE `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STREAM_KEY` = "' . $this->mysqli->real_escape_string($tmp_STREAM_KEY) . '"
        AND `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STREAM_KEY_CRC32` = ' . $this->oCRNRSTN->crcINT($tmp_STREAM_KEY) . '
        AND `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`IS_REPLAY` = ' . $tmp_IS_REPLAY . '
        AND `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`RELAY_TIMESTAMP` > DATE_SUB(NOW(), INTERVAL 9 DAY)
        AND `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`RELAY_TIMESTAMP` < DATE_SUB(NOW(), INTERVAL 2 DAY)
        ORDER BY `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`RELAY_TIMESTAMP` ASC LIMIT 40;';
        $tmp_result_set_key = $this->oCRNRSTN->load_query_profile('BASSDRIVE_REPORTING', '!jesus_is_my_dear_lord!', 'RELAY_RECENT_DATA', __LINE__, __METHOD__);
        $this->oCRNRSTN->add_database_query($tmp_result_set_key, $tmp_query);

        $tmp_query = 'SELECT DISTINCT `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`BASSDRIVE_LOG_ID`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`RELAY_TIMESTAMP`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_TOTAL_CONNECTIONS`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_TOTAL_CAPACITY`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_TOTAL_BANDWIDTH`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_TOTAL_BANDWIDTH_FORMAT`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_TOTAL_UNIQUE_CONNECTIONS`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_TOTAL_UNIQUE_CAPACITY`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_TOTAL_UNIQUE_BANDWIDTH`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_TOTAL_UNIQUE_BANDWIDTH_FORMAT`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_PREMIUM_BITRATE`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_PREMIUM_BITRATE_FORMAT`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_PREMIUM_CONNECTIONS`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_PREMIUM_CAPACITY`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_PREMIUM_BANDWIDTH`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_PREMIUM_BANDWIDTH_FORMAT`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_MIDGRADE_BITRATE`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_MIDGRADE_BITRATE_FORMAT`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_MIDGRADE_CONNECTIONS`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_MIDGRADE_CAPACITY`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_MIDGRADE_BANDWIDTH`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_MIDGRADE_BANDWIDTH_FORMAT`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_AAC_PLUS_BITRATE`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_AAC_PLUS_BITRATE_FORMAT`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_AAC_PLUS_CONNECTIONS`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_AAC_PLUS_CAPACITY`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_AAC_PLUS_BANDWIDTH`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_AAC_PLUS_BANDWIDTH_FORMAT`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_RANDOM_BITRATE`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_RANDOM_BITRATE_FORMAT`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_RANDOM_CONNECTIONS`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_RANDOM_CAPACITY`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_RANDOM_BANDWIDTH`,
            `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STATS_RANDOM_BANDWIDTH_FORMAT`
        FROM `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`
        WHERE `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STREAM_KEY` = "' . $this->mysqli->real_escape_string($tmp_STREAM_KEY) . '"
        AND `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STREAM_KEY_CRC32` = ' . $this->oCRNRSTN->crcINT($tmp_STREAM_KEY) . '
        AND `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`IS_REPLAY` = ' . $tmp_IS_REPLAY . '
        AND `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`RELAY_TIMESTAMP` > DATE_SUB(NOW(), INTERVAL 2 MONTH)
        AND `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`RELAY_TIMESTAMP` < DATE_SUB(NOW(), INTERVAL 9 DAY)
        ORDER BY `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`RELAY_TIMESTAMP` ASC LIMIT 40;';
        $tmp_result_set_key = $this->oCRNRSTN->load_query_profile('BASSDRIVE_REPORTING', '!jesus_is_my_dear_lord!', 'RELAY_HISTORICAL_DATA', __LINE__, __METHOD__);
        $this->oCRNRSTN->add_database_query($tmp_result_set_key, $tmp_query);

        //
        // PROCESS ALL QUERY TO CONNECTION(S)
        $this->oCRNRSTN->process_query();

    }

    public function __destruct(){

    }

}