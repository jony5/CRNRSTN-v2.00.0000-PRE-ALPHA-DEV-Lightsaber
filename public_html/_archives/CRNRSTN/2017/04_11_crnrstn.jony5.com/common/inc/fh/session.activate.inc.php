<?php
/* 
// J5
// Code is Poetry */

//
// CLASSES HAVE BEEN INCLUDED. LET'S PUT SOMETHING TOGETHER.
##
# HTTP GET
# SOAP REQUST
# SOAP RESPONSE
# ===============
# RENDER RESPONSE
// 
// PROCESS POST METHOD REQUEST TYPE
if($oENV->oHTTP_MGR->issetHTTP($_POST)){

	//
	// WHAT DO WE HAVE
	switch($oENV->oHTTP_MGR->extractData($_POST,'postid')){
		case 'login_main':				// ANONYMOUS OK
			//
			// PROCESS LOGIN ATTEMPT
			if(!$oUSER->login()){
				//
			}
			
		break;
	}
}

//
// PROCESS GET METHOD REQUEST TYPE
if($oENV->oHTTP_MGR->issetHTTP($_GET)){
	
	//
	// PROCESS ACCOUNT ACTIVATION
	if(strlen($oENV->oHTTP_MGR->extractData($_GET, 'k'))==50 && $oENV->oHTTP_MGR->issetParam($_GET, 'un')){
		$oUSER->activate();
	}else{
		$this->transactionStatusUpdate('error','activate_linkerr');
	}
}
?>