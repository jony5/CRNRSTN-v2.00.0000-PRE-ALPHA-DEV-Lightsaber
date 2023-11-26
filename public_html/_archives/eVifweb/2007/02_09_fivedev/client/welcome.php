<?php 
include("security.inc.php");
require_once("header.inc.php");
include("database.inc.php");

include("includes/wmenu.inc");

// validate for video admin access
$querystring="select referralcode from fiveusers where id=".$_SESSION['client_userid']."";
$query=mysql_query("$querystring") or die("Terminal Error - Contact Support -$querystring returned ".mysql_error());

list($code)=mysql_fetch_row($query);

$querystring2="select referralcode from referrals where referralcode='$code' and accesslevel='full' and status='active'";
$query2=mysql_query("$querystring2") or die("Terminal Error - Contact Support -$querystring returned ".mysql_error());

if(mysql_num_rows($query2)<1){
	//do nothing if referral code is not correct
}else{
	// if referral code is accurate, show five video menu
	include("includes/fivevidmenu.inc");
}



include("footer.inc.php");
 ?>

