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
#         AUTHOR :: Jonathan 'J5' Harris, CEO, CTO, Lead Full Stack Developer, jharris@eVifweb.com, J00000101@gmail.com.
#            URI :: http://crnrstn.evifweb.com/
#       OVERVIEW :: CRNRSTN :: An Open Source PHP Class Library that stands on top of a robust web services oriented
#                   architecture to both facilitate, augment, and enhance (with stability) the operations of a code base
#                   for a web application across multiple hosting environments.
#
#                   Copyright (c) 2012-2024 :: eVifweb development :: All Rights Reserved.
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
#                   Stand on top of the CRNRSTN :: SOAP Services Layer to, for example, organize and strengthen the
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
#  CLASS :: crnrstn_database_sql_silo
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  VERSION :: 1.00.0000
#  DATE :: July 4, 2020 @ 1620hrs
#  DESCRIPTION ::
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
class crnrstn_database_sql_silo {

    public $oCRNRSTN;

	public function __construct($oCRNRSTN){

        $this->oCRNRSTN = $oCRNRSTN;

	}

    # $oCRNRSTN_USR->add_database_query('TRANSLATION_DATA','!jesus_is_my_dear_lord!','LANG_PACKS');
    public function returnDatabaseQuery($oCRNRSTN_USR, $oCRNRSTN_MySQLi, $result_set_key){

        return $this->returnQuery($oCRNRSTN_USR, $oCRNRSTN_MySQLi, $result_set_key);

    }

