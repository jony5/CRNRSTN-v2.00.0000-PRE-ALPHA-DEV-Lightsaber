<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/classes/messenger.inc.php');



//
// INSTANTIATE MESSENGER OBJECT
$oMessenger = new messenger($oCRNRSTN_ENV, $oUSER);

if($oMessenger->isValid()){
	echo $oMessenger->processSystemMessages();
}else{
	echo "success_no_send";	
}

?>