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
// INITIALIZE GLOBAL CRNRSTN DOCUMENTATION NAVIGATION
// INITIALIZE USER WITH ENVIRONMENT CRNRSTN OBJECT
if(!isset($oUSER)){
	$oUSER = new user($oCRNRSTN_ENV);
}

// 
// PROCESS POST METHOD REQUEST TYPE
if($oCRNRSTN_ENV->oHTTP_MGR->issetHTTP($_POST)){

	//
	// WHAT DO WE HAVE
	switch($oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST,'postid')){
		case 'post_comment':
			$comment = $oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST,'comment');
			$styled_code = $oUSER->updateContent_CRNRSTN('post_comment');
			
		break;
		case 'post_feedback':
			if($oCRNRSTN_ENV->oHTTP_MGR->issetParam($_POST,'feedback')){
				//
				// COMPILE FEEDBACK FROM USER AND SEND TO SERVICE
				if($oUSER->updateContent_CRNRSTN('post_feedback')=='submitfeedback=true'){
					//
					// DISPLAY CONFIRMATION NOTICE TO USER
					$oUSER->transactionStatusUpdate('success','post_feedback');
					
				}else{
					//
					// DISPLAY SYSTEM ERROR NOTICE TO USER
					$oUSER->transactionStatusUpdate('error','post_feedback');
				}
			}
		break;		
		default:
			echo 'no content submitted...';
			die();
		break;

	}
}


//
// ACTIVITY LOGGING
//try{
//	//
//	// GRAB DATABASE CONNECTION TO LOG ACTIVITY **[POSSIBLE ENHANCEMENT]::BREAK CREATE A database.inc.php FOR THE SITE**
//	$mysqli = $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection();
//	#$mysqli = $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection('localhost');
//	#$mysqli = $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection('localhost', 'crnrstn_stage');
//	
//	$query="INSERT INTO `log_activity` (`ACTIVITY_TYPE` , `ACTIVITY_NAME`, `SCRIPT_NAME`, `HTTP_USER_AGENT`, `HTTP_REFERER`, `HTTP_HEADERS`,
//	 `REQUEST_METHOD`, `REMOTE_ADDR`) VALUES ('BROWSER_REQUEST',
//	'PAGEVIEW_coder_dev','".$_SERVER['SCRIPT_NAME']."','".$_SERVER['HTTP_USER_AGENT']."','".$_SERVER['HTTP_REFERER']."','".addslashes($oCRNRSTN_ENV->oHTTP_MGR->getHeaders())."','".$_SERVER['REQUEST_METHOD']."','".$_SERVER['REMOTE_ADDR']."');";
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

//try{
//	//
//	// THROW AN EXCEPTION
//	throw new Exception('...yep...nothing is failing here..');
//	
//	echo '<br><br><br><br><br>';
//	
//} catch( Exception $e ) {
//	$oLOGGER->captureNotice('CRNRSTN error testing notification :: nothing has failed', LOG_NOTICE, $e->getMessage());
//}

//
// LOG ACTIVITY
$oUSER->logActivity($contentType,$contentID);


?>