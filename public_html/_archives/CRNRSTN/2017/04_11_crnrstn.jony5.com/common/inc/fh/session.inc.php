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
// PROCESS SEARCH
$oUSER->gotSearched();

// 
// PROCESS POST METHOD REQUEST TYPE
if($oCRNRSTN_ENV->oHTTP_MGR->issetHTTP($_POST)){

	//
	// WHAT DO WE HAVE
	switch($oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST,'postid')){
		case 'email_unsub':
			if($oCRNRSTN_ENV->oHTTP_MGR->issetParam($_POST,'email')){
				
				if($oUSER->unsubscribeEmail()=="unsub=success"){
					$oUSER->transactionStatusUpdate('success','email_unsub');
				}else{
					$oUSER->transactionStatusUpdate('error','email_unsub');
				}
				
			}else{
				$oUSER->transactionStatusUpdate('error','email_unsub');
				
			}
		
		break;
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
		case 'post_comment_reply':
			//
			// PROCESS COMMENT IF MIN REQUIRED DATA HAS BEEN PROVIDED
			if($oCRNRSTN_ENV->oHTTP_MGR->issetParam($_POST,'comment') && $oCRNRSTN_ENV->oHTTP_MGR->issetParam($_POST,'nid_replyto') && ($oCRNRSTN_ENV->oHTTP_MGR->issetParam($_POST,'c') || $oCRNRSTN_ENV->oHTTP_MGR->issetParam($_POST,'m'))){
				//
				// PROCESS USER COMMENT
				if($oUSER->updateContent_CRNRSTN('post_comment_reply')=='usernotereply=true'){	
					//
					// PRESENT SUCCESS TRANSACTION STATUS
					$oUSER->transactionStatusUpdate('success','post_comment_reply');
				}else{
					//
					// PRESENT ERROR TRANSACTION STATUS
					$oUSER->transactionStatusUpdate('error','post_comment_reply');
				}
			}
		
		break;
		case 'post_comment':			// GENERAL ACCOUNT REQUIRED
			//
			// PROCESS COMMENT IF MIN REQUIRED DATA HAS BEEN PROVIDED
			if($oCRNRSTN_ENV->oHTTP_MGR->issetParam($_POST,'comment') && ($oCRNRSTN_ENV->oHTTP_MGR->issetParam($_POST,'c') || $oCRNRSTN_ENV->oHTTP_MGR->issetParam($_POST,'m'))){
				//
				// PROCESS USER COMMENT
				if($oUSER->updateContent_CRNRSTN('post_comment')=='usernotesubmit=true'){	
					//
					// PRESENT SUCCESS TRANSACTION STATUS
					$oUSER->transactionStatusUpdate('success','post_comment');
				}else{
					//
					// PRESENT ERROR TRANSACTION STATUS
					$oUSER->transactionStatusUpdate('error','post_comment');
				}
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
		case 'pswd_reset':
			#error_log("/crnrstn/session.inc.php (93) pswd_reset");
			//
			// PROCESS PASSWORD RESET REQUEST. STEP 1 OF 2.
			#$oUSER->triggerActivationEmail();
			//error_log("crnrstn session.inc.php (115) pswd_reset case executed...");
			if($oUSER->passwordResetRequest()=='pswdreset=true'){
				//
				// DISPLAY CONFIRMATION NOTICE TO USER
				$oUSER->transactionStatusUpdate('success','pswd_reset');
				$_SESSION['TMP_QUERY_EXECUTE'] = "";
			}else{
				//
				// DISPLAY SYSTEM ERROR NOTICE TO USER
				$oUSER->transactionStatusUpdate('error','pswd_reset');
				$_SESSION['TMP_QUERY_EXECUTE'] = "";
			}
		
		break;
		case 'password_reset':
			//
			// AFTER LINK CLICKED AND NEW PASSWORD PROVIDED. PROCESS PASSWORD RESET REQUEST. STEP 2 OF 2.
			if($oUSER->pwdRstRequest()=='passwordreset=true'){
				//
				// DISPLAY CONFIRMATION NOTICE TO USER
				$oUSER->transactionStatusUpdate('success','password_reset');
				
			}else{
				//
				// DISPLAY SYSTEM ERROR NOTICE TO USER
				$oUSER->transactionStatusUpdate('error','password_reset');
			}
			
			
		
		break;
		case 'resend_activation':
			#error_log("/crnrstn/session.inc.php (93) resend_activation");
			//
			// PROCESS ACCOUNT ACTIVATION LINK REQUEST
			#$oUSER->triggerActivationEmail();
			if($oUSER->triggerActivationEmail()=='triggeractivationemail=true'){
				//
				// DISPLAY CONFIRMATION NOTICE TO USER
				$oUSER->transactionStatusUpdate('success','resend_activation');
				$_SESSION['TMP_QUERY_EXECUTE'] = "";
			}else{
				//
				// DISPLAY SYSTEM ERROR NOTICE TO USER
				$oUSER->transactionStatusUpdate('error','resend_activation');
				$_SESSION['TMP_QUERY_EXECUTE'] = "";
			}
		break;
		case 'new_class':				// ADMIN ACCOUNT REQUIRED
		case 'new_method':				// ADMIN ACCOUNT REQUIRED
		case 'new_example':				// ADMIN ACCOUNT REQUIRED
		case 'new_parameter':			// ADMIN ACCOUNT REQUIRED
		case 'new_tech_spec':			// ADMIN ACCOUNT REQUIRED
		case 'edit_class':				// ADMIN ACCOUNT REQUIRED
		case 'edit_method':				// ADMIN ACCOUNT REQUIRED
		case 'new_function':			// ADMIN ACCOUNT REQUIRED
		case 'edit_function':			// ADMIN ACCOUNT REQUIRED
		case 'edit_example':			// ADMIN ACCOUNT REQUIRED
		case 'edit_parameter':			// ADMIN ACCOUNT REQUIRED
		case 'order_method':			// ADMIN ACCOUNT REQUIRED
		case 'edit_techspec':			// ADMIN ACCOUNT REQUIRED
		case 'delete_class':			// ADMIN ACCOUNT REQUIRED
		case 'delete_method':			// ADMIN ACCOUNT REQUIRED
		case 'delete_example':			// ADMIN ACCOUNT REQUIRED
		case 'delete_parameter':		// ADMIN ACCOUNT REQUIRED
		case 'delete_tech_spec':		// ADMIN ACCOUNT REQUIRED
		case 'method_parameters':		// ADMIN ACCOUNT REQUIRED
		case 'edit_message':
			//
			// ADMIN ONLY
			if($oUSER->getUserParam('USER_PERMISSIONS_ID')>399){

				//
				// PROCESS NEW ACCOUNT CREATION ATTEMPT
				if($oUSER->updateContent_CRNRSTN($oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST,'postid'))){
					//
					// UPDATE SESSION SUCCESS FOR PRESENTATION TO END USER
					//return true;
				}else{
					//
					//	UPDATE SESSION ERROR FOR PRESENTATION TO END USER
				
				}
			}
			
		break;

	}
}

