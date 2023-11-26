<?php

//
// THIS DB ACCESS ONLY PROVIDES SELECT AND INSERT PERMISSIONS

//$link=mysql_connect("localhost","fivedevc_juser01","rMk!yH>jgPU=");
//if(!$link){
	// PIX2FLIX HOSTING
	$link=mysql_connect("localhost","pixtwofl_juser01","rMk!yH>jgPU=") or die ("Database Server Connection Failed");
	mysql_select_db('pixtwofl_j5alive08') or die ("Database select failed");
//}else{
	//FIVEDEV HOSTING
//	mysql_select_db('fivedevc_j5alive08') or die ("Database select failed");
//}

$DBerrormessage="MYSQL query error. Please contact the website administrator if this problem continues.";
?>
