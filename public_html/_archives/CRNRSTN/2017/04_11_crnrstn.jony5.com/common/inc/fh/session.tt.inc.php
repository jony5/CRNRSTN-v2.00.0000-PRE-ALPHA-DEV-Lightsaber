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
if($oCRNRSTN_ENV->oHTTP_MGR->issetHTTP($_GET)){

	$toolTipOutput_ARRAY = array();
	
	//
	// RETRIEVE TOOL TIP CONTENT (SOAP)
	if(strlen($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'e'))==20){
		$oUSER->toolTipRetrieve();
	}
}

//
// ACTIVITY LOGGING
//try{
//	//
//	// GRAB DATABASE CONNECTION TO LOG ACTIVITY **[POSSIBLE ENHANCEMENT]::BREAK CREATE A database.inc.php FOR THE SITE**
//	$mysqli = $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection();
//	
//	$query="INSERT INTO log_activity (`ACTIVITY_TYPE` , `ACTIVITY_NAME`, `ACTIVITY_CONTENTID`, `SCRIPT_NAME`, `HTTP_USER_AGENT`, `HTTP_REFERER`, `HTTP_HEADERS`,
//	 `REQUEST_METHOD`, `REMOTE_ADDR`) VALUES ('BROWSER_AJAX_REQUEST',
//	'PAGEVIEW_TOOLTIP','".$mysqli->real_escape_string($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'e'))."', '".$_SERVER['SCRIPT_NAME']."','".$_SERVER['HTTP_USER_AGENT']."','".$_SERVER['HTTP_REFERER']."','".$mysqli->real_escape_string($oCRNRSTN_ENV->oHTTP_MGR->getHeaders())."','".$_SERVER['REQUEST_METHOD']."','".$_SERVER['REMOTE_ADDR']."');";
//	
//	$result = $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->processQuery($mysqli, $query);
// 
//	$oCRNRSTN_ENV->oMYSQLI_CONN_MGR->closeConnection($mysqli);
//	
//} catch( Exception $e ) {
//	//
//	// LOG ERROR FOR DB ACTIVITY LOGGING
//	$oCRNRSTN_ENV->oLOGGER->captureNotice('CRNRSTN error notification :: mysqli query failed', LOG_NOTICE, $e->getMessage());
//}
//
// LOG ACTIVITY
$oUSER->logActivity($contentType,$contentID);

?>