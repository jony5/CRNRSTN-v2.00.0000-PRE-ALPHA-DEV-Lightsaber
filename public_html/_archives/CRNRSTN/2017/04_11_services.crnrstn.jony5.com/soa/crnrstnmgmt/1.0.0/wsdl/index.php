<?php
/* 
// J5
// Code is Poetry */

require('_crnrstn.root.inc.php');
require($ROOT.'_crnrstn.config.mgmt.inc.php');
require($oUSER->getEnvParam('DOCUMENT_ROOT').'/common/classes/webservice.mgmt.inc.php');

//
// INSTANTIATE SOAP SERVER AND PROVIDE SESSION ACCESS TO ENVIRONMENTAL CLASS OBJECT
$server = new soap_server();
$server->debug_flag = false;
$server->configureWSDL("crnrstn", $oUSER->getEnvParam('SOA_NAMESPACE'));
$server->wsdl->schemaTargetNamespace = $oUSER->getEnvParam('SOA_NAMESPACE');
$_SESSION['oENV']=$oENV;

// 
// REGISTER THE DATA STRUCTURES USED BY THE SERVICE
$server->wsdl->addComplexType(
	'oMessage',
	'complexType',
	'struct',
	'all',
	'',
	array(
		'MSG_KEYID' => array('name' => 'MSG_KEYID', 'type' => 'xsd:string'),
		'MSG_KEYID_CRC32' => array('name' => 'MSG_KEYID_CRC32', 'type' => 'xsd:string'),
		'MSG_NAME' => array('name' => 'MSG_NAME', 'type' => 'xsd:string'),
		'MSG_SUBJECT' => array('name' => 'MSG_SUBJECT', 'type' => 'xsd:string'),
		'MSG_HTML' => array('name' => 'MSG_HTML', 'type' => 'xsd:string'),
		'MSG_TEXT' => array('name' => 'MSG_TEXT', 'type' => 'xsd:string'),
		'MSG_DESCRIPTION' => array('name' => 'MSG_DESCRIPTION', 'type' => 'xsd:string'),
		'ISACTIVE' => array('name' => 'ISACTIVE', 'type' => 'xsd:string'),
		'LANGCODE' => array('name' => 'LANGCODE', 'type' => 'xsd:string'),
		'DATEMODIFIED' => array('name' => 'DATEMODIFIED', 'type' => 'xsd:string'),
		'DATECREATED' => array('name' => 'DATECREATED', 'type' => 'xsd:string')
	)
);

