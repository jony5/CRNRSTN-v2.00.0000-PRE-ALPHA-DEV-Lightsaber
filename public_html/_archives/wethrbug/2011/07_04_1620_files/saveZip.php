<?php
session_start();
include("root.inc.php");
include("$ROOT/db/wethrdb.inc.php");
include("$ROOT/common/inc/logs.inc.php");//
// DEFINE VARIABLES
$mobilenumber=$_SESSION['mobilenumber'];
$username=$_SESSION['zipcode'];
$_SESSION['username']=$username;
$status=$_SESSION['status'];
$password=addslashes(trim($_POST['password']));

$_SESSION['password']=$password;

$serial=time();
$serial=$serial.$username.$mobilenumber.$password;
$NACL=md5($serial);
define('SALT', $NACL); 

$USERNAME=encrypt($username, $NACL); 
$MOBILENUMBER=encrypt($mobilenumber, $NACL); 
$STATUS=encrypt($status, $NACL); 

$MNHASH = md5($mobilenumber); 
$UNHASH = md5($username); 
$PWDHASH = md5($password); 

$IPLASTLOGIN=addslashes($_SERVER['REMOTE_ADDR']);
$USERAGENT=addslashes($_SERVER['HTTP_USER_AGENT']);

$LOGINCOUNT=1;

//
// PERFORM SYSTEM LOOKUP FOR UNIQUE USERNAME
$query=mysql_query("select ID from users where UNHASH='".$UNHASH."' AND PWDHASH='".$PWDHASH."' AND ROWSTATUS='active'  LIMIT 1");
if(mysql_num_rows($query)>0){
	//
	// THIS USER EXISTS IN THE DATABASE
	header("Location: $ROOT/errorNew.php");
	logActivity('create new user contention', crc32('create new user contention'), $UNHASH, $MNHASH, $PWDHASH, $IPLASTLOGIN, $USERAGENT);
	exit();
	
}else{
	//
	// THIS USER CAN BE CREATED
	$saveUser="insert into users (USERNAME, MOBILENUMBER, STATUS, NACL, UNHASH, MNHASH, PWDHASH, DATELASTLOGIN, IPLASTLOGIN, LOGINCOUNT) 
	values('".$USERNAME."', '".$MOBILENUMBER."', '".$STATUS."', '".$NACL."', '".$UNHASH."', '".$MNHASH."', '".$PWDHASH."', '".$ts."', '".$IPLASTLOGIN."', '".$LOGINCOUNT."');";
	mysql_query("$saveUser") or die("Terminal Error - Please contact support if this problem continues. support@wethrbug.com");
	
	logActivity('new user created', crc32('new user created'), $UNHASH, $MNHASH, $PWDHASH, $IPLASTLOGIN, $USERAGENT);
	
	
	
	
	
	
	header("Location: $ROOT/newUser.php");
	exit();
}



# USERS_TABLE
// ID				11
// USERNAME			300
// MOBILENUMBER		100
// STATUS			500
// NACL				32
// UNHASH			32
// MNHASH			32
// PWDHASH				4
// DATECREATED
// DATELASTLOGIN
// IPLASTLOGIN		15
// LOGINCOUNT		10


# CHAT_TABLE
// ID
// USERID
// CONTENT     1000 [HASHED WITH USERS HASH FROM USERS_TABLE]
// DATECREATED


# FRIEND_TABLE
// ID
// USERID
// FRIEND_USERID
// DATECREATED
// STATUS



die();



