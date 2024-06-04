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
require('../../../_crnrstn.root.inc.php');
include_once( CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

$oCRNRSTN_USR->is_soap_data_tunnel_endpoint(true);
$raw_CRNRSTN_INTEGRATION_PACKET = $oCRNRSTN_USR->extractData_HTTP('CRNRSTN_INTEGRATION_PACKET', 'POST');

$oCRNRSTN_USR->print_r('DECRYPT PARAMS='.print_r($oCRNRSTN_USR->return_param_tunnel_decrypt_settings($raw_CRNRSTN_INTEGRATION_PACKET), true), NULL, __LINE__, __METHOD__, __FILE__);


//die();
if($tmp_decrypted_data = $oCRNRSTN_USR->param_tunnel_decrypt($raw_CRNRSTN_INTEGRATION_PACKET)){

    $oCRNRSTN_USR->print_r('DECRYPTED CRNRSTN_INTEGRATION_PACKET='.$tmp_decrypted_data, NULL, __LINE__, __METHOD__, __FILE__);

}else{

    $oCRNRSTN_USR->print_r('STILL...RAW CRNRSTN_INTEGRATION_PACKET='.$raw_CRNRSTN_INTEGRATION_PACKET, NULL, __LINE__, __METHOD__, __FILE__);
    $oCRNRSTN_USR->print_r('DECRYPT PARAMS='.print_r($oCRNRSTN_USR->return_param_tunnel_decrypt_settings($raw_CRNRSTN_INTEGRATION_PACKET), true), NULL, __LINE__, __METHOD__, __FILE__);


    $tmp_array = $tmp_array_outer_sess = $oCRNRSTN_USR->get_session_param('ENCRYPT_PARAMS');
    $oCRNRSTN_USR->print_r('ENCRYPT PARAMS='.print_r($tmp_array, true), 'SESSION :: VALUES USED FOR ENCRYPTION :: CRNRSTN :: v'.$oCRNRSTN_USR->version_crnrstn, __LINE__, __METHOD__, __FILE__);

    foreach($tmp_array as $key=>$meta_array){

        $oCRNRSTN_USR->print_r('ENCRYPT PARAMS='.print_r($meta_array, true), NULL, __LINE__, __METHOD__, __FILE__);

    }

}

//die();

//
// CRNRSTN :: TO HANDLE HTTP DATA
if($oCRNRSTN_USR->initialize_crnrstn_svc_http(false, true)) {

    //die();
    if ($oCRNRSTN_USR->isset_crnrstn_svc_http()) {

        //
        // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
        $raw_srvc_layer_wsdl = $oCRNRSTN_USR->extractData_HTTP('crnrstn_soap_srvc_layer_wsdl', 'POST');
        $raw_soap_data_tunnel_data = $oCRNRSTN_USR->extractData_HTTP('crnrstn_soap_data_tunnel_data', 'POST');
        $raw_soap_action = $oCRNRSTN_USR->extractData_HTTP('crnrstn_soap_data_tunnel_soap_action', 'POST');
        $raw_content_type = $oCRNRSTN_USR->extractData_HTTP('crnrstn_soap_data_tunnel_content_type', 'POST');
        $raw_content_length = $oCRNRSTN_USR->extractData_HTTP('crnrstn_soap_data_tunnel_content_length', 'POST');
        $raw_user_agent = $oCRNRSTN_USR->extractData_HTTP('crnrstn_soap_data_tunnel_user_agent', 'POST');
        $raw_host = $oCRNRSTN_USR->extractData_HTTP('crnrstn_soap_data_tunnel_host', 'POST');

/*

<input type="hidden" name="crnrstn_soap_srvc_layer_host" value="'.$_SERVER['SERVER_ADDR'].'">

<input type="hidden" name="crnrstn_soap_srvc_stime" value="'.$this->starttime.'">
<input type="hidden" name="crnrstn_soap_srvc_rtime" value="'.$this->wall_time().'">

<input type="hidden" name="crnrstn_soap_srvc_ttl_wethrbug" value="110">
<input type="hidden" name="crnrstn_soap_srvc_ttl_bassdrive_stats" value="20">
<input type="hidden" name="crnrstn_soap_srvc_ttl_bassdrive_show" value="45">
<input type="hidden" name="crnrstn_soap_srvc_ttl_truth_timer" value="30">
<input type="hidden" name="crnrstn_soap_srvc_ttl_banner_rotate_desktop" value="15">
<input type="hidden" name="crnrstn_soap_srvc_ttl_banner_rotate_tablet" value="7">
<input type="hidden" name="crnrstn_soap_srvc_ttl_banner_rotate_mobile" value="7">
<input type="hidden" name="crnrstn_soap_srvc_device_type" value="">
<input type="hidden" name="crnrstn_soap_srvc_transport_protocol_version" value="'.$this->version_soap.'">
<input type="hidden" name="crnrstn_soap_srvc_encoding" value="'.$tmp_oNUSOAP_BASE->soap_defencoding.'">
<input type="hidden" name="crnrstn_soap_srvc_response_format" value="soap-SOAP, soap;q=0.9, xml;0.7, json;0.1, csv;0, carrier_pigeon;-0.9">

 * */

        $raw_srvc_data = $oCRNRSTN_USR->extractData_HTTP('crnrstn_soap_srvc_data', 'POST');
        $raw_srvc_soap_action = $oCRNRSTN_USR->extractData_HTTP('crnrstn_soap_srvc_soap_action', 'POST');
        $raw_srvc_length = $oCRNRSTN_USR->extractData_HTTP('crnrstn_soap_srvc_content_length', 'POST');
        $raw_srvc_user_agent = $oCRNRSTN_USR->extractData_HTTP('crnrstn_soap_srvc_layer_user_agent', 'POST');
        $raw_srvc_layer_host = $oCRNRSTN_USR->extractData_HTTP('crnrstn_soap_srvc_layer_host', 'POST');


        $oCRNRSTN_USR->print_r('$raw_srvc_layer_wsdl='.$raw_srvc_layer_wsdl, NULL, __LINE__, __METHOD__, __FILE__);
        $oCRNRSTN_USR->print_r('$raw_srvc_soap_action='.$raw_srvc_soap_action, NULL, __LINE__, __METHOD__, __FILE__);
        $oCRNRSTN_USR->print_r('$raw_soap_action='.$raw_soap_action, NULL, __LINE__, __METHOD__, __FILE__);
        $oCRNRSTN_USR->print_r('$raw_content_type='.$raw_content_type, NULL, __LINE__, __METHOD__, __FILE__);
        $oCRNRSTN_USR->print_r('$raw_content_length='.$raw_content_length, NULL, __LINE__, __METHOD__, __FILE__);
        $oCRNRSTN_USR->print_r('$raw_user_agent='.$raw_user_agent, NULL, __LINE__, __METHOD__, __FILE__);
        $oCRNRSTN_USR->print_r('$raw_host='.$raw_host, NULL, __LINE__, __METHOD__, __FILE__);
        $oCRNRSTN_USR->print_r('$raw_soap_data_tunnel_data='.$raw_soap_data_tunnel_data, NULL, __LINE__, __METHOD__, __FILE__);
        $oCRNRSTN_USR->print_r('$raw_srvc_data='.$raw_srvc_data, NULL, __LINE__, __METHOD__, __FILE__);

        $oCRNRSTN_USR->print_r('Goodbye, SOAP Data Tunnel.', NULL, __LINE__, __METHOD__, __FILE__);






    }


}else{

    //
    // FORM INTEGRATION ONLY OR UNAUTHORIZED
    $oCRNRSTN_USR->return_server_resp_status(503);

}