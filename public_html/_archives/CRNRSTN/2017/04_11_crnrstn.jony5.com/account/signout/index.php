<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
require($ROOT.'_crnrstn.config.inc.php');
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/fh/session.inc.php');

#$redirect = $oENV->oSESSION_MGR->getSessionParam('LANDINGPAGE');
//
// SIGN OUT THE USER
//
// INSTANTIATE COOKIE MANAGER SO YOU CAN DESTROY IT
if(!isset($oCOOKIE_MGR)){
	$oCOOKIE_MGR = new crnrstn_cookie_manager($oENV);
}

//
// DELETE ALL COOKIES
$oCOOKIE_MGR->deleteAllCookies();

//
// DESTROY SESSION DATA
session_destroy();
#header("Location: ".$redirect);
error_log("/crnrstn/account/signout/ (26) You are about to throw a header(location) bit. :".$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP'));
//header("Location: ".$_SERVER['HTTP_REFERER']);
header("Location: ".$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'));
exit();
?>
