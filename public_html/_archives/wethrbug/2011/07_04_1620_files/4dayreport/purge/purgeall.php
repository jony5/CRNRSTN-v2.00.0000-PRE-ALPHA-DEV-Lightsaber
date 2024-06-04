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



$querystring="update posts set ROWSTATUS='purged', POST_COPY='' WHERE AUTHOR_USERID='".$_SESSION['USERID']."'";
mysql_query("$querystring") or die(mysql_error()."  Please contact support if this problem continues. support@wethrbug.com");

header("Location: $ROOT/");
exit();
?>