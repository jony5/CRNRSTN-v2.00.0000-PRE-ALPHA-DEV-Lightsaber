<?php
/* 
// J5
// Code is Poetry */

if(!$oCRNRSTN_ENV->oSESSION_MGR->issetSessionParam('LOGIN_USER_PERMISSIONS_ID')){
	//
	// USER NOT AUTHORIZED TO ACCESS THIS PAGE. STORE REQUESTED RESOURCE TO TMP VAR
	$tmp_self = $_SERVER['PHP_SELF'];
	$tmp_self = str_replace('index.php', '', $tmp_self);
	
	//
	// SET LANDING PAGE TO TMP VAR...FOR REDIRECT AFTER SUCCESSFUL LOGIN.
	$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('LANDINGPAGE','http://'.$_SERVER['HTTP_HOST'].$tmp_self);

	header("Location: ".$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'account/signin/');
	exit();
}

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
// PROCESS POST METHOD REQUEST TYPE
if($oCRNRSTN_ENV->oHTTP_MGR->issetHTTP($_POST)){

	//
	// WHAT DO WE HAVE
	switch($oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST,'postid')){
		case 'login_main':				// ANONYMOUS OK
			//
			// PROCESS LOGIN ATTEMPT
			if(!$oUSER->login()){
				//
			}
			
		break;
		case 'create_account':			// ANONYMOUS OK
			//
			// PROCESS NEW ACCOUNT CREATION REQUEST
			$oUSER->createNewAccount();

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
		case 'edit_settings':			// ANONYMOUS NOT OK
			$tmp_response = $oUSER->editAccountSettings();

			//
			// PROCESS TRANSACTION STATUS
			switch($tmp_response){
				case 'updatesettings=true':
					$oUSER->transactionStatusUpdate('success','edit_settings');
				break;
				case 'accountdeactivate=true':
					// REDIRECTED TO HOME PAGE. SEE SESSION.INC.PHP FOR $_GET PROCESSING
				break;			
				case 'password=err':
					$oUSER->transactionStatusUpdate('error','edit_pswd_error');
				break;
				case 'email=err':
					$oUSER->transactionStatusUpdate('error','edit_email_error');
				break;
				default:
					// updatesettings=error or *.*
					$oUSER->transactionStatusUpdate('error','edit_settings');
				break;
			}
		break;
		case 'edit_profile':			// ANONYMOUS NOT OK 
			$tmp_response = $oUSER->editAccountProfile();
			switch($tmp_response){
				case 'updateuserprofile=true':
					//
					// DISPLAY CONFIRMATION NOTICE TO USER
					$oUSER->transactionStatusUpdate('success','edit_profile');
				break;
				case 'updateuserprofile=falseall':
					//
					// DISPLAY SYSTEM ERROR NOTICE TO USER. ALL QUERIES FAILED
					$oUSER->transactionStatusUpdate('error','edit_profile_err_all');
				break;
				default:
					//
					// DISPLAY SYSTEM ERROR NOTICE TO USER
					$oUSER->transactionStatusUpdate('error','edit_profile');
				break;
			}
			
		break;
		case 'edit_comment':			// GENERAL ACCOUNT REQUIRED
			//
			// PROCESS COMMENT IF MIN REQUIRED DATA HAS BEEN PROVIDED
			if($oCRNRSTN_ENV->oHTTP_MGR->issetParam($_POST,'comment') && $oCRNRSTN_ENV->oHTTP_MGR->issetParam($_POST,'c')){
				//
				// SET THRESHOLD FOR APPLICATION OF ADVANCED STYLES TO <CODE>
				if($oUSER->updateContent_CRNRSTN('edit_comment')=='usercommentupdate=true'){				
					//
					// PRESENT SUCCESS TRANSACTION STATUS
					$oUSER->transactionStatusUpdate('success','edit_comment');
				}else{
					//
					// PRESENT ERROR TRANSACTION STATUS
					$oUSER->transactionStatusUpdate('error','edit_comment');
				}
			}			
			
		break;

	}
}

//
// PROCESS GET METHOD REQUEST TYPE
if($oCRNRSTN_ENV->oHTTP_MGR->issetHTTP($_GET)){
	
	//
	// RETURN SEARCH RESULTS FOR AUTO-SUGGEST
	if($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 's')!='' && strlen($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 's'))>1){
		echo $oUSER->suggestSearchResults();		
		die();
	}
	
	$contentOutput_ARRAY = array();

	if($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'f')==''){
		
		//
		// RETRIEVE CONTENT (SOAP)
		//$oUSER->contentRetrieve();
		
		if($oUSER->classID_SOURCE!=""){
			$contentID = $oUSER->classID_SOURCE;
			$contentType = 'class';
			$contentParam = 'c';
			$classDesignation=' ::';
		}else{
			if($oUSER->methodID_SOURCE!=""){
				$contentID = $oUSER->methodID_SOURCE;
				$contentType = 'method';
				$contentParam = 'm';
				$classDesignation='';
			}
		}
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
//	 `REQUEST_METHOD`, `REMOTE_ADDR`) VALUES ('BROWSER_REQUEST',
//	'PAGEVIEW_".strtoupper($contentType)."','".$mysqli->real_escape_string($contentID)."', '".$_SERVER['SCRIPT_NAME']."','".$_SERVER['HTTP_USER_AGENT']."','".$_SERVER['HTTP_REFERER']."','".addslashes($oCRNRSTN_ENV->oHTTP_MGR->getHeaders())."','".$_SERVER['REQUEST_METHOD']."','".$_SERVER['REMOTE_ADDR']."');";
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