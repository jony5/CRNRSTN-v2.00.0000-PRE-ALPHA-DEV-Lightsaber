<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
require($ROOT.'_crnrstn.config.inc.php');

//
// PROCESS GET METHOD REQUEST TYPE
if($oENV->oHTTP_MGR->issetHTTP($_GET)){
	
	//
	// RETRIEVE CONTENT (SOAP)
	$commentStatus = '';
	
	//
	// RETURN SEARCH RESULTS FOR AUTO-SUGGEST
	if((strlen($oENV->oHTTP_MGR->extractData($_GET, 'c'))==20 || strlen($oENV->oHTTP_MGR->extractData($_GET, 'm'))==20) && strlen($oENV->oHTTP_MGR->extractData($_GET, 'u'))>4){
		$commentStatus = $oUSER->getCommInsertStatus();	
	}
}

echo $commentStatus;

?>