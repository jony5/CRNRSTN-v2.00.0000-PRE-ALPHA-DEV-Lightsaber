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
#  CLASS :: crnrstn_image_v_html_content_manager
#  VERSION :: 1.00.0000
#  DATE :: October 3, 2020 @ 1211hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI ::
#  DESCRIPTION :: Soo much HTML. Just wanted to put in some place nice.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#  Ezekiel 1:5a - AND FROM THE MIDST OF IT [FIRE] THERE CAME THE LIKENESS OF FOUR LIVING CREATURES.
#
class crnrstn_image_v_html_content_manager {

    protected $oLogger;
    private static $oCRNRSTN_n;

    public $sys_asset_mode;
    private static $method_request_mode;
    private static $image_output_mode;

    public function __construct($oCRNRSTN_n){

        self::$oCRNRSTN_n = $oCRNRSTN_n;

        if(self::$oCRNRSTN_n->is_bit_set(CRNRSTN_ASSET_MODE_PNG)){

            //self::$image_output_mode = '';
            $this->sys_asset_mode = CRNRSTN_UI_IMG_PNG_HTML_WRAPPED;

        }else{

            if(self::$oCRNRSTN_n->is_bit_set(CRNRSTN_ASSET_MODE_JPEG)){

                $this->sys_asset_mode = CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED;

            }else{

                //
                // BASE64
                $this->sys_asset_mode = CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED;

            }

        }

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(self::$oCRNRSTN_n->CRNRSTN_debugMode, __CLASS__, self::$oCRNRSTN_n->log_silo_profile, self::$oCRNRSTN_n);

        //$tmp_file_path = __FILE__;

        //$tmp_path_ARRAY = explode(DIRECTORY_SEPARATOR, $tmp_file_path);
        //$tmp_sect_cnt = sizeof($tmp_path_ARRAY);

    }

