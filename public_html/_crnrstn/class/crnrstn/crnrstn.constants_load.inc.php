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
/*
TOUCHPOINTS FOR SUCCESSFUL INSTALLATION OF CRNRSTN :: INTEGER CONSTANTS ::
_crnrstn/class/crnrstn/crnrstn.constants_initialize.inc.php [THIS FILE]
    function crnrstn_constants_init($const_nom)

_crnrstn/class/crnrstn/crnrstn.constants_load.inc.php
    $CRNRSTN_CONSTANTS_ARRAY = array(...{ADD NEW CONSTANT}...);
    @define('DEFINE NEW CONSTANT HERE', (int) crnrstn_constants_init('DEFINE NEW CONSTANT HERE'));

_crnrstn/class/ui/crnrstn.content_source_control.inc.php
    private function return_int_const_profile($resource_constant)
    public function return_integer_constant_profiles($module_key)

_crnrstn/class/assets/crnrstn.system_asset_manager.inc.php [FOR ADDING FRAMEWORK JS/CSS RESOURCE]
    public function return_html_head_asset($const){
    private function return_output_CRNRSTN_JS($const){
    private function return_output_CRNRSTN_CSS($const){

*/

if(isset($crnrstn_initialize_bits)){

    $CRNRSTN_CONSTANTS_ARRAY = array('CRNRSTN_DEBUG_OFF', 'CRNRSTN_DEBUG_NATIVE_ERR_LOG', 'CRNRSTN_CLIENT_SSDTLA_DEBUG',
    'CRNRSTN_DEBUG_AGGREGATION_ON', 'CRNRSTN_HTML_COMMENTS_SILENT_GOLD', 'CRNRSTN_HTML_COMMENTS_NONE',
    'CRNRSTN_HTML_COMMENTS_CDN_STABILITY_CONTROL_ENABLED', 'CRNRSTN_HTML_COMMENTS_ENLARGED_PHYLACTERIES',
    'CRNRSTN_HTML_COMMENTS_FULL', 'CRNRSTN_LOG_ALL', 'CRNRSTN_STRING', 'CRNRSTN_INT', 'CRNRSTN_INTEGER', 'CRNRSTN_BOOL',
    'CRNRSTN_BOOLEAN', 'CRNRSTN_FLOAT', 'CRNRSTN_DOUBLE', 'CRNRSTN_ARRAY', 'CRNRSTN_OBJECT', 'CRNRSTN_RESOURCE',
    'CRNRSTN_RESOURCE_CLOSED', 'CRNRSTN_UNKNOWN_TYPE', 'CRNRSTN_NULL', 'CRNRSTN_MIXED', 'CRNRSTN_IS_HTML',
    'CRNRSTN_AUTHORIZED_ACCOUNT', 'CRNRSTN_AUTHORIZED_IP', 'CRNRSTN_LOG_NONE', 'CRNRSTN_INTEGER_LENGTH',
    'CRNRSTN_SETTINGS_APACHE', 'CRNRSTN_SETTINGS_MYSQLI', 'CRNRSTN_SETTINGS_PHP', 'CRNRSTN_SETTINGS_CRNRSTN',
    'CRNRSTN_SETTINGS_CLIENT', 'CRNRSTN_SETTINGS_WORDPRESS', 'CRNRSTN_DATABASE', 'CRNRSTN_DATABASE_CONNECTION',
    'CRNRSTN_DATABASE_QUERY', 'CRNRSTN_DATABASE_QUERY_SILO', 'CRNRSTN_DATABASE_QUERY_DYNAMIC', 'CRNRSTN_DATABASE_RESULT',
    'CRNRSTN_PERFORMANCE_MONITOR', 'CRNRSTN_IP_SECURITY', 'CRNRSTN_GABRIEL', 'CRNRSTN_SMTP_AUTHENTICATION',
    'CRNRSTN_EMAIL_CRNRSTN_SOURCE', 'CRNRSTN_EMAIL_USER_SOURCE','CRNRSTN_ELECTRUM', 'CRNRSTN_ELECTRUM_THREAD',
    'CRNRSTN_ELECTRUM_COMM', 'CRNRSTN_ELECTRUM_FTP','CRNRSTN_ELECTRUM_LOCALDIR', 'CRNRSTN_FILE_MANAGEMENT',
    'CRNRSTN_CREATIVE_EMBED', 'CRNRSTN_FILE_RECEIVE',
    'CRNRSTN_FILE_LOCALDIR_MOVE', 'CRNRSTN_FILE_FTP_SEND', 'CRNRSTN_FILE_FTP_RECEIVE', 'CRNRSTN_FILE_SOAP_SEND',
    'CRNRSTN_FILE_SOAP_RECEIVE', 'CRNRSTN_FILE_CURL_SEND', 'CRNRSTN_FILE_CURL_RECEIVE',
    'CRNRSTN_CSS_EMAIL_CLIENT_VALIDATE', 'CRNRSTN_BARNEY', 'CRNRSTN_BARNEY_DATABASE', 'CRNRSTN_BARNEY_FILE',
    'CRNRSTN_BARNEY_FTP', 'CRNRSTN_BARNEY_ELECTRUM', 'CRNRSTN_BARNEY_GABRIEL', 'CRNRSTN_BARNEY_DISK', 'CRNRSTN_SOAP',
    'CRNRSTN_SOAP_SERVER', 'CRNRSTN_SOAP_CLIENT', 'CRNRSTN_PROXY_KINGS_HIGHWAY', 'CRNRSTN_PROXY_EMAIL',
    'CRNRSTN_PROXY_ELECTRUM', 'CRNRSTN_PROXY_AUTHENTICATE', 'CRNRSTN_LOG_EMAIL', 'CRNRSTN_LOG_EMAIL_PROXY',
    'CRNRSTN_LOG_FILE', 'CRNRSTN_LOG_FILE_PROXY', 'CRNRSTN_LOG_FILE_FTP', 'CRNRSTN_LOG_SCREEN_TEXT',
    'CRNRSTN_LOG_SCREEN', 'CRNRSTN_LOG_SCREEN_HTML', 'CRNRSTN_LOG_SCREEN_HTML_HIDDEN', 'CRNRSTN_LOG_DEFAULT',
    'CRNRSTN_LOG_DEFAULT_PROXY', 'CRNRSTN_LOG_ELECTRUM', 'CRNRSTN_UI_PHPNIGHT', 'CRNRSTN_UI_DARKNIGHT',
    'CRNRSTN_UI_PHP', 'CRNRSTN_UI_GREYSKY', 'CRNRSTN_UI_HTML', 'CRNRSTN_UI_DAYLIGHT', 'CRNRSTN_UI_FEATHER',
    'CRNRSTN_UI_GLASS_LIGHT_COPY', 'CRNRSTN_UI_GLASS_DARK_COPY', 'CRNRSTN_UI_WOOD', 'CRNRSTN_UI_TERMINAL',
    'CRNRSTN_UI_RANDOM', 'CRNRSTN_CHANNEL_DESKTOP', 'CRNRSTN_CHANNEL_TABLET', 'CRNRSTN_CHANNEL_MOBILE',
    'CRNRSTN_ICY_BITMASK', 'CRNRSTN_SOAP_DATA_TUNNEL', 'CRNRSTN_UI_SOAP_DATA_TUNNEL', 'CRNRSTN_ASSET_MODE_BASE64',
    'CRNRSTN_ASSET_MODE_PNG', 'CRNRSTN_ASSET_MODE_JPEG', 'CRNRSTN_IMG', 'CRNRSTN_STRING', 'CRNRSTN_BASE64',
    'CRNRSTN_CSS', 'CRNRSTN_JS', 'CRNRSTN_BASE64_PNG', 'CRNRSTN_BASE64_JPEG', 'CRNRSTN_BASE64_GIF', 'CRNRSTN_PNG',
    'CRNRSTN_JPEG', 'CRNRSTN_GIF','CRNRSTN_FAVICON', 'CRNRSTN_HTML', 'CRNRSTN_UI_INTERACT', 'CRNRSTN_CSS_MAIN_MOBILE',
    'CRNRSTN_CSS_MAIN_TABLET', 'CRNRSTN_CSS_MAIN_DESKTOP', 'CRNRSTN_CSS_FRAMEWORK_SIMPLE_GRID',
    'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM', 'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_24COL',
    'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_16COL', 'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_12COL',
    'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_24COL_RTL','CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_16COL_RTL',
    'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_12COL_RTL',
    'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_RTL', 'CRNRSTN_CSS_FRAMEWORK_FOUNDATION',
    'CRNRSTN_CSS_FRAMEWORK_FOUNDATION_6', 'CRNRSTN_CSS_FRAMEWORK_HTML5_BOILERPLATE',
    'CRNRSTN_CSS_FRAMEWORK_HTML5_BOILERPLATE_8_0_0', 'CRNRSTN_CSS_FRAMEWORK_RESPONSIVE_GRID_SYSTEM',
    'CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC', 'CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_RTL',
    'CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_RESET', 'CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_RESET_RTL',
    'CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_ADAPT', 'CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_ADAPT_RTL',
    'CRNRSTN_CSS_FRAMEWORK_DEAD_SIMPLE_GRID', 'CRNRSTN_CSS_FRAMEWORK_SKELETON', 'CRNRSTN_CSS_FRAMEWORK_RWDGRID',
    'CRNRSTN_CSS_FRAMEWORK_RWDGRID_2_0' , 'CRNRSTN_CSS_FRAMEWORK_THIS_IS_DALLAS_SIMPLE_GRID', 'CRNRSTN_JS_MAIN',
    'CRNRSTN_JS_CSS_PROD_MIN', 'CRNRSTN_JS_FRAMEWORK_JQUERY',
    'CRNRSTN_JS_FRAMEWORK_JQUERY_3_7_0', 'CRNRSTN_JS_FRAMEWORK_JQUERY_3_6_1', 'CRNRSTN_JS_FRAMEWORK_JQUERY_2_2_4',
    'CRNRSTN_JS_FRAMEWORK_JQUERY_1_12_4', 'CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1', 'CRNRSTN_JS_FRAMEWORK_JQUERY_UI',
    'CRNRSTN_JS_FRAMEWORK_JQUERY_UI_1_13_2', 'CRNRSTN_JS_FRAMEWORK_JQUERY_UI_1_12_1',
    'CRNRSTN_JS_FRAMEWORK_JQUERY_MOBILE', 'CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS',
    'CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_2_11_3', 'CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_2_10_0',
    'CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_PLUS_JQUERY', 'CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_2_03_3',
    'CRNRSTN_UI_TAG_ANALYTICS', 'CRNRSTN_UI_TAG_ENGAGEMENT', 'CRNRSTN_JS_FRAMEWORK_REACT_CDN',
    'CRNRSTN_JS_FRAMEWORK_REACT_CDN_18_2_0', 'CRNRSTN_JS_FRAMEWORK_REACT_DOM_CDN',
    'CRNRSTN_JS_FRAMEWORK_REACT_DOM_CDN_18_2_0', 'CRNRSTN_JS_FRAMEWORK_MITHRIL_CDN',
    'CRNRSTN_JS_FRAMEWORK_MITHRIL_CDN_2_2_2', 'CRNRSTN_JS_FRAMEWORK_PROTOTYPE', 'CRNRSTN_JS_FRAMEWORK_PROTOTYPE_1_7_3',
    'CRNRSTN_JS_FRAMEWORK_SCRIPTACULOUS', 'CRNRSTN_JS_FRAMEWORK_PROTOTYPE_MOOFX',
    'CRNRSTN_JS_FRAMEWORK_SWFOBJECT_DOT_JS', 'CRNRSTN_JS_FRAMEWORK_MOOTOOLS_MORE',
    'CRNRSTN_JS_FRAMEWORK_MOOTOOLS_MORE_1_6_0', 'CRNRSTN_JS_FRAMEWORK_MOOTOOLS_CORE',
    'CRNRSTN_JS_FRAMEWORK_MOOTOOLS_CORE_1_6_0', 'CRNRSTN_JS_FRAMEWORK_BACKBONE', 'CRNRSTN_JS_FRAMEWORK_BACKBONE_1_4_1',
    'CRNRSTN_JS_FRAMEWORK_UNDERSCORE_UMD', 'CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_UMD',
    'CRNRSTN_JS_FRAMEWORK_UNDERSCORE_ESM', 'CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_ESM',
    'CRNRSTN_JS_FRAMEWORK_UNDERSCORE_UMD_EDGE', 'CRNRSTN_JS_FRAMEWORK_UNDERSCORE_ESM_EDGE',
    'CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_UMD_CDN',
    'CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_ESM_CDN', 'CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_UMD_UNPKG',
    'CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_ESM_UNPKG', 'CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_UMD_PAGECDN',
    'CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_ESM_PAGECDN', 'CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_UMD_CDNJS',
    'CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_ESM_CDNJS', 'CRNRSTN_UI_FORM_INTEGRATION_PACKET',
    'CRNRSTN_UI_COOKIE_PREFERENCE', 'CRNRSTN_UI_COOKIE_YESNO', 'CRNRSTN_UI_COOKIE_NOTICE', 'CRNRSTN_CHANNEL_RUNTIME',
    'CRNRSTN_CHANNEL_ALL', 'CRNRSTN_CHANNEL_DATABASE', 'CRNRSTN_CHANNEL_SSDTLA', 'CRNRSTN_CHANNEL_PSSDTLA',
    'CRNRSTN_CHANNEL_SESSION', 'CRNRSTN_CHANNEL_COOKIE', 'CRNRSTN_CHANNEL_SOAP', 'CRNRSTN_CHANNEL_GET',
    'CRNRSTN_CHANNEL_POST', 'CRNRSTN_CHANNEL_FILE', 'CRNRSTN_CHANNEL_FORM_INTEGRATIONS',
    'CRNRSTN_AUTHORIZE_RUNTIME', 'CRNRSTN_AUTHORIZE_ALL', 'CRNRSTN_AUTHORIZE_DATABASE', 'CRNRSTN_AUTHORIZE_SSDTLA',
    'CRNRSTN_AUTHORIZE_PSSDTLA', 'CRNRSTN_AUTHORIZE_SESSION', 'CRNRSTN_AUTHORIZE_COOKIE', 'CRNRSTN_AUTHORIZE_SOAP',
    'CRNRSTN_AUTHORIZE_GET', 'CRNRSTN_AUTHORIZE_ISUSERNAME', 'CRNRSTN_AUTHORIZE_ISEMAIL', 'CRNRSTN_AUTHORIZE_POST',
    'CRNRSTN_AUTHORIZE_FILE', 'CRNRSTN_AUTHORIZE_ISPASSWORD', 'CRNRSTN_HTTP_REDIRECT', 'CRNRSTN_HTTPS_REDIRECT',
    'CRNRSTN_HTTP_DATA_RETURN','CRNRSTN_HTTPS_DATA_RETURN', 'CRNRSTN_JSON_RETURN', 'CRNRSTN_XML_RETURN', 'CRNRSTN_SOAP_RETURN',
    'CRNRSTN_HTML_TEXT_RETURN', 'CRNRSTN_SERVER_RESPONSE_CODE', 'CRNRSTN_RESPONSE_REPORT',
    'CRNRSTN_DOCUMENT_FILE_RETURN', 'CRNRSTN_ENCRYPT_TUNNEL', 'CRNRSTN_ENCRYPT_GET', 'CRNRSTN_ENCRYPT_POST',
    'CRNRSTN_ENCRYPT_DATABASE', 'CRNRSTN_ENCRYPT_SESSION', 'CRNRSTN_ENCRYPT_COOKIE', 'CRNRSTN_ENCRYPT_SOAP',
    'CRNRSTN_ENCRYPT_FILE', 'CRNRSTN_ENCRYPT_OERSL', 'CRNRSTN_INPUT_OPTIONAL', 'CRNRSTN_INPUT_REQUIRED', 'CRNRSTN_INPUT_PASSWORD',
    'CRNRSTN_INPUT_IS_FILE_IMAGE_JPEG', 'CRNRSTN_INPUT_IS_FILE_IMAGE_PNG', 'CRNRSTN_INPUT_IS_FILE_IMAGE_GIF',
    'CRNRSTN_INPUT_IS_FILE_IMAGE', 'CRNRSTN_INPUT_IS_FILE_DOCUMENT', 'CRNRSTN_INPUT_IS_FILE_ZIP',
    'CRNRSTN_INPUT_IS_EMAIL', 'CRNRSTN_INPUT_CHAR_RESTRICTIONS', 'CRNRSTN_INPUT_CHAR_LIMITS',
    'CRNRSTN_FAVICON_ASSET_MAPPING', 'CRNRSTN_SYSTEM_IMG_ASSET_MAPPING', 'CRNRSTN_SOCIAL_IMG_ASSET_MAPPING',
    'CRNRSTN_META_IMG_ASSET_MAPPING', 'CRNRSTN_JS_ASSET_MAPPING', 'CRNRSTN_CSS_ASSET_MAPPING',
    'CRNRSTN_SYSTEM_EMAIL_IS_HTML', 'CRNRSTN_ASSET_MAPPING', 'CRNRSTN_ASSET_MAPPING_PROXY', 'CRNRSTN_RESOURCE_ALL',
    'CRNRSTN_RESOURCE_BASSDRIVE', 'CRNRSTN_RESOURCE_NATIONAL_WEATHER_SERVICE', 'CRNRSTN_RESOURCE_CSS_VALIDATOR',
    'CRNRSTN_RESOURCE_DOCUMENTATION', 'CRNRSTN_RESOURCE_DEEP_LINK', 'CRNRSTN_RESOURCE_FOOTER', 'CRNRSTN_RESOURCE_IMAGE',
    'CRNRSTN_RESOURCE_DOCUMENT', 'CRNRSTN_RESOURCE_OPENSOURCE', 'CRNRSTN_RESOURCE_NEWS_SYNDICATION',
    'CRNRSTN_RESOURCE_ELECTRUM', 'CRNRSTN_RESOURCE_THIRDPARTY', 'CRNRSTN_WORDPRESS_DEBUG',
    'CRNRSTN_DB_LOG_TABLES_NO_ROLLOVER',
    'CRNRSTN_DB_LOG_TABLES_ROLLOVER_TTL', 'CRNRSTN_DB_LOG_TABLE_ROLLOVER_MAX_RECORDS');

    //
    // DEFINE INTEGER LENGTH FOR CONSTANT STORAGE...IN BITWISE FASHION...THIS IS HIGH-FALUTIN FASHION.
    @define('CRNRSTN_INTEGER_LENGTH', (int) ($this->os_bit_size - 1));

    foreach($CRNRSTN_CONSTANTS_ARRAY as $crnrstn_const_key => $crnrstn_constant_nom){

        $this->initialize_bit($crnrstn_constant_nom, false, crnrstn_constants_init($crnrstn_constant_nom));

    }

    //
    // INITIALIZE SYSTEM INTEGER CONSTANTS.
    $this->initialize_const_string_array($CRNRSTN_CONSTANTS_ARRAY);

}else{

    //
    // DEFINE INTEGER CONSTANTS.
    @define('CRNRSTN_DEBUG_OFF', (int) crnrstn_constants_init('CRNRSTN_DEBUG_OFF'));
    @define('CRNRSTN_DEBUG_NATIVE_ERR_LOG', (int) crnrstn_constants_init('CRNRSTN_DEBUG_NATIVE_ERR_LOG'));
    @define('CRNRSTN_DEBUG_AGGREGATION_ON', (int) crnrstn_constants_init('CRNRSTN_DEBUG_AGGREGATION_ON'));
    @define('CRNRSTN_CLIENT_SSDTLA_DEBUG', (int) crnrstn_constants_init('CRNRSTN_CLIENT_SSDTLA_DEBUG'));
    @define('CRNRSTN_HTML_COMMENTS_SILENT_GOLD', (int) crnrstn_constants_init('CRNRSTN_HTML_COMMENTS_SILENT_GOLD'));
    @define('CRNRSTN_HTML_COMMENTS_NONE', (int) crnrstn_constants_init('CRNRSTN_HTML_COMMENTS_NONE'));
    @define('CRNRSTN_HTML_COMMENTS_CDN_STABILITY_CONTROL_ENABLED', (int) crnrstn_constants_init('CRNRSTN_HTML_COMMENTS_CDN_STABILITY_CONTROL_ENABLED'));
    @define('CRNRSTN_HTML_COMMENTS_ENLARGED_PHYLACTERIES', (int) crnrstn_constants_init('CRNRSTN_HTML_COMMENTS_ENLARGED_PHYLACTERIES'));
    @define('CRNRSTN_HTML_COMMENTS_FULL', (int) crnrstn_constants_init('CRNRSTN_HTML_COMMENTS_FULL'));
    @define('CRNRSTN_LOG_ALL', (int) crnrstn_constants_init('CRNRSTN_LOG_ALL'));
    @define('CRNRSTN_STRING', (int) crnrstn_constants_init('CRNRSTN_STRING'));
    @define('CRNRSTN_INT', (int) crnrstn_constants_init('CRNRSTN_INT'));
    @define('CRNRSTN_INTEGER', (int) crnrstn_constants_init('CRNRSTN_INTEGER'));
    @define('CRNRSTN_BOOL', (int) crnrstn_constants_init('CRNRSTN_BOOL'));
    @define('CRNRSTN_BOOLEAN', (int) crnrstn_constants_init('CRNRSTN_BOOLEAN'));
    @define('CRNRSTN_FLOAT', (int) crnrstn_constants_init('CRNRSTN_FLOAT'));
    @define('CRNRSTN_DOUBLE', (int) crnrstn_constants_init('CRNRSTN_DOUBLE'));
    @define('CRNRSTN_ARRAY', (int) crnrstn_constants_init('CRNRSTN_ARRAY'));
    @define('CRNRSTN_OBJECT', (int) crnrstn_constants_init('CRNRSTN_OBJECT'));
    @define('CRNRSTN_RESOURCE', (int) crnrstn_constants_init('CRNRSTN_RESOURCE'));
    @define('CRNRSTN_RESOURCE_CLOSED', (int) crnrstn_constants_init('CRNRSTN_RESOURCE_CLOSED'));
    @define('CRNRSTN_UNKNOWN_TYPE', (int) crnrstn_constants_init('CRNRSTN_UNKNOWN_TYPE'));
    @define('CRNRSTN_NULL', (int) crnrstn_constants_init('CRNRSTN_NULL'));
    @define('CRNRSTN_MIXED', (int) crnrstn_constants_init('CRNRSTN_MIXED'));
    @define('CRNRSTN_IS_HTML', (int) crnrstn_constants_init('CRNRSTN_IS_HTML'));
    @define('CRNRSTN_LOG_NONE', (int) crnrstn_constants_init('CRNRSTN_LOG_NONE'));
    @define('CRNRSTN_LOG_EMAIL', (int) crnrstn_constants_init('CRNRSTN_LOG_EMAIL'));
    @define('CRNRSTN_LOG_EMAIL_PROXY', (int) crnrstn_constants_init('CRNRSTN_LOG_EMAIL_PROXY'));
    @define('CRNRSTN_LOG_FILE', (int) crnrstn_constants_init('CRNRSTN_LOG_FILE'));
    @define('CRNRSTN_LOG_FILE_PROXY', (int) crnrstn_constants_init('CRNRSTN_LOG_FILE_PROXY'));
    @define('CRNRSTN_LOG_FILE_FTP', (int) crnrstn_constants_init('CRNRSTN_LOG_FILE_FTP'));
    @define('CRNRSTN_LOG_SCREEN_TEXT', (int) crnrstn_constants_init('CRNRSTN_LOG_SCREEN_TEXT'));
    @define('CRNRSTN_LOG_SCREEN', (int) crnrstn_constants_init('CRNRSTN_LOG_SCREEN'));
    @define('CRNRSTN_LOG_SCREEN_HTML', (int) crnrstn_constants_init('CRNRSTN_LOG_SCREEN_HTML'));
    @define('CRNRSTN_LOG_SCREEN_HTML_HIDDEN', (int) crnrstn_constants_init('CRNRSTN_LOG_SCREEN_HTML_HIDDEN'));
    @define('CRNRSTN_LOG_DEFAULT', (int) crnrstn_constants_init('CRNRSTN_LOG_DEFAULT'));
    @define('CRNRSTN_LOG_DEFAULT_PROXY', (int) crnrstn_constants_init('CRNRSTN_LOG_DEFAULT_PROXY'));
    @define('CRNRSTN_LOG_ELECTRUM', (int) crnrstn_constants_init('CRNRSTN_LOG_ELECTRUM'));
    @define('CRNRSTN_AUTHORIZED_ACCOUNT', (int) crnrstn_constants_init('CRNRSTN_AUTHORIZED_ACCOUNT'));
    @define('CRNRSTN_AUTHORIZED_IP', (int) crnrstn_constants_init('CRNRSTN_AUTHORIZED_IP'));
    @define('CRNRSTN_INTEGER_LENGTH', (int) crnrstn_constants_init('CRNRSTN_INTEGER_LENGTH'));
    @define('CRNRSTN_SETTINGS_APACHE', (int) crnrstn_constants_init('CRNRSTN_SETTINGS_APACHE'));
    @define('CRNRSTN_SETTINGS_MYSQLI', (int) crnrstn_constants_init('CRNRSTN_SETTINGS_MYSQLI'));
    @define('CRNRSTN_SETTINGS_PHP', (int) crnrstn_constants_init('CRNRSTN_SETTINGS_PHP'));
    @define('CRNRSTN_SETTINGS_CRNRSTN', (int) crnrstn_constants_init('CRNRSTN_SETTINGS_CRNRSTN'));
    @define('CRNRSTN_SETTINGS_WORDPRESS', (int) crnrstn_constants_init('CRNRSTN_SETTINGS_WORDPRESS'));
    @define('CRNRSTN_SETTINGS_CLIENT', (int) crnrstn_constants_init('CRNRSTN_SETTINGS_CLIENT'));
    @define('CRNRSTN_DATABASE', (int) crnrstn_constants_init('CRNRSTN_DATABASE'));
    @define('CRNRSTN_DATABASE_CONNECTION', (int) crnrstn_constants_init('CRNRSTN_DATABASE_CONNECTION'));
    @define('CRNRSTN_DATABASE_QUERY', (int) crnrstn_constants_init('CRNRSTN_DATABASE_QUERY'));
    @define('CRNRSTN_DATABASE_QUERY_SILO', (int) crnrstn_constants_init('CRNRSTN_DATABASE_QUERY_SILO'));
    @define('CRNRSTN_DATABASE_QUERY_DYNAMIC', (int) crnrstn_constants_init('CRNRSTN_DATABASE_QUERY_DYNAMIC'));
    @define('CRNRSTN_DATABASE_RESULT', (int) crnrstn_constants_init('CRNRSTN_DATABASE_RESULT'));
    @define('CRNRSTN_DB_LOG_TABLES_NO_ROLLOVER', (int) crnrstn_constants_init('CRNRSTN_DB_LOG_TABLES_NO_ROLLOVER'));
    @define('CRNRSTN_DB_LOG_TABLES_ROLLOVER_TTL', (int) crnrstn_constants_init('CRNRSTN_DB_LOG_TABLES_ROLLOVER_TTL'));
    @define('CRNRSTN_DB_LOG_TABLE_ROLLOVER_MAX_RECORDS', (int) crnrstn_constants_init('CRNRSTN_DB_LOG_TABLE_ROLLOVER_MAX_RECORDS'));
    @define('CRNRSTN_PERFORMANCE_MONITOR', (int) crnrstn_constants_init('CRNRSTN_PERFORMANCE_MONITOR'));
    @define('CRNRSTN_IP_SECURITY', (int) crnrstn_constants_init('CRNRSTN_IP_SECURITY'));
    @define('CRNRSTN_GABRIEL', (int) crnrstn_constants_init('CRNRSTN_GABRIEL'));
    @define('CRNRSTN_SMTP_AUTHENTICATION', (int) crnrstn_constants_init('CRNRSTN_SMTP_AUTHENTICATION'));
    @define('CRNRSTN_EMAIL_CRNRSTN_SOURCE', (int) crnrstn_constants_init('CRNRSTN_EMAIL_CRNRSTN_SOURCE'));
    @define('CRNRSTN_EMAIL_USER_SOURCE', (int) crnrstn_constants_init('CRNRSTN_EMAIL_USER_SOURCE'));
    @define('CRNRSTN_ELECTRUM', (int) crnrstn_constants_init('CRNRSTN_ELECTRUM'));
    @define('CRNRSTN_ELECTRUM_THREAD', (int) crnrstn_constants_init('CRNRSTN_ELECTRUM_THREAD'));
    @define('CRNRSTN_ELECTRUM_COMM', (int) crnrstn_constants_init('CRNRSTN_ELECTRUM_COMM'));
    @define('CRNRSTN_ELECTRUM_FTP', (int) crnrstn_constants_init('CRNRSTN_ELECTRUM_FTP'));
    @define('CRNRSTN_ELECTRUM_LOCALDIR', (int) crnrstn_constants_init('CRNRSTN_ELECTRUM_LOCALDIR'));
    @define('CRNRSTN_FILE_MANAGEMENT', (int) crnrstn_constants_init('CRNRSTN_FILE_MANAGEMENT'));
    @define('CRNRSTN_CREATIVE_EMBED', (int) crnrstn_constants_init('CRNRSTN_CREATIVE_EMBED'));
    @define('CRNRSTN_FILE_RECEIVE', (int) crnrstn_constants_init('CRNRSTN_FILE_RECEIVE'));
    @define('CRNRSTN_FILE_LOCALDIR_MOVE', (int) crnrstn_constants_init('CRNRSTN_FILE_LOCALDIR_MOVE'));
    @define('CRNRSTN_FILE_FTP_SEND', (int) crnrstn_constants_init('CRNRSTN_FILE_FTP_SEND'));
    @define('CRNRSTN_FILE_FTP_RECEIVE', (int) crnrstn_constants_init('CRNRSTN_FILE_FTP_RECEIVE'));
    @define('CRNRSTN_FILE_SOAP_SEND', (int) crnrstn_constants_init('CRNRSTN_FILE_SOAP_SEND'));
    @define('CRNRSTN_FILE_SOAP_RECEIVE', (int) crnrstn_constants_init('CRNRSTN_FILE_SOAP_RECEIVE'));
    @define('CRNRSTN_FILE_CURL_SEND', (int) crnrstn_constants_init('CRNRSTN_FILE_CURL_SEND'));
    @define('CRNRSTN_FILE_CURL_RECEIVE', (int) crnrstn_constants_init('CRNRSTN_FILE_CURL_RECEIVE'));
    @define('CRNRSTN_CSS_EMAIL_CLIENT_VALIDATE', (int) crnrstn_constants_init('CRNRSTN_CSS_EMAIL_CLIENT_VALIDATE'));
    @define('CRNRSTN_BARNEY', (int) crnrstn_constants_init('CRNRSTN_BARNEY'));
    @define('CRNRSTN_BARNEY_DATABASE', (int) crnrstn_constants_init('CRNRSTN_BARNEY_DATABASE'));
    @define('CRNRSTN_BARNEY_FILE', (int) crnrstn_constants_init('CRNRSTN_BARNEY_FILE'));
    @define('CRNRSTN_BARNEY_FTP', (int) crnrstn_constants_init('CRNRSTN_BARNEY_FTP'));
    @define('CRNRSTN_BARNEY_ELECTRUM', (int) crnrstn_constants_init('CRNRSTN_BARNEY_ELECTRUM'));
    @define('CRNRSTN_BARNEY_GABRIEL', (int) crnrstn_constants_init('CRNRSTN_BARNEY_GABRIEL'));
    @define('CRNRSTN_BARNEY_DISK', (int) crnrstn_constants_init('CRNRSTN_BARNEY_DISK'));
    @define('CRNRSTN_SOAP', (int) crnrstn_constants_init('CRNRSTN_SOAP'));
    @define('CRNRSTN_SOAP_SERVER', (int) crnrstn_constants_init('CRNRSTN_SOAP_SERVER'));
    @define('CRNRSTN_SOAP_CLIENT', (int) crnrstn_constants_init('CRNRSTN_SOAP_CLIENT'));
    @define('CRNRSTN_PROXY_KINGS_HIGHWAY', (int) crnrstn_constants_init('CRNRSTN_PROXY_KINGS_HIGHWAY'));
    @define('CRNRSTN_PROXY_EMAIL', (int) crnrstn_constants_init('CRNRSTN_PROXY_EMAIL'));
    @define('CRNRSTN_PROXY_ELECTRUM', (int) crnrstn_constants_init('CRNRSTN_PROXY_ELECTRUM'));
    @define('CRNRSTN_PROXY_AUTHENTICATE', (int) crnrstn_constants_init('CRNRSTN_PROXY_AUTHENTICATE'));
    @define('CRNRSTN_UI_PHPNIGHT', (int) crnrstn_constants_init('CRNRSTN_UI_PHPNIGHT'));
    @define('CRNRSTN_UI_DARKNIGHT', (int) crnrstn_constants_init('CRNRSTN_UI_DARKNIGHT'));
    @define('CRNRSTN_UI_PHP', (int) crnrstn_constants_init('CRNRSTN_UI_PHP'));
    @define('CRNRSTN_UI_GREYSKY', (int) crnrstn_constants_init('CRNRSTN_UI_GREYSKY'));
    @define('CRNRSTN_UI_HTML', (int) crnrstn_constants_init('CRNRSTN_UI_HTML'));
    @define('CRNRSTN_UI_DAYLIGHT', (int) crnrstn_constants_init('CRNRSTN_UI_DAYLIGHT'));
    @define('CRNRSTN_UI_FEATHER', (int) crnrstn_constants_init('CRNRSTN_UI_FEATHER'));
    @define('CRNRSTN_UI_GLASS_LIGHT_COPY', (int) crnrstn_constants_init('CRNRSTN_UI_GLASS_LIGHT_COPY'));
    @define('CRNRSTN_UI_GLASS_DARK_COPY', (int) crnrstn_constants_init('CRNRSTN_UI_GLASS_DARK_COPY'));
    @define('CRNRSTN_UI_WOOD', (int) crnrstn_constants_init('CRNRSTN_UI_WOOD'));
    @define('CRNRSTN_UI_TERMINAL', (int) crnrstn_constants_init('CRNRSTN_UI_TERMINAL'));
    @define('CRNRSTN_UI_RANDOM', (int) crnrstn_constants_init('CRNRSTN_UI_RANDOM'));
    @define('CRNRSTN_CHANNEL_DESKTOP', (int) crnrstn_constants_init('CRNRSTN_CHANNEL_DESKTOP'));
    @define('CRNRSTN_CHANNEL_TABLET', (int) crnrstn_constants_init('CRNRSTN_CHANNEL_TABLET'));
    @define('CRNRSTN_CHANNEL_MOBILE', (int) crnrstn_constants_init('CRNRSTN_CHANNEL_MOBILE'));
    @define('CRNRSTN_UI_INTERACT', (int) crnrstn_constants_init('CRNRSTN_UI_INTERACT'));
    @define('CRNRSTN_UI_TAG_ANALYTICS', (int) crnrstn_constants_init('CRNRSTN_UI_TAG_ANALYTICS'));
    @define('CRNRSTN_UI_TAG_ENGAGEMENT', (int) crnrstn_constants_init('CRNRSTN_UI_TAG_ENGAGEMENT'));
    @define('CRNRSTN_ICY_BITMASK', (int) crnrstn_constants_init('CRNRSTN_ICY_BITMASK'));
    @define('CRNRSTN_SOAP_DATA_TUNNEL', (int) crnrstn_constants_init('CRNRSTN_SOAP_DATA_TUNNEL'));
    @define('CRNRSTN_UI_SOAP_DATA_TUNNEL', (int) crnrstn_constants_init('CRNRSTN_UI_SOAP_DATA_TUNNEL'));
    @define('CRNRSTN_HTML', (int) crnrstn_constants_init('CRNRSTN_HTML'));
    @define('CRNRSTN_BASE64', (int) crnrstn_constants_init('CRNRSTN_BASE64'));
    @define('CRNRSTN_BASE64_PNG', (int) crnrstn_constants_init('CRNRSTN_BASE64_PNG'));
    @define('CRNRSTN_BASE64_JPEG', (int) crnrstn_constants_init('CRNRSTN_BASE64_JPEG'));
    @define('CRNRSTN_BASE64_GIF', (int) crnrstn_constants_init('CRNRSTN_BASE64_GIF'));
    @define('CRNRSTN_FAVICON', (int) crnrstn_constants_init('CRNRSTN_FAVICON'));
    @define('CRNRSTN_JPEG', (int) crnrstn_constants_init('CRNRSTN_JPEG'));
    @define('CRNRSTN_PNG', (int) crnrstn_constants_init('CRNRSTN_PNG'));
    @define('CRNRSTN_GIF', (int) crnrstn_constants_init('CRNRSTN_GIF'));
    @define('CRNRSTN_STRING', (int) crnrstn_constants_init('CRNRSTN_STRING'));
    @define('CRNRSTN_CSS', (int) crnrstn_constants_init('CRNRSTN_CSS'));
    @define('CRNRSTN_JS', (int) crnrstn_constants_init('CRNRSTN_JS'));
    @define('CRNRSTN_IMG', (int) crnrstn_constants_init('CRNRSTN_IMG'));
    @define('CRNRSTN_JS_CSS_PROD_MIN', (int) crnrstn_constants_init('CRNRSTN_JS_CSS_PROD_MIN'));
    @define('CRNRSTN_CSS_MAIN_DESKTOP', (int) crnrstn_constants_init('CRNRSTN_CSS_MAIN_DESKTOP'));
    @define('CRNRSTN_CSS_MAIN_TABLET', (int) crnrstn_constants_init('CRNRSTN_CSS_MAIN_TABLET'));
    @define('CRNRSTN_CSS_MAIN_MOBILE', (int) crnrstn_constants_init('CRNRSTN_CSS_MAIN_MOBILE'));
    @define('CRNRSTN_CSS_FRAMEWORK_SIMPLE_GRID', (int) crnrstn_constants_init('CRNRSTN_CSS_FRAMEWORK_SIMPLE_GRID'));
    @define('CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM', (int) crnrstn_constants_init('CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM'));
    @define('CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_24COL', (int) crnrstn_constants_init('CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_24COL'));
    @define('CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_16COL', (int) crnrstn_constants_init('CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_16COL'));
    @define('CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_12COL', (int) crnrstn_constants_init('CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_12COL'));
    @define('CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_24COL_RTL', (int) crnrstn_constants_init('CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_24COL_RTL'));
    @define('CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_16COL_RTL', (int) crnrstn_constants_init('CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_16COL_RTL'));
    @define('CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_12COL_RTL', (int) crnrstn_constants_init('CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_12COL_RTL'));
    @define('CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_RTL', (int) crnrstn_constants_init('CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_RTL'));
    @define('CRNRSTN_CSS_FRAMEWORK_FOUNDATION', (int) crnrstn_constants_init('CRNRSTN_CSS_FRAMEWORK_FOUNDATION'));
    @define('CRNRSTN_CSS_FRAMEWORK_FOUNDATION_6', (int) crnrstn_constants_init('CRNRSTN_CSS_FRAMEWORK_FOUNDATION_6'));
    @define('CRNRSTN_CSS_FRAMEWORK_HTML5_BOILERPLATE', (int) crnrstn_constants_init('CRNRSTN_CSS_FRAMEWORK_HTML5_BOILERPLATE'));
    @define('CRNRSTN_CSS_FRAMEWORK_HTML5_BOILERPLATE_8_0_0', (int) crnrstn_constants_init('CRNRSTN_CSS_FRAMEWORK_HTML5_BOILERPLATE_8_0_0'));
    @define('CRNRSTN_CSS_FRAMEWORK_RESPONSIVE_GRID_SYSTEM', (int) crnrstn_constants_init('CRNRSTN_CSS_FRAMEWORK_RESPONSIVE_GRID_SYSTEM'));
    @define('CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC', (int) crnrstn_constants_init('CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC'));
    @define('CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_RTL', (int) crnrstn_constants_init('CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_RTL'));
    @define('CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_RESET', (int) crnrstn_constants_init('CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_RESET'));
    @define('CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_RESET_RTL', (int) crnrstn_constants_init('CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_RESET_RTL'));
    @define('CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_ADAPT', (int) crnrstn_constants_init('CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_ADAPT'));
    @define('CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_ADAPT_RTL', (int) crnrstn_constants_init('CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_ADAPT_RTL'));
    @define('CRNRSTN_CSS_FRAMEWORK_DEAD_SIMPLE_GRID', (int) crnrstn_constants_init('CRNRSTN_CSS_FRAMEWORK_DEAD_SIMPLE_GRID'));
    @define('CRNRSTN_CSS_FRAMEWORK_SKELETON', (int) crnrstn_constants_init('CRNRSTN_CSS_FRAMEWORK_SKELETON'));
    @define('CRNRSTN_CSS_FRAMEWORK_RWDGRID', (int) crnrstn_constants_init('CRNRSTN_CSS_FRAMEWORK_RWDGRID'));
    @define('CRNRSTN_CSS_FRAMEWORK_RWDGRID_2_0', (int) crnrstn_constants_init('CRNRSTN_CSS_FRAMEWORK_RWDGRID_2_0'));
    @define('CRNRSTN_CSS_FRAMEWORK_THIS_IS_DALLAS_SIMPLE_GRID', (int) crnrstn_constants_init('CRNRSTN_CSS_FRAMEWORK_THIS_IS_DALLAS_SIMPLE_GRID'));
    @define('CRNRSTN_JS_MAIN', (int) crnrstn_constants_init('CRNRSTN_JS_MAIN'));
    @define('CRNRSTN_JS_FRAMEWORK_JQUERY', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_JQUERY'));
    @define('CRNRSTN_JS_FRAMEWORK_JQUERY_3_7_0', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_JQUERY_3_7_0'));
    @define('CRNRSTN_JS_FRAMEWORK_JQUERY_3_6_1', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_JQUERY_3_6_1'));
    @define('CRNRSTN_JS_FRAMEWORK_JQUERY_2_2_4', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_JQUERY_2_2_4'));
    @define('CRNRSTN_JS_FRAMEWORK_JQUERY_1_12_4', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_JQUERY_1_12_4'));
    @define('CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1'));
    @define('CRNRSTN_JS_FRAMEWORK_JQUERY_UI', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_JQUERY_UI'));
    @define('CRNRSTN_JS_FRAMEWORK_JQUERY_UI_1_13_2', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_JQUERY_UI_1_13_2'));
    @define('CRNRSTN_JS_FRAMEWORK_JQUERY_UI_1_12_1', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_JQUERY_UI_1_12_1'));
    @define('CRNRSTN_JS_FRAMEWORK_JQUERY_MOBILE', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_JQUERY_MOBILE'));
    @define('CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS'));
    @define('CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_2_11_3', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_2_11_3'));
    @define('CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_2_10_0', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_2_10_0'));
    @define('CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_PLUS_JQUERY', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_PLUS_JQUERY'));
    @define('CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_2_03_3', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_2_03_3'));
    @define('CRNRSTN_JS_FRAMEWORK_REACT_CDN', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_REACT_CDN'));
    @define('CRNRSTN_JS_FRAMEWORK_REACT_CDN_18_2_0', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_REACT_CDN_18_2_0'));
    @define('CRNRSTN_JS_FRAMEWORK_REACT_DOM_CDN', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_REACT_DOM_CDN'));
    @define('CRNRSTN_JS_FRAMEWORK_REACT_DOM_CDN_18_2_0', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_REACT_DOM_CDN_18_2_0'));
    @define('CRNRSTN_JS_FRAMEWORK_MITHRIL_CDN', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_MITHRIL_CDN'));
    @define('CRNRSTN_JS_FRAMEWORK_MITHRIL_CDN_2_2_2', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_MITHRIL_CDN_2_2_2'));
    @define('CRNRSTN_JS_FRAMEWORK_PROTOTYPE', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_PROTOTYPE'));
    @define('CRNRSTN_JS_FRAMEWORK_PROTOTYPE_1_7_3', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_PROTOTYPE_1_7_3'));
    @define('CRNRSTN_JS_FRAMEWORK_SCRIPTACULOUS', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_SCRIPTACULOUS'));
    @define('CRNRSTN_JS_FRAMEWORK_PROTOTYPE_MOOFX', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_PROTOTYPE_MOOFX'));
    @define('CRNRSTN_JS_FRAMEWORK_SWFOBJECT_DOT_JS', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_SWFOBJECT_DOT_JS'));
    @define('CRNRSTN_JS_FRAMEWORK_MOOTOOLS_MORE', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_MOOTOOLS_MORE'));
    @define('CRNRSTN_JS_FRAMEWORK_MOOTOOLS_MORE_1_6_0', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_MOOTOOLS_MORE_1_6_0'));
    @define('CRNRSTN_JS_FRAMEWORK_MOOTOOLS_CORE', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_MOOTOOLS_CORE'));
    @define('CRNRSTN_JS_FRAMEWORK_MOOTOOLS_CORE_1_6_0', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_MOOTOOLS_CORE_1_6_0'));
    @define('CRNRSTN_JS_FRAMEWORK_BACKBONE', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_BACKBONE'));
    @define('CRNRSTN_JS_FRAMEWORK_BACKBONE_1_4_1', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_BACKBONE_1_4_1'));
    @define('CRNRSTN_JS_FRAMEWORK_UNDERSCORE_UMD', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_UNDERSCORE_UMD'));
    @define('CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_UMD', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_UMD'));
    @define('CRNRSTN_JS_FRAMEWORK_UNDERSCORE_ESM', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_UNDERSCORE_ESM'));
    @define('CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_ESM', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_ESM'));
    @define('CRNRSTN_JS_FRAMEWORK_UNDERSCORE_UMD_EDGE', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_UNDERSCORE_UMD_EDGE'));
    @define('CRNRSTN_JS_FRAMEWORK_UNDERSCORE_ESM_EDGE', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_UNDERSCORE_ESM_EDGE'));
    @define('CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_UMD_CDN', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_UMD_CDN'));
    @define('CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_ESM_CDN', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_ESM_CDN'));
    @define('CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_UMD_UNPKG', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_UMD_UNPKG'));
    @define('CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_ESM_UNPKG', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_ESM_UNPKG'));
    @define('CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_UMD_PAGECDN', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_UMD_PAGECDN'));
    @define('CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_ESM_PAGECDN', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_ESM_PAGECDN'));
    @define('CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_UMD_CDNJS', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_UMD_CDNJS'));
    @define('CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_ESM_CDNJS', (int) crnrstn_constants_init('CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_ESM_CDNJS'));
    @define('CRNRSTN_UI_FORM_INTEGRATION_PACKET', (int) crnrstn_constants_init('CRNRSTN_UI_FORM_INTEGRATION_PACKET'));
    @define('CRNRSTN_UI_COOKIE_PREFERENCE', (int) crnrstn_constants_init('CRNRSTN_UI_COOKIE_PREFERENCE'));
    @define('CRNRSTN_UI_COOKIE_YESNO', (int) crnrstn_constants_init('CRNRSTN_UI_COOKIE_YESNO'));
    @define('CRNRSTN_UI_COOKIE_NOTICE', (int) crnrstn_constants_init('CRNRSTN_UI_COOKIE_NOTICE'));
    @define('CRNRSTN_ASSET_MODE_BASE64', (int) crnrstn_constants_init('CRNRSTN_ASSET_MODE_BASE64'));
    @define('CRNRSTN_ASSET_MODE_PNG', (int) crnrstn_constants_init('CRNRSTN_ASSET_MODE_PNG'));
    @define('CRNRSTN_ASSET_MODE_JPEG', (int) crnrstn_constants_init('CRNRSTN_ASSET_MODE_JPEG'));
    @define('CRNRSTN_CHANNEL_RUNTIME', (int) crnrstn_constants_init('CRNRSTN_CHANNEL_RUNTIME'));
    @define('CRNRSTN_CHANNEL_ALL', (int) crnrstn_constants_init('CRNRSTN_CHANNEL_ALL'));
    @define('CRNRSTN_CHANNEL_DATABASE', (int) crnrstn_constants_init('CRNRSTN_CHANNEL_DATABASE'));
    @define('CRNRSTN_CHANNEL_SSDTLA', (int) crnrstn_constants_init('CRNRSTN_CHANNEL_SSDTLA'));
    @define('CRNRSTN_CHANNEL_PSSDTLA', (int) crnrstn_constants_init('CRNRSTN_CHANNEL_PSSDTLA'));
    @define('CRNRSTN_CHANNEL_SESSION', (int) crnrstn_constants_init('CRNRSTN_CHANNEL_SESSION'));
    @define('CRNRSTN_CHANNEL_COOKIE', (int) crnrstn_constants_init('CRNRSTN_CHANNEL_COOKIE'));
    @define('CRNRSTN_CHANNEL_SOAP', (int) crnrstn_constants_init('CRNRSTN_CHANNEL_SOAP'));
    @define('CRNRSTN_CHANNEL_GET', (int) crnrstn_constants_init('CRNRSTN_CHANNEL_GET'));
    @define('CRNRSTN_CHANNEL_POST', (int) crnrstn_constants_init('CRNRSTN_CHANNEL_POST'));
    @define('CRNRSTN_CHANNEL_FILE', (int) crnrstn_constants_init('CRNRSTN_CHANNEL_FILE'));
    @define('CRNRSTN_CHANNEL_FORM_INTEGRATIONS', (int) crnrstn_constants_init('CRNRSTN_CHANNEL_FORM_INTEGRATIONS'));
    @define('CRNRSTN_AUTHORIZE_ALL', (int) crnrstn_constants_init('CRNRSTN_AUTHORIZE_ALL'));
    @define('CRNRSTN_AUTHORIZE_RUNTIME', (int) crnrstn_constants_init('CRNRSTN_AUTHORIZE_RUNTIME'));
    @define('CRNRSTN_AUTHORIZE_DATABASE', (int) crnrstn_constants_init('CRNRSTN_AUTHORIZE_DATABASE'));
    @define('CRNRSTN_AUTHORIZE_SSDTLA', (int) crnrstn_constants_init('CRNRSTN_AUTHORIZE_SSDTLA'));
    @define('CRNRSTN_AUTHORIZE_PSSDTLA', (int) crnrstn_constants_init('CRNRSTN_AUTHORIZE_PSSDTLA'));
    @define('CRNRSTN_AUTHORIZE_SESSION', (int) crnrstn_constants_init('CRNRSTN_AUTHORIZE_SESSION'));
    @define('CRNRSTN_AUTHORIZE_COOKIE', (int) crnrstn_constants_init('CRNRSTN_AUTHORIZE_COOKIE'));
    @define('CRNRSTN_AUTHORIZE_SOAP', (int) crnrstn_constants_init('CRNRSTN_AUTHORIZE_SOAP'));
    @define('CRNRSTN_AUTHORIZE_GET', (int) crnrstn_constants_init('CRNRSTN_AUTHORIZE_GET'));
    @define('CRNRSTN_AUTHORIZE_POST', (int) crnrstn_constants_init('CRNRSTN_AUTHORIZE_POST'));
    @define('CRNRSTN_AUTHORIZE_FILE', (int) crnrstn_constants_init('CRNRSTN_AUTHORIZE_FILE'));

    // Tuesday, August 16, 2022 @ 0131 hrs :: oCRNRSTN TAKES THE PLACE OF (AND INTERNALIZES) oCRNRSTN_USR AS "THE HANDLE"
    // Tuesday, August 16, 2022 @ 2333 hrs [CRNRSTN_AUTHORIZE_ISEMAIL, CRNRSTN_AUTHORIZE_ISPASSWORD]
    @define('CRNRSTN_AUTHORIZE_ISUSERNAME', (int) crnrstn_constants_init('CRNRSTN_AUTHORIZE_ISUSERNAME'));
    @define('CRNRSTN_AUTHORIZE_ISEMAIL', (int) crnrstn_constants_init('CRNRSTN_AUTHORIZE_ISEMAIL'));
    @define('CRNRSTN_AUTHORIZE_ISPASSWORD', (int) crnrstn_constants_init('CRNRSTN_AUTHORIZE_ISPASSWORD'));

    @define('CRNRSTN_HTTP_REDIRECT', (int) crnrstn_constants_init('CRNRSTN_HTTP_REDIRECT'));
    @define('CRNRSTN_HTTPS_REDIRECT', (int) crnrstn_constants_init('CRNRSTN_HTTPS_REDIRECT'));
    @define('CRNRSTN_HTTP_DATA_RETURN', (int) crnrstn_constants_init('CRNRSTN_HTTP_DATA_RETURN'));
    @define('CRNRSTN_HTTPS_DATA_RETURN', (int) crnrstn_constants_init('CRNRSTN_HTTPS_DATA_RETURN'));
    @define('CRNRSTN_SERVER_RESPONSE_CODE', (int) crnrstn_constants_init('CRNRSTN_SERVER_RESPONSE_CODE'));

    @define('CRNRSTN_RESPONSE_REPORT', (int) crnrstn_constants_init('CRNRSTN_RESPONSE_REPORT'));

    @define('CRNRSTN_JSON_RETURN', (int) crnrstn_constants_init('CRNRSTN_JSON_RETURN'));
    @define('CRNRSTN_XML_RETURN', (int) crnrstn_constants_init('CRNRSTN_XML_RETURN'));
    @define('CRNRSTN_SOAP_RETURN', (int) crnrstn_constants_init('CRNRSTN_SOAP_RETURN'));
    @define('CRNRSTN_DOCUMENT_FILE_RETURN', (int) crnrstn_constants_init('CRNRSTN_DOCUMENT_FILE_RETURN'));
    @define('CRNRSTN_HTML_TEXT_RETURN', (int) crnrstn_constants_init('CRNRSTN_HTML_TEXT_RETURN'));

    @define('CRNRSTN_ENCRYPT_TUNNEL', (int) crnrstn_constants_init('CRNRSTN_ENCRYPT_TUNNEL'));
    @define('CRNRSTN_ENCRYPT_GET', (int) crnrstn_constants_init('CRNRSTN_ENCRYPT_GET'));
    @define('CRNRSTN_ENCRYPT_POST', (int) crnrstn_constants_init('CRNRSTN_ENCRYPT_POST'));
    @define('CRNRSTN_ENCRYPT_DATABASE', (int) crnrstn_constants_init('CRNRSTN_ENCRYPT_DATABASE'));
    @define('CRNRSTN_ENCRYPT_SESSION', (int) crnrstn_constants_init('CRNRSTN_ENCRYPT_SESSION'));
    @define('CRNRSTN_ENCRYPT_COOKIE', (int) crnrstn_constants_init('CRNRSTN_ENCRYPT_COOKIE'));
    @define('CRNRSTN_ENCRYPT_SOAP', (int) crnrstn_constants_init('CRNRSTN_ENCRYPT_SOAP'));
    @define('CRNRSTN_ENCRYPT_FILE', (int) crnrstn_constants_init('CRNRSTN_ENCRYPT_FILE'));
    @define('CRNRSTN_ENCRYPT_OERSL', (int) crnrstn_constants_init('CRNRSTN_ENCRYPT_OERSL'));

    @define('CRNRSTN_INPUT_OPTIONAL', (int) crnrstn_constants_init('CRNRSTN_INPUT_OPTIONAL'));
    @define('CRNRSTN_INPUT_REQUIRED', (int) crnrstn_constants_init('CRNRSTN_INPUT_REQUIRED'));
    @define('CRNRSTN_INPUT_PASSWORD', (int) crnrstn_constants_init('CRNRSTN_INPUT_PASSWORD'));
    @define('CRNRSTN_INPUT_IS_EMAIL', (int) crnrstn_constants_init('CRNRSTN_INPUT_IS_EMAIL'));
    @define('CRNRSTN_INPUT_IS_FILE_IMAGE_JPEG', (int) crnrstn_constants_init('CRNRSTN_INPUT_IS_FILE_IMAGE_JPEG'));
    @define('CRNRSTN_INPUT_IS_FILE_IMAGE_PNG', (int) crnrstn_constants_init('CRNRSTN_INPUT_IS_FILE_IMAGE_PNG'));
    @define('CRNRSTN_INPUT_IS_FILE_IMAGE_GIF', (int) crnrstn_constants_init('CRNRSTN_INPUT_IS_FILE_IMAGE_GIF'));
    @define('CRNRSTN_INPUT_IS_FILE_IMAGE', (int) crnrstn_constants_init('CRNRSTN_INPUT_IS_FILE_IMAGE'));
    @define('CRNRSTN_INPUT_IS_FILE_DOCUMENT', (int) crnrstn_constants_init('CRNRSTN_INPUT_IS_FILE_DOCUMENT'));
    @define('CRNRSTN_INPUT_IS_FILE_ZIP', (int) crnrstn_constants_init('CRNRSTN_INPUT_IS_FILE_ZIP'));
    @define('CRNRSTN_INPUT_CHAR_RESTRICTIONS', (int) crnrstn_constants_init('CRNRSTN_INPUT_CHAR_RESTRICTIONS'));
    @define('CRNRSTN_INPUT_CHAR_LIMITS', (int) crnrstn_constants_init('CRNRSTN_INPUT_CHAR_LIMITS'));

    @define('CRNRSTN_FAVICON_ASSET_MAPPING', (int) crnrstn_constants_init('CRNRSTN_FAVICON_ASSET_MAPPING'));
    @define('CRNRSTN_SYSTEM_IMG_ASSET_MAPPING', (int) crnrstn_constants_init('CRNRSTN_SYSTEM_IMG_ASSET_MAPPING'));
    @define('CRNRSTN_SOCIAL_IMG_ASSET_MAPPING', (int) crnrstn_constants_init('CRNRSTN_SOCIAL_IMG_ASSET_MAPPING'));
    @define('CRNRSTN_META_IMG_ASSET_MAPPING', (int) crnrstn_constants_init('CRNRSTN_META_IMG_ASSET_MAPPING'));

    @define('CRNRSTN_JS_ASSET_MAPPING', (int) crnrstn_constants_init('CRNRSTN_JS_ASSET_MAPPING'));
    @define('CRNRSTN_CSS_ASSET_MAPPING', (int) crnrstn_constants_init('CRNRSTN_CSS_ASSET_MAPPING'));

    @define('CRNRSTN_SYSTEM_EMAIL_IS_HTML', (int) crnrstn_constants_init('CRNRSTN_SYSTEM_EMAIL_IS_HTML'));
    @define('CRNRSTN_ASSET_MAPPING', (int) crnrstn_constants_init('CRNRSTN_ASSET_MAPPING'));
    @define('CRNRSTN_ASSET_MAPPING_PROXY', (int) crnrstn_constants_init('CRNRSTN_ASSET_MAPPING_PROXY'));

    @define('CRNRSTN_RESOURCE_ALL', (int) crnrstn_constants_init('CRNRSTN_RESOURCE_ALL'));
    @define('CRNRSTN_RESOURCE_BASSDRIVE', (int) crnrstn_constants_init('CRNRSTN_RESOURCE_BASSDRIVE'));
    @define('CRNRSTN_RESOURCE_NATIONAL_WEATHER_SERVICE', (int) crnrstn_constants_init('CRNRSTN_RESOURCE_NATIONAL_WEATHER_SERVICE'));
    @define('CRNRSTN_RESOURCE_CSS_VALIDATOR', (int) crnrstn_constants_init('CRNRSTN_RESOURCE_CSS_VALIDATOR'));
    @define('CRNRSTN_RESOURCE_DOCUMENTATION', (int) crnrstn_constants_init('CRNRSTN_RESOURCE_DOCUMENTATION'));
    @define('CRNRSTN_RESOURCE_DEEP_LINK', (int) crnrstn_constants_init('CRNRSTN_RESOURCE_DEEP_LINK'));

    @define('CRNRSTN_RESOURCE_FOOTER', (int) crnrstn_constants_init('CRNRSTN_RESOURCE_FOOTER'));
    @define('CRNRSTN_RESOURCE_IMAGE', (int) crnrstn_constants_init('CRNRSTN_RESOURCE_IMAGE'));
    @define('CRNRSTN_RESOURCE_DOCUMENT', (int) crnrstn_constants_init('CRNRSTN_RESOURCE_DOCUMENT'));
    @define('CRNRSTN_RESOURCE_OPENSOURCE', (int) crnrstn_constants_init('CRNRSTN_RESOURCE_OPENSOURCE'));
    @define('CRNRSTN_RESOURCE_NEWS_SYNDICATION', (int) crnrstn_constants_init('CRNRSTN_RESOURCE_NEWS_SYNDICATION'));
    @define('CRNRSTN_RESOURCE_ELECTRUM', (int) crnrstn_constants_init('CRNRSTN_RESOURCE_ELECTRUM'));
    @define('CRNRSTN_RESOURCE_THIRDPARTY', (int) crnrstn_constants_init('CRNRSTN_RESOURCE_THIRDPARTY'));

    @define('CRNRSTN_WORDPRESS_DEBUG', (int) crnrstn_constants_init('CRNRSTN_WORDPRESS_DEBUG'));

}

/*
CRNRSTN :: v2.00.0000
BIT FLIPPED ARCHITECTURE (BITWISE OPERATIONS) BASED LOG SILO INTEGER CONSTANT PROJECTION ::
Wednesday, April 7, 2021 @ 0044hrs

~ CRNRSTN_CONFIGURATION
    ~ CRNRSTN_SETTINGS_APACHE
    ~ CRNRSTN_SETTINGS_MYSQLI
    ~ CRNRSTN_SETTINGS_PHP
    ~ CRNRSTN_SETTINGS_CRNRSTN

~ CRNRSTN_DATABASE
    ~ CRNRSTN_DATABASE_CONNECTION
    ~ CRNRSTN_DATABASE_QUERY_SILO
    ~ CRNRSTN_DATABASE_QUERY_DYNAMIC
    ~ CRNRSTN_DATABASE_RESULTSET

~ CRNRSTN_GABRIEL
    ~ CRNRSTN_SMTP_AUTHENTICATION
    ~ CRNRSTN_GABRIEL
    ~ CRNRSTN_EMAIL_DYNAMIC

~ CRNRSTN_ELECTRUM
    ~ CRNRSTN_ELECTRUM_THREAD
    ~ CRNRSTN_ELECTRUM_COMM
    ~ CRNRSTN_ELECTRUM_FTP
    ~ CRNRSTN_ELECTRUM_LOCALDIR

[PERFORMANCE_MONITORING]

~ CRNRSTN_FILE_MANAGEMENT
    ~ CRNRSTN_CREATIVE_EMBED
    ~ CRNRSTN_FILE_RECEIVE
    ~ CRNRSTN_FILE_LOCALDIR_MOVE
    ~ CRNRSTN_FILE_FTP_SEND
    ~ CRNRSTN_FILE_FTP_RECEIVE
    ~ CRNRSTN_FILE_SOAP_SEND
    ~ CRNRSTN_FILE_SOAP_RECEIVE
    ~ CRNRSTN_FILE_CURL_SEND
    ~ CRNRSTN_FILE_CURL_RECEIVE

[VALIDATION_AND_TOLERANCES]
~ CRNRSTN_CSS_EMAIL_CLIENT_VALIDATE

~ CRNRSTN_BARNEY
    ~ CRNRSTN_BARNEY_DATABASE
    ~ CRNRSTN_BARNEY_FILE
    ~ CRNRSTN_BARNEY_FTP
    ~ CRNRSTN_BARNEY_ELECTRUM
    ~ CRNRSTN_BARNEY_GABRIEL
    ~ CRNRSTN_BARNEY_DISK

~ CRNRSTN_SOAP_SERVICES
    ~ CRNRSTN_PROXY_KINGS_HIGHWAY
    ~ CRNRSTN_PROXY_EMAIL
    ~ CRNRSTN_PROXY_ELECTRUM
    ~ CRNRSTN_PROXY_AUTHENTICATE

[DEBUGGING_ASSISTANCE_MODES]
~ CRNRSTN_LOG_ALL
~ CRNRSTN_LOG_NONE

*/

/*
ORIGINAL LOG SILO "STRING KEYS" PRE-CRNRSTN :: v2.00.0000 DEVELOPMENT ::
CIRCA ~2020 - Wednesday, April 7, 2021 @ 0044hrs

CRNRSTN_GABRIEL
CRNRSTN_CONFIGURATION_ERR
CRNRSTN_CONFIGURATION
CERTAIN_DESTRUCTION
CRNRSTN_ELECTRUM
CRNRSTN_LOG_TRACE
CRNRSTN_LOGGING_TEST
CRNRSTN_SYSTEM_NOTIFICATION
CRNRSTN_oELECTRUM_COMM
CRNRSTN_ELECTRUM
CRNRSTN_oELECTRUM
CRNRSTN_oELECTRUM_EXEC
CRNRSTN_oELECTRUM_FTP_DEBUG
CRNRSTN_LOG_ALL
ERROR
*
CRNRSTN_CSS
CRNRSTN_oELECTRUM_COMM
CRNRSTN_DATABASE
CRNRSTN_INTEGRATION_ACTIVITY
CRNRSTN_IMAGE_HTML

*/