<?php
/* 
// J5
// Code is Poetry */
//
//include_once('_crnrstn.config.inc.php');
//$oCOOKIE_MGR;
//
////
//// INSTANTIATE COOKIE MANAGER
//if(!isset($oCOOKIE_MGR)){
//	$oCOOKIE_MGR = new crnrstn_cookie_manager($oENV);
//}
//
////
//// DELETE ALL COOKIES
//echo "deleting all cookies......................STARTED<br>";
//$oCOOKIE_MGR->deleteAllCookies();
//echo "deleting all cookies..................COMPLETE<br>";

session_start();
echo "deleting all sessions......................STARTED<br>";
session_destroy();
echo "deleting all sessions..................COMPLETE<br>";
echo '<br><br>//<a href="#">he\'s dead jim</a>';	
?>