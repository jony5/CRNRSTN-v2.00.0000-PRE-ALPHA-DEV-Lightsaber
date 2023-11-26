<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
require($ROOT.'_crnrstn.config.inc.php');

//
// PROCESS GET METHOD REQUEST TYPE
if($oENV->oHTTP_MGR->issetHTTP($_GET)){
	if(!$oENV->oSESSION_MGR->issetSessionParam('LOGIN_USER_PERMISSIONS_ID')){
		echo 'usercommentdelete=false_login';
	}else{
		//
		// DELETE COMMENT
		if((strlen($oENV->oHTTP_MGR->extractData($_GET, 'c'))==32 && strlen($oENV->oHTTP_MGR->extractData($_GET, 'e'))==20)){
			echo $oUSER->deleteUserComment($oENV->oHTTP_MGR->extractData($_GET, 'c'), $oENV->oHTTP_MGR->extractData($_GET, 'e'));	
		}
	}
}

//header("Location: ".$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'account/');
//header("Location: ".$_SERVER['HTTP_REFERER']);
//exit();
?>