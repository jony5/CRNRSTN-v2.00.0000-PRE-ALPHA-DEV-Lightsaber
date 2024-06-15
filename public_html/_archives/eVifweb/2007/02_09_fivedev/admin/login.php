<?php
session_start();

include("../client/database.inc.php");

//globals are off
$username= $_POST['username'];
$password=$_POST['password'];


$query=mysql_query("select id,type, status from fiveusers where username='$username' and password='$password'");
list($userid,$type, $status)=mysql_fetch_row($query);


if($status=="inactive"){
	echo "<META HTTP-EQUIV=Refresh CONTENT=\"0; URL=../client/index.php?status=error2\">";
}else{

if(mysql_num_rows($query)>0){
	//Access Approved
	$_SESSION['client_username']=$username;
	
	$_SESSION['client_userid']=$userid;
	$_SESSION['client_type']=$type;
	$phpsession=session_id();

	$querystring="delete from sessions where phpsession='$phpsession' and usertype='client'";
	mysql_query("$querystring") or die(mysql_error()." on ".$querystring);
	$querystring="insert into sessions(phpsession, starttime, lastcontact,userid, usertype) values('$phpsession','$ts','$ts','$userid','$type')";
	mysql_query("$querystring") or die(mysql_error()." on ".$querystring);
	echo "Processing login. Please wait...";
	
	switch($type){
	case "admin":
		echo "<META HTTP-EQUIV=Refresh CONTENT=\"0; URL=contentmanager.php\">";
	break;
	
	case "moxieemail":
		echo "<META HTTP-EQUIV=Refresh CONTENT=\"0; URL=emailtest.php\">";
	break;
		
	default:	
		echo "<META HTTP-EQUIV=Refresh CONTENT=\"0; URL=../client/welcome.php\">";
	}
}else{
	//include("../client/index.php");
	echo "<META HTTP-EQUIV=Refresh CONTENT=\"0; URL=../client/index.php?status=error1\">";
}
}

//include("../client/footer.inc.php");
?>
