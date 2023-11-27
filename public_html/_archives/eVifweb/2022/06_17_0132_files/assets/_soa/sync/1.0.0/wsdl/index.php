<?php
/* 
// J5
// Code is Poetry */
//echo "DOCUMENT_ROOT: ".$_SERVER['DOCUMENT_ROOT']."<br>";
//echo "SERVER_NAME: ".$_SERVER['SERVER_NAME']."<br>";
//echo "SERVER_ADDR: ".$_SERVER['SERVER_ADDR']."<br>";
//echo "SERVER_PORT: ".$_SERVER['SERVER_PORT']."<br>";
//echo "SERVER_PROTOCOL: ".$_SERVER['SERVER_PROTOCOL']."<br>";
//echo "REMOTE_ADDR: ".$_SERVER['REMOTE_ADDR']."<br>";
//
//die();
//session_start();
//session_destroy();
require('_crnrstn.root.inc.php');
require($CRNRSTN_ROOT.'_crnrstn.config.inc.php');
#error_log("/services/ index.php (8) Value for DOCUMENT_ROOT: ".$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT')." and _CRNRSTN_ENV_KEY :: ".$_SESSION['jRs72bd0'.'CRNRSTN'.crc32('_CRNRSTN_ENV_KEY')]);
#require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').'/services/common/classes/webservice.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/classes/webservice.inc.php');

//
// INSTANTIATE SOAP SERVER AND PROVIDE SESSION ACCESS TO ENVIRONMENTAL CLASS OBJECT
$server = new soap_server();
$server->debug_flag = false;
$server->configureWSDL("crnrstn", $oCRNRSTN_ENV->getEnvParam('SOA_NAMESPACE'));
$server->wsdl->schemaTargetNamespace = $oCRNRSTN_ENV->getEnvParam('SOA_NAMESPACE');
$_SESSION['oCRNRSTN_ENV']=$oCRNRSTN_ENV;

// 
// REGISTER THE DATA STRUCTURES USED BY THE SERVICE
$server->wsdl->addComplexType(
	'oAsset',
	'complexType',
	'struct',
	'all',
	'',
	array(
		'ASSET_ID' => array('name' => 'ASSET_ID', 'type' => 'xsd:string'),
		'ASSET_TYPE' => array('name' => 'ASSET_TYPE', 'type' => 'xsd:string'),
		'KIVOTOS_ID' => array('name' => 'KIVOTOS_ID', 'type' => 'xsd:string'),
		'CLIENT_ID' => array('name' => 'CLIENT_ID', 'type' => 'xsd:string'),
		'USER_ID' => array('name' => 'USER_ID', 'type' => 'xsd:string'),
		'CHANNEL' => array('name' => 'CHANNEL', 'type' => 'xsd:string'),
		'REMOTE_ADDR' => array('name' => 'REMOTE_ADDR', 'type' => 'xsd:string'),
		'FILE_NAME' => array('name' => 'FILE_NAME', 'type' => 'xsd:string'),
		'FILE_EXT' => array('name' => 'FILE_EXT', 'type' => 'xsd:string'),
		'FILE_PATH' => array('name' => 'FILE_PATH', 'type' => 'xsd:string'),
		'FILE_SIZE' => array('name' => 'FILE_SIZE', 'type' => 'xsd:string'),
		'FILE_MIME_TYPE' => array('name' => 'FILE_MIME_TYPE', 'type' => 'xsd:string'),
		'ASSET_DLOAD_ENDPOINT' => array('name' => 'ASSET_DLOAD_ENDPOINT', 'type' => 'xsd:string'),
		'ASSET_PREVIEW_ENDPOINT' => array('name' => 'ASSET_PREVIEW_ENDPOINT', 'type' => 'xsd:string'),
		'ASSET_UPLOAD_STATUS' => array('name' => 'ASSET_UPLOAD_STATUS', 'type' => 'xsd:string'),
		'NAME' => array('name' => 'NAME', 'type' => 'xsd:string'),
		'DESCRIPTION' => array('name' => 'DESCRIPTION', 'type' => 'xsd:string'),
		'PREVIOUS_VERSIONS' => array('name' => 'PREVIOUS_VERSIONS', 'type' => 'xsd:string'),
		'DLOAD_END_POINT' => array('name' => 'DLOAD_END_POINT', 'type' => 'xsd:string'),
		'AUTHORIZED_IP' => array('name' => 'AUTHORIZED_IP', 'type' => 'xsd:string'),
		'AUTHORIZED_USERS' => array('name' => 'AUTHORIZED_USERS', 'type' => 'xsd:string'),
		'DATEMODIFIED' => array('name' => 'DESCRIPTION', 'type' => 'xsd:string'),
		'DATECREATED' => array('name' => 'DESCRIPTION', 'type' => 'xsd:string'),
		'LANGCODE' => array('name' => 'LANGCODE', 'type' => 'xsd:string')
	)
);

