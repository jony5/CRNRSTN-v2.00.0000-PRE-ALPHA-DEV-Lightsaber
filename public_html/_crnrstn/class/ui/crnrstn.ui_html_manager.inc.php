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
#  CLASS :: crnrstn_ui_html_manager
#  VERSION :: 1.00.0000
#  DATE :: May 1, 2021 @ 1219hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: Support for generation of CRNRSTN :: support
#                 web content.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_ui_html_manager {

	protected $oLogger;
	public $oCRNRSTN;
    protected $oCRNRSTN_UI_ASSEMBLER;

    public $page_serial;
    public $css_length_units_ARRAY = array();
    protected $docs_nav_link_ARRAY = array();
    protected $docs_nav_html = '';

	public function __construct($oCRNRSTN){

	    $this->oCRNRSTN = $oCRNRSTN;

        //
        // INSTANTIATE LOGGER.
        $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN);

        //
        // PAGE CONTENT AGGREGATION.
        $this->oCRNRSTN_UI_ASSEMBLER = new crnrstn_ui_content_assembler($this->oCRNRSTN);

        //
        // SOURCE :: https://www.w3schools.com/cssref/css_units.php
        // DATE :: Thursday, June 22, 2023 @ 0555 hrs.
        $this->css_length_units_ARRAY = array('cm' => 'centimeters', 'mm' => 'millimeters',
        'in' => 'inches (1in = 96px = 2.54cm)', 'px' => 'pixels (1px = 1/96th of 1in)',
        'pt' => 'points (1pt = 1/72 of 1in)', 'pc' => 'picas (1pc = 12 pt)',
        'em' => 'Relative to the font-size of the element (2em means 2 times the size of the current font)',
        'ex' => 'Relative to the x-height of the current font (rarely used)',
        'ch' => 'Relative to the width of the "0" (zero)', 'rem' => 'Relative to font-size of the root element',
        'vw' => 'Relative to 1% of the width of the viewport*', 'vh' => 'Relative to 1% of the height of the viewport*',
        'vmin' => 'Relative to 1% of viewport\'s* smaller dimension',
        'vmax' => 'Relative to 1% of viewport\'s* larger dimension', '%' => 'Relative to the parent element');

	}

    public function out_ui_html_module_system_icon($file_path, $file_meta_ARRAY, $output_mode, $width, $height_override, $hyperlink, $alt, $title, $target){

	    //
        // TODO :: FILE ICON TOOL TIP HOVER POP-UP NAV SHOULD GET FAST LOADING FILE PREVIEW WINDOW INTEGRATIONS.
        // Saturday, September 9, 2023 @ 1621 hrs
        //
        // THIS METHOD RETURNS COMPLEX SYSTEM ICON HTML BASED ON FILE MIME-TYPE/EXT. AS A NOTE FOR DEVELOPMENT,
        // REGARDLESS OF WHATEVER IS SHOWN NEXT TO THIS SYSTEM ICON[THINK FILENAME, SIZE, DATE, OWNER, ETC.]...EVEN
        // JUST FILENAME...THE ~25px ICON ITSELF CONTAINS THE WHOLE APPLICATION. THE ICON'S POP-UP TOOLTIP IS THE
        // ONLY SYSTEM TOUCH POINT THAT CRNRSTN :: HAS FOR FILE AND DIRECTORY MGMT; TRY HARD ON THIS ONE.
        //
        // DESIGN REQUIREMENTS INCLUDE:
        //      - A DISPLAY OF SOME KIND OF POP-UP TOOLTIP MODULE ON MOUSEOVER (DESKTOP) OR INFO-ICON
        //        TOUCH (TABLET, MOBILE). THE MODULE SHOULD HAVE A COMPLETE SET OF DIRECTORY (OR FILE TYPE)
        //        SPECIFIC MENU OPTIONS (SEE CPANEL FILE MGMT). THERE WILL BE ADMIN ONLY FEATURES SUPPORTING ROBUST
        //        FILE MANAGEMENT FEATURES SUCH AS DELETE, EDIT, AND "SYNC SERVICES."
        //      - A POP-UP TOOLTIP EMBEDDED FILE PREVIEW AREA THAT QUICKLY LOADS THE ABSOLUTE BEST AND HIGHEST
        //        HIGHEST QUALITY FILE PREVIEW PER THE CLIENT DEVICE, OS, AND BROWSER. LOAD A HIGH QUALITY SYSTEM
        //        ICON FOR FILES WITH UNSUPPORTED PREVIEW SUCH AS .ZIP, .EXE, ET AL. THIS IS WHERE CRNRSTN :: GETS
        //        TO HTML5 STACK THE SHIT OUT OF <SOURCE> NODES IN <PICTURE>, AND <VIDEO> HTML5 WRAPPERS AS MODUS
        //        OPERANDI. NO USE OF <IMG> HERE, BOYS.
        //      - WHEN THE PREVIEW LINK IS CLICKED, A WHITE LABEL-ABLE AND DEEP LINK-ABLE (SOCIAL SHARE ENABLED)
        //        FILE PREVIEW COMPONENT WITH STANDARDIZED FILE MGMT NAVIGATION, ZEN PRESENTATION OF SOME FILE
        //        META, AND A CLEAN HEADER THAT IS TO LOAD. FOR MOBILE AND TABLET, ABSOLUTELY NONE OF THIS SHOULD
        //        BE AWKWARD.
        //      - ADD VALUE TO LIFE; PROVIDE THE RICHEST EXPERIENCE (PLZ READ AS HEART FEELINGS) POSSIBLE BY USING
        //        SYSTEM INFORMATION FOR THE FILE...LIKE FILE PERMISSIONS...OR SOME OTHER CHEEKY META LIKE CPU LOAD
        //        TO HELP TO MAKE THIS NEW FILE MGMT KIT IN CRNRSTN :: TO BE LOOKING...AND FEELING...REALLY SMART.
        //      - USE THE CRNRSTN :: SOAP-SERVICES REAL-TIME SESSION CAST SERVICES LAYER (SSRT-SCSL) TO SUPPORT
        //        BROWSING CRNRSTN :: JS/CSS FRAMEWORK DIRECTORIES ON ANY SERVER...INCLUDING http://127.0.0.1.
        //        BROWSE THE SERVER FROM ROOT (SPECIFIED IN CONFIG FILE) BEHIND ADMIN AUTHENTICATION.
        //
        // ARCHITECTURAL CONSIDERATIONS:
        //      - PRE-FABRICATE DOM HTML COMPONENTS, AND HIDE THEM IN THE HTML UNTIL THEY ARE NEEDED. WELL,
        //        CRNRSTN :: HAS DONE THIS, IT IS UNINSPIRING, AND WE ALREADY STARTED MOVING AWAY FROM THIS.
        //
        //      - OR, JUST HAVE THE SERVER SEND THE RAW FILE META DATA TO oCRNRSTN_JS, AND BUILD WHATEVER DOM
        //        OBJECT IS NEEDED AT THE CLIENT, AND BUILD IT ON THE FLY. THIS IS WHAT WE HAVE STARTED DOING
        //        MORE RECENTLY. NOTE THIS PROVIDES ZERO EMAIL HTML SUPPORT, AND IT NECESSITATES SOME DUPLICITY
        //        OF WORK FOR UI STANDARDIZATION OF HTML OUTPUT BETWEEN EMAIL AND WEB WITH RESPECT TO CONTENT
        //        THAT IS IN COMMON. WITH THE EMAIL HTML GENERATION LOGIC BEING BURIED IN PHP @ SERVER, AND THE
        //        TOOL-TIP/SHARE-LP PREVIEW LOGIC IN JAVASCRIPT @ CLIENT, THE TWO SIDES WOULD NEVER EVEN TOUCH
        //        BUT NEED TO BE AS ONE.
        //
        //      - OR, SOMETHING IN BETWEEN THE ABOVE TWO CONSIDERATIONS.

        $tmp_str_html_out = '';
        $tmp_test_sprite_hq = '/var/www/html/evifweb.com/_crnrstn/ui/imgs/png/system/_lab_sys_sprite_hq_algorithm_unit_test.png';

        // MIME-TYPE MGMT.
        $missing_mime_type_dir_cnt = 0;
        $missing_file_extension_dir_cnt = 0;
        $tmp_flag_built_dir_ARRAY = array();
        $tmp_sync_mime_type_config = false;     // WHERE true MIGHT ADD NEW MIME-TYPE FOLDERS TO _crnrstn/_config/config.mime_types

        $this->oCRNRSTN->error_log('TODO :: CHECK THAT ALL CSS UNITS (PIXELS) ARE IN SETTINGS/INPUT-PARAMS[?]/THEMES/MULTI-LANG MULTI-BYTE %-BOOST AND NOT THE STATIC FRAMEWORK HTML.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

        /*
        /var/www/html/evifweb.com/_crnrstn/class/crnrstn/crnrstn.inc.php
        -----
        'FAMILY'                        => string 'CRNRSTN_CHANNEL_MODE' (length=19)
        'INTEGER'                       => int 7234
        'STRING'                        => string 'CRNRSTN_ZIP' (length=11)
        'TITLE'                         => string 'ZIP' (length=3)
        'FILE_EXTENSION'                0           => string '.zip' (length=4)
                                        1           => string '.zipx' (length=5)
        'MEDIA_ELEMENT_KEY'             =>
                                        0 => int 7234   // CRNRSTN_ZIP
        'SYSTEM_ICON_LABEL'             => string 'ZIP' (length=3)
        'SYSTEM_ICON_COLOR_CLASS'       => string 'COMPRESSION' (length=11)
        'SYSTEM_ICON_LINE_WEIGHT_CLASS' => string 'HEAVY' (length=5)
        'SYSTEM_ICON_LINE_COLOR_CLASS'  => string '#000' (length=4)

        $tmp_theme_attributes_ARRAY[$int_const]['interact.ui.sprite_icon_thirdparty_tm_is_active'] = 1;
        $this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'override_interact_theme_sprite_icon_thirdparty_tm_is_active', 1, 'CRNRSTN::RESOURCE::SPRITE_ICON');     // [1=ON, 0=OFF]

        */
        if($tmp_sync_mime_type_config !== false){

            $tmp_endpoint_serial = $this->oCRNRSTN->hash($_SERVER['SERVER_ADDR']);
            $tmp_crnrstn_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');

            error_log(__LINE__ . ' ui html mgr BEGIN MANUAL SYNC OF FILE MIME-TYPE. die();');

            //
            // LOAD MIME-TYPE CONFIGURATION SOURCE FILES PATH.
            $mime_type_config_path = CRNRSTN_ROOT . DIRECTORY_SEPARATOR . $tmp_crnrstn_system_directory . DIRECTORY_SEPARATOR . '_config' . DIRECTORY_SEPARATOR . 'config.mime_types';
            if(is_dir($mime_type_config_path) == true){

                //$tmp_asset_handling_serial = $this->oCRNRSTN->generate_new_key(100);

                //
                // RECURSIVELY EXTRACT *ALL* FILES, DIRECTORIES, AND THE APPROPRIATE FILE
                // SYSTEM META THAT IS CONTAINED IN $mime_type_config_path.
                // WHERE $tmp_endpoint_serial = $this->hash($_SERVER['SERVER_ADDR']);
                //$this->oCRNRSTN->scandir_system_integrations($mime_type_config_path);
                error_log(__LINE__ . ' ui html mgr $mime_type_config_path[' . $mime_type_config_path . '].');
                die();

                //
                // CRNRSTN :: FILE SYSTEM PERFORMANCE REPORT.
                $tmp_str_html_out = $this->oCRNRSTN->file_report();

                //
                // BUILD 100% OF THE MIME-TYPE DIRECTORIES ACCORDING TO 100% OF THE FILES.
                // ENSURE THAT THE "CRNRSTN_XXX" DIR FOR THE FILE IS AVAILABLE.
                // HTML OUTPUT ANY FILE MOVEMENT INSTRUCTIONS FROM THE _discovery DIRECTORY.

                /*
                $tmp_control_asset_ARRAY
                -----
                $this->system_integrations_dir_content_touch_ARRAY[$this->request_id][$endpoint_serial][$tmp_path_serial]['DIR_PATH']                   = $dir_path;
                $this->system_integrations_dir_content_touch_ARRAY[$this->request_id][$endpoint_serial][$tmp_path_serial]['TYPE']                       = filetype($dir_path);
                $this->system_integrations_dir_content_touch_ARRAY[$this->request_id][$endpoint_serial][$tmp_path_serial]['FILESIZE'][$name]            = $this->find_filesize($name);
                $this->system_integrations_dir_content_touch_ARRAY[$this->request_id][$endpoint_serial][$dir_path][$tmp_resource_path]['TYPE']          = filetype($dir_path);
                $this->system_integrations_dir_content_touch_ARRAY[$this->request_id][$endpoint_serial][$tmp_path_serial]['UID_INTEGER'][$name]         = $tmp_filestat_ARRAY['uid'];
                $this->system_integrations_dir_content_touch_ARRAY[$this->request_id][$endpoint_serial][$tmp_path_serial]['UID_STRING'][$name]          = $tmp_array['name'];
                $this->system_integrations_dir_content_touch_ARRAY[$this->request_id][$endpoint_serial][$tmp_path_serial]['GID_INT'][$name]             = $tmp_filestat_ARRAY['gid'];
                $this->system_integrations_dir_content_touch_ARRAY[$this->request_id][$endpoint_serial][$tmp_path_serial]['GID_STRING'][$name]          = $tmp_array['name'];
                $this->system_integrations_dir_content_touch_ARRAY[$this->request_id][$endpoint_serial][$tmp_path_serial]['DATE_LASTACCESSED'][$name]   = $tmp_filestat_ARRAY['atime'];
                $this->system_integrations_dir_content_touch_ARRAY[$this->request_id][$endpoint_serial][$tmp_path_serial]['DATE_LASTMODIFIED'][$name]   = $tmp_filestat_ARRAY['mtime'];
                $this->system_integrations_dir_content_touch_ARRAY[$this->request_id][$endpoint_serial][$tmp_path_serial]['BLOCK_SIZE'][$name]          = $tmp_filestat_ARRAY['blksize'];
                $this->system_integrations_dir_content_touch_ARRAY[$this->request_id][$endpoint_serial][$tmp_path_serial]['BLOCK_ALLOCATE'][$name]      = $tmp_filestat_ARRAY['blocks'];
                $this->system_integrations_dir_content_touch_ARRAY[$this->request_id][$endpoint_serial][$tmp_path_serial]['PERMISSIONS_FULL'][$name]    = $this->return_full_permissions($perms);
                $this->system_integrations_dir_content_touch_ARRAY[$this->request_id][$endpoint_serial][$tmp_path_serial]['PERMISSIONS_OCTAL'][$name]   = decoct($perms & 0777);
                $this->system_integrations_dir_content_touch_ARRAY[$this->request_id][$endpoint_serial]['TOTAL_FILESIZE'][]                             = $tmp_results_total_filesize;

                $tmp_control_asset_ARRAY[$tmp_endpoint_serial][$mime_type_config_path][$tmp_resource_path]

                $tmp_endpoint_serial[Array]. system_integrations_dir_content_touch_ARRAY[
                    Array ( [5ca06597ca96fd51e9db52580c3c7c77b2196de456155b1d086de56b0b4ab16e] => Array (
                        [b0e326085976b155bc50921c48762433c2ee0533728cd61bae2e61e29847adad] => Array (
                            [DIR_PATH] => /var/www/html/evifweb.com/_crnrstn/_config/config.mime_types

                            [FILESIZE] => Array ( [/var/www/html/evifweb.com/_crnrstn/_config/config.mime_types/application_x_macbinary] => 0
                            [/var/www/html/evifweb.com/_crnrstn/_config/config.mime_types/application_x_macbinary/CRNRSTN_BIN] => 0
                            [/var/www/html/evifweb.com/_crnrstn/_config/config.mime_types/application_x_macbinary/CRNRSTN_BIN/HelveNeuBlaExtObl.bin] => 46592
                            [/var/www/html/evifweb.com/_crnrstn/_config/config.mime_types/application_x_macbinary/CRNRSTN_BIN/HelveNeuHeaIta.bin] => 30976 [/var/www/html/evifweb.com/_crnrstn/_config/config.mime_types/application_x_macbinary/CRNRSTN_BIN/HelveNeuExtBlaConObl.bin] => 46976
                            [/var/www/html/evifweb.com/_crnrstn/_config/config.mime_types/application_x_macbinary/CRNRSTN_BIN/.] => 0 [/var/www/html/evifweb.com/_crnrstn/_config/config.mime_types/application_x_macbinary/CRNRSTN_BIN/plugincache.bin] => 72512
                            [/var/www/html/evifweb.com/_crnrstn/_config/config.mime_types/application_x_macbinary/CRNRSTN_BIN/CannedText.bin] => 1215 [/var/www/html/evifweb.com/_crnrstn/_config/config.mime_types/application_x_macbinary/CRNRSTN_BIN/en-US_ta.bin] => 651752
                            [/var/www/html/evifweb.com/_crnrstn/_config/config.mime_types/application_x_macbinary/.] => 0 [/var/www/html/evifweb.com/_crnrstn/_config/config.mime_types/application_xhtml_xml] => 0 [/var/www/html/evifweb.com/_crnrstn/_config/config.mime_types/application_xhtml_xml/CRNRSTN_XHTML] => 0 [/var/www/html/evifweb.com/_crnrstn/_config/config.mime_types/application_xhtml_xml/CRNRSTN_XHTML/.] => 0
                            [/var/www/html/evifweb.com/_crnrstn/_config/config.mime_types/application_xhtml_xml/CRNRSTN_XHTML/ImplementationGuide_CNP_TRANKEY.xhtml] => 599390 [/var/www/html/evifweb.com/_crnrstn/_config/config.mime_types/application_xhtml_xml/.] => 0 [/var/www/html/evifweb.com/_crnrstn/_config/config.mime_types/image_gif] => 0
                            [/var/www/html/evifweb.com/_crnrstn/_config/config.mime_types/image_gif/.] => 0
                            [/var/www/html/evifweb.com/_crnrstn/_config/config.mime_types/image_gif/CRNRSTN_GIF] => 0 [/var/www/html/evifweb.com/_crnrstn/_config/config.mime_types/image_gif/CRNRSTN_GIF/.] => 0 [/var/www/html/evifweb.com/_crnrstn/_config/config.mime_types/image_gif/CRNRSTN_GIF/c++boost.gif] => 8819

                */

                //error_log(__LINE__ . ' ui html endpoint_serial[' . print_r($tmp_endpoint_serial, true) . ']. control_asset_ARRAY[' . print_r($tmp_control_asset_ARRAY, true) . ']. die();');
                //$this->oCRNRSTN->concat_log_string($tmp_str_html_out, __LINE__ . ' ui html endpoint_serial[' . print_r($tmp_endpoint_serial, true) . ']. control_asset_ARRAY[' . print_r($tmp_control_asset_ARRAY, true) . '].');

                //$this->oCRNRSTN->concat_log_string($tmp_str_html_out, __LINE__ . ' ui html $tmp_control_asset_ARRAY[' . print_r($tmp_control_asset_ARRAY, true) . '].');

                $this->oCRNRSTN->concat_log_string($tmp_str_html_out, __LINE__ . ' ui html mgr $mime_type_config_path[' . $mime_type_config_path . '].');


                //
                // LOOP THROUGH FILES UNDER.
                //error_log(__LINE__ . ' ui html mgr $tmp_asset_serial[' . $tmp_asset_serial . ']. scan_dir_output_ARRAY[' . print_r($tmp_scan_dir_output_ARRAY, true) . '].');

            }

            //$this->oCRNRSTN->mkdir_r($dirName);      // ($dirName, $mode = 777)
            //
            // STRING OUTPUT = ADD => 'application/vnd.microsoft.portable-executable' => array('.aspx' => 'CRNRSTN_ASPX'),
            // STRING OUTPUT = PUT FILE 'CURR_PATH\file_name.aspx' INTO DIR '\PATH\application_vnd_microsoft_portable_executable'.

            //$tmp_mime_types_touched_ARRAY[$tmp_asset_serial]['MIME-TYPE'][] = '0';
            //$tmp_mime_types_touched_ARRAY[$tmp_asset_serial]['FILENAME'][] = '0';
//
//            foreach($this->oCRNRSTN->asset_routing_data_key_lookup_ARRAY['mime_type'] as $mime_type => $data){
//            //foreach($this->oCRNRSTN->asset_routing_data_key_lookup_ARRAY['mime_type'] as $mime_type => $data){
//
//
//                $tmp_mime_array_str = "'" . $mime_type . "'";
//
//                //
//                // IF NO MIME-TYPE FOLDER EXISTS, PREPARE TO MAKE ALL DIRECTORIES
//                // PER MIME-TYPE AND FILE EXTENSION.
//                $tmp_dir_name_mime_type = $this->oCRNRSTN->str_sanitize($mime_type, 'file_mime_type_to_directory');
//                $tmp_mime_dir_nom = $mime_type_config_path . '/' . $tmp_dir_name_mime_type;
//
//                //
//                // UNCOMMENT TO BUILD FOLDERS.
//                if(!is_dir($tmp_mime_dir_nom)){
//
//                    $this->oCRNRSTN->mkdir_r($tmp_mime_dir_nom);
//
//                }
//
//            }

            $this->oCRNRSTN->concat_log_string($tmp_str_html_out, __LINE__ . ' ui html mgr NEW FOLDERS. MIME[' . $missing_mime_type_dir_cnt . ']. EXT[' . $missing_file_extension_dir_cnt . '].');
            error_log(__LINE__ . ' ui html mgr COMPLETED MANUAL MIME-TYPE SUPPORT SYNC.');

        }

        $tmp_file_mime_type = mime_content_type($file_path);

        $tmp_filename_ARRAY = explode('.', $file_path);
        $tmp_file_extension = array_pop($tmp_filename_ARRAY);

        $this->oCRNRSTN->concat_log_string($tmp_str_html_out, __LINE__ . ' ui html mgr system uname [' . print_r($this->oCRNRSTN->return_system_info('uname'), true) . '].');
        $this->oCRNRSTN->concat_log_string($tmp_str_html_out, __LINE__ . ' ui html mgr system getconf [' . print_r($this->oCRNRSTN->return_system_info('getconf'), true) . '].');
        $this->oCRNRSTN->concat_log_string($tmp_str_html_out, __LINE__ . ' ui html mgr system os_bit_size [' . print_r($this->oCRNRSTN->return_system_info('os_bit_size'), true) . '].');
        $this->oCRNRSTN->concat_log_string($tmp_str_html_out, __LINE__ . ' ui html mgr system lscpu [' . print_r($this->oCRNRSTN->return_system_info('lscpu'), true) . '].');

        $this->oCRNRSTN->concat_log_string($tmp_str_html_out, __LINE__ . ' ui html mgr system file mime_content_type [' . $tmp_file_mime_type . '] file_extension[' . $tmp_file_extension . '].');

        $this->oCRNRSTN->concat_log_string($tmp_str_html_out, __LINE__ . ' ui html mgr $file_meta_ARRAY[' . print_r($file_meta_ARRAY, true) . '].');

        if(!isset($height_override)){

            $tmp_default_icon_height = $this->return_interact_ui_profile_attribute('sprite_icon_height');
            $this->oCRNRSTN->concat_log_string($tmp_str_html_out, __LINE__ . ' ui html mgr loading default icon height [' . $tmp_default_icon_height . '].');

        }else{

            if($height_override == ''){

                $tmp_default_icon_height = $this->return_interact_ui_profile_attribute('sprite_icon_height');
                $this->oCRNRSTN->concat_log_string($tmp_str_html_out, __LINE__ . ' ui html mgr loading default icon height [' . $tmp_default_icon_height . '].');

            }else{

                //
                // CLEAN UGC STRING FOR PIXELS.
                //$height_override = $this->oCRNRSTN->str_sanitize($height_override, 'pixels_to_clean_int');
                $height_override = $this->oCRNRSTN->strrtrim($height_override, ';');

                $this->oCRNRSTN->concat_log_string($tmp_str_html_out, __LINE__ . ' ui html mgr setting default icon height to input param $height_override[' . $height_override . '].');
                $tmp_default_icon_height = $height_override;

            }

        }

        $this->oCRNRSTN->concat_log_string($tmp_str_html_out, __LINE__ . ' ui html mgr loading $file_path[' . $file_path . '].');
        $tmp_asset_meta_ARRAY = $this->oCRNRSTN->asset_data_meta('SYSTEM_SPRITE_HQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

        switch($tmp_asset_meta_ARRAY['asset_family']){
            case 'system':

                //
                // DISABLE CRNRSTN :: ASSET MAPPING (SYSTEM) FOR A SEC.
                $this->oCRNRSTN->concat_log_string($tmp_str_html_out, __LINE__ . ' ui html mgr disabling [' . $tmp_asset_meta_ARRAY['asset_family'] . '] asset mapping.');

                //
                // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                // # # C # R # N # R # S # T # N # : : # # # #
                // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                $this->oCRNRSTN->initialize_bit(CRNRSTN_SYSTEM_IMG_ASSET_MAPPING, false);

                //
                // IMAGE SPRITE HTML SETUP.
                $tmp_sprite_img_str = $this->oCRNRSTN->return_creative('SYSTEM_SPRITE_HQ', CRNRSTN_STRING);

                //
                // RE-ENABLE CRNRSTN :: ASSET MAPPING.
                $this->oCRNRSTN->concat_log_string($tmp_str_html_out, __LINE__ . ' ui html mgr re-enabling [' . $tmp_asset_meta_ARRAY['asset_family'] . '] asset mapping.');

                //
                // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                // # # C # R # N # R # S # T # N # : : # # # #
                // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                $this->oCRNRSTN->initialize_bit(CRNRSTN_SYSTEM_IMG_ASSET_MAPPING, true);

            break;
            case 'social':

                //
                // DISABLE CRNRSTN :: ASSET MAPPING (SOCIAL) FOR A SEC.
                $this->oCRNRSTN->concat_log_string($tmp_str_html_out, __LINE__ . ' ui html mgr disabling [' . $tmp_asset_meta_ARRAY['asset_family'] . '] asset mapping.');

                //
                // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                // # # C # R # N # R # S # T # N # : : # # # #
                // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                $this->oCRNRSTN->initialize_bit(CRNRSTN_SOCIAL_IMG_ASSET_MAPPING, false);

                //
                // IMAGE SPRITE HTML SETUP.
                $tmp_sprite_img_str = $this->oCRNRSTN->return_creative('SYSTEM_SPRITE_HQ', CRNRSTN_STRING);

                //
                // RE-ENABLE CRNRSTN :: ASSET MAPPING.
                $this->oCRNRSTN->concat_log_string($tmp_str_html_out, __LINE__ . ' ui html mgr re-enabling [' . $tmp_asset_meta_ARRAY['asset_family'] . '] asset mapping.');

                //
                // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                // # # C # R # N # R # S # T # N # : : # # # #
                // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                $this->oCRNRSTN->initialize_bit(CRNRSTN_SOCIAL_IMG_ASSET_MAPPING, true);

            break;

        }

        $this->oCRNRSTN->concat_log_string($tmp_str_html_out, __LINE__ . ' ui html mgr replacing [' . $tmp_asset_meta_ARRAY['asset_family'] . '] PNG [' . basename($tmp_sprite_img_str) . '] to [' . basename($tmp_test_sprite_hq) . '].');

        $tmp_sprite_img_str = $tmp_test_sprite_hq;

        list($tmp_width, $tmp_height) = getimagesize($tmp_sprite_img_str);

        $this->oCRNRSTN->concat_log_string($tmp_str_html_out, __LINE__ . ' ui html mgr str[' . $tmp_sprite_img_str . '].');
        $this->oCRNRSTN->concat_log_string($tmp_str_html_out, __LINE__ . ' ui html mgr SPRITE ORIGINAL DIMENSIONS. width[' . $tmp_width . ']. height[' . $tmp_height . '].');
        $this->oCRNRSTN->concat_log_string($tmp_str_html_out, __LINE__ . ' ui html mgr calculating sprite dimensions. Target UGC sourced icon height[' . $tmp_default_icon_height . '].');

        //
        // CALCULATE IMAGE SPRITE DIMENSIONS.
        /*
        TIME FOR MATHS.
        -----
        Thursday, June 15, 2023 0518 hrs.

        CAN WE (OR SHOULD WE AT THIS POINT IN DEV) PROVIDE ADDITIONAL UI DATA POINTS THAT
        ALLOW FOR MOUSE OVER EFFECTS FOR SYSTEM AND SOCIAL SPRITES THAT BEHAVE AS IS
        CURRENTLY WITH THE MULTI-MEDIA BMW M5 LP GALLERY?

        SEE,
        https://www.bmwusa.com/vehicles/m-models/m5-sedan/gallery.html

        -----
        Friday, June 23, 2023 @ 0547 hrs.
        MATHS NOTES:
            - UNTIL THE MATH IS DONE, LEADING TOP (Y) AND LEADING LEFT (X) EDGE SPRITE ICONS
              SHOULD START AT 0. PLACE IMAGES AT X=0 AND Y=0...AND NOT, E.G., X=0.1 OR Y=0.1.

        */

        $tmp_sprite_icon_thirdparty_tm_is_active = $this->return_interact_ui_profile_attribute('sprite_icon_thirdparty_tm_is_active');
        $this->oCRNRSTN->concat_log_string($tmp_str_html_out, __LINE__ . ' ui html mgr sprite profile thirdparty &trade; is_active[' . $tmp_sprite_icon_thirdparty_tm_is_active . '].');

        $tmp_sprite_icon_background_color = $this->return_interact_ui_profile_attribute('sprite_icon_background_color');
        $this->oCRNRSTN->concat_log_string($tmp_str_html_out, __LINE__ . ' ui html mgr sprite profile target icon_background_color[' . $tmp_sprite_icon_background_color . '].');

        $tmp_sprite_icon_mouseout_effect_dimmed_color = $this->return_interact_ui_profile_attribute('sprite_icon_mouseout_effect_dimmed_color');
        $this->oCRNRSTN->concat_log_string($tmp_str_html_out, __LINE__ . ' ui html mgr sprite profile target icon_mouse_response_layer_color[' . $tmp_sprite_icon_mouseout_effect_dimmed_color . '].');

        $tmp_sprite_icon_mouseout_effect_dimmed_color_opacity = $this->return_interact_ui_profile_attribute('sprite_icon_mouseout_effect_dimmed_color_opacity');
        $this->oCRNRSTN->concat_log_string($tmp_str_html_out, __LINE__ . ' ui html mgr sprite profile target icon_mouseout_effect_dimmed_color_opacity[' . $tmp_sprite_icon_mouseout_effect_dimmed_color_opacity . '].');

        $tmp_sprite_icon_mouseover_effect_brighten_color_opacity = $this->return_interact_ui_profile_attribute('sprite_icon_mouseover_effect_brighten_color_opacity');
        $this->oCRNRSTN->concat_log_string($tmp_str_html_out, __LINE__ . ' ui html mgr sprite profile target icon_mouseover_effect_brighten_color_opacity[' . $tmp_sprite_icon_mouseover_effect_brighten_color_opacity . '].');

        $tmp_sprite_icon_mouseover_magnification_zoom = $this->return_interact_ui_profile_attribute('sprite_icon_mouseover_magnification_zoom');
        $this->oCRNRSTN->concat_log_string($tmp_str_html_out, __LINE__ . ' ui html mgr sprite profile target icon_mouseover_magnification_zoom[' . $tmp_sprite_icon_mouseover_magnification_zoom . '].');

        $this->oCRNRSTN->concat_log_string($tmp_str_html_out, '<span style="font-weight: bold; color: #13de14;">' . __LINE__ . ' ui html mgr</span> <br><span style="font-weight: bold; color: #13de14;">TEST ICON SELECTION = &quot;A&quot;</span>');
        $tmp_serial = $this->oCRNRSTN->generate_new_key(32, '01');

        /*
        TARGET ICON HEIGHT: $tmp_default_icon_height = 30

        CALCULATED DATA POINTS:
        -----
            OVERFLOW CONTAINER WIDTH ($tmp_default_icon_width)

            OVERFLOW CONTAINER HEIGHT ($tmp_default_icon_height)

            SPRITE WIDTH ($tmp_sprite_width)

            SPRITE HEIGHT ($tmp_sprite_height)

            SPRITE CSS TOP ($tmp_sprite_top)

            SPRITE CSS LEFT ($tmp_sprite_left)

        -----

        $file_path
        $file_meta_ARRAY
        $output_mode
        $width
        $height_override
        $hyperlink
        $alt
        $title
        $target

        */

        $tmp_sprite_width = 1018;
        $this->oCRNRSTN->ui_css_length_unit_clean($tmp_sprite_width, NULL, false);

        $tmp_sprite_height = 1018;
        $this->oCRNRSTN->ui_css_length_unit_clean($tmp_sprite_height, NULL, false);

        //$tmp_default_icon_height = 50;
        $this->oCRNRSTN->ui_css_length_unit_clean($tmp_default_icon_height);

        $tmp_default_icon_width = 30;
        $this->oCRNRSTN->ui_css_length_unit_clean($tmp_default_icon_width);

        $tmp_sprite_left = 0;
        $this->oCRNRSTN->ui_css_length_unit_clean($tmp_sprite_left);

        $tmp_sprite_top = 0;
        $this->oCRNRSTN->ui_css_length_unit_clean($tmp_sprite_top);

        $cache_vers = $this->oCRNRSTN->resource_filecache_version($tmp_test_sprite_hq);

        $tmp_alt = 'UI sprite (High Quality) test';
        $tmp_title = 'UI wireframe sprite (High Quality) test.';

        $tmp_str_html_out .= '<br>

        <div>
            <div style="float:left; background-color: #F90000; width:' . $tmp_default_icon_width . '; height:' . $tmp_default_icon_height . '; overflow: hidden;"><!-- HIGH CONTRAST LAYER -->

                <div style="position:relative; display:inline-block; width:' . $tmp_default_icon_height . '; height:' . $tmp_default_icon_height . ';">
                    <div id="crnrstn_media_sticky_link_' . $tmp_serial . '" style="position:absolute; width:' . $tmp_default_icon_height . '; height:' . $tmp_default_icon_height . '; cursor:pointer;" onclick="crnrstn_sticky_' . $tmp_serial . '(\'onclick\', \'https://lightsaber.crnrstn.jony5.com/?crnrstn_0010111011=NkMbmCcbqSm9n2cCkxueSTGhut4%252FVjkladK%252FT88e3AB6Mrer1YO4NiYLA2z9Uq5YtLC5&amp;crnrstn_r=g0WHukqPCpOIx%252FD6Fbak16i%252FyZZfwX6%252Fiigls4ps2jhWiPF6hSLF6aQRfVZIUga%252FxFZYyPmkAbUXzB0SEhRIZDOO%252BqS83wEpiE2DBtKNz5yi2QNwkKNSTWd6AOCpLAuIZDHrAKUJzmxsKosjMZ3Jh6OHGwo5AzoZrwZbfuAKCOijxSlLkvez1TKiYfOpULQRcU4xjDa7%252BqDQJPltaXUipkdlC%252BXEr5AvpW7sS0ex592V2PVgB4vmOoAN0ybLmXTKj6q0hXXsAxyB7L25zyHAw9rTSMWAREnFK9cDoY8%252FI5MV%252F3LAwv23kR9jGe3zMVCNuazw9YpRwtX3W87HZJ9wrK%252FmppKoH3Vm&amp;crnrstn_m=facebook_social_media_lnk&amp;crnrstn_encrypt_tunnel=ROGIUUsYtf%252FHalOOgnSg2eP6BYnj%252BOaIn0HlVKsKZ1rELoeMkQzAq3dYXE7cYUK85BrqxDwU\', \'_blank\', this);">

                        <div style="position:relative;">

                            <div style="position:absolute; left:' . $tmp_sprite_left . '; top:' . $tmp_sprite_top . ';">

                                <img src="http://172.16.225.139/evifweb.com/_crnrstn/ui/imgs/png/system/_lab_sys_sprite_hq_algorithm_unit_test.png?crnrstn_=' . $cache_vers . '" width="' . $tmp_sprite_width . '" height="' . $tmp_sprite_height . '" alt="' . $tmp_alt . '" title="' . $tmp_title . '">

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div style="float: left; font-size: 12px; font-family: Courier New, Courier, monospace;">' . basename($file_path) . '</div>
        </div>
    <script>
    function crnrstn_sticky_' . $tmp_serial . '(ux_action, url, target, elem){

        switch(ux_action){
            case \'onmouseover\':

            break;
            case \'onmouseout\':

            break;
            case \'onmousedown\':

            break;
            case \'onmouseup\':

            break;
            case \'onclick\':

                if(url !== \'#\'){

                    window.open(url, target);

                }

            break;

        }

        return false;

    }
    </script>
    <br>';


/*
        $this->oCRNRSTN->concat_log_string($tmp_str_html_out, '<span style="font-weight: bold; color: #F90000;">' . __LINE__ . ' ui html mgr</span><br><span style="font-weight: bold; color: #F90000;">TEST ICON SELECTION = &quot;B&quot;</span>');
        $tmp_serial = $this->oCRNRSTN->generate_new_key(32, '01');
        $tmp_str_html_out .= '<br>
        <div id="crnrstn_media_sticky_link_' . $tmp_serial . '" style="display: inline-block; width:50px; height:' . $tmp_default_icon_height . '; cursor:pointer; overflow: hidden;" onclick="crnrstn_sticky_' . $tmp_serial . '(\'onclick\', \'https://lightsaber.crnrstn.jony5.com/?crnrstn_0010111011=NkMbmCcbqSm9n2cCkxueSTGhut4%252FVjkladK%252FT88e3AB6Mrer1YO4NiYLA2z9Uq5YtLC5&amp;crnrstn_r=g0WHukqPCpOIx%252FD6Fbak16i%252FyZZfwX6%252Fiigls4ps2jhWiPF6hSLF6aQRfVZIUga%252FxFZYyPmkAbUXzB0SEhRIZDOO%252BqS83wEpiE2DBtKNz5yi2QNwkKNSTWd6AOCpLAuIZDHrAKUJzmxsKosjMZ3Jh6OHGwo5AzoZrwZbfuAKCOijxSlLkvez1TKiYfOpULQRcU4xjDa7%252BqDQJPltaXUipkdlC%252BXEr5AvpW7sS0ex592V2PVgB4vmOoAN0ybLmXTKj6q0hXXsAxyB7L25zyHAw9rTSMWAREnFK9cDoY8%252FI5MV%252F3LAwv23kR9jGe3zMVCNuazw9YpRwtX3W87HZJ9wrK%252FmppKoH3Vm&amp;crnrstn_m=facebook_social_media_lnk&amp;crnrstn_encrypt_tunnel=ROGIUUsYtf%252FHalOOgnSg2eP6BYnj%252BOaIn0HlVKsKZ1rELoeMkQzAq3dYXE7cYUK85BrqxDwU\', \'_blank\', this);">
            <div style="position: relative;">
                <div style="position: absolute; left:-55px; top: 0;">
                    <img src="http://172.16.225.139/evifweb.com/_crnrstn/ui/imgs/png/system/_lab_sys_sprite_hq_algorithm_unit_test.png" width="639" height="851" alt="Facebook" title="Link to Facebook related resource.">
                </div>
            </div>
        </div>
    <script>
    function crnrstn_sticky_' . $tmp_serial . '(ux_action, url, target, elem){

        switch(ux_action){
            case \'onmouseover\':

            break;
            case \'onmouseout\':

            break;
            case \'onmousedown\':

            break;
            case \'onmouseup\':

            break;
            case \'onclick\':

                if(url !== \'#\'){

                    window.open(url, target);

                }

            break;

        }

        return false;

    }
    </script>';

        $this->oCRNRSTN->concat_log_string($tmp_str_html_out, '<span style="font-weight: bold; color: #fd8b00;">' . __LINE__ . ' ui html mgr</span><br><span style="font-weight: bold; color: #fd8b00;">TEST ICON SELECTION = &quot;C&quot;</span>');
        $tmp_serial = $this->oCRNRSTN->generate_new_key(32, '01');
        $tmp_str_html_out .= '<br>
        <div id="crnrstn_media_sticky_link_' . $tmp_serial . '" style="display: inline-block; width:50px; height:' . $tmp_default_icon_height . '; cursor:pointer; overflow: hidden;" onclick="crnrstn_sticky_' . $tmp_serial . '(\'onclick\', \'https://lightsaber.crnrstn.jony5.com/?crnrstn_0010111011=NkMbmCcbqSm9n2cCkxueSTGhut4%252FVjkladK%252FT88e3AB6Mrer1YO4NiYLA2z9Uq5YtLC5&amp;crnrstn_r=g0WHukqPCpOIx%252FD6Fbak16i%252FyZZfwX6%252Fiigls4ps2jhWiPF6hSLF6aQRfVZIUga%252FxFZYyPmkAbUXzB0SEhRIZDOO%252BqS83wEpiE2DBtKNz5yi2QNwkKNSTWd6AOCpLAuIZDHrAKUJzmxsKosjMZ3Jh6OHGwo5AzoZrwZbfuAKCOijxSlLkvez1TKiYfOpULQRcU4xjDa7%252BqDQJPltaXUipkdlC%252BXEr5AvpW7sS0ex592V2PVgB4vmOoAN0ybLmXTKj6q0hXXsAxyB7L25zyHAw9rTSMWAREnFK9cDoY8%252FI5MV%252F3LAwv23kR9jGe3zMVCNuazw9YpRwtX3W87HZJ9wrK%252FmppKoH3Vm&amp;crnrstn_m=facebook_social_media_lnk&amp;crnrstn_encrypt_tunnel=ROGIUUsYtf%252FHalOOgnSg2eP6BYnj%252BOaIn0HlVKsKZ1rELoeMkQzAq3dYXE7cYUK85BrqxDwU\', \'_blank\', this);">
            <div style="position: relative;">
                <div style="position: absolute; left:-55px; top: 0;">
                    <img src="http://172.16.225.139/evifweb.com/_crnrstn/ui/imgs/png/system/_lab_sys_sprite_hq_algorithm_unit_test.png" width="639" height="851" alt="Facebook" title="Link to Facebook related resource.">
                </div>
            </div>
        </div>
    <script>
    function crnrstn_sticky_' . $tmp_serial . '(ux_action, url, target, elem){

        switch(ux_action){
            case \'onmouseover\':

            break;
            case \'onmouseout\':

            break;
            case \'onmousedown\':

            break;
            case \'onmouseup\':

            break;
            case \'onclick\':

                if(url !== \'#\'){

                    window.open(url, target);

                }

            break;

        }

        return false;

    }
    </script>';

        $this->oCRNRSTN->concat_log_string($tmp_str_html_out, '<span style="font-weight: bold; color: #c110ec;">' . __LINE__ . ' ui html mgr</span><br><span style="font-weight: bold; color: #c110ec;">TEST ICON SELECTION = &quot;D&quot;</span>');
        $tmp_serial = $this->oCRNRSTN->generate_new_key(32, '01');
        $tmp_str_html_out .= '<br>
        <div id="crnrstn_media_sticky_link_' . $tmp_serial . '" style="display: inline-block; width:50px; height:' . $tmp_default_icon_height . '; cursor:pointer; overflow: hidden;" onclick="crnrstn_sticky_' . $tmp_serial . '(\'onclick\', \'https://lightsaber.crnrstn.jony5.com/?crnrstn_0010111011=NkMbmCcbqSm9n2cCkxueSTGhut4%252FVjkladK%252FT88e3AB6Mrer1YO4NiYLA2z9Uq5YtLC5&amp;crnrstn_r=g0WHukqPCpOIx%252FD6Fbak16i%252FyZZfwX6%252Fiigls4ps2jhWiPF6hSLF6aQRfVZIUga%252FxFZYyPmkAbUXzB0SEhRIZDOO%252BqS83wEpiE2DBtKNz5yi2QNwkKNSTWd6AOCpLAuIZDHrAKUJzmxsKosjMZ3Jh6OHGwo5AzoZrwZbfuAKCOijxSlLkvez1TKiYfOpULQRcU4xjDa7%252BqDQJPltaXUipkdlC%252BXEr5AvpW7sS0ex592V2PVgB4vmOoAN0ybLmXTKj6q0hXXsAxyB7L25zyHAw9rTSMWAREnFK9cDoY8%252FI5MV%252F3LAwv23kR9jGe3zMVCNuazw9YpRwtX3W87HZJ9wrK%252FmppKoH3Vm&amp;crnrstn_m=facebook_social_media_lnk&amp;crnrstn_encrypt_tunnel=ROGIUUsYtf%252FHalOOgnSg2eP6BYnj%252BOaIn0HlVKsKZ1rELoeMkQzAq3dYXE7cYUK85BrqxDwU\', \'_blank\', this);">
            <div style="position: relative;">
                <div style="position: absolute; left:-55px; top: 0;">
                    <img src="http://172.16.225.139/evifweb.com/_crnrstn/ui/imgs/png/system/_lab_sys_sprite_hq_algorithm_unit_test.png" width="639" height="851" alt="Facebook" title="Link to Facebook related resource.">
                </div>
            </div>
        </div>
    <script>
    function crnrstn_sticky_' . $tmp_serial . '(ux_action, url, target, elem){

        switch(ux_action){
            case \'onmouseover\':

            break;
            case \'onmouseout\':

            break;
            case \'onmousedown\':

            break;
            case \'onmouseup\':

            break;
            case \'onclick\':

                if(url !== \'#\'){

                    window.open(url, target);

                }

            break;

        }

        return false;

    }
    </script>';

        $this->oCRNRSTN->concat_log_string($tmp_str_html_out, '<span style="font-weight: bold; color: #0036f9;">' . __LINE__ . ' ui html mgr</span><br><span style="font-weight: bold; color: #0036f9;">TEST ICON SELECTION = &quot;E&quot;</span>');
        $tmp_serial = $this->oCRNRSTN->generate_new_key(32, '01');
        $tmp_str_html_out .= '<br>
        <div id="crnrstn_media_sticky_link_' . $tmp_serial . '" style="display: inline-block; width:50px; height:' . $tmp_default_icon_height . '; cursor:pointer; overflow: hidden;" onclick="crnrstn_sticky_' . $tmp_serial . '(\'onclick\', \'https://lightsaber.crnrstn.jony5.com/?crnrstn_0010111011=NkMbmCcbqSm9n2cCkxueSTGhut4%252FVjkladK%252FT88e3AB6Mrer1YO4NiYLA2z9Uq5YtLC5&amp;crnrstn_r=g0WHukqPCpOIx%252FD6Fbak16i%252FyZZfwX6%252Fiigls4ps2jhWiPF6hSLF6aQRfVZIUga%252FxFZYyPmkAbUXzB0SEhRIZDOO%252BqS83wEpiE2DBtKNz5yi2QNwkKNSTWd6AOCpLAuIZDHrAKUJzmxsKosjMZ3Jh6OHGwo5AzoZrwZbfuAKCOijxSlLkvez1TKiYfOpULQRcU4xjDa7%252BqDQJPltaXUipkdlC%252BXEr5AvpW7sS0ex592V2PVgB4vmOoAN0ybLmXTKj6q0hXXsAxyB7L25zyHAw9rTSMWAREnFK9cDoY8%252FI5MV%252F3LAwv23kR9jGe3zMVCNuazw9YpRwtX3W87HZJ9wrK%252FmppKoH3Vm&amp;crnrstn_m=facebook_social_media_lnk&amp;crnrstn_encrypt_tunnel=ROGIUUsYtf%252FHalOOgnSg2eP6BYnj%252BOaIn0HlVKsKZ1rELoeMkQzAq3dYXE7cYUK85BrqxDwU\', \'_blank\', this);">
            <div style="position: relative;">
                <div style="position: absolute; left:-55px; top: 0;">
                    <img src="http://172.16.225.139/evifweb.com/_crnrstn/ui/imgs/png/system/_lab_sys_sprite_hq_algorithm_unit_test.png" width="639" height="851" alt="Facebook" title="Link to Facebook related resource.">
                </div>
            </div>
        </div>
    <script>
    function crnrstn_sticky_' . $tmp_serial . '(ux_action, url, target, elem){

        switch(ux_action){
            case \'onmouseover\':

            break;
            case \'onmouseout\':

            break;
            case \'onmousedown\':

            break;
            case \'onmouseup\':

            break;
            case \'onclick\':

                if(url !== \'#\'){

                    window.open(url, target);

                }

            break;

        }

        return false;

    }
    </script>';

        $this->oCRNRSTN->concat_log_string($tmp_str_html_out, '<span style="font-weight: bold; color: #15DDD3;">' . __LINE__ . ' ui html mgr</span><br><span style="font-weight: bold; color: #15DDD3;">TEST ICON SELECTION = &quot;F&quot;</span>');
        $tmp_serial = $this->oCRNRSTN->generate_new_key(32, '01');
        $tmp_str_html_out .= '<br>
        <div id="crnrstn_media_sticky_link_' . $tmp_serial . '" style="display: inline-block; width:50px; height:' . $tmp_default_icon_height . '; cursor:pointer; overflow: hidden;" onclick="crnrstn_sticky_' . $tmp_serial . '(\'onclick\', \'https://lightsaber.crnrstn.jony5.com/?crnrstn_0010111011=NkMbmCcbqSm9n2cCkxueSTGhut4%252FVjkladK%252FT88e3AB6Mrer1YO4NiYLA2z9Uq5YtLC5&amp;crnrstn_r=g0WHukqPCpOIx%252FD6Fbak16i%252FyZZfwX6%252Fiigls4ps2jhWiPF6hSLF6aQRfVZIUga%252FxFZYyPmkAbUXzB0SEhRIZDOO%252BqS83wEpiE2DBtKNz5yi2QNwkKNSTWd6AOCpLAuIZDHrAKUJzmxsKosjMZ3Jh6OHGwo5AzoZrwZbfuAKCOijxSlLkvez1TKiYfOpULQRcU4xjDa7%252BqDQJPltaXUipkdlC%252BXEr5AvpW7sS0ex592V2PVgB4vmOoAN0ybLmXTKj6q0hXXsAxyB7L25zyHAw9rTSMWAREnFK9cDoY8%252FI5MV%252F3LAwv23kR9jGe3zMVCNuazw9YpRwtX3W87HZJ9wrK%252FmppKoH3Vm&amp;crnrstn_m=facebook_social_media_lnk&amp;crnrstn_encrypt_tunnel=ROGIUUsYtf%252FHalOOgnSg2eP6BYnj%252BOaIn0HlVKsKZ1rELoeMkQzAq3dYXE7cYUK85BrqxDwU\', \'_blank\', this);">
            <div style="position: relative;">
                <div style="position: absolute; left:-55px; top: 0;">
                    <img src="http://172.16.225.139/evifweb.com/_crnrstn/ui/imgs/png/system/_lab_sys_sprite_hq_algorithm_unit_test.png" width="639" height="851" alt="Facebook" title="Link to Facebook related resource.">
                </div>
            </div>
        </div>
    <script>
    function crnrstn_sticky_' . $tmp_serial . '(ux_action, url, target, elem){

        switch(ux_action){
            case \'onmouseover\':

            break;
            case \'onmouseout\':

            break;
            case \'onmousedown\':

            break;
            case \'onmouseup\':

            break;
            case \'onclick\':

                if(url !== \'#\'){

                    window.open(url, target);

                }

            break;

        }

        return false;

    }
    </script>';

        $this->oCRNRSTN->concat_log_string($tmp_str_html_out, '<span style="font-weight: bold; color: #000;">' . __LINE__ . ' ui html mgr</span><br><span style="font-weight: bold; color: #000000;">TEST ICON SELECTION = &quot;G&quot;</span>');
        $tmp_serial = $this->oCRNRSTN->generate_new_key(32, '01');
        $tmp_str_html_out .= '<br>
        <div id="crnrstn_media_sticky_link_' . $tmp_serial . '" style="display: inline-block; width:50px; height:' . $tmp_default_icon_height . '; cursor:pointer; overflow: hidden;" onclick="crnrstn_sticky_' . $tmp_serial . '(\'onclick\', \'https://lightsaber.crnrstn.jony5.com/?crnrstn_0010111011=NkMbmCcbqSm9n2cCkxueSTGhut4%252FVjkladK%252FT88e3AB6Mrer1YO4NiYLA2z9Uq5YtLC5&amp;crnrstn_r=g0WHukqPCpOIx%252FD6Fbak16i%252FyZZfwX6%252Fiigls4ps2jhWiPF6hSLF6aQRfVZIUga%252FxFZYyPmkAbUXzB0SEhRIZDOO%252BqS83wEpiE2DBtKNz5yi2QNwkKNSTWd6AOCpLAuIZDHrAKUJzmxsKosjMZ3Jh6OHGwo5AzoZrwZbfuAKCOijxSlLkvez1TKiYfOpULQRcU4xjDa7%252BqDQJPltaXUipkdlC%252BXEr5AvpW7sS0ex592V2PVgB4vmOoAN0ybLmXTKj6q0hXXsAxyB7L25zyHAw9rTSMWAREnFK9cDoY8%252FI5MV%252F3LAwv23kR9jGe3zMVCNuazw9YpRwtX3W87HZJ9wrK%252FmppKoH3Vm&amp;crnrstn_m=facebook_social_media_lnk&amp;crnrstn_encrypt_tunnel=ROGIUUsYtf%252FHalOOgnSg2eP6BYnj%252BOaIn0HlVKsKZ1rELoeMkQzAq3dYXE7cYUK85BrqxDwU\', \'_blank\', this);">
            <div style="position: relative;">
                <div style="position: absolute; left:-55px; top: 0;">
                    <img src="http://172.16.225.139/evifweb.com/_crnrstn/ui/imgs/png/system/_lab_sys_sprite_hq_algorithm_unit_test.png" width="639" height="851" alt="Facebook" title="Link to Facebook related resource.">
                </div>
            </div>
        </div>
    <script>
    function crnrstn_sticky_' . $tmp_serial . '(ux_action, url, target, elem){

        switch(ux_action){
            case \'onmouseover\':

            break;
            case \'onmouseout\':

            break;
            case \'onmousedown\':

            break;
            case \'onmouseup\':

            break;
            case \'onclick\':

                if(url !== \'#\'){

                    window.open(url, target);

                }

            break;

        }

        return false;

    }
    </script>';

*/
        return $tmp_str_html_out;

    }

    public function return_interact_ui_profile_attribute($name, $theme_profile_override = NULL){
	
	    /*
        Wednesday, June 21, 2023 @ 0221 hrs

	    */

	    $tmp_str_out = '';
	
	    switch($name){
            case 'sprite_icon_thirdparty_tm_is_active':

                if(isset($theme_profile_override)){

                    //
                    // RETRIEVE ATTRIBUTE DATA FROM THEME OVERRIDE.
                    if(isset($this->oCRNRSTN->theme_attributes_ARRAY[$theme_profile_override])){

                        $tmp_str_out = $this->oCRNRSTN->theme_attributes_ARRAY[$theme_profile_override]['interact.ui.' . $name];

                        //
                        // "BAD/NULL THEME DATA" CHECK. KINDA MOOT, BUT HURT NOT...IT DOES.
                        if(strlen($tmp_str_out) < 1){

                            $tmp_theme_profile = $this->oCRNRSTN->return_interact_ui_theme_profile();

                            $this->oCRNRSTN->error_log('NULL or empty string replaced with default CRNRSTN :: INTERACT UI theme profile [' . $tmp_theme_profile . '] sprite data.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
                            error_log(__LINE__ . ' ui html mgr NULL or empty string replaced with default CRNRSTN :: INTERACT UI theme profile [' . $tmp_theme_profile . '] sprite data.');

                            //
                            // RETRIEVE ATTRIBUTE DATA FROM DEFAULT THEME SETTINGS.
                            $tmp_str_out = $this->oCRNRSTN->theme_attributes_ARRAY[$tmp_theme_profile]['interact.ui.' . $name];

                        }

                        //
                        // OUTPUT [1=ON, 0=OFF].
                        if($this->oCRNRSTN->tidy_boolean($tmp_str_out) == true){

                            return 1;

                        }

                        return 0;

                    }else{

                        //
                        // EMPTY STRING WILL BE RETURNED.
                        $this->oCRNRSTN->error_log('Unknown CRNRSTN :: INTERACT UI theme profile [' . $theme_profile_override . '] sprite data requested.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
                        error_log(__LINE__ . ' ui html mgr Unknown CRNRSTN :: INTERACT UI theme profile [' . $theme_profile_override . '] sprite data requested.');

                    }

                }else{

                    if($this->oCRNRSTN->isset_resource('data_value', 'override_interact_theme_sprite_icon_thirdparty_tm_is_active', 'CRNRSTN::RESOURCE::SPRITE_ICON') == true){

                        //
                        // RETRIEVE ATTRIBUTE DATA FROM OVERRIDE.
                        $tmp_str_out = $this->oCRNRSTN->get_resource('override_interact_theme_sprite_icon_thirdparty_tm_is_active', 0, 'CRNRSTN::RESOURCE::SPRITE_ICON');

                        //
                        // "NULL/EMPTY STRING THEME OVERRIDE SETTINGS DATA" CHECK. WE MUST CHECK.
                        if(strlen($tmp_str_out) < 1){

                            $tmp_theme_profile = $this->oCRNRSTN->return_interact_ui_theme_profile();

                            //
                            // RETRIEVE ATTRIBUTE DATA FROM DEFAULT THEME SETTINGS.
                            $tmp_str_out = $this->oCRNRSTN->theme_attributes_ARRAY[$tmp_theme_profile]['interact.ui.' . $name];

                        }

                        //
                        // OUTPUT [1=ON, 0=OFF].
                        if($this->oCRNRSTN->tidy_boolean($tmp_str_out) == true){

                            return 1;

                        }

                        return 0;

                    }else{

                        $tmp_theme_profile = $this->oCRNRSTN->return_interact_ui_theme_profile();

                        //
                        // RETRIEVE ATTRIBUTE DATA FROM DEFAULT THEME SETTINGS.
                        return $this->oCRNRSTN->theme_attributes_ARRAY[$tmp_theme_profile]['interact.ui.' . $name];

                    }

                }

            break;
            case 'sprite_icon_height':

                if(isset($theme_profile_override)){

                    //
                    // RETRIEVE ATTRIBUTE DATA FROM THEME OVERRIDE.
                    if(isset($this->oCRNRSTN->theme_attributes_ARRAY[$theme_profile_override])){

                        $tmp_str_out = $this->oCRNRSTN->theme_attributes_ARRAY[$theme_profile_override]['interact.ui.' . $name];

                        //
                        // "BAD/NULL THEME DATA" CHECK. KINDA MOOT, BUT HURT NOT...IT DOES.
                        if(strlen($tmp_str_out) < 1){

                            $tmp_theme_profile = $this->oCRNRSTN->return_interact_ui_theme_profile();

                            $this->oCRNRSTN->error_log('NULL or empty string replaced with default CRNRSTN :: INTERACT UI theme profile [' . $tmp_theme_profile . '] sprite data.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
                            error_log(__LINE__ . ' ui html mgr NULL or empty string replaced with default CRNRSTN :: INTERACT UI theme profile [' . $tmp_theme_profile . '] sprite data.');

                            //
                            // RETRIEVE ATTRIBUTE DATA FROM DEFAULT THEME SETTINGS.
                            return $this->oCRNRSTN->theme_attributes_ARRAY[$tmp_theme_profile]['interact.ui.' . $name];

                        }

                        return $tmp_str_out;

                    }else{

                        //
                        // EMPTY STRING WILL BE RETURNED.
                        $this->oCRNRSTN->error_log('Unknown CRNRSTN :: INTERACT UI theme profile [' . $theme_profile_override . '] sprite data requested.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
                        error_log(__LINE__ . ' ui html mgr Unknown CRNRSTN :: INTERACT UI theme profile [' . $theme_profile_override . '] sprite data requested.');

                    }

                }else{

                    if($this->oCRNRSTN->isset_resource('data_value', 'override_interact_theme_sprite_icon_height', 'CRNRSTN::RESOURCE::SPRITE_ICON') == true){

                        //
                        // RETRIEVE ATTRIBUTE DATA FROM OVERRIDE.
                        $tmp_str_out = $this->oCRNRSTN->get_resource('override_interact_theme_sprite_icon_height', 0, 'CRNRSTN::RESOURCE::SPRITE_ICON');

                        //
                        // "NULL/EMPTY STRING THEME OVERRIDE SETTINGS DATA" CHECK. WE MUST CHECK.
                        if(strlen($tmp_str_out) < 1){

                            $tmp_theme_profile = $this->oCRNRSTN->return_interact_ui_theme_profile();

                            //
                            // RETRIEVE ATTRIBUTE DATA FROM DEFAULT THEME SETTINGS.
                            return $this->oCRNRSTN->theme_attributes_ARRAY[$tmp_theme_profile]['interact.ui.' . $name];

                        }

                        return $tmp_str_out;

                    }else{

                        $tmp_theme_profile = $this->oCRNRSTN->return_interact_ui_theme_profile();

                        //
                        // RETRIEVE ATTRIBUTE DATA FROM DEFAULT THEME SETTINGS.
                        return $this->oCRNRSTN->theme_attributes_ARRAY[$tmp_theme_profile]['interact.ui.' . $name];

                    }

                }

            break;
            case 'sprite_icon_background_color':

                if(isset($theme_profile_override)){

                    //
                    // RETRIEVE ATTRIBUTE DATA FROM THEME OVERRIDE.
                    if(isset($this->oCRNRSTN->theme_attributes_ARRAY[$theme_profile_override])){

                        $tmp_str_out = $this->oCRNRSTN->theme_attributes_ARRAY[$theme_profile_override]['interact.ui.' . $name];

                        //
                        // "BAD/NULL THEME DATA" CHECK. KINDA MOOT, BUT HURT NOT...IT DOES.
                        if(strlen($tmp_str_out) < 1){

                            $tmp_theme_profile = $this->oCRNRSTN->return_interact_ui_theme_profile();

                            $this->oCRNRSTN->error_log('NULL or empty string replaced with default CRNRSTN :: INTERACT UI theme profile [' . $tmp_theme_profile . '] sprite data.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
                            error_log(__LINE__ . ' ui html mgr NULL or empty string replaced with default CRNRSTN :: INTERACT UI theme profile [' . $tmp_theme_profile . '] sprite data.');

                            //
                            // RETRIEVE ATTRIBUTE DATA FROM DEFAULT THEME SETTINGS.
                            return $this->oCRNRSTN->theme_attributes_ARRAY[$tmp_theme_profile]['interact.ui.' . $name];

                        }

                        return $tmp_str_out;

                    }else{

                        //
                        // EMPTY STRING WILL BE RETURNED.
                        $this->oCRNRSTN->error_log('Unknown CRNRSTN :: INTERACT UI theme profile [' . $theme_profile_override . '] sprite data requested.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
                        error_log(__LINE__ . ' ui html mgr Unknown CRNRSTN :: INTERACT UI theme profile [' . $theme_profile_override . '] sprite data requested.');

                    }

                }else{

                    if($this->oCRNRSTN->isset_resource('data_value', 'override_interact_theme_sprite_icon_background_color', 'CRNRSTN::RESOURCE::SPRITE_ICON') == true){

                        //
                        // RETRIEVE ATTRIBUTE DATA FROM OVERRIDE.
                        $tmp_str_out = $this->oCRNRSTN->get_resource('override_interact_theme_sprite_icon_background_color', 0, 'CRNRSTN::RESOURCE::SPRITE_ICON');

                        //
                        // "NULL/EMPTY STRING THEME OVERRIDE SETTINGS DATA" CHECK. WE MUST CHECK.
                        if(strlen($tmp_str_out) < 1){

                            $tmp_theme_profile = $this->oCRNRSTN->return_interact_ui_theme_profile('STRING');

                            //error_log(__LINE__ . ' ui html $name[' . $name . ']. [' . print_r($this->oCRNRSTN->theme_attributes_ARRAY, true) . '].');

                            //
                            // RETRIEVE ATTRIBUTE DATA FROM DEFAULT THEME SETTINGS.
                            return $this->oCRNRSTN->theme_attributes_ARRAY[$tmp_theme_profile]['interact.ui.' . $name];

                        }

                        return $tmp_str_out;

                    }else{

                        $tmp_theme_profile = $this->oCRNRSTN->return_interact_ui_theme_profile();

                        //
                        // RETRIEVE ATTRIBUTE DATA FROM DEFAULT THEME SETTINGS.
                        return $this->oCRNRSTN->theme_attributes_ARRAY[$tmp_theme_profile]['interact.ui.' . $name];

                    }

                }

            break;
            case 'sprite_icon_mouseout_effect_dimmed_color':

                if(isset($theme_profile_override)){

                    //
                    // RETRIEVE ATTRIBUTE DATA FROM THEME OVERRIDE.
                    if(isset($this->oCRNRSTN->theme_attributes_ARRAY[$theme_profile_override])){

                        $tmp_str_out = $this->oCRNRSTN->theme_attributes_ARRAY[$theme_profile_override]['interact.ui.' . $name];

                        //
                        // "BAD/NULL THEME DATA" CHECK. KINDA MOOT, BUT HURT NOT...IT DOES.
                        if(strlen($tmp_str_out) < 1){

                            $tmp_theme_profile = $this->oCRNRSTN->return_interact_ui_theme_profile();

                            $this->oCRNRSTN->error_log('NULL or empty string replaced with default CRNRSTN :: INTERACT UI theme profile [' . $tmp_theme_profile . '] sprite data.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
                            error_log(__LINE__ . ' ui html mgr NULL or empty string replaced with default CRNRSTN :: INTERACT UI theme profile [' . $tmp_theme_profile . '] sprite data.');

                            //
                            // RETRIEVE ATTRIBUTE DATA FROM DEFAULT THEME SETTINGS.
                            return $this->oCRNRSTN->theme_attributes_ARRAY[$tmp_theme_profile]['interact.ui.' . $name];

                        }

                        return $tmp_str_out;

                    }else{

                        //
                        // EMPTY STRING WILL BE RETURNED.
                        $this->oCRNRSTN->error_log('Unknown CRNRSTN :: INTERACT UI theme profile [' . $theme_profile_override . '] sprite data requested.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
                        error_log(__LINE__ . ' ui html mgr Unknown CRNRSTN :: INTERACT UI theme profile [' . $theme_profile_override . '] sprite data requested.');

                    }

                }else{

                    if($this->oCRNRSTN->isset_resource('data_value', 'override_interact_theme_sprite_icon_mouseout_effect_dimmed_color', 'CRNRSTN::RESOURCE::SPRITE_ICON') == true){

                        //
                        // RETRIEVE ATTRIBUTE DATA FROM OVERRIDE.
                        $tmp_str_out = $this->oCRNRSTN->get_resource('override_interact_theme_sprite_icon_mouseout_effect_dimmed_color', 0, 'CRNRSTN::RESOURCE::SPRITE_ICON');

                        //
                        // "NULL/EMPTY STRING THEME OVERRIDE SETTINGS DATA" CHECK. WE MUST CHECK.
                        if(strlen($tmp_str_out) < 1){

                            $tmp_theme_profile = $this->oCRNRSTN->return_interact_ui_theme_profile();

                            //
                            // RETRIEVE ATTRIBUTE DATA FROM DEFAULT THEME SETTINGS.
                            return $this->oCRNRSTN->theme_attributes_ARRAY[$tmp_theme_profile]['interact.ui.' . $name];

                        }

                        return $tmp_str_out;

                    }else{

                        $tmp_theme_profile = $this->oCRNRSTN->return_interact_ui_theme_profile();

                        //
                        // RETRIEVE ATTRIBUTE DATA FROM DEFAULT THEME SETTINGS.
                        return $this->oCRNRSTN->theme_attributes_ARRAY[$tmp_theme_profile]['interact.ui.' . $name];

                    }

                }

            break;
            case 'sprite_icon_mouseout_effect_dimmed_color_opacity':

                if(isset($theme_profile_override)){

                    //
                    // RETRIEVE ATTRIBUTE DATA FROM THEME OVERRIDE.
                    if(isset($this->oCRNRSTN->theme_attributes_ARRAY[$theme_profile_override])){

                        $tmp_str_out = $this->oCRNRSTN->theme_attributes_ARRAY[$theme_profile_override]['interact.ui.' . $name];

                        //
                        // "BAD/NULL THEME DATA" CHECK. KINDA MOOT, BUT HURT NOT...IT DOES.
                        if(strlen($tmp_str_out) < 1){

                            $tmp_theme_profile = $this->oCRNRSTN->return_interact_ui_theme_profile();

                            $this->oCRNRSTN->error_log('NULL or empty string replaced with default CRNRSTN :: INTERACT UI theme profile [' . $tmp_theme_profile . '] sprite data.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
                            error_log(__LINE__ . ' ui html mgr NULL or empty string replaced with default CRNRSTN :: INTERACT UI theme profile [' . $tmp_theme_profile . '] sprite data.');

                            //
                            // RETRIEVE ATTRIBUTE DATA FROM DEFAULT THEME SETTINGS.
                            return $this->oCRNRSTN->theme_attributes_ARRAY[$tmp_theme_profile]['interact.ui.' . $name];

                        }

                        return $tmp_str_out;

                    }else{

                        //
                        // EMPTY STRING WILL BE RETURNED.
                        $this->oCRNRSTN->error_log('Unknown CRNRSTN :: INTERACT UI theme profile [' . $theme_profile_override . '] sprite data requested.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
                        error_log(__LINE__ . ' ui html mgr Unknown CRNRSTN :: INTERACT UI theme profile [' . $theme_profile_override . '] sprite data requested.');

                    }

                }else{

                    if($this->oCRNRSTN->isset_resource('data_value', 'override_interact_theme_sprite_icon_mouseout_effect_dimmed_color_opacity', 'CRNRSTN::RESOURCE::SPRITE_ICON') == true){

                        //
                        // RETRIEVE ATTRIBUTE DATA FROM OVERRIDE.
                        $tmp_str_out = $this->oCRNRSTN->get_resource('override_interact_theme_sprite_icon_mouseout_effect_dimmed_color_opacity', 0, 'CRNRSTN::RESOURCE::SPRITE_ICON');

                        //
                        // "NULL/EMPTY STRING THEME OVERRIDE SETTINGS DATA" CHECK. WE MUST CHECK.
                        if(strlen($tmp_str_out) < 1){

                            $tmp_theme_profile = $this->oCRNRSTN->return_interact_ui_theme_profile();

                            //
                            // RETRIEVE ATTRIBUTE FROM DEFAULT THEME SETTINGS.
                            return $this->oCRNRSTN->theme_attributes_ARRAY[$tmp_theme_profile]['interact.ui.' . $name];

                        }

                        return $tmp_str_out;

                    }else{

                        $tmp_theme_profile = $this->oCRNRSTN->return_interact_ui_theme_profile();

                        //
                        // RETRIEVE ATTRIBUTE FROM DEFAULT THEME SETTINGS.
                        return $this->oCRNRSTN->theme_attributes_ARRAY[$tmp_theme_profile]['interact.ui.' . $name];

                    }

                }

            break;
            case 'sprite_icon_mouseover_effect_brighten_color_opacity':

                if(isset($theme_profile_override)){

                    //
                    // RETRIEVE ATTRIBUTE DATA FROM THEME OVERRIDE.
                    if(isset($this->oCRNRSTN->theme_attributes_ARRAY[$theme_profile_override])){

                        $tmp_str_out = $this->oCRNRSTN->theme_attributes_ARRAY[$theme_profile_override]['interact.ui.' . $name];

                        //
                        // "BAD/NULL THEME DATA" CHECK. KINDA MOOT, BUT HURT NOT...IT DOES.
                        if(strlen($tmp_str_out) < 1){

                            $tmp_theme_profile = $this->oCRNRSTN->return_interact_ui_theme_profile();

                            $this->oCRNRSTN->error_log('NULL or empty string replaced with default CRNRSTN :: INTERACT UI theme profile [' . $tmp_theme_profile . '] sprite data.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
                            error_log(__LINE__ . ' ui html mgr NULL or empty string replaced with default CRNRSTN :: INTERACT UI theme profile [' . $tmp_theme_profile . '] sprite data.');

                            //
                            // RETRIEVE ATTRIBUTE DATA FROM DEFAULT THEME SETTINGS.
                            return $this->oCRNRSTN->theme_attributes_ARRAY[$tmp_theme_profile]['interact.ui.' . $name];

                        }

                        return $tmp_str_out;

                    }else{

                        //
                        // EMPTY STRING WILL BE RETURNED.
                        $this->oCRNRSTN->error_log('Unknown CRNRSTN :: INTERACT UI theme profile [' . $theme_profile_override . '] sprite data requested.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
                        error_log(__LINE__ . ' ui html mgr Unknown CRNRSTN :: INTERACT UI theme profile [' . $theme_profile_override . '] sprite data requested.');

                    }

                }else{

                    if($this->oCRNRSTN->isset_resource('data_value', 'override_interact_theme_sprite_icon_mouseover_effect_brighten_color_opacity', 'CRNRSTN::RESOURCE::SPRITE_ICON') == true){

                        //
                        // RETRIEVE ATTRIBUTE DATA FROM OVERRIDE.
                        $tmp_str_out = $this->oCRNRSTN->get_resource('override_interact_theme_sprite_icon_mouseover_effect_brighten_color_opacity', 0, 'CRNRSTN::RESOURCE::SPRITE_ICON');

                        //
                        // "NULL/EMPTY STRING THEME OVERRIDE SETTINGS DATA" CHECK. WE MUST CHECK.
                        if(strlen($tmp_str_out) < 1){

                            $tmp_theme_profile = $this->oCRNRSTN->return_interact_ui_theme_profile();

                            //
                            // RETRIEVE ATTRIBUTE DATA FROM DEFAULT THEME SETTINGS.
                            return $this->oCRNRSTN->theme_attributes_ARRAY[$tmp_theme_profile]['interact.ui.' . $name];

                        }

                        return $tmp_str_out;

                    }else{

                        $tmp_theme_profile = $this->oCRNRSTN->return_interact_ui_theme_profile();

                        //
                        // RETRIEVE ATTRIBUTE DATA FROM DEFAULT THEME SETTINGS.
                        return $this->oCRNRSTN->theme_attributes_ARRAY[$tmp_theme_profile]['interact.ui.' . $name];

                    }

                }

            break;
            case 'sprite_icon_mouseover_magnification_zoom':

                if(isset($theme_profile_override)){

                    //
                    // RETRIEVE ATTRIBUTE DATA FROM THEME OVERRIDE.
                    if(isset($this->oCRNRSTN->theme_attributes_ARRAY[$theme_profile_override])){

                        $tmp_str_out = $this->oCRNRSTN->theme_attributes_ARRAY[$theme_profile_override]['interact.ui.' . $name];

                        //
                        // "BAD/NULL THEME DATA" CHECK. KINDA MOOT, BUT HURT NOT...IT DOES.
                        if(strlen($tmp_str_out) < 1){

                            $tmp_theme_profile = $this->oCRNRSTN->return_interact_ui_theme_profile();

                            $this->oCRNRSTN->error_log('NULL or empty string replaced with default CRNRSTN :: INTERACT UI theme profile [' . $tmp_theme_profile . '] sprite data.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
                            error_log(__LINE__ . ' ui html mgr NULL or empty string replaced with default CRNRSTN :: INTERACT UI theme profile [' . $tmp_theme_profile . '] sprite data.');

                            //
                            // RETRIEVE ATTRIBUTE DATA FROM DEFAULT THEME SETTINGS.
                            return $this->oCRNRSTN->theme_attributes_ARRAY[$tmp_theme_profile]['interact.ui.' . $name];

                        }

                        return $tmp_str_out;

                    }else{

                        //
                        // EMPTY STRING WILL BE RETURNED.
                        $this->oCRNRSTN->error_log('Unknown CRNRSTN :: INTERACT UI theme profile [' . $theme_profile_override . '] sprite data requested.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
                        error_log(__LINE__ . ' ui html mgr Unknown CRNRSTN :: INTERACT UI theme profile [' . $theme_profile_override . '] sprite data requested.');

                    }

                }else{

                    if($this->oCRNRSTN->isset_resource('data_value', 'override_interact_theme_sprite_icon_mouseover_effect_magnification_zoom_percent', 'CRNRSTN::RESOURCE::SPRITE_ICON') == true){

                        //
                        // RETRIEVE ATTRIBUTE DATA FROM OVERRIDE.
                        $tmp_str_out = $this->oCRNRSTN->get_resource('override_interact_theme_sprite_icon_mouseover_effect_magnification_zoom_percent', 0, 'CRNRSTN::RESOURCE::SPRITE_ICON');

                        //
                        // "NULL/EMPTY STRING THEME OVERRIDE SETTINGS DATA" CHECK. WE MUST CHECK.
                        if(strlen($tmp_str_out) < 1){

                            $tmp_theme_profile = $this->oCRNRSTN->return_interact_ui_theme_profile();

                            //
                            // RETRIEVE ATTRIBUTE DATA FROM DEFAULT THEME SETTINGS.
                            return $this->oCRNRSTN->theme_attributes_ARRAY[$tmp_theme_profile]['interact.ui.' . $name];

                        }

                        return $tmp_str_out;

                    }else{

                        $tmp_theme_profile = $this->oCRNRSTN->return_interact_ui_theme_profile();

                        //
                        // RETRIEVE ATTRIBUTE FROM DEFAULT THEME SETTINGS.
                        return $this->oCRNRSTN->theme_attributes_ARRAY[$tmp_theme_profile]['interact.ui.' . $name];

                    }

                }

            break;
            default:

                $this->oCRNRSTN->error_log('Unknown CRNRSTN :: INTERACT UI profile attribute [' . $name . '] data requested.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
                error_log(__LINE__ . ' ui html mgr Unknown CRNRSTN :: INTERACT UI profile attribute [' . $name . '] data requested.');

            break;
	
        }

        return $tmp_str_out;
	
    }

    public function return_output_CRNRSTN_UI_DOCS_NAV_LINK($content_type, $output_type = 'HTML'){

	    if($output_type == 'array'){

	        if(count($this->docs_nav_link_ARRAY) > 0){

	            return $this->docs_nav_link_ARRAY;

            }

        }

	    if(strlen($this->docs_nav_html) > 0 && $output_type == 'HTML'){

	        return $this->docs_nav_html;

        }

        $tmp_str = '';
        $tmp_data_type_family = 'CRNRSTN::RESOURCE::INTERACT_UI::DOCUMENTATION_NAV';

        $tmp_nav_cnt = $this->oCRNRSTN->get_resource_count('CRNRSTN_NAV_LINK', $tmp_data_type_family);
	    if($tmp_nav_cnt < 1){

            $directory = CRNRSTN_ROOT . '/_crnrstn/ui/docs/documentation/' . $content_type . '/';

            $scanned_directory_ARRAY = $this->oCRNRSTN->better_scandir($directory);

            //
            // SOURCE :: https://www.php.net/manual/en/function.scandir.php
            // AUTHOR :: dwieeb at gmail dot com :: https://www.php.net/manual/en/function.scandir.php#107215
            $scanned_directory_ARRAY = array_diff($scanned_directory_ARRAY, array('..', '.', 'index.php'));

            foreach($scanned_directory_ARRAY as $index => $dir_resource){

                $tmp_data_key = 'CRNRSTN_NAV_LINK';
                $this->oCRNRSTN->add_resource($tmp_data_key, $dir_resource, $tmp_data_type_family);

                if(!$this->oCRNRSTN->tmp_restrict_this_lorem_ipsum_method($dir_resource)){

                    $this->docs_nav_link_ARRAY[$dir_resource] = 1;

                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

                        $this->docs_nav_html .= '<li><a rel="crnrstn_documentation_side_nav_' . $this->oCRNRSTN->session_salt() . '" data-crnrstn="' . $dir_resource . '" id="crnrstn_text_lnk_' . $this->oCRNRSTN->hash($dir_resource, 'md5') . '" href="#' . $dir_resource . '" title="' . $dir_resource . '">' . $dir_resource . '</a></li>';

                    }else{

                        $this->docs_nav_html .= '
                <li><a rel="crnrstn_documentation_side_nav_' . $this->oCRNRSTN->session_salt() . '" data-crnrstn="' . $dir_resource . '" id="crnrstn_text_lnk_' . $this->oCRNRSTN->hash($dir_resource, 'md5') . '" href="#' . $dir_resource . '" title="' . $dir_resource . '">' . $dir_resource . '</a></li>';

                    }

                }

            }

            if($output_type == 'array'){

                return $this->docs_nav_link_ARRAY;

            }

            $this->oCRNRSTN->add_resource('DOCUMENTATION_NAV_COMPONENT_HTML', $this->docs_nav_html, $tmp_data_type_family);

            return $this->docs_nav_html;

        }

	    for($i = 0; $i < $tmp_nav_cnt; $i++){

            $dir_resource = $this->oCRNRSTN->get_resource('CRNRSTN_NAV_LINK', $i, $tmp_data_type_family);

            if(!$this->oCRNRSTN->tmp_restrict_this_lorem_ipsum_method($dir_resource)){

                $this->docs_nav_link_ARRAY[$dir_resource] = 1;

                if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

                    $this->docs_nav_html .= '<li><a rel="crnrstn_documentation_side_nav_' . $this->oCRNRSTN->session_salt() . '" data-crnrstn="' . $dir_resource . '" id="crnrstn_text_lnk_' . $this->oCRNRSTN->hash($dir_resource, 'md5') . '" href="#' . $dir_resource . '" title="' . $dir_resource . '">' . $dir_resource . '</a></li>';

                }else{

                    $this->docs_nav_html .= '
                <li><a rel="crnrstn_documentation_side_nav_' . $this->oCRNRSTN->session_salt() . '" data-crnrstn="' . $dir_resource . '" id="crnrstn_text_lnk_' . $this->oCRNRSTN->hash($dir_resource, 'md5') . '" href="#' . $dir_resource . '" title="' . $dir_resource . '">' . $dir_resource . '</a></li>';

                }

            }

        }

        return $this->docs_nav_html;

    }

    public function out_ui_module_html_system_mit_license(){

        //
        // CRNRSTN :: MEMORY USAGE PERFORMANCE REPORTING.
        $tmp_text_break = '.
';

        $mem_report_queue = $this->oCRNRSTN->get_resource('mem_rpt_mit_license_modal', 0, 'CRNRSTN::RESOURCE::REPORTING');
        $tmp_mem_str = $this->oCRNRSTN->mem_report($mem_report_queue, 'TEXT', 10, false, true, $tmp_text_break, '<br>');

        $tmp_module_page_key = $this->oCRNRSTN->oDATA_TUNNEL_SERVICES_MGR->return_received_data('crnrstn_interact_ui_link_text_click');

        if(strlen($tmp_module_page_key) > 0){

            if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

                $tmp_mit_license = '<div class="crnrstn_mit_license_hdr_branding_shell"><div class="crnrstn_env_select_wrapper"><div class="crnrstn_env_select_component_wrapper"><select name="crnrstn_host_endpoint" style="height: 15px; font-size: 11px; display:inline;"><option value="0">-</option><option value="7">Apache v' . $this->oCRNRSTN->version_apache() . '</option><option value="8">MySQLi v' . $this->oCRNRSTN->version_mysqli() . '</option><option value="9">PHP v' . $this->oCRNRSTN->version_php() . '</option></select></div><div class="crnrstn_cb"></div><div class="crnrstn_static_hdr_branding_shell"><div class="crnrstn_static_hdr_branding_copy">C<span class="the_R_in_crnrstn">R</span>NRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . '</div></div></div><div class="crnrstn_dyn_branding_elem_wrapper signin"><div class="crnrstn_dyn_branding_elem_shell">' . $this->oCRNRSTN->return_branding_creative(true, CRNRSTN_HTML) . '</div></div><div class="crnrstn_cb_5"></div></div><div class="crnrstn_section_outter_wrapper signin"><div class="crnrstn_section_inner_wrapper signin"><div class="crnrstn_signin_meta_time_stats_wrapper"><div class="crnrstn_signin_meta_time_stats">[' . $this->oCRNRSTN->return_micro_time() . ' ' . date('T') . '] [rtime ' . $this->oCRNRSTN->wall_time() . ' secs]</div><div class="crnrstn_signin_meta_5_logo">' . $this->oCRNRSTN->return_creative('FIVE', CRNRSTN_HTML) . '</div><div class="crnrstn_signin_backdrop_logo">' . $this->oCRNRSTN->return_system_image('CRNRSTN_LOGO','', 250, '', '', '', '', CRNRSTN_HTML) . '</div><div class="crnrstn_cb"></div></div><div class="crnrstn_cb"></div><div class="crnrstn_signin_form_outter_wrapper"><div class="crnrstn_signin_form_inner_wrapper crnrstn_mit_landing"><div class="crnrstn_signin_form_inner_wrapper_rel"><div class="crnrstn_mit_license_wrapper">
<code><pre>MIT License

Copyright (c) 2012-' . date('Y') . ' Jonathan \'J5\' Harris

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
</pre></code></div></div></div></div></div></div><div class="crnrstn_cb_40"></div>';

            }else{

                $tmp_mit_license = '<div class="crnrstn_mit_license_hdr_branding_shell">
            <div class="crnrstn_env_select_wrapper">
                <div class="crnrstn_env_select_component_wrapper">
                    <select name="crnrstn_host_endpoint" style="height: 15px; font-size: 11px; display:inline;">
                        <option value="0">-</option>
                        <option value="7">Apache v' . $this->oCRNRSTN->version_apache() . '</option>
                        <option value="8">MySQLi v' . $this->oCRNRSTN->version_mysqli() . '</option>
                        <option value="9">PHP v' . $this->oCRNRSTN->version_php() . '</option>
                    </select>

                </div>
                <div class="crnrstn_cb"></div>

                <div class="crnrstn_static_hdr_branding_shell">
                    <div class="crnrstn_static_hdr_branding_copy">C<span class="the_R_in_crnrstn">R</span>NRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . '</div>
                </div>

            </div>

            <div class="crnrstn_dyn_branding_elem_wrapper signin">
                <div class="crnrstn_dyn_branding_elem_shell">' . $this->oCRNRSTN->return_branding_creative(true, CRNRSTN_HTML) . '</div>
            </div>

                <div class="crnrstn_cb_5"></div>

        </div>

        <div class="crnrstn_section_outter_wrapper signin">
            <div class="crnrstn_section_inner_wrapper signin">

                <div class="crnrstn_signin_meta_time_stats_wrapper">

                    <div class="crnrstn_signin_meta_time_stats">[' . $this->oCRNRSTN->return_micro_time() . ' ' . date('T') . '] [rtime ' . $this->oCRNRSTN->wall_time() . ' secs]</div>
                    <div class="crnrstn_signin_meta_5_logo">' . $this->oCRNRSTN->return_creative('FIVE', CRNRSTN_HTML) . '</div>

                    <div class="crnrstn_signin_backdrop_logo">' . $this->oCRNRSTN->return_system_image('CRNRSTN_LOGO','', 250, '', '', '', '', CRNRSTN_HTML) . '</div>

                    <div class="crnrstn_cb_40"></div>
                    <div class="crnrstn_signin_meta_time_stats" style="width: 600px;">' . $tmp_mem_str . '</div>
                </div>

                <div class="crnrstn_cb"></div>

                <div class="crnrstn_signin_form_outter_wrapper">

                    <div class="crnrstn_signin_form_inner_wrapper crnrstn_mit_landing">

                        <div class="crnrstn_signin_form_inner_wrapper_rel">

                            <div class="crnrstn_mit_license_wrapper">
                                <code><pre>MIT License

Cpyright (c) 2012-' . date('Y') . ' Jonathan \'J5\' Harris

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
</pre></code>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>
        <div class="crnrstn_cb_40"></div>';

            }

            if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

                $tmp_html_out = '<div class="crnrstn_lightbox_body_wrapper"><div class="crnrstn_lightbox_content_shell"><div class="crnrstn_mit_license_module_wrap_s3"><div class="crnrstn_mit_license_module_border_rel"><div class="crnrstn_mit_license_module_border"><div class="crnrstn_hidden_void"><div class="crnrstn_mit_license_module_content">' . $tmp_mit_license . '</div></div></div></div><div class="crnrstn_mit_license_module_wrap_s2_outter"><div class="crnrstn_mit_license_module_wrap_s2_inner"><div class="crnrstn_mit_license_module_bg_rel"><div class="crnrstn_mit_license_module_wrap_s1_rel"><div class="crnrstn_mit_license_module_wrap_s1"><div class="crnrstn_mit_license_module_content">' . $tmp_mit_license . '</div></div><div class="crnrstn_documentation_dyn_content_module_bg"></div><div class="crnrstn_hidden_void"><div class="crnrstn_mit_license_module_content">' . $tmp_mit_license . '</div></div></div></div></div></div></div></div></div>';

            }else{

                $tmp_html_out = '<div class="crnrstn_lightbox_body_wrapper">
            <div class="crnrstn_lightbox_content_shell">

                <div class="crnrstn_mit_license_module_wrap_s3">

                    <div class="crnrstn_mit_license_module_border_rel">
                        <div class="crnrstn_mit_license_module_border">
                            <div class="crnrstn_hidden_void">
                                <div class="crnrstn_mit_license_module_content">' . $tmp_mit_license . '</div>

                            </div>
                        </div>
                    </div>

                    <div class="crnrstn_mit_license_module_wrap_s2_outter">
                        <div class="crnrstn_mit_license_module_wrap_s2_inner">

                            <div class="crnrstn_mit_license_module_bg_rel">

                                <div class="crnrstn_mit_license_module_wrap_s1_rel">

                                    <div class="crnrstn_mit_license_module_wrap_s1">

                                        <div class="crnrstn_mit_license_module_content">' . $tmp_mit_license . '</div>

                                    </div>

                                    <div class="crnrstn_documentation_dyn_content_module_bg"></div>

                                    <div class="crnrstn_hidden_void">
                                        <div class="crnrstn_mit_license_module_content">' . $tmp_mit_license . '</div>

                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                </div>
        </div>';

            }

            return $tmp_html_out;

        }

        return '';

    }

    public function sauce($resource){

	    return $this->oCRNRSTN_UI_ASSEMBLER->sauce($resource);

    }

    public function out_ui_module_html_system_documentation_page($module_key_override = NULL){

	    error_log(__LINE__ . ' ui html $module_key_override[' . $module_key_override . '].');
        $this->page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page_content($module_key_override);

        //die();
        //
        // SEARCH INTEGRATION
        //$this->oCRNRSTN_UI_ASSEMBLER->index_page();

        $tmp_html_out = $this->oCRNRSTN_UI_ASSEMBLER->return_page_html($this->page_serial);

        return $tmp_html_out;

    }

    public function out_ui_module_html_system_documentation_nav($content_type = 'php'){

        if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

            $tmp_html_out = '<div id="crnrstn_interact_ui_side_nav_search" class="crnrstn_interact_ui_side_nav_search" onmouseover="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseout\', this);" onclick="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onclick\', this);"><div id="crnrstn_interact_ui_side_nav_search_img_bg" class="crnrstn_interact_ui_bg_layer" style="width:2000px; height:2000px;"></div><div class="crnrstn_interact_ui_side_nav_search_bar_rel"><div id="crnrstn_interact_ui_side_nav_search_bar" class="crnrstn_interact_ui_side_nav_search_bar"></div></div><div id="crnrstn_interact_ui_side_nav_search_img_wrapper" class="crnrstn_interact_ui_side_nav_v_img_wrapper"><div id="crnrstn_interact_ui_side_nav_search_img_rel" class="crnrstn_interact_ui_side_nav_search_img_rel" style="width:35px; height:26px;"><div id="crnrstn_interact_ui_side_nav_search_img" class="crnrstn_interact_ui_side_nav_search_img">' . $this->oCRNRSTN->return_system_image('SEARCH_MAGNIFY_GLASS','', 20, NULL, NULL, NULL, NULL, CRNRSTN_HTML) . '</div><div class="crnrstn_cb"></div></div><div class="crnrstn_cb"></div></div><div class="crnrstn_cb"></div></div><div id="crnrstn_interact_ui_side_nav_logo" class="crnrstn_interact_ui_side_nav_logo" onmouseover="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseout\', this);" onclick="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onclick\', this);"><div id="crnrstn_interact_ui_side_nav_logo_img_bg" class="crnrstn_interact_ui_bg_layer" style="width:2000px; height:2000px;"></div><div class="crnrstn_interact_ui_side_nav_logo_bar_rel"><div id="crnrstn_interact_ui_side_nav_logo_bar" class="crnrstn_interact_ui_side_nav_logo_bar"></div></div><div id="crnrstn_interact_ui_side_nav_logo_img_wrapper" class="crnrstn_interact_ui_side_nav_logo_img_wrapper"><div id="crnrstn_interact_ui_side_nav_logo_img_rel" class="crnrstn_interact_ui_side_nav_logo_img_rel" style="width:80px; height:50px;"><div id="crnrstn_interact_ui_side_nav_logo_img" class="crnrstn_interact_ui_side_nav_logo_img">' . $this->oCRNRSTN->return_system_image('CRNRSTN_LOGO', '', 40, '', '', '', '', CRNRSTN_HTML) . '</div><div class="crnrstn_cb"></div></div><div class="crnrstn_cb"></div></div><div class="crnrstn_cb"></div></div><nav id="crnrstn_interact_ui_side_nav" class="crnrstn_interact_ui_side_nav"><!-- SOURCE :: https://www.w3schools.com/howto/howto_css_fixed_sidebar.asp --><ul>' . $this->return_output_CRNRSTN_UI_DOCS_NAV_LINK($content_type) . '</ul><div class="crnrstn_cb_20"></div><div class="crnrstn_interact_ui_side_nav_5">' . $this->oCRNRSTN->return_system_image('FIVE', 30, 30, '', '', '', '', CRNRSTN_HTML) . '</div><div class="crnrstn_cb_100"></div></nav></div>';

        }else{

            $tmp_html_out = '<div id="crnrstn_interact_ui_side_nav_search" class="crnrstn_interact_ui_side_nav_search" onmouseover="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseout\', this);" onclick="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onclick\', this);">

                <div id="crnrstn_interact_ui_side_nav_search_img_bg" class="crnrstn_interact_ui_bg_layer" style="width:2000px; height:2000px;"></div>

                <div class="crnrstn_interact_ui_side_nav_search_bar_rel">
                    <div id="crnrstn_interact_ui_side_nav_search_bar" class="crnrstn_interact_ui_side_nav_search_bar"></div>
                </div>

                <div id="crnrstn_interact_ui_side_nav_search_img_wrapper" class="crnrstn_interact_ui_side_nav_v_img_wrapper">

                    <div id="crnrstn_interact_ui_side_nav_search_img_rel" class="crnrstn_interact_ui_side_nav_search_img_rel" style="width:35px; height:26px;">

                        <div id="crnrstn_interact_ui_side_nav_search_img" class="crnrstn_interact_ui_side_nav_search_img">' . $this->oCRNRSTN->return_system_image('SEARCH_MAGNIFY_GLASS','', 20, NULL, NULL, NULL, NULL, CRNRSTN_HTML) . '</div>
                        <div class="crnrstn_cb"></div>

                    </div>
                    <div class="crnrstn_cb"></div>

                </div>
                <div class="crnrstn_cb"></div>

            </div>

            <div id="crnrstn_interact_ui_side_nav_logo" class="crnrstn_interact_ui_side_nav_logo" onmouseover="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseout\', this);" onclick="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onclick\', this);">

                <div id="crnrstn_interact_ui_side_nav_logo_img_bg" class="crnrstn_interact_ui_bg_layer" style="width:2000px; height:2000px;"></div>

                <div class="crnrstn_interact_ui_side_nav_logo_bar_rel">
                    <div id="crnrstn_interact_ui_side_nav_logo_bar" class="crnrstn_interact_ui_side_nav_logo_bar"></div>
                </div>

                <div id="crnrstn_interact_ui_side_nav_logo_img_wrapper" class="crnrstn_interact_ui_side_nav_logo_img_wrapper">

                    <div id="crnrstn_interact_ui_side_nav_logo_img_rel" class="crnrstn_interact_ui_side_nav_logo_img_rel" style="width:80px; height:50px;">

                        <div id="crnrstn_interact_ui_side_nav_logo_img" class="crnrstn_interact_ui_side_nav_logo_img">' . $this->oCRNRSTN->return_system_image('CRNRSTN_LOGO', '', 40, '', '', '', '', CRNRSTN_HTML) . '</div>
                        <div class="crnrstn_cb"></div>

                    </div>
                    <div class="crnrstn_cb"></div>
                </div>
            <div class="crnrstn_cb"></div>
            </div>

            <div id="crnrstn_interact_ui_side_nav" class="crnrstn_interact_ui_side_nav">
                <!-- SOURCE :: https://www.w3schools.com/howto/howto_css_fixed_sidebar.asp -->
                <ul>' . $this->return_output_CRNRSTN_UI_DOCS_NAV_LINK($content_type) . '
                </ul>
                <div class="crnrstn_cb_20"></div>
                <div class="crnrstn_interact_ui_side_nav_5">' . $this->oCRNRSTN->return_system_image('FIVE', 30, 30, '', '', '', '', CRNRSTN_HTML) . '</div>

                <div class="crnrstn_cb_100"></div>

           </div>

        </div>';

        }


        return $tmp_html_out;

    }

    public function out_ui_module_html_system_footer_content_container(){

	    $tmp_framework_link_value = $this->oCRNRSTN->oDATA_TUNNEL_SERVICES_MGR->return_received_data('crnrstn_interact_ui_link_text_click');

	    $tmp_string_constant_ARRAY = explode('|', $tmp_framework_link_value);

	    if(!isset($tmp_string_constant_ARRAY[1])){

            //
            // MISSING PIPE DELIMITED SITUATION, FOR SOME REASON.
	        return '';

        }

	    $tmp_resource_constant = $this->oCRNRSTN->return_int_const_profile($tmp_string_constant_ARRAY[1], 'DESCRIPTION');
        $tmp_text_break = '.
';

        $mem_report_queue = $this->oCRNRSTN->get_resource('mem_rpt_general_system_footer', 0, 'CRNRSTN::RESOURCE::REPORTING');
        $tmp_mem_str = $this->oCRNRSTN->mem_report($mem_report_queue, 'TEXT', 10, false, true, $tmp_text_break, '<br>');

        $tmp_html_out = '<div id="crnrstn_ui_system_footer_content_container_wrapper" class="crnrstn_ui_system_footer_content_container_wrapper">

            <div class="crnrstn_ui_system_footer_rel">

                <div id="crnrstn_ui_system_footer_content_container" class="crnrstn_ui_system_footer">

                        <div class="crnrstn_ui_system_footer_content">
                            <div id="crnrstn_ui_system_footer_content_container_stache" class="crnrstn_ui_system_footer_stache">' . $this->oCRNRSTN->return_system_image('STACHE','', 17, NULL, NULL, NULL, NULL, CRNRSTN_HTML) . '</div>

                            <div id="crnrstn_ui_system_footer_content_container_mit" class="crnrstn_ui_system_footer_mit"><a id="crnrstn_ui_system_footer_content_container_mit_lnk" href="#" onclick="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onclick\', this);" target="_self">' . $this->oCRNRSTN->multi_lang_content_return('COPY_ALL_RIGHTS_PART_MIT') . '</a></div>
                            <div id="crnrstn_ui_system_footer_content_container_download" class="crnrstn_ui_system_footer_download"><a style="font-family: Courier New, Courier, monospace; font-size:12px; line-height: 20px;" href="'. $this->oCRNRSTN->return_sticky_link('https://github.com/jony5/CRNRSTN-v2.00.0000-PRE-ALPHA-DEV-Lightsaber', 'crnrstn_text_lnk_download') .'" target="_blank">' . $this->oCRNRSTN->multi_lang_content_return('LNK_DOWNLOAD_TXT_FOOTER') . '</a></div>
                            <div class="crnrstn_ui_system_footer_stats_wrapper">
                                <div id="crnrstn_ui_system_footer_content_container_mem_report" class="crnrstn_ui_system_footer_stat">' . $tmp_mem_str . '</div>
                                <div id="crnrstn_ui_system_footer_content_container_stat_stime" class="crnrstn_ui_system_footer_stat">[' . $this->oCRNRSTN->return_micro_time() . ']</div>
                                <div id="crnrstn_ui_system_footer_content_container_stat_rtime" class="crnrstn_ui_system_footer_stat">[rtime ' . $this->oCRNRSTN->wall_time() . ' secs]</div>
                                <div id="crnrstn_ui_system_footer_content_container_stat_wtime" class="crnrstn_ui_system_footer_stat">[' . $tmp_resource_constant . ']</div>
                                <div id="crnrstn_ui_system_footer_content_container_stat_meta" class="crnrstn_ui_system_footer_stat"></div>
                            </div>

                            <div class="crnrstn_ui_system_footer_5">' . $this->oCRNRSTN->return_system_image('FIVE', 20, 20, NULL, NULL, NULL, NULL, CRNRSTN_HTML) . '</div>

                            <div class="crnrstn_cb"></div>

                        </div>

                    <div class="crnrstn_cb"></div>

               </div>

            </div>

        </div>';

        error_log(__LINE__ . ' html mgr RETURN SSDTLA XML data for [' . $this->oCRNRSTN->oDATA_TUNNEL_SERVICES_MGR->return_received_data('crnrstn_interact_ui_link_text_click') . '].');

        return $tmp_html_out;


    }

    public function out_ui_module_html_system_footer_generic(){

        $tmp_text_break = '.
';

        $mem_report_queue = $this->oCRNRSTN->get_resource('mem_rpt_general_system_footer', 0, 'CRNRSTN::RESOURCE::REPORTING');
        $tmp_mem_str = $this->oCRNRSTN->mem_report($mem_report_queue, 'TEXT', 10, false, true, $tmp_text_break, '<br>');

        if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

            $tmp_html_out = '<div id="crnrstn_ui_system_footer_wrapper" class="crnrstn_ui_system_footer_wrapper"><div class="crnrstn_ui_system_footer_rel"><div id="crnrstn_ui_system_footer" class="crnrstn_ui_system_footer"><div class="crnrstn_ui_system_footer_content"><div id="crnrstn_ui_system_footer_stache" class="crnrstn_ui_system_footer_stache">' . $this->oCRNRSTN->return_system_image('STACHE','', 17, NULL, NULL, NULL, NULL, CRNRSTN_HTML) . '</div><div id="crnrstn_ui_system_footer_mit" class="crnrstn_ui_system_footer_mit"><a id="crnrstn_ui_system_footer_mit_lnk" href="#" onclick="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onclick\', this);" target="_self">' . $this->oCRNRSTN->multi_lang_content_return('COPY_ALL_RIGHTS_PART_MIT') . '</a></div><div id="crnrstn_ui_system_footer_download" class="crnrstn_ui_system_footer_download"><a style="font-family: Courier New, Courier, monospace; font-size:12px; line-height: 20px;" href="'. $this->oCRNRSTN->return_sticky_link('https://github.com/jony5/CRNRSTN-v2.00.0000-PRE-ALPHA-DEV-Lightsaber', 'crnrstn_text_lnk_download') .'" target="_blank">' . $this->oCRNRSTN->multi_lang_content_return('LNK_DOWNLOAD_TXT_FOOTER') . '</a></div><div class="crnrstn_ui_system_footer_stats_wrapper"><div id="crnrstn_ui_system_footer_stat_stime" class="crnrstn_ui_system_footer_stat">[' . $this->oCRNRSTN->return_micro_time() . ']</div><div id="crnrstn_ui_system_footer_stat_rtime" class="crnrstn_ui_system_footer_stat">[rtime ' . $this->oCRNRSTN->wall_time() . ' secs]</div><div id="crnrstn_ui_system_footer_stat_wtime" class="crnrstn_ui_system_footer_stat">[wtime ' . $this->oCRNRSTN->wall_time() . ' secs]</div><div id="crnrstn_ui_system_footer_stat_meta" class="crnrstn_ui_system_footer_stat"></div></div><div class="crnrstn_ui_system_footer_5">' . $this->oCRNRSTN->return_system_image('FIVE', 20, 20, NULL, NULL, NULL, NULL, CRNRSTN_HTML) . '</div><div class="crnrstn_cb"></div></div><div class="crnrstn_cb"></div></div></div></div>';

        }else{

            $tmp_html_out = '<div id="crnrstn_ui_system_footer_wrapper" class="crnrstn_ui_system_footer_wrapper">

                <div class="crnrstn_ui_system_footer_rel">

                    <div id="crnrstn_ui_system_footer" class="crnrstn_ui_system_footer">

                            <div class="crnrstn_ui_system_footer_content">
                                <div id="crnrstn_ui_system_footer_stache" class="crnrstn_ui_system_footer_stache">' . $this->oCRNRSTN->return_system_image('STACHE','', 17, NULL, NULL, NULL, NULL, CRNRSTN_HTML) . '</div>

                                <div id="crnrstn_ui_system_footer_mit" class="crnrstn_ui_system_footer_mit"><a id="crnrstn_ui_system_footer_mit_lnk" href="#" onclick="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onclick\', this);" target="_self">' . $this->oCRNRSTN->multi_lang_content_return('COPY_ALL_RIGHTS_PART_MIT') . '</a></div>
                                <div id="crnrstn_ui_system_footer_download" class="crnrstn_ui_system_footer_download"><a style="font-family: Courier New, Courier, monospace; font-size:12px; line-height: 20px;" href="'. $this->oCRNRSTN->return_sticky_link('https://github.com/jony5/CRNRSTN-v2.00.0000-PRE-ALPHA-DEV-Lightsaber', 'crnrstn_text_lnk_download') .'" target="_blank">' . $this->oCRNRSTN->multi_lang_content_return('LNK_DOWNLOAD_TXT_FOOTER') . '</a></div>

                                <div class="crnrstn_ui_system_footer_stats_wrapper">
                                    <div id="crnrstn_ui_system_footer_content_container_mem_report" class="crnrstn_ui_system_footer_stat">' . $tmp_mem_str . '</div>
                                    <div id="crnrstn_ui_system_footer_stat_stime" class="crnrstn_ui_system_footer_stat">[' . $this->oCRNRSTN->return_micro_time() . ']</div>
                                    <div id="crnrstn_ui_system_footer_stat_rtime" class="crnrstn_ui_system_footer_stat">[rtime ' . $this->oCRNRSTN->wall_time() . ' secs]</div>
                                    <div id="crnrstn_ui_system_footer_stat_wtime" class="crnrstn_ui_system_footer_stat">[wtime ' . $this->oCRNRSTN->wall_time() . ' secs]</div>
                                    <div id="crnrstn_ui_system_footer_stat_meta" class="crnrstn_ui_system_footer_stat"></div>
                                </div>

                                <div class="crnrstn_ui_system_footer_5">' . $this->oCRNRSTN->return_system_image('FIVE', 20, 20, NULL, NULL, NULL, NULL, CRNRSTN_HTML) . '</div>

                                <div class="crnrstn_cb"></div>

                            </div>

                        <div class="crnrstn_cb"></div>

                   </div>

                </div>

            </div>';

        }

        return $tmp_html_out;

    }

    public function out_ui_module_html_system_messenger(){

        if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

            $tmp_html_out = '<div id="crnrstn_interact_ui_wrapper" class="crnrstn_interact_ui_wrapper"><div class="crnrstn_interact_ui"><div id="crnrstn_interact_ui_bg_border" class="crnrstn_interact_ui_bg_border"></div><div id="crnrstn_interact_ui_bg_border_edge" class="crnrstn_interact_ui_bg_border_edge" style="border: 1px solid #FFF;"></div><div style="position:relative; height:106px;"><div id="crnrstn_interact_ui_primary_navgroup_wrapper" class="crnrstn_interact_ui_primary_navgroup_wrapper"><div id="crnrstn_interact_ui_primary_nav_menu" class="crnrstn_interact_ui_primary_navgroup_lnk_border"><div id="crnrstn_interact_ui_primary_nav_img_shell_menu_inactive" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MENU_INACTIVE', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MENU') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MENU') . '"></div><div id="crnrstn_interact_ui_primary_nav_img_shell_menu_hvr" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MENU_HOVER', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MENU') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MENU') . '"></div><div id="crnrstn_interact_ui_primary_nav_img_shell_menu_click" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MENU_CLICK', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MENU') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MENU') . '"></div><div id="crnrstn_interact_ui_primary_nav_img_shell_menu" class="crnrstn_interact_ui_primary_nav_img_shell crnrstn_interact_ui_active"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MENU', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MENU') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MENU') . '"></div><div id="crnrstn_interact_ui_primary_nav_img_shell_menu_glass_case" class="crnrstn_interact_ui_primary_nav_glass_case" onmouseover="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseout\', this);" onmousedown="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmousedown\', this);" onmouseup="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseup\', this);"><img src="' . $this->oCRNRSTN->return_creative('TRANSPARENT_1X1', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MENU') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MENU') . '"></div></div><div id="crnrstn_interact_ui_primary_nav_close_x" class="crnrstn_interact_ui_primary_navgroup_lnk_border"><div id="crnrstn_interact_ui_primary_nav_img_shell_close_x_inactive" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_CLOSE_X_INACTIVE', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_CLOSE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_CLOSE') . '"></div><div id="crnrstn_interact_ui_primary_nav_img_shell_close_x_hvr" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_CLOSE_X_HOVER', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_CLOSE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_CLOSE') . '"></div><div id="crnrstn_interact_ui_primary_nav_img_shell_close_x_click" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_CLOSE_X_CLICK', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_CLOSE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_CLOSE') . '"></div><div id="crnrstn_interact_ui_primary_nav_img_shell_close_x" class="crnrstn_interact_ui_primary_nav_img_shell crnrstn_interact_ui_active"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_CLOSE_X', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_CLOSE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_CLOSE') . '"></div><div id="crnrstn_interact_ui_primary_nav_img_shell_close_x_glass_case" class="crnrstn_interact_ui_primary_nav_glass_case" onmouseover="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseout\', this);" onmousedown="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmousedown\', this);" onmouseup="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseup\', this);"><img src="' . $this->oCRNRSTN->return_creative('TRANSPARENT_1X1', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_CLOSE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_CLOSE') . '"></div></div><div id="crnrstn_interact_ui_primary_nav_fs_expand" class="crnrstn_interact_ui_primary_navgroup_lnk_border"><div id="crnrstn_interact_ui_primary_nav_img_shell_fs_expand_inactive" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_INACTIVE', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_FULLSCREEN') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_FULLSCREEN') . '"></div><div id="crnrstn_interact_ui_primary_nav_img_shell_fs_expand_hvr" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_HOVER', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_FULLSCREEN') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_FULLSCREEN') . '"></div><div id="crnrstn_interact_ui_primary_nav_img_shell_fs_expand_click" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_CLICK', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_FULLSCREEN') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_FULLSCREEN') . '"></div><div id="crnrstn_interact_ui_primary_nav_img_shell_fs_expand" class="crnrstn_interact_ui_primary_nav_img_shell crnrstn_interact_ui_active"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_FULLSCREEN') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_FULLSCREEN') . '"></div><div id="crnrstn_interact_ui_primary_nav_img_shell_fs_expand_glass_case" class="crnrstn_interact_ui_primary_nav_glass_case" onmouseover="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseout\', this);" onmousedown="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmousedown\', this);" onmouseup="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseup\', this);"><img src="' . $this->oCRNRSTN->return_creative('TRANSPARENT_1X1', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_FULLSCREEN') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_FULLSCREEN') . '"></div></div><div id="crnrstn_interact_ui_primary_nav_minimize" class="crnrstn_interact_ui_primary_navgroup_lnk_border"><div id="crnrstn_interact_ui_primary_nav_img_shell_minimize_inactive" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MINIMIZE_INACTIVE', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MINIMIZE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MINIMIZE') . '"></div><div id="crnrstn_interact_ui_primary_nav_img_shell_minimize_hvr" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MINIMIZE_HOVER', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MINIMIZE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MINIMIZE') . '"></div><div id="crnrstn_interact_ui_primary_nav_img_shell_minimize_click" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MINIMIZE_CLICK', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MINIMIZE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MINIMIZE') . '"></div><div id="crnrstn_interact_ui_primary_nav_img_shell_minimize" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MINIMIZE', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MINIMIZE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MINIMIZE') . '"></div><div id="crnrstn_interact_ui_primary_nav_img_shell_minimize_fivedev_sm" class="crnrstn_interact_ui_primary_nav_img_shell crnrstn_interact_ui_active"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MINIMIZE_FIVEDEV_SMALL', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_FIVEDEV') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_FIVEDEV') . '"></div><div id="crnrstn_interact_ui_primary_nav_img_shell_minimize_glass_case" class="crnrstn_interact_ui_primary_nav_glass_case" onmouseover="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseout\', this);" onmousedown="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmousedown\', this);" onmouseup="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseup\', this);"><img src="' . $this->oCRNRSTN->return_creative('TRANSPARENT_1X1', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_FIVEDEV') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_FIVEDEV') . '"></div></div></div><div class="crnrstn_cb"></div></div><div class="crnrstn_cb"></div><div style="position:relative;"><div style="position:absolute; z-index:68; margin: 2px 0 0 16px; border: 1px solid #FFF;"><div id="crnrstn_interact_ui_bg_solid" class="crnrstn_interact_ui_bg_solid" onclick="oCRNRSTN_JS.sign_in_transition_via_micro_expansion();">' . $this->oCRNRSTN->return_creative('MESSAGE_CONVERSATION_BUBBLE_MICRO_THUMB_BLUE00', CRNRSTN_HTML) . '<div class="crnrstn_cb"></div></div></div><div class="crnrstn_cb"></div></div><div id="crnrstn_interact_ui_content_wrapper" class="crnrstn_interact_ui_content_wrapper"><div id="crnrstn_interact_ui_signin_frm_username" class="crnrstn_interact_ui_signin_frm_lbl">' . $this->oCRNRSTN->multi_lang_content_return('FORM_LABEL_USERNAME') . '</div><div class="crnrstn_cb_5"></div><input type="text" name="username" value=""><div class="crnrstn_cb_15"></div><div id="crnrstn_interact_ui_signin_frm_password" class="crnrstn_interact_ui_signin_frm_lbl">' . $this->oCRNRSTN->multi_lang_content_return('FORM_LABEL_PASSWORD_OPTIONAL') . '</div><div class="crnrstn_cb_5"></div><input type="password" name="password" value=""><div class="crnrstn_cb_10"></div><div class="crnrstn_interact_ui_signin_frm_chkbx_eula"><input type="checkbox" style="width: 20px;" name="crnrstn_signin_chkbx_eula_accept" value="eula_i_agree"></div><div class="crnrstn_interact_ui_signin_frm_lbl_eula"><a href="#">' . $this->oCRNRSTN->multi_lang_content_return('FORM_LNK_TXT_EULA') . '</a></div><div class="crnrstn_cb_10"></div><div class="crnrstn_interact_ui_frm_submit" onclick="oCRNRSTN_JS.sign_in_form_submit_via_micro_expansion();"><div id="crnrstn_interact_ui_signin_frm_btn_submit" class="crnrstn_interact_ui_signin_frm_btn_submit">' . $this->oCRNRSTN->multi_lang_content_return('FORM_BUTTON_TEXT_CONNECT') . '</div></div></div></div></div>';

        }else{

            $tmp_html_out = '<div id="crnrstn_interact_ui_wrapper" class="crnrstn_interact_ui_wrapper">
    <div class="crnrstn_interact_ui">

        <div id="crnrstn_interact_ui_bg_border" class="crnrstn_interact_ui_bg_border"></div>

        <div id="crnrstn_interact_ui_bg_border_edge" class="crnrstn_interact_ui_bg_border_edge" style="border: 1px solid #FFF;"></div>

        <div style="position:relative; height:106px;">

            <div id="crnrstn_interact_ui_primary_navgroup_wrapper" class="crnrstn_interact_ui_primary_navgroup_wrapper">

                <div id="crnrstn_interact_ui_primary_nav_menu" class="crnrstn_interact_ui_primary_navgroup_lnk_border">

                    <div id="crnrstn_interact_ui_primary_nav_img_shell_menu_inactive" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MENU_INACTIVE', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MENU') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MENU') . '"></div>
                    <div id="crnrstn_interact_ui_primary_nav_img_shell_menu_hvr" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MENU_HOVER', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MENU') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MENU') . '"></div>
                    <div id="crnrstn_interact_ui_primary_nav_img_shell_menu_click" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MENU_CLICK', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MENU') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MENU') . '"></div>
                    <div id="crnrstn_interact_ui_primary_nav_img_shell_menu" class="crnrstn_interact_ui_primary_nav_img_shell crnrstn_interact_ui_active"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MENU', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MENU') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MENU') . '"></div>
                    <div id="crnrstn_interact_ui_primary_nav_img_shell_menu_glass_case" class="crnrstn_interact_ui_primary_nav_glass_case" onmouseover="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseout\', this);" onmousedown="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmousedown\', this);" onmouseup="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseup\', this);"><img src="' . $this->oCRNRSTN->return_creative('TRANSPARENT_1X1', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MENU') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MENU') . '"></div>

                </div>

                <div id="crnrstn_interact_ui_primary_nav_close_x" class="crnrstn_interact_ui_primary_navgroup_lnk_border">

                    <div id="crnrstn_interact_ui_primary_nav_img_shell_close_x_inactive" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_CLOSE_X_INACTIVE', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_CLOSE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_CLOSE') . '"></div>
                    <div id="crnrstn_interact_ui_primary_nav_img_shell_close_x_hvr" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_CLOSE_X_HOVER', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_CLOSE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_CLOSE') . '"></div>
                    <div id="crnrstn_interact_ui_primary_nav_img_shell_close_x_click" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_CLOSE_X_CLICK', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_CLOSE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_CLOSE') . '"></div>
                    <div id="crnrstn_interact_ui_primary_nav_img_shell_close_x" class="crnrstn_interact_ui_primary_nav_img_shell crnrstn_interact_ui_active"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_CLOSE_X', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_CLOSE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_CLOSE') . '"></div>
                    <div id="crnrstn_interact_ui_primary_nav_img_shell_close_x_glass_case" class="crnrstn_interact_ui_primary_nav_glass_case" onmouseover="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseout\', this);" onmousedown="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmousedown\', this);" onmouseup="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseup\', this);"><img src="' . $this->oCRNRSTN->return_creative('TRANSPARENT_1X1', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_CLOSE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_CLOSE') . '"></div>

                </div>

                <div id="crnrstn_interact_ui_primary_nav_fs_expand" class="crnrstn_interact_ui_primary_navgroup_lnk_border">

                    <div id="crnrstn_interact_ui_primary_nav_img_shell_fs_expand_inactive" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_INACTIVE', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_FULLSCREEN') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_FULLSCREEN') . '"></div>
                    <div id="crnrstn_interact_ui_primary_nav_img_shell_fs_expand_hvr" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_HOVER', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_FULLSCREEN') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_FULLSCREEN') . '"></div>
                    <div id="crnrstn_interact_ui_primary_nav_img_shell_fs_expand_click" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_CLICK', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_FULLSCREEN') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_FULLSCREEN') . '"></div>
                    <div id="crnrstn_interact_ui_primary_nav_img_shell_fs_expand" class="crnrstn_interact_ui_primary_nav_img_shell crnrstn_interact_ui_active"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_FULLSCREEN') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_FULLSCREEN') . '"></div>
                    <div id="crnrstn_interact_ui_primary_nav_img_shell_fs_expand_glass_case" class="crnrstn_interact_ui_primary_nav_glass_case" onmouseover="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseout\', this);" onmousedown="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmousedown\', this);" onmouseup="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseup\', this);"><img src="' . $this->oCRNRSTN->return_creative('TRANSPARENT_1X1', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_FULLSCREEN') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_FULLSCREEN') . '"></div>

                </div>

                <div id="crnrstn_interact_ui_primary_nav_minimize" class="crnrstn_interact_ui_primary_navgroup_lnk_border">

                    <div id="crnrstn_interact_ui_primary_nav_img_shell_minimize_inactive" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MINIMIZE_INACTIVE', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MINIMIZE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MINIMIZE') . '"></div>
                    <div id="crnrstn_interact_ui_primary_nav_img_shell_minimize_hvr" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MINIMIZE_HOVER', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MINIMIZE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MINIMIZE') . '"></div>
                    <div id="crnrstn_interact_ui_primary_nav_img_shell_minimize_click" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MINIMIZE_CLICK', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MINIMIZE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MINIMIZE') . '"></div>
                    <div id="crnrstn_interact_ui_primary_nav_img_shell_minimize" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MINIMIZE', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MINIMIZE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MINIMIZE') . '"></div>
                    <div id="crnrstn_interact_ui_primary_nav_img_shell_minimize_fivedev_sm" class="crnrstn_interact_ui_primary_nav_img_shell crnrstn_interact_ui_active"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MINIMIZE_FIVEDEV_SMALL', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_FIVEDEV') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_FIVEDEV') . '"></div>
                    <div id="crnrstn_interact_ui_primary_nav_img_shell_minimize_glass_case" class="crnrstn_interact_ui_primary_nav_glass_case" onmouseover="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseout\', this);" onmousedown="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmousedown\', this);" onmouseup="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseup\', this);"><img src="' . $this->oCRNRSTN->return_creative('TRANSPARENT_1X1', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_FIVEDEV') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_FIVEDEV') . '"></div>

                </div>

            </div>
            <div class="crnrstn_cb"></div>
        </div>

        <div class="crnrstn_cb"></div>

        <div style="position:relative;">
            <div style="position:absolute; z-index:68; margin: 2px 0 0 16px; border: 1px solid #FFF;">
                <div id="crnrstn_interact_ui_bg_solid" class="crnrstn_interact_ui_bg_solid" onclick="oCRNRSTN_JS.sign_in_transition_via_micro_expansion();">
                    ' . $this->oCRNRSTN->return_creative('MESSAGE_CONVERSATION_BUBBLE_MICRO_THUMB_BLUE00', CRNRSTN_HTML) . '
                    <div class="crnrstn_cb"></div>
                </div>
            </div>
            <div class="crnrstn_cb"></div>

        </div>

        <div id="crnrstn_interact_ui_content_wrapper" class="crnrstn_interact_ui_content_wrapper">
            <div id="crnrstn_interact_ui_signin_frm_username" class="crnrstn_interact_ui_signin_frm_lbl">' . $this->oCRNRSTN->multi_lang_content_return('FORM_LABEL_USERNAME') . '</div>
            <div class="crnrstn_cb_5"></div>
            <input type="text" name="username" value="">
            <div class="crnrstn_cb_15"></div>
            <div id="crnrstn_interact_ui_signin_frm_password" class="crnrstn_interact_ui_signin_frm_lbl">' . $this->oCRNRSTN->multi_lang_content_return('FORM_LABEL_PASSWORD_OPTIONAL') . '</div>
            <div class="crnrstn_cb_5"></div>
            <input type="password" name="password" value="">
            <div class="crnrstn_cb_10"></div>

            <div class="crnrstn_interact_ui_signin_frm_chkbx_eula"><input type="checkbox" style="width: 20px;" name="crnrstn_signin_chkbx_eula_accept" value="eula_i_agree"></div>
            <div class="crnrstn_interact_ui_signin_frm_lbl_eula"><a href="#">' . $this->oCRNRSTN->multi_lang_content_return('FORM_LNK_TXT_EULA') . '</a></div>

            <div class="crnrstn_cb_10"></div>

            <div class="crnrstn_interact_ui_frm_submit" onclick="oCRNRSTN_JS.sign_in_form_submit_via_micro_expansion();">
                <div id="crnrstn_interact_ui_signin_frm_btn_submit" class="crnrstn_interact_ui_signin_frm_btn_submit">' . $this->oCRNRSTN->multi_lang_content_return('FORM_BUTTON_TEXT_CONNECT') . '</div>
            </div>
        </div>
    </div>
