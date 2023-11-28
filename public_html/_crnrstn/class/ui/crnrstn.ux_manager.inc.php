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
#         AUTHOR :: Jonathan 'J5' Harris, CEO, CTO, Lead Full Stack Developer.
#            URI :: http://crnrstn.evifweb.com/
#       OVERVIEW :: CRNRSTN :: An Open Source PHP Class Library that stands on top of a robust web services oriented
#                   architecture to both facilitate, augment, and enhance (with stability) the operations of a code base
#                   for a web application across multiple hosting environments.
#
#                   Copyright (C) 2012-2023 eVifweb development.
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
#                   For example, stand on top of the CRNRSTN :: SOAP services layer to organize and strengthen the
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
#  CLASS :: crnrstn_ux_manager
#  VERSION :: 1.00.0000
#  DATE :: May 3, 2021 @ 0436hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION ::
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_ux_manager {

	protected $oLogger;
    public $oCRNRSTN_USR;

	public function __construct($oCRNRSTN_USR){

	    $this->oCRNRSTN_USR = $oCRNRSTN_USR;

	}

    public function sync_back_link_state(){

//	    $tmp_array = array();
//
        // THIS JUST R&D...BUT IS TERRIBLE. OBJECT SERIALIZATION INTO $_SESSION!!....LOL.
        // TAKE THE LINK STORED IN CURRENT POSITION AND MOVE TO BACK LINK.
//        if(!$this->oCRNRSTN_USR->isset_session_param('CRNRSTN_UI_STATE_SNAPSHOT')){
//
//            $oCRNRSTN_UI_SNAPSHOT = new crnrstn_ui_resource_state_snapshot($this->oCRNRSTN_USR);
//
//            $tmp_array[] = serialize($oCRNRSTN_UI_SNAPSHOT);
//            //$oCRNRSTN_UI_SNAPSHOT->add_uri();
//
//            $this->oCRNRSTN_USR->set_session_param('CRNRSTN_UI_STATE_SNAPSHOT', $tmp_array);
//
//        }else{
//
//            $tmp_array = $this->oCRNRSTN_USR->get_session_param('CRNRSTN_UI_STATE_SNAPSHOT');
//
//            $oCRNRSTN_UI_SNAPSHOT = new crnrstn_ui_resource_state_snapshot($this->oCRNRSTN_USR);
//
//            $tmp_array[] = serialize($oCRNRSTN_UI_SNAPSHOT);
//
//            $this->oCRNRSTN_USR->set_session_param('CRNRSTN_UI_STATE_SNAPSHOT', $tmp_array);
//
//        }

    }

	public function return_back_link(){

	    return NULL;
//
//	    $tmp_link_acquired = false;
//	    $tmp_new_array = array();
//        $tmp_array = $this->oCRNRSTN_USR->get_session_param('CRNRSTN_UI_STATE_SNAPSHOT');
//        $tmp_back_uri = '#';
//
//        $tmp_cnt = count($tmp_array);
//
//        $tmp_array = array_reverse($tmp_array);
//
//        for($i = 1; $i < $tmp_cnt; $i++){
//
//            if(!$tmp_link_acquired){
//
//                //
//                // STRIP ALL LINKS UNTIL FIND GOOD BACK LINK
//                $tmp_oCRNRSTN_UI_SNAPSHOT = unserialize($tmp_array[$i]);
//                $tmp_back_uri = $tmp_oCRNRSTN_UI_SNAPSHOT->return_current_state('URI');
//
//                if(strlen($tmp_back_uri) > 1){
//
//                    $tmp_link_acquired = true;
//
//                }
//
//            }else{
//
//                //
//                // PERSIST THIS DATA POINT IN SESSION
//                $tmp_new_array[] = $tmp_array[$i];
//
//            }
//
//        }
//
//        $tmp_array = array_reverse($tmp_new_array);
//
//        $this->oCRNRSTN_USR->set_session_param('CRNRSTN_UI_STATE_SNAPSHOT', $tmp_array);
//
//        return $tmp_back_uri;

    }

    public function __destruct(){

	}

}