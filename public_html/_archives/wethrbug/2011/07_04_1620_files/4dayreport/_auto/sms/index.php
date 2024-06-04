<?php
session_start();
include("/home4/pixtwofl/public_html/wethrbug/db/wethrdb.inc.php");
include("/home4/pixtwofl/public_html/wethrbug/4dayreport/security/sessionmgmt/session.inc.php");
include("/home4/pixtwofl/public_html/wethrbug/common/inc/logs.inc.php");

//
// SMS NOTIFICATION MANAGEMENT
//switch($smsnotice){
	//case "1":
		//
		// SAVE SMS PREFRENCE IF CARRIES ID PROVIDED
		//if($carrier!=""){
			//
			// DOES THIS USER EXIST IN PREFERENCE DS?  // THIS CHECK CAN BE KILLED ONCE PREFERENCES ARE UPDATED TO INITIALIZE WITH USER ACCOUNT CREATION
			$smstimelimit=date("Y-m-d H:i:s",time()-60*1.1);
			$queryUser=mysql_query("select ID from notifications where USERID='".$_SESSION['USERID']."' and DATECREATED>$smstimelimit LIMIT 1");
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