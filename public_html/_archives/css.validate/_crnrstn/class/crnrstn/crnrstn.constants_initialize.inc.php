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
// FIRST GLOBAL SCOPE FUNCTION IN CRNRSTN ::
// Wednesday April 7, 2021 @ 1424hrs
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
        // 51-62, 64-1051
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
        // 7051-7300
        // 'CRNRSTN_UI_DARKNIGHT', 'CRNRSTN_UI_GREYSKYS', 'CRNRSTN_UI_DAYLIGHT', 'CRNRSTN_UI_FEATHER'
        case 'CRNRSTN_UI_PHPNIGHT':
        case 'CRNRSTN_UI_DARKNIGHT':

            return (int) 7051;

        break;
        case 'CRNRSTN_UI_PHP':
        case 'CRNRSTN_UI_GREYSKYS':

            return (int) 7052;

        break;
        case 'CRNRSTN_UI_HTML':
        case 'CRNRSTN_UI_DAYLIGHT':

            return (int) 7053;

        break;
        case 'CRNRSTN_UI_FEATHER':

            return (int) 7054;

        break;
        case 'CRNRSTN_UI_DESKTOP':

            return (int) 7055;

        break;
        case 'CRNRSTN_UI_TABLET':

            return (int) 7056;

        break;
        case 'CRNRSTN_UI_MOBILE':

            return (int) 7057;

        break;




            //
        // 7301-7509
        // 'CRNRSTN_UI_IMG_BASE64', 'CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED', 'CRNRSTN_UI_IMG_PNG', 'CRNRSTN_UI_IMG_PNG_HTML_WRAPPED'
        case 'CRNRSTN_UI_IMG_SOAP_TRANSPORT':

            return (int) 7301;

        break;
        case 'CRNRSTN_UI_IMG_BASE64':

            return (int) 7302;

        break;
        case 'CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED':

            return (int) 7303;

        break;
        case 'CRNRSTN_UI_IMG_JPEG':

            return (int) 7304;

        break;
        case 'CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED':

            return (int) 7305;

        break;
        case 'CRNRSTN_UI_IMG_PNG':

            return (int) 7306;

        break;
        case 'CRNRSTN_UI_IMG_PNG_HTML_WRAPPED':

            return (int) 7307;

        break;
        case 'CRNRSTN_UI_CSS_MAIN_DESKTOP':

            return (int) 7308;

        break;
        case 'CRNRSTN_UI_CSS_MAIN_TABLET':

            return (int) 7309;

        break;
        case 'CRNRSTN_UI_CSS_MAIN_MOBILE':

            return (int) 7310;

        break;
        case 'CRNRSTN_UI_JS_MAIN_DESKTOP':

            return (int) 7311;

        break;
        case 'CRNRSTN_UI_JS_MAIN_TABLET':

            return (int) 7312;

        break;
        case 'CRNRSTN_UI_JS_MAIN_MOBILE':

            return (int) 7313;

        break;
        case 'CRNRSTN_UI_JS_JQUERY_1_11_1':

            return (int) 7314;

        break;
        case 'CRNRSTN_UI_JS_JQUERY':

            return (int) 7315;

        break;
        case 'CRNRSTN_UI_JS_JQUERY_UI':

            return (int) 7316;

        break;
        case 'CRNRSTN_UI_JS_JQUERY_MOBILE':

            return (int) 7317;

        break;
        case 'CRNRSTN_UI_JS_LIGHTBOX_DOT_JS':

            return (int) 7318;

        break;
        case 'CRNRSTN_UI_JS_LIGHTBOX_DOT_JS_PLUS_JQUERY':

            return (int) 7319;

        break;
        case 'CRNRSTN_UI_TAG_ANALYTICS':

            return (int) 7320;

        break;
        case 'CRNRSTN_UI_TAG_ENGAGEMENT':

            return (int) 7321;

        break;
        case 'CRNRSTN_UI_FORM_INTEGRATION_PACKET':

            return (int) 7322;

        break;
        case 'CRNRSTN_UI_COOKIE_PREFERENCE':

            return (int) 7323;

        break;
        case 'CRNRSTN_UI_COOKIE_YESNO':

            return (int) 7324;

        break;
        case 'CRNRSTN_UI_COOKIE_NOTICE':

            return (int) 7325;

        break;
        case 'CRNRSTN_UI_CONSOLE_DASHBOARD':

            return (int) 7326;

        break;


        /*
        'CRNRSTN_UI_CSS_MAIN_MOBILE',
        'CRNRSTN_UI_CSS_MAIN_TABLET',
        'CRNRSTN_UI_CSS_MAIN_DESKTOP',
        'CRNRSTN_UI_JS_JQUERY',
        'CRNRSTN_UI_JS_JQUERY_UI',
        'CRNRSTN_UI_JS_JQUERY_MOBILE',
        'CRNRSTN_UI_JS_LIGHTBOX_DOT_JS',
        'CRNRSTN_UI_TAG_ANALYTICS',
        'CRNRSTN_UI_TAG_ENGAGEMENT',
        'CRNRSTN_UI_FORM_INTEGRATION_PACKET',
        'CRNRSTN_UI_COOKIE_PREFERENCE',
        'CRNRSTN_UI_COOKIE_YESNO',
        'CRNRSTN_UI_COOKIE_NOTICE',
        'CRNRSTN_UI_COOKIE_THEME_DARKNIGHT',
        'CRNRSTN_UI_COOKIE_THEME_FEATHER',
        'CRNRSTN_UI_COOKIE_THEME_DAYLIGHT',
        'CRNRSTN_UI_COOKIE_THEME_GREYSKYS'





        CRNRSTN_UI_JS_JQUERY
        CRNRSTN_UI_JS_JQUERY_UI
        CRNRSTN_UI_JS_JQUERY_MOBILE
        CRNRSTN_UI_JS_LIGHTBOX_DOT_JS

        CRNRSTN_UI_TAG_ANALYTICS
        CRNRSTN_UI_TAG_ENGAGEMENT

        CRNRSTN_UI_FORM_INTEGRATION_PACKET

        CRNRSTN_UI_COOKIE_PREFERENCE
        CRNRSTN_UI_COOKIE_YESNO
        CRNRSTN_UI_COOKIE_NOTICE

        CRNRSTN_UI_COOKIE_THEME_DARKNIGHT
        CRNRSTN_UI_COOKIE_THEME_FEATHER
        CRNRSTN_UI_COOKIE_THEME_DAYLIGHT
        CRNRSTN_UI_COOKIE_THEME_GREYSKYS


        */

        //
        // 7510-8050
        // 'CRNRSTN_ASSET_MODE_BASE64', 'CRNRSTN_ASSET_MODE_PNG', 'CRNRSTN_ASSET_MODE_JPEG'
        case 'CRNRSTN_ASSET_MODE_BASE64':

            return (int) 7510;

        break;
        case 'CRNRSTN_ASSET_MODE_PNG':

            return (int) 7511;

        break;
        case 'CRNRSTN_ASSET_MODE_JPEG':

            return (int) 7512;

        break;

        //
        // 8051
        // 'CRNRSTN_LOG_ALL', 'CRNRSTN_LOG_NONE', 'CRNRSTN_LOG_EMAIL', 'CRNRSTN_LOG_EMAIL_PROXY', 'CRNRSTN_LOG_FILE',
        // 'CRNRSTN_LOG_FILE_FTP', 'CRNRSTN_LOG_SCREEN_TEXT', 'CRNRSTN_LOG_SCREEN', 'CRNRSTN_LOG_SCREEN_HTML',
        // 'CRNRSTN_LOG_SCREEN_HTML_HIDDEN', 'CRNRSTN_LOG_DEFAULT', 'CRNRSTN_LOG_ELECTRUM'
        case 'CRNRSTN_LOG_EMAIL':

            return (int) 8051;

        break;
        case 'CRNRSTN_LOG_EMAIL_PROXY':

            return (int) 8052;

        break;
        case 'CRNRSTN_LOG_FILE':

            return (int) 8053;

        break;
        case 'CRNRSTN_LOG_FILE_FTP':

            return (int) 8054;

        break;
        case 'CRNRSTN_LOG_SCREEN_TEXT':

            return (int) 8055;

        break;
        case 'CRNRSTN_LOG_SCREEN':

            return (int) 8056;

        break;
        case 'CRNRSTN_LOG_SCREEN_HTML':

            return (int) 8057;

        break;
        case 'CRNRSTN_LOG_SCREEN_HTML_HIDDEN':

            return (int) 8058;

        break;
        case 'CRNRSTN_LOG_DEFAULT':

            return (int) 8059;

        break;
        case 'CRNRSTN_LOG_ELECTRUM':

            return (int) 8060;

        break;
        case 'CRNRSTN_RESOURCE_ALL':

            return (int) 8061;

        break;
        case 'CRNRSTN_RESOURCE_OPENSOURCE':

                return (int) 8062;

        break;
        case 'CRNRSTN_RESOURCE_NEWS_SYNDICATION':

            return (int) 8063;

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