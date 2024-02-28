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
#                   CRNRSTN :: is powered by eVifweb; CRNRSTN :: is powered by eCRM Strategy and Execution,
#                   Web Design & Development, and Only The Best Coffee.
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
#  CLASS :: crnrstn_wildcard_resource
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  VERSION :: 1.00.0000
#  DATE :: Monday, Sept 7, 2020 @ 1539hrs
#  DESCRIPTION :: This is version 1.0 of the CRNRSTN :: Decoupled Data
#                 Object (DDO). This now stands on the DDO.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_wildcard_resource {

    public $oCRNRSTN;
    protected $oDataTransportLayer;

    protected $env_key;
    protected $data_type_family;
    protected $data_authorization_profile;
    protected $attribute_key_ARRAY = array();
    protected $attribute_datatype_ARRAY = array();
    protected $attribute_set_flag_ARRAY = array();

    public $is_active;

    public function __construct($resource_key, $oCRNRSTN, $data_authorization_profile = CRNRSTN_AUTHORIZE_RUNTIME, $is_active = true){

        $this->oCRNRSTN = $oCRNRSTN;

        $data_type_family = $resource_key;

        $this->is_active = $is_active;

        $this->data_type_family = $data_type_family;
        $this->data_authorization_profile = $data_authorization_profile;
        $this->oCRNRSTN->oLog_output_ARRAY[] = $this->oCRNRSTN->error_log('Instantiating a ' . $data_type_family . ' wild card resource for the ' . $this->env_key . ' environment.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

        //
        // Wednesday, May 24, 2023 @ 2356 hrs.
        // BEFORE CRNRSTN :: LIGHTSABER PROMOTED THE DECOUPLED DATA OBJECT (DDO) TO
        // SERVE AS THE FOUNDATION FOR THE CRNRSTN :: DATA STORAGE LAYER TO PROVIDE
        // FAST, EFFICIENT, AND DATA TYPE ACCURATE STORAGE AND RETRIEVAL OF
        // APPLICATION CONFIGURATION DATA...
        //
        // THE CRNRSTN :: DDO WAS FIRST USED HERE IN THE CRNRSTN :: WILD CARD
        // RESOURCE (WCR) OBJECT TO FIX BUGS THAT WERE SHOWING UP WITH CERTAIN KINDS
        // OF DATA TYPES THAT WERE SHOWING UP IN CONFIGURATION DATA SUCH AS NULL AND
        // STRINGS THAT HAVE A LENGTH OF ZERO.
        //
        // WHEN THE CRNRSTN :: DDO FIRST CAME UP IN THE CRNRSTN :: WCR, IT WAS LIKE,
        // "WOW!" AND "AMAZING!"
        //
        // THE DDO WAS PROMOTED TO BE *THE* CRNRSTN :: DATA STORAGE OBJECT FOR
        // ALL CONFIGURATION WITHIN LIGHTSABER IN Q1 OF 2023.
        //
        // IN Q2 OF 2023, THE DDO WAS MODIFIED TO HAND THE STORAGE OF THE DDO
        // CACHE DATA TO THE RESPONSE RETURN SERIALIZATION MAP OBJECT FOR MULTI-
        // CHANNEL CRNRSTN :: PLAID INTEGRATIONS ACROSS THE ENTIRE APPLICATION.
        //$this->oDataTransportLayer = new crnrstn_decoupled_data_object(self::$oCRNRSTN_n, $this->resource_key, 'WCR_RESOURCE_KEY');

    }

    public function return_resource_key(){

        return $this->data_type_family;

    }

    public function add_attribute($data_key, $data_value, $data_type_family = 'CRNRSTN::RESOURCE::WCR', $index = NULL, $data_authorization_profile = CRNRSTN_AUTHORIZE_RUNTIME, $ttl = 60){

        //
        // TODO :: TEST SUPPORT FOR N+1 WCR WITH SAME $data_type_family (I.E. resource_key).
        if($this->is_active !== true){

            //
            // ABORT ALL WRITES IF WCR IS NOT ACTIVE.
            // ENVIRONMENTAL MISMATCH (FROM THE DETECTED ENVIRONMENT) WILL RESULT IN $is_active = FALSE.
            return true;

        }

        if(!isset($data_type_family)){

            $data_type_family = $this->data_type_family;

        }

        $this->oCRNRSTN->error_log('Receiving wild card resource (WCR) data, ' . $data_key . ' with the data type family of ' . $data_type_family . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

        $this->oCRNRSTN->save_wildcard_resource($this);

        //
        // INPUT THE DATA VALUE INTO THE CRNRSTN :: MULTI-CHANNEL RRS MAP...SITUATION.
        return $this->oCRNRSTN->input_data_value($data_value, $data_key, $data_type_family . '::' . $this->data_type_family, $index, $data_authorization_profile, $ttl);

        //
        // HERE IS THE ORIGINAL WILD CARD RESOURCE DATA STORAGE ARCHITECTURE WHICH
        // PRECEDED CRNRSTN :: LIGHTSABER, AND WHERE, public function add_attribute($attribute_value, $attribute_key){}.
        //$attribute_key_hash = $this->oCRNRSTN->hash($attribute_key);
        //$this->attribute_key_ARRAY[$this->oCRNRSTN->env_key('hash')][$attribute_key_hash] = $attribute_value;
        //$this->attribute_set_flag_ARRAY[$this->oCRNRSTN->env_key('hash')][$attribute_key_hash] = 1;

    }

    public function isset_WCR($WCR_key, $data_key, $data_type_family = 'CRNRSTN::RESOURCE::WCR', $channel = NULL, $index = NULL){

        //
        // CHECK DATA STORAGE LAYER FOR ISSET.
        return $this->oCRNRSTN->isset_resource('data_value', $data_key, $data_type_family . '::' . $WCR_key, $channel, $index);

        //
        // HERE IS THE ORIGINAL WILD CARD RESOURCE DATA STORAGE ARCHITECTURE WHICH
        // PRECEDED CRNRSTN :: LIGHTSABER.
//        $tmp_wc_key_hash = $this->oCRNRSTN->hash($WCR_key);
//        $attribute_key_hash = $this->oCRNRSTN->hash($attribute_key);
//
//        if(isset($this->attribute_set_flag_ARRAY[$tmp_wc_key_hash][$attribute_key_hash])){
//
//            return true;
//
//        }else{
//
//            return false;
//
//        }

    }

    // USED IN CONTEXT OF "GET A VALUE".
    public function get_attribute($wildCardKey, $data_key, $data_type_family = 'CRNRSTN::RESOURCE::WCR', $index = NULL, $channel = NULL){

        return $this->oCRNRSTN->get_config_cache('data_value', $data_key, $data_type_family . '::' . $wildCardKey, $index, $channel);

        //
        // Wednesday, May 24, 2023 @ 2356 hrs.
        // HERE IS THE ORIGINAL WILD CARD RESOURCE DATA STORAGE ARCHITECTURE WHICH
        // PRECEDED THE DDO BEHIND CRNRSTN :: LIGHTSABER.
        // WHERE, public function get_attribute($wildCardKey, $attribute_key, $soap_transport = false){
//        //
//        // THROWING AN EXCEPTION HERE CAN CAUSE ETERNAL LOOP.
//        //try{
//        $tmp_wc_key_hash = $this->oCRNRSTN->hash($wildCardKey);
//        $attribute_key_hash = $this->oCRNRSTN->hash($attribute_key);
//
//        if($soap_transport == true){
//
//            //error_log(__LINE__ . ' env - [' . $wildCardKey . '] ' . $attribute_key);
//            $tmp_data_type = strtolower($this->get_data_type($wildCardKey, $attribute_key));
//            $tmp_data = $this->attribute_key_ARRAY[$tmp_wc_key_hash][$attribute_key_hash];
//            //error_log(__LINE__ . ' env - [' . $tmp_data_type . '] ' . $tmp_data);
//
//            switch($tmp_data_type){
//                case 'bool':
//                case 'boolean':
//
//                    if($tmp_data == true){
//
//                        error_log(__METHOD__ . ' ' . __LINE__ . ' TRACE THIS BOOLEAN REFACTOR [STRING ==> INT(1)] TO THE CRNRSTN :: SOAP SERVICES LAYER...AND THEN DELETE THIS TRACE.');
//                        return 1;
//
//                    }else{
//
//                        error_log(__METHOD__ . ' ' . __LINE__ . ' TRACE THIS BOOLEAN REFACTOR [STRING ==> INT(0)] TO THE CRNRSTN :: SOAP SERVICES LAYER...AND THEN DELETE THIS TRACE.');
//                        return 0;
//
//                    }
//
//                break;
//                default:
//
//                    return $tmp_data;
//
//                break;
//
//            }
//
//        }else{
//
//            /*
//
//            $env_key_hash = $this->oCRNRSTN->hash($this->data_type_family);
//            $attribute_key_hash = $this->oCRNRSTN->hash($attribute_key);
//
//            $this->oDataTransportLayer->add($attribute_value, $attribute_key);
//            $this->attribute_key_ARRAY[$env_key_hash][$attribute_key_hash] = $attribute_value;
//             * */
//
//            //if(isset($this->attribute_key_ARRAY[$tmp_wc_key_hash][$attribute_key_hash])){
//
//                //
//                // FULL CONVERSION TO DDO :: Tuesday, April 20, 2021 1254hrs
//                // "Cause I don't send my music to no garbage DJs
//                // They get me." - KRS ONE
//                // SOURCE :: https://www.youtube.com/watch?v=fTmDeRsS9to
//                // TITLE :: Krs One - Mad Crew
//
//                return $this->oDataTransportLayer;
//
//            //}else{
//
//            //    error_log(__LINE__ .' env die() ['.$tmp_wc_key_hash.']['.$attribute_key_hash.'] attribute_key_ARRAY='.print_r($this->attribute_key_ARRAY, true));
//
//            //    die();
//                //
//                // HOOOSTON...VE HAF PROBLEM!
//                //throw new Exception('An unknown wild card resource by attribute key, "'.$attribute_key.'" and by wild card key '.$wildCardKey.' has been requested.');
//            //    $this->oCRNRSTN->error_log('An unknown wild card resource by wild card key '.$wildCardKey.' and by attribute key, "'.$attribute_key.'" has been requested.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
//
//           //     return false;
//
//            //}
//
//        }

    }

    public function get_data_type($wildCardKey, $attribute_key){

        //
        // THROWING AN EXCEPTION HERE CAN CAUSE ETERNAL LOOP.
        //try{

        $tmp_wc_key_hash = $this->oCRNRSTN->hash($wildCardKey);
        $attribute_key_hash = $this->oCRNRSTN->hash($attribute_key);

        if(isset($this->attribute_key_ARRAY[$tmp_wc_key_hash][$attribute_key_hash])){

            if(isset($this->attribute_datatype_ARRAY[$tmp_wc_key_hash][$attribute_key_hash])){

                return $this->attribute_datatype_ARRAY[$tmp_wc_key_hash][$attribute_key_hash];

            }else{

                $tmp_data = $this->attribute_key_ARRAY[$tmp_wc_key_hash][$attribute_key_hash];

                $this->attribute_datatype_ARRAY[$tmp_wc_key_hash][$attribute_key_hash] = gettype($tmp_data);

                return $this->attribute_datatype_ARRAY[$tmp_wc_key_hash][$attribute_key_hash];

            }

        }else{

            //
            // HOOOSTON...VE HAF PROBLEM!
            //throw new Exception('An unknown wild card resource by attribute key, "' . $attribute_key . '" and by wild card key ' . $wildCardKey . ' has been requested.');
            $this->oCRNRSTN->error_log('Data type for an unknown wild card resource by wild card key "' . $wildCardKey . '" and attribute key, "' . $attribute_key . '" has been requested.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

            return NULL;

        }

    }

    public function __destruct(){

    }

}