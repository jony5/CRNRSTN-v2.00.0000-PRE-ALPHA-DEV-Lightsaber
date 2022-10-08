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
#  DESCRIPTION :: Soo much HTML. Just wanted to put in some place nice.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#  Ezekiel 1:5a - AND FROM THE MIDST OF IT [FIRE] THERE CAME THE LIKENESS OF FOUR LIVING CREATURES.
#
class crnrstn_system_image_asset_manager {

    protected $oLogger;
    public $oCRNRSTN;

    public $sys_asset_mode;
    protected $system_file_serial;
    private static $method_request_mode;
    private static $request_salt;
    private static $image_output_mode;

    private static $image_filesystem_meta_ARRAY = array();

    public function __construct($oCRNRSTN){

        $this->oCRNRSTN = $oCRNRSTN;

        if($this->oCRNRSTN->is_bit_set(CRNRSTN_ASSET_MODE_PNG)){

            $this->sys_asset_mode = CRNRSTN_UI_IMG_PNG_HTML_WRAPPED;

        }else{

            if($this->oCRNRSTN->is_bit_set(CRNRSTN_ASSET_MODE_JPEG)){

                $this->sys_asset_mode = CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED;

            }else{

                //
                // BASE64
                $this->sys_asset_mode = CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED;

            }

        }

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN);

    }

    public function return_system_image($creative_element_key, $height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL, $image_output_mode = NULL){

        self::$image_output_mode = $image_output_mode;

        switch($creative_element_key){
            case 'STACHE':

                return $this->STACHE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'UI_PAGELOAD_INDICATOR':

                return $this->UI_PAGELOAD_INDICATOR($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'SOCIAL_ARCHIVES':

                return $this->SOCIAL_ARCHIVES($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'SOCIAL_BANDCAMP':

                return $this->SOCIAL_BANDCAMP($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'SOCIAL_BASSDRIVE':

                return $this->SOCIAL_BASSDRIVE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'SOCIAL_BEATPORT':

                return $this->SOCIAL_BEATPORT($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'SOCIAL_DISCOGS':

                return $this->SOCIAL_DISCOGS($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'SOCIAL_FACEBOOK':

                return $this->SOCIAL_FACEBOOK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'SOCIAL_HISTORY':

                return $this->SOCIAL_HISTORY($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'SOCIAL_INSTAGRAM':

                return $this->SOCIAL_INSTAGRAM($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'SOCIAL_JSON':

                return $this->SOCIAL_JSON($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'SOCIAL_LINKEDIN':

                return $this->SOCIAL_LINKEDIN($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'SOCIAL_MIXCLOUD':

                return $this->SOCIAL_MIXCLOUD($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'SOCIAL_PAYPAL':

                return $this->SOCIAL_PAYPAL($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'SOCIAL_ROLLDABEATS':

                return $this->SOCIAL_ROLLDABEATS($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'SOCIAL_SOUNDCLOUD':

                return $this->SOCIAL_SOUNDCLOUD($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'SOCIAL_SPOTIFY':

                return $this->SOCIAL_SPOTIFY($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'SOCIAL_TWITTER':

                return $this->SOCIAL_TWITTER($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'SOCIAL_WWW':

                return $this->SOCIAL_WWW($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'SOCIAL_YOUTUBE':

                return $this->SOCIAL_YOUTUBE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'SOCIAL_SPRITE':

                return $this->SOCIAL_SPRITE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'TRANSPARENT_1X1':

                return $this->TRANSPARENT_1X1($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'PRIMARY_NAV_BLUE00_CLOSE_X':

                return $this->PRIMARY_NAV_BLUE00_CLOSE_X($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'PRIMARY_NAV_BLUE00_CLOSE_X_CLICK':

                return $this->PRIMARY_NAV_BLUE00_CLOSE_X_CLICK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'PRIMARY_NAV_BLUE00_CLOSE_X_HOVER':

                return $this->PRIMARY_NAV_BLUE00_CLOSE_X_HOVER($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'PRIMARY_NAV_BLUE00_CLOSE_X_INACTIVE':

                return $this->PRIMARY_NAV_BLUE00_CLOSE_X_INACTIVE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND':

                return $this->PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_CLICK':

                return $this->PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_CLICK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_HOVER':

                return $this->PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_HOVER($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_INACTIVE':

                return $this->PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_INACTIVE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'PRIMARY_NAV_BLUE00_MENU':

                return $this->PRIMARY_NAV_BLUE00_MENU($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'PRIMARY_NAV_BLUE00_MENU_CLICK':

                return $this->PRIMARY_NAV_BLUE00_MENU_CLICK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'PRIMARY_NAV_BLUE00_MENU_HOVER':

                return $this->PRIMARY_NAV_BLUE00_MENU_HOVER($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'PRIMARY_NAV_BLUE00_MENU_INACTIVE':

                return $this->PRIMARY_NAV_BLUE00_MENU_INACTIVE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'PRIMARY_NAV_BLUE00_MINIMIZE':

                return $this->PRIMARY_NAV_BLUE00_MINIMIZE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'PRIMARY_NAV_BLUE00_MINIMIZE_CLICK':

                return $this->PRIMARY_NAV_BLUE00_MINIMIZE_CLICK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'PRIMARY_NAV_BLUE00_MINIMIZE_HOVER':

                return $this->PRIMARY_NAV_BLUE00_MINIMIZE_HOVER($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'PRIMARY_NAV_BLUE00_MINIMIZE_INACTIVE':

                return $this->PRIMARY_NAV_BLUE00_MINIMIZE_INACTIVE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'PRIMARY_NAV_BLUE00_MINIMIZE_FIVEDEV':

                return $this->PRIMARY_NAV_BLUE00_MINIMIZE_FIVEDEV($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'PRIMARY_NAV_BLUE00_MINIMIZE_FIVEDEV_SMALL':

                return $this->PRIMARY_NAV_BLUE00_MINIMIZE_FIVEDEV_SMALL($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'MESSAGE_CONVERSATION_BUBBLE_MICRO_THUMB_BLUE00':

                return $this->MESSAGE_CONVERSATION_BUBBLE_MICRO_THUMB_BLUE00($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'MESSAGE_CONVERSATION_BUBBLE':

                return $this->MESSAGE_CONVERSATION_BUBBLE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case '5':

                return $this->FIVE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_RAND':

                $tmp_img_out = $this->J5_WOLF_PUP_RAND($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                return $tmp_img_out;

            break;
            case 'CRNRSTN_LOGO':

                return $this->CRNRSTN_LOGO($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'CRNRSTN_R_LG':

                return $this->CRNRSTN_R_LG($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'CRNRSTN_R':
            case 'CRNRSTN_R_MD':

                return $this->CRNRSTN_R_MD($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'CRNRSTN_R_SM':

                return $this->CRNRSTN_R_SM($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'CRNRSTN_R_WALL':

                return $this->R_PLUS_WALL($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'SUCCESS_CHECK':

                return $this->SUCCESS_CHECK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'ERR_X':

                return $this->ERR_X($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'CRNRSTN_FAVICON':

                return $this->CRNRSTN_FAVICON();

            break;
            case 'LINUX_PENGUIN':

                return $this->LINUX_PENGUIN($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'MYSQL_DOLPHIN':

                return $this->MYSQL_DOLPHIN($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'APACHE_FEATHER':

                return $this->APACHE_FEATHER($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'APACHE_POWER_VERSION':

                return $this->APACHE_POWER_VERSION($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'APACHE_POWER_2_4':

                return $this->APACHE_POWER_2_4($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'APACHE_POWER_2_2':

                return $this->APACHE_POWER_2_2($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'APACHE_POWER_2_0':

                return $this->APACHE_POWER_2_0($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'APACHE_POWER_1_3':

                return $this->APACHE_POWER_1_3($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'APACHE_POWER':

                return $this->APACHE_POWER($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'REDHAT_HAT_LOGO':

                return $this->REDHAT_HAT_LOGO($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'REDHAT_LOGO':

                return $this->REDHAT_LOGO($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'PHP_ELLIPSE':

                return $this->PHP_ELLIPSE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'POW_BY_PHP':

                return $this->POW_BY_PHP($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'ZEND_LOGO':

                return $this->ZEND_LOGO($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'ZEND_FRAMEWORK_3':

                return $this->ZEND_FRAMEWORK_3($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'ZEND_FRAMEWORK':

                return $this->ZEND_FRAMEWORK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'BG_ELEMENT_RESPONSE_CODE':

                return $this->BG_SHADOW_RESPONSE_CODE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'BG_ELEMENT_REFLECTION_SIGNIN':

                return $this->BG_ELEMENT_REFLECTION_SIGNIN($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'DOT_GREEN':

                return $this->DOT_GREEN($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'DOT_RED':

                return $this->DOT_RED($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'DOT_OFF':

                return $this->DOT_OFF($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'NOTICE_TRI_ALERT':

                return $this->NOTICE_TRI_ALERT($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'SEARCH_MAGNIFY_GLASS':

                return $this->SEARCH_MAGNIFY_GLASS($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'ICON_EMAIL_INBOX_REFLECT':

                return $this->ICON_EMAIL_INBOX_REFLECT($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP':

                return $this->J5_WOLF_PUP($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_LAY_00':

                return $this->J5_WOLF_PUP_LAY_00($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_LAY_01':

                return $this->J5_WOLF_PUP_LAY_01($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_LAY_02':

                return $this->J5_WOLF_PUP_LAY_02($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_LAY_LOOK_AWAY':

                return $this->J5_WOLF_PUP_LAY_LOOK_AWAY($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_LAY_LOOK_FORWARD':

                return $this->J5_WOLF_PUP_LAY_LOOK_FORWARD($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_LAY_LOOK_FORWARD_LEASH':

                return $this->J5_WOLF_PUP_LAY_LOOK_FORWARD_LEASH($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_LEASH_EYES_CLOSED':

                return $this->J5_WOLF_PUP_LEASH_EYES_CLOSED($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_LIL_5_PTS':

                return $this->J5_WOLF_PUP_LIL_5_PTS($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_SIT_EYES_CLOSED':

                return $this->J5_WOLF_PUP_SIT_EYES_CLOSED($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_FORWARD':

                return $this->J5_WOLF_PUP_SIT_LOOK_FORWARD($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_LEFT_ISH_SHADOW':

                return $this->J5_WOLF_PUP_SIT_LOOK_LEFT_ISH_SHADOW($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_RIGHT':

                return $this->J5_WOLF_PUP_SIT_LOOK_RIGHT($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_RIGHT_LONGSHADOW':

                return $this->J5_WOLF_PUP_SIT_LOOK_RIGHT_LONGSHADOW($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_RIGHT_SHADOW':

                return $this->J5_WOLF_PUP_SIT_LOOK_RIGHT_SHADOW($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_RIGHT_SHORT_SHADOW':

                return $this->J5_WOLF_PUP_SIT_LOOK_RIGHT_SHORT_SHADOW($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_RIGHT_UP':

                return $this->J5_WOLF_PUP_SIT_LOOK_RIGHT_UP($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_RIGHTSHARP_SHADOW':

                return $this->J5_WOLF_PUP_SIT_LOOK_RIGHTSHARP_SHADOW($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_STAND_LOOK_RIGHT':

                return $this->J5_WOLF_PUP_STAND_LOOK_RIGHT($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_STAND_LOOK_UP':

                return $this->J5_WOLF_PUP_STAND_LOOK_UP($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_WALK':

                return $this->J5_WOLF_PUP_WALK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;

        }
        
    }

    public function return_creative($creative_element_key, $image_output_mode = NULL, $creative_mode = NULL){

        $height_override = $link_override = $alt_override = $title_override = $target_override = $width_override = NULL;

        if(!isset($image_output_mode)){

            //
            // INITIALIZE WITH SYSTEM CONFIGURATION VALUE
            if(!isset(self::$image_output_mode) || self::$image_output_mode == CRNRSTN_SETTINGS_CRNRSTN){

                self::$image_output_mode = $this->sys_asset_mode;

            }

            if(self::$image_output_mode == CRNRSTN_SETTINGS_CRNRSTN){

                self::$image_output_mode = $this->sys_asset_mode;

            }

        }else{

            // BLIND OVERRIDE
            self::$image_output_mode = $image_output_mode;

        }

        //
        // USE THIS TO SUPPORT WHITE LABELING
        if(isset($creative_mode)){

            $tmp_sys_notices_creative_mode = $creative_mode;

        }else{

            $tmp_sys_notices_creative_mode = $this->oCRNRSTN->sys_notices_creative_mode;

        }

        //
        // LAST USE :: Saturday August 6, 2022 @ 1805 hrs
        // LAST USE :: Wednesday August 26, 2022 @ 0516 hrs
        //error_log(__LINE__ . ' img ' . __METHOD__ . ' $creative_element_key=[' . $creative_element_key . '] $tmp_sys_notices_creative_mode=[' . $tmp_sys_notices_creative_mode . '] self::$image_output_mode=[' . self::$image_output_mode . ']');

        //
        // ALL_IMAGE, ALL_HTML, ALL_IMAGE_LOGO_OFF, ALL_HTML_LOGO_OFF
        switch($tmp_sys_notices_creative_mode){
            case 'ALL_IMAGE':

                //error_log(__LINE__ .' image_output_mode=' . $image_output_mode.' ,creative_element_key=' . $creative_element_key);

                switch($creative_element_key){
                    case 'STACHE':

                        return $this->STACHE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'UI_PAGELOAD_INDICATOR':

                        return $this->UI_PAGELOAD_INDICATOR($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_ARCHIVES':

                        return $this->SOCIAL_ARCHIVES($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_BANDCAMP':

                        return $this->SOCIAL_BANDCAMP($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_BASSDRIVE':

                        return $this->SOCIAL_BASSDRIVE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_BEATPORT':

                        return $this->SOCIAL_BEATPORT($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_DISCOGS':

                        return $this->SOCIAL_DISCOGS($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_FACEBOOK':

                        return $this->SOCIAL_FACEBOOK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_HISTORY':

                        return $this->SOCIAL_HISTORY($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_INSTAGRAM':

                        return $this->SOCIAL_INSTAGRAM($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_JSON':

                        return $this->SOCIAL_JSON($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_LINKEDIN':

                        return $this->SOCIAL_LINKEDIN($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_MIXCLOUD':

                        return $this->SOCIAL_MIXCLOUD($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_PAYPAL':

                        return $this->SOCIAL_PAYPAL($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_ROLLDABEATS':

                        return $this->SOCIAL_ROLLDABEATS($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_SOUNDCLOUD':

                        return $this->SOCIAL_SOUNDCLOUD($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_SPOTIFY':

                        return $this->SOCIAL_SPOTIFY($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_TWITTER':

                        return $this->SOCIAL_TWITTER($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_WWW':

                        return $this->SOCIAL_WWW($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_YOUTUBE':

                        return $this->SOCIAL_YOUTUBE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_SPRITE':

                        return $this->SOCIAL_SPRITE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'TRANSPARENT_1X1':

                        return $this->TRANSPARENT_1X1($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_CLOSE_X':

                        return $this->PRIMARY_NAV_BLUE00_CLOSE_X($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_CLOSE_X_CLICK':

                        return $this->PRIMARY_NAV_BLUE00_CLOSE_X_CLICK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_CLOSE_X_HOVER':

                        return $this->PRIMARY_NAV_BLUE00_CLOSE_X_HOVER($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_CLOSE_X_INACTIVE':

                        return $this->PRIMARY_NAV_BLUE00_CLOSE_X_INACTIVE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND':

                        return $this->PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_CLICK':

                        return $this->PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_CLICK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_HOVER':

                        return $this->PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_HOVER($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_INACTIVE':

                        return $this->PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_INACTIVE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MENU':

                        return $this->PRIMARY_NAV_BLUE00_MENU($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MENU_CLICK':

                        return $this->PRIMARY_NAV_BLUE00_MENU_CLICK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MENU_HOVER':

                        return $this->PRIMARY_NAV_BLUE00_MENU_HOVER($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MENU_INACTIVE':

                        return $this->PRIMARY_NAV_BLUE00_MENU_INACTIVE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MINIMIZE':

                        return $this->PRIMARY_NAV_BLUE00_MINIMIZE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MINIMIZE_CLICK':

                        return $this->PRIMARY_NAV_BLUE00_MINIMIZE_CLICK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MINIMIZE_HOVER':

                        return $this->PRIMARY_NAV_BLUE00_MINIMIZE_HOVER($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MINIMIZE_INACTIVE':

                        return $this->PRIMARY_NAV_BLUE00_MINIMIZE_INACTIVE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MINIMIZE_FIVEDEV':

                        return $this->PRIMARY_NAV_BLUE00_MINIMIZE_FIVEDEV($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MINIMIZE_FIVEDEV_SMALL':

                        return $this->PRIMARY_NAV_BLUE00_MINIMIZE_FIVEDEV_SMALL($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'MESSAGE_CONVERSATION_BUBBLE_MICRO_THUMB_BLUE00':

                        return $this->MESSAGE_CONVERSATION_BUBBLE_MICRO_THUMB_BLUE00($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'MESSAGE_CONVERSATION_BUBBLE':

                        return $this->MESSAGE_CONVERSATION_BUBBLE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case '5':

                        return $this->FIVE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'J5_WOLF_PUP_RAND':

                        $tmp_img_out = $this->J5_WOLF_PUP_RAND($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                        return $tmp_img_out;

                    break;
                    case 'CRNRSTN_LOGO':

                        return $this->CRNRSTN_LOGO($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'CRNRSTN_R_LG':

                        return $this->CRNRSTN_R_LG($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'CRNRSTN_R':
                    case 'CRNRSTN_R_MD':

                        return $this->CRNRSTN_R_MD($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'CRNRSTN_R_SM':

                        return $this->CRNRSTN_R_SM($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'CRNRSTN_R_WALL':

                        return $this->R_PLUS_WALL($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SUCCESS_CHECK':

                        return $this->SUCCESS_CHECK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'ERR_X':

                        return $this->ERR_X($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'CRNRSTN_FAVICON':

                        return $this->CRNRSTN_FAVICON();

                    break;
                    case 'LINUX_PENGUIN':

                        return $this->LINUX_PENGUIN($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'MYSQL_DOLPHIN':

                        return $this->MYSQL_DOLPHIN($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'APACHE_FEATHER':

                        return $this->APACHE_FEATHER($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'APACHE_POWER_VERSION':

                        return $this->APACHE_POWER_VERSION($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'APACHE_POWER_2_4':

                        return $this->APACHE_POWER_2_4($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'APACHE_POWER_2_2':

                        return $this->APACHE_POWER_2_2($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'APACHE_POWER_2_0':

                        return $this->APACHE_POWER_2_0($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'APACHE_POWER_1_3':

                        return $this->APACHE_POWER_1_3($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'APACHE_POWER':

                        return $this->APACHE_POWER($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'REDHAT_HAT_LOGO':

                        return $this->REDHAT_HAT_LOGO($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'REDHAT_LOGO':

                        return $this->REDHAT_LOGO($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PHP_ELLIPSE':

                        return $this->PHP_ELLIPSE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'POW_BY_PHP':

                        return $this->POW_BY_PHP($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'ZEND_LOGO':

                        return $this->ZEND_LOGO($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'ZEND_FRAMEWORK_3':

                        return $this->ZEND_FRAMEWORK_3($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'ZEND_FRAMEWORK':

                        return $this->ZEND_FRAMEWORK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'BG_ELEMENT_RESPONSE_CODE':

                        return $this->BG_SHADOW_RESPONSE_CODE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'BG_ELEMENT_REFLECTION_SIGNIN':

                        return $this->BG_ELEMENT_REFLECTION_SIGNIN($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'DOT_GREEN':

                        return $this->DOT_GREEN($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'DOT_RED':

                        return $this->DOT_RED($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'DOT_OFF':

                        return $this->DOT_OFF($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'NOTICE_TRI_ALERT':

                        return $this->NOTICE_TRI_ALERT($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SEARCH_MAGNIFY_GLASS':

                        return $this->SEARCH_MAGNIFY_GLASS($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'ICON_EMAIL_INBOX_REFLECT':

                        return $this->ICON_EMAIL_INBOX_REFLECT($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'J5_WOLF_PUP':

                        return $this->J5_WOLF_PUP($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'J5_WOLF_PUP_LAY_00':

                        return $this->J5_WOLF_PUP_LAY_00($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'J5_WOLF_PUP_LAY_01':

                        return $this->J5_WOLF_PUP_LAY_01($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'J5_WOLF_PUP_LAY_02':

                        return $this->J5_WOLF_PUP_LAY_02($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'J5_WOLF_PUP_LAY_LOOK_AWAY':

                        return $this->J5_WOLF_PUP_LAY_LOOK_AWAY($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'J5_WOLF_PUP_LAY_LOOK_FORWARD':

                        return $this->J5_WOLF_PUP_LAY_LOOK_FORWARD($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'J5_WOLF_PUP_LAY_LOOK_FORWARD_LEASH':

                        return $this->J5_WOLF_PUP_LAY_LOOK_FORWARD_LEASH($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'J5_WOLF_PUP_LEASH_EYES_CLOSED':

                        return $this->J5_WOLF_PUP_LEASH_EYES_CLOSED($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'J5_WOLF_PUP_LIL_5_PTS':

                        return $this->J5_WOLF_PUP_LIL_5_PTS($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'J5_WOLF_PUP_SIT_EYES_CLOSED':

                        return $this->J5_WOLF_PUP_SIT_EYES_CLOSED($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'J5_WOLF_PUP_SIT_LOOK_FORWARD':

                        return $this->J5_WOLF_PUP_SIT_LOOK_FORWARD($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'J5_WOLF_PUP_SIT_LOOK_LEFT_ISH_SHADOW':

                        return $this->J5_WOLF_PUP_SIT_LOOK_LEFT_ISH_SHADOW($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'J5_WOLF_PUP_SIT_LOOK_RIGHT':

                        return $this->J5_WOLF_PUP_SIT_LOOK_RIGHT($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'J5_WOLF_PUP_SIT_LOOK_RIGHT_LONGSHADOW':

                        return $this->J5_WOLF_PUP_SIT_LOOK_RIGHT_LONGSHADOW($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'J5_WOLF_PUP_SIT_LOOK_RIGHT_SHADOW':

                        return $this->J5_WOLF_PUP_SIT_LOOK_RIGHT_SHADOW($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'J5_WOLF_PUP_SIT_LOOK_RIGHT_SHORT_SHADOW':

                        return $this->J5_WOLF_PUP_SIT_LOOK_RIGHT_SHORT_SHADOW($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'J5_WOLF_PUP_SIT_LOOK_RIGHT_UP':

                        return $this->J5_WOLF_PUP_SIT_LOOK_RIGHT_UP($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'J5_WOLF_PUP_SIT_LOOK_RIGHTSHARP_SHADOW':

                        return $this->J5_WOLF_PUP_SIT_LOOK_RIGHTSHARP_SHADOW($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'J5_WOLF_PUP_STAND_LOOK_RIGHT':

                        return $this->J5_WOLF_PUP_STAND_LOOK_RIGHT($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'J5_WOLF_PUP_STAND_LOOK_UP':

                        return $this->J5_WOLF_PUP_STAND_LOOK_UP($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'J5_WOLF_PUP_WALK':

                        return $this->J5_WOLF_PUP_WALK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;

                }

            break;
            case 'ALL_IMAGE_LOGO_OFF':

                switch($creative_element_key){
                    case 'STACHE':

                        return $this->STACHE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'UI_PAGELOAD_INDICATOR':

                        return $this->UI_PAGELOAD_INDICATOR($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_ARCHIVES':

                        return $this->SOCIAL_ARCHIVES($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_BANDCAMP':

                        return $this->SOCIAL_BANDCAMP($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_BASSDRIVE':

                        return $this->SOCIAL_BASSDRIVE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_BEATPORT':

                        return $this->SOCIAL_BEATPORT($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_DISCOGS':

                        return $this->SOCIAL_DISCOGS($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_FACEBOOK':

                        return $this->SOCIAL_FACEBOOK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_HISTORY':

                        return $this->SOCIAL_HISTORY($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_INSTAGRAM':

                        return $this->SOCIAL_INSTAGRAM($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_JSON':

                        return $this->SOCIAL_JSON($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_LINKEDIN':

                        return $this->SOCIAL_LINKEDIN($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_MIXCLOUD':

                        return $this->SOCIAL_MIXCLOUD($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_PAYPAL':

                        return $this->SOCIAL_PAYPAL($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_ROLLDABEATS':

                        return $this->SOCIAL_ROLLDABEATS($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_SOUNDCLOUD':

                        return $this->SOCIAL_SOUNDCLOUD($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_SPOTIFY':

                        return $this->SOCIAL_SPOTIFY($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_TWITTER':

                        return $this->SOCIAL_TWITTER($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_WWW':

                        return $this->SOCIAL_WWW($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_YOUTUBE':

                        return $this->SOCIAL_YOUTUBE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_SPRITE':

                        return $this->SOCIAL_SPRITE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'TRANSPARENT_1X1':

                        return $this->TRANSPARENT_1X1($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_CLOSE_X':

                        return $this->PRIMARY_NAV_BLUE00_CLOSE_X($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_CLOSE_X_CLICK':

                        return $this->PRIMARY_NAV_BLUE00_CLOSE_X_CLICK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_CLOSE_X_HOVER':

                        return $this->PRIMARY_NAV_BLUE00_CLOSE_X_HOVER($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_CLOSE_X_INACTIVE':

                        return $this->PRIMARY_NAV_BLUE00_CLOSE_X_INACTIVE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND':

                        return $this->PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_CLICK':

                        return $this->PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_CLICK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_HOVER':

                        return $this->PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_HOVER($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_INACTIVE':

                        return $this->PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_INACTIVE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MENU':

                        return $this->PRIMARY_NAV_BLUE00_MENU($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MENU_CLICK':

                        return $this->PRIMARY_NAV_BLUE00_MENU_CLICK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MENU_HOVER':

                        return $this->PRIMARY_NAV_BLUE00_MENU_HOVER($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MENU_INACTIVE':

                        return $this->PRIMARY_NAV_BLUE00_MENU_INACTIVE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MINIMIZE':

                        return $this->PRIMARY_NAV_BLUE00_MINIMIZE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MINIMIZE_CLICK':

                        return $this->PRIMARY_NAV_BLUE00_MINIMIZE_CLICK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MINIMIZE_HOVER':

                        return $this->PRIMARY_NAV_BLUE00_MINIMIZE_HOVER($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MINIMIZE_INACTIVE':

                        return $this->PRIMARY_NAV_BLUE00_MINIMIZE_INACTIVE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MINIMIZE_FIVEDEV':

                        return $this->PRIMARY_NAV_BLUE00_MINIMIZE_FIVEDEV($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MINIMIZE_FIVEDEV_SMALL':

                        return $this->PRIMARY_NAV_BLUE00_MINIMIZE_FIVEDEV_SMALL($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'MESSAGE_CONVERSATION_BUBBLE_MICRO_THUMB_BLUE00':

                        return $this->MESSAGE_CONVERSATION_BUBBLE_MICRO_THUMB_BLUE00($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'MESSAGE_CONVERSATION_BUBBLE':

                        return $this->MESSAGE_CONVERSATION_BUBBLE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case '5':

                        return $this->FIVE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'J5_WOLF_PUP_RAND':

                        return $this->J5_WOLF_PUP_RAND($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'CRNRSTN_LOGO':

                        return '&nbsp;';

                    break;
                    case 'CRNRSTN_R_LG':

                        return $this->CRNRSTN_R_LG($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'CRNRSTN_R':
                    case 'CRNRSTN_R_MD':

                        return $this->CRNRSTN_R_MD($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'CRNRSTN_R_SM':

                        return $this->CRNRSTN_R_SM($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'CRNRSTN_R_WALL':

                        return $this->R_PLUS_WALL($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SUCCESS_CHECK':

                        return $this->SUCCESS_CHECK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'ERR_X':

                        return $this->ERR_X($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'CRNRSTN_FAVICON':

                        return $this->CRNRSTN_FAVICON($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'LINUX_PENGUIN':

                        return $this->LINUX_PENGUIN($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'MYSQL_DOLPHIN':

                        return $this->MYSQL_DOLPHIN($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'APACHE_FEATHER':

                        return $this->APACHE_FEATHER($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'APACHE_POWER_VERS':

                        return $this->APACHE_POWER_VERSION($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'APACHE_POWER':

                        return $this->APACHE_POWER($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'REDHAT_HAT_LOGO':

                        return $this->REDHAT_HAT_LOGO($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'REDHAT_LOGO':

                        return $this->REDHAT_LOGO($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PHP_ELLIPSE':

                        return $this->PHP_ELLIPSE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'POW_BY_PHP':

                        return $this->POW_BY_PHP($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'ZEND_LOGO':

                        return $this->ZEND_LOGO($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'ZEND_FRAMEWORK_3':

                        return $this->ZEND_FRAMEWORK_3($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'ZEND_FRAMEWORK':

                        return $this->ZEND_FRAMEWORK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'BG_ELEMENT_RESPONSE_CODE':

                        return $this->BG_SHADOW_RESPONSE_CODE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'BG_ELEMENT_REFLECTION_SIGNIN':

                        return $this->BG_ELEMENT_REFLECTION_SIGNIN($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'DOT_GREEN':

                        return $this->DOT_GREEN($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'DOT_RED':

                        return $this->DOT_RED($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'DOT_OFF':

                        return $this->DOT_OFF($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'NOTICE_TRI_ALERT':

                        return $this->NOTICE_TRI_ALERT($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'ICON_EMAIL_INBOX_REFLECT':

                        return $this->ICON_EMAIL_INBOX_REFLECT($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SEARCH_MAGNIFY_GLASS':

                        return $this->SEARCH_MAGNIFY_GLASS($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;


                }

            break;
            case 'ALL_HTML_LOGO_OFF':

                switch($creative_element_key){
                    case 'STACHE':

                        return $this->STACHE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'UI_PAGELOAD_INDICATOR':

                        return $this->UI_PAGELOAD_INDICATOR($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_ARCHIVES':

                        return $this->SOCIAL_ARCHIVES($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_BANDCAMP':

                        return $this->SOCIAL_BANDCAMP($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_BASSDRIVE':

                        return $this->SOCIAL_BASSDRIVE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_BEATPORT':

                        return $this->SOCIAL_BEATPORT($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_DISCOGS':

                        return $this->SOCIAL_DISCOGS($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_FACEBOOK':

                        return $this->SOCIAL_FACEBOOK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_HISTORY':

                        return $this->SOCIAL_HISTORY($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_INSTAGRAM':

                        return $this->SOCIAL_INSTAGRAM($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_JSON':

                        return $this->SOCIAL_JSON($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_LINKEDIN':

                        return $this->SOCIAL_LINKEDIN($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_MIXCLOUD':

                        return $this->SOCIAL_MIXCLOUD($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_PAYPAL':

                        return $this->SOCIAL_PAYPAL($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_ROLLDABEATS':

                        return $this->SOCIAL_ROLLDABEATS($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_SOUNDCLOUD':

                        return $this->SOCIAL_SOUNDCLOUD($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_SPOTIFY':

                        return $this->SOCIAL_SPOTIFY($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_TWITTER':

                        return $this->SOCIAL_TWITTER($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_WWW':

                        return $this->SOCIAL_WWW($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_YOUTUBE':

                        return $this->SOCIAL_YOUTUBE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_SPRITE':

                        return $this->SOCIAL_SPRITE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'TRANSPARENT_1X1':

                        return $this->TRANSPARENT_1X1($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_CLOSE_X':

                        return $this->PRIMARY_NAV_BLUE00_CLOSE_X($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_CLOSE_X_CLICK':

                        return $this->PRIMARY_NAV_BLUE00_CLOSE_X_CLICK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_CLOSE_X_HOVER':

                        return $this->PRIMARY_NAV_BLUE00_CLOSE_X_HOVER($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_CLOSE_X_INACTIVE':

                        return $this->PRIMARY_NAV_BLUE00_CLOSE_X_INACTIVE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND':

                        return $this->PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_CLICK':

                        return $this->PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_CLICK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_HOVER':

                        return $this->PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_HOVER($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_INACTIVE':

                        return $this->PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_INACTIVE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MENU':

                        return $this->PRIMARY_NAV_BLUE00_MENU($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MENU_CLICK':

                        return $this->PRIMARY_NAV_BLUE00_MENU_CLICK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MENU_HOVER':

                        return $this->PRIMARY_NAV_BLUE00_MENU_HOVER($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MENU_INACTIVE':

                        return $this->PRIMARY_NAV_BLUE00_MENU_INACTIVE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MINIMIZE':

                        return $this->PRIMARY_NAV_BLUE00_MINIMIZE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MINIMIZE_CLICK':

                        return $this->PRIMARY_NAV_BLUE00_MINIMIZE_CLICK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MINIMIZE_HOVER':

                        return $this->PRIMARY_NAV_BLUE00_MINIMIZE_HOVER($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MINIMIZE_INACTIVE':

                        return $this->PRIMARY_NAV_BLUE00_MINIMIZE_INACTIVE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MINIMIZE_FIVEDEV':

                        return $this->PRIMARY_NAV_BLUE00_MINIMIZE_FIVEDEV($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MINIMIZE_FIVEDEV_SMALL':

                        return $this->PRIMARY_NAV_BLUE00_MINIMIZE_FIVEDEV_SMALL($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'MESSAGE_CONVERSATION_BUBBLE_MICRO_THUMB_BLUE00':

                        return $this->MESSAGE_CONVERSATION_BUBBLE_MICRO_THUMB_BLUE00($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'MESSAGE_CONVERSATION_BUBBLE':

                        return $this->MESSAGE_CONVERSATION_BUBBLE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case '5':

                        return $this->FIVE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'J5_WOLF_PUP_RAND':

                        return $this->J5_WOLF_PUP_RAND($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'CRNRSTN_LOGO':

                        return '&nbsp;';

                    break;
                    case 'CRNRSTN_R_LG':

                        return $this->CRNRSTN_R_LG($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'CRNRSTN_R':
                    case 'CRNRSTN_R_MD':

                        return $this->CRNRSTN_R_MD($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'CRNRSTN_R_SM':

                        return $this->CRNRSTN_R_SM($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'CRNRSTN_R_WALL':

                        return $this->R_PLUS_WALL($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SUCCESS_CHECK':

                        return $this->SUCCESS_CHECK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'ERR_X':

                        return $this->ERR_X($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'LINUX_PENGUIN':

                        return $this->LINUX_PENGUIN($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'MYSQL_DOLPHIN':

                        return $this->MYSQL_DOLPHIN($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'APACHE_FEATHER':

                        return $this->APACHE_FEATHER($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'APACHE_POWER_VERS':

                        return $this->APACHE_POWER_VERSION($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'APACHE_POWER':

                        return $this->APACHE_POWER($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'REDHAT_HAT_LOGO':

                        return $this->REDHAT_HAT_LOGO($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'REDHAT_LOGO':

                        return $this->REDHAT_LOGO($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PHP_ELLIPSE':

                        return $this->PHP_ELLIPSE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'POW_BY_PHP':

                        return $this->POW_BY_PHP($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'ZEND_LOGO':

                        return $this->ZEND_LOGO($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'ZEND_FRAMEWORK_3':

                        return $this->ZEND_FRAMEWORK_3($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'ZEND_FRAMEWORK':

                        return $this->ZEND_FRAMEWORK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'BG_ELEMENT_REFLECTION_SIGNIN':

                        return $this->BG_ELEMENT_REFLECTION_SIGNIN($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'DOT_GREEN':

                        return $this->DOT_GREEN($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'DOT_RED':

                        return $this->DOT_RED($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'DOT_OFF':

                        return $this->DOT_OFF($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'NOTICE_TRI_ALERT':

                        return $this->NOTICE_TRI_ALERT($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'ICON_EMAIL_INBOX_REFLECT':

                        return $this->ICON_EMAIL_INBOX_REFLECT($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SEARCH_MAGNIFY_GLASS':

                        return $this->SEARCH_MAGNIFY_GLASS($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;

                }

            break;
            case 'SOAP_TUNNEL':

                return '{' . $creative_element_key . '::SOAP_TUNNEL}';

            break;
            default:
                // case 'ALL_HTML':
                switch($creative_element_key){
                    case 'STACHE':

                        return $this->STACHE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'UI_PAGELOAD_INDICATOR':

                        return $this->UI_PAGELOAD_INDICATOR($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_ARCHIVES':

                        return $this->SOCIAL_ARCHIVES($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_BANDCAMP':

                        return $this->SOCIAL_BANDCAMP($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_BASSDRIVE':

                        return $this->SOCIAL_BASSDRIVE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_BEATPORT':

                        return $this->SOCIAL_BEATPORT($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_DISCOGS':

                        return $this->SOCIAL_DISCOGS($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_FACEBOOK':

                        return $this->SOCIAL_FACEBOOK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_HISTORY':

                        return $this->SOCIAL_HISTORY($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_INSTAGRAM':

                        return $this->SOCIAL_INSTAGRAM($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_JSON':

                        return $this->SOCIAL_JSON($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_LINKEDIN':

                        return $this->SOCIAL_LINKEDIN($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_MIXCLOUD':

                        return $this->SOCIAL_MIXCLOUD($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_PAYPAL':

                        return $this->SOCIAL_PAYPAL($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_ROLLDABEATS':

                        return $this->SOCIAL_ROLLDABEATS($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_SOUNDCLOUD':

                        return $this->SOCIAL_SOUNDCLOUD($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_SPOTIFY':

                        return $this->SOCIAL_SPOTIFY($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_TWITTER':

                        return $this->SOCIAL_TWITTER($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_WWW':

                        return $this->SOCIAL_WWW($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_YOUTUBE':

                        return $this->SOCIAL_YOUTUBE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SOCIAL_SPRITE':

                        return $this->SOCIAL_SPRITE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'TRANSPARENT_1X1':

                        return $this->TRANSPARENT_1X1($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_CLOSE_X':

                        return $this->PRIMARY_NAV_BLUE00_CLOSE_X($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_CLOSE_X_CLICK':

                        return $this->PRIMARY_NAV_BLUE00_CLOSE_X_CLICK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_CLOSE_X_HOVER':

                        return $this->PRIMARY_NAV_BLUE00_CLOSE_X_HOVER($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_CLOSE_X_INACTIVE':

                        return $this->PRIMARY_NAV_BLUE00_CLOSE_X_INACTIVE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND':

                        return $this->PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_CLICK':

                        return $this->PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_CLICK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_HOVER':

                        return $this->PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_HOVER($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_INACTIVE':

                        return $this->PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_INACTIVE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MENU':

                        return $this->PRIMARY_NAV_BLUE00_MENU($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MENU_CLICK':

                        return $this->PRIMARY_NAV_BLUE00_MENU_CLICK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MENU_HOVER':

                        return $this->PRIMARY_NAV_BLUE00_MENU_HOVER($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MENU_INACTIVE':

                        return $this->PRIMARY_NAV_BLUE00_MENU_INACTIVE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MINIMIZE':

                        return $this->PRIMARY_NAV_BLUE00_MINIMIZE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MINIMIZE_CLICK':

                        return $this->PRIMARY_NAV_BLUE00_MINIMIZE_CLICK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MINIMIZE_HOVER':

                        return $this->PRIMARY_NAV_BLUE00_MINIMIZE_HOVER($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MINIMIZE_INACTIVE':

                        return $this->PRIMARY_NAV_BLUE00_MINIMIZE_INACTIVE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MINIMIZE_FIVEDEV':

                        return $this->PRIMARY_NAV_BLUE00_MINIMIZE_FIVEDEV($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PRIMARY_NAV_BLUE00_MINIMIZE_FIVEDEV_SMALL':

                        return $this->PRIMARY_NAV_BLUE00_MINIMIZE_FIVEDEV_SMALL($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'MESSAGE_CONVERSATION_BUBBLE_MICRO_THUMB_BLUE00':

                        return $this->MESSAGE_CONVERSATION_BUBBLE_MICRO_THUMB_BLUE00($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'MESSAGE_CONVERSATION_BUBBLE':

                        return $this->MESSAGE_CONVERSATION_BUBBLE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case '5':

                        return $this->FIVE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'J5_WOLF_PUP_RAND':

                        return $this->J5_WOLF_PUP_RAND($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'CRNRSTN_LOGO':

                        return $this->CRNRSTN_LOGO($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'CRNRSTN_R_LG':

                        return $this->CRNRSTN_R_LG($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'CRNRSTN_R':
                    case 'CRNRSTN_R_MD':

                        return $this->CRNRSTN_R_MD($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'CRNRSTN_R_SM':

                        return $this->CRNRSTN_R_SM($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'CRNRSTN_R_WALL':

                        return $this->R_PLUS_WALL($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SUCCESS_CHECK':

                        return $this->SUCCESS_CHECK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'ERR_X':

                        return $this->ERR_X($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'LINUX_PENGUIN':

                        return $this->LINUX_PENGUIN($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'MYSQL_DOLPHIN':

                        return $this->MYSQL_DOLPHIN($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'APACHE_FEATHER':

                        return $this->APACHE_FEATHER($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'APACHE_POWER_VERS':

                        return $this->APACHE_POWER_VERSION($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'APACHE_POWER':

                        return $this->APACHE_POWER($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'REDHAT_HAT_LOGO':

                        return $this->REDHAT_HAT_LOGO($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'REDHAT_LOGO':

                        return $this->REDHAT_LOGO($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'PHP_ELLIPSE':

                        return $this->PHP_ELLIPSE($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'POW_BY_PHP':

                        return $this->POW_BY_PHP($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'ZEND_LOGO':

                        return $this->ZEND_LOGO($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'ZEND_FRAMEWORK_3':

                        return $this->ZEND_FRAMEWORK_3($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'ZEND_FRAMEWORK':

                        return $this->ZEND_FRAMEWORK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'BG_ELEMENT_REFLECTION_SIGNIN':

                        return $this->BG_ELEMENT_REFLECTION_SIGNIN($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'DOT_GREEN':

                        return $this->DOT_GREEN($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'DOT_RED':

                        return $this->DOT_RED($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'DOT_OFF':

                        return $this->DOT_OFF($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'NOTICE_TRI_ALERT':

                        return $this->NOTICE_TRI_ALERT($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'ICON_EMAIL_INBOX_REFLECT':

                        return $this->ICON_EMAIL_INBOX_REFLECT($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

                    break;
                    case 'SEARCH_MAGNIFY_GLASS':

                        return $this->SEARCH_MAGNIFY_GLASS($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

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

                return '<link rel="shortcut icon" type="image/x-icon" href="' . $this->oCRNRSTN->crnrstn_resources_http_path() . 'ui/imgs/favicon.ico?v=420.00" />';

            break;
            default:

                //
                // BASE64
                return $this->oCRNRSTN->crnrstn_resources_http_path() . 'ui/imgs/favicon.ico';

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

                return '<link rel="shortcut icon" type="image/x-icon" href="' . $this->oCRNRSTN->crnrstn_resources_http_path() . 'ui/imgs/' . $tmp_filename . '.ico?v=420.00" />';

            break;

        }

    }

    private function STACHE($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/png/stache.png
        $tmp_filename = 'stache';
        $tmp_width = 93;
        $tmp_height = 30;
        $tmp_alt_text = 'stache';
        $tmp_title_text = 'stache';
        $tmp_link = 'http://jony5.com';
        $tmp_target = '_blank';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function UI_PAGELOAD_INDICATOR($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/png/element_page_load_indicator.png
        $tmp_filename = 'element_page_load_indicator';
        $tmp_width = 17;
        $tmp_height = 3000;
        $tmp_alt_text = '';
        $tmp_title_text = '';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function SOCIAL_ARCHIVES($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=social_archives.png
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/social_archives.png
        $tmp_filename = 'social_archives';
        $tmp_width = 119;
        $tmp_height = 77;
        $tmp_alt_text = 'Archives';
        $tmp_title_text = 'Link to Archives.';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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
        
        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function SOCIAL_BANDCAMP($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=social_bandcamp.png
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/social_bandcamp.png
        $tmp_filename = 'social_bandcamp';
        $tmp_width = 76;
        $tmp_height = 77;
        $tmp_alt_text = 'Bandcamp';
        $tmp_title_text = 'Link to Bandcamp music page.';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function SOCIAL_BASSDRIVE($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=social_bassdrive.png
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/social_bassdrive.png
        $tmp_filename = 'social_bassdrive';
        $tmp_width = 95;
        $tmp_height = 78;
        $tmp_alt_text = 'Bassdrive';
        $tmp_title_text = 'Link to Bassdrive profile.';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function SOCIAL_BEATPORT($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=social_beatport.png
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/social_beatport.png
        $tmp_filename = 'social_beatport';
        $tmp_width = 76;
        $tmp_height = 77;
        $tmp_alt_text = 'Beatport';
        $tmp_title_text = 'Link to Beatport featured tracks.';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function SOCIAL_DISCOGS($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=social_discogs.png
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/social_discogs.png
        $tmp_filename = 'social_discogs';
        $tmp_width = 77;
        $tmp_height = 76;
        $tmp_alt_text = 'Discogs';
        $tmp_title_text = 'Link to Discogs music selection.';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function SOCIAL_FACEBOOK($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=social_facebook.png
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/social_facebook.png
        $tmp_filename = 'social_facebook';
        $tmp_width = 77;
        $tmp_height = 76;
        $tmp_alt_text = 'Facebook';
        $tmp_title_text = 'Link to Facebook page.';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function SOCIAL_HISTORY($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=social_history.png
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/social_history.png
        $tmp_filename = 'social_history';
        $tmp_width = 110;
        $tmp_height = 76;
        $tmp_alt_text = 'History';
        $tmp_title_text = 'Link to history.';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function SOCIAL_INSTAGRAM($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=social_instagram.png
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/social_instagram.png
        $tmp_filename = 'social_instagram';
        $tmp_width = 77;
        $tmp_height = 77;
        $tmp_alt_text = 'Instagram';
        $tmp_title_text = 'Link to Instagram feed.';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function SOCIAL_JSON($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=social_json.png
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/social_json.png
        $tmp_filename = 'social_json';
        $tmp_width = 72;
        $tmp_height = 81;
        $tmp_alt_text = 'JSON';
        $tmp_title_text = 'Link to JSON.';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function SOCIAL_LINKEDIN($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=social_linkedin.png
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/social_linkedin.png
        $tmp_filename = 'social_linkedin';
        $tmp_width = 76;
        $tmp_height = 76;
        $tmp_alt_text = 'LinkedIn';
        $tmp_title_text = 'Link to LinkedIn profile.';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function SOCIAL_MIXCLOUD($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=social_mixcloud.png
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/social_mixcloud.png
        $tmp_filename = 'social_mixcloud';
        $tmp_width = 74;
        $tmp_height = 74;
        $tmp_alt_text = 'Mixcloud';
        $tmp_title_text = 'Link to Mixcloud community.';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function SOCIAL_PAYPAL($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=social_paypal.png
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/social_paypal.png
        $tmp_filename = 'social_paypal';
        $tmp_width = 77;
        $tmp_height = 76;
        $tmp_alt_text = 'Paypal';
        $tmp_title_text = 'Link to Paypal.';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function SOCIAL_ROLLDABEATS($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=social_rolldabeats.png
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/social_rolldabeats.png
        $tmp_filename = 'social_rolldabeats';
        $tmp_width = 76;
        $tmp_height = 76;
        $tmp_alt_text = 'RollDaBeats';
        $tmp_title_text = 'Link to RollDaBeats catalog.';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function SOCIAL_SOUNDCLOUD($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=social_soundcloud.png
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/social_soundcloud.png
        $tmp_filename = 'social_soundcloud';
        $tmp_width = 75;
        $tmp_height = 77;
        $tmp_alt_text = 'SoundCloud';
        $tmp_title_text = 'Link to SoundCloud tracks.';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function SOCIAL_SPOTIFY($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=social_spotify.png
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/social_spotify.png
        $tmp_filename = 'social_spotify';
        $tmp_width = 77;
        $tmp_height = 77;
        $tmp_alt_text = 'Spotify';
        $tmp_title_text = 'Link to Spotify community.';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function SOCIAL_TWITTER($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=social_twitter.png
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/social_twitter.png
        $tmp_filename = 'social_twitter';
        $tmp_width = 77;
        $tmp_height = 76;
        $tmp_alt_text = 'Twitter';
        $tmp_title_text = 'Link to Twitter feed.';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function SOCIAL_WWW($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=social_www.png
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/social_www.png
        $tmp_filename = 'social_www';
        $tmp_width = 79;
        $tmp_height = 79;
        $tmp_alt_text = 'Website';
        $tmp_title_text = 'Link to website.';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function SOCIAL_YOUTUBE($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=social_youtube.png
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/social_youtube.png
        $tmp_filename = 'social_youtube';
        $tmp_width = 77;
        $tmp_height = 76;
        $tmp_alt_text = 'YouTube';
        $tmp_title_text = 'Link to YouTube channel.';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function SOCIAL_SPRITE($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=social_sprite.png
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/social_sprite.png
        $tmp_filename = 'social_sprite';
        $tmp_width = 700;
        $tmp_height = 440;
        $tmp_alt_text = 'Social media link';
        $tmp_title_text = 'Social media link';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function TRANSPARENT_1X1($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=x.png
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/x.jpg
        $tmp_filename = 'x';
        $tmp_width = 1;
        $tmp_height = 1;
        $tmp_alt_text = 'x';
        $tmp_title_text = 'x';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function PRIMARY_NAV_BLUE00_CLOSE_X($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=primary_nav_seriesblue00_120x120_close_x.png
        // USE NO EXTENSION.
        $tmp_filename = 'primary_nav_seriesblue00_120x120_close_x';
        $tmp_width = 40;
        $tmp_height = 40;
        $tmp_alt_text = 'Close';
        $tmp_title_text = 'Navigation to Close';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function PRIMARY_NAV_BLUE00_CLOSE_X_CLICK($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=primary_nav_seriesblue00_120x120_close_x_click.png
        // USE NO EXTENSION.
        $tmp_filename = 'primary_nav_seriesblue00_120x120_close_x_click';
        $tmp_width = 40;
        $tmp_height = 40;
        $tmp_alt_text = 'Close';
        $tmp_title_text = 'Navigation to Close';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function PRIMARY_NAV_BLUE00_CLOSE_X_HOVER($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=primary_nav_seriesblue00_120x120_close_x_hvr.png
        // USE NO EXTENSION.
        $tmp_filename = 'primary_nav_seriesblue00_120x120_close_x_hvr';
        $tmp_width = 40;
        $tmp_height = 40;
        $tmp_alt_text = 'Close';
        $tmp_title_text = 'Navigation to Close';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function PRIMARY_NAV_BLUE00_CLOSE_X_INACTIVE($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=primary_nav_seriesblue00_120x120_close_x_inactive.png
        // USE NO EXTENSION.
        $tmp_filename = 'primary_nav_seriesblue00_120x120_close_x_inactive';
        $tmp_width = 40;
        $tmp_height = 40;
        $tmp_alt_text = 'Close';
        $tmp_title_text = 'Navigation to Close';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=primary_nav_seriesblue00_120x120_fs_expand.png
        // USE NO EXTENSION.
        $tmp_filename = 'primary_nav_seriesblue00_120x120_fs_expand';
        $tmp_width = 40;
        $tmp_height = 40;
        $tmp_alt_text = 'Full Screen';
        $tmp_title_text = 'Navigation to Full Screen';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_CLICK($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=primary_nav_seriesblue00_120x120_fs_expand_click.png
        // USE NO EXTENSION.
        $tmp_filename = 'primary_nav_seriesblue00_120x120_fs_expand_click';
        $tmp_width = 40;
        $tmp_height = 40;
        $tmp_alt_text = 'Full Screen';
        $tmp_title_text = 'Navigation to Full Screen';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_HOVER($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=primary_nav_seriesblue00_120x120_fs_expand_hvr.png
        // USE NO EXTENSION.
        $tmp_filename = 'primary_nav_seriesblue00_120x120_fs_expand_hvr';
        $tmp_width = 40;
        $tmp_height = 40;
        $tmp_alt_text = 'Full Screen';
        $tmp_title_text = 'Navigation to Full Screen';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_INACTIVE($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=primary_nav_seriesblue00_120x120_fs_expand_inactive.png
        // USE NO EXTENSION.
        $tmp_filename = 'primary_nav_seriesblue00_120x120_fs_expand_inactive';
        $tmp_width = 40;
        $tmp_height = 40;
        $tmp_alt_text = 'Full Screen';
        $tmp_title_text = 'Navigation to Full Screen';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function PRIMARY_NAV_BLUE00_MENU($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=primary_nav_seriesblue00_120x120_menu.png
        // USE NO EXTENSION.
        $tmp_filename = 'primary_nav_seriesblue00_120x120_menu';
        $tmp_width = 40;
        $tmp_height = 40;
        $tmp_alt_text = 'Menu';
        $tmp_title_text = 'Navigate to Menu';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function PRIMARY_NAV_BLUE00_MENU_CLICK($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=primary_nav_seriesblue00_120x120_menu_click.png
        // USE NO EXTENSION.
        $tmp_filename = 'primary_nav_seriesblue00_120x120_menu_click';
        $tmp_width = 40;
        $tmp_height = 40;
        $tmp_alt_text = 'Menu';
        $tmp_title_text = 'Navigate to Menu';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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
        
        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function PRIMARY_NAV_BLUE00_MENU_HOVER($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=primary_nav_seriesblue00_120x120_menu_hvr.png
        // USE NO EXTENSION.
        $tmp_filename = 'primary_nav_seriesblue00_120x120_menu_hvr';
        $tmp_width = 40;
        $tmp_height = 40;
        $tmp_alt_text = 'Menu';
        $tmp_title_text = 'Navigate to Menu';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function PRIMARY_NAV_BLUE00_MENU_INACTIVE($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=primary_nav_seriesblue00_120x120_menu_inactive.png
        // USE NO EXTENSION.
        $tmp_filename = 'primary_nav_seriesblue00_120x120_menu_inactive';
        $tmp_width = 40;
        $tmp_height = 40;
        $tmp_alt_text = 'Menu';
        $tmp_title_text = 'Navigate to Menu';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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
        
        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function PRIMARY_NAV_BLUE00_MINIMIZE($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=primary_nav_seriesblue00_120x120_minimize.png
        // USE NO EXTENSION.
        $tmp_filename = 'primary_nav_seriesblue00_120x120_minimize';
        $tmp_width = 40;
        $tmp_height = 40;
        $tmp_alt_text = 'Minimize';
        $tmp_title_text = 'Navigate to Minimize';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function PRIMARY_NAV_BLUE00_MINIMIZE_CLICK($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=primary_nav_seriesblue00_120x120_minimize_click.png
        // USE NO EXTENSION.
        $tmp_filename = 'primary_nav_seriesblue00_120x120_minimize_click';
        $tmp_width = 40;
        $tmp_height = 40;
        $tmp_alt_text = 'Minimize';
        $tmp_title_text = 'Navigate to Minimize';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function PRIMARY_NAV_BLUE00_MINIMIZE_HOVER($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=primary_nav_seriesblue00_120x120_minimize_hvr.png
        // USE NO EXTENSION.
        $tmp_filename = 'primary_nav_seriesblue00_120x120_minimize_hvr';
        $tmp_width = 40;
        $tmp_height = 40;
        $tmp_alt_text = 'Minimize';
        $tmp_title_text = 'Navigate to Minimize';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function PRIMARY_NAV_BLUE00_MINIMIZE_INACTIVE($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=primary_nav_seriesblue00_120x120_minimize_inactive.png
        // USE NO EXTENSION.
        $tmp_filename = 'primary_nav_seriesblue00_120x120_minimize_inactive';
        $tmp_width = 40;
        $tmp_height = 40;
        $tmp_alt_text = 'Minimize';
        $tmp_title_text = 'Navigate to Minimize';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function PRIMARY_NAV_BLUE00_MINIMIZE_FIVEDEV($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=primary_nav_seriesblue00_120x120_minimize_fivedev.png
        // USE NO EXTENSION.
        $tmp_filename = 'primary_nav_seriesblue00_120x120_minimize_fivedev';
        $tmp_width = 40;
        $tmp_height = 40;
        $tmp_alt_text = '5';
        $tmp_title_text = 'eVifweb development';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function PRIMARY_NAV_BLUE00_MINIMIZE_FIVEDEV_SMALL($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=primary_nav_seriesblue00_120x120_minimize_fivedev_sm.png
        // USE NO EXTENSION.
        $tmp_filename = 'primary_nav_seriesblue00_120x120_minimize_fivedev_sm';
        $tmp_width = 40;
        $tmp_height = 40;
        $tmp_alt_text = '5';
        $tmp_title_text = 'eVifweb development';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function MESSAGE_CONVERSATION_BUBBLE_MICRO_THUMB_BLUE00($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.139/alpha.jony5.com/?crnrstn_to_base64=crnrstn_message_bubbles_seriesblue00.png
        // USE NO EXTENSION.
        $tmp_filename = 'crnrstn_message_bubbles_seriesblue00';
        $tmp_width = 63;
        $tmp_height = 39;
        $tmp_alt_text = 'CRNRSTN ::';
        $tmp_title_text = 'CRNRSTN ::';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function MESSAGE_CONVERSATION_BUBBLE($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # # http://172.16.225.128/jony5/?crnrstn_to_base64=crnrstn_message_bubbles_seriesblue00.png
        // USE NO EXTENSION.
        $tmp_filename = 'crnrstn_messenger_message_bubbles';
        $tmp_width = 172;
        $tmp_height = 106;
        $tmp_alt_text = 'CRNRSTN ::';
        $tmp_title_text = 'CRNRSTN ::';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function FIVE($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/5.jpg
        $tmp_filename = '5';
        $tmp_width = 18;
        $tmp_height = 18;
        $tmp_alt_text = '5';
        $tmp_title_text = '5';
        $tmp_link = 'http://jony5.com/projects/crnrstn/philosophy/';
        $tmp_target = '_blank';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function SUCCESS_CHECK($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function ERR_X($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function CRNRSTN_LOGO($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/crnrstn_logo_lg.jpg
        $tmp_filename = 'crnrstn_logo_lg';
        $tmp_width = '';
        $tmp_height = 98;
        $tmp_alt_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
        $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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
        
        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function CRNRSTN_R_LG($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/crnrstn_R_lg.jpg
        $tmp_filename = 'crnrstn_R_lg';
        $tmp_width = 50;
        $tmp_height = 69;
        $tmp_alt_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
        $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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
        
        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function CRNRSTN_R_MD($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/crnrstn_R_md.jpg
        $tmp_filename = 'crnrstn_R_md';
        $tmp_width = 26;
        $tmp_height = 35;
        $tmp_alt_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
        $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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
        
        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function CRNRSTN_R_SM($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/crnrstn_R_sm.jpg
        $tmp_filename = 'crnrstn_R_sm';
        $tmp_width = 12;
        $tmp_height = 16;
        $tmp_alt_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
        $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function R_PLUS_WALL($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/crnrstn_R_md_plus_wall.jpg
        $tmp_filename = 'crnrstn_R_md_plus_wall';
        $tmp_width = 66;
        $tmp_height = 35;
        $tmp_alt_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
        $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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
        
        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function BG_SHADOW_RESPONSE_CODE($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function PHP_ELLIPSE($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/php_logo.jpg
        $tmp_filename = 'php_logo';
        $tmp_width = 65;
        $tmp_height = 35;
        $tmp_alt_text = 'php v' . $this->oCRNRSTN->version_php();
        $tmp_title_text = 'php v' . $this->oCRNRSTN->version_php() . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
        $tmp_link = 'https://www.php.net/';
        $tmp_target = '_blank';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function POW_BY_PHP($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/powered_by_php.jpg
        $tmp_filename = 'powered_by_php';
        $tmp_width = '';
        $tmp_height = 35;
        $tmp_alt_text = 'Powered by php v' . $this->oCRNRSTN->version_php();
        $tmp_title_text = 'Powered by php v' . $this->oCRNRSTN->version_php() . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
        $tmp_link = 'https://www.php.net/';
        $tmp_target = '_blank';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function ZEND_LOGO($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/zend_logo.jpg
        $tmp_filename = 'zend_logo';
        $tmp_width = 73;
        $tmp_height = 39;
        $tmp_alt_text = 'ZEND';
        $tmp_title_text = 'ZEND' . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
        $tmp_link = 'https://www.zend.com/';
        $tmp_target = '_blank';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function ZEND_FRAMEWORK($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/zend_framework.jpg
        $tmp_filename = 'zend_framework';
        $tmp_width = 212;
        $tmp_height = 40;
        $tmp_alt_text = 'ZEND FRAMEWORK';
        $tmp_title_text = 'ZEND FRAMEWORK' . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
        $tmp_link = 'https://www.zend.com/';
        $tmp_target = '_blank';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function ZEND_FRAMEWORK_3($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/zend_framework_3.jpg
        $tmp_filename = 'zend_framework_3';
        $tmp_width = 224;
        $tmp_height = 38;
        $tmp_alt_text = 'ZEND FRAMEWORK 3';
        $tmp_title_text = 'ZEND FRAMEWORK 3' . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
        $tmp_link = 'https://www.zend.com/';
        $tmp_target = '_blank';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function LINUX_PENGUIN($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/linux_penguin_sm.jpg
        $tmp_filename = 'linux_penguin_sm';
        $tmp_width = 30;
        $tmp_height = 35;
        $tmp_alt_text = 'Linux :: Tux the Penguin';
        $tmp_title_text = 'Linux' . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
        $tmp_link = 'https://www.linux.com/';
        $tmp_target = '_blank';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function MYSQL_DOLPHIN($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/mysql_logo.jpg
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
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function REDHAT_HAT_LOGO($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/redhat_hat_logo.jpg
        $tmp_filename = 'redhat_hat_logo';
        $tmp_width = 57;
        $tmp_height = 42;
        $tmp_alt_text = 'Red Hat';
        $tmp_title_text = 'Red Hat' . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
        $tmp_link = 'https://www.redhat.com/';
        $tmp_target = '_blank';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function REDHAT_LOGO($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/powered_by_redhat.jpg
        $tmp_filename = 'redhat_logo';
        $tmp_width = 130;
        $tmp_height = 42;
        $tmp_alt_text = 'Red Hat';
        $tmp_title_text = 'Red Hat' . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
        $tmp_link = 'https://www.redhat.com/';
        $tmp_target = '_blank';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function APACHE_FEATHER($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/apache_feather_logo.png
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
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function APACHE_POWER_VERSION($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        $version = $this->oCRNRSTN->version_apache_sysimg();

        switch($version){
            case 2.4:

                return $this->APACHE_POWER_2_4($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 2.2:

                return $this->APACHE_POWER_2_2($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 2.0:

                return $this->APACHE_POWER_2_0($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 1.3:

                return $this->APACHE_POWER_1_3($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            default:

                return $this->APACHE_POWER($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;

        }

    }

    private function APACHE_POWER_2_4($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/powered_by_apache_2_4.jpg
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
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function APACHE_POWER_2_2($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/powered_by_apache_2_2.jpg
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
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function APACHE_POWER_2_0($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/powered_by_apache_2.jpg
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
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function APACHE_POWER_1_3($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/powered_by_apache_1_3.jpg
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
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function APACHE_POWER($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/powered_by_apache.jpg
        $tmp_filename = 'powered_by_apache';
        $tmp_width = 259;
        $tmp_height = 32;

        $tmp_alt_text = 'Powered by Apache';
        $tmp_title_text = 'Powered by Apache' . ' :: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();

        $tmp_link = 'http://apache.org/';
        $tmp_target = '_blank';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function BG_ELEMENT_REFLECTION_SIGNIN($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/signin_frm_reflection.jpg
        $tmp_filename = 'signin_frm_reflection';
        $tmp_width = 722;
        $tmp_height = 55;
        $tmp_alt_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
        $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function DOT_GREEN($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function DOT_RED($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function DOT_OFF($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function NOTICE_TRI_ALERT($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function SEARCH_MAGNIFY_GLASS($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/mag_glass_search.jpg
        $tmp_filename = 'mag_glass_search';
        $tmp_width = '';
        $tmp_height = 14;
        $tmp_alt_text = 'Search';
        $tmp_title_text = 'Search';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function ICON_EMAIL_INBOX_REFLECT($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/email_inbox_icon.jpg
        $tmp_filename = 'email_inbox_icon';
        $tmp_width = 201;
        $tmp_height = 185;
        $tmp_alt_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
        $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function J5_WOLF_PUP_RAND($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

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

                return $this->J5_WOLF_PUP($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_LAY_00':

                return $this->J5_WOLF_PUP_LAY_00($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_LAY_01':

                return $this->J5_WOLF_PUP_LAY_01($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_LAY_02':

                return $this->J5_WOLF_PUP_LAY_02($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_LAY_LOOK_AWAY':

                return $this->J5_WOLF_PUP_LAY_LOOK_AWAY($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_LAY_LOOK_FORWARD':

                return $this->J5_WOLF_PUP_LAY_LOOK_FORWARD($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_LAY_LOOK_FORWARD_LEASH':

                return $this->J5_WOLF_PUP_LAY_LOOK_FORWARD_LEASH($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_LEASH_EYES_CLOSED':

                return $this->J5_WOLF_PUP_LEASH_EYES_CLOSED($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_LIL_5_PTS':

                return $this->J5_WOLF_PUP_LIL_5_PTS($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_SIT_EYES_CLOSED':

                return $this->J5_WOLF_PUP_SIT_EYES_CLOSED($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_FORWARD':

                return $this->J5_WOLF_PUP_SIT_LOOK_FORWARD($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_LEFT_ISH_SHADOW':

                return $this->J5_WOLF_PUP_SIT_LOOK_LEFT_ISH_SHADOW($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_RIGHT':

                return $this->J5_WOLF_PUP_SIT_LOOK_RIGHT($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_RIGHT_LONGSHADOW':

                return $this->J5_WOLF_PUP_SIT_LOOK_RIGHT_LONGSHADOW($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_RIGHT_SHADOW':

                return $this->J5_WOLF_PUP_SIT_LOOK_RIGHT_SHADOW($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_RIGHT_SHORT_SHADOW':

                return $this->J5_WOLF_PUP_SIT_LOOK_RIGHT_SHORT_SHADOW($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_RIGHT_UP':

                return $this->J5_WOLF_PUP_SIT_LOOK_RIGHT_UP($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_RIGHTSHARP_SHADOW':

                return $this->J5_WOLF_PUP_SIT_LOOK_RIGHTSHARP_SHADOW($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_STAND_LOOK_RIGHT':

                return $this->J5_WOLF_PUP_STAND_LOOK_RIGHT($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_STAND_LOOK_UP':

                return $this->J5_WOLF_PUP_STAND_LOOK_UP($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            case 'J5_WOLF_PUP_WALK':

                return $this->J5_WOLF_PUP_WALK($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;
            default:

                //
                //J5_WOLF_PUP
                return $this->J5_WOLF_PUP($height_override, $link_override, $alt_override, $title_override, $target_override, $width_override);

            break;

        }

    }

    private function J5_WOLF_PUP($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup.jpg
        $tmp_filename = 'j5_wolf_pup';
        $tmp_width = 525;
        $tmp_height = 351;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function J5_WOLF_PUP_LAY_00($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_lay_00.jpg
        $tmp_filename = 'j5_wolf_pup_lay_00';
        $tmp_width = '';
        $tmp_height = 345;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function J5_WOLF_PUP_LAY_01($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_lay_01.jpg
        $tmp_filename = 'j5_wolf_pup_lay_01';
        $tmp_width = '';
        $tmp_height = 400;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function J5_WOLF_PUP_LAY_02($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_lay_02.jpg
        $tmp_filename = 'j5_wolf_pup_lay_02';
        $tmp_width = '';
        $tmp_height = 348;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function J5_WOLF_PUP_LAY_LOOK_AWAY($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_lay_look_away.jpg
        $tmp_filename = 'j5_wolf_pup_lay_look_away';
        $tmp_width = '';
        $tmp_height = 400;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function J5_WOLF_PUP_LAY_LOOK_FORWARD($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_lay_look_forward.jpg
        $tmp_filename = 'j5_wolf_pup_lay_look_forward';
        $tmp_width = '';
        $tmp_height = 450;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function J5_WOLF_PUP_LAY_LOOK_FORWARD_LEASH($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_lay_look_forward_leash.jpg
        $tmp_filename = 'j5_wolf_pup_lay_look_forward_leash';
        $tmp_width = '';
        $tmp_height = 365;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function J5_WOLF_PUP_LEASH_EYES_CLOSED($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_leash_eyes_closed.jpg
        $tmp_filename = 'j5_wolf_pup_leash_eyes_closed';
        $tmp_width = '';
        $tmp_height = 370;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function J5_WOLF_PUP_LIL_5_PTS($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_lil_5_pts.jpg
        $tmp_filename = 'j5_wolf_pup_lil_5_pts';
        $tmp_width = '';
        $tmp_height = 340;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function J5_WOLF_PUP_SIT_EYES_CLOSED($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_sit_eyes_closed.jpg
        $tmp_filename = 'j5_wolf_pup_sit_eyes_closed';
        $tmp_width = '';
        $tmp_height = 376;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function J5_WOLF_PUP_SIT_LOOK_FORWARD($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_sit_look_forward.jpg
        $tmp_filename = 'j5_wolf_pup_sit_look_forward';
        $tmp_width = '';
        $tmp_height = 400;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function J5_WOLF_PUP_SIT_LOOK_LEFT_ISH_SHADOW($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_sit_look_left_ish_shadow.jpg
        $tmp_filename = 'j5_wolf_pup_sit_look_left_ish_shadow';
        $tmp_width = '';
        $tmp_height = 305;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function J5_WOLF_PUP_SIT_LOOK_RIGHT($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_sit_look_right.jpg
        $tmp_filename = 'j5_wolf_pup_sit_look_right';
        $tmp_width = '';
        $tmp_height = 416;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function J5_WOLF_PUP_SIT_LOOK_RIGHT_LONGSHADOW($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_sit_look_right_longshadow.jpg
        $tmp_filename = 'j5_wolf_pup_sit_look_right_longshadow';
        $tmp_width = '';
        $tmp_height = 346;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function J5_WOLF_PUP_SIT_LOOK_RIGHT_SHADOW($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_sit_look_right_shadow.jpg
        $tmp_filename = 'j5_wolf_pup_sit_look_right_shadow';
        $tmp_width = '';
        $tmp_height = 290;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function J5_WOLF_PUP_SIT_LOOK_RIGHT_SHORT_SHADOW($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_sit_look_right_shortshadow.jpg
        $tmp_filename = 'j5_wolf_pup_sit_look_right_shortshadow';
        $tmp_width = '';
        $tmp_height = 443;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function J5_WOLF_PUP_SIT_LOOK_RIGHT_UP($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_sit_look_right_up.jpg
        $tmp_filename = 'j5_wolf_pup_sit_look_right_up';
        $tmp_width = '';
        $tmp_height = 413;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function J5_WOLF_PUP_SIT_LOOK_RIGHTSHARP_SHADOW($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_sit_look_rightsharp_shadow.jpg
        $tmp_filename = 'j5_wolf_pup_sit_look_rightsharp_shadow';
        $tmp_width = '';
        $tmp_height = 331;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function J5_WOLF_PUP_STAND_LOOK_RIGHT($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_stand_look_right.jpg
        $tmp_filename = 'j5_wolf_pup_stand_look_right';
        $tmp_width = '';
        $tmp_height = 390;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function J5_WOLF_PUP_STAND_LOOK_UP($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_stand_look_up.jpg
        $tmp_filename = 'j5_wolf_pup_stand_look_up';
        $tmp_width = '';
        $tmp_height = 347;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function J5_WOLF_PUP_WALK($height_override = NULL, $link_override = NULL, $alt_override = NULL, $title_override = NULL, $target_override = NULL, $width_override = NULL){

        # # # # # # # #
        // USE NO EXTENSION.
        //_crnrstn/ui/imgs/jpg/j5_wolf_pup_walk.jpg
        $tmp_filename = 'j5_wolf_pup_walk';
        $tmp_width = '';
        $tmp_height = 430;
        $tmp_alt_text = 'J5 Wolf Pup';
        $tmp_title_text = 'CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . ' :: J5 Wolf Pup';
        $tmp_link = '';
        $tmp_target = '';
        # # # # # # # #
        # # # # # # # #

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

        return $this->return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target);

    }

    private function system_base64_HTML_tidy($filename, $base64){

        $tmp_str_out = $base64;

        $filename = $filename . '.png';

        switch($filename){
            case 'elem_shadow_btm.png':
            //case 'elem_shadow_btm.jpg':
            //case 'elem_shadow_btm.jpeg':
            //case 'elem_shadow_btm.jpg2':
                $tmp_str_out = '';
                $tmp_str_out .= 'background-image:url(';
                $tmp_str_out .= $base64;
                $tmp_str_out .= ')';

            break;
            //case 'signin_frm_reflection.png':
            //case 'signin_frm_reflection.jpg':
            //case 'signin_frm_reflection.jpeg':
            //case 'signin_frm_reflection.jpg2':
//
                //error_log(__LINE__ . ' img html [' . $filename . '][' . self::$image_output_mode . '][' . strlen($base64) . ']');
                //
                //die();
                //$tmp_str_out = '';
                //$tmp_str_out .= '<div style="width:722px; height:55px; background: url(\'';
                //$tmp_str_out .= $base64;
                //$tmp_str_out .= '\'); background-repeat: no-repeat;"></div>';
//
            //break;

        }

        return $tmp_str_out;

    }

    private function return_image_data($tmp_filename, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text, $tmp_link, $tmp_target){

        try{

            switch(self::$image_output_mode){
                case CRNRSTN_UI_IMG_BASE64_JPEG_HTML_WRAPPED:

                    $tmp_path_base64 = CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/' . $tmp_filename . '.php';

                    if(!@include($tmp_path_base64)){

                        $this->oCRNRSTN->error_log('Failure opening [' . $tmp_filename . '] for inclusion. Attempting to repair the BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
                        //$this->oCRNRSTN->print_r('Failure opening [' . $tmp_filename . '] for inclusion. Attempting to repair the BASE64 file system.', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

                        $this->oCRNRSTN->system_base64_synchronize($tmp_filename);

                        //
                        // TRY AGAIN (...AFTER system_base64_synchronize())
                        if(!@include($tmp_path_base64)){

                            $this->oCRNRSTN->error_log('Failure opening [' . $tmp_path_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
                            //$this->oCRNRSTN->print_r('Failure opening [' . $tmp_path_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('Failure opening [' . $tmp_path_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.');

                        }else{

                            //$this->oCRNRSTN->print_r('Repair of asset successfully completed on [' . $tmp_filename . '] within the CRNRSTN :: BASE64 file system.', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);
                            $this->oCRNRSTN->error_log('Repair of asset successfully completed on [' . $tmp_filename . '] within the CRNRSTN :: BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                        }

                    }

                    if(isset($system_file_serial)) {

                        $tmp_str = self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_JPEG][self::$request_salt][$system_file_serial]['base64'];

                        $tmp_str = $this->system_base64_HTML_tidy($tmp_filename, $tmp_str);

                    }

                    if(strlen($tmp_link) > 0){

                        $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                        return $tmp_str;

                    }else{

                        return '<img src="' . $tmp_str . '" width="' . $tmp_width . '" height="' . $tmp_height . '" alt="' . $tmp_alt_text . '" title="' . $tmp_title_text . '">';

                    }

                break;
                case CRNRSTN_UI_IMG_BASE64_PNG_HTML_WRAPPED:
                case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                    $tmp_path_base64 = CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/' . $tmp_filename . '.php';

                    if(!@include($tmp_path_base64)){

                        $this->oCRNRSTN->error_log('Failure opening [' . $tmp_filename . '] for inclusion. Attempting to repair the BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
                        $this->oCRNRSTN->print_r('Failure opening [' . $tmp_filename . '] for inclusion. Attempting to repair the BASE64 file system.', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

                        $this->oCRNRSTN->system_base64_synchronize($tmp_filename . '.png');

                        //
                        // TRY AGAIN (...AFTER system_base64_synchronize())
                        if(!@include($tmp_path_base64)){

                            $this->oCRNRSTN->error_log('Failure opening [' . $tmp_path_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
                            $this->oCRNRSTN->print_r('Failure opening [' . $tmp_path_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('Failure opening [' . $tmp_path_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.');

                        }else{

                            $this->oCRNRSTN->print_r('Repair of asset successfully completed on [' . $tmp_filename . '] within the CRNRSTN :: BASE64 file system.', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

                        }

                    }

                    if(isset($system_file_serial)){

                        $tmp_str = self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$system_file_serial ]['base64'];

                        $tmp_str = $this->system_base64_HTML_tidy($tmp_filename, $tmp_str);

                    }

                    if(strlen($tmp_link) > 0){

                        $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                        return $tmp_str;

                    }else{

                        return '<img src="' . $tmp_str . '" width="' . $tmp_width . '" height="' . $tmp_height . '" alt="' . $tmp_alt_text . '" title="' . $tmp_title_text . '">';

                    }

                break;
                case CRNRSTN_UI_IMG_BASE64_JPEG:

                    $tmp_path_base64 = CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/' . $tmp_filename . '.php';

                    if(!@include($tmp_path_base64)){

                        $this->oCRNRSTN->error_log('Failure opening [' . $tmp_filename . '] for inclusion. Attempting to repair the BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
                        //$this->oCRNRSTN->print_r('Failure opening [' . $tmp_filename . '] for inclusion. Attempting to repair the BASE64 file system.', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

                        $this->oCRNRSTN->system_base64_synchronize($tmp_filename);

                        //
                        // TRY AGAIN (...AFTER system_base64_synchronize())
                        if(!@include($tmp_path_base64)){

                            $this->oCRNRSTN->error_log('Failure opening [' . $tmp_path_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
                            //$this->oCRNRSTN->print_r('Failure opening [' . $tmp_path_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('Failure opening [' . $tmp_path_base64 . '] for inclusion and permission was denied to write to the BASE64 file system for repair.');

                        }else{

                            //$this->oCRNRSTN->print_r('Repair of asset successfully completed on [' . $tmp_filename . '] within the CRNRSTN :: BASE64 file system.', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);
                            $this->oCRNRSTN->error_log('Repair of asset successfully completed on [' . $tmp_filename . '] within the CRNRSTN :: BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                        }

                    }

                    if(isset($system_file_serial)){

                        $tmp_str = self::$image_filesystem_meta_ARRAY[self::$image_output_mode][self::$request_salt][$system_file_serial ]['base64'];

                        $tmp_str = $this->system_base64_HTML_tidy($tmp_filename, $tmp_str);

                    }

                    //
                    // BASE64
                    return $tmp_str;

                break;
                case CRNRSTN_UI_IMG_BASE64:
                case CRNRSTN_UI_IMG_BASE64_PNG:

                    require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/' . $tmp_filename . '.php');

                    if(isset($system_file_serial)) {

                        $tmp_str = self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$system_file_serial ]['base64'];

                        $tmp_str = $this->system_base64_HTML_tidy($tmp_filename, $tmp_str);

                    }

                    //
                    // BASE64
                    return $tmp_str;

                break;
                case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                    $tmp_str = $this->oCRNRSTN->crnrstn_resources_http_path() . 'ui/imgs/jpg/' . $tmp_filename . '.jpg';

                    if(strlen($tmp_link) > 0){

                        $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                        return $tmp_str;

                    }else{

                        return '<img src="' . $tmp_str . '" width="' . $tmp_width . '" height="' . $tmp_height . '" alt="' . $tmp_alt_text . '" title="' . $tmp_title_text . '">';

                    }

                break;
                case CRNRSTN_UI_IMG_JPEG:

                    $tmp_str = $this->oCRNRSTN->crnrstn_resources_http_path() . 'ui/imgs/jpg/' . $tmp_filename . '.jpg';

                    //
                    // JPEG
                    return $tmp_str;

                break;
                case CRNRSTN_UI_IMG_PNG:

                    return $this->oCRNRSTN->crnrstn_resources_http_path() . 'ui/imgs/png/' . $tmp_filename . '.png';

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

                    // CRNRSTN_UI_IMG_PNG_HTML_WRAPPED

                    //
                    // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                    $tmp_str = $this->oCRNRSTN->crnrstn_resources_http_path() . 'ui/imgs/png/' . $tmp_filename . '.png';

                    if(strlen($tmp_link) > 0){

                        $tmp_str = $this->return_linked_ui_element($tmp_str, $tmp_link, $tmp_target, $tmp_width, $tmp_height, $tmp_alt_text, $tmp_title_text);

                        return $tmp_str;

                    }else{

                        return '<img src="' . $tmp_str . '" width="' . $tmp_width . '" height="' . $tmp_height . '" alt="' . $tmp_alt_text . '" title="' . $tmp_title_text . '">';

                    }

                break;

            }

        }catch( Exception $e ){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    private function return_linked_ui_element($str, $link, $target, $width = NULL, $height = NULL, $alt = NULL, $title = NULL, $meta_params_ARRAY = array()){

        $width = $this->html_img_dom_return($width, 'WIDTH');
        $height = $this->html_img_dom_return($height, 'HEIGHT');
        $alt = $this->html_img_dom_return($alt, 'ALT');
        $title = $this->html_img_dom_return($title, 'TITLE');

        $tmp_str = '<img src="' . $str . '" ' . $width . ' ' . $height . ' ' . $alt . ' ' . $title . ' style="border:0;">';

        if(strlen($target) < 1){

            $target = '_self';

        }

        if(strlen($link) > 0){

            if($this->oCRNRSTN->isset_encryption(CRNRSTN_ENCRYPT_TUNNEL)){
                //if(strlen($this->oCRNRSTN->env_key) > 0 && $this->oCRNRSTN->isset_encryption(CRNRSTN_ENCRYPT_TUNNEL)){

                $tmp_str = '<a href="' . $this->oCRNRSTN->return_sticky_link($link, $meta_params_ARRAY) . '" target="' . $target . '">' . $tmp_str . '</a>';

                return $tmp_str;

            }

            $tmp_str = '<a href="' . $link . '" target="' . $target . '">' . $tmp_str . '</a>';

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

        return $this->return_creative($data_key, CRNRSTN_SETTINGS_CRNRSTN, 'ALL_IMAGE');

    }

    private function load_system_asset($data_type_constant){

        //error_log(__LINE__ . ' img html ['.$data_type_constant.']['.self::$request_salt.'][\'path_filename\']');

        if(isset(self::$image_filesystem_meta_ARRAY[$data_type_constant][self::$request_salt]['path_filename'])){

            if(!$file_path = self::$image_filesystem_meta_ARRAY[$data_type_constant][self::$request_salt]['path_filename']){

                $this->oCRNRSTN->print_r('ERROR :: LOAD ASSET[' . print_r(self::$image_filesystem_meta_ARRAY[$data_type_constant], true).'].', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

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
                //$this->oCRNRSTN->print_r('LOADED ASSET DATA [' . $data_type_constant . ']['.print_r(self::$image_filesystem_meta_ARRAY, true).'].', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

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
                //$this->oCRNRSTN->print_r('INVALID [' . $data_type_constant . '] BASE64 FROM FILE.', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);
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

                    //$this->oCRNRSTN->print_r('DELTA [' . __METHOD__ . '] ERROR! [JPEG] IMAGE_FILE_BASE64[len=' . strlen($tmp_BASE64_LIVE) . '] STATIC_PHP_BASE64[len=' . strlen($tmp_BASE64_STATIC_PHP) . '].', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);
                    //$this->oCRNRSTN->print_r('ERR VALUES [' . CRNRSTN_UI_IMG_BASE64_JPEG . '][' . self::$request_salt . '][' . $this->system_file_serial . '][\'base64\'].', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

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

                    //$this->oCRNRSTN->print_r('DELTA ERROR ON [' . $data_type_constant . ']![PNG] LIVE=[' . $tmp_BASE64_LIVE . '] STATIC_PHP=[' . $tmp_BASE64_STATIC_PHP . '].', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);
                    //$this->oCRNRSTN->print_r('ERR VALUES [' . CRNRSTN_UI_IMG_BASE64_JPEG . '][' . self::$request_salt . '][' . $this->system_file_serial . '][\'base64\'].', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

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
                $this->oCRNRSTN->error_log('WARNING. Disk space exceeds ' . $this->oCRNRSTN->get_performance_metric('maximum_disk_use') . '% minimum allocation of free space. File write [' . $tmp_filepath . '] stopped. CRNRSTN :: is configured to stop file writes when allocation of free space on disk exceeds specified limits.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY_DISK);

                $this->oCRNRSTN->print_r('WARNING. Disk space exceeds ' . $this->oCRNRSTN->get_performance_metric('maximum_disk_use') . '% minimum allocation of free space. File write stopped. CRNRSTN :: is configured to stop file writes when allocation of free space on disk exceeds specified limits.', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);

                throw new Exception('WARNING. Disk space exceeds ' . $this->oCRNRSTN->get_performance_metric('maximum_disk_use') . '% minimum allocation of free space. File write [' . $tmp_filepath . '] stopped. CRNRSTN :: is configured to stop file writes when allocation of free space on disk exceeds specified limits.');

            }

            $_SESSION['CRNRSTN_' . $this->oCRNRSTN->get_server_config_serial('hash')]['CRNRSTN_EXCEPTION_PREFIX'] = __CLASS__ . '::' . __METHOD__ . '() attempted to open ' . $tmp_filepath . ', but ';
            if($resource_file = fopen($tmp_filepath, 'w')){

                $_SESSION['CRNRSTN_'. $this->oCRNRSTN->get_server_config_serial('hash')]['CRNRSTN_EXCEPTION_PREFIX'] = '';

                fwrite($resource_file, $tmp_data_str_out);
                fclose($resource_file);

                $this->oCRNRSTN->error_log('Success. System write of BASE64 file is complete. File: ' . $tmp_filename . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);

            }else{

                //$this->oCRNRSTN->print_r('SYSTEM FILE WRITE...ERROR!! [' . $tmp_filename. '].', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);
                $this->oCRNRSTN->error_log('CRNRSTN :: has experienced permissions related error as the target file, ' . $tmp_filepath . ', is NOT writable with current permissions as ' . $tmp_current_perms . '.');
                $this->oCRNRSTN->print_r('CRNRSTN :: has experienced permissions related error as the target file, ' . $tmp_filepath . ', is NOT writable with current permissions as ' . $tmp_current_perms . '.', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

                //
                // ATTEMPT TO CHANGE PERMISSIONS AND CHECK AGAIN
                // BEFORE COMPLETELY GIVING UP
                $this->oCRNRSTN->error_log('Attempting to modify permissions to ' . str_pad($mkdir_mode,'4', '0',STR_PAD_LEFT) . ' for file write at, ' . $tmp_filepath . '. The current permissions, ' . $tmp_current_perms . ', at file for CRNRSTN :: render the file NOT to be writable.');
                $this->oCRNRSTN->print_r('Attempting to modify permissions to ' . str_pad($mkdir_mode,'4', '0',STR_PAD_LEFT) . ' for file write at, ' . $tmp_filepath . '. The current permissions, ' . $tmp_current_perms . ', at file for CRNRSTN :: render the file NOT to be writable.', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

                //$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_crc]['CRNRSTN_EXCEPTION_PREFIX'] = 'CRNRSTN :: has experienced permissions related error as the destination file, ' . $tmp_filepath . ' (' . $tmp_current_perms . '), is NOT writable to ' . str_pad($mkdir_mode,'4', '0',STR_PAD_LEFT) . ', and furthermore ';
                $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_crc]['CRNRSTN_EXCEPTION_PREFIX'] = __CLASS__ . '::' . __METHOD__ . '() attempted to chmod ' . str_pad($mkdir_mode,'4', '0',STR_PAD_LEFT) . ' the write permissions to related to ' . $tmp_filepath . ', currently [' . $tmp_current_perms . '], but ';
                if(chmod($tmp_filepath, $mkdir_mode)){

                    $_SESSION['CRNRSTN_'. $this->oCRNRSTN->config_serial_crc]['CRNRSTN_EXCEPTION_PREFIX'] = '';

                    //
                    // ANOTHER ATTEMPT TO WRITE AFTER MODIFICATION OF FILE PERMISSIONS
                    $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_crc]['CRNRSTN_EXCEPTION_PREFIX'] = __CLASS__ . '::' . __METHOD__ . '() attempted to fopen ' . $tmp_filepath . ' after the write permissions to related to same were first chmod to ' . str_pad($mkdir_mode, '4', '0', STR_PAD_LEFT) . '. An attempt to open was again made, but ';
                    if($resource_file = fopen($tmp_filepath, 'w')){

                        $_SESSION['CRNRSTN_'. $this->oCRNRSTN->config_serial_crc]['CRNRSTN_EXCEPTION_PREFIX'] = '';

                        fwrite($resource_file, $tmp_data_str_out);
                        fclose($resource_file);

                        $this->oCRNRSTN->error_log('Success. System write of BASE64 file is complete. File: ' . $tmp_filename . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);

                    }

                    return true;

                }else{

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    $this->oCRNRSTN->error_log('Permission denied. The target file, ' . $tmp_filepath . ', is NOT writable with current permissions as ' . $tmp_current_perms . '.');
                    $this->oCRNRSTN->print_r('Permission denied. The target file, ' . $tmp_filepath . ', is NOT writable with current permissions as ' . $tmp_current_perms . '.', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

                }

            }

            // THE BASE64 OUTPUT WRITTEN TO FILE
            $this->oCRNRSTN->print_r($tmp_data_str_out, self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64][self::$request_salt]['filename'] . ' :: BASE64 CHECK.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

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
        $tmp_ascii = $this->oCRNRSTN->proper_replace('<span style="color:#F90000;">','', $tmp_ascii);
        $tmp_ascii = $this->oCRNRSTN->proper_replace('</span>','', $tmp_ascii);

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

            //$this->oCRNRSTN->print_r('lastmodified_base64_PNG BEING UPDATED.', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);
            self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$this->system_file_serial]['lastmodified_base64_PNG'] = $this->oCRNRSTN->return_micro_time();

        }

        if(!isset(self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_JPEG][self::$request_salt][$this->system_file_serial]['lastmodified_base64_JPEG'])){

            self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_JPEG][self::$request_salt][$this->system_file_serial]['lastmodified_base64_JPEG'] = $this->oCRNRSTN->return_micro_time();

        }

        $tmp_val = self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_JPEG][self::$request_salt][$this->system_file_serial]['lastmodified_base64_JPEG'];

        if(!isset($tmp_val) || ($tmp_val == '')){

            //$this->oCRNRSTN->print_r('lastmodified_base64_JPEG BEING UPDATED.', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);
            self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_JPEG][self::$request_salt][$this->system_file_serial]['lastmodified_base64_JPEG'] = $this->oCRNRSTN->return_micro_time();

        }


        $tmp_file_input_str  .= '/*
' . $tmp_ascii . '*/


$system_file_serial = \'' . $tmp_file_serial . '\';

switch(self::$image_output_mode){
    case CRNRSTN_UI_IMG_BASE64_JPEG_HTML_WRAPPED:
    case CRNRSTN_UI_IMG_BASE64_JPEG:
            
        //
        // BASE64 ENCODE OF JPG';
        if($has_jpeg){

            $tmp_file_input_str  .= '
        self::$image_filesystem_meta_ARRAY[self::$image_output_mode][self::$request_salt][$system_file_serial][\'datecreated_base64_JPEG\'] = \'' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_JPEG][self::$request_salt][$this->system_file_serial]['datecreated_base64_JPEG'] . '\';
        self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_JPEG][self::$request_salt][$system_file_serial][\'base64\'] = \'' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_JPEG][self::$request_salt]['base64'] . '\';
';

        }

        $tmp_file_input_str  .= '
    break;
    default:
    
        //
        // BASE64 ENCODE OF PNG';
        if($has_png){

            $tmp_file_input_str  .= '
        self::$image_filesystem_meta_ARRAY[self::$image_output_mode][self::$request_salt][$system_file_serial][\'datecreated_base64_PNG\'] = \'' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$this->system_file_serial]['datecreated_base64_PNG'] . '\';
        self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$system_file_serial][\'base64\'] = \'' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['base64'] . '\';
';

        }

        $tmp_file_input_str  .= '
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
            $tmp_file_input_str  .= '
self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_JPEG][self::$request_salt][$system_file_serial][\'sha1\'] = \'' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_JPEG][self::$request_salt]['sha1'] . '\';';

        }

        $tmp_file_input_str  .= '


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

                //$this->oCRNRSTN->print_r('GETTING ON THAT NEW BASE64 DATA ARCH.', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

                $this->system_file_serial = $system_file_serial;

//                // HOW BASE64 DATA WANTS TO BE HANDLED
//                if(isset(self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$system_file_serial]['base64'])){
//
//                    $tmp_bpng = self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$system_file_serial]['base64'];
//                    //$this->oCRNRSTN->print_r('BASE64 [PNG] CHECKSUM = [' . print_r($this->oCRNRSTN->crcINT($tmp_bpng), true) . '].', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);
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
//                    $this->oCRNRSTN->print_r('BASE64 [JPEG] datecreated_base64 = [' . print_r($tmp_bj, true) . '].', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);
//
//                }

            }

            if(isset($tmp_str)){

                //$this->oCRNRSTN->print_r('PROCESSING OLD BASE64 DATA ARCH.', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

                $tmp_base64_content_delta++;
                self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$this->system_file_serial]['base64'] = $tmp_str;
                self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$this->system_file_serial]['base64_crc'] = $this->oCRNRSTN->crcINT($tmp_str);
                self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['arch_1.0_base64'] = $tmp_str;

            }

        }

        //
        // LOAD (ATTEMPT TO) FILE META INTO MEMORY - PNG
        if($this->load_system_asset(CRNRSTN_UI_IMG_PNG)){

            //$this->oCRNRSTN->print_r('SYSTEM LOADED PNG FILE [' . print_r(self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG], true) . '].', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);
            //$this->oCRNRSTN->error_log('System load of PNG file to check BASE64 file is complete. File: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['filename'] . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);

            if(!$this->valid_system_asset(CRNRSTN_UI_IMG_PNG, 'SYSTEM_BASE64')){

                if(isset(self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$this->system_file_serial]['lastmodified_base64_PNG'])){

                    //$this->oCRNRSTN->print_r('lastmodified_base64_PNG WILL BE UPDATED.', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);
                    self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_PNG][self::$request_salt][$this->system_file_serial]['lastmodified_base64_PNG'] = '';

                }
                $this->oCRNRSTN->error_log('System BASE64 is NOT in sync with file: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['filename'] . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);
                $tmp_base64_content_delta++;

            }

        }

        //
        // LOAD (ATTEMPT TO) FILE META INTO MEMORY - JPEG
        if($this->load_system_asset(CRNRSTN_UI_IMG_JPEG)){

            //$this->oCRNRSTN->print_r('SYSTEM LOADED JPEG FILE [' . print_r(self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_JPEG], true) . '].', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);
            //$this->oCRNRSTN->error_log('System load of JPEG file to check BASE64 file is complete. File: ' . self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_JPEG][self::$request_salt]['filename'] . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);

            if(!$this->valid_system_asset(CRNRSTN_UI_IMG_JPEG, 'SYSTEM_BASE64')){

                if(isset(self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64_JPEG][self::$request_salt][$this->system_file_serial]['lastmodified_base64_JPEG'])){

                    //$this->oCRNRSTN->print_r('lastmodified_base64_JPEG WILL BE UPDATED.', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);
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

        self::$request_salt = $this->oCRNRSTN->generate_new_key(26);

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

        $DOCUMENT_ROOT = $this->oCRNRSTN->get_resource('DOCUMENT_ROOT');
        $DOCUMENT_ROOT_DIR = $this->oCRNRSTN->get_resource('DOCUMENT_ROOT_DIR');

        //
        // SYSTEM IMAGES DIRECTORIES
        self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['dir'] = $DOCUMENT_ROOT . $DOCUMENT_ROOT_DIR . '/_crnrstn/ui/imgs/png/';
        self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_JPEG][self::$request_salt]['dir'] = $DOCUMENT_ROOT . $DOCUMENT_ROOT_DIR . '/_crnrstn/ui/imgs/jpg/';
        self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64][self::$request_salt]['dir'] = $DOCUMENT_ROOT . $DOCUMENT_ROOT_DIR . '/_crnrstn/ui/imgs/base64/';

        $tmp_dir_PNG = self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['dir'];
        $tmp_dir_JPEG = self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_JPEG][self::$request_salt]['dir'];
        $tmp_dir_BASE64 = self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_BASE64][self::$request_salt]['dir'];

        $tmp_img_type_ARRAY = array('png', 'jpg', 'jpeg', 'jpg2');
        foreach($tmp_img_type_ARRAY as $index => $img_type){

            switch(strtolower($img_type)){
                case 'png':

                    //
                    // CHECK PNG IS VALID FILE
                    if($this->oCRNRSTN->validate_DIR_endpoint($tmp_dir_PNG, 'SOURCE')){

                        //
                        // DO WE HAVE A VALID FILE?
                        if(is_file($tmp_dir_PNG . $img_name . '.' . $tmp_original_file_extension_clean)){

                            self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['filename'] = $img_name . '.' . $tmp_original_file_extension_clean;
                            self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_PNG][self::$request_salt]['path_filename'] = $tmp_dir_PNG . $img_name . '.' . $tmp_original_file_extension_clean;
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
                                    //$this->oCRNRSTN->print_r('VALID PNG FILE [' . $tmp_dir_PNG . $img_name . '.' . $tmp_original_file_extension_clean . '].', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);
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

                    //
                    // JPEG
                    if($this->oCRNRSTN->validate_DIR_endpoint($tmp_dir_JPEG, 'SOURCE')){

                        //
                        // DO WE HAVE A VALID JPEG FILE NAME
                        if(is_file($tmp_dir_JPEG . $img_name . '.' . $tmp_original_file_extension_clean)){

                            self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_JPEG][self::$request_salt]['filename'] = $img_name . '.' . $tmp_original_file_extension_clean;
                            self::$image_filesystem_meta_ARRAY[CRNRSTN_UI_IMG_JPEG][self::$request_salt]['path_filename'] = $tmp_dir_JPEG . $img_name . '.' . $tmp_original_file_extension_clean;
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
                                    //$this->oCRNRSTN->print_r('VALID JPEG FILE [' . $tmp_dir_JPEG . $img_name . '.jpg' . '].', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);
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

        return true;

    }

    public function __destruct() {

    }

}