$server->wsdl->addComplexType(
	'oAssetAuthReq',
	'complexType',
	'struct',
	'all',
	'',
	array(
		'ASSET_ID' => array('name' => 'ASSET_ID', 'type' => 'xsd:string'),
		'KIVOTOS_ID' => array('name' => 'KIVOTOS_ID', 'type' => 'xsd:string'),
		'CLIENT_ID' => array('name' => 'CLIENT_ID', 'type' => 'xsd:string'),
		'USER_ID' => array('name' => 'USER_ID', 'type' => 'xsd:string'),
		'IPADDRESS' => array('name' => 'IPADDRESS', 'type' => 'xsd:string'),
		'SESSIONID' => array('name' => 'SESSIONID', 'type' => 'xsd:string')
	)
);






/*
$params = array('oAssetAccessGrantReq' =>
			array('ASSET_ID' => $this->retrieve_Form_Data['ASSET_ID'], 
			'KIVOTOS_ID' => $this->retrieve_Form_Data("KIVOTOS_ID"),
			'CLIENT_ID' => self::$oUser->retrieve_Form_Data("CLIENT_ID"),
			'USER_ID' => self::$oUser->retrieve_Form_Data("USER_ID"),
			'IPADDRESS' => self::$oUser->retrieve_Form_Data("IPADDRESS"),
			'PHPSESSION' => self::$oUser->retrieve_Form_Data("PHPSESSION")
			)
		);

		$methodName = 'assetAccessGrantReq';

*/


//
//$server->wsdl->addSimpleType(
//	'oStringResponse',
//	'',
//	'simpleType',
//	'scalar',
//	array('RESPONSETEXT' => array('name' => 'RESPONSETEXT','type' => 'xsd:string'))
//);  

function saveNewAsset($soapRequest){
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oCRNRSTN_ENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('saveNewAsset',$soapRequest);

	return $SERVICE_RESPONSE;
}

function assetAccessGrantReq($soapRequest){
	$SERVICE_RESPONSE = '';
	
	//
	// INSTANTIATE WEB SERVICE MANAGER
	if(!isset($oSERVICE_MGR)){
		$oSERVICE_MGR = new webservice_manager($_SESSION['oCRNRSTN_ENV']);
	}
	
	//
	// PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
	$SERVICE_RESPONSE = $oSERVICE_MGR->buildResponse('assetAccessGrantReq',$soapRequest);

	return $SERVICE_RESPONSE;
}


//
// SOAP METHOD REGISTRATION
$server->register('saveNewAsset',            						// method name
    array('oUploadAssetInfo' => 'tns:oAsset'),						// input parameters
    array('return' => 'xsd:string'),				  				// output parameters
    'urn:saveNewAssetwsdl',                							// namespace
    'urn:saveNewAssetwsdl#saveNewAsset',							// soapaction
    'rpc',                                    						// style
    'encoded',                                						// use
    'Save details for extranet asset.'								// documentation
);

$server->register('assetAccessGrantReq',            				// method name
    array('oAssetAccessGrantReq' => 'tns:oAssetAuthReq'),			// input parameters
    array('return' => 'tns:oAsset'),				  				// output parameters
    'urn:assetAccessGrantReqwsdl',                					// namespace
    'urn:assetAccessGrantReqwsdl#assetAccessGrantReq',				// soapaction
    'rpc',                                    						// style
    'encoded',                                						// use
    'Request authorization for asset download.'						// documentation
);


if(!$oCRNRSTN_ENV->oHTTP_MGR->issetHTTP($_GET)){
	if($oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->exclusiveAccess('184.173.96.66,50.87.249.11,172.16.110.134,172.16.*')){
		$server->service(file_get_contents('php://input'));
	}else{
		$oCRNRSTN_ENV->returnSrvrRespStatus(403);	
	}
}else{
	$server->service(file_get_contents('php://input'));
}

session_destroy();
exit();
?>