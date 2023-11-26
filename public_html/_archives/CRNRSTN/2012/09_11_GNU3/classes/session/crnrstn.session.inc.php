<?php
#
#  VERSION :: 2.0.012
#  AUTHOR :: J5 
#  URI :: JONY5.COM
#  DESCRIPTION :: 
#  LICENSE :: GNU | http://en.wikipedia.org/wiki/GNU_General_Public_License
#  CURRENT DATE :: 3.07.2012
# 

/*
I was having problems with $_SESSION information not being written or being lost in a seemingly r
andom way.  There was a Location: call being made deep in a Zend OAuth module, I am using an IIS server with PHP as a CGI, etc.

The answer was simply that you need to have the domain be consistent for sessions to work consistently.  
In my case, I was switching back and forth between www.EXAMPLE.com:888 and EXAMPLE.com:888.  The unusual port, 
the hidden Location: call, the handoff with OAuth, etc all served to confuse me, but the intermitent error was 
caused by this simple goof of keeping the domain consistent.

*/

# THIS SHIT NEEDS TO BE COMPLETELY GUTTED AND STANDARDIZED.
# SESSION MGMT MAY BECOME AN INTEGRAL PIECE TO THIS CLASS LIBRARY. BUILD IT TIGHT...FROM THE GROUND UP.

session_start();
include("./root.inc.php");

$sessPath   = ini_get('session.save_path');
$sessCookie = ini_get('session.cookie_path');
$sessName   = ini_get('session.name');
$sessVar    = 'foo';

echo '<br>sessPath: ' . $sessPath;
echo '<br>sessCookie: ' . $sessCookie; 

die;




















include("$ROOT/db/rptdatabase.inc.php");

//globals are off
$username=strtolower(addslashes(trim($_POST['un'])));
$password=addslashes(trim($_POST['pwd']));

$newpwd=addslashes(trim($_POST['newpwd']));
$pwdconfirm=addslashes(trim($_POST['pwdconfirm']));
$passwordHash = md5($password); 
 
 
 
$query=mysql_query("select ID, GROUPID, STATUS, FIRSTNAME, LASTNAME, PWDPROMPT, EMAIL from users where USERNAME='$username' and PASSWORD='$passwordHash' and STATUS='active'");
 	
if(mysql_num_rows($query)>0){
	$_SESSION['username']=$username;
	list($userid, $groupid, $status, $firstname, $lastname, $pwdprompt, $email)=mysql_fetch_row($query);
	
	//
	// SET COOKIE FOR USERNAME
	setcookie("username", $username, time()+60*60*24*60, "/"); 
	
	//
	// CHECK FOR PASSWORD RESET REQUEST

	if($pwdprompt=="1"){
		if(($pwdconfirm==$newpwd) && (strlen($newpwd)>6)){
			//
			// HASH THE PWD
			$newpwdHash = md5($newpwd); 
 
			//
			// SAVE NEW PWD TO DB
			$pwdsave=mysql_query("update users SET PASSWORD='$newpwdHash', PWDPROMPT='0' where USERNAME='$username'");
		
		}else{
			if(!(strlen($newpwd)>6) && strlen($newpwd)>0){
				$_SESSION['error']="<br>Please make sure your new password is at least 7 characters in length.";
			}
			if(!($pwdconfirm==$newpwd)){
				$temperr=$_SESSION['error'];
				$_SESSION['error']="$temperr<br>Your password confirmation did not match the password you entered.";
			}
			$_SESSION['userid']=$userid;
			//echo "<META HTTP-EQUIV=Refresh CONTENT=\"0; URL=$ROOT/updatepwd.php\">";
			//die();
			
			header("Location: $ROOT/updatepwd.php");
			exit();
			
		}
	}
	$queryClients=mysql_query("select GROUPNAME from usergroups where STATUS='active' and ID='$groupid'");
	list($GROUPNAME)=mysql_fetch_row($queryClients);

	//Access Approved
	$_SESSION['userid']=$userid;
	$_SESSION['groupid']=$groupid; 
	$_SESSION['clientgroupname']=strtolower($GROUPNAME); 
	$_SESSION['content_profile']=tnavaccesspermissions($groupid);
	
	//
	// SO I DON'T HAVE TO KEEP POUNDING THE DB FOR GLOBAL VALUES
	$_SESSION['_USERID']=strtolower($userid); 
	$_SESSION['_USERNAME']=strtolower($username); 
	$_SESSION['_GROUPID']=strtolower($groupid); 
	$_SESSION['_FIRSTNAME']=strtolower($firstname);
	$_SESSION['_LASTNAME']=strtolower($lastname);
	$_SESSION['_EMAIL']=strtolower($email); 
	$_SESSION['_GROUPNAME']=strtolower($GROUPNAME); 
	
 //$userid, $groupid, $status, $firstname, $lastname, $pwdprompt, $email
	$phpsession=session_id();
	
	$querystring="delete from sessions where phpsession='$phpsession' and userid ='$userid'";
	mysql_query("$querystring") or die(mysql_error()." on ".$querystring);
	$querystring="insert into sessions(phpsession, starttime, lastcontact, userid) values('$phpsession','$ts','$ts','$userid')";
	mysql_query("$querystring") or die(mysql_error()." on ".$querystring);
	
	if($redirectaccess=="true" && $requestedURL!="" ){
		$_SESSION['redirectaccess']="false";
		header("Location: $requestedURL");	
		exit();
	}		

	switch($groupid){
		case 1: 
			//echo "<META HTTP-EQUIV=Refresh CONTENT=\"0; URL=$ROOT/portal.php\">";
			header("Location: $ROOT/portal.php");
			exit();
		break;
		case "2": 
			//echo "<META HTTP-EQUIV=Refresh CONTENT=\"0; URL=$ROOT/portal.php\">";
			header("Location: $ROOT/tools/deliverability/");
			exit();
		break; 
		default: 
			//echo "<META HTTP-EQUIV=Refresh CONTENT=\"0; URL=$ROOT/campaigns/portal.php\">";
			header("Location: $ROOT/portal.php");
			exit();
		break; 
	}

}else{  
	//echo "<META HTTP-EQUIV=Refresh CONTENT=\"0; URL=$ROOT/index.php\">";
	header("Location: $ROOT/index.php");
	exit();
}
?>
