<?php
/* 
// J5
// Code is Poetry */

require('_crnrstn.root.inc.php');
require($ROOT.'_crnrstn.config.inc.php');
require($oUSER->getEnvParam('DOCUMENT_ROOT').'crnrstn/common/classes/msg/webservice.msg.inc.php');

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
	'oMessageEmail',
	'complexType',
	'struct',
	'all',
	'',
	array(
		'SERIAL_BATCH' => array('name' => 'SERIAL_BATCH', 'type' => 'xsd:string'),
		'SERIAL_MSG' => array('name' => 'SERIAL_MSG', 'type' => 'xsd:string'),
		'MSG_KEYID' => array('name' => 'MSG_KEYID', 'type' => 'xsd:string'),
		'MSG_EMAIL' => array('name' => 'MSG_EMAIL', 'type' => 'xsd:string'),
		'MSG_SUBJECT' => array('name' => 'MSG_SUBJECT', 'type' => 'xsd:string'),
		'MSG_HTML' => array('name' => 'MSG_HTML', 'type' => 'xsd:string'),
		'MSG_TEXT' => array('name' => 'MSG_TEXT', 'type' => 'xsd:string')
	)
);

$server->wsdl->addComplexType(
	'oMessageEmailResponse',
	'complexType',
	'struct',
	'all',
	'',
	array(
		'SERIAL_BATCH' => array( 'name' => 'SERIAL_BATCH',  'type' => 'xsd:string' ),
		'SERIAL_MSG' => array( 'name' => 'SERIAL_MSG',  'type' => 'xsd:string' ),
		'MSG_KEYID' => array( 'name' => 'MSG_KEYID',  'type' => 'xsd:string' ),
		'MSG_EMAIL' => array( 'name' => 'MSG_EMAIL',  'type' => 'xsd:string' ),
		'STATUS' => array('name' => 'STATUS', 'type' => 'xsd:string')
	)
);

$server->wsdl->addComplexType(
    'oMessageEmailResponseArray',
    'complexType',
    'array',
    'all',
    '',
	array('name'=>array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:oMessageEmailResponse[]'))
);

function sendMessageBatch($soapRequest){
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oENV']);
	}
	
	error_log('(89) sendMessageBatch(soapRequest) :: '.$soapRequest);
	foreach($soapRequest as $key=>$val){
		error_log('(91) sendMessageBatch :: '.$key);
		foreach($soapRequest[$key] as $key2=>$val2){
			error_log('(93) sendMessageBatch2 :: '.$key2);
		}
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('sendMessageBatch',$soapRequest);

	return $SERVICE_RESPONSE;
}

//
// SOAP METHOD REGISTRATION
$server->register('sendMessageBatch',  								// method name
	array('oMessageBatch' => 'tns:oMessageBatch'),   		       	// input parameters
    array('return' => 'tns:oMessageEmailResponseArray'),  			// output parameters
    'urn:getClassContentwsdl',                  					// namespace
    'urn:getClassContentwsdl#getClassContent', 						// soapaction
    'rpc',                                    						// style
    'encoded',                                						// use
    'Get content details for a CRNRSTN class.'						// documentation
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