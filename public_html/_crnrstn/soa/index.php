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
require('../../_crnrstn.root.inc.php');
include_once( CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

# CAN I MIGRATE THIS BEHIND THE USER CLASS OBJECT LIKE USE OF NUSOAP CLIENT AND GABRIEL?

//
// INSTANTIATE A SOAP SERVER CLASS OBJECT AND PROVIDE SESSION ACCESS TO CRNRSTN_USR CLASS OBJECT.
//$server = new soap_server('http://services.crnrstn.jony5.com/soa/crnrstn/1.0.0/wsdl/index.php?wsdl');
$server = new soap_server();
$server->debug_flag = $oCRNRSTN_USR->return_SOAP_SVC_debugMode();

$server->configureWSDL("CRNRSTN_SOAP_SERVICES", $oCRNRSTN_USR->get_resource('SOA_NAMESPACE'));
$server->wsdl->schemaTargetNamespace = $oCRNRSTN_USR->get_resource('SOA_NAMESPACE');
//
// TODO :: OBJECT SERIALIZATION IN $_SESSION FOR LIGHTSABER?
// TODO :: CAN WE RE-ARCH CRNRSTN :: SOAP TO USE $oCRNRSTN?...I.E. $this->.....
$_SESSION['oCRNRSTN_USR'] = $oCRNRSTN_USR;

//
// REGISTER THE DATA STRUCTURES USED BY THE SERVICE
$server->wsdl->addComplexType(
    'oElectrumPerformanceReport',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'CRNRSTN_PACKET_IS_ENCRYPTED' => array('name' => 'CRNRSTN_PACKET_IS_ENCRYPTED', 'type' => 'xsd:string'),
        'CRNRSTN_SOAP_SVC_AUTH_KEY' => array('name' => 'CRNRSTN_SOAP_SVC_AUTH_KEY', 'type' => 'xsd:string'),
        'oCRNRSTN_SOAP_SVC_REQUESTED_RESOURCES' => array('name' => 'oCRNRSTN_SOAP_SVC_REQUESTED_RESOURCES', 'type' => 'tns:oCRNRSTN_RESOURCE_CONSTANTS'),
        'CRNRSTN_SOAP_SVC_METHOD_REQUESTED' => array('name' => 'CRNRSTN_SOAP_SVC_METHOD_REQUESTED', 'type' => 'xsd:string'),
        'CRNRSTN_SOAP_ACTION_TYPE' => array('name' => 'CRNRSTN_SOAP_ACTION_TYPE', 'type' => 'xsd:string'),
        'TRY_OTHER_EMAIL_METHODS_ON_ERR' => array('name' => 'TRY_OTHER_EMAIL_METHODS_ON_ERR', 'type' => 'xsd:string'),
        'CRNRSTN_SOAP_SVC_USERNAME' => array('name' => 'CRNRSTN_SOAP_SVC_USERNAME', 'type' => 'xsd:string'),
        'CRNRSTN_SOAP_SVC_PASSWORD' => array('name' => 'CRNRSTN_SOAP_SVC_PASSWORD', 'type' => 'xsd:string'),
        'CRNRSTN_PROXY_EMAIL_PROTOCOL' => array('name' => 'CRNRSTN_PROXY_EMAIL_PROTOCOL', 'type' => 'xsd:string'),
        'oRECIPIENT' => array('name' => 'oRECIPIENT', 'type' => 'tns:oEmailArray'),
        'oSENDER' => array('name' => 'oSENDER', 'type' => 'tns:oEmailArray'),
        'oREPLYTO' => array('name' => 'oREPLYTO', 'type' => 'tns:oEmailArray'),
        'oCC' => array('name' => 'oCC', 'type' => 'tns:oEmailArray'),
        'oBCC' => array('name' => 'oBCC', 'type' => 'tns:oEmailArray'),
        'SUPPRESS_DUPLICATE_RECIPIENT' => array('name' => 'SUPPRESS_DUPLICATE_RECIPIENT', 'type' => 'xsd:string'),
        'MESSAGE_SUBJECT' => array('name' => 'MESSAGE_SUBJECT', 'type' => 'xsd:string'),
        'WORDWRAP' => array('name' => 'WORDWRAP', 'type' => 'xsd:string'),
        'PRIORITY' => array('name' => 'PRIORITY', 'type' => 'xsd:string'),
        'IS_HTML' => array('name' => 'IS_HTML', 'type' => 'xsd:string'),
        'SYS_MESSAGE_TITLE_HTML' => array('name' => 'SYS_MESSAGE_TITLE_HTML', 'type' => 'xsd:string'),
        'SYS_MESSAGE_TITLE_TEXT' => array('name' => 'SYS_MESSAGE_TITLE_TEXT', 'type' => 'xsd:string'),
        'SYS_LOG_INTEGER_CONSTANT' => array('name' => 'SYS_LOG_INTEGER_CONSTANT', 'type' => 'xsd:string'),
        'SYS_MESSAGE_HTML' => array('name' => 'SYS_MESSAGE_HTML', 'type' => 'xsd:string'),
        'SYS_MESSAGE_TEXT' => array('name' => 'SYS_MESSAGE_TEXT', 'type' => 'xsd:string'),
        'SYS_REMOTE_ADDR' => array('name' => 'SYS_REMOTE_ADDR', 'type' => 'xsd:string'),
        'SYS_SERVER_NAME' => array('name' => 'SYS_SERVER_NAME', 'type' => 'xsd:string'),
        'SYS_SYSTEM_TIME' => array('name' => 'SYS_SYSTEM_TIME', 'type' => 'xsd:string'),
        'SYS_PROCESS_RUN_TIME' => array('name' => 'SYS_PROCESS_RUN_TIME', 'type' => 'xsd:string'),
        'ELECTRUM_ERRORS_TRACE_HTML' => array('name' => 'ELECTRUM_ERRORS_TRACE_HTML', 'type' => 'xsd:string'),
        'ELECTRUM_ERRORS_TRACE_TEXT' => array('name' => 'ELECTRUM_ERRORS_TRACE_TEXT', 'type' => 'xsd:string'),
        'ELECTRUM_START_TIME' => array('name' => 'ELECTRUM_START_TIME', 'type' => 'xsd:string'),
        'ELECTRUM_END_TIME' => array('name' => 'ELECTRUM_END_TIME', 'type' => 'xsd:string'),
        'ELECTRUM_PRETTY_RUN_TIME' => array('name' => 'ELECTRUM_PRETTY_RUN_TIME', 'type' => 'xsd:string'),
        'ELECTRUM_TOTAL_COUNT_VALID_FOR_TRANSFER' => array('name' => 'ELECTRUM_TOTAL_COUNT_VALID_FOR_TRANSFER', 'type' => 'xsd:string'),
        'ELECTRUM_TOTAL_COUNT_DESTINATION_ENDPOINTS' => array('name' => 'ELECTRUM_TOTAL_COUNT_DESTINATION_ENDPOINTS', 'type' => 'xsd:string'),
        'ELECTRUM_TOTAL_COUNT_FILES_TRANSFERRED' => array('name' => 'ELECTRUM_TOTAL_COUNT_FILES_TRANSFERRED', 'type' => 'xsd:string'),
        'ELECTRUM_ENDPOINT_FILESIZE_FILES_TRANSFERRED' => array('name' => 'ELECTRUM_ENDPOINT_FILESIZE_FILES_TRANSFERRED', 'type' => 'xsd:string'),
        'ELECTRUM_TOTAL_COUNT_FILES_SKIPPED' => array('name' => 'ELECTRUM_TOTAL_COUNT_FILES_SKIPPED', 'type' => 'xsd:string'),
        'ELECTRUM_TOTAL_FILESIZE_FILES_TRANSFERRED' => array('name' => 'ELECTRUM_TOTAL_FILESIZE_FILES_TRANSFERRED', 'type' => 'xsd:string'),
        'ELECTRUM_TOTAL_ERRORS_FILES_TRANSFERRED' => array('name' => 'ELECTRUM_TOTAL_ERRORS_FILES_TRANSFERRED', 'type' => 'xsd:string'),
        'ELECTRUM_TOTAL_COUNT_ENDPOINT_CONNECTION_ERROR' => array('name' => 'ELECTRUM_TOTAL_COUNT_ENDPOINT_CONNECTION_ERROR', 'type' => 'xsd:string'),
        'ELECTRUM_PERCENTAGE_FILES_SUCCESSFUL_TRANSFERRED' => array('name' => 'ELECTRUM_PERCENTAGE_FILES_SUCCESSFUL_TRANSFERRED', 'type' => 'xsd:string'),
        'ELECTRUM_DATA_SOURCE_HTML' => array('name' => 'ELECTRUM_DATA_SOURCE_HTML', 'type' => 'xsd:string'),
        'ELECTRUM_DATA_DESTINATION_HTML' => array('name' => 'ELECTRUM_DATA_DESTINATION_HTML', 'type' => 'xsd:string'),
        'ELECTRUM_DATA_HANDLING_PROFILE_HTML' => array('name' => 'ELECTRUM_DATA_HANDLING_PROFILE_HTML', 'type' => 'xsd:string'),
        'ELECTRUM_DATA_SOURCE_TEXT' => array('name' => 'ELECTRUM_DATA_SOURCE_TEXT', 'type' => 'xsd:string'),
        'ELECTRUM_DATA_DESTINATION_TEXT' => array('name' => 'ELECTRUM_DATA_DESTINATION_TEXT', 'type' => 'xsd:string'),
        'ELECTRUM_DATA_HANDLING_PROFILE_TEXT' => array('name' => 'ELECTRUM_DATA_HANDLING_PROFILE_TEXT', 'type' => 'xsd:string'),
        'SERVER_NAME_SOAP_CLIENT' => array('name' => 'SERVER_NAME_SOAP_CLIENT', 'type' => 'xsd:string'),
        'SERVER_ADDRESS_SOAP_CLIENT' => array('name' => 'SERVER_ADDRESS_SOAP_CLIENT', 'type' => 'xsd:string')

    )
);

