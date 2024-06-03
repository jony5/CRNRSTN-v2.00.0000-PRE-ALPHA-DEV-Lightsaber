<?php
/* 
// J5
// Code is Poetry */
echo 'i am not being used...';
die();
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
// RETRIEVE CONTENT (SOAP)
//$oUSER->navigationRetrieve();

// 
// PROCESS POST METHOD REQUEST TYPE
if($oCRNRSTN_ENV->oHTTP_MGR->issetHTTP($_POST)){
	//
	// WHAT DO WE HAVE
	switch($oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST,'postid')){
		case 'login_main':				// ANONYMOUS OK

			//
			// INITIALIZE DATABASE INTEGRATION
			if(!isset($oDATABASE)){
				$oDATABASE = new database_integration();
			}
			
			//
			// INITIALIZE USER WITH ENVIRONMENT CRNRSTN OBJECT
			if(!isset($oUSER)){
				$oUSER = new user($oCRNRSTN_ENV);
			}
			
			//
			// INITIALIZE ERR/SUCCESS CONTAINERS
			$oUSER->clearNotifications();
			
			//
			// SET USER LANDING PAGE (DESTINATION CURRENTLY NOT SUCCESS/FAIL DEPENDENT FROM MAIN LOGIN)
			$oUSER->setLandingPage('crnrstn/');
			
			//
			// PROCESS LOGIN ATTEMPT
			$result = $oUSER->login();
			
			//
			// BUBBLE UP SUCCESS/ERRORS
			$oUSER->broadcastNotifications();
			
		break;
		case 'create_account':			// ANONYMOUS OK
			
			//
			// INITIALIZE USER WITH ENVIRONMENT CRNRSTN OBJECT
			if(!isset($oUSER)){
				$oUSER = new user($oCRNRSTN_ENV);
			}
			
			//
			// INITIALIZE ERR/SUCCESS CONTAINERS
			$oUSER->clearNotifications();

			//
			// PROCESS NEW ACCOUNT CREATION ATTEMPT
			$oUSER->createNewAccount();
			
			//
			// BUBBLE UP SUCCESS/ERRORS
			$oUSER->broadcastNotifications();
			
		break;	
		case 'email_unique':			// ANONYMOUS OK

			//
			// INITIALIZE USER WITH ENVIRONMENT CRNRSTN OBJECT
			if(!isset($oUSER)){
				$oUSER = new user($oCRNRSTN_ENV);
			}
			
			//
			// INITIALIZE ERR/SUCCESS CONTAINERS
			$oUSER->clearNotifications();

		break;
		case 'post_comment':			// GENERAL ACCOUNT REQUIRED
		break;
		case 'new_class':				// ADMIN ACCOUNT REQUIRED
		case 'new_method':				// ADMIN ACCOUNT REQUIRED
		case 'new_example':				// ADMIN ACCOUNT REQUIRED
		case 'new_parameter':			// ADMIN ACCOUNT REQUIRED
		case 'new_tech_spec':			// ADMIN ACCOUNT REQUIRED
		case 'edit_class':				// ADMIN ACCOUNT REQUIRED
		case 'edit_method':				// ADMIN ACCOUNT REQUIRED
		case 'edit_example':			// ADMIN ACCOUNT REQUIRED
		case 'edit_parameter':			// ADMIN ACCOUNT REQUIRED
		case 'edit_techspec':			// ADMIN ACCOUNT REQUIRED
		case 'delete_class':			// ADMIN ACCOUNT REQUIRED
		case 'delete_method':			// ADMIN ACCOUNT REQUIRED
		case 'delete_example':			// ADMIN ACCOUNT REQUIRED
		case 'delete_parameter':		// ADMIN ACCOUNT REQUIRED
		case 'delete_tech_spec':		// ADMIN ACCOUNT REQUIRED

			//
			// ADMIN ONLY
			if($oUSER->getUserParam('USER_PERMISSIONS_ID')>399){

				//
				// INITIALIZE USER WITH ENVIRONMENT CRNRSTN OBJECT
				if(!isset($oUSER)){
					$oUSER = new user($oCRNRSTN_ENV);
				}
			
				//
				// PROCESS NEW ACCOUNT CREATION ATTEMPT
				if($oUSER->updateContent_CRNRSTN($oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST,'postid'))){
					//
					// UPDATE SESSION SUCCESS FOR PRESENTATION TO END USER
				
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
if($oCRNRSTN_ENV->oHTTP_MGR->issetHTTP($_GET)){
	$contentOutput_ARRAY = array();
	
	//
	// INITIALIZE USER WITH ENVIRONMENT CRNRSTN OBJECT
	if(!isset($oUSER)){
		$oUSER = new user($oCRNRSTN_ENV);
	}
	
	//
	// RETRIEVE CONTENT (SOAP)
	//$oUSER->contentRetrieve();
}

//
// ACTIVITY LOGGING
try{
	//
	// GRAB DATABASE CONNECTION TO LOG ACTIVITY **[POSSIBLE ENHANCEMENT]::BREAK CREATE A database.inc.php FOR THE SITE**
	$mysqli = $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection('localhost', 'crnrstn_stage');
	
	$query="INSERT INTO `log_activity` (`ACTIVITY_TYPE` , `ACTIVITY_NAME`, `SCRIPT_NAME`, `HTTP_USER_AGENT`, `HTTP_REFERER`, `HTTP_HEADERS`,
	 `REQUEST_METHOD`, `REMOTE_ADDR`) VALUES ('BROWSER_REQUEST',
	'PAGEVIEW','".$_SERVER['SCRIPT_NAME']."','".$_SERVER['HTTP_USER_AGENT']."','".$_SERVER['HTTP_REFERER']."','".addslashes($oCRNRSTN_ENV->oHTTP_MGR->getHeaders())."','".$_SERVER['REQUEST_METHOD']."','".$_SERVER['REMOTE_ADDR']."');";
	
	$result = $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->processQuery($mysqli, $query);
 
	$oCRNRSTN_ENV->oMYSQLI_CONN_MGR->closeConnection($mysqli);
	
} catch( Exception $e ) {
	//
	// LOG ERROR FOR DB ACTIVITY LOGGING
	$oCRNRSTN_ENV->oLOGGER->captureNotice('CRNRSTN error notification :: mysqli query failed', LOG_NOTICE, $e->getMessage());
}

//
// NAVIGATION STATE MANAGEMENT
$ns = $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'ns');
$ns_updated = '';

