<?php
/* 
// J5
// Code is Poetry */

//
// SSL CHECK WHERE IT MATTERS
if($oCRNRSTN_ENV->getEnvParam('FORCE_SSL')){
	if(!$oUSER->isSSL()){
		
		header("Location: https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
		exit();
	}
}else{
    if($oUSER->isSSL()){

        header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        exit();
    }

}

//
// DO WE BELONG HERE?
if(!isset($utype)){
	$utype = NULL;	
}

if($oUSER->validUser($utype)){
	
	//
	// WE HAVE A VALID RESOURCE REQUEST
	if(!($oUSER->validSession())){
		//
		// ACCESS DENIED - SAVE REQUESTED RESOURCE TO BE RECALLED UPON SUCCESSFUL AUTHENTICATION

		//
		// SET LANDING PAGE TO TMP VAR...FOR REDIRECT AFTER SUCCESSFUL LOGIN.
		if(!$oUSER->isSSL()){
			$oUSER->setLandingPage("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
		}else{
			$oUSER->setLandingPage("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
			
		}
		
		//
		// CLEAR PERMISSIONS ID
		$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam("USER_PERMISSIONS_ID",0);
		
		//error_log("evifweb secure.inc.php (39) LP RESOURCE->"."http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
		header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'account/signin/');
		exit();
		
	}
}else{
	//
	// SAVE RESOURCE REQUESTED TO BE RECALLED UPON SUCCESSFUL AUTHENTICATION

	//
	// SET LANDING PAGE TO TMP VAR...FOR REDIRECT AFTER SUCCESSFUL LOGIN.
	if(!$oUSER->isSSL()){
		$oUSER->setLandingPage("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
	}else{
		$oUSER->setLandingPage("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
		
	}
	
	//
	// CLEAR PERMISSIONS ID
	$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam("USER_PERMISSIONS_ID",0);
	
	//error_log("evifweb secure.inc.php (57) RESOURCE->"."http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
	header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'account/signin/');
	exit();
	
}

?>