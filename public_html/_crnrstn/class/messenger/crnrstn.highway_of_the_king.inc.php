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
#  CLASS :: crnrstn_highway_of_the_king
#  VERSION :: 1.00.0000
#  DATE :: September 21, 2020 @ 2230hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI ::
#  DESCRIPTION :: [EXPERIMENTAL - Saturday, October 28, 2023 @ 0220 hrs]
#                 The straightest path to email delivery...perfectly (all
#                 settings overridable) open proxy communications!
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_highway_of_the_king {

    protected $oLogger;
    private static $oCRNRSTN_USR;

    protected $proxy_cipher_override;
    protected $proxy_secret_key_override;
    protected $proxy_hmac_algorithm_override;
    protected $proxy_options_bitwise_override;

    protected $sender_email;
    protected $sender_name;
    protected $recipient_email;
    protected $recipient_name;

    protected $replyto_email_ARRAY = array();
    protected $replyto_name_ARRAY = array();
    protected $cc_email_ARRAY = array();
    protected $cc_name_ARRAY = array();
    protected $bcc_email_ARRAY = array();
    protected $bcc_name_ARRAY = array();

    public $Priority = 3;
    public $WordWrap = 72;
    public $is_HTML = false;
    public $Body;
    public $AltBody;
    public $Subject;

    public function __construct($oCRNRSTN_USR){

        self::$oCRNRSTN_n = $oCRNRSTN_USR;

    }

    public function setFrom($sender_email, $sender_name){

        $this->sender_email = $sender_email;
        $this->sender_name = $sender_name;

    }

    #1428
    public function addAddress($email, $name){

        $this->recipient_email = $email;
        $this->recipient_name = $name;

    }

    public function addReplyTo($replyto_email, $replyto_name){

        $this->replyto_email_ARRAY[] = $replyto_email;
        $this->replyto_name_ARRAY[] = $replyto_name;

    }

    #1450
    public function addCC($cc_email, $cc_name){

        $this->cc_email_ARRAY[] = $cc_email;
        $this->cc_name_ARRAY[] = $cc_name;

    }

    public function addBCC($bcc_email, $bcc_name){

        $this->bcc_email_ARRAY[] = $bcc_email;
        $this->bcc_name_ARRAY[] = $bcc_name;

    }

    public function return_cipher(){

        return $this->proxy_cipher_override;

    }

    public function return_secret_key(){

        return $this->proxy_secret_key_override;

    }

    public function return_hmac_algorithm(){

        return $this->proxy_hmac_algorithm_override;

    }

    public function return_options_bitwise(){

        return $this->proxy_options_bitwise_override;

    }

    /*
    public function send($proxy_endpoint_uri, $proxy_endpoint_auth_key, $proxy_cipher_override=NULL, $proxy_secret_key_override=NULL, $proxy_hmac_algorithm_override=NULL, $proxy_options_bitwise_override=NULL){

        $this->proxy_cipher_override = $proxy_cipher_override;
        $this->proxy_secret_key_override = $proxy_secret_key_override;
        $this->proxy_hmac_algorithm_override = $proxy_hmac_algorithm_override;
        $this->proxy_options_bitwise_override = $proxy_options_bitwise_override;

        //
        // ASSEMBLE REQUEST AND SEND
        $cc_email_str = '';
        $cc_name_str = '';
        $bcc_email_str = '';
        $bcc_name_str = '';
        $replyto_email_str = '';
        $replyto_name_str = '';

        if(isset($this->cc_email_ARRAY)){
            $tmp_cnt = sizeof($this->cc_email_ARRAY);
            for($i=0; $i<$tmp_cnt; $i++){

                $cc_email_str .= $this->cc_email_ARRAY[$i].',';
                $cc_name_str .= $this->cc_name_ARRAY[$i].',';

            }

            $cc_email_str = rtrim($cc_email_str, ',');
            $cc_name_str = rtrim($cc_name_str, ',');

        }

        if(isset($this->bcc_email_ARRAY)){
            $tmp_cnt = sizeof($this->bcc_email_ARRAY);
            for($i=0; $i<$tmp_cnt; $i++){

                $bcc_email_str .= $this->bcc_email_ARRAY[$i].',';
                $bcc_name_str .= $this->bcc_name_ARRAY[$i].',';

            }

            $bcc_email_str = rtrim($bcc_email_str, ',');
            $bcc_name_str = rtrim($bcc_name_str, ',');

        }

        if(isset($this->replyto_email_ARRAY)){
            $tmp_cnt = sizeof($this->replyto_email_ARRAY);
            for($i=0; $i<$tmp_cnt; $i++){

                $replyto_email_str .= $this->replyto_email_ARRAY[$i].',';
                $replyto_name_str .= $this->replyto_name_ARRAY[$i].',';

            }

            $replyto_email_str = rtrim($replyto_email_str, ',');
            $replyto_name_str = rtrim($replyto_name_str, ',');

        }

        //
        // NEW WILD CARD RESOURCE - FTP
        $oWCR = self::$oCRNRSTN_n->define_wildcard_resource('THE_KINGS_HIGHWAY_oGABRIEL_NOTIFICATION');
        $oWCR->addAttribute('CRNRSTN_SOAP_SVC_AUTH_KEY', $proxy_endpoint_auth_key);
        $oWCR->addAttribute('CRNRSTN_PROXY_WSDL_ENDPOINT', 'http://v2.crnrstn.evifweb.com/');
        $oWCR->addAttribute('RECIPIENT_EMAIL_COMMA_DELIM', $this->recipient_email);
        $oWCR->addAttribute('RECIPIENT_NAME_COMMA_DELIM', $this->recipient_name);
        $oWCR->addAttribute('FROM_EMAIL', $this->sender_email);
        $oWCR->addAttribute('FROM_NAME', $this->sender_name);
        $oWCR->addAttribute('REPLY_TO_EMAIL_COMMA_DELIM', $replyto_email_str);
        $oWCR->addAttribute('REPLY_TO_NAME_COMMA_DELIM', $replyto_name_str);
        $oWCR->addAttribute('CC_EMAIL_COMMA_DELIM', $cc_email_str);
        $oWCR->addAttribute('CC_NAME_COMMA_DELIM', $cc_name_str);
        $oWCR->addAttribute('BCC_EMAIL_COMMA_DELIM', $bcc_email_str);
        $oWCR->addAttribute('BCC_NAME_COMMA_DELIM', $bcc_name_str);
        $oWCR->addAttribute('MESSAGE_SUBJECT', $this->Subject);
        $oWCR->addAttribute('MESSAGE_BODY_HTML', $this->Body);
        $oWCR->addAttribute('MESSAGE_BODY_TEXT', $this->AltBody);
        $oWCR->addAttribute('WORDWRAP', $this->WordWrap);
        $oWCR->addAttribute('PRIORITY', $this->Priority);
        if($this->is_HTML){

            $oWCR->addAttribute('IS_HTML', 'true');

        }else{

            $oWCR->addAttribute('IS_HTML', 'false');

        }

        // DELETED. OBJECT ARRAY PUSH.
        //self::$oCRNRSTN_n->save_wildcard_resource($oWCR);

        $endpoint_URI = self::$oCRNRSTN_n->get_resource('CRNRSTN_PROXY_WSDL_ENDPOINT');
        return self::$oCRNRSTN_n->proxyEmailFire('THE_KINGS_HIGHWAY_oGABRIEL_NOTIFICATION', $endpoint_URI, $this);

    }
    */

    public function __destruct(){

    }

}