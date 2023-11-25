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
#  CLASS :: crnrstn_query_profile_manager
#  VERSION :: 1.00.0000
#  DATE :: Thursday July 16, 2020 @ 2158hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI ::
#  DESCRIPTION :: Tell me everything that I want to know about query and CRNRSTN ::
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_query_profile_manager {

    protected $oLogger;
    public $oCRNRSTN_USR;

    protected $query_profile_serial_key = array();
    //protected $MySQLi = array();
    public $MySQLi = array();
    protected $result_handle = array();
    protected $batch_key = array();
    protected $result_set_key = array();

    public function __construct($oCRNRSTN_USR){

        try{

            if(isset($oCRNRSTN_USR)){

                $this->oCRNRSTN_USR = $oCRNRSTN_USR;

                //
                // INSTANTIATE LOGGER
                $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN_USR);

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('oCRNRSTN_USR is a required parameter for '. __METHOD__ .'.');

            }

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function loadQueryProfile($result_handle, $batch_key, $result_set_key){

        $oCRNRSTN_MySQLi = $this->oCRNRSTN_USR->return_crnrstn_mysqli();

        $tmp_query_profile_serial = $this->oCRNRSTN_USR->generate_new_key(50);
        $this->query_profile_serial_key[$tmp_query_profile_serial] = $result_set_key;

        $this->MySQLi[$tmp_query_profile_serial] = $oCRNRSTN_MySQLi;
        $this->result_handle[$tmp_query_profile_serial] = $result_handle;
        $this->batch_key[$tmp_query_profile_serial] = $batch_key;
        $this->result_set_key[$tmp_query_profile_serial] = $result_set_key;

    }

    public function returnQueryProfileSerial($result_set_key){

        try{

            # $this->query_profile_serial_key[$tmp_query_profile_serial] = $result_set_key;
            foreach($this->query_profile_serial_key as $tmp_query_profile_serial=>$loaded_result_set_key){

                //error_log('2763 query - ['.$result_set_key.']['.$loaded_result_set_key.']');
                if($result_set_key == $loaded_result_set_key){

                    return $tmp_query_profile_serial;

                }

            }

            //
            // HOOOSTON...VE HAF PROBLEM!
            throw new Exception('No query profile has been loaded via oQueryProfileMgr->loadQueryProfile() with the query result set key of "'.$result_set_key.'".');

        }catch(Exception $e){

            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function return_MySQLi($result_set_key){

        try{

            $tmp_query_profile_serial = $this->returnQueryProfileSerial($result_set_key);

            if(isset($this->MySQLi[$tmp_query_profile_serial])){

                return $this->MySQLi[$tmp_query_profile_serial];

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No mysqli database connection associated with the query result set key of "'.$result_set_key.'" could be found.');

            }

        }catch(Exception $e){

            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function isset_query_result_set_key($result_set_key){

        foreach($this->query_profile_serial_key as $tmp_query_profile_serial => $loaded_result_set_key){

            if($result_set_key == $loaded_result_set_key){

                //error_log(__LINE__ . ' query '.$result_set_key.' IS SET!');

                return true;

            }

        }

        //error_log(__LINE__ . ' query '.$result_set_key.' IS NOT SET! query_profile_serial_key='.print_r($this->query_profile_serial_key, true));
        return false;

    }

    public function return_resultHandle($result_set_key){

        try{

            $tmp_query_profile_serial = $this->returnQueryProfileSerial($result_set_key);

            if(isset($this->result_handle[$tmp_query_profile_serial])){

                return $this->result_handle[$tmp_query_profile_serial];

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No results handle associated with the query result set key of "'.$result_set_key.'" could be found.');

            }

        }catch(Exception $e){

            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function return_batchKey($result_set_key){

        $tmp_query_profile_serial = $this->returnQueryProfileSerial($result_set_key);

        try{

            if(isset($this->batch_key[$tmp_query_profile_serial])){

                return $this->batch_key[$tmp_query_profile_serial];

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No batch key associated with the query result set key of "'.$result_set_key.'" could be found.');

            }

        }catch(Exception $e){

            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }
    }

    public function __destruct(){

    }

}