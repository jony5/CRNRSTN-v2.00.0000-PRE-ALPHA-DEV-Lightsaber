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
#       Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated
#       documentation files (the "Software"), to deal in the Software without restriction, including without limitation
#       the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software,
#       and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
#
#       The above copyright notice and this permission notice shall be included in all copies or substantial portions
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
#  CLASS :: crnrstn_data_tunnel_services_manager
#  VERSION :: 1.00.0000
#  DATE :: September 16, 2022 @ 0503 hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: High level management of transmitted data for CRNRSTN :: LIGHTSABER.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_data_tunnel_services_manager{

    protected $oLogger;
    public $oCRNRSTN;

    protected $pssdtl_packet_hash;
    protected $crnrstn_pssdtl_http_tunneled_data_ARRAY = array();
    protected $pssdtl_packet_profile_ARRAY = array();

    public function __construct($oCRNRSTN){

        $this->oCRNRSTN = $oCRNRSTN;

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN);

    }

    public function http_data_services_validation(){

        /*
        form_input_add()
        CRNRSTN_FIELD_INPUT_NAME
        CRNRSTN_FIELD_INPUT_ID
        DEFAULT_VALUE
        TABLE_FIELD_NAME
        VALIDATION_CONSTANTS_PROFILE

        form_hidden_input_add()
        CRNRSTN_FIELD_HIDDEN_INPUT_NAME
        CRNRSTN_FIELD_HIDDEN_INPUT_ID
        DEFAULT_VALUE
        TABLE_FIELD_NAME
        VALIDATION_CONSTANT_PROFILE
        IS_ENCRYPTED

        form_input_feedback_copy_add()
        VALIDATION_PROFILE
        CRNRSTN_FIELD_INPUT_NAME
        CRNRSTN_FIELD_INPUT_ID
        ERR_MESSAGE
        SUCCESS_MESSAGE
        INFO_MESSAGE

        form_response_add()
        ###CRNRSTN_SYSTEM_RESOURCE::FORM_INPUT_RESPONSE::
        SUCCESS_RESPONSE
        SUCCESS_RESPONSE_TYPE
        ERROR_RESPONSE
        ERROR_RESPONSE_TYPE

        ###CRNRSTN_SYSTEM_RESOURCE::FORM_RESPONSE::
        SUCCESS_RESPONSE
        SUCCESS_RESPONSE_TYPE
        ERROR_RESPONSE
        ERROR_RESPONSE_TYPE

        */

        foreach($this->crnrstn_pssdtl_http_tunneled_data_ARRAY as $index => $data){

            error_log(__LINE__ . ' dtsm [' . __METHOD__ . '][' . sizeof($this->crnrstn_pssdtl_http_tunneled_data_ARRAY) . '].');
            die();

        }

    }

    public function http_data_services_initialize($var_parse_channel){

        switch($var_parse_channel){
            case 'G':

                $tmp_crnrstn_pssdtl_packet = $this->oCRNRSTN->data_decrypt($_GET['crnrstn_pssdtl_packet']);

            break;
            default:

                $tmp_crnrstn_pssdtl_packet = $this->oCRNRSTN->data_decrypt($_POST['crnrstn_pssdtl_packet']);

            break;

        }

        //
        // PACKET HASH FOR VERIFICATION OF PACKET INTEGRITY. SAME VALUE SHOULD BE INSIDE THE ENCRYPTED PACKET.
        $this->pssdtl_packet_hash = $this->oCRNRSTN->hash($tmp_crnrstn_pssdtl_packet);

        //
        // EXTRACT DATA FROM HTTP
        $tmp_crnrstn_pssdtl_packet_ojson = json_decode($tmp_crnrstn_pssdtl_packet, true);

        if(isset($tmp_crnrstn_pssdtl_packet_ojson['crnrstn_data_packet'][0]['crnrstn_data_packet_ddo_elements'])){

            foreach($tmp_crnrstn_pssdtl_packet_ojson['crnrstn_data_packet'][0]['crnrstn_data_packet_ddo_elements'] as $index => $node){
                /*
                Array
                (
                    [HASH] => 0a389b1122a6ac551a685ec72e3f9815
                    [BYTES] => 17
                    [KEY] => 6bf11b80ff9a878569005fa567cff252b2907bee73c0edd670a53147d07189a2::CRNRSTN_FIELD_INPUT_NAME
                    [TYPE] => string
                    [VALUE] => crnrstn_demo_city
                    [TTL] => 60
                    [AUTH_PROFILE] => 8083
                )

                */

                //$this->oCRNRSTN->print_r($node, 'CRNRSTN :: DECOUPLED DATA OBJECT ELEMENT :: CLIENT FORM SUBMISSION.', NULL, __LINE__, __METHOD__, __FILE__);
                //error_log(__LINE__ . ' http [' . __METHOD__ . ']. $node=['. print_r($node, true) .  '].');

                if(!$this->receive_packet_data($node)){

                    error_log(__LINE__ . ' dtsm::' . __METHOD__ . '() ERROR on PSSDTLP NODE[' . print_r($node, true) . '].');

                    /*
                    pssdtl_packet_profile_ARRAY['STATUS_REPORT'][][]

                    "STATUS_REPORT" : [{
                                "STATUS_TARGET_ELEMENT" : ' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS_TARGET_ELEMENT) . ',
                                "STATUS" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS) . '",
                                "STATUS_CODE" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS_CODE) . '",
                                "STATUS_MESSAGE" : ' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS_MESSAGE) . ',
                                "ERROR_CODE" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_ERROR_CODE) . '",
                                "ERROR_MESSAGE" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_ERROR_MESSAGE) . '"
                                },{
                                "STATUS_TARGET_ELEMENT" : ' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS_TARGET_ELEMENT) . ',
                                "STATUS" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS) . '",
                                "STATUS_CODE" : "1234567890",
                                "STATUS_MESSAGE" : ' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS_MESSAGE) . ',
                                "ERROR_CODE" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_ERROR_CODE) . '",
                                "ERROR_MESSAGE" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_ERROR_MESSAGE) . '"
                                },{
                                "STATUS_TARGET_ELEMENT" : ' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS_TARGET_ELEMENT) . ',
                                "STATUS" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS) . '",
                                "STATUS_CODE" : "0987654321",
                                "STATUS_MESSAGE" : ' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS_MESSAGE) . ',
                                "ERROR_CODE" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_ERROR_CODE) . '",
                                "ERROR_MESSAGE" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_ERROR_MESSAGE) . '"
                                }],

                    */

                }

                //$this->oCRNRSTN->add_system_resource($tmp_data_key, 'data_value_here', $tmp_data_type_family, CRNRSTN_AUTHORIZE_RUNTIME_ONLY);

            }

        }

        return true;

    }

    public function return_hidden_input_html($crnrstn_form_handle, $data_auth_profile){
        /*
        case CRNRSTN_UI_FORM_INTEGRATION_PACKET: USER FACING
        case CRNRSTN_OUTPUT_PSSDTLA:
        case CRNRSTN_OUTPUT_FORM_INTEGRATIONS:

        */

        $tmp_str = '';

        switch($data_auth_profile){
            case CRNRSTN_UI_FORM_INTEGRATION_PACKET:

                //
                // HIDDEN INPUT HTML INJECTION :: CUSTOM FORM
                $tmp_str = '
        <input type="hidden" name="crnrstn_request_serialization_key_XXXXXXXXXX" id="crnrstn_request_serialization_key_XXXXXXXXXX" value="">';

            break;
            case CRNRSTN_OUTPUT_SSDTLA:

                //
                // HIDDEN INPUT HTML INJECTION :: CRNRSTN :: SSDTL
                $tmp_str = '
        <input type="hidden" name="crnrstn_request_serialization_key" id="crnrstn_request_serialization_key" value="">
        <input type="hidden" name="crnrstn_request_serialization_hash" id="crnrstn_request_serialization_hash" value="">
        <input type="hidden" name="crnrstn_interact_ui_link_text_click" id="crnrstn_interact_ui_link_text_click" value="">
        <input type="hidden" name="crnrstn_interact_ui_loadbar_progress" id="crnrstn_interact_ui_loadbar_progress" value="">';
                //$this->oCRNRSTN->print_r($tmp_str, $crnrstn_form_handle, NULL, __LINE__, __METHOD__, __FILE__);
                error_log(__LINE__  . ' dtsm ' . __METHOD__ . ' [' . print_r($tmp_str, true) . '].');

            break;
            case CRNRSTN_OUTPUT_PSSDTLA:

                // JSON
                error_log('why am i running for JSON{} out? [lnum ' . __LINE__ . '][class ' . __CLASS__ . '][method ' . __METHOD__ . '] die();');
                die();

            break;
            default:

                error_log('why am i running for UNKNOWN data_auth_profile CONSTANT[' . $data_auth_profile . ']? [lnum ' . __LINE__ . '][class ' . __CLASS__ . '][method ' . __METHOD__ . '] die();');
                die();

            break;

        }

        return $tmp_str;

    }

    public function receive_packet_data($data_ARRAY, $data_attribute = 'crnrstn_pssdtl_packet', $data_auth_request = CRNRSTN_OUTPUT_RUNTIME){

        // WHERE $data_ARRAY=
        //$data_ARRAY['HASH'];
        //$data_ARRAY['BYTES'];
        //$data_ARRAY['KEY'];
        //$data_ARRAY['TYPE'];
        //$data_ARRAY['VALUE'];
        //$data_ARRAY['TTL'];
        //$data_ARRAY['AUTH_PROFILE'];

        switch($data_attribute){
            case 'crnrstn_data_packet_hidden_input_html':
            case 'crnrstn_pssdtl_packet':

                //$this->oCRNRSTN->print_r($data_ARRAY, $data_attribute . ' pssdtl_packet_hash=[' . $this->pssdtl_packet_hash . ']', NULL, __LINE__, __METHOD__, __FILE__);
                $this->crnrstn_pssdtl_http_tunneled_data_ARRAY[$this->pssdtl_packet_hash][] = $data_ARRAY;

                //
                // HUH? ARRAY STORAGE?? COULD NOT THE DATA BE PROCESSED HERE?

                return true;

            break;
            default:

                error_log(__LINE__  . ' dtsm UNKNOWN $data_attribute VALUE [' . $data_attribute . ']. die();');
                die();

            break;

        }

    }

    public function form_get_resource($crnrstn_form_handle, $input_name){


        return '';

    }

    public function __destruct(){

    }

}



