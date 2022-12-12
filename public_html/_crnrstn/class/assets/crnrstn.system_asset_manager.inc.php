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

    protected $default_asset_mode;
    protected $asset_request_data_key;
    protected $asset_meta_path;
    protected $asset_request_asset_family;
    protected $asset_response_method_key;
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

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN);

        /*
        //
        // SOURCE :: https://www.php.net/manual/en/function.readfile
        // AUTHOR :: daren -remove-me- schwenke :: https://www.php.net/manual/en/function.readfile.php#103837
        If you are lucky enough to not be on shared hosting and have apache, look at installing mod_xsendfile.
        This was the only way I found to both protect and transfer very large files with PHP (gigabytes).
        It's also proved to be much faster for basically any file.
        Available directives have changed since the other note on this and XSendFileAllowAbove was replaced
        with XSendFilePath to allow more control over access to files outside of webroot.

        Download the source.

        Install with: apxs -cia mod_xsendfile.c

        Add the appropriate configuration directives to your .htaccess or httpd.conf files:
        # Turn it on
        XSendFile on
        # Whitelist a target directory.
        XSendFilePath /tmp/blah

        Then to use it in your script:
        <?php
        $file = '/tmp/blah/foo.iso';
        $download_name = basename($file);
        if (file_exists($file)) {
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.$download_name);
            header('X-Sendfile: '.$file);
            exit;
        }

        ?>

        */

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

                                        $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
    <script src="' . $resource_ARRAY['system_http_root'][0] . '?' . $this->oCRNRSTN->session_salt() . '=' . $resource_ARRAY['file_name'][0] . '&crnrstn_=' . $resource_ARRAY['cache'][0] . '"></script>
';

                                    }else{

                                        $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
    <script src="' .  $resource_ARRAY['system_http_root'][0] . $resource_ARRAY['system_directory'][0] . DIRECTORY_SEPARATOR . 'ui/js' . $resource_ARRAY['file_path_original'][0] . '?crnrstn_=' . $resource_ARRAY['cache'][0] . '"></script>
';

                                    }

                                }else{

                                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_ASSET_MAPPING)){

                                        $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
    <script src="' . $resource_ARRAY['system_http_root'][0] . '?' . $this->oCRNRSTN->session_salt() . '=' . $resource_ARRAY['file_name'][0] . '&crnrstn_=' . $resource_ARRAY['cache'][0] . '"></script>
';

                                        //error_log(__LINE__ . ' asset mgr file_extension[' . $resource_ARRAY['file_extension'][0] . '].');

                                    }else{

                                        $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
    <script src="' .  $resource_ARRAY['system_http_root'][0] . $resource_ARRAY['system_directory'][0] . DIRECTORY_SEPARATOR . 'ui/js' . $resource_ARRAY['file_path_original'][0] . '?crnrstn_=' . $resource_ARRAY['cache'][0] . '"></script>
';

                                        //error_log(__LINE__ . ' asset mgr file_extension[' . $resource_ARRAY['file_extension'][0] . '].');

                                    }

                                }

                            }else{

                                if($this->oCRNRSTN->is_bit_set(CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS)){

                                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_CSS_ASSET_MAPPING)){

                                        $tmp_str .= '    
    <link rel="stylesheet" href="' . $resource_ARRAY['system_http_root'][0] . '?' . $this->oCRNRSTN->session_salt() . '=' . $resource_ARRAY['file_name'][0] . '&crnrstn_=' . $resource_ARRAY['cache'][0] . '">
';

                                    }else{

                                        $tmp_str .= '    
    <link rel="stylesheet" href="' .  $resource_ARRAY['system_http_root'][0] . $resource_ARRAY['system_directory'][0] . DIRECTORY_SEPARATOR . 'ui/css' . $resource_ARRAY['file_path_original'][0] . '?crnrstn_=' . $resource_ARRAY['cache'][0] . '">
';

                                    }

                                }else{

                                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_CSS_ASSET_MAPPING)){

                                        $tmp_str .= '  
    <link rel="stylesheet" href="' . $resource_ARRAY['system_http_root'][0] . '?' . $this->oCRNRSTN->session_salt() . '=' . $resource_ARRAY['file_name'][0] . '&crnrstn_=' . $resource_ARRAY['cache'][0] . '">
';
                                        //error_log(__LINE__ . ' asset mgr file_extension[' . $resource_ARRAY['file_extension'][0] . '].');

                                    }else{

                                        $tmp_str .= '
    <link rel="stylesheet" href="' .  $resource_ARRAY['system_http_root'][0] . $resource_ARRAY['system_directory'][0] . DIRECTORY_SEPARATOR . 'ui/css' . $resource_ARRAY['file_path_original'][0] . '?crnrstn_=' . $resource_ARRAY['cache'][0] . '">
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

                                        $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
    <link rel="stylesheet" href="' . $resource_ARRAY['system_http_root'][0] . '?' . $this->oCRNRSTN->session_salt() . '=' . $resource_ARRAY['file_name'][0] . '&crnrstn_=' . $resource_ARRAY['cache'][0] . '">
';

                                    }else{

                                        $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
    <link rel="stylesheet" href="' .  $resource_ARRAY['system_http_root'][0] . $resource_ARRAY['system_directory'][0] . DIRECTORY_SEPARATOR . 'ui/js' . $resource_ARRAY['file_path_original'][0] . '?crnrstn_=' . $resource_ARRAY['cache'][0] . '">
';

                                    }

                                }else{

                                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_ASSET_MAPPING)){

                                        $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
    <link rel="stylesheet" href="' . $resource_ARRAY['system_http_root'][0] . '?' . $this->oCRNRSTN->session_salt() . '=' . $resource_ARRAY['file_name'][0] . '&crnrstn_=' . $resource_ARRAY['cache'][0] . '">
';
                                        //error_log(__LINE__ . ' asset mgr file_extension[' . $resource_ARRAY['file_extension'][0] . '].');

                                    }else{

                                        $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
    <link rel="stylesheet" href="' .  $resource_ARRAY['system_http_root'][0] . $resource_ARRAY['system_directory'][0] . DIRECTORY_SEPARATOR . 'ui/js' . $resource_ARRAY['file_path_original'][0] . '?crnrstn_=' . $resource_ARRAY['cache'][0] . '">
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

                                        $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
    <script src="' . $resource_ARRAY['system_http_root'][0] . '?' . $this->oCRNRSTN->session_salt() . '=' . $resource_ARRAY['file_name'][0] . '&crnrstn_=' . $resource_ARRAY['cache'][0] . '"></script>
';

                                    }else{

                                        $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
    <script src="' .  $resource_ARRAY['system_http_root'][0] . $resource_ARRAY['system_directory'][0] . DIRECTORY_SEPARATOR . 'ui/js' . $resource_ARRAY['file_path_original'][0] . '?crnrstn_=' . $resource_ARRAY['cache'][0] . '"></script>
';

                                    }

                                }else{

                                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_ASSET_MAPPING)){

                                        $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
    <script src="' . $resource_ARRAY['system_http_root'][0] . '?' . $this->oCRNRSTN->session_salt() . '=' . $resource_ARRAY['file_name'][0] . '&crnrstn_=' . $resource_ARRAY['cache'][0] . '"></script>
';
                                        //error_log(__LINE__ . ' asset mgr file_extension[' . $resource_ARRAY['file_extension'][0] . '].');

                                    }else{

                                        $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
    <script src="' .  $resource_ARRAY['system_http_root'][0] . $resource_ARRAY['system_directory'][0] . DIRECTORY_SEPARATOR . 'ui/js' . $resource_ARRAY['file_path_original'][0] . '?crnrstn_=' . $resource_ARRAY['cache'][0] . '"></script>
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

                                $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
<script> //<!--
' . file_get_contents($resource_ARRAY['file_path'][0]) . '
// --> 
</script>
';
                                //error_log(__LINE__ . ' asset mgr file_extension[' . $resource_ARRAY['file_extension'][0] . '].');

                            }else{

                                $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
<style>
' . file_get_contents($resource_ARRAY['file_path'][0]) . '
</style>
';
                                //error_log(__LINE__ . ' asset mgr file_extension[' . $resource_ARRAY['file_extension'][0] . '].');

                            }

                        break;
                        case CRNRSTN_UI_JS & CRNRSTN_ASSET_MODE_BASE64:

                            //
                            // IS THIS CSS?
                            if($resource_ARRAY['file_extension'][0] === 'css'){

                                $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
<style>
' . file_get_contents($resource_ARRAY['file_path'][0]) . '
</style>
';
                                //error_log(__LINE__ . ' asset mgr file_extension[' . $resource_ARRAY['file_extension'][0] . '].');

                            }else{

                                $tmp_str .= '    <!-- ' . $resource_ARRAY['resource_version_nom'][0] . ' -->
<script> //<!--
' . file_get_contents($resource_ARRAY['file_path'][0]) . '
// --> 
</script>
';
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

    private function spool_resource($resource_constant, $file_path, $file_name, $file_type_constant, $file_is_minimized = true, $asset_minimization_mode_is_active = true, $resource_dependency_constant = NULL, $spool_asset_for_footer_html = false){

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

                    $tmp_dependency_str .= ' [in support of ' . $tmp_resource_support_meta_ARRAY['TITLE'];

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

        //
        // IS THIS A NEW FILE?
        $tmp_resource_hash = $tmp_file_path_hash . $tmp_file_name_hash;
        $tmp_ARRAY[$tmp_resource_hash]['resource_version_nom'][] = $tmp_resource_meta_ARRAY['TITLE'] . ' v' . $tmp_resource_meta_ARRAY['VERSION'] . ' :: ' . $tmp_str_file_type_nom . $tmp_dependency_str;
        $tmp_ARRAY[$tmp_resource_hash]['system_path_directory'][] = $tmp_path_directory;
        $tmp_ARRAY[$tmp_resource_hash]['asset_mapping_dir_path'][] = $tmp_asset_mapping_dir_path;
        $tmp_ARRAY[$tmp_resource_hash]['system_http_root'][] = $tmp_http_root;
        $tmp_ARRAY[$tmp_resource_hash]['system_directory'][] = $tmp_system_directory;
        $tmp_ARRAY[$tmp_resource_hash]['resource_constant'][] = $resource_constant;
        $tmp_ARRAY[$tmp_resource_hash]['file_type_constant'][] = $file_type_constant;
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

    private function return_output_CRNRSTN_UI_JS($const, $footer_html_output, $is_dev_mode){

        try{

            $tmp_str = '';
            $tmp_start_str = '';
            $asset_mode_ARRAY = $this->oCRNRSTN->return_set_bits($this->oCRNRSTN->system_output_profile_constants);

            $tmp_str_array = array();

            switch($asset_mode_ARRAY[0]){
                case CRNRSTN_ASSET_MODE_PNG:
                case CRNRSTN_ASSET_MODE_JPEG:
                case CRNRSTN_ASSET_MODE_BASE64:

                    // # # # # # # # # # # # # # # # # # # # # # # # # # #
                    $tmp_start_str = '
    <!-- BEGIN CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' JS + CSS MODULE OUTPUT :: ' . $this->oCRNRSTN->return_micro_time() . ' -->
';

                    switch ($const){
                        case CRNRSTN_JS_FRAMEWORK_JQUERY:

                            $tmp_file_type_const = CRNRSTN_UI_JS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_JS & CRNRSTN_ASSET_MODE_BASE64;

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery/3.6.1/jquery-3.6.1.min.js';
                            $tmp_file_name = 'jquery-3.6.1.min.js';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery/3.6.1/jquery-3.6.1.js';
                            $tmp_file_name = 'jquery-3.6.1.js';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery/3.6.1/jquery-3.6.1.min.map';
                            $tmp_file_name = 'jquery-3.6.1.min.map';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                            $tmp_file_path = '/_lib/frameworks/jquery/2.2.4/jquery-2.2.4.min.js';
                            $tmp_file_name = 'jquery-2.2.4.min.js';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery/3.6.1/jquery-3.6.1.min.map';
                            $tmp_file_name = 'jquery-3.6.1.min.map';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery/2.2.4/jquery-2.2.4.js';
                            $tmp_file_name = 'jquery-2.2.4.js';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                            $tmp_file_path = '/_lib/frameworks/jquery/1.12.4/jquery-1.12.4.min.js';
                            $tmp_file_name = 'jquery-1.12.4.min.js';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery/1.12.4/jquery-1.12.4.js';
                            $tmp_file_name = 'jquery-1.12.4.js';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                            $tmp_file_path = '/_lib/frameworks/jquery/1.11.1/jquery-1.11.1.min.js';
                            $tmp_file_name = 'jquery-1.11.1.min.js';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.13.2/jquery-ui-1.13.2/jquery-ui.theme.min.css';
                            $tmp_file_name = 'jquery-ui-1.13.2/jquery-ui.theme.min.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.13.2/jquery-ui-1.13.2/jquery-ui.structure.min.css';
                            $tmp_file_name = 'jquery-ui-1.13.2/jquery-ui.structure.min.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.13.2/jquery-ui-1.13.2/jquery-ui.min.css';
                            $tmp_file_name = 'jquery-ui-1.13.2/jquery-ui.min.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.13.2/jquery-ui-1.13.2/jquery-ui.theme.css';
                            $tmp_file_name = 'jquery-ui-1.13.2/jquery-ui.theme.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.13.2/jquery-ui-1.13.2/jquery-ui.structure.css';
                            $tmp_file_name = 'jquery-ui-1.13.2/jquery-ui.structure.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.13.2/jquery-ui-1.13.2/jquery-ui.css';
                            $tmp_file_name = 'jquery-ui-1.13.2/jquery-ui.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            //
                            // CHECK FOR PREVIOUS LOAD OF JQUERY
                            if(!isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_1_12_4])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_2_2_4])
                                && !isset($this->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_PLUS_JQUERY])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY])){

                                /////
                                // R :: RESOURCE //
                                $tmp_file_path = '/_lib/frameworks/jquery/3.6.1/jquery-3.6.1.min.js';
                                $tmp_file_name = 'jquery-3.6.1.min.js';
                                $tmp_file_is_minimized = true;
                                $tmp_asset_minimization_mode_is_active = true;
                                $tmp_resource_dependency_constant = $const;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                                /////
                                // R :: RESOURCE //
                                $tmp_file_path = '/_lib/frameworks/jquery/3.6.1/jquery-3.6.1.js';
                                $tmp_file_name = 'jquery-3.6.1.js';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = true;
                                $tmp_resource_dependency_constant = $const;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                                $tmp_str .= $this->return_mapped_resources(CRNRSTN_JS_FRAMEWORK_JQUERY, $footer_html_output);
                                /*//////////
                                //////////

                                */

                            }

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.13.2/jquery-ui-1.13.2/jquery-ui.min.js';
                            $tmp_file_name = 'jquery-ui-1.13.2/jquery-ui.min.js';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.13.2/jquery-ui-1.13.2/jquery-ui.js';
                            $tmp_file_name = 'jquery-ui-1.13.2/jquery-ui.js';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            if($footer_html_output) $tmp_spool_asset_for_footer_html = $footer_html_output;
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
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.12.1/jquery-ui-1.12.1/jquery-ui.theme.min.css';
                            $tmp_file_name = 'jquery-ui-1.12.1/jquery-ui.theme.min.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.12.1/jquery-ui-1.12.1/jquery-ui.structure.min.css';
                            $tmp_file_name = 'jquery-ui-1.12.1/jquery-ui.structure.min.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.12.1/jquery-ui-1.12.1/jquery-ui.min.css';
                            $tmp_file_name = 'jquery-ui-1.12.1/jquery-ui.min.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.12.1/jquery-ui-1.12.1/jquery-ui.theme.css';
                            $tmp_file_name = 'jquery-ui-1.12.1/jquery-ui.theme.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.12.1/jquery-ui-1.12.1/jquery-ui.structure.css';
                            $tmp_file_name = 'jquery-ui-1.12.1/jquery-ui.structure.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.12.1/jquery-ui-1.12.1/jquery-ui.css';
                            $tmp_file_name = 'jquery-ui-1.12.1/jquery-ui.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                                $tmp_file_path = '/_lib/frameworks/jquery/3.6.1/jquery-3.6.1.min.js';
                                $tmp_file_name = 'jquery-3.6.1.min.js';
                                $tmp_file_is_minimized = true;
                                $tmp_asset_minimization_mode_is_active = true;
                                $tmp_resource_dependency_constant = $const;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                                /////
                                // R :: RESOURCE //
                                $tmp_file_path = '/_lib/frameworks/jquery/3.6.1/jquery-3.6.1.js';
                                $tmp_file_name = 'jquery-3.6.1.js';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = true;
                                $tmp_resource_dependency_constant = $const;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                                $tmp_str .= $this->return_mapped_resources(CRNRSTN_JS_FRAMEWORK_JQUERY, $footer_html_output);
                                /*//////////
                                //////////

                                */

                            }

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.12.1/jquery-ui-1.12.1/jquery-ui.min.js';
                            $tmp_file_name = '1.12.1/jquery-ui-1.12.1/jquery-ui.min.js';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.12.1/jquery-ui-1.12.1/jquery-ui.js';
                            $tmp_file_name = 'jquery-ui-1.12.1/jquery-ui.js';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                            $tmp_file_path = '/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile.external-png-1.4.5.min.css';
                            $tmp_file_name = 'jquery.mobile.external-png-1.4.5.min.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile.icons-1.4.5.min.css';
                            $tmp_file_name = 'jquery.mobile.icons-1.4.5.min.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile.inline-png-1.4.5.min.css';
                            $tmp_file_name = 'jquery.mobile.inline-png-1.4.5.min.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile.inline-svg-1.4.5.min.css';
                            $tmp_file_name = 'jquery.mobile.inline-svg-1.4.5.min.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile.structure-1.4.5.min.css';
                            $tmp_file_name = 'jquery.mobile.structure-1.4.5.min.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile.theme-1.4.5.min.css';
                            $tmp_file_name = 'jquery.mobile.theme-1.4.5.min.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.css';
                            $tmp_file_name = 'jquery.mobile-1.4.5.min.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile.external-png-1.4.5.css';
                            $tmp_file_name = 'jquery.mobile.external-png-1.4.5.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile.icons-1.4.5.css';
                            $tmp_file_name = 'jquery.mobile.icons-1.4.5.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile.inline-png-1.4.5.css';
                            $tmp_file_name = 'jquery.mobile.inline-png-1.4.5.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile.inline-svg-1.4.5.css';
                            $tmp_file_name = 'jquery.mobile.inline-svg-1.4.5.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile.structure-1.4.5.css';
                            $tmp_file_name = 'jquery.mobile.structure-1.4.5.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile.theme-1.4.5.css';
                            $tmp_file_name = 'jquery.mobile.theme-1.4.5.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile-1.4.5.css';
                            $tmp_file_name = 'jquery.mobile-1.4.5.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                                $tmp_file_path = '/_lib/frameworks/jquery/1.11.1/jquery-1.11.1.min.js';
                                $tmp_file_name = 'jquery-1.11.1.min.js';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = false;
                                $tmp_resource_dependency_constant = $const;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                                $tmp_str .= $this->return_mapped_resources(CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1, $footer_html_output);
                                /*//////////
                                //////////

                                */

                            }

                            //
                            // CHECK FOR LOAD OF CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1, CRNRSTN_JS_FRAMEWORK_JQUERY_2_2_4, CRNRSTN_JS_FRAMEWORK_JQUERY
                            if(!isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_1_12_4])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY_2_2_4])
                                && !isset($this->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_PLUS_JQUERY])
                                && !isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_JQUERY])){

                                /////
                                // R :: RESOURCE //
                                $tmp_file_path = '/_lib/frameworks/jquery/1.11.1/jquery-1.11.1.min.js';
                                $tmp_file_name = 'jquery-1.11.1.min.js';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = false;
                                $tmp_resource_dependency_constant = $const;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                                $tmp_str .= $this->return_mapped_resources(CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1, $footer_html_output);
                                /*//////////
                                //////////

                                */

                            }

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/index.js';
                            $tmp_file_name = 'jquery.mobile-1.4.5/index.js';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js';
                            $tmp_file_name = 'jquery.mobile-1.4.5.min.js';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile-1.4.5.js';
                            $tmp_file_name = 'jquery.mobile-1.4.5.js';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                            $tmp_file_path = '/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/css/lightbox.min.css';
                            $tmp_file_name = 'lightbox-2.11.3/css/lightbox.min.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/css/lightbox.css';
                            $tmp_file_name = 'lightbox-2.11.3/css/lightbox.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                                $tmp_file_path = '/_lib/frameworks/jquery/3.6.1/jquery-3.6.1.min.js';
                                $tmp_file_name = 'jquery-3.6.1.min.js';
                                $tmp_file_is_minimized = true;
                                $tmp_asset_minimization_mode_is_active = true;
                                $tmp_resource_dependency_constant = $const;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                                /////
                                // R :: RESOURCE //
                                $tmp_file_path = '/_lib/frameworks/jquery/3.6.1/jquery-3.6.1.js';
                                $tmp_file_name = 'jquery-3.6.1.js';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = true;
                                $tmp_resource_dependency_constant = $const;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                                $tmp_str .= $this->return_mapped_resources(CRNRSTN_JS_FRAMEWORK_JQUERY, $footer_html_output);
                                /*//////////
                                //////////

                                */

                            }

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/js/lightbox.min.js';
                            $tmp_file_name = 'lightbox-2.11.3/js/lightbox.min.js';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/js/lightbox.js';
                            $tmp_file_name = 'lightbox-2.11.3/js/lightbox.js';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                            $tmp_file_path = '/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/css/lightbox.min.css';
                            $tmp_file_name = 'lightbox-2.11.3/css/lightbox.min.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/css/lightbox.css';
                            $tmp_file_name = 'lightbox-2.11.3/css/lightbox.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/js/lightbox-plus-jquery.min.js';
                            $tmp_file_name = 'lightbox-2.11.3/js/lightbox-plus-jquery.min.js';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/js/lightbox-plus-jquery.js';
                            $tmp_file_name = 'lightbox-2.11.3/js/lightbox-plus-jquery.js';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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

                                    $tmp_str .= '    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' :: js -->
    <script>
    ' . file_get_contents('https://unpkg.com/react@18.2.0/umd/react.production.min.js') . '
    </script>
