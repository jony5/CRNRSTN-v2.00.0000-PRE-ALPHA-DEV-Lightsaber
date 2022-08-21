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
# # C # R # N # R # S # T # N # : : # # ##
#
if(isset($crnrstn_initialize_bits)){

    $CRNRSTN_CONSTANTS_ARRAY = array('CRNRSTN_DEBUG_OFF', 'CRNRSTN_DEBUG_NATIVE_ERR_LOG', 'CRNRSTN_DEBUG_AGGREGATION_ON',
        'CRNRSTN_LOG_ALL', 'CRNRSTN_AUTHORIZED_ACCOUNT', 'CRNRSTN_LOG_NONE', 'CRNRSTN_INTEGER_LENGTH',
        'CRNRSTN_SETTINGS_APACHE', 'CRNRSTN_SETTINGS_MYSQLI', 'CRNRSTN_SETTINGS_PHP', 'CRNRSTN_SETTINGS_CRNRSTN',
        'CRNRSTN_SETTINGS_CLIENT', 'CRNRSTN_SETTINGS_WORDPRESS', 'CRNRSTN_DATABASE', 'CRNRSTN_DATABASE_CONNECTION',
        'CRNRSTN_DATABASE_QUERY', 'CRNRSTN_DATABASE_QUERY_SILO', 'CRNRSTN_DATABASE_QUERY_DYNAMIC',
        'CRNRSTN_DATABASE_RESULT', 'CRNRSTN_PERFORMANCE_MONITOR', 'CRNRSTN_IP_SECURITY', 'CRNRSTN_GABRIEL',
        'CRNRSTN_SMTP_AUTHENTICATION', 'CRNRSTN_EMAIL_CRNRSTN_SOURCE', 'CRNRSTN_EMAIL_USER_SOURCE', 'CRNRSTN_ELECTRUM',
        'CRNRSTN_ELECTRUM_THREAD', 'CRNRSTN_ELECTRUM_COMM', 'CRNRSTN_ELECTRUM_FTP', 'CRNRSTN_ELECTRUM_LOCALDIR',
        'CRNRSTN_FILE_MANAGEMENT', 'CRNRSTN_CREATIVE_EMBED', 'CRNRSTN_FILE_RECEIVE', 'CRNRSTN_FILE_LOCALDIR_MOVE',
        'CRNRSTN_FILE_FTP_SEND', 'CRNRSTN_FILE_FTP_RECEIVE', 'CRNRSTN_FILE_SOAP_SEND', 'CRNRSTN_FILE_SOAP_RECEIVE',
        'CRNRSTN_FILE_CURL_SEND', 'CRNRSTN_FILE_CURL_RECEIVE', 'CRNRSTN_CSS_EMAIL_CLIENT_VALIDATE', 'CRNRSTN_BARNEY',
        'CRNRSTN_BARNEY_DATABASE', 'CRNRSTN_BARNEY_FILE', 'CRNRSTN_BARNEY_FTP', 'CRNRSTN_BARNEY_ELECTRUM',
        'CRNRSTN_BARNEY_GABRIEL', 'CRNRSTN_BARNEY_DISK', 'CRNRSTN_SOAP', 'CRNRSTN_SOAP_SERVER', 'CRNRSTN_SOAP_CLIENT',
        'CRNRSTN_PROXY_KINGS_HIGHWAY', 'CRNRSTN_PROXY_EMAIL', 'CRNRSTN_PROXY_ELECTRUM', 'CRNRSTN_PROXY_AUTHENTICATE',
        'CRNRSTN_LOG_EMAIL', 'CRNRSTN_LOG_EMAIL_PROXY', 'CRNRSTN_LOG_FILE', 'CRNRSTN_LOG_FILE_PROXY', 'CRNRSTN_LOG_FILE_FTP',
        'CRNRSTN_LOG_SCREEN_TEXT', 'CRNRSTN_LOG_SCREEN', 'CRNRSTN_LOG_SCREEN_HTML', 'CRNRSTN_LOG_SCREEN_HTML_HIDDEN',
        'CRNRSTN_LOG_DEFAULT', 'CRNRSTN_LOG_ELECTRUM', 'CRNRSTN_UI_PHPNIGHT', 'CRNRSTN_UI_DARKNIGHT', 'CRNRSTN_UI_PHP',
        'CRNRSTN_UI_GREYSKYS', 'CRNRSTN_UI_HTML', 'CRNRSTN_UI_DAYLIGHT', 'CRNRSTN_UI_FEATHER', 'CRNRSTN_UI_DESKTOP',
        'CRNRSTN_UI_TABLET', 'CRNRSTN_UI_MOBILE', 'CRNRSTN_UI_SOAP_DATA_TUNNEL', 'CRNRSTN_UI_IMG_SOAP_DATA_TUNNEL',
        'CRNRSTN_UI_IMG_BASE64', 'CRNRSTN_UI_IMG_BASE64_PNG', 'CRNRSTN_UI_IMG_BASE64_JPEG',
        'CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED', 'CRNRSTN_UI_IMG_JPEG', 'CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED',
        'CRNRSTN_UI_INTERACT', 'CRNRSTN_UI_IMG_PNG', 'CRNRSTN_UI_IMG_PNG_HTML_WRAPPED', 'CRNRSTN_UI_CSS_MAIN_MOBILE',
        'CRNRSTN_UI_CSS_MAIN_TABLET', 'CRNRSTN_UI_CSS_MAIN_DESKTOP', 'CRNRSTN_UI_JS_MAIN', 'CRNRSTN_UI_JS_JQUERY_1_11_1',
        'CRNRSTN_UI_JS_JQUERY', 'CRNRSTN_UI_JS_JQUERY_UI', 'CRNRSTN_UI_JS_JQUERY_MOBILE',
        'CRNRSTN_UI_JS_LIGHTBOX_DOT_JS_PLUS_JQUERY', 'CRNRSTN_UI_JS_LIGHTBOX_DOT_JS', 'CRNRSTN_UI_TAG_ANALYTICS',
        'CRNRSTN_UI_TAG_ENGAGEMENT', 'CRNRSTN_UI_FORM_INTEGRATION_PACKET', 'CRNRSTN_UI_COOKIE_PREFERENCE',
        'CRNRSTN_UI_COOKIE_YESNO', 'CRNRSTN_UI_COOKIE_NOTICE', 'CRNRSTN_ASSET_MODE_BASE64', 'CRNRSTN_ASSET_MODE_PNG',
        'CRNRSTN_ASSET_MODE_JPEG', 'CRNRSTN_AUTHORIZE_ALL', 'CRNRSTN_AUTHORIZE_DATABASE', 'CRNRSTN_AUTHORIZE_SSDTLA',
        'CRNRSTN_AUTHORIZE_PSSDTLA', 'CRNRSTN_AUTHORIZE_SESSION', 'CRNRSTN_AUTHORIZE_COOKIE','CRNRSTN_AUTHORIZE_SOAP',
        'CRNRSTN_AUTHORIZE_GET', 'CRNRSTN_AUTHORIZE_ISEMAIL','CRNRSTN_AUTHORIZE_ISPASSWORD', 'CRNRSTN_ENCRYPT_TUNNEL',
        'CRNRSTN_ENCRYPT_DATABASE', 'CRNRSTN_ENCRYPT_SESSION', 'CRNRSTN_ENCRYPT_COOKIE', 'CRNRSTN_ENCRYPT_SOAP',
        'CRNRSTN_ENCRYPT_OERSL', 'CRNRSTN_RESOURCE_ALL', 'CRNRSTN_RESOURCE_OPENSOURCE', 'CRNRSTN_RESOURCE_NEWS_SYNDICATION',
        'CRNRSTN_WORDPRESS_DEBUG');

    //
    // DEFINE INTEGER LENGTH FOR CONSTANT STORAGE...IN BITWISE FASHION...HIGH FALUTIN FASHION.
    @define('CRNRSTN_INTEGER_LENGTH', (int) ($this->os_bit_size - 1));

    foreach($CRNRSTN_CONSTANTS_ARRAY as $crnrstn_const_key => $crnrstn_constant_nom){

        $this->initialize_bit($crnrstn_constant_nom, false, crnrstn_constants_init($crnrstn_constant_nom));

    }

}else{

    //
    // DEFINE INTEGER CONSTANTS
    @define('CRNRSTN_DEBUG_OFF', (int) crnrstn_constants_init('CRNRSTN_DEBUG_OFF'));
    @define('CRNRSTN_DEBUG_NATIVE_ERR_LOG', (int) crnrstn_constants_init('CRNRSTN_DEBUG_NATIVE_ERR_LOG'));
    @define('CRNRSTN_DEBUG_AGGREGATION_ON', (int) crnrstn_constants_init('CRNRSTN_DEBUG_AGGREGATION_ON'));

    @define('CRNRSTN_LOG_ALL', (int) crnrstn_constants_init('CRNRSTN_LOG_ALL'));
    @define('CRNRSTN_LOG_NONE', (int) crnrstn_constants_init('CRNRSTN_LOG_NONE'));

    @define('CRNRSTN_AUTHORIZED_ACCOUNT', (int) crnrstn_constants_init('CRNRSTN_AUTHORIZED_ACCOUNT'));

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
    @define('CRNRSTN_LOG_ELECTRUM', (int) crnrstn_constants_init('CRNRSTN_LOG_ELECTRUM'));

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
    @define('CRNRSTN_UI_GREYSKYS', (int) crnrstn_constants_init('CRNRSTN_UI_GREYSKYS'));
    @define('CRNRSTN_UI_HTML', (int) crnrstn_constants_init('CRNRSTN_UI_HTML'));
    @define('CRNRSTN_UI_DAYLIGHT', (int) crnrstn_constants_init('CRNRSTN_UI_DAYLIGHT'));
    @define('CRNRSTN_UI_FEATHER', (int) crnrstn_constants_init('CRNRSTN_UI_FEATHER'));

    @define('CRNRSTN_UI_DESKTOP', (int) crnrstn_constants_init('CRNRSTN_UI_DESKTOP'));
    @define('CRNRSTN_UI_TABLET', (int) crnrstn_constants_init('CRNRSTN_UI_TABLET'));
    @define('CRNRSTN_UI_MOBILE', (int) crnrstn_constants_init('CRNRSTN_UI_MOBILE'));

    @define('CRNRSTN_UI_INTERACT', (int) crnrstn_constants_init('CRNRSTN_UI_INTERACT'));
    @define('CRNRSTN_UI_SOAP_DATA_TUNNEL', (int) crnrstn_constants_init('CRNRSTN_UI_SOAP_DATA_TUNNEL'));
    @define('CRNRSTN_UI_IMG_SOAP_DATA_TUNNEL', (int) crnrstn_constants_init('CRNRSTN_UI_IMG_SOAP_DATA_TUNNEL'));
    @define('CRNRSTN_UI_IMG_BASE64', (int) crnrstn_constants_init('CRNRSTN_UI_IMG_BASE64'));
    @define('CRNRSTN_UI_IMG_BASE64_PNG', (int) crnrstn_constants_init('CRNRSTN_UI_IMG_BASE64_PNG'));
    @define('CRNRSTN_UI_IMG_BASE64_JPEG', (int) crnrstn_constants_init('CRNRSTN_UI_IMG_BASE64_JPEG'));
    @define('CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED', (int) crnrstn_constants_init('CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED'));
    @define('CRNRSTN_UI_IMG_JPEG', (int) crnrstn_constants_init('CRNRSTN_UI_IMG_JPEG'));
    @define('CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED', (int) crnrstn_constants_init('CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED'));
    @define('CRNRSTN_UI_IMG_PNG', (int) crnrstn_constants_init('CRNRSTN_UI_IMG_PNG'));
    @define('CRNRSTN_UI_IMG_PNG_HTML_WRAPPED', (int) crnrstn_constants_init('CRNRSTN_UI_IMG_PNG_HTML_WRAPPED'));

    @define('CRNRSTN_UI_CSS_MAIN_DESKTOP', (int) crnrstn_constants_init('CRNRSTN_UI_CSS_MAIN_DESKTOP'));
    @define('CRNRSTN_UI_CSS_MAIN_TABLET', (int) crnrstn_constants_init('CRNRSTN_UI_CSS_MAIN_TABLET'));
    @define('CRNRSTN_UI_CSS_MAIN_MOBILE', (int) crnrstn_constants_init('CRNRSTN_UI_CSS_MAIN_MOBILE'));
    @define('CRNRSTN_UI_JS_MAIN_DESKTOP', (int) crnrstn_constants_init('CRNRSTN_UI_JS_MAIN_DESKTOP'));
    @define('CRNRSTN_UI_JS_MAIN_TABLET', (int) crnrstn_constants_init('CRNRSTN_UI_JS_MAIN_TABLET'));
    @define('CRNRSTN_UI_JS_MAIN_MOBILE', (int) crnrstn_constants_init('CRNRSTN_UI_JS_MAIN_MOBILE'));

    @define('CRNRSTN_UI_JS_JQUERY_1_11_1', (int) crnrstn_constants_init('CRNRSTN_UI_JS_JQUERY_1_11_1'));
    @define('CRNRSTN_UI_JS_JQUERY', (int) crnrstn_constants_init('CRNRSTN_UI_JS_JQUERY'));
    @define('CRNRSTN_UI_JS_JQUERY_UI', (int) crnrstn_constants_init('CRNRSTN_UI_JS_JQUERY_UI'));
    @define('CRNRSTN_UI_JS_JQUERY_MOBILE', (int) crnrstn_constants_init('CRNRSTN_UI_JS_JQUERY_MOBILE'));
    @define('CRNRSTN_UI_JS_LIGHTBOX_DOT_JS', (int) crnrstn_constants_init('CRNRSTN_UI_JS_LIGHTBOX_DOT_JS'));
    @define('CRNRSTN_UI_JS_LIGHTBOX_DOT_JS_PLUS_JQUERY', (int) crnrstn_constants_init('CRNRSTN_UI_JS_LIGHTBOX_DOT_JS_PLUS_JQUERY'));
    @define('CRNRSTN_UI_TAG_ANALYTICS', (int) crnrstn_constants_init('CRNRSTN_UI_TAG_ANALYTICS'));
    @define('CRNRSTN_UI_TAG_ENGAGEMENT', (int) crnrstn_constants_init('CRNRSTN_UI_TAG_ENGAGEMENT'));
    @define('CRNRSTN_UI_FORM_INTEGRATION_PACKET', (int) crnrstn_constants_init('CRNRSTN_UI_FORM_INTEGRATION_PACKET'));
    @define('CRNRSTN_UI_COOKIE_PREFERENCE', (int) crnrstn_constants_init('CRNRSTN_UI_COOKIE_PREFERENCE'));
    @define('CRNRSTN_UI_COOKIE_YESNO', (int) crnrstn_constants_init('CRNRSTN_UI_COOKIE_YESNO'));
    @define('CRNRSTN_UI_COOKIE_NOTICE', (int) crnrstn_constants_init('CRNRSTN_UI_COOKIE_NOTICE'));

    @define('CRNRSTN_ASSET_MODE_BASE64', (int) crnrstn_constants_init('CRNRSTN_ASSET_MODE_BASE64'));
    @define('CRNRSTN_ASSET_MODE_PNG', (int) crnrstn_constants_init('CRNRSTN_ASSET_MODE_PNG'));
    @define('CRNRSTN_ASSET_MODE_JPEG', (int) crnrstn_constants_init('CRNRSTN_ASSET_MODE_JPEG'));

    @define('CRNRSTN_AUTHORIZE_RUNTIME_ONLY', (int) crnrstn_constants_init('CRNRSTN_AUTHORIZE_ALL'));
    @define('CRNRSTN_AUTHORIZE_ALL', (int) crnrstn_constants_init('CRNRSTN_AUTHORIZE_ALL'));
    @define('CRNRSTN_AUTHORIZE_DATABASE', (int) crnrstn_constants_init('CRNRSTN_AUTHORIZE_DATABASE'));
    @define('CRNRSTN_AUTHORIZE_SSDTLA', (int) crnrstn_constants_init('CRNRSTN_AUTHORIZE_SSDTLA'));
    @define('CRNRSTN_AUTHORIZE_PSSDTLA', (int) crnrstn_constants_init('CRNRSTN_AUTHORIZE_PSSDTLA'));
    @define('CRNRSTN_AUTHORIZE_SESSION', (int) crnrstn_constants_init('CRNRSTN_AUTHORIZE_SESSION'));
    @define('CRNRSTN_AUTHORIZE_COOKIE', (int) crnrstn_constants_init('CRNRSTN_AUTHORIZE_COOKIE'));
    @define('CRNRSTN_AUTHORIZE_SOAP', (int) crnrstn_constants_init('CRNRSTN_AUTHORIZE_SOAP'));
    @define('CRNRSTN_AUTHORIZE_GET', (int) crnrstn_constants_init('CRNRSTN_AUTHORIZE_GET'));
    // Tuesday, August 16, 2022 @ 0131 hrs :: oCRNRSTN TAKES THE PLACE OF (AND INTERNALIZES) oCRNRSTN_USR AS "THE HANDLE"
    // Tuesday, August 16, 2022 @ 2333 hrs [CRNRSTN_AUTHORIZE_ISEMAIL, CRNRSTN_AUTHORIZE_ISPASSWORD]
    @define('CRNRSTN_AUTHORIZE_ISEMAIL', (int) crnrstn_constants_init('CRNRSTN_AUTHORIZE_ISEMAIL'));
    @define('CRNRSTN_AUTHORIZE_ISPASSWORD', (int) crnrstn_constants_init('CRNRSTN_AUTHORIZE_ISPASSWORD'));

    @define('CRNRSTN_ENCRYPT_TUNNEL', (int) crnrstn_constants_init('CRNRSTN_ENCRYPT_TUNNEL'));
    @define('CRNRSTN_ENCRYPT_DATABASE', (int) crnrstn_constants_init('CRNRSTN_ENCRYPT_DATABASE'));
    @define('CRNRSTN_ENCRYPT_SESSION', (int) crnrstn_constants_init('CRNRSTN_ENCRYPT_SESSION'));
    @define('CRNRSTN_ENCRYPT_COOKIE', (int) crnrstn_constants_init('CRNRSTN_ENCRYPT_COOKIE'));
    @define('CRNRSTN_ENCRYPT_SOAP', (int) crnrstn_constants_init('CRNRSTN_ENCRYPT_SOAP'));
    @define('CRNRSTN_ENCRYPT_OERSL', (int) crnrstn_constants_init('CRNRSTN_ENCRYPT_OERSL'));

    @define('CRNRSTN_RESOURCE_ALL', (int) crnrstn_constants_init('CRNRSTN_RESOURCE_ALL'));
    @define('CRNRSTN_RESOURCE_OPENSOURCE', (int) crnrstn_constants_init('CRNRSTN_RESOURCE_OPENSOURCE'));
    @define('CRNRSTN_RESOURCE_NEWS_SYNDICATION', (int) crnrstn_constants_init('CRNRSTN_RESOURCE_NEWS_SYNDICATION'));
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


 * */


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
die_CSS
CRNRSTN_oELECTRUM_COMM
CRNRSTN_DATABASE
CRNRSTN_INTEGRATION_ACTIVITY
CRNRSTN_IMAGE_HTML

 */