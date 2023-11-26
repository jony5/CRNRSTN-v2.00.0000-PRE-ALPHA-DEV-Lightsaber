<?php
//session_start();
//session_destroy();
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
require($ROOT.'_crnrstn.config.inc.php');

//
// RETURN SEARCH RESULTS FOR AUTO-SUGGEST
if($oENV->oHTTP_MGR->issetParam($_GET, 's') && strlen(trim($oENV->oHTTP_MGR->extractData($_GET, 's')))>1){
	echo $oUSER->suggestSearchResults(trim(strtolower($oENV->oHTTP_MGR->extractData($_GET, 's'))));		
}
?>