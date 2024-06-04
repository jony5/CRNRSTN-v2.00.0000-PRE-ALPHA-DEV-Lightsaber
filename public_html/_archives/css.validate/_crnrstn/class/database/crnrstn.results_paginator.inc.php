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
#  CLASS :: crnrstn_results_paginator
#  VERSION :: 1.00.0000
#  DATE :: July 29, 2020 @ 1834hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: Results pagination.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_results_paginator{

    protected $oLogger;
    private static $oCRNRSTN_USR;

    protected $total_results_count = array();
    protected $maximum_results_display_count = array();
    protected $current_pagination_serial;
    protected $current_pagination_sensation = array();
    protected $pagination_protocol = array();
    protected $pagination_sensation_endpoint = array();
    protected $pagination_handle_var = array();

    public function __construct($oCRNRSTN_USR) {

        self::$oCRNRSTN_USR = $oCRNRSTN_USR;

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(self::$oCRNRSTN_USR->CRNRSTN_debugMode, __CLASS__, self::$oCRNRSTN_USR->log_silo_profile, self::$oCRNRSTN_USR);

    }

    public function return_pagination_state_HTML($pagination_serial=NULL){

        try{

            if(!isset($pagination_serial)){

                if(!isset($this->current_pagination_serial)){

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Pagination UI state HTML is being requested, but no pagination serial has been set.');

                }else{

                    //$tmp_pagination_serial = $this->current_pagination_serial;
                    $tmp_pagination_serial = self::$oCRNRSTN_USR->returnPaginationSerial();
                    $tmp_form_serial = 'crnrstn_' . self::$oCRNRSTN_USR->crcINT('pagination_sensation_form_'.$tmp_pagination_serial);
                    //$tmp_form_input = 'crnrstn_' . self::$oCRNRSTN_USR->crcINT('pagination_sensation_cell_selection');
                    $tmp_form_input = $this->get_pagination_variable_name($tmp_pagination_serial);

                    self::$oCRNRSTN_USR->init_form_handling($tmp_form_serial);
                    error_log('69 paginator - listen for paginate @ ['.$tmp_form_serial.']['.$tmp_form_input.']');
                    self::$oCRNRSTN_USR->init_input_listener($tmp_form_serial, $tmp_form_input, true);
                    #self::$oCRNRSTN_USR->injectInputSerialization($tmp_form_serial);

                    $tmp_endpoint = $this->return_pagination_endpoint();
                    $tmp_transport_protocol = $this->return_pagination_protocol();

                    //error_log('71 pagination sensation requested - input='.$tmp_form_input);
                    $tmp_requested_position = self::$oCRNRSTN_USR->get_http_resource($tmp_form_input);
                    //error_log('73 pagination sensation requested ['.$tmp_form_input.'] via ['.$tmp_transport_protocol.'] = '.$tmp_requested_position);
                    $this->set_current_pagination_position($tmp_requested_position);

                    $tmp_curr_page = $this->return_current_pagination();
                    $tmp_nxt_page = $tmp_curr_page+1;
                    $tmp_prev_page = $tmp_curr_page-1;
                    $tmp_max_display = $this->return_maximum_result_display_count();
                    $tmp_result_cnt_total = $this->return_result_count_total();
                    $pagination_form_html = $this->return_form_html($tmp_endpoint, $tmp_transport_protocol, $tmp_form_serial, $tmp_form_input);

                    $tmp_total_page_cnt = ceil($tmp_result_cnt_total/$tmp_max_display) + 1;

                    //error_log('80 pagination sensation - http['.$tmp_endpoint.']['.$tmp_transport_protocol.'] tot-page-cnt=['.$tmp_total_page_cnt.'] now-page=['.$tmp_curr_page.'] max-show['.$this->return_maximum_result_display_count().'] tot-rec=['.$this->return_result_count_total().']');

                    $pagenation_prefix = '<div class="cb_10"></div>
                    <div class="crnrstn_paginate_wrapper">
                        <div class="crnrstn_paginate_lnk_wrapper">';

                    $pagenation_postfix = '<div class="cb"></div>
                        </div>
                    </div>';

                    $tmp_cellHTML_out = '';
                    $front_half_cnt = $tmp_total_page_cnt;
                    $start_paginate = 1;
                    $start_dot = 100;
                    $end_dot = $tmp_total_page_cnt-4;

                    if($tmp_total_page_cnt < 16){
                        $start_paginate = 1;
                        $start_dot = $tmp_total_page_cnt+1;

                    }else{

                        if($tmp_total_page_cnt>16){
                            # x x x x x ... x x x
                            //$start_dot = $tmp_total_page_cnt-16;
                            $start_dot = 10;
                            $end_dot = $tmp_total_page_cnt-3;

                            if($end_dot<$start_dot){

                                $end_dot = $start_dot + 1;
                            }

                        }

                    }

                    /*

                    MAXIMUM PAGINATION LINKS SANS DOTS = 15
                    MAXIMUM PAGINATION LINKS TOTAL = 8 (5.3)
                    MINIMUM PAGINATION LINKS TRIGGER DOTS = 6, with MINIMUM OF 2 LINKS AFTER DOTS.
                    FULL COUNT =
                        * MAXIMUM PAGINATION LINKS AFTER DOTS = 3
                        * PAGINATION LINKS BEFORE DOTS = 5

                    */
                    $tmp_dot_flag = false;
                    for($i=$start_paginate; $i<$tmp_total_page_cnt; $i++){

                        if($i==$tmp_curr_page){

                            $tmp_cellHTML_out .= '<span class="crnrstn_paginate_cell crnrstn_active_pglnk">'.$i.'</span>';

                        }else{

                            if($i==$start_paginate && $tmp_curr_page>$start_paginate){

                                $tmp_cellHTML_out .= '<span class="crnrstn_paginate_cell"><a href="#" target="_self" onClick="crnrstn_'.self::$oCRNRSTN_USR->crcINT('fire_click_event').'('.$tmp_prev_page.'); return false;"><strong>&lt;</strong>&nbsp;Previous</a></span>';

                            }

                            if($i>$start_dot && !$tmp_dot_flag){
                                $tmp_dot_flag = true;
                                $tmp_cellHTML_out .= '<span class="crnrstn_paginate_cell crnrstn_pglnk_dots">&bullet;&nbsp;&bullet;&nbsp;&bullet;</span>';

                            }else{

                                if($i>$start_dot && $i<$tmp_total_page_cnt-5){


                                }else{

                                    $tmp_cellHTML_out .= '<span class="crnrstn_paginate_cell"><a href="#" target="_self" onClick="crnrstn_'.self::$oCRNRSTN_USR->crcINT('fire_click_event').'('.$i.'); return false;">'.$i.'</a></span>';

                                }

                                if($i==$tmp_total_page_cnt-1 && $tmp_curr_page<$tmp_total_page_cnt){

                                    $tmp_cellHTML_out .= '<span class="crnrstn_paginate_cell"><a href="#" target="_self" onClick="crnrstn_'.self::$oCRNRSTN_USR->crcINT('fire_click_event').'('.$tmp_nxt_page.'); return false;">Next&nbsp;<strong>&gt;</strong></a></span>';

                                }

                            }

                        }

                    }

                    return $pagenation_prefix.$tmp_cellHTML_out.$pagenation_postfix.$pagination_form_html;

                    /*
                    return '<div class="cb_10"></div>
                    <div class="crnrstn_paginate_wrapper">
                        <div class="crnrstn_paginate_lnk_wrapper">
                        <span class="crnrstn_paginate_cell"><a href="#" target="_self"><strong>&lt;</strong>&nbsp;Previous</a></span>
                            <span class="crnrstn_paginate_cell crnrstn_active_pglnk">1</span>
                            <span class="crnrstn_paginate_cell"><a href="#" target="_self">2</a></span>
                            <span class="crnrstn_paginate_cell"><a href="#" target="_self">3</a></span>
                            <span class="crnrstn_paginate_cell"><a href="#" target="_self">4</a></span>
                            <span class="crnrstn_paginate_cell"><a href="#" target="_self">5</a></span>
                            <span class="crnrstn_paginate_cell crnrstn_pglnk_dots">&bullet;&nbsp;&bullet;&nbsp;&bullet;</span>
                            <span class="crnrstn_paginate_cell"><a href="#" target="_self">25</a></span>
                            <span class="crnrstn_paginate_cell"><a href="#" target="_self">26</a></span>
                            <span class="crnrstn_paginate_cell"><a href="#" target="_self">27</a></span>
                            <span class="crnrstn_paginate_cell"><a href="#" target="_self">Next&nbsp;<strong>&gt;</strong></a></span>
                            <div class="cb"></div>
                        </div>
                    </div>';
                    */

                }

            }else{

                $tmp_pagination_serial = self::$oCRNRSTN_USR->returnPaginationSerial();
                $tmp_form_serial = 'crnrstn_'.self::$oCRNRSTN_USR->crcINT('pagination_sensation_form_'.$tmp_pagination_serial);
                $tmp_form_input = $this->get_pagination_variable_name($tmp_pagination_serial);

                self::$oCRNRSTN_USR->init_form_handling($tmp_form_serial);
                //error_log('69 paginator - listen for paginate @ ['.$tmp_form_serial.']['.$tmp_form_input.']');
                self::$oCRNRSTN_USR->init_input_listener($tmp_form_serial, $tmp_form_input, true);
                #self::$oCRNRSTN_USR->injectInputSerialization($tmp_form_serial);

                $tmp_endpoint = $this->return_pagination_endpoint();
                $tmp_transport_protocol = $this->return_pagination_protocol();

                //error_log('71 pagination sensation requested - input='.$tmp_form_input);
                $tmp_requested_position = self::$oCRNRSTN_USR->get_http_resource($tmp_form_input);
                //error_log('73 pagination sensation requested ['.$tmp_form_input.'] via ['.$tmp_transport_protocol.'] = '.$tmp_requested_position);
                $this->set_current_pagination_position($tmp_requested_position);

                $tmp_curr_page = $this->return_current_pagination();
                $tmp_nxt_page = $tmp_curr_page+1;
                $tmp_prev_page = $tmp_curr_page-1;
                $tmp_max_display = $this->return_maximum_result_display_count();
                $tmp_result_cnt_total = $this->return_result_count_total();
                $pagination_form_html = $this->return_form_html($tmp_endpoint, $tmp_transport_protocol, $tmp_form_serial, $tmp_form_input);

                $tmp_total_page_cnt = ceil($tmp_result_cnt_total/$tmp_max_display);

                //error_log('80 pagination sensation - http['.$tmp_endpoint.']['.$tmp_transport_protocol.'] tot-page-cnt=['.$tmp_total_page_cnt.'] now-page=['.$tmp_curr_page.'] max-show['.$this->return_maximum_result_display_count().'] tot-rec=['.$this->return_result_count_total().']');

                $pagenation_prefix = '<div class="cb_10"></div>
                    <div class="crnrstn_paginate_wrapper">
                        <div class="crnrstn_paginate_lnk_wrapper">';

                $pagenation_postfix = '<div class="cb"></div>
                        </div>
                    </div>';

                $tmp_cellHTML_out = '';
                for($i=1; $i<$tmp_total_page_cnt+1; $i++){

                    if($i==1 && $tmp_curr_page>1){

                        $tmp_cellHTML_out .= '<span class="crnrstn_paginate_cell"><a href="#" target="_self" onClick="crnrstn_'.self::$oCRNRSTN_USR->crcINT('fire_click_event').'('.$tmp_prev_page.'); return false;"><strong>&lt;</strong>&nbsp;Previous</a></span>';

                    }else{

                        if($i==1){

                            //$tmp_cellHTML_out .= '<span class="crnrstn_paginate_cell"><strong>&lt;</strong>&nbsp;Previous</span>';

                        }

                    }

                    if($i==$tmp_curr_page){

                        $tmp_cellHTML_out .= '<span class="crnrstn_paginate_cell crnrstn_active_pglnk">'.$i.'</span>';

                    }else{

                        $tmp_cellHTML_out .= '<span class="crnrstn_paginate_cell"><a href="#" target="_self" onClick="crnrstn_'.self::$oCRNRSTN_USR->crcINT('fire_click_event').'('.$i.'); return false;">'.$i.'</a></span>';

                    }

                    if($i==$tmp_total_page_cnt && $tmp_curr_page<$tmp_total_page_cnt){

                        $tmp_cellHTML_out .= '<span class="crnrstn_paginate_cell"><a href="#" target="_self" onClick="crnrstn_'.self::$oCRNRSTN_USR->crcINT('fire_click_event').'('.$tmp_nxt_page.'); return false;">Next&nbsp;<strong>&gt;</strong></a></span>';

                    }else{

                        if($i==$tmp_total_page_cnt){

                            //$tmp_cellHTML_out .= '<span class="crnrstn_paginate_cell">Next&nbsp;<strong>&gt;</strong></span>';

                        }
                    }
                }

                return $pagenation_prefix.$tmp_cellHTML_out.$pagenation_postfix.$pagination_form_html;

                /*
                return '<div class="cb_10"></div>
                    <div class="crnrstn_paginate_wrapper">
                        <div class="crnrstn_paginate_lnk_wrapper">
                        <span class="crnrstn_paginate_cell"><a href="#" target="_self"><strong>&lt;</strong>&nbsp;Previous</a></span>
                            <span class="crnrstn_paginate_cell crnrstn_active_pglnk">1</span>
                            <span class="crnrstn_paginate_cell"><a href="#" target="_self">2</a></span>
                            <span class="crnrstn_paginate_cell"><a href="#" target="_self">3</a></span>
                            <span class="crnrstn_paginate_cell"><a href="#" target="_self">4</a></span>
                            <span class="crnrstn_paginate_cell"><a href="#" target="_self">5</a></span>
                            <span class="crnrstn_paginate_cell crnrstn_pglnk_dots">&bullet;&nbsp;&bullet;&nbsp;&bullet;</span>
                            <span class="crnrstn_paginate_cell"><a href="#" target="_self">25</a></span>
                            <span class="crnrstn_paginate_cell"><a href="#" target="_self">26</a></span>
                            <span class="crnrstn_paginate_cell"><a href="#" target="_self">27</a></span>
                            <span class="crnrstn_paginate_cell"><a href="#" target="_self">Next&nbsp;<strong>&gt;</strong></a></span>
                            <div class="cb"></div>
                        </div>
                    </div>';

                */

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }
    }

    public function add_pagination_passthrough_input_val($input_name, $input_value, $pagination_serial){

        $tmp_form_serial = 'crnrstn_'.self::$oCRNRSTN_USR->crcINT('pagination_sensation_form_'.$pagination_serial);
        //error_log('274 pagination - ['.$tmp_form_serial.']['.$input_name.']['.$input_value.']');
        self::$oCRNRSTN_USR->addHiddenFormInputParamListener($tmp_form_serial, $input_name, $input_name, true, $input_value);

    }

    private function return_form_html($tmp_endpoint, $tmp_transport_protocol, $tmp_form_serial, $tmp_form_input){

        $tmp_form_html = '<form action="'.$tmp_endpoint.'" method="'.$tmp_transport_protocol.'" name="'.$tmp_form_serial.'" id="'.$tmp_form_serial.'"  enctype="multipart/form-data" >
        <input type="hidden" name="'.$tmp_form_input.'" id="'.$tmp_form_input.'" value="">
        '.self::$oCRNRSTN_USR->ui_content_module_out(CRNRSTN_UI_FORM_INTEGRATION_PACKET, $tmp_form_serial).'
        </form>
        <script>
        //<!--
        
        function ugc_search_sync(){
            
            var input_handle = document.getElementById("'.$tmp_form_input.'");
            input_handle.value = 1;
            
            var form_handle = document.getElementById("'.$tmp_form_serial.'");
            form_handle.submit();
            
        }
            
         function crnrstn_'.self::$oCRNRSTN_USR->crcINT('fire_click_event').'(pagination_index){
         
            var input_handle = document.getElementById("'.$tmp_form_input.'");
            input_handle.value = pagination_index;
             
            var form_handle = document.getElementById("'.$tmp_form_serial.'");
            form_handle.submit();
            
         }
         
        //-->
        </script>
        ';

        return $tmp_form_html;

    }

    public function get_pagination_variable_name($pagination_serial=NULL){

        try{

            if(!isset($pagination_serial)){

                if(!isset($this->current_pagination_serial)){

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Pagination variable name is being requested, but no pagination serial has been set.');

                }else{

                    return $this->pagination_handle_var[$this->current_pagination_serial];

                }

            }else{

                if(!isset($this->pagination_handle_var[$pagination_serial])){

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Pagination variable name is being requested, but the provided pagination serial, "'.$pagination_serial.'", has not been set.');

                }else{

                    return $this->pagination_handle_var[$pagination_serial];

                }

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function specify_pagination_variable_name($variable_name, $pagination_serial=NULL){

        if(!isset($pagination_serial)){

            if(!isset($this->current_pagination_serial)){

                $this->current_pagination_serial = self::$oCRNRSTN_USR->generate_new_key();
                $this->pagination_handle_var[$this->current_pagination_serial] = $variable_name;

            }else{

                $this->pagination_handle_var[$this->current_pagination_serial] = $variable_name;

            }

        }else{

            $this->pagination_handle_var[$pagination_serial] = $variable_name;

        }

    }

    public function set_pagination_endpoint($form_action_endpoint_uri, $pagination_serial=NULL){

        if(!isset($pagination_serial)){

            if(!isset($this->current_pagination_serial)){

                $this->current_pagination_serial = self::$oCRNRSTN_USR->generate_new_key();
                $this->pagination_sensation_endpoint[$this->current_pagination_serial] = $form_action_endpoint_uri;

            }else{

                $this->pagination_sensation_endpoint[$this->current_pagination_serial] = $form_action_endpoint_uri;

            }

        }else{

            $this->pagination_sensation_endpoint[$pagination_serial] = $form_action_endpoint_uri;

        }

    }

    public function return_pagination_endpoint($pagination_serial=NULL){

        try{

            if(!isset($pagination_serial)) {

                if (!isset($this->current_pagination_serial)) {

                    $this->current_pagination_serial = self::$oCRNRSTN_USR->generate_new_key();
                    $this->pagination_sensation_endpoint[$this->current_pagination_serial] = '#';

                }else{

                    if(!isset($this->pagination_sensation_endpoint[$this->current_pagination_serial])){

                        $this->pagination_sensation_endpoint[$this->current_pagination_serial] = '#';

                    }

                }

                return $this->pagination_sensation_endpoint[$this->current_pagination_serial];

            }else{

                if(!isset($this->pagination_sensation_endpoint[$pagination_serial])){

                    $this->pagination_sensation_endpoint[$pagination_serial] = '#';

                }

                return $this->pagination_sensation_endpoint[$pagination_serial];

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function set_pagination_protocol($transport_protocol='get', $pagination_serial=NULL){

        $http_transport_protocol = $transport_protocol;
        $http_transport_protocol = self::$oCRNRSTN_USR->string_sanitize($http_transport_protocol, 'http_protocol_simple');

        if(!isset($pagination_serial)){

            if(!isset($this->current_pagination_serial)){

                $this->current_pagination_serial = self::$oCRNRSTN_USR->generate_new_key();
                $this->pagination_protocol[$this->current_pagination_serial] = $http_transport_protocol;

            }else{

                $this->pagination_protocol[$this->current_pagination_serial] = $http_transport_protocol;

            }

        }else{

            $this->pagination_protocol[$pagination_serial] = $http_transport_protocol;

        }

    }

    public function return_pagination_protocol($pagination_serial=NULL){

        if(!isset($pagination_serial)){

            if(!isset($this->current_pagination_serial)){

                $this->current_pagination_serial = self::$oCRNRSTN_USR->generate_new_key();
                $this->pagination_protocol[$this->current_pagination_serial] = 'get';

            }else{

                if(!isset($this->pagination_protocol[$this->current_pagination_serial])){

                    $this->pagination_protocol[$this->current_pagination_serial] = 'get';

                }

            }

            return $this->pagination_protocol[$this->current_pagination_serial];

        }else{

            if(!isset($this->pagination_protocol[$pagination_serial])){

                $this->pagination_protocol[$pagination_serial] = 'get';

            }

            return $this->pagination_protocol[$pagination_serial];

        }
    }

    public function set_current_pagination_position($page_number, $pagination_serial = NULL){

        if(!isset($pagination_serial)){

            if(!isset($this->current_pagination_serial)){

                $this->current_pagination_serial = self::$oCRNRSTN_USR->generate_new_key();
                $this->current_pagination_sensation[$this->current_pagination_serial] = $page_number;

            }else{

                $this->current_pagination_sensation[$this->current_pagination_serial] = $page_number;

            }

        }else{

            $this->current_pagination_sensation[$pagination_serial] = $page_number;

        }

    }

    public function return_current_pagination($pagination_serial=NULL){

        try{

            if(!isset($pagination_serial)){

                if(!isset($this->current_pagination_serial)){

                    $this->current_pagination_serial = self::$oCRNRSTN_USR->generate_new_key();
                    $this->current_pagination_sensation[$this->current_pagination_serial] = 1;

                }else{

                    if(!isset($this->current_pagination_sensation[$this->current_pagination_serial])){

                        $this->current_pagination_sensation[$this->current_pagination_serial] = 1;

                    }

                }

                return $this->current_pagination_sensation[$this->current_pagination_serial];

            }else{

                if(!isset($this->current_pagination_sensation[$pagination_serial])) {

                    $this->current_pagination_sensation[$pagination_serial] = 1;

                }

                return $this->current_pagination_sensation[$pagination_serial];

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function return_maximum_result_display_count($pagination_serial=NULL){

        try{

            if(!isset($pagination_serial)){

                if(!isset($this->current_pagination_serial)){

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Pagination result set maximum display count is being requested, but no pagination serial has been set or even incremented one time.');

                }else{

                    if(!isset($this->maximum_results_display_count[$this->current_pagination_serial])){

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Pagination maximum result set display count is being requested, but this value not been initialized for the serial ['.$this->current_pagination_serial.'].');

                    }else{

                        return $this->maximum_results_display_count[$this->current_pagination_serial];

                    }

                }

            }else{

                if(!isset($this->maximum_results_display_count[$pagination_serial])){

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Pagination maximum result set display count is being requested, but this value not been initialized for the serial ['.$pagination_serial.'].');

                }else{

                    return $this->maximum_results_display_count[$pagination_serial];

                }

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function set_maximum_display_result_count($maximum_display_count, $pagination_serial=NULL){

        try{

            if(!isset($pagination_serial)){

                if(!isset($this->current_pagination_serial)){

                    $this->current_pagination_serial = self::$oCRNRSTN_USR->generate_new_key();
                    $this->maximum_results_display_count[$this->current_pagination_serial] = $maximum_display_count;

                }else{

                    $this->maximum_results_display_count[$this->current_pagination_serial] = $maximum_display_count;

                }

            }else{

                $this->maximum_results_display_count[$pagination_serial] = $maximum_display_count;

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        return NULL;

    }

    public function increment_results_count_total($result_count=1, $pagination_serial=NULL){

        if(!isset($pagination_serial)){

            if(!isset($this->current_pagination_serial)){

                $this->current_pagination_serial = self::$oCRNRSTN_USR->generate_new_key();
                $this->total_results_count[$this->current_pagination_serial] = $result_count;

            }else{

                if(!isset($this->total_results_count[$this->current_pagination_serial])){

                    $this->total_results_count[$this->current_pagination_serial] = $result_count;

                }else{

                    $this->total_results_count[$this->current_pagination_serial] += $result_count;

                }
            }

        }else{

            if(!isset($this->total_results_count[$pagination_serial])){

                $this->total_results_count[$pagination_serial] = $result_count;

            }else{

                $this->total_results_count[$pagination_serial] += $result_count;
            }
        }
    }

    public function set_results_count_total($results_count, $pagination_serial=NULL){

        if(!isset($pagination_serial)){

            if(!isset($this->total_results_count)){

                $this->current_pagination_serial = self::$oCRNRSTN_USR->generate_new_key();
                $this->total_results_count[$this->current_pagination_serial] = $results_count;

            }else{

                $this->total_results_count[$this->current_pagination_serial] = $results_count;

            }

        }else{

            $this->total_results_count[$pagination_serial] = $results_count;

        }

    }

    public function return_pagination_serial(){

        try{

            if(!isset($this->current_pagination_serial)){

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('The pagination serial is being requested, but this value has not been set.');

            }else{

                return $this->current_pagination_serial;

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }
    }

    public function return_result_count_total($pagination_serial=NULL){

        try{

            if(!isset($pagination_serial)){

                if(!isset($this->current_pagination_serial)){

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Pagination result set total is being requested, but no pagination serial has been set or even incremented one time.');

                }else{

                    if(!isset($this->total_results_count[$this->current_pagination_serial])){

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Pagination result set total is being requested, but total results count not been initialized or even incremented one time for the serial ['.$this->current_pagination_serial.'].');

                    }else{

                        return $this->total_results_count[$this->current_pagination_serial];

                    }
                }

            }else{

                if(!isset($this->total_results_count[$pagination_serial])){

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Pagination result set total is being requested, but total results count not been initialized for the serial ['.$pagination_serial.'].');

                }else{

                    return $this->total_results_count[$pagination_serial];

                }
            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function __destruct() {


    }
}