$server->wsdl->addComplexType(
    'oMessageArray',
    'complexType',
    'array',
    'all',
    '',
	array('name'=>array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:oMessage[]'))
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
	'oAccountMgmtRequest',
	'complexType',
	'struct',
	'all',
	'',
	array(
		'USERNAME' => array( 'name' => 'USERNAME',  'type' => 'xsd:string' ),
		'NOTEID_SOURCE' => array( 'name' => 'NOTEID_SOURCE',  'type' => 'xsd:string' ),
		'ELEMENTID_SOURCE' => array( 'name' => 'ELEMENTID_SOURCE',  'type' => 'xsd:string' )
	)
);

$server->wsdl->addComplexType(
	'oCommFBRequest',
	'complexType',
	'struct',
	'all',
	'',
	array(
		'FEEDBACK_SOURCE' => array( 'name' => 'FEEDBACK_SOURCE',  'type' => 'xsd:string' ),
		'TIMESPAN' => array( 'name' => 'TIMESPAN',  'type' => 'xsd:string' ),
		'COMM_FB_FILTER_SPAM' => array( 'name' => 'COMM_FB_FILTER_SPAM',  'type' => 'xsd:string' ),
		'COMM_FB_FILTER_OPTIN' => array('name' => 'COMM_FB_FILTER_OPTIN', 'type' => 'xsd:string' ),
		'COMM_FB_FILTER_GENCOMM' => array('name' => 'COMM_FB_FILTER_GENCOMM', 'type' => 'xsd:string' ),
		'COMM_FB_FILTER_GENQUEST' => array('name' => 'COMM_FB_FILTER_GENQUEST', 'type' => 'xsd:string' ),
		'COMM_FB_FILTER_FEATREQ' => array('name' => 'COMM_FB_FILTER_FEATREQ', 'type' => 'xsd:string' ),
		'COMM_FB_FILTER_BUGREPORT' => array('name' => 'COMM_FB_FILTER_BUGREPORT', 'type' => 'xsd:string' ),
		'COMM_FB_FILTER_RESPONDED' => array('name' => 'COMM_FB_FILTER_RESPONDED', 'type' => 'xsd:string' ),
		'SEARCH_PARAM' => array('name' => 'SEARCH_PARAM', 'type' => 'xsd:string' ),
		'SEARCH_PARAM_SEARCH' => array('name' => 'SEARCH_PARAM_SEARCH', 'type' => 'xsd:string' )
	)
);

$server->wsdl->addComplexType(
	'oCommFBResponse',
	'complexType',
	'struct',
	'all',
	'',
	array(
		'FEEDBACK_SOURCE' => array( 'name' => 'FEEDBACK_SOURCE',  'type' => 'xsd:string' ),
		'TIMESPAN' => array( 'name' => 'TIMESPAN',  'type' => 'xsd:string' ),
		'COMM_FB_FILTER_SPAM' => array( 'name' => 'COMM_FB_FILTER_SPAM',  'type' => 'xsd:string' ),
		'COMM_FB_FILTER_OPTIN' => array('name' => 'COMM_FB_FILTER_OPTIN', 'type' => 'xsd:string' ),
		'COMM_FB_FILTER_GENCOMM' => array('name' => 'COMM_FB_FILTER_GENCOMM', 'type' => 'xsd:string' ),
		'COMM_FB_FILTER_GENQUEST' => array('name' => 'COMM_FB_FILTER_GENQUEST', 'type' => 'xsd:string' ),
		'COMM_FB_FILTER_FEATREQ' => array('name' => 'COMM_FB_FILTER_FEATREQ', 'type' => 'xsd:string' ),
		'COMM_FB_FILTER_BUGREPORT' => array('name' => 'COMM_FB_FILTER_BUGREPORT', 'type' => 'xsd:string' ),
		'COMM_FB_FILTER_RESPONDED' => array('name' => 'COMM_FB_FILTER_RESPONDED', 'type' => 'xsd:string' ),
		'SEARCH_PARAM' => array('name' => 'SEARCH_PARAM', 'type' => 'xsd:string' ),
		'COMM_FEEDBACK' => array('name' => 'COMM_FEEDBACK', 'type' => 'tns:oCommFeedbackArray')
	)
);

$server->wsdl->addComplexType(
	'oCommFeedback',
	'complexType',
	'struct',
	'all',
	'',
	array(
		'FID_SOURCE' => array( 'name' => 'FID_SOURCE',  'type' => 'xsd:string' ),
		'FB_BUGREPORT' => array( 'name' => 'FB_BUGREPORT',  'type' => 'xsd:string' ),
		'FB_FEATREQUEST' => array( 'name' => 'FB_FEATREQUEST',  'type' => 'xsd:string' ),
		'FB_GENQUESTION' => array('name' => 'FB_GENQUESTION', 'type' => 'xsd:string' ),
		'FB_GENCOMMENT' => array('name' => 'FB_GENCOMMENT', 'type' => 'xsd:string' ),
		'FB_REPORTSPAM' => array('name' => 'FB_REPORTSPAM', 'type' => 'xsd:string' ),
        'OPTIN' => array('name' => 'OPTIN', 'type' => 'xsd:string' ),
		'NAME' => array('name' => 'NAME', 'type' => 'xsd:string' ),
		'EMAIL' => array('name' => 'EMAIL', 'type' => 'xsd:string' ),
		'FEEDBACK' => array('name' => 'FEEDBACK', 'type' => 'xsd:string' ),
		'USERNAME' => array('name' => 'USERNAME', 'type' => 'xsd:string' ),
		'CLASSID_SOURCE' => array('name' => 'CLASSID_SOURCE', 'type' => 'xsd:string' ),
		'METHODID_SOURCE' => array('name' => 'METHODID_SOURCE', 'type' => 'xsd:string' ),
		'NOTEID_SOURCE' => array('name' => 'NOTEID_SOURCE', 'type' => 'xsd:string' ),
		'URI' => array('name' => 'URI', 'type' => 'xsd:string' ),
		'HTTP_USER_AGENT' => array('name' => 'HTTP_USER_AGENT', 'type' => 'xsd:string' ),
		'HTTP_REFERER' => array('name' => 'HTTP_REFERER', 'type' => 'xsd:string' ),
		'REMOTE_ADDR' => array('name' => 'REMOTE_ADDR', 'type' => 'xsd:string' ),
		'SERVER_ADDR' => array('name' => 'SERVER_ADDR', 'type' => 'xsd:string' ),
		'HAS_BEEN_READ' => array('name' => 'HAS_BEEN_READ', 'type' => 'xsd:string' ),
		'DATERESPONDEDTO' => array('name' => 'DATERESPONDEDTO', 'type' => 'xsd:string' ),
		'DATEMODIFIED' => array('name' => 'DATEMODIFIED', 'type' => 'xsd:string' ),
		'DATECREATED' => array('name' => 'DATECREATED', 'type' => 'xsd:string' ))
);

$server->wsdl->addComplexType(
    'oCommFeedbackArray',
    'complexType',
    'array',
    'all',
    '',
	array('name'=>array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:oCommFeedback[]'))
);

$server->wsdl->addComplexType(
	'oAccntInfoRequest',
	'complexType',
	'struct',
	'all',
	'',
	array(
		'ACCOUNT_STATUS' => array( 'name' => 'ACCOUNT_STATUS',  'type' => 'xsd:string' ),
		'TIMESPAN' => array( 'name' => 'TIMESPAN',  'type' => 'xsd:string' ),
		'FILTER_LOCKED' => array( 'name' => 'FILTER_LOCKED',  'type' => 'xsd:string' ),
		'FILTER_USRDELETED' => array('name' => 'FILTER_USRDELETED', 'type' => 'xsd:string' ),
		'FILTER_PUBLICNOTE' => array('name' => 'FILTER_PUBLICNOTE', 'type' => 'xsd:string' ),
		'FILTER_PUBLISHME' => array('name' => 'FILTER_PUBLISHME', 'type' => 'xsd:string' ),
		'FILTER_NOTES' => array('name' => 'FILTER_NOTES', 'type' => 'xsd:string' ),
		'FILTER_DELETEDACCNT' => array('name' => 'FILTER_DELETEDACCNT', 'type' => 'xsd:string' ),
		'FILTER_CENSOREDACCNT' => array('name' => 'FILTER_CENSOREDACCNT', 'type' => 'xsd:string' ),
		'FILTER_CENSOREDNOTE' => array('name' => 'FILTER_CENSOREDNOTE', 'type' => 'xsd:string' ),
		'FILTER_LIKES' => array('name' => 'FILTER_LIKES', 'type' => 'xsd:string' ),
        'FILTER_REPLIEDTO' => array('name' => 'FILTER_REPLIEDTO', 'type' => 'xsd:string' ),
		'FILTER_REPLIES' => array('name' => 'FILTER_REPLIES', 'type' => 'xsd:string' ),
		'FILTER_CODE' => array('name' => 'FILTER_CODE', 'type' => 'xsd:string' ),
		'FILTER_LOGGEDIN' => array('name' => 'FILTER_LOGGEDIN', 'type' => 'xsd:string' ),
		'SESSION_PERSIST' => array('name' => 'SESSION_PERSIST', 'type' => 'xsd:string' ),
		'SEARCH_PARAM' => array('name' => 'SEARCH_PARAM', 'type' => 'xsd:string' ),
		'SEARCH_PARAM_SEARCH' => array('name' => 'SEARCH_PARAM_SEARCH', 'type' => 'xsd:string' )
	)
);

$server->wsdl->addComplexType(
	'oAccntInfoResponse',
	'complexType',
	'struct',
	'all',
	'',
	array(
		'ACCOUNT_STATUS' => array( 'name' => 'ACCOUNT_STATUS',  'type' => 'xsd:string' ),
		'TIMESPAN' => array( 'name' => 'TIMESPAN',  'type' => 'xsd:string' ),
		'FILTER_LOCKED' => array( 'name' => 'FILTER_LOCKED',  'type' => 'xsd:string' ),
		'FILTER_USRDELETED' => array('name' => 'FILTER_USRDELETED', 'type' => 'xsd:string' ),
		'FILTER_PUBLICNOTE' => array('name' => 'FILTER_PUBLICNOTE', 'type' => 'xsd:string' ),
		'FILTER_PUBLISHME' => array('name' => 'FILTER_PUBLISHME', 'type' => 'xsd:string' ),
		'FILTER_NOTES' => array('name' => 'FILTER_NOTES', 'type' => 'xsd:string' ),
		'FILTER_DELETEDACCNT' => array('name' => 'FILTER_DELETEDACCNT', 'type' => 'xsd:string' ),
		'FILTER_CENSOREDACCNT' => array('name' => 'FILTER_CENSOREDACCNT', 'type' => 'xsd:string' ),
		'FILTER_CENSOREDNOTE' => array('name' => 'FILTER_CENSOREDNOTE', 'type' => 'xsd:string' ),
		'FILTER_LIKES' => array('name' => 'FILTER_LIKES', 'type' => 'xsd:string' ),
        'FILTER_REPLIEDTO' => array('name' => 'FILTER_REPLIEDTO', 'type' => 'xsd:string' ),
		'FILTER_REPLIES' => array('name' => 'FILTER_REPLIES', 'type' => 'xsd:string' ),
		'FILTER_CODE' => array('name' => 'FILTER_CODE', 'type' => 'xsd:string' ),
		'FILTER_LOGGEDIN' => array('name' => 'FILTER_LOGGEDIN', 'type' => 'xsd:string' ),
		'SESSION_PERSIST' => array('name' => 'SESSION_PERSIST', 'type' => 'xsd:string' ),
		'SEARCH_PARAM' => array('name' => 'SEARCH_PARAM', 'type' => 'xsd:string' ),
		'SEARCH_PARAM_SEARCH' => array('name' => 'SEARCH_PARAM_SEARCH', 'type' => 'xsd:string' ),
		'USER_ACCOUNT' => array('name' => 'USER_ACCOUNT', 'type' => 'tns:oUserAccntInfoArray')
	)
);

$server->wsdl->addComplexType(
	'oUserAccntInfo',
	'complexType',
	'struct',
	'all',
	'',
	array(
		'ACTIVATE_USERNAME' => array( 'name' => 'ACTIVATE_USERNAME',  'type' => 'xsd:string' ),
		'ACTIVATE_USERNAME_CRC32' => array( 'name' => 'ACTIVATE_USERNAME_CRC32',  'type' => 'xsd:string' ),
		'ACTIVATE_ISACTIVE' => array( 'name' => 'ACTIVATE_ISACTIVE',  'type' => 'xsd:string' ),
		'ACTIVATE_DATECREATED' => array('name' => 'ACTIVATE_DATECREATED', 'type' => 'xsd:string' ),
		'USERID_SOURCE' => array('name' => 'USERID_SOURCE', 'type' => 'xsd:string' ),
		'ISACTIVE' => array('name' => 'ISACTIVE', 'type' => 'xsd:string' ),
        'USERNAME' => array('name' => 'USERNAME', 'type' => 'xsd:string' ),
		'USERNAME_DISPLAY' => array('name' => 'USERNAME_DISPLAY', 'type' => 'xsd:string' ),
		'USERID_SOURCE' => array('name' => 'USERID_SOURCE', 'type' => 'xsd:string' ),
		'FIRSTNAME' => array('name' => 'FIRSTNAME', 'type' => 'xsd:string' ),
		'LASTNAME' => array('name' => 'LASTNAME', 'type' => 'xsd:string' ),
		'LASTLOGIN' => array('name' => 'LASTLOGIN', 'type' => 'xsd:string' ),
		'LOGIN_CNT' => array('name' => 'LOGIN_CNT', 'type' => 'xsd:string' ),
		'SESSION_PERSIST' => array('name' => 'SESSION_PERSIST', 'type' => 'xsd:string' ),
		'DATEMODIFIED' => array('name' => 'DATEMODIFIED', 'type' => 'xsd:string' ),
		'DATECREATED' => array('name' => 'DATECREATED', 'type' => 'xsd:string' ),
		'COMM_NOTEID_SOURCE' => array('name' => 'COMM_NOTEID_SOURCE', 'type' => 'xsd:string' ),
		'COMM_ISACTIVE' => array('name' => 'COMM_ISACTIVE', 'type' => 'xsd:string' ),
		'COMM_CNT_LIKES' => array('name' => 'COMM_CNT_LIKES', 'type' => 'xsd:string' ),
		'COMM_CNT_REPLIES' => array('name' => 'COMM_CNT_REPLIES', 'type' => 'xsd:string'))
);

$server->wsdl->addComplexType(
    'oUserAccntInfoArray',
    'complexType',
    'array',
    'all',
    '',
	array('name'=>array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:oUserAccntInfo[]'))
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
		'ELEMENTID_SOURCE' => array( 'name' => 'ELEMENTID_SOURCE',  'type' => 'xsd:string' ),
		'NOTE_BACKLOG' => array( 'name' => 'NOTE_BACKLOG',  'type' => 'xsd:string' ),
		'PUBLISHME' => array( 'name' => 'PUBLISHME',  'type' => 'xsd:string' ),
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
		'COMMENTS' => array('name' => 'TECHNICALSPECS', 'type' => 'tns:oCommentArray'),
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
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('getMethodContent',$soapRequest);

	return $SERVICE_RESPONSE;
}

function getMethodContent_PlusNav($soapRequest){
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('getMethodContent_PlusNav',$soapRequest);

	return $SERVICE_RESPONSE;
}

function getClassContent($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('getClassContent',$soapRequest);

	return $SERVICE_RESPONSE;
}

function getClassContent_PlusNav($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}

	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('getClassContent_PlusNav',$soapRequest);

	return $SERVICE_RESPONSE;
}

function getNavContent($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('getNavContent',$soapRequest);

	return $SERVICE_RESPONSE;
}

function getToolTip($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('getToolTip',$soapRequest);

	return $SERVICE_RESPONSE;
}

function getCommInsertStatus($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('getCommInsertStatus',$soapRequest);

	return $SERVICE_RESPONSE;
}

function isValidLoginData($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('isValidLoginData',$soapRequest);

	return $SERVICE_RESPONSE;
}

function isUnUnique($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('isUnUnique',$soapRequest);
	#error_log('(430) :: '. $SERVICE_RESPONSE);
	return $SERVICE_RESPONSE;
}

function creatNewUser($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('creatNewUser',$soapRequest);
	#error_log('(430) :: '. $SERVICE_RESPONSE);
	return $SERVICE_RESPONSE;
}

function updateUserSettings($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('updateUserSettings',$soapRequest);

	return $SERVICE_RESPONSE;
}

function updateUserProfile($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('updateUserProfile',$soapRequest);

	return $SERVICE_RESPONSE;
}

function searchResultsSuggest($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('searchResultsSuggest',$soapRequest);

	return $SERVICE_RESPONSE;
}

function postUserComment($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('postUserComment',$soapRequest);

	return $SERVICE_RESPONSE;
}

function updateUserComment($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('updateUserComment',$soapRequest);

	return $SERVICE_RESPONSE;
}

function retrieveUserAccnt_PlusNav($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('retrieveUserAccnt_PlusNav',$soapRequest);

	return $SERVICE_RESPONSE;
}

function retrieveUserAccnt($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('retrieveUserAccnt',$soapRequest);

	return $SERVICE_RESPONSE;
}

function getUserCommentbyID($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('getUserCommentbyID',$soapRequest);

	return $SERVICE_RESPONSE;
}

function getUserCommentbyUN($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('getUserCommentbyUN',$soapRequest);

	return $SERVICE_RESPONSE;
}

function deleteUserComment($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('deleteUserComment',$soapRequest);

	return $SERVICE_RESPONSE;
}

function getAllToolTips($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('getAllToolTips',$soapRequest);

	return $SERVICE_RESPONSE;
}

function submitExamples($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('submitExamples',$soapRequest);

	return $SERVICE_RESPONSE;
}

function getClassComments($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('getClassComments',$soapRequest);

	return $SERVICE_RESPONSE;
}

function getMethodComments($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('getMethodComments',$soapRequest);

	return $SERVICE_RESPONSE;
}

function getSearchResultsFull($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('getSearchResultsFull',$soapRequest);

	return $SERVICE_RESPONSE;
}

function postUserFeedback($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('postUserFeedback',$soapRequest);

	return $SERVICE_RESPONSE;
}

function activateNewUser($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('activateNewUser',$soapRequest);

	return $SERVICE_RESPONSE;
}

function getAccntInfo($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('getAccntInfo',$soapRequest);

	return $SERVICE_RESPONSE;
}

function lockAccnt($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('lockAccnt',$soapRequest);

	return $SERVICE_RESPONSE;
}

function unlockAccnt($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('unlockAccnt',$soapRequest);

	return $SERVICE_RESPONSE;
}

function censorAccnt($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('censorAccnt',$soapRequest);

	return $SERVICE_RESPONSE;
}

function uncensorAccnt($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('uncensorAccnt',$soapRequest);

	return $SERVICE_RESPONSE;
}

function censorAccntNote($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('censorAccntNote',$soapRequest);

	return $SERVICE_RESPONSE;
}

function uncensorAccntNote($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('uncensorAccntNote',$soapRequest);

	return $SERVICE_RESPONSE;
}

function publishAccntNote($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('publishAccntNote',$soapRequest);

	return $SERVICE_RESPONSE;
}

function unpublishAccntNote($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('unpublishAccntNote',$soapRequest);

	return $SERVICE_RESPONSE;
}

function deleteAccnt($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('deleteAccnt',$soapRequest);

	return $SERVICE_RESPONSE;
}

function restoreAccnt($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('restoreAccnt',$soapRequest);

	return $SERVICE_RESPONSE;
}

function getCommInfo($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('getCommInfo',$soapRequest);

	return $SERVICE_RESPONSE;
}

function getFeedbackbyID($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('getFeedbackbyID',$soapRequest);

	return $SERVICE_RESPONSE;
}

function fatClientUGCRefresh($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('fatClientUGCRefresh',$soapRequest);

	return $SERVICE_RESPONSE;
}

function submitNewMessage($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('submitNewMessage',$soapRequest);

	return $SERVICE_RESPONSE;
}

function updateMessage($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('updateMessage',$soapRequest);

	return $SERVICE_RESPONSE;
}

function retrieveMessages($soapRequest) {
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('retrieveMessages',$soapRequest);

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

$server->register('getUserCommentbyUN',     			   			// method name
    array('oCommentRequestbyUN' => 'tns:oComment'),					// input parameters
    array('return' => 'tns:oUser'),									// output parameters
    'urn:getUserCommentbyUNwsdl',                					// namespace
    'urn:getUserCommentbyUNwsdl#getUserCommentbyUN',				// soapaction
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

$server->register('getAccntInfo',     			   					// method name
	array('oAccountInfoRequest' => 'tns:oAccntInfoRequest'),		// input parameters
	array('return' => 'tns:oAccntInfoResponse'),					// output parameters
	'urn:getAccntInfowsdl',                							// namespace
	'urn:getAccntInfowsdl#getAccntInfo',							// soapaction
	'rpc',                                    						// style
	'encoded',                                						// use
	'Get CRNRSTN user account information.'							// documentation
);

$server->register('lockAccnt',     			   						// method name
	array('oAccountMgmtRequest' => 'tns:oAccountMgmtRequest'),		// input parameters
    array('return' => 'xsd:string'),								// output parameters
	'urn:lockAccntwsdl',                							// namespace
	'urn:lockAccntwsdl#lockAccnt',									// soapaction
	'rpc',                                    						// style
	'encoded',                                						// use
	'Lock a user account.'											// documentation
);

$server->register('unlockAccnt',     			   					// method name
	array('oAccountMgmtRequest' => 'tns:oAccountMgmtRequest'),		// input parameters
    array('return' => 'xsd:string'),								// output parameters
	'urn:unlockAccntwsdl',                							// namespace
	'urn:unlockAccntwsdl#unlockAccnt',								// soapaction
	'rpc',                                    						// style
	'encoded',                                						// use
	'Unlock a user account.'										// documentation
);

$server->register('censorAccnt',     		   						// method name
	array('oAccountMgmtRequest' => 'tns:oAccountMgmtRequest'),		// input parameters
    array('return' => 'xsd:string'),								// output parameters
	'urn:censorAccntwsdl',                							// namespace
	'urn:censorAccntwsdl#censorAccnt',								// soapaction
	'rpc',                                    						// style
	'encoded',                                						// use
	'Censor a user account.'										// documentation
);

$server->register('uncensorAccnt',     			   					// method name
	array('oAccountMgmtRequest' => 'tns:oAccountMgmtRequest'),		// input parameters
    array('return' => 'xsd:string'),								// output parameters
	'urn:uncensorAccntwsdl',                						// namespace
	'urn:uncensorAccntwsdl#uncensorAccnt',							// soapaction
	'rpc',                                    						// style
	'encoded',                                						// use
	'Uncensor a user account.'										// documentation
);

$server->register('censorAccntNote',     			   				// method name
	array('oAccountMgmtRequest' => 'tns:oAccountMgmtRequest'),		// input parameters
    array('return' => 'xsd:string'),								// output parameters
	'urn:censorAccntNotewsdl',                						// namespace
	'urn:censorAccntNotewsdl#censorAccntNote',						// soapaction
	'rpc',                                    						// style
	'encoded',                                						// use
	'Censor a note within a users account.'							// documentation
);

$server->register('uncensorAccntNote',     			   				// method name
	array('oAccountMgmtRequest' => 'tns:oAccountMgmtRequest'),		// input parameters
    array('return' => 'xsd:string'),								// output parameters
	'urn:uncensorAccntNotewsdl',                					// namespace
	'urn:uncensorAccntNotewsdl#uncensorAccntNote',					// soapaction
	'rpc',                                    						// style
	'encoded',                                						// use
	'Uncensor a note within a users account.'						// documentation
);

$server->register('publishAccntNote',     			   				// method name
	array('oAccountMgmtRequest' => 'tns:oAccountMgmtRequest'),		// input parameters
    array('return' => 'xsd:string'),								// output parameters
	'urn:publishAccntNotewsdl',                						// namespace
	'urn:publishAccntNotewsdl#publishAccntNote',					// soapaction
	'rpc',                                    						// style
	'encoded',                                						// use
	'Publish a note within a users account.'						// documentation
);

$server->register('unpublishAccntNote',     			   			// method name
	array('oAccountMgmtRequest' => 'tns:oAccountMgmtRequest'),		// input parameters
    array('return' => 'xsd:string'),								// output parameters
	'urn:unpublishAccntNotewsdl',                					// namespace
	'urn:unpublishAccntNotewsdl#unpublishAccntNote',				// soapaction
	'rpc',                                    						// style
	'encoded',                                						// use
	'Unpublish a note within a users account.'						// documentation
);

$server->register('deleteAccnt',     			   					// method name
	array('oAccountMgmtRequest' => 'tns:oAccountMgmtRequest'),		// input parameters
    array('return' => 'xsd:string'),								// output parameters
	'urn:deleteAccntwsdl',                							// namespace
	'urn:deleteAccntwsdl#deleteAccnt',								// soapaction
	'rpc',                                    						// style
	'encoded',                                						// use
	'Delete a user account and its notes.'							// documentation
);

$server->register('restoreAccnt',     			   					// method name
	array('oAccountMgmtRequest' => 'tns:oAccountMgmtRequest'),		// input parameters
    array('return' => 'xsd:string'),								// output parameters
	'urn:restoreAccntwsdl',                							// namespace
	'urn:restoreAccntwsdl#restoreAccnt',							// soapaction
	'rpc',                                    						// style
	'encoded',                                						// use
	'Restore a user account and its notes.'							// documentation
);

$server->register('getCommInfo',     			   					// method name
	array('oCommFBRequest' => 'tns:oCommFBRequest'),				// input parameters
    array('return' => 'tns:oCommFBResponse'),						// output parameters
	'urn:getCommInfowsdl',                							// namespace
	'urn:getCommInfowsdl#getCommInfo',								// soapaction
	'rpc',                                    						// style
	'encoded',                                						// use
	'Get communication (feedback) information.'						// documentation
);

$server->register('getFeedbackbyID',     			   				// method name
	array('oCommFBRequest' => 'tns:oCommFeedback'),					// input parameters
    array('return' => 'tns:oCommFeedback'),							// output parameters
	'urn:getFeedbackbyIDwsdl',                						// namespace
	'urn:getFeedbackbyIDwsdl#getFeedbackbyID',						// soapaction
	'rpc',                                    						// style
	'encoded',                                						// use
	'Get communication (feedback) information by ID.'				// documentation
);

$server->register('fatClientUGCRefresh',     			   			// method name
	array('oAccountMgmtRequest' => 'tns:oAccountMgmtRequest'),		// input parameters
    array('return' => 'tns:oCommentArray'),							// output parameters
	'urn:fatClientUGCRefreshwsdl',                					// namespace
	'urn:fatClientUGCRefreshwsdl#fatClientUGCRefresh',				// soapaction
	'rpc',                                    						// style
	'encoded',                                						// use
	'Get fat client ugc content for requested page.'				// documentation
);

$server->register('submitNewMessage',    	 			   			// method name
	array('oNewMessageSubmission' => 'tns:oMessage'),				// input parameters
    array('return' => 'xsd:string'),								// output parameters
	'urn:submitNewMessagewsdl',                						// namespace
	'urn:submitNewMessagewsdl#submitNewMessage',					// soapaction
	'rpc',                                    						// style
	'encoded',                                						// use
	'Add new message to CRNRSTN messaging service.'					// documentation
);

$server->register('updateMessage',    	 			   				// method name
	array('oEditMessageSubmission' => 'tns:oMessage'),				// input parameters
    array('return' => 'xsd:string'),								// output parameters
	'urn:updateMessagewsdl',                						// namespace
	'urn:updateMessagewsdl#updateMessage',							// soapaction
	'rpc',                                    						// style
	'encoded',                                						// use
	'Update existing message in CRNRSTN messaging service.'			// documentation
);

$server->register('retrieveMessages',    	 			   			// method name
	array('oGetMessagesRequest' => 'xsd:string'),					// input parameters
    array('return' => 'tns:oMessageArray'),							// output parameters
	'urn:retrieveMessageswsdl',                						// namespace
	'urn:retrieveMessageswsdl#retrieveMessages',					// soapaction
	'rpc',                                    						// style
	'encoded',                                						// use
	'Retrieve messaging service messages.'							// documentation
);

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';

if($HTTP_RAW_POST_DATA!=''){
		//
		// EXECUTE SERVICE
		$server->service($HTTP_RAW_POST_DATA);

}else{
	//
	// RETURN WSDL
	$server->service($HTTP_RAW_POST_DATA);
	
}

exit();
?>