    public function return_creative($creative_element_key, $image_output_mode = NULL, $creative_mode=NULL){

        if(!isset($image_output_mode)){

            self::$image_output_mode = $this->sys_asset_mode;

        }else{

            // BLIND OVERRIDE
            self::$image_output_mode = $image_output_mode;

        }

        //
        // USE THIS TO SUPPORT WHITE LABELING
        if(isset($creative_mode)){

            $tmp_sys_notices_creative_mode = $creative_mode;

        }else{

            $tmp_sys_notices_creative_mode = self::$oCRNRSTN_n->sys_notices_creative_mode;

        }

        //error_log(__LINE__.' img $tmp_sys_notices_creative_mode=['.$tmp_sys_notices_creative_mode.'] self::$image_output_mode=['.self::$image_output_mode.']');

        //
        // ALL_IMAGE, ALL_HTML, ALL_IMAGE_LOGO_OFF, ALL_HTML_LOGO_OFF
        switch($tmp_sys_notices_creative_mode){
            case 'ALL_IMAGE':

                //error_log(__LINE__.' image_output_mode='.$image_output_mode.' ,creative_element_key='.$creative_element_key);

                switch($creative_element_key){
                    case '5':

                        return $this->FIVE();

                    break;
                    case 'J5_WOLF_PUP_RAND':

                        $tmp_img_out =  $this->J5_WOLF_PUP_RAND();
                        //error_log(__LINE__. ' img to html $tmp_img_out=' . $tmp_img_out);

                        return $tmp_img_out;

                    break;
                    case 'CRNRSTN_LOGO':

                        return $this->CRNRSTN_LOGO_EMAIL();

                    break;
                    case 'CRNRSTN_R':

                        return $this->R();

                    break;
                    case 'CRNRSTN_R_WALL':

                        return $this->R_PLUS_WALL();

                    break;
                    case 'SUCCESS_CHECK':

                        return $this->SUCCESS_CHECK();

                    break;
                    case 'ERR_X':

                        return $this->ERR_X();

                    break;
                    case 'CRNRSTN_FAVICON':

                        return $this->CRNRSTN_FAVICON();

                    break;
                    case 'LINUX_PENGUIN':

                        return $this->LINUX_PENGUIN();

                    break;
                    case 'MYSQL_DOLPHIN':

                        return $this->MYSQL_DOLPHIN();

                    break;
                    case 'REDHAT_BAR':

                        return $this->REDHAT_BAR();

                    break;
                    case 'REDHAT_CIRCLE':

                        return $this->REDHAT_CIRCLE();

                    break;
                    case 'APACHE_POWER_VERSION':

                        return $this->APACHE_POWER_VERSION();

                    break;
                    case 'APACHE_POWER_2_4':

                        return $this->APACHE_POWER_2_4();

                    break;
                    case 'APACHE_POWER_2_2':

                        return $this->APACHE_POWER_2_2();

                    break;
                    case 'APACHE_POWER_2_0':

                        return $this->APACHE_POWER_2_0();

                    break;
                    case 'APACHE_POWER_1_3':

                        return $this->APACHE_POWER_1_3();

                    break;
                    case 'APACHE_POWER':

                        return $this->APACHE_POWER();

                    break;
                    case 'REDHAT_POWER':

                        return $this->REDHAT_POWER();

                    break;
                    case 'PHP_ELLIPSE':

                        return $this->PHP_ELLIPSE();

                    break;
                    case 'POW_BY_PHP':

                        return $this->POW_BY_PHP();

                    break;
                    case 'ZEND_LOGO':

                        return $this->ZEND_LOGO();

                    break;
                    case 'ZEND_FRAMEWORK_3':

                        return $this->ZEND_FRAMEWORK_3();

                    break;
                    case 'ZEND_FRAMEWORK':

                        return $this->ZEND_FRAMEWORK();

                    break;
                    case 'BG_ELEMENT_RESPONSE_CODE':

                        return $this->BG_SHADOW_RESPONSE_CODE();

                    break;
                    case 'BG_ELEMENT_LOGO_SIGNIN':

                        return $this->BG_ELEMENT_LOGO_SIGNIN();

                    break;
                    case 'BG_ELEMENT_REFLECTION_SIGNING':

                        return $this->BG_ELEMENT_REFLECTION_SIGNIN();

                    break;
                    case 'DOT_GREEN':

                        return $this->DOT_GREEN();

                    break;
                    case 'DOT_RED':

                        return $this->DOT_RED();

                    break;
                    case 'DOT_OFF':

                        return $this->DOT_OFF();

                    break;
                    case 'NOTICE_TRI_ALERT':

                        return $this->NOTICE_TRI_ALERT();

                    break;
                    case 'SEARCH_MAGNIFY_GLASS':

                        return $this->SEARCH_MAGNIFY_GLASS();

                    break;
                    case 'ICON_EMAIL_INBOX_REFLECT':

                        return $this->ICON_EMAIL_INBOX_REFLECT();

                    break;
                    case 'J5_WOLF_PUP':

                        return $this->J5_WOLF_PUP();

                    break;
                    case 'J5_WOLF_PUP_LAY_00':

                        return $this->J5_WOLF_PUP_LAY_00();

                    break;
                    case 'J5_WOLF_PUP_LAY_01':

                        return $this->J5_WOLF_PUP_LAY_01();

                    break;
                    case 'J5_WOLF_PUP_LAY_02':

                        return $this->J5_WOLF_PUP_LAY_02();

                    break;
                    case 'J5_WOLF_PUP_LAY_LOOK_AWAY':

                        return $this->J5_WOLF_PUP_LAY_LOOK_AWAY();

                    break;
                    case 'J5_WOLF_PUP_LAY_LOOK_FORWARD':

                        return $this->J5_WOLF_PUP_LAY_LOOK_FORWARD();

                    break;
                    case 'J5_WOLF_PUP_LAY_LOOK_FORWARD_LEASH':

                        return $this->J5_WOLF_PUP_LAY_LOOK_FORWARD_LEASH();

                    break;
                    case 'J5_WOLF_PUP_LEASH_EYES_CLOSED':

                        return $this->J5_WOLF_PUP_LEASH_EYES_CLOSED();

                    break;
                    case 'J5_WOLF_PUP_LIL_5_PTS':

                        return $this->J5_WOLF_PUP_LIL_5_PTS();

                    break;
                    case 'J5_WOLF_PUP_SIT_EYES_CLOSED':

                        return $this->J5_WOLF_PUP_SIT_EYES_CLOSED();

                    break;
                    case 'J5_WOLF_PUP_SIT_LOOK_FORWARD':

                        return $this->J5_WOLF_PUP_SIT_LOOK_FORWARD();

                    break;
                    case 'J5_WOLF_PUP_SIT_LOOK_LEFT_ISH_SHADOW':

                        return $this->J5_WOLF_PUP_SIT_LOOK_LEFT_ISH_SHADOW();

                    break;
                    case 'J5_WOLF_PUP_SIT_LOOK_RIGHT':

                        return $this->J5_WOLF_PUP_SIT_LOOK_RIGHT();

                    break;
                    case 'J5_WOLF_PUP_SIT_LOOK_RIGHT_LONGSHADOW':

                        return $this->J5_WOLF_PUP_SIT_LOOK_RIGHT_LONGSHADOW();

                    break;
                    case 'J5_WOLF_PUP_SIT_LOOK_RIGHT_SHADOW':

                        return $this->J5_WOLF_PUP_SIT_LOOK_RIGHT_SHADOW();

                    break;
                    case 'J5_WOLF_PUP_SIT_LOOK_RIGHT_SHORT_SHADOW':

                        return $this->J5_WOLF_PUP_SIT_LOOK_RIGHT_SHORT_SHADOW();

                    break;
                    case 'J5_WOLF_PUP_SIT_LOOK_RIGHT_UP':

                        return $this->J5_WOLF_PUP_SIT_LOOK_RIGHT_UP();

                    break;
                    case 'J5_WOLF_PUP_SIT_LOOK_RIGHTSHARP_SHADOW':

                        return $this->J5_WOLF_PUP_SIT_LOOK_RIGHTSHARP_SHADOW();

                    break;
                    case 'J5_WOLF_PUP_STAND_LOOK_RIGHT':

                        return $this->J5_WOLF_PUP_STAND_LOOK_RIGHT();

                    break;
                    case 'J5_WOLF_PUP_STAND_LOOK_UP':

                        return $this->J5_WOLF_PUP_STAND_LOOK_UP();

                    break;
                    case 'J5_WOLF_PUP_WALK':

                        return $this->J5_WOLF_PUP_WALK();

                    break;

                }

            break;
            case 'ALL_HTML':

                switch($creative_element_key){
                    case '5':

                        return $this->FIVE();

                    break;
                    case 'J5_WOLF_PUP_RAND':

                        return $this->J5_WOLF_PUP_RAND();

                    break;
                    case 'CRNRSTN_LOGO':

                        return $this->CRNRSTN_LOGO_EMAIL();

                    break;
                    case 'CRNRSTN_R':

                        return $this->R();

                    break;
                    case 'CRNRSTN_R_WALL':

                        return $this->R_PLUS_WALL();

                    break;
                    case 'SUCCESS_CHECK':

                        return $this->SUCCESS_CHECK();

                    break;
                    case 'ERR_X':

                        return $this->ERR_X();

                    break;
                    case 'LINUX_PENGUIN':

                        return $this->LINUX_PENGUIN();

                    break;
                    case 'MYSQL_DOLPHIN':

                        return $this->MYSQL_DOLPHIN();

                    break;
                    case 'REDHAT_BAR':

                        return $this->REDHAT_BAR();

                    break;
                    case 'REDHAT_CIRCLE':

                        return $this->REDHAT_CIRCLE();

                    break;
                    case 'APACHE_POWER_VERS':

                        return $this->APACHE_POWER_VERSION();

                    break;
                    case 'APACHE_POWER':

                        return $this->APACHE_POWER();

                    break;
                    case 'REDHAT_POWER':

                        return $this->REDHAT_POWER();

                    break;
                    case 'PHP_ELLIPSE':

                        return $this->PHP_ELLIPSE();

                    break;
                    case 'POW_BY_PHP':

                        return $this->POW_BY_PHP();

                    break;
                    case 'ZEND_LOGO':

                        return $this->ZEND_LOGO();

                    break;
                    case 'ZEND_FRAMEWORK_3':

                        return $this->ZEND_FRAMEWORK_3();

                    break;
                    case 'ZEND_FRAMEWORK':

                        return $this->ZEND_FRAMEWORK();

                    break;
                    case 'BG_ELEMENT_LOGO_SIGNIN':

                        return $this->BG_ELEMENT_LOGO_SIGNIN();

                    break;
                    case 'BG_ELEMENT_REFLECTION_SIGNING':

                        return $this->BG_ELEMENT_REFLECTION_SIGNIN();

                    break;
                    case 'DOT_GREEN':

                        return $this->DOT_GREEN();

                    break;
                    case 'DOT_RED':

                        return $this->DOT_RED();

                    break;
                    case 'DOT_OFF':

                        return $this->DOT_OFF();

                    break;
                    case 'NOTICE_TRI_ALERT':

                        return $this->NOTICE_TRI_ALERT();

                    break;
                    case 'ICON_EMAIL_INBOX_REFLECT':

                        return $this->ICON_EMAIL_INBOX_REFLECT();

                    break;
                    case 'SEARCH_MAGNIFY_GLASS':

                        return $this->SEARCH_MAGNIFY_GLASS();

                    break;

                }

            break;
            case 'ALL_IMAGE_LOGO_OFF':

                switch($creative_element_key){
                    case '5':

                        return $this->FIVE();

                    break;
                    case 'J5_WOLF_PUP_RAND':

                        return $this->J5_WOLF_PUP_RAND();

                    break;
                    case 'CRNRSTN_LOGO':

                        return '&nbsp;';

                    break;
                    case 'CRNRSTN_R':

                        return $this->R();

                    break;
                    case 'CRNRSTN_R_WALL':

                        return $this->R_PLUS_WALL();

                    break;
                    case 'SUCCESS_CHECK':

                        return $this->SUCCESS_CHECK();

                    break;
                    case 'ERR_X':

                        return $this->ERR_X();

                    break;
                    case 'CRNRSTN_FAVICON':

                        return $this->CRNRSTN_FAVICON();

                    break;
                    case 'LINUX_PENGUIN':

                        return $this->LINUX_PENGUIN();

                    break;
                    case 'MYSQL_DOLPHIN':

                        return $this->MYSQL_DOLPHIN();

                    break;
                    case 'REDHAT_BAR':

                        return $this->REDHAT_BAR();

                    break;
                    case 'REDHAT_CIRCLE':

                        return $this->REDHAT_CIRCLE();

                    break;
                    case 'APACHE_POWER_VERS':

                        return $this->APACHE_POWER_VERSION();

                    break;
                    case 'APACHE_POWER':

                        return $this->APACHE_POWER();

                    break;
                    case 'REDHAT_POWER':

                        return $this->REDHAT_POWER();

                    break;
                    case 'PHP_ELLIPSE':

                        return $this->PHP_ELLIPSE();

                    break;
                    case 'POW_BY_PHP':

                        return $this->POW_BY_PHP();

                    break;
                    case 'ZEND_LOGO':

                        return $this->ZEND_LOGO();

                    break;
                    case 'ZEND_FRAMEWORK_3':

                        return $this->ZEND_FRAMEWORK_3();

                    break;
                    case 'ZEND_FRAMEWORK':

                        return $this->ZEND_FRAMEWORK();

                    break;
                    case 'BG_ELEMENT_RESPONSE_CODE':

                        return $this->BG_SHADOW_RESPONSE_CODE();

                    break;
                    case 'BG_ELEMENT_LOGO_SIGNIN':

                        return $this->BG_ELEMENT_LOGO_SIGNIN();

                    break;
                    case 'BG_ELEMENT_REFLECTION_SIGNING':

                        return $this->BG_ELEMENT_REFLECTION_SIGNIN();

                    break;
                    case 'DOT_GREEN':

                        return $this->DOT_GREEN();

                    break;
                    case 'DOT_RED':

                        return $this->DOT_RED();

                    break;
                    case 'DOT_OFF':

                        return $this->DOT_OFF();

                    break;
                    case 'NOTICE_TRI_ALERT':

                        return $this->NOTICE_TRI_ALERT();

                    break;
                    case 'ICON_EMAIL_INBOX_REFLECT':

                        return $this->ICON_EMAIL_INBOX_REFLECT();

                    break;
                    case 'SEARCH_MAGNIFY_GLASS':

                        return $this->SEARCH_MAGNIFY_GLASS();

                    break;


                }

            break;
            case 'ALL_HTML_LOGO_OFF':

                switch($creative_element_key){
                    case '5':

                        return $this->FIVE();

                    break;
                    case 'J5_WOLF_PUP_RAND':

                        return $this->J5_WOLF_PUP_RAND();

                    break;
                    case 'CRNRSTN_LOGO':

                        return '&nbsp;';

                    break;
                    case 'CRNRSTN_R':

                        return $this->R();

                    break;
                    case 'CRNRSTN_R_WALL':

                        return $this->R_PLUS_WALL();

                    break;
                    case 'SUCCESS_CHECK':

                        return $this->SUCCESS_CHECK();

                    break;
                    case 'ERR_X':

                        return $this->ERR_X();

                    break;
                    case 'LINUX_PENGUIN':

                        return $this->LINUX_PENGUIN();

                    break;
                    case 'MYSQL_DOLPHIN':

                        return $this->MYSQL_DOLPHIN();

                    break;
                    case 'REDHAT_BAR':

                        return $this->REDHAT_BAR();

                    break;
                    case 'REDHAT_CIRCLE':

                        return $this->REDHAT_CIRCLE();

                    break;
                    case 'APACHE_POWER_VERS':

                        return $this->APACHE_POWER_VERSION();

                    break;
                    case 'APACHE_POWER':

                        return $this->APACHE_POWER();

                    break;
                    case 'REDHAT_POWER':

                        return $this->REDHAT_POWER();

                    break;
                    case 'PHP_ELLIPSE':

                        return $this->PHP_ELLIPSE();

                    break;
                    case 'POW_BY_PHP':

                        return $this->POW_BY_PHP();

                    break;
                    case 'ZEND_LOGO':

                        return $this->ZEND_LOGO();

                    break;
                    case 'ZEND_FRAMEWORK_3':

                        return $this->ZEND_FRAMEWORK_3();

                    break;
                    case 'ZEND_FRAMEWORK':

                        return $this->ZEND_FRAMEWORK();

                    break;
                    case 'BG_ELEMENT_LOGO_SIGNIN':

                        return $this->BG_ELEMENT_LOGO_SIGNIN();

                    break;
                    case 'BG_ELEMENT_REFLECTION_SIGNING':

                        return $this->BG_ELEMENT_REFLECTION_SIGNIN();

                    break;
                    case 'DOT_GREEN':

                        return $this->DOT_GREEN();

                    break;
                    case 'DOT_RED':

                        return $this->DOT_RED();

                    break;
                    case 'DOT_OFF':

                        return $this->DOT_OFF();

                    break;
                    case 'NOTICE_TRI_ALERT':

                        return $this->NOTICE_TRI_ALERT();

                    break;
                    case 'ICON_EMAIL_INBOX_REFLECT':

                        return $this->ICON_EMAIL_INBOX_REFLECT();

                    break;
                    case 'SEARCH_MAGNIFY_GLASS':

                        return $this->SEARCH_MAGNIFY_GLASS();

                    break;

                }

            break;
            case 'SOAP_TRANSPORT':

                return '{'.$creative_element_key.'::SOAP_TRANSPORT}';

            break;
            default:

                //
                // ALL_HTML
                switch($creative_element_key){
                    case '5':

                        return $this->FIVE();

                    break;
                    case 'J5_WOLF_PUP_RAND':

                        return $this->J5_WOLF_PUP_RAND();

                    break;
                    case 'CRNRSTN_LOGO':

                        return $this->CRNRSTN_LOGO_EMAIL();

                    break;
                    case 'CRNRSTN_R':

                        return $this->R();

                    break;
                    case 'CRNRSTN_R_WALL':

                        return $this->R_PLUS_WALL();

                    break;
                    case 'SUCCESS_CHECK':

                        return $this->SUCCESS_CHECK();

                    break;
                    case 'ERR_X':

                        return $this->ERR_X();

                    break;
                    case 'CRNRSTN_FAVICON':

                        //return $this->CRNRSTN_FAVICON();
                        return '';

                    break;
                    case 'LINUX_PENGUIN':

                        return $this->LINUX_PENGUIN();

                    break;
                    case 'MYSQL_DOLPHIN':

                        return $this->MYSQL_DOLPHIN();

                    break;
                    case 'REDHAT_BAR':

                        return $this->REDHAT_BAR();

                    break;
                    case 'REDHAT_CIRCLE':

                        return $this->REDHAT_CIRCLE();

                    break;
                    case 'APACHE_POWER_VERS':

                        return $this->APACHE_POWER_VERSION();

                    break;
                    case 'APACHE_POWER':

                        return $this->APACHE_POWER();

                    break;
                    case 'REDHAT_POWER':

                        return $this->REDHAT_POWER();

                    break;
                    case 'PHP_ELLIPSE':

                        return $this->PHP_ELLIPSE();

                    break;
                    case 'POW_BY_PHP':

                        return $this->POW_BY_PHP();

                    break;
                    case 'BG_ELEMENT_LOGO_SIGNIN':

                        return $this->BG_ELEMENT_LOGO_SIGNIN();

                    break;
                    case 'BG_ELEMENT_REFLECTION_SIGNING':

                        return $this->BG_ELEMENT_REFLECTION_SIGNIN();

                    break;
                    case 'ZEND_LOGO':

                        return $this->ZEND_LOGO();

                    break;
                    case 'ZEND_FRAMEWORK_3':

                        return $this->ZEND_FRAMEWORK_3();

                    break;
                    case 'ZEND_FRAMEWORK':

                        return $this->ZEND_FRAMEWORK();

                    break;
                    case 'DOT_GREEN':

                        return $this->DOT_GREEN();

                    break;
                    case 'DOT_RED':

                        return $this->DOT_RED();

                    break;
                    case 'DOT_OFF':

                        return $this->DOT_OFF();

                    break;
                    case 'NOTICE_TRI_ALERT':

                        return $this->NOTICE_TRI_ALERT();

                    break;
                    case 'ICON_EMAIL_INBOX_REFLECT':

                        return $this->ICON_EMAIL_INBOX_REFLECT();

                    break;
                    case 'SEARCH_MAGNIFY_GLASS':

                        return $this->SEARCH_MAGNIFY_GLASS();

                    break;

                }

            break;

        }

        return '';

    }

