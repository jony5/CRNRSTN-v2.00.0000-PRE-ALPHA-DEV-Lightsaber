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
#  CLASS :: crnrstn_database_sql_silo
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  VERSION :: 1.00.0000
#  DATE :: July 4, 2020 @ 1620hrs
#  DESCRIPTION ::
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
class crnrstn_database_sql_silo {

    protected $oLogger;
    private static $oCRNRSTN_USR;

	public function __construct($oCRNRSTN_USR) {

        self::$oCRNRSTN_USR = $oCRNRSTN_USR;

		// 
		// INSTANTIATE LOGGER
		$this->oLogger = new crnrstn_logging(self::$oCRNRSTN_USR->CRNRSTN_debugMode, __CLASS__, self::$oCRNRSTN_USR->log_silo_profile, self::$oCRNRSTN_USR);

	}

    # $oCRNRSTN_USR->addDatabaseQuery('TRANSLATION_DATA','!jesus_is_my_dear_lord!','LANG_PACKS');
    public function returnDatabaseQuery($oCRNRSTN_USR, $oCRNRSTN_MySQLi, $result_set_key){

        return $this->returnQuery($oCRNRSTN_USR, $oCRNRSTN_MySQLi, $result_set_key);

    }

    private function returnQuery($oCRNRSTN_USR, $oCRNRSTN_MySQLi, $result_set_key){

        $mysqli = $oCRNRSTN_MySQLi->returnConnObject();

        try{

            switch($result_set_key){
                case 'LANG_PACKS':
                    $query = 'SELECT `cia00_lang_packs`.`LANGPACK_ID`,
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

                break;
                case 'NEW_OR_KEEPALIVE_SESSION':

                    $ts = $oCRNRSTN_USR->return_queryDateTimeStamp();

                    if(!$oCRNRSTN_USR->isset_session_param('USER_ID')){

                        //
                        // THIS IS A NEW USER. GENERATE NEW USER_ID.
                        $tmp_userid = $oCRNRSTN_USR->generate_new_key(50);
                        $oCRNRSTN_USR->set_session_param('USER_ID', $tmp_userid);

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
                        "'.$oCRNRSTN_USR->crcINT(session_id()).'",
                        "'.$tmp_userid.'",
                        "'.$oCRNRSTN_USR->crcINT($tmp_userid).'",
                        INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        "'.$ts.'");
                        ';

                    }else{

                        //
                        // THIS USER SESSION IS ACTIVE. RETRIEVE USER_ID FROM SESSION.
                        $tmp_userid = $oCRNRSTN_USR->get_session_param('USER_ID');

                        $query = 'UPDATE `sessions` SET `sessions`.`DATEMODIFIED`="'.$ts.'" 
                                WHERE `sessions`.`SESSIONID`="' . $mysqli->real_escape_string(session_id()) . '" AND 
								`sessions`.`SESSIONID_CRC32`="' . $oCRNRSTN_USR->crcINT(session_id()) . '" AND
								`sessions`.`USERID`="'.$mysqli->real_escape_string($tmp_userid).'" AND 
								`sessions`.`USERID_CRC32`="'.$oCRNRSTN_USR->crcINT($tmp_userid).'" LIMIT 1;';
                    }

                    //$oCRNRSTN_USR->create_AdHocVar('USER_ID', $tmp_userid);
                    //$tmp_userid = $oCRNRSTN_USR->get_AdHocVar('USER_ID');

                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('No query has been configured able to be loaded from the result set key ['.$result_set_key.'].');

                break;
            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        //
        // RETURN QUERY
        return $query;

    }

	public function __destruct() {
		
	}
}