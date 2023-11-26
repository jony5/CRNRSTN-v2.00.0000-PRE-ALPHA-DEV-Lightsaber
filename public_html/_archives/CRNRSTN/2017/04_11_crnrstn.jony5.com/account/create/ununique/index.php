<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
require($ROOT.'_crnrstn.config.inc.php');

if(!isset($oUSER)){
	$oUSER = new user($oENV);
}

//
// PROCESS POTENTIAL USERNAME FOR NEW ACCOUNT
try{
	if($oUSER->isValidUsername($oENV->oHTTP_MGR->extractData($_GET,'un'))){
		echo 'SUCCESS';
	}else{
		echo 'ERROR '.$oENV->oSESSION_MGR->getSessionParam('ERRMSG');
	}
	
}catch( Exception $e ) {
	//
	// LOG ERROR FOR UN CHECK
	$oENV->oLOGGER->captureNotice('CRNRSTN error notification :: $oUSER->validUsername() failed', LOG_NOTICE, $e->getMessage());
}

?>