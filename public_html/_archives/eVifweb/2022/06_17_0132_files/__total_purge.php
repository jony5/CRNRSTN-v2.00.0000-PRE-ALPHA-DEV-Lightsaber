<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');

//
// DELETE ALL COOKIES
$oCRNRSTN_ENV->oCOOKIE_MGR->deleteAllCookies();
echo "deleting all cookies..................COMPLETE<br>";

if ( ! session_id() ) @ session_start();
session_destroy();
echo "deleting all sessions..................COMPLETE<br>";
echo '<br><br>//he\'s dead jim</a>';	
?>