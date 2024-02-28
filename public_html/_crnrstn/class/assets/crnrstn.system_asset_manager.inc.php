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
#                   CRNRSTN :: is powered by eVifweb; CRNRSTN :: is powered by eCRM Strategy and Execution,
#                   Web Design & Development, and Only The Best Coffee.
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
#  CLASS :: crnrstn_system_asset_manager
#  VERSION :: 1.00.0000
#  DATE :: October 3, 2020 @ 1211hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI ::
#  DESCRIPTION :: Soo much HTML. Just wanted to put it some place nice.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#  Ezekiel 1:5a - AND FROM THE MIDST OF IT [FIRE] THERE CAME THE LIKENESS OF FOUR
#                 LIVING CREATURES.
#
class crnrstn_system_asset_manager {

    public $oCRNRSTN;
    public $oCRNRSTN_JS_CSS;

    protected $default_asset_mode;
    protected $output_mode_override;
    protected $system_file_serial;
    private static $method_request_mode;
    private static $request_salt;
    private static $image_output_mode;
    private static $asset_output_mode_ARRAY = array();

    private static $image_filesystem_meta_ARRAY = array();

    protected $framework_resource_ARRAY = array();
    protected $framework_file_output_serial_ARRAY = array();

    protected $min_js_original_flag;

    public function __construct($oCRNRSTN){

        $this->oCRNRSTN = $oCRNRSTN;

        $this->oCRNRSTN_JS_CSS = new crnrstn_client_assets($oCRNRSTN);

    }

    private function temp_unlock_min_js_flag_to_mode(){

        if(isset($this->min_js_original_flag)){

            if($this->min_js_original_flag){

                //
                // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                // # # C # R # N # R # S # T # N # : : # # # #
                // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                $this->oCRNRSTN->initialize_bit(CRNRSTN_JS_CSS_PROD_MIN, true);
                //error_log(__LINE__ . ' asset mgr TEMP TURN ON CRNRSTN_JS_CSS_PROD_MIN.');

            }else{

                //
                // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                // # # C # R # N # R # S # T # N # : : # # # #
                // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                $this->oCRNRSTN->initialize_bit(CRNRSTN_JS_CSS_PROD_MIN, false);
                //error_log(__LINE__ . ' asset mgr TEMP TURN OFF CRNRSTN_JS_CSS_PROD_MIN.');

            }

        }

        $this->min_js_original_flag = NULL;

        return true;

    }

    private function temp_lock_min_js_flag_to_mode($is_dev_mode){

        if(isset($is_dev_mode)){

            if($is_dev_mode == false){

                if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

                    $this->min_js_original_flag = true;

                    //
                    // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                    // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                    // # # C # R # N # R # S # T # N # : : # # # #
                    // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                    $this->oCRNRSTN->initialize_bit(CRNRSTN_JS_CSS_PROD_MIN, false);

                }

            }else{

                //$is_dev_mode == true
                if(!($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true)){

                    $this->min_js_original_flag = false;

                    //
                    // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                    // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                    // # # C # R # N # R # S # T # N # : : # # # #
                    // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                    $this->oCRNRSTN->initialize_bit(CRNRSTN_JS_CSS_PROD_MIN, true);

                }

            }

        }

    }

    public function return_html_head_asset($const, $footer_html_output = false, $is_dev_mode = NULL){

        switch($const){

            //
            // JS
            case CRNRSTN_JS_FRAMEWORK_JQUERY:
            case CRNRSTN_JS_FRAMEWORK_JQUERY_3_7_0:
            case CRNRSTN_JS_FRAMEWORK_JQUERY_3_6_1:
            case CRNRSTN_JS_FRAMEWORK_JQUERY_2_2_4:
            case CRNRSTN_JS_FRAMEWORK_JQUERY_1_12_4:
            case CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1:
            case CRNRSTN_JS_FRAMEWORK_JQUERY_UI:
            case CRNRSTN_JS_FRAMEWORK_JQUERY_UI_1_13_2:
            case CRNRSTN_JS_FRAMEWORK_JQUERY_UI_1_12_1:
            case CRNRSTN_JS_FRAMEWORK_JQUERY_MOBILE:
            case CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS:
            case CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_2_11_3:
            case CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_2_10_0:
            case CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_PLUS_JQUERY:
            case CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_2_03_3:
            case CRNRSTN_JS_FRAMEWORK_REACT_CDN:
            case CRNRSTN_JS_FRAMEWORK_REACT_CDN_18_2_0:
            case CRNRSTN_JS_FRAMEWORK_REACT_DOM_CDN:
            case CRNRSTN_JS_FRAMEWORK_REACT_DOM_CDN_18_2_0:
            case CRNRSTN_JS_FRAMEWORK_MITHRIL_CDN:
            case CRNRSTN_JS_FRAMEWORK_MITHRIL_CDN_2_2_2:
            case CRNRSTN_JS_FRAMEWORK_BACKBONE:
            case CRNRSTN_JS_FRAMEWORK_BACKBONE_1_4_1:
            case CRNRSTN_JS_FRAMEWORK_PROTOTYPE:
            case CRNRSTN_JS_FRAMEWORK_PROTOTYPE_1_7_3:
            case CRNRSTN_JS_FRAMEWORK_SCRIPTACULOUS:
            case CRNRSTN_JS_FRAMEWORK_PROTOTYPE_MOOFX:
            case CRNRSTN_JS_FRAMEWORK_MOOTOOLS_MORE:
            case CRNRSTN_JS_FRAMEWORK_MOOTOOLS_MORE_1_6_0:
            case CRNRSTN_JS_FRAMEWORK_MOOTOOLS_CORE:
            case CRNRSTN_JS_FRAMEWORK_MOOTOOLS_CORE_1_6_0:
            case CRNRSTN_JS_MAIN:

                //
                // STRING OUTPUT
                return $this->return_js_string_output($const, $footer_html_output, $is_dev_mode);

//
//                $this->temp_lock_min_js_flag_to_mode($is_dev_mode);
//                $tmp_array = $this->return_output_CRNRSTN_JS($const, $footer_html_output, $is_dev_mode);
//                $this->temp_unlock_min_js_flag_to_mode();
//                $tmp_output = '';
//
//                //
//                // LOAD OUTPUT
//                foreach($tmp_array as $key => $resource_content){
//
//                    $tmp_output .= $resource_content;
//
//                }
//
//                return $tmp_output;

            break;

            //
            // CSS
            case CRNRSTN_CSS_FRAMEWORK_SIMPLE_GRID:
            case CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM:
            case CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_24COL:
            case CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_16COL:
            case CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_12COL:
            case CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_24COL_RTL:
            case CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_16COL_RTL:
            case CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_12COL_RTL:
            case CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_RTL:
            case CRNRSTN_CSS_FRAMEWORK_FOUNDATION:
            case CRNRSTN_CSS_FRAMEWORK_FOUNDATION_6:
            case CRNRSTN_CSS_FRAMEWORK_HTML5_BOILERPLATE:
            case CRNRSTN_CSS_FRAMEWORK_HTML5_BOILERPLATE_8_0_0:
            case CRNRSTN_CSS_FRAMEWORK_RESPONSIVE_GRID_SYSTEM:
            case CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC:
            case CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_RTL:
            case CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_RESET:
            case CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_RESET_RTL:
            case CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_ADAPT:
            case CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_ADAPT_RTL:
            case CRNRSTN_CSS_FRAMEWORK_DEAD_SIMPLE_GRID:
            case CRNRSTN_CSS_FRAMEWORK_SKELETON:
            case CRNRSTN_CSS_FRAMEWORK_RWDGRID:
            case CRNRSTN_CSS_FRAMEWORK_RWDGRID_2_0:
            case CRNRSTN_CSS_FRAMEWORK_THIS_IS_DALLAS_SIMPLE_GRID:
            case CRNRSTN_CSS_MAIN_DESKTOP:
            case CRNRSTN_CSS_MAIN_TABLET:
            case CRNRSTN_CSS_MAIN_MOBILE:

                //
                // STRING OUTPUT
                return $this->return_css_string_output($const, $footer_html_output, $is_dev_mode);

//                $this->temp_lock_min_js_flag_to_mode($is_dev_mode);
//                $tmp_array = $this->return_output_CRNRSTN_CSS($const, $footer_html_output, $is_dev_mode);
//                $this->temp_unlock_min_js_flag_to_mode();
//
//                $tmp_output = '';
//
//                //
//                // LOAD OUTPUT
//                foreach($tmp_array as $key => $resource_content){
//
//                    $tmp_output .= $resource_content;
//
//                }
//
//                return $tmp_output;

            break;
            case CRNRSTN_CSS_MAIN_DESKTOP & CRNRSTN_JS_MAIN:

                return $this->return_js_css_string_output(CRNRSTN_JS_MAIN, CRNRSTN_CSS_MAIN_DESKTOP, $footer_html_output, $is_dev_mode);
//
//                $this->temp_lock_min_js_flag_to_mode($is_dev_mode);
//                $tmp_array_CSS = $this->return_output_CRNRSTN_CSS(CRNRSTN_CSS_MAIN_DESKTOP, $footer_html_output, $is_dev_mode);
//                $tmp_array_JS = $this->return_output_CRNRSTN_JS(CRNRSTN_JS_MAIN, $footer_html_output, $is_dev_mode);
//                $this->temp_unlock_min_js_flag_to_mode();
//                $tmp_output = '';
//
//                //
//                // LOAD OUTPUT
//                foreach($tmp_array_CSS as $key => $resource_content){
//
//                    $tmp_output .= $resource_content;
//
//                }
//
//                foreach($tmp_array_JS as $key => $resource_content){
//
//                    $tmp_output .= $resource_content;
//
//                }
//
//                return $tmp_output;

            break;

        }

        return false;

    }

    public function mapped_resource_html_output($resource_ARRAY, $asset_nom_hash, $footer_html_output){

        //
        // $resource_type = [js, css, integrations]
        $tmp_str = '';

        try{

            //error_log(__LINE__ .  ' asset mgr $resource_ARRAY[' . print_r($resource_ARRAY, true) . ']. $asset_nom_hash[' . $asset_nom_hash . ']. $footer_html_output[' . $footer_html_output . ']');

            //
            // TODO :: RE-ARCHITECT ALL RELEVANT USE-CASES. // Thursday, November 23, 2023 @ 1126 hrs.
            // THE POSSIBILITIES:
            //      $tmp_js_css_compress_mode = 'PROD'
            //      $tmp_js_css_compress_mode = 'DEV'
            //
            // SEE, $oCRNRSTN->tidy_boolean(CRNRSTN_JS_CSS_PROD_MIN, CRNRSTN_JS_CSS_PROD_MIN, CRNRSTN_JS_CSS_PROD_MIN);
            //
            $tmp_js_css_compress_mode = $this->oCRNRSTN->tidy_boolean(CRNRSTN_JS_CSS_PROD_MIN, CRNRSTN_JS_CSS_PROD_MIN, CRNRSTN_JS_CSS_PROD_MIN);
            switch($tmp_js_css_compress_mode){
                case 'DEV':
                    //

                    error_log(__LINE__ . ' asset mgr READY TO PROD/[' . $tmp_js_css_compress_mode . '<--] JS AND CSS USING TIDY_BOOLEAN().');

                break;
                default:
                    //case 'PROD':

                    error_log(__LINE__ . ' asset mgr READY TO [--->' . $tmp_js_css_compress_mode . ']/DEV JS AND CSS USING TIDY_BOOLEAN().');

                break;

            }

            //
            // TODO :: RE-ARCHITECT ALL RELEVANT USE-CASES. // Thursday, November 23, 2023 @ 1126 hrs.
            // THE POSSIBILITIES:
            //      $tmp_asset_mapping_mode = 'ON'
            //      $tmp_asset_mapping_mode = 'OFF'
            //
            // SEE, $oCRNRSTN->tidy_boolean(CRNRSTN_CSS_ASSET_MAPPING, CRNRSTN_CSS_ASSET_MAPPING, CRNRSTN_CSS_ASSET_MAPPING);
            //
            $tmp_asset_mapping_mode = $this->oCRNRSTN->tidy_boolean(CRNRSTN_CSS_ASSET_MAPPING, CRNRSTN_CSS_ASSET_MAPPING, CRNRSTN_CSS_ASSET_MAPPING);
            switch($tmp_asset_mapping_mode){
                case 'OFF':
                    //

                    error_log(__LINE__ . ' asset mgr READY TO ON/[' . $tmp_asset_mapping_mode . '<--] JS AND CSS USING TIDY_BOOLEAN().');

                break;
                default:
                    //case 'ON':

                    error_log(__LINE__ . ' asset mgr READY TO [--->' . $tmp_asset_mapping_mode . ']/DEV JS AND CSS USING TIDY_BOOLEAN().');

                break;

            }

            //
            // IF NO DELAY FOR OUTPUT...RUN. IF OUTPUT IS FOR FOOTER,...RUN.
            if($resource_ARRAY['asset_spool_delay_html_output_for_footer'] !== 'TRUE' || $footer_html_output == true){

                $tmp_build_html = true;

                //
                // DO WE BUILD HTML STRING DATA RETURN FOR RESOURCE?
                if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

                    //
                    // IF ASSET MIN MODE IS ACTIVE, BUT FILE IS NOT MIN, SKIP.
                    if($resource_ARRAY['asset_minimization_mode_is_active'][0] == 'TRUE' && $resource_ARRAY['file_is_minimized'][0] != 'TRUE'){

                        //
                        // DO NOT BUILD RESOURCE INTO HTML RESPONSE
                        $tmp_build_html = false;

                    }

                }else{

                    //
                    // IF ASSET MIN MODE IS ACTIVE, BUT FILE IS RECOGNIZED MIN, SKIP.
                    if($resource_ARRAY['asset_minimization_mode_is_active'][0] == 'TRUE' && $resource_ARRAY['file_is_minimized'][0] == 'TRUE'){

                        //
                        // DO NOT BUILD RESOURCE INTO HTML RESPONSE
                        $tmp_build_html = false;

                    }

                }

                //
                // DO WE BUILD?
                if($tmp_build_html && !isset($this->framework_file_output_serial_ARRAY[$asset_nom_hash])){

                    //
                    // FLAG THIS ASSET AS OUTPUTTED BY "FILE_PATH-FILE_NAME" HASH.
                    $this->framework_file_output_serial_ARRAY[$asset_nom_hash] = 1;
                    //$this->oCRNRSTN->print_r('PREPARING HTML RETURN FOR [' . print_r($this->framework_file_output_serial_ARRAY, true) . '].', NULL, NULL, __LINE__, __METHOD__, __FILE__);

                    //
                    // THIS SWITCHES OFF OF ASSET "STORAGE
                    // LOCATION INDICATOR" CONSTANT WITHIN
                    // CRNRSTN :: ...RATHER THAN AN
                    // INDICATION OF FILE HEADER RESPONSE
                    // MIME TYPE. THERE IS CSS IN THE JS
                    // FRAMEWORK PATH.
                    switch($resource_ARRAY['file_type_constant'][0]){
                        case CRNRSTN_CSS:

                            // SORRY.
                            // TONS OF REDUNDANCY HERE AS I AM
                            // EXPERIMENTING WITH DIFFERENT LINE BREAK
                            // TREATMENTS HAVING RESPECT TO CRNRSTN_JS_CSS_PROD_MIN.

                            //
                            // IS THIS JS?
                            if($resource_ARRAY['file_ext'][0] == 'js'){

                                if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

                                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_ASSET_MAPPING) == true){

                                        $tmp_nom = $resource_ARRAY['file_name'][0];
                                        if($resource_ARRAY['crnrstn_mod'][0] !== 0){

                                            $tmp_nom = $resource_ARRAY['crnrstn_mod'][0];

                                        }

                                        /*
                                        $tmp_ARRAY[$tmp_resource_hash]['resource_version_nom'][] = '    <!-- ' . $tmp_resource_meta_ARRAY['TITLE'] . ' v' . $tmp_resource_meta_ARRAY['VERSION'] . ' :: ' . $tmp_str_file_type_nom . $tmp_dependency_str . ' -->';
                                        $tmp_ARRAY[$tmp_resource_hash]['system_path_directory'][] = $tmp_path_directory;
                                        $tmp_ARRAY[$tmp_resource_hash]['system_http_root'][] = $tmp_http_root;
                                        $tmp_ARRAY[$tmp_resource_hash]['system_directory'][] = $tmp_system_directory;
                                        $tmp_ARRAY[$tmp_resource_hash]['resource_constant'][] = $resource_constant;
                                        $tmp_ARRAY[$tmp_resource_hash]['file_type_constant'][] = $file_type_constant;
                                        $tmp_ARRAY[$tmp_resource_hash]['crnrstn_mod'][] = $crnrstn_mod;
                                        $tmp_ARRAY[$tmp_resource_hash]['file_name'][] = $file_name;
                                        $tmp_ARRAY[$tmp_resource_hash]['file_path_original'][] = $file_path;
                                        $tmp_ARRAY[$tmp_resource_hash]['file_path'][] = $tmp_filepath;
                                        $tmp_ARRAY[$tmp_resource_hash]['path_root'][] = $tmp_path_root;
                                        $tmp_ARRAY[$tmp_resource_hash]['file_is_minimized'][] = $tmp_file_is_minimized_str;
                                        $tmp_ARRAY[$tmp_resource_hash]['asset_minimization_mode_is_active'][] = $tmp_asset_minimization_mode_is_active_str;
                                        $tmp_ARRAY[$tmp_resource_hash]['cache'][] = $tmp_cache;

                                        [Thu Dec 01 14:16:56.440270 2022] [:error] [pid 60949] [client 172.16.225.1:57746] 526 asset mgr [
                                        Array\n(\n
                                            [resource_version_nom] => Array\n        (\n
                                                [0] => LIGHTBOX v2.11.3 :: js [in support of CRNRSTN :: INTERACT UI/UX JS v1.00.0000 PRE-ALPHA-DEV (Lightsaber)]\n        )\n\n
                                            [system_path_directory] => Array\n        (\n
                                                [0] => /var/www/html/lightsaber.crnrstn.evifweb.com\n        )\n\n
                                            [asset_mapping_dir_path] => Array\n        (\n
                                                [0] => /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/ui\n        )\n\n
                                            [system_http_root] => Array\n        (\n
                                                [0] => http://172.16.225.139/lightsaber.crnrstn.evifweb.com/\n        )\n\n
                                            [system_directory] => Array\n        (\n
                                                [0] => _crnrstn\n        )\n\n
                                            [resource_constant] => Array\n        (\n
                                                [0] => 7308\n        )\n\n
                                            [file_type_constant] => Array\n        (\n
                                                [0] => 7208\n        )\n\n
                                            [file_name] => Array\n        (\n
                                                [0] => lightbox-2.11.3/css/lightbox.min.css\n        )\n\n
                                            [file_path_original] => Array\n        (\n
                                                [0] => /_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/css/lightbox.min.css\n        )\n\n
                                            [file_extension] => Array\n        (\n
                                                [0] => css\n        )\n\n
                                            [file_path] => Array\n        (\n
                                                [0] => /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/ui/js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/css/lightbox.min.css\n        )\n\n
                                            [path_root] => Array\n        (\n
                                                [0] => /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/ui/js\n        )\n\n
                                            [file_is_minimized] => Array\n        (\n
                                                [0] => TRUE\n        )\n\n
                                            [asset_minimization_mode_is_active] => Array\n        (\n
                                                [0] => TRUE\n        )\n\n
                                            [asset_spool_delay_html_output_for_footer] => Array\n        (\n
                                                [0] => FALSE\n        )\n\n
                                            [cache] => Array\n        (\n
                                                [0] => 420.00.2532.1669922199.0\n        )\n\n)\n].

                                        */

                                        //
                                        // CRNRSTN :: MULTI-CHANNEL APPLICATION ACCELERATION LAYER [session, ssdtla, cookie, database, runtime].
                                        $tmp_filepath = $resource_ARRAY['file_path'][0];
                                        $tmp_filename = $resource_ARRAY['file_name'][0];
                                        $tmp_file_extension = $resource_ARRAY['file_ext'][0];

                                        //
                                        // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA
                                        // OBJECT (MC-DDO) SERVICES LAYER.
                                        // # # C # R # N # R # S # T # N # : : # # # #
                                        //
                                        // PLEASE SEE,
                                        //  $oCRNRSTN->set_channel_config($channel_constant, $attribute_name, $data);
                                        //  $oCRNRSTN->get_channel_config($channel, $index_0 = NULL, $index_1 = NULL, $index_2 = NULL, $index_3 = NULL, $initialize = false);
                                        //  $oCRNRSTN->isset_channel_config($channel_constant, $attribute_name, $return_type = CRNRSTN_BOOLEAN);
                                        //  $oCRNRSTN->is_channel_active($channel_constant, $return_type = CRNRSTN_BOOLEAN)
                                        if($this->oCRNRSTN->get_channel_config(NULL, 'map_cache_is_active') == true){


                                            $this->oCRNRSTN->initialize_cache('css', $tmp_filename, $this->oCRNRSTN->asset_meta_key('css', $tmp_filename), CRNRSTN_JS, $tmp_filepath, $tmp_file_extension);
                                            //$this->oCRNRSTN->initialize_request($tmp_filename, 'css', CRNRSTN_JS, $this->oCRNRSTN->asset_meta_key('css', $tmp_filename));
                                            //$this->oCRNRSTN->initialize_response_map_cache('return_file_byte_chunked_buffer_output', CRNRSTN_JS, $tmp_filepath, $tmp_filename, $tmp_file_extension);

                                        }

                                        $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
    <script type="' . $resource_ARRAY['meta_type'][0] . '" src="' . $resource_ARRAY['system_http_root'][0] . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_nom . '&crnrstn_=' . $resource_ARRAY['cache'][0] . '"></script>
';

                                    }else{

                                        $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
    <script type="' . $resource_ARRAY['meta_type'][0] . '" src="' . $resource_ARRAY['system_http_root'][0] . $resource_ARRAY['system_directory'][0] . DIRECTORY_SEPARATOR . 'ui/js' . $resource_ARRAY['file_path_original'][0] . '?crnrstn_=' . $resource_ARRAY['cache'][0] . '"></script>
';

                                    }

                                }else{

                                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_ASSET_MAPPING) == true){

                                        $tmp_nom = $resource_ARRAY['file_name'][0];
                                        if($resource_ARRAY['crnrstn_mod'][0] !== 0){

                                            $tmp_nom = $resource_ARRAY['crnrstn_mod'][0];

                                        }

                                        //
                                        // CRNRSTN :: MULTI-CHANNEL APPLICATION ACCELERATION LAYER [session, ssdtla, cookie, database, runtime].
                                        $tmp_filepath = $resource_ARRAY['file_path'][0];
                                        $tmp_filename = $resource_ARRAY['file_name'][0];
                                        $tmp_file_extension = $resource_ARRAY['file_ext'][0];

                                        if($this->oCRNRSTN->get_channel_config(NULL, 'map_cache_is_active') == true){

                                            $this->oCRNRSTN->initialize_cache('css', $tmp_filename, $this->oCRNRSTN->asset_meta_key('css', $tmp_filename), CRNRSTN_JS, $tmp_filepath, $tmp_file_extension);
                                            //$this->oCRNRSTN->initialize_request($tmp_filename, 'css', CRNRSTN_JS, $this->oCRNRSTN->asset_meta_key('css', $tmp_filename));
                                            //$this->oCRNRSTN->initialize_response_map_cache('return_file_byte_chunked_buffer_output', CRNRSTN_JS, $tmp_filepath, $tmp_filename, $tmp_file_extension);

                                        }

                                        $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
    <script type="' . $resource_ARRAY['meta_type'][0] . '" src="' . $resource_ARRAY['system_http_root'][0] . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_nom . '&crnrstn_=' . $resource_ARRAY['cache'][0] . '"></script>
';

                                    }else{

                                        $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
    <script type="' . $resource_ARRAY['meta_type'][0] . '" src="' . $resource_ARRAY['system_http_root'][0] . $resource_ARRAY['system_directory'][0] . DIRECTORY_SEPARATOR . 'ui/js' . $resource_ARRAY['file_path_original'][0] . '?crnrstn_=' . $resource_ARRAY['cache'][0] . '"></script>
';

                                    }

                                }

                            }else{

                                //
                                // CSS FILE? WE DON'T HANDLE .MAP SEPARATELY FROM JS AND CSS.
                                if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

                                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_CSS_ASSET_MAPPING) == true){

                                        $tmp_nom = $resource_ARRAY['file_name'][0];
                                        if($resource_ARRAY['crnrstn_mod'][0] !== 0){

                                            $tmp_nom = $resource_ARRAY['crnrstn_mod'][0];

                                        }

                                        //
                                        // CRNRSTN :: MULTI-CHANNEL APPLICATION ACCELERATION LAYER [session, ssdtla, cookie, database, runtime].
                                        $tmp_filepath = $resource_ARRAY['file_path'][0];
                                        $tmp_filename = $resource_ARRAY['file_name'][0];
                                        $tmp_file_extension = $resource_ARRAY['file_ext'][0];

                                        if($this->oCRNRSTN->get_channel_config(NULL, 'map_cache_is_active') == true){

                                            $this->oCRNRSTN->initialize_cache('css', $tmp_filename, $this->oCRNRSTN->asset_meta_key('css', $tmp_filename), CRNRSTN_CSS, $tmp_filepath, $tmp_file_extension);
                                            //$this->oCRNRSTN->initialize_request($tmp_filename, 'css', CRNRSTN_CSS, $this->oCRNRSTN->asset_meta_key('css', $tmp_filename));
                                            //$this->oCRNRSTN->initialize_response_map_cache('return_file_byte_chunked_buffer_output', CRNRSTN_CSS, $tmp_filepath, $tmp_filename, $tmp_file_extension);

                                        }

                                        $tmp_str .= '
    <link type="' . $resource_ARRAY['meta_type'][0] . '" rel="stylesheet" href="' . $resource_ARRAY['system_http_root'][0] . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_nom . '&crnrstn_=' . $resource_ARRAY['cache'][0] . '">
';

                                    }else{

                                        $tmp_str .= '
    <link type="' . $resource_ARRAY['meta_type'][0] . '" rel="stylesheet" href="' . $resource_ARRAY['system_http_root'][0] . $resource_ARRAY['system_directory'][0] . DIRECTORY_SEPARATOR . 'ui/css' . $resource_ARRAY['file_path_original'][0] . '?crnrstn_=' . $resource_ARRAY['cache'][0] . '">
';

                                    }

                                }else{

                                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_CSS_ASSET_MAPPING) == true){

                                        $tmp_nom = $resource_ARRAY['file_name'][0];
                                        if($resource_ARRAY['crnrstn_mod'][0] !== 0){

                                            $tmp_nom = $resource_ARRAY['crnrstn_mod'][0];

                                        }

                                        //
                                        // CRNRSTN :: MULTI-CHANNEL APPLICATION ACCELERATION LAYER [session, ssdtla, cookie, database, runtime].
                                        $tmp_filepath = $resource_ARRAY['file_path'][0];
                                        $tmp_filename = $resource_ARRAY['file_name'][0];
                                        $tmp_file_extension = $resource_ARRAY['file_ext'][0];

                                        if($this->oCRNRSTN->get_channel_config(NULL, 'map_cache_is_active') == true){

                                            $this->oCRNRSTN->initialize_cache('css', $tmp_filename, $this->oCRNRSTN->asset_meta_key('css', $tmp_filename), CRNRSTN_CSS, $tmp_filepath, $tmp_file_extension);
                                            //$this->oCRNRSTN->initialize_request($tmp_filename, 'css', CRNRSTN_CSS, $this->oCRNRSTN->asset_meta_key('css', $tmp_filename));
                                            //$this->oCRNRSTN->initialize_response_map_cache('return_file_byte_chunked_buffer_output', CRNRSTN_CSS, $tmp_filepath, $tmp_filename, $tmp_file_extension);

                                        }

                                        $tmp_str .= '
    <link type="' . $resource_ARRAY['meta_type'][0] . '" rel="stylesheet" href="' . $resource_ARRAY['system_http_root'][0] . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_nom . '&crnrstn_=' . $resource_ARRAY['cache'][0] . '">
';
                                        //error_log(__LINE__ . ' asset mgr file_extension[' . $resource_ARRAY['file_ext'][0] . '].');

                                    }else{

                                        $tmp_str .= '
    <link type="' . $resource_ARRAY['meta_type'][0] . '" rel="stylesheet" href="' . $resource_ARRAY['system_http_root'][0] . $resource_ARRAY['system_directory'][0] . DIRECTORY_SEPARATOR . 'ui/css' . $resource_ARRAY['file_path_original'][0] . '?crnrstn_=' . $resource_ARRAY['cache'][0] . '">
';
                                        //error_log(__LINE__ . ' asset mgr file_extension[' . $resource_ARRAY['file_ext'][0] . '].');

                                    }

                                }

                            }

                        break;
                        case CRNRSTN_JS:

                            //
                            // IS THIS CSS?
                            if($resource_ARRAY['file_ext'][0] == 'css'){

                                if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

                                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_ASSET_MAPPING) == true){

                                        $tmp_nom = $resource_ARRAY['file_name'][0];
                                        if($resource_ARRAY['crnrstn_mod'][0] !== 0){

                                            $tmp_nom = $resource_ARRAY['crnrstn_mod'][0];

                                        }

                                        //
                                        // CRNRSTN :: MULTI-CHANNEL APPLICATION ACCELERATION LAYER [session, ssdtla, cookie, database, runtime].
                                        $tmp_filepath = $resource_ARRAY['file_path'][0];
                                        $tmp_filename = $resource_ARRAY['file_name'][0];
                                        $tmp_file_extension = $resource_ARRAY['file_ext'][0];

                                        if($this->oCRNRSTN->get_channel_config(NULL, 'map_cache_is_active') == true){

                                            $this->oCRNRSTN->initialize_cache('js', $tmp_filename, $this->oCRNRSTN->asset_meta_key('css', $tmp_filename), CRNRSTN_CSS, $tmp_filepath, $tmp_file_extension);
                                            //$this->oCRNRSTN->initialize_request($tmp_filename, 'js', CRNRSTN_CSS, $this->oCRNRSTN->asset_meta_key('css', $tmp_filename));
                                            //$this->oCRNRSTN->initialize_response_map_cache('return_file_byte_chunked_buffer_output', CRNRSTN_CSS, $tmp_filepath, $tmp_filename, $tmp_file_extension);

                                        }

                                        $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
    <link type="' . $resource_ARRAY['meta_type'][0] . '" rel="stylesheet" href="' . $resource_ARRAY['system_http_root'][0] . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_nom . '&crnrstn_=' . $resource_ARRAY['cache'][0] . '">
';
                                    }else{

                                        $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
    <link type="' . $resource_ARRAY['meta_type'][0] . '" rel="stylesheet" href="' . $resource_ARRAY['system_http_root'][0] . $resource_ARRAY['system_directory'][0] . DIRECTORY_SEPARATOR . 'ui/js' . $resource_ARRAY['file_path_original'][0] . '?crnrstn_=' . $resource_ARRAY['cache'][0] . '">
';

                                    }

                                }else{

                                    //
                                    // JS FRAMEWORK (NOT FILE) MAPPING.
                                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_ASSET_MAPPING) == true){

                                        $tmp_nom = $resource_ARRAY['file_name'][0];
                                        if($resource_ARRAY['crnrstn_mod'][0] !== 0){

                                            $tmp_nom = $resource_ARRAY['crnrstn_mod'][0];

                                        }

                                        //
                                        // CRNRSTN :: MULTI-CHANNEL APPLICATION ACCELERATION LAYER [session, ssdtla, cookie, database, runtime].
                                        $tmp_filepath = $resource_ARRAY['file_path'][0];
                                        $tmp_filename = $resource_ARRAY['file_name'][0];
                                        $tmp_file_extension = $resource_ARRAY['file_ext'][0];

                                        if($this->oCRNRSTN->get_channel_config(NULL, 'map_cache_is_active') == true){

                                            $this->oCRNRSTN->initialize_cache('js', $tmp_filename, $this->oCRNRSTN->asset_meta_key('css', $tmp_filename), CRNRSTN_CSS, $tmp_filepath, $tmp_file_extension);
                                            //$this->oCRNRSTN->initialize_request($tmp_filename, 'js', CRNRSTN_CSS, $this->oCRNRSTN->asset_meta_key('css', $tmp_filename));
                                            //$this->oCRNRSTN->initialize_response_map_cache('return_file_byte_chunked_buffer_output', CRNRSTN_CSS, $tmp_filepath, $tmp_filename, $tmp_file_extension);

                                        }

                                        $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
    <link type="' . $resource_ARRAY['meta_type'][0] . '" rel="stylesheet" href="' . $resource_ARRAY['system_http_root'][0] . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_nom . '&crnrstn_=' . $resource_ARRAY['cache'][0] . '">
';
                                        //error_log(__LINE__ . ' asset mgr file_extension[' . $resource_ARRAY['file_ext'][0] . '].');

                                    }else{

                                        $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
    <link type="' . $resource_ARRAY['meta_type'][0] . '" rel="stylesheet" href="' . $resource_ARRAY['system_http_root'][0] . $resource_ARRAY['system_directory'][0] . DIRECTORY_SEPARATOR . 'ui/js' . $resource_ARRAY['file_path_original'][0] . '?crnrstn_=' . $resource_ARRAY['cache'][0] . '">
';
                                        //error_log(__LINE__ . ' asset mgr file_extension[' . $resource_ARRAY['file_ext'][0] . '].');

                                    }

                                }

                            }else{

                                //
                                // THIS REFERS TO JS STORAGE LOCATION WITHIN CRNRSTN :: ...RATHER THAN AN
                                // INDICATION OF FILE HEADER RESPONSE MIME TYPE. THERE IS CSS IN THE JS FRAMEWORK PATH.
                                if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

                                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_ASSET_MAPPING) == true){

                                        $tmp_nom = $resource_ARRAY['file_name'][0];
                                        if($resource_ARRAY['crnrstn_mod'][0] !== 0){

                                            $tmp_nom = $resource_ARRAY['crnrstn_mod'][0];

                                        }

                                        //
                                        // CRNRSTN :: MULTI-CHANNEL APPLICATION ACCELERATION LAYER [session, ssdtla, cookie, database, runtime].
                                        $tmp_filepath = $resource_ARRAY['file_path'][0];
                                        $tmp_filename = $resource_ARRAY['file_name'][0];
                                        $tmp_file_extension = $resource_ARRAY['file_ext'][0];

                                        if($this->oCRNRSTN->get_channel_config(NULL, 'map_cache_is_active') == true){

                                            $this->oCRNRSTN->initialize_cache('js', $tmp_filename, $this->oCRNRSTN->asset_meta_key('css', $tmp_filename), CRNRSTN_JS, $tmp_filepath, $tmp_file_extension);
                                            //$this->oCRNRSTN->initialize_request($tmp_filename, 'js', CRNRSTN_JS, $this->oCRNRSTN->asset_meta_key('css', $tmp_filename));
                                            //$this->oCRNRSTN->initialize_response_map_cache('return_file_byte_chunked_buffer_output', CRNRSTN_JS, $tmp_filepath, $tmp_filename, $tmp_file_extension);

                                        }

                                        $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
    <script type="' . $resource_ARRAY['meta_type'][0] . '" src="' . $resource_ARRAY['system_http_root'][0] . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_nom . '&crnrstn_=' . $resource_ARRAY['cache'][0] . '"></script>
';

                                    }else{

                                        $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
    <script type="' . $resource_ARRAY['meta_type'][0] . '" src="' . $resource_ARRAY['system_http_root'][0] . $resource_ARRAY['system_directory'][0] . DIRECTORY_SEPARATOR . 'ui/js' . $resource_ARRAY['file_path_original'][0] . '?crnrstn_=' . $resource_ARRAY['cache'][0] . '"></script>
';

                                    }

                                }else{

                                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_ASSET_MAPPING) == true){

                                        $tmp_nom = $resource_ARRAY['file_name'][0];
                                        if($resource_ARRAY['crnrstn_mod'][0] !== 0){

                                            $tmp_nom = $resource_ARRAY['crnrstn_mod'][0];

                                        }

                                        //
                                        // CRNRSTN :: MULTI-CHANNEL APPLICATION ACCELERATION LAYER [session, ssdtla, cookie, database, runtime].
                                        $tmp_filepath = $resource_ARRAY['file_path'][0];
                                        $tmp_filename = $resource_ARRAY['file_name'][0];
                                        $tmp_file_extension = $resource_ARRAY['file_ext'][0];

                                        if($this->oCRNRSTN->get_channel_config(NULL, 'map_cache_is_active') == true){

                                            $this->oCRNRSTN->initialize_cache('js', $tmp_filename, $this->oCRNRSTN->asset_meta_key('css', $tmp_filename), CRNRSTN_JS, $tmp_filepath, $tmp_file_extension);
                                            //$this->oCRNRSTN->initialize_request($tmp_filename, 'js', CRNRSTN_JS, $this->oCRNRSTN->asset_meta_key('css', $tmp_filename));
                                            //$this->oCRNRSTN->initialize_response_map_cache('return_file_byte_chunked_buffer_output', CRNRSTN_JS, $tmp_filepath, $tmp_filename, $tmp_file_extension);

                                        }

                                        $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
    <script type="' . $resource_ARRAY['meta_type'][0] . '" src="' . $resource_ARRAY['system_http_root'][0] . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_nom . '&crnrstn_=' . $resource_ARRAY['cache'][0] . '"></script>
';
                                        //error_log(__LINE__ . ' asset mgr file_extension[' . $resource_ARRAY['file_ext'][0] . '].');

                                    }else{

                                        $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
    <script type="' . $resource_ARRAY['meta_type'][0] . '" src="' . $resource_ARRAY['system_http_root'][0] . $resource_ARRAY['system_directory'][0] . DIRECTORY_SEPARATOR . 'ui/js' . $resource_ARRAY['file_path_original'][0] . '?crnrstn_=' . $resource_ARRAY['cache'][0] . '"></script>
';
                                        //error_log(__LINE__ . ' asset mgr file_extension[' . $resource_ARRAY['file_ext'][0] . '].');

                                    }

                                }

                            }

                        break;
                        case CRNRSTN_CSS & CRNRSTN_ASSET_MODE_BASE64:

                            //
                            // IS THIS JS?
                            if($resource_ARRAY['file_ext'][0] == 'js'){

                                $tmp_nom = $resource_ARRAY['file_name'][0];
                                if($resource_ARRAY['crnrstn_mod'][0] !== 0){

                                    $tmp_nom = $resource_ARRAY['crnrstn_mod'][0];

//                                    //
//                                    // TODO :: DO WE HOOK SOMETHING LIKE THIS UP FOR BASE64?
//                                    // CRNRSTN :: MULTI-CHANNEL APPLICATION ACCELERATION LAYER [session, ssdtla, cookie, database, runtime].
//                                    $tmp_filepath = $resource_ARRAY['file_path'][0];
//                                    $tmp_filename = $resource_ARRAY['file_name'][0];
//                                    $tmp_file_extension = $resource_ARRAY['file_ext'][0];
//                                    $this->oCRNRSTN->initialize_request($tmp_filename, 'js', CRNRSTN_JS & CRNRSTN_ASSET_MODE_BASE64, $this->oCRNRSTN->asset_meta_key('css', $tmp_filename));
//                                    $this->oCRNRSTN->initialize_response_map_cache('return_file_byte_chunked_buffer_output', CRNRSTN_JS & CRNRSTN_ASSET_MODE_BASE64, $tmp_filepath, $tmp_filename, $tmp_file_extension);

                                    $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
<script type="' . $resource_ARRAY['meta_type'][0] . '"> //<!--
' . $this->return_dynamic_js_string_output($tmp_nom) . '
// -->
</script>
';

                                }else{

                                    $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
<script type="' . $resource_ARRAY['meta_type'][0] . '"> //<!--
' . file_get_contents($tmp_nom) . '
// -->
</script>
';

                                }

                                //error_log(__LINE__ . ' asset mgr file_extension[' . $resource_ARRAY['file_ext'][0] . '].');

                            }else{

                                $tmp_nom = $resource_ARRAY['file_name'][0];
                                if($resource_ARRAY['crnrstn_mod'][0] !== 0){

                                    $tmp_nom = $resource_ARRAY['crnrstn_mod'][0];

//                                    //
//                                    // TODO :: DO WE HOOK SOMETHING LIKE THIS UP?
//                                    // CRNRSTN :: MULTI-CHANNEL APPLICATION ACCELERATION LAYER [session, ssdtla, cookie, database, runtime].
//                                    $tmp_filepath = $resource_ARRAY['file_path'][0];
//                                    $tmp_filename = $resource_ARRAY['file_name'][0];
//                                    $tmp_file_extension = $resource_ARRAY['file_ext'][0];
//                                    $this->oCRNRSTN->initialize_response_map_cache('return_file_byte_chunked_buffer_output', CRNRSTN_CSS & CRNRSTN_ASSET_MODE_BASE64, $tmp_filepath, $tmp_filename, $tmp_file_extension);

                                    $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
<style>
' . $this->return_dynamic_css_string_output($tmp_nom) . '
</style>
';

                                }else{

                                    $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
<style>
' . file_get_contents($tmp_nom) . '
</style>
';
                                }


                                //error_log(__LINE__ . ' asset mgr file_extension[' . $resource_ARRAY['file_ext'][0] . '].');

                            }

                        break;
                        case CRNRSTN_JS & CRNRSTN_ASSET_MODE_BASE64:

                            //
                            // IS THIS CSS?
                            if($resource_ARRAY['file_ext'][0] == 'css'){

                                $tmp_nom = $resource_ARRAY['file_name'][0];
                                if($resource_ARRAY['crnrstn_mod'][0] !== 0){

                                    $tmp_nom = $resource_ARRAY['crnrstn_mod'][0];

//                                    //
//                                    // TODO :: DO WE HOOK SOMETHING LIKE THIS UP?
//                                    // CRNRSTN :: MULTI-CHANNEL APPLICATION ACCELERATION LAYER [session, ssdtla, cookie, database, runtime].
//                                    $tmp_filepath = $resource_ARRAY['file_path'][0];
//                                    $tmp_filename = $resource_ARRAY['file_name'][0];
//                                    $tmp_file_extension = $resource_ARRAY['file_ext'][0];
//                                    $this->oCRNRSTN->initialize_response_map_cache('return_file_byte_chunked_buffer_output', CRNRSTN_CSS & CRNRSTN_ASSET_MODE_BASE64, $tmp_filepath, $tmp_filename, $tmp_file_extension);

                                    $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
<style>
' . $this->return_dynamic_css_string_output($tmp_nom) . '
</style>
';
                                }else{

                                    $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
<style>
' . file_get_contents($tmp_nom) . '
</style>
';
                                }

                                //error_log(__LINE__ . ' asset mgr file_extension[' . $resource_ARRAY['file_ext'][0] . '].');

                            }else{

                                $tmp_nom = $resource_ARRAY['file_name'][0];
                                if($resource_ARRAY['crnrstn_mod'][0] !== 0){

                                    $tmp_nom = $resource_ARRAY['crnrstn_mod'][0];

//                                    //
//                                    // TODO :: DO WE HOOK SOMETHING LIKE THIS UP?
//                                    // CRNRSTN :: MULTI-CHANNEL APPLICATION ACCELERATION LAYER [session, ssdtla, cookie, database, runtime].
//                                    $tmp_filepath = $resource_ARRAY['file_path'][0];
//                                    $tmp_filename = $resource_ARRAY['file_name'][0];
//                                    $tmp_file_extension = $resource_ARRAY['file_ext'][0];
//                                    $this->oCRNRSTN->initialize_response_map_cache('return_file_byte_chunked_buffer_output', CRNRSTN_JS & CRNRSTN_ASSET_MODE_BASE64, $tmp_filepath, $tmp_filename, $tmp_file_extension);

                                    $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
<script type="' . $resource_ARRAY['meta_type'][0] . '" > //<!--
' . $this->return_dynamic_js_string_output($tmp_nom) . '
// -->
</script>
';
                                }else{

                                    $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
<script type="' . $resource_ARRAY['meta_type'][0] . '" > //<!--
' . file_get_contents($tmp_nom) . '
// -->
</script>
';

                                }

                                //error_log(__LINE__ . ' asset mgr $tmp_str[' . $tmp_str . ']. file_extension[' . $resource_ARRAY['file_ext'][0] . '].');

                            }

                        break;

                    }

                }

            }else{

                //
                // SPOOL THIS ASSET (ARRAY DATA TYPE) TO BE PROCESSED AT THE FOOTER
                //system_head_html_asset_array_spool_ARRAY
                $this->oCRNRSTN->spool_head_html_asset_array($resource_ARRAY, $asset_nom_hash);

                error_log(__LINE__ . ' asset mgr SPOOL THIS ASSET $asset_nom_hash[' . $asset_nom_hash . ']. file_extension[' . print_r($resource_ARRAY, true) . '].');

            }

            return $tmp_str;

        }catch (Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    private function return_mapped_resources($resource_constant, $footer_html_output){

        /*
        // R :: RESOURCE //
        ////
        $tmp_file_path = '/_lib/frameworks/prototype.js/1.7.3/prototype.js';
        $tmp_file_name = 'prototype.js';
        $tmp_file_type_const = CRNRSTN_JS;
        ////
        //// production = true, development = false
        $this->spool_resource(CRNRSTN_JS_FRAMEWORK_PROTOTYPE, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active);

        [Tue Nov 22 18:33:14.786202 2022] [:error] [pid 49942] [client 172.16.225.1:55559]
        1557 asset mgr
        Array\n(\n
            [INTEGER] => 7322\n
            [STRING] => CRNRSTN_CSS_FRAMEWORK_HTML5_BOILERPLATE\n
            [TITLE] => HTML5 Boilerplate\n
            [VERSION] => 0.00.0000\n
            [BROWSER_COMPATIBILITY] => \n
            [DESCRIPTION] => The web's most popular front-end template, HTML5 Boilerplate helps \n                            you build fast, robust, and adaptable web apps or sites. Kick-start your project with the \n                            combined knowledge and effort of 100s of developers, all in one little package.\n    [URL] => Array\n        (\n            [0] => https://html5boilerplate.com/\n        )\n\n)\n
            [URL][0]...

        $tmp_resource_hash = $tmp_file_path_hash . $tmp_file_name_hash;

        $tmp_ARRAY[$tmp_resource_hash]['resource_version_nom'][] = '    <!-- ' . $tmp_resource_meta_ARRAY['TITLE'] . ' v' . $tmp_resource_meta_ARRAY['VERSION'] . ' :: ' . $tmp_str_file_type_nom . $tmp_dependency_str . ' -->';
        $tmp_ARRAY[$tmp_resource_hash]['system_path_directory'][] = $tmp_path_directory;
        asset_mapping_dir_path
        $tmp_ARRAY[$tmp_resource_hash]['system_http_root'][] = $tmp_http_root;
        $tmp_ARRAY[$tmp_resource_hash]['system_directory'][] = $tmp_system_directory;
        $tmp_ARRAY[$tmp_resource_hash]['resource_constant'][] = $resource_constant;
        $tmp_ARRAY[$tmp_resource_hash]['file_type_constant'][] = $file_type_constant;
        $tmp_ARRAY[$tmp_resource_hash]['crnrstn_mod'][] = $crnrstn_mod;
        $tmp_ARRAY[$tmp_resource_hash]['file_name'][] = $file_name;
        $tmp_ARRAY[$tmp_resource_hash]['file_path_original'][] = $file_path;
        $tmp_ARRAY[$tmp_resource_hash]['file_path'][] = $tmp_filepath;
        $tmp_ARRAY[$tmp_resource_hash]['path_root'][] = $tmp_path_root;
        $tmp_ARRAY[$tmp_resource_hash]['file_is_minimized'][] = $tmp_file_is_minimized_str;
        $tmp_ARRAY[$tmp_resource_hash]['asset_minimization_mode_is_active'][] = $tmp_asset_minimization_mode_is_active_str;
        $tmp_ARRAY[$tmp_resource_hash]['cache'][] = $tmp_cache;

        $this->framework_resource_ARRAY[$resource_constant][] = $tmp_ARRAY;

        */

        try{

            //
            // HAS THIS RESOURCE BEEN SPOOLED?
            if(!isset($this->framework_resource_ARRAY[$resource_constant])){

                $tmp_resource_const_profile_ARRAY = $this->oCRNRSTN->return_int_const_profile($resource_constant);

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('The requested resource, ' . $tmp_resource_const_profile_ARRAY[CRNRSTN_INTEGER] . ' ["' . $tmp_resource_const_profile_ARRAY[CRNRSTN_STRING] . '"], has not been spooled...but, it is being requested.');

            }

            //
            // $resource_type = [js, css, integrations]
            $tmp_str = '';
            foreach($this->framework_resource_ARRAY[$resource_constant] as $index0 => $tmpchnkARRAY00){

                foreach($tmpchnkARRAY00 as $asset_nom_hash => $resARRAY){

                    //error_log(__LINE__ . ' asset mgr [' . print_r($resARRAY, true) . '].');
                    //die();

                    /*
                    [Thu Dec 01 14:16:56.440270 2022] [:error] [pid 60949] [client 172.16.225.1:57746] 526 asset mgr [
                    Array\n(\n
                        [resource_version_nom] => Array\n        (\n
                            [0] => LIGHTBOX v2.11.3 :: js [in support of CRNRSTN :: INTERACT UI/UX JS v1.00.0000 PRE-ALPHA-DEV (Lightsaber)]\n        )\n\n
                        [system_path_directory] => Array\n        (\n
                            [0] => /var/www/html/lightsaber.crnrstn.evifweb.com\n        )\n\n
                        [asset_mapping_dir_path] => Array\n        (\n
                            [0] => /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/ui\n        )\n\n
                        [system_http_root] => Array\n        (\n
                            [0] => http://172.16.225.139/lightsaber.crnrstn.evifweb.com/\n        )\n\n
                        [system_directory] => Array\n        (\n
                            [0] => _crnrstn\n        )\n\n
                        [resource_constant] => Array\n        (\n
                            [0] => 7308\n        )\n\n
                        [file_type_constant] => Array\n        (\n
                            [0] => 7208\n        )\n\n
                        [file_name] => Array\n        (\n
                            [0] => lightbox-2.11.3/css/lightbox.min.css\n        )\n\n
                        [file_path_original] => Array\n        (\n
                            [0] => /_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/css/lightbox.min.css\n        )\n\n
                        [file_extension] => Array\n        (\n
                            [0] => css\n        )\n\n
                        [file_path] => Array\n        (\n
                            [0] => /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/ui/js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/css/lightbox.min.css\n        )\n\n
                        [path_root] => Array\n        (\n
                            [0] => /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/ui/js\n        )\n\n
                        [file_is_minimized] => Array\n        (\n
                            [0] => TRUE\n        )\n\n
                        [asset_minimization_mode_is_active] => Array\n        (\n
                            [0] => TRUE\n        )\n\n
                        [asset_spool_delay_html_output_for_footer] => Array\n        (\n
                            [0] => FALSE\n        )\n\n
                        [cache] => Array\n        (\n
                            [0] => 420.00.2532.1669922199.0\n        )\n\n)\n].

                    */

                    //        $tmp_ARRAY[$tmp_resource_hash]['asset_spool_delay_html_output_for_footer'][] = $tmp_spool_for_footer_html_str;
                    //
                    // IS THIS AUTHORIZED FOR OUTPUT?
                    if($resARRAY['asset_spool_delay_html_output_for_footer'] != 'TRUE'){

                        //
                        // FLAG RESOURCE AS BUILT
                        $this->oCRNRSTN->flag_built_head_resource($resource_constant);

                        //
                        // BUILD RESOURCE STRING (SOME INTERNALS CAN BE LEFT FOR FOOTER BUILD, THO)
                        $tmp_str .= $this->mapped_resource_html_output($resARRAY, $asset_nom_hash, $footer_html_output);

                    }

                }

            }

            return $tmp_str;

        }catch (Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    private function spool_resource($resource_constant, $meta_type, $crnrstn_mod, $file_path, $file_name, $file_type_constant, $file_is_minimized = true, $asset_minimization_mode_is_active = true, $resource_dependency_constant = NULL, $spool_asset_for_footer_html = false){

        $tmp_asset_map_dir_path = $this->oCRNRSTN->get_resource('crnrstn_integrations_asset_map_dir_path', 0, 'CRNRSTN::RESOURCE::ASSET_INTEGRATIONS');
        $tmp_crnrstn_http_endpoint = $this->oCRNRSTN->get_resource('crnrstn_http_endpoint', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');

//        error_log(__LINE__ . ' asset mgr $tmp_crnrstn_http_endpoint[' . $tmp_crnrstn_http_endpoint . ']. $tmp_asset_map_dir_path[' . $tmp_asset_map_dir_path . '].');
//
//        die();

        $tmp_path_directory = $this->oCRNRSTN->get_resource('crnrstn_path_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');
        $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');

        switch ($file_type_constant){
            case CRNRSTN_JS & CRNRSTN_ASSET_MODE_BASE64:
            case CRNRSTN_JS:

                $tmp_path_root = $this->oCRNRSTN->get_resource('crnrstn_js_asset_map_dir_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');
                $tmp_http_root = $this->oCRNRSTN->get_resource('crnrstn_js_asset_map_http_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');
                $tmp_str_file_type_nom = 'js';

            break;
            case CRNRSTN_CSS & CRNRSTN_ASSET_MODE_BASE64:
            case CRNRSTN_CSS:

                $tmp_path_root = $this->oCRNRSTN->get_resource('crnrstn_css_asset_map_dir_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');
                $tmp_http_root = $this->oCRNRSTN->get_resource('crnrstn_css_asset_map_http_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');
                $tmp_str_file_type_nom = 'css';

            break;

        }

        $tmp_filepath = $tmp_asset_map_dir_path . DIRECTORY_SEPARATOR . $tmp_str_file_type_nom . $file_path;

        $tmp_ARRAY = array();
        $tmp_spool_for_footer_html_str = 'FALSE';
        $tmp_file_is_minimized_str = $tmp_asset_minimization_mode_is_active_str = 'TRUE';
        $tmp_file_path_hash = $this->oCRNRSTN->hash($tmp_filepath);

        //
        // CRNRSTN :: ASSET MAPPING SUPPORTS ALIAS OF FILE NAMES...SO THAT MAXIMUM OPPORTUNITY
        // CAN ALWAYS BE TAKEN FOR BREVITY (SHORTEST LINK POSSIBLE). THE FILE NAME IS IN THE PATH
        // TO THE FILE, BUT FLEXIBILITY IS THE DRIVER. WE NEED TO HASH THE FILE NAME TOO.
        //
        // ...AS TO WHY IT IS 0641 hrs ON NOV. 25, 2022,
        // AND...AFTER WORKING ALL NIGHT...THIS DEVELOPER HAS AT *THIS* TIME STARTED TO RE-ARCH
        // LIKE ALL ~30 JS + CSS FRAMEWORK INTEGRATIONS RIGHT HERE?!? WELL,...LIKE...I'M TIRED
        // OF HAVING TO DO THIS SAME SHIT WHEN I SETUP FRAMEWORKS. WAY TOO MUCH COPY AND PASTE.
        //
        // ...NOT ONE MORE TIME...
        //
        // TRACK ON LOOP :: https://www.youtube.com/watch?v=pMxrA1-VG6k
        //
        $tmp_file_name_hash = $this->oCRNRSTN->hash($file_name);

        if($spool_asset_for_footer_html){

            $tmp_spool_for_footer_html_str = 'TRUE';

        }

        if(!$file_is_minimized){

            $tmp_file_is_minimized_str = 'FALSE';

        }

        if(!$asset_minimization_mode_is_active){

            $tmp_asset_minimization_mode_is_active_str = 'FALSE';

        }

        //
        // FORCE LEADING DIRECTORY SEPARATOR
        $tmp_filepath = ltrim($tmp_filepath, DIRECTORY_SEPARATOR);
        $tmp_filepath = DIRECTORY_SEPARATOR . $tmp_filepath;
        //$tmp_filepath = $tmp_path_root . $tmp_filepath;

        if(!is_file($tmp_filepath)){

            error_log(__LINE__ . ' asset mgr $tmp_filepath[' . $tmp_filepath . '].');
            die();

        }

        $tmp_cache = $this->oCRNRSTN->resource_filecache_version($tmp_filepath);
        $tmp_file_extension = pathinfo($tmp_filepath, PATHINFO_EXTENSION);

        $tmp_resource_meta_ARRAY = $this->oCRNRSTN->return_int_const_profile($resource_constant);

        $tmp_dependency_str = '';
        if(isset($resource_dependency_constant)){

            $tmp_resource_support_meta_ARRAY = $this->oCRNRSTN->return_int_const_profile($resource_dependency_constant);

            if(isset($tmp_resource_support_meta_ARRAY['TITLE'])){

                if(strlen($tmp_resource_support_meta_ARRAY['TITLE']) > 0){

                    $tmp_dependency_str .= ' [autoloaded support for ' . $tmp_resource_support_meta_ARRAY['TITLE'];

                    if(isset($tmp_resource_support_meta_ARRAY['VERSION'])){

                        if(strlen($tmp_resource_support_meta_ARRAY['VERSION']) > 0){

                            $tmp_dependency_str .= ' v' . $tmp_resource_support_meta_ARRAY['VERSION'] . ']';

                        }else{

                            $tmp_dependency_str .= ']';

                        }

                    }

                }

            }

        }

        if(!isset($crnrstn_mod)){

            $crnrstn_mod = 0;

        }

        //error_log(__LINE__ . ' asset mgr $tmp_http_root[' . $tmp_crnrstn_http_endpoint . '].');

        //
        // IS THIS A NEW FILE?
        $tmp_resource_hash = $tmp_file_path_hash . $tmp_file_name_hash;
        $tmp_ARRAY[$tmp_resource_hash]['resource_version_nom'][] = $tmp_resource_meta_ARRAY['TITLE'] . ' v' . $tmp_resource_meta_ARRAY['VERSION'] . $tmp_dependency_str;
        $tmp_ARRAY[$tmp_resource_hash]['system_path_directory'][] = $tmp_path_directory;
        $tmp_ARRAY[$tmp_resource_hash]['asset_mapping_dir_path'][] = $tmp_asset_map_dir_path;
        $tmp_ARRAY[$tmp_resource_hash]['system_http_root'][] = $tmp_crnrstn_http_endpoint;
        $tmp_ARRAY[$tmp_resource_hash]['system_directory'][] = $tmp_system_directory;
        $tmp_ARRAY[$tmp_resource_hash]['resource_constant'][] = $resource_constant;
        $tmp_ARRAY[$tmp_resource_hash]['file_type_constant'][] = $file_type_constant;
        $tmp_ARRAY[$tmp_resource_hash]['meta_type'][] = $meta_type;
        $tmp_ARRAY[$tmp_resource_hash]['crnrstn_mod'][] = $crnrstn_mod;
        $tmp_ARRAY[$tmp_resource_hash]['file_name'][] = $file_name;
        $tmp_ARRAY[$tmp_resource_hash]['file_path_original'][] = $file_path;
        $tmp_ARRAY[$tmp_resource_hash]['file_ext'][] = $tmp_file_extension;
        $tmp_ARRAY[$tmp_resource_hash]['file_path'][] = $tmp_filepath;
        $tmp_ARRAY[$tmp_resource_hash]['path_root'][] = $tmp_path_root;
        $tmp_ARRAY[$tmp_resource_hash]['file_is_minimized'][] = $tmp_file_is_minimized_str;
        $tmp_ARRAY[$tmp_resource_hash]['asset_minimization_mode_is_active'][] = $tmp_asset_minimization_mode_is_active_str;
        $tmp_ARRAY[$tmp_resource_hash]['asset_spool_delay_html_output_for_footer'][] = $tmp_spool_for_footer_html_str;
        $tmp_ARRAY[$tmp_resource_hash]['cache'][] = $tmp_cache;

        $this->framework_resource_ARRAY[$resource_constant][] = $tmp_ARRAY;

        return true;

    }

    private function return_output_CRNRSTN_JS($const, $footer_html_output = false, $is_dev_mode = NULL){

        try{

            $asset_mode_ARRAY = $this->oCRNRSTN->return_set_bits($this->oCRNRSTN->system_output_profile_constants_ARRAY(), true);

            $tmp_str = '';
            $tmp_start_str = '';
            $tmp_str_array = array();
            $tmp_show_comments = true;

            if($this->oCRNRSTN->is_serialized_bit_set('crnrstn_html_comments_mode', CRNRSTN_HTML_COMMENTS_SILENT_GOLD) !== true){

                $tmp_show_comments = false;

            }

            if(isset($is_dev_mode)){

                if($is_dev_mode == true){

                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

                        $tmp_min_js_css_bool_cache = true;

                        //
                        // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                        // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                        $this->oCRNRSTN->initialize_bit(CRNRSTN_JS_CSS_PROD_MIN, false);

                    }

                }else{

                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

                        $tmp_min_js_css_bool_cache = false;

                        //
                        // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                        // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                        $this->oCRNRSTN->initialize_bit(CRNRSTN_JS_CSS_PROD_MIN, false);

                    }

                }

            }

            switch($asset_mode_ARRAY[0]){
                case CRNRSTN_ASSET_MODE_PNG:
                case CRNRSTN_ASSET_MODE_JPEG:
                case CRNRSTN_ASSET_MODE_BASE64:

                    // # # # # # # # # # # # # # # # # # # # # # # # # # #
                    if($tmp_show_comments == true){

                        $tmp_start_str = '
    ' . $this->oCRNRSTN->html_version_burn('JS MODULE') . '
';

                    }

                    switch ($const){
                        case CRNRSTN_JS_FRAMEWORK_JQUERY:
                            // THIS SHOULD ALWAYS TRACK THE LATEST VERSION THAT IS RELEASED.

                            $tmp_file_type_const = CRNRSTN_JS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib'. DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery' . DIRECTORY_SEPARATOR . '3.6.1' . DIRECTORY_SEPARATOR . 'jquery-3.6.1.min.map';
                            $tmp_file_name = 'jquery-3.6.1.min.map';
                            $tmp_meta_type = 'application/json';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery' . DIRECTORY_SEPARATOR . '3.6.1' . DIRECTORY_SEPARATOR . 'jquery-3.6.1.min.js';
                            $tmp_file_name = 'jquery-3.6.1.min.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery' . DIRECTORY_SEPARATOR . '3.6.1' . DIRECTORY_SEPARATOR . 'jquery-3.6.1.js';
                            $tmp_file_name = 'jquery-3.6.1.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_JS_FRAMEWORK_JQUERY_3_7_0:

                            error_log(__LINE__ . ' asaset mgr READY FOR IMPLEMENTATION [CRNRSTN_JS_FRAMEWORK_JQUERY_3_7_0].');

                        break;
                        case CRNRSTN_JS_FRAMEWORK_JQUERY_3_6_1:

                            $tmp_file_type_const = CRNRSTN_JS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery' . DIRECTORY_SEPARATOR . '3.6.1' . DIRECTORY_SEPARATOR . 'jquery-3.6.1.min.map';
                            $tmp_file_name = 'jquery-3.6.1.min.map';
                            $tmp_meta_type = 'application/json';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery' . DIRECTORY_SEPARATOR . '3.6.1' . DIRECTORY_SEPARATOR . 'jquery-3.6.1.min.js';
                            $tmp_file_name = 'jquery-3.6.1.min.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery' . DIRECTORY_SEPARATOR . '3.6.1' . DIRECTORY_SEPARATOR . 'jquery-3.6.1.js';
                            $tmp_file_name = 'jquery-3.6.1.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_JS_FRAMEWORK_JQUERY_2_2_4:

                            $tmp_file_type_const = CRNRSTN_JS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery' . DIRECTORY_SEPARATOR . '2.2.4' . DIRECTORY_SEPARATOR . 'jquery-2.2.4.min.js';
                            $tmp_file_name = 'jquery-2.2.4.min.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery' . DIRECTORY_SEPARATOR . '2.2.4' . DIRECTORY_SEPARATOR . 'jquery-2.2.4.js';
                            $tmp_file_name = 'jquery-2.2.4.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_JS_FRAMEWORK_JQUERY_1_12_4:

                            $tmp_file_type_const = CRNRSTN_JS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery' . DIRECTORY_SEPARATOR . '1.12.4' . DIRECTORY_SEPARATOR . 'jquery-1.12.4.min.js';
                            $tmp_file_name = 'jquery-1.12.4.min.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery' . DIRECTORY_SEPARATOR . '1.12.4' . DIRECTORY_SEPARATOR . 'jquery-1.12.4.js';
                            $tmp_file_name = 'jquery-1.12.4.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1:

                            $tmp_file_type_const = CRNRSTN_JS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery' . DIRECTORY_SEPARATOR . '1.11.1' . DIRECTORY_SEPARATOR . 'jquery-1.11.1.min.js';
                            $tmp_file_name = 'jquery-1.11.1.min.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_JS_FRAMEWORK_JQUERY_UI:
                            // THIS SHOULD ALWAYS TRACK THE LATEST VERSION THAT IS RELEASED.

                            $tmp_file_type_const = CRNRSTN_JS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_ui' . DIRECTORY_SEPARATOR . '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.theme.min.css';
                            $tmp_file_name = '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.theme.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_ui' . DIRECTORY_SEPARATOR . '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.structure.min.css';
                            $tmp_file_name = '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.structure.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_ui' . DIRECTORY_SEPARATOR . '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.min.css';
                            $tmp_file_name = '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_ui' . DIRECTORY_SEPARATOR . '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.theme.css';
                            $tmp_file_name = '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.theme.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_ui' . DIRECTORY_SEPARATOR . '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.structure.css';
                            $tmp_file_name = '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.structure.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_ui' . DIRECTORY_SEPARATOR . '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.css';
                            $tmp_file_name = '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            //
                            // CHECK FOR PREVIOUS LOAD OF JQUERY
                            if(!isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_1_12_4])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_2_2_4])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_3_6_1])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_3_7_0])
                                && !isset($this->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_PLUS_JQUERY])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY])){

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery' . DIRECTORY_SEPARATOR . '3.6.1' . DIRECTORY_SEPARATOR . 'jquery-3.6.1.min.js';
                                $tmp_file_name = 'jquery-3.6.1.min.js';
                                $tmp_meta_type = 'text/javascript';
                                $tmp_file_is_minimized = true;
                                $tmp_asset_minimization_mode_is_active = true;
                                $tmp_resource_dependency_constant = $const;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery' . DIRECTORY_SEPARATOR . '3.6.1' . DIRECTORY_SEPARATOR . 'jquery-3.6.1.js';
                                $tmp_file_name = 'jquery-3.6.1.js';
                                $tmp_meta_type = 'text/javascript';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = true;
                                $tmp_resource_dependency_constant = $const;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                                $tmp_str .= $this->return_mapped_resources(CRNRSTN_JS_FRAMEWORK_JQUERY, $footer_html_output);
                                /*//////////
                                //////////

                                */

                            }

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_ui' . DIRECTORY_SEPARATOR . '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.min.js';
                            $tmp_file_name = '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.min.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_ui' . DIRECTORY_SEPARATOR . '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.js';
                            $tmp_file_name = '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_JS_FRAMEWORK_JQUERY_UI_1_13_2:

                            $tmp_file_type_const = CRNRSTN_JS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_ui' . DIRECTORY_SEPARATOR . '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.theme.min.css';
                            $tmp_file_name = '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.theme.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_ui' . DIRECTORY_SEPARATOR . '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.structure.min.css';
                            $tmp_file_name = '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.structure.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_ui' . DIRECTORY_SEPARATOR . '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.min.css';
                            $tmp_file_name = '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_ui' . DIRECTORY_SEPARATOR . '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.theme.css';
                            $tmp_file_name = '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.theme.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_ui' . DIRECTORY_SEPARATOR . '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.structure.css';
                            $tmp_file_name = '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.structure.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_ui' . DIRECTORY_SEPARATOR . '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.css';
                            $tmp_file_name = '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            //
                            // CHECK FOR PREVIOUS LOAD OF JQUERY
                            if(!isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_1_12_4])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_2_2_4])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_3_6_1])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_3_7_0])
                                && !isset($this->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_PLUS_JQUERY])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY])){

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery' . DIRECTORY_SEPARATOR . '3.6.1' . DIRECTORY_SEPARATOR . 'jquery-3.6.1.min.js';
                                $tmp_file_name = 'jquery-3.6.1.min.js';
                                $tmp_meta_type = 'text/javascript';
                                $tmp_file_is_minimized = true;
                                $tmp_asset_minimization_mode_is_active = true;
                                $tmp_resource_dependency_constant = $const;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery' . DIRECTORY_SEPARATOR . '3.6.1' . DIRECTORY_SEPARATOR . 'jquery-3.6.1.js';
                                $tmp_file_name = 'jquery-3.6.1.js';
                                $tmp_meta_type = 'text/javascript';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = true;
                                $tmp_resource_dependency_constant = $const;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                                $tmp_str .= $this->return_mapped_resources(CRNRSTN_JS_FRAMEWORK_JQUERY, $footer_html_output);
                                /*//////////
                                //////////

                                */

                            }

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_ui' . DIRECTORY_SEPARATOR . '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.min.js';
                            $tmp_file_name = '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.min.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_ui' . DIRECTORY_SEPARATOR . '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.js';
                            $tmp_file_name = '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_JS_FRAMEWORK_JQUERY_UI_1_12_1:

                            $tmp_file_type_const = CRNRSTN_JS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_ui' . DIRECTORY_SEPARATOR . '1.12.1' . DIRECTORY_SEPARATOR . 'jquery-ui.theme.min.css';
                            $tmp_file_name = '1.12.1' . DIRECTORY_SEPARATOR . 'jquery-ui.theme.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_ui' . DIRECTORY_SEPARATOR . '1.12.1' . DIRECTORY_SEPARATOR . 'jquery-ui.structure.min.css';
                            $tmp_file_name = '1.12.1' . DIRECTORY_SEPARATOR . 'jquery-ui.structure.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_ui' . DIRECTORY_SEPARATOR . '1.12.1' . DIRECTORY_SEPARATOR . 'jquery-ui.min.css';
                            $tmp_file_name = '1.12.1' . DIRECTORY_SEPARATOR . 'jquery-ui.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_ui' . DIRECTORY_SEPARATOR . '1.12.1' . DIRECTORY_SEPARATOR . 'jquery-ui.theme.css';
                            $tmp_file_name = '1.12.1' . DIRECTORY_SEPARATOR . 'jquery-ui.theme.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_ui' . DIRECTORY_SEPARATOR . '1.12.1' . DIRECTORY_SEPARATOR . 'jquery-ui.structure.css';
                            $tmp_file_name = '1.12.1' . DIRECTORY_SEPARATOR . 'jquery-ui.structure.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_ui' . DIRECTORY_SEPARATOR . '1.12.1' . DIRECTORY_SEPARATOR . 'jquery-ui.css';
                            $tmp_file_name = '1.12.1' . DIRECTORY_SEPARATOR . 'jquery-ui.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources(CRNRSTN_JS_FRAMEWORK_JQUERY, $footer_html_output);
                            /*//////////
                            //////////

                            */

                            //
                            // CHECK FOR PREVIOUS LOAD OF JQUERY
                            if(!isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_1_12_4])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_2_2_4])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_3_6_1])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_3_7_0])
                                && !isset($this->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_PLUS_JQUERY])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY])){

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery' . DIRECTORY_SEPARATOR . '3.6.1' . DIRECTORY_SEPARATOR . 'jquery-3.6.1.min.js';
                                $tmp_file_name = 'jquery-3.6.1.min.js';
                                $tmp_meta_type = 'text/javascript';
                                $tmp_file_is_minimized = true;
                                $tmp_asset_minimization_mode_is_active = true;
                                $tmp_resource_dependency_constant = $const;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery' . DIRECTORY_SEPARATOR . '3.6.1' . DIRECTORY_SEPARATOR . 'jquery-3.6.1.js';
                                $tmp_file_name = 'jquery-3.6.1.js';
                                $tmp_meta_type = 'text/javascript';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = true;
                                $tmp_resource_dependency_constant = $const;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                                $tmp_str .= $this->return_mapped_resources(CRNRSTN_JS_FRAMEWORK_JQUERY, $footer_html_output);
                                /*//////////
                                //////////

                                */

                            }

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_ui' . DIRECTORY_SEPARATOR . '1.12.1' . DIRECTORY_SEPARATOR . 'jquery-ui.min.js';
                            $tmp_file_name = '1.12.1' . DIRECTORY_SEPARATOR . 'jquery-ui.min.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_ui' . DIRECTORY_SEPARATOR . '1.12.1' . DIRECTORY_SEPARATOR . 'jquery-ui.js';
                            $tmp_file_name = '1.12.1' . DIRECTORY_SEPARATOR . 'jquery-ui.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_JS_FRAMEWORK_JQUERY_MOBILE:

                            $tmp_file_type_const = CRNRSTN_JS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = 'crnrstn.jquery-mobile-external-png-1.4.5.min.css';
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_mobi' . DIRECTORY_SEPARATOR . '1.4.5' . DIRECTORY_SEPARATOR . 'jquery.mobile-1.4.5' . DIRECTORY_SEPARATOR . 'jquery.mobile.external-png-1.4.5.min.css';
                            $tmp_file_name = 'jquery.mobile.external-png-1.4.5.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = 'crnrstn.jquery-mobile-icons-1.4.5.min.css';
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_mobi' . DIRECTORY_SEPARATOR . '1.4.5' . DIRECTORY_SEPARATOR . 'jquery.mobile-1.4.5' . DIRECTORY_SEPARATOR . 'jquery.mobile.icons-1.4.5.min.css';
                            $tmp_file_name = 'jquery.mobile.icons-1.4.5.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = 'crnrstn.jquery-mobile-inline-png-1.4.5.min.css';
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_mobi' . DIRECTORY_SEPARATOR . '1.4.5' . DIRECTORY_SEPARATOR . 'jquery.mobile-1.4.5' . DIRECTORY_SEPARATOR . 'jquery.mobile.inline-png-1.4.5.min.css';
                            $tmp_file_name = 'jquery.mobile.inline-png-1.4.5.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = 'crnrstn.jquery-mobile-inline-svg-1.4.5.min.css';
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_mobi' . DIRECTORY_SEPARATOR . '1.4.5' . DIRECTORY_SEPARATOR . 'jquery.mobile-1.4.5' . DIRECTORY_SEPARATOR . 'jquery.mobile.inline-svg-1.4.5.min.css';
                            $tmp_file_name = 'jquery.mobile.inline-svg-1.4.5.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_mobi' . DIRECTORY_SEPARATOR . '1.4.5' . DIRECTORY_SEPARATOR . 'jquery.mobile-1.4.5' . DIRECTORY_SEPARATOR . 'jquery.mobile.structure-1.4.5.min.css';
                            $tmp_file_name = 'jquery.mobile.structure-1.4.5.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = 'crnrstn.jquery-mobile-theme-1.4.5.min.css';
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_mobi' . DIRECTORY_SEPARATOR . '1.4.5' . DIRECTORY_SEPARATOR . 'jquery.mobile-1.4.5' . DIRECTORY_SEPARATOR . 'jquery.mobile.theme-1.4.5.min.css';
                            $tmp_file_name = 'jquery.mobile.theme-1.4.5.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = 'crnrstn.jquery-mobile-1.4.5.min.css';
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_mobi' . DIRECTORY_SEPARATOR . '1.4.5' . DIRECTORY_SEPARATOR . 'jquery.mobile-1.4.5' . DIRECTORY_SEPARATOR . 'jquery.mobile-1.4.5.min.css';
                            $tmp_file_name = 'jquery.mobile-1.4.5.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = 'crnrstn.jquery-mobile-external-png-1.4.5.css';
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_mobi' . DIRECTORY_SEPARATOR . '1.4.5' . DIRECTORY_SEPARATOR . 'jquery.mobile-1.4.5' . DIRECTORY_SEPARATOR . 'jquery.mobile.external-png-1.4.5.css';
                            $tmp_file_name = 'jquery.mobile.external-png-1.4.5.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = 'crnrstn.jquery-mobile-icons-1.4.5.css';
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_mobi' . DIRECTORY_SEPARATOR . '1.4.5' . DIRECTORY_SEPARATOR . 'jquery.mobile-1.4.5' . DIRECTORY_SEPARATOR . 'jquery.mobile.icons-1.4.5.css';
                            $tmp_file_name = 'jquery.mobile.icons-1.4.5.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = 'crnrstn.jquery-mobile-inline-png-1.4.5.css';
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_mobi' . DIRECTORY_SEPARATOR . '1.4.5' . DIRECTORY_SEPARATOR . 'jquery.mobile-1.4.5' . DIRECTORY_SEPARATOR . 'jquery.mobile.inline-png-1.4.5.css';
                            $tmp_file_name = 'jquery.mobile.inline-png-1.4.5.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = 'crnrstn.jquery-mobile-inline-svg-1.4.5.css';
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_mobi' . DIRECTORY_SEPARATOR . '1.4.5' . DIRECTORY_SEPARATOR . 'jquery.mobile-1.4.5' . DIRECTORY_SEPARATOR . 'jquery.mobile.inline-svg-1.4.5.css';
                            $tmp_file_name = 'jquery.mobile.inline-svg-1.4.5.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_mobi' . DIRECTORY_SEPARATOR . '1.4.5' . DIRECTORY_SEPARATOR . 'jquery.mobile-1.4.5' . DIRECTORY_SEPARATOR . 'jquery.mobile.structure-1.4.5.css';
                            $tmp_file_name = 'jquery.mobile.structure-1.4.5.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = 'crnrstn.jquery-mobile-theme-1.4.5.css';
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_mobi' . DIRECTORY_SEPARATOR . '1.4.5' . DIRECTORY_SEPARATOR . 'jquery.mobile-1.4.5' . DIRECTORY_SEPARATOR . 'jquery.mobile.theme-1.4.5.css';
                            $tmp_file_name = 'jquery.mobile.theme-1.4.5.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = 'crnrstn.jquery-mobile-1.4.5.css';
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_mobi' . DIRECTORY_SEPARATOR . '1.4.5' . DIRECTORY_SEPARATOR . 'jquery.mobile-1.4.5' . DIRECTORY_SEPARATOR . 'jquery.mobile-1.4.5.css';
                            $tmp_file_name = 'jquery.mobile-1.4.5.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                            //
                            // CHECK FOR LOAD OF CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1, CRNRSTN_JS_FRAMEWORK_JQUERY_2_2_4, xxxx_3_6_1, CRNRSTN_JS_FRAMEWORK_JQUERY
                            if(!isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_1_12_4])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_2_2_4])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_3_6_1])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_3_7_0])
                                && !isset($this->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_PLUS_JQUERY])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY])){

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery' . DIRECTORY_SEPARATOR . '1.11.1' . DIRECTORY_SEPARATOR . 'jquery-1.11.1.min.js';
                                $tmp_file_name = 'jquery-1.11.1.min.js';
                                $tmp_meta_type = 'text/javascript';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = false;
                                $tmp_resource_dependency_constant = $const;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                                $tmp_str .= $this->return_mapped_resources(CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1, $footer_html_output);
                                /*//////////
                                //////////

                                */

                            }

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_mobi' . DIRECTORY_SEPARATOR . '1.4.5' . DIRECTORY_SEPARATOR . 'jquery.mobile-1.4.5' . DIRECTORY_SEPARATOR . 'index.js';
                            $tmp_file_name = 'jquery.mobile-1.4.5' . DIRECTORY_SEPARATOR . 'index.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_mobi' . DIRECTORY_SEPARATOR . '1.4.5' . DIRECTORY_SEPARATOR . 'jquery.mobile-1.4.5' . DIRECTORY_SEPARATOR . 'jquery.mobile-1.4.5.min.js';
                            $tmp_file_name = 'jquery.mobile-1.4.5.min.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_mobi' . DIRECTORY_SEPARATOR . '1.4.5' . DIRECTORY_SEPARATOR . 'jquery.mobile-1.4.5' . DIRECTORY_SEPARATOR . 'jquery.mobile-1.4.5.js';
                            $tmp_file_name = 'jquery.mobile-1.4.5.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS:
                            // THIS SHOULD ALWAYS TRACK THE LATEST VERSION THAT IS RELEASED.

                            $tmp_file_type_const = CRNRSTN_JS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = 'crnrstn.lightbox.min.css';
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'lightbox.js' . DIRECTORY_SEPARATOR . '2.11.3' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'lightbox.min.css';
                            $tmp_file_name = '2.11.3' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'lightbox.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = 'crnrstn.lightbox.css';
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'lightbox.js' . DIRECTORY_SEPARATOR . '2.11.3' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'lightbox.css';
                            $tmp_file_name = '2.11.3' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'lightbox.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                            //
                            // CHECK FOR PREVIOUS LOAD OF JQUERY
                            if(!isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_1_12_4])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_2_2_4])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_3_6_1])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_3_7_0])
                                && !isset($this->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_PLUS_JQUERY])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY])){

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery' . DIRECTORY_SEPARATOR . '3.6.1' . DIRECTORY_SEPARATOR . 'jquery-3.6.1.min.js';
                                $tmp_file_name = 'jquery-3.6.1.min.js';
                                $tmp_meta_type = 'text/javascript';
                                $tmp_file_is_minimized = true;
                                $tmp_asset_minimization_mode_is_active = true;
                                $tmp_resource_dependency_constant = $const;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery' . DIRECTORY_SEPARATOR . '3.6.1' . DIRECTORY_SEPARATOR . 'jquery-3.6.1.js';
                                $tmp_file_name = 'jquery-3.6.1.js';
                                $tmp_meta_type = 'text/javascript';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = true;
                                $tmp_resource_dependency_constant = $const;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                                $tmp_str .= $this->return_mapped_resources(CRNRSTN_JS_FRAMEWORK_JQUERY, $footer_html_output);
                                /*//////////
                                //////////

                                */

                            }

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'lightbox.js' . DIRECTORY_SEPARATOR . '2.11.3' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'lightbox.min.js';
                            $tmp_file_name = '2.11.3' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'lightbox.min.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'lightbox.js' . DIRECTORY_SEPARATOR . '2.11.3' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'lightbox.js';
                            $tmp_file_name = '2.11.3' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'lightbox.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_2_11_3:

                            $tmp_file_type_const = CRNRSTN_JS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = 'crnrstn.lightbox.min.css';
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'lightbox.js' . DIRECTORY_SEPARATOR . '2.11.3' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'lightbox.min.css';
                            $tmp_file_name = '2.11.3' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'lightbox.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = 'crnrstn.lightbox.css';
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'lightbox.js' . DIRECTORY_SEPARATOR . '2.11.3' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'lightbox.css';
                            $tmp_file_name = '2.11.3' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'lightbox.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                            //
                            // CHECK FOR PREVIOUS LOAD OF JQUERY.
                            if(!isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_1_12_4])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_2_2_4])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_3_6_1])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_3_7_0])
                                && !isset($this->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_PLUS_JQUERY])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY])){

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery' . DIRECTORY_SEPARATOR . '3.6.1' . DIRECTORY_SEPARATOR . 'jquery-3.6.1.min.js';
                                $tmp_file_name = 'jquery-3.6.1.min.js';
                                $tmp_meta_type = 'text/javascript';
                                $tmp_file_is_minimized = true;
                                $tmp_asset_minimization_mode_is_active = true;
                                $tmp_resource_dependency_constant = $const;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery' . DIRECTORY_SEPARATOR . '3.6.1' . DIRECTORY_SEPARATOR . 'jquery-3.6.1.js';
                                $tmp_file_name = 'jquery-3.6.1.js';
                                $tmp_meta_type = 'text/javascript';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = true;
                                $tmp_resource_dependency_constant = $const;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                                $tmp_str .= $this->return_mapped_resources(CRNRSTN_JS_FRAMEWORK_JQUERY, $footer_html_output);
                                /*//////////
                                //////////

                                */

                            }

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'lightbox.js' . DIRECTORY_SEPARATOR . '2.11.3' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'lightbox.min.js';
                            $tmp_file_name = '2.11.3' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'lightbox.min.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'lightbox.js' . DIRECTORY_SEPARATOR . '2.11.3' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'lightbox.js';
                            $tmp_file_name = '2.11.3' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'lightbox.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_2_10_0:

                            $tmp_file_type_const = CRNRSTN_JS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = 'crnrstn.lightbox.min.css';
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'lightbox.js' . DIRECTORY_SEPARATOR . '2.11.3' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'lightbox.min.css';
                            $tmp_file_name = '2.11.3' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'lightbox.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = 'crnrstn.lightbox.css';
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'lightbox.js' . DIRECTORY_SEPARATOR . '2.11.3' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'lightbox.css';
                            $tmp_file_name = '2.11.3' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'lightbox.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                            //
                            // CHECK FOR PREVIOUS LOAD OF JQUERY
                            if(!isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_1_12_4])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_2_2_4])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_3_6_1])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_3_7_0])
                                && !isset($this->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_PLUS_JQUERY])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY])){

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery' . DIRECTORY_SEPARATOR . '3.6.1' . DIRECTORY_SEPARATOR . 'jquery-3.6.1.min.js';
                                $tmp_file_name = 'jquery-3.6.1.min.js';
                                $tmp_meta_type = 'text/javascript';
                                $tmp_file_is_minimized = true;
                                $tmp_asset_minimization_mode_is_active = true;
                                $tmp_resource_dependency_constant = $const;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery' . DIRECTORY_SEPARATOR . '3.6.1' . DIRECTORY_SEPARATOR . 'jquery-3.6.1.js';
                                $tmp_file_name = 'jquery-3.6.1.js';
                                $tmp_meta_type = 'text/javascript';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = true;
                                $tmp_resource_dependency_constant = $const;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                                $tmp_str .= $this->return_mapped_resources(CRNRSTN_JS_FRAMEWORK_JQUERY, $footer_html_output);
                                /*//////////
                                //////////

                                */

                            }

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'lightbox.js' . DIRECTORY_SEPARATOR . '2.11.3' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'lightbox.min.js';
                            $tmp_file_name = '2.11.3' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'lightbox.min.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'lightbox.js' . DIRECTORY_SEPARATOR . '2.11.3' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'lightbox.js';
                            $tmp_file_name = '2.11.3' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'lightbox.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_PLUS_JQUERY:

                            $tmp_file_type_const = CRNRSTN_JS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = 'crnrstn.lightbox.min.css';
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'lightbox.js' . DIRECTORY_SEPARATOR . '2.11.3' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'lightbox.min.css';
                            $tmp_file_name = '2.11.3' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'lightbox.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = 'crnrstn.lightbox.css';
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'lightbox.js' . DIRECTORY_SEPARATOR . '2.11.3' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'lightbox.css';
                            $tmp_file_name = '2.11.3' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'lightbox.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'lightbox.js' . DIRECTORY_SEPARATOR . '2.11.3' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'lightbox-plus-jquery.min.js';
                            $tmp_file_name = '2.11.3' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'lightbox-plus-jquery.min.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'lightbox.js' . DIRECTORY_SEPARATOR . '2.11.3' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'lightbox-plus-jquery.js';
                            $tmp_file_name = '2.11.3' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'lightbox-plus-jquery.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources(CRNRSTN_JS_FRAMEWORK_JQUERY, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_2_03_3:

                            $tmp_file_type_const = CRNRSTN_JS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = 'crnrstn.lightbox-2.03.3.css';
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'lightbox.js' . DIRECTORY_SEPARATOR . '2.03.3' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'lightbox.css';
                            $tmp_file_name = '2.03.3' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'lightbox.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                            //
                            // CHECK FOR LOAD OF CRNRSTN_JS_FRAMEWORK_PROTOTYPE
                            if(!isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_PROTOTYPE])){

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'prototype.js' . DIRECTORY_SEPARATOR . '1.7.3' . DIRECTORY_SEPARATOR . 'prototype.js';
                                $tmp_file_name = 'prototype.js';
                                $tmp_meta_type = 'text/javascript';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = false;
                                $tmp_resource_dependency_constant = $const;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource(CRNRSTN_JS_FRAMEWORK_PROTOTYPE, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                                $tmp_str .= $this->return_mapped_resources(CRNRSTN_JS_FRAMEWORK_PROTOTYPE, $footer_html_output);
                                /*//////////
                                //////////

                                */

                            }

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = 'crnrstn.lightbox-2.03.3.js';
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'lightbox.js' . DIRECTORY_SEPARATOR . '2.03.3' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'lightbox.js';
                            $tmp_file_name = '2.03.3' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'lightbox.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_JS_FRAMEWORK_REACT_CDN:
                            // THIS SHOULD ALWAYS TRACK THE LATEST VERSION THAT IS RELEASED.

                            /*
                            <script crossorigin src="https://unpkg.com/react@18/umd/react.development.js"></script>
                            <script crossorigin src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>
                            <script crossorigin src="https://unpkg.com/react@18/umd/react.production.min.js"></script>
                            <script crossorigin src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js"></script>

                            */

                            //
                            // DO NOT CALL flag_built_head_resource() (AND ABORT ANY $tmp_str CONCAT)
                            // IF $tmp_spool_asset_for_footer_html = true;
                            $this->oCRNRSTN->flag_built_head_resource($const);

                            $tmp_ARRAY = $this->oCRNRSTN->return_int_const_profile($const);

                            if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

                                if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64){

                                    $tmp_str .= '    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' -->
    <script>
    ' . file_get_contents('https://unpkg.com/react@18.2.0/umd/react.production.min.js') . '
    </script>
';

                                }else{

                                    $tmp_str .= '    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' -->
    <script src="https://unpkg.com/react@18.2.0/umd/react.production.min.js" crossorigin></script>
';

                                }

                            }else{

                                if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64){

                                    $tmp_str .= '    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' -->
    <script>
    ' . file_get_contents('https://unpkg.com/react@18.2.0/umd/react.development.js') . '
    </script>
';
                                }else{

                                    $tmp_str .= '    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' -->
    <script src="https://unpkg.com/react@18.2.0/umd/react.development.js" crossorigin></script>
';

                                }

                            }

                        break;
                        case CRNRSTN_JS_FRAMEWORK_REACT_CDN_18_2_0:

                            /*
                            <script crossorigin src="https://unpkg.com/react@18/umd/react.development.js"></script>
                            <script crossorigin src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>
                            <script crossorigin src="https://unpkg.com/react@18/umd/react.production.min.js"></script>
                            <script crossorigin src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js"></script>

                            */

                            //
                            // DO NOT CALL flag_built_head_resource() (AND ABORT ANY $tmp_str CONCAT)
                            // IF $tmp_spool_asset_for_footer_html = true;
                            $this->oCRNRSTN->flag_built_head_resource($const);

                            $tmp_ARRAY = $this->oCRNRSTN->return_int_const_profile($const);

                            if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

                                if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64){

                                    $tmp_str .= '    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' -->
    <script>
    ' . file_get_contents('https://unpkg.com/react@18.2.0/umd/react.production.min.js') . '
    </script>
';

                                }else{

                                    $tmp_str .= '    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' -->
    <script src="https://unpkg.com/react@18.2.0/umd/react.production.min.js" crossorigin></script>
';

                                }

                            }else{

                                if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64){

                                    $tmp_str .= '    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' -->
    <script>
    ' . file_get_contents('https://unpkg.com/react@18.2.0/umd/react.development.js') . '
    </script>
';
                                }else{

                                    $tmp_str .= '    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' -->
    <script src="https://unpkg.com/react@18.2.0/umd/react.development.js" crossorigin></script>
';

                                }

                            }

                        break;
                        case CRNRSTN_JS_FRAMEWORK_REACT_DOM_CDN:
                            // THIS SHOULD ALWAYS TRACK THE LATEST VERSION THAT IS RELEASED.

                            //
                            // DO NOT CALL flag_built_head_resource() (AND ABORT ANY $tmp_str CONCAT)
                            // IF $tmp_spool_asset_for_footer_html = true;
                            $this->oCRNRSTN->flag_built_head_resource($const);

                            $tmp_ARRAY = $this->oCRNRSTN->return_int_const_profile($const);

                            if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

                                if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64){

                                    $tmp_str .= '    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' -->
    <script>
    ' . file_get_contents('https://unpkg.com/react@18.2.0/umd/react.production.min.js') . '
    </script>

    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' -->
    <script>
    ' . file_get_contents('https://unpkg.com/react-dom@18.2.0/umd/react-dom.production.min.js') . '
    </script>
';

                                }else{

                                    $tmp_str .= '    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' -->
    <script src="https://unpkg.com/react@18.2.0/umd/react.production.min.js" crossorigin></script>
    <script src="https://unpkg.com/react-dom@18.2.0/umd/react-dom.production.min.js" crossorigin></script>
';

                                }

                            }else{

                                if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64){

                                    $tmp_str .= '    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' -->
    <script>
    ' . file_get_contents('https://unpkg.com/react@18.2.0/umd/react.development.js') . '
    </script>

    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' -->
    <script>
    ' . file_get_contents('https://unpkg.com/react-dom@18.2.0/umd/react-dom.development.js') . '
    </script>
';

                                }else{

                                    $tmp_str .= '    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' -->
    <script crossorigin src="https://unpkg.com/react@18.2.0/umd/react.development.js"></script>
    <script crossorigin src="https://unpkg.com/react-dom@18.2.0/umd/react-dom.development.js"></script>
';

                                }

                            }

                        break;
                        case CRNRSTN_JS_FRAMEWORK_REACT_DOM_CDN_18_2_0:

                            //
                            // DO NOT CALL flag_built_head_resource() (AND ABORT ANY $tmp_str CONCAT)
                            // IF $tmp_spool_asset_for_footer_html = true;
                            $this->oCRNRSTN->flag_built_head_resource($const);

                            $tmp_ARRAY = $this->oCRNRSTN->return_int_const_profile($const);

                            if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

                                if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64){

                                    $tmp_str .= '    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' -->
    <script>
    ' . file_get_contents('https://unpkg.com/react@18.2.0/umd/react.production.min.js') . '
    </script>

    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' -->
    <script>
    ' . file_get_contents('https://unpkg.com/react-dom@18.2.0/umd/react-dom.production.min.js') . '
    </script>
';

                                }else{

                                    $tmp_str .= '    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' -->
    <script src="https://unpkg.com/react@18.2.0/umd/react.production.min.js" crossorigin></script>
    <script src="https://unpkg.com/react-dom@18.2.0/umd/react-dom.production.min.js" crossorigin></script>
';

                                }

                            }else{

                                if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64){

                                    $tmp_str .= '    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' -->
    <script>
    ' . file_get_contents('https://unpkg.com/react@18.2.0/umd/react.development.js') . '
    </script>

    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' -->
    <script>
    ' . file_get_contents('https://unpkg.com/react-dom@18.2.0/umd/react-dom.development.js') . '
    </script>
';

                                }else{

                                    $tmp_str .= '    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' -->
    <script crossorigin src="https://unpkg.com/react@18.2.0/umd/react.development.js"></script>
    <script crossorigin src="https://unpkg.com/react-dom@18.2.0/umd/react-dom.development.js"></script>
';

                                }

                            }

                        break;
                        case CRNRSTN_JS_FRAMEWORK_MITHRIL_CDN:
                            // THIS SHOULD ALWAYS TRACK THE LATEST VERSION THAT IS RELEASED.

                            //
                            // DO NOT CALL flag_built_head_resource() (AND ABORT ANY $tmp_str CONCAT)
                            // IF $tmp_spool_asset_for_footer_html = true;
                            $this->oCRNRSTN->flag_built_head_resource($const);

                            /*
                            <!-- Development: whichever you prefer -->
                            <script src="https://unpkg.com/mithril/mithril.js"></script>
                            <script src="https://cdn.jsdelivr.net/npm/mithril/mithril.js"></script>

                            <!-- Production: whichever you prefer -->
                            <script src="https://unpkg.com/mithril/mithril.min.js"></script>
                            <script src="https://cdn.jsdelivr.net/npm/mithril/mithril.min.js"></script>

                            */

                            $tmp_ARRAY = $this->oCRNRSTN->return_int_const_profile($const);

                            if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

                                if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64){

                                    $tmp_str .= '    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' -->
    <script>
    ' . file_get_contents('https://cdn.jsdelivr.net/npm/mithril/mithril.min.js') . '
    </script>
';
                                }else{

                                    $tmp_str .= '    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' -->
                                <script src="https://cdn.jsdelivr.net/npm/mithril/mithril.min.js" crossorigin></script>
';

                                }

                            }else{

                                if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64){

                                    $tmp_str .= '    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' -->
    <script>
    ' . file_get_contents('https://unpkg.com/mithril/mithril.js') . '
    </script>
';

                                }else{

                                    $tmp_str .= '    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' -->
                                <script src="https://unpkg.com/mithril@2.2.2/mithril.js" crossorigin></script>
';

                                }

                            }

                        break;
                        case CRNRSTN_JS_FRAMEWORK_MITHRIL_CDN_2_2_2:

                            //
                            // DO NOT CALL flag_built_head_resource() (AND ABORT ANY $tmp_str CONCAT)
                            // IF $tmp_spool_asset_for_footer_html = true;
                            $this->oCRNRSTN->flag_built_head_resource($const);

                            /*
                            <!-- Development: whichever you prefer -->
                            <script src="https://unpkg.com/mithril/mithril.js"></script>
                            <script src="https://cdn.jsdelivr.net/npm/mithril/mithril.js"></script>

                            <!-- Production: whichever you prefer -->
                            <script src="https://unpkg.com/mithril/mithril.min.js"></script>
                            <script src="https://cdn.jsdelivr.net/npm/mithril/mithril.min.js"></script>

                            */

                            $tmp_ARRAY = $this->oCRNRSTN->return_int_const_profile($const);

                            if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

                                if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64){

                                    $tmp_str .= '    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' -->
    <script>
    ' . file_get_contents('https://cdn.jsdelivr.net/npm/mithril/mithril.min.js') . '
    </script>
';
                                }else{

                                    $tmp_str .= '    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' -->
                                <script src="https://cdn.jsdelivr.net/npm/mithril/mithril.min.js" crossorigin></script>
';

                                }

                            }else{

                                if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64){

                                    $tmp_str .= '    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' -->
    <script>
    ' . file_get_contents('https://unpkg.com/mithril/mithril.js') . '
    </script>
';

                                }else{

                                    $tmp_str .= '    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' -->
                                <script src="https://unpkg.com/mithril@2.2.2/mithril.js" crossorigin></script>
';

                                }

                            }

                        break;
                        case CRNRSTN_JS_FRAMEWORK_BACKBONE:
                            // THIS SHOULD ALWAYS TRACK THE LATEST VERSION THAT IS RELEASED.

                            $tmp_file_type_const = CRNRSTN_JS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'backbone' . DIRECTORY_SEPARATOR . '1.4.1' . DIRECTORY_SEPARATOR . 'backbone.min.map';
                            $tmp_file_name = '1.4.1' . DIRECTORY_SEPARATOR . 'backbone.min.map';
                            $tmp_meta_type = 'application/json';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = 'crnrstn.backbone_1_4_1.min.js';
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'backbone' . DIRECTORY_SEPARATOR . '1.4.1' . DIRECTORY_SEPARATOR . 'backbone.min.js';
                            $tmp_file_name = '1.4.1' . DIRECTORY_SEPARATOR . 'backbone.min.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'backbone' . DIRECTORY_SEPARATOR . '1.4.1' . DIRECTORY_SEPARATOR . 'backbone.js';
                            $tmp_file_name = '1.4.1' . DIRECTORY_SEPARATOR . 'backbone.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_JS_FRAMEWORK_BACKBONE_1_4_1:

                            $tmp_file_type_const = CRNRSTN_JS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'backbone' . DIRECTORY_SEPARATOR . '1.4.1' . DIRECTORY_SEPARATOR . 'backbone.min.map';
                            $tmp_file_name = '1.4.1' . DIRECTORY_SEPARATOR . 'backbone.min.map';
                            $tmp_meta_type = 'application/json';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = 'crnrstn.backbone_1_4_1.min.js';
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'backbone' . DIRECTORY_SEPARATOR . '1.4.1' . DIRECTORY_SEPARATOR . 'backbone.min.js';
                            $tmp_file_name = '1.4.1' . DIRECTORY_SEPARATOR . 'backbone.min.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'backbone' . DIRECTORY_SEPARATOR . '1.4.1' . DIRECTORY_SEPARATOR . 'backbone.js';
                            $tmp_file_name = '1.4.1' . DIRECTORY_SEPARATOR . 'backbone.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_JS_FRAMEWORK_PROTOTYPE:
                            // THIS SHOULD ALWAYS TRACK THE LATEST VERSION THAT IS RELEASED.

                            $tmp_file_type_const = CRNRSTN_JS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'prototype.js' . DIRECTORY_SEPARATOR . '1.7.3' . DIRECTORY_SEPARATOR . 'prototype.js';
                            $tmp_file_name = 'prototype.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_JS_FRAMEWORK_PROTOTYPE_1_7_3:

                            $tmp_file_type_const = CRNRSTN_JS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'prototype.js' . DIRECTORY_SEPARATOR . '1.7.3' . DIRECTORY_SEPARATOR . 'prototype.js';
                            $tmp_file_name = 'prototype.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_JS_FRAMEWORK_SCRIPTACULOUS:

                            $tmp_file_type_const = CRNRSTN_JS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_JS & CRNRSTN_ASSET_MODE_BASE64;

                            //
                            // CHECK FOR LOAD OF CRNRSTN_JS_FRAMEWORK_PROTOTYPE.
                            if(!isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_PROTOTYPE])){

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'prototype.js' . DIRECTORY_SEPARATOR . '1.7.3' . DIRECTORY_SEPARATOR . 'prototype.js';
                                $tmp_file_name = 'prototype.js';
                                $tmp_meta_type = 'text/javascript';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = false;
                                $tmp_resource_dependency_constant = $const;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource(CRNRSTN_JS_FRAMEWORK_PROTOTYPE, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                                $tmp_str .= $this->return_mapped_resources(CRNRSTN_JS_FRAMEWORK_PROTOTYPE, $footer_html_output);
                                /*//////////
                                //////////

                                */

                            }

                            if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_ASSET_MAPPING) == true){

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'script.aculo.us' . DIRECTORY_SEPARATOR . '1.9.0' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'scriptaculous.js';
                                $tmp_file_name = 'scriptaculous.js';
                                $tmp_meta_type = 'text/javascript';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = false;
                                $tmp_resource_dependency_constant = NULL;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'script.aculo.us' . DIRECTORY_SEPARATOR . '1.9.0' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'builder.js';
                                $tmp_file_name = 'builder.js';
                                $tmp_meta_type = 'text/javascript';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = false;
                                $tmp_resource_dependency_constant = NULL;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'script.aculo.us' . DIRECTORY_SEPARATOR . '1.9.0' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'effects.js';
                                $tmp_file_name = 'effects.js';
                                $tmp_meta_type = 'text/javascript';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = false;
                                $tmp_resource_dependency_constant = NULL;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'script.aculo.us' . DIRECTORY_SEPARATOR . '1.9.0' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'controls.js';
                                $tmp_file_name = 'controls.js';
                                $tmp_meta_type = 'text/javascript';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = false;
                                $tmp_resource_dependency_constant = NULL;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'script.aculo.us' . DIRECTORY_SEPARATOR . '1.9.0' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'dragdrop.js';
                                $tmp_file_name = 'dragdrop.js';
                                $tmp_meta_type = 'text/javascript';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = false;
                                $tmp_resource_dependency_constant = NULL;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);


                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'script.aculo.us' . DIRECTORY_SEPARATOR . '1.9.0' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'slider.js';
                                $tmp_file_name = 'slider.js';
                                $tmp_meta_type = 'text/javascript';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = false;
                                $tmp_resource_dependency_constant = NULL;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'script.aculo.us' . DIRECTORY_SEPARATOR . '1.9.0' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'sound.js';
                                $tmp_file_name = 'sound.js';
                                $tmp_meta_type = 'text/javascript';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = false;
                                $tmp_resource_dependency_constant = NULL;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                                $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                                /*//////////
                                //////////

                                */

                            }else{

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'script.aculo.us' . DIRECTORY_SEPARATOR . '1.9.0' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'scriptaculous.js';
                                $tmp_file_name = 'scriptaculous.js';
                                $tmp_meta_type = 'text/javascript';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = false;
                                $tmp_resource_dependency_constant = NULL;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                                $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                                /*//////////
                                //////////

                                */

                            }

                        break;
                        case CRNRSTN_JS_FRAMEWORK_PROTOTYPE_MOOFX:

                            $tmp_file_type_const = CRNRSTN_JS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_JS & CRNRSTN_ASSET_MODE_BASE64;

                            //
                            // CHECK FOR LOAD OF CRNRSTN_JS_FRAMEWORK_PROTOTYPE
                            if(!isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_PROTOTYPE])){

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'prototype.js' . DIRECTORY_SEPARATOR . '1.7.3' . DIRECTORY_SEPARATOR . 'prototype.js';
                                $tmp_file_name = 'prototype.js';
                                $tmp_meta_type = 'text/javascript';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = false;
                                $tmp_resource_dependency_constant = $const;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource(CRNRSTN_JS_FRAMEWORK_PROTOTYPE, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                                $tmp_str .= $this->return_mapped_resources(CRNRSTN_JS_FRAMEWORK_PROTOTYPE, $footer_html_output);
                                /*//////////
                                //////////

                                */

                            }

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'moo.fx' . DIRECTORY_SEPARATOR . '2.0' . DIRECTORY_SEPARATOR . 'source' . DIRECTORY_SEPARATOR . 'moo.fx.js';
                            $tmp_file_name = 'moo.fx.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'moo.fx' . DIRECTORY_SEPARATOR . '2.0' . DIRECTORY_SEPARATOR . 'source' . DIRECTORY_SEPARATOR . 'moo.fx.pack.js';
                            $tmp_file_name = 'moo.fx.pack.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'moo.fx' . DIRECTORY_SEPARATOR . '2.0' . DIRECTORY_SEPARATOR . 'source' . DIRECTORY_SEPARATOR . 'moo.fx.utils.js';
                            $tmp_file_name = 'moo.fx.utils.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'moo.fx' . DIRECTORY_SEPARATOR . '2.0' . DIRECTORY_SEPARATOR . 'source' . DIRECTORY_SEPARATOR . 'moo.fx.accordion.js';
                            $tmp_file_name = 'moo.fx.accordion.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'moo.fx' . DIRECTORY_SEPARATOR . '2.0' . DIRECTORY_SEPARATOR . 'source' . DIRECTORY_SEPARATOR . 'moo.fx.transitions.js';
                            $tmp_file_name = 'moo.fx.transitions.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_JS_FRAMEWORK_MOOTOOLS_MORE:
                            // THIS SHOULD ALWAYS TRACK THE LATEST VERSION THAT IS RELEASED.

                            $tmp_file_type_const = CRNRSTN_JS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'mootools' . DIRECTORY_SEPARATOR . 'more' . DIRECTORY_SEPARATOR . '1.6.0' . DIRECTORY_SEPARATOR . 'mootools-more-1.6.0-min.js';
                            $tmp_file_name = 'mootools-more-1.6.0-min.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'mootools' . DIRECTORY_SEPARATOR . 'more' . DIRECTORY_SEPARATOR . '1.6.0' . DIRECTORY_SEPARATOR . 'mootools-more-1.6.0.js';
                            $tmp_file_name = 'mootools-more-1.6.0.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_JS_FRAMEWORK_MOOTOOLS_MORE_1_6_0:

                            $tmp_file_type_const = CRNRSTN_JS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'mootools' . DIRECTORY_SEPARATOR . 'more' . DIRECTORY_SEPARATOR . '1.6.0' . DIRECTORY_SEPARATOR . 'mootools-more-1.6.0-min.js';
                            $tmp_file_name = 'mootools-more-1.6.0-min.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'mootools' . DIRECTORY_SEPARATOR . 'more' . DIRECTORY_SEPARATOR . '1.6.0' . DIRECTORY_SEPARATOR . 'mootools-more-1.6.0.js';
                            $tmp_file_name = 'mootools-more-1.6.0.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_JS_FRAMEWORK_MOOTOOLS_CORE:
                            // THIS SHOULD ALWAYS TRACK THE LATEST VERSION THAT IS RELEASED.

                            $tmp_file_type_const = CRNRSTN_JS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'mootools' . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . '1.6.0' . DIRECTORY_SEPARATOR . 'mootools-core-1.6.0-min.js';
                            $tmp_file_name = 'mootools-core-1.6.0-min.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'mootools' . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . '1.6.0' . DIRECTORY_SEPARATOR . 'mootools-core-1.6.0.js';
                            $tmp_file_name = 'mootools-core-1.6.0.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_JS_FRAMEWORK_MOOTOOLS_CORE_1_6_0:

                            $tmp_file_type_const = CRNRSTN_JS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'mootools' . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . '1.6.0' . DIRECTORY_SEPARATOR . 'mootools-core-1.6.0-min.js';
                            $tmp_file_name = 'mootools-core-1.6.0-min.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'mootools' . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . '1.6.0' . DIRECTORY_SEPARATOR . 'mootools-core-1.6.0.js';
                            $tmp_file_name = 'mootools-core-1.6.0.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_JS_MAIN:

                            $tmp_file_type_const = CRNRSTN_JS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = 'crnrstn.lightbox.min.css';
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'lightbox.js' . DIRECTORY_SEPARATOR . '2.11.3' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'lightbox.min.css';
                            $tmp_file_name = '2.11.3' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'lightbox.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource(CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = 'crnrstn.lightbox.css';
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'lightbox.js' . DIRECTORY_SEPARATOR . '2.11.3' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'lightbox.css';
                            $tmp_file_name = '2.11.3' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'lightbox.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource(CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources(CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS, $footer_html_output);
                            /*//////////
                            //////////

                            */

                            //
                            // CHECK FOR PREVIOUS LOAD OF JQUERY
                            if(!isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_1_12_4])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_2_2_4])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_3_6_1])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_3_7_0])
                                && !isset($this->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_PLUS_JQUERY])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY])){

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery' . DIRECTORY_SEPARATOR . '3.6.1' . DIRECTORY_SEPARATOR . 'jquery-3.6.1.min.js';
                                $tmp_file_name = 'jquery-3.6.1.min.js';
                                $tmp_meta_type = 'text/javascript';
                                $tmp_file_is_minimized = true;
                                $tmp_asset_minimization_mode_is_active = true;
                                $tmp_resource_dependency_constant = $const;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery' . DIRECTORY_SEPARATOR . '3.6.1' . DIRECTORY_SEPARATOR . 'jquery-3.6.1.js';
                                $tmp_file_name = 'jquery-3.6.1.js';
                                $tmp_meta_type = 'text/javascript';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = true;
                                $tmp_resource_dependency_constant = $const;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                                $tmp_str .= $this->return_mapped_resources(CRNRSTN_JS_FRAMEWORK_JQUERY, $footer_html_output);
                                /*//////////
                                //////////

                                */

                            }

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_ui' . DIRECTORY_SEPARATOR . '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.theme.min.css';
                            $tmp_file_name = '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.theme.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY_UI, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_ui' . DIRECTORY_SEPARATOR . '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.structure.min.css';
                            $tmp_file_name = '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.structure.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY_UI, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_ui' . DIRECTORY_SEPARATOR . '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.min.css';
                            $tmp_file_name = '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY_UI, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_ui' . DIRECTORY_SEPARATOR . '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.theme.css';
                            $tmp_file_name = '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.theme.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY_UI, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_ui' . DIRECTORY_SEPARATOR . '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.structure.css';
                            $tmp_file_name = '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.structure.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY_UI, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_ui' . DIRECTORY_SEPARATOR . '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.css';
                            $tmp_file_name = '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY_UI, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_ui' . DIRECTORY_SEPARATOR . '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.min.js';
                            $tmp_file_name = '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.min.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY_UI, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery_ui' . DIRECTORY_SEPARATOR . '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.js';
                            $tmp_file_name = '1.13.2' . DIRECTORY_SEPARATOR . 'jquery-ui.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY_UI, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources(CRNRSTN_JS_FRAMEWORK_JQUERY_UI, $footer_html_output);
                            /*//////////
                            //////////

                            */

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . 'crnrstn.main.js';
                            $tmp_file_name = 'crnrstn.main.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;

                    }

                    if(strlen($tmp_str) > 0 && ($this->oCRNRSTN->is_serialized_bit_set('crnrstn_html_comments_mode', CRNRSTN_HTML_COMMENTS_SILENT_GOLD) == true)){

                        $tmp_str_array[] = $tmp_start_str;

                        $tmp_str_array[] = $tmp_str;

                        if($tmp_show_comments == true){

                            $tmp_str_array[] = '    ' . $this->oCRNRSTN->html_version_burn('JS + CSS MODULE', 'END') . '
';

                        }

                    }

                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Received unknown asset mode [' . print_r($asset_mode_ARRAY, true) . '] from the system.');

                    break;

            }

            return $tmp_str_array;

        }catch (Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return $tmp_str_array;

        }

    }

    private function return_output_CRNRSTN_CSS($const, $footer_html_output = false, $is_dev_mode = NULL){

        try{

            $asset_mode_ARRAY = $this->oCRNRSTN->return_set_bits($this->oCRNRSTN->system_output_profile_constants_ARRAY(), true);

            $tmp_str = '';
            $tmp_start_str = '';
            $tmp_str_array = array();
            $tmp_show_comments = true;

            if($this->oCRNRSTN->is_serialized_bit_set('crnrstn_html_comments_mode', CRNRSTN_HTML_COMMENTS_SILENT_GOLD) !== true){

                $tmp_show_comments = false;

            }

            if(isset($is_dev_mode)){

                if($is_dev_mode == true){

                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

                        $tmp_min_js_css_bool_cache = true;

                        //
                        // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                        // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                        $this->oCRNRSTN->initialize_bit(CRNRSTN_JS_CSS_PROD_MIN, false);

                    }

                }else{

                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

                        $tmp_min_js_css_bool_cache = false;

                        //
                        // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                        // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                        $this->oCRNRSTN->initialize_bit(CRNRSTN_JS_CSS_PROD_MIN, false);

                    }

                }

            }

            switch($asset_mode_ARRAY[0]){
                case CRNRSTN_ASSET_MODE_PNG:
                case CRNRSTN_ASSET_MODE_JPEG:

                    if($tmp_show_comments == true){

                        $tmp_start_str = '
    ' . $this->oCRNRSTN->html_version_burn('CSS MODULE');

                    }

                    switch ($const){
                        case CRNRSTN_CSS_FRAMEWORK_SIMPLE_GRID:

                            $tmp_file_type_const = CRNRSTN_CSS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'simple_grid' . DIRECTORY_SEPARATOR . 'simple-grid.min.css';
                            $tmp_file_name = 'simple-grid.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'simple_grid' . DIRECTORY_SEPARATOR . 'simple-grid.css';
                            $tmp_file_name = 'simple-grid.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM:

                            $tmp_file_type_const = CRNRSTN_CSS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            /*
                            RTL
                            <link rel="stylesheet" href="css/reset_rtl.css" />
                            <link rel="stylesheet" href="css/text_rtl.css" />
                            <link rel="stylesheet" href="css/960_rtl.css" />

                            24COL_RTL
                            <link rel="stylesheet" href="css/reset_rtl.css" />
                            <link rel="stylesheet" href="css/text_rtl.css" />
                            <link rel="stylesheet" href="css/960_24_col_rtl.css" />

                            16COL_RTL
                            <link rel="stylesheet" href="css/reset_rtl.css" />
                            <link rel="stylesheet" href="css/text_rtl.css" />
                            <link rel="stylesheet" href="css/960_16_col_rtl.css" />

                            12COL_RTL
                            <link rel="stylesheet" href="css/reset_rtl.css" />
                            <link rel="stylesheet" href="css/text_rtl.css" />
                            <link rel="stylesheet" href="css/960_12_col_rtl.css" />

                            24COL
                            <link rel="stylesheet" href="css/reset.css" />
                            <link rel="stylesheet" href="css/text.css" />
                            <link rel="stylesheet" href="css/960_24_col.css" />

                            960_GRID_SYSTEM
                            <link rel="stylesheet" href="css/reset.css" />
                            <link rel="stylesheet" href="css/text.css" />
                            <link rel="stylesheet" href="css/960.css" />

                            */

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'min' . DIRECTORY_SEPARATOR . 'reset.css';
                            $tmp_file_name = 'min' . DIRECTORY_SEPARATOR . 'reset.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'reset.css';
                            $tmp_file_name = 'reset.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'min' . DIRECTORY_SEPARATOR . 'text.css';
                            $tmp_file_name = 'min' . DIRECTORY_SEPARATOR . 'text.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'text.css';
                            $tmp_file_name = 'text.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'min' . DIRECTORY_SEPARATOR . '960.css';
                            $tmp_file_name = 'min' . DIRECTORY_SEPARATOR . '960.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . '960.css';
                            $tmp_file_name = '960.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_24COL:

                            $tmp_file_type_const = CRNRSTN_CSS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'min' . DIRECTORY_SEPARATOR . 'reset.css';
                            $tmp_file_name = 'min' . DIRECTORY_SEPARATOR . 'reset.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'reset.css';
                            $tmp_file_name = 'reset.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'min' . DIRECTORY_SEPARATOR . 'text.css';
                            $tmp_file_name = 'min' . DIRECTORY_SEPARATOR . 'text.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'text.css';
                            $tmp_file_name = 'text.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'min' . DIRECTORY_SEPARATOR . '960_24_col.css';
                            $tmp_file_name = 'min' . DIRECTORY_SEPARATOR . '960_24_col.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . '960_24_col.css';
                            $tmp_file_name = '960_24_col.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_16COL:

                            $tmp_file_type_const = CRNRSTN_CSS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'min' . DIRECTORY_SEPARATOR . 'reset.css';
                            $tmp_file_name = 'min' . DIRECTORY_SEPARATOR . 'reset.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'reset.css';
                            $tmp_file_name = 'reset.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'min' . DIRECTORY_SEPARATOR . 'text.css';
                            $tmp_file_name = 'min' . DIRECTORY_SEPARATOR . 'text.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'text.css';
                            $tmp_file_name = 'text.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'min' . DIRECTORY_SEPARATOR . '960_16_col.css';
                            $tmp_file_name = 'min' . DIRECTORY_SEPARATOR . '960_16_col.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . '960_16_col.css';
                            $tmp_file_name = '960_16_col.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_12COL:

                            $tmp_file_type_const = CRNRSTN_CSS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'min' . DIRECTORY_SEPARATOR . 'reset.css';
                            $tmp_file_name = 'min' . DIRECTORY_SEPARATOR . 'reset.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'reset.css';
                            $tmp_file_name = 'reset.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'min' . DIRECTORY_SEPARATOR . 'text.css';
                            $tmp_file_name = 'min' . DIRECTORY_SEPARATOR . 'text.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'text.css';
                            $tmp_file_name = 'text.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'min' . DIRECTORY_SEPARATOR . '960_12_col.css';
                            $tmp_file_name = 'min' . DIRECTORY_SEPARATOR . '960_12_col.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . '960_12_col.css';
                            $tmp_file_name = '960_12_col.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_24COL_RTL:

                            $tmp_file_type_const = CRNRSTN_CSS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'min' . DIRECTORY_SEPARATOR . 'reset.css';
                            $tmp_file_name = 'min' . DIRECTORY_SEPARATOR . 'reset.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'reset.css';
                            $tmp_file_name = 'reset.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'min' . DIRECTORY_SEPARATOR . 'text.css';
                            $tmp_file_name = 'min' . DIRECTORY_SEPARATOR . 'text.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'text.css';
                            $tmp_file_name = 'text.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'min' . DIRECTORY_SEPARATOR . '960_24_col_rtl.css';
                            $tmp_file_name = 'min' . DIRECTORY_SEPARATOR . '960_24_col_rtl.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . '960_24_col_rtl.css';
                            $tmp_file_name = '960_24_col_rtl.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_16COL_RTL:

                            $tmp_file_type_const = CRNRSTN_CSS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'min' . DIRECTORY_SEPARATOR . 'reset.css';
                            $tmp_file_name = 'min' . DIRECTORY_SEPARATOR . 'reset.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'reset.css';
                            $tmp_file_name = 'reset.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'min' . DIRECTORY_SEPARATOR . 'text.css';
                            $tmp_file_name = 'min' . DIRECTORY_SEPARATOR . 'text.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'text.css';
                            $tmp_file_name = 'text.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'min' . DIRECTORY_SEPARATOR . '960_16_col_rtl.css';
                            $tmp_file_name = 'min' . DIRECTORY_SEPARATOR . '960_16_col_rtl.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . '960_16_col_rtl.css';
                            $tmp_file_name = '960_16_col_rtl.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_12COL_RTL:

                            $tmp_file_type_const = CRNRSTN_CSS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'min' . DIRECTORY_SEPARATOR . 'reset.css';
                            $tmp_file_name = 'min' . DIRECTORY_SEPARATOR . 'reset.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'reset.css';
                            $tmp_file_name = 'reset.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'min' . DIRECTORY_SEPARATOR . 'text.css';
                            $tmp_file_name = 'min' . DIRECTORY_SEPARATOR . 'text.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'text.css';
                            $tmp_file_name = 'text.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'min' . DIRECTORY_SEPARATOR . '960_12_col_rtl.css';
                            $tmp_file_name = 'min' . DIRECTORY_SEPARATOR . '960_12_col_rtl.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . '960_12_col_rtl.css';
                            $tmp_file_name = '960_12_col_rtl.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_RTL:

                            $tmp_file_type_const = CRNRSTN_CSS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'min' . DIRECTORY_SEPARATOR . 'reset.css';
                            $tmp_file_name = 'min' . DIRECTORY_SEPARATOR . 'reset.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'reset.css';
                            $tmp_file_name = 'reset.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'min' . DIRECTORY_SEPARATOR . 'text.css';
                            $tmp_file_name = 'min' . DIRECTORY_SEPARATOR . 'text.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'text.css';
                            $tmp_file_name = 'text.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'min' . DIRECTORY_SEPARATOR . '960_rtl.css';
                            $tmp_file_name = 'min' . DIRECTORY_SEPARATOR . '960_rtl.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . '960_grid_system' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . '960_rtl.css';
                            $tmp_file_name = '960_rtl.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_CSS_FRAMEWORK_FOUNDATION:
                            // THIS SHOULD ALWAYS TRACK THE LATEST VERSION THAT IS RELEASED.

                            $tmp_file_type_const = CRNRSTN_CSS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            //
                            // CHECK FOR PREVIOUS LOAD OF JQUERY
                            if(!isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_1_12_4])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_2_2_4])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_3_6_1])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_3_7_0])
                                && !isset($this->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_PLUS_JQUERY])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY])){

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery' . DIRECTORY_SEPARATOR . '3.6.1' . DIRECTORY_SEPARATOR . 'jquery-3.6.1.min.js';
                                $tmp_file_name = 'jquery-3.6.1.min.js';
                                $tmp_meta_type = 'text/javascript';
                                $tmp_file_is_minimized = true;
                                $tmp_asset_minimization_mode_is_active = true;
                                $tmp_resource_dependency_constant = $const;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery' . DIRECTORY_SEPARATOR . '3.6.1' . DIRECTORY_SEPARATOR . 'jquery-3.6.1.js';
                                $tmp_file_name = 'jquery-3.6.1.js';
                                $tmp_meta_type = 'text/javascript';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = true;
                                $tmp_resource_dependency_constant = $const;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                                $tmp_str .= $this->return_mapped_resources(CRNRSTN_JS_FRAMEWORK_JQUERY, $footer_html_output);
                                /*//////////
                                //////////

                                */

                            }

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'foundation' . DIRECTORY_SEPARATOR . '6' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'what-input.js';
                            $tmp_file_name = '6' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'what-input.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'foundation' . DIRECTORY_SEPARATOR . '6' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'foundation.min.js';
                            $tmp_file_name = '6' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'foundation.min.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'foundation' . DIRECTORY_SEPARATOR . '6' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'foundation.js';
                            $tmp_file_name = '6' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'foundation.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_CSS_FRAMEWORK_FOUNDATION_6:

                            $tmp_file_type_const = CRNRSTN_CSS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            //
                            // CHECK FOR PREVIOUS LOAD OF JQUERY
                            if(!isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_1_12_4])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_2_2_4])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_3_6_1])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_3_7_0])
                                && !isset($this->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_PLUS_JQUERY])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY])){

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery' . DIRECTORY_SEPARATOR . '3.6.1' . DIRECTORY_SEPARATOR . 'jquery-3.6.1.min.js';
                                $tmp_file_name = 'jquery-3.6.1.min.js';
                                $tmp_meta_type = 'text/javascript';
                                $tmp_file_is_minimized = true;
                                $tmp_asset_minimization_mode_is_active = true;
                                $tmp_resource_dependency_constant = $const;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'jquery' . DIRECTORY_SEPARATOR . '3.6.1' . DIRECTORY_SEPARATOR . 'jquery-3.6.1.js';
                                $tmp_file_name = 'jquery-3.6.1.js';
                                $tmp_meta_type = 'text/javascript';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = true;
                                $tmp_resource_dependency_constant = $const;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                                $tmp_str .= $this->return_mapped_resources(CRNRSTN_JS_FRAMEWORK_JQUERY, $footer_html_output);
                                /*//////////
                                //////////

                                */

                            }

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'foundation' . DIRECTORY_SEPARATOR . '6' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'what-input.js';
                            $tmp_file_name = '6' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'what-input.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'foundation' . DIRECTORY_SEPARATOR . '6' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'foundation.min.js';
                            $tmp_file_name = '6' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'foundation.min.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'foundation' . DIRECTORY_SEPARATOR . '6' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'foundation.js';
                            $tmp_file_name = '6' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'foundation.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_CSS_FRAMEWORK_HTML5_BOILERPLATE:
                            // THIS SHOULD ALWAYS TRACK THE LATEST VERSION THAT IS RELEASED.

                            $tmp_file_type_const = CRNRSTN_CSS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            /*
                            <link rel="stylesheet" href="css/normalize.css">
                            <link rel="stylesheet" href="css/main.css">

                            <!-- Add your site or application content here -->
                            <p>Hello world! This is HTML5 Boilerplate.</p>
                            <script src="js/vendor/modernizr-3.11.2.min.js"></script>
                            <script src="js/plugins.js"></script>
                            <script src="js/main.js"></script>

                            */

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'html5_boilerplate' . DIRECTORY_SEPARATOR . '8.0.0' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'normalize.css';
                            $tmp_file_name = 'normalize.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'html5_boilerplate' . DIRECTORY_SEPARATOR . '8.0.0' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'main.css';
                            $tmp_file_name = 'main.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'html5_boilerplate' . DIRECTORY_SEPARATOR . '8.0.0' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'modernizr-3.11.2.min.js';
                            $tmp_file_name = 'modernizr-3.11.2.min.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = true;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'html5_boilerplate' . DIRECTORY_SEPARATOR . '8.0.0' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'plugins.js';
                            $tmp_file_name = 'plugins.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = true;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'html5_boilerplate' . DIRECTORY_SEPARATOR . '8.0.0' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'main.js';
                            $tmp_file_name = 'main.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = true;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_CSS_FRAMEWORK_HTML5_BOILERPLATE_8_0_0:

                            $tmp_file_type_const = CRNRSTN_CSS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            /*
                            <link rel="stylesheet" href="css/normalize.css">
                            <link rel="stylesheet" href="css/main.css">

                            <!-- Add your site or application content here -->
                            <p>Hello world! This is HTML5 Boilerplate.</p>
                            <script src="js/vendor/modernizr-3.11.2.min.js"></script>
                            <script src="js/plugins.js"></script>
                            <script src="js/main.js"></script>

                            */

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'html5_boilerplate' . DIRECTORY_SEPARATOR . '8.0.0' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'normalize.css';
                            $tmp_file_name = 'normalize.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'html5_boilerplate' . DIRECTORY_SEPARATOR . '8.0.0' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'main.css';
                            $tmp_file_name = 'main.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'html5_boilerplate' . DIRECTORY_SEPARATOR . '8.0.0' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'modernizr-3.11.2.min.js';
                            $tmp_file_name = 'modernizr-3.11.2.min.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = true;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'html5_boilerplate' . DIRECTORY_SEPARATOR . '8.0.0' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'plugins.js';
                            $tmp_file_name = 'plugins.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = true;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'html5_boilerplate' . DIRECTORY_SEPARATOR . '8.0.0' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'main.js';
                            $tmp_file_name = 'main.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = true;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_CSS_FRAMEWORK_RESPONSIVE_GRID_SYSTEM:

                            $tmp_file_type_const = CRNRSTN_CSS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            /*
                            <!-- Responsive and mobile friendly stuff -->
                            <meta name="HandheldFriendly" content="True">
                            <meta name="MobileOptimized" content="320">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">

                            <!-- Stylesheets -->
                            <link rel="stylesheet" href="css/html5reset.css" media="all">
                            <link rel="stylesheet" href="css/col.css" media="all">
                            <link rel="stylesheet" href="css/2cols.css" media="all">
                            <link rel="stylesheet" href="css/3cols.css" media="all">
                            <link rel="stylesheet" href="css/4cols.css" media="all">
                            <link rel="stylesheet" href="css/5cols.css" media="all">
                            <link rel="stylesheet" href="css/6cols.css" media="all">
                            <link rel="stylesheet" href="css/7cols.css" media="all">
                            <link rel="stylesheet" href="css/8cols.css" media="all">
                            <link rel="stylesheet" href="css/9cols.css" media="all">
                            <link rel="stylesheet" href="css/10cols.css" media="all">
                            <link rel="stylesheet" href="css/11cols.css" media="all">
                            <link rel="stylesheet" href="css/12cols.css" media="all">

                            */

                            $tmp_str .= '<!-- Responsive and mobile friendly stuff -->
                            <meta name="HandheldFriendly" content="True">
                            <meta name="MobileOptimized" content="320">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
';

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'responsive_grid_system' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'html5reset.css';
                            $tmp_file_name = 'html5reset.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'responsive_grid_system' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'col.css';
                            $tmp_file_name = 'col.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'responsive_grid_system' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . '2cols.css';
                            $tmp_file_name = '2cols.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'responsive_grid_system' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . '3cols.css';
                            $tmp_file_name = '3cols.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'responsive_grid_system' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . '4cols.css';
                            $tmp_file_name = '4cols.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'responsive_grid_system' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . '5cols.css';
                            $tmp_file_name = '5cols.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'responsive_grid_system' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . '6cols.css';
                            $tmp_file_name = '6cols.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'responsive_grid_system' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . '7cols.css';
                            $tmp_file_name = '7cols.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'responsive_grid_system' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . '8cols.css';
                            $tmp_file_name = '8cols.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'responsive_grid_system' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . '9cols.css';
                            $tmp_file_name = '9cols.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'responsive_grid_system' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . '10cols.css';
                            $tmp_file_name = '10cols.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'responsive_grid_system' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . '11cols.css';
                            $tmp_file_name = '11cols.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'responsive_grid_system' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . '12cols.css';
                            $tmp_file_name = '12cols.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC:

                            $tmp_file_type_const = CRNRSTN_CSS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            /*
                            MORE CAN BE SUPPORTED HERE...ESPECIALLY CONSIDERING THE MOBILE SPECIFIC RESOURCES
                            ASSOCIATED WITH UNSEMANTIC. THESE SIX (6) ARE A GESTURE BASED OFF OF READILY AVAILABLE
                            DEMONSTRATIVE MATERIAL.

                            case CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC:
                            <head>
                                <meta charset="utf-8" />
                                <meta http-equiv="x-ua-compatible" content="ie=edge" />
                                <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
                                <title>Unsemantic CSS Framework</title>
                                <!--[if lt IE 9]>
                                  <script src="./assets/javascripts/html5.js"></script>
                                <![endif]-->
                                <link rel="stylesheet" href="./assets/stylesheets/demo.css" />
                                <!--[if (gt IE 8) | (IEMobile)]><!-->
                                  <link rel="stylesheet" href="./assets/stylesheets/unsemantic-grid-responsive.css" />
                                <!--<![endif]-->
                                <!--[if (lt IE 9) & (!IEMobile)]>
                                  <link rel="stylesheet" href="./assets/stylesheets/ie.css" />
                                <![endif]-->
                            </head>

                            */

                            $tmp_str .= '<meta http-equiv="x-ua-compatible" content="ie=edge" />
                                <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
                                <!--[if lt IE 9]>';

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'unsemantic' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'javascripts' . DIRECTORY_SEPARATOR . 'html5.js';
                            $tmp_file_name = 'html5.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                            $tmp_str .= '<![endif]-->
                                <!--[if (gt IE 8) | (IEMobile)]><!-->';

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'unsemantic' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'stylesheets' . DIRECTORY_SEPARATOR . 'unsemantic-grid-responsive.css';
                            $tmp_file_name = 'unsemantic-grid-responsive.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                            $tmp_str .= '<!--<![endif]-->
                                <!--[if (lt IE 9) & (!IEMobile)]>';
                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'unsemantic' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'stylesheets' . DIRECTORY_SEPARATOR . 'ie.css';
                            $tmp_file_name = 'unsemantic-grid-responsive.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                            $tmp_str .= '<![endif]-->';

                        break;
                        case CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_RTL:

                            $tmp_file_type_const = CRNRSTN_CSS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            /*
                            case CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_RTL:
                            RTL
                            <head>
                                <meta charset="utf-8" />
                                <meta http-equiv="x-ua-compatible" content="ie=edge" />
                                <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
                                <title>Unsemantic CSS Framework</title>
                                <!--[if lt IE 9]>
                                  <script src="./assets/javascripts/html5.js"></script>
                                <![endif]-->
                                <link rel="stylesheet" href="./assets/stylesheets/demo.css" />
                                <!--[if (gt IE 8) | (IEMobile)]><!-->
                                  <link rel="stylesheet" href="./assets/stylesheets/unsemantic-grid-responsive-rtl.css" />
                                <!--<![endif]-->
                                <!--[if (lt IE 9) & (!IEMobile)]>
                                  <link rel="stylesheet" href="./assets/stylesheets/ie-rtl.css" />
                                <![endif]-->
                            </head>

                            */

                            $tmp_str .= '<meta http-equiv="x-ua-compatible" content="ie=edge" />
                                <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
                                <!--[if lt IE 9]>';

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'unsemantic' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'javascripts' . DIRECTORY_SEPARATOR . 'html5.js';
                            $tmp_file_name = 'html5.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                            $tmp_str .= '<![endif]-->
                                <!--[if (gt IE 8) | (IEMobile)]><!-->';

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'unsemantic' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'stylesheets' . DIRECTORY_SEPARATOR . 'unsemantic-grid-responsive-rtl.css';
                            $tmp_file_name = 'unsemantic-grid-responsive-rtl.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                            $tmp_str .= '<!--<![endif]-->
                                <!--[if (lt IE 9) & (!IEMobile)]>';

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'unsemantic' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'stylesheets' . DIRECTORY_SEPARATOR . 'ie-rtl.css';
                            $tmp_file_name = 'ie-rtl.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                            $tmp_str .= '<![endif]-->';

                        break;
                        case CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_RESET:

                            $tmp_file_type_const = CRNRSTN_CSS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'unsemantic' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'stylesheets' . DIRECTORY_SEPARATOR . 'reset.css';
                            $tmp_file_name = 'frameworks' . DIRECTORY_SEPARATOR . 'unsemantic' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'stylesheets' . DIRECTORY_SEPARATOR . 'reset.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_RESET_RTL:

                            $tmp_file_type_const = CRNRSTN_CSS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'unsemantic' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'stylesheets' . DIRECTORY_SEPARATOR . 'reset-rtl.css';
                            $tmp_file_name = 'reset-rtl.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_ADAPT:

                            $tmp_file_type_const = CRNRSTN_CSS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            /*
                            case CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_ADAPT:
                            ADAPT
                            <head>
                                <meta charset="utf-8" />
                                <meta http-equiv="x-ua-compatible" content="ie=edge" />
                                <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
                                <title>Unsemantic CSS Framework</title>
                                <!--[if lt IE 9]>
                                  <script src="./assets/javascripts/html5.js"></script>
                                <![endif]-->
                                <link rel="stylesheet" href="./assets/stylesheets/demo.css" />
                                <link rel="stylesheet" href="./assets/stylesheets/unsemantic-grid-base.css" />
                                <noscript>
                                  <link rel="stylesheet" href="./assets/stylesheets/unsemantic-grid-mobile.css" />
                                </noscript>
                                <script>
                                  var ADAPT_CONFIG = {
                                    path: './assets/stylesheets/',
                                    dynamic: true,
                                    range: [
                                      '0 to 767px = unsemantic-grid-mobile.css',
                                      '767px = unsemantic-grid-desktop.css'
                                    ]
                                  };
                                </script>
                                <script src="./assets/javascripts/adapt.min.js"></script>
                            </head>

                                <script src="./assets/javascripts/adapt.min.js"></script>

                            */

                            $tmp_str .= '<meta http-equiv="x-ua-compatible" content="ie=edge" />
                                <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
                                <!--[if lt IE 9]>
';

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'unsemantic' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'javascripts' . DIRECTORY_SEPARATOR . 'html5.js';
                            $tmp_file_name = 'html5.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                            $tmp_str .= '<![endif]-->';

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'unsemantic' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'stylesheets' . DIRECTORY_SEPARATOR . 'unsemantic-grid-base.css';
                            $tmp_file_name = 'unsemantic-grid-base.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                            $tmp_str .= '<noscript>';

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'unsemantic' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'stylesheets' . DIRECTORY_SEPARATOR . 'unsemantic-grid-mobile.css';
                            $tmp_file_name = 'unsemantic-grid-mobile.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                            $tmp_http_path = $this->oCRNRSTN->crnrstn_http_endpoint();

                            $tmp_str .= '</noscript>
                                <script>
                                  var ADAPT_CONFIG = {
                                    path: \'' . $tmp_http_path . '?' . $this->oCRNRSTN->session_salt() . '=\',
                                    dynamic: true,
                                    range: [
                                      \'0 to 767px = unsemantic-grid-mobile.css\',
                                      \'767px = unsemantic-grid-desktop.css\'
                                    ]
                                  };
                                </script>';

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'unsemantic' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'javascripts' . DIRECTORY_SEPARATOR . 'adapt.min.js';
                            $tmp_file_name = 'adapt.min.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_ADAPT_RTL:

                            $tmp_file_type_const = CRNRSTN_CSS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            /*
                            case CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_ADAPT_RTL:
                            ADAPT RTL
                            <head>
                                <meta charset="utf-8" />
                                <meta http-equiv="x-ua-compatible" content="ie=edge" />
                                <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
                                <title>Unsemantic CSS Framework</title>
                                <!--[if lt IE 9]>
                                  <script src="./assets/javascripts/html5.js"></script>
                                <![endif]-->
                                <link rel="stylesheet" href="./assets/stylesheets/demo.css" />
                                <link rel="stylesheet" href="./assets/stylesheets/unsemantic-grid-base-rtl.css" />
                                <noscript>
                                  <link rel="stylesheet" href="./assets/stylesheets/unsemantic-grid-mobile-rtl.css" />
                                </noscript>
                                <script>
                                  var ADAPT_CONFIG = {
                                    path: './assets/stylesheets/',
                                    dynamic: true,
                                    range: [
                                      '0 to 767px = unsemantic-grid-mobile-rtl.css',
                                      '767px = unsemantic-grid-desktop-rtl.css'
                                    ]
                                  };
                                </script>
                                <script src="./assets/javascripts/adapt.min.js"></script>
                            </head>

                            */

                            $tmp_str .= '<meta http-equiv="x-ua-compatible" content="ie=edge" />
                                <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
                                <!--[if lt IE 9]>
';

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'unsemantic' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'javascripts' . DIRECTORY_SEPARATOR . 'html5.js';
                            $tmp_file_name = 'html5.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                            $tmp_str .= '<![endif]-->';

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'unsemantic' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'stylesheets' . DIRECTORY_SEPARATOR . 'unsemantic-grid-base-rtl.css';
                            $tmp_file_name = 'unsemantic-grid-base-rtl.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                            $tmp_str .= '<noscript>';

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'unsemantic' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'stylesheets' . DIRECTORY_SEPARATOR . 'unsemantic-grid-mobile-rtl.css';
                            $tmp_file_name = 'unsemantic-grid-mobile-rtl.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                            $tmp_http_path = $this->oCRNRSTN->crnrstn_http_endpoint();

                            $tmp_str .= '</noscript>
                                <script>
                                  var ADAPT_CONFIG = {
                                    path: \'' . $tmp_http_path . '?' . $this->oCRNRSTN->session_salt() . '=\',
                                    dynamic: true,
                                    range: [
                                      \'0 to 767px = unsemantic-grid-mobile-rtl.css\',
                                      \'767px = unsemantic-grid-desktop-rtl.css\'
                                    ]
                                  };
                                </script>';

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'unsemantic' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'javascripts' . DIRECTORY_SEPARATOR . 'adapt.min.js';
                            $tmp_file_name = 'adapt.min.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_CSS_FRAMEWORK_DEAD_SIMPLE_GRID:

                            $tmp_file_type_const = CRNRSTN_CSS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            $tmp_str .= '<meta name="viewport" content="width=device-width">
                                <!-- a grid framework in 250 bytes? are you kidding me?! -->
';

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'dead_simple_grid' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'grid.css';
                            $tmp_file_name = 'grid.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                            $tmp_str .= '<!-- all the important responsive layout stuff -->
                                <style>
                                    .container { max-width: 90em; }

                                    /* you only need width to set up columns; all columns are 100%-width by default, so we start
                                       from a one-column mobile layout and gradually improve it according to available screen space */

                                    @media only screen and (min-width: 34em) {
                                            .feature, .info { width: 50%; }
                                    }

                                    @media only screen and (min-width: 54em) {
                                                    .content { width: 66.66%; }
                                        .sidebar { width: 33.33%; }
                                        .info    { width: 100%; }
                                    }

                                    @media only screen and (min-width: 76em) {
                                                    .content { width: 58.33%; } /* 7/12 */
                                        .sidebar { width: 41.66%; } /* 5/12 */
                                        .info    { width: 50%;    }
                                    }
                                </style>

                                <!-- general boring stuff and some visual tweaks -->
';

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'dead_simple_grid' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'screen.css';
                            $tmp_file_name = 'screen.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_CSS_FRAMEWORK_SKELETON:

                            $tmp_file_type_const = CRNRSTN_CSS;

                            $tmp_str .= '<!-- Mobile Specific Metas
                              –––––––––––––––––––––––––––––––––––––––––––––––––– -->
                              <meta name="viewport" content="width=device-width, initial-scale=1">

                              <!-- FONT
                              –––––––––––––––––––––––––––––––––––––––––––––––––– -->
                              <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

                              <!-- CSS
                              –––––––––––––––––––––––––––––––––––––––––––––––––– -->
';

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'skeleton' . DIRECTORY_SEPARATOR . '2.0.4' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'normalize.css';
                            $tmp_file_name = '2.0.4' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'normalize.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'skeleton' . DIRECTORY_SEPARATOR . '2.0.4' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'skeleton.css';
                            $tmp_file_name = 'skeleton.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_CSS_FRAMEWORK_RWDGRID:
                            // THIS SHOULD ALWAYS TRACK THE LATEST VERSION THAT IS RELEASED.

                            $tmp_file_type_const = CRNRSTN_CSS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            $tmp_str .= '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
                                <meta name="viewport" content="width=device-width">
';

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'rwdgrid' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'rwdgrid.min.css';
                            $tmp_file_name = 'rwdgrid.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'rwdgrid' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'rwdgrid.css';
                            $tmp_file_name = 'rwdgrid.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'rwdgrid' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'style.css';
                            $tmp_file_name = 'style.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                            $tmp_str .= '<!--[if lt IE 9]>
                                <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
                                <script src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
                                <![endif]-->
';

                        break;
                        case CRNRSTN_CSS_FRAMEWORK_RWDGRID_2_0:

                            $tmp_file_type_const = CRNRSTN_CSS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            $tmp_str .= '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
                                <meta name="viewport" content="width=device-width">
';

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'rwdgrid' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'rwdgrid.min.css';
                            $tmp_file_name = 'rwdgrid.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'rwdgrid' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'rwdgrid.css';
                            $tmp_file_name = 'rwdgrid.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'rwdgrid' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'style.css';
                            $tmp_file_name = 'style.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                            $tmp_str .= '<!--[if lt IE 9]>
                                <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
                                <script src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
                                <![endif]-->
';

                        break;
                        case CRNRSTN_CSS_FRAMEWORK_THIS_IS_DALLAS_SIMPLE_GRID:

                            $tmp_file_type_const = CRNRSTN_CSS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'frameworks' . DIRECTORY_SEPARATOR . 'this_is_dallas_simple_grid' . DIRECTORY_SEPARATOR . 'simplegrid.css';
                            $tmp_file_name = 'simplegrid.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_CSS_MAIN_DESKTOP:

                            $tmp_file_type_const = CRNRSTN_CSS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . 'crnrstn.main_desktop.css';
                            $tmp_file_name = 'crnrstn.main_desktop.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_CSS_MAIN_TABLET:

                            $tmp_file_type_const = CRNRSTN_CSS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . 'crnrstn.main_tablet.css';
                            $tmp_file_name = 'crnrstn.main_tablet.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                        break;
                        case CRNRSTN_CSS_MAIN_MOBILE:

                            $tmp_file_type_const = CRNRSTN_CSS;
                            if($asset_mode_ARRAY[0] == CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = DIRECTORY_SEPARATOR . 'crnrstn.main_mobi.css';
                            $tmp_file_name = 'crnrstn.main_mobi.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources(CRNRSTN_JS_FRAMEWORK_JQUERY, $footer_html_output);
                            /*//////////
                            //////////

                            */

                    break;

                    }

                    if(strlen($tmp_str) > 0){

                        $tmp_str_array[] = $tmp_start_str;

                        $tmp_str_array[] = $tmp_str;

                        if($tmp_show_comments == true){

                            $tmp_str_array[] = '    ' . $this->oCRNRSTN->html_version_burn('JS + CSS MODULE', 'END') . '
';

                        }

                    }

                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Received unknown asset mode [' . print_r($asset_mode_ARRAY, true) . '] from the system.');

                break;

            }

            if(isset($tmp_min_js_css_bool_cache)){

                if($tmp_min_js_css_bool_cache){

                    //
                    // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                    // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                    // # # C # R # N # R # S # T # N # : : # # # #
                    // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                    $this->oCRNRSTN->initialize_bit(CRNRSTN_JS_CSS_PROD_MIN, false);

                }else{

                    //
                    // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                    // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                    // # # C # R # N # R # S # T # N # : : # # # #
                    // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                    $this->oCRNRSTN->initialize_bit(CRNRSTN_JS_CSS_PROD_MIN, true);

                }

            }

            return $tmp_str_array;

        }catch (Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return $tmp_str_array;

        }

    }

    public function client_asset_response(){

        /*
        $tmp_data_ARRAY['crnrstn_asset_method_key'] = $this->crnrstn_asset_meta_key;
        $tmp_data_ARRAY['crnrstn_asset_family'] = $this->crnrstn_asset_family;   // currently only css, js, system, social, or favicon
        $tmp_data_ARRAY['crnrstn_asset_key'] = $_GET[$tmp_session_salt];         // asset name/key
        $tmp_data_ARRAY['crnrstn_asset_meta_path'] = $this->crnrstn_asset_meta_path;
        $tmp_data_ARRAY['output_format'] = 'asset';

        'CRNRSTN_ASSET_MODE_BASE64'
        'CRNRSTN_ASSET_MODE_PNG'
        'CRNRSTN_ASSET_MODE_JPEG'

        [Sun Oct 30 16:41:09.225859 2022] [:error] [pid 7684] [client 172.16.225.1:62644] 487 http mgr
        [Array\n(\n
            [crnrstn_asset_method_key] => SOCIAL_ARCHIVES_HQ
            [crnrstn_asset_family] => social
            [crnrstn_asset_key] => social_archives_hq
            [output_format] => asset
        )].

//        flush();
//        ob_flush();
//        exit();

        [Sat Jan 14 01:56:52.769037 2023] [:error] [pid 30526] [client 172.16.225.1:50286] 4769 asset mgr
        [crnrstn_system_asset_manager::client_asset_response] [
        Array\n(\n
            [crnrstn_asset_method_key] => add_cookie\n
            [crnrstn_asset_family] => meta_preview_image\n
            [crnrstn_asset_key] => meta/php/add_cookie\n
            [output_format] => asset\n)\n].


        [Wed Apr 19 18:52:36.289524 2023] [:error] [pid 12548] [client 172.16.225.1:49193] 836 config FIRST CONFIG LISTENER COMPLETE.
        cache_ARRAY[Array\n(\n    [C7Oy18oxslQaRGMzGXIxoqAEfB13lzDC2oo9aQruOEh3Bjq8ikLYJ7FXSG0u8lKx] => Array\n        (\n
        [cache_id] => Array\n                (\n                    [sprite_hq] => 0\n                )\n\n
        [ipaddress_id] => Array\n                (\n                    [172.16.225.1] => 0\n                )\n\n
        [resource_bytes] => Array\n                (\n                    [0] => 505\n                )\n\n
        [filename] => Array\n                (\n                    [0] => sprite_hq\n                )\n\n
        [request_family] => Array\n                (\n                    [0] => social\n                )\n\n
        [asset_meta_key] => Array\n                (\n                    [0] => SOCIAL_SPRITE_HQ\n                )\n\n
        [datecreated] => Array\n                (\n                    [0] => 1681944756\n                )\n\n
        [createdby_client_ip] => Array\n                (\n                    [0] => 172.16.225.1\n                )\n\n
        [lastmodified] => Array\n                (\n                    [0] => 1681944756\n                )\n\n
        [modifiedby_client_ip] => Array\n                (\n                    [0] => 172.16.225.1\n                )\n\n
        [raw_output_mode] => Array\n                (\n                    [0] => 7217\n                )\n\n        )\n\n)\n].


        return_crnrstn_asset_family();<<<---  $this->oCRNRSTN->oCRNRSTN_RRS_MAP->get_cache('request_family');
        $tmp_response_map_request_ugc_value = $this->oCRNRSTN->return_response_map_ugc_value();<<<---  $this->oCRNRSTN->oCRNRSTN_RRS_MAP->get_salt_ugc();
        $tmp_response_map_asset_meta_key = $this->oCRNRSTN->return_response_map_asset_meta_key();<<<---  $this->oCRNRSTN->oCRNRSTN_RRS_MAP->get_cache('asset_meta_key');
        $tmp_response_map_asset_meta_path = $this->oCRNRSTN->return_response_map_asset_meta_path();<<<---  $this->oCRNRSTN->oCRNRSTN_RRS_MAP->get_cache('meta_path');


        */

        $tmp_response_map_request_family = $this->oCRNRSTN->oCRNRSTN_RRS_MAP->get_cache('request_family');
        $tmp_response_map_request_ugc_value = $this->oCRNRSTN->oCRNRSTN_RRS_MAP->get_salt_ugc();
        $tmp_response_map_asset_meta_key = $this->oCRNRSTN->oCRNRSTN_RRS_MAP->get_cache('asset_meta_key');
        $tmp_response_map_asset_meta_path = $this->oCRNRSTN->oCRNRSTN_RRS_MAP->get_cache('meta_path');  // FOR CSS, JS, INTEGRATIONS...AND NOT FOR IMAGES[SYSTEM, SOCIAL].

        error_log(__LINE__ . ' asset mgr  $tmp_response_map_asset_meta_key[' . $tmp_response_map_asset_meta_key . ']. asset_request_data_key=[' . $tmp_response_map_request_ugc_value . ']. asset_request_asset_family=[' . $tmp_response_map_request_family . '].');

        switch($tmp_response_map_request_family){
            case 'favicon':

                //
                // SUPPORTED USE-CASES ::
                // SESSION SALT MAPPED $_GET RETURN OF RAW CRNRSTN :: MAPPED FAVICON .ICO.
                $tmp_file_extension = 'ico';
                $tmp_filepath = $this->oCRNRSTN->get_resource('crnrstn_favicon_asset_map_dir_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');

                error_log(__LINE__ . ' asset mgr $tmp_response_map_asset_meta_key[' . $tmp_response_map_asset_meta_key . ']. asset_request_data_key=[' . $tmp_response_map_request_ugc_value . ']. asset_request_asset_family=[' . $tmp_response_map_request_family . '].');

                //$tmp_ARRAY = explode('/', $tmp_response_map_request_ugc_value);
                $tmp_ARRAY = explode('/', $this->oCRNRSTN->oCRNRSTN_RRS_MAP->get_salt_ugc());

                //
                // ADJUST VALUES BY DERIVING FAMILY AND KEY OVERRIDES FROM ORIGINAL DATA KEY VALUE.
                $tmp_response_map_request_family = $tmp_ARRAY[0];
                $tmp_filename = $tmp_ARRAY[1];

                $tmp_filepath .= DIRECTORY_SEPARATOR . 'system' . DIRECTORY_SEPARATOR . $tmp_response_map_request_family . DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                //error_log(__LINE__ . ' img asset mgr $tmp_filename[' . $tmp_filename . ']. $tmp_filepath=[' . $tmp_filepath . '].');

                $this->return_file_byte_chunked_buffer_output($tmp_filepath, $tmp_filename, $tmp_file_extension,CRNRSTN_FAVICON_ASSET_MAPPING);

//                $tmp_filename_clean = $this->process_for_filename($tmp_response_map_request_ugc_value);
//
//                $tmp_curr_headers_ARRAY = headers_list();
//                $tmp_crnrstn_signature_headers_ARRAY = $this->oCRNRSTN->header_signature_options_return();
//
//                //
//                // SOURCE :: https://stackoverflow.com/questions/9728269/content-length-and-other-http-headers
//                // COMMENT :: https://stackoverflow.com/a/9728576
//                // AUTHOR :: Neysor :: https://stackoverflow.com/users/1219121/neysor
//                $tmp_filesize = filesize($tmp_filepath);
//                $tmp_header_options_ARRAY[] = 'Content-Type: ' . mime_content_type($tmp_filepath);
//                $tmp_header_options_ARRAY[] = 'Content-length: ' . $tmp_filesize;
//                header('Content-Disposition: inline; filename="' . $tmp_filename_clean . '"');
//
//                // header_options_add
//                // header_options_apply
//                // header_signature_options_return
//                // ENSURE ALL SIGNATURE HEADERS ARE IN PLACE AND CONTINUE
//                $this->oCRNRSTN->header_options_add($tmp_curr_headers_ARRAY);
//                $this->oCRNRSTN->header_options_add($tmp_crnrstn_signature_headers_ARRAY);
//                $this->oCRNRSTN->header_options_add($tmp_header_options_ARRAY);
//
//                $this->oCRNRSTN->header_options_apply();
//
//                $this->readfile_chunked($tmp_filepath);
//
//                //ob_flush();
//                if(ob_get_level() > 0){ob_flush();}
//                flush();
//                exit();

            break;
            case 'meta_preview_image':
            case 'system':
            case 'social':

                return $this->return_system_image($tmp_response_map_asset_meta_key, NULL, NULL, NULL, NULL, NULL, NULL, CRNRSTN_IMG);

            break;
            case 'integrations':
            case 'css':
            case 'js':

                //error_log(__LINE__ . ' asset mgr $tmp_response_map_asset_meta_path[' . $tmp_response_map_asset_meta_path . ']. $tmp_response_map_asset_meta_key[' . $tmp_response_map_asset_meta_key . ']. $tmp_response_map_request_ugc_value=[' . $tmp_response_map_request_ugc_value . ']. $tmp_response_map_request_family=[' . $tmp_response_map_request_family . '].');

                return $this->return_asset_data($tmp_response_map_request_ugc_value, $tmp_response_map_request_family, $tmp_response_map_asset_meta_key, $tmp_response_map_asset_meta_path);

            break;

        }

        //error_log(__LINE__ . ' asset mgr ***SYS ARCH ERROR??*** NO RETURN ON SYSTEM ASSET RESPONSE CALL; WHY THE CALL? $tmp_response_map_asset_meta_key[' . $tmp_response_map_asset_meta_key . ']. asset_request_data_key=[' . $tmp_response_map_request_ugc_value . ']. asset_request_asset_family=[' . $tmp_response_map_request_family . '].');
        return '';

    }

    //
    // TIDY TIDY ON Monday May 1, 2023 1739 hrs
    private function asset_data_meta_integrations($asset_data_key, $asset_family = NULL, $width_override = NULL, $height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $path = NULL, $output_mode = CRNRSTN_FILE_MANAGEMENT){

        $tmp_ARRAY = array();
        $tmp_ARRAY['output_mode_method_src'] = $output_mode;
        $tmp_filename = $tmp_width = $tmp_height = $tmp_alt = $tmp_title = $tmp_link = $tmp_target = $tmp_asset_family = $tmp_raw_output_mode = '';

        switch($asset_data_key){

            //
            // START INTEGRATIONS RESOURCES META.
            // *************
            case 'JQUERY_MOBILE_1_4_5_AJAX_LOADER':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/ajax-loader';
                $tmp_filename_ = 'ajax-loader';
                $tmp_file_extension = 'gif';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 46;
                $tmp_height = 46;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ACTION_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/action-black';
                $tmp_filename_ = 'action-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ACTION_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/action-white';
                $tmp_filename_ = 'action-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ALERT_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/alert-black';
                $tmp_filename_ = 'alert-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ALERT_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/alert-white';
                $tmp_filename_ = 'alert-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ARROW_D_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-d-black';
                $tmp_filename_ = 'arrow-d-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ARROW_D_L_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-d-l-black';
                $tmp_filename_ = 'arrow-d-l-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ARROW_D_L_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-d-l-white';
                $tmp_filename_ = 'arrow-d-l-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ARROW_D_R_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-d-r-black';
                $tmp_filename_ = 'arrow-d-r-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ARROW_D_R_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-d-r-white';
                $tmp_filename_ = 'arrow-d-r-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ARROW_D_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-d-white';
                $tmp_filename_ = 'arrow-d-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ARROW_L_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-l-black';
                $tmp_filename_ = 'arrow-l-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ARROW_L_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-l-white';
                $tmp_filename_ = 'arrow-l-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ARROW_R_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-r-black';
                $tmp_filename_ = 'arrow-r-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ARROW_R_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-r-white';
                $tmp_filename_ = 'arrow-r-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ARROW_U_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-u-black';
                $tmp_filename_ = 'arrow-u-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ARROW_U_L_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-u-l-black';
                $tmp_filename_ = 'arrow-u-l-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ARROW_U_L_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-u-l-white';
                $tmp_filename_ = 'arrow-u-l-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ARROW_U_R_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-u-r-black';
                $tmp_filename_ = 'arrow-u-r-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ARROW_U_R_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-u-r-white';
                $tmp_filename_ = 'arrow-u-r-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ARROW_U_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-u-white';
                $tmp_filename_ = 'arrow-u-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_AUDIO_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/audio-black';
                $tmp_filename_ = 'audio-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_AUDIO_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/audio-white';
                $tmp_filename_ = 'audio-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_BACK_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/back-black';
                $tmp_filename_ = 'back-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_BACK_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/back-white';
                $tmp_filename_ = 'back-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_BARS_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/bars-black';
                $tmp_filename_ = 'bars-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_BARS_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/bars-white';
                $tmp_filename_ = 'bars-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_BULLETS_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/bullets-black';
                $tmp_filename_ = 'bullets-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_BULLETS_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/bullets-white';
                $tmp_filename_ = 'bullets-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_CALENDAR_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/calendar-black';
                $tmp_filename_ = 'calendar-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_CALENDAR_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/calendar-white';
                $tmp_filename_ = 'calendar-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_CAMERA_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/camera-black';
                $tmp_filename_ = 'camera-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_CAMERA_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/camera-white';
                $tmp_filename_ = 'camera-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_CARAT_D_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/carat-d-black';
                $tmp_filename_ = 'carat-d-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_CARAT_D_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/carat-d-white';
                $tmp_filename_ = 'carat-d-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_CARAT_L_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/carat-l-black';
                $tmp_filename_ = 'carat-l-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_CARAT_L_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/carat-l-white';
                $tmp_filename_ = 'carat-l-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_CARAT_R_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/carat-r-black';
                $tmp_filename_ = 'carat-r-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_CARAT_R_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/carat-r-white';
                $tmp_filename_ = 'carat-r-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_CARAT_U_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/carat-u-black';
                $tmp_filename_ = 'carat-u-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_CARAT_U_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/carat-u-white';
                $tmp_filename_ = 'carat-u-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_CHECK_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/check-black';
                $tmp_filename_ = 'check-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_CHECK_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/check-white';
                $tmp_filename_ = 'check-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_CLOCK_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/clock-black';
                $tmp_filename_ = 'clock-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_CLOCK_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/clock-white';
                $tmp_filename_ = 'clock-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_CLOUD_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/cloud-black';
                $tmp_filename_ = 'cloud-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_CLOUD_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/cloud-white';
                $tmp_filename_ = 'cloud-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_COMMENT_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/comment-black';
                $tmp_filename_ = 'comment-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_COMMENT_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/comment-white';
                $tmp_filename_ = 'comment-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_DELETE_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/delete-black';
                $tmp_filename_ = 'delete-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_DELETE_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/delete-white';
                $tmp_filename_ = 'delete-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_EDIT_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/edit-black';
                $tmp_filename_ = 'edit-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_EDIT_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/edit-white';
                $tmp_filename_ = 'edit-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_EYE_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/eye-black';
                $tmp_filename_ = 'eye-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_EYE_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/eye-white';
                $tmp_filename_ = 'eye-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_FORBIDDEN_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/forbidden-black';
                $tmp_filename_ = 'forbidden-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_FORBIDDEN_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/forbidden-white';
                $tmp_filename_ = 'forbidden-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_FORWARD_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/forward-black';
                $tmp_filename_ = 'forward-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_FORWARD_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/forward-white';
                $tmp_filename_ = 'forward-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_GEAR_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/gear-black';
                $tmp_filename_ = 'gear-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_GEAR_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/gear-white';
                $tmp_filename_ = 'gear-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_GRID_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/grid-black';
                $tmp_filename_ = 'grid-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_GRID_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/grid-white';
                $tmp_filename_ = 'grid-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_HEART_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/heart-black';
                $tmp_filename_ = 'heart-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_HEART_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/heart-white';
                $tmp_filename_ = 'heart-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_HOME_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/home-black';
                $tmp_filename_ = 'home-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_HOME_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/home-white';
                $tmp_filename_ = 'home-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_INFO_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/info-black';
                $tmp_filename_ = 'info-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_INFO_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/info-white';
                $tmp_filename_ = 'info-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_LOCATION_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/location-black';
                $tmp_filename_ = 'location-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_LOCATION_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/location-white';
                $tmp_filename_ = 'location-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_LOCK_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/lock-black';
                $tmp_filename_ = 'lock-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_LOCK_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/lock-white';
                $tmp_filename_ = 'lock-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_MAIL_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/mail-black';
                $tmp_filename_ = 'mail-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_MAIL_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/mail-white';
                $tmp_filename_ = 'mail-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_MINUS_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/minus-black';
                $tmp_filename_ = 'minus-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_MINUS_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/minus-white';
                $tmp_filename_ = 'minus-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_NAVIGATION_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/navigation-black';
                $tmp_filename_ = 'navigation-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_NAVIGATION_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/navigation-white';
                $tmp_filename_ = 'navigation-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_PHONE_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/phone-black';
                $tmp_filename_ = 'phone-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_PHONE_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/phone-white';
                $tmp_filename_ = 'phone-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_PLUS_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/plus-black';
                $tmp_filename_ = 'plus-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_PLUS_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/plus-white';
                $tmp_filename_ = 'plus-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_POWER_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/power-black';
                $tmp_filename_ = 'power-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_POWER_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/power-white';
                $tmp_filename_ = 'power-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_RECYCLE_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/recycle-black';
                $tmp_filename_ = 'recycle-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_RECYCLE_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/recycle-white';
                $tmp_filename_ = 'recycle-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_REFRESH_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/refresh-black';
                $tmp_filename_ = 'refresh-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_REFRESH_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/refresh-white';
                $tmp_filename_ = 'refresh-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_SEARCH_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/search-black';
                $tmp_filename_ = 'search-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_SEARCH_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/search-white';
                $tmp_filename_ = 'search-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_SHOP_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/shop-black';
                $tmp_filename_ = 'shop-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_SHOP_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/shop-white';
                $tmp_filename_ = 'shop-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_STAR_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/star-black';
                $tmp_filename_ = 'star-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_STAR_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/star-white';
                $tmp_filename_ = 'star-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_TAG_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/tag-black';
                $tmp_filename_ = 'tag-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_TAG_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/tag-white';
                $tmp_filename_ = 'tag-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_USER_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/user-black';
                $tmp_filename_ = 'user-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_USER_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/user-white';
                $tmp_filename_ = 'user-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_VIDEO_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/video-black';
                $tmp_filename_ = 'video-black';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_VIDEO_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/video-white';
                $tmp_filename_ = 'video-white';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
                $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'LIGHTBOX_2.11.3_CLOSE':

                $tmp_filename = 'framework/lightbox/close';
                $tmp_filename_ = 'close';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/lightbox.js/2.11.3/images';
                $tmp_filepath .= DIRECTORY_SEPARATOR . 'close.png';
                $tmp_width = 27;
                $tmp_height = 27;
                $tmp_alt = 'close';
                $tmp_title = 'close';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'LIGHTBOX_2.11.3_LOADING':

                $tmp_filename = 'framework/lightbox/loading';
                $tmp_filename_ = 'loading';
                $tmp_file_extension = 'gif';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/lightbox.js/2.11.3/images';
                $tmp_filepath .= DIRECTORY_SEPARATOR . 'loading.gif';
                $tmp_width = 32;
                $tmp_height = 32;
                $tmp_alt = 'close';
                $tmp_title = 'close';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'LIGHTBOX_2.11.3_NEXT':

                $tmp_filename = 'framework/lightbox/next';
                $tmp_filename_ = 'next';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/lightbox.js/2.11.3/images';
                $tmp_filepath .= DIRECTORY_SEPARATOR . 'next.png';
                $tmp_width = 50;
                $tmp_height = 45;
                $tmp_alt = 'close';
                $tmp_title = 'close';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'LIGHTBOX_2.11.3_PREV':

                $tmp_filename = 'framework/lightbox/prev';
                $tmp_filename_ = 'prev';
                $tmp_file_extension = 'png';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/lightbox.js/2.11.3/images';
                $tmp_filepath .= DIRECTORY_SEPARATOR . 'prev.png';
                $tmp_width = 50;
                $tmp_height = 45;
                $tmp_alt = 'close';
                $tmp_title = 'close';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'LIGHTBOX_2.03.3_BLANK':

                $tmp_filename = 'framework/lightbox-2.03.3/blank';
                $tmp_filename_ = 'blank';
                $tmp_file_extension = 'gif';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/lightbox.js/2.03.3/css/images';
                $tmp_filepath .= DIRECTORY_SEPARATOR . 'blank.gif';
                $tmp_width = 1;
                $tmp_height = 1;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'LIGHTBOX_2.03.3_CLOSE':

                $tmp_filename = 'framework/lightbox-2.03.3/close';
                $tmp_filename_ = 'closelabel';
                $tmp_file_extension = 'gif';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/lightbox.js/2.03.3/css/images';
                $tmp_filepath .= DIRECTORY_SEPARATOR . 'closelabel.gif';
                $tmp_width = 27;
                $tmp_height = 27;
                $tmp_alt = 'close';
                $tmp_title = 'close';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'LIGHTBOX_2.03.3_LOADING':

                $tmp_filename = 'framework/lightbox-2.03.3/loading';
                $tmp_filename_ = 'loading';
                $tmp_file_extension = 'gif';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/lightbox.js/2.03.3/css/images';
                $tmp_filepath .= DIRECTORY_SEPARATOR . 'loading.gif';
                $tmp_width = 32;
                $tmp_height = 32;
                $tmp_alt = 'loading';
                $tmp_title = 'loading';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'LIGHTBOX_2.03.3_NEXT':

                $tmp_filename = 'framework/lightbox-2.03.3/next';
                $tmp_filename_ = 'nextlabel';
                $tmp_file_extension = 'gif';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/lightbox.js/2.03.3/css/images';
                $tmp_filepath .= DIRECTORY_SEPARATOR . 'nextlabel.gif';
                $tmp_width = 50;
                $tmp_height = 45;
                $tmp_alt = 'next';
                $tmp_title = 'next';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'LIGHTBOX_2.03.3_PREV':

                $tmp_filename = 'framework/lightbox-2.03.3/prev';
                $tmp_filename_ = 'prevlabel';
                $tmp_file_extension = 'gif';
                $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/lightbox.js/2.03.3/css/images';
                $tmp_filepath .= DIRECTORY_SEPARATOR . 'prevlabel.gif';
                $tmp_width = 50;
                $tmp_height = 45;
                $tmp_alt = 'prev';
                $tmp_title = 'prev';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            default:

                //
                // ALLOW ARRAY DATA TYPE RETURN TO BE INDICATION OF SUCCESS.
                return false;

                $tmp_filename = $asset_data_key;
                $tmp_width = '';
                $tmp_height = '';
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;
                //error_log(__LINE__ . ' asset mgr CASE DEFAULT DATA $asset_data_key[' . $asset_data_key . ']. $tmp_asset_family[' . $tmp_asset_family . '].');

            break;

        }

        //
        // AUGMENT DOCUMENTATION WITH ASSET META.
        if($output_mode == CRNRSTN_RESOURCE_DOCUMENTATION){

            $tmp_ARRAY[$asset_data_key]['alt'] = $tmp_alt;
            $tmp_ARRAY[$asset_data_key]['title'] = $tmp_title;

            return $tmp_ARRAY;

        }


        error_log(__LINE__ . ' asset mgr $tmp_filename[' . $tmp_filename . ']. data key[' . $asset_data_key . '].');

        //
        // FRAMEWORK INTEGRATIONS.
        $tmp_ARRAY['asset_data_key'] = $asset_data_key;
        $tmp_ARRAY['asset_family'] = $tmp_asset_family;
        $tmp_ARRAY['filename'] = $tmp_filename;
        $tmp_ARRAY['filename_'] = $tmp_filename_;
        $tmp_ARRAY['file_ext'] = $tmp_file_extension;
        $tmp_ARRAY['filepath'] = $tmp_filepath;
        $tmp_ARRAY['width'] = $tmp_width;
        $tmp_ARRAY['height'] = $tmp_height;
        $tmp_ARRAY['alt'] = $tmp_alt;
        $tmp_ARRAY['title'] = $tmp_title;
        $tmp_ARRAY['hyperlink'] = $tmp_link;
        $tmp_ARRAY['target'] = $tmp_target;
        $tmp_ARRAY['raw_output_mode'] = $tmp_raw_output_mode;

        return $tmp_ARRAY;

    }

    //
    // TIDY TIDY ON Monday May 1, 2023 1833 hrs
    private function asset_data_meta_system($asset_data_key, $asset_family = NULL, $width_override = NULL, $height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $path = NULL, $output_mode = CRNRSTN_FILE_MANAGEMENT){

        $tmp_ARRAY = array();
        $tmp_ARRAY['output_mode_method_src'] = $output_mode;
        $tmp_filename = $tmp_width = $tmp_height = $tmp_alt = $tmp_title = $tmp_link = $tmp_target = $tmp_asset_family = $tmp_raw_output_mode = '';

        switch($asset_data_key){
            //
            // START SYSTEM RESOURCES META.
            // *************
            case 'SYSTEM_SPRITE_HQ':

                $tmp_filename = 'system/sprite_hq';
                $tmp_width = 7800;
                $tmp_height = 7800;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SYSTEM_SPRITE':

                $tmp_filename = 'system/sprite';
                $tmp_width = 2600;
                $tmp_height = 2600;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'TRANSPARENT_1X1':

                $tmp_filename = 'x';
                $tmp_width = 1;
                $tmp_height = 1;
                $tmp_alt = 'x';
                $tmp_title = 'x';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'PRIMARY_NAV_BLUE00_CLOSE_X':

                $tmp_filename = 'primary_nav_seriesblue00_120x120_close_x';
                $tmp_width = 40;
                $tmp_height = 40;
                $tmp_alt = 'Close';
                $tmp_title = 'Navigation to Close';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'PRIMARY_NAV_BLUE00_CLOSE_X_CLICK':

                $tmp_filename = 'primary_nav_seriesblue00_120x120_close_x_click';
                $tmp_width = 40;
                $tmp_height = 40;
                $tmp_alt = 'Close';
                $tmp_title = 'Navigation to Close';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'PRIMARY_NAV_BLUE00_CLOSE_X_HOVER':

                $tmp_filename = 'primary_nav_seriesblue00_120x120_close_x_hvr';
                $tmp_width = 40;
                $tmp_height = 40;
                $tmp_alt = 'Close';
                $tmp_title = 'Navigation to Close';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'PRIMARY_NAV_BLUE00_CLOSE_X_INACTIVE':

                $tmp_filename = 'primary_nav_seriesblue00_120x120_close_x_inactive';
                $tmp_width = 40;
                $tmp_height = 40;
                $tmp_alt = 'Close';
                $tmp_title = 'Navigation to Close';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND':

                $tmp_filename = 'primary_nav_seriesblue00_120x120_fs_expand';
                $tmp_width = 40;
                $tmp_height = 40;
                $tmp_alt = 'Full Screen';
                $tmp_title = 'Navigation to Full Screen';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_CLICK':

                $tmp_filename = 'primary_nav_seriesblue00_120x120_fs_expand_click';
                $tmp_width = 40;
                $tmp_height = 40;
                $tmp_alt = 'Full Screen';
                $tmp_title = 'Navigation to Full Screen';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_HOVER':

                $tmp_filename = 'primary_nav_seriesblue00_120x120_fs_expand_hvr';
                $tmp_width = 40;
                $tmp_height = 40;
                $tmp_alt = 'Full Screen';
                $tmp_title = 'Navigation to Full Screen';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_INACTIVE':

                $tmp_filename = 'primary_nav_seriesblue00_120x120_fs_expand_inactive';
                $tmp_width = 40;
                $tmp_height = 40;
                $tmp_alt = 'Full Screen';
                $tmp_title = 'Navigation to Full Screen';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'PRIMARY_NAV_BLUE00_MENU':

                $tmp_filename = 'primary_nav_seriesblue00_120x120_menu';
                $tmp_width = 40;
                $tmp_height = 40;
                $tmp_alt = 'Menu';
                $tmp_title = 'Navigate to Menu';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'PRIMARY_NAV_BLUE00_MENU_CLICK':

                $tmp_filename = 'primary_nav_seriesblue00_120x120_menu_click';
                $tmp_width = 40;
                $tmp_height = 40;
                $tmp_alt = 'Menu';
                $tmp_title = 'Navigate to Menu';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'PRIMARY_NAV_BLUE00_MENU_HOVER':

                $tmp_filename = 'primary_nav_seriesblue00_120x120_menu_hvr';
                $tmp_width = 40;
                $tmp_height = 40;
                $tmp_alt = 'Menu';
                $tmp_title = 'Navigate to Menu';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'PRIMARY_NAV_BLUE00_MENU_INACTIVE':

                $tmp_filename = 'primary_nav_seriesblue00_120x120_menu_inactive';
                $tmp_width = 40;
                $tmp_height = 40;
                $tmp_alt = 'Menu';
                $tmp_title = 'Navigate to Menu';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'PRIMARY_NAV_BLUE00_MINIMIZE':

                $tmp_filename = 'primary_nav_seriesblue00_120x120_minimize';
                $tmp_width = 40;
                $tmp_height = 40;
                $tmp_alt = 'Minimize';
                $tmp_title = 'Navigate to Minimize';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'PRIMARY_NAV_BLUE00_MINIMIZE_CLICK':

                $tmp_filename = 'primary_nav_seriesblue00_120x120_minimize_click';
                $tmp_width = 40;
                $tmp_height = 40;
                $tmp_alt = 'Minimize';
                $tmp_title = 'Navigate to Minimize';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'PRIMARY_NAV_BLUE00_MINIMIZE_HOVER':

                $tmp_filename = 'primary_nav_seriesblue00_120x120_minimize_hvr';
                $tmp_width = 40;
                $tmp_height = 40;
                $tmp_alt = 'Minimize';
                $tmp_title = 'Navigate to Minimize';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'PRIMARY_NAV_BLUE00_MINIMIZE_INACTIVE':

                $tmp_filename = 'primary_nav_seriesblue00_120x120_minimize_inactive';
                $tmp_width = 40;
                $tmp_height = 40;
                $tmp_alt = 'Minimize';
                $tmp_title = 'Navigate to Minimize';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'PRIMARY_NAV_BLUE00_MINIMIZE_FIVEDEV':

                $tmp_filename = 'primary_nav_seriesblue00_120x120_minimize_fivedev';
                $tmp_width = 40;
                $tmp_height = 40;
                $tmp_alt = '5';
                $tmp_title = 'eVifweb development';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'PRIMARY_NAV_BLUE00_MINIMIZE_FIVEDEV_SMALL':

                $tmp_filename = 'primary_nav_seriesblue00_120x120_minimize_fivedev_sm';
                $tmp_width = 40;
                $tmp_height = 40;
                $tmp_alt = '5';
                $tmp_title = 'eVifweb development';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'MESSAGE_CONVERSATION_BUBBLE_MICRO_THUMB_BLUE00':

                $tmp_filename = 'crnrstn_message_bubbles_seriesblue00';
                $tmp_width = 63;
                $tmp_height = 39;
                $tmp_alt = 'CRNRSTN ::';
                $tmp_title = 'CRNRSTN ::';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'MESSAGE_CONVERSATION_BUBBLE':

                $tmp_filename = 'crnrstn_messenger_message_bubbles';
                $tmp_width = 172;
                $tmp_height = 106;
                $tmp_alt = 'CRNRSTN ::';
                $tmp_title = 'CRNRSTN ::';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'FIVE':

                $tmp_filename = '5';
                $tmp_width = 18;
                $tmp_height = 18;
                $tmp_alt = '5';
                $tmp_title = '5';
                $tmp_link = 'http://jony5.com/projects/crnrstn/philosophy/';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SUCCESS_CHECK':

                $tmp_filename = 'success_chk';
                $tmp_width = 19;
                $tmp_height = 19;
                $tmp_alt = 'success';
                $tmp_title = 'success';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'ERR_X':

                $tmp_filename = 'err_x';
                $tmp_width = 19;
                $tmp_height = 19;
                $tmp_alt = 'X';
                $tmp_title = 'error';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CRNRSTN_LOGO':

                $tmp_filename = 'crnrstn_logo_lg';
                $tmp_width = '';
                $tmp_height = 98;
                $tmp_alt = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_title = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CRNRSTN_R':
            case 'CRNRSTN_R_LG':

                $tmp_filename = 'crnrstn_R_lg';
                $tmp_width = 50;
                $tmp_height = 69;
                $tmp_alt = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_title = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CRNRSTN_R_MD':

                $tmp_filename = 'crnrstn_R_md';
                $tmp_width = 26;
                $tmp_height = 35;
                $tmp_alt = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_title = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CRNRSTN_R_SM':

                $tmp_filename = 'crnrstn_R_sm';
                $tmp_width = 12;
                $tmp_height = 16;
                $tmp_alt = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_title = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'R_PLUS_WALL':

                $tmp_filename = 'crnrstn_R_md_plus_wall';
                $tmp_width = 66;
                $tmp_height = 35;
                $tmp_alt = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_title = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'BG_ELEMENT_RESPONSE_CODE':

                $tmp_filename = 'elem_shadow_btm';
                $tmp_width = 1;
                $tmp_height = 5;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'PHP_ELLIPSE':

                $tmp_filename = 'php_logo';
                $tmp_width = 65;
                $tmp_height = 35;
                $tmp_alt = 'php v' . $this->oCRNRSTN->version_php();
                $tmp_title = 'php v' . $this->oCRNRSTN->version_php() . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = 'https://www.php.net/';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'POWER_BY_PHP':

                $tmp_filename = 'powered_by_php';
                $tmp_width = '';
                $tmp_height = 35;
                $tmp_alt = 'Powered by php v' . $this->oCRNRSTN->version_php();
                $tmp_title = 'Powered by php v' . $this->oCRNRSTN->version_php() . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = 'https://www.php.net/';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'ZEND_LOGO':

                $tmp_filename = 'zend_logo';
                $tmp_width = 73;
                $tmp_height = 39;
                $tmp_alt = 'ZEND';
                $tmp_title = 'ZEND' . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = 'https://www.zend.com/';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'ZEND_FRAMEWORK':

                $tmp_filename = 'zend_framework';
                $tmp_width = 212;
                $tmp_height = 40;
                $tmp_alt = 'ZEND FRAMEWORK';
                $tmp_title = 'ZEND FRAMEWORK' . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = 'https://www.zend.com/';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'ZEND_FRAMEWORK_3':

                $tmp_filename = 'zend_framework_3';
                $tmp_width = 224;
                $tmp_height = 38;
                $tmp_alt = 'ZEND FRAMEWORK 3';
                $tmp_title = 'ZEND FRAMEWORK 3' . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = 'https://www.zend.com/';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'LINUX_PENGUIN_LRG':

                $tmp_filename = 'linux_penguin_lg';
                $tmp_width = 30;
                $tmp_height = 35;
                $tmp_alt = 'Linux :: Tux the Penguin';
                $tmp_title = 'Linux' . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = 'https://www.linux.com/';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'LINUX_PENGUIN_MED':

                $tmp_filename = 'linux_penguin_md';
                $tmp_width = '';
                $tmp_height = 100;
                $tmp_alt = 'Linux :: Tux the Penguin';
                $tmp_title = 'Linux' . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = 'https://www.linux.com/';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'LINUX_PENGUIN_SMALL':

                $tmp_filename = 'linux_penguin_sm';
                $tmp_width = 30;
                $tmp_height = 35;
                $tmp_alt = 'Linux :: Tux the Penguin';
                $tmp_title = 'Linux' . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = 'https://www.linux.com/';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'MYSQL_DOLPHIN':

                $tmp_filename = 'mysql_logo';
                $tmp_width = 66;
                $tmp_height = 34;

                if(strlen($this->oCRNRSTN->version_mysqli()) > 0){

                    $tmp_alt = 'MySQLi v' . $this->oCRNRSTN->version_mysqli();
                    $tmp_title = 'MySQLi v' . $this->oCRNRSTN->version_mysqli() . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();

                }else{

                    $tmp_alt = 'MySQLi';
                    $tmp_title = 'MySQLi' . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();

                }

                $tmp_link = 'https://www.mysql.com/';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'REDHAT_HAT_LOGO':

                $tmp_filename = 'redhat_hat_logo';
                $tmp_width = 57;
                $tmp_height = 42;
                $tmp_alt = 'Red Hat';
                $tmp_title = 'Red Hat' . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = 'https://www.redhat.com/';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'REDHAT_LOGO':

                $tmp_filename = 'redhat_logo';
                $tmp_width = 130;
                $tmp_height = 42;
                $tmp_alt = 'Red Hat';
                $tmp_title = 'Red Hat' . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = 'https://www.redhat.com/';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'APACHE_FEATHER':

                $tmp_filename = 'apache_feather_logo';
                $tmp_width = 131;
                $tmp_height = 40;

                if(strlen($this->oCRNRSTN->version_apache()) > 0){

                    $tmp_alt = 'Powered by Apache v' . $this->oCRNRSTN->version_apache();
                    $tmp_title = 'Powered by Apache v' . $this->oCRNRSTN->version_apache() . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();

                }else{

                    $tmp_alt = 'Powered by Apache';
                    $tmp_title = 'Powered by Apache v' . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();

                }

                $tmp_link = 'http://apache.org/';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'APACHE_POWER_VERSION':

                $version = $this->oCRNRSTN->version_apache_sysimg();

                switch ($version){
                    case 2.4:

                        return $this->asset_data('APACHE_POWER_2_4', $width_override, $height_override, $link_override, $alt_override, $title_override, $target_override, $output_mode);

                    break;
                    case 2.2:

                        return $this->asset_data('APACHE_POWER_2_2', $width_override, $height_override, $link_override, $alt_override, $title_override, $target_override, $output_mode);

                    break;
                    case 2.0:

                        return $this->asset_data('APACHE_POWER_2_0', $width_override, $height_override, $link_override, $alt_override, $title_override, $target_override, $output_mode);

                    break;
                    case 1.3:

                        return $this->asset_data('APACHE_POWER_1_3', $width_override, $height_override, $link_override, $alt_override, $title_override, $target_override, $output_mode);

                    break;
                    default:

                        return $this->asset_data('APACHE_POWER', $width_override, $height_override, $link_override, $alt_override, $title_override, $target_override, $output_mode);

                    break;

                }

            break;
            case 'APACHE_POWER_2_4':

                $tmp_filename = 'powered_by_apache_2_4';
                $tmp_width = 259;
                $tmp_height = 32;

                if(strlen($this->oCRNRSTN->version_apache()) > 0){

                    $tmp_alt = 'Powered by Apache v' . $this->oCRNRSTN->version_apache();
                    $tmp_title = 'Powered by Apache v' . $this->oCRNRSTN->version_apache() . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();

                }else{

                    $tmp_alt = 'Powered by Apache';
                    $tmp_title = 'Powered by Apache v' . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();

                }

                $tmp_link = 'http://apache.org/';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'APACHE_POWER_2_2':

                $tmp_filename = 'powered_by_apache_2_2';
                $tmp_width = 259;
                $tmp_height = 32;

                if(strlen($this->oCRNRSTN->version_apache()) > 0){

                    $tmp_alt = 'Powered by Apache v' . $this->oCRNRSTN->version_apache();
                    $tmp_title = 'Powered by Apache v' . $this->oCRNRSTN->version_apache() . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();

                }else{

                    $tmp_alt = 'Powered by Apache';
                    $tmp_title = 'Powered by Apache v' . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();

                }

                $tmp_link = 'http://apache.org/';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'APACHE_POWER_2_0':

                $tmp_filename = 'powered_by_apache_2';
                $tmp_width = 259;
                $tmp_height = 32;

                if(strlen($this->oCRNRSTN->version_apache()) > 0){

                    $tmp_alt = 'Powered by Apache v' . $this->oCRNRSTN->version_apache();
                    $tmp_title = 'Powered by Apache v' . $this->oCRNRSTN->version_apache() . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();

                }else{

                    $tmp_alt = 'Powered by Apache';
                    $tmp_title = 'Powered by Apache v' . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();

                }

                $tmp_link = 'http://apache.org/';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'APACHE_POWER_1_3':

                $tmp_filename = 'powered_by_apache_1_3';
                $tmp_width = 259;
                $tmp_height = 32;

                if(strlen($this->oCRNRSTN->version_apache()) > 0){

                    $tmp_alt = 'Powered by Apache v' . $this->oCRNRSTN->version_apache();
                    $tmp_title = 'Powered by Apache v' . $this->oCRNRSTN->version_apache() . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();

                }else{

                    $tmp_alt = 'Powered by Apache';
                    $tmp_title = 'Powered by Apache v' . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();

                }

                $tmp_link = 'http://apache.org/';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'APACHE_POWER':

                $tmp_filename = 'powered_by_apache';
                $tmp_width = 259;
                $tmp_height = 32;

                $tmp_alt = 'Powered by Apache';
                $tmp_title = 'Powered by Apache' . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();

                $tmp_link = 'http://apache.org/';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'BG_ELEMENT_REFLECTION_SIGNIN':

                $tmp_filename = 'signin_frm_reflection';
                $tmp_width = 722;
                $tmp_height = 55;
                $tmp_alt = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_title = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'DOT_GREEN':

                $tmp_filename = 'dot_grn';
                $tmp_width = 20;
                $tmp_height = 20;
                $tmp_alt = 'O';
                $tmp_title = 'O';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'DOT_RED':

                $tmp_filename = 'dot_red';
                $tmp_width = 20;
                $tmp_height = 20;
                $tmp_alt = 'O';
                $tmp_title = 'O';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'DOT_GREY':

                $tmp_filename = 'dot_grey';
                $tmp_width = 20;
                $tmp_height = 20;
                $tmp_alt = 'O';
                $tmp_title = 'O';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'NOTICE_TRI_ALERT':

                $tmp_filename = 'triangle_alert';
                $tmp_width = 19;
                $tmp_height = 19;
                $tmp_alt = '!';
                $tmp_title = 'alert';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'NOTICE_TRI_ALERT_HQ':

                $tmp_filename = 'triangle_alert_hq';
                $tmp_width = 120;
                $tmp_height = 120;
                $tmp_alt = 'alert!';
                $tmp_title = 'alert';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SEARCH_MAGNIFY_GLASS':

                $tmp_filename = 'mag_glass_search';
                $tmp_width = '';
                $tmp_height = 14;
                $tmp_alt = 'Search';
                $tmp_title = 'Search';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'ICON_EMAIL_INBOX_REFLECTED':

                $tmp_filename = 'email_inbox_icon';
                $tmp_width = 201;
                $tmp_height = 185;
                $tmp_alt = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_title = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'R_STONE_GIANT_PILLAR':

                $tmp_filename = 'r_stone_giant_pillar';
                $tmp_width = 336;
                $tmp_height = 3000;
                $tmp_alt = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_title = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'R_STONE_PILLAR':

                $tmp_filename = 'r_stone_pillar';
                $tmp_width = 112;
                $tmp_height = 1000;
                $tmp_alt = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_title = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'WOOD':

                $tmp_filename = 'wood';
                $tmp_width = 512;
                $tmp_height = 450;
                $tmp_alt = 'wood';
                $tmp_title = 'wood';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'STACHE':

                $tmp_filename = 'stache';
                $tmp_width = 93;
                $tmp_height = 30;
                $tmp_alt = 'stache';
                $tmp_title = 'stache';
                $tmp_link = 'http://jony5.com';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'STACHE_SOCIAL':

                $tmp_filename = 'stache_social';
                $tmp_width = 93;
                $tmp_height = 30;
                $tmp_alt = 'stache';
                $tmp_title = 'stache';
                $tmp_link = 'http://jony5.com';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'UI_PAGELOAD_INDICATOR':

                $tmp_filename = 'element_page_load_indicator';
                $tmp_width = 17;
                $tmp_height = 3000;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_META_PREVIEW':

                $tmp_filename = 'crnrstn_logo_social_preview_github_00';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'J5_WOLF_PUP_RAND':

                $tmp_array = array('J5_WOLF_PUP', 'J5_WOLF_PUP_LAY_00', 'J5_WOLF_PUP_LAY_01', 'J5_WOLF_PUP_LAY_02',
                    'J5_WOLF_PUP_LAY_LOOK_AWAY', 'J5_WOLF_PUP_LAY_LOOK_FORWARD', 'J5_WOLF_PUP_LAY_LOOK_FORWARD_LEASH',
                    'J5_WOLF_PUP_LEASH_EYES_CLOSED', 'J5_WOLF_PUP_LIL_5_PTS', 'J5_WOLF_PUP_SIT_EYES_CLOSED',
                    'J5_WOLF_PUP_SIT_LOOK_FORWARD', 'J5_WOLF_PUP_SIT_LOOK_LEFT_ISH_SHADOW', 'J5_WOLF_PUP_SIT_LOOK_RIGHT',
                    'J5_WOLF_PUP_SIT_LOOK_RIGHT_LONGSHADOW', 'J5_WOLF_PUP_SIT_LOOK_RIGHT_SHADOW',
                    'J5_WOLF_PUP_SIT_LOOK_RIGHT_SHORT_SHADOW', 'J5_WOLF_PUP_SIT_LOOK_RIGHT_UP',
                    'J5_WOLF_PUP_SIT_LOOK_RIGHTSHARP_SHADOW', 'J5_WOLF_PUP_STAND_LOOK_RIGHT', 'J5_WOLF_PUP_STAND_LOOK_UP',
                    'J5_WOLF_PUP_WALK');

                $tmp_cnt = count($tmp_array);
                $tmp_int = rand(0, $tmp_cnt - 1);

                $tmp_original_output_mode = $output_mode;
                $tmp_ARRAY = $this->asset_data_meta($tmp_array[$tmp_int], $asset_family, $width_override, $height_override, $link_override, $alt_override, $title_override, $target_override, NULL, CRNRSTN_FILE_MANAGEMENT);
                $tmp_ARRAY['output_mode'] = $tmp_original_output_mode;

                return $tmp_ARRAY;

            break;
            case 'J5_WOLF_PUP':

                $tmp_filename = 'j5_wolf_pup';
                $tmp_width = 525;
                $tmp_height = 351;
                $tmp_alt = 'J5 Wolf Pup';
                $tmp_title = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'J5_WOLF_PUP_LAY_00':

                $tmp_filename = 'j5_wolf_pup_lay_00';
                $tmp_width = '';
                $tmp_height = 345;
                $tmp_alt = 'J5 Wolf Pup';
                $tmp_title = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'J5_WOLF_PUP_LAY_01':

                $tmp_filename = 'j5_wolf_pup_lay_01';
                $tmp_width = '';
                $tmp_height = 400;
                $tmp_alt = 'J5 Wolf Pup';
                $tmp_title = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'J5_WOLF_PUP_LAY_02':

                $tmp_filename = 'j5_wolf_pup_lay_02';
                $tmp_width = '';
                $tmp_height = 348;
                $tmp_alt = 'J5 Wolf Pup';
                $tmp_title = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'J5_WOLF_PUP_LAY_LOOK_AWAY':

                $tmp_filename = 'j5_wolf_pup_lay_look_away';
                $tmp_width = '';
                $tmp_height = 400;
                $tmp_alt = 'J5 Wolf Pup';
                $tmp_title = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'J5_WOLF_PUP_LAY_LOOK_FORWARD':

                $tmp_filename = 'j5_wolf_pup_lay_look_forward';
                $tmp_width = '';
                $tmp_height = 450;
                $tmp_alt = 'J5 Wolf Pup';
                $tmp_title = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'J5_WOLF_PUP_LAY_LOOK_FORWARD_LEASH':

                $tmp_filename = 'j5_wolf_pup_lay_look_forward_leash';
                $tmp_width = '';
                $tmp_height = 365;
                $tmp_alt = 'J5 Wolf Pup';
                $tmp_title = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'J5_WOLF_PUP_LEASH_EYES_CLOSED':

                $tmp_filename = 'j5_wolf_pup_leash_eyes_closed';
                $tmp_width = '';
                $tmp_height = 370;
                $tmp_alt = 'J5 Wolf Pup';
                $tmp_title = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'J5_WOLF_PUP_LIL_5_PTS':

                $tmp_filename = 'j5_wolf_pup_lil_5_pts';
                $tmp_width = '';
                $tmp_height = 340;
                $tmp_alt = 'J5 Wolf Pup';
                $tmp_title = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'J5_WOLF_PUP_SIT_EYES_CLOSED':

                $tmp_filename = 'j5_wolf_pup_sit_eyes_closed';
                $tmp_width = '';
                $tmp_height = 376;
                $tmp_alt = 'J5 Wolf Pup';
                $tmp_title = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_FORWARD':

                $tmp_filename = 'j5_wolf_pup_sit_look_forward';
                $tmp_width = '';
                $tmp_height = 400;
                $tmp_alt = 'J5 Wolf Pup';
                $tmp_title = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_LEFT_ISH_SHADOW':

                $tmp_filename = 'j5_wolf_pup_sit_look_left_ish_shadow';
                $tmp_width = '';
                $tmp_height = 305;
                $tmp_alt = 'J5 Wolf Pup';
                $tmp_title = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_RIGHT':

                $tmp_filename = 'j5_wolf_pup_sit_look_right';
                $tmp_width = '';
                $tmp_height = 416;
                $tmp_alt = 'J5 Wolf Pup';
                $tmp_title = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_RIGHT_LONGSHADOW':

                $tmp_filename = 'j5_wolf_pup_sit_look_right_longshadow';
                $tmp_width = '';
                $tmp_height = 346;
                $tmp_alt = 'J5 Wolf Pup';
                $tmp_title = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_RIGHT_SHADOW':

                $tmp_filename = 'j5_wolf_pup_sit_look_right_shadow';
                $tmp_width = '';
                $tmp_height = 290;
                $tmp_alt = 'J5 Wolf Pup';
                $tmp_title = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_RIGHT_SHORT_SHADOW':

                $tmp_filename = 'j5_wolf_pup_sit_look_right_shortshadow';
                $tmp_width = '';
                $tmp_height = 443;
                $tmp_alt = 'J5 Wolf Pup';
                $tmp_title = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_RIGHT_UP':

                $tmp_filename = 'j5_wolf_pup_sit_look_right_up';
                $tmp_width = '';
                $tmp_height = 413;
                $tmp_alt = 'J5 Wolf Pup';
                $tmp_title = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_RIGHTSHARP_SHADOW':

                $tmp_filename = 'j5_wolf_pup_sit_look_rightsharp_shadow';
                $tmp_width = '';
                $tmp_height = 331;
                $tmp_alt = 'J5 Wolf Pup';
                $tmp_title = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'J5_WOLF_PUP_STAND_LOOK_RIGHT':

                $tmp_filename = 'j5_wolf_pup_stand_look_right';
                $tmp_width = '';
                $tmp_height = 390;
                $tmp_alt = 'J5 Wolf Pup';
                $tmp_title = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'J5_WOLF_PUP_STAND_LOOK_UP':

                $tmp_filename = 'j5_wolf_pup_stand_look_up';
                $tmp_width = '';
                $tmp_height = 347;
                $tmp_alt = 'J5 Wolf Pup';
                $tmp_title = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'J5_WOLF_PUP_WALK':

                $tmp_filename = 'j5_wolf_pup_walk';
                $tmp_width = '';
                $tmp_height = 430;
                $tmp_alt = 'J5 Wolf Pup';
                $tmp_title = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'J5_WOLF_PUP_TOP_RIGHT':

                $tmp_filename = 'j5_pup_top_right';
                $tmp_width = '';
                $tmp_height = 400;
                $tmp_alt = 'J5 Wolf Pup';
                $tmp_title = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            default:

                //
                // ALLOW ARRAY DATA TYPE RETURN TO BE INDICATION OF SUCCESS.
                return false;

                $tmp_filename = $asset_data_key;
                $tmp_width = '';
                $tmp_height = '';
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;
                //error_log(__LINE__ . ' asset mgr CASE DEFAULT DATA $asset_data_key[' . $asset_data_key . ']. $tmp_asset_family[' . $tmp_asset_family . '].');

            break;

        }

        //
        // AUGMENT DOCUMENTATION WITH ASSET META.
        if($output_mode == CRNRSTN_RESOURCE_DOCUMENTATION){

            $tmp_ARRAY[$asset_data_key]['alt'] = $tmp_alt;
            $tmp_ARRAY[$asset_data_key]['title'] = $tmp_title;

            return $tmp_ARRAY;

        }

        if($output_mode == CRNRSTN_FILE_MANAGEMENT){

            if(isset($tmp_filename)){

                $tmp_ARRAY['asset_data_key'] = $asset_data_key;
                $tmp_ARRAY['asset_family'] = $tmp_asset_family;
                $tmp_ARRAY['filename'] = $tmp_filename;
                $tmp_ARRAY['width'] = $tmp_width;
                $tmp_ARRAY['height'] = $tmp_height;
                $tmp_ARRAY['alt'] = $tmp_alt;
                $tmp_ARRAY['title'] = $tmp_title;
                $tmp_ARRAY['hyperlink'] = $tmp_link;
                $tmp_ARRAY['target'] = $tmp_target;
                $tmp_ARRAY['raw_output_mode'] = $tmp_raw_output_mode;
                // SET ABOVE. $tmp_ARRAY['output_mode_method_src'] =

                //error_log(__LINE__ . ' asset mgr RETURN META $tmp_ARRAY[' . print_r($tmp_ARRAY, true) . '].');
                return $tmp_ARRAY;

            }

        }

        return false;

    }

    //
    // TIDY TIDY ON Monday May 1, 2023 1833 hrs
    private function asset_data_meta_social($asset_data_key, $asset_family = NULL, $width_override = NULL, $height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $path = NULL, $output_mode = CRNRSTN_FILE_MANAGEMENT){

        //
        //NMo
        $tmp_ARRAY = array();
        $tmp_ARRAY['output_mode_method_src'] = $output_mode;
        $tmp_filename = $tmp_width = $tmp_height = $tmp_alt = $tmp_title = $tmp_link = $tmp_target = $tmp_asset_family = $tmp_raw_output_mode = '';

        switch($asset_data_key){

            //
            // START SOCIAL RESOURCES META.
            // *************
            /*
            AWAITING IMPLEMENTATION
            MOVE JPG PROPHET MEMES INTO POSITION:
            MOVE FROM -->_crnrstn/ui/imgs/jpg/social/lets_all_persecute_a_prophet_meme_willy-wonka-no-ask.jpg
            MOVE TO -->_crnrstn/ui/imgs/jpxxx // I WANT TO RE-DO THESE MEMES FOR HQ/LOW-QUAL.
            -----
            JQUERY public_html/_crnrstn/ui/imgs/png/social/jquery_hq.png
            JQUERY public_html/_crnrstn/ui/imgs/png/social/jquery.png


            */
            ///////
            case 'SOCIAL_AMAZON':

                $tmp_filename = 'amazon_icon';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Amazon';
                $tmp_title = 'Link to Amazon related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_AMAZON_HQ':

                $tmp_filename = 'amazon_icon_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Amazon';
                $tmp_title = 'Link to Amazon related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_APPLE_LOGO_BLK':

                $tmp_filename = 'apple_logo_blk';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Apple';
                $tmp_title = 'Link to Apple related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_APPLE_LOGO_BLK_HQ':

                $tmp_filename = 'apple_logo_blk_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Apple';
                $tmp_title = 'Link to Apple related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_APPLE_LOGO_BLK_WHT_CIRCLE':

                $tmp_filename = 'apple_logo_blk_wht_circle';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Apple';
                $tmp_title = 'Link to Apple related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_APPLE_LOGO_BLK_WHT_CIRCLE_HQ':

                $tmp_filename = 'apple_logo_blk_wht_circle_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Apple';
                $tmp_title = 'Link to Apple related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_APPLE_LOGO_GREY':

                $tmp_filename = 'apple_logo_grey';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Apple';
                $tmp_title = 'Link to Apple related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_APPLE_LOGO_GREY_HQ':

                $tmp_filename = 'apple_logo_grey_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Apple';
                $tmp_title = 'Link to Apple related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_APPLE_LOGO_GREY_BLK_CIRCLE':

                $tmp_filename = 'apple_logo_grey_blk_circle';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Apple';
                $tmp_title = 'Link to Apple related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_APPLE_LOGO_GREY_BLK_CIRCLE_HQ':

                $tmp_filename = 'apple_logo_grey_blk_circle_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Apple';
                $tmp_title = 'Link to Apple related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_APPLE_LOGO_GREY_WHT_CIRCLE':

                $tmp_filename = 'apple_logo_grey_wht_circle';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Apple';
                $tmp_title = 'Link to Apple related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_APPLE_LOGO_GREY_WHT_CIRCLE_HQ':

                $tmp_filename = 'apple_logo_grey_wht_circle_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Apple';
                $tmp_title = 'Link to Apple related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_APPLE_LOGO_WHT':

                $tmp_filename = 'apple_logo_wht';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Apple';
                $tmp_title = 'Link to Apple related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_APPLE_LOGO_WHT_HQ':

                $tmp_filename = 'apple_logo_wht_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Apple';
                $tmp_title = 'Link to Apple related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_APPLE_LOGO_WHT_BLK_CIRCLE':

                $tmp_filename = 'apple_logo_wht_blk_circle';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Apple';
                $tmp_title = 'Link to Apple related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_APPLE_LOGO_WHT_BLK_CIRCLE_HQ':

                $tmp_filename = 'apple_logo_wht_blk_circle_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Apple';
                $tmp_title = 'Link to Apple related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_APPLE_MUSIC':

                $tmp_filename = 'apple_music';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Apple Music';
                $tmp_title = 'Link to Apple Music related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_APPLE_MUSIC_HQ':

                $tmp_filename = 'apple_music_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Apple Music';
                $tmp_title = 'Link to Apple Music related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_ARCHIVES':

                $tmp_filename = 'archives';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Archives';
                $tmp_title = 'Link to Archives.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_ARCHIVES_HQ':

                $tmp_filename = 'archives_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Archives';
                $tmp_title = 'Link to Archives.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_BANDCAMP':

                $tmp_filename = 'bandcamp';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Bandcamp';
                $tmp_title = 'Link to Bandcamp music page.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_BANDCAMP_HQ':

                $tmp_filename = 'bandcamp_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Bandcamp';
                $tmp_title = 'Link to Bandcamp music page.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_BASSDRIVE':

                $tmp_filename = 'bassdrive';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Bassdrive';
                $tmp_title = 'Link to Bassdrive profile.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_BASSDRIVE_HQ':

                $tmp_filename = 'bassdrive_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Bassdrive';
                $tmp_title = 'Link to Bassdrive profile.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_BEATPORT':

                $tmp_filename = 'beatport';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Beatport';
                $tmp_title = 'Link to Beatport featured tracks.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_BEATPORT_HQ':

                $tmp_filename = 'beatport_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Beatport';
                $tmp_title = 'Link to Beatport featured tracks.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_BLOGSPOT':

                $tmp_filename = 'blogspot';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Blogspot';
                $tmp_title = 'Link to Blogspot related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_BLOGSPOT_HQ':

                $tmp_filename = 'blogspot_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Blogspot';
                $tmp_title = 'Link to Blogspot related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_BLUEHOST_ICON':

                $tmp_filename = 'bluehost_icon';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Bluehost';
                $tmp_title = 'Link to Bluehost related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_BLUEHOST_ICON_HQ':

                $tmp_filename = 'bluehost_icon_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Bluehost';
                $tmp_title = 'Link to Bluehost related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_BLUEHOST_WORDMARK':

                $tmp_filename = 'bluehost_wordmark';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Bluehost';
                $tmp_title = 'Link to Bluehost related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_BLUEHOST_WORDMARK_HQ':

                $tmp_filename = 'bluehost_wordmark_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Bluehost';
                $tmp_title = 'Link to Bluehost related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_DISCOGS':

                $tmp_filename = 'discogs';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Discogs';
                $tmp_title = 'Link to Discogs music selection.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_DISCOGS_HQ':

                $tmp_filename = 'discogs_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Discogs';
                $tmp_title = 'Link to Discogs music selection.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_DRIBBLE':

                $tmp_filename = 'dribble';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Dribble';
                $tmp_title = 'Link to Dribble resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_DRIBBLE_HQ':

                $tmp_filename = 'dribble_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Dribble';
                $tmp_title = 'Link to Dribble resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_EBAY':

                $tmp_filename = 'ebay';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Ebay';
                $tmp_title = 'Link to Ebay related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_EBAY_HQ':

                $tmp_filename = 'ebay_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Ebay';
                $tmp_title = 'Link to Ebay related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_ETSY':

                $tmp_filename = 'etsy';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Etsy';
                $tmp_title = 'Link to Etsy related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_ETSY_HQ':

                $tmp_filename = 'etsy_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Etsy';
                $tmp_title = 'Link to Etsy related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_FACEBOOK':

                $tmp_filename = 'facebook';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Facebook';
                $tmp_title = 'Link to Facebook page.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_FACEBOOK_HQ':

                $tmp_filename = 'facebook_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Facebook';
                $tmp_title = 'Link to Facebook page.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_FEEDBURNER':

                $tmp_filename = 'feedburner';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Feedburner';
                $tmp_title = 'Link to Feedburner proxy resources.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_FEEDBURNER_HQ':

                $tmp_filename = 'feedburner_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Feedburner';
                $tmp_title = 'Link to Feedburner proxy resources.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_FLICKR':

                $tmp_filename = 'flickr';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Flickr';
                $tmp_title = 'Link to Flickr related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_FLICKR_HQ':

                $tmp_filename = 'flickr_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Flickr';
                $tmp_title = 'Link to Flickr related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_GITHUB':

                $tmp_filename = 'github';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'GitHub';
                $tmp_title = 'Link to GitHub related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_GITHUB_HQ':

                $tmp_filename = 'github_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'GitHub';
                $tmp_title = 'Link to GitHub related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_GOOGLE_DRIVE':

                $tmp_filename = 'google_drive';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Google Drive';
                $tmp_title = 'Link to Google Drive related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_GOOGLE_DRIVE_HQ':

                $tmp_filename = 'google_drive_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Google Drive';
                $tmp_title = 'Link to Google Drive related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_GOOGLE_MAPS':

                $tmp_filename = 'google_maps';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Google Maps Anniversary';
                $tmp_title = 'Link to Google Maps related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_GOOGLE_MAPS_HQ':

                $tmp_filename = 'google_maps_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Google Maps Anniversary';
                $tmp_title = 'Link to Google Maps related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_GOOGLE_MAPS_SQUARE':

                $tmp_filename = 'google_maps_square';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Google Maps';
                $tmp_title = 'Link to Google Maps related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_GOOGLE_MAPS_SQUARE_HQ':

                $tmp_filename = 'google_maps_square_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Google Maps';
                $tmp_title = 'Link to Google Maps related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_HISTORY':

                $tmp_filename = 'history';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'History';
                $tmp_title = 'Link to history.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_HISTORY_HQ':

                $tmp_filename = 'history_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'History';
                $tmp_title = 'Link to history.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_IDEONE':

                $tmp_filename = 'ide1_icon';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'IDE ONE';
                $tmp_title = 'Link to IDE ONE related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_IDEONE_HQ':

                $tmp_filename = 'ide1_icon_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'IDE ONE';
                $tmp_title = 'Link to IDE ONE related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_INSTAGRAM':

                $tmp_filename = 'instagram';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Instagram';
                $tmp_title = 'Link to Instagram feed.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_INSTAGRAM_HQ':

                $tmp_filename = 'instagram_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Instagram';
                $tmp_title = 'Link to Instagram feed.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_INTERNET_ARCHIVE':

                $tmp_filename = 'internet_archive';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Internet Archive';
                $tmp_title = 'Link to Internet Archive related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_INTERNET_ARCHIVE_HQ':

                $tmp_filename = 'internet_archive_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Internet Archive';
                $tmp_title = 'Link to Internet Archive related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_JSON':

                $tmp_filename = 'json';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'JSON';
                $tmp_title = 'Link to JSON.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_JSON_HQ':

                $tmp_filename = 'json_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'JSON';
                $tmp_title = 'Link to JSON.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_KINK':

                $tmp_filename = 'kink';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Kink';
                $tmp_title = 'Link to Kink related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_KINK_HQ':

                $tmp_filename = 'kink_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Kink';
                $tmp_title = 'Link to Kink related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_LAST_FM':

                $tmp_filename = 'last_fm';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Last.fm';
                $tmp_title = 'Link to Last.fm related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_LAST_FM_HQ':

                $tmp_filename = 'last_fm_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Last.fm';
                $tmp_title = 'Link to Last.fm related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_LINKEDIN':

                $tmp_filename = 'linkedin';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'LinkedIn';
                $tmp_title = 'Link to LinkedIn profile.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_LINKEDIN_HQ':

                $tmp_filename = 'linkedin_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'LinkedIn';
                $tmp_title = 'Link to LinkedIn profile.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_MICROSOFT':

                $tmp_filename = 'microsoft_icon';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Microsoft';
                $tmp_title = 'Link to Microsoft related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_MICROSOFT_HQ':

                $tmp_filename = 'microsoft_icon_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Microsoft';
                $tmp_title = 'Link to Microsoft related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_MIXCLOUD':

                $tmp_filename = 'mixcloud';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Mixcloud';
                $tmp_title = 'Link to Mixcloud community.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_MIXCLOUD_HQ':

                $tmp_filename = 'mixcloud_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Mixcloud';
                $tmp_title = 'Link to Mixcloud community.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_MOZILLA_ICON':

                $tmp_filename = 'mozilla_icon';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Mozilla Developer Network';
                $tmp_title = 'Mozilla';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_MOZILLA_ICON_HQ':

                $tmp_filename = 'mozilla_icon_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Mozilla Developer Network';
                $tmp_title = 'Mozilla';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_MOZILLA_WORDMARK':

                $tmp_filename = 'mozilla_wordmark';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Mozilla Developer Network';
                $tmp_title = 'Mozilla';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_MOZILLA_WORDMARK_HQ':

                $tmp_filename = 'mozilla_wordmark_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Mozilla Developer Network';
                $tmp_title = 'Mozilla';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_PANDORA':

                $tmp_filename = 'pandora_icon';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Pandora';
                $tmp_title = 'Link to Pandora related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_PANDORA_HQ':

                $tmp_filename = 'pandora_icon_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Pandora';
                $tmp_title = 'Link to Pandora related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_PATREON':

                $tmp_filename = 'patreon';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Patreon';
                $tmp_title = 'Link to Patreon related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_PATREON_HQ':

                $tmp_filename = 'patreon_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Patreon';
                $tmp_title = 'Link to Patreon related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_PAYPAL':

                $tmp_filename = 'paypal';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Paypal';
                $tmp_title = 'Link to Paypal related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_PAYPAL_HQ':

                $tmp_filename = 'paypal_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Paypal';
                $tmp_title = 'Link to Paypal related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_PHP':

                $tmp_filename = 'php_icon';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'php v' . $this->oCRNRSTN->version_php();
                $tmp_title = 'Link to php related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_PHP_HQ':

                $tmp_filename = 'php_icon_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'php v' . $this->oCRNRSTN->version_php();
                $tmp_title = 'Link to php related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_PINTEREST':

                $tmp_filename = 'pinterest';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Pinterest';
                $tmp_title = 'Link to Pinterest related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_PINTEREST_HQ':

                $tmp_filename = 'pinterest_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Pinterest';
                $tmp_title = 'Link to Pinterest related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_PORNHUB':

                $tmp_filename = 'pornhub';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Pornhub';
                $tmp_title = 'Link to Pornhub related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_PORNHUB_HQ':

                $tmp_filename = 'pornhub_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Pornhub';
                $tmp_title = 'Link to Pornhub related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_REDDIT':

                $tmp_filename = 'reddit';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Reddit';
                $tmp_title = 'Link to Reddit related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_REDDIT_HQ':

                $tmp_filename = 'reddit_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Reddit';
                $tmp_title = 'Link to Reddit related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_ROLLDABEATS':

                $tmp_filename = 'rolldabeats';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'RollDaBeats';
                $tmp_title = 'Link to RollDaBeats catalog.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_ROLLDABEATS_HQ':

                $tmp_filename = 'rolldabeats_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'RollDaBeats';
                $tmp_title = 'Link to RollDaBeats catalog.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_SERVER_FAULT':

                $tmp_filename = 'server_fault';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Server Fault';
                $tmp_title = 'Link to Server Fault related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_SERVER_FAULT_HQ':

                $tmp_filename = 'server_fault_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Server Fault';
                $tmp_title = 'Link to Server Fault related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_SLASHDOT_ICON':

                $tmp_filename = 'slashdot_icon';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Slashdot';
                $tmp_title = 'Link to Slashdot related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_SLASHDOT_ICON_HQ':

                $tmp_filename = 'slashdot_icon_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Slashdot';
                $tmp_title = 'Link to Slashdot related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_SLASHDOT_WORDMARK':

                $tmp_filename = 'slashdot_wordmark';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Slashdot';
                $tmp_title = 'Link to Slashdot related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_SLASHDOT_WORDMARK_HQ':

                $tmp_filename = 'slashdot_wordmark_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Slashdot';
                $tmp_title = 'Link to Slashdot related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_SOUNDCLOUD':

                $tmp_filename = 'soundcloud';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'SoundCloud';
                $tmp_title = 'Link to SoundCloud tracks.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_SOUNDCLOUD_HQ':

                $tmp_filename = 'soundcloud_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'SoundCloud';
                $tmp_title = 'Link to SoundCloud tracks.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_SPOTIFY':

                $tmp_filename = 'spotify';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Spotify';
                $tmp_title = 'Link to Spotify related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_SPOTIFY_HQ':

                $tmp_filename = 'spotify_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Spotify';
                $tmp_title = 'Link to Spotify related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_SPRITE':

                $tmp_filename = 'social/sprite';
                $tmp_width = 324;
                $tmp_height = 421;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_SPRITE_HQ':

                $tmp_filename = 'social/sprite_hq';
                $tmp_width = 969;
                $tmp_height = 1292;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_STACKOVERFLOW':

                $tmp_filename = 'stackoverflow';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Stackoverflow';
                $tmp_title = 'Link to Stackoverflow related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_STACKOVERFLOW_HQ':

                $tmp_filename = 'stackoverflow_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Stackoverflow';
                $tmp_title = 'Link to Stackoverflow related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_TWITCH':

                $tmp_filename = 'twitch';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Twitch';
                $tmp_title = 'Link to Twitch related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_TWITCH_HQ':

                $tmp_filename = 'twitch_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Twitch';
                $tmp_title = 'Link to Twitch related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_TWITTER':

                $tmp_filename = 'twitter';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Twitter';
                $tmp_title = 'Link to Twitter feed.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_TWITTER_HQ':

                $tmp_filename = 'twitter_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Twitter';
                $tmp_title = 'Link to Twitter feed.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_VIMEO_BLUE_ICON':

                $tmp_filename = 'vimeo_blue_icon';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Vimeo';
                $tmp_title = 'Link to Vimeo related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_VIMEO_BLUE_ICON_HQ':

                $tmp_filename = 'vimeo_blue_icon_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Vimeo';
                $tmp_title = 'Link to Vimeo related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_VIMEO_BLUE_WORDMARK':

                $tmp_filename = 'vimeo_blue_wordmark';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Vimeo';
                $tmp_title = 'Link to Vimeo related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_VIMEO_BLUE_WORDMARK_HQ':

                $tmp_filename = 'vimeo_blue_wordmark_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Vimeo';
                $tmp_title = 'Link to Vimeo related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_VIMEO_DARKFOREST_WORDMARK':

                $tmp_filename = 'vimeo_darkforest_wordmark';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Vimeo';
                $tmp_title = 'Link to Vimeo related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_VIMEO_DARKFOREST_WORDMARK_HQ':

                $tmp_filename = 'vimeo_darkforest_wordmark_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Vimeo';
                $tmp_title = 'Link to Vimeo related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_W3C':

                $tmp_filename = 'w3c';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'W3C';
                $tmp_title = 'Link to W3C related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_W3C_HQ':

                $tmp_filename = 'w3c_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'W3C';
                $tmp_title = 'Link to W3C related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_WIKIPEDIA':

                $tmp_filename = 'wikipedia';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Wikipedia';
                $tmp_title = 'Link to Wikipedia related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_WIKIPEDIA_HQ':

                $tmp_filename = 'wikipedia_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Wikipedia';
                $tmp_title = 'Link to Wikipedia related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_WWW':

                $tmp_filename = 'www';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'Website link.';
                $tmp_title = 'Link to website.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_WWW_HQ':

                $tmp_filename = 'www_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'Website link.';
                $tmp_title = 'Link to website.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_XHAMSTER_ICON':

                $tmp_filename = 'xhamster_icon';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'XHAMSTER';
                $tmp_title = 'Link to XHAMSTER related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_XHAMSTER_ICON_HQ':

                $tmp_filename = 'xhamster_icon_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'XHAMSTER';
                $tmp_title = 'Link to XHAMSTER related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_XHAMSTER_WORDMARK':

                $tmp_filename = 'xhamster_wordmark';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'XHAMSTER';
                $tmp_title = 'Link to XHAMSTER related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_XHAMSTER_WORDMARK_HQ':

                $tmp_filename = 'xhamster_wordmark_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'XHAMSTER';
                $tmp_title = 'Link to XHAMSTER related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_XNXX':

                $tmp_filename = 'xnxx';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'XNXX.COM';
                $tmp_title = 'Link to XNXX.COM related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_XNXX_HQ':

                $tmp_filename = 'xnxx_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'XNXX.COM';
                $tmp_title = 'Link to XNXX.COM related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_XVIDEOS':

                $tmp_filename = 'xvideos';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'XVIDEOS';
                $tmp_title = 'Link to XVIDEOS related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_XVIDEOS_HQ':

                $tmp_filename = 'xvideos_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'XVIDEOS';
                $tmp_title = 'Link to XVIDEOS related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_YOUTUBE':

                $tmp_filename = 'youtube';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt = 'YouTube';
                $tmp_title = 'Link to YouTube channel.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOCIAL_YOUTUBE_HQ':

                $tmp_filename = 'youtube_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt = 'YouTube';
                $tmp_title = 'Link to YouTube channel.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            default:

                //
                // ALLOW ARRAY DATA TYPE RETURN TO BE INDICATION OF SUCCESS.
                return false;
                $tmp_filename = $asset_data_key;
                $tmp_width = '';
                $tmp_height = '';
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;
                //error_log(__LINE__ . ' asset mgr CASE DEFAULT DATA $asset_data_key[' . $asset_data_key . ']. $tmp_asset_family[' . $tmp_asset_family . '].');

            break;

        }

        //
        // AUGMENT DOCUMENTATION WITH ASSET META.
        if($output_mode == CRNRSTN_RESOURCE_DOCUMENTATION){

            $tmp_ARRAY[$asset_data_key]['alt'] = $tmp_alt;
            $tmp_ARRAY[$asset_data_key]['title'] = $tmp_title;

            return $tmp_ARRAY;

        }

        if($output_mode == CRNRSTN_FILE_MANAGEMENT){

            if(isset($tmp_filename)){

                $tmp_ARRAY['asset_data_key'] = $asset_data_key;
                $tmp_ARRAY['asset_family'] = $tmp_asset_family;
                $tmp_ARRAY['filename'] = $tmp_filename;
                $tmp_ARRAY['width'] = $tmp_width;
                $tmp_ARRAY['height'] = $tmp_height;
                $tmp_ARRAY['alt'] = $tmp_alt;
                $tmp_ARRAY['title'] = $tmp_title;
                $tmp_ARRAY['hyperlink'] = $tmp_link;
                $tmp_ARRAY['target'] = $tmp_target;
                $tmp_ARRAY['raw_output_mode'] = $tmp_raw_output_mode;
                // SET ABOVE. $tmp_ARRAY['output_mode_method_src'] =

                return $tmp_ARRAY;

            }

        }

        return false;

    }

    //
    // TIDY TIDY ON Monday May 1, 2023 1833 hrs
    private function asset_data_meta_meta($asset_data_key, $asset_family = NULL, $width_override = NULL, $height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $path = NULL, $output_mode = CRNRSTN_FILE_MANAGEMENT){

        $tmp_ARRAY = array();
        $tmp_ARRAY['output_mode_method_src'] = $output_mode;
        $tmp_filename = $tmp_width = $tmp_height = $tmp_alt = $tmp_title = $tmp_link = $tmp_target = $tmp_asset_family = $tmp_raw_output_mode = '';

        switch($asset_data_key){

            //
            // START <META> RESOURCES META.
            // *************
            case 'ADD_COOKIE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'add_cookie';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'ADD_RAW_COOKIE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'add_raw_cookie';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'ADD_SYSTEM_RESOURCE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'add_resource';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'BETTER_SCANDIR_SOCIAL_META_PREVIEW':

                $tmp_filename = 'better_scandir';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'BIT_STRINGIN_SOCIAL_META_PREVIEW':

                $tmp_filename = 'bit_stringin';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'BIT_STRINGOUT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'bit_stringout';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CATCH_EXCEPTION_SOCIAL_META_PREVIEW':

                $tmp_filename = 'catch_exception';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CLEAR_ALL_BITS_SET_ONE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'clear_all_bits_set_one';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CONFIG_ADD_DATABASE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_add_database';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CONFIG_ADD_ENVIRONMENT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_add_environment';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CONFIG_ADD_SEO_ANALYTICS_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_add_seo_analytics';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CONFIG_ADD_SEO_ENGAGEMENT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_add_seo_engagement';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CONFIG_ADD_SYSTEM_RESOURCE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_add_resource';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CONFIG_DENY_ACCESS_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_deny_access';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CONFIG_DETECT_ENVIRONMENT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_detect_environment';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CONFIG_INCLUDE_ENCRYPTION_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_include_encryption';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CONFIG_INCLUDE_SEO_ANALYTICS_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_include_seo_analytics';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CONFIG_INCLUDE_SEO_ENGAGEMENT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_include_seo_engagement';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CONFIG_INCLUDE_SOCIAL_MEDIA_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_include_social_media';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CONFIG_INCLUDE_SQL_SILO_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_include_sql_silo';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CONFIG_INCLUDE_SYSTEM_RESOURCES_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_include_system_resources';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CONFIG_INCLUDE_WORDPRESS_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_include_wordpress';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CONFIG_INI_SET_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_ini_set';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CONFIG_INIT_ASSET_MAPPING_CSS_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_init_asset_map_css';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CONFIG_INIT_ASSET_MAPPING_FAVICON_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_init_asset_map_favicon';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CONFIG_INIT_ASSET_MAPPING_JS_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_init_asset_map_js';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CONFIG_INIT_ASSET_MAPPING_SOCIAL_IMG_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_init_asset_map_social_img';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CONFIG_INIT_ASSET_MAPPING_SYSTEM_IMG_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_init_asset_map_system_img';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CONFIG_INIT_GET_ENCRYPTION_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_init_get_encryption';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CONFIG_INIT_POST_ENCRYPTION_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_init_post_encryption';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CONFIG_INIT_COOKIE_ENCRYPTION_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_init_cookie_encryption';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CONFIG_INIT_DATABASE_ENCRYPTION_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_init_database_encryption';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CONFIG_INIT_HTML_MODE_EMAIL_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_init_html_mode_email';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CONFIG_INIT_HTTP_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_init_http';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CONFIG_INIT_JS_CSS_MINIMIZATION_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_init_js_css_minimization';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CONFIG_INIT_LOGGING_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_init_logging';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CONFIG_INIT_OERSL_ENCRYPTION_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_init_oersl_encryption';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CONFIG_INIT_SESSION_ENCRYPTION_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_init_session_encryption';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CONFIG_INIT_SOAP_ENCRYPTION_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_init_soap_encryption';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CONFIG_INIT_SYSTEM_ASSET_MODE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_init_sys_resp_return_profile';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CONFIG_INIT_TUNNEL_ENCRYPTION_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_init_tunnel_encryption';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CONFIG_LOAD_DEFAULTS_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_load_defaults';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CONFIG_CUSTOM_ERROR_HANDLER_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_custom_error_handler';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CONFIG_SET_TIMEZONE_DEFAULT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_set_timezone_default';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CONFIG_SET_UI_THEME_STYLE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_set_ui_theme_style';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'DATA_DECRYPT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'data_decrypt';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'DATA_ENCRYPT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'data_encrypt';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'DELETE_ALL_COOKIES_SOCIAL_META_PREVIEW':

                $tmp_filename = 'delete_all_cookies';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'DELETE_COOKIE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'delete_cookie';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'DEVICE_TYPE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'device_type';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'DEVICE_TYPE_BIT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'device_type_bit';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'ERROR_LOG_SOCIAL_META_PREVIEW':

                $tmp_filename = 'error_log';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'FORMAT_BYTES_SOCIAL_META_PREVIEW':

                $tmp_filename = 'format_bytes';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'GENERATE_NEW_KEY_SOCIAL_META_PREVIEW':

                $tmp_filename = 'generate_new_key';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'GET_COOKIE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'get_cookie';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'GET_DISK_FREE_SPACE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'get_disk_free_space';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'GET_DISK_PERFORMANCE_METRIC_SOCIAL_META_PREVIEW':

                $tmp_filename = 'get_disk_performance_metric';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'GET_DISK_SIZE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'get_disk_size';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'GET_HEADERS_SOCIAL_META_PREVIEW':

                $tmp_filename = 'get_headers';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'GET_MOBILE_BROWSERS_SOCIAL_META_PREVIEW':

                $tmp_filename = 'get_mobile_browsers';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'GET_MOBILE_DEVICES_SOCIAL_META_PREVIEW':

                $tmp_filename = 'get_mobile_devices';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'GET_MOBILE_OS_SOCIAL_META_PREVIEW':

                $tmp_filename = 'get_mobile_os';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'GET_RESOURCE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'get_resource';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'GET_RESOURCE_COUNT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'get_resource_count';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'GET_TABLET_DEVICES_SOCIAL_META_PREVIEW':

                $tmp_filename = 'get_tablet_devices';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'GET_USER_AGENT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'get_user_agent';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'GRANT_PERMISSIONS_FWRITE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'grant_permissions_fwrite';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'HASH_SOCIAL_META_PREVIEW':

                $tmp_filename = 'hash';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'HEADER_OPTIONS_ADD_SOCIAL_META_PREVIEW':

                $tmp_filename = 'header_options_add';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'HEADER_OPTIONS_APPLY_SOCIAL_META_PREVIEW':

                $tmp_filename = 'header_options_apply';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'HEADER_SIGNATURE_OPTIONS_RETURN_SOCIAL_META_PREVIEW':

                $tmp_filename = 'header_signature_options_return';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'INI_GET_SOCIAL_META_PREVIEW':

                $tmp_filename = 'ini_get';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'INI_SET_SOCIAL_META_PREVIEW':

                $tmp_filename = 'ini_set';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'INITIALIZE_BIT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'initialize_bit';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'INITIALIZE_SERIALIZED_BIT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'initialize_serialized_bit';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'IS_BIT_SET_SOCIAL_META_PREVIEW':

                $tmp_filename = 'is_bit_set';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'IS_CONFIGURED_SOCIAL_META_PREVIEW':

                $tmp_filename = 'is_configured';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'IS_MOBILE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'is_mobile';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'IS_SERIALIZED_BIT_SET_SOCIAL_META_PREVIEW':

                $tmp_filename = 'is_serialized_bit_set';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'IS_SSL_SOCIAL_META_PREVIEW':

                $tmp_filename = 'is_ssl';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'IS_TABLET_SOCIAL_META_PREVIEW':

                $tmp_filename = 'is_tablet';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'ISO_LANGUAGE_HTML_SOCIAL_META_PREVIEW':

                $tmp_filename = 'iso_language_html';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'ISO_LANGUAGE_PROFILE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'iso_language_profile';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'ISO_LANGUAGE_PROFILE_COUNT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'iso_language_profile_count';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'ISSET_DATA_KEY_SOCIAL_META_PREVIEW':

                $tmp_filename = 'isset_data_key';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'ISSET_ENCRYPTION_SOCIAL_META_PREVIEW':

                $tmp_filename = 'isset_encryption';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'OPENSSL_GET_CIPHER_METHODS_SOCIAL_META_PREVIEW':

                $tmp_filename = 'openssl_get_cipher_methods';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'PRINT_R_SOCIAL_META_PREVIEW':

                $tmp_filename = 'print_r';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'PRINT_R_STR_SOCIAL_META_PREVIEW':

                $tmp_filename = 'print_r_str';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'PROPER_VERSION_SOCIAL_META_PREVIEW':

                $tmp_filename = 'proper_version';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'RETURN_DDO_KEY_SOCIAL_META_PREVIEW':

                $tmp_filename = 'return_data_key';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'RETURN_INT_CONST_PROFILE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'return_int_const_profile';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'RETURN_SET_BITS_SOCIAL_META_PREVIEW':

                $tmp_filename = 'return_set_bits';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'RETURN_STICKY_MEDIA_LINK_SOCIAL_META_PREVIEW':

                $tmp_filename = 'return_sticky_media_link';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'RETURN_SYSTEM_IMAGE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'return_system_image';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'RETURN_YOUTUBE_EMBED_SOCIAL_META_PREVIEW':

                $tmp_filename = 'return_youtube_embed';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SALT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'salt';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SERIALIZED_BIT_STRINGIN_SOCIAL_META_PREVIEW':

                $tmp_filename = 'serialized_bit_stringin';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SERIALIZED_BIT_STRINGOUT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'serialized_bit_stringout';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SET_DESKTOP_SOCIAL_META_PREVIEW':

                $tmp_filename = 'set_desktop';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SET_MOBILE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'set_mobile';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SET_TABLET_SOCIAL_META_PREVIEW':

                $tmp_filename = 'set_tablet';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SET_TIMEZONE_DEFAULT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'set_timezone_default';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SET_UI_THEME_STYLE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'set_ui_theme_style';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SOAP_DEFENCODING_SOCIAL_META_PREVIEW':

                $tmp_filename = 'soap_defencoding';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'STRRTRIM_SOCIAL_META_PREVIEW':

                $tmp_filename = 'strrtrim';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SYSTEM_BASE64_SYNCHRONIZE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'system_base64_synchronize';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SYSTEM_HASH_ALGO_SOCIAL_META_PREVIEW':

                $tmp_filename = 'system_hash_algo';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SYSTEM_OUTPUT_FOOTER_HTML_SOCIAL_META_PREVIEW':

                $tmp_filename = 'system_output_footer_html';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'SYSTEM_OUTPUT_HEAD_HTML_SOCIAL_META_PREVIEW':

                $tmp_filename = 'system_output_head_html';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'TOGGLE_BIT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'toggle_bit';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'TOGGLE_SERIALIZED_BIT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'toggle_serialized_bit';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'VAR_DUMP_SOCIAL_META_PREVIEW':

                $tmp_filename = 'var_dump';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'VERSION_APACHE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'version_apache';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'VERSION_CRNRSTN_SOCIAL_META_PREVIEW':

                $tmp_filename = 'version_crnrstn';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'VERSION_LINUX_SOCIAL_META_PREVIEW':

                $tmp_filename = 'version_linux';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'VERSION_MOBILE_DETECT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'version_mobile_detect';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'VERSION_MYSQLI_SOCIAL_META_PREVIEW':

                $tmp_filename = 'version_mysqli';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'VERSION_OPENSSL_SOCIAL_META_PREVIEW':

                $tmp_filename = 'version_openssl';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'VERSION_PHP_SOCIAL_META_PREVIEW':

                $tmp_filename = 'version_php';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'VERSION_SOAP_SOCIAL_META_PREVIEW':

                $tmp_filename = 'version_soap';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            default:

                //
                // ALLOW ARRAY DATA TYPE RETURN TO BE INDICATION OF SUCCESS.
                return false;
                $tmp_filename = $asset_data_key;
                $tmp_width = '';
                $tmp_height = '';
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                $tmp_raw_output_mode = CRNRSTN_IMG;
                //error_log(__LINE__ . ' asset mgr CASE DEFAULT DATA $asset_data_key[' . $asset_data_key . ']. $tmp_asset_family[' . $tmp_asset_family . '].');

            break;

        }

        //
        // AUGMENT DOCUMENTATION WITH ASSET META.
        if($output_mode == CRNRSTN_RESOURCE_DOCUMENTATION){

            $tmp_ARRAY[$asset_data_key]['alt'] = $tmp_alt;
            $tmp_ARRAY[$asset_data_key]['title'] = $tmp_title;

            return $tmp_ARRAY;

        }

        if($output_mode == CRNRSTN_FILE_MANAGEMENT){

            if(isset($tmp_filename)){

                $tmp_ARRAY['asset_data_key'] = $asset_data_key;
                $tmp_ARRAY['asset_family'] = $tmp_asset_family;
                $tmp_ARRAY['filename'] = $tmp_filename;
                $tmp_ARRAY['width'] = $tmp_width;
                $tmp_ARRAY['height'] = $tmp_height;
                $tmp_ARRAY['alt'] = $tmp_alt;
                $tmp_ARRAY['title'] = $tmp_title;
                $tmp_ARRAY['hyperlink'] = $tmp_link;
                $tmp_ARRAY['target'] = $tmp_target;
                $tmp_ARRAY['raw_output_mode'] = $tmp_raw_output_mode;
                // SET ABOVE. $tmp_ARRAY['output_mode_method_src'] =

                return $tmp_ARRAY;

            }

        }

        return false;

    }

    //
    // TIDY TIDY ON Monday May 1, 2023 1833 hrs
    private function asset_data_meta_favicon($asset_data_key, $asset_family = NULL, $width_override = NULL, $height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $path = NULL, $output_mode = CRNRSTN_FILE_MANAGEMENT){

        $tmp_ARRAY = array();
        $tmp_ARRAY['output_mode_method_src'] = $output_mode;
        $tmp_filename = $tmp_width = $tmp_height = $tmp_alt = $tmp_title = $tmp_link = $tmp_target = $tmp_asset_family = $tmp_raw_output_mode = '';

        switch($asset_data_key){

            //
            // START FAVICON RESOURCES META.
            // *************
            case 'BASSDRIVE_FAVICON':

                $tmp_filename = 'bassdrive/favicon';
                $tmp_width = '';
                $tmp_height = '';
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'favicon';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'JONY5_FAVICON':

                $tmp_filename = 'jony5/favicon';
                $tmp_width = '';
                $tmp_height = '';
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'favicon';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            case 'CRNRSTN_FAVICON':

                $tmp_filename = 'crnrstn/favicon';
                $tmp_width = '';
                $tmp_height = '';
                $tmp_alt = '';
                $tmp_title = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'favicon';
                $tmp_raw_output_mode = CRNRSTN_IMG;

            break;
            default:

                //
                // ALLOW ARRAY DATA TYPE RETURN TO BE INDICATION OF SUCCESS.
                return false;
//                $tmp_filename = $asset_data_key;
//                $tmp_width = '';
//                $tmp_height = '';
//                $tmp_alt = '';
//                $tmp_title = '';
//                $tmp_link = '';
//                $tmp_target = '';
//                $tmp_asset_family = 'integrations';
//                $tmp_raw_output_mode = CRNRSTN_IMG;
//                //error_log(__LINE__ . ' asset mgr CASE DEFAULT DATA $asset_data_key[' . $asset_data_key . ']. $tmp_asset_family[' . $tmp_asset_family . '].');

            break;

        }

        //
        // AUGMENT DOCUMENTATION WITH ASSET META.
        if($output_mode == CRNRSTN_RESOURCE_DOCUMENTATION){

            $tmp_ARRAY[$asset_data_key]['alt'] = $tmp_alt;
            $tmp_ARRAY[$asset_data_key]['title'] = $tmp_title;

            return $tmp_ARRAY;

        }

        if($output_mode == CRNRSTN_FILE_MANAGEMENT){

            if(isset($tmp_filename)){

                $tmp_ARRAY['asset_data_key'] = $asset_data_key;
                $tmp_ARRAY['asset_family'] = $tmp_asset_family;
                $tmp_ARRAY['filename'] = $tmp_filename;
                $tmp_ARRAY['width'] = $tmp_width;
                $tmp_ARRAY['height'] = $tmp_height;
                $tmp_ARRAY['alt'] = $tmp_alt;
                $tmp_ARRAY['title'] = $tmp_title;
                $tmp_ARRAY['hyperlink'] = $tmp_link;
                $tmp_ARRAY['target'] = $tmp_target;
                $tmp_ARRAY['raw_output_mode'] = $tmp_raw_output_mode;
                // SET ABOVE. $tmp_ARRAY['output_mode_method_src'] =

                return $tmp_ARRAY;

            }

        }

        return false;

    }

    public function asset_data_meta($asset_data_key, $asset_family = NULL, $width_override = NULL, $height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $path = NULL, $output_mode = CRNRSTN_FILE_MANAGEMENT){

        switch($asset_family){
            case 'favicon':

                return $this->asset_data_meta_favicon($asset_data_key, $asset_family, $width_override, $height_override, $link_override, $alt_override, $title_override, $target_override, $path, $output_mode);

            break;
            case 'integrations':

                return $this->asset_data_meta_integrations($asset_data_key, $asset_family, $width_override, $height_override, $link_override, $alt_override, $title_override, $target_override, $path, $output_mode);

            break;
            case 'social':

                return $this->asset_data_meta_social($asset_data_key, $asset_family, $width_override, $height_override, $link_override, $alt_override, $title_override, $target_override, $path, $output_mode);

            break;
            case 'meta':

                return $this->asset_data_meta_meta($asset_data_key, $asset_family, $width_override, $height_override, $link_override, $alt_override, $title_override, $target_override, $path, $output_mode);

            break;
            case 'system':

                return $this->asset_data_meta_system($asset_data_key, $asset_family, $width_override, $height_override, $link_override, $alt_override, $title_override, $target_override, $path, $output_mode);

            break;
            default:

                error_log(__LINE__ . ' asset mgr CACHE META REQUEST RECEIVED FOR [' . $asset_data_key . ']. $asset_family[' . $asset_family . '].');

                //
                // MUST CHECK ALL FOR METHOD DRIVEN USE CASES.
                $tmp_asset_meta_ARRAY = $this->asset_data_meta_favicon($asset_data_key, $asset_family, $width_override, $height_override, $link_override, $alt_override, $title_override, $target_override, $path, $output_mode);

                if(is_array($tmp_asset_meta_ARRAY)){

                    //error_log(__LINE__ . ' asset mgr CACHE META REQUEST RECEIVED FOR [' . $asset_data_key . ']. $tmp_asset_meta_ARRAY[' . print_r($tmp_asset_meta_ARRAY, true) . ']. die');
                    return $tmp_asset_meta_ARRAY;

                }

                $tmp_asset_meta_ARRAY = $this->asset_data_meta_system($asset_data_key, $asset_family, $width_override, $height_override, $link_override, $alt_override, $title_override, $target_override, $path, $output_mode);
                if(is_array($tmp_asset_meta_ARRAY)){

                    //error_log(__LINE__ . ' asset mgr CACHE META REQUEST RECEIVED FOR [' . $asset_data_key . ']. $tmp_asset_meta_ARRAY[' . print_r($tmp_asset_meta_ARRAY, true) . ']. die');
                    return $tmp_asset_meta_ARRAY;

                }

                $tmp_asset_meta_ARRAY = $this->asset_data_meta_social($asset_data_key, $asset_family, $width_override, $height_override, $link_override, $alt_override, $title_override, $target_override, $path, $output_mode);
                if(is_array($tmp_asset_meta_ARRAY)){

                    //error_log(__LINE__ . ' asset mgr CACHE META REQUEST RECEIVED FOR [' . $asset_data_key . ']. $tmp_asset_meta_ARRAY[' . print_r($tmp_asset_meta_ARRAY, true) . ']. die');
                    return $tmp_asset_meta_ARRAY;

                }

                $tmp_asset_meta_ARRAY = $this->asset_data_meta_meta($asset_data_key, $asset_family, $width_override, $height_override, $link_override, $alt_override, $title_override, $target_override, $path, $output_mode);
                if(is_array($tmp_asset_meta_ARRAY)){

                    //error_log(__LINE__ . ' asset mgr CACHE META REQUEST RECEIVED FOR [' . $asset_data_key . ']. $tmp_asset_meta_ARRAY[' . print_r($tmp_asset_meta_ARRAY, true) . ']. die');
                    return $tmp_asset_meta_ARRAY;

                }

                $tmp_asset_meta_ARRAY = $this->asset_data_meta_integrations($asset_data_key, $asset_family, $width_override, $height_override, $link_override, $alt_override, $title_override, $target_override, $path, $output_mode);
                if(is_array($tmp_asset_meta_ARRAY)){

                    //error_log(__LINE__ . ' asset mgr CACHE META REQUEST RECEIVED FOR [' . $asset_data_key . ']. $tmp_asset_meta_ARRAY[' . print_r($tmp_asset_meta_ARRAY, true) . ']. die');
                    return $tmp_asset_meta_ARRAY;

                }

            break;

        }

//        error_log(__LINE__ . ' asset mgr RETURN FALSE [' . $asset_data_key . ']. $tmp_asset_meta_ARRAY[' . print_r($tmp_asset_meta_ARRAY, true) . ']. die');
//        die();
        return false;

    }

    public function asset_data($asset_data_key, $width_override = NULL, $height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $output_mode = NULL){

//        error_log(__LINE__ . ' asset mgr $asset_data_key[' . $asset_data_key . ']. $output_mode[' . $output_mode . '].  die();');
//        die();

        $tmp_meta_ARRAY = array();

        switch($asset_data_key){
            case CRNRSTN_JS:
            case CRNRSTN_CSS:

                $tmp_meta_ARRAY['filename'] = $_GET[$this->oCRNRSTN->session_salt()];
                $tmp_meta_ARRAY['raw_output_mode'] = $asset_data_key;

            break;
            default:


                die();
                $tmp_meta_ARRAY = $this->asset_data_meta($asset_data_key, $asset_family, $width_override, $height_override, $link_override, $alt_override, $title_override, $target_override);

                error_log(__LINE__ . ' asset mgr CRNRSTN_STRING $output_mode[' . $output_mode . ']. filename[' . print_r($tmp_meta_ARRAY['filename'], true) . '].');

                if($output_mode == CRNRSTN_STRING){

                    error_log(__LINE__ . ' asset mgr CRNRSTN_STRING filename[' . print_r($this->oCRNRSTN->oCRNRSTN_RRS_MAP->get_cache('filename'), true) . '].');

                    //
                    // A CHEEKY PLACE FOR LINK RETURN OF PLAID ACCELERATION SUPPORTED RUNTIME RESOURCE URLS.
                    $tmp_str = $this->oCRNRSTN->plaid($this->oCRNRSTN->oCRNRSTN_RRS_MAP->get_cache('filename'));
                    error_log(__LINE__ . ' asset mgr CRNRSTN_STRING $tmp_str[' . print_r($tmp_str, true) . '].');

                    if(strlen($tmp_str) > 0){

                        return $tmp_str;

                    }

                }

            break;

        }

        //
        // SYSTEM, SOCIAL, & FAVICON IMAGE $_GET[] RETURN.
        // HOW DOES METHOD DRIVEN IMAGE REQUEST WORK WITH THIS? DEPENDS ON THE OUTPUT_MODE, I GUESS.
        if($output_mode == CRNRSTN_IMG){

            $tmp_meta_ARRAY['filename'] = $_GET[$this->oCRNRSTN->session_salt()];

        }else{

            //
            // INITIALIZE USING THE SYSTEM DEFAULT OUTPUT MODE.
            if(isset($tmp_meta_ARRAY['raw_output_mode'])){

                $tmp_output_mode = $tmp_meta_ARRAY['raw_output_mode'];

            }

        }

        //
        // OUTPUT MODE OVERRIDE? THIS DATA WOULD COME FROM AN ASSET METHOD CALL. NOT HTTP $_GET[] REQUEST.
        if(isset($output_mode)){

            //
            // USE THE PROVIDED OUTPUT MODE.
            $tmp_output_mode = $output_mode;

        }

        if($height_override !== NULL || $height_override == ''){

            $tmp_meta_ARRAY['height'] = $height_override;

        }

        if($link_override !== NULL || $link_override == ''){

            if(($target_override !== NULL) || ($target_override == '')){

                $tmp_meta_ARRAY['target'] = $target_override;

            }

            $tmp_meta_ARRAY['hyperlink'] = $link_override;

        }

        if($alt_override !== NULL || $alt_override == ''){

            $tmp_meta_ARRAY['alt'] = $alt_override;

        }

        if(($title_override !== NULL) || ($title_override == '')){

            $tmp_meta_ARRAY['title'] = $title_override;

        }

        if(($width_override !== NULL) || ($width_override == '')){

            $tmp_meta_ARRAY['width'] = $width_override;

        }

        if(strlen($tmp_meta_ARRAY['filename']) < 1){

            $tmp_meta_ARRAY['filename'] = $asset_data_key;
            $tmp_meta_ARRAY['raw_output_mode'] = $tmp_output_mode;

        }

        /*
        [Sun Apr 16 09:49:25.372896 2023] [:error] [pid 16891] [client 172.16.225.1:58542] 11172 asset mgr RUNTIME RRS MAP CACHE INIT
        $tmp_meta_ARRAY[
            Array\n(\n
                [asset_data_key] => CRNRSTN_LOGO\n
                [asset_family] => system\n
                [filename] => crnrstn_logo_lg\n
                [width] => \n
                [height] => 70\n
                [alt] => CRNRSTN :: v2.00.0000 PRE-ALPHA-DEV (Lightsaber)\n
                [title] => CRNRSTN :: v2.00.0000 PRE-ALPHA-DEV (Lightsaber)\n
                [link] => \n    [target] => \n    [raw_output_mode] => 7217\n
                [output_mode] => 4056\n)\n].

        filename[crnrstn_logo_lg].
        raw_output_mode[7217].
        $tmp_output_mode[7213]. die();

        */
//
//
//        $CRNRSTN_RRS_MAP_REQUEST_INITIALIZATION_OUTPUT = $this->oCRNRSTN->initialize_map_request_serial($tmp_meta_ARRAY, $tmp_output_mode);
//        if(strlen($CRNRSTN_RRS_MAP_REQUEST_INITIALIZATION_OUTPUT) > 0){
//
//            error_log(__LINE__ . ' asset mgr Application Acceleration Response [' . $CRNRSTN_RRS_MAP_REQUEST_INITIALIZATION_OUTPUT . '].');
//            die();
//
//            return $CRNRSTN_RRS_MAP_REQUEST_INITIALIZATION_OUTPUT;
//
//        }

        error_log(__LINE__ . ' asset mgr RUNTIME RRS MAP CACHE INIT $tmp_meta_ARRAY[' . print_r($tmp_meta_ARRAY, true) . ']. filename[' . $tmp_meta_ARRAY['filename'] . ']. raw_output_mode[' . $tmp_meta_ARRAY['raw_output_mode'] . ']. $tmp_output_mode[' . $tmp_output_mode . ']. die();');


        //$tmp_current_return_map_ugc_value = $this->oCRNRSTN->return_response_map_ugc_value('current', 'string_value', $tmp_meta_ARRAY['filename'], $tmp_meta_ARRAY['raw_output_mode'], $tmp_output_mode);
        //$tmp_current_return_map_family = $this->oCRNRSTN->return_crnrstn_asset_family();

//        if(strlen($tmp_current_return_map_family) < 1){
//            switch($tmp_output_mode){
//                case CRNRSTN_FAVICON:
//
//                    $tmp_asset_family = 'system/' . $tmp_meta_ARRAY['asset_family'];
//
//                break;
//                default:
//
//                    $tmp_asset_family = 'system';
//
//                break;
//
//            }
//
//            $this->oCRNRSTN->rrs_map_listener($tmp_meta_ARRAY['filename'], $tmp_meta_ARRAY);
//
//        }

        switch($tmp_meta_ARRAY['raw_output_mode']){
            case CRNRSTN_JS:
            case CRNRSTN_CSS:

                //
                // SOME OF THE BELOW MAY BE NULL ON $_GET DRIVEN RRS MAP CACHE INITIALIZATION USE CASES.
                // SHOULD WE ABORT HERE IF ANY ARE NULL?
                $tmp_response_map_request_ugc_value = $this->oCRNRSTN->oCRNRSTN_RRS_MAP->get_salt_ugc();
                $tmp_response_map_request_family = $this->oCRNRSTN->oCRNRSTN_RRS_MAP->get_cache('request_family', CRNRSTN_AUTHORIZE_RUNTIME);
                $tmp_response_map_asset_meta_path = $this->oCRNRSTN->return_response_map_asset_meta_path();
                $tmp_response_map_asset_meta_key = $this->oCRNRSTN->oCRNRSTN_RRS_MAP->get_cache('asset_meta_key', CRNRSTN_AUTHORIZE_RUNTIME);

                error_log(__LINE__ . ' asset mgr $tmp_response_map_request_ugc_value[' . $tmp_response_map_request_ugc_value . ']. $tmp_response_map_request_family[' . $tmp_response_map_request_family . ']. $tmp_response_map_asset_meta_path[' . $tmp_response_map_asset_meta_path . ']. $tmp_response_map_asset_meta_key[' . $tmp_response_map_asset_meta_key . '].');
                return $this->return_asset_data($tmp_response_map_request_ugc_value, $tmp_response_map_request_family, $tmp_response_map_asset_meta_key, $tmp_response_map_asset_meta_path);

            break;
            default:

                error_log(__LINE__ . ' asset mgr filename[' . $tmp_meta_ARRAY['filename'] . ']. asset_meta_key[' . $this->oCRNRSTN->oCRNRSTN_RRS_MAP->get_cache('asset_meta_key', CRNRSTN_AUTHORIZE_RUNTIME, $tmp_meta_ARRAY['filename']) . '] width[' . $tmp_meta_ARRAY['width'] . ']. height[' . $tmp_meta_ARRAY['height'] . ']. alt[' . $tmp_meta_ARRAY['alt'] . ']. title[' . $tmp_meta_ARRAY['title'] . ']. link[' . $tmp_meta_ARRAY['hyperlink'] . ']. target[' . $tmp_meta_ARRAY['target'] . ']. asset_family[' . $tmp_meta_ARRAY['asset_family'] . ']. $tmp_output_mode[' . $tmp_output_mode . '].');

                return $this->return_image_data($tmp_meta_ARRAY['filename'], $tmp_meta_ARRAY['width'], $tmp_meta_ARRAY['height'], $tmp_meta_ARRAY['alt'], $tmp_meta_ARRAY['title'], $tmp_meta_ARRAY['hyperlink'], $tmp_meta_ARRAY['target'], $this->oCRNRSTN->oCRNRSTN_RRS_MAP->get_cache('asset_family'), $tmp_output_mode);

            break;

        }

    }

    public function process_for_filename($str){

        //
        // TRIM TO 100 CHARS
        return substr($this->normalizeString($str), 0, 100);

    }

    //
    // SOURCE :: https://stackoverflow.com/questions/2021624/string-sanitizer-for-filename
    // COMMENT :: https://stackoverflow.com/a/19018736
    // AUTHOR :: SequenceDigitale.com :: https://stackoverflow.com/users/489281/sequencedigitale-com
    private function normalizeString($str = ''){

        $str = strip_tags($str);
        $str = preg_replace('/[\r\n\t ]+/', ' ', $str);
        $str = preg_replace('/[\"\*\/\:\<\>\?\'\|]+/', ' ', $str);
        $str = strtolower($str);
        $str = html_entity_decode($str, ENT_QUOTES, "utf-8");
        $str = htmlentities($str, ENT_QUOTES, "utf-8");
        $str = preg_replace("/(&)([a-z])([a-z]+;)/i", '$2', $str);
        $str = str_replace(' ', '_', $str);
        $str = rawurlencode($str);
        $str = str_replace('%', '_', $str);

        return $str;

    }

    public function return_html_favicon_head_meta($filepath, $http_path, $dir_path, $removed_segment_count){

        //
        // THIS INTEGRATION STANDS ON TOP OF CRNRSTN :: PLAID.
        $filename = basename($filepath);

        // TODO :: GET THIS ONTO CRNRSTN :: PLAID.
        // AS THIS IS UNTO $_GET[]...IT WILL BE VISIBLE IN THE LINK.
        // http://....com/?crnrstn_0101011=xxxxxxx::CRNRSTN::INTEGRATIONS::{filename}
        // http://....com/?crnrstn_0101011=1023961881c5d9ca8a3ea9398e001e4b343d5eced0928f1c3bf058a7a3642887::favicon.ico&&crnrstn_=420.00.5115.1676024390.0
        //
        // [Mon Jun 05 13:34:43.833281 2023] [:error] [pid 8209] [client 172.16.225.1:62115] 12205 asset mgr [
        // http://172.16.225.139/evifweb.com/?crnrstn_0010111011=917895b16d33ddb5305a9c8ab0bbdb3ff74c64a475cf9d166971579d43a14d31::crnrstn::favicon.ico&crnrstn_=420.00.5115.1676024390.0
        $tmp_crnrstn_integrations_memory_pointer = $this->oCRNRSTN->hash_ddo_memory_pointer('crnrstn::' . strtolower($filename), $filepath);

        $tmp_cache = $this->oCRNRSTN->resource_filecache_version($filepath);
        $tmp_url = '';

        if($this->oCRNRSTN->is_bit_set(CRNRSTN_FAVICON_ASSET_MAPPING) == true){

            $tmp_url = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_crnrstn_integrations_memory_pointer . '&crnrstn_=' . $tmp_cache;

        }else{

            $tmp_url = $http_path . $filename . '?crnrstn_=' . $tmp_cache;

        }

        return '<link rel="shortcut icon" type="image/x-icon" href="' . $tmp_url . '"/>';

    }

    public function return_system_image($system_asset_constant, $width_override = NULL, $height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $output_mode = NULL){

        if(!isset($output_mode)){

            $output_mode = CRNRSTN_IMG;

        }

        //
        // THE TARGET.
        // RAW IMAGE RETURN.
        //error_log(__LINE__ . ' asset mgr IMAGE RETURN request_family[' . $this->oCRNRSTN->oCRNRSTN_RRS_MAP->get_cache('request_family', CRNRSTN_AUTHORIZE_RUNTIME) . '], $height_override[' . $height_override . '] $system_asset_constant[' . $system_asset_constant . ']. $output_mode[' . $this->oCRNRSTN->return_int_const_profile($output_mode, CRNRSTN_STRING) . '].');

        //die();
        $tmp_data = $this->asset_data($system_asset_constant, $width_override, $height_override, $link_override, $alt_override, $title_override, $target_override, $output_mode);

        return $tmp_data;

        //}

//        else{
//
//            //error_log(__LINE__ . ' asset mgr CRNRSTN_STRING return_system_image() METHOD CALL. $system_asset_constant[' . $system_asset_constant . ']. $output_mode[' . $output_mode . ']. $width_override[' . $width_override . ']. $height_override[' . $height_override . ']. $link_override[' . $link_override . ']. $alt_override[' . $alt_override . ']. $title_override[' . $title_override . ']. $target_override[' . $target_override . ']. return_crnrstn_asset_family[' . $this->oCRNRSTN->return_crnrstn_asset_family() . '].');
//            //$this->oCRNRSTN->err(__LINE__ . ' asset mgr');
//
//            if(!isset($output_mode)){
//
//                $output_mode = CRNRSTN_STRING;
//
//            }
//
//            if($this->oCRNRSTN->oCRNRSTN_RRS_MAP->get_cache('request_family') == 'module_key'){
//
//                $output_mode = CRNRSTN_STRING;
//
//            }
////
////            //
////            // LOOK FOR OPPORTUNITY TO INITIALIZE MAP FOR RESPONSE RETURN.
////            $system_asset_constant = $this->oCRNRSTN->return_response_map_ugc_value('current', 'string_value', $system_asset_constant);
////            $this->oCRNRSTN->rrs_map_listener($system_asset_constant);
//
//            //
//            // THE TARGET.
//            // https://jony5.com/?crnrstn_0010111011=x.gif
//            $tmp_data = $this->asset_data($system_asset_constant, $width_override, $height_override, $link_override, $alt_override, $title_override, $target_override, $output_mode);
//            //error_log(__LINE__ . ' asset mgr STRING RETURN return_response_map_ugc_value[' . $this->oCRNRSTN->oCRNRSTN_RRS_MAP->get_salt_ugc() . ']. return_crnrstn_asset_family[' . $this->oCRNRSTN->return_crnrstn_asset_family() . ']. $system_asset_constant[' . $system_asset_constant . ']. $output_mode[' . $output_mode . ']. $tmp_data[' . $tmp_data . '].');
//
//            //$this->oCRNRSTN->reset_asset_request_meta();
//            return $tmp_data;
//
//        }

    }

    public function return_creative($media_element_key, $output_mode_override = NULL, $url_params_ARRAY = NULL, $asset_mode_override = NULL){

        //
        // LOAD RESOURCE META BY KEY.
        $tmp_plaid_meta_ARRAY = $this->oCRNRSTN->cache_meta_ARRAY;

        //error_log(__LINE__ . ' asset mgr $output_mode_override[' . $output_mode_override . ']. $tmp_plaid_meta_ARRAY[' . print_r($tmp_plaid_meta_ARRAY, true) . '].');
        //die();
        /*
        [Mon May 29 01:37:11.585487 2023] [:error] [pid 60394] [client 172.16.225.1:56715] 12281 asset mgr
        $tmp_plaid_meta_ARRAY[Array\n(\n
            [output_mode_method_src] => 4056\n
            [asset_data_key] => PHP_ELLIPSE\n
            [asset_family] => system\n
            [filename] => php_logo\n
            [width] => 65\n
            [height] => 35\n
            [alt] => php v\n
            [title] => php v :: CRNRSTN :: v\n
            [link] => https://www.php.net/\n
            [target] => _blank\n
            [raw_output_mode] => 7211\n
            [source] => return_creative\n

        )\n].

        [Mon Jun 12 05:12:30.141225 2023] [:error] [pid 31939] [client 172.16.225.1:53615] 13151 asset mgr
        $output_mode_override[7219].
        $tmp_plaid_meta_ARRAY[Array\n(\n
            [output_mode_method_src] => 4056\n
            [asset_data_key] => CRNRSTN_LOGO\n
            [asset_family] => system\n    [filename] => crnrstn_logo_lg\n    [width] => \n    [height] => 98\n
            [alt] => CRNRSTN :: v2.00.0000 PRE-ALPHA-DEV (Lightsaber)\n
            [title] => CRNRSTN :: v2.00.0000 PRE-ALPHA-DEV (Lightsaber)\n    [hyperlink] => \n    [target] => \n
            [raw_output_mode] => 7212\n    [source] => return_creative\n)\n].


        */

        //
        // MULTI-CHANNEL INITIALIZATION OF RESOURCE CACHE.
        $this->oCRNRSTN->initialize_cache($tmp_plaid_meta_ARRAY['asset_family'], $tmp_plaid_meta_ARRAY['filename'], $tmp_plaid_meta_ARRAY['asset_data_key']);

        //
        // MULTI-CHANNEL INITIALIZATION OF UGC HERE.
        if(isset($output_mode_override)){

            $this->oCRNRSTN->cache_write('output_mode', $output_mode_override, $tmp_plaid_meta_ARRAY['asset_family'], NULL, $tmp_plaid_meta_ARRAY['filename']);

        }

        //
        // CRNRSTN :: PLAID INTEGRATIONS.
        $CRNRSTN_PLAID_APPLICATION_ACCELERATION_RESPONSE = $this->oCRNRSTN->to_plaid(CRNRSTN_AUTHORIZE_RUNTIME, $tmp_plaid_meta_ARRAY['filename'], $tmp_plaid_meta_ARRAY['asset_family'], $media_element_key, $output_mode_override, __FUNCTION__);
        if(strlen($CRNRSTN_PLAID_APPLICATION_ACCELERATION_RESPONSE) > 0){

            return $CRNRSTN_PLAID_APPLICATION_ACCELERATION_RESPONSE;

        }

        return NULL;

    }

    public function return_js_css_string_output($js_integer_constant, $css_integer_constant, $footer_html_output, $is_dev_mode){

        error_log(__LINE__ . ' asset mgr $js_integer_constant[' . $js_integer_constant . ']. $css_integer_constant[' . $css_integer_constant . ']. $footer_html_output[' . $footer_html_output . ']. $is_dev_mode[' . $is_dev_mode . '].');

        die();
        $this->temp_lock_min_js_flag_to_mode($is_dev_mode);
        $tmp_array_CSS = $this->return_output_CRNRSTN_CSS($css_integer_constant, $footer_html_output, $is_dev_mode);
        $tmp_array_JS = $this->return_output_CRNRSTN_JS($js_integer_constant, $footer_html_output, $is_dev_mode);
        $this->temp_unlock_min_js_flag_to_mode();
        $tmp_output = '';

        //
        // LOAD OUTPUT.
        foreach($tmp_array_CSS as $key => $resource_content){

            $tmp_output .= $resource_content;

        }

        foreach($tmp_array_JS as $key => $resource_content){

            $tmp_output .= $resource_content;

        }

        return $tmp_output;

    }

    public function return_css_string_output($const, $footer_html_output, $is_dev_mode){

        $this->temp_lock_min_js_flag_to_mode($is_dev_mode);
        $tmp_array = $this->return_output_CRNRSTN_CSS($const, $footer_html_output, $is_dev_mode);
        $this->temp_unlock_min_js_flag_to_mode();

        $tmp_output = '';

        //
        // BUILD STRING OUTPUT
        foreach($tmp_array as $key => $resource_content){

            $tmp_output .= $resource_content;

        }

        return $tmp_output;

    }

    public function return_js_string_output($const, $footer_html_output, $is_dev_mode){

        $this->temp_lock_min_js_flag_to_mode($is_dev_mode);
        $tmp_array = $this->return_output_CRNRSTN_JS($const, $footer_html_output, $is_dev_mode);
        $this->temp_unlock_min_js_flag_to_mode();
        $tmp_output = '';

        //
        // BUILD STRING OUTPUT
        foreach($tmp_array as $key => $resource_content){

            $tmp_output .= $resource_content;

        }

        return $tmp_output;

    }

    public function return_file_http_string($url, $output_mode){

        // $tmp_path, $tmp_http, $tmp_map_http, $tmp_output_mode, $asset_mapping_is_active

        if(!$this->oCRNRSTN->runtime_rrs_cache_is_active('return_file_http_string')){

            //error_log(__LINE__ . ' asset mgr RRS MAP $output_mode[' . $output_mode . ']. CACHE BUILD[' . $url . ']: CACHE_METHOD: return_file_http_string. die();');
            //die();
            $this->oCRNRSTN->initialize_response_map_cache('return_file_http_string', $output_mode, $url);

        }

        return $url;

    }

    public function return_image_html_wrapped_image_base64(){

        error_log(__LINE__ . ' asset mgr RRS MAP CACHE RETURN[' . __FUNCTION__ . ']. die();');
        die();
        return true;

    }

    public function return_file_byte_chunked_buffer_output($filepath, $filename, $file_extension = NULL, $output_mode = NULL, $channel = CRNRSTN_AUTHORIZE_RUNTIME){

        error_log(__LINE__ . ' asset mgr $filepath[' . $filepath . ']. $filename[' . $filename . ']. $file_extension[' . $file_extension . ']. $output_mode[' . $output_mode . ']. $channel[' . $channel . '].');

        $tmp_header_options_ARRAY = array();

        $tmp_header_options_ARRAY[] = $this->oCRNRSTN->get_resource('header_response_option_cache_control', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');
        $tmp_header_options_ARRAY[] = $this->oCRNRSTN->get_resource('header_response_option_x_frame_options', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

        $tmp_filename_clean = $this->process_for_filename($filename);

        $tmp_curr_headers_ARRAY = headers_list();
        $tmp_crnrstn_signature_headers_ARRAY = $this->oCRNRSTN->header_signature_options_return();

        //
        // SOURCE :: https://stackoverflow.com/questions/9728269/content-length-and-other-http-headers
        // COMMENT :: https://stackoverflow.com/a/9728576
        // AUTHOR :: Neysor :: https://stackoverflow.com/users/1219121/neysor
        $tmp_filesize = filesize($filepath);
        $tmp_header_options_ARRAY[] = 'Content-Type: ' . mime_content_type($filepath);
        $tmp_header_options_ARRAY[] = 'Content-length: ' . $tmp_filesize;
        if(isset($file_extension)){

            $tmp_header_options_ARRAY[] = 'Content-Disposition: inline; filename="' . $tmp_filename_clean . '.' . $file_extension . '"';

        }

        $tmp_date_lastmod = filemtime($filepath);
        $tmp_date_lastmod = date('D, j M Y G:i:s T', $tmp_date_lastmod);
        $tmp_header_options_ARRAY[] = 'Last-Modified: ' . $tmp_date_lastmod;

        //
        // ENSURE ALL SIGNATURE HEADERS ARE IN PLACE AND CONTINUE
        $this->oCRNRSTN->header_options_add($tmp_curr_headers_ARRAY);
        $this->oCRNRSTN->header_options_add($tmp_crnrstn_signature_headers_ARRAY);
        $this->oCRNRSTN->header_options_add($tmp_header_options_ARRAY);

        $this->oCRNRSTN->header_options_apply();

        //
        // TODO :: PHP RETURNS BYTES READ. DO WE TRACK FOR PLAID REPORTING?
        // $bytes_read =
        $this->readfile_chunked($filepath);

        if(ob_get_level() > 0){ob_flush();}
        flush();
        exit();

    }

    private function return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt, $tmp_title, $tmp_link, $tmp_target, $tmp_asset_family, $tmp_output_mode){

        try{

            $asset_mapping_mode = -1;
            $asset_mapping_is_active = false;
            $tmp_file_extension = 'png';
            $tmp_response_map_request_ugc_value = $this->oCRNRSTN->oCRNRSTN_RRS_MAP->get_salt_ugc();
            $tmp_response_map_request_family = $this->oCRNRSTN->get_cache('request_family', $tmp_filename, CRNRSTN_AUTHORIZE_RUNTIME);

            if(strlen($tmp_response_map_request_family) < 1){

                error_log(__LINE__ . ' asset mgr HELLO WORLD. SOMEONE ALIGN ME PLEASE!! [DEPRECATED].');
                $tmp_response_map_request_family = $tmp_asset_family;

            }

            $tmp_response_map_asset_meta_key = $this->oCRNRSTN->return_response_map_asset_meta_key();

            error_log(__LINE__ . ' asset mgr $tmp_output_mode[' . $tmp_output_mode . ']. $tmp_filename[' . $tmp_filename . ']. $tmp_response_map_request_ugc_value [' . $tmp_response_map_request_ugc_value . ']. $tmp_response_map_request_family[' . $tmp_response_map_request_family . ']. $tmp_response_map_asset_meta_key[' . $tmp_response_map_asset_meta_key . '].');

//            if(!$this->oCRNRSTN->runtime_rrs_cache_is_active('return_image_data')){
//
//                $this->oCRNRSTN->initialize_response_map_cache('return_image_data', $tmp_output_mode, $tmp_filename, $tmp_response_map_request_ugc_value, $file_extension);
//
//            }

//            if(strlen($tmp_response_map_request_family) > 0){
//
//                //error_log(__LINE__ . ' asset mgr UPDATE [' . $tmp_asset_family . '] TO [' . $tmp_response_map_request_family . '].');
//                $tmp_asset_family = $tmp_response_map_request_family;
//
//            }
//
//            //error_log(__LINE__ . ' asset mgr $tmp_response_map_request_family[' . $tmp_response_map_request_family . ']. $tmp_asset_family[' . $tmp_asset_family . ']. $tmp_response_map_asset_meta_key[' . $tmp_response_map_asset_meta_key . ']. $tmp_response_map_request_ugc_value[' . $tmp_response_map_request_ugc_value . '] == $tmp_filename[' . $tmp_filename . ']. $tmp_output_mode[' . $tmp_output_mode . '].');
//
//            if(!isset($tmp_response_map_asset_meta_key)){
//
//                $tmp_response_map_asset_meta_key = $this->oCRNRSTN->asset_meta_key($tmp_asset_family, $tmp_response_map_request_ugc_value);
//                //error_log(__LINE__ . ' asset mgr asset_response_method_key NOT set. $tmp_response_map_request_ugc_value[' . $tmp_response_map_request_ugc_value . ']. $tmp_output_mode[' . $tmp_output_mode . ']. $tmp_response_map_asset_meta_key[' . $tmp_response_map_asset_meta_key . '].');
//
//                $tmp_response_map_request_family = $tmp_asset_family;
//
//            }
//
//            if(strlen($tmp_response_map_asset_meta_key) < 1){
//
//                $tmp_response_map_asset_meta_key = $this->oCRNRSTN->asset_meta_key($tmp_asset_family, $tmp_response_map_request_ugc_value);
//                //error_log(__LINE__ . ' asset mgr $tmp_response_map_asset_meta_key length=0. $tmp_output_mode[' . $tmp_output_mode . ']. $tmp_response_map_asset_meta_key[' . $tmp_response_map_asset_meta_key . '].');
//
//                $tmp_response_map_request_family = $tmp_asset_family;
//
//            }

//            if($tmp_response_map_request_ugc_value != 'crnrstn_logo_social_preview_github_00'){
//
//                //error_log(__LINE__ . ' asset mgr [' . $tmp_response_map_request_ugc_value . ']. $tmp_response_map_request_family['. $tmp_response_map_request_family . ']. $tmp_response_map_asset_meta_key[' . $tmp_response_map_asset_meta_key . ']. die();');
//                die();
//
//            }

            //
            // SOME R&D TESTING :: FAV ICON INTEGRATIONS
            if($tmp_response_map_request_ugc_value == 'favicon.ico' || $tmp_response_map_request_ugc_value == 'favicon' || $tmp_response_map_request_ugc_value == 'CRNRSTN_FAVICON' || $tmp_response_map_request_ugc_value == 'BASSDRIVE_FAVICON' || $tmp_response_map_request_ugc_value == 'JONY5_FAVICON'){

                switch($tmp_response_map_request_family){
                    case 'bassdrive':
                    case 'jony5':
                    case 'crnrstn':
                    default:

                        $tmp_filepath = $this->oCRNRSTN->get_resource('crnrstn_favicon_asset_map_dir_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');

                        $tmp_favicon_root = '';

                        if($tmp_response_map_request_family == 'system'){

                            $tmp_favicon_root = 'crnrstn';

                        }else{

                            $tmp_favicon_root = $tmp_response_map_request_family;


                        }

                        $tmp_filepath .= DIRECTORY_SEPARATOR . 'system' . DIRECTORY_SEPARATOR . $tmp_favicon_root . '/' . $tmp_response_map_request_ugc_value . '.ico';

                        $tmp_cache = $this->oCRNRSTN->resource_filecache_version($tmp_filepath);

                        error_log(__LINE__ . ' asset mgr $tmp_cache[' . $tmp_cache . ']. $tmp_response_map_request_ugc_value[' . $tmp_response_map_request_ugc_value . ']. $tmp_filepath[' . $tmp_filepath . ']. $tmp_response_map_request_family[' . $tmp_response_map_request_family . ']. $tmp_response_map_request_ugc_value[' . $tmp_response_map_request_ugc_value . '].');
                        //die();

                        //$this->oCRNRSTN->reset_asset_request_meta();
                        //error_log(__LINE__ . ' asset mgr return_image_data() FAVICON :: WHY DOES THIS RUN? $tmp_response_map_request_ugc_value[' . $tmp_response_map_request_ugc_value . ']. $tmp_response_map_request_family[' . $tmp_response_map_request_family . ']');
                        //$this->oCRNRSTN->response_map_image_data_initialization($tmp_response_map_request_ugc_value, $tmp_width, $tmp_height, $tmp_alt, $tmp_title, $tmp_link, $tmp_target, $tmp_asset_family, $tmp_output_mode);
                        //error_log(__LINE__ . ' asset mgr removed ".ico" from <link rel="shortcut icon"... string return.');
                        return '<link rel="shortcut icon" type="image/x-icon" href="' . $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_favicon_root . '/' . $tmp_response_map_request_ugc_value . '&crnrstn_=' . $tmp_cache . '"/>';

                    break;

                }

            }

            //$this->output_mode_override = $tmp_output_mode;
            //error_log(__LINE__ . ' asset mgr SAME or DIFFERENT?? UGC_value/value_B[' . $tmp_response_map_request_ugc_value . '/' . $tmp_response_map_request_ugc_value_B . ']. $tmp_output_mode[' . $tmp_output_mode . ']. $tmp_response_map_request_family[' . $tmp_response_map_request_family . ']. $tmp_response_map_asset_meta_key[' . $tmp_response_map_asset_meta_key . '].');
            //die();

            switch($tmp_response_map_request_family){
                case 'integrations':
//
//                    $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_integrations_asset_map_dir_path', 0, 'CRNRSTN::RESOURCE::ASSET_INTEGRATIONS');
//
//                    switch($tmp_response_map_request_ugc_value){
//                        case 'framework/jquery_mobile_1_4_5/images/ajax-loader':
//
//                            $tmp_filename = 'ajax-loader';
//                            $tmp_file_extension = 'gif';
//                            $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/action-black':
//
//                            $tmp_filename = 'action-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/action-white':
//
//                            $tmp_filename = 'action-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/alert-black':
//
//                            $tmp_filename = 'alert-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/alert-white':
//
//                            $tmp_filename = 'alert-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-d-black':
//
//                            $tmp_filename = 'arrow-d-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-d-l-black':
//
//                            $tmp_filename = 'arrow-d-l-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-d-l-white':
//
//                            $tmp_filename = 'arrow-d-l-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-d-r-black':
//
//                            $tmp_filename = 'arrow-d-r-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-d-r-white':
//
//                            $tmp_filename = 'arrow-d-r-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-d-white':
//
//                            $tmp_filename = 'arrow-d-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-l-black':
//
//                            $tmp_filename = 'arrow-l-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-l-white':
//
//                            $tmp_filename = 'arrow-l-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-r-black':
//
//                            $tmp_filename = 'arrow-r-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-r-white':
//
//                            $tmp_filename = 'arrow-r-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-u-black':
//
//                            $tmp_filename = 'arrow-u-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-u-l-black':
//
//                            $tmp_filename = 'arrow-u-l-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-u-l-white':
//
//                            $tmp_filename = 'arrow-u-l-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-u-r-black':
//
//                            $tmp_filename = 'arrow-u-r-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-u-r-white':
//
//                            $tmp_filename = 'arrow-u-r-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-u-white':
//
//                            $tmp_filename = 'arrow-u-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/audio-black':
//
//                            $tmp_filename = 'audio-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/audio-white':
//
//                            $tmp_filename = 'audio-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/back-black':
//
//                            $tmp_filename = 'back-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/back-white':
//
//                            $tmp_filename = 'back-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/bars-black':
//
//                            $tmp_filename = 'bars-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/bars-white':
//
//                            $tmp_filename = 'bars-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/bullets-black':
//
//                            $tmp_filename = 'bullets-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/bullets-white':
//
//                            $tmp_filename = 'bullets-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/calendar-black':
//
//                            $tmp_filename = 'calendar-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/calendar-white':
//
//                            $tmp_filename = 'calendar-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/camera-black':
//
//                            $tmp_filename = 'camera-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/camera-white':
//
//                            $tmp_filename = 'camera-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/carat-d-black':
//
//                            $tmp_filename = 'carat-d-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/carat-d-white':
//
//                            $tmp_filename = 'carat-d-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/carat-l-black':
//
//                            $tmp_filename = 'carat-l-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/carat-l-white':
//
//                            $tmp_filename = 'carat-l-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/carat-r-black':
//
//                            $tmp_filename = 'carat-r-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/carat-r-white':
//
//                            $tmp_filename = 'carat-r-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/carat-u-black':
//
//                            $tmp_filename = 'carat-u-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/carat-u-white':
//
//                            $tmp_filename = 'carat-u-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/check-black':
//
//                            $tmp_filename = 'check-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/check-white':
//
//                            $tmp_filename = 'check-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/clock-black':
//
//                            $tmp_filename = 'clock-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/clock-white':
//
//                            $tmp_filename = 'clock-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/cloud-black':
//
//                            $tmp_filename = 'cloud-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/cloud-white':
//
//                            $tmp_filename = 'cloud-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/comment-black':
//
//                            $tmp_filename = 'comment-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/comment-white':
//
//                            $tmp_filename = 'comment-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/delete-black':
//
//                            $tmp_filename = 'delete-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/delete-white':
//
//                            $tmp_filename = 'delete-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/edit-black':
//
//                            $tmp_filename = 'edit-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/edit-white':
//
//                            $tmp_filename = 'edit-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/eye-black':
//
//                            $tmp_filename = 'eye-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/eye-white':
//
//                            $tmp_filename = 'eye-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/forbidden-black':
//
//                            $tmp_filename = 'forbidden-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/forbidden-white':
//
//                            $tmp_filename = 'forbidden-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/forward-black':
//
//                            $tmp_filename = 'forward-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/forward-white':
//
//                            $tmp_filename = 'forward-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/gear-black':
//
//                            $tmp_filename = 'gear-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/gear-white':
//
//                            $tmp_filename = 'gear-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/grid-black':
//
//                            $tmp_filename = 'grid-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/grid-white':
//
//                            $tmp_filename = 'grid-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/heart-black':
//
//                            $tmp_filename = 'heart-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/heart-white':
//
//                            $tmp_filename = 'heart-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/home-black':
//
//                            $tmp_filename = 'home-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/home-white':
//
//                            $tmp_filename = 'home-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/info-black':
//
//                            $tmp_filename = 'info-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/info-white':
//
//                            $tmp_filename = 'info-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/location-black':
//
//                            $tmp_filename = 'location-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/location-white':
//
//                            $tmp_filename = 'location-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/lock-black':
//
//                            $tmp_filename = 'lock-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/lock-white':
//
//                            $tmp_filename = 'lock-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/mail-black':
//
//                            $tmp_filename = 'mail-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/mail-white':
//
//                            $tmp_filename = 'mail-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/minus-black':
//
//                            $tmp_filename = 'minus-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/minus-white':
//
//                            $tmp_filename = 'minus-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/navigation-black':
//
//                            $tmp_filename = 'navigation-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/navigation-white':
//
//                            $tmp_filename = 'navigation-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/phone-black':
//
//                            $tmp_filename = 'phone-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/phone-white':
//
//                            $tmp_filename = 'phone-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/plus-black':
//
//                            $tmp_filename = 'plus-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/plus-white':
//
//                            $tmp_filename = 'plus-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/power-black':
//
//                            $tmp_filename = 'power-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/power-white':
//
//                            $tmp_filename = 'power-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/recycle-black':
//
//                            $tmp_filename = 'recycle-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/recycle-white':
//
//                            $tmp_filename = 'recycle-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/refresh-black':
//
//                            $tmp_filename = 'refresh-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/refresh-white':
//
//                            $tmp_filename = 'refresh-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/search-black':
//
//                            $tmp_filename = 'search-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/search-white':
//
//                            $tmp_filename = 'search-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/shop-black':
//
//                            $tmp_filename = 'shop-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/shop-white':
//
//                            $tmp_filename = 'shop-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/star-black':
//
//                            $tmp_filename = 'star-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/star-white':
//
//                            $tmp_filename = 'star-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/tag-black':
//
//                            $tmp_filename = 'tag-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/tag-white':
//
//                            $tmp_filename = 'tag-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/user-black':
//
//                            $tmp_filename = 'user-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/user-white':
//
//                            $tmp_filename = 'user-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/video-black':
//
//                            $tmp_filename = 'video-black';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/jquery_mobile_1_4_5/images/icons-png/video-white':
//
//                            $tmp_filename = 'video-white';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobile/1.4.5/images/icons-png';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
//
//                        break;
//                        case 'framework/lightbox/close':
//
//                            $tmp_filename = 'close';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/lightbox.js/2.11.3/images';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . 'close.png';
//
//                        break;
//                        case 'framework/lightbox/loading':
//
//                            $tmp_filename = 'loading';
//                            $tmp_file_extension = 'gif';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/lightbox.js/2.11.3/images';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . 'loading.gif';
//
//                        break;
//                        case 'framework/lightbox/next':
//
//                            $tmp_filename = 'next';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/lightbox.js/2.11.3/images';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . 'next.png';
//
//                        break;
//                        case 'framework/lightbox/prev':
//
//                            $tmp_filename = 'prev';
//                            $tmp_file_extension = 'png';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/lightbox.js/2.11.3/images';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . 'prev.png';
//
//                        break;
//                        case 'framework/lightbox-2.03.3/close':
//
//                            $tmp_filename = 'closelabel';
//                            $tmp_file_extension = 'gif';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/lightbox.js/2.03.3/css/images';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . 'closelabel.gif';
//
//                        break;
//                        case 'framework/lightbox-2.03.3/loading':
//
//                            $tmp_filename = 'loading';
//                            $tmp_file_extension = 'gif';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/lightbox.js/2.03.3/css/images';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . 'loading.gif';
//
//                        break;
//                        case 'framework/lightbox-2.03.3/next':
//
//                            $tmp_filename = 'nextlabel';
//                            $tmp_file_extension = 'gif';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/lightbox.js/2.03.3/css/images';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . 'nextlabel.gif';
//
//                        break;
//                        case 'framework/lightbox-2.03.3/prev':
//
//                            $tmp_filename = 'prevlabel';
//                            $tmp_file_extension = 'gif';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/lightbox.js/2.03.3/css/images';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . 'prevlabel.gif';
//
//                        break;
//                        case 'framework/lightbox-2.03.3/blank':
//
//                            $tmp_filename = 'blank';
//                            $tmp_file_extension = 'gif';
//                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/lightbox.js/2.03.3/css/images';
//                            $tmp_filepath .= DIRECTORY_SEPARATOR . 'blank.gif';
//
//                        break;
//
//                    }
//
//                    if(isset($tmp_filepath)){
//
//                        if(is_file($tmp_filepath)){
//
//                            if(strlen($tmp_filename) < 1){
//
//                                $tmp_filename = $tmp_response_map_request_ugc_value;
//
//                            }
//
//                            //error_log(__LINE__ . ' asset mgr $tmp_filepath[' . $tmp_filepath . ']. $tmp_filename[' . $tmp_filename . ']. $tmp_file_extension[' . $tmp_file_extension . '].');
//
//                            $this->return_file_byte_chunked_buffer_output($tmp_filepath, $tmp_filename, $tmp_file_extension, $tmp_output_mode);
//
//                        }
//
//                    }

                    //error_log(__LINE__ . ' asset mgr [404] asset_request_asset_family[' . $tmp_response_map_request_family . ']. $tmp_filepath[' . $tmp_filepath . ']. $tmp_filename[' . $tmp_filename . '].');
                    return $this->oCRNRSTN->return_server_response_code(404);

                break;
                case 'meta_preview_image':
                case 'system':
                case 'social':
                case 'favicon':

//                    if($tmp_filename == 'favicon.ico'){
//
//                        //
//                        // RETURN FAVICON **REDUNDANT SECTION???**
//                        $tmp_filepath = $this->oCRNRSTN->get_resource('crnrstn_favicon_asset_map_dir_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');
//                        $tmp_filepath .= '/' . $tmp_asset_family . '/' . $tmp_filename;
//                        //error_log(__LINE__ . ' img asset mgr [' . $tmp_filename . '][' . $tmp_asset_family . ']. $tmp_filepath=[' . $tmp_filepath . '].');
//
//                        die();
//                        header("Content-Type: " . mime_content_type($tmp_filepath));
//                        header('Content-Disposition: inline; filename="' . $this->process_for_filename($tmp_filename) . '.ico"');
//
//                        $this->readfile_chunked($tmp_filepath);
//
//                        ob_flush();
//                        flush();
//                        exit();
//
//                    }

                    if(strlen($tmp_filename) < 1){

                        $tmp_filename = $tmp_response_map_request_ugc_value;

                    }

                    //error_log(__LINE__ . ' asset mgr $tmp_filename[' . $tmp_filename . '].');

                    //
                    // $this->system_output_profile_constants = array(CRNRSTN_ASSET_MODE_PNG, CRNRSTN_ASSET_MODE_JPEG, CRNRSTN_ASSET_MODE_BASE64);
                    $tmp_ASSET_MODE = $this->oCRNRSTN->return_set_bits($this->oCRNRSTN->system_output_profile_constants_ARRAY(), true);

                    if(!isset($tmp_ASSET_MODE[0])){

                        $tmp_ASSET_MODE[] = CRNRSTN_ASSET_MODE_BASE64;

                    }

                    $this->default_asset_mode = $tmp_ASSET_MODE[0];

                    //
                    // IMAGE OUT
                    //$this->oCRNRSTN->error_log(__LINE__ . ' asset mgr ASSET[' . $tmp_filename . ']. $asset_output_mode_ARRAY=[' . self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] . ']. tmp_output_mode[' . $tmp_output_mode . ']. asset_family[' . print_r($tmp_response_map_request_family, true) . ']. asset_response_method_key[' . $tmp_response_map_asset_meta_key . ']. $this->default_asset_mode[' . $this->default_asset_mode . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                    /*
                    [TUNNEL_ROUTING] THROUGH OUTPUT
                    case 'CRNRSTN_HTML': http path <img src="xxx">
                    case 'CRNRSTN_IMG_HTTP': http path

                    [OUTPUT_FORMAT]
                    case 'CRNRSTN_HTML':
                    case 'CRNRSTN_IMG': (ob_flush it)
                    case 'CRNRSTN_STRING': naked http path (resolving) or base64
                    case 'CRNRSTN_UI_SOAP_DATA_TUNNEL': proxy email support

                    [OUTPUT_FILE_TYPE]
                    case 'CRNRSTN_BASE64': (png before jpg, so alias of CRNRSTN_BASE64_PNG)
                    case 'CRNRSTN_PNG':
                    case 'CRNRSTN_BASE64_PNG':
                    case 'CRNRSTN_JPEG':
                    case 'CRNRSTN_BASE64_JPEG':
                    case 'CRNRSTN_CSS':          // SOME CSS IS KEYED TO JS DUE TO FILE STORAGE ASSOCIATIONS
                    case 'CRNRSTN_JS':
                    =====
                    case 'CRNRSTN_CSS_MAIN_DESKTOP':
                    case 'CRNRSTN_JS_MAIN':
                    case 'CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1':
                    case 'CRNRSTN_JS_FRAMEWORK_JQUERY':
                    case 'CRNRSTN_JS_FRAMEWORK_JQUERY_UI':
                    case 'CRNRSTN_JS_FRAMEWORK_JQUERY_MOBILE':
                    case 'CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS':
                    case 'CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_PLUS_JQUERY':

                    case 'CRNRSTN_UI_TAG_ANALYTICS':
                    case 'CRNRSTN_UI_TAG_ENGAGEMENT':
                    case 'CRNRSTN_UI_FORM_INTEGRATION_PACKET':
                    case 'CRNRSTN_UI_COOKIE_PREFERENCE':
                    case 'CRNRSTN_UI_COOKIE_YESNO':
                    case 'CRNRSTN_UI_COOKIE_NOTICE':
                    case 'CRNRSTN_UI_INTERACT':

                    */

                    if(($this->oCRNRSTN->is_bit_set(CRNRSTN_ASSET_MAPPING) == true) || $this->output_mode_override == CRNRSTN_ASSET_MAPPING){

                        //
                        // TODO :: THESE BIT CHECKS CAN GO AWAY...WE ASK ABOUT BIT SET ON THE CSS, JS, PNG LEVEL.
                        // TODO :: $asset_mapping_is_active CAN GO AWAY.
                        $asset_mapping_is_active = true;
                        $asset_mapping_mode = CRNRSTN_ASSET_MAPPING;

                        //error_log(__LINE__ . ' asset mgr CRNRSTN_ASSET_MAPPING');
                        //return $this->asset_data($tmp_filename);

                    }

                    if(($this->oCRNRSTN->is_bit_set(CRNRSTN_ASSET_MAPPING_PROXY) == true) || $this->output_mode_override == CRNRSTN_ASSET_MAPPING_PROXY){

                        //
                        // TODO :: THESE BIT CHECKS CAN GO AWAY...WE ASK ABOUT BIT SET ON THE CSS, JS, PNG LEVEL.
                        // TODO :: $asset_mapping_is_active CAN GO AWAY.
                        //error_log(__LINE__ . ' asset mgr CRNRSTN_ASSET_MAPPING_PROXY');
                        $asset_mapping_is_active = true;
                        $asset_mapping_mode = CRNRSTN_ASSET_MAPPING_PROXY;

                       // return $this->asset_data($tmp_filename);

                    }

                    error_log(__LINE__ . ' asset mgr ASSET[' . $tmp_filename . ']. asset_family[' . print_r($tmp_response_map_request_family, true) . ']. asset_response_method_key[' . $tmp_response_map_asset_meta_key . ']. tmp_output_mode[' . $tmp_output_mode . '].');

//                    die();
                    //error_log(__LINE__ . ' asset mgr ASSET[' . $tmp_filename . ']. tmp_output_mode[' . $tmp_output_mode . ']. asset_family[' . print_r($tmp_response_map_request_family, true) . ']. asset_response_method_key[' . $tmp_response_map_asset_meta_key . ']. $this->default_asset_mode[' . $this->default_asset_mode . '].');
                    //if(self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] !== CRNRSTN_IMG){

                    if($tmp_output_mode !== CRNRSTN_IMG){

                        switch($tmp_output_mode){
                            case CRNRSTN_FAVICON:
                            case CRNRSTN_HTML & CRNRSTN_FAVICON:
                            case CRNRSTN_HTML & CRNRSTN_PNG:
                            case CRNRSTN_HTML & CRNRSTN_JPEG:
                            case CRNRSTN_HTML & CRNRSTN_BASE64:
                            case CRNRSTN_HTML & CRNRSTN_ASSET_MODE_JPEG:
                            case CRNRSTN_HTML & CRNRSTN_ASSET_MODE_PNG:
                            case CRNRSTN_HTML & CRNRSTN_ASSET_MODE_BASE64:
                            case CRNRSTN_HTML & CRNRSTN_ASSET_MODE_BASE64 & CRNRSTN_JPEG:
                            case CRNRSTN_HTML & CRNRSTN_BASE64_JPEG:
                            case CRNRSTN_HTML & CRNRSTN_ASSET_MODE_BASE64 & CRNRSTN_PNG:
                            case CRNRSTN_HTML & CRNRSTN_BASE64_PNG:
                            case CRNRSTN_HTML:

                                $this->oCRNRSTN->error_log(__LINE__ . ' asset mgr ASSET[' . $tmp_filename . ']. tmp_output_mode[' . $tmp_output_mode . ']. asset_family[' . print_r($tmp_response_map_request_family, true) . ']. asset_response_method_key[' . $tmp_response_map_asset_meta_key . ']. $this->default_asset_mode[' . $this->default_asset_mode . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                                // error_log(__LINE__ . ' asset mgr ASSET[' . $tmp_filename . ']. tmp_output_mode[' . $tmp_output_mode . ']. asset_family[' . print_r($tmp_response_map_request_family, true) . ']. asset_response_method_key[' . $tmp_response_map_asset_meta_key . ']. $this->default_asset_mode[' . $this->default_asset_mode . '].');
                                return $this->return_image_html_wrapped($tmp_filename, $tmp_width, $tmp_height, $tmp_alt, $tmp_title, $tmp_link, $tmp_target, $tmp_asset_family, $tmp_output_mode, NULL);

                            break;
                            case CRNRSTN_ASSET_MODE_JPEG:

                                switch($tmp_response_map_request_family){
                                    case 'meta_preview_image':

                                        $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_meta_asset_map_dir_path', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');
                                        $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_meta_asset_map_http_path', 0, 'CRNRSTN::RESOURCE::ASSET_PATH'));
                                        $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_response_map_request_ugc_value;

                                    break;
                                    case 'system':

                                        $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_system_asset_map_dir_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');
                                        $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_system_asset_map_http_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH'));
                                        $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_response_map_request_ugc_value;

                                    break;
                                    case 'social':

                                        $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_social_asset_map_dir_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');
                                        $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_social_asset_map_http_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH'));
                                        $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_response_map_request_ugc_value;

                                    break;

                                }

                                //
                                // RETURN IMAGE STRING
                                //$tmp_file_extension = 'jpg';
                                //$tmp_filepath = $this->oCRNRSTN->crnrstn_path_directory() . '/' . $this->oCRNRSTN->crnrstn_root_directory() . '/ui/imgs/jpg/' . $tmp_response_map_request_family . '/' . $tmp_filename . '.' . $tmp_file_extension;
                                //error_log(__LINE__ . ' asset mgr [CRNRSTN_ASSET_MODE_JPEG]. $tmp_filepath[' . $tmp_filename . '].');

                                return $this->return_image_string($tmp_path, $tmp_http, $tmp_map_http, $tmp_output_mode, $asset_mapping_is_active, $tmp_response_map_request_ugc_value, $tmp_response_map_request_family);
                                //return $this->return_image();

                            break;
                            case CRNRSTN_ASSET_MODE_PNG:

                                switch($tmp_response_map_request_family){
                                    case 'meta_preview_image':

                                        $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_meta_asset_map_dir_path', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');
                                        $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_meta_asset_map_http_path', 0, 'CRNRSTN::RESOURCE::ASSET_PATH'));
                                        $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_response_map_request_ugc_value;

                                    break;
                                    case 'system':

                                        $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_system_asset_map_dir_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');
                                        $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_system_asset_map_http_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH'));
                                        $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_response_map_request_ugc_value;

                                    break;
                                    case 'social':

                                        $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_social_asset_map_dir_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');
                                        $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_social_asset_map_http_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH'));
                                        $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_response_map_request_ugc_value;

                                    break;

                                }

                                //$tmp_file_extension = 'png';
                                //$tmp_filepath = $this->oCRNRSTN->crnrstn_path_directory() . '/' . $this->oCRNRSTN->crnrstn_root_directory() .'/ui/imgs/png/' . $tmp_response_map_request_family . '/' . $tmp_filename . '.' . $tmp_file_extension;
                                $this->oCRNRSTN->error_log(' asset mgr [CRNRSTN_ASSET_MODE_PNG]. $tmp_filepath[' . $tmp_filename . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                                return $this->return_image_string($tmp_path, $tmp_http, $tmp_map_http, $tmp_output_mode, $asset_mapping_is_active, $tmp_response_map_request_ugc_value, $tmp_response_map_request_family);
                                //return $this->return_image();

                            break;
                            case CRNRSTN_ASSET_MODE_BASE64:
                            case CRNRSTN_BASE64:

                                //$this->oCRNRSTN->error_log(' asset mgr ASSET[' . $tmp_filename . ']. tmp_output_mode[' . $tmp_output_mode . ']. asset_family[' . print_r($tmp_response_map_request_family, true) . ']. asset_response_method_key[' . $tmp_response_map_asset_meta_key . ']. $this->default_asset_mode[' . $this->default_asset_mode . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                                if($this->oCRNRSTN->is_system_terminate_enabled()){
                                    //$this->oCRNRSTN->error_log(' asset mgr ASSET[' . $tmp_filename . ']. tmp_output_mode[' . $tmp_output_mode . ']. asset_family[' . print_r($tmp_response_map_request_family, true) . ']. asset_response_method_key[' . $tmp_response_map_asset_meta_key . ']. $this->default_asset_mode[' . $this->default_asset_mode . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                                    $tmp_path = CRNRSTN_ROOT;
                                    $tmp_system_directory = '_crnrstn';
                                    self::$image_output_mode = CRNRSTN_BASE64_PNG;

                                    $tmp_filepath_base64 = $tmp_path . DIRECTORY_SEPARATOR . $tmp_system_directory . '/ui/imgs/base64/' . $tmp_response_map_request_family . '/' . $tmp_response_map_request_ugc_value . '.php';

                                    $tmp_file_repair = false;
                                    //
                                    // TODO :: CONSIDER USE OF is_readable() IN THIS PLACE TO POTENTIALLY SAVE A STEP.
                                    if(!is_file($tmp_filepath_base64)){

                                        $this->oCRNRSTN->error_log('Failure opening [' . $tmp_response_map_request_ugc_value . '] for inclusion. Attempting to repair the BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                                        $this->system_base64_synchronize($tmp_response_map_request_ugc_value . '.png');
                                        $tmp_file_repair = true;

                                    }

                                    //
                                    // TRY (POTENTIALLY...AFTER system_base64_synchronize())
                                    if(!@include($tmp_filepath_base64)){

                                        if($tmp_file_repair){

                                            //
                                            // HOOOSTON...VE HAF PROBLEM!
                                            throw new Exception('Failure opening [' . $tmp_filepath_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.');

                                        }else{

                                            $this->oCRNRSTN->error_log('Failure opening [' . $tmp_response_map_request_ugc_value . '] for inclusion. Attempting to repair the BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                                            $this->system_base64_synchronize($tmp_response_map_request_ugc_value . '.png');
                                            $tmp_file_repair = true;

                                        }

                                        if(!@include($tmp_filepath_base64)){

                                            //
                                            // HOOOSTON...VE HAF PROBLEM!
                                            throw new Exception('Failure opening [' . $tmp_filepath_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.');

                                        }else{

                                            //$this->oCRNRSTN->print_r('Repair of asset successfully completed on [' . $tmp_response_map_request_ugc_value . '] within the CRNRSTN :: BASE64 file system.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
                                            $this->oCRNRSTN->error_log('Repair of asset successfully completed on [' . $tmp_response_map_request_ugc_value . '] within the CRNRSTN :: BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                                        }

                                    }

                                }else{

                                    $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_path_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');
                                    $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');
                                    self::$image_output_mode = CRNRSTN_BASE64_PNG;

                                    $tmp_filepath_base64 = $tmp_path . DIRECTORY_SEPARATOR . $tmp_system_directory . '/ui/imgs/base64/' . $tmp_response_map_request_family . '/' . $tmp_response_map_request_ugc_value . '.php';

                                    $tmp_file_repair = false;
                                    //
                                    // TODO :: CONSIDER USE OF is_readable() IN THIS PLACE TO POTENTIALLY SAVE A STEP.
                                    if(!is_file($tmp_filepath_base64)){

                                        $this->oCRNRSTN->error_log('Failure opening [' . $tmp_response_map_request_ugc_value . '] for inclusion. Attempting to repair the BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                                        $this->system_base64_synchronize($tmp_response_map_request_ugc_value . '.png');
                                        $tmp_file_repair = true;

                                    }

                                    //
                                    // TRY (POTENTIALLY...AFTER system_base64_synchronize())
                                    if(!@include($tmp_filepath_base64)){

                                        if($tmp_file_repair){

                                            //
                                            // HOOOSTON...VE HAF PROBLEM!
                                            throw new Exception('Failure opening [' . $tmp_filepath_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.');

                                        }else{

                                            $this->oCRNRSTN->error_log('Failure opening [' . $tmp_response_map_request_ugc_value . '] for inclusion. Attempting to repair the BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                                            $this->system_base64_synchronize($tmp_response_map_request_ugc_value . '.png');
                                            $tmp_file_repair = true;

                                        }

                                        if(!@include($tmp_filepath_base64)){

                                            //
                                            // HOOOSTON...VE HAF PROBLEM!
                                            throw new Exception('Failure opening [' . $tmp_filepath_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.');

                                        }else{

                                            //$this->oCRNRSTN->print_r('Repair of asset successfully completed on [' . $tmp_response_map_request_ugc_value . '] within the CRNRSTN :: BASE64 file system.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
                                            $this->oCRNRSTN->error_log('Repair of asset successfully completed on [' . $tmp_response_map_request_ugc_value . '] within the CRNRSTN :: BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                                        }

                                    }

                                }

                                $tmp_str = '';
                                if(isset($system_file_serial)){

                                    $tmp_str = self::$image_filesystem_meta_ARRAY[self::$image_output_mode][self::$request_salt][$system_file_serial]['base64'];

                                }

                                return $tmp_str;

                            break;
                            case CRNRSTN_STRING:

                                switch($this->default_asset_mode){
                                    case CRNRSTN_ASSET_MODE_JPEG:

                                        switch($tmp_response_map_request_family){
                                            case 'meta_preview_image':

                                                $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_meta_asset_map_dir_path', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');
                                                $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_meta_asset_map_http_path', 0, 'CRNRSTN::RESOURCE::ASSET_PATH'));
                                                $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_response_map_request_ugc_value;

                                            break;
                                            case 'system':

                                                $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_system_asset_map_dir_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');
                                                $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_system_asset_map_http_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH'));
                                                $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_response_map_request_ugc_value;

                                            break;
                                            case 'social':

                                                $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_social_asset_map_dir_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');
                                                $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_social_asset_map_http_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH'));
                                                $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_response_map_request_ugc_value;

                                            break;

                                        }

                                        //
                                        // RETURN IMAGE STRING
                                        //$tmp_file_extension = 'jpg';
                                        //$tmp_filepath = $this->oCRNRSTN->crnrstn_path_directory() . '/' . $this->oCRNRSTN->crnrstn_root_directory() . '/ui/imgs/jpg/' . $tmp_response_map_request_family . '/' . $tmp_filename . '.' . $tmp_file_extension;
                                        //error_log(__LINE__ . ' asset mgr [CRNRSTN_ASSET_MODE_JPEG]. $tmp_filepath[' . $tmp_filename . '].');

                                        return $this->return_image_string($tmp_path, $tmp_http, $tmp_map_http, $tmp_output_mode, $asset_mapping_is_active, $tmp_response_map_request_ugc_value, $tmp_response_map_request_family);
                                        //return $this->return_image();

                                    break;
                                    case CRNRSTN_ASSET_MODE_PNG:

                                        switch($tmp_response_map_request_family){
                                            case 'meta_preview_image':

                                                $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_meta_asset_map_dir_path', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');
                                                $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_meta_asset_map_http_path', 0, 'CRNRSTN::RESOURCE::ASSET_PATH'));
                                                $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_response_map_request_ugc_value;

                                            break;
                                            case 'system':

                                                $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_system_asset_map_dir_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');
                                                $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_system_asset_map_http_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH'));
                                                $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_response_map_request_ugc_value;

                                            break;
                                            case 'social':

                                                $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_social_asset_map_dir_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');
                                                $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_social_asset_map_http_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH'));
                                                $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_response_map_request_ugc_value;

                                            break;

                                        }

                                        //$tmp_file_extension = 'png';
                                        //$tmp_filepath = $this->oCRNRSTN->crnrstn_path_directory() . '/' . $this->oCRNRSTN->crnrstn_root_directory() .'/ui/imgs/png/' . $tmp_response_map_request_family . '/' . $tmp_filename . '.' . $tmp_file_extension;
                                        $this->oCRNRSTN->error_log(' asset mgr return_image_string [CRNRSTN_ASSET_MODE_PNG]. $tmp_filepath[' . $tmp_filename . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
                                        //error_log(__LINE__ . ' asset mgr [CRNRSTN_ASSET_MODE_PNG]. $tmp_map_http[' . $tmp_map_http . ']. $tmp_path[' . $tmp_path . '].');

                                        //die();
                                        return $this->return_image_string($tmp_path, $tmp_http, $tmp_map_http, $tmp_output_mode, $asset_mapping_is_active, $tmp_response_map_request_ugc_value, $tmp_response_map_request_family);
                                        //return $this->return_image();

                                    break;
                                    case CRNRSTN_ASSET_MODE_BASE64:
                                    case CRNRSTN_BASE64:

                                        //$this->oCRNRSTN->error_log(' asset mgr ASSET[' . $tmp_filename . ']. tmp_output_mode[' . $tmp_output_mode . ']. asset_family[' . print_r($tmp_response_map_request_family, true) . ']. asset_response_method_key[' . $tmp_response_map_asset_meta_key . ']. $this->default_asset_mode[' . $this->default_asset_mode . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                                        if($this->oCRNRSTN->is_system_terminate_enabled()){
                                            //$this->oCRNRSTN->error_log(' asset mgr ASSET[' . $tmp_filename . ']. tmp_output_mode[' . $tmp_output_mode . ']. asset_family[' . print_r($tmp_response_map_request_family, true) . ']. asset_response_method_key[' . $tmp_response_map_asset_meta_key . ']. $this->default_asset_mode[' . $this->default_asset_mode . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                                            $tmp_path = CRNRSTN_ROOT;
                                            $tmp_system_directory = '_crnrstn';
                                            self::$image_output_mode = CRNRSTN_BASE64_PNG;

                                            $tmp_filepath_base64 = $tmp_path . DIRECTORY_SEPARATOR . $tmp_system_directory . '/ui/imgs/base64/' . $tmp_response_map_request_family . '/' . $tmp_response_map_request_ugc_value . '.php';

                                            $tmp_file_repair = false;
                                            //
                                            // TODO :: CONSIDER USE OF is_readable() IN THIS PLACE TO POTENTIALLY SAVE A STEP.
                                            // Wednesday, November 15, 2023 @ 1333 hrs.
                                            if(!is_file($tmp_filepath_base64)){

                                                $this->oCRNRSTN->error_log('Failure opening [' . $tmp_response_map_request_ugc_value . '] for inclusion. Attempting to repair the BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                                                $this->system_base64_synchronize($tmp_response_map_request_ugc_value . '.png');
                                                $tmp_file_repair = true;

                                            }

                                            //
                                            // TRY (POTENTIALLY...AFTER system_base64_synchronize())
                                            if(!@include($tmp_filepath_base64)){

                                                if($tmp_file_repair){

                                                    //
                                                    // HOOOSTON...VE HAF PROBLEM!
                                                    throw new Exception('Failure opening [' . $tmp_filepath_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.');

                                                }else{

                                                    $this->oCRNRSTN->error_log('Failure opening [' . $tmp_response_map_request_ugc_value . '] for inclusion. Attempting to repair the BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                                                    $this->system_base64_synchronize($tmp_response_map_request_ugc_value . '.png');
                                                    $tmp_file_repair = true;

                                                }

                                                if(!@include($tmp_filepath_base64)){

                                                    //
                                                    // HOOOSTON...VE HAF PROBLEM!
                                                    throw new Exception('Failure opening [' . $tmp_filepath_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.');

                                                }else{

                                                    //$this->oCRNRSTN->print_r('Repair of asset successfully completed on [' . $tmp_response_map_request_ugc_value . '] within the CRNRSTN :: BASE64 file system.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
                                                    $this->oCRNRSTN->error_log('Repair of asset successfully completed on [' . $tmp_response_map_request_ugc_value . '] within the CRNRSTN :: BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                                                }

                                            }

                                        }else{

                                            $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_path_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');
                                            $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');
                                            self::$image_output_mode = CRNRSTN_BASE64_PNG;

                                            $tmp_filepath_base64 = $tmp_path . DIRECTORY_SEPARATOR . $tmp_system_directory . '/ui/imgs/base64/' . $tmp_response_map_request_family . '/' . $tmp_response_map_request_ugc_value . '.php';

                                            $tmp_file_repair = false;
                                            //
                                            // TODO :: CONSIDER USE OF is_readable() IN THIS PLACE TO POTENTIALLY SAVE A STEP.
                                            // Wednesday, November 15, 2023 @ 1334 hrs.
                                            if(!is_file($tmp_filepath_base64)){

                                                $this->oCRNRSTN->error_log('Failure opening [' . $tmp_response_map_request_ugc_value . '] for inclusion. Attempting to repair the BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                                                $this->system_base64_synchronize($tmp_response_map_request_ugc_value . '.png');
                                                $tmp_file_repair = true;

                                            }

                                            //
                                            // TRY (POTENTIALLY...AFTER system_base64_synchronize())
                                            if(!@include($tmp_filepath_base64)){

                                                if($tmp_file_repair){

                                                    //
                                                    // HOOOSTON...VE HAF PROBLEM!
                                                    throw new Exception('Failure opening [' . $tmp_filepath_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.');

                                                }else{

                                                    $this->oCRNRSTN->error_log('Failure opening [' . $tmp_response_map_request_ugc_value . '] for inclusion. Attempting to repair the BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                                                    $this->system_base64_synchronize($tmp_response_map_request_ugc_value . '.png');
                                                    $tmp_file_repair = true;

                                                }

                                                if(!@include($tmp_filepath_base64)){

                                                    //
                                                    // HOOOSTON...VE HAF PROBLEM!
                                                    throw new Exception('Failure opening [' . $tmp_filepath_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.');

                                                }else{

                                                    //$this->oCRNRSTN->print_r('Repair of asset successfully completed on [' . $tmp_response_map_request_ugc_value . '] within the CRNRSTN :: BASE64 file system.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
                                                    $this->oCRNRSTN->error_log('Repair of asset successfully completed on [' . $tmp_response_map_request_ugc_value . '] within the CRNRSTN :: BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                                                }

                                            }

                                        }

                                        $tmp_str = '';
                                        if(isset($system_file_serial)){

                                            $tmp_str = self::$image_filesystem_meta_ARRAY[self::$image_output_mode][self::$request_salt][$system_file_serial]['base64'];

                                        }

                                        $this->oCRNRSTN->error_log(' asset mgr [CRNRSTN_ASSET_MODE_BASE64|CRNRSTN_BASE64]. $tmp_str[' . $tmp_str . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
                                        //error_log(__LINE__ . ' asset mgr [CRNRSTN_ASSET_MODE_BASE64|CRNRSTN_BASE64]. $tmp_str[' . $tmp_str . '].');

                                    return $tmp_str;

                                    break;

                                }

                                //error_log(__LINE__ . ' asset mgr STRING OUTPUT HERE. [' . $this->oCRNRSTN->return_constant_profile_ARRAY($this->default_asset_mode, CRNRSTN_STRING) . '] die();');
                                //die();

                            break;
                            default:

                                switch($tmp_response_map_request_family){
                                    case 'meta_preview_image':

                                        $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_meta_asset_map_dir_path', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');
                                        $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_meta_asset_map_http_path', 0, 'CRNRSTN::RESOURCE::ASSET_PATH'));
                                        $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');

                                        $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_response_map_request_ugc_value;
                                        $tmp_http .= $tmp_system_directory . '/ui/imgs/meta/';

                                    break;
                                    case 'system':

                                        $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_system_asset_map_dir_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');
                                        $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_system_asset_map_http_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH'));
                                        $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');

                                        $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_response_map_request_ugc_value;
                                        $tmp_http .= $tmp_system_directory . '/ui/imgs/' . $tmp_response_map_request_family;

                                    break;
                                    case 'social':

                                        $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_social_asset_map_dir_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');
                                        $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_social_asset_map_http_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH'));
                                        $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');
                                        $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_response_map_request_ugc_value;

                                        $tmp_http .= $tmp_system_directory . '/ui/imgs/' . $tmp_response_map_request_family;

                                    break;
                                    case 'favicon':

                                        $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_favicon_asset_map_dir_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');
                                        $tmp_path .= DIRECTORY_SEPARATOR . 'system';
                                        $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_favicon_asset_map_http_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH'));
                                        $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');
                                        $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_response_map_request_ugc_value;

                                        $tmp_http .= $tmp_system_directory . '/ui/imgs/' . $tmp_response_map_request_family;

                                    break;

                                }

                                //error_log(__LINE__ . ' asset mgr DEFAULT SWITCH HIT. $this->default_asset_mode[' . $this->default_asset_mode . ']. [' . $tmp_filename . ']. [' . $tmp_output_mode . ']. [' . self::$asset_output_mode_ARRAY[$tmp_response_map_request_family][$tmp_filename] . '].');

                                //error_log(__LINE__ . ' asset mgr DEFAULT SWITCH HIT. $tmp_path[' . $tmp_path . ']. $tmp_response_map_request_family[' . $tmp_response_map_request_family . ']. $tmp_http[' . $tmp_http . ']. $tmp_map_http[' . $tmp_map_http . ']. $tmp_output_mode[' . $tmp_output_mode . ']. $asset_mapping_is_active['.$asset_mapping_is_active.'].');

                                //die();

                                return $this->return_image_string($tmp_path, $tmp_http, $tmp_map_http, $tmp_output_mode, $asset_mapping_is_active, $tmp_response_map_request_ugc_value, $tmp_response_map_request_family);

                            break;

                        }

                    }

                    //error_log(__LINE__ . ' asset mgr return_response_map_asset_meta_path[' . $this->oCRNRSTN->return_response_map_asset_meta_path() . ']. $tmp_filename[' . $tmp_filename . ']. $tmp_response_map_request_family[' . $tmp_response_map_request_family . ']. $tmp_response_map_request_family[' . $tmp_response_map_request_family . '].');
                    switch($tmp_response_map_request_family){
                        case 'favicon':

                            $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_system_asset_map_dir_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');
                            $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_system_asset_map_http_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH'));
                            $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');
                            $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_response_map_request_ugc_value;

                            $tmp_http .= $tmp_system_directory . '/ui/imgs/' . $tmp_response_map_asset_meta_key;
                            //error_log(__LINE__ . ' asset mgr $tmp_response_map_request_family[' . $tmp_response_map_request_family . '].');
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'favicon' . DIRECTORY_SEPARATOR . $this->oCRNRSTN->return_response_map_asset_meta_path();
                            //error_log(__LINE__ . ' asset mgr return_response_map_asset_meta_path[' . $this->oCRNRSTN->return_response_map_asset_meta_path() . ']. $tmp_filename[' . $tmp_filename . ']. $tmp_response_map_request_family[' . $tmp_response_map_request_family . '].');

                            $tmp_filename = 'favicon';
                            $tmp_file_extension = 'ico';
                            $tmp_output_mode = CRNRSTN_FAVICON_ASSET_MAPPING;

                        break;
                        case 'meta_preview_image':

                            $tmp_response_map_request_family = 'meta';  // TRANSITION TO ACTUAL FOLDER NAME.

                            $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_meta_asset_map_dir_path', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');
                            $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_meta_asset_map_http_path', 0, 'CRNRSTN::RESOURCE::ASSET_PATH'));
                            $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');
                            $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_response_map_request_ugc_value;

                            $tmp_http .= $tmp_system_directory . '/ui/imgs/meta/';

                        break;
                        case 'system':

                            $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_system_asset_map_dir_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');
                            $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_system_asset_map_http_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH'));
                            $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');
                            $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_response_map_request_ugc_value;

                            $tmp_http .= $tmp_system_directory . '/ui/imgs/' . $tmp_response_map_request_family;

                        break;
                        case 'social':

                            $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_social_asset_map_dir_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');
                            $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_social_asset_map_http_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH'));
                            $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');
                            $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_response_map_request_ugc_value;

                            $tmp_http .= $tmp_system_directory . '/ui/imgs/' . $tmp_response_map_request_family;

                        break;

                    }

                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_ASSET_MODE_JPEG) == true){

                        $tmp_file_extension = 'jpg';

                    }

                    $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');

                    if($tmp_response_map_request_family == 'meta'){

                        $tmp_filepath = $this->oCRNRSTN->crnrstn_path_directory() . DIRECTORY_SEPARATOR . $tmp_system_directory . '/ui/imgs/' . $tmp_file_extension . DIRECTORY_SEPARATOR . $this->oCRNRSTN->crnrstn_request_ugc_val . '.' . $tmp_file_extension;

                    }else{

                        if($tmp_response_map_request_family !== 'favicon'){

                            $tmp_filepath = $this->oCRNRSTN->crnrstn_path_directory() . DIRECTORY_SEPARATOR . $tmp_system_directory . '/ui/imgs/' . $tmp_file_extension . DIRECTORY_SEPARATOR . $tmp_response_map_request_family . DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        }

                    }

                    //$tmp_filepath = $tmp_path . '/' . $tmp_response_map_request_family;
                    error_log(__LINE__ . ' asset mgr $tmp_filepath[' . $tmp_filepath . ']. $tmp_filename[' . $tmp_filename . ']. $tmp_file_extension[' . $tmp_file_extension . ']. $tmp_output_mode[' . $tmp_output_mode . ']. die();');

                    if(isset($tmp_filepath)){

                        //
                        // TODO :: CONSIDER USE OF is_readable() IN THIS PLACE TO POTENTIALLY SAVE A STEP.
                        // Wednesday, November 15, 2023 @ 1334 hrs.
                        if(is_file($tmp_filepath)){

                            $this->return_file_byte_chunked_buffer_output($tmp_filepath, $tmp_filename, $tmp_file_extension, $tmp_output_mode);

                        }
//
//                        if(is_file($tmp_filepath)){
//
//                            $tmp_header_options_ARRAY = array();
//
//                            $tmp_header_options_ARRAY[] = $this->oCRNRSTN->get_resource('header_response_option_cache_control', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');
//                            $tmp_header_options_ARRAY[] = $this->oCRNRSTN->get_resource('header_response_option_x_frame_options', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');
//
//                            $tmp_filename_clean = $this->process_for_filename($tmp_filename);
//
//                            $tmp_curr_headers_ARRAY = headers_list();
//                            $tmp_crnrstn_signature_headers_ARRAY = $this->oCRNRSTN->header_signature_options_return();
//
//                            //
//                            // SOURCE :: https://stackoverflow.com/questions/9728269/content-length-and-other-http-headers
//                            // COMMENT :: https://stackoverflow.com/a/9728576
//                            // AUTHOR :: Neysor :: https://stackoverflow.com/users/1219121/neysor
//                            $tmp_filesize = filesize($tmp_filepath);
//                            $tmp_header_options_ARRAY[] = 'Content-Type: ' . mime_content_type($tmp_filepath);
//                            $tmp_header_options_ARRAY[] = 'Content-length: ' . $tmp_filesize;
//                            $tmp_header_options_ARRAY[] = 'Content-Disposition: inline; filename="' . $tmp_filename_clean . '.' . $tmp_file_extension . '"';
//
//                            $tmp_date_lastmod = filemtime($tmp_filepath);
//                            $tmp_date_lastmod = date('D, j M Y G:i:s T', $tmp_date_lastmod);
//                            $tmp_header_options_ARRAY[] = 'Last-Modified: ' . $tmp_date_lastmod;
//
//                            // header_options_add
//                            // header_options_apply
//                            // header_signature_options_return
//                            // ENSURE ALL SIGNATURE HEADERS ARE IN PLACE AND CONTINUE
//                            $this->oCRNRSTN->header_options_add($tmp_curr_headers_ARRAY);
//                            $this->oCRNRSTN->header_options_add($tmp_crnrstn_signature_headers_ARRAY);
//                            $this->oCRNRSTN->header_options_add($tmp_header_options_ARRAY);
//
//                            $this->oCRNRSTN->header_options_apply();
//
//                            $this->readfile_chunked($tmp_filepath);
//
//                            //ob_flush();
//                            if(ob_get_level() > 0){ob_flush();}
//                            flush();
//                            exit();
//
//                        }
                    }

                //error_log(__LINE__ . ' asset mgr [404] asset_request_asset_family[' . $tmp_response_map_request_family . '].');
                return $this->oCRNRSTN->return_server_response_code(404);

                break;

            }

            // =================

            //error_log(__LINE__ . ' asset mgr $tmp_output_mode[' . $tmp_output_mode . ']. $tmp_filename[' . $tmp_filename . '].');

            switch($tmp_output_mode){
                case CRNRSTN_ASSET_MAPPING:

                    error_log(__LINE__ . ' asset mgr $tmp_filename[' . $tmp_filename . ']. [' . print_r(self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename], true) . '].');
                    switch($tmp_asset_family){
                        case 'system':

                            if($this->oCRNRSTN->is_bit_set(CRNRSTN_SYSTEM_IMG_ASSET_MAPPING) == true){

                                //error_log(__LINE__ . ' asset mgr RETURN PNG SYSTEM IMAGE[' . $tmp_filename . '].');
                                return $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_filename;

                            }

                        break;
                        case 'social':

                            if($this->oCRNRSTN->is_bit_set(CRNRSTN_SOCIAL_IMG_ASSET_MAPPING) == true){

                                //error_log(__LINE__ . ' asset mgr RETURN PNG SOCIAL IMAGE[' . $tmp_filename . '].');
                                return $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_filename;

                            }

                        break;
                        default:
                            // SILENCE IS GOLDEN.
                        break;

                    }

                break;
                case CRNRSTN_BASE64_JPEG:

                    $tmp_filepath_base64 = CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/' . $tmp_filename . '.php';

                    //
                    // TODO :: CONSIDER USE OF is_readable() IN THIS PLACE TO POTENTIALLY SAVE A STEP.
                    // Wednesday, November 15, 2023 @ 1335 hrs.
                    if(!is_file($tmp_filepath_base64)){

                        $this->oCRNRSTN->error_log('Failure opening [' . $tmp_filename . '] for inclusion. Attempting to repair the BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
                        //$this->oCRNRSTN->print_r('Failure opening [' . $tmp_filename . '] for inclusion. Attempting to repair the BASE64 file system.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);

                        $this->system_base64_synchronize($tmp_filename);

                        if(!is_file($tmp_filepath_base64)){

                            $this->oCRNRSTN->error_log('Failure opening [' . $tmp_filepath_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
                            //$this->oCRNRSTN->print_r('Failure opening [' . $tmp_filepath_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('Failure opening [' . $tmp_filepath_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.');

                        }else{

                            //$this->oCRNRSTN->print_r('Repair of asset successfully completed on [' . $tmp_filename . '] within the CRNRSTN :: BASE64 file system.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
                            $this->oCRNRSTN->error_log('Repair of asset successfully completed on [' . $tmp_filename . '] within the CRNRSTN :: BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                            include($tmp_filepath_base64);

                        }

                    }else{

                        include($tmp_filepath_base64);

                    }

                    if(isset($system_file_serial)){

                        $tmp_str = self::$image_filesystem_meta_ARRAY[self::$image_output_mode][self::$request_salt][$system_file_serial ]['base64'];

                    }

                    //
                    // BASE64
                    return $tmp_str;

                break;
                case CRNRSTN_BASE64:
                case CRNRSTN_BASE64_PNG:

                    $tmp_filepath_base64 = CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/' . $tmp_filename . '.php';

                    if(!is_file($tmp_filepath_base64)){

                        $this->oCRNRSTN->error_log('Failure opening [' . $tmp_filename . '] for inclusion. Attempting to repair the BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
                        //$this->oCRNRSTN->print_r('Failure opening [' . $tmp_filename . '] for inclusion. Attempting to repair the BASE64 file system.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);

                        $this->system_base64_synchronize($tmp_filename);

                        if(!is_file($tmp_filepath_base64)){

                            $this->oCRNRSTN->error_log('Failure opening [' . $tmp_filepath_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
                            //$this->oCRNRSTN->print_r('Failure opening [' . $tmp_filepath_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('Failure opening [' . $tmp_filepath_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.');

                        }else{

                            //$this->oCRNRSTN->print_r('Repair of asset successfully completed on [' . $tmp_filename . '] within the CRNRSTN :: BASE64 file system.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
                            $this->oCRNRSTN->error_log('Repair of asset successfully completed on [' . $tmp_filename . '] within the CRNRSTN :: BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                            include($tmp_filepath_base64);

                        }

                    }else{

                        include($tmp_filepath_base64);

                    }

                    if(isset($system_file_serial)){

                        $tmp_str = self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_PNG][self::$request_salt][$system_file_serial ]['base64'];

                    }

                    //
                    // BASE64
                    return $tmp_str;

                break;
                case CRNRSTN_HTML:

                    //error_log(__LINE__ . ' asset mgr $tmp_family[' . $tmp_response_map_request_family . ']. $tmp_filename[' . $tmp_filename . ']. $tmp_output_mode[' . $tmp_output_mode . '].');
                    $tmp_str = $this->oCRNRSTN->crnrstn_http_endpoint() . '_crnrstn/ui/imgs/jpg/' . $tmp_filename . '.jpg';

                    if(strlen($tmp_link) > 0){

                        $tmp_str = $this->return_img_html($tmp_str, $tmp_width, $tmp_height, $tmp_alt, $tmp_title, $tmp_link, $tmp_target);

                        return $tmp_str;

                    }else{

                        switch($tmp_response_map_request_family){
                            case 'crnrstn':
                            case 'bassdrive':
                            case 'jony5':

                                error_log(__LINE__ . ' asset mgr FAVICON Well bruv,...looks like we need this. die();');
                                die();
                                return '<link rel="shortcut icon" type="image/x-icon" href="' . $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_asset_family . '/' . $tmp_filename . '.ico&crnrstn_=420.00"/>';

                            break;
                            default:

                                if($tmp_width != ''){

                                    $tmp_width = 'width="' . $tmp_width . '"';

                                }

                                if($tmp_height != ''){

                                    $tmp_height = 'height="' . $tmp_height . '" ';

                                }

                                if($tmp_alt != ''){

                                    $tmp_alt = 'alt="' . $tmp_alt . '" ';

                                }

                                if($tmp_title != ''){

                                    $tmp_title = 'title="' . $tmp_title . '"';

                                }

                                $tmp_space = '';
                                if(($tmp_width != '') || ($tmp_height != '') ||  ($tmp_alt != '') || ($tmp_title != '')){

                                    $tmp_space = ' ';

                                }

                                return '<img src="' . $tmp_str . '"' . $tmp_space . $tmp_width . $tmp_height . $tmp_alt . $tmp_title . '>';

                            break;

                        }

                    }

                break;
                case CRNRSTN_JPEG:

                    //error_log(__LINE__ . ' asset mgr $tmp_filename[' . $tmp_filename . ']. $tmp_output_mode[' . $tmp_output_mode . '].');
                    $tmp_str = $this->oCRNRSTN->crnrstn_http_endpoint() . 'ui/imgs/jpg/' . $tmp_filename . '.jpg';

                    //
                    // JPEG
                    return $tmp_str;

                break;
                case CRNRSTN_PNG:

                    //error_log(__LINE__ . ' asset mgr $tmp_filename[' . $tmp_filename . ']. $tmp_output_mode[' . $tmp_output_mode . '].');
                    switch($tmp_asset_family){
                        case 'system':

                            if($this->oCRNRSTN->is_bit_set(CRNRSTN_SYSTEM_IMG_ASSET_MAPPING) == true){

                                //error_log(__LINE__ . ' asset mgr RETURN PNG SYSTEM IMAGE[' . $tmp_filename . '].');
                                return $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_filename;

                            }

                        break;
                        case 'social':

                            if($this->oCRNRSTN->is_bit_set(CRNRSTN_SOCIAL_IMG_ASSET_MAPPING) == true){

                                //error_log(__LINE__ . ' asset mgr RETURN PNG SOCIAL IMAGE[' . $tmp_filename . '].');
                                return $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_filename;

                            }

                        break;
                        default:
                            // SILENCE IS GOLDEN.

                        break;

                    }

                    //error_log(__LINE__ . ' asset mgr RETURN PNG IMAGE URI [...ui/imgs/png/ui/imgs/png/' . $tmp_filename . '.png.png].');
                    return $this->oCRNRSTN->crnrstn_http_endpoint() . 'ui/imgs/png/' . $tmp_filename . '.png';

                break;
                case CRNRSTN_SETTINGS_CRNRSTN:

                    $tmp_ARRAY = array();

                    $tmp_ARRAY['filename'] = $tmp_filename;
                    $tmp_ARRAY['width'] = $tmp_width;
                    $tmp_ARRAY['height'] = $tmp_height;
                    $tmp_ARRAY['alt'] = $tmp_alt;
                    $tmp_ARRAY['title'] = $tmp_title;
                    $tmp_ARRAY['hyperlink'] = $tmp_link;
                    $tmp_ARRAY['target'] = $tmp_target;

                    return $tmp_ARRAY;

                break;
                default:

                    $this->oCRNRSTN->error_log('DEFAULT NOT SET FOR ASSET[' . $tmp_filename . ']. HOOOSTON...VE HAF PROBLEM!', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
                    return '';

                break;

            }

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            //C
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function return_dynamic_css_string_output($asset_reference = NULL){

        //$tmp_key = '';

        //if($this->oCRNRSTN->return_response_map_ugc_value('current', 'isset')){

            $tmp_key = $this->oCRNRSTN->oCRNRSTN_RRS_MAP->get_salt_ugc();

        //}

        if(isset($asset_reference)){

            $tmp_key = $asset_reference;

        }

        /*
        public_html/_crnrstn/ui/js/_lib/frameworks/jquery_mobile/1.4.5/jquery.mobile.external-png-1.4.5.css
        public_html/_crnrstn/ui/js/_lib/frameworks/jquery_mobile/1.4.5/jquery.mobile.external-png-1.4.5.min.css

        public_html/_crnrstn/ui/js/_lib/frameworks/jquery_mobile/1.4.5/jquery.mobile.icons-1.4.5.css
        public_html/_crnrstn/ui/js/_lib/frameworks/jquery_mobile/1.4.5/jquery.mobile.icons-1.4.5.min.css

        public_html/_crnrstn/ui/js/_lib/frameworks/jquery_mobile/1.4.5/jquery.mobile.inline-png-1.4.5.css
        public_html/_crnrstn/ui/js/_lib/frameworks/jquery_mobile/1.4.5/jquery.mobile.inline-png-1.4.5.min.css

        public_html/_crnrstn/ui/js/_lib/frameworks/jquery_mobile/1.4.5/jquery.mobile.inline-svg-1.4.5.css
        public_html/_crnrstn/ui/js/_lib/frameworks/jquery_mobile/1.4.5/jquery.mobile.inline-svg-1.4.5.min.css

        public_html/_crnrstn/ui/js/_lib/frameworks/jquery_mobile/1.4.5/jquery.mobile-1.4.5.css
        public_html/_crnrstn/ui/js/_lib/frameworks/jquery_mobile/1.4.5/jquery.mobile-1.4.5.min.css

        public_html/_crnrstn/ui/js/_lib/frameworks/jquery_mobile/1.4.5/jquery.mobile.theme-1.4.5.css
        public_html/_crnrstn/ui/js/_lib/frameworks/jquery_mobile/1.4.5/jquery.mobile.theme-1.4.5.min.css

        jquery_mobile_external_png_1_4_5_css
        jquery_mobile_external_png_1_4_5_min_css
        jquery_mobile_icons_1_4_5_css
        jquery_mobile_icons_1_4_5_min_css
        jquery_mobile_inline_png_1_4_5_css
        jquery_mobile_inline_png_1_4_5_min_css
        jquery_mobile_inline_svg_1_4_5_css
        jquery_mobile_inline_svg_1_4_5_min_css
        jquery_mobile_theme_1_4_5_css
        jquery_mobile_theme_1_4_5_min_css
        jquery_mobile_1_4_5_css
        jquery_mobile_1_4_5_min_css

        */

        switch($tmp_key){
            case 'crnrstn.lightbox.css':

                return $this->oCRNRSTN_JS_CSS->crnrstn_lightbox_css();

            break;
            case 'crnrstn.lightbox.min.css':

                return $this->oCRNRSTN_JS_CSS->crnrstn_lightbox_min_css();

            break;
            case 'crnrstn.lightbox-2.03.3.css':

                return $this->oCRNRSTN_JS_CSS->crnrstn_lightbox_2_03_3_css();

            break;
            case 'crnrstn.jquery-mobile-external-png-1.4.5.css':

                return $this->oCRNRSTN_JS_CSS->jquery_mobile_external_png_1_4_5_css();

            break;
            case 'crnrstn.jquery-mobile-external-png-1.4.5.min.css':

                return $this->oCRNRSTN_JS_CSS->jquery_mobile_external_png_1_4_5_min_css();

            break;
            case 'crnrstn.jquery-mobile-icons-1.4.5.css':

                return $this->oCRNRSTN_JS_CSS->jquery_mobile_icons_1_4_5_css();

            break;
            case 'crnrstn.jquery-mobile-icons-1.4.5.min.css':

                return $this->oCRNRSTN_JS_CSS->jquery_mobile_icons_1_4_5_min_css();

            break;
            case 'crnrstn.jquery-mobile-inline-png-1.4.5.css':

                return $this->oCRNRSTN_JS_CSS->jquery_mobile_inline_png_1_4_5_css();

            break;
            case 'crnrstn.jquery-mobile-inline-png-1.4.5.min.css':

                return $this->oCRNRSTN_JS_CSS->jquery_mobile_inline_png_1_4_5_min_css();

            break;
            case 'crnrstn.jquery-mobile-inline-svg-1.4.5.css':

                return $this->oCRNRSTN_JS_CSS->jquery_mobile_inline_svg_1_4_5_css();

            break;
            case 'crnrstn.jquery-mobile-inline-svg-1.4.5.min.css':

                return $this->oCRNRSTN_JS_CSS->jquery_mobile_inline_svg_1_4_5_min_css();

            break;
            case 'crnrstn.jquery-mobile-theme-1.4.5.css':

                return $this->oCRNRSTN_JS_CSS->jquery_mobile_theme_1_4_5_css();

            break;
            case 'crnrstn.jquery-mobile-theme-1.4.5.min.css':

                return $this->oCRNRSTN_JS_CSS->jquery_mobile_theme_1_4_5_min_css();

            break;
            case 'crnrstn.jquery-mobile-1.4.5.css':

                return $this->oCRNRSTN_JS_CSS->jquery_mobile_1_4_5_css();

            break;
            case 'crnrstn.jquery-mobile-1.4.5.min.css':

                return $this->oCRNRSTN_JS_CSS->jquery_mobile_1_4_5_min_css();

            break;

        }

        return '';

    }

    public function return_dynamic_js_string_output($asset_reference = NULL){

        $tmp_key = $this->oCRNRSTN->oCRNRSTN_RRS_MAP->get_salt_ugc();

        if(isset($asset_reference)){

            $tmp_key = $asset_reference;

        }

        switch($tmp_key){
            case 'crnrstn.backbone_1_4_1.min.js':

                return $this->oCRNRSTN_JS_CSS->crnrstn_backbone_1_4_1_min_js();

            break;
            case 'crnrstn.lightbox-2.03.3.js':

                return $this->oCRNRSTN_JS_CSS->crnrstn_lightbox_2_03_3_js();

            break;

        }

        return '';

    }

    public function return_asset_data($request_ugc_value, $request_family, $asset_meta_key, $asset_meta_path, $channel = CRNRSTN_AUTHORIZE_RUNTIME){

        if($request_family == 'meta' || $request_family == 'module_key'){

            return '';

        }

        $tmp_header_options_ARRAY = array();

        $tmp_header_options_ARRAY[] = $this->oCRNRSTN->get_resource('header_response_option_cache_control', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');
        $tmp_header_options_ARRAY[] = $this->oCRNRSTN->get_resource('header_response_option_x_frame_options', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

        switch($request_family){
            case 'favicon':

                error_log(__LINE__. ' asset mgr $request_ugc_value[' . $request_ugc_value . ']. HANDLING FAVICON [' . $channel . '] ACCELERATION HERE.');

                //
                // SUPPORTED USE-CASES ::
                // SESSION SALT MAPPED $_GET RETURN OF RAW CRNRSTN :: MAPPED FAVICON .ICO.
                $tmp_file_extension = 'ico';
                $tmp_filepath = $this->oCRNRSTN->get_resource('crnrstn_favicon_asset_map_dir_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');

                error_log(__LINE__ . ' asset mgr $asset_meta_key[' . $asset_meta_key . ']. asset_request_data_key=[' . $request_ugc_value . ']. asset_request_asset_family=[' . $request_family . '].');
                $tmp_ARRAY = explode('/', $request_ugc_value);

                //
                // ADJUST VALUES BY DERIVING FAMILY AND KEY OVERRIDES FROM ORIGINAL DATA KEY VALUE.
                $tmp_response_map_request_family = $tmp_ARRAY[0];
                $tmp_filename = $tmp_ARRAY[1];

                $tmp_filepath .= DIRECTORY_SEPARATOR . 'system' . DIRECTORY_SEPARATOR . $tmp_response_map_request_family . DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;
                //error_log(__LINE__ . ' img asset mgr $tmp_filename[' . $tmp_filename . ']. $tmp_filepath=[' . $tmp_filepath . '].');

                $this->return_file_byte_chunked_buffer_output($tmp_filepath, $tmp_filename, $tmp_file_extension, CRNRSTN_FAVICON_ASSET_MAPPING, $channel);

            break;
            case 'css':

//                $tmp_header_options_ARRAY[] = 'Content-Type: text/css';
//                $tmp_dir_path = $this->oCRNRSTN->get_resource('crnrstn_css_asset_map_dir_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');
//
//                $tmp_date_lastmod = filemtime($tmp_dir_path);
//                $tmp_date_lastmod = date('D, j M Y G:i:s T', $tmp_date_lastmod);
//                $tmp_header_options_ARRAY[] = 'Last-Modified: ' . $tmp_date_lastmod;
//
//                //error_log(__LINE__ . 'Last-Modified: ' . $tmp_date_lastmod);
//                //error_log(__LINE__ . ' Last-Modified: <day-name>, <day> <month> <year> <hour>:<minute>:<second> GMT');
//                switch($asset_meta_path){
//                    case $this->oCRNRSTN->session_salt():
//
//                        //
//                        // SESSION SALT MEANS NO EXTERNAL FILE. RETURN DATA FROM INTERNAL CACHE SOURCE.
//                        switch($request_ugc_value){
//                            case 'crnrstn.jquery-mobile-external-png-1.4.5.css':
//                            case 'crnrstn.jquery-mobile-external-png-1.4.5.min.css':
//                            case 'crnrstn.jquery-mobile-icons-1.4.5.css':
//                            case 'crnrstn.jquery-mobile-icons-1.4.5.min.css':
//                            case 'crnrstn.jquery-mobile-inline-png-1.4.5.css':
//                            case 'crnrstn.jquery-mobile-inline-png-1.4.5.min.css':
//                            case 'crnrstn.jquery-mobile-inline-svg-1.4.5.css':
//                            case 'crnrstn.jquery-mobile-inline-svg-1.4.5.min.css':
//                            case 'crnrstn.jquery-mobile-theme-1.4.5.css':
//                            case 'crnrstn.jquery-mobile-theme-1.4.5.min.css':
//                            case 'crnrstn.jquery-mobile-1.4.5.css':
//                            case 'crnrstn.jquery-mobile-1.4.5.min.css':
//                            case 'crnrstn.lightbox.css':
//                            case 'crnrstn.lightbox.min.css':
//                            case 'crnrstn.lightbox-2.03.3.css':
//
//                                $tmp_str = $this->return_dynamic_css_string_output();
//
//                            break;
//
//                        }
//
//                        $tmp_dir_path = '';
//
//                    break;
//                    default:
//
//                        if(strlen($asset_meta_path) > 0){
//
//                            $tmp_dir_path = $tmp_dir_path . '/' . $asset_meta_path;
//
//                        }
//
//                    break;
//
//                }

            break;
            case 'js':
//
//                // lightbox.js css is stored on javascript path
//                // THIS Content-Type DATA IS AVAILABLE HERE ($resource_ARRAY['meta_type']), BUT GETTING THIS
//                // VALUE FOR ONE FILE RESOURCE REQUIRES LOADING ALL THE DATA FOR ALL FILES IN THAT FRAMEWORK.
//                // THE CURRENT ARCHITECTURE: "LOAD EVERYTHING...OR, GET BY PERFECTLY FINE WITH ALMOST NOTHING."
//                //...WE TAKE THE FAST (strpos) WAY RATHER THAN PERFORM THE INTERNAL META LOOKUPS.
//                $pos_css = strpos($request_ugc_value,'.css');
//                $pos_map = strpos($request_ugc_value,'.map');
//                if($pos_css !== false){
//
//                    $tmp_header_options_ARRAY[] = 'Content-Type: text/css';
//
//                }else{
//
//                    if($pos_map !== false){
//
//                        //
//                        // SOURCE :: https://stackoverflow.com/questions/16384089/jquery-2-0-0-min-map-uncaught-syntaxerror-unexpected-token/
//                        // COMMENT :: https://stackoverflow.com/a/38021461
//                        // AUTHOR :: bylerj :: https://stackoverflow.com/users/2510246/bylerj
//                        $tmp_header_options_ARRAY[] = 'Content-Type: text/json';
//
//                    }else{
//
//                        $tmp_header_options_ARRAY[] = 'Content-Type: text/javascript';
//
//                    }
//
//                }
//
//                $tmp_dir_path = $this->oCRNRSTN->get_resource('crnrstn_js_asset_map_dir_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');
//
//                $tmp_date_lastmod = filemtime($tmp_dir_path);
//                $tmp_date_lastmod = date('D, j M Y G:i:s T', $tmp_date_lastmod);
//                $tmp_header_options_ARRAY[] = 'Last-Modified: ' . $tmp_date_lastmod;
//
//                switch($asset_meta_path){
//                    case $this->oCRNRSTN->session_salt():
//
//                        //
//                        // SESSION SALT MEANS NO EXTERNAL FILE. RETURN DATA FROM INTERNAL CACHE SOURCE.
//                        switch($request_ugc_value){
//                            case 'crnrstn.backbone_1_4_1.min.js':
//                            case 'crnrstn.lightbox-2.03.3.js':
//
//                                $tmp_str = $this->return_dynamic_js_string_output();
//
//                            break;
//
//                        }
//
//                        $tmp_dir_path = '';
//
//                    break;
//                    default:
//
//                        if(strlen($asset_meta_path) > 0){
//
//                            $tmp_dir_path = $tmp_dir_path . DIRECTORY_SEPARATOR . $asset_meta_path;
//
//                        }
//
//                    break;
//
//                }

            break;
            case 'integrations':

//                switch($request_ugc_value){
//                    case 'framework/jquery_mobile_1_4_5/images/ajax-loader':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/action-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/action-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/alert-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/alert-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-d-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-d-l-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-d-l-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-d-r-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-d-r-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-d-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-l-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-l-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-r-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-r-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-u-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-u-l-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-u-l-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-u-r-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-u-r-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-u-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/audio-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/audio-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/back-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/back-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/bars-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/bars-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/bullets-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/bullets-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/calendar-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/calendar-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/camera-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/camera-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/carat-d-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/carat-d-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/carat-l-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/carat-l-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/carat-r-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/carat-u-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/carat-r-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/carat-u-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/check-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/check-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/clock-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/clock-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/cloud-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/cloud-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/comment-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/comment-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/delete-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/delete-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/edit-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/edit-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/eye-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/eye-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/forbidden-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/forbidden-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/forward-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/forward-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/gear-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/gear-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/grid-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/grid-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/heart-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/heart-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/home-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/home-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/info-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/info-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/location-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/location-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/lock-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/lock-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/mail-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/mail-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/minus-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/minus-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/navigation-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/navigation-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/phone-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/phone-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/plus-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/plus-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/power-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/power-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/recycle-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/recycle-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/refresh-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/refresh-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/search-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/search-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/shop-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/shop-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/star-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/star-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/tag-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/tag-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/user-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/user-white':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/video-black':
//                    case 'framework/jquery_mobile_1_4_5/images/icons-png/video-white':
//                    case 'framework/lightbox/close':
//                    case 'framework/lightbox/loading':
//                    case 'framework/lightbox/next':
//                    case 'framework/lightbox/prev':
//                    case 'framework/lightbox-2.03.3/close':
//                    case 'framework/lightbox-2.03.3/loading':
//                    case 'framework/lightbox-2.03.3/next':
//                    case 'framework/lightbox-2.03.3/prev':
//
//                        if($channel == CRNRSTN_AUTHORIZE_RUNTIME){
//
//                            error_log(__LINE__ . ' asset mgr FIRE RETURN SYSTEM IMAGE $request_ugc_value[' . $request_ugc_value . ']. $request_family[' . $request_family . ']. $asset_meta_path[' . $asset_meta_path . ']. $asset_meta_key[' . $asset_meta_key . ']. $channel[' . $channel . '].die();');
//
//                            //
//                            // SYNC RRS MAP CACHE. THERE IS NO 'return_system_image' CASE. WILL 'return_asset_data' WORK?
//                            if(!$this->oCRNRSTN->runtime_rrs_cache_is_active('return_asset_data')){
//
//                                $this->oCRNRSTN->initialize_response_map_cache('return_asset_data', $asset_meta_key, $request_ugc_value, $request_family, $asset_meta_path);
//
//                            }
//
//                        }
//
//                        return $this->return_system_image($asset_meta_key);
//
//                    break;
//
//                }

            break;

        }
//
//        //
//        // REMOVE TRAILING SLASH.
//        $tmp_dir_path = $this->oCRNRSTN->strrtrim($tmp_dir_path, '/');
//        $tmp_filepath = $tmp_dir_path . DIRECTORY_SEPARATOR . $request_ugc_value;
//
//        $tmp_curr_headers_ARRAY = headers_list();
//        $tmp_crnrstn_signature_headers_ARRAY = $this->oCRNRSTN->header_signature_options_return();
//
//        //
//        // EXTRACT FILE CONTENTS. [JS, CSS, MAP]
//        if(!isset($tmp_str)){
//
//            $tmp_str = file_get_contents($tmp_filepath);
//            $tmp_filesize = filesize($tmp_filepath);
//
//        }
//
//        //
//        // NULL FILE SIZE CHECK.
//        if(!isset($tmp_filesize)){
//
//            $tmp_filesize = strlen($tmp_str);
//
//        }
//
//        //
//        // EMPTY STRING FILE SIZE CHECK.
//        if($tmp_filesize == ''){
//
//            $tmp_filesize = strlen($tmp_str);
//
//        }
//
//        $tmp_header_options_ARRAY[] = 'Content-length: ' . $tmp_filesize;
//
//        //
//        // ENSURE ALL SIGNATURE HEADERS ARE IN PLACE AND CONTINUE
//        $this->oCRNRSTN->header_options_add($tmp_curr_headers_ARRAY);
//        $this->oCRNRSTN->header_options_add($tmp_crnrstn_signature_headers_ARRAY);
//        $this->oCRNRSTN->header_options_add($tmp_header_options_ARRAY);
//
//        $this->oCRNRSTN->header_options_apply();
//
//        //
//        // TAKE FILE EXTENSION TO CRNRSTN :: PLAID.
//        $tmp_filename_ARRAY = explode('.', $tmp_filepath);
//        $file_extension = array_pop($tmp_filename_ARRAY);
//
//        echo $tmp_str;
//
//        if(ob_get_level() > 0){ob_flush();}
//        flush();
//        exit();

    }

    public function return_img_html($str, $width = NULL, $height = NULL, $alt = NULL, $title = NULL, $url = NULL, $target = NULL, $meta_params_ARRAY = array()){

        //
        // <IMG> HTML INJECTION DOM ATTRIBUTE STRING PREPARATION.
        // IF width='25', THEN $width="width='25'"; IF width='', THEN $width='';
        $tmp_is_anchor_wrapped = false;
        $width = $this->html_img_dom_return($width, 'WIDTH');
        $height = $this->html_img_dom_return($height, 'HEIGHT');
        $alt = $this->html_img_dom_return($alt, 'ALT');
        $title = $this->html_img_dom_return($title, 'TITLE');

        $tmp_space = '';
        if(($width != '') || ($height != '') ||  ($alt != '') || ($title != '')){

            $tmp_space = ' ';

        }

        // ' . $img_css . '
        //$img_css = $this->html_img_dom_return($meta_params_ARRAY, 'CSS');
        $tmp_str = '<img src="' . $str . '"' . $tmp_space . $width . $height .  $alt . $title . '>';

        if(isset($url)){

            if(strlen($url) > 0){

                $tmp_is_anchor_wrapped = true;

                if(!isset($target)){

                    $target = $this->oCRNRSTN->get_resource('default_anchor_target', 0, 'CRNRSTN::RESOURCE::HTML_DOM');

                }else{

                    if(strlen($target) < 1){

                        $target = $this->oCRNRSTN->get_resource('default_anchor_target', 0, 'CRNRSTN::RESOURCE::HTML_DOM');

                    }

                }

            }

        }

        if($tmp_is_anchor_wrapped == true){

            if($this->oCRNRSTN->isset_encryption(CRNRSTN_ENCRYPT_TUNNEL) == true){
                //if(strlen($this->oCRNRSTN->env_key) > 0 && $this->oCRNRSTN->isset_encryption(CRNRSTN_ENCRYPT_TUNNEL)){

                $tmp_str = '<a href="' . $this->oCRNRSTN->return_sticky_link($url, $meta_params_ARRAY) . '" target="' . $target . '">' . $tmp_str . '</a>';

                return $tmp_str;

            }

            $tmp_str = '<a href="' . $url . '" target="' . $target . '">' . $tmp_str . '</a>';

            return $tmp_str;

        }

        return $tmp_str;

    }

    public function html_img_dom_return($attribute_data, $attribute_type = 'WIDTH'){

        //
        // <IMG> HTML INJECTION DOM ATTRIBUTE STRING PREPARATION.
        // IF width='25', THEN $width="width='25'"; IF width='', THEN $width='';
        switch($attribute_type){
            case 'TARGET':

                if($attribute_data != ''){

                    $attribute_data = 'target="' . $attribute_data . '"';

                }else{

                    $attribute_data = '';

                }

            break;
            case 'HYPERLINK':

                if($attribute_data != ''){

                    $attribute_data = 'href="' . $attribute_data . '"';

                }else{

                    $attribute_data = '';

                }

            break;
            case 'WIDTH':

                if($attribute_data != ''){

                    $attribute_data = 'width="' . $attribute_data . '"';

                }else{

                    $attribute_data = '';

                }

            break;
            case 'HEIGHT':

                if($attribute_data != ''){

                    $attribute_data = 'height="' . $attribute_data . '"';

                }else{

                    $attribute_data = '';

                }

            break;
            case 'ALT':

                if($attribute_data != ''){

                    $attribute_data = 'alt="' . $attribute_data . '"';

                }else{

                    $attribute_data = '';

                }

            break;
            case 'TITLE':

                if($attribute_data != ''){

                    $attribute_data = 'title="' . $attribute_data . '"';

                }else{

                    $attribute_data = '';

                }

            break;

        }

        return $attribute_data;

    }

    private function return_creative_profile($data_key){

        /*
        $tmp_filename = 'j5_wolf_pup_walk';
        $tmp_width = '';
        $tmp_height = 430;
        $tmp_alt = 'J5 Wolf Pup';
        $tmp_title = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';

        */

        return $this->return_creative($data_key, CRNRSTN_FILE_MANAGEMENT, NULL);

    }

    private function load_system_asset($data_type_constant){

        //error_log(__LINE__ . ' img html ['.$data_type_constant.']['.self::$request_salt.'][\'path_filename\']');

        if(isset(self::$image_filesystem_meta_ARRAY[$data_type_constant][self::$request_salt]['path_filename'])){

            if(!$file_path = self::$image_filesystem_meta_ARRAY[$data_type_constant][self::$request_salt]['path_filename']){

                $this->oCRNRSTN->print_r('ERROR :: LOAD ASSET[' . print_r(self::$image_filesystem_meta_ARRAY[$data_type_constant], true).'].', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);

                return false;

            }

            //
            // TODO :: CONSIDER USE OF is_readable() IN THIS PLACE TO POTENTIALLY SAVE A STEP.
            // Wednesday, November 15, 2023 @ 1335 hrs.
            if(is_file($file_path)){

                if(!($tmp_base64_filemtime = @filemtime(self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64][self::$request_salt]['path_filename']))){

                    $tmp_base64_filemtime = $this->oCRNRSTN->return_micro_time();

                }

//                case CRNRSTN_JPEG:
//                case CRNRSTN_PNG:

                list($tmp_width, $tmp_height) = getimagesize($file_path);
                self::$image_filesystem_meta_ARRAY[$data_type_constant][self::$request_salt]['image_dimensions'] = $tmp_width . ' pixels in width X ' . $tmp_height . ' pixels in height.';
                self::$image_filesystem_meta_ARRAY[$data_type_constant][self::$request_salt]['mime_content_type'] = mime_content_type($file_path);
                self::$image_filesystem_meta_ARRAY[$data_type_constant][self::$request_salt]['filesize'] = $this->oCRNRSTN->format_bytes($this->oCRNRSTN->find_filesize($file_path), 5);
                self::$image_filesystem_meta_ARRAY[$data_type_constant][self::$request_salt]['filemtime'] = filemtime($file_path);
                self::$image_filesystem_meta_ARRAY[$data_type_constant][self::$request_salt]['md5'] = md5_file($file_path);
                self::$image_filesystem_meta_ARRAY[$data_type_constant][self::$request_salt]['sha1'] = sha1_file($file_path);
                self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64][self::$request_salt]['filemtime'] = $tmp_base64_filemtime;

                self::$image_filesystem_meta_ARRAY[$data_type_constant][self::$request_salt]['base64'] = $this->oCRNRSTN->encode_image($file_path);
                //$this->oCRNRSTN->print_r('LOADED ASSET DATA [' . $data_type_constant . ']['.print_r(self::$image_filesystem_meta_ARRAY, true).'].', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);

                return true;

            }

        }

        return false;

    }

    private function valid_system_asset($data_type_constant, $validation_type){

        if(!isset(self::$image_filesystem_meta_ARRAY[$data_type_constant][self::$request_salt]['path_filename'])){

            $this->oCRNRSTN->error_log('System BASE64 asset sync with file [' . $data_type_constant . '] required.', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);

            return false;

        }

        $tmp_current_base64 = '';
        $tmp_base64 = self::$image_filesystem_meta_ARRAY[$data_type_constant][self::$request_salt]['base64'];

        if(isset(self::$image_filesystem_meta_ARRAY[CRNRSTN_PNG][self::$request_salt]['arch_1.0_base64'])){

            $tmp_current_base64 = self::$image_filesystem_meta_ARRAY[CRNRSTN_PNG][self::$request_salt]['arch_1.0_base64'];

        }

        if(strlen($tmp_current_base64) > 0){

            if($tmp_current_base64 != $tmp_base64){

                //self::$image_filesystem_meta_ARRAY[CRNRSTN_PNG][self::$request_salt]['arch_1.0_base64'] = '';
                //$this->oCRNRSTN->print_r('INVALID [' . $data_type_constant . '] BASE64 FROM FILE.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
                $this->oCRNRSTN->error_log('System BASE64 asset sync with file [' . $data_type_constant . '] required.', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);

                return false;

            }

        }

        //
        // CURRENT BASE64
        switch($data_type_constant){
            case CRNRSTN_JPEG:

                $tmp_BASE64_STATIC_PHP = '';
                $tmp_BASE64_LIVE = self::$image_filesystem_meta_ARRAY[$data_type_constant][self::$request_salt]['base64'];

                if(isset(self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_JPEG][self::$request_salt][$this->system_file_serial]['base64'])){

                    $tmp_BASE64_STATIC_PHP = self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_JPEG][self::$request_salt][$this->system_file_serial]['base64'];

                }

                if(strcmp($tmp_BASE64_LIVE, $tmp_BASE64_STATIC_PHP) !== 0){

                    //error_log(__LINE__ . ' img [' . print_r(self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_JPEG][self::$request_salt], true) . '].');

                    //$this->oCRNRSTN->print_r('DELTA [' . __METHOD__ . '] ERROR! [JPEG] IMAGE_FILE_BASE64[len=' . strlen($tmp_BASE64_LIVE) . '] STATIC_PHP_BASE64[len=' . strlen($tmp_BASE64_STATIC_PHP) . '].', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
                    //$this->oCRNRSTN->print_r('ERR VALUES [' . CRNRSTN_BASE64_JPEG . '][' . self::$request_salt . '][' . $this->system_file_serial . '][\'base64\'].', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);

                    $this->oCRNRSTN->error_log('System BASE64 asset sync with JPEG file [' . $data_type_constant . '] required.', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);

                    return false;

                }

            break;
            default:

                // case CRNRSTN_PNG:
                $tmp_BASE64_STATIC_PHP = '';
                $tmp_BASE64_LIVE = self::$image_filesystem_meta_ARRAY[$data_type_constant][self::$request_salt]['base64'];

                if(isset(self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_PNG][self::$request_salt][$this->system_file_serial]['base64'])){

                    $tmp_BASE64_STATIC_PHP = self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_PNG][self::$request_salt][$this->system_file_serial]['base64'];

                }

                if(strcmp($tmp_BASE64_LIVE, $tmp_BASE64_STATIC_PHP) !== 0){

                    //$this->oCRNRSTN->print_r('DELTA ERROR ON [' . $data_type_constant . ']![PNG] LIVE=[' . $tmp_BASE64_LIVE . '] STATIC_PHP=[' . $tmp_BASE64_STATIC_PHP . '].', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
                    //$this->oCRNRSTN->print_r('ERR VALUES [' . CRNRSTN_BASE64_JPEG . '][' . self::$request_salt . '][' . $this->system_file_serial . '][\'base64\'].', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);

                    $this->oCRNRSTN->error_log('System BASE64 asset sync with PNG file [' . $data_type_constant . '] required.', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);

                    return false;

                }

            break;

        }

        return true;

    }

    public function mkdir($directory, $permissions_override, $recursive_perms_override, $context, $channel = CRNRSTN_AUTHORIZE_RUNTIME){

        try{

            /*
            Note:
            permissions is ignored on Windows.

            Note:
            Avoid using umask() in multithreaded webservers. It is better to
            change the file permissions with chmod() after creating the file.
            Using umask() can lead to unexpected behavior of concurrently running
            scripts and the webserver itself because they all use the same umask.

            RRS MAP ::
            public function byte_reporting($report_profile, $channel, $source, $data_len = NULL){

            */

            $tmp_error_log_ARRAY = array();
            $tmp_minimum_bytes_required = 0;
            $permissions_chmod = $permissions_override;
            if(!isset($permissions_override)){

                $permissions_chmod = $this->oCRNRSTN->get_resource('permissions_chmod', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

            }

            //
            // ASK CRNRSTN :: TO GRANT PERMISSIONS FOR fwrite().
            // WARNINGS WILL BE THROWN @ $oCRNRSTN->max_disk_storage_utilization_warning() PERCENTAGE.
            // WRITE REQUESTS WILL BE DENIED @ $oCRNRSTN->max_disk_storage_utilization() PERCENTAGE.
            if(!$this->oCRNRSTN->grant_permissions_fwrite($directory, $tmp_minimum_bytes_required)){

                //
                // HOOOSTON...VE HAF PROBLEM!
                $this->oCRNRSTN->error_log('DISK WRITE ERROR. Disk space exceeds ' . $this->oCRNRSTN->get_disk_performance_metric('maximum_disk_use') . '% minimum allocation of free space. Directory creation of [' . $directory . '] has been stopped. CRNRSTN :: is configured to stop system writes when allocation of free space on disk exceeds specified limits.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY_DISK);

                throw new Exception('DISK WRITE ERROR. Disk space exceeds ' . $this->oCRNRSTN->get_disk_performance_metric('maximum_disk_use') . '% minimum allocation of free space. Directory creation of [' . $directory . '] has been stopped. CRNRSTN :: is configured to stop system writes when allocation of free space on disk exceeds specified limits.');

            }

            if($recursive_perms_override == true){

                //
                // A SOLID APPLICATION OF THE DESIRED PERMISSIONS RECURSIVELY TO ALL (NESTED) DIRECTORIES.
                return $this->mkdir_r($directory, $permissions_chmod, $context, $recursive_perms_override, $channel);

            }

            // A TEST. DIE();
            if(chmod($directory, $permissions_chmod)){

                error_log(__LINE__ . ' asset mgr chmod SUCCESS $directory[' . $directory . '] die();');

            }else{

                $error = error_get_last();
                error_log(__LINE__ . ' asset mgr chmod ERROR. A DIRECTORY RTRIM IS NEEDED. $directory[' . $directory . ']. error[' . $error . ']. die();');

            }

            //
            // WE SHALL RETURN TO THIS...BUT, WE REALLY NEED DATABASE ON
            // DECK TO SUPPORT FILE AND DIRECTORY STUFF. FOR SIMPLE
            // DIRECTORY VIEWS...WITH NO DATABASE, I WOULD HAVE TO SPIN
            // THE PLATTER 100% EVERY TIME...OTHERWISE.
            //
            // ALSO...WE WILL SUPPORT AJAX POWERED FULL SERVER FILE
            // SYSTEM SEARCHES IN BROWSER!!
            //
            // ...BEEN CRUSHING FILE SYSTEM MGMT AND INPUT VALIDATION
            // FOR LIKE 2 WEEKS NOW...TRYING TO GET SQUARED UP
            // FOR DATABASE.
            //
            // Friday, October, 13, 2023 @ 0058 hrs.
            die();

            $this->oCRNRSTN->err_message_queue_push(NULL, __CLASS__ . '::' . __METHOD__ . '() attempted to mkdir ' . $directory . ', but ');
            if(mkdir($directory, $permissions_chmod, $recursive_perms_override, $context)){

                $this->oCRNRSTN->err_message_queue_clear();

            }else{

                //
                // LOG ERROR.
                $error = error_get_last();
                $this->oCRNRSTN->error_log('CRNRSTN :: has experienced an error making the target directory, [' . $directory . '], using the permissions, [' . $permissions_chmod . ']. Error: ' . $error['message']);

                //
                // ATTEMPT TO CHANGE PERMISSIONS, AND TRY ONCE MORE
                // BEFORE COMPLETELY GIVING UP.
                $this->oCRNRSTN->error_log('CRNRSTN :: is attempting to modify directory permissions to ' . str_pad($permissions_chmod,'4', '0',STR_PAD_LEFT) . ' for write access at, ' . $directory . '.');

                //
                // TODO :: FOR THIS TO WORK (ON THE PARENT FOLDER...?), WE WOULD NEED TO TRIM 1 DIRECTORY FROM THE FINAL PATH...RIGHT?
                // THIS SHOULD ERROR WITH DIRECTORY NOT FOUND...IF WE NEED TO PERFORM A FOLDER RTRIM()...CORRECT?.
                $this->oCRNRSTN->err_message_queue_push(NULL, __CLASS__ . '::' . __METHOD__ . '() attempted to chmod ' . str_pad($permissions_chmod,'4', '0',STR_PAD_LEFT) . ' the write permissions to related to ' . $directory . ', but ');
                if(chmod($directory, $permissions_chmod)){

                    $this->oCRNRSTN->err_message_queue_clear();

                    //
                    // ANOTHER ATTEMPT TO WRITE AFTER MODIFICATION OF DIRECTORY PERMISSIONS.
                    $this->oCRNRSTN->err_message_queue_push(NULL, __CLASS__ . '::' . __METHOD__ . '() attempted to mkdir ' . $directory . ' after the write permissions to the same were chmod successfully to ' . str_pad($permissions_chmod, '4', '0', STR_PAD_LEFT) . '. A second attempt to create the directory was made, but ');
                    if(mkdir($directory, $permissions_chmod, $recursive_perms_override, $context)){

                        $this->oCRNRSTN->err_message_queue_clear();

                        $this->oCRNRSTN->error_log('Success. System creation of a new directory is now complete after repairing the file system\'s permissions. Directory: ' . $directory . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);

                    }else{

                        //
                        // LOG ERROR.
                        $error = error_get_last();

                        $this->oCRNRSTN->err_message_queue_clear();

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('mkdir() running on channel [' . $this->oCRNRSTN->get_channel_config($channel, 'NAME') . '] failed to mkdir [' . $directory . '], even after CRNRSTN :: attempted to repair the file system\'s permissions. Error: ' . $error['message']);

                    }

                    return true;

                }else{

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    $this->oCRNRSTN->error_log('Permission denied. The target directory, ' . $directory . ', could NOT be created with current permissions as ' . $permissions_chmod . '.');
                    $this->oCRNRSTN->print_r('Permission denied. The target file, ' . $directory . ', is NOT writable with current permissions as ' . $tmp_current_perms . '.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);

                    //
                    // LOG ERROR.
                    $error = error_get_last();

                    $this->oCRNRSTN->err_message_queue_clear();

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Permission denied. mkdir() running on channel [' . $channel . '] failed to complete the creation of [' . $directory . '] at the call of mkdir(' . $tmp_directory . '), even after CRNRSTN :: attempted to repair the file system\'s permissions. Error: ' . $error['message']);

                }

            }

            return true;

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    //
    // SOURCE :: http://php.net/manual/en/function.mkdir.php
    // AUTHOR :: kungla at gmail dot com :: http://php.net/manual/en/function.mkdir.php#68207
    private function mkdir_r($directory, $permissions_override, $context, $recursive_perms_override, $channel){

        try{

            $permissions_override = octdec(str_pad($permissions_override, 4, '0', STR_PAD_LEFT));
            $permissions_override = (int) $permissions_override;

            $tmp_directory_ARRAY = explode('/', $directory);
            $tmp_directory = '';

            foreach($tmp_directory_ARRAY as $tmp_path_chunk){

                $tmp_directory .= $tmp_path_chunk . '/';

                if(!is_dir($tmp_directory) && strlen($tmp_directory) > 0){

                    $this->oCRNRSTN->err_message_queue_push(NULL, __CLASS__ . '::' . __METHOD__ . '() attempted to mkdir ' . $directory . ', but ');
                    if(mkdir($tmp_directory, $permissions_override, $recursive_perms_override, $context)){

                        $this->oCRNRSTN->err_message_queue_clear();

                    }else{

                        //
                        // LOG ERROR.
                        $error = error_get_last();

                        $this->oCRNRSTN->error_log('CRNRSTN :: has experienced an error making the target directory, [' . $tmp_directory . '], using the permissions, [' . $permissions_override . ']. Error: ' . $error['message']);

                        //
                        // ATTEMPT TO CHANGE PERMISSIONS, AND TRY ONCE MORE
                        // BEFORE COMPLETELY GIVING UP.
                        $this->oCRNRSTN->error_log('CRNRSTN :: is attempting to modify directory permissions to ' . str_pad($permissions_override,'4', '0',STR_PAD_LEFT) . ' for write access at, ' . $tmp_directory . '.');

                        //
                        // TODO :: FOR THIS TO WORK (ON THE PARENT FOLDER...?), WE WOULD NEED TO TRIM 1 DIRECTORY FROM THE FINAL PATH...RIGHT?
                        // THIS SHOULD ERROR WITH DIRECTORY NOT FOUND...IF WE NEED TO PERFORM A FOLDER RTRIM()...CORRECT?.
                        $this->oCRNRSTN->err_message_queue_push(NULL, __CLASS__ . '::' . __METHOD__ . '() attempted to chmod ' . str_pad($permissions_override,'4', '0',STR_PAD_LEFT) . ' the write permissions to related to ' . $tmp_directory . ', but ');
                        if(chmod($tmp_directory, $permissions_override)){

                            $this->oCRNRSTN->err_message_queue_clear();

                            //
                            // ANOTHER ATTEMPT TO WRITE AFTER MODIFICATION OF DIRECTORY PERMISSIONS.
                            $this->oCRNRSTN->err_message_queue_push(NULL, __CLASS__ . '::' . __METHOD__ . '() attempted to mkdir ' . $tmp_directory . ' after the write permissions to the same were chmod successfully to ' . str_pad($permissions_override, '4', '0', STR_PAD_LEFT) . '. A second attempt to create the directory was made, but ');
                            if(mkdir($tmp_directory, $permissions_override, $recursive_perms_override, $context)){

                                $this->oCRNRSTN->err_message_queue_clear();

                                $this->oCRNRSTN->error_log('Success. System creation of a new directory is now complete after repairing the file system\'s permissions. Directory: ' . $tmp_directory . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);

                            }else{

                                //
                                // LOG ERROR.
                                $error = error_get_last();

                                $this->oCRNRSTN->err_message_queue_clear();

                                //
                                // HOOOSTON...VE HAF PROBLEM!
                                throw new Exception('mkdir() running on channel [' . $channel . '] failed to complete the creation of [' . $directory . '] at the call of mkdir(' . $tmp_directory . '), even after CRNRSTN :: attempted to repair the file system\'s permissions. Error: ' . $error['message']);

                            }

                            return true;

                        }else{

                            //
                            // LOG ERROR.
                            $error = error_get_last();

                            $this->oCRNRSTN->err_message_queue_clear();

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('Permission denied. mkdir() running on channel [' . $channel . '] failed to complete the creation of [' . $directory . '] at the call of mkdir(' . $tmp_directory . '), even after CRNRSTN :: attempted to repair the file system\'s permissions. Error: ' . $error['message']);

                        }

                    }

                }

            }

            return true;

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    // movedir <-- NO!
    // If you wish to move a file, use the rename() function.

    // copy
    // (PHP 4, PHP 5, PHP 7, PHP 8)
    //
    // copy — Copies file
    // copy(string $from, string $to, ?resource $context = null): bool

    // rename
    // (PHP 4, PHP 5, PHP 7, PHP 8)
    //
    // rename — Renames a file or directory
    // rename(string $from, string $to, ?resource $context = null): bool

    // rmdir
    // (PHP 4, PHP 5, PHP 7, PHP 8)
    //
    // rmdir — Removes directory
    // rmdir(string $directory, ?resource $context = null): bool

    // unlink
    // (PHP 4, PHP 5, PHP 7, PHP 8)
    //
    // unlink — Deletes a file
    // unlink(string $filename, ?resource $context = null): bool

    public function fwrite($file_data, $file_path, $permissions_override, $length_override, $stream_override, $job_title, $job_description, $channel = CRNRSTN_AUTHORIZE_RUNTIME){

        try{

            //
            // CRNRSTN :: CONFIGURED SYSTEM PERMISSIONS.
            $permissions_chmod = $permissions_override;
            if(!isset($permissions_override)){

                $permissions_chmod = $this->oCRNRSTN->get_resource('permissions_chmod', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

            }

            //
            // NEW IMAGES WILL NOT HAVE BASE64 FILE BY DEFAULT, AND fileperms() WILL THEN THROW PHP WARNING.
            $tmp_current_perms = '';
            if(is_file($file_path)){

                $tmp_current_perms = substr(decoct(fileperms($file_path)), 2);

            }

            //
            // BYTES REQUIRED FOR FILE WRITE.
            $tmp_minimum_bytes_required = $length_override;
            if(!isset($length_override)){

                //
                // CALCULATE MINIMUM BYTES REQUIRED FOR NEW FILE.
                $tmp_minimum_bytes_required = strlen($file_data);

            }

            //
            // ASK CRNRSTN :: TO GRANT PERMISSIONS FOR fwrite().
            // WARNINGS WILL BE THROWN @ $oCRNRSTN->max_disk_storage_utilization_warning() PERCENTAGE.
            // WRITE REQUESTS WILL BE DENIED @ $oCRNRSTN->max_disk_storage_utilization() PERCENTAGE.
            if(!$this->oCRNRSTN->grant_permissions_fwrite($file_path, $tmp_minimum_bytes_required)){

                //
                // HOOOSTON...VE HAF PROBLEM!
                $this->oCRNRSTN->error_log('DISK WRITE ERROR. Disk space exceeds ' . $this->oCRNRSTN->get_disk_performance_metric('maximum_disk_use') . '% minimum allocation of free space. File write [' . $file_path . '] stopped. CRNRSTN :: is configured to stop file writes when allocation of free space on disk exceeds specified limits.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY_DISK);

                //$this->oCRNRSTN->print_r('DISK WRITE ERROR. Disk space exceeds ' . $this->oCRNRSTN->get_disk_performance_metric('maximum_disk_use') . '% minimum allocation of free space. File write stopped. CRNRSTN :: is configured to stop file writes when allocation of free space on disk exceeds specified limits.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);

                throw new Exception('DISK WRITE ERROR. Disk space exceeds ' . $this->oCRNRSTN->get_disk_performance_metric('maximum_disk_use') . '% minimum allocation of free space. File write [' . $file_path . '] stopped. CRNRSTN :: is configured to stop file writes when allocation of free space on disk exceeds specified limits.');

            }

            $this->oCRNRSTN->err_message_queue_push(NULL, __CLASS__ . '::' . __METHOD__ . '() attempted to open (write access) ' . $file_path . ', but ');
            if($resource_file = fopen($file_path, 'w')){

                $this->oCRNRSTN->err_message_queue_clear();

                $this->oCRNRSTN->err_message_queue_push(NULL, __CLASS__ . '::' . __METHOD__ . '() attempted to write ' . $file_path . ', but ');
                fwrite($resource_file, $file_data);
                fclose($resource_file);
                $this->oCRNRSTN->err_message_queue_clear();

                //
                // ADJUST FILE PERMISSIONS.
                chmod($file_path, $permissions_chmod);

            }else{

                //$this->oCRNRSTN->print_r('SYSTEM FILE WRITE...ERROR!! [' . $tmp_filename. '].', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
                $this->oCRNRSTN->error_log('CRNRSTN :: has experienced a permissions related error as the target file, ' . $file_path . ', is NOT writable with current permissions as ' . $tmp_current_perms . '.');
                //$this->oCRNRSTN->print_r('CRNRSTN :: has experienced a permissions related error as the target file, ' . $file_path . ', is NOT writable with current permissions as ' . $tmp_current_perms . '.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);

                //
                // ATTEMPT TO CHANGE PERMISSIONS AND CHECK AGAIN
                // BEFORE COMPLETELY GIVING UP
                $this->oCRNRSTN->error_log('Attempting to modify permissions to ' . str_pad($permissions_chmod,'4', '0',STR_PAD_LEFT) . ' for file write at, ' . $file_path . '. The current permissions, ' . $tmp_current_perms . ', at file for CRNRSTN :: render the file NOT to be writable.');
                //$this->oCRNRSTN->print_r('Attempting to modify permissions to ' . str_pad($permissions_chmod,'4', '0',STR_PAD_LEFT) . ' for file write at, ' . $file_path . '. The current permissions, ' . $tmp_current_perms . ', at file for CRNRSTN :: render the file NOT to be writable.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);

                //$this->oCRNRSTN->err_message_queue_push(NULL, 'CRNRSTN :: has experienced permissions related error as the destination file, ' . $file_path . ' (' . $tmp_current_perms . '), is NOT writable to ' . str_pad($permissions_chmod,'4', '0',STR_PAD_LEFT) . ', and furthermore ');
                $this->oCRNRSTN->err_message_queue_push(NULL, __CLASS__ . '::' . __METHOD__ . '() attempted to chmod ' . str_pad($permissions_chmod,'4', '0',STR_PAD_LEFT) . ' the write permissions to related to ' . $file_path . ', currently [' . $tmp_current_perms . '], but ');
                if(chmod($file_path, $permissions_chmod)){

                    $this->oCRNRSTN->err_message_queue_clear();

                    //
                    // ANOTHER ATTEMPT TO WRITE AFTER MODIFICATION OF FILE PERMISSIONS
                    $this->oCRNRSTN->err_message_queue_push(NULL, __CLASS__ . '::' . __METHOD__ . '() attempted to fopen ' . $file_path . ' after the write permissions to related to same were first chmod to ' . str_pad($permissions_chmod, '4', '0', STR_PAD_LEFT) . '. An attempt to open was again made, but ');
                    if($resource_file = fopen($file_path, 'w')){

                        $this->oCRNRSTN->err_message_queue_clear();

                        fwrite($resource_file, $tmp_data_str_out);
                        fclose($resource_file);

                        //
                        // TODO :: GET PERMISSIONS FROM SYSTEM DEFAULT.
                        // ADJUST FILE PERMISSIONS
                        chmod($file_path, $permissions_chmod);

                        $this->oCRNRSTN->error_log('Success. System write of BASE64 file is complete, after repairing the file system\'s permissions. File: ' . $tmp_filename . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);

                    }

                    return true;

                }else{

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    $this->oCRNRSTN->error_log('Permission denied. The target file, ' . $file_path . ', is NOT writable with current permissions as ' . $tmp_current_perms . '.');
                    $this->oCRNRSTN->print_r('Permission denied. The target file, ' . $file_path . ', is NOT writable with current permissions as ' . $tmp_current_perms . '.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);

                }

            }

            // THE BASE64 OUTPUT WRITTEN TO FILE
            $this->oCRNRSTN->print_r($tmp_data_str_out, self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64][self::$request_salt]['filename'] . ' :: BASE64 CHECK.', NULL, __LINE__, __METHOD__, __FILE__);

            return true;

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    //
    // SOURCE :: http://php.net/manual/en/function.readfile.php
    public function readfile_chunked($filename, $retbytes = true){

        $chunksize = 1 * (1024 * 1024); // how many bytes per chunk

        $buffer = '';
        $cnt = 0;

        // $handle = fopen($filename, 'rb');
        $handle = fopen($filename, 'rb');

        if($handle === false){

            return false;

        }

        while(!feof($handle)){

            $buffer = fread($handle, $chunksize);

            echo $buffer;

            if($retbytes){

                $cnt += strlen($buffer);

            }

        }

        $status = fclose($handle);

        if($retbytes && $status){

            return $cnt; // return num. bytes delivered like readfile() does.

        }

        return $status;

    }

    //
    // SOURCE :: https://stackoverflow.com/questions/11923235/scandir-to-sort-by-date-modified
    // COMMENT :: https://stackoverflow.com/a/56280493
    // AUTHOR :: Giacomo1968 :: https://stackoverflow.com/users/117259/giacomo1968
    public function better_scandir($directory, $sorting_order, $context, $secondary_asort, $descending_arsort, $channel){

        /*
        https://www.php.net/manual/en/function.scandir.php

        WHERE $sorting_order =
        SCANDIR_SORT_ASCENDING
        SCANDIR_SORT_DESCENDING
        SCANDIR_SORT_NONE

        By default, the sorted order is alphabetical in ascending order. If the
        optional sorting_order is set to SCANDIR_SORT_DESCENDING, then the sort order
        is alphabetical in descending order. If it is set to SCANDIR_SORT_NONE
        then the result is unsorted.

        WHERE $secondary_asort =
        SORT_REGULAR - compare items normally; the details are described in the comparison operators section
        SORT_NUMERIC - compare items numerically
        SORT_STRING - compare items as strings
        SORT_LOCALE_STRING - compare items as strings, based on the current locale. It uses the locale, which can be changed using setlocale()
        SORT_NATURAL - compare items as strings using "natural ordering" like natsort()
        SORT_FLAG_CASE - can be combined (bitwise OR) with SORT_STRING or SORT_NATURAL to sort strings case-insensitively

        */

        /****************************************************************************/
        // Roll through the scandir values.
        $files = array();
        $tmp_ARRAY = scandir($directory, $sorting_order);
        foreach($tmp_ARRAY as $file){

            if($file[0] === '.'){

                continue;

            }

            //$files[$file] = filemtime($directory . '/' . $file);
            $files[$file] = $file;

        } // foreach

        /****************************************************************************/
        // Sort the files array.
        if($descending_arsort){

            if(isset($secondary_asort)){

                arsort($files, $secondary_asort);

            }else{

                arsort($files, SORT_STRING);

            }

        }else{

            if($sorting_order == SCANDIR_SORT_ASCENDING){

                asort($files, SORT_STRING);

            }else{

                if(isset($secondary_asort)){

                    asort($files, $secondary_asort);

                }

            }

        }

        /****************************************************************************/
        // Set the final return value.
        $ret = array_keys($files);

        /****************************************************************************/
        // Return the final value.
        return ($ret) ? $ret : false;

    }

    private function system_base64_write(){

        try{

            $tmp_current_perms = '';
            $tmp_data_str_out = $this->return_system_base64_file_contents();

            $permissions_chmod = $this->oCRNRSTN->get_resource('permissions_chmod', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');
            $tmp_filepath = self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64][self::$request_salt]['path_filename'];
            $tmp_filename = self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64][self::$request_salt]['filename'];

            //
            // NEW IMAGES WILL NOT HAVE BASE64 FILE BY DEFAULT, AND fileperms() WILL THEN THROW PHP WARNING.
            if(is_file($tmp_filepath)){

                $tmp_current_perms = substr(decoct(fileperms($tmp_filepath)), 2);

            }

            //
            // CALCULATE MINIMUM BYTES REQUIRED FOR NEW FILE
            $tmp_minimum_bytes_required = strlen($tmp_data_str_out);

            //
            // ASK CRNRSTN :: TO GRANT PERMISSIONS FOR fwrite()
            // WARNINGS WILL BE THROWN @ $oCRNRSTN->max_disk_storage_utilization_warning() PERCENTAGE.
            // WRITE REQUESTS WILL BE DENIED @ $oCRNRSTN->max_disk_storage_utilization() PERCENTAGE.
            if(!$this->oCRNRSTN->grant_permissions_fwrite($tmp_filepath, $tmp_minimum_bytes_required)){

                //
                // HOOOSTON...VE HAF PROBLEM!
                $this->oCRNRSTN->error_log('DISK WRITE ERROR. Disk space exceeds ' . $this->oCRNRSTN->get_disk_performance_metric('maximum_disk_use') . '% minimum allocation of free space. File write [' . $tmp_filepath . '] stopped. CRNRSTN :: is configured to stop file writes when allocation of free space on disk exceeds specified limits.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY_DISK);

                $this->oCRNRSTN->print_r('DISK WRITE ERROR. Disk space exceeds ' . $this->oCRNRSTN->get_disk_performance_metric('maximum_disk_use') . '% minimum allocation of free space. File write stopped. CRNRSTN :: is configured to stop file writes when allocation of free space on disk exceeds specified limits.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);

                throw new Exception('DISK WRITE ERROR. Disk space exceeds ' . $this->oCRNRSTN->get_disk_performance_metric('maximum_disk_use') . '% minimum allocation of free space. File write [' . $tmp_filepath . '] stopped. CRNRSTN :: is configured to stop file writes when allocation of free space on disk exceeds specified limits.');

            }

            $this->oCRNRSTN->err_message_queue_push(NULL, __CLASS__ . '::' . __METHOD__ . '() attempted to open ' . $tmp_filepath . ', but ');
            if($resource_file = fopen($tmp_filepath, 'w')){

                $this->oCRNRSTN->err_message_queue_clear();

                fwrite($resource_file, $tmp_data_str_out);
                fclose($resource_file);

                //
                // TODO :: GET PERMISSIONS FROM SYSTEM DEFAULT.
                // ADJUST FILE PERMISSIONS
                chmod($tmp_filepath, $permissions_chmod);

                $this->oCRNRSTN->error_log('Success. System write of BASE64 file is complete. File: ' . $tmp_filename . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);

            }else{

                //$this->oCRNRSTN->print_r('SYSTEM FILE WRITE...ERROR!! [' . $tmp_filename. '].', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
                $this->oCRNRSTN->error_log('CRNRSTN :: has experienced permissions related error as the target file, ' . $tmp_filepath . ', is NOT writable with current permissions as ' . $tmp_current_perms . '.');
                $this->oCRNRSTN->print_r('CRNRSTN :: has experienced permissions related error as the target file, ' . $tmp_filepath . ', is NOT writable with current permissions as ' . $tmp_current_perms . '.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);

                //
                // ATTEMPT TO CHANGE PERMISSIONS AND CHECK AGAIN
                // BEFORE COMPLETELY GIVING UP
                $this->oCRNRSTN->error_log('Attempting to modify permissions to ' . str_pad($permissions_chmod,'4', '0',STR_PAD_LEFT) . ' for file write at, ' . $tmp_filepath . '. The current permissions, ' . $tmp_current_perms . ', at file for CRNRSTN :: render the file NOT to be writable.');
                $this->oCRNRSTN->print_r('Attempting to modify permissions to ' . str_pad($permissions_chmod,'4', '0',STR_PAD_LEFT) . ' for file write at, ' . $tmp_filepath . '. The current permissions, ' . $tmp_current_perms . ', at file for CRNRSTN :: render the file NOT to be writable.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);

                //$this->oCRNRSTN->err_message_queue_push(NULL, 'CRNRSTN :: has experienced permissions related error as the destination file, ' . $tmp_filepath . ' (' . $tmp_current_perms . '), is NOT writable to ' . str_pad($permissions_chmod,'4', '0',STR_PAD_LEFT) . ', and furthermore ');
                $this->oCRNRSTN->err_message_queue_push(NULL, __CLASS__ . '::' . __METHOD__ . '() attempted to chmod ' . str_pad($permissions_chmod,'4', '0',STR_PAD_LEFT) . ' the write permissions to related to ' . $tmp_filepath . ', currently [' . $tmp_current_perms . '], but ');
                if(chmod($tmp_filepath, $permissions_chmod)){

                    $this->oCRNRSTN->err_message_queue_clear();

                    //
                    // ANOTHER ATTEMPT TO WRITE AFTER MODIFICATION OF FILE PERMISSIONS.
                    $this->oCRNRSTN->err_message_queue_push(NULL, __CLASS__ . '::' . __METHOD__ . '() attempted to fopen ' . $tmp_filepath . ' after the write permissions to related to same were first chmod to ' . str_pad($permissions_chmod, '4', '0', STR_PAD_LEFT) . '. An attempt to open was again made, but ');
                    if($resource_file = fopen($tmp_filepath, 'w')){

                        $this->oCRNRSTN->err_message_queue_clear();

                        fwrite($resource_file, $tmp_data_str_out);
                        fclose($resource_file);

                        //
                        // TODO :: GET PERMISSIONS FROM SYSTEM DEFAULT.
                        // ADJUST FILE PERMISSIONS
                        chmod($tmp_filepath, $permissions_chmod);

                        $this->oCRNRSTN->error_log('Success. System write of BASE64 file is complete. File: ' . $tmp_filename . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);

                    }

                    return true;

                }else{

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    $this->oCRNRSTN->error_log('Permission denied. The target file, ' . $tmp_filepath . ', is NOT writable with current permissions as ' . $tmp_current_perms . '.');
                    $this->oCRNRSTN->print_r('Permission denied. The target file, ' . $tmp_filepath . ', is NOT writable with current permissions as ' . $tmp_current_perms . '.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);

                }

            }

            // THE BASE64 OUTPUT WRITTEN TO FILE
            $this->oCRNRSTN->print_r($tmp_data_str_out, self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64][self::$request_salt]['filename'] . ' :: BASE64 CHECK.', NULL, __LINE__, __METHOD__, __FILE__);

            return true;

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    private function return_system_base64_file_contents(){

        $tmp_file_input_str = '';

        $tmp_ascii = $this->oCRNRSTN->return_CRNRSTN_ASCII_ART();
        $tmp_ascii = $this->oCRNRSTN->proper_replace('<span style="color:#F90000;">', '', $tmp_ascii);
        $tmp_ascii = $this->oCRNRSTN->proper_replace('</span>', '', $tmp_ascii);

        $has_png = false;
        $has_jpeg = false;

        $tmp_file_serial = self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64][self::$request_salt]['serial'];

        $tmp_lt = '<';

        //
        // BASE64 FILE HEADER :: July 30, 2022 @ 1908 hrs
        $tmp_file_input_str .= $tmp_lt . '?php
/*
// J5
// Code is Poetry */
# # C # R # N # R # S # T # N # : : # # # #
#
# CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . '
#
# DATE GENERATED: ' . $this->oCRNRSTN->return_micro_time() . '
# FILE NAME: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64][self::$request_salt]['filename'] . '
# FILE PATH: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64][self::$request_salt]['path_filename'] . '
# FILE SERIAL: ' . $tmp_file_serial . '
#
# SERVER IP: ' . $_SERVER['SERVER_ADDR'] . '
# CLIENT IP: ' . $this->oCRNRSTN->client_ip() . ' (' . $_SERVER['REMOTE_ADDR']. ')
# PHPSESSION: ' . session_id(). '
# GENERATING SERVER INFORMATION: ' . $this->oCRNRSTN->proper_version('LINUX') .
            ', ' . $this->oCRNRSTN->proper_version('APACHE') .
            ', ' . $this->oCRNRSTN->proper_version('MYSQLI') .
            ', ' . $this->oCRNRSTN->proper_version('PHP') .
            ', ' . $this->oCRNRSTN->proper_version('OPENSSL') .
            ', ' . $this->oCRNRSTN->proper_version('SOAP') . '
#';

        if(isset(self::$image_filesystem_meta_ARRAY[CRNRSTN_PNG][self::$request_salt]['base64']) || isset(self::$image_filesystem_meta_ARRAY[CRNRSTN_PNG][self::$request_salt]['arch_1.0_base64'])){

            $has_png = true;
            $tmp_file_input_str .= '
# # # # #
# PNG FILE (ORIGINAL) :: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_PNG][self::$request_salt]['filename'] . '
# PNG IMAGE DIMENSIONS: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_PNG][self::$request_salt]['image_dimensions'] . '
# PNG FILE EXTENSION: ' . pathinfo(self::$image_filesystem_meta_ARRAY[CRNRSTN_PNG][self::$request_salt]['path_filename'], PATHINFO_EXTENSION) . '
# PNG FILE MIME TYPE: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_PNG][self::$request_salt]['mime_content_type'] . '
# PNG FILE PATH: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_PNG][self::$request_salt]['path_filename'] . '
# PNG FILE SIZE: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_PNG][self::$request_salt]['filesize'] . '
# PNG FILE LAST MODIFIED: ' . date("Y-m-d H:i:s", self::$image_filesystem_meta_ARRAY[CRNRSTN_PNG][self::$request_salt]['filemtime']) . '
# PNG FILE MD5: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_PNG][self::$request_salt]['md5'] . '
# PNG FILE SHA1: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_PNG][self::$request_salt]['sha1'] . '
# PNG FILE ENCODED LENGTH (BASE64): ' . $this->oCRNRSTN->number_format_keep_precision(strlen(self::$image_filesystem_meta_ARRAY[CRNRSTN_PNG][self::$request_salt]['base64'])) . ' bytes
# PROFILE ACCESS: ANONYMOUS
# ACCESS TYPE: BASIC
#';

        }

        //
        // WE HAVE $base64_encode_png AND $base64_encode_jpg TO CHECK AGAINST THE BASE64 $TMP_STR[] SITUATION
        // THAT YOU SAID YOU'D TAKE CARE OF, REAL QUICK.
        if(isset(self::$image_filesystem_meta_ARRAY[CRNRSTN_JPEG][self::$request_salt]['base64']) || isset(self::$image_filesystem_meta_ARRAY[CRNRSTN_JPEG][self::$request_salt]['arch_1.0_base64'])){

            $has_jpeg = true;
            $tmp_file_input_str .= '
# # # # #
# JPEG FILE (ORIGINAL) :: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_JPEG][self::$request_salt]['filename'] . '
# JPEG IMAGE DIMENSIONS: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_JPEG][self::$request_salt]['image_dimensions'] . '
# JPEG FILE EXTENSION: ' . pathinfo(self::$image_filesystem_meta_ARRAY[CRNRSTN_JPEG][self::$request_salt]['path_filename'], PATHINFO_EXTENSION) . '
# JPEG FILE MIME TYPE: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_JPEG][self::$request_salt]['mime_content_type'] . '
# JPEG FILE PATH: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_JPEG][self::$request_salt]['path_filename'] . '
# JPEG FILE SIZE: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_JPEG][self::$request_salt]['filesize'] . '
# JPEG FILE LAST MODIFIED: ' . date("Y-m-d H:i:s", self::$image_filesystem_meta_ARRAY[CRNRSTN_JPEG][self::$request_salt]['filemtime']) . '
# JPEG FILE MD5: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_JPEG][self::$request_salt]['md5'] . '
# JPEG FILE SHA1: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_JPEG][self::$request_salt]['sha1'] . '
# JPEG FILE ENCODED LENGTH (BASE64): ' . $this->oCRNRSTN->number_format_keep_precision(strlen(self::$image_filesystem_meta_ARRAY[CRNRSTN_JPEG][self::$request_salt]['base64'])) . ' bytes
# PROFILE ACCESS: ANONYMOUS
# ACCESS TYPE: BASIC
#
# # # # #
';

        }
        /*
        //
        // July 31, 2022 @ 0259 hrs :: EVIFWEB IP INTEGRATIONS FOR (PNG/JPG)BASE64 .PHP FILE MANAGEMENT
        $tmp_client_dir = substr(self::$oUser->retrieve_Form_Data("CLIENT_ID"), 0, -25);
        $tmp_assetSerial = self::$oUser->generateNewKey(50);

        $tmp_name = explode(\'.\', $_FILES[\'assetfile\'][\'name\']);

        $this->oCRNRSTN->assetParams[\'FILE_EXT\'] = strtolower(array_pop($tmp_name));
        $this->oCRNRSTN->assetParams[\'FILE_MIME_TYPE\'] = mime_content_type($_FILES["assetfile"]["tmp_name"]);
        $this->oCRNRSTN->assetParams[\'FILE_MD5\'] = md5_file($_FILES["assetfile"]["tmp_name"]);  // 32
        $this->oCRNRSTN->assetParams[\'FILE_SHA1\'] = sha1_file($_FILES["assetfile"]["tmp_name"]);  // 40
        error_log("assetmgr (954) sha1[".$this->oCRNRSTN->assetParams[\'FILE_SHA1\']."] len[".strlen($this->oCRNRSTN->assetParams[\'FILE_SHA1\'])."]");

        */

        if(!isset(self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_PNG][self::$request_salt][$this->system_file_serial]['datecreated_base64_PNG'])){

            self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_PNG][self::$request_salt][$this->system_file_serial]['datecreated_base64_PNG'] = $this->oCRNRSTN->return_micro_time();

        }

        if(!isset(self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_JPEG][self::$request_salt][$this->system_file_serial]['datecreated_base64_JPEG'])){

            self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_JPEG][self::$request_salt][$this->system_file_serial]['datecreated_base64_JPEG'] = $this->oCRNRSTN->return_micro_time();

        }

        if(!isset(self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_PNG][self::$request_salt][$this->system_file_serial]['lastmodified_base64_PNG'])){

            self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_PNG][self::$request_salt][$this->system_file_serial]['lastmodified_base64_PNG'] = $this->oCRNRSTN->return_micro_time();

        }

        $tmp_val = self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_PNG][self::$request_salt][$this->system_file_serial]['lastmodified_base64_PNG'];

        if(!isset($tmp_val) || ($tmp_val == '')){

            //$this->oCRNRSTN->print_r('lastmodified_base64_PNG BEING UPDATED.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
            self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_PNG][self::$request_salt][$this->system_file_serial]['lastmodified_base64_PNG'] = $this->oCRNRSTN->return_micro_time();

        }

        if(!isset(self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_JPEG][self::$request_salt][$this->system_file_serial]['lastmodified_base64_JPEG'])){

            self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_JPEG][self::$request_salt][$this->system_file_serial]['lastmodified_base64_JPEG'] = $this->oCRNRSTN->return_micro_time();

        }

        $tmp_val = self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_JPEG][self::$request_salt][$this->system_file_serial]['lastmodified_base64_JPEG'];

        if(!isset($tmp_val) || ($tmp_val == '')){

            //$this->oCRNRSTN->print_r('lastmodified_base64_JPEG BEING UPDATED.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
            self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_JPEG][self::$request_salt][$this->system_file_serial]['lastmodified_base64_JPEG'] = $this->oCRNRSTN->return_micro_time();

        }


        $tmp_file_input_str .= '/*
' . $tmp_ascii . '*/


$system_file_serial = \'' . $tmp_file_serial . '\';

switch(self::$image_output_mode){
    case CRNRSTN_BASE64_JPEG:

        //
        // BASE64 ENCODE OF JPG';
        if($has_jpeg){

            $tmp_file_input_str .= '
        self::$image_filesystem_meta_ARRAY[self::$image_output_mode][self::$request_salt][$system_file_serial][\'datecreated_base64_JPEG\'] = \'' . self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_JPEG][self::$request_salt][$this->system_file_serial]['datecreated_base64_JPEG'] . '\';
        self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_JPEG][self::$request_salt][$system_file_serial][\'base64\'] = \'' . self::$image_filesystem_meta_ARRAY[CRNRSTN_JPEG][self::$request_salt]['base64'] . '\';
';

        }

        $tmp_file_input_str .= '
    break;
    default:

        //
        // BASE64 ENCODE OF PNG';
        if($has_png){

            $tmp_file_input_str .= '
        self::$image_filesystem_meta_ARRAY[self::$image_output_mode][self::$request_salt][$system_file_serial][\'datecreated_base64_PNG\'] = \'' . self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_PNG][self::$request_salt][$this->system_file_serial]['datecreated_base64_PNG'] . '\';
        self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_PNG][self::$request_salt][$system_file_serial][\'base64\'] = \'' . self::$image_filesystem_meta_ARRAY[CRNRSTN_PNG][self::$request_salt]['base64'] . '\';
';

        }

        $tmp_file_input_str .= '
    break;

}

//
// BASE64 LAST MODIFIED
';
        if($has_png){

            $tmp_file_input_str .= 'self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_PNG][self::$request_salt][$system_file_serial][\'lastmodified_base64_PNG\'] = \'' . self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_PNG][self::$request_salt][$this->system_file_serial]['lastmodified_base64_PNG'] . '\';';

        }

        if($has_jpeg){

            $tmp_file_input_str .= '
self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_JPEG][self::$request_salt][$system_file_serial][\'lastmodified_base64_JPEG\'] = \'' . self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_JPEG][self::$request_salt][$this->system_file_serial]['lastmodified_base64_JPEG'] . '\';

';

        }

        $tmp_file_input_str .= '//
// BASE64 HASH/CHECKSUM
';
        if($has_png){

            $tmp_file_input_str .= 'self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_PNG][self::$request_salt][$system_file_serial][\'base64_crc\'] = \'' . $this->oCRNRSTN->hash(self::$image_filesystem_meta_ARRAY[CRNRSTN_PNG][self::$request_salt]['base64'], 'crc32') . '\';
self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_PNG][self::$request_salt][$system_file_serial][\'base64_md5\'] = \'' . $this->oCRNRSTN->hash(self::$image_filesystem_meta_ARRAY[CRNRSTN_PNG][self::$request_salt]['base64'], 'md5') . '\';
';

        }

        if($has_jpeg){

            $tmp_file_input_str .= '
self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_JPEG][self::$request_salt][$system_file_serial][\'base64_crc\'] = \'' . $this->oCRNRSTN->hash(self::$image_filesystem_meta_ARRAY[CRNRSTN_JPEG][self::$request_salt]['base64'], 'crc32') . '\';
self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_JPEG][self::$request_salt][$system_file_serial][\'base64_md5\'] = \'' . $this->oCRNRSTN->hash(self::$image_filesystem_meta_ARRAY[CRNRSTN_JPEG][self::$request_salt]['base64'], 'md5') . '\';

';

        }

        $tmp_file_input_str .= '//
// HASHES FOR BASE64 SOURCE PNG FILE
';
        if($has_png){

            $tmp_file_input_str .= 'self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_PNG][self::$request_salt][$system_file_serial][\'md5\'] = \'' . self::$image_filesystem_meta_ARRAY[CRNRSTN_PNG][self::$request_salt]['md5'] . '\';';
            $tmp_file_input_str .= '
self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_PNG][self::$request_salt][$system_file_serial][\'sha1\'] = \'' . self::$image_filesystem_meta_ARRAY[CRNRSTN_PNG][self::$request_salt]['sha1'] . '\';

';

        }

        $tmp_file_input_str .= '//
// HASHES FOR BASE64 SOURCE JPEG FILE
';
        if($has_jpeg){

            $tmp_file_input_str .= 'self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_JPEG][self::$request_salt][$system_file_serial][\'md5\'] = \'' . self::$image_filesystem_meta_ARRAY[CRNRSTN_JPEG][self::$request_salt]['md5'] . '\';';
            $tmp_file_input_str .= '
self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_JPEG][self::$request_salt][$system_file_serial][\'sha1\'] = \'' . self::$image_filesystem_meta_ARRAY[CRNRSTN_JPEG][self::$request_salt]['sha1'] . '\';';

        }

        $tmp_file_input_str .= '


# # # # #
# # # # # END OF CRNRSTN :: GENERATED SYSTEM FILE
# # # # # [' . $this->oCRNRSTN->return_micro_time() . '] [rtime ' . $this->oCRNRSTN->wall_time() . ']
';

        return $tmp_file_input_str;

    }

    private function system_base64_file_synchronized(){

        //
        // ATTEMPT TO READ CURRENT BASE64 SITUATION FOR A CHECK.
        $tmp_base64_content_delta = 0;
        if(is_file(self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64][self::$request_salt]['path_filename'])){

            self::$image_filesystem_meta_ARRAY[CRNRSTN_PNG][self::$request_salt]['arch_1.0_base64'] = '';
            $tmp_curr_output_mode = self::$image_output_mode;

            //
            // MANUALLY CHANGE MODE. A PRIVILEGE OF SYSTEM MAINTENANCE. (THEN PUT IT BACK.)
            self::$image_output_mode = CRNRSTN_BASE64_PNG;

            //
            // IS BASE64 ACCURATE? [PNG]
            include(self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64][self::$request_salt]['path_filename']);

            self::$image_output_mode = $tmp_curr_output_mode;

            if(isset($system_file_serial)){

                //$this->oCRNRSTN->print_r('GETTING ON THAT NEW BASE64 DATA ARCH.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);

                $this->system_file_serial = $system_file_serial;

//                // HOW BASE64 DATA WANTS TO BE HANDLED
//                if(isset(self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_PNG][self::$request_salt][$system_file_serial]['base64'])){
//
//                    $tmp_bpng = self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_PNG][self::$request_salt][$system_file_serial]['base64'];
//                    //$this->oCRNRSTN->print_r('BASE64 [PNG] CHECKSUM = [' . print_r($this->oCRNRSTN->crcINT($tmp_bpng), true) . '].', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
//
//                }

            }

            //
            // MANUALLY CHANGE MODE. A PRIVILEGE OF SYSTEM MAINTENANCE. (THEN PUT IT BACK.)
            self::$image_output_mode = CRNRSTN_BASE64_JPEG;

            //
            // IS BASE64 ACCURATE? [JPEG]
            include(self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64][self::$request_salt]['path_filename']);

            //
            // ...(THEN PUT IT BACK.)
            self::$image_output_mode = $tmp_curr_output_mode;

            if(isset($system_file_serial)){

//                // HOW BASE64 DATA WANTS TO BE HANDLED
//                if(isset(self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_JPEG][self::$request_salt][$system_file_serial]['datecreated_base64_JPEG'])){
//
//                    $tmp_bj = self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_JPEG][self::$request_salt][$system_file_serial]['datecreated_base64_JPEG'];
//                    $this->oCRNRSTN->print_r('BASE64 [JPEG] datecreated_base64 = [' . print_r($tmp_bj, true) . '].', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
//
//                }

            }

            if(isset($tmp_str)){

                //$this->oCRNRSTN->print_r('PROCESSING OLD BASE64 DATA ARCH.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);

                $tmp_base64_content_delta++;
                self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_PNG][self::$request_salt][$this->system_file_serial]['base64'] = $tmp_str;
                self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_PNG][self::$request_salt][$this->system_file_serial]['base64_crc'] = $this->oCRNRSTN->crcINT($tmp_str);
                self::$image_filesystem_meta_ARRAY[CRNRSTN_PNG][self::$request_salt]['arch_1.0_base64'] = $tmp_str;

            }

        }

        //
        // LOAD (ATTEMPT TO) FILE META INTO MEMORY - PNG
        if($this->load_system_asset(CRNRSTN_PNG)){

            //$this->oCRNRSTN->print_r('SYSTEM LOADED PNG FILE [' . print_r(self::$image_filesystem_meta_ARRAY[CRNRSTN_PNG], true) . '].', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
            //$this->oCRNRSTN->error_log('System load of PNG file to check BASE64 file is complete. File: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_PNG][self::$request_salt]['filename'] . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);

            if(!$this->valid_system_asset(CRNRSTN_PNG, 'SYSTEM_BASE64')){

                if(isset(self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_PNG][self::$request_salt][$this->system_file_serial]['lastmodified_base64_PNG'])){

                    //$this->oCRNRSTN->print_r('lastmodified_base64_PNG WILL BE UPDATED.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
                    self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_PNG][self::$request_salt][$this->system_file_serial]['lastmodified_base64_PNG'] = '';

                }

                $this->oCRNRSTN->error_log('System BASE64 is NOT in sync with file: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_PNG][self::$request_salt]['filename'] . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);
                $tmp_base64_content_delta++;

            }

        }

        //
        // LOAD (ATTEMPT TO) FILE META INTO MEMORY - JPEG
        if($this->load_system_asset(CRNRSTN_JPEG)){

            //$this->oCRNRSTN->print_r('SYSTEM LOADED JPEG FILE [' . print_r(self::$image_filesystem_meta_ARRAY[CRNRSTN_JPEG], true) . '].', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
            //$this->oCRNRSTN->error_log('System load of JPEG file to check BASE64 file is complete. File: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_JPEG][self::$request_salt]['filename'] . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);

            if(!$this->valid_system_asset(CRNRSTN_JPEG, 'SYSTEM_BASE64')){

                if(isset(self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_JPEG][self::$request_salt][$this->system_file_serial]['lastmodified_base64_JPEG'])){

                    //$this->oCRNRSTN->print_r('lastmodified_base64_JPEG WILL BE UPDATED.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
                    self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_JPEG][self::$request_salt][$this->system_file_serial]['lastmodified_base64_JPEG'] = '';

                }

                $this->oCRNRSTN->error_log('System BASE64 is NOT in sync with file: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_JPEG][self::$request_salt]['filename'] . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);
                $tmp_base64_content_delta++;

            }

        }

        if($tmp_base64_content_delta > 0){

            return false;

        }

        return true;

    }

    public function system_base64_integrate($dir_filepath, $img_batch_size = 5){

        return true;

    }

    //
    // THIS COULD BE ITS OWN CLASS.
    // WE WILL TRY TO GET BEHIND system_base64_synchronize(), THO.
    // Tuesday, June 6, 2023 @ 1000 hrs.
    public function crnrstn_integrations_synchronize($tmp_sys_config_head_file_path, $http_path, $file_path, $data_authorization_profile, $ttl, $FILEPATH, $output_mode, $width, $height, $hyperlink, $alt, $title, $target){

        //
        // THIS WILL FIRE WHEN A REQUESTED ASSET IS MISSING FROM THE SYSTEM.
        // FOR LOCAL FILE SYSTEM INTEGRATIONS, MISSING ASSETS CAN INCLUDE
        // THE FOLLOWING RESOURCE TYPES:
        // - ANY REQUESTED BASE64 ENCODED FILE MISSING ITS STATIC AND
        //   PROPRIETARY CRNRSTN :: INTEGRATIONS PHP FILE.
        // - ANY DESIGNATED AND SILO'D INDEX (PLZ READ AS "A SHARD INDEX")
        //   RESOURCE PHP FILE THAT IS MISSING FROM CRNRSTN ::  FILE SYSTEM
        //   INTEGRATIONS. THIS FILE SERVES AS A ROBUST INTERNAL POINTER TO
        //   SPEED UP THE STATIC LOADING OF FILE META INCLUDING, BASE64,
        //   FILE HASH, FILE SIZE, LAST MODIFIED, DATE CREATED, AND MORE!
        // - ANY MANUAL REQUEST TO PROCESS ANY OF THE FOLLOWING:
        //      ~ A CRNRSTN :: SYSTEM, SOCIAL, OR META RESOURCE,
        //      ~ A LOCAL SYSTEM DIRECTORY,
        //      ~ A FTP ENDPOINT, OR
        //      ~ A CRNRSTN :: SOAP SERVICES ENDPOINT (ANOTHER CRNRSTN ::
        //        SUPPORTED WEBSITE,...INCLUDING LOCALHOST DEV.

        //
        // INITIALIZE FILE SYSTEM MANAGER. Tuesday, June 6, 2023 0230 hrs.
        $oFILE_SYSTEM_MGR = $this->oCRNRSTN->generate_file_system_manager();

        switch($output_mode){



        }

        $tmp_config_integrations_filename = $tmp_sys_config_head_file_path . '_' . basename($FILEPATH) . '.php';

        //
        // IS THERE AN EXISTING INTEGRATIONS FILE FOR THIS ENVIRONMENT.
        if(is_file($tmp_config_integrations_filename)){

            //$this->oCRNRSTN->error_log(' asset mgr READY TO WORK 4 U [' . get_class($oFILE_SYSTEM_MGR) . ']. $tmp_config_integrations_filename[' . $tmp_config_integrations_filename . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

        }else{

            //$this->oCRNRSTN->error_log(' asset mgr READY TO WORK 4 U [' . get_class($oFILE_SYSTEM_MGR) . ']. $tmp_config_integrations_filename[' . $tmp_config_integrations_filename . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

            /*
            [Wed Jun 07 05:49:14.683220 2023] [:error] [pid 14271] [client 172.16.225.1:64737] 15884 asset mgr READY TO WORK 4 U
            crnrstn_file_system_integrations_manager

            $tmp_config_integrations_filename
            /var/www/html/evifweb.com/_crnrstn/ui/imgs/favicon/integrations/_crnrstn_36628c868c48a8094b9c3f9fcd34b6ff38bb3248f573f8156035bf4ebd41fce5_favicon.ico.php

            */

        }

        //die();

        /*
        [Tue Jun 06 10:26:20.481870 2023] [:error] [pid 14274] [client 172.16.225.1:57951]
        15873 asset mgr READY TO WORK 4 U [crnrstn_file_system_integrations_manager].
        sys_config_head_file_path
        CURRENT ::
        /var/www/html/evifweb.com/_crnrstn/ui/imgs/favicon/integrations/_36628c868c48a8094b9c3f9fcd34b6ff38bb3248f573f8156035bf4ebd41fce5.php

        TARGET FOR INDEX FILE WHICH WILL THEN CONTAIN POINTERS TO THE FILE RESOURCE PHP FILES ::
        /var/www/html/evifweb.com/_crnrstn/ui/imgs/favicon/integrations/_crnrstn_36628c868c48a8094b9c3f9fcd34b6ff38bb3248f573f8156035bf4ebd41fce5_favicon.php

        */

        /*
        Monday, June 5, 2023 @ 1608 hrs.
            $tmp_sys_config_head_file_path,
            $http_path,
            $file_path,
            $data_authorization_profile,
            $ttl,
            $FILEPATH,
            $output_mode,
            $width,
            $height,
            $hyperlink,
            $alt,
            $title,
            $target

        */

    }

    public function system_base64_synchronize($data_key){

        //
        // WHERE $data_key FORMAT LIKE
        // 'SUCCESS_CHECK'
        // 'success_chk.png'
        // 'success_chk.jpg'
        // 'success_chk.jpeg'
        // 'success_chk.jpg2'
        // 'success_chk'

        $tmp_original_file_extension_clean = '';
        self::$request_salt = $this->oCRNRSTN->generate_new_key(26);
        //error_log(__LINE__. ' asset mgr $data_key[' . $data_key . '].');

        if(isset($data_key)){

            //if(strlen($data_key) > 0){
            //
            // IS THIS A SYSTEM KEY
            $tmp_system_data_profile_ARRAY = $this->return_creative_profile($data_key);

            if(is_array($tmp_system_data_profile_ARRAY)){

                /*
                $tmp_ARRAY['filename'] = $tmp_filename;
                $tmp_ARRAY['width'] = $tmp_width;
                $tmp_ARRAY['height'] = $tmp_height;
                $tmp_ARRAY['alt'] = $tmp_alt;
                $tmp_ARRAY['title'] = $tmp_title;
                $tmp_ARRAY['hyperlink'] = $tmp_link;
                $tmp_ARRAY['target'] = $tmp_target;

                */

                $img_name = $tmp_system_data_profile_ARRAY['filename'];

            }
            //}

        }

        if(!isset($img_name)){

            $img_name = $data_key;

            //
            // PARSE DATA KEY FOR FILE HANDLE
            $pos_dot = stripos($data_key, '.');
            if($pos_dot !== false){

                $img_name = '';

                //
                // WE HAVE POTENTIAL FILENAME DOT
                $tmp_filename = explode('.', $data_key);
                $tmp_original_file_extension_clean = array_pop($tmp_filename);   // $tmp_filename IS NOW ARRAY RETURN
                foreach($tmp_filename as $index_=> $val){

                    $img_name .= $val . '.';

                }

                $img_name = $this->oCRNRSTN->strrtrim($img_name, '.');

            }

        }

        $tmp_file_serial = $this->oCRNRSTN->generate_new_key(64, '01');
        $tmp_path_directory = $this->oCRNRSTN->get_resource('crnrstn_path_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');
        $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');

        //
        // SYSTEM IMAGES DIRECTORIES.
        self::$image_filesystem_meta_ARRAY[CRNRSTN_PNG][self::$request_salt]['dir'][] = $tmp_path_directory . '/' . $tmp_system_directory . '/ui/imgs/png/system/';
        self::$image_filesystem_meta_ARRAY[CRNRSTN_PNG][self::$request_salt]['dir'][] = $tmp_path_directory . '/' . $tmp_system_directory . '/ui/imgs/png/social/';
        self::$image_filesystem_meta_ARRAY[CRNRSTN_JPEG][self::$request_salt]['dir'][] = $tmp_path_directory . '/' . $tmp_system_directory . '/ui/imgs/jpg/system/';
        self::$image_filesystem_meta_ARRAY[CRNRSTN_JPEG][self::$request_salt]['dir'][] = $tmp_path_directory . '/' . $tmp_system_directory . '/ui/imgs/jpg/social/';
        self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64][self::$request_salt]['dir'][] = $tmp_path_directory . '/' . $tmp_system_directory . '/ui/imgs/base64/system/';
        self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64][self::$request_salt]['dir'][] = $tmp_path_directory . '/' . $tmp_system_directory . '/ui/imgs/base64/social/';

        for($i = 0; $i < 2; $i++){

            $tmp_dir_PNG = self::$image_filesystem_meta_ARRAY[CRNRSTN_PNG][self::$request_salt]['dir'][$i];
            $tmp_dir_JPEG = self::$image_filesystem_meta_ARRAY[CRNRSTN_JPEG][self::$request_salt]['dir'][$i];
            $tmp_dir_BASE64 = self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64][self::$request_salt]['dir'][$i];

            $tmp_img_type_ARRAY = array('png', 'jpg', 'jpeg', 'jpg2');
            foreach($tmp_img_type_ARRAY as $index => $img_type){

                switch(strtolower($img_type)){
                    case 'png':

                        if(strlen($tmp_original_file_extension_clean) < 1){

                            $tmp_file_extension_clean = 'png';

                        }else{

                            $tmp_file_extension_clean = $tmp_original_file_extension_clean;

                        }

                        //
                        // CHECK PNG IS VALID FILE
                        if($this->oCRNRSTN->validate_DIR_endpoint($tmp_dir_PNG, 'SOURCE')){

                            //
                            // DO WE HAVE A VALID FILE?
                            if(is_file($tmp_dir_PNG . $img_name . '.' . $tmp_file_extension_clean)){

                                self::$image_filesystem_meta_ARRAY[CRNRSTN_PNG][self::$request_salt]['filename'] = $img_name . '.' . $tmp_file_extension_clean;
                                self::$image_filesystem_meta_ARRAY[CRNRSTN_PNG][self::$request_salt]['path_filename'] = $tmp_dir_PNG . $img_name . '.' . $tmp_file_extension_clean;
                                self::$image_filesystem_meta_ARRAY[CRNRSTN_PNG][self::$request_salt]['image_dimensions'] = '';
                                self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64][self::$request_salt]['filename'] = $img_name . '.php';
                                self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64][self::$request_salt]['path_filename'] = $tmp_dir_BASE64 . $img_name . '.php';
                                self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64][self::$request_salt]['serial'] = $tmp_file_serial;

                                //
                                // PNG IS VALID. IS THERE A MATCHING JPG?
                                if($this->oCRNRSTN->validate_DIR_endpoint($tmp_dir_JPEG, 'SOURCE')){

                                    //
                                    // DO WE HAVE A VALID FILE?
                                    if(is_file($tmp_dir_JPEG . $img_name . '.jpg')){

                                        self::$image_filesystem_meta_ARRAY[CRNRSTN_JPEG][self::$request_salt]['filename'] = $img_name . '.jpg';
                                        self::$image_filesystem_meta_ARRAY[CRNRSTN_JPEG][self::$request_salt]['path_filename'] = $tmp_dir_JPEG . $img_name . '.jpg';
                                        self::$image_filesystem_meta_ARRAY[CRNRSTN_PNG][self::$request_salt]['image_dimensions'] = '';

                                        //
                                        // PNG IS FILE. JPG IS FILE.
                                        if(!$this->system_base64_file_synchronized()){

                                            return $this->system_base64_write();

                                        }

                                    }else{

                                        //
                                        // ONLY PNG IS FILE
                                        //$this->oCRNRSTN->print_r('VALID PNG FILE [' . $tmp_dir_PNG . $img_name . '.' . $tmp_original_file_extension_clean . '].', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
                                        if(!$this->system_base64_file_synchronized()){

                                            return $this->system_base64_write();

                                        }

                                    }

                                }

                            }

                        }else{

                            $this->oCRNRSTN->error_log('CRNRSTN :: is unable to read from system PNG images directory [' . $tmp_dir_PNG . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                        }

                    break;
                    case 'jpg':
                    case 'jpeg':
                    case 'jpg2':

                        if(strlen($tmp_original_file_extension_clean) < 1){

                            $tmp_file_extension_clean = 'jpg';

                        }else{

                            $tmp_file_extension_clean = $tmp_original_file_extension_clean;

                        }

                        //
                        // JPEG
                        if($this->oCRNRSTN->validate_DIR_endpoint($tmp_dir_JPEG, 'SOURCE')){

                            //
                            // DO WE HAVE A VALID JPEG FILE NAME
                            if(is_file($tmp_dir_JPEG . $img_name . '.' . $tmp_file_extension_clean)){

                                self::$image_filesystem_meta_ARRAY[CRNRSTN_JPEG][self::$request_salt]['filename'] = $img_name . '.' . $tmp_file_extension_clean;
                                self::$image_filesystem_meta_ARRAY[CRNRSTN_JPEG][self::$request_salt]['path_filename'] = $tmp_dir_JPEG . $img_name . '.' . $tmp_file_extension_clean;
                                self::$image_filesystem_meta_ARRAY[CRNRSTN_PNG][self::$request_salt]['image_dimensions'] = '';
                                self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64][self::$request_salt]['filename'] = $img_name . '.php';
                                self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64][self::$request_salt]['path_filename'] = $tmp_dir_BASE64 . $img_name . '.php';
                                self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64][self::$request_salt]['serial'] = $tmp_file_serial;

                                //
                                // JPEG IS VALID. IS THERE A MATCHING PNG?
                                if($this->oCRNRSTN->validate_DIR_endpoint($tmp_dir_PNG, 'SOURCE')){

                                    //
                                    // DO WE HAVE A VALID FILE?
                                    if(is_file($tmp_dir_PNG . $img_name . '.png')){

                                        self::$image_filesystem_meta_ARRAY[CRNRSTN_PNG][self::$request_salt]['filename'] = $img_name . '.png';
                                        self::$image_filesystem_meta_ARRAY[CRNRSTN_PNG][self::$request_salt]['path_filename'] = $tmp_dir_PNG . $img_name . '.png';
                                        self::$image_filesystem_meta_ARRAY[CRNRSTN_PNG][self::$request_salt]['image_dimensions'] = '';

                                        //
                                        // PNG IS FILE. JPG IS FILE.
                                        if(!$this->system_base64_file_synchronized()){

                                            return $this->system_base64_write();

                                        }

                                    }else{

                                        //
                                        // ONLY PNG IS FILE
                                        //$this->oCRNRSTN->print_r('VALID JPEG FILE [' . $tmp_dir_JPEG . $img_name . '.jpg' . '].', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
                                        if(!$this->system_base64_file_synchronized()){

                                            return $this->system_base64_write();

                                        }

                                    }

                                }

                            }

                        }else{

                            $this->oCRNRSTN->error_log('CRNRSTN :: is unable to read from system JPEG images directory [' . $tmp_dir_JPEG . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                        }

                    break;

                }

            }

        }

        return true;

    }

    public function __destruct(){

    }

}