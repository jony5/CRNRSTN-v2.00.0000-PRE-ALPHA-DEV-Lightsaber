<?php
//session_start();
//session_destroy();
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
require($CRNRSTN_ROOT.'_crnrstn.config.inc.php');

//
// RETURN SEARCH RESULTS FOR AUTO-SUGGEST
if($oCRNRSTN_ENV->oHTTP_MGR->issetParam($_GET, 's') && strlen(trim($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 's')))>1){
	echo $oUSER->suggestSearchResults(trim(strtolower($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 's'))));		
}
?>