##
//
//
//	//echo $username;
//	//echo "Service down temporarily for testing....";
////	die();
//	
//if(mysql_num_rows($query)>0){
//	$_SESSION['username']=$username;
//	list($userid, $groupid, $status, $firstname, $lastname, $pwdprompt, $email)=mysql_fetch_row($query);
//	
//	//
//	// SET COOKIE FOR USERNAME
//	setcookie("username", $username, time()+60*60*24*60, "/"); 
//	
//	//
//	// CHECK FOR PASSWORD RESET REQUEST
//
//	if($pwdprompt=="1"){
//		if(($pwdconfirm==$newpwd) && (strlen($newpwd)>6)){
//			//
//			// HASH THE PWD
//			$newpwdHash = md5($newpwd); 
// 
//			//
//			// SAVE NEW PWD TO DB
//			$pwdsave=mysql_query("update users SET PASSWORD='$newpwdHash', PWDPROMPT='0' where USERNAME='$username'");
//		
//		}else{
//			if(!(strlen($newpwd)>6) && strlen($newpwd)>0){
//				$_SESSION['error']="<br>Please make sure your new password is at least 7 characters in length.";
//			}
//			if(!($pwdconfirm==$newpwd)){
//				$temperr=$_SESSION['error'];
//				$_SESSION['error']="$temperr<br>Your password confirmation did not match the password you entered.";
//			}
//			$_SESSION['userid']=$userid;
//			//echo "<META HTTP-EQUIV=Refresh CONTENT=\"0; URL=$ROOT/updatepwd.php\">";
//			//die();
//			
//			header("Location: $ROOT/updatepwd.php");
//			exit();
//			
//		}
//	}
//	$queryClients=mysql_query("select GROUPNAME from usergroups where STATUS='active' and ID='$groupid'");
//	list($GROUPNAME)=mysql_fetch_row($queryClients);
//
//	//Access Approved
//	$_SESSION['userid']=$userid;
//	$_SESSION['groupid']=$groupid; 
//	$_SESSION['clientgroupname']=strtolower($GROUPNAME); 
//	$_SESSION['content_profile']=tnavaccesspermissions($groupid);
//	
//	//
//	// SO I DON'T HAVE TO KEEP POUNDING THE DB FOR GLOBAL VALUES
//	$_SESSION['_USERID']=strtolower($userid); 
//	$_SESSION['_USERNAME']=strtolower($username); 
//	$_SESSION['_GROUPID']=strtolower($groupid); 
//	$_SESSION['_FIRSTNAME']=strtolower($firstname);
//	$_SESSION['_LASTNAME']=strtolower($lastname);
//	$_SESSION['_EMAIL']=strtolower($email); 
//	$_SESSION['_GROUPNAME']=strtolower($GROUPNAME); 
//	
// //$userid, $groupid, $status, $firstname, $lastname, $pwdprompt, $email
//	$phpsession=session_id();
//	
//	$querystring="delete from sessions where phpsession='$phpsession' and userid ='$userid'";
//	mysql_query("$querystring") or die(mysql_error()." on ".$querystring);
//	$querystring="insert into sessions(phpsession, starttime, lastcontact, userid) values('$phpsession','$ts','$ts','$userid')";
//	mysql_query("$querystring") or die(mysql_error()." on ".$querystring);
//	
//	if($redirectaccess=="true" && $requestedURL!="" ){
//		$_SESSION['redirectaccess']="false";
//		header("Location: $requestedURL");	
//		exit();
//	}		
//
//	switch($groupid){
//		case 1: 
//			//echo "<META HTTP-EQUIV=Refresh CONTENT=\"0; URL=$ROOT/portal.php\">";
//			header("Location: $ROOT/portal.php");
//			exit();
//		break;
//		case "2": 
//			//echo "<META HTTP-EQUIV=Refresh CONTENT=\"0; URL=$ROOT/portal.php\">";
//			header("Location: $ROOT/tools/deliverability/");
//			exit();
//		break; 
//		default: 
//			//echo "<META HTTP-EQUIV=Refresh CONTENT=\"0; URL=$ROOT/campaigns/portal.php\">";
//			header("Location: $ROOT/portal.php");
//			exit();
//		break; 
//	}
//
//}else{  
//	//echo "<META HTTP-EQUIV=Refresh CONTENT=\"0; URL=$ROOT/index.php\">";
//	header("Location: $ROOT/index.php");
//	exit();
//}
?>