    private function ____FAVICON(){

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:
            case CRNRSTN_UI_IMG_PNG_HTML_WRAPPED:

                return '<link rel="shortcut icon" type="image/x-icon" href="'.self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/favicon.ico?v=420.00" />';

            break;
            default:
                //
                // BASE64
                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/favicon.ico';

            break;

        }

    }

    private function CRNRSTN_FAVICON(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/favicon.jpg
        $tmp_filename = 'favicon';
//        $tmp_width = 32;
//        $tmp_height = 32;
//        $tmp_alt_text = 'R';
//        $tmp_title_text = 'R';
//        $tmp_link = '';
//        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED
                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                return '<link rel="shortcut icon" type="image/x-icon" href="'.self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/'.$tmp_filename.'.ico?v=420.00" />';

            break;

        }

    }

    private function FIVE(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/5.jpg
        $tmp_filename = '5';
        $tmp_width = 18;
        $tmp_height = 17;
        $tmp_alt_text = 'success';
        $tmp_title_text = 'success';
        $tmp_link = 'http://jony5.com/projects/crnrstn/philosophy/';
        $tmp_target = '_blank';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return '<div style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight: normal;">'.$tmp_str.'</div>';

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return '<div style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight: normal;">'.$tmp_str.'</div>';

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

            break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return '<div style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight: normal;">'.$tmp_str.'</div>';

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;

        }

    }

    private function SUCCESS_CHECK(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/success_chk.jpg
        $tmp_filename = 'success_chk';
        $tmp_width = 19;
        $tmp_height = 19;
        $tmp_alt_text = 'success';
        $tmp_title_text = 'success';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

            break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;

        }

    }

    private function ERR_X(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/err_x.jpg
        $tmp_filename = 'err_x';
        $tmp_width = 19;
        $tmp_height = 19;
        $tmp_alt_text = 'X';
        $tmp_title_text = 'error';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

            break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;

        }

    }

    private function CRNRSTN_LOGO_EMAIL(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/crnrstn_logo_md.jpg
        $tmp_filename = 'crnrstn_logo_md';
        $tmp_width = 165;
        $tmp_height = 100;
        $tmp_alt_text = 'CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn;
        $tmp_title_text = 'CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn;
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

            break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;

        }

    }

    private function R(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/crnrstn_R_md.jpg
        $tmp_filename = 'crnrstn_R_md';
        $tmp_width = 26;
        $tmp_height = 35;
        $tmp_alt_text = 'CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn;
        $tmp_title_text = 'CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn;
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

            break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;

        }

    }

    private function R_PLUS_WALL(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/crnrstn_R_md_plus_wall.jpg
        $tmp_filename = 'crnrstn_R_md_plus_wall';
        $tmp_width = 66;
        $tmp_height = 35;
        $tmp_alt_text = 'CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn;
        $tmp_title_text = 'CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn;
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

            break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;

        }

    }

    private function BG_SHADOW_RESPONSE_CODE(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/elem_shadow_btm.jpg
        $tmp_filename = 'elem_shadow_btm';
        $tmp_width = 1;
        $tmp_height = 5;
        $tmp_alt_text = '';
        $tmp_title_text = '';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

            break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;

        }

    }

    private function PHP_ELLIPSE(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/php_logo.jpg
        $tmp_filename = 'php_logo';
        $tmp_width = 65;
        $tmp_height = 35;
        $tmp_alt_text = 'php v'.self::$oCRNRSTN_n->version_php;
        $tmp_title_text = 'php v'.self::$oCRNRSTN_n->version_php . ' :: CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn;
        $tmp_link = 'https://www.php.net/';
        $tmp_target = '_blank';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

            break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;

        }

    }

    private function POW_BY_PHP(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/powered_by_php.jpg
        $tmp_filename = 'powered_by_php';
        $tmp_width = 100;
        $tmp_height = 35;
        $tmp_alt_text = 'Powered by php v'.self::$oCRNRSTN_n->version_php;
        $tmp_title_text = 'Powered by php v'.self::$oCRNRSTN_n->version_php . ' :: CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn;
        $tmp_link = 'https://www.php.net/';
        $tmp_target = '_blank';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

            break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;

        }

    }

    private function ZEND_LOGO(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/zend_logo.jpg
        $tmp_filename = 'zend_logo';
        $tmp_width = 73;
        $tmp_height = 35;
        $tmp_alt_text = 'ZEND';
        $tmp_title_text = 'ZEND' . ' :: CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn;
        $tmp_link = 'https://www.zend.com/';
        $tmp_target = '_blank';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

            break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;

        }

    }

    private function ZEND_FRAMEWORK(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/zend_framework.jpg
        $tmp_filename = 'zend_framework';
        $tmp_width = 212;
        $tmp_height = 35;
        $tmp_alt_text = 'ZEND FRAMEWORK';
        $tmp_title_text = 'ZEND FRAMEWORK' . ' :: CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn;
        $tmp_link = 'https://www.zend.com/';
        $tmp_target = '_blank';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;

        }

    }

    private function ZEND_FRAMEWORK_3(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/zend_framework_3.jpg
        $tmp_filename = 'zend_framework_3';
        $tmp_width = 224;
        $tmp_height = 35;
        $tmp_alt_text = 'ZEND FRAMEWORK 3';
        $tmp_title_text = 'ZEND FRAMEWORK 3' . ' :: CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn;
        $tmp_link = 'https://www.zend.com/';
        $tmp_target = '_blank';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;

        }

    }

    private function LINUX_PENGUIN(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/linux_penguin_sm.jpg
        $tmp_filename = 'linux_penguin_sm';
        $tmp_width = 30;
        $tmp_height = 35;
        $tmp_alt_text = 'Linux :: Tux the Penguin';
        $tmp_title_text = 'Linux' . ' :: CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn;
        $tmp_link = 'https://www.linux.com/';
        $tmp_target = '_blank';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;

        }

    }

    private function MYSQL_DOLPHIN(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/mysql_logo.jpg
        $tmp_filename = 'mysql_logo';
        $tmp_width = 66;
        $tmp_height = 35;

        if(strlen(self::$oCRNRSTN_n->version_mysqli) > 0){

            $tmp_alt_text = 'MySQLi v'.self::$oCRNRSTN_n->version_mysqli;
            $tmp_title_text = 'MySQLi v'.self::$oCRNRSTN_n->version_mysqli . ' :: CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn;

        }else{

            $tmp_alt_text = 'MySQLi';
            $tmp_title_text = 'MySQLi' . ' :: CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn;

        }

        $tmp_link = 'https://www.mysql.com/';
        $tmp_target = '_blank';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;

        }

    }

    private function REDHAT_POWER(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/powered_by_redhat.jpg
        $tmp_filename = 'powered_by_redhat';
        $tmp_width = 103;
        $tmp_height = 35;
        $tmp_alt_text = 'Powered by Red Hat';
        $tmp_title_text = 'Powered by Red Hat Linux' . ' :: CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn;
        $tmp_link = 'https://www.redhat.com/';
        $tmp_target = '_blank';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;

        }

    }

    private function REDHAT_BAR(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/redhat_bar.jpg
        $tmp_filename = 'redhat_bar';
        $tmp_width = 106;
        $tmp_height = 35;
        $tmp_alt_text = 'Red Hat';
        $tmp_title_text = 'Red Hat Linux' . ' :: CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn;
        $tmp_link = 'https://www.redhat.com/';
        $tmp_target = '_blank';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;

        }

    }

    private function REDHAT_CIRCLE(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/redhat_circle.jpg
        $tmp_filename = 'redhat_circle';
        $tmp_width = 40;
        $tmp_height = 35;
        $tmp_alt_text = 'Red Hat Linux';
        $tmp_title_text = 'Red Hat Linux' . ' :: CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn;
        $tmp_link = 'https://www.redhat.com/';
        $tmp_target = '_blank';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;

        }

    }

    private function APACHE_POWER_VERSION(){

        $version = self::$oCRNRSTN_n->version_apache_sysimg;

        switch($version){
            case 2.4:

                return $this->APACHE_POWER_2_4();

            break;
            case 2.2:

                return $this->APACHE_POWER_2_2();

            break;
            case 2.0:

                return $this->APACHE_POWER_2_0();

            break;
            case 1.3:

                return $this->APACHE_POWER_1_3();

            break;
            default:

                return $this->APACHE_POWER();

            break;

        }

    }

    private function APACHE_POWER_2_4(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/powered_by_apache_2_4.jpg
        $tmp_filename = 'powered_by_apache_2_4';
        $tmp_width = 259;
        $tmp_height = 32;

        if(strlen(self::$oCRNRSTN_n->version_apache) > 0){

            $tmp_alt_text = 'Powered by Apache v'.self::$oCRNRSTN_n->version_apache;
            $tmp_title_text = 'Powered by Apache v'.self::$oCRNRSTN_n->version_apache . ' :: CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn;

        }else{

            $tmp_alt_text = 'Powered by Apache';
            $tmp_title_text = 'Powered by Apache v' . ' :: CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn;

        }

        $tmp_link = 'http://apache.org/';
        $tmp_target = '_blank';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;

        }

    }

    private function APACHE_POWER_2_2(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/powered_by_apache_2_2.jpg
        $tmp_filename = 'powered_by_apache_2_2';
        $tmp_width = 259;
        $tmp_height = 32;

        if(strlen(self::$oCRNRSTN_n->version_apache) > 0){

            $tmp_alt_text = 'Powered by Apache v'.self::$oCRNRSTN_n->version_apache;
            $tmp_title_text = 'Powered by Apache v'.self::$oCRNRSTN_n->version_apache . ' :: CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn;

        }else{

            $tmp_alt_text = 'Powered by Apache';
            $tmp_title_text = 'Powered by Apache v' . ' :: CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn;

        }

        $tmp_link = 'http://apache.org/';
        $tmp_target = '_blank';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;

        }

    }

    private function APACHE_POWER_2_0(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/powered_by_apache_2.jpg
        $tmp_filename = 'powered_by_apache_2';
        $tmp_width = 259;
        $tmp_height = 32;

        if(strlen(self::$oCRNRSTN_n->version_apache) > 0){

            $tmp_alt_text = 'Powered by Apache v'.self::$oCRNRSTN_n->version_apache;
            $tmp_title_text = 'Powered by Apache v'.self::$oCRNRSTN_n->version_apache . ' :: CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn;

        }else{

            $tmp_alt_text = 'Powered by Apache';
            $tmp_title_text = 'Powered by Apache v' . ' :: CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn;

        }

        $tmp_link = 'http://apache.org/';
        $tmp_target = '_blank';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;

        }

    }

    private function APACHE_POWER_1_3(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/powered_by_apache_1_3.jpg
        $tmp_filename = 'powered_by_apache_1_3';
        $tmp_width = 259;
        $tmp_height = 32;

        if(strlen(self::$oCRNRSTN_n->version_apache) > 0){

            $tmp_alt_text = 'Powered by Apache v'.self::$oCRNRSTN_n->version_apache;
            $tmp_title_text = 'Powered by Apache v'.self::$oCRNRSTN_n->version_apache . ' :: CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn;

        }else{

            $tmp_alt_text = 'Powered by Apache';
            $tmp_title_text = 'Powered by Apache v' . ' :: CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn;

        }

        $tmp_link = 'http://apache.org/';
        $tmp_target = '_blank';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;

        }

    }

    private function APACHE_POWER(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/powered_by_apache.jpg
        $tmp_filename = 'powered_by_apache';
        $tmp_width = 259;
        $tmp_height = 32;

        $tmp_alt_text = 'Powered by Apache';
        $tmp_title_text = 'Powered by Apache' . ' :: CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn;

        $tmp_link = 'http://apache.org/';
        $tmp_target = '_blank';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;

        }

    }

    private function BG_ELEMENT_LOGO_SIGNIN(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/crnrstn_logo_lg.jpg
        $tmp_filename = 'crnrstn_logo_lg';
        $tmp_width = 345;
        $tmp_height = 208;
        $tmp_alt_text = 'CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn;
        $tmp_title_text = 'CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn;
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;

        }

    }

    private function BG_ELEMENT_REFLECTION_SIGNIN(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/signin_frm_reflection.jpg
        $tmp_filename = 'signin_frm_reflection';
        $tmp_width = 722;
        $tmp_height = 55;
        $tmp_alt_text = 'CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn;
        $tmp_title_text = 'CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn;
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;

        }

    }

    private function DOT_GREEN(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/dot_grn.jpg
        $tmp_filename = 'dot_grn';
        $tmp_width = 20;
        $tmp_height = 20;
        $tmp_alt_text = 'O';
        $tmp_title_text = 'O';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;

        }

    }

    private function DOT_RED(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/dot_red.jpg
        $tmp_filename = 'dot_red';
        $tmp_width = 20;
        $tmp_height = 20;
        $tmp_alt_text = 'O';
        $tmp_title_text = 'O';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;

        }

    }

    private function DOT_OFF(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/dot_grey.jpg
        $tmp_filename = 'dot_grey';
        $tmp_width = 20;
        $tmp_height = 20;
        $tmp_alt_text = 'O';
        $tmp_title_text = 'O';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;

        }

    }

    private function NOTICE_TRI_ALERT(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/triangle_alert.jpg
        $tmp_filename = 'triangle_alert';
        $tmp_width = 19;
        $tmp_height = 19;
        $tmp_alt_text = '!';
        $tmp_title_text = 'alert';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;

        }

    }

    private function SEARCH_MAGNIFY_GLASS(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/mag_glass_search.jpg
        $tmp_filename = 'mag_glass_search';
        $tmp_width = 14;
        $tmp_height = 14;
        $tmp_alt_text = 'Search';
        $tmp_title_text = 'Search';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;

        }

    }

    private function ICON_EMAIL_INBOX_REFLECT(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/email_inbox_icon.jpg
        $tmp_filename = 'email_inbox_icon';
        $tmp_width = 201;
        $tmp_height = 185;
        $tmp_alt_text = 'CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn;
        $tmp_title_text = 'CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn;
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;

        }

    }

    private function J5_WOLF_PUP_RAND(){

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

        switch($tmp_array[$tmp_int]){
            case 'J5_WOLF_PUP':

                return $this->J5_WOLF_PUP();

            break;
            case 'J5_WOLF_PUP_LAY_00':

                return $this->J5_WOLF_PUP_LAY_00();

            break;
            case 'J5_WOLF_PUP_LAY_01':

                return $this->J5_WOLF_PUP_LAY_01();

            break;
            case 'J5_WOLF_PUP_LAY_02':

                return $this->J5_WOLF_PUP_LAY_02();

            break;
            case 'J5_WOLF_PUP_LAY_LOOK_AWAY':

                return $this->J5_WOLF_PUP_LAY_LOOK_AWAY();

            break;
            case 'J5_WOLF_PUP_LAY_LOOK_FORWARD':

                return $this->J5_WOLF_PUP_LAY_LOOK_FORWARD();

            break;
            case 'J5_WOLF_PUP_LAY_LOOK_FORWARD_LEASH':

                return $this->J5_WOLF_PUP_LAY_LOOK_FORWARD_LEASH();

            break;
            case 'J5_WOLF_PUP_LEASH_EYES_CLOSED':

                return $this->J5_WOLF_PUP_LEASH_EYES_CLOSED();

            break;
            case 'J5_WOLF_PUP_LIL_5_PTS':

                return $this->J5_WOLF_PUP_LIL_5_PTS();

            break;
            case 'J5_WOLF_PUP_SIT_EYES_CLOSED':

                return $this->J5_WOLF_PUP_SIT_EYES_CLOSED();

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_FORWARD':

                return $this->J5_WOLF_PUP_SIT_LOOK_FORWARD();

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_LEFT_ISH_SHADOW':

                return $this->J5_WOLF_PUP_SIT_LOOK_LEFT_ISH_SHADOW();

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_RIGHT':

                return $this->J5_WOLF_PUP_SIT_LOOK_RIGHT();

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_RIGHT_LONGSHADOW':

                return $this->J5_WOLF_PUP_SIT_LOOK_RIGHT_LONGSHADOW();

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_RIGHT_SHADOW':

                return $this->J5_WOLF_PUP_SIT_LOOK_RIGHT_SHADOW();

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_RIGHT_SHORT_SHADOW':

                return $this->J5_WOLF_PUP_SIT_LOOK_RIGHT_SHORT_SHADOW();

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_RIGHT_UP':

                return $this->J5_WOLF_PUP_SIT_LOOK_RIGHT_UP();

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_RIGHTSHARP_SHADOW':

                return $this->J5_WOLF_PUP_SIT_LOOK_RIGHTSHARP_SHADOW();

            break;
            case 'J5_WOLF_PUP_STAND_LOOK_RIGHT':

                return $this->J5_WOLF_PUP_STAND_LOOK_RIGHT();

            break;
            case 'J5_WOLF_PUP_STAND_LOOK_UP':

                return $this->J5_WOLF_PUP_STAND_LOOK_UP();

            break;
            case 'J5_WOLF_PUP_WALK':

                return $this->J5_WOLF_PUP_WALK();

            break;
            default:

                //
                //J5_WOLF_PUP

                return $this->J5_WOLF_PUP();

            break;

        }

    }

    private function J5_WOLF_PUP(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup.jpg
        $tmp_filename = 'j5_wolf_pup';
        $tmp_width = 525;
        $tmp_height = 351;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

            break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<div style="border-right:10px solid #FFF;"><img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;"></div>';

                }

            break;

        }

    }

    private function J5_WOLF_PUP_LAY_00(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_lay_00.jpg
        $tmp_filename = 'j5_wolf_pup_lay_00';
        $tmp_width = 480;
        $tmp_height = 345;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;

        }

    }

    private function J5_WOLF_PUP_LAY_01(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_lay_01.jpg
        $tmp_filename = 'j5_wolf_pup_lay_01';
        $tmp_width = 431;
        $tmp_height = 400;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;

        }

    }

    private function J5_WOLF_PUP_LAY_02(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_lay_02.jpg
        $tmp_filename = 'j5_wolf_pup_lay_02';
        $tmp_width = 379;
        $tmp_height = 348;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;

        }

    }

    private function J5_WOLF_PUP_LAY_LOOK_AWAY(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_lay_look_away.jpg
        $tmp_filename = 'j5_wolf_pup_lay_look_away';
        $tmp_width = 260;
        $tmp_height = 400;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;

        }

    }

    private function J5_WOLF_PUP_LAY_LOOK_FORWARD(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_lay_look_forward.jpg
        $tmp_filename = 'j5_wolf_pup_lay_look_forward';
        $tmp_width = 270;
        $tmp_height = 450;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;

        }

    }

    private function J5_WOLF_PUP_LAY_LOOK_FORWARD_LEASH(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_lay_look_forward_leash.jpg
        $tmp_filename = 'j5_wolf_pup_lay_look_forward_leash';
        $tmp_width = 321;
        $tmp_height = 365;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;

        }

    }

    private function J5_WOLF_PUP_LEASH_EYES_CLOSED(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_leash_eyes_closed.jpg
        $tmp_filename = 'j5_wolf_pup_leash_eyes_closed';
        $tmp_width = 450;
        $tmp_height = 370;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;

        }

    }

    private function J5_WOLF_PUP_LIL_5_PTS(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_lil_5_pts.jpg
        $tmp_filename = 'j5_wolf_pup_lil_5_pts';
        $tmp_width = 300;
        $tmp_height = 340;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;

        }

    }

    private function J5_WOLF_PUP_SIT_EYES_CLOSED(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_sit_eyes_closed.jpg
        $tmp_filename = 'j5_wolf_pup_sit_eyes_closed';
        $tmp_width = 307;
        $tmp_height = 376;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;

        }

    }

    private function J5_WOLF_PUP_SIT_LOOK_FORWARD(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_sit_look_forward.jpg
        $tmp_filename = 'j5_wolf_pup_sit_look_forward';
        $tmp_width = 203;
        $tmp_height = 400;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;

        }

    }

    private function J5_WOLF_PUP_SIT_LOOK_LEFT_ISH_SHADOW(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_sit_look_left_ish_shadow.jpg
        $tmp_filename = 'j5_wolf_pup_sit_look_left_ish_shadow';
        $tmp_width = 585;
        $tmp_height = 305;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;

        }

    }

    private function J5_WOLF_PUP_SIT_LOOK_RIGHT(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_sit_look_right.jpg
        $tmp_filename = 'j5_wolf_pup_sit_look_right';
        $tmp_width = 261;
        $tmp_height = 416;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;

        }

    }

    private function J5_WOLF_PUP_SIT_LOOK_RIGHT_LONGSHADOW(){

            # # # # # # # #
            // USE NO EXTENSION.
            //_crnrstn/ui/imgs/jpg/j5_wolf_pup_sit_look_right_longshadow.jpg
            $tmp_filename = 'j5_wolf_pup_sit_look_right_longshadow';
            $tmp_width = 541;
            $tmp_height = 346;
            $tmp_alt_text = 'J5 Wolf Pup';
            $tmp_title_text = 'CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.' :: J5 Wolf Pup';
            $tmp_link = '';
            $tmp_target = '';
            # # # # # # # #
            # # # # # # # #

            switch(self::$image_output_mode){
                case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                    $tmp_str = '';
                    require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                    if(strlen($tmp_link)>0){

                        $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                        return $tmp_str;

                    }else{

                        return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                    }

                    break;
                case CRNRSTN_UI_IMG_BASE64:

                    $tmp_str = '';
                    require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                    //
                    // BASE64
                    return $tmp_str;

                    break;
                case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                    $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                    if(strlen($tmp_link)>0){

                        $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                        return $tmp_str;

                    }else{

                        return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                    }

                    break;
                case CRNRSTN_UI_IMG_JPEG:

                    $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                    //
                    // JPEG
                    return $tmp_str;

                    break;
                case CRNRSTN_UI_IMG_PNG:

                    return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                    break;
                default:

                    // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                    //
                    // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                    $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                    if(strlen($tmp_link)>0){

                        $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                        return $tmp_str;

                    }else{

                        return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                    }

                    break;

            }

        }

    private function J5_WOLF_PUP_SIT_LOOK_RIGHT_SHADOW(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_sit_look_right_shadow.jpg
        $tmp_filename = 'j5_wolf_pup_sit_look_right_shadow';
        $tmp_width = 497;
        $tmp_height = 290;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;

        }

    }

    private function J5_WOLF_PUP_SIT_LOOK_RIGHT_SHORT_SHADOW(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_sit_look_right_shortshadow.jpg
        $tmp_filename = 'j5_wolf_pup_sit_look_right_shortshadow';
        $tmp_width = 387;
        $tmp_height = 443;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;

        }

    }

    private function J5_WOLF_PUP_SIT_LOOK_RIGHT_UP(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_sit_look_right_up.jpg
        $tmp_filename = 'j5_wolf_pup_sit_look_right_up';
        $tmp_width = 207;
        $tmp_height = 413;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

            break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;

        }

    }

    private function J5_WOLF_PUP_SIT_LOOK_RIGHTSHARP_SHADOW(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_sit_look_rightsharp_shadow.jpg
        $tmp_filename = 'j5_wolf_pup_sit_look_rightsharp_shadow';
        $tmp_width = 495;
        $tmp_height = 331;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

                break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;

        }

    }

    private function J5_WOLF_PUP_STAND_LOOK_RIGHT(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_stand_look_right.jpg
        $tmp_filename = 'j5_wolf_pup_stand_look_right';
        $tmp_width = 300;
        $tmp_height = 390;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

                break;

        }

    }

    private function J5_WOLF_PUP_STAND_LOOK_UP(){

            # # # # # # # #
            // USE NO EXTENSION.
            //_crnrstn/ui/imgs/jpg/j5_wolf_pup_stand_look_up.jpg
            $tmp_filename = 'j5_wolf_pup_stand_look_up';
            $tmp_width = 270;
            $tmp_height = 347;
            $tmp_alt_text = 'J5 Wolf Pup';
            $tmp_title_text = 'CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.' :: J5 Wolf Pup';
            $tmp_link = '';
            $tmp_target = '';
            # # # # # # # #
            # # # # # # # #

            switch(self::$image_output_mode){
                case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                    $tmp_str = '';
                    require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                    if(strlen($tmp_link)>0){

                        $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                        return $tmp_str;

                    }else{

                        return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                    }

                    break;
                case CRNRSTN_UI_IMG_BASE64:

                    $tmp_str = '';
                    require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                    //
                    // BASE64
                    return $tmp_str;

                    break;
                case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                    $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                    if(strlen($tmp_link)>0){

                        $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                        return $tmp_str;

                    }else{

                        return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                    }

                    break;
                case CRNRSTN_UI_IMG_JPEG:

                    $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                    //
                    // JPEG
                    return $tmp_str;

                    break;
                case CRNRSTN_UI_IMG_PNG:

                    return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                    break;
                default:

                    // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                    //
                    // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                    $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                    if(strlen($tmp_link)>0){

                        $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                        return $tmp_str;

                    }else{

                        return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                    }

                break;

            }

        }

    private function J5_WOLF_PUP_WALK(){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_walk.jpg
        $tmp_filename = 'j5_wolf_pup_walk';
        $tmp_width = 411;
        $tmp_height = 430;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/jpg/'.$tmp_filename.'.jpg';

                //
                // JPEG
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_PNG:

                return self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

            break;
            default:

                // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                $tmp_str = self::$oCRNRSTN_n->crnrstn_resources_http_path . 'ui/imgs/png/'.$tmp_filename.'.png';

                if(strlen($tmp_link)>0){

                    $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                    return $tmp_str;

                }else{

                    return '<img src="'.$tmp_str.'"  width="'.$tmp_width.'" height="'.$tmp_height.'" alt="'.$tmp_alt_text.'" title="'.$tmp_title_text.'" style="border:0;">';

                }

            break;

        }

    }

    private function return_linked_ui_element($str, $link, $target, $width = '', $height = '', $alt = '', $title = ''){

        $width = $this->html_img_dom_return($width, 'WIDTH');
        $height = $this->html_img_dom_return($height, 'HEIGHT');
        $alt = $this->html_img_dom_return($alt, 'ALT');
        $title = $this->html_img_dom_return($title, 'TITLE');

        $tmp_str = '<img src="'.$str.'" '.$width.' '.$height.' '.$alt.' '.$title.' style="border:0;">';

        if(strlen($target)<1){

            $target = '_self';

        }

        if(strlen($link)>0){

            $tmp_str = '<a href="'.$link.'" target="'.$target.'">'.$tmp_str.'</a>';

            return $tmp_str;

        }else{

            return $tmp_str;

        }

    }

    private function html_img_dom_return($attribute_data, $attribute_type = 'WIDTH'){

        switch($attribute_type){

            case 'WIDTH':
                if($attribute_data != ''){

                    $attribute_data = 'width="'.$attribute_data.'"';

                }else{

                    $attribute_data = '';

                }

            break;
            case 'HEIGHT':

                if($attribute_data != ''){

                    $attribute_data = 'height="'.$attribute_data.'"';

                }else{

                    $attribute_data = '';

                }

            break;
            case 'ALT':

                if($attribute_data != ''){

                    $attribute_data = 'alt="'.$attribute_data.'"';

                }else{

                    $attribute_data = '';

                }

            break;
            case 'TITLE':

                if($attribute_data != ''){

                    $attribute_data = 'title="'.$attribute_data.'"';

                }else{

                    $attribute_data = '';

                }

            break;

        }

        return $attribute_data;

    }

    public function __destruct() {

    }

}