$server->wsdl->addComplexType(
    'oKingsHighwayAuthRequest',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'CRNRSTN_PACKET_IS_ENCRYPTED' => array('name' => 'CRNRSTN_PACKET_IS_ENCRYPTED', 'type' => 'xsd:string'),
        'CRNRSTN_SOAP_SVC_AUTH_KEY' => array('name' => 'CRNRSTN_SOAP_SVC_AUTH_KEY', 'type' => 'xsd:string'),
        'CRNRSTN_SOAP_SVC_USERNAME' => array('name' => 'CRNRSTN_SOAP_SVC_USERNAME', 'type' => 'xsd:string'),
        'CRNRSTN_SOAP_SVC_PASSWORD' => array('name' => 'CRNRSTN_SOAP_SVC_PASSWORD', 'type' => 'xsd:string'),
        'oCRNRSTN_SOAP_SVC_REQUESTED_RESOURCES' => array('name' => 'oCRNRSTN_SOAP_SVC_REQUESTED_RESOURCES', 'type' => 'tns:oCRNRSTN_RESOURCE_CONSTANTS'),
        'CRNRSTN_SOAP_SVC_METHOD_REQUESTED' => array('name' => 'CRNRSTN_SOAP_SVC_METHOD_REQUESTED', 'type' => 'xsd:string'),
        'CRNRSTN_SOAP_ACTION_TYPE' => array('name' => 'CRNRSTN_SOAP_ACTION_TYPE', 'type' => 'xsd:string'),
        'SERVER_NAME_SOAP_CLIENT' => array('name' => 'SERVER_NAME_SOAP_CLIENT', 'type' => 'xsd:string'),
        'SERVER_ADDRESS_SOAP_CLIENT' => array('name' => 'SERVER_ADDRESS_SOAP_CLIENT', 'type' => 'xsd:string')
    )
);

$server->wsdl->addComplexType(
    'oKingsHighwayAuthResponse',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'CRNRSTN_PACKET_IS_ENCRYPTED' => array('name' => 'CRNRSTN_PACKET_IS_ENCRYPTED', 'type' => 'xsd:string'),
        'CRNRSTN_SOAP_SVC_AUTH_KEY' => array('name' => 'CRNRSTN_SOAP_SVC_AUTH_KEY', 'type' => 'xsd:string'),
        'CRNRSTN_SOAP_SVC_USERNAME' => array('name' => 'CRNRSTN_SOAP_SVC_USERNAME', 'type' => 'xsd:string'),
        'SOAP_SERVICES_AUTH_STATUS' => array('name' => 'SOAP_SERVICES_AUTH_STATUS', 'type' => 'xsd:string'),
        'SOAP_ENCRYPT_CIPHER' => array('name' => 'SOAP_ENCRYPT_CIPHER', 'type' => 'xsd:string'),
        'SOAP_ENCRYPT_SECRET_KEY' => array('name' => 'SOAP_ENCRYPT_SECRET_KEY', 'type' => 'xsd:string'),
        'SOAP_ENCRYPT_HMAC_ALG' => array('name' => 'SOAP_ENCRYPT_HMAC_ALG', 'type' => 'xsd:string'),
        'SOAP_ENCRYPT_OPTIONS' => array('name' => 'SOAP_ENCRYPT_OPTIONS', 'type' => 'xsd:string'),
        'STATUS_CODE' => array('name' => 'STATUS_CODE', 'type' => 'xsd:string'),
        'STATUS_MESSAGE' => array('name' => 'STATUS_MESSAGE', 'type' => 'xsd:string'),
        'ISERROR_CODE' => array('name' => 'ISERROR_CODE', 'type' => 'xsd:string'),
        'ISERROR_MESSAGE' => array('name' => 'ISERROR_MESSAGE', 'type' => 'xsd:string'),
        'SERVER_NAME_SOAP_SERVER' => array('name' => 'SERVER_NAME_SOAP_SERVER', 'type' => 'xsd:string'),
        'SERVER_ADDRESS_SOAP_SERVER' => array('name' => 'SERVER_ADDRESS_SOAP_SERVER', 'type' => 'xsd:string'),
        'SERVER_NAME_SOAP_CLIENT' => array('name' => 'SERVER_NAME_SOAP_CLIENT', 'type' => 'xsd:string'),
        'SERVER_ADDRESS_SOAP_CLIENT' => array('name' => 'SERVER_ADDRESS_SOAP_CLIENT', 'type' => 'xsd:string'),
        'DATE_RECEIVED_SOAP_REQUEST' => array('name' => 'DATE_RECEIVED_SOAP_REQUEST', 'type' => 'xsd:string'),
        'DATE_CREATED_SOAP_RESPONSE' => array('name' => 'DATE_CREATED_SOAP_RESPONSE', 'type' => 'xsd:string'),
        'SOAP_OPERATION_RUNTIME_SECONDS' => array('name' => 'SOAP_OPERATION_RUNTIME_SECONDS', 'type' => 'xsd:string')
    )
);