    private function returnQuery($oCRNRSTN_USR, $oCRNRSTN_MySQLi, $result_set_key){

	    error_log(__LINE__ . ' sql silo 75 [' . $result_set_key . '].');

        $mysqli = $oCRNRSTN_MySQLi->return_conn_object();

        try{

            switch($result_set_key){
                case 'LOG_BASSDRIVE_PROCESSED':

                    return $this->return_LOG_BASSDRIVE_PROCESSED();

                break;
                case 'LOG_BASSDRIVE':

                    return $this->return_LOG_BASSDRIVE();

                break;
                case 'BASSDRIVE_STREAM':

                    return $this->return_BASSDRIVE_STREAM();

                break;
                case 'BASSDRIVE_STREAM_COLORS':

                    return $this->return_BASSDRIVE_STREAM_COLORS();

                break;
                case 'BASSDRIVE_STREAM_KEY_PATTERN_LOOKUP':

                    return $this->return_BASSDRIVE_STREAM_KEY_PATTERN_LOOKUP();

                break;
                case 'BASSDRIVE_STREAM_SOCIAL_CONFIG':

                    return $this->return_BASSDRIVE_STREAM_SOCIAL_CONFIG();

                break;
                case 'LANG_PACKS':

                    return $this->return_LANG_PACKS();

                break;
                case 'NEW_OR_KEEPALIVE_SESSION':

                    return $this->return_NEW_OR_KEEPALIVE_SESSION($this->oCRNRSTN->oCRNRSTN_USR, $mysqli);

                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('No query has been configured able to be loaded from the result set key [' . $result_set_key.'].');

                break;

            }

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        //
        // RETURN QUERY
        return $query;

    }

    private function return_LOG_BASSDRIVE_PROCESSED(){

	    return 'SELECT `crnrstn_global_bassdrive_log_processed`.`LOG_PROCESSED_ID`,
                        `crnrstn_global_bassdrive_log_processed`.`BASSDRIVE_LOG_ID`,
                        `crnrstn_global_bassdrive_log_processed`.`BASSDRIVE_LOG_ID_CRC32`,
                        `crnrstn_global_bassdrive_log_processed`.`ISACTIVE`,
                        `crnrstn_global_bassdrive_log_processed`.`NOTE`,
                        `crnrstn_global_bassdrive_log_processed`.`DATEMODIFIED`
                    FROM `crnrstn_global_bassdrive_log_processed`
                    WHERE `crnrstn_global_bassdrive_log_processed`.`ISACTIVE` = 1;';

    }

    private function return_LOG_BASSDRIVE(){

        return 'SELECT `crnrstn_global_bassdrive_log`.`BASSDRIVE_LOG_ID`,
                        `crnrstn_global_bassdrive_log`.`PROGRAM_TITLE`,
                        `crnrstn_global_bassdrive_log`.`STREAM_RELAY_JSON`,
                        `crnrstn_global_bassdrive_log`.`DATEMODIFIED`
                    FROM `crnrstn_global_bassdrive_log`
                    WHERE `crnrstn_global_bassdrive_log`.`ISACTIVE` = 1
                    AND `crnrstn_global_bassdrive_log`.`PROCESSING_STATE` = "NEW"
                    OR `crnrstn_global_bassdrive_log`.`PROCESSING_STATE` = "RELOAD"
                    ORDER BY DATEMODIFIED DESC LIMIT 1;';

    }

    private function return_BASSDRIVE_STREAM(){

        return 'SELECT `bassdrive_stream`.`STREAM_ID`,
                        `bassdrive_stream`.`STREAM_KEY`,
                        `bassdrive_stream`.`STREAM_KEY_CRC32`,
                        `bassdrive_stream`.`COLORS_NAME_KEY`,
                        `bassdrive_stream`.`DATEMODIFIED`,
                        `bassdrive_stream`.`DATECREATED`
                    FROM `bassdrive_stream`
                    WHERE `bassdrive_stream`.`ISACTIVE` = 1;';

    }

    private function return_BASSDRIVE_STREAM_COLORS(){

        return 'SELECT `bassdrive_stream_colors`.`COLORS_ID`,
                        `bassdrive_stream_colors`.`COLORS_NAME_KEY`,
                        `bassdrive_stream_colors`.`COLORS_NAME_KEY_CRC32`,
                        `bassdrive_stream_colors`.`COLORS_IMG_FILENAME`,
                        `bassdrive_stream_colors`.`COLORS_IMG_WIDTH`,
                        `bassdrive_stream_colors`.`COLORS_IMG_HEIGHT`,
                        `bassdrive_stream_colors`.`DATEMODIFIED`,
                        `bassdrive_stream_colors`.`DATECREATED`
                    FROM `bassdrive_stream_colors`
                    WHERE `bassdrive_stream_colors`.`ISACTIVE` = 1;';

    }

    private function return_BASSDRIVE_STREAM_KEY_PATTERN_LOOKUP(){

        return 'SELECT `crnrstn_stream_relay_string_patterns`.`STRING_PATTERN_ID`,
                        `crnrstn_stream_relay_string_patterns`.`STREAM_KEY`,
                        `crnrstn_stream_relay_string_patterns`.`STRING_PATTERN_TYPE`,
                        `crnrstn_stream_relay_string_patterns`.`STRING_PATTERN_LENGTH`,
                        `crnrstn_stream_relay_string_patterns`.`STRING_PATTERN`,
                        `crnrstn_stream_relay_string_patterns`.`DATEMODIFIED`
                    FROM `crnrstn_stream_relay_string_patterns`
                    WHERE `crnrstn_stream_relay_string_patterns`.`ISACTIVE` = 1
                    ORDER BY `crnrstn_stream_relay_string_patterns`.`STRING_PATTERN_LENGTH` DESC;';

    }

    private function return_BASSDRIVE_STREAM_SOCIAL_CONFIG(){

        return 'SELECT `bassdrive_stream_social_config`.`SOCIAL_ID`,
                        `bassdrive_stream_social_config`.`STREAM_KEY`,
                        `bassdrive_stream_social_config`.`STREAM_KEY_CRC32`,
                        `bassdrive_stream_social_config`.`LOG_JSON_SERIAL`,
                        `bassdrive_stream_social_config`.`LOCALE_CITY_STATE_PROV_NATION`,
                        `bassdrive_stream_social_config`.`LINK_SOUNDCLOUD`,
                        `bassdrive_stream_social_config`.`LINK_SOUNDCLOUD2`,
                        `bassdrive_stream_social_config`.`LINK_SOUNDCLOUD3`,
                        `bassdrive_stream_social_config`.`LINK_FACEBOOK`,
                        `bassdrive_stream_social_config`.`LINK_FACEBOOK2`,
                        `bassdrive_stream_social_config`.`LINK_FACEBOOK3`,
                        `bassdrive_stream_social_config`.`LINK_INSTAGRAM`,
                        `bassdrive_stream_social_config`.`LINK_INSTAGRAM2`,
                        `bassdrive_stream_social_config`.`LINK_INSTAGRAM3`,
                        `bassdrive_stream_social_config`.`LINK_TWITTER`,
                        `bassdrive_stream_social_config`.`LINK_TWITTER2`,
                        `bassdrive_stream_social_config`.`LINK_TWITTER3`,
                        `bassdrive_stream_social_config`.`LINK_MIXCLOUD`,
                        `bassdrive_stream_social_config`.`LINK_MIXCLOUD2`,
                        `bassdrive_stream_social_config`.`LINK_MIXCLOUD3`,
                        `bassdrive_stream_social_config`.`LINK_DISCOGS`,
                        `bassdrive_stream_social_config`.`LINK_DISCOGS2`,
                        `bassdrive_stream_social_config`.`LINK_DISCOGS3`,
                        `bassdrive_stream_social_config`.`LINK_BEATPORT`,
                        `bassdrive_stream_social_config`.`LINK_BEATPORT2`,
                        `bassdrive_stream_social_config`.`LINK_BEATPORT3`,
                        `bassdrive_stream_social_config`.`LINK_BANDCAMP`,
                        `bassdrive_stream_social_config`.`LINK_BANDCAMP2`,
                        `bassdrive_stream_social_config`.`LINK_BANDCAMP3`,
                        `bassdrive_stream_social_config`.`LINK_SPOTIFY`,
                        `bassdrive_stream_social_config`.`LINK_SPOTIFY2`,
                        `bassdrive_stream_social_config`.`LINK_SPOTIFY3`,
                        `bassdrive_stream_social_config`.`LINK_ROLLDABEATS`,
                        `bassdrive_stream_social_config`.`LINK_ROLLDABEATS2`,
                        `bassdrive_stream_social_config`.`LINK_ROLLDABEATS3`,
                        `bassdrive_stream_social_config`.`LINK_YOUTUBE`,
                        `bassdrive_stream_social_config`.`LINK_YOUTUBE2`,
                        `bassdrive_stream_social_config`.`LINK_YOUTUBE3`,
                        `bassdrive_stream_social_config`.`LINK_WWW`,
                        `bassdrive_stream_social_config`.`LINK_WWW2`,
                        `bassdrive_stream_social_config`.`LINK_WWW3`,
                        `bassdrive_stream_social_config`.`DATEMODIFIED`,
                        `bassdrive_stream_social_config`.`DATECREATED`
                    FROM `bassdrive_stream_social_config`
                    WHERE `bassdrive_stream_social_config`.`ISACTIVE` = 1;';

    }

    private function return_LANG_PACKS(){

        return 'SELECT `cia00_lang_packs`.`LANGPACK_ID`,
                            `cia00_lang_packs`.`LANG_ID`,
                            `cia00_lang_packs`.`NAME`,
                            `cia00_lang_packs`.`NATIVE_NAME`,
                            `cia00_lang_packs`.`NATIVE_NAME_BLOB`,
                            `cia00_lang_packs`.`ISACTIVE`,
                            `cia00_lang_packs`.`RTL_FLAG`,
                            `cia00_lang_packs`.`FONT_SIZE_PERCENTAGE`,
                            `cia00_lang_packs`.`TIMER_FONT_SIZE_PERCENTAGE`,
                            `cia00_lang_packs`.`COPY_PADDING_TOP_PX`,
                            `cia00_lang_packs`.`DATEMODIFIED`,
                            `cia00_lang_packs`.`DATECREATED`
                        FROM `cia00_lang_packs`
                        WHERE `cia00_lang_packs`.`ISACTIVE`="1";';

    }

    private function return_NEW_OR_KEEPALIVE_SESSION($oCRNRSTN_USR, $mysqli){

        $ts = $oCRNRSTN_USR->return_query_date_time_stamp();
        if(!($this->oCRNRSTN->isset_resource('data_value', 'USER_ID', 'CRNRSTN::RESOURCE::ACCOUNT') == true)){
        //if(!$oCRNRSTN_USR->isset_data_key('USER_ID')){
            //
            // THIS IS A NEW USER. GENERATE NEW USER_ID.
            $tmp_userid = $this->oCRNRSTN->generate_new_key(50);
            $tmp_result = $this->oCRNRSTN->add_resource('USER_ID', $tmp_userid, 'CRNRSTN::RESOURCE::ACCOUNT', CRNRSTN_AUTHORIZE_SESSION, 0);
            //$oCRNRSTN_USR->set_session_param('USER_ID', $tmp_userid);

            $query = 'INSERT INTO `sessions`
                        (`SESSIONID`,
                        `SESSIONID_CRC32`,
                        `USERID`,
                        `USERID_CRC32`,
                        `REMOTE_ADDR_IPV4`,
                        `REMOTE_ADDR_IPV6`,
                        `DATEMODIFIED`)
                        VALUES
                        ("'.session_id().'",
                        "' . $this->oCRNRSTN->hash(session_id(), 'crc32').'",
                        "' . $tmp_userid.'",
                        "' . $this->oCRNRSTN->hash($tmp_userid, 'crc32').'",
                        INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        "' . $ts.'");';

        }else{

            //
            // THIS USER SESSION IS ACTIVE. RETRIEVE USER_ID FROM SESSION.
            // $tmp_userid = $oCRNRSTN_USR->get_session_param('USER_ID');
            $tmp_userid = $this->oCRNRSTN->get_resource('err_reporting_profile', 0, 'CRNRSTN::RESOURCE::CONFIGURATION');

            $query = 'UPDATE `sessions` SET `sessions`.`DATEMODIFIED`="' . $ts.'"
                    WHERE `sessions`.`SESSIONID`="' . $mysqli->real_escape_string(session_id()) . '" AND 
                    `sessions`.`SESSIONID_CRC32`="' . $this->oCRNRSTN->hash(session_id(), 'crc32') . '" AND
                    `sessions`.`USERID`="' . $mysqli->real_escape_string($tmp_userid).'" AND
                    `sessions`.`USERID_CRC32`="' . $this->oCRNRSTN->hash($tmp_userid, 'crc32').'" LIMIT 1;';
        }

        return $query;

    }

	public function __destruct(){
		
	}

}