<?php
/* 
// J5
// Code is Poetry */

include_once('_crnrstn.config.inc.php');

//
// INSTANTIATE COOKIE MANAGER
$oCOOKIE_MGR = new crnrstn_cookie_manager();

//
// DELETE ALL COOKIES
$oCOOKIE_MGR->deleteAllCookies();
echo "deleting all cookies..................COMPLETE<br>";

session_start();
echo "deleting all sessions......................STARTED<br>";
session_destroy();
echo "deleting all sessions..................COMPLETE<br>";
echo '<br><br>//<a href="http://127.0.0.1/crnrstn/j5.php">he\'s dead jim</a>';	
?>