$server->wsdl->addComplexType(
	'oKingsHighwayNotification',
	'complexType',
	'struct',
	'all',
	'',
	array(
        'CRNRSTN_PACKET_IS_ENCRYPTED' => array('name' => 'CRNRSTN_PACKET_IS_ENCRYPTED', 'type' => 'xsd:string'),
        'CRNRSTN_SOAP_SVC_AUTH_KEY' => array('name' => 'CRNRSTN_SOAP_SVC_AUTH_KEY', 'type' => 'xsd:string'),
        'CRNRSTN_SOAP_SVC_USERNAME' => array('name' => 'CRNRSTN_SOAP_SVC_USERNAME', 'type' => 'xsd:string'),
        'CRNRSTN_SOAP_SVC_PASSWORD' => array('name' => 'CRNRSTN_SOAP_SVC_PASSWORD', 'type' => 'xsd:string'),
        'AUTHENTICATION_TOKEN' => array('name' => 'AUTHENTICATION_TOKEN', 'type' => 'xsd:string'),
        'oCRNRSTN_SOAP_SVC_REQUESTED_RESOURCES' => array('name' => 'oCRNRSTN_SOAP_SVC_REQUESTED_RESOURCES', 'type' => 'tns:oCRNRSTN_RESOURCE_CONSTANTS'),
        'CRNRSTN_SOAP_SVC_METHOD_REQUESTED' => array('name' => 'CRNRSTN_SOAP_SVC_METHOD_REQUESTED', 'type' => 'xsd:string'),
        'CRNRSTN_SOAP_ACTION_TYPE' => array('name' => 'CRNRSTN_SOAP_ACTION_TYPE', 'type' => 'xsd:string'),
		'oRECIPIENT' => array('name' => 'oRECIPIENT', 'type' => 'tns:oEmailArray'),
		'oSENDER' => array('name' => 'oSENDER', 'type' => 'tns:oEmailArray'),
		'oREPLYTO' => array('name' => 'oREPLYTO', 'type' => 'tns:oEmailArray'),
		'oCC' => array('name' => 'oCC', 'type' => 'tns:oEmailArray'),
		'oBCC' => array('name' => 'oBCC', 'type' => 'tns:oEmailArray'),
        'MESSAGE_SUBJECT' => array('name' => 'MESSAGE_SUBJECT', 'type' => 'tns:oSOAP_Data'),
		'MESSAGE_BODY_HTML' => array('name' => 'MESSAGE_BODY_HTML', 'type' => 'tns:oSOAP_Data'),
		'MESSAGE_BODY_TEXT' => array('name' => 'MESSAGE_BODY_TEXT', 'type' => 'tns:oSOAP_Data'),
        'EMAIL_PROTOCOL' => array('name' => 'EMAIL_PROTOCOL', 'type' => 'tns:oSOAP_Data'),
        'TRY_OTHER_EMAIL_METHODS_ON_ERR' => array('name' => 'TRY_OTHER_EMAIL_METHODS_ON_ERR', 'type' => 'tns:oSOAP_Data'),
        'SMTP_AUTH' => array('name' => 'SMTP_AUTH', 'type' => 'tns:oSOAP_Data'),
        'SMTP_SERVER' => array('name' => 'SMTP_SERVER', 'type' => 'tns:oSOAP_Data'),
        'SMTP_PORT_OUTGOING' => array('name' => 'SMTP_PORT_OUTGOING', 'type' => 'tns:oSOAP_Data'),
        'SMTP_USERNAME' => array('name' => 'SMTP_USERNAME', 'type' => 'tns:oSOAP_Data'),
        'SMTP_PASSWORD' => array('name' => 'SMTP_PASSWORD', 'type' => 'tns:oSOAP_Data'),
        'SMTP_KEEPALIVE' => array('name' => 'SMTP_KEEPALIVE', 'type' => 'tns:oSOAP_Data'),
        'SMTP_SECURE' => array('name' => 'SMTP_SECURE', 'type' => 'tns:oSOAP_Data'),
        'SMTP_AUTOTLS' => array('name' => 'SMTP_AUTOTLS', 'type' => 'tns:oSOAP_Data'),
        'SMTP_TIMEOUT' => array('name' => 'SMTP_TIMEOUT', 'type' => 'tns:oSOAP_Data'),
        'DIBYA_SAHOO_SSL_CERT_BYPASS' => array('name' => 'DIBYA_SAHOO_SSL_CERT_BYPASS', 'type' => 'tns:oSOAP_Data'),
        'SENDMAIL_PATH' => array('name' => 'SENDMAIL_PATH', 'type' => 'tns:oSOAP_Data'),
        'USE_SENDMAIL_OPTIONS' => array('name' => 'USE_SENDMAIL_OPTIONS', 'type' => 'tns:oSOAP_Data'),
        'WORDWRAP' => array('name' => 'WORDWRAP', 'type' => 'tns:oSOAP_Data'),
        'ISHTML' => array('name' => 'ISHTML', 'type' => 'tns:oSOAP_Data'),
        'PRIORITY' => array('name' => 'PRIORITY', 'type' => 'tns:oSOAP_Data'),
        'DUP_SUPPRESS' => array('name' => 'DUP_SUPPRESS', 'type' => 'tns:oSOAP_Data'),
        'CHARSET' => array('name' => 'CHARSET', 'type' => 'tns:oSOAP_Data'),
        'MESSAGE_ENCODING' => array('name' => 'MESSAGE_ENCODING', 'type' => 'tns:oSOAP_Data'),
        'ALLOW_EMPTY' => array('name' => 'ALLOW_EMPTY', 'type' => 'tns:oSOAP_Data'),
        'SERVER_NAME_SOAP_CLIENT' => array('name' => 'SERVER_NAME_SOAP_CLIENT', 'type' => 'xsd:string'),
        'SERVER_ADDRESS_SOAP_CLIENT' => array('name' => 'SERVER_ADDRESS_SOAP_CLIENT', 'type' => 'xsd:string')

	)

);


$server->wsdl->addComplexType(
    'oCRNRSTN_UI_GLOBAL_SYNC_REQUEST',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'CRNRSTN_PACKET_IS_ENCRYPTED' => array('name' => 'CRNRSTN_PACKET_IS_ENCRYPTED', 'type' => 'xsd:string'),
        'CRNRSTN_SOAP_SVC_AUTH_KEY' => array('name' => 'CRNRSTN_SOAP_SVC_AUTH_KEY', 'type' => 'xsd:string'),
        'oCRNRSTN_SOAP_SVC_REQUESTED_RESOURCES' => array('name' => 'oCRNRSTN_SOAP_SVC_REQUESTED_RESOURCES', 'type' => 'tns:oCRNRSTN_RESOURCE_CONSTANTS'),
        'CRNRSTN_SOAP_SVC_METHOD_REQUESTED' => array('name' => 'CRNRSTN_SOAP_SVC_METHOD_REQUESTED', 'type' => 'xsd:string'),
        'CRNRSTN_SOAP_ACTION_TYPE' => array('name' => 'CRNRSTN_SOAP_ACTION_TYPE', 'type' => 'xsd:string'),
        'CRNRSTN_SOAP_SVC_USERNAME' => array('name' => 'CRNRSTN_SOAP_SVC_USERNAME', 'type' => 'xsd:string'),
        'CRNRSTN_SOAP_SVC_PASSWORD' => array('name' => 'CRNRSTN_SOAP_SVC_PASSWORD', 'type' => 'xsd:string'),

        'ELECTRUM_ERRORS_TRACE_HTML' => array('name' => 'ELECTRUM_ERRORS_TRACE_HTML', 'type' => 'xsd:string'),
        'ELECTRUM_ERRORS_TRACE_TEXT' => array('name' => 'ELECTRUM_ERRORS_TRACE_TEXT', 'type' => 'xsd:string'),
        'ELECTRUM_START_TIME' => array('name' => 'ELECTRUM_START_TIME', 'type' => 'xsd:string'),
        'ELECTRUM_END_TIME' => array('name' => 'ELECTRUM_END_TIME', 'type' => 'xsd:string'),
        'ELECTRUM_PRETTY_RUN_TIME' => array('name' => 'ELECTRUM_PRETTY_RUN_TIME', 'type' => 'xsd:string'),

        'RESPONSE_FORMAT' => array('name' => 'RESPONSE_FORMAT', 'type' => 'xsd:string'),

        'ACTIVITY_STATUS_MESSAGE' => array('name' => 'ACTIVITY_STATUS_MESSAGE', 'type' => 'xsd:string'),
        'oACTIVITY_STATUS_REPORT' => array('name' => 'oACTIVITY_STATUS_REPORT', 'type' => 'tns:oStatusReportArray'),
        'STATUS_CODE' => array('name' => 'STATUS_CODE', 'type' => 'xsd:string'),
        'STATUS_MESSAGE' => array('name' => 'STATUS_MESSAGE', 'type' => 'xsd:string'),
        'ISERROR_CODE' => array('name' => 'ISERROR_CODE', 'type' => 'xsd:string'),
        'ISERROR_MESSAGE' => array('name' => 'ISERROR_MESSAGE', 'type' => 'xsd:string'),
        'SERVER_NAME_SOAP_SERVER' => array('name' => 'SERVER_NAME_SOAP_SERVER', 'type' => 'xsd:string'),
        'SERVER_ADDRESS_SOAP_SERVER' => array('name' => 'SERVER_ADDRESS_SOAP_SERVER', 'type' => 'xsd:string'),
        'SERVER_NAME_SOAP_CLIENT' => array('name' => 'SERVER_NAME_SOAP_CLIENT', 'type' => 'xsd:string'),
        'SERVER_ADDRESS_SOAP_CLIENT' => array('name' => 'SERVER_ADDRESS_SOAP_CLIENT', 'type' => 'xsd:string'),
        'SOAP_OPERATION_RUNTIME_SECONDS' => array('name' => 'SOAP_OPERATION_RUNTIME_SECONDS', 'type' => 'xsd:string')
    )
);