//
// PROCESS GET METHOD REQUEST TYPE
if(!isset($tmp_navOnly)){

	if($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'f')==''){
		
		//if($oCRNRSTN_ENV->oSESSION_MGR->issetSessionParam('LOGIN_USER_PERMISSIONS_ID')){	
				
			//
			// RETRIEVE CONTENT (SOAP)
			$oUSER->contentRetrieve();
		//}
		
		#if($oCRNRSTN_ENV->oHTTP_MGR->issetParam($_GET, 'c')){
		
		if($oUSER->classID_SOURCE!='' || ($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'c')!="")){
			if($oUSER->classID_SOURCE!=''){
				$contentID = $oUSER->classID_SOURCE;
			}else{
				$contentID = $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'c');
			}
			
			$contentType = 'class';
			$contentParam = 'c';
			$classDesignation=' ::';
		}else{
			#if($oCRNRSTN_ENV->oHTTP_MGR->issetParam($_GET, 'm')){
			if($oUSER->methodID_SOURCE!='' || ($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'm')!="")){
				if($oUSER->methodID_SOURCE!=''){
					$contentID = $oUSER->methodID_SOURCE;
				}else{
					$contentID = $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'm');
				}
				
				$contentType = 'method';
				$contentParam = 'm';
				$classDesignation='';
			}
		}
	}
	
	if($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'accountdeactivate')=='true'){
		$oUSER->transactionStatusUpdate('success','account_deactivate');
	}
}

