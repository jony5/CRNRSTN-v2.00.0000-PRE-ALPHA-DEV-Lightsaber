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
# # C # R # N # R # S # T # N # : : # # ##
#
#  CLASS :: crnrstn_system_image_asset_manager
#  VERSION :: 1.00.0000
#  DATE :: October 3, 2020 @ 1211hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI ::
#  DESCRIPTION :: Soo much HTML. Just wanted to put it some place nice.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#  Ezekiel 1:5a - AND FROM THE MIDST OF IT [FIRE] THERE CAME THE LIKENESS OF FOUR LIVING CREATURES.
#
class crnrstn_system_image_asset_manager {

    protected $oLogger;
    public $oCRNRSTN;
    public $oCRNRSTN_JS_CSS;

    protected $default_asset_mode;
    protected $asset_request_data_key;
    protected $asset_meta_path;
    
    //protected $asset_request_asset_family;
    //protected $asset_response_method_key;
    
    /*    
    $this->oCRNRSTN->asset_response_method_key = NULL;
    $this->crnrstn_asset_family = NULL;
    $this->crnrstn_asset_meta_path = NULL;
    
    */
    
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

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN);

    }

    private function temp_unlock_min_js_flag_to_mode(){

        if(isset($this->min_js_original_flag)){

            if($this->min_js_original_flag){

                $this->oCRNRSTN->initialize_bit(CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS, true);
                error_log(__LINE__ . ' asset mgr TEMP TURN ON CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS.');

            }else{

                $this->oCRNRSTN->initialize_bit(CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS, false);
                error_log(__LINE__ . ' asset mgr TEMP TURN OFF CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS.');

            }

        }

        $this->min_js_original_flag = NULL;

        return true;

    }

    private function temp_lock_min_js_flag_to_mode($is_dev_mode){

        if(isset($is_dev_mode)){

            if($is_dev_mode){

                if($this->oCRNRSTN->is_bit_set(CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS)){

                    $this->min_js_original_flag = true;
                    $this->oCRNRSTN->initialize_bit(CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS, false);

                }

            }else{

                if(!$this->oCRNRSTN->is_bit_set(CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS)){

                    $this->min_js_original_flag = true;
                    $this->oCRNRSTN->initialize_bit(CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS, true);

                }

            }

        }

    }

    public function return_html_head_asset($const, $footer_html_output = false, $is_dev_mode = NULL){

        switch($const){

            //
            // JS
            case CRNRSTN_JS_FRAMEWORK_JQUERY:
            case CRNRSTN_JS_FRAMEWORK_JQUERY_2_2_4:
            case CRNRSTN_JS_FRAMEWORK_JQUERY_1_12_4:
            case CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1:
            case CRNRSTN_JS_FRAMEWORK_JQUERY_UI:
            case CRNRSTN_JS_FRAMEWORK_JQUERY_UI_1_12_1:
            case CRNRSTN_JS_FRAMEWORK_JQUERY_MOBILE:
            case CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS:
            case CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_PLUS_JQUERY:
            case CRNRSTN_JS_FRAMEWORK_REACT:
            case CRNRSTN_JS_FRAMEWORK_REACT_DOM:
            case CRNRSTN_JS_FRAMEWORK_MITHRIL:
            case CRNRSTN_JS_FRAMEWORK_BACKBONE:
            case CRNRSTN_JS_FRAMEWORK_PROTOTYPE:
            case CRNRSTN_JS_FRAMEWORK_SCRIPTACULOUS:
            case CRNRSTN_JS_FRAMEWORK_PROTOTYPE_MOOFX:
            case CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_2_03_3:
            case CRNRSTN_JS_FRAMEWORK_MOOTOOLS_MORE:
            case CRNRSTN_JS_FRAMEWORK_MOOTOOLS_CORE:
            case CRNRSTN_UI_JS_MAIN:

                $this->temp_lock_min_js_flag_to_mode($is_dev_mode);
                $tmp_array = $this->return_output_CRNRSTN_UI_JS($const, $footer_html_output, $is_dev_mode);
                $this->temp_unlock_min_js_flag_to_mode();
                $tmp_output = '';

                //
                // LOAD OUTPUT
                foreach($tmp_array as $key => $resource_content){

                    $tmp_output .= $resource_content;

                }

                return $tmp_output;

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
            case CRNRSTN_CSS_FRAMEWORK_HTML5_BOILERPLATE:
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
            case CRNRSTN_CSS_FRAMEWORK_THISISDALLAS_SIMPLEGRID:
            case CRNRSTN_UI_CSS_MAIN_DESKTOP:
            case CRNRSTN_UI_CSS_MAIN_TABLET:
            case CRNRSTN_UI_CSS_MAIN_MOBILE:

                $this->temp_lock_min_js_flag_to_mode($is_dev_mode);
                $tmp_array = $this->return_output_CRNRSTN_UI_CSS($const, $footer_html_output, $is_dev_mode);
                $this->temp_unlock_min_js_flag_to_mode();

                $tmp_output = '';

                //
                // LOAD OUTPUT
                foreach($tmp_array as $key => $resource_content){

                    $tmp_output .= $resource_content;

                }

                return $tmp_output;

            break;
            case CRNRSTN_UI_CSS_MAIN_DESKTOP & CRNRSTN_UI_JS_MAIN:

                $this->temp_lock_min_js_flag_to_mode($is_dev_mode);
                $tmp_array_CSS = $this->return_output_CRNRSTN_UI_CSS(CRNRSTN_UI_CSS_MAIN_DESKTOP, $footer_html_output, $is_dev_mode);
                $tmp_array_JS = $this->return_output_CRNRSTN_UI_JS(CRNRSTN_UI_JS_MAIN, $footer_html_output, $is_dev_mode);
                $this->temp_unlock_min_js_flag_to_mode();
                $tmp_output = '';

                //
                // LOAD OUTPUT
                foreach($tmp_array_CSS as $key => $resource_content){

                    $tmp_output .= $resource_content;

                }

                foreach($tmp_array_JS as $key => $resource_content){

                    $tmp_output .= $resource_content;

                }

                return $tmp_output;

                break;

        }

        return false;

    }

    public function mapped_resource_html_output($resource_ARRAY, $asst_nom_hash, $footer_html_output){

        //
        // $resource_type = [js, css, integrations]
        $tmp_str = '';

        try{

            //
            // IF NO DELAY FOR OUTPUT...RUN. IF OUTPUT IS FOR FOOTER,...RUN.
            if($resource_ARRAY['asset_spool_delay_html_output_for_footer'] !== 'TRUE' || $footer_html_output === true){

                $tmp_build_html = true;

                //
                // DO WE BUILD HTML STRING DATA RETURN FOR RESOURCE?
                if($this->oCRNRSTN->is_bit_set(CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS)){

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
                if($tmp_build_html && !isset($this->framework_file_output_serial_ARRAY[$asst_nom_hash])){

                    //
                    // FLAG THIS ASSET AS OUTPUTTED BY "FILE_PATH-FILE_NAME" HASH.
                    $this->framework_file_output_serial_ARRAY[$asst_nom_hash] = 1;
                    //$this->oCRNRSTN->print_r('PREPARING HTML RETURN FOR [' . print_r($this->framework_file_output_serial_ARRAY, true) . '].', NULL, NULL, __LINE__, __METHOD__, __FILE__);

                    //
                    // THIS SWITCHES OFF OF ASSET "STORAGE LOCATION INDICATOR" CONSTANT WITHIN CRNRSTN :: ...RATHER
                    // THAN AN INDICATION OF FILE HEADER RESPONSE MIME TYPE. THERE IS CSS IN THE JS FRAMEWORK PATH.
                    switch($resource_ARRAY['file_type_constant'][0]){
                        case CRNRSTN_UI_CSS:

                            // SORRY.
                            // TONS OF REDUNDANCY HERE AS I AM EXPERIMENTING WITH DIFFERENT LINE BREAK
                            // TREATMENTS HAVING RESPECT TO CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS.

                            //
                            // IS THIS JS?
                            if($resource_ARRAY['file_extension'][0] === 'js'){

                                if($this->oCRNRSTN->is_bit_set(CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS)){

                                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_ASSET_MAPPING)){

                                        $tmp_nom = $resource_ARRAY['file_name'][0];
                                        if($resource_ARRAY['crnrstn_mod'][0] !== 0){

                                            $tmp_nom = $resource_ARRAY['crnrstn_mod'][0];

                                        }

                                        $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
    <script type="' . $resource_ARRAY['meta_type'][0] . '" src="' . $resource_ARRAY['system_http_root'][0] . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_nom . '&crnrstn_=' . $resource_ARRAY['cache'][0] . '"></script>
';

                                    }else{

                                        $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
    <script type="' . $resource_ARRAY['meta_type'][0] . '" src="' .  $resource_ARRAY['system_http_root'][0] . $resource_ARRAY['system_directory'][0] . DIRECTORY_SEPARATOR . 'ui/js' . $resource_ARRAY['file_path_original'][0] . '?crnrstn_=' . $resource_ARRAY['cache'][0] . '"></script>
';

                                    }

                                }else{

                                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_ASSET_MAPPING)){

                                        $tmp_nom = $resource_ARRAY['file_name'][0];
                                        if($resource_ARRAY['crnrstn_mod'][0] !== 0){

                                            $tmp_nom = $resource_ARRAY['crnrstn_mod'][0];

                                        }

                                        $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
    <script type="' . $resource_ARRAY['meta_type'][0] . '" src="' . $resource_ARRAY['system_http_root'][0] . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_nom . '&crnrstn_=' . $resource_ARRAY['cache'][0] . '"></script>
';

                                    }else{

                                        $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
    <script type="' . $resource_ARRAY['meta_type'][0] . '" src="' .  $resource_ARRAY['system_http_root'][0] . $resource_ARRAY['system_directory'][0] . DIRECTORY_SEPARATOR . 'ui/js' . $resource_ARRAY['file_path_original'][0] . '?crnrstn_=' . $resource_ARRAY['cache'][0] . '"></script>
';

                                    }

                                }

                            }else{

                                if($this->oCRNRSTN->is_bit_set(CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS)){

                                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_CSS_ASSET_MAPPING)){

                                        $tmp_nom = $resource_ARRAY['file_name'][0];
                                        if($resource_ARRAY['crnrstn_mod'][0] !== 0){

                                            $tmp_nom = $resource_ARRAY['crnrstn_mod'][0];

                                        }

                                        $tmp_str .= '    
    <link type="' . $resource_ARRAY['meta_type'][0] . '" rel="stylesheet" href="' . $resource_ARRAY['system_http_root'][0] . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_nom . '&crnrstn_=' . $resource_ARRAY['cache'][0] . '">
';

                                    }else{

                                        $tmp_str .= '    
    <link type="' . $resource_ARRAY['meta_type'][0] . '" rel="stylesheet" href="' .  $resource_ARRAY['system_http_root'][0] . $resource_ARRAY['system_directory'][0] . DIRECTORY_SEPARATOR . 'ui/css' . $resource_ARRAY['file_path_original'][0] . '?crnrstn_=' . $resource_ARRAY['cache'][0] . '">
';

                                    }

                                }else{

                                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_CSS_ASSET_MAPPING)){

                                        $tmp_nom = $resource_ARRAY['file_name'][0];
                                        if($resource_ARRAY['crnrstn_mod'][0] !== 0){

                                            $tmp_nom = $resource_ARRAY['crnrstn_mod'][0];

                                        }

                                        $tmp_str .= '  
    <link type="' . $resource_ARRAY['meta_type'][0] . '" rel="stylesheet" href="' . $resource_ARRAY['system_http_root'][0] . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_nom . '&crnrstn_=' . $resource_ARRAY['cache'][0] . '">
';
                                        //error_log(__LINE__ . ' asset mgr file_extension[' . $resource_ARRAY['file_extension'][0] . '].');

                                    }else{

                                        $tmp_str .= '
    <link type="' . $resource_ARRAY['meta_type'][0] . '" rel="stylesheet" href="' .  $resource_ARRAY['system_http_root'][0] . $resource_ARRAY['system_directory'][0] . DIRECTORY_SEPARATOR . 'ui/css' . $resource_ARRAY['file_path_original'][0] . '?crnrstn_=' . $resource_ARRAY['cache'][0] . '">
';
                                        //error_log(__LINE__ . ' asset mgr file_extension[' . $resource_ARRAY['file_extension'][0] . '].');

                                    }

                                }

                            }

                        break;
                        case CRNRSTN_UI_JS:

                            //
                            // IS THIS CSS?
                            if($resource_ARRAY['file_extension'][0] === 'css'){

                                if($this->oCRNRSTN->is_bit_set(CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS)){

                                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_ASSET_MAPPING)){

                                        $tmp_nom = $resource_ARRAY['file_name'][0];
                                        if($resource_ARRAY['crnrstn_mod'][0] !== 0){

                                            $tmp_nom = $resource_ARRAY['crnrstn_mod'][0];

                                        }

                                        $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
    <link type="' . $resource_ARRAY['meta_type'][0] . '" rel="stylesheet" href="' . $resource_ARRAY['system_http_root'][0] . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_nom . '&crnrstn_=' . $resource_ARRAY['cache'][0] . '">
';

                                    }else{

                                        $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
    <link type="' . $resource_ARRAY['meta_type'][0] . '" rel="stylesheet" href="' .  $resource_ARRAY['system_http_root'][0] . $resource_ARRAY['system_directory'][0] . DIRECTORY_SEPARATOR . 'ui/js' . $resource_ARRAY['file_path_original'][0] . '?crnrstn_=' . $resource_ARRAY['cache'][0] . '">
';

                                    }

                                }else{

                                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_ASSET_MAPPING)){

                                        $tmp_nom = $resource_ARRAY['file_name'][0];
                                        if($resource_ARRAY['crnrstn_mod'][0] !== 0){

                                            $tmp_nom = $resource_ARRAY['crnrstn_mod'][0];

                                        }

                                        $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
    <link type="' . $resource_ARRAY['meta_type'][0] . '" rel="stylesheet" href="' . $resource_ARRAY['system_http_root'][0] . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_nom . '&crnrstn_=' . $resource_ARRAY['cache'][0] . '">
';
                                        //error_log(__LINE__ . ' asset mgr file_extension[' . $resource_ARRAY['file_extension'][0] . '].');

                                    }else{

                                        $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
    <link type="' . $resource_ARRAY['meta_type'][0] . '" rel="stylesheet" href="' .  $resource_ARRAY['system_http_root'][0] . $resource_ARRAY['system_directory'][0] . DIRECTORY_SEPARATOR . 'ui/js' . $resource_ARRAY['file_path_original'][0] . '?crnrstn_=' . $resource_ARRAY['cache'][0] . '">
';
                                        //error_log(__LINE__ . ' asset mgr file_extension[' . $resource_ARRAY['file_extension'][0] . '].');

                                    }

                                }

                            }else{

                                //
                                // THIS REFERS TO JS STORAGE LOCATION WITHIN CRNRSTN :: ...RATHER THAN AN
                                // INDICATION OF FILE HEADER RESPONSE MIME TYPE. THERE IS CSS IN THE JS FRAMEWORK PATH.
                                if($this->oCRNRSTN->is_bit_set(CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS)){

                                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_ASSET_MAPPING)){

                                        $tmp_nom = $resource_ARRAY['file_name'][0];
                                        if($resource_ARRAY['crnrstn_mod'][0] !== 0){

                                            $tmp_nom = $resource_ARRAY['crnrstn_mod'][0];

                                        }

                                        $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
    <script type="' . $resource_ARRAY['meta_type'][0] . '" src="' . $resource_ARRAY['system_http_root'][0] . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_nom . '&crnrstn_=' . $resource_ARRAY['cache'][0] . '"></script>
';

                                    }else{

                                        $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
    <script type="' . $resource_ARRAY['meta_type'][0] . '" src="' .  $resource_ARRAY['system_http_root'][0] . $resource_ARRAY['system_directory'][0] . DIRECTORY_SEPARATOR . 'ui/js' . $resource_ARRAY['file_path_original'][0] . '?crnrstn_=' . $resource_ARRAY['cache'][0] . '"></script>
';

                                    }

                                }else{

                                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_ASSET_MAPPING)){

                                        $tmp_nom = $resource_ARRAY['file_name'][0];
                                        if($resource_ARRAY['crnrstn_mod'][0] !== 0){

                                            $tmp_nom = $resource_ARRAY['crnrstn_mod'][0];

                                        }

                                        $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
    <script type="' . $resource_ARRAY['meta_type'][0] . '" src="' . $resource_ARRAY['system_http_root'][0] . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_nom . '&crnrstn_=' . $resource_ARRAY['cache'][0] . '"></script>
';
                                        //error_log(__LINE__ . ' asset mgr file_extension[' . $resource_ARRAY['file_extension'][0] . '].');

                                    }else{

                                        $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
    <script type="' . $resource_ARRAY['meta_type'][0] . '" src="' .  $resource_ARRAY['system_http_root'][0] . $resource_ARRAY['system_directory'][0] . DIRECTORY_SEPARATOR . 'ui/js' . $resource_ARRAY['file_path_original'][0] . '?crnrstn_=' . $resource_ARRAY['cache'][0] . '"></script>
';
                                        //error_log(__LINE__ . ' asset mgr file_extension[' . $resource_ARRAY['file_extension'][0] . '].');

                                    }

                                }

                            }

                        break;
                        case CRNRSTN_UI_CSS & CRNRSTN_ASSET_MODE_BASE64:

                            //
                            // IS THIS JS?
                            if($resource_ARRAY['file_extension'][0] === 'js'){

                                $tmp_nom = $resource_ARRAY['file_name'][0];
                                if($resource_ARRAY['crnrstn_mod'][0] !== 0) {

                                    $tmp_nom = $resource_ARRAY['crnrstn_mod'][0];

                                    $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
<script type="' . $resource_ARRAY['meta_type'][0] . '"> //<!--
' . $this->return_js_string_output($tmp_nom) . '
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

                                //error_log(__LINE__ . ' asset mgr file_extension[' . $resource_ARRAY['file_extension'][0] . '].');

                            }else{

                                $tmp_nom = $resource_ARRAY['file_name'][0];
                                if($resource_ARRAY['crnrstn_mod'][0] !== 0) {

                                    $tmp_nom = $resource_ARRAY['crnrstn_mod'][0];

                                    $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
<style>
' . $this->return_css_string_output($tmp_nom) . '
</style>
';

                                }else{

                                    $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
<style>
' . file_get_contents($tmp_nom) . '
</style>
';
                                }


                                //error_log(__LINE__ . ' asset mgr file_extension[' . $resource_ARRAY['file_extension'][0] . '].');

                            }

                        break;
                        case CRNRSTN_UI_JS & CRNRSTN_ASSET_MODE_BASE64:

                            //
                            // IS THIS CSS?
                            if($resource_ARRAY['file_extension'][0] === 'css'){

                                $tmp_nom = $resource_ARRAY['file_name'][0];
                                if($resource_ARRAY['crnrstn_mod'][0] !== 0) {

                                    $tmp_nom = $resource_ARRAY['crnrstn_mod'][0];

                                    $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
<style>
' . $this->return_css_string_output($tmp_nom) . '
</style>
';
                                }else{

                                    $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
<style>
' . file_get_contents($tmp_nom) . '
</style>
';
                                }

                                //error_log(__LINE__ . ' asset mgr file_extension[' . $resource_ARRAY['file_extension'][0] . '].');

                            }else{

                                $tmp_nom = $resource_ARRAY['file_name'][0];
                                if($resource_ARRAY['crnrstn_mod'][0] !== 0) {

                                    $tmp_nom = $resource_ARRAY['crnrstn_mod'][0];

                                    $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
<script type="' . $resource_ARRAY['meta_type'][0] . '" > //<!--
' . $this->return_js_string_output($tmp_nom) . '
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

                                //error_log(__LINE__ . ' asset mgr $tmp_str[' . $tmp_str . ']. file_extension[' . $resource_ARRAY['file_extension'][0] . '].');

                            }

                        break;

                    }

                }

            }else{

                //
                // SPOOL THIS ASSET (ARRAY DATA TYPE) TO BE PROCESSED AT THE FOOTER
                //system_head_html_asset_array_spool_ARRAY
                $this->oCRNRSTN->spool_head_html_asset_array($resource_ARRAY, $asst_nom_hash);

                error_log(__LINE__ . ' asset mgr SPOOL THIS ASSET $asst_nom_hash[' . $asst_nom_hash . ']. file_extension[' . print_r($resource_ARRAY, true) . '].');

            }

            return $tmp_str;

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
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
        $tmp_file_type_const = CRNRSTN_UI_JS;
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
                throw new Exception('The requested resource, ' . $tmp_resource_const_profile_ARRAY['INTEGER'] . ' ["' .  $tmp_resource_const_profile_ARRAY['STRING'] . '"], has not been spooled...but, it is being requested.');

            }

            //
            // $resource_type = [js, css, integrations]
            $tmp_str = '';
            foreach($this->framework_resource_ARRAY[$resource_constant] as $index0 => $tmpchnkARRAY00){

                foreach($tmpchnkARRAY00 as $asst_nom_hash => $resARRAY){

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
                        $tmp_str .= $this->mapped_resource_html_output($resARRAY, $asst_nom_hash, $footer_html_output);

                    }


                }

            }

            return $tmp_str;

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    private function spool_resource($resource_constant, $meta_type, $crnrstn_mod, $file_path, $file_name, $file_type_constant, $file_is_minimized = true, $asset_minimization_mode_is_active = true, $resource_dependency_constant = NULL, $spool_asset_for_footer_html = false){

        $tmp_ARRAY = array();
        $tmp_spool_for_footer_html_str = 'FALSE';
        $tmp_file_is_minimized_str = $tmp_asset_minimization_mode_is_active_str = 'TRUE';
        $tmp_file_path_hash = $this->oCRNRSTN->hash($file_path);

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

        $tmp_asset_mapping_dir_path = $this->oCRNRSTN->get_resource('crnrstn_integrations_asset_mapping_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_INTEGRATIONS');
        $tmp_path_directory = $this->oCRNRSTN->get_resource('crnrstn_path_directory', 0, 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES');
        $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES');

        switch($file_type_constant){
            case CRNRSTN_UI_JS & CRNRSTN_ASSET_MODE_BASE64:
            case CRNRSTN_UI_JS:

                $tmp_path_root = $this->oCRNRSTN->get_resource('crnrstn_js_asset_mapping_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
                $tmp_http_root = $this->oCRNRSTN->get_resource('crnrstn_js_asset_mapping_http_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
                $tmp_str_file_type_nom = 'js';

            break;
            case CRNRSTN_UI_CSS & CRNRSTN_ASSET_MODE_BASE64:
            case CRNRSTN_UI_CSS:

                $tmp_path_root = $this->oCRNRSTN->get_resource('crnrstn_css_asset_mapping_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
                $tmp_http_root = $this->oCRNRSTN->get_resource('crnrstn_css_asset_mapping_http_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
                $tmp_str_file_type_nom = 'css';

            break;

        }

        $tmp_http_root = $this->oCRNRSTN->crnrstn_http_endpoint($tmp_http_root);

        //
        // FORCE LEADING DIRECTORY SEPARATOR
        $file_path = ltrim($file_path,DIRECTORY_SEPARATOR);
        $file_path = DIRECTORY_SEPARATOR . $file_path;
        $tmp_filepath = $tmp_path_root . $file_path;

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

        //
        // IS THIS A NEW FILE?
        $tmp_resource_hash = $tmp_file_path_hash . $tmp_file_name_hash;
        $tmp_ARRAY[$tmp_resource_hash]['resource_version_nom'][] = $tmp_resource_meta_ARRAY['TITLE'] . ' v' . $tmp_resource_meta_ARRAY['VERSION'] .  $tmp_dependency_str;
        $tmp_ARRAY[$tmp_resource_hash]['system_path_directory'][] = $tmp_path_directory;
        $tmp_ARRAY[$tmp_resource_hash]['asset_mapping_dir_path'][] = $tmp_asset_mapping_dir_path;
        $tmp_ARRAY[$tmp_resource_hash]['system_http_root'][] = $tmp_http_root;
        $tmp_ARRAY[$tmp_resource_hash]['system_directory'][] = $tmp_system_directory;
        $tmp_ARRAY[$tmp_resource_hash]['resource_constant'][] = $resource_constant;
        $tmp_ARRAY[$tmp_resource_hash]['file_type_constant'][] = $file_type_constant;
        $tmp_ARRAY[$tmp_resource_hash]['meta_type'][] = $meta_type;
        $tmp_ARRAY[$tmp_resource_hash]['crnrstn_mod'][] = $crnrstn_mod;
        $tmp_ARRAY[$tmp_resource_hash]['file_name'][] = $file_name;
        $tmp_ARRAY[$tmp_resource_hash]['file_path_original'][] = $file_path;
        $tmp_ARRAY[$tmp_resource_hash]['file_extension'][] = $tmp_file_extension;
        $tmp_ARRAY[$tmp_resource_hash]['file_path'][] = $tmp_filepath;
        $tmp_ARRAY[$tmp_resource_hash]['path_root'][] = $tmp_path_root;
        $tmp_ARRAY[$tmp_resource_hash]['file_is_minimized'][] = $tmp_file_is_minimized_str;
        $tmp_ARRAY[$tmp_resource_hash]['asset_minimization_mode_is_active'][] = $tmp_asset_minimization_mode_is_active_str;
        $tmp_ARRAY[$tmp_resource_hash]['asset_spool_delay_html_output_for_footer'][] = $tmp_spool_for_footer_html_str;
        $tmp_ARRAY[$tmp_resource_hash]['cache'][] = $tmp_cache;

        $this->framework_resource_ARRAY[$resource_constant][] = $tmp_ARRAY;

        return true;

    }

    private function return_output_CRNRSTN_UI_JS($const, $footer_html_output = false, $is_dev_mode = NULL){

        try{

            $asset_mode_ARRAY = $this->oCRNRSTN->return_set_bits($this->oCRNRSTN->system_output_profile_constants);

            $tmp_str = '';
            $tmp_start_str = '';
            $tmp_str_array = array();

            if(isset($is_dev_mode)){

                if($is_dev_mode){

                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS)){

                        $tmp_min_js_css_bool_cache = true;
                        $this->oCRNRSTN->initialize_bit(CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS, false);

                    }

                }else{

                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS)){

                        $tmp_min_js_css_bool_cache = false;
                        $this->oCRNRSTN->initialize_bit(CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS, false);

                    }

                }

            }

            switch($asset_mode_ARRAY[0]){
                case CRNRSTN_ASSET_MODE_PNG:
                case CRNRSTN_ASSET_MODE_JPEG:
                case CRNRSTN_ASSET_MODE_BASE64:

                    // # # # # # # # # # # # # # # # # # # # # # # # # # #
                    $tmp_start_str = '
    <!-- BEGIN CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' JS MODULE OUTPUT :: ' . $this->oCRNRSTN->return_micro_time() . ' -->
';

                    switch ($const){
                        case CRNRSTN_JS_FRAMEWORK_JQUERY:

                            $tmp_file_type_const = CRNRSTN_UI_JS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/jquery/3.6.1/jquery-3.6.1.min.map';
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
                            $tmp_file_path = '/_lib/frameworks/jquery/3.6.1/jquery-3.6.1.min.js';
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
                            $tmp_file_path = '/_lib/frameworks/jquery/3.6.1/jquery-3.6.1.js';
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

                            $tmp_file_type_const = CRNRSTN_UI_JS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/jquery/2.2.4/jquery-2.2.4.min.js';
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
                            $tmp_file_path = '/_lib/frameworks/jquery/2.2.4/jquery-2.2.4.js';
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

                            $tmp_file_type_const = CRNRSTN_UI_JS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/jquery/1.12.4/jquery-1.12.4.min.js';
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
                            $tmp_file_path = '/_lib/frameworks/jquery/1.12.4/jquery-1.12.4.js';
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

                            $tmp_file_type_const = CRNRSTN_UI_JS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/jquery/1.11.1/jquery-1.11.1.min.js';
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

                            $tmp_file_type_const = CRNRSTN_UI_JS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.13.2/jquery-ui-1.13.2/jquery-ui.theme.min.css';
                            $tmp_file_name = 'jquery-ui-1.13.2/jquery-ui.theme.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.13.2/jquery-ui-1.13.2/jquery-ui.structure.min.css';
                            $tmp_file_name = 'jquery-ui-1.13.2/jquery-ui.structure.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.13.2/jquery-ui-1.13.2/jquery-ui.min.css';
                            $tmp_file_name = 'jquery-ui-1.13.2/jquery-ui.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.13.2/jquery-ui-1.13.2/jquery-ui.theme.css';
                            $tmp_file_name = 'jquery-ui-1.13.2/jquery-ui.theme.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.13.2/jquery-ui-1.13.2/jquery-ui.structure.css';
                            $tmp_file_name = 'jquery-ui-1.13.2/jquery-ui.structure.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.13.2/jquery-ui-1.13.2/jquery-ui.css';
                            $tmp_file_name = 'jquery-ui-1.13.2/jquery-ui.css';
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
                                && !isset($this->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_PLUS_JQUERY])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY])){

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = '/_lib/frameworks/jquery/3.6.1/jquery-3.6.1.min.js';
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
                                $tmp_file_path = '/_lib/frameworks/jquery/3.6.1/jquery-3.6.1.js';
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
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.13.2/jquery-ui-1.13.2/jquery-ui.min.js';
                            $tmp_file_name = 'jquery-ui-1.13.2/jquery-ui.min.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.13.2/jquery-ui-1.13.2/jquery-ui.js';
                            $tmp_file_name = 'jquery-ui-1.13.2/jquery-ui.js';
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

                            $tmp_file_type_const = CRNRSTN_UI_JS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.12.1/jquery-ui-1.12.1/jquery-ui.theme.min.css';
                            $tmp_file_name = 'jquery-ui-1.12.1/jquery-ui.theme.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.12.1/jquery-ui-1.12.1/jquery-ui.structure.min.css';
                            $tmp_file_name = 'jquery-ui-1.12.1/jquery-ui.structure.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.12.1/jquery-ui-1.12.1/jquery-ui.min.css';
                            $tmp_file_name = 'jquery-ui-1.12.1/jquery-ui.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.12.1/jquery-ui-1.12.1/jquery-ui.theme.css';
                            $tmp_file_name = 'jquery-ui-1.12.1/jquery-ui.theme.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.12.1/jquery-ui-1.12.1/jquery-ui.structure.css';
                            $tmp_file_name = 'jquery-ui-1.12.1/jquery-ui.structure.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.12.1/jquery-ui-1.12.1/jquery-ui.css';
                            $tmp_file_name = 'jquery-ui-1.12.1/jquery-ui.css';
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
                                && !isset($this->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_PLUS_JQUERY])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY])){

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = '/_lib/frameworks/jquery/3.6.1/jquery-3.6.1.min.js';
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
                                $tmp_file_path = '/_lib/frameworks/jquery/3.6.1/jquery-3.6.1.js';
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
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.12.1/jquery-ui-1.12.1/jquery-ui.min.js';
                            $tmp_file_name = '1.12.1/jquery-ui-1.12.1/jquery-ui.min.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.12.1/jquery-ui-1.12.1/jquery-ui.js';
                            $tmp_file_name = 'jquery-ui-1.12.1/jquery-ui.js';
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

                            $tmp_file_type_const = CRNRSTN_UI_JS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = 'crnrstn.jquery-mobile-external-png-1.4.5.min.css';
                            $tmp_file_path = '/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile.external-png-1.4.5.min.css';
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
                            $tmp_file_path = '/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile.icons-1.4.5.min.css';
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
                            $tmp_file_path = '/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile.inline-png-1.4.5.min.css';
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
                            $tmp_file_path = '/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile.inline-svg-1.4.5.min.css';
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
                            $tmp_file_path = '/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile.structure-1.4.5.min.css';
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
                            $tmp_file_path = '/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile.theme-1.4.5.min.css';
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
                            $tmp_file_path = '/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.css';
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
                            $tmp_file_path = '/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile.external-png-1.4.5.css';
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
                            $tmp_file_path = '/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile.icons-1.4.5.css';
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
                            $tmp_file_path = '/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile.inline-png-1.4.5.css';
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
                            $tmp_file_path = '/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile.inline-svg-1.4.5.css';
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
                            $tmp_file_path = '/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile.structure-1.4.5.css';
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
                            $tmp_file_path = '/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile.theme-1.4.5.css';
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
                            $tmp_file_path = '/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile-1.4.5.css';
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
                            // CHECK FOR LOAD OF CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1, CRNRSTN_JS_FRAMEWORK_JQUERY_2_2_4, CRNRSTN_JS_FRAMEWORK_JQUERY
                            if(!isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_1_12_4])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_2_2_4])
                                && !isset($this->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_PLUS_JQUERY])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY])){

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = '/_lib/frameworks/jquery/1.11.1/jquery-1.11.1.min.js';
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
                            $tmp_file_path = '/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/index.js';
                            $tmp_file_name = 'jquery.mobile-1.4.5/index.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js';
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
                            $tmp_file_path = '/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile-1.4.5.js';
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

                            $tmp_file_type_const = CRNRSTN_UI_JS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = 'crnrstn.lightbox.min.css';
                            $tmp_file_path = '/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/css/lightbox.min.css';
                            $tmp_file_name = 'lightbox-2.11.3/css/lightbox.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = 'crnrstn.lightbox.css';
                            $tmp_file_path = '/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/css/lightbox.css';
                            $tmp_file_name = 'lightbox-2.11.3/css/lightbox.css';
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
                                && !isset($this->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_PLUS_JQUERY])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY])){

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = '/_lib/frameworks/jquery/3.6.1/jquery-3.6.1.min.js';
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
                                $tmp_file_path = '/_lib/frameworks/jquery/3.6.1/jquery-3.6.1.js';
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
                            $tmp_file_path = '/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/js/lightbox.min.js';
                            $tmp_file_name = 'lightbox-2.11.3/js/lightbox.min.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/js/lightbox.js';
                            $tmp_file_name = 'lightbox-2.11.3/js/lightbox.js';
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

                            $tmp_file_type_const = CRNRSTN_UI_JS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = 'crnrstn.lightbox.min.css';
                            $tmp_file_path = '/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/css/lightbox.min.css';
                            $tmp_file_name = 'lightbox-2.11.3/css/lightbox.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = 'crnrstn.lightbox.css';
                            $tmp_file_path = '/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/css/lightbox.css';
                            $tmp_file_name = 'lightbox-2.11.3/css/lightbox.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/js/lightbox-plus-jquery.min.js';
                            $tmp_file_name = 'lightbox-2.11.3/js/lightbox-plus-jquery.min.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/js/lightbox-plus-jquery.js';
                            $tmp_file_name = 'lightbox-2.11.3/js/lightbox-plus-jquery.js';
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
                        case CRNRSTN_JS_FRAMEWORK_REACT:

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

                            if($this->oCRNRSTN->is_bit_set(CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS)){

                                if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64){

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

                                if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64){

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
                        case CRNRSTN_JS_FRAMEWORK_REACT_DOM:

                            //
                            // DO NOT CALL flag_built_head_resource() (AND ABORT ANY $tmp_str CONCAT)
                            // IF $tmp_spool_asset_for_footer_html = true;
                            $this->oCRNRSTN->flag_built_head_resource($const);

                            $tmp_ARRAY = $this->oCRNRSTN->return_int_const_profile($const);

                            if($this->oCRNRSTN->is_bit_set(CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS)){

                                if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64){

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

                                if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64){

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
                        case CRNRSTN_JS_FRAMEWORK_MITHRIL:

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

                            if($this->oCRNRSTN->is_bit_set(CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS)){

                                if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64){

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

                                if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64){

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

                            $tmp_file_type_const = CRNRSTN_UI_JS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/backbone/1.4.1/backbone.min.map';
                            $tmp_file_name = '1.4.1/backbone.min.map';
                            $tmp_meta_type = 'application/json';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = 'crnrstn.backbone_1_4_1.min.js';
                            $tmp_file_path = '/_lib/frameworks/backbone/1.4.1/backbone.min.js';
                            $tmp_file_name = '1.4.1/backbone.min.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/backbone/1.4.1/backbone.js';
                            $tmp_file_name = '1.4.1/backbone.js';
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

                            $tmp_file_type_const = CRNRSTN_UI_JS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/prototype.js/1.7.3/prototype.js';
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

                            $tmp_file_type_const = CRNRSTN_UI_JS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_JS & CRNRSTN_ASSET_MODE_BASE64;

                            //
                            // CHECK FOR LOAD OF CRNRSTN_JS_FRAMEWORK_PROTOTYPE
                            if(!isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_PROTOTYPE])){

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = '/_lib/frameworks/prototype.js/1.7.3/prototype.js';
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

                            if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_ASSET_MAPPING)){

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = '/_lib/frameworks/script.aculo.us/1.9.0/src/scriptaculous.js';
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
                                $tmp_file_path = '/_lib/frameworks/script.aculo.us/1.9.0/src/builder.js';
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
                                $tmp_file_path = '/_lib/frameworks/script.aculo.us/1.9.0/src/effects.js';
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
                                $tmp_file_path = '/_lib/frameworks/script.aculo.us/1.9.0/src/controls.js';
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
                                $tmp_file_path = '/_lib/frameworks/script.aculo.us/1.9.0/src/dragdrop.js';
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
                                $tmp_file_path = '/_lib/frameworks/script.aculo.us/1.9.0/src/slider.js';
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
                                $tmp_file_path = '/_lib/frameworks/script.aculo.us/1.9.0/src/sound.js';
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
                                $tmp_file_path = '/_lib/frameworks/script.aculo.us/1.9.0/src/scriptaculous.js';
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

                            $tmp_file_type_const = CRNRSTN_UI_JS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_JS & CRNRSTN_ASSET_MODE_BASE64;

                            //
                            // CHECK FOR LOAD OF CRNRSTN_JS_FRAMEWORK_PROTOTYPE
                            if(!isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_PROTOTYPE])){

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = '/_lib/frameworks/prototype.js/1.7.3/prototype.js';
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
                            $tmp_file_path = '/_lib/frameworks/moo.fx/2.0/source/moo.fx.js';
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
                            $tmp_file_path = '/_lib/frameworks/moo.fx/2.0/source/moo.fx.pack.js';
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
                            $tmp_file_path = '/_lib/frameworks/moo.fx/2.0/source/moo.fx.utils.js';
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
                            $tmp_file_path = '/_lib/frameworks/moo.fx/2.0/source/moo.fx.accordion.js';
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
                            $tmp_file_path = '/_lib/frameworks/moo.fx/2.0/source/moo.fx.transitions.js';
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
                        case CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_2_03_3:

                            $tmp_file_type_const = CRNRSTN_UI_JS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = 'crnrstn.lightbox-2.03.3.css';
                            $tmp_file_path = '/_lib/frameworks/lightbox.js/2.03.3/css/lightbox.css';
                            $tmp_file_name = '2.03.3/css/lightbox.css';
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
                                $tmp_file_path = '/_lib/frameworks/prototype.js/1.7.3/prototype.js';
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
                            $tmp_file_path = '/_lib/frameworks/lightbox.js/2.03.3/js/lightbox.js';
                            $tmp_file_name = '2.03.3/js/lightbox.js';
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

                            $tmp_file_type_const = CRNRSTN_UI_JS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/mootools/more/1.6.0/mootools-more-1.6.0-min.js';
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
                            $tmp_file_path = '/_lib/frameworks/mootools/more/1.6.0/mootools-more-1.6.0.js';
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

                            $tmp_file_type_const = CRNRSTN_UI_JS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/mootools/core/1.6.0/mootools-core-1.6.0-min.js';
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
                            $tmp_file_path = '/_lib/frameworks/mootools/core/1.6.0/mootools-core-1.6.0.js';
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
                        case CRNRSTN_UI_JS_MAIN:

                            $tmp_file_type_const = CRNRSTN_UI_JS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = 'crnrstn.lightbox.min.css';
                            $tmp_file_path = '/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/css/lightbox.min.css';
                            $tmp_file_name = 'lightbox-2.11.3/css/lightbox.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource(CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = 'crnrstn.lightbox.css';
                            $tmp_file_path = '/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/css/lightbox.css';
                            $tmp_file_name = 'lightbox-2.11.3/css/lightbox.css';
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
                                && !isset($this->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_PLUS_JQUERY])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY])){

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = '/_lib/frameworks/jquery/3.6.1/jquery-3.6.1.min.js';
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
                                $tmp_file_path = '/_lib/frameworks/jquery/3.6.1/jquery-3.6.1.js';
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
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.13.2/jquery-ui-1.13.2/jquery-ui.theme.min.css';
                            $tmp_file_name = 'jquery-ui-1.13.2/jquery-ui.theme.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY_UI, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.13.2/jquery-ui-1.13.2/jquery-ui.structure.min.css';
                            $tmp_file_name = 'jquery-ui-1.13.2/jquery-ui.structure.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY_UI, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.13.2/jquery-ui-1.13.2/jquery-ui.min.css';
                            $tmp_file_name = 'jquery-ui-1.13.2/jquery-ui.min.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY_UI, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.13.2/jquery-ui-1.13.2/jquery-ui.theme.css';
                            $tmp_file_name = 'jquery-ui-1.13.2/jquery-ui.theme.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY_UI, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.13.2/jquery-ui-1.13.2/jquery-ui.structure.css';
                            $tmp_file_name = 'jquery-ui-1.13.2/jquery-ui.structure.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY_UI, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.13.2/jquery-ui-1.13.2/jquery-ui.css';
                            $tmp_file_name = 'jquery-ui-1.13.2/jquery-ui.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY_UI, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.13.2/jquery-ui-1.13.2/jquery-ui.min.js';
                            $tmp_file_name = 'jquery-ui-1.13.2/jquery-ui.min.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY_UI, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.13.2/jquery-ui-1.13.2/jquery-ui.js';
                            $tmp_file_name = 'jquery-ui-1.13.2/jquery-ui.js';
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
                            $tmp_file_path = '/crnrstn.main.js';
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

                    if(strlen($tmp_str) > 0){

                        $tmp_str_array[] = $tmp_start_str;

                        $tmp_str_array[] = $tmp_str;
                        
                        $tmp_str_array[] = '    <!-- END CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: JS + CSS MODULE OUTPUT -->
';
                    }
                    
                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Received unknown asset mode [' . print_r($asset_mode_ARRAY, true) . '] from the system.');

                break;

            }

            return $tmp_str_array;

        }catch( Exception $e ){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return $tmp_str_array;

        }

    }

    private function return_output_CRNRSTN_UI_CSS($const, $footer_html_output = false, $is_dev_mode = NULL){

        try{

            $asset_mode_ARRAY = $this->oCRNRSTN->return_set_bits($this->oCRNRSTN->system_output_profile_constants);

            $tmp_str = '';
            $tmp_start_str = '';
            $tmp_str_array = array();

            if(isset($is_dev_mode)){

                if($is_dev_mode){

                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS)){

                        $tmp_min_js_css_bool_cache = true;
                        $this->oCRNRSTN->initialize_bit(CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS, false);

                    }

                }else{

                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS)){

                        $tmp_min_js_css_bool_cache = false;
                        $this->oCRNRSTN->initialize_bit(CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS, false);

                    }

                }

            }

            switch($asset_mode_ARRAY[0]){
                case CRNRSTN_ASSET_MODE_PNG:
                case CRNRSTN_ASSET_MODE_JPEG:

                    $tmp_start_str = '
    <!-- BEGIN CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: CSS MODULE OUTPUT :: ' . $this->oCRNRSTN->return_micro_time() . ' -->';

                    switch ($const){
                        case CRNRSTN_CSS_FRAMEWORK_SIMPLE_GRID:

                            $tmp_file_type_const = CRNRSTN_UI_CSS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_CSS & CRNRSTN_ASSET_MODE_BASE64;
                            
                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/simple_grid/simple-grid.min.css';
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
                            $tmp_file_path = '/_lib/frameworks/simple_grid/simple-grid.css';
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

                            $tmp_file_type_const = CRNRSTN_UI_CSS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_CSS & CRNRSTN_ASSET_MODE_BASE64;

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
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/reset.css';
                            $tmp_file_name = 'min/reset.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/reset.css';
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
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/text.css';
                            $tmp_file_name = 'min/text.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/text.css';
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
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/960.css';
                            $tmp_file_name = 'min/960.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/960.css';
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

                            $tmp_file_type_const = CRNRSTN_UI_CSS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/reset.css';
                            $tmp_file_name = 'min/reset.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/reset.css';
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
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/text.css';
                            $tmp_file_name = 'min/text.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/text.css';
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
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/960_24_col.css';
                            $tmp_file_name = 'min/960_24_col.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/960_24_col.css';
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

                            $tmp_file_type_const = CRNRSTN_UI_CSS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/reset.css';
                            $tmp_file_name = 'min/reset.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/reset.css';
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
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/text.css';
                            $tmp_file_name = 'min/text.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/text.css';
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
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/960_16_col.css';
                            $tmp_file_name = 'min/960_16_col.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/960_16_col.css';
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

                            $tmp_file_type_const = CRNRSTN_UI_CSS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/reset.css';
                            $tmp_file_name = 'min/reset.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/reset.css';
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
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/text.css';
                            $tmp_file_name = 'min/text.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/text.css';
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
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/960_12_col.css';
                            $tmp_file_name = 'min/960_12_col.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/960_12_col.css';
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

                            $tmp_file_type_const = CRNRSTN_UI_CSS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/reset.css';
                            $tmp_file_name = 'min/reset.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/reset.css';
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
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/text.css';
                            $tmp_file_name = 'min/text.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/text.css';
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
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/960_24_col_rtl.css';
                            $tmp_file_name = 'min/960_24_col_rtl.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/960_24_col_rtl.css';
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

                            $tmp_file_type_const = CRNRSTN_UI_CSS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/reset.css';
                            $tmp_file_name = 'min/reset.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/reset.css';
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
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/text.css';
                            $tmp_file_name = 'min/text.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/text.css';
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
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/960_16_col_rtl.css';
                            $tmp_file_name = 'min/960_16_col_rtl.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/960_16_col_rtl.css';
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

                            $tmp_file_type_const = CRNRSTN_UI_CSS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/reset.css';
                            $tmp_file_name = 'min/reset.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/reset.css';
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
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/text.css';
                            $tmp_file_name = 'min/text.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/text.css';
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
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/960_12_col_rtl.css';
                            $tmp_file_name = 'min/960_12_col_rtl.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/960_12_col_rtl.css';
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

                            $tmp_file_type_const = CRNRSTN_UI_CSS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/reset.css';
                            $tmp_file_name = 'min/reset.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/reset.css';
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
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/text.css';
                            $tmp_file_name = 'min/text.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/text.css';
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
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/960_rtl.css';
                            $tmp_file_name = 'min/960_rtl.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/960_rtl.css';
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

                            $tmp_file_type_const = CRNRSTN_UI_CSS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            //
                            // CHECK FOR PREVIOUS LOAD OF JQUERY
                            if(!isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_1_12_4])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_2_2_4])
                                && !isset($this->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_PLUS_JQUERY])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY])){

                                /////
                                // R :: RESOURCE //
                                $tmp_crnrstn_mod = NULL;
                                $tmp_file_path = '/_lib/frameworks/jquery/3.6.1/jquery-3.6.1.min.js';
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
                                $tmp_file_path = '/_lib/frameworks/jquery/3.6.1/jquery-3.6.1.js';
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
                            $tmp_file_path = '/_lib/frameworks/foundation/js/vendor/what-input.js';
                            $tmp_file_name = 'what-input.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/foundation/js/vendor/foundation.min.js';
                            $tmp_file_name = 'foundation.min.js';
                            $tmp_meta_type = 'text/javascript';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/foundation/js/vendor/foundation.js';
                            $tmp_file_name = 'foundation.js';
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

                            $tmp_file_type_const = CRNRSTN_UI_CSS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_CSS & CRNRSTN_ASSET_MODE_BASE64;

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
                            $tmp_file_path = '/_lib/frameworks/html5_boilerplate/8.0.0/css/normalize.css';
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
                            $tmp_file_path = '/_lib/frameworks/html5_boilerplate/8.0.0/css/main.css';
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
                            $tmp_file_path = '/_lib/frameworks/html5_boilerplate/8.0.0/js/vendor/modernizr-3.11.2.min.js';
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
                            $tmp_file_path = '/_lib/frameworks/html5_boilerplate/8.0.0/js/plugins.js';
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
                            $tmp_file_path = '/_lib/frameworks/html5_boilerplate/8.0.0/js/main.js';
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

                            $tmp_file_type_const = CRNRSTN_UI_CSS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_CSS & CRNRSTN_ASSET_MODE_BASE64;

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
                            $tmp_file_path = '/_lib/frameworks/responsivegridsystem/css/html5reset.css';
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
                            $tmp_file_path = '/_lib/frameworks/responsivegridsystem/css/col.css';
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
                            $tmp_file_path = '/_lib/frameworks/responsivegridsystem/css/2cols.css';
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
                            $tmp_file_path = '/_lib/frameworks/responsivegridsystem/css/3cols.css';
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
                            $tmp_file_path = '/_lib/frameworks/responsivegridsystem/css/4cols.css';
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
                            $tmp_file_path = '/_lib/frameworks/responsivegridsystem/css/5cols.css';
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
                            $tmp_file_path = '/_lib/frameworks/responsivegridsystem/css/6cols.css';
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
                            $tmp_file_path = '/_lib/frameworks/responsivegridsystem/css/7cols.css';
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
                            $tmp_file_path = '/_lib/frameworks/responsivegridsystem/css/8cols.css';
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
                            $tmp_file_path = '/_lib/frameworks/responsivegridsystem/css/9cols.css';
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
                            $tmp_file_path = '/_lib/frameworks/responsivegridsystem/css/10cols.css';
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
                            $tmp_file_path = '/_lib/frameworks/responsivegridsystem/css/11cols.css';
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
                            $tmp_file_path = '/_lib/frameworks/responsivegridsystem/css/12cols.css';
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

                            $tmp_file_type_const = CRNRSTN_UI_CSS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_CSS & CRNRSTN_ASSET_MODE_BASE64;

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
                            $tmp_file_path = '/_lib/frameworks/unsemantic/assets/javascripts/html5.js';
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
                            $tmp_file_path = '/_lib/frameworks/unsemantic/assets/stylesheets/unsemantic-grid-responsive.css';
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
                            $tmp_file_path = '/_lib/frameworks/unsemantic/assets/stylesheets/ie.css';
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

                            $tmp_file_type_const = CRNRSTN_UI_CSS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_CSS & CRNRSTN_ASSET_MODE_BASE64;

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
                            $tmp_file_path = '/_lib/frameworks/unsemantic/assets/javascripts/html5.js';
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
                            $tmp_file_path = '/_lib/frameworks/unsemantic/assets/stylesheets/unsemantic-grid-responsive-rtl.css';
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
                            $tmp_file_path = '/_lib/frameworks/unsemantic/assets/stylesheets/ie-rtl.css';
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

                            $tmp_file_type_const = CRNRSTN_UI_CSS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/unsemantic/assets/stylesheets/reset.css';
                            $tmp_file_name = 'frameworks/unsemantic/assets/stylesheets/reset.css';
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

                            $tmp_file_type_const = CRNRSTN_UI_CSS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/unsemantic/assets/stylesheets/reset-rtl.css';
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

                            $tmp_file_type_const = CRNRSTN_UI_CSS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_CSS & CRNRSTN_ASSET_MODE_BASE64;

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
                            $tmp_file_path = '/_lib/frameworks/unsemantic/assets/javascripts/html5.js';
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
                            $tmp_file_path = '/_lib/frameworks/unsemantic/assets/stylesheets/unsemantic-grid-base.css';
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
                            $tmp_file_path = '/_lib/frameworks/unsemantic/assets/stylesheets/unsemantic-grid-mobile.css';
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
                            $tmp_file_path = '/_lib/frameworks/unsemantic/assets/javascripts/adapt.min.js';
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

                            $tmp_file_type_const = CRNRSTN_UI_CSS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_CSS & CRNRSTN_ASSET_MODE_BASE64;

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
                            $tmp_file_path = '/_lib/frameworks/unsemantic/assets/javascripts/html5.js';
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
                            $tmp_file_path = '/_lib/frameworks/unsemantic/assets/stylesheets/unsemantic-grid-base-rtl.css';
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
                            $tmp_file_path = '/_lib/frameworks/unsemantic/assets/stylesheets/unsemantic-grid-mobile-rtl.css';
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
                            $tmp_file_path = '/_lib/frameworks/unsemantic/assets/javascripts/adapt.min.js';
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

                            $tmp_file_type_const = CRNRSTN_UI_CSS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            $tmp_str .= '<meta name="viewport" content="width=device-width">
                                <!-- a grid framework in 250 bytes? are you kidding me?! -->
';

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/dead_simple_grid/css/grid.css';
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
                                        .info    { width: 100%;   }
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
                            $tmp_file_path = '/_lib/frameworks/dead_simple_grid/css/screen.css';
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

                            $tmp_file_type_const = CRNRSTN_UI_CSS;

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
                            $tmp_file_path = '/_lib/frameworks/skeleton/2.0.4/css/normalize.css';
                            $tmp_file_name = '2.0.4/css/normalize.css';
                            $tmp_meta_type = 'text/css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_meta_type, $tmp_crnrstn_mod, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/skeleton/2.0.4/css/skeleton.css';
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

                            $tmp_file_type_const = CRNRSTN_UI_CSS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            $tmp_str .= '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width">';

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/rwdgrid/css/rwdgrid.min.css';
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
                            $tmp_file_path = '/_lib/frameworks/rwdgrid/css/rwdgrid.css';
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
                            $tmp_file_path = '/_lib/frameworks/rwdgrid/css/style.css';
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
                        case CRNRSTN_CSS_FRAMEWORK_THISISDALLAS_SIMPLEGRID:

                            $tmp_file_type_const = CRNRSTN_UI_CSS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/_lib/frameworks/thisisdallas_simple_grid/simplegrid.css';
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
                        case CRNRSTN_UI_CSS_MAIN_DESKTOP:

                            $tmp_file_type_const = CRNRSTN_UI_CSS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/crnrstn.main_desktop.css';
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
                        case CRNRSTN_UI_CSS_MAIN_TABLET:

                            $tmp_file_type_const = CRNRSTN_UI_CSS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/crnrstn.main_tablet.css';
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
                        case CRNRSTN_UI_CSS_MAIN_MOBILE:

                            $tmp_file_type_const = CRNRSTN_UI_CSS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_CSS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_crnrstn_mod = NULL;
                            $tmp_file_path = '/crnrstn.main_mobi.css';
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

                        $tmp_str_array[] = '    <!-- END CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: JS + CSS MODULE OUTPUT -->
';
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

                    $this->oCRNRSTN->initialize_bit(CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS, false);

                }else{

                    $this->oCRNRSTN->initialize_bit(CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS, true);


                }

            }

            return $tmp_str_array;

        }catch( Exception $e ){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return $tmp_str_array;

        }

    }

    public function return_system_image($system_asset_constant, $width_override = NULL, $height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $output_mode = NULL){

        if($this->oCRNRSTN->ssdtla_enabled === true || $output_mode === CRNRSTN_UI_IMG){

            if(!isset($output_mode)){

                $output_mode = CRNRSTN_UI_IMG;

            }

            //
            // THE TARGET
            // RAW IMAGE RETURN.
            //error_log(__LINE__ . ' asset mgr $system_asset_constant[' . $system_asset_constant . ']. $output_mode[' . $output_mode . '].');
            $tmp_data = $this->asset_data($system_asset_constant, $width_override, $height_override, $link_override, $alt_override, $title_override, $target_override, $output_mode);
            //$this->oCRNRSTN->reset_asset_request_meta();

            return $tmp_data;

        }else{

            if(!isset($output_mode)){

                $output_mode = CRNRSTN_UI_IMG_STR;

            }

            //
            // THE TARGET.
            // https://jony5.com/?crnrstn_0010111011=x.gif
            //error_log(__LINE__ . ' asset mgr $system_asset_constant[' . $system_asset_constant . ']. $output_mode[' . $output_mode . '].');
            $tmp_data = $this->asset_data($system_asset_constant, $width_override, $height_override, $link_override, $alt_override, $title_override, $target_override, $output_mode);

            //$this->oCRNRSTN->reset_asset_request_meta();
            return $tmp_data;

        }

    }

    public function return_creative($media_element_key, $output_mode_override = NULL, $asset_mode_override = NULL){

        $height_override = $link_override = $alt_override = $title_override = $target_override = $width_override = NULL;

        if(!isset($output_mode_override)){

            $output_mode = NULL;

        }else{

            //
            // BLIND OVERRIDE
            $output_mode = $output_mode_override;

        }

        if(isset($asset_mode_override)){

            if($asset_mode_override === CRNRSTN_UI_IMG_SOAP_DATA_TUNNEL){

                return '{' . $media_element_key . '::SOAP_TUNNEL}';

            }

        }

        //
        // LAST USE :: Saturday August 6, 2022 @ 1805 hrs
        // LAST USE :: Wednesday August 26, 2022 @ 0516 hrs
        // LAST USE :: Wednesday October 19, 2022 @ 0025 hrs ...print_r_str documentation integration testing
        //error_log(__LINE__ . ' img ' . __METHOD__ . ' $media_element_key=[' . $media_element_key . '] self::$image_output_mode=[' . self::$image_output_mode . '] $output_mode[' . $output_mode . '].');
        return $this->asset_data($media_element_key, $width_override, $height_override, $link_override, $alt_override, $title_override, $target_override, $output_mode);

    }

    public function client_asset_response($output_mode, $data_ARRAY){

        /*
        $tmp_data_ARRAY['crnrstn_asset_method_key'] = $this->crnrstn_asset_return_method_key;
        $tmp_data_ARRAY['crnrstn_asset_family'] = $this->crnrstn_asset_family;   // currently only css, js, system, social, or favicon
        $tmp_data_ARRAY['crnrstn_asset_key'] = $_GET[$tmp_session_salt];         // asset name/key
        $tmp_data_ARRAY['crnrstn_asset_meta_path'] = $this->crnrstn_asset_meta_path;
        $tmp_data_ARRAY['output_format'] = 'asset';

        'CRNRSTN_ASSET_MODE_ICO'
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
        [crnrstn_system_image_asset_manager::client_asset_response] [
        Array\n(\n
            [crnrstn_asset_method_key] => add_cookie\n
            [crnrstn_asset_family] => meta_preview_image\n
            [crnrstn_asset_key] => meta/php/add_cookie\n
            [output_format] => asset\n)\n].

        */

        //error_log(__LINE__ . ' asset mgr [' . __METHOD__ . '] [' . print_r($data_ARRAY, true) . '].');

        $this->asset_meta_path = '';
        if(isset($data_ARRAY['crnrstn_asset_method_key'])){

            $this->oCRNRSTN->asset_response_method_key = $data_ARRAY['crnrstn_asset_method_key'];

        }

        $this->oCRNRSTN->asset_request_asset_family = $data_ARRAY['crnrstn_asset_family'];
        $this->oCRNRSTN->asset_request_data_key = $data_ARRAY['crnrstn_asset_key'];

        if(isset($data_ARRAY['crnrstn_asset_meta_path'])){

            $this->asset_meta_path = $data_ARRAY['crnrstn_asset_meta_path'];

        }

        switch($this->oCRNRSTN->asset_request_asset_family){
            case 'favicon':

                $tmp_filepath = $this->oCRNRSTN->get_resource('crnrstn_favicon_asset_tunnel_route_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
                $tmp_date_lastmod = filemtime($tmp_filepath);
                //$tmp_date_lastmod = date('D, M j Y G:i:s T', strtotime($tmp_date_lastmod));
                $tmp_date_lastmod = date('D, j M Y G:i:s T', $tmp_date_lastmod);

                $tmp_header_options_ARRAY = array();//Cache-Control: public, max-age=forever=1yearlimit
                $tmp_header_options_ARRAY[] = 'Cache-Control: public, max-age=31536000';
                $tmp_header_options_ARRAY[] = 'Last-Modified: ' . $tmp_date_lastmod;
                $tmp_header_options_ARRAY[] = 'X-Frame-Options: SAMEORIGIN';

                //error_log(__LINE__ . ' asset mgr $tmp_meta_path[' . $this->asset_meta_path . ']. $this->oCRNRSTN->asset_response_method_key[' . $this->oCRNRSTN->asset_response_method_key . ']. asset_request_data_key=[' . $this->oCRNRSTN->asset_request_data_key . ']. asset_request_asset_family=[' . $this->oCRNRSTN->asset_request_asset_family . '].');

                $tmp_ARRAY = explode('/', $this->oCRNRSTN->asset_request_data_key);

                //
                // ADJUST VALUES BY DERIVING FAMILY AND KEY OVERRIDES FROM ORIGINAL DATA KEY VALUE.
                $this->oCRNRSTN->asset_request_asset_family = $tmp_ARRAY[0];
                $this->oCRNRSTN->asset_request_data_key = $tmp_ARRAY[1];

                $tmp_filepath .= '/' . $this->oCRNRSTN->asset_request_asset_family . '/' . $this->oCRNRSTN->asset_request_data_key;
                //error_log(__LINE__ . ' img asset mgr [' . $this->oCRNRSTN->asset_request_data_key . '][' . $this->oCRNRSTN->asset_request_asset_family . ']. $tmp_filepath=[' . $tmp_filepath . '].');

                $tmp_filename_clean = $this->process_for_filename($this->oCRNRSTN->asset_request_data_key);

                $tmp_curr_headers_ARRAY = headers_list();
                $tmp_crnrstn_signature_headers_ARRAY = $this->oCRNRSTN->header_signature_options_return();

                //
                // SOURCE :: https://stackoverflow.com/questions/9728269/content-length-and-other-http-headers
                // COMMENT :: https://stackoverflow.com/a/9728576
                // AUTHOR :: Neysor :: https://stackoverflow.com/users/1219121/neysor
                $tmp_filesize = filesize($tmp_filepath);
                $tmp_header_options_ARRAY[] = 'Content-Type: ' . mime_content_type($tmp_filepath);
                $tmp_header_options_ARRAY[] = 'Content-length: ' . $tmp_filesize;
                header('Content-Disposition: inline; filename="' . $tmp_filename_clean . '"');

                // header_options_add
                // header_options_apply
                // header_signature_options_return
                // ENSURE ALL SIGNATURE HEADERS ARE IN PLACE AND CONTINUE
                $this->oCRNRSTN->header_options_add($tmp_curr_headers_ARRAY);
                $this->oCRNRSTN->header_options_add($tmp_crnrstn_signature_headers_ARRAY);
                $this->oCRNRSTN->header_options_add($tmp_header_options_ARRAY);

                $this->oCRNRSTN->header_options_apply();

                $this->readfile_chunked($tmp_filepath);

                //ob_flush();
                if(ob_get_level() > 0){ob_flush();}
                flush();
                exit();

            break;
            case 'meta_preview_image':
            case 'system':
            case 'social':

                //error_log(__LINE__ . ' asset mgr $tmp_meta_path[' . $this->asset_meta_path . ']. $this->oCRNRSTN->asset_response_method_key/$media_element_key[' . $this->oCRNRSTN->asset_response_method_key . ']. asset_request_data_key=[' . $this->oCRNRSTN->asset_request_data_key . ']. asset_request_asset_family=[' . $this->oCRNRSTN->asset_request_asset_family . '].');
                //return $this->return_image_data($this->oCRNRSTN->asset_request_data_key, NULL, NULL, NULL, NULL, NULL, NULL, $this->oCRNRSTN->asset_request_asset_family, $output_mode);

                return $this->return_system_image($this->oCRNRSTN->asset_response_method_key, NULL, NULL, NULL, NULL, NULL, NULL, CRNRSTN_UI_IMG);

            break;
            case 'js':
            case 'css':
            case 'integrations':

                //error_log(__LINE__ . ' asset mgr $tmp_meta_path[' . $this->asset_meta_path . ']. $this->oCRNRSTN->asset_response_method_key[' . $this->oCRNRSTN->asset_response_method_key . ']. asset_request_data_key=[' . $this->oCRNRSTN->asset_request_data_key . ']. asset_request_asset_family=[' . $this->oCRNRSTN->asset_request_asset_family . '].');
                return $this->return_asset_data();

            break;

        }

    }

    private function asset_data($asset_data_key, $width_override = NULL, $height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $output_mode = NULL){

        switch($asset_data_key){
            case 'JQUERY_MOBILE_1_4_5_AJAX_LOADER':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/ajax-loader';
                $tmp_width = 46;
                $tmp_height = 46;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ACTION_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/action-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ACTION_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/action-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ALERT_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/alert-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_VIDEO_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/alert-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ARROW_D_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-d-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ARROW_D_L_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-d-l-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ARROW_D_L_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-d-l-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ARROW_D_R_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-d-r-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ARROW_D_R_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-d-r-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ARROW_D_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-d-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ARROW_L_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-l-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ARROW_L_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-l-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ARROW_R_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-r-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ARROW_R_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-r-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ARROW_U_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-u-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ARROW_U_L_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-u-l-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ARROW_U_L_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-u-l-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ARROW_U_R_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-u-r-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ARROW_U_R_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-u-r-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_ARROW_U_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-u-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_AUDIO_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/audio-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_AUDIO_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/audio-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_BACK_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/back-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_BACK_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/back-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_BARS_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/bars-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_BARS_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/bars-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_BULLETS_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/bullets-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_BULLETS_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/bullets-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_CALENDAR_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/calendar-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_CALENDAR_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/calendar-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_CAMERA_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/camera-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_CAMERA_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/camera-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_CARAT_D_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/carat-d-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_CARAT_D_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/carat-d-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_CARAT_L_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/carat-l-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_CARAT_L_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/carat-l-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_CARAT_R_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/carat-r-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_CARAT_R_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/carat-r-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_CARAT_U_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/carat-u-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_CARAT_U_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/carat-u-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_CHECK_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/check-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_CHECK_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/check-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_CLOCK_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/clock-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_CLOCK_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/clock-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_CLOUD_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/cloud-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_CLOUD_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/cloud-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_COMMENT_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/comment-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_COMMENT_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/comment-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_DELETE_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/delete-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_DELETE_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/delete-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_EDIT_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/edit-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_EDIT_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/edit-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_EYE_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/eye-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_EYE_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/eye-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_FORBIDDEN_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/forbidden-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_FORBIDDEN_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/forbidden-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_FORWARD_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/forward-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_FORWARD_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/forward-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_GEAR_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/gear-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_GEAR_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/gear-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_GRID_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/grid-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_GRID_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/grid-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_HEART_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/heart-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_HEART_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/heart-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_HOME_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/home-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_HOME_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/home-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_INFO_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/info-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_INFO_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/info-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_LOCATION_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/location-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_LOCATION_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/location-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_LOCK_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/lock-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_LOCK_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/lock-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_MAIL_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/mail-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_MAIL_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/mail-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_MINUS_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/minus-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_MINUS_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/minus-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_NAVIGATION_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/navigation-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_NAVIGATION_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/navigation-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_PHONE_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/phone-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_PHONE_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/phone-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_PLUS_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/plus-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_PLUS_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/plus-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_POWER_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/power-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_POWER_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/power-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_RECYCLE_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/recycle-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_RECYCLE_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/recycle-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_REFRESH_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/refresh-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_REFRESH_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/refresh-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_SEARCH_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/search-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_SEARCH_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/search-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_SHOP_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/shop-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_SHOP_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/shop-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_STAR_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/star-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_STAR_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/star-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_TAG_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/tag-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_TAG_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/tag-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_USER_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/user-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_USER_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/user-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_VIDEO_BLACK':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/video-black';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'JQUERY_MOBILE_1_4_5_ICONS_PNG_VIDEO_WHITE':

                $tmp_filename = 'framework/jquery_mobile_1_4_5/images/icons-png/video-white';
                $tmp_width = 14;
                $tmp_height = 14;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'LIGHTBOX_2.11.3_CLOSE':
                /*
                /_crnrstn/ui/js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/images/close.png
                /_crnrstn/ui/js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/images/loading.gif
                /_crnrstn/ui/js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/images/next.png
                /_crnrstn/ui/js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/images/prev.png

                */

                $tmp_filename = 'framework/lightbox/close';
                $tmp_width = 27;
                $tmp_height = 27;
                $tmp_alt_text = 'close';
                $tmp_title_text = 'close';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'LIGHTBOX_2.11.3_LOADING':

                $tmp_filename = 'framework/lightbox/loading';
                $tmp_width = 32;
                $tmp_height = 32;
                $tmp_alt_text = 'close';
                $tmp_title_text = 'close';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'LIGHTBOX_2.11.3_NEXT':

                $tmp_filename = 'framework/lightbox/next';
                $tmp_width = 50;
                $tmp_height = 45;
                $tmp_alt_text = 'close';
                $tmp_title_text = 'close';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'LIGHTBOX_2.11.3_PREV':

                $tmp_filename = 'framework/lightbox/prev';
                $tmp_width = 50;
                $tmp_height = 45;
                $tmp_alt_text = 'close';
                $tmp_title_text = 'close';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'LIGHTBOX_2.03.3_BLANK':

                $tmp_filename = 'framework/lightbox-2.03.3/blank';
                $tmp_width = 1;
                $tmp_height = 1;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'LIGHTBOX_2.03.3_CLOSE':

                $tmp_filename = 'framework/lightbox-2.03.3/close';
                $tmp_width = 27;
                $tmp_height = 27;
                $tmp_alt_text = 'close';
                $tmp_title_text = 'close';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'LIGHTBOX_2.03.3_LOADING':

                $tmp_filename = 'framework/lightbox-2.03.3/loading';
                $tmp_width = 32;
                $tmp_height = 32;
                $tmp_alt_text = 'loading';
                $tmp_title_text = 'loading';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'LIGHTBOX_2.03.3_NEXT':

                $tmp_filename = 'framework/lightbox-2.03.3/next';
                $tmp_width = 50;
                $tmp_height = 45;
                $tmp_alt_text = 'next';
                $tmp_title_text = 'next';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'LIGHTBOX_2.03.3_PREV':

                /*
                array(
                'framework/lightbox/close' => 'LIGHTBOX_CLOSE',
                'framework/lightbox/loading' => 'LIGHTBOX_LOADING',
                'framework/lightbox/next' => 'LIGHTBOX_NEXT',
                'framework/lightbox/prev' => 'LIGHTBOX_PREV'
                );

                */

                $tmp_filename = 'framework/lightbox-2.03.3/prev';
                $tmp_width = 50;
                $tmp_height = 45;
                $tmp_alt_text = 'prev';
                $tmp_title_text = 'prev';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'BASSDRIVE_FAVICON':

                $tmp_filename = 'favicon';
                $tmp_width = '';
                $tmp_height = '';
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'bassdrive';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_ASSET_MODE_ICO;

                //return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target, $tmp_asset_family, NULL);

            break;
            case 'JONY5_FAVICON':

                $tmp_filename = 'favicon';
                $tmp_width = '';
                $tmp_height = '';
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'jony5';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_ASSET_MODE_ICO;

                //return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target, $tmp_asset_family, NULL);

            break;
            case 'CRNRSTN_FAVICON':

                $tmp_filename = 'favicon';
                $tmp_width = '';
                $tmp_height = '';
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'crnrstn';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_ASSET_MODE_ICO;

                //return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target, $tmp_asset_family, NULL);

            break;
            case 'R_STONE_GIANT_PILLAR':

                $tmp_filename = 'r_stone_giant_pillar';
                $tmp_width = 336;
                $tmp_height = 3000;
                $tmp_alt_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'R_STONE_PILLAR':

                $tmp_filename = 'r_stone_pillar';
                $tmp_width = 112;
                $tmp_height = 1000;
                $tmp_alt_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'WOOD':

                $tmp_filename = 'wood';
                $tmp_width = 512;
                $tmp_height = 450;
                $tmp_alt_text = 'wood';
                $tmp_title_text = 'wood';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'STACHE':

                $tmp_filename = 'stache';
                $tmp_width = 93;
                $tmp_height = 30;
                $tmp_alt_text = 'stache';
                $tmp_title_text = 'stache';
                $tmp_link = 'http://jony5.com';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'STACHE_SOCIAL':

                $tmp_filename = 'stache_social';
                $tmp_width = 93;
                $tmp_height = 30;
                $tmp_alt_text = 'stache';
                $tmp_title_text = 'stache';
                $tmp_link = 'http://jony5.com';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'UI_PAGELOAD_INDICATOR':

                $tmp_filename = 'element_page_load_indicator';
                $tmp_width = 17;
                $tmp_height = 3000;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_META_PREVIEW':

                $tmp_filename = 'crnrstn_logo_social_preview_github_00';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'ADD_COOKIE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'add_cookie';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'ADD_RAW_COOKIE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'add_raw_cookie';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'ADD_SYSTEM_RESOURCE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'add_system_resource';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'BETTER_SCANDIR_SOCIAL_META_PREVIEW':

                $tmp_filename = 'better_scandir';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'BIT_STRINGIN_SOCIAL_META_PREVIEW':

                $tmp_filename = 'bit_stringin';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'BIT_STRINGOUT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'bit_stringout';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CATCH_EXCEPTION_SOCIAL_META_PREVIEW':

                $tmp_filename = 'catch_exception';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CLEAR_ALL_BITS_SET_ONE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'clear_all_bits_set_one';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CONFIG_ADD_DATABASE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_add_database';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CONFIG_ADD_ENVIRONMENT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_add_environment';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CONFIG_ADD_SEO_ANALYTICS_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_add_seo_analytics';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CONFIG_ADD_SEO_ENGAGEMENT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_add_seo_engagement';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CONFIG_ADD_SYSTEM_RESOURCE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_add_system_resource';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CONFIG_DENY_ACCESS_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_deny_access';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CONFIG_DETECT_ENVIRONMENT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_detect_environment';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CONFIG_INCLUDE_ENCRYPTION_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_include_encryption';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CONFIG_INCLUDE_SEO_ANALYTICS_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_include_seo_analytics';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CONFIG_INCLUDE_SEO_ENGAGEMENT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_include_seo_engagement';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CONFIG_INCLUDE_SOCIAL_MEDIA_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_include_social_media';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CONFIG_INCLUDE_SQL_SILO_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_include_sql_silo';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CONFIG_INCLUDE_SYSTEM_RESOURCES_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_include_system_resources';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CONFIG_INCLUDE_WORDPRESS_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_include_wordpress';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CONFIG_INI_SET_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_ini_set';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CONFIG_INIT_ASSET_MAPPING_CSS_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_init_asset_mapping_css';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CONFIG_INIT_ASSET_MAPPING_FAVICON_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_init_asset_mapping_favicon';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CONFIG_INIT_ASSET_MAPPING_JS_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_init_asset_mapping_js';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CONFIG_INIT_ASSET_MAPPING_SOCIAL_IMG_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_init_asset_mapping_social_img';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CONFIG_INIT_ASSET_MAPPING_SYSTEM_IMG_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_init_asset_mapping_system_img';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CONFIG_INIT_COOKIE_ENCRYPTION_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_init_cookie_encryption';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CONFIG_INIT_DATABASE_ENCRYPTION_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_init_database_encryption';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CONFIG_INIT_HTML_MODE_EMAIL_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_init_html_mode_email';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CONFIG_INIT_HTTP_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_init_http';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CONFIG_INIT_JS_CSS_MINIMIZATION_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_init_js_css_minimization';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CONFIG_INIT_LOGGING_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_init_logging';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CONFIG_INIT_OERSL_ENCRYPTION_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_init_oersl_encryption';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CONFIG_INIT_SESSION_ENCRYPTION_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_init_session_encryption';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CONFIG_INIT_SOAP_ENCRYPTION_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_init_soap_encryption';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CONFIG_INIT_SYSTEM_ASSET_MODE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_init_system_asset_mode';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CONFIG_INIT_TUNNEL_ENCRYPTION_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_init_tunnel_encryption';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CONFIG_LOAD_DEFAULTS_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_load_defaults';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CONFIG_SET_CRNRSTN_AS_ERR_HANDLER_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_set_crnrstn_as_err_handler';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CONFIG_SET_TIMEZONE_DEFAULT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_set_timezone_default';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CONFIG_SET_UI_THEME_STYLE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'config_set_ui_theme_style';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'DATA_DECRYPT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'data_decrypt';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'DATA_ENCRYPT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'data_encrypt';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'DELETE_ALL_COOKIES_SOCIAL_META_PREVIEW':

                $tmp_filename = 'delete_all_cookies';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'DELETE_COOKIE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'delete_cookie';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'DEVICE_TYPE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'device_type';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'DEVICE_TYPE_BIT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'device_type_bit';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'ERROR_LOG_SOCIAL_META_PREVIEW':

                $tmp_filename = 'error_log';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'FORMAT_BYTES_SOCIAL_META_PREVIEW':

                $tmp_filename = 'format_bytes';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'GENERATE_NEW_KEY_SOCIAL_META_PREVIEW':

                $tmp_filename = 'generate_new_key';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'GET_COOKIE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'get_cookie';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'GET_DISK_FREE_SPACE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'get_disk_free_space';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'GET_DISK_PERFORMANCE_METRIC_SOCIAL_META_PREVIEW':

                $tmp_filename = 'get_disk_performance_metric';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'GET_DISK_SIZE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'get_disk_size';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'GET_HEADERS_SOCIAL_META_PREVIEW':

                $tmp_filename = 'get_headers';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'GET_MOBILE_BROWSERS_SOCIAL_META_PREVIEW':

                $tmp_filename = 'get_mobile_browsers';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'GET_MOBILE_DEVICES_SOCIAL_META_PREVIEW':

                $tmp_filename = 'get_mobile_devices';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'GET_MOBILE_OS_SOCIAL_META_PREVIEW':

                $tmp_filename = 'get_mobile_os';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'GET_RESOURCE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'get_resource';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'GET_RESOURCE_COUNT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'get_resource_count';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'GET_TABLET_DEVICES_SOCIAL_META_PREVIEW':

                $tmp_filename = 'get_tablet_devices';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'GET_USER_AGENT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'get_user_agent';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'GRANT_PERMISSIONS_FWRITE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'grant_permissions_fwrite';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'HASH_SOCIAL_META_PREVIEW':

                $tmp_filename = 'hash';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'HEADER_OPTIONS_ADD_SOCIAL_META_PREVIEW':

                $tmp_filename = 'header_options_add';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'HEADER_OPTIONS_APPLY_SOCIAL_META_PREVIEW':

                $tmp_filename = 'header_options_apply';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'HEADER_SIGNATURE_OPTIONS_RETURN_SOCIAL_META_PREVIEW':

                $tmp_filename = 'header_signature_options_return';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'INI_GET_SOCIAL_META_PREVIEW':

                $tmp_filename = 'ini_get';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'INI_SET_SOCIAL_META_PREVIEW':

                $tmp_filename = 'ini_set';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'INITIALIZE_BIT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'initialize_bit';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'INITIALIZE_SERIALIZED_BIT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'initialize_serialized_bit';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'IS_BIT_SET_SOCIAL_META_PREVIEW':

                $tmp_filename = 'is_bit_set';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'IS_CONFIGURED_SOCIAL_META_PREVIEW':

                $tmp_filename = 'is_configured';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'IS_MOBILE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'is_mobile';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'IS_SERIALIZED_BIT_SET_SOCIAL_META_PREVIEW':

                $tmp_filename = 'is_serialized_bit_set';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'IS_SSL_SOCIAL_META_PREVIEW':

                $tmp_filename = 'is_ssl';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'IS_TABLET_SOCIAL_META_PREVIEW':

                $tmp_filename = 'is_tablet';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'ISO_LANGUAGE_HTML_SOCIAL_META_PREVIEW':

                $tmp_filename = 'iso_language_html';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'ISO_LANGUAGE_PROFILE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'iso_language_profile';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'ISO_LANGUAGE_PROFILE_COUNT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'iso_language_profile_count';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'ISSET_DATA_KEY_SOCIAL_META_PREVIEW':

                $tmp_filename = 'isset_data_key';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'ISSET_ENCRYPTION_SOCIAL_META_PREVIEW':

                $tmp_filename = 'isset_encryption';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'OPENSSL_GET_CIPHER_METHODS_SOCIAL_META_PREVIEW':

                $tmp_filename = 'openssl_get_cipher_methods';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'PRINT_R_SOCIAL_META_PREVIEW':

                $tmp_filename = 'print_r';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'PRINT_R_STR_SOCIAL_META_PREVIEW':

                $tmp_filename = 'print_r_str';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'PROPER_VERSION_SOCIAL_META_PREVIEW':

                $tmp_filename = 'proper_version';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'RETURN_DDO_KEY_SOCIAL_META_PREVIEW':

                $tmp_filename = 'return_ddo_key';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'RETURN_INT_CONST_PROFILE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'return_int_const_profile';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'RETURN_SET_BITS_SOCIAL_META_PREVIEW':

                $tmp_filename = 'return_set_bits';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'RETURN_STICKY_MEDIA_LINK_SOCIAL_META_PREVIEW':

                $tmp_filename = 'return_sticky_media_link';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'RETURN_SYSTEM_IMAGE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'return_system_image';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'RETURN_YOUTUBE_EMBED_SOCIAL_META_PREVIEW':

                $tmp_filename = 'return_youtube_embed';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SALT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'salt';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SERIALIZED_BIT_STRINGIN_SOCIAL_META_PREVIEW':

                $tmp_filename = 'serialized_bit_stringin';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SERIALIZED_BIT_STRINGOUT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'serialized_bit_stringout';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SET_DESKTOP_SOCIAL_META_PREVIEW':

                $tmp_filename = 'set_desktop';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SET_MOBILE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'set_mobile';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SET_TABLET_SOCIAL_META_PREVIEW':

                $tmp_filename = 'set_tablet';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SET_TIMEZONE_DEFAULT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'set_timezone_default';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SET_UI_THEME_STYLE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'set_ui_theme_style';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOAP_DEFENCODING_SOCIAL_META_PREVIEW':

                $tmp_filename = 'soap_defencoding';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'STRRTRIM_SOCIAL_META_PREVIEW':

                $tmp_filename = 'strrtrim';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SYSTEM_BASE64_SYNCHRONIZE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'system_base64_synchronize';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SYSTEM_HASH_ALGO_SOCIAL_META_PREVIEW':

                $tmp_filename = 'system_hash_algo';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SYSTEM_OUTPUT_FOOTER_HTML_SOCIAL_META_PREVIEW':

                $tmp_filename = 'system_output_footer_html';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SYSTEM_OUTPUT_HEAD_HTML_SOCIAL_META_PREVIEW':

                $tmp_filename = 'system_output_head_html';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'TOGGLE_BIT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'toggle_bit';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'TOGGLE_SERIALIZED_BIT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'toggle_serialized_bit';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'VAR_DUMP_SOCIAL_META_PREVIEW':

                $tmp_filename = 'var_dump';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'VERSION_APACHE_SOCIAL_META_PREVIEW':

                $tmp_filename = 'version_apache';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'VERSION_CRNRSTN_SOCIAL_META_PREVIEW':

                $tmp_filename = 'version_crnrstn';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'VERSION_LINUX_SOCIAL_META_PREVIEW':

                $tmp_filename = 'version_linux';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'VERSION_MOBILE_DETECT_SOCIAL_META_PREVIEW':

                $tmp_filename = 'version_mobile_detect';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'VERSION_MYSQLI_SOCIAL_META_PREVIEW':

                $tmp_filename = 'version_mysqli';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'VERSION_OPENSSL_SOCIAL_META_PREVIEW':

                $tmp_filename = 'version_openssl';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'VERSION_PHP_SOCIAL_META_PREVIEW':

                $tmp_filename = 'version_php';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'VERSION_SOAP_SOCIAL_META_PREVIEW':

                $tmp_filename = 'version_soap';
                $tmp_width = 1280;
                $tmp_height = 640;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'meta';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;

            /*
            $tmp_ARRAY = array('add_cookie' => 'ADD_COOKIE_SOCIAL_META_PREVIEW', 'add_raw_cookie' => 'ADD_RAW_COOKIE_SOCIAL_META_PREVIEW',
            'add_system_resource' => 'ADD_SYSTEM_RESOURCE_SOCIAL_META_PREVIEW', 'better_scandir' => 'BETTER_SCANDIR_SOCIAL_META_PREVIEW',
            'bit_stringin' => 'BIT_STRINGIN_SOCIAL_META_PREVIEW', 'bit_stringout' => 'BIT_STRINGOUT_SOCIAL_META_PREVIEW', 'catch_exception' => 'CATCH_EXCEPTION_SOCIAL_META_PREVIEW',
            'clear_all_bits_set_one' => 'CLEAR_ALL_BITS_SET_ONE_SOCIAL_META_PREVIEW', 'config_add_database' => 'CONFIG_ADD_DATABASE_SOCIAL_META_PREVIEW',
            'config_add_environment' => 'CONFIG_ADD_ENVIRONMENT_SOCIAL_META_PREVIEW', 'config_add_seo_analytics' => 'CONFIG_ADD_SEO_ANALYTICS_SOCIAL_META_PREVIEW',
            'config_add_seo_engagement' => 'CONFIG_ADD_SEO_ENGAGEMENT_SOCIAL_META_PREVIEW', 'config_add_system_resource' => 'CONFIG_ADD_SYSTEM_RESOURCE_SOCIAL_META_PREVIEW',
            'config_deny_access' => 'CONFIG_DENY_ACCESS_SOCIAL_META_PREVIEW', 'config_detect_environment' => 'CONFIG_DETECT_ENVIRONMENT_SOCIAL_META_PREVIEW',
            'config_include_encryption' => 'CONFIG_INCLUDE_ENCRYPTION_SOCIAL_META_PREVIEW', 'config_include_seo_analytics' => 'CONFIG_INCLUDE_SEO_ANALYTICS_SOCIAL_META_PREVIEW',
            'config_include_seo_engagement' => 'CONFIG_INCLUDE_SEO_ENGAGEMENT_SOCIAL_META_PREVIEW', 'config_include_social_media' => 'CONFIG_INCLUDE_SOCIAL_MEDIA_SOCIAL_META_PREVIEW',
            'config_include_sql_silo' => 'CONFIG_INCLUDE_SQL_SILO_SOCIAL_META_PREVIEW', 'config_include_system_resources' => 'CONFIG_INCLUDE_SYSTEM_RESOURCES_SOCIAL_META_PREVIEW',
            'config_include_wordpress' => 'CONFIG_INCLUDE_WORDPRESS_SOCIAL_META_PREVIEW', 'config_ini_set' => 'CONFIG_INI_SET_SOCIAL_META_PREVIEW',
            'config_init_asset_mapping_css' => 'CONFIG_INIT_ASSET_MAPPING_CSS_SOCIAL_META_PREVIEW', 'config_init_asset_mapping_favicon' => 'CONFIG_INIT_ASSET_MAPPING_FAVICON_SOCIAL_META_PREVIEW',
            'config_init_asset_mapping_js' => 'CONFIG_INIT_ASSET_MAPPING_JS_SOCIAL_META_PREVIEW', 'config_init_asset_mapping_social_img' => 'CONFIG_INIT_ASSET_MAPPING_SOCIAL_IMG_SOCIAL_META_PREVIEW',
            'config_init_asset_mapping_system_img' => 'CONFIG_INIT_ASSET_MAPPING_SYSTEM_IMG_SOCIAL_META_PREVIEW', 'config_init_cookie_encryption' => 'CONFIG_INIT_COOKIE_ENCRYPTION_SOCIAL_META_PREVIEW',
            'config_init_database_encryption' => 'CONFIG_INIT_DATABASE_ENCRYPTION_SOCIAL_META_PREVIEW', 'config_init_html_mode_email' => 'CONFIG_INIT_HTML_MODE_EMAIL_SOCIAL_META_PREVIEW',
            'config_init_http' => 'CONFIG_INIT_HTTP_SOCIAL_META_PREVIEW', 'config_init_js_css_minimization' => 'CONFIG_INIT_JS_CSS_MINIMIZATION_SOCIAL_META_PREVIEW',
            'config_init_logging' => 'CONFIG_INIT_LOGGING_SOCIAL_META_PREVIEW', 'config_init_oersl_encryption' => 'CONFIG_INIT_OERSL_ENCRYPTION_SOCIAL_META_PREVIEW',
            'config_init_session_encryption' => 'CONFIG_INIT_SESSION_ENCRYPTION_SOCIAL_META_PREVIEW', 'config_init_soap_encryption' => 'CONFIG_INIT_SOAP_ENCRYPTION_SOCIAL_META_PREVIEW',
            'config_init_system_asset_mode' => 'CONFIG_INIT_SYSTEM_ASSET_MODE_SOCIAL_META_PREVIEW', 'config_init_tunnel_encryption' => 'CONFIG_INIT_TUNNEL_ENCRYPTION_SOCIAL_META_PREVIEW',
            'config_load_defaults' => 'CONFIG_LOAD_DEFAULTS_SOCIAL_META_PREVIEW', 'config_set_crnrstn_as_err_handler' => 'CONFIG_SET_CRNRSTN_AS_ERR_HANDLER_SOCIAL_META_PREVIEW',
            'config_set_timezone_default' => 'CONFIG_SET_TIMEZONE_DEFAULT_SOCIAL_META_PREVIEW', 'config_set_ui_theme_style' => 'CONFIG_SET_UI_THEME_STYLE_SOCIAL_META_PREVIEW',
            'data_decrypt' => 'DATA_DECRYPT_SOCIAL_META_PREVIEW', 'data_encrypt' => 'DATA_ENCRYPT_SOCIAL_META_PREVIEW', 'delete_all_cookies' => 'DELETE_ALL_COOKIES_SOCIAL_META_PREVIEW',
            'delete_cookie' => 'DELETE_COOKIE_SOCIAL_META_PREVIEW', 'device_type' => 'DEVICE_TYPE_SOCIAL_META_PREVIEW', 'device_type_bit' => 'DEVICE_TYPE_BIT_SOCIAL_META_PREVIEW',
            'error_log' => 'ERROR_LOG_SOCIAL_META_PREVIEW', 'format_bytes' => 'FORMAT_BYTES_SOCIAL_META_PREVIEW', 'generate_new_key' => 'GENERATE_NEW_KEY_SOCIAL_META_PREVIEW',
            'get_cookie' => 'GET_COOKIE_SOCIAL_META_PREVIEW', 'get_disk_free_space' => 'GET_DISK_FREE_SPACE_SOCIAL_META_PREVIEW', 'get_disk_performance_metric' => 'GET_DISK_PERFORMANCE_METRIC_SOCIAL_META_PREVIEW',
            'get_disk_size' => 'GET_DISK_SIZE_SOCIAL_META_PREVIEW', 'get_headers' => 'GET_HEADERS_SOCIAL_META_PREVIEW', 'get_mobile_browsers' => 'GET_MOBILE_BROWSERS_SOCIAL_META_PREVIEW',
            'get_mobile_devices' => 'GET_MOBILE_DEVICES_SOCIAL_META_PREVIEW', 'get_mobile_os' => 'GET_MOBILE_OS_SOCIAL_META_PREVIEW', 'get_resource' => 'GET_RESOURCE_SOCIAL_META_PREVIEW',
            'get_resource_count' => 'GET_RESOURCE_COUNT_SOCIAL_META_PREVIEW', 'get_tablet_devices' => 'GET_TABLET_DEVICES_SOCIAL_META_PREVIEW', 'get_user_agent' => 'GET_USER_AGENT_SOCIAL_META_PREVIEW',
            'grant_permissions_fwrite' => 'GRANT_PERMISSIONS_FWRITE_SOCIAL_META_PREVIEW', 'hash' => 'HASH_SOCIAL_META_PREVIEW', 'header_options_add' => 'HEADER_OPTIONS_ADD_SOCIAL_META_PREVIEW',
            'header_options_apply' => 'HEADER_OPTIONS_APPLY_SOCIAL_META_PREVIEW', 'header_signature_options_return' => 'HEADER_SIGNATURE_OPTIONS_RETURN_SOCIAL_META_PREVIEW',
            'ini_get' => 'INI_GET_SOCIAL_META_PREVIEW', 'ini_set' => 'INI_SET_SOCIAL_META_PREVIEW', 'initialize_bit' => 'INITIALIZE_BIT_SOCIAL_META_PREVIEW',
            'initialize_serialized_bit' => 'INITIALIZE_SERIALIZED_BIT_SOCIAL_META_PREVIEW', 'is_bit_set' => 'IS_BIT_SET_SOCIAL_META_PREVIEW',
            'is_configured' => 'IS_CONFIGURED_SOCIAL_META_PREVIEW', 'is_mobile' => 'IS_MOBILE_SOCIAL_META_PREVIEW', 'is_serialized_bit_set' => 'IS_SERIALIZED_BIT_SET_SOCIAL_META_PREVIEW',
            'is_ssl' => 'IS_SSL_SOCIAL_META_PREVIEW', 'is_tablet' => 'IS_TABLET_SOCIAL_META_PREVIEW', 'iso_language_html' => 'ISO_LANGUAGE_HTML_SOCIAL_META_PREVIEW',
            'iso_language_profile' => 'ISO_LANGUAGE_PROFILE_SOCIAL_META_PREVIEW', 'iso_language_profile_count' => 'ISO_LANGUAGE_PROFILE_COUNT_SOCIAL_META_PREVIEW',
            'isset_data_key' => 'ISSET_DATA_KEY_SOCIAL_META_PREVIEW', 'isset_encryption' => 'ISSET_ENCRYPTION_SOCIAL_META_PREVIEW', 'openssl_get_cipher_methods' => 'OPENSSL_GET_CIPHER_METHODS_SOCIAL_META_PREVIEW',
            'print_r' => 'PRINT_R_SOCIAL_META_PREVIEW', 'print_r_str' => 'PRINT_R_STR_SOCIAL_META_PREVIEW', 'proper_version' => 'PROPER_VERSION_SOCIAL_META_PREVIEW',
            'return_ddo_key' => 'RETURN_DDO_KEY_SOCIAL_META_PREVIEW', 'return_int_const_profile' => 'RETURN_INT_CONST_PROFILE_SOCIAL_META_PREVIEW', 'return_set_bits' => 'RETURN_SET_BITS_SOCIAL_META_PREVIEW',
            'return_sticky_media_link' => 'RETURN_STICKY_MEDIA_LINK_SOCIAL_META_PREVIEW', 'return_system_image' => 'RETURN_SYSTEM_IMAGE_SOCIAL_META_PREVIEW',
            'return_youtube_embed' => 'RETURN_YOUTUBE_EMBED_SOCIAL_META_PREVIEW', 'salt' => 'SALT_SOCIAL_META_PREVIEW', 'serialized_bit_stringin' => 'SERIALIZED_BIT_STRINGIN_SOCIAL_META_PREVIEW',
            'serialized_bit_stringout' => 'SERIALIZED_BIT_STRINGOUT_SOCIAL_META_PREVIEW', 'set_desktop' => 'SET_DESKTOP_SOCIAL_META_PREVIEW', 'set_mobile' => 'SET_MOBILE_SOCIAL_META_PREVIEW',
            'set_tablet' => 'SET_TABLET_SOCIAL_META_PREVIEW', 'set_timezone_default' => 'SET_TIMEZONE_DEFAULT_SOCIAL_META_PREVIEW', 'set_ui_theme_style' => 'SET_UI_THEME_STYLE_SOCIAL_META_PREVIEW',
            'soap_defencoding' => 'SOAP_DEFENCODING_SOCIAL_META_PREVIEW', 'strrtrim' => 'STRRTRIM_SOCIAL_META_PREVIEW', 'system_base64_synchronize' => 'SYSTEM_BASE64_SYNCHRONIZE_SOCIAL_META_PREVIEW',
            'system_hash_algo' => 'SYSTEM_HASH_ALGO_SOCIAL_META_PREVIEW', 'system_output_footer_html' => 'SYSTEM_OUTPUT_FOOTER_HTML_SOCIAL_META_PREVIEW',
            'system_output_head_html' => 'SYSTEM_OUTPUT_HEAD_HTML_SOCIAL_META_PREVIEW', 'toggle_bit' => 'TOGGLE_BIT_SOCIAL_META_PREVIEW', 'toggle_serialized_bit' => 'TOGGLE_SERIALIZED_BIT_SOCIAL_META_PREVIEW',
            'var_dump' => 'VAR_DUMP_SOCIAL_META_PREVIEW', 'version_apache' => 'VERSION_APACHE_SOCIAL_META_PREVIEW', 'version_crnrstn' => 'VERSION_CRNRSTN_SOCIAL_META_PREVIEW',
            'version_linux' => 'VERSION_LINUX_SOCIAL_META_PREVIEW', 'version_mobile_detect' => 'VERSION_MOBILE_DETECT_SOCIAL_META_PREVIEW',
            'version_mysqli' => 'VERSION_MYSQLI_SOCIAL_META_PREVIEW', 'version_openssl' => 'VERSION_OPENSSL_SOCIAL_META_PREVIEW', 'version_php' => 'VERSION_PHP_SOCIAL_META_PREVIEW',
            'version_soap' => 'VERSION_SOAP_SOCIAL_META_PREVIEW');

            */
            case 'SOCIAL_AMAZON':

                $tmp_filename = 'amazon_icon';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Amazon';
                $tmp_title_text = 'Link to Amazon related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_AMAZON_HQ':

                $tmp_filename = 'amazon_icon_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Amazon';
                $tmp_title_text = 'Link to Amazon related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_APPLE_LOGO_BLK':

                $tmp_filename = 'apple_logo_blk';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Apple';
                $tmp_title_text = 'Link to Apple related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_APPLE_LOGO_BLK_HQ':

                $tmp_filename = 'apple_logo_blk_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Apple';
                $tmp_title_text = 'Link to Apple related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_APPLE_LOGO_BLK_WHT_CIRCLE':

                $tmp_filename = 'apple_logo_blk_wht_circle';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Apple';
                $tmp_title_text = 'Link to Apple related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_APPLE_LOGO_BLK_WHT_CIRCLE_HQ':

                $tmp_filename = 'apple_logo_blk_wht_circle_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Apple';
                $tmp_title_text = 'Link to Apple related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_APPLE_LOGO_GREY':

                $tmp_filename = 'apple_logo_grey';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Apple';
                $tmp_title_text = 'Link to Apple related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_APPLE_LOGO_GREY_HQ':

                $tmp_filename = 'apple_logo_grey_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Apple';
                $tmp_title_text = 'Link to Apple related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_APPLE_LOGO_GREY_BLK_CIRCLE':

                $tmp_filename = 'apple_logo_grey_blk_circle';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Apple';
                $tmp_title_text = 'Link to Apple related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_APPLE_LOGO_GREY_BLK_CIRCLE_HQ':

                $tmp_filename = 'apple_logo_grey_blk_circle_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Apple';
                $tmp_title_text = 'Link to Apple related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_APPLE_LOGO_GREY_WHT_CIRCLE':

                $tmp_filename = 'apple_logo_grey_wht_circle';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Apple';
                $tmp_title_text = 'Link to Apple related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_APPLE_LOGO_GREY_WHT_CIRCLE_HQ':

                $tmp_filename = 'apple_logo_grey_wht_circle_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Apple';
                $tmp_title_text = 'Link to Apple related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_APPLE_LOGO_WHT':

                $tmp_filename = 'apple_logo_wht';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Apple';
                $tmp_title_text = 'Link to Apple related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_APPLE_LOGO_WHT_HQ':

                $tmp_filename = 'apple_logo_wht_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Apple';
                $tmp_title_text = 'Link to Apple related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_APPLE_LOGO_WHT_BLK_CIRCLE':

                $tmp_filename = 'apple_logo_wht_blk_circle';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Apple';
                $tmp_title_text = 'Link to Apple related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_APPLE_LOGO_WHT_BLK_CIRCLE_HQ':

                $tmp_filename = 'apple_logo_wht_blk_circle_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Apple';
                $tmp_title_text = 'Link to Apple related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_APPLE_MUSIC':

                $tmp_filename = 'apple_music';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Apple Music';
                $tmp_title_text = 'Link to Apple Music related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_APPLE_MUSIC_HQ':

                $tmp_filename = 'apple_music_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Apple Music';
                $tmp_title_text = 'Link to Apple Music related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_ARCHIVES':

                $tmp_filename = 'archives';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Archives';
                $tmp_title_text = 'Link to Archives.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_ARCHIVES_HQ':

                $tmp_filename = 'archives_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Archives';
                $tmp_title_text = 'Link to Archives.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_BANDCAMP':

                $tmp_filename = 'bandcamp';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Bandcamp';
                $tmp_title_text = 'Link to Bandcamp music page.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_BANDCAMP_HQ':

                $tmp_filename = 'bandcamp_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Bandcamp';
                $tmp_title_text = 'Link to Bandcamp music page.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_BASSDRIVE':

                $tmp_filename = 'bassdrive';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Bassdrive';
                $tmp_title_text = 'Link to Bassdrive profile.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_BASSDRIVE_HQ':

                $tmp_filename = 'bassdrive_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Bassdrive';
                $tmp_title_text = 'Link to Bassdrive profile.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_BEATPORT':

                $tmp_filename = 'beatport';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Beatport';
                $tmp_title_text = 'Link to Beatport featured tracks.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_BEATPORT_HQ':

                $tmp_filename = 'beatport_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Beatport';
                $tmp_title_text = 'Link to Beatport featured tracks.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_BLOGSPOT':

                $tmp_filename = 'blogspot';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Blogspot';
                $tmp_title_text = 'Link to Blogspot related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_BLOGSPOT_HQ':

                $tmp_filename = 'blogspot_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Blogspot';
                $tmp_title_text = 'Link to Blogspot related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_BLUEHOST_ICON':

                $tmp_filename = 'bluehost_icon';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Bluehost';
                $tmp_title_text = 'Link to Bluehost related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_BLUEHOST_ICON_HQ':

                $tmp_filename = 'bluehost_icon_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Bluehost';
                $tmp_title_text = 'Link to Bluehost related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_BLUEHOST_WORDMARK':

                $tmp_filename = 'bluehost_wordmark';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Bluehost';
                $tmp_title_text = 'Link to Bluehost related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_BLUEHOST_WORDMARK_HQ':

                $tmp_filename = 'bluehost_wordmark_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Bluehost';
                $tmp_title_text = 'Link to Bluehost related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_DISCOGS':

                $tmp_filename = 'discogs';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Discogs';
                $tmp_title_text = 'Link to Discogs music selection.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_DISCOGS_HQ':

                $tmp_filename = 'discogs_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Discogs';
                $tmp_title_text = 'Link to Discogs music selection.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_DRIBBLE':

                $tmp_filename = 'dribble';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Dribble';
                $tmp_title_text = 'Link to Dribble resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_DRIBBLE_HQ':

                $tmp_filename = 'dribble_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Dribble';
                $tmp_title_text = 'Link to Dribble resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_EBAY':

                $tmp_filename = 'ebay';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Ebay';
                $tmp_title_text = 'Link to Ebay related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_EBAY_HQ':

                $tmp_filename = 'ebay_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Ebay';
                $tmp_title_text = 'Link to Ebay related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_ETSY':

                $tmp_filename = 'etsy';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Etsy';
                $tmp_title_text = 'Link to Etsy related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_ETSY_HQ':

                $tmp_filename = 'etsy_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Etsy';
                $tmp_title_text = 'Link to Etsy related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_FACEBOOK':

                $tmp_filename = 'facebook';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Facebook';
                $tmp_title_text = 'Link to Facebook page.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_FACEBOOK_HQ':

                $tmp_filename = 'facebook_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Facebook';
                $tmp_title_text = 'Link to Facebook page.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_FEEDBURNER':

                $tmp_filename = 'feedburner';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Feedburner';
                $tmp_title_text = 'Link to Feedburner proxy resources.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_FEEDBURNER_HQ':

                $tmp_filename = 'feedburner_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Feedburner';
                $tmp_title_text = 'Link to Feedburner proxy resources.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_FLICKR':

                $tmp_filename = 'flickr';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Flickr';
                $tmp_title_text = 'Link to Flickr related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_FLICKR_HQ':

                $tmp_filename = 'flickr_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Flickr';
                $tmp_title_text = 'Link to Flickr related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_GITHUB':

                $tmp_filename = 'github';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'GitHub';
                $tmp_title_text = 'Link to GitHub related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_GITHUB_HQ':

                $tmp_filename = 'github_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'GitHub';
                $tmp_title_text = 'Link to GitHub related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_GOOGLE_DRIVE':

                $tmp_filename = 'google_drive';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Google Drive';
                $tmp_title_text = 'Link to Google Drive related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_GOOGLE_DRIVE_HQ':

                $tmp_filename = 'google_drive_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Google Drive';
                $tmp_title_text = 'Link to Google Drive related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_GOOGLE_MAPS':

                $tmp_filename = 'google_maps';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Google Maps Anniversary';
                $tmp_title_text = 'Link to Google Maps related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_GOOGLE_MAPS_HQ':

                $tmp_filename = 'google_maps_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Google Maps Anniversary';
                $tmp_title_text = 'Link to Google Maps related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_GOOGLE_MAPS_SQUARE':

                $tmp_filename = 'google_maps_square';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Google Maps';
                $tmp_title_text = 'Link to Google Maps related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_GOOGLE_MAPS_SQUARE_HQ':

                $tmp_filename = 'google_maps_square_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Google Maps';
                $tmp_title_text = 'Link to Google Maps related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_HISTORY':

                $tmp_filename = 'history';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'History';
                $tmp_title_text = 'Link to history.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_HISTORY_HQ':

                $tmp_filename = 'history_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'History';
                $tmp_title_text = 'Link to history.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_IDEONE':

                $tmp_filename = 'ide1_icon';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'IDE ONE';
                $tmp_title_text = 'Link to IDE ONE related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_IDEONE_HQ':

                $tmp_filename = 'ide1_icon_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'IDE ONE';
                $tmp_title_text = 'Link to IDE ONE related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_INSTAGRAM':

                $tmp_filename = 'instagram';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Instagram';
                $tmp_title_text = 'Link to Instagram feed.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_INSTAGRAM_HQ':

                $tmp_filename = 'instagram_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Instagram';
                $tmp_title_text = 'Link to Instagram feed.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_INTERNET_ARCHIVE':

                $tmp_filename = 'internet_archive';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Internet Archive';
                $tmp_title_text = 'Link to Internet Archive related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_INTERNET_ARCHIVE_HQ':

                $tmp_filename = 'internet_archive_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Internet Archive';
                $tmp_title_text = 'Link to Internet Archive related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_JSON':

                $tmp_filename = 'json';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'JSON';
                $tmp_title_text = 'Link to JSON.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_JSON_HQ':

                $tmp_filename = 'json_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'JSON';
                $tmp_title_text = 'Link to JSON.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_KINK':

                $tmp_filename = 'kink';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Kink';
                $tmp_title_text = 'Link to Kink related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_KINK_HQ':

                $tmp_filename = 'kink_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Kink';
                $tmp_title_text = 'Link to Kink related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_LAST_FM':

                $tmp_filename = 'last_fm';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Last.fm';
                $tmp_title_text = 'Link to Last.fm related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_LAST_FM_HQ':

                $tmp_filename = 'last_fm_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Last.fm';
                $tmp_title_text = 'Link to Last.fm related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_LINKEDIN':

                $tmp_filename = 'linkedin';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'LinkedIn';
                $tmp_title_text = 'Link to LinkedIn profile.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_LINKEDIN_HQ':

                $tmp_filename = 'linkedin_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'LinkedIn';
                $tmp_title_text = 'Link to LinkedIn profile.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_MICROSOFT':

                $tmp_filename = 'microsoft_icon';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Microsoft';
                $tmp_title_text = 'Link to Microsoft related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_MICROSOFT_HQ':

                $tmp_filename = 'microsoft_icon_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Microsoft';
                $tmp_title_text = 'Link to Microsoft related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_MIXCLOUD':

                $tmp_filename = 'mixcloud';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Mixcloud';
                $tmp_title_text = 'Link to Mixcloud community.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_MIXCLOUD_HQ':

                $tmp_filename = 'mixcloud_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Mixcloud';
                $tmp_title_text = 'Link to Mixcloud community.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_MOZILLA_ICON':

                $tmp_filename = 'mozilla_icon';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Mozilla Developer Network';
                $tmp_title_text = 'Mozilla';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_MOZILLA_ICON_HQ':

                $tmp_filename = 'mozilla_icon_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Mozilla Developer Network';
                $tmp_title_text = 'Mozilla';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_MOZILLA_WORDMARK':

                $tmp_filename = 'mozilla_wordmark';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Mozilla Developer Network';
                $tmp_title_text = 'Mozilla';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_MOZILLA_WORDMARK_HQ':

                $tmp_filename = 'mozilla_wordmark_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Mozilla Developer Network';
                $tmp_title_text = 'Mozilla';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_PANDORA':

                $tmp_filename = 'pandora_icon';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Pandora';
                $tmp_title_text = 'Link to Pandora related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_PANDORA_HQ':

                $tmp_filename = 'pandora_icon_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Pandora';
                $tmp_title_text = 'Link to Pandora related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_PATREON':

                $tmp_filename = 'patreon';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Patreon';
                $tmp_title_text = 'Link to Patreon related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_PATREON_HQ':

                $tmp_filename = 'patreon_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Patreon';
                $tmp_title_text = 'Link to Patreon related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_PAYPAL':

                $tmp_filename = 'paypal';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Paypal';
                $tmp_title_text = 'Link to Paypal related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_PAYPAL_HQ':

                $tmp_filename = 'paypal_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Paypal';
                $tmp_title_text = 'Link to Paypal related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_PHP':

                $tmp_filename = 'php_icon';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'php v' . $this->oCRNRSTN->version_php();
                $tmp_title_text = 'Link to php related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_PHP_HQ':

                $tmp_filename = 'php_icon_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'php v' . $this->oCRNRSTN->version_php();
                $tmp_title_text = 'Link to php related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_PINTEREST':

                $tmp_filename = 'pinterest';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Pinterest';
                $tmp_title_text = 'Link to Pinterest related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_PINTEREST_HQ':

                $tmp_filename = 'pinterest_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Pinterest';
                $tmp_title_text = 'Link to Pinterest related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_PORNHUB':

                $tmp_filename = 'pornhub';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Pornhub';
                $tmp_title_text = 'Link to Pornhub related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_PORNHUB_HQ':

                $tmp_filename = 'pornhub_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Pornhub';
                $tmp_title_text = 'Link to Pornhub related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_REDDIT':

                $tmp_filename = 'reddit';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Reddit';
                $tmp_title_text = 'Link to Reddit related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_REDDIT_HQ':

                $tmp_filename = 'reddit_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Reddit';
                $tmp_title_text = 'Link to Reddit related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_ROLLDABEATS':

                $tmp_filename = 'rolldabeats';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'RollDaBeats';
                $tmp_title_text = 'Link to RollDaBeats catalog.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_ROLLDABEATS_HQ':

                $tmp_filename = 'rolldabeats_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'RollDaBeats';
                $tmp_title_text = 'Link to RollDaBeats catalog.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_SERVER_FAULT':

                $tmp_filename = 'server_fault';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Server Fault';
                $tmp_title_text = 'Link to Server Fault related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_SERVER_FAULT_HQ':

                $tmp_filename = 'server_fault_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Server Fault';
                $tmp_title_text = 'Link to Server Fault related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_SLASHDOT_ICON':

                $tmp_filename = 'slashdot_icon';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Slashdot';
                $tmp_title_text = 'Link to Slashdot related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_SLASHDOT_ICON_HQ':

                $tmp_filename = 'slashdot_icon_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Slashdot';
                $tmp_title_text = 'Link to Slashdot related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_SLASHDOT_WORDMARK':

                $tmp_filename = 'slashdot_wordmark';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Slashdot';
                $tmp_title_text = 'Link to Slashdot related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_SLASHDOT_WORDMARK_HQ':

                $tmp_filename = 'slashdot_wordmark_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Slashdot';
                $tmp_title_text = 'Link to Slashdot related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_SOUNDCLOUD':

                $tmp_filename = 'soundcloud';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'SoundCloud';
                $tmp_title_text = 'Link to SoundCloud tracks.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_SOUNDCLOUD_HQ':

                $tmp_filename = 'soundcloud_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'SoundCloud';
                $tmp_title_text = 'Link to SoundCloud tracks.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_SPOTIFY':

                $tmp_filename = 'spotify';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Spotify';
                $tmp_title_text = 'Link to Spotify related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_SPOTIFY_HQ':

                $tmp_filename = 'spotify_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Spotify';
                $tmp_title_text = 'Link to Spotify related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_SPRITE':

                $tmp_filename = 'sprite';
                $tmp_width = 324;
                $tmp_height = 421;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_SPRITE_HQ':

                $tmp_filename = 'sprite_hq';
                $tmp_width = 969;
                $tmp_height = 1292;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_STACKOVERFLOW':

                $tmp_filename = 'stackoverflow';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Stackoverflow';
                $tmp_title_text = 'Link to Stackoverflow related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_STACKOVERFLOW_HQ':

                $tmp_filename = 'stackoverflow_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Stackoverflow';
                $tmp_title_text = 'Link to Stackoverflow related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_TWITCH':

                $tmp_filename = 'twitch';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Twitch';
                $tmp_title_text = 'Link to Twitch related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_TWITCH_HQ':

                $tmp_filename = 'twitch_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Twitch';
                $tmp_title_text = 'Link to Twitch related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_TWITTER':

                $tmp_filename = 'twitter';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Twitter';
                $tmp_title_text = 'Link to Twitter feed.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_TWITTER_HQ':

                $tmp_filename = 'twitter_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Twitter';
                $tmp_title_text = 'Link to Twitter feed.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_VIMEO_BLUE_ICON':

                $tmp_filename = 'vimeo_blue_icon';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Vimeo';
                $tmp_title_text = 'Link to Vimeo related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_VIMEO_BLUE_ICON_HQ':

                $tmp_filename = 'vimeo_blue_icon_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Vimeo';
                $tmp_title_text = 'Link to Vimeo related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_VIMEO_BLUE_WORDMARK':

                $tmp_filename = 'vimeo_blue_wordmark';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Vimeo';
                $tmp_title_text = 'Link to Vimeo related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_VIMEO_BLUE_WORDMARK_HQ':

                $tmp_filename = 'vimeo_blue_wordmark_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Vimeo';
                $tmp_title_text = 'Link to Vimeo related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_VIMEO_DARKFOREST_WORDMARK':

                $tmp_filename = 'vimeo_darkforest_wordmark';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Vimeo';
                $tmp_title_text = 'Link to Vimeo related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_VIMEO_DARKFOREST_WORDMARK_HQ':

                $tmp_filename = 'vimeo_darkforest_wordmark_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Vimeo';
                $tmp_title_text = 'Link to Vimeo related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_W3C':

                $tmp_filename = 'w3c';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'W3C';
                $tmp_title_text = 'Link to W3C related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_W3C_HQ':

                $tmp_filename = 'w3c_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'W3C';
                $tmp_title_text = 'Link to W3C related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_WIKIPEDIA':

                $tmp_filename = 'wikipedia';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Wikipedia';
                $tmp_title_text = 'Link to Wikipedia related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_WIKIPEDIA_HQ':

                $tmp_filename = 'wikipedia_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Wikipedia';
                $tmp_title_text = 'Link to Wikipedia related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_WWW':

                $tmp_filename = 'www';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'Website link.';
                $tmp_title_text = 'Link to website.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_WWW_HQ':

                $tmp_filename = 'www_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'Website link.';
                $tmp_title_text = 'Link to website.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_XHAMSTER_ICON':

                $tmp_filename = 'xhamster_icon';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'XHAMSTER';
                $tmp_title_text = 'Link to XHAMSTER related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_XHAMSTER_ICON_HQ':

                $tmp_filename = 'xhamster_icon_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'XHAMSTER';
                $tmp_title_text = 'Link to XHAMSTER related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_XHAMSTER_WORDMARK':

                $tmp_filename = 'xhamster_wordmark';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'XHAMSTER';
                $tmp_title_text = 'Link to XHAMSTER related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_XHAMSTER_WORDMARK_HQ':

                $tmp_filename = 'xhamster_wordmark_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'XHAMSTER';
                $tmp_title_text = 'Link to XHAMSTER related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_XNXX':

                $tmp_filename = 'xnxx';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'XNXX.COM';
                $tmp_title_text = 'Link to XNXX.COM related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_XNXX_HQ':

                $tmp_filename = 'xnxx_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'XNXX.COM';
                $tmp_title_text = 'Link to XNXX.COM related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_XVIDEOS':

                $tmp_filename = 'xvideos';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'XVIDEOS';
                $tmp_title_text = 'Link to XVIDEOS related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_XVIDEOS_HQ':

                $tmp_filename = 'xvideos_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'XVIDEOS';
                $tmp_title_text = 'Link to XVIDEOS related resource.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_YOUTUBE':

                $tmp_filename = 'youtube';
                $tmp_width = '';
                $tmp_height = 25;
                $tmp_alt_text = 'YouTube';
                $tmp_title_text = 'Link to YouTube channel.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SOCIAL_YOUTUBE_HQ':

                $tmp_filename = 'youtube_hq';
                $tmp_width = '';
                $tmp_height = 75;
                $tmp_alt_text = 'YouTube';
                $tmp_title_text = 'Link to YouTube channel.';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'social';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'TRANSPARENT_1X1':

                $tmp_filename = 'x';
                $tmp_width = 1;
                $tmp_height = 1;
                $tmp_alt_text = 'x';
                $tmp_title_text = 'x';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'PRIMARY_NAV_BLUE00_CLOSE_X':

                $tmp_filename = 'primary_nav_seriesblue00_120x120_close_x';
                $tmp_width = 40;
                $tmp_height = 40;
                $tmp_alt_text = 'Close';
                $tmp_title_text = 'Navigation to Close';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'PRIMARY_NAV_BLUE00_CLOSE_X_CLICK':

                $tmp_filename = 'primary_nav_seriesblue00_120x120_close_x_click';
                $tmp_width = 40;
                $tmp_height = 40;
                $tmp_alt_text = 'Close';
                $tmp_title_text = 'Navigation to Close';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'PRIMARY_NAV_BLUE00_CLOSE_X_HOVER':

                $tmp_filename = 'primary_nav_seriesblue00_120x120_close_x_hvr';
                $tmp_width = 40;
                $tmp_height = 40;
                $tmp_alt_text = 'Close';
                $tmp_title_text = 'Navigation to Close';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'PRIMARY_NAV_BLUE00_CLOSE_X_INACTIVE':

                $tmp_filename = 'primary_nav_seriesblue00_120x120_close_x_inactive';
                $tmp_width = 40;
                $tmp_height = 40;
                $tmp_alt_text = 'Close';
                $tmp_title_text = 'Navigation to Close';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND':

                $tmp_filename = 'primary_nav_seriesblue00_120x120_fs_expand';
                $tmp_width = 40;
                $tmp_height = 40;
                $tmp_alt_text = 'Full Screen';
                $tmp_title_text = 'Navigation to Full Screen';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_CLICK':

                $tmp_filename = 'primary_nav_seriesblue00_120x120_fs_expand_click';
                $tmp_width = 40;
                $tmp_height = 40;
                $tmp_alt_text = 'Full Screen';
                $tmp_title_text = 'Navigation to Full Screen';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_HOVER':

                $tmp_filename = 'primary_nav_seriesblue00_120x120_fs_expand_hvr';
                $tmp_width = 40;
                $tmp_height = 40;
                $tmp_alt_text = 'Full Screen';
                $tmp_title_text = 'Navigation to Full Screen';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_INACTIVE':

                $tmp_filename = 'primary_nav_seriesblue00_120x120_fs_expand_inactive';
                $tmp_width = 40;
                $tmp_height = 40;
                $tmp_alt_text = 'Full Screen';
                $tmp_title_text = 'Navigation to Full Screen';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'PRIMARY_NAV_BLUE00_MENU':

                $tmp_filename = 'primary_nav_seriesblue00_120x120_menu';
                $tmp_width = 40;
                $tmp_height = 40;
                $tmp_alt_text = 'Menu';
                $tmp_title_text = 'Navigate to Menu';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'PRIMARY_NAV_BLUE00_MENU_CLICK':

                $tmp_filename = 'primary_nav_seriesblue00_120x120_menu_click';
                $tmp_width = 40;
                $tmp_height = 40;
                $tmp_alt_text = 'Menu';
                $tmp_title_text = 'Navigate to Menu';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'PRIMARY_NAV_BLUE00_MENU_HOVER':

                $tmp_filename = 'primary_nav_seriesblue00_120x120_menu_hvr';
                $tmp_width = 40;
                $tmp_height = 40;
                $tmp_alt_text = 'Menu';
                $tmp_title_text = 'Navigate to Menu';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'PRIMARY_NAV_BLUE00_MENU_INACTIVE':

                $tmp_filename = 'primary_nav_seriesblue00_120x120_menu_inactive';
                $tmp_width = 40;
                $tmp_height = 40;
                $tmp_alt_text = 'Menu';
                $tmp_title_text = 'Navigate to Menu';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'PRIMARY_NAV_BLUE00_MINIMIZE':

                $tmp_filename = 'primary_nav_seriesblue00_120x120_minimize';
                $tmp_width = 40;
                $tmp_height = 40;
                $tmp_alt_text = 'Minimize';
                $tmp_title_text = 'Navigate to Minimize';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'PRIMARY_NAV_BLUE00_MINIMIZE_CLICK':

                $tmp_filename = 'primary_nav_seriesblue00_120x120_minimize_click';
                $tmp_width = 40;
                $tmp_height = 40;
                $tmp_alt_text = 'Minimize';
                $tmp_title_text = 'Navigate to Minimize';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'PRIMARY_NAV_BLUE00_MINIMIZE_HOVER':

                $tmp_filename = 'primary_nav_seriesblue00_120x120_minimize_hvr';
                $tmp_width = 40;
                $tmp_height = 40;
                $tmp_alt_text = 'Minimize';
                $tmp_title_text = 'Navigate to Minimize';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'PRIMARY_NAV_BLUE00_MINIMIZE_INACTIVE':

                $tmp_filename = 'primary_nav_seriesblue00_120x120_minimize_inactive';
                $tmp_width = 40;
                $tmp_height = 40;
                $tmp_alt_text = 'Minimize';
                $tmp_title_text = 'Navigate to Minimize';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'PRIMARY_NAV_BLUE00_MINIMIZE_FIVEDEV':

                $tmp_filename = 'primary_nav_seriesblue00_120x120_minimize_fivedev';
                $tmp_width = 40;
                $tmp_height = 40;
                $tmp_alt_text = '5';
                $tmp_title_text = 'eVifweb development';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'PRIMARY_NAV_BLUE00_MINIMIZE_FIVEDEV_SMALL':

                $tmp_filename = 'primary_nav_seriesblue00_120x120_minimize_fivedev_sm';
                $tmp_width = 40;
                $tmp_height = 40;
                $tmp_alt_text = '5';
                $tmp_title_text = 'eVifweb development';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'MESSAGE_CONVERSATION_BUBBLE_MICRO_THUMB_BLUE00':

                $tmp_filename = 'crnrstn_message_bubbles_seriesblue00';
                $tmp_width = 63;
                $tmp_height = 39;
                $tmp_alt_text = 'CRNRSTN ::';
                $tmp_title_text = 'CRNRSTN ::';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'MESSAGE_CONVERSATION_BUBBLE':

                $tmp_filename = 'crnrstn_messenger_message_bubbles';
                $tmp_width = 172;
                $tmp_height = 106;
                $tmp_alt_text = 'CRNRSTN ::';
                $tmp_title_text = 'CRNRSTN ::';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'FIVE':

                $tmp_filename = '5';
                $tmp_width = 18;
                $tmp_height = 18;
                $tmp_alt_text = '5';
                $tmp_title_text = '5';
                $tmp_link = 'http://jony5.com/projects/crnrstn/philosophy/';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SUCCESS_CHECK':

                $tmp_filename = 'success_chk';
                $tmp_width = 19;
                $tmp_height = 19;
                $tmp_alt_text = 'success';
                $tmp_title_text = 'success';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'ERR_X':

                $tmp_filename = 'err_x';
                $tmp_width = 19;
                $tmp_height = 19;
                $tmp_alt_text = 'X';
                $tmp_title_text = 'error';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CRNRSTN_LOGO':

                $tmp_filename = 'crnrstn_logo_lg';
                $tmp_width = '';
                $tmp_height = 98;
                $tmp_alt_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CRNRSTN_R':
            case 'CRNRSTN_R_LG':

                $tmp_filename = 'crnrstn_R_lg';
                $tmp_width = 50;
                $tmp_height = 69;
                $tmp_alt_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CRNRSTN_R_MD':

                $tmp_filename = 'crnrstn_R_md';
                $tmp_width = 26;
                $tmp_height = 35;
                $tmp_alt_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'CRNRSTN_R_SM':

                $tmp_filename = 'crnrstn_R_sm';
                $tmp_width = 12;
                $tmp_height = 16;
                $tmp_alt_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'R_PLUS_WALL':

                $tmp_filename = 'crnrstn_R_md_plus_wall';
                $tmp_width = 66;
                $tmp_height = 35;
                $tmp_alt_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'BG_ELEMENT_RESPONSE_CODE':

                $tmp_filename = 'elem_shadow_btm';
                $tmp_width = 1;
                $tmp_height = 5;
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'PHP_ELLIPSE':

                $tmp_filename = 'php_logo';
                $tmp_width = 65;
                $tmp_height = 35;
                $tmp_alt_text = 'php v' . $this->oCRNRSTN->version_php();
                $tmp_title_text = 'php v' . $this->oCRNRSTN->version_php() . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = 'https://www.php.net/';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'POWER_BY_PHP':

                $tmp_filename = 'powered_by_php';
                $tmp_width = '';
                $tmp_height = 35;
                $tmp_alt_text = 'Powered by php v' . $this->oCRNRSTN->version_php();
                $tmp_title_text = 'Powered by php v' . $this->oCRNRSTN->version_php() . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = 'https://www.php.net/';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'ZEND_LOGO':

                $tmp_filename = 'zend_logo';
                $tmp_width = 73;
                $tmp_height = 39;
                $tmp_alt_text = 'ZEND';
                $tmp_title_text = 'ZEND' . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = 'https://www.zend.com/';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'ZEND_FRAMEWORK':

                $tmp_filename = 'zend_framework';
                $tmp_width = 212;
                $tmp_height = 40;
                $tmp_alt_text = 'ZEND FRAMEWORK';
                $tmp_title_text = 'ZEND FRAMEWORK' . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = 'https://www.zend.com/';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'ZEND_FRAMEWORK_3':

                $tmp_filename = 'zend_framework_3';
                $tmp_width = 224;
                $tmp_height = 38;
                $tmp_alt_text = 'ZEND FRAMEWORK 3';
                $tmp_title_text = 'ZEND FRAMEWORK 3' . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = 'https://www.zend.com/';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'LINUX_PENGUIN_LRG':

                $tmp_filename = 'linux_penguin_lg';
                $tmp_width = 30;
                $tmp_height = 35;
                $tmp_alt_text = 'Linux :: Tux the Penguin';
                $tmp_title_text = 'Linux' . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = 'https://www.linux.com/';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'LINUX_PENGUIN_MED':

                $tmp_filename = 'linux_penguin_md';
                $tmp_width = '';
                $tmp_height = 100;
                $tmp_alt_text = 'Linux :: Tux the Penguin';
                $tmp_title_text = 'Linux' . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = 'https://www.linux.com/';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'LINUX_PENGUIN_SMALL':

                $tmp_filename = 'linux_penguin_sm';
                $tmp_width = 30;
                $tmp_height = 35;
                $tmp_alt_text = 'Linux :: Tux the Penguin';
                $tmp_title_text = 'Linux' . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = 'https://www.linux.com/';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'MYSQL_DOLPHIN':

                $tmp_filename = 'mysql_logo';
                $tmp_width = 66;
                $tmp_height = 34;

                if(strlen($this->oCRNRSTN->version_mysqli()) > 0){

                    $tmp_alt_text = 'MySQLi v' . $this->oCRNRSTN->version_mysqli();
                    $tmp_title_text = 'MySQLi v' . $this->oCRNRSTN->version_mysqli() . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();

                }else{

                    $tmp_alt_text = 'MySQLi';
                    $tmp_title_text = 'MySQLi' . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();

                }

                $tmp_link = 'https://www.mysql.com/';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'REDHAT_HAT_LOGO':

                $tmp_filename = 'redhat_hat_logo';
                $tmp_width = 57;
                $tmp_height = 42;
                $tmp_alt_text = 'Red Hat';
                $tmp_title_text = 'Red Hat' . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = 'https://www.redhat.com/';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'REDHAT_LOGO':

                $tmp_filename = 'redhat_logo';
                $tmp_width = 130;
                $tmp_height = 42;
                $tmp_alt_text = 'Red Hat';
                $tmp_title_text = 'Red Hat' . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = 'https://www.redhat.com/';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'APACHE_FEATHER':

                $tmp_filename = 'apache_feather_logo';
                $tmp_width = 131;
                $tmp_height = 40;

                if(strlen($this->oCRNRSTN->version_apache()) > 0){

                    $tmp_alt_text = 'Powered by Apache v' . $this->oCRNRSTN->version_apache();
                    $tmp_title_text = 'Powered by Apache v' . $this->oCRNRSTN->version_apache() . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();

                }else{

                    $tmp_alt_text = 'Powered by Apache';
                    $tmp_title_text = 'Powered by Apache v' . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();

                }

                $tmp_link = 'http://apache.org/';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'APACHE_POWER_VERSION':

                $version = $this->oCRNRSTN->version_apache_sysimg();

                switch($version){
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

                    $tmp_alt_text = 'Powered by Apache v' . $this->oCRNRSTN->version_apache();
                    $tmp_title_text = 'Powered by Apache v' . $this->oCRNRSTN->version_apache() . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();

                }else{

                    $tmp_alt_text = 'Powered by Apache';
                    $tmp_title_text = 'Powered by Apache v' . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();

                }

                $tmp_link = 'http://apache.org/';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'APACHE_POWER_2_2':

                $tmp_filename = 'powered_by_apache_2_2';
                $tmp_width = 259;
                $tmp_height = 32;

                if(strlen($this->oCRNRSTN->version_apache()) > 0){

                    $tmp_alt_text = 'Powered by Apache v' . $this->oCRNRSTN->version_apache();
                    $tmp_title_text = 'Powered by Apache v' . $this->oCRNRSTN->version_apache() . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();

                }else{

                    $tmp_alt_text = 'Powered by Apache';
                    $tmp_title_text = 'Powered by Apache v' . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();

                }

                $tmp_link = 'http://apache.org/';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'APACHE_POWER_2_0':

                $tmp_filename = 'powered_by_apache_2';
                $tmp_width = 259;
                $tmp_height = 32;

                if(strlen($this->oCRNRSTN->version_apache()) > 0){

                    $tmp_alt_text = 'Powered by Apache v' . $this->oCRNRSTN->version_apache();
                    $tmp_title_text = 'Powered by Apache v' . $this->oCRNRSTN->version_apache() . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();

                }else{

                    $tmp_alt_text = 'Powered by Apache';
                    $tmp_title_text = 'Powered by Apache v' . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();

                }

                $tmp_link = 'http://apache.org/';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'APACHE_POWER_1_3':

                $tmp_filename = 'powered_by_apache_1_3';
                $tmp_width = 259;
                $tmp_height = 32;

                if(strlen($this->oCRNRSTN->version_apache()) > 0){

                    $tmp_alt_text = 'Powered by Apache v' . $this->oCRNRSTN->version_apache();
                    $tmp_title_text = 'Powered by Apache v' . $this->oCRNRSTN->version_apache() . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();

                }else{

                    $tmp_alt_text = 'Powered by Apache';
                    $tmp_title_text = 'Powered by Apache v' . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();

                }

                $tmp_link = 'http://apache.org/';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'APACHE_POWER':

                $tmp_filename = 'powered_by_apache';
                $tmp_width = 259;
                $tmp_height = 32;

                $tmp_alt_text = 'Powered by Apache';
                $tmp_title_text = 'Powered by Apache' . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();

                $tmp_link = 'http://apache.org/';
                $tmp_target = '_blank';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'BG_ELEMENT_REFLECTION_SIGNIN':

                $tmp_filename = 'signin_frm_reflection';
                $tmp_width = 722;
                $tmp_height = 55;
                $tmp_alt_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'DOT_GREEN':

                $tmp_filename = 'dot_grn';
                $tmp_width = 20;
                $tmp_height = 20;
                $tmp_alt_text = 'O';
                $tmp_title_text = 'O';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'DOT_RED':

                $tmp_filename = 'dot_red';
                $tmp_width = 20;
                $tmp_height = 20;
                $tmp_alt_text = 'O';
                $tmp_title_text = 'O';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'DOT_GREY':

                $tmp_filename = 'dot_grey';
                $tmp_width = 20;
                $tmp_height = 20;
                $tmp_alt_text = 'O';
                $tmp_title_text = 'O';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'NOTICE_TRI_ALERT':

                $tmp_filename = 'triangle_alert';
                $tmp_width = 19;
                $tmp_height = 19;
                $tmp_alt_text = '!';
                $tmp_title_text = 'alert';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'NOTICE_TRI_ALERT_HQ':

                $tmp_filename = 'triangle_alert_hq';
                $tmp_width = 120;
                $tmp_height = 120;
                $tmp_alt_text = 'alert!';
                $tmp_title_text = 'alert';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'SEARCH_MAGNIFY_GLASS':

                $tmp_filename = 'mag_glass_search';
                $tmp_width = '';
                $tmp_height = 14;
                $tmp_alt_text = 'Search';
                $tmp_title_text = 'Search';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'ICON_EMAIL_INBOX_REFLECTED':

                $tmp_filename = 'email_inbox_icon';
                $tmp_width = 201;
                $tmp_height = 185;
                $tmp_alt_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

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
                $tmp_int = rand(0, $tmp_cnt-1);

                return $this->asset_data($tmp_array[$tmp_int], $width_override, $height_override, $link_override, $alt_override, $title_override, $target_override, $output_mode);

            break;
            case 'J5_WOLF_PUP':

                $tmp_filename = 'j5_wolf_pup';
                $tmp_width = 525;
                $tmp_height = 351;
                $tmp_alt_text = 'J5 Wolf Pup';
                $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'J5_WOLF_PUP_LAY_00':

                $tmp_filename = 'j5_wolf_pup_lay_00';
                $tmp_width = '';
                $tmp_height = 345;
                $tmp_alt_text = 'J5 Wolf Pup';
                $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'J5_WOLF_PUP_LAY_01':

                $tmp_filename = 'j5_wolf_pup_lay_01';
                $tmp_width = '';
                $tmp_height = 400;
                $tmp_alt_text = 'J5 Wolf Pup';
                $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'J5_WOLF_PUP_LAY_02':

                $tmp_filename = 'j5_wolf_pup_lay_02';
                $tmp_width = '';
                $tmp_height = 348;
                $tmp_alt_text = 'J5 Wolf Pup';
                $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'J5_WOLF_PUP_LAY_LOOK_AWAY':

                $tmp_filename = 'j5_wolf_pup_lay_look_away';
                $tmp_width = '';
                $tmp_height = 400;
                $tmp_alt_text = 'J5 Wolf Pup';
                $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'J5_WOLF_PUP_LAY_LOOK_FORWARD':

                $tmp_filename = 'j5_wolf_pup_lay_look_forward';
                $tmp_width = '';
                $tmp_height = 450;
                $tmp_alt_text = 'J5 Wolf Pup';
                $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'J5_WOLF_PUP_LAY_LOOK_FORWARD_LEASH':

                $tmp_filename = 'j5_wolf_pup_lay_look_forward_leash';
                $tmp_width = '';
                $tmp_height = 365;
                $tmp_alt_text = 'J5 Wolf Pup';
                $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'J5_WOLF_PUP_LEASH_EYES_CLOSED':

                $tmp_filename = 'j5_wolf_pup_leash_eyes_closed';
                $tmp_width = '';
                $tmp_height = 370;
                $tmp_alt_text = 'J5 Wolf Pup';
                $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'J5_WOLF_PUP_LIL_5_PTS':

                $tmp_filename = 'j5_wolf_pup_lil_5_pts';
                $tmp_width = '';
                $tmp_height = 340;
                $tmp_alt_text = 'J5 Wolf Pup';
                $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'J5_WOLF_PUP_SIT_EYES_CLOSED':

                $tmp_filename = 'j5_wolf_pup_sit_eyes_closed';
                $tmp_width = '';
                $tmp_height = 376;
                $tmp_alt_text = 'J5 Wolf Pup';
                $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_FORWARD':

                $tmp_filename = 'j5_wolf_pup_sit_look_forward';
                $tmp_width = '';
                $tmp_height = 400;
                $tmp_alt_text = 'J5 Wolf Pup';
                $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_LEFT_ISH_SHADOW':

                $tmp_filename = 'j5_wolf_pup_sit_look_left_ish_shadow';
                $tmp_width = '';
                $tmp_height = 305;
                $tmp_alt_text = 'J5 Wolf Pup';
                $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_RIGHT':

                $tmp_filename = 'j5_wolf_pup_sit_look_right';
                $tmp_width = '';
                $tmp_height = 416;
                $tmp_alt_text = 'J5 Wolf Pup';
                $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_RIGHT_LONGSHADOW':

                $tmp_filename = 'j5_wolf_pup_sit_look_right_longshadow';
                $tmp_width = '';
                $tmp_height = 346;
                $tmp_alt_text = 'J5 Wolf Pup';
                $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_RIGHT_SHADOW':

                $tmp_filename = 'j5_wolf_pup_sit_look_right_shadow';
                $tmp_width = '';
                $tmp_height = 290;
                $tmp_alt_text = 'J5 Wolf Pup';
                $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_RIGHT_SHORT_SHADOW':

                $tmp_filename = 'j5_wolf_pup_sit_look_right_shortshadow';
                $tmp_width = '';
                $tmp_height = 443;
                $tmp_alt_text = 'J5 Wolf Pup';
                $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_RIGHT_UP':

                $tmp_filename = 'j5_wolf_pup_sit_look_right_up';
                $tmp_width = '';
                $tmp_height = 413;
                $tmp_alt_text = 'J5 Wolf Pup';
                $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_is_system = true;
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_RIGHTSHARP_SHADOW':

                $tmp_filename = 'j5_wolf_pup_sit_look_rightsharp_shadow';
                $tmp_width = '';
                $tmp_height = 331;
                $tmp_alt_text = 'J5 Wolf Pup';
                $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'J5_WOLF_PUP_STAND_LOOK_RIGHT':

                $tmp_filename = 'j5_wolf_pup_stand_look_right';
                $tmp_width = '';
                $tmp_height = 390;
                $tmp_alt_text = 'J5 Wolf Pup';
                $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'J5_WOLF_PUP_STAND_LOOK_UP':

                $tmp_filename = 'j5_wolf_pup_stand_look_up';
                $tmp_width = '';
                $tmp_height = 347;
                $tmp_alt_text = 'J5 Wolf Pup';
                $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'J5_WOLF_PUP_WALK':

                $tmp_filename = 'j5_wolf_pup_walk';
                $tmp_width = '';
                $tmp_height = 430;
                $tmp_alt_text = 'J5 Wolf Pup';
                $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'J5_WOLF_PUP_TOP_RIGHT':

                $tmp_filename = 'j5_pup_top_right';
                $tmp_width = '';
                $tmp_height = 400;
                $tmp_alt_text = 'J5 Wolf Pup';
                $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'system';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            default:

                $tmp_filename = $asset_data_key;
                $tmp_width = '';
                $tmp_height = '';
                $tmp_alt_text = '';
                $tmp_title_text = '';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;

        }

        //
        // AUGMENT DOCUMENTATION WITH ASSET META
        if($output_mode == CRNRSTN_RESOURCE_DOCUMENTATION){

            $tmp_ARRAY = array();
            $tmp_ARRAY[$asset_data_key]['alt_text'] = $tmp_alt_text;
            $tmp_ARRAY[$asset_data_key]['title_text'] = $tmp_title_text;

            return $tmp_ARRAY;

        }

        if($output_mode == CRNRSTN_FILE_MANAGEMENT){

            if(isset($tmp_filename) && $tmp_asset_family != 'integrations'){

                $tmp_ARRAY = array();

                $tmp_ARRAY['filename'] = $tmp_filename;
                $tmp_ARRAY['width'] = $tmp_width;
                $tmp_ARRAY['height'] = $tmp_height;
                $tmp_ARRAY['alt_text'] = $tmp_alt_text;
                $tmp_ARRAY['title_text'] = $tmp_title_text;
                $tmp_ARRAY['link'] = $tmp_link;
                $tmp_ARRAY['target'] = $tmp_target;

                return $tmp_ARRAY;

            }

            return false;

        }

        if(isset($output_mode)){

            //error_log(__LINE__ . ' asset mgr serialized $output_mode.');
            self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = $output_mode;

        }

        if(($height_override !== NULL) || ($height_override === '')){

            $tmp_height = $height_override;

        }

        if(($link_override !== NULL) || ($link_override === '')){

            if(($target_override !== NULL) || ($target_override === '')){

                $tmp_target = $target_override;

            }

            $tmp_link = $link_override;

        }

        if(($alt_override !== NULL) || ($alt_override === '')){

            $tmp_alt_text = $alt_override;

        }

        if(($title_override !== NULL) || ($title_override === '')){

            $tmp_title_text = $title_override;

        }

        if(($width_override !== NULL) || ($width_override === '')){

            $tmp_width = $width_override;

        }

        //error_log(__LINE__ . ' Fire return_image_data on [' . $tmp_filename . ']. $output_mode[' . $output_mode . '].');
        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target, $tmp_asset_family, $output_mode);

    }

    private function process_for_filename($str){

        //
        // TRIM TO 100 CHARS
        return substr($this->normalizeString($str),0,100);

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
        $str = html_entity_decode( $str, ENT_QUOTES, "utf-8" );
        $str = htmlentities($str, ENT_QUOTES, "utf-8");
        $str = preg_replace("/(&)([a-z])([a-z]+;)/i", '$2', $str);
        $str = str_replace(' ', '_', $str);
        $str = rawurlencode($str);
        $str = str_replace('%', '_', $str);
        return $str;
    }

    //
    // SOURCE :: http://php.net/manual/en/function.readfile.php
    private function readfile_chunked($filename, $retbytes = true){

        $chunksize = 1*(1024*1024); // how many bytes per chunk

        $buffer = '';
        $cnt =0;

        // $handle = fopen($filename, 'rb');
        $handle = fopen($filename, 'rb');

        if($handle === false){

            return false;

        }

        while(!feof($handle)){

            $buffer = fread($handle, $chunksize);

            echo $buffer;

            if ($retbytes) {

                $cnt += strlen($buffer);

            }

        }

        $status = fclose($handle);

        if ($retbytes && $status) {

            return $cnt; // return num. bytes delivered like readfile() does.

        }

        return $status;

    }

    private function return_image_string($tmp_path, $tmp_http, $tmp_map_http, $tmp_output_mode, $asset_mapping_is_active){

//            protected $asset_request_data_key;
//            protected $asset_meta_path;
//            protected $asset_request_asset_family;
//            protected $asset_response_method_key;

        $tmp_str = '';
        $crnrstn_root_dir = $this->oCRNRSTN->crnrstn_root_directory();

        try{

            //if($tmp_output_mode == ''){
            //    error_log(__LINE__ . ' asset mgr set to CRNRSTN_ASSET_MAPPING.');
            //    $asset_mapping_is_active = true;
            //}

            //
            // CRNRSTN :: ASSET MAPPING.
            switch($this->oCRNRSTN->asset_request_asset_family){
                case 'social':

                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_SOCIAL_IMG_ASSET_MAPPING)){

                        $tmp_output_mode = CRNRSTN_ASSET_MAPPING;
                        $asset_mapping_is_active = true;

                        $cache_serial = '';
                        if(self::$image_output_mode == CRNRSTN_UI_IMG_BASE64_JPEG){

                            $tmp_file_extension = 'jpg';
                            $cache_serial = $this->oCRNRSTN->resource_filecache_version($tmp_path . '/jpg/' . $this->oCRNRSTN->asset_request_asset_family . '/' . $this->oCRNRSTN->asset_request_data_key . '.' . $tmp_file_extension);

                        }

                        if($cache_serial == ''){

                            $tmp_file_extension = 'png';
                            $cache_serial = $this->oCRNRSTN->resource_filecache_version($tmp_path . '/png/' . $this->oCRNRSTN->asset_request_asset_family . '/' . $this->oCRNRSTN->asset_request_data_key . '.' . $tmp_file_extension);

                        }

                        //
                        // ONLY MAP ROUTE IF BIT IS FLIPPED
                        //if($this->oCRNRSTN->is_bit_set(CRNRSTN_SYSTEM_IMG_ASSET_MAPPING) && $this->oCRNRSTN->asset_request_asset_family == 'system'){
                        //if($this->oCRNRSTN->asset_request_asset_family == 'system'){

                        //error_log(__LINE__ . ' asset mgr CRNRSTN_SYSTEM_IMG_ASSET_MAPPING. ' . $tmp_map_http . '&crnrstn_=420.0' . $cache_serial);
                        //$this->oCRNRSTN->reset_asset_request_meta();

                        return $tmp_map_http . '&crnrstn_=420.0' . $cache_serial;

                    }

                break;
                case 'system':

                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_SYSTEM_IMG_ASSET_MAPPING)){

                        $tmp_output_mode = CRNRSTN_ASSET_MAPPING;
                        $asset_mapping_is_active = true;

                        $cache_serial = '';
                        if(self::$image_output_mode == CRNRSTN_UI_IMG_BASE64_JPEG){

                            $tmp_file_extension = 'jpg';
                            $cache_serial = $this->oCRNRSTN->resource_filecache_version($tmp_path . '/jpg/' . $this->oCRNRSTN->asset_request_asset_family . '/' . $this->oCRNRSTN->asset_request_data_key . '.' . $tmp_file_extension);

                        }

                        if($cache_serial == ''){

                            $tmp_file_extension = 'png';
                            $cache_serial = $this->oCRNRSTN->resource_filecache_version($tmp_path . '/png/' . $this->oCRNRSTN->asset_request_asset_family . '/' . $this->oCRNRSTN->asset_request_data_key . '.' . $tmp_file_extension);

                        }

                        //
                        // ONLY MAP ROUTE IF BIT IS FLIPPED
                        //if($this->oCRNRSTN->is_bit_set(CRNRSTN_SYSTEM_IMG_ASSET_MAPPING) && $this->oCRNRSTN->asset_request_asset_family == 'system'){
                        //if($this->oCRNRSTN->asset_request_asset_family == 'system'){

                        //error_log(__LINE__ . ' asset mgr CRNRSTN_SYSTEM_IMG_ASSET_MAPPING. ' . $tmp_map_http . '&crnrstn_=420.0' . $cache_serial);
                        //$this->oCRNRSTN->reset_asset_request_meta();

                        return $tmp_map_http . '&crnrstn_=420.0' . $cache_serial;

                    }

                break;
                case 'favicon':

                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_FAVICON_ASSET_MAPPING)){

                        $tmp_output_mode = CRNRSTN_ASSET_MAPPING;
                        $asset_mapping_is_active = true;

                        $cache_serial = '';
                        if(self::$image_output_mode == CRNRSTN_UI_IMG_BASE64_JPEG){

                            $tmp_file_extension = 'jpg';
                            $cache_serial = $this->oCRNRSTN->resource_filecache_version($tmp_path . '/jpg/' . $this->oCRNRSTN->asset_request_asset_family . '/' . $this->oCRNRSTN->asset_request_data_key . '.' . $tmp_file_extension);

                        }

                        if($cache_serial == ''){

                            $tmp_file_extension = 'png';
                            $cache_serial = $this->oCRNRSTN->resource_filecache_version($tmp_path . '/png/' . $this->oCRNRSTN->asset_request_asset_family . '/' . $this->oCRNRSTN->asset_request_data_key . '.' . $tmp_file_extension);

                        }

                        //
                        // ONLY MAP ROUTE IF BIT IS FLIPPED
                        //if($this->oCRNRSTN->is_bit_set(CRNRSTN_SYSTEM_IMG_ASSET_MAPPING) && $this->oCRNRSTN->asset_request_asset_family == 'system'){
                        //if($this->oCRNRSTN->asset_request_asset_family == 'system'){

                        error_log(__LINE__ . ' asset mgr CRNRSTN_SYSTEM_IMG_ASSET_MAPPING. ' . $tmp_map_http . '&crnrstn_=420.0' . $cache_serial);

                        //$this->oCRNRSTN->reset_asset_request_meta();

                        return $tmp_map_http . '&crnrstn_=420.0' . $cache_serial;

                    }

                break;
                case 'integrations':

                    $tmp_output_mode = CRNRSTN_ASSET_MAPPING;
                    $asset_mapping_is_active = true;

                    $cache_serial = '';
                    if(self::$image_output_mode == CRNRSTN_UI_IMG_BASE64_JPEG){

                        $tmp_file_extension = 'jpg';
                        $cache_serial = $this->oCRNRSTN->resource_filecache_version($tmp_path . '/jpg/' . $this->oCRNRSTN->asset_request_asset_family . '/' . $this->oCRNRSTN->asset_request_data_key . '.' . $tmp_file_extension);

                    }

                    if($cache_serial == ''){

                        $tmp_file_extension = 'png';
                        $cache_serial = $this->oCRNRSTN->resource_filecache_version($tmp_path . '/png/' . $this->oCRNRSTN->asset_request_asset_family . '/' . $this->oCRNRSTN->asset_request_data_key . '.' . $tmp_file_extension);

                    }

                    //
                    // ONLY MAP ROUTE IF BIT IS FLIPPED
                    //if($this->oCRNRSTN->is_bit_set(CRNRSTN_SYSTEM_IMG_ASSET_MAPPING) && $this->oCRNRSTN->asset_request_asset_family == 'system'){
                    //if($this->oCRNRSTN->asset_request_asset_family == 'system'){

                    error_log(__LINE__ . ' asset mgr CRNRSTN_SYSTEM_IMG_ASSET_MAPPING. ' . $tmp_map_http . '&crnrstn_=420.0' . $cache_serial);

                    //$this->oCRNRSTN->reset_asset_request_meta();

                    return $tmp_map_http . '&crnrstn_=420.0' . $cache_serial;

                break;

            }

            switch($tmp_output_mode){
                case CRNRSTN_ASSET_MAPPING:
                case CRNRSTN_ASSET_MAPPING_PROXY:
                case CRNRSTN_UI_IMG:

                    error_log(__LINE__ . ' asset mgr CRNRSTN_UI_IMG gets here.');

                case CRNRSTN_UI_IMG_STR:

                    error_log(__LINE__ . ' asset mgr $tmp_output_mode[' . $tmp_output_mode . ']. $this->oCRNRSTN->asset_request_asset_family[' . $this->oCRNRSTN->asset_request_asset_family . '].');

                    $tmp_path_directory = $this->oCRNRSTN->get_resource('crnrstn_path_directory', 0, 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES');
                    $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES');

                    switch($this->oCRNRSTN->asset_request_asset_family){
                        case 'favicon':

                            error_log(__LINE__ . ' asset mgr FAVICON $this->oCRNRSTN->asset_request_asset_family[' . $this->oCRNRSTN->asset_request_asset_family . ']. [' . $tmp_output_mode . ']. die();');
                            die();

                        break;
                        case 'system':

                            $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_system_asset_tunnel_route_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
                            if(strlen($tmp_path) < 1){

                                $tmp_path = $tmp_path_directory . DIRECTORY_SEPARATOR . $tmp_system_directory;

                            }

                        break;
                        case 'social':

                            $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_social_asset_tunnel_route_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
                            if(strlen($tmp_path) < 1){

                                $tmp_path = $tmp_path_directory . DIRECTORY_SEPARATOR . $tmp_system_directory;

                            }

                        break;
                        case 'integrations':

                            //
                            // TODO :: SUPPORT CUSTOM ASSET INTEGRATIONS. SEE /BASE64/
                            //$tmp_http = $tmp_http_endpoint . $tmp_system_directory . DIRECTORY_SEPARATOR . 'ui' . DIRECTORY_SEPARATOR . 'imgs' . DIRECTORY_SEPARATOR;
                            error_log(__LINE__  . ' asset manager [' . $this->oCRNRSTN->asset_request_asset_family . '] IS INCOMPLETE. TODO :: SUPPORT CUSTOM ASSET INTEGRATIONS. SEE /BASE64/');

                        break;

                    }

                    self::$image_output_mode = $this->return_ui_image_file_return_type_constant($tmp_output_mode);

                    //
                    // ASSET MAPPING ASSET RETURN - IMMEDIATE.
                    // RETURN JPEG
                    if(self::$image_output_mode == CRNRSTN_UI_IMG_BASE64_JPEG){

                        $tmp_file_extension = 'jpg';
                        $tmp_filepath = $tmp_path . '/jpg/' . $this->oCRNRSTN->asset_request_asset_family . '/' . $this->oCRNRSTN->asset_request_data_key . '.' . $tmp_file_extension;

                    }

                    if(!isset($tmp_filepath)){

                        //error_log(__LINE__ . ' asset mgr $tmp_http[' . $tmp_http . ']. $this->oCRNRSTN->asset_request_asset_family[' . $this->oCRNRSTN->asset_request_asset_family . ']. $this->oCRNRSTN->asset_request_data_key[' . $this->oCRNRSTN->asset_request_data_key . ']');

                        $tmp_file_extension = 'png';
                        $tmp_filepath = $tmp_path . '/png/' . $this->oCRNRSTN->asset_request_asset_family . '/' . $this->oCRNRSTN->asset_request_data_key . '.' . $tmp_file_extension;

                    }

                    if(!strlen($tmp_filepath) < 1){

                        $tmp_file_extension = 'png';
                        $tmp_filepath = $tmp_path . '/png/' . $this->oCRNRSTN->asset_request_asset_family . '/' . $this->oCRNRSTN->asset_request_data_key . '.' . $tmp_file_extension;

                    }

                    if(isset($tmp_filepath)){

                        if(is_file($tmp_filepath)){

                            $tmp_header_options_ARRAY = array();

                            $tmp_header_options_ARRAY[] = 'Cache-Control: public, max-age=31536000';
                            $tmp_header_options_ARRAY[] = 'X-Frame-Options: SAMEORIGIN';

                            $tmp_filename_clean = $this->process_for_filename($this->oCRNRSTN->asset_request_data_key);

                            $tmp_curr_headers_ARRAY = headers_list();
                            $tmp_crnrstn_signature_headers_ARRAY = $this->oCRNRSTN->header_signature_options_return();

                            //
                            // SOURCE :: https://stackoverflow.com/questions/9728269/content-length-and-other-http-headers
                            // COMMENT :: https://stackoverflow.com/a/9728576
                            // AUTHOR :: Neysor :: https://stackoverflow.com/users/1219121/neysor
                            $tmp_filesize = filesize($tmp_filepath);
                            $tmp_header_options_ARRAY[] = 'Content-Type: ' . mime_content_type($tmp_filepath);
                            $tmp_header_options_ARRAY[] = 'Content-length: ' . $tmp_filesize;
                            $tmp_header_options_ARRAY[] = 'Content-Disposition: inline; filename="' . $tmp_filename_clean . '.' . $tmp_file_extension . '"';

                            $tmp_date_lastmod = filemtime($tmp_filepath);
                            $tmp_date_lastmod = date('D, j M Y G:i:s T', $tmp_date_lastmod);
                            $tmp_header_options_ARRAY[] = 'Last-Modified: ' . $tmp_date_lastmod;

                            // header_options_add
                            // header_options_apply
                            // header_signature_options_return
                            // ENSURE ALL SIGNATURE HEADERS ARE IN PLACE AND CONTINUE
                            $this->oCRNRSTN->header_options_add($tmp_curr_headers_ARRAY);
                            $this->oCRNRSTN->header_options_add($tmp_crnrstn_signature_headers_ARRAY);
                            $this->oCRNRSTN->header_options_add($tmp_header_options_ARRAY);

                            $this->oCRNRSTN->header_options_apply();

                            $this->readfile_chunked($tmp_filepath);

                            //ob_flush();
                            if(ob_get_level() > 0){ob_flush();}
                            flush();
                            exit();

                        }

                    }

                    //error_log(__LINE__ . '  asset mgr [404] tmp_output_mode[' . $tmp_output_mode . '].');
                    return $this->oCRNRSTN->return_server_response_code(404);

                break;
                case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_ICO:

                    $this->oCRNRSTN->error_log('Hook up [CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_ICO]. die();', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
                    die();

                break;
                case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_BASE64:
                case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_BASE64:
                case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_BASE64 & CRNRSTN_UI_IMG_JPEG:
                    $this->oCRNRSTN->error_log('Take CRNRSTN_UI_IMG_JPEG sideways and investigate [CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_BASE64 & CRNRSTN_UI_IMG_JPEG].', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_BASE64_JPEG:
                case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_BASE64 & CRNRSTN_UI_IMG_PNG:
                    $this->oCRNRSTN->error_log('Take CRNRSTN_UI_IMG_PNG sideways and investigate [CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_BASE64 & CRNRSTN_UI_IMG_PNG].', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
                case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_BASE64_PNG:

                    $tmp_path_base64 = $tmp_path . '/base64/' . $this->oCRNRSTN->asset_request_asset_family . '/' . $this->oCRNRSTN->asset_request_data_key . '.php';

                    $tmp_file_repair = false;
                    if(!is_file($tmp_path_base64)){

                        $this->oCRNRSTN->error_log('Failure opening [' . $this->oCRNRSTN->asset_request_data_key . '] for inclusion. Attempting to repair the BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                        $this->system_base64_synchronize($this->oCRNRSTN->asset_request_data_key . '.png');
                        $tmp_file_repair = true;

                    }

                    //
                    // TRY (POTENTIALLY...AFTER system_base64_synchronize())
                    if(!@include($tmp_path_base64)){

                        if($tmp_file_repair){

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('Failure opening [' . $tmp_path_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.');

                        }else{

                            $this->oCRNRSTN->error_log('Failure opening [' . $this->oCRNRSTN->asset_request_data_key . '] for inclusion. Attempting to repair the BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                            $this->system_base64_synchronize($this->oCRNRSTN->asset_request_data_key . '.png');
                            $tmp_file_repair = true;

                        }

                        if(!@include($tmp_path_base64)){

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('Failure opening [' . $tmp_path_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.');

                        }else{

                            //$this->oCRNRSTN->print_r('Repair of asset successfully completed on [' . $this->oCRNRSTN->asset_request_data_key . '] within the CRNRSTN :: BASE64 file system.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
                            $this->oCRNRSTN->error_log('Repair of asset successfully completed on [' . $this->oCRNRSTN->asset_request_data_key . '] within the CRNRSTN :: BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                        }

                    }

//                    if(isset($system_file_serial)) {
//
//                        if($this->output_mode_override == CRNRSTN_UI_IMG_BASE64_JPEG){
//
//                            $tmp_str = self::$image_filesystem_meta_ARRAY[self::$image_output_mode][self::$request_salt][$system_file_serial]['base64'];
//                            return $tmp_str;
//
//                        }
//
//                        $tmp_str = self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$system_file_serial]['base64'];
//
//                        return $tmp_str;
//
//                    }

                    if(isset($system_file_serial)) {

                        //error_log(__LINE__ . ' asset mgr self::$image_output_mode[' . self::$image_output_mode . ']. $tmp_path_base64[' . $tmp_path_base64 . '].');
                        $tmp_str = self::$image_filesystem_meta_ARRAY[self::$image_output_mode][self::$request_salt][$system_file_serial]['base64'];

                        //$this->oCRNRSTN->reset_asset_request_meta();

                        return $tmp_str;

                    }

                    //
                    // IF ERROR WITH BASE64...
                    if($asset_mapping_is_active){

                        //$this->oCRNRSTN->reset_asset_request_meta();

                        return $tmp_map_http;

                    }

                break;
                case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_JPEG:
                case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_JPEG:
                case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_PNG:
                case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_PNG:
                case CRNRSTN_UI_IMG_HTML_WRAPPED:
                default:

                    //
                    // RETURN JPEG
                    if($this->default_asset_mode == CRNRSTN_ASSET_MODE_JPEG){

                        $tmp_file_extension = 'jpg';
                        $cache_serial = $this->oCRNRSTN->resource_filecache_version($tmp_path . '/jpg/' . $this->oCRNRSTN->asset_request_asset_family . '/' . $this->oCRNRSTN->asset_request_data_key . '.' . $tmp_file_extension);
                        $tmp_str = $tmp_http . 'jpg/' . $this->oCRNRSTN->asset_request_asset_family . '/' . $this->oCRNRSTN->asset_request_data_key . '.' . $tmp_file_extension . '?crnrstn_=420.0' . $cache_serial;

                        //$this->oCRNRSTN->reset_asset_request_meta();
                        return $tmp_str;

                    }

                    //
                    // RETURN PNG HTTP IF WE GET THIS FAR
                    $tmp_file_extension = 'png';
                    $cache_serial = $this->oCRNRSTN->resource_filecache_version($tmp_path . '/png/' . $this->oCRNRSTN->asset_request_asset_family . '/' . $this->oCRNRSTN->asset_request_data_key . '.' . $tmp_file_extension);
                    $tmp_str = $tmp_http . 'png/' . $this->oCRNRSTN->asset_request_asset_family . '/' . $this->oCRNRSTN->asset_request_data_key . '.' . $tmp_file_extension . '?crnrstn_=420.0' . $cache_serial;

                    //$this->oCRNRSTN->reset_asset_request_meta();

                    return $tmp_str;

                break;

            }

            if($asset_mapping_is_active){

                $cache_serial = '';
                if(self::$image_output_mode == CRNRSTN_UI_IMG_BASE64_JPEG){

                    $tmp_file_extension = 'jpg';
                    $cache_serial = $this->oCRNRSTN->resource_filecache_version($tmp_path . '/jpg/' . $this->oCRNRSTN->asset_request_asset_family . '/' . $this->oCRNRSTN->asset_request_data_key . '.' . $tmp_file_extension);

                }

                if($cache_serial == ''){

                    $tmp_file_extension = 'png';
                    $cache_serial = $this->oCRNRSTN->resource_filecache_version($tmp_path . '/png/' . $this->oCRNRSTN->asset_request_asset_family . '/' . $this->oCRNRSTN->asset_request_data_key . '.' . $tmp_file_extension);

                }

                //
                // ONLY MAP ROUTE IF BIT IS FLIPPED
                //if($this->oCRNRSTN->is_bit_set(CRNRSTN_SYSTEM_IMG_ASSET_MAPPING) && $this->oCRNRSTN->asset_request_asset_family == 'system'){
                //if($this->oCRNRSTN->asset_request_asset_family == 'system'){

                    error_log(__LINE__ . ' asset mgr CRNRSTN_SYSTEM_IMG_ASSET_MAPPING. ' . $tmp_map_http . '&crnrstn_=420.0' . $cache_serial);

                    //$this->oCRNRSTN->reset_asset_request_meta();

                    return $tmp_map_http . '&crnrstn_=420.0' . $cache_serial;

                //}

                //
                // ONLY TUNNEL ROUTE IF BIT IS FLIPPED
//                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_SOCIAL_IMG_ASSET_MAPPING) && $this->oCRNRSTN->asset_request_asset_family == 'social'){
//
//                        return $tmp_map_http . '&crnrstn_=420.0' . $cache_serial;
//
//                    }


            }

            $this->oCRNRSTN->error_log('Repair of integer constant is recommended. [' . $tmp_output_mode . '] passed into CRNRSTN :: for [' . $this->oCRNRSTN->asset_request_data_key . '] is recommended.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

            //$this->oCRNRSTN->reset_asset_request_meta();

            return '';

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE. SOAP WILL NEED TO RETURN SOAP OBJECT.
            return false;

        }

    }

//    private function return_image(){
//
//        $tmp_asset_mapping_is_active = false;
//
//        if($this->oCRNRSTN->is_bit_set(CRNRSTN_ASSET_MAPPING)){
//
//            $tmp_asset_mapping_is_active = true;
//            $asset_mapping_mode = CRNRSTN_ASSET_MAPPING;
//
//        }
//
//        if($this->oCRNRSTN->is_bit_set(CRNRSTN_ASSET_MAPPING_PROXY)){
//
//            $tmp_asset_mapping_is_active = true;
//            $asset_mapping_mode = CRNRSTN_ASSET_MAPPING_PROXY;
//
//        }
//
//        try{
//
//            switch($this->default_asset_mode){
//                case CRNRSTN_ASSET_MODE_PNG:
//                case CRNRSTN_ASSET_MODE_JPEG:
//
//                    switch($this->oCRNRSTN->asset_request_asset_family){
//                        case 'system':
//
//                            $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_system_asset_tunnel_route_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
//                            $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_system_asset_tunnel_route_http_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH'));
//                            $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $this->oCRNRSTN->asset_request_data_key;
//
//                        break;
//                        case 'social':
//
//                            $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_social_asset_tunnel_route_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
//                            $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_social_asset_tunnel_route_http_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH'));
//                            $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $this->oCRNRSTN->asset_request_data_key;
//
//                        break;
//
//                    }
//
//                    $tmp_image_string = $this->return_image_string($tmp_path, $tmp_http, $tmp_map_http, $tmp_output_mode, $tmp_asset_mapping_is_active);
//
//                    return $tmp_image_string;
//
//                break;
//                case CRNRSTN_ASSET_MODE_BASE64:
//
//                    switch($this->oCRNRSTN->asset_request_asset_family){
//                        case 'system':
//
//                            $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_system_asset_tunnel_route_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
//                            //$tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_system_asset_tunnel_route_http_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH'));
//                            //$tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $this->oCRNRSTN->asset_request_data_key;
//
//                        break;
//                        case 'social':
//
//                            $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_social_asset_tunnel_route_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
//                            //$tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_social_asset_tunnel_route_http_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH'));
//                            //$tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $this->oCRNRSTN->asset_request_data_key;
//
//                        break;
//
//                    }
//
//                    $tmp_path_base64 = $tmp_path . '/base64/' . $this->oCRNRSTN->asset_request_asset_family . '/' . $this->oCRNRSTN->asset_request_data_key . '.php';
//
//                    $tmp_file_repair = false;
//                    if(!is_file($tmp_path_base64)){
//
//                        $this->oCRNRSTN->error_log('Failure opening [' . $this->oCRNRSTN->asset_request_data_key . '] for inclusion. Attempting to repair the BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
//
//                        $this->system_base64_synchronize($this->oCRNRSTN->asset_request_data_key . '.png');
//                        $tmp_file_repair = true;
//
//                    }
//
//                    //
//                    // TRY (POTENTIALLY...AFTER system_base64_synchronize())
//                    if(!@include($tmp_path_base64)){
//
//                        if($tmp_file_repair){
//
//                            //
//                            // HOOOSTON...VE HAF PROBLEM!
//                            throw new Exception('Failure opening [' . $tmp_path_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.');
//
//                        }else{
//
//                            $this->oCRNRSTN->error_log('Failure opening [' . $this->oCRNRSTN->asset_request_data_key . '] for inclusion. Attempting to repair the BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
//
//                            $this->system_base64_synchronize($this->oCRNRSTN->asset_request_data_key . '.png');
//                            $tmp_file_repair = true;
//
//                        }
//
//                        if(!@include($tmp_path_base64)){
//
//                            //
//                            // HOOOSTON...VE HAF PROBLEM!
//                            throw new Exception('Failure opening [' . $tmp_path_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.');
//
//                        }else{
//
//                            //$this->oCRNRSTN->print_r('Repair of asset successfully completed on [' . $this->oCRNRSTN->asset_request_data_key . '] within the CRNRSTN :: BASE64 file system.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
//                            $this->oCRNRSTN->error_log('Repair of asset successfully completed on [' . $this->oCRNRSTN->asset_request_data_key . '] within the CRNRSTN :: BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
//
//                        }
//
//                    }
//
//                    if(isset($system_file_serial)) {
//
//                        if($this->output_mode_override == CRNRSTN_UI_IMG_BASE64_JPEG){
//
//                            $tmp_str = self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_JPEG][self::$request_salt][$system_file_serial]['base64'];
//                            return $tmp_str;
//
//                        }
//
//                        $tmp_str = self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$system_file_serial]['base64'];
//
//                        return $tmp_str;
//
//                    }
//
//                break;
//
//            }
//
//            error_log(__LINE__ . ' asset mgr [' . __METHOD__ . ']. $this->default_asset_mode[' . $this->default_asset_mode . ']. die();');
//            die();
//
//        }catch(Exception $e){
//
//            //
//            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
//            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);
//
//            //
//            // RETURN FALSE. SOAP WILL NEED TO RETURN SOAP OBJECT.
//            return false;
//
//        }
//
//    }

    private function return_image_html_wrapped($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target, $tmp_asset_family, $tmp_output_mode, $asset_mapping_mode){

        //error_log(__LINE__ . '  $tmp_filename[' . $tmp_filename . ']. $tmp_output_mode[' . $tmp_output_mode . ']  [' . CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_BASE64 . ']');
        $tmp_asset_mapping_is_active = false;

        if($asset_mapping_mode == CRNRSTN_ASSET_MAPPING || $asset_mapping_mode == CRNRSTN_ASSET_MAPPING_PROXY){

            $tmp_asset_mapping_is_active = true;

        }

        if($asset_mapping_mode == -1){

            switch($this->oCRNRSTN->asset_request_asset_family){
                case 'favicon':

                    $this->oCRNRSTN->is_bit_set(CRNRSTN_FAVICON_ASSET_MAPPING);
                    $tmp_asset_mapping_is_active = true;

                break;
                case 'system':

                    $this->oCRNRSTN->is_bit_set(CRNRSTN_SYSTEM_IMG_ASSET_MAPPING);
                    $tmp_asset_mapping_is_active = true;

                break;
                case 'social':

                    $this->oCRNRSTN->is_bit_set(CRNRSTN_SOCIAL_IMG_ASSET_MAPPING);
                    $tmp_asset_mapping_is_active = true;

                break;

            }

        }

        //error_log(__LINE__  . ' asset mgr [' . $tmp_filename . '][' . $tmp_width . '][' . $tmp_height . '][' . $tmp_alt_text . '][' . $tmp_title_text . '][' . $tmp_link . '][' . $tmp_target . '][' . $tmp_asset_family . '][' . $tmp_output_mode . ']. [' . $asset_mapping_mode . ']. [' . $tmp_asset_mapping_is_active . '].');

        try{

            //error_log(__LINE__ . ' asset mgr [' . $this->default_asset_mode . ']. $this->oCRNRSTN->asset_request_asset_family[' . $this->oCRNRSTN->asset_request_asset_family . '].');
            //die();
            switch($tmp_output_mode){
                case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_ICO:

                    error_log(__LINE__ . ' asset mgr html wrap icon. die();');
                    die();

                break;
                case CRNRSTN_UI_IMG_HTML_WRAPPED:
                case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_PNG:
                case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_JPEG:
                case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_JPEG:
                case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_PNG:

                    //
                    // TODO :: PUT THIS SHIT EVERYWHERE. Friday, November 04, 2022 @ 0557 hrs.
                    $tmp_http_endpoint = $this->oCRNRSTN->get_resource('crnrstn_http_endpoint', 0, 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES');
                    $tmp_path_directory = $this->oCRNRSTN->get_resource('crnrstn_path_directory', 0, 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES');
                    $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES');

                    switch($this->oCRNRSTN->asset_request_asset_family){
                        case 'favicon':

                            error_log(__LINE__ . ' asset mgr FAVICON $this->oCRNRSTN->asset_request_asset_family[' . $this->oCRNRSTN->asset_request_asset_family . ']. [' . $tmp_filename . '][' . $tmp_width . '][' . $tmp_height . '][' . $tmp_alt_text . '][' . $tmp_title_text . '][' . $tmp_link . '][' . $tmp_target . '][' . $tmp_asset_family . '][' . $tmp_output_mode . ']');
                            die();

                        break;
                        case 'system':

                            $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_system_asset_tunnel_route_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
                            if(strlen($tmp_path) < 1){

                                $tmp_path = $tmp_path_directory . DIRECTORY_SEPARATOR . $tmp_system_directory;

                            }

                            $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_system_asset_tunnel_route_http_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH'));

                            $tmp_map_http = $tmp_http . '?' . $this->oCRNRSTN->session_salt() . '=' . $this->oCRNRSTN->asset_request_data_key;

                            $tmp_http = $tmp_http . $tmp_system_directory . DIRECTORY_SEPARATOR . 'ui' . DIRECTORY_SEPARATOR . 'imgs' . DIRECTORY_SEPARATOR;

                        break;
                        case 'social':

                            $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_social_asset_tunnel_route_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
                            if(strlen($tmp_path) < 1){

                                $tmp_path = $tmp_path_directory . DIRECTORY_SEPARATOR . $tmp_system_directory;

                            }

                            $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_social_asset_tunnel_route_http_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH'));

                            $tmp_map_http = $tmp_http . '?' . $this->oCRNRSTN->session_salt() . '=' . $this->oCRNRSTN->asset_request_data_key;

                            $tmp_http = $tmp_http . $tmp_system_directory . DIRECTORY_SEPARATOR . 'ui' . DIRECTORY_SEPARATOR . 'imgs' . DIRECTORY_SEPARATOR;

                        break;
                        case 'integrations':

                            //
                            // TODO :: SUPPORT CUSTOM ASSET INTEGRATIONS. SEE /BASE64/
                            $tmp_http = $tmp_http_endpoint . $tmp_system_directory . DIRECTORY_SEPARATOR . 'ui' . DIRECTORY_SEPARATOR . 'imgs' . DIRECTORY_SEPARATOR;

                        break;

                    }

                    /*
                    self::$oCRNRSTN_CONFIG_MGR->input_data_value($crnrstn_http_endpoint_dir, 'crnrstn_http_endpoint', 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES', 0, NULL, $env_key);
                    self::$oCRNRSTN_CONFIG_MGR->input_data_value($crnrstn_path_dir, 'crnrstn_path_directory', 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES', 0, NULL, $env_key);
                    self::$oCRNRSTN_CONFIG_MGR->input_data_value($crnrstn_root_directory, 'crnrstn_root_directory', 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES', 0, NULL, $env_key);

                    self::$oCRNRSTN_CONFIG_MGR->input_data_value($crnrstn_http_endpoint, 'crnrstn_http_endpoint', 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES', 0, NULL, $env_key);
                    self::$oCRNRSTN_CONFIG_MGR->input_data_value($crnrstn_path_dir, 'crnrstn_path_directory', 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES', 0, NULL, $env_key);
                    self::$oCRNRSTN_CONFIG_MGR->input_data_value($crnrstn_system_directory, 'crnrstn_system_directory', 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES', 0, NULL, $env_key);

                    */

                    //error_log(__LINE__ . ' asset mgr $tmp_path[' . $tmp_path . ']. $tmp_http[' . $tmp_http . ']. $tmp_map_http[' . $tmp_map_http . ']. $tmp_output_mode[' . print_r($tmp_output_mode, true) . ']. $tmp_asset_mapping_is_active[' . print_r($tmp_asset_mapping_is_active, true) . '].');
                    //error_log(__LINE__ . ' asset mgr default_asset_mode[' . $this->default_asset_mode . ']. asset_request_asset_family[' . $this->oCRNRSTN->asset_request_asset_family . '].');

                    $tmp_image_string = $this->return_image_string($tmp_path, $tmp_http, $tmp_map_http, $tmp_output_mode, $tmp_asset_mapping_is_active);
                    //error_log(__LINE__ . ' asset mgr $tmp_image_string[' . $tmp_image_string . '].');

                    if(strlen($tmp_link) > 0){

                        $tmp_image_string = $this->return_linked_ui_element($tmp_image_string, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                        //$this->oCRNRSTN->reset_asset_request_meta();

                        return $tmp_image_string;

                    }else{

                        // ' . $img_css . ' ------- style="border:0;"
                        //$img_css = $this->html_img_dom_return($meta_params_ARRAY, 'CSS');
                        //$this->oCRNRSTN->reset_asset_request_meta();

                        return '<img src="' . $tmp_image_string . '" width="' . $tmp_width . '" height="' . $tmp_height . '" alt="' . $tmp_alt_text . '" title="' . $tmp_title_text . '">';

                    }

                break;

                /*
                case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_BASE64:
                case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_BASE64 & CRNRSTN_UI_IMG_JPEG:
                case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_BASE64_JPEG:
                case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_BASE64 & CRNRSTN_UI_IMG_PNG:
                case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_BASE64_PNG:

                */
                case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_BASE64_JPEG:
                case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_BASE64 & CRNRSTN_UI_IMG_JPEG:
                case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_BASE64:
                case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_BASE64 & CRNRSTN_UI_IMG_PNG:
                case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_BASE64:
                case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_BASE64_PNG:
                case CRNRSTN_ASSET_MODE_BASE64:

                    $this->oCRNRSTN->error_log('Processing CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_BASE64.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                    if($this->oCRNRSTN->is_system_terminate_enabled()){

                        $tmp_path_directory = CRNRSTN_ROOT;
                        $tmp_system_directory = '_crnrstn';

                    }else{

                        $tmp_path_directory = $this->oCRNRSTN->get_resource('crnrstn_path_directory', 0, 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES');
                        $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES');

                    }

                    //
                    // CRNRSTN_UI_IMG_BASE64_PNG OR CRNRSTN_UI_IMG_BASE64_JPEG
                    self::$image_output_mode = $this->return_ui_image_file_return_type_constant($tmp_output_mode);

                    switch($this->oCRNRSTN->asset_request_asset_family){
                        case 'system':

                            $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_system_asset_tunnel_route_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
                            if(strlen($tmp_path) < 1){

                                $tmp_path = $tmp_path_directory . DIRECTORY_SEPARATOR . $tmp_system_directory . DIRECTORY_SEPARATOR . 'ui' . DIRECTORY_SEPARATOR . 'imgs';

                            }

                        break;
                        case 'social':

                            $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_social_asset_tunnel_route_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
                            if(strlen($tmp_path) < 1){

                                $tmp_path = $tmp_path_directory . DIRECTORY_SEPARATOR . $tmp_system_directory . DIRECTORY_SEPARATOR . 'ui' . DIRECTORY_SEPARATOR . 'imgs';

                            }

                        break;

                    }

                    /*
                    self::$oCRNRSTN_CONFIG_MGR->input_data_value($dir_path, 'crnrstn_system_asset_tunnel_route_dir_path', 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
                    self::$oCRNRSTN_CONFIG_MGR->input_data_value($http_path, 'crnrstn_system_asset_tunnel_route_http_path', 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
                    self::$oCRNRSTN_CONFIG_MGR->input_data_value($http_path, 'crnrstn_social_asset_tunnel_route_http_path', 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
                    self::$oCRNRSTN_CONFIG_MGR->input_data_value($dir_path, 'crnrstn_social_asset_tunnel_route_dir_path', 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');

                    self::$oCRNRSTN_CONFIG_MGR->input_data_value($crnrstn_http_endpoint_dir, 'crnrstn_http_endpoint', 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES', 0, NULL, $env_key);
                    self::$oCRNRSTN_CONFIG_MGR->input_data_value($crnrstn_dir_path, 'crnrstn_path_directory', 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES', 0, NULL, $env_key);

                    */

                    $tmp_path_base64 = $tmp_path . '/base64/' . $this->oCRNRSTN->asset_request_asset_family . '/' . $this->oCRNRSTN->asset_request_data_key . '.php';

                    $tmp_file_repair = false;
                    if(!is_file($tmp_path_base64)){

                        $this->oCRNRSTN->error_log('Failure opening [' . $this->oCRNRSTN->asset_request_data_key . '] for inclusion. Attempting to repair the BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                        $this->system_base64_synchronize($this->oCRNRSTN->asset_request_data_key . '.png');
                        $tmp_file_repair = true;

                    }

                    //
                    // TRY (POTENTIALLY...AFTER system_base64_synchronize())
                    if(!@include($tmp_path_base64)){

                        if($tmp_file_repair){

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('Failure opening [' . $tmp_path_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.');

                        }else{

                            $this->oCRNRSTN->error_log('Failure opening [' . $this->oCRNRSTN->asset_request_data_key . '] for inclusion. Attempting to repair the BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                            $this->system_base64_synchronize($this->oCRNRSTN->asset_request_data_key . '.png');
                            $tmp_file_repair = true;

                        }

                        if(!@include($tmp_path_base64)){

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('Failure opening [' . $tmp_path_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.');

                        }else{

                            //$this->oCRNRSTN->print_r('Repair of asset successfully completed on [' . $this->oCRNRSTN->asset_request_data_key . '] within the CRNRSTN :: BASE64 file system.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
                            $this->oCRNRSTN->error_log('Repair of asset successfully completed on [' . $this->oCRNRSTN->asset_request_data_key . '] within the CRNRSTN :: BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                        }

                    }


                    //
                    // BASE64 DATA IS NOW IN MEMORY
                    /*
                    $system_file_serial = '1011001100010101111101000100101110101111001111111111101111000001';

                    */
                    if(isset($system_file_serial)){

                        //error_log(__LINE__ . ' asset mgr system_file_serial[' . $system_file_serial . ']. $tmp_output_mode[' . $tmp_output_mode . ']. $output_mode_override[' . $this->output_mode_override . ']. $default_asset_mode[' . $this->default_asset_mode . '].');

                        /*
                        case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_PNG:
                        case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_JPEG:
                        case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_BASE64;
                        case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_ICO:
                        case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_JPEG:
                        case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_PNG:
                        case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_BASE64:
                        case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_BASE64 & CRNRSTN_UI_IMG_JPEG:
                        case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_BASE64_JPEG:
                        case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_BASE64 & CRNRSTN_UI_IMG_PNG:
                        case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_BASE64_PNG:
                        case CRNRSTN_UI_IMG_HTML_WRAPPED:

                        */

                        switch($tmp_output_mode){
                            case CRNRSTN_UI_IMG_BASE64:
                            case CRNRSTN_ASSET_MODE_BASE64:
                            case CRNRSTN_UI_IMG_BASE64_PNG:
                            case CRNRSTN_UI_IMG_BASE64_JPEG:
                            case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_BASE64:
                            case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_BASE64:
                            case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_BASE64_PNG:
                            case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_BASE64_JPEG:
                            default:

                                $tmp_str = self::$image_filesystem_meta_ARRAY[self::$image_output_mode][self::$request_salt][$system_file_serial]['base64'];

                                //error_log(__LINE__ . ' asset mgr $output_mode_override=[' . $this->output_mode_override . ']. $default_asset_mode[' . $this->default_asset_mode . '].');

                                // ' . $img_css . ' ------- style="border:0;"
                                //$img_css = $this->html_img_dom_return($meta_params_ARRAY, 'CSS');
                                $tmp_str = '<img src="' . $tmp_str . '" width="' . $tmp_width . '" height="' . $tmp_height . '" alt="' . $tmp_alt_text . '" title="' . $tmp_title_text . '">';

                                //$this->oCRNRSTN->reset_asset_request_meta();

                                return $tmp_str;

                            break;

                        }

                    }

                break;
                default:

                    error_log(__LINE__ . ' asset mgr HEY DUDE, WHY DON\'T YOU MAKE A DEFAULT FOR [' . __METHOD__ . ']? $tmp_output_mode[' . $tmp_output_mode . ']. $output_mode_override[' . $this->output_mode_override . ']. $default_asset_mode[' . $this->default_asset_mode . '].');

                break;

            }

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE. SOAP WILL NEED TO RETURN SOAP OBJECT.
            return false;

        }

    }

    private function return_ui_image_file_return_type_constant($tmp_output_mode){

        switch($this->default_asset_mode){
            case CRNRSTN_ASSET_MODE_JPEG:

                switch($tmp_output_mode){
                    case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_ICO:

                        error_log(__LINE__ . ' asset mgr $tmp_output_mode[' . $tmp_output_mode . ']. die();');
                        die();

                    break;
                    case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_PNG:
                    case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_PNG:
                    case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_BASE64_PNG:

                        //error_log(__LINE__ . ' asset mgr CRNRSTN_UI_IMG_BASE64_PNG. [' . $tmp_output_mode . '].');
                        return CRNRSTN_UI_IMG_BASE64_PNG;

                    break;
                    case CRNRSTN_UI_IMG_HTML_WRAPPED:
                    case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_JPEG:
                    case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_JPEG:
                    case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_BASE64:
                    case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_BASE64:
                    case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_BASE64_JPEG:
                    case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_BASE64 & CRNRSTN_UI_IMG_JPEG:
                    default:

                        //error_log(__LINE__ . ' asset mgr [DEFAULT] CRNRSTN_UI_IMG_BASE64_JPEG.');
                        return CRNRSTN_UI_IMG_BASE64_JPEG;

                    break;

                }

            break;
            default:

                switch($tmp_output_mode){
                    case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_ICO:

                        error_log(__LINE__ . ' asset mgr CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_ICO $tmp_output_mode[' . $tmp_output_mode . ']. die();');
                        die();

                    break;
                    case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_JPEG:
                    case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_JPEG:
                    case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_BASE64_JPEG:

                        //error_log(__LINE__ . ' asset mgr CRNRSTN_UI_IMG_BASE64_JPEG. $tmp_output_mode[' . $tmp_output_mode . '].');
                        return CRNRSTN_UI_IMG_BASE64_JPEG;

                    break;
                    case CRNRSTN_UI_IMG_HTML_WRAPPED:
                    case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_PNG:
                    case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_PNG:
                    case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_BASE64:
                    case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_BASE64:
                    case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_BASE64 & CRNRSTN_UI_IMG_PNG:
                    case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_BASE64_PNG:
                    default:

                        //error_log(__LINE__ . ' asset mgr [DEFAULT] CRNRSTN_UI_IMG_BASE64_PNG. $tmp_output_mode[' . $tmp_output_mode . '].');
                        return CRNRSTN_UI_IMG_BASE64_PNG;

                    break;

                }

            break;

        }

    }

    private function return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target, $tmp_asset_family, $tmp_output_mode){

        try{

            $asset_mapping_mode = -1;
            $asset_mapping_is_active = false;

            if($tmp_filename == 'favicon.ico' || $tmp_filename == 'favicon.ico' || $tmp_filename == 'favicon' || $tmp_filename == 'CRNRSTN_FAVICON' || $tmp_filename == 'BASSDRIVE_FAVICON' || $tmp_filename == 'JONY5_FAVICON'){

                switch($tmp_asset_family){
                    case 'bassdrive':
                    case 'jony5':
                    case 'crnrstn':
                    default:

                        //$this->oCRNRSTN->reset_asset_request_meta();
                        return '<link rel="shortcut icon" type="image/x-icon" href="' . $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_asset_family . '/' . $tmp_filename . '.ico&crnrstn_=420.00" />';

                    break;

                }

            }

            //$this->output_mode_override = $tmp_output_mode;

            if(!isset($this->oCRNRSTN->asset_response_method_key)){

                $this->oCRNRSTN->asset_response_method_key = $this->oCRNRSTN->asset_return_method_key($tmp_asset_family, $tmp_filename);
                //error_log(__LINE__ . ' asset mgr asset_response_method_key NOT set. output_mode_override[' . self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] . ']. asset_response_method_key[' . $this->oCRNRSTN->asset_response_method_key . '].');

                $this->oCRNRSTN->asset_request_asset_family = $tmp_asset_family;

            }

            if(strlen($this->oCRNRSTN->asset_response_method_key) < 1){

                $this->oCRNRSTN->asset_response_method_key = $this->oCRNRSTN->asset_return_method_key($tmp_asset_family, $tmp_filename);
                //error_log(__LINE__ . ' asset mgr asset_response_method_key length=0. output_mode_override[' . self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] . ']. asset_response_method_key[' . $this->oCRNRSTN->asset_response_method_key . '].');

                $this->oCRNRSTN->asset_request_asset_family = $tmp_asset_family;

            }

            $this->oCRNRSTN->asset_request_data_key = $tmp_filename;

            //error_log(__LINE__ . ' asset mgr $tmp_output_mode[' . self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] . ']. $tmp_asset_family[' . $this->oCRNRSTN->asset_request_asset_family . ']. $tmp_filename[' . $tmp_filename . ']. $this->oCRNRSTN->asset_response_method_key[' . $this->oCRNRSTN->asset_response_method_key . '].');

            switch($this->oCRNRSTN->asset_request_asset_family){
                case 'integrations':

                    $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_integrations_asset_mapping_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_INTEGRATIONS');

                    switch($this->oCRNRSTN->asset_request_data_key){
                        case 'framework/jquery_mobile_1_4_5/images/ajax-loader':

                            $tmp_filename = 'ajax-loader';
                            $tmp_file_extension = 'gif';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/action-black':

                            $tmp_filename = 'action-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/action-white':

                            $tmp_filename = 'action-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/alert-black':

                            $tmp_filename = 'alert-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/alert-white':

                            $tmp_filename = 'alert-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-d-black':

                            $tmp_filename = 'arrow-d-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-d-l-black':

                            $tmp_filename = 'arrow-d-l-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-d-l-white':

                            $tmp_filename = 'arrow-d-l-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-d-r-black':

                            $tmp_filename = 'arrow-d-r-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-d-r-white':

                            $tmp_filename = 'arrow-d-r-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-d-white':

                            $tmp_filename = 'arrow-d-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-l-black':

                            $tmp_filename = 'arrow-l-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-l-white':

                            $tmp_filename = 'arrow-l-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-r-black':

                            $tmp_filename = 'arrow-r-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-r-white':

                            $tmp_filename = 'arrow-r-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-u-black':

                            $tmp_filename = 'arrow-u-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-u-l-black':

                            $tmp_filename = 'arrow-u-l-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-u-l-white':

                            $tmp_filename = 'arrow-u-l-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-u-r-black':

                            $tmp_filename = 'arrow-u-r-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-u-r-white':

                            $tmp_filename = 'arrow-u-r-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-u-white':

                            $tmp_filename = 'arrow-u-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/audio-black':

                            $tmp_filename = 'audio-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/audio-white':

                            $tmp_filename = 'audio-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/back-black':

                            $tmp_filename = 'back-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/back-white':

                            $tmp_filename = 'back-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/bars-black':

                            $tmp_filename = 'bars-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/bars-white':

                            $tmp_filename = 'bars-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/bullets-black':

                            $tmp_filename = 'bullets-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/bullets-white':

                            $tmp_filename = 'bullets-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/calendar-black':

                            $tmp_filename = 'calendar-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/calendar-white':

                            $tmp_filename = 'calendar-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/camera-black':

                            $tmp_filename = 'camera-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/camera-white':

                            $tmp_filename = 'camera-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/carat-d-black':

                            $tmp_filename = 'carat-d-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/carat-d-white':

                            $tmp_filename = 'carat-d-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/carat-l-black':

                            $tmp_filename = 'carat-l-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/carat-l-white':

                            $tmp_filename = 'carat-l-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/carat-r-black':

                            $tmp_filename = 'carat-r-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/carat-r-white':

                            $tmp_filename = 'carat-r-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/carat-u-black':

                            $tmp_filename = 'carat-u-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/carat-u-white':

                            $tmp_filename = 'carat-u-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/check-black':

                            $tmp_filename = 'check-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/check-white':

                            $tmp_filename = 'check-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/clock-black':

                            $tmp_filename = 'clock-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/clock-white':

                            $tmp_filename = 'clock-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/cloud-black':

                            $tmp_filename = 'cloud-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/cloud-white':

                            $tmp_filename = 'cloud-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/comment-black':

                            $tmp_filename = 'comment-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/comment-white':

                            $tmp_filename = 'comment-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/delete-black':

                            $tmp_filename = 'delete-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/delete-white':

                            $tmp_filename = 'delete-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/edit-black':

                            $tmp_filename = 'edit-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/edit-white':

                            $tmp_filename = 'edit-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/eye-black':

                            $tmp_filename = 'eye-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/eye-white':

                            $tmp_filename = 'eye-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/forbidden-black':

                            $tmp_filename = 'forbidden-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/forbidden-white':

                            $tmp_filename = 'forbidden-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/forward-black':

                            $tmp_filename = 'forward-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/forward-white':

                            $tmp_filename = 'forward-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/gear-black':

                            $tmp_filename = 'gear-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/gear-white':

                            $tmp_filename = 'gear-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/grid-black':

                            $tmp_filename = 'grid-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/grid-white':

                            $tmp_filename = 'grid-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/heart-black':

                            $tmp_filename = 'heart-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/heart-white':

                            $tmp_filename = 'heart-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/home-black':

                            $tmp_filename = 'home-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/home-white':

                            $tmp_filename = 'home-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/info-black':

                            $tmp_filename = 'info-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/info-white':

                            $tmp_filename = 'info-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/location-black':

                            $tmp_filename = 'location-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/location-white':

                            $tmp_filename = 'location-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/lock-black':

                            $tmp_filename = 'lock-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/lock-white':

                            $tmp_filename = 'lock-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/mail-black':

                            $tmp_filename = 'mail-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/mail-white':

                            $tmp_filename = 'mail-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/minus-black':

                            $tmp_filename = 'minus-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/minus-white':

                            $tmp_filename = 'minus-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/navigation-black':

                            $tmp_filename = 'navigation-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/navigation-white':

                            $tmp_filename = 'navigation-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/phone-black':

                            $tmp_filename = 'phone-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/phone-white':

                            $tmp_filename = 'phone-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/plus-black':

                            $tmp_filename = 'plus-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/plus-white':

                            $tmp_filename = 'plus-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/power-black':

                            $tmp_filename = 'power-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/power-white':

                            $tmp_filename = 'power-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/recycle-black':

                            $tmp_filename = 'recycle-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/recycle-white':

                            $tmp_filename = 'recycle-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/refresh-black':

                            $tmp_filename = 'refresh-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/refresh-white':

                            $tmp_filename = 'refresh-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/search-black':

                            $tmp_filename = 'search-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/search-white':

                            $tmp_filename = 'search-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/shop-black':

                            $tmp_filename = 'shop-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/shop-white':

                            $tmp_filename = 'shop-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/star-black':

                            $tmp_filename = 'star-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/star-white':

                            $tmp_filename = 'star-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/tag-black':

                            $tmp_filename = 'tag-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/tag-white':

                            $tmp_filename = 'tag-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/user-black':

                            $tmp_filename = 'user-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/user-white':

                            $tmp_filename = 'user-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/video-black':

                            $tmp_filename = 'video-black';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/jquery_mobile_1_4_5/images/icons-png/video-white':

                            $tmp_filename = 'video-white';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/images/icons-png';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                        break;
                        case 'framework/lightbox/close':

                            $tmp_filename = 'close';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/images';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . 'close.png';

                        break;
                        case 'framework/lightbox/loading':

                            $tmp_filename = 'loading';
                            $tmp_file_extension = 'gif';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/images';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . 'loading.gif';

                        break;
                        case 'framework/lightbox/next':

                            $tmp_filename = 'next';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/images';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . 'next.png';

                        break;
                        case 'framework/lightbox/prev':

                            $tmp_filename = 'prev';
                            $tmp_file_extension = 'png';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/images';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . 'prev.png';

                        break;
                        case 'framework/lightbox-2.03.3/close':

                            $tmp_filename = 'closelabel';
                            $tmp_file_extension = 'gif';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/lightbox.js/2.03.3/css/images';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . 'closelabel.gif';

                        break;
                        case 'framework/lightbox-2.03.3/loading':

                            $tmp_filename = 'loading';
                            $tmp_file_extension = 'gif';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/lightbox.js/2.03.3/css/images';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . 'loading.gif';

                        break;
                        case 'framework/lightbox-2.03.3/next':

                            $tmp_filename = 'nextlabel';
                            $tmp_file_extension = 'gif';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/lightbox.js/2.03.3/css/images';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . 'nextlabel.gif';

                        break;
                        case 'framework/lightbox-2.03.3/prev':

                            $tmp_filename = 'prevlabel';
                            $tmp_file_extension = 'gif';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/lightbox.js/2.03.3/css/images';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . 'prevlabel.gif';

                        break;
                        case 'framework/lightbox-2.03.3/blank':

                            $tmp_filename = 'blank';
                            $tmp_file_extension = 'gif';
                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/lightbox.js/2.03.3/css/images';
                            $tmp_filepath .= DIRECTORY_SEPARATOR . 'blank.gif';

                        break;

                    }

                    if(isset($tmp_filepath)){

                        if(is_file($tmp_filepath)){

                            $tmp_header_options_ARRAY = array();

                            $tmp_header_options_ARRAY[] = 'Cache-Control: public, max-age=31536000';
                            $tmp_header_options_ARRAY[] = 'X-Frame-Options: SAMEORIGIN';

                            $tmp_filename_clean = $this->process_for_filename($tmp_filename);

                            $tmp_curr_headers_ARRAY = headers_list();
                            $tmp_crnrstn_signature_headers_ARRAY = $this->oCRNRSTN->header_signature_options_return();

                            //
                            // SOURCE :: https://stackoverflow.com/questions/9728269/content-length-and-other-http-headers
                            // COMMENT :: https://stackoverflow.com/a/9728576
                            // AUTHOR :: Neysor :: https://stackoverflow.com/users/1219121/neysor
                            $tmp_filesize = filesize($tmp_filepath);
                            $tmp_header_options_ARRAY[] = 'Content-Type: ' . mime_content_type($tmp_filepath);
                            $tmp_header_options_ARRAY[] = 'Content-length: ' . $tmp_filesize;
                            $tmp_header_options_ARRAY[] = 'Content-Disposition: inline; filename="' . $tmp_filename_clean . '.' . $tmp_file_extension . '"';

                            $tmp_date_lastmod = filemtime($tmp_filepath);
                            $tmp_date_lastmod = date('D, j M Y G:i:s T', $tmp_date_lastmod);
                            $tmp_header_options_ARRAY[] = 'Last-Modified: ' . $tmp_date_lastmod;

                            // header_options_add
                            // header_options_apply
                            // header_signature_options_return
                            // ENSURE ALL SIGNATURE HEADERS ARE IN PLACE AND CONTINUE
                            $this->oCRNRSTN->header_options_add($tmp_curr_headers_ARRAY);
                            $this->oCRNRSTN->header_options_add($tmp_crnrstn_signature_headers_ARRAY);
                            $this->oCRNRSTN->header_options_add($tmp_header_options_ARRAY);

                            $this->oCRNRSTN->header_options_apply();

                            $this->readfile_chunked($tmp_filepath);

                            //error_log(__LINE__ . ' asset mgr [' . $tmp_filepath . '].');

                            //ob_flush();
                            if(ob_get_level() > 0){ob_flush();}
                            flush();
                            exit();

                        }

                    }

                    //error_log(__LINE__ . '  asset mgr [404] asset_request_asset_family[' . $this->oCRNRSTN->asset_request_asset_family . '].');
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
//                        $tmp_filepath = $this->oCRNRSTN->get_resource('crnrstn_favicon_asset_tunnel_route_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
//                        $tmp_filepath .= '/' . $tmp_asset_family . '/' . $tmp_filename;
//                        error_log(__LINE__ . ' img asset mgr [' . $tmp_filename . '][' . $tmp_asset_family . ']. $tmp_filepath=[' . $tmp_filepath . '].');
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

                    //
                    //$this->system_output_profile_constants = array(CRNRSTN_ASSET_MODE_PNG, CRNRSTN_ASSET_MODE_JPEG, CRNRSTN_ASSET_MODE_BASE64);
                    $tmp_ASSET_MODE = $this->oCRNRSTN->return_set_bits($this->oCRNRSTN->system_output_profile_constants, true);

                    if(!isset($tmp_ASSET_MODE[0])){

                        $tmp_ASSET_MODE[] = CRNRSTN_ASSET_MODE_BASE64;

                    }

                    $this->default_asset_mode = $tmp_ASSET_MODE[0];

                    //
                    // IMAGE OUT
                    //$this->oCRNRSTN->error_log(__LINE__ . ' asset mgr ASSET[' . $tmp_filename . ']. $asset_output_mode_ARRAY=[' . self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] . ']. tmp_output_mode[' . $tmp_output_mode . ']. asset_family[' . print_r($this->oCRNRSTN->asset_request_asset_family, true) . ']. asset_response_method_key[' . $this->oCRNRSTN->asset_response_method_key . ']. $this->default_asset_mode[' . $this->default_asset_mode . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                    /*
                    [TUNNEL_ROUTING] THROUGH OUTPUT
                    case 'CRNRSTN_UI_IMG_HTML_WRAPPED': http path <img src="xxx">
                    case 'CRNRSTN_UI_IMG_HTTP': http path

                    [OUTPUT_FORMAT]
                    case 'CRNRSTN_UI_IMG_HTML_WRAPPED':
                    case 'CRNRSTN_UI_IMG': (ob_flush it)
                    case 'CRNRSTN_UI_IMG_STRING': naked http path (resolving) or base64
                    case 'CRNRSTN_UI_IMG_SOAP_DATA_TUNNEL': proxy email support

                    [OUTPUT_FILE_TYPE]
                    case 'CRNRSTN_UI_IMG_BASE64': (png before jpg, so alias of CRNRSTN_UI_IMG_BASE64_PNG)
                    case 'CRNRSTN_UI_IMG_PNG':
                    case 'CRNRSTN_UI_IMG_BASE64_PNG':
                    case 'CRNRSTN_UI_IMG_JPEG':
                    case 'CRNRSTN_UI_IMG_BASE64_JPEG':
                    case 'CRNRSTN_UI_CSS':          // SOME CSS IS KEYED TO JS DUE TO FILE STORAGE ASSOCIATIONS
                    case 'CRNRSTN_UI_JS':
                    =====
                    case 'CRNRSTN_UI_CSS_MAIN_DESKTOP':
                    case 'CRNRSTN_UI_JS_MAIN':
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

                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_ASSET_MAPPING) || $this->output_mode_override == CRNRSTN_ASSET_MAPPING){

                        $asset_mapping_is_active = true;
                        $asset_mapping_mode = CRNRSTN_ASSET_MAPPING;
                        //error_log(__LINE__ . ' asset mgr CRNRSTN_ASSET_MAPPING');

                        //return $this->asset_data($tmp_filename);

                    }

                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_ASSET_MAPPING_PROXY) || $this->output_mode_override == CRNRSTN_ASSET_MAPPING_PROXY){

                        //error_log(__LINE__ . ' asset mgr CRNRSTN_ASSET_MAPPING_PROXY');
                        $asset_mapping_is_active = true;
                        $asset_mapping_mode = CRNRSTN_ASSET_MAPPING_PROXY;

                       // return $this->asset_data($tmp_filename);

                    }

                    //error_log(__LINE__ . ' asset mgr ASSET[' . $tmp_filename . ']. tmp_output_mode[' . self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] . ']. asset_family[' . print_r($this->oCRNRSTN->asset_request_asset_family, true) . ']. asset_response_method_key[' . $this->oCRNRSTN->asset_response_method_key . ']. $this->default_asset_mode[' . $this->default_asset_mode . '].');

                    if(self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] !== CRNRSTN_UI_IMG){

                        switch(self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename]){
                            case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_ICO:
                            case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_PNG:
                            case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_JPEG:
                            case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_BASE64:
                            case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_JPEG:
                            case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_PNG:
                            case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_BASE64:
                            case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_BASE64 & CRNRSTN_UI_IMG_JPEG:
                            case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_BASE64_JPEG:
                            case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_BASE64 & CRNRSTN_UI_IMG_PNG:
                            case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_BASE64_PNG:
                            case CRNRSTN_UI_IMG_HTML_WRAPPED:

                                $this->oCRNRSTN->error_log(__LINE__ . ' asset mgr ASSET[' . $tmp_filename . ']. tmp_output_mode[' . $tmp_output_mode . ']. asset_family[' . print_r($this->oCRNRSTN->asset_request_asset_family, true) . ']. asset_response_method_key[' . $this->oCRNRSTN->asset_response_method_key . ']. $this->default_asset_mode[' . $this->default_asset_mode . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                                //error_log(__LINE__ . ' asset mgr ASSET[' . $tmp_filename . ']. tmp_output_mode[' . $tmp_output_mode . ']. asset_family[' . print_r($this->oCRNRSTN->asset_request_asset_family, true) . ']. asset_response_method_key[' . $this->oCRNRSTN->asset_response_method_key . ']. $this->default_asset_mode[' . $this->default_asset_mode . '].');
                                return $this->return_image_html_wrapped($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target, $tmp_asset_family, $tmp_output_mode, $asset_mapping_mode);

                            break;
                            case CRNRSTN_ASSET_MODE_JPEG:

                                switch($this->oCRNRSTN->asset_request_asset_family){
                                    case 'meta_preview_image':

                                        $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_meta_asset_tunnel_route_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
                                        $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_meta_asset_tunnel_route_http_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH'));
                                        $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $this->oCRNRSTN->asset_request_data_key;

                                    break;
                                    case 'system':

                                        $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_system_asset_tunnel_route_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
                                        $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_system_asset_tunnel_route_http_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH'));
                                        $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $this->oCRNRSTN->asset_request_data_key;

                                    break;
                                    case 'social':

                                        $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_social_asset_tunnel_route_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
                                        $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_social_asset_tunnel_route_http_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH'));
                                        $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $this->oCRNRSTN->asset_request_data_key;

                                    break;

                                }

                                //
                                // RETURN IMAGE STRING
                                //$tmp_file_extension = 'jpg';
                                //$tmp_filepath = $this->oCRNRSTN->crnrstn_path_directory() . '/' . $this->oCRNRSTN->crnrstn_root_directory() . '/ui/imgs/jpg/' . $this->oCRNRSTN->asset_request_asset_family . '/' . $tmp_filename . '.' . $tmp_file_extension;
                                //error_log(__LINE__ . ' asset mgr [CRNRSTN_ASSET_MODE_JPEG]. $tmp_filepath[' . $tmp_filename . '].');

                                return $this->return_image_string($tmp_path, $tmp_http, $tmp_map_http, $tmp_output_mode, $asset_mapping_is_active);
                                //return $this->return_image();

                            break;
                            case CRNRSTN_ASSET_MODE_PNG:

                                switch($this->oCRNRSTN->asset_request_asset_family){
                                    case 'meta_preview_image':

                                        $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_meta_asset_tunnel_route_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
                                        $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_meta_asset_tunnel_route_http_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH'));
                                        $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $this->oCRNRSTN->asset_request_data_key;

                                    break;
                                    case 'system':

                                        $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_system_asset_tunnel_route_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
                                        $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_system_asset_tunnel_route_http_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH'));
                                        $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $this->oCRNRSTN->asset_request_data_key;

                                    break;
                                    case 'social':

                                        $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_social_asset_tunnel_route_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
                                        $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_social_asset_tunnel_route_http_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH'));
                                        $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $this->oCRNRSTN->asset_request_data_key;

                                    break;

                                }

                                //$tmp_file_extension = 'png';
                                //$tmp_filepath = $this->oCRNRSTN->crnrstn_path_directory() . '/' . $this->oCRNRSTN->crnrstn_root_directory() .'/ui/imgs/png/' . $this->oCRNRSTN->asset_request_asset_family . '/' . $tmp_filename . '.' . $tmp_file_extension;
                                $this->oCRNRSTN->error_log(' asset mgr [CRNRSTN_ASSET_MODE_PNG]. $tmp_filepath[' . $tmp_filename . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                                return $this->return_image_string($tmp_path, $tmp_http, $tmp_map_http, $tmp_output_mode, $asset_mapping_is_active);
                                //return $this->return_image();

                            break;
                            case CRNRSTN_ASSET_MODE_BASE64:
                            case CRNRSTN_UI_IMG_BASE64:

                                //$this->oCRNRSTN->error_log(' asset mgr ASSET[' . $tmp_filename . ']. tmp_output_mode[' . $tmp_output_mode . ']. asset_family[' . print_r($this->oCRNRSTN->asset_request_asset_family, true) . ']. asset_response_method_key[' . $this->oCRNRSTN->asset_response_method_key . ']. $this->default_asset_mode[' . $this->default_asset_mode . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                                if($this->oCRNRSTN->is_system_terminate_enabled()){
                                    //$this->oCRNRSTN->error_log(' asset mgr ASSET[' . $tmp_filename . ']. tmp_output_mode[' . $tmp_output_mode . ']. asset_family[' . print_r($this->oCRNRSTN->asset_request_asset_family, true) . ']. asset_response_method_key[' . $this->oCRNRSTN->asset_response_method_key . ']. $this->default_asset_mode[' . $this->default_asset_mode . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                                    $tmp_path = CRNRSTN_ROOT;
                                    $tmp_system_directory = '_crnrstn';
                                    self::$image_output_mode = CRNRSTN_UI_IMG_BASE64_PNG;

                                    $tmp_path_base64 = $tmp_path . DIRECTORY_SEPARATOR . $tmp_system_directory . '/ui/imgs/base64/' . $this->oCRNRSTN->asset_request_asset_family . '/' . $this->oCRNRSTN->asset_request_data_key . '.php';

                                    $tmp_file_repair = false;
                                    if(!is_file($tmp_path_base64)){

                                        $this->oCRNRSTN->error_log('Failure opening [' . $this->oCRNRSTN->asset_request_data_key . '] for inclusion. Attempting to repair the BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                                        $this->system_base64_synchronize($this->oCRNRSTN->asset_request_data_key . '.png');
                                        $tmp_file_repair = true;

                                    }

                                    //
                                    // TRY (POTENTIALLY...AFTER system_base64_synchronize())
                                    if(!@include($tmp_path_base64)){

                                        if($tmp_file_repair){

                                            //
                                            // HOOOSTON...VE HAF PROBLEM!
                                            throw new Exception('Failure opening [' . $tmp_path_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.');

                                        }else{

                                            $this->oCRNRSTN->error_log('Failure opening [' . $this->oCRNRSTN->asset_request_data_key . '] for inclusion. Attempting to repair the BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                                            $this->system_base64_synchronize($this->oCRNRSTN->asset_request_data_key . '.png');
                                            $tmp_file_repair = true;

                                        }

                                        if(!@include($tmp_path_base64)){

                                            //
                                            // HOOOSTON...VE HAF PROBLEM!
                                            throw new Exception('Failure opening [' . $tmp_path_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.');

                                        }else{

                                            //$this->oCRNRSTN->print_r('Repair of asset successfully completed on [' . $this->oCRNRSTN->asset_request_data_key . '] within the CRNRSTN :: BASE64 file system.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
                                            $this->oCRNRSTN->error_log('Repair of asset successfully completed on [' . $this->oCRNRSTN->asset_request_data_key . '] within the CRNRSTN :: BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                                        }

                                    }

                                }else{

                                    $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_path_directory', 0, 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES');
                                    $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES');
                                    self::$image_output_mode = CRNRSTN_UI_IMG_BASE64_PNG;

                                    $tmp_path_base64 = $tmp_path . DIRECTORY_SEPARATOR . $tmp_system_directory . '/ui/imgs/base64/' . $this->oCRNRSTN->asset_request_asset_family . '/' . $this->oCRNRSTN->asset_request_data_key . '.php';

                                    $tmp_file_repair = false;
                                    if(!is_file($tmp_path_base64)){

                                        $this->oCRNRSTN->error_log('Failure opening [' . $this->oCRNRSTN->asset_request_data_key . '] for inclusion. Attempting to repair the BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                                        $this->system_base64_synchronize($this->oCRNRSTN->asset_request_data_key . '.png');
                                        $tmp_file_repair = true;

                                    }

                                    //
                                    // TRY (POTENTIALLY...AFTER system_base64_synchronize())
                                    if(!@include($tmp_path_base64)){

                                        if($tmp_file_repair){

                                            //
                                            // HOOOSTON...VE HAF PROBLEM!
                                            throw new Exception('Failure opening [' . $tmp_path_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.');

                                        }else{

                                            $this->oCRNRSTN->error_log('Failure opening [' . $this->oCRNRSTN->asset_request_data_key . '] for inclusion. Attempting to repair the BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                                            $this->system_base64_synchronize($this->oCRNRSTN->asset_request_data_key . '.png');
                                            $tmp_file_repair = true;

                                        }

                                        if(!@include($tmp_path_base64)){

                                            //
                                            // HOOOSTON...VE HAF PROBLEM!
                                            throw new Exception('Failure opening [' . $tmp_path_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.');

                                        }else{

                                            //$this->oCRNRSTN->print_r('Repair of asset successfully completed on [' . $this->oCRNRSTN->asset_request_data_key . '] within the CRNRSTN :: BASE64 file system.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
                                            $this->oCRNRSTN->error_log('Repair of asset successfully completed on [' . $this->oCRNRSTN->asset_request_data_key . '] within the CRNRSTN :: BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                                        }

                                    }

                                }

                                $tmp_str = '';
                                if(isset($system_file_serial)){

                                    $tmp_str = self::$image_filesystem_meta_ARRAY[self::$image_output_mode][self::$request_salt][$system_file_serial]['base64'];

                                }

                                return $tmp_str;

                            break;
                            default:

                                switch($this->oCRNRSTN->asset_request_asset_family){
                                    case 'meta_preview_image':

                                        $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_meta_asset_tunnel_route_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
                                        $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_meta_asset_tunnel_route_http_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH'));
                                        $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES');

                                        $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $this->oCRNRSTN->asset_request_data_key;
                                        $tmp_http .= $tmp_system_directory . '/ui/imgs/meta/';

                                    break;
                                    case 'system':

                                        $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_system_asset_tunnel_route_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
                                        $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_system_asset_tunnel_route_http_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH'));
                                        $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES');

                                        $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $this->oCRNRSTN->asset_request_data_key;
                                        $tmp_http .= $tmp_system_directory . '/ui/imgs/' . $this->oCRNRSTN->asset_request_asset_family;

                                    break;
                                    case 'social':

                                        $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_social_asset_tunnel_route_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
                                        $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_social_asset_tunnel_route_http_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH'));
                                        $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES');
                                        $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $this->oCRNRSTN->asset_request_data_key;

                                        $tmp_http .= $tmp_system_directory . '/ui/imgs/' . $this->oCRNRSTN->asset_request_asset_family;

                                    break;

                                }

                                //error_log(__LINE__ . ' asset mgr DEFAULT SWITCH HIT. $this->default_asset_mode[' . $this->default_asset_mode . ']. [' . $tmp_filename . ']. [' . $tmp_output_mode . ']. [' . self::$asset_output_mode_ARRAY[$this->oCRNRSTN->asset_request_asset_family][$tmp_filename] . '].');

                                //error_log(__LINE__ . ' asset mgr DEFAULT SWITCH HIT. $tmp_path[' . $tmp_path . ']. $this->oCRNRSTN->asset_request_asset_family[' . $this->oCRNRSTN->asset_request_asset_family . ']. $tmp_http[' . $tmp_http . ']. $tmp_map_http[' . $tmp_map_http . ']. $tmp_output_mode[' . $tmp_output_mode . ']. $asset_mapping_is_active['.$asset_mapping_is_active.'].');

                                //die();

                                return $this->return_image_string($tmp_path, $tmp_http, $tmp_map_http, $tmp_output_mode, $asset_mapping_is_active);

                            break;

                        }

                    }

                    switch($this->oCRNRSTN->asset_request_asset_family){
                        case 'meta_preview_image':

                            $this->oCRNRSTN->asset_request_asset_family = 'meta';  // TRANSITION TO ACTUAL FOLDER NAME.

                            $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_meta_asset_tunnel_route_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
                            $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_meta_asset_tunnel_route_http_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH'));
                            $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES');

                            $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $this->oCRNRSTN->asset_request_data_key;
                            $tmp_http .= $tmp_system_directory . '/ui/imgs/meta/';

                        break;
                        case 'system':

                            $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_system_asset_tunnel_route_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
                            $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_system_asset_tunnel_route_http_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH'));
                            $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES');

                            $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $this->oCRNRSTN->asset_request_data_key;
                            $tmp_http .= $tmp_system_directory . '/ui/imgs/' . $this->oCRNRSTN->asset_request_asset_family;

                        break;
                        case 'social':

                            $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_social_asset_tunnel_route_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
                            $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_social_asset_tunnel_route_http_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH'));
                            $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES');
                            $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $this->oCRNRSTN->asset_request_data_key;

                            $tmp_http .= $tmp_system_directory . '/ui/imgs/' . $this->oCRNRSTN->asset_request_asset_family;

                        break;

                    }

                    $tmp_file_extension = 'png';

                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_ASSET_MODE_JPEG)){

                        $tmp_file_extension = 'jpg';

                    }

                    $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES');

                    if($this->oCRNRSTN->asset_request_asset_family ==='meta'){

                        $tmp_filepath = $this->oCRNRSTN->crnrstn_path_directory() . DIRECTORY_SEPARATOR . $tmp_system_directory . '/ui/imgs/' . $tmp_file_extension . DIRECTORY_SEPARATOR . $this->oCRNRSTN->crnrstn_request_ugc_val . '.' . $tmp_file_extension;

                    }else{

                        $tmp_filepath = $this->oCRNRSTN->crnrstn_path_directory() . DIRECTORY_SEPARATOR . $tmp_system_directory . '/ui/imgs/' . $tmp_file_extension . DIRECTORY_SEPARATOR . $this->oCRNRSTN->asset_request_asset_family . DIRECTORY_SEPARATOR . $tmp_filename . '.' . $tmp_file_extension;

                    }

                    //$tmp_filepath = $tmp_path  . '/' . $this->oCRNRSTN->asset_request_asset_family;
                    //error_log(__LINE__ . ' asset mgr $tmp_filepath[' . $tmp_filepath . '].');
                    if(isset($tmp_filepath)){

                        if(is_file($tmp_filepath)){

                            $tmp_header_options_ARRAY = array();

                            $tmp_header_options_ARRAY[] = 'Cache-Control: public, max-age=31536000';
                            $tmp_header_options_ARRAY[] = 'X-Frame-Options: SAMEORIGIN';

                            $tmp_filename_clean = $this->process_for_filename($tmp_filename);

                            $tmp_curr_headers_ARRAY = headers_list();
                            $tmp_crnrstn_signature_headers_ARRAY = $this->oCRNRSTN->header_signature_options_return();

                            //
                            // SOURCE :: https://stackoverflow.com/questions/9728269/content-length-and-other-http-headers
                            // COMMENT :: https://stackoverflow.com/a/9728576
                            // AUTHOR :: Neysor :: https://stackoverflow.com/users/1219121/neysor
                            $tmp_filesize = filesize($tmp_filepath);
                            $tmp_header_options_ARRAY[] = 'Content-Type: ' . mime_content_type($tmp_filepath);
                            $tmp_header_options_ARRAY[] = 'Content-length: ' . $tmp_filesize;
                            $tmp_header_options_ARRAY[] = 'Content-Disposition: inline; filename="' . $tmp_filename_clean . '.' . $tmp_file_extension . '"';

                            $tmp_date_lastmod = filemtime($tmp_filepath);
                            $tmp_date_lastmod = date('D, j M Y G:i:s T', $tmp_date_lastmod);
                            $tmp_header_options_ARRAY[] = 'Last-Modified: ' . $tmp_date_lastmod;

                            // header_options_add
                            // header_options_apply
                            // header_signature_options_return
                            // ENSURE ALL SIGNATURE HEADERS ARE IN PLACE AND CONTINUE
                            $this->oCRNRSTN->header_options_add($tmp_curr_headers_ARRAY);
                            $this->oCRNRSTN->header_options_add($tmp_crnrstn_signature_headers_ARRAY);
                            $this->oCRNRSTN->header_options_add($tmp_header_options_ARRAY);

                            $this->oCRNRSTN->header_options_apply();

                            $this->readfile_chunked($tmp_filepath);

                            //ob_flush();
                            if(ob_get_level() > 0){ob_flush();}
                            flush();
                            exit();

                        }

                    }

                //error_log(__LINE__ . '  asset mgr [404] asset_request_asset_family[' . $this->oCRNRSTN->asset_request_asset_family . '].');
                return $this->oCRNRSTN->return_server_response_code(404);

                break;

            }

            // =================

            //error_log(__LINE__ . ' asset mgr $tmp_output_mode[' . $tmp_output_mode . ']. $tmp_filename[' . $tmp_filename . ']. [' . print_r(self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename], true) . '].');

            switch($tmp_output_mode){
                case CRNRSTN_ASSET_MAPPING:

                    //error_log(__LINE__ . ' asset mgr $tmp_filename[' . $tmp_filename . ']. [' . print_r(self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename], true) . '].');
                    switch($tmp_asset_family){
                        case 'system':

                            if($this->oCRNRSTN->is_bit_set(CRNRSTN_SYSTEM_IMG_ASSET_MAPPING)){

                                //error_log(__LINE__ . ' asset mgr RETURN PNG SYSTEM IMAGE[' . $tmp_filename . '].');
                                return $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_filename;

                            }

                        break;
                        case 'social':

                            if($this->oCRNRSTN->is_bit_set(CRNRSTN_SOCIAL_IMG_ASSET_MAPPING)){

                                //error_log(__LINE__ . ' asset mgr RETURN PNG SOCIAL IMAGE[' . $tmp_filename . '].');
                                return $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_filename;

                            }

                        break;
                        default:
                            // SILENCE IS GOLDEN

                        break;

                    }

                break;
                case CRNRSTN_UI_CSS:

                break;
                case CRNRSTN_UI_JS:

                break;
                case CRNRSTN_UI_IMG_BASE64_JPEG:

                    $tmp_path_base64 = CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/' . $tmp_filename . '.php';

                    if(!is_file($tmp_path_base64)){

                        $this->oCRNRSTN->error_log('Failure opening [' . $tmp_filename . '] for inclusion. Attempting to repair the BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
                        //$this->oCRNRSTN->print_r('Failure opening [' . $tmp_filename . '] for inclusion. Attempting to repair the BASE64 file system.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);

                        $this->system_base64_synchronize($tmp_filename);

                        if(!is_file($tmp_path_base64)){

                            $this->oCRNRSTN->error_log('Failure opening [' . $tmp_path_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
                            //$this->oCRNRSTN->print_r('Failure opening [' . $tmp_path_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('Failure opening [' . $tmp_path_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.');

                        }else{

                            //$this->oCRNRSTN->print_r('Repair of asset successfully completed on [' . $tmp_filename . '] within the CRNRSTN :: BASE64 file system.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
                            $this->oCRNRSTN->error_log('Repair of asset successfully completed on [' . $tmp_filename . '] within the CRNRSTN :: BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                            include($tmp_path_base64);

                        }

                    }else{

                        include($tmp_path_base64);

                    }

                    if(isset($system_file_serial)){

                        $tmp_str = self::$image_filesystem_meta_ARRAY[self::$image_output_mode][self::$request_salt][$system_file_serial ]['base64'];

                    }

                    //
                    // BASE64
                    return $tmp_str;

                break;
                case CRNRSTN_UI_IMG_BASE64:
                case CRNRSTN_UI_IMG_BASE64_PNG:

                    $tmp_path_base64 = CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/' . $tmp_filename . '.php';

                    if(!is_file($tmp_path_base64)){

                        $this->oCRNRSTN->error_log('Failure opening [' . $tmp_filename . '] for inclusion. Attempting to repair the BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
                        //$this->oCRNRSTN->print_r('Failure opening [' . $tmp_filename . '] for inclusion. Attempting to repair the BASE64 file system.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);

                        $this->system_base64_synchronize($tmp_filename);

                        if(!is_file($tmp_path_base64)){

                            $this->oCRNRSTN->error_log('Failure opening [' . $tmp_path_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
                            //$this->oCRNRSTN->print_r('Failure opening [' . $tmp_path_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('Failure opening [' . $tmp_path_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.');

                        }else{

                            //$this->oCRNRSTN->print_r('Repair of asset successfully completed on [' . $tmp_filename . '] within the CRNRSTN :: BASE64 file system.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
                            $this->oCRNRSTN->error_log('Repair of asset successfully completed on [' . $tmp_filename . '] within the CRNRSTN :: BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                            include($tmp_path_base64);

                        }

                    }else{

                        include($tmp_path_base64);

                    }

                    if(isset($system_file_serial)) {

                        $tmp_str = self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$system_file_serial ]['base64'];

                    }

                    //
                    // BASE64
                    return $tmp_str;

                break;
                case CRNRSTN_UI_IMG_HTML_WRAPPED:

                    //error_log(__LINE__ . ' asset mgr $tmp_family[' . $this->oCRNRSTN->asset_request_asset_family . ']. $tmp_filename[' . $tmp_filename . ']. $tmp_output_mode[' . $tmp_output_mode . '].');
                    $tmp_str = $this->oCRNRSTN->crnrstn_http_endpoint() . '_crnrstn/ui/imgs/jpg/' . $tmp_filename . '.jpg';

                    if(strlen($tmp_link) > 0){

                        $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                        return $tmp_str;

                    }else{

                        switch($this->oCRNRSTN->asset_request_asset_family){
                            case 'crnrstn':
                            case 'baasdrive':
                            case 'jony5':

                                return '<link rel="shortcut icon" type="image/x-icon" href="' . $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_asset_family . '/' . $tmp_filename . '.ico&crnrstn_=420.00" />';

                            break;
                            default:

                                return '<img src="' . $tmp_str . '" width="' . $tmp_width . '" height="' . $tmp_height . '" alt="' . $tmp_alt_text . '" title="' . $tmp_title_text . '">';

                            break;

                        }


                    }

                break;
                case CRNRSTN_UI_IMG_JPEG:

                    //error_log(__LINE__ . ' asset mgr $tmp_filename[' . $tmp_filename . ']. $tmp_output_mode[' . $tmp_output_mode . '].');
                    $tmp_str = $this->oCRNRSTN->crnrstn_http_endpoint() . 'ui/imgs/jpg/' . $tmp_filename . '.jpg';

                    //
                    // JPEG
                    return $tmp_str;

                break;
                case CRNRSTN_UI_IMG_PNG:

                    //error_log(__LINE__ . ' asset mgr $tmp_filename[' . $tmp_filename . ']. $tmp_output_mode[' . $tmp_output_mode . '].');
                    switch($tmp_asset_family){
                        case 'system':

                            if($this->oCRNRSTN->is_bit_set(CRNRSTN_SYSTEM_IMG_ASSET_MAPPING)){

                                //error_log(__LINE__ . ' asset mgr RETURN PNG SYSTEM IMAGE[' . $tmp_filename . '].');
                                return $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_filename;

                            }

                        break;
                        case 'social':

                            if($this->oCRNRSTN->is_bit_set(CRNRSTN_SOCIAL_IMG_ASSET_MAPPING)){

                                //error_log(__LINE__ . ' asset mgr RETURN PNG SOCIAL IMAGE[' . $tmp_filename . '].');
                                return $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_filename;

                            }

                        break;
                        default:
                            // SILENCE IS GOLDEN

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
                    $tmp_ARRAY['alt_text'] = $tmp_alt_text;
                    $tmp_ARRAY['title_text'] = $tmp_title_text;
                    $tmp_ARRAY['link'] = $tmp_link;
                    $tmp_ARRAY['target'] = $tmp_target;

                    return $tmp_ARRAY;

                break;
                default:

                    $this->oCRNRSTN->error_log('DEFAULT NOT SET FOR ASSET[' . $tmp_filename . ']. HOOOSTON...VE HAF PROBLEM!', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
                    return '';

                break;

            }

        }catch( Exception $e ){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            //C
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    private function return_css_string_output($asset_reference = NULL){

        $tmp_key = '';

        if(isset($this->oCRNRSTN->asset_request_data_key)){

            $tmp_key = $this->oCRNRSTN->asset_request_data_key;

        }

        if(isset($asset_reference)) {

            $tmp_key = $asset_reference;

        }

        /*
        public_html/_crnrstn/ui/js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile.external-png-1.4.5.css
        public_html/_crnrstn/ui/js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile.external-png-1.4.5.min.css

        public_html/_crnrstn/ui/js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile.icons-1.4.5.css
        public_html/_crnrstn/ui/js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile.icons-1.4.5.min.css

        public_html/_crnrstn/ui/js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile.inline-png-1.4.5.css
        public_html/_crnrstn/ui/js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile.inline-png-1.4.5.min.css

        public_html/_crnrstn/ui/js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile.inline-svg-1.4.5.css
        public_html/_crnrstn/ui/js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile.inline-svg-1.4.5.min.css

        public_html/_crnrstn/ui/js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile-1.4.5.css
        public_html/_crnrstn/ui/js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.css

        public_html/_crnrstn/ui/js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile.theme-1.4.5.css
        public_html/_crnrstn/ui/js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile.theme-1.4.5.min.css


        /*
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

        '' => $tmp_session_salt,
        '' => $tmp_session_salt,
        '' => $tmp_session_salt,
        '' => $tmp_session_salt,
        '' => $tmp_session_salt,
        '' => $tmp_session_salt,
        '' => $tmp_session_salt,
        '' => $tmp_session_salt,
        '' => $tmp_session_salt,
        '' => $tmp_session_salt,
        '' => $tmp_session_salt,
        '' => $tmp_session_salt,

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
    
    private function return_js_string_output($asset_reference = NULL){

        $tmp_key = '';

        if(isset($this->oCRNRSTN->asset_request_data_key)){

            $tmp_key = $this->oCRNRSTN->asset_request_data_key;

        }

        if(isset($asset_reference)) {

            $tmp_key = $asset_reference;

        }

        switch($tmp_key){
            case 'crnrstn.backbone_1_4_1.min.js':

                return $this->crnrstn_backbone_1_4_1_min_js();

            break;
            case 'crnrstn.lightbox-2.03.3.js':

                return $this->crnrstn_lightbox_2_03_3_js();

            break;

        }

        return '';

    }

    private function return_asset_data(){

        $tmp_header_options_ARRAY = array();
        $tmp_process_return = false;

        $tmp_header_options_ARRAY[] = 'Cache-Control: public, max-age=31536000';
        $tmp_header_options_ARRAY[] = 'X-Frame-Options: SAMEORIGIN';

        switch($this->oCRNRSTN->asset_request_asset_family){
            case 'css':

                $tmp_process_return = true;
                $tmp_header_options_ARRAY[] = 'Content-Type: text/css';
                $tmp_dir_path = $this->oCRNRSTN->get_resource('crnrstn_css_asset_mapping_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');

                $tmp_date_lastmod = filemtime($tmp_dir_path);
                $tmp_date_lastmod = date('D, j M Y G:i:s T', $tmp_date_lastmod);
                $tmp_header_options_ARRAY[] = 'Last-Modified: ' . $tmp_date_lastmod;

                //error_log(__LINE__ . 'Last-Modified: ' . $tmp_date_lastmod);
                //error_log(__LINE__ . ' Last-Modified: <day-name>, <day> <month> <year> <hour>:<minute>:<second> GMT');
                switch($this->asset_meta_path){
                    case $this->oCRNRSTN->session_salt():

                        //
                        // SESSION SALT MEANS NO EXTERNAL FILE. RETURN DATA FROM INTERNAL CACHE SOURCE.
                        switch($this->oCRNRSTN->asset_request_data_key){
                            case 'crnrstn.jquery-mobile-external-png-1.4.5.css':
                            case 'crnrstn.jquery-mobile-external-png-1.4.5.min.css':
                            case 'crnrstn.jquery-mobile-icons-1.4.5.css':
                            case 'crnrstn.jquery-mobile-icons-1.4.5.min.css':
                            case 'crnrstn.jquery-mobile-inline-png-1.4.5.css':
                            case 'crnrstn.jquery-mobile-inline-png-1.4.5.min.css':
                            case 'crnrstn.jquery-mobile-inline-svg-1.4.5.css':
                            case 'crnrstn.jquery-mobile-inline-svg-1.4.5.min.css':
                            case 'crnrstn.jquery-mobile-theme-1.4.5.css':
                            case 'crnrstn.jquery-mobile-theme-1.4.5.min.css':
                            case 'crnrstn.jquery-mobile-1.4.5.css':
                            case 'crnrstn.jquery-mobile-1.4.5.min.css':
                            case 'crnrstn.lightbox.css':
                            case 'crnrstn.lightbox.min.css':
                            case 'crnrstn.lightbox-2.03.3.css':

                                $tmp_str = $this->return_css_string_output();

                            break;

                        }

                        $tmp_dir_path = '';

                    break;
                    default:

                        if(isset($this->asset_meta_path)){

                            if(strlen($this->asset_meta_path) > 0){

                                $tmp_dir_path = $tmp_dir_path . '/' . $this->asset_meta_path;

                            }

                        }

                    break;

                }

            break;
            case 'js':

                $tmp_process_return = true;

                // lightbox.js css is stored on javascript path
                // THIS Content-Type DATA IS AVAILABLE HERE ($resource_ARRAY['meta_type']), BUT GETTING THIS
                // VALUE FOR ONE FILE RESOURCE REQUIRES LOADING ALL THE DATA FOR ALL FILES IN THAT FRAMEWORK.
                // THE CURRENT ARCHITECTURE: "LOAD EVERYTHING...OR, GET BY PERFECTLY FINE WITH ALMOST NOTHING."
                //...WE TAKE THE FAST (strpos) WAY RATHER THAN PERFORM THE INTERNAL META LOOKUPS.
                $pos_css = strpos($this->oCRNRSTN->asset_request_data_key,'.css');
                $pos_map = strpos($this->oCRNRSTN->asset_request_data_key,'.map');
                if($pos_css !== false){

                    $tmp_header_options_ARRAY[] = 'Content-Type: text/css';

                }else{

                    if($pos_map !== false){

                        //
                        // SOURCE :: https://stackoverflow.com/questions/16384089/jquery-2-0-0-min-map-uncaught-syntaxerror-unexpected-token/
                        // COMMENT :: https://stackoverflow.com/a/38021461
                        // AUTHOR :: bylerj :: https://stackoverflow.com/users/2510246/bylerj
                        $tmp_header_options_ARRAY[] = 'Content-Type: text/json';

                    }else{

                        $tmp_header_options_ARRAY[] = 'Content-Type: text/javascript';

                    }

                }

                $tmp_dir_path = $this->oCRNRSTN->get_resource('crnrstn_js_asset_mapping_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');

                $tmp_date_lastmod = filemtime($tmp_dir_path);
                $tmp_date_lastmod = date('D, j M Y G:i:s T', $tmp_date_lastmod);
                $tmp_header_options_ARRAY[] = 'Last-Modified: ' . $tmp_date_lastmod;

                switch($this->asset_meta_path){
                    case $this->oCRNRSTN->session_salt():

                        //
                        // SESSION SALT MEANS NO EXTERNAL FILE. RETURN DATA FROM INTERNAL CACHE SOURCE.
                        switch($this->oCRNRSTN->asset_request_data_key){
                            case 'crnrstn.backbone_1_4_1.min.js':
                            case 'crnrstn.lightbox-2.03.3.js':

                                $tmp_str = $this->return_js_string_output();

                            break;

                        }

                        $tmp_dir_path = '';

                    break;
                    default:

                        if(isset($this->asset_meta_path)){

                            if(strlen($this->asset_meta_path) > 0){

                                $tmp_dir_path = $tmp_dir_path . '/' . $this->asset_meta_path;

                            }

                        }

                    break;

                }

            break;
            case 'integrations':

                switch($this->oCRNRSTN->asset_request_data_key){
                    case 'framework/jquery_mobile_1_4_5/images/ajax-loader':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/action-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/action-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/alert-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/alert-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-d-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-d-l-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-d-l-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-d-r-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-d-r-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-d-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-l-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-l-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-r-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-r-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-u-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-u-l-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-u-l-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-u-r-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-u-r-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/arrow-u-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/audio-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/audio-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/back-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/back-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/bars-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/bars-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/bullets-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/bullets-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/calendar-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/calendar-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/camera-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/camera-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/carat-d-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/carat-d-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/carat-l-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/carat-l-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/carat-r-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/carat-u-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/carat-r-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/carat-u-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/check-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/check-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/clock-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/clock-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/cloud-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/cloud-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/comment-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/comment-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/delete-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/delete-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/edit-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/edit-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/eye-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/eye-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/forbidden-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/forbidden-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/forward-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/forward-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/gear-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/gear-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/grid-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/grid-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/heart-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/heart-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/home-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/home-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/info-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/info-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/location-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/location-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/lock-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/lock-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/mail-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/mail-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/minus-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/minus-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/navigation-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/navigation-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/phone-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/phone-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/plus-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/plus-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/power-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/power-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/recycle-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/recycle-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/refresh-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/refresh-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/search-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/search-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/shop-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/shop-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/star-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/star-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/tag-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/tag-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/user-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/user-white':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/video-black':
                    case 'framework/jquery_mobile_1_4_5/images/icons-png/video-white':
                    case 'framework/lightbox/close':
                    case 'framework/lightbox/loading':
                    case 'framework/lightbox/next':
                    case 'framework/lightbox/prev':
                    case 'framework/lightbox-2.03.3/close':
                    case 'framework/lightbox-2.03.3/loading':
                    case 'framework/lightbox-2.03.3/next':
                    case 'framework/lightbox-2.03.3/prev':

                        return $this->return_system_image($this->oCRNRSTN->asset_response_method_key);

                    break;

                }

            break;

        }

        if($tmp_process_return){

            $tmp_filepath = $tmp_dir_path . '/' . $this->oCRNRSTN->asset_request_data_key;

            $tmp_curr_headers_ARRAY = headers_list();
            $tmp_crnrstn_signature_headers_ARRAY = $this->oCRNRSTN->header_signature_options_return();

            if(!isset($tmp_str)){

                $tmp_str = file_get_contents($tmp_filepath);
                $tmp_filesize = filesize($tmp_filepath);

            }

            if(!isset($tmp_filesize)){

                $tmp_filesize = strlen($tmp_str);

            }

            $tmp_header_options_ARRAY[] = 'Content-length: ' . $tmp_filesize;

            // header_options_add
            // header_options_apply
            // header_signature_options_return
            // ENSURE ALL SIGNATURE HEADERS ARE IN PLACE AND CONTINUE
            $this->oCRNRSTN->header_options_add($tmp_curr_headers_ARRAY);
            $this->oCRNRSTN->header_options_add($tmp_crnrstn_signature_headers_ARRAY);
            $this->oCRNRSTN->header_options_add($tmp_header_options_ARRAY);

            $this->oCRNRSTN->header_options_apply();

            //error_log(__LINE__ . ' asset mgr asset mgr file_path[' . $tmp_filepath . ']. asset_response_method_key[' . $this->oCRNRSTN->asset_response_method_key . ']. asset_request_asset_family=[' . $this->oCRNRSTN->asset_request_asset_family . '].');

            echo $tmp_str;
            exit;

        }

        return '';

        /*
        [Mon Oct 31 06:15:27.359017 2022] [:error] [pid 7687] [client 172.16.225.1:50527] 15904 asset mgr asset mgr
        asset_meta_path[_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/css].
        asset_response_method_key[CRNRSTN_UI_CSS].
        asset_request_data_key=[lightbox.min.css].
        asset_request_asset_family=[css].

        file_get_contents($tmp_path_js . '/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/js/lightbox.min.js').'


        header("Content-Type: text/plain");
        header('Content-Disposition: inline; filename="' . $this->process_for_filename($tmp_filename) . '.' . $tmp_file_extension . '"');

        $tmp_curr_headers_ARRAY = headers_list();
        $tmp_crnrstn_signature_headers_ARRAY = $this->header_signature_options_return();

        //
        // ENSURE ALL SIGNATURE HEADERS ARE IN PLACE AND CONTINUE
        $this->header_options_add($tmp_curr_headers_ARRAY);
        $this->header_options_add($tmp_crnrstn_signature_headers_ARRAY);

        //
        // RESPONSE HEADER CONSTRUCTION
        if(isset($header_options_array)){

            /*
            TAKE CURRENT HEADERS...
                - FORCE INJECT SIGNATURE HEADERS
                    - FORCE INJECT ANY PROVISIONAL HEADERS
            //

            //
            // USE PROVISIONAL HEADERS (APPLY THEM AT THE END FOR OVERWRITE PROTECTION)
            $this->header_options_add($header_options_array);

        }

        $tmp_array = array();
        $tmp_array[] = 'Cache-Control: public, max-age=31536000';
        $tmp_array[] = 'X-Frame-Options: SAMEORIGIN';
        $this->header_options_add($tmp_array);

        $this->apply_headers();
        echo $response;
        exit;

        */

        //error_log(__LINE__ . ' asset mgr asset mgr asset_meta_path[' . $this->asset_meta_path . ']. asset_response_method_key[' . $this->oCRNRSTN->asset_response_method_key . ']. asset_request_data_key=[' . $this->oCRNRSTN->asset_request_data_key . ']. asset_request_asset_family=[' . $this->oCRNRSTN->asset_request_asset_family . '].');

        return 'Hello world.';

    }

    private function return_linked_ui_element($str, $url, $target, $width = NULL, $height = NULL, $alt = NULL, $title = NULL, $meta_params_ARRAY = array()){

        $width = $this->html_img_dom_return($width, 'WIDTH');
        $height = $this->html_img_dom_return($height, 'HEIGHT');
        $alt = $this->html_img_dom_return($alt, 'ALT');
        $title = $this->html_img_dom_return($title, 'TITLE');

        // ' . $img_css . '
        //$img_css = $this->html_img_dom_return($meta_params_ARRAY, 'CSS');

        $tmp_str = '<img src="' . $str . '" ' . $width . ' ' . $height . ' ' . $alt . ' ' . $title . '>';

        if(strlen($target) < 1){

            $target = '_self';

        }

        if(isset($url)){

            if(strlen($url) > 0){

                if($this->oCRNRSTN->isset_encryption(CRNRSTN_ENCRYPT_TUNNEL)){
                    //if(strlen($this->oCRNRSTN->env_key) > 0 && $this->oCRNRSTN->isset_encryption(CRNRSTN_ENCRYPT_TUNNEL)){

                    $tmp_str = '<a href="' . $this->oCRNRSTN->return_sticky_link($url, $meta_params_ARRAY) . '" target="' . $target . '">' . $tmp_str . '</a>';

                    return $tmp_str;

                }

                $tmp_str = '<a href="' . $url . '" target="' . $target . '">' . $tmp_str . '</a>';

                return $tmp_str;

            }else{

                return $tmp_str;

            }

        }

        return $tmp_str;

    }

    private function html_img_dom_return($attribute_data, $attribute_type = 'WIDTH'){

        switch($attribute_type){

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
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
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

            if(is_file($file_path)){

                if(!($tmp_base64_filemtime = @filemtime(self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64][self::$request_salt]['path_filename']))){

                    $tmp_base64_filemtime = $this->oCRNRSTN->return_micro_time();

                }

//                case CRNRSTN_UI_IMG_JPEG:
//                case CRNRSTN_UI_IMG_PNG:

                list($tmp_width, $tmp_height) = getimagesize($file_path);
                self::$image_filesystem_meta_ARRAY[$data_type_constant][self::$request_salt]['image_dimensions'] = $tmp_width . ' pixels in width X ' . $tmp_height . ' pixels in height.';
                self::$image_filesystem_meta_ARRAY[$data_type_constant][self::$request_salt]['mime_content_type'] = mime_content_type($file_path);
                self::$image_filesystem_meta_ARRAY[$data_type_constant][self::$request_salt]['filesize'] = $this->oCRNRSTN->format_bytes($this->oCRNRSTN->find_filesize($file_path), 5);
                self::$image_filesystem_meta_ARRAY[$data_type_constant][self::$request_salt]['filemtime'] = filemtime($file_path);
                self::$image_filesystem_meta_ARRAY[$data_type_constant][self::$request_salt]['md5'] = md5_file($file_path);
                self::$image_filesystem_meta_ARRAY[$data_type_constant][self::$request_salt]['sha1'] = sha1_file($file_path);
                self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64][self::$request_salt]['filemtime'] = $tmp_base64_filemtime;

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

        if(isset(self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['arch_1.0_base64'])){

            $tmp_current_base64 = self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['arch_1.0_base64'];

        }

        if(strlen($tmp_current_base64) > 0){

            if($tmp_current_base64 != $tmp_base64){

                //self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['arch_1.0_base64'] = '';
                //$this->oCRNRSTN->print_r('INVALID [' . $data_type_constant . '] BASE64 FROM FILE.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
                $this->oCRNRSTN->error_log('System BASE64 asset sync with file [' . $data_type_constant . '] required.', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);

                return false;

            }

        }

        //
        // CURRENT BASE64
        switch($data_type_constant){
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_BASE64_STATIC_PHP = '';
                $tmp_BASE64_LIVE = self::$image_filesystem_meta_ARRAY[$data_type_constant][self::$request_salt]['base64'];

                if(isset(self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_JPEG][self::$request_salt][$this->system_file_serial]['base64'])){

                    $tmp_BASE64_STATIC_PHP = self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_JPEG][self::$request_salt][$this->system_file_serial]['base64'];

                }

                if(strcmp($tmp_BASE64_LIVE, $tmp_BASE64_STATIC_PHP) !== 0){

                    //error_log(__LINE__ . ' img [' . print_r(self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_JPEG][self::$request_salt], true) . '].');

                    //$this->oCRNRSTN->print_r('DELTA [' . __METHOD__ . '] ERROR! [JPEG] IMAGE_FILE_BASE64[len=' . strlen($tmp_BASE64_LIVE) . '] STATIC_PHP_BASE64[len=' . strlen($tmp_BASE64_STATIC_PHP) . '].', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
                    //$this->oCRNRSTN->print_r('ERR VALUES [' . CRNRSTN_UI_IMG_BASE64_JPEG . '][' . self::$request_salt . '][' . $this->system_file_serial . '][\'base64\'].', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);

                    $this->oCRNRSTN->error_log('System BASE64 asset sync with JPEG file [' . $data_type_constant . '] required.', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);

                    return false;

                }

            break;
            default:

                // case CRNRSTN_UI_IMG_PNG:
                $tmp_BASE64_STATIC_PHP = '';
                $tmp_BASE64_LIVE = self::$image_filesystem_meta_ARRAY[$data_type_constant][self::$request_salt]['base64'];

                if(isset(self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$this->system_file_serial]['base64'])){

                    $tmp_BASE64_STATIC_PHP = self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$this->system_file_serial]['base64'];

                }

                if(strcmp($tmp_BASE64_LIVE, $tmp_BASE64_STATIC_PHP) !== 0){

                    //$this->oCRNRSTN->print_r('DELTA ERROR ON [' . $data_type_constant . ']![PNG] LIVE=[' . $tmp_BASE64_LIVE . '] STATIC_PHP=[' . $tmp_BASE64_STATIC_PHP . '].', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
                    //$this->oCRNRSTN->print_r('ERR VALUES [' . CRNRSTN_UI_IMG_BASE64_JPEG . '][' . self::$request_salt . '][' . $this->system_file_serial . '][\'base64\'].', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);

                    $this->oCRNRSTN->error_log('System BASE64 asset sync with PNG file [' . $data_type_constant . '] required.', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);

                    return false;

                }

            break;

        }

        return true;

    }

    private function system_base64_write(){

        try{

            $tmp_current_perms = '';
            $tmp_data_str_out = $this->return_system_base64_file_contents();

            $mkdir_mode = $this->oCRNRSTN->get_resource('chmod_perms', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');
            $tmp_filepath = self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64][self::$request_salt]['path_filename'];
            $tmp_filename = self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64][self::$request_salt]['filename'];

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
            // WARNINGS WILL BE THROWN @ $oCRNRSTN->max_storage_utilization_warning PERCENTAGE.
            // WRITE REQUESTS WILL BE DENIED @ $oCRNRSTN->max_storage_utilization PERCENTAGE.
            if(!$this->oCRNRSTN->grant_permissions_fwrite($tmp_filepath, $tmp_minimum_bytes_required)){

                //
                // HOOOSTON...VE HAF PROBLEM!
                $this->oCRNRSTN->error_log('DISK WRITE ERROR. Disk space exceeds ' . $this->oCRNRSTN->get_disk_performance_metric('maximum_disk_use') . '% minimum allocation of free space. File write [' . $tmp_filepath . '] stopped. CRNRSTN :: is configured to stop file writes when allocation of free space on disk exceeds specified limits.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY_DISK);

                $this->oCRNRSTN->print_r('DISK WRITE ERROR. Disk space exceeds ' . $this->oCRNRSTN->get_disk_performance_metric('maximum_disk_use') . '% minimum allocation of free space. File write stopped. CRNRSTN :: is configured to stop file writes when allocation of free space on disk exceeds specified limits.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);

                throw new Exception('DISK WRITE ERROR. Disk space exceeds ' . $this->oCRNRSTN->get_disk_performance_metric('maximum_disk_use') . '% minimum allocation of free space. File write [' . $tmp_filepath . '] stopped. CRNRSTN :: is configured to stop file writes when allocation of free space on disk exceeds specified limits.');

            }

            $_SESSION['CRNRSTN_' . $this->oCRNRSTN->get_server_config_serial('hash')]['CRNRSTN_EXCEPTION_PREFIX'] = __CLASS__ . '::' . __METHOD__ . '() attempted to open ' . $tmp_filepath . ', but ';
            if($resource_file = fopen($tmp_filepath, 'w')){

                $_SESSION['CRNRSTN_' . $this->oCRNRSTN->get_server_config_serial('hash')]['CRNRSTN_EXCEPTION_PREFIX'] = '';

                fwrite($resource_file, $tmp_data_str_out);
                fclose($resource_file);

                //
                // TODO :: GET PERMISSIONS FROM SYSTEM DEFAULT.
                // ADJUST FILE PERMISSIONS
                chmod($tmp_filepath, $mkdir_mode);

                $this->oCRNRSTN->error_log('Success. System write of BASE64 file is complete. File: ' . $tmp_filename . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);

            }else{

                //$this->oCRNRSTN->print_r('SYSTEM FILE WRITE...ERROR!! [' . $tmp_filename. '].', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
                $this->oCRNRSTN->error_log('CRNRSTN :: has experienced permissions related error as the target file, ' . $tmp_filepath . ', is NOT writable with current permissions as ' . $tmp_current_perms . '.');
                $this->oCRNRSTN->print_r('CRNRSTN :: has experienced permissions related error as the target file, ' . $tmp_filepath . ', is NOT writable with current permissions as ' . $tmp_current_perms . '.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);

                //
                // ATTEMPT TO CHANGE PERMISSIONS AND CHECK AGAIN
                // BEFORE COMPLETELY GIVING UP
                $this->oCRNRSTN->error_log('Attempting to modify permissions to ' . str_pad($mkdir_mode,'4', '0',STR_PAD_LEFT) . ' for file write at, ' . $tmp_filepath . '. The current permissions, ' . $tmp_current_perms . ', at file for CRNRSTN :: render the file NOT to be writable.');
                $this->oCRNRSTN->print_r('Attempting to modify permissions to ' . str_pad($mkdir_mode,'4', '0',STR_PAD_LEFT) . ' for file write at, ' . $tmp_filepath . '. The current permissions, ' . $tmp_current_perms . ', at file for CRNRSTN :: render the file NOT to be writable.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);

                //$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_crc]['CRNRSTN_EXCEPTION_PREFIX'] = 'CRNRSTN :: has experienced permissions related error as the destination file, ' . $tmp_filepath . ' (' . $tmp_current_perms . '), is NOT writable to ' . str_pad($mkdir_mode,'4', '0',STR_PAD_LEFT) . ', and furthermore ';
                $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_crc]['CRNRSTN_EXCEPTION_PREFIX'] = __CLASS__ . '::' . __METHOD__ . '() attempted to chmod ' . str_pad($mkdir_mode,'4', '0',STR_PAD_LEFT) . ' the write permissions to related to ' . $tmp_filepath . ', currently [' . $tmp_current_perms . '], but ';
                if(chmod($tmp_filepath, $mkdir_mode)){

                    $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_crc]['CRNRSTN_EXCEPTION_PREFIX'] = '';

                    //
                    // ANOTHER ATTEMPT TO WRITE AFTER MODIFICATION OF FILE PERMISSIONS
                    $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_crc]['CRNRSTN_EXCEPTION_PREFIX'] = __CLASS__ . '::' . __METHOD__ . '() attempted to fopen ' . $tmp_filepath . ' after the write permissions to related to same were first chmod to ' . str_pad($mkdir_mode, '4', '0', STR_PAD_LEFT) . '. An attempt to open was again made, but ';
                    if($resource_file = fopen($tmp_filepath, 'w')){

                        $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_crc]['CRNRSTN_EXCEPTION_PREFIX'] = '';

                        fwrite($resource_file, $tmp_data_str_out);
                        fclose($resource_file);

                        //
                        // TODO :: GET PERMISSIONS FROM SYSTEM DEFAULT.
                        // ADJUST FILE PERMISSIONS
                        chmod($tmp_filepath, $mkdir_mode);

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
            $this->oCRNRSTN->print_r($tmp_data_str_out, self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64][self::$request_salt]['filename'] . ' :: BASE64 CHECK.', NULL, __LINE__, __METHOD__, __FILE__);

            return true;

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
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

        $tmp_file_serial = self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64][self::$request_salt]['serial'];

        $tmp_lt = '<';

        //
        // BASE64 FILE HEADER :: July 30, 2022 @ 1908 hrs
        $tmp_file_input_str .= $tmp_lt . '?php
/* 
// J5
// Code is Poetry */
# # C # R # N # R # S # T # N # : : # # ##
#
# CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . '
#
# DATE GENERATED: ' . $this->oCRNRSTN->return_micro_time() . '
# FILE NAME: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64][self::$request_salt]['filename'] . '
# FILE PATH: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64][self::$request_salt]['path_filename'] . '
# FILE SERIAL: ' . $tmp_file_serial . '
#
# SERVER IP: ' . $_SERVER['SERVER_ADDR'] . '
# CLIENT IP: ' . $this->oCRNRSTN->return_client_ip() . ' (' . $_SERVER['REMOTE_ADDR']. ')
# PHPSESSION: ' . session_id(). '
# GENERATING SERVER INFORMATION: ' . $this->oCRNRSTN->proper_version('LINUX') .
            ', ' . $this->oCRNRSTN->proper_version('APACHE') .
            ', ' . $this->oCRNRSTN->proper_version('MYSQLI') .
            ', ' . $this->oCRNRSTN->proper_version('PHP') .
            ', ' . $this->oCRNRSTN->proper_version('OPENSSL') .
            ', ' . $this->oCRNRSTN->proper_version('SOAP') . '
#';

        if(isset(self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['base64']) || isset(self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['arch_1.0_base64'])){

            $has_png = true;
            $tmp_file_input_str .= '
# # # # #
# PNG FILE (ORIGINAL) :: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['filename'] . '
# PNG IMAGE DIMENSIONS: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['image_dimensions'] . '
# PNG FILE EXTENSION: ' . pathinfo(self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['path_filename'], PATHINFO_EXTENSION) . '
# PNG FILE MIME TYPE: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['mime_content_type'] . '
# PNG FILE PATH: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['path_filename'] . '
# PNG FILE SIZE: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['filesize'] . '
# PNG FILE LAST MODIFIED: ' . date("Y-m-d H:i:s", self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['filemtime']) . '
# PNG FILE MD5: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['md5'] . '
# PNG FILE SHA1: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['sha1'] . '
# PNG FILE ENCODED LENGTH (BASE64): ' . $this->oCRNRSTN->number_format_keep_precision(strlen(self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['base64'])) . ' bytes
# PROFILE ACCESS: ANONYMOUS
# ACCESS TYPE: BASIC
#';

        }

        //
        // WE HAVE $base64_encode_png AND $base64_encode_jpg TO CHECK AGAINST THE BASE64 $TMP_STR[] SITUATION
        // THAT YOU SAID YOU'D TAKE CARE OF, REAL QUICK.
        if(isset(self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_JPEG][self::$request_salt]['base64']) || isset(self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_JPEG][self::$request_salt]['arch_1.0_base64'])){

            $has_jpeg = true;
            $tmp_file_input_str .= '
# # # # #
# JPEG FILE (ORIGINAL) :: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_JPEG][self::$request_salt]['filename'] . '
# JPEG IMAGE DIMENSIONS: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_JPEG][self::$request_salt]['image_dimensions'] . '
# JPEG FILE EXTENSION: ' . pathinfo(self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_JPEG][self::$request_salt]['path_filename'], PATHINFO_EXTENSION) . '
# JPEG FILE MIME TYPE: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_JPEG][self::$request_salt]['mime_content_type'] . '
# JPEG FILE PATH: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_JPEG][self::$request_salt]['path_filename'] . '
# JPEG FILE SIZE: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_JPEG][self::$request_salt]['filesize'] . '
# JPEG FILE LAST MODIFIED: ' . date("Y-m-d H:i:s", self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_JPEG][self::$request_salt]['filemtime']) . '
# JPEG FILE MD5: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_JPEG][self::$request_salt]['md5'] . '
# JPEG FILE SHA1: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_JPEG][self::$request_salt]['sha1'] . '
# JPEG FILE ENCODED LENGTH (BASE64): ' . $this->oCRNRSTN->number_format_keep_precision(strlen(self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_JPEG][self::$request_salt]['base64'])) . ' bytes
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

        if(!isset(self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$this->system_file_serial]['datecreated_base64_PNG'])){

            self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$this->system_file_serial]['datecreated_base64_PNG'] = $this->oCRNRSTN->return_micro_time();

        }

        if(!isset(self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_JPEG][self::$request_salt][$this->system_file_serial]['datecreated_base64_JPEG'])){

            self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_JPEG][self::$request_salt][$this->system_file_serial]['datecreated_base64_JPEG'] = $this->oCRNRSTN->return_micro_time();

        }

        if(!isset(self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$this->system_file_serial]['lastmodified_base64_PNG'])){

            self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$this->system_file_serial]['lastmodified_base64_PNG'] = $this->oCRNRSTN->return_micro_time();

        }

        $tmp_val = self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$this->system_file_serial]['lastmodified_base64_PNG'];

        if(!isset($tmp_val) || ($tmp_val == '')){

            //$this->oCRNRSTN->print_r('lastmodified_base64_PNG BEING UPDATED.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
            self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$this->system_file_serial]['lastmodified_base64_PNG'] = $this->oCRNRSTN->return_micro_time();

        }

        if(!isset(self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_JPEG][self::$request_salt][$this->system_file_serial]['lastmodified_base64_JPEG'])){

            self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_JPEG][self::$request_salt][$this->system_file_serial]['lastmodified_base64_JPEG'] = $this->oCRNRSTN->return_micro_time();

        }

        $tmp_val = self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_JPEG][self::$request_salt][$this->system_file_serial]['lastmodified_base64_JPEG'];

        if(!isset($tmp_val) || ($tmp_val == '')){

            //$this->oCRNRSTN->print_r('lastmodified_base64_JPEG BEING UPDATED.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
            self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_JPEG][self::$request_salt][$this->system_file_serial]['lastmodified_base64_JPEG'] = $this->oCRNRSTN->return_micro_time();

        }


        $tmp_file_input_str  .= '/*
' . $tmp_ascii . '*/


$system_file_serial = \'' . $tmp_file_serial . '\';

switch(self::$image_output_mode){
    case CRNRSTN_UI_IMG_BASE64_JPEG:
            
        //
        // BASE64 ENCODE OF JPG';
        if($has_jpeg){

            $tmp_file_input_str .= '
        self::$image_filesystem_meta_ARRAY[self::$image_output_mode][self::$request_salt][$system_file_serial][\'datecreated_base64_JPEG\'] = \'' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_JPEG][self::$request_salt][$this->system_file_serial]['datecreated_base64_JPEG'] . '\';
        self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_JPEG][self::$request_salt][$system_file_serial][\'base64\'] = \'' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_JPEG][self::$request_salt]['base64'] . '\';
';

        }

        $tmp_file_input_str .= '
    break;
    default:
    
        //
        // BASE64 ENCODE OF PNG';
        if($has_png){

            $tmp_file_input_str .= '
        self::$image_filesystem_meta_ARRAY[self::$image_output_mode][self::$request_salt][$system_file_serial][\'datecreated_base64_PNG\'] = \'' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$this->system_file_serial]['datecreated_base64_PNG'] . '\';
        self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$system_file_serial][\'base64\'] = \'' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['base64'] . '\';
';

        }

        $tmp_file_input_str .= '
    break;
    
}

//
// BASE64 LAST MODIFIED
';
        if($has_png){

            $tmp_file_input_str .= 'self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$system_file_serial][\'lastmodified_base64_PNG\'] = \'' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$this->system_file_serial]['lastmodified_base64_PNG'] . '\';';

        }

        if($has_jpeg){

            $tmp_file_input_str .= '
self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_JPEG][self::$request_salt][$system_file_serial][\'lastmodified_base64_JPEG\'] = \'' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_JPEG][self::$request_salt][$this->system_file_serial]['lastmodified_base64_JPEG'] . '\';

';

        }

        $tmp_file_input_str .= '//
// BASE64 HASH/CHECKSUM
';
        if($has_png){

            $tmp_file_input_str .= 'self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$system_file_serial][\'base64_crc\'] = \'' . $this->oCRNRSTN->hash(self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['base64'], 'crc32') . '\';
self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$system_file_serial][\'base64_md5\'] = \'' . $this->oCRNRSTN->hash(self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['base64'], 'md5') . '\';
';

        }

        if($has_jpeg){

            $tmp_file_input_str .= '
self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_JPEG][self::$request_salt][$system_file_serial][\'base64_crc\'] = \'' . $this->oCRNRSTN->hash(self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_JPEG][self::$request_salt]['base64'], 'crc32') . '\';
self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_JPEG][self::$request_salt][$system_file_serial][\'base64_md5\'] = \'' . $this->oCRNRSTN->hash(self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_JPEG][self::$request_salt]['base64'], 'md5') . '\';

';

        }

        $tmp_file_input_str .= '//
// HASHES FOR BASE64 SOURCE PNG FILE
';
        if($has_png){

            $tmp_file_input_str .= 'self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$system_file_serial][\'md5\'] = \'' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['md5'] . '\';';
            $tmp_file_input_str .= '
self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$system_file_serial][\'sha1\'] = \'' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['sha1'] . '\';

';

        }

        $tmp_file_input_str .= '//
// HASHES FOR BASE64 SOURCE JPEG FILE
';
        if($has_jpeg){

            $tmp_file_input_str .= 'self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_JPEG][self::$request_salt][$system_file_serial][\'md5\'] = \'' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_JPEG][self::$request_salt]['md5'] . '\';';
            $tmp_file_input_str .= '
self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_JPEG][self::$request_salt][$system_file_serial][\'sha1\'] = \'' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_JPEG][self::$request_salt]['sha1'] . '\';';

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
        if(is_file(self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64][self::$request_salt]['path_filename'])) {

            self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['arch_1.0_base64'] = '';
            $tmp_curr_output_mode = self::$image_output_mode;

            //
            // MANUALLY CHANGE MODE. A PRIVILEGE OF SYSTEM MAINTENANCE. (THEN PUT IT BACK.)
            self::$image_output_mode = CRNRSTN_UI_IMG_BASE64_PNG;

            //
            // IS BASE64 ACCURATE? [PNG]
            include(self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64][self::$request_salt]['path_filename']);

            self::$image_output_mode = $tmp_curr_output_mode;

            if(isset($system_file_serial)){

                //$this->oCRNRSTN->print_r('GETTING ON THAT NEW BASE64 DATA ARCH.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);

                $this->system_file_serial = $system_file_serial;

//                // HOW BASE64 DATA WANTS TO BE HANDLED
//                if(isset(self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$system_file_serial]['base64'])){
//
//                    $tmp_bpng = self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$system_file_serial]['base64'];
//                    //$this->oCRNRSTN->print_r('BASE64 [PNG] CHECKSUM = [' . print_r($this->oCRNRSTN->crcINT($tmp_bpng), true) . '].', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
//
//                }

            }

            //
            // MANUALLY CHANGE MODE. A PRIVILEGE OF SYSTEM MAINTENANCE. (THEN PUT IT BACK.)
            self::$image_output_mode = CRNRSTN_UI_IMG_BASE64_JPEG;

            //
            // IS BASE64 ACCURATE? [JPEG]
            include(self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64][self::$request_salt]['path_filename']);

            //
            // ...(THEN PUT IT BACK.)
            self::$image_output_mode = $tmp_curr_output_mode;

            if(isset($system_file_serial)){

//                // HOW BASE64 DATA WANTS TO BE HANDLED
//                if(isset(self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_JPEG][self::$request_salt][$system_file_serial]['datecreated_base64_JPEG'])){
//
//                    $tmp_bj = self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_JPEG][self::$request_salt][$system_file_serial]['datecreated_base64_JPEG'];
//                    $this->oCRNRSTN->print_r('BASE64 [JPEG] datecreated_base64 = [' . print_r($tmp_bj, true) . '].', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
//
//                }

            }

            if(isset($tmp_str)){

                //$this->oCRNRSTN->print_r('PROCESSING OLD BASE64 DATA ARCH.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);

                $tmp_base64_content_delta++;
                self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$this->system_file_serial]['base64'] = $tmp_str;
                self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$this->system_file_serial]['base64_crc'] = $this->oCRNRSTN->crcINT($tmp_str);
                self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['arch_1.0_base64'] = $tmp_str;

            }

        }

        //
        // LOAD (ATTEMPT TO) FILE META INTO MEMORY - PNG
        if($this->load_system_asset(CRNRSTN_UI_IMG_PNG)){

            //$this->oCRNRSTN->print_r('SYSTEM LOADED PNG FILE [' . print_r(self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG], true) . '].', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
            //$this->oCRNRSTN->error_log('System load of PNG file to check BASE64 file is complete. File: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['filename'] . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);

            if(!$this->valid_system_asset(CRNRSTN_UI_IMG_PNG, 'SYSTEM_BASE64')){

                if(isset(self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$this->system_file_serial]['lastmodified_base64_PNG'])){

                    //$this->oCRNRSTN->print_r('lastmodified_base64_PNG WILL BE UPDATED.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
                    self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$this->system_file_serial]['lastmodified_base64_PNG'] = '';

                }
                $this->oCRNRSTN->error_log('System BASE64 is NOT in sync with file: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['filename'] . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);
                $tmp_base64_content_delta++;

            }

        }

        //
        // LOAD (ATTEMPT TO) FILE META INTO MEMORY - JPEG
        if($this->load_system_asset(CRNRSTN_UI_IMG_JPEG)){

            //$this->oCRNRSTN->print_r('SYSTEM LOADED JPEG FILE [' . print_r(self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_JPEG], true) . '].', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
            //$this->oCRNRSTN->error_log('System load of JPEG file to check BASE64 file is complete. File: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_JPEG][self::$request_salt]['filename'] . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);

            if(!$this->valid_system_asset(CRNRSTN_UI_IMG_JPEG, 'SYSTEM_BASE64')){

                if(isset(self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_JPEG][self::$request_salt][$this->system_file_serial]['lastmodified_base64_JPEG'])){

                    //$this->oCRNRSTN->print_r('lastmodified_base64_JPEG WILL BE UPDATED.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
                    self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_JPEG][self::$request_salt][$this->system_file_serial]['lastmodified_base64_JPEG'] = '';

                }

                $this->oCRNRSTN->error_log('System BASE64 is NOT in sync with file: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_JPEG][self::$request_salt]['filename'] . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);
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
                $tmp_ARRAY['alt_text'] = $tmp_alt_text;
                $tmp_ARRAY['title_text'] = $tmp_title_text;
                $tmp_ARRAY['link'] = $tmp_link;
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
        /*
        self::$oCRNRSTN_CONFIG_MGR->input_data_value($crnrstn_http_endpoint, 'crnrstn_http_endpoint', 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES', 0, NULL, $env_key);
        self::$oCRNRSTN_CONFIG_MGR->input_data_value($crnrstn_path_dir, 'crnrstn_path_directory', 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES', 0, NULL, $env_key);
        self::$oCRNRSTN_CONFIG_MGR->input_data_value($crnrstn_system_directory, 'crnrstn_system_directory', 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES', 0, NULL, $env_key);

        */

        $tmp_path_directory = $this->oCRNRSTN->get_resource('crnrstn_path_directory', 0, 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES');
        $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES');

        //
        // SYSTEM IMAGES DIRECTORIES
        self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['dir'][] = $tmp_path_directory . '/' . $tmp_system_directory . '/ui/imgs/png/system/';
        self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['dir'][] = $tmp_path_directory . '/' . $tmp_system_directory . '/ui/imgs/png/social/';
        self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_JPEG][self::$request_salt]['dir'][] = $tmp_path_directory . '/' . $tmp_system_directory . '/ui/imgs/jpg/system/';
        self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_JPEG][self::$request_salt]['dir'][] = $tmp_path_directory . '/' . $tmp_system_directory . '/ui/imgs/jpg/social/';
        self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64][self::$request_salt]['dir'][] = $tmp_path_directory . '/' . $tmp_system_directory . '/ui/imgs/base64/system/';
        self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64][self::$request_salt]['dir'][] = $tmp_path_directory . '/' . $tmp_system_directory . '/ui/imgs/base64/social/';

        for($i = 0; $i < 2; $i++){

            $tmp_dir_PNG = self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['dir'][$i];
            $tmp_dir_JPEG = self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_JPEG][self::$request_salt]['dir'][$i];
            $tmp_dir_BASE64 = self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64][self::$request_salt]['dir'][$i];

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

                                self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['filename'] = $img_name . '.' . $tmp_file_extension_clean;
                                self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['path_filename'] = $tmp_dir_PNG . $img_name . '.' . $tmp_file_extension_clean;
                                self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['image_dimensions'] = '';
                                self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64][self::$request_salt]['filename'] = $img_name . '.php';
                                self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64][self::$request_salt]['path_filename'] = $tmp_dir_BASE64 . $img_name . '.php';
                                self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64][self::$request_salt]['serial'] = $tmp_file_serial;

                                //
                                // PNG IS VALID. IS THERE A MATCHING JPG?
                                if($this->oCRNRSTN->validate_DIR_endpoint($tmp_dir_JPEG, 'SOURCE')) {

                                    //
                                    // DO WE HAVE A VALID FILE?
                                    if(is_file($tmp_dir_JPEG . $img_name . '.jpg')){

                                        self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_JPEG][self::$request_salt]['filename'] = $img_name . '.jpg';
                                        self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_JPEG][self::$request_salt]['path_filename'] = $tmp_dir_JPEG . $img_name . '.jpg';
                                        self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['image_dimensions'] = '';

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

                                self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_JPEG][self::$request_salt]['filename'] = $img_name . '.' . $tmp_file_extension_clean;
                                self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_JPEG][self::$request_salt]['path_filename'] = $tmp_dir_JPEG . $img_name . '.' . $tmp_file_extension_clean;
                                self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['image_dimensions'] = '';
                                self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64][self::$request_salt]['filename'] = $img_name . '.php';
                                self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64][self::$request_salt]['path_filename'] = $tmp_dir_BASE64 . $img_name . '.php';
                                self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64][self::$request_salt]['serial'] = $tmp_file_serial;

                                //
                                // JPEG IS VALID. IS THERE A MATCHING PNG?
                                if($this->oCRNRSTN->validate_DIR_endpoint($tmp_dir_PNG, 'SOURCE')) {

                                    //
                                    // DO WE HAVE A VALID FILE?
                                    if(is_file($tmp_dir_PNG . $img_name . '.png')){

                                        self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['filename'] = $img_name . '.png';
                                        self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['path_filename'] = $tmp_dir_PNG . $img_name . '.png';
                                        self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['image_dimensions'] = '';

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

    public function __destruct() {

    }

}