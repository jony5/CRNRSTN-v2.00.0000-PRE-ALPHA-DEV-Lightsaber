<?php
session_start();
if(isset($_SESSION['client_userid'])){
	// verify session in database
	include_once("database.inc.php");
	$timelimit=date("Y-m-d H:i:s",time()-60*60*6);
	$querystring="select id from sessions where userid=".$_SESSION['client_userid']." and phpsession='".session_id()."' and lastcontact >='$timelimit'";
	$query=mysql_query("$querystring") or die("Terminal Error - Contact Support -$querystring returned ".mysql_error());

	if(mysql_num_rows($query)<1){
		//session is either bogus or expired
		$message="Your session timed out.  Please login again.";
		include("index.php");
		die();
	}
	// update session in database
	$querystring="update sessions set lastcontact='$ts' where phpsession='".session_id()."'";
	$query=mysql_query("$querystring") or die("Terminal Error - Contact Support");
	mysql_query("delete from sessions where lastupdate<='$timelimit'");
}else{
	// kick to login
//	echo "You got kicked";
	include("index.php");
	die();
}




