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

/*
// FIRST GLOBAL SCOPE FUNCTION IN CRNRSTN ::
// Wednesday April 7, 2021 @ 1424 hrs

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
    private function return_output_CRNRSTN_UI_JS($const){
    private function return_output_CRNRSTN_UI_CSS($const){

*/

function crnrstn_constants_init($const_nom){

    switch($const_nom){
        //
        // 0-30, 32-41.
        // REGARDING (int) 31...NOTE THAT CRNRSTN_INTEGER_LENGTH = (int) ($this->os_bit_size - 1)
        // 'CRNRSTN_DEBUG_OFF', 'CRNRSTN_DEBUG_NATIVE_ERR_LOG', 'CRNRSTN_DEBUG_AGGREGATION_ON'
        case 'CRNRSTN_DEBUG_OFF':

            return (int) 0;

        break;
        case 'CRNRSTN_DEBUG_NATIVE_ERR_LOG':

            return (int) 1;

        break;
        case 'CRNRSTN_DEBUG_AGGREGATION_ON':

            return (int) 2;

        break;
        case 'CRNRSTN_CLIENT_SSDTLA_DEBUG':

            return (int) 3;

        break;

        //
        // 42-50
        // 'CRNRSTN_LOG_ALL', 'CRNRSTN_LOG_NONE'
        case 'CRNRSTN_LOG_NONE':

            return (int) 42;

        break;
        case 'CRNRSTN_LOG_ALL':

            return (int) 43;

        break;
        case 'CRNRSTN_AUTHORIZED_ACCOUNT':

            return (int) 44;

        break;

        //
        // 31, 51-62, 64-1051
        // REGARDING (int) 31...NOTE THAT CRNRSTN_INTEGER_LENGTH WILL = (int) ($this->os_bit_size - 1)
        // 'CRNRSTN_INTEGER_LENGTH', 'CRNRSTN_SETTINGS_APACHE', 'CRNRSTN_SETTINGS_MYSQLI', 'CRNRSTN_SETTINGS_PHP',
        // 'CRNRSTN_SETTINGS_CRNRSTN', 'CRNRSTN_SETTINGS_CLIENT'
        case 'CRNRSTN_INTEGER_LENGTH':

            return (int) 31;

        break;
        case 'CRNRSTN_SETTINGS_APACHE':

            return (int) 52;

        break;
        case 'CRNRSTN_SETTINGS_MYSQLI':

            return (int) 53;

        break;
        case 'CRNRSTN_SETTINGS_PHP':

            return (int) 54;

        break;
        case 'CRNRSTN_SETTINGS_CRNRSTN':

            return (int) 55;

        break;
        case 'CRNRSTN_SETTINGS_WORDPRESS':

            return (int) 56;

        break;
        case 'CRNRSTN_SETTINGS_CLIENT':

            return (int) 57;

        break;


        //
        // 1000
        // CRNRSTN_INPUT_OPTIONAL, CRNRSTN_INPUT_REQUIRED, CRNRSTN_INPUT_PASSWORD
        // CRNRSTN_INPUT_IS_FILE_IMAGE_JPEG, CRNRSTN_INPUT_IS_FILE_IMAGE_PNG,  CRNRSTN_INPUT_IS_FILE_IMAGE_GIF
        // CRNRSTN_INPUT_IS_FILE_IMAGE, CRNRSTN_INPUT_IS_FILE_DOCUMENT, CRNRSTN_INPUT_IS_FILE_ZIP,
        // CRNRSTN_INPUT_IS_EMAIL, CRNRSTN_INPUT_CHAR_RESTRICTIONS, CRNRSTN_INPUT_CHAR_LIMITS
        case 'CRNRSTN_INPUT_OPTIONAL':

            return (int) 1000;

        break;
        case 'CRNRSTN_INPUT_REQUIRED':

            return (int) 1001;

        break;
        case 'CRNRSTN_INPUT_PASSWORD':

            return (int) 1002;

        break;
        case 'CRNRSTN_INPUT_IS_EMAIL':

            return (int) 1003;

        break;
        case 'CRNRSTN_INPUT_CHAR_RESTRICTIONS':

            return (int) 1004;

        break;
        case 'CRNRSTN_INPUT_CHAR_LIMITS':

            return (int) 1005;

        break;
        case 'CRNRSTN_INPUT_IS_FILE_IMAGE':

            return (int) 1006;

        break;
        case 'CRNRSTN_INPUT_IS_FILE_IMAGE_PNG':

            return (int) 1007;

        break;
        case 'CRNRSTN_INPUT_IS_FILE_IMAGE_JPEG':

            return (int) 1008;

        break;
        case 'CRNRSTN_INPUT_IS_FILE_IMAGE_GIF':

            return (int) 1009;

        break;
        case 'CRNRSTN_INPUT_IS_FILE_DOCUMENT':

            return (int) 1010;

        break;
        case 'CRNRSTN_INPUT_IS_FILE_ZIP':

            return (int) 1011;

        break;


        //
        // 2051
        // 'CRNRSTN_DATABASE', 'CRNRSTN_DATABASE_CONNECTION', 'CRNRSTN_DATABASE_QUERY', 'CRNRSTN_DATABASE_QUERY_SILO',
        // 'CRNRSTN_DATABASE_QUERY_DYNAMIC', 'CRNRSTN_DATABASE_RESULT'
        case 'CRNRSTN_DATABASE':

            return (int) 2051;

        break;
        case 'CRNRSTN_DATABASE_CONNECTION':

            return (int) 2052;

        break;
        case 'CRNRSTN_DATABASE_QUERY':

            return (int) 2053;

        break;
        case 'CRNRSTN_DATABASE_QUERY_SILO':

            return (int) 2054;

        break;
        case 'CRNRSTN_DATABASE_QUERY_DYNAMIC':

            return (int) 2055;

        break;
        case 'CRNRSTN_DATABASE_RESULT':

            return (int) 2056;

        break;

        // 3051
        // 'CRNRSTN_GABRIEL', 'CRNRSTN_SMTP_AUTHENTICATION', 'CRNRSTN_EMAIL_CRNRSTN_SOURCE', 'CRNRSTN_EMAIL_USER_SOURCE'
        case 'CRNRSTN_GABRIEL':

            return (int) 3051;

        break;
        case 'CRNRSTN_SMTP_AUTHENTICATION':

            return (int) 3052;

        break;
        case 'CRNRSTN_EMAIL_CRNRSTN_SOURCE':

            return (int) 3053;

        break;
        case 'CRNRSTN_EMAIL_USER_SOURCE':

            return (int) 3054;

        break;

        //
        // 4051
        // 'CRNRSTN_ELECTRUM', 'CRNRSTN_ELECTRUM_THREAD', 'CRNRSTN_ELECTRUM_COMM', 'CRNRSTN_ELECTRUM_FTP', 'CRNRSTN_ELECTRUM_LOCALDIR',
        // 'CRNRSTN_FILE_MANAGEMENT'
        case 'CRNRSTN_ELECTRUM':

            return (int) 4051;

        break;
        case 'CRNRSTN_ELECTRUM_THREAD':

            return (int) 4052;

        break;
        case 'CRNRSTN_ELECTRUM_COMM':

            return (int) 4053;

        break;
        case 'CRNRSTN_ELECTRUM_FTP':

            return (int) 4054;

        break;
        case 'CRNRSTN_ELECTRUM_LOCALDIR':

            return (int) 4055;

        break;
        case 'CRNRSTN_FILE_MANAGEMENT':

            return (int) 4056;

        break;

        //
        // 6051
        // 'CRNRSTN_SOAP', 'CRNRSTN_SOAP_SERVER', 'CRNRSTN_SOAP_CLIENT', 'CRNRSTN_PROXY_KINGS_HIGHWAY', 'CRNRSTN_PROXY_EMAIL',
        // 'CRNRSTN_PROXY_ELECTRUM', 'CRNRSTN_PROXY_AUTHENTICATE'
        case 'CRNRSTN_SOAP':

            return (int) 6051;

        break;
        case 'CRNRSTN_SOAP_SERVER':

            return (int) 6052;

        break;
        case 'CRNRSTN_SOAP_CLIENT':

            return (int) 6053;

        break;
        case 'CRNRSTN_PROXY_KINGS_HIGHWAY':

            return (int) 6054;

        break;
        case 'CRNRSTN_PROXY_EMAIL':

            return (int) 6055;

        break;
        case 'CRNRSTN_PROXY_ELECTRUM':

            return (int) 6056;

        break;
        case 'CRNRSTN_PROXY_AUTHENTICATE':

            return (int) 6057;

        break;


        //
        // 6900-6950
        case 'CRNRSTN_CHANNEL_DESKTOP':

            return (int) 6900;

        break;
        case 'CRNRSTN_CHANNEL_TABLET':

            return (int) 6901;

        break;
        case 'CRNRSTN_CHANNEL_MOBILE':

            return (int) 6902;

        break;

        //
        // 7051-7300
        // CRNRSTN_UI_PHPNIGHT, CRNRSTN_UI_DARKNIGHT, CRNRSTN_UI_PHP, CRNRSTN_UI_GREYSKYS,
        // CRNRSTN_UI_HTML, CRNRSTN_UI_DAYLIGHT, CRNRSTN_UI_FEATHER
        case 'CRNRSTN_UI_PHPNIGHT':

            return (int) 7051;

        break;
        case 'CRNRSTN_UI_DARKNIGHT':

            return (int) 7052;

        break;
        case 'CRNRSTN_UI_PHP':

            return (int) 7053;

        break;
        case 'CRNRSTN_UI_GREYSKYS':

            return (int) 7054;

        break;
        case 'CRNRSTN_UI_HTML':

            return (int) 7055;

        break;
        case 'CRNRSTN_UI_DAYLIGHT':

            return (int) 7056;

        break;
        case 'CRNRSTN_UI_FEATHER':

            return (int) 7057;

        break;
        case 'CRNRSTN_UI_GLASS_LIGHT_COPY':

            return (int) 7058;

        break;
        case 'CRNRSTN_UI_GLASS_DARK_COPY':

            return (int) 7059;

        break;
        case 'CRNRSTN_UI_WOOD':

            return (int) 7060;

        break;
        case 'CRNRSTN_UI_TERMINAL':

            return (int) 7061;

        break;
        case 'CRNRSTN_UI_RANDOM':

            return (int) 7062;

        break;

        //
        // 7200-7299
        case 'CRNRSTN_UI_TAG_ANALYTICS':

            return (int) 7200;

        break;
        case 'CRNRSTN_UI_TAG_ENGAGEMENT':

            return (int) 7201;

        break;
        case 'CRNRSTN_UI_FORM_INTEGRATION_PACKET':

            return (int) 7202;

        break;
        case 'CRNRSTN_UI_COOKIE_PREFERENCE':

            return (int) 7203;

        break;
        case 'CRNRSTN_UI_COOKIE_YESNO':

            return (int) 7204;

        break;
        case 'CRNRSTN_UI_COOKIE_NOTICE':

            return (int) 7205;

        break;
        case 'CRNRSTN_UI_INTERACT':

            return (int) 7206;

        break;
        case 'CRNRSTN_UI_CSS':

            return (int) 7207;

        break;
        case 'CRNRSTN_UI_JS':

            return (int) 7208;

        break;
        case 'CRNRSTN_UI_SOAP_DATA_TUNNEL':

            return (int) 7209;

        break;
        case 'CRNRSTN_UI_IMG_SOAP_DATA_TUNNEL':

            return (int) 7210;

        break;
        case 'CRNRSTN_UI_IMG_BASE64':

            return (int) 7211;

        break;
        case 'CRNRSTN_UI_IMG_BASE64_PNG':

            return (int) 7212;

        break;
        case 'CRNRSTN_UI_IMG_HTML_WRAPPED':

            return (int) 7213;

        break;
        case 'CRNRSTN_UI_IMG_BASE64_JPEG':

            return (int) 7214;

        break;
        case 'CRNRSTN_UI_IMG_JPEG':

            return (int) 7215;

        break;
        case 'CRNRSTN_UI_IMG_PNG':

            return (int) 7216;

        break;
        case 'CRNRSTN_UI_IMG':

            return (int) 7217;

        break;

        //
        // 7300-7399
        case 'CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS':

            return (int) 7300;

        break;
        case 'CRNRSTN_JS_FRAMEWORK_JQUERY':

            return (int) 7301;

        break;
        case 'CRNRSTN_JS_FRAMEWORK_JQUERY_2_2_4':

            return (int) 7302;

        break;
        case 'CRNRSTN_JS_FRAMEWORK_JQUERY_1_12_4':

            return (int) 7303;

        break;
        case 'CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1':

            return (int) 7304;

        break;
        case 'CRNRSTN_JS_FRAMEWORK_JQUERY_UI':

            return (int) 7305;

        break;
        case 'CRNRSTN_JS_FRAMEWORK_JQUERY_UI_1_12_1':

            return (int) 7306;

        break;
        case 'CRNRSTN_JS_FRAMEWORK_JQUERY_MOBILE':

            return (int) 7307;

        break;
        case 'CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS':

            return (int) 7308;

        break;
        case 'CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_PLUS_JQUERY':

            return (int) 7309;

        break;
        case 'CRNRSTN_JS_FRAMEWORK_REACT':

            return (int) 7310;

        break;
        case 'CRNRSTN_JS_FRAMEWORK_REACT_DOM':

            return (int) 7311;

        break;
        case 'CRNRSTN_JS_FRAMEWORK_MITHRIL':

            return (int) 7312;

        break;
        case 'CRNRSTN_JS_FRAMEWORK_BACKBONE':

            return (int) 7313;

        break;
        case 'CRNRSTN_JS_FRAMEWORK_PROTOTYPE':

            return (int) 7314;

        break;
        case 'CRNRSTN_JS_FRAMEWORK_SCRIPTACULOUS':

            return (int) 7315;

        break;
        case 'CRNRSTN_JS_FRAMEWORK_PROTOTYPE_MOOFX':

            return (int) 7316;

        break;
        case 'CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_2_03_3':

            return (int) 7317;

        break;
        case 'CRNRSTN_JS_FRAMEWORK_MOOTOOLS_MORE':

            return (int) 7318;

        break;
        case 'CRNRSTN_JS_FRAMEWORK_MOOTOOLS_CORE':

            return (int) 7319;

        break;
        case 'CRNRSTN_UI_JS_MAIN':

            return (int) 7320;

        break;
        case 'CRNRSTN_CSS_FRAMEWORK_SIMPLE_GRID':

            return (int) 7321;

        break;
        case 'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM':

            return (int) 7322;

        break;
        case 'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_24COL':

            return (int) 7323;

        break;
        case 'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_16COL':

            return (int) 7324;

        break;
        case 'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_12COL':

            return (int) 7325;

        break;
        case 'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_24COL_RTL':

            return (int) 7326;

        break;
        case 'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_16COL_RTL':

            return (int) 7327;

        break;
        case 'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_12COL_RTL':

            return (int) 7328;

        break;
        case 'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_RTL':

            return (int) 7329;

        break;
        case 'CRNRSTN_CSS_FRAMEWORK_FOUNDATION':

            return (int) 7330;

        break;
        case 'CRNRSTN_CSS_FRAMEWORK_HTML5_BOILERPLATE':

            return (int) 7331;

        break;
        case 'CRNRSTN_CSS_FRAMEWORK_RESPONSIVE_GRID_SYSTEM':

            return (int) 7332;

        break;
        case 'CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC':

            return (int) 7333;

        break;
        case 'CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_RESET':

            return (int) 7334;

        break;
        case 'CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_RESET_RTL':

            return (int) 7335;

        break;
        case 'CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_RTL':

            return (int) 7336;

        break;
        case 'CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_ADAPT':

            return (int) 7337;

        break;
        case 'CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_ADAPT_RTL':

            return (int) 7338;

        break;

        case 'CRNRSTN_CSS_FRAMEWORK_DEAD_SIMPLE_GRID':

            return (int) 7339;

        break;
        case 'CRNRSTN_CSS_FRAMEWORK_SKELETON':

            return (int) 7340;

        break;
        case 'CRNRSTN_CSS_FRAMEWORK_RWDGRID':

            return (int) 7341;

        break;
        case 'CRNRSTN_CSS_FRAMEWORK_THISISDALLAS_SIMPLEGRID':

            return (int) 7342;

        break;
        case 'CRNRSTN_UI_CSS_MAIN_DESKTOP':

            return (int) 7343;

        break;
        case 'CRNRSTN_UI_CSS_MAIN_TABLET':

            return (int) 7344;

        break;
        case 'CRNRSTN_UI_CSS_MAIN_MOBILE':

            return (int) 7345;

        break;

        //
        // 7510-7699
        case 'CRNRSTN_ASSET_MODE_BASE64':

            return (int) 7510;

        break;
        case 'CRNRSTN_ASSET_MODE_PNG':

            return (int) 7511;

        break;
        case 'CRNRSTN_ASSET_MODE_JPEG':

            return (int) 7512;

        break;
        case 'CRNRSTN_ASSET_MODE_ICO':

            return (int) 7513;

        break;

        //
        // 7700-7999
        case 'CRNRSTN_FAVICON_ASSET_MAPPING':

            return (int) 7700;

        break;
        case 'CRNRSTN_SYSTEM_IMG_ASSET_MAPPING':

            return (int) 7701;

        break;
        case 'CRNRSTN_SOCIAL_IMG_ASSET_MAPPING':

            return (int) 7702;

        break;
        case 'CRNRSTN_JS_ASSET_MAPPING':

            return (int) 7703;

        break;
        case 'CRNRSTN_CSS_ASSET_MAPPING':

            return (int) 7704;

        break;
        case 'CRNRSTN_SYSTEM_EMAIL_IS_HTML':

            return (int) 7705;

        break;
        case 'CRNRSTN_ASSET_MAPPING':

            return (int) 7706;

        break;
        case 'CRNRSTN_ASSET_MAPPING_PROXY':

            return (int) 7707;

        break;

        //
        // 8051
        // 'CRNRSTN_LOG_ALL', 'CRNRSTN_LOG_NONE', 'CRNRSTN_LOG_EMAIL', 'CRNRSTN_LOG_EMAIL_PROXY', 'CRNRSTN_LOG_FILE',
        // 'CRNRSTN_LOG_FILE_PROXY', 'CRNRSTN_LOG_FILE_FTP', 'CRNRSTN_LOG_SCREEN_TEXT', 'CRNRSTN_LOG_SCREEN', 'CRNRSTN_LOG_SCREEN_HTML',
        // 'CRNRSTN_LOG_SCREEN_HTML_HIDDEN', 'CRNRSTN_LOG_DEFAULT', 'CRNRSTN_LOG_DEFAULT_PROXY', 'CRNRSTN_LOG_ELECTRUM'
        case 'CRNRSTN_LOG_EMAIL':

            return (int) 8051;

        break;
        case 'CRNRSTN_LOG_EMAIL_PROXY':

            return (int) 8052;

        break;
        case 'CRNRSTN_LOG_FILE':

            return (int) 8053;

        break;
        case 'CRNRSTN_LOG_FILE_PROXY':

            return (int) 8054;

        break;
        case 'CRNRSTN_LOG_FILE_FTP':

            return (int) 8055;

        break;
        case 'CRNRSTN_LOG_SCREEN_TEXT':

            return (int) 8056;

        break;
        case 'CRNRSTN_LOG_SCREEN':

            return (int) 8057;

        break;
        case 'CRNRSTN_LOG_SCREEN_HTML':

            return (int) 8058;

        break;
        case 'CRNRSTN_LOG_SCREEN_HTML_HIDDEN':

            return (int) 8059;

        break;
        case 'CRNRSTN_LOG_DEFAULT':

            return (int) 8060;

        break;
        case 'CRNRSTN_LOG_DEFAULT_PROXY':

            return (int) 8061;

        break;
        case 'CRNRSTN_LOG_ELECTRUM':

            return (int) 8062;

        break;

        //
        // ARCHITCTURE PERMISSIONS FLAGS FOR CRNRSTN :: STORED DATA

        /*
        'CRNRSTN_OUTPUT_RUNTIME', 'CRNRSTN_OUTPUT_ALL', 'CRNRSTN_OUTPUT_DATABASE', 'CRNRSTN_OUTPUT_SSDTLA',
        'CRNRSTN_OUTPUT_PSSDTLA', 'CRNRSTN_OUTPUT_SESSION', 'CRNRSTN_OUTPUT_COOKIE', 'CRNRSTN_OUTPUT_SOAP',
        'CRNRSTN_OUTPUT_GET', 'CRNRSTN_OUTPUT_ISEMAIL', 'CRNRSTN_OUTPUT_ISPASSWORD', 'CRNRSTN_AUTHORIZE_RUNTIME_ONLY',
        'CRNRSTN_AUTHORIZE_ALL', 'CRNRSTN_AUTHORIZE_DATABASE', 'CRNRSTN_AUTHORIZE_SSDTLA', 'CRNRSTN_AUTHORIZE_PSSDTLA',
        'CRNRSTN_AUTHORIZE_SESSION', 'CRNRSTN_AUTHORIZE_COOKIE','CRNRSTN_AUTHORIZE_SOAP', 'CRNRSTN_AUTHORIZE_GET',
        'CRNRSTN_AUTHORIZE_ISEMAIL','CRNRSTN_AUTHORIZE_ISPASSWORD'
        */
        case 'CRNRSTN_OUTPUT_RUNTIME':

            return (int) 8063;

        break;
        case 'CRNRSTN_OUTPUT_ALL':

            return (int) 8064;

        break;
        case 'CRNRSTN_OUTPUT_DATABASE':

            return (int) 8065;

        break;
        case 'CRNRSTN_OUTPUT_SSDTLA':

            return (int) 8066;

        break;
        case 'CRNRSTN_OUTPUT_PSSDTLA':

            return (int) 8067;

        break;
        case 'CRNRSTN_OUTPUT_SESSION':

            return (int) 8068;

        break;
        case 'CRNRSTN_OUTPUT_COOKIE':

            return (int) 8069;

        break;
        case 'CRNRSTN_OUTPUT_SOAP':

            return (int) 8070;

        break;
        case 'CRNRSTN_OUTPUT_GET':

            return (int) 8071;

        break;
        case 'CRNRSTN_OUTPUT_ISEMAIL':

            return (int) 8072;

        break;
        case 'CRNRSTN_OUTPUT_ISPASSWORD':

            return (int) 8073;

        break;
        case 'CRNRSTN_OUTPUT_FORM_INTEGRATIONS':

            return (int) 8067;

        break;
        case 'CRNRSTN_AUTHORIZE_ALL':

            return (int) 8075;

        break;
        case 'CRNRSTN_AUTHORIZE_DATABASE':

            return (int) 8076;

        break;
        case 'CRNRSTN_AUTHORIZE_SSDTLA':

            return (int) 8077;

        break;
        case 'CRNRSTN_AUTHORIZE_PSSDTLA':

            return (int) 8078;

        break;
        case 'CRNRSTN_AUTHORIZE_SESSION':

            return (int) 8079;

        break;
        case 'CRNRSTN_AUTHORIZE_COOKIE':

            return (int) 8080;

        break;
        case 'CRNRSTN_AUTHORIZE_SOAP':

            return (int) 8081;

        break;
        case 'CRNRSTN_AUTHORIZE_GET':

            return (int) 8082;

        break;
        case 'CRNRSTN_AUTHORIZE_RUNTIME_ONLY':

            return (int) 8083;

        break;
        case 'CRNRSTN_AUTHORIZE_ISEMAIL':

            return (int) 8084;

        break;
        case 'CRNRSTN_AUTHORIZE_ISPASSWORD':

            return (int) 8085;

        break;

        //
        // CRNRSTN :: ENCRYPTION PROFILES
        case 'CRNRSTN_ENCRYPT_TUNNEL':

            return (int) 8185;

        break;
        case 'CRNRSTN_ENCRYPT_DATABASE':

            return (int) 8186;

        break;
        case 'CRNRSTN_ENCRYPT_SESSION':

            return (int) 8187;

        break;
        case 'CRNRSTN_ENCRYPT_COOKIE':

            return (int) 8188;

        break;
        case 'CRNRSTN_ENCRYPT_SOAP':

            return (int) 8189;

        break;
        case 'CRNRSTN_ENCRYPT_OERSL':

            return (int) 8190;

        break;

        //
        // RESOURCE PERMISSIONS FLAGS FOR CRNRSTN :: RESOURCES
        case 'CRNRSTN_RESOURCE_ALL':

            return (int) 8590;

        break;
        case 'CRNRSTN_RESOURCE_BASSDRIVE':

            return (int) 8591;

        break;
        case 'CRNRSTN_RESOURCE_NATIONAL_WEATHER_SERVICE':

            return (int) 8592;

        break;
        case 'CRNRSTN_RESOURCE_CSS_VALIDATOR':

            return (int) 8593;

        break;
        case 'CRNRSTN_RESOURCE_DOCUMENTATION':

            return (int) 8594;

        break;
        case 'CRNRSTN_RESOURCE_FOOTER':

            return (int) 8595;

        break;
        case 'CRNRSTN_RESOURCE_IMAGE':

            return (int) 8596;

        break;
        case 'CRNRSTN_RESOURCE_DOCUMENT':

            return (int) 8597;

        break;
        case 'CRNRSTN_RESOURCE_OPENSOURCE':

            return (int) 8598;

        break;
        case 'CRNRSTN_RESOURCE_NEWS_SYNDICATION':

            return (int) 8599;

        break;
        case 'CRNRSTN_RESOURCE_ELECTRUM':

            return (int) 8600;

        break;
        case 'CRNRSTN_RESOURCE_THIRDPARTY':

            return (int) 8601;

        break;
        case 'CRNRSTN_HTTP_REDIRECT':

            return (int) 8602;

        break;
        case 'CRNRSTN_HTTPS_REDIRECT':

            return (int) 8603;

        break;
        case 'CRNRSTN_HTTP_DATA_RETURN':

            return (int) 8604;

        break;
        case 'CRNRSTN_HTTPS_DATA_RETURN':

            return (int) 8605;

        break;
        case 'CRNRSTN_JSON_RETURN':

            return (int) 8606;

        break;
        case 'CRNRSTN_XML_RETURN':

            return (int) 8607;

        break;
        case 'CRNRSTN_SOAP_RETURN':

            return (int) 8608;

        break;
        case 'CRNRSTN_HTML_TEXT_RETURN':

            return (int) 8609;

        break;
        case 'CRNRSTN_DOCUMENT_FILE_RETURN':

            return (int) 8610;

        break;
        case 'CRNRSTN_SERVER_RESPONSE_CODE':

            return (int) 8611;

        break;
        case 'CRNRSTN_RESPONSE_REPORT':

            return (int) 8612;

        break;


        //
        // 9051
        // 'CRNRSTN_BARNEY', 'CRNRSTN_BARNEY_DATABASE', 'CRNRSTN_BARNEY_FILE', 'CRNRSTN_BARNEY_FTP', 'CRNRSTN_BARNEY_ELECTRUM',
        // 'CRNRSTN_BARNEY_GABRIEL', 'CRNRSTN_BARNEY_DISK'
        case 'CRNRSTN_BARNEY':

            return (int) 9051;

        break;
        case 'CRNRSTN_BARNEY_DATABASE':

            return (int) 9052;

        break;
        case 'CRNRSTN_BARNEY_FILE':

            return (int) 9053;

        break;
        case 'CRNRSTN_BARNEY_FTP':

            return (int) 9054;

        break;
        case 'CRNRSTN_BARNEY_ELECTRUM':

            return (int) 9055;

        break;
        case 'CRNRSTN_BARNEY_GABRIEL':

            return (int) 9056;

        break;
        case 'CRNRSTN_BARNEY_DISK':

            return (int) 9057;

        break;

        // 10051
        // 'CRNRSTN_PERFORMANCE_MONITOR', 'CRNRSTN_IP_SECURITY', 'CRNRSTN_CSS_EMAIL_CLIENT_VALIDATE'
        case 'CRNRSTN_PERFORMANCE_MONITOR':

            return (int) 10051;

        break;
        case 'CRNRSTN_WORDPRESS_DEBUG':

            return (int) 10052;

        break;
        case 'CRNRSTN_IP_SECURITY':

            return (int) 10053;

        break;
        case 'CRNRSTN_CSS_EMAIL_CLIENT_VALIDATE':

            return (int) 10054;

        break;
        default:

             return false;

        break;

    }

}