$server->wsdl->addComplexType(
    'oEmailArray',
    'complexType',
    'array',
    '',
    'SOAP-ENC:Array',
    array(),
    array(
        array(
            'ref' => 'SOAP-ENC:arrayType',
            'wsdl:arrayType' => 'tns:oEmail[]'
        )
    ),
    'tns:oEmail'
);

$server->wsdl->addComplexType(
    '_____oEmailArray',
    'complexType',
    'array',
    '',
    'SOAP-ENC:Array',
    array(),
    array(
        array(
            'ref' => 'SOAP-ENC:arrayType',
            'wsdl:arrayType' => 'xsd:integer[]'
        )
    ),
    'xsd:integer'
);

$server->wsdl->addComplexType(
    'oEmail',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'EMAIL_PROXY_SERIAL' => array('name' => 'EMAIL_PROXY_SERIAL', 'type' => 'tns:oSOAP_Data'),
        'EMAIL' => array('name' => 'EMAIL', 'type' => 'tns:oSOAP_Data'),
        'NAME' => array('name' => 'NAME', 'type' => 'tns:oSOAP_Data'),
        'FIRSTNAME' => array('name' => 'FIRSTNAME', 'type' => 'tns:oSOAP_Data'),
        'LASTNAME' => array('name' => 'LASTNAME', 'type' => 'tns:oSOAP_Data')
    )
);

$server->wsdl->addComplexType(
    'oSOAP_Data',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'CONTENT' => array('name' => 'CONTENT', 'type' => 'xsd:string'),
        'TYPE' => array('name' => 'TYPE', 'type' => 'xsd:string'),
        'LENGTH' => array('name' => 'LENGTH', 'type' => 'xsd:string')
    )
);

$server->wsdl->addComplexType(
    'oCRNRSTN_UI_SYNC_PACKET',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'CRNRSTN_PACKET_IS_ENCRYPTED'=> array('name' => 'CRNRSTN_PACKET_IS_ENCRYPTED', 'type' => 'xsd:string'),
        'CRNRSTN_SOAP_SVC_AUTH_KEY' => array('name' => 'CRNRSTN_SOAP_SVC_AUTH_KEY', 'type' => 'xsd:string'),
        'CRNRSTN_SOAP_SVC_USERNAME' => array('name' => 'CRNRSTN_SOAP_SVC_USERNAME', 'type' => 'xsd:string'),
        'SOAP_SERVICES_AUTH_STATUS' => array('name' => 'SOAP_SERVICES_AUTH_STATUS', 'type' => 'xsd:string'),
        'RESPONSE_FORMAT' => array('name' => 'RESPONSE_FORMAT', 'type' => 'xsd:string'),
        'oBASSDRIVE' => array('name' => 'oBASSDRIVE', 'type' => 'tns:oBASSDRIVE'),
        'oWETHRBUG' => array('name' => 'oWETHRBUG', 'type' => 'tns:oWETHRBUG'),
        'oCSS_VALIDATOR' => array('name' => 'oCSS_VALIDATOR', 'type' => 'tns:oCSS_VALIDATOR'),
        'ACTIVITY_STATUS_MESSAGE' => array('name' => 'ACTIVITY_STATUS_MESSAGE', 'type' => 'xsd:string'),
        'oACTIVITY_STATUS_REPORT' => array('name' => 'oACTIVITY_STATUS_REPORT', 'type' => 'tns:oStatusReportArray'),
        'STATUS_CODE' => array('name' => 'STATUS_CODE', 'type' => 'xsd:string'),
        'STATUS_MESSAGE' => array('name' => 'STATUS_MESSAGE', 'type' => 'xsd:string'),
        'ISERROR_CODE' => array('name' => 'ISERROR_CODE', 'type' => 'xsd:string'),
        'ISERROR_MESSAGE' => array('name' => 'ISERROR_MESSAGE', 'type' => 'xsd:string'),
        'SERVER_NAME_SOAP_SERVER' => array('name' => 'SERVER_NAME_SOAP_SERVER', 'type' => 'xsd:string'),
        'SERVER_ADDRESS_SOAP_SERVER' => array('name' => 'SERVER_ADDRESS_SOAP_SERVER', 'type' => 'xsd:string'),
        'SERVER_NAME_SOAP_CLIENT' => array('name' => 'SERVER_NAME_SOAP_CLIENT', 'type' => 'xsd:string'),
        'SERVER_ADDRESS_SOAP_CLIENT' => array('name' => 'SERVER_ADDRESS_SOAP_CLIENT', 'type' => 'xsd:string'),
        'DATE_RECEIVED_SOAP_REQUEST' => array('name' => 'DATE_RECEIVED_SOAP_REQUEST', 'type' => 'xsd:string'),
        'DATE_CREATED_SOAP_RESPONSE' => array('name' => 'DATE_CREATED_SOAP_RESPONSE', 'type' => 'xsd:string'),
        'SOAP_OPERATION_RUNTIME_SECONDS' => array('name' => 'SOAP_OPERATION_RUNTIME_SECONDS', 'type' => 'xsd:string')

    )
);

$server->wsdl->addComplexType(
    'oConstArray',
    'complexType',
    'array',
    '',
    'SOAP-ENC:Array',
    array(),
    array(
        array(
            'ref' => 'SOAP-ENC:arrayType',
            'wsdl:arrayType' => 'tns:oCRNRSTN_RESOURCE_CONSTANTS[]'
        )
    ),
    'tns:oCRNRSTN_RESOURCE_CONSTANTS'
);

$server->wsdl->addComplexType(
    'oCRNRSTN_RESOURCE_CONSTANTS',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'CONSTANT_NOM'=> array('name' => 'CONSTANT_NOM', 'type' => 'xsd:string'),
        'CONSTANT_VALUE'=> array('name' => 'CONSTANT_VALUE', 'type' => 'xsd:string')
    )
);

$server->wsdl->addComplexType(
    'oBASSDRIVE',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'DATA_OBJECT_RAW' => array('name' => 'DATA_OBJECT_RAW', 'type' => 'xsd:string'),
        'DATA_OBJECT_RAW_URI' => array('name' => 'DATA_OBJECT_RAW_URI', 'type' => 'xsd:string'),
        'STATUS' => array('name' => 'STATUS', 'type' => 'xsd:string'),
        'SHOW_TITLE' => array('name' => 'SHOW_TITLE', 'type' => 'xsd:string'),
        'SHOW_NATION_CREATIVE' => array('name' => 'SHOW_NATION_CREATIVE', 'type' => 'xsd:string'),
        'SHOW_LOCALE' => array('name' => 'SHOW_LOCALE', 'type' => 'xsd:string'),
        'ISLIVE' => array('name' => 'ISLIVE', 'type' => 'xsd:string'),
        'TRANSMISSION_RATE' => array('name' => 'TRANSMISSION_RATE', 'type' => 'xsd:string'),
        'LAST_UPDATED' => array('name' => 'LAST_UPDATED', 'type' => 'xsd:string')
    )
);

