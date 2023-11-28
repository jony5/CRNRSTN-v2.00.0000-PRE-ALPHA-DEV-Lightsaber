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

$IPLASTLOGIN=addslashes($_SERVER['REMOTE_ADDR']);
$USERAGENT=addslashes($_SERVER['HTTP_USER_AGENT']);

//
// GET SUBMITTED DATA
$smsnotice=addslashes(trim($_POST['smsnotice']));
$carrier=addslashes(trim($_POST['carrier']));


//
// DOES THIS USER EXISTS?
$CONNECTION_UNHASH = md5($CONNECTION_USERNAME); 

//echo "<br>".$smsnotice."<br>";    	// 1
//echo "<br>".$carrier."<br>";		// 7
//die();

//
// SMS NOTIFICATION MANAGEMENT
//switch($smsnotice){
	//case "1":
		//
		// SAVE SMS PREFRENCE IF CARRIES ID PROVIDED
		//if($carrier!=""){
			//
			// DOES THIS USER EXIST IN PREFERENCE DS?  // THIS CHECK CAN BE KILLED ONCE PREFERENCES ARE UPDATED TO INITIALIZE WITH USER ACCOUNT CREATION
			$queryUser=mysql_query("select ID from preferences where USERID='".$_SESSION['USERID']."' LIMIT 1");
			if(mysql_num_rows($queryUser)>0){
	
				$querystring="update preferences set SMSNOTIFICATIONS='$smsnotice', CARRIERID='$carrier', DATEMODIFIED='$ts' where ROWSTATUS='active' AND USERID='".$_SESSION['USERID']."' LIMIT 1";
				$query=mysql_query("$querystring") or die("Terminal Error - Please contact support if this problem continues. support@wethrbug.com");
				
				logActivity('preferences updated', crc32('preferences updated'), $UNHASH, $MNHASH, $PWDHASH, $IPLASTLOGIN, $USERAGENT);
				
			}else{
				//
				// NEED TO PERFOMR INSERT // THIS CHECK CAN BE KILLED ONCE PREFERENCES ARE UPDATED TO INITIALIZE WITH USER ACCOUNT CREATION
				$querystring="insert into preferences (USERID, SMSNOTIFICATIONS, CARRIERID, DATEMODIFIED) values('".$_SESSION['USERID']."', '".$smsnotice."', '".$carrier."', '".$ts."');";
				$query=mysql_query("$querystring") or die("Terminal Error - Please contact support if this problem continues. support@wethrbug.com");
				
				logActivity('preferences profile created', crc32('preferences profile created'), $UNHASH, $MNHASH, $PWDHASH, $IPLASTLOGIN, $USERAGENT);
			}
		//}
		
//	break;
	//default:
		// DO NOTHING
	//break;
	
//}

 
header("Location: $ROOT");
exit();
	
?>