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
#  CLASS :: crnrstn_ui_html_manager
#  VERSION :: 1.00.0000
#  DATE :: May 1, 2021 @ 1219hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: Support for generation of CRNRSTN :: support web content.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_ui_html_manager {

	protected $oLogger;
    protected $oCRNRSTN_USR;
    protected $oCRNRSTN_UI_ASSEMBLER;

    public $page_serial;

	public function __construct($oCRNRSTN_USR){

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging($oCRNRSTN_USR->CRNRSTN_debugMode, __CLASS__, $oCRNRSTN_USR->log_silo_profile, $oCRNRSTN_USR);

        //
        // PAGE CONTENT AGGREGATION
        $this->oCRNRSTN_UI_ASSEMBLER = new crnrstn_ui_content_assembler($oCRNRSTN_USR);
        $this->oCRNRSTN_UI_ASSEMBLER->initializePageContent();
        //$this->oCRNRSTN_UI_ASSEMBLER->loadPage();
        //$this->oCRNRSTN_UI_ASSEMBLER->indexPage();
        $this->page_serial = $this->oCRNRSTN_UI_ASSEMBLER->returnPageSerial();

        $channel_selected_ARRAY = $oCRNRSTN_USR->return_set_bits($oCRNRSTN_USR->system_output_channel_constants);
        $tmp_sel_cnt = count($channel_selected_ARRAY);

        //
        // MAINTAIN INTEGRITY OF DEVICE DETECTION SITUATION
        if( $tmp_sel_cnt == 0 || $tmp_sel_cnt > 1){

            //
            // SET (OR RESET) THIS DATA. THERE SHOULD ALWAYS AND ONLY BE ONE.
            $tmp_bit = $oCRNRSTN_USR->sync_device_detected();
            error_log(__LINE__ . ' ui html sync_device_detected() $tmp_bit=' . print_r($tmp_bit, true));

        }

        $this->oCRNRSTN_USR = $oCRNRSTN_USR;

	}

    public function out_ui_html_doc_mit_license(){

        $tmp_str = '';

        $filepath = '/_crnrstn/ui/docs/pages/mit_license.php';

        include(CRNRSTN_ROOT . $filepath);

        return $tmp_str;

    }

	public function out_ui_html_doc_signin(){

        $tmp_str = '';

        $filepath = '/_crnrstn/ui/docs/pages/signin.php';

        include(CRNRSTN_ROOT . $filepath);

        return $tmp_str;

    }

    public function out_ui_html_doc_css_validator(){

        $tmp_str = '';

        $filepath = '/_crnrstn/ui/docs/pages/css_validator.php';

        include(CRNRSTN_ROOT . $filepath);

        return $tmp_str;

    }

    public function out_ui_html_doc_css_validator_profile(){

        $tmp_str = '';

        $filepath = '/_crnrstn/ui/docs/pages/css_validator_profile.php';

        include(CRNRSTN_ROOT . $filepath);

        return $tmp_str;

    }

    public function out_ui_html_doc_dashboard(){

        $tmp_str = '';

        $filepath = '/_crnrstn/ui/docs/pages/dashboard.php';

        include(CRNRSTN_ROOT . $filepath);

        return $tmp_str;

    }

    public function out_ui_html_doc_config_wordpress(){

        $tmp_str = '';

        $filepath = '/_crnrstn/ui/docs/pages/config_wordpress.php';

        include(CRNRSTN_ROOT . $filepath);

        return $tmp_str;

    }

	public function __destruct() {

	}
}