$server->wsdl->addComplexType(
    'oWETHRBUG',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'CITY' => array('name' => 'CITY', 'type' => 'xsd:string'),
        'ZIPCODE' => array('name' => 'ZIPCODE', 'type' => 'xsd:string'),
        'XYGRID_GEOZIP_URI' => array('name' => 'XYGRID_GEOZIP_URI', 'type' => 'xsd:string'),
        'GEOZIP_FORECAST_URI' => array('name' => 'GEOZIP_FORECAST_URI', 'type' => 'xsd:string'),
        
        'DAY00_NOM' => array('name' => 'DAY00_NOM', 'type' => 'xsd:string'),
        'DAY01_NOM' => array('name' => 'DAY01_NOM', 'type' => 'xsd:string'),
        'DAY02_NOM' => array('name' => 'DAY02_NOM', 'type' => 'xsd:string'),
        'DAY03_NOM' => array('name' => 'DAY03_NOM', 'type' => 'xsd:string'),
        'DAY04_NOM' => array('name' => 'DAY04_NOM', 'type' => 'xsd:string'),
        'DAY05_NOM' => array('name' => 'DAY05_NOM', 'type' => 'xsd:string'),
        'DAY06_NOM' => array('name' => 'DAY06_NOM', 'type' => 'xsd:string'),
        
        'DAY00_TEMP' => array('name' => 'DAY00_TEMP', 'type' => 'xsd:string'),
        'DAY01_TEMP' => array('name' => 'DAY01_TEMP', 'type' => 'xsd:string'),
        'DAY02_TEMP' => array('name' => 'DAY02_TEMP', 'type' => 'xsd:string'),
        'DAY03_TEMP' => array('name' => 'DAY03_TEMP', 'type' => 'xsd:string'),
        'DAY04_TEMP' => array('name' => 'DAY04_TEMP', 'type' => 'xsd:string'),
        'DAY05_TEMP' => array('name' => 'DAY05_TEMP', 'type' => 'xsd:string'),
        'DAY06_TEMP' => array('name' => 'DAY06_TEMP', 'type' => 'xsd:string'),
        
        'DAY00_TEMP_UNIT' => array('name' => 'DAY00_TEMP_UNIT', 'type' => 'xsd:string'),
        'DAY01_TEMP_UNIT' => array('name' => 'DAY01_TEMP_UNIT', 'type' => 'xsd:string'),
        'DAY02_TEMP_UNIT' => array('name' => 'DAY02_TEMP_UNIT', 'type' => 'xsd:string'),
        'DAY03_TEMP_UNIT' => array('name' => 'DAY03_TEMP_UNIT', 'type' => 'xsd:string'),
        'DAY04_TEMP_UNIT' => array('name' => 'DAY04_TEMP_UNIT', 'type' => 'xsd:string'),
        'DAY05_TEMP_UNIT' => array('name' => 'DAY05_TEMP_UNIT', 'type' => 'xsd:string'),
        'DAY06_TEMP_UNIT' => array('name' => 'DAY06_TEMP_UNIT', 'type' => 'xsd:string'),

        'DAY00_SHORT_FORECAST' => array('name' => 'DAY00_SHORT_FORECAST', 'type' => 'xsd:string'),
        'DAY01_SHORT_FORECAST' => array('name' => 'DAY01_SHORT_FORECAST', 'type' => 'xsd:string'),
        'DAY02_SHORT_FORECAST' => array('name' => 'DAY02_SHORT_FORECAST', 'type' => 'xsd:string'),
        'DAY03_SHORT_FORECAST' => array('name' => 'DAY03_SHORT_FORECAST', 'type' => 'xsd:string'),
        'DAY04_SHORT_FORECAST' => array('name' => 'DAY04_SHORT_FORECAST', 'type' => 'xsd:string'),
        'DAY05_SHORT_FORECAST' => array('name' => 'DAY05_SHORT_FORECAST', 'type' => 'xsd:string'),
        'DAY06_SHORT_FORECAST' => array('name' => 'DAY06_SHORT_FORECAST', 'type' => 'xsd:string'),

        'DAY00_DETAILED_FORECAST' => array('name' => 'DAY00_DETAILED_FORECAST', 'type' => 'xsd:string'),
        'DAY01_DETAILED_FORECAST' => array('name' => 'DAY01_DETAILED_FORECAST', 'type' => 'xsd:string'),
        'DAY02_DETAILED_FORECAST' => array('name' => 'DAY02_DETAILED_FORECAST', 'type' => 'xsd:string'),
        'DAY03_DETAILED_FORECAST' => array('name' => 'DAY03_DETAILED_FORECAST', 'type' => 'xsd:string'),
        'DAY04_DETAILED_FORECAST' => array('name' => 'DAY04_DETAILED_FORECAST', 'type' => 'xsd:string'),
        'DAY05_DETAILED_FORECAST' => array('name' => 'DAY05_DETAILED_FORECAST', 'type' => 'xsd:string'),
        'DAY06_DETAILED_FORECAST' => array('name' => 'DAY06_DETAILED_FORECAST', 'type' => 'xsd:string'),

        'DAY00_WINDAGE' => array('name' => 'DAY00_WINDAGE', 'type' => 'xsd:string'),
        'DAY01_WINDAGE' => array('name' => 'DAY01_WINDAGE', 'type' => 'xsd:string'),
        'DAY02_WINDAGE' => array('name' => 'DAY02_WINDAGE', 'type' => 'xsd:string'),
        'DAY03_WINDAGE' => array('name' => 'DAY03_WINDAGE', 'type' => 'xsd:string'),
        'DAY04_WINDAGE' => array('name' => 'DAY04_WINDAGE', 'type' => 'xsd:string'),
        'DAY05_WINDAGE' => array('name' => 'DAY05_WINDAGE', 'type' => 'xsd:string'),
        'DAY06_WINDAGE' => array('name' => 'DAY06_WINDAGE', 'type' => 'xsd:string'),

        'DAY00_START_TIME' => array('name' => 'DAY00_START_TIME', 'type' => 'xsd:string'),
        'DAY01_START_TIME' => array('name' => 'DAY01_START_TIME', 'type' => 'xsd:string'),
        'DAY02_START_TIME' => array('name' => 'DAY02_START_TIME', 'type' => 'xsd:string'),
        'DAY03_START_TIME' => array('name' => 'DAY03_START_TIME', 'type' => 'xsd:string'),
        'DAY04_START_TIME' => array('name' => 'DAY04_START_TIME', 'type' => 'xsd:string'),
        'DAY05_START_TIME' => array('name' => 'DAY05_START_TIME', 'type' => 'xsd:string'),
        'DAY06_START_TIME' => array('name' => 'DAY06_START_TIME', 'type' => 'xsd:string'),
        
        'DAY00_END_TIME' => array('name' => 'DAY00_END_TIME', 'type' => 'xsd:string'),
        'DAY01_END_TIME' => array('name' => 'DAY01_END_TIME', 'type' => 'xsd:string'),
        'DAY02_END_TIME' => array('name' => 'DAY02_END_TIME', 'type' => 'xsd:string'),
        'DAY03_END_TIME' => array('name' => 'DAY03_END_TIME', 'type' => 'xsd:string'),
        'DAY04_END_TIME' => array('name' => 'DAY04_END_TIME', 'type' => 'xsd:string'),
        'DAY05_END_TIME' => array('name' => 'DAY05_END_TIME', 'type' => 'xsd:string'),
        'DAY06_END_TIME' => array('name' => 'DAY06_END_TIME', 'type' => 'xsd:string'),
        
        'DAY00_ICON' => array('name' => 'DAY00_ICON', 'type' => 'xsd:string'),
        'DAY01_ICON' => array('name' => 'DAY01_ICON', 'type' => 'xsd:string'),
        'DAY02_ICON' => array('name' => 'DAY02_ICON', 'type' => 'xsd:string'),
        'DAY03_ICON' => array('name' => 'DAY03_ICON', 'type' => 'xsd:string'),
        'DAY04_ICON' => array('name' => 'DAY04_ICON', 'type' => 'xsd:string'),
        'DAY05_ICON' => array('name' => 'DAY05_ICON', 'type' => 'xsd:string'),
        'DAY06_ICON' => array('name' => 'DAY06_ICON', 'type' => 'xsd:string'),

        'NIGHT00_NOM' => array('name' => 'NIGHT00_NOM', 'type' => 'xsd:string'),
        'NIGHT01_NOM' => array('name' => 'NIGHT01_NOM', 'type' => 'xsd:string'),
        'NIGHT02_NOM' => array('name' => 'NIGHT02_NOM', 'type' => 'xsd:string'),
        'NIGHT03_NOM' => array('name' => 'NIGHT03_NOM', 'type' => 'xsd:string'),
        'NIGHT04_NOM' => array('name' => 'NIGHT04_NOM', 'type' => 'xsd:string'),
        'NIGHT05_NOM' => array('name' => 'NIGHT05_NOM', 'type' => 'xsd:string'),
        'NIGHT06_NOM' => array('name' => 'NIGHT06_NOM', 'type' => 'xsd:string'),

        'NIGHT00_TEMP' => array('name' => 'NIGHT00_TEMP', 'type' => 'xsd:string'),
        'NIGHT01_TEMP' => array('name' => 'NIGHT01_TEMP', 'type' => 'xsd:string'),
        'NIGHT02_TEMP' => array('name' => 'NIGHT02_TEMP', 'type' => 'xsd:string'),
        'NIGHT03_TEMP' => array('name' => 'NIGHT03_TEMP', 'type' => 'xsd:string'),
        'NIGHT04_TEMP' => array('name' => 'NIGHT04_TEMP', 'type' => 'xsd:string'),
        'NIGHT05_TEMP' => array('name' => 'NIGHT05_TEMP', 'type' => 'xsd:string'),
        'NIGHT06_TEMP' => array('name' => 'NIGHT06_TEMP', 'type' => 'xsd:string'),

        'NIGHT00_TEMP_UNIT' => array('name' => 'NIGHT00_TEMP_UNIT', 'type' => 'xsd:string'),
        'NIGHT01_TEMP_UNIT' => array('name' => 'NIGHT01_TEMP_UNIT', 'type' => 'xsd:string'),
        'NIGHT02_TEMP_UNIT' => array('name' => 'NIGHT02_TEMP_UNIT', 'type' => 'xsd:string'),
        'NIGHT03_TEMP_UNIT' => array('name' => 'NIGHT03_TEMP_UNIT', 'type' => 'xsd:string'),
        'NIGHT04_TEMP_UNIT' => array('name' => 'NIGHT04_TEMP_UNIT', 'type' => 'xsd:string'),
        'NIGHT05_TEMP_UNIT' => array('name' => 'NIGHT05_TEMP_UNIT', 'type' => 'xsd:string'),
        'NIGHT06_TEMP_UNIT' => array('name' => 'NIGHT06_TEMP_UNIT', 'type' => 'xsd:string'),

        'NIGHT00_SHORT_FORECAST' => array('name' => 'NIGHT00_SHORT_FORECAST', 'type' => 'xsd:string'),
        'NIGHT01_SHORT_FORECAST' => array('name' => 'NIGHT01_SHORT_FORECAST', 'type' => 'xsd:string'),
        'NIGHT02_SHORT_FORECAST' => array('name' => 'NIGHT02_SHORT_FORECAST', 'type' => 'xsd:string'),
        'NIGHT03_SHORT_FORECAST' => array('name' => 'NIGHT03_SHORT_FORECAST', 'type' => 'xsd:string'),
        'NIGHT04_SHORT_FORECAST' => array('name' => 'NIGHT04_SHORT_FORECAST', 'type' => 'xsd:string'),
        'NIGHT05_SHORT_FORECAST' => array('name' => 'NIGHT05_SHORT_FORECAST', 'type' => 'xsd:string'),
        'NIGHT06_SHORT_FORECAST' => array('name' => 'NIGHT06_SHORT_FORECAST', 'type' => 'xsd:string'),

        'NIGHT00_DETAILED_FORECAST' => array('name' => 'NIGHT00_DETAILED_FORECAST', 'type' => 'xsd:string'),
        'NIGHT01_DETAILED_FORECAST' => array('name' => 'NIGHT01_DETAILED_FORECAST', 'type' => 'xsd:string'),
        'NIGHT02_DETAILED_FORECAST' => array('name' => 'NIGHT02_DETAILED_FORECAST', 'type' => 'xsd:string'),
        'NIGHT03_DETAILED_FORECAST' => array('name' => 'NIGHT03_DETAILED_FORECAST', 'type' => 'xsd:string'),
        'NIGHT04_DETAILED_FORECAST' => array('name' => 'NIGHT04_DETAILED_FORECAST', 'type' => 'xsd:string'),
        'NIGHT05_DETAILED_FORECAST' => array('name' => 'NIGHT05_DETAILED_FORECAST', 'type' => 'xsd:string'),
        'NIGHT06_DETAILED_FORECAST' => array('name' => 'NIGHT06_DETAILED_FORECAST', 'type' => 'xsd:string'),

        'NIGHT00_WINDAGE' => array('name' => 'NIGHT00_WINDAGE', 'type' => 'xsd:string'),
        'NIGHT01_WINDAGE' => array('name' => 'NIGHT01_WINDAGE', 'type' => 'xsd:string'),
        'NIGHT02_WINDAGE' => array('name' => 'NIGHT02_WINDAGE', 'type' => 'xsd:string'),
        'NIGHT03_WINDAGE' => array('name' => 'NIGHT03_WINDAGE', 'type' => 'xsd:string'),
        'NIGHT04_WINDAGE' => array('name' => 'NIGHT04_WINDAGE', 'type' => 'xsd:string'),
        'NIGHT05_WINDAGE' => array('name' => 'NIGHT05_WINDAGE', 'type' => 'xsd:string'),
        'NIGHT06_WINDAGE' => array('name' => 'NIGHT06_WINDAGE', 'type' => 'xsd:string'),

        'NIGHT00_START_TIME' => array('name' => 'NIGHT00_START_TIME', 'type' => 'xsd:string'),
        'NIGHT01_START_TIME' => array('name' => 'NIGHT01_START_TIME', 'type' => 'xsd:string'),
        'NIGHT02_START_TIME' => array('name' => 'NIGHT02_START_TIME', 'type' => 'xsd:string'),
        'NIGHT03_START_TIME' => array('name' => 'NIGHT03_START_TIME', 'type' => 'xsd:string'),
        'NIGHT04_START_TIME' => array('name' => 'NIGHT04_START_TIME', 'type' => 'xsd:string'),
        'NIGHT05_START_TIME' => array('name' => 'NIGHT05_START_TIME', 'type' => 'xsd:string'),
        'NIGHT06_START_TIME' => array('name' => 'NIGHT06_START_TIME', 'type' => 'xsd:string'),

        'NIGHT00_END_TIME' => array('name' => 'NIGHT00_END_TIME', 'type' => 'xsd:string'),
        'NIGHT01_END_TIME' => array('name' => 'NIGHT01_END_TIME', 'type' => 'xsd:string'),
        'NIGHT02_END_TIME' => array('name' => 'NIGHT02_END_TIME', 'type' => 'xsd:string'),
        'NIGHT03_END_TIME' => array('name' => 'NIGHT03_END_TIME', 'type' => 'xsd:string'),
        'NIGHT04_END_TIME' => array('name' => 'NIGHT04_END_TIME', 'type' => 'xsd:string'),
        'NIGHT05_END_TIME' => array('name' => 'NIGHT05_END_TIME', 'type' => 'xsd:string'),
        'NIGHT06_END_TIME' => array('name' => 'NIGHT06_END_TIME', 'type' => 'xsd:string'),

        'NIGHT00_ICON' => array('name' => 'NIGHT00_ICON', 'type' => 'xsd:string'),
        'NIGHT01_ICON' => array('name' => 'NIGHT01_ICON', 'type' => 'xsd:string'),
        'NIGHT02_ICON' => array('name' => 'NIGHT02_ICON', 'type' => 'xsd:string'),
        'NIGHT03_ICON' => array('name' => 'NIGHT03_ICON', 'type' => 'xsd:string'),
        'NIGHT04_ICON' => array('name' => 'NIGHT04_ICON', 'type' => 'xsd:string'),
        'NIGHT05_ICON' => array('name' => 'NIGHT05_ICON', 'type' => 'xsd:string'),
        'NIGHT06_ICON' => array('name' => 'NIGHT06_ICON', 'type' => 'xsd:string')

    )
    
);

