<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');
require($oENV->getEnvParam('DOCUMENT_ROOT').$oENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/session/session.inc.php');

//echo $oUSER->triggerEmail();
echo $oUSER->generateNewKey(50); 
echo "<br><br>";
echo strlen(session_id());
?>