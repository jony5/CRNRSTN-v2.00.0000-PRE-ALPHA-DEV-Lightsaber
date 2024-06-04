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

$MESSAGE=$_POST['message'];
$CONNECTION_NACL=$_POST['forecastgrid'];   // WHO THE MESSAGE GOES TO

$IPLASTLOGIN=addslashes($_SERVER['REMOTE_ADDR']);
$USERAGENT=addslashes($_SERVER['HTTP_USER_AGENT']);

if($CONNECTION_NACL==""){
	header("Location: $ROOT");
	exit();
}

//
// GET CONNECTION ID OF FRIEND USING NACL
$queryConnectionID=mysql_query("select ID, USERNAME, MOBILENUMBER, STATUS, NACL from users where NACL='".$CONNECTION_NACL."' Limit 1");
list($TGT_USERID, $TGT_USERNAME, $TGT_MOBILENUMBER, $TGT_STATUS, $TGT_NACL)=mysql_fetch_row($queryConnectionID);

if($CONNECTION_NACL=="" || $MESSAGE==""){
	header("Location: $ROOT/");
	exit();
}

$MESSAGE=encrypt($MESSAGE,$_SESSION['NACL']);

$querystring="insert into posts (AUTHOR_USERID, TARGET_USERID, POST_COPY) values('".$_SESSION['USERID']."','".$TGT_USERID."','".$MESSAGE."')";
mysql_query("$querystring") or die(mysql_error()."  Please contact support if this problem continues. support@wethrbug.com");

//
// SMS TURNED ON?
$queryConnectionID=mysql_query("select SMSNOTIFICATIONS, CARRIERID from preferences where USERID='".$TGT_USERID."' AND SMSNOTIFICATIONS=1 AND CARRIERID>0 Limit 1");
if(mysql_num_rows($queryConnectionID)>0){
	list($SMSNOTIFICATIONS, $CARRIERID)=mysql_fetch_row($queryConnectionID);
	
	
	//
	// HAVE I BEEN SMS'D IN THE LAST MIN?
	$smstimelimit=date("Y-m-d H:i:s",time()-60*1.1);
	$queryUser=mysql_query("select TARGET_USERID from notifications where TARGET_USERID='".$TGT_USERID."' and DATECREATED>'$smstimelimit' LIMIT 1");
	
	//
	// SEND SMS
	if(mysql_num_rows($queryUser)<1){
		$querystring="insert into notifications (TARGET_USERID) values('".$TGT_USERID."')";
		mysql_query("$querystring") or die(mysql_error()."  Please contact support if this problem continues. support@wethrbug.com");
 
		//
		// GET CARRIER PATTERN
		$queryCarrier=mysql_query("select NUMBER from carriers where ID='".$CARRIERID."' AND ROWSTATUS='active' Limit 1");
		if(mysql_num_rows($queryCarrier)>0){
			list($NUMBER)=mysql_fetch_row($queryCarrier);
			
			//
			// BUILD EMAIL ADDRESS
			$TGT_MOBILENUMBER=decrypt($TGT_MOBILENUMBER, $TGT_NACL);
			# [MOBILENUMBER]@txt.att.net
			
			$TGT_SMS = str_replace("[MOBILENUMBER]", $TGT_MOBILENUMBER, $NUMBER);
			//mail($TGT_SMS,"Wethrbug Report","The Wether has changed in your zipcode. SMS Preferences: http://wethrbug.com/");
		
		
			$to = '"To Display Name" <'.$TGT_SMS.'>';
			$subject = 'Wethrbug Report';
			$message = 'Wethr has changed in your zipcode.' . PHP_EOL .
					   'SMS Prefernces: http://wethrbug.com' . PHP_EOL;
			$headers = 'From: "Wethrbug" <notifications@wethrbug.com>' . PHP_EOL .
					   'X-Mailer: PHP-' . phpversion() . PHP_EOL;
			if (mail($to, $subject, $message, $headers)) {
			  //echo 'mail() Success!' . "<br />\n";
			  logActivity('sms delivered',crc32('sms delivered'), $UNHASH, $MNHASH, $PWDHASH, $IPLASTLOGIN, $USERAGENT);
			}
			else {
			  //echo 'mail() Failure!' . "<br />\n";
			  logActivity('sms failed',crc32('sms failed'), $UNHASH, $MNHASH, $PWDHASH, $IPLASTLOGIN, $USERAGENT);
			}
			 
		
		}
	}
}

header("Location: $ROOT/forecast/region/?grid=".$CONNECTION_NACL);
exit();
?>