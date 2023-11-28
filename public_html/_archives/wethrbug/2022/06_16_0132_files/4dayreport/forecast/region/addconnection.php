<?php
session_start();

include("root.inc.php");
include("$ROOT./db/wethrdb.inc.php");
include("$ROOT./5dayforecast/security/sessionmgmt/session.inc.php");
include("$ROOT./common/inc/logs.inc.php");

//
// DEFINE VARIABLES
$MNHASH=$_SESSION['MNHASH'];
$UNHASH=$_SESSION['UNHASH'];
$status=$_SESSION['status'];

$CONNECTION_NACL=$_GET['grid'];


//
// GET CONNECTION ID OF FRIEND USING NACL
$queryConnectionID=mysql_query("select ID, USERNAME, STATUS, NACL from users where NACL='".$CONNECTION_NACL."' Limit 1");
list($TGT_USERID, $TGT_USERNAME, $TGT_STATUS, $TGT_NACL)=mysql_fetch_row($queryConnectionID);

$queryConnectionID=mysql_query("update connections set ROWSTATUS='active', DATEAPPROVED='$ts' where USERID ='".$TGT_USERID."' AND CONNECTION_USERID='".$_SESSION['USERID']."' AND ROWSTATUS='pending' Limit 1");

//
// ADD CONNECTION IN REVERSE
$query=mysql_query("select ID from connections where USERID='".$_SESSION['USERID']."' AND CONNECTION_USERID='".$TGT_USERID."' AND ROWSTATUS!='deleted' LIMIT 1");

if(mysql_num_rows($query)<1){
	$querystring="insert into connections (USERID,CONNECTION_USERID) values('".$_SESSION['USERID']."','".$TGT_USERID."')";
	mysql_query("$querystring") or die(mysql_error()."  Please contact support if this problem continues. support@wethrbug.com");
}
//
// PROCESS MESSAGE

header("Location: $ROOT/");
exit();

?>