';

                                }else{

                                    $tmp_str .= '    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' :: js -->
    <script src="https://unpkg.com/react@18.2.0/umd/react.production.min.js" crossorigin></script>
';

                                }

                            }else{

                                if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64){

                                    $tmp_str .= '    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' :: js -->
    <script>
    ' . file_get_contents('https://unpkg.com/react@18.2.0/umd/react.development.js') . '
    </script>
';
                                }else{

                                    $tmp_str .= '    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' :: js -->
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

                                    $tmp_str .= '    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' :: js -->
    <script>
    ' . file_get_contents('https://unpkg.com/react@18.2.0/umd/react.production.min.js') . '
    </script>
    
    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' :: js -->
    <script>
    ' . file_get_contents('https://unpkg.com/react-dom@18.2.0/umd/react-dom.production.min.js') . '
    </script>
';

                                }else{

                                    $tmp_str .= '    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' :: js -->
    <script src="https://unpkg.com/react@18.2.0/umd/react.production.min.js" crossorigin></script>
    <script src="https://unpkg.com/react-dom@18.2.0/umd/react-dom.production.min.js" crossorigin></script>
';

                                }

                            }else{

                                if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64){

                                    $tmp_str .= '    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' :: js -->
    <script>
    ' . file_get_contents('https://unpkg.com/react@18.2.0/umd/react.development.js') . '
    </script>
    
    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' :: js -->
    <script>
    ' . file_get_contents('https://unpkg.com/react-dom@18.2.0/umd/react-dom.development.js') . '
    </script>
';

                                }else{

                                    $tmp_str .= '    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' :: js -->
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

                                    $tmp_str .= '    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' :: js -->
    <script>
    ' . file_get_contents('https://cdn.jsdelivr.net/npm/mithril/mithril.min.js') . '
    </script>
';
                                }else{

                                    $tmp_str .= '    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' :: js -->
                                <script src="https://cdn.jsdelivr.net/npm/mithril/mithril.min.js" crossorigin></script>
';

                                }

                            }else{

                                if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64){

                                    $tmp_str .= '    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' :: js -->
    <script>
    ' . file_get_contents('https://unpkg.com/mithril/mithril.js') . '
    </script>
';

                                }else{

                                    $tmp_str .= '    <!-- ' . $tmp_ARRAY['TITLE'] . ' ' . $tmp_ARRAY['VERSION'] . ' :: js -->
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
                            $tmp_file_path = '/_lib/frameworks/backbone/1.4.1/backbone-min.js';
                            $tmp_file_name = '1.4.1/backbone-min.js';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/backbone/1.4.1/backbone.js';
                            $tmp_file_name = '1.4.1/backbone.js';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                            $tmp_file_path = '/_lib/frameworks/prototype.js/1.7.3/prototype.js';
                            $tmp_file_name = 'prototype.js';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                                $tmp_file_path = '/_lib/frameworks/prototype.js/1.7.3/prototype.js';
                                $tmp_file_name = 'prototype.js';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = false;
                                $tmp_resource_dependency_constant = $const;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource(CRNRSTN_JS_FRAMEWORK_PROTOTYPE, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                                $tmp_str .= $this->return_mapped_resources(CRNRSTN_JS_FRAMEWORK_PROTOTYPE, $footer_html_output);
                                /*//////////
                                //////////

                                */

                            }

                            if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_ASSET_MAPPING)){

                                /////
                                // R :: RESOURCE //
                                $tmp_file_path = '/_lib/frameworks/script.aculo.us/1.9.0/src/scriptaculous.js';
                                $tmp_file_name = 'scriptaculous.js';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = false;
                                $tmp_resource_dependency_constant = NULL;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                                /////
                                // R :: RESOURCE //
                                $tmp_file_path = '/_lib/frameworks/script.aculo.us/1.9.0/src/builder.js';
                                $tmp_file_name = 'builder.js';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = false;
                                $tmp_resource_dependency_constant = NULL;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                                /////
                                // R :: RESOURCE //
                                $tmp_file_path = '/_lib/frameworks/script.aculo.us/1.9.0/src/controls.js';
                                $tmp_file_name = 'controls.js';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = false;
                                $tmp_resource_dependency_constant = NULL;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                                /////
                                // R :: RESOURCE //
                                $tmp_file_path = '/_lib/frameworks/script.aculo.us/1.9.0/src/dragdrop.js';
                                $tmp_file_name = 'dragdrop.js';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = false;
                                $tmp_resource_dependency_constant = NULL;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                                /////
                                // R :: RESOURCE //
                                $tmp_file_path = '/_lib/frameworks/script.aculo.us/1.9.0/src/effects.js';
                                $tmp_file_name = 'effects.js';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = false;
                                $tmp_resource_dependency_constant = NULL;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                                /////
                                // R :: RESOURCE //
                                $tmp_file_path = '/_lib/frameworks/script.aculo.us/1.9.0/src/slider.js';
                                $tmp_file_name = 'slider.js';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = false;
                                $tmp_resource_dependency_constant = NULL;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                                /////
                                // R :: RESOURCE //
                                $tmp_file_path = '/_lib/frameworks/script.aculo.us/1.9.0/src/sound.js';
                                $tmp_file_name = 'sound.js';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = false;
                                $tmp_resource_dependency_constant = NULL;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                                $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                                /*//////////
                                //////////

                                */

                            }else{

                                /////
                                // R :: RESOURCE //
                                $tmp_file_path = '/_lib/frameworks/script.aculo.us/1.9.0/src/scriptaculous.js';
                                $tmp_file_name = 'scriptaculous.js';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = false;
                                $tmp_resource_dependency_constant = NULL;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                                $tmp_file_path = '/_lib/frameworks/prototype.js/1.7.3/prototype.js';
                                $tmp_file_name = 'prototype.js';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = false;
                                $tmp_resource_dependency_constant = $const;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource(CRNRSTN_JS_FRAMEWORK_PROTOTYPE, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                                $tmp_str .= $this->return_mapped_resources(CRNRSTN_JS_FRAMEWORK_PROTOTYPE, $footer_html_output);
                                /*//////////
                                //////////

                                */

                            }

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/moo.fx/2.0/source/moo.fx.js';
                            $tmp_file_name = 'moo.fx.js';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/moo.fx/2.0/source/moo.fx.pack.js';
                            $tmp_file_name = 'moo.fx.pack.js';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/moo.fx/2.0/source/moo.fx.utils.js';
                            $tmp_file_name = 'moo.fx.utils.js';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/moo.fx/2.0/source/moo.fx.accordion.js';
                            $tmp_file_name = 'moo.fx.accordion.js';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/moo.fx/2.0/source/moo.fx.transitions.js';
                            $tmp_file_name = 'moo.fx.transitions.js';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                            $tmp_file_path = '/_lib/frameworks/lightbox.js/2.03.3/css/lightbox.css';
                            $tmp_file_name = '2.03.3/css/lightbox.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                            //
                            // CHECK FOR LOAD OF CRNRSTN_JS_FRAMEWORK_PROTOTYPE
                            if(!isset($this->oCRNRSTN->html_head_build_flag_ARRAY[CRNRSTN_JS_FRAMEWORK_PROTOTYPE])){

                                /////
                                // R :: RESOURCE //
                                $tmp_file_path = '/_lib/frameworks/prototype.js/1.7.3/prototype.js';
                                $tmp_file_name = 'prototype.js';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = false;
                                $tmp_resource_dependency_constant = $const;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource(CRNRSTN_JS_FRAMEWORK_PROTOTYPE, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                                $tmp_str .= $this->return_mapped_resources(CRNRSTN_JS_FRAMEWORK_PROTOTYPE, $footer_html_output);
                                /*//////////
                                //////////

                                */

                            }

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/lightbox.js/2.03.3/js/lightbox.js';
                            $tmp_file_name = '2.03.3/js/lightbox.js';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                            $tmp_file_path = '/_lib/frameworks/mootools/more/1.6.0/mootools-more-1.6.0-min.js';
                            $tmp_file_name = 'mootools-more-1.6.0-min.js';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/mootools/more/1.6.0/mootools-more-1.6.0.js';
                            $tmp_file_name = 'mootools-more-1.6.0.js';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                            $tmp_file_path = '/_lib/frameworks/mootools/core/1.6.0/mootools-core-1.6.0-min.js';
                            $tmp_file_name = 'mootools-core-1.6.0-min.js';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/mootools/core/1.6.0/mootools-core-1.6.0.js';
                            $tmp_file_name = 'mootools-core-1.6.0.js';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                            $tmp_file_path = '/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/css/lightbox.min.css';
                            $tmp_file_name = 'lightbox-2.11.3/css/lightbox.min.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource(CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/css/lightbox.css';
                            $tmp_file_name = 'lightbox-2.11.3/css/lightbox.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource(CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                                $tmp_file_path = '/_lib/frameworks/jquery/3.6.1/jquery-3.6.1.min.js';
                                $tmp_file_name = 'jquery-3.6.1.min.js';
                                $tmp_file_is_minimized = true;
                                $tmp_asset_minimization_mode_is_active = true;
                                $tmp_resource_dependency_constant = $const;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                                /////
                                // R :: RESOURCE //
                                $tmp_file_path = '/_lib/frameworks/jquery/3.6.1/jquery-3.6.1.js';
                                $tmp_file_name = 'jquery-3.6.1.js';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = true;
                                $tmp_resource_dependency_constant = $const;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                                $tmp_str .= $this->return_mapped_resources(CRNRSTN_JS_FRAMEWORK_JQUERY, $footer_html_output);
                                /*//////////
                                //////////

                                */

                            }

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.13.2/jquery-ui-1.13.2/jquery-ui.theme.min.css';
                            $tmp_file_name = 'jquery-ui-1.13.2/jquery-ui.theme.min.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY_UI, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.13.2/jquery-ui-1.13.2/jquery-ui.structure.min.css';
                            $tmp_file_name = 'jquery-ui-1.13.2/jquery-ui.structure.min.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY_UI, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.13.2/jquery-ui-1.13.2/jquery-ui.min.css';
                            $tmp_file_name = 'jquery-ui-1.13.2/jquery-ui.min.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY_UI, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.13.2/jquery-ui-1.13.2/jquery-ui.theme.css';
                            $tmp_file_name = 'jquery-ui-1.13.2/jquery-ui.theme.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY_UI, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.13.2/jquery-ui-1.13.2/jquery-ui.structure.css';
                            $tmp_file_name = 'jquery-ui-1.13.2/jquery-ui.structure.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY_UI, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.13.2/jquery-ui-1.13.2/jquery-ui.css';
                            $tmp_file_name = 'jquery-ui-1.13.2/jquery-ui.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY_UI, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.13.2/jquery-ui-1.13.2/jquery-ui.min.js';
                            $tmp_file_name = 'jquery-ui-1.13.2/jquery-ui.min.js';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY_UI, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/jquery_ui/1.13.2/jquery-ui-1.13.2/jquery-ui.js';
                            $tmp_file_name = 'jquery-ui-1.13.2/jquery-ui.js';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY_UI, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources(CRNRSTN_JS_FRAMEWORK_JQUERY_UI, $footer_html_output);
                            /*//////////
                            //////////

                            */

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/crnrstn.main.js';
                            $tmp_file_name = 'crnrstn.main.js';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
    <!-- BEGIN CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: JS + CSS MODULE OUTPUT :: ' . $this->oCRNRSTN->return_micro_time() . ' -->
';

                    switch ($const){
                        case CRNRSTN_CSS_FRAMEWORK_SIMPLE_GRID:

                            $tmp_file_type_const = CRNRSTN_UI_CSS;
                            if($asset_mode_ARRAY[0] === CRNRSTN_ASSET_MODE_BASE64) $tmp_file_type_const = CRNRSTN_UI_CSS & CRNRSTN_ASSET_MODE_BASE64;
                            
                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/simple_grid/simple-grid.min.css';
                            $tmp_file_name = 'simple-grid.min.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/simple_grid/simple-grid.css';
                            $tmp_file_name = 'simple-grid.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/reset.css';
                            $tmp_file_name = 'min/reset.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/reset.css';
                            $tmp_file_name = 'reset.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/text.css';
                            $tmp_file_name = 'min/text.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/text.css';
                            $tmp_file_name = 'text.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/960.css';
                            $tmp_file_name = 'min/960.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/960.css';
                            $tmp_file_name = '960.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/reset.css';
                            $tmp_file_name = 'min/reset.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/reset.css';
                            $tmp_file_name = 'reset.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/text.css';
                            $tmp_file_name = 'min/text.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/text.css';
                            $tmp_file_name = 'text.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/960_24_col.css';
                            $tmp_file_name = 'min/960_24_col.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/960_24_col.css';
                            $tmp_file_name = '960_24_col.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/reset.css';
                            $tmp_file_name = 'min/reset.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/reset.css';
                            $tmp_file_name = 'reset.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/text.css';
                            $tmp_file_name = 'min/text.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/text.css';
                            $tmp_file_name = 'text.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/960_16_col.css';
                            $tmp_file_name = 'min/960_24_col.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/960_16_col.css';
                            $tmp_file_name = '960_24_col.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/reset.css';
                            $tmp_file_name = 'min/reset.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/reset.css';
                            $tmp_file_name = 'reset.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/text.css';
                            $tmp_file_name = 'min/text.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/text.css';
                            $tmp_file_name = 'text.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/960_12_col.css';
                            $tmp_file_name = 'min/960_24_col.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/960_12_col.css';
                            $tmp_file_name = '960_24_col.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/reset.css';
                            $tmp_file_name = 'min/reset.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/reset.css';
                            $tmp_file_name = 'reset.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/text.css';
                            $tmp_file_name = 'min/text.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/text.css';
                            $tmp_file_name = 'text.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/960_24_col_rtl.css';
                            $tmp_file_name = 'min/960_24_col_rtl.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/960_24_col_rtl.css';
                            $tmp_file_name = '960_24_col_rtl.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/reset.css';
                            $tmp_file_name = 'min/reset.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/reset.css';
                            $tmp_file_name = 'reset.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/text.css';
                            $tmp_file_name = 'min/text.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/text.css';
                            $tmp_file_name = 'text.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/960_16_col_rtl.css';
                            $tmp_file_name = 'min/960_16_col_rtl.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/960_16_col_rtl.css';
                            $tmp_file_name = '960_16_col_rtl.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/reset.css';
                            $tmp_file_name = 'min/reset.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/reset.css';
                            $tmp_file_name = 'reset.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/text.css';
                            $tmp_file_name = 'min/text.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/text.css';
                            $tmp_file_name = 'text.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/960_12_col_rtl.css';
                            $tmp_file_name = 'min/960_12_col_rtl.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/960_12_col_rtl.css';
                            $tmp_file_name = '960_12_col_rtl.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/reset.css';
                            $tmp_file_name = 'min/reset.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/reset.css';
                            $tmp_file_name = 'reset.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/text.css';
                            $tmp_file_name = 'min/text.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/text.css';
                            $tmp_file_name = 'text.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/min/960_rtl.css';
                            $tmp_file_name = 'min/960_rtl.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/960_grid_system/code/css/960_rtl.css';
                            $tmp_file_name = '960_rtl.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                                $tmp_file_path = '/_lib/frameworks/jquery/3.6.1/jquery-3.6.1.min.js';
                                $tmp_file_name = 'jquery-3.6.1.min.js';
                                $tmp_file_is_minimized = true;
                                $tmp_asset_minimization_mode_is_active = true;
                                $tmp_resource_dependency_constant = $const;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                                /////
                                // R :: RESOURCE //
                                $tmp_file_path = '/_lib/frameworks/jquery/3.6.1/jquery-3.6.1.js';
                                $tmp_file_name = 'jquery-3.6.1.js';
                                $tmp_file_is_minimized = false;
                                $tmp_asset_minimization_mode_is_active = true;
                                $tmp_resource_dependency_constant = $const;
                                $tmp_spool_asset_for_footer_html = $footer_html_output;
                                $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                                $tmp_str .= $this->return_mapped_resources(CRNRSTN_JS_FRAMEWORK_JQUERY, $footer_html_output);
                                /*//////////
                                //////////

                                */

                            }

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/foundation/js/vendor/what-input.js';
                            $tmp_file_name = 'what-input.js';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/foundation/js/vendor/foundation.min.js';
                            $tmp_file_name = 'foundation.min.js';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/foundation/js/vendor/foundation.js';
                            $tmp_file_name = 'foundation.js';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources(CRNRSTN_JS_FRAMEWORK_JQUERY, $footer_html_output);
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
                            $tmp_file_path = '/_lib/frameworks/html5_boilerplate/8.0.0/css/normalize.css';
                            $tmp_file_name = 'normalize.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/html5_boilerplate/8.0.0/css/main.css';
                            $tmp_file_name = 'main.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/html5_boilerplate/8.0.0/js/vendor/modernizr-3.11.2.min.js';
                            $tmp_file_name = 'modernizr-3.11.2.min.js';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = true;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/html5_boilerplate/8.0.0/js/plugins.js';
                            $tmp_file_name = 'plugins.js';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = true;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/html5_boilerplate/8.0.0/js/main.js';
                            $tmp_file_name = 'main.js';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = true;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                            $tmp_file_path = '/_lib/frameworks/responsivegridsystem/css/html5reset.css';
                            $tmp_file_name = 'html5reset.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/responsivegridsystem/css/col.css';
                            $tmp_file_name = 'col.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/responsivegridsystem/css/2cols.css';
                            $tmp_file_name = '2cols.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/responsivegridsystem/css/3cols.css';
                            $tmp_file_name = '3cols.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/responsivegridsystem/css/4cols.css';
                            $tmp_file_name = '4cols.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/responsivegridsystem/css/5cols.css';
                            $tmp_file_name = '5cols.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/responsivegridsystem/css/6cols.css';
                            $tmp_file_name = '6cols.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/responsivegridsystem/css/7cols.css';
                            $tmp_file_name = '7cols.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/responsivegridsystem/css/8cols.css';
                            $tmp_file_name = '8cols.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/responsivegridsystem/css/9cols.css';
                            $tmp_file_name = '9cols.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/responsivegridsystem/css/10cols.css';
                            $tmp_file_name = '10cols.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/responsivegridsystem/css/11cols.css';
                            $tmp_file_name = '11cols.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/responsivegridsystem/css/12cols.css';
                            $tmp_file_name = '12cols.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                            $tmp_file_path = '/_lib/frameworks/unsemantic/assets/javascripts/html5.js';
                            $tmp_file_name = 'html5.js';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                            $tmp_str .= '<![endif]-->
                                <!--[if (gt IE 8) | (IEMobile)]><!-->';

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/unsemantic/assets/stylesheets/unsemantic-grid-responsive.css';
                            $tmp_file_name = 'unsemantic-grid-responsive.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                            $tmp_str .= '<!--<![endif]-->
                                <!--[if (lt IE 9) & (!IEMobile)]>';
                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/unsemantic/assets/stylesheets/ie.css';
                            $tmp_file_name = 'unsemantic-grid-responsive.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                            $tmp_file_path = '/_lib/frameworks/unsemantic/assets/javascripts/html5.js';
                            $tmp_file_name = 'html5.js';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                            $tmp_str .= '<![endif]-->
                                <!--[if (gt IE 8) | (IEMobile)]><!-->';

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/unsemantic/assets/stylesheets/unsemantic-grid-responsive-rtl.css';
                            $tmp_file_name = 'unsemantic-grid-responsive-rtl.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                            $tmp_str .= '<!--<![endif]-->
                                <!--[if (lt IE 9) & (!IEMobile)]>';

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/unsemantic/assets/stylesheets/ie-rtl.css';
                            $tmp_file_name = 'ie-rtl.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                            $tmp_file_path = '/_lib/frameworks/unsemantic/assets/stylesheets/reset.css';
                            $tmp_file_name = 'reset.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                            $tmp_file_path = '/_lib/frameworks/unsemantic/assets/stylesheets/reset-rtl.css';
                            $tmp_file_name = 'reset-rtl.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                            $tmp_file_path = '/_lib/frameworks/unsemantic/assets/javascripts/html5.js';
                            $tmp_file_name = 'html5.js';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                            $tmp_str .= '<![endif]-->';

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/unsemantic/assets/stylesheets/unsemantic-grid-base.css';
                            $tmp_file_name = 'unsemantic-grid-base.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                            $tmp_str .= '<noscript>';

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/unsemantic/assets/stylesheets/unsemantic-grid-mobile.css';
                            $tmp_file_name = 'unsemantic-grid-mobile.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                            $tmp_http_path_css = $this->oCRNRSTN->get_resource('crnrstn_css_asset_mapping_http_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
                            $tmp_http_path_css = $this->oCRNRSTN->crnrstn_http_endpoint($tmp_http_path_css);

                            $tmp_str .= '</noscript>
                                <script>
                                  var ADAPT_CONFIG = {
                                    path: \'' . $tmp_http_path_css . '_lib/frameworks/unsemantic/assets/stylesheets/\',
                                    dynamic: true,
                                    range: [
                                      \'0 to 767px = unsemantic-grid-mobile.css\',
                                      \'767px = unsemantic-grid-desktop.css\'
                                    ]
                                  };
                                </script>';

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/unsemantic/assets/javascripts/adapt.min.js';
                            $tmp_file_name = 'adapt.min.js';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                            $tmp_file_path = '/_lib/frameworks/unsemantic/assets/javascripts/html5.js';
                            $tmp_file_name = 'html5.js';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                            $tmp_str .= '<![endif]-->';

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/unsemantic/assets/stylesheets/unsemantic-grid-base-rtl.css';
                            $tmp_file_name = 'unsemantic-grid-base-rtl.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                            $tmp_str .= '<noscript>';

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/unsemantic/assets/stylesheets/unsemantic-grid-mobile-rtl.css';
                            $tmp_file_name = 'unsemantic-grid-mobile-rtl.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
                            $tmp_str .= $this->return_mapped_resources($const, $footer_html_output);
                            /*//////////
                            //////////

                            */

                            $tmp_http_path_css = $this->oCRNRSTN->get_resource('crnrstn_css_asset_mapping_http_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
                            $tmp_http_path_css = $this->oCRNRSTN->crnrstn_http_endpoint($tmp_http_path_css);

                            $tmp_str .= '</noscript>
                                <script>
                                  var ADAPT_CONFIG = {
                                    path: \'' . $tmp_http_path_css . '_lib/frameworks/unsemantic/assets/stylesheets/\',
                                    dynamic: true,
                                    range: [
                                      \'0 to 767px = unsemantic-grid-mobile-rtl.css\',
                                      \'767px = unsemantic-grid-desktop-rtl.css\'
                                    ]
                                  };
                                </script>';

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/unsemantic/assets/javascripts/adapt.min.js';
                            $tmp_file_name = 'adapt.min.js';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                            $tmp_file_path = '/_lib/frameworks/dead_simple_grid/css/grid.css';
                            $tmp_file_name = 'grid.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                            $tmp_file_path = '/_lib/frameworks/dead_simple_grid/css/screen.css';
                            $tmp_file_name = 'screen.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                            $tmp_file_path = '/_lib/frameworks/skeleton/2.0.4/css/normalize.css';
                            $tmp_file_name = '2.0.4/css/normalize.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/skeleton/2.0.4/css/skeleton.css';
                            $tmp_file_name = 'skeleton.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                            $tmp_file_path = '/_lib/frameworks/rwdgrid/css/rwdgrid.min.css';
                            $tmp_file_name = 'rwdgrid.min.css';
                            $tmp_file_is_minimized = true;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/rwdgrid/css/rwdgrid.css';
                            $tmp_file_name = 'rwdgrid.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = true;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);

                            /////
                            // R :: RESOURCE //
                            $tmp_file_path = '/_lib/frameworks/rwdgrid/css/style.css';
                            $tmp_file_name = 'style.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                            $tmp_file_path = '/_lib/frameworks/thisisdallas_simple_grid/simplegrid.css';
                            $tmp_file_name = 'simplegrid.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                            $tmp_file_path = '/crnrstn.main_desktop.css';
                            $tmp_file_name = 'crnrstn.main_desktop.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                            $tmp_file_path = '/crnrstn.main_tablet.css';
                            $tmp_file_name = 'crnrstn.main_tablet.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = NULL;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource($const, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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
                            $tmp_file_path = '/crnrstn.main_mobi.css';
                            $tmp_file_name = 'crnrstn.main_mobi.css';
                            $tmp_file_is_minimized = false;
                            $tmp_asset_minimization_mode_is_active = false;
                            $tmp_resource_dependency_constant = $const;
                            $tmp_spool_asset_for_footer_html = $footer_html_output;
                            $this->spool_resource(CRNRSTN_JS_FRAMEWORK_JQUERY, $tmp_file_path, $tmp_file_name, $tmp_file_type_const, $tmp_file_is_minimized, $tmp_asset_minimization_mode_is_active, $tmp_resource_dependency_constant, $tmp_spool_asset_for_footer_html);
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

        // THE TARGET
        // https://jony5.com/?crnrstn_0010111011=x.gif
        return $this->asset_data($system_asset_constant, $width_override, $height_override, $link_override, $alt_override, $title_override, $target_override, $output_mode);

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
        //error_log(__LINE__ . ' img ' . __METHOD__ . ' $media_element_key=[' . $media_element_key . '] self::$image_output_mode=[' . self::$image_output_mode . ']');
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

        */

        //error_log(__LINE__ . ' asset mgr [' . __METHOD__ . '] [' . print_r($data_ARRAY, true) . '].');

        $this->asset_meta_path = '';
        if(isset($data_ARRAY['crnrstn_asset_method_key'])){

            $this->asset_response_method_key = $data_ARRAY['crnrstn_asset_method_key'];

        }

        $this->asset_request_asset_family = $data_ARRAY['crnrstn_asset_family'];
        $this->asset_request_data_key = $data_ARRAY['crnrstn_asset_key'];

        if(isset($data_ARRAY['crnrstn_asset_meta_path'])){

            $this->asset_meta_path = $data_ARRAY['crnrstn_asset_meta_path'];

        }

        switch($this->asset_request_asset_family){
            case 'favicon':

                $tmp_filepath = $this->oCRNRSTN->get_resource('crnrstn_favicon_asset_tunnel_route_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
                $tmp_date_lastmod = filemtime($tmp_filepath);
                //$tmp_date_lastmod = date('D, M j Y G:i:s T', strtotime($tmp_date_lastmod));
                $tmp_date_lastmod = date('D, j M Y G:i:s T', $tmp_date_lastmod);

                $tmp_header_options_ARRAY = array();//Cache-Control: public, max-age=forever=1yearlimit
                $tmp_header_options_ARRAY[] = 'Cache-Control: public, max-age=31536000';
                $tmp_header_options_ARRAY[] = 'Last-Modified: ' . $tmp_date_lastmod;
                $tmp_header_options_ARRAY[] = 'X-Frame-Options: SAMEORIGIN';

                //error_log(__LINE__ . ' asset mgr $tmp_meta_path[' . $this->asset_meta_path . ']. $this->asset_response_method_key[' . $this->asset_response_method_key . ']. asset_request_data_key=[' . $this->asset_request_data_key . ']. asset_request_asset_family=[' . $this->asset_request_asset_family . '].');

                $tmp_ARRAY = explode('/', $this->asset_request_data_key);

                //
                // ADJUST VALUES BY DERIVING FAMILY AND KEY OVERRIDES FROM ORIGINAL DATA KEY VALUE.
                $this->asset_request_asset_family = $tmp_ARRAY[0];
                $this->asset_request_data_key = $tmp_ARRAY[1];

                $tmp_filepath .= '/' . $this->asset_request_asset_family . '/' . $this->asset_request_data_key;
                //error_log(__LINE__ . ' img asset mgr [' . $this->asset_request_data_key . '][' . $this->asset_request_asset_family . ']. $tmp_filepath=[' . $tmp_filepath . '].');

                $tmp_filename_clean = $this->process_for_filename($this->asset_request_data_key);

                $tmp_curr_headers_ARRAY = headers_list();
                $tmp_crnrstn_signature_headers_ARRAY = $this->oCRNRSTN->header_signature_options_return();

                //
                // SOURCE :: https://stackoverflow.com/questions/9728269/content-length-and-other-http-headers
                // AUTHOR :: NeysorN :: https://stackoverflow.com/users/1219121/neysor
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

                ob_flush();
                flush();
                exit();

            break;
            case 'system':
            case 'social':

                //error_log(__LINE__ . ' asset mgr $tmp_meta_path[' . $this->asset_meta_path . ']. $this->asset_response_method_key/$media_element_key[' . $this->asset_response_method_key . ']. asset_request_data_key=[' . $this->asset_request_data_key . ']. asset_request_asset_family=[' . $this->asset_request_asset_family . '].');
                //return $this->return_image_data($this->asset_request_data_key, NULL, NULL, NULL, NULL, NULL, NULL, $this->asset_request_asset_family, $output_mode);

                //die();
                return $this->return_system_image($this->asset_response_method_key);

            break;
            case 'js':

                //error_log(__LINE__ . ' asset mgr $tmp_meta_path[' . $this->asset_meta_path . ']. $this->asset_response_method_key[' . $this->asset_response_method_key . ']. asset_request_data_key=[' . $this->asset_request_data_key . ']. asset_request_asset_family=[' . $this->asset_request_asset_family . '].');
                return $this->return_asset_data();

            break;
            case 'css':

                //error_log(__LINE__ . ' asset mgr asset mgr $tmp_meta_path[' . $this->asset_meta_path . ']. $this->asset_response_method_key[' . $this->asset_response_method_key . ']. asset_request_data_key=[' . $this->asset_request_data_key . ']. asset_request_asset_family=[' . $this->asset_request_asset_family . '].');
                return $this->return_asset_data();

            break;
            case 'integrations':

                return $this->return_asset_data();

            break;

        }

    }

    private function asset_data($asset_data_key, $width_override = NULL, $height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $output_mode = NULL){

        switch($asset_data_key){
            case 'LIGHTBOX_CLOSE':

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
            case 'LIGHTBOX_LOADING':

                $tmp_filename = 'framework/lightbox/loading';
                $tmp_width = 32;
                $tmp_height = 32;
                $tmp_alt_text = 'loading';
                $tmp_title_text = 'loading';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'LIGHTBOX_NEXT':

                $tmp_filename = 'framework/lightbox/next';
                $tmp_width = 50;
                $tmp_height = 45;
                $tmp_alt_text = 'next';
                $tmp_title_text = 'next';
                $tmp_link = '';
                $tmp_target = '';
                $tmp_asset_family = 'integrations';
                self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] = CRNRSTN_UI_IMG;

            break;
            case 'LIGHTBOX_PREV':

                /*
                array(
                'framework/lightbox/close' => 'LIGHTBOX_CLOSE',
                'framework/lightbox/loading' => 'LIGHTBOX_LOADING',
                'framework/lightbox/next' => 'LIGHTBOX_NEXT',
                'framework/lightbox/prev' => 'LIGHTBOX_PREV'
                );

                */

                $tmp_filename = 'framework/lightbox/prev';
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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target, $tmp_asset_family, $output_mode);

    }

    private function process_for_filename($str){

        //
        // TRIM TO 100 CHARS
        return substr($this->normalizeString($str),0,100);

    }

    //
    // SOURCE :: https://stackoverflow.com/questions/2021624/string-sanitizer-for-filename
    // AUTHOR :: https://stackoverflow.com/users/489281/sequencedigitale-com
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

            if($tmp_output_mode == ''){

                $tmp_output_mode = CRNRSTN_ASSET_MAPPING;

            }

            //
            // CRNRSTN :: ASSET MAPPING
            if($asset_mapping_is_active){

                if(($tmp_output_mode != CRNRSTN_ASSET_MAPPING) && ($tmp_output_mode != CRNRSTN_ASSET_MAPPING_PROXY)){

                    $cache_serial = '';
                    if(self::$image_output_mode == CRNRSTN_UI_IMG_BASE64_JPEG){

                        $tmp_file_extension = 'jpg';
                        $cache_serial = $this->oCRNRSTN->resource_filecache_version($tmp_path . '/jpg/' . $this->asset_request_asset_family . '/' . $this->asset_request_data_key . '.' . $tmp_file_extension);

                    }

                    if($cache_serial == ''){

                        $tmp_file_extension = 'png';
                        $cache_serial = $this->oCRNRSTN->resource_filecache_version($tmp_path . '/png/' . $this->asset_request_asset_family . '/' . $this->asset_request_data_key . '.' . $tmp_file_extension);

                    }

                    //
                    // ONLY MAP ROUTE IF BIT IS FLIPPED
                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_SYSTEM_IMG_ASSET_MAPPING) && $this->asset_request_asset_family == 'system'){

                        return $tmp_map_http . '&crnrstn_v=420.0' . $cache_serial;

                    }

                    //
                    // ONLY TUNNEL ROUTE IF BIT IS FLIPPED
                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_SOCIAL_IMG_ASSET_MAPPING) && $this->asset_request_asset_family == 'social'){

                        return $tmp_map_http . '&crnrstn_v=420.0' . $cache_serial;

                    }

                }

            }

            switch($tmp_output_mode){
                case CRNRSTN_ASSET_MAPPING:
                case CRNRSTN_ASSET_MAPPING_PROXY:
                case CRNRSTN_UI_IMG:

                    //error_log(__LINE__ . ' asset mgr $tmp_output_mode[' . $tmp_output_mode . ']. image_output_mode[' . self::$image_output_mode . '].');

                    $tmp_path_directory = $this->oCRNRSTN->get_resource('crnrstn_path_directory', 0, 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES');
                    $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES');

                    switch($this->asset_request_asset_family){
                        case 'favicon':

                            error_log(__LINE__ . ' asset mgr FAVICON $this->asset_request_asset_family[' . $this->asset_request_asset_family . ']. [' . $tmp_output_mode . ']. die();');
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

                        break;

                    }

                    self::$image_output_mode = $this->return_ui_image_file_return_type_constant($tmp_output_mode);

                    //
                    // ASSET MAPPING ASSET RETURN - IMMEDIATE.
                    // RETURN JPEG
                    if(self::$image_output_mode == CRNRSTN_UI_IMG_BASE64_JPEG){

                        $tmp_file_extension = 'jpg';
                        $tmp_filepath = $tmp_path . '/jpg/' . $this->asset_request_asset_family . '/' . $this->asset_request_data_key . '.' . $tmp_file_extension;

                    }

                    if(!isset($tmp_filepath)){

                        //error_log(__LINE__ . ' asset mgr $tmp_http[' . $tmp_http . ']. $this->asset_request_asset_family[' . $this->asset_request_asset_family . ']. $this->asset_request_data_key[' . $this->asset_request_data_key . ']');

                        $tmp_file_extension = 'png';
                        $tmp_filepath = $tmp_path . '/png/' . $this->asset_request_asset_family . '/' . $this->asset_request_data_key . '.' . $tmp_file_extension;

                    }

                    if(!strlen($tmp_filepath) < 1){

                        $tmp_file_extension = 'png';
                        $tmp_filepath = $tmp_path . '/png/' . $this->asset_request_asset_family . '/' . $this->asset_request_data_key . '.' . $tmp_file_extension;

                    }

                    if(isset($tmp_filepath)){

                        if(is_file($tmp_filepath)){

                            $tmp_header_options_ARRAY = array();

                            $tmp_header_options_ARRAY[] = 'Cache-Control: public, max-age=31536000';
                            $tmp_header_options_ARRAY[] = 'X-Frame-Options: SAMEORIGIN';

                            $tmp_filename_clean = $this->process_for_filename($this->asset_request_data_key);

                            $tmp_curr_headers_ARRAY = headers_list();
                            $tmp_crnrstn_signature_headers_ARRAY = $this->oCRNRSTN->header_signature_options_return();

                            //
                            // SOURCE :: https://stackoverflow.com/questions/9728269/content-length-and-other-http-headers
                            // AUTHOR :: NeysorN :: https://stackoverflow.com/users/1219121/neysor
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

                            ob_flush();
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

                    $tmp_path_base64 = $tmp_path . '/base64/' . $this->asset_request_asset_family . '/' . $this->asset_request_data_key . '.php';

                    $tmp_file_repair = false;
                    if(!is_file($tmp_path_base64)){

                        $this->oCRNRSTN->error_log('Failure opening [' . $this->asset_request_data_key . '] for inclusion. Attempting to repair the BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                        $this->system_base64_synchronize($this->asset_request_data_key . '.png');
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

                            $this->oCRNRSTN->error_log('Failure opening [' . $this->asset_request_data_key . '] for inclusion. Attempting to repair the BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                            $this->system_base64_synchronize($this->asset_request_data_key . '.png');
                            $tmp_file_repair = true;

                        }

                        if(!@include($tmp_path_base64)){

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('Failure opening [' . $tmp_path_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.');

                        }else{

                            //$this->oCRNRSTN->print_r('Repair of asset successfully completed on [' . $this->asset_request_data_key . '] within the CRNRSTN :: BASE64 file system.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
                            $this->oCRNRSTN->error_log('Repair of asset successfully completed on [' . $this->asset_request_data_key . '] within the CRNRSTN :: BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

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

                        return $tmp_str;

                    }

                    //
                    // IF ERROR WITH BASE64...
                    if($asset_mapping_is_active){

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
                        $cache_serial = $this->oCRNRSTN->resource_filecache_version($tmp_path . '/jpg/' . $this->asset_request_asset_family . '/' . $this->asset_request_data_key . '.' . $tmp_file_extension);
                        $tmp_str = $tmp_http . 'jpg/' . $this->asset_request_asset_family . '/' . $this->asset_request_data_key . '.' . $tmp_file_extension . '?crnrstn_v=420.0' . $cache_serial;

                        return $tmp_str;

                    }

                    //
                    // RETURN PNG HTTP IF WE GET THIS FAR
                    $tmp_file_extension = 'png';
                    $cache_serial = $this->oCRNRSTN->resource_filecache_version($tmp_path . '/png/' . $this->asset_request_asset_family . '/' . $this->asset_request_data_key . '.' . $tmp_file_extension);
                    $tmp_str = $tmp_http . 'png/' . $this->asset_request_asset_family . '/' . $this->asset_request_data_key . '.' . $tmp_file_extension . '?crnrstn_v=420.0' . $cache_serial;

                    return $tmp_str;

                break;
            }

            $this->oCRNRSTN->error_log('Repair of integer constant is recommended. [' . $tmp_output_mode . '] passed into CRNRSTN :: for [' . $this->asset_request_data_key . '] is recommended.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
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
//
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
//                    switch($this->asset_request_asset_family){
//                        case 'system':
//
//                            $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_system_asset_tunnel_route_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
//                            $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_system_asset_tunnel_route_http_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH'));
//                            $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $this->asset_request_data_key;
//
//                        break;
//                        case 'social':
//
//                            $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_social_asset_tunnel_route_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
//                            $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_social_asset_tunnel_route_http_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH'));
//                            $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $this->asset_request_data_key;
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
//                    switch($this->asset_request_asset_family){
//                        case 'system':
//
//                            $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_system_asset_tunnel_route_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
//                            //$tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_system_asset_tunnel_route_http_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH'));
//                            //$tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $this->asset_request_data_key;
//
//                        break;
//                        case 'social':
//
//                            $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_social_asset_tunnel_route_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
//                            //$tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_social_asset_tunnel_route_http_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH'));
//                            //$tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $this->asset_request_data_key;
//
//                        break;
//
//                    }
//
//                    $tmp_path_base64 = $tmp_path . '/base64/' . $this->asset_request_asset_family . '/' . $this->asset_request_data_key . '.php';
//
//                    $tmp_file_repair = false;
//                    if(!is_file($tmp_path_base64)){
//
//                        $this->oCRNRSTN->error_log('Failure opening [' . $this->asset_request_data_key . '] for inclusion. Attempting to repair the BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
//
//                        $this->system_base64_synchronize($this->asset_request_data_key . '.png');
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
//                            $this->oCRNRSTN->error_log('Failure opening [' . $this->asset_request_data_key . '] for inclusion. Attempting to repair the BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
//
//                            $this->system_base64_synchronize($this->asset_request_data_key . '.png');
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
//                            //$this->oCRNRSTN->print_r('Repair of asset successfully completed on [' . $this->asset_request_data_key . '] within the CRNRSTN :: BASE64 file system.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
//                            $this->oCRNRSTN->error_log('Repair of asset successfully completed on [' . $this->asset_request_data_key . '] within the CRNRSTN :: BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
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

            switch($this->asset_request_asset_family){
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

            //error_log(__LINE__ . ' asset mgr [' . $this->default_asset_mode . ']. $this->asset_request_asset_family[' . $this->asset_request_asset_family . '].');
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

                    switch($this->asset_request_asset_family){
                        case 'favicon':

                            error_log(__LINE__ . ' asset mgr FAVICON $this->asset_request_asset_family[' . $this->asset_request_asset_family . ']. [' . $tmp_filename . '][' . $tmp_width . '][' . $tmp_height . '][' . $tmp_alt_text . '][' . $tmp_title_text . '][' . $tmp_link . '][' . $tmp_target . '][' . $tmp_asset_family . '][' . $tmp_output_mode . ']');
                            die();

                        break;
                        case 'system':

                            $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_system_asset_tunnel_route_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
                            if(strlen($tmp_path) < 1){

                                $tmp_path = $tmp_path_directory . DIRECTORY_SEPARATOR . $tmp_system_directory;

                            }

                            $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_system_asset_tunnel_route_http_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH'));

                            $tmp_map_http = $tmp_http . '?' . $this->oCRNRSTN->session_salt() . '=' . $this->asset_request_data_key;

                            $tmp_http = $tmp_http . $tmp_system_directory . DIRECTORY_SEPARATOR . 'ui' . DIRECTORY_SEPARATOR . 'imgs' . DIRECTORY_SEPARATOR;

                        break;
                        case 'social':

                            $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_social_asset_tunnel_route_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
                            if(strlen($tmp_path) < 1){

                                $tmp_path = $tmp_path_directory . DIRECTORY_SEPARATOR . $tmp_system_directory;

                            }

                            $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_social_asset_tunnel_route_http_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH'));

                            $tmp_map_http = $tmp_http . '?' . $this->oCRNRSTN->session_salt() . '=' . $this->asset_request_data_key;

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
                    //error_log(__LINE__ . ' asset mgr default_asset_mode[' . $this->default_asset_mode . ']. asset_request_asset_family[' . $this->asset_request_asset_family . '].');

                    $tmp_image_string = $this->return_image_string($tmp_path, $tmp_http, $tmp_map_http, $tmp_output_mode, $tmp_asset_mapping_is_active);
                    //error_log(__LINE__ . ' asset mgr $tmp_image_string[' . $tmp_image_string . '].');

                    if(strlen($tmp_link) > 0){

                        $tmp_image_string = $this->return_linked_ui_element($tmp_image_string, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                        return $tmp_image_string;

                    }else{

                        // ' . $img_css . ' ------- style="border:0;"
                        //$img_css = $this->html_img_dom_return($meta_params_ARRAY, 'CSS');
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

                    switch($this->asset_request_asset_family){
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

                    $tmp_path_base64 = $tmp_path . '/base64/' . $this->asset_request_asset_family . '/' . $this->asset_request_data_key . '.php';

                    $tmp_file_repair = false;
                    if(!is_file($tmp_path_base64)){

                        $this->oCRNRSTN->error_log('Failure opening [' . $this->asset_request_data_key . '] for inclusion. Attempting to repair the BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                        $this->system_base64_synchronize($this->asset_request_data_key . '.png');
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

                            $this->oCRNRSTN->error_log('Failure opening [' . $this->asset_request_data_key . '] for inclusion. Attempting to repair the BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                            $this->system_base64_synchronize($this->asset_request_data_key . '.png');
                            $tmp_file_repair = true;

                        }

                        if(!@include($tmp_path_base64)){

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('Failure opening [' . $tmp_path_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.');

                        }else{

                            //$this->oCRNRSTN->print_r('Repair of asset successfully completed on [' . $this->asset_request_data_key . '] within the CRNRSTN :: BASE64 file system.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
                            $this->oCRNRSTN->error_log('Repair of asset successfully completed on [' . $this->asset_request_data_key . '] within the CRNRSTN :: BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                        }

                    }


                    //
                    // BASE64 DATA IS NOW IN MEMORY
                    /*
                    $system_file_serial = '1011001100010101111101000100101110101111001111111111101111000001';

                    switch(self::$image_output_mode){
                        case CRNRSTN_UI_IMG_HTML_WRAPPED:
                        case CRNRSTN_UI_IMG_BASE64_JPEG:

                            //
                            // BASE64 ENCODE OF JPG
                            self::$image_filesystem_meta_ARRAY[self::$image_output_mode][self::$request_salt][$system_file_serial]['datecreated_base64_JPEG'] = '2022-08-28 16:20:03.914079';
                            self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_JPEG][self::$request_salt][$system_file_serial]['base64'] = 'data:image/jpg;base64,/9j/4AAQSkZJRgABAQEAYABgAAD/4QCgRXhpZgAATU0AKgAAAAgABQEaAAUAAAABAAAASgEbAAUAAAABAAAAUgEoAAMAAAABAAIAAAEyAAIAAAAUAAAAWodpAAQAAAABAAAAbgAAAAAAAABgAAAAAQAAAGAAAAABMjAyMjowNzoyOSAwMToyOTo1MgAAA6ABAAMAAAAB//8AAKACAAMAAAABAHcAAKADAAMAAAABAE0AAAAAAAD/4QvIaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJYTVAgQ29yZSA1LjUuMCI+IDxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+IDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgeG1sbnM6cGhvdG9zaG9wPSJodHRwOi8vbnMuYWRvYmUuY29tL3Bob3Rvc2hvcC8xLjAvIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIiB4bWxuczpzdEV2dD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3NUeXBlL1Jlc291cmNlRXZlbnQjIiBwaG90b3Nob3A6Q29sb3JNb2RlPSIzIiBwaG90b3Nob3A6SUNDUHJvZmlsZT0iRGlzcGxheSIgeG1wOk1vZGlmeURhdGU9IjIwMjItMDctMjlUMDE6Mjk6NTItMDQ6MDAiIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDctMjlUMDE6Mjk6NTItMDQ6MDAiPiA8ZGM6dGl0bGU+IDxyZGY6QWx0PiA8cmRmOmxpIHhtbDpsYW5nPSJ4LWRlZmF1bHQiPnNvY2lhbF9hcmNoaXZlczwvcmRmOmxpPiA8L3JkZjpBbHQ+IDwvZGM6dGl0bGU+IDx4bXBNTTpIaXN0b3J5PiA8cmRmOlNlcT4gPHJkZjpsaSBzdEV2dDphY3Rpb249InByb2R1Y2VkIiBzdEV2dDpzb2Z0d2FyZUFnZW50PSJBZmZpbml0eSBEZXNpZ25lciAxLjEwLjUiIHN0RXZ0OndoZW49IjIwMjItMDctMjlUMDE6Mjk6NTItMDQ6MDAiLz4gPC9yZGY6U2VxPiA8L3htcE1NOkhpc3Rvcnk+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDw/eHBhY2tldCBlbmQ9InciPz7/7QBcUGhvdG9zaG9wIDMuMAA4QklNBAQAAAAAACMcAVoAAxslRxwCAAACAAQcAgUAD3NvY2lhbF9hcmNoaXZlcwA4QklNBCUAAAAAABB62zsZV9dskNO1RKrQzqCc/+IPvElDQ19QUk9GSUxFAAEBAAAPrGxjbXMCEAAAbW50clJHQiBYWVogB+YAAQAeAA4ALgAEYWNzcEFQUEwAAAAAQVBQTAAAAAAAAAAAAAAAAAAAAAAAAPbWAAEAAAAA0y1sY21zAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAARZGVzYwAAAVAAAAB0ZHNjbQAAAcQAAASEY3BydAAABkgAAAAjd3RwdAAABmwAAAAUclhZWgAABoAAAAAUZ1hZWgAABpQAAAAUYlhZWgAABqgAAAAUclRSQwAABrwAAAgMYWFyZwAADsgAAAAgdmNndAAADugAAAAwbmRpbgAADxgAAAA+Y2hhZAAAD1gAAAAsbW1vZAAAD4QAAAAoYlRSQwAABrwAAAgMZ1RSQwAABrwAAAgMYWFiZwAADsgAAAAgYWFnZwAADsgAAAAgZGVzYwAAAAAAAAAIRGlzcGxheQAAAAAAAAAACABEAGkAcwBwAGwAYQB5AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABtbHVjAAAAAAAAACYAAAAMaHJIUgAAABQAAAHYa29LUgAAAAwAAAHsbmJOTwAAABIAAAH4aWQAAAAAABIAAAIKaHVIVQAAABQAAAIcY3NDWgAAABYAAAIwZGFESwAAABwAAAJGbmxOTAAAABYAAAJiZmlGSQAAABAAAAJ4aXRJVAAAABQAAAKIZXNFUwAAABIAAAKccm9STwAAABIAAAKcZnJDQQAAABYAAAKuYXIAAAAAABQAAALEdWtVQQAAABwAAALYaGVJTAAAABYAAAL0emhUVwAAAAwAAAMKdmlWTgAAAA4AAAMWc2tTSwAAABYAAAMkemhDTgAAAAwAAAMKcnVSVQAAACQAAAM6ZW5HQgAAABQAAANeZnJGUgAAABYAAANybXMAAAAAABIAAAOIaGlJTgAAABIAAAOadGhUSAAAAAwAAAOsY2FFUwAAABgAAAO4ZW5BVQAAABQAAANeZXNYTAAAABIAAAKcZGVERQAAABAAAAPQZW5VUwAAABIAAAPgcHRCUgAAABgAAAPycGxQTAAAABIAAAQKZWxHUgAAACIAAAQcc3ZTRQAAABAAAAQ+dHJUUgAAABQAAAROcHRQVAAAABYAAARiamFKUAAAAAwAAAR4AEwAQwBEACAAdQAgAGIAbwBqAGnO7LfsACAATABDAEQARgBhAHIAZwBlAC0ATABDAEQATABDAEQAIABXAGEAcgBuAGEAUwB6AO0AbgBlAHMAIABMAEMARABCAGEAcgBlAHYAbgD9ACAATABDAEQATABDAEQALQBmAGEAcgB2AGUAcwBrAOYAcgBtAEsAbABlAHUAcgBlAG4ALQBMAEMARABWAOQAcgBpAC0ATABDAEQATABDAEQAIABjAG8AbABvAHIAaQBMAEMARAAgAGMAbwBsAG8AcgBBAEMATAAgAGMAbwB1AGwAZQB1AHIgDwBMAEMARAAgBkUGRAZIBkYGKQQaBD4EOwRMBD4EQAQ+BDIEOAQ5ACAATABDAEQgDwBMAEMARAAgBeYF0QXiBdUF4AXZX2mCcgAgAEwAQwBEAEwAQwBEACAATQDgAHUARgBhAHIAZQBiAG4A/QAgAEwAQwBEBCYEMgQ1BEIEPQQ+BDkAIAQWBBoALQQ0BDgEQQQ/BDsENQQ5AEMAbwBsAG8AdQByACAATABDAEQATABDAEQAIABjAG8AdQBsAGUAdQByAFcAYQByAG4AYQAgAEwAQwBECTAJAgkXCUAJKAAgAEwAQwBEAEwAQwBEACAOKg41AEwAQwBEACAAZQBuACAAYwBvAGwAbwByAEYAYQByAGIALQBMAEMARABDAG8AbABvAHIAIABMAEMARABMAEMARAAgAEMAbwBsAG8AcgBpAGQAbwBLAG8AbABvAHIAIABMAEMARAOIA7MDxwPBA8kDvAO3ACADvwO4A8wDvQO3ACAATABDAEQARgDkAHIAZwAtAEwAQwBEAFIAZQBuAGsAbABpACAATABDAEQATABDAEQAIABhACAAQwBvAHIAZQBzMKsw6TD8AEwAQwBEdGV4dAAAAABDb3B5cmlnaHQgQXBwbGUgSW5jLiwgMjAyMgAAWFlaIAAAAAAAAPMWAAEAAAABFspYWVogAAAAAAAAg54AAD20////u1hZWiAAAAAAAABLugAAs4sAAArXWFlaIAAAAAAAACd9AAAOwQAAyJtjdXJ2AAAAAAAABAAAAAAFAAoADwAUABkAHgAjACgALQAyADYAOwBAAEUASgBPAFQAWQBeAGMAaABtAHIAdwB8AIEAhgCLAJAAlQCaAJ8AowCoAK0AsgC3ALwAwQDGAMsA0ADVANsA4ADlAOsA8AD2APsBAQEHAQ0BEwEZAR8BJQErATIBOAE+AUUBTAFSAVkBYAFnAW4BdQF8AYMBiwGSAZoBoQGpAbEBuQHBAckB0QHZAeEB6QHyAfoCAwIMAhQCHQImAi8COAJBAksCVAJdAmcCcQJ6AoQCjgKYAqICrAK2AsECywLVAuAC6wL1AwADCwMWAyEDLQM4A0MDTwNaA2YDcgN+A4oDlgOiA64DugPHA9MD4APsA/kEBgQTBCAELQQ7BEgEVQRjBHEEfgSMBJoEqAS2BMQE0wThBPAE/gUNBRwFKwU6BUkFWAVnBXcFhgWWBaYFtQXFBdUF5QX2BgYGFgYnBjcGSAZZ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';

                        break;
                        default:

                            //
                            // BASE64 ENCODE OF PNG
                            self::$image_filesystem_meta_ARRAY[self::$image_output_mode][self::$request_salt][$system_file_serial]['datecreated_base64_PNG'] = '2022-08-28 16:20:03.914035';
                            self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$system_file_serial]['base64'] = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHcAAABNCAYAAACc2PtBAAAFVGlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZGM9Imh0dHA6Ly9wdXJsLm9yZy9kYy9lbGVtZW50cy8xLjEvIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjExOSIKICAgZXhpZjpQaXhlbFlEaW1lbnNpb249Ijc3IgogICBleGlmOkNvbG9yU3BhY2U9IjY1NTM1IgogICB0aWZmOkltYWdlV2lkdGg9IjExOSIKICAgdGlmZjpJbWFnZUxlbmd0aD0iNzciCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LzEiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LzEiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQ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';

                        break;

                    }

                    //
                    // BASE64 LAST MODIFIED
                    self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$system_file_serial]['lastmodified_base64_PNG'] = '2022-08-28 16:20:03.916133';
                    self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_JPEG][self::$request_salt][$system_file_serial]['lastmodified_base64_JPEG'] = '2022-08-28 16:20:03.918340';

                    //
                    // BASE64 HASH/CHECKSUM
                    self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$system_file_serial]['base64_crc'] = '509343955';
                    self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$system_file_serial]['base64_md5'] = '0bdebd4477b564e5ea0aad34e5c33528';

                    self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_JPEG][self::$request_salt][$system_file_serial]['base64_crc'] = '891431679';
                    self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_JPEG][self::$request_salt][$system_file_serial]['base64_md5'] = '1e1c875e796eccea1cd43585ec46836d';

                    //
                    // HASHES FOR BASE64 SOURCE PNG FILE
                    self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$system_file_serial]['md5'] = '8500b5aea714f040db76af517c17fb5a';
                    self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$system_file_serial]['sha1'] = 'fc1ca52dec2c882786b90e95f1d9cd457603d560';

                    //
                    // HASHES FOR BASE64 SOURCE JPEG FILE
                    self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_JPEG][self::$request_salt][$system_file_serial]['md5'] = '487d7295f7db1361c0bb7892583a279b';
                    self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_JPEG][self::$request_salt][$system_file_serial]['sha1'] = '7981fb73d73c7cfcfd9a38a5f32fef5240c055e4';

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

            if($tmp_filename == 'favicon.ico' || $tmp_filename == 'favicon.ico' || $tmp_filename == 'CRNRSTN_FAVICON' || $tmp_filename == 'BASSDRIVE_FAVICON' || $tmp_filename == 'JONY5_FAVICON'){

                switch($tmp_asset_family){
                    case 'bassdrive':
                    case 'jony5':
                    case 'crnrstn':
                    default:

                        //error_log(__LINE__ . ' asste mgr [' . $tmp_asset_family . '].');
                        return '<link rel="shortcut icon" type="image/x-icon" href="' . $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_asset_family . '/' . $tmp_filename . '.ico&v=420.00" />';

                    break;

                }

            }

            $this->output_mode_override = $tmp_output_mode;

            if(!isset($this->asset_response_method_key)){

                $this->asset_response_method_key = $this->oCRNRSTN->asset_return_method_key($tmp_asset_family, $tmp_filename);
                //error_log(__LINE__ . ' asset mgr asset_response_method_key NOT set. output_mode_override[' . $this->output_mode_override . ']. asset_response_method_key[' . $this->asset_response_method_key . '].');

            }

            if(strlen($this->asset_response_method_key) < 1){

                $this->asset_response_method_key = $this->oCRNRSTN->asset_return_method_key($tmp_asset_family, $tmp_filename);
                //error_log(__LINE__ . ' asset mgr asset_response_method_key length=0. output_mode_override[' . $this->output_mode_override . ']. asset_response_method_key[' . $this->asset_response_method_key . '].');

            }

            $this->asset_request_asset_family = $tmp_asset_family;
            $this->asset_request_data_key = $tmp_filename;

            switch($this->asset_request_asset_family){
                case 'integrations':

                    //error_log(__LINE__ . ' asset mgr asset_request_data_key[' . $this->asset_request_data_key . ']. output_mode_override[' . $this->output_mode_override . ']. asset_response_method_key[' . $this->asset_response_method_key . '].');

                    // $tmp_path = 'var/www/html/lightbox.crnrstn.evifweb.com/_crnrstn/ui';
                    $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_integrations_asset_mapping_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_INTEGRATIONS');

                    switch($this->asset_request_data_key){
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
                            // AUTHOR :: NeysorN :: https://stackoverflow.com/users/1219121/neysor
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

                            ob_flush();
                            flush();
                            exit();

                        }

                    }

                    //error_log(__LINE__ . '  asset mgr [404] asset_request_asset_family[' . $this->asset_request_asset_family . '].');
                    return $this->oCRNRSTN->return_server_response_code(404);

                break;
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

                    $tmp_ASSET_MODE = $this->oCRNRSTN->return_set_bits($this->oCRNRSTN->system_output_profile_constants, true);

                    if(!isset($tmp_ASSET_MODE[0])){

                        $tmp_ASSET_MODE[] = CRNRSTN_ASSET_MODE_BASE64;

                    }

                    $this->default_asset_mode = $tmp_ASSET_MODE[0];

                    //
                    // IMAGE OUT
                    //$this->oCRNRSTN->error_log(__LINE__ . ' asset mgr ASSET[' . $tmp_filename . ']. $asset_output_mode_ARRAY=[' . self::$asset_output_mode_ARRAY[$tmp_asset_family][$tmp_filename] . ']. tmp_output_mode[' . $tmp_output_mode . ']. asset_family[' . print_r($this->asset_request_asset_family, true) . ']. asset_response_method_key[' . $this->asset_response_method_key . ']. $this->default_asset_mode[' . $this->default_asset_mode . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

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

                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_ASSET_MAPPING) || $tmp_output_mode == CRNRSTN_ASSET_MAPPING){

                        $asset_mapping_is_active = true;
                        $asset_mapping_mode = CRNRSTN_ASSET_MAPPING;

                    }

                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_ASSET_MAPPING_PROXY) || $tmp_output_mode == CRNRSTN_ASSET_MAPPING_PROXY){

                        $asset_mapping_is_active = true;
                        $asset_mapping_mode = CRNRSTN_ASSET_MAPPING_PROXY;

                    }

                    $this->oCRNRSTN->error_log(__LINE__ . ' asset mgr ASSET[' . $tmp_filename . ']. tmp_output_mode[' . $tmp_output_mode . ']. asset_family[' . print_r($this->asset_request_asset_family, true) . ']. asset_response_method_key[' . $this->asset_response_method_key . ']. $this->default_asset_mode[' . $this->default_asset_mode . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                    // $asset_data_key
                    switch($tmp_output_mode){
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

                            $this->oCRNRSTN->error_log(__LINE__ . ' asset mgr ASSET[' . $tmp_filename . ']. tmp_output_mode[' . $tmp_output_mode . ']. asset_family[' . print_r($this->asset_request_asset_family, true) . ']. asset_response_method_key[' . $this->asset_response_method_key . ']. $this->default_asset_mode[' . $this->default_asset_mode . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                            return $this->return_image_html_wrapped($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target, $tmp_asset_family, $tmp_output_mode, $asset_mapping_mode);

                        break;
                        case CRNRSTN_ASSET_MODE_JPEG:

                            switch($this->asset_request_asset_family){
                                case 'system':

                                    $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_system_asset_tunnel_route_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
                                    $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_system_asset_tunnel_route_http_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH'));
                                    $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $this->asset_request_data_key;

                                break;
                                case 'social':

                                    $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_social_asset_tunnel_route_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
                                    $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_social_asset_tunnel_route_http_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH'));
                                    $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $this->asset_request_data_key;

                                break;

                            }

                            //
                            // RETURN IMAGE STRING
                            //$tmp_file_extension = 'jpg';
                            //$tmp_filepath = $this->oCRNRSTN->crnrstn_path_directory() . '/' . $this->oCRNRSTN->crnrstn_root_directory() . '/ui/imgs/jpg/' . $this->asset_request_asset_family . '/' . $tmp_filename . '.' . $tmp_file_extension;
                            //error_log(__LINE__ . ' asset mgr [CRNRSTN_ASSET_MODE_JPEG]. $tmp_filepath[' . $tmp_filename . '].');

                            return $this->return_image_string($tmp_path, $tmp_http, $tmp_map_http, $tmp_output_mode, $asset_mapping_is_active);
                            //return $this->return_image();

                        break;
                        case CRNRSTN_ASSET_MODE_PNG:

                            switch($this->asset_request_asset_family){
                                case 'system':

                                    $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_system_asset_tunnel_route_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
                                    $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_system_asset_tunnel_route_http_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH'));
                                    $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $this->asset_request_data_key;

                                break;
                                case 'social':

                                    $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_social_asset_tunnel_route_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
                                    $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_social_asset_tunnel_route_http_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH'));
                                    $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $this->asset_request_data_key;

                                break;

                            }

                            //$tmp_file_extension = 'png';
                            //$tmp_filepath = $this->oCRNRSTN->crnrstn_path_directory() . '/' . $this->oCRNRSTN->crnrstn_root_directory() .'/ui/imgs/png/' . $this->asset_request_asset_family . '/' . $tmp_filename . '.' . $tmp_file_extension;
                            $this->oCRNRSTN->error_log(' asset mgr [CRNRSTN_ASSET_MODE_PNG]. $tmp_filepath[' . $tmp_filename . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                            return $this->return_image_string($tmp_path, $tmp_http, $tmp_map_http, $tmp_output_mode, $asset_mapping_is_active);
                            //return $this->return_image();

                        break;
                        case CRNRSTN_ASSET_MODE_BASE64:
                        case CRNRSTN_UI_IMG_BASE64:

                            $this->oCRNRSTN->error_log(' asset mgr ASSET[' . $tmp_filename . ']. tmp_output_mode[' . $tmp_output_mode . ']. asset_family[' . print_r($this->asset_request_asset_family, true) . ']. asset_response_method_key[' . $this->asset_response_method_key . ']. $this->default_asset_mode[' . $this->default_asset_mode . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                            if($this->oCRNRSTN->is_system_terminate_enabled()){
                                $this->oCRNRSTN->error_log(' asset mgr ASSET[' . $tmp_filename . ']. tmp_output_mode[' . $tmp_output_mode . ']. asset_family[' . print_r($this->asset_request_asset_family, true) . ']. asset_response_method_key[' . $this->asset_response_method_key . ']. $this->default_asset_mode[' . $this->default_asset_mode . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                                $tmp_path = CRNRSTN_ROOT;
                                $tmp_system_directory = '_crnrstn';
                                self::$image_output_mode = CRNRSTN_UI_IMG_BASE64_PNG;

                                $tmp_path_base64 = $tmp_path . DIRECTORY_SEPARATOR . $tmp_system_directory . '/ui/imgs/base64/' . $this->asset_request_asset_family . '/' . $this->asset_request_data_key . '.php';

                                $tmp_file_repair = false;
                                if(!is_file($tmp_path_base64)){

                                    $this->oCRNRSTN->error_log('Failure opening [' . $this->asset_request_data_key . '] for inclusion. Attempting to repair the BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                                    $this->system_base64_synchronize($this->asset_request_data_key . '.png');
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

                                        $this->oCRNRSTN->error_log('Failure opening [' . $this->asset_request_data_key . '] for inclusion. Attempting to repair the BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                                        $this->system_base64_synchronize($this->asset_request_data_key . '.png');
                                        $tmp_file_repair = true;

                                    }

                                    if(!@include($tmp_path_base64)){

                                        //
                                        // HOOOSTON...VE HAF PROBLEM!
                                        throw new Exception('Failure opening [' . $tmp_path_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.');

                                    }else{

                                        //$this->oCRNRSTN->print_r('Repair of asset successfully completed on [' . $this->asset_request_data_key . '] within the CRNRSTN :: BASE64 file system.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
                                        $this->oCRNRSTN->error_log('Repair of asset successfully completed on [' . $this->asset_request_data_key . '] within the CRNRSTN :: BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                                    }

                                }

                            }else{


                                $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_path_directory', 0, 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES');
                                $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES');
                                self::$image_output_mode = CRNRSTN_UI_IMG_BASE64_PNG;

                                $tmp_path_base64 = $tmp_path . DIRECTORY_SEPARATOR . $tmp_system_directory . '/ui/imgs/base64/' . $this->asset_request_asset_family . '/' . $this->asset_request_data_key . '.php';

                                $tmp_file_repair = false;
                                if(!is_file($tmp_path_base64)){

                                    $this->oCRNRSTN->error_log('Failure opening [' . $this->asset_request_data_key . '] for inclusion. Attempting to repair the BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                                    $this->system_base64_synchronize($this->asset_request_data_key . '.png');
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

                                        $this->oCRNRSTN->error_log('Failure opening [' . $this->asset_request_data_key . '] for inclusion. Attempting to repair the BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                                        $this->system_base64_synchronize($this->asset_request_data_key . '.png');
                                        $tmp_file_repair = true;

                                    }

                                    if(!@include($tmp_path_base64)){

                                        //
                                        // HOOOSTON...VE HAF PROBLEM!
                                        throw new Exception('Failure opening [' . $tmp_path_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.');

                                    }else{

                                        //$this->oCRNRSTN->print_r('Repair of asset successfully completed on [' . $this->asset_request_data_key . '] within the CRNRSTN :: BASE64 file system.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
                                        $this->oCRNRSTN->error_log('Repair of asset successfully completed on [' . $this->asset_request_data_key . '] within the CRNRSTN :: BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

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

                            switch($this->asset_request_asset_family){
                                case 'system':

                                    $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_system_asset_tunnel_route_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
                                    $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_system_asset_tunnel_route_http_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH'));
                                    $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $this->asset_request_data_key;

                                break;
                                case 'social':

                                    $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_social_asset_tunnel_route_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
                                    $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_social_asset_tunnel_route_http_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH'));
                                    $tmp_map_http = $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $this->asset_request_data_key;

                                break;

                            }

                            //error_log(__LINE__ . ' asset mgr DEFAULT SWITCH HIT. $this->default_asset_mode[' . $this->default_asset_mode . ']. [' . $tmp_filename . ']. [' . $tmp_output_mode . ']. [' . self::$asset_output_mode_ARRAY[$this->asset_request_asset_family][$tmp_filename] . '].');

                            return $this->return_image_string($tmp_path, $tmp_http, $tmp_map_http, $tmp_output_mode, $asset_mapping_is_active);

                        break;

                    }

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
                            // AUTHOR :: NeysorN :: https://stackoverflow.com/users/1219121/neysor
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

                            ob_flush();
                            flush();
                            exit();

                        }

                    }

                //error_log(__LINE__ . '  asset mgr [404] asset_request_asset_family[' . $this->asset_request_asset_family . '].');
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

                    //error_log(__LINE__ . ' asset mgr $tmp_family[' . $this->asset_request_asset_family . ']. $tmp_filename[' . $tmp_filename . ']. $tmp_output_mode[' . $tmp_output_mode . '].');
                    $tmp_str = $this->oCRNRSTN->crnrstn_http_endpoint() . '_crnrstn/ui/imgs/jpg/' . $tmp_filename . '.jpg';

                    if(strlen($tmp_link) > 0){

                        $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                        return $tmp_str;

                    }else{

                        switch($this->asset_request_asset_family){
                            case 'crnrstn':
                            case 'baasdrive':
                            case 'jony5':

                                return '<link rel="shortcut icon" type="image/x-icon" href="' . $this->oCRNRSTN->crnrstn_http_endpoint() . '?' . $this->oCRNRSTN->session_salt() . '=' . $tmp_asset_family . '/' . $tmp_filename . '.ico&v=420.00" />';

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

    private function return_css_string_output(){

        switch($this->asset_request_data_key){
            case 'crnrstn.lightbox.min.css':

                $tmp_session_salt = $this->oCRNRSTN->session_salt();
                $tmp_path_js = $this->oCRNRSTN->get_resource('crnrstn_js_asset_mapping_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');

                $tmp_http_path = $this->oCRNRSTN->crnrstn_http_endpoint();

                $tmp_cache_ver_loading = $this->oCRNRSTN->resource_filecache_version($tmp_path_js . '/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/images/loading.gif');
                $tmp_cache_ver_prev = $this->oCRNRSTN->resource_filecache_version($tmp_path_js . '/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/images/prev.png');
                $tmp_cache_ver_next = $this->oCRNRSTN->resource_filecache_version($tmp_path_js . '/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/images/next.png');
                $tmp_cache_ver_close = $this->oCRNRSTN->resource_filecache_version($tmp_path_js . '/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/images/close.png');

                return '<style>/* lightbox 2.11.3 CSS :: crnrstn.lightbox.min.css [MODIFIED FROM LIGHTBOX.JS TO HONOR CRNRSTN :: ASSET MAPPING] :: Monday, November 7, 2022 @ 2324 hrs */
.lb-loader,.lightbox{text-align:center;line-height:0;position:absolute;left:0}body.lb-disable-scrolling{overflow:hidden}.lightboxOverlay{position:absolute;top:0;left:0;z-index:9999;background-color:#000;filter:alpha(Opacity=80);opacity:.8;display:none}.lightbox{width:100%;z-index:10000;font-weight:400;outline:0}.lightbox .lb-image{display:block;height:auto;max-width:inherit;max-height:none;border-radius:3px;border:4px solid #fff}.lightbox a img{border:none}.lb-outerContainer{position:relative;width:250px;height:250px;margin:0 auto;border-radius:4px;background-color:#fff}.lb-outerContainer:after{content:"";display:table;clear:both}.lb-loader{top:43%;height:25%;width:100%}.lb-cancel{display:block;width:32px;height:32px;margin:0 auto;background:url(' . $tmp_http_path . '?' . $tmp_session_salt . '=framework/lightbox/loading&crnrstn_v=' . $tmp_cache_ver_loading . ') no-repeat}.lb-nav{position:absolute;top:0;left:0;height:100%;width:100%;z-index:10}.lb-container>.nav{left:0}.lb-nav a{outline:0;background-image:url(data:image/gif;base64,R0lGODlhAQABAPAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==)}.lb-next,.lb-prev{height:100%;cursor:pointer;display:block}.lb-nav a.lb-prev{width:34%;left:0;float:left;background:url(' . $tmp_http_path . '?' . $tmp_session_salt . '=framework/lightbox/prev&crnrstn_v=' . $tmp_cache_ver_prev . ') left 48% no-repeat;filter:alpha(Opacity=0);opacity:0;-webkit-transition:opacity .6s;-moz-transition:opacity .6s;-o-transition:opacity .6s;transition:opacity .6s}.lb-nav a.lb-prev:hover{filter:alpha(Opacity=100);opacity:1}.lb-nav a.lb-next{width:64%;right:0;float:right;background:url(' . $tmp_http_path . '?' . $tmp_session_salt . '=framework/lightbox/next&crnrstn_v=' . $tmp_cache_ver_next . ') right 48% no-repeat;filter:alpha(Opacity=0);opacity:0;-webkit-transition:opacity .6s;-moz-transition:opacity .6s;-o-transition:opacity .6s;transition:opacity .6s}.lb-nav a.lb-next:hover{filter:alpha(Opacity=100);opacity:1}.lb-dataContainer{margin:0 auto;padding-top:5px;width:100%;border-bottom-left-radius:4px;border-bottom-right-radius:4px}.lb-dataContainer:after{content:"";display:table;clear:both}.lb-data{padding:0 4px;color:#ccc}.lb-data .lb-details{width:85%;float:left;text-align:left;line-height:1.1em}.lb-data .lb-caption{font-size:13px;font-weight:700;line-height:1em}.lb-data .lb-caption a{color:#4ae}.lb-data .lb-number{display:block;clear:left;padding-bottom:1em;font-size:12px;color:#999}.lb-data .lb-close{display:block;float:right;width:30px;height:30px;background:url(' . $tmp_http_path . '?' . $tmp_session_salt . '=framework/lightbox/close&crnrstn_v=' . $tmp_cache_ver_close . ') top right no-repeat;text-align:right;outline:0;filter:alpha(Opacity=70);opacity:.7;-webkit-transition:opacity .2s;-moz-transition:opacity .2s;-o-transition:opacity .2s;transition:opacity .2s}.lb-data .lb-close:hover{cursor:pointer;filter:alpha(Opacity=100);opacity:1}
</style>';

            break;

        }

        return '';

    }

    private function return_asset_data(){

        $tmp_header_options_ARRAY = array();
        $tmp_process_return = false;

        $tmp_header_options_ARRAY[] = 'Cache-Control: public, max-age=31536000';
        $tmp_header_options_ARRAY[] = 'X-Frame-Options: SAMEORIGIN';

        switch($this->asset_request_asset_family){
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
                        switch($this->asset_request_data_key){
                            case 'crnrstn.lightbox.min.css':

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
                $pos_css = strpos($this->asset_request_data_key,'.css');
                if($pos_css !== false){

                    $tmp_header_options_ARRAY[] = 'Content-Type: text/css';

                }else{

                    $tmp_header_options_ARRAY[] = 'Content-Type: text/javascript';

                }

                $tmp_dir_path = $this->oCRNRSTN->get_resource('crnrstn_js_asset_mapping_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');

                $tmp_date_lastmod = filemtime($tmp_dir_path);
                $tmp_date_lastmod = date('D, j M Y G:i:s T', $tmp_date_lastmod);
                $tmp_header_options_ARRAY[] = 'Last-Modified: ' . $tmp_date_lastmod;

                if(isset($this->asset_meta_path)){

                    if(strlen($this->asset_meta_path) > 0){

                        $tmp_dir_path = $tmp_dir_path . '/' . $this->asset_meta_path;

                    }

                }

            break;
            case 'integrations':

                switch($this->asset_request_data_key){
                    case 'framework/lightbox/close':
                    case 'framework/lightbox/loading':
                    case 'framework/lightbox/next':
                    case 'framework/lightbox/prev':

                        return $this->return_system_image($this->asset_response_method_key);

                    break;

                }

            break;

        }

        if($tmp_process_return){

            $tmp_filepath = $tmp_dir_path . '/' . $this->asset_request_data_key;

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

            //error_log(__LINE__ . ' asset mgr asset mgr file_path[' . $tmp_filepath . ']. asset_response_method_key[' . $this->asset_response_method_key . ']. asset_request_asset_family=[' . $this->asset_request_asset_family . '].');

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

        //error_log(__LINE__ . ' asset mgr asset mgr asset_meta_path[' . $this->asset_meta_path . ']. asset_response_method_key[' . $this->asset_response_method_key . ']. asset_request_data_key=[' . $this->asset_request_data_key . ']. asset_request_asset_family=[' . $this->asset_request_asset_family . '].');

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

            $mkdir_mode = 775;
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
                chmod($tmp_filepath, 775);

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
                        chmod($tmp_filepath, 775);

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