//
// PARSE NAVSTATE AS COMMA DELIMITED AND CLEAN OUT ANY GARBAGE
$navItem_ARRAY = explode(",", $ns);

for($i=0;$i<sizeof($navItem_ARRAY);$i++){

	switch($navItem_ARRAY[$i]){
		case 'crnrstn':
		case 'logging':
		case 'environmentals':
		case 'cookie_manager':
		case 'http_manager':
		case 'ip_auth_manager':
		case 'cipher_manager':
		case 'mysqli_conn_manager':
		case 'mysqli_conn':
		case 'session_manager':
			$pos = strpos($ns_updated, $navItem_ARRAY[$i]);
			if( $pos === false){
				$ns_updated=$ns_updated.','.$navItem_ARRAY[$i];
			}
		break;
		default:
		break;
	
	}
}

//
// TRIM LEADING COMMA
$ns_updated = ltrim($ns_updated, ",");

//
// UPDATE SESSION AND COOKIE DATA FOR NAVSTATE
if($ns_updated!=""){
	//
	// INITIALIZATION OF SESSION NAV STATE PARAMETER
	$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('NS', $ns_updated);
	
	//
	// INITIALIZATION OF COOKIE NAV STATE PARAMETER
	$oCRNRSTN_ENV->oCOOKIE_MGR->addCookie("clientNavigationState", $ns_updated, time()+60*60*24*100, '/');
	
}else{
	
	//
	// CAN WE GET NAVSTATE INITIALIZATION INFORMATION FROM COOKIE
	$ns_updated = $oCRNRSTN_ENV->oCOOKIE_MGR->getCookie('clientNavigationState');
	
	if($ns_updated!=""){
		//
		// INITIALIZE SESSION FROM COOKIE DATA
		$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('NS', $ns_updated);
	}	
}
?>