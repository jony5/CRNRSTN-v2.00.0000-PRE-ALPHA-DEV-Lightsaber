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
#         AUTHOR :: Jonathan '5' Harris, CEO, CTO, Lead Full Stack Developer, jharris@eVifweb.com, eVifweb@gmail.com.
#            URI :: https://crnrstn.jony5.com
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
require_once('../../../_crnrstn.root.inc.php');
include_once( CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

$tmp_filename_xml = $oCRNRSTN_USR->get_resource('DOCUMENT_ROOT').$oCRNRSTN_USR->get_resource('DOCUMENT_ROOT_DIR').'/common/xml/crnrstn_ajax_dom_state_controller.xml';

header('Content-Type: application/xml; charset=iso-8859-1');
header('Cache-Control: no-store');
header('Access-Control-Allow-Origin: *');
//header('Content-Disposition: inline; filename="crnrstn_data_tunnel_packet.xml');

$oCRNRSTN_USR->readfile_chunked($tmp_filename_xml);
die();

$oCRNRSTN_USR->is_soap_data_tunnel_endpoint(true);
$raw_crnrstn_pssdtl_packet = $oCRNRSTN_USR->extract_data_http('crnrstn_pssdtl_packet', 'POST');

if($tmp_decrypted_data = $oCRNRSTN_USR->data_decrypt($raw_crnrstn_pssdtl_packet)){

    $oCRNRSTN_USR->print_r('DECRYPTED crnrstn_pssdtl_packet=' . $tmp_decrypted_data, NULL, __LINE__, __METHOD__, __FILE__);

    error_log(__LINE__ . ' tunnel die() $tmp_decrypted_data success...'. print_r($tmp_decrypted_data, true));
    die();

}else{

    error_log(__LINE__ . ' tunnel die() $tmp_decrypted_data error...' . print_r($raw_crnrstn_pssdtl_packet, true));
    die();

}

//
// CRNRSTN :: TO HANDLE HTTP DATA
if($oCRNRSTN_USR->http_data_services_initialize(false, true)) {

    //die();
    if ($oCRNRSTN_USR->isset_crnrstn_services_http()) {

        //
        // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
        $raw_srvc_layer_wsdl = $oCRNRSTN_USR->extract_data_http('crnrstn_soap_srvc_layer_wsdl', 'POST');
        $raw_soap_data_tunnel_data = $oCRNRSTN_USR->extract_data_http('crnrstn_soap_data_tunnel_data', 'POST');
        $raw_soap_action = $oCRNRSTN_USR->extract_data_http('crnrstn_soap_data_tunnel_soap_action', 'POST');
        $raw_content_type = $oCRNRSTN_USR->extract_data_http('crnrstn_soap_data_tunnel_content_type', 'POST');
        $raw_content_length = $oCRNRSTN_USR->extract_data_http('crnrstn_soap_data_tunnel_content_length', 'POST');
        $raw_user_agent = $oCRNRSTN_USR->extract_data_http('crnrstn_soap_data_tunnel_user_agent', 'POST');
        $raw_host = $oCRNRSTN_USR->extract_data_http('crnrstn_soap_data_tunnel_host', 'POST');

/*

<input type="hidden" name="crnrstn_soap_srvc_layer_host" value="' . $_SERVER['SERVER_ADDR'].'">

<input type="hidden" name="crnrstn_soap_srvc_stime" value="' . $this->starttime . '">
<input type="hidden" name="crnrstn_soap_srvc_rtime" value="' . $this->wall_time().'">

<input type="hidden" name="crnrstn_soap_srvc_ttl_wethrbug" value="110">
<input type="hidden" name="crnrstn_soap_srvc_ttl_bassdrive_stats" value="20">
<input type="hidden" name="crnrstn_soap_srvc_ttl_bassdrive_show" value="45">
<input type="hidden" name="crnrstn_soap_srvc_ttl_truth_timer" value="30">
<input type="hidden" name="crnrstn_soap_srvc_ttl_banner_rotate_desktop" value="15">
<input type="hidden" name="crnrstn_soap_srvc_ttl_banner_rotate_tablet" value="7">
<input type="hidden" name="crnrstn_soap_srvc_ttl_banner_rotate_mobile" value="7">
<input type="hidden" name="crnrstn_soap_srvc_device_type" value="">
<input type="hidden" name="crnrstn_soap_srvc_tunnel_protocol_version" value="' . $this->version_soap.'">
<input type="hidden" name="crnrstn_soap_srvc_encoding" value="' . $tmp_oNUSOAP_BASE->soap_defencoding.'">
<input type="hidden" name="crnrstn_soap_srvc_response_format" value="soap-SOAP, soap;q=0.9, xml;0.7, json;0.1, csv;0, carrier_pigeon;-0.9">

 * */

        $raw_srvc_data = $oCRNRSTN_USR->extract_data_http('crnrstn_soap_srvc_data', 'POST');
        $raw_srvc_soap_action = $oCRNRSTN_USR->extract_data_http('crnrstn_soap_srvc_soap_action', 'POST');
        $raw_srvc_length = $oCRNRSTN_USR->extract_data_http('crnrstn_soap_srvc_content_length', 'POST');
        $raw_srvc_user_agent = $oCRNRSTN_USR->extract_data_http('crnrstn_soap_srvc_layer_user_agent', 'POST');
        $raw_srvc_layer_host = $oCRNRSTN_USR->extract_data_http('crnrstn_soap_srvc_layer_host', 'POST');


        $oCRNRSTN_USR->print_r('$raw_srvc_layer_wsdl=' . $raw_srvc_layer_wsdl, NULL, __LINE__, __METHOD__, __FILE__);
        $oCRNRSTN_USR->print_r('$raw_srvc_soap_action=' . $raw_srvc_soap_action, NULL, __LINE__, __METHOD__, __FILE__);
        $oCRNRSTN_USR->print_r('$raw_soap_action=' . $raw_soap_action, NULL, __LINE__, __METHOD__, __FILE__);
        $oCRNRSTN_USR->print_r('$raw_content_type=' . $raw_content_type, NULL, __LINE__, __METHOD__, __FILE__);
        $oCRNRSTN_USR->print_r('$raw_content_length=' . $raw_content_length, NULL, __LINE__, __METHOD__, __FILE__);
        $oCRNRSTN_USR->print_r('$raw_user_agent=' . $raw_user_agent, NULL, __LINE__, __METHOD__, __FILE__);
        $oCRNRSTN_USR->print_r('$raw_host=' . $raw_host, NULL, __LINE__, __METHOD__, __FILE__);
        $oCRNRSTN_USR->print_r('$raw_soap_data_tunnel_data=' . $raw_soap_data_tunnel_data, NULL, __LINE__, __METHOD__, __FILE__);
        $oCRNRSTN_USR->print_r('$raw_srvc_data=' . $raw_srvc_data, NULL, __LINE__, __METHOD__, __FILE__);

        $oCRNRSTN_USR->print_r('Goodbye, SOAP Data Tunnel.', NULL, __LINE__, __METHOD__, __FILE__);






    }


}else{

    //
    // FORM INTEGRATION ONLY OR UNAUTHORIZED
    $oCRNRSTN_USR->return_server_response_code(503);

}