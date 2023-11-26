<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
require($ROOT.'_crnrstn.config.inc.php');
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/fh/session.inc.php');

//
// PROCESS LIKE
if($oENV->oHTTP_MGR->extractData($_GET, 'nid')!="" && $oENV->oHTTP_MGR->extractData($_GET, 'un')!="" && ($oENV->oHTTP_MGR->extractData($_GET, 'cid') !="" || $oENV->oHTTP_MGR->extractData($_GET, 'mid') !="")){
	
	$oUSER->toggleLike();
}
?>