</div>
';

        }

        return $tmp_html_out;

    }

    public function out_ui_module_html_system_search(){

        $tmp_html_out = '<div style="padding: 20px;"><h1>' . __METHOD__ . '</h1></div>';
        //error_log(__LINE__ . ' ui html mgr [' . $tmp_html_out . '].');

        return $tmp_html_out;

    }

    public function out_ui_html_doc_documentation(){

        $tmp_str = '';

        $filepath = '/_crnrstn/ui/docs/documentation/index.php';

        include(CRNRSTN_ROOT . $filepath);

        return $tmp_str;

    }

    public function out_ui_html_doc_mit_license(){

        $tmp_str = '';

        $filepath = '/_crnrstn/ui/docs/pages/mit_license.php';

        include(CRNRSTN_ROOT . $filepath);

        return $tmp_str;

    }

	public function out_ui_html_doc_signin(){

        $tmp_str = '';

        $filepath = '/_crnrstn/ui/docs/pages/signin.php';

        include(CRNRSTN_ROOT . $filepath);

        return $tmp_str;

    }

    public function out_ui_html_doc_css_validator(){

        $tmp_str = '';

        $filepath = '/_crnrstn/ui/docs/pages/css_validator.php';

        include(CRNRSTN_ROOT . $filepath);

        return $tmp_str;

    }

    public function out_ui_html_doc_css_validator_profile(){

        $tmp_str = '';

        $filepath = '/_crnrstn/ui/docs/pages/css_validator_profile.php';

        include(CRNRSTN_ROOT . $filepath);

        return $tmp_str;

    }

    public function out_ui_html_doc_dashboard(){

        $tmp_str = '';

        $filepath = '/_crnrstn/ui/docs/pages/dashboard.php';

        include(CRNRSTN_ROOT . $filepath);

        return $tmp_str;

    }

    public function out_ui_html_doc_config_wordpress(){

        $tmp_str = '';

        $filepath = '/_crnrstn/ui/docs/pages/config_wordpress.php';

        include(CRNRSTN_ROOT . $filepath);

        return $tmp_str;

    }

	public function __destruct(){

	}
}