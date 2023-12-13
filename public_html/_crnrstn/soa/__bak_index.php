<?php
/*
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
require('_crnrstn.root.inc.php');
require(CRNRSTN_ROOT.'_crnrstn.config.inc.php');
#error_log("/services/ index.php (8) Value for DOCUMENT_ROOT: ".$oCRNRSTN_USR->get_resource('DOCUMENT_ROOT')." and _CRNRSTN_ENV_KEY :: ".$_SESSION['jRs72bd0'.'CRNRSTN'.self::$oCRNRSTN_USR->crcINT('_CRNRSTN_ENV_KEY')]);
#require($oCRNRSTN_USR->get_resource('DOCUMENT_ROOT').'/services/common/classes/webservice.inc.php');
require($oCRNRSTN_USR->get_resource('DOCUMENT_ROOT').$oCRNRSTN_USR->get_resource('DOCUMENT_ROOT_DIR').'/_crnrstn/class/soa/crnrstn.webservice.inc.php');

//
// INSTANTIATE A SOAP SERVER CLASS OBJECT, AND PROVIDE SESSION ACCESS TO ENVIRONMENTAL CLASS OBJECT.
$server = new soap_server();
$server->debug_flag = false;
$server->configureWSDL("CRNRSTN_MESSENGER_FROM_NORTH", $oCRNRSTN_USR->get_resource('SOA_NAMESPACE'));
$server->wsdl->schemaTargetNamespace = $oCRNRSTN_USR->get_resource('SOA_NAMESPACE');
$oCRNRSTN_ENV = $oCRNRSTN_USR->return_oCRNRSTN_ENV();
$_SESSION['oCRNRSTN_ENV']=$oCRNRSTN_ENV;

//
// REGISTER THE DATA STRUCTURES USED BY THE SERVICE
$server->wsdl->addComplexType(
	'olikeLink',
	'complexType',
	'struct',
	'all',
	'',
	array(
		'NOTEID_SOURCE' => array('name' => 'NOTEID_SOURCE', 'type' => 'xsd:string'),
		'USERNAME' => array('name' => 'USERNAME', 'type' => 'xsd:string'),
		'ELEMENTID' => array('name' => 'ELEMENTID', 'type' => 'xsd:string'),
		'STATE' => array('name' => 'STATE', 'type' => 'xsd:string')
	)
);

$server->wsdl->addComplexType(
	'opwdReset',
	'complexType',
	'struct',
	'all',
	'',
	array(
		'USERDATA' => array('name' => 'USERDATA', 'type' => 'xsd:string'),
		'EMAIL' => array('name' => 'EMAIL', 'type' => 'xsd:string'),
		'USERNAME' => array('name' => 'USERNAME', 'type' => 'xsd:string'),
		'PASSWORD' => array('name' => 'PASSWORD', 'type' => 'xsd:string'),
		'PASSWORD_CONFIRM' => array('name' => 'PASSWORD_CONFIRM', 'type' => 'xsd:string'),
		'MSG_SOURCEID' => array('name' => 'MSG_SOURCEID', 'type' => 'xsd:string')
	)
);

$server->wsdl->addComplexType(
	'oActivityLog',
	'complexType',
	'struct',
	'all',
	'',
	array(
		'ACTIVITY_TYPE' => array('name' => 'ACTIVITY_TYPE', 'type' => 'xsd:string'),
		'ACTIVITY_NAME' => array('name' => 'ACTIVITY_NAME', 'type' => 'xsd:string'),
		'PHPSESSION_ID' => array('name' => 'PHPSESSION_ID', 'type' => 'xsd:string'),
		'ACTIVITY_CONTENTID' => array('name' => 'ACTIVITY_CONTENTID', 'type' => 'xsd:string'),
		'SCRIPT_NAME' => array('name' => 'SCRIPT_NAME', 'type' => 'xsd:string'),
		'HTTP_USER_AGENT' => array('name' => 'HTTP_USER_AGENT', 'type' => 'xsd:string'),
		'HTTP_REFERER' => array('name' => 'HTTP_REFERER', 'type' => 'xsd:string'),
		'HTTP_HEADERS' => array('name' => 'HTTP_HEADERS', 'type' => 'xsd:string'),
		'REQUEST_METHOD' => array('name' => 'REQUEST_METHOD', 'type' => 'xsd:string'),
		'REMOTE_ADDR' => array('name' => 'REMOTE_ADDR', 'type' => 'xsd:string')
	)
);

$server->wsdl->addComplexType(
	'otrkDwnld',
	'complexType',
	'struct',
	'all',
	'',
	array(
		'HTTP_USER_AGENT' => array('name' => 'HTTP_USER_AGENT', 'type' => 'xsd:string'),
		'REMOTE_ADDR' => array('name' => 'REMOTE_ADDR', 'type' => 'xsd:string'),
		'REQUEST_URI' => array('name' => 'REQUEST_URI', 'type' => 'xsd:string')
	)
);

$server->wsdl->addComplexType(
	'oActivation',
	'complexType',
	'struct',
	'all',
	'',
	array(
		'KEY' => array('name' => 'KEY', 'type' => 'xsd:string'),
		'KEY_CRC32' => array('name' => 'KEY_CRC32', 'type' => 'xsd:string'),
		'USERNAME' => array('name' => 'USERNAME', 'type' => 'xsd:string'),
		'USERNAME_CRC32' => array('name' => 'USERNAME_CRC32', 'type' => 'xsd:string')
	)
);

$server->wsdl->addComplexType(
	'oUser',
	'complexType',
	'struct',
	'all',
	'',
	array(
		'USERNAME' => array( 'name' => 'USERNAME',  'type' => 'xsd:string' ),
		'ISACTIVE' => array( 'name' => 'ISACTIVE',  'type' => 'xsd:string' ),
		'USERID_SOURCE' => array( 'name' => 'USERID_SOURCE',  'type' => 'xsd:string' ),
		'USERNAME_DISPLAY' => array( 'name' => 'USERNAME_DISPLAY',  'type' => 'xsd:string' ),
		'FIRSTNAME' => array('name' => 'FIRSTNAME', 'type' => 'xsd:string' ),
		'LASTNAME' => array('name' => 'LASTNAME', 'type' => 'xsd:string' ),
		'EMAIL' => array('name' => 'EMAIL', 'type' => 'xsd:string' ),
        'USER_PERMISSIONS_ID' => array('name' => 'USER_PERMISSIONS_ID', 'type' => 'xsd:string' ),
		'PWDHASH' => array('name' => 'PWDHASH', 'type' => 'xsd:string' ),
		'LANGCODE' => array('name' => 'LANGCODE', 'type' => 'xsd:string' ),
		'LASTLOGIN' => array('name' => 'LASTLOGIN', 'type' => 'xsd:string' ),
		'SESSION_PERSIST' => array('name' => 'SESSION_PERSIST', 'type' => 'xsd:string' ),
		'IMAGE_NAME' => array('name' => 'IMAGE_NAME', 'type' => 'xsd:string' ),
		'IMAGE_WIDTH' => array('name' => 'IMAGE_WIDTH', 'type' => 'xsd:string' ),
		'IMAGE_HEIGHT' => array('name' => 'IMAGE_HEIGHT', 'type' => 'xsd:string' ),
		'ABOUT' => array('name' => 'ABOUT', 'type' => 'xsd:string'),
		'ELEMENTID_PIPED' => array('name' => 'ELEMENTID_PIPED', 'type' => 'xsd:string'),
		'EXTERNAL_URI_RAW' => array('name' => 'EXTERNAL_URI_RAW', 'type' => 'xsd:string'),
		'EXTERNAL_URI_FORMATTED' => array('name' => 'EXTERNAL_URI_FORMATTED', 'type' => 'xsd:string'),
		'KEY' => array('name' => 'KEY', 'type' => 'xsd:string'),
		'KEY_CRC32' => array('name' => 'KEY_CRC32', 'type' => 'xsd:string'),
		'DEACTIVATE' => array( 'name' => 'DEACTIVATE',  'type' => 'xsd:string' ),
		'COMMENTS' => array('name' => 'COMMENTS', 'type' => 'tns:oCommentArray'),
		'NAV' => array('name' => 'NAV', 'type' => 'tns:oNav')
	)
);

$server->wsdl->addComplexType(
	'oFeedback',
	'complexType',
	'struct',
	'all',
	'',
	array(
		'NAME' => array( 'name' => 'NAME',  'type' => 'xsd:string' ),
		'EMAIL' => array( 'name' => 'EMAIL',  'type' => 'xsd:string' ),
		'FEEDBACK' => array( 'name' => 'FEEDBACK',  'type' => 'xsd:string' ),
		'FEEDBACK_SEARCH' => array( 'name' => 'FEEDBACK_SEARCH',  'type' => 'xsd:string' ),
		'FB_BUGREPORT' => array('name' => 'FB_BUGREPORT', 'type' => 'xsd:string' ),
		'FB_FEATREQUEST' => array('name' => 'FB_FEATREQUEST', 'type' => 'xsd:string' ),
		'FB_GENQUESTION' => array('name' => 'FB_GENQUESTION', 'type' => 'xsd:string' ),
		'FB_GENCOMMENT' => array('name' => 'FB_GENCOMMENT', 'type' => 'xsd:string' ),
		'FB_REPORTSPAM' => array('name' => 'FB_REPORTSPAM', 'type' => 'xsd:string' ),
		'OPTIN' => array('name' => 'OPTIN', 'type' => 'xsd:string' ),
		'USERNAME' => array('name' => 'USERNAME', 'type' => 'xsd:string' ),
		'CLASSID_SOURCE' => array('name' => 'CLASSID_SOURCE', 'type' => 'xsd:string' ),
		'METHODID_SOURCE' => array('name' => 'METHODID_SOURCE', 'type' => 'xsd:string' ),
		'URI' => array('name' => 'URI', 'type' => 'xsd:string' ),
		'HTTP_USER_AGENT' => array('name' => 'HTTP_USER_AGENT', 'type' => 'xsd:string' ),
		'HTTP_USER_AGENT_SEARCH' => array('name' => 'HTTP_USER_AGENT_SEARCH', 'type' => 'xsd:string' ),
		'HTTP_REFERER' => array( 'name' => 'HTTP_REFERER',  'type' => 'xsd:string' ),
		'REMOTE_ADDR' => array( 'name' => 'REMOTE_ADDR',  'type' => 'xsd:string' ),
		'SERVER_ADDR' => array( 'name' => 'SERVER_ADDR',  'type' => 'xsd:string' )
	)
);

$server->wsdl->addComplexType(
	'oComment',
	'complexType',
	'struct',
	'all',
	'',
	array(
		'USER' => array( 'name' => 'USER',  'type' => 'tns:oUser' ),
		'NOTEID_SOURCE' => array( 'name' => 'NOTEID_SOURCE',  'type' => 'xsd:string' ),
		'ISACTIVE' => array( 'name' => 'ISACTIVE',  'type' => 'xsd:string' ),
		'REPLYTO_NOTEID' => array( 'name' => 'REPLYTO_NOTEID',  'type' => 'xsd:string' ),
		'SUBJECT' => array( 'name' => 'SUBJECT',  'type' => 'xsd:string' ),
		'SUBJECT_SEARCH' => array( 'name' => 'SUBJECT_SEARCH',  'type' => 'xsd:string' ),
		'NOTE_STYLED' => array('name' => 'NOTE_STYLED', 'type' => 'xsd:string' ),
		'NOTE_RAW' => array('name' => 'NOTE_RAW', 'type' => 'xsd:string' ),
		'NOTE_SEARCH' => array('name' => 'NOTE_SEARCH', 'type' => 'xsd:string' ),
		'NOTE_ELEM_TT' => array('name' => 'NOTE_ELEM_TT', 'type' => 'xsd:string' ),
		'NOTE_ELEM_SEARCH' => array('name' => 'NOTE_ELEM_SEARCH', 'type' => 'xsd:string' ),
		'PAGE_ELEMENT_ID' => array('name' => 'PAGE_ELEMENT_ID', 'type' => 'xsd:string' ),
		'PAGE_ELEMENT_NAME' => array('name' => 'PAGE_ELEMENT_NAME', 'type' => 'xsd:string' ),
		'PAGE_ELEMENT_URI' => array('name' => 'PAGE_ELEMENT_URI', 'type' => 'xsd:string' ),
		'USER_ISUNIQUE' => array('name' => 'USER_ISUNIQUE', 'type' => 'xsd:string' ),
		'STYLED_CHAR_CNT' => array('name' => 'STYLED_CHAR_CNT', 'type' => 'xsd:string' ),
		'RAW_CHAR_CNT' => array('name' => 'RAW_CHAR_CNT', 'type' => 'xsd:string' ),
		'HAS_CODE' => array('name' => 'HAS_CODE', 'type' => 'xsd:string' ),
		'LANGCODE' => array('name' => 'LANGCODE', 'type' => 'xsd:string' ),
		'CLASSID_SOURCE' => array( 'name' => 'CLASSID_SOURCE',  'type' => 'xsd:string' ),
		'METHODID_SOURCE' => array( 'name' => 'METHODID_SOURCE',  'type' => 'xsd:string' ),
		'NOTE_BACKLOG' => array( 'name' => 'NOTE_BACKLOG',  'type' => 'xsd:string' ),
		'CNT_LIKES' => array( 'name' => 'CNT_LIKES',  'type' => 'xsd:string' ),
		'PUBLISH_ME' => array( 'name' => 'PUBLISH_ME',  'type' => 'xsd:string' ),
		'REMOTE_ADDR' => array( 'name' => 'REMOTE_ADDR',  'type' => 'xsd:string' ),
		'SERVER_ADDR' => array( 'name' => 'SERVER_ADDR',  'type' => 'xsd:string' ),		
		'DATEMODIFIED' => array('name' => 'DATEMODIFIED', 'type' => 'xsd:string' ),
		'DATECREATED' => array('name' => 'DATECREATED', 'type' => 'xsd:string' )
	)
);

$server->wsdl->addComplexType(
    'oCommentArray',
    'complexType',
    'array',
    'all',
    '',
	array('name'=>array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:oComment[]'))
);

$server->wsdl->addComplexType(
	'oLikes',
	'complexType',
	'struct',
	'all',
	'',
	array(
		'ID' => array( 'name' => 'ID',  'type' => 'xsd:string' ),
		'NOTEID_SOURCE' => array( 'name' => 'NOTEID_SOURCE',  'type' => 'xsd:string' ),
		'USERNAME' => array( 'name' => 'USERNAME',  'type' => 'xsd:string' )
	)
);

$server->wsdl->addComplexType(
	'oLikesArray',
	'complexType',
    'array',
    'all',
    '',
	array('name'=>array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:oLikes[]'))
);

$server->wsdl->addComplexType(
	'oSearchRequest',
	'complexType',
	'struct',
	'all',
	'',
	array(
		'SEARCH_PARAM' => array( 'name' => 'SEARCH_PARAM',  'type' => 'xsd:string' ),
		'SEARCH_PARAM_SEARCH' => array( 'name' => 'SEARCH_PARAM_SEARCH',  'type' => 'xsd:string' ),
		'USERNAME' => array( 'name' => 'USERNAME',  'type' => 'xsd:string' ),
		'INDEXSIZE' => array( 'name' => 'INDEXSIZE',  'type' => 'xsd:string' ),
		'PAGEINDEX' => array( 'name' => 'PAGEINDEX',  'type' => 'xsd:string' ),
		'FILTER' => array( 'name' => 'FILTER',  'type' => 'xsd:string' )
	)
);

$server->wsdl->addComplexType(
	'oSearchResponse',
	'complexType',
	'struct',
	'all',
	'',
	array(
		'SEARCH_PARAM' => array( 'name' => 'SEARCH_PARAM',  'type' => 'xsd:string' ),
		'RESULT_TEXT' => array( 'name' => 'RESULT_TEXT',  'type' => 'xsd:string' ),
		'RESULT_DESCRIPTION' => array( 'name' => 'RESULT_DESCRIPTION',  'type' => 'xsd:string' ),
		'RESULT_URI' => array( 'name' => 'RESULT_URI',  'type' => 'xsd:string' )
	)
);

$server->wsdl->addComplexType(
    'oSearchResultArray',
    'complexType',
    'array',
    'all',
    '',
	array('name'=>array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:oSearchResponse[]'))
);

$server->wsdl->addComplexType(
	'oSearchResult',
	'complexType',
	'struct',
	'all',
	'',
	array(
		'SEARCH_RESPONSE' => array( 'name' => 'SEARCH_PARAM',  'type' => 'tns:oSearchResultArray'),
		'UGC_RESPONSE' => array( 'name' => 'UGC_RESPONSE',  'type' => 'tns:oCommentArray'),
		'INDEXTOTAL' => array('name' => 'INDEXTOTAL', 'type' => 'xsd:string'),
		'INDEXSIZE' => array('name' => 'INDEXSIZE', 'type' => 'xsd:string'),
		'PAGEINDEX' => array('name' => 'PAGEINDEX', 'type' => 'xsd:string')
	)
);

$server->wsdl->addComplexType(
	'oParameter',
	'complexType',
	'struct',
	'all',
	'',
	array(
		'PARAMETERID' => array( 'name' => 'PARAMETERID',  'type' => 'xsd:string' ),
		'NAME' => array( 'name' => 'NAME',  'type' => 'xsd:string' ),
		'POSITION' => array( 'name' => 'POSITION',  'type' => 'xsd:string' ),
        'ISREQUIRED' => array('name' => 'ISREQUIRED', 'type' => 'xsd:string' ),
		'DESCRIPTION' => array('name' => 'DESCRIPTION', 'type' => 'xsd:string' ),
		'LANGCODE' => array('name' => 'LANGCODE', 'type' => 'xsd:string'),
		'DATEMODIFIED' => array('name' => 'DATEMODIFIED', 'type' => 'xsd:string')
	)
);

$server->wsdl->addComplexType(
	'oTechnicalSpec',
	'complexType',
	'struct',
	'all',
	'',
	array(
		'TECHSPECID' => array( 'name' => 'TECHSPECID',  'type' => 'xsd:string' ),
		'TECHNICALSPEC' => array( 'name' => 'TECHNICALSPEC',  'type' => 'xsd:string' ),
		'LANGCODE' => array('name' => 'LANGCODE', 'type' => 'xsd:string')
	)
);

$server->wsdl->addComplexType(
	'oExample',
	'complexType',
	'struct',
	'all',
	'',
	array(
		'EXAMPLEID' => array( 'name' => 'EXAMPLEID',  'type' => 'xsd:string' ),
		'EXAMPLEID_SOURCE' => array( 'name' => 'EXAMPLEID_SOURCE',  'type' => 'xsd:string' ),
		'CLASSID' => array( 'name' => 'CLASSID',  'type' => 'xsd:string' ),
		'METHODID' => array( 'name' => 'METHODID',  'type' => 'xsd:string' ),
		'TITLE' => array('name' => 'TITLE', 'type' => 'xsd:string' ),
		'TITLE_SEARCH' => array('name' => 'TITLE_SEARCH', 'type' => 'xsd:string' ),
		'EXAMPLE_FORMATTED' => array('name' => 'EXAMPLE_FORMATTED', 'type' => 'xsd:string' ),
		'EXAMPLE_RAW' => array('name' => 'EXAMPLE_RAW', 'type' => 'xsd:string' ),
		'EXAMPLE_SEARCH' => array('name' => 'EXAMPLE_SEARCH', 'type' => 'xsd:string' ),
		'DESCRIPTION' => array('name' => 'DESCRIPTION', 'type' => 'xsd:string' ),
		'DESCRIPTION_SEARCH' => array('name' => 'DESCRIPTION_SEARCH', 'type' => 'xsd:string' ),
		'URI' => array('name' => 'URI', 'type' => 'xsd:string' ),
		'EXAMPLE_ELEM_TT' => array('name' => 'EXAMPLE_ELEM_TT', 'type' => 'xsd:string' ),
		'CHAR_CNT_FORMATTED' => array('name' => 'CHAR_CNT_FORMATTED', 'type' => 'xsd:string'),
		'CHAR_CNT_RAW' => array('name' => 'CHAR_CNT_RAW', 'type' => 'xsd:string'),
		'CHAR_CNT_SEARCH' => array('name' => 'CHAR_CNT_SEARCH', 'type' => 'xsd:string'),
		'LANGCODE' => array('name' => 'LANGCODE', 'type' => 'xsd:string'),
		'DATEMODIFIED' => array('name' => 'DATEMODIFIED', 'type' => 'xsd:string')
	)
);  

$server->wsdl->addComplexType(
    'oExampleArray',
    'complexType',
    'array',
    'all',
    '',
	array('name'=>array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:oExample[]'))
	
);

$server->wsdl->addComplexType(
	'oMethodID',
	'complexType',
	'struct',
	'all',
	'',
    array(
        'METHODID' => array('name' => 'METHODID', 'type' => 'xsd:string'),
		'USERNAME' => array('name' => 'USERNAME', 'type' => 'xsd:string'),
		'INDEXSIZE' => array('name' => 'INDEXSIZE', 'type' => 'xsd:string'),
		'PAGEINDEX' => array('name' => 'PAGEINDEX', 'type' => 'xsd:string')
	)
);  

$server->wsdl->addComplexType(
	'oClassID',
	'complexType',
	'struct',
	'all',
	'',
    array(
        'CLASSID' => array('name' => 'CLASSID', 'type' => 'xsd:string'),
		'USERNAME' => array('name' => 'USERNAME', 'type' => 'xsd:string'),
		'INDEXSIZE' => array('name' => 'INDEXSIZE', 'type' => 'xsd:string'),
		'PAGEINDEX' => array('name' => 'PAGEINDEX', 'type' => 'xsd:string')
	)
);  

$server->wsdl->addComplexType(
    'oParameterArray',
    'complexType',
    'array',
    'all',
    '',
	array('name'=>array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:oParameter[]'))
);

$server->wsdl->addComplexType(
    'oTechnicalSpecArray',
    'complexType',
    'array',
    'all',
    '',
	array('name'=>array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:oTechnicalSpec[]'))

);

$server->wsdl->addComplexType(
    'oMethodArray',
	'complexType',
	'array',
	'all',
	'',
	array('name'=>array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:oMethod[]'))
	
);

$server->wsdl->addComplexType(
    'oClassArray',
	'complexType',
	'array',
	'all',
	'',
	array('name'=>array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:oClass[]'))
	
);

$server->wsdl->addComplexType(
    'oMethod',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'METHODID' => array('name' => 'METHODID', 'type' => 'xsd:string'),
		'CLASSID' => array('name' => 'CLASSID', 'type' => 'xsd:string'),
		'NAME' => array('name' => 'NAME', 'type' => 'xsd:string'),
		'DESCRIPTION' => array('name' => 'DESCRIPTION', 'type' => 'xsd:string'),
		'TECHNICALSPECS' => array('name' => 'TECHNICALSPECS', 'type' => 'tns:oTechnicalSpecArray'),
		'CLASSNAME' => array('name' => 'CLASSNAME', 'type' => 'xsd:string'),
		'METHODDEFINE' => array('name' => 'METHODDEFINE', 'type' => 'xsd:string'),
		'PARAMETERS' => array('name' => 'PARAMETERS', 'type' => 'tns:oParameterArray'),
        'RETURNEDVALUE' => array('name' => 'RETURNEDVALUE', 'type' => 'xsd:string'),
        'EXAMPLES' => array('name' => 'EXAMPLES', 'type' => 'tns:oExampleArray'),
		'COMMENTS' => array('name' => 'COMMENTS', 'type' => 'tns:oCommentArray'),
		'LIKES' => array('name' => 'LIKES', 'type' => 'tns:oLikesArray'),
		'INDEXTOTAL' => array('name' => 'INDEXTOTAL', 'type' => 'xsd:string'),
		'INDEXSIZE' => array('name' => 'INDEXSIZE', 'type' => 'xsd:string'),
		'PAGEINDEX' => array('name' => 'PAGEINDEX', 'type' => 'xsd:string'),
		'URI' => array('name' => 'URI', 'type' => 'xsd:string'),
		'LANGCODE' => array('name' => 'LANGCODE', 'type' => 'xsd:string'),
		'CLASSES' => array('name' => 'CLASSES', 'type' => 'tns:oClassArray'),
		'DATEMODIFIED' => array('name' => 'DATEMODIFIED', 'type' => 'xsd:string'),
		'NAV' => array('name' => 'NAV', 'type' => 'tns:oNav')
    )
);

$server->wsdl->addComplexType(
    'oClass',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'CLASSID' => array('name' => 'CLASSID', 'type' => 'xsd:string'),
		'NAME' => array('name' => 'CLASSNAME', 'type' => 'xsd:string'),
		'DESCRIPTION' => array('name' => 'DESCRIPTION', 'type' => 'xsd:string'),
		'TECHNICALSPECS' => array('name' => 'TECHNICALSPECS', 'type' => 'tns:oTechnicalSpecArray'),
		'VERSION' => array('name' => 'VERSION', 'type' => 'xsd:string'),
		'EXAMPLES' => array('name' => 'EXAMPLES', 'type' => 'tns:oExampleArray'),
		'METHODS' => array('name' => 'METHODS', 'type' => 'tns:oMethodArray'),
		'COMMENTS' => array('name' => 'COMMENTS', 'type' => 'tns:oCommentArray'),
		'LIKES' => array('name' => 'LIKES', 'type' => 'tns:oLikesArray'),
		'INDEXTOTAL' => array('name' => 'INDEXTOTAL', 'type' => 'xsd:string'),
		'INDEXSIZE' => array('name' => 'INDEXSIZE', 'type' => 'xsd:string'),
		'PAGEINDEX' => array('name' => 'PAGEINDEX', 'type' => 'xsd:string'),
		'URI' => array('name' => 'URI', 'type' => 'xsd:string'),
		'LANGCODE' => array('name' => 'LANGCODE', 'type' => 'xsd:string'),
		'DATEMODIFIED' => array('name' => 'DATEMODIFIED', 'type' => 'xsd:string'),
		'NAV' => array('name' => 'NAV', 'type' => 'tns:oNav')
    )
);

$server->wsdl->addComplexType(
    'oNav',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'NAVELEMID' => array('name' => 'NAVELEMID', 'type' => 'xsd:string'),
		'CLASS' => array('name' => 'CLASS', 'type' => 'tns:oClassArray'),
		'METHOD' => array('name' => 'METHOD', 'type' => 'tns:oMethodArray'),
		'LANGCODE' => array('name' => 'LANGCODE', 'type' => 'xsd:string')
    )
);

$server->wsdl->addComplexType(
    'oPHPElement',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'ELEMENTID' => array('name' => 'ELEMENTID', 'type' => 'xsd:string'),
		'ELEM_TYPEID' => array('name' => 'ELEM_TYPEID', 'type' => 'xsd:string'),
		'NAME' => array('name' => 'NAME', 'type' => 'xsd:string'),
		'PHP_VERSION' => array('name' => 'PHP_VERSION', 'type' => 'xsd:string'),
		'DESCRIPTION_SHORT' => array('name' => 'DESCRIPTION_SHORT', 'type' => 'xsd:string'),
		'DESCRIPTION_FULL' => array('name' => 'DESCRIPTION_FULL', 'type' => 'xsd:string'),
		'RELATED_FUNC_LIST' => array('name' => 'RELATED_FUNC_LIST', 'type' => 'xsd:string'),
		'MORE_URL' => array('name' => 'MORE_URL', 'type' => 'xsd:string'),
		'LANGCODE' => array('name' => 'LANGCODE', 'type' => 'xsd:string')
    )
);

$server->wsdl->addComplexType(
    'oPHPElementArray',
    'complexType',
    'array',
    'all',
    '',
	array('name'=>array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:oPHPElement[]'))
);

$server->wsdl->addComplexType(
    'oPHPElement_RESPONSE',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'TT_ARRAY' => array('name' => 'TT_ARRAY', 'type' => 'tns:oPHPElementArray')
    )
);
//
//$server->wsdl->addSimpleType(
//	'oStringResponse',
//	'',
//	'simpleType',
//	'scalar',
//	array('RESPONSETEXT' => array('name' => 'RESPONSETEXT','type' => 'xsd:string'))
//);  

function getMethodContent($soapRequest){
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE A WEB SERVICES MANAGER CLASS OBJECT.
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_ENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('getMethodContent',$soapRequest);

	return $SERVICE_RESPONSE;
}

function getMethodContent_PlusNav($soapRequest){
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE A WEB SERVICES MANAGER CLASS OBJECT.
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_ENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('getMethodContent_PlusNav',$soapRequest);

	return $SERVICE_RESPONSE;
}

function getClassContent($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE A WEB SERVICES MANAGER CLASS OBJECT.
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_ENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('getClassContent',$soapRequest);

	return $SERVICE_RESPONSE;
}

function getClassContent_PlusNav($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE A WEB SERVICES MANAGER CLASS OBJECT.
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_ENV']);
	}

	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('getClassContent_PlusNav',$soapRequest);

	return $SERVICE_RESPONSE;
}

function getNavContent($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE A WEB SERVICES MANAGER CLASS OBJECT.
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_ENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('getNavContent',$soapRequest);

	return $SERVICE_RESPONSE;
}

function getToolTip($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE A WEB SERVICES MANAGER CLASS OBJECT.
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_ENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('getToolTip',$soapRequest);

	return $SERVICE_RESPONSE;
}

function getCommInsertStatus($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE A WEB SERVICES MANAGER CLASS OBJECT.
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_ENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('getCommInsertStatus',$soapRequest);

	return $SERVICE_RESPONSE;
}

function isValidLoginData($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE A WEB SERVICES MANAGER CLASS OBJECT.
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_ENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('isValidLoginData',$soapRequest);

	return $SERVICE_RESPONSE;
}

function trkDwnld($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE A WEB SERVICES MANAGER CLASS OBJECT.
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_ENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('trkDwnld',$soapRequest);

	return $SERVICE_RESPONSE;
}

function resetPassword($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE A WEB SERVICES MANAGER CLASS OBJECT.
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_ENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('resetPassword',$soapRequest);

	return $SERVICE_RESPONSE;
}

function resetPassword2($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE A WEB SERVICES MANAGER CLASS OBJECT.
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_ENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('resetPassword2',$soapRequest);

	return $SERVICE_RESPONSE;
}

function toggleLikeLink($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE A WEB SERVICES MANAGER CLASS OBJECT.
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_ENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('toggleLikeLink',$soapRequest);

	return $SERVICE_RESPONSE;
}

function triggerActivationEmail($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE A WEB SERVICES MANAGER CLASS OBJECT.
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_ENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('triggerActivationEmail',$soapRequest);

	return $SERVICE_RESPONSE;
}

function isUnUnique($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE A WEB SERVICES MANAGER CLASS OBJECT.
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_ENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('isUnUnique',$soapRequest);
	#error_log('/services/ index.php (584) SERVICE_RESPONSE :: ' . $SERVICE_RESPONSE);
	return $SERVICE_RESPONSE;
}

function creatNewUser($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE A WEB SERVICES MANAGER CLASS OBJECT.
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_ENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('creatNewUser',$soapRequest);
	#error_log('(430) :: ' . $SERVICE_RESPONSE);
	return $SERVICE_RESPONSE;
}

function updateUserSettings($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE A WEB SERVICES MANAGER CLASS OBJECT.
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_ENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('updateUserSettings',$soapRequest);

	return $SERVICE_RESPONSE;
}

function updateUserProfile($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE A WEB SERVICES MANAGER CLASS OBJECT.
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_ENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('updateUserProfile',$soapRequest);

	return $SERVICE_RESPONSE;
}

function searchResultsSuggest($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE A WEB SERVICES MANAGER CLASS OBJECT.
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_ENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	#error_log("/services/wsdl/ (807) About to prepare server response...");
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('searchResultsSuggest',$soapRequest);
	#error_log("/services/wsdl/ (809) Prepared server response...");
	return $SERVICE_RESPONSE;
}

function postUserComment($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE A WEB SERVICES MANAGER CLASS OBJECT.
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_ENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('postUserComment',$soapRequest);

	return $SERVICE_RESPONSE;
}

function postUserCommentReply($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE A WEB SERVICES MANAGER CLASS OBJECT.
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_ENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('postUserCommentReply',$soapRequest);

	return $SERVICE_RESPONSE;
}

function updateUserComment($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE A WEB SERVICES MANAGER CLASS OBJECT.
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_ENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('updateUserComment',$soapRequest);

	return $SERVICE_RESPONSE;
}

function retrieveUserAccnt_PlusNav($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE A WEB SERVICES MANAGER CLASS OBJECT.
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_ENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('retrieveUserAccnt_PlusNav',$soapRequest);

	return $SERVICE_RESPONSE;
}

function retrieveUserAccnt($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE A WEB SERVICES MANAGER CLASS OBJECT.
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_ENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('retrieveUserAccnt',$soapRequest);

	return $SERVICE_RESPONSE;
}

function getUserCommentbyID($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE A WEB SERVICES MANAGER CLASS OBJECT.
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_ENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('getUserCommentbyID',$soapRequest);

	return $SERVICE_RESPONSE;
}

function deleteUserComment($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE A WEB SERVICES MANAGER CLASS OBJECT.
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_ENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('deleteUserComment',$soapRequest);

	return $SERVICE_RESPONSE;
}

function getAllToolTips($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE A WEB SERVICES MANAGER CLASS OBJECT.
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_ENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	#error_log("**** getAllToolTips ****");
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('getAllToolTips',$soapRequest);

	return $SERVICE_RESPONSE;
}

function submitExamples($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE A WEB SERVICES MANAGER CLASS OBJECT.
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_ENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('submitExamples',$soapRequest);

	return $SERVICE_RESPONSE;
}

function getClassComments($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE A WEB SERVICES MANAGER CLASS OBJECT.
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_ENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('getClassComments',$soapRequest);

	return $SERVICE_RESPONSE;
}

function getMethodComments($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE A WEB SERVICES MANAGER CLASS OBJECT.
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_ENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('getMethodComments',$soapRequest);

	return $SERVICE_RESPONSE;
}

function getSearchResultsFull($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE A WEB SERVICES MANAGER CLASS OBJECT.
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_ENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('getSearchResultsFull',$soapRequest);

	return $SERVICE_RESPONSE;
}

function postUserFeedback($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE A WEB SERVICES MANAGER CLASS OBJECT.
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_ENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('postUserFeedback',$soapRequest);

	return $SERVICE_RESPONSE;
}

function activateNewUser($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE A WEB SERVICES MANAGER CLASS OBJECT.
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_ENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('activateNewUser',$soapRequest);

	return $SERVICE_RESPONSE;
}

function logActivity($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE A WEB SERVICES MANAGER CLASS OBJECT.
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_ENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('logActivity',$soapRequest);

	return $SERVICE_RESPONSE;
}

//
// SOAP METHOD REGISTRATION
$server->register('getClassContent',  								// method name
	array('oClassID' => 'tns:oClassID'),          					// input parameters
    array('return' => 'tns:oClass'),  								// output parameters
    'urn:getClassContentwsdl',                  					// namespace
    'urn:getClassContentwsdl#getClassContent', 						// soapaction
    'rpc',                                    						// style
    'encoded',                                						// use
    'Get content details for a CRNRSTN class.'						// documentation
);

$server->register('getClassContent_PlusNav',  						// method name
	array('oClassID' => 'tns:oClassID'),							// input parameters
    array('return' => 'tns:oClass'),  								// output parameters
    'urn:getClassContent_PlusNavwsdl',                  			// namespace
    'urn:getClassContent_PlusNavwsdl#getClassContent_PlusNav', 		// soapaction
    'rpc',                                    						// style
    'encoded',                                						// use
    'Get content details for a CRNRSTN class, and include
	navigation data as well.'										// documentation
);

$server->register('getClassComments', 		 						// method name
	array('oClassID' => 'tns:oClassID'),							// input parameters
    array('return' => 'tns:oClass'),  								// output parameters
    'urn:getClassCommentswsdl',                  					// namespace
    'urn:getClassCommentswsdl#getClassComments', 					// soapaction
    'rpc',                                    						// style
    'encoded',                                						// use
    'Get user comments for a CRNRSTN class.'						// documentation
);

$server->register('getMethodContent',            					// method name
    array('oMethodID' => 'tns:oMethodID'),							// input parameters
    array('return' => 'tns:oMethod'),				  				// output parameters
    'urn:getMethodContentwsdl',                						// namespace
    'urn:getMethodContentwsdl#getMethodContent',					// soapaction
    'rpc',                                    						// style
    'encoded',                                						// use
    'Get content details for a CRNRSTN method.'						// documentation
);

$server->register('getMethodContent_PlusNav',            			// method name
    array('oMethodID' => 'tns:oMethodID'),							// input parameters
    array('return' => 'tns:oMethod'),				  				// output parameters
    'urn:getMethodContent_PlusNavwsdl',                				// namespace
    'urn:getMethodContent_PlusNavwsdl#getMethodContent_PlusNav',	// soapaction
    'rpc',                                    						// style
    'encoded',                                						// use
    'Get content details for a CRNRSTN method, and include
	navigation data as well.'										// documentation
);

$server->register('getMethodComments', 			           			// method name
    array('oMethodID' => 'tns:oMethodID'),							// input parameters
    array('return' => 'tns:oMethod'),				  				// output parameters
    'urn:getMethodCommentswsdl',                					// namespace
    'urn:getMethodCommentswsdl#getMethodComments',					// soapaction
    'rpc',                                    						// style
    'encoded',                                						// use
    'Get user comments for a CRNRSTN method.'						// documentation
);

$server->register('getNavContent',     		       					// method name
    array('NAVID' => 'xsd:string'),									// input parameters
    array('return' => 'tns:oNav'),				  					// output parameters
    'urn:getNavContentwsdl',                						// namespace
    'urn:getNavContentwsdl#getNavContent',							// soapaction
    'rpc',                                    						// style
    'encoded',                                						// use
    'Get navigation content for the CRNRSTN site.'					// documentation
);

$server->register('getToolTip',     		       					// method name
    array('ELEMENTID' => 'xsd:string'),								// input parameters
    array('return' => 'tns:oPHPElement'),			  				// output parameters
    'urn:getToolTipwsdl',                							// namespace
    'urn:getToolTipwsdl#getToolTip',								// soapaction
    'rpc',                                    						// style
    'encoded',                                						// use
    'Get tool tip information for a PHP element.'					// documentation
);

$server->register('isValidLoginData',     		 	      			// method name
    array('oLoginSubmission' => 'tns:oUser'),						// input parameters
    array('return' => 'tns:oUser'),						  			// output parameters
    'urn:isValidLoginDatawsdl',                						// namespace
    'urn:isValidLoginDatawsdl#isValidLoginData',					// soapaction
    'rpc',                                    						// style
    'encoded',                                						// use
    'Valid login data?'												// documentation
);

$server->register('trkDwnld',     		 	   						// method name
    array('oDownloadTracker' => 'tns:otrkDwnld'),					// input parameters
    array('return' => 'xsd:string'),						  		// output parameters
    'urn:trkDwnldwsdl',                								// namespace
    'urn:trkDwnldwsdl#trkDwnld',									// soapaction
    'rpc',                                    						// style
    'encoded',                                						// use
    'Track download of CRNRSTN.'									// documentation
);

$server->register('resetPassword',     		 	  			 		// method name
    array('oResetPwd' => 'tns:opwdReset'),							// input parameters
    array('return' => 'xsd:string'),							  	// output parameters
    'urn:resetPasswordwsdl',                						// namespace
    'urn:resetPasswordwsdl#resetPassword',							// soapaction
    'rpc',                                    						// style
    'encoded',                                						// use
    'Trigger password reset email.'									// documentation
);

$server->register('resetPassword2',     		 	  		 		// method name
    array('oResetPwd2' => 'tns:opwdReset'),							// input parameters
    array('return' => 'xsd:string'),							  	// output parameters
    'urn:resetPassword2wsdl',                						// namespace
    'urn:resetPassword2wsdl#resetPassword2',						// soapaction
    'rpc',                                    						// style
    'encoded',                                						// use
    'Attempt to reset password.'									// documentation
);

$server->register('toggleLikeLink',     		 	  		 		// method name
    array('oLikeLinkToggle' => 'tns:olikeLink'),							// input parameters
    array('return' => 'xsd:string'),							  	// output parameters
    'urn:toggleLikeLinkwsdl',                						// namespace
    'urn:toggleLikeLinkwsdl#toggleLikeLink',						// soapaction
    'rpc',                                    						// style
    'encoded',                                						// use
    'Toggle the user nore like.'									// documentation
);

$server->register('triggerActivationEmail',     		 	   		// method name
    array('oTriggerActivationEmail' => 'tns:oUser'),				// input parameters
    array('return' => 'xsd:string'),						  			// output parameters
    'urn:triggerActivationEmailwsdl',                				// namespace
    'urn:triggerActivationEmailwsdl#triggerActivationEmail',		// soapaction
    'rpc',                                    						// style
    'encoded',                                						// use
    'Resend account activation email.'								// documentation
);

$server->register('isUnUnique',     		 	   		   			// method name
    array('oUnUnique' => 'tns:oUser'),								// input parameters
    array('return' => 'xsd:string'),								// output parameters
    'urn:isUnUniquewsdl',                							// namespace
    'urn:isUnUniquewsdl#isUnUnique',								// soapaction
    'rpc',                                    						// style
    'encoded',                                						// use
    'Valid username for new account?'								// documentation
);

$server->register('creatNewUser',     		 	   		   			// method name
    array('oNewUser' => 'tns:oUser'),								// input parameters
    array('return' => 'xsd:string'),								// output parameters
    'urn:creatNewUserwsdl',                							// namespace
    'urn:creatNewUserwsdl#creatNewUser',							// soapaction
    'rpc',                                    						// style
    'encoded',                                						// use
    'Create new account.'											// documentation
);

$server->register('updateUserSettings',     			   			// method name
    array('oUserSettingsUpdate' => 'tns:oUser'),					// input parameters
    array('return' => 'xsd:string'),								// output parameters
    'urn:updateUserSettingswsdl',                					// namespace
    'urn:updateUserSettingswsdl#updateUserSettings',				// soapaction
    'rpc',                                    						// style
    'encoded',                                						// use
    'Update user settings.'											// documentation
);

$server->register('updateUserProfile',     			   				// method name
    array('oUserProfileUpdate' => 'tns:oUser'),						// input parameters
    array('return' => 'xsd:string'),								// output parameters
    'urn:updateUserProfilewsdl',                					// namespace
    'urn:updateUserProfilewsdl#updateUserProfile',					// soapaction
    'rpc',                                    						// style
    'encoded',                                						// use
    'Update user profile.'											// documentation
);

$server->register('searchResultsSuggest',     			   			// method name
    array('oSearchSuggest' => 'tns:oSearchRequest'),				// input parameters
    array('return' => 'tns:oSearchResult'),							// output parameters
    'urn:searchResultsSuggestwsdl',                					// namespace
    'urn:searchResultsSuggestwsdl#searchResultsSuggest',			// soapaction
    'rpc',                                    						// style
    'encoded',                                						// use
    'Suggest search results.'										// documentation
);

$server->register('getSearchResultsFull',     			   			// method name
    array('oSearchSuggest' => 'tns:oSearchRequest'),				// input parameters
    array('return' => 'tns:oSearchResult'),							// output parameters
    'urn:getSearchResultsFullwsdl',                					// namespace
    'urn:getSearchResultsFullwsdl#getSearchResultsFull',			// soapaction
    'rpc',                                    						// style
    'encoded',                                						// use
    'Get all search results.'										// documentation
);

$server->register('getCommInsertStatus',     		       			// method name
    array('oCommentInsertStatus' => 'tns:oComment'),				// input parameters
    array('return' => 'xsd:string'),					  			// output parameters
    'urn:getCommInsertStatuswsdl',                					// namespace
    'urn:getCommInsertStatuswsdl#getCommInsertStatus',				// soapaction
    'rpc',                                    						// style
    'encoded',                                						// use
    'Determine whether user is new to comment submissions.'			// documentation
);

$server->register('postUserComment',     			   				// method name
    array('oCommentSubmission' => 'tns:oComment'),					// input parameters
    array('return' => 'xsd:string'),								// output parameters
    'urn:postUserCommentwsdl',                						// namespace
    'urn:postUserCommentwsdl#postUserComment',						// soapaction
    'rpc',                                    						// style
    'encoded',                                						// use
    'Post user comment.'											// documentation
);

$server->register('postUserCommentReply',     			   			// method name
    array('oCommentSubmission' => 'tns:oComment'),					// input parameters
    array('return' => 'xsd:string'),								// output parameters
    'urn:postUserCommentReplywsdl',                					// namespace
    'urn:postUserCommentReplywsdl#postUserCommentReply',			// soapaction
    'rpc',                                    						// style
    'encoded',                                						// use
    'Post reply to users comment.'									// documentation
);

$server->register('updateUserComment',     			   				// method name
    array('oCommentSubmission' => 'tns:oComment'),					// input parameters
    array('return' => 'xsd:string'),								// output parameters
    'urn:updateUserCommentwsdl',                					// namespace
    'urn:updateUserComment#updateUserComment',						// soapaction
    'rpc',                                    						// style
    'encoded',                                						// use
    'Update user comment.'											// documentation
);

$server->register('retrieveUserAccnt_PlusNav',     			   		// method name
    array('oUserAccntRequest_PlusNav' => 'tns:oUser'),				// input parameters
    array('return' => 'tns:oUser'),									// output parameters
    'urn:retrieveUserAccnt_PlusNavwsdl',                			// namespace
    'urn:retrieveUserAccnt_PlusNavwsdl#retrieveUserAccnt_PlusNav',	// soapaction
    'rpc',                                    						// style
    'encoded',                                						// use
    'Retrieve user account information...plus the nav.'				// documentation
);

$server->register('retrieveUserAccnt',     			   				// method name
    array('oUserAccntRequest' => 'tns:oUser'),						// input parameters
    array('return' => 'tns:oUser'),									// output parameters
    'urn:retrieveUserAccntwsdl',                					// namespace
    'urn:retrieveUserAccntwsdl#retrieveUserAccnt',					// soapaction
    'rpc',                                    						// style
    'encoded',                                						// use
    'Retrieve user account information.'							// documentation
);

$server->register('getUserCommentbyID',     			   			// method name
    array('oCommentRequestbyID' => 'tns:oComment'),					// input parameters
    array('return' => 'tns:oUser'),									// output parameters
    'urn:getUserCommentbyIDwsdl',                					// namespace
    'urn:getUserCommentbyIDwsdl#getUserCommentbyID',				// soapaction
    'rpc',                                    						// style
    'encoded',                                						// use
    'Retrieve user comment.'										// documentation
);

$server->register('deleteUserComment',     			   				// method name
    array('oCommentForDeletion' => 'tns:oComment'),					// input parameters
    array('return' => 'xsd:string'),								// output parameters
    'urn:deleteUserCommentwsdl',                					// namespace
    'urn:deleteUserCommentwsdl#deleteUserComment',					// soapaction
    'rpc',                                    						// style
    'encoded',                                						// use
    'Delete user comment.'											// documentation
);

$server->register('getAllToolTips',     			   				// method name
	array('oCodeElementsRequest' => 'xsd:string'),					// input parameters
	array('return' => 'tns:oPHPElement_RESPONSE'),					// output parameters
	'urn:getAllToolTipswsdl',                						// namespace
	'urn:getAllToolTipswsdl#getAllToolTips',						// soapaction
	'rpc',                                    						// style
	'encoded',                                						// use
	'Get code elements.'											// documentation
);

$server->register('submitExamples',     			   				// method name
	array('oExampleSubmit' => 'tns:oExample'),						// input parameters
	array('return' => 'xsd:string'),								// output parameters
	'urn:submitExampleswsdl',                						// namespace
	'urn:submitExampleswsdl#submitExamples',						// soapaction
	'rpc',                                    						// style
	'encoded',                                						// use
	'Submit new/updated examples.'									// documentation
);

$server->register('postUserFeedback',     			   				// method name
	array('oFeedbackSubmission' => 'tns:oFeedback'),				// input parameters
	array('return' => 'xsd:string'),								// output parameters
	'urn:postUserFeedbackwsdl',                						// namespace
	'urn:postUserFeedbackwsdl#postUserFeedback',					// soapaction
	'rpc',                                    						// style
	'encoded',                                						// use
	'Submit feedback from user.'									// documentation
);

$server->register('activateNewUser',     			   				// method name
	array('oNewActivation' => 'tns:oActivation'),					// input parameters
	array('return' => 'xsd:string'),								// output parameters
	'urn:activateNewUserwsdl',                						// namespace
	'urn:activateNewUserwsdl#activateNewUser',						// soapaction
	'rpc',                                    						// style
	'encoded',                                						// use
	'Activate new user account.'									// documentation
);

$server->register('logActivity',     			   					// method name
	array('oNewActivityLog' => 'tns:oActivityLog'),					// input parameters
	array('return' => 'xsd:string'),								// output parameters
	'urn:logActivitywsdl',                							// namespace
	'urn:logActivitywsdl#logActivity',								// soapaction
	'rpc',                                    						// style
	'encoded',                                						// use
	'Log activity.'													// documentation
);


//$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
//
//if($HTTP_RAW_POST_DATA!=''){
//		//
//		// EXECUTE SERVICE
//		$server->service($HTTP_RAW_POST_DATA);
//
//}else{
//	//
//	// RETURN WSDL
//	$server->service($HTTP_RAW_POST_DATA);
//	
//}
if(!$oCRNRSTN_ENV->oHTTP_MGR->issetHTTP($_GET)){
    // 73.54.221.217 is 2276
	if($oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->exclusiveAccess('184.173.96.66,50.87.249.11,172.16.110.130,172.16.*')){
		$server->service(file_get_contents('php://input'));
	}else{
		$oCRNRSTN_ENV->return_server_response_code(403);
	}
}else{
	$server->service(file_get_contents('php://input'));
}


exit();
?>