$server->wsdl->addComplexType(
    'oCSS_VALIDATOR',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'CSS_ELEMENT_NOM' => array('name' => 'CSS_ELEMENT_NOM', 'type' => 'xsd:string')
    )
);

$server->wsdl->addComplexType(
    'oEmailSendReport',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'CRNRSTN_PACKET_IS_ENCRYPTED' => array('name' => 'CRNRSTN_PACKET_IS_ENCRYPTED', 'type' => 'xsd:string'),
        'CRNRSTN_SOAP_SVC_AUTH_KEY' => array('name' => 'CRNRSTN_SOAP_SVC_AUTH_KEY', 'type' => 'xsd:string'),
        'CRNRSTN_SOAP_SVC_USERNAME' => array('name' => 'CRNRSTN_SOAP_SVC_USERNAME', 'type' => 'xsd:string'),
        'AUTHENTICATION_TOKEN' => array('name' => 'AUTHENTICATION_TOKEN', 'type' => 'xsd:string'),
        'SOAP_SERVICES_AUTH_STATUS' => array('name' => 'SOAP_SERVICES_AUTH_STATUS', 'type' => 'xsd:string'),
        'TOTAL_EMAILS_RECEIVED' => array('name' => 'TOTAL_EMAILS_RECEIVED', 'type' => 'xsd:string'),
        'TOTAL_EMAILS_SENT' => array('name' => 'TOTAL_EMAILS_SENT', 'type' => 'xsd:string'),
        'TOTAL_EMAILS_SUPPRESSED' => array('name' => 'TOTAL_EMAILS_SUPPRESSED', 'type' => 'xsd:string'),
        'TOTAL_EMAILS_ERROR' => array('name' => 'TOTAL_EMAILS_ERROR', 'type' => 'xsd:string'),
        'ACTIVITY_STATUS_MESSAGE' => array('name' => 'ACTIVITY_STATUS_MESSAGE', 'type' => 'xsd:string'),
        'oACTIVITY_STATUS_REPORT' => array('name' => 'oACTIVITY_STATUS_REPORT', 'type' => 'tns:oStatusReportArray'),
        'STATUS_CODE' => array('name' => 'STATUS_CODE', 'type' => 'xsd:string'),
        'STATUS_MESSAGE' => array('name' => 'STATUS_MESSAGE', 'type' => 'xsd:string'),
        'ISERROR_CODE' => array('name' => 'ISERROR_CODE', 'type' => 'xsd:string'),
        'ISERROR_MESSAGE' => array('name' => 'ISERROR_MESSAGE', 'type' => 'xsd:string'),
        'SERVER_NAME_SOAP_SERVER' => array('name' => 'SERVER_NAME_SOAP_SERVER', 'type' => 'xsd:string'),
        'SERVER_ADDRESS_SOAP_SERVER' => array('name' => 'SERVER_ADDRESS_SOAP_SERVER', 'type' => 'xsd:string'),
        'SERVER_NAME_SOAP_CLIENT' => array('name' => 'SERVER_NAME_SOAP_CLIENT', 'type' => 'xsd:string'),
        'SERVER_ADDRESS_SOAP_CLIENT' => array('name' => 'SERVER_ADDRESS_SOAP_CLIENT', 'type' => 'xsd:string'),
        'DATE_RECEIVED_SOAP_REQUEST' => array('name' => 'DATE_RECEIVED_SOAP_REQUEST', 'type' => 'xsd:string'),
        'DATE_CREATED_SOAP_RESPONSE' => array('name' => 'DATE_CREATED_SOAP_RESPONSE', 'type' => 'xsd:string'),
        'SOAP_OPERATION_RUNTIME_SECONDS' => array('name' => 'SOAP_OPERATION_RUNTIME_SECONDS', 'type' => 'xsd:string')
    )
);


