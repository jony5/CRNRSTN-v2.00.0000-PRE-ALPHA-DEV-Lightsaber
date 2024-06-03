<?php
/* 
// J5
// Code is Poetry */

//
// PROCESS SEARCH
$oUSER->gotSearched();

// 
// PROCESS POST METHOD REQUEST TYPE
if($oCRNRSTN_ENV->oHTTP_MGR->issetHTTP($_POST)){

	//
	// WHAT DO WE HAVE
	switch($oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST,'postid')){
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
	}	
}

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
	$oCRNRSTN_ENV->oCOOKIE_MGR->addEncryptedCookie('clientNavigationState', $ns, time()+60*60*24*100, '/');
	#error_log('(235) NAV STATE FROM URI :: '.$ns);
}

$tmp_dataMode = explode('|',$oUSER->getEnvParam('DATA_MODE'));

if($tmp_dataMode[0]=='SOAP'){
	//
	// GET LIST OF NAV NODES (CLASS NAMES)
	if(!$oCRNRSTN_ENV->oSESSION_MGR->issetSessionParam('NS_OPT')){
		for($i=0;$i<sizeof($oUSER->contentOutput_ARRAY[1]['NAV']['CLASS']);$i++){
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

?>