//
// ACTIVITY LOGGING
//try{
//	//
//	// GRAB DATABASE CONNECTION TO LOG ACTIVITY **[POSSIBLE ENHANCEMENT]::BREAK CREATE A database.inc.php FOR THE SITE**
//	#$mysqli = $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection('localhost', 'crnrstn_stage', 'crnrstn00');
//	$mysqli = $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection();
//	
//	$query="INSERT INTO log_activity (`ACTIVITY_TYPE` , `ACTIVITY_NAME`, `ACTIVITY_CONTENTID`, `SCRIPT_NAME`, `HTTP_USER_AGENT`, `HTTP_REFERER`, `HTTP_HEADERS`,
//	 `REQUEST_METHOD`, `REMOTE_ADDR`) VALUES ('BROWSER_REQUEST',
//	'PAGEVIEW_".strtoupper($contentType)."',
//	'".$mysqli->real_escape_string($contentID)."',
//	'".$_SERVER['SCRIPT_NAME']."','".$_SERVER['HTTP_USER_AGENT']."',
//	'".$_SERVER['HTTP_REFERER']."','".addslashes($oCRNRSTN_ENV->oHTTP_MGR->getHeaders())."','".$_SERVER['REQUEST_METHOD']."','".$_SERVER['REMOTE_ADDR']."');";
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
if(!isset($contentType)){
	$contentType="general page";
	$contentID="";
}
$oUSER->logActivity($contentType,$contentID);


//
// NAVIGATION STATE MANAGEMENT		
$ns = $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'ns');		// URI PRIORITY
if(strlen($ns)<4){

	//
	// IF NO NAV STATE IN URI, ATTEMPT TO GET FROM SESSION DATA
	if(!$oCRNRSTN_ENV->oSESSION_MGR->issetSessionParam('NS')){
		//
		// IF NO NAV STATE IN SESSION, ATTEMPT TO GET FROM COOKIE DATA
		$ns = $oCRNRSTN_ENV->oCOOKIE_MGR->getCookie('clientNavigationState');
		#error_log('(223) NAV STATE FROM COOKIE :: '.$ns);
		if(strlen($ns)>4){
			//
			// INITIALIZE SESSION DATA FROM COOKIE DATA
			$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('NS', $ns);
		}
	}else{
		//
		// GET NAV STATE FROM SESSION
		$ns = $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('NS');
		#error_log('(228) NAV STATE FROM SESSION :: '.$ns);
	}
}else{
	//
	// UPDATE SESSION AND COOKIE DATA WITH URI STATE
	$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('NS', $ns);
	$oCRNRSTN_ENV->oCOOKIE_MGR->addCookie('clientNavigationState', $ns, time()+60*60*24*100, '/');
	#error_log('(235) NAV STATE FROM URI :: '.$ns);
}

$tmp_dataMode = explode('|',$oUSER->getEnvParam('DATA_MODE'));

if($tmp_dataMode[0]=='SOAP'){
	//
	// GET LIST OF NAV NODES (CLASS NAMES)
	if(!$oCRNRSTN_ENV->oSESSION_MGR->issetSessionParam('NS_OPT')){

		if(isset($oUSER->contentOutput_ARRAY[1]['NAV']['CLASS'])){

			$tmp_cnt = sizeof($oUSER->contentOutput_ARRAY[1]['NAV']['CLASS']);

			for($i = 0; $i < $tmp_cnt; $i++){

				$tmp_nav_node .= $oUSER->contentOutput_ARRAY[1]['NAV']['CLASS'][$i]['NAME'].'|';

			}
			
			//
			// REMOVE TRAILING PIPE AND STORE IN SESSION
			$tmp_nav_node = substr($tmp_nav_node, 0 , -1);
			if(strlen($tmp_nav_node)>5){
				$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('NS_OPT', $tmp_nav_node);
			}

		}

	}

}

?>