$server->wsdl->addComplexType(
    'oStatusReportArray',
    'complexType',
    'array',
    '',
    'SOAP-ENC:Array',
    array(),
    array('name'=>array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:oStatusReport[]')
    ),
    'tns:oStatusReport'
);

$server->wsdl->addComplexType(
    'oStatusReport',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'EMAIL_PROXY_SERIAL' => array('name' => 'EMAIL_PROXY_SERIAL', 'type' => 'xsd:string'),
        'IS_SENT' => array('name' => 'IS_SENT', 'type' => 'xsd:string'),
        'SEND_TIMESTAMP' => array('name' => 'SEND_TIMESTAMP', 'type' => 'xsd:string'),
        'SEND_STATUS' => array('name' => 'SEND_STATUS', 'type' => 'xsd:string'),
        'STATUS_DETAIL' => array('name' => 'STATUS_DETAIL', 'type' => 'xsd:string')
    )
);

$server->wsdl->addComplexType(
    'oTunnelEncryptionCalibrationRequest',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'CRNRSTN_PACKET_IS_ENCRYPTED' => array('name' => 'CRNRSTN_PACKET_IS_ENCRYPTED', 'type' => 'xsd:string'),
        'SOAP_ENCRYPT_CIPHER' => array('name' => 'SOAP_ENCRYPT_CIPHER', 'type' => 'xsd:string'),
        'SOAP_ENCRYPT_SECRET_KEY' => array('name' => 'SOAP_ENCRYPT_SECRET_KEY', 'type' => 'xsd:string'),
        'SOAP_ENCRYPT_HMAC_ALG' => array('name' => 'SOAP_ENCRYPT_HMAC_ALG', 'type' => 'xsd:string'),
        'SOAP_ENCRYPT_OPTIONS' => array('name' => 'SOAP_ENCRYPT_OPTIONS', 'type' => 'xsd:string'),
        'SERVER_NAME_SOAP_CLIENT' => array('name' => 'SERVER_NAME_SOAP_CLIENT', 'type' => 'xsd:string'),
        'SERVER_ADDRESS_SOAP_CLIENT' => array('name' => 'SERVER_ADDRESS_SOAP_CLIENT', 'type' => 'xsd:string')
    )
);

