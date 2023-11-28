<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
require($CRNRSTN_ROOT.'_crnrstn.config.inc.php');

//
// PROCESS POTENTIAL USERNAME FOR NEW ACCOUNT
try{
	if($oUSER->isValidEmail($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET,'e'))){
		echo 'SUCCESS';
	}else{
		echo 'ERROR Email is already taken.';
	}
	
}catch( Exception $e ) {
	//
	// LOG ERROR FOR UN CHECK
	$oCRNRSTN_ENV->oLOGGER->captureNotice('EVIFWEB error notification :: $oUSER->validUsername() failed', LOG_NOTICE, $e->getMessage());
}

?>