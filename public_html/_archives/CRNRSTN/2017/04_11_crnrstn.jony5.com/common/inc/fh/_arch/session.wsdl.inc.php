<?php
/* 
// J5
// Code is Poetry */

//
// ACTIVITY LOGGING
try{
	//
	// GRAB DATABASE CONNECTION TO LOG ACTIVITY **[POSSIBLE ENHANCEMENT]::BREAK CREATE A database.inc.php FOR THE SITE**
	$mysqli = $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection('localhost', 'crnrstn_stage');
	
	$query="INSERT INTO `log_activity` (`ACTIVITY_TYPE` , `ACTIVITY_NAME`, `SCRIPT_NAME`, `HTTP_USER_AGENT`, `HTTP_REFERER`, `HTTP_HEADERS`,
	 `REQUEST_METHOD`, `REMOTE_ADDR`) VALUES ('BROWSER_REQUEST',
	'SOAP_REQUEST','".$_SERVER['SCRIPT_NAME']."','".$_SERVER['HTTP_USER_AGENT']."','".$_SERVER['HTTP_REFERER']."','".$mysqli->real_escape_string($oCRNRSTN_ENV->oHTTP_MGR->getHeaders('string'))."','".$_SERVER['REQUEST_METHOD']."','".$_SERVER['REMOTE_ADDR']."');";
	
	$result = $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->processQuery($mysqli, $query);
 
	$oCRNRSTN_ENV->oMYSQLI_CONN_MGR->closeConnection($mysqli);
	
} catch( Exception $e ) {
	//
	// LOG ERROR FOR DB ACTIVITY LOGGING
	$oCRNRSTN_ENV->oLOGGER->captureNotice('CRNRSTN error notification :: mysqli query failed', LOG_NOTICE, $e->getMessage());
}

?>