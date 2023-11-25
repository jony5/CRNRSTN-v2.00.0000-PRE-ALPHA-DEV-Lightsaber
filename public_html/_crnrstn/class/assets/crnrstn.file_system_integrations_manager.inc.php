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
# # C # R # N # R # S # T # N # : : # # # #
#
#  CLASS :: crnrstn_file_system_integrations_manager
#  VERSION :: 1.00.0000
#  DATE :: Tuesday, Jun 6, 2023 0420 hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI ::
#  DESCRIPTION :: This is a file system integrations manager to send host resources
#                 to CRNRSTN :: PLAID.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_file_system_integrations_manager {

    public $oCRNRSTN;
    protected $oLogger;

    public function __construct($oCRNRSTN) {

        $this->oCRNRSTN = $oCRNRSTN;

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN);

        /*
        'CRNRSTN_FAVICON', 'CRNRSTN_ASSET_MODE_BASE64', 'CRNRSTN_ASSET_MODE_PNG', 'CRNRSTN_ASSET_MODE_JPEG',
        'CRNRSTN_IMG', 'CRNRSTN_STRING', 'CRNRSTN_HTML', 'CRNRSTN_UI_SOAP_DATA_TUNNEL', 'CRNRSTN_BASE64',
        'CRNRSTN_BASE64_PNG', 'CRNRSTN_BASE64_JPEG', 'CRNRSTN_BASE64_GIF', 'CRNRSTN_GIF', 'CRNRSTN_PNG',
        'CRNRSTN_JPEG', 'CRNRSTN_CSS', 'CRNRSTN_JS', 'CRNRSTN_HTML', 'CRNRSTN_HTM', 'CRNRSTN_PHP', 'CRNRSTN_SQL', 'CRNRSTN_XML',
        'CRNRSTN_TXT', 'CRNRSTN_RTF', 'CRNRSTN_CSV', 'CRNRSTN_TIF', 'CRNRSTN_BMP', 'CRNRSTN_SVG', 'CRNRSTN_PIC',
        'CRNRSTN_ZIP', 'CRNRSTN_EXE','CRNRSTN_BAT', 'CRNRSTN_TAR',CRNRSTN_PSD
                CRNRSTN_AI
                CRNRSTN_AFDESIGN
                CRNRSTN_AFPHOTO
                CRNRSTN_CDR
                CRNRSTN_CPT 'CRNRSTN_PDF', 'CRNRSTN_XLS', 'CRNRSTN_XLSX', 'CRNRSTN_DOC',
        'CRNRSTN_DOCX', 'CRNRSTN_PPT', 'CRNRSTN_PPSX',
        'CRNRSTN_KEY', 'CRNRSTN_PAGES', 'CRNRSTN_XSLT', 'CRNRSTN_MP2', 'CRNRSTN_MP3', 'CRNRSTN_MP4',
        'CRNRSTN_WAV', 'CRNRSTN_MIDI', 'CRNRSTN_RAM', 'CRNRSTN_MPEG',
        'CRNRSTN_QT', 'CRNRSTN_AVI'

        'CRNRSTN_UI_INTERACT', 'CRNRSTN_CSS_MAIN_MOBILE', 'CRNRSTN_CSS_MAIN_TABLET', 'CRNRSTN_CSS_MAIN_DESKTOP',
        'CRNRSTN_CSS_FRAMEWORK_SIMPLE_GRID', 'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM',
        'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_24COL', 'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_16COL',
        'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_12COL', 'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_24COL_RTL',
        'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_16COL_RTL', 'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_12COL_RTL',
        'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_RTL', 'CRNRSTN_CSS_FRAMEWORK_FOUNDATION',
        'CRNRSTN_CSS_FRAMEWORK_HTML5_BOILERPLATE', 'CRNRSTN_CSS_FRAMEWORK_RESPONSIVE_GRID_SYSTEM',
        'CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC', 'CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_RTL',
        'CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_RESET', 'CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_RESET_RTL',
        'CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_ADAPT', 'CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_ADAPT_RTL',
        'CRNRSTN_CSS_FRAMEWORK_DEAD_SIMPLE_GRID', 'CRNRSTN_CSS_FRAMEWORK_SKELETON', 'CRNRSTN_CSS_FRAMEWORK_RWDGRID',
        'CRNRSTN_CSS_FRAMEWORK_THIS_IS_DALLAS_SIMPLE_GRID', 'CRNRSTN_JS_MAIN',
        'CRNRSTN_JS_CSS_PROD_MIN', 'CRNRSTN_JS_FRAMEWORK_JQUERY', 'CRNRSTN_JS_FRAMEWORK_JQUERY_3_7_0', 'CRNRSTN_JS_FRAMEWORK_JQUERY_3_6_1', 'CRNRSTN_JS_FRAMEWORK_JQUERY_2_2_4',
        'CRNRSTN_JS_FRAMEWORK_JQUERY_1_12_4', 'CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1',  'CRNRSTN_JS_FRAMEWORK_JQUERY_UI',
        'CRNRSTN_JS_FRAMEWORK_JQUERY_UI_1_13_2', 'CRNRSTN_JS_FRAMEWORK_JQUERY_UI_1_12_1', 'CRNRSTN_JS_FRAMEWORK_JQUERY_MOBILE',
        'CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS', 'CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_2_10_0',
        'CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_2_11_3', 'CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_PLUS_JQUERY',
        'CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_2_03_3', 'CRNRSTN_UI_TAG_ANALYTICS', 'CRNRSTN_UI_TAG_ENGAGEMENT',
        'CRNRSTN_JS_FRAMEWORK_REACT_CDN',CRNRSTN_JS_FRAMEWORK_REACT_CDN_18_2_0

        CRNRSTN_JS_FRAMEWORK_REACT_DOM_CDN_18_2_0
        CRNRSTN_JS_FRAMEWORK_MITHRIL_CDN_2_2_2
        CRNRSTN_JS_FRAMEWORK_BACKBONE_1_4_1
        CRNRSTN_JS_FRAMEWORK_PROTOTYPE_1_7_3
        CRNRSTN_JS_FRAMEWORK_MOOTOOLS_MORE_1_6_0
        CRNRSTN_JS_FRAMEWORK_MOOTOOLS_CORE_1_6_0
        CRNRSTN_CSS_FRAMEWORK_FOUNDATION_6
        CRNRSTN_CSS_FRAMEWORK_HTML5_BOILERPLATE_8_0_0
        CRNRSTN_CSS_FRAMEWORK_RWDGRID_2_0

        'CRNRSTN_JS_FRAMEWORK_REACT_DOM_CDN', 'CRNRSTN_JS_FRAMEWORK_MITHRIL_CDN',
        'CRNRSTN_JS_FRAMEWORK_PROTOTYPE', 'CRNRSTN_JS_FRAMEWORK_SCRIPTACULOUS', 'CRNRSTN_JS_FRAMEWORK_PROTOTYPE_MOOFX',
        'CRNRSTN_JS_FRAMEWORK_MOOTOOLS_MORE', 'CRNRSTN_JS_FRAMEWORK_MOOTOOLS_CORE', 'CRNRSTN_JS_FRAMEWORK_BACKBONE',
        'CRNRSTN_JS_FRAMEWORK_BACKBONE_1_4_1', 'CRNRSTN_JS_FRAMEWORK_UNDERSCORE_UMD',
        'CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_UMD', 'CRNRSTN_JS_FRAMEWORK_UNDERSCORE_ESM',
        'CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_ESM', 'CRNRSTN_JS_FRAMEWORK_UNDERSCORE_UMD_EDGE',
        'CRNRSTN_JS_FRAMEWORK_UNDERSCORE_ESM_EDGE', 'CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_UMD_CDN',
        'CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_ESM_CDN', 'CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_UMD_UNPKG',
        'CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_ESM_UNPKG', 'CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_UMD_PAGECDN',
        'CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_ESM_PAGECDN', 'CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_UMD_CDNJS',
        'CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_ESM_CDNJS'

        //
        // GET SYSTEM CONFIGURATION SETTINGS FOR REGULATION OF MEMORY
        // UTILIZATION PERFORMANCE LIMITATIONS.
        $tmp_max_disk_storage_utilization_warning = $this->oCRNRSTN->get_resource('max_disk_storage_utilization_warning', 0, 'CRNRSTN::RESOURCE::DISK_STORAGE');
        $tmp_max_disk_storage_utilization = $this->oCRNRSTN->get_resource('max_disk_storage_utilization', 0, 'CRNRSTN::RESOURCE::DISK_STORAGE');

        $this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'permissions_chmod', 775, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');
        $this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'salt_length', 64, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');
        $this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'max_pid_threads', 5, 'CRNRSTN::RESOURCE::PROCESSES');
        $this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'max_conn_ftp', 5, 'CRNRSTN::RESOURCE::CONNECTIONS');  // UP TO 10.

        */

    }



    public function __destruct(){

    }

}