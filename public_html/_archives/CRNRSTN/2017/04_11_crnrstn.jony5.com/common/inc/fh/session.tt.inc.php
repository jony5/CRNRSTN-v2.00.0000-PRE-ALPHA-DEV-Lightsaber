<?php
/* 
// J5
// Code is Poetry */

//
// CLASSES HAVE BEEN INCLUDED. LET'S PUT SOMETHING TOGETHER.
##
# HTTP POST
# HTTP GET
# SOAP REQUST
# SOAP RESPONSE
# ===============
# RENDER RESPONSE

//
// PROCESS GET METHOD REQUEST TYPE
if($oENV->oHTTP_MGR->issetHTTP($_GET)){

	$toolTipOutput_ARRAY = array();
	
	//
	// RETRIEVE TOOL TIP CONTENT (SOAP)
	if(strlen($oENV->oHTTP_MGR->extractData($_GET, 'e'))==20){
		$oUSER->toolTipRetrieve();
	}
}

//
// ACTIVITY LOGGING
try{
	//
	// GRAB DATABASE CONNECTION TO LOG ACTIVITY **[POSSIBLE ENHANCEMENT]::BREAK CREATE A database.inc.php FOR THE SITE**
	$mysqli = $oENV->oMYSQLI_CONN_MGR->returnConnection();
	
	$query="INSERT INTO log_activity (`ACTIVITY_TYPE` , `ACTIVITY_NAME`, `ACTIVITY_CONTENTID`, `SCRIPT_NAME`, `HTTP_USER_AGENT`, `HTTP_REFERER`, `HTTP_HEADERS`,
	 `REQUEST_METHOD`, `REMOTE_ADDR`) VALUES ('BROWSER_AJAX_REQUEST',
	'PAGEVIEW_TOOLTIP','".$mysqli->real_escape_string($oENV->oHTTP_MGR->extractData($_GET, 'e'))."', '".$_SERVER['SCRIPT_NAME']."','".$_SERVER['HTTP_USER_AGENT']."','".$_SERVER['HTTP_REFERER']."','".$mysqli->real_escape_string($oENV->oHTTP_MGR->getHeaders())."','".$_SERVER['REQUEST_METHOD']."','".$_SERVER['REMOTE_ADDR']."');";
	
	$result = $oENV->oMYSQLI_CONN_MGR->processQuery($mysqli, $query);
 
	$oENV->oMYSQLI_CONN_MGR->closeConnection($mysqli);
	
} catch( Exception $e ) {
	//
	// LOG ERROR FOR DB ACTIVITY LOGGING
	$oENV->oLOGGER->captureNotice('CRNRSTN error notification :: mysqli query failed', LOG_NOTICE, $e->getMessage());
}

?>