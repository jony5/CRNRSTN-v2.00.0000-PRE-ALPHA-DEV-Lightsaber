<?php
session_start();
include("root.inc.php");
include("$ROOT./db/wethrdb.inc.php");
include("$ROOT./4dayreport/security/sessionmgmt/session.inc.php");
include("$ROOT./common/inc/logs.inc.php");

//
// DEFINE VARIABLES
$MNHASH=$_SESSION['MNHASH'];
$UNHASH=$_SESSION['UNHASH'];
$status=$_SESSION['status'];

//
// GET SUBMITTED DATA
$CONNECTION_USERNAME=addslashes(strtolower(trim($_POST['username'])));
$MESSAGE=addslashes(trim($_POST['message']));
$SYSACTIONSTTAUS=$_GET['j'];


//
// DOES THIS USER EXISTS?
$CONNECTION_UNHASH = md5($CONNECTION_USERNAME); 

//
// PERFORM SYSTEM LOOKUP FOR UNIQUE USERNAME
$query=mysql_query("select ID from users where UNHASH='".$CONNECTION_UNHASH."' AND ROWSTATUS='active' Limit 1");
if(mysql_num_rows($query)>0){
	list($CONNECTION_USERID)=mysql_fetch_row($query);
	//
	// THE USER EXISTS. IS THERE AN ADD REQUEST PENDING?
	//echo "USER HAS BEEN FOUND";
	
	$query=mysql_query("select ID from connections where USERID='".$_SESSION['USERID']."' AND CONNECTION_USERID='".$CONNECTION_USERID."' LIMIT 1");
	
	
	if(mysql_num_rows($query)<1){
		$querystring="insert into connections (USERID,CONNECTION_USERID) values('".$_SESSION['USERID']."','".$CONNECTION_USERID."')";
		mysql_query("$querystring") or die(mysql_error()."  Please contact support if this problem continues. support@wethrbug.com");
	}
	//
	// PROCESS MESSAGE
	
	header("Location: $ROOT");
	exit();
	
	
}else{
	//
	// THIS USER COULD NOT BE FOUND
	//echo "USER COULD NOT BE FOUND.";
	header("Location: $ROOT/newconnection/error.php?username=".$CONNECTION_USERNAME);
	exit();
}



?>