$server->wsdl->addComplexType(
    'oCalibrationResponse',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'CRNRSTN_PACKET_IS_ENCRYPTED' => array('name' => 'CRNRSTN_PACKET_IS_ENCRYPTED', 'type' => 'xsd:string'),
        'SOAP_SERVICES_AUTH_STATUS' => array('name' => 'SOAP_SERVICES_AUTH_STATUS', 'type' => 'xsd:string'),
        'SOAP_ENCRYPT_CIPHER' => array('name' => 'SOAP_ENCRYPT_CIPHER', 'type' => 'xsd:string'),
        'SOAP_ENCRYPT_HMAC_ALG' => array('name' => 'SOAP_ENCRYPT_HMAC_ALG', 'type' => 'xsd:string'),
        'SOAP_ENCRYPT_OPTIONS' => array('name' => 'SOAP_ENCRYPT_OPTIONS', 'type' => 'xsd:string'),
        'STATUS_CODE' => array('name' => 'STATUS_CODE', 'type' => 'xsd:string'),
        'STATUS_MESSAGE' => array('name' => 'STATUS_MESSAGE', 'type' => 'xsd:string'),
        'ISERROR_CODE' => array('name' => 'ISERROR_CODE', 'type' => 'xsd:string'),
        'ISERROR_MESSAGE' => array('name' => 'ISERROR_MESSAGE', 'type' => 'xsd:string'),
        'SERVER_NAME_SOAP_SERVER' => array('name' => 'SERVER_NAME_SOAP_SERVER', 'type' => 'xsd:string'),
        'SERVER_ADDRESS_SOAP_SERVER' => array('name' => 'SERVER_ADDRESS_SOAP_SERVER', 'type' => 'xsd:string'),
        'SERVER_NAME_SOAP_CLIENT' => array('name' => 'SERVER_NAME_SOAP_CLIENT', 'type' => 'xsd:string'),
        'SERVER_ADDRESS_SOAP_CLIENT' => array('name' => 'SERVER_ADDRESS_SOAP_CLIENT', 'type' => 'xsd:string'),
        'DATE_RECEIVED_SOAP_REQUEST' => array('name' => 'DATE_RECEIVED_SOAP_REQUEST', 'type' => 'xsd:string'),
        'DATE_CREATED_SOAP_RESPONSE' => array('name' => 'DATE_CREATED_SOAP_RESPONSE', 'type' => 'xsd:string'),
        'SOAP_OPERATION_RUNTIME_SECONDS' => array('name' => 'SOAP_OPERATION_RUNTIME_SECONDS', 'type' => 'xsd:string')
    )
);

function tunnelEncryptCalibrationRequest($soapRequest) {

    $SERVICE_RESPONSE = '';

    //
    // INSTANTIATE A WEB SERVICES REQUEST MANAGER CLASS OBJECT.
    $oSERVICE_REQUEST_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_USR']);

    //
    // PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
    $SERVICE_RESPONSE = $oSERVICE_REQUEST_MGR->tunnelEncryptCalibrationRequest($soapRequest);

    return $SERVICE_RESPONSE;

}

function mayItakeTheKingsHighway($soapRequest) {

    $SERVICE_RESPONSE = '';

    //
    // INSTANTIATE A WEB SERVICES REQUEST MANAGER CLASS OBJECT.
    $oSERVICE_REQUEST_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_USR']);

    //
    // PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
    $SERVICE_RESPONSE = $oSERVICE_REQUEST_MGR->mayItakeTheKingsHighway($soapRequest);

    return $SERVICE_RESPONSE;

}

function takeTheKingsHighway($soapRequest) {

    $SERVICE_RESPONSE = '';

    //
    // INSTANTIATE A WEB SERVICES REQUEST MANAGER CLASS OBJECT.
    $oSERVICE_REQUEST_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_USR']);

    //
    // PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
    $SERVICE_RESPONSE = $oSERVICE_REQUEST_MGR->takeTheKingsHighway($soapRequest);

    return $SERVICE_RESPONSE;

}

function sendElectrumPerformanceReport($soapRequest) {

    $SERVICE_RESPONSE = '';

    //
    // INSTANTIATE A WEB SERVICES REQUEST MANAGER CLASS OBJECT.
    $oSERVICE_REQUEST_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_USR']);

    //
    // PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
    $SERVICE_RESPONSE = $oSERVICE_REQUEST_MGR->sendElectrumPerformanceReport($soapRequest);

    return $SERVICE_RESPONSE;

}

function returnCRNRSTN_UI_GLOBAL_SYNC($soapRequest) {

    $SERVICE_RESPONSE = '';

    //
    // INSTANTIATE A WEB SERVICES REQUEST MANAGER CLASS OBJECT.
    $oSERVICE_REQUEST_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_USR']);

    //
    // PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
    $SERVICE_RESPONSE = $oSERVICE_REQUEST_MGR->returnCRNRSTN_UI_GLOBAL_SYNC($soapRequest);

    return $SERVICE_RESPONSE;

}

$server->register('tunnelEncryptCalibrationRequest',     		 	   		                        // method name
    array('oTunnelEncryptionCalibrationRequest' => 'tns:oTunnelEncryptionCalibrationRequest'),	    // input parameters
    array('return' => 'tns:oCalibrationResponse'),								                    // output parameters
    'urn:tunnelEncryptCalibrationRequestwsdl',                		                                // namespace
    'urn:tunnelEncryptCalibrationRequestwsdl#tunnelEncryptCalibrationRequest',                      // soapaction
    'rpc',                                    					                                    // style
    'encoded',                                						                                // use
    'Initiate handshake with the CRNRSTN :: SOAP Services Layer.'		                            // documentation
);

$server->register('mayItakeTheKingsHighway',     		 	   		                                // method name
    array('oKingsHighwayAuthRequest' => 'tns:oKingsHighwayAuthRequest'),	                        // input parameters
    array('return' => 'tns:oKingsHighwayAuthResponse'),								                // output parameters
    'urn:mayItakeTheKingsHighwaywsdl',                		                                        // namespace
    'urn:mayItakeTheKingsHighwaywsdl#mayItakeTheKingsHighway',	                                    // soapaction
    'rpc',                                    					                                    // style
    'encoded',                                						                                // use
    'Authorization request to straight send an email message with no changes (i.e. dynamic content injection) to body.'		// documentation
);

$server->register('takeTheKingsHighway',     		 	   		                                    // method name
    array('oKingsHighwayNotification' => 'tns:oKingsHighwayNotification'),	                        // input parameters
    array('return' => 'tns:oEmailSendReport'),								                        // output parameters
    'urn:takeTheKingsHighwaywsdl',                		                                            // namespace
    'urn:takeTheKingsHighwaywsdl#takeTheKingsHighway',	                                            // soapaction
    'rpc',                                    					                                    // style
    'encoded',                                						                                // use
    'Straight send an email message with no changes (i.e. dynamic content injection) to body.'		// documentation
);

$server->register('sendElectrumPerformanceReport',     		 	   		                            // method name
    array('oElectrumPerformanceReport' => 'tns:oElectrumPerformanceReport'),	                    // input parameters
    array('return' => 'tns:oEmailSendReport'),								                        // output parameters
    'urn:sendElectrumPerformanceReportwsdl',                		                                // namespace
    'urn:sendElectrumPerformanceReportwsdl#sendElectrumPerformanceReport',	                        // soapaction
    'rpc',                                    					                                    // style
    'encoded',                                						                                // use
    'Send a templated system notification reporting on the performance of a CRNRSTN :: Electrum process.'		// documentation
);

$server->register('returnCRNRSTN_UI_GLOBAL_SYNC',     		 	   		                            // method name
    array('oCRNRSTN_UI_GLOBAL_SYNC_REQUEST' => 'tns:oCRNRSTN_UI_GLOBAL_SYNC_REQUEST'),	            // input parameters
    array('return' => 'tns:oCRNRSTN_UI_SYNC_PACKET'),								                // output parameters
    'urn:returnCRNRSTN_UI_GLOBAL_SYNCwsdl',                		                                    // namespace
    'urn:returnCRNRSTN_UI_GLOBAL_SYNCwsdl#returnCRNRSTN_UI_GLOBAL_SYNC',	                        // soapaction
    'rpc',                                    					                                    // style
    'encoded',                                						                                // use
    'Request a packet of data to refresh browser ui content.'                                       // documentation
);

if(!$oCRNRSTN_USR->isset_http_superglobal('GET')){

	//if($oCRNRSTN_USR->exclusiveAccess('184.173.96.66, 50.87.249.11, 172.16.110.130, 172.16.*')){

//        error_log(__LINE__.' soap wsdl POST='.print_r($_REQUEST, true));
//        //$oCRNRSTN_USR->print_r($_POST, 'C<span style="color:#F00;">R</span>NRSTN :: v' . $oCRNRSTN_USR->version_crnrstn().' SOAP CLIENT RAW php//input', NULL, __LINE__, __METHOD__, __FILE__);
//	    die();
        $server->service(file_get_contents('php://input'));

	//}else{

    //    $oCRNRSTN_USR->return_server_response_code(403);

	//}

}else{

    $server->service(file_get_contents('php://input'));

}

exit();